<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip'); ?>
<form action="index.php" method="post" name="adminForm" id="upload-form" enctype="multipart/form-data" class="form-validate" onsubmit="if(this.task.value == 'upload' && !document.formvalidator.isValid(document.id('upload-form'))){alert('<?php echo JText::_('JGLOBAL_VALIDATION_FORM_FAILED', true); ?>');return false;} return joomOnSubmit();">
  <div class="width-50 fltlft">
    <fieldset class="adminform">
      <legend><?php echo JText::_('COM_JOOMGALLERY_COMMON_IMAGE_SELECTION'); ?></legend>
      <ul>
        <li><?php echo $this->form->getLabel('arrscreenshot'); ?>
        <?php echo $this->form->getInput('arrscreenshot'); ?></li>
      </ul>
    </fieldset>
  </div>
  <div class="width-50 fltrt">
    <fieldset class="adminform">
      <legend><?php echo JText::_('COM_JOOMGALLERY_COMMON_OPTIONS'); ?></legend>
      <ul>
        <li><?php echo $this->form->getLabel('catid'); ?>
        <?php echo $this->form->getInput('catid'); ?></li>
        <?php if(!$this->_config->get('jg_useorigfilename')): ?>
        <li><?php echo $this->form->getLabel('imgtitle'); ?>
        <?php echo $this->form->getInput('imgtitle'); ?></li>
        <?php endif;
              if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber')): ?>
        <li><?php echo $this->form->getLabel('filecounter'); ?>
        <?php echo $this->form->getInput('filecounter'); ?></li>
        <?php endif; ?>
        <li><?php echo $this->form->getLabel('imgtext'); ?>
        <?php echo $this->form->getInput('imgtext'); ?></li>
        <li><?php echo $this->form->getLabel('imgauthor'); ?>
        <?php echo $this->form->getInput('imgauthor'); ?></li>
        <li><?php echo $this->form->getLabel('published'); ?>
        <?php echo $this->form->getInput('published'); ?></li>
        <li><?php echo $this->form->getLabel('access'); ?>
        <?php echo $this->form->getInput('access'); ?></li>
        <?php if($this->_config->get('jg_delete_original') == 2): ?>
        <li><?php echo $this->form->getLabel('original_delete'); ?>
        <?php echo $this->form->getInput('original_delete'); ?></li>
        <?php endif; ?>
        <li><?php echo $this->form->getLabel('create_special_gif'); ?>
        <?php echo $this->form->getInput('create_special_gif'); ?></li>
        <li><?php echo $this->form->getLabel('debug'); ?>
        <?php echo $this->form->getInput('debug'); ?></li>
        <li><label for="button"></label>
        <button id="button" type="submit"><?php echo JText::_('COM_JOOMGALLERY_UPLOAD_UPLOAD'); ?></button></li>
      </ul>
    </fieldset>
  </div>
  <div class="clr"></div>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="upload" />
    <input type="hidden" name="task" value="upload" />
  </div>
</form>
<?php JHTML::_('joomgallery.credits');