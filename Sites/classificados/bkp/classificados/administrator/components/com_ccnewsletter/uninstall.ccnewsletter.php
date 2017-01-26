<?php
/**
* @package ccNewsletter
* @version 1.0.7
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
function com_uninstall() {
	$thisdir = JPATH_SITE .DS. 'images'.DS.'stories'.DS.'ccnewsletter';
/* Step 2. From this folder, I want to create a subfolder called "myfiles".  Also, I want to try and make this folder world-writable (CHMOD 0777). Tell me if success or failure... */
	if(mkdir($thisdir ."/params" , 0777))
	{
	  /* echo "Directory has been created successfully...";*/
	}
	else
	{
	   echo "Failed to create directory...";
	}
	$filename = JPATH_SITE .DS. 'images'.DS.'stories'.DS.'ccnewsletter'.DS.'params'.DS.'config.txt';
	$Content = "";
	$handle = fopen($filename, 'x+');
	fwrite($handle, $Content);
	fclose($handle);
	$db =& JFactory::getDBO();
	$query="select * from  #__components  WHERE name='ccNewsletter'  LIMIT 1";
	$db->setquery($query);
	$row = $db->loadObject();
	$params =  $row->params;
	$somecontent = $params;
if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }
    fclose($handle);
} else {
    echo "The file $filename is not writable";
}
echo 'ccNewsletter component successfully uninstalled!';
}
?>

