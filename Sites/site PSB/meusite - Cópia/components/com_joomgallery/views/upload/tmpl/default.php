<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="sectiontableheader">
    <?php echo JText::_('JGS_COMMON_UPLOAD_NEW_IMAGE'); ?>
  </div>
<?php if($this->_config->get('jg_newpiccopyright') && !$this->get('AdminLogged')): ?>
  <div class="jg_uploadcopyright sectiontableentry2">
    <?php echo JText::_('JGS_UPLOAD_NEW_IMAGE_COPYRIGHT'); ?>
  </div>
<?php endif;
      if($this->_config->get('jg_newpicnote') && !$this->get('AdminLogged')): ?>
  <div class="jg_uploadquotas">
    <span class="jg_quotatitle"><?php echo JText::_('JGS_UPLOAD_NEW_IMAGE_NOTE'); ?></span><br />
    <?php echo JText::sprintf('JGS_UPLOAD_NEW_IMAGE_MAXSIZE', $this->_config->get('jg_maxfilesize'), $this->maxfilesizekb); ?><br />
    <?php echo JText::sprintf('JGS_UPLOAD_NEW_IMAGE_MAXCOUNT', $this->_config->get('jg_maxuserimage')); ?><br />
    <?php echo JText::sprintf('JGS_UPLOAD_NEW_IMAGE_YOURCOUNT', $this->count); ?><br />
    <?php echo JText::sprintf('JGS_UPLOAD_NEW_IMAGE_REMAINDER', $this->remainder); ?><br />
  </div>
<?php endif;

if($this->_config->get('jg_useruploadsingle') || $this->_config->get('jg_useruploadbatch') || $this->_config->get('jg_useruploadjava')):
  echo $this->tabs->startPane('joomgallery-pane');
endif;
if($this->_config->get('jg_useruploadsingle')):
  echo $this->tabs->startPanel(JText::_('JGS_UPLOAD_TAB_SINGLE_UPLOAD'), 'joom-upload-pane');
  echo $this->loadTemplate('single');
  echo $this->tabs->endPanel();
endif;
if($this->_config->get('jg_useruploadbatch')):
  echo $this->tabs->startPanel(JText::_('JGS_UPLOAD_TAB_BATCH_UPLOAD'), 'joom-batchupload-pane');
  echo $this->loadTemplate('batch');
  echo $this->tabs->endPanel();
endif;
if($this->_config->get('jg_useruploadjava')):
  echo $this->tabs->startPanel(JText::_('JGS_UPLOAD_TAB_JAVA_UPLOAD'), 'joom-javaupload-pane');
  echo $this->loadTemplate('java');
  echo $this->tabs->endPanel();
endif;
if($this->_config->get('jg_useruploadsingle') || $this->_config->get('jg_useruploadbatch') || $this->_config->get('jg_useruploadjava')):
  echo $this->tabs->endPane();
endif;
echo $this->loadTemplate('footer');