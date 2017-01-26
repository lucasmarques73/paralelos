<?php
/**
* @version $Id: admin.sobi2.listings.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class listingsFunctions {
/*
 * saving new order for items
 */
	function saveOrder( $sItemsID, $catId )
	{
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', null );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$forCount = sobi2Config::request( $_REQUEST,"limitstart", 0 );
		$newOrder = sobi2Config::request( $_POST, 'itemsOrder', array(0));
		$order = array_combine( $sItemsID, $newOrder );
		asort($order);
		foreach( $order as $sItemID => $pos ) {
			$forCount++;
			$statement = "UPDATE `#__sobi2_cat_items_relations` SET `ordering` = '{$forCount}' WHERE `catid` = {$catId} AND `itemid` = {$sItemID} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		$msg = _SOBI2_NEW_ORDERING_SAVED;
		$config->sobiCache->clearAll();
		sobi2Config::redirect( "index2.php?option=com_sobi2&task={$returnTask}", $msg );
	}

	function unpublish($sItemsID,$catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$forCount = 0;
		foreach($sItemsID as $sobi2Id) {
			$statement = "UPDATE `#__sobi2_item` SET `published` = 0 WHERE `itemid` = {$sobi2Id} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$forCount++;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );

	}
	function publish($sItemsID,$catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$forCount = 0;
		foreach($sItemsID as $sobi2Id) {
			$statement = "UPDATE `#__sobi2_item` SET `published` = 1 WHERE `itemid` = {$sobi2Id} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$forCount++;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}
	function approve($catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask	= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config	=& adminConfig::getInstance();
		$database = &$config->getDb();

		$forCount = 0;
		$sItemsID = sobi2Config::request( $_POST, 'sItem', array(0));
		foreach($sItemsID as $sobi2Id) {
			$statement = "UPDATE `#__sobi2_item` SET `approved` = 1, `published` = 1 WHERE `itemid` = {$sobi2Id} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$config->getEditForm();
			if($config->emailOnAppr) {
	    		$config->getEmails();
				if ($config->mailfrom != '' && $config->fromname != '') {
					$adminName2 	= $config->fromname;
					$adminEmail2 	= $config->mailfrom;
				} else {
				// use email address and name of first superadmin for use in email sent to user
					$query = "SELECT name, email"
					. "\n FROM #__users"
					. "\n WHERE LOWER( usertype ) = 'superadministrator'"
					. "\n OR LOWER( usertype ) = 'super administrator'"
					;
					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$row2 			= $rows[0];
					$adminName2 	= $row2->name;
					$adminEmail2 	= $row2->email;
				}
	    		sobi2Config::import("sobi2.class");
				$sobi = new sobi2($sobi2Id);
				if($config->mailSoJ == 0) {
					$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$sobi2Id}";
					$database->setQuery( $query );
					$email = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else {
					$u =& sobi2bridge::jUser( $database ) ;
					$u->load( $sobi->owner );
					$email = $u->email;
				}
				$mailMsg = $sobi->replaceMarkers($config->UserEmailOnApproveText);
				$mailTitle = $sobi->replaceMarkers($config->UserEmailOnApproveTitle);
	    		$mailMsg .= $config->mailFooter;
				if( !$email ) {
					if( !$u ) {
						$u =& sobi2bridge::jUser( $database ) ;
						$u->load( $sobi->owner );
					}
					trigger_error("approveItem(): Having no valid email address for user {$u->name} (Id:{$sobi->owner}). Entry: '{$sobi->title}' (id:{$sobi->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
					$email = $adminEmail2;
					$mailMsg = "EMAIL ERROR: \n\napproveItem(): Having no valid email address for user {$u->name} (Id:{$sobi->owner}). Entry: '{$sobi->title}' (id:{$sobi->id}) \n\n =================================== ".$mailMsg;
				}
	    		sobi2bridge::mail( $adminEmail2, $adminName2, $email, $config->makeSubject( $mailTitle ), $mailMsg );
		    	if( count( $config->S2_plugins ) ) {
		    		foreach( $config->S2_plugins as $plugin ) {
		   				if( method_exists( $plugin, "onApprove" ) ) {
		    				$plugin->onApprove( $sobi2Id );
		   				}
		    		}
		    	}
			}
			$forCount++;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}
	function unApprove()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();

		$forCount = 0;
		$sItemsID = sobi2Config::request( $_POST, 'sItem', array(0));
		foreach($sItemsID as $sobi2Id) {
			$statement = "UPDATE `#__sobi2_item` SET `approved` = 0, `published` = 0 WHERE `itemid` = {$sobi2Id} LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$forCount++;
	    	if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	   				if(method_exists($plugin, "onUnApprove")) {
	    				$plugin->onUnApprove($sobi2Id);
	   				}
	    		}
	    	}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}

	function orderUp($sItemID,$catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		if($catId == 0) {
			$catId = 1;
		}
		$query = "SELECT `ordering` FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$catId} AND `itemid` = {$sItemID} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * item over editing item one position down
		 */
		$down = $position - 1;
		$statement = "UPDATE `#__sobi2_cat_items_relations` SET `ordering` = '{$position}' WHERE `catid` = {$catId} AND `ordering` = {$down} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * item one position up
		 */
		$position--;
		$statement = "UPDATE `#__sobi2_cat_items_relations` SET `ordering` = '{$position}' WHERE `catid` = {$catId} AND `itemid` = {$sItemID} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}
	function orderDown($sItemID,$catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		if($catId == 0) {
			$catId = 1;
		}
		$query = "SELECT `ordering` FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$catId} AND `itemid` = {$sItemID} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * item over editing item one position up
		 */
		$up = $position + 1;
		$statement = "UPDATE `#__sobi2_cat_items_relations` SET `ordering` = '{$position}' WHERE `catid` = {$catId} AND `ordering` = {$up} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * item one position down
		 */
		$position++;
		$statement = "UPDATE `#__sobi2_cat_items_relations` SET `ordering` = '{$position}' WHERE `catid` = {$catId} AND `itemid` = {$sItemID} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );

	}
	function remove($sItemsID,$catId)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();

		foreach($sItemsID as $sobi2Id) {
			$config->sobiCache->removeObj( $sobi2Id );
			$statement = "DELETE FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$catId} AND `itemid` = {$sobi2Id} LIMIT 1;";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		$msg = _SOBI2_ITEM_REMOVED_FROM_CAT;
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function delete( $sItemsID )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$forCount = 0;

		foreach($sItemsID as $sobi2Id) {
			$statement = "DELETE FROM `#__sobi2_item` WHERE `itemid` = {$sobi2Id} LIMIT 1;";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$statement = "DELETE FROM `#__sobi2_cat_items_relations` WHERE `itemid` = {$sobi2Id};";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			else {
				$statement = "DELETE FROM `#__sobi2_fields_data` WHERE `itemid` = {$sobi2Id};";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			$forCount++;
		}
		$msg = _SOBI2_ITEM_DELETED;
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );

	}
	function move($sItemsID,$catId,$targetCat)
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$msg = _SOBI2_ITEMS_MOVED;

		foreach($sItemsID as $sobi2Id) {
			$query = "SELECT COUNT(*) FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$targetCat} AND `itemid` = {$sobi2Id} LIMIT 1;";
			$database->setQuery( $query );
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			/*
			 * if this item ist NOT in target category
			 */
			if($database->loadResult() == 0) {
				$statement = "UPDATE `#__sobi2_cat_items_relations` SET `catid` = {$targetCat} WHERE `catid` = {$catId} AND `itemid` = {$sobi2Id} LIMIT 1;";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			else {
				$msg = _SOBI2_NOT_ALL_ITEMS_MOVED;
			}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function copy( $sItemsID, $catId, $targetCat )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$msg = _SOBI2_ITEMS_COPIED;

		foreach($sItemsID as $sobi2Id) {
			$query = "SELECT COUNT(*) FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$targetCat} AND `itemid` = {$sobi2Id} LIMIT 1;";
			$database->setQuery( $query );
			/*
			 * if this item ist NOT in target category
			 */
			if($database->loadResult() == 0) {
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$statement = "INSERT INTO `#__sobi2_cat_items_relations` ( `catid` , `itemid` , `ordering` ) VALUES ( '{$targetCat}', '{$sobi2Id}', '{$sobi2Id}');";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			else {
				$msg = _SOBI2_NOT_ALL_ITEMS_COPIED;
			}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
}
?>