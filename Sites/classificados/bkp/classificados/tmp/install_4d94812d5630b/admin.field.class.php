<?php
/**
* @version $Id: admin.field.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
sobi2Config::import("field.class");
class field extends sobiField {
	var $fieldid			= null;
	var $fieldname 			= null;
	var $fieldLabel 		= null;
	var $fieldType 			= null;
	var $wysiwyg 			= null;
	var $fieldDescription 	= null;
	var $explanation 		= null;
	var $is_free 			= null;
	var $payment 			= null;
	var $fieldChars 		= null;
	var $fieldRows 			= null;
	var $fieldColumns 		= null;
	var $preferred_size 	= null;
	var $CSSclass 			= null;
	var $enabled 			= null;
	var $isEditable 		= null;
	var $is_required 		= null;
	var $in_promoted 		= null;
	var $in_vcard 			= null;
	var $in_details 		= null;
	var $position 			= null;
	var $in_search 			= null;
	var $with_label 		= null;
	var $in_newline			= null;
	var $isUrl 				= null;
	var $checked_out 		= null;
	var $checked_out_time 	= null;
	var $displayed 			= null;
	var $description 		= null;
	var $customCode			= null;
	var $OptionValues 		= array();
	var $OptionNames		= array();

    /**
     * Enter description here...
     *
     * @param int $fieldId
     * @param string $lang
     * @return field
     */
    function field( $fieldId = 0, $lang = null )
    {
    	if( $fieldId != 0 ) {
    		$this->fieldid = $fieldId;
    		$this->getAttributs( $lang );
    	}
    }
    /**
     * Enter description here...
     *
     * @param string $lang
     */
    function getAttributs( $lang = null )
    {
		$config =& adminConfig::getInstance();
		$database = &$config->getDb();
    	if( !$lang ) {
    		$lang = $config->sobi2Language;
    	}
    	$field = null;
    	$query = "SELECT * FROM `#__sobi2_fields` AS field " .
    			"LEFT JOIN `#__sobi2_language` AS labels ON labels.fieldid = field.fieldid " .
    			"WHERE field.fieldid = '{$this->fieldid}' AND `sobi2Lang` = '{$lang}' AND sobi2Section != 'field_opt' LIMIT 1";
    	$database->setQuery( $query );
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$field = $database->loadObject();
		}
    	else {
    		$database->loadObject( $field );
    	}
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    	if( sizeof( $field ) == 0 ) {
	    	$query = "SELECT * FROM `#__sobi2_fields` AS field " .
	    			"LEFT JOIN `#__sobi2_language` AS labels ON labels.fieldid = field.fieldid " .
	    			"WHERE field.fieldid = '{$this->fieldid}' AND `sobi2Lang` = 'english' AND sobi2Section != 'field_opt' LIMIT 1";
	    	$database->setQuery( $query );
			if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
				$field = $database->loadObject();
			}
	    	else {
	    		$database->loadObject( $field );
	    	}
			if( $database->getErrorNum() ) {
				trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
			}
    	}
    	if( $field ) {
    		$this->fieldType 			= $field->fieldType;
    		$this->fieldname 			= $config->getSobiStr($field->langKey);
    		$this->fieldLabel 			= $config->getSobiStr($field->langValue);
    		$this->wysiwyg 				= $field->wysiwyg;
    		$this->is_free 				= $field->is_free;
    		$this->payment 				= $field->payment;
    		$this->fieldChars 			= $field->fieldChars;
    		$this->fieldRows 			= $field->fieldRows;
    		$this->fieldColumns 		= $field->fieldColumns;
    		$this->preferred_size 		= $field->preferred_size;
    		$this->CSSclass 			= $field->CSSclass;
    		$this->enabled 				= $field->enabled;
    		$this->isEditable 			= true;
    		$this->is_required 			= $field->is_required;
    		$this->in_promoted 			= $field->in_promoted;
    		$this->in_vcard 			= $field->in_vcard;
    		$this->in_details 			= $field->in_details;
    		$this->position 			= $field->position;
    		$this->in_search 			= $field->in_search;
    		$this->with_label 			= $field->with_label;
    		$this->in_newline 			= $field->in_newline;
    		$this->isUrl 				= $field->isUrl;
    		$this->checked_out 			= $field->checked_out;
    		$this->checked_out_time 	= $field->checked_out_time;
    		$this->displayed 			= $field->displayed;
    		$this->description			= $config->getSobiStr($field->description);
    		$this->customCode			= $field->fieldDescription;

			if( $this->fieldType == 5 || $this->fieldType == 6 ) {
				$this->definedValues = $this->getListValues( $lang );
				$this->sortValues = $this->wysiwyg;
				$this->wysiwyg = null;
			}
    		if( $this->fieldType == 5 ) {
				$this->selectLabel = $this->fieldChars;
				$this->fieldChars = null;
			}

    		switch( $this->fieldType ) {
     			case '7':
    				$this->fieldType = 'calendar';
    			break;
     			case '6':
    				$this->fieldType = 'checkbox group';
    			break;
    			case '5':
    				$this->fieldType = 'list';
    			break;
    			case '4':
    				$this->fieldType = 'custom';
    			break;
    			case '3':
    				$this->fieldType = 'checkbox';
    			break;
    			case '2':
    				$this->fieldType = 'textarea';
    			break;
    			default:
    			case '1':
    				$this->fieldType = 'inputbox';
    			break;

    		}
    	}

    }
    /**
     * Enter description here...
     *
     */
    function getDataFromRequest()
    {
			$config =& adminConfig::getInstance();
    		if( $this->isEditable || !$this->fieldid ) {
	    		$this->fieldType = sobi2Config::request( $_POST, 'field_type' );
    		}
    		switch( $this->fieldType ) {
    			case 'calendar':
    				$this->fieldType = '7';
    			break;
    			case 'checkbox group':
    				$this->fieldType = '6';
    			break;
    			case 'list':
    				$this->fieldType = '5';
    			break;
    			case 'custom':
    				$this->fieldType = '4';
    			break;
    			case 'checkbox':
    				$this->fieldType = '3';
    			break;
    			case 'textarea':
    				$this->fieldType = '2';
    			break;
    			default:
    			case 'inputbox':
    				$this->fieldType = '1';
    			break;

    		}

    		$this->fieldname = strval(sobi2Config::request( $_POST, 'field_name' ));
    		if( substr( $this->fieldname,0,6 ) != 'field_' ) {
    			$this->fieldname = 'field_'.$this->fieldname;
    		}
    		$this->fieldname = $config->cleanString( $this->fieldname );
    		$this->fieldname = str_replace( ' ', '_', $this->fieldname );
			$this->fieldname = strtolower( $this->fieldname );
			$this->isUrl 	 = intval( sobi2Config::request( $_POST, 'field_is_url' ) );

    		$this->fieldLabel 			= strval( $config->clearSQLinjection(sobi2Config::request( $_POST, 'field_label' ) ) );
    		$this->wysiwyg 				= intval( sobi2Config::request( $_POST, 'field_wysiwyg' ) );
    		$this->is_free 				= intval( sobi2Config::request( $_POST, 'field_free' ) );
    		$this->payment 				= strval( sobi2Config::request( $_POST, 'field_payment' ) );
    		$this->preferred_size 		= intval( sobi2Config::request( $_POST, 'field_preferred_size' ) );
    		$this->CSSclass 			= strval( sobi2Config::request( $_POST, 'field_css_class' ) );
    		$this->enabled 				= intval( sobi2Config::request( $_POST, 'field_enabled' ) );
    		$this->is_required 			= intval( sobi2Config::request( $_POST, 'field_required' ) );
    		$this->in_vcard 			= intval( sobi2Config::request( $_POST, 'field_in_vcard' ) );
    		$this->in_details 			= intval( sobi2Config::request( $_POST, 'field_in_details' ) );
    		$this->in_search 			= intval( sobi2Config::request( $_POST, 'field_in_search' ) );
    		$this->customCode			= $_POST['field_custom_code'];
    		$this->displayed 			= intval( sobi2Config::request( $_POST, 'field_displayed' ) );

    		if($this->in_search == _SOBI2_NO_U) {
    			$this->in_search = 0;
    		}
    		else if($this->in_search == _SOBI2_FIELD_SEARCH_SEARCH_IN) {
    			$this->in_search = 1;
    		}
    		else if($this->in_search == _SOBI2_FIELD_SEARCH_SELECT_BOX) {
    			$this->in_search = 2;
    		}

    		$this->with_label 			= intval(sobi2Config::request( $_POST, 'field_with_label' ));
    		$this->in_newline 			= intval(sobi2Config::request( $_POST, 'field_in_newline' ));
    		$this->description			= strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'field_description' )));
    		$this->payment				= str_replace(",",".",$this->payment);
    		$this->fieldChars 			= intval(sobi2Config::request( $_POST, 'field_maxlength' ));
    		$this->fieldRows 			= intval(sobi2Config::request( $_POST, 'field_rows' ));
    		$this->fieldColumns 		= intval(sobi2Config::request( $_POST, 'field_cols' ));
    		$this->OptionValues 		= isset( $_POST['listValueOptionValue'] ) 	? $_POST['listValueOptionValue'] 	: array();
	    	$this->OptionNames  		= isset( $_POST['listValueOptionName'] ) 	? $_POST['listValueOptionName'] 	: array();
    }
    /**
     * Enter description here...
     *
     * @return bool
     */
    function saveListValues()
    {
		if( $this->fieldType != 5 && $this->fieldType != 6 ) {
			return null;
		}
    	$config =& adminConfig::getInstance();
		$database = &$config->getDb();

		$options =& $this->OptionValues;
		$values =& $this->OptionNames;
		$this->definedValues = array();
    	$vals = array();

		$savecsv = intval( sobi2Config::request( $_POST, 'field_savecsv' ) );

		if( $savecsv || empty( $options ) ) {
			$csvValues = trim( $_POST['csvValues'] );
			$csv = explode(";", $csvValues );
			if( is_array( $csv ) && !empty( $csv ) ) {
				foreach ( $csv as  $opt ) {
					if( strstr( $opt, ":" ) ) {
						$val = explode( ":", $opt );
						$v = trim( $val[0] );
						$o = trim( $val[1] );
					}
					else {
						$v = trim( $opt );
						$o = trim( $opt );
					}
					if( strlen( $v ) && strlen( $o ) ) {
						$this->definedValues[$v] = $o;
					}
				}
			}
		}
		else {
			for( $c = 0; $c < count( $options ); $c++ ) {
	    		$this->definedValues[trim( $options[$c]) ] = $values[$c] ? trim( $values[$c] ) : trim( $options[$c] );
	    	}
		}
		if( empty( $this->definedValues ) ) {
			trigger_error("field::saveListValues(): values array is empty", E_USER_WARNING);
			return false;
		}

    	$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) ? sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) : $config->sobi2Language;

    	$query = "DELETE FROM #__sobi2_language WHERE sobi2Section = 'field_opt' AND fieldid = {$this->fieldid} AND sobi2Lang = '{$lang}'";
    	$database->setQuery( $query );
    	$database->query();
		if ( $database->getErrorNum() ) {
			trigger_error("field::saveField(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}

    	$c = 0;
    	foreach ( $this->definedValues as $value => $option ) {
    		$c++;
    		if( strstr( $value, "field_temp" ) ) {
    			$value = str_replace( "field_temp", $this->fieldname, $value );
    		}
    		$vals[] = "\n ( '{$value}', '{$option}', '{$c}', 'field_opt', '{$this->fieldid}', '{$lang}' )";
    	}
    	$vals = implode( " , \n", $vals );
    	$query = "INSERT INTO `#__sobi2_language` ( `langKey` , `langValue` , `description` , `sobi2Section` , `fieldid` , `sobi2Lang` ) \n".
				 "\n VALUES \n {$vals} ;";
		$database->setQuery( $query );
		$database->query();
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    }
    /**
     * Enter description here...
     *
     * @param string $lang
     * @return string
     */
    function updateField( $lang = null )
    {
		$config 	=& adminConfig::getInstance();
		$database 	=& $config->getDb();
    	if( !$lang ) {
    		$lang = $config->sobi2Language;
    	}
    	$msg = _SOBI2_CHANGES_SAVED;

    	$query = "SELECT COUNT(*) FROM  `#__sobi2_language` " .
    			 "WHERE `langKey` = '{$this->fieldname}' AND `fieldid` <> '{$this->fieldid}' AND sobi2Section = 'fields'";
		$database->setQuery( $query );
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}

		if($database->loadResult() != 0) {
			$this->fieldname = $this->fieldname."__TEMP_NAME__".rand(0, 1000000);
			$msg = _SOBI2_FIELD_NAME_DUPLICAT;
		}
		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onUpdateField")) {
					$plugin->onUpdateField( $this, $lang );
				}
			}
		}
