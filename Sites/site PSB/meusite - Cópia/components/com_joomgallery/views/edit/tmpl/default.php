<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="sectiontableheader">
    <?php echo JText::_('JGS_EDIT_EDIT_IMAGE'); ?> 
  </div>
  <div class="jg_editpicture">
    <form action = "<?php echo JRoute::_('index.php?task=save'); ?>" method="post" name="adminForm"
      enctype="multipart/form-data" onsubmit="return joom_checkme2();" >
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_TITLE') ; ?>
      </div>
      <input class="inputbox" type="text" name="imgtitle" size="42" maxlength="100"
        value="<?php echo htmlspecialchars($this->image->imgtitle, ENT_QUOTES, 'UTF-8'); ?>" />
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_ALIAS') ; ?>
      </div>
      <input class="inputbox" type="text" name="alias" size="42" maxlength="100" value="<?php echo $this->image->alias; ?>" />
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_CATEGORY'); ?>
      </div>
      <?php echo $this->lists['cats']; ?>
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_DESCRIPTION'); ?>
      </div>
      <textarea class="inputbox" cols="40" rows="5" name="imgtext"><?php echo htmlspecialchars($this->image->imgtext, ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_AUTHOR_OWNER'); ?>
      </div>
      <b><?php echo $this->_user->get('username'); ?></b>
    </div>
<?php if($this->image->thumb_url): ?>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_IMAGE'); ?>
      </div>
      <img src="<?php echo $this->image->thumb_url; ?>" name="imagelib" width="80" border="2" alt="<?php echo JText::_('JGS_COMMON_THUMBNAIL_PREVIEW'); ?>" />
    </div>
<?php endif; ?>
    <div class="jg_txtrow">
      <input type="submit" value="<?php echo JText::_('JGS_COMMON_SAVE'); ?>" class="button" />
      <input type="button" name="Button" value="<?php echo JText::_('JGS_COMMON_CANCEL'); ?>"
        onclick = "javascript:location.href='<?php echo JRoute::_('index.php?view=userpanel', false); ?>';" />
    </div>
    <input type="hidden" name="id" value="<?php echo $this->image->id; ?>" />
    </form>
  </div>
<?php echo $this->loadTemplate('footer');
