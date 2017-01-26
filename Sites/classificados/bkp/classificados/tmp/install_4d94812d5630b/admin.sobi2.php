<?php
/**
* @version $Id: admin.sobi2.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
( defined( "_VALID_MOS" ) || defined( "_JEXEC" ) ) || ( trigger_error( "Restricted access", E_USER_ERROR ) && exit() );
defined( "_SOBI2_" ) || define( "_SOBI2_", true );

if( isset( $_GET['sinstall'] ) ) {
	require_once( dirname( __FILE__ ).DIRECTORY_SEPARATOR.'install.sobi2.php' );
	return installSobi2();
}
if( file_exists( dirname( __FILE__ ).DIRECTORY_SEPARATOR.'install.sobi2.php' ) ) {
	if( defined( "_JEXEC" ) && class_exists( "JRequest" ) ) {
		$m = JFactory::getApplication( 'site' );
		$m->redirect( 'index2.php?option=com_sobi2&sinstall=screen', 'SOBI2 Installation is not completed. Please finish the installation first' );
	}
	else {
		mosRedirect( 'index2.php?option=com_sobi2&sinstall=screen', 'SOBI2 Installation is not completed. Please finish the installation first' );
	}
}

define( "_SOBI2_MEMDEB", false );
$timeStart = microtime(true);
/**
 * array_combine is using for items/cats/fields reordering.
 * This function exist since PHP5.
 * This function is used wenn SOBI work under PHP < 5
 * Snippet from php.net
 * Creates an array by using one array for keys and another for its values
 * @param array $a Array of keys to be used
 * @param array $b Array of values to be used
 */
	if (!function_exists('array_combine')) {
	   function array_combine($a, $b) {
	       $c = array();
	       if (is_array($a) && is_array($b))
	           while (list(, $va) = each($a))
	               if (list(, $vb) = each($b)) {
	                   $c[$va] = $vb;
	               }
	               else {
	                   break 1;
	               }
	       return $c;
	   }
	}
	if(!defined("DS")) {
		define("DS",DIRECTORY_SEPARATOR);
	}
	if( _SOBI2_MEMDEB ) {
		$memArr = array();
		$memArr["Start: "] = memory_get_usage();
	}

//foreach($_REQUEST as $value => $key) {
//	echo "<h4>{$value} : {$key}</h4>";
//}
//print_r($_REQUEST);

	defined("_SOBI_ADM_PATH") || define("_SOBI_ADM_PATH", dirname(__FILE__) );
	defined("_SOBI_FE_PATH") || define("_SOBI_FE_PATH", str_replace("administrator".DS, "", _SOBI_ADM_PATH) );
	defined("_SOBI_CMSROOT") || define("_SOBI_CMSROOT", str_replace( DS."components".DS."com_sobi2", "", _SOBI_FE_PATH ) );
	defined("_SOBI2_ADMIN") || define('_SOBI2_ADMIN', true);
	if( _SOBI2_MEMDEB ) {
		$memArr["Path Definitions: "] = memory_get_usage();
	}
	require_once( _SOBI_FE_PATH.DS.'config.class.php' );
	sobi2Config::import("admin.config.class", "adm");
	$config =& adminConfig::getInstance();
	if( _SOBI2_MEMDEB ) {
		$memArr["Config in: "] = memory_get_usage();
	}
	$database =& $config->getDb();
	sobi2Config::import("includes|tab.class");
	sobi2Config::import("includes|html");
	sobi2Config::import("admin.menu.class", "adm");
	sobi2Config::import("admtoolbar.class", "adm");
	sobi2Config::import("admin.sobi2.html", "adm");
	if( _SOBI2_MEMDEB ) {
		$memArr["Classes in: "] = memory_get_usage();
	}
	if(!(defined("_SOBI_MAMBO"))) {
		if(!file_exists(_SOBI_CMSROOT.DS."includes".DS."joomla.php")) {
			define("_SOBI_MAMBO", true);
		}
	}
	if($config->debug > 100) {
		$debugLevel = $config->debug - 100;
	}
	else {
		$debugLevel = $config->debug;
	}
	if($config->debug >= 0) {
		switch ($debugLevel) {
			case 7:
				$restoreErrorReporting = error_reporting(E_ERROR);
				break;
			case 8:
				$restoreErrorReporting = error_reporting(E_WARNING | E_ERROR);
				break;
			default:
			case 9:
				$restoreErrorReporting = error_reporting(E_ALL);
				break;
		}
	}
	else {
		$restoreErrorReporting = error_reporting();
	}
	if($config->debug > 100) {
		ini_set("display_errors","on");
	}
	else {
		set_error_handler ("overideErrorHandling");
	}
	if( _SOBI2_MEMDEB ) {
		$memArr["Debug on: "] = memory_get_usage();
	}
		sobiPlugins();
	if( _SOBI2_MEMDEB ) {
		$memArr["Plugins in: "] = memory_get_usage();
	}
	$config->timeStart = $timeStart;
 	if(!empty($config->S2_plugins)) {
 		foreach ($config->S2_plugins as $plugin) {
 			if(method_exists($plugin,"onSobiAdmStart")) {
 				$plugin->onSobiAdmStart();
 			}
 		}
 	}

