<?php
/**
* @version $Id: admin.sobi2.fields.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class fieldListingsFunctions {
/*
 * saving new order for fields
 */
	function saveOrder( $fieldsId )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();

		$newOrder = sobi2Config::request( $_POST, 'order', array(0));
		$order = array_combine($fieldsId,$newOrder);
		asort($order);
		$forCount = 0;
		foreach($order as $fid => $pos) {
			$forCount++;
			$statement = "UPDATE `#__sobi2_fields` SET `position` = '{$forCount}' WHERE `fieldid` = {$fid} LIMIT 1";
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
	function orderUp( $fid )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();

		$query = "SELECT `position` FROM `#__sobi2_fields` WHERE `fieldid` = {$fid} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * get id from field over me
		 */
		$overPosition = $position - 1;
		$query = "SELECT fieldid " .
				 "FROM `#__sobi2_fields` " .
				 "WHERE (`position` = {$overPosition})";
		$database->setQuery( $query );
		$overId = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * and set it on my position
		 */
		$statement = "UPDATE `#__sobi2_fields` SET `position` = '{$position}' WHERE `fieldid` = {$overId} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * set my new position
		 */
		$position -- ;
		$statement = "UPDATE `#__sobi2_fields` SET `position` = '{$position}' WHERE `fieldid` = {$fid} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );

	}
	function orderDown( $fid )
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();

		$query = "SELECT `position` FROM `#__sobi2_fields` WHERE `fieldid` = {$fid} LIMIT 1";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		/*
		 * get id from category under
		 */
		$underPosition = $position + 1;
		$query = "SELECT fieldid " .
				 "FROM `#__sobi2_fields` " .
				 "WHERE (`position` = {$underPosition})";
		$database->setQuery( $query );
		$underId = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * and set it on my position
		 */
		$statement = "UPDATE `#__sobi2_fields` SET `position` = '{$position}' WHERE `fieldid` = {$underId} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		/*
		 * set my new position
		 */
		$position ++ ;
		$statement = "UPDATE `#__sobi2_fields` SET `position` = '{$position}' WHERE `fieldid` = {$fid} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}" );
	}
	function delete($fids)
	{
		$sobi2AdminUrl 				= "index2.php?option=com_sobi2";
		$returnTask 				= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config 					=& adminConfig::getInstance();
		$database 					= &$config->getDb();
		$msg = _SOBI2_FIELDS_DELETED;

		foreach($fids as $fid) {
			$query = "SELECT COUNT(*) FROM `#__sobi2_fields` WHERE `fieldid` = {$fid} ";
			$database->setQuery( $query );
			if($database->loadResult() != 0) {
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$statement = "DELETE FROM `#__sobi2_fields` WHERE `fieldid` = {$fid} LIMIT 1;";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$statement = "DELETE FROM `#__sobi2_language` WHERE `fieldid` = {$fid} ;";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$statement = "DELETE FROM `#__sobi2_fields_data` WHERE `fieldid` = {$fid} ;";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			else {
				$msg = _SOBI2_NOT_ALL_FIELDS_DELETED;
			}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg);
	}
}
?>