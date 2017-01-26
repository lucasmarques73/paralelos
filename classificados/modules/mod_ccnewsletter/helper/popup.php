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

if(!defined('_JEXEC'))
	define( '_JEXEC', 1 );

//set_time_limit(0);
ini_set('include_path', '../../../');
if(!defined('JPATH_BASE'))
	define('JPATH_BASE', ini_get('include_path') );

if(!defined('DS'))
	define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );

if(!isset($mainframe))
	$mainframe =& JFactory::getApplication('site');
	$db =& JFactory::getDBO();

	$content_id = JRequest::getVar( 'id', '', 'get', 'string');
	$query = 'SELECT *  FROM #__content WHERE id ='.$content_id;
	$db->setQuery( $query );
	$row = $db->loadObject();


  ?>
<table class="contentpaneopen">
<tbody>
<tr>
		<td class="contentheading" width="100%">
		<h3><?php echo $row->title;?></h3>
		</td>
</tr>
</tbody></table>

<table class="contentpaneopen">
<tbody>
<tr>
<td valign="top">
<?php echo  $row->introtext;?>

</td>
</tr>
</tbody>
</table>

