<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/category.php $
// $Id: category.php 2510 2010-10-10 22:29:40Z aha $
/****************************************************************************************\
**   JoomGallery  1.5                                                                   **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Category model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelCategory extends JoomGalleryModel
{
  /**
   * Category data object
   *
   * @access  protected
   * @var     object
   */
  var $_category;

  /**
   * Categories data array
   *
   * @access  protected
   * @var     array
   */
  var $_categories;

  /**
   * Images data array
   *
   * @access  protected
   * @var     array
   */
  var $_images;

  /**
   * Categories number
   *
   * @access  protected
   * @var     int
   */
  var $_totalcategories;

  /**
   * Images number
   *
   * @access  protected
   * @var     int
   */
  var $_totalimages;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function __construct()
  {
    parent::__construct();

    $id = JRequest::getInt('catid', 0);
    $this->setId((int)$id);
  }

  /**
   * Method to set the category identifier
   *
   * @access  public
   * @param   int     $id The Category ID
   * @return  void
   * @since   1.5.5
   */
  function setId($id)
  {
    // Set new category ID if valid and wipe data
    if(!$id)
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_NO_CATEGORY_SPECIFIED'), 'notice');
    }
    $this->_id    = $id;
    $this->_data  = null;
  }

  /**
   * Method to get the data of the current category
   *
   * @access  public
   * @return  object  An object with the category data
   * @since   1.5.5
   */
  function getCategory()
  {
    if($this->_loadCategory())
    {
      return $this->_category;
    }

    return false;
  }

  /**
   * Retrieves the data of all sub-categories
   *
   * @access  public
   * @return  array   Array of objects containing the categories data from the database
   * @since   1.5.5
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
   * Method to get the total number of categories
   *
   * @access  public
   * @return  int     The total number of categories
   * @since   1.5.5
   */
  function getTotalCategories()
  {
    // Let's load the categories if they doesn't already exist
    if(empty($this->_totalcategories))
    {
      $query = $this->_buildCategoriesQuery();
      $this->_totalcategories = $this->_getListCount($query);
    }

    return $this->_totalcategories;
  }

  /**
   * Retrieves the data of all images of the current category
   *
   * @access  public
   * @return  array   Array of objects containing the images data from the database
   * @since   1.5.5
   */
  function getImages()
  {
    if($this->_loadImages())
    {
      return $this->_images;
    }

    return array();
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
    if(empty($this->_totalimages))
    {
      $query = $this->_buildImagesQuery();
      $this->_totalimages = $this->_getListCount($query);
    }

    return $this->_totalimages;
  }

  /**
   * Method to get one image selected by chance
   *
   * @access  public
   * @return  object  An object with the data of the selected image
   * @since   1.5.5
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

  /**
   * Method to load the data of the current category
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _loadCategory()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_category))
    {
      $this->_db->setQuery("SELECT
                              cid,
                              name,
                              parent,
                              description,
                              metakey,
                              metadesc
                            FROM
                              "._JOOM_TABLE_CATEGORIES."
                            WHERE
                              cid = ".$this->_id."
                          ");
      if(!$row = $this->_db->loadObject())
      {
        JError::raiseError(500, JText::sprintf('Category with ID %d not found', $this->_id));
      }

      $this->_category = $row;
    }

    return true;
  }

  /**
   * Method to load the data of all sub-categories
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _loadCategories()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_categories))
    {
      // Get the pagination request variables
      $limit      = $this->_config->get('jg_subperpage');#JRequest::getVar('limit', 0, '', 'int');
      $limitstart = JRequest::getInt('catlimitstart', 0);

      $query = $this->_buildCategoriesQuery();

      if(!$rows = $this->_getList($query, $limitstart, $limit))
      {
        return false;
      }

      $this->_categories = $rows;
    }

    return true;
  }

  /**
   * Method to load the data of all images of the current category
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _loadImages()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_images))
    {
      // Get the pagination request variables
      if($this->_config->get('jg_bigpic_open') > 4)
      {
        // If we want to display all images in a popup box we will need all images
        $limit = null;
      }
      else
      {
        $limit      = $this->_config->get('jg_perpage');#JRequest::getVar('limit', 0, '', 'int');
      }
      $limitstart = JRequest::getInt('limitstart', 0);

      $query = $this->_buildImagesQuery();

      if(!$rows = $this->_getList($query, $limitstart, $limit))
      {
        return false;
      }

      $this->_images = $rows;
    }

    return true;
  }

  /**
   * Returns the query for loading the categories
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the categories data from the database
   * @since   1.5.5
   */
  function _buildCategoriesQuery()
  {
    $query = "SELECT
                *
              FROM
                "._JOOM_TABLE_CATEGORIES."
              ".$this->_buildCategoriesWhere()."
              ".$this->_buildCategoriesOrderby();

    return $query;
  }


  /**
   * Returns the 'where' part of the query for loading the categories
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildCategoriesWhere()
  {
    /*$filtercat = JRequest::getInt('filter');*/

    $where = array();

    $where[] = "published = 1";
    $where[] = "parent    = ".$this->_id;

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
   * Returns the 'order by' part of the query for loading the categories
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildCategoriesOrderBy()
  {
    if($this->_config->get('jg_ordersubcatbyalpha'))
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
   * Returns the query for loading the images
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the images data from the database
   * @since   1.5.5
   */
  function _buildImagesQuery()
  {
    $query = "SELECT
                *,
                a.owner AS owner,
                ".JoomHelper::getSQLRatingClause('a')." AS rating";
    if($this->_config->get('jg_showcatcom'))
    {
      $query .= ",
                ( SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                           cmtpic = a.id
                    AND published = 1
                    AND approved  = 1
                ) AS comments";
    }
    $query .= "
              FROM
                "._JOOM_TABLE_IMAGES." AS a
              LEFT JOIN
                "._JOOM_TABLE_CATEGORIES." AS c
              ON
                c.cid = a.catid
              ".$this->_buildImagesWhere()."
              ".$this->_buildImagesOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for loading the images
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildImagesWhere()
  {
    /*$filtercat = JRequest::getInt('filter');*/

    $where = array();

    $where[] = "a.published = 1";
    $where[] = "a.catid     = ".$this->_id;
    $where[] = "a.approved  = 1";
    $where[] = "c.access   <= ".$this->_user->get('aid');

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
   * Returns the 'order by' part of the query for loading the images
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildImagesOrderBy()
  {
    $orderby = array();

    if($this->_config->get('jg_firstorder'))
    {
      $orderby[] = 'a.'.$this->_config->get('jg_firstorder');
    }
    if($this->_config->get('jg_secondorder'))
    {
      $orderby[] = 'a.'.$this->_config->get('jg_secondorder');
    }
    if($this->_config->get('jg_thirdorder'))
    {
      $orderby[] = 'a.'.$this->_config->get('jg_thirdorder');
    }

    $orderby = count($orderby) ? implode(', ', $orderby) : '';

    if($this->_config->get('jg_usercatorder'))
    {
      $user_orderby   = JRequest::getCmd('orderby');
      $user_orderdir  = JRequest::getCmd('orderdir');

      switch($user_orderby)
      {
        case 'user':
          $orderby = 'a.owner';
          break;
        case 'date':
          $orderby = 'a.imgdate';
          break;
        case 'rating':
          $orderby = 'rating';
          break;
        case 'title':
          $orderby = 'a.imgtitle';
          break;
        case 'hits':
          $orderby = 'a.hits';
          break;
        default:
          // Use selected ordering above
          break;
      }
      if(    $user_orderby == 'title'
          || $user_orderby == 'hits'
          || $user_orderby == 'user'
          || $user_orderby == 'date'
          || $user_orderby == 'rating'
        )
      {
        if($user_orderdir == 'desc')
        {
          $orderby .= ' DESC';
        }
        else
        {
          if($user_orderdir == 'asc')
          {
            $orderby .= ' ASC';
          }
        }
      }
      if($user_orderby == 'rating')
      {
          $orderby .= ', imgvotesum DESC';
      }
    }

    return 'ORDER BY '.$orderby;
  }
}