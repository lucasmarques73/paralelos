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
// newsletter model class
class ccNewsletterModelnewsletter extends JModel
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
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	function &getData()
	{
		$row =& $this->getTable();
		$row->load( $this->_id );
		return $row;
	}
	// save record
	function store()	{
		$row =& $this->getTable();
		// consume the post data with allow_html
		$data = JRequest::get( 'post',JREQUEST_ALLOWRAW);
		$post = array();

		// Bind the form fields to the hello table
		if (!$row->bind($data)) {
			return false;
		}
		// Make sure the  record is valid
		if (!$row->check()) {
			return false;
		}
		// Store
		if (!$row->store()) {
			return false;
		}
      	$shibu =	$row->id;
		return $shibu;
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

	function copy()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids ))
		{
			foreach($cids as $cid)
			{
				if ($row->load( (int)$cid ))
				{
					$row->id			= 0;
					$row->name			= 'Copy of ' . $row->name;
					$row->body			= $row->body;

					if (!$row->store())
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
		}
		return true;
	}
	function UTF8entities($content="")
	{
         return "<html><head><meta content=\"text/html; charset=utf-8\" http-equiv=\"content-type\"></head><body>".$content."</body></html>";
    }

}
?>
