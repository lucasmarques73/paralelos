<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<form action="index.php" method="post" name="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td width="100%"></td>
      <td>
        <?php echo JText::_('JGA_COMMON_SEARCH'); ?><br />
        <input type="text" name="search" value="<?php echo $this->searchtext;?>" class="inputbox" onChange="document.adminForm.submit();" />
      </td>
      <td nowrap>
        <?php echo JText::_('JGA_COMMON_SORT_BY_ORDER'); ?><br />
        <?php echo $this->lists['sort'];?>
      </td>
      <td>
        <?php echo JText::_('JGA_COMMON_FILTER_BY_TYPE'); ?><br />
        <?php echo $this->lists['filter'];?>
      </td>
    </tr>
    <tr>
      <td width="100%"></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="adminlist">
    <tr>
      <th align="right" width="20">
        <?php echo JText::_('Num'); ?>
      </th>
      <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
      </th>
      <th width="28"></th>
      <th align="left" class="title">
        <?php echo JText::_('JGA_COMMON_CATEGORY'); ?>
      </th>
      <th align="left">
        <?php echo JText::_('JGA_COMMON_PARENT_CATEGORY'); ?>
      </th>
      <th align="center" width="5%">
        <?php echo JText::_('JGA_COMMON_PUBLISHED'); ?>
      </th>
      <th align="center" width="100">
        <?php echo JText::_('JGA_COMMON_REORDER'); ?>
        <?php if($this->ordering) echo JHTML::_('grid.order', $this->items); ?>
      </th>
      <th align="center" width="5%">
        <?php echo JText::_('JGA_COMMON_ACCESS'); ?>
      </th>
      <th align="center" width="5%">
        <?php echo JText::_('JGA_COMMON_OWNER'); ?>
      </th>
      <th align="center" width="5%">
        <?php echo JText::_('JGA_COMMON_TYPE'); ?>
      </th>
      <th align="left" width="10">
        <?php echo JText::_('ID'); ?>
      </th>
    </tr>
<?php $k = 0;
      $disabled = $this->ordering ?  '' : 'disabled="disabled"';
      for ($i = 0, $n = count($this->items); $i < $n; $i++):
        $row        = &$this->items[$i];
        $published  = JHTML::_('grid.published', $row, $i);
        $checked    = JHTML::_('grid.id', $i, $row->cid);
        $access     = JHTML::_('grid.access', $row, $i, $row->access); ?>
    <tr class="row<?php echo $k; ?>">
      <td>
        <?php echo $this->pagination->getRowOffset($i); ?>
      </td>
      <td width="20">
        <?php echo $checked; ?>
      </td>
      <td>
<?php   if($row->imgsource): ?>
        <span class="hasTip" title="<?php echo htmlspecialchars('<img src="'.$row->imgsource.'" width="'.$row->imgwidth.'" height="'.$row->imgheight.'" alt="TODO" />', ENT_QUOTES, 'UTF-8'); ?>">
          <a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>', 'edit')">
            <img src="<?php echo $row->imgsource; ?>" border="0" width="24" height="24" alt="TODO" />
          </a>
        </span>
<?php   else: ?>
        &nbsp;
<?php   endif; ?>
      </td>
      <td>
        <div align="left">
          <a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>', 'edit')">
            <?php echo $row->name; ?>
          </a>
        </div>
      </td>
      <td align="left">
        <?php echo JHTML::_('joomgallery.categorypath', $row->parent); ?>
      </td>
      <td align="center">
        <?php echo $published; ?>
      </td>
      <td>
        <div class="order">
          <div style="float:left; width:20px;"><?php echo $this->pagination->orderUpIcon($i, $row->parent == 0 || (isset($this->items[$i-1]->parent) AND $row->parent == $this->items[$i-1]->parent), 'orderup', 'Move Up', $this->ordering); ?></div>
          <div style="float:left; width:20px;"><?php echo $this->pagination->orderDownIcon($i, $n, /*TODO: most likely it's correct without this clause: $row->parent == 0 || */(isset($this->items[$i+1]->parent) AND $row->parent == $this->items[$i+1]->parent), 'orderdown', 'Move Down', $this->ordering); ?></div>
          <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled; ?> class="text_area" style="text-align: center" />
        </div>
        <div class="jg_clearboth"></div>
      </td>
      <td align="center">
        <?php echo $access; ?>
      </td>
      <td align="center">
        <?php echo JHTML::_('joomgallery.displayname', $row->owner); ?>
      </td>
      <td align="center">
        <?php echo JHTML::_('joomgallery.type', $row); ?>
      </td>
      <td>
        <?php echo $row->cid; ?>
      </td>
    </tr>
<?php $k = 1 - $k;
      endfor; ?>
    <tr>
      <td colspan="11">
        <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="categories" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
  </div>
</form>
<?php JHTML::_('joomgallery.credits');