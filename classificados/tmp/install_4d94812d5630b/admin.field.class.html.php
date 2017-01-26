<?php
/**
* @version $Id: admin.field.class.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class fieldHtml {
    function editForm( &$field, $lang )
    {
    	$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config =& adminConfig::getInstance();
		$my	= &$config->getUser();
	    $values = $field->definedValues;

		$config->getEditForm();
		if(!$lang) {
			$lang = $config->sobi2Language;
		}
		$returnTask = "editFields";
		if($field->fieldid != 0) {
			if ($field->checked_out && $field->checked_out != $my->id && $field->checked_out_time > $config->checkOutTime) {
				sobi2Config::redirect( $sobi2AdminUrl.'&amp;task='.$returnTask, _SOBI2_FIELD_CHECKED_OUT );
			}
			else {
		    	$field->checkOutField($my->id);
			}
		    $title = "<small> "._SOBI2_TOOLBAR_EDIT." <small>[ {$field->fieldLabel} ] </small></small>";
		    $csvValues = null;
		    if( is_array( $values ) && !empty( $values ) ) {
			    foreach ($values as $opt => $value) {
			    	$csvValues .= $opt.":".$value.";\n";
			    }
		    }
		}
		else {
			$field->fieldname = "field_";
			$field->enabled = 1;
			$field->wysiwyg = 0;
			$field->CSSclass = "inputbox";
			$field->with_label = 0;
			$field->in_newline = 1;
			$field->preferred_size = 30;
			$field->is_required = 0;
			$field->is_free = 1;
			$field->isEditable = 1;
			$field->selectLabel = 0;
			$title = "<small> "._SOBI2_ADD_NEW_FIELD." </small>";
			$field->in_details = true;
			$field->displayed = false;
		}
		$fieldTypes = array();
		$fieldTypesJs = " onchange = \"customFieldReload(this.selectedIndex);\" ";
		$fieldTypes[] 	= sobiHTML::makeOption( 'inputbox', 'inputbox');
		$fieldTypes[] 	= sobiHTML::makeOption( 'textarea', 'textarea');
		$fieldTypes[] 	= sobiHTML::makeOption( 'list', 'select list');
		$fieldTypes[] 	= sobiHTML::makeOption( 'checkbox', 'checkbox');
		$fieldTypes[] 	= sobiHTML::makeOption( 'checkbox group', 'checkbox group');
		$fieldTypes[] 	= sobiHTML::makeOption( 'custom', 'text code');
		$fieldTypes[] 	= sobiHTML::makeOption( 'calendar', 'calendar');
		$fieldTypes 	= sobiHTML::selectList( $fieldTypes, 'field_type', 'size="1" class="text_area"'.$fieldTypesJs, 'value', 'text', $field->fieldType);

		$inSearch = array();
		$inSearch[] 	= sobiHTML::makeOption( '0', _SOBI2_NO_U);
		$inSearch[] 	= sobiHTML::makeOption( '1', _SOBI2_FIELD_SEARCH_SEARCH_IN);
		$inSearch[] 	= sobiHTML::makeOption( '2', _SOBI2_FIELD_SEARCH_SELECT_BOX);
		$inSearch 		= sobiHTML::selectList( $inSearch, 'field_in_search', 'size="1" class="text_area"', 'value', 'text', $field->in_search);


		$urlTypes = array();
		$urlTypes[] 	= sobiHTML::makeOption( '0', _SOBI2_NO_U);
		$urlTypes[] 	= sobiHTML::makeOption( '1', 'http');
		$urlTypes[] 	= sobiHTML::makeOption( '2', 'email');
		$urlTypes[] 	= sobiHTML::makeOption( '3', _SOBI2_FIELD_IMG);
		$urlTypes[] 	= sobiHTML::makeOption( '4', _SOBI2_FIELD_VIDEO);
		$urlTypes 		= sobiHTML::selectList( $urlTypes, 'field_is_url', 'size="1" class="text_area"', 'value', 'text', $field->isUrl);
		$config->loadOverlib();
    	if(defined("_JEXEC")) {
    		define("_SOBI2_ADM_PASSED", true);
    		include_once("toolbar.sobi2.php");
    	}
    	?>
		<script type="text/javascript">
		function customFieldReload(value) {
			if( value == 5 ) {
				document.getElementById('stdFieldSettings').style.display = "none";
				document.getElementById('customFieldSettings').style.display = "";
				document.getElementById('listValues').style.display = "none";
			}
			else if( value == 2 || value == 4 ) {
				document.getElementById('customFieldSettings').style.display = "none";
				document.getElementById('stdFieldSettings').style.display = "";
				document.getElementById('listValues').style.display = "";
				document.getElementById('sortHelp').innerHTML = '<?php echo _SOBI2_FIELDLIST_SORT_VALUES_EXPL;?>';
				document.getElementById('sortLab').innerHTML = '<?php echo _SOBI2_FIELDLIST_SORT_VALUES;?>';
				document.getElementById('selectLabelSwitchLabel').innerHTML = '<?php echo _SOBI2_FIELDLIST_ADD_SELECT_LABEL;?>';
				document.getElementById('selectLabelSwitchField').innerHTML = '<?php echo str_replace("\n", null, sobiHTML::yesnoRadioList( 'field_maxlength', 'class="inputbox"', $field->selectLabel)) ;?>';
				document.getElementById('selectLabelSwitchHelp').innerHTML =  '<?php echo _SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL;?>';
				document.getElementById('field_preferred_size').value = 1;
			}
			else {
				document.getElementById('stdFieldSettings').style.display = "";
				document.getElementById('customFieldSettings').style.display = "none";
				document.getElementById('listValues').style.display = "none";
				document.getElementById('sortHelp').innerHTML = '<?php echo _SOBI2_FIELD_USE_WYSIWYG_EXPL;?>';
				document.getElementById('sortLab').innerHTML = '<?php echo _SOBI2_FIELD_USE_WYSIWYG;?>';
				document.getElementById('selectLabelSwitchLabel').innerHTML = '<?php echo _SOBI2_FIELD_MAX_LENGTH;?>';
				document.getElementById('selectLabelSwitchField').innerHTML = '<input type="text" name="field_maxlength" style="text-align: right;" value="<?php echo $field->fieldChars; ?>" size="5" maxlength="10" class="text_area" />';
				document.getElementById('selectLabelSwitchHelp').innerHTML =  '<?php echo _SOBI2_FIELD_MAX_LENGTH_EXPL;?>';
			}
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			if ( form.name.value == "" ) {
				alert("<?php echo addslashes( _SOBI2_FIELD_WITHOUT_NAME ) ?>");
			}
			else {
				form.field_name.disabled = false;
				submitform(pressbutton);
			}
		}
    	var rowStyle = 0;
    	var S_valuesCounter = 0;
    	function addListValue() {
			addListCSV( true );
    		S_valuesCounter ++;
    		var optName = document.createElement("td");
			optName.innerHTML = '<input type="text" style="text-align:center" class="text_area" style="text-align:left;" name="listValueOptionValue[]" value="<?php echo $field->fieldname; echo $field->fieldid ? null : "temp" ?>_opt_' + S_valuesCounter + '" size="20" maxlength="150"/>';
			var optValue = document.createElement("td");
			optValue.innerHTML = '<input type="text" style="text-align:center" class="text_area" style="text-align:left;" name="listValueOptionName[]" value="" size="30" maxlength="150"/>';
			var delValue = document.createElement("td");
			delValue.innerHTML = '<input type="button" onclick="removeListValue(' + S_valuesCounter + ');" class="button" value="<?php echo _SOBI2_FIELDLIST_DELETE_VALUE_PAIR;?>"/>';

			var row = document.createElement("tr");
			var id =  document.createAttribute("id");
			id.nodeValue = "listOption_" + S_valuesCounter;
			row.setAttributeNode(id);
			row.appendChild(optName);
			row.appendChild(optValue);
			row.appendChild(delValue);

			row.className = "row"+rowStyle;
			var listValues = document.getElementById("listValues");
			listValues.appendChild(row);
			rowStyle = rowStyle ? 0: 1;
    	}
    	function removeListValue(id) {
    		document.getElementById("listOption_" + id).parentNode.removeChild(document.getElementById("listOption_" + id));
    	}
    	var csv = false;
    	function addListCSV( close ) {
			if(!csv && !close) {
	    		document.getElementById('csvList').style.display = "";
				document.getElementById('csvListExpl').style.display = "";
				document.getElementById('csvListSave').style.display = "";
				csv = true;
			}
			else {
	    		document.getElementById('csvList').style.display = "none";
				document.getElementById('csvListExpl').style.display = "none";
				document.getElementById('csvListSave').style.display = "none";
				csv = false;
			}
    	}
    </script>

			<form action="index2.php" method="post" name="adminForm">
			<table class="SobiAdminHeading">
				<tr>
					<th class="categories">
						<?php echo _SOBI2_FIELDS_MANAGER ?> <?php echo $title; ?>
					</th>
				</tr>
			</table>
			<table class="SobiAdminForm">
				<tr>
					<th colspan="2" style="text-align:left;"><?php echo _SOBI2_FIELD_DETAILS; ?></th>
					<th style="text-align:left;"><?php echo _SOBI2_FIELD_HELP; ?></th>
				</tr>
				<?php if(!$field->isEditable) { ?>
				<tr>
					<td colspan="3"><h2><?php echo _SOBI2_FIELD_NOT_EDITABLE_EXPL; ?></h2></td>
				</tr>
				<?php } ?>
				<tr class="row0">
					<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_NAME; ?> </td>
					<td style="vertical-align: top !important;" width="30%"><input type="text" name="field_name" value="<?php echo $field->fieldname; ?>" size="20" maxlength="40" class="text_area" <?php if(!$field->isEditable) echo "disabled"?>/></td>
					<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_NAME_EXPL; ?></td>
				</tr>
				<tr class="row1">
					<td style="vertical-align: top !important;" width="10%">
					<?php
						echo _SOBI2_FIELD_LABEL;
						$img = "administrator/components/com_sobi2/images/flags/{$lang}.gif";
						echo "&nbsp;";
						$txt =  _SOBI2_ALL_FIELDS_NAMES.$lang." "._SOBI2_LANGUAGE_L." "._SOBI2_ALL_FIELDS_NAMES2;
						echo sobiHTML::toolTip( $txt, _SOBI2_LANGUAGE_L, null, $img, "" );
					?>
					</td>
					<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_label" value="<?php echo $field->fieldLabel; ?>" size="20" maxlength="40" class="text_area" /></td>
					<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_LABEL_EXPL; ?></td>
				</tr>
				<tr class="row0">
					<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_TYPE; ?> </td>
					<td style="vertical-align: top !important;" width="10%"><?php echo $fieldTypes; ?></td>
					<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_TYPE_EXPL; ?></td>
				</tr>
				<tr class="row1">
					<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_ENABLED; ?> </td>
					<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_enabled', 'class="inputbox"', $field->enabled);?></td>
					<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_ENABLED_EXPL; ?></td>
				</tr>
				<tr class="row0">
					<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_ADM_ONLY; ?> </td>
					<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_displayed', 'class="inputbox"', $field->displayed);?></td>
					<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_ADM_ONLY_EXPL; ?></td>
				</tr>
				</table>

				<table class="SobiAdminForm" id="customFieldSettings" <?php if($field->fieldType != 'custom') { ?> style="display:none;" <?php } ?>>
					<tr style="display:none">
						<td colspan="2"></td>
						<td></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%" valign="top"><?php echo _SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE;?></td>
						<td style="vertical-align: top !important;" width="30%"><textarea name="field_custom_code" cols="70" rows="30" class="text_area" /><?php echo $field->customCode; ?></textarea></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE_EXPL; ?></td>
					</tr>
				</table>


				<table class="SobiAdminForm" id="stdFieldSettings" <?php if($field->fieldType == 'custom') { ?> style="display:none;" <?php } ?>>
					<tr style="display:none">
						<td colspan="2"></td>
						<td></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%" valign="top">
						<?php
							echo _SOBI2_FIELD_DESCRIPTION;
							echo "&nbsp;";
							$txt =  _SOBI2_ALL_FIELDS_NAMES.$lang." "._SOBI2_LANGUAGE_L." "._SOBI2_ALL_FIELDS_NAMES2;
							echo sobiHTML::toolTip( $txt, _SOBI2_LANGUAGE_L, null, $img, "" );
						?>
						</td>
						<td style="vertical-align: top !important;" width="30%"><textarea name="field_description" cols="40" rows="5" class="text_area" /><?php echo $field->description; ?></textarea></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_DESCRIPTION_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%" id="sortLab"><?php echo ($field->fieldType != 'list' && $field->fieldType != 'checkbox group') ? _SOBI2_FIELD_USE_WYSIWYG : _SOBI2_FIELDLIST_SORT_VALUES; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo ($field->fieldType != 'list' && $field->fieldType != 'checkbox group') ? sobiHTML::yesnoRadioList( 'field_wysiwyg', 'class="inputbox"', $field->wysiwyg) : sobiHTML::yesnoRadioList( 'field_wysiwyg', 'class="inputbox"', $field->sortValues);?></td>
						<td style="vertical-align: top !important;" id="sortHelp"><?php echo ($field->fieldType != 'list' && $field->fieldType != 'checkbox group') ? _SOBI2_FIELD_USE_WYSIWYG_EXPL : _SOBI2_FIELDLIST_SORT_VALUES_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_CSS_CLASS; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_css_class" value="<?php echo $field->CSSclass; ?>" size="20" maxlength="40" class="text_area" /></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_CSS_CLASS_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_IN_NEW_LINE; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_in_newline', 'class="inputbox"', $field->in_newline);?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_IN_NEW_LINE_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_WITH_LABEL; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_with_label', 'class="inputbox"', $field->with_label);?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_WITH_LABEL_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_PREFERRED_SIZE; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_preferred_size" id="field_preferred_size" style="text-align: right;" value="<?php echo $field->preferred_size; ?>" size="5" maxlength="10" class="text_area" /></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_PREFERRED_SIZE_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td id="selectLabelSwitchLabel" style="vertical-align: top !important;" width="10%"><?php echo $field->fieldType != "list" ? _SOBI2_FIELD_MAX_LENGTH : _SOBI2_FIELDLIST_ADD_SELECT_LABEL; ?> </td>
						<td id="selectLabelSwitchField" style="vertical-align: top !important;" width="10%"><?php echo $field->fieldType != "list" ? '<input type="text" name="field_maxlength" style="text-align: right;" value="'. $field->fieldChars .'" size="5" maxlength="10" class="text_area" />' : sobiHTML::yesnoRadioList( 'field_maxlength', 'class="inputbox"', $field->selectLabel); ?></td>
						<td id="selectLabelSwitchHelp" style="vertical-align: top !important;"><?php echo $field->fieldType != "list" ? _SOBI2_FIELD_MAX_LENGTH_EXPL : _SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_ROWS; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_rows" style="text-align: right;" value="<?php echo $field->fieldRows; ?>" size="5" maxlength="10" class="text_area" /></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_ROWS_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_COLS; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_cols" style="text-align: right;" value="<?php echo $field->fieldColumns; ?>" size="5" maxlength="10" class="text_area" /></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_COLS_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_REQUIRED; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_required', 'class="inputbox"', $field->is_required);?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_REQUIRED_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_FREE; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_free', 'class="inputbox"', $field->is_free);?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_FREE_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_PAYMENT; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><input type="text" name="field_payment" style="text-align: right;" value="<?php echo number_format($field->payment, 2, $config->curencyDecSeparator, ' '); ?>" size="10" maxlength="40" class="text_area" /> <?php echo $config->currency; ?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_PAYMENT_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_DISPLAYING; ?> </td>
						<td style="vertical-align: top !important;" width="10%">
	  						<input type="checkbox" name="field_in_vcard" id="field_in_vcard" value="1"  onclick="document.adminForm.field_not_displayed.checked = false"<?php if($field->in_vcard) echo "checked"?> />
	  						<label for="field_in_vcard"><?php echo _SOBI2_FIELD_IN_VCARD; ?></label>
	  						&nbsp;&nbsp;
	  						<input type="checkbox" name="field_in_details" id="field_in_details" value="1" onclick="document.adminForm.field_not_displayed.checked = false" <?php if($field->in_details) echo "checked"?>/>
	  						<label for="field_in_vcard"><?php echo _SOBI2_FIELD_IN_DETAILS; ?></label>
	  						&nbsp;&nbsp;
	  						<input type="checkbox" name="field_not_displayed" id="field_not_displayed" value="1" onclick="document.adminForm.field_in_details.checked = false; document.adminForm.field_in_vcard.checked = false;" <?php if(!$field->in_details && !$field->in_vcard) echo "checked"?>/>
	  						<label for="field_in_vcard"><?php echo _SOBI2_FIELD_DO_NOT_DISPLAY; ?></label>
						</td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_DISPLAYING_EXPL; ?></td>
					</tr>
					<tr class="row1">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_IS_URL; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo $urlTypes;?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_IS_URL_EXPL; ?></td>
					</tr>
					<tr class="row0">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELD_IN_SEARCH; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo $inSearch;?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELD_IN_SEARCH_EXPL; ?></td>
					</tr>
					<?php if(!$field->isEditable) {	?>
						<script type="text/javascript">
							document.adminForm.field_type.disabled = true;
							document.adminForm.field_is_url.disabled = true;
						</script>
	  				<?php } ?>
				</table>
				<table class="SobiAdminForm" id="listValues" <?php if($field->fieldType != 'list' && $field->fieldType != 'checkbox group') { ?> style="display:none;" <?php } ?>>
					<tr>
						<th colspan="3" style="text-align:left;">
							<?php echo _SOBI2_FIELDLIST_LIST_OF_VALUES; ?>
							<?php
								$img = "administrator/components/com_sobi2/images/flags/{$lang}.gif";
								echo "&nbsp;";
								$txt =  _SOBI2_ALL_FIELDS_NAMES.$lang." "._SOBI2_LANGUAGE_L." "._SOBI2_ALL_FIELDS_NAMES2;
								echo sobiHTML::toolTip( $txt, _SOBI2_LANGUAGE_L, null, $img, "" );
							?>
							&nbsp; &nbsp;
							<input type="button" onclick="addListValue();" class="button" value="<?php echo _SOBI2_FIELDLIST_NEW_VALUE_PAIR;?>"/>
							&nbsp; &nbsp;
							<input type="button" onclick="addListCSV();" class="button" value="<?php echo _SOBI2_FIELDLIST_CSV_LIST;?>"/>
						</th>
					</tr>
					<tr class="row0" style="border-bottom:1px; display:none;" id="csvListExpl">
						<td style="vertical-align: top !important;" colspan="3" valign="top"><?php echo _SOBI2_FIELDLIST_CSV_LIST_EXPL; ?></td>
					</tr>
					<tr class="row1" style="border-bottom:1px; display:none;" id="csvListSave">
						<td style="vertical-align: top !important;" width="10%"><?php echo _SOBI2_FIELDLIST_CSV_SAVE; ?> </td>
						<td style="vertical-align: top !important;" width="10%"><?php echo sobiHTML::yesnoRadioList( 'field_savecsv', 'class="inputbox"', 0);?></td>
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELDLIST_CSV_SAVE_EXPL; ?></td>
					</tr>
					<tr class="row0" style="border-bottom:1px; display:none;" id="csvList">
						<td style="vertical-align: top !important;"><?php echo _SOBI2_FIELDLIST_CSV_LIST;?></td>
						<td style="vertical-align: top !important;" width="70%" colspan="2" valign="top">
							<textarea cols="50" rows="15" name="csvValues" class="text_area"><?php echo isset($csvValues) ? $csvValues : null; ?></textarea>
						</td>
					</tr>
					<tr class="row1" style="border-bottom:1px;">
						<td style="vertical-align: top !important;" width="30%" valign="top"><b><?php echo _SOBI2_FIELDLIST_OPT_NAME; ?></b></td>
						<td style="vertical-align: top !important;" width="30%" valign="top"><b><?php echo _SOBI2_FIELDLIST_OPT_VALUE; ?></b></td>
						<td style="vertical-align: top !important;"" valign="top"></td>
					</tr>
					<?php
						$c = 0;
						if(is_array($values) && !(empty($values))) {
							foreach ($values as $opt => $value) {
								$c++;
					?>
					<tr class="row<?php echo $c%2 ? 0 : 1;?>" id="listOption_<?php echo $c;?>">
						<td style="vertical-align: top !important;" width="30%" valign="top"><?php echo $opt;?><input type="hidden" name="listValueOptionValue[]" value="<?php echo $opt;?>" /></td>
						<td style="vertical-align: top !important;" width="30%"><input type="text" style="text-align:center" class="text_area" style="text-align:left;" name="listValueOptionName[]" value="<?php echo $value; ?>" size="30" maxlength="150"/></td>
						<td style="vertical-align: top !important;"><input type="button" onclick="removeListValue(<?php echo $c;?>);" class="button" value="<?php echo _SOBI2_FIELDLIST_DELETE_VALUE_PAIR;?>"/></td>
					</tr>
					<?php	} ?>
					<script type="text/javascript">S_valuesCounter = <?php echo $c;?></script>
					<?php } ?>
				</table>
				<?php
					if(!empty($config->S2_plugins)) {
						foreach ($config->S2_plugins as $plugin) {
							if(method_exists($plugin,"onEditField")) {
								$plugin->onEditField();
							}
						}
					}
				?>
				<br/>
				<br/>
				<br/>
			</div>
			<input type="hidden" name="option" value="com_sobi2" />
			<input type="hidden" name="editing" value="field" />
			<input type="hidden" name="returnTask" value="<?php echo $returnTask ?>"/>
			<input type="hidden" name="fieldId" value="<?php echo $field->fieldid ?>"/>
			<input type="hidden" name="task" value="com_sobi2" />
			<input type="hidden" name="slang" value="<?php echo $lang; ?>" />
    	</form>
    	<?php
    }
	function fieldsListing( $lang=null )
	{
		$no_html = sobi2Config::request($_REQUEST, "no_html", 0);;
		$config =& adminConfig::getInstance();
		$sobi2AdminUrl = "index2.php?option=com_sobi2";

		if(!$lang) {
			$lang = $config->sobi2Language;
		}

		$fields = fieldHtml::getFields($lang);
		if(!$no_html) {
		?>
		<script  type='text/javascript' src='<?php echo $config->liveSite; ?>/administrator/components/com_sobi2/includes/advajax.js'></script>
		<script type="text/javascript">
		function Sloader_start() {
			document.getElementById("sProgressMsg").innerHTML = "<?php echo _SOBI2_PLEASE_WAIT ?>";
			document.getElementById("sProgressbar").innerHTML = "<img style='border: solid 1px;' src='<?php echo $config->liveSite ?>/administrator/components/com_sobi2/images/progress.gif' alt='progress' title='progress'/>";
		}
		function Sloader_stop() {
			document.getElementById("sProgressMsg").innerHTML = "<?php echo _SOBI2_READY;?>";
			document.getElementById("sProgressbar").innerHTML = "";
		}
		function changeLang(slang) {
			advAJAX.get({
			    url: "index2.php",
				parameters : {
				      "no_html" : "1",
				      "option" : "com_sobi2",
				      "task" : "editFields",
				      "slang" : slang
				},
				onInitialization : function() {
					Sloader_start();
				},
			    onSuccess : function(obj) {
			        Sloader_stop();
			        document.getElementById("fieldsList").innerHTML = obj.responseText;
			        semaphor = 0;
			    },
			    onError : function(obj) { alert("Error: " + obj.status); }
			});
		}
			function sobi2CheckAll( n, fldName ) {
			  if (!fldName) {
			     fldName = 'sField';
			  }
				var f = document.adminForm;
				var c = f.toggleItems.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					cb = eval( 'f.' + fldName + '' + i );
					if (cb) {
						cb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.boxchecked.value = n2;
				} else {
					document.adminForm.boxchecked.value = 0;
				}
			}
			function sobi2CheckAll_button( n ) {
				for ( var j = 0; j <= n; j++ ) {
					box = eval( "document.adminForm.sField" + j );
					if ( box ) {
						if ( box.checked == false ) {
							box.checked = true;
						}
					} else {
						alert("cannot change the order of field, as an field in the list is `Checked Out`");
						return;
					}
				}
				submitform('savefieldsorder');
			}
		</script>
 		<?php } ?>
 		<div id="fieldsList">
    		<form action="index2.php" method="post" name="adminForm">
    		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
    			<tr>
    				<th class="edit"><?php echo _SOBI2_FIELDS_MANAGER?></th>
    			</tr>
    		</table>
    		<table>
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>&nbsp;&nbsp;<?php echo $config->getLanguages(true,$lang, 'class="inputbox" onchange="changeLang(this.options[this.options.selectedIndex].value);"'); ?>
				</td>
				<td id="sProgressMsg"></td>
				<td id="sProgressbar"></td>
			</tr>
    		</table>
			    		<table class="SobiAdminList">
			    			<tr>
			    				<th width="10" align="left">
			    					#
			    				</th>
								<th width="20">
									<input type="checkbox" name="toggleItems" value="" onClick="sobi2CheckAll(<?php echo count($fields);?>);" />
								</th>
								<th class="title">
									<?php
										echo _SOBI2_FIELD_LABEL;
										$img = "administrator/components/com_sobi2/images/flags/{$lang}.gif";
										echo "&nbsp;";
										$txt =  _SOBI2_ALL_FIELDS_NAMES.$lang." "._SOBI2_LANGUAGE_L." "._SOBI2_ALL_FIELDS_NAMES2;
										echo sobiHTML::toolTip( $txt, _SOBI2_LANGUAGE_L, null, $img, "" );
									?>
								</th>
								<th align="center" width="20px">
									<?php echo _SOBI2_FIELD_ENABLED?>
								</th>
								<th align="center" width="100px">
									<?php echo _SOBI2_FIELD_TYPE?>
								</th>
								<th align="center" width="100px">
									<?php echo _SOBI2_FIELD_FREE?>
								</th>
								<th align="center" width="20px">
									<?php echo _SOBI2_FIELD_REQUIRED?>
								</th>
								<th align="center" width="10%">
									<?php echo _SOBI2_FIELD_IN_VCARD?>
								</th>
								<th align="center" width="10%">
									<?php echo _SOBI2_FIELD_IN_DETAILS?>
								</th>
								<th align="center" colspan="2" width="5%">
									<?php echo _SOBI2_REORDER?>
								</th>
								<th align="right" width="5px">
									<?php echo _SOBI2_ORDER?>
								</th>
								<th align="left" width="5px">
									<a href="javascript: sobi2CheckAll_button( <?php echo count($fields)-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
								</th>
								<th align="center" width="5%">
									ID
								</th>
			    			</tr>
		<?php
			$count = 0;
			foreach($fields as $field) {
				$count++;
	    		switch ($field->fieldType) {
	    			case '1':
	    				$field->fieldType = 'inputbox';
	    			break;

	    			case '2':
	    				$field->fieldType = 'textarea';
	    			break;

	    			case '3':
	    				$field->fieldType = 'checkbox';
	    			break;

	    			case '4':
	    				$field->fieldType = 'custom';
	    			break;

	    			case '5':
	    				$field->fieldType = 'list';
	    			break;

	    			case '6':
	    				$field->fieldType = 'checkbox group';
	    			break;

	    			case '7':
	    				$field->fieldType = 'calendar';
	    			break;
	    		}
				$field->isEditable = ADM_HTML_SOBI::EditableFieldProcessing($field, $count-1);
				$field->checked_out = ADM_HTML_SOBI::CheckedOutProcessing($field, $count-1, 'sField');
				$field->is_free = ADM_HTML_SOBI::FreeFieldProcessing($field, $count-1);
				$field->published = ADM_HTML_SOBI::EnabledProcessing($field, $count-1);
				$field->is_required = ADM_HTML_SOBI::RequiredFieldProcessing($field, $count-1);
				$field->in_vcard = ADM_HTML_SOBI::SViewFieldProcessing($field, $count-1);
				$field->in_details = ADM_HTML_SOBI::DViewFieldProcessing($field, $count-1);
		?>
				<tr class="row<?php echo $count%2;?>">
			    				<td width="10" align="left">
			    					<?php echo $count; ?>
			    				</td>
								<td align="center" width="20">
									<?php echo $field->checked_out; ?>
								</td>
								<td>
									<a href="<?php echo $sobi2AdminUrl;?>&amp;slang=<?php echo $lang; ?>&amp;task=editField&amp;sField=<?php echo $field->id; ?>&amp;hidemainmenu=1">
									<?php echo $config->getSobiStr($field->label)." (".$config->getSobiStr($field->name).")"; ?>
									</a>
								</td>
								<td align="center" width="30">
									<?php echo $field->published ?>
								</td>
								<td align="center" width="150">
									<?php echo $field->fieldType ?>
								</td>
								<td align="center" width="30">
									<?php echo $field->is_free ?>
								</td>
								<td align="center" width="30">
									<?php echo $field->is_required ?>
								</td>
								<td align="center" width="30">
									<?php echo $field->in_vcard ?>
								</td>
								<td align="center" width="30">
									<?php echo $field->in_details ?>
								</td>
								<td align="center">
									<?php echo ADM_HTML_SOBI::orderUpIcon($count-1, true, 'fieldup', 'sField'); ?>
								</td>
								<td align="center">
									<?php echo ADM_HTML_SOBI::orderDownIcon( $count-1, count($fields), true, 'fielddown', 'sField'); ?>
								</td>
								<td align="center" colspan="2" width="10px">
									<input type="text" name="order[]" size="5" value="<?php echo $field->position; ?>" class="text_area" style="text-align: center" />
								</td>
								<td align="center" width="5%">
									<?php echo $field->id ?>
								</td>
			    			</tr>

		<?php
			}
		?>
			</table>
			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<input type="hidden" name="slang" value="<?php echo $lang; ?>"/>
			<input type="hidden" name="option" value="com_sobi2"/>
			<input type="hidden" name="returnTask" value="editFields"/>
			</form>
		</div>
		<?php
	}
	function getFields($lang = null)
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		if(!$lang)
			$lang = $config->sobi2Language;
		$return = array();
		$query = "SELECT field.fieldid AS id, fieldType, is_free, enabled AS published, " .
				"is_required, in_vcard, in_details, isEditable, " .
				"position, checked_out, checked_out AS editor, checked_out_time, " .
				"editor.name AS editor " .
				"FROM `#__sobi2_fields` AS field " .
				"LEFT JOIN #__users AS editor ON field.checked_out = editor.id ".
				"ORDER BY position";
    	$database->setQuery( $query );
		$fields = $database->loadObjectList();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		sobi2Config::import("admin.field.class", "adm");

		if(count($fields) != 0) {
			foreach($fields as $field) {
			$query = "SELECT langValue AS label, langKey AS name FROM `#__sobi2_language` " .
						 "WHERE `sobi2Lang` = '{$lang}' AND `fieldid` = {$field->id} AND sobi2Section != 'field_opt' ";
				$database->setQuery( $query );
				$labels = null;
				if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
					$labels = $database->loadObject();
				}
		    	else {
		    		$database->loadObject( $labels );
		    	}
				if($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				if(!$labels) {
					$query = "SELECT langValue AS label, langKey AS name FROM `#__sobi2_language` " .
							 "WHERE `sobi2Lang` = 'english' AND `fieldid` = {$field->id} AND sobi2Section != 'field_opt' ";
					$database->setQuery( $query );
					if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
						$labels = $database->loadObject();
					}
			    	else {
			    		$database->loadObject( $labels );
			    	}
					if($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				$fieldRet = new tempField();
				$fieldRet->id  =  $field->id;
				$fieldRet->fieldType =  $field->fieldType;
				$fieldRet->is_free =  $field->is_free;
				$fieldRet->published =  $field->published;
				$fieldRet->is_required =  $field->is_required;
				$fieldRet->in_vcard =  $field->in_vcard;
				$fieldRet->in_details =  $field->in_details;
				$fieldRet->isEditable =  $field->isEditable;
				$fieldRet->position =  $field->position;
				$fieldRet->editor =  $field->editor;
				$fieldRet->checked_out_time =  $field->checked_out_time;
				$fieldRet->checked_out =  $field->checked_out;
				$fieldRet->label =  $labels->label;
				$fieldRet->name =  $labels->name;
				$return[] = $fieldRet;
			}
		}
    	return $return;
	}
}
?>