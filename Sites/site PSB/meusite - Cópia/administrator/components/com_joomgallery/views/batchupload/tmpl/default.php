<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/batchupload/tmpl/default.php $
// $Id: default.php 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data" onSubmit="return joom_checkme();">
  <table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminlist">
    <tr valign="middle">
      <td align="center" colspan="2">
        <?php echo JText::_('JG_UPLOAD_BATCH_UPLOAD_NOTE'); ?>
      </td>
    </tr>
    <tr>
      <td align="right" width="50%">
        <?php echo JText::_('JG_UPLOAD_BATCH_ZIP_FILE'); ?>
      </td>
      <td align="left" width="50%">
        <input type="file" name="zippack" accept="application/zip, application/x-zip-compressed">
      </td>
    </tr>
    <tr>
      <td align="right">
        <?php echo JText::_('JGA_UPLOAD_IMAGE_ASSIGN_TO_CATEGORY'); ?>
      </td>
      <td align="left">
        <?php echo $this->lists['cats']; ?>
      </td>
    </tr>
<?php if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber'))
      {
        $sup1 = "&sup1;";
        $sup2 = "&sup2;";
        $sup3 = "&sup3;";
      }
      else
      {
        $sup2 = "&sup1;";
        $sup3 = "&sup2;";
      }
      if($this->_config->get('jg_delete_original') == 2)
      {
        $sup3 = "&sup2;";
      }
      if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber')): ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_COUNTER_NUMBER'); ?>&nbsp;<?php echo $sup1; ?>
      </td>
      <td align="left">
        <input type="text" name="filecounter" size="5" maxlength="5" />
      </td>
    </tr>
<?php endif;
      if(!$this->_config->get('jg_useorigfilename')): ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_GENERIC_TITLE'); ?>
      </td>
      <td align="left">
        <input type="text" name="gentitle" size="34" maxlength="256" value="" />
      </td>
    </tr>
<?php endif; ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_GENERIC_DESCRIPTION_OPTIONAL'); ?>
      </td>
      <td align="left">
        <input type="text" name="gentext" size="34" maxlength="1000" />
      </td>
    </tr>
    <tr>
    <td align="right">
        <?php echo JText::_('JGA_UPLOAD_AUTHOR_OPTIONAL'); ?>
      </td>
      <td align="left">
        <input type="text" name="photocred" size="34" maxlength="256" />
      </td>
    </tr>
<?php if($this->_config->get('jg_delete_original') == 2): ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_DELETE_ORIGINAL_AFTER_UPLOAD'); ?>&nbsp;<?php echo $sup2; ?>
      </td>
      <td align="left">
        <input type="checkbox" name="original_delete" value="1" />
      </td>
    </tr>
<?php endif; ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JGA_UPLOAD_DEBUG_MODE'); ?>
      </td>
      <td align="left">
        <input type="checkbox" name="debug" value="1" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" value="<?php echo JText::_('JG_UPLOAD_START_BATCHUPLOAD'); ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <div align="center" class="smallgrey">
<?php if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber')): ?>
          <br /><?php echo $sup1; ?>&nbsp;<?php echo JText::_('JG_UPLOAD_COUNTER_NUMBER_ASTERISK'); ?>
<?php endif;
      if($this->_config->get('jg_delete_original') == 2): ?>
          <br /><?php echo $sup2; ?>&nbsp;<?php echo JText::_('JG_UPLOAD_DELETE_ORIGINAL_AFTER_UPLOAD_ASTERISK'); ?>
<?php endif; ?>
          <br /><b><?php echo JText::_('JGA_UPLOAD_DEBUG_MODE_ASTERISK'); ?></b>
        </div>
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="batchupload" />
    <input type="hidden" name="task" value="upload" />
  </div>
</form>
<?php JHTML::_('joomgallery.credits');