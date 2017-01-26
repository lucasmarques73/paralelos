<?php
/**
* @version $Id: admin.english.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
define('_SOBI2_ADM_EXPERIMENTAL_OPT', ' (Experimental)');

/*
 * added (RC 2.9.0.2)
 */
define('_SOBI2_SET_TPL_DEF_EXPL', 'Click to set this template as default SOBI2 template.');
define('_SOBI2_SET_TPL_DEF', 'Set as default');
define('_SOBI2_PLUGINS_DEF', 'Default');
define('_SOBI2_CONFIG_GENERAL_DEF_TMPL', 'Default Template');
define('_SOBI2_CONFIG_GENERAL_DEF_TMPL_EXPL', 'Select the default template for SOBI2.');
define('_SOBI2_CONFIG_GENERAL_SORT_EXP_ASC', 'Expiration Date Ascending');
define('_SOBI2_CONFIG_GENERAL_SORT_EXP_DESC', 'Expiration Date Descending');

/*
 * added (RC 2.9)
 */
define('_SOBI2_INSTALLER_TPL_DELETE_ERROR', 'Cannot remove some files or directories');
define('_SOBI2_INSTALLER_TPL_DELETE_OK', 'Template %name% has been removed');
define('_SOBI2_TPL_INSTALLED_OK', 'Template %name% has been installed');
define('_SOBI2_CONFIG_TPL_INSTALLED', 'Installed Templates');
define('_SOBI2_CONFIG_TPL_PACK_UPLOAD', 'Upload New Template Package');
define('_SOBI2_MENU_TPL_MANAGER', 'Templates Manager');
define('_SOBI2_MENU_TEMPLATES', 'Templates Manager');
define('_SOBI2_CAT_TPL', 'Template');
define('_SOBI2_CAT_CHOOSE_TPL', 'Overwrite Template');
define('_SOBI2_AVAILABLE_TPL', 'Available Templates:');
define('_SOBI2_CAT_CHOOSE_TPL_EXPL', 'You can overwrite the default template and several default settings for this category.');
define('_SOBI2_CHOOSE_TPL_TO_EDIT', 'Choose template to edit:');

/*
 * added (RC 2.8.7)
 */
define('_SOBI2_APPLY', 'Apply');

/*
 * added (RC 2.8.5)
 */
define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Tip');

define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW', 'Inform Administrators about Renewal');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW_EXPL', 'Inform the administrators if a customer/author has renewed his entry.');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW', 'Send Confirmation Email about Renewal');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW_EXPL', 'Send confirmation email about renewal of his entry to the customer/author.');

define('_SOBI2_EMAIL_ON_SUBMIT_OPTGR', 'On Add Entry');
define('_SOBI2_EMAIL_ON_UPDATE_OPTGR', 'On Edit Entry');
define('_SOBI2_EMAIL_ON_APPROVE_OPTGR', 'On Approve Entry');
define('_SOBI2_EMAIL_ON_PAYMENT_OPTGR', 'Payment Email');
define('_SOBI2_EMAIL_ON_RENEW', 'On Renew Entry (user)');
define('_SOBI2_EMAIL_ON_RENEW_ADMIN', 'On Renew Entry (admin)');
define('_SOBI2_EMAIL_ON_RENEW_OPTGR', 'On Renew Entry');

define('_SOBI2_TOOLBAR_GEN_DEB_REP', '<small>System&nbsp;Check</small>');
define('_SOBI2_MENU_GEN_DEB_REP', 'Perform System Check');
define('_SOBI2_MENU_GEN_SYSCHECK_EXPL', 'Check if all requirements for SOBI2 component are covered'. _SOBI2_ADM_EXPERIMENTAL_OPT);

define('_SOBI2_TOOLBAR_RECOUNT_NEEDED', 'There are several changes since the number of sub categories and entries has been recounted. It is maybe necessary to recount them again.');
define('_SOBI2_TOOLBAR_RECOUNTED_SOFAR', ' Categories recounted so far');
define('_SOBI2_TOOLBAR_RECOUNT_WAIT', ' Please wait. Server discharging pause.');
define('_SOBI2_TOOLBAR_RECOUNT_RESTART', 'Stand by. Restarting ... ');
define('_SOBI2_TOOLBAR_RECOUNT_DONE', 'Recount done. Recounted: ');
define('_SOBI2_TOOLBAR_RECOUNT_DONE_C', ' Categories');
define('_SOBI2_TOOLBAR_RECOUNT_CATS', 'Recount');
define('_SOBI2_RECOUNT_LAST_DATE', 'Last Recounted');
define('_SOBI2_TOOLBAR_RECOUNT_CATS_F', 'Recount Categories');
define('_SOBI2_RECOUNT_NOW', 'Recount Now');
define('_SOBI2_RECOUNT_CATS_HEADER', 'Recount the Number of Subcategories and Entries in a Category');

define('_SOBI2_CONFIG_L2CACHE_ON', 'Second Level Cache Enabled');
define('_SOBI2_CONFIG_L2CACHE_DV_ON', 'Caching of Details View Enabled (not recommended)');
define('_SOBI2_CONFIG_L2CACHE_EXPL', '<b>Second Level Cache</b> - Allows to cache the whole html site output (category list and entries list separately). ');
define('_SOBI2_CONFIG_L2CACHE_LIFETIME', 'Second Level Cache Lifetime');
define('_SOBI2_CONFIG_L2CACHE_LIFETIME_SECONDS', 'Seconds');
define('_SOBI2_CONFIG_L2CACHE_STRLEN', 'Maximum Allowed String Length');
define('_SOBI2_CONFIG_L2CACHE_STRLEN_EXPL', 'If you experience problems with the returned cached site, e.g. if parts of the site are missing, you should reduce this value.');

define('_SOBI2_CONFIG_L3CACHE_EXPL', '<b>Third Level Cache</b> - Caching of object attributes. This cache will be refreshed for each object, if the entry/category has been changed.');
define('_SOBI2_CONFIG_L3CACHE_STRLEN', 'Maximum Allowed String Length');
define('_SOBI2_CONFIG_L3CACHE_ON', 'Third Level Cache Enabled');
define('_SOBI2_CONFIG_L3CACHE_CLEAR', 'Clear Third Level Cache');

/*
 * added (RC 2.8.4)
 */
define('_SOBI2_QFIELD_ALLOW', 'Allow Using \'Quick Edit\'');
define('_SOBI2_QFIELD_ALLOW_ADM', 'For Admins Only');
define('_SOBI2_QFIELD_ALLOW_EXPL', 'If yes, the registered user will be able to use the quick edit/edit in place function. With this function, it is possible to edit several custom fields directly from the details view by doubleclicking on the fields data. Warning: if an user edits an entry using this function, no emails will be send!');

define('_SOBI2_CONFIG_ENTRY_RENEWAL', 'Renewal');
define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL', 'Allow Renewal');
define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL_EXPL', 'If yes, the registered user will be able to renew his entry when it expires.');
define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS', 'Days prior Expiration');
define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS_EXPL', 'Enter here how many days prior to expiration date, the user should be able to access the renew function.');
define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT', 'Discount');
define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT_EXPL', 'Enter here how many percent of discount you want to give (0-100).');
define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS', 'Renew for');
define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS_EXPL', 'Select, for how many days an entry should be renewed. If it is set to 0, the default expiration time will be used.');
define('_SOBI2_CONFIG_DAYS', 'Days');
define('_SOBI2_CONFIG_ENTRY_RENEWAL_HEADER', 'Renewal Options');
define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES', 'Delete old Fees');
define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES_EXPL', 'If yes, all selected fees from the total amount of the last period will be deleted. If no, all total amounts are summarized.');

define('_SOBI2_LISTING_MANAGER_STATUS_FILTER', 'Status: ');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_ALL', 'All');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UP', 'Unpublished');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_P', 'Published');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UA', 'Unapproved');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_A', 'Approved');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_E', 'Expired');

define('_SOBI2_REG_MANAGER_SAVE_ERR', 'Cannot save registry file. Please try to edit it manually.');
define('_SOBI2_REG_MANAGER_NEW_PAIR', 'New Key: ');
define('_SOBI2_REG_MANAGER_ADD_PAIR', 'Add New Key');
define('_SOBI2_REG_MANAGER_NEW_SECTION', 'New Section:');
define('_SOBI2_REG_MANAGER_ADD_SECTION', 'Add New Section');
define('_SOBI2_REG_MANAGER_WARNING', 'Additional Options. Experimental - Use at your own risk!');
define('_SOBI2_MENU_REG_MANAGER', 'Registry Editor');
define('_SOBI2_MENU_EDIT_FORM_TEMPLATE', 'Entry Form Template');
define('_SOBI2_FORM_TEMPLATE_ENABLE', 'Use the Template instead of the Standard Function');
define('_SOBI2_FORM_TEMPLATE_ENABLE_EXPL', 'If you want to use the template, you have to add each new custom field to the template manually.');

