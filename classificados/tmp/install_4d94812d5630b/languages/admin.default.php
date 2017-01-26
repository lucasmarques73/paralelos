<?php
/**
* @version $Id: admin.default.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR ) && exit() );
defined('_SOBI2_ADM_EXPERIMENTAL_OPT') or define('_SOBI2_ADM_EXPERIMENTAL_OPT', ' (Experimental)');

/*
 * added (RC 2.9.0.2)
 */
defined('_SOBI2_SET_TPL_DEF_EXPL') or define('_SOBI2_SET_TPL_DEF_EXPL', 'Click to set this template as default SOBI2 template.');
defined('_SOBI2_SET_TPL_DEF') or define('_SOBI2_SET_TPL_DEF', 'Set as default');
defined('_SOBI2_PLUGINS_DEF') or define('_SOBI2_PLUGINS_DEF', 'Default');
defined('_SOBI2_CONFIG_GENERAL_DEF_TMPL') or define('_SOBI2_CONFIG_GENERAL_DEF_TMPL', 'Default Template');
defined('_SOBI2_CONFIG_GENERAL_DEF_TMPL_EXPL') or define('_SOBI2_CONFIG_GENERAL_DEF_TMPL_EXPL', 'Select the default template for SOBI2.');
defined('_SOBI2_CONFIG_GENERAL_SORT_EXP_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_EXP_ASC', 'Expiration Date Ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_EXP_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_EXP_DESC', 'Expiration Date Descending');
/*
 * added (RC 2.9)
 */
defined('_SOBI2_INSTALLER_TPL_DELETE_ERROR') or define('_SOBI2_INSTALLER_TPL_DELETE_ERROR', 'Cannot remove some files or directories');
defined('_SOBI2_INSTALLER_TPL_DELETE_OK') or define('_SOBI2_INSTALLER_TPL_DELETE_OK', 'Template %name% has been removed');
defined('_SOBI2_TPL_INSTALLED_OK') or define('_SOBI2_TPL_INSTALLED_OK', 'Template %name% has been installed');
defined('_SOBI2_CONFIG_TPL_INSTALLED') or define('_SOBI2_CONFIG_TPL_INSTALLED', 'Installed Templates');
defined('_SOBI2_CONFIG_TPL_PACK_UPLOAD') or define('_SOBI2_CONFIG_TPL_PACK_UPLOAD', 'Upload New Template Package');
defined('_SOBI2_MENU_TPL_MANAGER') or define('_SOBI2_MENU_TPL_MANAGER', 'Templates Manager');
defined('_SOBI2_MENU_TEMPLATES') or define('_SOBI2_MENU_TEMPLATES', 'Templates Manager');
defined('_SOBI2_CAT_TPL') or define('_SOBI2_CAT_TPL', 'Template');
defined('_SOBI2_CAT_CHOOSE_TPL') or define('_SOBI2_CAT_CHOOSE_TPL', 'Overwrite Template');
defined('_SOBI2_AVAILABLE_TPL') or define('_SOBI2_AVAILABLE_TPL', 'Available Templates:');
defined('_SOBI2_CAT_CHOOSE_TPL_EXPL') or define('_SOBI2_CAT_CHOOSE_TPL_EXPL', 'You can overwrite the default template and several default settings for this category.');
defined('_SOBI2_CHOOSE_TPL_TO_EDIT') or define('_SOBI2_CHOOSE_TPL_TO_EDIT', 'Choose template to edit:');

/*
 * added (RC 2.8.7)
 */
defined('_SOBI2_APPLY') or define('_SOBI2_APPLY', 'Apply');

/*
 * added (RC 2.8.5)
 */
defined('_SOBI2_DEFAULT_TOOLTIP_TITLE') or define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Tip');

defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW', 'Inform Administrators about Renewal');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW_EXPL', 'Inform the administrators if a customer/author has renewed his entry.');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW', 'Send Confirmation Email about Renewal');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW_EXPL', 'Send confirmation email about renewal of his entry to the customer/author.');

defined('_SOBI2_EMAIL_ON_SUBMIT_OPTGR') or define('_SOBI2_EMAIL_ON_SUBMIT_OPTGR', 'On Add Entry');
defined('_SOBI2_EMAIL_ON_UPDATE_OPTGR') or define('_SOBI2_EMAIL_ON_UPDATE_OPTGR', 'On Edit Entry');
defined('_SOBI2_EMAIL_ON_APPROVE_OPTGR') or define('_SOBI2_EMAIL_ON_APPROVE_OPTGR', 'On Approve Entry');
defined('_SOBI2_EMAIL_ON_PAYMENT_OPTGR') or define('_SOBI2_EMAIL_ON_PAYMENT_OPTGR', 'Payment Email');
defined('_SOBI2_EMAIL_ON_RENEW') or define('_SOBI2_EMAIL_ON_RENEW', 'On Renew Entry (user)');
defined('_SOBI2_EMAIL_ON_RENEW_ADMIN') or define('_SOBI2_EMAIL_ON_RENEW_ADMIN', 'On Renew Entry (admin)');
defined('_SOBI2_EMAIL_ON_RENEW_OPTGR') or define('_SOBI2_EMAIL_ON_RENEW_OPTGR', 'On Renew Entry');

defined('_SOBI2_TOOLBAR_GEN_DEB_REP') or define('_SOBI2_TOOLBAR_GEN_DEB_REP', '<small>System&nbsp;Check</small>');
defined('_SOBI2_MENU_GEN_DEB_REP') or define('_SOBI2_MENU_GEN_DEB_REP', 'Perform System Check');
defined('_SOBI2_MENU_GEN_SYSCHECK_EXPL') or define('_SOBI2_MENU_GEN_SYSCHECK_EXPL', 'Check if all requirements for SOBI2 component are covered'. _SOBI2_ADM_EXPERIMENTAL_OPT);

defined('_SOBI2_TOOLBAR_RECOUNT_NEEDED') or define('_SOBI2_TOOLBAR_RECOUNT_NEEDED', 'There are several changes since the number of sub categories and entries has been recounted. It is maybe necessary to recount them again.');
defined('_SOBI2_TOOLBAR_RECOUNTED_SOFAR') or define('_SOBI2_TOOLBAR_RECOUNTED_SOFAR', ' Categories recounted so far');
defined('_SOBI2_TOOLBAR_RECOUNT_WAIT') or define('_SOBI2_TOOLBAR_RECOUNT_WAIT', ' Please wait. Server discharging pause.');
defined('_SOBI2_TOOLBAR_RECOUNT_RESTART') or define('_SOBI2_TOOLBAR_RECOUNT_RESTART', 'Stand by. Restarting ... ');
defined('_SOBI2_TOOLBAR_RECOUNT_DONE') or define('_SOBI2_TOOLBAR_RECOUNT_DONE', 'Recount done. Recounted: ');
defined('_SOBI2_TOOLBAR_RECOUNT_DONE_C') or define('_SOBI2_TOOLBAR_RECOUNT_DONE_C', ' Categories');
defined('_SOBI2_TOOLBAR_RECOUNT_CATS') or define('_SOBI2_TOOLBAR_RECOUNT_CATS', 'Recount');
defined('_SOBI2_RECOUNT_LAST_DATE') or define('_SOBI2_RECOUNT_LAST_DATE', 'Last Recounted');
defined('_SOBI2_TOOLBAR_RECOUNT_CATS_F') or define('_SOBI2_TOOLBAR_RECOUNT_CATS_F', 'Recount Categories');
defined('_SOBI2_RECOUNT_NOW') or define('_SOBI2_RECOUNT_NOW', 'Recount Now');
defined('_SOBI2_RECOUNT_CATS_HEADER') or define('_SOBI2_RECOUNT_CATS_HEADER', 'Recount the Number of Subcategories and Entries in a Category');

defined('_SOBI2_CONFIG_L2CACHE_ON') or define('_SOBI2_CONFIG_L2CACHE_ON', 'Second Level Cache Enabled');
defined('_SOBI2_CONFIG_L2CACHE_DV_ON') or define('_SOBI2_CONFIG_L2CACHE_DV_ON', 'Caching of Details View Enabled (not recommended)');
defined('_SOBI2_CONFIG_L2CACHE_EXPL') or define('_SOBI2_CONFIG_L2CACHE_EXPL', '<b>Second Level Cache</b> - Allows to cache the whole html site output (category list and entries list separately). ');
defined('_SOBI2_CONFIG_L2CACHE_LIFETIME') or define('_SOBI2_CONFIG_L2CACHE_LIFETIME', 'Second Level Cache Lifetime');
defined('_SOBI2_CONFIG_L2CACHE_LIFETIME_SECONDS') or define('_SOBI2_CONFIG_L2CACHE_LIFETIME_SECONDS', 'Seconds');
defined('_SOBI2_CONFIG_L2CACHE_STRLEN') or define('_SOBI2_CONFIG_L2CACHE_STRLEN', 'Maximum Allowed String Length');
defined('_SOBI2_CONFIG_L2CACHE_STRLEN_EXPL') or define('_SOBI2_CONFIG_L2CACHE_STRLEN_EXPL', 'If you experience problems with the returned cached site, e.g. if parts of the site are missing, you should reduce this value.');

defined('_SOBI2_CONFIG_L3CACHE_EXPL') or define('_SOBI2_CONFIG_L3CACHE_EXPL', '<b>Third Level Cache</b> - Caching of object attributes. This cache will be refreshed for each object, if the entry/category has been changed.');
defined('_SOBI2_CONFIG_L3CACHE_STRLEN') or define('_SOBI2_CONFIG_L3CACHE_STRLEN', 'Maximum Allowed String Length');
defined('_SOBI2_CONFIG_L3CACHE_ON') or define('_SOBI2_CONFIG_L3CACHE_ON', 'Third Level Cache Enabled');
defined('_SOBI2_CONFIG_L3CACHE_CLEAR') or define('_SOBI2_CONFIG_L3CACHE_CLEAR', 'Clear Third Level Cache');

/*
 * added (RC 2.8.4)
 */
defined('_SOBI2_QFIELD_ALLOW') or define('_SOBI2_QFIELD_ALLOW', 'Allow Using \'Quick Edit\'');
defined('_SOBI2_QFIELD_ALLOW_ADM') or define('_SOBI2_QFIELD_ALLOW_ADM', 'For Admins Only');
defined('_SOBI2_QFIELD_ALLOW_EXPL') or define('_SOBI2_QFIELD_ALLOW_EXPL', 'If yes, the registered user will be able to use the quick edit/edit in place function. With this function, it is possible to edit several custom fields directly from the details view by doubleclicking on the fields data. Warning: if an user edits an entry using this function, no emails will be send!');

defined('_SOBI2_CONFIG_ENTRY_RENEWAL') or define('_SOBI2_CONFIG_ENTRY_RENEWAL', 'Renewal');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL', 'Allow Renewal');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL_EXPL', 'If yes, the registered user will be able to renew his entry when it expires.');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS') or define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS', 'Days prior Expiration');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS_EXPL', 'Enter here how many days prior to expiration date, the user should be able to access the renew function.');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT') or define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT', 'Discount');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT_EXPL') or define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT_EXPL', 'Enter here how many percent of discount you want to give (0-100).');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DAYS') or define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS', 'Renew for');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DAYS_EXPL') or define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS_EXPL', 'Select, for how many days an entry should be renewed. If it is set to 0, the default expiration time will be used.');
defined('_SOBI2_CONFIG_DAYS') or define('_SOBI2_CONFIG_DAYS', 'Days');
defined('_SOBI2_CONFIG_ENTRY_RENEWAL_HEADER') or define('_SOBI2_CONFIG_ENTRY_RENEWAL_HEADER', 'Renewal Options');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES') or define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES', 'Delete old Fees');
defined('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES_EXPL') or define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES_EXPL', 'If yes, all selected fees from the total amount of the last period will be deleted. If no, all total amounts are summarized.');

defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER', 'Status: ');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_ALL') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_ALL', 'All');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UP') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UP', 'Unpublished');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_P') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_P', 'Published');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UA') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UA', 'Unapproved');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_A') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_A', 'Approved');
defined('_SOBI2_LISTING_MANAGER_STATUS_FILTER_E') or define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_E', 'Expired');

defined('_SOBI2_REG_MANAGER_SAVE_ERR') or define('_SOBI2_REG_MANAGER_SAVE_ERR', 'Cannot save registry file. Please try to edit it manually.');
defined('_SOBI2_REG_MANAGER_NEW_PAIR') or define('_SOBI2_REG_MANAGER_NEW_PAIR', 'New Key: ');
defined('_SOBI2_REG_MANAGER_ADD_PAIR') or define('_SOBI2_REG_MANAGER_ADD_PAIR', 'Add New Key');
defined('_SOBI2_REG_MANAGER_NEW_SECTION') or define('_SOBI2_REG_MANAGER_NEW_SECTION', 'New Section:');
defined('_SOBI2_REG_MANAGER_ADD_SECTION') or define('_SOBI2_REG_MANAGER_ADD_SECTION', 'Add New Section');
defined('_SOBI2_REG_MANAGER_WARNING') or define('_SOBI2_REG_MANAGER_WARNING', 'Additional Options. Experimental - Use at your own risk!');
defined('_SOBI2_MENU_REG_MANAGER') or define('_SOBI2_MENU_REG_MANAGER', 'Registry Editor');
defined('_SOBI2_MENU_EDIT_FORM_TEMPLATE') or define('_SOBI2_MENU_EDIT_FORM_TEMPLATE', 'Entry Form Template');
defined('_SOBI2_FORM_TEMPLATE_ENABLE') or define('_SOBI2_FORM_TEMPLATE_ENABLE', 'Use the Template instead of the Standard Function');
defined('_SOBI2_FORM_TEMPLATE_ENABLE_EXPL') or define('_SOBI2_FORM_TEMPLATE_ENABLE_EXPL', 'If you want to use the template, you have to add each new custom field to the template manually.');

