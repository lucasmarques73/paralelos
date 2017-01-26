<?php defined('_JEXEC') or die('Restricted access'); ?>
<script language="javascript" type="text/javascript">
  function submitbutton(pressbutton) {
    var form = document.adminForm;
    if (pressbutton == 'cancel' || pressbutton == 'resethits' || pressbutton == 'resetvotes') {
      submitform(pressbutton);
      return;
    }
    // do field validation
    form.imgtitle.style.backgroundColor = '';
    form.catid.style.backgroundColor = '';
<?php if($this->isNew): ?>
    form.imgfilename.style.backgroundColor = '';
    form.imgthumbname.style.backgroundColor = '';
<?php endif; ?>
    if (form.imgtitle.value == '' || form.imgtitle.value == null){
      alert(JText._('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE'));
      form.imgtitle.style.backgroundColor = ffwrong;
      form.imgtitle.focus();
    }
    else if (form.catid.value == "0"){
      alert(JText._('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY'));
      form.catid.style.backgroundColor = ffwrong;
      form.catid.focus();
    }
<?php if($this->isNew): ?>
    else if (form.imgfilename.value == ''|| form.imgfilename.value == null){
      alert(JText._('JGA_IMGMAN_ALERT_SELECT_IMAGE_FILENAME'));
      form.imgfilename.style.backgroundColor = ffwrong;
      form.imgfilename.focus();
    }
    else if (form.imgthumbname.value == '' || form.imgthumbname.value == null){
      alert(JText._('JGA_IMGMAN_ALERT_SELECT_THUMBNAIL_FILENAME'));
      form.imgthumbname.style.backgroundColor = ffwrong;
      form.imgthumbname.focus();
    }
<?php endif; ?>
    else {
      submitform(pressbutton);
    }
  }
</script>
<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td valign="top">
        <table class="adminform">
          <tr>
            <td>
              <label for="title">
                <?php echo JText::_('JGA_COMMON_TITLE') . ' *'; ?>
              </label>
            </td>
            <td>
              <input class="inputbox" type="text" name="imgtitle" id="title" size="40" maxlength="255" value="<?php echo $this->item->imgtitle; ?>" />
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
              <input class="inputbox hasTip" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?php echo $this->item->alias; ?>" title="<?php echo JText::_('JGA_IMGMAN_ALIAS_TIP'); ?>" />
            </td>
            <td>
            </td>
            <td>
            </td>
          </tr>
          <tr>
            <td>
              <label for="catid">
                <?php echo JText::_('JGA_COMMON_CATEGORY') . ' *'; ?>
              </label>
            </td>
            <td>
              <?php echo $this->lists['cats']; ?>
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
              <?php echo $this->editor->display('imgtext',  $this->item->imgtext , '100%', '200', '75', '20', array('pagebreak', 'readmore')) ; ?>
            </td>
          </tr>