/*
 * check permission
 */
if(!$config->checkPerm()) {
	echo "<script type=\"text/javascript\">" .
	" alert('" . _SOBI2_NOT_AUTH . "');" .
	" history.back();" .
	"</script>";
	exit ();
}
/*
 * getting language file
 */
if (!file_exists(_SOBI_ADM_PATH.DS."languages".DS."admin.".$config->sobi2Language.'.php' )) {
	$config->sobi2Language = 'english';
}
require_once( _SOBI_ADM_PATH.DS.'languages'.DS.'admin.'.$config->sobi2Language.'.php' );
include_once( _SOBI_ADM_PATH.DS.'languages'.DS.'admin.default.php' );
$includesPath = _SOBI_ADM_PATH.DS."includes";
$sobi2AdminUrl = "index2.php?option=com_sobi2";
if( _SOBI2_MEMDEB ) {
	$memArr["Language in: "] = memory_get_usage();
}
$sobi2Backend = new ADM_HTML_SOBI();
if( _SOBI2_MEMDEB ) {
	$memArr["HTML Class in: "] = memory_get_usage();
}

$catId = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
$task = sobi2Config::request( $_REQUEST, 'task', '' );
if(!$task) {
	$task = sobi2Config::request( $_REQUEST, 'sobi2Task', '' );
}
if( _SOBI2_MEMDEB ) {
	$memArr["Parse now: "] = memory_get_usage();
}
if( $task != "getsyscheck" && file_exists( _SOBI_ADM_PATH.DS."syscheck_logfile.txt" ) ) {
	unlink( _SOBI_ADM_PATH.DS."syscheck_logfile.txt" );
}

