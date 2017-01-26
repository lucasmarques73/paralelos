<?php
/**
* @version $Id: admin.sobi2.class.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

/*
 *  no direct access
 */
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
/*
 * ensure user has access to this function
 */
sobi2Config::import("admin.sobi2.class", "adm");
class sobi2Form extends sobiForm {
	function sobi2Form($returnTask, $catId, $sobi2Id = 0 )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config	=& adminConfig::getInstance();
		$my	= &$config->getUser();
    	defined( "_SOBI2_ADD_FORM" ) || define( "_SOBI2_ADD_FORM", true );
    	if( $sobi2Id != 0 ) {
	    	$sobi2= new adminSobi($sobi2Id);
			if ($sobi2->checked_out && $sobi2->checked_out != $my->id && $sobi2->checked_out_time > $config->checkOutTime) {
				sobi2Config::redirect( $sobi2AdminUrl.'&amp;task='.$returnTask.'&amp;catid='.$catId, _SOBI2_LISTING_CHECKED_OUT );
			}
			else
			{
				$sobi2->checkOutSobi($my->id);
			}
			$this->sobi2Id = $sobi2Id;
			$this->item = $sobi2;
    	}
    	else {
    		$sobi2= new adminSobi();
			$this->item = $sobi2;
			$this->item->published = 1;
			$this->item->confirm = 1;
			$this->item->approved = 1;
			$this->item->publish_up = date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  );
	    	if($config->entryExpirationTime && $config->entryExpirationTime != null && $config->entryExpirationTime != 0) {
	    		$this->item->publish_down = date( 'Y-m-d H:i:s', time() + ($config->entryExpirationTime * 24 * 60 * 60) + ( $config->offset * 60 * 60));
	    	}
    		else {
    			$this->item->publish_down = $config->nullDate;
    		}
    	}
    	$this->buildFields();
    	if( $config->key( "edit_form", "cats_selection_adm", true ) ) {
	    	if($config->useSigsiuTree) {
	    		parent::getCategories();
	    	}
	    	else {
    			require_once(_SOBI_ADM_PATH.DS."includes".DS."dtree.js.php");
	    		$this->getCategories();
	    	}
    	}
    	else {
    		if( $f = $config->key( "edit_form", "edit_callback_func", false ) && function_exists( $f )) {
    			$sobi2SlectedCats = call_user_func( $f );
    		}
    	}
	}
	function getPlugins( $onStart = false )
	{
    	$config =& adminConfig::getInstance();
    	$plugins = null;
    	$content = null;

    	//Plugin Ausgaben, die Felder modifizieren (keine Ausgabe im Tab)
		if($onStart) {
	    	if(count($config->S2_plugins)) {
	    		if($this->item) {
	    			$sobiId = $this->item->id;
	    		}
	    		else {
	    			$sobiId = null;
	    		}
	    		foreach($config->S2_plugins as $id => $plugin) {
	    			if(method_exists($plugin,"editFormStart")) {
	    				$plugin->editFormStart($sobiId,$this->fields);
	    			}
	    		}
	    	}
		}

		//Kompatibilitaet mit alten Plugins
		else {
	    	if(count($config->S2_plugins)) {
	    		if($this->item) {
	    			$sobiId = $this->item->id;
	    		}
	    		else {
	    			$sobiId = null;
	    		}
	    		foreach($config->S2_plugins as $id => $plugin) {
	    			if(method_exists($plugin,"editForm")) {
	    				$content = $plugin->editForm($sobiId);
	    			}
	    			if($content) {
		    			$plugins .= "<table class=\"SobiAdminForm\">";
		    			if($plugin->name) {
		    				$pluginName = $plugin->name;
		    			}
		    			else {
		    				$pluginName = $id;
		    			}
		    			$row = "\n\t <tr> \n\t\t <th>{$pluginName}</th> \n\t </tr>";
		    			$row .= "\n\t <tr> \n\t\t <td>{$content}</td> \n\t </tr>";
		    			$plugins .= $row;
				    	$plugins .= "</table>";
	    			}
	    		}
	    	}
	    }
    	return $plugins;
    }
	/*
	 * overloading
	 */
	function buildForm($returnTask = 'listing',$catId = 1)
	{
		$config =& adminConfig::getInstance();
		$my	= &$config->getUser();
    	$config->loadOverlib();
		$tabs = new sobiTabs( true );
    	if( defined( '_JEXEC' ) ) {
    		define( '_SOBI2_ADM_PASSED', true );
    		include_once( _SOBI_ADM_PATH.DS."toolbar.sobi2.php" );
    	}
    	if($this->sobi2Id == 0) {
    		$screenTitle = _SOBI2_FORM_TITLE_ADD_NEW_ENTRY;
    	}
    	else {
    		$screenTitle = _SOBI2_FORM_TITLE_EDIT_ENTRY."<small> [".$this->item->title."]</small>";
    	}
    	?>
		<form action="index2.php" method="post" name="adminForm" id="sobiAdminForm" enctype="multipart/form-data">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="edit"><?php echo $screenTitle?> </th>
			</tr>
		</table>
		<?php
			$tabs->startPane("sobi-pane");
			$tabs->startTab(_SOBI2_FORM_ENTRY_DETAILS,"sobientry");
		?>
		<table class="SobiAdminForm" width="100%">
			<tr>
				<th colspan="2"><?php echo _SOBI2_FORM_ENTRY_DETAILS?></th>
			</tr>
			<tr>
				<td colspan="2"><?php echo _SOBI2_FORM_FIELD_REQ_INFO; ?></td>
			</tr>
			<tr>
				<td><label for="field_entry_name"><?php echo _SOBI2_FORM_ENTRY_TITLE ?></label></td>
				<td><input type="text" id="field_entry_name" class="text_area"  name="field_entry_name" size="50" maxlength="255" value="<?php echo $this->item->title; ?>"/></td>
			</tr>
		<?php
			foreach($this->fields as $field) {
				/*
				 * getting fields types
				 */
					if($field->fieldType == 1)
					{
						$fieldHtml = $this->isTextField( $field );
					}
					elseif($field->fieldType == 3) {
						$fieldHtml =  $this->isCheckBox( $field, true );
					}
					elseif($field->fieldType == 4) {
						$fieldHtml =  $this->isCustom( $field );
					}
					elseif($field->fieldType == 5) {
						$fieldHtml =  $this->isList( $field );
					}
					elseif($field->fieldType == 6) {
						$fieldHtml =  $this->isCheckboxGroup( $field );
					}
					elseif($field->fieldType == 7) {
						$fieldHtml =  $this->isCalendar( $field );
					}
					else {
						$fieldHtml = $this->isTextField( $field );
					}
					if($field->is_required) {
						$star = _SOBI2_FORM_FIELD_REQ_MARK;
					}
					else {
						$star = null;
					}

					if( !$field->is_free ){
						$nfo_txt = _SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": ".$field->payment." ".$config->currency;
						$img = "administrator/components/com_sobi2/images/nfo_k.png";
						$notFreeOption = sobiHTML::toolTip( $nfo_txt, _SOBI2_FORM_NOT_FREE_OPTION, null, $img, "" );
					}
					else {
						$notFreeOption = null;
					}
					$field->fieldname = $config->getSobiStr($field->fieldname);
					$field->label = $config->getSobiStr($field->label);
				?>
					<tr>
						<td valign="top" width="20%"><label for="<?php echo $field->fieldname?>"><?php echo $field->label?><?php echo $star?>&nbsp;<?php echo $notFreeOption ?></label></td>
						<td valign="top">
						<?php

							if( $field->is_required && $field->fieldType != 2 ) {
								$this->addToJsValidator( $field );
							}
							if( $field->fieldType == 2 ) {
						    	if($field->fieldRows) {
						    		$rows = "rows='{$field->fieldRows}'";
						    	}
						    	else {
						    		$rows = "rows='10'";
						    	}

						    	if($field->fieldColumns) {
						    		$columns = "cols='{$field->fieldColumns}'";
						    	}
						    	else {
						    		$columns = "cols='40'";
						    	}
						    	if($this->item && isset($this->item->customFieldsData[$field->fieldname])) {
						    		$value = htmlspecialchars($this->item->customFieldsData[$field->fieldname],ENT_QUOTES);
						    	}
								else {
									$value = null;
								}
								echo "<br/>";
								$px = defined("_SOBI_MAMBO") ? "px" : null;
								echo sobi2bridge::editorArea( $field->fieldname,  $value, $field->fieldname, "75%;", "", $columns, $rows );
						    	if($field->explanation) {
						    		echo "&nbsp;";
						    		echo sobiHTML::toolTip($field->explanation,null,null,'tooltip.png',null,'#',0);
						    	}
							}
							else {
								echo $fieldHtml;
							}
						?></td>
					</tr>
				<?php
			}
		?>
		<!-- end of SobiAdminForm table -->
		</table>

		<?php
    	if( $config->key( "edit_form", "cats_selection_adm", true ) ) {
			$tabs->endTab();
			$tabs->startTab(_SOBI2_CATEGORIES_H,"cats");
			echo "<table class='SobiAdminForm' width='100%'>" .
					"<tr>" .
					"<th colspan='2'>" ._SOBI2_CATEGORIES_H.
					"</th>" .
					"</tr>" .
					"<tr><td style='vertical-align: top;' colspan='2'>" .
					"{$this->dTree}" .
					"</td></tr>" .
					"</table>";
	    	}
	    	else {
	    		if( $f = $config->key( "edit_form", "edittab_callback_func", false ) && function_exists( $f )) {
	    			$sobi2SlectedCats = call_user_func( $f, $tabs );
	    		}
	    	}
			$tabs->endTab();
			$tabs->startTab(_SOBI2_IMAGES_U,"imgs");
			if($this->item && strlen($this->item->image) != 0) {
				$img = $config->liveSite.$config->imagesFolder.$this->item->image;
				$img = "<img src='{$img}' style='padding:20px;' alt='' />";
				$rmChkbxImg = "<input type='checkbox' name='sobi2ImgDelete' id='sobi2ImgDelete' value='1' onclick=" .
						"'if(!this.checked) { " .
						"    sobi2Img.value = \"\" ;" .
						"    sobi2Img.disabled = false" .
						"} else {" .
						"    sobi2Img.value = \"\";" .
						"    sobi2Img.disabled = true" .
						"}'/>" .
						"<label for='sobi2ImgDelete'>"._SOBI2_FORM_IMG_REMOVE_LABEL."</label>";
			}
			else {
				$img = null;
				$rmChkbxImg = null;
			}
			if($config->allowUsingImg == 2){
				$nfo_txt = _SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": ".$config->priceForImg." ".$config->currency;
				$img = "administrator/components/com_sobi2/images/nfo.png";
				$notFreeImg = sobiHTML::toolTip( $nfo_txt, _SOBI2_FORM_NOT_FREE_OPTION, null, $img, "" );
			}
			else {
				$notFreeImg = null;
			}
			if($config->allowUsingIco == 2){
				$nfo_txt = _SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": ".$config->priceForIco." ".$config->currency;
				$img = "administrator/components/com_sobi2/images/nfo.png";
				$notFreeIco = sobiHTML::toolTip( $nfo_txt, _SOBI2_FORM_NOT_FREE_OPTION, null, $img, "" );
			}
			else $notFreeIco = null;

			if($this->item && strlen($this->item->icon) != 0) {
				$ico = $config->liveSite.$config->imagesFolder.$this->item->icon;
				$ico = "<img src='{$ico}' style='padding:20px;' alt='' />";
				$rmChkbxIco = "<input type='checkbox' name='sobi2IcoDelete' id='sobi2IcoDelete' value='1' onclick=" .
						"'if(!this.checked) { " .
						"    sobi2Ico.value = \"\" ;" .
						"    sobi2Ico.disabled = false" .
						"} else {" .
						"    sobi2Ico.value = \"\";" .
						"    sobi2Ico.disabled = true" .
						"}'/>" .
						"<label for='sobi2IcoDelete'>"._SOBI2_FORM_ICO_REMOVE_LABEL."</label>";
			}
			else {
				$ico = null;
				$rmChkbxIco = null;
			}
		?>
  			<table class="SobiAdminForm" width="100%">
				<tr>
					<th>
						<?php echo _SOBI2_IMAGES_U ?>
					</th>
				</tr>
				<tr>
					<td>
						<h2><?php echo $config->efImgLabel; ?></h2>
						<?php echo $img ?>
						<br/>
						<?php echo $rmChkbxImg ?>
						<br/>
						<?php echo $notFreeImg ?>
						<input name="sobi2Img" id="sobi2Img" class="inputbox" type="file" size="20" maxlength="100000" accept="text/*"/>
						<br/>
						<br/>
						<br/>
						<hr/>
						<br/>
						<h2><?php echo $config->efIcoLabel; ?></h2>
						<?php echo $ico ?>
						<br/>
						<?php echo $rmChkbxIco ?>
						<br/>
						<?php echo $notFreeIco ?>
						<input name="sobi2Ico" id="sobi2Ico" class="inputbox" type="file" size="20" maxlength="100000" accept="text/*"/>
					</td>
				</tr>
			</table>
		<?php
			$tabs->endTab();
			$tabs->startTab(_SOBI2_META_U,"meta");
			if($this->item && isset($this->item->metadesc))
				$metaDesc = $this->item->metadesc;
			else
				$metaDesc = null;
			if($this->item && isset($this->item->metakey))
				$metaKey = $this->item->metakey;
			else
				$metaKey = null;
		?>
  			<table class="SobiAdminForm" width="100%">
				<tr>
					<th>
						<?php echo _SOBI2_META_U ?>
					</th>
				</tr>
				<tr>
					<td>
						<div style="text-align:left;">
						<br/>
						<?php echo _SOBI2_FORM_META_DESC_LABEL ?>
						<br/>
						<textarea class="text_area" cols="30" rows="3" style="width: 350px; height: 100px" name="sobi2Metadesc"  id="sobi2MetaDesc"><?php echo $metaDesc ?></textarea
						><br/><br/>
						<?php echo _SOBI2_FORM_META_KEYS_LABEL ?>
						<br/>
						<textarea class="text_area" cols="30" rows="3" style="width: 350px; height: 100px" name="sobi2MetaKey"  id="sobi2MetaKey"><?php echo $metaKey ?></textarea>
						</div>
					</td>
				</tr>
			</table>
		<?php
			$tabs->endTab();
			$tabs->startTab(_SOBI2_PUBLISHING_U,"publishing");
			$active = ( intval( $this->item->owner ) ? intval( $this->item->owner ) : 0 );
			sobi2Config::import( 'includes|adm.helper.class', 'adm' );
			$owner = sobi2AdmHelper::userSelect( 'created_by', $active, 1, null, 'name', 0 );
			$config->loadCalendar( null, "system");
			if ( $this->item->id == 0 ) {
				$itemInfoVisibility = "style='display: none; visibility: hidden;'";
			} else {
				$itemInfoVisibility = "";
			}

			if ( !$this->item->hits ) {
				$visibility = "style='display: none; visibility: hidden;'";
			} else {
				$visibility = "";
			}
		?>
  				<table class="SobiAdminForm" width="100%">
				<tr>
					<th colspan="2">
						<?php echo _SOBI2_PUBLISHING_U ?>
					</th>
				</tr>
			    <tr>
			      <td width="20%"><?php echo _SOBI2_PUBLISHED ?>: </td>
			      <td><input type="checkbox" name="published" value="1" <?php echo $this->item->published ? 'checked="checked"' : ''; ?> /></td>
			    </tr>
			    <tr>
			      <td width="20%"><?php echo _SOBI2_APPROVED ?>: </td>
			      <td><input type="checkbox" name="approved" value="1" <?php echo $this->item->approved ? 'checked="checked"' : ''; ?> /></td>
			    </tr>
			    <tr>
			      <td width="20%"><?php echo _SOBI2_LISTING_OWNER ?>: </td>
			      <td><?php echo $owner ?></td>
			    </tr>
			    <tr>
			      <td width="20%"><?php echo _SOBI2_LISTING_ADDED ?>: </td>
			      <td>
			      	<input type="text" class="text_area" name="added_date" id="added_date" value="<?php echo $this->item->publish_up ?>" size="25" maxlength="19"/>
			      	<input name="reset" type="reset" class="button" id="added_date_bt" onclick="return showSobiCalendar('added_date', 'added_date_bt', 'y-mm-dd');" value="..." />
			      </td>
			    </tr>
			    <tr>
			      <td width="20%"><?php echo _SOBI2_LISTING_EXPIRES ?>: </td>
			      <td>
			      	<input type="text" class="text_area" name="exp_date" id="exp_date" value="<?php echo $this->item->publish_down ?>" size="25" maxlength="19"/>
			      	<input name="reset" type="reset" class="button" id="exp_date_bt" onclick="return showSobiCalendar('exp_date', 'exp_date_bt', 'y-mm-dd');" value="..." />
			      </td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>><?php echo _SOBI2_LISTING_OWNER ?> IP: </div></td>
			      <td><b><?php echo $this->item->ip ?></b></td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>><?php echo _SOBI2_LISTING_UPDATING_USER ?>: </div></td>
			      <td><div <?php echo $itemInfoVisibility; ?>><b><?php echo $this->item->updaterName ?></b></div></td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>><?php echo _SOBI2_LISTING_UPDATING_USER ?> IP: </div></td>
			      <td><div <?php echo $itemInfoVisibility; ?>><b><?php echo $this->item->updatingIp ?></b></div></td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>><?php echo _SOBI2_UPDATED_AT ?>: </div></td>
			      <td><div <?php echo $itemInfoVisibility; ?>><b><?php echo $this->item->lastUpdate ?></b></div></td>
			    </tr>
			    <tr>
			      <td colspan="2"><div <?php echo $itemInfoVisibility; ?>><hr/></div></td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>>SobiID: </div></td>
			      <td><b><?php echo $this->item->id?></b></td>
			    </tr>
			    <tr>
			      <td width="20%"><div <?php echo $itemInfoVisibility; ?>><?php echo _SOBI2_HITS ?>: </div></td>
			      <td><div <?php echo $itemInfoVisibility; ?>><b id="hits"><?php echo $this->item->hits ?></b></div></td>
			    </tr>
			    <tr>
			      <td width="20%">
			      <script type="text/javascript">
			      	function resethits() {
			      		document.getElementById('hits_counter').value = 0;
			      		var nullCounter = document.createTextNode('0');
			      		document.getElementById('hits').removeChild(document.getElementById('hits').firstChild);
			      		document.getElementById('hits').appendChild(nullCounter);
			      	}
			      </script>
			      </td>
			      <td>
   					<div <?php echo $visibility; ?>>
						<input name="reset_hits" type="button" class="button" value="<?php echo _SOBI2_HITS_RESET ?>" onclick="resethits();" />
					</div>
				  </td>
			    </tr>
			  </table>
		<?php
			$tabs->endTab();
			$tabs->startTab(_SOBI2_CONFIG_GENERAL_BACKGROUNDS,"background");
		?>
  			<table class="SobiAdminForm" width="100%">
				<tr>
					<th colspan="2">
						<?php echo _SOBI2_CONFIG_GENERAL_BACKGROUNDS ?>
					</th>
				</tr>
			    <tr>
			      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_GENERAL_BACKGROUND;?></td>
			      <td valign="top" width="80%" style="height: 60px;">

					<?php
						if($this->item && isset($this->item->background))
							$selected = $this->item->background;
						else
							$selected = null;
						$javascript = "onchange=\"if (this.options[selectedIndex].value!='')" .
								"{" .
								" document.backgroundimage.src='../components/com_sobi2/images/backgrounds/' + this.options[selectedIndex].value;" .
								"} " .
								"else " .
								"{" .
								"  document.a.src='../images/blank.png'" .
								"}\"";
						echo sobi2AdmHelper::amImages( 'backgroundimage', $selected, $javascript, '/components/com_sobi2/images/backgrounds/' );
					 ?>
					 </td>
				</tr>
				<tr>
					<td valign="top" width="20%"></td>
					<td valign="top" >
						<script type="text/javascript"><!--	/* <![CDATA[ */
							if (document.forms[0].backgroundimage.options.value!=''){
							  bsimg='../components/com_sobi2/images/backgrounds/' + getSelectedValue( 'adminForm', 'backgroundimage' );
							} else {
							  bsimg='../images/M_images/blank.png';
							}
							document.write('<img src=' + bsimg + ' name="backgroundimage" width="50" height="50" border="2" alt="Preview" />');
						/* ]]> */ // --></script>
				  </td>
			    </tr>
			</table>
		<?php
			$tabs->endTab();
			if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	   				if(method_exists($plugin, "addEditEntryTab")) {
	    				$plugin->addEditEntryTab($this->sobi2Id, $tabs);
	   				}
	    		}
			}
			$tabs->endPane();
			if( !$this->item->id ) {
				echo "\n<script type=\"text/javascript\">\n <!-- \n/* <![CDATA[ */ \n document.getElementById('sobi2SlectedCats').options[0] = null; \n  document.getElementById('sobi2SlectedCatsID').options[0] = null; /* ]]> */ \n // --> \n </script>\n";
			}
		?>

		<?php echo $this->getPlugins() ?>
		<input type="hidden" name="hits_counter" id="hits_counter" value="<?php echo $this->item->hits ?>"/>
		<input type="hidden" id="selectedCat" value=""/>
		<input type="hidden" id="selectedCatID" value=""/>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="catid" value="<?php echo $catId ?>" />
		<input type="hidden" name="sobi2Id" value="<?php echo $this->item->id ?>" />
		<input type="hidden" name="editing" value="item" />
		<input type="hidden" name="returnTask" value="<?php echo $returnTask ?>&amp;catid=<?php echo $catId ?>"/>
		</form>
		<?php
			$this->addToJsValidator(null, 1);
			echo $this->jsValidator;
	}
   function getCategories()
   {
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
    	$onSelctedCatJs = "\n<script type='text/javascript'>" .
    					  "\n\t" .
    					  "function onSelectedCat(intro, category, id) { " .
    					  "\n\t\t" .
    					  "var catInfo = document.createTextNode(intro);" .
    					  "\n\t\t" .
    					  "document.getElementById('catIntroText').removeChild(document.getElementById('catIntroText').firstChild);" .
    					  "\n\t\t" .
    					  "document.getElementById('catIntroText').appendChild(catInfo);" .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCat').value = category;" .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCatID').value = id;" .
    					  "\n\t }" .
    					  "\n\t" .
    					  "function addCategory() {" .
    					  "\n\t\t" .
    					  "\n\t\t\t if(document.getElementById('selectedCatID').value == '') {" .
    					  "\n\t\t\t\t alert('"._SOBI2_FORM_SELECT_CATEGORY."');" .
    					  "\n\t\t\t\t return false;" .
    					  "\n\t\t\t }" .
    					  "for(var a = 0; a < document.getElementById('sobi2SlectedCats').length; ++a) {" .
    					  "\n\t\t\t" .
    					  "\n\t\t\t if(document.getElementById('selectedCatID').value == document.getElementById('sobi2SlectedCatsID')[a].value) {" .
    					  "\n\t\t\t\t alert('"._SOBI2_FORM_JS_CAT_ALLREADY_ADDED."');" .
    					  "\n\t\t\t\t return false;" .
    					  "\n\t\t\t }" .
    					  "\n\t\t }" .
    					  "\n\t\t" .
    					  "if(document.getElementById('sobi2SlectedCats').length >= ({$config->maxCatsForEntry}) )" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2AddCatBt').disabled = true;" .
    					  "\n\t\t" .
    					  "newNode = new Option(document.getElementById('selectedCat').value, document.getElementById('selectedCat').value, true, true);" .
    					  "\n\t\t" .
    					  "newNodeID = new Option(document.getElementById('selectedCatID').value, document.getElementById('selectedCatID').value, true, true);" .
    					  "\n\t\t" .
    					  "if(document.getElementById('selectedCat').value != '')" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[document.getElementById('sobi2SlectedCats').length] = newNode;" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[document.getElementById('sobi2SlectedCatsID').length] = newNodeID;" .
    					  "for(var a = 0; a < document.getElementById('sobi2SlectedCats').length; ++a) {" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[a].selected = false;" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[a].selected = false;" .
    					  "\n\t\t }" .
						  "\n\t }" .
    					  "\n\t" .
    					  "function removeCategory() {" .
    					  "\n\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[document.getElementById('sobi2SlectedCats').selectedIndex] = null;" .
    					  "\n\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[document.getElementById('sobi2SlectedCatsID').selectedIndex] = null;" .
    					  "\n\t\t" .
						  "if(document.getElementById('sobi2SlectedCats').length <= ({$config->maxCatsForEntry} + 1) && document.getElementById('sobi2AddCatBt').disabled == true)" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2AddCatBt').disabled = false;" .
    					  "\n\t }" .
    					  "\n</script>";
    	$config->addCustomHeadTag($onSelctedCatJs);

    	$query = "SELECT  cats.catid,  parentid, name,  introtext,  ordering " .
    			 "FROM `#__sobi2_cats_relations` AS rel " .
    			 "LEFT JOIN `#__sobi2_categories` AS cats ON rel.catid = cats.catid " .
    			 "WHERE published = 1";
    	$database->setQuery( $query );
    	$this->categoryList = $database->loadObjectList();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	$this->dTree = null;
    	if( count($this->categoryList) ) {
	    	/*
	    	 * list of categories prices
	    	 */
	    	if($config->maxCatsForEntry == 1) {
	    		$categories = _SOBI2_CATEGORY_L;
	    	}
	    	else if($config->maxCatsForEntry > 1) {
	    		$categories = _SOBI2_CATEGORIES_L;
	    	}
	    	$this->dTree = $this->dTree."<table id='sobi2FormCats'>" .
	    								"\n\t\t\t\t\t<tr>" .
	    								"\n\t\t\t\t\t\t<td colspan='3'>" .
	    								"\n\t\t\t\t\t\t\t " . _SOBI2_FORM_SELECT_CATEGORY .
	    								"\n\t\t\t\t\t\t\t <p id='catMsg'>" . _SOBI2_FORM_CAN_ADD_TO_NR_CATS ;
			if( array_sum( $config->catPrices) > 0 ) {
		    	$catsListPrices = "\n\t\t\t\t\t\t\t\t<ul>";
	    		$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t\t<li>" .
	    										  "\n\t\t\t\t\t\t\t\t\t\t" .
	    										  "1) "._SOBI2_FORM_CAT_1." "._SOBI2_IS_FREE_L."" .
	    										  "\n\t\t\t\t\t\t\t\t\t</li>";

		    	for($i = 2; $i < ($config->maxCatsForEntry+1); $i++) {
		    		$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t\t<li>" .
		    										  "\n\t\t\t\t\t\t\t\t\t\t" .
		    										  "${i}) "._SOBI2_CATEGORY_H." {$i} ";

					if($config->catPrices[$i] == 0) {
						$catsListPrices = $catsListPrices._SOBI2_IS_FREE_L;
					}
					else {
						$config->catPrices[$i] = number_format($config->catPrices[$i], 2, $config->curencyDecSeparator, ' ');
						$catsListPrices = $catsListPrices." "._SOBI2_IS_NOT_FREE_L." "._SOBI2_COST_L.": ".$config->catPrices[$i]. " {$config->currency}";
					}
		    		$catsListPrices = $catsListPrices. "\n\t\t\t\t\t\t\t\t\t</li>";
		    	}
		    	$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t</ul>";
		    	$this->dTree = $this->dTree.$catsListPrices;
			}
	    	$this->dTree = $this->dTree."</p>" .
	    								"\n\t\t\t\t\t\t</td>" .
	    								"\n\t\t\t\t\t</tr>" .
	    								"\n\t\t\t\t\t<tr>" ;

	    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t <td>";
		    	$this->dTree = $this->dTree."" .
		    					"\n<div class=\"dtree\">" .
		    					"\n<script type='text/javascript'>" .
		    					"\n\t" .
		    					"sobi2Cats = new dTree('sobi2Cats');" .
		    					"\n\t" .
		    					"sobi2Cats.add(0,-1,'"._SOBI2_CATEGORIES_H."');";

		    	foreach( $this->categoryList as $category ) {
					$category->name = $config->jsAddSlashes($config->getSobiStr($category->name));
					$category->introtext = $config->jsAddSlashes($config->getSobiStr($category->introtext));
					$category->introtext = str_replace('\"', "`", $category->introtext );
					$category->name = str_replace('\"', "`", $category->name );
					$category->introtext = str_replace('\'', "`", $category->introtext );
					$category->name = str_replace('\'', "`", $category->name );
					$category->name = str_replace('x26', "&", $category->name );
					$category->introtext = str_replace('x26', "&", $category->name );

					if($category->parentid == 1)
						$category->parentid--;
		    		$href = "javascript:onSelectedCat(\'{$category->introtext}\',\'{$category->name}\',\'{$category->catid}\' )";
		    		$this->dTree = $this->dTree."\n\t sobi2Cats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/components/com_sobi2/images/folder.gif' ,'{$config->liveSite}/components/com_sobi2/images/folderopen.gif');";
		    	}


		    	$this->dTree = $this->dTree."\n\t document.write(sobi2Cats); \n </script> \n </div>" .
		    		    				"\n\t\t\t\t\t\t</td>" .
				/* select and remove buttons */
		    		    				"\n\t\t\t\t\t\t<td style='vertical-align: top; align: right;'>" .
		    		    				"\n\t\t\t\t\t\t\t <p style='text-align:right; padding-right: 2px; margin-top: 1px;'>"._SOBI2_SELECTED_CATS.": </p>" .
										"\n\t\t\t\t\t\t\t <p><input type='button' class='button' onclick='addCategory();' id='sobi2AddCatBt' value='>>>'/></p>" .
		    		    				"\n\t\t\t\t\t\t\t <p><input type='button' class='button' onclick='removeCategory();' id='sobi2RemoveCatBt'value='<<<'/></p>" .
		    		    				"\n\t\t\t\t\t\t</td>" ;

				/* select list for selected categories */
				$this->dTree = $this->dTree."\n\t\t\t\t\t\t<td style='vertical-align: top;'>" ;
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t<td style='vertical-align: top;'>\n\t\t\t\t\t\t\t"._SOBI2_CAT_NAME."<br/><select id='sobi2SlectedCats' name='sobi2SlectedCats[]' size='5' onclick='for(var a = 0; a < document.getElementById(\"sobi2SlectedCatsID\").length; ++a) document.getElementById(\"sobi2SlectedCatsID\")[a].selected=false; document.getElementById(\"sobi2SlectedCatsID\").options[this.selectedIndex].selected=true;'>";
		    	/*
		    	 * if editing existing entry add selected categories
		    	 */
		    	if($this->item) {
		    		foreach($this->item->myCategories as $catid => $catname) {
		    			$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t\t<option>{$catname}</option>";
		    		}
		    	}
		    	$this->dTree .= "\n\t\t\t\t\t\t\t\t<option style='display:none;'></option>";
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t</select></td>";
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t<td style='vertical-align: top;'>Cat ID <br/><select multiple=\"multiple\" class=\"inputbox\" disabled id=\"sobi2SlectedCatsID\" name=\"sobi2SlectedCatsID[]\" size=\"5\">";
		    	if($this->item) {
		    		foreach($this->item->myCategories as $catid => $catname) {
		    			$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t\t<option value='$catid'>{$catid}</option>";
		    		}
		    	}
				$this->dTree .= "\n\t\t\t\t\t\t\t\t<option style='display:none;'></option>";
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t</td>".
		    		    					"\n\t\t\t\t\t</tr>";

				$this->dTree = $this->dTree."\n\t\t\t\t\t<tr>" .
		    		    				"\n\t\t\t\t\t\t<td colspan='3'>" .
	    								_SOBI2_FORM_SELECTED_CAT_DESC.
	    								"<p id='catIntroText'>&nbsp;</p>".
	    								"\n\t\t\t\t\t\t </td>".
		    							"\n\t\t\t\t\t </tr>" .
		    							"\n\t\t\t\t </table>";
    	}
    }

    /**
     * adding and build the required fields into js validator
     */
    function addToJsValidator($field, $end = 0) {
		$config =& adminConfig::getInstance();
		$mainframe =& $config->getMainframe();

    	/*
    	 * start of java script
    	 */

    	if($this->jsValidator == null) {
    		$this->jsValidator = "\n" .
    							 "<script type='text/javascript'><!--\n/* <![CDATA[ */\n" .
    							 "\n\t function submitbutton(pressbutton) {".
						 		 "\n\t\t var form = document.adminForm;" .
		    					 "\n\t\t ";
			if( $config->key( "edit_form", "cats_selection_adm", true ) ) {
		    	$this->jsValidator .= 	"\n\t\t document.getElementById('sobi2SlectedCatsID').disabled = false;" .
    							 		"\n\t\t for(var a = 0; a < document.getElementById('sobi2SlectedCatsID').length; ++a) {" .
    							 		"\n\t\t\t" .
    							 		"document.getElementById('sobi2SlectedCatsID')[a].selected=true;" .
    							 		"\n\t\t } " .
								 		"\n\t\t if (document.getElementById('sobi2SlectedCats' ).length < 1  && pressbutton != 'cancel') {" .
								 		"\n\t\t\t alert( '"._SOBI2_FORM_JS_SELECT_CAT."' );" .
								 		"\n\t\t }" .
								 		"\n\t\t else if (form.field_entry_name.value == '' && pressbutton != 'cancel') {" .
								 		"\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
								 		"\n\t\t }";
			}
			else {
	    		if( $f = $config->key( "edit_form", "cat_select_callback_func", false ) && function_exists( $f )) {
	    			$this->jsValidator .= call_user_func( $f );
	    		}
				$this->jsValidator .= "\n\t\t if (form.field_entry_name.value == '' && pressbutton != 'cancel') {" .
									  "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
									  "\n\t\t\t return false;" .
									  "\n\t\t }";

			}
    	}
		/*
		 * end of java script
		 */
		if($end != 0) {
			$this->jsValidator = $this->jsValidator."\n\t\t else {" .
													"\n\t\t\t submitform( pressbutton );" .
													"\n\t\t }" .
													"\n\t }" .
													"\n/* ]]> */\n// -->\n</script>";
			/*
			 * add script to page header
			 */
			$mainframe->addCustomHeadTag($this->jsValidator);
		}
		/*
		 * when adding a new required field
		 */
		else {
			switch ($field->fieldType) {
				case 1: // is textfield
					$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.value == ''  && pressbutton != 'cancel') {" .
										"\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										"\n\t\t }";
					break;
				case 2: // is textarea
					if(!$field->wysiwyg)
						$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.value == ''  && pressbutton != 'cancel') {" .
											"\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."'  );" .
											"\n\t\t }";
					break;
				case 5: //is list
					$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.selectedIndex == 0  && pressbutton != 'cancel') {" .
										"\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										"\n\t\t }";
					break;
				case 6: // is textfield
					static $fn = false;
					if(!$fn) {
						$config->addCustomScript('
						function  checkCheckBoxes( fname ) {
							var e = document.getElementsByName( fname );
							var ch = false;
							for( i = 0; i < e.length; i++ )
								ch = e[i].checked == true ? e[i].checked : ch;
							return ch;
						}
						');
						$fn = true;
					}
					$this->jsValidator = $this->jsValidator."\n\t\t else if ( !checkCheckBoxes(\"{$field->fieldname}[]\") && pressbutton != 'cancel' ) {" .
										"\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										"\n\t\t }";
					break;
				default:
					break;
			}
		}
    }
}
?>