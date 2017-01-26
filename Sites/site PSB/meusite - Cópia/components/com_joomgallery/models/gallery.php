<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/gallery.php $
// $Id: gallery.php 2566 2010-11-03 21:10:42Z mab $
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
 * Gallery Component Model
 *
 * @package     Joomla
 * @subpackage  Content
 * @since 1.5.1
 */
class JoomGalleryModelGallery extends JoomGalleryModel
{
  /**
   * Categories data array
   *
   * @var array
   */
  var $_data;

  /**
   * Categories number
   *
   * @var integer
   */
  var $_total = null;

  /**
   * Returns the query
   * @return string The query to be used to retrieve the rows from the database
   */
  function _buildQuery()
  {
    $query = "SELECT 
                *
              FROM 
                "._JOOM_TABLE_CATEGORIES."
              ".$this->_buildWhere()."
              ".$this->_buildOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query
   * @return string The 'where' part of the query
   */
  function _buildWhere()
  {
    /*$filtercat = JRequest::getInt('filter');*/

    $where = array();

    $where[] = "published = 1";
    $where[] = "parent    = 0";

    if(!$this->_config->get('jg_showrmsmcats'))
    {
      $where[] = "access <= ".$this->_user->get('aid');
    }

    /*//Filter by type
    switch($filtercat) {
      //published
      case 1:
        $where[] = 'published = 1';
        break;
      //not published
      case 2:
        $where[] = 'published = 0';
        break;
      //user categories
      case 3:
        $where[] = 'owner IS NOT NULL';
        break;
      //admin categories
      case 4:
        $where[] = 'owner IS NULL';
        break;
      default:
        break;
    }

    if ($searchtext = JRequest::getString('search'))
    {
      $filter   = $this->_db->Quote('%'.$this->_db->getEscaped($searchtext, true).'%', false);
      $where[]  = "(c.name LIKE $filter OR c.description LIKE $filter)";
    }*/

    $where = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    return $where;
  }

  /**
   * Returns the 'order by' part of the query
   * @return string The 'order by' part of the query
   */
  function _buildOrderBy()
  {
    if($this->_config->get('jg_ordercatbyalpha'))
    {
      $orderby = "ORDER BY name";
    }
    else
    {
      $orderby = "ORDER BY ordering";
    }

    /*$sort = JRequest::getInt('sort');

    $sortorder  = '';
    switch($sort) {
      case 0:
        $sortorder = 'c.ordering ASC';
        break;
      /*case 1:
        $sortorder = 'c.ordering DESC';
        break;*/
      /*case 2:
        $sortorder = 'c.catpath ASC';
        break;
      case 3:
        $sortorder = 'c.catpath DESC';
        break;
      case 4:
        $sortorder = 'c.cid ASC';
        break;
      case 5:
        $sortorder = 'c.cid DESC';
        break;
      case 6:
        $sortorder = 'c.name ASC';
        break;
      case 7:
        $sortorder = 'c.name DESC';
        break;
      case 8:
        $sortorder = 'c.owner ASC';
        break;
      case 9:
        $sortorder = 'c.owner DESC';
        break;
      default:
        break;
    }

    if ($sortorder != ''){
      $orderby = 'ORDER BY '.$sortorder;
    }*/

    return $orderby;
  }
  /**
   * Gallery data array
   */
  function getCategories()
  {
    if($this->_loadCategories())
    {
      return $this->_categories;
    }

    return array();
  }

  /**
   *
   */
  function _loadCategories()
  {    
    // Lets load the data if it doesn't already exist
    if(empty($this->_categories))
    {
      // Get the pagination request variables
      $limit      = $this->_config->get('jg_catperpage');#JRequest::getVar('limit', 0, '', 'int');
      $limitstart = JRequest::getInt('limitstart', 0);

      $query = $this->_buildQuery();

      if(!$rows = $this->_getList($query, $limitstart, $limit))
      {
        return false;
      }

      $this->_categories = $rows;
    }

    return true;
  }

  /**
   * Method to get the total number of categories
   *
   * @access public
   * @return integer The total number of categories
   */
  function getTotal()
  {
    // Lets load the categories if they doesn't already exist
    if (empty($this->_total))
    {
      $query = $this->_buildQuery();
      $this->_total = $this->_getListCount($query);
    }

    return $this->_total;
  }

  /**
   * Method to get the total number of categories
   *
   * @access public
   * @return integer The total number of categories
   */
  function getRandomImage($catid = 0, $random_catid = 0)
  {
    $query = "  SELECT
                  *,
                  c.access
                FROM
                  "._JOOM_TABLE_IMAGES." AS p
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS c
                ON
                  c.cid = p.catid";
    if($this->_config->get('jg_showrandomcatthumb') == 1)
    {
      $query.= "
                WHERE
                      p.catid = ".$catid;
    }
    else
    {
      if($this->_config->get('jg_showrandomcatthumb') >= 2)
      {
        $query.= "
                WHERE
                      p.catid = ".$random_catid;
      }
    }
    $query.= "
                  AND p.published = 1
                  AND p.approved  = 1
                  AND c.access   <= ".$this->_user->get('aid')."
                  AND c.published = 1
              ";
    
    $this->_db->setQuery($query);
    if(!$rows = $this->_db->loadObjectList())
    {
      return false;
    }

    $row = $rows[mt_rand(0, count($rows)-1)];

    return $row;
  }
}