defined('_SOBI2_CONFIG_DEBUG_TMPL') or define('_SOBI2_CONFIG_DEBUG_TMPL', 'Parse Templates');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND', 'Show Fields Category Dependant');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND_EXPL', 'Show the fields data in the search list boxes dependant on the previous selected catgory.');

/*
 * added (RC 2.8.3)
 */
defined('_SOBI2_MENU_PLUGINS_DATATABLES') or define('_SOBI2_MENU_PLUGINS_DATATABLES', 'Database Tables of Plugins');
defined('_SOBI2_PLUGINS_DATATABLES_NAME') or define('_SOBI2_PLUGINS_DATATABLES_NAME', 'Table Name');
defined('_SOBI2_PLUGINS_DATATABLES_PNAME') or define('_SOBI2_PLUGINS_DATATABLES_PNAME', 'Plugin Name');
defined('_SOBI2_PLUGINS_DATATABLES_INFO') or define('_SOBI2_PLUGINS_DATATABLES_INFO', 'Info');
defined('_SOBI2_PLUGINS_DATATABLES_ROWS') or define('_SOBI2_PLUGINS_DATATABLES_ROWS', 'Rows');
defined('_SOBI2_PLUGINS_DATATABLES_CREATED') or define('_SOBI2_PLUGINS_DATATABLES_CREATED', 'Created');
defined('_SOBI2_PLUGINS_DATATABLES_UPD') or define('_SOBI2_PLUGINS_DATATABLES_UPD', 'Updated');
defined('_JS_SOBI2_PLUGINS_DATATABLE_DELETE') or define('_JS_SOBI2_PLUGINS_DATATABLE_DELETE', 'Do you really want to delete this table? \nPlease notice that all data will be deleted irrevocably! ');
defined('_SOBI2_PLUGINS_DATATABLE_DELETED') or define('_SOBI2_PLUGINS_DATATABLE_DELETED', 'Table has been removed');

defined('_SOBI2_MENU_TEMPLATES_AND_CSS') or define('_SOBI2_MENU_TEMPLATES_AND_CSS', 'Templates &amp; CSS');
defined('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT') or define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT', 'Show Subcategory List');
defined('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT_EXPL') or define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT_EXPL', 'Show the list of subcategories below a category in Yahoo style.');
defined('_SOBI2_CONFIG_GENERAL_SHOW_NUMBER_SUBCATS') or define('_SOBI2_CONFIG_GENERAL_SHOW_NUMBER_SUBCATS', 'Number of Subcategories');
defined('_SOBI2_CONFIG_GENERAL_SORT_SUBCATS_BY') or define('_SOBI2_CONFIG_GENERAL_SORT_SUBCATS_BY', 'Sort Subcategories by');

/* !!!!! changed - please remove old one */
defined('_SOBI2_FIELD_USE_WYSIWYG_EXPL') or define('_SOBI2_FIELD_USE_WYSIWYG_EXPL', 'Select if TinyMCE editor should be used in the New/Edit Entry form. Will work only if textarea is the selected type. <strong>A WYSIWYG FIELD MUST NOT BE SET TO REQUIRED!!</strong>');


/*
 * added (RC 2.8.2)
 */
defined('_SOBI2_ABOUT_ADDONS') or define('_SOBI2_ABOUT_ADDONS', 'Add-Ons for SOBI2');
defined('_SOBI2_ABOUT_PBY') or define('_SOBI2_ABOUT_PBY', '"Powered by" Link');
defined('_SOBI2_ABOUT_NEWS') or define('_SOBI2_ABOUT_NEWS', 'Sigsiu.NET News');
defined('_SOBI2_ABOUT_PBY_SHOW') or define('_SOBI2_ABOUT_PBY_SHOW', 'Display "Powered by" Link');
defined('_SOBI2_ABOUT_PBY_SUPPORT') or define('_SOBI2_ABOUT_PBY_SUPPORT', '<br /><strong>If you remove the "powered by" Link from our component, it is fair to donate for the component.</strong><br /><br />Developing and maintaining SOBI2 is a lot of work which should be recompensed adequately.<br />Click on the donate button below to donate via Paypal.<br /><br /><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sigsiu%2enet%40sigsiu%2enet&item_name=SOBI%202&item_number=SOBI2-CAB&no_shipping=2&lc=US&no_note=1&tax=0&currency_code=EUR&bn=PP%2dDonationsBF&charset=UTF%2d8" title="Donate for SOBI2" target="_blank"><img src="components/com_sobi2/images/donate_button.png" alt="Donate for SOBI2 via Paypal" title="Donate for SOBI2 via Paypal" border="0"/></a><br /><br />Thank you.<br /><br />');
defined('_SOBI2_ABOUT_PBY_JS_SUPPORT') or define('_SOBI2_ABOUT_PBY_JS_SUPPORT', "Don\'t forget to donate!");
defined('_SOBI2_CODEPRESS_TOGGLE') or define('_SOBI2_CODEPRESS_TOGGLE', 'Toggle Editor');

/*
 * added (RC 2.8.1)
 */
defined('_SOBI2_FPERMS_HEADER') or define('_SOBI2_FPERMS_HEADER', 'File System');
defined('_SOBI2_FPERMS_ON') or define('_SOBI2_FPERMS_ON', 'Change file/directory permissions if neccessary<br/>If you experience problems with the permissions set by SOBI2, set this to \'No\' and change the permissions manually!');
defined('_SOBI2_FPERMS_FMOD') or define('_SOBI2_FPERMS_FMOD', 'File permissions');
defined('_SOBI2_FPERMS_DMOD') or define('_SOBI2_FPERMS_DMOD', 'Directory permissions');
defined('_SOBI2_FPERMS_WRITABLE') or define('_SOBI2_FPERMS_WRITABLE', 'writeable');
defined('_SOBI2_FPERMS_NWRITABLE') or define('_SOBI2_FPERMS_NWRITABLE', 'not writeable');
defined('_SOBI2_CURRENT_FPERMS_HEADER') or define('_SOBI2_CURRENT_FPERMS_HEADER', 'Current Directory Permissions');
defined('_SOBI2_FIELDLIST_CSV_LIST') or define('_SOBI2_FIELDLIST_CSV_LIST', 'Add CSV value list');
defined('_SOBI2_FIELDLIST_CSV_LIST_EXPL') or define('_SOBI2_FIELDLIST_CSV_LIST_EXPL', 'You can add CSV (comma separated values) list of options and values in this form: <ul><li>Only field options: <b>option 1; option 2; option 3;</b></li><li>Field options with values: <b>option_1:Option 1; option_2:Option 2; option_3:Option 3;</b></li></ul>');
defined('_SOBI2_FIELDLIST_CSV_SAVE') or define('_SOBI2_FIELDLIST_CSV_SAVE', 'Save CSV List');
defined('_SOBI2_FIELDLIST_CSV_SAVE_EXPL') or define('_SOBI2_FIELDLIST_CSV_SAVE_EXPL', 'Save the CSV list instead of the options list below.');

/*
 * added (RC 2.8.0)
 */

//to get it working in this language you need the language files of the calender too
defined("_SOBI2_CALENDAR_LANG") || define("_SOBI2_CALENDAR_LANG", "en");
defined("_SOBI2_CALENDAR_FORMAT") || define("_SOBI2_CALENDAR_FORMAT", "y-mm-dd");

/* !!!!! changed - please remove old one */
defined('_SOBI2_FIELD_COLS_EXPL') or define('_SOBI2_FIELD_COLS_EXPL', 'Number of columns of input field. Valid only if textarea is the selected type OR pixel width for player if linked media OR number of columns for the checkbox group.');
/* !!!!! changed - please remove old one */
defined('_SOBI2_FIELD_PREFERRED_SIZE_EXPL') or define('_SOBI2_FIELD_PREFERRED_SIZE_EXPL', 'Size of inputbox or select list. Valid only if inputbox or select list is the selected type.');
/* !!!!! changed - please remove old one */
defined('_SOBI2_TOOLBAR_ADD_NEW_CAT') or define('_SOBI2_TOOLBAR_ADD_NEW_CAT', 'Add Category');
/* !!!!! changed - please remove old one */
defined('_SOBI2_TOOLBAR_ADD_NEW_ITEM') or define('_SOBI2_TOOLBAR_ADD_NEW_ITEM', 'Add Entry');

defined('_SOBI2_CHECKBOX_YES') or define('_SOBI2_CHECKBOX_YES', 'Yes');
defined('_SOBI2_CHECKBOX_NO') or define('_SOBI2_CHECKBOX_NO', 'No');

defined('_SOBI2_CONFIG_GENERAL_FORCE_MENUID') or define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID', 'Force Unique Menu-Id');
defined('_SOBI2_CONFIG_GENERAL_FORCE_MENUID_EXPL') or define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID_EXPL', 'If yes, for every SOBI2 URL a unique menu id will be used. Otherwise the current menu id will be used.');

defined('_SOBI2_FIELD_ADM_ONLY') or define('_SOBI2_FIELD_ADM_ONLY', 'Administrative Field');
defined('_SOBI2_FIELD_ADM_ONLY_EXPL') or define('_SOBI2_FIELD_ADM_ONLY_EXPL', 'Only the administrator will be able to enter data in this field via the back-end.');

defined('_SOBI2_ALLOW_FE_ENTRIES') or define('_SOBI2_ALLOW_FE_ENTRIES', 'Allow Adding Entries');
defined('_SOBI2_TOOLBAR_ADD_CATS_SERIE') or define('_SOBI2_TOOLBAR_ADD_CATS_SERIE', 'Add Multiple Categories');
defined('_SOBI2_ADD_CATS_SERIE_NAMES') or define('_SOBI2_ADD_CATS_SERIE_NAMES', 'Insert a semicolon separated list of categories');
defined('_SOBI2_ADD_CATS_SERIE_NAMES_EXPL') or define('_SOBI2_ADD_CATS_SERIE_NAMES_EXPL', 'Insert a semicolon separated list of category names, introtexts and category icons to add multiple categories at once. The category name, the introtext and the icon has to be separated by a colon.<br/><strong>The categories will be added in the previous selected category.</strong><br/><br/>Examples:<br />Only category names: category name 1; category name 2; category name 3;<br />Category names and introtexts and/or category icons: category name 1 : introtext 1; category name 2 : introtext 2; category name 3 : introtext 3 : icon.png;<br />Only category name and icon: category name :: icon.png; ');

defined('_SOBI2_LANG_REMOVED') or define('_SOBI2_LANG_REMOVED', 'Language removed');
defined('_SOBI2_LANG_REM_ERROR') or define('_SOBI2_LANG_REM_ERROR', 'Language removed but an error occurred');
defined('_SOBI2_LANG_NOT_REM_ERROR') or define('_SOBI2_LANG_NOT_REM_ERROR', 'Language cannot be removed');
defined('_SOBI2_LANG_FOR_VER') or define('_SOBI2_LANG_FOR_VER', 'For Version');
defined('_SOBI2_CONFIG_LANGMAN_LIST_CREATED') or define('_SOBI2_CONFIG_LANGMAN_LIST_CREATED', 'Creation Date');
defined('_SOBI2_CONFIG_LANGMAN_INSTALLED_LANGS') or define('_SOBI2_CONFIG_LANGMAN_INSTALLED_LANGS', 'Installed Languages');
defined('_SOBI2_CONFIG_LANG_PACK_UPLOAD') or define('_SOBI2_CONFIG_LANG_PACK_UPLOAD', 'Upload New Language Package');
defined('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE') or define('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE', 'XML-Setup file does not exist in the package');

defined('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_ON_SEARCHPAGE') or define('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_ON_SEARCHPAGE', 'Show Component Description on Search Page');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL', 'Return URL');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL_EXPL', 'The URL to which the user will be redirected after payment was made.');
defined('_SOBI2_CONFIG_PAYMENTS_CURRENCY_TEXT') or define('_SOBI2_CONFIG_PAYMENTS_CURRENCY_TEXT', 'Currency Code');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT', 'Categories Container Height');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT_EXPL', 'If you use show/hide extended search options button, you need to define the categories container height. Please notice that the height has to be big enough to contain as many combo boxes as the highest depth of your subcategory structure. One combo box has about 25 px (depends on your CMS template).');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE', 'Ordering');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_FIELD_FIRST') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_FIELD_FIRST', 'Custom Fields First');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_CAT_FIRST') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_CAT_FIRST', 'Categories First');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_EXPL', 'Select the ordering of categories and custom fields combo boxes in the extended search options container.');

defined('_SOBI2_CONFIG_ENTRY_WS_HEADER') or define('_SOBI2_CONFIG_ENTRY_WS_HEADER', 'Way Search Options');
defined('_SOBI2_CONFIG_ENTRY_WS_FIELDS_ASSIGMENT') or define('_SOBI2_CONFIG_ENTRY_WS_FIELDS_ASSIGMENT', 'Field Assignments');

