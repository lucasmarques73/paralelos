<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/editcategory.php $
// $Id: editcategory.php 2616 2010-12-17 20:22:31Z chraneco $
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
 * JoomGallery Edit Category model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelEditcategory extends JoomGalleryModel
{
  /**
   * Category ID
   *
   * @access  protected
   * @var     int
   */
  var $_id;

  /**
   * Holds the category data
   *
   * @access  protected
   * @var     object
   */
  var $_category;

  /**
   * Thumbnail file names
   *
   * @access  protected
   * @var     array
   */
  var $_thumbnails;

  /**
   * Holds the data of the existing user groups
   *
   * @access  protected
   * @var     array
   */
  var $_groups;

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

    $array = JRequest::getVar('catid',  0, '', 'array');
    // TODO: Check if we have a valid category and if the user is allowed to edit or delete this category
    $this->setId((int)$array[0]);
  }

  /**
   * Method to set the category ID and wipe data
   *
   * @access  public
   * @param   int     $id Category ID
   * @return  void
   * @since   1.5.5
   */
  function setId($id)
  {
    // Set ID and wipe data
    $this->_id		    = $id;
    $this->_category	= null;
  }

  /**
   * Retrieves the category data
   *
   * @access  public
   * @return  object  Holds the category data from the database
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
   * Retrieves the thumbnail file names
   *
   * @access  public
   * @return  array   Hold the thumbnail file names
   * @since   1.5.5
   */
  function getThumbnails()
  {
    if($this->_loadThumbnails())
    {
      return $this->_thumbnails;
    }

    return array();
  }

  /**
   * Retrieves the available user groups
   *
   * @access  public
   * @return  array   An array of objects containing the data of the user groups
   * @since   1.5.5
   */
  function getGroups()
  {
    if($this->_loadGroups())
    {
      return $this->_groups;
    }

    return array();
  }

  /**
   * Return true if the current user is an administrator
   *
   * @access  public
   * @return  boolean True, if the current user is an administrator
   * @since   1.5.5
   */
  function getAdminLogged()
  {
    return $this->_adminlogged;
  }

  /**
   * Method to store a category
   *
   * @TODO: Security checks -> valid parent category? User allowed to edit category?
   *
   * @access  public
   * @return  int     Category ID on success, boolean false otherwise
   * @since   1.5.5
   */
  function store()
  {
    $row = &$this->getTable('joomgallerycategories');

    $data = JRequest::get('post', 4);

    // Check whether it is a new category
    if($cid = intval($data['cid']))
    {
      $isNew = false;

      // Load category from the database
      $row->load($cid);

      // Read old category name
      $catname_old  = $row->name;
      // Read old parent assignment
      $parent_old   = $row->parent;
    }
    else
    {
      $isNew = true;

      $this->_db->setQuery("SELECT 
                              COUNT(cid)
                            FROM 
                              "._JOOM_TABLE_CATEGORIES."
                            WHERE 
                              owner = ".$this->_user->get('id')." 
                          ");
      $count = $this->_db->loadResult();
      if($count >= $this->_config->get('jg_maxusercat'))
      {
        $this->_mainframe->redirect(JRoute::_('index.php?view=usercategories', false), JText::_('You are not allowed to create more user categories'), 'notice');
      }
    }

    // Bind the form fields to the category table
    if(!$row->bind($data))
    {
      JError::raiseError(0, $row->getError());
      return false;
    }

    if($isNew)
    {
      // Set the owner of the category
      $row->owner = $this->_user->get('id');

      // Make sure the record is valid
      if(!$row->check())
      {
        $this->setError($row->getError());
        return false;
      }

      // Store the entry to the database in order to get the new ID
      if(!$row->store())
      {
        JError::raiseError(0, $row->getError());
        return false;
      }

      JFilterOutput::objectHTMLSafe($row->name);
      $catpath = JoomFile::fixFilename($row->name).'_'.$row->cid;

      if($row->parent)
      {
        $parent_catpath = JoomHelper::getCatPath($row->parent);
        $catpath        = $parent_catpath . $catpath;
      }

      if(!$this->_createFolders($catpath))
      {
        $this->setError(JText::_('Unable to create folders'));
        return false;
      }
      else
      {
        $row->catpath = $catpath;

        // Make sure the record is valid
        if(!$row->check())
        {
          $this->setError($row->getError());
          return false;
        }

        // Store the entry to the database
        if(!$row->store())
        {
          JError::raiseError(0, $row->getError());
          return false;
        }
      }

      // New category successfully created
      $row->reorder('parent = '.$row->parent);
      return $row->cid;
    }

    // Move the category folder, if parent assignment or category name changed
    if($parent_old != $row->parent || $catname_old != $row->name)
    {
      // Save old path
      $catpath_old    = $row->catpath;

      // Make the new category title safe
      JFilterOutput::objectHTMLSafe($row->name);

      $catpath = JoomFile::fixFilename($row->name).'_'.$row->cid;
      if($row->parent)
      {
        $parent_catpath = JoomHelper::getCatPath($row->parent);
        $catpath        = $parent_catpath . $catpath;
      }

      // Create folders
      if(!$this->_moveFolders($catpath_old, $catpath))
      {
        $this->setError(JText::_('Unable to move folders'));
        return false;
      }

      // Update catpath in the database
      $row->catpath = $catpath;

      // Modify catpath of all sub-categories in the database
      $this->_updateNewCatpath($row->cid, $catpath_old, $catpath);
    }

    // Make sure the record is valid
    if(!$row->check())
    {
      $this->setError($row->getError());
      return false;
    }

    // Store the entry to the database
    if(!$row->store())
    {
      JError::raiseError(0, $row->getError());
      return false;
    }

    // Category successfully saved (and moved)
    $row->reorder('parent = '.$row->parent);
    if(isset($parent_old) AND $parent_old != $row->parent)
    {
      $row->reorder('parent = '.$parent_old);
    }

    return $row->cid;
  }

  /**
   * Method to delete one or more categories
   *
   * @access	public
   * @return	boolean	True on success, false otherwise
   * @since   1.5.5
   */
  function delete()
  {
    // Database query to check assigned images to category
    $this->_db->setQuery("SELECT
                            COUNT(id)
                          FROM
                            "._JOOM_TABLE_IMAGES."
                          WHERE
                            catid = ".$this->_id
                        );
    if($this->_db->loadResult())
    {
      $msg = JText::sprintf('The Category with the id %d contains still images', $this->_id);
      $this->setError($msg);
      return false;
    }

    // Database query to check whether there are any sub-categories assigned
    $this->_db->setQuery("SELECT
                            COUNT(cid)
                          FROM
                            "._JOOM_TABLE_CATEGORIES."
                          WHERE
                            parent = ".$this->_id
                        );
    if($this->_db->loadResult())
    {
      $msg = JText::sprintf('The Category with the id %d contains still sub-categories', $this->_id);
      $this->setError($msg);
      return false;
    }

    $catpath = JoomHelper::getCatPath($this->_id);
    if(!$this->_deleteFolders($catpath))
    {
      $this->setError(JText::_('Unable to delete directories'));
      return false;
    }

    $row = & $this->getTable('joomgallerycategories');
    if(!$row->delete($this->_id))
    {
      $this->setError($row->getError());
      return false;
    }

    // Category successfully deleted
    $row->reorder('parent = '.$row->parent);

    return true;
  }

  /**
   * Loads the category data
   *
   * @access  protected
   * @return  boolean   True
   * @since   1.5.5
   */
  function _loadCategory()
  {
    if(empty($this->_category))
    {
      $row = $this->getTable('joomgallerycategories');

      if($row->load($this->_id))
      {
        $row->catpath       = JoomHelper::getCatPath($this->_id);

        if($row->catimage)
        {
          $row->catimage_src = $this->_ambit->getImg('thumb_url', $row->catimage, null, $this->_id);
        }
        else
        {
          $row->catimage_src = 'images/blank.png';
        }

        /*$row->imgtitle      = $this->_mainframe->getUserStateFromRequest('joom.image.imgtitle',       'imgtitle');
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
        $row->thumb_url = $this->_ambit->getImg('thumb_url', $row);*/
      }
  
      $this->_category = $row;
    }

    return true;
  }

  /**
   * Loads the file names of all thumbnails of the
   * approved images of the current category
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _loadThumbnails()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_thumbnails))
    {
      $this->_db->setQuery("SELECT
                              imgthumbname
                            FROM
                              "._JOOM_TABLE_IMAGES."
                            WHERE
                                     catid = ".$this->_id."
                              AND approved = 1
                            ORDER BY
                              imgthumbname
                          ");
      if(!$array = $this->_db->loadResultArray())
      {
        return false;
      }

      $this->_thumbnails = $array;
    }

    return true;
  }

  /**
   * Loads the name and the ID of all user groups
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5   
   */
  function _loadGroups()
  {
    // Let's load the data if it doesn't already exist
    if(empty($this->_groups))
    {
      // TODO: What to do if we are in Joomla 1.6?
      $query = "SELECT 
                  id AS value, 
                  name AS text 
                FROM
                  #__groups";

      // If Admin logged all levels will be displayed
      if(!$this->get('AdminLogged') && $this->_id)
      {
        if(empty($this->_category))
        {
          // TODO: What to do if _loadCategory returns false?
          $this->_loadCategory();
        }

        // Read parent category
        $parent = & JTable::getInstance('joomgallerycategories', 'Table');
        $parent->load($this->_category->parent);
        $query .= "
                WHERE
                      id >= ".$parent->access."
                  AND id <= ".$this->_user->get('aid');
      }

      $query .= "
                ORDER BY id";

      $this->_db->setQuery($query);

      if(!$rows = $this->_db->loadObjectList())
      {
        return false;
      }

      $this->_groups = $rows;
    }

    return true;
  }

  /**
   * Update of category path in the database for sub-categories
   * if a parent category has been moved or the name has changed.
   *
   * Recursive call to each level of depth.
   *
   * @access  protected
   * @param   string  $catids_values  ID(s) of the categories to update (comma separated)
   * @param   string  $oldpath        Former relative category path
   * @param   string  $newpath        New relative category path
   * @return  void
   * @since   1.0.0
   */
  function _updateNewCatpath($catids_values, &$oldpath, &$newpath)
  {
    // Query for sub-categories with parent in $catids_values
    $this->_db->setQuery("SELECT
                            cid
                          FROM
                            "._JOOM_TABLE_CATEGORIES."
                          WHERE
                            parent IN ($catids_values)
                        ");

    $subcatids = $this->_db->loadResultArray();

    if($this->_db->getErrorNum())
    {
      JError::raiseWarning(500, $this->_db->getErrorMsg());
    }

    // Nothing found, return
    if(!count($subcatids))
    {
      return;
    }

    $row = & JTable::getInstance('joomgallerycategories', 'Table');
    foreach($subcatids as $subcatid)
    {
      $row->load($subcatid);
      $catpath = $row->catpath;

      // Replace former category path with the new one
      $catpath = str_replace($oldpath.'/', $newpath.'/', $catpath);

      // Then save it
      $row->catpath = $catpath;
      if(!$row->store())
      {
        JError::raiseError(500, $row->getError());
      }
    }

    // Split the array in comma separated string
    $catids_values = implode (',', $subcatids);

    // Call again with sub-categories as parent
    $this->_updateNewCatpath($catids_values, $oldpath, $newpath);
  }

  /**
   * Creates the folders for a category
   *
   * @access  protected
   * @param   string    The category path for the category
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _createFolders($catpath)
  {
    $catpath = JPath::clean($catpath);

    // Create the folder of the category for the original images
    if(!JFolder::create($this->_ambit->get('orig_path').$catpath))
    {
      // If not successfull
      return false;
    }
    else
    {
      // Copy an index.html file into the new folder
      JoomFile::copyIndexHtml($this->_ambit->get('orig_path').$catpath);

      // Create the folder of the category for the detail images
      if(!JFolder::create($this->_ambit->get('img_path').$catpath))
      {
        // If not successful
        JFolder::delete($this->_ambit->get('orig_path').$catpath);
        return false;
      }
      else
      {
        // Copy an index.html file into the new folder
        JoomFile::copyIndexHtml($this->_ambit->get('img_path').$catpath);

        // Create the folder of the category for the thumbnails
        if(!JFolder::create($this->_ambit->get('thumb_path').$catpath))
        {
          // If not successful
          JFolder::delete($this->_ambit->get('orig_path').$catpath);
          JFolder::delete($this->_ambit->get('img_path').$catpath);
          return false;
        }
        else
        {
          // Copy an index.html file into the new folder
          JoomFile::copyIndexHtml($this->_ambit->get('thumb_path').$catpath);
        }
      }
    }

    return true;
  }

  /**
   * Moves folders of an existing category
   *
   * @access  protected
   * @param   string    $src  The source category path
   * @param   string    $dest The destination category path
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _moveFolders($src, $dest)
  {
    $orig_src   = JPath::clean($this->_ambit->get('orig_path').$src);
    $orig_dest  = JPath::clean($this->_ambit->get('orig_path').$dest);
    $img_src    = JPath::clean($this->_ambit->get('img_path').$src);
    $img_dest   = JPath::clean($this->_ambit->get('img_path').$dest);
    $thumb_src  = JPath::clean($this->_ambit->get('thumb_path').$src);
    $thumb_dest = JPath::clean($this->_ambit->get('thumb_path').$dest);

    // Move the folder of the category for the original images
    $return = JFolder::move($orig_src, $orig_dest);
    if($return !== true)
    {
      // If not successfull
      JError::raiseWarning(100, $return);
      return false;
    }
    else
    {
      // Move the folder of the category for the detail images
      $return = JFolder::move($img_src, $img_dest);
      if($return !== true)
      {
        // If not successful
        JFolder::move($orig_dest, $orig_src);
        JError::raiseWarning(100, $return);
        return false;
      }
      else
      {
        // Move the folder of the category for the thumbnails
        $return = JFolder::move($thumb_src, $thumb_dest);
        if($return !== true)
        {
          // If not successful
          JFolder::move($orig_dest, $orig_src);
          JFolder::move($img_dest, $img_src);
          JError::raiseWarning(100, $return);
          return false;
        }
      }
    }

    return true;
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