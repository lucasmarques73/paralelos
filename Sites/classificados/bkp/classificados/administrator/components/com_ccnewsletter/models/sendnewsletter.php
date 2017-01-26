<?php
/**
* @package ccNewsletter
* @version 1.0.9
* @author  Chill Creations <info@chillcreations.com>
* @link    http://www.chillcreations.com
* @copyright Copyright (C) 2008 - 2010 Chill Creations-All rights reserved
* @copyright Copyright (C) Copyright 2010 Elodig- All rights reserved
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

jimport('joomla.application.component.model');

class ccNewsletterModelsendNewsLetter extends JModel
{
	/// @brief Contains data for alternative newsletter sending
	//private $_ccdata;

	var $_ccdata;
//or just:
//$cart;

	function __construct()
	{
		parent::__construct();
		$this->set_current_newsletter();
	}
	function getAllNewsletters()
	{
		$db =& JFactory::getDBO();
		$query = "SELECT *, CONCAT(id,' - ', name) AS idname FROM #__ccnewsletter_newsletters ORDER BY id DESC";
		$db->setQuery( $query );
		$available_newsletters = $db->loadObjectList();
		//$this->availableNewsletters=$available_newsletters;
		return $available_newsletters;

	}
	function getComponentParameters()
	{
		// get parameters for the form
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
		return $params;
	}

	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData($select)
	{
		$row =& JTable::getInstance('newsletter', 'Table');
		$row->load( $select );
		return $row;
	}

	function &getDataId()
	{
		$ccrow =& JTable::getInstance('newsletter', 'Table');
		$ccrow->load( $this->_id );
		return $ccrow;
	}

	function set_current_newsletter()
	{
		// get the currently selected newsletter to send (consume post data)
		$current_select_val=JRequest::getVar( 'newsletterToSend','', 'post', 'string');
		// if the select box hasn't been used yet then current_select_val has not been set, provide a default value for it.
		if(!$current_select_val) {
			$available_newsletters=$this->getAllNewsletters();
			$current_select_val=$available_newsletters[0]->id;
		}

		// set the id of the current newsletter
		$this->setId((int)$current_select_val);
	}

	// functon to covert image tags from relative to absolute paths
	// TODO: This breaks if your image is already an aboslute path
	function convertImgTags($html_content)
	{
		//print_r($html_content);

		global $mainframe;
		$mod_html_content=null;
		$patterns = array();
		$replacements = array();
		$i = 0;
		$src_exp = "/src=\"(.*?)\"/";
		$link_exp =  "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";

		preg_match_all($src_exp, $html_content, $out, PREG_SET_ORDER);

		foreach ($out as $val)
		{
			$links = preg_match($link_exp, $val[1], $match, PREG_OFFSET_CAPTURE);
			if($links=='0')
			{
				$patterns[$i] = $val[1];
				$patterns[$i]="\"$val[1]";
				//print_r($patterns[$i]);
				$replacements[$i] = JURI::root().$val[1];
				$replacements[$i]="\"$replacements[$i]";
			}
			$i++;
	 }
        $mod_html_content=str_replace($patterns,$replacements,$html_content);
		return $mod_html_content;
	}

	// function to convert the images used in a background tag
	// TODO: I think this breaks if your background in a table is a color
	function convertBackgroundTags($html_content)
	{

		global $mainframe;
		$mod_html_content=null;
		$patterns = array();
		$replacements = array();
		$i = 0;
		$src_exp = "/background=\"(.*?)\"/";
		$link_exp =  "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
		preg_match_all($src_exp, $html_content, $out, PREG_SET_ORDER);
		foreach ($out as $val)
		{
			$links = preg_match($link_exp, $val[1], $match, PREG_OFFSET_CAPTURE);
			if($links=='0')
			{
				$patterns[$i] = $val[1];
				$patterns[$i]="\"$val[1]";
				//print_r($patterns[$i]);
				$replacements[$i] = JURI::root().$val[1];
				$replacements[$i]="\"$replacements[$i]";
			}
			$i++;
	 	}
		 $mod_html_content=str_replace($patterns,$replacements,$html_content);
		//echo $mod_html_content;
		return $mod_html_content;
	}


	// function to create the "unsubscribe link"
	function convertUnsubscribeLink($html_content,$subscriberID)
	{
		global $mainframe;
		$mod_html_content=null;
		$unsubscribelink = "unsubscribe link";
		//$unsubscribeString='<a href="'.JURI::root().'index.php?option=com_ccnewsletter&task=removeSubscriber&id='.md5($subscriberID).'">['.JText::_( 'CC_UNSUBSCRIBE' ).']</a>';
		$unsubscribeString='<a href="'.JURI::root().'index.php?option=com_ccnewsletter&task=removeSubscriber&id='.md5($subscriberID).'">'.JText::_( 'CC_UNSUBSCRIBE_LINK' ).'</a>';
		$mod_html_content=str_replace("[".$unsubscribelink."]" ,$unsubscribeString,$html_content);
		return $mod_html_content;
	}
	// function to generate the subscriber name
	function convertSubscribeName($html_content,$subscriberName)
	{
		global $mainframe;
		$mod_html_content=null;
		$name = "name";
		$mod_html_content=str_replace("[".$name."]", $subscriberName, $html_content);
		return $mod_html_content;
	}

	function convertInternalLink($body)
	{
		global $mainframe;
		$patterns = array();
		$replacements = array();
		$i = 0;
		$href_exp = "/href=\"(.*?)\"/";
		$link_exp = "[^http:\/\/www\.|^www\.|^http:\/\/|^skype:|^callto:|^callto:|^mailto:|^#|^https:\/\/]";
		preg_match_all($href_exp, $body, $out, PREG_SET_ORDER);
		foreach ($out as $val)
		{
			$links = preg_match($link_exp, $val[1], $match, PREG_OFFSET_CAPTURE);
			if(!$links)
			{
				$link_exp3 = "[^..\/]";
				$links3 = preg_match($link_exp3, $val[1], $match3, PREG_OFFSET_CAPTURE);
				if($links3)
				{
					/*$val[1] = str_replace('../', '', $val[1]);*/
					$patterns[$i] = 'href="'. $val[1] . '"';
					$replacements[$i] = 'href="'. JURI::root().$val[1] . '"';
					$body=str_replace($patterns[$i],$replacements[$i],$body);
					$i++;
				}
				else
				{
					$patterns[$i] = 'href="'. $val[1] . '"';
					$replacements[$i] = 'href="'. JURI::root().$val[1] . '"';
					$body=str_replace($patterns[$i],$replacements[$i],$body);
					$i++;
				}
			}
			$link_exp1 = "[^http:\/\/www\.|^www\.|^http:\/\/]";
			$links1 = preg_match($link_exp1, $val[1], $match1, PREG_OFFSET_CAPTURE);
			if($links1)
			{
				$link_exp2 = "[^www\.]";
				$links2 = preg_match($link_exp2, $val[1], $match2, PREG_OFFSET_CAPTURE);
				if($links2)
				{
				$patterns[$i] = 'href="'. $val[1] . '"';
				$replacements[$i] = "href=http://".$val[1];
				$body=str_replace($patterns[$i],$replacements[$i],$body);
				$i++;
				}
			}
		}
		return $body;
	}


	/**
	 * @brief Get model data for alternative newsletter sending
	 *
	 * @author Emmanuel Guiton <egn@ccdig.fr>
	 * @version 1.0.5
	 * @since 1.0.5
	 * @date September 2009
	 */
	function get_ccdata()
	{
		return $this->_ccdata;
	}

	function UTF8entities($content="")
	{
         return "<html><head><meta content=\"text/html; charset=utf-8\" http-equiv=\"content-type\"></head><body>".$content."</body></html>";

        }

	/**
	 * @brief Alternative model function to send the newsletter to all the subscribers
	 *
	 * Freely inspired (means a lot of copy/paste) from the send_all() member function.<br />
	 *
	 * @author Emmanuel Guiton <egn@ccdig.fr>
	 * @version 1.0.5
	 * @since 1.0.5
	 * @date September 2009
	 *
	 * @param[in] $ajax tell if this is the first call to this function or if it is a subsequent call made from the ajax script
	 */
	function ccsend_all( $ajax )
	{
		global $mainframe;
		$testing = JRequest::getVar( 'testing', '', 'get', 'string');

		$params = $this->getComponentParameters();
		$scripttimeout = $params->get('scripttimeout');
		$emailperbatch = $params->get('emailperbatch');
		$batchinterval = $params->get('batchinterval');
		$fromName = $params->get('fromName');
		$fromEmail = $params->get('fromEmail');

		$id = JRequest::getVar( 'id');
		//echo 'id='.$id;
		$db      =& JFactory::getDBO();
		$query   = "SELECT `body`, `name` FROM #__ccnewsletter_newsletters WHERE id='".$id."'";
		$db->setQuery( $query );
		$row     = $db->loadObject();
		$body    = $row->body;
		$subject = $row->name;

		jimport('joomla.mail.helper');
		$mail = JFactory::getMailer();

		if (!$body)
		{
			$msg = JText::_( 'CC_MSG_BODY_EMPTY' );
			$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
			$mainframe->redirect($link, $msg);
			return false; // <-Exit Point. Task Failed.
		}

		// extract from name and validate
		//$fromName = JRequest::getVar( 'fromName','', 'post', 'string');
		if (!$fromName)
		{
			$msg = JText::_( 'CC_MSG_FROMNAME_EMPTY' );
			$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
			$mainframe->redirect($link, $msg);
			return false; // <-Exit Point. Task Failed.
		}

		// extract from email and validate
		//$fromEmail = JRequest::getVar( 'fromEmail','', 'post', 'string');
		if (!$fromEmail)
		{
			$msg = JText::_( 'CC_MSG_FROMEMAIL_EMPTY');
			$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
			$mainframe->redirect($link, $msg);
			return false; // <-Exit Point. Task Failed.
		}

		// get the model, we need to get the test email address

		$testEmailAddress = $params->get('testEmailAddress');

		// validate test email
		if (!$testEmailAddress)
		{
			$msg = JText::_( "The test email address is empty! Send Message routine aborted.");
			$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
			$mainframe->redirect($link, $msg);
			return false; // <- Exit Point. Task Failed.
		}

		// extract subject and validate
		//$subject = JRequest::getVar( 'subject','', 'post', 'string');
		if (!$subject)
		{
			$msg = JText::_( 'CC_MSG_TESTEMAIL_EMPTY' );
			$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter';
			$mainframe->redirect($link, $msg);
			return false; // <- Exit Point. Task Failed.
		}

		if($testing)
		{
			//all fields have been validated, send the test email as a copy
			$testSubject= $subject;
			$testname = "name";
			$testunsubscribelink = "unsubscribe link";

			$testbody = str_replace("[".$testname."]", "[".JText::_( 'CC_TESTNAME_REPLACE' )."]", $body);
			$testbody = str_replace("[".$testunsubscribelink."]", "[".JText::_( 'CC_TESTEMAIL_REPLACE' )."]", $testbody);

			$testbody=$this->convertImgTags($testbody);
			$testbody=$this->convertBackgroundTags($testbody);
			$testbody=$this->convertInternalLink($testbody);

			//$sendEmailStatus=JUtility::sendMail($fromEmail, $fromName, $testEmailAddress, $testSubject, $testbody,1);
			$mail->addRecipient( $testEmailAddress);
			$mail->setSender( array( $fromEmail, $fromName ) );
			$mail->addReplyTo( array( $fromEmail, $fromName ) );
			$mail->setSubject( $testSubject );

			// --- BEGIN : Embed images in the e-mail content ---
			// author : Emmanuel Guiton <egn@ccdig.fr>

			$phpversion = phpversion();
			if($phpversion>=5)
			{
				$doc = new DOMDocument();
				$testbody = htmlentities($testbody, ENT_NOQUOTES, 'UTF-8');
				$testbody = htmlspecialchars_decode($testbody);
				$testbody = $this->UTF8entities($testbody);
				@$doc->loadHTML($testbody);
				$imgs = $doc->getElementsByTagName('img');
				$embedded_images=array();
				foreach ($imgs as $img)
				{
					$src = $img->getAttributeNode('src');
					$img_url = $src->value;
					$site_url = JURI::base();
					$site_url = str_replace('/administrator', '', $site_url);
					$img_url = str_replace($site_url, '', $img_url);
					$link_exp = "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
					$links = preg_match($link_exp, $img_url, $match, PREG_OFFSET_CAPTURE);
					if(!$links)
					{
						$img_url = '../'.$img_url;
						$dot_pos = strrpos($img_url, '.');
						$extension = substr($img_url, $dot_pos+1);
						$cid = basename($img_url, '.'.$extension);
						$src->value = 'cid:'.$cid;
						if ($extension == 'jpeg')
						$extension = 'jpg';
						if ( !isset($embedded_images[$src->value]))
						{
							$mail->AddEmbeddedImage( $img_url, $cid, $cid, "base64", "image/".$extension);
							$embedded_images[$src->value] = 1;
						}
					}
				}
				$testbody = $doc->saveHTML();
				// --- END : Embed images in the e-mail content ---
				$mail->setBody( $testbody );
				$mail->WordWrap = "1";
				$mail->IsHTML(true);
				$sent = $mail->Send();
				// set user message and redirect back.
				$msg = JText::_( 'CC_MSG_TESTMAIL_SENT' ) .'&nbsp;'. $testEmailAddress;
				$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter&id='.$id;
				$mainframe->redirect($link, $msg);
			}
			else
			{
				$testbody = htmlentities($testbody, ENT_NOQUOTES, 'UTF-8');
				$testbody = htmlspecialchars_decode($testbody);
				$testbody = $this->UTF8entities($testbody);

				$mail->setBody( $testbody );
				$mail->WordWrap = "1";
				$mail->IsHTML(true);
				$sent = $mail->Send();
				// set user message and redirect back.
				$msg = JText::_( 'CC_MSG_TESTMAIL_SENT' ) .'&nbsp;'. $testEmailAddress;
				$link = 'index.php?option=com_ccnewsletter&controller=sendNewsletter&id='.$id;
				$mainframe->redirect($link, $msg);
			}
		}
		else
		{
			if ( !$ajax )
			{
				$testname = "name";
				$testunsubscribelink = "unsubscribe link";
				//all fields have been validated, send the test email as a copy
				$testSubject=JText::_( 'CC_COPY_OF' ) .' ' . $subject;
				$testbody = str_replace("[".$testname."]", "[".JText::_( 'CC_TESTNAME_REPLACE' )."]", $body);
				$testbody = str_replace("[".$testunsubscribelink."]", "[".JText::_( 'CC_TESTEMAIL_REPLACE' )."]", $testbody);

				$testbody=$this->convertImgTags($testbody);
				$testbody=$this->convertBackgroundTags($testbody);
				$testbody=$this->convertInternalLink($testbody);

				//$sendEmailStatus=JUtility::sendMail($fromEmail, $fromName, $testEmailAddress, $testSubject, $testbody,1);
				$mail->addRecipient( $testEmailAddress);
				$mail->setSender( array( $fromEmail, $fromName ) );
				$mail->addReplyTo( array( $fromEmail, $fromName ) );
				$mail->setSubject( $testSubject );

				$phpversion = phpversion();
				if($phpversion>=5)
				{
					// --- BEGIN : Embed images in the e-mail content ---
					// author : Emmanuel Guiton <egn@ccdig.fr>
					$doc = new DOMDocument();
					$testbody = htmlentities($testbody, ENT_NOQUOTES, 'UTF-8');
					$testbody = htmlspecialchars_decode($testbody);
					$testbody = $this->UTF8entities($testbody);
					@$doc->loadHTML($testbody);
					$imgs = $doc->getElementsByTagName('img');
					$embedded_images=array();
					foreach ($imgs as $img)
					{
						$src = $img->getAttributeNode('src');
						$img_url = $src->value;
						$site_url = JURI::base();
						$site_url = str_replace('/administrator', '', $site_url);
						$img_url = str_replace($site_url, '', $img_url);
						$link_exp = "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
						$links = preg_match($link_exp, $img_url, $match, PREG_OFFSET_CAPTURE);
						if(!$links)
						{
							$img_url = '../'.$img_url;
							$dot_pos = strrpos($img_url, '.');
							$extension = substr($img_url, $dot_pos+1);
							$cid = basename($img_url, '.'.$extension);
							$src->value = 'cid:'.$cid;
							if ($extension == 'jpeg')
							$extension = 'jpg';
							if ( !isset($embedded_images[$src->value]))
							{
								$mail->AddEmbeddedImage( $img_url, $cid, $cid, "base64", "image/".$extension);
								$embedded_images[$src->value] = 1;
							}
						}
					}
					$testbody = $doc->saveHTML();
					// --- END : Embed images in the e-mail content ---
					$mail->setBody( $testbody );
					$mail->WordWrap = "1";
					$mail->IsHTML(true);
					$sent = $mail->Send();
				}
				else
				{
					$testbody = htmlentities($testbody, ENT_NOQUOTES, 'UTF-8');
					$testbody = htmlspecialchars_decode($testbody);
					$testbody = $this->UTF8entities($testbody);
					$mail->setBody( $testbody );
					$mail->WordWrap = "1";
					$mail->IsHTML(true);
					$sent = $mail->Send();
				}

			}


			// Find the number of already sent messages
			$query = "SELECT * FROM `#__ccnewsletter_subscribers` WHERE `enabled`=1 AND `lastSentNewsletter` IS NOT NULL AND `lastSentNewsletter` = $id";
			$db->setQuery( $query );
			$db->query();
			$index = $db->getNumRows();

			// Select the e-mail addresses to which the newsletter must be sent
			$query = "SELECT * FROM `#__ccnewsletter_subscribers` WHERE `enabled`=1 AND (`lastSentNewsletter` IS NULL OR `lastSentNewsletter` != $id) ORDER BY `id` ASC LIMIT 0, $emailperbatch";
			$db->setQuery( $query );
			$subscribers = $db->loadObjectList();
			$this->_ccdata['results'] = array();
			if(count($subscribers) > 0 )
			{
			foreach ( $subscribers as $subscriber )
			{
				$index++;
				// Send individual e-mail
				$email = JFactory::getMailer();

				$query   = "SELECT * FROM #__users WHERE email='$subscriber->email'";
				$db->setQuery( $query );
				$usermail     = $db->loadObject();
				$userexists = count($usermail);

				$convertedBody=$this->convertUnsubscribeLink($body,$subscriber->id);
				if($userexists)
				{
					if(($subscriber->name)&&($usermail->email))
					{
						$convertedBody=$this->convertSubscribeName($convertedBody,$subscriber->name);
					}
					elseif(($subscriber->name=="")&&($usermail->email))
					{
						$convertedBody=$this->convertSubscribeName($convertedBody,$usermail->username);
					}
					elseif(($subscriber->name)&&($usermail->email==""))
					{
						$convertedBody=$this->convertSubscribeName($convertedBody,$subscriber->name);
					}
					elseif(($subscriber->name=="")&&($usermail->email==""))
					{
						$convertedBody=$this->convertSubscribeName($convertedBody,$subscriber->name);
					}
				}
				else
				{
					$convertedBody=$this->convertSubscribeName($convertedBody,$subscriber->name);
				}


				$convertedBody=$this->convertImgTags($convertedBody);
				$convertedBody=$this->convertBackgroundTags($convertedBody);
				$convertedBody=$this->convertInternalLink($convertedBody);

				$email->addRecipient( $subscriber->email );
				$email->setSender( array( $fromEmail, $fromName ) );
				$email->addReplyTo( array( $fromEmail, $fromName ) );
				$email->setSubject( $subject );

				$phpversion = phpversion();
				// --- BEGIN : Embed images in the e-mail content ---
				// author : Emmanuel Guiton <egn@ccdig.fr>
				if($phpversion>=5)
				{
					$doc = new DOMDocument();
					$convertedBody = htmlentities($convertedBody, ENT_NOQUOTES, 'UTF-8');
					$convertedBody = htmlspecialchars_decode($convertedBody);
					$convertedBody = $this->UTF8entities($convertedBody);
					@$doc->loadHTML($convertedBody);
					$imgs = $doc->getElementsByTagName('img');
					$embedded_images=array();
					foreach ($imgs as $img)
					{
						$src = $img->getAttributeNode('src');
						$img_url = $src->value;
						$site_url = JURI::base();
						$site_url = str_replace('/administrator', '', $site_url);
						$img_url = str_replace($site_url, '', $img_url);
						$link_exp = "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
						$links = preg_match($link_exp, $img_url, $match, PREG_OFFSET_CAPTURE);
						if(!$links)
						{
							$img_url = '../'.$img_url;
							$dot_pos = strrpos($img_url, '.');
							$extension = substr($img_url, $dot_pos+1);
							$cid = basename($img_url, '.'.$extension);
							$src->value = 'cid:'.$cid;
							if ($extension == 'jpeg')
							$extension = 'jpg';
							if ( !isset($embedded_images[$src->value]))
							{
								$email->AddEmbeddedImage( $img_url, $cid, $cid, "base64", "image/".$extension);
								$embedded_images[$src->value] = 1;
							}
						 }
				    }
					$convertedBody = $doc->saveHTML();
					// --- END : Embed images in the e-mail content ---

					$email->setBody( $convertedBody );
					$email->WordWrap = "1";
					$email->IsHTML(true);
					$email->Send();
				}
				else
				{
					$convertedBody = htmlentities($convertedBody, ENT_NOQUOTES, 'UTF-8');
					$convertedBody = htmlspecialchars_decode($convertedBody);
					$convertedBody = $this->UTF8entities($convertedBody);
					$email->setBody( $convertedBody );
					$email->WordWrap = "1";
					$email->IsHTML(true);
					$email->Send();
				}


			// Set the newsletter as sent
			$query = "UPDATE `#__ccnewsletter_subscribers` SET `lastSentNewsletter`=$id WHERE `id`=".$subscriber->id;
			$db->setQuery( $query );
			$db->query();

			// Record result
			if ($email->error_count > 0)
				$sent = '<img src="components/com_ccnewsletter/assets/publish_x.png" width="16" height="16" />';
			else
				$sent = '<img src="components/com_ccnewsletter/assets/tick.png" width="16" height="16" />';
			$this->_ccdata['results'][] = array('index' => $index, 'email' => $subscriber->email, 'sent' => $sent);
		}
		}

		// Set the message id in the ccdata
		$this->_ccdata['message_id'] = $id;
		$this->_ccdata['batchinterval'] = $batchinterval;

		// Check if the process is finished
		$query = "SELECT *  FROM `#__ccnewsletter_subscribers` WHERE `enabled`=1 AND (`lastSentNewsletter` IS NULL OR `lastSentNewsletter` != $id) ORDER BY `id` ASC LIMIT 0, $emailperbatch";
		$db->setQuery( $query );
		$db->query();
		$total = $db->getNumRows();
		if ( $total == 0 )
		{
			$this->_ccdata['ajax'] = false;
			// Reset the sent status of all the rows
			$query = "UPDATE `#__ccnewsletter_subscribers` SET `lastSentNewsletter`= NULL";
			$db->setQuery( $query );
			$db->query();

			// Set process completed.
			if ( $ajax )
				$this->_ccdata['message'] = JText::_( 'CC_SUCCESS', true ); // Make it javascript safe for ajax
			else
			{
				$mainframe->enqueueMessage( JText::_( 'CC_SUCCESS' ) );
				$this->_ccdata['message'] = '';
			}
		}
		else
		{
			$this->_ccdata['ajax'] = true;
			if ( !$ajax)
			{
				$msg  = JText::_("CC_PLEASE_WAIT");
				$mainframe->enqueueMessage($msg);
			}
		}
		}
	}
}
?>
