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

<script language="javascript">
		function configvalidation() {
			var form = document.adminForm;
			if((form.fromName.value == "") || (form.fromEmail.value == "")|| (form.testEmail.value == ""))
			{
				alert( "<?php echo JText::_( 'CC_SET_PARAMETER'); ?>" );
				exit;
			}
			else if(( form.fromEmail.value.search("@") == -1) || ( form.fromEmail.value.search("[.*]" ) == -1 ))
			{
				alert( "<?php echo JText::_( 'CC_VALID_EMAIL_ADDRESS'); ?>" );
				exit;
			}

			else if(( form.testEmail.value.search("@") == -1) || ( form.testEmail.value.search("[.*]" ) == -1 ))
			{
				alert( "<?php echo JText::_( 'CC_VALID_TEST_EMAIL_ADDRESS'); ?>" );
				exit;
			}
			else
			{
				form.submit();
			}
		}
		</script>
<form action="index.php" method="post" name="adminForm" id="adminForm" onsubmit="configvalidation()">
<div class="col100">
<fieldset class="adminform">
<legend><?php echo JText::_( 'CC_EMAIL_SENT_FROM' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="fromName">
					<?php echo JText::_( 'CC_NAME' ); ?>:
				</label>
			</td>
			<td><?php echo $this->fromName;?><input type="text" name="fromName" value="<?php echo $this->fromName;?>" style="visibility: hidden"/>
			</td>
		</tr>
    	<tr>
			<td width="100" align="right" class="key">
				<label for="fromEmail">
					<?php echo JText::_( 'CC_EMAIL_ADDRESS' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->fromEmail;?><input type="text" name="fromEmail" value="<?php echo $this->fromEmail;?>" style="visibility: hidden"/>
			</td>
		</tr>
        	<tr>
			<td width="100" align="right" class="key">
				<label for="fromEmail">
					<?php echo JText::_( 'CC_EMAIL_SUBJECT' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->subject;?><input type="text" name="subject" value="<?php echo $this->subject;?>" style="visibility: hidden"/>
			</td>
		</tr>
	</table>
	</fieldset>
<fieldset class="adminform">
<legend><?php echo JText::_( 'CC_NEWSLETTER_TO_SEND' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="Newsletter">
					<?php echo JText::_( 'CC_NEWSLETTER' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists;?>
			</td>
		</tr>

	</table>
	</fieldset>
<fieldset class="adminform">
<legend><?php echo JText::_( 'CC_NEWSLETTER_PREVIEW' ); ?></legend>
<?php
        echo $this->newsletterForPreviewBody->body;
        echo '<textarea id="body" name="body" style="visibility: hidden">';
        echo $this->newsletterForPreviewBody->body;
        echo '</textarea>';
?>
        	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="testEmail" value="<?php echo $this->testEmail;?>" />
<input type="hidden" name="controller" value="sendNewsletter" />
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

