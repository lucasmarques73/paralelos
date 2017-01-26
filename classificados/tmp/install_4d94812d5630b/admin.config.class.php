<?php
/**
* @version $Id: admin.config.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || defined( '_VALID_MOS' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

/*
 * ensure user has access to this function
 */

class adminConfig extends sobi2Config {
	var $forceCustomHead = true;
	/**
	 * @var bool
	 */
	var $useRico 		= true;
	/**
	 * @var array
	 */
	var $catChilds 		= array();
	/**
	 * @var string
	 */
	var $componentDesc 	= null;
	/**
	 * @var array
	 */
	var $langList		= array();
	/**
	 * @var string
	 */
	var $remoteAddrVCh	= "http://www.sigsiu.net/sobi2/sobi_version_checker.php";
	/**
	 * @var string
	 */
	var $S2_pluginsAdmPath = null;
	/**
	 * @var bool
	 */
	var $recount 		= true;

    /**
     * constructor
     *
     * @return adminConfig
     */
    function adminConfig()
    {
    	parent::sobi2Config();
    	$this->S2_pluginsAdmPath = "{$this->absolutePath}".DS."administrator".DS."components".DS."com_sobi2".DS."plugins";
    	if(!file_exists("{$this->absolutePath}".DS."administrator".DS."components".DS."com_sobi2".DS."images".DS."sobi2_logo150.jpg")) {
    		die("error 2809-L");
    	}
    	$this->recount = $this->getValueFromDB( "cache", "recount" );
    }
	/**
	 * singleton
	 *
	 * @return sobi2Config
	 */
	function & getInstance()
	{
		if( isset( $GLOBALS['sobi2_config_construct_cs'] ) && $GLOBALS['sobi2_config_construct_cs'] == true) {
			sobi2Config::debOut("Critical Error: calling \"getInstance\" method from the config constructor.");
			sobi2Config::debOut("Please notify <a href=\"http://www.sigsiu.net/forum/index.php/board,21.0.html\">SOBI2 Development Team</a>");
			ob_start();
			if( function_exists( "debug_print_backtrace" ) ) {
				debug_print_backtrace();
			}
			else {
				print_r( debug_backtrace() );
			}
			$bugtrace = ob_get_contents();
			ob_end_clean();
			$bugtrace = str_replace( "\n", "<br/>", $bugtrace );
			$bugtrace = str_replace( _SOBI_CMSROOT, null, $bugtrace );
			sobi2Config::debOut( 'Debug Output: <br/><span style="color: red;">'.$bugtrace.'<span>' );
			exit();
		}
		static $config;
		if( !is_a( $config, "adminConfig" ) ) {
			$config = new adminConfig();
		}
		return $config;
	}
    /**
     * saving confing keys in DB
     * @param string $configValue
     * @param string $configKey
     * @param string $section
     */
    function setValueInDB( $configValue, $configKey, $section=null )
    {
    	$database =& $this->getDb();
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		if(!$section) {
	    	$statement = "UPDATE `#__sobi2_config` " .
	    			 "SET `configValue` = '{$configValue}' " .
	    			 "WHERE (`configKey` = '{$configKey}')";
		}
		else {
	    	$statement = "UPDATE `#__sobi2_config` " .
	    			 "SET `configValue` = '{$configValue}' " .
	    			 "WHERE (`configKey` = '{$configKey}' AND `sobi2Section` = '{$section}')";
		}
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			$err = $database->stderr( true );
			trigger_error("adminConfig::setValueInDB():Cannot set value '{$configValue}' for the '{$configKey}' key in section {$section}. {$err}");
		}
		if(!$this->remoteAddrVCh || empty($this->remoteAddrVCh)) {
			die("error 2809-A");
		}
    }
    /**
     * setting in DB language depended values
     */
    function setLangValue( $option = "langValue",$key, $value, $lang = null )
    {
    	$database =& $this->getDb();
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
    	if( !$lang ) {
    		$lang = $this->sobi2Language;
    	}
    	$query = "SELECT COUNT(*) FROM `#__sobi2_language` WHERE (`sobi2Lang` = '{$lang}' AND `langKey` = '{$key}')";
		$database->setQuery( $query );
		$update = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	if( $update ) {
	    	$statement = "UPDATE `#__sobi2_language` " .
			 "SET `{$option}` = '{$value}' " .
			 "WHERE (`sobi2Lang` = '{$lang}' AND `langKey` = '{$key}')";
    	}
	    else {
	    	$statement = "INSERT INTO `#__sobi2_language` " .
			 "( `langKey` , `{$option}`  , `sobi2Lang` )" .
			 "VALUES ( '{$key}', '{$value}', '{$lang}' ); ";
	    }
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    }
    /**
     * registering using of xml rpc
     *
     */
    function registerXMLRPC()
    {
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		define( '_SOBI2_XMLRPC', 1);
		sobi2Config::import("includes|lib|sobi_xmlrpc_", "adm");
    }
    /**
     * giving actual SOBI2 version
     */
    function getVersion()
    {
		sobi2Config::import("includes|adm.helper.class", "adm");
    	return sobi2AdmHelper::getVersion();
    }
    /**
     *
     *
     */
    function saveMailOnPaymentAdmin()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnPaymentAdmin( $this );
    }
    /**
     *
     *
     */
    function saveMailOnUpdatetAdmin()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnUpdatetAdmin( $this );
    }
    /**
     */
    function saveMailOnRenewAdmin()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnRenewAdmin( $this );
    }
    /**
     *
     *
     */
    function saveMailOnSubmitAdmin()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnSubmitAdmin( $this );
    }
    /**
     *
     *
     */
    function saveMailOnPayment()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnPayment( $this );
    }
    /**
     *
     *
     */
    function saveMailOnApprove()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnApprove( $this );
    }
    /**
     */
    function saveMailOnUpdateUser()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnUpdateUser( $this );
    }
    /**
     */
    function saveMailOnRenewUser()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailOnRenewUser( $this );
    }
    /**
     *
     *
     */
    function saveUserEmailOnSubmit()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveUserEmailOnSubmit( $this );
    }
    /**
     */
    function saveMailFooter()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::saveMailFooter( $this );
    }
    /**
     */
    function savePby()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::savePby( $this );
    }
    /**
     *
     *
     */
    function setGenConf()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		sobi2Saver::setGenConf( $this );
	}
    /**
     *
     *
     * @return string
     */
    function setEfConf()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		return sobi2Saver::setEfConf( $this );
    }
    /**
     *
     *
     */
    function setViewConf()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		return sobi2Saver::setViewConf( $this );
    }
    /**
     *
     *
     */
    function setPaymentConf()
    {
		sobi2Config::import("includes|adm.saver.class", "adm");
		return sobi2Saver::setPaymentConf( $this );
    }
    /**
     *
     *
     */
    function saveCSS()
    {
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::saveCSS();
    }
    /**
     * @param bool $vc
     */
    function saveTemplate( $which = null )
    {
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::saveTemplate( $which );
    }
    /**
     * language package installer
     *
     * @return string
     */
    function installLang()
    {
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::installLang();
    }
    /**
     * new plugin package installer
     *
     * @return string
     */
    function installPlugin()
    {
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::installPlugin();
    }
	/**
	 *
	 * @param stdClass $row
	 * @return string
	 */
	function P_EnabledProcessing( $row )
	{
		$up = "{$this->liveSite}/administrator/index2.php?option=com_sobi2&task=disable&pid={$row->id}";
		$pu = "{$this->liveSite}/administrator/index2.php?option=com_sobi2&task=enable&pid={$row->id}";
		$action = $row->enabled ? adminConfig::fixLink( $up ) : adminConfig::fixLink( $pu );
		$img 	= $row->enabled ? 'tick.png' : 'publish_x.png';
		$href  = "<a href=\"#\"  onclick=\"return window.location.href = '{$action}' \"><img src=\"images/{$img}\" style=\"border: none; \"/></a>";
		return $href;
	}
	/**
	 * @param int $pid
	 * @param strin $action
	 * @return string
	 */
	function P_enabling( $pid, $action )
	{
		$database =& $this->getDb();
		if(!$pid)
			return "Undefinied errror: missing pid";
		switch($action) {
			case 'disable':
				$set = '0';
				$msg = _SOBI2_PLUGIN_DISABLED;
				break;
			case 'enable':
				$set = '1';
				$msg = _SOBI2_PLUGIN_ENABLED;
				break;
		}
		$statement = "UPDATE `#__sobi2_plugins` SET `enabled` = '{$set}' WHERE `id` = '{$pid}' ";
		$database->setQuery($statement);
		$database->query();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$this->sobiCache->clearAll();
		return $msg;
	}
	/**
	 * Enter description here...
	 *
	 * @param string $lang
	 * @return string
	 */
	function removeLang( $lang )
	{
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::removeLang( $lang );
	}
    /**
     * @param int $pid
     * @return string
     */
    function removePlugin( $pid = 0, $pTables = null )
    {
		sobi2Config::import("includes|adm.installer.class", "adm");
		return sobi2Installer::removePlugin( $pid, $pTables );
    }
    /**
     * @return stdClass
     */
    function getPlugins()
    {
    	$database =& $this->getDb();
		$query = "SELECT * FROM `#__sobi2_plugins` ORDER BY `position` ASC ";
		$database->setQuery( $query );
		$plugins = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $plugins;
    }
    /**
     * @return stdClass
     */
    function getPluginsTables()
    {
    	$database =& $this->getDb();
		$query = "SHOW TABLE STATUS LIKE '%_sobi2_plugin\_%'";
		$database->setQuery( $query );
		$pluginsTables = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $pluginsTables;
    }
    /**
     * @param string $tablename
     * @return stdClass
     */
    function getTablePlugin( $tablename )
    {
    	$database =& $this->getDb();
		$tablename = str_replace( $database->_table_prefix."sobi2_plugin_", null, $tablename );
		$end = strpos( $tablename, "_" );

		if( $end ) {
			$tablename = substr( $tablename, 0, $end );
		}
		$query = "SELECT name FROM #__sobi2_plugins WHERE name_id LIKE '%{$tablename}%'";
		$database->setQuery( $query );
		$plugin = $database->loadResult();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $plugin;
    }
	/**
	 * giving list of all available languages based on existing files
	 *
	 */
	function getLangList( $box = true )
	{
		sobi2Config::import("includes|adm.helper.class", "adm");
		return sobi2AdmHelper::getLangList( $this, $box );
	}
	/**
	 * giving the sobi description. Sobi "is" the first category
	 */
	function getComponentDescription()
	{
		sobi2Config::import("category.class");
		$sobi2Desc = new sobi2Category(1);
		$this->componentDesc = $sobi2Desc;
	}
	/**
	 * returning select box with possible entries ordering
	 *
	 * @return sobiHTML
	 */
	function getListingOrdering()
	{
		sobi2Config::import("includes|adm.helper.class", "adm");
		return sobi2AdmHelper::getListingOrdering( $this );
	}
	/**
	 * returning select box with possible categories ordering
	 *
	 * @return sobiHTML
	 */
	function getCatsOrdering( $boxName = 'catsOrdering' )
	{
		sobi2Config::import("includes|adm.helper.class", "adm");
		return sobi2AdmHelper::getCatsOrdering( $this, $boxName );
	}
	/**
	 *
	 *
	 */
	function showGeneral()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		$this->getComponentDescription();
		$this->getLangList();
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::showGeneral( $this );
	}
	/**
	 *
	 */
	function editFormConf()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::editFormConf( $this );
	}
	/**
	 */
	function getViewConf()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::getViewConf( $this );
	}
	/**
	 */
	function getPaymentsConf()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::getPaymentsConf( $this );
	}
	/**
	 */
	function editCSS()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::editCSS( $this );
	}
	/**
	 *
	 */
	function editTemplate()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::editTemplate( $this );
	}
	/**
	 *
	 */
	function editVCTemplate()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::editVCTemplate( $this );
	}
	/**
	 *
	 */
	function editFormTemplate()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::editFormTemplate( $this );
	}
	/**
	 */
	function languageManager()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::languageManager( $this );
	}
	function emailsConfig()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailsConfig( $this );
	}
	/**
	 *
	 */
	function emailFooter()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailFooter( $this );
	}
	/*
	 * loading html code with email on submit for user
	 */
	function emailOnSubmit( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnSubmit( $this, $lang );
	}
	function emailOnUpdate( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnUpdate( $this, $lang );
	}
	/**
	 * @param string $lang
	 */
	function emailOnApprove( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnApprove( $this, $lang );
	}
	/**
	 * @param string $lang
	 */
	function emailOnPayment( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnPayment( $this, $lang );
	}
	function emailOnSubmitAdmin( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnSubmitAdmin( $this, $lang );
	}
	function emailOnUpdateAdmin( $lang ) {
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnUpdateAdmin( $this, $lang );
	}
	function emailOnPaymentAdmin( $lang )
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::emailOnPaymentAdmin( $this, $lang );
	}
	/**
	 * version checker
	 */
	function checkVersion()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::checkVersion( $this );
	}
	/**
	 */
	function pluginManager()
	{
		if(!$this->checkPerm()) {
			$this->noPerms();
		}
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::pluginManager( $this );
    }
	function errorLog( $err, $errors, $countErr, $force, $size )
	{
		sobi2Config::import("admin.config.class.html", "adm");
		adminConfig_HTML::errorLog( $this, $err, $errors, $countErr, $force, $size );
	}
	function noPerms()
	{
		echo "<script type=\"text/javascript\">" .
		" alert('" . _SOBI2_NOT_AUTH . "');" .
		" history.back();" .
		"</script>";
		exit ();
	}
	function fixLink( $str )
	{
		if( strstr( "&amp;", $str ) ) {
			return $str;
		}
		else {
			return str_replace( "&", "&amp;", $str );
		}
	}
}
?>