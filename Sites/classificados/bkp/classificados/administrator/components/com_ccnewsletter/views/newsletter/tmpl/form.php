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
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (pressbutton == 'save' || pressbutton == 'apply')
			{
				if (form.name.value == "")
				{
					alert( "<?php echo JText::_( 'CC_ENTER_CC_NAME'); ?>" );
				}
				else
				{
					submitform( pressbutton );
				}
			}
			 else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'CC_DETAILS' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="Newsletter Name">
					<?php echo JText::_( 'CC_NEWSLETTER_NAME' ); ?>:
				</label>
			</td>
			<td>

<?php
		if($this->newsletterRecord->name)
		{
			$str = $this->newsletterRecord->name;
			$subject = htmlentities($str, ENT_QUOTES, 'UTF-8');
		//	$newsletterModel =$this->getModel('newsletter');
		//	$subject = $newsletterModel->UTF8entities($subject);
		}
		else
		{
			$subject= "";
		}
?>

			 	<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250" value="<?php echo $subject;?>" />
			</td>
		</tr>
    <tr>
	</table>
	</fieldset>
  <fieldset class="adminform">
		<legend><?php echo JText::_( 'CC_HELPFUL_HINTS' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
        [<?php echo "unsubscribe link"; ?>]
			</td>
			<td>
				<?php echo JText::_( 'CC_UNSUBSCRIBE_TEXT' ); ?>
		</tr>
    <tr>
	<tr>
		<td width="100" align="right" class="key">
        [<?php echo "name"; ?>]
			</td>
			<td>
				<?php echo JText::_( 'CC_INSERT_NAME_TEXT' ); ?>
		</tr>
    <tr>
	</table>
	</fieldset>
  	<table class="adminform">
				<tr>
					<td>
						<?php
            			$editor		=& JFactory::getEditor();
						echo $editor->display( 'body',  $this->newsletterRecord->body , '100%', '550', '75', '20' ) ;
						?>
					</td>
				</tr>
				</table>
</div>
<div class="clr"></div>
<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="id" value="<?php echo $this->newsletterRecord->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="newsletter" />
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
