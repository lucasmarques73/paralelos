<?php
/**
* @version $Id: adm.syscheck.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
 * no direct access
 */
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class sobi2Syscheck {
	function syscheck()
	{
		$config 	=& adminConfig::getInstance();
		$database 	=& $config->getDb();
		$logfile 	=& sobi2Syscheck::openFile();
		fwrite($logfile, "\nSobi2 Version: ".$config->getVersion()." ".$config->configValues['version'] );
		if( file_exists( sobi2Config::translatePath("languages|syscheck.{$config->sobi2Language}", "adm"))) {
			sobi2Config::import("languages|syscheck.{$config->sobi2Language}", "adm");
		}
		sobi2Config::import("languages|syscheck.default", "adm");
		$msg = sobi2Config::request( $_REQUEST, "mosmsg", null);
		$msg = $msg ? "<div style=\"background-color: #990000; clear:both; color:#cccccc;\">{$msg}</div>" : null;
		echo $msg;
		?>
		<link rel='stylesheet' href='/administrator/components/com_sobi2/includes/admin.sobi2.css' type='text/css'/>
		<style type="text/css">
		td
		{
			font-size: 11px;
			font-family: Verdana,Helvetica,Arial;
		}
		</style>
		<table class="SobiAdminForm" width="100%">
			  <colgroup>
			    <col width="25%" align="center">
			    <col width="20%" align="center">
			    <col width="20%" align="center">
			    <col width="40%" align="center">
			  </colgroup>
			<tr>
				<th><?php echo _SOBI2SC_HEADER_SUBJECT; ?></th>
				<th width="20%"><?php echo _SOBI2SC_HEADER_STATE; ?></th>
				<th width="20%"><?php echo _SOBI2SC_HEADER_STATE_OK; ?></th>
				<td width="40%" align="center">
				<div align="center">
				<a href="index3.php?option=com_sobi2&task=getsyscheck&no_html"><img src="components/com_sobi2/images/toolbar/upload.png" border="0"/></a>
				<a href="index3.php?option=com_sobi2&task=getsyscheck&no_html"><?php echo _SOBI2SC_GET_FILE; ?> </a>
				</div>
				</td>
			</tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkServer( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkOS( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkPhpVer( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkDBVer( $logfile, $database ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkPHPMem( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkPHPTime( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkPHPSafeMode( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkPHPRG( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkCMSRG( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkGD( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkIconv( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkEncoding( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkDBEncoding( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkCMS( $logfile ); ?><td>&nbsp;</td></tr>
			<tr class="row0" align="center">
				<?php
					if( strstr( ___CMS___, "Joomla") && ___CMS___ != "Joomla 1.5" ) {
						sobi2Syscheck::checkAdmTpl( $logfile );
					}
				?>
			</tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkTemplate( $logfile ); ?></tr>
			<tr class="row0" align="center"><th colspan="4"> <?php echo _SOBI2SC_FILES_PERMS; ?></th></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilesPerms( $logfile ); ?></tr>
		</table>
		<?php
		$conf = $config;
		unset( $conf->acl );
		unset( $conf->bankData );
		unset( $conf->cacheDir );
		unset( $conf->catChilds );
		unset( $conf->componentDesc );
		unset( $conf->database );
		unset( $conf->DBhost );
		unset( $conf->DBname );
		unset( $conf->DBpassword );
		unset( $conf->DBprefix );
		unset( $conf->DBuser );
		$conf->googleMapsApiKey = $conf->googleMapsApiKey ? "present" : "absent";
		unset( $conf->langList );
		unset( $conf->mainframe );
		unset( $conf->mailfrom );
		unset( $conf->params );
		unset( $conf->payPalMail );
		unset( $conf->S2_plugins );
		unset( $conf->S2_pluginsAdmPath );
		unset( $conf->S2_pluginsPath );
    	unset( $conf->AdmEmailOnSubmitText );
    	unset( $conf->AdmEmailOnSubmitTitle );
    	unset( $conf->AdmEmailOnUpdateText );
    	unset( $conf->AdmEmailOnUpdateTitle );
    	unset( $conf->AdmEmailPaymentsText );
    	unset( $conf->AdmEmailPaymentsTitle );
    	unset( $conf->UserEmailOnRenewTitle );
    	unset( $conf->UserEmailOnRenewText );
    	unset( $conf->AdmEmailOnRenewTitle );
    	unset( $conf->AdmEmailOnRenewText );
    	unset( $conf->UserEmailOnApproveText );
    	unset( $conf->UserEmailOnApproveTitle );
    	unset( $conf->UserEmailOnSubmitText );
    	unset( $conf->UserEmailOnSubmitTitle );
    	unset( $conf->UserEmailOnUpdateText );
    	unset( $conf->UserEmailOnUpdateTitle );
    	unset( $conf->UserEmailPaymentsText );
    	unset( $conf->UserEmailPaymentsTitle );
		unset( $conf->mailFooter );
		unset( $conf->configValues );
		unset( $conf->sobiCache );
		unset( $conf->user );
		unset( $conf->templates );
		unset( $conf->secret );
		unset( $conf->absolutePath );
		unset( $conf->storeHouse );
		unset( $conf->frontend );
		unset( $conf->header );
		unset( $conf->checkReferer );
		unset( $conf->needToConfirmNew );
		ob_start();
		$conf = get_object_vars( $conf );
		print_r( $conf );
		$conf = ob_get_contents();
		ob_end_clean();
		fwrite( $logfile , "\n==========================\nSOBI2 Config: {$conf} \n==========================\n" );
	}
	function checkAdmTpl( &$logfile )
	{
 		$config =& sobi2Config::getInstance();
		$mainframe =& $config->getMainframe();
		fwrite($logfile, "\nAdmin Template is: ".$mainframe->getTemplate() );
		?>
			<td><?php echo _SOBI2SC_AT_IS;?></td><td><strong><?php echo $mainframe->getTemplate(); ?></strong></td>
		<?php
		$ft = _SOBI_CMSROOT.DS."administrator".DS."templates".DS.$mainframe->getTemplate().DS."index.php";
		$content = file_get_contents( $ft );
		if( !strstr( $content, 'foreach ($mainframe->_head[\'custom\'] as $html) {' ) ) {
			fwrite($logfile, "\nAdmin Template missing custom head tag: ".$mainframe->getTemplate() );
			?>
			<td colspan="2">
				<span style="color: rgb(255, 0, 0); font-weight: bold;"><strong> <?php echo _SOBI2SC_WARNING; ?> </strong></span> <?php echo _SOBI2SC_CHAT_IS;?>
			</td>
			<?php
		}
		else {
			echo "<td>"._SOBI2SC_STATE_2."</td>";
			echo "<td></td>";
		}
	}
	function checkTemplate( &$logfile )
	{
 		$config =& sobi2Config::getInstance();
 		$database =& $config->getDb();
		$database->setQuery("SELECT  template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0 ");
		$tpl = $database->loadResult();
		$ft = _SOBI_CMSROOT.DS."templates".DS.$tpl.DS."index.php";
		$content = file_get_contents( $ft );
		$scripts = array();
		if( strstr( $content, 'mootools' ) ) {
			$scripts[] = "mootools";
		}
		if( strstr( $content, 'moo.fx' ) ) {
			$scripts[] = "moo.fx";
		}
		if( strstr( $content, 'prototype.js' ) ) {
			$scripts[] = "prototype";
		}
		if( strstr( $content, 'litebox.js' ) ) {
			$scripts[] = "litebox";
		}
		if( strstr( $content, 'window.addEvent(' ) ) {
			$scripts[] = "addEvent";
		}
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_TEMPLATE_CHECK;
		echo "\n\t</td>";
		echo "\n\t<td><strong>{$tpl}</strong>\n\t</td>";

		if( !empty( $scripts ) ) {
			$scripts = implode(" | ", $scripts );
			echo "\n\t<td colspan='2'>";
			echo '<span style="color: rgb(255, 0, 0); font-weight: bold;"><strong>';
			echo _SOBI2SC_WARNING;
			echo '&nbsp;</strong></span>';
			echo _SOBI2SC_JS_CONF.": &nbsp;".$scripts;
			echo "\n\t</td>";
			fwrite($logfile, "\nDefault template can contains several confilcting scripts. {$scripts}" );
		}
		else {
			$state = _SOBI2SC_STATE_2;
			echo "\n\t<td colspan='2'>{$state}\n\t</td>";
			fwrite($logfile, "\nDefault template seems to be ok" );
		}
	}

	function checkDBEncoding( &$logfile )
	{
 		$config =& sobi2Config::getInstance();
 		$database =& $config->getDb();
		$database->setQuery("SELECT collation( '#__sobi2_item' )");
		$coll = $database->loadResult();
		if( strstr( strtolower( $coll ), "utf") ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( strstr( strtolower( $coll ), "latin") ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		$v = $coll;
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_DBCOL_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
		fwrite($logfile, "\nDB Collation is: ".$v );
	}

	function checkEncoding( &$logfile )
	{
		if( strstr( strtolower(_ISO), "utf") ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( strstr( strtolower(_ISO), "8859") ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_5;
		}
		$v = explode( "=", _ISO );
		$v = $v[1];
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_CHARSET_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
		fwrite($logfile, "\nCharset is: ".$v );
	}

	function checkIconv( &$logfile )
	{
		$v = function_exists( "iconv" ) ||  function_exists( "mb_language" ) ? true : false;
		$state = _SOBI2SC_STATE_0;
		if( $v ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		$v = $v ? "installed" : "not installed";
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_IM_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";

		$v = function_exists( "iconv" ) ? true : false;
		$v = $v ? "installed" : "not installed";
		fwrite($logfile, "\nIconv Library: {$v}" );

		$v = function_exists( "mb_language" ) ? true : false;
		$v = $v ? "installed" : "not installed";
		fwrite($logfile, "\nMbstring Library: {$v}" );

	}
	function checkGD( &$logfile )
	{
		$v = function_exists( "imagecreatefromgd" ) ? true : false;
		$state = _SOBI2SC_STATE_0;
		if( $v ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		$v = $v ? "installed" : "not installed";
		fwrite($logfile, "\nGD Library: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_GD_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}

	function checkCMSRG( &$logfile )
	{
		$v = defined( "RG_EMULATION" ) ? RG_EMULATION : false;
		$state = _SOBI2SC_STATE_0;
		if( !$v ) {
			$state = _SOBI2SC_STATE_1;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		$v = $v ? "enabled" : "disabled";
		fwrite($logfile, "\nCMS Register Globals: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_ERG_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}

	function checkPHPRG( &$logfile )
	{
		$v = ini_get("register_globals");
		$state = _SOBI2SC_STATE_0;
		if( !$v || strtolower( $v ) == "off" ) {
			$state = _SOBI2SC_STATE_1;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		$v = !(( !$v || strtolower( $v ) == "off" )) ? "enabled" : "disabled";
		fwrite($logfile, "\nPHP Register Globals: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_RG_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}

	function checkCMS( &$logfile )
	{
		if( defined( "_JEXEC" ) && class_exists( 'JFactory' ) ) {
			$v = "Joomla 1.5";
			$state = _SOBI2SC_STATE_2;
		}
		elseif( defined( "_SOBI_MAMBO" ) ) {
			global $_VERSION;
			$b = $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL;
			$v = "Mambo {$b}";
			if( $b >= 4.6 ) {
				$state = _SOBI2SC_STATE_2;
			}
			else {
				$state = _SOBI2SC_STATE_5;
			}
		}
		elseif( file_exists( _SOBI_CMSROOT.DS."includes".DS."joomla.php" ) ) {
			global $_VERSION;
			$b = $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL;
			$v = "Joomla {$b}";
			if( $_VERSION->DEV_LEVEL >= 12 ) {
				$state = _SOBI2SC_STATE_2;
			}
			else {
				$state = _SOBI2SC_STATE_4;
			}
		}
		else {
			$v = _SOBI2SC_STATE_0;
			$state = _SOBI2SC_STATE_5;
		}
		define( "___CMS___", $v );
		fwrite($logfile, "\nCMS is: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_CMS_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";

	}
	function checkFilesPerms( &$logfile )
	{
		$config =& adminConfig::getInstance();
		$plugins = sobi2Config::translateDirPath("plugins");
		$admplugins = sobi2Config::translateDirPath("plugins", "adm");
		$images = sobi2Config::translateDirPath( $config->imagesFolder, "root" );
		$catimages = sobi2Config::translateDirPath( $config->catImagesFolder, "root" );
		$installs = sobi2Config::translateDirPath("includes|install", "adm");
		$comadm = sobi2Config::translateDirPath("", "adm");
		$com = sobi2Config::translateDirPath("");
		$media = sobi2Config::translateDirPath( "media", "root" );
		$templates = sobi2Config::translateDirPath("templates");
		$registry = sobi2Config::translatePath("includes|inc|config", "front", true , ".ini");
		echo "\n\t<td colspan='4'>";
		?>
		<table class="SobiAdminForm" width="100%">
			<tr>
				<th><?php echo _SOBI2SC_FILENAME; ?></th>
				<th><?php echo _SOBI2SC_FILE_W; ?></th>
				<th><?php echo _SOBI2SC_FILE_O; ?></th>
				<th><?php echo _SOBI2SC_FILE_G; ?></th>
				<th><?php echo _SOBI2SC_HEADER_STATE_OK; ?></th>
				<th>&nbsp;</th>
			</tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $com ); ?></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $plugins ); ?></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $images ); ?></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $catimages ); ?></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $installs ); ?></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $comadm ); ?></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $admplugins ); ?></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $templates ); ?></tr>
			<tr class="row0" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $media ); ?></tr>
			<tr class="row1" align="center"><?php sobi2Syscheck::checkFilePerms( $logfile, $registry ); ?></tr>
		</table>
		<?php
		echo "\n\t</td>";
	}
	function checkFilePerms( &$logfile, $file )
	{
		static $c = false;
		static $downer = null;
		static $downerName = "undef.";
		static $dgroup = null;
		static $dgroupName = "undef.";
		if( !$c ) {
			$c = true;
			$exampleFile = sobi2Config::translatePath("syscheck_logfile", "adm", true, ".txt");
			$downer = fileowner( $exampleFile );
			$dgroup = filegroup( $exampleFile );
			if( function_exists( "posix_getpwuid" ) ) {
				$dstat = posix_getpwuid( $downer );
				$downerName = $dstat["name"];
				$dstat = posix_getgrgid( $dgroup );
				$dgroupName = $dstat["name"];
			}
			fwrite($logfile, "\n\n File Permissions \n ####################### \n" );
			fwrite($logfile, "\n Default Apache user is {$downer} ({$downerName}) \n Default Apache group is {$dgroup} ({$dgroupName}) \n\n" );
		}
		$sfile = str_replace( _SOBI_CMSROOT, "...", $file );
		$sfile = str_replace( array( "\\\\", "//"), DS, $sfile );
		if( !file_exists( $file ) ) {
			fwrite($logfile, "\n\t Critical error: {$sfile} does not exsits\n." );
			?>
			<td></td>
			<td colspan="4" align="right"> <span style="color: rgb(255, 0, 0); font-weight: bold;">Critical error: File/Directory <?php echo $sfile; ?> does not exist</span></td>
			<?php
			return ;
		}
		$fowner = fileowner( $file );
		$group = filegroup( $file );
		$fmode = substr( sprintf('%o', fileperms( $file ) ), -4 );

		if( function_exists( "posix_getpwuid" ) ) {
			$stat = posix_getpwuid( $fowner );
			$ownerName = "({$stat["name"]})";
			$stat = posix_getgrgid( $group );
			$groupName = "({$stat["name"]})";
		}
		else {
			$ownerName = $groupName = "undef.";
		}

		$st = is_writable( $file ) ? "writable" : "not writable";
		fwrite($logfile, "\n\t {$sfile} \n\t\t{$st}. \n\t\t Owner: {$fowner}{$ownerName}. \n\t\t Group is {$group} {$groupName}\n" );
		$status = null;
		if( $fowner && ( $fowner == $downer) ) {
			$status = _SOBI2SC_STATE_1;
		}
		elseif( $fmode == 777 ) {
			$status = _SOBI2SC_STATE_6;
		}
		elseif( $group == $dgroup && is_writable( $file ) ) {
			$status = _SOBI2SC_STATE_2;
		}
		elseif( is_writable( $file ) ) {
			$status = _SOBI2SC_STATE_3;
		}
		else {
			$status = _SOBI2SC_STATE_5;
		}
		?>
		<td> <?php echo $sfile; ?> </td>
		<td> <?php echo is_writable( $file ) ? '<span style="color: rgb(51, 204, 0); font-weight: bold;">'._SOBI2_FPERMS_WRITABLE.'</span>' : '<span style="color: rgb(255, 0, 0); font-weight: bold;">'._SOBI2_FPERMS_NWRITABLE.'</span>'; ?> </td>
		<td> <?php echo $fowner; ?> <?php echo $ownerName; ?> </td>
		<td> <?php echo $dgroup; ?> <?php echo $groupName; ?> </td>
		<td> <?php echo $status; ?> </td>
		<?php

	}
	function & openFile()
	{
		$config =& adminConfig::getInstance();
		$f = @fopen(_SOBI_CMSROOT.DS."administrator".DS."components".DS."com_sobi2".DS."syscheck_logfile.txt","w+");
		fwrite($f, "\n==========================\nDate: ".$config->getTimeAndDate()."\n==========================\n" );
		return $f;
	}
	function checkPHPSafeMode( &$logfile )
	{
		$v = ini_get( "safe_mode" );
		$state = _SOBI2SC_STATE_0;
		if( !$v || strtolower( $v ) == "off" ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_5;
		}
		$v = !( !$v || strtolower( $v ) == "off" ) ? "enabled" : "disabled";
		fwrite($logfile, "\nPHP Safe Mode: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_SM_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkPHPTime( &$logfile )
	{
		$v = ini_get( "max_execution_time" );
		$v = ereg_replace("[^0-9]", null, $v);
		$state = _SOBI2SC_STATE_0;
		if( $v >= 45 ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( $v >= 30 ) {
			$state = _SOBI2SC_STATE_2;
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		fwrite($logfile, "\nPHP Script execution time is: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_TIMELIM_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v} Seconds\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkPHPMem( &$logfile )
	{
		$v = ini_get( "memory_limit" );
		$v = ereg_replace("[^0-9]", null, $v);
		$state = _SOBI2SC_STATE_0;
		if( $v >= 50 ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( $v >= 30 ) {
			$state = _SOBI2SC_STATE_2;
		}
		elseif( $v >= 20 ) {
			$state = _SOBI2SC_STATE_3;
		}
		elseif( $v >= 16 ) {
			$state = _SOBI2SC_STATE_3;
		}
		else {
			$state = _SOBI2SC_STATE_5;
		}
		fwrite($logfile, "\nPHP Memory Limit is: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_MEMLIM_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v} MB\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkPhpVer( &$logfile )
	{
		$v = phpversion();
		$v = ereg_replace("[^0-9\.]", null, $v);
		$state = null;
		if( $v > 5 ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( $v > 4.4 ) {
			$state = _SOBI2SC_STATE_2;
		}
		elseif( $v > 4.3 ) {
			$state = _SOBI2SC_STATE_4;
		}
		else {
			$state = _SOBI2SC_STATE_5;
		}
		$v .= " (".php_sapi_name().") ";
		fwrite($logfile, "\nPHP Version is: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_PHPVER_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkOS( &$logfile )
	{
		if( !$v = @php_uname() ) {
			$v = PHP_OS;
		}
		if( strstr( strtolower( $v ), "linux" ) || strstr( $v, "BSD" ) ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( strstr( strtolower( $v ), "win" )  ) {
			$state = _SOBI2SC_STATE_4;
		}
		else {
			$state = _SOBI2SC_STATE_0;
		}
		fwrite($logfile, "\nPlatform: {$v}" );
		$v = substr( $v, 0, 35 );
		echo "\n\t<td align='right'>";
		echo "Platform: ";
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkServer( &$logfile )
	{
		$v = $_SERVER['SERVER_SOFTWARE'];
		if( strstr( strtolower( $v ), "apache" ) ) {
			if( strstr( strtolower( $v ), "2.2" ) ) {
				$state = _SOBI2SC_STATE_1;
			}
			elseif( strstr( strtolower( $v ), "2." ) ) {
				$state = _SOBI2SC_STATE_2;
			}
			else {
				$state = _SOBI2SC_STATE_3;
			}
		}
		else {
			$state = _SOBI2SC_STATE_4;
		}
		fwrite($logfile, "\nServer: {$v}" );
		echo "\n\t<td align='right'>";
		echo "Server: ";
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function checkDBVer( &$logfile, &$database )
	{
		$v = $database->getVersion();
		$v = ereg_replace("[^0-9\.]", null, $v);
		$state = null;
		if( $v >= 5.0 ) {
			$state = _SOBI2SC_STATE_1;
		}
		elseif( $v > 4.0 ) {
			$state = _SOBI2SC_STATE_2;
		}
		elseif( $v == 4.0 ) {
			$state = _SOBI2SC_STATE_4;
		}
		else {
			$state = _SOBI2SC_STATE_5;
		}
		fwrite($logfile, "\nMySQL Version is: {$v}" );
		echo "\n\t<td align='right'>";
		echo _SOBI2SC_MYSQL_IS;
		echo "\n\t</td>";
		echo "\n\t<td>{$v}\n\t</td>";
		echo "\n\t<td>{$state}\n\t</td>";
	}
	function getLogfile()
	{
		$config	=& adminConfig::getInstance();
		$filename = _SOBI_ADM_PATH.DS."syscheck_logfile.txt";
		if( !file_exists( $filename ) ) {
			$filename = str_replace( _SOBI_CMSROOT, "...", $filename );
			sobi2Config::redirect( "index3.php?option=com_sobi2&task=dosyscheck&no_html=1", "File {$filename} didn't exist. Try again now please" );
		}
		$now = date( 'Y-m-d', time() + $config->offset * 60 * 60  );
		$site = str_replace( array( "http://", ":", ",", "/", "\\" ), null, $config->liveSite );
		$newFilename = "sobi2_syscheck_logfile-{$site}-{$now}.txt";
		ob_end_clean();
		ob_start();
		header('Content-Disposition: attachment; filename="'.$newFilename.'');
		header('Content-Type: application/octet-stream');

		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows') !== false)
			$callback = create_function('$buffer', 'return preg_replace(\'~[\r]?\n~\', "\r\n", $buffer);');
		elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mac') !== false)
			$callback = create_function('$buffer', 'return preg_replace(\'~[\r]?\n~\', "\r", $buffer);');
		else
			$callback = create_function('$buffer', 'return preg_replace(\'~\r~\', "\r\n", $buffer);');
		$fp = fopen($filename, 'rb');
		@ob_end_clean();
		ob_clean();
		if(ob_get_length()) {
			@ob_clean();
		}
		if(ob_get_length()) {
			@ob_clean();
		}
		if(ob_get_length()) {
			@ob_end_clean();
		}
		if(ob_get_length()) {
			@ob_end_clean();
		}
		while (!feof($fp))
		{
			if (isset($callback))
				echo $callback(fread($fp, 8192));
			else
				echo fread($fp, 8192);
			flush();
		}
		fclose($fp);
		exit();
	}
}
?>