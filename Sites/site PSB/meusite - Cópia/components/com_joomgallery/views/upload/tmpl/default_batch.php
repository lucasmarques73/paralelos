<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="<?php echo JRoute::_('index.php?task=upload&type=batch'); ?>" method="post" name="BatchUploadForm" enctype="multipart/form-data" onsubmit="return joom_batchuploadcheck();">
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
        <?php echo JText::_('JGS_UPLOAD_IMAGE_ASSIGN_TO_CATEGORY'); ?>
      </td>
      <td align="left">
        <?php echo $this->lists['cats']; ?>
      </td>
    </tr>
<?php if(/*!$this->_config->get('jg_useorigfilename') &&*/ $this->_config->get('jg_useruploadnumber'))
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
      if($this->_config->get('jg_delete_original_user') == 2)
      {
        $sup3 = "&sup2;";
      }
      if(/*!$this->_config->get('jg_useorigfilename') &&*/ $this->_config->get('jg_useruploadnumber')): ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_COUNTER_NUMBER'); ?>&nbsp;<?php echo $sup1; ?>
      </td>
      <td align="left">
        <input type="text" name="filecounter" size="5" maxlength="5" />
      </td>
    </tr>
<?php endif;
      /*if(!$this->_config->get('jg_useorigfilename')):*/ ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_GENERIC_TITLE'); ?>
      </td>
      <td align="left">
        <input type="text" name="imgtitle" size="34" maxlength="256" value="" />
      </td>
    </tr>
<?php /*endif;*/ ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_GENERIC_DESCRIPTION_OPTIONAL'); ?>
      </td>
      <td align="left">
        <input type="text" name="imgtext" size="34" maxlength="1000" />
      </td>
    </tr>
    <!--<tr>
    <td align="right">
        <?php echo JText::_('JGS_AUTHOR_OPTIONAL'); ?>
      </td>
      <td align="left">
        <input type="text" name="imgauthor" size="34" maxlength="256" />
      </td>
    </tr>-->
<?php if($this->_config->get('jg_delete_original_user') == 2): ?>
    <tr>
      <td align="right">
        <?php echo JText::_('JG_UPLOAD_DELETE_ORIGINAL_AFTER_UPLOAD'); ?>&nbsp;<?php echo $sup2; ?>
      </td>
      <td align="left">
        <input type="checkbox" name="original_delete" value="1" />
      </td>
    </tr>
<?php endif; ?>
    <!--<tr>
      <td align="right">
        <?php echo JText::_('JGS_DEBUG_MODE'); ?>
      </td>
      <td align="left">
        <input type="checkbox" name="debug" value="1" />
      </td>
    </tr>-->
    <tr>
      <td colspan="2" align="center">
        <input type="submit" value="<?php echo JText::_('JG_UPLOAD_START_BATCHUPLOAD'); ?>" class="button" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <div align="center" class="smallgrey">
<?php if(/*!$this->_config->get('jg_useorigfilename') && */$this->_config->get('jg_useruploadnumber')): ?>
          <br /><?php echo $sup1; ?>&nbsp;<?php echo JText::_('JG_UPLOAD_COUNTER_NUMBER_ASTERISK'); ?>
<?php endif;
      if($this->_config->get('jg_delete_original_user') == 2): ?>
          <br /><?php echo $sup2; ?>&nbsp;<?php echo JText::_('JG_UPLOAD_DELETE_ORIGINAL_AFTER_UPLOAD_ASTERISK'); ?>
<?php endif; ?>
          <!--<br /><b><?php echo JText::_('JGS_DEBUG_MODE_ASTERISK'); ?></b>-->
        </div>
      </td>
    </tr>
  </table>
</form>