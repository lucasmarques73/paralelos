<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

jimport ( 'joomla.application.component.controller' );
jimport ( 'joomla.utilities.date' );
require_once(JPATH_COMPONENT.DS.'SecureImage'.DS.'securimage.php');
class webeecommentController_ extends JController {
	
	/**
	 * Custom Constructor
	 */
	//DEVNOTE: register task - Register (map) a task to a method in the class
	//function registerTask( $task, $method )
	function __construct($default = array()) {
		parent::__construct ( $default );
	}
	
	/**
	 * Cancel operation
	 */
	function cancel() {
		$this->setRedirect ( 'index.php' );
	}
	
	function display() {

		global $mainframe;
		$ipAddress = $_SERVER["REMOTE_ADDR"];
		$jSession = &JFactory::getSession();
		$articleId = JRequest::getVar ( 'articleId' );
		$activeUser = & JFactory::getUser ();
		$params = & JComponentHelper::getParams ( 'com_webeecomment' );
		$commentText = $params->get ( 'commentText', 'Comments' );
		$allowGuests = $params->get ( 'allowGuests', 0 );
		$guestStatus = $params->get ( 'guestStatus', 0 );
		$userStatus = $params->get ( 'userStatus', 1 );
		$emailRequired = $params->get ( 'emailRequired', 1 );
		$showWebsite = $params->get ( 'showWebsite', 1 );
		$authorLink = $params->get ( 'authorLink', 1 );
		$useCaptcha = $params->get('useCaptcha', 1);
		$bbCode = $params->get('bbCode', 1);
		$useCss = $params->get('useCss', 0);
		$useDojo = $params->get('useDojo', 0);
		$openComments = $params->get ( 'openComments', 0 );
		$orderBy = $params->get ( 'orderBy', 'ASC');
		$dateFormat = $params->get ( 'dateFormat', '%A, %B %e, %Y at %I:%M %p');
		$message = "";
		$error = "";
		$sq = "'";
		$html = "";
		switch ( $this->_task) {
			case "default" :
				$param = "default";
			break;
			case "Delete" :
				$param = "delete";
			break;
			case "add" :
				$param = "add";
			break;
			case "save" :
				//////////////////////////////////////////////
				//   Handle Save Comment Functionality      //
				//////////////////////////////////////////////
				
				if ($useCaptcha == 1)
				{
					$securimage = new Securimage($jSession);
					$captcha_code = JRequest::getVar('captcha_code');
					$saved_code = $jSession->get('secureimage_code_value');
					if (strtolower($saved_code) != strtolower($captcha_code)) 
					{
					  // 	the code was incorrect
  				  	// handle the error accordingly with your other error checking
						$error = JText::_('CAPTCHA INVALID');
			  				
					}
				}
				
				
				if (! $activeUser->guest) {
					$user = $activeUser->id;
					$email = $activeUser->email;
					$web = "";
				} else {
					$web = JRequest::getVar ( 'web' );
					if (substr ( $web, 0, 7 ) != "http://") {
						$web = "http://" . $web;
					}
					$email = JRequest::getVar ( 'email' );
					$user = JRequest::getVar ( 'user' );
				}
				if ($emailRequired == 1) {
					if ($email == "")
					{
						$error = JText::_('EMAIL FIELD EMPTY');
					}
					elseif (!eregi("^([a-z]|[0-9]|\.|-|_)+@([a-z]|[0-9]|\.|-|_)+\.([a-z]|[0-9]){2,3}$", $email))
					{
						$error = JText::_('EMAIL INVALID FRONT PART').' '. $email . JText::_('EMAIL INVALID BACK PART');
					}
				}
				
				if ($user == "") {
					$error = JText::_('NAME FIELD EMPTY');
				}
				
				$comments = JRequest::getVar ( 'comments' );
				if ($comments == "") {
					
					$error = JText::_('COMMENT FIELD EMPTY');
				}
				$datetime = date ( "y-m-d H:i:s", time () );
				$db = &JFactory::getDBO ();
				$published = 0;
				if (! $activeUser->guest) {
					$isUser = 1;
					$published = $userStatus;
				} else {
					if ($allowGuests == 0) {
						$error = JText::_('NEED TO BE LOGGED IN TO COMMENT');
					}
					$isUser = 0;
					$published = $guestStatus;
				}
				
				// Only save to database if no errors.
				if ($error == "") {
					$query = "INSERT INTO " . $db->nameQuote ( '#__webeeComment_Comment' ) . " (articleId, content, handle, isUser, email, url, published, saved, ordering, hits, ipAddress) VALUES (" . $articleId . ", " . $db->Quote ( $comments) . ", " . $db->Quote ( $user ) . ", " . $isUser . ", " . $db->Quote ( $email ) . ", " . $db->Quote ( $web ) . ", " . $published . ", " . $db->Quote ( $datetime ) . ", " . 1 . ", " . 1 . ", " . $db->Quote($ipAddress) .  ")";
					$db->setQuery ( $query );
					$db->execute ( $query );
					if ($published == 0)
					{
						$message = JText::_('COMMENT WILL BE CHECKED BEFORE PUBLISHING');	
					}
				} else {
					$param = "add";
				}
			
			break;
			case "captcha":
				$img = new securimage($jSession);
				$img->show(); 
				die($jSession->get('securimage_code_value'));
			default :
				$param = "none";
			break;
		}
		$model = &JModel::getInstance ( 'webeeCommentComponentModel' );
		
		// Get Comments for article ID
		$db = &JFactory::getDBO ();
		$path = JURI::base () . "index2.php?option=com_webeecomment";
		$db->setQuery ( "SELECT * FROM " . $db->nameQuote ( '#__webeeComment_Comment' ) . " WHERE " . $db->nameQuote ( 'articleId' ) . " = " . $db->Quote($articleId) . " AND " . $db->nameQuote ( 'published' ) . " = 1 ORDER BY " . $db->nameQuote ( 'saved' ) . $orderBy );
		$results = $db->loadObjectList ();
		// Print out each comment.	
		$count = 0;
		if($results)
		{
		foreach ( $results as $result ) {
			$html .= '<div class="comment">';
			$html .= '<span class="commentAuthorDate">';
			if($authorLink == 0)
			{
				$html .= '<a href="mailto:' . $result->email . '">';
			}
			if($authorLink == 1)
			{
				if ($result->url && $result->url != 'http://') {
					$html .= '<a href="' . $result->url . '">';
				} elseif ($result->email) {
					$html .= '<a href="mailto:' . $result->email . '">';
				}
			}
			if($authorLink != 0 && $authorLink != 1)
			{
				$html .= '';
			}
			$handle = "";
			if ($result->isUser) {
				
				$query = "SELECT " . $db->nameQuote ( 'username' ) . " from " . $db->nameQuote ( '#__users' ) . " WHERE " . $db->nameQuote ( 'id' ) . " = " . $result->handle;
				$db->setQuery ( $query );
				$handle = $db->loadResult ();
			} else {
				$handle = $result->handle;
			}
			$html .= $handle;
			if($authorLink == 0 || $authorLink == 1)
			{
				$html .= '</a>';
			}
			else
			{
				$html .= '';
			}
			$html .= "&nbsp;-&nbsp;";
			//$html .= date("l, F j, Y - g:i:s A", $result->saved);
			$date = new JDate ( $result->saved );
			$dateHtml = $date->toFormat ( $dateFormat );
			$html .= $dateHtml;
			$html .= "</span><span class='commentBody'>";
			$webReadyComment = $this->_WebReady($result->content);
			$html .= $webReadyComment;
			$html .= "</span></div>";
		}
		}
		if ($useCss)
		{
			$css = '"hideComment"';
		}
		else 
		{
			$css = '"hideComment"';
		}
		
		// Add area for adding comments.
		//$html .= "<table><tr><td>";
		if($openComments != 1) { $html .= '<div class=' . $css . ' onclick="hideComments(' . $sq . 'COMMENT' . $articleId . $sq . ', ' . $sq . $path . $sq . ', ' . $sq . $articleId . $sq . ');" onmouseover = "toHand();" onmouseout="toDefault();">';
		$html .= JText::_('HIDE COMMENTS BTN') . "</div>"; }
		//$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
		if ($param != "add") {
			if ($useCss)
			{
				$css = '"addComment"';
			}
			else 
			{
				$css = '"addComment"';
			}
			$html .= '<div class=' . $css . ' onclick="addComments(' . $sq . 'COMMENT' . $articleId . $sq . ', ' . $sq . $path . $sq . ', ' . $sq . $articleId . $sq . ');" onmouseover = "toHand();" onmouseout="toDefault();">';
			
			$html .= JText::_('ADD COMMENT BTN') . "</div>";
			if ($message != "")
			{
				$html .= '<span class="errorMsg">' . $message . '</span>';
			}
		} else {
			$canComment = (! $activeUser->guest || $allowGuests == 1);
			if ($canComment) {
				$html .= '<form class="addCommentForm" id="ADDCOMMENT' . $articleId . '">';
				$html .= '<h4>'.JText::_('COMMENT FORM HEADER').'</h4>';
				if (! $activeUser->guest) {
					//$html .= "<label for='name'>Name</label>" . $activeUser->username;
					$html .= '<input type="hidden" id="user" value="' . $activeUser->id . '">';
					$html .= '<input type="hidden" id="email" value="' . $activeUser->email . '">';
					if($showWebsite == 0)
					{
						$html .= '<input type="hidden" id="web" value="">';
					}
					else
					{
						$html .= '<label for="web">'.JText::_('WEBSITE LABEL').'</label><input type="text" id="web" value="' . $web . '">';
					}
				} else {
					$html .= "<label for='name'>".JText::_('NAME LABEL')."</label>";
					$html .= '<input type="text" id="user" value="' . $user . '"><span style="color:red">*</span>';
					$html .= "<label for='email'>".JText::_('EMAIL LABEL')."</label>";
					$html .= '<input type="text" id="email" value="' . $email . '">';
					if ($emailRequired == 1) {
						$html .= '<span style="color:red">*</span>';
					}
					if($showWebsite == 0)
					{
						$html .= '<input type="hidden" id="web" value="">';
					}
					else
					{
						$html .= '<label for="web">'.JText::_('WEBSITE LABEL').'</label><input type="text" id="web" value="' . $web . '">';
					}
				}
				if ($bbCode == 1)
				{
					$html .= '<label for="bbcode">&nbsp;</label><span id="bbcode"><a href="http://en.wikipedia.org/wiki/BBCode" target="_blank">'.JText::_('BBCODE AVAILABLE LABEL').'</a></span>';
				}
				$html .= '<label for="comments">'.JText::_('COMMENT LABEL').'</label><textarea name="comments" rows=6>' . $comments . '</textarea>';
				if ($useCaptcha == 1 && $activeUser->guest)
				{
					$jsPath = 'components/com_webeecomment';
					$html .= '<img id="captcha" src="'.JURI::base().'index.php?option=com_webeecomment&task=captcha" alt="CAPTCHA Image" />';
					$html .= '<a href="#" class="reload_captcha" onclick="document.getElementById('. "'" . 'captcha' . "'" . ').src = ' . "'" .JURI::base() .'index.php?option=com_webeecomment&task=captcha' . "'" . '; return false">'.JText::_('RELOAD CAPTCHA IMAGE LINK').'</a>';
					$html .= '<label for="captch_code">'.JText::_('CODE LABEL').'</label><input type="text" name="captcha_code" size="10" maxlength="6" />';
				}
				else
				{
					$html .= '<input type="hidden" name="captcha_code" size="10" maxlength="6" value="" />';
				}
				
			} else {
				$error = JText::_('NEED TO BE LOGGED IN TO COMMENT');
			}
			if ($canComment) {
				$onClick = $sq . 'COMMENT' . $articleId . $sq . ', ' . $sq . $path . $sq . ', ' . $sq . $articleId . $sq;
				if ($useCss)
				{
					$css = '"saveCommentButton"';
				}
				else 
				{	
					$css = '"saveCommentButton"';
				}
				$html .= '<div class=' . $css . ' onclick="saveComment(' . $onClick . ');" onmouseover = "toHand();" onmouseout="toDefault();">'.JText::_('POST COMMENT BUTTON').'</div><span class="note">* '.JText::_('MARKED FIELDS ARE MANDATORY').'</span>';
			}
			$html .= "</form>";
			if ($error != "") {
				$html .= '<div class="errorMsg">' . $error . '</div>';
			}
		}
		
		$view = new DefaultComponentView ( );
		$view->setModel ( $model, true );
		if ($count > 0) {
			$html .= "|" . $count;
		}
		$view->display ( $html );
	}
	function _WebReady($comment)
	{
		// Thanks to http://www.phpit.net/article/create-bbcode-php/
		//$return = htmlentities($comment);
		$return = str_replace("\n", "<BR>", $comment);
		$return = preg_replace ('/\[b\](.*?)\[\/b\]/is', '<strong>$1</strong>', $return);
        $return  = preg_replace ('/\[i\](.*?)\[\/i\]/is', '<em>$1</em>', $return);
        $return = preg_replace ('/\[u\](.*?)\[\/u\]/is', '<u>$1</u>', $return);
        $return = preg_replace ('/\[quote\](.*?)\[\/quote\]/is', '<blockquote>$1</blockquote>', $return);
        $return = preg_replace ('/\[url\=(.*?)\](.*?)\[\/url\]/is', '<a href="$1">$2</a>', $return);
        $return = preg_replace ('/\[s\](.*?)\[\/s\]/is', '<s>$1</s>', $return);
        $return = preg_replace ('/\[code\](.*?)\[\/code\]/is', '<pre>$1</pre>', $return);
        $return = preg_replace ('/\[img\](.*?)\[\/img\]/is', '<img src="$1" width="100%" />', $return);
        $return = preg_replace ('/\[color\=(.*?)\](.*?)\[\/color\]/is', '<span style="color:$1;">$2</span>', $return);
		return $return;
	}
}
?>