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
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
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
	<tr>
		<td width="100" align="right" class="key">
        [<?php echo "activate link"; ?>]
			</td>
			<td>
				<?php echo JText::_( 'CC_ACTIVATION_TEXT' ); ?>
		</tr>
    <tr>
	</table>
	</fieldset>
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'CC_SUBSCRIBE_MAIL' ); ?></legend>
  	<table class="admintable" width="100%">
		<tr>
			<td align="right" class="key">
				<label for="Newsletter Name">
					<?php echo JText::_( 'CC_SUBSCRIBE_SUBJECT' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="subs_title" id="subs_title" size="50" maxlength="250" value="<?php echo $this->acknowledgementrow->subs_title;?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php
					$editor		=& JFactory::getEditor();
					echo $editor->display( 'subs_content',  $this->acknowledgementrow->subs_content , '100%', '350', '75', '20' ) ;
				?>
			</td>
		</tr>
	</table>
	</fieldset>
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'CC_UNSUBSCRIBE_MAIL' ); ?></legend>
  	<table class="admintable" width="100%">
		<tr>
			<td align="right" class="key">
				<label for="Newsletter Name">
					<?php echo JText::_( 'CC_UNSUBSCRIBE_SUBJECT' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="unsubs_title" id="unsubs_title" size="50" maxlength="250" value="<?php echo $this->acknowledgementrow->unsubs_title;?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php
					$editor		=& JFactory::getEditor();
					echo $editor->display( 'unsubs_content',  $this->acknowledgementrow->unsubs_content , '100%', '350', '75', '20' ) ;
				?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="id" value="<?php echo $this->acknowledgementrow->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="acknowledgement" />
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