//		$this->customCode 	= $database->getEscaped( $this->customCode );
		$this->fieldname 	= $database->getEscaped( $this->fieldname );
		$this->fieldLabel 	= $database->getEscaped( $this->fieldLabel );
		$this->description 	= $database->getEscaped( $this->description );
		$statement = "UPDATE `#__sobi2_fields` SET " .
    			"`fieldType` = '{$this->fieldType}', " .
    			"`wysiwyg` = '{$this->wysiwyg}', " .
    			"`is_free` = '{$this->is_free}', " .
    			"`payment` = '{$this->payment }', " .
    			"`fieldChars` = '{$this->fieldChars}', " .
    			"`fieldRows` = '{$this->fieldRows}', " .
    			"`fieldColumns` = '{$this->fieldColumns}', " .
    			"`preferred_size` = '{$this->preferred_size}', " .
    			"`CSSclass` = '{$this->CSSclass}', " .
    			"`enabled` = '{$this->enabled}', " .
    			"`is_required` = '{$this->is_required}', " .
    			"`in_vcard` = '{$this->in_vcard}', " .
    			"`in_details` = '{$this->in_details}', " .
    			"`in_search` = '{$this->in_search}', " .
    			"`with_label` = '{$this->with_label}', " .
    			"`in_newline` = '{$this->in_newline}', " .
    			"`fieldDescription` = '{$this->customCode}', " .
    			"`checked_out_time` = '0', " .
    			"`checked_out` = '0', " .
    			"`isUrl` = '{$this->isUrl}', `displayed` = {$this->displayed} " .
    			"WHERE `fieldid` = '{$this->fieldid}' LIMIT 1";
		$database->setQuery( $statement );
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
		if( $database->query() ) {
			$config->getEditForm();
			$query = "SELECT COUNT(*) FROM `#__sobi2_language` WHERE `fieldid` = '{$this->fieldid}' AND `sobi2Lang` = '{$lang}' LIMIT 1";
			$database->setQuery( $query );
			if($database->loadResult() != 0) {
				$statement = "UPDATE `#__sobi2_language` SET " .
						"`langKey` = '{$this->fieldname}', " .
						"`langValue` = '{$this->fieldLabel}'," .
						"`description` = '{$this->description}' " .
						"WHERE `fieldid` = '{$this->fieldid}' AND `sobi2Lang` = '{$lang}' LIMIT 1";
			}
			else {
				$statement = "INSERT INTO `#__sobi2_language` " .
						"( `langKey` , `langValue` , `description` , `fieldid` , `sobi2Lang` ) " .
						"VALUES " .
						"( '{$this->fieldname}', '{$this->fieldLabel}', '{$this->description}', '{$this->fieldid}', '{$lang}');";
			}

			$database->setQuery($statement);
			$database->query();
			if( $database->getErrorNum() ) {
				trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
			}
		}
		$this->saveListValues();
		return $msg;
    }
    /**
     * Enter description here...
     *
     * @param string $lang
     * @return array
     */
    function saveField( $lang = null )
    {
		$config	=& adminConfig::getInstance();
		$database = &$config->getDb();
    	$msg = null;
    	if( !$lang ) {
    		$lang = $config->sobi2Language;
    	}
    	$query = "SELECT COUNT(*) FROM  `#__sobi2_language` " .
    			 "WHERE `langKey` = '{$this->fieldname}'";
		$database->setQuery( $query );
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}

		if($database->loadResult() != 0) {
			$this->fieldname = $this->fieldname."__TEMP_NAME__".rand(0, 1000000);
			$msg = _SOBI2_FIELD_NAME_DUPLICAT;
		}
		$query = "SELECT MAX(position) FROM `#__sobi2_fields`";
		$database->setQuery( $query );
		$position = $database->loadResult();
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
		$position++;

		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onSaveField")) {
					$plugin->onSaveField( $this, $lang, $position );
				}
			}
		}

