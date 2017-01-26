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
class ccNewsletterControllersendNewsletter extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct( $config = array() )
	{
		$this->_ccdata = array();
		parent::__construct( $config );
		//$this->registerTask( 'unpublish',	'publish' );
	}

	function display()
	{
		JRequest::setVar( 'view', 'sendNewsletter');
		JRequest::setVar( 'layout', 'form'  );
		parent::display();
	}
	function send_batch_msg( $ccsend = false )
	{

		echo '<link href="components/com_ccnewsletter/assets/ccnewsleter.css" rel="stylesheet" type="text/css" />';
		flush();

		$subject = JRequest::getVar( 'subject','', 'post', 'string');
		$id = JRequest::getVar( 'newsletterToSend','', 'post', 'string');
		$fromName = JRequest::getVar( 'fromName','', 'post', 'string');
		$fromEmail = JRequest::getVar( 'fromEmail','', 'post', 'string');

		$db =& JFactory::getDBO();
		$query ="SELECT `body`, `name` FROM #__ccnewsletter_newsletters WHERE id='".$id."'";
		$db->setQuery( $query );
		$row     = $db->loadObject();
		$subject =$row->name;

		$query = "SELECT *  FROM #__ccnewsletter_subscribers WHERE `enabled`=1 AND (`lastSentNewsletter` != $id OR `lastSentNewsletter` IS NULL)";
		$db->setQuery( $query );
		$subscribers = $db->loadObjectList();
		// total up number of records to send
		$n = count( $subscribers );
		$str = $subject;
		$subject = htmlentities($str, ENT_QUOTES, 'UTF-8');
		$newsletterModel =$this->getModel('sendNewsLetter');
		$subject = $newsletterModel->UTF8entities($subject);
		$conf_html = '<form action="index.php"><center><div class="main-wrapper">';
		$conf_html .= '<div class="leftheader"></div>';
		$conf_html .= '<div class="middleheader">';
		$conf_html .= '<div class="headertitle">';
		$conf_html .= JText::_( 'CC_NEWSLETTER_TITLE'). '&nbsp;' . JText::_( 'CC_SENDING_BATCH_CONF');
		$conf_html .= '</div>';
		$conf_html .= '</div>';
		$conf_html .= '<div class="rightheader"></div>';
		$conf_html .= '<div class="clear"></div>';
		$conf_html .= '<div class="content-wrapper"><div class="content">';
		$conf_html .= '<div class="status_conf">';
		$conf_html .= JText::_( 'CC_CONFORMATION');
		$conf_html .= '</br>';
		$conf_html .=JText::_( 'CC_CONFORMATION_FIRST');
		$conf_html .= '</div>';
		$conf_html .= '<div class="status">';
		$conf_html .=JText::_( 'CC_SEND_NEWS').'&nbsp;"'.$subject.'"&nbsp;'.JText::_( 'CC_SEND_TO').'&nbsp;'.$n.'&nbsp;'.JText::_( 'CC_SEND_SUB');
		$conf_html .= '</br>';
		$conf_html .= '<div class="confirmation">';
		if ( $ccsend )
		{
			$conf_html.='<a href="index.php?option=com_ccnewsletter&controller=sendNewsletter&task=ccsend_all_first&id='.$id.'">';
		}
		else
		{
			$conf_html.='<a href="index.php?option=com_ccnewsletter&task=send_all&id='.$id.'">';
		}
		$conf_html .=JText::_( 'CC_SEND_YES');
		$conf_html.='</a>'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;';
		$conf_html.='<a href="index.php?option=com_ccnewsletter&controller=sendNewsletter&id='.$id.'">';
		$conf_html .=JText::_( 'CC_SEND_CANCEL');
		$conf_html.='</a>';
		$conf_html .= '</div>';
		$conf_html .= '</div>';
		$conf_html .= '</div></div>';

		echo $conf_html;
		flush();
		exit;
	}

	function send_batch_msg_testing( $ccsend = false )
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		echo '<link href="components/com_ccnewsletter/assets/ccnewsleter.css" rel="stylesheet" type="text/css" />';
		flush();

		//$subject = JRequest::getVar( 'subject','', 'post', 'string');
		$id = JRequest::getVar( 'newsletterToSend','', 'post', 'string');

		$query ="SELECT `body`, `name` FROM #__ccnewsletter_newsletters WHERE id='".$id."'";
		$db->setQuery( $query );
		$row     = $db->loadObject();
		$subject =$row->name;

		$str = $subject;
		$subject = htmlentities($str, ENT_QUOTES, 'UTF-8');
		$newsletterModel =$this->getModel('sendNewsLetter');
		$subject = $newsletterModel->UTF8entities($subject);

		$fromName = JRequest::getVar( 'fromName','', 'post', 'string');
		$fromEmail = JRequest::getVar( 'fromEmail','', 'post', 'string');
		$params = $this->getComponentParameters();
		$testEmailAddress = $params->get('testEmailAddress');

		$query = "SELECT *  FROM #__ccnewsletter_subscribers WHERE `enabled`=1 AND (`lastSentNewsletter` != $id OR `lastSentNewsletter` IS NULL)";
		$db->setQuery( $query );
		$subscribers = $db->loadObjectList();
		// total up number of records to send
		$n = count( $subscribers );
		$conf_html = '<form action="index.php"><center><div class="main-wrapper">';
		$conf_html .= '<div class="leftheader"></div>';
		$conf_html .= '<div class="middleheader">';
		$conf_html .= '<div class="headertitle">';
		$conf_html .= JText::_( 'CC_NEWSLETTER_TEST_TITLE'). '&nbsp;' . JText::_( 'CC_SENDING_TEST_CONF');
		$conf_html .= '</div>';
		$conf_html .= '</div>';
		$conf_html .= '<div class="rightheader"></div>';
		$conf_html .= '<div class="clear"></div>';
		$conf_html .= '<div class="content-wrapper"><div class="content">';

		$conf_html .= '<div class="status">';
		$conf_html .=JText::_( 'CC_TEST_NEWS').'&nbsp;"'.$subject.'"&nbsp;'.JText::_( 'CC_SEND_TO').'&nbsp;'.$testEmailAddress.'&nbsp;'.JText::_( 'CC_TEST_QUESTION');
		$conf_html .= '</br>';
		$conf_html .= '<div class="confirmation">';
		if ( $ccsend )
		{
			$conf_html.='<a href="index.php?option=com_ccnewsletter&controller=sendNewsletter&task=ccsend_all_first&id='.$id.'&testing=1">';
		}
		else
		{
			$conf_html.='<a href="index.php?option=com_ccnewsletter&task=send_all&id='.$id.'">';
		}
		$conf_html .=JText::_( 'CC_SEND_YES');
		$conf_html.='</a>'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;';
		$conf_html.='<a href="index.php?option=com_ccnewsletter&controller=sendNewsletter&id='.$id.'">';
		$conf_html .=JText::_( 'CC_SEND_CANCEL');
		$conf_html.='</a>';
		$conf_html .= '</div>';
		$conf_html .= '</div>';
		$conf_html .= '</div></div>';

		echo $conf_html;
		flush();
		exit;
	}

	/**
	 * @brief Alternative function to confirm sending the newsletter
	 *
	 * @author Emmanuel Guiton <egn@ccdig.fr>
	 * @version 1.0.5
	 * @since 1.0.5
	 * @date September 2009
	 */
	function ccsend()
	{
		$this->send_batch_msg(true);
	}

	function ccsendtesting()
	{

		$this->send_batch_msg_testing(true);
	}

	/**
	 * @brief Initiate first call to ccsend_all()
	 *
	 * @author Emmanuel Guiton <egn@ccdig.fr>
	 * @version 1.0.5
	 * @since 1.0.5
	 * @date September 2009
	 */
	function ccsend_all_first()
	{

		$this->ccsend_all( false );
	}
	function getComponentParameters()
	{
		// get parameters for the form
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
		return $params;
	}

	/**
	 * @brief Alternative controller function to send the newsletter to all the subscribers
	 *
	 * Direct call to this function are considered made from an ajax script.
	 *
	 * @author Emmanuel Guiton <egn@ccdig.fr>
	 * @version 1.0.5
	 * @since 1.0.5
	 * @date September 2009
	 *
	 * @param[in] $ajax tell if this is the first call to this function or if it is a subsequent call made from the ajax script
	 */
	function ccsend_all( $ajax = true )
	{
		global $mainframe;

		if ( $ajax )
		{
			ob_clean(); // Clean the output buffer
			header('Content-Type: text/xml'); // Set sent content as XML
			echo '<?xml version="1.0"?>';
		}

		$newsletterModel =& $this->getModel( 'sendNewsletter' );
		$newsletterModel->ccsend_all( $ajax );

		if ( !$ajax )
		{
			// Display sending interface
			$view = & $this->getView( 'sendnewsletter', 'html' );
			// Push the model into the view
			$view->setModel($newsletterModel, true);
			// Set the layout
			$view->setLayout( 'ccsend' );
			$view->display();

			return true; // <-Exit Point. Task Successful.
		}
		else
		{
			$ccdata = $newsletterModel->get_ccdata();
			foreach( $ccdata['results'] as $result )
			{
				?><tr>
					<td style="text-align: center;"><?php echo $result['index']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td style="text-align: center;"><?php echo $result['sent']; ?></td>
				</tr><?php
			}
			if ( isset($ccdata['message']) )
			{
				?><input id="stop" value="stop" type="hidden" /><?php
			}
			// Discards any further HTML output
			ob_flush(); // Sends the output buffer
			exit; // Stops the script
		}
	}
}
?>


