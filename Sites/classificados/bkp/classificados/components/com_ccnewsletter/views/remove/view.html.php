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

jimport( 'joomla.application.component.view');

// extend the JView class for our specific view
class ccNewsletterViewremove extends JView
{
	function display($tpl = null)
	{
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
		$document =& JFactory::getDocument();
		if($params->get('show_page_title'))
		{
			$page_title = $params->get( 'page_title' );
		}
		else
		{
			$page_title = JText::_( 'CC_NEWSLETTER_SUBSCRIPTION' );
		}
		$document->setTitle( $page_title );
		// get the operation status (set in the controller)
		$operationStatus = JRequest::getVar('operationStatus','');
		// assign the operaton status to a variable for use in the view
		$this->assignRef( 'operationStatus',	$operationStatus );
		$this->assignRef( 'pageTitle',	$page_title );
		parent::display($tpl);
	}
}
?>
