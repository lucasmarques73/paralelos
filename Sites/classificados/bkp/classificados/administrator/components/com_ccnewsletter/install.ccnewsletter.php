<?php
/**
* @package ccNewsletter
* @version 1.0.7
* @author  Chill Creations <info@chillcreations.com>
* @link    http://www.chillcreations.com
* @copyright Copyright (C) 2008 - 2010 Chill Creations-All rights reserved
* @license GNU/GPL, see LICENSE.php for full license.
* See COPYRIGHT.php for more copyright notices and details.

This file is part of ccNewsletter.
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
//com_install();

function com_install() {

		$db			=& JFactory::getDBO();
		global $mainframe;
		jimport('joomla.filesystem.folder');

		
	//Install ccNewsletter Module
	if(!JFolder::exists(JPATH_ROOT.DS.'modules'.DS.'mod_ccnewsletter')) {
		JFolder::move(JPATH_ROOT.DS.'components'.DS.'com_ccnewsletter'.DS.'mod_ccnewsletter', JPATH_ROOT.DS.'modules'.DS.'mod_ccnewsletter');
		
		$query = "INSERT INTO `#__modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`, `control`) VALUES ('', 'ccNewsletter', '', '1', 'left', 0, '0000-00-00 00:00:00', 0, 'mod_ccnewsletter', '0', '0', '1', 'style=mootools
introduction=
lname=Name
lemail=Email
lsubscribe=Subscribe
lunsubscribe=UnSubscribe
lmove=Move
lclose=Close
namewarning=Enter your name!!
emailwarning=Enter the valid email!!
terms_cond_warn=Check the Terms and condition!!
unsubscribe_button=0
showterm=0
popuptype=1
showterm_text=Terms and condition
id=0
cache=1
cache_time=900
moduleclass_sfx=', '0', '0', '')";
		$db->setQuery( $query );
		$db->query();
		$id 		= $db->insertid();
		
		$query = "INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES ('$id', '0')";
		$db->setQuery( $query );
		$db->query();
		
		if(JFolder::exists(JPATH_ROOT.DS.'components'.DS.'com_ccnewsletter'.DS.'mod_ccnewsletter')) {
			JFolder::delete(JPATH_ROOT.DS.'components'.DS.'com_ccnewsletter'.DS.'mod_ccnewsletter');
		}		
	} else {
		if(JFolder::exists(JPATH_ROOT.DS.'components'.DS.'com_ccnewsletter'.DS.'mod_ccnewsletter')) {
			JFolder::delete(JPATH_ROOT.DS.'components'.DS.'com_ccnewsletter'.DS.'mod_ccnewsletter');
		}
	}
	//Install ccNewsletter Module			
		
		
	if(is_writable(JPATH_SITE . DS . "images" . DS . "stories" ))
	{
		if(!file_exists(JPATH_SITE.DS."images".DS."stories".DS."ccnewsletter"))
		{
			$message ="ccNewsletter component and module installed successfully, go to Components/ccNewsletter to set it up!";
			rename(JPATH_SITE.DS."administrator".DS."components".DS."com_ccnewsletter".DS."ccnewsletter", JPATH_SITE.DS."images".DS."stories".DS."ccnewsletter");
		}
		elseif((file_exists(JPATH_SITE.DS."images".DS."stories".DS."ccnewsletter"))&&(!file_exists(JPATH_SITE.DS."administrator".DS."components".DS."com_ccnewsletter".DS."ccnewsletter.xml")))
		{
			$message ="ccNewsletter component and module installed successfully, go to Components/ccNewsletter to set it up!";
		}
		else
		{
			$adminDir = JPATH_ADMINISTRATOR .DS. 'components';
			$siteDir = JPATH_SITE .DS. 'components';
			$file = $adminDir.DS.'com_ccnewsletter'.DS.'ccnewsletter.xml';
			$xml = new JSimpleXML;
			$xml->loadFile($file);
			$xml = $xml->document;
			$version_no = $xml->version[0]->data();

			if($version_no == "1.0.7")
			{
				$message = "You already have ccNewsletter 1.0.7";
				JError::raiseWarning(100, $message);
				$mainframe->redirect('index.php?option=com_installer');
			}
			else
			{
				$message ="ccNewsletter component upgraded from  $version_no to 1.0.7 successfully!";
			}

		}
	}

	if( file_exists(JPATH_SITE.DS."administrator".DS."components".DS."com_spsnewsletter".DS."admin.spsnewsletter.php"))
	{
		$query = "INSERT INTO #__ccnewsletter_subscribers (name, email, plainText, enabled)"
				. "\n (SELECT name, email, plainText, '1' FROM #__spsnewsletter_subscribers)";
		$db->setQuery( $query );
		$db->query();

		$query = "INSERT INTO #__ccnewsletter_newsletters (name, body)"
				. "\n (SELECT name, body FROM #__spsnewsletter_newsletters)";
		$db->setQuery( $query );
		$db->query();

		$query = "SELECT params FROM #__components WHERE name='spsNewsletter' LIMIT 0, 1";
		$db->setQuery( $query );
		$parameters = $db->loadResult();

		$query = "UPDATE #__components SET params='". $parameters . "' WHERE name='ccNewsletter'";
		$db->setQuery( $query );
		$db->query();
	}
	else
	{

		$query = "SELECT count(*) FROM #__ccnewsletter_newsletters";
		$db->setQuery( $query );
		$total_rows = $db->loadResult();
		if(!$total_rows)
		{
			$query = "INSERT INTO #__ccnewsletter_newsletters (`name`, `body`) VALUES"
				. "\n ('My First Newsletter', '<div id=\"newsletter\" align=\"center\">"
				. "\n <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\"><tbody>"
				. "\n <tr><td colspan=\"3\" height=\"100\" background=\"administrator/components/com_ccnewsletter/assets/bg_image.gif\"></td></tr>"
				. "\n <tr><td width=\"10\" height=\"30\"></td><td width=\"780\" height=\"30\">"
				. "\n <img src=\"administrator/components/com_ccnewsletter/assets/30pxVertical.gif\" border=\"0\" width=\"4\" height=\"30\" /></td>"
				. "\n <td width=\"10\" height=\"30\"></td></tr><tr><td></td>"
				. "\n <td> Hello [name] , </td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td>"
				. "\n <td><p> You''re receiving my website''s first newsletter created by ccNewsletter! This new component will allow me to stay in touch with you, "
				. "\n and my other users, on a regular basis.</p><p>&nbsp;</p><p>Take Care!</p><p>&nbsp;</p><p>The Management </p></td>"
				. "\n <td></td></tr><tr><td></td><td></td><td></td></tr><tr><td style=\"height: 30px\"></td>"
				. "\n <td><font color=\"#808080\">To unsubscribe from our mailing list, please use the following link:"
				. "\n [unsubscribe link]</font></td><td></td></tr><tr><td></td>"
				. "\n <td> <img src=\"administrator/components/com_ccnewsletter/assets/30pxVertical.gif\" border=\"0\" width=\"4\" height=\"30\" /></td>"
				. "\n <td></td></tr><tr align=\"right\"><td colspan=\"3\" height=\"100\" background=\"administrator/components/com_ccnewsletter/assets/bg_image.gif\">"
				. "\n </td></tr>"
				. "\n </tbody></table> </div>')";
			$db->setQuery( $query );
			$db->query();
		}
	}

	/* Adding synstatus and activation fields for older version */
	$query = "SELECT activation FROM #__ccnewsletter_acknowledgement";
	$db->setQuery( $query );
	if(!$db->query())
	{
		$query = "ALTER TABLE  #__ccnewsletter_acknowledgement  ADD  `activation` TINYINT( 1 ) NOT NULL DEFAULT  '0'";
		$db->setQuery( $query );
		$db->query();
	}

	$query = "SELECT synstatus FROM #__ccnewsletter_acknowledgement";
	$db->setQuery( $query );
	if(!$db->query())
	{
		$query = "ALTER TABLE  #__ccnewsletter_acknowledgement  ADD  `synstatus` TINYINT( 1 ) NOT NULL DEFAULT  '0'";
		$db->setQuery( $query );
		$db->query();
	}

	/* Insert acknowledgement configuration */
	$query = "SELECT count(*) FROM #__ccnewsletter_acknowledgement";
	$db->setQuery( $query );
	$total_rows = $db->loadResult();
	if(!$total_rows)
	{
		$query = "INSERT INTO #__ccnewsletter_acknowledgement (`id`, `status`, `synstatus`, `activation`, `subs_title`, `subs_content`, `unsubs_title`, `unsubs_content`) VALUES ( 1, 0, 0, 1, 'Welcome to Sitename', 'Welcome mail content here', 'successfully unsubscribed from sitename', 'Your email has been unsubscribed successfully')";
		$db->setQuery( $query );
		$db->query();
	}

	jimport('joomla.filesystem.folder');

		/* Get a database connector */
		$db =& JFactory::getDBO();

		$query = 'SELECT *' .
				' FROM #__components' .
				' WHERE parent = 0' .
				' ORDER BY iscore, name';
		$db->setQuery($query);
		$rows = $db->loadObjectList();

	if(file_exists(JPATH_SITE.DS."images".DS."stories".DS."ccnewsletter".DS."params"))
	{
		$myFile = JPATH_SITE .DS. 'images'.DS.'stories'.DS.'ccnewsletter'.DS.'params'.DS.'config.txt';
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, 9999999);
		fclose($fh);

		$query="UPDATE  #__components SET params='$theData' WHERE name='ccNewsletter'";
		$db->setQuery( $query );
		$db->query();

		//$myFile = "myfiles/test.txt";
		unlink($myFile);

		$mydir = JPATH_SITE .DS. 'images'.DS.'stories'.DS.'ccnewsletter'.DS.'params';
		if (is_dir($mydir)) {
		rmdir($mydir);
		} else {
		echo $mydir.' does not exists';
		}

	}


	$query = "SELECT lastSentNewsletter FROM #__ccnewsletter_subscribers";
	$db->setQuery( $query );
	if(!$db->query())
	{
		$query ="ALTER TABLE #__ccnewsletter_subscribers ADD `lastSentNewsletter` INT( 11 ) default NULL";
		$db->setQuery( $query );
		$db->query();
		$query = "SELECT lastSentNewsletter FROM #__ccnewsletter_subscribers";
		$db->setQuery( $query );
		if(!$db->query())
		{
			echo "<div style=\"color:red\">The ccnewsletter_subscribers table not altered</div>";
		}
	}
	echo $message;
}
?>