define('_SOBI2_CONFIG_DEBUG_TMPL', 'Parse Templates');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND', 'Show Fields Category Dependant');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND_EXPL', 'Show the fields data in the search list boxes dependant on the previous selected catgory.');

/*
 * added (RC 2.8.3)
 */
define('_SOBI2_MENU_PLUGINS_DATATABLES', 'Database Tables of Plugins');
define('_SOBI2_PLUGINS_DATATABLES_NAME', 'Table Name');
define('_SOBI2_PLUGINS_DATATABLES_PNAME', 'Plugin Name');
define('_SOBI2_PLUGINS_DATATABLES_INFO', 'Info');
define('_SOBI2_PLUGINS_DATATABLES_ROWS', 'Rows');
define('_SOBI2_PLUGINS_DATATABLES_CREATED', 'Created');
define('_SOBI2_PLUGINS_DATATABLES_UPD', 'Updated');
define('_JS_SOBI2_PLUGINS_DATATABLE_DELETE', 'Do you really want to delete this table? \nPlease notice that all data will be deleted irrevocably! ');
define('_SOBI2_PLUGINS_DATATABLE_DELETED', 'Table has been removed');

define('_SOBI2_MENU_TEMPLATES_AND_CSS', 'Templates &amp; CSS');

define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT', 'Show Subcategory List');
define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT_EXPL', 'Show list of subcategories below a category in Yahoo style.');
define('_SOBI2_CONFIG_GENERAL_SHOW_NUMBER_SUBCATS', 'Number of Subcategories');
define('_SOBI2_CONFIG_GENERAL_SORT_SUBCATS_BY', 'Sort Subcategories by');

/* !!!!! changed - please remove old one */
define('_SOBI2_FIELD_USE_WYSIWYG_EXPL', 'Select if TinyMCE editor should be used in the New/Edit Entry form. Will work only if textarea is the selected type. <strong>A WYSIWYG FIELD MUST NOT BE SET TO REQUIRED!!</strong>');

/*
 * added (RC 2.8.2)
 */
define('_SOBI2_ABOUT_ADDONS', 'Add-Ons for SOBI2');
define('_SOBI2_ABOUT_PBY', '"Powered by" Link');
define('_SOBI2_ABOUT_NEWS', 'Sigsiu.NET News');
define('_SOBI2_ABOUT_PBY_SHOW', 'Display "Powered by" Link');
define('_SOBI2_ABOUT_PBY_SUPPORT', '<br /><strong>If you remove the "powered by" Link from our component, it is fair to donate for the component.</strong><br /><br />Developing and maintaining SOBI2 is a lot of work which should be recompensed adequately.<br />Click on the donate button below to donate via Paypal.<br /><br /><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sigsiu%2enet%40sigsiu%2enet&item_name=SOBI%202&item_number=SOBI2-CAB&no_shipping=2&lc=US&no_note=1&tax=0&currency_code=EUR&bn=PP%2dDonationsBF&charset=UTF%2d8" title="Donate for SOBI2" target="_blank"><img src="components/com_sobi2/images/donate_button.png" alt="Donate for SOBI2 via Paypal" title="Donate for SOBI2 via Paypal" border="0"/></a><br /><br />Thank you.<br /><br />');
define('_SOBI2_ABOUT_PBY_JS_SUPPORT', "Don\'t forget to donate!");
define('_SOBI2_CODEPRESS_TOGGLE', 'Toggle Editor');

/*
 * added (RC 2.8.1)
 */
define('_SOBI2_FPERMS_HEADER', 'File System');
define('_SOBI2_FPERMS_ON', 'Change file/directory permissions if neccessary<br/>If you experience problems with the permissions set by SOBI2, set this to \'No\' and change the permissions manually!');
define('_SOBI2_FPERMS_FMOD', 'File permissions');
define('_SOBI2_FPERMS_DMOD', 'Directory permissions');
define('_SOBI2_FPERMS_WRITABLE', 'writeable');
define('_SOBI2_FPERMS_NWRITABLE', 'not writeable');
define('_SOBI2_CURRENT_FPERMS_HEADER', 'Current Directory Permissions');
define('_SOBI2_FIELDLIST_CSV_LIST', 'Add CSV value list');
define('_SOBI2_FIELDLIST_CSV_LIST_EXPL', 'You can add CSV (comma separated values) list of options and values in this form: <ul><li>Only field options: <b>option 1; option 2; option 3;</b></li><li>Field options with values: <b>option_1:Option 1; option_2:Option 2; option_3:Option 3;</b></li></ul>');
define('_SOBI2_FIELDLIST_CSV_SAVE', 'Save CSV List');
define('_SOBI2_FIELDLIST_CSV_SAVE_EXPL', 'Save the CSV list instead of the options list below.');

/*
 * added 14.08.2007 (RC 2.8)
 */
//to get it working in this language you need the language files of the calender too
defined("_SOBI2_CALENDAR_LANG") || define("_SOBI2_CALENDAR_LANG", "en");
defined("_SOBI2_CALENDAR_FORMAT") || define("_SOBI2_CALENDAR_FORMAT", "y-mm-dd");

/* !!!!! changed - please remove old one */
define('_SOBI2_FIELD_COLS_EXPL', 'Number of columns of input field. Valid only if textarea is the selected type OR pixel width for player if linked media OR number of columns for the checkbox group.');
/* !!!!! changed - please remove old one */
define('_SOBI2_FIELD_PREFERRED_SIZE_EXPL', 'Size of inputbox or select list. Valid only if inputbox or select list is the selected type.');
/* !!!!! changed - please remove old one */
define('_SOBI2_TOOLBAR_ADD_NEW_CAT', 'Add Category');
/* !!!!! changed - please remove old one */
define('_SOBI2_TOOLBAR_ADD_NEW_ITEM', 'Add Entry');


define('_SOBI2_CHECKBOX_YES', 'Yes');
define('_SOBI2_CHECKBOX_NO', 'No');

define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID', 'Force Unique Menu-Id');
define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID_EXPL', 'If yes, for every SOBI2 URL a unique menu id will be used. Otherwise the current menu id will be used.');

define('_SOBI2_FIELD_ADM_ONLY', 'Administrative Field');
define('_SOBI2_FIELD_ADM_ONLY_EXPL', 'Only the administrator will be able to enter data in this field via the back-end.');

define('_SOBI2_ALLOW_FE_ENTRIES', 'Allow Adding Entries');
define('_SOBI2_TOOLBAR_ADD_CATS_SERIE', 'Add Multiple Categories');
define('_SOBI2_ADD_CATS_SERIE_NAMES', 'Insert a semicolon separated list of categories');
define('_SOBI2_ADD_CATS_SERIE_NAMES_EXPL', 'Insert a semicolon separated list of category names, introtexts and category icons to add multiple categories at once. The category name, the introtext and the icon has to be separated by a colon.<br/><strong>The categories will be added in the previous selected category.</strong><br/><br/>Examples:<br />Only category names: category name 1; category name 2; category name 3;<br />Category names and introtexts and/or category icons: category name 1 : introtext 1; category name 2 : introtext 2; category name 3 : introtext 3 : icon.png;<br />Only category name and icon: category name :: icon.png; ');

define('_SOBI2_LANG_REMOVED', 'Language removed');
define('_SOBI2_LANG_REM_ERROR', 'Language removed but an error occurred');
define('_SOBI2_LANG_NOT_REM_ERROR', 'Language cannot be removed');
define('_SOBI2_LANG_FOR_VER', 'For Version');
define('_SOBI2_CONFIG_LANGMAN_LIST_CREATED', 'Creation Date');
define('_SOBI2_CONFIG_LANGMAN_INSTALLED_LANGS', 'Installed Languages');
define('_SOBI2_CONFIG_LANG_PACK_UPLOAD', 'Upload New Language Package');
define('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE', 'XML-Setup file does not exist in the package');

define('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_ON_SEARCHPAGE', 'Show Component Description on Search Page');

define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL', 'Return URL');
define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL_EXPL', 'The URL to which the user will be redirected after payment was made.');
define('_SOBI2_CONFIG_PAYMENTS_CURRENCY_TEXT', 'Currency Code');

define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT', 'Categories Container Height');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT_EXPL', 'If you use show/hide extended search options button, you need to define the categories container height. Please notice that the height has to be big enough to contain as many combo boxes as the highest depth of your subcategory structure. One combo box has about 25 px (depends on your CMS template).');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE', 'Ordering');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_FIELD_FIRST', 'Custom Fields First');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_CAT_FIRST', 'Categories First');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_EXPL', 'Select the ordering of categories and custom fields combo boxes in the extended search options container.');

define('_SOBI2_CONFIG_ENTRY_WS_HEADER', 'Way Search Options');
define('_SOBI2_CONFIG_ENTRY_WS_FIELDS_ASSIGMENT', 'Field Assignments');

