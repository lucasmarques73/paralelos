<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/edit.php $
// $Id: edit.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery Edit Image model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelEdit extends JoomGalleryModel
{
  /**
   * Image ID
   *
   * @access  protected
   * @var     int
   */
  var $_id;

  /**
   * Image data object
   *
   * @access  protected
   * @var     object
   */
  var $_image;

  /**
   * Images number
   *
   * @var integer
   */
  var $_total = null;

  /**
   * Set to true if the current user is an administrator
   *
   * @access  protected
   * @var     boolean
   */
  var $_adminlogged = false;

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

    if($this->_user->get('gid') > 23)
    {
      $this->_adminlogged = true;
    }

    $array = JRequest::getVar('id',  0, '', 'array');
    // TODO: Check if we have a valid image and if the user is allowed to edit or delete this image
    $this->setId((int)$array[0]);
  }

  /**
   * Method to set the image identifier
   *
   * @access  public
   * @param   int     $id The image ID
   * @return  void
   * @since   1.5.5
   */
  function setId($id)
  {
    // Set new image ID if valid and wipe data
    if(!$id)
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=userpanel', false), JText::_('JGS_COMMON_NO_IMAGE_SPECIFIED'), 'notice');
    }
    $this->_id		= $id;
    $this->_image	= null;
  }

  /**
   * Method to get the image data
   *
   * @access  public
   * @return  object  Image data object
   * @since   1.5.5
   */
  function getImage()
  {
    if($this->_loadImage())
    {
      return $this->_image;
    }

    return false;
  }

  /**
   * Method to load the image data
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _loadImage()
  {
    if(empty($this->_image))
    {
      $row = $this->getTable('joomgalleryimages');

      if(!$row->load($this->_id))
      {
        $row->imgtitle      = $this->_mainframe->getUserStateFromRequest('joom.image.imgtitle',       'imgtitle');
        $row->imgtext       = $this->_mainframe->getUserStateFromRequest('joom.image.imgtext',        'imgtext');
        $row->imgauthor     = $this->_mainframe->getUserStateFromRequest('joom.image.imgauthor',      'imgauthor');
        $row->owner         = $this->_mainframe->getUserStateFromRequest('joom.image.owner',          'owner');
        $row->published     = $this->_mainframe->getUserStateFromRequest('joom.image.published',      'published', 1, 'int');
        $row->imgfilename   = $this->_mainframe->getUserStateFromRequest('joom.image.imgfilename',    'imgfilename');
        $row->imgthumbname  = $this->_mainframe->getUserStateFromRequest('joom.image.imgthumbname',   'imgthumbname');
        $row->catid         = $this->_mainframe->getUserStateFromRequest('joom.image.catid',          'catid', 0, 'int');
        $row->thumb_url     = null;
        //Source category for original and detail picture
        #$row->detail_catid  = $this->_mainframe->getUserStateFromRequest('joom.image.detail_catid',   'detail_catid', 0, 'int');
        //Source category for thumbnail
        #$row->thumb_catid   = $this->_mainframe->getUserStateFromRequest('joom.image.thumb_catid',    'thumb_catid', 0, 'int');
        #$row->copy_original = $this->_mainframe->getUserStateFromRequest('joom.image.copy_original',  'copy_original', 0, 'int');
      }
      else
      {
        $row->thumb_url = $this->_ambit->getImg('thumb_url', $row);
      }
  
      $this->_image = $row;
    }

    return true;
  }

  /**
   * Method to store an edited image
   *
   * @access	public
   * @return	boolean True on success
   * @since   1.5.5
   */
  function store($data = null)
  {
    $row = & $this->getTable('joomgalleryimages');

    if(is_null($data))
    {
      $data = JRequest::get('post', 4);
    }

    // Check whether it is a new category
    if($cid = intval($data['id']))
    {
      $isNew = false;

      // Load image data from the database
      $row->load($cid);

      // Read old category ID
      $catid_old  = $row->catid;
    }
    else
    {
      $isNew = true;
    }

    // Bind the form fields to the images table
    if(!$row->bind($data))
    {
      JError::raiseError(0, $row->getError());

      return false;
    }

    /*if($isNew)
    {
      // Make sure the record is valid
      if(!$row->check())
      {
        $this->setError($row->getError());

        return false;
      }

      //category path for destination category
      $catpath        = JoomHelper::getCatPath($row->catid);
      // source path original and detail
      $detail_catpath = JoomHelper::getCatPath($data['detail_catid']);
      // source path thumbnail
      $thumb_catpath  = JoomHelper::getCatPath($data['thumb_catid']);

      if(!$this->_newImage($row, $catpath, $detail_catpath, $thumb_catpath))
      {
        $this->setError(JText::_('Unable to create new images'));

        return false;
      }

      // Store the entry to the database in order to get the new ID
      if(!$row->store())
      {
        JError::raiseError(0, $row->getError());

        return false;
      }

      //successfully stored new image
      $row->reorder('catid = '.$row->catid);

      return $row->id;
    }
*/
    /*//clear votes if "clear" checked
    if($data['clearPicVotes'])
    {
      $row->imgvotes = 0;
      $row->imgvotesum = 0;
      // delete votes for picture
      $query = "DELETE FROM #__joomgallery_votes WHERE picid = ".$row->id;
      $this->_db->setQuery($query);
      if(!$this->_db->query())
      {
        JError::raiseError(0, $row->getError());

        return false;
      }
    }
*/
    if(isset($catid_old) && $catid_old != $row->catid)
    {
      // TODO: security check: Is the new category available for the user and is it valid, e.g. no empty string?
      //       if no -> store image in the old category but leave a message
      //       ($this->_mainframe->enqueueMessage(JText::('JGS_bla'), 'notice');)
      if(!$this->moveImage($row, $row->catid, $catid_old))
      {
        JError::raiseWarning(100, JText::_('JGS_EDITIMAGE_MSG_COULD_NOT_MOVE_IMAGE'));

        return false;
      }
    }
    else
    {
      if(!$row->store())
      {
          JError::raiseError(100, $row->getError());

          return false;
      }
    }

    // Successfully stored image (and moved)
    $row->reorder('catid = '.$row->catid);
    if(isset($catid_old) && $catid_old != $row->catid)
    {
      $row->reorder('catid = '.$catid_old);
    }

    return $row->id;
  }

  /**
   * Method to delete an image
   *
   * @access	public
   * @return	boolean	True on success
   * @since   1.5.5
   */
  function delete()
  {
    jimport('joomla.filesystem.file');

    $row  = & $this->getTable('joomgalleryimages');

    $row->load($this->_id);

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
    // in same category assigned to it
    if(!$thumb_count)
    {
      $thumb = $this->_ambit->getImg('thumb_path', $row);
      if(!JFile::delete($thumb))
      {
        // If thumbnail is not deleteable raise an error message and abort
        JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_THUMB', $thumb));
        return false;
      }
    }

    // Delete the detail if there are no other detail and
    // original images from same category assigned to it
    if(!$img_count)
    {
      $img = $this->_ambit->getImg('img_path', $row);
      if(!JFile::delete($img))
      {
        // If detail is not deleteable raise an error message and abort
        JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_IMAGE', $img));
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
          JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_ORIG', $orig));
          return false;
        }
      }
    }

    // Delete the corresponding database entries of the comments
    $this->_db->setQuery("DELETE
                            FROM
                              "._JOOM_TABLE_COMMENTS."
                            WHERE
                              cmtpic = ".$this->_id
                        );
    if(!$this->_db->query())
    {
      JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_COMMENTS', $this->_id));
    }

    // Delete the corresponding database entries of the name tags
    $this->_db->setQuery("DELETE
                          FROM
                            "._JOOM_TABLE_NAMESHIELDS."
                          WHERE
                            npicid = ".$this->_id
                        );
    if(!$this->_db->query()) 
    {
      JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_NAMETAGS', $this->_id));
    }

    // Delete the database entry of the image
    if(!$row->delete())
    {
      JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_DELETE_IMAGE_DATA', $this->_id));
      return false;
    }

    // Image successfully deleted
    $row->reorder('catid = '.$row->catid);

    return true;
  }

  /**
   * Moves image into another category
   *
   * @access  public
   * @return  boolean True on success, false otherwise
   * @since   1.5.5
   */
  function moveImage(&$item, $catid_new, $catid_old = 0)
  {
    jimport('joomla.filesystem.file');

    // If we just have the image ID
    if(!is_object($item))
    {
      $id = intval($item);
      $item = $this->getTable('joomgalleryimages');
      $item->load($id);
      $catid_old = $item->catid;
    }

    // Get source category
    $cat = $this->getTable('joomgallerycategories');
    $cat->load($item->id);

    $catpath_old  = JoomHelper::getCatPath($catid_old);
    $catpath_new  = JoomHelper::getCatPath($catid_new);

    // Database query to check if there are other images which this
    // thumbnail is assigned to and how many of them exist
    $query = "SELECT
                COUNT(id)
              FROM
                "._JOOM_TABLE_IMAGES."
              WHERE
                    imgthumbname  = '".$item->imgthumbname."'
                AND id           != ".$item->id."
                AND catid         = ".$catid_old;

    $this->_db->setQuery($query);
    $thumb_count = $this->_db->loadResult();

    // Check if thumbnail already exists in source directory and
    // if it doesn't already exist in destination directory.
    // If that's the case the file will not be copied.
    if(
        JFile::exists($this->_ambit->get('thumb_path').$catpath_old.$item->imgthumbname)
      &&
        !JFile::exists($this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname)
       )
    {
      // If there is no image remaining in source directory
      // which uses the file
      if(!$thumb_count)
      {
        // Move the thumbnail
        $result = JFile::move($this->_ambit->get('thumb_path').$catpath_old.$item->imgthumbname,
                              $this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname);
      }
      else
      {
        // Otherwise just copy the thumbnail in order that it remains in the source directory
        $result = JFile::copy($this->_ambit->get('thumb_path').$catpath_old.$this->imgthumbname,
                              $this->_ambit->get('thumb_path').$catpath_new.$this->imgthumbname);
      }
      // If not successful raise an error message and abort
      if(!$result)
      {
        JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_MOVE_THUMB', JPath::clean($this->_ambit->get('thumb_path').$catpath_new.$this->imgthumbname)));
        return false;
      }
      // Set control variable according to the successful move/copy procedure
      $thumb_created = true;
    }
    else
    {
      // Not successful
      $thumb = false;
    }

    // Same procedure with the detail image
    // In case of error roll previous copy/move procedure back
    $query = "SELECT
                COUNT(id)
              FROM
                "._JOOM_TABLE_IMAGES."
              WHERE
                    imgfilename = '".$item->imgfilename."'
                AND id         != ".$item->id."
                AND catid       = ".$catid_old;

    $this->_db->setQuery($query);
    $img_count = $this->_db->loadResult();
    $imgsource  = $this->_ambit->get('img_path').$catpath_old.$item->imgfilename;
    $imgdest    = $this->_ambit->get('img_path').$catpath_new.$item->imgfilename;
    if((JFile::exists($imgsource)) && (!JFile::exists($imgdest)))
    {
      if(!$img_count)
      {
        $result = JFile::move($imgsource, $imgdest);
      }
      else
      {
        $result = JFile::copy($imgsource, $imgdest);
      }
      if(!$result)
      {
        if($thumb_created)
        {
          if(!$thumb_count)
          {
            JFile::move($this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname,
                        $this->_ambit->get('thumb_path').$catpath_old.$item->imgthumbname);
          }
          else
          {
            JFile::delete($this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname);
          }
        }
        JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_MOVE_IMGAGE', JPath::clean($this->_ambit->get('img_path').$catpath_new.$this->imgthumbname)));
        return false;
      }
      $img_created = true;
    }
    else
    {
      $img_created = false;
    }

    // Go on with original image
    if(
        JFile::exists($this->_ambit->get('orig_path').$catpath_old.$item->imgfilename)
      &&
        !JFile::exists($this->_ambit->get('orig_path').$catpath_new.$item->imgfilename)
       )
    {
      if(!$img_count)
      {
        $result = JFile::move($this->_ambit->get('orig_path').$catpath_old.$item->imgfilename,
                              $this->_ambit->get('orig_path').$catpath_new.$item->imgfilename);
      } else {
        $result = JFile::copy($this->_ambit->get('orig_path').$catpath_old.$item->imgfilename,
                              $this->_ambit->get('orig_path').$catpath_new.$item->imgfilename);
      }
      if(!$result)
      {
        if($thumb_created)
        {
          if(!$thumb_count)
          {
            JFile::move($this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname,
                        $this->_ambit->get('thumb_path').$catpath_old.$item->imgthumbname);
          }
          else
          {
            JFile::delete($this->_ambit->get('thumb_path').$catpath_new.$item->imgthumbname);
          }
        }
        if($img_created)
        {
          if(!$img_count)
          {
            JFile::move($this->_ambit->get('img_path').$catpath_new.$item->imgfilename,
                        $this->_ambit->get('img_path').$catpath_old.$item->imgfilename);
          }
          else
          {
            JFile::delete($this->_ambit->get('img_path').$catpath_new.$item->imgfilename);
          }
        }
        JError::raiseWarning(100, JText::sprintf('JGS_EDITIMAGE_MSG_COULD_NOT_MOVE_ORIG', JPath::clean($this->_ambit->get('orig_path').$catpath_new.$item->imgthumbname)));
        return false;
      }
    }
    // If all folder operations for the image were successful
    // modify the database entry
    $item->catid    = $catid_new;
    $item->ordering = $item->getNextOrder('catid = '.$catid_new);

    // Make sure the record is valid
    if(!$item->check())
    {
      $this->setError($item->getError());
      return false;
    }

    if(!$item->store())
    {
      JError::raiseError(0, $row->getError());
      return false;
    }

    return true;
  }

  /**
   * Returns true if the current user is an administrator
   *
   * @access  public
   * @return  boolean True if the current user is an administrator, false otherwise
   * @since   1.5.5
   */
  function getAdminLogged()
  {
    return $this->_adminlogged;
  }
}