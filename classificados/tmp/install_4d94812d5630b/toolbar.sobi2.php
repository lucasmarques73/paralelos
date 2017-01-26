<?php
/**
* @version $Id: toolbar.sobi2.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
( defined( '_SOBI2_' ) || defined( '_VALID_MOS' ) || defined( "_JEXEC" ) ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
defined("_SOBI2_") || define("_SOBI2_", true);
if( isset( $_GET['sinstall'] ) ) {
	return null;
}
defined("DS") || define("DS",DIRECTORY_SEPARATOR);
defined("_SOBI_ADM_PATH") || define("_SOBI_ADM_PATH", dirname(__FILE__) );
defined("_SOBI_FE_PATH") || define("_SOBI_FE_PATH", str_replace("administrator".DS, "", _SOBI_ADM_PATH) );
defined("_SOBI_CMSROOT") || define("_SOBI_CMSROOT", str_replace( DS."components".DS."com_sobi2", "", _SOBI_FE_PATH ) );
defined("_SOBI2_ADMIN") || define('_SOBI2_ADMIN', true);

if(defined("_JEXEC") && !defined("_SOBI2_ADM_PASSED")) {
	return null;
}
require_once(_SOBI_FE_PATH.DS."config.class.php");
require_once(_SOBI_ADM_PATH.DS."admin.config.class.php");
require_once( _SOBI_ADM_PATH.DS."toolbar.sobi2.html.php");
$nohtml = sobi2Config::request($_REQUEST, "no_html", 0);
if($nohtml) {
	return null;
}
$config =& adminConfig::getInstance();
if(!(defined("_SOBI_MAMBO"))) {
	if(!file_exists(_SOBI_CMSROOT.DS."includes".DS."joomla.php")) {
		define("_SOBI_MAMBO", true);
		sobi2Config::import("includes|html");
		$config->addCustomHeadTag("<link rel='stylesheet' href='{$config->liveSite}/administrator/components/com_sobi2/includes/admin.sobi2.css' type='text/css'/>");
		if (!file_exists( _SOBI_ADM_PATH.DS.'languages'.DS.'admin.'.$config->sobi2Language.'.php' )) {
			$config->sobi2Language = 'english';
		}
		require_once(_SOBI_ADM_PATH.DS.'languages'.DS.'admin.'.$config->sobi2Language.'.php' );
		require_once( _SOBI_ADM_PATH.DS.'languages'.DS.'admin.default.php' );
	}
}

$task = sobi2Config::request( $_REQUEST, "task", null );
switch ($task) {
	case 'listing':
		TOOLBAR_SOBI::_LISTING();
		break;
	case 'move':
		TOOLBAR_SOBI::_MOVING();
		break;
	case 'copy':
		TOOLBAR_SOBI::_COPY();
		break;
	case 'config':
	case 'about':
		TOOLBAR_SOBI::_CONFIG($task);
		break;
	case 'getUnapproved':
		TOOLBAR_SOBI::_APPROVE();
		break;
	case 'edit category':
	case 'addItem':
	case 'addCat':
	case 'edit':
	case 'edit listing':
	case 'edit field':
	case 'editField':
	case 'addField':
		TOOLBAR_SOBI::_EDIT( $task );
		break;
	case 'genConf':
	case 'efConf':
	case 'viewConf':
	case 'payConf':
	case 'editCSS':
	case 'editTemplate':
	case 'editVCTemplate':
	case 'registry':
	case 'editFormTemplate':
		TOOLBAR_SOBI::_CONFIG( $task );
		break;
	case 'addCats':
		TOOLBAR_SOBI::_ADDCATS();
		break;
	case 'editFields':
		TOOLBAR_SOBI::_FIELDS();
	case 'emails':
	case 'about':
	case 'eula':
		break;
	case 'uninstall':
		TOOLBAR_SOBI::_UNINSTALL();
		break;
	case 'langMan':
	case 'templates':
		TOOLBAR_SOBI::_LANGMAN( $task );
		break;
	case 'errlog':
		TOOLBAR_SOBI::_ERRORLOGFLE();
		break;
	case 'plugins':
		TOOLBAR_SOBI::_PLUGINS();
		break;
	case 'pluginsManager':
		TOOLBAR_SOBI::_PLUGINSMANAGER();
		break;
	case 'recount':
	case 'syscheck':
	case 'vercheck':
		break;
	default:
		$pm = false;
		if( !empty( $config->S2_plugins ) ) {
			foreach ( $config->S2_plugins as $plugin ) {
				if( method_exists( $plugin, 'onCreateToolbar' ) ) {
					if( $plugin->onCreateToolbar( $task ) ) {
						$pm = true;
					}
				}
			}
		}
		if( !$pm ) {
			TOOLBAR_SOBI::_LISTING();
		}
		break;
}
?>