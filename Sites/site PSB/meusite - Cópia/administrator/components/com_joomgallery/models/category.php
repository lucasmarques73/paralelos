<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/category.php $
// $Id: category.php 2566 2010-11-03 21:10:42Z mab $
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
 * Category model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelCategory extends JoomGalleryModel
{
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

    $array = JRequest::getVar('cid',  0, '', 'array');
    $this->setId((int)$array[0]);
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
    // Set id and wipe data
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
  function &getData()
  {
    $row = $this->getTable('joomgallerycategories');
    $row->load($this->_id);

    $this->_data = $row;

    return $row;
  }

  /**
   * Method to store a category
   *
   * @access  public
   * @return  int     The ID of the category, boolean false if an error occured
   * @since   1.5.5
   */
  function store()
  {
    $row = & $this->getTable('joomgallerycategories');

    // Get all necessary data from the post
    $data     = JRequest::get('post', 4);
    $details  = JRequest::getVar('details', array(), 'post', 'array');
    $metadata = JRequest::getVar('meta', array(), 'post', 'array');

    // Check whether it is a new category
    if($cid = intval($data['cid']))
    {
      $isNew = false;

      // Read category from the database
      $row->load($cid);

      // Read old category name
      $catname_old  = $row->name;
      // Read old parent assignment
      $parent_old   = $row->parent;
    }
    else
    {
      $isNew = true;
    }

    // Bind the form fields to the category table
    if(!$row->bind($data))
    {
      JError::raiseError(0, $row->getError());
      return false;
    }
    if(!$row->bind($details))
    {
      JError::raiseError(0, $row->getError());
      return false;
    }
    if(!$row->bind($metadata))
    {
      JError::raiseError(0, $row->getError());
      return false;
    }

    if($isNew)
    {
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
        $this->setError(JText::_('JGA_CATMAN_MSG_ERROR_CREATING_FOLDERS'));
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

      // Move folders, only if the catpath has changed
      if($catpath_old != $catpath && !$this->_moveFolders($catpath_old, $catpath))
      {
        $this->setError(JText::_('JGA_CATMAN_MSG_ERROR_MOVING_FOLDERS'));
        return false;
      }

      // Update catpath in the database
      $row->catpath = $catpath;

      // Modify catpath of all sub-categories in the database
      $this->updateNewCatpath($row->cid, $catpath_old, $catpath);
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
    if(isset($parent_old) && $parent_old != $row->parent)
    {
      $row->reorder('parent = '.$parent_old);
    }
    return $row->cid;
  }

  /**
   * Retrieves the data for creating the orderings drop down list
   *
   * @access  public
   * @return  array   An array of the ordering numbers and the category names
   * @since   1.5.5
   */
  function getOrderings()
  {
    if(empty($this->_orderings))
    {
      $query = "SELECT
                  parent,
                  ordering,
                  name
                FROM
                  "._JOOM_TABLE_CATEGORIES."
                ORDER BY
                  ordering";
      $this->_db->setQuery($query);
 
      if(!$orders = $this->_db->loadObjectList())
      {
        $this->setError($this->_db->getError());
        return array();
      }
 
      $orderings  = array();
 
      for($i = 0, $n = count($orders); $i < $n; $i++)
      {
        $ord = 1;
        if(array_key_exists($orders[$i]->parent, $orderings))
        {
          $ord = count(array_keys($orderings[$orders[$i]->parent]));
        }
        else
        {
          // Add entry for 'First'
          $orderings[$orders[$i]->parent][] = JHTML::_('select.option', 0, '0::'.JText::_('FIRST'));
        }
        $orderings[$orders[$i]->parent][] = JHTML::_('select.option', $ord, $ord.'::'.addslashes($orders[$i]->name));
      }
      // Add entry for 'Last'
      foreach($orderings as $key => $ordering)
      {
        $ord = count(array_keys($orderings[$key]));
        $orderings[$key][] = JHTML::_('select.option', $ord, $ord.'::'.JText::_('LAST'));
      }
 
      $this->_orderings = $orderings;
    }
 
    return $this->_orderings;
  }

  /**
   * Update of category path in the database for sub-categories
   * if a parent category has been moved or the name has changed.
   *
   * Recursive call to each level of depth.
   *
   * @access  public
   * @param   string  $catids_values  ID(s) of the categories to update (comma separated)
   * @param   string  $oldpath        Former relative category path
   * @param   string  $newpath        New relative category path
   * @return  void
   * @since   1.0.0
   */
  function updateNewCatpath($catids_values, &$oldpath, &$newpath)
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

      // Replace former category path with new one
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
    $this->updateNewCatpath($catids_values, $oldpath, $newpath);
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
}