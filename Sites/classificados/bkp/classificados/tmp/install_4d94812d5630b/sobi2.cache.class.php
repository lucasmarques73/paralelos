<?php
/**
* @version $Id: sobi2.cache.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class sobiCache {
    /**
     * cache location
     *
     * @var string
     */
    var $cacheDir = null;
    /**
     * cahce lifetime in seconds
     *
     * @var int
     */
    var $lifetime = 0;
    /**
     * @var sobiConfig
     */

    var $memLimit = 0;
    /**
     * enable/disable
     *
     * @var boolean
     */
    var $enabled = 1;
    /**
     * Config
     *
     * @var sobi2Config
     */
    var $config = null;


    /**
     * @param sobi2Config $config
     */
    function sobiCache( &$config )
    {
    	$this->enabled = false;
    	$this->config = &$config;
    }
    /**
     * @param string $varId
     * @param mixed $value
     * @param string $cacheSection
     */
    function add( $varId, $value, $cacheSection = null )
    {
    }
    /**
     * @param string $varId
     * @param string $cacheSection
     * @return mixed
     */
    function get( $varId, $cacheSection = null )
    {
    }

    /**
     * @param string $varId
     * @param string $cacheSection
     */
    function remove( $varId, $cacheSection = null )
    {
    }
    /**
     * Clear cache
     * @param string $cacheSection
     * @return unknown
     */
    function clear( $cacheSection = null )
    {
    }
    /**
     * removing all cache
     */
    function clearAll( $recount = false )
    {
   		$this->initCache( $recount );
   		$this->clearContentCache();
    }
    /**
     * disabling cache if something goes wrong
     * @global database $database
     */
    function disableCache()
    {
		return false;
    }
    function initCache( $recount )
    {
		if( !$recount ) {
			return false;
		}
    	$database =& $this->config->getDb();
    	$this->enabled = false;
    	$statement = "UPDATE `#__sobi2_config` SET `configValue` = '1' WHERE `configKey` = 'recount' AND `sobi2Section` = 'cache' LIMIT 1 ;";
    	$database->setQuery( $statement );
    	$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    function addContent( $content, $params, $section )
    {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$user =& $config->getUser();
		if( strlen( $content ) < 2 ) {
			$content = "<!-- empty cache content -->";
		}
		$cid = isset( $params['catid'] ) && $params['catid'] ? (int) $params['catid'] : -9;
		$sid = isset( $params['sobi2Id'] ) && $params['sobi2Id'] ? (int) $params['sobi2Id'] : -9;
		$task = isset( $params['sobi2Task'] ) && $params['sobi2Task'] && strlen($params['sobi2Task']) < 25 ? $config->clearSQLinjection( $params['sobi2Task'] ) : -9;
		$limitstart = isset( $params['limitstart'] ) && $params['limitstart'] ? (int) $params['limitstart'] : -9;
		$limit = isset( $params['limit'] ) && $params['limit'] ? (int) $params['limit'] : -9;
		$Itemid = isset( $params['Itemid'] ) && $params['Itemid'] ? (int) $params['Itemid'] : -9;
		if( $config->key( "general", "cachel2_ignore_itemid" ) ) {
			$Itemid = -9;
		}
		$uid = $user->id ? $user->id : -9;
		$time = time();
		if( isset( $params['catid'] ) ) {
			unset( $params['catid'] );
		}
		if( isset( $params['sobi2Id'] ) ) {
			unset( $params['sobi2Id'] );
		}
		if( isset( $params['sobi2Task'] ) ) {
			unset( $params['sobi2Task'] );
		}
		if( isset( $params['limitstart'] ) ) {
			unset( $params['limitstart'] );
		}
		if( isset( $params['limit'] ) ) {
			unset( $params['limit'] );
		}
		if( isset( $params['Itemid'] ) ) {
			unset( $params['Itemid'] );
		}

		/* in this case catlist/catdesc is always the same so we can get the same cache value */
		if( ( $section == "catlist" || $section == "componentdescr" || $section == "catdescription" ) && $task == -9 ) {
			$limitstart = -9;
			$limit = -9;
			$Itemid = -9;
		}

		$paramsArr = array();
		$paramsStr = null;
		if( !empty( $params ) ) {
			foreach ( $params as $k => $v ) {
				$paramsStr = $config->clearSQLinjection( $k );
				$paramsStr .= "=";
				$paramsStr .= $config->clearSQLinjection( $v );
				$paramsArr[] = $paramsStr;
			}
			$paramsStr = implode("|",$paramsArr);
		}
		$content = $database->getEscaped( $content );
		$content = base64_encode( $content );
		$strlen = strlen( $content );
		if( $strlen > $config->cacheL2strLen) {
			trigger_error( "Cache value to big to save in the database. Allowed size is: {$config->cacheL2strLen}. Cache value is {$strlen} big. Skipping for S:{$section}/C:{$cid}/T:{$task}/U:{$uid}", E_USER_WARNING );
			return false;
		}
		$query = "INSERT INTO `{$config->DBprefix}sobi2_cache` ( `validtime` , `task` , `sid` , `cid` , `uid` , `limitstart` , `limitall` , `Itemid` , `section`, `params` , `html` , `opt`, `slang`, `schecksum` )
				  VALUES ({$time}, '{$task}', {$sid}, {$cid}, {$uid}, {$limitstart}, {$limit}, {$Itemid}, '{$section}', '{$paramsStr}', '{$content}', '', '{$config->sobi2Language}', '{$strlen}' );";
		if( defined( "_SOBI_MAMBO" ) ) {
			$database->_sql = $query;
		}
		else {
			$database->setQuery( $query );
		}
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    function getContent( $params, $section )
    {
    	$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$user =& $config->getUser();
		$cid = isset( $params['catid'] ) && $params['catid'] ? (int) $params['catid'] : -9;
		$sid = isset( $params['sobi2Id'] ) && $params['sobi2Id'] ? (int) $params['sobi2Id'] : -9;
		$task = isset( $params['sobi2Task'] ) && $params['sobi2Task'] && strlen($params['sobi2Task']) < 25 ? $config->clearSQLinjection( $params['sobi2Task'] ) : -9;
		$limitstart = isset( $params['limitstart'] ) && $params['limitstart'] ? (int) $params['limitstart'] : -9;
		$limit = isset( $params['limit'] ) && $params['limit'] ? (int) $params['limit'] : -9;
		$Itemid = isset( $params['Itemid'] ) && $params['Itemid'] ? (int) $params['Itemid'] : -9;
		if( $config->key( "general", "cachel2_ignore_itemid" ) ) {
			$Itemid = -9;
		}
		$uid = $user->id ? $user->id : -9;
		$time = time();
		$time = $time - $config->cacheL2Lifetime;

		if( isset( $params['catid'] ) ) {
			unset( $params['catid'] );
		}
		if( isset( $params['sobi2Id'] ) ) {
			unset( $params['sobi2Id'] );
		}
		if( isset( $params['sobi2Task'] ) ) {
			unset( $params['sobi2Task'] );
		}
		if( isset( $params['limitstart'] ) ) {
			unset( $params['limitstart'] );
		}
		if( isset( $params['limit'] ) ) {
			unset( $params['limit'] );
		}
		if( isset( $params['Itemid'] ) ) {
			unset( $params['Itemid'] );
		}

		/* in this case catlist/catdesc is always the same so we can get the same cache value */
		if( ( $section == "catlist" || $section == "componentdescr" || $section == "catdescription" ) && $task == -9 ) {
			$limitstart = -9;
			$limit = -9;
			$Itemid = -9;
		}

		$paramsArr = array();
		$paramsStr = null;
		if( !empty( $params ) ) {
			foreach ( $params as $k => $v ) {
				$paramsStr = $config->clearSQLinjection( $k );
				$paramsStr .= "=";
				$paramsStr .= $config->clearSQLinjection( $v );
				$paramsArr[] = $paramsStr;
			}
			$paramsStr = implode("|",$paramsArr);
		}
		$query = "SELECT html, schecksum FROM `#__sobi2_cache`
					WHERE ( validtime > {$time} AND task ='{$task}' AND sid = {$sid} AND cid = {$cid} AND uid = {$uid} AND limitstart = {$limitstart}
					AND limitall = {$limit} AND Itemid = {$Itemid} AND params = '{$paramsStr}' AND section = '{$section}' AND slang = '{$config->sobi2Language}') ORDER BY validtime LIMIT 1";
		$database->setQuery( $query );
		$result = null;
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$result = $database->loadObject();
		}
    	else {
    		$database->loadObject( $result );
    	}
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( $result ) {
			if( strlen( $result->html ) != $result->schecksum ) {
				trigger_error( "Cached content size does not match the checksum. Removing cached content S:{$sid},T:{$task},C:{$cid},U:{$uid},S:{$section}", E_USER_WARNING );
				$query = "DELETE FROM `#__sobi2_cache`
						WHERE ( task ='{$task}' AND sid = {$sid} AND cid = {$cid} AND uid = {$uid} AND limitstart = {$limitstart}
						AND limitall = {$limit} AND Itemid = {$Itemid} AND params = '{$paramsStr}' AND section = '{$section}' AND slang = '{$config->sobi2Language}') ";
				$database->setQuery( $query );
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				return false;
			}
			else {
				$result = $result->html;
			}
			$result = base64_decode( $result );
			$result = stripcslashes( $result );
		}
		return $result ? $result : false;
    }
    function clearContentCache()
    {
    	$config =& sobi2Config::getInstance();
    	if( $config->cacheL2Enabled ) {
			$database =& $config->getDb();
			$query = "TRUNCATE TABLE `#__sobi2_cache`";
			$database->setQuery( $query );
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
    	}
    }
    function addObj( $obj, $sid = 0, $cl = 0, $cid = 0, $oid = 0,  $force = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->cacheL3Enabled && !$force ) {
    		return false;
    	}
		$database =& $config->getDb();
		$time = time();
		$size = count( $obj, COUNT_RECURSIVE );
		$obj = serialize( $obj );
		$obj = base64_encode( $obj );
		$strlen = strlen( $obj );
		if( $strlen > $config->cacheL3strLen) {
			trigger_error( "Cache value to big to save in the database. Allowed size is: {$config->cacheL2strLen}. Cache value is {$strlen} big. Skipping for C:{$cid}/S:{$sid}/CL:{$cl}", E_USER_WARNING );
			return false;
		}
		$query = "INSERT IGNORE INTO `{$config->DBprefix}sobi2_cobj` ( `atime` , `sid` , `cid` , `svars` , `oid` , `cl` , `params` , `slang` , `schecksum` )
                  VALUES ( {$time}, {$sid}, {$cid}, '{$obj}', {$oid}, {$cl}, '', '{$config->sobi2Language}', '{$size}' );";
		if( defined( "_SOBI_MAMBO" ) ) {
			$database->_sql = $query;
		}
		else {
			$database->setQuery( $query );
		}
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     * @param int $sid
     * @param int $cl
     * @param int $cid
     * @param int $oid
     * @return array
     */
    function getObj( $sid = 0, $cl = 0, $cid = 0, $oid = 0, $ignoreLang = false, $force = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->cacheL3Enabled && !$force ) {
    		return false;
    	}
		$database =& $config->getDb();
		$lang  = $ignoreLang ? null : "AND slang = '{$config->sobi2Language}'";
		$query = "SELECT svars, schecksum FROM `#__sobi2_cobj`
                  WHERE  ( sid = {$sid} AND cid = {$cid} AND cl = {$cl} {$lang} AND oid = {$oid} );";
		$database->setQuery( $query );
		$var = null;
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$var = $database->loadObject();
		}
    	else {
    		$database->loadObject( $var );
    	}
		if( $database->getErrorNum() ) {
			trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
		}
		if( $var && is_object( $var ) ) {
			$obj = base64_decode( $var->svars );
			$obj = unserialize( $obj );
			$size = count( $obj, COUNT_RECURSIVE );
			if( $var->schecksum != $size ) {
				trigger_error( "Cached Object size does not match the checksum. Removing cached object S:{$sid}, CL:{$cl}, C:{$cid}, O:{$oid} ", E_USER_WARNING );
				$query = "DELETE FROM `#__sobi2_cobj`
		                  WHERE  ( sid = {$sid} AND cid = {$cid} AND cl = {$cl} {$lang} AND oid = {$oid} );";
				$database->setQuery( $query );
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				return false;
			}
			else {
				return $obj;
			}
		}
		else {
			return false;
		}
    }
    function removeObj( $sid = 0, $cid = 0, $oid = 0, $ignoreLang = false, $force = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->cacheL3Enabled && !$force ) {
    		return false;
    	}
		$lang  = $ignoreLang ? null : "AND slang = '{$config->sobi2Language}'";
		$database =& $config->getDb();
		$query = "DELETE FROM `#__sobi2_cobj`
                  WHERE  ( sid = {$sid} AND cid = {$cid} {$lang} AND oid = {$oid} );";
		$database->setQuery( $query );
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    function emptyObjects()
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->cacheL3Enabled ) {
    		return false;
    	}
		$database =& $config->getDb();
		$query = "TRUNCATE TABLE `#__sobi2_cobj`";
		$database->setQuery( $query );
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     * Enter description here...
     *
     * @param array $cats
     * @return bool
     */
    function recountCats( $cats )
    {
    	$config =& sobi2Config::getInstance();
    	if( empty( $cats ) || !$config->showCatItemsCount ) {
    		return false;
    	}
		$db =& $config->getDb();
		$cids = array();
		foreach ( $cats as $cid ) {
			$cids[] = $cid;
			$config->getChildCats( $cid, $cids );
			$config->getParentCats( $cid, $cids );
		}
		sort( $cids );
		$cids = array_unique( $cids );
		foreach ( $cids as $cid ) {
			$childs = array();
			$counter = array();
			$config->getChildCats( $cid, $childs );
    		if( is_array( $childs ) && !empty( $childs ) ) {
				$childs = implode( " , ", $childs );
	    		$query = "SELECT COUNT(*) FROM #__sobi2_categories WHERE catid IN ({$childs}) AND published = 1";
	    		$db->setQuery( $query );
	    		$counter['cats'] = $db->loadResult() - 1;
				if ( $db->getErrorNum() ) {
					trigger_error("DB reports: ".$db->stderr(), E_USER_WARNING);
				}
    		}
    		else {
    			$counter['cats'] = 0;
    			$childs = $cid;
    		}
			$now = $config->getTimeAndDate();
    		$distinct = $config->key( "frontpage", "catlist_count_entries_once", true ) ? " DISTINCT " : null;
			$query = "SELECT COUNT({$distinct}rel.itemid) FROM `#__sobi2_cat_items_relations` AS rel " .
    			 "LEFT JOIN `#__sobi2_item` AS sitem ON rel.itemid = sitem.itemid " .
    			 "WHERE(sitem.published = '1' AND (sitem.publish_down > '{$now}' OR sitem.publish_down = '{$config->nullDate}') AND rel.catid IN ({$childs}))";
			$db->setQuery( $query );
			$items = $db->loadResult();
			if ( $db->getErrorNum() ) {
				trigger_error("DB reports: ".$db->stderr(), E_USER_WARNING);
			}
			$counter['items'] = $items;
			$this->removeObj( 0, $cid, 0, true, true );
			$this->addObj( $counter, 0, 0, $cid, 0, true );
		}
    }
}
?>