defined('_SOBI2_CONFIG_SYSTEM_MAILS') or define('_SOBI2_CONFIG_SYSTEM_MAILS', 'System Emails');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS') or define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS', 'Send system emails to');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS_EXPL') or define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS_EXPL', 'Select which user group should get the notification emails.');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL', 'Use as client email address');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_EXPL') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_EXPL', 'From where the client email address has to be taken? Choose between SOBI2 entry or CMS user managment. Notice, that if the address is taken from the CMS user management, adding entries has to be allowed only for registered users.');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_SOBI') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_SOBI', 'Address entered in SOBI2 entry');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_CMS') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_CMS', 'Address as stated during user registration');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID', 'Field where the email address is stored');
defined('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID_EXPL') or define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID_EXPL', 'Select the field in which the email address is stored. Only valid if email addresses from SOBI2 entry are used.');

defined('_SOBI2_ALL_LISTING_NON_FREE_OPT') or define('_SOBI2_ALL_LISTING_NON_FREE_OPT', 'Total Amount');
defined('_SOBI2_CONFIG_SEARCH_OPT') or define('_SOBI2_CONFIG_SEARCH_OPT', 'Search Options');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER', 'Use Extended Search Options Button');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER_EXPL', 'If Yes, a button will be shown to hide/show the extended search options container.');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START', 'Fade out on Start');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START_EXPL', 'If Yes, the extended search options container is hidden at the beginning (only if extended search options button is used).');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH', 'Fade out after Search');
defined('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH_EXPL') or define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH_EXPL', 'If Yes, the extended search options container will be hidden after searching (only if extended search options button is used).');

defined('_SOBI2_LISTING_MANAGER_SEARCH_ONLY_START') or define('_SOBI2_LISTING_MANAGER_SEARCH_ONLY_START', 'Only items which start with');
defined('_SOBI2_CONFIG_GENERAL_SHOW_ALPHA') or define('_SOBI2_CONFIG_GENERAL_SHOW_ALPHA', 'Show Alpha-Index');

