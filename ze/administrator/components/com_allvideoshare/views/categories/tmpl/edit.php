<?php

/*
 * @version		$Id: add.php 1.2.1 2012-05-03 $
 * @package		Joomla
 * @copyright   Copyright (C) 2012-2013 MrVinoth
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

$data = $this->data;

?>

<div id="avs">
  <p class="avsheader"><?php echo JText::_('EDIT_THE_CATEGORY'); ?></p>
  <form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <table class="admintable">
      <tr>
        <td class="avskey"><?php echo JText::_('NAME'); ?></td>
        <td><strong><?php echo $data->name; ?></strong></td>
      </tr>
      <tr>
        <td class="avskey"><?php echo JText::_('SLUG'); ?></td>
        <td><input type="text" name="slug" size="60" value="<?php echo $data->slug; ?>" /></td>
      </tr>
      <tr id="upload_type">
        <td class="avskey"></td>
        <td class="avskey"><input type="radio" name="type" value="upload" <?php if($data->type == "upload") echo 'checked="checked"'; ?> onclick="changeUpload('upload')" />
          <?php echo JText::_('UPLOAD'); ?>&nbsp;&nbsp;
          <input type="radio" name="type" value="url" <?php if($data->type == "url") echo 'checked="checked"'; ?> onclick="changeUpload('url')" />
          <?php echo JText::_('URL'); ?></td>
      </tr>
      <tr id="upload_data_thumb">
        <td class="avskey"><?php echo JText::_('THUMB'); ?></td>
        <td id="upload_thumb"><?php if($data->thumb) { ?>
          <input name="upload_thumb" readonly="readonly" value="<?php echo $data->thumb; ?>" size="47" />
          <input type="button" name="change" value="Change" onclick="changeMode('thumb')" />
          <?php } else { ?>
          <input type="file" name="upload_thumb" maxlength="100" />
          <?php } ?>
        </td>
      </tr>
      <tr id="url_data_thumb">
        <td class="avskey"><?php echo JText::_('THUMB'); ?></td>
        <td><input type="text" name="thumb" size="60" value="<?php echo $data->thumb; ?>" /></td>
      </tr>
      <tr>
        <td class="avskey"><?php echo JText::_('PUBLISH'); ?></td>
        <td><input type="checkbox" name="published" value="1" <?php if($data->published == 1) echo 'checked="checked"'; ?> /></td>
      </tr>
    </table>
    <input type="hidden" name="boxchecked" value="1">
    <input type="hidden" name="option" value="com_allvideoshare" />
    <input type="hidden" name="view" value="categories" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="name" value="<?php echo $data->name; ?>" />
    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    <?php echo JHTML::_( 'form.token' ); ?>
  </form>
</div>
<script type="text/javascript">
var form            = document.adminForm;
var imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
var isAllowed       = true;
changeUpload('<?php echo $data->type; ?>');

if(<?php echo substr(JVERSION,0,3); ?> != '1.5') {
	Joomla.submitbutton = submitbutton;
}
	
function submitbutton(pressbutton){ 	
	if(pressbutton == 'save' || pressbutton == 'apply') {	
		if(valForm() == false) return;
	}
	submitform( pressbutton );	
	return;
}

function valForm() {
	if(form.name.value == '') {
       	alert( "<?php echo JText::_( 'NAME_FIELD_SHOULD_NOT_BE_EMPTY', true); ?>" );
       	return false;
	}
	
	if(valButton(form.type) == 'upload') {
		if(form.upload_thumb.value == '') {
       		alert( "<?php echo JText::_( 'YOU_MUST_ADD_A_THUMB_IMAGE', true); ?>" );
       		return false;
	    } else {
			isAllowed = checkExtension('THUMB', form.upload_thumb.value, imageExtensions);
			if(isAllowed == false) 	return false;
		}
	} else {
		if(form.thumb.value == '') {
       		alert( "<?php echo JText::_( 'YOU_MUST_ADD_A_THUMB_IMAGE', true); ?>" );
       		return false;
	    } else {
			isAllowed = checkExtension('THUMB', form.thumb.value, imageExtensions);
			if(isAllowed == false) 	return false;
		}
	}
}

function valButton(btn) {
	var cnt = -1;
    for (var i=btn.length-1; i > -1; i--) {
        if (btn[i].checked) {cnt = i; i = -1;}
    }
    if (cnt > -1) return btn[cnt].value;
    else return null;
}

function checkExtension(type, filePath, validExtensions) {
	var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();

    for(var i = 0; i < validExtensions.length; i++) {
        if(ext == validExtensions[i]) return true;
    }

    alert(type + ' :   The file extension ' + ext.toUpperCase() + ' is not allowed!');
    return false;	
}

function changeUpload(typ) {
	document.getElementById('upload_data_thumb').style.display = "none";
   	document.getElementById('url_data_thumb').style.display = "none";
    switch(typ) {
		case 'upload':
			document.getElementById('upload_data_thumb').style.display = "";
			break;
		case 'url':
			document.getElementById('url_data_thumb').style.display = "";
			break;
	}	
}

function changeMode(inp) {
    var mode;
    mode='<input type="file" name="upload_' + inp + '" maxlength="100" />';
	document.getElementById('upload_' + inp).innerHTML = mode;
}
</script>