<?php
/**
* @version $Id: sobi2.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
	( defined( "_VALID_MOS" ) || defined( "_JEXEC" ) ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
	defined( "_SOBI2_" )  	|| define( "_SOBI2_", true );
	defined( "_SOBI2_OPT" ) || define( "_SOBI2_OPT", "com_sobi2" );

	$timeStart = microtime(true);
	if( function_exists( "memory_get_usage" ) ) {
		$memStart = memory_get_usage();
	}
	else {
		$memStart = 0;
	}

	defined("_SOBI_FE_PATH") ||  define("_SOBI_FE_PATH", dirname(__FILE__) );
/*
 *  Get some common variables from the $_REQUEST global
 */
	defined( "DS" ) 			|| define( "DS",DIRECTORY_SEPARATOR );
	defined( "_SOBI_CMSROOT" ) 	||  define( "_SOBI_CMSROOT", str_replace( DS."components".DS._SOBI2_OPT, null, _SOBI_FE_PATH ) );
	if( !file_exists( _SOBI_CMSROOT.DS."includes".DS."joomla.php" ) ) {
		define( '_SOBI_MAMBO', true );
	}
	require_once( _SOBI_FE_PATH.DS.'config.class.php' );
	$config =& sobi2Config::getInstance();
	if( $config->debug > 100 ) {
		$debugLevel = $config->debug - 100;
	}
	else {
		$debugLevel = $config->debug;
	}
	if($config->debug >= 0) {
		switch ($debugLevel) {
			case 7:
				$restoreErrorReporting = error_reporting(E_ERROR);
				break;
			case 8:
				$restoreErrorReporting = error_reporting(E_WARNING | E_ERROR);
				break;
			default:
			case 9:
				$restoreErrorReporting = error_reporting(E_ALL);
				break;
		}
	}
	else {
		$restoreErrorReporting = error_reporting();
	}
	if($config->debug > 100) {
		ini_set("display_errors","on");
	}
	else {
		set_error_handler ("overideErrorHandling");
	}

	$config->memStart = $memStart;
	$config->timeStart = $timeStart;

	$sobi2Task = sobi2Config::request( $_REQUEST, 'sobi2Task', null );
	$catid = intval( sobi2Config::request($_REQUEST, 'catid', 0 ) );
	$letter = sobi2Config::request( $_REQUEST, "letter", null );
	$tag = sobi2Config::request( $_REQUEST, "tag", null);
	$task = $sobi2Task ? $sobi2Task : ( $letter ? "alphaListing" : ( $tag ? "tagListing" : "category_{$catid}" ) ) ;
	$doCache = false;
	$IgnoreTaskCache = $config->key( "general", "cache_ignore_task");
	if( strlen( $IgnoreTaskCache ) ) {
		$IgnoreTaskCache = explode(",",$IgnoreTaskCache);
	}
	else {
		$IgnoreTaskCache = array();
	}
	$request = array();
	if( $config->cacheL2Enabled && !in_array( $task, $IgnoreTaskCache ) ) {
		if( !parseParams( $request ) ) {
			$config->cacheL2Enabled = false;
		}
	}
	else {
		$config->cacheL2Enabled = false;
	}
	$config->set_( "requestParams", $request );

	sobi2Config::import("sobi2.html");
	sobi2Config::import("frontend.class");
	sobi2Config::import("includes|tab.class");
	sobi2Config::import("includes|html");

	$id 			= intval(sobi2Config::request($_REQUEST, 'id', 0));
	$Itemid 		= intval(sobi2Config::request($_REQUEST, 'Itemid', 0));
	$sobi2Id 		= intval(sobi2Config::request($_REQUEST, 'sobi2Id', 0));
	$mainframe 		=& $config->getMainframe();
	$catid 			= $catid == 1 ? 0 : $catid;
	$_REQUEST["catid"] = $catid;

/*
 * build configuration
 */
	$my = &$config->getUser();
	$mainframe = &$config->getMainframe();

	if( $sobi2Task == 'rss' ) {
		sobi2Config::import( "includes|rss.class" );
		$rssFeed = new sobi2RRS( $catid );
		$rssFeed->showFeed();
		exit();
	}

	if (!file_exists( _SOBI_FE_PATH.DS.'languages'.DS.$config->sobi2Language.'.php' ) ) {
		$config->sobi2Language = 'english';
	}
	require_once( _SOBI_FE_PATH.DS.'languages'.DS.$config->sobi2Language.'.php' );
	if ( file_exists( _SOBI_FE_PATH.DS.'languages'.DS.'default.php' ) ) {
		include_once( _SOBI_FE_PATH.DS.'languages'.DS.'default.php' );
	}
