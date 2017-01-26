<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/views/ftpupload/view.html.php $
// $Id: view.html.php 3791 2012-05-20 22:47:41Z chraneco $
/****************************************************************************************\
**   JoomGallery 2                                                                      **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the FTP upload view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewFtpupload extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  public function display($tpl = null)
  {
    JToolBarHelper::title(JText::_('COM_JOOMGALLERY_UPLOAD_FTP_UPLOAD_MANAGER'));
    JToolbarHelper::custom('cpanel', 'options.png', 'options.png', 'COM_JOOMGALLERY_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    JForm::addFormPath(JPATH_COMPONENT.'/models/forms');
    $this->form = JForm::getInstance(_JOOM_OPTION.'.ftpupload', 'ftpupload');

    $subdirectory = $this->_mainframe->getUserStateFromRequest('joom.upload.ftp.subdirectory', 'subdirectory', '/', '', 'string');

    $this->form->setFieldAttribute('directory', 'default', JPath::clean($this->_ambit->get('ftp_path').$subdirectory));
    $this->form->setFieldAttribute('subdirectory', 'directory', $this->_ambit->get('ftp_path'));
    $this->form->setFieldAttribute('ftpfiles', 'directory', $this->_ambit->get('ftp_path').$subdirectory);
    $this->form->setFieldAttribute('subdirectory', 'default', $subdirectory);

    if($this->_config->get('jg_useorigfilename'))
    {
      $this->form->setFieldAttribute('imgtitle', 'required', 'false');
    }

    parent::display($tpl);
  }
}