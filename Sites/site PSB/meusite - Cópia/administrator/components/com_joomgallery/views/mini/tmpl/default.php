<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="gallery minigallery">
  <div class="jg_header" style="display:none;">
    <?php echo JText::_('JGA_PLUGIN_MINI_INTRO'); ?>
  </div>
<?php echo $this->tabs->startPane('joomgallery-tabs');
      echo $this->tabs->startPanel(JText::_('JGA_PLUGIN_MINI_INSERT_IMAGE'), 'param-page-images');
      echo $this->loadTemplate('images');
      echo $this->tabs->endPanel();
      if($this->extended > 0):
        echo $this->tabs->startPanel(JText::_('JGA_PLUGIN_MINI_INSERT_CATEGORY'), 'param-page-categories');
        echo $this->loadTemplate('categories');
        echo $this->tabs->endPanel();
        echo $this->tabs->startPanel(JText::_('JGA_PLUGIN_MINI_UPLOAD_IMAGE'), 'param-page-upload');
        echo $this->loadTemplate('upload');
        echo $this->tabs->endPanel();
      endif;
      echo $this->tabs->endPane(); ?>
  <div id="jg_bu_minis" class="jg_bu_minis test<?php echo $this->extended > 0 ? ' jg_displaynone' : ''; ?>">
<?php if(!count($this->images)): ?>
    <div class="jg_bu_no_images">
      <?php echo JText::_('JGA_PLUGIN_MINI_NO_IMAGES'); ?>
    </div>
<?php endif;
      foreach($this->images as $row): ?>
    <div class="jg_bu_mini">
<?php if($row->thumb_src): ?>
      <a href="javascript:if(typeof window.parent.joom_selectimage == 'function'){window.parent.joom_selectimage(<?php echo $row->id; ?>, '<?php echo stripslashes($row->imgtitle); ?>', '<?php echo JRequest::getVar('object'); ?>', '<?php echo $row->imgthumbname; ?>');}else{insertJoomPluWithId('<?php echo $row->id; ?>');}" title="::<?php echo $row->overlib; ?>" class="hasTip">
        <img src="<?php echo $row->thumb_src; ?>" border="0" height="40" width="40" alt="Thumbnail" /></a>
<?php endif;
      if(!$row->thumb_src): ?>
      <div class="jg_bu_no_mini" title="<?php echo JText::_('JGA_PLUGIN_MINI_NO_THUMB'); ?>::<?php echo JText::sprintf('JGA_PLUGIN_MINI_NO_THUMB_TIPTEXT', $row->id, $row->imgtitle); ?>" class="hasTip">
        <?php echo JText::_('JGA_PLUGIN_MINI_NO_THUMB'); ?></div>
<?php endif; ?>
    </div>
<?php endforeach; ?>
  </div>
</div>
