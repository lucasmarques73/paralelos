<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/categories.php $
// $Id: categories.php 2593 2010-11-20 21:45:43Z erftralle $
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
 * Categories model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelCategories extends JoomGalleryModel
{
  /**
   * Categories data array
   *
   * @access  protected
   * @var     array
   */
  var $_categories;

  /**
   * Categories number
   *
   * @access  protected
   * @var     int
   */
  var $_total = null;

  /**
   * Returns the query for listing the categories
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the categories data from the database
   * @since   1.5.5
   */
  function _buildQuery()
  {
    $query = "SELECT
                c.*,
                g.name AS groupname
              FROM
                "._JOOM_TABLE_CATEGORIES." AS c
              LEFT JOIN
                #__groups AS g
              ON
                g.id = c.access
             ".$this->_buildWhere()."
             ".$this->_buildOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for listing the categories
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildWhere()
  {
    $filtercat = JRequest::getInt('filter');

    $where = array();

    // Filter by type
    switch($filtercat)
    {
      // Published
      case 1:
        $where[] = 'published = 1';
        break;
      // Not published
      case 2:
        $where[] = 'published = 0';
        break;
      // User categories
      case 3:
        $where[] = 'owner != 0';
        break;
      // Administrator categories
      case 4:
        $where[] = 'owner = 0';
        break;
      default:
        break;
    }

    if($searchtext = JRequest::getString('search'))
    {
      $filter   = $this->_db->Quote('%'.$this->_db->getEscaped($searchtext, true).'%', false);
      $where[]  = "(c.name LIKE $filter OR c.description LIKE $filter)";
    }

    $where = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for listing the categories
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildOrderBy()
  {
    $sort = JRequest::getInt('sort');

    $sortorder  = '';
    switch($sort)
    {
      case 0:
        $sortorder = 'c.ordering ASC';
        break;
      /*case 1:
        $sortorder = 'c.ordering DESC';
        break;*/
      case 2:
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

    if($sortorder != '')
    {
      $orderby = 'ORDER BY '.$sortorder;
    }

    return $orderby;
  }

  /**
   * Retrieves the data of the categories
   *
   * @access  public
   * @return  array   Array of objects containing the categories data from the database
   * @since   1.5.5
   */
  function getCategories()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_categories))
    {
      jimport('joomla.filesystem.file');

      // Get the pagination request variables
      $limit      = JRequest::getVar('limit', 0, '', 'int');
      $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

      $query = $this->_buildQuery();

      if(!JRequest::getInt('sort') && !JRequest::getInt('filter') && JRequest::getString('search') == '')
      {
        $this->_categories = $this->_getList($query);

        $children = array();
        // First pass - collect children
        foreach($this->_categories as $v)
        {
          $pt   = $v->parent;
          $list = isset($children[$pt]) ? $children[$pt] : array();
          array_push($list, $v);
          $children[$pt] = $list;
        }
        // Second pass - get an indent list of the items
        $list = JHTML::_('joomgallery.treerecurse', 0, '', array(), $children);

        if(!$limit)
        {
          $limit = null;
        }

        // Slice out elements based on limits
        $this->_categories = array_slice($list, $limitstart, $limit);
      }
      else
      {
        $this->_categories = $this->_getList($query, $limitstart, $limit);
      }

      foreach($this->_categories as $row)
      {
        // TODO: Move the following into a function -> JHTML::_('joomgallery.thumbnail', $image, $cid, $height, $width);
        //       foreach in the model would be unnecessary then
        $row->imgsource = null;
        if($row->catimage)
        {
          //TODO: Allow catimage from sub-categories
          /*$query = "SELECT a.imgthumbname, a.catid
                      FROM #__joomgallery AS a
                    LEFT JOIN #__joomgallery_catg AS b
                      ON b.cmtpic = a.id
                    WHERE b.cmtid = ".$row->cmtid;
          $this->_db->setQuery($query);*/

          /*if($thumb = $this->_db->loadObject())
          {*/
            $file = $this->_ambit->getImg('thumb_path', $row->catimage, null, $row->cid);
            if(JFile::exists($file))
            {
              $imginfo        = getimagesize($file);
              $row->imgsource = $this->_ambit->getImg('thumb_url', $row->catimage, null, $row->cid);
              $row->imgwidth  = $imginfo[0];
              $row->imgheight = $imginfo[1];
            }
          /*}*/
        }
      }
    }

    return $this->_categories;
  }

  /**
   * Method to get the total number of categories
   *
   * @access  public
   * @return  int     The total number of categories
   * @since   1.5.5
   */
  function getTotal()
  {
    // Let's load the number of categories if it doesn't already exist
    if (empty($this->_total))
    {
      $query = $this->_buildQuery();
      $this->_total = $this->_getListCount($query);
    }

    return $this->_total;
  }

  /**
   * Method to delete one or more categories
   *
   * @access	public
   * @return	int     Number of successfully deleted categories, boolean false if an error occured
   * @since   1.5.5
   */
  function delete($recursion_level = 0)
  {
    if(!$recursion_level)
    {
      $this->_mainframe->setUserState('joom.categories.delete.categories', null);
      $this->_mainframe->setUserState('joom.categories.delete.images', null);
    }

    $cids = JRequest::getVar('cid', array(0), 'post', 'array');

    if(!count($cids))
    {
      $this->_mainframe->enqueueMessage(JText::_('JGA_COMMON_MSG_NO_CATEGORIES_SELECTED'));
      return false;
    }

    $row  = & $this->getTable('joomgallerycategories');

    $count = 0;
    $extant_images  = false;
    $extant_subcats = false;

    // Loop through selected categories
    foreach($cids as $cid)
    {
      // Database query to check assigned images to category
      $this->_db->setQuery("SELECT
                              id
                            FROM
                              "._JOOM_TABLE_IMAGES."
                            WHERE
                              catid = ".$cid);
      $images = $this->_db->loadResultArray();

      $continue = false;
      if(count($images))
      {
        $extant_images = true;

        $msg = JText::sprintf('JGA_CATMAN_MSG_CATEGORY_NOT_EMPTY_IMAGES', $cid);
        $this->_mainframe->enqueueMessage($msg, 'notice');
        $continue = true;

        $images_to_delete     = $this->_mainframe->getUserState('joom.categories.delete.images');
        $categories_to_delete = $this->_mainframe->getUserState('joom.maintenance.delete.categories');

        if($images_to_delete)
        {
          $this->_mainframe->setUserState('joom.categories.delete.images', array_merge($images_to_delete, $images));
        }
        else
        {
          $this->_mainframe->setUserState('joom.categories.delete.images', $images);
        }

        if(!$categories_to_delete)
        {
          $categories_to_delete = array(0 => array($cid));
        }
        $this->_mainframe->setUserState('joom.categories.delete.categories', $categories_to_delete);
      }

      // Are there any sub-category assigned?
      $this->_db->setQuery("SELECT
                              cid
                            FROM
                              "._JOOM_TABLE_CATEGORIES."
                            WHERE
                              parent = ".$cid);
      $categories = $this->_db->loadResultArray();
      if(count($categories))
      {
        $extant_subcats = true;

        $msg = JText::sprintf('JGA_CATMAN_MSG_CATEGORY_NOT_EMPTY_CATEGORIES', $cid);
        $this->_mainframe->enqueueMessage($msg, 'notice');
        $continue = true;

        $categories_to_delete = $this->_mainframe->getUserState('joom.categories.delete.categories');

        if($categories_to_delete)
        {
          if(isset($categories_to_delete[$recursion_level]))
          {
            $categories_to_delete[$recursion_level] = array_merge($categories_to_delete[$recursion_level], array($cid));
          }
          else
          {
            $categories_to_delete[$recursion_level] = array($cid);
          }

          if(isset($categories_to_delete[$recursion_level + 1]))
          {
            $categories_to_delete[$recursion_level + 1] = array_merge($categories_to_delete[$recursion_level + 1], $categories);
          }
          else
          {
            $categories_to_delete[$recursion_level + 1] = $categories;
          }
        }
        else
        {
          $categories_to_delete = array(0 => array($cid), 1 => $categories);
        }
        $this->_mainframe->setUserState('joom.categories.delete.categories', $categories_to_delete);

        // Next level
        JRequest::setVar('cid', $categories);
        $this->delete($recursion_level + 1);
      }

      if($continue || $recursion_level)
      {
        continue;
      }

      $catpath = JoomHelper::getCatPath($cid);
      if(!$this->_deleteFolders($catpath))
      {
        $this->setError(JText::_('JGA_CATMAN_MSG_ERROR_DELETING_DIRECTORIES'));
        return false;
      }

      $row->load($cid);
      if(!$row->delete())
      {
        $this->setError($row->getError());
        return false;
      }

      // Category successfully deleted
      $count++;
      $row->reorder('parent = '.$row->parent);
    }

    if(!$recursion_level && ($extant_images || $extant_subcats))
    {
      $images     = array();
      $img_count  = 0;
      $categories = array();
      $cat_count  = 0;

      $images = $this->_mainframe->getUserState('joom.categories.delete.images');
      if($images)
      {
        $img_count  = count($images);
      }

      if($extant_subcats)
      {
        $categories = $this->_mainframe->getUserState('joom.categories.delete.categories');
        foreach($categories as $level)
        {
          $cat_count += count($level);
        }
      }

      $msg  = '<br />'.JText::_('JGA_CATMAN_MSG_DELETECOMPLETELY');
      if($img_count)
      {
        if($img_count == 1)
        {
          $msg .= '<br />'.JText::_('JGA_CATMAN_MSG_DELETECOMPLETELY_IMAGES_NUMBER_1');
        }
        else
        {
          $msg .= '<br />'.JText::sprintf('JGA_CATMAN_MSG_DELETECOMPLETELY_IMAGES_NUMBER', $img_count);
        }
      }
      if($cat_count)
      {
        if($cat_count == 1)
        {
          $msg .= '<br />'.JText::_('JGA_CATMAN_MSG_DELETECOMPLETELY_CATEGORIES_NUMBER_1');
        }
        else
        {
          $msg .= '<br />'.JText::sprintf('JGA_CATMAN_MSG_DELETECOMPLETELY_CATEGORIES_NUMBER', $cat_count);
        }
      }
      $msg .= '<br /><p>
      <form action="index.php?option='._JOOM_OPTION.'&amp;controller=categories&amp;task=deletecompletely" method="post" onsubmit="if(!this.security_check.checked){return false;}">
        <span><input type="checkbox" name="security_check" value="1" /> <input type="submit" value="'.JText::_('JGA_CATMAN_MSG_DELETECOMPLETELY_BUTTON_LABEL').'" /></span>
      </form></p>';
      $this->_mainframe->enqueueMessage($msg, 'notice');
    }

    // Reset the user state variable 'catid' for filtering in images manager
    $this->_mainframe->setUserState('joom.images.catid', 0);

    return $count;
  }

  /**
   * Publishes/unpublishes or approves/rejects one or more categories
   *
   * @access  public
   * @param   array   $cid      An array of category IDs to work with
   * @param   int     $publish  1 for publishing and approving, 0 otherwise
   * @param   string  $task     'publish' for publishing/unpublishing, anything else otherwise
   * @return  int     The number of successfully edited categories, boolean false if an error occured
   * @since   1.5.5
   */
  function publish($cid, $publish = 1, $task = 'publish')
  {
    JArrayHelper::toInteger($cid);
    $cids = implode(',', $cid);

    $column = 'approved';
    if($task == 'publish')
    {
      $column = 'published';
    }

    $query = 'UPDATE
                '._JOOM_TABLE_CATEGORIES.'
              SET
                '.$column.' = '.(int) $publish.'
              WHERE
                cid IN ('.$cids.')';

    $this->_db->setQuery($query);
    if(!$this->_db->query())
    {
      return false;
    }

    return count($cid);
  }

  /**
   * Deletes folders of an existing category
   *
   * @access  protected
   * @param   string    $catpath  The catpath of the category
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _deleteFolders($catpath)
  {
    if(!$catpath)
    {
      return false;
    }

    $orig_path  = JPath::clean($this->_ambit->get('orig_path').$catpath);
    $img_path   = JPath::clean($this->_ambit->get('img_path').$catpath);
    $thumb_path = JPath::clean($this->_ambit->get('thumb_path').$catpath);

    // Delete the folder of the category for the original images
    if(!JFolder::delete($orig_path))
    {
      // If not successfull
      return false;
    }
    else
    {
      // Delete the folder of the category for the detail images
      if(!JFolder::delete($img_path))
      {
        // If not successful
        if(JFolder::create($orig_path))
        {
          JoomFile::copyIndexHtml($orig_path);
        }

        return false;
      }
      else
      {
        // Delete the folder of the category for the thumbnails
        if(!JFolder::delete($thumb_path))
        {
          // If not successful
          if(JFolder::create($orig_path))
          {
            JoomFile::copyIndexHtml($orig_path);
          }
          if(JFolder::create($img_path))
          {
            JoomFile::copyIndexHtml($img_path);
          }

          return false;
        }
      }
    }

    return true;
  }
}