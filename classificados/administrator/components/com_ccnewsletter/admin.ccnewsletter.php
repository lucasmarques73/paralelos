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

// get the controller name. If there is no controller name specified in the URL set to  the default, sendNewsletter
$controllerName = JRequest::getCmd( 'controller', 'sendNewsletter' );
switch($controllerName)
{
	case 'subscriber':
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter');
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber', true);
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter');
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement');
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import');

	break;

	case 'newsletter':
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter');
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber' );
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter',true);
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement');
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import');

	break;

	case 'ccNewsletterConfig':
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter');
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber' );
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter');
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement');
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import');

	break;

	case 'acknowledgement':
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter');
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber' );
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter');
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement',true);
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import');
	
break;

	case 'import':
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter');
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber' );
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter');
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement');
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import', true);

	break;

	case 'sendNewsletter':
	default:
		JSubMenuHelper::addEntry(JText::_('CC_SEND_NEWSLETTER'), 'index.php?option=com_ccnewsletter&controller=sendNewsletter',true);
		JSubMenuHelper::addEntry(JText::_('CC_SUBSCRIBER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=subscriber' );
		JSubMenuHelper::addEntry(JText::_('CC_NEWSLETTER_MANAGEMENT'), 'index.php?option=com_ccnewsletter&controller=newsletter');
		JSubMenuHelper::addEntry(JText::_('CC_ACKNOWLEDGEMENT'), 'index.php?option=com_ccnewsletter&controller=acknowledgement');
		JSubMenuHelper::addEntry(JText::_('CC_IMPORT'), 'index.php?option=com_ccnewsletter&controller=import');

	break;
}
switch($controllerName)
{
	case 'subscriber':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'newsletter':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'ccNewsletterConfig':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'acknowledgement':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'about':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'import':
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	break;

	case 'sendNewsletter';
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
	$controllerName = 'ccNewsletterController'.$controllerName;
	// Create the controller
	$controller = new $controllerName();
	default:
	require_once( JPATH_COMPONENT.DS.'controllers'.DS.'sendNewsletter'.'.php' );
	$controllerName = 'ccNewsletterControllersendNewsletter';
	// Create the controller
	$controller = new $controllerName();
	break;
}
// Perform the Request task
require_once( JPATH_COMPONENT.DS.'helper'.DS.'version.php' );
$controller->execute( JRequest::getCmd('task') );
// Redirect if set by the controller
$controller->redirect();
?>
