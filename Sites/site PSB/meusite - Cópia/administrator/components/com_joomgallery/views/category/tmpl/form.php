<?php defined('_JEXEC') or die('Restricted access'); ?>
<script language="javascript" type="text/javascript">
  function submitbutton(pressbutton) {
    var form = document.adminForm;
    if (pressbutton == 'cancel') {
      submitform(pressbutton);
      return;
    }
    // do field validation
    form.name.style.backgroundColor = '';
    try {
    document.adminForm.onsubmit();
    }
    catch(e){}
    if (form.name.value == '' || form.name.value == null) {
      alert(JText._('JGA_CATMAN_ALERT_CATEGORY_MUST_HAVE_TITLE'));
      form.name.style.backgroundColor = ffwrong;
      form.name.focus();
    }
    else {
      <?php $this->editor->getContent('description'); ?>
      submitform(pressbutton);
    }
  }
</script>
<form action="index.php" method="post" name="adminForm">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td valign="top">
        <table class="adminform">
          <tr>
            <td>
              <label for="title">
                <?php echo JText::_('JGA_COMMON_TITLE'); ?>
              </label>
            </td>
            <td>
              <input class="inputbox" type="text" name="name" id="title" size="40" maxlength="255" value="<?php echo $this->escape($this->item->name); ?>" />
            </td>
            <td>
              <label>
                <?php echo JText::_('JGA_COMMON_PUBLISHED'); ?>
              </label>
            </td>
            <td>
              <?php echo $this->lists['published']; ?>
            </td>
          </tr>
          <tr>
            <td>
              <label for="alias">
                <?php echo JText::_('JGA_COMMON_ALIAS'); ?>
              </label>
            </td>
            <td>
              <input class="inputbox hasTip" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?php echo $this->item->alias; ?>" title="<?php echo JText::_('JGA_CATMAN_ALIAS_TIP'); ?>" />
            </td>
            <td>
            </td>
            <td>
            </td>
          </tr>
          <tr>
            <td>
              <label for="parent">
                <?php echo JText::_('JGA_COMMON_PARENT_CATEGORY'); ?>
              </label>
            </td>
            <td>
              <?php echo $this->lists['catgs']; ?>
            </td>
            <td>
            </td>
            <td>
            </td>
          </tr>
        </table>
        <table class="adminform">
          <tr>
            <td valign="top" align="right">
              <?php echo JText::_('JGA_COMMON_DESCRIPTION'); ?>
            </td>
            <td>
              <?php echo $this->editor->display('description',  $this->item->description , '100%', '200', '75', '20', array('pagebreak', 'readmore')) ; ?>
            </td>
          </tr>
<?php if(!$this->isNew): ?>
          <tr>
            <td></td>
            <td class="row0" valign="top" align="center">
              <b><?php echo JText::_('JGA_COMMON_THUMBNAIL_PREVIEW'); ?></b>
              <br />
              <img src="<?php echo $this->imgsource; ?>" name="imagelib" border="2" alt="<?php echo JText::_('JGA_COMMON_THUMBNAIL_PREVIEW'); ?>" />
            </td>
          </tr>
<?php endif; ?>
        </table>
      </td>
      <td valign="top" width="320" style="padding: 7px 0 0 5px;">
<?php if(!$this->isNew): ?>
        <table width="100%" style="border: 1px dashed silver; padding: 5px; margin-bottom: 10px;">
          <tr>
            <td>
              <strong><?php echo JText::_('JGA_CATMAN_CATEGORY_ID'); ?></strong>
            </td>
            <td>
              <?php echo $this->item->cid; ?>
            </td>
          </tr>
          <tr>
            <td>
              <strong><?php echo JText::_('JGA_LAYOUT_COMMON_STATE'); ?></strong>
            </td>
            <td>
              <?php echo $this->item->published ? JText::_('JGA_LAYOUT_COMMON_STATE_PUBLISHED') : JText::_('JGA_LAYOUT_COMMON_STATE_UNPUBLISHED');?>
            </td>
          </tr>
        </table>
<?php endif;
      echo $this->pane->startPane('content-pane');
      $title = JText::_('JGA_COMMON_PARAMETERS');
      echo $this->pane->startPanel($title, 'params-page');
      echo $this->form->render('details');
      echo $this->pane->endPanel();

      /*$title = JText::_( 'Parameters - Advanced' );
      echo $this->pane->startPanel( $title, "params-page" );
      echo $this->form->render('params', 'advanced');
      echo $this->pane->endPanel();*/

      $title = JText::_('JGA_COMMON_METADATA_INFORMATION');
      echo $this->pane->startPanel($title, 'metadata-page');
      echo $this->form->render('meta', 'metadata');
      echo $this->pane->endPanel();
      echo $this->pane->endPane(); ?>
      </td>
    </tr>
  </table>
  <div>
    <script language="javascript" type="text/javascript">
      window.addEvent('domready', function() {
        $('parent').addEvent('change', function() {
          changeDynaList('ordering', orders, document.adminForm.parent.value, 0, 0);
        });
      });
    </script>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="categories" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="cid" value="<?php echo $this->item->cid; ?>" />
  </div>
</form>
<?php JHTML::_('behavior.keepalive');
      JHTML::_('behavior.tooltip');
      JHTML::_('joomgallery.credits');
