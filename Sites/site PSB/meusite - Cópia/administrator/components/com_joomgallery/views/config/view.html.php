<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/config/view.html.php $
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
 * HTML View class for the configuration view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewConfig extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display()
  {
    // Load language files of frontend for Exif and IPTC data
    $language = & JFactory::getLanguage();
    $language->load(_JOOM_OPTION.'.exif', JPATH_SITE);
    $language->load(_JOOM_OPTION.'.iptc', JPATH_SITE);

    JToolBarHelper::title(JText::_('JGA_CONFIG_CONFIGURATION_MANAGER'), 'config');
    JToolbarHelper::save('save', 'JGA_COMMON_TOOLBAR_SAVE');
    JToolbarHelper::spacer();
    JToolbarHelper::apply('apply', 'JGA_COMMON_TOOLBAR_APPLY');
    JToolbarHelper::spacer();
    JToolbarHelper::divider();
    JToolbarHelper::spacer();
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    require_once(JPATH_COMPONENT.DS.'helpers'.DS.'tabs.php');

    $display = true;

    $tabs = new JoomTabs();

    // Check the installation of GD
    $gdver = $this->get('GDVersion');
    // Returns version, 0 if not installed, or -1 if appears
    // to be installed but not verified
    if($gdver > 0)
    {
      $gdmsg = JText::sprintf('JGA_CONFIG_GS_IP_GDLIB_INSTALLED', $gdver);
    }
    else
    {
      if($gdver == -1)
      {
        $gdmsg = JText::_('JGA_CONFIG_GS_IP_GDLIB_NO_VERSION');
      }
      else
      {
        $gdmsg = JText::_('JGA_CONFIG_GS_IP_GDLIB_NOT_INSTALLED') .
                '<a href="http://www.php.net/gd" target="_blank">http://www.php.net/gd</a>'
                . JText::_('JGA_GD_MORE_INFO');
      }
    }

    // Check the installation of ImageMagick
    $imver = $this->get('IMVersion');
    // Returns version, 0 if not installed or path not properly configured
    if($imver)
    {
      $immsg = JText::_('JGA_CONFIG_GS_IP_IMAGIC_INSTALLED') .  $imver;
    }
    else
    {
      $immsg = JText::_('JGA_CONFIG_GS_IP_IMAGIC_NOT_INSTALLED');
    }

    // Check the installation of Exif
    $exifmsg = '';
    if(!extension_loaded('exif'))
    {
      $exifmsg    = '<div style="color:#f00;font-weight:bold; text-align:center;">[' . JText::_('JGA_CONFIG_DV_ED_NOT_INSTALLED') . ' ' . JText::_('JGA_CONFIG_DV_ED_NO_OPTIONS') . ']</div>';
    }
    else
    {
      $exifmsg    = '<div style="color:#080; text-align:center;">[' . JText::_('JGA_CONFIG_DV_ED_INSTALLED') . ']</div>';
      if(!function_exists('exif_read_data'))
      {
        $exifmsg = '<div style="color:#f00;font-weight:bold; text-align:center;">[' . JText::_('JGA_CONFIG_DV_ED_INSTALLED_BUT') . ' ' . JText::_('JGA_CONFIG_DV_ED_NO_OPTIONS') . ']</div>';
      }
    }

    // Check pathes and watermark file
    $writeable   = '<span style="color:#080;">'
      . JText::_('JGA_CONFIG_GS_PD_DIRECTORY_WRITEABLE') .
      '</span>';
    $unwriteable = '<span style="color:#f00;">'
      . JText::_('JGA_CONFIG_GS_PD_DIRECTORY_UNWRITEABLE') .
      '</span>';

    if(is_writeable($this->_ambit->get('img_path')))
    {
      $write_pathimages = $writeable;
    }
    else
    {
      $write_pathimages = $unwriteable;
    }
    if(is_writeable($this->_ambit->get('orig_path')))
    {
      $write_pathoriginalimages = $writeable;
    }
    else
    {
      $write_pathoriginalimages = $unwriteable;
    }
    if(is_writeable($this->_ambit->get('thumb_path')))
    {
      $write_paththumbs = $writeable;
    }
    else
    {
      $write_paththumbs = $unwriteable;
    }
    if(is_writeable($this->_ambit->get('ftp_path')))
    {
      $write_pathftpupload = $writeable;
    }
    else
    {
      $write_pathftpupload = $unwriteable;
    }
    if(is_writeable($this->_ambit->get('temp_path')))
    {
      $write_pathtemp = $writeable;
    }
    else
    {
      $write_pathtemp = $unwriteable;
    }
    if(is_writeable(JPath::clean(JPATH_ROOT.DS.$this->_config->get('jg_wmpath'))))
    {
      $write_pathwm = $writeable;
    }
    else
    {
      $write_pathwm = $unwriteable;
    }
    if(is_file(JPath::clean(JPATH_ROOT.DS.$this->_config->get('jg_wmpath').DS.$this->_config->get('jg_wmfile'))))
    {
      $wmfilemsg = '<span style="color:#080;">'
        . JText::_('JGA_CONFIG_GS_PD_FILE_EXIST') .
        '</span>';
    }
    else
    {
      $wmfilemsg = '<span style="color:#f00;">'
        . JText::_('JGA_CONFIG_GS_PD_FILE_NOT_EXIST') .
        '</span>';
    }

    // Check whether CSS file (joom_settings.css) is writeable
    if(is_writeable(JPATH_COMPONENT_SITE.DS.'assets'.DS.'css'.DS.'joom_settings.css'))
    {
      $cssfilemsg = '<div style="color:#080; text-align:center;">[' . JText::_('JGA_CONFIG_GS_PD_CSS_CONFIGURATION_WRITEABLE') . ']</div>';
    }
    else
    {
      $cssfilemsg = '<div style="color:#f00;font-weight:bold; text-align:center;">[' . JText::_('JGA_CONFIG_GS_PD_CSS_CONFIGURATION_NOT_WRITEABLE') . ' ' . JText::_('JGA_COMMON_CHECK_PERMISSIONS') . ']</div>';
    }

    // Check whether additional plugins for displaying images are enabled
    $display_plugins_enabled = false;
    JPluginHelper::importPlugin('joomgallery');
    $this->_mainframe->triggerEvent('onJoomOpenImage', array(&$display_plugins_enabled));
    if($display_plugins_enabled)
    {
      $display_plugins_enabled = true;
    }

    // Exif
    require_once(JPATH_COMPONENT.DS.'includes'.DS.'exifarray.php');

    $ifdotags   = explode (',', $this->_config->get('jg_ifdotags'));
    $subifdtags = explode (',', $this->_config->get('jg_subifdtags'));
    $gpstags    = explode (',', $this->_config->get('jg_gpstags'));

    $exif_definitions = array(
      1 => array ('TAG' => "IFD0", 'JG' => $ifdotags, 'NAME' => "jg_ifdotags[]", 'HEAD' => JText::_('JGSE_IFD0TAGS')),
      2 => array ('TAG' => "EXIF", 'JG' => $subifdtags, 'NAME' => "jg_subifdtags[]", 'HEAD' => JText::_('JGSE_SUBIFDTAGS')),
      3 => array ('TAG' => "GPS",  'JG' => $gpstags,  'NAME' => "jg_gpstags[]",  'HEAD' => JText::_('JGSE_GPSTAGS'))
    );

    // IPTC
    require_once(JPATH_COMPONENT.DS.'includes'.DS.'iptcarray.php');

    $iptctags   = explode (',', $this->_config->get('jg_iptctags'));

    $iptc_definitions = array(
    1 => array ('TAG' => "IPTC", 'JG' => $iptctags, 'NAME' => "jg_iptctags[]", 'HEAD' => JText::_('JGSI_IPTCTAGS')),
    );

    // Include javascripts for checking changes in variables
    // with joom_testDefaultValues()
    $this->_doc->addScript($this->_ambit->getScript('admin.joomscript.js'));

    $this->_doc->addScriptDeclaration("    function submitbutton(pressbutton) {
      if (pressbutton == 'cpanel') {
        location.href = 'index.php?option=com_joomgallery';
        return;
      }
      if(document.adminForm.jg_paththumbs.value == '') {
         alert(JText._('JGA_CONFIG_GS_PD_ALERT_THUMBNAIL_PATH_SUPPORT'));
      } else {
        joom_testDefaultValues();
        submitform(pressbutton);
      }
    };");

    $this->_ambit->script('JGA_CONFIG_GS_PD_ALERT_THUMBNAIL_PATH_SUPPORT');

    $this->assignRef('tabs',                      $tabs);
    $this->assignRef('display',                   $display);
    $this->assignRef('cssfilemsg',                $cssfilemsg);
    $this->assignRef('exifmsg',                   $exifmsg);
    $this->assignRef('gdmsg',                     $gdmsg);
    $this->assignRef('immsg',                     $immsg);
    $this->assignRef('write_pathimages',          $write_pathimages);
    $this->assignRef('write_pathoriginalimages',  $write_pathoriginalimages);
    $this->assignRef('write_paththumbs',          $write_paththumbs);
    $this->assignRef('write_pathftpupload',       $write_pathftpupload);
    $this->assignRef('write_pathtemp',            $write_pathtemp);
    $this->assignRef('write_pathwm',              $write_pathwm);
    $this->assignRef('wmfilemsg',                 $wmfilemsg);
    $this->assignRef('display_plugins_enabled',   $display_plugins_enabled);
    $this->assignRef('exif_definitions',          $exif_definitions);
    $this->assignRef('exif_config_array',         $exif_config_array);
    $this->assignRef('iptc_definitions',          $iptc_definitions);
    $this->assignRef('iptc_config_array',         $iptc_config_array);

    parent::display();
  }
}