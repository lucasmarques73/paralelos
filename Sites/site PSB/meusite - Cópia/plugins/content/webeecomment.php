<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2009 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

// No direct access.
defined('_JEXEC') or die('Restricted Access');
jimport('joomla.plugin.plugin');
JPlugin::loadLanguage( 'com_webeecomment' );

class plgContentwebeecomment extends JPlugin
{
	function plgContentwebeecomment(&$subject)
	{
		parent::__construct($subject, "");
	}
	
	function onPrepareContent(& $article, & $params, $page = 0)
	{
		global $mainframe;
		
		$db = & JFactory::getDBO();
		$document = &JFactory::getDocument();
		$jsPath = '/plugins/content/JavaScript/webeecomment.js';
		$document->addScript(JURI::base() . $jsPath);
		$css = JURI::base() . "administrator/components/com_webeecomment/webeecomment.css";
		$document->addStyleSheet($css);
		
		
		// Check if comments disabled for this article.
		$enabled = true;
		// Check Article
		$query = "SELECT id from " . $db->nameQuote('#__webeeComment_Disabled') . " WHERE " . $db->nameQuote('target_id') . " = " . $db->Quote($article->id) . " AND " . $db->nameQuote('type') . " = 'article'";
		$db->setQuery($query);
		$found = $db->loadResult();
		if ($found) $enabled = false;
		// Check Category
		$query = "SELECT id from " . $db->nameQuote('#__webeeComment_Disabled') . " WHERE " . $db->nameQuote('target_id') . " = " . $db->Quote($article->catid) . " AND " . $db->nameQuote('type') . " = 'category'";
		$db->setQuery($query);
		$found = $db->loadResult();
		if ($found) $enabled = false;
		// Check Section
		$query = "SELECT id from " . $db->nameQuote('#__webeeComment_Disabled') . " WHERE " . $db->nameQuote('target_id') . " = " . $db->Quote($article->sectionid) . " AND " . $db->nameQuote('type') . " = 'section'";
		$db->setQuery($query);
		$found = $db->loadResult();
		if ($found) $enabled = false;
		
		$component = JComponentHelper::getComponent( 'com_webeecomment' );
		$params = & new JParameter( $component->params );
		
		// Check Frontpage
		$showFrontpage = $params->get('onFrontpage', 1);
		if($showFrontpage == false)
		{
			$menu = & JSite::getMenu('site');
			if ($menu->getActive() == $menu->getDefault()) {
				$enabled = false;
			}
		}
		
		// Get Parameters Necessary
		if ($article->id)
		{
		$params = & JComponentHelper::getParams ( 'com_webeecomment' );
		$useCss = $params->get('useCss', 0);
		if ($enabled)
		{
		$query = "SELECT COUNT(*) FROM " . $db->nameQuote('#__webeeComment_Comment') . " WHERE " . $db->nameQuote('articleId') .  " = " . $db->Quote($article->id) . " AND " . $db->nameQuote('published') . "= 1";
		$db->setQuery($query);
		$commentCount = $db->loadRowList();
		$path = JURI::base() . "index2.php?option=com_webeecomment";
		// Display initial comment piece.
		$sq = "'";
		if ($useCss)
		{
			$css = '"commentsButton"';
		}
		else 
		{
			$css = '"commentsButton"';
		}
		$openComments = $params->get('openComments', 0);
		$html = '<div id="COUNT' . $article->id . '" class=' . $css . ' onclick="expandComments(' . $sq . 'COMMENT' . $article->id . 
				$sq . ', ' . $sq . $path . $sq . ', ' . $sq . $article->id . $sq . ');" onmouseover = "toHand();" onmouseout="toDefault();">' . JText::_('COMMENT COUNT BTN') . ' (' .
				$commentCount[0][0] . ')</div>';
		if($openComments != 1) {
			$html2 = $html . '<div id="COMMENT' . $article->id . '"></div>';
		}
		else
		{
			$html2 = '<div id="COMMENT' . $article->id . '"></div>';
		}
		$article->text = $article->text . $html2;
		if(isset($_GET['showcomments']) || $openComments == 1)
		{
			$article->text = $article->text . '<script type="text/javascript">expandComments(' . $sq . 'COMMENT' . $article->id . $sq . ', ' . $sq . $path . $sq . ', ' . $sq . $article->id . $sq . ');</script>';
		}
		} 
		}
	}
	function onAfterDisplayContent(& $article, & $params, $page=0)
	{
		//return "Got here after";
	}
}
?>
