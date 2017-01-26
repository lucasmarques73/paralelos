<?php
/**
* @version $Id: field.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class sobiField {
	/**
	 * @var int
	 */
	var $fieldType = null;
	/**
	 * @var bool
	 */
	var $wysiwyg = null;
	/**
	 * @var bool
	 */
	var $is_free = null;
	/**
	 * @var float
	 */
	var $payment = null;
	/**
	 * @var int
	 */
	var $fieldChars = null;
	/**
	 * @var int
	 */
	var $fieldRows = null;
	/**
	 * @var int
	 */
	var $fieldColumns = null;
	/**
	 * @var int
	 */
	var $preferred_size = null;
   	/**
   	 * @var string
   	 */
   	var $CSSclass = null;
   	/**
   	 * @var bool
   	 */
	var $is_required = null;
	/**
	 * @var int
	 */
	var $position = null;
   	/**
   	 * @var string
   	 */
	var $label = null;
   	/**
   	 * @var string
   	 */
	var $explanation = null;
   	/**
   	 * @var string
   	 */
	var $fieldname = null;
   	/**
   	 * @var string
   	 */
	var $data = null;
	/**
	 * @var bool
	 */
	var $isUrl = null;
	/**
	 * @var bool
	 */
	var $with_label = null;
	/**
	 * @var bool
	 */
	var $in_newline = null;
	/**
	 * @var int
	 */
	var $fieldid = null;
	/**
	 * @var string
	 */
	var $customCode = null;
   	/**
   	 * @var array
   	 */
	var $definedValues = array();
	/**
	 * @var bool
	 */
	var $sortValues = false;
	/**
	 * @var bool
	 */
	var $selectLabel = false;
   	/**
   	 * @var string
   	 */
	var $selected = null;
   	/**
   	 * @var array
   	 */
	var $selectedValues = array();
	/**
	 * @var bool
	 */
	var $data_bool = false;
	/**
	 * @var int
	 */
	var $data_int = 0;
	/**
	 * @var float
	 */
	var $data_float = 0;
	/**
	 * @var string
	 */
	var $data_char = null;
	/**
	 * constructor
	 *
	 * @param int $id
	 * @param int $itemid
	 * @return sobiField
	 */
	function sobiField($id, $itemid = null)
	{
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$this->fieldid = $id;
		/* if only fields definition */
		if(!$itemid) {
			$query = "SELECT  fieldType, wysiwyg, is_free,  payment,  fieldChars,  fieldRows,  fieldColumns,  preferred_size, isUrl,  " .
	    			 "CSSclass,  is_required,  position,  langValue as label,  description as explanation, langKey as fieldname,  fieldDescription as customCode " .
	    			 "FROM `#__sobi2_fields` AS sobifields " .
	    			 "LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid  " .
	    			 "WHERE `enabled` = 1 AND `sobi2Lang` = '{$config->sobi2Language}' AND sobifields.fieldid = '{$id}' AND labels.sobi2Section != 'field_opt' ";
			$database->setQuery( $query );
			$field = null;
			if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
				$field = $database->loadObject();
			}
	    	else {
	    		$database->loadObject( $field );
	    	}
			if ($database->getErrorNum()) {
				trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if(!$field) {
				$query = "SELECT  fieldType, wysiwyg, is_free,  payment,  fieldChars,  fieldRows,  fieldColumns,  preferred_size, isUrl,  " .
		    			 "CSSclass,  is_required,  position,  langValue as label,  description as explanation, langKey as fieldname, fieldDescription as customCode " .
		    			 "FROM `#__sobi2_fields` AS sobifields " .
		    			 "LEFT JOIN `#__sobi2_language` AS labels ON sobifields.fieldid = labels.fieldid  " .
		    			 "WHERE `enabled` = 1 AND `sobi2Lang` = 'english' AND sobifields.fieldid = '{$id}' AND labels.sobi2Section != 'field_opt' ";
				$database->setQuery( $query );
				if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
					$field = $database->loadObject();
				}
		    	else {
		    		$database->loadObject( $field );
		    	}
				if ($database->getErrorNum()) {
					trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			if($field) {
				$this->fieldType = $field->fieldType;
				$this->wysiwyg = $field->wysiwyg;
				$this->is_free = $field->is_free;
				$this->payment = $field->payment;
				$this->fieldChars = $field->fieldChars;
				$this->fieldRows = $field->fieldRows;
				$this->fieldColumns = $field->fieldColumns;
				$this->preferred_size = $field->preferred_size;
			    $this->CSSclass = $field->CSSclass;
				$this->is_required = $field->is_required;
				$this->position = $field->position;
				$this->label = $config->getSobiStr($field->label);
				$this->explanation = $field->explanation;
				$this->fieldname = $field->fieldname;
				$this->isUrl = $field->isUrl;
				$this->customCode = $field->customCode;
				if($this->fieldType == 5 || $this->fieldType == 6) {
					$this->sortValues = $this->wysiwyg;
					$this->selectLabel = $this->fieldChars;
					$this->wysiwyg = null;
					$this->fieldChars = null;
				}
				if($this->fieldType == 5 || $this->fieldType == 6) {
					$this->getListValues();
				}
			}
		}
		/* if fields data too */
		else {
			if( $itemid ) {
				/* try in the right language */
				$query = "SELECT fdata.data_txt as data, fdata.data_bool, fdata.data_int, fdata.data_float, fdata.data_char, labels.langValue as label, labels.langKey as name, fieldRows,  fieldColumns, " .
						 "isUrl, with_label, in_newline, fieldType, position " .
						 "FROM `#__sobi2_fields_data` AS fdata " .
						 "LEFT JOIN `#__sobi2_fields` AS sfield ON fdata.fieldid = sfield.fieldid " .
						 "LEFT JOIN `#__sobi2_language` AS labels ON sfield.fieldid = labels.fieldid " .
						 "WHERE (fdata.itemid = {$itemid} " .
						 "AND `sobi2Lang` = '{$config->sobi2Language}' " .
						 "AND sfield.fieldid = '{$id}')  AND labels.sobi2Section != 'field_opt' ";
				$fieldData = null;
				$database->setQuery( $query );
				if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
					$fieldData = $database->loadObject();
				}
		    	else {
		    		$database->loadObject( $fieldData );
		    	}
				if ($database->getErrorNum()) {
					trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				/* if no result get in english */
				if(!$fieldData) {
					$query = "SELECT fdata.data_txt as data,  fdata.data_bool, fdata.data_int, fdata.data_float, fdata.data_char, labels.langValue as label, labels.langKey as name, fieldRows,  fieldColumns, " .
							 "isUrl, with_label, in_newline, fieldType " .
							 "FROM `#__sobi2_fields_data` AS fdata " .
							 "LEFT JOIN `#__sobi2_fields` AS sfield ON fdata.fieldid = sfield.fieldid " .
							 "LEFT JOIN `#__sobi2_language` AS labels ON sfield.fieldid = labels.fieldid " .
							 "WHERE (fdata.itemid = {$itemid} " .
							 "AND `sobi2Lang` = 'english' " .
							 "AND sfield.fieldid = '{$id}')  AND labels.sobi2Section != 'field_opt' ";
					$database->setQuery( $query );
					if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
						$fieldData = $database->loadObject();
					}
			    	else {
			    		$database->loadObject( $fieldData );
			    	}
					if ($database->getErrorNum()) {
						trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				if($fieldData && !(is_integer($fieldData))) {
					$this->fieldType 	= $fieldData->fieldType;
					$this->label 		= $fieldData->label;
					$this->fieldname 	= $fieldData->name;
					$this->data 		= $fieldData->data;
					$this->data_bool 	= $fieldData->data_bool;
					$this->data_int 	= $fieldData->data_int;
					$this->data_float 	= $fieldData->data_float;
					$this->data_char 	= $fieldData->data_char;
					$this->isUrl 		= $fieldData->isUrl;
					$this->with_label 	= $fieldData->with_label;
					$this->in_newline 	= $fieldData->in_newline;
					$this->fieldRows 	= $fieldData->fieldRows;
					$this->fieldColumns = $fieldData->fieldColumns;
					$task 				= sobi2Config::request( $_REQUEST, 'sobi2Task', null );
					if( $this->isUrl == 4 && $task != 'editSobi' && !defined( '_SOBI2_ADMIN' ) ) {
						if( isset( $this->data ) && !empty( $this->data ) ) {
							$this->customCode = $this->showMediaData( $itemid, $this->fieldname );
						}
					}
				}
				/* there was no data - we need the field definitions only */
				else {
					/* in the right language */
					$query = "SELECT langKey as fieldname, langValue as fieldlabel FROM `#__sobi2_language` WHERE `fieldid` = '{$id}' AND `sobi2Lang` = '{$config->sobi2Language}' AND sobi2Section != 'field_opt'";
					$database->setQuery( $query );
					$field = null;
					if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
						$field = $database->loadObject();
					}
			    	else {
			    		$database->loadObject( $field );
			    	}
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					/* if not in english */
					if( !$field ) {
						$query = "SELECT langKey as fieldname, langValue as fieldlabel FROM `#__sobi2_language` WHERE `fieldid` = '{$id}' AND sobi2Section != 'field_opt'";
						$database->setQuery( $query );
						$field = null;
						if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
							$field = $database->loadObject();
						}
				    	else {
				    		$database->loadObject( $field );
				    	}
						if ($database->getErrorNum()) {
							trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
						}
					}
					$this->fieldname = $field->fieldname;
					$this->label = $field->fieldlabel;
					if ($database->getErrorNum()) {
						trigger_error("sobiField::sobiField(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				if($this->fieldType == 5 || $this->fieldType == 6) {
					$this->getListValues();
					$this->sortValues = $this->wysiwyg;
					$this->wysiwyg = null;
				}
				if($this->fieldType == 6) {
					$this->getSelectedValues($itemid);
				}
				if($this->fieldType == 5) {
					$this->sortValues = $this->wysiwyg;
					$this->selectLabel = $this->fieldChars;
					$this->wysiwyg = null;
					$this->fieldChars = null;
					$this->selected = $this->data;
					$this->data = isset($this->definedValues[$this->data]) ? $this->definedValues[$this->data] : null;
				}
			}
		}
	}
	/**
	 * Saving the quick data field edition
	 *
	 * @param int $sid
	 * @param int $fid
	 * @param mixed $value
	 */
	function saveQuickEdit( $sid, $fid, $value )
	{
		$config =& sobi2Config::getInstance();
		$user =& $config->getUser();
		$database =& $config->getDb();
		sobi2Config::import("sobi2.class");
		$sobi = new sobi2( $sid );
		if( ( ( ($user->id && $user->id == $sobi->owner && $config->allowUserToEditEntry ) || $config->checkPerm() ) && $config->allowQuickEdit == 1 ) || ( $config->checkPerm() && $config->allowQuickEdit == 2 ) ) {
			$field = new sobiField( $fid );
			$fieldData = new sobiField( $fid, $sid );
			if( $field->fieldType == 2 ) {
				$value = sobi2Config::request( $_REQUEST, "value", null, 0x0002 );
			}
			if( $field->fieldType != 6 ) {
				$value = urldecode( $value );
				$value = $config->stringDecode( $value );
				$value = $config->clearSQLinjection( $value );
			}
			if( !$value && $field->fieldType != 6 ) {
				$value = _JS_SOBI2_QFIELD_NO_VALUE;
				header( "Content-Type: application/x-javascript; "._ISO );
				if($fieldData->with_label) {
					$field->label = $config->getSobiStr( $field->label );
					echo "<span id=\"sobi2Listing_{$field->fieldname}_label\">{$field->label}:</span>";
				}
				echo $value;
				exit();
			}
			switch ( $field->fieldType ) {
				case 1: // is textfield
				case 2: // is textarea
				case 5: // is list
				case 7: // is calendar
					$query = "UPDATE `#__sobi2_fields_data` SET `data_txt` = '{$value}'  WHERE `fieldid` = {$fid} AND `itemid` = {$sid} LIMIT 1 ;";
					break;
				case 3: // is checkbox
					$value = $value == -1 ? 0 : 1;
					$query = "UPDATE `#__sobi2_fields_data` SET `data_txt` = '{$value}'  WHERE `fieldid` = {$fid} AND `itemid` = {$sid} LIMIT 1 ;";
					break;
				case 6: // is group
	    			$v = array();
	    			$query = "DELETE FROM `#__sobi2_fields_data` WHERE `fieldid` = {$fid} AND `itemid` = {$sid};";
		    		$database->setQuery( $query );
		    		$database->query();
					if ($database->getErrorNum()) {
						trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
					}
	    			foreach ( $value as $opt ) {
	    				$opt = urlencode( $opt );
						$opt = $config->clearSQLinjection( $opt );
	    				$v[] = " ( '{$fid}', '{$opt}', NULL , '{$sid}', NULL )";
	    			}
	    			$query = "INSERT INTO `#__sobi2_fields_data` ( `fieldid` , `data_txt` , `data_bool` , `itemid` , `expiration` ) VALUES " . implode(" , ", $v);
					break;
			}
			if( $query ) {
				$database->setQuery( $query );
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
					echo "Error saving data";
				}
				else {
					$value = str_replace( array( "\n", "\\n", "\\\n" ), null, $value );
					$config->sobiCache->clearAll();
					$config->sobiCache->removeObj( $sid );
					if( $field->fieldType == 5 ) {
						$value = $field->definedValues[$value];
					}
					elseif( $field->fieldType == 3 ) {
						$value = $value ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
					}
					elseif( $field->fieldType == 6 ) {
						unset( $fieldData );
						$fieldData = new sobiField( $fid, $sid );
						$fieldData->data = $fieldData->getSelectedValues( $sid );
		    			if( is_array( $fieldData->data )) {
		    				$value = "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
							foreach ( $fieldData->data as $opt ) {
								$value .= "\n\t<li>{$opt}</li>";
							}
							$value .= "\n</ul>";
		    			}
					}
					if($fieldData->isUrl == 1) {
						$value = "<a href=\"{$value}\"title=\"{$sobi->title}\" target=\"_blank\">{$field->label}</a>";
					}
					elseif($fieldData->isUrl == 2) {
						$value = "<a href=\"mailto:{$value}\" title=\"{$sobi->title}\" target=\"_blank\">{$field->label}</a>";
					}
					elseif($fieldData->isUrl == 3) {
						$value = "<img src=\"{$value}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
					}
					$value = $config->getSobiStr( $value );
					header( "Content-Type: application/x-javascript; "._ISO );
					if( $fieldData->with_label || $field->fieldType == 3 ) {
						$field->label = $config->getSobiStr( $field->label );
						echo "<span id=\"sobi2Listing_{$field->fieldname}_label\">{$field->label}: </span>";
					}
					echo stripslashes($value);
					exit();
				}
			}
		}
		else {
			echo _SOBI2_NOT_AUTH;
			exit();
		}
	}
	/**
	 * display the wuick edit function field
	 *
	 * @return string
	 */
	function quickEditField()
	{
		$config =& sobi2Config::getInstance();
		$user =& $config->getUser();
		$database =& $config->getDb();
		$sid = (int) sobi2Config::request( $_REQUEST, "sid", 0 );
		$fid = (int) sobi2Config::request( $_REQUEST, "fid", 0 );
		$save = (int) sobi2Config::request( $_REQUEST, "save", 0 );
		$val = sobi2Config::request( $_REQUEST, "value", null );
		$admFields = array();
		/* if no admin ensure check if user do not trying to edit administative field */
		if( !$config->checkPerm() ) {
			$query = "SELECT fieldid FROM `#__sobi2_fields` WHERE displayed = 1";
			$database->setQuery( $query );
			$admFields = $database->loadResultArray();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( in_array( $fid, $admFields )) {
				echo _SOBI2_NOT_AUTH;
				exit();
			}
		}
		if( $save ) {
			return sobiField::saveQuickEdit( $sid, $fid, $val );
		}

		header("Content-Type: application/x-javascript; "._ISO);

		sobi2Config::import("sobi2.class");
		$sobi = new sobi2( $sid );

		if ($sobi->checked_out && $sobi->checked_out != $user->id && $sobi->checked_out_time > $config->checkOutTime) {
			echo _SOBI2_LISTING_CHECKED_OUT;
			exit();
		}
		if( ( ( ( $user->id && $user->id == $sobi->owner && $config->allowUserToEditEntry ) || $config->checkPerm() ) && $config->allowQuickEdit == 1 ) || ( $config->checkPerm() && $config->allowQuickEdit == 2 ) ) {
			sobi2Config::import("form.class");
			$fieldData = new sobiField( $fid, $sid );
			$field = new sobiField( $fid );
			$fLabel = str_replace( " ", "&nbsp;", $config->getSobiStr( strip_tags( $field->label ) ) );
			$nl = null;
			switch ($field->fieldType) {
				case 1: // is textfield
					$fo = $field->isTextField( $field, false, $fieldData );
					break;
				case 2: // is textarea
					$fo = $field->isTextarea( $field, $fieldData );
					$nl = "<br/>";
					break;
				case 3: // is checkbox
					$fo = $field->isCheckBox( $field, $fieldData );
					break;
				case 5: // is list
					$fo = $field->isList( $field, $fieldData );
					break;
				case 6: // is group
					$fo = $field->isCheckboxGroup( $field, $sid );
					break;
				case 7: // is calendar
					$fo = $field->isCalendar( $field, $fieldData );
					break;
			}
			echo "<form id=\"sqetf\">\n";
			echo "<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}\">{$fLabel}</label>  {$nl} " . $fo. "\n{$nl}\n";
			echo "<input type=\"button\" id=\"sobi2CustomSendButton2\" onclick=\"sqeSend()\" class=\"button\" value=\""._SOBI2_SEND_L."\"/>\n";
			echo "<input type=\"button\" class=\"button\" onclick=\"sqeCancel()\" id=\"sobi2CustomCancelButton\" name=\"cancelEdit\" value=\""._SOBI2_CANCEL."\"/>\n";
			echo "</form>\n";
		}
		else {
			echo _SOBI2_NOT_AUTH;
			exit();
		}
	}
	/**
	 * select list values
	 *
	 * @param string $lang
	 * @param bool $forceRebuild
	 * @return array
	 */
	function getListValues( $language = null, $forceRebuild = false, $noImg = false, $noSelect = false )
	{
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		static $lang;
		static $vals;

		if( is_array( $vals ) && !empty( $vals ) && $language == $lang && !$forceRebuild ) {
			return $vals;
		}
		if( !$language ) {
			if( !$lang ) {
				$lang = $config->sobi2Language;
			}
		}
		else {
			$lang = $language;
		}

		$query = "SELECT  langKey, langValue, description + 0 AS ordering FROM #__sobi2_language WHERE sobi2Section = 'field_opt' AND fieldid = {$this->fieldid} AND sobi2Lang = '{$lang}' ORDER BY ordering";
		$database->setQuery( $query );
		$allOpt = array();
		$res = $database->loadObjectList();
		if ( $database->getErrorNum() ) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( $res && !empty( $res ) ) {
			foreach ( $res as $v ) {
				$allOpt[$v->langKey] = $v->langValue;
			}
		}
		$query = "SELECT  langKey, langValue, description + 0 AS ordering FROM #__sobi2_language WHERE sobi2Section = 'field_opt' AND fieldid = {$this->fieldid}  ORDER BY ordering";
		$database->setQuery( $query );
		$values = $database->loadObjectList();
		if ( $database->getErrorNum() ) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( count( $values ) ) {
			foreach ( $values as $v ) {
				if( !isset( $allOpt[$v->langKey] ) ) {
					$allOpt[$v->langKey] = $v->langValue;
				}
			}
		}
		if( $this->fieldType == 5 || ( defined( "_SOBI2_ADMIN" ) && sobi2Config::request( $_REQUEST, 'task', null ) == "editField" ) ) {
			$this->definedValues = $allOpt;
		}
		else {
			foreach ($allOpt as $k => $v ) {
				if( strstr( $v, "{img=" ) ) {
					$img = substr( $v, strpos( $v, "{img=" ), strpos( $v, "}" ) + 1 );
					$text = str_replace( $img , null, $v );
					if( $noImg ) {
						$v = $text;
					}
					else {
						$img = str_replace( array("{img=", "}"), null, $img );
						if(stristr( $img, ".png" )) {
							$v = sobi2Config::checkPNGImage( $img, $text, "border-style:none;", $this->fieldname, $text );
						}
						else {
							$v = "<img src=\"{$img}\" class=\"{$this->fieldname}\" alt=\"{$text}\" title=\"{$text}\"/>";
						}
						if( strlen( $text ) && !$config->key( "edit_form", "chbx_img_only" ) ) {
							$v = $v."&nbsp;".str_replace( " ", "&nbsp;", $text );
						}
					}
				}
				$this->definedValues[$k] = $v;
			}
		}
		if( $this->sortValues ) {
			asort( $this->definedValues );
		}
		if( $this->selectLabel && !$noSelect ) {
			array_unshift( $this->definedValues, _SOBI2_FIELDLIST_SELECT );
		}
		$vals = $this->definedValues;
		return $this->definedValues;
	}
	/**
	 * @param int $id
	 * @param bool $translate
	 * @return array
	 */
	function getSelectedValues( $id, $translate = true )
	{
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$query = "SELECT data_txt FROM #__sobi2_fields_data WHERE fieldid = {$this->fieldid} AND itemid = {$id} ";
		$database->setQuery( $query );
		$v = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("sobiField::getSelectedValues(): DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$s = array();
		foreach ( $this->definedValues as $l => $o ) {
			if( ( $i = array_search( $l, $v ) ) !== false ) {
				$s[] = $v[$i];
			}
		}
		if( $translate ) {
			foreach ( $s as $o ) {
				if( key_exists( $o, $this->definedValues ) ) {
					$this->selectedValues[$o] = $this->definedValues[$o];
				}
			}
		}
		else {
			$this->selectedValues = $s;
		}
		return $this->selectedValues;
	}
	/**
	 * displaying media filed types data
	 *
	 * @param int $itemid
	 * @param int $fid
	 * @param string $data
	 * @param int $w
	 * @param int $h
	 * @param bool $autostart
	 * @param int $cssId
	 * @return string
	 */
	function showMediaData($itemid = 0, $fid, $data = 0, $w = 0, $h = 0, $autostart = 0, $cssId = 0) {
		$config =& sobi2Config::getInstance();

		$mediaType = null;
		$sobiMediaObject = '';

		if($this) {
			if(!$data)
			{
				$data = $this->data;
			}
			if(!$w)
			{
				$w = $this->fieldColumns;
			}
			if(!$w)
			{
				$w = 50;
			}
			if(!$h)
			{
				$h = $this->fieldRows;
			}
			if(!$h)
			{
				$h = 20;
			}
			if(!$cssId)
			{
				$cssId = "object_id_{$this->fieldname}";
			}
		}
		$fileExt = substr( $data, -4 );

		if(in_array($fileExt,$config->allowedExtAudio))
		{
			$mediaType = 'audio';
		}
		else if(in_array($fileExt,$config->allowedExtVideo))
		{
			$mediaType = 'video';
		}
		else {
			/* we have to find the first / and compare it with the allowed addresse.
			 * To prevent hacks like http://my.evil.site.com/myEvilScriptToEmbed.js?http://www.youtube.com
			 */
			$endOfFld = strpos($data,'/',7);
			$fileAddress = substr($data,0,$endOfFld);
			if(in_array($fileAddress,$config->allowedEmbedUrl))
				$mediaType = 'embed';
		}
		if(!$mediaType) {
			$config->logSobiError("sobiField::showMediaData(): Not allowed file extension ({$data} ) in sobi2 entry id:{$itemid}");
			return;
		}
		if($mediaType == 'video') {
			if( sobi2Config::translatePath("includes|video.field") ) {
				sobi2Config::import("includes|video.field");
				$sobiMediaObject = createSpecialVideoMediaField($fid, $w, $h, $data, $autostart);
			}
			else {
				$sobiMediaObject .= "\n\t <object classid=\"clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA\" id=\"{$cssId}\" type=\"application/x-oleobject\" height=\"$h\" width=\"$w\">";
				$sobiMediaObject .= "\n\t\t <param name=\"FileName\" value=\"{$data}\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"url\" value=\"{$data}\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"ShowStatusBar\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"DisplayBackColor\" value=\"0\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"TransparentAtStart\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"showcontrols\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <embed src=\"{$data}\" showstatusbar=\"1\" transparentatstart=\"true\" type=\"video/x-ms-wvx\" autostart=\"{$autostart}\" showcontrols=\"1\" height=\"$h\" width=\"$w\"/>";
				$sobiMediaObject .= "\n\t </object>";
			}
		}
		else if($mediaType == 'audio') {
			if( sobi2Config::translatePath("includes|audio.field") ) {
				sobi2Config::import("includes|audio.field");
				$sobiMediaObject = createSpecialMediaField($fid, $w, $h, $data, $autostart);
			}
			else {
				$sobiMediaObject .= "\n\t <object classid=\"clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA\" type=\"application/x-mplayer2\" height=\"$h\" width=\"$w\">";
				$sobiMediaObject .= "\n\t\t <param name=\"FileName\" value=\"{$data}\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"url\" value=\"{$data}\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"ShowStatusBar\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"DisplayBackColor\" value=\"0\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"TransparentAtStart\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <param name=\"showcontrols\" value=\"true\" />";
				$sobiMediaObject .= "\n\t\t <embed src=\"{$data}\" showstatusbar=\"1\" transparentatstart=\"true\" type=\"application/x-mplayer2\" autostart=\"{$autostart}\" showcontrols=\"1\" height=\"$h\" width=\"$w\"/>";
				$sobiMediaObject .= "\n\t </object>";
			}
		}
		else if($mediaType == 'embed' && $fileAddress) {
			if( sobi2Config::translatePath("includes|embed.field") ) {
				sobi2Config::import("includes|embed.field");
				$sobiMediaObject = createSpecialEmbedMediaField($fid, $w, $h, $data, $autostart);
			}
			else {
				if($w < 425)
				{
					$w = 425;
				}
				if($h < 350)
				{
					$h = 350;
				}
				$sobiMediaObject .= "\n\t<object width=\"{$w}\" height=\"$h\">";
				$sobiMediaObject .= "\n\t\t<param name=\"movie\" value=\"{$data}\"></param>";
				$sobiMediaObject .= "\n\t\t<param name=\"wmode\" value=\"transparent\"></param>";
				$sobiMediaObject .= "\n\t\t<embed src=\"{$data}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"{$w}\" height=\"{$h}\"></embed>";
				$sobiMediaObject .= "\n\t</object>";
			}
		}
		return $sobiMediaObject;
	}
    /**
     * @param sobiField $field
     * @return string
     */
    function isList( $field, $fieldData )
    {
    	$config =& sobi2Config::getInstance();
   		$size = $field->preferred_size ? "size=\"".$field->preferred_size."\"" : "size=\"1\"";
   		$cssClass = defined('_SOBI2_ADMIN') ? "class=\"text_area\"" : $field->CSSclass ? "class=\"".$field->CSSclass."\"" : null;
		$expl = $field->explanation ? sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0) : null;
		$sort = $field->sortValues;
		$addSelect = $field->selectLabel;
		$selected = $fieldData->selected;
		$field->sortValues = $sort;
		$field->selectLabel = $addSelect;
   		$data = $field->getListValues();

   		if(!(is_array($data)) || empty($data)) {
   			return $this->isTextField($field);
   		}

   		$options = array();
		if(!empty($data)) {
	   		foreach ($data as $option => $value) {
	   			$options[] = sobiHTML::makeOption($option, $value);
	   		}
		}
   		$field->fieldname = $config->getSobiStr($field->fieldname);
   		$html = sobiHTML::selectList( $options, $field->fieldname, "id=\"{$field->fieldname}\" {$size} {$cssClass}", 'value', 'text', $selected);
   		$html = "{$html} {$expl}";
    	return $html;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isTextField( $field, $readOnly = false, $fieldData )
    {
    	$config =& sobi2Config::getInstance();
    	if($field->CSSclass) {
    		$cssClass = "class=\"{$field->CSSclass}\"";
    	}
    	else {
    		$cssClass ="class=\"inputbox\"";
    	}

    	if($field->preferred_size) {
    		$size = "size=\"".$field->preferred_size."\"";
    	}
    	else {
    		$size = "";
    	}
    	if($field->fieldChars) {
    		$maxlength = "maxlength=\"".$field->fieldChars."\"";
    	}
    	else {
    		$maxlength = "";
    	}
    	$value = $config->getSobiStr( $fieldData->data );
    	if($field->explanation) {
    		$expl = sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0);
    	}
    	else {
    		$expl = "";
    	}
		$readOnly = $readOnly ? "readonly=\"readonly\"" : null;
    	$field->fieldname = $config->getSobiStr($field->fieldname);
    	$textField = "<input type=\"text\" id=\"{$field->fieldname}\" {$cssClass}  name=\"{$field->fieldname}\" {$size} {$maxlength} {$readOnly} value=\"{$value}\" />{$expl}";
    	return $textField;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isTextarea( $field, $fieldData )
    {
    	$config =& sobi2Config::getInstance();

    	if($field->CSSclass) {
    		$cssClass = "class=\"".$field->CSSclass."\"";
    	}
    	else {
    		$cssClass = null;
    	}
    	if($field->fieldRows) {
    		$rows = "rows=\"{$field->fieldRows}\"";
    	}
    	else{
    		$rows = "rows=\"10\"";
    	}
    	if($field->fieldColumns) {
    		$columns = "cols=\"{$field->fieldColumns}\"";
    	}
    	else {
    		$columns = "cols=\"40\"";
    	}
    	if($field->explanation) {
    		$expl = sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0);
    	}
    	else {
    		$expl = null;
    	}
    	$value = htmlspecialchars($config->getSobiStr($fieldData->data),ENT_QUOTES);
    	$field->fieldname = $config->getSobiStr($field->fieldname);
		$textarea = "<textarea {$rows} {$columns}  id=\"{$field->fieldname}\" name=\"{$field->fieldname}\" {$cssClass} >{$value}</textarea> {$expl}";

    	return $textarea;
    }
    /**
     * @param sobiField $field
     * @param array $fieldData
     * @return string
     */
    function isCalendar( $field, $fieldData )
    {
    	$config =& sobi2Config::getInstance();
    	$calendar = $this->isTextField( $field, true, $fieldData );
    	$value = $config->key( "calendar", "button_label", " ... " );
    	$calendar .= "<input name=\"reset\" type=\"reset\" id=\"{$field->fieldname}_calendarButton\" class=\"button\" onclick=\"return showSobiCalendar( '{$field->fieldname}', '{$field->fieldname}_calendarButton');\" value=\"{$value}\" />";
    	return $calendar;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isCheckboxGroup( $field, $sid )
    {
    	$config =& sobi2Config::getInstance();
		$expl = $field->explanation ? sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0) : null;
		$data = $field->getListValues();
		$selected = $field->getSelectedValues( $sid, false );

		if ( !$field->CSSclass) {
    		$field->CSSclass = "inputbox";
    	}

		if(!(is_array($field->definedValues)) || empty($field->definedValues)) {
   			return $this->isTextField($field);
   		}
   		$disabled = false;
   		$options = array();
   		if(!empty($data)) {
	   		foreach ($data as $option => $value) {
	   			$options[] = sobiHTML::makeOption( $option, $value, null, null, $field->CSSclass, false, $disabled );
	   		}
   		}
		$expl = $field->label . $expl;
   		$field->fieldname = $config->getSobiStr($field->fieldname);
   		$html = sobiHTML::checkBoxGroup( $options, $field->fieldname, $field->selectedValues, $expl, $field->fieldColumns, "left", true, "field_".$field->fieldname );
    	return $html;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isCheckBox( $field, $fieldData )
    {
    	$config =& sobi2Config::getInstance();

    	if($field->explanation)
    		$expl = sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0);
    	else
    		$expl = "";
    	if( $fieldData->data != 0) {
    		$checked = "checked=\"checked\"";
    	}
    	else
    		$checked = "";

    	$field->fieldname = $config->getSobiStr($field->fieldname);

		$checkbox = "<input {$checked} name=\"{$field->fieldname}\" value=\"1\" id=\"{$field->fieldname}\"  type=\"checkbox\"/> {$expl}";

    	return $checkbox;
    }
}
?>