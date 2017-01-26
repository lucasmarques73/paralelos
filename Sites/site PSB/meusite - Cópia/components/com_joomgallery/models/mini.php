<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/mini.php $
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

class JoomGalleryModelMini extends JoomGalleryModel
{
  /**
   * Categories data array
   *
   * @var array
   */
  var $_images;

  /**
   * Categories number
   *
   * @var integer
   */
  #var $_total = null;

  /**
   * Returns the query
   * @return string The query to be used to retrieve the rows from the database
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
   * Returns the 'where' part of the query
   * @return string The 'where' part of the query
   */
  function _buildWhere()
  {
    $catid = $this->_mainframe->getUserStateFromRequest('joom.mini.catid', 'catid', 0, 'int');

    $where = array();

    // ensure that image can be seen later on
    $where[] = 'jgc.published = 1';
    $where[] = 'jgc.access <= '.$this->_user->get('aid');
    $where[] = 'jg.published = 1';
    $where[] = 'jg.approved = 1';
    if($catid)
    {
      $where[] = 'jg.catid = '.$catid;
    }

    $where = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    return $where;
  }

  /**
   * Returns the 'order by' part of the query
   * @return string The 'order by' part of the query
   */
  /*function _buildOrderBy()
  {
    $orderby = '';

    return $orderby;
  }*/

  /**
   * Retrieves the comments data
   * @return array Array of objects containing the data from the database
   */
  function getImages()
  {
    // Lets load the data if it doesn't already exist
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
   * Method to get the total number of categories
   *
   * @access public
   * @return integer
   */
  function getTotalImages()
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
   * Method to delete record(s)
   *
   * @access	public
   * @return	boolean	True on success
   */
  /*function delete()
  {
    $cids = JRequest::getVar('cid', array(0), 'post', 'array');

    $row  = & $this->getTable('joomgalleryimages');

    if(!count($cids))
    {
      $this->_mainframe->enqueueMessage(JText::_('No entries selected'));
      return false;
    }

    $count = 0;

    //loop through selected categories
    foreach($cids as $cid)
    {
      //database query to check assigned pictures to category
      $this->_db->setQuery("SELECT COUNT(id)
          FROM #__joomgallery
          WHERE catid = ".$cid);
      $is_not_empty = $this->_db->loadResult();

      $continue = false;
      if($is_not_empty)
      {
        $msg = JText::sprintf('The Category with the id %d contains still images', $cid);
        $this->_mainframe->enqueueMessage($msg, 'notice');
        $continue = true;
      }

      //database query: are there any subcategory assigned?
      $this->_db->setQuery("SELECT COUNT(cid)
          FROM #__joomgallery_catg
          WHERE parent = '$cid'");
      $is_parentcat = $this->_db->loadResult();
      if($is_parentcat)
      {
        $msg = JText::sprintf('The Category with the id %d contains still sub-categories', $cid);
        $this->_mainframe->enqueueMessage($msg, 'notice');
        $continue = true;
      }

      if($continue)
      {
        continue;
      }

      $catpath = JoomHelper::getCatPath($cid);
      if(!$this->_deleteFolders($catpath))
      {
        $this->setError(JText::_('Unable to delete directories'));
        return false;
      }

      $row = & $this->getTable('joomgallerycategories');
      if(!$row->delete($cid))
      {
        $this->setError($row->getError());
        return false;
      }

      //category successfully deleted
      $count++;
      $row->reorder('parent = '.$row->parent);
    }

    //delete the userstate variable 'catid' if exists
    $this->_mainframe->setUserState('joom.images.catid', 0);

    return $count;
  }*/

  /**
  * Publishes or Unpublishes one or more records
  */
  /*function publish($cid, $publish = 1, $task = 'publish')
  {
    JArrayHelper::toInteger($cid);
    $cids = implode(',', $cid);

    $column = 'approved';
    if($task == 'publish')
    {
      $column = 'published';
    }

    $query = 'UPDATE #__joomgallery'
    . ' SET '.$column.' = ' . (int) $publish
    . ' WHERE id IN ( '. $cids .' )'
    ;
    $this->_db->setQuery($query);
    if(!$this->_db->query())
    {
      return false;
    }

    return count($cid);
  }*/
}
