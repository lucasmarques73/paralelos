<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/editimages/view.html.php $
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
 * HTML View class for the images edit view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewEditimages extends JoomGalleryView
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
    JToolBarHelper::title(JText::_('JGA_IMGMAN_IMAGE_MANAGER'), 'mediamanager');
    JToolbarHelper::save('save', 'JGA_COMMON_TOOLBAR_SAVE');
    JToolbarHelper::apply('apply', 'JGA_COMMON_TOOLBAR_APPLY');
    JToolbarHelper::cancel('cancel', 'JGA_COMMON_TOOLBAR_CANCEL');
    JToolbarHelper::spacer();

    $items = $this->get('Images');
 
    // Prepare category
    $catid = $this->_mainframe->getUserStateFromRequest('joom.editimages.catid', 'catid', $items[0]->catid);

    $lists = array();

    $lists['cats']        = JHTML::_('joomselect.categorylist', $catid , 'catid', 'class="inputbox" size="1"');
    $lists['published']   = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $items[0]->published);
    $lists['access']      = '';#JHTML::_('list.accesslevel', $items[0]);
    $lists['owner']       = JHTML::_('list.users', 'owner', $items[0]->owner, true, null, 'name', false);

    $editor = & JFactory::getEditor();

    $cids = JRequest::getVar('cid', array(), '', 'array');
    #$cids = JArrayHelper::toInteger($cids);print_r($cids);
    $cids = implode(',', $cids);

    $this->assignRef('items',       $items);
    $this->assignRef('cids',        $cids);
    $this->assignRef('editor',      $editor);
    $this->assignRef('pagination',  $pagination);
    $this->assignRef('searchtext',  $searchtext);
    $this->assignRef('ordering',    $ordering);
    $this->assignRef('lists',       $lists);

    $this->_doc->addScriptDeclaration('    var ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');
    $this->_ambit->script('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');
    $this->_ambit->script('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY');

    parent::display($tpl);
  }
}
