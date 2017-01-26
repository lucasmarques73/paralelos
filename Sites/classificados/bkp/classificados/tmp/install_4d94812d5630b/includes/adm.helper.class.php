<?php
/**
* @version $Id: adm.helper.class.php 4823 2009-01-05 12:04:58Z Radek Suski $
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

sobi2Config::import("includes|helper.class");

class sobi2AdmHelper extends sobi2Helper {
    function getVersion()
    {
		if(!sobi2Config::translatePath("sobi2", "adm", true, ".xml")) {
			return "Error: cannot find xml file";
		}
		sobi2Config::import("includes|xml_domit|xml_domit_lite_parser", "adm");
		$XMLfile = _SOBI_ADM_PATH.DS."sobi2.xml";
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if (!$xmlDoc->loadXML( $XMLfile, false, true )) {
			return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR;
		}
		$root = $xmlDoc->documentElement;
		if($root->getTagName() != 'mosinstall' && $root->getTagName() != 'install') {
			return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR;
		}
		$lang = $root->getElementsByPath('version',1);
		$version = $lang->getText();
    	return $version;
    }
	function getListingOrdering( &$config )
	{
		$listingOrdering = array();
		$listingOrdering[] = sobiHTML::makeOption('items.title ASC', _SOBI2_CONFIG_GENERAL_SORT_TITLE_ASC);
		$listingOrdering[] = sobiHTML::makeOption('items.title DESC', _SOBI2_CONFIG_GENERAL_SORT_TITLE_DESC);
		$listingOrdering[] = sobiHTML::makeOption('items.publish_up ASC', _SOBI2_CONFIG_GENERAL_SORT_ADDED_ASC);
		$listingOrdering[] = sobiHTML::makeOption('items.publish_up DESC', _SOBI2_CONFIG_GENERAL_SORT_ADDED_DESC);
		$listingOrdering[] = sobiHTML::makeOption('items.hits ASC', _SOBI2_CONFIG_GENERAL_SORT_HITS_ASC);
		$listingOrdering[] = sobiHTML::makeOption('items.hits DESC', _SOBI2_CONFIG_GENERAL_SORT_HITS_DESC);
		$listingOrdering[] = sobiHTML::makeOption('relation.ordering ASC', _SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC);
		$listingOrdering[] = sobiHTML::makeOption('relation.ordering DESC', _SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC);
		$listingOrdering[] = sobiHTML::makeOption('items.publish_down ASC', _SOBI2_CONFIG_GENERAL_SORT_EXP_ASC);
		$listingOrdering[] = sobiHTML::makeOption('items.publish_down DESC', _SOBI2_CONFIG_GENERAL_SORT_EXP_DESC);
		return sobiHTML::selectList( $listingOrdering, 'listingOrdering', 'size="1" class="inputbox"', 'value', 'text', $config->listingOrdering);
	}
	function getCatsOrdering(  &$config, $boxName = 'catsOrdering' )
	{
		$catsOrdering = array();
		$catsOrdering[] = sobiHTML::makeOption('name ASC', _SOBI2_CONFIG_GENERAL_SORT_NAME_ASC);
		$catsOrdering[] = sobiHTML::makeOption('name DESC', _SOBI2_CONFIG_GENERAL_SORT_NAME_DESC);
		$catsOrdering[] = sobiHTML::makeOption('count ASC', _SOBI2_CONFIG_GENERAL_SORT_COUNT_ASC);
		$catsOrdering[] = sobiHTML::makeOption('count DESC', _SOBI2_CONFIG_GENERAL_SORT_COUNT_DESC);
		$catsOrdering[] = sobiHTML::makeOption('ordering ASC', _SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC);
		$catsOrdering[] = sobiHTML::makeOption('ordering DESC', _SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC);
		return sobiHTML::selectList( $catsOrdering, $boxName, 'size="1" class="inputbox"', 'value', 'text', $config->$boxName);
	}
	function getLangList(  &$config, $box = true )
	{
		$langDir = opendir( "{$config->absolutePath}".DS."components".DS."com_sobi2".DS."languages".DS );
		if( $box ) {
			$config->langList[] = sobiHTML::makeOption( 'default', 'default' );
		}
		$langs = array();
		$config->sobi2Language = $config->configValues["language"];
		while ( $file = readdir( $langDir ) ) {
			if( strstr( $file, '.php' ) && ( !strstr( $file, "default" ) || !$box ) ) {
				$file = str_replace( '.php', '', $file );
				if( $box ) {
					$config->langList[] = sobiHTML::makeOption( $file, $file );
				}
				else {
					$langs[] = $file;
				}
			}
		}
		closedir( $langDir );
		if( !$box ) {
			return $langs;
		}
	}

	function templatesChooser( $sel = null, $name = 'tplChoose', $tfile = null, $params = null, $empty = true )
	{
		$config =& adminConfig::getInstance();
		$tplDir = opendir( $config->absolutePath.DS.'components'.DS.'com_sobi2'.DS.'templates'.DS );
		$templates = array();
		if( $empty ) {
			$templates[] = sobiHTML::makeOption( null, _SOBI2_FIELDLIST_SELECT );
		}
		while ( $file = readdir( $tplDir ) ) {
			if( $file != '.' && $file != '..' ) {
				$dir = sobi2Config::translateDirPath( 'templates|'.$file.'|' );
				if( is_dir( $dir )
					&& ( sobi2Config::translatePath( 'templates|'.$file.'|sobi2.vc.tmpl' )
					|| sobi2Config::translatePath( 'templates|'.$file.'|sobi2.details.tmpl' ) )
				) {
					if( !$tfile ) {
						$templates[] = sobiHTML::makeOption( $file, $file );
					}
					else {
						if( $tfile == 'vc' && sobi2Config::translatePath( 'templates|'.$file.'|sobi2.vc.tmpl' ) ) {
							$templates[] = sobiHTML::makeOption( $file, $file );
						}
						elseif( $tfile == 'details' && sobi2Config::translatePath( 'templates|'.$file.'|sobi2.details.tmpl' ) ) {
							$templates[] = sobiHTML::makeOption( $file, $file );
						}
						elseif( $tfile == 'form' && sobi2Config::translatePath( 'templates|'.$file.'|sobi2.details.tmpl' ) ) {
							$templates[] = sobiHTML::makeOption( $file, $file );
						}
					}
				}
			}
		}
		closedir( $tplDir );
		$ps = ' ';
		if( is_array( $params ) && !empty( $params ) ) {
			foreach ( $params as $p => $v ) {
				$ps .= $p.'="'.$v.'" ';
			}
		}
		return sobiHTML::selectList( $templates, $name, 'size="1" class="inputbox"'.$ps, 'value', 'text', $sel );
	}

	function getTemplates()
	{
		$config =& adminConfig::getInstance();
		$tplDir = opendir( $config->absolutePath.DS.'components'.DS.'com_sobi2'.DS.'templates'.DS );
		$templates = array();
		while ( $file = readdir( $tplDir ) ) {
			if( $file != '.' && $file != '..' ) {
				$dir = sobi2Config::translateDirPath( 'templates|'.$file.'|' );
				if( is_dir( $dir )
					&& ( sobi2Config::translatePath( 'templates|'.$file.'|sobi2.vc.tmpl' )
					|| sobi2Config::translatePath( 'templates|'.$file.'|sobi2.details.tmpl' ) )
				) {
					$templates[ $file ] = array( 'vc' => false, 'details' => false, 'form' => false );
					if( sobi2Config::translatePath( 'templates|'.$file.'|sobi2.vc.tmpl' ) ) {
						$templates[ $file ][ 'vc' ] = true;
					}
					if( sobi2Config::translatePath( 'templates|'.$file.'|sobi2.details.tmpl' ) ) {
						$templates[ $file ][ 'details' ] = true;
					}
					if( sobi2Config::translatePath( 'templates|'.$file.'|sobi2.form.tmpl' ) ) {
						$templates[ $file ][ 'form' ] = true;
					}
				}
			}
		}
		closedir( $tplDir );
		return $templates;
	}

	function getLogfile()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config	=& adminConfig::getInstance();
		$filename = _SOBI_ADM_PATH.DS."error_logfile.txt";
		if(!(is_file($filename))) {
			sobi2Config::redirect( $sobi2AdminUrl."&task=errlog");
			exit();
		}
		$site = str_replace( array( "http://", ":", ",", "/", "\\" ), null, $config->liveSite );
		$now = date( 'Y-m-d', time() + $config->offset * 60 * 60  );
		$newFilename = "sobi2_error_logfile-{$site}-{$now}.txt";
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
	function deleteLogfile()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$msg = _SOBI2_ERRLOG_FILE_NOT_DELETED;
		$file = _SOBI_ADM_PATH.DS."error_logfile.txt";
		if(!(is_file($file))) {
			sobi2Config::redirect( $sobi2AdminUrl."&task=errlog",$msg);
			exit();
		}
		if(unlink($file))
			$msg = _SOBI2_ERRLOG_FILE_DELETED;
		sobi2Config::redirect( $sobi2AdminUrl."&task=errlog", $msg );
	}
	function installLang()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$msg = $config->installLang();
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function amImages( $name, &$active, $javascript = null, $directory = null )
	{
		return class_exists( 'JHTML' ) ? JHTML::_( 'list.images', $name, $active, $javascript, $directory ) : mosAdminMenus::Images( $name, $active, $javascript, $directory );
	}
	function amPositions( $name, $active = null, $javascript = null, $none = 1, $center = 1, $left = 1, $right = 1, $id = false )
	{
		return class_exists( 'JHTML' ) ? JHTML::_( 'list.positions', $name, $active, $javascript, $none, $center, $left, $right, $id ) : mosAdminMenus::Positions(  $name, $active, $javascript, $none, $center, $left, $right, $id );
	}
	function checkedOut( &$row, $overlib = 1 )
	{
		if( class_exists( 'JHTML' ) ) {
			jimport( 'joomla.html.html.grid' );
			return JHTML::_( 'grid.checkedOut',$row, $overlib );
		}
		else {
			return mosCommonHTML::checkedOut( $row, $overlib );
		}
	}
	function checkedOutProcessing( &$row, $i )
	{
		return class_exists( 'JHTML' ) ? JHTML::_('grid.checkedout',  $row, $i) : mosCommonHTML::CheckedOutProcessing( $row, $i );
	}
	function publishedProcessing( &$row, $i, $imgY = 'tick.png', $imgX = 'publish_x.png' )
	{
		return class_exists( 'JHTML' ) ? JHTML::_( 'grid.published',$row, $i, $imgY, $imgX ) : mosCommonHTML::PublishedProcessing( $row, $i, $imgY, $imgX );
	}
	function userSelect( $name, $active, $nouser = 0, $javascript = null, $order = 'name', $reg = 1 )
	{
		return class_exists( 'JHTML' ) ? JHTML::_('list.users', $name, $active, $nouser, $javascript, $order, $reg ) : mosAdminMenus::UserSelect( $name, $active, $nouser, $javascript, $order, $reg );
	}

}
?>