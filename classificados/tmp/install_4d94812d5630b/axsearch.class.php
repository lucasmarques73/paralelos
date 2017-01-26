<?php
/**
* @version $Id: axsearch.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
// no direct access
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class sobiAxSearch {
	function search()
	{
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		define("_SOBI_AJAX_SEARCH", true);
		header("Content-Type: application/x-javascript; "._ISO);
		$searchString = sobi2Config::request($_REQUEST, "sobi2Search");
		$searchString = str_replace("%20", " ", $searchString);
		$searchString = $config->stringDecode( $searchString );
		$searchString = addslashes($searchString);
		$phrase = sobi2Config::request($_REQUEST, "searchphrase", "all");
		$searching = false;
		$dataForFields = array();
		$pluginsOutput = null;
		$addToCount = 0;

		/* gettings the fields for search */
		$fields = array();
		$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
				 "WHERE `in_search`= 2 AND `enabled` = 1 " .
				 "ORDER BY position";
		$database->setQuery($query);
		$fieldids = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if($fieldids) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fields[] = new sobiField($fieldid->fieldid);
			}
		}
		/* getting input from select boxes */
		$break = false;
		foreach( $fields as $field ) {
			$getField = sobi2Config::request( $_REQUEST, $field->fieldname, null );
			$getField = $config->stringDecode( $getField );
			$getFieldCookie =  $config->getSobiStr( str_replace( "\\", null, $getField ) );
			$getField = $config->clearSQLinjection($getField);
			setcookie( "sobi2SearchCookie[{$field->fieldname}]", $getFieldCookie, $config->key( "search", "cookie_lifecycle" ) , "/" );
			if( !empty( $getField ) && $getField != 'all' ) {
				$searching = true;
				$dataForFields += array( $field->fieldname => $getField );
				/* checkbox handling */
				if( $getField == '-1' ) {
   					$getField = 0;
   				}
   				if( !isset( $sIDs ) ) {
   					$sIDs = array();
   				}
   				$now = $config->getTimeAndDate();
				$ids = ( !empty($sIDs) ) ? implode( " , ", $sIDs ) : null;
				if ( $ids ) {
					$idTest = " AND item.itemid IN ({$ids}) ";
				}
				else {
					$idTest = null;
				}
				$query = "SELECT DISTINCT item.itemid " .
					"FROM `#__sobi2_fields` AS sobifields " .
					"LEFT JOIN `#__sobi2_fields_data` AS sdata ON sobifields.fieldid = sdata.fieldid " .
					"LEFT JOIN `#__sobi2_language` AS snames ON snames.fieldid =  sobifields.fieldid " .
					"LEFT JOIN `#__sobi2_item` AS item ON sdata.itemid = item.itemid " .
					"WHERE (snames.langKey = '{$field->fieldname}' AND sdata.data_txt = '{$getField}') {$idTest}".
					" AND item.published = 1 AND (item.publish_down > '{$now}' OR item.publish_down = '{$config->nullDate}' )";

				$database->setQuery( $query );
				$arr = $database->loadResultArray();
				if ( $database->getErrorNum() ) {
					trigger_error( "axSearchSobi2: DB reports: ".$database->stderr(), E_USER_WARNING );
				}
				if( is_array( $arr ) && empty( $arr ) ) {
					$sIDs = array();
					$break = true;
					break;
				}
				elseif( !empty($sIDs) && is_array($arr)) {
					$sIDs = array_intersect($sIDs, $arr);
				}
				elseif(is_array($arr)) {
					$sIDs = $arr;
				}
				elseif(!is_array($arr) ) {
					$sIDs = array();
					break;
				}
			}
		}
		/* search string handling */
		if( !$break && ( !empty( $searchString ) && trim( $searchString ) != trim( _SOBI2_SEARCH_INPUTBOX ) && ( !isset( $sIDs ) || !empty( $sIDs ) ) ) ) {
			$searching = true;
			$searchString = $config->clearSQLinjection( trim( $searchString ) );
			switch ( $phrase ) {
				case 'exact':
					$words = $searchString;
   					$where = null;
   					$or = null;
   					if( $config->key( "search", "exact_rlike", true ) ) {
						$r = "R";
						$wcs = "[[:<:]]";
						$wce = "[[:>:]]";
						if( $words[0] == "&" ) {
							$words = substr( $words, 1 );
						}
   					}
   					else {
   						$r = null;
						$wcs = "%";
						$wce = "%";
   					}
					if( $config->key( "search", "title", true ) ) {
   						$where .= "LOWER(title) {$r}LIKE '{$wcs}{$words}{$wce}' ";
   						$or = "OR";
   					}
   					if( $config->key( "search", "metakey", true ) ) {
   						$where .= "{$or} LOWER(metakey) {$r}LIKE '{$wcs}{$words}{$wce}' ";
   						$or = "OR";
   					}
   					if( $config->key( "search", "metadesc", true ) ) {
   						$where .= "{$or} LOWER(metadesc) {$r}LIKE '{$wcs}{$words}{$wce}' ";
   					}
					break;
				case 'all':
				case 'any':
					/* handling for data from checkbox group or select lists */
					$str = $searchString;
					$opt = explode( " ", $searchString );
					if( count( $opt ) ) {
						$options = array();
						foreach ( $opt as $o ) {
							$options[] = $config->getSobiStr( $o );
						}
						$opt = implode( "','", $options );
						$query = "SELECT GROUP_CONCAT( DISTINCT `langKey` SEPARATOR ' ' ) FROM `#__sobi2_language` WHERE `langValue` IN('{$opt}') AND `sobi2Section` = 'field_opt'";
						$database->setQuery( $query );
						$opt = $database->loadResult();
						if ($database->getErrorNum()) {
							trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
						}
						if( $opt ) {
							$str .= " ".$opt;
						}
					}
					/* handling for data from checkbox group or select lists */
					$words = explode( ' ', $str );

					if( $phrase == 'all' ) {
						$where = implode( "%' AND {=|=} LIKE '%", $words );
						$words = implode( "%' AND LOWER(sdata.data_txt) LIKE '%", $words );
					}
					elseif ( $phrase == 'any' ) {
						$where = implode( "%' OR {=|=} LIKE '%", $words );
						$words = implode( "%' OR LOWER(sdata.data_txt) LIKE '%", $words );
					}
					break;
			}
			if( $phrase == "exact" && $config->key( "search", "exact_rlike", true ) ) {
				$words = "LOWER(sdata.data_txt) RLIKE '[[:<:]]{$words}[[:>:]]'";
			} else {
				$words = "LOWER(sdata.data_txt) LIKE '%{$words}%'";
			}
   			/*
   			 * now get the fields in there we have to looking for
   			 */
			$query = "SELECT sobifields.fieldid  " .
					 "FROM `#__sobi2_fields` AS sobifields " .
					 "WHERE ((`in_search` = 1  OR `in_search` = 2 ) AND `enabled` = 1)";
		    $database->setQuery( $query );
			$fields = $database->loadResultArray();
			if ( $database->getErrorNum() ) {
				trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
			}
			if( is_array( $fields ) && !empty( $fields ) ) {
				$sIDs2 = array();
				foreach ( $fields as $field ) {
					$query = "SELECT DISTINCT `itemid` " .
		   			   		"FROM `#__sobi2_fields` AS sfield " .
		   					"LEFT JOIN `#__sobi2_fields_data` AS sdata ON sfield.fieldid = sdata.fieldid " .
		   					"WHERE (sfield.fieldid = '{$field}' AND ( {$words} ) )";
		   			$database->setQuery($query);
					$arr = $database->loadResultArray();
					if ( $database->getErrorNum() ) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
		   			if( !empty( $arr ) ) {
						$sIDs2 = array_merge( $sIDs2, $arr );
		   			}
				}
			}
			/* looking in the items table self */
			if( $phrase != 'exact' ) {
				$title 		= str_replace("{=|=}", "LOWER(title)", $where);
				$metakey 	= str_replace("{=|=}", "LOWER(metakey)", $where);
				$metadesc 	= str_replace("{=|=}", "LOWER(metadesc)", $where);
				$title 		= $config->key( "search", "title", true ) 	? "LOWER(title) LIKE '%{$title}%' OR" 		: null;
				$metakey 	= $config->key( "search", "metakey", true ) ? "LOWER(metakey) LIKE '%{$metakey}%' OR " 	: null;
				$metadesc 	= $config->key( "search", "metadesc", true )? "LOWER(metadesc) LIKE '%{$metadesc}%' "	: null;
				$query 		= "SELECT DISTINCT `itemid` FROM `#__sobi2_item` WHERE ( {$title} {$metakey} {$metadesc} )";
			}
			else {
				$query = "SELECT DISTINCT `itemid` FROM `#__sobi2_item` WHERE ({$where})";
			}
			$database->setQuery( $query );
			$arr = $database->loadResultArray();
			if ( $database->getErrorNum() ) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
   			if( !empty( $arr ) && isset( $sIDs2 ) ) {
				$sIDs2 = array_merge( $sIDs2, $arr );
   			}
		}
		/* here we have all ids from select boxes and all ids from string search */
		/* no both results */
		if( isset( $sIDs ) && isset( $sIDs2 ) ) {
			$sIDs = array_intersect( $sIDs, $sIDs2 );
		}
		else {
			/* didn't search in select boxes */
			if( !isset( $sIDs ) && isset( $sIDs2 ) ) {
				$sIDs = $sIDs2;
			}
			else if( !isset( $sIDs ) ) {
				$sIDs = array();
			}
		}
		if( !isset( $sIDs ) || empty( $sIDs ) ) {
			$sIDs = array();
		}
		$sIDs = array_unique( $sIDs );

		/* searching in categories */
		$cid = (int) sobi2Config::request( $_REQUEST, "sobiCid", 0 );
		setcookie("sobi2SearchCookie[cid]", $cid, $config->key( "search", "cookie_lifecycle" ), "/" );

		if( !empty( $sIDs ) || !$searching ) {
			if( $cid && $cid != 0 ) {
				$searching = true;
				if( !is_array( $sIDs ) || empty( $sIDs ) ) {
					$itids = null;
				}
				else {
					$ids = implode( " , ", $sIDs );
					$itids = "AND itemid IN ({$ids})";
				}
				$cids = array();
				$config->getChildCats( $cid, $cids );
				$cids = implode( " , ", $cids );
				$query = "SELECT itemid FROM #__sobi2_cat_items_relations WHERE catid IN({$cids}) {$itids} ;";
				$database->setQuery( $query );
				$sIDs = $database->loadResultArray();
				if ( $database->getErrorNum() ) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
		}
		/* getting plugins modifications */
		if( !empty( $sIDs ) || !$searching ) {
			if( !empty( $config->S2_plugins ) ) {
				foreach ( $config->S2_plugins as $plugin ) {
					if( method_exists( $plugin,"onAjaxSearchResult" ) ) {
						$plugin->onAjaxSearchResult( $sIDs, $dataForFields, $pluginsOutput, $addToCount );
					}
				}
			}
		}
		$total = count( $sIDs );

		if( $total ) {
			$whereId = implode( " , ", $sIDs );
			$now = $config->getTimeAndDate();
			$query = "SELECT COUNT(itemid) FROM `#__sobi2_item` " .
			 	 	 "WHERE ( itemid IN ({$whereId}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) ) ";
			$database->setQuery( $query );
			if( $database->loadResult() ) {
				$total = $database->loadResult();
			}
			else {
				$total = 0;
			}
			if( $database->getErrorNum() ) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		$totalStr = $total + $addToCount;
		$items = array();
		$page = 0;
		$pages = 0;
		if( $total ) {
			/*
			 * now we have all id's from items contains search strings
			 */
			$limit = $config->itemsInLine * $config->lineOnSite;
			$pages = ceil( $total/$limit );
			$limitstart = ( int ) sobi2Config::request( $_REQUEST, "SobiSearchPage", 0 );
			setcookie("sobi2SearchCookie[SobiSearchPage]", $limitstart, $config->key( "search", "cookie_lifecycle" ), "/");

			if( $limitstart == -1 ) {
				$limitstart = $pages - 1;
			}
			$page = $limitstart;
			$limitstart *= $limit;
			$limit = $config->itemsInLine * $config->lineOnSite;
			$limits = " LIMIT {$limitstart}, {$limit} ";

			$config->listingOrdering = str_replace( "relation.", null, $config->listingOrdering );
			$query = "SELECT itemid, title, owner, image, background, icon, metadesc, publish_up FROM `#__sobi2_item` AS items " .
			 	 "WHERE ( items.itemid IN ({$whereId}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) ) ORDER BY {$config->listingOrdering} {$limits}";
			$database->setQuery( $query );
			$items = $database->loadObjectList();
			if ( $database->getErrorNum() ) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( !count( $items ) && $total ) {
				$query = "SELECT itemid, title, owner, image, background, icon, metadesc, publish_up FROM `#__sobi2_item` AS items " .
				 	 "WHERE ( items.itemid IN ({$whereId}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) ) ORDER BY {$config->listingOrdering} LIMIT 0, {$limit}";
				$database->setQuery($query);
				$items = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
		}
		$searchString = str_replace( "\\", null, $searchString );
		if( $total ) {
			defined( '_PN_LT' ) || define('_PN_LT','&lt;');
			defined( '_PN_RT' ) || define('_PN_RT','&gt;');
			defined( '_PN_START' ) || define('_PN_START','Start');
			defined( '_PN_PREVIOUS' ) || define('_PN_PREVIOUS','Previous');
			defined( '_PN_NEXT' ) || define('_PN_NEXT','Next');
			defined( '_PN_END' ) || define('_PN_END','End');
		}
		$searchString = $config->getSobiStr( $searchString );
		setcookie( "sobi2SearchCookie[sobi2Search]", $searchString, $config->key( "search", "cookie_lifecycle" ), "/" );
		setcookie( "sobi2SearchCookie[searchphrase]", $phrase, $config->key( "search", "cookie_lifecycle" ), "/" );
		$config->set( "searchResults", $items );
		HTML_SOBI::axSearchResults($searchString, $items, $total, $pluginsOutput, $pages, $page, $totalStr);
	}
	function searchSobi( $catid = 0 )
	{
    	$config =& sobi2Config::getInstance();
    	$mainframe =& $config->getMainframe();
    	$cname = $config->key( "search", "browser_title_add_com_name", true ) ? $config->componentName.' - ' : null;
		$mainframe->setPageTitle( html_entity_decode( $cname._SOBI2_SEARCH_H ) );
		$config->appendPathWay( _SOBI2_SEARCH_H.'&nbsp;', _SOBI2_SEARCH_H );
    	$database =& $config->getDb();

    	$j15 = false;
    	if( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) {
    		$document =& JFactory::getDocument();
    		$j15 = true;
    	}
		$query = "SELECT catid, name, introtext, description FROM `#__sobi2_categories` WHERE `catid`= 1";
		$database->setQuery( $query );
		$metadata = null;
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$metadata = $database->loadObject();
		}
    	else {
    		$database->loadObject( $metadata );
    	}
		if ( $database->getErrorNum() ) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( count( $metadata ) ) {
			$metaDesc = $config->getSobiStr( $config->componentName." ".$config->getSobiStr( $metadata->description ) );
			$metaDesc = str_replace( "\n"," ", $metaDesc );
			$metaDesc .= ' '.$config->key( "search", "add_to_meta_description", null );
			$metaDesc = sobiHTML::cleanText( $metaDesc );
			if( $j15 ) {
				$cur = $document->get( 'description' );
				if( strlen( $cur ) ) {
					$metaDesc = $cur .'. ' . $metaDesc;
				}
				$document->setDescription( $metaDesc );
			}
			else {
				$mainframe->appendMetaTag( 'description' ,$metaDesc );
			}
			$metaKeys = $config->getSobiStr($config->componentName.", ".$config->getSobiStr($metadata->introtext));
			$metaKeys = str_replace( "\n", "," , $metaKeys );
			$metaKeys .= ' '.$config->key( "search", "add_to_meta_keys", null );
			$metaKeys = sobiHTML::cleanText($metaKeys);
			if( $j15 ) {
				$document->setMetadata( 'keywords', $metaKeys );
			}
			else {
				$mainframe->appendMetaTag( 'keywords',$metaKeys );
			}
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

		$sobi2Frontend =& $config->getFrontend();
    	$autoSearch = false;
		$cid = sobi2Config::request($_REQUEST, "sobiCid", -9);
		$reset = sobi2Config::request($_REQUEST, "reset", 0 );
		$cookieValues = array();
    	if( !$reset ) {
			$cookieValues = sobi2Config::request($_COOKIE, "sobi2SearchCookie", null);
	    	if($cookieValues) {
	    		foreach ($cookieValues as $k => $v) {
	    			$cookieValues[$k] = $v;
	    		}
	    	}
    	}
    	$selectedCats = array();
		if($cid < 0 && is_array($cookieValues) && key_exists("cid", $cookieValues) && !empty($cookieValues["cid"])) {
			$cid = (int) $cookieValues["cid"];
		}
		if( $cid > 0 ) {
			$config->getParentCats($cid, $selectedCats);
			$selectedCats = array_reverse($selectedCats);
		}
		$cid = ($cid > 0) ? $cid : 0;
		$autoSearch = $cid ? true : $autoSearch;

		array_unshift($selectedCats, 1);

		$page = (int) sobi2Config::request($_REQUEST, "SobiSearchPage", -9);

		if($page < 0 && is_array($cookieValues) && key_exists("SobiSearchPage", $cookieValues) && !empty($cookieValues["SobiSearchPage"])) {
			$page = (int) $cookieValues["SobiSearchPage"];
		}
		else {
			$page = 0;
		}

    	$searchString = sobi2Config::request($_REQUEST, "sobi2Search", null);
		$searchString = str_replace("%20", " ", $searchString);
		$phrase = sobi2Config::request($_REQUEST, 'searchphrase', null);

		if(!$searchString && is_array($cookieValues) && key_exists("sobi2Search", $cookieValues) && !empty($cookieValues["sobi2Search"]) && trim($cookieValues["sobi2Search"]) != trim(_SOBI2_SEARCH_INPUTBOX)) {
			$searchString = stripslashes( $cookieValues["sobi2Search"] );
			$searchString = $config->getSobiStr( $searchString );
		}

		if(!$phrase && is_array($cookieValues) && key_exists("searchphrase", $cookieValues) && !empty($cookieValues["searchphrase"])) {
			$phrase = $cookieValues["searchphrase"];
		}

		$autoSearch = $searchString ? true : $autoSearch;

    	$fieldData = array();
    	$fieldsNames = array();
    	/*
    	 * at firts make the html mask
    	 */
		echo $sobi2Frontend->getHeader();
		/*////////////////////////////////////////////////////////////////////////////////////////////
		 * build drop' down lists
		 *////////////////////////////////////////////////////////////////////////////////////////////
		$dropListsArray = array();
		/*
		 * get all fields
		 */
		$fields = array();
		$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
				 "WHERE `in_search`= 2 AND `enabled` = 1 " .
				 "ORDER BY position";
		$database->setQuery($query);
		$fieldids = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if($fieldids) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fields[] = new sobiField($fieldid->fieldid);
			}
		}
		if( count( $fields ) ) {
			foreach($fields as $field) {
				$selected = sobi2Config::request($_REQUEST, $field->fieldname, null );
				$fieldsNames[] = $field->fieldname;
				if(!$selected && is_array($cookieValues) && key_exists($field->fieldname, $cookieValues) && !empty($cookieValues[$field->fieldname]) && $cookieValues[$field->fieldname] != 'all') {
					$selected = stripslashes( $cookieValues[$field->fieldname] );
				}
				$autoSearch = $selected ? true : $autoSearch;
				if(($field->fieldType == 5 || $field->fieldType == 6) && !(empty($field->definedValues))) {
					$field->definedValues = $field->getListValues( null, true, true );
					$options = array();
			   		if(!$field->selectLabel) {
			   			$options[] = sobiHTML::makeOption('all', _SOBI2_SEARCH_BOX_SELECT);
			   		}
			   		foreach ($field->definedValues as $option => $value) {
			   			$options[] = sobiHTML::makeOption($option, $value);
			   		}
					$selectList = sobiHTML::selectList( $options, $config->getSobiStr($field->fieldname), 'size="1" class="inputbox" id="'. $field->fieldname.'"', 'value', 'text', sobi2Config::request($_REQUEST, $field->fieldname, $selected ) );
					$dropListsArray = $dropListsArray + array($field->label => $selectList);
				}
				else {
					/*
					 * get data for this fields
					 */
					if( $config->ajaxSearchCatsFieldsDepend ) {
						/**
						 * @author Richard Jones
						 * Selected category to displayed fields depency
						 */
						if ( $cid ) {
							$cids = array();
							$config->getChildCats($cid, $cids);
							$cids = implode(" , ", $cids);
						}
                        $results = $config->sobiCache->get("search_field_{$cid}_{$field->fieldid}","searchFieldsData");
						if ( !$results || !is_array( $results ) ) {
							if ($cid!=0) {
								$query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_cat_items_relations` AS catitems, `#__sobi2_fields` AS sobifields " .
								"LEFT JOIN `#__sobi2_fields_data` AS fielddata ON sobifields.fieldid = fielddata.fieldid " .
								"LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid " .
								"WHERE (sobifields.fieldid = {$field->fieldid} AND catitems.catid  IN ({$cids}) AND fielddata.itemid = catitems.itemid) ORDER BY fielddata";
						}
						else {
							$query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_fields` AS sobifields " .
							"LEFT JOIN `#__sobi2_fields_data` AS fielddata ON sobifields.fieldid = fielddata.fieldid " .
							"LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid " .
							"WHERE sobifields.fieldid = {$field->fieldid} ORDER BY fielddata";
						}
						$database->setQuery( $query );
						$results = $database->loadObjectList();
						if ($database->getErrorNum()) {
							trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
						}
						if ($results)
							$config->sobiCache->add("search_field_{$cid}_{$field->fieldid}",$results,"searchFieldsData");
						}
					}
					else {
						$query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_fields` AS sobifields " .
								 "LEFT JOIN `#__sobi2_fields_data` AS fielddata ON sobifields.fieldid = fielddata.fieldid " .
								 "LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid " .
								 "WHERE sobifields.fieldid = {$field->fieldid} ORDER BY fielddata";
						$database->setQuery( $query );
				    	$results = $database->loadObjectList();
						if ($database->getErrorNum()) {
							trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
						}
					}
					/*
					 * get all options for this field
					 */
					if( count( $results ) ) {
						$selectList = $config->sobiCache->get("selectListArray_{$field->fieldid}_{$cid}_{$catid}","searchFieldsList");
						if ( !$selectList || !is_array( $selectList ) ) {
							$fieldData = array();
							$fieldData[] = sobiHTML::makeOption( 'all', _SOBI2_SEARCH_BOX_SELECT );
							foreach($results as $result) {
								if($result->fielddata) {
									if($result->fieldType == 3) {
										$label = $result->fielddata ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
										$data = $result->fielddata ? 1 : 0;
										$fieldData[] = sobiHTML::makeOption( '-1', _SOBI2_CHECKBOX_NO);
									}
									else {
										$data = $label = $config->getSobiStr($result->fielddata);
									}
									$fieldData[] = sobiHTML::makeOption( $data, $label);
								}
							}
							$selectList = array($field->label => sobiHTML::selectList( $fieldData, $config->getSobiStr($field->fieldname), 'size="1" class="inputbox" id="'. $config->getSobiStr($field->fieldname).'"', 'value', 'text', $selected ));
							$config->sobiCache->add("selectListArray_{$field->fieldid}_{$cid}_{$catid}",$selectList,"searchFieldsList");
						}
						$dropListsArray = $dropListsArray + $selectList;
					}
				}
			}
		}
		/*calling plugins*/
   		if(!empty($config->S2_plugins)) {
   			foreach($config->S2_plugins as $plugin) {
   				if(method_exists($plugin, "onAjaxSearchStart")) {
   					$plugin->onAjaxSearchStart($searchString, $phrase, $dropListsArray, $cookieValues, $fieldsNames, $autoSearch);
   				}
   			}
   		}
   		$autoSearch = ( count( $_GET ) > 5 ) ? true : $autoSearch;
   		$mainframe->addCustomHeadTag( sobiAxSearch::searchAjaxScript($autoSearch, $fieldsNames));
   		sobiAxSearch::showSearchForm($dropListsArray, $searchString, $phrase, $cid, $page, $selectedCats);
   		echo $sobi2Frontend->getFooter();
	}
    function showSearchForm($dropListsArray, $searchString, $phrase, $cid, $page, $selectedCats)
    {
    	$config =& sobi2Config::getInstance();
		$iso = defined("_ISO") ? explode( '=', _ISO ) : array( null, "UTF-8");
		$index = $config->key( "search", "ajax_target_file", "index2.php" );
		if(!$searchString) {
			$String = _SOBI2_SEARCH_INPUTBOX;
		}
		else {
			$String = $searchString;
		}
		if( $config->showComponentDescInSearch ) {
			sobi2Config::import("category.class");
			$sobi2Desc = new sobi2Category( 1 );
			if( $config->key( "general", "com_desc_exec_mambots", true ) ) {
				$sobi2Desc->description = HTML_SOBI::execMambots($sobi2Desc->description);
			}
			?>
			<table class="sobi2CompDesc" width="100%">
				<tr>
					<td>
					<?php if($sobi2Desc->image) { ?>
						<img src="<?php echo $config->liveSite;?><?php echo $config->catImagesFolder;?><?php echo $sobi2Desc->image; ?>"  style="float:<?php echo $sobi2Desc->image_position;?>" alt="<?php echo $config->componentName;?>" title="<?php echo $config->componentName;?>"/>
					<?php } ?>
						<?php echo $sobi2Desc->description;?>
					</td>
				</tr>
			</table>
			<?php
			if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	    			if(method_exists($plugin, "onShowSearchForm")) {
						$plugin->onShowSearchForm();
	    			}
	    		}
	    	}
		}
	?>
	<form id="sobiSearchFormContainer" accept-charset="<?php echo $iso[1];?>" action="<?php echo $config->liveSite; ?>/<?php echo $index;?>" method="get" name="sobiSearchFormContainer">
	<?php if( $config->key( "search", "do_not_show_search_form" ) ) { ?>
		<div style="display:none">
	<?php } ?>
		<table class="sobi2eSearchForm">
			<tr>
				<td id="sobi2eSearchLabel"><?php if( $config->key("search", "search_box", true )) { echo _SOBI2_SEARCH_FOR; } ?></td>
				<td id="sobi2eSearchBox">
					<?php if( $config->key("search", "search_box", true )) { ?>
						<input name="sobi2Search" id="sobi2Search" class="inputbox" value="<?php echo $String; ?>" onclick="if (this.value == '<?php echo _SOBI2_SEARCH_INPUTBOX; ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php echo _SOBI2_SEARCH_INPUTBOX; ?>';"/>
					<?php } ?>
				</td>
				<td id="sobi2eSearchButton">
					<?php if( $config->key("search", "search_box", true )) { ?>
						<input type="submit" id="sobiSearchSubmitBt" name="search"  onmousedown="$('SobiSearchPage').value = 0" onkeydown="$('SobiSearchPage').value = 0" class="button" value="<?php echo _SOBI2_SEARCH_H; ?>"/>
					<?php } ?>
				</td>
				<td id="sobi2eSearchEmptyCell">
				</td>
			</tr>
			<tr>
				<td colspan="4" id="sobi2eSearchPhrases">
				<?php if( $config->key("search", "phrase_any", true )) { ?>
					<input type="radio" <?php if($phrase == 'any' || $phrase != 'all' || $phrase != 'exact' ) echo "checked=\"checked\"" ?> name="searchphrase" id="searchphraseany" value="any"   />
					<label for="searchphraseany"><?php echo _SOBI2_SEARCH_ANY ?></label>
				<?php } ?>
				<?php if( $config->key("search", "phrase_all", true )) { ?>
					<input type="radio" <?php if($phrase == 'all') echo "checked=\"checked\"" ?> name="searchphrase" id="searchphraseall" value="all"  />
					<label for="searchphraseall"><?php echo _SOBI2_SEARCH_ALL ?></label>
				<?php } ?>
				<?php if( $config->key("search", "phrase_exact", true )) { ?>
					<input type="radio" <?php if($phrase == 'exact') echo "checked=\"checked\"" ?> name="searchphrase" id="searchphraseexact" value="exact"  />
					<label for="searchphraseexact"><?php echo _SOBI2_SEARCH_EXACT ?></label>
				<?php } ?>
				</td>
			</tr>
			<tr>
				<td colspan="4" id="sobi2eSearchButtonLine">
				<?php if( !$config->key("search", "search_box", true )) { ?>
					<input type="submit" id="sobiSearchSubmitBt" name="search"  onmousedown="$('SobiSearchPage').value = 0" onkeydown="$('SobiSearchPage').value = 0" class="button" value="<?php echo _SOBI2_SEARCH_H; ?>"/>
				<?php } ?>
				<?php if($config->ajaxSearchUseSlider) { ?>
					<input type="button" id="sobiSearchFormExtOptToggle" class="button" name="sobiSearchFormExtOptToggle" value="<?php echo _SOBI2_SEARCH_TOOGLE_EXTENDED; ?>"/>
				<?php } ?>
					<input type="button" id="sobiSearchFormReset" class="button" name="sobiSearchFormReset" title="<?php echo _SOBI2_SEARCH_RESET_FORM_TITLE;?>" value="<?php echo _SOBI2_SEARCH_RESET_FORM; ?>" onclick="resetSobi2SearchForm()"/>
					<br/><br/>
				</td>
			</tr>
			</table>
			<div id="sobiSearchFormExtOpt">
			<table class="sobi2eSearchForm">
			<?php
				if(!$config->ajaxSearchCatsForFields) {
					if(count($dropListsArray)) {
						foreach($dropListsArray as $label => $dropList) {
							echo "<tr><td class=\"sobi2eSearchLabel\">{$label}</td><td colspan='2'>{$dropList}</td></tr>";
						}
					}
				}
			?>
			<?php if( $config->key("search", "cats", true )) { ?>
			<tr>
				<td style="vertical-align:top;"><?php echo _SOBI2_SEARCH_TOOGLE_CATS; ?></td>
				<td colspan='2'>
				<?php if($config->ajaxSearchUseSlider) { ?>
					<div id="sobiSearchFormCatsSelection" <?php if($config->ajaxSearchUseSlider) { ?> style="height:<?php echo $config->ajaxSearchCatsContHeight;?>px;" <?php } ?>>
				<?php } ?>
						<?php
							if( !$config->key( "search", "do_not_show_search_form" ) ) {
								echo sobiAxSearch::axSearchCatChooser( $selectedCats, $cid );
							}
						?>
				<?php if($config->ajaxSearchUseSlider) { ?>
					</div>
				<?php } ?>
				</td>
			</tr>
			<?php } ?>
			<?php
				if($config->ajaxSearchCatsForFields) {
					if(count($dropListsArray)) {
						foreach($dropListsArray as $label => $dropList) {
							echo "<tr><td class=\"sobi2eSearchLabel\">{$label}</td><td colspan=\"2\">{$dropList}</td></tr>";
						}
					}
				}
			?>
			</table>
			</div>
			<?php if( $config->key( "search", "do_not_show_search_form" ) ) { ?>
				</div>
			<?php } ?>
			<input type="hidden" name="option" value="com_sobi2"/>
			<input type="hidden" name="Itemid" value="<?php echo $config->sobi2Itemid; ?>"/>
			<input type="hidden" name="no_html" value="1"/>
			<input type="hidden" name="sobi2Task" value="axSearch"/>
			<input type="hidden" name="sobiCid" id="sobiCid" value="<?php echo $cid; ?>"/>
			<input type="hidden" id="SobiSearchPage" name="SobiSearchPage" value="<?php echo $page;?>"/>
	</form>
	<div id="sobiSearchResponseContainer"></div>
	<?php
    }
    function axSearchCatChooser( $selectedCats, $cid )
    {
		$config =& sobi2Config::getInstance();
		if( count( $selectedCats ) ) {
	    	$dropsy = '<div id="SobiSearchForm2dropsy" style="margin-left: 0px;">';
			$catsChildsJs = null;
			$count = 0;
			$lastBox = 0;
			foreach( $selectedCats as $cid ) {
				$cats = $config->getCategories( $cid );
				if( is_array( $cats ) && !empty( $cats ) ) {
					$dropsy .= "\n\n\n\n<div id='sdrops_{$count}'>";
					$Select = array();
					$Select[] = sobiHTML::makeOption( 0, _SOBI2_SEARCH_CATBOX_SELECT);
					$js = "addSobiSearchFormCatBox(this.options[this.selectedIndex].value,{$count});";
					foreach ($cats as $cat) {
						$cat->name = str_replace("\\","",$cat->name);
						$cat->name = str_replace("\\\\","",$cat->name);
						$cat->name = $config->getSobiStr( $cat->name );
						$Select[] = sobiHTML::makeOption( $cat->catid, $cat->name);
						$c = $config->catHasChild($cat->catid) ? 1 : 0;
						$catsChildsJs .= "\n SobiSearchFormCatsChilds[{$cat->catid}] = '{$c}';";
					}
					$selected = key_exists( $count+1, $selectedCats ) ? $selectedCats[$count+1] : $cid;
					$dropsy .= sobiHTML::selectList( $Select, "SobiCatSelected_{$count}", 'id="SobiCatSelected_'.$count.'" size="1" class="inputbox catChooseBox" onclick="'.$js.'"', 'value', 'text', $selected);
					$dropsy .= "</div>\n\n\n\n";
					$lastBox = $count;
				}
				$count++;
			}
			$dropsy .= "\n\n<script type=\"text/javascript\">\n\n {$catsChildsJs}\n\n SobiSearchFormComboBxCounter = {$lastBox}; \n\n</script>";
			$dropsy .= "</div>";
			return $dropsy;
		}
		else {
			return null;
		}
    }
    function searchAjaxScript( $autoSearch, $fieldsNames )
    {
    	$config =& sobi2Config::getInstance();
		$pluginReset = null;
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			if(method_exists($plugin, "addToSearchJsResetScript")) {
					$pluginReset .= $plugin->addToSearchJsResetScript();
    			}
    		}
    	}
    	if ( $config->key("search", "use_own_mootools", true ) ) {
    		$config->loadScript("mootools");
    	}
    	$index = $config->key( "search", "ajax_target_file", "index2.php" );
		$url = "{$config->liveSite}/{$index}?option=com_sobi2&no_html=1&sobi2Task=SigsiuTreeMenu&Itemid={$config->sobi2Itemid}&catid=";
		$fieldsUrl = "{$config->liveSite}/{$index}?option=com_sobi2&no_html=1&sobi2Task=GetSearchField&Itemid={$config->sobi2Itemid}&catid=";
    	ob_start();
    	?>
		 <script type="text/javascript">
		 /* <![CDATA[ */
			var Sobi2FieldNames = new Array();
			<?php
				$c = 0;
				foreach ($fieldsNames as $name) {
					echo "\n\t\t\tSobi2FieldNames[{$c}] = \"{$name}\";";
					$c++;
				}
				echo "\n";
			?>
			function resetSobi2SearchForm() {
			<?php
			if( $config->ajaxSearchCatsFieldsDepend) {
			?>
				fieldsUrl = "<?php echo $fieldsUrl; ?>0";
	            SobiSearchFieldsSendRequest(fieldsUrl,0);
			<?php } ?>

			var SobiCookieRemove = " = 0; expires=0; path=/;";
			<?php if( $config->key("search", "search_box", true )) { ?>
				$('sobi2Search').value = "<?php echo _SOBI2_SEARCH_INPUTBOX; ?>";
				document.cookie = "sobi2SearchCookie[sobi2Search]" + SobiCookieRemove;
			<?php
				}
				if( $config->key("search", "phrase_any", true ) || $config->key("search", "phrase_all", true ) || $config->key("search", "phrase_exact", true ) ) {
			?>
				$("searchphraseany").checked = true;
				document.cookie = "sobi2SearchCookie[searchphrase]" + SobiCookieRemove;
			<?php } ?>
				$("sobiCid").value = 0;
				document.cookie = "sobi2SearchCookie[cid]" + SobiCookieRemove;
				$("SobiSearchPage").value = 0;
				document.cookie = "sobi2SearchCookie[SobiSearchPage]" + SobiCookieRemove;
				<?php echo $pluginReset;?>
				for(i=0; i < Sobi2FieldNames.length; i++) {
					$(Sobi2FieldNames[i]).selectedIndex = 0;
					document.cookie = "sobi2SearchCookie[" + Sobi2FieldNames[i] + "]" + SobiCookieRemove;
				}
				<?php if( $config->key("search", "cats", true )) { ?>
				for(SobiSearchFormComboBxCounter; SobiSearchFormComboBxCounter > 0; SobiSearchFormComboBxCounter--) {
					if(SobiSearchFormComboBxCounter > 0) {
						chBox = document.getElementById("sdrops_" + SobiSearchFormComboBxCounter);
						chBox.parentNode.removeChild(chBox);
					}
				}
				SobiSearchFormComboBxCounter = 0;
				$("SobiCatSelected_0").selectedIndex = 0;
				<?php } ?>
			}
		 	window.addEvent('<?php echo $config->key( "search","mootools_event_method", "load" );?>', function() {
		 		var sobiSearchResponseContainer = new Fx.Slide('sobiSearchResponseContainer');
		 	<?php if($config->ajaxSearchUseSlider) { ?>
				var sobiSearchFormExtOpt = new Fx.Slide('sobiSearchFormExtOpt');
			<?php if($config->ajaxSearchSlidInOnStart) { ?>
				sobiSearchFormExtOpt.slideOut();
			<?php } ?>
				$('sobiSearchFormExtOptToggle').addEvent('click', function(e){
					e = new Event(e);
					sobiSearchFormExtOpt.toggle();
					e.stop();
				});
			<?php } ?>
				$('sobiSearchFormContainer').addEvent('submit', function(e) {
					new Event(e).stop();
					var log = $('sobiSearchResponseContainer').empty().addClass('ajax-loading');
					var url = "<?php echo $config->liveSite; ?>/<?php echo $index;?>?" + $('sobiSearchFormContainer').toQueryString();
					var query = new Ajax(url, {
						method: 'get',
						onComplete: function() {
							log.removeClass('ajax-loading');
						},
						update: log
					});
					query.request();
			<?php if($config->ajaxSearchSlidInAfterSearch && $config->ajaxSearchUseSlider) { ?>
					sobiSearchFormExtOpt.slideOut();
			<?php } ?>
				});
			<?php if($autoSearch) { ?>
				$('sobiSearchSubmitBt').click();
			<?php } ?>
			});
			var SobiSearchFormComboBxCounter = 0;
			var SobiSearchFormCatsChilds = new Array();
			var SobiSearchFormCatsNames = new Array();
			function addSobiSearchFormCatBox(cid, c) {
				if(cid == 0) {
					if(c == 0) {
						$("sobiCid").value = cid;
					}
					else {
						box = c - 1;
						$("sobiCid").value = $("SobiCatSelected_" + box).options[$("SobiCatSelected_" + box).selectedIndex].value;
					}
					if(c < SobiSearchFormComboBxCounter) {
						for(SobiSearchFormComboBxCounter; SobiSearchFormComboBxCounter > c; SobiSearchFormComboBxCounter--) {
							if(SobiSearchFormComboBxCounter > 0) {
								chBox = document.getElementById("sdrops_" + SobiSearchFormComboBxCounter);
								chBox.parentNode.removeChild(chBox);
							}
						}
						SobiSearchFormComboBxCounter = c;
					}
				}
				if(cid != 0) {
					$("sobiCid").value = cid;
					url = "<?php echo $url; ?>" + cid;
					SobiSearchFormComboSendRequest(url,c);
				}
			}
			<?php
			/**
			 * @author Radek Suski, Richard Jones
			 * Selected category to displayed fields depency
			 */
			if( $config->ajaxSearchCatsFieldsDepend) {
			?>
            function SobiSearchFieldsSendRequest(url,c)
            {
            	var SobiSearchFormCatHttpRequest;
		        if (window.XMLHttpRequest) {
		        	SobiSearchFieldsHttpRequest = new XMLHttpRequest();
		              if (SobiSearchFieldsHttpRequest.overrideMimeType) {
		                SobiSearchFieldsHttpRequest.overrideMimeType('text/xml');
  		              }
		            }
		            else if (window.ActiveXObject) {
		              try { SobiSearchFieldsHttpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
		                catch (e) {
                              try { SobiSearchFieldsHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); }
		                   catch (e) {}
		                }
		        }
		        if (!SobiSearchFieldsHttpRequest) {
		            alert('Sorry but I Cannot create an XMLHTTP instance');
		            return false;
		        }
		        SobiSearchFieldsHttpRequest.onreadystatechange = function()
		        {
					if (SobiSearchFieldsHttpRequest.readyState == 4 && SobiSearchFieldsHttpRequest.status == 200) {
                             SobiSearchFieldsFill(SobiSearchFieldsHttpRequest,c);
					}
				};
		        SobiSearchFieldsHttpRequest.open('GET', url, true);
		        SobiSearchFieldsHttpRequest.send(null);
            }
			function SobiProcessField(field)
			{
				var fieldId = field.getElementsByTagName('fieldId').item(0).firstChild.data;
			  	fieldId = fieldId.replace("\\", "");
			  	var fieldValues = field.getElementsByTagName('fieldValue');
			  	liste = document.getElementById( fieldId );
				liste.length = 0;
			  	liste.options[0] = new Option( '', 'all', true, true );
			  	liste.options[0].innerHTML = '<?php echo _SOBI2_SEARCH_CATBOX_SELECT;?>';
			  	for( var i = 0; i< fieldValues.length; i++ ) {
			  		liste.options[liste.length] = new Option( fieldValues[i].firstChild.data, fieldValues[i].firstChild.data, false, false );
			  	}
			}
			function SobiSearchFieldsFill(XMLDoc,c)
			{
				if(!XMLDoc.responseXML) { return null; }
				var r = XMLDoc.responseXML;
				var fields = r.getElementsByTagName("field");
				if(fields.length > 0) {
					for(i = 0; i < fields.length; i++) {
						var field = fields[i];
						SobiProcessField(field);
					}
				}
			}
			<?php } ?>
			function SobiSearchFormComboSendRequest(url,c) {
		    	var SobiSearchFormCatHttpRequest;
		        if (window.XMLHttpRequest) {
		            SobiSearchFormCatHttpRequest = new XMLHttpRequest();
		            if (SobiSearchFormCatHttpRequest.overrideMimeType) {
		                SobiSearchFormCatHttpRequest.overrideMimeType('text/xml');
		            }
		        }
		        else if (window.ActiveXObject) {
		            try { SobiSearchFormCatHttpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
		                catch (e) {
                           try { SobiSearchFormCatHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); }
		                   catch (e) {}
		                 }
		        }
		        if (!SobiSearchFormCatHttpRequest) {
		            alert('Sorry but I Cannot create an XMLHTTP instance');
		            return false;
		        }
		        SobiSearchFormCatHttpRequest.onreadystatechange = function() {
			  	if (SobiSearchFormCatHttpRequest.readyState == 4 && SobiSearchFormCatHttpRequest.status == 200)
			    	SobiSearchFormCatGetSubcats(SobiSearchFormCatHttpRequest,c);
				};
		        SobiSearchFormCatHttpRequest.open('GET', url, true);
		        SobiSearchFormCatHttpRequest.send(null);
			}
			function SobiSearchFormCatGetSubcats(XMLDoc,c) {
				if(!XMLDoc.responseXML) {
					return null;
				}
				var r = XMLDoc.responseXML;
				var categories = r.getElementsByTagName("category");
				if(c < SobiSearchFormComboBxCounter) {
					for(SobiSearchFormComboBxCounter; SobiSearchFormComboBxCounter > c; SobiSearchFormComboBxCounter--) {
						if(SobiSearchFormComboBxCounter > 0) {
							chBox = document.getElementById("sdrops_" + SobiSearchFormComboBxCounter);
							chBox.parentNode.removeChild(chBox);
						}
					}
					SobiSearchFormComboBxCounter = c;
				}
				if(categories.length > 0) {
					SobiSearchFormComboBxCounter++;
					html = "";
					html = html + "<div id='sdrops_"+SobiSearchFormComboBxCounter+"'><select class='inputbox catChooseBox' id='SobiCatSelected_" + SobiSearchFormComboBxCounter + "' onclick='addSobiSearchFormCatBox(this.options[this.selectedIndex].value," + SobiSearchFormComboBxCounter + ");'><option value='0'><?php echo _SOBI2_SEARCH_CATBOX_SELECT;?></option>"
					for(i = 0; i < categories.length; i++) {
						var category = categories[i];
						var catid = category.getElementsByTagName('catid').item(0).firstChild.data;
						var name = category.getElementsByTagName('name').item(0).firstChild.data;
						var childs = category.getElementsByTagName('childs').item(0).firstChild.data;
						var pid = category.getElementsByTagName('parentid').item(0).firstChild.data;
						name = name.replace("\\", "");
						SobiSearchFormCatsNames[catid] = name;
						html = html + "<option value='"+catid+"'>"+name+"</option>"
						SobiSearchFormCatsChilds[catid] = childs;
					}
					html = html + "</select>\n\n</div>";
					span = document.createElement("span");
					span.innerHTML = html;
					document.getElementById("SobiSearchForm2dropsy").appendChild(span);
				}
				<?php
				/**
				 * @author Richard Jones
				 * Selected category to displayed fields depency
				 */
				if( $config->ajaxSearchCatsFieldsDepend) {
				?>
				fieldsUrl = "<?php echo $fieldsUrl; ?>" + $("sobiCid").value;
	            SobiSearchFieldsSendRequest(fieldsUrl,c);
				<?php } ?>
			}
			function sobiSearchRes(page) {
	 			$('SobiSearchPage').value = page;
				$('sobiSearchSubmitBt').click();
			}
		/* ]]> */
		</script>
		<style type="text/css">
		<!--
			#sobiSearchResponseContainer.ajax-loading {
				padding: 20px 0;
				background: url(<?php echo $config->liveSite; ?>/components/com_sobi2/images/spinner.gif) no-repeat center;
			}
		-->
		 </style>
    	<?php
		$script = ob_get_contents();
		ob_end_clean();
		return $script;
    }
	/**
	 * @author Richard Jones
	 * Selected category to displayed fields depency
	 * @since RC 2.8.4
	 * @param int $catid
	 */
	function getSearchFields( $cid )
	{
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$fields = array();
		$allFields = array();
		$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
				 "WHERE `in_search`= 2 AND `enabled` = 1 " .
				 "ORDER BY position";
		$database->setQuery($query);
		$fieldids = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( count( $fieldids ) ) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fields[] = new sobiField($fieldid->fieldid);
			}
		}
		if( count( $fields ) ) {
			foreach($fields as $field) {
				if( ( $field->fieldType == 5 || $field->fieldType == 6 ) && ! ( empty( $field->definedValues ) ) ) {
				  	if ( $cid ) {
						$cids = array();
						$config->getChildCats($cid, $cids);
						$cids = implode(" , ", $cids);
				  		$selVal = $config->sobiCache->get("search_field_{$cid}_{$field->fieldid}","searchFieldsData");
				  		if ( !$selVal || !is_array( $selVal ) ) {
					  		$query = "SELECT DISTINCT data_txt as fielddata FROM `#__sobi2_cat_items_relations` AS catitems, `#__sobi2_fields` AS sobifields ,`#__sobi2_fields_data` AS fielddata WHERE (sobifields.fieldid = {$field->fieldid} AND catitems.catid  IN ({$cids}) AND fielddata.itemid = catitems.itemid AND sobifields.fieldid = fielddata.fieldid ) ORDER BY fielddata";
						    $database->setQuery( $query );
						    $selVal = $database->loadResultArray();
							if ($database->getErrorNum()) {
								trigger_error("getSearchFields: DB reports: ".$database->stderr(), E_USER_WARNING);
							}
						    $config->sobiCache->add("search_field_{$cid}_{$field->fieldid}",$selVal,"searchFieldsData");
				  		}
				    }
					$field->definedValues = $field->getListValues( null, true, true, true );
                    $names = array();
                    $fieldArray = array();
			   		foreach ($field->definedValues as $option => $value) {
			   			if( $cid && is_array( $selVal ) ) {
			   				if( in_array( $option, $selVal ) ) {
			   					$names[$option] = $value;
			   				}
			   			}
			   			else {
			   				$names[$option] = $value;
			   			}
			   		}
					$fieldArray['fieldId'] = $field->fieldname;
					$fieldArray['fieldNames'] = $names;
					$allFields[] = $fieldArray;
				}
				else {
					/*
					 * get data for this fields
					 */
				  if ( $cid ) {
					$cids = array();
					$config->getChildCats($cid, $cids);
					$cids = implode(" , ", $cids);
				  }
				  $results = $config->sobiCache->get("search_field_{$cid}_{$field->fieldid}","searchFieldsData");
				  if ( !$results || !is_array( $results ) ) {
				  	if ( $cid ) {
				  		$query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_cat_items_relations` AS catitems, `#__sobi2_fields` AS sobifields " .
							 ",`#__sobi2_fields_data` AS fielddata " .
					         "WHERE (sobifields.fieldid = {$field->fieldid} AND catitems.catid  IN ({$cids}) AND fielddata.itemid = catitems.itemid AND sobifields.fieldid = fielddata.fieldid) ORDER BY fielddata";
				    }
				    else {
  					     $query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_fields` AS sobifields " .
							 "LEFT JOIN `#__sobi2_fields_data` AS fielddata ON sobifields.fieldid = fielddata.fieldid " .
							 "LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid " .
							 "WHERE sobifields.fieldid = {$field->fieldid} ORDER BY fielddata";
				    }
				    $database->setQuery( $query );
				    $results = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("getSearchFields: DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				    $config->sobiCache->add("search_field_{$cid}_{$field->fieldid}",$results,"searchFieldsData");
				  }
				  /*
				   * get all options for this field
				   */
				  if( count( $results ) ) {
				  	$names = $config->sobiCache->get("xmlselectListArray_{$field->fieldid}_{$cid}","xmlSearchFieldsList");
				  	$fieldArray = array();
				  	if ( !$names || !is_array( $names ) ) {
				  		$names = array();
				  		foreach($results as $result) {
				  			if($result->fielddata) {
				  				if($result->fieldType == 3) {
				  					$label = $result->fielddata ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
									$data = $result->fielddata ? 1 : 0;
								}
								else {
									$data = $label = $config->getSobiStr($result->fielddata);
								}
								$names[$label] =  $data;
							}
				  		}
				  		$config->sobiCache->add("xmlselectListArray_{$field->fieldid}_{$cid}",$names,"xmlSearchFieldsList");
				  	}
				  	$fieldArray['fieldId'] = $field->fieldname;
					$fieldArray['fieldNames'] = $names;
					$allFields[] = $fieldArray;
				  }
				}
			}
		}
		$iso = explode( '=', _ISO );
		$iso = strtoupper($iso[1]);
		ob_clean();
		ob_end_clean();
		if(ob_get_length()) {
			@ob_clean();
		}
		if(ob_get_length()) {
			@ob_end_clean();
		}
		header('Content-type: application/xml');
		echo "<?xml version=\"1.0\" encoding=\"{$iso}\"?>";
		echo "\n<root>";
		if( count( $allFields ) ) {
			foreach ( $allFields as $field ) {
				echo "\n\t<field>\n\t\t<fieldId>{$field['fieldId']}</fieldId>\n\t\t<fieldValues>";
				foreach ($field['fieldNames'] as $fopt => $fname ) {
					$fname = strip_tags( $fname );
					$fname = str_replace( "&nbsp;", " ", $fname );
					echo "\n\t\t\t<fieldValue name=\"{$fopt}\">{$fname}</fieldValue>";
				}
				echo "\n\t\t</fieldValues>";
				echo "</field>\n";
			}
		}
		echo "\n</root>";
		/* we don't need any others information so we can go out */
		exit();
	}
    /**
     * Enter description here...
     *
     * @param string $searchString
     * @param array $items
     * @param array $fieldData
     * @param int $total
     * @param string $phrase
     * @param string $pluginsOutput
     * @param int $pages
     * @param int $currPage
     */
    function axSearchResults($searchString, $items, $total, $pluginsOutput, $pages, $currPage, $totalStr )
    {
		$config	=& sobi2Config::getInstance();
		$my = &$config->getUser();
		if( trim( $searchString ) == trim( _SOBI2_SEARCH_INPUTBOX ) ) {
			$resultsFor = _SOBI2_SEARCH_ALL_ENTRIES;
		}
		else {
			$resultsFor = $searchString;
		}
		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["ajax_search"] ) && $config->templates["ajax_search"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["ajax_search"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
	?>
	<table>
	<tr>
		<th class="componentheading"><?php echo _SOBI2_SEARCH_RESULTS; ?></th>
	</tr>
	<tr>
		<td>
			<?php echo _SOBI2_SEARCH_RESULTS_FOUND; ?> <?php echo $totalStr; ?>
			<?php echo _SOBI2_SEARCH_RESULTS_FOUND_RESULTS; ?>
			<span id="sobi2SearchResultsSerchingString"><?php echo $resultsFor; ?></span>
		</td>
	</tr>
	</table>
	<?php echo $pluginsOutput; ?>
	<?php
		$tdTrCounter = 0;
		if( count($items) ) {
			echo "\n\t <table class='sobi2Listing'> \n\t\t <tr>";
			$width = 100/$config->itemsInLine;
			$width = "style='width: {$width}%; ";
			if($config->useDetailsView && file_exists( $template )) {
		    	$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
		        if( $config->debugTmpl && !$fetchErr ) {
		        	sobi2Config::parseTemplate( $template );
		        }
		        else {
		        	sobi2Config::import( $template, "absolute" );
		        }
				sobiAxSearch::searchResultsWithTemplate($items,$width,$config->liveSite,$config,0,$tdTrCounter,$my);
			}
			else {
				foreach($items as $item) {
					$item->title = $config->getSobiStr($item->title);
					$sobi2Data = sobiAxSearch::searchDetails($item);
					$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}";
					$href = sobi2Config::sef($href);
					if($tdTrCounter%$config->itemsInLine == 0 && $tdTrCounter != 0)
						 echo "\n\t\t </tr> \n\t\t <tr>";

					$style = $width;
					if($item->background && file_exists( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$item->background}")) {
						$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$item->background});";
					}
					else if(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg)))
					   	$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";

					if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor)))
						$style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
					else
						$style = $style."'";

					echo "\n\t\t\t <td {$style}>";

					if(!$my->id && !$config->allowAnoDetails) {
						$onClick = "onclick='alert(\""._SOBI2_JS_NOT_LOGGED_FOR_DETAILS."\"); return false;'";
						$href = "#";
					}
					else {
						$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}";
						$href = sobi2Config::sef($href);
						$onClick = null;
					}
			    	if( !$item->icon && $config->key( "frontpage", "default_ico" ) ) {
		            	$item->icon = $config->key( "frontpage", "default_ico" );
		            }

		            if( !$item->image && $config->key( "frontpage", "default_img" ) ) {
		            	$item->image = $config->key( "frontpage", "default_img" );
		            }

		            $imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );

					if($config->showIcoInVC && $item->icon && file_exists(_SOBI_CMSROOT.$imagesFolder.$item->icon)) {
						$ico = $config->liveSite.$config->imagesFolder.$item->icon;
						echo "\n\t\t\t\t\t<a href=\"{$href} {$onClick}\"><img src=\"{$ico}\" title=\"{$item->title}\" alt=\"{$item->title}\" /></a>";
					}

					if($config->showImgInVC && $item->image && file_exists(_SOBI_CMSROOT.$imagesFolder.$item->image)) {
						$img = $config->liveSite.$config->imagesFolder.$item->image;
						echo "\n\t\t\t\t\t<a href=\"{$href}\"><img src=\"{$img}\" title=\"{$item->title}\" alt=\"{$item->title}\" /></a>";
					}
					echo "\n\t\t\t\t\t<p class=\"sobi2ItemTitle\"><a href=\"{$href}\" {$onClick} title=\"{$item->title}\">{$item->title}</a></p>";
					if(count($sobi2Data) != 0) {
					 	foreach($sobi2Data as $field)
					 		echo $field;
					}
			    	if(count($config->S2_plugins)) {
			    		$plugins = "\n\t\t<table class='sobi2Listing_plugins'>\n\t\t\t<tr>";
			    		foreach($config->S2_plugins as $plugin) {
			    			if($plugin->listingStyle)
			    				$class = "class='{$plugin->listingStyle}'";
			    			else
			    				$class = null;
			    			if(method_exists($plugin,"showListing")) {
			    				$row = "<td {$class}>".$plugin->showListing($item->itemid)."</td>";
			    				$plugins .= $row;
			    			}
			    		}
			    		$plugins .= "\n\t\t\t</tr>\n\t\t</table>";
			    		echo $plugins;
					}
					echo "\n\t\t\t </td>";
					$tdTrCounter++;
				}
			}
			echo "\n\t\t </tr> \n\t </table>";
			?>
			<div id="sobi2PageNav">
			<?php if($currPage > 0) { ?>
				<a href="javascript:void(null);" onclick="sobiSearchRes(0);" class="pagenav"><?php echo _PN_LT; ?><?php echo _PN_LT; ?>&nbsp;<?php echo _PN_START; ?></a>
				<a href="javascript:void(null);" onclick="sobiSearchRes(<?php echo $currPage - 1; ?>);" class="pagenav"><?php echo _PN_LT; ?>&nbsp;<?php echo _PN_PREVIOUS; ?></a>
			<?php } else { ?>
				<span class="pagenav"><?php echo _PN_LT; ?><?php echo _PN_LT; ?>&nbsp;<?php echo _PN_START; ?></span>
				<span class="pagenav"><?php echo _PN_LT; ?>&nbsp;<?php echo _PN_PREVIOUS; ?></span>
			<?php } ?>
				<?php for($page = 0; $page < $pages; $page++) { ?>
					<?php if($currPage == $page) { ?>
						<span class="pagenav"><?php echo $page+1;?></span>
					<?php } else { ?>
						<a href="javascript:void(null);" onclick="sobiSearchRes(<?php echo $page;?>);" class="pagenav"><?php echo $page+1;?></a>
					<?php } ?>
				<?php } ?>
				<?php if($currPage < $pages - 1) { ?>
					<a href="javascript:void(null);" onclick="sobiSearchRes(<?php echo $currPage + 1;?>);" class="pagenav"><?php echo _PN_NEXT; ?>&nbsp;<?php echo _PN_RT; ?></a>
					<a href="javascript:void(null);" onclick="sobiSearchRes(-1);" class="pagenav"><?php echo _PN_END; ?>&nbsp;<?php echo _PN_RT; ?><?php echo _PN_RT; ?></a>
				<?php } else { ?>
					<span class="pagenav"><?php echo _PN_NEXT; ?>&nbsp;<?php echo _PN_RT; ?></span>
					<span class="pagenav"><?php echo _PN_END; ?>&nbsp;<?php echo _PN_RT; ?><?php echo _PN_RT; ?></span>
				<?php } ?>
			</div>
			<?php
		}
    }
    /**
     *
     * @param array $items
     * @param int $width
     * @param string $liveSite
     * @param sobi2Config $config
     * @param int $catid
     * @param int $tdTrCounter
     * @param mosUser $my
     */
    function searchResultsWithTemplate( $items, $width, $liveSite, $config, $catid, $tdTrCounter, $my )
    {
		sobi2Config::import("sobi2.class");
    	foreach( $items as $item ) {
			$item->title = $config->getSobiStr($item->title);
			$sobi2Data = sobiAxSearch::searchDetails($item,false);
			$fieldsFormated = $sobi2Data[0];
			$fieldsObjects = $sobi2Data[1];
			$plugins = array();
			$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}";
			$href = sobi2Config::sef($href);
			if($tdTrCounter%$config->itemsInLine == 0 && $tdTrCounter != 0)
				 echo "\n\t\t </tr> \n\t\t <tr>";
			$style = $width;

			if($item->background && file_exists(_SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$item->background}")) {
				$style = $style."background-image: url({$liveSite}/components/com_sobi2/images/backgrounds/{$item->background});";
			}
			else if(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg)))
			   	$style = $style."background-image: url({$liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";

			if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor)))
				$style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
			else
				$style = $style."'";

			if(!$my->id && !$config->allowAnoDetails) {
				$onClick = "onclick='alert(\""._SOBI2_JS_NOT_LOGGED_FOR_DETAILS."\"); return false;'";
				$href = "#";
			}
			else {
				$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;catid={$catid}&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}";
				$href = sobi2Config::sef($href);
				$onClick = null;
			}
	    	if( !$item->icon && $config->key( "frontpage", "default_ico" ) ) {
            	$item->icon = $config->key( "frontpage", "default_ico" );
            }

            if( !$item->image && $config->key( "frontpage", "default_img" ) ) {
            	$item->image = $config->key( "frontpage", "default_img" );
            }

            $imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );

			if($config->showIcoInVC && $item->icon && file_exists(_SOBI_CMSROOT.$imagesFolder.$item->icon)) {
				$ico = $config->liveSite.$config->imagesFolder.$item->icon;
				$ico = "<a href=\"{$href} {$onClick}\"><img src=\"{$ico}\" title=\"{$item->title}\" alt=\"{$item->title}\" /></a>";
			}
			else {
				$ico = null;
			}
			if($config->showImgInVC && $item->image && file_exists(_SOBI_CMSROOT.$imagesFolder.$item->image)) {
				$img = $liveSite.$config->imagesFolder.$item->image;
				$img = "<a href=\"{$href}\"><img src=\"{$img}\" title=\"{$item->title}\" alt=\"{$item->title}\" /></a>";
			}
			else {
				$img = null;
			}
			$title = "<p class='sobi2ItemTitle'><a href=\"{$href}\" {$onClick} title=\"{$item->title}\">{$item->title}</a></p>";
	    	if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $name => $plugin) {
	    			if(method_exists($plugin,"showListing")) {
	    				$plugins[$name] = $plugin->showListing($item->itemid);
	    			}
	    		}
			}
			sobi2VCview($item->itemid,$style, $ico, $img, $title, $fieldsObjects, $fieldsFormated, $plugins);
			echo "\n\t\t\t </td>";
			$tdTrCounter++;
		}
    }
    /**
     * getting details data (custom fields) for search results
     *
     * @param sobi2 $mySobi
     * @global sobi2Config $config
     * @global database $database
     * @return array
     */
    function searchDetails($mySobi,$html = true)
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$fieldsdata = array();
		$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
				 "WHERE `in_vcard`= 1 AND `enabled` = 1 " .
				 "ORDER BY position";
		$database->setQuery($query);
		$fieldids = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$fieldsObjects = array();
		$fieldsFormated = array();
		if($fieldids) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fieldsdata[] = new sobiField($fieldid->fieldid, $mySobi->itemid);
			}
		}
    	$itemData = array();
    	if( count($fieldsdata) ) {
			foreach($fieldsdata as $field) {
				$data = null;
				$field->name = $config->getSobiStr($field->fieldname);
				if($field->fieldType == 2) {
					$field->data = $config->getSobiStr($field->data, true);
					$data = $field->data;
				}
				elseif( $field->fieldType == 1 || $field->fieldType == 5 || $field->fieldType == 7 ) {
					$field->data = $config->getSobiStr($field->data);
					if( $field->isUrl == 4 ) {
						$data = $field->customCode;
					}
					else {
						$data = $field->data;
					}
				}
				elseif($field->fieldType == 3) {
					$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
					$field->with_label = 1;
				}
				elseif($field->fieldType == 6) {
					$field->data = $field->selectedValues;
					if(is_array($field->data) && !empty($field->data)) {
						$data .= "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
						foreach ($field->data as $opt) {
							$data .= "\n\t<li>{$opt}</li>";
						}
						$data .= "\n</ul>";
					}
				}
				$field->label = $config->getSobiStr($field->label);
				$tag = "span";
				if(strlen($data) > 0) {
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
						$data = "<a href=\"{$data}\"{$noFollow} title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}</a>";
					}
					else if($field->isUrl == 2) {
						if(!(defined("_SOBI_AJAX_SEARCH"))) {
							$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
						}
						else {
							$data = "<a href=\"mailto:{$data}\" title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}</a>";
						}
					}
					else if($field->isUrl == 3) {
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
					array_push($itemData, $data);
				}
				$fieldsFormated[$field->name] = $data;
				$fieldsObjects[$field->name] = $field;
			}
    	}
    	if(!$html) {
    		return array($fieldsFormated,$fieldsObjects);
    	}
    	else {
    		return $itemData;
    	}
    }
}
?>