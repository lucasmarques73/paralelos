<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/ftpupload/view.html.php $
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
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display($tpl = null)
  {
    JToolBarHelper::title(JText::_('JGA_UPLOAD_FTP_UPLOAD_MANAGER'));
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    $script = "    function joom_checkme() {
      var form = document.adminForm;
      form.catid.style.backgroundColor = '';";
    if($this->_config->get('jg_useorigfilename') == 0)
    {
      $script .= "
      form.gentitle.style.backgroundColor = '';
      if (form.gentitle.value == '' || form.gentitle.value == null) {
        alert(JText._('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE'));
        form.gentitle.style.backgroundColor = ffwrong;
        form.gentitle.focus();
        return false;
      }";
    }
    $script .= "
      var filecounterok = true;";
    if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber'))
    {
      $script .= "
      form.filecounter.style.backgroundColor = '';
      if (form.filecounter.value != '') {
        var searchwrongchars1 = /[^0-9]/;
        if(searchwrongchars1.test(form.filecounter.value)) {
          filecounterok = false;
          alert(JText._('JG_COMMON_ALERT_WRONG_VALUE'));
          form.filecounter.style.backgroundColor = ffwrong;
          form.filecounter.focus();
          return false;
        }
      }";
    }
    $script .= "
      if (form.catid.value == '0' && filecounterok) {
        alert(JText._('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY'));
        form.catid.style.backgroundColor = ffwrong;
        form.catid.focus();
        return false;
      } else {
        var filenamesnotok = false;";
    if($this->_config->get('jg_filenamewithjs') != 0  && $this->_config->get('jg_useorigfilename') == 0)
    {
      $script .= "
        var searchwrongchars = /[^ a-zA-Z0-9_-]/;
        if(searchwrongchars.test(form.gentitle.value)) {
          filenamesnotok = true;
        }";
    }
    $script .= "
      }
      if(filenamesnotok) {
        alert(JText._('JG_COMMON_ALERT_WRONG_FIILENAME'));
        form.gentitle.style.backgroundColor = ffwrong;
        form.gentitle.focus();
        return false;
      } else {
        form.submit();
        return true;
      }
    }";
    $this->_doc->addScriptDeclaration($script);

    $this->_doc->addScriptDeclaration('    var ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');
    $this->_ambit->script('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');
    $this->_ambit->script('JG_COMMON_ALERT_WRONG_VALUE');
    $this->_ambit->script('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY');
    $this->_ambit->script('JG_COMMON_ALERT_WRONG_FIILENAME');

    $lists['cats']  = JHTML::_('joomselect.categorylist', 0, 'catid', ' class="inputbox" size="1" style="width:228;"');

    $subdirectory   = $this->_mainframe->getUserStateFromRequest('joom.upload.ftp.subdirectory', 'subdirectory', DS, 'post', 'string');
    $subdirectories = JFolder::folders($this->_ambit->get('ftp_path'), '', true, true);

    $files = JFolder::files($this->_ambit->get('ftp_path').$subdirectory, '\.bmp$|\.gif$|\.jpg$|\.png$|\.jpeg$|\.jpe$|\.BMP$|\.GIF$|\.JPG$|\.PNG$|\.JPEG$|\.JPE$');

    $this->assignRef('lists',           $lists);
    $this->assignRef('subdirectory',    $subdirectory);
    $this->assignRef('subdirectories',  $subdirectories);
    $this->assignRef('files',           $files);

    parent::display($tpl);
  }
}