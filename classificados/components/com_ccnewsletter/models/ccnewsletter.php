<?php
/**
 * ccNewsletter
 * @author Chill Creations <info@chillcreations.com>
 * @link http://www.chillcreations.com
 * @license GNU/GPL
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class ccNewsletterModelccNewsletter extends JModel
{
	/* this function adds a subscriber to the ccNewsletter.subscribers table
	the function first checks to ensure the email address isn't already stored
	in the table */

	function addSubscriber($name,$email)
	{
		// get database handle
		$db=& JFactory::getDBO();

		// build query to check if the email address exists in the database
		$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='".$email."'";
		$db->setQuery($query);
		$rows=$db->loadObjectList();
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
		$status = $params->get('status');
		$activation = $params->get('activation');
		// if there was a record in the database with this email address then don't add it again!
		if(sizeof($rows))
		{
			//return -1; // <- Exit Point, Task Failed.
			$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='".$email."' AND enabled='1'";
			$db->setQuery($query);
			$rows1=$db->loadObjectList();
			if(sizeof($rows1))
			{
				return -1;
			}
			else
			{
				$query = "SELECT * from #__ccnewsletter_acknowledgement WHERE id=1 LIMIT 1" ;
				$db->setQuery($query);
				$row = $db->loadObject();

				if ($activation)
				{
					return 1;
				}
				else
				{

					$query = "UPDATE #__ccnewsletter_subscribers"
					. " SET enabled = 1, sdate =' ".date('Y-m-d H:i:s', time())."'  WHERE email='".$email."'";

					$db->setQuery( $query );

					if (!$db->query())
					{
						return JError::raiseWarning( 500, $db->getErrorMsg() );
					}
				}
			}
		}
		else
		{

			$targetRow =& JTable::getInstance('subscriber', 'Table');

			$targetRow->set('id', 0);
			$targetRow->set('name', $name);
			$targetRow->set('email', $email);

			$query = "SELECT * from #__ccnewsletter_acknowledgement WHERE id=1 LIMIT 1" ;
			$db->setQuery($query);
			$row = $db->loadObject();

			if ($activation)
			{
				$targetRow->set('enabled', 0);
			}
			else
			{
				$targetRow->set('enabled', 1);
			}

			$targetRow->set('plainText', 0);
			$targetRow->set('sdate', date('Y-m-d H:i:s', time()));

			if(!$targetRow->store())
			{
				return 0; // <- Exit Point. Task Failed.
			}

		}

		return 1; // <- Exit Point. Task Succeeded
	}

	/* this functio removes a subscriber from the database based on their subscriber ID
	this method is only called when a user presses the unsubscribe link in a newsletter */

	function removeSubscriber($subscriber_id)
	{
		// get database handle
		$db=& JFactory::getDBO();

		$query = "UPDATE #__ccnewsletter_subscribers "
			. " SET enabled = 0  WHERE MD5(id)='".$subscriber_id."'";

		$db->setQuery( $query );

		if (!$db->query())
		{
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		$num_rows = $db->getAffectedRows();

		if($num_rows)
		{
			return true;
		}

		else
		{
			return false; // <- Exit Point. Task Failed.
		}
	}

	/* this functon removes a subscriber from the database based on their subscriber email address
	this method is called when a subscriber uses a form on the website to unsubscribe */
	function removeSubscriberByEmail($email)
	{
		// get database handle
		$db=& JFactory::getDBO();

		$query = "UPDATE #__ccnewsletter_subscribers "
			. " SET enabled = 0  WHERE email='".$email."'";

		$db->setQuery( $query );

		if (!$db->query())
		{
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		$num_rows = $db->getAffectedRows();

		if($num_rows)
		{
			return true;
		}

		else
		{
			return false; // <- Exit Point. Task Failed.
		}
	}

	/* this functon activate the email from checking the activation code */
	function activate($code)
	{
		// get database handle
		$db=& JFactory::getDBO();
		$query = 'SELECT id FROM #__ccnewsletter_subscribers'
		. ' WHERE md5(id) = '.$db->Quote($code)
		. ' LIMIT 0, 1'
		;
		$db->setQuery( $query );
		$row = $db->loadObject();

		if( $row->id )
		{
			$query = 'UPDATE #__ccnewsletter_subscribers SET enabled = 1'
			.' WHERE md5(id) = '.$db->Quote($code);
			$db->setQuery($query);
			$db->query();
			$total = $db->getAffectedRows();
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function UTF8entities($content="")
	{
		return "<html><head><meta content=\"text/html; charset=utf-8\" http-equiv=\"content-type\"></head><body>".$content."</body></html>";
         }
	function sendmail($subscribetask, $data)
	{
		$db=& JFactory::getDBO();

		$query = "SELECT * from #__ccnewsletter_acknowledgement WHERE id=1 LIMIT 1" ;

		$db->setQuery($query);
		$row = $db->loadObject();
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );

		$status = $params->get('status');
		$activation = $params->get('activation');

		if (!$status || $activation)
		{
			if($subscribetask == 'subscribe' )
			{
				$body = $row->subs_content;
				$subject = $row->subs_title;
				$email = $data;

				$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='".$email."'";
				$db->setQuery($query);
				$row1 = $db->loadObject();
				$name = $row1->name;
				$id = $row1->id;
				$convertedBody=ccNewsletterModelccNewsletter::convertUnsubscribeLink($body, $row1->id);

				$query   = "SELECT * FROM #__users WHERE email='$email'";
				$db->setQuery( $query );
				$usermail     = $db->loadObject();
				$userexists = count($usermail);

				if($userexists)
				{
					if(($name)&&($usermail->email))
					{
						$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($convertedBody, $name);
					}
					elseif(($name=="")&&($usermail->email))
					{
						$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($convertedBody, $usermail->username);
					}
					elseif(($name)&&($usermail->email==""))
					{
						$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($convertedBody, $name);
					}
					elseif(($name=="")&&($usermail->email==""))
					{
						$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($convertedBody, $name);
					}
				}
				else
				{
					$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($convertedBody, $name);
				}

				if($activation)
				{
					$convertedBody=ccNewsletterModelccNewsletter::convertActivation($convertedBody, $row1->id);
				}
			}
			else if(!$status && $subscribetask == 'unsubscribeid' )
			{
				$body = $row->unsubs_content;
				$subject = $row->unsubs_title;
				$id = $data;

				$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE MD5(id)='".$id."'";
				$db->setQuery($query);
				$row2 = $db->loadObject();
				$name = $row2->name;
				$email = $row2->email;

				$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($body, $name);
				if($activation)
				{
					$convertedBody=ccNewsletterModelccNewsletter::convertActivation($convertedBody, $row2->id);
				}
			}
			else if(!$status && $subscribetask == 'unsubscribeemail' )
			{
				$body = $row->unsubs_content;
				$subject = $row->unsubs_title;
				$email = $data;

				$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='".$email."'";
				$db->setQuery($query);
				$row3 = $db->loadObject();
				$name = $row3->name;

				$convertedBody=ccNewsletterModelccNewsletter::convertSubscribeName($body, $name);
				if($activation)
				{
					$convertedBody=ccNewsletterModelccNewsletter::convertActivation($convertedBody, $row3->id);
				}
			}
			else
			{
				return false;
			}


			// load up parameters for use in the template
			$fromName = $params->get('fromName');
			$fromEmail = $params->get('fromEmail');
			if(!$convertedBody || !$subject || !$name || !$email || !$fromName || !$fromEmail)
			{
				return false;
			}
			$convertedBody=ccNewsletterModelccNewsletter::convertImgTags($convertedBody);
			$convertedBody=ccNewsletterModelccNewsletter::convertBackgroundTags($convertedBody);
			$convertedBody=ccNewsletterModelccNewsletter::convertInternalLink($convertedBody);

			// send the email
			jimport('joomla.mail.helper');

			//$sendEmailStatus=JUtility::sendMail($fromEmail, $fromName, $email, $subject, $convertedBody, 1);
			$mail = JFactory::getMailer();

			$mail->addRecipient( $email );
			$mail->setSender( array( $fromEmail, $fromName ) );
			$mail->addReplyTo( array( $fromEmail, $fromName ) );
			$mail->setSubject( $subject );

			$phpversion = phpversion();
			if($phpversion>=5)
			{
				// author : Emmanuel Guiton <egn@ccdig.fr>
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
							$mail->AddEmbeddedImage( $img_url, $cid, $cid, "base64", "image/".$extension);
							$embedded_images[$src->value] = 1;
						}
					}
				}
				$testbody = $doc->saveHTML();
				// --- END : Embed images in the e-mail content ---
				$mail->setBody($convertedBody);
				$mail->IsHTML(true);
				$sent = $mail->Send();
				}
				else
				{
						$convertedBody = htmlentities($convertedBody, ENT_NOQUOTES, 'UTF-8');
						$convertedBody = htmlspecialchars_decode($convertedBody);
						$convertedBody = $this->UTF8entities($convertedBody);
						$mail->setBody($convertedBody);
						$mail->IsHTML(true);
						$sent = $mail->Send();
				}

			return true;
		}
		else
		{
			return false;
		}
	}
	// function to create the "unsubscribe link"
	function convertUnsubscribeLink($html_content,$subscriberID)
	{
		global $mainframe;
		$mod_html_content=null;
		$unsubscribelink = "unsubscribe link";
		$unsubscribeString='<a href="'.JURI::root().'index.php?option=com_ccnewsletter&task=removeSubscriber&id='.md5($subscriberID).'">'.JText::_( 'CC_UNSUBSCRIBE_LINK' ).'</a>';
		$mod_html_content=str_replace("[".$unsubscribelink."]", $unsubscribeString, $html_content);
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
		// function to create the "unsubscribe link"
	function convertActivation($html_content,$subscriberID)
	{
		global $mainframe;
		$mod_html_content=null;
		$activationlink=  "activate link";
		$activateString='<a href="'.JURI::root().'index.php?option=com_ccnewsletter&task=activate&code='.md5($subscriberID).'">'.JText::_( 'CC_ACTIVATION_LINK' ).'</a>';
		$mod_html_content=str_replace("[".$activationlink."]",$activateString,$html_content);
		return $mod_html_content;
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
		$link_exp = "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
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
		$link_exp = "[^http:\/\/www\.|^www\.|^https:\/\/|^http:\/\/]";
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
}