if( isset( $task ) ) {
	switch( $task ) {

		case 'SigsiuTreeForm':
	 		sobiSigsiuTreeForm($catId);
	 		break;

	 	case 'SigsiuTreeAdmMenu':
	 		sobiSigsiuTreeAdmMenu($catId);
	 		break;

	 	case 'SigsiuTreeCats':
	 		sobiSigsiuTreeCats($catId);
	 		break;

		case 'listing':
			$catId = intval(sobi2Config::request($_REQUEST, 'catid', 0));
			$sobi2Backend->showHtml($catId);
			break;

		case 'edit':
			if( sobi2Config::request( $_REQUEST, 'sobi2Id', 0 ) ) {
				$sobi2Id = intval( sobi2Config::request( $_REQUEST, 'sobi2Id', 0 ) );
			}
			else if(sobi2Config::request( $_POST, 'sItem', array(0))) {
				$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
				$sobi2Id = intval($sItemID[0]);
			}
			if(sobi2Config::request( $_REQUEST, 'categoryId', 0 )) {
				$categoryId = intval(sobi2Config::request( $_REQUEST, 'categoryId', 0 ) );
			}
			else if(sobi2Config::request( $_POST, 'cid', array(0))) {
				$cid = sobi2Config::request( $_POST, 'cid', array(0));
				$categoryId = intval($cid[0]);
			}
			if($categoryId !=  0) {
				editCat($categoryId,$returnTask,$catId);
				$task = "edit category";
			}
			else if($sobi2Id != 0) {
				editItem($sobi2Id,$returnTask,$catId);
				$task = "edit listing";
			}
			break;

		case 'save':
		case 'apply':
			$scope = sobi2Config::request( $_REQUEST, 'editing', '' ) ;
			if( $scope == 'item' ) {
				$config->sobiCache->clearAll();
				saveSobi();
			}
			else if ( $scope == 'category' ) {
				$config->sobiCache->clearAll( true );
				saveCategory();
			}
			else if ($scope == 'field') {
				$config->sobiCache->clearAll();
				saveField( sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
			}
			break;

		case 'saveCats':
			saveCats();
			break;

		case 'saveConfig':
			saveConfig();
			$config->sobiCache->clearAll();
			break;

		case 'cancel':
			$scope = sobi2Config::request( $_REQUEST, 'editing', '' ) ;
			$sobi2Id = intval( sobi2Config::request( $_REQUEST, 'sobi2Id', 0 ) );
			$categoryId = intval( sobi2Config::request( $_REQUEST, 'categoryId', 0 ) );
			$fid = intval( sobi2Config::request( $_REQUEST, 'fieldId', 0 ) );

			if($scope == 'item' && $sobi2Id != 0){
		    	$statement = "UPDATE `#__sobi2_item` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `itemid` = {$sobi2Id}";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			else if($scope == 'category' && $categoryId != 0){
		    	$statement = "UPDATE `#__sobi2_categories` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `catid` = {$categoryId}";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			else if($scope == 'field' && $fid != 0){
		    	$statement = "UPDATE `#__sobi2_fields` SET `checked_out` = '0', `checked_out_time` = '0' WHERE `fieldid` = {$fid}";
				$database->setQuery($statement);
				$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
			}
			sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}&slang=".sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language) );
			break;

		case 'addItem':
			$config->getEditForm();
			sobi2Config::import("form.class");
			sobi2Config::import("admin.sobi2.class.html", "adm");
			$sobi2Form = new sobi2Form($returnTask, $catId);
			$sobi2Form->buildForm($returnTask,$catId);
			unset( $sobi2Form );
			break;

		case 'addCat':
				sobi2Config::import("category.class");
				sobi2Config::import("admin.category.class", "adm");
				$sobi2Cat = new adminSobiCategory();
				$sobi2Cat->showForm($returnTask,$catId);
				unset( $sobi2Cat );
			break;

		case 'addCats':
				$sobi2Backend->addCatsSerie( $catId );
			break;

		case 'addField':
				sobi2Config::import("field.class");
				sobi2Config::import("admin.field.class", "adm");
				$field = new field();
				$field->editForm(sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language));
				unset( $field );
			break;

		case 'move':
			$targetCat = sobi2Config::request( $_POST, 'targetCat', 0);
			if($targetCat != 0) {
				$cid = sobi2Config::request( $_POST, 'cid', array(0));
				$cidCount = intval($cid[0]);
				$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
				$sItemIDCount = intval($sItemID[0]);
				$config->sobiCache->clearAll( true );
				if($cidCount !=  0) {
					moveCategory($cid,$catId,$targetCat);
				}
				else if($sItemIDCount != 0) {
					moveItem($sItemID,$catId,$targetCat);
				}
			}
			else {
				$sobi2Backend->showHtml();
			}
			break;

		case 'copy':
			$targetCat = sobi2Config::request( $_POST, 'targetCat', 0);
			if($targetCat != 0) {
				$cid = sobi2Config::request( $_POST, 'cid', array(0));
				$cidCount = intval($cid[0]);
				$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
				$cpItems = sobi2Config::request( $_POST, 'cItems', array(0));
				$sItemIDCount = intval($sItemID[0]);
				$config->sobiCache->clearAll( true );
				if($cidCount !=  0) {
					copyCategory($cid,$catId,$targetCat,$cpItems);
				}
				else if($sItemIDCount != 0) {
					copyItem($sItemID,$catId,$targetCat);
				}
			}
			else {
				$sobi2Backend->showHtml();
			}
			break;

		case 'remove':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cidCount = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemIDCount = intval($sItemID[0]);
			$config->sobiCache->clearAll( true );
			if($cidCount !=  0) {
				removeCat($catId);
			}
			else if($sItemIDCount != 0) {
				removeItem($sItemID,$catId);
			}
			break;

		case 'delete':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cidCount = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemIDCount = intval($sItemID[0]);
			$config->sobiCache->clearAll( true );
			if($cidCount !=  0) {
				deleteCat($cid,$catId);
			}
			elseif($sItemIDCount != 0) {
				deleteItem( $sItemID );
			}
			break;

		case 'deleteField':
			$fids = sobi2Config::request( $_POST, 'sField', array(0));
			$config->sobiCache->clearAll();
			deleteField($fids);
			break;

		case 'unpublish':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cidCount = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemIDCount = intval($sItemID[0]);
			$config->sobiCache->clearAll( true );
			if($cidCount !=  0) {
				unpublishCat($cid,$catId);
			}
			else if($sItemIDCount != 0) {
				unpublisItem($sItemID,$catId);
			}
			break;

		case 'publish':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cidCount = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemIDCount = intval($sItemID[0]);
			$config->sobiCache->clearAll( true );
			if($cidCount !=  0) {
				publishCat($cid,$catId);
			}
			else if($sItemIDCount != 0) {
				publishItem($sItemID,$catId);
			}
			break;

		case 'approve':
			$config->sobiCache->clearAll( true );
			approveItem($catId);
			break;

		case 'unapprove':
			$config->sobiCache->clearAll( true );
			unApproveItem($catId);
			break;

		case 'saveorder':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cidCount = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemIDCount = intval($sItemID[0]);
			$config->sobiCache->clearAll();
			if($cidCount !=  0) {
				saveCatOrder($cid,$catId);
			}
			else if($sItemIDCount != 0) {
				saveItemsOrder($sItemID,$catId);
			}
			break;

		case 'savefieldsorder':
			$fieldsId = sobi2Config::request( $_POST, 'sField', array(0));
			$config->sobiCache->clearAll();
			saveFieldsOrder($fieldsId,$catId);
			break;

		case 'fieldup':
			$fid = sobi2Config::request( $_POST, 'sField', array(0));
			$fid = intval($fid[0]);
			$config->sobiCache->clearAll();
			fieldOrderUp($fid,$catId);
			break;

		case 'fielddown':
			$fid = sobi2Config::request( $_POST, 'sField', array(0));
			$fid = intval($fid[0]);
			$config->sobiCache->clearAll();
			fieldOrderDown($fid,$catId);
			break;

		case 'editField':
			if( sobi2Config::request( $_REQUEST, 'sField') && is_numeric(sobi2Config::request( $_REQUEST, 'sField'))) {
				$fid = intval( sobi2Config::request( $_REQUEST, 'sField', 0 ) );
			}
			else if(sobi2Config::request( $_POST, 'sField', array(0))) {
				$fid = sobi2Config::request( $_POST, 'sField', array(0));
				$fid = intval($fid[0]);
			}
			$config->sobiCache->clearAll();
			$lang = sobi2Config::request( $_REQUEST, 'slang');
			editField($fid, $lang);
			break;

		case 'orderup':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cid = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemID = intval($sItemID[0]);
			$config->sobiCache->clearAll();
			if( $cid != 0 ) {
				catOrderUp($cid,$catId);
			}
			else if( $sItemID != 0 ) {
				itemOrderUp($sItemID,$catId);
			}
			break;

		case 'orderdown':
			$cid = sobi2Config::request( $_POST, 'cid', array(0));
			$cid = intval($cid[0]);
			$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
			$sItemID = intval($sItemID[0]);
			$config->sobiCache->clearAll();
			if( $cid != 0 ) {
				catOrderDown($cid,$catId);
			}
			else if( $sItemID != 0 ) {
				itemOrderDown($sItemID,$catId);
			}
			break;

		case 'uninstall':
			$sobi2Backend->uninstallSOBI();
			break;

		case 'removeDB':
			removeSobi();
			break;

		case 'installLang':
			$config->sobiCache->clearAll();
			installLang();
			break;

		case 'installTpl':
			$config->sobiCache->clearAll();
			sobi2Config::import( 'includes|adm.installer.class', 'adm' );
			sobi2Installer::installTemplate();
			break;

		case 'emailsFooter':
			$config->getEditForm();
			$config->emailFooter();
			break;

		case 'emailOnSubmit':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnSubmit($lang);
			break;

		case 'emailOnUpdate':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnUpdate($lang);
			break;

		case 'emailOnRenew':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			sobi2Config::import("admin.config.class.html", "adm");
			adminConfig_HTML::emailOnRenew( $config, $lang );
			break;

		case 'emailOnApprove':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnApprove($lang);
			break;

		case 'emailOnPayment':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnPayment($lang);
			break;

		case 'emailOnSubmitAdmin':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnSubmitAdmin($lang);
			break;

		case 'emailOnUpdateAdmin':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnUpdateAdmin($lang);
			break;

		case 'emailOnRenewAdmin':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			sobi2Config::import("admin.config.class.html", "adm");
			adminConfig_HTML::emailOnRenewAdmin( $config, $lang );
			break;

		case 'emailOnPaymentAdmin':
			$lang = sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language);
			$config->getEmails($lang,false);
			$config->emailOnPaymentAdmin($lang);
			break;

		case 'saveMailFooter':
			$config->sobiCache->clearAll();
			$config->saveMailFooter();
			break;

		case 'saveMailOnSubmitUser':
			$config->sobiCache->clearAll();
			$config->saveUserEmailOnSubmit();
			break;

		case 'saveMailOnUpdateUser':
			$config->sobiCache->clearAll();
			$config->saveMailOnUpdateUser();
			break;

		case 'saveMailOnRenewUser':
			$config->sobiCache->clearAll();
			$config->saveMailOnRenewUser();
			break;

		case 'saveMailOnApprove':
			$config->sobiCache->clearAll();
			$config->saveMailOnApprove();
			break;

		case 'saveMailOnPayment':
			$config->sobiCache->clearAll();
			$config->saveMailOnPayment();
			break;

		case 'saveMailOnSubmitAdmin':
			$config->sobiCache->clearAll();
			$config->saveMailOnSubmitAdmin();
			break;

		case 'saveMailOnUpdateAdmin':
			$config->sobiCache->clearAll();
			$config->saveMailOnUpdatetAdmin();
			break;

		case 'saveMailOnRenewAdmin':
			$config->sobiCache->clearAll();
			$config->saveMailOnRenewAdmin();
			break;

		case 'saveMailOnPaymentAdmin':
			$config->sobiCache->clearAll();
			$config->saveMailOnPaymentAdmin();
			break;

		case 'savePluginConfig':
			$config->sobiCache->clearAll();
			savePluginConfig( sobi2Config::request( $_REQUEST, 'S2_plugin', null));
			break;

		case 'installPlugin':
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $sobi2AdminUrl."&task=pluginsManager", $config->installPlugin() );
			break;

		case 'removePlugin':
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $sobi2AdminUrl."&task=pluginsManager", $config->removePlugin( (int) sobi2Config::request( $_POST, 'plugin', 0 ), sobi2Config::request( $_POST, 'pluginstable', array() ) ) );
			break;

		case 'removeLang':
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $sobi2AdminUrl."&task=langMan", $config->removeLang(sobi2Config::request( $_POST, 'lang', null )));
			break;

		case 'removeTpl':
			$config->sobiCache->clearAll();
			sobi2Config::import( 'includes|adm.installer.class', 'adm' );
			sobi2Config::redirect( $sobi2AdminUrl."&task=templates", sobi2Installer::removeTpl( sobi2Config::request( $_POST, 'tpl', null ) ) );
			break;

		case 'disable':
		case 'enable':
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $sobi2AdminUrl."&task=pluginsManager", $config->P_enabling((int)sobi2Config::request( $_REQUEST, 'pid', 0 ), $task));
			break;

		case 'reorderPlugins':
			$config->sobiCache->clearAll();
			reorderPlugins((sobi2Config::request( $_REQUEST, 'pid', array(0))),(sobi2Config::request( $_REQUEST, 'pluginOrder', array(0))));
			break;

	 	case 'pluginMain':
	 		if(method_exists($config->S2_plugins[sobi2Config::request($_REQUEST, 'S_plugin', 0)],"Main")) {
	 			$config->S2_plugins[sobi2Config::request($_REQUEST, 'S_plugin', 0)]->Main();
	 		}
	 		break;

	 	case 'deletelogfile':
	 		deleteLogfile();
	 		break;

	 	case 'dosyscheck':
			sobi2Config::import("includes|adm.syscheck.class", "adm");
			sobi2Syscheck::syscheck();
	 		break;

	 	case 'getsyscheck':
			sobi2Config::import("includes|adm.syscheck.class", "adm");
			sobi2Syscheck::getLogfile();
	 		break;

	 	case 'ccount':
			sobi2Config::import("includes|adm.saver.class", "adm");
			sobi2Saver::recountCats();
	 		break;

	 	case 'setDefTpl':
			sobi2Config::import("includes|adm.saver.class", "adm");
			sobi2Saver::setDefTpl( $config );
	 		break;

	 	case 'getlogfile':
	 		getLogfile();
	 		break;

	 	case 'emptyCache':
	 		$config->sobiCache->clearAll();
	 		sobi2Config::redirect( $sobi2AdminUrl."&task=genConf",_SOBI2_CONFIG_CACHE_REMOVED);
	 		break;

	 	case 'emptyL3Cache':
	 		$config->sobiCache->emptyObjects();
	 		sobi2Config::redirect( $sobi2AdminUrl."&task=genConf",_SOBI2_CONFIG_CACHE_REMOVED);
	 		break;

		default:
	 		if($task && $task != '') {
		 		$pluginTask = false;
		 		if(!empty($config->S2_plugins)) {
		 			foreach ($config->S2_plugins as $plugin) {
		 				if(method_exists($plugin, "customTask")) {
		 					if($plugin->customTask($task)) {
		 						$pluginTask = true;
		 					}
		 				}
		 			}
		 		}
		 		if(!$pluginTask) {
		 			$sobi2Backend->showHtml();
		 		}
	 		}
			else {
				$sobi2Backend->showHtml();
			}
	}
}
else {
	$sobi2Backend->showHtml();
}
if( _SOBI2_MEMDEB ) {
	$memArr["Task parsed: "] = memory_get_usage();
}

