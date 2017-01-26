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

jimport('joomla.application.component.controller');

// extend the JController class for newsletter specific tasks
class ccNewsletterController extends JController
{
	function display()
	{
		// switch on the requested task
		switch(JRequest::getVar('task'))
		{
			case 'addSubscriber':

				// read in a few variables from the post data
				$name = JRequest::getVar( 'name','', 'post');
				$email = JRequest::getVar( 'email','', 'post');
				// make sure both a name and email were supplied
				if(!$name || !$email)
				{
					JRequest::setVar('operationStatus', JText::_( 'CC_MSG_MULTIFIELDS_MISSING' ));
					JRequest::setVar('addSubscriberStatus', '-1' );
					break; // <- Exit Point. Task Failed.
				}

		 		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );

				if($params->get('emailvalidation'))
				{
					$emailModel = & $this->getModel('emailValidator');
					//Hack to avoid fake registration. New warning message.
					if( !$emailModel->ValidateEmailBox( $email ) )
					{
						JRequest::setVar('operationStatus', JText::_( 'CC_MSG_INVALID_EMAIL' ));
						JRequest::setVar('addSubscriberStatus', '-1' );
						break; // <- Exit Point. Task Failed.
					}
				}

				// Get the model
				$model = $this->getModel();
				// Invoke the add subscriber method
				$addSubscriberStatus=$model->addSubscriber($name,$email);

				// Check the return status and return the appropriate status string to the user
				if($addSubscriberStatus==-1)
				{
					JRequest::setVar('addSubscriberStatus', '-1' );
				  	JRequest::setVar( 'operationStatus', JText::_( 'CC_MSG_EMAIL_EXISTS' ) );
				}
				else if($addSubscriberStatus==1)
				{
					$model->sendMail('subscribe', $email);
				  	JRequest::setVar('addSubscriberStatus', '1' );
					JRequest::setVar( 'operationStatus', JText::_( 'CC_MSG_SUBS_SUCCESS' ) );

				 }
				if($addSubscriberStatus==0)
				{
				  JRequest::setVar('addSubscriberStatus', '0' );
				  JRequest::setVar('operationStatus', JText::_( 'CC_MSG_UNSUBS_FAILED' ) );
				}


			break;

			// remove a subscriber by id
			case 'removeSubscriber':
				// set the view to remove instead of default
				JRequest::setVar( 'view', 'remove' );
				// read in the subscriber id from the get data (URL)
				$removeID = JRequest::getVar( 'id','', 'get', 'string');
				// get the model
				$model = $this->getModel();
				// attempt to remove the subscriber, return status to user via operationStatus variable
				if($model->removeSubscriber($removeID))
				{
					$model->sendMail('unsubscribeid', $removeID);
					JRequest::setVar( 'operationStatus', JText::_( 'CC_MSG_UNSUBS_SUCCESS' ) );
				}
				else
				{
					JRequest::setVar('operationStatus', JText::_( 'CC_MSG_UNSUBS_FAILED' ) );
				}
			break;

			// remove a subscriber by email
			case 'removeSubscriberByEmail':
				// set the view to remove instead of default
				JRequest::setVar( 'view', 'remove' );
				// read in the subscribers email address
				$email = JRequest::getVar( 'email','', 'post', 'string');
				// get the model
				$model = $this->getModel();
				// attempt to remove the subscriber, return status to user via operationStatus variable
				if($model->removeSubscriberByEmail($email))
				{
					$model->sendMail('unsubscribeemail', $email);
					JRequest::setVar( 'operationStatus', JText::_( 'CC_MSG_UNSUBS_SUCCESS' ) );
				}
				else
				{
					JRequest::setVar('operationStatus', JText::_( 'CC_MSG_UNSUBS_FAILED' ) );
				}
			break;

					// remove a subscriber by email
			case 'activate':
				// set the view to remove instead of default
				JRequest::setVar( 'view', 'activate' );
				// read in the subscribers email address
				$code = JRequest::getVar( 'code','', 'get', 'string');
				// get the model
				$model = $this->getModel();

				$activationStatus=$model->activate($code);

				// attempt to remove the subscriber, return status to user via operationStatus variable
				if($activationStatus==0)
				{
				  	JRequest::setVar( 'operationStatus', JText::_( 'CC_ACTIVATION_FAILURE' ) );
				}
				else if($activationStatus==1)
				{
					JRequest::setVar( 'operationStatus', JText::_( 'CC_ACTIVATION_SUCCESS' ) );

				}
			break;

			// no operations required if the task isn't add or remove
			default:
			break;

		}
		parent::display();
	}
}
?>