define('_SOBI2_CONFIG_SYSTEM_MAILS', 'System Emails');
define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS', 'Send system emails to');
define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS_EXPL', 'Select which user group should get the notification emails.');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL', 'Use as client email address');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_EXPL', 'From where the client email address has to be taken? Choose between SOBI2 entry or CMS user managment. Notice, that if the address is taken from the CMS user management, adding entries has to be allowed only for registered users.');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_SOBI', 'Address entered in SOBI2 entry');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_CMS', 'Address as stated during user registration');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID', 'Field where the email address is stored');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID_EXPL', 'Select the field in which the email address is stored. Only valid if email addresses from SOBI2 entry are used.');

define('_SOBI2_ALL_LISTING_NON_FREE_OPT', 'Total Amount');
define('_SOBI2_CONFIG_SEARCH_OPT', 'Search Options');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER', 'Use Extended Search Options Button');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER_EXPL', 'If Yes, a button will be shown to hide/show the extended search options container.');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START', 'Fade out on Start');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START_EXPL', 'If Yes, the extended search options container is hidden at the beginning (only if extended search options button is used).');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH', 'Fade out after Search');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH_EXPL', 'If Yes, the extended search options container will be hidden after searching (only if extended search options button is used).');

define('_SOBI2_LISTING_MANAGER_SEARCH_ONLY_START', 'Only items which start with');
define('_SOBI2_CONFIG_GENERAL_SHOW_ALPHA', 'Show Alpha-Index');

define('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'You cannot add an entry to a category having subcategories. Please select one of the subcategories.');
define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('_SOBI2_FIELDLIST_LIST_OF_VALUES', 'List of predefined option values for select list/checkbox group');
define('_SOBI2_FIELDLIST_NEW_VALUE_PAIR', 'Add new pair of variates');
define('_SOBI2_FIELDLIST_OPT_NAME', 'Option Name');
define('_SOBI2_FIELDLIST_OPT_VALUE', 'Option Value');
define('_SOBI2_FIELDLIST_DELETE_VALUE_PAIR', 'Remove pair of variates');
define('_SOBI2_FIELDLIST_SORT_VALUES', 'Sort Options');
define('_SOBI2_FIELDLIST_SORT_VALUES_EXPL', 'Sort options in add entry form alphabetically or not.');
define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL', 'Add Select');
define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL', 'Select if an additionally option with the text "Select" should be shown.');

define('_SOBI2_SAVE_IMG_TO_BIG', 'Image file upload failed! Uploaded file was too big. File size is: ');
define('_SOBI2_EF_MAX_FILE_SIZE', ' The file size should not be bigger than ');
define('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * added 24.07.2007 (RC 2.7.4)
 */
DEFINE('_SOBI2_MENU_EULA', 'End-User License');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH', 'Use Extended Search Function');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH_EXPL', 'Use extended search function instead of the normal search function. This function allows the visitors to search also in a specific category.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_NOTICE', 'Google Maps (geographical coordinates for each entry are needed)');

/*
 * added 8.06.2007 (RC 2.7.2)
 */
DEFINE('_SOBI2_CONFIG_GENERAL_USE_ATREE', 'Use SigsiuTree');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_ATREE_EXPL', 'Use SigsiuTree instead of the normal dTree. This is useful if you have a lot of categories and the browser is giving up on parsing the javascript code.');
DEFINE('_SOBI2_CONFIG_GENERAL_ATREE_IMAGES', 'SigsiuTree Images');

/*
 * added 18.05.2007 (RC 2.7.1)
 */
DEFINE('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE', 'Text Code');
DEFINE('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE_EXPL', '
In a text code field normal text w/html tags can be displayed in the "add/edit entry form". So you are able to add some description texts.<br/><br/><strong>The texts will be displayed ONLY in the add entry form. Nothing will be saved in the database!</strong><br/><br/>
Insert your text code in the text box. It will be displayed instead of a normal field. You can use the following placeholders: <br/>
<ul>
<li>{componentName} - will be replaced with SOBI2 name (adjustable in General configuration - Component Name)</li>
<li>{sitename} - will be replaced with live site name</li>
<li>{sobi2Lang} - will be replaced with the selected language</li>
<li>{currency} - will be replaced with the currency (adjustable in Payment Options - Currency Symbol)</li>
<li>{entryExpirationTime} - will be replaced with the number of days of publishing</li>
<li>{imgLabel} - will be replaced with the image label (adjustable in Entry Configuration - Image Label) </li>
<li>{priceForImg} - will be replaced with the price for image (adjustable in Entry Configuration - Price For Image)</li>
<li>{icoLabel} - will be replaced with the icon label (adjustable in Entry Configuration - Icon Label) </li>
<li>{priceForIco} - will be replaced with the price for icon (adjustable in Entry Configuration - Price For Icon)</li>
<li>{bankData} - will be replaced with with bank data info for payments</li>
<li>{payPalMail} - will be replaced with email address for PayPal (adjustable in Payment Options - Email Address for PayPal) </li>
<li>{payPalUrl} - will be replaced with PayPal URL (adjustable in Payment Options - Paypal URL) </li>
<li>{paymentReference} - will be replaced with payment reference (adjustable in Payment Options - Payment Reference)</li>
<li>{basicPrice} - will be replaced with fee for basic entry (adjustable in Entry Configuration - Fee for Basic Entry)</li>
<li>{basicPriceLabel} - will be replaced with title for basic entry (adjustable in Entry Configuration - Title for Basic Entry)</li>
<li>{googleApiKey} - will be replaced with Google API key (adjustable in View Configuration - Google Maps - API Key)</li>
</ul>
');

/*
 * added 17.04.2007 (RC 2.7.0)
 */
DEFINE('_SOBI2_CONFIG_CACHE_DESCRIPTION_TEXT', 'Cache Acceleration Options');
DEFINE('_SOBI2_CONFIG_CACHE_ON', 'Cache Enabled');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME', 'Cache Lifetime');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_EXPL', 'The cache life time can be set to a very high value because the cache will be refreshed every time something in SOBI2 was changed. For example, if user has edited his entry or admin has changed the configuration.');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_SEC', 'Seconds');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_MIN', 'Minutes');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_HOURS', 'Hours');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_DAYS', 'Days');
DEFINE('_SOBI2_CONFIG_CACHE_EMPTY', 'Empty&nbsp;Cache');
DEFINE('_SOBI2_CONFIG_CACHE_REMOVED', 'Cache Cleared');
DEFINE('_SOBI2_CONFIG_CACHE_DIR', 'Cache Directory');
DEFINE('_SOBI2_CONFIG_CACHE_DIR_EXPL', 'Where the cache should be stored. For an absolute path, the location address has to start with /. Otherweise the address is relative to the CMS root.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL', 'Paypal URL');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL_EXPL', 'You can change the target PayPal URL here. For example if you want to use the Paypal sandbox mode. Default should be https://www.paypal.com/cgi-bin/webscr');

DEFINE('_SOBI2_MENU_EDIT_VC_TEMPLATE', 'V-Card Template');
DEFINE('_SOBI2_VC_TEMPLATE_ENABLE', 'Use the Template instead of the Standard Function');
DEFINE('_SOBI2_VC_TEMPLATE_ENABLE_EXPL', 'If you want to use the template, you have to add any new custom field to the template manually. The New-Line setting from Fields Manager is without effect if the V-Card template is used.');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_RSS', 'Use RSS Feeds');


/*
 * added 16.02.2007 (RC 2.6.1)
 */
DEFINE('_SOBI2_MENU_ERRLOG', 'Error Logfile');
DEFINE('_SOBI2_ERRLOG_FILE_SIZE', 'Error Logfile Size: ');
DEFINE('_SOBI2_ERRLOG_FILE_TOO_BIG', '<big>The error logfile is very large (over 500 kB). It could hang up your browser or server.</big>');
DEFINE('_SOBI2_ERRLOG_FILE_SHOW', 'Show the File anyway');
DEFINE('_SOBI2_ERRLOG_FILE_DOWNLOAD_FULL', 'Download Logfile');
DEFINE('_SOBI2_ERRLOG_FILE_DELETE', 'Delete');
DEFINE('_SOBI2_ERRLOG_FILE_DOWNLOAD', 'Download');
DEFINE('_SOBI2_ERRLOG_NO_FILE', '<big>Could not open error logfile. Either there is no error or SOBI2 cannot create the logfile</big>');
DEFINE('_SOBI2_ERRLOG_FILE_DELETED', 'Error Logfile deleted');
DEFINE('_SOBI2_ERRLOG_FILE_NOT_DELETED', 'Could not delete Error Logfile ');

DEFINE('_SOBI2_ERR_NOTICE', 'PHP Notice - Don\'t panic. It could help you/us to find the solution if something goes wrong');
DEFINE('_SOBI2_ERR_WARNING', 'PHP Warning - You should notify us about the warning in the SOBI2 forum');
DEFINE('_SOBI2_ERR_ERROR', 'PHP Error - Critical error. Please inform us about this in the SOBI2 forum');
DEFINE('_SOBI2_ERR_INTERN', 'Internal SOBI2 Error -  this information is helpful in finding the solution if something goes wrong');
DEFINE('_SOBI2_CONFIG_DEBUG_DESCRIPTION_TEXT', 'Debug and Error Logging Options');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL', 'Debug Level');
DEFINE('_SOBI2_CONFIG_DEBUG_SHOW_ERR', 'Display Errors');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_0', 'None');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_7', 'Only Critical Errors');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_8', 'Errors & Warnings (recommended)');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_9', 'All Errors, Warnings and Notices');

