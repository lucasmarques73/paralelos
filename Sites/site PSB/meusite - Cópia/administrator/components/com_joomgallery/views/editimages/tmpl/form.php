<?php defined('_JEXEC') or die('Restricted access'); ?>
<script language="javascript" type="text/javascript">
  function submitbutton(pressbutton) {
    var form = document.adminForm;
    if (pressbutton == 'cancel') {
      submitform(pressbutton);
      return;
    }
    // do field validation
    form.imgtitle.style.backgroundColor = '';
    form.catid.style.backgroundColor = '';
    if (form.changeimgtitle.checked && (form.imgtitle.value == '' || form.imgtitle.value == null)) {
      alert(JText._('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE'));
      form.imgtitle.style.backgroundColor = ffwrong;
      form.imgtitle.focus();
    }
    else if (form.changecatid.checked && form.catid.value == "0") {
      alert(JText._('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY'));
      form.catid.style.backgroundColor = ffwrong;
      form.catid.focus();
    }
    else {
      submitform(pressbutton);
    }
  }
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
    <tr class="row0">
      <td width="20%" align="right">
        <input type="checkbox" name="change[]" id="changeimgtitle" value="imgtitle">
        <?php echo JText::_('JGA_COMMON_TITLE') . ' *'; ?>
      </td>
      <td width="80%">
        <input class="inputbox" type="text" name="imgtitle" size="50" maxlength="100" value="<?php echo htmlspecialchars($this->items[0]->imgtitle, ENT_QUOTES, 'UTF-8'); ?>" />
        <div class="jg_displaynone"><input type="checkbox" name="counter" value="1" />
        <input type="text" name="startcounter" value="" class="inputbox" size="5" /></div>
      </td>
    </tr>
    <tr class="row1">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" id="changecatid" value="catid" />
        <?php echo JText::_('JGA_COMMON_CATEGORY') . ' *'; ?>
      </td>
      <td>
        <?php echo $this->lists['cats']; ?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" value="imgtext" />
        <?php echo JText::_('JGA_COMMON_DESCRIPTION'); ?>
      </td>
      <td>
        <?php echo $this->editor->display('imgtext', str_replace('&','&amp;',$this->items[0]->imgtext), '620', '200', '70', '10', array('pagebreak', 'readmore')) ; ?>
      </td>
    </tr>
    <tr class="row1">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" value="owner" />
        <?php echo JText::_('JGA_COMMON_OWNER'); ?>
      </td>
      <td>
        <?php echo $this->lists['owner'];?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" value="imgauthor" />
        <?php echo JText::_('JGA_COMMON_AUTHOR'); ?>
      </td>
      <td>
        <input class="inputbox" type="text" name="imgauthor" value="<?php echo $this->items[0]->imgauthor; ?>" size="30" maxlength="100" />
      </td>
    </tr>
    <!--<tr class="row1">
      <td valign="top" >
        <input type="checkbox" name="change[]" value="access" />
        <?php echo JText::_('JGA_COMMON_ACCESS'); ?>
      </td>
      <td>
        <?php echo $this->lists['access']; ?>
      </td>
    </tr>-->
    <tr class="row0">
      <td valign="top" >
        <input type="checkbox" name="change[]" value="published" />
        <?php echo JText::_('JGA_COMMON_PUBLISHED'); ?>
      </td>
      <td>
        <?php echo $this->lists['published']; ?>
      </td>
    </tr>
    <tr class="row1">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" value="clearvotes" />
        <?php echo JText::_('JGA_IMGMAN_IMAGES_RATINGS'); ?> 
      </td>
      <td>
        <input type="hidden" name="clearvotes" value="1" />
        <?php echo JText::_('JGA_IMGMAN_CLEAR_VOTES_FOR_ALL_IMAGES'); ?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" align="right">
        <input type="checkbox" name="change[]" value="clearhits" />
        <?php echo JText::_('JGA_IMGMAN_IMAGES_HITS'); ?> 
      </td>
      <td>
        <input type="hidden" name="clearhits" value="1" />
        <?php echo JText::_('JGA_IMGMAN_CLEAR_HITS_FOR_ALL_IMAGES'); ?>
      </td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="images" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="cids" value="<?php echo $this->cids; ?>" />
  </div>
</form>
<?php JHTML::_('joomgallery.credits');