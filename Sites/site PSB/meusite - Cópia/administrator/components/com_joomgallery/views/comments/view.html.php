<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/comments/view.html.php $
// $Id: view.html.php 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the comments list view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewComments extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display($tpl = null)
  {
    JToolBarHelper::title(JText::_('JGA_COMMAN_COMMENTS_MANAGER'));
    JToolbarHelper::publishList('publish', 'JGA_COMMAN_TOOLBAR_PUBLISH_COMMENT');
    JToolbarHelper::unpublishList('unpublish', 'JGA_COMMAN_TOOLBAR_UNPUBLISH_COMMENT');
    JToolbarHelper::custom('approve', 'upload.png', 'upload_f2.png', 'JGA_COMMAN_TOOLBAR_APPROVE_COMMENT');
    #JToolbarHelper::spacer();
    JToolbarHelper::divider();
    #JToolbarHelper::spacer();
    JToolbarHelper::deleteList('', 'remove', 'JGA_COMMAN_TOOLBAR_REMOVE_COMMENT');
    #JToolbarHelper::spacer();
    JToolbarHelper::divider();
    #JToolbarHelper::spacer();
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    JHTML::_('behavior.tooltip');

    $limitstart     = $this->_mainframe->getUserStateFromRequest('joom.comments.limitstart', 'limitstart', 0);
    $default_limit  = $this->_mainframe->getCfg('list_limit');
    $limit          = $this->_mainframe->getUserStateFromRequest('joom.comments.limit', 'limit', $default_limit, 'int');
    $searchtext     = $this->_mainframe->getUserStateFromRequest('joom.comments.search', 'search', '');

    JRequest::setVar('limit',       (int) $limit);
    JRequest::setVar('limitstart',  (int) $limitstart);
    JRequest::setVar('search',      $searchtext);

    // Get data from the model
    $items  = & $this->get('Comments');
    $total  = & $this->get('Total');

    jimport('joomla.html.pagination');
    $pagination = new JPagination($total, $limitstart, $limit);

    $this->assignRef('items', $items);
    $this->assignRef('pagination', $pagination);
    $this->assignRef('searchtext', $searchtext);

    parent::display($tpl);
  }
}