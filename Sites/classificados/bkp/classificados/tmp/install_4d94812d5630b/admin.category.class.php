<?php
/**
* @version $Id: admin.category.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class adminSobiCategory {

	/**
	 * @var int
	 */
	var $catid 				= null;
	/**
	 * @var string
	 */
	var $name 				= null;
	/**
	 * @var string
	 */
	var $image 				= null;
	/**
	 * @var string
	 */
	var $image_position 	= null;
	/**
	 * @var string
	 */
	var $description		= null;
	/**
	 * @var string
	 */
	var $introtext			= null;
	/**
	 * @var bool
	 */
	var $published			= null;
	/**
	 * @var bool
	 */
	var $checked_out		= null;
	/**
	 * @var string
	 */
	var $checked_out_time	= null;
	/**
	 * @var int
	 */
	var $ordering			= null;
	/**
	 * @var int
	 */
	var $access				= null;
	/**
	 * @var int
	 */
	var $count				= null;
	/**
	 * @var array
	 */
	var $params				= null;
	/**
	 * @var string
	 */
	var $icon				= null;
	/**
	 * @var array
	 */
	var $parentCat			= null;
	/**
	 * @var array
	 */
	var $childCats			= array();
	/**
	 * @var string
	 */
	var $dTree				= null;
	/**
	 * @var string
	 */
	var $tpl				= null;
	/**
	 * @var int
	 */
	var $itemsInLine		= 0;
	/**
	 * @var int
	 */
	var $lineOnSite			= 0;
	/**
	 * @var int
	 */
	var $catsListInLine		= 0;
    /**
     * constructor
     *
     * @param int $cid
     * @return adminSobiCategory
     */
    function adminSobiCategory( $cid = 0 )
    {
		if( $cid ) {
			$this->catid = $cid;
			$this->getCategory($this->catid);
		}
		$config =& sobi2Config::getInstance();
    	if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
				if(method_exists($plugin, "onCreateCategoryObj")) {
					$plugin->onCreateCategoryObj( $this );
    			}
    		}
    	}
    }
    /**
     */
    function getCategory()
    {
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
    	$category = null;
    	$query = "SELECT * FROM `#__sobi2_categories` WHERE `catid` = {$this->catid}";
    	$database->setQuery( $query );
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$category = $database->loadObject();
		}
    	else {
    		$database->loadObject( $category );
    	}
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	if( $category ) {
    		$this->name = $config->getSobiStr($category->name);
    		$this->image = $category->image;
    		$this->image_position = $category->image_position;
    		$this->description = $config->getSobiStr($category->description);
    		$this->introtext = $config->getSobiStr($category->introtext);
    		$this->published = $category->published;
    		$this->checked_out = $category->checked_out;
    		$this->checked_out_time = $category->checked_out_time;
    		$this->ordering = $category->ordering;
    		$this->access = $category->access;
    		$this->count = $category->count;
    		$this->params = $config->iniToArr( $category->params );
    		$this->icon = $category->icon;
    		$query = "SELECT `parentid` FROM `#__sobi2_cats_relations` WHERE `catid` = {$this->catid}";
    		$database->setQuery( $query );
    		$this->parentCat = $database->loadResult();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$this->tpl 				= isset( $this->params[ 'template' ] ) 			?  $this->params[ 'template' ] : null;
			$this->itemsInLine 		= isset( $this->params[ 'itemsInLine' ] ) 		?  $this->params[ 'itemsInLine' ] : 0;
			$this->lineOnSite		= isset( $this->params[ 'lineOnSite' ] ) 		?  $this->params[ 'lineOnSite' ] : 0;
			$this->catsListInLine 	= isset( $this->params[ 'catsListInLine' ] ) 	?  $this->params[ 'catsListInLine' ] : 0;
    	}
    }
    /**
     * Enter description here...
     *
     */
    function getDataFromRequest()
    {
		$config =& adminConfig::getInstance();
		$this->name 			= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'name' )));
		$this->introtext 		= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'introtext' )));
		$this->description 		= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'categoryDescription', null, 0x0002 )));
		$this->image 			= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'image' )));
		$this->image_position 	= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'image_position' )));
		$this->icon 			= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'icon' )));
		$this->count 			= intval(sobi2Config::request( $_POST, 'hits_counter' ));
    	$this->published 		= intval(sobi2Config::request( $_POST, 'published' ));
    	$this->parentCat 		= intval(sobi2Config::request( $_POST, 'selectedCatID',1));
    	$this->params[ 'template' ] 		= sobi2Config::request( $_POST, 'tplChoose', '' );
   		$this->params[ 'itemsInLine' ] 		= sobi2Config::request( $_POST, 'itemsInLine', 0 );
   		$this->params[ 'lineOnSite' ] 		= sobi2Config::request( $_POST, 'lineOnSite', 0 );
   		$this->params[ 'catsListInLine' ] 	= sobi2Config::request( $_POST, 'catsListInLine', 0 );
    }
    /**
     * @return string
     */
    function updateData()
    {
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
    	$msg = _SOBI2_CHANGES_SAVED;
		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onUpdateCategory")) {
					$plugin->onUpdateCategory( $this );
				}
			}
		}
		$this->params = $config->arrToIni( $this->params );
		$this->name = $database->getEscaped( $this->name );
