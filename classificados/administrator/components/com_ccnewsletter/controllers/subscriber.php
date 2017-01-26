<?php
/**
* @package ccNewsletter
* @version 1.0.9
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

jimport( 'joomla.application.component.controller' );

class ccNewsletterControllersubscriber extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'add'  , 'edit' );
		$this->registerTask( 'unpublish'  , 'publish' );
	}
	function display()
	{
		JRequest::setVar( 'view', 'subscribers');
		parent::display();
	}
	function edit()
	{
		JRequest::setVar( 'view', 'subscriber');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}
	function save()
	{
		// get the model
		$model = $this->getModel('subscriber');
		if ($model->store()) {
			$msg = JText::_( 'CC_MSG_SUBS_ADDEDDB' );
			$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
			$this->setRedirect($link, $msg);
		}
		else {
			JError::raiseWarning(100, JText::_('CC_ERROR_SUBS_ADDEDDB'));
			$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
			$this->setRedirect($link);
		}
	}
	function remove()
	{
		// get the model
		$model = $this->getModel('subscriber');
		if(!$model->delete()) {
			$msg = JText::_( 'CC_ERR_SUBSCIBERS_DELETED' );
		}
		else {
			$msg = JText::_( 'CC_SUBSCRIBERS_DELETED' );
		}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=subscriber', $msg );
	}
	function cancel()
	{
		$msg = JText::_( 'CC_MSG_CANCELED' );
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=subscriber', $msg );
	}
	function sync()
	{
		$acknowledgement =& $this->getModel('acknowledgement');
		$sendNewsletter =& $this->getModel('sendNewsletter');
		$acknowledgementData = $acknowledgement->getData();
		if($acknowledgementData->synstatus)
		{
			global $mainframe;
			$db =& JFactory::getDBO();
			jimport('joomla.mail.helper');

			$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
			$fromName = $params->get('fromName');
			$fromEmail = $params->get('fromEmail');
			$query = "SELECT name, email FROM #__users WHERE (email) NOT IN "
					. " (SELECT email FROM #__ccnewsletter_subscribers)";

			$db->setQuery( $query );
			$synsubscribers = $db->loadObjectList();
			$n = count( $synsubscribers );
			$subject = $acknowledgementData->subs_title;
			$body = $acknowledgementData->subs_content;
			if (!$body)
			{
				$msg = JText::_( 'CC_MSG_BODY_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			if (!$fromName)
			{
				$msg = JText::_( 'CC_MSG_FROMNAME_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			if (!$fromEmail)
			{
				$msg = JText::_( 'CC_MSG_FROMEMAIL_EMPTY');
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			// extract subject and validate
			if (!$subject)
			{
				$msg = JText::_( 'CC_MSG_TESTEMAIL_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
				$this->setRedirect($link, $msg);
				return false; // <- Exit Point. Task Failed.
			}
			$body = $sendNewsletter->convertImgTags($body);
			$body = $sendNewsletter->convertBackgroundTags($body);
			if($mainframe->getCfg('editor') == 'tinymce')
			{
				$body=$sendNewsletter->convertInternalLink($body);
			}
			$mail = array();
			for ($i = 0; $i < $n; $i++)
			{
				$mail[$i] = JFactory::getMailer();
				$convertedBody=$sendNewsletter->convertSubscribeName($body,$synsubscribers[$i]->name);
				// send the email
				$mail[$i]->addRecipient( $synsubscribers[$i]->email );
				$mail[$i]->setSender( array( $fromEmail, $fromName ) );
				$mail[$i]->addReplyTo( array( $fromEmail, $fromName ) );
				$mail[$i]->setSubject( $subject );
				$mail[$i]->setBody( $convertedBody );
				$mail[$i]->IsHTML(true);
				$sent = $mail[$i]->Send();
			}
		}
		// get the model
		$model = $this->getModel('subscriber');
		// attempt to synchronization  with joomla users
		$num_rows = $model->synchronization();
		if($num_rows > 0) {
			$msg = JText::_( 'CC_ADDED' ) . ": (" . $num_rows .") " . JText::_( 'CC_USERS_LIST' );
		}
		else {
			$msg = JText::_( 'CC_NO_RECORDS_FOUND' );
		}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=subscriber', $msg );
	}
	function susync()
	{
		$acknowledgement =& $this->getModel('acknowledgement');
		$sendNewsletter =& $this->getModel('sendNewsLetter');
		$acknowledgementData = $acknowledgement->getData();
		if($acknowledgementData->synstatus)
		{
			global $mainframe;
			$db =& JFactory::getDBO();
			jimport('joomla.mail.helper');
			$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
			$fromName = $params->get('fromName');
			$fromEmail = $params->get('fromEmail');
			include_once(JPATH_SITE.DS."administrator".DS."components".DS."com_virtuemart".DS."virtuemart.cfg.php");
			$vmtable_prfix = VM_TABLEPREFIX;
			$query = "SELECT u.user_email AS email, CONCAT(u.first_name, u.last_name) AS name "
				. "\n FROM #__".$vmtable_prfix."_order_user_info AS u"
				. "\n LEFT JOIN  #__".$vmtable_prfix."_orders AS o ON u.order_id = o.order_id"
				. "\n WHERE (u.user_email) NOT IN  (SELECT s.email FROM #__ccnewsletter_subscribers AS s)"
				. "\n  GROUP BY u.user_email";
			$db->setQuery( $query );
			$synsubscribers = $db->loadObjectList();
			$n = count( $synsubscribers );
			$subject = $acknowledgementData->subs_title;
			$body = $acknowledgementData->subs_content;
			if (!$body)
			{
				$msg = JText::_( 'CC_MSG_BODY_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			if (!$fromName)
			{
				$msg = JText::_( 'CC_MSG_FROMNAME_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			if (!$fromEmail)
			{
				$msg = JText::_( 'CC_MSG_FROMEMAIL_EMPTY');
				$link = 'index.php?option=com_ccnewsletter&controller=subscriber';
				$this->setRedirect($link, $msg);
				return false; // <-Exit Point. Task Failed.
			}
			// extract subject and validate
			if (!$subject)
			{
				$msg = JText::_( 'CC_MSG_TESTEMAIL_EMPTY' );
				$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
				$this->setRedirect($link, $msg);
				return false; // <- Exit Point. Task Failed.
			}
			$body = $sendNewsletter->convertImgTags($body);
			$body = $sendNewsletter->convertBackgroundTags($body);
			if($mainframe->getCfg('editor') == 'tinymce')
			{
				$body=$sendNewsletter->convertInternalLink($body);
			}
			$mail = array();
			for ($i = 0; $i < $n; $i++)
			{
				$mail[$i] = JFactory::getMailer();
				$convertedBody=$sendNewsletter->convertSubscribeName($body,$synsubscribers[$i]->name);
				// send the email
				$mail[$i]->addRecipient( $synsubscribers[$i]->email );
				$mail[$i]->setSender( array( $fromEmail, $fromName ) );
				$mail[$i]->addReplyTo( array( $fromEmail, $fromName ) );
				$mail[$i]->setSubject( $subject );
				$mail[$i]->setBody( $convertedBody );
				$mail[$i]->IsHTML(true);
				$sent = $mail[$i]->Send();
			}
		}
		// get the model
		$model = $this->getModel('subscriber');
		// attempt to synchronization  with joomla users
		$num_rows = $model->susynchronization();
		if($num_rows > 0)
		{
			$msg = JText::_( 'CC_ADDED' ) . ": (" . $num_rows .") " . JText::_( 'CC_USERS_LIST' );
		}
		else
		{
			$msg = JText::_( 'CC_NO_RECORDS_FOUND' );
		}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=subscriber', $msg );
	}

	function publish()
	{
		// Initialize variables
		$db			=& JFactory::getDBO();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );
		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'CC_NO_ITEMS_SELECTED' ) );
		}
		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );
		$query = 'UPDATE #__ccnewsletter_subscribers '
		. ' SET enabled = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		$msg = $n . ' ' . JText::sprintf( $publish ? JText::_( 'CC_SUBS_ENABLED' ) :  JText::_( 'CC_SUBS_DISABLED' ));
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=subscriber', $msg );
	}
}
?>
