<?php
/**
* @package ccNewsletter
* @version 1.0.9
* @author  Chill Creations <info@chillcreations.com>
* @link    http://www.chillcreations.com
* @copyright Copyright (C) 2008 - 2010 Chill Creations-All rights reserved
* @license GNU/GPL, see LICENSE.php for full license.
* See COPYRIGHT.php for more copyright notices and details.

This file is part of ccNewsletter.
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
  function formsubmit(task)
  {
    var form = document.adminForm;
    if(task == "importfromdb")
    {
        myOption = -1;
        if(form.selection.checked)
        {
        	form.task.value = "importfromdb";
        	form.submit();
        }
        for (i=form.selection.length-1; i > -1; i--)
        {
          if (form.selection[i].checked)
          {
            myOption = i;
          }
        }
        if (myOption == -1 && !form.selection.checked)
        {
	        alert("<?php echo JText::_( 'CC_SELECT_OPTION' ); ?>");
	        return false;
        }
	      else
	      {
	        form.task.value = "importfromdb";
	        form.submit();
	      }
    }
    else if(task == "export")
    {
      form.task.value = "doExport";
      form.submit();
    }
    else if(task == "importfromfile")
    {
      if(form.type.value == "")
      {
        alert("<?php echo JText::_( 'CC_SELECT_TYPE' ); ?>");
      }
      else if(form.type.value == "communicator")
      {
        form.task.value = "importxml";
        form.submit();
      }
      else if(form.type.value == "acajoom")
      {
        form.task.value = "importacajoomacsv";
        form.submit();
      }
      else if(form.type.value == "letterman")
      {
        form.task.value = "importxml";
        form.submit();
      }
      else if(form.type.value == "csv")
      {
        form.task.value = "importcsv";
        form.submit();
      }
      else if((form.type.value == "txt")&& (form.delimiter.value == ""))
      {
        alert("<?php echo JText::_( 'CC_ENTER_DELIMITER' ); ?>");
      }
      else if(form.type.value == "txt")
      {
        form.task.value = "importtxtcsv";
        form.submit();
      }
	  else if((form.type.value == "textarea") && (form.emailtext.value == ""))
      {
        alert("<?php echo JText::_( 'CC_EMAIL_EMPTY' ); ?>");
      }
      else if(form.type.value == "textarea")
      {
        form.task.value = "emailonly";
        form.submit();
      }
    }
    else
    {
      form.submit();
    }
  }
function onChanges()
{
	  var form = document.adminForm;
	  if(form.type.value == 'txt')
	  {
	    var hdelimiter = document.getElementById('delimiter');
	    hdelimiter.style.display = 'block';
	  }
	  else if((form.type.value != 'txt'))
	  {
	    var hdelimiter = document.getElementById('delimiter');
	    hdelimiter.style.display = 'none';
	  }
	if((form.type.value == 'textarea'))
	  {
	    var testarea1 = document.getElementById('testarea');
	    testarea1.style.display = 'block';

	    var fileimport1 = document.getElementById('fileimport');
	    fileimport1.style.display = 'none';
	  }
	else if((form.type.value != 'textarea'))
	  {
	    var testarea1 = document.getElementById('testarea');
	    testarea1.style.display = 'none';

	     var fileimport1 = document.getElementById('fileimport');
	    fileimport1.style.display = 'block';
	  }
}

</script>
<form action="index.php?option=com_ccnewsletter&controller=import" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col100">
<fieldset class="adminform">
    <legend><?php echo JText::_( 'CC_IMPORT_FROM_FILE' ); ?></legend>
<table class="admintable" width="100%" border="0">
<tr>
<td width="50%">
  <table class="admintable" width="100%" border="0">
    <tr>
    <td align="right" class="key">
        <label for="Newsletter Name">
          <?php echo JText::_( 'CC_FILE_TYPE' ); ?>:
        </label>
      </td>
      <td colspan="2">
      <select name="type"  onChange="onChanges()">
        <option value="" selected="selected">Select Type</option>
        <option value="txt">Text file</option>
        <option value="csv">CSV file</option>
        <option value="acajoom">Acajoom export file</option>
        <option value="communicator">Communicator export file</option>
        <option value="letterman">Letterman export file</option>
        <option value="textarea">Text Area</option>
        </select>
      </td>
    </tr>
  </table>

  <div id="fileimport" style = "display:block;">
    <table class="admintable" width="100%">
      <tr>
      <td align="right" class="key">
      <label for="Newsletter Name">
      <?php echo JText::_( 'CC_FILE' ); ?>:
      </label>
      </td>
      <td colspan="2">
      <input type="file" name="importfile" value="" size="30">
      </td>
    </tr>
    </table>
  </div>

  <div id="delimiter" style = "display:none;">
    <table class="admintable" width="100%">
      <tr>
        <td align="right" class="key">
          <label for="Newsletter Name">
            <?php echo JText::_( 'CC_DELIMETER' ); ?>:
          </label>
        </td>
        <td>
          <input type="text" name="delimiter" value="" size="30">
        </td>
      </tr>
      </table>
  </div>
  <div id="testarea" style = "display:none;">
    <table class="admintable" width="100%">
      <tr>
        <td align="right" class="key">
          <label for="Newsletter Name">
            <?php echo JText::_( 'CC_TEXTAREA' ); ?>:
          </label>
        </td>
        <td>
          <textarea name="emailtext" rows="5" cols="25"></textarea>
        </td>
      </tr>
      </table>
  </div>


</td>
<td width="40%">
  <table class="admintable" width="100%" >
  <tr>
  <td colspan="2" >
      <input type="radio" name="deletesubsfromfile" value="deletesubsfromfile">	&nbsp;<?php echo JText::_( 'CC_DETELE_CURRENT' ); ?>
    </td>
  </tr>
  </table>
</td>
<td>
  <table class="admintable" width="100%">
  <tr>
    <td colspan="2">
    <input class="button"  type="button" id="importfromfile" name="importfromfile" value="Start"  onclick="formsubmit('importfromfile');"/>
    </td>
  </tr>
  </table>
</td>
</tr>
</table>
</fieldset>
<?php if(!$this->totalcomponent == '0')
{
?>
<fieldset class="adminform">
<legend><?php echo JText::_( 'CC_IMPORT_FROM_DATABASE' ); ?></legend>
<table class="admintable" width="100%">
<tr>
<td width="50%">
<?php
 if($this->yanc)
 {
?>
  <table class="admintable" width="100%">
    <tr>
      <td style="padding-left:130px;">
        <input type="radio" name="selection" value="yanc" <?php if(	$this->totalcomponent == "1"){echo "checked";} ?> >&nbsp;YaNC
      </td>
    </tr>
    <tr>
      <td colspan="2">
      </td>
    </tr>
  </table>
<?php
 }
 if($this->acajoom)
 {
?>
  <table class="admintable" width="100%" >
    <tr>
      <td style="padding-left:130px;">
        <input type="radio" name="selection" value="acajoom" <?php if(	$this->totalcomponent == "1"){echo "checked";} ?>>	&nbsp;Acajoom
      </td>
    </tr>
    <tr>
      <td colspan="2">
      </td>
    </tr>
  </table>
<?php
 }
 if($this->vmod)
 {
?>
    <table class="admintable" width="100%" >
    <tr>
      <td style="padding-left:130px;">
        <input type="radio" name="selection" value="vmod" <?php if(	$this->totalcomponent == "1"){echo "checked";} ?>>	&nbsp;Vmod
      </td>
    </tr>
    <tr>
      <td colspan="2">
      </td>
    </tr>
  </table>
  <?php
 }
 if($this->communicator)
 {
  ?>
  <table class="admintable" width="100%">
    <tr>
      <td style="padding-left:130px;">
        <input type="radio" name="selection" value="communicator" <?php if(	$this->totalcomponent == "1"){echo "checked";} ?>>	&nbsp;Communicator
      </td>
    </tr>
    <tr>
      <td colspan="2">
      </td>
    </tr>
  </table>
<?php
 }
 if($this->letterman)
 {
?>
  <table class="admintable" width="100%">
  <tr>
    <td style="padding-left:130px;">
      <input type="radio" name="selection" value="letterman" <?php if(	$this->totalcomponent == "1"){echo "checked";} ?>>	&nbsp;Letterman
    </td>
  </tr>
  <tr>
    <td colspan="2">
    </td>
  </tr>
  </table>
<?php
 }
 ?>
 </td>
 <td  width="40%">
    <table class="admintable" width="100%" >
    <tr>
      <td >
        <input type="radio" name="deletesubs" value="deletesubs">	&nbsp;<?php echo JText::_( 'CC_DETELE_CURRENT' ); ?>
      </td>
    </tr>
    </table>
</td>
<td width="10%">
    <table class="admintable" width="100%">
    <tr>
      <td colspan="2">
      <input class="button"  type="button" id="importfromdb" name="importfromdb" value="Start"  onclick="formsubmit('importfromdb');"/>
      </td>
    </tr>
    </table>
  </td>
  </tr>
  </table>
  </fieldset>
<?php
}
?>
  <fieldset class="adminform">
  <legend><?php echo JText::_( 'CC_EXPORT_TO_CSV' ); ?></legend>
  <table class="admintable" width="100%">
  <tr>
    <td width="50%"  style="padding-left:140px;">
      <?php echo JText::_( 'CC_EXPORT_TO_CSV' ); ?>
    </td>
    <td width="40%"> &nbsp;
    </td>
    <td width="10%">
      <input class="button"  type="button" id="export" name="export" value="Start"  onclick="formsubmit('export');"/>
    </td>
  </tr>
  </table>
  </fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="import" />
</form>
<p class="copyright" style="text-align:center;" >
<?php
	if (isset($this->versionContent)) {
		echo $this->versionContent;
	}
?>
</p>
<br/>
<p class="copyright" style="text-align:center;" >
<?php echo $this->name; ?>&nbsp;<?php echo $this->version; ?>. Copyright (C) 2006 - <?php echo $curYear = date('Y'); ?>  Chill Creations<br/>Joomla! component by <a href="http://www.chillcreations.com" target="_blank">Chill Creations</a>
</p>
