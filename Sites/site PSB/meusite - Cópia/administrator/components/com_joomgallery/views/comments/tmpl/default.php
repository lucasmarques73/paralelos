<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" method="post" name="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td width="100%"></td>
      <td>
        <?php echo JText::_('JGA_COMMON_SEARCH'); ?>
      </td>
      <td>
        <input type="text" name="search" value="<?php echo $this->searchtext;?>" class="inputbox" onChange="document.adminForm.submit();" />
      </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th align="right" width="10">
        <?php echo JText::_('Num'); ?>
      </th>
      <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
      </th>
      <th align="left" class="title" width="15%">
        <?php echo JText::_('JGA_COMMON_AUTHOR'); ?>
      </th>
      <th width="35%">
        <div align="left">
          <?php echo JText::_('JGA_COMMAN_TEXT'); ?>
        </div>
      </th>
      <th align="center" width="10%">
        <?php echo JText::_('JGA_COMMAN_IP'); ?>
      </th>
      <th align="center" width="10%">
        <?php echo JText::_('JGA_COMMON_PUBLISHED'); ?>
      </th>
      <th align="center" width="10%">
        <?php echo JText::_('JGA_COMMON_APPROVED'); ?>
      </th>
      <th align="center" width="10%">
        <?php echo JText::_('JGA_COMMON_IMAGE'); ?>
      </th>
      <th width="24"></th>
      <th align="center" width="10%">
        <?php echo JText::_('JGA_COMMON_DATE'); ?>
      </th>
  </tr>
<?php   $k = 0;
        for($i = 0, $n = count($this->items); $i < $n; $i++):
          $row = $this->items[$i];
		      $published	= JHTML::_('grid.published', $row, $i);
          $approved   = JHTML::_('joomgallery.approved', $row, $i, 'Reject Comment', 'Approve Comment');
		      $checked 	  = JHTML::_('grid.id', $i, $row->cmtid); ?>
    <tr class="row<?php echo $k; ?>">
      <td align="right">
        <?php echo $this->pagination->getRowOffset($i); ?>
      </td>
      <td>
        <?php echo $checked; ?>
      </td>
      <td>
        <div align="left">
          <?php echo $row->cmtname; ?>
        </div>
      </td>
      <td>
        <div align="left">
          <?php echo $row->cmttext; ?>
        </div>
      </td>
      <td>
        <div align="center">
          <?php echo $row->cmtip; ?>
        </div>
      </td>
      <td align='center'>
        <?php echo $published; ?>
      </td>
      <td align='center'>
        <?php echo $approved; ?>
      </td>
      <td width="10%" align="center">
        <?php echo $row->cmtpic; ?>
      </td>
      <td>
<?php     if($row->imgsource): ?>
        <span class="hasTip" title="<?php echo htmlspecialchars('<img src="'.$row->imgsource.'" width="'.$row->imgwidth.'" height="'.$row->imgheight.'" alt="TODO" />', ENT_QUOTES, 'UTF-8'); ?>">
          <a href="index.php?option=<?php echo _JOOM_OPTION; ?>&amp;controller=images&amp;task=edit&amp;cid=<?php echo $row->cmtpic; ?>">
            <img src="<?php echo $row->imgsource; ?>" border="0" width="24" height="24" alt="Thumb" />
          </a>
        </span>
<?php     endif;
          if(!$row->imgsource): ?>
        &nbsp;
<?php     endif; ?>
      </td>
      <td width="10%" align="center">
        <?php echo JHTML::_('date', $row->cmtdate, JText::_('DATE_FORMAT_LC4')); ?>
      </td>
  </tr>
<?php     $k = 1 - $k;
        endfor; ?>
    <tr>
      <td colspan="10">
        <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION;?>" />
    <input type="hidden" name="controller" value="comments" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
  </div>
</form>
<?php JHTML::_('joomgallery.credits');
