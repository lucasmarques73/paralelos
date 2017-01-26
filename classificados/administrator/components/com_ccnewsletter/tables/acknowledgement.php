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

class Tableacknowledgement extends JTable
{
	var $id = null;
	var $status = null;
	var $synstatus = null;
	var $activation = null;
	var $subs_title = null;
	var $subs_content = null;
	var $unsubs_title = null;
	var $unsubs_content = null;

	function __construct( &$db )
	{
		parent::__construct( '#__ccnewsletter_acknowledgement', 'id', $db );

	}
}
?>
