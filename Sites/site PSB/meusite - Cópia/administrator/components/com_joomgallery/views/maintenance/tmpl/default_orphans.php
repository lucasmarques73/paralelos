<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->current_tab != 'orphans'): ?>
<div>
  <ul class="jg-message">
    <li><?php echo JText::_('JGA_MAIMAN_MSG_REFRESH_NECESSARY'); ?></li>
  </ul>
  <script type="text/javascript">
    $('cpanel-panel-joom-maintenance-file-images').addEvent('click', function(){
      document.location.href="index.php?option=<?php echo _JOOM_OPTION; ?>&controller=maintenance&tab=orphans";
    });
  </script>
</div>
<?php else: ?>
<form action="index.php" method="post" name="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td>
        <fieldset class="TODO" style="text-align:center;">
          <legend><?php echo JText::_('JGA_MAIMAN_BATCH_JOBS'); ?></legend>
          <?php echo $this->lists['orphan_jobs']; ?>
          <p id="batchjobs"></p>
          <input type="submit" value="<?php echo JText::_('JGA_MAIMAN_APPLY'); ?>" onclick="if(document.adminForm.job.value == ''){return false;}else{submitbutton(document.adminForm.job.value);}"/>
        </fieldset>
      </td>
      <td width="100%"></td>
      <td><?php echo JText::_('JGA_COMMON_SEARCH'); ?><br />
        <input type="text" name="orphan_search" value="<?php echo $this->orphan_searchtext; ?>" class="inputbox" onchange="document.adminForm.submit();" />
      </td>
      <td>
        <?php echo JText::_('JGA_MAIMAN_OPTION_ORDERBY_FILENAME'); ?><br />
        <?php echo $this->lists['orphan_ordering']; ?>
      </td>
      <td>
        <?php echo JText::_('JGA_MAIMAN_FILTER_BY_PROPOSAL'); ?><br />
        <?php echo $this->lists['orphan_proposal']; ?>
      </td>
      <td>
        <?php echo JText::_('JGA_COMMON_FILTER_BY_TYPE'); ?><br />
        <?php echo $this->lists['orphan_filter']; ?>
      </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="5">
        <?php echo JText::_('Num'); ?>
      </th>
      <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $this->checked ? count($this->items) : 0; ?>);" />
      </th>
      <th class="title">
        <?php echo JText::_('JGA_MAIMAN_OP_FILENAME_AND_PATH'); ?>
      </th>
      <th width="10%" align="center">
        <?php echo JText::_('JGA_COMMON_TYPE'); ?>
      </th>
      <th width="10%" align="center">
        <?php echo JText::_('JGA_MAIMAN_SUGGESTION'); ?>
      </th>
      <th width="5" align="left">
        <?php echo JText::_('ID'); ?>
      </th>
    </tr>
<?php if($this->checked):
        if($n = count($this->items)):
          $k = 0;
          for($i = 0; $i < $n; $i++):
            $row = &$this->items[$i];
            $checked    = JHTML::_('grid.id', $i, $row->id); ?>
    <tr class="row<?php echo $k; ?>">
      <td>
        <?php echo $this->pagination->getRowOffset($i); ?>
      </td>
      <td>
        <?php echo $checked; ?>
      </td>
      <td>
        <?php echo $row->type == 'unknown' ? $this->warning(JText::_('JGA_MAIMAN_UNKNOWN_FILE_TYPE'), JText::_('JGA_MAIMAN_UNKNOWN_FILE_TYPE_LONG')) : ''; ?>&nbsp;<?php echo $row->fullpath; ?>
      </td>
      <td align="center">
        <?php if($row->type != 'unknown'):
                echo JText::_('JGA_MAIMAN_TYPE_'.strtoupper($row->type));
              else:
                #jimport('joomla.filesystem.file');
                echo JText::sprintf('JGA_MAIMAN_TYPE_UNKNOWN_VAL'/*, JFile::getExt($row->fullpath)*/);
              endif; ?>
      </td>
      <td align="center">
<?php       if($row->refid): ?>
        <span title="<?php echo JText::_('JGA_MAIMAN_SHOW_IMAGE_DETAILS'); ?>" class="hasTip">
          <a href="index.php?option=<?php echo _JOOM_OPTION; ?>&amp;controller=images&amp;task=edit&amp;cid=<?php echo $row->refid; ?>">
            <?php echo $row->title; ?>
          </a>
        </span>
        <?php echo $this->correct('addorphan', $row->id, JText::_('JGA_MAIMAN_ADD_ORPHAN_TO_IMAGE')); ?>
<?php       else: ?>
        <?php echo $this->cross('JGA_MAIMAN_NO_PROPOSAL'); ?>
        <?php echo $this->correct('deleteorphan', 0, JText::_('JGA_MAIMAN_DELETE_THIS_ORPHAN'), 'javascript:listItemTask(\'cb'.$i.'\', \'deleteorphan\');'); ?>
<?php       endif; ?>
      </td>
      <td>
        <?php echo $row->id; ?>
      </td>
    </tr>
<?php       $k = 1 - $k;
          endfor; ?>
    <tr>
      <td colspan="6">
        <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
<?php   else: ?>
    <tr>
      <td colspan="6">
        <div class="TODO">
          <p>
            <span class="TODO" style="color:green; font-weight:bold;">
              <?php echo JText::_('JGA_MAIMAN_MSG_NO_ORPHANS_FOUND'); ?>
            </span>
          </p>
        </div>
      </td>
    </tr>
<?php   endif; ?>
    <tr>
      <td colspan="6">
        <div class="TODO">
          <p>
            <input type="submit" name="check" value="<?php echo JText::_('JGA_MAIMAN_CHECK_AGAIN'); ?>" onclick="document.adminForm.task.value = 'check';" />
          </p>
        </div>
      </td>
    </tr>
<?php else: ?>
    <tr>
      <td colspan="6">
        <div class="TODO">
          <p>
            <span class="TODO" style="color:orange; font-weight:bold;">
              <?php echo JText::_('JGA_MAIMAN_PLEASE_CHECK'); ?>
            </span>
          </p>
          <input type="submit" name="check" value="<?php echo JText::_('JGA_MAIMAN_CHECK'); ?>" onclick="document.adminForm.task.value = 'check';" />
          <p>
            <span class="TODO" style="">
              <?php echo JText::_('JGA_MAIMAN_CHECK_NOTE'); ?>
            </span>
          </p>
        </div>
      </td>
    </tr>
<?php endif; ?>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="maintenance" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="tab" value="orphans" />
    <input type="hidden" name="boxchecked" value="0" />
  </div>
</form>
<?php endif;
