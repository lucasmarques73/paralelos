<?php
/**
* @version $Id: custom.listing.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
 * no direct access
 */
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobiCListings {
    /**
     * Custom mixed cats and items listing, based on two gived arrays with all ids
     *
     * @param array $sids 						sobi2 id's
     * @param array $cids						categories id's
     * @param string $navMenuUrl				url for page navigation
     * @param string $customHeader				header to display after component header
     * @param string $stringForItems			header to display before items listing
     * @param string $stringForCats				header to display before categories listing
     * @param string $addToPathway				text to add to pathway
     * @param string $addToSiteTitle			text to add to site title
     * @param int $defCid						default category id for items links
     * @param string $pluginTask				task for plugin action - method name
     * @param string $itemsOrdering				ordering for items
     * @param string $catsOrdering				ordering for categories
     * @param array $pluginsArgs				additional arguments for plugin
     * @param bool $forceUnpublishedItems		show also unpublished items
     * @param bool $forceUnpublishedCats		show also unpublished categories
     * @param bool $skipHeader					skip to display header
     * @param bool $skipFooter					skip to display footer
     * @param string $templateFunction			callback function for template
     * @param int $itemsInLine					number of items in single line
     * @return string
     */
    function buildCustomListing( $sids, $cids, $navMenuUrl, $customHeader = null, $stringForItems = null, $stringForCats = null, $addToPathway = null, $addToSiteTitle = null,  $defCid = 0, $pluginTask = null, $itemsOrdering = null, $catsOrdering = null, $pluginsArgs = null, $forceUnpublishedItems = false, $forceUnpublishedCats = false, $skipHeader = false, $skipFooter = false, $templateFunction = null, $itemsInLine = 0, $preventPlugins = false, $forceCache = false )
    {
    	$config 					=& sobi2Config::getInstance();
		$my 						=& $config->getUser();
		$mainframe					=& $config->getMainframe();
    	$database					=& $config->getDb();
		$sobi2Frontend 				=& $config->getFrontend();
        $fieldsFormated 			= array();
        $fieldsObjects 				= array();
    	$now 						= $config->getTimeAndDate();
		$pluginOutput 				= null;
		$pluginOutputPosition 		= null;
		$navigation 				= null;
		$sids 						= ( !is_array( $sids ) || empty( $sids ) ) ? array() : $sids;
		$cids 						= ( !is_array( $sids ) || empty( $cids ) ) ? array() : $cids;
		$itemsInLine 				= $itemsInLine ? $itemsInLine : $config->itemsInLine;

		if( $pluginTask ) {
			if( count( $config->S2_plugins ) ) {
	    		foreach( $config->S2_plugins as $plugin ) {
	    			if( method_exists( $plugin, $pluginTask ) ) {
	    				$plugin->$pluginTask( $sids, $cids, $itemsOrdering, $catsOrdering, $pluginOutput, $pluginOutputPosition, $pluginsArgs );
	    			}
	    		}
	    	}
		}
		$pluginsOutput = array();
		if( !$preventPlugins && count( $config->S2_plugins ) ) {
    		$addToCount = 0;
			foreach( $config->S2_plugins as $plugin ) {
    			if( method_exists( $plugin, "customListing" ) ) {
    				$plugin->customListing( $sids, $cids, $itemsOrdering, $catsOrdering, $pluginOutput, $pluginOutputPosition, $pluginsOutput, $addToCount );
    			}
    		}
    	}

		if( $addToPathway ) {
			if( is_array( $addToPathway ) ) {
				foreach ( $addToPathway as $value ) {
					$config->appendPathWay( $value );
				}
			}
			else {
				$config->appendPathWay($addToPathway);
			}
		}

		if($addToSiteTitle) {
			$pageTitle = $config->componentName." - ".$addToSiteTitle;
			$mainframe->setPageTitle( html_entity_decode( $pageTitle ) );
		}

		if( !isset( $sobi2Frontend ) ) {
			if( !defined( '_SOBI_MAMBO' ) ) {
				$menu = $mainframe->get( 'menu' );
				$params =& sobi2bridge::jParams( $menu->params );
				$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
				$params->def( 'pageclass_sfx', '' );
			}
			else {
				$params = new stdClass();
				if ( $config->sobi2Itemid ) {
					$menu =& sobi2bridge::jMenu( $database );
					$menu->load( $config->sobi2Itemid );
					$params =& sobi2bridge::jParams( $menu->params );
				} else {
					$menu = null;
					$params =& new mosEmpty();

				}
				$params->def( 'pageclass_sfx', '' );
				$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
			}
			$sobi2Frontend =  new frontend( $defCid, $params, '' );
		}

		if( !$skipHeader ) {
			$header = $sobi2Frontend->getHeader();
		}
		else {
			$header = null;
		}
		if(!$skipFooter) {
			$footer = $sobi2Frontend->getFooter();
		}
		else {
			$footer = null;
		}

		$listing = null;

		if($header) {
			$listing .= $header;
		}

		if($pluginOutput && $pluginOutputPosition == "first") {
			$listing .= $pluginOutput;
		}
		if(!empty($pluginsOutput)) {
			foreach ($pluginsOutput as $o) {
				if($o["position"] == "first") {
					$listing .= $o["output"];
				}
			}
		}
		if($customHeader) {
    		$listing .= "\n\t\t<div class=\"sobi2CustomListingHeader\">{$customHeader}</div>";
    	}

		if($pluginOutput && $pluginOutputPosition == "beforeCats") {
			$listing .= $pluginOutput;
		}
		if(!empty($pluginsOutput)) {
			foreach ($pluginsOutput as $o) {
				if($o["position"] == "beforeCats") {
					$listing .= $o["output"];
				}
			}
		}
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			if(method_exists($plugin, "onCategoryList")) {
					$plugin->onCategoryList( $cids );
    			}
    		}
		}
    	if( ( is_array( $cids ) && !empty( $cids ) ) || ( $pluginOutput && $pluginOutputPosition == "afterCats" || ( is_array( $pluginsOutput ) && !empty( $pluginsOutput ) ) ) ) {
	    	if($stringForCats) {
	    		$listing .= "\n\t\t<div class=\"sobi2CustomListingCatsHeader\">{$stringForCats}</div>";
	    	}
	    	if( ( is_array( $cids ) && !empty( $cids ) ) ) {
		    	$published = $forceUnpublishedCats ? null : "AND published = 1";
		    	$cids = (!empty($cids)) ? implode(" , ", $cids) : null;
				$ordering = $catsOrdering ? " ORDER BY {$catsOrdering} " : null;
		    	$query = "SELECT * FROM #__sobi2_categories WHERE catid IN({$cids}) {$published} {$ordering}";
				$database->setQuery($query);
				$results = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("HTML_SOBI::buildCustomListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
	    	}
			if( isset( $results ) && count( $results ) ) {
				if( $config->isset_( "curDisplCatsList" ) ) {
					$curCats =& $config->get_( "curDisplCatsList" );
					$curCats = array_intersect( $curCats, $results );
				}
				else {
					$config->set_( "curDisplCatsList", $results );
				}
				/* if cached */
				$requestParams =& $config->get_( "requestParams" );
				if( $config->cacheL2Enabled && $cachedListing = $config->sobiCache->getContent( $requestParams, "catlist")) {
					$listing .= $cachedListing;
				}
				else {
					if( $results && !empty( $results ) ) {
						$out = null;
						$tdTrCounter = 0;
						$out .= "\n\t<table id=\"sobi2CatListSymbols\">";
						$out .="\n\t\t<tr>";

						$width = 100/$config->catsListInLine;
						$width = "style=\"width: {$width}%;\"";

						foreach($results as $result) {
							$countItems = null;
							if($tdTrCounter%$config->catsListInLine == 0 && $tdTrCounter != 0) {
									$out .="\n\t\t\t</tr>\n\t\t\t<tr>";
							}
							$out .= "\n\t\t\t\t<td $width>";
							$tdTrCounter++;

							$href = "index.php?option=com_sobi2&amp;catid={$result->catid}&amp;Itemid={$config->sobi2Itemid}";
							$href = sobi2Config::sef($href);
							if($config->showCatItemsCount) {
								$countItems = $sobi2Frontend->countItemsInCat($result->catid, $result->name);
							}
							$result->name = $config->getSobiStr($result->name);
							$result->name = sobi2Config::replaceEntities($result->name);
							$result->introtext = $config->getSobiStr($result->introtext);
							$result->introtext = sobi2Config::replaceEntities($result->introtext);

							$task = sobi2Config::request($_REQUEST, 'sobi2Task', null);
							if( !$task ) {
					 			$letter = sobi2Config::request($_REQUEST, 'letter', null);
					 			if($letter) {
					 				$task = "alphaListing";
					 			}
							}
							$subcatsIgnore = $config->key( "frontpage", "subcats_ignore", null );
							if( $subcatsIgnore ) {
								$subcatsIgnore = explode( ",", $subcatsIgnore );
							}
							if( $config->subcatsShow && !( is_array( $subcatsIgnore ) && in_array( $task, $subcatsIgnore ) ) ) {
								$limit = $config->subcatsNumber;
								$limit = $config->key( "frontpage", "subcats_tbc", true ) ? ++$limit : $limit;
								$query = "SELECT scat.name, scat.introtext, scat.catid FROM #__sobi2_cats_relations AS srel LEFT JOIN #__sobi2_categories AS scat ON srel.catid = scat.catid WHERE srel.parentid = {$result->catid} AND scat.published = 1 ORDER BY {$config->subcatsOrdering} LIMIT {$limit}";
								$database->setQuery( $query );
								$subcats = array();
								$res = $database->loadObjectList();
								if ($database->getErrorNum()) {
									trigger_error("frontend::buildCatListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
								}
								$tbc = false;
								if( count( $res ) >  $config->subcatsNumber ) {
									unset( $res[ $config->subcatsNumber ] );
									$tbc = true;
								}
								if( $res && !empty( $res ) ) {
									foreach ( $res as $subcat ) {
										$h = sobi2Config::sef("index.php?option=com_sobi2&amp;catid={$subcat->catid}&amp;Itemid={$config->sobi2Itemid}");
										$t = sobiHTML::cleanText( $subcat->introtext );
										$subcat->name = $config->getSobiStr( $subcat->name );
										$subcats[] = "<span class=\"sobi2SubcatsListItems\"><a href=\"{$h}\" title=\"{$t}\">{$subcat->name}</a></span>";
									}
								}
								if( !empty( $subcats ) ) {
									$subcats = implode( $config->key( "frontpage", "subcats_delimiter", ", "), $subcats );
									if( $tbc ) {
										$subcats .= "<span class=\"sobi2SubcatsListItems\"><a href=\"{$href}\" title=\"{$result->name}\">".$config->key( "frontpage", "subcats_tbc", " ... " )."</a></span>";
									}
									$subcats = "<span class=\"sobi2SubcatsList\">{$subcats}</span>";
									$result->introtext .= $subcats;
								}
							}
							if($result->icon && strlen($result->icon) > 0) {
								if(file_exists(_SOBI_CMSROOT.$config->catImagesFolder.$result->icon)) {
									$img = $config->liveSite.$config->catImagesFolder.$result->icon;
									if(stristr( $img, ".png" )) {
										$img = sobi2Config::checkPNGImage( $img, "{$result->name}", "float:left; border-style:none;", "sobi2CatIco" );
									}
									else {
										$img = "<img src=\"{$img}\" class=\"sobi2CatIco\" alt=\"{$result->name}\"/>";
									}
									$out .= "\n\t\t\t\t\t<a href=\"{$href}\">{$img}</a>";
								}
							}
							$out .="\n\t\t\t\t\t<p class=\"sobi2CatName\"><a href=\"{$href}\">{$result->name}</a>{$countItems}</p>";
							$out .="\n\t\t\t\t\t<p class=\"sobi2CatsListSymbolsIntrotext\">{$result->introtext}</p>" .
									"\n\t\t\t\t</td>";
						}
						if($tdTrCounter%$config->catsListInLine != 0) {
						 	$colspan = $config->catsListInLine - ($tdTrCounter%$config->catsListInLine);
				    		if( ($f = $config->key( "frontpage", "cat_empty_cell_calback_function", false )) && function_exists( $f )) {
				    			$ecell = call_user_func( $f );
				    		}
				    		else {
				    			$ecell = "&nbsp;";
				    		}
							$out .= "\n\t\t\t\t<td class=\"sobi2EmptyCell\" colspan=\"{$colspan}\">\n\t\t\t\t\t{$ecell}\n\t\t\t\t</td>";
						}
						$out .= "\n\t\t</tr>\n\t</table>\n <br/>";
						$listing .= $out;
						if( $config->cacheL2Enabled ) {
						 	$config->sobiCache->addContent( $out, $requestParams, "catlist" );
						}

					}
				} // if not caching ende
	    	}
    	}
    	unset( $results );
		if($pluginOutput && $pluginOutputPosition == "afterCats") {
			$listing .= $pluginOutput;
		}
		if(!empty($pluginsOutput)) {
			foreach ($pluginsOutput as $o) {
				if($o["position"] == "afterCats") {
					$listing .= $o["output"];
				}
			}
		}
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			if(method_exists($plugin, "onEntriesList")) {
					$plugin->onEntriesList( $sids );
    			}
    		}
		}
    	/* items listing */
    	if( is_array($sids) && !empty($sids) || ( $pluginOutput && $pluginOutputPosition == "beforeItems" ) || ( is_array($pluginsOutput) && !empty($pluginsOutput) )) {
    		/* if we don't have entries but only the plugins iutput */
    		if( is_array($sids) && !empty($sids) ) {
				if( $config->isset_( "curDisplSidList" ) ) {
					$curDisplSidList =& $config->get_( "curDisplSidList" );
					$curDisplSidList = array_intersect( $curDisplSidList, $sids );
				}
				else {
					$config->set_( "curDisplSidList", $sids );
				}
	    		$published = $forceUnpublishedItems ? null : " AND ( published = 1 AND ( publish_down > '{$now}' OR publish_down = '{$config->nullDate}' ) ) ";
				$ids = (!empty($sids)) ? implode(" , ", $sids) : null;
	    		$query = "SELECT COUNT(*) FROM #__sobi2_item WHERE itemid IN({$ids}) {$published}";
	    		$database->setQuery($query);
	    		$totalResults = $database->loadResult();
				if ($database->getErrorNum()) {
					trigger_error("HTML_SOBI::buildCustomListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
	    		$ordering = $itemsOrdering ? " ORDER BY {$itemsOrdering} " : null;
	    		if($navMenuUrl) {
			   		$limit = $itemsInLine * $config->lineOnSite;
			    	$limitstart = intval(sobi2Config::request($_REQUEST, 'limitstart', 0));

			    	if($limit) {
			    		$limits = " LIMIT {$limitstart}, {$limit} ";
			    	}
			    	$pageNav =& sobi2bridge::jPageNav( $totalResults, $limitstart, $limit );
			    	$navigation = '<div id="sobi2PageNav">'.sobi2bridge::writePagesLinks( $pageNav, $navMenuUrl ).'</div>';
				}
				else {
					$navigation = null;
				}
				$limits = isset($limits) && $limits ? $limits : null;
    		}
    		if($stringForItems) {
	    		$listing .= "\n\t\t<div class=\"sobi2CustomListingItemsHeader\">{$stringForItems}</div>";
	    	}
			if($pluginOutput && $pluginOutputPosition == "beforeItems") {
				$listing .= $pluginOutput;
			}
			if(!empty($pluginsOutput)) {
				foreach ($pluginsOutput as $o) {
					if($o["position"] == "beforeItems") {
						$listing .= $o["output"];
					}
				}
			}
			if( is_array( $sids ) && !empty( $sids ) ) {
		    	$ordering = $itemsOrdering ? "ORDER BY {$itemsOrdering}" : null;
	    		$query = "SELECT * FROM #__sobi2_item WHERE itemid IN({$ids}) {$published}  {$ordering} {$limits}";
	    		$database->setQuery($query);
	    		$results = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("HTML_SOBI::buildCustomListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
	    		$cid = $defCid ? "&amp;catid={$defCid}" : null;
			}
			$requestParams =& $config->get_( "requestParams" );
			if( ( $templateFunction && $templateFunction != "sobi2VCview" ) || !$forceCache ) {
				$doCache = false;
			}
			else {
				$doCache = true;
			}
			if( $doCache && $config->cacheL2Enabled && $output = $config->sobiCache->getContent( $requestParams, "entrieslist")) {
				$listing .= $output;
			}
			else {
		    	if( isset( $results ) && !empty( $results ) ) {
					$out = null;
					$out .= "\n\t\t<table class=\"sobi2Listing\">";
			    	$tdTrCounter = 0;
					if( isset( $results ) && count($results) ) {
						$out .= "\n\t\t\t<tr>";
						$width = 100/$itemsInLine;
						$width = "style='width: {$width}%; ";

						foreach($results as $result) {
							$deleteButton = null;
							$editButton = null;
							$ico = null;
							$img = null;
							/*
							 * check if need to display <tr>
							 */
							if($tdTrCounter%$itemsInLine == 0 && $tdTrCounter != 0)
								$out .= "\n\t\t\t</tr>\n\t\t\t<tr>";

							$style = $width;
							if($result->background && file_exists(_SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$result->background}")) {
								$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$result->background});";
							}
							else if(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg)))
							   	$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";

							if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor)))
								$style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
							else
								$style = $style."'";

							$tdTrCounter++;
							$result->title = $config->getSobiStr($result->title);
							/*
							 * case showing editable item
							 */
							if( ($my->id != 0 && $my->id == $result->owner) || $config->checkPerm() ) {
								if( $config->allowUserToEditEntry || $config->checkPerm() ) {
									$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=editSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$config->sobi2Itemid}{$cid}";
									$editButton = "<input type=\"button\" class=\"button sobi2EditEntryButton\" onclick=\"location.href='{$href}'\"  name=\"editEntry\" value=\""._SOBI2_LISTING_EDIT_ENTRY_BT."\"/>";
								}
								if( $config->allowUserDelete || $config->checkPerm() ) {
									$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=deleteSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$config->sobi2Itemid}{$cid}";
									$deleteButton = "<input type=\"button\" class=\"button sobi2EditEntryButton\" onclick=\"if(confirm('"._SOBI2_CONFIRM_DELETE."') == true) location.href='{$href}'\" name=\"editEntry\" value=\""._SOBI2_LISTING_DELET_ENTRY_BT."\"/>";
								}
							}
							if(!$my->id && !$config->allowAnoDetails) {
								$onClick = "onclick='alert(\""._SOBI2_JS_NOT_LOGGED_FOR_DETAILS."\"); return false;'";
								$href = "#";
							}
							else {
								$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$result->itemid}&amp;{$cid}Itemid={$config->sobi2Itemid}";
								$href = sobi2Config::sef($href);
								$onClick = null;
							}
							$result->title = sobi2Config::replaceEntities($result->title);
							/*
							 * show icon or image in VCard
							 */
					    	if( !$result->icon && $config->key( "frontpage", "default_ico" ) ) {
				            	$result->icon = $config->key( "frontpage", "default_ico" );
				            }

				            if( !$result->image && $config->key( "frontpage", "default_img" ) ) {
				            	$result->image = $config->key( "frontpage", "default_img" );
				            }
							if($config->showIcoInVC && $result->icon != '') {
								$ico = $config->liveSite.$config->imagesFolder.$result->icon;
								$ico = "<a href=\"{$href}\" {$onClick}><img src=\"{$ico}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
							}

							if($config->showImgInVC && $result->image != '') {
								$img = $config->liveSite.$config->imagesFolder.$result->image;
								$img = "<a href=\"{$href}\" {$onClick}><img src=\"{$img}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
							}

							$title = "<p class=\"sobi2ItemTitle\"><a href=\"{$href}\" {$onClick} title=\"{$result->title}\" >{$result->title}</a></p>";
							$fields = array();
							if(!$fieldids = $config->sobiCache->get("field_vcard")) {
								$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
										 "WHERE `in_vcard`= 1 AND `enabled` = 1 " .
										 "ORDER BY position";
								$database->setQuery($query);
								$fieldids = $database->loadObjectList();
								if ($database->getErrorNum()) {
									trigger_error("HTML_SOBI::buildCustomListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
								}
								$config->sobiCache->add("field_vcard",$fieldids);
							}
							if($fieldids && !is_integer($fieldids)) {
								sobi2Config::import("field.class");
								foreach($fieldids as $fieldid) {
									$fields[] = new sobiField($fieldid->fieldid, $result->itemid);
								}
							}
							/*
							 * getting fields data
							 */
		                    if( count( $fields ) ) {
		                        $fieldsFormated = array();
		                        $fieldsObjects = array();
		                        foreach($fields as $field) {
		                        	$data = null;
		                            $field->name = $config->getSobiStr($field->fieldname);
		                            $field->label = $config->getSobiStr($field->label);
		                            $fieldsObjects[$field->name] = $field;
		                            if($field->fieldType == 2) {
										$field->data = $config->getSobiStr($field->data, true);
										$data = $field->data;
		                            }
		                            elseif( $field->fieldType == 1  || $field->fieldType == 5 || $field->fieldType == 7 ) {
										$field->data = $config->getSobiStr($field->data);
										$data = $field->data;
		                            }
		                            elseif($field->fieldType == 3) {
										$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
										$field->with_label = 1;
		                             }
									elseif($field->fieldType == 6) {
										$field->data = $field->selectedValues;
										if(is_array($field->data) && !empty($field->data)) {
											$data = "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
											foreach ($field->data as $opt) {
												$data .= "\n\t<li>{$opt}</li>";
											}
											$data .= "\n</ul>";
										}
									}
		                            if(strlen($data) > 0) {
										$tag = "span";
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
										if($field->isUrl == 1) {
											if( in_array( $field->fieldid, $noFollows )) {
												$noFollow = " rel=\"nofollow\" ";
											}
											else {
												$noFollow = null;
											}
											$data = "<a href=\"{$data}\"{$noFollow} title=\"{$result->title}\" target=\"_blank\">{$field->label}</a>";
										}
										elseif($field->isUrl == 2) {
											if( !defined( "_SOBI_AJAX_SEARCH" ) ) {
												$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
											}
											else {
												$data = "<a href=\"mailto:{$data}\" title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}</a>";
											}
										}
										elseif($field->isUrl == 3) {
											$data = "<img src=\"{$data}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
										}
										if($field->with_label) {
											if( $field->fieldType != 6 ) {
												$data = "<{$tag} class=\"sobi2Listing_{$field->name}\"><span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}</{$tag}>";
											}
											else {
												$data = "<span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}";
											}
										}
										else {
											if( $field->fieldType != 6 ) {
												$data = "<{$tag} class=\"sobi2Listing_{$field->name}\">{$data}</{$tag}>";
											}
										}
										if($field->in_newline) {
											$data = "<br/>".$data;
										}
		                            }
		                            $fieldsFormated[$field->name] = $data;
		                        }
		                    }
							$plugins = frontend::getPlugins($result->itemid,false);
							if($config->useDetailsView || $templateFunction) {
								if($pluginTask) {
									$pluginTask = $pluginTask."VcardModifier";
									if(count($config->S2_plugins)) {
							    		foreach($config->S2_plugins as $plugin) {
							    			if(method_exists($plugin, $pluginTask)) {
												$plugin->$pluginTask( $result->itemid, $style, $ico, $img, $title, $fieldsObjects, $fieldsFormated, $plugins, $editButton, $deleteButton );
							    			}
							    		}
							    	}
								}
								sobi2Config::import("sobi2.class");
								ob_start();
								if( $templateFunction && function_exists($templateFunction) ) {
									call_user_func_array( $templateFunction, array($result->itemid, $style, $ico, $img, $title, $fieldsObjects, $fieldsFormated, $plugins, $editButton, $deleteButton) );
								}
								else {
									if( !function_exists( "sobi2VCview" ) ) {
										$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
							    		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
										if( !$template ) {
											$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
										}
								        if( $config->debugTmpl && !$fetchErr ) {
								        	sobi2Config::parseTemplate( $template );
								        }
								        else {
								        	sobi2Config::import( $template, "absolute" );
								        }
									}
									sobi2VCview( $result->itemid, $style, $ico, $img, $title, $fieldsObjects, $fieldsFormated, $plugins, $editButton, $deleteButton );
								}
								$out .= ob_get_contents();
								ob_end_clean();
							}
							else {
								$out .= "\n\t\t\t\t<td {$style}>";
								$out .= $editButton;
								$out .= $deleteButton;
								$out .= $ico;
								$out .= $img;
								$out .= $title;
								if( count( $fieldsObjects ) ) {
									foreach ($fieldsObjects as $field) {
			                        	$data = null;
			                            $field->name = $config->getSobiStr($field->fieldname);
			                            $field->label = $config->getSobiStr($field->label);
			                            $fieldsObjects[$field->name] = $field;
			                            if($field->fieldType == 2) {
											$field->data = $config->getSobiStr($field->data, true);
											$data = $field->data;
			                            }
			                            elseif( $field->fieldType == 1  || $field->fieldType == 5 || $field->fieldType == 7 ) {
											$field->data = $config->getSobiStr($field->data);
											$data = $field->data;
			                            }
			                            elseif($field->fieldType == 3) {
											$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
											$field->with_label = 1;
			                             }
										elseif($field->fieldType == 6) {
											$field->data = $field->selectedValues;
											if(is_array($field->data) && !empty($field->data)) {
												$data = "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
												foreach ($field->data as $opt) {
													$data .= "\n\t<li>{$opt}</li>";
												}
												$data .= "\n</ul>";
											}
										}
			                            if(strlen($data) > 0) {
											$tag = "span";
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
											if($field->isUrl == 1) {
												if( in_array( $field->fieldid, $noFollows )) {
													$noFollow = " rel=\"nofollow\" ";
												}
												else {
													$noFollow = null;
												}
												$data = "<a href=\"{$data}\"{$noFollow} title=\"{$result->title}\" target=\"_blank\">{$field->label}</a>";
											}
											elseif($field->isUrl == 2) {
												$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
											}
											elseif($field->isUrl == 3) {
												$data = "<img src=\"{$data}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
											}
											if($field->with_label) {
												if( $field->fieldType != 6 ) {
													$data = "<{$tag} class=\"sobi2Listing_{$field->name}\"><span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}</{$tag}>";
												}
												else {
													$data = "<span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}";
												}
											}
											else {
												if( $field->fieldType != 6 ) {
													$data = "<{$tag} class=\"sobi2Listing_{$field->name}\">{$data}</{$tag}>";
												}
											}
											if($field->in_newline) {
												$data = "<br/>".$data;
											}
			                            }
										$out .= "\n\t\t\t\t\t{$data}";
									}
								}
								$out .= frontend::getPlugins($result->itemid);
								$out .= "\n\t\t\t\t</td>";
							}
						}
						/*
						 * on end check if last <tr> have $config->itemsInLine <td>'s
						 */
						if($tdTrCounter%$itemsInLine != 0) {
				    		if( ($f = $config->key( "frontpage", "empty_cell_calback_function", false )) && function_exists( $f )) {
				    			$ecell = call_user_func( $f );
				    		}
				    		else {
				    			$ecell = "&nbsp;";
				    		}
							$colspan = $itemsInLine - ($tdTrCounter%$itemsInLine);
							$out .= "\n\t\t\t\t<td class=\"sobi2EmptyCell\" colspan=\"{$colspan}\">{$ecell}\n\t\t\t\t</td>";
						}
						// wenn noch keine Eintraege da, dann korrekt schliessen
					}
					else {
						$out .= "\n\t\t\t<tr><td></td>";
					}
					$out .= "\n\t\t\t</tr>\n\t\t</table>\n";
					$listing .= $out;
					if( $doCache && $config->cacheL2Enabled ) {
					 	$config->sobiCache->addContent( $out, $requestParams, "entrieslist" );
					}
		    	}
			}
			// if not cached ende
			if($pluginOutput && $pluginOutputPosition == "afterListing") {
				$listing .= $pluginOutput;
			}

		}
		$listing .= $navigation.$footer;
		return $listing;
	}
}
?>