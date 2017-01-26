<?php
/**
* @version $Id: sobi2.entry.php 4820 2009-01-05 11:46:25Z Radek Suski $
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2006 - 2009 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
*/
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobiEntry {

	 /**
	  * editing or adding new  sobi entry
	  *
	  * @param integer $catid
	  * @param integer $itemid
      * @global sobi2Config $config
      * @global frontend $sobi2Frontend
      * @global mosUser $my
	  */
	 function editEntry( $catid, $itemid = 0 )
	 {
    	$config =& sobi2Config::getInstance();
		$my = &$config->getUser();
		$sobi2Frontend = &$config->getFrontend();
		sobi2Config::loadOverlib();
		$config->getEditForm();
		echo $sobi2Frontend->getHeader();
		if(!$config->allowFeEntr) {
			sobi2Config::redirect( $config->key( "redirects", "form_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
		}
		elseif(!$my->id && !$config->allowAnonymous) {
			echo _SOBI2_NOT_LOGGED._SOBI2_PLEASE_REGISTER_OR_LOGIN;
		}
		elseif(!$my->id && $config->allowAnonymous && $config->allowUserToEditEntry ) {
			echo _SOBI2_NOT_LOGGED_CANNOT_EDIT;
			sobi2Config::import("form.class");
	    	$addForm = new sobiForm($itemid,$catid);
		 	$addForm->showForm();
		}
		else {
			if( !$itemid && $config->key( "edit_form", "limit_user_entries" ) && $my->id && !$config->checkPerm() ) {
				sobi2Config::import( "form.class" );
				$database =& $config->getDb();
				$query = "SELECT count( `itemid` ) FROM `#__sobi2_item` WHERE `owner`= {$my->id} ";
				$database->setQuery( $query );
				if ( $database->loadResult() >= $config->key( "edit_form", "limit_user_entries" ) ) {
					echo "<h4>";
					echo str_replace( array( "%count%", "%limit%"), array( $database->loadResult(), $config->key( "edit_form", "limit_user_entries" ) ), _SOBI2_ENTRIES_LIMIT_REACHED );
					echo "</h4>";
				}
				else {
			    	$addForm = new sobiForm( $itemid, $catid );
				 	$addForm->showForm();
				}
			}
			else {
			   	sobi2Config::import( "form.class" );
				$addForm = new sobiForm( $itemid, $catid );
		 		$addForm->showForm();
			}
		}
		echo $sobi2Frontend->getFooter();
	}
	function quickEditScript( $sid )
	{
		$config =& sobi2Config::getInstance();
    	$index = $config->key( "details_view", "quickedit_ajax_target_file", "index2.php" );
    	$targetAddress = "{$config->liveSite}/{$index}?option=com_sobi2&no_html=1&sobi2Task=efip&sid={$sid}&fid=";
		ob_start();
    	?>
    	<script type="text/javascript">
    	<!--
    	/* <![CDATA[ */
		var currEditSobiFieldContent = null;
		var currEditSobiField = null;
		var semaphor = 0;
		var currEditSobiFid = 0;
		var fdata = null;
		var sefiHttpRequest;
    	function sobiEditField( fidh, fid )
		{
			if( semaphor > 0 ) {
				document.getElementById( currEditSobiField ).innerHTML = currEditSobiFieldContent;
			}
			currEditSobiFieldContent = document.getElementById( fidh ).innerHTML;
			currEditSobiField = fidh;
			currEditSobiFid = fid;
			semaphor = 1;
			document.getElementById( fidh ).innerHTML = '<img src="<?php echo $config->liveSite;?>/components/com_sobi2/images/spinner.gif" alt="loading"/>';
			sobiEditFieldSendRequest( fidh, fid );
		}
	    function sobiEditFieldSendRequest( fidh, fid )
	    {
	        if (window.XMLHttpRequest) {
	            sefiHttpRequest = new XMLHttpRequest();
	            if (sefiHttpRequest.overrideMimeType) {
	                sefiHttpRequest.overrideMimeType('text/xml');
	            }
	        }
	        else if (window.ActiveXObject) {
	            try { sefiHttpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
	                catch (e) {
                       try { sefiHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); }
	                   catch (e) {}
	                 }
	        }
	        if (!sefiHttpRequest) {
	            alert('Sorry but I Cannot create an XMLHTTP instance');
	            return false;
	        }
	        sefiHttpRequest.onreadystatechange = function() { sobiEditFieldResp( sefiHttpRequest, fidh, fid ); };
	        sefiHttpRequest.open('GET','<?php echo $targetAddress; ?>'+ fid , true);
	        sefiHttpRequest.send(null);
	    }
	    function sobiEditFieldResp( sefiHttpRequest, fidh, fid, s )
	    {
	    	if(sefiHttpRequest.readyState == 4) {
	    		if (sefiHttpRequest.status == 200) {
					document.getElementById( fidh ).innerHTML = sefiHttpRequest.responseText;
					if( s ) {
						semaphor = 0;
					}
	    		}
		    	else {
		    		 alert('There was a problem with the request: ' + sefiHttpRequest.status );
		    	}
	    	}
	    }
	    function sqeCancel()
	    {
			document.getElementById( currEditSobiField ).innerHTML = currEditSobiFieldContent;
			currEditSobiField = null;
			semaphor = 0;
	    }
	    function sqeSend()
	    {
			f = document.getElementById( 'sqetf' );
			var str = "no_html=" + encodeURI("1") + "&sobi2Task=" + encodeURI("efip") + "&sid=<?php echo $sid; ?>&save=" + encodeURI("1") +"&fid=" + encodeURI(currEditSobiFid);
			if( f[0].childNodes.length > 1 && f[0].type != "select-one" ) {
				cboxname = currEditSobiField.replace("sobi2Details_","");
				cBoxes = document.getElementsByName( cboxname + '[]' );
				for( i= 0; i < cBoxes.length; i++ ) {
					if( cBoxes[i].checked ) {
						str = str + "&value[]=" + encodeURIComponent( cBoxes[i].value );
					}
				}
			}
			else {
				var Fvalue;
				switch( f[0].type ) {
					case "text":
					case "textarea":
						str = str + "&value="+ encodeURIComponent(Fvalue);
						break;
					case "select-one":
						str = str + "&value="+ encodeURIComponent( Fvalue );
						break;
					case "checkbox":
						val = f[0].checked ? 1 : -1;
						str = str + "&value="+ val;
						break;
				}
			}
			url = '<?php echo $config->liveSite; ?>/<?php echo $index; ?>?option=com_sobi2';
			document.getElementById( currEditSobiField ).innerHTML = '<img src="<?php echo $config->liveSite;?>/components/com_sobi2/images/spinner.gif" alt="loading"/>';
			if (window.XMLHttpRequest) {
	            sefiHttpRequest = new XMLHttpRequest();
	            if (sefiHttpRequest.overrideMimeType) {
	                sefiHttpRequest.overrideMimeType('text/xml');
	            }
	        }
	        else if (window.ActiveXObject) {
	            try { sefiHttpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
	                catch (e) {
                       try { sefiHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); }
	                   catch (e) {}
	                 }
	        }
	        if (!sefiHttpRequest) {
	            alert('Sorry but I Cannot create an XMLHTTP instance');
	            return false;
	        }
	        sefiHttpRequest.onreadystatechange = function() { sobiEditFieldResp( sefiHttpRequest, currEditSobiField, currEditSobiFid, 1 ); };
	        sefiHttpRequest.open('POST',url , true);
			sefiHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			sefiHttpRequest.setRequestHeader("Content-length", str.length);
			sefiHttpRequest.setRequestHeader("Connection", "close");
	        sefiHttpRequest.send( str );
	    }
		/* ]]> */
		// -->
    	</script>
    	<?php
		$script = ob_get_contents();
		ob_end_clean();
		return $script;

	}
    /**
     * getting data for details view
     *
     * @param int $sobi2Id
     * @param int $catid
     */
    function showDetails( $sobi2Id, $catid )
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$sobi2Frontend = &$config->getFrontend();
		$my =& $config->getUser();
		$requestParams =& $config->get_( "requestParams" );
	 	echo $sobi2Frontend->getHeader();
	 	$waySearchLink = null;
	 	if( $sobi2Id ) {
	 		$sobi2Details = new HTML_SOBI;
	 		sobi2Config::import("sobi2.class");
			$mySobi = new sobi2($sobi2Id);
			if( ( ( ($my->id != 0 && $my->id == $mySobi->owner && $config->allowUserToEditEntry ) || $config->checkPerm() ) && $config->allowQuickEdit == 1 ) || ( $config->checkPerm() && $config->allowQuickEdit == 2 ) ) {
				$config->addCustomHeadTag( sobiEntry::quickEditScript( $sobi2Id ) );
				$admFields = array();
				if( !$config->checkPerm() ) {
					$query = "SELECT fieldid FROM `#__sobi2_fields` WHERE displayed = 1";
					$database->setQuery( $query );
					$admFields = $database->loadResultArray();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$fieldsIgnore = $config->key( "details_view","quickedit_fields_ignore" );
					if( strlen( $fieldsIgnore ) ) {
						array_push( $admFields,$fieldsIgnore );
					}
				}
				$editinplace = true;
	    		defined("_SOBI2_CALENDAR_LANG") || define("_SOBI2_CALENDAR_LANG", "en");
				$config->loadCalendar();
			}
			else {
				$editinplace = false;
			}
	   		if( $config->cacheL2dvEnabled && $output = $config->sobiCache->getContent( $requestParams, "entrydetails") ) {
	   			echo $output;
    			echo $sobi2Frontend->getFooter();
    			return true;
    		}
			$config->getDetails();
			/*
			 * get all fields data
			 */
			$fieldsdata = array();
			$fieldids = $config->sobiCache->get( "fields_details" );
			if( !$fieldids || is_integer( $fieldids ) ) {
				$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
						 "WHERE `in_details`= 1 AND `enabled` = 1 " .
						 "ORDER BY position";
				$database->setQuery($query);
				$fieldids = $database->loadObjectList();
				if ( $database->getErrorNum() ) {
					 trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$config->sobiCache->add("fields_details",$fieldids);
			}
			if( $fieldids ) {
				foreach( $fieldids as $fieldid ) {
					$field = new sobiField( $fieldid->fieldid, $sobi2Id );
					$fieldsdata[$field->fieldname] = $field;
				}
			}
	    	$mySobi->title = $config->getSobiStr( $mySobi->title );
	    	$mySobi->title = sobi2Config::replaceEntities( $mySobi->title );
	    	$itemData = array();

			$fieldsObjects = array();
	    	if( count( $fieldsdata ) ) {
				foreach( $fieldsdata as $field ) {
					$data = null;
					if( $field->fieldType == 2 ) {
						$field->data = $config->getSobiStr($field->data, true);
						$field->data = str_replace("& ", "&amp; ", $field->data);
						$data = $field->data;
					}
					elseif( $field->fieldType == 1 || $field->fieldType == 5 || $field->fieldType == 7 ) {
						$field->data = $config->getSobiStr( $field->data );
						$field->data = sobi2Config::replaceEntities( $field->data );
						if( $field->isUrl == 4 ) {
							$data = $field->customCode;
						}
						else {
							$data = $field->data;
						}
					}
					elseif( $field->fieldType == 3 ) {
						$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
						$field->with_label = 1;
					}
					elseif( $field->fieldType == 6 ) {
						$field->data = $field->selectedValues;
						$data = null;
						if( is_array( $field->data ) && !empty( $field->data ) ) {
							$data .= "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
							foreach ( $field->data as $opt ) {
								$data .= "\n\t<li>{$opt}</li>";
							}
							$data .= "\n</ul>";
						}
					}
					$field->label = $config->getSobiStr($field->label);
					$tag = "span";
					if( strlen( $data ) ) {
						static $noFollows = null;
						static $noFollowsCheck = false;
						if( !$noFollowsCheck ) {
							$noFollows = $config->key( "url", "nofollow" );
							if( $noFollows ) {
								$noFollows = explode( ",", $noFollows );
							}
							else {
								$noFollows = array();
							}
							$noFollowsCheck = true;
						}
						if( $field->isUrl == 1 ) {
							if( in_array( $field->fieldid, $noFollows ) ) {
								$noFollow = " rel=\"nofollow\" ";
							}
							else {
								$noFollow = null;
							}
							$data = "<a href=\"{$data}\"{$noFollow} title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}</a>";
						}
						else if($field->isUrl == 2) {
							$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
						}
						else if($field->isUrl == 3) {
							$data = "<img src=\"{$data}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
						}
						else {
							$data = $sobi2Frontend->runPlugins($data);
						}
						if( $editinplace && !in_array( $field->fieldid, $admFields ) ) {
							$t = _JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT;
							$onclick = "ondblclick=\"sobiEditField('sobi2Details_{$field->fieldname}', {$field->fieldid})\" title=\"{$t}\"";
						}
						else {
							$onclick = null;
						}
						if($field->with_label) {
							$data = "\n\t\t" .
									"<{$tag} id=\"sobi2Details_{$field->fieldname}\" {$onclick}><span id=\"sobi2Listing_{$field->fieldname}_label\">{$field->label}:</span> {$data}</{$tag}>";
						}
						elseif(!$editinplace && $field->fieldType == 6 ) {
							$data = $data;
						}
						else {
							$data = "\n\t\t<{$tag} {$onclick} id=\"sobi2Details_{$field->fieldname}\">{$data}</{$tag}>";
						}
						if($field->in_newline) {
							$data = "<br/>".$data;
						}
					}
					$fieldsObjects[$field->fieldname] = $field;
					$itemData[$field->fieldname] = $data;
				}
		 		/*
		 		 * if we using waysearch
		 		 */
		 		$waySearchLink = HTML_SOBI::createWaySearchUrl( $sobi2Id );
	    	}
	 		$sobi2Details->showSobi($sobi2Id, $mySobi, $itemData, $waySearchLink,$catid, $fieldsObjects);
	 	}
	 	echo $sobi2Frontend->getFooter();
    }
    /**
     * pdf print
     *
     * @param int $sobi2Id
     * @param int $catid
     * @todo
     */
    function showDetailsPdf( $sobi2Id, $catid )
    {
 		$config &= sobi2Config::getInstance();
    	ob_start();
    	$config =& sobi2Config::getInstance();
    	showDetails( $sobi2Id, $catid );
//		$ob = ob_get_contents();
		ob_end_clean();
    }
    /**
     * checkin sobi item after save or cancel editing
     *
     * @param integer $sobi2Id
     * @global sobi2Config $config
     */
    function checkin($sobi2Id)
    {
    	$config	=& sobi2Config::getInstance();
		$database = &$config->getDb();
    	if($sobi2Id) {
	    	$statement = "UPDATE `#__sobi2_item` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `itemid` = {$sobi2Id}";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$url='index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id='.$sobi2Id.'&amp;Itemid='.$config->sobi2Itemid;
    	}
    	else {
    		$url='index.php?option=com_sobi2&amp;Itemid='.$config->sobi2Itemid;
    	}
		$url = sobi2Config::sef($url);
		sobi2Config::redirect($url);
    }
    function save( $catid )
    {
 		$config =& sobi2Config::getInstance();
 		sobi2Config::import( "sobi2.class" );
 		$sobi2Frontend =& $config->getFrontend();
 		$newSobi = new sobi2;
 		$msg = null;
 		if( !$config->autopublishEntry ) {
 			echo $sobi2Frontend->getHeader();
 		}
 		$msg .= $newSobi->saveSobi();
 		$config->sobiCache->clearAll();
 		if($config->basicPrice) {
 			$newSobi->fees += array( $config->basicPriceLabel => $config->basicPrice );
 		}
    	if( count( $newSobi->fees ) ) {
			if( !$config->autopublishEntry ) {
				$msg .= " "._SOBI2_NEW_ENTRY_AWAITING_APP;
				echo '<div class="message">'.$msg.'</div>';
			}
			sobi2Config::import( "payment.class" );
    		$fees = new payment( $newSobi );
			$fees->showFees();
			if( $config->autopublishEntry ) {
				showDetails( $newSobi->id,0 );
			}
			else {
				echo $sobi2Frontend->getFooter();
			}
    	}
		else {
 			if( $config->autopublishEntry ) {
 				if( !$newSobi->published ) {
	 				$href = "index.php?option=com_sobi2&amp;sobi2Task=usersListing&amp;Itemid={$config->sobi2Itemid}";
	 				$href = $config->key( "redirects", "after_save_new_unpublished", $href );
 				}
 				else {
	 				$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$newSobi->id}&amp;catid={$catid}&amp;Itemid={$config->sobi2Itemid}";
	 				$href = $config->key( "redirects", "after_save_new_entry_auto", $href );
 				}
 			}
 			else {
 				$msg .= " "._SOBI2_NEW_ENTRY_AWAITING_APP;
 				$href = "index.php?option=com_sobi2&amp;catid={$catid}&amp;Itemid={$config->sobi2Itemid}";
 				$href = $config->key( "redirects", "after_save_new_entry_app", $href );
 			}
 			$msg .= " "._SOBI2_CHANGES_SAVED;
 			sobi2Config::redirect( $href, $msg );
		}
    }
    function update()
    {
 		$sobi2Id = intval( sobi2Config::request( $_REQUEST, 'sobi2Id', 0 ) );
		$msg = null;
 		$config =& sobi2Config::getInstance();
		$my =& $config->getUser();
 		if( ( $my->id != 0 && $config->allowUserToEditEntry ) || $config->checkPerm() ){
	 		$config->getEditForm();
	 		sobi2Config::import( "sobi2.class" );
	 		$newSobi = new sobi2( $sobi2Id );
	 		$msg .= $newSobi->updateSobi();
	 		$config->sobiCache->clearAll();
	 		if( count( $newSobi->fees ) ) {
				sobi2Config::import( "payment.class" );
	 			$fees = new payment( $newSobi );
				$fees->showFees();
				showDetails( $newSobi->id, 0 );
	 		}
			else {
 				if( !$newSobi->published ) {
	 				$href = "index.php?option=com_sobi2&amp;sobi2Task=usersListing&amp;Itemid={$config->sobi2Itemid}";
	 				$href = $config->key( "redirects", "after_update_unpublished", $href );
 				}
 				else {
		 			$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$sobi2Id}&amp;Itemid={$config->sobi2Itemid}";
		 			$href = $config->key( "redirects", "after_update_entry_nopay", $href );
 				}
	 			$msg .= " "._SOBI2_CHANGES_SAVED;
	 			sobi2Config::redirect( $href, $msg );
			}
 		}
 		else {
 			sobi2Config::redirect( $config->key( "redirects", "update_sobi_no_perm", "index.php"), _SOBI2_NOT_AUTH);
 		}
    }
    function delete( $catid, $sobi2Id )
    {
 		$config =& sobi2Config::getInstance();
		$my =& $config->getUser();
    	if( ( $config->allowUserDelete && $my->id != 0 ) || $config->checkPerm() ) {
			sobi2Config::import("sobi2.class");
 			$sobi2ToDelete = new sobi2( $sobi2Id );

 			if( $config->allowUserDelete == 1 ) {
				$config->sobiCache->clearAll( true );
				$href = "index.php?option=com_sobi2&amp;Itemid={$config->sobi2Itemid}";
				$href = $config->key( "redirects", "after_delete_entry", $href );
 				sobi2Config::redirect( $href, $sobi2ToDelete->deleteSobi($catid));
 			}

 			else if ( $config->allowUserDelete == 2 ) {
				$config->sobiCache->clearAll( true );
				$href = "index.php?option=com_sobi2&amp;Itemid={$config->sobi2Itemid}";
				$href = $config->key( "redirects", "after_delete_entry", $href );
 				sobi2Config::redirect( $href, $sobi2ToDelete->unpublishSobi($catid));
 			}
 			showListing($catid);
 		}
    }
    function showSobi( $sobi2Id, $mySobi, $itemData, $waySearchLink, $cid, $fieldsObjects )
    {
    	$config 			=& sobi2Config::getInstance();
		$my 				=& $config->getUser();
		$mainframe 			=& $config->getMainframe();
		$fieldsFormatted 	=& $itemData;
    	$pluginsObjects 	=& $this->plugins;
    	$j15 				= false;
    	$fetchErr 			= intval(sobi2Config::request($_REQUEST, 'err', 0));
    	$plugins 			= array();
    	if( count( $config->S2_plugins ) ) {
    		foreach( $config->S2_plugins as $name => $plugin ) {
				if( method_exists( $plugin,"showDetails") ) {
					$plugins[$name] = $plugin->showDetails( $mySobi->id );
				}
    		}
    	}

		if(!$my->id && !$config->allowAnoDetails) {
			sobi2Config::redirect( $config->key( "redirects", "show_sobi_not_logged", "index.php" ), _SOBI2_NOT_LOGGED_FOR_DETAILS );
			exit();
		}
		if(!$mySobi->published) {
			sobi2Config::redirect( $config->key( "redirects", "show_sobi_unpublished", "index.php" ), _SOBI2_NOT_AUTH );
			exit();
		}

		$style = "style='";
		if($mySobi->background && file_exists( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$mySobi->background}")) {
			$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$mySobi->background});";
		}
		elseif(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg))) {
			$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";
		}

		if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor))) {
			$style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
		}
		else {
			$style = $style."'";
		}

    	if($sobi2Id) {
			if($config->useMeta) {
		    	if( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) {
		    		$document =& JFactory::getDocument();
		    		$j15 = true;
		    	}
				if(!empty($mySobi->metadesc)) {
					$metaDesc = $config->getSobiStr( $mySobi->metadesc );
					$metaDesc = sobiHTML::cleanText( $metaDesc );
					if( $j15 ) {
						$cur = $document->get( 'description' );
						if( strlen( $cur ) ) {
							$metaDesc = $cur .'. ' . $metaDesc;
						}
						$document->setDescription( $metaDesc );
					}
					else {
						$mainframe->appendMetaTag( "description", $metaDesc );
					}
				}
				if( !empty( $mySobi->metakey ) ) {
					$metaKeys = $config->getSobiStr( $mySobi->metakey );
					$metaKeys = sobiHTML::cleanText( $metaKeys );
					$mainframe->appendMetaTag( "keywords", $metaKeys );
				}
				if( $j15 ) {
					$cur = $document->getGenerator();
					$gen = " Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName );
					if( strlen( $cur ) ) {
						$gen = $cur .'. ' . $gen;
					}
					$document->setGenerator( $gen );
				}
				else {
					$mainframe->appendMetaTag( "generator", "Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName ) );
				}
			}
			$mySobi->countVisit();
			$config->appendPathWay( "{$mySobi->title}&nbsp;", $mySobi->title );
			$catNames = null;
			if( $config->key( "details_view", "entry_browser_title_add_cats", true ) ) {
				$catNames = $config->get("sobicatnames", null);
				if( is_array( $catNames ) && !empty( $catNames ) ) {
					$catNames = implode(" - ", $catNames );
					if( $config->key( "details_view", "entry_browser_title_add_component_name", true ) ) {
						$catNames = " - ".$catNames;
					}
				}
				else {
					$catNames = null;
				}
			}
			$cname = null;
			if( $config->key( "detail_view", "entry_browser_title_add_component_name", true ) ) {
				$cname = $config->componentName;
			}
			$delim = null;
			if( $cname || $catNames ) {
				$delim = " - ";
			}
			$mainframe->setPageTitle( html_entity_decode( $cname.$catNames.$delim.$mySobi->title ) );
			$imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );
			if($config->showImageInDetails && $mySobi->image && file_exists(_SOBI_CMSROOT.$imagesFolder.$mySobi->image)) {
				$img = "<img src=\"{$config->liveSite}{$config->imagesFolder}{$mySobi->image}\" alt=\"{$mySobi->title}\" class=\"sobi2DetailsImage\"/>";
			}
			else {
				$img = null;
			}
			if($config->showIcoInDetails && $mySobi->icon && file_exists(_SOBI_CMSROOT.$imagesFolder.$mySobi->icon)) {
				$ico = "<img src=\"{$config->liveSite}{$config->imagesFolder}{$mySobi->icon}\" alt=\"{$mySobi->title}\" class=\"sobi2DetailsIcon\"/>";
			}
			else {
				$ico = null;
			}
	        if( isset( $mySobi->tpl ) && $mySobi->tpl ) {
	        	if( sobi2Config::translatePath( "{$config->templatesDir}|{$mySobi->tpl}|sobi2.details.tmpl" ) ) {
	        		$template = $mySobi->tpl;
	        		$config->loadTplCss( $template );
	        	}
	        }
	        if( !isset( $template ) || !( $template = sobi2Config::translatePath( "{$config->templatesDir}|{$template}|sobi2.details.tmpl" ) ) ) {
	        	$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.details.tmpl" );
	        }
	        if( $config->debugTmpl && !$fetchErr ) {
	        	ob_start();
	        	$content = eval( '?' . '>' . rtrim( file_get_contents( $template ) ) );
	        	$out = ob_get_contents();
	        	ob_end_clean();
	        	if( $content === false ) {
	        		sobi2Config::parseTemplate( $template, $content );
	        	}
        		else {
		        	echo $out;
        			if( $config->cacheL2dvEnabled ) {
	        			$requestParams =& $config->get_( "requestParams" );
	        			$config->sobiCache->addContent( $out, $requestParams, "entrydetails" );
	        		}
        		}
	        }
	        else {
        		if( $config->cacheL2dvEnabled && !$fetchErr ) {
					ob_start();
        		}
        		require_once( $template );
        		if( $config->cacheL2dvEnabled && !$fetchErr ) {
					$content = ob_get_contents();
					$config->sobiCache->addContent( $content, $requestParams, "entrydetails" );
        		}
	        }
    	}
    	else {
    		exit();
    	}
    }
    function editButtons( $config, $mySobi )
    {
    	$my =& $config->getUser();
    	$cid = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
		/*
		 * handling for edit and delete buttons
		 */
		if(($my->id != 0 && $my->id == $mySobi->owner)|| $config->checkPerm()) {
			if( $config->allowUserToEditEntry || $config->checkPerm() ) {
				$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=editSobi&amp;sobi2Id={$mySobi->id}&amp;catid={$cid}&amp;Itemid={$config->sobi2Itemid}";
				echo "<input type=\"button\" class=\"button\" onclick=\"location.href='{$href}'\" id=\"sobi2EditEntryButton\" name=\"editEntry\" value=\""._SOBI2_LISTING_EDIT_ENTRY_BT."\"/>";
			}
			if( $config->allowUserDelete || $config->checkPerm() ) {
				$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=deleteSobi&amp;sobi2Id={$mySobi->id}&amp;catid={$cid}&amp;Itemid={$config->sobi2Itemid}";
				echo "<input type=\"button\" class=\"button\" id=\"sobi2DelEntryButton\" onclick=\"if(confirm('"._SOBI2_CONFIRM_DELETE."') == true) location.href='{$href}'\" name=\"editEntry\" value=\""._SOBI2_LISTING_DELET_ENTRY_BT."\"/>";
			}
		}
    }
    /**
     * displaying renewal info
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function renewal( $config, $mySobi )
    {
    	if( !$config->allowRenew || $mySobi->publish_down == $config->getNullDate() ) {
    		return false;
    	}
    	$my =& $config->getUser();
    	$text = null;
		/*
		 * handling for edit and delete buttons
		 */
		if(($my->id != 0 && $my->id == $mySobi->owner)|| $config->checkPerm()) {
			$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=renew&amp;sobi2Id={$mySobi->id}&amp;Itemid={$config->sobi2Itemid}";
			$date = strtotime( $mySobi->publish_down );
			$now = strtotime( $config->getTimeAndDate() );
			$days = round( ( $date - $now ) / 60 / 60 / 24 );
			if( $days <= $config->allowRenewDaysForExp && $days >= 0 ) {
				$text = str_replace( array( "%days%", "%href%" ), array( $days, $href ), _SOBI2_RENEW_TPL_TXT );
			}
			elseif( $days <= $config->allowRenewDaysForExp && $days < 0 ) {
				$days = $days * -1;
				$text = str_replace( array( "%days%", "%href%" ), array( $days, $href ), _SOBI2_RENEW_EXP_TXT );
			}
			echo "<p class=\"sobi2ExpMsg\">{$text}</p>";
		}
    }
    /**
     * displaying custom fields data
     *
     * @param array $itemData
     * @param string $field
     */
    function customFieldsData( $itemData, $field = null )
    {
    	if(!$field) {
	    	if( count( $itemData ) ) {
	    		foreach($itemData as $field) {
		    		echo $field;
		    	}
	    	}
    	}
    	elseif(isset($itemData[$field])) {
    		echo $itemData[$field];
    	}
    }
}
?>