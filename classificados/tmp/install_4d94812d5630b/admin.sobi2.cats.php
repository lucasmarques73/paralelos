<?php
/**
* @version $Id: admin.sobi2.cats.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class catListingsFunctions {

	function saveOrder($cids,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();

		$newOrder = sobi2Config::request( $_POST, 'order', array(0));
		$order = array_combine($cids,$newOrder);
		asort($order);
		$forCount = 0;
		foreach($order as $cid => $pos) {
			$forCount++;
			$statement = "UPDATE `#__sobi2_categories` SET `ordering` = '{$forCount}' WHERE `catid` = {$cid} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		$msg = _SOBI2_NEW_ORDERING_SAVED;
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}

	function unpublish($cids,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$forCount = 0;

		foreach($cids as $cid) {
			$statement = "UPDATE `#__sobi2_categories` SET `published` = 0 WHERE `catid` = {$cid} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$forCount++;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}&catid={$catId}" );
	}
	function publishCat($cids,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$forCount = 0;

		foreach($cids as $cid) {
			$statement = "UPDATE `#__sobi2_categories` SET `published` = 1 WHERE `catid` = {$cid} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$forCount++;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}

	function orderUp($cid,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();

		if($catId == 0)
			$catId = 1;

		$query = "SELECT `ordering` FROM `#__sobi2_categories` WHERE `catid` = {$cid} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * get id from category over me
		 */
		$overPosition = $position - 1;
		$query = "SELECT categories.catid " .
				 "FROM `#__sobi2_cats_relations` AS relations " .
				 "LEFT JOIN `#__sobi2_categories` AS categories  ON categories.catid = relations.catid " .
				 "WHERE (`ordering` = {$overPosition} AND `parentid` = {$catId})";
		$database->setQuery( $query );
		$overId = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * and set it on my position
		 */
		$statement = "UPDATE `#__sobi2_categories` SET `ordering` = '{$position}' WHERE `catid` = {$overId} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		/*
		 * set my new position
		 */
		$position -- ;
		$statement = "UPDATE `#__sobi2_categories` SET `ordering` = '{$position}' WHERE `catid` = {$cid} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}
	function orderDown($cid,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();

		if($catId == 0)
			$catId = 1;

		$query = "SELECT `ordering` FROM `#__sobi2_categories` WHERE `catid` = {$cid} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * get id from category under
		 */
		$underPosition = $position + 1;
		$query = "SELECT categories.catid " .
				 "FROM `#__sobi2_cats_relations` AS relations " .
				 "LEFT JOIN `#__sobi2_categories` AS categories  ON categories.catid = relations.catid " .
				 "WHERE (`ordering` = {$underPosition} AND `parentid` = {$catId})";
		$database->setQuery( $query );
		$underId = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * and set it on my position
		 */
		$statement = "UPDATE `#__sobi2_categories` SET `ordering` = '{$position}' WHERE `catid` = {$underId} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * set my new position
		 */
		$position ++ ;
		$statement = "UPDATE `#__sobi2_categories` SET `ordering` = '{$position}' WHERE `catid` = {$cid} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}

	function removeCat($catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$msg = _SOBI2_CANNOT_REMOVE_CAT;
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function delete($cids,$catId)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$catsToDelete = array();
		foreach($cids as $cid) {
			$catsToDelete[] = $cid;
			getChildCats($cid,$catsToDelete);
		}
		if(!(empty($catsToDelete))) {
			$catsToDelete = array_unique($catsToDelete);
			$catsToDelete = implode(" , ",$catsToDelete);
			$statement = "DELETE FROM `#__sobi2_cats_relations` WHERE `catid` IN ({$catsToDelete})";
			$database->setQuery($statement);
			$database->query();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$statement = "DELETE FROM `#__sobi2_categories` WHERE `catid` IN ({$catsToDelete})";
			$database->setQuery($statement);
			$database->query();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		$msg = _SOBI2_CAT_DELETED;
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );

	}

	function move($cid,$catId,$targetCat)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$msg = _SOBI2_CATS_MOVED;

		if($catId == 0)
			$catId = 1;

		foreach($cid as $category) {
			$allowMove = true;
			$config->getChildCats($category,$config->catChilds);
			/*
			 * check if not trying to move to it self or one of subcategory from it self
			 */
			foreach($config->catChilds as $cid) {
				if($cid == $targetCat) {
					$allowMove = false;
					$msg = _SOBI2_NOT_ALL_CATS_MOVED;
				}
			}
			if($allowMove == true) {
				$statement = $statement = "UPDATE `#__sobi2_cats_relations` SET `parentid` = {$targetCat} WHERE `parentid`={$catId} AND `catid` = {$category}";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function copy($cid,$catId,$targetCat,$cpItems)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$msg = _SOBI2_CATS_COPIED;

		foreach($cid as $category) {
			/*
			 * if not copying category to it self
			 */
			if($category != $targetCat) {
				/*
				 * copy category
				 */
				echo $query = "SELECT  `name`, `image`, `image_position`, `description`, `introtext`, `published`, `checked_out`, `checked_out_time`, `ordering`, `access`, `params`,`icon` " .
						"FROM `#__sobi2_categories` WHERE catid = {$category} ";
				$database->setQuery($query);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$quelCat = null;
				if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
					$quelCat = $database->loadObject();
				}
		    	else {
		    		$database->loadObject( $quelCat );
		    	}

				$statement = "INSERT INTO `#__sobi2_categories` " .
						"( `name` , `image` , `image_position` , `description` , `introtext` , `published` , `checked_out` , `checked_out_time` , `ordering` , `access` , `params` , `icon` ) " .
						"VALUES ('{$quelCat->name}', '{$quelCat->image}', '{$quelCat->image_position}', '{$quelCat->description}', '{$quelCat->introtext}', '{$quelCat->published}', " .
						"'{$quelCat->checked_out}', '{$quelCat->checked_out_time}', '{$quelCat->ordering}', '{$quelCat->access}', '{$quelCat->params}', '{$quelCat->icon}') ";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				/*
				 * get id
				 */
				$query = "SELECT MAX(catid) FROM `#__sobi2_categories`";
				$database->setQuery( $query );
				$newCatId = $database->loadResult();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				/*
				 * insert new relation
				 */
				if($newCatId != $targetCat) {
					$statement = "INSERT INTO `#__sobi2_cats_relations` ( `catid` , `parentid` )" .
							"VALUES ('{$newCatId}', '{$targetCat}');";
					$database->setQuery($statement);
					$database->query();
					if($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else
					$msg = _SOBI2_NOT_ALL_CATS_COPIED." new cat".$newCatId." tr".$targetCat;
				/*
				 * if copy items too
				 */
				if(in_array($category,$cpItems)) {
					$query = "SELECT itemid FROM `#__sobi2_cat_items_relations` WHERE `catid` = $category";
			    	$database->setQuery( $query );
	    			$results = $database->loadObjectList();
					if($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    			if( count($results) ) {
	    				foreach($results as $sobi2) {
	    					$statement = "INSERT INTO `#__sobi2_cat_items_relations` ( `catid` , `itemid` , `ordering` ) " .
	    							"VALUES ('{$newCatId}', '{$sobi2->itemid}', '{$sobi2->itemid}')";
							$database->setQuery($statement);
							$database->query();
							if($database->getErrorNum()) {
								trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
							}
	    				}
	    			}
				}
			}
			else
				$msg = _SOBI2_NOT_ALL_CATS_COPIED;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
}
?>