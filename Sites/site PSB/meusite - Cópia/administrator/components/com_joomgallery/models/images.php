<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/images.php $
// $Id: images.php 2566 2010-11-03 21:10:42Z mab $
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
 * Images model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelImages extends JoomGalleryModel
{
  /**
   * Images data array
   *
   * @access  protected
   * @var     array
   */
  var $_images;

  /**
   * Images number
   *
   * @access  protected
   * @var     int
   */
  var $_total = null;

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
      jimport('joomla.filesystem.file');

      // Get the pagination request variables
      $limit      = JRequest::getVar('limit', 0, '', 'int');
      $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

      $query = $this->_buildQuery();
      $this->_images = $this->_getList($query, $limitstart, $limit);

      foreach($this->_images as $row)
      {
        // TODO: Move the following into a function -> JHTML::_('joomgallery.thumbnail', $image, $cid, $height, $width);
        //       foreach in the model would be unnecessary then
        $row->imgsource = null;
        #if($row->catimage)
        #{
          $file = $this->_ambit->getImg('thumb_path', $row);
          if(JFile::exists($file))
          {
            $imginfo        = getimagesize($file);
            $row->imgsource = $this->_ambit->getImg('thumb_url', $row);
            $row->imgwidth  = $imginfo[0];
            $row->imgheight = $imginfo[1];
          }
        /*}*/
      }
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
  function getTotal()
  {
    // Let's load the total number of images if it doesn't already exist
    if(empty($this->_total))
    {
      $query = $this->_buildQuery();
      $this->_total = $this->_getListCount($query);
    }

    return $this->_total;
  }

  /**
   * Method to delete one or more images
   *
   * @access	public
   * @return	int     Number of successfully deleted images, boolean false if an error occured
   * @since   1.5.5
   */
  function delete()
  {
    jimport('joomla.filesystem.file');

    $cids = JRequest::getVar('cid', array(), 'post', 'array');

    $row  = & $this->getTable('joomgalleryimages');

    if(!count($cids))
    {
      $this->setError(JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'));
      return false;
    }

    $count = 0;

    // Loop through selected images
    foreach($cids as $cid)
    {
      $row->load($cid);

      // Database query to check if there are other images which this
      // thumbnail is assigned to and how many of them exist
      $this->_db->setQuery("SELECT
                              COUNT(id)
                            FROM
                              "._JOOM_TABLE_IMAGES."
                            WHERE
                                  imgthumbname = '".$row->imgthumbname."'
                              AND id          != ".$row->id."
                              AND catid        = ".$row->catid
                          );
      $thumb_count = $this->_db->loadResult();

      // Database query to check if there are other images which this
      // detail image is assigned to and how many of them exist
      $this->_db->setQuery("SELECT
                              COUNT(id)
                            FROM
                              "._JOOM_TABLE_IMAGES."
                            WHERE
                                  imgfilename = '".$row->imgfilename."'
                              AND id         != ".$row->id."
                              AND catid       = ".$row->catid
                          );
      $img_count = $this->_db->loadResult();

      // Delete the thumbnail if there are no other images
      // in the same category assigned to it
      if(!$thumb_count)
      {
        $thumb = $this->_ambit->getImg('thumb_path', $row);
        if(!JFile::delete($thumb))
        {
          // If thumbnail is not deleteable raise an error message and abort
          JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_COULD_NOT_DELETE_THUMB', $thumb));
          return false;
        }
      }

      // Delete the detail image if there are no other detail and
      // original images from the same category assigned to it
      if(!$img_count)
      {
        $img = $this->_ambit->getImg('img_path', $row);
        if(!JFile::delete($img))
        {
          // If detail image is not deleteable raise an error message and abort
          JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_COULD_NOT_DELETE_IMG', $img));
          return false;
        }
        // Original exists?
        $orig = $this->_ambit->getImg('orig_path', $row);
        if(JFile::exists($orig))
        {
          // Delete it
          if(!JFile::delete($orig))
          {
            // If original is not deleteable raise an error message and abort
            JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_COULD_NOT_DELETE_ORIG', $orig));
            return false;
          }
        }
      }

      // Delete the corresponding database entries of the comments
      $this->_db->setQuery("DELETE
                            FROM
                              "._JOOM_TABLE_COMMENTS."
                            WHERE
                              cmtpic = ".$cid
                          );
      if(!$this->_db->query())
      {
        JError::raiseWarning(100, JText::sprintf('JGA_MAIMAN_MSG_NOT_DELETE_COMMENTS', $cid));
      }

      // Delete the corresponding database entries of the name tags
      $this->_db->setQuery("DELETE
                            FROM
                              "._JOOM_TABLE_NAMESHIELDS."
                            WHERE
                              npicid = ".$cid
                          );
      if(!$this->_db->query())
      {
        JError::raiseWarning(100, JText::sprintf('JGA_MAIMAN_MSG_NOT_DELETE_NAMETAGS', $cid));
      }

      // Delete the database entry of the image
      if(!$row->delete())
      {
        JError::raiseWarning(100, JText::sprintf('JGA_MAIMAN_MSG_NOT_DELETE_IMAGE_DATA', $cid));
        return false;
      }

      // Image successfully deleted
      $count++;
      $row->reorder('catid = '.$row->catid);
    }

    return $count;
  }

  /**
   * Publishes/unpublishes or approves/rejects one or more images
   *
   * @access  public
   * @param   array   $cid      An array of image IDs to work with
   * @param   int     $publish  1 for publishing and approving, 0 otherwise
   * @param   string  $task     'publish' for publishing/unpublishing, anything else otherwise
   * @return  int     The number of successfully edited images, boolean false if an error occured
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

    $query = "UPDATE
                "._JOOM_TABLE_IMAGES."
              SET
                ".$column." = ".(int) $publish."
              WHERE
                id IN (".$cids.")";

    $this->_db->setQuery($query);
    if(!$this->_db->query())
    {
      $this->setError($this->_db->getErrorMsg());
      return false;
    }

    return count($cid);
  }

  /**
   * Recreates thumbnails of the selected images.
   * If original image is existent, detail image will be recreated, too.
   *
   * @access  public
   * @return  array   An array of result information (thumbnail number, detail image number, array with information which image types have been recreated)
   * @since   1.5.5
   */
  function recreate()
  {
    jimport('joomla.filesystem.file');

    $cids         = $this->_mainframe->getUserStateFromRequest('joom.recreate.cids', 'cid', array(), 'array');
    $type         = $this->_mainframe->getUserStateFromRequest('joom.recreate.type', 'type', '', 'cmd');
    $thumb_count  = $this->_mainframe->getUserState('joom.recreate.thumbcount');
    $img_count    = $this->_mainframe->getUserState('joom.recreate.imgcount');
    $recreated    = $this->_mainframe->getUserState('joom.recreate.recreated');

    $row  = & $this->getTable('joomgalleryimages');

    // Before first loop check for selected images
    if(is_null($thumb_count) && !count($cids))
    {
      $this->setError(JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'));
      return array(false);
    }

    if(is_null($recreated))
    {
      $recreated = array();
    }

    require_once JPATH_COMPONENT.DS.'helpers'.DS.'refresher.php';

    $refresher = new JoomRefresher(array('controller' => 'images', 'task' => 'recreate', 'remaining' => count($cids), 'start' => JRequest::getBool('cid')));

    $debugoutput = '';

    // Loop through selected images
    foreach($cids as $key => $cid)
    {
      $row->load($cid);

      $orig   = $this->_ambit->getImg('orig_path', $row);
      $img    = $this->_ambit->getImg('img_path', $row);
      $thumb  = $this->_ambit->getImg('thumb_path', $row);

      // Check if there is an original image
      if(JFile::exists($orig))
      {
        $orig_existent = true;
      }
      else
      {
        // If not, use detail image to create thumbnail
        $orig_existent = false;
        if(JFile::exists($img))
        {
          $orig = $img;
        }
        else
        {
          JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_IMAGE_NOT_EXISTENT', $img));
          $this->_mainframe->setUserState('joom.recreate.cids', array());
          $this->_mainframe->setUserState('joom.recreate.imgcount', null);
          $this->_mainframe->setUserState('joom.recreate.thumbcount', null);
          $this->_mainframe->setUserState('joom.recreate.recreated', null);
          return false;
        }
      }

      // Recreate thumbnail
      if(!$type || $type == 'thumb')
      {
        // TODO: Move image into a trash instead of deleting immediately for possible rollback
        if(JFile::exists($thumb))
        {
          JFile::delete($thumb);
        }
        $return = JoomFile::resizeImage($debugoutput,
                                        $orig,
                                        $thumb,
                                        $this->_config->get('jg_useforresizedirection'),
                                        $this->_config->get('jg_thumbwidth'),
                                        $this->_config->get('jg_thumbheight'),
                                        $this->_config->get('jg_thumbcreation'),
                                        $this->_config->get('jg_thumbquality'),
                                        false,
                                        $this->_config->get('jg_cropposition')
                                        );
        if(!$return)
        {
          JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_COULD_NOT_CREATE_THUMB', $thumb));
          $this->_mainframe->setUserState('joom.recreate.cids', array());
          $this->_mainframe->setUserState('joom.recreate.thumbcount', null);
          $this->_mainframe->setUserState('joom.recreate.imgcount', null);
          $this->_mainframe->setUserState('joom.recreate.recreated', null);
          return false;
        }

        $this->_mainframe->enqueueMessage(JText::sprintf('JGA_IMGMAN_MSG_SUCCESSFULLY_CREATED_THUMB', $row->id, $row->imgtitle));
        $recreated[$cid][] = 'thumb';
        $thumb_count++;
      }

      // Recreate detail image if original image is existent
      if($orig_existent && (!$type || $type == 'img'))
      {
        // TODO: Move image into a trash instead of deleting immediately for possible rollback
        if(JFile::exists($img))
        {
          JFile::delete($img);
        }
        $return = JoomFile::resizeImage($debugoutput,
                                        $orig,
                                        $img,
                                        false,
                                        $this->_config->get('jg_maxwidth'),
                                        false,
                                        $this->_config->get('jg_thumbcreation'),
                                        $this->_config->get('jg_picturequality'),
                                        true,
                                        0
                                        );
        if(!$return)
        {
          JError::raiseWarning(100, JText::sprintf('JGA_IMGMAN_MSG_COULD_NOT_CREATE_IMG', $img));
          $this->_mainframe->setUserState('joom.recreate.cids', array());
          $this->_mainframe->setUserState('joom.recreate.thumbcount', null);
          $this->_mainframe->setUserState('joom.recreate.imgcount', null);
          $this->_mainframe->setUserState('joom.recreate.recreated', null);
          return false;
        }

        $this->_mainframe->enqueueMessage(JText::sprintf('JGA_IMGMAN_MSG_SUCCESSFULLY_CREATED_IMG', $row->id, $row->imgtitle));
        $recreated[$cid][] = 'img';
        $img_count++;
      }

      unset($cids[$key]);

      // Check remaining time
      if(!$refresher->check())
      {
        $this->_mainframe->setUserState('joom.recreate.cids', $cids);
        $this->_mainframe->setUserState('joom.recreate.thumbcount', $thumb_count);
        $this->_mainframe->setUserState('joom.recreate.imgcount', $img_count);
        $this->_mainframe->setUserState('joom.recreate.recreated', $recreated);
        $refresher->refresh(count($cids));
      }
    }

    $this->_mainframe->setUserState('joom.recreate.cids', array());
    $this->_mainframe->setUserState('joom.recreate.type', null);
    $this->_mainframe->setUserState('joom.recreate.thumbcount', null);
    $this->_mainframe->setUserState('joom.recreate.imgcount', null);
    $this->_mainframe->setUserState('joom.recreate.recreated', null);
    return array($thumb_count, $img_count, $recreated);
  }

  /**
   * Returns the query for listing the images
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the images data from the database
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
                g.id = c.access
             ".$this->_buildWhere()."
             ".$this->_buildOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for listing the images
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildWhere()
  {
    $filter     = JRequest::getInt('filter');
    $catid      = JRequest::getInt('catid');
    $searchtext = JRequest::getString('search');

    $where = array();

    if($catid)
    {
      $where[]   = 'catid = '.$catid;
    }

    // Filter by type
    switch($filter)
    {
      case 1:
        $where[]   = 'a.approved = 0';
        break;
      case 2:
        $where[]   = 'a.approved = 1';
        break;
      case 3:
        $where[]   = 'a.useruploaded = 1';
        break;
      case 4:
        $where[]   = 'a.useruploaded = 0';
        break;
      default:
        break;
    }

    if($searchtext)
    {
      $filter   = $this->_db->Quote('%'.$this->_db->getEscaped($searchtext, true).'%', false);
      $where[]  = "(LOWER(a.imgtitle) LIKE $filter OR LOWER(a.imgtext) LIKE $filter)";
    }

    $where = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for listing the images
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildOrderBy()
  {
    $ordering = JRequest::getInt('ordering');

    $sortorder  = '';
    if(!$ordering)
    {
      $sortorder = 'a.catid ASC, a.ordering ASC, imgdate DESC, imgtitle DESC';
    }
    else
    {
      $sortorder = 'a.catid ASC, a.ordering DESC, imgdate DESC, imgtitle DESC';
    }

    if ($sortorder != ''){
      $orderby = 'ORDER BY '.$sortorder;
    }

    return $orderby;
  }
}