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
<form action="index.php" method="post" name="adminForm">
		<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Filter Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
				echo $this->lists['state'];
				?>
			</td>
		</tr>
		</table>
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'CC_ID' ); ?>
			</th>
			<th width="5">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th >
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_SUBSCRIBER_NAME' ), 's.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th>
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_SUBSCRIBER_USERNAME' ), 's.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
      		<th >
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_SUBSCRIBER_EMAIL' ), 's.email', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
      		<th >
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_STATUS' ), 's.enabled', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
      		<th >
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_SUBSCRIBER_DATE' ), 's.sdate', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="5">
				<?php echo JHTML::_('grid.sort',  JText::_( 'CC_SUB_ID' ), 's.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
				<tfoot>
				<tr>
					<td colspan="8">
						<?php echo $this->pageNav->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{	$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_ccnewsletter&controller=subscriber&task=edit&cid[]='. $row->id );
		$row->published = $row->enabled;
		$db =& JFactory::getDBO();
		$query = "SELECT  * FROM #__users WHERE email = '".$row->email."' LIMIT 1"  ;
		$db->setQuery( $query );
		$subscriberdetail = $db->loadObject();
		$published		= JHTML::_('grid.published', $row, $i );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pageNav->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
			</td>
			<td align="left">
				<?php if($subscriberdetail){echo
$subscriberdetail->username; }?>

			</td>
   		   <td align="left">
				<a href="<?php echo $link; ?>"><?php echo $row->email; ?></a>
			</td>
   		   <td align="center">
				<?php echo $published	; ?>
			</td>
   		   <td align="center">
				<?php
					if($row->sdate != '0000-00-00 00:00:00')
						echo JHTML::_('date',  $row->sdate, JText::_('DATE_FORMAT_LC3') )	;
					else
						echo "N/A";
				?>
			</td>
			 <td align="center" width="5">
				<?php echo  $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
<input type="hidden" name="option" value="com_ccnewsletter" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="subscriber" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
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
