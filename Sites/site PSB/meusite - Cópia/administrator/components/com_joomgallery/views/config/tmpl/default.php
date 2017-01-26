<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" method="post" name="adminForm">
<?php
// start nested MainPane
$this->tabs->startPane('NestedmainPane');
// start first nested MainTab "Grundlegende Einstellungen"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'));
// start first nested tabs pane
$this->tabs->startPane('NestedPaneOne');
// start Tab "Grundlegende Einstellungen->Pfade und Verzeichnisse"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_PATH_DIRECTORIES'), 'nested-one');

JHTML::_('joomconfig.start', 'page1');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_GS_PD_CSS_CONFIGURATION_INTRO') . $this->cssfilemsg);
    if($this->display):
      JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_GS_PD_PATH_DIRECTORIES_INTRO')); ?>
    <tr align="center" valign="middle">
      <td width="15%" align="left" valign="top"><strong><?php echo JText::_('JGA_COMMON_IMAGE_PATH') . ':'; ?></strong></td>
      <td width="35%" align="left" valign="top"><input size="50" type="text" name="jg_pathimages" value="<?php echo $this->_config->jg_pathimages; ?>" /><br />[<?php echo $this->write_pathimages; ?>]</td>
      <td width="50%" align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_IMAGES_STORED'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_ORIGINALS_PATH') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_pathoriginalimages" value="<?php echo $this->_config->jg_pathoriginalimages; ?>" /><br />[<?php echo $this->write_pathoriginalimages; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_ORIGINALS_STORED'); ?> </td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_THUMBNAILS_PATH') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_paththumbs" value="<?php echo $this->_config->jg_paththumbs; ?>" /><br />[<?php echo $this->write_paththumbs; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_THUMBNAILS_STORED'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_FTPUPLOAD_PATH') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_pathftpupload" value="<?php echo $this->_config->jg_pathftpupload; ?>" /><br />[<?php echo $this->write_pathftpupload; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_FOR_FTPUPLOAD'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_TEMP_PATH') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_pathtemp" value="<?php echo $this->_config->jg_pathtemp; ?>" /><br />[<?php echo $this->write_pathtemp; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_FOR_TEMP'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_WATERMARK_PATH') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_wmpath" value="<?php echo $this->_config->jg_wmpath; ?>" /><br />[<?php echo $this->write_pathwm; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_PATH_WATERMARK_STORED'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_GS_PD_WATERMARK_FILE') . ':'; ?></strong></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_wmfile" value="<?php echo $this->_config->jg_wmfile; ?>" /><br />[<?php echo $this->wmfilemsg; ?>]</td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_GS_PD_WATERMARK_FILE_LONG'); ?></td>
    </tr>
<?php
    endif;
    $date[] = JHTML::_('select.option', '%d-%m-%Y %H:%M:%S', strftime('%d-%m-%Y %H:%M:%S'));
    $date[] = JHTML::_('select.option', '%d.%m.%Y %H:%M:%S', strftime('%d.%m.%Y %H:%M:%S'));
    $date[] = JHTML::_('select.option', '%m-%d-%Y %H:%M:%S', strftime('%m-%d-%Y %H:%M:%S'));
    $date[] = JHTML::_('select.option', '%m.%d.%Y %H:%M:%S', strftime('%m.%d.%Y %H:%M:%S'));
    $date[] = JHTML::_('select.option', '%m/%d/%Y %I:%M:%S %p', strftime('%m/%d/%Y %I:%M:%S %p'));
    $date[] = JHTML::_('select.option', '%c', strftime('%c'));
    $mc_jg_dateformat= JHTML::_('select.genericlist', $date, 'jg_dateformat', 'class="inputbox" size="1"', 'value', 'text', $this->_config->jg_dateformat);
    JHTML::_('joomconfig.row', 'jg_dateformat', 'custom', 'JGA_CONFIG_GS_PD_TIME', $mc_jg_dateformat);
    JHTML::_('joomconfig.row', 'jg_checkupdate', 'yesno', 'JGA_CONFIG_GS_PD_CHECKUPDATE', $this->_config->jg_checkupdate);
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Pfade und Verzeichnisse"
$this->tabs->endTab();
// start Tab "Grundlegende Einstellungen->Ersetzungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_BACKEND_REPLACEMENTS'), 'nested-two');

JHTML::_('joomconfig.start', 'page2');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_GS_RP_BACKEND_REPLACEMENTS_INTRO'));
    $yesno[] = JHTML::_('select.option','0', JText::_('NO'));
    $yesno[] = JHTML::_('select.option','1', JText::_('YES'));
    JHTML::_('joomconfig.row', 'jg_filenamewithjs', 'yesno', 'JGA_CONFIG_GS_RP_FILENAME_WITHJS', $this->_config->jg_filenamewithjs);
    $tl_jg_filenamesearch = '<input type="text" name="jg_filenamesearch" value="'.$this->_config->jg_filenamesearch.'" size="50" />';
    JHTML::_('joomconfig.row', 'jg_filenamesearch', 'custom', 'JGA_CONFIG_GS_RP_FILENAME_SEARCH', $tl_jg_filenamesearch);
    $tl_jg_filenamereplace = '<input type="text" name="jg_filenamereplace" value="'.$this->_config->jg_filenamereplace.'" size="50" />';
    JHTML::_('joomconfig.row', 'jg_filenamereplace', 'custom', 'JGA_CONFIG_GS_RP_FILENAME_REPLACE', $tl_jg_filenamereplace);
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Ersetzungen"
$this->tabs->endTab();
// start Tab "Grundlegende Einstellungen->Bildmanipulation"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_IMAGE_PROCESSING'), 'nested-three');

JHTML::_('joomconfig.start', 'page3');
    JHTML::_('joomconfig.intro', '<div align="center"><strong>'.$this->gdmsg.'</strong></div>');
    $thumbcreator[] = JHTML::_('select.option','gd1', JText::_('JGA_CONFIG_GS_IP_GDLIB'));
    $thumbcreator[] = JHTML::_('select.option','gd2', JText::_('JGA_CONFIG_GS_IP_GD2LIB'));
    $thumbcreator[] = JHTML::_('select.option','im', JText::_('JGA_CONFIG_GS_IP_IMAGEMAGICK'));
    $mc_jg_thumbcreation = JHTML::_('select.genericlist',$thumbcreator, 'jg_thumbcreation', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_thumbcreation);
    JHTML::_('joomconfig.row', 'jg_thumbcreation', 'custom', 'JGA_CONFIG_GS_IP_IMAGE_CREATOR', $mc_jg_thumbcreation);
    JHTML::_('joomconfig.row', 'jg_fastgd2thumbcreation', 'yesno', 'JGA_CONFIG_GS_IP_FAST_GD2_THUMBCREATION', $this->_config->jg_fastgd2thumbcreation);
    /*$tl_jg_impath = '<input type="text" name="jg_impath" value="'.$this->_config->jg_impath.'" size="50" />';
    JHTML::_('joomconfig.row', 'jg_impath', 'custom', 'JGA_CONFIG_GS_IP_PATH_TO_IMAGEMAGICK', $tl_jg_impath);*/
?>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><b><?php echo JText::_('JGA_CONFIG_GS_IP_PATH_TO_IMAGEMAGICK'); ?></b></td>
      <td align="left" valign="top"><input size="50" type="text" name="jg_impath" value="<?php echo $this->_config->jg_impath; ?>" /></td>
      <td align="left" valign="top"><?php echo $this->immsg; ?></td>
    </tr>
