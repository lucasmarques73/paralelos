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

jimport('joomla.application.component.model');
class ccNewsletterModelsubscriber extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}
	function setId($id)
	{
		$this->_id		= $id;
		$this->_data	= null;
	}
	function &getData()
	{
		$row =& $this->getTable();
		$row->load( $this->_id );
		return $row;
	}
	function store()
	{
		$row =& $this->getTable();
		$post	= JRequest::get( 'post' );
		if (!$row->bind($post))
		 {
			//$this->setError($this->_db->getErrorMsg());
			return false;
		 }
		if(!$row->id)
		{
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='$row->email'";
			$db->setQuery( $query );
			$rows = $db->loadObjectList();
			$totals = count($rows);
			if($totals=='0')
			{
				if(!$row->id)
				{
					$row->set('sdate', date('Y-m-d H:i:s', time()));
				}
				// Make sure data is valid
				if (!$row->check())
				{
					return false;
				}
				// Store it
				if (!$row->store())
				{
					return false;
				}
				return true;
			}
		}
		else
		{
				$db =& JFactory::getDBO();
       			$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE id=".$row->id;
				$db->setQuery( $query );
				$rows = $db->loadObject();
				if($rows->email == $row->email)
				{
					if (!$row->check())
					{
						return false;
					}
					if (!$row->store())
					{
						return false;
					}

					return true;
				}
				else
				{
						$query = "SELECT * FROM #__ccnewsletter_subscribers WHERE email='$row->email'";
						$db->setQuery( $query );
						$rows = $db->loadObjectList();
						$totals = count($rows);
					    if($totals=='0')
						{
							if(!$row->id)
							{
								$row->set('sdate', date('Y-m-d H:i:s', time()));
							}
							// Make sure data is valid
							if (!$row->check())
							{
								return false;
							}
							// Store it
							if (!$row->store())
							{
								return false;
							}
							return true;
						}
						else
						{
							return false;
						}

		        }
       }
	}
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$row =& $this->getTable();
		if (count( $cids ))
		{
			foreach($cids as $cid)
			{
				if (!$row->delete( $cid ))
				{
					return false;
				}
			}
		}
		return true;
	}

	function synchronization()
	{
		$db =& JFactory::getDBO();
		$params = &JComponentHelper::getParams( 'com_ccnewsletter' );
		$syncallusers = $params->get('Syncallusers', 0);
		if($syncallusers)
		{
			$query = "INSERT INTO #__ccnewsletter_subscribers (name, email, enabled, sdate)"
					. "	SELECT name, email, '1', registerDate FROM #__users WHERE (email) NOT IN "
					. " (SELECT email FROM #__ccnewsletter_subscribers)"
				;
		}
		else
		{
			$query = "INSERT INTO #__ccnewsletter_subscribers (name, email, enabled, sdate)"
					. "	SELECT name, email, '1', registerDate FROM #__users WHERE (email) NOT IN "
					. " (SELECT email FROM #__ccnewsletter_subscribers) AND block=0"
				;
		}
		$db->setQuery( $query );
		$db->query();
		$num_rows = $db->getAffectedRows();
		return $num_rows;
	}
	function susynchronization()
	{
		$db =& JFactory::getDBO();
		include_once(JPATH_SITE.DS."administrator".DS."components".DS."com_virtuemart".DS."virtuemart.cfg.php");
		$vmtable_prfix = VM_TABLEPREFIX;
		$query = "INSERT INTO #__ccnewsletter_subscribers (email, name, enabled, sdate)"
				. "\n (SELECT u.user_email , CONCAT(u.first_name, u.last_name) AS username ,  '1', FROM_UNIXTIME(o.cdate) "
				. "\n FROM #__".$vmtable_prfix."_order_user_info AS u"
				. "\n LEFT JOIN  #__".$vmtable_prfix."_orders AS o ON u.order_id = o.order_id"
				. "\n WHERE (u.user_email) NOT IN  (SELECT s.email FROM #__ccnewsletter_subscribers AS s)"
				. "\n  GROUP BY u.user_email )"
				;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
		$num_rows = $db->getAffectedRows();
		return $num_rows;
	}
}
?>