/*
 * added 19.11.06 (RC 2.5.7)
 */
DEFINE('_SOBI2_FIELD_VIDEO', 'linked media file');
DEFINE('_SOBI2_BASE_ENTRY_FEES', 'Fee for Basic Entry');
DEFINE('_SOBI2_BASE_ENTRY_FEES_EXPL', 'Leave empty or put in 0 if the basic entry is for free.');
DEFINE('_SOBI2_BASE_ENTRY_FEES_LABEL', 'Title for Basic Entry');
DEFINE('_SOBI2_BASE_ENTRY_FEES_LABEL_EXPL', 'This title will be shown in the payment summary screen.');
DEFINE('_SOBI2_FIELD_IS_URL_EXPL', 'Select if the field is for an URL, an email address, a linked image or a linked video/audio file.');
DEFINE('_SOBI2_FIELD_ROWS_EXPL', 'Number of rows of input field. Valid only if textarea is the selected type OR pixel height for player if linked media.');

/*
 * added 28.10.06 (RC 2.5)
 */
DEFINE('_SOBI2_FIELD_IMG', 'image');
DEFINE('_SOBI2_LISTING_FILTER', 'Filter: ');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND', 'Allow Choosing Background');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND_EXPL', 'Permit the user to choose its background for details and cards view.');
DEFINE('_SOBI2_CONFIG_VIEW_ALLOW_ANO', 'Unregistered Users may view Details View');
DEFINE('_SOBI2_CONFIG_VIEW_ALLOW_ANO_EXPL', 'Allow unregistered users to view the entry details page.');

DEFINE('_SOBI2_PLUGIN_ENABLED', 'Plugin enabled');
DEFINE('_SOBI2_PLUGIN_DISABLED', 'Plugin disabled');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_FILES_ERROR', 'Cannot remove some files or directories');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_ERROR', 'Cannot remove plugin data from database');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DROP_ERROR', 'Cannot drop plugin tables');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_NOT_FOUND', 'Cannot find plugin data in database');
DEFINE('_SOBI2_PLUGINS_INSTALLER_REMOVED', ' Plugin succsessfully removed');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PID_MISSING', 'Please make a selection from the list');
DEFINE('_SOBI2_PLUGINS_INSTALLER_COPY_ERROR', 'Error while copying  files');
DEFINE('_SOBI2_PLUGINS_INSTALLER_INSTALLED', ' Plugin succsessfully installed');
DEFINE('_SOBI2_PLUGINS_INSTALLER_ERROR', 'Error while installing new plugin');
DEFINE('_SOBI2_PLUGINS_INSTALLER_ALLREADY_EXISTST', 'A plugin with this name is already installed');
DEFINE('_SOBI2_PLUGINS_ENABLED', 'Enabled');
DEFINE('_SOBI2_PLUGINS_POSITION', 'Position');
DEFINE('_SOBI2_PLUGINS_INIT_FILE', 'Init File');
DEFINE('_SOBI2_PLUGINS_AUTHOR', 'Author');
DEFINE('_SOBI2_PLUGINS_AUTHOR_URL', 'Author URL');
DEFINE('_SOBI2_PLUGINS_VER', 'Version');
DEFINE('_SOBI2_CONFIG_PLUGINS_INSTALLED_PLUGINS', 'Currently Installed Plugins');
DEFINE('_SOBI2_CONFIG_PLUGINS_INSTALL_NEW', 'Install New Plugin');
DEFINE('_SOBI2_CONFIG_PLUGINS_UPLOAD', 'Upload Plugin Package File');
DEFINE('_SOBI2_MENU_PLUGINS_HEADER', 'Plugins');
DEFINE('_SOBI2_MENU_PLUGINS_MANAGER', 'Plugin Manager');
DEFINE('_SOBI2_PLUGIN_HEADER', 'Plugin');

/*
* added 10.10.2006 (RC 2)
*/
DEFINE('_SOBI2_MENU_EDIT_TEMPLATE', 'Details View Template');

DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER', 'Count Entries and Subcategories');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER_EXPL', 'Show the number of entries and subcategories behind the category name in category list.');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT', 'Allow Adding Entries to Parent Categories');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT_EXPL', 'Allow adding entries to categories having subcategories');

DEFINE('_SOBI2_MENU_VER_CHECKER', 'Version Checker');
DEFINE('_SOBI2_CONFIG_CHECK_VER', 'Check Your Version Of SOBI2');
DEFINE('_SOBI2_CONFIG_ACT_VER', 'Your version is: ');
DEFINE('_SOBI2_CONFIG_VER_CHECK', 'Check for newer version');
DEFINE('_SOBI2_CONFIG_VER_CHECK_ERROR', 'Could not connect remote server. Please try again later!');

DEFINE('_SOBI2_MENU_EMAILS', 'Email Templates');
DEFINE('_SOBI2_CONFIG_MAIL_LINK_MARKERS', 'Placeholder description');
DEFINE('_SOBI2_CONFIG_MAIL_ABOUT_MARKERS', 'The following placeholders can be used in the emails: ' .
'<ul>' .
'<li>{sobi} - will be replaced with SOBI2 name (adjustable in General configuration - Component Name)</li>' .
'<li>{sitename} - will be replaced with live site name</li>' .
'<li>{user} - will be replaced with user name</li>' .
'<li>{id} - will be replaced with SOBI2 Id</li>' .
'<li>{title} - will be replaced with entry title</li>' .
'<li>{link_details} - will be replaced with link to details view</li>' .
'<li>{link_edit} - will be replaced with link to edit function</li>' .
'<li>{expiration_date} - will be replaced with date the entry will stop publishing</li>' .
'<li>{expiration_time} - will be replaced with the number of days of publishing</li>' .
'<li>{selected_options}  - will be replaced with selected non free options (only for payment emails)</li>' .
'<li>{total}  - will be replaced with total amount of non free options (only for payment emails)</li>' .
'<li>{paypal_url}  - will be replaced with PayPal URL (only for payment emails)</li>' .
'<li>{bank_data}  - will be replaced with with bank data info for payments (only for payment emails)</li>' .
'</ul>' .
'Additionaly you can use every field name as placeholder. For example: {field_email} will be replaced with content entered in field_email. In this case with the email address.');

DEFINE('_SOBI2_CONFIG_EMAILS', 'Email Texts');
DEFINE('_SOBI2_CONFIG_FOOTER', 'Email Signature');
DEFINE('_SOBI2_CONFIG_FOOTER_EXPL', 'This text will be added to every email.');
DEFINE('_SOBI2_PLEASE_WAIT', 'Please wait ... ');
DEFINE('_SOBI2_READY', 'Ready: ');
DEFINE('_SOBI2_SELECT_OPTION_TO_EDIT', 'Select Email Template to Edit: ');
DEFINE('_SOBI2_EMAIL_ON_SUBMIT', 'On Add Entry (user)');
DEFINE('_SOBI2_EMAIL_ON_UPDATE', 'On Edit Entry (user)');
DEFINE('_SOBI2_EMAIL_ON_APPROVE', 'On Approve Entry (user)');
DEFINE('_SOBI2_EMAIL_ON_PAYMENT', 'Payment Email (user)');
DEFINE('_SOBI2_EMAIL_ON_SUBMIT_ADMIN', 'On Add Entry (admin)');
DEFINE('_SOBI2_EMAIL_ON_UPDATE_ADMIN', 'On Edit Entry (admin)');
DEFINE('_SOBI2_EMAIL_ON_PAYMENT_ADMIN', 'Payment Email (admin)');
DEFINE('_SOBI2_EMAIL_TEXT', 'Email Text: ');
DEFINE('_SOBI2_EMAIL_TITLE', 'Email Subject: ');
DEFINE('_SOBI2_CONFIG_MAIL_LANG_EXPL', 'Select language to edit the fields in.');
DEFINE('_SOBI2_CONFIG_MAIL_LANG', 'Select Language ');

DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT_EXPL', 'Send email to admins if a new entry with not free options was added.');


/*
* added 02.10.2006 (RC 1)
*/
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT', 'Send Payment Email to Admins');
DEFINE('_SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE', 'You have to edit the field to change this option');
DEFINE('_SOBI2_CONFIG_FIELDS_CANNOT_BE_CHANGE', 'This option cannot be changed');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ON', 'Show Google Maps');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ON_EXPL', 'Show/Hide the map (requires Google Api Key)');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_API', 'API Key');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_API_EXPL', 'Google Maps Api Key for the site');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_W', 'Map Width');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_W_EXPL', 'The map\'s width in pixel.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_H', 'Map Height');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_H_EXPL', 'The map\'s height in pixel.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LAT', 'Map Latitude Field');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LAT_EXPL', 'Select the field where the latitude for the map is saved.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LON', 'Map Longitude Field');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LON_EXPL', 'Select the field where the longitude for the map is saved.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE', 'Info Bubble');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EXPL', 'Opens the Information bubble with the \'Get Directions\' Form.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_DISABLE', 'Disable Directions Info Bubble');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_WAIT', 'Enable but open Bubble only if Marker is clicked');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_OPEN', 'Enable and open Bubble when Map is loaded');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM', 'Zoom Level');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM_EXPL', 'Initial Zoom level for the map.');