defined('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT') or define('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'You cannot add an entry to a category having subcategories. Please select one of the subcategories.');
defined('_SOBI2_FIELDLIST_SELECT') or define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- select ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
defined('_SOBI2_FIELDLIST_LIST_OF_VALUES') or define('_SOBI2_FIELDLIST_LIST_OF_VALUES', 'List of predefined option values for select list/checkbox group');
defined('_SOBI2_FIELDLIST_NEW_VALUE_PAIR') or define('_SOBI2_FIELDLIST_NEW_VALUE_PAIR', 'Add new pair of variates');
defined('_SOBI2_FIELDLIST_OPT_NAME') or define('_SOBI2_FIELDLIST_OPT_NAME', 'Option Name');
defined('_SOBI2_FIELDLIST_OPT_VALUE') or define('_SOBI2_FIELDLIST_OPT_VALUE', 'Option Value');
defined('_SOBI2_FIELDLIST_DELETE_VALUE_PAIR') or define('_SOBI2_FIELDLIST_DELETE_VALUE_PAIR', 'Remove pair of variates');
defined('_SOBI2_FIELDLIST_SORT_VALUES') or define('_SOBI2_FIELDLIST_SORT_VALUES', 'Sort Options');
defined('_SOBI2_FIELDLIST_SORT_VALUES_EXPL') or define('_SOBI2_FIELDLIST_SORT_VALUES_EXPL', 'Sort options in add entry form alphabetically or not.');
defined('_SOBI2_FIELDLIST_ADD_SELECT_LABEL') or define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL', 'Add Select');
defined('_SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL') or define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL', 'Select if an additionally option with the text "Select" should be shown.');

defined('_SOBI2_SAVE_IMG_TO_BIG') or define('_SOBI2_SAVE_IMG_TO_BIG', 'Image file upload failed! Uploaded file was too big. File size is: ');
defined('_SOBI2_EF_MAX_FILE_SIZE') or define('_SOBI2_EF_MAX_FILE_SIZE', ' The file size should not be bigger than ');
defined('_SOBI2_EF_KB_FILE_SIZE') or define('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * added 24.07.2007 (RC 2.7.4)
 */
defined('_SOBI2_MENU_EULA') or define('_SOBI2_MENU_EULA', 'End-User License');
defined('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH') or define('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH', 'Use Extended Search Function');
defined('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH_EXPL') or define('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH_EXPL', 'Use extended search function instead of the normal search function. This function allows the visitors to search also in a specific category.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_NOTICE') or define('_SOBI2_CONFIG_ENTRY_GMAPS_NOTICE', 'Google Maps (geographical coordinates for each entry are needed)');

/*
 * added 8.06.2007 (RC 2.7.2)
 */
defined('_SOBI2_CONFIG_GENERAL_USE_ATREE') or define('_SOBI2_CONFIG_GENERAL_USE_ATREE', 'Use SigsiuTree');
defined('_SOBI2_CONFIG_GENERAL_USE_ATREE_EXPL') or define('_SOBI2_CONFIG_GENERAL_USE_ATREE_EXPL', 'Use SigsiuTree instead of the normal dTree. This is useful if you have a lot of categories and the browser is giving up on parsing the javascript code.');
defined('_SOBI2_CONFIG_GENERAL_ATREE_IMAGES') or define('_SOBI2_CONFIG_GENERAL_ATREE_IMAGES', 'SigsiuTree Images');

/*
 * added 18.05.2007 (RC 2.7.1)
 */
defined('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE') or define('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE', 'Text Code');
defined('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE_EXPL') or define('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE_EXPL', '
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
defined('_SOBI2_CONFIG_CACHE_DESCRIPTION_TEXT') or define('_SOBI2_CONFIG_CACHE_DESCRIPTION_TEXT', 'Cache Acceleration Options');
defined('_SOBI2_CONFIG_CACHE_ON') or define('_SOBI2_CONFIG_CACHE_ON', 'Cache Enabled');
defined('_SOBI2_CONFIG_CACHE_LIFETIME') or define('_SOBI2_CONFIG_CACHE_LIFETIME', 'Cache Lifetime');
defined('_SOBI2_CONFIG_CACHE_LIFETIME_EXPL') or define('_SOBI2_CONFIG_CACHE_LIFETIME_EXPL', 'The cache life time can be set to a very high value because the cache will be refreshed every time something in SOBI2 was changed. For example, if user has edited his entry or admin has changed the configuration.');
defined('_SOBI2_CONFIG_CACHE_LIFETIME_SEC') or define('_SOBI2_CONFIG_CACHE_LIFETIME_SEC', 'Seconds');
defined('_SOBI2_CONFIG_CACHE_LIFETIME_MIN') or define('_SOBI2_CONFIG_CACHE_LIFETIME_MIN', 'Minutes');
defined('_SOBI2_CONFIG_CACHE_LIFETIME_HOURS') or define('_SOBI2_CONFIG_CACHE_LIFETIME_HOURS', 'Hours');
defined('_SOBI2_CONFIG_CACHE_LIFETIME_DAYS') or define('_SOBI2_CONFIG_CACHE_LIFETIME_DAYS', 'Days');
defined('_SOBI2_CONFIG_CACHE_EMPTY') or define('_SOBI2_CONFIG_CACHE_EMPTY', 'Empty&nbsp;Cache');
defined('_SOBI2_CONFIG_CACHE_REMOVED') or define('_SOBI2_CONFIG_CACHE_REMOVED', 'Cache Cleared');
defined('_SOBI2_CONFIG_CACHE_DIR') or define('_SOBI2_CONFIG_CACHE_DIR', 'Cache Directory');
defined('_SOBI2_CONFIG_CACHE_DIR_EXPL') or define('_SOBI2_CONFIG_CACHE_DIR_EXPL', 'Where the cache should be stored. For an absolute path, the location address has to start with /. Otherweise the address is relative to CMS root.');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL', 'Paypal URL');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL_EXPL', 'You can change the target PayPal URL here. For example if you want to use the Paypal sandbox mode. Default should be https://www.paypal.com/cgi-bin/webscr');

defined('_SOBI2_MENU_EDIT_VC_TEMPLATE') or define('_SOBI2_MENU_EDIT_VC_TEMPLATE', 'V-Card Template');
defined('_SOBI2_VC_TEMPLATE_ENABLE') or define('_SOBI2_VC_TEMPLATE_ENABLE', 'Use the Template instead of the Standard Function');
defined('_SOBI2_VC_TEMPLATE_ENABLE_EXPL') or define('_SOBI2_VC_TEMPLATE_ENABLE_EXPL', 'If you want to use the template, you have to add any new custom field to the template manually. The New-Line setting from Fields Manager is without effect if the V-Card template is used.');
defined('_SOBI2_CONFIG_GENERAL_USE_RSS') or define('_SOBI2_CONFIG_GENERAL_USE_RSS', 'Use RSS Feeds');


/*
 * added 16.02.2007 (RC 2.6.1)
 */

defined('_SOBI2_MENU_ERRLOG') or define('_SOBI2_MENU_ERRLOG', 'Error Logfile');
defined('_SOBI2_ERRLOG_FILE_SIZE') or define('_SOBI2_ERRLOG_FILE_SIZE', 'Error Logfile Size: ');
defined('_SOBI2_ERRLOG_FILE_TOO_BIG') or define('_SOBI2_ERRLOG_FILE_TOO_BIG', '<big>The error logfile is very large (over 500 kB). It could hang up your browser or server.</big>');
defined('_SOBI2_ERRLOG_FILE_SHOW') or define('_SOBI2_ERRLOG_FILE_SHOW', 'Show the File anyway');
defined('_SOBI2_ERRLOG_FILE_DOWNLOAD_FULL') or define('_SOBI2_ERRLOG_FILE_DOWNLOAD_FULL', 'Download Logfile');
defined('_SOBI2_ERRLOG_FILE_DELETE') or define('_SOBI2_ERRLOG_FILE_DELETE', 'Delete');
defined('_SOBI2_ERRLOG_FILE_DOWNLOAD') or define('_SOBI2_ERRLOG_FILE_DOWNLOAD', 'Download');
defined('_SOBI2_ERRLOG_NO_FILE') or define('_SOBI2_ERRLOG_NO_FILE', '<big>Could ont open error logfile. Either there is no error or SOBI2 cannot create the logfile</big>');
defined('_SOBI2_ERRLOG_FILE_DELETED') or define('_SOBI2_ERRLOG_FILE_DELETED', 'Error Logfile deleted');
defined('_SOBI2_ERRLOG_FILE_NOT_DELETED') or define('_SOBI2_ERRLOG_FILE_NOT_DELETED', 'Could not delete Error Logfile ');

defined('_SOBI2_ERR_NOTICE') or define('_SOBI2_ERR_NOTICE', 'PHP Notice - Don\'t panic. It could help you/us to find the solution if something goes wrong');
defined('_SOBI2_ERR_WARNING') or define('_SOBI2_ERR_WARNING', 'PHP Warning - You should notify us about the warning in the SOBI2 forum');
defined('_SOBI2_ERR_ERROR') or define('_SOBI2_ERR_ERROR', 'PHP Error - Critical error. Please inform us about this in the SOBI2 forum');
defined('_SOBI2_ERR_INTERN') or define('_SOBI2_ERR_INTERN', 'Internal SOBI2 Error -  this information is helpful in finding the solution if something goes wrong');
defined('_SOBI2_CONFIG_DEBUG_DESCRIPTION_TEXT') or define('_SOBI2_CONFIG_DEBUG_DESCRIPTION_TEXT', 'Debug and Error Logging Options');
defined('_SOBI2_CONFIG_DEBUG_LEVEL') or define('_SOBI2_CONFIG_DEBUG_LEVEL', 'Debug Level');
defined('_SOBI2_CONFIG_DEBUG_SHOW_ERR') or define('_SOBI2_CONFIG_DEBUG_SHOW_ERR', 'Display Errors');
defined('_SOBI2_CONFIG_DEBUG_LEVEL_0') or define('_SOBI2_CONFIG_DEBUG_LEVEL_0', 'None');
defined('_SOBI2_CONFIG_DEBUG_LEVEL_7') or define('_SOBI2_CONFIG_DEBUG_LEVEL_7', 'Only Critical Errors');
defined('_SOBI2_CONFIG_DEBUG_LEVEL_8') or define('_SOBI2_CONFIG_DEBUG_LEVEL_8', 'Errors & Warnings (recommended)');
defined('_SOBI2_CONFIG_DEBUG_LEVEL_9') or define('_SOBI2_CONFIG_DEBUG_LEVEL_9', 'All Errors, Warnings and Notices');

/*
 * added 19.11.06 (RC 2.5.7)
 */
defined('_SOBI2_FIELD_VIDEO') or define('_SOBI2_FIELD_VIDEO', 'linked media file');
defined('_SOBI2_BASE_ENTRY_FEES') or define('_SOBI2_BASE_ENTRY_FEES', 'Fee for Basic Entry');
defined('_SOBI2_BASE_ENTRY_FEES_EXPL') or define('_SOBI2_BASE_ENTRY_FEES_EXPL', 'Leave empty or put in 0 if the basic entry is for free.');
defined('_SOBI2_BASE_ENTRY_FEES_LABEL') or define('_SOBI2_BASE_ENTRY_FEES_LABEL', 'Title for Basic Entry');
defined('_SOBI2_BASE_ENTRY_FEES_LABEL_EXPL') or define('_SOBI2_BASE_ENTRY_FEES_LABEL_EXPL', 'This title will be shown in the payment summary screen.');
defined('_SOBI2_FIELD_IS_URL_EXPL') or define('_SOBI2_FIELD_IS_URL_EXPL', 'Select if the field is for an URL, an email address, a linked image or a linked video/audio file.');
defined('_SOBI2_FIELD_ROWS_EXPL') or define('_SOBI2_FIELD_ROWS_EXPL', 'Number of rows of input field. Valid only if textarea is the selected type OR pixel height for player if linked media.');

/*
 * added 28.10.06 (RC 2.5)
 */
defined('_SOBI2_FIELD_IMG') or define('_SOBI2_FIELD_IMG', 'image');
defined('_SOBI2_LISTING_FILTER') or define('_SOBI2_LISTING_FILTER', 'Filter: ');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND') or define('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND', 'Allow Choosing Background');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND_EXPL', 'Permit the user to choose its background for details and cards view.');
defined('_SOBI2_CONFIG_VIEW_ALLOW_ANO') or define('_SOBI2_CONFIG_VIEW_ALLOW_ANO', 'Unregistered Users may view Details View');
defined('_SOBI2_CONFIG_VIEW_ALLOW_ANO_EXPL') or define('_SOBI2_CONFIG_VIEW_ALLOW_ANO_EXPL', 'Allow unregistered users to view the entry details page.');
defined('_SOBI2_PLUGIN_ENABLED') or define('_SOBI2_PLUGIN_ENABLED', 'Plugin enabled');
defined('_SOBI2_PLUGIN_DISABLED') or define('_SOBI2_PLUGIN_DISABLED', 'Plugin disabled');
defined('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_FILES_ERROR') or define('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_FILES_ERROR', 'Cannot remove some files or directories');
defined('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_ERROR') or define('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_ERROR', 'Cannot remove plugin data from database');
defined('_SOBI2_PLUGINS_INSTALLER_PI_DROP_ERROR') or define('_SOBI2_PLUGINS_INSTALLER_PI_DROP_ERROR', 'Cannot drop plugin tables');
defined('_SOBI2_PLUGINS_INSTALLER_PI_NOT_FOUND') or define('_SOBI2_PLUGINS_INSTALLER_PI_NOT_FOUND', 'Cannot find plugin data in database');
defined('_SOBI2_PLUGINS_INSTALLER_REMOVED') or define('_SOBI2_PLUGINS_INSTALLER_REMOVED', ' Plugin succsessfully removed');
defined('_SOBI2_PLUGINS_INSTALLER_PID_MISSING') or define('_SOBI2_PLUGINS_INSTALLER_PID_MISSING', 'Please make a selection from the list');
defined('_SOBI2_PLUGINS_INSTALLER_COPY_ERROR') or define('_SOBI2_PLUGINS_INSTALLER_COPY_ERROR', 'Error while copying  files');
defined('_SOBI2_PLUGINS_INSTALLER_INSTALLED') or define('_SOBI2_PLUGINS_INSTALLER_INSTALLED', ' Plugin succsessfully installed');
defined('_SOBI2_PLUGINS_INSTALLER_ERROR') or define('_SOBI2_PLUGINS_INSTALLER_ERROR', 'Error while installing new plugin');
defined('_SOBI2_PLUGINS_INSTALLER_ALLREADY_EXISTST') or define('_SOBI2_PLUGINS_INSTALLER_ALLREADY_EXISTST', 'A plugin with this name is already installed');
defined('_SOBI2_PLUGINS_ENABLED') or define('_SOBI2_PLUGINS_ENABLED', 'Enabled');
defined('_SOBI2_PLUGINS_POSITION') or define('_SOBI2_PLUGINS_POSITION', 'Position');
defined('_SOBI2_PLUGINS_INIT_FILE') or define('_SOBI2_PLUGINS_INIT_FILE', 'Init File');
defined('_SOBI2_PLUGINS_AUTHOR') or define('_SOBI2_PLUGINS_AUTHOR', 'Author');
defined('_SOBI2_PLUGINS_AUTHOR_URL') or define('_SOBI2_PLUGINS_AUTHOR_URL', 'Author URL');
defined('_SOBI2_PLUGINS_VER') or define('_SOBI2_PLUGINS_VER', 'Version');
defined('_SOBI2_CONFIG_PLUGINS_INSTALLED_PLUGINS') or define('_SOBI2_CONFIG_PLUGINS_INSTALLED_PLUGINS', 'Currently Installed Plugins');
defined('_SOBI2_CONFIG_PLUGINS_INSTALL_NEW') or define('_SOBI2_CONFIG_PLUGINS_INSTALL_NEW', 'Install New Plugin');
defined('_SOBI2_CONFIG_PLUGINS_UPLOAD') or define('_SOBI2_CONFIG_PLUGINS_UPLOAD', 'Upload Plugin Package File');
defined('_SOBI2_MENU_PLUGINS_HEADER') or define('_SOBI2_MENU_PLUGINS_HEADER', 'Plugins');
defined('_SOBI2_MENU_PLUGINS_MANAGER') or define('_SOBI2_MENU_PLUGINS_MANAGER', 'Plugin Manager');
defined('_SOBI2_PLUGIN_HEADER') or define('_SOBI2_PLUGIN_HEADER', 'Plugin');

/*
* added 10.10.2006 (RC 2)
*/
defined('_SOBI2_MENU_EDIT_TEMPLATE') or define('_SOBI2_MENU_EDIT_TEMPLATE', 'Details View Template');
defined('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER') or define('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER', 'Count Entries and Subcategories');
defined('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER_EXPL') or define('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER_EXPL', 'Show the number of entries and subcategories behind the category name in category list.');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT') or define('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT', 'Allow Adding Entries to Parent Categories');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT_EXPL', 'Allow adding entries to categories having subcategories');
defined('_SOBI2_MENU_VER_CHECKER') or define('_SOBI2_MENU_VER_CHECKER', 'Version Checker');
defined('_SOBI2_CONFIG_CHECK_VER') or define('_SOBI2_CONFIG_CHECK_VER', 'Check Your Version Of SOBI2');
defined('_SOBI2_CONFIG_ACT_VER') or define('_SOBI2_CONFIG_ACT_VER', 'Your version is: ');
defined('_SOBI2_CONFIG_VER_CHECK') or define('_SOBI2_CONFIG_VER_CHECK', 'Check for newer version');
defined('_SOBI2_CONFIG_VER_CHECK_ERROR') or define('_SOBI2_CONFIG_VER_CHECK_ERROR', 'Could not connect remote server. Please try again later!');
defined('_SOBI2_MENU_EMAILS') or define('_SOBI2_MENU_EMAILS', 'Email Templates');
defined('_SOBI2_CONFIG_MAIL_LINK_MARKERS') or define('_SOBI2_CONFIG_MAIL_LINK_MARKERS', 'Placeholder description');
defined('_SOBI2_CONFIG_MAIL_ABOUT_MARKERS') or define('_SOBI2_CONFIG_MAIL_ABOUT_MARKERS', 'The following placeholders can be used in the emails: ' .
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

defined('_SOBI2_CONFIG_EMAILS') or define('_SOBI2_CONFIG_EMAILS', 'Email Texts');
defined('_SOBI2_CONFIG_FOOTER') or define('_SOBI2_CONFIG_FOOTER', 'Email Signature');
defined('_SOBI2_CONFIG_FOOTER_EXPL') or define('_SOBI2_CONFIG_FOOTER_EXPL', 'This text will be added to every email.');
defined('_SOBI2_PLEASE_WAIT') or define('_SOBI2_PLEASE_WAIT', 'Please wait ... ');
defined('_SOBI2_READY') or define('_SOBI2_READY', 'Ready: ');
defined('_SOBI2_SELECT_OPTION_TO_EDIT') or define('_SOBI2_SELECT_OPTION_TO_EDIT', 'Select Email Template to Edit: ');
defined('_SOBI2_EMAIL_ON_SUBMIT') or define('_SOBI2_EMAIL_ON_SUBMIT', 'On Add Entry (user)');
defined('_SOBI2_EMAIL_ON_UPDATE') or define('_SOBI2_EMAIL_ON_UPDATE', 'On Edit Entry (user)');
defined('_SOBI2_EMAIL_ON_APPROVE') or define('_SOBI2_EMAIL_ON_APPROVE', 'On Approve Entry (user)');
defined('_SOBI2_EMAIL_ON_PAYMENT') or define('_SOBI2_EMAIL_ON_PAYMENT', 'Payment Email (user)');
defined('_SOBI2_EMAIL_ON_SUBMIT_ADMIN') or define('_SOBI2_EMAIL_ON_SUBMIT_ADMIN', 'On Add Entry (admin)');
defined('_SOBI2_EMAIL_ON_UPDATE_ADMIN') or define('_SOBI2_EMAIL_ON_UPDATE_ADMIN', 'On Edit Entry (admin)');
defined('_SOBI2_EMAIL_ON_PAYMENT_ADMIN') or define('_SOBI2_EMAIL_ON_PAYMENT_ADMIN', 'Payment Email (admin)');
defined('_SOBI2_EMAIL_TEXT') or define('_SOBI2_EMAIL_TEXT', 'Email Text: ');
defined('_SOBI2_EMAIL_TITLE') or define('_SOBI2_EMAIL_TITLE', 'Email Subject: ');
defined('_SOBI2_CONFIG_MAIL_LANG_EXPL') or define('_SOBI2_CONFIG_MAIL_LANG_EXPL', 'Select language to edit the fields in.');
defined('_SOBI2_CONFIG_MAIL_LANG') or define('_SOBI2_CONFIG_MAIL_LANG', 'Select Language ');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT_EXPL', 'Send email to admins if a new entry with not free options was added.');


/*
* added 02.10.2006 (RC 1)
*/
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT', 'Send Payment Email to Admins');
defined('_SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE') or define('_SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE', 'You have to edit the field to change this option');
defined('_SOBI2_CONFIG_FIELDS_CANNOT_BE_CHANGE') or define('_SOBI2_CONFIG_FIELDS_CANNOT_BE_CHANGE', 'This option cannot be changed');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_ON') or define('_SOBI2_CONFIG_ENTRY_GMAPS_ON', 'Show Google Maps');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_ON_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_ON_EXPL', 'Show/Hide the map (requires Google Api Key)');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_API') or define('_SOBI2_CONFIG_ENTRY_GMAPS_API', 'API Key');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_API_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_API_EXPL', 'Google Maps Api Key for the site');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_W') or define('_SOBI2_CONFIG_ENTRY_GMAPS_W', 'Map Width');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_W_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_W_EXPL', 'The map\'s width in pixel.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_H') or define('_SOBI2_CONFIG_ENTRY_GMAPS_H', 'Map Height');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_H_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_H_EXPL', 'The map\'s height in pixel.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_LAT') or define('_SOBI2_CONFIG_ENTRY_GMAPS_LAT', 'Map Latitude Field');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_LAT_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_LAT_EXPL', 'Select the field where the latitude for the map is saved.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_LON') or define('_SOBI2_CONFIG_ENTRY_GMAPS_LON', 'Map Longitude Field');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_LON_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_LON_EXPL', 'Select the field where the longitude for the map is saved.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE') or define('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE', 'Info Bubble');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EXPL', 'Opens the Information bubble with the \'Get Directions\' Form.');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_DISABLE') or define('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_DISABLE', 'Disable Directions Info Bubble');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_WAIT') or define('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_WAIT', 'Enable but open Bubble only if Marker is clicked');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_OPEN') or define('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_OPEN', 'Enable and open Bubble when Map is loaded');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM') or define('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM', 'Zoom Level');
defined('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM_EXPL') or define('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM_EXPL', 'Initial Zoom level for the map.');


/*
* added 26.09.2006 (Beta 2.2)
*/
defined('_SOBI2_CONFIG_SECIMG_USING_FAILED') or define('_SOBI2_CONFIG_SECIMG_USING_FAILED', 'Your server does not support any function needed to create a security image and therefore this function is disabled.');

/*
* added 23.09.2006 (Beta 2.1)
*/
defined('_SOBI2_CONFIG_ENTRY_MAX_FILE_SIZE') or define('_SOBI2_CONFIG_ENTRY_MAX_FILE_SIZE', 'Max. Size of Uploaded Files');
defined('_SOBI2_CONFIG_ENTRY_FILE_SIZE_BYTES') or define('_SOBI2_CONFIG_ENTRY_FILE_SIZE_BYTES', 'kB');

