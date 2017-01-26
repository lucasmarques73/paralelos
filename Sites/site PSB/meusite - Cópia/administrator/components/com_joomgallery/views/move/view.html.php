<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/move/view.html.php $
// $Id: view.html.php 1914 2010-03-02 21:53:56Z mab $
/******************************************************************************\
**   JoomGallery  1.5                                                         **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                          **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the move view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewMove extends JoomGalleryView
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
    JToolBarHelper::title(JText::_('JGA_IMGMAN_IMAGE_MANAGER').' :: '.JText::_('JGA_IMGMAN_MOVE_IMAGE'));
    JToolbarHelper::save('move', 'JGA_COMMON_TOOLBAR_SAVE');
    JToolbarHelper::cancel('cancel', 'JGA_COMMON_TOOLBAR_CANCEL');
    //JToolbarHelper::spacer();
    //JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    $catid = $this->_mainframe->getUserStateFromRequest('joom.move.catid', 'catid', 0, 'int');

    $items = $this->get('Images');

    // TODO: Category select list
    $options = array(JHTML::_('select.option', 1, JText::_('JGA_IMGMAN_SELECT_CATEGORY')));

    // TODO: Need of $options?
    $lists = array();
    $lists['cats'] = JHTML::_('joomselect.categorylist', $catid, 'catid', 'class="inputbox" size="1" ');

    $categories = $this->get('Categories');
    // Establish the hierarchy of the menu
    $children = array();
    // First pass - collect children
    foreach($categories as $v)
    {
      $pt = $v->parent;
      $list = isset($children[$pt]) && $children[$pt] ? $children[$pt] : array();
      array_push($list, $v);
      $children[$pt] = $list;
    }

    $this->assignRef('items',     $items);
    $this->assignRef('lists',     $lists);
    $this->assignRef('children',  $children);

    parent::display($tpl);
  }
}
