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
/**
 * Hellos View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class ccNewsletterViewnewsletters extends JView
{
	/**
	 * ccNewsletters display function
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'CC_NEWSLETTER_TITLE' ) . ' - ' . JText::_( 'Newsletters' ), 'ccnewsletter.png' );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy', true );
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::preferences('com_ccnewsletter', '500');
 		global $mainframe;
 		$this->_addCss();

		$db =& JFactory::getDBO();
		$context			= 'com_ccnewsletter.newsletter.list.';
		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		'n.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
		$where = array();
		if ($search)
		{
			$where[] = 'LOWER(n.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}
		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir ;
		// get the total number of records
		$query = 'SELECT COUNT(*)'
		. ' FROM #__ccnewsletter_newsletters AS n'
		. $where
		;
		$db->setQuery( $query );
		$total = $db->loadResult();
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$query = 'SELECT n.*  FROM #__ccnewsletter_newsletters AS n'
		. $where
		. $orderby
		;
		$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();
		$javascript		= 'onchange="document.adminForm.submit();"';
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;
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