/*
* added 26.09.2006 (Beta 2.2)
*/
DEFINE('_SOBI2_CONFIG_SECIMG_USING_FAILED', 'Your server does not support any function needed to create a security image and therefore this function is disabled.');

/*
* added 23.09.2006 (Beta 2.1)
*/
DEFINE('_SOBI2_CONFIG_ENTRY_MAX_FILE_SIZE', 'Max. Size of Uploaded Files');
DEFINE('_SOBI2_CONFIG_ENTRY_FILE_SIZE_BYTES', 'kB');

/*
* added 18.09.2006
*/
DEFINE('_SOBI2_MENU_LANG_MANAGER', 'Language Manager');
DEFINE('_SOBI2_CONFIG_LANGMAN_INSTALL_NEW', 'Install New Language Package');
DEFINE('_SOBI2_CONFIG_LANGMAN_INSTALL_BT', 'Install');
DEFINE('_SOBI2_CONFIG_LANGMAN_NO_FILE', 'Error: missing uploaded language package');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR', 'Error: Not an allowed file extension. Installation aborted.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR', 'Error: Could not copy package to installation folder. Installation aborted.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR', 'Error: Could not extract package. Installation aborted.');
DEFINE('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR', 'Error: Could not parse XML file. Installation aborted.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FP_FILE_COPY_ERROR', 'Error: Could not copy frontend file. Installation aborted.');
DEFINE('_SOBI2_CONFIG_LANGMAN_BE_FILE_COPY_ERROR', 'No backend language file. ');
DEFINE('_SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR', 'Warning: Missing custom field labels. ');
DEFINE('_SOBI2_CONFIG_LANGMAN_ALL_LABELS_INSTALLED', 'New language installed correctly.');
DEFINE('_SOBI2_CONFIG_LANGMAN_NOT_ALL_LABELS_INSTALLED', 'Warning: Missing some labels. ');

/*
* added 14.09.2006
*/
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT', 'Inform Administrators about Changes');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT_EXPL', 'Inform the administrators if an customer/author has changed his entry.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW', 'Send Confirmation Email');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW_EXPL', 'Send confirmation email about his new entry to the customer/author.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT', 'Send Confirmation Email about Changes');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT_EXPL', 'Send confirmation email about his changes to the customer/author. No email will be send if administrator changes the entry over the backend.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED', 'Send Confirmation Email about Approval');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED_EXPL', 'Inform the customer/author if his entry has been approved.');

/*
* general labels
*/
DEFINE('_SOBI2_SEND_L', 'Send');
DEFINE('_SOBI2_YES_U', 'Yes');
DEFINE('_SOBI2_NO_U', 'No');
DEFINE('_SOBI2_ADD_U', 'Add');
DEFINE('_SOBI2_ALL_U', 'All');
DEFINE('_SOBI2_CATEGORY_L', 'category');
DEFINE('_SOBI2_CATEGORY_H', 'Category');
DEFINE('_SOBI2_CATEGORIES_L', 'categories');
DEFINE('_SOBI2_CATEGORIES_H', 'Categories');
DEFINE('_SOBI2_IS_FREE_L', 'is for free');
DEFINE('_SOBI2_IS_NOT_FREE_L', 'is not free');
DEFINE('_SOBI2_COST_L', 'It costs');
DEFINE('_SOBI2_NOT_AUTH', 'You are not authorized to see this page');
DEFINE('_SOBI2_SELECT', 'select');
DEFINE('_SOBI2_SEARCH_H', 'Search');
DEFINE('_SOBI2_ADD_NEW_ENTRY', 'Add new entry');
DEFINE('_SOBI2_NUMBER_H', 'Number');
DEFINE('_SOBI2_NEVER_U', 'Never');
DEFINE('_SOBI2_CONFIRM_DELETE', 'Are you really want to delete this item? \n' .
'Please notice, that all data will be deleted irrevocably!');
DEFINE('_SOBI2_PUBLISHED', 'Published');
DEFINE('_SOBI2_CONFIRMED', 'Confirmed');
DEFINE('_SOBI2_APPROVED', 'Approved');
DEFINE('_SOBI2_REORDER', 'Reorder');
DEFINE('_SOBI2_ORDER', 'Order');
DEFINE('_SOBI2_GUEST', 'Guest');
DEFINE('_SOBI2_LANGUAGE_L', 'language');
DEFINE('_SOBI2_CANCEL', 'Cancel');
DEFINE('_SOBI2_SAVE', 'Save');
DEFINE('_SOBI2_IMAGE_U', 'Image');
DEFINE('_SOBI2_IMAGES_U', 'Images');
DEFINE('_SOBI2_META_U', 'Meta Info');
DEFINE('_SOBI2_PUBLISHING_U', 'Publishing');
DEFINE('_SOBI2_MOVE_UP', 'Move up');
DEFINE('_SOBI2_MOVE_DOWN', 'Move down');
DEFINE('_SOBI2_MENU', 'SOBI2 Menu');
DEFINE('_SOBI2_SAVING_ERROR', 'Internal error while saving data. Please try again');
DEFINE('_SOBI2_GENERAL_FILE_ERROR', 'Could not open ');
DEFINE('_SOBI2_DAYS_L', 'days');
/*
* menu
*/
DEFINE('_SOBI2_MENU_LISTING_AND_CATS', 'Entries &amp; Categories');
DEFINE('_SOBI2_MENU_AWAITING_APPR', 'Awaiting approval');
DEFINE('_SOBI2_MENU_CONFIG', 'Configuration');
DEFINE('_SOBI2_MENU_GENERAL_CONFIG', 'General Configuration');
DEFINE('_SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG', 'Entry Configuration');
DEFINE('_SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG', 'View Configuration');
DEFINE('_SOBI2_MENU_FIELDS_DATA', 'Fields &amp; Data');
DEFINE('_SOBI2_MENU_EDIT_CSS', 'CSS File');
DEFINE('_SOBI2_MENU_ABOUT', 'About');
DEFINE('_SOBI2_MENU_UNINSTALL_SOBI', 'Uninstall SOBI2');
DEFINE('_SOBI2_MENU_ABOUT_SOBI', 'About SOBI2');
/*
* tabs
*/
DEFINE('_SOBI2_TABHR_CATS', 'Categories');
DEFINE('_SOBI2_TABHR_ITEMS', 'Entries');

/*
* Category Manager
*/
DEFINE('_SOBI2_CATS_MANAGER', 'Category Manager');
DEFINE('_SOBI2_CAT_NAME', 'Category Name');
DEFINE('_SOBI2_CAT_INTROTEXT', 'Introtext');
DEFINE('_SOBI2_CAT_INTROTEXT_EXPL', 'Short text about the category. Also be added to meta description. Please do not enter HTML-Code or Newlines');
DEFINE('_SOBI2_CAT_DESCRIPTION', 'Category Description');
DEFINE('_SOBI2_NO_CATS_IN_CAT', '<h3>&nbsp; &nbsp; No (sub)categories in this category</h3>');

/*
* Entry Manager
*/
DEFINE('_SOBI2_LISTING_MANAGER', 'Entry Manager');
DEFINE('_SOBI2_NO_ITEMS_IN_CAT', '<h3>&nbsp; &nbsp; No entries in this category</h3>');
DEFINE('_SOBI2_LISTING_TITLE', 'Entry Title');
DEFINE('_SOBI2_LISTING_ADDED', 'Created');
DEFINE('_SOBI2_NEW_ORDERING_SAVED', 'New ordering saved');
DEFINE('_SOBI2_UNAPPROVED_MANAGER', 'Unapproved Entries');
DEFINE('_SOBI2_NO_ITEMS_AW_APP', '<h3>No entries awaiting approval</h3>');
DEFINE('_SOBI2_LISTING_OWNER', 'Creator');
DEFINE('_SOBI2_LISTING_OWNER_TYPE', 'User Group');
DEFINE('_SOBI2_LISTING_UPDATING_USER', 'Last Modified From');
DEFINE('_SOBI2_LISTING_ALL_ENTRIES', 'All Entries');

