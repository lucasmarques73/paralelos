<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/control.php $
// $Id: control.php 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Control panel model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelControl extends JoomGalleryModel
{
	/**
	 * Menu data array
	 *
   * @access  protected
	 * @var     array
	 */
	var $_data;

	/**
	 * Returns the query for loading the menu entries
   *
   * @access  protected
	 * @return  string    The query to be used to retrieve the menu entries from the database
   * @since   1.5.5
	 */
	function _buildQuery()
	{
		$query = "SELECT
                *
		          FROM
                #__components
              WHERE
                    admin_menu_link LIKE 'option=com_joomgallery%'
                AND parent != ''
              ORDER BY
                id";

		return $query;
	}

	/**
	 * Retrieves the data of the backend menu entries for JoomGallery
   *
   * @access  public
	 * @return  array   An array of objects containing the data of the menu entries from the database
   * @since   1.5.5
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}
}