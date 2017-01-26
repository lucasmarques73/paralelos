<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" name="adminFormComments" method="post" onsubmit="return confirm(JText._('JGA_MAIMAN_CM_ALERT_RESET_COMMENTS_CONFIRM'))">
  <table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminlist">
    <tr>
      <td style="padding:4px;" width="20%" align="center">
        <input type="submit" name="comments_sync" value="<?php echo JText::_('JGA_MAIMAN_CM_SYNCHRONIZE_COMMENTS'); ?>" onclick="document.adminFormComments.task.value = 'synchronize';" style="width:160px;" />
      </td>
      <td style="padding:4px;" width="80%">
        <?php echo JText::_('JGA_MAIMAN_CM_SYNCHRONIZE_COMMENTS_LONG'); ?> 
      </td>
    </tr>
    <tr>
      <td style="padding:4px;" align="center">
        <input type="submit" name="comments_reset" value="<?php echo JText::_('JGA_MAIMAN_CM_RESET_COMMENTS'); ?>" onclick="document.adminFormComments.task.value = 'reset';" style="width:160px;" />
      </td>
      <td style="padding:4px;">
        <?php echo JText::_('JGA_MAIMAN_CM_RESET_COMMENTS_LONG'); ?> 
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="comments" />
    <input type="hidden" name="task" value="" />
  </div>
</form>
