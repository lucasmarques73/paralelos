<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
  <div class="jg_pagination">
<?php if($this->_config->get('jg_showpiccount')):
        if($this->totalimages == 1): ?>
    <?php echo JText::_('JGS_THERE_IS_ONE_PICTURE_IN_CATEGORY'); ?>&nbsp;
<?php   endif;
        if($this->totalimages > 1): ?>
    <?php echo JText::sprintf('JGS_CATEGORY_THERE_ARE_IMAGES_IN_CATEGORY', $this->totalimages); ?>
<?php   endif;
      endif;
      if($this->totalpages > 1):
        if($this->page != 1): ?>
    <br />
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page=1&catpage='.$this->catpage.$this->order_url).JHTML::_('joomgallery.anchor', 'category'); ?>">
      &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?></a>&nbsp;
<?php   endif;
        if($this->page == 1): ?>
    <br />
    &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?>&nbsp;
<?php   endif;
        if($this->page - 1 > 0): ?>
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.($this->page - 1).'&catpage='.$this->catpage.$this->order_url).JHTML::_('joomgallery.anchor', 'category'); ?>">
      &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?></a>&nbsp;
<?php   endif;
        if($this->page - 1 <= 0): ?>
    &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?>&nbsp;
<?php   endif; ?>
      <?php echo JHTML::_('joomgallery.pagination', 'index.php?view=category&catid='.$this->category->cid.'&page=%u&catpage='.$this->page.$this->order_url, $this->totalpages, $this->page, 'category'); ?>
<?php   if($this->page + 1 <= $this->totalpages): ?>
    &nbsp;
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.($this->page + 1).'&catpage='.$this->catpage.$this->order_url).JHTML::_('joomgallery.anchor', 'category'); ?>">
      <?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;</a>
<?php   endif;
        if($this->page + 1 > $this->totalpages): ?>
    &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;
<?php   endif;
        if($this->page != $this->totalpages): ?>
    &nbsp;
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->totalpages.'&catpage='.$this->catpage.$this->order_url).JHTML::_('joomgallery.anchor', 'category'); ?>">
      <?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;
    </a>
<?php   endif;
        if($this->page == $this->totalpages): ?>
    &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;
<?php   endif;
      endif; ?>
  </div>