//		$this->description = $database->getEscaped( $this->description );
//		$this->introtext = $database->getEscaped( $this->introtext );
//		$this->params = $database->getEscaped( $this->params );
    	$statement = "UPDATE `#__sobi2_categories` SET " .
    			"`name` = '{$this->name}', " .
    			"`image` = '{$this->image}', " .
    			"`image_position` = '{$this->image_position}', " .
    			"`description` = '{$this->description}', " .
    			"`introtext` = '{$this->introtext}', " .
    			"`checked_out_time` = '0' , " .
    			"`checked_out` = '0' , " .
    			"`count` = '{$this->count}', " .
    			"`icon` = '{$this->icon}', " .
    			"`published` = '{$this->published}', `params` = '{$this->params}' ".
    			" WHERE `catid` = '{$this->catid}' LIMIT 1 ;" ;
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if($this->parentCat == 0) {
			$this->parentCat = 1;
		}

		$config->getChildCats($this->catid,$config->catChilds);
		/*
		 * check if not trying to move to it self or one of subcategory from it self
		 */
		$allowMove = true;
		foreach( $config->catChilds as $cid ) {
			if( $cid == $this->parentCat ) {
				$allowMove = false;
				$msg = _SOBI2_NOT_ALL_CHANGES_SAVED;
			}
		}
		if( $allowMove == true ) {
			$statement = "UPDATE `#__sobi2_cats_relations` SET `parentid` = {$this->parentCat} WHERE `catid` = {$this->catid}";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		return $msg;
    }
    /**
     * Enter description here...
     *
     */
    function saveData()
    {
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$query = "SELECT MAX(ordering) FROM `#__sobi2_categories`";
		$database->setQuery( $query );
		$order = $database->loadResult();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$order++;
		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onSaveCategory")) {
					$plugin->onSaveCategory( $this );
				}
			}
		}
		$this->params = $config->arrToIni( $this->params );
		$this->name = $database->getEscaped( $this->name );
		$this->description = $database->getEscaped( $this->description );
		$this->introtext = $database->getEscaped( $this->introtext );
		$this->params = $database->getEscaped( $this->params );
		$statement = "INSERT INTO `#__sobi2_categories` " .
				"( `name` , `image` , " .
				"`image_position` , `description` , " .
				"`introtext` , `published` , " .
				"`checked_out` , `checked_out_time` , " .
				"`ordering` , `access` , " .
				"`count` , `params` , " .
				"`icon` ) " .
				" VALUES ( '{$this->name}', '{$this->image}', " .
				"'{$this->image_position}', '{$this->description}', '{$this->introtext}', " .
				"'{$this->published}', '0', '0', " .
				"'{$order}', NULL , '0', " .
				"'{$this->params}' , '{$this->icon}');";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$this->catid = $database->insertid();
		if($this->parentCat < 1) {
			$this->parentCat = 1;
		}
		$statement = "INSERT INTO `#__sobi2_cats_relations`(`parentid`, `catid`) VALUES( {$this->parentCat}, {$this->catid})";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $this->catid;
    }

    /**
     * Enter description here...
     *
     * @param string $returnTask
     * @param int $catId
     */
    function showForm($returnTask,$catId = 0)
    {
    	sobi2Config::import("admin.category.class.html", "adm");
    	adminSobiCategoryHtml::showForm( $this, $returnTask, $catId );
    }
    /**
     * Enter description here...
     *
     * @param int $uid
     */
    function checkOutCategory( $uid )
    {
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
    	$now = date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  );
    	$statement = "UPDATE `#__sobi2_categories` SET `checked_out` = '{$uid}', `checked_out_time` = '{$now}' WHERE `catid` = {$this->catid}";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("checkOutCategory: DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     *
     */
    function checkInCategory() {
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
    	$statement = "UPDATE `#__sobi2_categories` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `catid` = {$this->catid}";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("checkInCategory: DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
}
?>