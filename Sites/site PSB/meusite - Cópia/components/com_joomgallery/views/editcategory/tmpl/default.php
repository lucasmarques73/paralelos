<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <div class="sectiontableheader">
    <?php echo (!$this->category->cid) ? JText::_('JGS_COMMON_NEW_CATEGORY') : JText::_('JGS_EDITCATEGORY_MODIFY_CATEGORY'); ?>
  </div>
  <form action="<?php echo JRoute::_('index.php?task=savecategory'); ?>" method="post" name="usercatForm">
  <div class="jg_editpicture">
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_TITLE'); ?> 
      </div>
      <input class="inputbox" type="text" name="name" size="25" value="<?php echo $this->category->name; ?>" />
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_ALIAS'); ?> 
      </div>
      <input class="inputbox" type="text" name="alias" size="25" value="<?php echo $this->category->alias; ?>" />
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_PARENT_CATEGORY'); ?> 
      </div>
    <?php echo $this->lists['catgs']; ?> 
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_DESCRIPTION'); ?> 
      </div>
      <textarea name="description" rows="5" cols="40" class="inputbox"><?php echo htmlspecialchars($this->category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
<?php if($this->lists['access']): ?>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_EDITCATEGORY_ACCESS'); ?> 
      </div>
      <?php echo $this->lists['access'];?> 
    </div>
<?php endif; ?>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_COMMON_PUBLISHED'); ?> 
      </div>
      <?php echo $this->lists['published']; ?> 
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_EDITCATEGORY_ORDERING'); ?> 
      </div>
      <?php echo $this->lists['ordering'];?> 
    </div>
<?php if($this->category->cid): ?>
    <div class="jg_uprow">
      <div class="jg_uptext">
        <?php echo JText::_('JGS_EDITCATEGORY_THUMBNAIL'); ?> 
      </div>
      <?php echo $this->lists['thumbs']; ?>
    </div>
    <div class="jg_uprow">
      <div class="jg_uptext">      
        <?php echo JText::_('JGS_COMMON_THUMBNAIL_PREVIEW'); ?> 
      </div>
      <img src="<?php echo $this->category->catimage_src; ?>" name="imagelib" border="1" alt="<?php echo JText::_('JGS_COMMON_THUMBNAIL_PREVIEW'); ?>" />
    </div>
<?php endif; ?>
    <div class="jg_txtrow">
      <input type="button" name="button" value="<?php echo JText::_('JGS_COMMON_SAVE'); ?>" onclick = "javascript:submit_button();" class="button" />
      <input type="button" name="button" value="<?php echo JText::_('JGS_COMMON_CANCEL'); ?>" onclick = "javascript:location.href='<?php echo JRoute::_('index.php?view=usercategories', false); ?>';" class="button" />
      <input type="hidden" name="cid" value="<?php echo $this->category->cid; ?>">
    </div>
  </div>
</form>
<?php echo $this->loadTemplate('footer');