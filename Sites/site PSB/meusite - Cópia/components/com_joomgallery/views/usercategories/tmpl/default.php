<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="jg_userpanelview">
<?php if($this->params->get('show_categories_notice')): ?>
    <div class="jg_uploadquotas">
      <span class="jg_quotatitle">
        <?php echo JText::_('JGS_USERCATEGORIES_NEW_CATEGORY_NOTE'); ?>
      </span><br />
      <?php echo JText::sprintf('JGS_USERCATEGORIES_NEW_CATEGORY_MAXCOUNT', $this->_config->get('jg_maxusercat')); ?><br />
      <?php echo JText::sprintf('JGS_USERCATEGORIES_NEW_CATEGORY_YOURCOUNT', count($this->rows)); ?><br />
      <?php echo JText::sprintf('JGS_USERCATEGORIES_NEW_CATEGORY_REMAINDER', ($this->_config->get('jg_maxusercat') - count($this->rows))); ?><br />
    </div>
<?php endif;
      if($this->params->get('show_category_button')): ?>
    <div class="jg_up_head">
      <input type="button" name="button" value="<?php echo JText::_('JGS_COMMON_NEW_CATEGORY');?>" class="button"
        onclick = "javascript:location.href='<?php echo JRoute::_('index.php?view=editcategory', false); ?>';" />
    </div>
<?php endif; ?>
    <div class="sectiontableheader">
      <div class="jg_up_entry">
        <div class="jg_up_ename">
          <?php echo JText::_('JGS_COMMON_CATEGORY'); ?> 
        </div>
        <div class="jg_up_ehits">
          <?php echo JText::_('JGS_USERCATEGORIES_IMAGES'); ?> 
        </div>
        <div class="jg_up_ecat">
          <?php echo JText::_('JGS_COMMON_PARENT_CATEGORY');?> 
        </div>
        <div class="jg_up_eact">
          <?php echo JText::_('JGS_COMMON_ACTION');?> 
        </div>
        <div class="jg_up_eappr">
          <?php echo JText::_('JGS_COMMON_PUBLISHED');?> 
        </div>
      </div>
    </div>
<?php if(!count($this->rows)): ?>
    <div class="jg_txtrow">
      <div class="sectiontableentry1">
        <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
        <?php echo JText::_('JGS_USERCATEGORIES_YOU_NOT_HAVE_CATEGORY'); ?>
      </div>
    </div>
<?php endif;
      $this->i = 0;
      foreach($this->rows as $row): ?>
    <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
      <div class="jg_up_entry">
        <div class="jg_up_ename">
<?php   if($this->_config->get('jg_showminithumbs')):
          if($row->catimage): ?>
          <img src="<?php echo $this->_ambit->getImg('thumb_url', $row->catimage, null, $row->cid); ?>" border="0" height="30" alt="TODO" />
<?php
          endif;
          if(!$row->catimage): ?>
          <div class="jg_floatleft">
            <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
          </div>
<?php     endif;
        endif;
        if($row->published): ?>
          <a href="<?php echo JRoute::_('index.php?view=category&catid='.$row->cid); ?>"> 
<?php   endif; ?>
            <?php echo $row->name; ?> 
<?php   if($row->published): ?>
          </a>
<?php   endif; ?>
        </div>
        <div class="jg_up_ehits">
          <?php echo $row->images; ?> 
        </div>
        <div class="jg_up_ecat">
<?php   if(!$row->parent): ?>
          <?php echo '-'; ?> 
<?php   endif;
        if($row->parent): ?>
          <?php echo JHTML::_('joomgallery.categorypath', $row->parent); ?> 
<?php   endif; ?>
        </div>
        <div class="jg_up_esub1"> 
          <a href="<?php echo JRoute::_('index.php?view=editcategory&catid='.$row->cid); ?>" title="<?php echo JText::_('JGS_COMMON_EDIT'); ?>">
            <?php echo JHTML::_('joomgallery.icon', 'edit.png', 'JGS_COMMON_EDIT'); ?></a>
        </div>
        <div class="jg_up_esub2">
<?php   if(!$row->children && !$row->images): ?>
          <a href="javascript:if (confirm('<?php echo JText::_('JGS_COMMON_ALERT_SURE_DELETE_SELECTED_ITEM',true); ?>')){ location.href='<?php echo JRoute::_('index.php?task=deletecategory&catid='.$row->cid, false); ?>';}" title="<?php echo JText::_('JGS_COMMON_DELETE'); ?>">
            <?php echo JHTML::_('joomgallery.icon', 'edit_trash.png', 'JGS_COMMON_DELETE'); ?></a>
<?php   endif; ?>&nbsp; 
        </div>
<?php   $p_img = 'cross';
        if($row->published):
          $p_img = 'tick';
        endif; ?>
        <div class="jg_up_eappr">
          <?php /* TODO: add link to allow unpublishing/publishing directly */echo JHTML::_('joomgallery.icon', $p_img.'.png', $p_img); ?>
        </div>
      </div>
    </div>
<?php endforeach; ?>
  </div>
  <div class="jg_txtrow">
    <input type="button" name="button" value="<?php echo JText::_('JGS_COMMON_BACK_TO_USER_PANEL');?>" class="button"
      onclick = "javascript:location.href='<?php echo JRoute::_('index.php?view=userpanel', false); ?>';" />
  </div>
<?php echo $this->loadTemplate('footer');
