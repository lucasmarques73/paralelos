<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/cssedit/view.html.php $
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

jimport( 'joomla.application.component.view' );

/**
 * HTML View class for the CSS edit view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewCssedit extends JoomGalleryView
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
    jimport('joomla.filesystem.file');

    $path   = JPATH_COMPONENT_SITE.DS.'assets'.DS.'css'.DS;
    $title  = JText::_('JGA_CSSMAN_CSS_MANAGER');
    if(JFile::exists($path.'joom_local.css'))
    {
      $title .= ' ('.JText::_('JGA_COMMON_TOOLBAR_EDIT').')';

      JToolBarHelper::deleteList(JText::_('JGA_CSSMAN_CSS_CONFIRM_DELETE', true), 'remove', 'JGA_CSSMAN_TOOLBAR_DELETE_CSS');

      $file = $path.'joom_local.css';

      if(!is_writable($file))
      {
        JError::raiseNotice(111, JText::_('JGA_CSSMAN_CSS_WARNING_PERMS'));
      }

      $edit = true;
    }
    else
    {
      $title .= ' ('.JText::_('JGA_COMMON_TOOLBAR_NEW').')';

      $file = $path.'joom_local.css.README';

      if(!is_writable($path))
      {
        JError::raiseNotice(111, JText::_('JGA_CSSMAN_CSS_WARNING_PERMS'));
      }

      $edit = false;
    }

    JToolBarHelper::title($title, 'config');
    JToolBarHelper::save('save','JGA_COMMON_TOOLBAR_SAVE');
    JToolBarHelper::apply('apply','JGA_COMMON_TOOLBAR_APPLY');
    JToolBarHelper::cancel('cancel','JGA_COMMON_TOOLBAR_CANCEL');
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    $content =  JFile::read($file);
    if($content === false)
    {
      // Unable to read the file
      JError::raiseWarning(111, JText::_('JGA_CSSMAN_CSS_ERROR_READING') . $file);
    }
    else
    {
      $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    }

    $file = $path.'joom_local.css';

    $this->assignRef('content', $content);
    $this->assignRef('edit',    $edit);
    $this->assignRef('file',    $file);

    parent::display($tpl);
  }
}
