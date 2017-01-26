<?php
/**
* @version $Id: search.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class sobiSearch {
	/**
	 * search function
	 *
	 * @param integer $catid
	 */
	function searchSobi($catid = 0)
	{
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$sobi2Frontend = &$config->getFrontend();
    	$pageNav = null;
    	$items = null;
    	$res = false;
    	$countResults = 0;
    	$fieldData = array();
    	$and = null;
    	$dataForFields = array();
    	$sobi2IDs = array();
   		$searchString = sobi2Config::request($_REQUEST, 'sobi2Search');
   		$phrase = sobi2Config::request($_REQUEST, 'searchphrase', null);
   		$pluginsOutput = null;
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
			trigger_error("searchSobi: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		if($fieldids) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fields[] = new sobiField($fieldid->fieldid);
			}
		}
		if( count( $fields ) ) {
			foreach($fields as $field) {
				if( ($field->fieldType == 5 || $field->fieldType == 6 ) && !(empty($field->definedValues))) {
			   		$options = array();
			   		if(!$field->selectLabel) {
			   			$options[] = sobiHTML::makeOption('all', _SOBI2_SELECT);
			   		}
			   		foreach ($field->definedValues as $option => $value) {
			   			$options[] = sobiHTML::makeOption($option, $value);
			   		}
					$selectList = sobiHTML::selectList( $options, $config->getSobiStr($field->fieldname), 'size="1" class="inputbox"', 'value', 'text', sobi2Config::request($_REQUEST, $field->fieldname, null ) );
					$dropListsArray = $dropListsArray + array($field->label => $selectList);
				}
				else {
					/*
					 * get data for this fields
					 */
					$query = "SELECT DISTINCT data_txt as fielddata, sobifields.fieldType FROM `#__sobi2_fields` AS sobifields " .
							 "LEFT JOIN `#__sobi2_fields_data` AS fielddata ON sobifields.fieldid = fielddata.fieldid " .
							 "LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid " .
							 "WHERE sobifields.fieldid = {$field->fieldid} ORDER BY fielddata";
					$database->setQuery( $query );
			    	$results = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("searchSobi: DB reports: ".$database->stderr(), E_USER_WARNING);
					}

					/*
					 * get all options for this field
					 */
					if(sizeof($results) != 0) {
						$fieldData = array();
						$fieldData[] = sobiHTML::makeOption( 'all', _SOBI2_SELECT );
						foreach($results as $result) {
							if($result->fielddata) {
								if($result->fieldType == 3) {
									$label = $result->fielddata ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
									$data = $result->fielddata ? 1 : 0;
									$fieldData[] = sobiHTML::makeOption( '-1', _SOBI2_CHECKBOX_NO);
								}
								else
									$data = $label = $config->getSobiStr($result->fielddata);
								$fieldData[] = sobiHTML::makeOption( $data, $label);
							}
						}
						$selectList = sobiHTML::selectList( $fieldData, $config->getSobiStr($field->fieldname), 'size="1" class="inputbox"', 'value', 'text', sobi2Config::request($_REQUEST, $field->fieldname, null ) );
						$dropListsArray = $dropListsArray + array($field->label => $selectList);
					}
				}
			}
		}
		/*calling plugins*/
   		if(!empty($config->S2_plugins)) {
   			foreach($config->S2_plugins as $plugin) {
   				if(method_exists($plugin, "onSearchStart")) {
   					$plugin->onSearchStart($searchString,$phrase,$dropListsArray);
   				}
   			}
   		}

		/*////////////////////////////////////////////////////////////////////////////////////////////
		 * build drop' down lists end
		 *////////////////////////////////////////////////////////////////////////////////////////////
   		/*
   		 * if we looking for string
   		 */
   		if($searchString) {
   			$searchString = str_replace("%20", " ", $searchString);
   			$res = true;
   			$lookingIndropDownList = false;
   			require_once( _SOBI_CMSROOT.DS."includes".DS."pageNavigation.php" );
   			foreach($fields as $field) {
   				$getField = sobi2Config::request($_REQUEST, $field->fieldname, null);
   				/*
   				 * if becoming data for this field
   				 */
   				if(count($sobi2IDs) != 0) {
   					$sobi2IDs = array_unique($sobi2IDs);
   					$and = implode($sobi2IDs, " OR sdata.itemid = ");
   					$and = " AND (sdata.itemid = {$and}) ";
   				}
   				if($getField && $getField != 'all') {
	   				if($getField == '-1') {
	   					$getField = 0;
	   				}
   					unset($sobi2IDs);
   					$sobi2IDs = array();
   					$lookingIndropDownList = true;
   					$dataForFields += array($field->fieldname => $getField);
   					$getField = $config->clearSQLinjection($getField);
   					$now = $config->getTimeAndDate();
					$query = "SELECT DISTINCT `sdata`.`itemid` " .
	                     "FROM `#__sobi2_fields` AS sobifields " .
	                     "LEFT JOIN `#__sobi2_fields_data` AS sdata ON sobifields.fieldid = sdata.fieldid " .
	                     "LEFT JOIN `#__sobi2_language` AS snames ON snames.fieldid =  sobifields.fieldid " .
	                     "LEFT JOIN `#__sobi2_item` AS item ON sdata.itemid = item.itemid " .
	                     "WHERE (snames.langKey = '{$field->fieldname}' AND sdata.data_txt = '{$getField}' {$and})" .
	                     "AND item.published = 1 AND (item.publish_down > '{$now}' OR item.publish_down = '{$config->nullDate}' )";
	                $database->setQuery($query);
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	                if(count($database->loadObjectList()) != 0) {
		   				foreach($database->loadObjectList() as $item)
							$sobi2IDs[] = $item->itemid;
	   				}
	   				else {
	   					unset($sobi2IDs);
	   					$sobi2IDs = array(null);
	   				}
	   			}
	   			$sobi2IDs = array_unique($sobi2IDs);
   			}
   			/*
   			 *  ^^^ her we have all id's for items having (selcted) data from select boxes ^^^
   			 */
   			/*
   			 * if we don't looking in dropdown then we have not ID's, else if we don't have ID's, we don't have to search for enything
   			 */
   			if(trim($searchString) != trim(_SOBI2_SEARCH_INPUTBOX) && ((!$lookingIndropDownList && count($sobi2IDs) == 0) || ($lookingIndropDownList && count($sobi2IDs) != 0))) {
	   			$searchString = $config->clearSQLinjection(trim($searchString));
	   			$searchString = $database->getEscaped($searchString);
	   			switch ($phrase) {
	   				case 'exact':
	   					$where = "LOWER(sdata.data_txt) LIKE '%{$searchString}%'";
	   				break;
	   				case 'any':
	   				case 'all':
	   					if($phrase == 'any') {
	   						$and_or = ' OR ';
	   					}
	   					else if($phrase == 'all') {
	   						$and_or = ' AND ';
	   					}

	   					$words = explode( ' ', $searchString );
	   					$count = 0;
	   					foreach ($words as $word) {
	   						if($count != 0)
	   							$where .= "{$and_or} LOWER(sdata.data_txt) LIKE '%{$word}%' ";
	   						else
	   							$where = " LOWER(sdata.data_txt) LIKE '%{$word}%' ";
	   						$count++;
	   					}
	   				break;
	   			}
	   			/*
	   			 * now get the fields in there we have to looking for
	   			 */
				$query = "SELECT sobifields.fieldid  " .
						 "FROM `#__sobi2_fields` AS sobifields " .
						 "WHERE ((`in_search` = 1  OR `in_search` = 2 ) AND `enabled` = 1)";

			    $database->setQuery( $query );
		    	$searchInTo = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
		    	$and = null;
		    	if(count($searchInTo) != 0) {
		    		foreach($searchInTo as $field) {
		   				if(count($sobi2IDs) != 0) {
		   					$sobi2IDs = array_unique($sobi2IDs);
		   					$and = implode($sobi2IDs, " OR sdata.itemid = ");
		   					$and = " AND (sdata.itemid = {$and}) ";
		   				}
		   				unset($sobi2IDs);
		   				$sobi2IDs = array();
	   					$query = "SELECT DISTINCT `itemid` " .
		   					"FROM `#__sobi2_fields` AS sfield " .
		   					"LEFT JOIN `#__sobi2_fields_data` AS sdata ON sfield.fieldid = sdata.fieldid " .
		   					"WHERE (sfield.fieldid = '{$field->fieldid}' AND {$where} {$and})";
		   				$database->setQuery($query);
		   				if(count($database->loadObjectList()) > 0) {
			   				foreach($database->loadObjectList() as $item)
			   					$sobi2IDs[] = $item->itemid;
			    		}
		    		}
		    	}
		    	$sobi2IDs = array_unique($sobi2IDs);
		    	/*
		    	 * last part - getting this information from sobi2_items table
		    	 */
	   			switch ($phrase) {
	   				case 'exact':
	   					$where = "LOWER(title) LIKE '%{$searchString}%' ";
	   					$where .= "OR LOWER(metakey) LIKE '%{$searchString}%' ";
	   					$where .= "OR LOWER(metadesc) LIKE '%{$searchString}%' ";
	   				break;
	   				case 'any':
	   				case 'all':
	   					if($phrase == 'any') {
	   						$and_or = ' OR ';
	   					}
	   					else if($phrase == 'all') {
	   						$and_or = ' AND ';
	   					}

	   					$words = explode( ' ', $searchString );
	   					$count = 0;
	   					foreach ($words as $word) {
	   						if($count != 0)
	   							$where .= "{$and_or} ( LOWER(title) LIKE '%{$word}%' ) ";
	   						else
	   							$where = "(( LOWER(title) LIKE '%{$word}%' )";
	   						$count++;
	   					}
	   					$count = 0;
	   					foreach ($words as $word) {
	   						if($count != 0)
	   							$where .= "{$and_or} ( LOWER(metakey) LIKE '%{$word}%' ) ";
	   						else
	   							$where .= "OR ( LOWER(metakey) LIKE '%{$word}%' ) ";
	   						$count++;
	   					}
	   					$count = 0;
	   					foreach ($words as $word) {
	   						if($count != 0)
	   							$where .= "{$and_or} ( LOWER(metadesc) LIKE '%{$word}%' ) ";
	   						else
	   							$where .= "OR ( LOWER(metadesc) LIKE '%{$word}%' )";
	   						$count++;
	   					}
	   					$where .= ") ";
	   				break;
	   			}
   				$and = str_replace("sdata.itemid","`itemid`",$and);

   				if($lookingIndropDownList) {
	   				$query = "SELECT DISTINCT `itemid` FROM `#__sobi2_item` WHERE ({$where} {$and})";
   				}
	   			else {
	   				$and = str_replace("AND", "OR", $and);
	   				$query = "SELECT DISTINCT `itemid` FROM `#__sobi2_item` WHERE ({$where} {$and})";
	   			}
				$database->setQuery($query);
				if(count($database->loadObjectList()) > 0) {
	   				foreach($database->loadObjectList() as $item)
	   					$sobi2IDs[] = $item->itemid;
				}
   			}
   			$sobi2IDs = array_unique($sobi2IDs);
   			if(!empty($config->S2_plugins)) {
   				foreach ($config->S2_plugins as $plugin) {
   					if(method_exists($plugin,"onSearchResult")) {
   						$plugin->onSearchResult($sobi2IDs, $dataForFields, $pluginsOutput);
   					}
   				}
   			}
   			if(count($sobi2IDs) != 0) {
   				/*
   				 * now we have all id's from items contains search strings
   				 */
				$whereId = implode(" , ", $sobi2IDs);
   				$now = date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  );

   				$limitstart = intval(sobi2Config::request($_REQUEST, 'limitstart', 0));
   				$limit = $config->itemsInLine * $config->lineOnSite;
   				$pageNav =& sobi2bridge::jPageNav( count($sobi2IDs), $limitstart, $limit );
   				$limits = " LIMIT {$limitstart}, {$limit} ";
				$config->listingOrdering = str_replace("relation.",null,$config->listingOrdering);
	    			$query = "SELECT itemid, title, owner, image, background, icon, metadesc, publish_up FROM `#__sobi2_item` AS items " .
    				 	 "WHERE ( items.itemid IN ({$whereId}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) ) ORDER BY {$config->listingOrdering} {$limits}";
   				$database->setQuery($query);
   				$items = $database->loadObjectList();
   				$countResults = count($sobi2IDs);
   			}

   		}
   		$searchString = str_replace("\\", null, $searchString);
   		/*
   		 * end of search function
   		 */
		$config->set( "searchResults", $items );
   		sobiSearch::showSearchForm($dropListsArray,$config,$items,$pageNav,$dataForFields,$config->getSobiStr($searchString),$catid,$countResults,$phrase,$res,$pluginsOutput);
		echo $sobi2Frontend->getFooter();
    }
    /**
     * Enter description here...
     *
     * @param array $dropListsArray
     * @param sobi2config $config
     * @param array $items
     * @param mosPageNav $pageNav
     * @param array $fieldData
     * @param string $searchString
     * @param int $catid
     * @param int $total
     * @param string $phrase
     * @param bool $res
     */
    function showSearchForm( $dropListsArray,$config,$items,$pageNav,$fieldData,$searchString,$catid,$total,$phrase,$res,$pluginsOutput ) {

		$my = &$config->getUser();
		if(!$searchString) {
			$String = _SOBI2_SEARCH_INPUTBOX;
		}
		else {
			$String = $searchString;
		}
		if($searchString == _SOBI2_SEARCH_INPUTBOX) {
			$resultsFor = _SOBI2_SEARCH_ALL_ENTRIES;
		}
		else {
			$resultsFor = $searchString;
		}
		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["search"] ) && $config->templates["search"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["search"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		if($config->showComponentDescInSearch) {
			sobi2Config::import("category.class");
			$sobi2Desc = new sobi2Category(1);
			$sobi2Desc->description = HTML_SOBI::execMambots($sobi2Desc->description);
			?>
			<table class='sobi2CompDesc' width='100%'>
				<tr>
					<td>
					<?php if($sobi2Desc->image) { ?>
						<img src="<?php echo $config->liveSite;?><?php echo $config->catImagesFolder; ?><?php echo $sobi2Desc->image; ?>"  style="float:<?php echo $sobi2Desc->image_position;?>" alt="<?php echo $config->componentName;?>" title="<?php echo $config->componentName;?>"/>
					<?php } ?>
						<?php echo $sobi2Desc->description;?>
					</td>
				</tr>
			</table>
			<?php
		}
	?>
		<br/>
		<form method="get" action="index.php" name="sobi2Search" id="sobi2Search">
			<input type="hidden" name="option" value="com_sobi2" />
			<input type="hidden" name="sobi2Task" value="search" />
			<input type="hidden" name="Itemid" value="<?php echo $config->sobi2Itemid; ?>" />

		<table class="sobi2eSearchForm">
			<tr>
				<td><?php if( $config->key("search", "search_box", true )) { echo _SOBI2_SEARCH_FOR; } ?></td>
				<td>
					<?php if( $config->key("search", "search_box", true )) { ?>
						<input name="sobi2Search" id="sobi2Search" class="inputbox" value="<?php echo $String; ?>" onclick="if (this.value == '<?php echo _SOBI2_SEARCH_INPUTBOX; ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php echo _SOBI2_SEARCH_INPUTBOX; ?>';"/>
					<?php } ?>
				</td>
				<td>
					<input type="submit" id="sobiSearchSubmitBt" name="search"  onmousedown="$('SobiSearchPage').value = 0" onkeydown="$('SobiSearchPage').value = 0" class="button" value="<?php echo _SOBI2_SEARCH_H; ?>"/>
				</td>
				<td id="sobi2eSearchEmptyCell">
				<?php
		    		if( ($f = $config->key( "search", "empty_cell_calback_function", false )) && function_exists( $f )) {
		    			$ecell = call_user_func( $f );
		    		}
		    		else {
		    			$ecell = "&nbsp;";
		    		}
		    		echo $ecell;
				?>
				</td>
			</tr>
			<tr>
				<td colspan="4">
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
				<td colspan="4"><hr/></td>
			</tr>
			<?php
					if(sizeof($dropListsArray) != 0)
						foreach($dropListsArray as $label => $dropList)
							echo "<tr><td>{$label}</td><td colspan='2'>{$dropList}</td></tr>";
			?>
			</table>
			</form>
			<br/>
			<?php if($res) { ?>
			<table>
			<tr>
				<th class="componentheading"><?php echo _SOBI2_SEARCH_RESULTS; ?></th>
			</tr>
			<tr>
				<td>
					<?php echo _SOBI2_SEARCH_RESULTS_FOUND; ?> <?php echo $total; ?>
					<?php echo _SOBI2_SEARCH_RESULTS_FOUND_RESULTS; ?>
					<span id="sobi2SearchResultsSerchingString"><?php echo $resultsFor; ?></span>
				</td>
			</tr>
			</table>
			<?php } ?>
			<?php echo $pluginsOutput; ?>
		<?php
		$tdTrCounter = 0;
		if(count($items) != 0) {
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
				sobiSearch::searchResultsWithTemplate($items,$width,$config->liveSite,$config,$catid,$tdTrCounter,$my);
			}
			else {
				foreach($items as $item) {
					$item->title = $config->getSobiStr($item->title);
					$sobi2Data = sobiSearch::searchDetails($item);
					$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}";
					$href = sobi2Config::sef($href);
					if($tdTrCounter%$config->itemsInLine == 0 && $tdTrCounter != 0)
						 echo "\n\t\t </tr> \n\t\t <tr>";

					$style = $width;
					if($item->background && file_exists(_SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$item->background}")) {
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
			$link = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=search&amp;Itemid={$config->sobi2Itemid}";
			foreach($fieldData as $field => $data)
				$link .= "&amp;{$field}={$data}";
				$link .= "&amp;sobi2Search={$searchString}";
				$link .= "&amp;searchphrase={$phrase}";
				echo "\n\t\t </tr> \n\t </table>";
				echo '<div id="sobi2PageNav">';
				echo sobi2bridge::writePagesLinks( $pageNav, $link );
				echo '</div>';
		}
    }
    function searchResultsWithTemplate($items,$width,$liveSite ,$config,$catid,$tdTrCounter,$my)
    {
		sobi2Config::import("sobi2.class");
    	foreach($items as $item) {
			$item->title = $config->getSobiStr($item->title);
			$sobi2Data = sobiSearch::searchDetails($item,false);
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
		$fieldsObjects = array();
		$fieldsFormated = array();
		if($fieldids) {
			sobi2Config::import("field.class");
			foreach($fieldids as $fieldid) {
				$fieldsdata[] = new sobiField($fieldid->fieldid, $mySobi->itemid);
			}
		}
    	$itemData = array();
    	if(count($fieldsdata) > 0) {
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
							$data = "<{$tag} class=\"sobi2Listing_{$field->name}\"><span class=\"sobi2Listing_{$field->name}_label\">{$field->label}</span>: {$data}</{$tag}>";
						}
						else {
							$data = "<span class=\"sobi2Listing_{$field->name}_label\">{$field->label}</span>: {$data}";
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
