<?php
/**
* @version $Id: entry.functions.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class sobiSpecFunc {
	/**
	 * executing mambots for a field
	 * @author Mnhas
	 * @link http://minimus.dmkhost.net
	 * @param string $text
	 * @global array $_MAMBOTS
	 * @return string
	 */
	function execMambots( $text )
	{
		if( class_exists( 'JPluginHelper' ) ) {
			return sobiSpecFunc::execJPlugins( $text );
		}
		global $_MAMBOTS;
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();

		$defaultItemId = $config->sobi2Itemid;

		// define ItemId for which you will execute mambots
	   	if ( isset($_REQUEST['Itemid']) ) {
	   		$n_ItemId = $_REQUEST['Itemid'];
	   	}
	   	else {
	   		$n_ItemId = $defaultItemId;
	   	}

		//prepare content: set $row main text variable;
		$row =& new stdClass();
		$row->text = $text;

		//initialize $params variable
		$menu =& sobi2bridge::jMenu( $database );
		$menu->load( $n_ItemId );
		$params =& sobi2bridge::jParams( $menu->params );

		$_MAMBOTS->loadBotGroup("content");
		//call on function onPrepareContent of all mambots in the group content
		//pass parameters '1'=published, $row, $params to those functions
		$args = array( 1, &$row, &$params );
		$_MAMBOTS->trigger( 'onPrepareContent', $args, false );
		//store parsed content in the original variable;
		$text = $row->text;
		return $text;
	}
	/**
	 * executing Joomla 1.5 plugins for a field
	 * @author Radek Suski
	 * @param string $text
	 * @return string
	 */
	function execJPlugins( $text )
	{
		$row =& new stdClass();
		$row->text = $text;
		JPluginHelper::importPlugin( 'content' );
		$dispatcher =& JDispatcher::getInstance();
		$mainframe =& JFactory::getApplication( 'site' );
		$params =& $mainframe->getParams( 'com_content' );
		$results = $dispatcher->trigger( 'onPrepareContent', array ( &$row, & $params, 0 ) );
		$text = $row->text;
		return $text;
	}
    /**
     * Returning array or string of selected categories
     *
     * @param  sobi2 $mySobi
     * @return array
     */
    function getMyCategories( $mySobi, $string = false, $wholePath = false )
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		if( $wholePath && $string ) {
			sobi2Config::import( "category.class" );
			$catSep = $config->key( "frontpage", "entry_show_cat_func_cat_sep", "<br/>" );
			$pathSep = $config->key( "frontpage", "entry_show_cat_func_path_sep", " >> " );
			$catsString = null;
			$mySobiCategories = array_flip( $mySobi->myCategories );
			foreach ( $mySobiCategories as $cid ) {
				$cats = array();
				$config->getParentCats( $cid, $cats );
				if( is_array( $cats ) && !empty( $cats ) ) {
					$catParts = array();
					foreach ( $cats as $catid ) {
						$category = new sobi2Category( $catid );
						$url = sobi2Config::sef( "index.php?option=com_sobi2&amp;catid={$category->catid}&amp;Itemid={$config->sobi2Itemid}" );
						$catParts[] = "<a href=\"{$url}\" title=\"{$category->name}\">{$category->name}</a>";
					}
					$catParts = array_reverse( $catParts );
					$catsString .= implode( $pathSep, $catParts );
				}
				$catsString .= $catSep;
			}
			return $catsString;
		}
		else {
			$cids = is_array( $mySobi->myCategories ) && !empty( $mySobi->myCategories ) ? implode(" , ", array_flip( $mySobi->myCategories ) ) : null;
			if( !$cids ) {
				return null;
			}
	    	$selectedCats = array();
	    	$catsString = array();
	    	$query = "SELECT name, icon, catid, introtext FROM `#__sobi2_categories` AS cat WHERE catid IN ({$cids}) AND cat.published = 1";
	    	$database->setQuery($query);
	    	$database->query();
	    	$categories = $database->loadObjectList();
			if ($database->getErrorNum()) {
				trigger_error("HTML_SOBI::getMyCategories(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	    	foreach ($categories as $category) {
	    		if($category->icon) {
	    			$img = "<img src=\"{$config->liveSite}{$config->catImagesFolder}{$category->icon}\" alt=\"{$category->name}\" title=\"{$category->introtext}\" />";
	    		}
	    		else {
	    			$img = null;
	    		}
	    		$href = sobi2Config::sef("index.php?option=com_sobi2&amp;catid={$category->catid}&amp;Itemid={$config->sobi2Itemid}");
	    		$selectedCats[] = array('name' => $category->name, 'href' => $href, 'icon' => $img, 'introtext' => $category->introtext);
	    		$catsString[] = "<a href=\"{$href}\" title=\"{$category->introtext}\">{$category->name}</a>";
	    	}
	    	if(!$string) {
	    		return $selectedCats;
	    	}
	    	return implode( "&nbsp;|&nbsp;", $catsString );
		}
    }
    /**
     * displaying hits
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function showHits($config,$mySobi)
    {
    	if($config->showHits) {
    		if( $config->key( "details_view", "show_hits_label", true ) ) {
    			echo   _SOBI2_HITS." ".$mySobi->hits;
    		}
    		else {
    			echo $mySobi->hits;
    		}
    	}
    }
    /**
     * displaying added date
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function addedDate($config,$mySobi)
    {
    	if($config->showAddedDate) {
    		$date = date( $config->key( "details_view", "added_date_format", "F j, Y, g:i a" ), strtotime( $mySobi->publish_up ) );
    		if( $config->key( "details_view", "show_added_date_label", true ) ) {
    			echo _SOBI2_DATE_ADDED." ".$date;
    		}
    		else {
    			echo $date;
    		}
    	}
    }
    /**
     * displaying selected tags for an entry
     *
     * @param array $metaKeys
     * @param int $count
     * @return string
     */
    function showTags($metaKeys, $count = 5)
    {
    	$config =& sobi2Config::getInstance();
    	if( is_a( $metaKeys, "sobi2" ) ) {
    		$metaKeys = $metaKeys->metakey;
    	}
    	if(!$metaKeys || empty($metaKeys)) {
    		return null;
    	}
    	$tags = explode(",",$metaKeys);
    	if( $config->key( "details_view", "show_tagged_label", true ) ) {
    		$string = _SOBI2_ENTRY_TAGGED_WITH;
    	}
    	else {
    		$string = null;
    	}
    	for ($i = 0; $i < $count; $i++) {
    		if(isset($tags[$i]) && !empty($tags[$i])) {
	    		$tag = trim($tags[$i]);
	    		$href = sobi2Config::sef("index.php?option=com_sobi2&amp;tag={$tag}&amp;Itemid={$config->sobi2Itemid}");
	    		$title = _SOBI2_ENTRIES_TAGGED_WITH." '{$tag}'";
	    		$string .= "<a href=\"{$href}\" title=\"{$title}\">{$tag}</a>";
	    		if($i != $count && isset($tags[$i + 1]) && !empty($tags[$i +1 ])) {
	    			$string .= ", &nbsp;";
	    		}
    		}
    		else {
    			break;
    		}
    	}
    	return $string;
    }
    /**
     * @param sobi2 $mySobi
     * @param int $days
     */
    function newLabel( $mySobi, $days = 3 )
    {
		if(strtotime($mySobi->publish_up) > mktime() - ($days * 86400)) {
			return  '<span class="sobiNewLabel">'._SOBI2_NEW_LABEL.'</span>';
		}
    }
    /**
     * @param sobi2 $mySobi
     * @param int $days
     */
    function updatedLabel( $mySobi, $days = 3 )
    {
		if(strtotime($mySobi->lastUpdate) > mktime() - ($days * 86400)) {
			return  '<span class="sobiUpdatedLabel">'._SOBI2_UPDATED_LABEL.'</span>';
		}
    }
    /**
     * @param sobi2 $mySobi
     * @param int $hits
     */
    function hotLabel( $mySobi, $hits = 500 )
    {
		if($mySobi->hits > $hits) {
			return  '<span class="sobiHotLabel">'._SOBI2_HOT_LABEL.'</span>';
		}
    }
    /**
     * @param sobi2 $mySobi
     * @param string $name
     */
    function userHref( $mySobi, $name = "real" )
    {
		if(!$mySobi->owner) {
			return null;
		}
    	$config =& sobi2Config::getInstance();
		$db =& $config->getDb();
		$user =& sobi2bridge::jUser( $db );
		$user->load( $mySobi->owner );
		$userLink = "index.php?option=com_sobi2&amp;sobi2Task=usersListing&amp;uid={$mySobi->owner}&amp;Itemid={$config->sobi2Itemid}";
		$userLink = sobi2Config::sef( $userLink );
		if( $name == 'real' ) {
			$uname = $user->name;
		}
		else {
			$uname = $user->username;
		}
		$title = str_replace( array( "%username%" ,"%name%" ), array( $user->username, $user->name ), _SOBI2_USER_OWN_LISTING );
		$userLink = "<a href=\"{$userLink}\" title=\"{$title}\">{$uname}</a>";
		return $userLink;
    }
    /**
     * @param sobi2 $mySobi
     * @param string $name
     */
    function userCBHref( $mySobi, $name = "real" )
    {
		if(!$mySobi->owner) {
			return null;
		}
		if( !sobi2Config::translatePath( "components|com_comprofiler|comprofiler", "root" ) ) {
			trigger_error( "Community Builder seems not to be installed.", E_USER_WARNING );
			return self::userHref( $mySobi, $name );
		}
    	$config =& sobi2Config::getInstance();
		$db =& $config->getDb();
		$user =& sobi2bridge::jUser( $db );
		$user->load( $mySobi->owner );
		if( !( class_exists( 'JFactory' ) ) ) {
			$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_comprofiler%' AND `type` = 'components' AND `published` = '1' LIMIT 1";
		}
		else {
			$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_comprofiler%' AND `type` = 'component' AND `published` = '1' LIMIT 1";
		}
		$db->setQuery( $query );
		$mid = $db->loadResult();
		if( $mid && is_int( $mid ) ) {
			$mid = "&amp;Itemid={$mid}";
		}
		else {
			$mid = null;
		}
		$userLink = "index.php?option=com_comprofiler&amp;task=userProfile&amp;user={$user->id}{$mid}";
		$userLink = sobi2Config::sef( $userLink );
		if( $name == "real") {
			$uname = $user->name;
		}
		else {
			$uname = $user->username;
		}
		$title = str_replace( array( "%username%" ,"%name%" ), array( $user->username, $user->name ), _SOBI2_USER_OWN_LISTING );
		$userLink = "<a href=\"{$userLink}\" title=\"{$title}\">{$uname}</a>";
		return $userLink;
    }
    /**
     * Enter description here...
     *
     * @param string $txt
     */
    function replace( $txt, $key = null )
    {
		static $def = array();
    	if( empty( $def ) ) {
    		$config =& sobi2Config::getInstance();
    		if( $file = sobi2Config::translatePath( $config->key( "string", "replace_definion", null ), "front", true, ".ini" ) ) {
    			$def = parse_ini_file( $file );
    		}
    		else {
    			trigger_error( "Cannot find replace definition file", E_USER_WARNING );
    			return $txt;
    		}
    	}
		if( !$key ) {
    		foreach ( $def as $replace => $with ) {
    			$txt = ereg_replace( "[[:<:]]{$replace}[[:>:]]", $with, $txt );
    		}
		}
		else {
			if( key_exists( $key, $def ) ) {
				$txt = ereg_replace( "[[:<:]]{$def[$key]}[[:>:]]", $with, $txt );
			}
			else {
				trigger_error( "Replacement key '{$key}' does not exist ", E_USER_WARNING );
			}
		}
    	return $txt;
    }
    function addedDateOnly($config,$mySobi)
    {
    	if($config->showAddedDate) {
   			echo _SOBI2_DATE_ADDED." ".date("j.n.Y",strtotime ($mySobi->publish_up));
		}
    }
    /**
     * Enter description here...
     *
     * @param sobiField $field
     * @param sobi2 $mySobi
     */
    function countClick( $field, $mySobi, $showCounter = true )
    {
    	$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$value = null;
		$count = null;
		static $script = false;
		if( $field->isUrl && strlen( $field->data ) ) {
			$onclick = "onclick=\"SobiCC( {$mySobi->id}, {$field->fieldid} );\"";
			$field->data_int = $field->data_int ? $field->data_int : 0;
			if( $showCounter ) {
				$count = str_replace( '%count%', $field->data_int, _CCOUNT_VISITED );
			}
			if( $field->isUrl == 1 ) {
				$value = "<a href=\"{$field->data}\" {$onclick} title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}{$count}</a>";
			}
			elseif( $field->isUrl == 2 ) {
				$value = "<a href=\"mailto:{$field->data}\" {$onclick} title=\"{$mySobi->title}\" target=\"_blank\">{$field->label}{$count}</a>";
			}
		}
		if( !$script ) {
			$script = true;
			$config->addCustomScript( 'function SobiCC( sid, fid ) { url = "index2.php?option=com_sobi2&no_html=1&sobi2&sobi2Task=countVisit&fid="+fid+"&sid="+sid+"Itemid='.$config->sobi2Itemid.'"; if ( window.XMLHttpRequest ) { SCCReq = new XMLHttpRequest(); if ( SCCReq.overrideMimeType ) { SCCReq.overrideMimeType( "text/xml" ); } } else if ( window.ActiveXObject ) { try { SCCReq = new ActiveXObject( "Msxml2.XMLHTTP" ); } catch ( e ) { try { SCCReq = new ActiveXObject( "Microsoft.XMLHTTP" ); } catch ( e ) {} } } SCCReq.open( "GET",url , true ); SCCReq.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" ); SCCReq.setRequestHeader( "Connection", "close" ); SCCReq.send( null ); } ' );
		}
		return $value;
    }
	/**
     * Enter description here...
     *
     * @param sobiField $field
     * @param sobi2 $mySobi
     */
    function toQuickEdit( $field, $mySobi )
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$sobi2Frontend = &$config->getFrontend();
		$my =& $config->getUser();
		static $loaded = false;
		static $admFields = array();
		$onclick = null;
		$data = $field->data;
		if( ( ($my->id != 0 && $my->id == $mySobi->owner && $config->allowUserToEditEntry ) || $config->checkPerm() ) && $config->key( "details_view", "allow_quick_edit" ) ) {
			if( !$config->checkPerm() && !$loaded ) {
				$query = "SELECT fieldid FROM `#__sobi2_fields` WHERE displayed = 1";
				$database->setQuery( $query );
				$admFields = $database->loadResultArray();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$fieldsIgnore = $config->key("details_view","quickedit_fields_ignore");
				if( strlen($fieldsIgnore) ) {
//					$fieldsIgnore = explode(",", $fieldsIgnore );
					array_push($admFields,$fieldsIgnore);
				}
			}
			if( !in_array( $field->fieldid, $admFields ) ) {
				$t = _JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT;
				$onclick = "ondblclick=\"sobiEditField('sobi2Details_{$field->fieldname}', {$field->fieldid})\" title=\"{$t}\"";
			}
		}
		$data = "\n\t\t<span {$onclick} id=\"sobi2Details_{$field->fieldname}\">{$data}</span>";
		return $data;
    }

    /**
     * PHP Function to Locally store website images from http://www.thumshots.org
     * Code is free. No guarantees or warranties.
     * Based on code by Daniel Schulman
     * @param string $url
     * @param string $alt
     * @param  string $style
     * @param string $params
     * @return string
     */
    function getThumbshotsOrg( $url, $alt = '', $style = 'border-style:none;', $params = null )
	{
		$config =& sobi2Config::getInstance();
		//EDITABLE PARAMETERS
		//Where Thumbnail images are stored locally
		$subDir = $config->key( "thumshots.org", "subdir_name", "thumbs" );
		$defImg = $config->key( "thumshots.org", "no_thumb" );
		$defImg = $config->key( "thumshots.org", "days_to_keep", 60 );
		$local_thumb_dir = sobi2Config::translateDirPath( "{$config->imagesFolder}|{$subDir}", "root", false );
		//How many days till check if new thumbnail
		$days_to_keep = 60;
		//To use if no thumbnail exists
		$return_img = sobi2Config::translatePath( "{$config->imagesFolder}|{$subDir}|{$defImg}", "root", false, '' );
		//END EDITABLE

		if( !file_exists( $local_thumb_dir ) ) {
			sobi2Config::sobiMakePath( $local_thumb_dir );
		}

		if ( substr( $url, 0, 4 ) != 'http' ) {
			$url = 'http://' . $url; //Make sure URL proper
		}
		$url 			= urlencode( $url );
		$fname			= str_replace( array( '%3A', '%2F', '%3F', '%3D', '%26' ), '_', $url );
		$full_img_path	= sobi2Config::translatePath( "{$config->imagesFolder}|{$subDir}|{$fname}", "root", false, '.jpg' );

		if( file_exists( $full_img_path ) ) {
			//check age
			$diff =( time() - filemtime( $full_img_path) ) /60 /60 /24 ;
	        if ( $diff > $days_to_keep ) {
				unlink( $full_img_path );
			}
			else {
				$return_img = "{$config->liveSite}/{$config->imagesFolder}/{$subDir}/{$fname}.jpg";
			}
		}
		if( !file_exists( $full_img_path ) ) {
			//get from thumbshots.org
			$buff = file_get_contents( "http://open.thumbshots.org/image.pxf?url={$url}" );
			if( strlen( $buff ) ) {
				$fp = fopen( $full_img_path, "wb" );
				fwrite( $fp,$buff );
	 		    fclose( $fp );
				$return_img = "{$config->liveSite}/{$config->imagesFolder}/{$subDir}/{$fname}.jpg";
			}
		}
		$html = "<img src=\"{$return_img}\" style=\"{$style}\" alt=\"{$alt}\" {$params} />";
		return $html;
	}
    function createWaySearchUrl( $sobi2Id )
    {
		$config =& sobi2Config::getInstance();
		if(!$config->useWaySearch) {
			return null;
		}
    	$waySearchLink = $config->waySearchUrl;
		$fields = array();
		$counter = 0;
		sobi2Config::import("field.class");
		foreach ( $config->waySearchFields as $k => $fid ) {
			if( $fid ) {
				$field = new sobiField( $fid, $sobi2Id );
				$fields[ $k ] = urlencode( $config->getSobiStr( $field->data ) );
				if( !empty( $field->data ) ) {
					$counter++;
				}
			}
		}
		if( $counter < $config->key( "url", "way_search_min_fields", 2 ) ) {
			return null;
		}
		$WSstreet 		= isset($fields['STREET']) ? $fields['STREET'] : null;
		$WScity 		= isset($fields['CITY']) ? $fields['CITY'] : null;
		$WSpostcode 	= isset($fields['ZIPCODE']) ? $fields['ZIPCODE'] : null;
		$WScounty 		= isset($fields['COUNTY']) ? $fields['COUNTY'] : null;
		$WSfstate 		= isset($fields['FEDSTATE']) ? $fields['FEDSTATE'] : null;
		$WScountry 		= isset($fields['COUNTRY']) ? $fields['COUNTRY'] : null;
		$waySearchLink = str_replace(
					array( "STREET", 	"CITY", 	"ZIPCODE", 		"COUNTY", 	"FEDSTATE", "COUNTRY" ),
					array( $WSstreet, 	$WScity, 	$WSpostcode, 	$WScounty,	$WSfstate,	$WScountry ),
					$waySearchLink
		);
		$waySearchLink = str_replace('&', '&amp;', $waySearchLink );
		$waySearchLink = str_replace('\\', null, $waySearchLink );
		$waySearchLink = html_entity_decode( $waySearchLink );
		$waySearchLink = "<span class=\"sobi2WaySearch\"><a href=\"{$waySearchLink}\" class=\"sobi2WaySearch\" target=\"_blank\">{$config->waySearchLabel}</a></span>";
		return $waySearchLink;
    }
    /**
     *
     * @param sobi2 $mySobi
     * @param sobi2config $config
     * @return string
     */
    function showGoogleMaps($mySobi, $config)
    {

		if( !$config->useGoogleMaps || !isset( $config->googleMapsApiKey ) ) {
			return null;
		}
		$map_url = $config->key( "google_maps", "google_map_url", "http://maps.google.com");
		$map_api_version = $config->key("google_maps", "google_map_apiversion", "2");

		$title = $config->jsAddSlashes( $mySobi->title );
		$GeoPos = $config->getGeoPosition( $mySobi->id );
		if( $GeoPos['lat'] && $GeoPos['long'] && is_numeric( $GeoPos['lat'] ) && is_numeric( $GeoPos['lat'] ) ) {
			?>
						<div style="width: <?php echo $config->googleMapsWidth; ?>px; height: <?php echo $config->googleMapsHeight; ?>px;" id="sobi2GoogleMaps"></div>
						<script src="<?php echo $map_url?>/maps?file=api&amp;v=<?php echo $map_api_version?>&amp;key=<?php echo $config->googleMapsApiKey ?>" type="text/javascript"></script>
						<script type="text/javascript">
				//<![CDATA[
				function loadmap(){
                    if (GBrowserIsCompatible()) {
                        var center = new GLatLng(<?php echo $GeoPos['lat']; ?>, <?php echo $GeoPos['long']; ?>);
                        var SobiGeoMap = new GMap2(document.getElementById("sobi2GoogleMaps"));
					<?php
					if( $config->key( "google_maps", "small_map_control", true ) ) {
						echo "SobiGeoMap.addControl(new GSmallMapControl());\n";
					}
					if( $config->key( "google_maps", "map_type_control", false ) ) {
//						echo "SobiGeoMap.addControl(new GMapTypeControl());\n";
						echo "var mapControl = new GHierarchicalMapTypeControl();";
						echo "SobiGeoMap.addMapType(G_PHYSICAL_MAP);";

						// Set up map type menu relationships
						echo "mapControl.clearRelationships();";
						echo "mapControl.addRelationship(G_SATELLITE_MAP, G_HYBRID_MAP, '"._SOBI2_GOOGLEMAPS_LABEL."', true);";

						echo "SobiGeoMap.addControl(mapControl);";
					}
					if( $config->key( "google_maps", "large_map_control", false ) ) {
						echo "SobiGeoMap.addControl(new GLargeMapControl());\n";
					}
					if( $config->key( "google_maps", "small_zoom_control", false ) ) {
						echo "SobiGeoMap.addControl(new GSmallZoomControl());\n";
					}
					if( $config->key( "google_maps", "scale_control", false ) ) {
						echo "SobiGeoMap.addControl(new GScaleControl());\n";
					}
					if( $config->key( "google_maps", "overview_map_control", false ) ) {
						echo "SobiGeoMap.addControl(new GOverviewMapControl());\n";
					}
					if( !$config->googleMapsBubble) {
						echo "var marker = new GMarker(center);\n";
					}
					else {
						echo "var marker = new DirectionMarker(center, '{$title}', '{$title}'); \n";
					}
					echo "SobiGeoMap.setCenter(center, {$config->googleMapsZoom}); \n";
					echo "SobiGeoMap.addOverlay(marker); \n";
					if( $config->googleMapsBubble == 2 ) {
						echo "marker.openInfo(); \n";
					}
					if( $mtype = $config->key( "google_maps", "map_type", false ) ) {
						echo "SobiGeoMap.setMapType({$mtype}); \n";
					}
					echo "\n}\n}\n";
				?>
						if(window.attachEvent){
							window.attachEvent('onload', loadmap);
						}
						else if(window.addEventListener){
							window.addEventListener('load', loadmap, false);
						}
				<?php if( $config->googleMapsBubble){ ?>
					function extend(subclass, superclass) {
						function Dummy() {}
						Dummy.prototype = superclass.prototype;
						subclass.prototype = new Dummy();
						subclass.prototype.constructor = subclass;
						subclass.superclass = superclass;
						subclass.superproto = superclass.prototype;
					}
					extend( DirectionMarker, GMarker);
					function DirectionMarker( point, name, html ){
						DirectionMarker.superclass.call(this, point);
						this.point = point;
						this.name = name;
						this.html = html +
							   '<form action="http://maps.google.com/maps" method="get" target="_blank" onsubmit="DirectionMarker.submit(this);return false;">' +
						       '<br /><?php echo _SOBI2_GOOGLEMAPS_DIR ?><input type="radio" checked name="dir" value="to"> <b><?php echo _SOBI2_GOOGLEMAPS_TO; ?></b> <input type="radio" name="dir" value="from"><b><?php echo _SOBI2_GOOGLEMAPS_FROM; ?></b>' +
						       '<br /><?php echo _SOBI2_GOOGLEMAPS_ADDR ?><input type="text" class="inputbox" size="20" name="saddr" id="saddr" value="" /><br />' +
						       '<input value="<?php echo _SOBI2_GOOGLEMAPS_GET_DIR ?>" class="button" type="submit" style="margin-top: 2px;">' +
						       '<input type="hidden" name="daddr" value="' +
						       this.point.y + ',' + this.point.x + "(" + this.name + ")" + '"/></form>';
						       // The info window version with the "to here" form open
						 GEvent.addListener(this, "click", function() {
							 this.openInfoWindowHtml('<div style="white-space:nowrap; text-align: left;">'+this.html+'</div>');
						 });
					}
					DirectionMarker.prototype.openInfo = function() {
						this.openInfoWindowHtml('<div style="white-space:nowrap; text-align: left;">'+this.html+'</div>');
					}
					DirectionMarker.submit = function( formObj ){
						if(formObj.dir[1].checked ){
							tmp = formObj.daddr.value;
							formObj.daddr.value = formObj.saddr.value;
							formObj.saddr.value = tmp;
						}
						formObj.submit();
					}
					<?php } ?>
				//]]>
						</script>
<?php
		}
		elseif ( ( strlen( trim($GeoPos['lat'] ) ) && strlen( trim( $GeoPos['long'] ) ) ) && !is_numeric( $GeoPos['lat'] ) || !is_numeric( $GeoPos['lat'] ) ) {
			trigger_error("HTML_SOBI::showGoogleMaps(): Given cooordinates ({$GeoPos['lat']}, {$GeoPos['long']}) are not correct. Please enter float values");
		}
    }
    function waySearchUrl( $waySearchLink )
    {
		$config =& sobi2Config::getInstance();
		if($config->useWaySearch) {
			echo $waySearchLink;
		}
    }
}
?>