unset( $sobi2Backend );
if( _SOBI2_MEMDEB ) {
	$memArr["HTML Class out: "] = memory_get_usage();
}
unset( $config );
if( _SOBI2_MEMDEB ) {
	$memArr["Config out: "] = memory_get_usage();
}
if( _SOBI2_MEMDEB ) {
	foreach ($memArr as $k => $v) {
		sobi2Config::debOut( "$k $v");
	}
}
restore_error_handler();
/*
 * editing category
 */
function editCat($cid,$returnTask,$catId=1)
{
	sobi2Config::import("category.class");
	sobi2Config::import("admin.category.class", "adm");
	$sobi2Cat = new adminSobiCategory($cid);
	$sobi2Cat->showForm($returnTask,$catId);
}
/*
 * editing item
 */
function editItem($sItemID,$returnTask,$catId=1)
{
	$config =& adminConfig::getInstance();
	$config->getEditForm();
	sobi2Config::import("form.class");
	sobi2Config::import("admin.sobi2.class.html", "adm");
	$sobi2Form = new sobi2Form($returnTask,$catId,$sItemID);
	$sobi2Form->buildForm($returnTask,$catId);
}
/*
 * editing field
 */
function editField($fid, $lang)
{
	sobi2Config::import("field.class");
	sobi2Config::import("admin.field.class", "adm");
	$field = new field($fid, $lang);
	$field->editForm($lang);
}
/*
 * saving new order for plugins
 */
