<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->params->get('show_pagination_cat_top')):
        echo $this->loadTemplate('catpagination');
      endif; ?>
  <div class="jg_subcat">
<?php if($this->_config->get('jg_showsubcathead')): ?>
    <div class="sectiontableheader">
      <?php echo JText::_('JGS_COMMON_SUBCATEGORIES'); ?>&nbsp;
    </div>
<?php endif;
      $cat_count = count($this->categories);
      $num_rows  = ceil($cat_count / $this->_config->get('jg_colsubcat'));
      $index     = 0;
      $this->i   = 0;
      for($row_count = 0; $row_count < $num_rows; $row_count++): ?>
    <div class="jg_row sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
<?php   for($col_count = 0; ($col_count < $this->_config->get('jg_colsubcat')) && ($index < $cat_count); $col_count++):
          $row = $this->categories[$index]; ?>
      <div class="<?php echo $this->gallerycontainer; ?>">
<?php
          $row->textcontainer = 'jg_subcatelem_txt';
          if($this->_config->get('jg_showsubthumbs')):
            if($this->_config->get('jg_showsubthumbs') == 2):
              $row->photocontainer  = 'jg_subcatelem_photo';
            endif;?>
<?php       if ($row->thumb_src):?>
        <div class="<?php echo $row->photocontainer; ?>">
          <a href="<?php echo JRoute::_('index.php?view=category&catid='.$row->cid); ?>">
            <img src="<?php echo $row->thumb_src; ?>" hspace="4" vspace="0" class="jg_photo" alt="<?php echo $row->name; ?>" />
          </a>
<?php       endif;
          endif;
          if($this->_config->get('jg_showsubthumbs') && $row->thumb_src):?>
        </div>
<?php     endif; ?>
        <div class="<?php echo $row->textcontainer; ?>">
          <ul>
            <li>
              <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
<?php     if($this->_user->get('aid') >= $row->access): ?>
              <a href="<?php echo JRoute::_('index.php?view=category&catid='.$row->cid); ?>">
                <?php echo $row->name; ?></a>
<?php     endif;
          if($this->_user->get('aid') < $row->access): ?>
              <span class="jg_no_access<?php echo JHTML::_('joomgallery.tip', JText::_('JGS_COMMON_TIP_YOU_NOT_ACCESS_THIS_DIRECTORY'), addslashes($row->name), false, false); ?>">
                <?php echo $row->name; ?>&nbsp;
              </span>
<?php     endif; ?>
            </li>
            <li>
<?php         if($this->_config->get('jg_showtotalsubcatimages')): ?>
              <?php echo JText::sprintf($row->picorpics, number_format($row->pictures, 0, JText::_('JGS_COMMON_DECIMAL_SEPARATOR'), JText::_('JGS_COMMON_THOUSANDS_SEPARATOR'))); ?>
<?php         endif;
              echo $row->isnew; ?>&nbsp;
            </li>
<?php     if($this->_config->get('jg_rmsm')):
            if($row->access > 1): ?>
            <li>
              <span class="jg_sm">
                <?php echo JText::_('JGS_COMMON_SPECIAL_MEMBERS'); ?>&nbsp;
              </span>
            </li>
<?php       endif;
            if($row->access == 1): ?>
            <li>
              <span class="jg_rm">
                <?php echo JText::_('JGS_COMMON_REGISTERED_MEMBERS'); ?>&nbsp;
              </span>
            </li>
<?php       endif;
          endif;
          if($this->_user->get('aid') >= $row->access):
            if($this->_config->get('jg_showtotalsubcathits')): ?>
            <li>
              <?php echo JText::sprintf('JGS_COMMON_HITS_VAR', $row->totalhits); ?>&nbsp;
            </li>
<?php       endif;
            if($row->description && $this->_config->get('jg_showdescriptionincategoryview')): ?>
            <li>
              <?php echo JHTML::_('joomgallery.text', $row->description); ?>&nbsp;
            </li>
<?php       endif;
          endif; ?>
            <?php echo $row->event->afterDisplayCatThumb; ?>
          </ul>
        </div>
      </div>
<?php     $index++;
        endfor; ?>
      <div class="jg_clearboth"></div>
    </div>
<?php endfor;
      if($this->params->get('show_pagination_cat_bottom')):
        echo $this->loadTemplate('catpagination');
      endif;?>
  </div>