<?php
    JHTML::_('joomconfig.row', 'jg_resizetomaxwidth', 'yesno', 'JGA_CONFIG_GS_IP_RESIZING', $this->_config->jg_resizetomaxwidth);
    JHTML::_('joomconfig.row', 'jg_maxwidth', 'text', 'JGA_CONFIG_GS_IP_MAX_WIDTH', $this->_config->jg_maxwidth);
    JHTML::_('joomconfig.row', 'jg_picturequality', 'text', 'JGA_CONFIG_GS_IP_IMAGE_QUALITY', $this->_config->jg_picturequality);
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_GS_IP_THUMBNAILS_INTRO'));
    $directionresize[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_SAMEHIGHT'));
    $directionresize[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_SAMEWIDTH'));
    $directionresize[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_FREEHEIGHTWIDTH'));
    $mc_jg_useforresizedirection = JHTML::_('select.genericlist',$directionresize, 'jg_useforresizedirection', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_useforresizedirection);
    JHTML::_('joomconfig.row', 'jg_useforresizedirection', 'custom', 'JGA_CONFIG_GS_IP_DIRECTION_RESIZE', $mc_jg_useforresizedirection);
    $cropposition[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONLU'));
    $cropposition[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONRU'));
    $cropposition[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONC'));
    $cropposition[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONLL'));
    $cropposition[] = JHTML::_('select.option','4', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONRL'));
    $mc_jg_cropposition = JHTML::_('select.genericlist',$cropposition, 'jg_cropposition', 'class="inputbox" size="5"', 'value', 'text', $this->_config->jg_cropposition);
    JHTML::_('joomconfig.row', 'jg_cropposition', 'custom', 'JGA_CONFIG_GS_IP_CROP_POSITION', $mc_jg_cropposition);
    JHTML::_('joomconfig.row', 'jg_thumbwidth', 'text', 'JGA_CONFIG_GS_IP_THUMBNAIL_WIDTH', $this->_config->jg_thumbwidth);
    JHTML::_('joomconfig.row', 'jg_thumbheight', 'text', 'JGA_CONFIG_GS_IP_THUMBNAIL_HEIGHT', $this->_config->jg_thumbheight);
    JHTML::_('joomconfig.row', 'jg_thumbquality', 'text', 'JGA_CONFIG_GS_IP_THUMBNAIL_QUALITY', $this->_config->jg_thumbquality);
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Bildmanipulation"
$this->tabs->endTab();
// start Tab "Grundlegende Einstellungen->Backend-Upload"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_BACKEND_UPLOAD'), 'nested-four');

JHTML::_('joomconfig.start', 'page4');
    $uploadordering[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_GS_BU_NO_ORDER'));
    $uploadordering[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_GS_BU_DESCENDING'));
    $uploadordering[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_GS_BU_ASCENDING'));
    $mc_jg_uploadorder = JHTML::_('select.genericlist',$uploadordering, 'jg_uploadorder', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_uploadorder);
    JHTML::_('joomconfig.row', 'jg_uploadorder', 'custom', 'JGA_CONFIG_GS_BU_UPLOAD_ORDER', $mc_jg_uploadorder);
    JHTML::_('joomconfig.row', 'jg_useorigfilename', 'yesno', 'JGA_CONFIG_GS_BU_ORIGINAL_FILENAME', $this->_config->jg_useorigfilename);
    JHTML::_('joomconfig.row', 'jg_filenamenumber', 'yesno', 'JGA_CONFIG_GS_BU_FILENAMENUMBER', $this->_config->jg_filenamenumber);
    $delete_original[] = JHTML::_('select.option','0', JText::_('NO'));
    $delete_original[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_GS_BU_DELETE_ALL_ORIGINALS'));
    $delete_original[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_GS_BU_DELETE_ORIGINAL_CHECKBOX'));
    $mc_jg_delete_original = JHTML::_('select.genericlist',$delete_original, 'jg_delete_original', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_delete_original);
    JHTML::_('joomconfig.row', 'jg_delete_original', 'custom', 'JGA_CONFIG_GS_BU_DELETE_ORIGINAL', $mc_jg_delete_original);
    JHTML::_('joomconfig.row', 'jg_wrongvaluecolor', 'text', 'JGA_CONFIG_GS_BU_WRONG_VALUE_COLOR', $this->_config->jg_wrongvaluecolor);
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Backend-Upload"
$this->tabs->endTab();
// start Tab "Grundlegende Einstellungen->Benachrichtigungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_MESSAGES_SETTINGS'), 'nested-five');

JHTML::_('joomconfig.start', 'page5');
    $message_type[] = JHTML::_('select.option', '0', JText::_('JGA_CONFIG_GS_MS_OPTION_NONE'));
    $message_type[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_GS_MS_OPTION_MAIL'));
    $message_type[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_GS_MS_OPTION_PM'));
    $message_type[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_GS_MS_OPTION_BOTH'));
    $mc_jg_msg_upload_type = JHTML::_('select.genericlist', $message_type, 'jg_msg_upload_type', 'class="inputbox" size="4"', 'value', 'text', $this->_config->get('jg_msg_upload_type'));
    JHTML::_('joomconfig.row', 'jg_msg_upload_type', 'custom', 'JGA_CONFIG_GS_MS_UPLOAD_TYPE', $mc_jg_msg_upload_type);
    $arr_jg_msg_upload_recipients   = explode(',', $this->_config->get('jg_msg_upload_recipients'));
    $list = JHTML::_('joomselect.users', $arr_jg_msg_upload_recipients, 'jg_msg_upload_recipients[]');
    JHTML::_('joomconfig.row', 'jg_msg_upload_recipients', 'custom', 'JGA_CONFIG_GS_MS_UPLOAD_RECIPIENTS', $list);
    $mc_jg_msg_comment_type = JHTML::_('select.genericlist', $message_type, 'jg_msg_comment_type', 'class="inputbox" size="4"', 'value', 'text', $this->_config->get('jg_msg_comment_type'));
    JHTML::_('joomconfig.row', 'jg_msg_comment_type', 'custom', 'JGA_CONFIG_GS_MS_COMMENT_TYPE', $mc_jg_msg_comment_type);
    $arr_jg_msg_comment_recipients  = explode(',', $this->_config->get('jg_msg_comment_recipients'));
    $list = JHTML::_('joomselect.users', $arr_jg_msg_comment_recipients, 'jg_msg_comment_recipients[]');
    JHTML::_('joomconfig.row', 'jg_msg_comment_recipients', 'custom', 'JGA_CONFIG_GS_MS_COMMENT_RECIPIENTS', $list);
    JHTML::_('joomconfig.row', 'jg_msg_comment_toowner', 'yesno', 'JGA_CONFIG_GS_MS_COMMENT_TOOWNER', $this->_config->get('jg_msg_comment_toowner'));
    $mc_jg_msg_report_type = JHTML::_('select.genericlist', $message_type, 'jg_msg_report_type', 'class="inputbox" size="4"', 'value', 'text', $this->_config->get('jg_msg_report_type'));
    JHTML::_('joomconfig.row', 'jg_msg_report_type', 'custom', 'JGA_CONFIG_GS_MS_REPORT_TYPE', $mc_jg_msg_report_type);
    $arr_jg_msg_report_recipients  = explode(',', $this->_config->get('jg_msg_report_recipients'));
    $list = JHTML::_('joomselect.users', $arr_jg_msg_report_recipients, 'jg_msg_report_recipients[]');
    JHTML::_('joomconfig.row', 'jg_msg_report_recipients', 'custom', 'JGA_CONFIG_GS_MS_REPORT_RECIPIENTS', $list);
    $report_toowner[] = JHTML::_('select.option', '0', JText::_('NO'));
    $report_toowner[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_GS_MS_OPTION_REPORT_TOOWNER_ADDITIONALLY'));
    $report_toowner[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_GS_MS_OPTION_REPORT_TOOWNER_EXCLUSIVELY'));
    JHTML::_('joomconfig.row', 'jg_msg_report_toowner', 'yesno', 'JGA_CONFIG_GS_MS_REPORT_TOOWNER', $this->_config->get('jg_msg_report_toowner'));
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Benachrichtigungen"
$this->tabs->endTab();
// start Tab "Grundlegende Einstellungen->Zusaetzliche Funktionen"
$this->tabs->startTab(JText::_('JGA_CONFIG_GS_TAB_ADDITIONAL_FUNCTIONS'), 'nested-six');

JHTML::_('joomconfig.start', 'page6');
    JHTML::_('joomconfig.row', 'jg_realname', 'yesno', 'JGA_CONFIG_GS_AF_USERNAME_REALNAME', $this->_config->jg_realname);
    JHTML::_('joomconfig.row', 'jg_cooliris', 'yesno', 'JGA_CONFIG_GS_AF_COOLIRIS_SUPPORT', $this->_config->jg_cooliris);
    JHTML::_('joomconfig.row', 'jg_coolirislink', 'yesno', 'JGA_CONFIG_GS_AF_COOLIRIS_LINK', $this->_config->jg_coolirislink);
    JHTML::_('joomconfig.row', 'jg_contentpluginsenabled', 'yesno', 'JGA_CONFIG_GS_AF_CONTENTPLUGINS', $this->_config->get('jg_contentpluginsenabled'));
    JHTML::_('joomconfig.row', 'jg_itemid', 'text', 'JGA_CONFIG_GS_AF_ITEMID', $this->_config->get('jg_itemid'));
JHTML::_('joomconfig.end');

// end Tab "Grundlegende Einstellungen->Zusaetzliche Funktionen"
$this->tabs->endTab();
// end first nested tabs pane NestedPaneTwo
$this->tabs->endPane();
// end first nested MainTab "Grundlegende Einstellungen"
$this->tabs->endTab();

// start second nested MainTab "Benutzer-Rechte"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_USER_ACCESS_RIGHTS'));
// start second nested tabs pane
$this->tabs->startPane('NestedPaneTwo');
// start Tab "Benutzer-Rechte->Benutzer-Upload ueber 'Meine Galerie'"
$this->tabs->startTab(JText::_('JGA_CONFIG_UR_UU_USER_UPLOAD_SETTINGS'), 'nested-seven');

JHTML::_('joomconfig.start', 'page7');
    JHTML::_('joomconfig.row', 'jg_userspace', 'yesno', 'JGA_CONFIG_UR_UU_USERSPACE', $this->_config->jg_userspace);
    JHTML::_('joomconfig.row', 'jg_approve', 'yesno', 'JGA_CONFIG_UR_UU_APPROVAL_NEEDED', $this->_config->jg_approve);
    $arr_jg_category  = explode(',', $this->_config->get('jg_category'));
    $clist = JHTML::_('joomselect.allowedcategorylist', $arr_jg_category, 'jg_category[]');
    JHTML::_('joomconfig.row', 'jg_category', 'custom', 'JGA_CONFIG_UR_UU_CATEGORIES', $clist);
    JHTML::_('joomconfig.row', 'jg_usercat', 'yesno', 'JGA_CONFIG_UR_UU_USERCATEGORIES', $this->_config->jg_usercat);
    $arr_jg_usercategory  = explode(',', $this->_config->get('jg_usercategory'));
    $clist2 = JHTML::_('joomselect.allowedcategorylist', $arr_jg_usercategory, 'jg_usercategory[]');
    JHTML::_('joomconfig.row', 'jg_usercategory', 'custom', 'JGA_CONFIG_UR_UU_USERCATPARENT', $clist2);
    JHTML::_('joomconfig.row', 'jg_usercatacc', 'yesno', 'JGA_CONFIG_UR_UU_USERCATACCESS', $this->_config->jg_usercatacc);
    JHTML::_('joomconfig.row', 'jg_maxusercat', 'text', 'JGA_CONFIG_UR_UU_MAX_USERCATS', $this->_config->jg_maxusercat);
    JHTML::_('joomconfig.row', 'jg_userowncatsupload', 'yesno', 'JGA_CONFIG_UR_UU_USERCATSOWNUPLOAD', $this->_config->jg_userowncatsupload);
    JHTML::_('joomconfig.row', 'jg_maxuserimage', 'text', 'JGA_CONFIG_UR_UU_MAX_IMAGES', $this->_config->jg_maxuserimage);
    JHTML::_('joomconfig.row', 'jg_maxfilesize', 'text', 'JGA_CONFIG_UR_UU_MAX_FILESIZE', $this->_config->jg_maxfilesize);
    JHTML::_('joomconfig.row', 'jg_useruploadsingle', 'yesno', 'JGA_CONFIG_UR_UU_UPLOAD_SINGLE', $this->_config->jg_useruploadsingle);
    JHTML::_('joomconfig.row', 'jg_maxuploadfields', 'text', 'JGA_CONFIG_UR_UU_MAX_UPLOADFIELDS', $this->_config->jg_maxuploadfields);
    JHTML::_('joomconfig.row', 'jg_useruploadbatch', 'yesno', 'JGA_CONFIG_UR_UU_UPLOAD_BATCH', $this->_config->jg_useruploadbatch);
    JHTML::_('joomconfig.row', 'jg_useruploadjava', 'yesno', 'JGA_CONFIG_UR_UU_UPLOAD_JAVA', $this->_config->jg_useruploadjava);
    JHTML::_('joomconfig.row', 'jg_useruploadnumber', 'yesno', 'JGA_CONFIG_UR_UU_NUMBERING', $this->_config->jg_useruploadnumber);
    JHTML::_('joomconfig.row', 'jg_special_gif_upload', 'yesno', 'JGA_CONFIG_UR_UU_SPECIAL_GIF_UPLOAD', $this->_config->jg_special_gif_upload);
    $delete_original_user[] = JHTML::_('select.option','0', JText::_('NO'));
    $delete_original_user[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_GS_BU_DELETE_ALL_ORIGINALS'));
    $delete_original_user[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_GS_BU_DELETE_ORIGINAL_CHECKBOX'));
    $mc_jg_delete_original_user = JHTML::_('select.genericlist', $delete_original_user, 'jg_delete_original_user', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_delete_original_user);
    JHTML::_('joomconfig.row', 'jg_delete_original_user', 'custom', 'JGA_CONFIG_GS_BU_DELETE_ORIGINAL', $mc_jg_delete_original_user);
    JHTML::_('joomconfig.row', 'jg_newpiccopyright', 'yesno', 'JGA_CONFIG_UR_UU_COPYRIGHT', $this->_config->jg_newpiccopyright);
    JHTML::_('joomconfig.row', 'jg_newpicnote', 'yesno', 'JGA_CONFIG_UR_UU_UPLOADNOTE', $this->_config->jg_newpicnote);
JHTML::_('joomconfig.end');

// end Tab "Benutzer-Rechte->Benutzer-Upload ueber 'Meine Galerie'"
$this->tabs->endTab();
// start Tab "Benutzer-Rechte->Bewertungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_UR_TAB_RATING_SETTINGS'), 'nested-eight');

JHTML::_('joomconfig.start', 'page8');
    JHTML::_('joomconfig.row', 'jg_showrating', 'yesno', 'JGA_CONFIG_UR_RT_RATING', $this->_config->jg_showrating);
    JHTML::_('joomconfig.row', 'jg_maxvoting', 'text', 'JGA_CONFIG_UR_RT_HIGHEST_RATING', $this->_config->jg_maxvoting);

    $ratingcalctype[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_UR_RT_CALC_TYPE_STANDARD'));
    $ratingcalctype[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_UR_RT_CALC_TYPE_BAYES'));
    $mc_jg_ratingcalctype = JHTML::_('select.genericlist', $ratingcalctype, 'jg_ratingcalctype', 'class="inputbox" size="2"', 'value', 'text', $this->_config->jg_ratingcalctype);
    JHTML::_('joomconfig.row', 'jg_ratingcalctype', 'custom', 'JGA_CONFIG_UR_RT_CALC_TYPE', $mc_jg_ratingcalctype);
    $ratingdisplaytype[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_UR_RT_DISPLAY_TYPE_TEXT'));
    $ratingdisplaytype[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_UR_RT_DISPLAY_TYPE_GRAPHIC'));
    $mc_jg_ratingdisplaytype = JHTML::_('select.genericlist', $ratingdisplaytype, 'jg_ratingdisplaytype', 'class="inputbox" size="2"', 'value', 'text', $this->_config->jg_ratingdisplaytype);
    JHTML::_('joomconfig.row', 'jg_ratingdisplaytype', 'custom', 'JGA_CONFIG_UR_RT_DISPLAY_TYPE', $mc_jg_ratingdisplaytype);
    JHTML::_('joomconfig.row', 'jg_ajaxrating', 'yesno', 'JGA_CONFIG_UR_RT_AJAX', $this->_config->jg_ajaxrating);
    JHTML::_('joomconfig.row', 'jg_onlyreguservotes', 'yesno', 'JGA_CONFIG_UR_RT_ONLY_REGUSER', $this->_config->jg_onlyreguservotes);
    JHTML::_('joomconfig.end');

// end Tab "Benutzer-Rechte->Bewertungen"
$this->tabs->endTab();
// start Tab "Benutzer-Rechte->Kommentare"
$this->tabs->startTab(JText::_('JGA_CONFIG_UR_TAB_COMMENT_SETTINGS'), 'nested-nine');

JHTML::_('joomconfig.start', 'page9');
    JHTML::_('joomconfig.row', 'jg_showcomment', 'yesno', 'JGA_CONFIG_UR_CM_COMMENTS', $this->_config->jg_showcomment);
    JHTML::_('joomconfig.row', 'jg_anoncomment', 'yesno', 'JGA_CONFIG_UR_CM_ANONYM', $this->_config->jg_anoncomment);
    JHTML::_('joomconfig.row', 'jg_namedanoncomment', 'yesno', 'JGA_CONFIG_UR_CM_NAMED_ANONYM', $this->_config->jg_namedanoncomment);
    $commentsapprove[] = JHTML::_('select.option','0', JText::_('NO'));
    $commentsapprove[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_UR_CM_ONLY_UNREGUSERS'));
    $commentsapprove[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_UR_CM_REG_AND_UNREGUSERS'));
    $mc_jg_approvecom = JHTML::_('select.genericlist',$commentsapprove, 'jg_approvecom', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_approvecom);
    JHTML::_('joomconfig.row', 'jg_approvecom', 'custom', 'JGA_CONFIG_UR_CM_APPROVE_NEEDED', $mc_jg_approvecom);
    JHTML::_('joomconfig.row', 'jg_bbcodesupport', 'yesno', 'JGA_CONFIG_UR_CM_BBCODE', $this->_config->jg_bbcodesupport);
    JHTML::_('joomconfig.row', 'jg_smiliesupport', 'yesno', 'JGA_CONFIG_UR_CM_SMILIES', $this->_config->jg_smiliesupport);
    JHTML::_('joomconfig.row', 'jg_anismilie', 'yesno', 'JGA_CONFIG_UR_CM_ANISMILIES', $this->_config->jg_anismilie);
    $smiliescolor[] = JHTML::_('select.option','grey', JText::_('JGA_CONFIG_UR_CM_COLOR_GREY'));
    $smiliescolor[] = JHTML::_('select.option','orange', JText::_('JGA_CONFIG_UR_CM_COLOR_ORANGE'));
    $smiliescolor[] = JHTML::_('select.option','yellow', JText::_('JGA_CONFIG_UR_CM_COLOR_YELLOW'));
    $smiliescolor[] = JHTML::_('select.option','blue', JText::_('JGA_CONFIG_UR_CM_COLOR_BLUE'));
    $mc_jg_smiliescolor = JHTML::_('select.genericlist',$smiliescolor, 'jg_smiliescolor', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_smiliescolor);
    JHTML::_('joomconfig.row', 'jg_smiliescolor', 'custom', 'JGA_CONFIG_UR_CM_COLORSMILIES', $mc_jg_smiliescolor);
JHTML::_('joomconfig.end');

// end Tab "Benutzer-Rechte->Kommentare"
$this->tabs->endTab();
// end second nested tabs pane NestedPaneThree
$this->tabs->endPane();
// end first nested MainTab "Benutzer-Rechte"
$this->tabs->endTab();

// start third nested MainTab "Frontend Einstellungen"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_FRONTEND_SETTINGS'));
// start third nested tabs pane
$this->tabs->startPane('NestedPaneThree');
// start Tab "Frontend Einstellungen->Generelle Einstellungen
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-ten');

JHTML::_('joomconfig.start', 'page10');
    JHTML::_('joomconfig.row', 'jg_anchors', 'yesno', 'JGA_CONFIG_FS_GS_ANCHORS', $this->_config->jg_anchors);
    $tooltips[] = JHTML::_('select.option', 0, JText::_('JGA_CONFIG_FS_GS_TOOLTIPS_OPTION_NO_DISPLAY'));
    $tooltips[] = JHTML::_('select.option', 1, JText::_('JGA_CONFIG_FS_GS_TOOLTIPS_OPTION_DEFAULT_STYLE'));
    $tooltips[] = JHTML::_('select.option', 2, JText::_('JGA_CONFIG_FS_GS_TOOLTIPS_OPTION_OWN_STYLE'));
    $mc_jg_tooltips = JHTML::_('select.genericlist', $tooltips, 'jg_tooltips', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_tooltips);
    JHTML::_('joomconfig.row', 'jg_tooltips', 'custom', 'JGA_CONFIG_FS_GS_TOOLTIPS', $mc_jg_tooltips);
    JHTML::_('joomconfig.row', 'jg_dyncrop', 'yesno', 'JGA_CONFIG_FS_GS_DYNCROP', $this->_config->jg_dyncrop);
    $dyncropposition[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONLU'));
    $dyncropposition[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONRU'));
    $dyncropposition[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONC'));
    $dyncropposition[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONLL'));
    $dyncropposition[] = JHTML::_('select.option','4', JText::_('JGA_CONFIG_GS_IP_CROP_POSITIONRL'));
    $mc_jg_dyncropposition = JHTML::_('select.genericlist',$cropposition, 'jg_dyncropposition', 'class="inputbox" size="5"', 'value', 'text', $this->_config->jg_dyncropposition);
    JHTML::_('joomconfig.row', 'jg_dyncropposition', 'custom', 'JGA_CONFIG_FS_GS_DYNCROP_POSITION', $mc_jg_dyncropposition);
    JHTML::_('joomconfig.row', 'jg_dyncropwidth', 'text', 'JGA_CONFIG_FS_GS_DYNCROP_WIDTH', $this->_config->jg_dyncropwidth);
    JHTML::_('joomconfig.row', 'jg_dyncropheight', 'text', 'JGA_CONFIG_FS_GS_DYNCROP_HEIGHT', $this->_config->jg_dyncropheight);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->Generelle Einstellungen"
$this->tabs->endTab();
// start Tab "Frontend Einstellungen->Anordnung der Bilder"
$this->tabs->startTab(JText::_('JGA_CONFIG_FS_TAB_IMAGE_ORDERING'), 'nested-eleven');

JHTML::_('joomconfig.start', 'page10');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_FS_IO_INTRO'));
    $picorder[] = JHTML::_('select.option','ordering ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_ASC'));
    $picorder[] = JHTML::_('select.option','ordering DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_DESC'));
    $picorder[] = JHTML::_('select.option','imgdate ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_ASC'));
    $picorder[] = JHTML::_('select.option','imgdate DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_DESC'));
    $picorder[] = JHTML::_('select.option','imgtitle ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_ASC'));
    $picorder[] = JHTML::_('select.option','imgtitle DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_DESC'));
    $mc_jg_firstorder = JHTML::_('select.genericlist',$picorder, 'jg_firstorder', 'class="inputbox" size="1"', 'value', 'text', $this->_config->jg_firstorder);
    JHTML::_('joomconfig.row', 'jg_firstorder', 'custom', 'JGA_CONFIG_FS_IO_FIRST', $mc_jg_firstorder);
    $picorder2[] = JHTML::_('select.option','', JText::_('JGA_CONFIG_FS_IO_NO'));
    $picorder2[] = JHTML::_('select.option','ordering ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_ASC'));
    $picorder2[] = JHTML::_('select.option','ordering DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_DESC'));
    $picorder2[] = JHTML::_('select.option','imgdate ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_ASC'));
    $picorder2[] = JHTML::_('select.option','imgdate DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_DESC'));
    $picorder2[] = JHTML::_('select.option','imgtitle ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_ASC'));
    $picorder2[] = JHTML::_('select.option','imgtitle DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_DESC'));
    $mc_jg_secondorder = JHTML::_('select.genericlist', $picorder2, 'jg_secondorder', 'class="inputbox" size="1"', 'value', 'text', $this->_config->jg_secondorder);
    JHTML::_('joomconfig.row', 'jg_secondorder', 'custom', 'JGA_CONFIG_FS_IO_SECOND', $mc_jg_secondorder);
    $picorder3[] = JHTML::_('select.option','', JText::_('JGA_CONFIG_FS_IO_NO'));
    $picorder3[] = JHTML::_('select.option','ordering ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_ASC'));
    $picorder3[] = JHTML::_('select.option','ordering DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_ORDERING_DESC'));
    $picorder3[] = JHTML::_('select.option','imgdate ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_ASC'));
    $picorder3[] = JHTML::_('select.option','imgdate DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_UPLOADTIME_DESC'));
    $picorder3[] = JHTML::_('select.option','imgtitle ASC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_ASC'));
    $picorder3[] = JHTML::_('select.option','imgtitle DESC', JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_DESC'));
    $mc_jg_thirdorder = JHTML::_('select.genericlist', $picorder3, 'jg_thirdorder', 'class="inputbox" size="1"', 'value', 'text', $this->_config->jg_thirdorder);
    JHTML::_('joomconfig.row', 'jg_thirdorder', 'custom', 'JGA_CONFIG_FS_IO_THIRD', $mc_jg_thirdorder);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->Anordnung der Bilder"
$this->tabs->endTab();
// start Tab "Frontend Einstellungen->Seitentitel"
$this->tabs->startTab(JText::_('JGA_CONFIG_FS_TAB_PAGETITLE_SETTINGS'), 'nested-twelve');

JHTML::_('joomconfig.start', 'page11');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_FS_PT_PAGETITLE_SETTINGS_INTRO'));
    JHTML::_('joomconfig.row', 'jg_pagetitle_cat', 'text', 'JGA_CONFIG_FS_PT_CATVIEW', $this->_config->jg_pagetitle_cat);
    JHTML::_('joomconfig.row', 'jg_pagetitle_detail', 'text', 'JGA_CONFIG_FS_PT_DETAILVIEW', $this->_config->jg_pagetitle_detail);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->Seitentitel"
$this->tabs->endTab();
// start Tab "Frontend Einstellungen->Kopf- und Fussbereich"
$this->tabs->startTab(JText::_('JGA_CONFIG_FS_TAB_HEADER_AND_FOOTER'), 'nested-thirteen');

JHTML::_('joomconfig.start', 'page12');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_FS_HF_INTRO'));
    JHTML::_('joomconfig.row', 'jg_showgalleryhead', 'yesno', 'JGA_CONFIG_FS_HF_GALLERYHEAD', $this->_config->jg_showgalleryhead);
    $pathway[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $pathway[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $pathway[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $pathway[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $mc_jg_showpathway = JHTML::_('select.genericlist', $pathway, 'jg_showpathway', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showpathway);
    JHTML::_('joomconfig.row', 'jg_showpathway', 'custom', 'JGA_CONFIG_FS_HF_PATHWAY', $mc_jg_showpathway);
    JHTML::_('joomconfig.row', 'jg_completebreadcrumbs', 'yesno', 'JGA_CONFIG_FS_HF_BREADCRUMBS', $this->_config->jg_completebreadcrumbs);
    $search[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $search[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $search[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $search[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $mc_jg_search = JHTML::_('select.genericlist', $search, 'jg_search', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_search);
    JHTML::_('joomconfig.row', 'jg_search', 'custom', 'JGA_CONFIG_FS_HF_SEARCHFIELD', $mc_jg_search);
    $shownumbpics[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $shownumbpics[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $shownumbpics[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $shownumbpics[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $mc_jg_showallpics = JHTML::_('select.genericlist', $shownumbpics, 'jg_showallpics', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showallpics);
    JHTML::_('joomconfig.row', 'jg_showallpics', 'custom', 'JGA_CONFIG_FS_HF_ALLIMAGES', $mc_jg_showallpics);
    $shownumbhits[] = JHTML::_('select.option', '0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $shownumbhits[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $shownumbhits[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $shownumbhits[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $mc_jg_showallhits = JHTML::_('select.genericlist', $shownumbhits, 'jg_showallhits', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showallhits);
    JHTML::_('joomconfig.row', 'jg_showallhits', 'custom', 'JGA_CONFIG_FS_HF_ALLHITS', $mc_jg_showallhits);
    $showbacklink[] = JHTML::_('select.option', '0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $showbacklink[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $showbacklink[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $showbacklink[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $mc_jg_showbacklink = JHTML::_('select.genericlist', $showbacklink, 'jg_showbacklink', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showbacklink);
    JHTML::_('joomconfig.row', 'jg_showbacklink', 'custom', 'JGA_CONFIG_FS_HF_BACKLINK', $mc_jg_showbacklink);
    JHTML::_('joomconfig.row', 'jg_suppresscredits', 'yesno', 'JGA_CONFIG_FS_HF_CREDITS', $this->_config->jg_suppresscredits);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->Kopf- und Fussbereich"
$this->tabs->endTab();
// start Tab "Frontend Einstellungen->Meine Galerie"
$this->tabs->startTab(JText::_('JGA_CONFIG_FS_TAB_USER_PANEL'), 'nested-fourteen');

JHTML::_('joomconfig.start', 'page13');
    $suserpanel[] = JHTML::_('select.option', '0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $suserpanel[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_COMMON_OPTION_TO_RMSM'));
    $suserpanel[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_COMMON_OPTION_TO_SM'));
    $suserpanel[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_COMMON_OPTION_TO_ALL'));
    $mc_jg_showuserpanel = JHTML::_('select.genericlist', $suserpanel, 'jg_showuserpanel', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showuserpanel);
    JHTML::_('joomconfig.row', 'jg_showuserpanel', 'custom', 'JGA_CONFIG_FS_UP_USER_PANEL', $mc_jg_showuserpanel);
    JHTML::_('joomconfig.row', 'jg_showallpicstoadmin', 'yesno', 'JGA_CONFIG_FS_UP_ALLPICSTOADMIN', $this->_config->jg_showallpicstoadmin);
    JHTML::_('joomconfig.row', 'jg_showminithumbs', 'yesno', 'JGA_CONFIG_FS_UP_MINITHUMBS', $this->_config->jg_showminithumbs);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->Meine Galerie"
$this->tabs->endTab();
// start Tab "Frontend Einstellungen->PopUp-Funktionen"
$this->tabs->startTab(JText::_('JGA_CONFIG_FS_TAB_POPUP_FUNCTIONS'), 'nested-fifteen');

JHTML::_('joomconfig.start', 'page14');
    JHTML::_('joomconfig.row', 'jg_openjs_padding', 'text', 'JGA_CONFIG_FS_PF_OPENJS_BORDERPX', $this->_config->jg_openjs_padding);
?>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_FS_PF_OPENJS_BACKGROUND'); ?></strong></td>
      <td align="left" valign="top"><input type="text" name="jg_openjs_background" value="<?php echo $this->_config->jg_openjs_background; ?>" /></td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_FS_PF_OPENJS_BACKGROUND_LONG') . ' ' . JText::_('JGA_CONFIG_COMMON_STYLE_COLOR_HEX'); ?></td>
    </tr>
    <tr align="center" valign="middle">
      <td align="left" valign="top"><strong><?php echo JText::_('JGA_CONFIG_FS_PF_DHTML_BORDER'); ?></strong></td>
      <td align="left" valign="top"><input type="text" name="jg_dhtml_border" value="<?php echo $this->_config->jg_dhtml_border; ?>" /></td>
      <td align="left" valign="top"><?php echo JText::_('JGA_CONFIG_FS_PF_DHTML_BORDER_LONG') . ' ' . JText::_('JGA_CONFIG_COMMON_STYLE_COLOR_HEX'); ?></td>
    </tr>
<?php
    JHTML::_('joomconfig.row', 'jg_show_title_in_dhtml', 'yesno', 'JGA_CONFIG_FS_PF_DHTML_TITLE', $this->_config->jg_show_title_in_dhtml);
    JHTML::_('joomconfig.row', 'jg_show_description_in_dhtml', 'yesno', 'JGA_CONFIG_FS_PF_DHTML_DESCRIPTION', $this->_config->jg_show_description_in_dhtml);
    JHTML::_('joomconfig.row', 'jg_lightbox_speed', 'text', 'JGA_CONFIG_FS_PF_SLIMBOX_SPEED', $this->_config->jg_lightbox_speed);
    JHTML::_('joomconfig.row', 'jg_lightbox_slide_all', 'yesno', 'JGA_CONFIG_FS_PF_SLIDEALL', $this->_config->jg_lightbox_slide_all);
    JHTML::_('joomconfig.row', 'jg_resize_js_image', 'yesno', 'JGA_CONFIG_FS_PF_JSIMAGERESIZE', $this->_config->jg_resize_js_image);
    JHTML::_('joomconfig.row', 'jg_disable_rightclick_original', 'yesno', 'JGA_CONFIG_FS_PF_DISABLE_RIGHTCLICK', $this->_config->jg_disable_rightclick_original);
JHTML::_('joomconfig.end');

// end Tab "Frontend Einstellungen->PopUp-Funktionen"
$this->tabs->endTab();
// end third nested tabs pane NestedPaneFour
$this->tabs->endPane();
// end third nested MainTab "Frontend Einstellungen"
$this->tabs->endTab();

// start fourth nested MainTab "Galerie-Ansicht"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_GALLERY_VIEW'));
// start fourth nested tabs pane
$this->tabs->startPane('NestedPaneFour');
// start Tab "Galerie-Ansicht->Generelle Einstellungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-sixteen');

JHTML::_('joomconfig.start', 'page15');
    JHTML::_('joomconfig.row', 'jg_showgallerysubhead', 'yesno', 'JGA_CONFIG_GV_GS_PATHWAY', $this->_config->jg_showgallerysubhead);
    JHTML::_('joomconfig.row', 'jg_showallcathead', 'yesno', 'JGA_CONFIG_GV_GS_CATEGORYHEADER', $this->_config->jg_showallcathead);
    JHTML::_('joomconfig.row', 'jg_colcat', 'text', 'JGA_CONFIG_GV_GS_NUMB_COLUMN', $this->_config->jg_colcat);
    JHTML::_('joomconfig.row', 'jg_catperpage', 'text', 'JGA_CONFIG_GV_GS_CATS_PER_PAGE', $this->_config->jg_catperpage);
    JHTML::_('joomconfig.row', 'jg_ordercatbyalpha', 'yesno', 'JGA_CONFIG_GV_GS_CATS_BY_ALPHA', $this->_config->jg_ordercatbyalpha);
    $showpagecatnavi[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_ONLY'));
    $showpagecatnavi[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_AND_BOTTOM'));
    $showpagecatnavi[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_BOTTOM_ONLY'));
    $mc_jg_showgallerypagenav = JHTML::_('select.genericlist', $showpagecatnavi, 'jg_showgallerypagenav', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showgallerypagenav);
    JHTML::_('joomconfig.row', 'jg_showgallerypagenav', 'custom', 'JGA_CONFIG_GV_GS_PAGENAVIGATION', $mc_jg_showgallerypagenav);
    JHTML::_('joomconfig.row', 'jg_showcatcount', 'yesno', 'JGA_CONFIG_GV_GS_NUMB_CATS', $this->_config->jg_showcatcount);
    $catthumbs[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NONE'));
    $catthumbs[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_RANDOM'));
    $catthumbs[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_MYCHOISE'));
    $mc_jg_showcatthumb = JHTML::_('select.genericlist', $catthumbs, 'jg_showcatthumb', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showcatthumb);
    JHTML::_('joomconfig.row', 'jg_showcatthumb', 'custom', 'JGA_CONFIG_COMMON_CATEGORYTHUMBNAIL', $mc_jg_showcatthumb);
    $randomcatthumbs[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_FROM_PARENT_CAT_ONLY'));
    $randomcatthumbs[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_FROM_CHILD_CAT_ONLY'));
    $randomcatthumbs[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_FROM_BOTH'));
    $mc_jg_showrandomcatthumb = JHTML::_('select.genericlist', $randomcatthumbs, 'jg_showrandomcatthumb', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showrandomcatthumb);
    JHTML::_('joomconfig.row', 'jg_showrandomcatthumb', 'custom', 'JGA_CONFIG_COMMON_RANDOMCATTHUMB', $mc_jg_showrandomcatthumb);
    $cthumbalign[] = JHTML::_('select.option','1', JText::_('JGA_COMMON_OPTION_FLUSH_LEFT'));
    $cthumbalign[] = JHTML::_('select.option','2', JText::_('JGA_COMMON_OPTION_FLUSH_RIGHT'));
    $cthumbalign[] = JHTML::_('select.option','0', JText::_('JGA_COMMON_OPTION_CHANGING'));
    $cthumbalign[] = JHTML::_('select.option','3', JText::_('JGA_COMMON_OPTION_CENTERED'));
    $mc_jg_ctalign = JHTML::_('select.genericlist', $cthumbalign, 'jg_ctalign', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_ctalign);
    JHTML::_('joomconfig.row', 'jg_ctalign', 'custom', 'JGA_CONFIG_GV_GS_CATTHUMBALIGN', $mc_jg_ctalign);
    JHTML::_('joomconfig.row', 'jg_showtotalcatimages', 'yesno', 'JGA_CONFIG_COMMON_CATEGORY_IMAGES', $this->_config->jg_showtotalcatimages);
    JHTML::_('joomconfig.row', 'jg_showtotalcathits', 'yesno', 'JGA_CONFIG_COMMON_CATEGORY_HITS', $this->_config->jg_showtotalcathits);
    JHTML::_('joomconfig.row', 'jg_showcatasnew', 'yesno', 'JGA_CONFIG_GV_GS_CATASNEW', $this->_config->jg_showcatasnew);
    JHTML::_('joomconfig.row', 'jg_catdaysnew', 'text', 'JGA_CONFIG_GV_GS_CATDAYSNEW', $this->_config->jg_catdaysnew);
    JHTML::_('joomconfig.row', 'jg_showdescriptioningalleryview', 'yesno', 'JGA_CONFIG_GV_GS_DESCRIPTION', $this->_config->get('jg_showdescriptioningalleryview'));
    JHTML::_('joomconfig.row', 'jg_rmsm', 'yesno', 'JGA_CONFIG_GV_GS_RMSM_SHOW', $this->_config->jg_rmsm);
    JHTML::_('joomconfig.row', 'jg_showrmsmcats', 'yesno', 'JGA_CONFIG_GV_GS_RMSM_ANYWAY', $this->_config->jg_showrmsmcats);
    JHTML::_('joomconfig.row', 'jg_showsubsingalleryview', 'yesno', 'JGA_CONFIG_GV_GS_SUBCATEGORIES', $this->_config->jg_showsubsingalleryview);
JHTML::_('joomconfig.end');

// end Tab "Galerie-Ansicht->Generelle Einstellungen"
$this->tabs->endTab();
// end fourth nested tabs pane NestedPaneFive
$this->tabs->endPane();
// end fourth nested MainTab "Galerie-Ansicht"
$this->tabs->endTab();

// start fifth nested MainTab "Kategorie-Ansicht"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_CATEGORY_VIEW'));
// start fifth nested tabs pane
$this->tabs->startPane('NestedPaneFive');
// start Tab "Kategorie-Ansicht->Generelle Einstellungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-seventeen');

JHTML::_('joomconfig.start', 'page16');
    JHTML::_('joomconfig.row', 'jg_showcathead', 'yesno', 'JGA_CONFIG_CV_GS_CATEGORYTITLE', $this->_config->jg_showcathead);
    JHTML::_('joomconfig.row', 'jg_usercatorder', 'yesno', 'JGA_CONFIG_CV_GS_ORDERBY_USER', $this->_config->jg_usercatorder);
    $arr_jg_usercatorderlist = explode(',', $this->_config->get('jg_usercatorderlist'));
    $catorderlist[] = JHTML::_('select.option', 'date', JText::_('JGA_CONFIG_CV_GS_USER_ORDERBY_DATE'));
    $catorderlist[] = JHTML::_('select.option', 'user', JText::_('JGA_CONFIG_CV_GS_USER_ORDERBY_AUTHOR'));
    $catorderlist[] = JHTML::_('select.option', 'title', JText::_('JGA_CONFIG_CV_GS_USER_ORDERBY_TITLE'));
    $catorderlist[] = JHTML::_('select.option', 'hits', JText::_('JGA_CONFIG_CV_GS_USER_ORDERBY_HITS'));
    $catorderlist[] = JHTML::_('select.option', 'rating', JText::_('JGA_CONFIG_CV_GS_USER_ORDERBY_RATING'));
    $mc_jg_usercatorderlist = JHTML::_('select.genericlist', $catorderlist, 'jg_usercatorderlist[]', 'class="inputbox" size="5" multiple="multiple"', 'value', 'text', $arr_jg_usercatorderlist);
    JHTML::_('joomconfig.row', 'jg_usercatorderlist', 'custom', 'JGA_CONFIG_CV_GS_ORDERBY_LIST', $mc_jg_usercatorderlist);
    JHTML::_('joomconfig.row', 'jg_showcatdescriptionincat', 'yesno', 'JGA_CONFIG_CV_GS_CATDESCRIPTIONINCAT', $this->_config->jg_showcatdescriptionincat);
    JHTML::_('joomconfig.row', 'jg_colnumb', 'text', 'JGA_CONFIG_CV_GS_NUMB_COLUMN', $this->_config->jg_colnumb);
    JHTML::_('joomconfig.row', 'jg_perpage', 'text', 'JGA_CONFIG_CV_GS_IMGS_PER_PAGE', $this->_config->jg_perpage);
    $catthumbalign[] = JHTML::_('select.option','1', JText::_('JGA_COMMON_OPTION_FLUSH_LEFT'));
    $catthumbalign[] = JHTML::_('select.option','3', JText::_('JGA_COMMON_OPTION_CENTERED'));
    $catthumbalign[] = JHTML::_('select.option','2', JText::_('JGA_COMMON_OPTION_FLUSH_RIGHT'));
    $mc_jg_catthumbalign = JHTML::_('select.genericlist', $catthumbalign, 'jg_catthumbalign', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_catthumbalign);
    JHTML::_('joomconfig.row', 'jg_catthumbalign', 'custom', 'JGA_CONFIG_COMMON_CATEGORY_THUMBALIGN', $mc_jg_catthumbalign);
    $showpagenavi[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_ONLY'));
    $showpagenavi[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_AND_BOTTOM'));
    $showpagenavi[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_BOTTOM_ONLY'));
    $mc_jg_showpagenav = JHTML::_('select.genericlist', $showpagenavi, 'jg_showpagenav', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showpagenav);
    JHTML::_('joomconfig.row', 'jg_showpagenav', 'custom', 'JGA_CONFIG_COMMON_CATEGORY_PAGENAVIGATION', $mc_jg_showpagenav);
    JHTML::_('joomconfig.row', 'jg_showpiccount', 'yesno', 'JGA_CONFIG_CV_GS_NUMB_CATIMAGES', $this->_config->jg_showpiccount);
    $detailpic_open[] = JHTML::_('select.option', '0', JText::_('JGA_CONFIG_CV_GS_OPEN_DEFAULT'));
    $detailpic_open[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_CV_GS_OPEN_BLANK_WINDOW'));
    $detailpic_open[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_CV_GS_OPEN_JS_WINDOW'));
    $detailpic_open[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_CV_GS_OPEN_DHTML'));
    #$detailpic_open[] = JHTML::_('select.option', '4', JText::_('JGA_OPEN_MODAL'));
    $detailpic_open[] = JHTML::_('select.option', '5', JText::_('JGA_CONFIG_CV_GS_OPEN_THICKBOX3'));
    $detailpic_open[] = JHTML::_('select.option', '6', JText::_('JGA_CONFIG_CV_GS_OPEN_SLIMBOX'));
    if($this->display_plugins_enabled):
      $detailpic_open[] = JHTML::_('select.option', '12', JText::_('JGA_CONFIG_CV_GS_OPEN_PLUGIN'));
      $list_size = 7;
    else:
      $list_size = 6;
    endif;
    $mc_jg_detailpic_open = JHTML::_('select.genericlist', $detailpic_open, 'jg_detailpic_open', 'class="inputbox" size="'.$list_size.'"', 'value', 'text', $this->_config->jg_detailpic_open);
    JHTML::_('joomconfig.row', 'jg_detailpic_open', 'custom', 'JGA_CONFIG_CV_GS_OPEN_DETAIL_VIEW', $mc_jg_detailpic_open);
    JHTML::_('joomconfig.row', 'jg_lightboxbigpic', 'yesno', 'JGA_CONFIG_CV_GS_POPUP_ORIGINAL', $this->_config->jg_lightboxbigpic);
    JHTML::_('joomconfig.row', 'jg_showtitle', 'yesno', 'JGA_CONFIG_CV_GS_TITLE', $this->_config->jg_showtitle);
    JHTML::_('joomconfig.row', 'jg_showpicasnew', 'yesno', 'JGA_CONFIG_CV_GS_ASNEW', $this->_config->jg_showpicasnew);
    JHTML::_('joomconfig.row', 'jg_daysnew', 'text', 'JGA_CONFIG_CV_GS_DAYSNEW', $this->_config->jg_daysnew);
    JHTML::_('joomconfig.row', 'jg_showhits', 'yesno', 'JGA_CONFIG_CV_GS_HITS', $this->_config->jg_showhits);
    JHTML::_('joomconfig.row', 'jg_showauthor', 'yesno', 'JGA_CONFIG_CV_GS_AUTHOR', $this->_config->jg_showauthor);
    JHTML::_('joomconfig.row', 'jg_showowner', 'yesno', 'JGA_CONFIG_CV_GS_OWNER', $this->_config->jg_showowner);
    JHTML::_('joomconfig.row', 'jg_showcatcom', 'yesno', 'JGA_CONFIG_CV_GS_COMMENTS', $this->_config->jg_showcatcom);
    JHTML::_('joomconfig.row', 'jg_showcatrate', 'yesno', 'JGA_CONFIG_CV_GS_RATINGS', $this->_config->jg_showcatrate);
    JHTML::_('joomconfig.row', 'jg_showcatdescription', 'yesno', 'JGA_CONFIG_CV_GS_DESCRIPTION', $this->_config->jg_showcatdescription);
    $showcategorydownload[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $showcategorydownload[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TO_RMSM'));
    $showcategorydownload[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TO_SM'));
    $showcategorydownload[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_TO_ALL'));
    $mc_jg_showcategorydownload = JHTML::_('select.genericlist', $showcategorydownload, 'jg_showcategorydownload', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showcategorydownload);
    JHTML::_('joomconfig.row', 'jg_showcategorydownload', 'custom', 'JGA_CONFIG_COMMON_DOWNLOAD', $mc_jg_showcategorydownload);
    JHTML::_('joomconfig.row', 'jg_showcategoryfavourite', 'yesno', 'JGA_CONFIG_CV_GS_FAVOURITES', $this->_config->jg_showcategoryfavourite);
    $categoryreportimages[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $categoryreportimages[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_ONLY_REGUSERS'));
    $categoryreportimages[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_REG_AND_UNREGUSERS'));
    $mc_jg_categoryreportimages = JHTML::_('select.genericlist', $categoryreportimages, 'jg_category_report_images', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_category_report_images);
    JHTML::_('joomconfig.row', 'jg_category_report_images', 'custom', 'JGA_CONFIG_CV_GS_REPORT_IMAGES', $mc_jg_categoryreportimages);
JHTML::_('joomconfig.end');

// end Tab "Kategorie-Ansicht->Generelle Einstellungen"
$this->tabs->endTab();
// start Tab "Kategorie-Ansicht->Unterkategorien"
$this->tabs->startTab(JText::_('JGA_CONFIG_CV_TAB_SUBCAT_SETTINGS'), 'nested-eighteen');

JHTML::_('joomconfig.start', 'page17');
    JHTML::_('joomconfig.row', 'jg_showsubcathead', 'yesno', 'JGA_CONFIG_CV_SC_SUBCATEGORYHEADER', $this->_config->jg_showsubcathead);
    JHTML::_('joomconfig.row', 'jg_showsubcatcount', 'yesno', 'JGA_CONFIG_CV_SC_NUMB_SUBCATEGORIES', $this->_config->jg_showsubcatcount);
    JHTML::_('joomconfig.row', 'jg_colsubcat', 'text', 'JGA_CONFIG_CV_SC_NUMB_COLUMN', $this->_config->jg_colsubcat);
    JHTML::_('joomconfig.row', 'jg_subperpage', 'text', 'JGA_CONFIG_CV_SC_SUBCATS_PER_PAGE', $this->_config->jg_subperpage);
    $showpagenavisubs[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_ONLY'));
    $showpagenavisubs[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TOP_AND_BOTTOM'));
    $showpagenavisubs[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_BOTTOM_ONLY'));
    $mc_jg_showpagenavsubs = JHTML::_('select.genericlist', $showpagenavisubs, 'jg_showpagenavsubs', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showpagenavsubs);
    JHTML::_('joomconfig.row', 'jg_showpagenavsubs', 'custom', 'JGA_CONFIG_COMMON_CATEGORY_PAGENAVIGATION', $mc_jg_showpagenavsubs);
    $subcatthumbalign[] = JHTML::_('select.option','1', JText::_('JGA_COMMON_OPTION_FLUSH_LEFT'));
    $subcatthumbalign[] = JHTML::_('select.option','3', JText::_('JGA_COMMON_OPTION_CENTERED'));
    $subcatthumbalign[] = JHTML::_('select.option','2', JText::_('JGA_COMMON_OPTION_FLUSH_RIGHT'));
    $mc_jg_subcatthumbalign = JHTML::_('select.genericlist', $subcatthumbalign, 'jg_subcatthumbalign', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_subcatthumbalign);
    JHTML::_('joomconfig.row', 'jg_subcatthumbalign', 'custom', 'JGA_CONFIG_COMMON_CATEGORY_THUMBALIGN', $mc_jg_subcatthumbalign);
    $subthumbs[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NONE'));
    $subthumbs[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_MYCHOISE'));
    $subthumbs[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_RANDOM'));
    $mc_jg_showsubthumbs = JHTML::_('select.genericlist', $subthumbs, 'jg_showsubthumbs', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showsubthumbs);
    JHTML::_('joomconfig.row', 'jg_showsubthumbs', 'custom', 'JGA_CONFIG_COMMON_CATEGORYTHUMBNAIL', $mc_jg_showsubthumbs);
    $randomsubthumbs[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_FROM_PARENT_CAT_ONLY'));
    $randomsubthumbs[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_FROM_CHILD_CAT_ONLY'));
    $randomsubthumbs[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_FROM_BOTH'));
    $mc_jg_showrandomsubthumb = JHTML::_('select.genericlist', $randomsubthumbs, 'jg_showrandomsubthumb', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showrandomsubthumb);
    JHTML::_('joomconfig.row', 'jg_showrandomsubthumb', 'custom', 'JGA_CONFIG_COMMON_RANDOMCATTHUMB', $mc_jg_showrandomsubthumb);
    JHTML::_('joomconfig.row', 'jg_showdescriptionincategoryview', 'yesno', 'JGA_CONFIG_CV_SC_DESCRIPTION', $this->_config->get('jg_showdescriptionincategoryview'));
    JHTML::_('joomconfig.row', 'jg_ordersubcatbyalpha', 'yesno', 'JGA_CONFIG_CV_SC_ORDER_BY_ALPHA', $this->_config->jg_ordersubcatbyalpha);
    JHTML::_('joomconfig.row', 'jg_showtotalsubcatimages', 'yesno', 'JGA_CONFIG_COMMON_CATEGORY_IMAGES', $this->_config->jg_showtotalsubcatimages);
    JHTML::_('joomconfig.row', 'jg_showtotalsubcathits', 'yesno', 'JGA_CONFIG_COMMON_CATEGORY_HITS', $this->_config->jg_showtotalsubcathits);
JHTML::_('joomconfig.end');

// end Tab "Kategorie-Ansicht->Unterkategorien"
$this->tabs->endTab();
// end fifth nested tabs pane NestedPaneSix
$this->tabs->endPane();
// end fifth nested MainTab "Kategorie-Ansicht"
$this->tabs->endTab();

// start sixth nested MainTab "Detail-Ansicht"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_DETAIL_VIEW'));
// start sixth nested tabs pane
$this->tabs->startPane('NestedPaneSix');
// start Tab "Detail-Ansicht->Generelle Einstellungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-nineteen');

JHTML::_('joomconfig.start', 'page18');
    JHTML::_('joomconfig.row', 'jg_showdetailpage', 'yesno', 'JGA_CONFIG_DV_GS_ALLOW_DETAILPAGE', $this->_config->jg_showdetailpage);
    JHTML::_('joomconfig.row', 'jg_showdetailnumberofpics', 'yesno', 'JGA_CONFIG_DV_GS_COUNTER', $this->_config->jg_showdetailnumberofpics);
    JHTML::_('joomconfig.row', 'jg_cursor_navigation', 'yesno', 'JGA_CONFIG_DV_GS_CURSOR_NAVIGATION', $this->_config->jg_cursor_navigation);
    JHTML::_('joomconfig.row', 'jg_disable_rightclick_detail', 'yesno', 'JGA_CONFIG_DV_GS_DISABLE_RIGHTCLICK', $this->_config->jg_disable_rightclick_detail);
    $detailreportimages[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $detailreportimages[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_ONLY_REGUSERS'));
    $detailreportimages[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_REG_AND_UNREGUSERS'));
    $mc_jg_detailreportimages = JHTML::_('select.genericlist', $detailreportimages, 'jg_detail_report_images', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_detail_report_images);
    JHTML::_('joomconfig.row', 'jg_detail_report_images', 'custom', 'JGA_CONFIG_DV_GS_REPORT_IMAGES', $mc_jg_detailreportimages);
    JHTML::_('joomconfig.row', 'jg_report_images_notauth', 'yesno', 'JGA_CONFIG_DV_GS_GUEST_INFORMATION', $this->_config->jg_report_images_notauth);
    $showdetailtitle[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $showdetailtitle[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_DV_GS_OPTION_UPSIDE'));
    $showdetailtitle[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_DV_GS_OPTION_BELOW'));
    $mc_jg_showdetailtitle = JHTML::_('select.genericlist', $showdetailtitle, 'jg_showdetailtitle', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_showdetailtitle);
    JHTML::_('joomconfig.row', 'jg_showdetailtitle', 'custom', 'JGA_CONFIG_DV_GS_TITLE', $mc_jg_showdetailtitle);
    JHTML::_('joomconfig.row', 'jg_showdetail', 'yesno', 'JGA_CONFIG_DV_GS_INFORMATION', $this->_config->jg_showdetail);
    JHTML::_('joomconfig.row', 'jg_showdetaildescription', 'yesno', 'JGA_CONFIG_DV_GS_DESCRIPTION', $this->_config->jg_showdetaildescription);
    JHTML::_('joomconfig.row', 'jg_showdetaildatum', 'yesno', 'JGA_CONFIG_DV_GS_DATE', $this->_config->jg_showdetaildatum);
    JHTML::_('joomconfig.row', 'jg_showdetailhits', 'yesno', 'JGA_CONFIG_DV_GS_HITS', $this->_config->jg_showdetailhits);
    JHTML::_('joomconfig.row', 'jg_showdetailrating', 'yesno', 'JGA_CONFIG_DV_GS_RATING', $this->_config->jg_showdetailrating);
    JHTML::_('joomconfig.row', 'jg_showdetailfilesize', 'yesno', 'JGA_CONFIG_DV_GS_FILESIZE', $this->_config->jg_showdetailfilesize);
    JHTML::_('joomconfig.row', 'jg_showdetailauthor', 'yesno', 'JGA_CONFIG_DV_GS_AUTHOR', $this->_config->jg_showdetailauthor);
    JHTML::_('joomconfig.row', 'jg_showoriginalfilesize', 'yesno', 'JGA_CONFIG_DV_GS_ORIGFILESIZE', $this->_config->jg_showoriginalfilesize);
    $showdownload[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $showdownload[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TO_RMSM'));
    $showdownload[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TO_SM'));
    $showdownload[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_TO_ALL'));
    $mc_jg_showdetaildownload = JHTML::_('select.genericlist', $showdownload, 'jg_showdetaildownload', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showdetaildownload);
    JHTML::_('joomconfig.row', 'jg_showdetaildownload', 'custom', 'JGA_CONFIG_COMMON_DOWNLOAD', $mc_jg_showdetaildownload);
    $downloadfile[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_DV_GS_DETAIL_ONLY'));
    $downloadfile[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_DV_GS_ORIGINAL_ONLY'));
    $downloadfile[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_DV_GS_DETAIL_IFNO_ORIGINAL'));
    $mc_jg_downloadfile = JHTML::_('select.genericlist', $downloadfile, 'jg_downloadfile', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_downloadfile);
    JHTML::_('joomconfig.row', 'jg_downloadfile', 'custom', 'JGA_CONFIG_DV_GS_DOWNLOADFILE', $mc_jg_downloadfile);
    JHTML::_('joomconfig.row', 'jg_downloadwithwatermark', 'yesno', 'JGA_CONFIG_DV_GS_DOWNLOADWITHWATERMARK', $this->_config->jg_downloadwithwatermark);
    JHTML::_('joomconfig.row', 'jg_watermark', 'yesno', 'JGA_CONFIG_DV_GS_ADD_WATERMARK', $this->_config->jg_watermark);
    $watermarkpos[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_DV_GS_OPTION_TOP_LEFT'));
    $watermarkpos[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_DV_GS_OPTION_TOP_CENTER'));
    $watermarkpos[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_DV_GS_OPTION_TOP_RIGHT'));
    $watermarkpos[] = JHTML::_('select.option', '4', JText::_('JGA_CONFIG_DV_GS_OPTION_MIDDLE_LEFT'));
    $watermarkpos[] = JHTML::_('select.option', '5', JText::_('JGA_CONFIG_DV_GS_OPTION_MIDDLE_CENTER'));
    $watermarkpos[] = JHTML::_('select.option', '6', JText::_('JGA_CONFIG_DV_GS_OPTION_MIDDLE_RIGHT'));
    $watermarkpos[] = JHTML::_('select.option', '7', JText::_('JGA_CONFIG_DV_GS_OPTION_BOTTOM_LEFT'));
    $watermarkpos[] = JHTML::_('select.option', '8', JText::_('JGA_CONFIG_DV_GS_OPTION_BOTTOM_CENTER'));
    $watermarkpos[] = JHTML::_('select.option', '9', JText::_('JGA_CONFIG_DV_GS_OPTION_BOTTOM_RIGHT'));
    $mc_jg_watermarkpos = JHTML::_('select.genericlist', $watermarkpos, 'jg_watermarkpos', 'class="inputbox" size="1"', 'value', 'text', $this->_config->jg_watermarkpos);
    JHTML::_('joomconfig.row', 'jg_watermarkpos', 'custom', 'JGA_CONFIG_DV_GS_WATERMARK_POSITION', $mc_jg_watermarkpos);
    $showbigpic[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $showbigpic[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_TO_RMSM'));
    $showbigpic[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_TO_ALL'));
    $mc_jg_bigpic = JHTML::_('select.genericlist', $showbigpic, 'jg_bigpic', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_bigpic);
    JHTML::_('joomconfig.row', 'jg_bigpic', 'custom', 'JGA_CONFIG_DV_GS_LINKTOORIGINAL', $mc_jg_bigpic);
    $showbigpic_open[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_CV_GS_OPEN_BLANK_WINDOW'));
    $showbigpic_open[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_CV_GS_OPEN_JS_WINDOW'));
    $showbigpic_open[] = JHTML::_('select.option', '3', JText::_('JGA_CONFIG_CV_GS_OPEN_DHTML'));
    #$showbigpic_open[] = JHTML::_('select.option', '4', JText::_('JGA_OPEN_MODAL'));
    $showbigpic_open[] = JHTML::_('select.option', '5', JText::_('JGA_CONFIG_CV_GS_OPEN_THICKBOX3'));
    $showbigpic_open[] = JHTML::_('select.option', '6', JText::_('JGA_CONFIG_CV_GS_OPEN_SLIMBOX'));
    if($this->display_plugins_enabled):
      $showbigpic_open[] = JHTML::_('select.option', '12', JText::_('JGA_CONFIG_CV_GS_OPEN_PLUGIN'));
      $size = 6;
    else:
      $size = 5;
    endif;
    $mc_jg_bigpic_open = JHTML::_('select.genericlist', $showbigpic_open, 'jg_bigpic_open', 'class="inputbox" size="'.$list_size.'"', 'value', 'text', $this->_config->jg_bigpic_open);
    JHTML::_('joomconfig.row', 'jg_bigpic_open', 'custom', 'JGA_CONFIG_DV_GS_OPEN_ORIGINAL', $mc_jg_bigpic_open);
    $bbcodelinks[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $bbcodelinks[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_DV_GS_BBCODE_IMG_ONLY'));
    $bbcodelinks[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_DV_GS_BBCODE_URL_ONLY'));
    $bbcodelinks[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_DV_GS_BBCODE_BOTH'));
    $mc_jg_bbcodelinks = JHTML::_('select.genericlist', $bbcodelinks, 'jg_bbcodelink', 'class="inputbox" size="4"', 'value', 'text',$this->_config->jg_bbcodelink);
    JHTML::_('joomconfig.row', 'jg_bbcodelink', 'custom', 'JGA_CONFIG_DV_GS_BBCODELINK', $mc_jg_bbcodelinks);
    JHTML::_('joomconfig.row', 'jg_showcommentsunreg', 'yesno', 'JGA_CONFIG_DV_GS_COMMENTS_REG', $this->_config->jg_showcommentsunreg);
    $showcommentsarea[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_DV_GS_OPTION_ABOVE_COMMENTS'));
    $showcommentsarea[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_DV_GS_OPTION_UNDERNEATH_COMMENTS'));
    $mc_jg_showcommentsarea = JHTML::_('select.genericlist', $showcommentsarea, 'jg_showcommentsarea', 'class="inputbox" size="2"', 'value', 'text', $this->_config->jg_showcommentsarea);
    JHTML::_('joomconfig.row', 'jg_showcommentsarea', 'custom', 'JGA_CONFIG_DV_GS_COMMENTSAREA', $mc_jg_showcommentsarea);
    JHTML::_('joomconfig.row', 'jg_send2friend', 'yesno', 'JGA_CONFIG_DV_GS_SEND2FRIEND', $this->_config->jg_send2friend);
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->Generelle Einstellungen"
$this->tabs->endTab();
// start Tab "Detail-Ansicht->Accordion"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_ACCORDION_SETTINGS'), 'nested-twenty');
JHTML::_('joomconfig.start', 'dtlaccordion');
    JHTML::_('joomconfig.row', 'jg_showdetailaccordion', 'yesno', 'JGA_CONFIG_DV_AC_ACCORDION', $this->_config->jg_showdetailaccordion);
JHTML::_('joomconfig.end');
// end Tab "Detail-Ansicht->Accordion"
$this->tabs->endTab();

// start Tab "Detail-Ansicht->Motiongallery"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_MOTIONGALLERY_SETTINGS'), 'nested-twentyone');

JHTML::_('joomconfig.start', 'page19');
    JHTML::_('joomconfig.row', 'jg_minis', 'yesno', 'JGA_CONFIG_DV_MG_MOTIONGALLERY', $this->_config->jg_minis);
    $joom_ShowMotionMinis[] = JHTML::_('select.option', '1', JText::_('JGA_CONFIG_DV_MG_OPTION_STATIC'));
    $joom_ShowMotionMinis[] = JHTML::_('select.option', '2', JText::_('JGA_CONFIG_DV_MG_OPTION_MOVEABLE'));
    $mc_jg_motionminis = JHTML::_('select.genericlist', $joom_ShowMotionMinis, 'jg_motionminis', 'class="inputbox" size="2"', 'value', 'text', $this->_config->jg_motionminis);
    JHTML::_('joomconfig.row', 'jg_motionminis', 'custom', 'JGA_CONFIG_DV_MG_DISPLAYMODE', $mc_jg_motionminis);
    JHTML::_('joomconfig.row', 'jg_motionminiWidth', 'text', 'JGA_CONFIG_DV_MG_WIDTH', $this->_config->jg_motionminiWidth);
    JHTML::_('joomconfig.row', 'jg_motionminiHeight', 'text', 'JGA_CONFIG_DV_MG_HEIGHT', $this->_config->jg_motionminiHeight);
    JHTML::_('joomconfig.row', 'jg_miniWidth', 'text', 'JGA_CONFIG_DV_MG_MINIS_MAXWIDTH', $this->_config->jg_miniWidth);
    JHTML::_('joomconfig.row', 'jg_miniHeight', 'text', 'JGA_CONFIG_DV_MG_MINIS_MAXHEIGHT', $this->_config->jg_miniHeight);
    $joom_minisprop[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_SAMEWIDTHANDHEIGHT'));
    $joom_minisprop[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_SAMEWIDTH'));
    $joom_minisprop[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_SAMEHIGHT'));
    $mc_jg_minisprop = JHTML::_('select.genericlist', $joom_minisprop, 'jg_minisprop', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_minisprop);
    JHTML::_('joomconfig.row', 'jg_minisprop', 'custom', 'JGA_CONFIG_DV_MG_MINIS_PROPORTIONS', $mc_jg_minisprop);
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->Motiongallery"
$this->tabs->endTab();
// start Tab "Detail-Ansicht->Namensschilder"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_NAMETAGS_SETTINGS'), 'nested-twentytwo');

JHTML::_('joomconfig.start', 'page20');
    JHTML::_('joomconfig.row', 'jg_nameshields', 'yesno', 'JGA_CONFIG_DV_NT_NAMETAGS', $this->_config->jg_nameshields);
    JHTML::_('joomconfig.row', 'jg_nameshields_others', 'yesno', 'JGA_CONFIG_DV_NT_OTHERS', $this->_config->jg_nameshields_others);
    JHTML::_('joomconfig.row', 'jg_nameshields_unreg', 'yesno', 'JGA_CONFIG_DV_NT_GUEST_VISIBLE', $this->_config->jg_nameshields_unreg);
    JHTML::_('joomconfig.row', 'jg_show_nameshields_unreg', 'yesno', 'JGA_CONFIG_DV_NT_GUEST_INFORMATION', $this->_config->jg_show_nameshields_unreg);
    JHTML::_('joomconfig.row', 'jg_nameshields_height', 'text', 'JGA_CONFIG_DV_NT_HEIGHT', $this->_config->jg_nameshields_height);
    JHTML::_('joomconfig.row', 'jg_nameshields_width', 'text', 'JGA_CONFIG_DV_NT_WIDTH', $this->_config->jg_nameshields_width);
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->Namensschilder"
$this->tabs->endTab();
// start Tab "Detail-Ansicht->Slideshow"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_SLIDESHOW_SETTINGS'), 'nested-twentythree');

JHTML::_('joomconfig.start', 'page21');
    JHTML::_('joomconfig.row', 'jg_slideshow', 'yesno', 'JGA_CONFIG_DV_SL_SLIDESHOW', $this->_config->jg_slideshow);
    JHTML::_('joomconfig.row', 'jg_slideshow_timer', 'text', 'JGA_CONFIG_DV_SL_TIMEFRAME', $this->_config->jg_slideshow_timer);
    $joom_transitions[] = JHTML::_('select.option','0', 'fade');
    $joom_transitions[] = JHTML::_('select.option','1', 'fadeslideleft');
    $joom_transitions[] = JHTML::_('select.option','2', 'crossfade');
    $joom_transitions[] = JHTML::_('select.option','3', 'continuoushorizontal');
    $joom_transitions[] = JHTML::_('select.option','4', 'continuousvertical');
    $joom_transitions[] = JHTML::_('select.option','5', 'fadebg');
    $mc_jg_transitions = JHTML::_('select.genericlist', $joom_transitions, 'jg_slideshow_transition', 'class="inputbox" size="6"', 'value', 'text', $this->_config->jg_slideshow_transition);
    JHTML::_('joomconfig.row', 'jg_slideshow_transition', 'custom', 'JGA_CONFIG_DV_SL_TRANSITION', $mc_jg_transitions);
    JHTML::_('joomconfig.row', 'jg_slideshow_transtime', 'text', 'JGA_CONFIG_DV_SL_TRANSITION_TIME', $this->_config->jg_slideshow_transtime);
    JHTML::_('joomconfig.row', 'jg_slideshow_maxdimauto', 'yesno', 'JGA_CONFIG_DV_SL_MAXDIMAUTO', $this->_config->jg_slideshow_maxdimauto);
    JHTML::_('joomconfig.row', 'jg_slideshow_width', 'text', 'JGA_CONFIG_DV_SL_WIDTH', $this->_config->jg_slideshow_width);
    JHTML::_('joomconfig.row', 'jg_slideshow_heigth', 'text', 'JGA_CONFIG_DV_SL_HEIGHT', $this->_config->jg_slideshow_heigth);
    JHTML::_('joomconfig.row', 'jg_slideshow_infopane', 'yesno', 'JGA_CONFIG_DV_SL_INFOPANE', $this->_config->jg_slideshow_infopane);
    JHTML::_('joomconfig.row', 'jg_slideshow_carousel', 'yesno', 'JGA_CONFIG_DV_SL_CAROUSEL', $this->_config->jg_slideshow_carousel);
    JHTML::_('joomconfig.row', 'jg_slideshow_arrows', 'yesno', 'JGA_CONFIG_DV_SL_ARROWS', $this->_config->jg_slideshow_arrows);
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->Slideshow"
$this->tabs->endTab();
// start Tab "Detail-Ansicht->Exif-Daten"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_EXIF_SETTINGS'), 'nested-twentyfour');

JHTML::_('joomconfig.start', 'page22');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_DV_ED_EXIF_INTRO_ONE').'<br />'.JText::_('JGA_CONFIG_DV_ED_EXIF_INTRO_TWO').'<br />'.$this->exifmsg);
    JHTML::_('joomconfig.row', 'jg_showexifdata', 'yesno', 'JGA_CONFIG_DV_ED_EXIFDATA', $this->_config->jg_showexifdata);
    JHTML::_('joomconfig.row', 'jg_geotagging', 'text', 'JGA_CONFIG_DV_ED_GEOTAGGING', $this->_config->jg_geotagging);
?>
  </table><p />
  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="adminlist">
<?php for($ii = 1; $ii <= count($this->exif_definitions); $ii++):
        $tags     = count($this->exif_config_array[$this->exif_definitions[$ii]['TAG']]);
        $jgtags   = $this->exif_definitions[$ii]['JG'];
        $tagname  = $this->exif_definitions[$ii]['NAME'];
        $header   = $this->exif_definitions[$ii]['HEAD']; ?>
      <tr>
        <!--<th>
          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $tags; ?>)" />
        </th>-->
        <th colspan="5" width="100%" align="center" class="title">
          <?php echo $header; ?>
        </th>
      </tr>
      <tr>
        <th>
          &nbsp;
        </th>
        <th nowrap="nowrap">
          <?php echo JText::_('JGSE_TAGNR'); ?>
        </th>
        <th>
          <?php echo JText::_('JGSE_TAGNAME'); ?>
        </th>
        <th nowrap="nowrap">
          <?php echo JText::_('JGSE_TAG'); ?>
        </th>
        <th>
          <?php echo JText::_('JGSE_TAGDESCRIPTION'); ?>
        </th>
      </tr>
<?php   $i = 1;
        foreach($this->exif_config_array[$this->exif_definitions[$ii]['TAG']] as $key => $value):
          $checked = '';
          if((in_array($key, $jgtags)) && $jgtags[0]):
            $checked = ' checked="checked"';
          endif; ?>
      <tr>
        <td>
          <input type="checkbox" id="cb<?php echo $i; ?>" name="<?php echo $tagname; ?>" value="<?php echo $key; ?>" onclick="isChecked(this.checked);"<?php echo $checked; ?> />
        </td>
        <td nowrap="nowrap">
          <?php echo $key; ?>
        </td>
        <td width="30%">
          <?php echo $value['Name']; ?>
        </td>
        <td width="20%">
          <?php echo $value['Attribute']; ?>
        </td>
        <td width="50%">
          <?php echo $value['Description']; ?>
        </td>
      </tr>
<?php     $i++;
        endforeach;
      endfor; ?>
      <tr>
        <th colspan="5">
          &nbsp;
        </th>
      </tr>
<?php
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->Exif-Daten"
$this->tabs->endTab();
// start Tab "Detail-Ansicht->IPTC-Daten"
$this->tabs->startTab(JText::_('JGA_CONFIG_DV_TAB_IPTC_SETTINGS'), 'nested-twentyfive');

JHTML::_('joomconfig.start', 'page23');
    JHTML::_('joomconfig.intro', JText::_('JGA_CONFIG_DV_ID_IPTC_INTRO_ONE').'<br />'.JText::_('JGA_CONFIG_DV_ID_IPTC_INTRO_TWO'));
    JHTML::_('joomconfig.row', 'jg_showiptcdata', 'yesno', 'JGA_CONFIG_DV_ID_IPTCDATA', $this->_config->jg_showiptcdata);
?>
  </table><p />
  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="adminlist">
<?php for($ii = 1; $ii <= count($this->iptc_definitions); $ii++):
        $tags     = count($this->iptc_config_array[$this->iptc_definitions[$ii]['TAG']]);
        $jgtags   = $this->iptc_definitions[$ii]['JG'];
        $tagname  = $this->iptc_definitions[$ii]['NAME'];
        $header   = $this->iptc_definitions[$ii]['HEAD']; ?>
    <tr>
      <!--<th>
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $tags; ?>)" />
      </th>-->
      <th colspan="5" width="100%" align="center" class="title">
        <?php echo $header; ?>
      </th>
    </tr>
    <tr>
      <th>
        &nbsp;
      </th>
      <th nowrap="nowrap">
        <?php echo JText::_('JGSI_TAGNR'); ?>
      </th>
      <th>
        <?php echo JText::_('JGSI_TAGNAME'); ?>
      </th>
      <th nowrap="nowrap">
        <?php echo JText::_('JGSI_TAG'); ?>
      </th>
      <th>
        <?php echo JText::_('JGSI_TAGDESCRIPTION'); ?>
      </th>
    </tr>
<?php   $i = 1;
        foreach($this->iptc_config_array[$this->iptc_definitions[$ii]['TAG']] as $key => $value):
          $checked = '';
          if((in_array($key, $jgtags)) && $jgtags[0]):
            $checked = ' checked="checked"';
          endif; ?>
    <tr>
      <td>
        <input type="checkbox" id="cb<?php echo $i; ?>" name="<?php echo $tagname; ?>" value="<?php echo $key; ?>" onclick="isChecked(this.checked);"<?php echo $checked; ?> />
      </td>
      <td nowrap="nowrap">
        <?php echo $value['IMM']; ?>
      </td>
      <td width="20%">
        <?php echo $value['Name']; ?>
      </td>
      <td width="20%">
        <?php echo $value['Attribute']; ?>
      </td>
      <td width="60%">
        <?php echo $value['Description']; ?>
      </td>
    </tr>
<?php     $i++;
        endforeach; ?>
    <tr>
      <th colspan="5">
        &nbsp;
      </th>
    </tr>
<?php endfor; ?>
  </table>
  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="adminlist">
<?php
    JHTML::_('joomconfig.intro', '&sup1;&nbsp;'.JText::_('JGA_CONFIG_DV_ID_COPYRIGHT').'<br />'.JText::_('JGA_CONFIG_DV_ID_COPYRIGHT_LANGUAGE'));
JHTML::_('joomconfig.end');

// end Tab "Detail-Ansicht->IPTC-Daten"
$this->tabs->endTab();
// end sixth nested tabs pane NestedPaneSix
$this->tabs->endPane();
// end sixth nested MainTab "Detail-Ansicht"
$this->tabs->endTab();

// start seventh nested MainTab "Toplisten"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_TOPLIST_SETTINGS'));
// start seventh nested tabs pane
$this->tabs->startPane('NestedPaneSeven');
// start Tab "Toplisten->Generelle Einstellungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-twentysix');

JHTML::_('joomconfig.start', 'page24');
    $toplist[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_COMMON_OPTION_NO_DISPLAY'));
    $toplist[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADER'));
    $toplist[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_COMMON_OPTION_IN_HEADERFOOTER'));
    $toplist[] = JHTML::_('select.option','3', JText::_('JGA_CONFIG_COMMON_OPTION_IN_FOOTER'));
    $mc_jg_showtoplist = JHTML::_('select.genericlist',$toplist, 'jg_showtoplist', 'class="inputbox" size="4"', 'value', 'text', $this->_config->jg_showtoplist);
    JHTML::_('joomconfig.row', 'jg_showtoplist', 'custom', 'JGA_CONFIG_TL_GS_TOPLIST', $mc_jg_showtoplist);
    $wheretoplist[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_TL_GS_OPTION_ALL_VIEWS'));
    $wheretoplist[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_TL_GS_OPTION_ONLY_GALLERYVIEW'));
    $wheretoplist[] = JHTML::_('select.option','2', JText::_('JGA_CONFIG_TL_GS_OPTION_GALLERY_AND_CATEGORYVIEW'));
    $mc_jg_whereshowtoplist = JHTML::_('select.genericlist', $wheretoplist, 'jg_whereshowtoplist', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_whereshowtoplist);
    JHTML::_('joomconfig.row', 'jg_whereshowtoplist', 'custom', 'JGA_CONFIG_TL_GS_ON_VIEWS', $mc_jg_whereshowtoplist);
    JHTML::_('joomconfig.row', 'jg_toplistcols', 'text', 'JGA_CONFIG_TL_GS_NUMB_COLUMN', $this->_config->jg_toplistcols);
    JHTML::_('joomconfig.row', 'jg_toplist', 'text', 'JGA_CONFIG_TL_GS_NUMB_ENTRIES', $this->_config->jg_toplist);
    $topthumbalign[] = JHTML::_('select.option', '1', JText::_('JGA_COMMON_OPTION_FLUSH_LEFT'));
    $topthumbalign[] = JHTML::_('select.option', '3', JText::_('JGA_COMMON_OPTION_CENTERED'));
    $topthumbalign[] = JHTML::_('select.option', '2', JText::_('JGA_COMMON_OPTION_FLUSH_RIGHT'));
    $mc_jg_topthumbalign = JHTML::_('select.genericlist', $topthumbalign, 'jg_topthumbalign', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_topthumbalign );
    JHTML::_('joomconfig.row', 'jg_topthumbalign', 'custom', 'JGA_CONFIG_TL_GS_THUMBALIGN', $mc_jg_topthumbalign);
    $toptextalign[] = JHTML::_('select.option', '1', JText::_('JGA_COMMON_OPTION_FLUSH_LEFT'));
    $toptextalign[] = JHTML::_('select.option', '3', JText::_('JGA_COMMON_OPTION_CENTERED'));
    $toptextalign[] = JHTML::_('select.option', '2', JText::_('JGA_COMMON_OPTION_FLUSH_RIGHT'));
    $mc_jg_toptextalign = JHTML::_('select.genericlist', $toptextalign, 'jg_toptextalign', 'class="inputbox" size="3"', 'value', 'text', $this->_config->jg_toptextalign );
    JHTML::_('joomconfig.row', 'jg_toptextalign', 'custom', 'JGA_CONFIG_TL_GS_TEXTALIGN', $mc_jg_toptextalign);
    JHTML::_('joomconfig.row', 'jg_showrate', 'yesno', 'JGA_CONFIG_TL_GS_RATING', $this->_config->jg_showrate);
    JHTML::_('joomconfig.row', 'jg_showlatest', 'yesno', 'JGA_CONFIG_TL_GS_LATEST', $this->_config->jg_showlatest);
    JHTML::_('joomconfig.row', 'jg_showcom', 'yesno', 'JGA_CONFIG_TL_GS_COMMENTS', $this->_config->jg_showcom);
    JHTML::_('joomconfig.row', 'jg_showthiscomment', 'yesno', 'JGA_CONFIG_TL_GS_THISCOMMENT', $this->_config->jg_showthiscomment);
    JHTML::_('joomconfig.row', 'jg_showmostviewed', 'yesno', 'JGA_CONFIG_TL_GS_MOSTVIEWED', $this->_config->jg_showmostviewed);
JHTML::_('joomconfig.end');

// end Tab "Toplisten->Generelle Einstellungen"
$this->tabs->endTab();
// end seventh nested tabs pane NestedPaneSeven
$this->tabs->endPane();
// end seventh nested MainTab "Toplisten"
$this->tabs->endTab();

// start eighth nested MainTab "Favoriten"
$this->tabs->startNestedTab(JText::_('JGA_CONFIG_TAB_FAVOURITES_SETTINGS'));
// start eighth nested tabs pane
$this->tabs->startPane('NestedPaneEight');
// start Tab "Favoriten->Generelle Einstellungen"
$this->tabs->startTab(JText::_('JGA_CONFIG_COMMON_TAB_GENERAL_SETTINGS'), 'nested-twentyseven');

JHTML::_('joomconfig.start', 'page25');
    JHTML::_('joomconfig.row', 'jg_favourites', 'yesno', 'JGA_CONFIG_FV_GS_FAVOURITES', $this->_config->jg_favourites);
    $showdetailfavourite[] = JHTML::_('select.option','0', JText::_('JGA_CONFIG_FV_GS_OPTION_REG_SPEC'));
    $showdetailfavourite[] = JHTML::_('select.option','1', JText::_('JGA_CONFIG_FV_GS_OPTION_ONLY_SPEC'));
    $mc_jg_showdetailfavourite = JHTML::_('select.genericlist', $showdetailfavourite, 'jg_showdetailfavourite', 'class="inputbox" size="2"', 'value', 'text', $this->_config->jg_showdetailfavourite);
    JHTML::_('joomconfig.row', 'jg_showdetailfavourite', 'custom', 'JGA_CONFIG_FV_GS_USERS', $mc_jg_showdetailfavourite);
    JHTML::_('joomconfig.row', 'jg_favouritesshownotauth', 'yesno', 'JGA_CONFIG_FV_GS_GUEST_INFORMATION', $this->_config->jg_favouritesshownotauth);
    JHTML::_('joomconfig.row', 'jg_maxfavourites', 'text', 'JGA_CONFIG_FV_GS_MAX_IMAGES', $this->_config->jg_maxfavourites);
    JHTML::_('joomconfig.row', 'jg_zipdownload', 'yesno', 'JGA_CONFIG_FV_GS_ZIPDOWNLOAD', $this->_config->jg_zipdownload);
    JHTML::_('joomconfig.row', 'jg_usefavouritesforpubliczip', 'yesno', 'JGA_CONFIG_FV_GS_FOR_PUBLIC_ZIP', $this->_config->jg_usefavouritesforpubliczip);
    JHTML::_('joomconfig.row', 'jg_usefavouritesforzip', 'yesno', 'JGA_CONFIG_FV_GS_FOR_ZIP', $this->_config->jg_usefavouritesforzip);
JHTML::_('joomconfig.end');

// end Tab "Favoriten->Generelle Einstellungen"
$this->tabs->endTab();
// end eighth nested tabs pane NestedPaneEight
$this->tabs->endPane();
// end eighth nested MainTab "Favoriten"
$this->tabs->endTab();
// end nested MainPane
$this->tabs->endPane();
?>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="config" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
  </div>
</form>
<br />
<?php JHTML::_('joomgallery.credits');
