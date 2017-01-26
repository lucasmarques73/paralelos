<?php
/**
* @version $Id: admin.sobi2.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
/*
 * ensure user has access to this function
 */
sobi2Config::import("sobi2.class");

class adminSobi extends sobi2 {

    function adminSobi($sobi2Id = 0) {
    	parent::sobi2($sobi2Id);
    }
    function saveSobi()
    {
		$config	=& adminConfig::getInstance();
		$database = &$config->getDb();
		$my	= &$config->getUser();
    	$msgAfterSave = _SOBI2_CHANGES_SAVED;
    	/*
		 * this field_entry_name are not editable and have to be allways there
		 */
		$this->title = $config->clearSQLinjection(sobi2Config::request( $_REQUEST, 'field_entry_name', null, null));

    	if(!$config->allowMultiTitle) {
	    	/*
	    	 * check if item with this name allready exist
	    	 */
	    	$query = "SELECT COUNT(*) FROM `#__sobi2_item` WHERE `title`='{$this->title}'";
	    	$database->setQuery( $query );
	    	$c = $database->loadResult();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	    	/*
	    	 * case item with this name allready exist, create a new form with data
	    	 */
	    	if( $c ) {
				$r = sobi2Config::request($_REQUEST, "returnTask", null);
	    		if(!$this->id) {
	    			$href = "index2.php?option=com_sobi2&task=edit&hidemainmenu=1&returnTask={$r}";
	    		}
				else {
					$href = "index2.php?option=com_sobi2&task=edit&sobi2Id={$this->id}&hidemainmenu=1&returnTask={$r}";
				}
				sobi2Config::redirect( $href, _SOBI2_SAVE_DUPLICATE_ENTRY);
				exit();
    		}
    	}
    	$this->owner = intval( sobi2Config::request( $_REQUEST, 'created_by', 0 ) );
    	$this->getFieldsNames();
    	$this->getFieldsData();
    	$this->getExistingCats();
    	$this->getSelectedCats();

    	/*
    	 * set created and expiration date
    	 */
    	if(!sobi2Config::request($_REQUEST, 'added_date', null)) {
    		$this->publish_up = $config->getTimeAndDate();
    	}
    	else {
    		$this->publish_up = sobi2Config::request($_REQUEST, 'added_date', '');
    	}

    	$expField = $config->key( "edit_form", "exp_field" );
    	if( $expField &&  isset( $this->fieldsData[$expField] ) && !empty($this->fieldsData[$expField]) ) {
    		$this->publish_down = $this->fieldsData[$expField];
    		if( $config->key( "edit_form", "revert_exp_date" ) ) {
    			$this->publish_down = str_replace( ".", "-", $this->publish_down );
    			$this->publish_down = explode( "-", $this->publish_down );
    			$this->publish_down = array_reverse( $this->publish_down );
    			$this->publish_down = implode( "-", $this->publish_down );
    		}
    	}
    	elseif(!sobi2Config::request($_REQUEST, 'exp_date', '')) {
    		$this->publish_down = sobi2Config::request( $_REQUEST, 'exp_date', null );
    	}
    	elseif($config->entryExpirationTime && $config->entryExpirationTime != null && $config->entryExpirationTime != 0) {
    		$this->publish_down = $config->getTimeAndDate($config->entryExpirationTime);
    	}
    	else {
    		$this->publish_down = $config->nullDate;
    	}

    	$publishedField = $config->key( "edit_form", "published_field" );
    	if( $publishedField &&  isset( $this->fieldsData[$publishedField] ) ) {
    		$this->published = $this->fieldsData[$publishedField];
    	}
    	else {
    		$this->published = intval( sobi2Config::request( $_REQUEST, 'published', 0 ) );
    		$this->approved = intval( sobi2Config::request( $_REQUEST, 'approved', 0 ) );
    	}

		$this->confirm = intval( sobi2Config::request( $_REQUEST, 'confirmed', 0 ) );
    	$this->archived = 0;
    	$this->checked_out = 0;
    	$this->ip = $_SERVER["REMOTE_ADDR"];
		$this->metakey  = $config->clearSQLinjection(sobi2Config::request($_REQUEST, 'sobi2MetaKey', ''));
		$this->metadesc = $config->clearSQLinjection(sobi2Config::request($_REQUEST, 'sobi2Metadesc', ''));
		$this->background = sobi2Config::request($_REQUEST, 'backgroundimage', '');
		$this->params = $config->arrToIni( $this->params );
    	/*
    	 * save the item in database
    	 */
    	$database->setQuery( "START TRANSACTION;" );
		$database->query();
		if ( $database->getErrorNum() ) {
			trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
		}
    	$statement = "INSERT INTO `#__sobi2_item`(`title`, `hits`, `published`, `approved`, `confirm`, `archived`,`publish_up`,`publish_down`,`checked_out`,`ordering`,`owner`, `background`, `ip`, `metakey`, `metadesc`, `params` )" .
    			"VALUES ( " .
    			"'{$this->title}', 0 , " .
    			"'{$this->published}', " .
    			"'{$this->approved}', " .
    			"'{$this->confirm}', " .
    			"'{$this->archived}', " .
    			"'{$this->publish_up}', " .
    			"'{$this->publish_down}', " .
    			"'{$this->checked_out}', " .
    			"'0', " .
    			"'{$this->owner}', " .
    			"'{$this->background}', " .
    			"'{$this->ip}'," .
    			"'{$this->metakey}'," .
    			"'{$this->metadesc}', '{$this->params}');";
    	$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			return false;
		}
    	$this->id = $database->insertid();
    	$database->setQuery( "COMMIT;" );
		$database->query();
		if ( $database->getErrorNum() ) {
			trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
		}
    	/*
    	 * image file upload handling
    	 */
    	if(isset($_FILES["sobi2Img"]) && is_array($_FILES["sobi2Img"])) {
    		$msgAfterSave = $msgAfterSave.$this->getImage($_FILES["sobi2Img"], "img");
    	}
    	/*
    	 * icon file upload handling
    	 */
    	if(isset($_FILES["sobi2Ico"]) && is_array($_FILES["sobi2Ico"])) {
    		$msgAfterSave = $msgAfterSave.$this->getImage($_FILES["sobi2Ico"], "ico");
    	}
    	if(isset($_FILES["sobi2Img"]) || isset($_FILES["sobi2Ico"])) {
	    	$statement = "" .
	    			"UPDATE `#__sobi2_item` SET `title` = '{$this->title}'," .
	    			"`icon` = '{$this->icon}', " .
	    			"`image` = '{$this->image}', " .
	    			"`last_update` = '{$config->nullDate}', " .
	    			"`updating_user` = '{$my->id}', " .
	    			"`updating_ip` = '{$this->ip}' WHERE `itemid` = {$this->id} LIMIT 1 ;";
	    	$database->setQuery($statement);
	    	$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
    	}
    	/*
    	 * now save the fields data
    	 */
    	foreach($this->fieldsData as $fieldid => $value) {
    		if(is_array($value) && !empty($value)) {
    			$v = array();
    			foreach ($value as $opt) {
    				$v[] = " ( '{$fieldid}', '{$opt}', NULL , '{$this->id}', NULL )";
    			}
    			$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `data_bool` , `itemid` , `expiration` ) VALUES " .  implode(" , ", $v);
    		}
    		elseif(sizeof($value) != 0 && $value != '') {
	    		$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `data_bool` , `itemid` , `expiration` ) " .
	    				"VALUES ( '{$fieldid}', '{$value}', NULL , '{$this->id}', NULL );";
    		}
    		else {
    			$statement = null;
    		}
    		if($statement) {
    			$database->setQuery($statement);
    			$database->query();
				if ($database->getErrorNum()) {
					trigger_error("adminSobi::saveSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
    		}
    	}
	   	/*
    	 * saving item in categories
    	 */
	   	$cids = array();
    	foreach( $this->selectedCats as $catid => $category ) {
    		$cids[] = $catid;
			$query = "SELECT MAX(ordering) FROM `#__sobi2_cat_items_relations` WHERE `catid` = '{$catid}'";
			$database->setQuery( $query );
			$order = $database->loadResult();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$order++;
    		$statement = "INSERT INTO `#__sobi2_cat_items_relations` (`catid`, `itemid`, `ordering`)" .
    					 "VALUES ({$catid},{$this->id}, {$order})";
    		$database->setQuery($statement);
    		$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$cache =& $config->sobiCache;
			$cache->recountCats( $cids );
    	}
		$plugins["fees"] = array();
		$plugins['msg'] =& $msgAfterSave;
    	if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
				if(method_exists($plugin, "save")) {
					$plugin->save( $plugins ,$this->id);
    			}
    		}
    	}
    	$config->sobiCache->removeObj( $this->id );
    	return array( "id" => $this->id, "msg" => $msgAfterSave );
    }

   function updateSobi()
   {
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
		$my	= &$config->getUser();
		$cids = array();
    	$msgAfterUpdate = _SOBI2_CHANGES_SAVED;
    	if(defined('_SOBI2_ADMIN')) {
	    	$this->title = $config->clearSQLinjection(sobi2Config::request( $_REQUEST, 'field_entry_name', null, null));
    		$this->owner = intval( sobi2Config::request( $_REQUEST, 'created_by', 0 ) );
	    	$this->getFieldsNames();
	    	$this->getFieldsData();
	    	$this->getExistingCats();
	    	$this->getSelectedCats();
    		$this->metakey  = $config->clearSQLinjection(sobi2Config::request($_REQUEST, 'sobi2MetaKey', ''));
    		$this->metadesc = $config->clearSQLinjection(sobi2Config::request($_REQUEST, 'sobi2Metadesc', ''));
    		$this->background = sobi2Config::request($_REQUEST, 'backgroundimage', '');

			$wasApp = $this->approved;
	    	$publishedField = $config->key( "edit_form", "published_field" );
	    	if( $publishedField &&  isset( $this->fieldsData[$publishedField] ) ) {
	    		$this->published = $this->fieldsData[$publishedField];
	    		$this->approved = $this->fieldsData[$publishedField];
	    	}
	    	else {
		    	$this->published = intval( sobi2Config::request( $_REQUEST, 'published', 0 ) );
		    	$this->approved = intval( sobi2Config::request( $_REQUEST, 'approved', 0 ) );
	    	}

    		$this->confirm = intval( sobi2Config::request( $_REQUEST, 'confirmed', 0 ) );
    		$this->publish_up = sobi2Config::request($_REQUEST, 'added_date', '');

	    	$expField = $config->key( "edit_form", "exp_field" );
	    	if( $expField && isset( $this->fieldsData[$expField] ) && !empty($this->fieldsData[$expField]) ) {
	    		$this->publish_down = $this->fieldsData[$expField];
	    		if( $config->key( "edit_form", "revert_exp_date" ) ) {
	    			$this->publish_down = str_replace( ".", "-", $this->publish_down );
	    			$this->publish_down = explode( "-", $this->publish_down );
	    			$this->publish_down = array_reverse( $this->publish_down );
	    			$this->publish_down = implode( "-", $this->publish_down );
	    		}
	    	}
	    	else {
	    		$this->publish_down = sobi2Config::request($_REQUEST, 'exp_date', '');
	    	}
    		if($this->publish_down == null || $this->publish_down == 0 || !$this->publish_down) {
    			$this->publish_down = $config->nullDate;
    		}

    		$this->hits = intval( sobi2Config::request( $_REQUEST, 'hits_counter', 0 ) );
	    	$now = $config->getTimeAndDate();
	    	$this->updatingIp = $_SERVER["REMOTE_ADDR"];

	    	/*
	    	 * image file upload handling
	    	 */
	    	if(intval(sobi2Config::request($_REQUEST, 'sobi2ImgDelete', 0))){
	    		$this->image = null;
	    	}
	    	elseif(isset($_FILES["sobi2Img"]) && is_array($_FILES["sobi2Img"])) {
	    		$msgAfterUpdate = $msgAfterUpdate.$this->getImage($_FILES["sobi2Img"], "img");
	    	}
	    	/*
	    	 * icon file upload handling
	    	 */
	       	if(intval(sobi2Config::request($_REQUEST, 'sobi2IcoDelete', 0))){
	    		$this->icon = null;
	    	}
	    	elseif(isset($_FILES["sobi2Ico"]) && is_array($_FILES["sobi2Ico"])) {
	    		$msgAfterUpdate = $msgAfterUpdate.$this->getImage($_FILES["sobi2Ico"], "ico");
	    	}
	    	$this->params = $config->arrToIni( $this->params );
	    	/*
	    	 * updating basic information
	    	 */
	    	$statement = "" .
	    			"UPDATE `#__sobi2_item` SET `title` = '{$this->title}'," .
	    			"`icon` = '{$this->icon}', " .
	    			"`image` = '{$this->image}', " .
					"`hits` = '{$this->hits}', " .
					"`published` = '{$this->published}', " .
					"`confirm` = '{$this->confirm}', " .
					"`approved` = '{$this->approved}', " .
					"`publish_up` = '{$this->publish_up}', " .
					"`publish_down` = '{$this->publish_down}', " .
	    			"`last_update` = '{$now}', " .
	    			"`updating_user` = '{$my->id}', " .
	    			"`background` = '{$this->background}', " .
	    			"`owner` = '{$this->owner}', " .
	    			"`metakey` = '{$this->metakey}', " .
	    			"`checked_out` = '0', " .
	    			"`checked_out_time` = '0', " .
	    			"`metadesc` = '{$this->metadesc}', `params` = '{$this->params}', ".
	    			"`updating_ip` = '{$this->updatingIp}' WHERE `itemid` = {$this->id} LIMIT 1 ;";
	    	$database->setQuery($statement);
	    	$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	    	/*
	    	 * updating fields data
	    	 */
	    	foreach($this->fieldsData as $fieldid => $value) {
	    		/*
	    		 * check if updating or inserting new
	    		 */
	    		if(is_array($value) && !empty($value)) {
	    			$statement = "DELETE FROM `#__sobi2_fields_data` WHERE `fieldid` = {$fieldid} AND `itemid` = {$this->id};";
		    		$database->setQuery( $statement );
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("adminSobi::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    			$v = array();
	    			foreach ($value as $opt) {
	    				$v[] = " ( '{$fieldid}', '{$opt}', NULL , '{$this->id}', NULL )";
	    			}
	    			$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `data_bool` , `itemid` , `expiration` ) VALUES " .  implode(" , ", $v) .";";
		    		$database->setQuery( $statement );
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("adminSobi::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    		else {
		    		$query = "SELECT COUNT(*) FROM `#__sobi2_fields_data` WHERE (`itemid` = {$this->id} AND `fieldid` = {$fieldid})";
		    		$database->setQuery( $query );
		    		$update = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("adminSobi::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
		    		if($update) {
		    			$statement = "UPDATE `#__sobi2_fields_data` SET `data_txt` = '{$value}' WHERE (`itemid` = {$this->id} AND `fieldid` = $fieldid) LIMIT 1 ";
		    		}
		    		 else {
		    			$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `itemid` ) " .
		    				"VALUES ( '{$fieldid}', '{$value}', '{$this->id}' );";
		    		 }
		    		$database->setQuery($statement);
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("adminSobi::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    	}
	    	/*
	    	 * get all old relations
	    	 */
	    	$query = "SELECT `catid` FROM `#__sobi2_cat_items_relations` WHERE `itemid` = {$this->id}";
	    	$database->setQuery($query);
	    	$oldRelations = $database->loadResultArray();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$newRelations = array();
	    	/*
	    	 * inserting new categories
	    	 */
	    	foreach($this->selectedCats as $catid => $category) {
			$newRelations[] = $catid;
	    		if(!(in_array($catid,$oldRelations))) {
		    		$query = "SELECT MAX(ordering) FROM `#__sobi2_cat_items_relations` WHERE `catid` = '{$catid}'";
					$database->setQuery( $query );
					$order = $database->loadResult();
					if($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$order++;
		    		$statement = "INSERT INTO `#__sobi2_cat_items_relations` (`catid`, `itemid`, `ordering`)" .
		    					 "VALUES ({$catid},{$this->id}, {$order})";
		    		$database->setQuery($statement);
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
	    	}
	    	$cids = array_merge( $newRelations, $oldRelations );
	    	foreach ( $oldRelations as $oldRelation ) {
	    		if(!(in_array($oldRelation,$newRelations)) && $oldRelation != 1) {
	    			$statement = "DELETE FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$oldRelation} AND `itemid` = {$this->id}";
		    		$database->setQuery($statement);
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("adminSobi::updateSobi(): Cannot remove some realtions. DB reports:".$database->stderr());
					}
	    		}
	    	}
	    	$cache =& $config->sobiCache;
	    	$cache->recountCats( $cids );
			if($config->emailOnAppr && $wasApp ==  0 && $this->approved == 1) {
				$config->getEmails();
				if ( $config->mailfrom != '' && $config->fromname != '' ) {
					$adminName2 	= $config->fromname;
					$adminEmail2 	= $config->mailfrom;
				}
				else {
				// use email address and name of first superadmin for use in email sent to user
					$query = "SELECT name, email"
					. "\n FROM #__users"
					. "\n WHERE LOWER( usertype ) = 'superadministrator'"
					. "\n OR LOWER( usertype ) = 'super administrator'"
					;
					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					if ( $database->getErrorNum() ) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$row2 			= $rows[0];
					$adminName2 	= $row2->name;
					$adminEmail2 	= $row2->email;
				}
				if( $config->mailSoJ == 0 ) {
					$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$this->id}";
					$database->setQuery( $query );
					$email = $database->loadResult();
					if( $database->getErrorNum() ) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else {
					$u =& sobi2bridge::jUser( $database ) ;
					$u->load( $this->owner );
					$email = $u->email;
				}
				$mailMsg = $this->replaceMarkers( $config->UserEmailOnApproveText );
				$mailTitle = $this->replaceMarkers( $config->UserEmailOnApproveTitle );
		    	$mailMsg .= $config->mailFooter;
				if( !$email ) {
					if( !isset( $u ) || !$u ) {
						$u =& sobi2bridge::jUser( $database ) ;
						$u->load( $this->owner );
					}
					trigger_error("adminSobi::updateSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
					$email = $adminEmail2;
					$mailMsg = "EMAIL ERROR: \n\nadminSobi::updateSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}) \n\n =================================== \n\n".$mailMsg;
				}
		    	sobi2bridge::mail($adminEmail2, $adminName2, $email, $config->makeSubject( $mailTitle ), $mailMsg);
			}
			$plugins["fees"] = array();
			$plugins['msg'] =& $msgAfterUpdate;
	    	if( count( $config->S2_plugins ) ) {
	    		foreach( $config->S2_plugins as $plugin ) {
    				if( method_exists( $plugin, "update" ) ) {
    					$plugin->update( $plugins ,$this->id );
	    			}
	    		}
	    	}

	    	if( $wasApp != $this->approved || !$this->hits ) {
		    	$method = $wasApp ? "onUnApprove" : "onApprove";
				if( count( $config->S2_plugins ) ) {
		    		foreach( $config->S2_plugins as $plugin ) {
		   				if( method_exists( $plugin, $method ) ) {
		    				$plugin->$method( $this->id );
		   				}
		    		}
		    	}
			}
			$config->sobiCache->removeObj( $this->id );
    	}
 		else {
 			sobi2Config::redirect( $sobi2AdminUrl, _SOBI2_NOT_AUTH);
 		}
    	return $msgAfterUpdate;
    }
    function getPlugins($msgAfterSave, $save = true)
    {
		$config =& adminConfig::getInstance();
    	$pluginsOutput = array();
    	$pluginsOutput['fees'] = array();
    	$pluginsOutput['msg'] = $msgAfterSave;
    	if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			if($save) {
    				if(method_exists($plugin,"save")) {
    					$pluginsOutput = $plugin->save($pluginsOutput,$this->id);
    				}
    			}
    			else {
    				if(method_exists($plugin,"update")) {
    					$pluginsOutput = $plugin->update($pluginsOutput,$this->id);
    				}
    			}
    		}
    	}
    	return $pluginsOutput;
    }
}
?>
