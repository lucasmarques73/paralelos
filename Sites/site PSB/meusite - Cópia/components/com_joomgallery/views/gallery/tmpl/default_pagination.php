<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
  <div class="jg_pagination">
<?php if($this->_config->get('jg_showcatcount')):
        if($this->total == 1): ?>
    <?php echo JText::_('JGS_GALLERY_THERE_IS_ONE_CATEGORY_IN_GALLERY'); ?>&nbsp;
<?php   endif;
        if($this->total > 1): ?>
    <?php echo JText::sprintf('JGS_GALLERY_THERE_ARE_CATEGORIES_IN_GALLERY', $this->total); ?>&nbsp;
<?php   endif;
      endif; ?>
    <br />
<?php if($this->totalpages > 1):
        if($this->page != 1): ?>
    <a href="<?php echo JRoute::_('index.php?view=gallery'); ?>" class="jg_pagenav">
      &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?></a>&nbsp;
<?php   endif;
        if($this->page == 1): ?>
    <span class="jg_pagenav">
      &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?>&nbsp;
    </span>
<?php   endif;
        if($this->page - 1 > 0): ?>
    <a href="<?php echo JRoute::_('index.php?view=gallery&page='.($this->page-1)); ?>" class="jg_pagenav">
      &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?></a>
<?php   endif;
        if($this->page - 1 <= 0): ?>
    <span class="jg_pagenav">
      &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?>&nbsp;
    </span>
<?php   endif; ?>
    <?php echo JHTML::_('joomgallery.pagination', 'index.php?view=gallery&page=%u', $this->totalpages, $this->page); ?>
<?php   if($this->page + 1 <= $this->totalpages): ?>
    <a href="<?php echo JRoute::_('index.php?view=gallery&page='.($this->page+1)); ?>" class="jg_pagenav">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;</a>
<?php   endif;
        if($this->page + 1 > $this->totalpages): ?>
    <span class="jg_pagenav">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;
    </span>
<?php   endif;
        if($this->page != $this->totalpages): ?>
    <a href="<?php echo JRoute::_('index.php?view=gallery&page='.$this->totalpages); ?>" class="jg_pagenav">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;</a>
<?php   endif;
        if($this->page == $this->totalpages): ?>
    <span class="jg_pagenav">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;
    </span>
<?php   endif;
      endif; ?>
  </div>
