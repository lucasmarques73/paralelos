<?php
/**
* @version $Id: default.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

/*
 * added (RC 2.9)
 */
defined('_CCOUNT_VISITED') or define('_CCOUNT_VISITED', '( visited %count% times )');
defined('_BACK') or define('_BACK', 'Back');

/*
 * added (RC 2.8.7.2)
 */
defined('_SOBI2_GOOGLEMAPS_LABEL') or define('_SOBI2_GOOGLEMAPS_LABEL', 'Labels');

/*
 * added (RC 2.8.7.1)
 */
defined('_PN_PREVIOUS') or define('_PN_PREVIOUS', 'Prev');
defined('_PN_START') or define('_PN_START', 'Start');
defined('_PN_NEXT') or define('_PN_NEXT', 'Next');
defined('_PN_END') or define('_PN_END', 'End');

/*
 * added (RC 2.8.7)
 */
defined('_SOBI2_RENEW_EXP_TXT') or define('_SOBI2_RENEW_EXP_TXT', 'This entry is expired for %days% days. Would you like to <a href="%href%" title="Renew this Entry Now">Renew this Entry Now</a> ?');

/*
 * added (RC 2.8.5)
 */
defined('_SOBI2_DEFAULT_TOOLTIP_TITLE') or define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Tip');
defined('_SOBI2_ENTRIES_LIMIT_REACHED') or define('_SOBI2_ENTRIES_LIMIT_REACHED', 'You have already added %count% entries. You can add a maximum of %limit% entries.');

/*
 * added (RC 2.8.4)
 */
defined('_SOBI2_RENEW_TPL_TXT') or define('_SOBI2_RENEW_TPL_TXT', 'This entry expires in %days% days. Would you like to <a href="%href%" title="Renew this Entry Now">Renew this Entry Now</a> ?');
defined('_SOBI2_RENEW_BT_NOW') or define('_SOBI2_RENEW_BT_NOW', 'Renew this Entry Now');
defined('_SOBI2_RENEW_HEADER') or define('_SOBI2_RENEW_HEADER', 'Renew Entry');
defined('_SOBI2_RENEW_EXPL') or define('_SOBI2_RENEW_EXPL', 'You are going to renew your entry ( %title% ). The entry will be prolongated for %days% days. It will expire at %date%');
defined('_SOBI2_RENEWED_EXPL') or define('_SOBI2_RENEWED_EXPL', 'Your entry ( %title% ) has been renewed for %days% days. The entry will expire at %date%');
defined('_SOBI2_PAY_DISCOUNT') or define('_SOBI2_PAY_DISCOUNT', 'Discount');
defined('_JS_SOBI2_QFIELD_NO_VALUE') or define('_JS_SOBI2_QFIELD_NO_VALUE', 'Missing data');
defined('_JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT') or define('_JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT', 'Double click to edit data');

/*
 * added (RC 2.8.1)
 */

defined('_SOBI2_NEW_LABEL') or define('_SOBI2_NEW_LABEL', 'New');
defined('_SOBI2_UPDATED_LABEL') or define('_SOBI2_UPDATED_LABEL', 'Updated');
defined('_SOBI2_HOT_LABEL') or define('_SOBI2_HOT_LABEL', 'Hot');

/*
 * added (RC 2.8.0)
 */
defined("_SOBI2_CALENDAR_LANG") || define("_SOBI2_CALENDAR_LANG", "en");
defined("_SOBI2_USER_OWN_LISTING") || define("_SOBI2_USER_OWN_LISTING", "%name%'s listings");
// use this line if  user (login) name should be used in "Show users listings" instead of the real name
//defined("_SOBI2_USER_OWN_LISTING") || define("_SOBI2_USER_OWN_LISTING", "%username%'s listings");
defined("_SOBI2_USER_OWN_NO_LISTING") || define("_SOBI2_USER_OWN_NO_LISTING", "No listings found for this user");

defined('_SOBI2_FIELDLIST_SELECT') or define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

