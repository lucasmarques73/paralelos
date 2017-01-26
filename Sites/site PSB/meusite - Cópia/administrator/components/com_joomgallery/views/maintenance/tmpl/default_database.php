<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" name="adminFormDatabase" method="post">
  <table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminlist">
    <tr>
      <td style="padding:4px;" width="20%" align="center">
        <input type="submit" name="database_optimize" value="<?php echo JText::_('JGA_MAIMAN_DB_OPTIMIZE'); ?>" onclick="document.adminFormDatabase.task.value = 'optimize';" style="width:160px;" />
      </td>
      <td style="padding:4px;" width="80%">
        <?php echo JText::_('JGA_MAIMAN_DB_OPTIMIZE_LONG'); ?> 
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="maintenance" />
    <input type="hidden" name="task" value="" />
  </div>
</form>
