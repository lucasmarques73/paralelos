<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/categories/view.html.php $
// $Id: view.html.php 2602 2010-11-30 20:05:25Z erftralle $
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
 * HTML View class for the categories list view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewCategories extends JoomGalleryView
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
    JToolBarHelper::title(JText::_('JGA_CATMAN_CATEGORY_MANAGER'), 'categories');
    JToolbarHelper::publishList('publish', 'JGA_COMMON_TOOLBAR_PUBLISH');
    JToolbarHelper::unpublishList('unpublish', 'JGA_COMMON_TOOLBAR_UNPUBLISH');
    JToolbarHelper::spacer();
    JToolbarHelper::divider();
    JToolbarHelper::spacer();
    JToolbarHelper::addNew('new', 'JGA_COMMON_TOOLBAR_NEW');
    JToolbarHelper::editList('edit', 'JGA_COMMON_TOOLBAR_EDIT');
    JToolbarHelper::deleteList('','remove', 'JGA_COMMON_TOOLBAR_REMOVE');
    JToolbarHelper::spacer();
    JToolbarHelper::divider();
    JToolbarHelper::spacer();
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    JHTML::_('behavior.tooltip');

    $default_limit  = $this->_mainframe->getCfg('list_limit');
    $limit          = $this->_mainframe->getUserStateFromRequest('joom.categories.limit', 'limit', $default_limit, 'int');
    $limitstart     = $this->_mainframe->getUserStateFromRequest('joom.categories.limitstart', 'limitstart', 0, 'int');
    $searchtext     = $this->_mainframe->getUserStateFromRequest('joom.categories.search', 'search', '');
    $sort           = $this->_mainframe->getUserStateFromRequest('joom.categories.sort', 'sort', 0);
    $filter         = $this->_mainframe->getUserStateFromRequest('joom.categories.filter', 'filter', 0);

    JRequest::setVar('limit',       (int) $limit);
    JRequest::setVar('limitstart',  (int) $limitstart);
    JRequest::setVar('search',      $searchtext);
    JRequest::setVar('sort',        (int) $sort);
    JRequest::setVar('filter',      $filter);

    $lists = array();

    // TODO: maybe rename first option to 'Treeview'
    $o_options[] = JHTML::_('select.option', 0, JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_ASC'));
    #$o_options[] = JHTML::_('select.option', 1, JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_DESC'));
    $o_options[] = JHTML::_('select.option', 2, JText::_('JGA_CATMAN_ORDERBY_CATPATH_ASC'));
    $o_options[] = JHTML::_('select.option', 3, JText::_('JGA_CATMAN_ORDERBY_CATPATH_DESC'));
    $o_options[] = JHTML::_('select.option', 4, JText::_('JGA_CATMAN_ORDERBY_DBID_ASC'));
    $o_options[] = JHTML::_('select.option', 5, JText::_('JGA_CATMAN_ORDERBY_DBID_DESC'));
    $o_options[] = JHTML::_('select.option', 6, JText::_('JGA_CATMAN_ORDERBY_CATNAME_ASC'));
    $o_options[] = JHTML::_('select.option', 7, JText::_('JGA_CATMAN_ORDERBY_CATNAME_DESC'));
    $o_options[] = JHTML::_('select.option', 8, JText::_('JGA_CATMAN_ORDERBY_DBOWNERID_ASC'));
    $o_options[] = JHTML::_('select.option', 9, JText::_('JGA_CATMAN_ORDERBY_DBOWNERID_DESC'));

    $lists['sort'] = JHTML::_('select.genericlist', $o_options, 'sort',
      'class="inputbox" size="1" onchange="document.adminForm.submit();"',
      'value', 'text', $sort);

    $s_options[] = JHTML::_('select.option', 0, '&nbsp;');
    $s_options[] = JHTML::_('select.option', 1, JText::_('JGA_COMMON_PUBLISHED'));
    $s_options[] = JHTML::_('select.option', 2, JText::_('JGA_CATMAN_NOT_PUBLISHED'));
    $s_options[] = JHTML::_('select.option', 3, JText::_('JGA_CATMAN_OPTION_USERCATEGORIES_ONLY'));
    $s_options[] = JHTML::_('select.option', 4, JText::_('JGA_CATMAN_OPTION_BACKENDCATEGORIES_ONLY'));

    $lists['filter'] = JHTML::_('select.genericlist', $s_options, 'filter',
      'class="inputbox" size="1" onchange="document.adminForm.submit();"',
      'value', 'text', $filter);

    // Get data from the model
    $items  = & $this->get('Categories');
    $total  = & $this->get('Total');

    jimport('joomla.html.pagination');
    $pagination = new JPagination($total, $limitstart, $limit);

    if($sort || $filter || $searchtext != "")
    {
      $ordering = false;
    }
    else
    {
      $ordering = true;
    }

    $this->assignRef('items',       $items);
    $this->assignRef('pagination',  $pagination);
    $this->assignRef('searchtext',  $searchtext);
    $this->assignRef('ordering',    $ordering);
    $this->assignRef('lists',       $lists);

    parent::display($tpl);
  }
}