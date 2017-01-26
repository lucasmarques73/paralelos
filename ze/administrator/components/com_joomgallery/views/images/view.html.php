<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/views/images/view.html.php $
// $Id: view.html.php 3839 2012-09-03 17:17:47Z chraneco $
/******************************************************************************\
**   JoomGallery 2                                                            **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                      **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the images list view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewImages extends JoomGalleryView
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
    JHTML::_('behavior.tooltip');

    // Get data from the model
    $items      = $this->get('Images');
    $state      = $this->get('State');
    $pagination = $this->get('Pagination');

    $this->assignRef('items',       $items);
    $this->assignRef('state',       $state);
    $this->assignRef('pagination',  $pagination);

    if($state->get('filter.inuse') && !$this->get('Total'))
    {
      $this->_mainframe->enqueueMessage(JText::_('COM_JOOMGALLERY_IMGMAN_MSG_NO_IMAGES_FOUND_MATCHING_YOUR_QUERY'));
    }

    $this->addToolbar();
    parent::display($tpl);
  }

  protected function addToolbar()
  {
    // Get the results for each action
    $canDo = JoomHelper::getActions();

    JToolBarHelper::title(JText::_('COM_JOOMGALLERY_IMGMAN_IMAGE_MANAGER'), 'mediamanager');

    if(($this->_config->get('jg_disableunrequiredchecks') || $canDo->get('joom.upload') || count(JoomHelper::getAuthorisedCategories('joom.upload'))) && $this->pagination->total)
    {
      JToolbarHelper::addNew('new');
    }

    if(($canDo->get('core.edit') || $canDo->get('core.edit.own')) && $this->pagination->total)
    {
      JToolbarHelper::editList();
      JToolbarHelper::custom('showmove', 'move.png', 'move.png', 'COM_JOOMGALLERY_COMMON_TOOLBAR_MOVE');
      JToolbarHelper::custom('recreate', 'refresh.png', 'refresh.png', 'COM_JOOMGALLERY_COMMON_TOOLBAR_RECREATE');
      JToolbarHelper::divider();
    }

    if($canDo->get('core.edit.state') && $this->pagination->total)
    {
      JToolbarHelper::publishList();
      JToolbarHelper::unpublishList();
      JToolbarHelper::custom('approve', 'upload.png', 'upload_f2.png', 'COM_JOOMGALLERY_IMGMAN_TOOLBAR_APPROVE');
      //JToolbarHelper::spacer();
      JToolbarHelper::divider();
      //JToolbarHelper::spacer();
    }

    //if($canDo->get('core.delete'))
    //{
      JToolbarHelper::deleteList('', 'remove');
    //}

    //JToolbarHelper::spacer();
    JToolbarHelper::divider();
    //JToolbarHelper::spacer();
    JToolbarHelper::custom('cpanel', 'options.png', 'options.png', 'COM_JOOMGALLERY_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();
  }
}