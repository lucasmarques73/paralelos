<?php
/**
* @version $Id: english.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
define('_CCOUNT_VISITED', '( visited %count% times )');
defined('_BACK') or define('_BACK', 'Back');

/*
 * added (RC 2.8.7.2)
 */
define('_SOBI2_GOOGLEMAPS_LABEL', 'Labels');

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
define('_SOBI2_RENEW_EXP_TXT', 'This entry is expired for %days% days. Would you like to <a href="%href%" title="Renew this Entry Now">Renew this Entry Now</a> ?');

/*
 * added (RC 2.8.5)
 */
define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Tip');
define('_SOBI2_ENTRIES_LIMIT_REACHED', 'You have already added %count% entries. You can add a maximum of %limit% entries.');

/*
 * added (RC 2.8.4)
 */
define('_SOBI2_RENEW_TPL_TXT', 'This entry expires in %days% days. Would you like to <a href="%href%" title="Renew this Entry Now">Renew this Entry Now</a> ?');
define('_SOBI2_RENEW_BT_NOW', 'Renew this Entry Now');
define('_SOBI2_RENEW_HEADER', 'Renew Entry');
define('_SOBI2_RENEW_EXPL', 'You are going to renew your entry ( %title% ). The entry will be prolongated for %days% days. It will expire at %date%');
define('_SOBI2_RENEWED_EXPL', 'Your entry ( %title% ) has been renewed for %days% days. The entry will expire at %date%');
define('_SOBI2_PAY_DISCOUNT', 'Discount');
define('_JS_SOBI2_QFIELD_NO_VALUE', 'Missing data');
define('_JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT', 'Double click to edit data');

/*
 * added (RC 2.8.1)
 */
define('_SOBI2_NEW_LABEL', 'New');
define('_SOBI2_UPDATED_LABEL', 'Updated');
define('_SOBI2_HOT_LABEL', 'Hot');

/*
 * added 16.08.2007 (RC 2.8)
 */

//to get it working in this language you need the language files of the calender too
define("_SOBI2_CALENDAR_LANG", "en");
define("_SOBI2_CALENDAR_FORMAT", "y-mm-dd");

define("_SOBI2_USER_OWN_LISTING", "%name%'s listings");
// use this line if  user (login) name should be used in "Show users listings" instead of the real name
//define("_SOBI2_USER_OWN_LISTING", "%username%'s listings");
define("_SOBI2_USER_OWN_NO_LISTING", "No listings found for this user");

define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

define('_SOBI2_ALPHA_HEADER', 'Letter ');
define('_SOBI2_ALPHA_CATS_WITH_LETTER', 'Categories beginning with ');
define('_SOBI2_ALPHA_ITEMS_WITH_LETTER', 'Entries beginning with ');
define('_SOBI2_ALPHA_LETTER', 'Entries and Categories beginning with ');

define('_SOBI2_TAGGED_HEADER', 'Entries tagged with ');
define('_SOBI2_ENTRIES_TAGGED_WITH', 'Entries tagged with ');
define('_SOBI2_ENTRY_TAGGED_WITH', 'Tags: ');

define('_SOBI2_POPULAR_HEADER', 'Most Popular');
define('_SOBI2_POPULAR_LISTING', 'Most Popular Entries');
define('_SOBI2_POPULAR_CATS', 'Most Popular Categories');

define('_SOBI2_UPDATED_HEADER', 'Recently Updated Entries');
define('_SOBI2_UPDATED_LISTING', 'Recently Updated Entries');

define('_SOBI2_NEW_LISTINGS_HEADER', 'New Entries');
define('_SOBI2_NEW_LISTINGS_LISTING', 'New Entries');

defined('_SEARCH_BOX') or define('_SEARCH_BOX', 'Search ... ');
define('_SOBI2_SEARCH_RESET_FORM', 'Clear Selections');
define('_SOBI2_SEARCH_RESET_FORM_TITLE', 'Clear search form selections');

