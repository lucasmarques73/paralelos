<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" name="adminFormNametags" method="post" onsubmit="return confirm(JText._('JGA_MAIMAN_NT_ALERT_RESET_NAMETAGS_CONFIRM'))">
  <table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminlist">
    <tr>
      <td style="padding:4px;" width="20%" align="center">
        <input type="submit" name="nametags_sync" value="<?php echo JText::_('JGA_MAIMAN_NT_SYNCHRONIZE'); ?>" onclick="document.adminFormNametags.task.value = 'synchronize';" style="width:160px;" />
      </td>
      <td style="padding:4px;" width="80%">
        <?php echo JText::_('JGA_MAIMAN_NT_SYNCHRONIZE_LONG'); ?> 
      </td>
    </tr>
    <tr>
      <td style="padding:4px;" align="center">
        <input type="submit" name="nametags_reset" value="<?php echo JText::_('JGA_MAIMAN_NT_RESET'); ?>" onclick="document.adminFormNametags.task.value = 'reset';" style="width:160px;" />
      </td>
      <td style="padding:4px;">
        <?php echo JText::_('JGA_MAIMAN_NT_RESET_LONG'); ?> 
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="nametags" />
    <input type="hidden" name="task" value="" />
  </div>
</form>