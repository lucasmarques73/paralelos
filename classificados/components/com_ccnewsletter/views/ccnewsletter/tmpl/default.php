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
<div class="componentheading">
	<?php echo $this->pageTitle; ?>
</div>
<form action="" method="post" name="subscribeForm" id="subscribeForm">
<table>
<tr>
	<td align="left" colspan="2">
		<?php echo $this->operationStatus; ?>
	</td>
</tr>
<?php
	if($this->addSubscriberStatus != '1')
	{
?>
<tr>
	<td width="100">
		<label for="name">
			<?php echo JText::_( 'CC_NAME' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="name" id="name1" size="32" maxlength="250" value="<?php echo $this->name;?>" />
	</td>
</tr>
<tr>
	<td width="100">
		<label  for="email">
			<?php echo JText::_( 'CC_EMAIL' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="email" id="email1" size="32" maxlength="250" value="<?php echo $this->email;?>" />
	</td>
</tr>
<tr>
	<td align="center" colspan="2">
		<input type="submit" name="Submit" value="<?php echo JText::_( 'CC_SUBMIT' ); ?>" />
	</td>
</tr>
<?php
	}
?>
</table>
<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="task" value="addSubscriber" />
</form>
<br />