/*
 *  set the page title
 */
	$mainframe->setPageTitle( html_entity_decode ( $config->componentName ) );

/*
 * set styles
 */
	$mainframe->addCustomHeadTag("<link rel=\"stylesheet\" href=\"{$config->liveSite}/components/"._SOBI2_OPT."/includes/com_sobi2.css\" type=\"text/css\" />");

/*
 *  get plugins
 */
 	sobiPlugins();
 	if(! empty( $config->S2_plugins ) ) {
 		foreach ( $config->S2_plugins as $plugin ) {
 			if( method_exists($plugin,"onSobiStart") ) {
 				$plugin->onSobiStart( $sobi2Task );
 			}
 		}
 	}

/*
 *  get new frontend interface
 */
	if( !defined( "_SOBI_MAMBO" ) && !defined( "_JEXEC" ) ) {
		$menu = $mainframe->get( 'menu' );
		$params =& new mosParameters( $menu->params );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
		$params->def( 'pageclass_sfx', '' );
	}
	else {
		$params = new stdClass();
		if ( $config->sobi2Itemid ) {
			sobi2Config::loadBridge();
			$menu =& sobi2bridge::jMenu( $config->getDb() );
			$menu->load( $config->sobi2Itemid );
			$params =& sobi2bridge::jParams( $menu->params );
		}
		else {
			$menu = null;
			$params =& new mosEmpty();
		}
		$params->def( 'pageclass_sfx', '' );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	}
	$sobi2Frontend =  new frontend( $catid, $params, $sobi2Task );
	$config->setFrontend( $sobi2Frontend );
	/*
	 *  switching the sobi2Task
	 */
	 switch ( $sobi2Task ) {
	 	case 'search':
	 		searchSobi2($catid);
	 		break;
	 	case 'search1':
	 		searchSobi($catid);
	 		break;
	 	case 'axSearch':
	 		axSearchSobi2();
	 		break;
	 	case 'addNew':
	 		editEntry($catid);
	 		break;
	 	case 'editSobi':
	 		if(($my->id != 0 && $config->allowUserToEditEntry) || $config->checkPerm()) {
	 			editEntry($catid, $sobi2Id);
	 		}
	 		else {
	 			sobi2Config::redirect( $config->key( "redirects", "form_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
	 		}
	 		break;
	 	case 'saveSobi':
			sobi2Config::import("sobi2.entry");
			sobiEntry::save( $catid );
			break;
	 	case 'countVisit':
			sobi2Config::import( "includes|helper.class" );
			sobi2Helper::countURLClick();
			break;
	 	case 'updateSobi':
			sobi2Config::import("sobi2.entry");
			sobiEntry::update();
	 		break;
	 	case 'sobi2Details':
	 		showDetails( $sobi2Id, $catid );
	 		break;
	 	case "renew":
	 		sobi2Config::import("payment.class");
	 		payment::renew( $sobi2Id );
	 		break;
	 	case "saveRenew":
	 		sobi2Config::import("payment.class");
	 		payment::renew( $sobi2Id, true );
	 		break;
		case "pdf":
			showDetailsPdf( $sobi2Id, $catid );
			break;
	 	case 'deleteSobi':
			sobi2Config::import("sobi2.entry");
			sobiEntry::delete( $catid, $sobi2Id );
	 		break;
	 	case 'checkin':
	 		checkin($sobi2Id);
	 		break;
	 	case 'pluginMain':
	 		$plugin = sobi2Config::request($_GET, 'S_plugin');
	 		if(method_exists($config->S2_plugins[$plugin],"Main"))
	 			$config->S2_plugins[$plugin]->Main();
	 		break;
	 	case 'rss':
	 		break;
	 	case "popular":
	 	case "popularListing":
	 		showPopularListing();
	 		break;
	 	case "updated":
	 		showUpdatedListing();
	 		break;
	 	case "showNew":
	 		showNewListing();
	 		break;
	 	case "GetSearchField":
			getSearchFields($catid);
			break;
	 	case 'SigsiuTreeForm':
	 		sobiSigsiuTreeForm($catid);
	 		break;
	 	case 'efip':
			sobi2Config::import("field.class");
			sobiField::quickEditField();
	 		break;
	 	case 'SigsiuTreeMenu':
	 		sobiSigsiuTreeMenu($catid);
	 		break;
	 	case 'usersListing':
	 		showMyListing();
	 		break;
	 	default:
	 		if(!$sobi2Task || $sobi2Task == '') {
	 			$letter = sobi2Config::request($_REQUEST, 'letter', null);
	 			$tag = sobi2Config::request($_REQUEST, 'tag', null);
	 			if($letter) {
	 				showAlphaListing( $letter );
	 			}
	 			elseif ($tag) {
	 				showListingByTag( $tag );
	 			}
	 			else {
	 				$f = $config->key( "frontpage", "callback", "showListing" );
	 				if( function_exists( $f )) {
	 					call_user_func( $f, $catid );
	 				}
	 				else {
	 					showListing( $catid );
	 				}
	 			}
	 		}
	 		else {
		 		$pluginTask = false;
		 		if(!empty($config->S2_plugins)) {
		 			foreach ($config->S2_plugins as $plugin) {
		 				if(method_exists($plugin, "customTask")) {
		 					if($plugin->customTask($sobi2Task)) {
		 						$pluginTask = true;
		 					}
		 				}
		 			}
		 		}
		 		if( !$pluginTask ) {
		 			if( $config->key( 'custom_functions', $sobi2Task ) ) {
		 				$f = $config->key( 'custom_functions', $sobi2Task );
		 				if( function_exists( $f ) ) {
		 					if( strstr( file_get_contents( sobi2Config::translatePath( 'includes|inc|custom.functions' ) ), "function {$f}" ) ) {
		 						$pluginTask = true;
		 						call_user_func( $f, $catid );
		 					}
		 				}
		 			}
		 		}
		 		if(!$pluginTask) {
	 				$f = $config->key( "frontpage", "callback", "showListing" );
	 				if( function_exists( $f )) {
	 					call_user_func( $f, $catid );
	 				}
	 				else {
	 					showListing( $catid );
	 				}
		 		}
	 		}
	 }
	 error_reporting($restoreErrorReporting);
	 $config->restoreDefaultErrorHandler();

	 /**
     * details view
     *
     * @param integer $catid
     */
    function showListing( $catid = 0 )
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showListing( $catid );
    }
    /**
     * Enter description here...
     *
     */
    function showMyListing()
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showMyListing();
    }
	 /**
     * Alphabetical listing
     *
     * @param string $letter
     */
     function showAlphaListing( $letter )
     {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showAlphaListing( $letter );
     }
	 /**
     * listing by tag
     *
     * @param string $tag
     */
    function showListingByTag( $tag )
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showListingByTag( $tag );
    }
	 /**
     * popular listing
     */
    function showPopularListing( )
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showPopularListing();
    }
	 /**
     * popular listing
     */
    function showUpdatedListing()
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showUpdatedListing();
    }
	 /**
     * popular listing
     */
    function showNewListing()
    {
		sobi2Config::import("sobi2.listing");
		return sobiListings::showNewListing();
    }
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
		sobi2Config::import( "sobi2.entry" );
		return sobiEntry::editEntry( $catid, $itemid );
	 }
	/**
	 * search function
	 *
	 * @param integer $catid
	 */
	function searchSobi( $catid = 0 )
	{
		sobi2Config::import("search.class");
		return sobiSearch::searchSobi( $catid );
    }
    /**
     * getting data for details view
     *
     * @param int $sobi2Id
     * @param int $catid
     */
    function showDetails( $sobi2Id, $catid )
    {
		sobi2Config::import("sobi2.entry");
		return sobiEntry::showDetails( $sobi2Id, $catid );
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
		sobi2Config::import("sobi2.entry");
		return sobiEntry::showDetailsPdf( $sobi2Id, $catid );
    }
    /**
     * getting details data (custom fields) for search results
     *
     * @param sobi2 $mySobi
     * @global sobi2Config $config
     * @global database $database
     * @return array
     */
    function searchDetails( $mySobi,$html = true )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::searchDetails( $mySobi, $html);
    }
    /**
     * checkin sobi item after save or cancel editing
     *
     * @param integer $sobi2Id
     * @global sobi2Config $config
     */
    function checkin($sobi2Id)
    {
		sobi2Config::import("sobi2.entry");
		return sobiEntry::checkin( $sobi2Id );
    }
    /**
     * this function getting all published plugins
     */
    function sobiPlugins()
    {
    	$config =& sobi2Config::getInstance();
    	$db =& $config->getDb();
    	$query = "SELECT `init_file`, `name_id` FROM `#__sobi2_plugins` WHERE `enabled` = 1 ORDER BY `position` ASC";
    	$db->setQuery( $query );
    	$plugins = $db->loadObjectList();
    	if( count( $plugins ) ) {
    		foreach( $plugins as $plugin ) {
    			if ( $plugin->init_file && file_exists( _SOBI_FE_PATH.DS."plugins".DS.$plugin->name_id.DS.$plugin->init_file ) ) {
    				include_once( _SOBI_FE_PATH.DS."plugins".DS.$plugin->name_id.DS.$plugin->init_file );
    			}
    		}
    	}
    }
	/**
	 * Enter description here...
	 *
	 * @param int $catid
	 */
	function sobiSigsiuTreeForm($catid)
	{
    	$config =& sobi2Config::getInstance();
		sobi2Config::import("includes|SigsiuTree|SigsiuTree");
		$href = "javascript:onSelectedCat('{introtext}','{name}','{cid}')";
		$config->getEditForm();
		if(!$config->allowAddingToParentCats) {
			$spHref = "javascript:onSelectedCat('{introtext}','{name}','-1' )";
		}
		else {
			$spHref = null;
		}
		$tree = new SigsiuTree();
		$tree->addNodes($catid, $href, "div", false, $spHref);
	}
	/**
	 * Enter description here...
	 *
	 * @param int $catid
	 */
	function sobiSigsiuTreeMenu($catid)
	{
		sobi2Config::import("includes|SigsiuTree|SigsiuTree");
		$tree = new SigsiuTree();
		$tree->addNodes($catid);
	}
	/**
	 * @author Richard Jones
	 * Selected category to displayed fields depency
	 * @since RC 2.8.4
	 * @param int $catid
	 */
	function getSearchFields( $cid )
	{
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::getSearchFields( $cid );
	}
	/**
	 * ajax search function
	 *
	 * @param int $catid
	 */
	function searchSobi2($catid = 0)
	{
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::searchSobi( $catid );
	}
	/**
	 * ajax search function engine
	 *
	 */
	function axSearchSobi2()
	{
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::search();
	}
	function parseParams( &$request )
	{
		$req = str_replace( array( "/index.php?option=com_sobi2&" ), null, $_SERVER['REQUEST_URI'] );
		$req = explode( "&", $req );
		$config =& sobi2Config::getInstance();
		if( $config->key("general", "cachel2_ignore_ie6", true ) ) {
			if( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( eregi( "msie",$_SERVER['HTTP_USER_AGENT'] ) && !eregi( "opera",$_SERVER['HTTP_USER_AGENT'] ) ) ) {
				$v = explode(" ",stristr($_SERVER['HTTP_USER_AGENT'],"msie"));
	            $browser = isset( $v[0] ) ? $v[0] : null;
	            $version = isset( $v[1] ) ? $v[1] : 0;
				if(strtoupper($browser) == "MSIE") {
					$version = ereg_replace( "[^0-9]", "", $version );
					if($version <= 60) {
						return false;
					}
				}
			}
		}
		$IgnoreParamsCache = $config->key( "general", "cache_ignore_params", "fl");
		if( strlen( $IgnoreParamsCache ) ) {
			$IgnoreParamsCache = explode(",",$IgnoreParamsCache);
		}
		else {
			$IgnoreParamsCache = array();
		}
		if( is_array( $req )  && !empty( $req ) ) {
			foreach ( $req as $param ) {
				$param = explode( "=", $param );
				if( isset( $param[0] ) && isset( $param[1] )  &&  ( $param[0] && $param[1] ) )  {
					if( in_array( $param[0], $IgnoreParamsCache ) ) {
						$config->cacheL2Enabled = false;
						return false;
					}
					$request[$param[0]] = $param[1];
				}
			}
		}
		return true;
	}
?>