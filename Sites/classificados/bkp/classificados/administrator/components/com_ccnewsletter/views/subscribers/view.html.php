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

jimport( 'joomla.application.component.view' );


class ccNewsletterViewsubscribers extends JView
{
	/**
	 * ccNewsletters display function
	 * @return void
	 **/
	function display($tpl = null)
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		JHTML::stylesheet('ccnewsleter.css', JURI::base() . 'components/com_ccnewsletter/assets/');
		JToolBarHelper::title(   JText::_( 'CC_NEWSLETTER_TITLE' ) . ' - ' .  JText::_( 'CC_SUBSCRIBERS' ), 'ccnewsletter.png' );
		JToolBarHelper::custom('sync', 'adduser', '', JText::_( 'CC_SYNCHRONIZATION' ), false);
		$query_vm = "SELECT count(*) FROM #__components AS s WHERE s.option LIKE 'com_virtuemart'";
		$db->setQuery( $query_vm );
		$total_vm = $db->loadResult();
		if($total_vm)
		{
			JToolBarHelper::custom('susync', 'adduser', '', JText::_( 'CC_SUSYNCHRONIZATION' ), false);
		}
		JToolBarHelper::custom('publish', 'publish', '', JText::_( 'CC_ENABLED' ), true);
		JToolBarHelper::custom('unpublish', 'unpublish', '', JText::_( 'CC_DISABLED' ), true);
		JToolBarHelper::deleteListX(JText::_( 'CC_WARN_DELETE' ));
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::preferences('com_ccnewsletter', '500');
		$context			= 'com_ccnewsletter.subscriber.list.';
		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		's.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		$filter_state		= $mainframe->getUserStateFromRequest( $context.'filter_state',		'filter_state',		'',			'word' );
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );

		$this->_addCss();
		$where = array();
		if ( $filter_state )
		{
			if ( $filter_state == 'P' ) {
				$where[] = 's.enabled = 1';
			}
			else if ($filter_state == 'U' ) {
				$where[] = 's.enabled = 0';
			}
		}
		if ($search)
		{
			$where[] = 'LOWER(s.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false ) . ' OR LOWER(s.email) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}
		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir ;
		// get the total number of records
		$query = 'SELECT COUNT(*)'
		. ' FROM #__ccnewsletter_subscribers AS s'
		. $where
		;
		$db->setQuery( $query );
		$total = $db->loadResult();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );

		/*$query = "SELECT DISTINCT(u.email),u.username,s.* FROM #__ccnewsletter_subscribers AS s"
		. "\n LEFT JOIN  #__users AS u ON  u.email=s.email"
		. $where
		. $orderby
		;*/

		$query = "SELECT s.* FROM #__ccnewsletter_subscribers AS s"
		. $where
		. $orderby
		;


		$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();

		// build list of categories
		$javascript		= 'onchange="document.adminForm.submit();"';
		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );
		// table ordering
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;
		// search filter
		$lists['search']= $search;


		/* Get the component base directory */
		$adminDir = JPATH_ADMINISTRATOR .DS. 'components';
		$siteDir = JPATH_SITE .DS. 'components';
		$file = $adminDir.DS.'com_ccnewsletter'.DS.'ccnewsletter.xml';
		$xml = new JSimpleXML;
		$xml->loadFile($file);
		$xml = $xml->document;
		$c_version = $xml->version[0]->data();
		$c_name = $xml->name[0]->data();

		/* Check for New Version */
		$myReadAccess= new versionRead('http://www.chillcreations.com/versionnumbers.txt');
		if($data = $myReadAccess->getFileContents()) {
			$pieces = explode("\n", $data);
			foreach($pieces as $piece)
			{
				$small_pieces[] = explode(",", $piece);
			}
			$versionContent = "";
 			foreach( $small_pieces as $small_piece)
			{
  				if ($small_piece[0] == $c_name && $small_piece[1] > $c_version && trim($small_piece[3]) != 'none') {
					$versionContent ="<div style='font-weight:bold;text-align:center;color:#FF0000;'><a style='color:#FF0000;' href='".$small_piece[2]."' target='_blank'>". JText::_( 'ID_WARNING' ) . " " .JText::_( 'ID_NEW_VERSION' ) . " " . $small_piece[1]. " " .JText::_( 'ID_AVAIALBLE_DOWNLOAD' ) ."</a>";
					$versionContent .="<br/>".$small_piece[3]."</div>";
  				}
				else if ($small_piece[0] == $c_name && $small_piece[1] > $c_version && trim($small_piece[3]) == 'none') {
					$versionContent = "<div style='font-weight:bold;text-align:center;color:#FF0000;'><a style='color:#FF0000;' href='".$small_piece[2]."' target='_blank'>". JText::_( 'ID_WARNING' ) . " " .JText::_( 'ID_NEW_VERSION' ) . " " . $small_piece[1]. " " .JText::_( 'ID_AVAIALBLE_DOWNLOAD' ) ."</a></div>";
				}
			}
		}
		if(isset($versionContent) && $versionContent != "") {
			$this->assignRef('versionContent',	$versionContent);
		}
		$this->assignRef('version',		$c_version);
		$this->assignRef('name',		$c_name);



		$this->assignRef('items',		$rows);
		$this->assignRef('pageNav',		$pageNav);
		$this->assignRef('lists',		$lists);
		parent::display($tpl);
	}
	function _addCss()
	{
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet('components/com_ccnewsletter/assets/ccnewsleter.css');
	}

}
