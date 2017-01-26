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

// extend our main controller for the newsletter
class ccNewsletterControllernewsletter extends JController
{
	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'add'  , 'edit' );
		$this->registerTask( 'apply',		'save' );
	}
	function display()
	{
		JRequest::setVar( 'view', 'newsletters');
		parent::display();
	}
	function edit()
	{
		JRequest::setVar( 'view', 'newsletter');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}
	function save()
	{
		$model = $this->getModel('newsletter');
		$newslettterid	= JRequest::getVar( 'id', '', 'post', '' );
		$id=$model->store();
		if ($id) {
			$msg = JText::_( 'CC_NEWSLETTER_SAVED' );
		}
		else {
			$msg = JText::_( 'CC_ERROR_SAVING_NEWSLETTER' );
		}
		if($this->_task == 'apply')
		{
			$link 	= 'index.php?option=com_ccnewsletter&controller=newsletter&task=edit&cid[]='.$id;
		}
		else
		{
			$link = 'index.php?option=com_ccnewsletter&controller=newsletter';
		}
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		$model = $this->getModel('newsletter');
		if(!$model->delete()) {
			$msg = JText::_( 'CC_MSG_MULTINEWSLETTER_DELETED' );
		}
		else {
			$msg = JText::_( 'CC_MSG_NEWSLETTER_DELETED' );
		}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=newsletter', $msg );
	}
	function cancel()
	{
		$msg = JText::_( 'CC_MSG_CANCELED' );
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=newsletter', $msg );
	}
	/**
	* Compiles information to add or edit a module
	* @param string The current GET/POST option
	* @param integer The unique id of the record to edit
	*/
	function copy()
	{
		$model = $this->getModel('newsletter');
		if(!$model->copy()) {
			$msg = JText::_( 'CC_ERR_COPYNEWSLTTER' );
		}
		else {
			$msg = JText::_( 'CC_MSG_COPYNEWSLTTER' );
		}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=newsletter', $msg );
	}
}
?>
