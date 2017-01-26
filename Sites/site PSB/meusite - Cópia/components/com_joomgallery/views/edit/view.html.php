<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/edit/view.html.php $
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
 * HTML View class for the edit view for images
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewEdit extends JoomGalleryView
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
    if(   !$this->_config->get('jg_userspace')
       || ($this->_config->get('jg_showuserpanel') == 2 && $this->_user->get('aid') != 2)
      )
    {
      // You are not allowed...
      $msg = JText::_('ALERTNOTAUTH');
      if(!$this->_user->get('id'))
      {
        $msg .= '<br />' . JText::_('You need to login.');
      }

      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), $msg, 'notice');
    }

    if(!$this->_user->get('id'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_MSG_YOU_ARE_NOT_LOGGED'), 'notice');
    }

    $params           = &$this->_mainframe->getParams();

    // Breadcrumbs
    if($this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();
      $breadcrumbs->addItem(JText::_('JGS_COMMON_USER_PANEL'), 'index.php?view=userpanel');
      $breadcrumbs->addItem(JText::_('JGS_EDIT_EDIT_IMAGE'));
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $pathway = null;
    if($this->_config->get('jg_showpathway'))
    {
      $pathway  = '<a href="'.JRoute::_('index.php?view=userpanel').'">'.JText::_('JGS_COMMON_USER_PANEL').'</a>';
      $pathway .= ' &raquo; '.JText::_('JGS_EDIT_EDIT_IMAGE');
    }

    $backtarget = JRoute::_('index.php?view=userpanel'); //see above
    $backtext   = JText::_('JGS_COMMON_BACK_TO_USER_PANEL');

    $numbers  = JoomHelper::getPicsAndHits($params);

    if(!$params->get('page_title'))
    {
      $params->set('page_title', JText::_('JGS_COMMON_GALLERY'));
    }

    // Load modules at position 'top'
    $modules['top'] = JoomHelper::getRenderedModules('top');
    if(count($modules['top']))
    {
      $params->set('show_top_modules', 1);
    }
    // Load modules at position 'btm'
    $modules['btm'] = JoomHelper::getRenderedModules('btm');
    if(count($modules['btm']))
    {
      $params->set('show_btm_modules', 1);
    }

    $image = &$this->get('Image');

    if($image->owner != $this->_user->get('id') && !$this->get('AdminLogged'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?option=com_joomgallery&view=gallery', false), JText::_('JGS_COMMON_MSG_NOT_ALLOWED_TO_EDIT_IMAGE'), 'notice');
    }

    $lists = array();

    if($this->get('AdminLogged'))
    {
      $lists['cats'] = JHTML::_('joomselect.categorylist', $image->catid, 'catid');
    }
    else
    {
      $lists['cats'] = JHTML::_('joomselect.usercategorylist', $image->catid);
    }

    // If the category list is empty, the image is in a backend category
    // which isn't available for the user anymore or it is the only category.
    // In this case simply display the name of the category.
    if(!$lists['cats'])
    {
      $row = & JTable::getInstance('joomgallerycategories', 'Table');
      $row->load($image->catid);
      $lists['cats'] = $row->name;
    }

    $this->assignRef('params',          $params);
    $this->assignRef('image',           $image);
    $this->assignRef('lists',           $lists);
    $this->assignRef('pathway',         $pathway);
    $this->assignRef('modules',         $modules);
    $this->assignRef('backtarget',      $backtarget);
    $this->assignRef('backtext',        $backtext);
    $this->assignRef('numberofpics',    $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',  $numbers[1]);
    }

    $this->_doc->addScript($this->_ambit->getScript('userpanel.js'));
    $this->_doc->addScriptDeclaration('    var jg_ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');
    $this->_ambit->script('JGS_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY');
    $this->_ambit->script('JGS_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');

    parent::display($tpl);
  }
}