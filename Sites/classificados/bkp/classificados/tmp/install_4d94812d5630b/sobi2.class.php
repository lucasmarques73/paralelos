<?php
/**
* @version $Id: sobi2.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class sobi2 {
    /**
     * @var int
     */
    var $id 				= 0;
    /**
     * @var bool
     */
    var $title 				= '';
    /**
     * @var int
     */
    var $hits 				= 0;
    /**
     * @var int
     */
    var $visits 			= 0;
    /**
     * @var bool
     */
    var $published 			= 0;
    /**
     * @var bool
     */
    var $confirm 			= 0;
    /**
     * @var bool
     */
    var $approved 			= 0;
    /**
     * @var bool
     */
    var $archived 			= 0;
    /**
     * @var string
     */
    var $publish_up 		= '';
    /**
     * @var string
     */
    var $publish_down 		= '';
    /**
     * @var bool
     */
    var $checked_out 		= false;
    /**
     * @var string
     */
    var $checked_out_time 	= '';
    /**
     * @var int
     */
    var $ordering 			= 0;
    /**
     * @var int
     */
    var $owner 				= '';
    /**
     * @var string
     */
    var $updaterName 		= '';
    /**
     * @var string
     */
    var $image 				= '';
    /**
     * @var string
     */
    var $icon 				= '';
    /**
     * @var string
     */
    var $ip 				= '';
    /**
     * @var string
     */
    var $lastUpdate 		= '';
    /**
     * @var int
     */
    var $updatingUser 		= '';
    /**
     * @var string
     */
    var $updatingIp 		= '';
    /**
     * @var array
     */
    var $fields 			= array();
    /**
     * @var array
     */
    var $fieldsData 		= array();
    /**
     * @var array
     */
    var $myFields			= array();
    /**
     * @var array
     */
    var $existingCats 		= array();
    /**
     * @var array
     */
    var $selectedCats 		= array();
    /**
     * @var array
     */
    var $myCategories 		= array();
    /**
     * @var array
     */
    var $customFieldsData 	= array();
    /**
     * @var string
     */
    var $metakey 			= '';
    /**
     * @var string
     */
    var $metadesc 			= '';
    /**
     * @var array
     */
    var $fees 				= array();
    /**
     * @var array
     */
    var $markers			= array();
    /**
     * @var string
     */
    var $background			= '';
    /**
     * @var string
     */
    var $options 			= '';
    /**
     * @var array
     */
    var $params				= '';
    /**
     * @var int
     */
	var $defCid				= 0;
    /**
     * @var string
     */
	var $tpl				= '';
    /**
     * @param int $sobi2Id
     * @param bool $data
     * @return sobi2
     */
    function sobi2( $sobi2Id = 0, $data = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( $sobi2Id ) {
    		$this->getAttributs( $sobi2Id, $data );
    	}
    	if( count( $config->S2_plugins ) ) {
    		foreach( $config->S2_plugins as $plugin ) {
				if( method_exists( $plugin, 'onCreateSobiObj' ) ) {
					$plugin->onCreateSobiObj( $this );
    			}
    		}
    	}
    }
    /**
     * getting all atributes for sobi item
     *
     * @param int $sobi2Id
     * @param bool $data
     */
    function getAttributs( $sobi2Id, $data = false )
    {
    	$config 	=& sobi2Config::getInstance();
		$database	=& $config->getDb();
    	$now 		= $config->getTimeAndDate();

    	/*
    	 * check if the user is an admin
    	 */
    	if( $config->checkPerm() ) {
    		$query = 'SELECT *, item.params AS parameters FROM #__sobi2_item  AS item ' .
    				 'LEFT JOIN #__users AS user ON item.updating_user = user.id ' .
    				 "WHERE ( itemid = {$sobi2Id} )";
    		$cl = 9;
    	}
    	elseif( $data ) {
    		$query = "SELECT *, params AS parameters  FROM #__sobi2_item WHERE ( itemid = {$sobi2Id} )";
    		$cl = 9;
    	}
    	else {
    		$cl = -1;
    		switch ( $config->publishedItems )
    		{
    			case 0:
    			default:
    				$published = "AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' )";
    				$cl = 0;
    				break;
    			case 1:
    				$published = 'AND `published` = 1 ';
    				$cl = 1;
    				break;
    			case 2:
    				$published = null;
    				$cl = 2;
    				break;
    			case 4:
    				$user =& $config->getUser();
    				$cl = 4;
    				$published = "AND `published` = 1 AND ((`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) OR `owner` = {$user->id})";
    				break;
    			case 5:
    				$user =& $config->getUser();
    				$cl = 5;
    				$published = "AND ((`published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' )) OR `owner` = {$user->id})";
    				break;
    		}
    		$query = "SELECT *, params AS parameters  FROM #__sobi2_item WHERE (`itemid` = {$sobi2Id} {$published} )";
    	}
    	$database->setQuery( $query );
    	$item = null;
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$item = $database->loadObject();
		}
    	else {
    		$database->loadObject( $item );
    	}
		if ( $database->getErrorNum() ) {
			trigger_error( 'getAttributs():'.$database->stderr() );
		}
    	if( $item ) {
	    	$this->id 				= $sobi2Id;
	    	$this->title 			= $config->getSobiStr( $item->title );
	    	$this->hits 			= $item->hits;
	    	$this->visits 			= $item->visits;
	    	$this->published 		= $item->published;
	    	$this->confirm 			= $item->confirm;
	    	$this->approved 		= $item->approved;
	    	$this->archived 		= $item->archived;
	    	$this->publish_up 		= $item->publish_up;
	    	$this->publish_down 	= $item->publish_down;
	    	$this->checked_out 		= $item->checked_out;
	    	$this->checked_out_time = $item->checked_out_time;
	    	$this->ordering 		= $item->ordering;
	    	if( $config->checkPerm() ) {
	    		$this->updaterName = $item->name;
	    	}
	    	$this->owner 			= $item->owner;
	    	$this->image 			= $item->image;
	    	$this->icon 			= $item->icon;
	    	$this->ip 				= $item->ip;
	    	$this->lastUpdate 		= $item->last_update;
	    	$this->updatingUser 	= $item->updating_user;
	    	$this->updatingIp 		= $item->updating_ip;
	    	$this->metakey 			= $config->getSobiStr($item->metakey);
	    	$this->metadesc 		= $config->getSobiStr($item->metadesc);
	    	$this->background 		= $item->background;
	    	$this->options 			= $item->options;
	    	$this->params 			= $config->iniToArr( $item->parameters );
	    	if( !defined( '_SOBI2_ADD_FORM' ) ) {
		    	if( !$this->icon && $config->key( 'frontpage', 'default_ico' ) ) {
	            	$this->icon = $config->key( 'frontpage', 'default_ico' );
	            }
	            if( !$this->image && $config->key( 'frontpage', 'default_img' ) ) {
	            	$this->image = $config->key( 'frontpage', 'default_img' );
	            }
	    	}
	    	/* try get cached object first */
	    	$cache =& $config->sobiCache;
	    	sobi2Config::import( 'field.class' );
	    	if( $vars = $cache->getObj( $this->id, $cl ) ) {
				if( $this->restoreCachedVars( $vars ) ) {
					return true;
				}
	    	}
	    	/*
	    	 * now get the data from fields
	    	 */
	    	static $fields = array();
	    	if( empty( $fields ) ) {
		    	$query = 'SELECT fieldid FROM #__sobi2_fields ORDER BY position';
	    		$database->setQuery( $query );
	    		$fields = $database->loadObjectList();
				if ( $database->getErrorNum() ) {
					trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
				}
	    	}
    		foreach( $fields as $field ) {
				$f = new sobiField( $field->fieldid,$this->id );
    			$allfields[ $f->fieldname ] = $f;
    		}
    		if( count( $allfields ) ) {
	    		$this->myFields =& $allfields;
    			foreach ( $allfields as $field ) {
	    			if( $field->fieldType == 6 ) {
						$field->data = $field->selectedValues;
		    			if( is_array( $field->data ) ) {
							$this->markers = $this->markers + array( $field->fieldname => $config->getSobiStr( implode( ', ', $field->data ) ) );
		    			}
					}
					elseif( $field->fieldType == 3 ) {
						if( defined( '_SOBI2_CHECKBOX_NO' ) ) {
							$fdata = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
						}
						else {
							$fdata = $field->data ? 1 : 0;
						}
						$this->markers = $this->markers + array( $field->fieldname => $fdata );
					}
					else {
						$this->markers = $this->markers + array( $field->fieldname => $config->getSobiStr( $field->data ) );
					}
					if( !is_array( $field->data ) ) {
						$field->data = $config->getSobiStr( $field->data );
					}
	    			$this->customFieldsData = $this->customFieldsData + array( $field->fieldname => $field->data );
	    		}
			}
    		/*
    		 * Now get all categories witch contain this item
    		 */
    		 $query = 'SELECT name, relation.catid, params FROM #__sobi2_cat_items_relations AS relation ' .
    		 		  'LEFT JOIN #__sobi2_categories AS cats ON relation.catid = cats.catid ' .
    		 		  "WHERE ( itemid = {$this->id} AND published = 1 ) LIMIT {$config->maxCatsForEntry}";
			$database->setQuery( $query );
    		$results = $database->loadObjectList();
			if ( $database->getErrorNum() ) {
				trigger_error( 'sobi2::getAttributs(): DB reports: '.$database->stderr(), E_USER_WARNING );
			}
			$pars = array();
    		if( count( $results ) ) {
    			static $c = false;
    			foreach( $results as $cat ) {
					if( !$c ) {
						$c = true;
						$this->defCid = $cat->catid;
					}
    				$this->myCategories = $this->myCategories + array( $cat->catid => $config->getSobiStr( $cat->name ) );
    				$pars[ $cat->catid ] = $cat->params;
    			}
    		}
    		if( isset( $this->params[ 'def_cid' ] ) && $this->params[ 'def_cid' ] && key_exists( $this->params[ 'def_cid' ], $this->myCategories ) ) {
    			$this->defCid = $this->params[ 'def_cid' ];
    		}
    		if( $this->defCid ) {
	    		$params = $config->iniToArr( $pars[ $this->defCid ] );
	    		if( isset( $params[ 'template' ] ) && strlen( $params[ 'template' ] ) ) {
	    			$this->tpl = $params[ 'template' ];
	    		}
    		}
    		$cache->addObj( get_object_vars( $this ), $this->id, $cl );
    	}
		else {
			if( sobi2Config::request( $_REQUEST, 'sobi2Task', null ) == 'sobi2Details' ) {
				sobi2Config::redirect( $config->key( "redirects", "no_sobi_attr", "index.php" ), _SOBI2_NOT_AUTH );
			}
			return null;
		}
    }
    function restoreCachedVars( $vars )
    {
	    static $private = array(
	    	'params', 'options', 'background', 'metadesc', 'metakey', 'updatingIp', 'updatingUser', 'lastUpdate', 'ip', 'icon',
	    	'image', 'owner', 'updaterName', 'ordering', 'checked_out_time', 'checked_out', 'publish_down', 'publish_up', 'archived',
	    	'approved', 'confirm', 'published', 'visits', 'hits', 'title', 'id'
	    );
		if( is_array( $vars ) && !empty( $vars ) ) {
			foreach ( $vars as $var => $value ) {
				if( !in_array( $var, $private ) ) {
					if( isset( $this->$var ) ) {
						$this->$var = $value;
					}
				}
			}
			return true;
		}
		else {
			return false;
		}
    }
    /**
     * saving new entry
     * @return string
     */
    function saveSobi()
    {
    	$config =& sobi2Config::getInstance();
		$my =& $config->getUser();
		$database =& $config->getDb();
		$config->getEditForm();
    	$msgAfterSave = null;
    	/*
    	 * case using security code
    	 */
    	if( $config->useSecurityCode ) {
    		$this->checkSeccode();
    	}

    	/*
		 * this field_entry_name are not editable and have to be allways there
		 */
		$this->title = $config->clearSQLinjection( sobi2Config::request( $_POST, 'field_entry_name', null, 0x0002 ) );
		$this->title = $this->cleanInput( $this->title );
		/*
		 * if not title than the data are not send trough sobi form
		 */
		if(!$this->title) {
			sobi2Config::redirect( $config->key( "redirects", "save_sobi_no_title", "index.php"), _SOBI2_NOT_AUTH);
			exit();
		}
    	if( !$config->allowMultiTitle ) {
	    	/*
	    	 * check if item with this name allready exist
	    	 */
	    	$query = "SELECT COUNT(*) FROM `#__sobi2_item` WHERE `title`='{$this->title}'";
	    	$database->setQuery( $query );
	    	/*
	    	 * case item with this name allready exist, create a new form with data
	    	 */
	    	if( $database->loadResult() > 0 ) {
				if( $database->getErrorNum() ) {
					trigger_error("sobi2::saveSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				if( !$this->id ) {
					$href = "index.php?option=com_sobi2&amp;sobi2Task=addNew&amp;Itemid={$config->sobi2Itemid}";
				}
				else {
					$href = "index.php?option=com_sobi2&amp;sobi2Task=editSobi&amp;sobi2Id={$this->id}&amp;Itemid={$config->sobi2Itemid}";
				}
				sobi2Config::redirect( $config->key( "redirects", "save_sobi_duplicate", $href ), _SOBI2_SAVE_DUPLICATE_ENTRY);
				exit();
	    	}
    	}
    	if($config->allowUsingBackground) {
    		$this->background = sobi2Config::request($_REQUEST, 'backgroundimage', '');
    	}
    	$this->owner = $my->id;
    	/* in case that the session is already closed or for some other reason we don't have the user object anymore */
		if( !$this->owner ) {
			/* is the encrypted user id */
			$cuid = sobi2Config::request( $_POST, 'cuid', null );
			/* is the raw transfered user id */
			$uid = sobi2Config::request( $_POST, 'uid', null );
			/* mix it again */
			$ruid = md5( $config->secret.$uid );
			/* if the same result means the user was indeed logged in as the add entry form was started */
			if( $cuid === $ruid ) {
				$this->owner = $uid;
			}
		}
    	$publishedField = $config->key( "edit_form", "published_field" );
    	if( $publishedField &&  isset( $this->fieldsData[$publishedField] ) && !empty($this->fieldsData[$publishedField]) ) {
    		$this->published = $this->fieldsData[$publishedField];
    		$this->approved = $this->fieldsData[$publishedField];
    	}
    	else {
	    	$this->published = $config->autopublishEntry;
	    	$this->approved = $config->autopublishEntry;
    	}

    	$this->archived = 0;
    	$this->checked_out = 0;
    	$this->ip = $_SERVER["REMOTE_ADDR"];

    	$this->getFieldsNames();
    	$this->getFieldsData();
    	$this->getExistingCats();
    	$this->getSelectedCats();

    	/*
    	 * set created and expiration date
    	 */
    	$this->publish_up = $config->getTimeAndDate();

    	$expField = $config->key( 'edit_form', 'exp_field' );
    	if( $expField &&  isset( $this->fieldsData[$expField] ) && !empty($this->fieldsData[$expField]) ) {
    		$this->publish_down = $this->fieldsData[$expField];
    		if( $config->key( 'edit_form', 'revert_exp_date' ) ) {
    			$this->publish_down = str_replace( '.', '-', $this->publish_down );
    			$this->publish_down = explode( '-', $this->publish_down );
    			$this->publish_down = array_reverse( $this->publish_down );
    			$this->publish_down = implode( '-', $this->publish_down );
    		}
    	}
    	elseif( $config->entryExpirationTime && $config->entryExpirationTime != null && $config->entryExpirationTime != 0 ) {
    		$this->publish_down = $config->getTimeAndDate( $config->entryExpirationTime );
    	}
    	else {
    		$this->publish_down = $config->nullDate;
    	}

    	if( $config->useMeta ) {
    		if( $config->key( 'edit_form', 'show_meta_keys', true ) ) {
    			$this->metakey  = $config->clearSQLinjection( sobi2Config::request( $_POST, 'sobi2MetaKey', '' ) );
    		}
    		if( $config->key( 'edit_form', 'show_meta_desc', true ) ) {
    			$this->metadesc = $config->clearSQLinjection( sobi2Config::request( $_POST, 'sobi2Metadesc', '' ) );
    		}
    	}

    	$this->params = $config->arrToIni( $this->params );
    	$database->setQuery( 'START TRANSACTION;' );
		$database->query();
		if ( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    	/*
    	 * save the item in database
    	 */
    	$statement = 'INSERT INTO `#__sobi2_item`(`title`, `hits`, `published`, `approved`, `confirm`, `archived`,`publish_up`,`publish_down`,`checked_out`,`ordering`,`owner`, `background`, `ip`, `metakey`, `metadesc`, `params`)' .
    			"VALUES ( " .
    			"'{$this->title}', 0, " .
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
    			"'{$this->metadesc}', '{$this->params}' );";
    	$database->setQuery($statement);
    	$database->query();
		if( $database->getErrorNum() ) {
			trigger_error( 'sobi2::saveSobi(): DB reports: '.$database->stderr(), E_USER_WARNING );
	    	$database->setQuery( "COMMIT;" );
			$database->query();
			if ( $database->getErrorNum() ) {
				trigger_error( 'sobi2::saveSobi(): DB reports: '.$database->stderr(), E_USER_WARNING );
			}
			sobi2Config::redirect( 'index.php', 'Unknown error, please inform the administrator');
		}
    	$this->id = $database->insertid();
    	$database->setQuery( 'COMMIT;' );
		$database->query();
		if ( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    	if( $this->id ) {
	    	/*
	    	 * image file upload handling
	    	 */
	    	if( isset( $_FILES['sobi2Img']) && is_array($_FILES['sobi2Img']) && $config->allowUsingImg ) {
	    		$success = true;
	    		$msgAfterSave = $msgAfterSave.$this->getImage($_FILES['sobi2Img'], 'img', $success );
	    		if( $config->allowUsingImg == 2 && $success ) {
	    			$this->fees = $this->fees + array(_SOBI2_SAVE_IMAGE_FEES => $config->priceForImg);
	    		}
	    	}
	    	/*
	    	 * icon file upload handling
	    	 */
	    	if(isset( $_FILES['sobi2Ico']) && is_array($_FILES['sobi2Ico']) && $config->allowUsingIco ) {
	    		$success = true;
	    		$msgAfterSave = $msgAfterSave.$this->getImage($_FILES['sobi2Ico'], 'ico', $success );
	    		if( $config->allowUsingIco == 2 && $success ) {
	    			$this->fees = $this->fees + array(_SOBI2_SAVE_ICON_FEES => $config->priceForIco);
	    		}
	    	}
	    	if(isset($_FILES['sobi2Img']) || isset($_FILES['sobi2Ico'])) {
		    	$statement = '' .
		    			"UPDATE `#__sobi2_item` SET `title` = '{$this->title}'," .
		    			"`icon` = '{$this->icon}', " .
		    			"`image` = '{$this->image}', " .
		    			"`last_update` = '{$config->nullDate}', " .
		    			"`updating_user` = '{$my->id}', " .
		    			"`updating_ip` = '{$this->ip}' WHERE `itemid` = {$this->id} LIMIT 1 ;";
		    	$database->setQuery($statement);
		    	$database->query();
				if ($database->getErrorNum()) {
					trigger_error('sobi2::saveSobi(): DB reports: '.$database->stderr(), E_USER_WARNING);
				}

	    	}
	    	/*
	    	 * now save the fields data
	    	 */
	    	foreach( $this->fieldsData as $fieldid => $value ) {
	    		if(is_array($value) && !empty($value)) {
	    			$v = array();
	    			foreach ( $value as $opt ) {
	    				$opt = addslashes( $opt );
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
	    			$database->setQuery( $statement );
	    			$database->query();
					if ($database->getErrorNum()) {
						trigger_error("sobi2::saveSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
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
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$order++;
	    		$statement = "INSERT INTO `#__sobi2_cat_items_relations` (`catid`, `itemid`, `ordering`)" .
	    					 "VALUES ({$catid},{$this->id}, {$order})";
	    		$database->setQuery($statement);
	    		$database->query();
				if ($database->getErrorNum()) {
					trigger_error("sobi2::saveSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$cache =& $config->sobiCache;
				$cache->recountCats( $cids );
	    	}
	    	if( array_sum( $config->catPrices) > 0 ) {
	    		for($i = 0; $i < sizeof($this->selectedCats); $i++) {
	    			$cat = $i + 1;
	    			if(isset($config->catPrices[$cat]) && $config->catPrices[$cat] != 0)
	    				$this->fees = $this->fees + array(_SOBI2_CATEGORY_H." {$cat}" => $config->catPrices[$cat]);
	    		}
	    	}
	    	/*
	    	 * plugins data
	    	 */
			$plugins["fees"] =& $this->fees;
			$plugins['msg'] =& $msgAfterSave;
	    	if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
    				if(method_exists($plugin, "save")) {
    					$plugin->save( $plugins ,$this->id);
	    			}
	    		}
	    	}
	    	if($config->notifyAdmins || $config->notifyAuthorNew) {
	    		$config->getEmails();
	    	}
	    	if($config->notifyAdmins) {
				$query = "SELECT email, name"
					. "\n FROM #__users"
					. "\n WHERE gid IN ({$config->mailAdmGid})"
					. "\n AND ( sendemail = 1 OR gid IN (18, 19, 20, 21, 23) )"
					;
				$database->setQuery( $query );
				$adminRows = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("sobi2::saveSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$emailTitle = $this->replaceMarkers($config->AdmEmailOnSubmitTitle);
				$mailMsg = $this->replaceMarkers($config->AdmEmailOnSubmitText);
	    		$mailMsg .= $config->mailFooter;
				foreach( $adminRows as $adminRow ) {
					sobi2bridge::mail( $adminRow->email, $adminRow->name, $adminRow->email, $config->makeSubject( $emailTitle ), $mailMsg );
				}
	    	}
	    	if( $config->notifyAuthorNew ) {
				if ($config->mailfrom != '' && $config->fromname != '') {
					$adminEmail2 	= $config->mailfrom;
					$adminName2 	= $config->fromname;
				} else {
				// use email address and name of first superadmin for use in email sent to user
					$query = "SELECT name, email"
					. "\n FROM #__users"
					. "\n WHERE LOWER( usertype ) = 'superadministrator'"
					. "\n OR LOWER( usertype ) = 'super administrator'"
					;
					$database->setQuery( $query );
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$rows 			= $database->loadObjectList();
					$row2 			= $rows[0];
					$adminName2 	= $row2->name;
					$adminEmail2 	= $row2->email;
				}

				if($config->mailSoJ == 0) {
					$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$this->id}";
					$database->setQuery( $query );
					$email = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else {
					$u =& sobi2bridge::jUser( $database );
					$u->load( $this->owner );
					$email = $u->email;
				}
				$emailTitle = $this->replaceMarkers($config->UserEmailOnSubmitTitle);
				$mailMsg = $this->replaceMarkers($config->UserEmailOnSubmitText);
	    		$mailMsg .= $config->mailFooter;
				if( !$email ) {
					if(! isset( $u ) || !$u ) {
						$u =& sobi2bridge::jUser( $database );
						$u->load( $this->owner );
					}
					trigger_error("sobi2::saveSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
					$email = $adminEmail2;
					$mailMsg = "EMAIL ERROR: \n\nsobi2::saveSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}) \n\n =================================== \n\n".$mailMsg;
				}
	    		sobi2bridge::mail($adminEmail2, $adminName2, $email, $config->makeSubject( $emailTitle ), $mailMsg);
	    	}
		}
		else {
			trigger_error( "sobi2::saveSobi(): Have not id of last inserted etry.", E_USER_WARNING );
			sobi2Config::redirect( "index.php", "Missing ID, please inform the administrator");
		}
    	/*
    	 * case using security code we have to destroy the session
    	 */
    	if( $config->useSecurityCode ) {
    		session_destroy();
    	}
    	$msgAfterSave = "<p class='sobi2msg'>{$msgAfterSave}<p>";
    	return $msgAfterSave;
    }
    /**
     * updating existing entry after editing
     * @return string
     */
    function updateSobi()
    {

    	$config =& sobi2Config::getInstance();
		$my = &$config->getUser();
		$database = &$config->getDb();
    	$config->getEditForm();
		$cids = array();
    	if( $config->useSecurityCode ) {
    		$this->checkSeccode();
    	}
    	$msgAfterUpdate = null;
    	/*
    	 * check if user is the owner
    	 */
    	if( ( $my->id == $this->owner && $config->allowUserToEditEntry ) || $config->checkPerm() ) {
	    	$this->title = $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'field_entry_name', null, 0x0002 ) );
	    	$this->title = $this->cleanInput( $this->title );
	    	$this->getFieldsNames();
	    	$this->getFieldsData();
	    	$this->getExistingCats();
	    	$this->getSelectedCats();
	    	if( $config->allowUsingBackground ) {
	    		$this->background = sobi2Config::request($_REQUEST, 'backgroundimage', '');
	    	}
	    	if( $config->useMeta ) {
	    		if( $config->key( "edit_form", "show_meta_keys", true ) ) {
	    			$this->metakey  = $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'sobi2MetaKey', null ) );
	    		}
	    		if( $config->key( "edit_form", "show_meta_desc", true ) ) {
	    			$this->metadesc = $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'sobi2Metadesc', null ) );
	    		}
	    	}
	    	$now = $config->getTimeAndDate();
	    	$this->updatingIp = $_SERVER["REMOTE_ADDR"];
 			$imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );
	    	/*
	    	 * image file upload handling
	    	 */
	    	if( intval( sobi2Config::request( $_REQUEST, 'sobi2ImgDelete', 0 ) ) ){
				if( $this->image != $config->key( "frontpage", "default_img" ) ) {
	    			@unlink( _SOBI_CMSROOT.$imagesFolder.$this->image );
				}
				$this->image = null;
	    	}
	    	else if( isset( $_FILES["sobi2Img"] ) && is_array( $_FILES["sobi2Img"] ) && $config->allowUsingImg ) {
	    		$success = true;
	    		$msgAfterUpdate = $msgAfterUpdate.$this->getImage( $_FILES["sobi2Img"], "img", $success );
	    		if( strlen( $this->image ) == 0 && $config->allowUsingImg == 2 ) {
	    			$this->fees = $this->fees + array( _SOBI2_SAVE_IMAGE_FEES => $config->priceForImg );
	    		}
	    	}
	    	/*
	    	 * icon file upload handling
	    	 */
	       	if( intval(sobi2Config::request( $_REQUEST, 'sobi2IcoDelete', 0 ) ) ){
				if( $this->icon != $config->key( "frontpage", "default_ico" ) ) {
	       			@unlink( _SOBI_CMSROOT.$imagesFolder.$this->icon );
				}
				$this->icon = null;
	    	}
	    	else if( isset( $_FILES["sobi2Ico"] ) && is_array( $_FILES["sobi2Ico"] ) && $config->allowUsingIco ) {
	    		$success = true;
	    		$msgAfterUpdate = $msgAfterUpdate.$this->getImage( $_FILES["sobi2Ico"], "ico", $success );
	    		if( strlen( $this->icon ) == 0 && $config->allowUsingIco == 2 ) {
	    			$this->fees = $this->fees + array( _SOBI2_SAVE_ICON_FEES => $config->priceForIco );
	    		}
	    	}
	    	$expField = $config->key( "edit_form", "exp_field" );
	    	if( $expField && isset( $this->fieldsData[$expField] ) && !empty( $this->fieldsData[$expField] ) ) {
	    		$this->publish_down = $this->fieldsData[$expField];
	    		if( $config->key( "edit_form", "revert_exp_date" ) ) {
	    			$this->publish_down = str_replace( ".", "-", $this->publish_down );
	    			$this->publish_down = explode( "-", $this->publish_down );
	    			$this->publish_down = array_reverse( $this->publish_down );
	    			$this->publish_down = implode( "-", $this->publish_down );
	    		}
	    		$pdown = " `publish_down` = '{$this->publish_down}', ";
	    	}
	    	else {
				$pdown = null;
	    	}
	    	$publishedField = $config->key( "edit_form", "published_field" );
	    	if( $publishedField &&  isset( $this->fieldsData[$publishedField] ) ) {
	    		$this->published = $this->fieldsData[$publishedField];
	    		$this->approved = $this->fieldsData[$publishedField];
	    	}
	    	else {
		    	$this->published = $config->key( "edit_form", "autopublish_changes", true );
		    	$this->approved = $config->key( "edit_form", "autoapprove_changes", true );
	    	}

	    	$uuser = $my->id;
	    	if( !$uuser ) {
				$cuid = sobi2Config::request( $_REQUEST, 'cuid', null );
				$uid = sobi2Config::request( $_REQUEST, 'uid', null );
				$ruid = md5( $config->secret.$uid );
				if( $cuid === $ruid ) {
					$uuser = $uid;
				}
	    	}
	    	$this->params = $config->arrToIni( $this->params );
	    	/*
	    	 * updating basic information
	    	 */
	    	$statement = "" .
	    			"UPDATE `#__sobi2_item` SET `title` = '{$this->title}', {$pdown}" .
	    			"`icon` = '{$this->icon}', " .
	    			"`image` = '{$this->image}', " .
	    			"`last_update` = '{$now}', " .
	    			"`updating_user` = '{$uuser}', " .
	    			"`background` = '{$this->background}', " .
	    			"`published` = '{$this->published}', " .
	    			"`approved` = '{$this->approved}', " .
	    			"`metakey` = '{$this->metakey}', " .
	    			"`metadesc` = '{$this->metadesc}', ".
	    			"`params` = '{$this->params}', " .
	    			"`updating_ip` = '{$this->updatingIp}' WHERE `itemid` = {$this->id} LIMIT 1 ;";
	    	$database->setQuery($statement);
	    	$database->query();
			if ( $database->getErrorNum() ) {
				trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	    	/*
	    	 * updating fields data
	    	 */
	    	foreach( $this->fieldsData as $fieldid => $value ) {
	    		/*
	    		 * check if updating or inserting new
	    		 */
	    		if( is_array( $value ) && !empty( $value ) ) {
	    			$statement = "DELETE FROM `#__sobi2_fields_data` WHERE `fieldid` = {$fieldid} AND `itemid` = {$this->id};";
		    		$database->setQuery( $statement );
		    		$database->query();
					if ( $database->getErrorNum() ) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    			$v = array();
	    			foreach ( $value as $opt ) {
	    				$opt = addslashes( $opt );
	    				$v[] = " ( '{$fieldid}', '{$opt}', NULL , '{$this->id}', NULL )";
	    			}
	    			$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `data_bool` , `itemid` , `expiration` ) VALUES " .  implode(" , ", $v) .";";
		    		$database->setQuery( $statement );
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    		else {
		    		$query = "SELECT COUNT(*) FROM `#__sobi2_fields_data` WHERE (`itemid` = {$this->id} AND `fieldid` = {$fieldid})";
		    		$database->setQuery( $query );
		    		$update = $database->loadResult();
					if ( $database->getErrorNum() ) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
		    		if( $update ) {
		    			$statement = "UPDATE `#__sobi2_fields_data` SET `data_txt` = '{$value}' WHERE (`itemid` = {$this->id} AND `fieldid` = $fieldid) LIMIT 1 ";
		    		}
		    		 else {
		    			$statement = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `itemid` ) " .
		    				"VALUES ( '{$fieldid}', '{$value}', '{$this->id}' );";
		    		 }
		    		$database->setQuery( $statement );
		    		$database->query();
					if ( $database->getErrorNum() ) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    	}
    		/*
    		 * check how many cats contains this item. Necessary only if one of categories is not free
    		 */
	    	if( ( $config->catPrices[2] + $config->catPrices[3] + $config->catPrices[4] + $config->catPrices[5] ) > 0 ) {
		    	if( sizeof( $this->selectedCats ) > sizeof( $this->myCategories ) ) {
		    		$newCats = sizeof( $this->selectedCats );
		    		for($i = sizeof($this->myCategories); $i < $newCats; $i++) {
		    			$cat = $i + 1;
		    			if( isset( $config->catPrices[$cat] ) && $config->catPrices[$cat] != 0 ) {
		    				$this->fees = $this->fees + array( _SOBI2_CATEGORY_H." {$cat}" => $config->catPrices[$cat] );
		    			}
		    		}
		    	}
	    	}
	    	/*
	    	 * get all old relations
	    	 */
	    	$query = "SELECT `catid` FROM `#__sobi2_cat_items_relations` WHERE `itemid` = {$this->id}";
	    	$database->setQuery( $query );
	    	$oldRelations = $database->loadResultArray();
			if ( $database->getErrorNum() ) {
				trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$newRelations = array();
	    	/*
	    	 * inserting new categories
	    	 */
	    	foreach( $this->selectedCats as $catid => $category ) {
				$newRelations[] = $catid;
	    		if( !( in_array( $catid,$oldRelations ) ) ) {
		    		$query = "SELECT MAX(ordering) FROM `#__sobi2_cat_items_relations` WHERE `catid` = '{$catid}'";
					$database->setQuery( $query );
					$order = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$order++;
		    		$statement = "INSERT INTO `#__sobi2_cat_items_relations` (`catid`, `itemid`, `ordering`)" .
		    					 "VALUES ({$catid},{$this->id}, {$order})";
		    		$database->setQuery($statement);
		    		$database->query();
					if ( $database->getErrorNum() ) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
	    	}
	    	$cids = array_merge( $newRelations, $oldRelations );
	    	foreach ( $oldRelations as $oldRelation ) {
	    		if( !( in_array( $oldRelation,$newRelations ) ) && $oldRelation != 1 ) {
	    			$statement = "DELETE FROM `#__sobi2_cat_items_relations` WHERE `catid` = {$oldRelation} AND `itemid` = {$this->id}";
		    		$database->setQuery($statement);
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    	}
	    	$cache =& $config->sobiCache;
	    	$cache->recountCats( $cids );
			/*
			 * plugins data
			 */
			$plugins["fees"] =& $this->fees;
			$plugins['msg'] =& $msgAfterUpdate;
	    	if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
    				if(method_exists($plugin, "update")) {
    					$plugin->update( $plugins ,$this->id);
	    			}
	    		}
	    	}
	    	$this->checkInSobi();
	    	if( $config->notifyAdminChanges || $config->notifyAuthorChanges ) {
	    		$config->getEmails();
	    	}
	    	if($config->notifyAdminChanges) {
				$query = "SELECT email, name"
					. "\n FROM #__users"
					. "\n WHERE gid IN ({$config->mailAdmGid})"
					. "\n AND ( sendemail = 1 OR gid IN (18, 19, 20, 21, 23) )"
					;
				$database->setQuery( $query );
				$database->query();
				$adminRows = $database->loadObjectList();
				if ( $database->getErrorNum() ) {
					trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$emailTitle = $this->replaceMarkers( $config->AdmEmailOnUpdateTitle );
				$mailMsg = $this->replaceMarkers( $config->AdmEmailOnUpdateText );
				$mailMsg .= $config->mailFooter;
				foreach( $adminRows as $adminRow ) {
					sobi2bridge::mail( $adminRow->email, $adminRow->name, $adminRow->email, $config->makeSubject( $emailTitle ), $mailMsg );
				}
	    	}
	    	if( $config->notifyAuthorChanges ) {
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
					if ( $database->getErrorNum() ) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$row2 			= $rows[0];
					$adminName2 	= $row2->name;
					$adminEmail2 	= $row2->email;
				}
				if( $config->mailSoJ == 0 ) {
					$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$this->id}";
					$database->setQuery( $query );
					$email = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("sobi2::updateSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else {
					$u =& sobi2bridge::jUser( $database );
					$u->load( $this->owner );
					$email = $u->email;
				}
				$emailTitle = $this->replaceMarkers( $config->UserEmailOnUpdateTitle );
				$mailMsg = $this->replaceMarkers( $config->UserEmailOnUpdateText );
	    		$mailMsg .= $config->mailFooter;
				if( !$email ) {
					if( !isset( $u ) ) {
						$u =& sobi2bridge::jUser( $database );
						$u->load( $this->owner );
					}
					trigger_error("sobi2::updateSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
					$email = $adminEmail2;
					$mailMsg = "EMAIL ERROR: \n\nsobi2::updateSobi(): Having no valid email address for user {$u->name} (Id:{$this->owner}). Entry '{$this->title}' (id:{$this->id}) \n\n =================================== \n\n".$mailMsg;
				}
	    		sobi2bridge::mail($adminEmail2, $adminName2, $email, $config->makeSubject( $emailTitle ), $mailMsg);
	    	}

    	}
		else {
			sobi2Config::redirect( $config->key( "redirects", "update_sobi_no_perm", "index.php"), _SOBI2_NOT_AUTH);
		}
    	$msgAfterUpdate = "<p class='sobi2msg'>{$msgAfterUpdate}<p>";
    	$config->sobiCache->removeObj( $this->id );
    	return $msgAfterUpdate;
    }
    /**
     * unpublishing sobi entry
     * @param $catid integer - category to redirect to
     * @return string
     */
    function unpublishSobi( $catid )
    {
    	$config =& sobi2Config::getInstance();
		$my = &$config->getUser();
		$database = &$config->getDb();
    	$msgAfterUnpublish = null;

		if ($this->checked_out && $this->checked_out != $my->id && $this->checked_out_time > $this->checkOutTime) {
			sobi2Config::redirect( $config->key( "redirects", "unpublish_sobi_checked_out", sobi2Config::sef( 'index.php?option=com_sobi2&amp;catid='.$catid ) ), _SOBI2_LISTING_CHECKED_OUT );
		}
    	if(($my->id == $this->owner && $config->allowUserDelete ) || $config->checkPerm()) {
    		$now = $config->getTimeAndDate();
    		$this->updatingIp = $_SERVER["REMOTE_ADDR"];
    		$this->published = 0;
	    	$statement = "UPDATE `#__sobi2_item` SET `published` = '{$this->published}', ".
	    			"`last_update` = '{$now}', " .
	    			"`updating_user` = '{$my->id}', " .
	    			"`updating_ip` = '{$this->updatingIp}' WHERE `itemid` = {$this->id} LIMIT 1 ;";
    		$database->setQuery( $statement );
    		$database->query();
			if ($database->getErrorNum()) {
				trigger_error("sobi2::unpublishSobi(): Cannot unpublish entry {$this->id}. DB reports:".$database->stderr());
				$msgAfterUnpublish = _SOBI2_DEL_NOT_DELETED;
			}
    		else
    		{
    			$msgAfterUnpublish = _SOBI2_DEL_UNPUBLISHED;
		    	if(count($config->S2_plugins)) {
		    		foreach($config->S2_plugins as $plugin) {
		   				if(method_exists($plugin, "onUnpublish")) {
		    				$plugin->onUnpublish($this->id);
		   				}
		    		}
		    	}
    		}
    	}
 		else {
			sobi2Config::redirect( $config->key( "redirects", "unpublish_sobi_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
 		}
 		$config->sobiCache->removeObj( $this->id );
		$config->sobiCache->clearAll();
 		return $msgAfterUnpublish;
    }
    /**
     * deleting sobi entry
     *
     * @param int $catid
     * @return string
     */
    function deleteSobi( $catid )
    {
    	$config	=& sobi2Config::getInstance();
		$my = &$config->getUser();
		$database = &$config->getDb();
    	$msgAfterDelete = null;

		if ( $this->checked_out && $this->checked_out != $my->id && $this->checked_out_time > $config->checkOutTime ) {
			sobi2Config::redirect( $config->key( "redirects", "delete_sobi_checked_out", sobi2Config::sef( 'index.php?option=com_sobi2&amp;catid='.$catid ) ), _SOBI2_LISTING_CHECKED_OUT );
		}
    	if( ( $my->id == $this->owner && $config->allowUserDelete ) || $config->checkPerm() ) {
	    	$statement = "DELETE FROM `#__sobi2_item` WHERE `itemid` = {$this->id} LIMIT 1;";
    		$database->setQuery( $statement );
    		$database->query();
			if ( $database->getErrorNum() ) {
				trigger_error("sobi2::deleteSobi(): Cannot remove entry {$this->id}. DB reports:".$database->stderr());
				$msgAfterDelete = _SOBI2_DEL_NOT_DELETED;
			}
			else {
    			$msgAfterDelete = _SOBI2_DEL_DELETED;
				/* delete relations */
    			$statement = "DELETE FROM `#__sobi2_cat_items_relations` WHERE `itemid` = {$this->id} ;";
				$database->setQuery($statement);
				$database->query();
				if ( $database->getErrorNum() ) {
					trigger_error("sobi2::deleteSobi(): Cannot remove entry realtions {$this->id}. DB reports:".$database->stderr());
					$msgAfterDelete = _SOBI2_DEL_NOT_DELETED;
				}
				/* delete fields data */
    			$statement = "DELETE FROM `#__sobi2_fields_data` WHERE `itemid` = {$this->id} ;";
				$database->setQuery( $statement );
				$database->query();
				if ( $database->getErrorNum() ) {
					trigger_error("sobi2::deleteSobi(): Cannot remove fields data {$this->id}. DB reports:".$database->stderr());
					$msgAfterDelete = _SOBI2_DEL_NOT_DELETED;
				}
				$imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );
				if( $this->icon && $this->icon != $config->key( "frontpage", "default_ico" ) ) {
					@unlink(_SOBI_CMSROOT.$imagesFolder.$this->icon);
				}
				if( $this->image && $this->image != $config->key( "frontpage", "default_img" ) ) {
					@unlink(_SOBI_CMSROOT.$imagesFolder.$this->image);
				}
		    	if( count( $config->S2_plugins ) ) {
		    		foreach( $config->S2_plugins as $plugin ) {
		   				if( method_exists( $plugin, "onDelete" ) ) {
		    				$plugin->onDelete( $this->id );
		   				}
		    		}
		    	}
			}
    	}
 		else {
			sobi2Config::redirect( $config->key( "redirects", "delete_sobi_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
 		}
 		$config->sobiCache->removeObj( $this->id );
		$config->sobiCache->clearAll();
 		return $msgAfterDelete;
    }

    /*
     * check security code
     */
    /**
     * Enter description here...
     *
     */
    function checkSeccode()
    {
    	$seccodeok = false;
    	$seccode = intval(sobi2Config::request($_REQUEST, 'seccode', 0));
    	session_name('sobi2seccode');
	    session_start();
	    session_register('sobi2seccode');

    	if(isset($_SESSION['sobi2seccode']) && ($_SESSION['sobi2seccode'] != "") && ($_SESSION['sobi2seccode'] == $seccode)) {
    		$seccodeok = true;
    	}

		if( $seccodeok != true ) {
	    	$config =& sobi2Config::getInstance();
			if(!$this->id) {
				$href = "index.php?option=com_sobi2&sobi2Task=addNew&Itemid={$config->sobi2Itemid}";
			}
			else {
				$href = "index.php?option=com_sobi2&sobi2Task=editSobi&sobi2Id={$this->id}&Itemid={$config->sobi2Itemid}";
			}
			sobi2Config::redirect( $href, _SOBI2_SEC_CODE_WRONG );
			exit();
		}
    }
	/*
	 * getting fields names from database to know witch data we have to take from $_REQUEST
	 */
    /**
     * Enter description here...
     *
     */
    function getFieldsNames()
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$adm = $config->checkPerm() ? null : "AND displayed != 1";
    	$query = "SELECT `fieldid` FROM `#__sobi2_fields` WHERE `enabled` = 1 {$adm} ORDER BY position";
    	$database->setQuery( $query );
    	$fields = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("sobi2::getFieldsNames(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		sobi2Config::import("field.class");
    	foreach($fields as $field) {
    		$this->fields[$field->fieldid] = new sobiField($field->fieldid);
    	}
    }
    /*
     * getting data from $_REQUEST
     */
    /**
     * Enter description here...
     *
     */
    function getFieldsData()
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->allowAnonymous ) {
	    	$user =& $config->getUser();
	    	$userid = $user->id;
	    	if( !$userid ) {
				$cuid = sobi2Config::request( $_REQUEST, 'cuid', null );
				$uid = sobi2Config::request( $_REQUEST, 'uid', null );
				$ruid = md5( $config->secret.$uid );
				if( $cuid === $ruid ) {
					$userid = $uid;
				}
	    	}
	    	if( !$userid ) {
	    		trigger_error( "sobi2::getFieldsData(): Only registered user can add entry but user id is missing", E_USER_WARNING );
	    		sobi2Config::redirect( $config->key( "redirects", "sobidata_not_logged_user", "index.php"), _SOBI2_NOT_AUTH );
	    		exit();
	    	}
    	}
    	foreach( $this->fields as $field ) {
    		$data = null;
    		/*
    		 * if could be html
    		 */
    		if( $field->fieldType == 2 ) {
    			if( sobi2Config::request( $_REQUEST, $field->fieldname, null,0x0002 ) ) {
    				$data = sobi2Config::request( $_REQUEST, $field->fieldname, null, 0x0002 );
    				$this->markers[$field->fieldname] =  $config->clearSQLinjection( $data );
    				if( sizeof( $data ) && !$field->wysiwyg && !defined( "_SOBI2_ADMIN" ) ) {
	    				$data = strip_tags($data);
	    				$data = nl2br($data);
	    			}
    				$data = $this->cleanInput( $data );
    				$data =  $config->clearSQLinjection( $data );
    			}
    		}
    		elseif ( $field->fieldType == 6 ) {
    			if( sobi2Config::request( $_REQUEST, $field->fieldname, array() ) ) {
    				$data = sobi2Config::request( $_REQUEST, $field->fieldname, array() );
    				$fdata = array();
    				if( !isset( $this->myFields[$field->fieldname] ) || !is_array( $this->myFields[$field->fieldname]->definedValues ) ) {
    					$t = new sobiField( $field->fieldid );
    					$t->getListValues();
    					$this->myFields[$field->fieldname] =& $t;
    				}
    				foreach ( $this->myFields[$field->fieldname]->definedValues  as $k => $v ) {
    					if(  array_search( $k, $data ) !== false ) {
    						$fdata[] = $v;
    					}
    				}
    				$this->markers[$field->fieldname] = $config->getSobiStr( implode( ", ", $fdata ) );
    			}
    		}
    		/*
    		 * if simple text field
    		 */
    		elseif( $field->fieldType == 1 || $field->fieldType == 5 || $field->fieldType == 7 ) {
    			if( sobi2Config::request( $_REQUEST, $field->fieldname, null ) ) {
    				$data = sobi2Config::request( $_REQUEST, $field->fieldname, null );
    				$data = strip_tags( $data );
    				$data = $this->cleanInput( $data );
    				$data = $config->clearSQLinjection( $data );
    				if( $field->fieldType == 5  ) {
	    				if( !isset( $this->myFields[$field->fieldname] ) || !is_array( $this->myFields[$field->fieldname]->definedValues ) ) {
	    					$t = new sobiField( $field->fieldid );
	    					$t->getListValues();
	    					$this->myFields[$field->fieldname] =& $t;
	    				}
	    				$this->markers[$field->fieldname] = $this->myFields[$field->fieldname]->definedValues[$data] ;
    				}
    				else {
    					$this->markers[$field->fieldname] = $data;
    				}
    			}
    		}
    		/*
    		 * checkbox
    		 */
    		else if( $field->fieldType == 3 ) {
    			if( sobi2Config::request( $_REQUEST, $field->fieldname ) == 1 ) {
    				$data =  '1';
    			}
    			else {
    				$data =  '0';
    			}
    			$fdata = $data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
    			$this->markers[$field->fieldname] = $fdata;
    		}

    		/*
    		 * build 'field name <=> field data' array.
	   		 */
   			/*
   			 * check if was required and is empty
   			 */
   			if( $field->is_required && ( $data == '' || !$data || $data == null ) && ( !$field->wysiwyg || $field->fieldType != 2 )) {
				if( $config->debug ) {
					echo "<p>missing: {$field->fieldname} {$data}</p>";
					echo "<script> alert('"._SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED."'); history.back();</script>\n";
				}
				else {
					if( $this->id ) {
						sobi2Config::redirect("index.php?option=com_sobi2&sobi2Task=editSobi&sobi2Id={$this->id}&Itemid={$config->sobi2Itemid}", _SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED);
					}
					else {
						sobi2Config::redirect("index.php?option=com_sobi2&sobi2Task=addNew&Itemid={$config->sobi2Itemid}", _SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED);
					}
				}
				exit();
   			}

   			/* url processing */
			if( ( $field->isUrl == 1 || $field->isUrl == 3 || $field->isUrl == 4 ) && ( sizeof( $data ) > 0 ) ) {
				$data = $config->checkHTTP($data);
			}

			$this->fieldsData = $this->fieldsData + array( $field->fieldid => $data );
			if( is_array( $data ) ) {
				$this->markers = $this->markers + array( $field->fieldname => $config->getSobiStr( implode( ", ", $data ) ) );
			}
			else {
				$this->markers = $this->markers + array( $field->fieldname => $config->getSobiStr( $data) );
			}
  			if(sizeof( $data ) > 0) {
			    if ( ( $field->fieldType != 3 ) || ( $field->fieldType == 3 && $data == 1 ) ) {
			    	if( !$field->is_free && ( !isset($this->customFieldsData[$field->fieldname] ) || empty( $this->customFieldsData[$field->fieldname] ) ) ) {
			    		$this->fees = $this->fees + array( $field->label => $field->payment );
					}
				}
   			}
   			unset( $data );
    	}
    }
    /*
     * getting all available categories
     */
    /**
     * Enter description here...
     *
     */
    function getExistingCats()
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$database = &$config->getDb();
    	$query = "SELECT name, catid FROM `#__sobi2_categories`";
    	$database->setQuery( $query );
    	$this->existingCats = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("sobi2::getExistingCats(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}

    }
    /*
     * getting selected categories
     */
    /**
     * Enter description here...
     *
     */
    function getSelectedCats()
    {
    	$config =& sobi2Config::getInstance();
    	$catsSel = defined( '_SOBI2_ADMIN' ) ? 'cats_selection_adm' : 'cats_selection';
    	if( !$config->key( 'edit_form', $catsSel, true ) ) {
    		if( ( $f = $config->key( 'edit_form', 'save_callback_func', false ) ) && function_exists( $f ) ) {
    			$sobi2SlectedCats = call_user_func( $f );
    		}
    		else {
    			if( $config->key( 'edit_form', 'defcat', 2 ) ) {
    				$sobi2SlectedCats = explode( ',', $config->key( 'edit_form', 'defcat', 2 ) );
    			}
    			else {
    				$sobi2SlectedCats = array( 2 );
    			}
    		}
    		$sobi2SlectedCats[] = null;
    	}
    	else {
    		$sobi2SlectedCats = sobi2Config::request( $_REQUEST, 'sobi2SlectedCatsID', null, null );
    	}
    	/*
    	 * get selected cats form $_REQUEST
    	 */
    	if( count( $sobi2SlectedCats ) ) {
	    	foreach( $sobi2SlectedCats as $selectedCategory ) {
	    		/*
	    		 * now check if this category exist because we have to prevent saving data in not existing categories
	    		 */
	    		$c = false;
	    		foreach( $this->existingCats as $existingCat ) {
	    			if( $existingCat->catid == $selectedCategory ) {
	    				if( !$c ) {
	    					$c = true;
	    					$this->params[ 'def_cid' ] = $existingCat->catid;
	    				}
	    				$this->selectedCats = $this->selectedCats + array( $existingCat->catid => $config->getSobiStr( $existingCat->name ) );
	    			}
	    		}
		   	}
    	}
    	/*
    	 * if no one category selected
    	 */
    	else {
			if( $config->debug ) {
				echo "<h1>missing category</h1>";
			}
			$config->logSobiError( 'getSelectedCats(): missing category id' );
			echo "<script> alert('"._SOBI2_FORM_SELECT_CATEGORY."'); history.back();</script>\n";
			exit();
    	}
    }
    /**
     * @param string $data
     * @return string
     */
    function cleanInput( $data )
    {
    	$config =& sobi2Config::getInstance();
	    if(!$data) {
			return null;
	    }
		foreach( $config->disalowedtags as $tag ) {
			if ( eregi( "<[^>]*".$tag."*\"?[^>]*>", $data ) ) {
				$data = preg_replace( '/<'.$tag.'>([^>]*)<\/'.$tag.'>/i', '' , $data );
				$data = str_ireplace( "<{$tag}", '', $data );
				$data = str_ireplace( "< {$tag}", '', $data );
				trigger_error( "Not allowed tag ({$tag})in input. Entry number: {$this->id}. Tag has been removed", E_USER_WARNING );
			}
		}
		return $data;
    }
    /**
     * images handling
     * @param string $file - filename
     * @param string $scope - ident. if file is icon or logo image
     * @param bool $success
     * @return string
     */
    function getImage( $file, $scope, $success = null )
    {
    	$config =& sobi2Config::getInstance();
    	$imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );
		$config->sobiChmodRecursive(_SOBI_CMSROOT.$imagesFolder,0775);
		$fileExt = substr( $file['name'], -3 );
		/*
		 * check extension
		 */
		$allowedFile = 0;
		$msg = "";

		/*
		 * check if file is not to big
		 */
		if($file['size'] > ($config->maxFileSize * 1024)) {
			$Size = $file["size"]/1024;
			$Size = (int) $Size + 1;
			$success = false;
			return _SOBI2_SAVE_IMG_TO_BIG.$Size._SOBI2_EF_KB_FILE_SIZE._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE.". ";
		}
		/*
		 * check if file hat allowed extension
		 */
		foreach( $config->allowableFilesExt as $allowableExt )
			if (strcasecmp( $fileExt, $allowableExt ) == 0)
				$allowedFile = 1;
    	/*
    	 * case file has allowed extension
    	 */
    	if($allowedFile) {
			$filename = strtolower($this->id."_{$scope}.".$fileExt);
			if(@move_uploaded_file($file['tmp_name'], _SOBI_CMSROOT.$imagesFolder.$filename)){
				if($scope == "img") {
					$this->image = $this->resampleImage( $filename, $scope, $success );
					$msg = $msg._SOBI2_SAVE_UPLOAD_IMG_OK."&nbsp;<br/>";
				}
				else if($scope == "ico") {
					$this->icon = $this->resampleImage( $filename, $scope, $success );
					$msg = $msg._SOBI2_SAVE_UPLOAD_ICO_OK."&nbsp;<br/>";
				}
			}
			else {
				if($scope == "img") {
					$msg = $msg._SOBI2_SAVE_UPLOAD_IMG_FAILED."&nbsp;<br/>";
					$success = false;
				}
				else if($scope == "ico") {
					$msg = $msg._SOBI2_SAVE_UPLOAD_ICO_FAILED."&nbsp;<br/>";
					$success = false;
				}
			}
    	}
	    /*
		 * case this file has not allowed extension
		 */
		elseif($fileExt) {
			$success = false;
			$msg =  $msg._SOBI2_SAVE_NOT_ALLOWED_IMG_EXT;
		}
		$config->sobiChmodRecursive(_SOBI_CMSROOT.$config->imagesFolder,0775);
    	return $msg;
    }
    /**
     * @author Radek Suski
     * @author Claudio F. images with transparent color are processed in the right way.
     * resampling image to adjusted size
     * @param string $file - filename
     * @param string $scope - ident. if file is icon or logo image
     * @param bool $success
     * @return string
     */
    function resampleImage( $file, $scope, $success )
    {
    	$config =& sobi2Config::getInstance();
    	$imagesFolder = str_replace( array("\\", "\\\\", "/", "//" ), DS, $config->imagesFolder );
    	$config->sobiChmodRecursive(_SOBI_CMSROOT.$imagesFolder,0775);
    	$fileExt = substr( $file, -3 );
    	$file = _SOBI_CMSROOT.$imagesFolder.$file;

		if($scope == 'ico') {
			$width = $config->thumbWidth;
			$height = $config->thumbHeigth;
		}
		else {
			$width = $config->imgWidth;
			$height = $config->imgHeigth;
		}
		if($width == 0 || $height == 0) {
			trigger_error("resampleImage(): Invalid size value (w:{$width}, h:{$height} scope:{$scope})");
			$success = false;
			return false;
		}
    	/*
    	 * getting attributes
    	 */
    	list($width_orig, $height_orig, $imgType) = getimagesize($file);
		/* if not image */
		if(!$width_orig || !$height_orig || !$imgType) {
			trigger_error( "resampleImage(): Cannot get info about uploaded image. Probably file is not an image - removing", E_USER_WARNING );
			if(!unlink($file)) {
				trigger_error("resampleImage(): Cannot delete false image");
			}
		}

    	if($width_orig == 0 || $height_orig == 0) {
			trigger_error( "resampleImage(): Invalid size value from list of original image (w_o:{$width_orig}, h_o:{$height_orig} scope:{$scope})", E_USER_WARNING );
			$success = false;
			return false;
		}
		/*
		 * build new filename
		 */
		$filename = "{$this->id}_{$scope}.{$fileExt}";

    	$fperm = $config->key( "general", "images_permissions", 664 );
    	$fperm = "0{$fperm}";
    	if(($width_orig < $width) && ($height_orig < $height)) {
			if( ( strstr( strtolower( php_sapi_name() ), "cgi" ) && $config->key( "general", "change_images_perms" ) == 2 )  || $config->key( "general", "change_images_perms" ) == 1 ) {
				chmod( _SOBI_CMSROOT.$imagesFolder.$filename, octdec( $fperm ) );
			}
    		return $filename;
    	}
    	/*
    	 * case the image is NOT bigger as adjusted size
    	 */
    	$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		}
		else {
		   $height = $width/$ratio_orig;
		}

		if( (!function_exists('imagecreatetruecolor')) 	||
			(!function_exists('imagecreatefromgif')) 	||
			(!function_exists('imagecopyresampled'))	||
			(!function_exists('imagegif')) 				||
			(!function_exists('imagecreatefromgif')) 	||
			(!function_exists('imagecreatefromjpeg')) 	||
			(!function_exists('imagecreatefrompng'))
		) {
			trigger_error( "resampleImage(): Missing GD Libs", E_USER_WARNING );
			$success = false;
			return false;
		}

		switch( $imgType ) {
            case 1:
                $image = imagecreatefromgif($file);
            break;
            case 2:
                $image = imagecreatefromjpeg($file);
            break;
            case 3:
                $image = imagecreatefrompng($file);
            break;
            default:
                return false;
        }
        $image_p = imagecreatetruecolor( $width, $height );
        if ( ($imgType == 1) || ($imgType == 3) ) {
            $trnprt_indx = imagecolortransparent( $image );

            // If we have a specific transparent color
            if ( $trnprt_indx >= 0 ) {

                // Get the original image's transparent color's RGB values
                $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx    = imagecolorallocate($image_p, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_p, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image_p, $trnprt_indx);


            }
			// Always make a transparent background color for PNGs that don't have one allocated already
            elseif ( ($imgType == 1) || ($imgType == 3) ) {

                // Turn off transparency blending (temporarily)
                imagealphablending($image_p, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_p, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_p, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image_p, true);
            }
        }
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		if ($imgType == 1) {
			imagegif($image_p, _SOBI_CMSROOT.$imagesFolder.$filename);
		}

		if ($imgType == 2) {
			imagejpeg($image_p, _SOBI_CMSROOT.$imagesFolder.$filename, $config->key( "general", "jpeg_image_quality", 75 ));
		}
		if ($imgType == 3) {
			imagepng($image_p, _SOBI_CMSROOT.$imagesFolder.$filename, $config->key( "general", "png_image_compression", 0 ));
		}
		imagedestroy($image_p);
		imagedestroy($image);
		$config->sobiChmodRecursive( _SOBI_CMSROOT.$imagesFolder ,0775 );
		if( ( strstr( strtolower( php_sapi_name() ), "cgi" ) && $config->key( "general", "change_images_perms" ) == 2 )  || $config->key( "general", "change_images_perms" ) == 1 ) {
			chmod( _SOBI_CMSROOT.$imagesFolder.$filename, octdec( $fperm ) );
		}
		return $filename;
    }

    /**
     * checked out sobi entry when editing
     * @param $uid integer - id of user
     * @return void
     */
    function checkOutSobi( $uid )
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
    	$now = date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  );
    	$statement = "UPDATE `#__sobi2_item` SET `checked_out` = '{$uid}', `checked_out_time` = '{$now}' WHERE `itemid` = {$this->id}";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("sobi2::checkOutSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     * checked in an sobi entry after editing
     * @return void
     */
    function checkInSobi()
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
    	$statement = "UPDATE `#__sobi2_item` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `itemid` = {$this->id}";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("sobi2::checkInSobi(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     * displaying counter
     * @return void
     */
	function countVisit()
	{
    	$config =& sobi2Config::getInstance();
		if( $config->key( "details_view", "count_human_visit_only", true ) ) {
			$browser = sobi2Config::translateUserAgent();
			if( $browser["type"] != "normal") {
				return false;
			}
		}
    	$database = &$config->getDb();
		$statement = "UPDATE `#__sobi2_item` SET `hits` = hits + 1 WHERE `itemid` = {$this->id} LIMIT 1 ";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("sobi2::countVisit(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}
	}
    /**
     * replacing markers in emails
     *
     * @param unknown_type $string
     * @return unknown
     */
    function replaceMarkers( $string )
    {
    	$config	=& sobi2Config::getInstance();
		$database = &$config->getDb();
    	$linkDetails = "index.php?option=com_sobi2&sobi2Task=sobi2Details&sobi2Id={$this->id}&Itemid={$config->sobi2Itemid}";
    	$linkDetails = defined("_SOBI2_ADMIN") ? $config->liveSite."/".$linkDetails : sobi2Config::sef( $linkDetails );
    	if( !strstr( $linkDetails, "http" ) ) {
    		$linkDetails = $config->liveSite.$linkDetails;
    	}
    	$linkEdit = "{$config->liveSite}/index.php?option=com_sobi2&sobi2Task=editSobi&sobi2Id={$this->id}&Itemid={$config->sobi2Itemid}";
    	$string = str_replace( "{link_details}", $linkDetails, $string );
    	$string = str_replace( "{link_edit}", $linkEdit, $string );
    	$string = str_replace( "{title}", $this->title, $string );
    	$string = str_replace( "{id}", $this->id, $string );
    	$string = str_replace( "{expiration_date}", $this->publish_down, $string );

    	$owner =& sobi2bridge::jUser( $database );
    	$owner->load($this->owner);
    	$string = str_replace( "{user}", $owner->name, $string );

    	if( count( $this->markers ) ) {
	    	foreach( $this->markers as $name => $data ) {
	    		$string = str_replace( '{'.$name.'}', $data, $string );
	    	}
    	}
    	if( count( $config->S2_plugins ) ) {
    		foreach ($config->S2_plugins as $plugin ) {
   				if( method_exists($plugin, "replaceMarkers" ) ) {
    				$string = $plugin->replaceMarkers( $string );
   				}
    		}
    	}
    	$string = html_entity_decode( $string );
    	return $string;
    }
}
?>