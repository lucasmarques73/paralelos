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
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (JPATH_SITE . '/components/com_content/helpers/route.php');
class modccnewsletterHelper
{
	// get the text to dispaly on the top of the module from the params
	function isUserLogin()
	{
		$user =& JFactory::getUser();
		return $user->id?true:false;
	}

	function isUserSubscribed()
	{
		$user	=&	JFactory::getUser();
		$db		=&	JFactory::getDBO();
		$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email = '". $user->email . "' and enabled=1";
		$db->setQuery( $query );
		$total = $db->loadResult();
		return $total?true:false;
	}

	function getUsername()
	{
		$user =& JFactory::getUser();
		return $user->name;
	}

	function getUseremail()
	{
		$user =& JFactory::getUser();
		return $user->email;
	}
}
