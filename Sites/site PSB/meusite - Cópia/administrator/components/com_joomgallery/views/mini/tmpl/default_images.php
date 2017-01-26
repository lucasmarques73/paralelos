<?php defined('_JEXEC') or die('Restricted access');
      echo $this->sliders->startPane('joomgallery-images-sliders');
      if($this->extended > 0):
        echo $this->sliders->startPanel(JText::_('JGA_PLUGIN_MINI_EXTENDED'), 'param-page-images-options'); ?>
  <script type="text/javascript">
    $('param-page-images-options').addEvent('click', function(){
      $('jg_bu_minis').addClass('jg_displaynone');
    });
  </script>
  <div class="joomgallery-slider">
    <div class="jg_bu_extended_options">
      <div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_TYPE'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_TYPE_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_TYPE'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <?php echo $this->options['type']; ?>
      </div>
      <div class="jg_clearboth"></div>
      <!--<div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_POSITION'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_POSITION_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_POSITION'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <?php echo $this->options['position']; ?>
      </div>
      <div class="jg_clearboth"></div>-->
      <div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_LINKED'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_LINKED_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_LINKED'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <?php echo $this->options['linked']; ?>
      </div>
      <div class="jg_clearboth"></div>
      <div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_ALTTEXT'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_ALTTEXT_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_ALTTEXT'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <input type="text" name="jg_bu_alttext" id="jg_bu_alttext" value="<?php echo $this->params->get('default_alttext', ''); ?>" />
      </div>
      <div class="jg_clearboth"></div>
      <div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_ADD_CLASS'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_ADD_CLASS_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_ADD_CLASS'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <input type="text" name="jg_bu_class" id="jg_bu_class" value="<?php echo $this->params->get('default_class', ''); ?>" />
      </div>
      <div class="jg_clearboth"></div>
      <div class="jg_bu_option_key">
        <span title="<?php echo JText::_('JGA_PLUGIN_MINI_TEXTLINK'); ?>::<?php echo JText::_('JGA_PLUGIN_MINI_TEXTLINK_TIP'); ?>" class="hasTip"><?php echo JText::_('JGA_PLUGIN_MINI_TEXTLINK'); ?></span>
      </div>
      <div class="jg_bu_option_value">
        <input type="text" name="jg_bu_text" id="jg_bu_text" value="<?php echo $this->params->get('default_linkedtext', ''); ?>" />
      </div>
      <div class="jg_clearboth"></div>
    </div>
  </div>
<?php   echo $this->sliders->endPanel();
      endif;
      echo $this->sliders->startPanel(JText::_('JGA_PLUGIN_MINI_SEARCH'), 'param-page-images-search'); ?>
  <script type="text/javascript">
    $('param-page-images-search').addEvent('click', function(){
      $('jg_bu_minis').removeClass('jg_displaynone');
    });
  </script>
  <div class="joomgallery-slider">
    <div class="jg_bu_search">
    <form action="index.php?option=<?php echo _JOOM_OPTION; ?>&amp;view=mini&amp;tmpl=component&amp;e_name=text&amp;object=<?php echo JRequest::getVar('object'); ?>" name="adminForm" method="post">
      <div class="pagination">
        <div class="limit">
          <?php echo JText::_('Display Num').$this->pagination->getLimitbox(); ?>
        </div>
        <div class="pageslinks">
          <?php echo $this->pagination->getPagesLinks(); ?>
          <input type="hidden" name="limitstart" value="<?php echo $this->pagination->limitstart; ?>" />
        </div>
        <div class="jg_clearboth"></div>
      </div>
<?php if($this->extended != -1): ?>
      <div class="jg_bu_filter"><?php echo Jtext::_('JGA_PLUGIN_MINI_FILTER_BY_CATEGORY'); ?>
        <?php echo $this->lists['image_categories']; ?>
      </div>
<?php endif; ?>
    </form>
    </div>
  </div>
<?php echo $this->sliders->endPanel();
      echo $this->sliders->endPane();