<?php
/**
* @package ccNewsletter
* @version 1.0.9
* @author  Chill Creations <info@chillcreations.com>
* @link    http://www.chillcreations.com
* @copyright Copyright (C) 2008 - 2010 Chill Creations-All rights reserved
* @copyright Copyright (C) Copyright 2010 Elodig- All rights reserved
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


// no direct access
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
// The toolbar is already set in admin.ccnewsletter.php
// The main view
if ($this->ccdata['ajax'])
{
	?>
	<script type="text/javascript">
		// Initializes ajax
		function ajax_post(xmlHttp)
		{
			xmlHttp.open("POST", '<?php echo $this->baseurl; ?>/index.php', true);
			xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.send('option=com_ccnewsletter&controller=sendNewsletter&task=ccsend_all&id=<?php echo $this->ccdata['message_id']; ?>');
		}

		// Initializes ajax
		function ajax_create()
		{
			var xmlHttp;
			try
			{
				// Firefox, Opera 8.0+, Safari
				xmlHttp = new XMLHttpRequest();
			}
			catch (e)
			{
				// Internet Explorer
				try
				{
					xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					try
					{
						xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						throw "ai_ajax : ajax failure";
					}
				}
			}
			return xmlHttp;
		}

		// Display addresses to which th e-mail was sent and start the countdown before the next sending.
		// Called when the result of the ajax request is received (= when the previous batch sending is complete).
		function display_addresses ( responseText )
		{
			//document.getElementById('result_tbody').innerHTML += responseText;
			responseText = responseText.substr(21);
			arData=responseText.match(/<td[^>]*>(.|\n)*?(?=<\/td>)/ig);
			col = 0;
			var myRow = null;
			for(i=0,len=arData.length;i<len;i++) {
			    if(col%3 == 0) myRow = document.getElementById('result_tbody').insertRow(-1);
			    var myCell = myRow.insertCell(-1);
			    if(col%3 != 1) myCell.style.textAlign = 'center';
			    myCell.innerHTML = arData[i].replace(/<td[^>]*>/i,'');
			    col++;
			}
			if(responseText.indexOf('<input id="stop" value="stop" type="hidden" />') != -1) {
			    myRow = document.getElementById('result_tbody').insertRow(-1);
			    var myCell = myRow.insertCell(-1);
			    myCell.colSpan = arData.length;
			    myCell.innerHTML = '<input id="stop" value="stop" type="hidden" />';
			}
			document.getElementById('counter').innerHTML = <?php echo $this->ccdata['batchinterval']; ?>;
			window.setTimeout("fire_ajax_request();", 1000);
			document.getElementById('display_sending').style.display = "none";
			document.getElementById('display_counter').style.display = "";
		}

		// Check if it is time to send a new batch. If it is not, start a one second timeout before checking again. If it is, send an ajax request to the server so that it send a nw batch.
		function fire_ajax_request()
		{
			if ( document.getElementById('stop') == null )
			{
				var timeout = document.getElementById('counter').innerHTML;
				timeout = timeout * 1; //Ensure integer
				timeout--;
				document.getElementById('counter').innerHTML = timeout;

				if (timeout <= 0)
				{
					var xmlHttp;
					try
					{
						xmlHttp = ajax_create();
					}
					catch (err)
					{
						throw "ajax failure";
					}
					xmlHttp.onreadystatechange=function()
					{
						if(xmlHttp.readyState==4)
							display_addresses(xmlHttp.responseText);
					}
					ajax_post(xmlHttp);
					document.getElementById('display_sending').style.display = "";
					document.getElementById('display_counter').style.display = "none";
				}
				else
					window.setTimeout("fire_ajax_request();", 1000);
			}
			else
			{
				document.getElementById('display_success').style.display = "";
				document.getElementById('display_counter').style.display = "none";
			}
		}
	</script>
	<?php
}
?>
<form action="index.php" method="post" name="adminForm">
	<div id="display_success" style="display:none; width: 100%;color: green; font-weight: bold; text-align: center;"><?php echo JText::_( 'CC_SUCCESS' ); ?></div>
	<div id="display_counter" style="width: 100%; color: blue; text-align: center;"><?php echo JText::_( 'CC_COUNTER' ); ?> <span id="counter">0</span>  <?php echo JText::_( 'CC_SECONDS' ); ?></div>
	<div id="display_sending" style="display:none; width: 100%; color: blue; text-align: center;"><?php echo JText::_( 'CC_SENDING_BATCH' ); ?></div>
	<table style="margin: auto; width: auto;" class="adminlist" cellspacing="1">
		<thead>
			<tr>
				<th width="10" class="title">
					<?php echo JText::_( 'NUM' ); ?>
				</th>
				<th class="title">
					<?php echo JText::_( 'CC_EMAIL' ); ?>
				</th>
				<th class="title">
					<?php echo JText::_( 'CC_SENT' ); ?>
				</th>
			</tr>
		</thead>
		<tbody id="result_tbody">
			<?php
			foreach( $this->ccdata['results'] as $result )
			{
				?>
				<tr>
					<td style="text-align: center;"><?php echo $result['index']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td style="text-align: center;"><?php echo $result['sent']; ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
        <?php $id = JRequest::getVar( 'id', '', 'get', 'string' ); ?>
	<input type="hidden" name="option" value="com_ccnewsletter" />
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="sendNewsletter" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php
if ($this->ccdata['ajax'])
{
	?>
	<script type="text/javascript">
		document.getElementById('counter').innerHTML = <?php echo $this->ccdata['batchinterval']; ?>;
		window.setTimeout("fire_ajax_request();", 1000);
	</script>
	<?php
}
?>
