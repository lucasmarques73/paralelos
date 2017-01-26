<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" name="adminFormVotes" method="post" onsubmit="return confirm(JText._('JGA_MAIMAN_ALERT_RESET_VOTES_CONFIRM'))">
  <table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminlist">
    <tr>
      <td style="padding:4px;" width="20%" align="center">
        <input type="submit" name="votes_sync" value="<?php echo JText::_('JGA_MAIMAN_SYNCHRONIZE_VOTES'); ?>" onclick="document.adminFormVotes.task.value = 'synchronize';" style="width:160px;" />
      </td>
      <td style="padding:4px;" width="80%">
        <?php echo JText::_('JGA_MAIMAN_SYNCHRONIZE_VOTES_LONG'); ?> 
      </td>
    </tr>
    <tr>
      <td style="padding:4px;" align="center">
        <input type="submit" name="votes_reset" value="<?php echo JText::_('JGA_MAIMAN_RESET_VOTES'); ?>" onclick="document.adminFormVotes.task.value = 'reset';" style="width:160px;" />
      </td>
      <td style="padding:4px;">
        <?php echo JText::_('JGA_MAIMAN_RESET_VOTES_LONG'); ?> 
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="votes" />
    <input type="hidden" name="task" value="" />
  </div>
</form>