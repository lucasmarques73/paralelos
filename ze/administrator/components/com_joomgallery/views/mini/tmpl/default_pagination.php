<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
  <div class="jg_minicount">
<?php if($this->total < 1): ?>
    <?php echo JText::_('COM_JOOMGALLERY_PLUGIN_MINI_NO_IMAGES'); ?>
<?php endif;
      if($this->total == 1): ?>
    <?php echo JText::_('COM_JOOMGALLERY_MINI_ONE_IMAGE_FOUND'); ?>
<?php endif;
      if($this->total > 1): ?>
    <?php echo JText::sprintf('COM_JOOMGALLERY_MINI_IMAGES_FOUND', $this->total); ?>
<?php endif; ?>
  </div>
  <div class="jg_pagination">
<?php if($this->totalpages > 1):
        $pagination = $this->pagination->getData();
        if($pagination->start->base !== null): ?>
    <a href="<?php echo $pagination->start->link; ?>"><?php echo $pagination->start->text; ?></a>
<?php   else: ?>
    <span><?php echo $pagination->start->text; ?></span>
<?php   endif;
        if($pagination->previous->base !== null): ?>
    <a href="<?php echo $pagination->previous->link; ?>"><?php echo $pagination->previous->text; ?></a>
<?php   else: ?>
    <span><?php echo $pagination->previous->text; ?></span>
<?php   endif;
        foreach($pagination->pages as $page):
          if($page->base !== null): ?>
      <a href="<?php echo $page->link; ?>"><?php echo $page->text; ?></a>
<?php     else: ?>
      <span><?php echo $page->text; ?></span>
<?php     endif;
        endforeach;
        if($pagination->next->base !== null): ?>
    <a href="<?php echo $pagination->next->link; ?>"><?php echo $pagination->next->text; ?></a>
<?php   else: ?>
    <span><?php echo $pagination->next->text; ?></span>
<?php   endif;
        if($pagination->end->base !== null): ?>
    <a href="<?php echo $pagination->end->link; ?>"><?php echo $pagination->end->text; ?></a>
<?php   else: ?>
    <span><?php echo $pagination->end->text; ?></span>
<?php   endif;
      endif; ?>
  </div>