/*
 * added 26.07.2007 (RC 2.7.4)
 */
DEFINE('_SOBI2_SEARCH_CAT_REMOVED', 'Selected category has been removed');
DEFINE('_SOBI2_SEARCH_TOOGLE_EXTENDED', 'Extended Search Options');
DEFINE('_SOBI2_SEARCH_TOOGLE_CATS', 'Select Category');
DEFINE('_SOBI2_SEARCH_CATBOX_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
DEFINE('_SOBI2_SEARCH_BOX_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

/*
 * added 16.06.2007 (RC 2.7.2)
 */
DEFINE('_SOBI2_FILE_NOT_UPLOADED', 'Could not upload file, please try again.');
DEFINE('_SOBI2_FILE_UPLOADED', 'File uploaded');
DEFINE('_SOBI2_UPLOAD_FILE', 'Upload File: ');
DEFINE('_SOBI2_UPLOAD', 'Upload');
DEFINE('_SOBI2_UPLOAD_DISSALLOWED_FILETYPE', 'Not an allowed file type');

/*
 * added 11.11.2006 (RC 2.5.4)
 */
DEFINE('_SOBI2_NEW_ENTRY_AWAITING_APP', " Your entry was added and awaiting approval.");

/*
 * added 26.10.2006 (RC 2.5)
 */
DEFINE('_SOBI2_CHECKBOX_YES', 'Yes');
DEFINE('_SOBI2_CHECKBOX_NO', 'No');
DEFINE('_SOBI2_FORM_SELECT_BG', 'Select background image');
DEFINE('_SOBI2_FORM_SELECT_BG_EXPL', 'Select background image for details and cards view in category view.');
DEFINE('_SOBI2_FORM_BG_PREVIEW', 'Background image preview');
DEFINE('_SOBI2_NOT_LOGGED_FOR_DETAILS', 'You have to be an registered user and logged in to see this resource');
DEFINE('_SOBI2_JS_NOT_LOGGED_FOR_DETAILS', 'You have to be an registered user and logged in to see this resource');
define('_SOBI2_SEARCH_INPUTBOX', _SEARCH_BOX);
define('_SOBI2_SEARCH_ALL_ENTRIES', 'Any entry');

/*
 * added 11.10.2006 (RC 2)
 */
DEFINE('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'You cannot add an entry to a category having subcategories. Please select one of the subcategories.');
DEFINE('_SOBI2_SUBCATS_IN_THIS_CAT', 'Number of Subcategories in this category: ');
DEFINE('_SOBI2_SUBCATS_IN_CAT', 'Subcategories in ');
DEFINE('_SOBI2_ITEMS_IN_THIS_CAT', 'Number of Entries in this category: ');
DEFINE('_SOBI2_ITEMS_IN_CAT', 'Entries in ');
DEFINE('_SOBI2_ITEMS_CATS_SEPARATOR', '/');

/*
 * added 02.10.2006 (RC 1)
 */
DEFINE('_SOBI2_GOOGLEMAPS_GET_DIR', 'Get Directions');
DEFINE('_SOBI2_GOOGLEMAPS_FROM', 'From here');
DEFINE('_SOBI2_GOOGLEMAPS_TO', 'To here');
DEFINE('_SOBI2_GOOGLEMAPS_ADDR', 'Address: ');
DEFINE('_SOBI2_GOOGLEMAPS_DIR', 'Directions: ');

/*
 * added 26.09.2006 (Beta 2.2)
 */
 DEFINE('_SOBI2_CANCEL', 'Cancel');

/*
 * added 23.09.2006 (Beta 2.1)
 */
DEFINE('_SOBI2_SAVE_IMG_TO_BIG', 'Image file upload failed! Uploaded file was too big. File size is: ');
DEFINE('_SOBI2_EF_MAX_FILE_SIZE', ' The file size should not be bigger than ');
DEFINE('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * General Labels
 */

DEFINE('_SOBI2_SEND_L', 'Send');
DEFINE('_SOBI2_ADD_U', 'Add');
DEFINE('_SOBI2_CATEGORY_L', 'category');
DEFINE('_SOBI2_CATEGORY_H', 'Category');
DEFINE('_SOBI2_CATEGORIES_L', 'categories');
DEFINE('_SOBI2_CATEGORIES_H', 'Categories');
DEFINE('_SOBI2_IS_FREE_L', 'is for free');
DEFINE('_SOBI2_IS_NOT_FREE_L', 'is not free. ');
DEFINE('_SOBI2_COST_L', 'It costs');
DEFINE('_SOBI2_NOT_AUTH', 'You are not authorized to see this page');
DEFINE('_SOBI2_SELECT', 'select');
DEFINE('_SOBI2_SEARCH_H', 'Search');
DEFINE('_SOBI2_ADD_NEW_ENTRY', 'Add Entry');
DEFINE('_SOBI2_NUMBER_H', 'Number');
DEFINE('_SOBI2_CONFIRM_DELETE', 'Do you really want to delete this entry? \n' .
								'Please notice that all data will be deleted irrevocably!');
DEFINE('_SOBI2_SEND_MAIL', 'Send Email');
DEFINE('_SOBI2_VISIT_WEBSITE', 'Visit Website');
DEFINE('_SOBI2_HITS', 'Hits: ');
DEFINE('_SOBI2_DATE_ADDED', 'Date added:');

DEFINE('_SOBI2_NOT_LOGGED', '<h4>You are not logged in and therefore you cannot add an entry.</h4>');
DEFINE('_SOBI2_NOT_LOGGED_CANNOT_EDIT', '<h4>You are not logged in</h4>' .
		'<h4>You can add an entry, but you won\'t be able to edit your entry in the future.</h4>');
DEFINE('_SOBI2_PLEASE_REGISTER_OR_LOGIN', '<h4>Please login or register</h4>');


/*
 * Formular Labels
 */
DEFINE('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Add New Entry');
DEFINE('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Edit Entry');

DEFINE('_SOBI2_FORM_YOUR_IMG_LABEL', 'Your ');
DEFINE('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Change ');
DEFINE('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remove ');
DEFINE('_SOBI2_FORM_IMG_EXPL', 'This image will be shown in details view.');
DEFINE('_SOBI2_FORM_YOUR_ICO_LABEL', 'Your ');
DEFINE('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Change ');
DEFINE('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remove ');

DEFINE('_SOBI2_FORM_ICO_EXPL', 'This image will be shown in category view.');
DEFINE('_SOBI2_FORM_SAFETY_CODE', 'Safety Code&nbsp;');
DEFINE('_SOBI2_FORM_ENTER_SAFETY_CODE', 'Please enter safety code');
DEFINE('_SOBI2_FORM_NOT_FREE_OPTION', 'This option is not free.');
DEFINE('_SOBI2_FORM_SELECT_CATEGORY', 'Please Select a Category');
DEFINE('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "You can add this entry in up to {$config->maxCatsForEntry} categories");
DEFINE('_SOBI2_FORM_CAT_1', 'First category');
DEFINE('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_H);
DEFINE('_SOBI2_FORM_REMOVE_CAT_BT','Remove '._SOBI2_CATEGORY_H);
DEFINE('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Description:');
DEFINE('_SOBI2_FORM_PRICE_IS', 'The price is');
DEFINE('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
DEFINE('_SOBI2_FORM_FIELD_REQ_INFO', 'All fields with '._SOBI2_FORM_FIELD_REQ_MARK.' are required.');
DEFINE('_SOBI2_FORM_META_KEYS_LABEL', 'Meta Keywords');
DEFINE('_SOBI2_FORM_META_KEYS_EXPL', 'The entered key words will be added to the Meta Tag Key word list.');
DEFINE('_SOBI2_FORM_META_DESC_LABEL', 'Meta Description');
DEFINE('_SOBI2_FORM_META_DESC_EXPL', 'The entered text will be added to the Meta Tag Description.');
DEFINE('_SOBI2_FORM_JS_SELECT_CAT', 'Please select at least one category.');
DEFINE('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'You have to accept the terms of use.');
DEFINE('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Please fill in all required fields.');
DEFINE('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'This category is already added.');
DEFINE('_SOBI2_SEC_CODE_WRONG', 'Wrong security code');
DEFINE('_SOBI2_LISTING_CHECKED_OUT', 'This entry is currently being edited by another user');


/*
 * On Saving
 */
DEFINE('_SOBI2_SAVE_DUPLICATE_ENTRY', 'An entry with this name already exists.');
DEFINE('_SOBI2_SAVE_NOT_ALLOWED_IMG_EXT', 'The uploaded file has a not allowed extension and therefore is was not added.');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_FILED', 'Image file upload failed!');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_OK', 'Image file for company logo uploaded!');
DEFINE('_SOBI2_SAVE_UPLOAD_ICO_OK', 'Image file for company icon uploaded!');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_FAILED', 'Image file for company logo upload failed!');
DEFINE('_SOBI2_SAVE_UPLOAD_ICO_FAILED', 'Image file for company icon upload failed!');
DEFINE('_SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED', 'Not all required fields are filled in!');
DEFINE('_SOBI2_SAVE_ICON_FEES', 'Company Icon');
DEFINE('_SOBI2_SAVE_IMAGE_FEES', 'Company Logo');
DEFINE('_SOBI2_CHANGES_SAVED', 'All Changes Saved');


/*
 * Entry Labels
 */
DEFINE('_SOBI2_LISTING_EDIT_PROMOTED_ITEMS', 'Promoted Items');
DEFINE('_SOBI2_LISTING_EDIT_ENTRY_BT', 'Edit');
DEFINE('_SOBI2_LISTING_DELET_ENTRY_BT', 'Delete');
DEFINE('_SOBI2_LISTING_GO_UP_ICO', '');
DEFINE('_SOBI2_LISTING_GO_UP_TXT', '');


/*
 * Payment Class
 */
DEFINE('_SOBI2_PAY_CHOSEN_OPTIONS', 'You have chosen the following not free options');
DEFINE('_SOBI2_PAY_TOTAL_AMOUNT', 'Total Amount: ');
DEFINE('_SOBI2_PAY_WITH_BANK', 'I will pay with bank transfer');
DEFINE('_SOBI2_PAY_WITH_PAYPAL', 'I will pay with PayPal');
DEFINE('_SOBI2_PAY_BANK_DATA_SEND_EMAIL', 'Bank account data are sent to you');
DEFINE('_SOBI2_PAY_BANK_DATA_JS_HEADER', 'Please send the money to the following account: ');
DEFINE('_SOBI2_PAY_BANK_DATA_JS_TITLE', 'Reference: ');


/*
 * search form
 */
DEFINE('_SOBI2_SEARCH_FOR', _SOBI2_SEARCH_H.' for: ');
DEFINE('_SOBI2_SEARCH_ANY', 'Any words');
DEFINE('_SOBI2_SEARCH_ALL', 'All words');
DEFINE('_SOBI2_SEARCH_EXACT', 'Exact phrase');
DEFINE('_SOBI2_SEARCH_RESULTS', 'Search Results');
DEFINE('_SOBI2_SEARCH_RESULTS_FOUND', 'Found');
DEFINE('_SOBI2_SEARCH_RESULTS_FOUND_RESULTS', 'results while searching for');

/*
 *  Deleting
 */
DEFINE('_SOBI2_DEL_UNPUBLISHED', 'Your entry is unpublished now!');
DEFINE('_SOBI2_DEL_NOT_DELETED', 'Your entry could not be deleted for some reasons. Please contact administrator.');
DEFINE('_SOBI2_DEL_DELETED', 'Entry is deleted!');
?>