/*
* added 18.09.2006
*/
defined('_SOBI2_MENU_LANG_MANAGER') or define('_SOBI2_MENU_LANG_MANAGER', 'Language Manager');
defined('_SOBI2_CONFIG_LANGMAN_INSTALL_NEW') or define('_SOBI2_CONFIG_LANGMAN_INSTALL_NEW', 'Install New Language Package');
defined('_SOBI2_CONFIG_LANGMAN_INSTALL_BT') or define('_SOBI2_CONFIG_LANGMAN_INSTALL_BT', 'Install');
defined('_SOBI2_CONFIG_LANGMAN_NO_FILE') or define('_SOBI2_CONFIG_LANGMAN_NO_FILE', 'Error: missing uploaded language package');
defined('_SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR') or define('_SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR', 'Error: Not an allowed file extension. Installation aborted.');
defined('_SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR') or define('_SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR', 'Error: Could not copy package to installation folder. Installation aborted.');
defined('_SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR') or define('_SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR', 'Error: Could not extract package. Installation aborted.');
defined('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR') or define('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR', 'Error: Could not parse XML file. Installation aborted.');
defined('_SOBI2_CONFIG_LANGMAN_FP_FILE_COPY_ERROR') or define('_SOBI2_CONFIG_LANGMAN_FP_FILE_COPY_ERROR', 'Error: Could not copy frontend file. Installation aborted.');
defined('_SOBI2_CONFIG_LANGMAN_BE_FILE_COPY_ERROR') or define('_SOBI2_CONFIG_LANGMAN_BE_FILE_COPY_ERROR', 'No backend language file. ');
defined('_SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR') or define('_SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR', 'Warning: Missing custom field labels. ');
defined('_SOBI2_CONFIG_LANGMAN_ALL_LABELS_INSTALLED') or define('_SOBI2_CONFIG_LANGMAN_ALL_LABELS_INSTALLED', 'New language installed correctly.');
defined('_SOBI2_CONFIG_LANGMAN_NOT_ALL_LABELS_INSTALLED') or define('_SOBI2_CONFIG_LANGMAN_NOT_ALL_LABELS_INSTALLED', 'Warning: Missing some labels. ');


/*
* added 14.09.2006
*/
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT', 'Inform Administrators about Changes');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT_EXPL', 'Inform the administrators if an customer/author has changed his entry.');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW', 'Send Confirmation Email');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW_EXPL', 'Send confirmation email about his new entry to the customer/author.');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT', 'Send Confirmation Email about Changes');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT_EXPL', 'Send confirmation email about his changes to the customer/author. No email will be send if administrator changes the entry over the backend.');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED', 'Send Confirmation Email about Approval');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED_EXPL', 'Inform the customer/author if his entry has been approved.');

/*
* general labels
*/
defined('_SOBI2_SEND_L') or define('_SOBI2_SEND_L', 'Send');
defined('_SOBI2_YES_U') or define('_SOBI2_YES_U', 'Yes');
defined('_SOBI2_NO_U') or define('_SOBI2_NO_U', 'No');
defined('_SOBI2_ADD_U') or define('_SOBI2_ADD_U', 'Add');
defined('_SOBI2_ALL_U') or define('_SOBI2_ALL_U', 'All');
defined('_SOBI2_CATEGORY_L') or define('_SOBI2_CATEGORY_L', 'category');
defined('_SOBI2_CATEGORY_H') or define('_SOBI2_CATEGORY_H', 'Category');
defined('_SOBI2_CATEGORIES_L') or define('_SOBI2_CATEGORIES_L', 'categories');
defined('_SOBI2_CATEGORIES_H') or define('_SOBI2_CATEGORIES_H', 'Categories');
defined('_SOBI2_IS_FREE_L') or define('_SOBI2_IS_FREE_L', 'is for free');
defined('_SOBI2_IS_NOT_FREE_L') or define('_SOBI2_IS_NOT_FREE_L', 'is not free');
defined('_SOBI2_COST_L') or define('_SOBI2_COST_L', 'It costs');
defined('_SOBI2_NOT_AUTH') or define('_SOBI2_NOT_AUTH', 'You are not authorized to see this page');
defined('_SOBI2_SELECT') or define('_SOBI2_SELECT', 'select');
defined('_SOBI2_SEARCH_H') or define('_SOBI2_SEARCH_H', 'Search');
defined('_SOBI2_ADD_NEW_ENTRY') or define('_SOBI2_ADD_NEW_ENTRY', 'Add new entry');
defined('_SOBI2_NUMBER_H') or define('_SOBI2_NUMBER_H', 'Number');
defined('_SOBI2_NEVER_U') or define('_SOBI2_NEVER_U', 'Never');
defined('_SOBI2_PUBLISHED') or define('_SOBI2_PUBLISHED', 'Published');
defined('_SOBI2_CONFIRMED') or define('_SOBI2_CONFIRMED', 'Confirmed');
defined('_SOBI2_APPROVED') or define('_SOBI2_APPROVED', 'Approved');
defined('_SOBI2_REORDER') or define('_SOBI2_REORDER', 'Reorder');
defined('_SOBI2_ORDER') or define('_SOBI2_ORDER', 'Order');
defined('_SOBI2_GUEST') or define('_SOBI2_GUEST', 'Guest');
defined('_SOBI2_LANGUAGE_L') or define('_SOBI2_LANGUAGE_L', 'language');
defined('_SOBI2_CANCEL') or define('_SOBI2_CANCEL', 'Cancel');
defined('_SOBI2_SAVE') or define('_SOBI2_SAVE', 'Save');
defined('_SOBI2_IMAGE_U') or define('_SOBI2_IMAGE_U', 'Image');
defined('_SOBI2_IMAGES_U') or define('_SOBI2_IMAGES_U', 'Images');
defined('_SOBI2_META_U') or define('_SOBI2_META_U', 'Meta Info');
defined('_SOBI2_PUBLISHING_U') or define('_SOBI2_PUBLISHING_U', 'Publishing');
defined('_SOBI2_MOVE_UP') or define('_SOBI2_MOVE_UP', 'Move up');
defined('_SOBI2_MOVE_DOWN') or define('_SOBI2_MOVE_DOWN', 'Move down');
defined('_SOBI2_MENU') or define('_SOBI2_MENU', 'SOBI2 Menu');
defined('_SOBI2_SAVING_ERROR') or define('_SOBI2_SAVING_ERROR', 'Internal error while saving data. Please try again');
defined('_SOBI2_GENERAL_FILE_ERROR') or define('_SOBI2_GENERAL_FILE_ERROR', 'Could not open ');
defined('_SOBI2_DAYS_L') or define('_SOBI2_DAYS_L', 'days');
/*
* menu
*/
defined('_SOBI2_MENU_LISTING_AND_CATS') or define('_SOBI2_MENU_LISTING_AND_CATS', 'Entries &amp; Categories');
defined('_SOBI2_MENU_AWAITING_APPR') or define('_SOBI2_MENU_AWAITING_APPR', 'Awaiting approval');
defined('_SOBI2_MENU_CONFIG') or define('_SOBI2_MENU_CONFIG', 'Configuration');
defined('_SOBI2_MENU_GENERAL_CONFIG') or define('_SOBI2_MENU_GENERAL_CONFIG', 'General Configuration');
defined('_SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG') or define('_SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG', 'Entry Configuration');
defined('_SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG') or define('_SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG', 'View Configuration');
defined('_SOBI2_MENU_FIELDS_DATA') or define('_SOBI2_MENU_FIELDS_DATA', 'Fields &amp; Data');
defined('_SOBI2_MENU_EDIT_CSS') or define('_SOBI2_MENU_EDIT_CSS', 'CSS File');
defined('_SOBI2_MENU_ABOUT') or define('_SOBI2_MENU_ABOUT', 'About');
defined('_SOBI2_MENU_UNINSTALL_SOBI') or define('_SOBI2_MENU_UNINSTALL_SOBI', 'Uninstall SOBI2');
defined('_SOBI2_MENU_ABOUT_SOBI') or define('_SOBI2_MENU_ABOUT_SOBI', 'About SOBI2');
/*
* tabs
*/
defined('_SOBI2_TABHR_CATS') or define('_SOBI2_TABHR_CATS', 'Categories');
defined('_SOBI2_TABHR_ITEMS') or define('_SOBI2_TABHR_ITEMS', 'Entries');

/*
* Category Manager
*/
defined('_SOBI2_CATS_MANAGER') or define('_SOBI2_CATS_MANAGER', 'Category Manager');
defined('_SOBI2_CAT_NAME') or define('_SOBI2_CAT_NAME', 'Category Name');
defined('_SOBI2_CAT_INTROTEXT') or define('_SOBI2_CAT_INTROTEXT', 'Introtext');
defined('_SOBI2_CAT_INTROTEXT_EXPL') or define('_SOBI2_CAT_INTROTEXT_EXPL', 'Short text about the category. Also be added to meta description. Please do not enter HTML-Code or Newlines');
defined('_SOBI2_CAT_DESCRIPTION') or define('_SOBI2_CAT_DESCRIPTION', 'Category Description');
defined('_SOBI2_NO_CATS_IN_CAT') or define('_SOBI2_NO_CATS_IN_CAT', '<h3>&nbsp; &nbsp; No (sub)categories in this category</h3>');

/*
* Entry Manager
*/
defined('_SOBI2_LISTING_MANAGER') or define('_SOBI2_LISTING_MANAGER', 'Entry Manager');
defined('_SOBI2_NO_ITEMS_IN_CAT') or define('_SOBI2_NO_ITEMS_IN_CAT', '<h3>&nbsp; &nbsp; No entries in this category</h3>');
defined('_SOBI2_LISTING_TITLE') or define('_SOBI2_LISTING_TITLE', 'Entry Title');
defined('_SOBI2_LISTING_ADDED') or define('_SOBI2_LISTING_ADDED', 'Created');
defined('_SOBI2_NEW_ORDERING_SAVED') or define('_SOBI2_NEW_ORDERING_SAVED', 'New ordering saved');
defined('_SOBI2_UNAPPROVED_MANAGER') or define('_SOBI2_UNAPPROVED_MANAGER', 'Unapproved Entries');
defined('_SOBI2_NO_ITEMS_AW_APP') or define('_SOBI2_NO_ITEMS_AW_APP', '<h3>No entries awaiting approval</h3>');
defined('_SOBI2_LISTING_OWNER') or define('_SOBI2_LISTING_OWNER', 'Creator');
defined('_SOBI2_LISTING_OWNER_TYPE') or define('_SOBI2_LISTING_OWNER_TYPE', 'User Group');
defined('_SOBI2_LISTING_UPDATING_USER') or define('_SOBI2_LISTING_UPDATING_USER', 'Last Modified From');
defined('_SOBI2_LISTING_ALL_ENTRIES') or define('_SOBI2_LISTING_ALL_ENTRIES', 'All Entries');

/*
* toolbar
*/
defined('_SOBI2_TOOLBAR_EDIT') or define('_SOBI2_TOOLBAR_EDIT', 'Edit');
defined('_SOBI2_TOOLBAR_ADD_NEW') or define('_SOBI2_TOOLBAR_ADD_NEW', 'Add New: ');
defined('_SOBI2_TOOLBAR_REMOVE') or define('_SOBI2_TOOLBAR_REMOVE', 'Remove');
defined('_SOBI2_TOOLBAR_REMOVE_EXPL') or define('_SOBI2_TOOLBAR_REMOVE_EXPL', 'Removing item from the category');
defined('_SOBI2_TOOLBAR_DEL') or define('_SOBI2_TOOLBAR_DEL', 'Delete');
defined('_SOBI2_TOOLBAR_DEL_EXPL') or define('_SOBI2_TOOLBAR_DEL_EXPL', 'Deleting item permanently');
defined('_SOBI2_TOOLBAR_MOVE') or define('_SOBI2_TOOLBAR_MOVE', 'Move');
defined('_SOBI2_TOOLBAR_COPY') or define('_SOBI2_TOOLBAR_COPY', 'Copy');
defined('_SOBI2_TOOLBAR_PUBLISH') or define('_SOBI2_TOOLBAR_PUBLISH', 'Publish');
defined('_SOBI2_TOOLBAR_UNPUBLISH') or define('_SOBI2_TOOLBAR_UNPUBLISH', 'Unpublish');
defined('_SOBI2_TOOLBAR_APPROVE') or define('_SOBI2_TOOLBAR_APPROVE', 'Approve');
defined('_SOBI2_TOOLBAR_UNAPPROVE') or define('_SOBI2_TOOLBAR_UNAPPROVE', 'Unapprove');
defined('_SOBI2_TOOLBAR_CONFIRMED') or define('_SOBI2_TOOLBAR_CONFIRMED', 'Confirmed');
defined('_SOBI2_TOOLBAR_UNCONFIRMED') or define('_SOBI2_TOOLBAR_UNCONFIRMED', 'Not confirmed');

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
* edit / delete etc
*/
defined('_SOBI2_ITEM_REMOVED_FROM_CAT') or define('_SOBI2_ITEM_REMOVED_FROM_CAT', 'Items removed from this category');
defined('_SOBI2_CANNOT_REMOVE_CAT') or define('_SOBI2_CANNOT_REMOVE_CAT', 'Category cannot be removed. A category can only be deleted');
defined('_SOBI2_CAT_DELETED') or define('_SOBI2_CAT_DELETED', 'Categories deleted');
defined('_SOBI2_ITEM_DELETED') or define('_SOBI2_ITEM_DELETED', 'Entries deleted');
defined('_SOBI2_ITEM_MOVE') or define('_SOBI2_ITEM_MOVE', 'Move items');
defined('_SOBI2_ITEM_COPY') or define('_SOBI2_ITEM_COPY', 'Copy items');
defined('_SOBI2_ITEMS_MOVED') or define('_SOBI2_ITEMS_MOVED', 'All items moved');
defined('_SOBI2_NOT_ALL_ITEMS_MOVED') or define('_SOBI2_NOT_ALL_ITEMS_MOVED', 'Not all items could be moved. Some items are already in target category');
defined('_SOBI2_ITEMS_COPIED') or define('_SOBI2_ITEMS_COPIED', 'All items copied');
defined('_SOBI2_NOT_ALL_ITEMS_COPIED') or define('_SOBI2_NOT_ALL_ITEMS_COPIED', 'Not all items could be copied. Some items are already in target category');
defined('_SOBI2_ITEMS_TO_MOVE') or define('_SOBI2_ITEMS_TO_MOVE', 'Items being moved:');
defined('_SOBI2_ITEMS_TO_COPY') or define('_SOBI2_ITEMS_TO_COPY', 'Items being copied:');
defined('_SOBI2_SELECT_TARGER_CAT') or define('_SOBI2_SELECT_TARGER_CAT', 'Select Target Category');
defined('_SOBI2_CATS_MOVED') or define('_SOBI2_CATS_MOVED', 'All categories moved');
defined('_SOBI2_NOT_ALL_CATS_MOVED') or define('_SOBI2_NOT_ALL_CATS_MOVED', 'Not all categories could be moved');
defined('_SOBI2_CAT_COPY') or define('_SOBI2_CAT_COPY', 'Copy Categories');
defined('_SOBI2_CATS_TO_COPY') or define('_SOBI2_CATS_TO_COPY', 'Categories being copied:');
defined('_SOBI2_CAT_COPY_ITEMS_TOO') or define('_SOBI2_CAT_COPY_ITEMS_TOO', 'Copy entries too');
defined('_SOBI2_CAT_MOVE') or define('_SOBI2_CAT_MOVE', 'Move Categories');
defined('_SOBI2_CATS_TO_MOVE') or define('_SOBI2_CATS_TO_MOVE', 'Categories being moved:');
defined('_SOBI2_CATS_COPIED') or define('_SOBI2_CATS_COPIED', 'All categories copied');
defined('_SOBI2_NOT_ALL_CATS_COPIED') or define('_SOBI2_NOT_ALL_CATS_COPIED', 'Not all categories could be copied.');

