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

class ccNewsletterControlleracknowledgement extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
	}

	function display()
	{
		JRequest::setVar( 'view', 'acknowledgement');
		JRequest::setVar( 'layout', 'form'  );
		parent::display();
	}

	function save()
	{
		// get our model
		$model = $this->getModel('acknowledgement');
		if ($model->store()) {
			$msg = JText::_( 'CC_ACK_SAVED' );
		}
		else {
			$msg = JText::_( 'CC_ERROR_ACK_SAVED' );
		}
		// redirect (to same controller, since task won't be add, edit, or new we will return to the list of newsletters)
		$link = 'index.php?option=com_ccnewsletter&controller=acknowledgement';
		$this->setRedirect($link, $msg);

	}

	function save1()
	{
		// Initialize variables
		$db =& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$post['subs_content'] = JRequest::getVar( 'subs_content', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$post['unsubs_content'] = JRequest::getVar( 'unsubs_content', '', 'post', 'string', JREQUEST_ALLOWRAW );
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ccnewsletter'.DS.'tables');
		$row =& JTable::getInstance('acknowledgement', 'Table');
		if (!$row->bind( $post )) {
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		if (!$row->store()) {
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		$msg = JText::_( 'CC_ACK_SAVED' );
		$link = 'index.php?option=com_ccnewsletter&controller=acknowledgement';
		$this->setRedirect($link, $msg);
	}
}
?>