/*
* toolbar
*/
DEFINE('_SOBI2_TOOLBAR_EDIT', 'Edit');
DEFINE('_SOBI2_TOOLBAR_ADD_NEW', 'Add New: ');
DEFINE('_SOBI2_TOOLBAR_REMOVE', 'Remove');
DEFINE('_SOBI2_TOOLBAR_REMOVE_EXPL', 'Removing item from the category');
DEFINE('_SOBI2_TOOLBAR_DEL', 'Delete');
DEFINE('_SOBI2_TOOLBAR_DEL_EXPL', 'Deleting item permanently');
DEFINE('_SOBI2_TOOLBAR_MOVE', 'Move');
DEFINE('_SOBI2_TOOLBAR_COPY', 'Copy');
DEFINE('_SOBI2_TOOLBAR_PUBLISH', 'Publish');
DEFINE('_SOBI2_TOOLBAR_UNPUBLISH', 'Unpublish');
DEFINE('_SOBI2_TOOLBAR_APPROVE', 'Approve');
DEFINE('_SOBI2_TOOLBAR_UNAPPROVE', 'Unapprove');
DEFINE('_SOBI2_TOOLBAR_CONFIRMED', 'Confirmed');
DEFINE('_SOBI2_TOOLBAR_UNCONFIRMED', 'Not confirmed');

define('_SOBI2_SAVE_DUPLICATE_ENTRY', 'An entry with this name already exists.');
define('_SOBI2_SAVE_NOT_ALLOWED_IMG_EXT', 'The uploaded file has a not allowed extension and therefore is was not added.');
define('_SOBI2_SAVE_UPLOAD_IMG_FILED', 'Image file upload failed!');
define('_SOBI2_SAVE_UPLOAD_IMG_OK', 'Image file for company logo uploaded!');
define('_SOBI2_SAVE_UPLOAD_ICO_OK', 'Image file for company icon uploaded!');
define('_SOBI2_SAVE_UPLOAD_IMG_FAILED', 'Image file for company logo upload failed!');
define('_SOBI2_SAVE_UPLOAD_ICO_FAILED', 'Image file for company icon upload failed!');
define('_SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED', 'Not all required fields are filled in!');
define('_SOBI2_SAVE_ICON_FEES', 'Company Icon');
define('_SOBI2_SAVE_IMAGE_FEES', 'Company Logo');
define('_SOBI2_CHANGES_SAVED', 'All Changes Saved');

DEFINE('_SOBI2_ITEM_REMOVED_FROM_CAT', 'Items removed from this category');
DEFINE('_SOBI2_CANNOT_REMOVE_CAT', 'Category cannot be removed. A category can only be deleted');
DEFINE('_SOBI2_CAT_DELETED', 'Categories deleted');
DEFINE('_SOBI2_ITEM_DELETED', 'Entries deleted');
DEFINE('_SOBI2_ITEM_MOVE', 'Move items');
DEFINE('_SOBI2_ITEM_COPY', 'Copy items');
DEFINE('_SOBI2_ITEMS_MOVED', 'All items moved');
DEFINE('_SOBI2_NOT_ALL_ITEMS_MOVED', 'Not all items could be moved. Some items are already in target category');
DEFINE('_SOBI2_ITEMS_COPIED', 'All items copied');
DEFINE('_SOBI2_NOT_ALL_ITEMS_COPIED', 'Not all items could be copied. Some items are already in target category');
DEFINE('_SOBI2_ITEMS_TO_MOVE', 'Items being moved:');
DEFINE('_SOBI2_ITEMS_TO_COPY', 'Items being copied:');
DEFINE('_SOBI2_SELECT_TARGER_CAT', 'Select Target Category');
DEFINE('_SOBI2_CATS_MOVED', 'All categories moved');
DEFINE('_SOBI2_NOT_ALL_CATS_MOVED', 'Not all categories could be moved');
DEFINE('_SOBI2_CAT_COPY', 'Copy Categories');
DEFINE('_SOBI2_CATS_TO_COPY', 'Categories being copied:');
DEFINE('_SOBI2_CAT_COPY_ITEMS_TOO', 'Copy entries too');
DEFINE('_SOBI2_CAT_MOVE', 'Move Categories');
DEFINE('_SOBI2_CATS_TO_MOVE', 'Categories being moved:');
DEFINE('_SOBI2_CATS_COPIED', 'All categories copied');
DEFINE('_SOBI2_NOT_ALL_CATS_COPIED', 'Not all categories could be copied.');