function reorderPlugins($pids, $order)
{
	$sobi2AdminUrl = "index2.php?option=com_sobi2";
	$config	=& adminConfig::getInstance();
	$database = &$config->getDb();
	$forCount = 0;
	$order = array_combine($pids,$order);
	asort($order);
	foreach($order as $pid => $pos) {
		$forCount++;
		$statement = "UPDATE `#__sobi2_plugins` SET `position` = '{$forCount}' WHERE `id` = {$pid} LIMIT 1";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
	}
	$msg = _SOBI2_NEW_ORDERING_SAVED;
	$config->sobiCache->clearAll();
	sobi2Config::redirect( $sobi2AdminUrl."&task=pluginsManager", $msg );
}
/*
 * saving new order for categories
 */
function saveCatOrder( $cids,$catId )
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::saveOrder( $cids,$catId );
}
/*
 * saving new order for fields
 */
function saveFieldsOrder($fieldsId,$catId)
{
	sobi2Config::import("admin.sobi2.fields", "adm");
	fieldListingsFunctions::saveOrder( $fieldsId,$catId );
}
/*
 * saving new order for items
 */
function saveItemsOrder($sItemsID,$catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::saveOrder( $sItemsID,$catId );
}
function unpublishCat($cids,$catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::unpublish( $cids,$catId );
}
function publishCat($cids,$catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::publishCat( $cids,$catId );
}
function unpublisItem( $sItemsID,$catId )
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::unpublish( $sItemsID,$catId );
}
function publishItem($sItemsID,$catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::publish( $sItemsID,$catId );
}
function approveItem($catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::approve( $catId );
}
function unApproveItem($catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::unApprove( $catId );
}
function fieldOrderUp($fid,$catId)
{
	sobi2Config::import("admin.sobi2.fields", "adm");
	fieldListingsFunctions::orderUp( $fid,$catId );
}
function fieldOrderDown($fid,$catId)
{
	sobi2Config::import("admin.sobi2.fields", "adm");
	fieldListingsFunctions::orderDown( $fid,$catId );
}
function catOrderUp($cid,$catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::orderUp( $cid,$catId );
}
function catOrderDown($cid,$catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::orderDown( $cid,$catId );
}
function itemOrderUp($sItemID,$catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::orderUp( $sItemID,$catId );
}
function itemOrderDown($sItemID,$catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::orderDown( $sItemID,$catId );
}
function removeCat($catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::removeCat( $catId );
}
function removeItem($sItemsID,$catId)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::remove( $sItemsID,$catId );
}
function deleteCat($cids,$catId)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::delete( $cids,$catId );
}
function getChildCats($catid,&$childs)
{
	$config	=& adminConfig::getInstance();
	$database = &$config->getDb();
	$query = "SELECT `catid` FROM `#__sobi2_cats_relations` WHERE `parentid` = {$catid}";
	$database->setQuery($query);
	$childsArray = $database->loadResultArray();
	if ($database->getErrorNum()) {
		trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
	}
	if(!empty($childsArray)) {
		foreach ($childsArray as $cid) {
			$childs[] = $cid;
			getChildCats($cid,$childs);
		}
	}
}
function deleteField($fids)
{
	sobi2Config::import("admin.sobi2.fields", "adm");
	fieldListingsFunctions::delete( $fids );
}
function deleteItem( $sItemsID )
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::delete( $sItemsID );
}
function moveItem($sItemsID,$catId,$targetCat)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::move( $sItemsID, $catId, $targetCat );
}
function copyItem($sItemsID,$catId,$targetCat)
{
	sobi2Config::import("admin.sobi2.listings", "adm");
	listingsFunctions::copy( $sItemsID,$catId,$targetCat );
}

