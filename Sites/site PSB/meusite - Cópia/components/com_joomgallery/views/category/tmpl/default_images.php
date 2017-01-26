<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->params->get('show_pagination_img_top')):
        echo $this->loadTemplate('imgpagination');
      endif;
      if($this->_config->get('jg_coolirislink')): ?>
  <a id="jg_cooliris" href="javascript:PicLensLite.start({feedUrl:'<?php echo JRoute::_('index.php?view=category&catid='.$this->category->cid.'&page='.$this->page.'&format=raw', false); ?>',maxScale:0});">
    <?php echo JText::_('JGS_CATEGORY_COOLIRISLINK_TEXT'); ?></a>
<?php endif; ?>
  <a name="category"></a>
<?php if($this->params->get('show_all_in_popup')):
        echo $this->popup['before'];
      endif;
      $count_pics = count($this->images);
      $column     = $this->_config->get('jg_colnumb');
      $num_rows   = ceil($count_pics / $column);
      $index      = 0;
      $this->i    = 0;
      for($row_count = 0; $row_count < $num_rows; $row_count++): ?>
  <div class="jg_row sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
<?php   for($col_count = 0; ($col_count < $column) && ($index < $count_pics); $col_count++):
          $row = $this->images[$index]; ?>
    <div class="jg_element_cat">
      <a href="<?php echo $row->link; ?>" class="jg_catelem_photo">
        <img src="<?php echo $row->thumb_src; ?>" class="jg_photo" <?php echo $row->imgwh; ?> alt="<?php echo $row->imgtitle; ?>" /></a>
      <div class="jg_catelem_txt">
        <ul>
<?php     if($this->_config->get('jg_showtitle') || $this->_config->get('jg_showpicasnew')): ?>
          <li>
<?php       if($this->_config->get('jg_showtitle')): ?>
            <b><?php echo $row->imgtitle; ?></b>
<?php       endif;
            if($this->_config->get('jg_showpicasnew')): ?>
            <?php echo $row->isnew; ?>&nbsp;
<?php       endif; ?>
          </li>
<?php     endif;
          if($this->_config->get('jg_showauthor')): ?>
          <li>
            <?php echo JText::sprintf('JGS_COMMON_AUTHOR_VAR', $row->authorowner);?>&nbsp;
          </li>
<?php     endif;
          if($this->_config->get('jg_showhits')): ?>
          <li>
            <?php echo JText::sprintf('JGS_COMMON_HITS_VAR', $row->hits); ?>&nbsp;
          </li>
<?php     endif;
          if($this->_config->get('jg_showcatrate')): ?>
          <li>
            <?php echo JHTML::_('joomgallery.rating', $row, false, 'jg_starrating_cat'); ?>
          </li>
<?php     endif;
          if($this->_config->get('jg_showcatcom')): ?>
          <li>
            <?php echo JText::sprintf('JGS_COMMON_COMMENTS_VAR', $row->comments); ?>
          </li>
<?php     endif;
          if($row->imgtext && $this->_config->get('jg_showcatdescription')): ?>
          <li>
            <?php echo JHTML::_('joomgallery.text', JText::sprintf('JGS_COMMON_DESCRIPTION_VAR', $row->imgtext)); ?>&nbsp;
          </li>
<?php     endif; ?>
          <?php echo $row->event->afterDisplayThumb; ?>
<?php     if($this->params->get('show_download_icon') || $this->params->get('show_favourites_icon') || $this->params->get('show_report_icon') || $row->event->icons): ?>
          <li>
<?php       if($this->params->get('show_download_icon') == 1): ?>
            <a href="<?php echo JRoute::_('index.php?task=download&id='.$row->id); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'download.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?></a>
<?php       endif;
            if($this->params->get('show_download_icon') == -1): ?>
            <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_LOGIN_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'download_gr.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>
            </span>
<?php       endif;
            if($this->params->get('show_favourites_icon') == 1): ?>
            <a href="<?php echo JRoute::_('index.php?task=addimage&id='.$row->id.'&catid='.$row->catid); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPTEXT', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'star.png', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION'); ?></a>
<?php       endif;
            if($this->params->get('show_favourites_icon') == 2): ?>
            <a href="<?php echo JRoute::_('index.php?task=addimage&id='.$row->id.'&catid='.$row->catid); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPTEXT', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'basket_put.png', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION'); ?></a>
<?php       endif;
            if($this->params->get('show_favourites_icon') == -1): ?>
            <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'star_gr.png', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION'); ?>
            </span>
<?php       endif;
            if($this->params->get('show_favourites_icon') == -2): ?>
            <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'basket_put_gr.png', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION'); ?>
            </span>
<?php       endif;
            if($this->params->get('show_report_icon') == 1): ?>
            <a href="<?php echo JRoute::_('index.php?task=report&id='.$row->id.'&catid='.$row->catid.'&tmpl=component'); ?>" class="modal<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_REPORT_IMAGE_TIPTEXT', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION'); ?>" rel="{handler:'iframe'}"><!--, size:{x:200,y:100}-->
              <?php echo JHTML::_('joomgallery.icon', 'exclamation.png', 'JGS_COMMON_REPORT_TIPCAPTION'); ?></a>
      <?php endif;
            if($this->params->get('show_report_icon') == -1): ?>
            <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_REPORT_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION', true); ?>>
              <?php echo JHTML::_('joomgallery.icon', 'exclamation_gr.png', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION'); ?>
            </span>
<?php       endif; ?>
            <?php echo $row->event->icons; ?>
          </li>
<?php     endif; ?>
        </ul>
      </div>
    </div>
<?php     $index++;
        endfor; ?>
    <div class="jg_clearboth"></div>
  </div>
<?php endfor;
      if($this->params->get('show_all_in_popup')):
        echo $this->popup['after'];
      endif;
      if($this->_config->get('jg_showcathead')): ?>
  <div class="sectiontableheader">
    &nbsp;
  </div>
<?php endif;
      if($this->params->get('show_pagination_img_bottom')):
        echo $this->loadTemplate('imgpagination');
      endif;