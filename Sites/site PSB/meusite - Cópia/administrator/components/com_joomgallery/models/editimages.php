<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/editimages.php $
// $Id: editimages.php 2566 2010-11-03 21:10:42Z mab $
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
 * Edit multiple images model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelEditimages extends JoomGalleryModel
{
  /**
   * Images data array
   *
   * @access  protected
   * @var     array
   */
  var $_images;

  /**
   * Retrieves the images data
   *
   * @access  public
   * @return  array   Array of objects containing the images data from the database
   * @since   1.5.5
   */
  function _buildQuery()
  {
    $query = "SELECT
                a.*,
                c.cid AS category_id,
                c.name AS category_name,
                g.name AS groupname
              FROM
                "._JOOM_TABLE_IMAGES." AS a
              LEFT JOIN
                "._JOOM_TABLE_CATEGORIES." AS c
              ON
                c.cid = a.id
              LEFT JOIN
                #__groups AS g
              ON
                g.id = a.access
             ".$this->_buildWhere()."
             ".$this->_buildOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for loading all selected images
   *
   * @access  protected
   * @return  string    The 'where' part of the query for loading all selected images
   * @since   1.5.5
   */
  function _buildWhere()
  {
    $cid = JRequest::getVar('cid', array(), '', 'array');

    return 'WHERE a.id IN ('.implode(',', $cid).')';
  }

  /**
   * Returns the 'order by' part of the query for loading all selected images
   *
   * @access  protected
   * @return  string    The 'order by' part of the query for loading all selected images
   * @since   1.5.5
   */
  function _buildOrderBy()
  {
    return '';
  }

  /**
   * Retrieves the data of the selected images
   *
   * @access  public
   * @return  array   Array of objects containing the images data from the database
   * @since   1.5.5
   */
  function getImages()
  {
    // Lets load the data if it doesn't already exist
    if(empty($this->_images))
    {
      $query = $this->_buildQuery();
      $this->_images = $this->_getList($query);
    }

    return $this->_images;
  }
}