defined('_SOBI2_ALPHA_HEADER') or define('_SOBI2_ALPHA_HEADER', 'Letter ');
defined('_SOBI2_ALPHA_CATS_WITH_LETTER') or define('_SOBI2_ALPHA_CATS_WITH_LETTER', 'Categories beginning with ');
defined('_SOBI2_ALPHA_ITEMS_WITH_LETTER') or define('_SOBI2_ALPHA_ITEMS_WITH_LETTER', 'Entries beginning with ');
defined('_SOBI2_ALPHA_LETTER') or define('_SOBI2_ALPHA_LETTER', 'Entries and Categories beginning with ');
defined('_SOBI2_TAGGED_HEADER') or define('_SOBI2_TAGGED_HEADER', 'Entries tagged with ');
defined('_SOBI2_ENTRIES_TAGGED_WITH') or define('_SOBI2_ENTRIES_TAGGED_WITH', 'Entries tagged with ');
defined('_SOBI2_ENTRY_TAGGED_WITH') or define('_SOBI2_ENTRY_TAGGED_WITH', 'Tags: ');
defined('_SOBI2_POPULAR_HEADER') or define('_SOBI2_POPULAR_HEADER', 'Most Popular');
defined('_SOBI2_POPULAR_LISTING') or define('_SOBI2_POPULAR_LISTING', 'Most Popular Entries');
defined('_SOBI2_POPULAR_CATS') or define('_SOBI2_POPULAR_CATS', 'Most Popular Categories');
defined('_SOBI2_UPDATED_HEADER') or define('_SOBI2_UPDATED_HEADER', 'Recently Updated Entries');
defined('_SOBI2_UPDATED_LISTING') or define('_SOBI2_UPDATED_LISTING', 'Recently Updated Entries');
defined('_SOBI2_NEW_LISTINGS_HEADER') or define('_SOBI2_NEW_LISTINGS_HEADER', 'New Entries');
defined('_SOBI2_NEW_LISTINGS_LISTING') or define('_SOBI2_NEW_LISTINGS_LISTING', 'New Entries');

defined('_SEARCH_BOX') or define('_SEARCH_BOX', 'Search ... ');
defined('_SOBI2_SEARCH_RESET_FORM') or define('_SOBI2_SEARCH_RESET_FORM', 'Clear Selections');
defined('_SOBI2_SEARCH_RESET_FORM_TITLE') or define('_SOBI2_SEARCH_RESET_FORM_TITLE', 'Clear search form selections');

/*
 * added 26.07.2007 (RC 2.7.4)
 */
