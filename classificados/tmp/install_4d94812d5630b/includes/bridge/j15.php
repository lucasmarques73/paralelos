<?php
/**
* @version $Id: j15.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' )  || ( trigger_error( 'Restricted access', E_USER_ERROR ) && exit() );
class sobi2bridge {

	function readDirectory( $path, $filter = '.', $recursiv = false, $fullpath = false )
	{
		jimport( 'joomla.filesystem.folder' );
		$files = JFolder::files( $path, $filter, $recursiv, $fullpath );
		$folders = JFolder::folders( $path, $filter, $recursiv, $fullpath );
		$dir = array_merge( $files, $folders );
		asort( $dir );
		return $dir;
	}

	function & jMenu()
	{
		sobi2Config::import( 'libraries|joomla|database|table|menu', 'root' );
		$m =& JTable::getInstance( 'menu' );
		return $m;
	}

	function & jParams( $text, $path = null )
	{
		$params = new JParameter( $text, $path );
		return $params;
	}

	function init( &$config )
	{
		$jConf					= new JConfig();
		$lang 					=& JFactory::getLanguage();
		$config->user			=& JFactory::getUser();
		$config->database 		=& JFactory::getDBO();
		$config->absolutePath 	= _SOBI_CMSROOT;
		$config->offset			= $jConf->offset;
		$config->sitename		= $jConf->sitename;
		$config->mailfrom		= $jConf->mailfrom;
		$config->fromname		= $jConf->fromname;
		$config->globalLang		= $lang->getBackwardLang();
		$config->secret			= $jConf->secret;
		$config->queryStart		= count( $config->database->_log );
		$config->DBprefix		= $jConf->dbprefix;
		$config->mainframe 		=& JFactory::getApplication( 'site' );
		$config->acl			=& JFactory::getACL();
	}

	function & jUser( &$db )
	{
		$u =& JTable::getInstance( 'user' );
		return $u;
	}

	function mail( $from, $fromname, $recipient, $subject, $body, $mode = 0, $cc = null, $bcc = null, $attachment = null, $replyto = null, $replytoname = null )
	{
		return JUTility::sendMail( $from, $fromname, $recipient, $subject, $body, $mode, $cc, $bcc, $attachment, $replyto, $replytoname );
	}

	function isChmodable( $file )
	{
		jimport( 'joomla.filesystem.path' );
		return JPath::canChmod( $file );
	}

	function & jPageNav( $total, $limitstart, $limit )
	{
		jimport('joomla.html.pagination');
		$pn = new JPagination( $total, $limitstart, $limit );
		return $pn;
	}

	function writePagesLinks( &$pn )
	{
		return $pn->getPagesLinks();
	}

	function pnRowNumber( &$pn, $index )
	{
		return $index + 1 + $pn->limitstart;
	}

	function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row )
	{
		jimport( 'joomla.html.editor' );
		$editor =& JFactory::getEditor();
		echo $editor->display( $hiddenField, $content, $width, $height, $col, $row );
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