<?php if($this->isNew): ?>
          <tr class="row1">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_IMGMAN_IMAGE_CATEGORY') .' *'; ?>
            </td>
            <td>
              <?php echo $this->lists['detail_cats']; ?>
            </td>
          </tr>
          <tr class="row0">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_COMMON_IMAGE') .' *'; ?>
            </td>
            <td>
              <?php echo $this->lists['imagelist']; ?>
            </td>
          </tr>
          <tr class="row1">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_IMGMAN_DOES_ORIGINAL_EXIST'); ?>
            </td>
            <td>
              <script language="javascript" type="text/javascript">
                if (document.forms[0].imgfilename.options.value=='') {
                  document.write('<?php echo '<div>[ '.JText::_('JGA_IMGMAN_NO_IMAGE_SELECTED', true).' ]</div>'; ?>');
                } else {
                  document.write('<?php echo $this->orig_msg; ?>');
                }
              </script>
            </td>
          </tr>
          <tr class="row0">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_IMGMAN_ASSIGN_ORIGINAL'); ?>&nbsp; &sup1;
            </td>
            <td>
              <?php echo $this->lists['copy_original']; ?>
            </td>
          </tr>
          <tr class="row1">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_IMGMAN_THUMBNAIL_CATEGORY') . ' *'; ?>
            </td>
            <td>
              <?php echo $this->lists['thumb_cats']; ?>
            </td>
          </tr>
          <tr class="row0">
            <td valign="top" align="right">
              <?php echo JText::_('JGA_COMMON_THUMBNAIL') . ' *'; ?>
            </td>
            <td>
              <?php echo $this->lists['thumblist']; ?>
            </td>
          </tr>
          <tr class="row1">
            <td>&nbsp;</td>
            <td>
              <br />
              <div class="smallgrey">
                *&nbsp;<?php echo JText::_('JGA_IMGMAN_COMPULSORYFIELDS'); ?><br />
                &sup1;&nbsp;<?php echo JText::_('JGA_IMGMAN_ASSIGN_ORIGINAL_LONG'); ?>
              </div>
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
              <strong><?php echo JText::_('JGA_IMGMAN_IMAGE_ID'); ?></strong>
            </td>
            <td>
              <?php echo $this->item->id; ?>
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
          <tr>
            <td>
              <strong><?php echo JText::_('JGA_IMGMAN_HITS'); ?></strong>
            </td>
            <td>
              <?php echo $this->item->hits; ?>
              <span<?php if(!$this->item->hits): echo ' class="jg_displaynone"'; endif; ?>>
                <input name="reset_hits" type="button" class="button" value="<?php echo JText::_('JGA_IMGMAN_RESET_IMAGE_HITS'); ?>" onclick="submitbutton('resethits');" />
              </span>
            </td>
          </tr>
          <tr>
            <td>
              <strong><?php echo JText::_('JGA_IMGMAN_IMAGE_RATING'); ?></strong>
            </td>
            <td>
              <?php echo JText::sprintf('JGA_IMGMAN_IMAGE_VOTES', $this->voteavg, $this->item->imgvotes); ?>
              <span<?php if(!$this->item->imgvotes): echo ' class="jg_displaynone"'; endif; ?>>
                <input name="reset_hits" type="button" class="button" value="<?php echo JText::_('JGA_IMGMAN_RESET_IMAGE_VOTES'); ?>" onclick="submitbutton('resetvotes');" />
              </span>
            </td>
          </tr>
          <tr>
            <td>
              <strong><?php echo JText::_('JGA_COMMON_DATE'); ?></strong>
            </td>
            <td>
              <?php echo JHTML::_('date',  $this->item->imgdate,  JText::_('DATE_FORMAT_LC2') ); ?>
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

      if(!$this->isNew):
        $title = JText::_('JGA_IMGMAN_REPLACE_FILES');
        echo $this->pane->startPanel($title, 'files-page');
        echo $this->form->render('files', 'files');
        echo $this->pane->endPanel();
      endif;

      $title = JText::_('JGA_COMMON_METADATA_INFORMATION');
      echo $this->pane->startPanel($title, 'metadata-page');
      echo $this->form->render('meta', 'metadata');
      echo $this->pane->endPanel();
      echo $this->pane->endPane(); ?>
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="images" />
    <input type="hidden" name="task" value="new" />
    <input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
    <!--<?php echo JHTML::_( 'form.token' ); ?>-->
  </div>
</form>
<p />
<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
  <tr>
    <td valign="top" align="center">
      <b><?php echo JText::_('JGA_COMMON_THUMBNAIL_PREVIEW'); ?></b>
      <br />
      <img src="<?php echo $this->thumbsource; ?>" name="imagelib" border="2" alt="<?php echo JText::_('JGA_COMMON_THUMBNAIL_PREVIEW'); ?>" />
    </td>
    <td valign="top" align="center">
      <b><?php echo JText::_('JGA_IMGMAN_IMAGE_PREVIEW'); ?></b>
      <br />
      <img src="<?php echo $this->imgsource; ?>" name="imagelib2" border="2" alt="<?php echo JText::_('JGA_IMGMAN_IMAGE_PREVIEW'); ?>" />
    </td>
  </tr>
</table>
<?php JHTML::_('behavior.keepalive');
      JHTML::_('behavior.tooltip');
      JHTML::_('joomgallery.credits');