defined('_SOBI2_SEARCH_CAT_REMOVED') or define('_SOBI2_SEARCH_CAT_REMOVED', 'Selected category has been removed');
defined('_SOBI2_SEARCH_TOOGLE_EXTENDED') or define('_SOBI2_SEARCH_TOOGLE_EXTENDED', 'Extended Search Options');
defined('_SOBI2_SEARCH_TOOGLE_CATS') or define('_SOBI2_SEARCH_TOOGLE_CATS', 'Select Category');
defined('_SOBI2_SEARCH_CATBOX_SELECT') or define('_SOBI2_SEARCH_CATBOX_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
defined('_SOBI2_SEARCH_BOX_SELECT') or define('_SOBI2_SEARCH_BOX_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

/*
 * added 16.06.2007 (RC 2.7.2)
 */
defined('_SOBI2_FILE_NOT_UPLOADED') or define('_SOBI2_FILE_NOT_UPLOADED', 'Could not upload file, please try again.');
defined('_SOBI2_FILE_UPLOADED') or define('_SOBI2_FILE_UPLOADED', 'File uploaded');
defined('_SOBI2_UPLOAD_FILE') or define('_SOBI2_UPLOAD_FILE', 'Upload File: ');
defined('_SOBI2_UPLOAD') or define('_SOBI2_UPLOAD', 'Upload');
defined('_SOBI2_UPLOAD_DISSALLOWED_FILETYPE') or define('_SOBI2_UPLOAD_DISSALLOWED_FILETYPE', 'Not an allowed file type');

/*
 * added 11.11.2006 (RC 2.5.4)
 */
defined('_SOBI2_NEW_ENTRY_AWAITING_APP') or define('_SOBI2_NEW_ENTRY_AWAITING_APP', " Your entry was added and awaiting approval.");

/*
 * added 26.10.2006 (RC 2.5)
 */
defined('_SOBI2_CHECKBOX_YES') or define('_SOBI2_CHECKBOX_YES', 'Yes');
defined('_SOBI2_CHECKBOX_NO') or define('_SOBI2_CHECKBOX_NO', 'No');
defined('_SOBI2_FORM_SELECT_BG') or define('_SOBI2_FORM_SELECT_BG', 'Select background image');
defined('_SOBI2_FORM_SELECT_BG_EXPL') or define('_SOBI2_FORM_SELECT_BG_EXPL', 'Select background image for details and cards view in category view.');
defined('_SOBI2_FORM_BG_PREVIEW') or define('_SOBI2_FORM_BG_PREVIEW', 'Background image preview');
defined('_SOBI2_NOT_LOGGED_FOR_DETAILS') or define('_SOBI2_NOT_LOGGED_FOR_DETAILS', 'You have to be an registered user and logged in to see this resource');
defined('_SOBI2_JS_NOT_LOGGED_FOR_DETAILS') or define('_SOBI2_JS_NOT_LOGGED_FOR_DETAILS', 'You have to be an registered user and logged in to see this resource');
defined('_SOBI2_SEARCH_INPUTBOX') or define('_SOBI2_SEARCH_INPUTBOX', _SEARCH_BOX);
defined('_SOBI2_SEARCH_ALL_ENTRIES') or define('_SOBI2_SEARCH_ALL_ENTRIES', 'Any entry');
/*
 * added 11.10.2006 (RC 2)
 */
defined('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT') or define('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'You cannot add an entry to a category having subcategories. Please select one of the subcategories.');
defined('_SOBI2_SUBCATS_IN_THIS_CAT') or define('_SOBI2_SUBCATS_IN_THIS_CAT', 'Number of Subcategories in this category: ');
defined('_SOBI2_SUBCATS_IN_CAT') or define('_SOBI2_SUBCATS_IN_CAT', 'Subcategories in ');
defined('_SOBI2_ITEMS_IN_THIS_CAT') or define('_SOBI2_ITEMS_IN_THIS_CAT', 'Number of Entries in this category: ');
defined('_SOBI2_ITEMS_IN_CAT') or define('_SOBI2_ITEMS_IN_CAT', 'Entries in ');
defined('_SOBI2_ITEMS_CATS_SEPARATOR') or define('_SOBI2_ITEMS_CATS_SEPARATOR', '/');

/*
 * added 02.10.2006 (RC 1)
 */
defined('_SOBI2_GOOGLEMAPS_GET_DIR') or define('_SOBI2_GOOGLEMAPS_GET_DIR', 'Get Directions');
defined('_SOBI2_GOOGLEMAPS_FROM') or define('_SOBI2_GOOGLEMAPS_FROM', 'From here');
defined('_SOBI2_GOOGLEMAPS_TO') or define('_SOBI2_GOOGLEMAPS_TO', 'To here');
defined('_SOBI2_GOOGLEMAPS_ADDR') or define('_SOBI2_GOOGLEMAPS_ADDR', 'Address: ');
defined('_SOBI2_GOOGLEMAPS_DIR') or define('_SOBI2_GOOGLEMAPS_DIR', 'Directions: ');

/*
 * added 26.09.2006 (Beta 2.2)
 */
 defined('_SOBI2_CANCEL') or define('_SOBI2_CANCEL', 'Cancel');

/*
 * added 23.09.2006 (Beta 2.1)
 */
defined('_SOBI2_SAVE_IMG_TO_BIG') or define('_SOBI2_SAVE_IMG_TO_BIG', 'Image file upload failed! Uploaded file was too big. File size is: ');
defined('_SOBI2_EF_MAX_FILE_SIZE') or define('_SOBI2_EF_MAX_FILE_SIZE', ' The file size should not be bigger than ');
defined('_SOBI2_EF_KB_FILE_SIZE') or define('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * General Labels
 */
defined('_SOBI2_SEND_L') or define('_SOBI2_SEND_L', 'Send');
defined('_SOBI2_ADD_U') or define('_SOBI2_ADD_U', 'Add');
defined('_SOBI2_CATEGORY_L') or define('_SOBI2_CATEGORY_L', 'category');
defined('_SOBI2_CATEGORY_H') or define('_SOBI2_CATEGORY_H', 'Category');
defined('_SOBI2_CATEGORIES_L') or define('_SOBI2_CATEGORIES_L', 'categories');
defined('_SOBI2_CATEGORIES_H') or define('_SOBI2_CATEGORIES_H', 'Categories');
defined('_SOBI2_IS_FREE_L') or define('_SOBI2_IS_FREE_L', 'is for free');
defined('_SOBI2_IS_NOT_FREE_L') or define('_SOBI2_IS_NOT_FREE_L', 'is not free. ');
defined('_SOBI2_COST_L') or define('_SOBI2_COST_L', 'It costs');
defined('_SOBI2_NOT_AUTH') or define('_SOBI2_NOT_AUTH', 'You are not authorized to see this page');
defined('_SOBI2_SELECT') or define('_SOBI2_SELECT', 'select');
defined('_SOBI2_SEARCH_H') or define('_SOBI2_SEARCH_H', 'Search');
defined('_SOBI2_ADD_NEW_ENTRY') or define('_SOBI2_ADD_NEW_ENTRY', 'Add Entry');
defined('_SOBI2_NUMBER_H') or define('_SOBI2_NUMBER_H', 'Number');
defined('_SOBI2_CONFIRM_DELETE') or define('_SOBI2_CONFIRM_DELETE', 'Do you really want to delete this entry? \n' .
								'Please notice that all data will be deleted irrevocably!');
defined('_SOBI2_SEND_MAIL') or define('_SOBI2_SEND_MAIL', 'Send Email');
defined('_SOBI2_VISIT_WEBSITE') or define('_SOBI2_VISIT_WEBSITE', 'Visit Website');
defined('_SOBI2_HITS') or define('_SOBI2_HITS', 'Hits: ');
defined('_SOBI2_DATE_ADDED') or define('_SOBI2_DATE_ADDED', 'Date added:');
defined('_SOBI2_NOT_LOGGED') or define('_SOBI2_NOT_LOGGED', '<h4>You are not logged in and therefore you cannot add an entry.</h4>');

defined('_SOBI2_NOT_LOGGED_CANNOT_EDIT') or define('_SOBI2_NOT_LOGGED_CANNOT_EDIT', '<h4>You are not logged in</h4>' .
		'<h4>You can add an entry, but you won\'t be able to edit your entry in the future.</h4>');
defined('_SOBI2_PLEASE_REGISTER_OR_LOGIN') or define('_SOBI2_PLEASE_REGISTER_OR_LOGIN', '<h4>Please login or register</h4>');


/*
 * Formular Labels
 */
defined('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY') or define('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Add New Entry');
defined('_SOBI2_FORM_TITLE_EDIT_ENTRY') or define('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Edit Entry');
defined('_SOBI2_FORM_YOUR_IMG_LABEL') or define('_SOBI2_FORM_YOUR_IMG_LABEL', 'Your ');
defined('_SOBI2_FORM_IMG_CHANGE_LABEL') or define('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Change ');
defined('_SOBI2_FORM_IMG_REMOVE_LABEL') or define('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remove ');
defined('_SOBI2_FORM_IMG_EXPL') or define('_SOBI2_FORM_IMG_EXPL', 'This image will be shown in details view.');
defined('_SOBI2_FORM_YOUR_ICO_LABEL') or define('_SOBI2_FORM_YOUR_ICO_LABEL', 'Your ');
defined('_SOBI2_FORM_ICO_CHANGE_LABEL') or define('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Change ');
defined('_SOBI2_FORM_ICO_REMOVE_LABEL') or define('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remove ');
defined('_SOBI2_FORM_ICO_EXPL') or define('_SOBI2_FORM_ICO_EXPL', 'This image will be shown in category view.');
defined('_SOBI2_FORM_SAFETY_CODE') or define('_SOBI2_FORM_SAFETY_CODE', 'Safety Code&nbsp;');
defined('_SOBI2_FORM_ENTER_SAFETY_CODE') or define('_SOBI2_FORM_ENTER_SAFETY_CODE', 'Please enter safety code');
defined('_SOBI2_FORM_NOT_FREE_OPTION') or define('_SOBI2_FORM_NOT_FREE_OPTION', 'This option is not free.');
defined('_SOBI2_FORM_SELECT_CATEGORY') or define('_SOBI2_FORM_SELECT_CATEGORY', 'Please Select a Category');
defined('_SOBI2_FORM_CAT_1') or define('_SOBI2_FORM_CAT_1', 'First category');
defined('_SOBI2_FORM_ADD_CAT_BT') or define('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_H);
defined('_SOBI2_FORM_REMOVE_CAT_BT') or define('_SOBI2_FORM_REMOVE_CAT_BT','Remove '._SOBI2_CATEGORY_H);
defined('_SOBI2_FORM_PRICE_IS') or define('_SOBI2_FORM_PRICE_IS', 'The price is');
defined('_SOBI2_FORM_FIELD_REQ_MARK') or define('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
defined('_SOBI2_FORM_FIELD_REQ_INFO') or define('_SOBI2_FORM_FIELD_REQ_INFO', 'All fields with '._SOBI2_FORM_FIELD_REQ_MARK.' are required.');
defined('_SOBI2_FORM_META_KEYS_LABEL') or define('_SOBI2_FORM_META_KEYS_LABEL', 'Meta Keywords');
defined('_SOBI2_FORM_META_KEYS_EXPL') or define('_SOBI2_FORM_META_KEYS_EXPL', 'The entered key words will be added to the Meta Tag Key word list.');
defined('_SOBI2_FORM_META_DESC_LABEL') or define('_SOBI2_FORM_META_DESC_LABEL', 'Meta Description');
defined('_SOBI2_FORM_META_DESC_EXPL') or define('_SOBI2_FORM_META_DESC_EXPL', 'The entered text will be added to the Meta Tag Description.');
defined('_SOBI2_FORM_JS_SELECT_CAT') or define('_SOBI2_FORM_JS_SELECT_CAT', 'Please select at least one category.');
defined('_SOBI2_FORM_JS_ACC_ENTRY_RULES') or define('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'You have to accept the terms of use.');
defined('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS') or define('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Please fill in all required fields.');
defined('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED') or define('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'This category is already added.');
defined('_SOBI2_SEC_CODE_WRONG') or define('_SOBI2_SEC_CODE_WRONG', 'Wrong security code');
defined('_SOBI2_LISTING_CHECKED_OUT') or define('_SOBI2_LISTING_CHECKED_OUT', 'This entry is currently being edited by another user');
defined('_SOBI2_FORM_CAN_ADD_TO_NR_CATS') or define('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "You can add this entry in up to {$config->maxCatsForEntry} categories");
defined('_SOBI2_FORM_SELECTED_CAT_DESC') or define('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Description:');
/*
 * On Saving
 */
defined('_SOBI2_SAVE_DUPLICATE_ENTRY') or define('_SOBI2_SAVE_DUPLICATE_ENTRY', 'An entry with this name already exists.');
defined('_SOBI2_SAVE_NOT_ALLOWED_IMG_EXT') or define('_SOBI2_SAVE_NOT_ALLOWED_IMG_EXT', 'The uploaded file has a not allowed extension and therefore is was not added.');
defined('_SOBI2_SAVE_UPLOAD_IMG_FILED') or define('_SOBI2_SAVE_UPLOAD_IMG_FILED', 'Image file upload failed!');
defined('_SOBI2_SAVE_UPLOAD_IMG_OK') or define('_SOBI2_SAVE_UPLOAD_IMG_OK', 'Image file for company logo uploaded!');
defined('_SOBI2_SAVE_UPLOAD_ICO_OK') or define('_SOBI2_SAVE_UPLOAD_ICO_OK', 'Image file for company icon uploaded!');
defined('_SOBI2_SAVE_UPLOAD_IMG_FAILED') or define('_SOBI2_SAVE_UPLOAD_IMG_FAILED', 'Image file for company logo upload failed!');
defined('_SOBI2_SAVE_UPLOAD_ICO_FAILED') or define('_SOBI2_SAVE_UPLOAD_ICO_FAILED', 'Image file for company icon upload failed!');
defined('_SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED') or define('_SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED', 'Not all required fields are filled in!');
defined('_SOBI2_SAVE_ICON_FEES') or define('_SOBI2_SAVE_ICON_FEES', 'Company Icon');
defined('_SOBI2_SAVE_IMAGE_FEES') or define('_SOBI2_SAVE_IMAGE_FEES', 'Company Logo');
defined('_SOBI2_CHANGES_SAVED') or define('_SOBI2_CHANGES_SAVED', 'All Changes Saved');



/*
 * Entry Labels
 */
defined('_SOBI2_LISTING_EDIT_PROMOTED_ITEMS') or define('_SOBI2_LISTING_EDIT_PROMOTED_ITEMS', 'Promoted Items');
defined('_SOBI2_LISTING_EDIT_ENTRY_BT') or define('_SOBI2_LISTING_EDIT_ENTRY_BT', 'Edit');
defined('_SOBI2_LISTING_DELET_ENTRY_BT') or define('_SOBI2_LISTING_DELET_ENTRY_BT', 'Delete');
defined('_SOBI2_LISTING_GO_UP_ICO') or define('_SOBI2_LISTING_GO_UP_ICO', '');
defined('_SOBI2_LISTING_GO_UP_TXT') or define('_SOBI2_LISTING_GO_UP_TXT', '');



/*
 * Payment Class
 */
defined('_SOBI2_PAY_CHOSEN_OPTIONS') or define('_SOBI2_PAY_CHOSEN_OPTIONS', 'You have chosen the following not free options');
defined('_SOBI2_PAY_TOTAL_AMOUNT') or define('_SOBI2_PAY_TOTAL_AMOUNT', 'Total Amount: ');
defined('_SOBI2_PAY_WITH_BANK') or define('_SOBI2_PAY_WITH_BANK', 'I will pay with bank transfer');
defined('_SOBI2_PAY_WITH_PAYPAL') or define('_SOBI2_PAY_WITH_PAYPAL', 'I will pay with PayPal');
defined('_SOBI2_PAY_BANK_DATA_SEND_EMAIL') or define('_SOBI2_PAY_BANK_DATA_SEND_EMAIL', 'Bank account data are sent to you');
defined('_SOBI2_PAY_BANK_DATA_JS_HEADER') or define('_SOBI2_PAY_BANK_DATA_JS_HEADER', 'Please send the money to the following account: ');
defined('_SOBI2_PAY_BANK_DATA_JS_TITLE') or define('_SOBI2_PAY_BANK_DATA_JS_TITLE', 'Reference: ');


/*
 * search form
 */
defined('_SOBI2_SEARCH_ANY') or define('_SOBI2_SEARCH_ANY', 'Any words');
defined('_SOBI2_SEARCH_ALL') or define('_SOBI2_SEARCH_ALL', 'All words');
defined('_SOBI2_SEARCH_EXACT') or define('_SOBI2_SEARCH_EXACT', 'Exact phrase');
defined('_SOBI2_SEARCH_RESULTS') or define('_SOBI2_SEARCH_RESULTS', 'Search Results');
defined('_SOBI2_SEARCH_RESULTS_FOUND') or define('_SOBI2_SEARCH_RESULTS_FOUND', 'Found');
defined('_SOBI2_SEARCH_RESULTS_FOUND_RESULTS') or define('_SOBI2_SEARCH_RESULTS_FOUND_RESULTS', 'results while searching for');
defined('_SOBI2_SEARCH_FOR') or define('_SOBI2_SEARCH_FOR', _SOBI2_SEARCH_H.' for: ');
/*
 *  Deleting
 */
defined('_SOBI2_DEL_UNPUBLISHED') or define('_SOBI2_DEL_UNPUBLISHED', 'Your entry is unpublished now!');
defined('_SOBI2_DEL_NOT_DELETED') or define('_SOBI2_DEL_NOT_DELETED', 'Your entry could not be deleted for some reasons. Please contact administrator.');
defined('_SOBI2_DEL_DELETED') or define('_SOBI2_DEL_DELETED', 'Entry is deleted!');
?>