//		$this->customCode = $database->getEscaped( $this->customCode );
		$this->fieldname = $database->getEscaped( $this->fieldname );
		$this->fieldLabel = $database->getEscaped( $this->fieldLabel );
		$this->description = $database->getEscaped( $this->description );

    	$statement = "INSERT INTO `#__sobi2_fields` ( " .
    			"`fieldType` , " .
    			"`wysiwyg` , `fieldDescription`, " .
    			"`is_free` , `in_newline`, " .
    			"`payment` , `fieldChars` , " .
    			"`fieldRows` , `fieldColumns` , " .
    			"`preferred_size` , `CSSclass` , " .
    			"`enabled` , `isEditable` , " .
    			"`is_required` , `in_promoted` , " .
    			"`in_vcard` , `in_details` , " .
    			"`position` , `in_search` , " .
    			"`with_label` , `isUrl` , " .
    			"`checked_out` , `checked_out_time`, `displayed` " .
    			" ) VALUES " .
    			"( '{$this->fieldType}', " .
    			"'{$this->wysiwyg}', '{$this->customCode}', " .
    			"'{$this->is_free}', {$this->in_newline}, " .
    			"'{$this->payment}', '{$this->fieldChars}', " .
    			"'{$this->fieldRows}', '{$this->fieldColumns}', " .
    			"'{$this->preferred_size}', '{$this->CSSclass}', " .
    			"'{$this->enabled}', '1', " .
    			"'{$this->is_required}', '0', " .
    			"'{$this->in_vcard}', '{$this->in_details}', " .
    			"'{$position}', '{$this->in_search}', " .
    			"'{$this->with_label}', '{$this->isUrl}', " .
    			"'0', '0', {$this->displayed} );";
		$database->setQuery($statement);
		if( $database->query() ) {
			$this->fieldid = $database->insertid();
			$config->getEditForm();
			$query = "SELECT COUNT(*) FROM `#__sobi2_language` WHERE `fieldid` = '{$this->fieldid}' AND `sobi2Lang` = '{$lang}' LIMIT 1";
			$database->setQuery( $query );

			if($database->loadResult() != 0) {
				$statement = "UPDATE `#__sobi2_language` SET " .
						"`langKey` = '{$this->fieldname}', " .
						"`langValue` = '{$this->fieldLabel}'," .
						"`description` = '{$this->description}' " .
						"`sobi2Section` = 'fields' " .
						"WHERE `fieldid` = '{$this->fieldid}' AND `sobi2Lang` = '{$lang}' LIMIT 1";
			}
			else {
				$statement = "INSERT INTO `#__sobi2_language` " .
						"( `langKey` , `langValue` , `description` , `sobi2Section`,  `fieldid` , `sobi2Lang` ) " .
						"VALUES " .
						"( '{$this->fieldname}', '{$this->fieldLabel}', '{$this->description}', 'fields', '{$this->fieldid}', '{$lang}');";
			}

			$database->setQuery($statement);
			$database->query();
			if( $database->getErrorNum() ) {
				trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
			}
			/*
			 * we have to have every field also in englsih
			 */
			if($lang != 'english') {
				$statement = "INSERT INTO `#__sobi2_language` " .
						"( `langKey` , `langValue` , `description` , `fieldid` , `sobi2Lang` ) " .
						"VALUES " .
						"( '{$this->fieldname}', '{$this->fieldLabel}', '{$this->description}', '{$this->fieldid}', 'english');";
				$database->setQuery($statement);
				$database->query();
				if( $database->getErrorNum() ) {
					trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
				}
			}
			$this->saveListValues();
		}
		else {
			if( $database->getErrorNum() ) {
				trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
			}
			$msg = _SOBI2_SAVING_ERROR;
		}

    	return array( "id" => $this->fieldid, "msg" => $msg );
    }
    /**
     * Enter description here...
     *
     * @param string $lang
     */
    function editForm( $lang )
    {
    	sobi2Config::import("admin.field.class.html", "adm");
    	fieldHtml::editForm( $this, $lang );
    }
    /**
     * Enter description here...
     *
     */
    function checkOutField()
    {
		$config	=& adminConfig::getInstance();
		$database = &$config->getDb();
    	$my =& $config->getUser();
    	$uid = $my->id;
    	$now = date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  );
    	$statement = "UPDATE `#__sobi2_fields` SET `checked_out` = '{$uid}', `checked_out_time` = '{$now}' WHERE `fieldid` = {$this->fieldid}";
		$database->setQuery($statement);
		$database->query();
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    }
    /**
     * Enter description here...
     *
     */
    function checkInField()
    {
		$config	=& adminConfig::getInstance();
		$database = &$config->getDb();
    	$statement = "UPDATE `#__sobi2_fields` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `fieldid` = {$this->fieldid}";
		$database->setQuery($statement);
		$database->query();
		if( $database->getErrorNum() ) {
			trigger_error( 'DB reports: '.$database->stderr(), E_USER_WARNING );
		}
    }
}
class tempField extends field {
	var $published = null;
	var $id = null;
	var $checked_out = null;
	var $editor = null;
}
?>