<?php
/**
* @version $Id: sobi2.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class HTML_SOBI {
	/**
	 * @var array
	 */
	var $plugins = array();
    /**
     * constructor
     *
     * @return HTML_SOBI
     */
    function HTML_SOBI()
    {
    	$config =& sobi2Config::getInstance();
    	$this->plugins =& $config->S2_plugins;
    	$config->loadOverlib();
    }
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
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::execMambots( $text );
	}
	/**
	 * executing Joomla 1.5 plugins for a field
	 * @author Radek Suski
	 * @param string $text
	 * @return string
	 */
	function execJPlugins( $text )
	{
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::execJPlugins( $text );
	}
    /**
     * displaying details view
     *
     * @param int $sobi2Id
     * @param sobi2 $mySobi
     * @param array $itemData
     * @param string $waySearchLink
     * @param int $cid
     */
    function showSobi( $sobi2Id, $mySobi, $itemData, $waySearchLink, $cid, $fieldsObjects )
    {
		sobi2Config::import("sobi2.entry");
		sobiEntry::showSobi( $sobi2Id, $mySobi, $itemData, $waySearchLink, $cid, $fieldsObjects );
    }
    /**
     * @param sobi2 $mySobi
     * @param string $name
     */
    function getPlugin($mySobi, $name)
    {
    	if(method_exists($this->plugins[$name],"showDetails")) {
    		echo $this->plugins[$name]->showDetails($mySobi->id);
    	}
    }
    /**
     * Returning array or string of selected categories
     *
     * @param  sobi2 $mySobi
     * @return array
     */
    function getMyCategories( $mySobi, $string = false, $fullPath = false )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::getMyCategories( $mySobi, $string, $fullPath );
    }
    /**
     * displaying edit buttons
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function editButtons($config,$mySobi)
    {
		sobi2Config::import("sobi2.entry");
		return sobiEntry::editButtons( $config,$mySobi );
    }
    /**
     * displaying renewal info
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function renewal($config,$mySobi)
    {
		sobi2Config::import("sobi2.entry");
		return sobiEntry::renewal( $config,$mySobi );
    }
    /**
     * displaying hits
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function showHits($config,$mySobi)
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::showHits( $config,$mySobi );
    }

	function showThumbshotsOrg( $url, $alt = '', $style = 'border-style:none;', $params = null )
	{
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::getThumbshotsOrg( $url, $alt, $style, $params);
	}
    /**
     * displaying added date
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function addedDate($config,$mySobi)
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::addedDate( $config,$mySobi );
    }
    /**
     * displaying selected tags for an entry
     *
     * @param array $metaKeys
     * @param int $count
     * @return string
     */
    function showTags( $metaKeys, $count = 5 )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::showTags( $metaKeys, $count );
    }
    /**
     * @param sobi2 $mySobi
     * @param int $days
     */
    function newLabel( $mySobi, $days = 3 )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::newLabel( $mySobi, $days );
    }
    /**
     * @param sobi2 $mySobi
     * @param int $days
     */
    function updatedLabel( $mySobi, $days = 3 )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::updatedLabel( $mySobi, $days );
    }
    /**
     * @param sobi2 $mySobi
     * @param int $hits
     */
    function hotLabel( $mySobi, $hits = 500 )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::hotLabel( $mySobi, $hits );
    }
    /**
     * @param sobi2 $mySobi
     * @param string $name
     */
    function userHref( $mySobi, $name = "real" )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::userHref( $mySobi, $name );
    }
    /**
     * @param sobi2 $mySobi
     * @param string $name
     */
    function userCBHref( $mySobi, $name = "real" )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::userCBHref( $mySobi, $name );
    }
    /**
     * @param string $txt
     */
    function replace( $txt, $key = null )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::replace( $txt, $key );
    }
    /**
     * Custom mixed cats and items listing, based on two gived arrays with all ids
     * @return string
     */
    function buildCustomListing( $sids, $cids, $navMenuUrl, $customHeader = null, $stringForItems = null, $stringForCats = null, $addToPathway = null, $addToSiteTitle = null,  $defCid = 0, $pluginTask = null, $itemsOrdering = null, $catsOrdering = null, $pluginsArgs = null, $forceUnpublishedItems = false, $forceUnpublishedCats = false, $skipHeader = false, $skipFooter = false, $templateFunction = null, $itemsInLine = 0, $preventPlugins = false )
    {
		sobi2Config::import("includes|custom.listing");
		return sobiCListings::buildCustomListing( $sids, $cids, $navMenuUrl, $customHeader, $stringForItems, $stringForCats, $addToPathway, $addToSiteTitle, $defCid, $pluginTask, $itemsOrdering, $catsOrdering, $pluginsArgs, $forceUnpublishedItems, $forceUnpublishedCats, $skipHeader, $skipFooter, $templateFunction, $itemsInLine, $preventPlugins );
	}
    /**
     * displaying added date
     *
     * @param sobi2Config $config
     * @param sobi2 $mySobi
     */
    function addedDateOnly($config,$mySobi)
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::addedDateOnly( $config,$mySobi );
    }
    /**
     * displaying custom fields data
     *
     * @param array $itemData
     * @param string $field
     */
    function customFieldsData( $itemData, $field = null )
    {
		sobi2Config::import("sobi2.entry");
		sobiEntry::customFieldsData( $itemData, $field );
    }
    /**
     * displaying way search url
     *
     * @param string $waySearchLink
     * @param sobi2Config $config
     */
    function waySearchUrl( $waySearchLink )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::waySearchUrl( $waySearchLink );
    }
    /**
     * @param int $sobi2Id
     * @return string
     */
    function createWaySearchUrl( $sobi2Id )
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::createWaySearchUrl( $sobi2Id );
    }
    /**
     *
     * @param sobi2 $mySobi
     * @param sobi2config $config
     * @return string
     */
    function showGoogleMaps($mySobi, $config)
    {
		sobi2Config::import("includes|entry.functions");
		return sobiSpecFunc::showGoogleMaps( $mySobi, $config );
    }
    /**
     * adding script for the ajax search function
     *
     * @param int $extended
     * @return string
     */
    function searchAjaxScript( $autoSearch, $fieldsNames )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::searchAjaxScript( $autoSearch, $fieldsNames );
    }
    /**
     * search form for the ajax search function
     *
     * @param array $dropListsArray
     * @param string $searchString
     */
    function showSearchForm2( $dropListsArray, $searchString, $phrase, $cid, $page, $selectedCats )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::showSearchForm(  $dropListsArray, $searchString, $phrase, $cid, $page, $selectedCats );
    }
    /**
     * creating the first combobox for the search function category chooser
     *
     * @param array $cats
     * @return string
     */
    function axSearchCatChooser( $selectedCats, $cid )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::axSearchCatChooser( $selectedCats, $cid );
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
    function showSearchForm($dropListsArray,$config,$items,$pageNav,$fieldData,$searchString,$catid,$total,$phrase,$res,$pluginsOutput)
    {
		sobi2Config::import("search.class");
		return sobiSearch::showSearchForm( $dropListsArray,$config,$items,$pageNav,$fieldData,$searchString,$catid,$total,$phrase,$res,$pluginsOutput );
    }
    /**
     *
     * @param array $items
     * @param int $width
     * @param string $mosConfig_live_site
     * @param sobi2Config $config
     * @param int $catid
     * @param int $tdTrCounter
     * @param mosUser $my
     */
    function searchResultsWithTemplate( $items,$width,$liveSite,$config,$catid,$tdTrCounter,$my )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::searchResultsWithTemplate( $items,$width,$liveSite,$config,$catid,$tdTrCounter,$my );
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
    function axSearchResults( $searchString, $items, $total, $pluginsOutput, $pages, $currPage, $totalStr )
    {
		sobi2Config::import("axsearch.class");
		return sobiAxSearch::axSearchResults( $searchString, $items, $total, $pluginsOutput, $pages, $currPage, $totalStr );
    }
    /**
     * Enter description here...
     *
     * @param sobiField $field
     * @param sobi2 $mySobi
     */
    function toQuickEdit( $field, $mySobi )
    {
    	sobi2Config::import("includes|entry.functions");
    	return sobiSpecFunc::toQuickEdit( $field, $mySobi );
    }
    /**
     * Enter description here...
     *
     * @param sobiField $field
     * @param sobi2 $mySobi
     */
    function countClick( $field, $mySobi, $showCounter = true )
    {
    	sobi2Config::import("includes|entry.functions");
    	return sobiSpecFunc::countClick( $field, $mySobi, $showCounter );
    }
}
?>