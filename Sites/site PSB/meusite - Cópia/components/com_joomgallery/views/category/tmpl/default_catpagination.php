<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
  <div class="jg_pagination">
    <a name="subcategory"></a>
<?php if($this->_config->get('jg_showsubcatcount')):
        if($this->totalcategories == 1): ?>
    <?php echo JText::_('JGS_THERE_IS_ONE_SUBCATEGORY_IN_CATEGORY'); ?>&nbsp;
<?php   endif;
        if($this->totalcategories > 1): ?>
    <?php echo JText::sprintf('JGS_CATEGORY_THERE_ARE_SUBCATEGORIES_IN_CATEGORY', $this->totalcategories); ?> 
<?php   endif;
      endif;
      if($this->cattotalpages > 1):
        if($this->catpage != 1): ?>
    <br />
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&catpage=1').JHTML::_('joomgallery.anchor', 'subcategory'); ?>">
      &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?>&nbsp;
    </a>
<?php   endif;
        if($this->catpage == 1): ?>
    <br />
    &laquo;&laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_BEGIN'); ?>&nbsp;
<?php   endif;
        if($this->catpage - 1 > 0): ?>
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&catpage='.($this->catpage - 1)).JHTML::_('joomgallery.anchor', 'subcategory'); ?>">
      &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?>&nbsp;
    </a>
<?php   endif;
        if($this->catpage - 1 <= 0): ?>
    &laquo;&nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_PREVIOUS'); ?>&nbsp;
<?php   endif; ?>
      <?php echo JHTML::_('joomgallery.pagination', 'index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&catpage=%u', $this->cattotalpages, $this->catpage, 'subcategory'); ?>
<?php   if($this->catpage + 1 <= $this->cattotalpages): ?>
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&catpage='.($this->catpage + 1)).JHTML::_('joomgallery.anchor', 'subcategory'); ?>">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;
    </a>
<?php   endif;
        if($this->catpage + 1 > $this->cattotalpages): ?>
    &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_NEXT'); ?>&nbsp;&raquo;
<?php   endif;
        if($this->catpage != $this->cattotalpages): ?>
    <a href="<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&catpage='.$this->cattotalpages).JHTML::_('joomgallery.anchor', 'subcategory'); ?>">
      &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;
    </a>
<?php   endif;
        if($this->catpage == $this->cattotalpages): ?>
    &nbsp;<?php echo JText::_('JGS_COMMON_PAGENAVIGATION_END'); ?>&nbsp;&raquo;&raquo;
<?php   endif;
      endif; ?>
  </div>