/*
* editing entry
*/
DEFINE('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Add New Entry');
DEFINE('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Edit Entry');
DEFINE('_SOBI2_FORM_ENTRY_DETAILS', 'Entry Details');
DEFINE('_SOBI2_FORM_IMG_LABEL', 'Company logo');
DEFINE('_SOBI2_FORM_IMG_EXPL', 'This image will be shown in details view.');
DEFINE('_SOBI2_FORM_YOUR_IMG_LABEL', 'Company Logo: ');
DEFINE('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Change Company Logo: ');
DEFINE('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remove Company Logo');
DEFINE('_SOBI2_FORM_ICO_LABEL', 'Icon for Frontend VCard');
DEFINE('_SOBI2_FORM_ICO_EXPL', 'This image will be shown in category list.');
DEFINE('_SOBI2_FORM_YOUR_ICO_LABEL', 'Icon: ');
DEFINE('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Change Icon: ');
DEFINE('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remove Icon');
DEFINE('_SOBI2_FORM_SAFETY_CODE', 'Safety Code');
DEFINE('_SOBI2_FORM_NOT_FREE_OPTION', 'This option is not free.');
DEFINE('_SOBI2_FORM_SELECT_CATEGORY', 'Please select categories for the entry');
DEFINE('_SOBI2_FORM_CAT_1', 'First Category');
DEFINE('_SOBI2_FORM_PRICE_IS', 'The Price is');
DEFINE('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
DEFINE('_SOBI2_FORM_FIELD_REQ_INFO', 'All fields marked with '._SOBI2_FORM_FIELD_REQ_MARK.' are required.');
DEFINE('_SOBI2_FORM_META_KEYS_LABEL', 'Enter terms for meta keywords: ');
DEFINE('_SOBI2_FORM_META_KEYS_EXPL', 'The entered terms will be used as keywords for search engines');
DEFINE('_SOBI2_FORM_META_DESC_LABEL', 'Enter text for meta description: ');
DEFINE('_SOBI2_FORM_META_DESC_EXPL', 'The entered description will be use as description text for search engines');
DEFINE('_SOBI2_FORM_JS_SELECT_CAT', 'Please select category first');
DEFINE('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'You must accept the terms of use first');
DEFINE('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Please fill in all required fields');
DEFINE('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'This category is already added');
DEFINE('_SOBI2_LISTING_EXPIRES', 'Expires At');
DEFINE('_SOBI2_UPDATED_AT', 'Last Modified At');
DEFINE('_SOBI2_HITS', 'Hits');
DEFINE('_SOBI2_HITS_RESET', 'Reset Hit Count');
DEFINE('_SOBI2_SELECTED_CATS', 'Selected Categories');
DEFINE('_SOBI2_EDITING_LISTING', 'Editing SOBI2 entry');
DEFINE('_SOBI2_LISTING_CHECKED_OUT', 'This entry is currently being edited by another user');
DEFINE('_SOBI2_FORM_ENTRY_TITLE', 'Company name'._SOBI2_FORM_FIELD_REQ_MARK);
DEFINE('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "You can add this entry in up to {$config->maxCatsForEntry} categories");
DEFINE('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Description:');
define('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_L);
define('_SOBI2_FORM_REMOVE_CAT_BT','Remove '._SOBI2_CATEGORY_L);

/*
* editing category
*/
DEFINE('_SOBI2_CAT_DETAILS', 'Category Details');
DEFINE('_SOBI2_IMAGE_POS', 'Image Position');
DEFINE('_SOBI2_ICON', 'Icon');
DEFINE('_SOBI2_CAT_ICON_EXPL', 'Icon is a small image shown in the list of categories in frontend');
DEFINE('_SOBI2_PREVIEW', 'Images Preview');
DEFINE('_SOBI2_CAT_WITHOUT_NAME', 'Category must have a name');
DEFINE('_SOBI2_CAT_WITHOUT_PARENT', 'Please select parent category');
DEFINE('_SOBI2_CATEGORY_CHECKED_OUT', 'This category is currently being edited by another administrator');
DEFINE('_SOBI2_ADD_NEW_CAT', 'Add new category');
DEFINE('_SOBI2_SELECTED_PARENT_ID', 'Parent Category ID');
DEFINE('_SOBI2_NOT_ALL_CHANGES_SAVED', 'Not all changes could be saved');
DEFINE('_SOBI2_PARENT_CAT', 'Parent Category');
DEFINE('_SOBI2_SELECT_PARENT_CAT', 'Select Parent Category');
DEFINE('_SOBI2_EDITING_CAT', 'Category being edited');

/*
* fields manager
*/
DEFINE('_SOBI2_FIELDS_MANAGER', 'Custom Fields Manager');
DEFINE('_SOBI2_FIELD_NAME', 'Field Name');
DEFINE('_SOBI2_FIELD_NAME_EXPL', 'Unique name of the field.');
DEFINE('_SOBI2_FIELD_LABEL', 'Field Label');
DEFINE('_SOBI2_FIELD_LABEL_EXPL', 'Label for the field. Shown in New/Edit Entry form and in Category and Details View (except text code) if selected.');
DEFINE('_SOBI2_FIELD_TYPE', 'Field Type');
DEFINE('_SOBI2_FIELD_TYPE_EXPL', 'Select the type of the field.');
DEFINE('_SOBI2_FIELD_FREE', 'For Free');
DEFINE('_SOBI2_FIELD_FREE_EXPL', 'Select if this field is free or not.');
DEFINE('_SOBI2_FIELD_ENABLED', 'Published');
DEFINE('_SOBI2_FIELD_ENABLED_EXPL', 'Select if field is published or not.');
DEFINE('_SOBI2_FIELD_REQUIRED', 'Required');
DEFINE('_SOBI2_FIELD_REQUIRED_EXPL', 'Select if field input is obligatory.');
DEFINE('_SOBI2_FIELD_IN_VCARD', 'In Category View');
DEFINE('_SOBI2_FIELD_IN_DETAILS', 'In Details View');
DEFINE('_SOBI2_ALL_FIELDS_NAMES', 'Field labels in ');
DEFINE('_SOBI2_ALL_FIELDS_NAMES2', '. If you want to edit the labels for another language, please change the base language of SOBI2.');
DEFINE('_SOBI2_FIELD_CONSTANT', 'Deletable');
DEFINE('_SOBI2_FIELD_NOT_FREE', 'Not free');
DEFINE('_SOBI2_FIELD_DISABLED', 'Unpublished');
DEFINE('_SOBI2_FIELD_NOT_REQUIRED', 'Not required');
DEFINE('_SOBI2_TOOLBAR_ADD_NEW_FIELD', 'Add new');
DEFINE('_SOBI2_FIELD_CHECKED_OUT', 'This field is currently being edited by another administrator');
DEFINE('_SOBI2_FIELD_DETAILS', 'Field Details');
DEFINE('_SOBI2_FIELD_HELP', 'Description/Explanation');
DEFINE('_SOBI2_FIELD_NOT_EDITABLE_EXPL', 'Predefined Field. Therefore some options are disabled.');
DEFINE('_SOBI2_FIELD_CSS_CLASS', 'CSS Class');
DEFINE('_SOBI2_FIELD_CSS_CLASS_EXPL', 'CSS class used for the New/Edit Entry form.<br />The CSS classes for the Category and Details View will be created automatically using the field name.<br />For the Category View: span.sobi2Listing_field_xxx<br />For the Details View: span#sobi2Details_field_xxx');
DEFINE('_SOBI2_FIELD_PREFERRED_SIZE', 'Preferred Size');
DEFINE('_SOBI2_FIELD_MAX_LENGTH', 'Max. Length');
DEFINE('_SOBI2_FIELD_MAX_LENGTH_EXPL', 'Maximum number of characters. Valid only if inputbox is the selected type.');
DEFINE('_SOBI2_FIELD_PAYMENT', 'Fee');
DEFINE('_SOBI2_FIELD_PAYMENT_EXPL', 'Amount of fee if the field is not free.');
DEFINE('_SOBI2_FIELD_DISPLAYING', 'Show Field');
DEFINE('_SOBI2_FIELD_DISPLAYING_EXPL', 'Select the views where the field should be shown. Select Hidden if the input of the field should be shown nowhere.');
DEFINE('_SOBI2_FIELD_DO_NOT_DISPLAY', 'Hidden');
DEFINE('_SOBI2_FIELD_IS_URL', 'URL Field');
DEFINE('_SOBI2_FIELD_IN_NEW_LINE', 'Add New Line');
DEFINE('_SOBI2_FIELD_IN_NEW_LINE_EXPL', 'A Newline will be added in front of this field.');
DEFINE('_SOBI2_FIELD_WITH_LABEL', 'Show Label');
DEFINE('_SOBI2_FIELD_WITH_LABEL_EXPL', 'The label will be shown even in the Category and Details View.');
DEFINE('_SOBI2_FIELD_IN_SEARCH', 'Search Method');
DEFINE('_SOBI2_FIELD_IN_SEARCH_EXPL', 'Search for this field in the general search or using select boxes. If no is selected searching is not performed for the field.');
DEFINE('_SOBI2_FIELD_SEARCH_SELECT_BOX', 'Select Box');
DEFINE('_SOBI2_FIELD_SEARCH_SEARCH_IN', 'General Search');
DEFINE('_SOBI2_FIELD_DESCRIPTION', 'Field Description');
DEFINE('_SOBI2_FIELD_DESCRIPTION_EXPL', 'If a description for the field is entered, it will be shown in the New/Edit Entry form as tooltip of an information symbol.');
DEFINE('_SOBI2_FIELD_WITHOUT_NAME', 'Field must have a name');
DEFINE('_SOBI2_FIELD_USE_WYSIWYG', 'Use WYSIWYG Editor');
DEFINE('_SOBI2_FIELD_ROWS', 'Rows');
DEFINE('_SOBI2_FIELD_COLS', 'Columns');
DEFINE('_SOBI2_ADD_NEW_FIELD', 'Add new field');
DEFINE('_SOBI2_FIELD_NAME_DUPLICAT', 'A field with this name already exists. A new name was automatically generated. Please check the name.');
DEFINE('_SOBI2_FIELDS_DELETED', 'Fields deleted');
DEFINE('_SOBI2_NOT_ALL_FIELDS_DELETED', 'Not all fields could be deleted');

/*
* configuration
*/
DEFINE('_SOBI2_CONFIG', 'Configuration');
DEFINE('_SOBI2_CONFIG_GEN', 'General');
DEFINE('_SOBI2_CONFIG_GEN_OPTION', 'General Options');
DEFINE('_SOBI2_CONFIG_COMPONENT_NAME', 'Component Name');
DEFINE('_SOBI2_CONFIG_COMPONENT_NAME_EXPL', 'Will be shown in SOBI2 menu as component link. Will be added to meta tags, etc.');
DEFINE('_SOBI2_CONFIG_FRONTPAGE', 'Mainpage');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION', 'Show Description of Component');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT', 'Description of Component');
DEFINE('_SOBI2_CONFIG_GENERAL_IMG_FOR_DESCRIPTION', 'Image for Description');
DEFINE('_SOBI2_CONFIG_LANGUAGE', 'SOBI2 Language');
DEFINE('_SOBI2_CONFIG_LANGUAGE_EXPL', 'Set to default if you want to use the CMS main language.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_HP_LINK', 'Show Component Link');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_NEW_ENTRY_LINK', 'Show Link "Add Entry"');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_SEARCH_LINK', 'Show Link "Search"');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP', 'Show Entries on Mainpage');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP_EXPL', 'If yes, all entries will be shown on the first page of SOBI2 component (General View).');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE', 'Number of Entries in a Single Line');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE', 'Number of Lines on a Page');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP', 'Show Categories on Mainpage');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP_EXPL', 'If yes, all categories will be shown on the first page of SOBI2 component (General View).');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE', 'Number of Categories in a Single Line');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS', 'Show Entries of Subcategories');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS_EXPL', 'If yes, all entries of the subcategories will be shown also in parent category.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_ICO_IN_VC', 'Display Icon in Category View');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LOGO_IN_VC', 'Display Image in Category View');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_META', 'Use Meta Tags');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_META_EXPL', 'Allow user adding its own meta tags and meta keys.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_INFO', 'Show Description of Category');

DEFINE('_SOBI2_CONFIG_GENERAL_SORT_TITLE_ASC', 'title ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_TITLE_DESC','title descending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ADDED_ASC', 'date added ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ADDED_DESC','date added descending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_HITS_ASC',  'hits ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_HITS_DESC', 'hits descending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_NAME_ASC', 'name ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_NAME_DESC','name descending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_COUNT_ASC', 'count ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_COUNT_DESC','count descending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC', 'ordering ascending');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC','ordering descending');

DEFINE('_SOBI2_CONFIG_GENERAL_PERMS','Editing Permissions');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_EDIT','Allow User to Edit its own Entries');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_DEL','Allow Deletion');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_DEL_EXPL','Select if user is able to delete or only unpublish its own entries.');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_UNPUBLISH','Only unpublish');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_LISTING_BY','Sort Entries by');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_CATS_BY','Sort Categories by');

