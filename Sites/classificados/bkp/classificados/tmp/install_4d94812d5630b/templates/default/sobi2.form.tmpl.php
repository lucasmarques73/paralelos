<?php
/**
* @version $Id: sobi2.form.tmpl.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

/*please do not remove this line */
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

/* ------------------------------------------------------------------------------
 * This is an example template for the Entry Form
 * ------------------------------------------------------------------------------
 */
?>
<?php
/* ------------------------------------------------------------------------------
 * Here are several standard free fields
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $screenTitle; ?>
<?php echo $requiredFieldsInfo; ?>
<?php echo $fields['EntryName']['label']; ?><?php echo $fields['EntryName']['field']; ?><br/>
<?php echo $fields['field_street']['label']; ?><?php echo $fields['field_street']['field']; ?><br/>
<?php echo $fields['field_postcode']['label']; ?><?php echo $fields['field_postcode']['field']; ?><br/>
<?php echo $fields['field_city']['label']; ?> <?php echo $fields['field_city']['field']; ?><br/>
<?php echo $fields['field_county']['label']; ?> <?php echo $fields['field_county']['field']; ?><br/>
<?php echo $fields['field_federal_state']['label']; ?> <?php echo $fields['field_federal_state']['field']; ?><br/>
<?php echo $fields['field_country']['label']; ?> <?php echo $fields['field_country']['field']; ?><br/>
<?php echo $fields['field_email']['label']; ?> <?php echo $fields['field_email']['field']; ?><br/>

<?php
/* ------------------------------------------------------------------------------
 * But if these are not free fields
 * @example these informations are in the following variables:
 * $fields['field_fieldname']['payment']['box'] - is the checkbox to activate the target field
 * $fields['field_fieldname']['payment']['box_label'] - is the label of this checkbox. A text like "add website"
 * $fields['field_fieldname']['payment']['explanation'] - explanation text. Something like "This option is not for free. It costs: 20$"
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $fields['field_website']['payment']['box']; ?>
<?php echo $fields['field_website']['payment']['box_label']; ?><br/>
<?php echo $fields['field_website']['payment']['explanation']; ?>
<?php echo $fields['field_website']['label']; ?> <?php echo $fields['field_website']['field']; ?><br/>

<?php
/** ------------------------------------------------------------------------------
 * Of course You can add the additional payment infos to all fields.
 * If the field is for free, nothing will be shown.
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $fields['field_contact_person']['payment']['box']; ?>
<?php echo $fields['field_contact_person']['payment']['box_label']; ?><br/>
<?php echo $fields['field_contact_person']['payment']['explanation']; ?>
<?php echo $fields['field_contact_person']['label']; ?> <?php echo $fields['field_contact_person']['field']; ?><br/>

<?php echo $fields['field_phone']['payment']['box']; ?>
<?php echo $fields['field_phone']['payment']['box_label']; ?><br/>
<?php echo $fields['field_phone']['payment']['explanation']; ?>
<?php echo $fields['field_phone']['label']; ?> <?php echo $fields['field_phone']['field']; ?><br/>

<?php echo $fields['field_fax']['payment']['box']; ?>
<?php echo $fields['field_fax']['payment']['box_label']; ?><br/>
<?php echo $fields['field_fax']['payment']['explanation']; ?>
<?php echo $fields['field_fax']['label']; ?> <?php echo $fields['field_fax']['field']; ?><br/>

<?php echo $fields['field_hotline']['payment']['box']; ?>
<?php echo $fields['field_hotline']['payment']['box_label']; ?><br/>
<?php echo $fields['field_hotline']['payment']['explanation']; ?>
<?php echo $fields['field_hotline']['label']; ?> <?php echo $fields['field_hotline']['field']; ?><br/>

<?php echo $fields['field_description']['payment']['box']; ?>
<?php echo $fields['field_description']['payment']['box_label']; ?><br/>
<?php echo $fields['field_description']['payment']['explanation']; ?>
<?php echo $fields['field_description']['label']; ?> <?php echo $fields['field_description']['field']; ?><br/>

<?php
/* ------------------------------------------------------------------------------
 * Now several special SOBI2 fields
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $fields['Metakeys']['label']; ?><?php echo $fields['Metakeys']['field']; ?><br/>
<?php echo $fields['MetaDesc']['label']; ?><?php echo $fields['MetaDesc']['field']; ?><br/>

<?php
/* ------------------------------------------------------------------------------
 * The Image/Icon fields and the background chooser are splitted in two fields. One is the input field, the other is an already existing image
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $fields['ExistingImg']['label']; ?><?php echo $fields['ExistingImg']['field']; ?><br/>
<?php echo $fields['ImgField']['payment']['box']; ?>
<?php echo $fields['ImgField']['payment']['box_label']; ?><br/>
<?php echo $fields['ImgField']['payment']['explanation']; ?>
<?php echo $fields['ImgField']['label']; ?> <?php echo $fields['ImgField']['field']; ?><br/>

<?php echo $fields['ExistingIco']['label']; ?><?php echo $fields['ExistingIco']['field']; ?><br/>
<?php echo $fields['IcoField']['payment']['box']; ?>
<?php echo $fields['IcoField']['payment']['box_label']; ?><br/>
<?php echo $fields['IcoField']['payment']['explanation']; ?>
<?php echo $fields['IcoField']['label']; ?> <?php echo $fields['IcoField']['field']; ?><br/>

<?php echo $fields['BackgroundChooser']['label']; ?><?php echo $fields['BackgroundChooser']['field']; ?><br/>
<?php echo $fields['BackgroundPreview']['label']; ?><?php echo $fields['BackgroundPreview']['field']; ?><br/>

<?php
/* ------------------------------------------------------------------------------
 * Let's show the category chooser now
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $catChooser; ?>

<?php
/* ------------------------------------------------------------------------------
 * Safety code is splitted in two fields too
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $fields['SafetyCodeImage']['label']; ?><?php echo $fields['SafetyCodeImage']['field']; ?><br/>
<?php echo $fields['SafetyCodeField']['label']; ?><?php echo $fields['SafetyCodeField']['field']; ?><br/>

<?php
/* ------------------------------------------------------------------------------
 * At least the entry rules confirmation
 * ------------------------------------------------------------------------------
 */
?>
<div id="accept_rules_row">
<?php echo $fields['EntryRules']['label']; ?><?php echo $fields['EntryRules']['field']; ?>
</div>

<?php
/* ------------------------------------------------------------------------------
 * And of course the buttons
 * ------------------------------------------------------------------------------
 */
?>
<?php echo $cancelButton; ?>
<?php echo $sendButton; ?><br/>
