<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="jg_topview">
    <div class="sectiontableheader">
      <?php echo $this->title; ?>&nbsp;
    </div>
<?php $count = count($this->rows);
      $num_rows = ceil($count / $this->_config->get('jg_toplistcols'));
      $index    = 0;
      $this->i  = 0;
      if(!$count):
        // TODO
      endif;
      for($row_count = 0; $row_count < $num_rows; $row_count++ ): ?>
    <div class="jg_row sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
<?php   for($col_count = 0; ($col_count < $this->_config->get('jg_toplistcols')) && ($index < $count); $col_count++):
          $row = $this->rows[$index]; ?>
      <div class="jg_topelement">
        <div  class="jg_topelem_photo">
          <a href="<?php echo $row->link; ?>">
            <img src="<?php echo $row->thumb_src; ?>" class="jg_photo" alt="<?php echo $row->imgtitle; ?>" />
          </a>
        </div>
        <div class="jg_topelem_txt">
          <ul>
            <li>
              <b><?php echo $row->imgtitle; ?></b>
            </li>
            <li>
              <?php echo JText::_('JGS_COMMON_CATEGORY'); ?>
              <a href="<?php echo JRoute::_('index.php?view=category&catid='.$row->catid); ?>">
                <?php echo $row->name; ?>
              </a>
            </li>
<?php     if($this->_config->get('jg_showauthor')): ?>
            <li>
              <?php echo JText::sprintf('JGS_COMMON_AUTHOR_VAR', $row->authorowner); ?>
            </li>
<?php     endif;
          if($this->_config->get('jg_showhits')): ?>
            <li>
              <?php echo JText::sprintf('JGS_COMMON_HITS_VAR', $row->hits); ?>
            </li>
<?php     endif;
          if($this->_config->get('jg_showcatrate')): ?>
            <li>
              <?php echo JHTML::_('joomgallery.rating', $row, false, 'jg_starrating_top'); ?>
            </li>
<?php     endif;
          if($this->_config->get('jg_showcatcom')): ?>
            <li>
<?php       switch($row->comments)
            {
              case 0: ?>
              <?php echo JText::_('JGS_COMMON_NO_COMMENTS'); ?>
<?php           break;
              case 1: ?>
              <?php echo JText::_('JGS_COMMON_COMMENT'); ?>
<?php           break;
              default: ?>
              <?php echo JText::sprintf('JGS_COMMON_COMMENTS_VAR', $row->comments); ?>
<?php           break;
            } ?>
            </li>
<?php     endif;
          $this->_mainframe->triggerEvent('onAfterDisplayJoomThumb', array($row->id)); ?>
            <li>
<?php     if($this->params->get('show_download_icon') == 1): ?>
              <a href="<?php echo JRoute::_('index.php?option=com_joomgallery&task=download&id='.$row->id); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
                <?php echo JHTML::_('joomgallery.icon', 'download.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?></a>
<?php     endif;
          if($this->params->get('show_download_icon') == -1): ?>
              <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_LOGIN_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
                <?php echo JHTML::_('joomgallery.icon', 'download_gr.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>
              </span>
<?php     endif;
          // TODO: Favourites icon? Editor icons?
          if($this->type == 'lastcommented' && $this->_config->get('jg_showthiscomment')): ?>
            <li>
<?php       if($this->params->get('delivered_by_plugin')): ?>
              <?php echo $row->comment; ?>&nbsp;
<?php       else: ?>
              <?php echo JText::sprintf('JGS_TOPLIST_WROTE_AT', $row->cmtname, JHTML::_('date', $row->cmtdate, JText::_('DATE_FORMAT_LC1'))); ?>
              <?php echo $row->processed_cmttext; ?>&nbsp;
<?php       endif; ?>
            </li>
<?php     endif; ?>
          </ul>
        </div>
      </div>
<?php     $index++;
        endfor; ?>
      <div class="jg_clearboth"></div>
    </div>
<?php endfor; ?>
  </div>
<?php echo $this->loadTemplate('footer');