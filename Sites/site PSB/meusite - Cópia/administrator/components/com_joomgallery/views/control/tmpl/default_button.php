<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
          <div class="jg-float<?php echo ($this->lang->isRTL()) ? 'right' : 'left'; ?>">
            <div class="icon">
              <a href="index.php?<?php echo $this->item->admin_menu_link; ?>">
                <?php echo JHTML::_('image.site', $this->item->admin_menu_img, '', NULL, NULL, JText::_('com_joomgallery.'.$this->item->name)); ?>
                <span><?php echo JText::_('com_joomgallery.'.$this->item->name); ?></span></a>
            </div>
          </div>
