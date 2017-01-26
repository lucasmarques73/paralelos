<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/mini.php $
// $Id: mini.php 2566 2010-11-03 21:10:42Z mab $
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
 * Mini Joom model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelMini extends JoomGalleryModel
{
  /**
   * Images data array
   *
   * @var array
   */
  var $_images;

  /**
   * Images number
   *
   * @var integer
   */
  #var $_total = null;

  /**
   * Returns the query for loading the images
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the images data from the database
   * @since   1.5.5
   */
  function _buildQuery()
  {
    $query  = " SELECT
                  jg.id,
                  jg.catid,
                  jg.imgtitle,
                  jg.imgthumbname,
                  jgc.name
                FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                ".$this->_buildWhere();
                #".$this->_buildOrderBy();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for loading the images
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildWhere()
  {
    $catid = $this->_mainframe->getUserStateFromRequest('joom.mini.catid', 'catid', 0, 'int');

    $where = array();

    // Ensure that image may be seen later on
    $where[] = 'jgc.published = 1';
    $where[] = 'jgc.access <= '.$this->_user->get('aid');
    $where[] = 'jg.approved = 1';
    if($this->_mainframe->getUserStateFromRequest('joom.mini.type', 'type', '', 'cmd') != 'category')
    {
      $where[] = 'jg.published = 1';
    }
    if($catid || JRequest::getCmd('type') == 'category')
    {
      $where[] = 'jg.catid = '.$catid;
    }

    $where = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for loading the images
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  /*function _buildOrderBy()
  {
    $orderby = '';

    return $orderby;
  }*/

  /**
   * Retrieves the images data
   *
   * @access  public
   * @return  array   Array of objects containing the images data from the database
   * @since   1.5.5
   */
  function getImages()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_images))
    {
      $limitstart = JRequest::getInt('limitstart');
      $limit      = JRequest::getInt('limit');

      $query = $this->_buildQuery();

      $this->_images = $this->_getList($query, $limitstart, $limit);
    }

    return $this->_images;
  }

  /**
   * Method to get the total number of images
   *
   * @access  public
   * @return  int     The total number of images
   * @since   1.5.5
   */
  function getTotalImages()
  {
    // Let's load the categories if they doesn't already exist
    if (empty($this->_total))
    {
      $query = $this->_buildQuery();
      $this->_total = $this->_getListCount($query);
    }

    return $this->_total;
  }
}