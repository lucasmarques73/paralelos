<?php
/**
* @version $Id: syscheck.default.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined('_SOBI2SC_STATE_0') or define('_SOBI2SC_STATE_0', '<span style="color: rgb(255, 0, 0); font-weight: bold;">Unknown</span>');
defined('_SOBI2SC_STATE_1') or define('_SOBI2SC_STATE_1', '<span style="font-weight: bold; color: rgb(51, 204, 0);">Perfect</span>');
defined('_SOBI2SC_STATE_2') or define('_SOBI2SC_STATE_2', '<span style="font-weight: bold; color: rgb(0, 153, 0);">OK</span>');
defined('_SOBI2SC_STATE_3') or define('_SOBI2SC_STATE_3', '<span style="color: rgb(153, 153, 0);">Should be OK</span>');
defined('_SOBI2SC_STATE_4') or define('_SOBI2SC_STATE_4', '<span style="color: rgb(255, 204, 51); font-weight: bold;">May cause problems</span>');
defined('_SOBI2SC_STATE_5') or define('_SOBI2SC_STATE_5', '<span style="color: rgb(255, 0, 0); font-weight: bold;"><b>Not acceptable</b></span>');
defined('_SOBI2SC_STATE_6') or define('_SOBI2SC_STATE_6', '<span style="color: rgb(255, 0, 0);">Should work but this file is writable for <b>ALL</b>.<br/> It can be <b>security risk</b></span>');
defined('_SOBI2SC_HEADER_SUBJECT') or define('_SOBI2SC_HEADER_SUBJECT', 'Setting');
defined('_SOBI2SC_HEADER_STATE') or define('_SOBI2SC_HEADER_STATE', 'State');
defined('_SOBI2SC_HEADER_STATE_OK') or define('_SOBI2SC_HEADER_STATE_OK', 'State OK?');
defined('_SOBI2SC_PHPVER_IS') or define('_SOBI2SC_PHPVER_IS', 'PHP Version:');
defined('_SOBI2SC_APACHE_IS') or define('_SOBI2SC_APACHE_IS', 'Apache Version:');
defined('_SOBI2SC_MYSQL_IS') or define('_SOBI2SC_MYSQL_IS', 'MySQL Version:');
defined('_SOBI2SC_MEMLIM_IS') or define('_SOBI2SC_MEMLIM_IS', 'PHP Memory Limit:');
defined('_SOBI2SC_TIMELIM_IS') or define('_SOBI2SC_TIMELIM_IS', 'PHP Script Execution Time:');
defined('_SOBI2SC_SM_IS') or define('_SOBI2SC_SM_IS', 'PHP Safe Mode:');
defined('_SOBI2SC_RG_IS') or define('_SOBI2SC_RG_IS', 'PHP Register Globals:');
defined('_SOBI2SC_ERG_IS') or define('_SOBI2SC_ERG_IS', 'CMS RG Emulation:');
defined('_SOBI2SC_GD_IS') or define('_SOBI2SC_GD_IS', 'GD Library:');
defined('_SOBI2SC_IM_IS') or define('_SOBI2SC_IM_IS', 'iconv/mbstring Library:');
defined('_SOBI2SC_CHARSET_IS') or define('_SOBI2SC_CHARSET_IS', 'Charset:');
defined('_SOBI2SC_DBCOL_IS') or define('_SOBI2SC_DBCOL_IS', 'Database Collation:');
defined('_SOBI2SC_FILES_PERMS') or define('_SOBI2SC_FILES_PERMS', 'File Permissions');
defined('_SOBI2SC_FILENAME') or define('_SOBI2SC_FILENAME', 'File Name');
defined('_SOBI2SC_FILE_W') or define('_SOBI2SC_FILE_W', 'Writable');
defined('_SOBI2SC_FILE_O') or define('_SOBI2SC_FILE_O', 'Owner');
defined('_SOBI2SC_FILE_G') or define('_SOBI2SC_FILE_G', 'Group');
defined('_SOBI2SC_CMS_IS') or define('_SOBI2SC_CMS_IS', 'CMS:');
defined('_SOBI2SC_RG_IS') or define('_SOBI2SC_RG_IS', 'PHP Register Globals:');
defined('_SOBI2SC_AT_IS') or define('_SOBI2SC_AT_IS', 'Admin Template:');
defined('_SOBI2SC_CHAT_IS') or define('_SOBI2SC_CHAT_IS', 'The workaround to include custom head tags from components seems to be missing in this admin template. SOBI2 Admin Panel will probably not work properly.');
defined('_SOBI2SC_WARNING') or define('_SOBI2SC_WARNING', 'Warning');
defined('_SOBI2SC_TEMPLATE_CHECK') or define('_SOBI2SC_TEMPLATE_CHECK', 'Default Template Check:');
defined('_SOBI2SC_JS_CONF') or define('_SOBI2SC_JS_CONF', 'This template includes several JavaScripts which may conflict with the MooTools library. The SOBI2 search function may not work properly.');
defined('_SOBI2SC_GET_FILE') or define('_SOBI2SC_GET_FILE', 'Download System Check Log file');
?>