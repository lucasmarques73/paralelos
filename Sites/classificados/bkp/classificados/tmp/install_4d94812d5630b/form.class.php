<?php
/**
* @version $Id: form.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class sobiForm {
   	/**
   	 * @var sobi2
   	 */
	var $item = null;
   	/**
   	 * @var int
   	 */
	var $sobi2Id = null;
   	/**
   	 * @var array
   	 */
	var $fields = array();
   	/**
   	 * @var array
   	 */
	var $fieldsData = null;
   	/**
   	 * @var string
   	 */
	var $myForm = "";
   	/**
   	 * @var string
   	 */
	var $jsValidator = null;
   	/**
   	 * @var bool
   	 */
	var $wysiwyg = null;
   	/**
   	 * @var array
   	 */
	var $categoryList = array();
   	/**
   	 * @var string
   	 */
	var $dTree = null;
   	/**
   	 * @var string
   	 */
	var $formOuter = null;


    /**
     * constructor
     *
     * @param int $sobi2Id
     * @param int $catid
     * @return sobiForm
     */
    function sobiForm( $sobi2Id = 0, $catid )
    {
    	$config =& sobi2Config::getInstance();
		$my	=& $config->getUser();
		$t = $sobi2Id ? _SOBI2_FORM_TITLE_EDIT_ENTRY : _SOBI2_FORM_TITLE_ADD_NEW_ENTRY;
    	$mainframe =& $config->getMainframe();
    	$cname = $config->key( "edit_form", "browser_title_add_com_name", true ) ? $config->componentName.' - ' : null;

    	$mainframe->setPageTitle( html_entity_decode( $cname.$t ) );
		$config->appendPathWay( $t.'&nbsp;', $t );
    	$database =& $config->getDb();
    	$j15 = false;
    	if( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) {
    		$document =& JFactory::getDocument();
    		$j15 = true;
    	}
		$query = "SELECT catid, name, introtext, description FROM `#__sobi2_categories` WHERE `catid`= 1";
		$database->setQuery( $query );
		$metadata = null;
		if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
			$metadata = $database->loadObject();
		}
    	else {
    		$database->loadObject( $metadata );
    	}
		if ( $database->getErrorNum() ) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if( count( $metadata ) ) {
			$metaDesc = $config->getSobiStr( $config->componentName." ".$config->getSobiStr( $metadata->description ) );
			$metaDesc = str_replace( "\n"," ", $metaDesc );
			$metaDesc .= ' '.$config->key( "edit_form", "add_to_meta_description", null );
			$metaDesc = sobiHTML::cleanText( $metaDesc );
			if( $j15 ) {
				$cur = $document->get( 'description' );
				if( strlen( $cur ) ) {
					$metaDesc = $cur .'. ' . $metaDesc;
				}
				$document->setDescription( $metaDesc );
			}
			else {
				$mainframe->appendMetaTag( 'description' ,$metaDesc );
			}
			$metaKeys = $config->getSobiStr($config->componentName.", ".$config->getSobiStr($metadata->introtext));
			$metaKeys = str_replace( "\n", "," , $metaKeys );
			$metaKeys .= ' '.$config->key( "edit_form", "add_to_meta_keys", null );
			$metaKeys = sobiHTML::cleanText($metaKeys);
			if( $j15 ) {
				$document->setMetadata( 'keywords', $metaKeys );
			}
			else {
				$mainframe->appendMetaTag( 'keywords',$metaKeys );
			}
		}
		if( $j15 ) {
			$cur = $document->getGenerator();
			$gen = " Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName );
			if( strlen( $cur ) ) {
				$gen = $cur .'. ' . $gen;
			}
			$document->setGenerator( $gen );
		}
		else {
			$mainframe->appendMetaTag( "generator", "Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName ) );
		}

		define( "_SOBI2_ADD_FORM", true );
		if(!$config->allowFeEntr && defined( "_SOBI2_ADMIN" ) ) {
			sobi2Config::redirect( $config->key( "redirects", "form_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
		}

		if( !$config->key( "edit_form", "use_cms_wysiwyg_editor" ) ) {
			$config->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$config->liveSite}/components/com_sobi2/includes/js/tiny_mce_src.js\"></script>");
			$config->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$config->liveSite}/components/com_sobi2/includes/js/tiny_init.js\"></script>");
		}
    	if($sobi2Id != 0) {
	    	sobi2Config::import("sobi2.class");
    		$sobi2 = new sobi2($sobi2Id);
    			/*
    			 * check if user is the owner
    			 */
			if($sobi2->owner == $my->id && $config->allowUserToEditEntry || $config->checkPerm()) {
				if ($sobi2->checked_out && $sobi2->checked_out != $my->id && $sobi2->checked_out_time > $config->checkOutTime) {
					sobi2Config::redirect( $config->key( "redirects", "form_checked_out", sobi2Config::sef( 'index.php?option=com_sobi2&amp;catid='.$catid ) ), _SOBI2_LISTING_CHECKED_OUT );
				}
				else {
					$sobi2->checkOutSobi($my->id);
				}
			}
			else {
				sobi2Config::redirect( $config->key( "redirects", "form_no_perm", "index.php" ), _SOBI2_NOT_AUTH );
			}
			$this->item = $sobi2;
			$this->sobi2Id = $sobi2Id;
    	}
    	$this->buildFields();
    	if( $config->key( "edit_form", "cats_selection", true ) && !( $config->key( "edit_form", "edit_callback_func", false ) ) ) {
    		$this->getCategories();
    	}
    	else {
    		if( ( $f = $config->key( "edit_form", "edit_callback_func", false ) ) && function_exists( $f )) {
    			$this->dTree = call_user_func( $f );
    		}
    	}
    }
    /**
     * getting all fields with labels
     *
     */
    function buildFields()
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$adm = $config->checkPerm() ? null : "AND displayed != 1";
    	$query = "SELECT fieldid FROM `#__sobi2_fields` WHERE `enabled` = 1 {$adm} ORDER BY position";
    	$database->setQuery( $query );
    	$fields = $database->loadObjectList();
    	sobi2Config::import("field.class");
		if ( $database->getErrorNum() && $config->debug ) {
			$config->logSobiError("sobiForm::buildFields():".$database->stderr());
		}
		if($fields) {
			foreach($fields as $field) {
				$field = new sobiField($field->fieldid);
				$this->fields[] = $field;
			}
			$this->getPlugins( true );
		}
    }
    /**
     * Enter description here...
     * @since RC 2.8.4
     * @return string
     */
    function buildFormWithTemplate()
    {
    	$config	=& sobi2Config::getInstance();
    	$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.form.tmpl" );
    	if( !(sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.form.tmpl" )) ) {
    		return $this->buildForm();
    	}
   		if( $this->item && is_a( $this->item, "sobi2" ) ) {
   			$formTarget = "index.php?option=com_sobi2&amp;sobi2Task=updateSobi";
   		}
   		else {
   			$formTarget = "index.php?option=com_sobi2&amp;sobi2Task=saveSobi";
   		}

   		$mySobi 		=& $this->item;
    	$fieldsObjects 	=& $mySobi->myFields;
		$pluginsObjects =& $config->S2_plugins;

    	$fetchErr = intval( sobi2Config::request( $_REQUEST, 'err', 0 ) );
		$Itemid	= $config->sobi2Itemid;
    	$catId = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
    	$screenTitle = $this->sobi2Id ? "<p id=\"sobi2EditFormHeader\">"._SOBI2_FORM_TITLE_EDIT_ENTRY."</p>" : "<p id=\"sobi2EditFormHeader\">"._SOBI2_FORM_TITLE_ADD_NEW_ENTRY."</p>";
		$requiredFieldsInfo = "<p id=\"sobi2ReqFieldsInfo\">"._SOBI2_FORM_FIELD_REQ_INFO."</p>";

    	$fields = array();

    	$value  = isset( $this->item ) && is_a( $this->item, "sobi2" ) ? $this->item->title : null;
    	$fields['EntryName']['label'] = "<label class=\"field_entry_name\" for=\"field_entry_name\">{$config->efEntryTitleLabel}"._SOBI2_FORM_FIELD_REQ_MARK."</label>";
    	$fields['EntryName']['field'] = "<input type=\"text\" id=\"field_entry_name\" class=\"inputbox\"  name=\"field_entry_name\" size=\"{$config->efEntryTitleLength}\" maxlength=\"{$config->efEntryTitleLength}\" value=\"{$value}\"/>";

		foreach( $this->fields as $field ) {
			$fieldHtml = null;
			$fields[$field->fieldname]['payment'] = array( 'box' => null, 'box_label' => null, 'explanation' => null, 'price' => 0 );
			/*
			 * first check if this field is free. However if we editing existing item and this field is not empty it is like free
			 */
			if($this->item && isset( $this->item->customFieldsData[$field->fieldname] )  && !empty( $this->item->customFieldsData[ $field->fieldname ] ) && ( $this->item->customFieldsData[$field->fieldname] != '' ) ) {
				$field->is_free = 1;
			}
			if( !$field->is_free ) {
				$this->extendHtmlTpl( $field, $fields[$field->fieldname]['payment'] );
			}
			$star = ( $field->is_required && ( !$field->wysiwyg || $field->fieldType != 2 ) ) ? str_replace( " ", "&nbsp;", _SOBI2_FORM_FIELD_REQ_MARK ) : null;
			$fName = $config->getSobiStr($field->fieldname);
			$fLabel = str_replace( " ", "&nbsp;", $config->getSobiStr( strip_tags( $field->label ) ) );
			$fields[$field->fieldname]['label'] = $fieldHtml."<label class=\"{$fName}\" for=\"{$fName}\">{$fLabel}{$star}</label>";
			/*
			 * now get the type of fiels
			 */
			switch ( $field->fieldType ) {
				case 1: // is textfield
					$fields[$field->fieldname]['field'] = $this->isTextField( $field );
					break;
				case 2: // is textarea
					$fields[$field->fieldname]['field'] = $this->isTextarea( $field );
					break;
				case 3: // is checkbox
					$fields[$field->fieldname]['field'] = $this->isCheckBox( $field );
					break;
				case 4: // is custom
					$fields[$field->fieldname]['field'] = $this->isCustom( $field );
					break;
				case 5: // is list
					$fields[$field->fieldname]['field'] = $this->isList( $field );
					break;
				case 6: // is group
					$fields[$field->fieldname]['field'] = $this->isCheckboxGroup( $field );
					break;
				case 7: // is calendar
					$fields[$field->fieldname]['field'] = $this->isCalendar( $field );
					break;
			}
			if( $field->is_required && ( !$field->wysiwyg || $field->fieldType != 2 ) ) {
				$this->addToJsValidator($field);
			}
			if ( $field->is_free && $field->wysiwyg && $field->fieldType == 2 ) {
    			if( !$config->key( "edit_form", "use_cms_wysiwyg_editor" ) ) {
					$fields[$field->fieldname]['field'] .= "\n<script type=\"text/javascript\">setTextareaToTinyMCE('{$field->fieldname}')</script>";
    			}
			}
		}
		/* process image form */
		if( $config->allowUsingImg ) {
			/*
			 * if editing existing item and it has already logo
			 */
			$fields['ExistingImg']['label'] = null;
			$fields['ExistingImg']['field'] = null;
			if( isset( $this->item ) && is_a( $this->item, "sobi2" ) && strlen( $this->item->image ) ) {
				$img = $config->liveSite.$config->imagesFolder.$this->item->image;
				$fields['ExistingImg']['label'] = "<label class=\"sobi2ImageLabel\" for=\"sobi2Image\">"._SOBI2_FORM_YOUR_IMG_LABEL."{$config->efImgLabel}</label>";
				$fields['ExistingImg']['field'] = "<img src=\"{$img}\" id=\"sobi2Image\" alt=\"{$config->efImgLabel}\"/>" .
						"\n\t\t\t\t <br/><input type=\"checkbox\" name=\"sobi2ImgDelete\" id=\"sobi2ImgDelete\"  value=\"1\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(!this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ."<label for=\"sobi2ImgDelete\">"._SOBI2_FORM_IMG_REMOVE_LABEL." {$config->efImgLabel} </label>";
				$config->allowUsingImg = 1;
				$logoLabel = _SOBI2_FORM_IMG_CHANGE_LABEL." {$config->efImgLabel}";
			}
			else {
				$logoLabel = $config->efImgLabel;
			}
			$fields['ImgField']['payment'] = array( 'box' => null, 'box_label' => null, 'explanation' => null, 'price' => 0 );
			if( $config->allowUsingImg == 1 ) {
				$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$fields['ImgField']['label'] = "<label class=\"sobi2Img\" for=\"sobi2Img\">{$logoLabel}</label>";
				$fields['ImgField']['field'] = "<input name=\"sobi2Img\" id=\"sobi2Img\" class=\"inputbox\" type=\"file\" size=\"20\" maxlength=\"100000\" accept=\"text/*\"/>&nbsp;" . sobiHTML::toolTip(_SOBI2_FORM_IMG_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0);
			}
			elseif( $config->allowUsingImg == 2 ) {
	    		$fields['ImgField']['payment']['price'] = $config->priceForImg;
				$config->priceForImg = $config->getCurrencyFormat( $config->priceForImg );
	    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    			$disabled = "disabled=\"disabled\"";
	    			$fields['ImgField']['payment']['box'] =
	    			 	"<input type=\"checkbox\" name=\"sobi2Img_on\" id=\"sobi2Img_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		}
	    		else {
	    			$disabled = null;
	    		}
	    		$fields['ImgField']['payment']['box_label'] = "<label for=\"sobi2Img_on\">"._SOBI2_ADD_U." {$config->efImgLabel}</label>";
	    		$fields['ImgField']['payment']['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$config->priceForImg}" ."</span>";
				$fields['ImgField']['label'] = "<label class=\"sobi2Img\" for=\"sobi2Img\">{$config->efImgLabel} </label>";
				$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$fields['ImgField']['field'] = "<input type=\"file\" name=\"sobi2Img\" {$disabled} id=\"sobi2Img\" class=\"inputbox\"  size=\"20\" maxlength=\"100000000\"/>&nbsp;" . sobiHTML::toolTip(_SOBI2_FORM_IMG_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0);
			}
		}
		/* process icon form */
		if($config->allowUsingIco) {
			$fields['ExistingIco']['label'] = null;
			$fields['ExistingIco']['field'] = null;
			if( isset( $this->item ) && is_a( $this->item, "sobi2" ) && strlen( $this->item->icon ) ) {
				$img = $config->liveSite.$config->imagesFolder.$this->item->icon;
				$fields['ExistingIco']['label'] = "<label class=\"sobi2IconLabel\" for=\"sobi2Icon\">"._SOBI2_FORM_YOUR_ICO_LABEL."{$config->efIcoLabel}</label>";
				$fields['ExistingIco']['field'] = "<img src=\"{$img}\" id=\"sobi2Icon\" alt=\"{$config->efIcoLabel}\"/>" .
						"\n\t\t\t\t <br/><input type=\"checkbox\" name=\"sobi2IcoDelete\" id=\"sobi2IcoDelete\"  value=\"1\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(!this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ."<label for=\"sobi2IcoDelete\">"._SOBI2_FORM_ICO_REMOVE_LABEL." {$config->efIcoLabel} </label>";
				$config->allowUsingIco = 1;
				$icoLabel = _SOBI2_FORM_ICO_CHANGE_LABEL." {$config->efIcoLabel}";
			}
			else {
				$icoLabel = $config->efIcoLabel;
			}
			$fields['IcoField']['payment'] = array( 'box' => null, 'box_label' => null, 'explanation' => null, 'price' => 0 );
			if($config->allowUsingIco == 1) {
				$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$fields['IcoField']['label'] = "<label class=\"sobi2Ico\" for=\"sobi2Ico\">{$icoLabel}</label>";
				$fields['IcoField']['field'] = "<input name=\"sobi2Ico\" id=\"sobi2Ico\" class=\"inputbox\" type=\"file\" size=\"20\" maxlength=\"100000\" accept=\"text/*\"/>&nbsp;" . sobiHTML::toolTip(_SOBI2_FORM_ICO_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0);
			}
			elseif($config->allowUsingIco == 2) {
	    		$fields['IcoField']['payment']['price'] = $config->priceForIco;
				$config->priceForIco = $config->getCurrencyFormat( $config->priceForIco );
	    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    			$disabled = "disabled=\"disabled\"";
	    			$fields['IcoField']['payment']['box'] =
	    			 	"<input type=\"checkbox\" name=\"sobi2Ico_on\" id=\"sobi2Ico_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		}
	    		else {
	    			$disabled = null;
	    		}
	    		$fields['IcoField']['payment']['box_label'] = "<label for=\"sobi2Ico_on\">"._SOBI2_ADD_U." {$config->efIcoLabel}</label>";
	    		$fields['IcoField']['payment']['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$config->priceForIco}" ."</span>";
				$fields['IcoField']['label'] = "<label class=\"sobi2Ico\" for=\"sobi2Ico\">{$config->efIcoLabel} </label>";
				$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$fields['IcoField']['field'] = "<input type=\"file\" name=\"sobi2Ico\" {$disabled} id=\"sobi2Ico\" class=\"inputbox\"  size=\"20\" maxlength=\"100000000\"/>&nbsp;" . sobiHTML::toolTip(_SOBI2_FORM_ICO_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0);
			}
		}
		/*
		 * if using meta tags
		 */
    	if($config->useMeta) {
    		$metakeys = (isset($this->item->metakey)) ? $config->getSobiStr($this->item->metakey) : null;
    		$metadesc = (isset($this->item->metadesc)) ? $config->getSobiStr($this->item->metadesc) : null;
			if( $config->key( "edit_form", "show_meta_keys", true ) ) {
	    		$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$fields['Metakeys']['label'] = "<label class=\"sobi2MetaKey\" for=\"sobi2MetaKey\">"._SOBI2_FORM_META_KEYS_LABEL."</label>";
	    		$fields['Metakeys']['field'] = "<textarea class=\"inputbox\" cols=\"35\" rows=\"5\" name=\"sobi2MetaKey\" id=\"sobi2MetaKey\">{$metakeys}</textarea>&nbsp;" . sobiHTML::toolTip(_SOBI2_FORM_META_KEYS_EXPL,null,null,$tip,null,'#',0);
    		}
	    	else {
	    		$fields['Metakeys']['label'] = $fields['Metakeys']['field'] = null;
	    	}
    		if( $config->key( "edit_form", "show_meta_desc", true ) ) {
	    		$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
    			$fields['MetaDesc']['label'] = "<label class=\"sobi2MetaDesc\" for=\"sobi2MetaDesc\">"._SOBI2_FORM_META_DESC_LABEL."</label>";
	    		$fields['MetaDesc']['field'] = "<textarea class=\"inputbox\" cols=\"35\" rows=\"5\" name=\"sobi2Metadesc\" id=\"sobi2MetaDesc\">{$metadesc}</textarea>&nbsp;". sobiHTML::toolTip(_SOBI2_FORM_META_DESC_EXPL,null,null,$tip,null,'#',0);
    		}
	    	else {
	    		$fields['MetaDesc']['label'] = $fields['MetaDesc']['field'] = null;
	    	}
    	}
    	else {
    		$fields['Metakeys']['label'] = $fields['Metakeys']['field'] = $fields['MetaDesc']['label'] = $fields['MetaDesc']['field'] = null;
    	}

    	/*
    	 * if allow using custom background
    	 */
    	$fields['BackgroundChooser']['label'] = null;
    	$fields['BackgroundChooser']['field'] = null;
    	$fields['BackgroundPreview']['label'] = null;
    	$fields['BackgroundPreview']['field'] = null;
    	if($config->allowUsingBackground) {
			$selected = (isset($this->item->background)) ? $this->item->background : null;
			$javascript = "onchange=\"if (this.options[selectedIndex].value!='')" .
					"{" .
					" document.backgroundimage.src='{$config->liveSite}/components/com_sobi2/images/backgrounds/' + this.options[selectedIndex].value;" .
					"} " .
					"else " .
					"{" .
					"  document.a.src='{$config->liveSite}/images/blank.png'" .
					"}\"";
			$config->loadBridge();
			$imageFiles = sobi2bridge::readDirectory( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS );
			$images 	= array(  sobiHTML::makeOption( '', '- Select Image -' ) );
			foreach ( $imageFiles as $file ) {
				if ( eregi( "bmp|gif|jpg|png", $file ) ) {
					$images[] = sobiHTML::makeOption( $file, $file );
				}
			}
			$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
			$fields['BackgroundChooser']['field'] = sobiHTML::selectList( $images, 'backgroundimage', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $selected ).sobiHTML::toolTip(_SOBI2_FORM_SELECT_BG_EXPL,null,null,$tip,null,'#',0);
    		$fields['BackgroundChooser']['label'] = "<label for=\"backgroundimage\">"._SOBI2_FORM_SELECT_BG."</label>";
    		$fields['BackgroundPreview']['label'] = "<span style=\"height: 60px;\">"._SOBI2_FORM_BG_PREVIEW."</span>";
    		$fields['BackgroundPreview']['field'] = "<script  type=\"text/javascript\">
						if (document.sobi2EditForm.backgroundimage.options.value!=''){
						  bsimg='{$config->liveSite}/components/com_sobi2/images/backgrounds/' + document.sobi2EditForm.backgroundimage.options.value;
						} else {
						  bsimg='{$config->liveSite}/images/M_images/blank.png';
						}
						document.write('<img src=' + bsimg + ' name=\"backgroundimage\" width=\"50\" height=\"50\" border=\"2\"  alt=\"Preview\" />');
					</script>";
    	}
    	$catChooser =& $this->dTree;
    	$pluginsOutput = $this->getPlugins();
    	$fields['EntryRules']['field'] = null;
    	$fields['EntryRules']['label'] = null;
    	if($config->needToAcceptEntryRules) {
    		$fields['EntryRules']['field'] = "<input type=\"checkbox\" name=\"accept_rules\" id=\"accept_rules\" value=\"\"/>";
    		if($config->entryRulesURLextern)
    			$href = "<a href=\"{$config->entryRulesURLextern}\" target=\"_blank\">{$config->entryRulesURLlabel}</a>";
    		else {
    			$config->entryRulesURL = str_replace( "&", "&amp;", $config->entryRulesURL );
    			$href = "<a href=\"{$config->entryRulesURL}\" target=\"_blank\">{$config->entryRulesURLlabel}</a>";
    		}
    		$fields['EntryRules']['label'] = "<label for=\"accept_rules\">{$config->acceptEntryRules1} {$href} {$config->acceptEntryRules2}</label>";
    	}
    	$fields['SafetyCodeImage']['field'] = null;
    	$fields['SafetyCodeImage']['label'] = null;
    	$fields['SafetyCodeField']['field'] = null;
    	$fields['SafetyCodeField']['label'] = null;
    	if($config->useSecurityCode && !defined("_JEXEC")) {
    		$ext = $this->createSecImg();
    		if($ext) {
	    		$img = "secimg.php?bgcolor={$config->secImgBgColor}&amp;fontcolor={$config->secImgFontColor}&amp;linecolor={$config->secImgLineColor}&amp;bordercolor={$config->secImgBorderColor}&amp;type={$ext}";
				$script = "\n<script type=\"text/javascript\">\n <!-- \n/* <![CDATA[ */ \n document.getElementById( 'codeinput' ).setAttribute( 'autocomplete','off' ); \n /* ]]> */ \n// --> \n</script> ";
	    		$fields['SafetyCodeImage']['label'] = "<label for=\"seccode\">"._SOBI2_FORM_SAFETY_CODE."</label> ";
	    		$fields['SafetyCodeImage']['field'] = "<img src=\"{$config->liveSite}/components/com_sobi2/images/{$img}\" id=\"seccode\" alt=\""._SOBI2_FORM_SAFETY_CODE."\"/>";
	    		$fields['SafetyCodeField']['label'] = "<label for=\"codeinput\">"._SOBI2_FORM_ENTER_SAFETY_CODE."</label>";
	    		$fields['SafetyCodeField']['field'] = "<input class=\"inputbox\" name=\"seccode\" id=\"codeinput\" size=\"5\" maxlength=\"5\" title=\""._SOBI2_FORM_ENTER_SAFETY_CODE."\"/>{$script}";
    		}
    	}
    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
    		$href = "index.php?option=com_sobi2&amp;sobi2Task=checkin&amp;sobi2Id={$this->item->id}&amp;Itemid={$config->sobi2Itemid}";
    		$script = null;
    	}
    	else {
    		$href = "index.php?option=com_sobi2&amp;Itemid={$config->sobi2Itemid}";
    		$script = "\n<script type=\"text/javascript\">\n <!-- \n/* <![CDATA[ */ \n document.getElementById('sobi2SlectedCats').options[0] = null; document.getElementById('sobi2SlectedCatsID').options[0] = null; \n /* ]]> */ \n // --> \n </script>\n";
    	}

    	$href = sobi2Config::sef($href);
    	$cancelButton = "<input type=\"button\" class=\"button\" onclick=\"location.href='{$href}'\" id=\"sobi2CustomCancelButton\" name=\"cancelEdit\" value=\""._SOBI2_CANCEL."\"/>";
    	$sendButton = "<input type=\"submit\" id=\"sobi2CustomSendButton2\" class=\"button\" value=\""._SOBI2_SEND_L."\"/>";
    	if( $config->user->id ) {
    		if( function_exists( "md5" ) ) {
    			$cuid = md5( $config->secret.$config->user->id );
    			$sendButton .= "\n\t<input type=\"hidden\" name=\"cuid\" value=\"{$cuid}\" />";
    			$sendButton .= "\n\t<input type=\"hidden\" name=\"uid\" value=\"{$config->user->id}\" />";
    		}
    	}
    	$this->addToJsValidator(null, 1);
		echo "\n\n<form method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return(submitEntry());\" id=\"sobi2EditForm\" name=\"sobi2EditForm\" action=\"{$formTarget}\">";
        if( $config->debugTmpl && !$fetchErr ) {
        	ob_start();
        	$content = eval('?' . '>' . rtrim( file_get_contents( $template ) ) );
        	$out = ob_get_contents();
        	ob_end_clean();
        	if( $content === false ) {
        		sobi2Config::parseTemplate( $template, $content );
        	}
    		else {
	        	echo $out;
    			if( $config->cacheL2Enabled ) {
        			$requestParams =& $config->get_( "requestParams" );
        			$config->sobiCache->addContent( $out, $requestParams, "addentryform" );
        		}
    		}
        }
        else {
    		if( $config->cacheL2Enabled && !$fetchErr ) {
				ob_start();
    		}
        	require_once( $template );
    		if( $config->cacheL2Enabled && !$fetchErr ) {
				$content = ob_get_contents();
				$config->sobiCache->addContent( $content, $requestParams, "addentryform" );
    		}
        }
    	echo "\n{$script}";
    	echo "\n<input type=\"hidden\" name=\"Itemid\" value=\"{$Itemid}\"/>";
    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
    		echo "\n\t<input type=\"hidden\" name=\"sobi2Id\" value=\"{$this->item->id}\" />";
    		echo "\n\t<input type=\"hidden\" name=\"catid\" value=\"{$catId}\" />";
    	}
    	echo $this->formOuter;
    	echo "\n</form>";
    	echo "\n\t <input type=\"hidden\" id=\"selectedCat\" value=\"\"/>";
    	echo "\n\t <input type=\"hidden\" id=\"selectedCatID\" value=\"\"/>";
    }
    /**
     * @return string
     */
    function buildForm()
    {
    	$config	=& sobi2Config::getInstance();
		$Itemid	= &$config->sobi2Itemid;
    	$catId = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
    	/*
    	 * get title for this page edit/or adding new entry
    	 */
    	if($this->sobi2Id == 0) {
    		$title = _SOBI2_FORM_TITLE_ADD_NEW_ENTRY;
    	}
    	else {
    		$title = _SOBI2_FORM_TITLE_EDIT_ENTRY;
    	}

    	$this->myForm = $this->myForm."<p id=\"sobi2EditFormHeader\">{$title}</p>";

    	/*
    	 * required fields info
    	 */
    	$this->myForm = $this->myForm."<p id=\"sobi2ReqFieldsInfo\">"._SOBI2_FORM_FIELD_REQ_INFO."</p>";
   		if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
   			$formTarget = $config->liveSite."/index.php?option=com_sobi2&amp;sobi2Task=updateSobi";
   		}
   		else {
   			$formTarget = $config->liveSite."/index.php?option=com_sobi2&amp;sobi2Task=saveSobi";
   		}

    	/*
    	 * start of form and table
    	 */
    	$this->myForm = $this->myForm."\n\n<form method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return(submitEntry());\" id=\"sobi2EditForm\" name=\"sobi2EditForm\" action=\"{$formTarget}\">" .
    					"\n\t\t<table id=\"sobi2FormTable\">";

    	/*
    	 * when editing existing entry
    	 */
    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) )	{
    		$value = $this->item->title;
    	}
    	else {
    		$value = null;
    	}

    	$this->myForm = $this->myForm."\n\t\t<tr>" .
    			"\n\t\t<td>" .
    			"\n\t\t\t\t<label class=\"field_entry_name\" for=\"field_entry_name\">{$config->efEntryTitleLabel}"._SOBI2_FORM_FIELD_REQ_MARK."</label>" .
    			"\n\t\t\t</td>" .
    			"\n\t\t\t<td>" .
    			"\n\t\t\t\t" .
    			"<input type=\"text\" id=\"field_entry_name\" class=\"inputbox\"  name=\"field_entry_name\" size=\"{$config->efEntryTitleLength}\" maxlength=\"{$config->efEntryTitleLength}\" value=\"{$value}\"/>" .
    			"\n\t\t\t</td>" .
    			"\n\t\t</tr>";
		/*
		 * getting all fields
		 */
		foreach($this->fields as $field) {
			$fieldHtml = null;

			/*
			 * first check if this field is free. However if we editing existing item and this field is not empty it is like free
			 */

			if(
				$this->item && isset( $this->item->customFieldsData[ $field->fieldname ] ) &&
				!empty( $this->item->customFieldsData[ $field->fieldname ] ) &&
				$this->item->customFieldsData[ $field->fieldname ] != ''
			) {
				$field->is_free = 1;
			}
			if( !$field->is_free ) {
				$fieldHtml = $fieldHtml.$this->extendHtml($field);
				$fieldHtml = "\n\t\t<tr>{$fieldHtml}\n\t\t</tr>";
			}

			if( $field->is_required && ( !$field->wysiwyg || $field->fieldType != 2 ) ) {
				$star = _SOBI2_FORM_FIELD_REQ_MARK;
			}
			else
				$star = "";
			$fieldHtml .= "\n\t\t<tr>";

			$fName = $config->getSobiStr($field->fieldname);
			$fLabel = $config->getSobiStr($field->label);

			/*
			 * now get the type of fiels
			 */
			switch ($field->fieldType) {
				case 1: // is textfield
					$fieldHtml = $fieldHtml."\n\t\t\t<td><label class=\"{$fName}\" for=\"{$fName}\">{$fLabel} {$star}</label></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isTextField( $field );
					break;
				case 2: // is textarea
					$fieldHtml = $fieldHtml."\n\t\t\t<td><label class=\"{$fName}\" for=\"{$fName}\">{$fLabel} {$star}</label></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isTextarea( $field );
					break;
				case 3: // is checkbox
					$fieldHtml = $fieldHtml."\n\t\t\t<td><label class=\"{$fName}\" for=\"{$fName}\">{$fLabel} {$star}</label></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isCheckBox( $field );
					break;
				case 4: // is custom
					$fieldHtml = $fieldHtml."\n\t\t\t<td><span class=\"{$fName}_label\">{$fLabel} {$star}</span></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isCustom( $field );
					break;
				case 5: // is list
					$fieldHtml = $fieldHtml."\n\t\t\t<td><label class=\"{$fName}\" for=\"{$fName}\">{$fLabel} {$star}</label></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isList( $field );
					break;
				case 6: // is group
					$fieldHtml = $fieldHtml."\n\t\t\t<td><span class=\"{$fName}_label\">{$fLabel} {$star}</span></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isCheckboxGroup( $field );
					break;
				case 7: // is list
					$fieldHtml = $fieldHtml."\n\t\t\t<td><label class=\"{$fName}\" for=\"{$fName}\">{$fLabel} {$star}</label></td>\n\t\t\t<td>";
					$fieldHtml = $fieldHtml.$this->isCalendar( $field );
					break;
				default:
					break;
			}

			if( $field->is_required && ( !$field->wysiwyg || $field->fieldType != 2 ) ) {
				$this->addToJsValidator($field);
			}

			if ($field->is_free && $field->wysiwyg && $field->fieldType == 2) {
    			if( !$config->key( "edit_form", "use_cms_wysiwyg_editor" ) ) {
					$fieldHtml = $fieldHtml."\n<script type=\"text/javascript\">setTextareaToTinyMCE('{$field->fieldname}')</script>";
    			}
			}

			$fieldHtml = $fieldHtml."</td>\n\t\t </tr>";
			$this->myForm = $this->myForm.$fieldHtml;
		} // foreach end

		/*
		 * if using show fields for Company logo/icons
		 */
		$this->myForm .= "\n\t\t</table>";
		$this->myForm .= "\n\t\t\t <table  id=\"sobi2FormTable2\">";

		if($config->allowUsingImg) {
			/*
			 * if editing existing item and it has already logo
			 */

			if($this->item && strlen($this->item->image) != 0) {
				$img = $config->liveSite.$config->imagesFolder.$this->item->image;
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td>". _SOBI2_FORM_YOUR_IMG_LABEL .
						" {$config->efImgLabel}" .
						"\n\t\t\t</td>" .
						"\n\t\t\t<td><img src=\"{$img}\" alt=\"{$config->efImgLabel}\"/>" .
						"\n\t\t\t\t <br/><input type=\"checkbox\" name=\"sobi2ImgDelete\" id=\"sobi2ImgDelete\"  value=\"1\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(!this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ."<label for=\"sobi2ImgDelete\">"._SOBI2_FORM_IMG_REMOVE_LABEL." {$config->efImgLabel} </label>".
						"\n\t\t\t</td>\n\t\t</tr>";
				$config->allowUsingImg = 1;
				$logoLabel = _SOBI2_FORM_IMG_CHANGE_LABEL." {$config->efImgLabel}";
			}
			else {
				$logoLabel = $config->efImgLabel;
			}
			$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
			if($config->allowUsingImg == 1) {
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2Img\" for=\"sobi2Img\">{$logoLabel}</label>\n\t\t\t</td>\n\t\t\t<td>";
				$this->myForm = $this->myForm."\n\t\t\t\t <input name=\"sobi2Img\" id=\"sobi2Img\" class=\"inputbox\" type=\"file\" size=\"20\" maxlength=\"100000\" accept=\"text/*\"/>&nbsp;" .
						sobiHTML::toolTip(_SOBI2_FORM_IMG_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
			}
			else if($config->allowUsingImg == 2) {
	    		$config->priceForImg = $config->getCurrencyFormat($config->priceForImg);
	    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    			$disabled = "disabled=\"disabled\"";
	    			$box = 	"<input type=\"checkbox\" name=\"sobi2Img_on\" id=\"sobi2Img_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Img.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		}
	    		else {
	    			$box = null;
	    			$disabled = null;
	    		}
	    		$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td>" . $box .
	    					"<label for=\"sobi2Img_on\">"._SOBI2_ADD_U." {$config->efImgLabel}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$config->priceForImg}" .
	    					"</span>" .
	    					"\n\t\t\t</td>\n\t\t</tr>";
				$tip = $config->key( "edit_form", "tooltip_img", "tooltip.png" );
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2Img\" for=\"sobi2Img\">{$config->efImgLabel}</label></td>\n\t\t\t<td>";
				$this->myForm = $this->myForm."\n\t\t\t\t <input type=\"file\" name=\"sobi2Img\" {$disabled} id=\"sobi2Img\" class=\"inputbox\"  size=\"20\" maxlength=\"100000000\"/>&nbsp;" .
						sobiHTML::toolTip(_SOBI2_FORM_IMG_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$tip,null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
			}
		}

		if($config->allowUsingIco) {
			/*
			 * if editing existing item and it has already logo
			 */
			if($this->item && strlen($this->item->icon) != 0) {
				$ico = $config->liveSite.$config->imagesFolder.$this->item->icon;
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td>". _SOBI2_FORM_YOUR_ICO_LABEL .
						" {$config->efIcoLabel}" .
						"\n\t\t\t</td>" .
						"\n\t\t\t<td><img src=\"{$ico}\" alt=\"{$config->efIcoLabel}\"/>" .
						"\n\t\t\t\t <br/><input type=\"checkbox\" id=\"sobi2IcoDelete\" name=\"sobi2IcoDelete\" value=\"1\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(!this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" .
	    					"<label for=\"sobi2IcoDelete\">"._SOBI2_FORM_ICO_REMOVE_LABEL." {$config->efIcoLabel} </label>".
						"\n\t\t\t</td>\n\t\t</tr>";
				$config->allowUsingIco = 1;
				$icoLabel = _SOBI2_FORM_ICO_CHANGE_LABEL." {$config->efIcoLabel}";
			}
			else {
				$icoLabel = $config->efIcoLabel;
			}

			if($config->allowUsingIco == 1) {
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2Ico\" for=\"sobi2Ico\">{$icoLabel}</label>\n\t\t\t</td>\n\t\t\t<td>";
				$this->myForm = $this->myForm."\n\t\t\t\t <input name=\"sobi2Ico\" id=\"sobi2Ico\" class=\"inputbox\" type=\"file\" size=\"20\" maxlength=\"100000\" accept=\"text/*\"/>&nbsp;" .
						sobiHTML::toolTip(_SOBI2_FORM_ICO_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
			}
			else if($config->allowUsingIco == 2) {
	    		$config->priceForIco = $config->getCurrencyFormat($config->priceForIco);
	    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    			$disabled = "disabled=\"disabled\"";
	    			$box = 	"<input type=\"checkbox\" id=\"sobi2Ico_on\" name=\"sobi2Ico_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"sobi2Ico.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		}
	    		else {
	    			$box = null;
	    			$disabled = null;
	    		}
	    		$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td>" . $box .
	    					"<label for=\"sobi2Ico_on\">"._SOBI2_ADD_U." {$config->efIcoLabel}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$config->priceForIco}" .
	    					"</span>" .
	    					"\n\t\t\t</td>\n\t\t</tr>";
				$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2Ico\" for=\"sobi2Ico\">{$config->efIcoLabel} </label></td>\n\t\t\t<td>";
				$this->myForm = $this->myForm."\n\t\t\t\t <input name=\"sobi2Ico\" {$disabled} id=\"sobi2Ico\" class=\"inputbox\" type=\"file\" size=\"20\" maxlength=\"100000\" accept=\"text/*\"/>&nbsp;" .
						sobiHTML::toolTip(_SOBI2_FORM_ICO_EXPL._SOBI2_EF_MAX_FILE_SIZE.$config->maxFileSize._SOBI2_EF_KB_FILE_SIZE,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
			}
		}
		/*
		 * if using meta tags
		 */
    	if($config->useMeta) {
    		if(isset($this->item->metakey)) {
    			$metakeys = $config->getSobiStr($this->item->metakey);
    		}
    		else {
    			$metakeys = null;
    		}
    		if(isset($this->item->metadesc)) {
    			$metadesc = $config->getSobiStr($this->item->metadesc);
    		}
    		else {
    			$metadesc = null;
    		}
			if( $config->key( "edit_form", "show_meta_keys", true ) ) {
	    		$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2MetaKey\" for=\"sobi2MetaKey\">"._SOBI2_FORM_META_KEYS_LABEL."</label></td>\n\t\t\t<td>";
	    		$this->myForm = $this->myForm."\n\t\t\t\t <textarea class=\"inputbox\" cols=\"35\" rows=\"5\" name=\"sobi2MetaKey\" id=\"sobi2MetaKey\">{$metakeys}</textarea>&nbsp;".
	    										sobiHTML::toolTip(_SOBI2_FORM_META_KEYS_EXPL,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
    		}
    		if( $config->key( "edit_form", "show_meta_desc", true ) ) {
	    		$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td><label class=\"sobi2MetaDesc\" for=\"sobi2MetaDesc\">"._SOBI2_FORM_META_DESC_LABEL."</label></td>\n\t\t\t<td>";
	    		$this->myForm = $this->myForm."\n\t\t\t\t <textarea class=\"inputbox\" cols=\"35\" rows=\"5\" name=\"sobi2Metadesc\" id=\"sobi2MetaDesc\">{$metadesc}</textarea>&nbsp;".
	    										sobiHTML::toolTip(_SOBI2_FORM_META_DESC_EXPL,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
    		}
    	}
    	/*
    	 * if allow using custom background
    	 */
    	if($config->allowUsingBackground) {
			if(isset($this->item->background)) {
				$selected = $this->item->background;
			}
			else {
				$selected = null;
			}
			$javascript = "onchange=\"if (this.options[selectedIndex].value!='')" .
					"{" .
					" document.backgroundimage.src='{$config->liveSite}/components/com_sobi2/images/backgrounds/' + this.options[selectedIndex].value;" .
					"} " .
					"else " .
					"{" .
					"  document.a.src='{$config->liveSite}/images/blank.png'" .
					"}\"";
			$config->loadBridge();
			$imageFiles = sobi2bridge::readDirectory( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS );
			$images 	= array(  sobiHTML::makeOption( '', '- Select Image -' ) );
			foreach ( $imageFiles as $file ) {
				if ( eregi( "bmp|gif|jpg|png", $file ) ) {
					$images[] = sobiHTML::makeOption( $file, $file );
				}
			}
			$images = sobiHTML::selectList( $images, 'backgroundimage', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $selected );
    		$this->myForm .= "\n\t\t<tr>\n\t\t\t<td><label for=\"backgroundimage\">"._SOBI2_FORM_SELECT_BG."</label></td>\n\t\t\t<td>";
    		$this->myForm .= $images."&nbsp;";
    		$this->myForm .= sobiHTML::toolTip(_SOBI2_FORM_SELECT_BG_EXPL,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0)."\n\t\t\t</td>\n\t\t</tr>";
    		$this->myForm .= "\n\t\t<tr>\n\t\t\t<td style=\"height: 60px;\">"._SOBI2_FORM_BG_PREVIEW."</td>\n\t\t\t<td>";
    		$this->myForm .= "" .
    				"<script  type=\"text/javascript\">
						if (document.sobi2EditForm.backgroundimage.options.value!=''){
						  bsimg='{$config->liveSite}/components/com_sobi2/images/backgrounds/' + document.sobi2EditForm.backgroundimage.options.value;
						} else {
						  bsimg='{$config->liveSite}/images/M_images/blank.png';
						}
						document.write('<img src=' + bsimg + ' name=\"backgroundimage\" width=\"50\" height=\"50\" border=\"2\"  alt=\"Preview\" />');
					</script>";
    		$this->myForm .= "\n\t\t\t</td>\n\t\t</tr>";
    	}
    	/*
    	 * end of form
    	 */
    	$this->myForm = $this->myForm."\n\t\t<tr>\n\t\t\t<td style=\"vertical-align: top;\" colspan=\"2\">".$this->dTree."</td></tr>";
    	$this->myForm .= "\n\t\t</table>";
    	$this->myForm .= $this->getPlugins();
    	$this->myForm = $this->myForm.$this->buildFormEnd();
    	$this->myForm = $this->myForm."\n\t</table>";
    	$this->myForm = $this->myForm."<input type=\"hidden\" name=\"Itemid\" value=\"{$Itemid}\" />";
    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
    		$this->myForm = $this->myForm."\n\t<input type=\"hidden\" name=\"sobi2Id\" value=\"{$this->item->id}\" />" .
    									  "\n\t<input type=\"hidden\" name=\"catid\" value=\"{$catId}\" />";
    	}
    	else {
    		$this->myForm = $this->myForm.$this->formOuter;
    	}
    	$this->myForm = $this->myForm."\n</form>";
    	$this->myForm = $this->myForm."\n\t <input type=\"hidden\" id=\"selectedCat\" value=\"\"/>";
    	$this->myForm = $this->myForm."\n\t <input type=\"hidden\" id=\"selectedCatID\" value=\"\"/>";
    	echo $this->myForm;
    }

    /**
     * @return string
     */
    function showForm()
    {
    	if(sizeof($this->fields) > 0) {
    		$config =& sobi2Config::getInstance();
    		if( $config->useFormTpl ) {
    			$this->buildFormWithTemplate();
    		}
    		else {
    			$this->buildForm();
    		}
    	}
    	else {
    		return false;
    	}
    }
    /**
     * @return string
     */
    function buildFormEnd() {
    	$config =& sobi2Config::getInstance();
    	$formEnd = "<br/>\n\t\t<table id=\"sobi2FormTable3\">\n";
    	if($config->needToAcceptEntryRules) {
    		$formEnd .= "\t\t<tr>\n\t\t\t<td colspan=\"2\" id=\"accept_rules_row\">";
    		$formEnd = $formEnd."<input type=\"checkbox\" name=\"accept_rules\" id=\"accept_rules\" value=\"\"/>";

    		if($config->entryRulesURLextern)
    			$href = "<a href=\"{$config->entryRulesURLextern}\" target=\"_blank\">{$config->entryRulesURLlabel}</a>";
    		else {
    			$href = "<a href=\"{$config->entryRulesURL}\" target=\"_blank\">{$config->entryRulesURLlabel}</a>";
    		}

    		$formEnd = $formEnd."<label for=\"accept_rules\">" .
    							"{$config->acceptEntryRules1} " .
    							"{$href} " .
    							"{$config->acceptEntryRules2}" .
    							"</label>";

    		$formEnd = $formEnd."\n\t\t\t</td>\n\t\t</tr>";
    	}
    	$formEnd = $formEnd."\n\t\t<tr>\n\t\t\t<td colspan=\"2\">";

    	if($config->useSecurityCode && !defined("_JEXEC")) {
    		$formEnd = $formEnd."\n\t\t\t\t<table id=\"sobi2FormFooter\">\n\t\t\t\t\t<tr>";
    		$ext = $this->createSecImg();
    		if($ext) {
	    		$img = "secimg.php?bgcolor={$config->secImgBgColor}&amp;fontcolor={$config->secImgFontColor}&amp;linecolor={$config->secImgLineColor}&amp;bordercolor={$config->secImgBorderColor}&amp;type={$ext}";
	    		$formEnd = $formEnd."\n\t\t\t\t\t\t\t<td><label for=\"seccode\">"._SOBI2_FORM_SAFETY_CODE."</label> " .
	    				"<img src=\"{$config->liveSite}/components/com_sobi2/images/{$img}\" id=\"seccode\" alt=\""._SOBI2_FORM_SAFETY_CODE."\"/>" .
	    				"</td>" .
	    				"\n\t\t\t\t\t\t\t<td> <label for=\"codeinput\">"._SOBI2_FORM_ENTER_SAFETY_CODE."</label></td>" .
	    				"\n\t\t\t\t\t\t\t<td> <input class=\"inputbox\" name=\"seccode\" id=\"codeinput\" size=\"5\" maxlength=\"5\" title=\""._SOBI2_FORM_ENTER_SAFETY_CODE."\"/></td>";
    		}
			$script = "\n<script type=\"text/javascript\">\n <!-- \n/* <![CDATA[ */ \n document.getElementById( 'codeinput' ).setAttribute( 'autocomplete','off' ); \n /* ]]> */ \n// --> \n</script> ";
    		$formEnd = $formEnd."\n\t\t\t\t\t</tr>\n\t\t\t\t</table> {$script}";
    	}
    	if( $this->item ) {
    		$href = "index.php?option=com_sobi2&amp;sobi2Task=checkin&amp;sobi2Id={$this->item->id}&amp;Itemid={$config->sobi2Itemid}";
    		$script = null;
    	}
    	else {
    		$href = "index.php?option=com_sobi2&amp;Itemid={$config->sobi2Itemid}";
    		$script = "\n<script type=\"text/javascript\">\n <!-- \n/* <![CDATA[ */ \n document.getElementById('sobi2SlectedCats').options[0] = null; document.getElementById('sobi2SlectedCatsID').options[0] = null; \n /* ]]> */ \n // --> \n </script>\n";
    	}

    	$href = sobi2Config::sef($href);
    	$cancelBt = "<input type=\"button\" class=\"button\" onclick=\"location.href='{$href}'\" id=\"sobi2CancelButton\" name=\"cancelEdit\" value=\""._SOBI2_CANCEL."\"/>";
    	$formEnd = $formEnd.$cancelBt;
    	$formEnd = $formEnd."<input type=\"submit\" id=\"sobi2SendButton\" class=\"button\" value=\""._SOBI2_SEND_L."\"/>\n{$script}";
    	if( $config->user->id ) {
    		if( function_exists( "md5" ) ) {
    			$cuid = md5( $config->secret.$config->user->id );
    			$formEnd .= "\n\t<input type=\"hidden\" name=\"cuid\" value=\"{$cuid}\" />";
    			$formEnd .= "\n\t<input type=\"hidden\" name=\"uid\" value=\"{$config->user->id}\" />";
    		}
    	}
    	$formEnd = $formEnd."\n\t\t\t</td>\n\t\t</tr>";
    	$this->addToJsValidator(null, 1); // build end section for js validator
    	return $formEnd;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isList($field)
    {
    	$config 		=& sobi2Config::getInstance();
    	$cssClass 		= defined('_SOBI2_ADMIN') ? "class=\"text_area\"" : $field->CSSclass ? "class=\"".$field->CSSclass."\"" : null;
   		$size 			= $field->preferred_size ? "size=\"".$field->preferred_size."\"" : "size=\"1\"";
   		$disabled 		= ($field->is_free || defined('_SOBI2_ADMIN')  || !$config->key( "edit_form", "show_payment_checkboxes", true )) ? "" : "disabled=\"disabled\"";
		$expl 			= $field->explanation ? sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0) : null;
		if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
			sobi2Config::import("field.class");
			$sort = $field->sortValues;
			$addSelect = $field->selectLabel;
			$field = new sobiField( $field->fieldid, $this->item->id );
			$selected = $field->selected;
			$field->sortValues = $sort;
			$field->selectLabel = $addSelect;
		}
		else {
			$selected = null;
		}
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
   		$html = sobiHTML::selectList( $options, $field->fieldname, "id=\"{$field->fieldname}\" {$size} {$cssClass} {$disabled}", 'value', 'text', $selected);
   		$html = "{$html}&nbsp;{$expl}";
    	return $html;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isTextField( $field, $readOnly = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( defined( '_SOBI2_ADMIN' ) ) {
    		$cssClass = "class=\"text_area\"";
    	}
    	else if($field->CSSclass) {
    		$cssClass = "class=\"".$field->CSSclass."\"";
    	}
    	else {
    		$cssClass = null;
    	}
    	if($field->preferred_size) {
    		$size = "size=\"".$field->preferred_size."\"";
    	}
    	else {
    		$size = null;
    	}
    	if($field->fieldChars) {
    		$maxlength = "maxlength=\"".$field->fieldChars."\"";
    	}
    	else {
    		$maxlength = null;
    	}
    	if($field->is_free || defined('_SOBI2_ADMIN') || !$config->key( "edit_form", "show_payment_checkboxes", true )) {
    		$disabled = null;
    	}
    	else {
    		$disabled = "disabled=\"disabled\"";
    	}
    	if($this->item && isset($this->item->customFieldsData[$field->fieldname]) && ($this->item->customFieldsData[$field->fieldname] != '' )) {
    		$value = htmlspecialchars($config->getSobiStr($this->item->customFieldsData[$field->fieldname]),ENT_QUOTES);
    		$value = "value=\"{$value}\"";
    	}
    	else {
    		$value = null;
    	}
    	if($field->explanation) {
    		$expl = sobiHTML::toolTip( $field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0 );
    	}
    	else {
    		$expl = null;
    	}
		$readOnly = $readOnly ? "readonly=\"readonly\"" : null;
    	$field->fieldname = $config->getSobiStr($field->fieldname);
    	$textField = "<input type=\"text\" id=\"{$field->fieldname}\" {$cssClass}  name=\"{$field->fieldname}\" {$size} {$maxlength} {$readOnly} {$disabled} {$value} />&nbsp;{$expl}";
    	return $textField;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isTextarea($field)
    {
    	$config =& sobi2Config::getInstance();

    	if(defined( '_SOBI2_ADMIN') ) {
    		$cssClass = "class=\"text_area\"";
    	}
    	elseif($field->CSSclass) {
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
    	if($field->is_free || defined('_SOBI2_ADMIN') || !$config->key( "edit_form", "show_payment_checkboxes", true )) {
    		$disabled = null;
    	}
    	else {
    		$disabled = "disabled=\"disabled\"";
    	}
    	if($field->explanation) {
    		$expl = sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0);
    	}
    	else {
    		$expl = null;
    	}
    	if($this->item && isset($this->item->customFieldsData[$field->fieldname]) && ($this->item->customFieldsData[$field->fieldname] != '' )) {
    		$value = htmlspecialchars($config->getSobiStr($this->item->customFieldsData[$field->fieldname]),ENT_QUOTES);
    		$disabled = "";
    	}
    	else {
    		$value = null;
    	}
    	if( !$field->wysiwyg && !defined( "_SOBI2_ADMIN" ) ) {
    		$value = strip_tags( $config->getSobiStr( $value ) );
    	}
    	$field->fieldname = $config->getSobiStr($field->fieldname);
		if( $config->key( "edit_form", "use_cms_wysiwyg_editor" ) ) {
			if( defined( "_JEXEC" ) && class_exists( 'JFactory' ) ) {
				static $editor = null;
				if( !$editor ) {
					$editor =& JFactory::getEditor();
				}
				$textarea = $editor->display( $field->fieldname, $value, "100%", "400", $field->fieldRows, $field->fieldColumns, false );
			}
			else {
		    	if($field->fieldRows) {
		    		$rows = "rows=\"{$field->fieldRows}\"";
		    	}
		    	else {
		    		$rows = "rows=\"10\"";
		    	}

		    	if($field->fieldColumns) {
		    		$columns = "cols=\"{$field->fieldColumns}\"";
		    	}
		    	else {
		    		$columns = "cols=\"40\"";
		    	}
				$textarea = editorArea( $field->fieldname,  $value, $field->fieldname, "100%;", "400", $columns, $rows );
			}
			$textarea .= "&nbsp;{$expl}";
		}
		else {
			$textarea = "<textarea {$rows} {$columns}  id=\"{$field->fieldname}\" name=\"{$field->fieldname}\"  {$disabled}  {$cssClass} >{$value}</textarea>&nbsp;{$expl}";
		}
    	return $textarea;
    }
    function isCalendar( $field )
    {
    	$config =& sobi2Config::getInstance();
    	$config->loadCalendar();
    	$calendar = $this->isTextField( $field, true );
    	$value = $config->key( "calendar", "button_label", " ... " );
    	$calendar .= "<input name=\"reset\" type=\"reset\" id=\"{$field->fieldname}_calendarButton\" class=\"button\" onclick=\"return showSobiCalendar( '{$field->fieldname}', '{$field->fieldname}_calendarButton');\" value=\"{$value}\" />";
    	return $calendar;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isCheckboxGroup( $field )
    {
    	$config =& sobi2Config::getInstance();
		$expl = $field->explanation ? sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0) : null;
		sobi2Config::import("field.class");
		$field = new sobiField( $field->fieldid );
		$data = $field->getListValues();

		if( isset( $this->item ) && is_a( $this->item, "sobi2" ) && $this->item->id ) {
			$selected = $field->getSelectedValues( $this->item->id, false );
		}
		else {
			$selected = null;
		}

    	if(defined('_SOBI2_ADMIN')) {
    		$field->CSSclass = "text_area";
    	}
    	elseif ( !$field->CSSclass) {
    		$field->CSSclass = "inputbox";
    	}
		if(!(is_array($field->definedValues)) || empty($field->definedValues)) {
   			return $this->isTextField($field);
   		}
   		$disabled = false;
   		if( !$field->is_free && !defined( '_SOBI2_ADMIN' ) && $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	   		if( !$selected || empty( $selected ) ) {
	   			$disabled = true;
	   		}
   		}
   		$options = array();
   		if(!empty($data)) {
	   		foreach ($data as $option => $value) {
	   			$options[] = sobiHTML::makeOption( $option, $value, null, null, $field->CSSclass, false, $disabled );
	   		}
   		}
		$expl = $field->label . "&nbsp;" . $expl;
   		$field->fieldname = $config->getSobiStr($field->fieldname);
   		$html = sobiHTML::checkBoxGroup( $options, $field->fieldname, $field->selectedValues, $expl, $field->fieldColumns, "left", true, "field_".$field->fieldname );
    	return $html;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isCheckBox( $field )
    {
    	$config =& sobi2Config::getInstance();

    	if($field->explanation)
    		$expl = sobiHTML::toolTip($field->explanation,null,null,$config->key( "edit_form", "tooltip_img", "tooltip.png" ),null,'#',0);
    	else
    		$expl = "";
    	if($this->item && isset($this->item->customFieldsData[$field->fieldname]) && $this->item->customFieldsData[$field->fieldname] != 0) {
    		$checked = "checked=\"checked\"";
    	}
    	else
    		$checked = "";
    	if(($field->is_free) || defined('_SOBI2_ADMIN') || !$config->key( "edit_form", "show_payment_checkboxes", true ))
    		$disabled = "";
    	else
    		$disabled = "disabled=\"disabled\"";

    	$field->fieldname = $config->getSobiStr($field->fieldname);

		$checkbox = "<input {$checked} name=\"{$field->fieldname}\" {$disabled} value=\"1\" id=\"{$field->fieldname}\"  type=\"checkbox\"/>&nbsp;{$expl}";

    	return $checkbox;
    }
    /**
     * @param sobiField $field
     * @return string
     */
    function isCustom($field)
    {
    	$config =& sobi2Config::getInstance();
    	$config->getPayment();
    	$config->getGoogleMaps();
    	$placeHolders = array(
    							"{componentName}",
    							"{sitename}",
    							"{sobi2Lang}",
    							"{currency}",
    							"{entryExpirationTime}",
    							"{priceForIco}",
    							"{priceForImg}",
    							"{bankData}",
    							"{payPalMail}",
    							"{payPalUrl}",
    							"{paymentReference}",
    							"{googleApiKey}",
    							"{basicPrice}",
    							"{basicPriceLabel}",
    							"{imgLabel}",
    							"{icoLabel}"
    						);
    	$placeHoldersValues = array(
    							$config->componentName,
    							$config->liveSite,
    							$config->sobi2Language,
    							$config->currency,
    							$config->entryExpirationTime,
								$config->priceForIco,
								$config->priceForImg,
								str_replace("\n", "<br/>",$config->bankData),
								$config->payPalMail,
								$config->payPalUrl,
								$config->payTitle,
								$config->googleMapsApiKey,
								$config->basicPrice,
								$config->basicPriceLabel,
								$config->efImgLabel,
								$config->efIcoLabel
    						);
    	return str_replace($placeHolders, $placeHoldersValues, $field->customCode);
    }
    /**
     * adding and build the required fields into js validator
     *
     * @param int $field
     * @param bool $end
     */
    function addToJsValidator($field, $end = 0)
    {
    	$config =& sobi2Config::getInstance();
    	/*
    	 * start of java script
    	 */

    	if($this->jsValidator == null) {
    		$this->jsValidator = "\n" .
    							 "<script type=\"text/javascript\">" .
    							 "<!-- \n\n".
    							 "/* <![CDATA[ */ \n\n".
    							 "\n\t function submitEntry() {".
		    					 "\n\t\t" .
		    					 "\n\t\t var form = document.sobi2EditForm;";

		if( $config->key( "edit_form", "cats_selection", true ) ) {
    		$this->jsValidator .= "document.getElementById('sobi2SlectedCatsID').disabled = false;" .
		    					  "\n\t\t" .
    							  "for(var a = 0; a < document.getElementById('sobi2SlectedCatsID').length; ++a) {" .
    							  "\n\t\t\t" .
    							  "document.getElementById('sobi2SlectedCatsID')[a].selected=true;".
    							  "\n\t\t } ".
    							  "\n\t\t if (document.getElementById('sobi2SlectedCatsID').length < 1 ) {" .
								  "\n\t\t\t alert( '"._SOBI2_FORM_JS_SELECT_CAT."' );" .
								  "\n\t\t\t return false;" .
								  "\n\t\t }" .
								  "\n\t\t else if (form.field_entry_name.value == '') {";
			if( $config->key( "edit_form", "show_not_selected", true ) ) {
				$this->jsValidator .= "\n\t\t\t document.getElementById( 'field_entry_name' ).style.border = '3px solid #FF0000';";
			}
			$this->jsValidator .= "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
								  "\n\t\t\t return false;" .
								  "\n\t\t }";
		}
		else {
    		if( $f = $config->key( "edit_form", "cat_select_callback_func", false ) && function_exists( $f )) {
    			$this->jsValidator .= call_user_func( $f );
    		}
			$this->jsValidator .= "\n\t\t if (form.field_entry_name.value == '') {" ;
					if( $config->key( "edit_form", "show_not_selected", true ) ) {
						$this->jsValidator .= "\n\t\t\t document.getElementById( 'field_entry_name' ).style.border = '3px solid #FF0000';";
					}
					$this->jsValidator .= "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
								  		  "\n\t\t\t return false;" .
								  		  "\n\t\t }";

		}
		if($config->needToAcceptEntryRules) {
				$this->jsValidator = $this->jsValidator."\n\t\t else if (form.accept_rules.checked == false) {" ;
				if( $config->key( "edit_form", "show_not_selected", true ) ) {
					$this->jsValidator .= "\n\t\t\t document.getElementById( 'accept_rules_row' ).style.border = '3px solid #FF0000';";
				}
				$this->jsValidator .= 	"\n\t\t\t alert( '"._SOBI2_FORM_JS_ACC_ENTRY_RULES."' );" .
										"\n\t\t\t return false;" .
										"\n\t\t }";
			}
			if($config->useSecurityCode) {
				$this->jsValidator = $this->jsValidator."\n\t\t else if (form.seccode.value == '') {" .
														"\n\t\t\t alert( '"._SOBI2_FORM_ENTER_SAFETY_CODE."' );" .
														"\n\t\t\t return false;" .
														"\n\t\t }";
			}

    	}
		/*
		 * end of java script
		 */
		if($end != 0) {
			$this->jsValidator = $this->jsValidator."\n\t\t else {" .
													"\n\t\t\t return true;" .
													"\n\t\t }" .
													"\n\t }" .
													"\n\t /* ]]> */" .
													"\n\t // -->" .
													"\n</script>";
			/*
			 * add script to page header
			 */
			$config->addCustomHeadTag($this->jsValidator);
		}
		/*
		 * when adding a new required field
		 */
		else {
			switch ($field->fieldType) {
				case 1: // is textfield
				case 7: // is textfield
					$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.value == '') {" ;
					if( $config->key( "edit_form", "show_not_selected", true ) ) {
						$this->jsValidator .= "\n\t\t\t document.getElementById( '{$field->fieldname}' ).style.border = '3px solid #FF0000';";
					}

					$this->jsValidator .= "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										  "\n\t\t\t return false;" .
										  "\n\t\t }";
					break;
				case 2: // is textarea
					if( ( !$field->wysiwyg || $field->fieldType != 2 ) )
						$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.value == '') {";
						if( $config->key( "edit_form", "show_not_selected", true ) ) {
							$this->jsValidator .= "\n\t\t\t document.getElementById( '{$field->fieldname}' ).style.border = '3px solid #FF0000';";
						}
						$this->jsValidator = $this->jsValidator."\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."'  );" .
											"\n\t\t\t return false;" .
											"\n\t\t }";
					break;
				case 5: //is list
					$this->jsValidator = $this->jsValidator."\n\t\t else if (form.{$field->fieldname}.selectedIndex == 0) {";
					if( $config->key( "edit_form", "show_not_selected", true ) ) {
						$this->jsValidator .= "\n\t\t\t document.getElementById( '{$field->fieldname}' ).style.border = '3px solid #FF0000';";
					}
					$this->jsValidator .= "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										 "\n\t\t\t return false;" .
										 "\n\t\t }";
					break;
				case 6: // is textfield
					static $fn = false;
					if(!$fn) {
						$config->addCustomScript('
						function  checkCheckBoxes( fname ) {
							var e = document.getElementsByName( fname );
							var ch = false;
							for( i = 0; i < e.length; i++ )
								ch = e[i].checked == true ? e[i].checked : ch;
							return ch;
						}
						');
						$fn = true;
					}
					$this->jsValidator = $this->jsValidator."\n\t\t else if ( !checkCheckBoxes(\"{$field->fieldname}[]\") ) {";
					if( $config->key( "edit_form", "show_not_selected", true ) ) {
						$this->jsValidator .= "\n\t\t\t document.getElementById( '{$field->fieldname}' ).style.border = '3px solid #FF0000';";
					}
					$this->jsValidator .= "\n\t\t\t alert( '"._SOBI2_FORM_JS_ALL_REQUIRED_FIELDS."' );" .
										 "\n\t\t\t return false;" .
										 "\n\t\t }";
					break;
				default:
					break;
			}
		}
    }
    /**
     * extending html code of disable/enable switcher (checkbox) if the field should be payed
     *
     * @param int $field
     * @return string
     */
    function extendHtml($field)
    {
    	$config =& sobi2Config::getInstance();
    	$extendet = null;
    	$field->fieldname = $config->getSobiStr($field->fieldname);
    	$field->label = $config->getSobiStr($field->label);
    	if ( !$field->is_free && $field->fieldType == 3 ) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
			if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$extendet = "\n\t\t\t<td>" .
	    					"<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = 1;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = -1;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" .
	    					"<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
			}
			else {
	    		$extendet = "\n\t\t\t<td></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
			}
	    }
    	elseif ( !$field->is_free && $field->fieldType == 6 ) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$extendet = "\n\t\t\t<td>" .
	    					"<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'var e = document.getElementsByName(\"{$field->fieldname}[]\");" .
	    					"\n\t\t\t\t" .
	    					"if(this.checked) {" .
	    					"\n\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].disabled = false; }" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].checked = false; }" .
	    					"\n\t\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].disabled = true; }" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" .
	    					"<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
    		}
			else {
	    		$extendet = "\n\t\t\t<td></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
			}
    	}
    	else if (!$field->is_free && !$field->wysiwyg) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$extendet = "\n\t\t\t<td>" .
	    					"<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" .
	    					"<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
    		}
			else {
	    		$extendet = "\n\t\t\t<td></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
			}
    	}
    	else if (!$field->is_free && $field->wysiwyg) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$extendet = "\n\t\t\t<td>" .
	    					"<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"\"if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = '';" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t\t" .
	    					"setTextareaToTinyMCE('{$field->fieldname}')" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"unsetTextareaToTinyMCE('{$field->fieldname}');" .
	    					"\n\t\t\t\t" .
	    					"{$field->fieldname}.value = '';" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t\t" .
	    					"}\"" .
	    					"/>" .
	    					"<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
    		}
			else {
	    		$extendet = "\n\t\t\t<td></td>" .
	    					"\n\t\t\t<td>" .
	    					"<span class = \"sobi2FormNotFreeLabel\">" .
	    					""._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}" .
	    					"</span>" .
	    					"\n\t\t\t</td>";
			}
    	}
    	return $extendet;
    }

    /**
     * extending html code of disable/enable switcher (checkbox) if the field should be payed
     *
     * @param int $field
     * @return string
     */
    function extendHtmlTpl ( $field, &$html )
    {
    	$config =& sobi2Config::getInstance();
    	$field->fieldname = $config->getSobiStr($field->fieldname);
    	$field->label = $config->getSobiStr($field->label);
    	$html['price'] = $field->payment;
    	if ( !$field->is_free && $field->fieldType == 3 ) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
			if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$html['box'] = "<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = 1;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = -1;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		$html['box_label'] = "<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label></td>" ;
	    		$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}</span>";
			}
			else {
	    		$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">" ._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment} </span>";
			}
	    }
    	elseif ( !$field->is_free && $field->fieldType == 6 ) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$html['box'] = "<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'var e = document.getElementsByName(\"{$field->fieldname}[]\");" .
	    					"\n\t\t\t\t" .
	    					"if(this.checked) {" .
	    					"\n\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].disabled = false; }" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].checked = false; }" .
	    					"\n\t\t\t\t\t" .
	    					"for( i = 0; i < e.length; i++) { e[i].disabled = true; }" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>";
	    		$html['box_label'] = "<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label>";
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}</span>";
    		 }
			else {
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">" ._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment} </span>";
			}
    	}
    	elseif (!$field->is_free && !$field->wysiwyg) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$html['box'] = "<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"'if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = \"\" ;" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = \"\";" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t" .
	    					"}'" .
	    					"/>" ;
	    		$html['box_label'] = "<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label>";
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}</span>";
    		}
			else {
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">" ._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment} </span>";
			}
    	}
    	elseif (!$field->is_free && $field->wysiwyg) {
    		$field->payment = $config->getCurrencyFormat($field->payment);
    		if( $config->key( "edit_form", "show_payment_checkboxes", true ) ) {
	    		$html['box'] = "<input type=\"checkbox\" name=\"{$field->fieldname}_on\" id=\"{$field->fieldname}_on\" value=\"\" onclick= " .
	    					"\n\t\t\t\t" .
	    					"\"if(this.checked) {" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.value = '';" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = false" .
	    					"\n\t\t\t\t\t" .
	    					"setTextareaToTinyMCE('{$field->fieldname}')" .
	    					"\n\t\t\t\t" .
	    					"}" .
	    					"\n\t\t\t\t" .
	    					"else {" .
	    					"\n\t\t\t\t\t" .
	    					"unsetTextareaToTinyMCE('{$field->fieldname}');" .
	    					"\n\t\t\t\t" .
	    					"{$field->fieldname}.value = '';" .
	    					"\n\t\t\t\t\t" .
	    					"{$field->fieldname}.disabled = true" .
	    					"\n\t\t\t\t\t" .
	    					"}\"" .
	    					"/>";
	    		$html['box_label'] = "<label class=\"{$field->fieldname}\" for=\"{$field->fieldname}_on\">"._SOBI2_ADD_U." {$field->label}</label>";
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">"._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment}</span>";
    		}
			else {
				$html['explanation'] = "<span class = \"sobi2FormNotFreeLabel\">" ._SOBI2_FORM_NOT_FREE_OPTION." "._SOBI2_FORM_PRICE_IS.": {$field->payment} </span>";
			}
    	}
    }
    /**
     *
     */
    function getCategories()
    {
    	$config =& sobi2Config::getInstance();
    	$database = &$config->getDb();
		if($this->item && is_a($this->item, "sobi2")) {
			$script = "
			<script type=\"text/javascript\">
			<!--
			/* <![CDATA[ */
				if(document.getElementById('sobi2SlectedCats').length >= {$config->maxCatsForEntry} ) {
					document.getElementById('sobi2AddCatBt').disabled = true;
				}

			/* ]]> */
			// -->
			</script>
			";
		}
		else {
			$script = null;
		}
    	if(!$config->useSigsiuTree) {
	    	$dtreePath = "{$config->liveSite}/components/com_sobi2/includes/dtree";
    		$config->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$dtreePath}/dtree.js\"></script>");
		}
    	$onSelctedCatJs = "\n<script type=\"text/javascript\">" .
						 "<!-- \n\n".
						 "/* <![CDATA[ */ \n\n".
    					  "\n\t" .
    					  "function onSelectedCat(intro, category, id) { " .
    					  "\n\t\t" .
    					  "var catInfo = document.createTextNode(intro);" .
    					  "\n\t\t" .
    					  "document.getElementById('catIntroText').removeChild(document.getElementById('catIntroText').firstChild);" .
    					  "\n\t\t" .
    					  "document.getElementById('catIntroText').appendChild(catInfo);" .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCat').value = category;" .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCatID').value = id;" .
    					  "\n\t }" .
    					  "\n\t" .
    					  "function addCategory() {" .
    					  "\n\t\t" .
    					  "\n\t\t\t if(document.getElementById('selectedCatID').value == -1) {" .
    					  "\n\t\t\t\t alert('"._SOBI2_FORM_JS_CAT_NO_PARENT_CAT."');" .
    					  "\n\t\t\t\t return false;" .
    					  "\n\t\t\t }" .
    					  "\n\t\t\t if(document.getElementById('selectedCatID').value == '') {" .
    					  "\n\t\t\t\t alert('"._SOBI2_FORM_SELECT_CATEGORY."');" .
    					  "\n\t\t\t\t return false;" .
    					  "\n\t\t\t }" .
    					  "for(var a = 0; a < document.getElementById('sobi2SlectedCatsID').length; ++a) {" .
    					  "\n\t\t\t" .
    					  "\n\t\t\t if(document.getElementById('selectedCatID').value == document.getElementById('sobi2SlectedCatsID')[a].value) {" .
    					  "\n\t\t\t\t alert('"._SOBI2_FORM_JS_CAT_ALLREADY_ADDED."');" .
    					  "\n\t\t\t\t return false;" .
    					  "\n\t\t\t }" .
    					  "\n\t\t }" .
    					  "\n\t\t " .
    					  "if( document.getElementById('sobi2SlectedCatsID').length >= ({$config->maxCatsForEntry} - 1) )" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2AddCatBt').disabled = true;" .
    					  "\n\t\t" .
    					  "newNode = new Option(document.getElementById('selectedCat').value, document.getElementById('selectedCat').value, true, true);" .
    					  "\n\t\t" .
    					  "newNodeID = new Option(document.getElementById('selectedCatID').value, document.getElementById('selectedCatID').value, true, true);" .
    					  "\n\t\t" .
    					  "if(document.getElementById('selectedCat').value != '')" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[document.getElementById('sobi2SlectedCats').length] = newNode;" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[document.getElementById('sobi2SlectedCatsID').length] = newNodeID;" .
    					  "\n\t\t\t" .
    					  "for(var a = 0; a < document.getElementById('sobi2SlectedCats').length - 1; ++a) {" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[a].selected = false;" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[a].selected = false;" .
    					  "\n\t\t }" .
    					  "\n\t }" .
    					  "\n\t" .
    					  "function removeCategory() {" .
    					  "\n\t\t" .
    					  "if(document.getElementById('sobi2SlectedCats').selectedIndex >= 0) {" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCats').options[document.getElementById('sobi2SlectedCats').selectedIndex] = null;" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2SlectedCatsID').options[document.getElementById('sobi2SlectedCatsID').selectedIndex] = null;" .
    					  "\n\t\t }" .
						  "if(document.getElementById('sobi2SlectedCats').length < ({$config->maxCatsForEntry} + 1) && document.getElementById('sobi2AddCatBt').disabled == true)" .
    					  "\n\t\t\t" .
    					  "document.getElementById('sobi2AddCatBt').disabled = false;" .
    					  "\n\t }" .
						"\n\t /* ]]> */" .
						"\n\t // -->" .
    					  "\n</script>";
    	$config->addCustomHeadTag( $onSelctedCatJs );
    	if($config->useSigsiuTree) {
    		sobi2Config::import("includes|SigsiuTree|SigsiuTree");
			$tree = new SigsiuTree($config->aTreeImages);
			$href = "javascript:onSelectedCat('{introtext}','{name}','{cid}')";
			if(!$config->allowAddingToParentCats) {
				$spHref = "javascript:onSelectedCat('{introtext}','{name}','-1' )";
			}
			else {
				$spHref = null;
			}
			$tree->init("SigsiuTreeForm", $href, "div","sobi2CatsForm", false, $spHref);
			$SigsiuTree = $tree->getTree();
    	}
    	else {
			$query = "SELECT `#__sobi2_cats_relations`.catid, parentid, name,  introtext,  ordering " .
	    			 "FROM `#__sobi2_cats_relations` " .
	    			 "LEFT JOIN `#__sobi2_categories` ON `#__sobi2_categories`.catid = `#__sobi2_cats_relations`.catid " .
	    			 "WHERE published = 1 ".
					 "ORDER BY {$config->catsOrdering}";
	    	$database->setQuery( $query );
	    	$this->categoryList = $database->loadObjectList();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
    	}
    	if(sizeof($this->categoryList) > 0 || $SigsiuTree) {
	    	$this->dTree = $this->dTree."" .
	    								"\n\t\t\t\t" .
	    								"<table id=\"sobi2FormCats\">" .
	    								"\n\t\t\t\t\t<tr id=\"sobi2FormCatsInfoRow\">" .
	    								"\n\t\t\t\t\t\t<td colspan=\"3\">" .
	    								"\n\t\t\t\t\t\t\t <p id=\"catsTitle\">" . _SOBI2_FORM_SELECT_CATEGORY . "</p>" .
	    								"\n\t\t\t\t\t\t\t <p id=\"catMsg\">" . _SOBI2_FORM_CAN_ADD_TO_NR_CATS .
	    								" </p>";



	    	if( array_sum( $config->catPrices) > 0 ) {
		    	$catsListPrices = "\n\t\t\t\t\t\t\t\t<ul id=\"sobi2FormCatsInfoRowList\">";
	    		$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t\t<li>" .
	    										  "\n\t\t\t\t\t\t\t\t\t\t" .
	    										  ""._SOBI2_FORM_CAT_1." "._SOBI2_IS_FREE_L."" .
	    										  "\n\t\t\t\t\t\t\t\t\t</li>";

		    	$limit = $config->maxCatsForEntry < 6 ? $config->maxCatsForEntry : count($config->catPrices);
				for($i = 2; $i < $limit + 1; $i++) {
		    		$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t\t<li>" .
		    										  "\n\t\t\t\t\t\t\t\t\t\t" .
		    										  _SOBI2_CATEGORY_H." {$i} ";

					if($config->catPrices[$i] == 0) {
						$catsListPrices = $catsListPrices._SOBI2_IS_FREE_L;
					}
					else {
						$config->catPrices[$i] = $config->getCurrencyFormat($config->catPrices[$i]);
						$catsListPrices = $catsListPrices." "._SOBI2_IS_NOT_FREE_L." "._SOBI2_COST_L.": ".$config->catPrices[$i];
					}
		    		$catsListPrices = $catsListPrices. "\n\t\t\t\t\t\t\t\t\t</li>";
		    	}
		    	$catsListPrices = $catsListPrices."\n\t\t\t\t\t\t\t\t</ul>";
		    	$this->dTree = $this->dTree.$catsListPrices;
	    	}
	    	$this->dTree = $this->dTree."" .
	    								"\n\t\t\t\t\t\t</td>" .
	    								"\n\t\t\t\t\t</tr>" .
	    								"\n\t\t\t\t\t<tr id=\"sobi2FormCatsTreeRow\">" ;
			$top = defined("_SOBI2_ADMIN") ? " style=\"vertical-align: top;\"" : null;
	    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t <td {$top}>";

	    	if(!isset($SigsiuTree)) {
		    	$this->dTree = $this->dTree."" .
		    					"\n<div class=\"dtree\">" .
		    					"\n<script type=\"text/javascript\">" .
		    					"\n\t" .
		    					"sobiCats = new dTree('sobiCats');" .
		    					"\n\t" .
		    					"sobiCats.add(0,-1,'"._SOBI2_CATEGORIES_H."');";

		    	foreach( $this->categoryList as $category ) {
						$category->name = $config->jsAddSlashes($config->getSobiStr($category->name));
						$category->introtext = $config->jsAddSlashes($config->getSobiStr($category->introtext));
						$category->introtext = str_replace('\"', "`", $category->introtext );
						$category->name = str_replace('\"', "`", $category->name );
						$category->introtext = str_replace('\'', "`", $category->introtext );
						$category->name = str_replace('\'', "`", $category->name );
						$category->name = str_replace('x26', "&", $category->name );
						$category->introtext = str_replace('x26', "&", $category->introtext );
						if($category->parentid == 1) {
							$category->parentid--;
						}
			    		$category->introtext = $config->getSobiStr($category->introtext);
			    		$category->name = $config->getSobiStr($category->name);
			    		if(!$config->allowAddingToParentCats && $config->catHasChild($category->catid)) {
			    			$href = "javascript:onSelectedCat(\'{$category->introtext}\',\'{$category->name}\',\'-1\' )";
			    		}
			    		else {
			    			$href = "javascript:onSelectedCat(\'{$category->introtext}\',\'{$category->name}\',\'{$category->catid}\' )";
			    		}
			    		$this->dTree = $this->dTree."\n\t sobiCats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/components/com_sobi2/images/folder.gif' ,'{$config->liveSite}/components/com_sobi2/images/folderopen.gif');";
			    	}
			    	$this->dTree = $this->dTree."\n\t document.write(sobiCats); \n </script> \n </div>";
	    	}
	    	else {
	    		$this->dTree .= $SigsiuTree;
	    	}
	    	$st = defined("_SOBI2_ADMIN") ? " style=\"vertical-align: top;\"" : "class=\"sobi2CatButtons\"";
	    	$this->dTree .= "\n\t\t\t\t\t\t</td>" .
				/* select and remove buttons */
		    		    				"\n\t\t\t\t\t\t<td {$st}>" .
		    		    				"\n\t\t\t\t\t\t\t <p><input title=\""._SOBI2_FORM_ADD_CAT_BT."\" type=\"button\" onclick=\"javascript:addCategory()\" class=\"button\" id=\"sobi2AddCatBt\" value=\"&gt;&gt;&gt;\"/></p>" .
		    		    				"\n\t\t\t\t\t\t\t <p><input title=\""._SOBI2_FORM_REMOVE_CAT_BT."\" type=\"button\" onclick=\"javascript:removeCategory()\" class=\"button\" id=\"sobi2RemoveCatBt\" value=\"&lt;&lt;&lt;\"/></p>" .
		    		    				"\n\t\t\t\t\t\t</td>" ;

				/* select list for selected categories */
				$st = defined("_SOBI2_ADMIN") ? " style=\"vertical-align: top;\"" : "class=\"sobi2CatSelected\"";
				$this->dTree = $this->dTree."\n\t\t\t\t\t\t<td {$st}>" ;
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t<p>\n\t\t\t\t\t\t\t<select id=\"sobi2SlectedCats\"  class=\"inputbox\" name=\"sobi2SlectedCats[]\" size=\"5\" onclick=\"S_catSelected(this.selectedIndex)\">";
		    	$emptyCat = $this->item ? null : "+1";

		    	$config->addCustomScript("
		    		function S_catSelected(index) {
		    			if( index < 0 ) { return false; }
		    			for(var a = 0; a < document.getElementById(\"sobi2SlectedCatsID\").length; ++a)
		    				document.getElementById(\"sobi2SlectedCatsID\")[a].selected=false;
		    			document.getElementById(\"sobi2SlectedCatsID\").options[index".$emptyCat."].selected=true;
		    		}
		    	");
		    	/*
		    	 * if editing existing entry add selected categories
		    	 */
		    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
		    		foreach($this->item->myCategories as $catid => $catname) {
		    			$catname = $config->getSobiStr($catname);
		    			$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t\t<option>{$catname}</option>";
		    		}
		    	}
		    	if( !$this->item ) {
		    		$this->dTree .= "\n\t\t\t\t\t\t\t\t<option style=\"display:none;\" id=\"sobiFormEmptyOpt\"></option>";
		    	}
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t</select>";
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t<select disabled=\"disabled\" multiple=\"multiple\" id=\"sobi2SlectedCatsID\" name=\"sobi2SlectedCatsID[]\" size=\"5\">";
		    	if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
		    		foreach($this->item->myCategories as $catid => $catname) {
		    			$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t\t<option>{$catid}</option>";
		    		}
		    	}
		    	if( !$this->item ) {
		    		$this->dTree .= "\n\t\t\t\t\t\t\t\t<option style=\"display:none;\"></option>";
		    	}
		    	$this->dTree = $this->dTree."\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t\t</p>\n\t\t\t\t\t\t</td>".
		    		    					"\n\t\t\t\t\t</tr>";

				$this->dTree = $this->dTree."\n\t\t\t\t\t<tr  id=\"sobi2FormCatsItroRow\">" .
		    		    				"\n\t\t\t\t\t\t<td colspan=\"3\">" .
	    								_SOBI2_FORM_SELECTED_CAT_DESC.
	    								"<p id=\"catIntroText\">&nbsp;</p>".
	    								"\n\t\t\t\t\t\t </td>".
		    							"\n\t\t\t\t\t </tr>" .
		    							"\n\t\t\t\t </table>{$script}";
    	}
    }
    /**
     * @param bool $onStart
     * @return string
     */
    function getPlugins( $onStart = false )
    {
    	$plugins = null;
    	$config =& sobi2Config::getInstance();
    	if($onStart) {
	    	if(count($config->S2_plugins)) {
	    		if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
	    			$sobiId = $this->item->id;
	    		}
	    		else {
	    			$sobiId = null;
	    		}
	    		foreach($config->S2_plugins as $id => $plugin) {
	    			if(method_exists($plugin,"editFormStart")) {
	    				$plugin->editFormStart($sobiId,$this->fields);
	    			}
	    		}
	    	}
		}
		else {
	    	if(count($config->S2_plugins)) {
	    		if( isset( $this->item ) && is_a( $this->item, "sobi2" ) ) {
	    			$sobiId = $this->item->id;
	    		}
	    		else {
	    			$sobiId = null;
	    		}
	    		foreach($config->S2_plugins as $id => $plugin) {
	    			if(method_exists($plugin,"editForm")) {
	    				$content = $plugin->editForm($sobiId,$this->formOuter);
	    			}
	    			if(isset($content) && $content) {
		    			if($plugin->name)
		    				$pluginName = $plugin->name;
		    			else
		    				$pluginName = $id;
		    			$row = "\n\t\t <div class=\"sobi2FormTabHeader\">{$pluginName}</div>";
		    			$row .= "\n\t\t <div class=\"sobi2FormtabContent\">{$content}</div>";
		    			$plugins .= $row;
	    			}
	    			unset($content);
	    		}
	    	}
		}
    	return $plugins;
    }

	/**
	 * @return string
	 */
	function createSecImg() {

    	$config =& sobi2Config::getInstance();
    	$database = &$config->getDb();

	    if(function_exists('imagegif'))	{
	    	$extension = 'gif';
	    }
	    else if(function_exists('imagejpeg')) {
	    	$extension = 'jpg';
	    }
	    else if(function_exists('imagepng')) {
	    	$extension = 'png';
	    }
	    else if(function_exists('ImageJPEG')) {
	    	$extension = 'JPG';
	    }
	    else if(function_exists('ImagePNG')) {
	    	$extension = 'PNG';
	    }
	    else if(function_exists('ImageGIF')) {
	    	$extension = 'GIF';
	    }
	    else {
	    	$statement = "UPDATE `#__sobi2_config` " .
	    			 "SET `configValue` = '0' " .
	    			 "WHERE (`configKey` = 'useSecurityCode')";
			$database->setQuery($statement);
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$extension = null;
	    }
		return $extension;
	}
}
?>