DEFINE('_SOBI2_CONFIG_FIELDS', 'Fields');
DEFINE('_SOBI2_CONFIG_FIELDS_DESC', 'Constant Fields Configuration (Title, Image and Icon)');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LABEL', 'Title Label');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LABEL_EXPL', 'Label of the first inputbox in New/Edit Entry form (entry title).');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LENGTH', 'Length of Title Inputbox');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LENGTH_EXPL', 'Length of the first inputbox in New/Edit Entry form (entry title)');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI', 'Allow Duplicate Titles');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI_EXPL', 'Allow adding more than one entry with this same title');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_IMG', 'Allow Adding Images');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ICO', 'Allow Adding Icons');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_IMG', 'Resize Image To');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_IMG_EXPL', 'Set maximal height and width for the image. If uploaded image is larger, it will be resized.');
DEFINE('_SOBI2_CONFIG_ENTRY_W', 'Width: ');
DEFINE('_SOBI2_CONFIG_ENTRY_H', 'Height: ');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_ICO', 'Resize Icon To');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_ICO_EXPL', 'Set maximal height and width for the icon. If uploaded icon is larger, it will be resized.');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE', 'Yes, but not free ');
DEFINE('_SOBI2_CONFIG_ENTRY_IMG_LABEL', 'Image Label');
DEFINE('_SOBI2_CONFIG_ENTRY_IMG_LABEL_EXPL', 'Label for the image inputbox in New/Edit Entry form.');
DEFINE('_SOBI2_CONFIG_ENTRY_PRICE_IMG', 'Price For Image');
DEFINE('_SOBI2_CONFIG_ENTRY_PRICE_ICO', 'Price For Icon');
DEFINE('_SOBI2_CONFIG_ENTRY_ICO_LABEL', 'Icon Label');
DEFINE('_SOBI2_CONFIG_ENTRY_ICO_LABEL_EXPL', 'Label for the small image inputbox in New/Edit Entry form. The small image is usually shown in the Category View.');
DEFINE('_SOBI2_CONFIG_ENTRY_UP_TO_CATS', "Allow Adding Entry up to");
DEFINE('_SOBI2_CONFIG_ENTRY_2_CAT', 'Entry In Second Category');
DEFINE('_SOBI2_CONFIG_ENTRY_2_CAT_PRICE', 'Price For Entry In Second Category');
DEFINE('_SOBI2_CONFIG_ENTRY_3_CAT', 'Entry In Third category');
DEFINE('_SOBI2_CONFIG_ENTRY_3_CAT_PRICE', 'Price For Entry In Third Category');
DEFINE('_SOBI2_CONFIG_ENTRY_4_CAT', 'Entry In Fourth category');
DEFINE('_SOBI2_CONFIG_ENTRY_4_CAT_PRICE', 'Price For Entry In Fourth Category');
DEFINE('_SOBI2_CONFIG_ENTRY_5_CAT', 'Entry In Fifth category');
DEFINE('_SOBI2_CONFIG_ENTRY_5_CAT_PRICE', 'Price For Entry In Fifth Category');
DEFINE('_SOBI2_CONFIG_ENTRY_SAFETY', 'Safety');
DEFINE('_SOBI2_CONFIG_ENTRY_SAFETY_OPTIONS', 'Safety Options');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ANO', 'Allow Anonymous Entries');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ANO_EXPL', 'Allow unregistered users to add entries.');
DEFINE('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH', 'Publish Entries Automatically');
DEFINE('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH_EXPL', 'A new entry will be published directly without approval of an administrator.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN', 'Inform Administrators');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EXPL', 'Inform the administrators of new entries.');

DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUNDS','Background');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUNDS_AND_BORDERS','Background And Border Color Settings');
DEFINE('_SOBI2_CONFIG_GENERAL_BORDERS','Border Color');
DEFINE('_SOBI2_CONFIG_GENERAL_BORDER_EXPL','Border color of entries in Category and Details View');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUND','Background Image');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUND_EXPL','Background image of entries in Category and Details View');

DEFINE('_SOBI2_CONFIG_ENTRY_EXP_TIME', 'Stop Publishing After');
DEFINE('_SOBI2_CONFIG_ENTRY_EXP_TIME_EXPL', 'How many days an entry should be published. Set to 0 or leave empty if entries never expire.');
DEFINE('_SOBI_CONFIG_ENTRY_USE_SEC_IMG', 'Use Safety Code');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG', 'Safety Code');
DEFINE('_SOBI_CONFIG_ENTRY_USE_SEC_IMG_EXPL', 'Activate function to prevent automatized entering by robots.');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_FONTCOLOR', 'Font Color');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_LINECOLOR', 'Grid Color');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_BGCOLOR', 'Background Color');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_BORDERCOLOR', 'Frame Color');
DEFINE('_SOBI_CONFIG_ENTRY_ACCEPT_RULES', 'Terms Of Use');
DEFINE('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES', 'User has to accept the terms of use');
DEFINE('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES_EXPL', 'Decide, if an user has to accept the terms of use to make an entry.');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1', 'Label for the Terms Of Use Part 1');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL', 'Link to the Terms Of Use');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT', 'Text of link to the terms of use');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2', 'Label for the Terms Of Use Part 2');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABELS_EXPL', '<h4>This will create a label like that: &nbsp;&nbsp;&nbsp;&nbsp;<span class="editlinktip">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),'','','I accept the', '#',0 )
.'</span>&nbsp;&nbsp;<span class="editlinktip"><a href="#">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT),'','','terms of use', '#',0 )
.'</a></span>&nbsp;&nbsp;<span class="editlinktip">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),'','','of this site', '#',0 )
.'</h4>');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS', 'Configuration of Details View');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ICO', 'Show Icon in Details View');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ICO_EXPL', 'If yes, the small image (icon) will be displayed in details view.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_IMG', 'Show Image in Details View');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_IMG_EXPL', 'If yes, the large image will be displayed in details view.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ADDED_DATE', 'Show Entry Date');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_HITS', 'Show Hits');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH', 'Show Link to Routing Site');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL', 'URL to Routing Site');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL', 'Link Text');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL_EXPL', 'How the link should be shown. For example: Show Routing. Insert images using the img-tag.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL_VAR_EXPL', 'Such an URL normally looks like that:' .
'<div align="left">http://route.com/index.php?tocity=samplecity&toplz=12345&tostreet=sample%20street%2099</div><br />' .
'The following variables are available:' .
'<ul>' .
'<li>STREET - street</li>' .
'<li>ZIPCODE - postcode</li>' .
'<li>CITY - city</li>' .
'<li>COUNTRY - country</li>' .
'<li>FEDSTATE - federal state</li>' .
'<li>COUNTY - county</li>' .
'</ul>' .
'To get an URL as stated above, the link must look like:' .
'<div align="left">http://route.com/index.php?tocity=CITY&toplz=ZIPCODE&tostreet=STREET</div>');

DEFINE('_SOBI2_CONFIG_PAYMENTS_OPTIONS', 'Payment Options');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY', 'Currency Symbol');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR', 'Currency Separator');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR_EXPL', 'Should be a comma or a point. For example 100.99 EUR or 100,99 EUR');
DEFINE('_SOBI2_CONFIG_PAYMENTS_TITLE', 'Payment Reference');
DEFINE('_SOBI2_CONFIG_PAYMENTS_TITLE_EXPL', 'Text will be used as bank transfer reference or PayPal payment reference. The SOBI2 ID number will be appended.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_TRANSFER', 'Bank/eCheck Transfer Options');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER', 'Use Bank/eCheck Transfer');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_EXPL', 'If yes, user can pay via bank/eCheck transfer. Bank account/eCheck data are displayed on the summary page or sent via email.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_OVER_EMAIL', 'Yes, but send bank account/eCheck data via email');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_ON_PAGE', 'Yes, and display bank account/eCheck data on summary page');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_DATA', 'Bank Account/eCheck Data');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_DATA_EXPL', 'Insert your bank account/eCheck data here');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL', 'PayPal Options');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL', 'Use PayPal');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL_EXPL', 'If yes, user can pay via PayPal.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_EMAIL', 'Email Address');
DEFINE('_SOBI2_GENERAL_FILE_IS', ' file is: ');
DEFINE('_SOBI2_GENERAL_FILE_WRITABLE', '<span style="color: rgb(0, 128, 0); font-weight: bold;">Writable</span>');
DEFINE('_SOBI2_GENERAL_FILE_UNWRITABLE', '<span style="color: rgb(255, 0, 0); font-weight: bold;">Unwritable</span>');
DEFINE('_SOBI2_GENERAL_DO_FILE_UNWRITABLE', 'Make unwriteable after saving');
DEFINE('_SOBI2_GENERAL_DO_FILE_WRITABLE', 'Overwrite write protection');

DEFINE('_SOBI2_UNINSTALL_DB_TXT', '<div style="text-align:left">' .
'<h2>SOBI2 Database Remove</h2>' .
'There are two possibilities to uninstall the SOBI2 component:<br />' .
'<ul>' .
'  <li>Only the component: in this case, only the component will be' .
' uninstalled. The entries in the database are preserved.' .
' This possibility is meant for possible updates. ' .
' Thereto it is enough to uninstall only the component' .
' using the standard Installer/Uninstaller of the CMS.<br /></li>' .
'  <li>Complete uninstallation: For that you have to remove the corresponding tables from ' .
' the database first. After that, the component can be uninstalled' .
' using the standard Installer/Uninstaller of the CMS.' .
' </li>' .
'</ul>' .
'</div>');
DEFINE('_SOBI2_UNINSTALL_DB_LINK', 'Remove SOBI2 tables from database');
DEFINE('_SOBI2_UNINSTALL_DB_CONFIRM', 'Are you really sure to remove the SOBI2 tables from the database?');
DEFINE('_SOBI2_DB_REMOVED_MSG', 'The SOBI2 tables were removed from database successfully. Uninstall the component now.');
DEFINE('_SOBI2_DB_REMOVE_ERROR_MSG', 'The SOBI2 tables were not removed from database. Remove them manually and then uninstall the component.');
?>