function moveCategory($cid,$catId,$targetCat)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::move( $cid,$catId,$targetCat );
}
function copyCategory($cid,$catId,$targetCat,$cpItems)
{
	sobi2Config::import("admin.sobi2.cats", "adm");
	catListingsFunctions::copy( $cid,$catId,$targetCat,$cpItems );
}
function saveSobi()
{
	sobi2Config::import("includes|adm.saver.class", "adm");
	sobi2Saver::saveSobi();
}
function saveCategory()
{
	sobi2Config::import("includes|adm.saver.class", "adm");
	sobi2Saver::saveCategory();
}
function saveCats()
{
	sobi2Config::import("includes|adm.saver.class", "adm");
	sobi2Saver::saveCats();
}
function saveField($lang)
{
	sobi2Config::import("includes|adm.saver.class", "adm");
	sobi2Saver::saveField( $lang );
}
function saveConfig()
{
	sobi2Config::import("includes|adm.saver.class", "adm");
	sobi2Saver::saveConfig();
}
function removeSobi()
{
	sobi2Config::import("includes|adm.installer.class", "adm");
	sobi2Installer::removeSobi();
}
/*
 * installing new language package
 */
function installLang()
{
	sobi2Config::import("includes|adm.helper.class", "adm");
	sobi2AdmHelper::installLang();
}
function sobiPlugins()
{
	$config =& adminConfig::getInstance();
	$database = &$config->getDb();
	$query = "SELECT `init_file`, `name_id` FROM `#__sobi2_plugins` WHERE `enabled` = 1 ORDER BY `position` ASC";
	$database->setQuery( $query );
	$plugins = $database->loadObjectList();
	if ($database->getErrorNum()) {
		trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
	}
	if( count($plugins) ) {
		foreach($plugins as $plugin) {
			if( $plugin->init_file && file_exists( _SOBI_ADM_PATH.DS."plugins".DS.$plugin->name_id.DS."admin.".$plugin->init_file ) ) {
				include_once( _SOBI_ADM_PATH.DS."plugins".DS.$plugin->name_id.DS."admin.".$plugin->init_file );
			}
			elseif( $plugin->init_file && file_exists( _SOBI_FE_PATH.DS."plugins".DS.$plugin->name_id.DS.$plugin->init_file ) ) {
    			include_once( _SOBI_FE_PATH.DS."plugins".DS.$plugin->name_id.DS.$plugin->init_file );
    		}
		}
	}
//	$config->sobiCache->clearAll();
}
function savePluginConfig($pluginName)
{
	$config =& adminConfig::getInstance();
	if(!$pluginName) {
		$href = "index2.php?option=com_sobi2&task=plugins";
	}
	else {
		$href = "index2.php?option=com_sobi2&task=plugins&S2_plugin={$pluginName}";
		$plugin = $config->S2_plugins[$pluginName];
		if(method_exists($plugin, "saveConfig"))
			$msg = $plugin->saveConfig();
	}
	$config->sobiCache->clearAll();
	sobi2Config::redirect($href,$msg);
}
function deleteLogfile()
{
	sobi2Config::import("includes|adm.helper.class", "adm");
	sobi2AdmHelper::deleteLogfile();
}
function getLogfile()
{
	sobi2Config::import("includes|adm.helper.class", "adm");
	sobi2AdmHelper::getLogfile();
}
function sobiSigsiuTreeAdmMenu($cid)
{
	$config	=& adminConfig::getInstance();
	sobi2Config::import("includes|SigsiuTree|SigsiuTree");
	$href = "{$config->liveSite}/administrator/index2.php?option=com_sobi2&amp;task=listing&amp;catid={cid}";
	$tree = new SigsiuTree();
	$tree->addNodes($cid, $href, "div", false);
}
function sobiSigsiuTreeCats($cid)
{
	sobi2Config::import("includes|SigsiuTree|SigsiuTree");
	$href = "javascript:onSelectedCat('{cid}')";
	$tree = new SigsiuTree();
	$tree->addNodes($cid, $href, "div", false);
}
function sobiSigsiuTreeForm($catid)
{
	$config =& adminConfig::getInstance();
	sobi2Config::import("includes|SigsiuTree|SigsiuTree");
	$href = "javascript:onSelectedCat('{introtext}','{name}','{cid}')";
	if(!$config->allowAddingToParentCats) {
		$spHref = "javascript:onSelectedCat('{introtext}','{name}','-1' )";
	}
	else {
		$spHref = null;
	}
	$tree = new SigsiuTree();
	$tree->addNodes($catid, $href, "div", false, $spHref);
}
?>