/*
* editing entry
*/
defined('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY') or define('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Add New Entry');
defined('_SOBI2_FORM_TITLE_EDIT_ENTRY') or define('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Edit Entry');
defined('_SOBI2_FORM_ENTRY_DETAILS') or define('_SOBI2_FORM_ENTRY_DETAILS', 'Entry Details');
defined('_SOBI2_FORM_IMG_LABEL') or define('_SOBI2_FORM_IMG_LABEL', 'Company logo');
defined('_SOBI2_FORM_IMG_EXPL') or define('_SOBI2_FORM_IMG_EXPL', 'This image will be shown in details view.');
defined('_SOBI2_FORM_YOUR_IMG_LABEL') or define('_SOBI2_FORM_YOUR_IMG_LABEL', 'Company Logo: ');
defined('_SOBI2_FORM_IMG_CHANGE_LABEL') or define('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Change Company Logo: ');
defined('_SOBI2_FORM_IMG_REMOVE_LABEL') or define('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remove Company Logo');
defined('_SOBI2_FORM_ICO_LABEL') or define('_SOBI2_FORM_ICO_LABEL', 'Icon for Frontend VCard');
defined('_SOBI2_FORM_ICO_EXPL') or define('_SOBI2_FORM_ICO_EXPL', 'This image will be shown in category list.');
defined('_SOBI2_FORM_YOUR_ICO_LABEL') or define('_SOBI2_FORM_YOUR_ICO_LABEL', 'Icon: ');
defined('_SOBI2_FORM_ICO_CHANGE_LABEL') or define('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Change Icon: ');
defined('_SOBI2_FORM_ICO_REMOVE_LABEL') or define('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remove Icon');
defined('_SOBI2_FORM_SAFETY_CODE') or define('_SOBI2_FORM_SAFETY_CODE', 'Safety Code');
defined('_SOBI2_FORM_NOT_FREE_OPTION') or define('_SOBI2_FORM_NOT_FREE_OPTION', 'This option is not free.');
defined('_SOBI2_FORM_SELECT_CATEGORY') or define('_SOBI2_FORM_SELECT_CATEGORY', 'Please select categories for the entry');
defined('_SOBI2_FORM_CAT_1') or define('_SOBI2_FORM_CAT_1', 'First Category');
defined('_SOBI2_FORM_PRICE_IS') or define('_SOBI2_FORM_PRICE_IS', 'The Price is');
defined('_SOBI2_FORM_FIELD_REQ_MARK') or define('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
defined('_SOBI2_FORM_FIELD_REQ_INFO') or define('_SOBI2_FORM_FIELD_REQ_INFO', 'All fields marked with '._SOBI2_FORM_FIELD_REQ_MARK.' are required.');
defined('_SOBI2_FORM_META_KEYS_LABEL') or define('_SOBI2_FORM_META_KEYS_LABEL', 'Enter terms for meta keywords: ');
defined('_SOBI2_FORM_META_KEYS_EXPL') or define('_SOBI2_FORM_META_KEYS_EXPL', 'The entered terms will be used as keywords for search engines');
defined('_SOBI2_FORM_META_DESC_LABEL') or define('_SOBI2_FORM_META_DESC_LABEL', 'Enter text for meta description: ');
defined('_SOBI2_FORM_META_DESC_EXPL') or define('_SOBI2_FORM_META_DESC_EXPL', 'The entered description will be use as description text for search engines');
defined('_SOBI2_FORM_JS_SELECT_CAT') or define('_SOBI2_FORM_JS_SELECT_CAT', 'Please select category first');
defined('_SOBI2_FORM_JS_ACC_ENTRY_RULES') or define('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'You must accept the terms of use first');
defined('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS') or define('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Please fill in all required fields');
defined('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED') or define('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'This category is already added');
defined('_SOBI2_LISTING_EXPIRES') or define('_SOBI2_LISTING_EXPIRES', 'Expires At');
defined('_SOBI2_UPDATED_AT') or define('_SOBI2_UPDATED_AT', 'Last Modified At');
defined('_SOBI2_HITS') or define('_SOBI2_HITS', 'Hits');
defined('_SOBI2_HITS_RESET') or define('_SOBI2_HITS_RESET', 'Reset Hit Count');
defined('_SOBI2_SELECTED_CATS') or define('_SOBI2_SELECTED_CATS', 'Selected Categories');
defined('_SOBI2_EDITING_LISTING') or define('_SOBI2_EDITING_LISTING', 'Editing SOBI2 entry');
defined('_SOBI2_LISTING_CHECKED_OUT') or define('_SOBI2_LISTING_CHECKED_OUT', 'This entry is currently being edited by another user');
defined('_SOBI2_FORM_ENTRY_TITLE') or define('_SOBI2_FORM_ENTRY_TITLE', 'Company name'._SOBI2_FORM_FIELD_REQ_MARK);
defined('_SOBI2_FORM_CAN_ADD_TO_NR_CATS') or define('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "You can add this entry in up to {$config->maxCatsForEntry} categories");
defined('_SOBI2_FORM_SELECTED_CAT_DESC') or define('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Description:');
defined('_SOBI2_FORM_ADD_CAT_BT') or define ('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_L);
defined('_SOBI2_FORM_REMOVE_CAT_BT') or define('_SOBI2_FORM_REMOVE_CAT_BT','Remove '._SOBI2_CATEGORY_L);

/*
* editing category
*/
defined('_SOBI2_CAT_DETAILS') or define('_SOBI2_CAT_DETAILS', 'Category Details');
defined('_SOBI2_IMAGE_POS') or define('_SOBI2_IMAGE_POS', 'Image Position');
defined('_SOBI2_ICON') or define('_SOBI2_ICON', 'Icon');
defined('_SOBI2_CAT_ICON_EXPL') or define('_SOBI2_CAT_ICON_EXPL', 'Icon is a small image shown in the list of categories in frontend');
defined('_SOBI2_PREVIEW') or define('_SOBI2_PREVIEW', 'Images Preview');
defined('_SOBI2_CAT_WITHOUT_NAME') or define('_SOBI2_CAT_WITHOUT_NAME', 'Category must have a name');
defined('_SOBI2_CAT_WITHOUT_PARENT') or define('_SOBI2_CAT_WITHOUT_PARENT', 'Please select parent category');
defined('_SOBI2_CATEGORY_CHECKED_OUT') or define('_SOBI2_CATEGORY_CHECKED_OUT', 'This category is currently being edited by another administrator');
defined('_SOBI2_ADD_NEW_CAT') or define('_SOBI2_ADD_NEW_CAT', 'Add new category');
defined('_SOBI2_SELECTED_PARENT_ID') or define('_SOBI2_SELECTED_PARENT_ID', 'Parent Category ID');
defined('_SOBI2_NOT_ALL_CHANGES_SAVED') or define('_SOBI2_NOT_ALL_CHANGES_SAVED', 'Not all changes could be saved');
defined('_SOBI2_PARENT_CAT') or define('_SOBI2_PARENT_CAT', 'Parent Category');
defined('_SOBI2_SELECT_PARENT_CAT') or define('_SOBI2_SELECT_PARENT_CAT', 'Select Parent Category');
defined('_SOBI2_EDITING_CAT') or define('_SOBI2_EDITING_CAT', 'Category being edited');

/*
* fields manager
*/
defined('_SOBI2_FIELDS_MANAGER') or define('_SOBI2_FIELDS_MANAGER', 'Custom Fields Manager');
defined('_SOBI2_FIELD_NAME') or define('_SOBI2_FIELD_NAME', 'Field Name');
defined('_SOBI2_FIELD_NAME_EXPL') or define('_SOBI2_FIELD_NAME_EXPL', 'Unique name of the field.');
defined('_SOBI2_FIELD_LABEL') or define('_SOBI2_FIELD_LABEL', 'Field Label');
defined('_SOBI2_FIELD_LABEL_EXPL') or define('_SOBI2_FIELD_LABEL_EXPL', 'Label for the field. Shown in New/Edit Entry form and in Category and Details View (except text code) if selected.');
defined('_SOBI2_FIELD_TYPE') or define('_SOBI2_FIELD_TYPE', 'Field Type');
defined('_SOBI2_FIELD_TYPE_EXPL') or define('_SOBI2_FIELD_TYPE_EXPL', 'Select the type of the field.');
defined('_SOBI2_FIELD_FREE') or define('_SOBI2_FIELD_FREE', 'For Free');
defined('_SOBI2_FIELD_FREE_EXPL') or define('_SOBI2_FIELD_FREE_EXPL', 'Select if this field is free or not.');
defined('_SOBI2_FIELD_ENABLED') or define('_SOBI2_FIELD_ENABLED', 'Published');
defined('_SOBI2_FIELD_ENABLED_EXPL') or define('_SOBI2_FIELD_ENABLED_EXPL', 'Select if field is published or not.');
defined('_SOBI2_FIELD_REQUIRED') or define('_SOBI2_FIELD_REQUIRED', 'Required');
defined('_SOBI2_FIELD_REQUIRED_EXPL') or define('_SOBI2_FIELD_REQUIRED_EXPL', 'Select if field input is obligatory.');
defined('_SOBI2_FIELD_IN_VCARD') or define('_SOBI2_FIELD_IN_VCARD', 'In Category View');
defined('_SOBI2_FIELD_IN_DETAILS') or define('_SOBI2_FIELD_IN_DETAILS', 'In Details View');
defined('_SOBI2_ALL_FIELDS_NAMES') or define('_SOBI2_ALL_FIELDS_NAMES', 'Field labels in ');
defined('_SOBI2_ALL_FIELDS_NAMES2') or define('_SOBI2_ALL_FIELDS_NAMES2', '. If you want to edit the labels for another language, please change the base language of SOBI2.');
defined('_SOBI2_FIELD_CONSTANT') or define('_SOBI2_FIELD_CONSTANT', 'Deletable');
defined('_SOBI2_FIELD_NOT_FREE') or define('_SOBI2_FIELD_NOT_FREE', 'Not free');
defined('_SOBI2_FIELD_DISABLED') or define('_SOBI2_FIELD_DISABLED', 'Unpublished');
defined('_SOBI2_FIELD_NOT_REQUIRED') or define('_SOBI2_FIELD_NOT_REQUIRED', 'Not required');
defined('_SOBI2_TOOLBAR_ADD_NEW_FIELD') or define('_SOBI2_TOOLBAR_ADD_NEW_FIELD', 'Add new');
defined('_SOBI2_FIELD_CHECKED_OUT') or define('_SOBI2_FIELD_CHECKED_OUT', 'This field is currently being edited by another administrator');
defined('_SOBI2_FIELD_DETAILS') or define('_SOBI2_FIELD_DETAILS', 'Field Details');
defined('_SOBI2_FIELD_HELP') or define('_SOBI2_FIELD_HELP', 'Description/Explanation');
defined('_SOBI2_FIELD_NOT_EDITABLE_EXPL') or define('_SOBI2_FIELD_NOT_EDITABLE_EXPL', 'Predefined Field. Therefore some options are disabled.');
defined('_SOBI2_FIELD_CSS_CLASS') or define('_SOBI2_FIELD_CSS_CLASS', 'CSS Class');
defined('_SOBI2_FIELD_CSS_CLASS_EXPL') or define('_SOBI2_FIELD_CSS_CLASS_EXPL', 'CSS class used for the New/Edit Entry form.<br />The CSS classes for the Category and Details View will be created automatically using the field name.<br />For the Category View: span.sobi2Listing_field_xxx<br />For the Details View: span#sobi2Details_field_xxx');
defined('_SOBI2_FIELD_PREFERRED_SIZE') or define('_SOBI2_FIELD_PREFERRED_SIZE', 'Preferred Size');
defined('_SOBI2_FIELD_MAX_LENGTH') or define('_SOBI2_FIELD_MAX_LENGTH', 'Max. Length');
defined('_SOBI2_FIELD_MAX_LENGTH_EXPL') or define('_SOBI2_FIELD_MAX_LENGTH_EXPL', 'Maximum number of characters. Valid only if inputbox is the selected type.');
defined('_SOBI2_FIELD_PAYMENT') or define('_SOBI2_FIELD_PAYMENT', 'Fee');
defined('_SOBI2_FIELD_PAYMENT_EXPL') or define('_SOBI2_FIELD_PAYMENT_EXPL', 'Amount of fee if the field is not free.');
defined('_SOBI2_FIELD_DISPLAYING') or define('_SOBI2_FIELD_DISPLAYING', 'Show Field');
defined('_SOBI2_FIELD_DISPLAYING_EXPL') or define('_SOBI2_FIELD_DISPLAYING_EXPL', 'Select the views where the field should be shown. Select Hidden if the input of the field should be shown nowhere.');
defined('_SOBI2_FIELD_DO_NOT_DISPLAY') or define('_SOBI2_FIELD_DO_NOT_DISPLAY', 'Hidden');
defined('_SOBI2_FIELD_IS_URL') or define('_SOBI2_FIELD_IS_URL', 'URL Field');
defined('_SOBI2_FIELD_IN_NEW_LINE') or define('_SOBI2_FIELD_IN_NEW_LINE', 'Add New Line');
defined('_SOBI2_FIELD_IN_NEW_LINE_EXPL') or define('_SOBI2_FIELD_IN_NEW_LINE_EXPL', 'A Newline will be added in front of this field.');
defined('_SOBI2_FIELD_WITH_LABEL') or define('_SOBI2_FIELD_WITH_LABEL', 'Show Label');
defined('_SOBI2_FIELD_WITH_LABEL_EXPL') or define('_SOBI2_FIELD_WITH_LABEL_EXPL', 'The label will be shown even in the Category and Details View.');
defined('_SOBI2_FIELD_IN_SEARCH') or define('_SOBI2_FIELD_IN_SEARCH', 'Search Method');
defined('_SOBI2_FIELD_IN_SEARCH_EXPL') or define('_SOBI2_FIELD_IN_SEARCH_EXPL', 'Search for this field in the general search or using select boxes. If no is selected searching is not performed for the field.');
defined('_SOBI2_FIELD_SEARCH_SELECT_BOX') or define('_SOBI2_FIELD_SEARCH_SELECT_BOX', 'Select Box');
defined('_SOBI2_FIELD_SEARCH_SEARCH_IN') or define('_SOBI2_FIELD_SEARCH_SEARCH_IN', 'General Search');
defined('_SOBI2_FIELD_DESCRIPTION') or define('_SOBI2_FIELD_DESCRIPTION', 'Field Description');
defined('_SOBI2_FIELD_DESCRIPTION_EXPL') or define('_SOBI2_FIELD_DESCRIPTION_EXPL', 'If a description for the field is entered, it will be shown in the New/Edit Entry form as tooltip of an information symbol.');
defined('_SOBI2_FIELD_WITHOUT_NAME') or define('_SOBI2_FIELD_WITHOUT_NAME', 'Field must have a name');
defined('_SOBI2_FIELD_USE_WYSIWYG') or define('_SOBI2_FIELD_USE_WYSIWYG', 'Use WYSIWYG Editor');
defined('_SOBI2_FIELD_ROWS') or define('_SOBI2_FIELD_ROWS', 'Rows');
defined('_SOBI2_FIELD_COLS') or define('_SOBI2_FIELD_COLS', 'Columns');
defined('_SOBI2_ADD_NEW_FIELD') or define('_SOBI2_ADD_NEW_FIELD', 'Add new field');
defined('_SOBI2_FIELD_NAME_DUPLICAT') or define('_SOBI2_FIELD_NAME_DUPLICAT', 'A field with this name already exists. A new name was automatically generated. Please check the name.');
defined('_SOBI2_FIELDS_DELETED') or define('_SOBI2_FIELDS_DELETED', 'Fields deleted');
defined('_SOBI2_NOT_ALL_FIELDS_DELETED') or define('_SOBI2_NOT_ALL_FIELDS_DELETED', 'Not all fields could be deleted');

/*
* configuration
*/
defined('_SOBI2_CONFIG') or define('_SOBI2_CONFIG', 'Configuration');
defined('_SOBI2_CONFIG_GEN') or define('_SOBI2_CONFIG_GEN', 'General');
defined('_SOBI2_CONFIG_GEN_OPTION') or define('_SOBI2_CONFIG_GEN_OPTION', 'General Options');
defined('_SOBI2_CONFIG_COMPONENT_NAME') or define('_SOBI2_CONFIG_COMPONENT_NAME', 'Component Name');
defined('_SOBI2_CONFIG_COMPONENT_NAME_EXPL') or define('_SOBI2_CONFIG_COMPONENT_NAME_EXPL', 'Will be shown in SOBI2 menu as component link. Will be added to meta tags, etc.');
defined('_SOBI2_CONFIG_FRONTPAGE') or define('_SOBI2_CONFIG_FRONTPAGE', 'Mainpage');
defined('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION') or define('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION', 'Show Description of Component');
defined('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT') or define('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT', 'Description of Component');
defined('_SOBI2_CONFIG_GENERAL_IMG_FOR_DESCRIPTION') or define('_SOBI2_CONFIG_GENERAL_IMG_FOR_DESCRIPTION', 'Image for Description');
defined('_SOBI2_CONFIG_LANGUAGE') or define('_SOBI2_CONFIG_LANGUAGE', 'SOBI2 Language');
defined('_SOBI2_CONFIG_LANGUAGE_EXPL') or define('_SOBI2_CONFIG_LANGUAGE_EXPL', 'Set to default if you want to use the CMS main language.');
defined('_SOBI2_CONFIG_GENERAL_SHOW_HP_LINK') or define('_SOBI2_CONFIG_GENERAL_SHOW_HP_LINK', 'Show Component Link');
defined('_SOBI2_CONFIG_GENERAL_SHOW_NEW_ENTRY_LINK') or define('_SOBI2_CONFIG_GENERAL_SHOW_NEW_ENTRY_LINK', 'Show Link "Add Entry"');
defined('_SOBI2_CONFIG_GENERAL_SHOW_SEARCH_LINK') or define('_SOBI2_CONFIG_GENERAL_SHOW_SEARCH_LINK', 'Show Link "Search"');
defined('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP') or define('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP', 'Show Entries on Mainpage');
defined('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP_EXPL') or define('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP_EXPL', 'If yes, all entries will be shown on the first page of SOBI2 component (General View).');
defined('_SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE') or define('_SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE', 'Number of Entries in a Single Line');
defined('_SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE') or define('_SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE', 'Number of Lines on a Page');
defined('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP') or define('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP', 'Show Categories on Mainpage');
defined('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP_EXPL') or define('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP_EXPL', 'If yes, all categories will be shown on the first page of SOBI2 component (General View).');
defined('_SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE') or define('_SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE', 'Number of Categories in a Single Line');
defined('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS') or define('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS', 'Show Entries of Subcategories');
defined('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS_EXPL') or define('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS_EXPL', 'If yes, all entries of the subcategories will be shown also in parent category.');
defined('_SOBI2_CONFIG_GENERAL_SHOW_ICO_IN_VC') or define('_SOBI2_CONFIG_GENERAL_SHOW_ICO_IN_VC', 'Display Icon in Category View');
defined('_SOBI2_CONFIG_GENERAL_SHOW_LOGO_IN_VC') or define('_SOBI2_CONFIG_GENERAL_SHOW_LOGO_IN_VC', 'Display Image in Category View');
defined('_SOBI2_CONFIG_GENERAL_USE_META') or define('_SOBI2_CONFIG_GENERAL_USE_META', 'Use Meta Tags');
defined('_SOBI2_CONFIG_GENERAL_USE_META_EXPL') or define('_SOBI2_CONFIG_GENERAL_USE_META_EXPL', 'Allow user adding its own meta tags and meta keys.');
defined('_SOBI2_CONFIG_GENERAL_SHOW_CAT_INFO') or define('_SOBI2_CONFIG_GENERAL_SHOW_CAT_INFO', 'Show Description of Category');

defined('_SOBI2_CONFIG_GENERAL_SORT_TITLE_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_TITLE_ASC', 'title ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_TITLE_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_TITLE_DESC','title descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_ADDED_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_ADDED_ASC', 'date added ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_ADDED_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_ADDED_DESC','date added descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_COUNT_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_COUNT_ASC', 'count ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_COUNT_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_COUNT_DESC', 'count descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_HITS_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_HITS_DESC', 'hits descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_HITS_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_HITS_ASC', 'hits descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_NAME_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_NAME_ASC', 'name ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_NAME_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_NAME_DESC','name descending');
defined('_SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC') or define('_SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC', 'ordering ascending');
defined('_SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC') or define('_SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC','ordering descending');

defined('_SOBI2_CONFIG_GENERAL_PERMS') or define('_SOBI2_CONFIG_GENERAL_PERMS','Editing Permissions');
defined('_SOBI2_CONFIG_GENERAL_PERMS_EDIT') or define('_SOBI2_CONFIG_GENERAL_PERMS_EDIT','Allow User to Edit its own Entries');
defined('_SOBI2_CONFIG_GENERAL_PERMS_DEL') or define('_SOBI2_CONFIG_GENERAL_PERMS_DEL','Allow Deletion');
defined('_SOBI2_CONFIG_GENERAL_PERMS_DEL_EXPL') or define('_SOBI2_CONFIG_GENERAL_PERMS_DEL_EXPL','Select if user is able to delete or only unpublish its own entries.');
defined('_SOBI2_CONFIG_GENERAL_PERMS_UNPUBLISH') or define('_SOBI2_CONFIG_GENERAL_PERMS_UNPUBLISH','Only unpublish');
defined('_SOBI2_CONFIG_GENERAL_SORT_LISTING_BY') or define('_SOBI2_CONFIG_GENERAL_SORT_LISTING_BY','Sort Entries by');
defined('_SOBI2_CONFIG_GENERAL_SORT_CATS_BY') or define('_SOBI2_CONFIG_GENERAL_SORT_CATS_BY','Sort Categories by');

defined('_SOBI2_CONFIG_FIELDS') or define('_SOBI2_CONFIG_FIELDS', 'Fields');
defined('_SOBI2_CONFIG_FIELDS_DESC') or define('_SOBI2_CONFIG_FIELDS_DESC', 'Constant Fields Configuration (Title, Image and Icon)');
defined('_SOBI2_CONFIG_ENTRY_T_LABEL') or define('_SOBI2_CONFIG_ENTRY_T_LABEL', 'Title Label');
defined('_SOBI2_CONFIG_ENTRY_T_LABEL_EXPL') or define('_SOBI2_CONFIG_ENTRY_T_LABEL_EXPL', 'Label of the first inputbox in New/Edit Entry form (entry title).');
defined('_SOBI2_CONFIG_ENTRY_T_LENGTH') or define('_SOBI2_CONFIG_ENTRY_T_LENGTH', 'Length of Title Inputbox');
defined('_SOBI2_CONFIG_ENTRY_T_LENGTH_EXPL') or define('_SOBI2_CONFIG_ENTRY_T_LENGTH_EXPL', 'Length of the first inputbox in New/Edit Entry form (entry title)');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI') or define('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI', 'Allow Duplicate Titles');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI_EXPL', 'Allow adding more than one entry with this same title');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_IMG') or define('_SOBI2_CONFIG_ENTRY_ALLOW_IMG', 'Allow Adding Images');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_ICO') or define('_SOBI2_CONFIG_ENTRY_ALLOW_ICO', 'Allow Adding Icons');
defined('_SOBI2_CONFIG_ENTRY_RESIZE_IMG') or define('_SOBI2_CONFIG_ENTRY_RESIZE_IMG', 'Resize Image To');
defined('_SOBI2_CONFIG_ENTRY_RESIZE_IMG_EXPL') or define('_SOBI2_CONFIG_ENTRY_RESIZE_IMG_EXPL', 'Set maximal height and width for the image. If uploaded image is larger, it will be resized.');
defined('_SOBI2_CONFIG_ENTRY_W') or define('_SOBI2_CONFIG_ENTRY_W', 'Width: ');
defined('_SOBI2_CONFIG_ENTRY_H') or define('_SOBI2_CONFIG_ENTRY_H', 'Height: ');
defined('_SOBI2_CONFIG_ENTRY_RESIZE_ICO') or define('_SOBI2_CONFIG_ENTRY_RESIZE_ICO', 'Resize Icon To');
defined('_SOBI2_CONFIG_ENTRY_RESIZE_ICO_EXPL') or define('_SOBI2_CONFIG_ENTRY_RESIZE_ICO_EXPL', 'Set maximal height and width for the icon. If uploaded icon is larger, it will be resized.');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE') or define('_SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE', 'Yes, but not free ');
defined('_SOBI2_CONFIG_ENTRY_IMG_LABEL') or define('_SOBI2_CONFIG_ENTRY_IMG_LABEL', 'Image Label');
defined('_SOBI2_CONFIG_ENTRY_IMG_LABEL_EXPL') or define('_SOBI2_CONFIG_ENTRY_IMG_LABEL_EXPL', 'Label for the image inputbox in New/Edit Entry form.');
defined('_SOBI2_CONFIG_ENTRY_PRICE_IMG') or define('_SOBI2_CONFIG_ENTRY_PRICE_IMG', 'Price For Image');
defined('_SOBI2_CONFIG_ENTRY_PRICE_ICO') or define('_SOBI2_CONFIG_ENTRY_PRICE_ICO', 'Price For Icon');
defined('_SOBI2_CONFIG_ENTRY_ICO_LABEL') or define('_SOBI2_CONFIG_ENTRY_ICO_LABEL', 'Icon Label');
defined('_SOBI2_CONFIG_ENTRY_ICO_LABEL_EXPL') or define('_SOBI2_CONFIG_ENTRY_ICO_LABEL_EXPL', 'Label for the small image inputbox in New/Edit Entry form. The small image is usually shown in the Category View.');
defined('_SOBI2_CONFIG_ENTRY_UP_TO_CATS') or define('_SOBI2_CONFIG_ENTRY_UP_TO_CATS', 'Allow Adding Entry up to');
defined('_SOBI2_CONFIG_ENTRY_2_CAT') or define('_SOBI2_CONFIG_ENTRY_2_CAT', 'Entry In Second Category');
defined('_SOBI2_CONFIG_ENTRY_2_CAT_PRICE') or define('_SOBI2_CONFIG_ENTRY_2_CAT_PRICE', 'Price For Entry In Second Category');
defined('_SOBI2_CONFIG_ENTRY_3_CAT') or define('_SOBI2_CONFIG_ENTRY_3_CAT', 'Entry In Third category');
defined('_SOBI2_CONFIG_ENTRY_3_CAT_PRICE') or define('_SOBI2_CONFIG_ENTRY_3_CAT_PRICE', 'Price For Entry In Third Category');
defined('_SOBI2_CONFIG_ENTRY_4_CAT') or define('_SOBI2_CONFIG_ENTRY_4_CAT', 'Entry In Fourth category');
defined('_SOBI2_CONFIG_ENTRY_4_CAT_PRICE') or define('_SOBI2_CONFIG_ENTRY_4_CAT_PRICE', 'Price For Entry In Fourth Category');
defined('_SOBI2_CONFIG_ENTRY_5_CAT') or define('_SOBI2_CONFIG_ENTRY_5_CAT', 'Entry In Fifth category');
defined('_SOBI2_CONFIG_ENTRY_5_CAT_PRICE') or define('_SOBI2_CONFIG_ENTRY_5_CAT_PRICE', 'Price For Entry In Fifth Category');
defined('_SOBI2_CONFIG_ENTRY_SAFETY') or define('_SOBI2_CONFIG_ENTRY_SAFETY', 'Safety');
defined('_SOBI2_CONFIG_ENTRY_SAFETY_OPTIONS') or define('_SOBI2_CONFIG_ENTRY_SAFETY_OPTIONS', 'Safety Options');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_ANO') or define('_SOBI2_CONFIG_ENTRY_ALLOW_ANO', 'Allow Anonymous Entries');
defined('_SOBI2_CONFIG_ENTRY_ALLOW_ANO_EXPL') or define('_SOBI2_CONFIG_ENTRY_ALLOW_ANO_EXPL', 'Allow unregistered users to add entries.');
defined('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH') or define('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH', 'Publish Entries Automatically');
defined('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH_EXPL') or define('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH_EXPL', 'A new entry will be published directly without approval of an administrator.');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN', 'Inform Administrators');
defined('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EXPL') or define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EXPL', 'Inform the administrators of new entries.');

defined('_SOBI2_CONFIG_GENERAL_BACKGROUNDS') or define('_SOBI2_CONFIG_GENERAL_BACKGROUNDS','Background');
defined('_SOBI2_CONFIG_GENERAL_BACKGROUNDS_AND_BORDERS') or define('_SOBI2_CONFIG_GENERAL_BACKGROUNDS_AND_BORDERS','Background And Border Color Settings');
defined('_SOBI2_CONFIG_GENERAL_BORDERS') or define('_SOBI2_CONFIG_GENERAL_BORDERS','Border Color');
defined('_SOBI2_CONFIG_GENERAL_BORDER_EXPL') or define('_SOBI2_CONFIG_GENERAL_BORDER_EXPL','Border color of entries in Category and Details View');
defined('_SOBI2_CONFIG_GENERAL_BACKGROUND') or define('_SOBI2_CONFIG_GENERAL_BACKGROUND','Background Image');
defined('_SOBI2_CONFIG_GENERAL_BACKGROUND_EXPL') or define('_SOBI2_CONFIG_GENERAL_BACKGROUND_EXPL','Background image of entries in Category and Details View');


defined('_SOBI2_CONFIG_ENTRY_EXP_TIME') or define('_SOBI2_CONFIG_ENTRY_EXP_TIME', 'Stop Publishing After');
defined('_SOBI2_CONFIG_ENTRY_EXP_TIME_EXPL') or define('_SOBI2_CONFIG_ENTRY_EXP_TIME_EXPL', 'How many days an entry should be published. Set to 0 or leave empty if entries never expire.');
defined('_SOBI_CONFIG_ENTRY_USE_SEC_IMG') or define('_SOBI_CONFIG_ENTRY_USE_SEC_IMG', 'Use Safety Code');
defined('_SOBI_CONFIG_ENTRY_SEC_IMG') or define('_SOBI_CONFIG_ENTRY_SEC_IMG', 'Safety Code');
defined('_SOBI_CONFIG_ENTRY_USE_SEC_IMG_EXPL') or define('_SOBI_CONFIG_ENTRY_USE_SEC_IMG_EXPL', 'Activate function to prevent automatized entering by robots.');
defined('_SOBI_CONFIG_ENTRY_SEC_IMG_FONTCOLOR') or define('_SOBI_CONFIG_ENTRY_SEC_IMG_FONTCOLOR', 'Font Color');
defined('_SOBI_CONFIG_ENTRY_SEC_IMG_LINECOLOR') or define('_SOBI_CONFIG_ENTRY_SEC_IMG_LINECOLOR', 'Grid Color');
defined('_SOBI_CONFIG_ENTRY_SEC_IMG_BGCOLOR') or define('_SOBI_CONFIG_ENTRY_SEC_IMG_BGCOLOR', 'Background Color');
defined('_SOBI_CONFIG_ENTRY_SEC_IMG_BORDERCOLOR') or define('_SOBI_CONFIG_ENTRY_SEC_IMG_BORDERCOLOR', 'Frame Color');
defined('_SOBI_CONFIG_ENTRY_ACCEPT_RULES') or define('_SOBI_CONFIG_ENTRY_ACCEPT_RULES', 'Terms Of Use');
defined('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES') or define('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES', 'User has to accept the terms of use');
defined('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES_EXPL') or define('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES_EXPL', 'Decide, if an user has to accept the terms of use to make an entry.');
defined('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1') or define('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1', 'Label for the Terms Of Use Part 1');
defined('_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL') or define('_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL', 'Link to the Terms Of Use');
defined('_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT') or define('_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT', 'Text of link to the terms of use');
defined('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2') or define('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2', 'Label for the Terms Of Use Part 2');
defined('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABELS_EXPL') or define('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABELS_EXPL', '<h4>This will create a label like that: &nbsp;&nbsp;&nbsp;&nbsp;<span class="editlinktip">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),'','','I accept the', '#',0 )
.'</span>&nbsp;&nbsp;<span class="editlinktip"><a href="#">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT),'','','terms of use', '#',0 )
.'</a></span>&nbsp;&nbsp;<span class="editlinktip">' .
sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),'','','of this site', '#',0 )
.'</h4>');
defined('_SOBI2_CONFIG_VIEW_OPTIONS') or define('_SOBI2_CONFIG_VIEW_OPTIONS', 'Configuration of Details View');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_ICO') or define('_SOBI2_CONFIG_VIEW_OPTIONS_ICO', 'Show Icon in Details View');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_ICO_EXPL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_ICO_EXPL', 'If yes, the small image (icon) will be displayed in details view.');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_IMG') or define('_SOBI2_CONFIG_VIEW_OPTIONS_IMG', 'Show Image in Details View');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_IMG_EXPL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_IMG_EXPL', 'If yes, the large image will be displayed in details view.');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_ADDED_DATE') or define('_SOBI2_CONFIG_VIEW_OPTIONS_ADDED_DATE', 'Show Entry Date');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_HITS') or define('_SOBI2_CONFIG_VIEW_OPTIONS_HITS', 'Show Hits');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH') or define('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH', 'Show Link to Routing Site');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL', 'URL to Routing Site');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL', 'Link Text');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL_EXPL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL_EXPL', 'How the link should be shown. For example: Show Routing. Insert images using the img-tag.');
defined('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL_VAR_EXPL') or define('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL_VAR_EXPL', 'Such an URL normally looks like that:' .
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

defined('_SOBI2_CONFIG_PAYMENTS_OPTIONS') or define('_SOBI2_CONFIG_PAYMENTS_OPTIONS', 'Payment Options');
defined('_SOBI2_CONFIG_PAYMENTS_CURRENCY') or define('_SOBI2_CONFIG_PAYMENTS_CURRENCY', 'Currency Symbol');
defined('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR') or define('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR', 'Currency Separator');
defined('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR_EXPL', 'Should be a comma or a point. For example 100.99 EUR or 100,99 EUR');
defined('_SOBI2_CONFIG_PAYMENTS_TITLE') or define('_SOBI2_CONFIG_PAYMENTS_TITLE', 'Payment Reference');
defined('_SOBI2_CONFIG_PAYMENTS_TITLE_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_TITLE_EXPL', 'Text will be used as bank transfer reference or PayPal payment reference. The SOBI2 ID number will be appended.');
defined('_SOBI2_CONFIG_PAYMENTS_BANK_TRANSFER') or define('_SOBI2_CONFIG_PAYMENTS_BANK_TRANSFER', 'Bank/eCheck Transfer Options');
defined('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER') or define('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER', 'Use Bank/eCheck Transfer');
defined('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_EXPL', 'If yes, user can pay via bank/eCheck transfer. Bank account/eCheck data are displayed on the summary page or sent via email.');
defined('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_OVER_EMAIL') or define('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_OVER_EMAIL', 'Yes, but send bank account/eCheck data via email');
defined('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_ON_PAGE') or define('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_ON_PAGE', 'Yes, and display bank account/eCheck data on summary page');
defined('_SOBI2_CONFIG_PAYMENTS_BANK_DATA') or define('_SOBI2_CONFIG_PAYMENTS_BANK_DATA', 'Bank Account/eCheck Data');
defined('_SOBI2_CONFIG_PAYMENTS_BANK_DATA_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_BANK_DATA_EXPL', 'Insert your bank account/eCheck data here');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL', 'PayPal Options');
defined('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL') or define('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL', 'Use PayPal');
defined('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL_EXPL') or define('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL_EXPL', 'If yes, user can pay via PayPal.');
defined('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_EMAIL') or define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_EMAIL', 'Email Address');
defined('_SOBI2_GENERAL_FILE_IS') or define('_SOBI2_GENERAL_FILE_IS', ' file is: ');
defined('_SOBI2_GENERAL_FILE_WRITABLE') or define('_SOBI2_GENERAL_FILE_WRITABLE', '<span style="color: rgb(0, 128, 0); font-weight: bold;">Writable</span>');
defined('_SOBI2_GENERAL_FILE_UNWRITABLE') or define('_SOBI2_GENERAL_FILE_UNWRITABLE', '<span style="color: rgb(255, 0, 0); font-weight: bold;">Unwritable</span>');
defined('_SOBI2_GENERAL_DO_FILE_UNWRITABLE') or define('_SOBI2_GENERAL_DO_FILE_UNWRITABLE', 'Make unwriteable after saving');
defined('_SOBI2_GENERAL_DO_FILE_WRITABLE') or define('_SOBI2_GENERAL_DO_FILE_WRITABLE', 'Overwrite write protection');

defined('_SOBI2_UNINSTALL_DB_TXT') or define('_SOBI2_UNINSTALL_DB_TXT', '<div style="text-align:left">' .
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
defined('_SOBI2_UNINSTALL_DB_LINK') or define('_SOBI2_UNINSTALL_DB_LINK', 'Remove SOBI2 tables from database');
defined('_SOBI2_UNINSTALL_DB_CONFIRM') or define('_SOBI2_UNINSTALL_DB_CONFIRM', 'Are you really sure to remove the SOBI2 tables from the database?');
defined('_SOBI2_DB_REMOVED_MSG') or define('_SOBI2_DB_REMOVED_MSG', 'The SOBI2 tables were removed from database successfully. Uninstall the component now.');
defined('_SOBI2_DB_REMOVE_ERROR_MSG') or define('_SOBI2_DB_REMOVE_ERROR_MSG', 'The SOBI2 tables were not removed from database. Remove them manually and then uninstall the component.');
?>