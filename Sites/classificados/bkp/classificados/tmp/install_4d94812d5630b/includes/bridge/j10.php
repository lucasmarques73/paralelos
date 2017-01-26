<?php
/**
* @version $Id: j10.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class sobi2bridge {
	function readDirectory( $path, $filter = '.', $recursiv = false, $fullpath = false )
	{
		return mosReadDirectory( $path, $filter, $recursiv, $fullpath );
	}

	function & jMenu( &$db )
	{
		$menu = new mosMenu( $db );
		return $menu;
	}

	function & jParams( $text, $path = null, $type = 'component' )
	{
		$params = new mosParameters( $text, $path, $type );
		return $params;
	}

	function init( &$config )
	{
    	global  $my,
				$mosConfig_offset,
				$database,
				$mainframe,
				$mosConfig_sitename,
				$acl,
				$mosConfig_mailfrom,
				$mosConfig_fromname,
				$mosConfig_lang,
				$mosConfig_secret,
				$mosConfig_dbprefix;
		$config->user				=& $my;
		$config->database 			=& $database;
		$config->absolutePath 		= _SOBI_CMSROOT;
		$config->offset				= $mosConfig_offset;
		$config->sitename			= $mosConfig_sitename;
		$config->acl				=& $acl;
		$config->mailfrom			= $mosConfig_mailfrom;
		$config->fromname			= $mosConfig_fromname;
		$config->globalLang			= $mosConfig_lang;
		$config->secret				= $mosConfig_secret;
		$config->queryStart			= count( $database->_log );
		$config->DBprefix			= $mosConfig_dbprefix;
		$config->database			=& $database;
		$config->mainframe 			=& $mainframe;
	}

	function & jUser( &$db )
	{
		$u = new mosUser( $db );
		return $u;
	}

	function mail( $from, $fromname, $recipient, $subject, $body, $mode = 0, $cc = null, $bcc = null, $attachment = null, $replyto = null, $replytoname = null )
	{
		return mosMail( $from, $fromname, $recipient, $subject, $body, $mode, $cc, $bcc, $attachment, $replyto, $replytoname );
	}

	function isChmodable( $file )
	{
		return mosIsChmodable( $file );
	}
	function & jPageNav( $total, $limitstart, $limit )
	{
		$adm = defined( '_SOBI2_ADMIN' ) ? 'administrator|' : null;
		sobi2Config::import( $adm.'includes|pageNavigation', 'root' );
		$pn =  new mosPageNav( $total, $limitstart, $limit );
		return $pn;
	}
	function writePagesLinks( &$pn, $link = null )
	{
		return $pn->writePagesLinks( $link );
	}
	function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row )
	{
		return editorArea( $name, $content, $hiddenField, $width, $height, $col, $row );
	}
	function pnRowNumber( &$pn, $index )
	{
		return $pn->rowNumber( $index );
	}

}
if( !class_exists( 'mosEmpty' ) ) {
	class mosEmpty
	{
		function def()
		{
			return 1;
		}
		function get()
		{
			return 1;
		}
	}
}
?>