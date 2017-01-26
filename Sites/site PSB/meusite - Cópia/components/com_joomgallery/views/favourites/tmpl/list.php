<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="sectiontableheader">
    <?php echo $this->output('HEADING'); ?> 
  </div>
  <div class="jg_fav_switchlayout">
    <a href="<?php echo JRoute::_('index.php?task=switchlayout&layout='.$this->getLayout()); ?>">
      <?php echo JText::_('JGS_FAVOURITES_SWITCH_LAYOUT'); ?> 
    </a>
  </div>
  <div class="jg_fav_clearlist">
    <a href="<?php echo JRoute::_('index.php?task=removeall'); ?>">
      <?php echo JText::_('JGS_FAVOURITES_REMOVE_ALL'); ?> 
    </a>
  </div>
  <div class="sectiontableheader">
    <div class="jg_up_entry">
      <div class="jg_up_ename">
        <?php echo JText::_('JGS_COMMON_IMAGE_NAME'); ?> 
      </div>
      <div class="jg_up_ehits">
        <?php echo JText::_('JGS_COMMON_HITS'); ?> 
      </div>
      <div class="jg_up_ecat">
        <?php echo JText::_('JGS_COMMON_CATEGORY'); ?> 
      </div>
      <div class="jg_up_eact">
        <?php echo JText::_('JGS_COMMON_ACTION'); ?> 
      </div>
    </div>
  </div>
<?php if(!count($this->rows)): ?>
  <div class="jg_txtrow">
    <div class="sectiontableentry1">
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <?php echo $this->output('NO_PICS'); ?> 
    </div>
  </div>
<?php endif;
      $this->i = 0;
      foreach($this->rows as $row): ?>
  <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
    <div class="jg_up_entry">
      <div class="jg_up_ename">
        <a href="<?php echo $row->link; ?>">
          <img src="<?php echo $this->_ambit->getImg('thumb_url', $row); ?>" border="0" height="30" alt="" />
          <?php echo $row->imgtitle; ?></a>
      </div>
      <div class="jg_up_ehits">
        <?php echo $row->hits; ?>
      </div>
      <div class="jg_up_ecat">
        <a href="<?php echo JRoute::_('index.php?view=category&catid='.$row->catid); ?>">
          <?php echo JoomHelper::categoryPathLink($row->catid, false); ?>
        </a>
      </div>
<?php   if($this->params->get('show_download_icon') == 1): ?>
      <div class="jg_up_esub1<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>">
        <a href="<?php echo JRoute::_('index.php?task=download&id='.$row->id); ?>">
        <?php echo JHTML::_('joomgallery.icon', 'download.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?></a>
      </div>
<?php   endif;
        if($this->params->get('show_download_icon') == -1): ?>
      <div class="jg_up_esub1<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_LOGIN_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>">
        <?php echo JHTML::_('joomgallery.icon', 'download_gr.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>
      </div>
<?php   endif; ?>
      <div class="jg_up_esub2<?php echo JHTML::_('joomgallery.tip', $this->output('REMOVE_TIPTEXT'), $this->output('REMOVE_TIPCAPTION'), false, false); ?>">
        <a href="<?php echo JRoute::_('index.php?option=com_joomgallery&task=removeimage&id='.$row->id); ?>">
        <?php echo JHTML::_('joomgallery.icon', 'basket_remove.png', $this->output('REMOVE_TIPCAPTION'), null, null, false); ?></a>
      </div>
<?php   if($row->show_editor_icons): ?>
      <div class="jg_up_esub3">
        <a href="<?php echo JRoute::_('index.php?view=edit&id='.$row->id); ?>" title="<?php echo JText::_('JGS_COMMON_EDIT'); ?>">
          <?php echo JHTML::_('joomgallery.icon', 'edit.png', 'JGS_COMMON_EDIT'); ?></a>
      </div>
      <div class="jg_up_esub4">
        <a href="javascript:if(confirm('<?php echo JText::_('JGS_COMMON_ALERT_SURE_DELETE_SELECTED_ITEM', true); ?>')){ location.href='<?php echo JRoute::_('index.php?task=delete&id='.$row->id, false);?>';}" title="<?php echo JText::_('JGS_COMMON_DELETE'); ?>">
          <?php echo JHTML::_('joomgallery.icon', 'edit_trash.png', 'JGS_COMMON_DELETE'); ?></a>
      </div>
<?php   endif; ?>
    </div>
  </div>
<?php endforeach; ?>
  <div class="sectiontableheader">
    &nbsp;
  </div>
<?php echo $this->loadTemplate('footer');