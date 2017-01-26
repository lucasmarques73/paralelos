<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/maintenancecheck.php $
// $Id: maintenancecheck.php 2566 2010-11-03 21:10:42Z mab $
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
 * Maintenance check model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelMaintenancecheck extends JoomGalleryModel
{
  /**
   * Images data array
   *
   * @access  protected
   * @var     array
   */
  var $_images;

  /**
   * Categories data array
   *
   * @access  protected
   * @var     array
   */
  var $_categories;

  /**
   * Users data array
   *
   * @access  protected
   * @var     array
   */
  var $_users;

  /**
   * Searches for inconsitencies in the database tables
   * and the filesystem of JoomGallery and stores them
   * in two database tables.
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function check()
  {
    $test = new stdClass();
    jimport('joomla.filesystem.file');
    $session = &JFactory::getSession();

    require_once(JPATH_COMPONENT.DS.'helpers'.DS.'refresher.php');

    $refresher = new JoomRefresher(array('name' => 'Initializing'));

    $folders_temp_file    = $this->_ambit->get('temp_path').'folders_temp';
    $files_temp_file      = $this->_ambit->get('temp_path').'files_temp';
    $categories_temp_file = $this->_ambit->get('temp_path').'categories_temp';
    $images_temp_file     = $this->_ambit->get('temp_path').'images_temp';

    $task = $this->_mainframe->getUserState('joom.maintenance.task');
    if(is_null($task))
    {
      $query = "DELETE
                FROM
                  "._JOOM_TABLE_MAINTENANCE;
      $this->_db->setQuery($query);
      $this->_db->query();

      $query = "DELETE
                FROM
                  "._JOOM_TABLE_ORPHANS;
      $this->_db->setQuery($query);
      $this->_db->query();

      $query = "ALTER TABLE
                  "._JOOM_TABLE_MAINTENANCE."
                AUTO_INCREMENT = 1";
      $this->_db->setQuery($query);
      $this->_db->query();


      $query = "ALTER TABLE
                  "._JOOM_TABLE_ORPHANS."
                AUTO_INCREMENT = 1";
      $this->_db->setQuery($query);
      $this->_db->query();

      if(JFile::exists($folders_temp_file))
      {
        JFile::delete($folders_temp_file);
      }
      if(JFile::exists($files_temp_file))
      {
        JFile::delete($files_temp_file);
      }
      if(JFile::exists($categories_temp_file))
      {
        JFile::delete($categories_temp_file);
      }
      if(JFile::exists($images_temp_file))
      {
        JFile::delete($images_temp_file);
      }
    }

    $folders = null;
    if(JFile::exists($folders_temp_file))
    {
      //$folders  = unserialize($this->_mainframe->getUserState('joom.maintenance.folders'));
      $folders = unserialize(JFile::read($folders_temp_file));
      //JFile::delete('testtesttest');
    }

    if(   $task != 'check_categories'
      &&  $task != 'search_orphaned_folders'
      &&  $task != 'store_categories'
      &&  $task != 'load_files'
      &&  $task != 'check_images'
      &&  $task != 'search_orphans'
      &&  $task != 'store_images'
      &&  (is_null($folders) || $folders === false)
      )
    {
      $folders['thumb'] = JFolder::folders(rtrim($this->_ambit->get('thumb_path'), DS), '.', true, true);
      $folders['img']   = JFolder::folders(rtrim($this->_ambit->get('img_path'), DS), '.', true, true);
      $folders['orig']  = JFolder::folders(rtrim($this->_ambit->get('orig_path'), DS), '.', true, true);

      //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
      JFile::write($folders_temp_file, serialize($folders));

      if(!$refresher->check())
      {
        $this->_mainframe->setUserState('joom.maintenance.task', 'load_folders');
        $refresher->refresh();
      }
    }
      //$foldes['thumb'] = JFolder::folders(rtrim($this->_ambit->get('thumb_path'), DS), '.', true, true);
      //$this->_ambit->get('thumb_path');
      //$foldes['thumb'] = JFolder::folders(rtrim($this->_ambit->get('thumb_path'), DS), '.', true, true);
      //$foldes['img']   = JFolder::folders(rtrim($this->_ambit->get('img_path'), DS), '.', true, true);
      //$foldes['orig']  = JFolder::folders(rtrim($this->_ambit->get('orig_path'), DS), '.', true, true);

    $query = $this->_buildCheckCategoriesQuery();
    $this->_db->setQuery($query);
    $this->_categories = $this->_db->loadObjectList('cid');

    $refresher->reset(null, null, 'Check Categories');

    $users = $this->getUsers();

    $types = array('thumb', 'img', 'orig');

    if(   $task != 'search_orphaned_folders'
      &&  $task != 'store_categories'
      &&  $task != 'load_files'
      &&  $task != 'check_images'
      &&  $task != 'search_orphans'
      &&  $task != 'store_images'
      )
    {
      $start = ($task == 'check_categories') ? false : true;
      $refresher->reset(count($this->_categories), $start, 'Check Categories');

      //$categories = unserialize($this->_mainframe->getUserState('joom.maintenance.categories'));
      $categories = null;
      if(JFile::exists($categories_temp_file))
      {
        $categories = unserialize(JFile::read($categories_temp_file));
      }
      if(is_null($categories) || $categories === false)
      {
        $categories = array();
      }

      $count = 0;
      foreach($this->_categories as $key => &$row)
      {
        $categories[$key]->corrupt = false;

        foreach($types as $type)
        {
          $categories[$key]->$type = false;
          
          $folder = JPath::clean($this->_ambit->get($type.'_path').rtrim(JoomHelper::getCatPath($row->cid), '/'));
          if(JFolder::exists($folder))
          {
            $categories[$key]->$type  = $folder;
            $folder_key               = array_search($folder, $folders[$type]);
            if($folder_key !== false)
            {
              unset($folders[$type][$folder_key]);
            }
          }
          else
          {
            $categories[$key]->corrupt   = true;
          }
        }

        if($row->owner && !isset($users[$row->owner]))
        {
          $categories[$key]->owner       = -1;
          $categories[$key]->corrupt     = true;
        }
        else
        {
          $categories[$key]->owner = $row->owner;
        }

        $categories[$key]->refid  = $key;
        $categories[$key]->catid  = $row->parent;
        $categories[$key]->title  = $row->name;

        // TODO: Check for valid parent category
        /*if(!array_key_exists($row->catid, $this->categories))
        {
          $row->catid   = -1;
          $row->corrupt = true;
        }*/

        $count++;

        if(!$refresher->check())
        {
          $this->_mainframe->setUserState('joom.maintenance.task', 'check_categories');
          $this->_mainframe->setUserState('joom.maintenance.catkey', $key);
          //$this->_mainframe->setUserState('joom.maintenance.categories', serialize($categories));
          JFile::write($categories_temp_file, serialize($categories));
          //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
          JFile::write($folders_temp_file, serialize($folders));
          $refresher->refresh(count($this->_categories) - $count);
        }
      }

      //$this->_mainframe->setUserState('joom.maintenance.categories', serialize($categories));
      JFile::write($categories_temp_file, serialize($categories));
      $this->_mainframe->setUserState('joom.maintenance.catkey', null);
    }

    $refresher->reset(null, null, 'Search Orphaned Folders');

    if(   $task != 'store_categories'
      &&  $task != 'load_files'
      &&  $task != 'check_images'
      &&  $task != 'search_orphans'
      &&  $task != 'store_images'
      )
    {
      //$categories = unserialize($this->_mainframe->getUserState('joom.maintenance.categories'));
      $categories = null;
      if(JFile::exists($categories_temp_file))
      {
        $categories = unserialize(JFile::read($categories_temp_file));
      }
      if(is_null($categories) || $categories === false)
      {
        $categories = array();
      }

      $type = $this->_mainframe->getUserState('joom.maintenance.type');

      if($type == 'img')
      {
        $types = array('img', 'orig');
      }
      else
      {
        if($type == 'orig')
        {
          $types = array('orig');
        }
      }

      foreach($types as $type)
      {
        foreach($folders[$type] as $folder_key => $folder)
        {
          $suggestion = false;

          $query = $this->_buildCheckCategoriesQuery();
          $this->_db->setQuery($query);
          $this->_categories = $this->_db->loadObjectList('cid');

          $start = ($this->_mainframe->getUserState('joom.maintenance.task') == 'search_orphaned_folders') ? false : true;
          $refresher->reset(count($this->_categories) * count($folders['thumb']) * count($types), $start, 'Search Orphaned Folders');

          foreach($this->_categories as $key => &$category)
          {
            $folder_name = explode('_', $folder);
            if($category->cid == $folder_name[count($folder_name) - 1])
            {
              $suggestion = array('id' => $category->cid, 'name' => $category->name);
              break;
            }

            if(!$refresher->check())
            {
              $this->_mainframe->setUserState('joom.maintenance.task', 'search_orphaned_folders');
              $this->_mainframe->setUserState('joom.maintenance.catkey', $key);
              $this->_mainframe->setUserState('joom.maintenance.type', $type);
              //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
              JFile::write($folders_temp_file, serialize($folders));
              //$this->_mainframe->setUserState('joom.maintenance.categories', serialize($categories));
              JFile::write($categories_temp_file, serialize($categories));
              $refresher->refresh(count($this->_categories) * count($folders['thumb']) * count($types));
            }
          }

          $orphan = array('fullpath' => $folder, 'type' => 'folder');
          if($suggestion)
          {
            $orphan['refid']  =  $suggestion['id'];
            $orphan['title']  =  $suggestion['name'];
          }

          $orphans  = &$this->getTable('joomgalleryorphans');

          $orphans->bind($orphan);

          $orphans->id    = 0;

          $orphans->check();
          $orphans->store();

          // Map orphaned folder and category
          if($suggestion)
          {
            $orphan_column = $type.'orphan';
            $categories[$suggestion['id']]->$orphan_column = $orphans->id;
          }

          unset($folders[$type][$folder_key]);
        }
      }

      unset($folders);

      //$this->_mainframe->setUserState('joom.maintenance.categories', serialize($categories));
      JFile::write($categories_temp_file, serialize($categories));
    }

    $refresher->reset(null, null, 'Store Categories');

    if(   $task != 'load_files'
      &&  $task != 'check_images'
      &&  $task != 'search_orphans'
      &&  $task != 'store_images'
      )
    {
      //$categories = unserialize($this->_mainframe->getUserState('joom.maintenance.categories'));
      $categories = null;
      if(JFile::exists($categories_temp_file))
      {
        $categories = unserialize(JFile::read($categories_temp_file));
      }
      if(is_null($categories) || $categories === false)
      {
        $categories = array();
      }

      $start = ($task == 'store_categories') ? false : true;
      $refresher->reset(count($categories), $start, 'Store Categories');

      $row = &$this->getTable('joomgallerymaintenance');

      foreach($categories as $key => $category)
      {
        if($category->corrupt)
        {
          $row->type        = 1;
          $row->thumborphan = 0;
          $row->imgorphan   = 0;
          $row->origorphan  = 0;

          $row->bind($category);

          $row->id    = 0;

          $row->check();
          $row->store();
        }

        unset($categories[$key]);

        if(!$refresher->check())
        {
          $this->_mainframe->setUserState('joom.maintenance.task', 'store_categories');
          //$this->_mainframe->setUserState('joom.maintenance.categories', serialize($categories));
          JFile::write($categories_temp_file, serialize($categories));
          //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
          JFile::write($folders_temp_file, serialize($folders));
          $refresher->refresh(count($categories));
        }
      }

      unset($categories);
    }

    $this->_mainframe->setUserState('joom.maintenance.catkey', null);
    //$this->_mainframe->setUserState('joom.maintenance.categories', null);
    JFile::delete($categories_temp_file);

    //$files  = unserialize($this->_mainframe->getUserState('joom.maintenance.files'));
    $files = null;
    if(JFile::exists($files_temp_file))
    {
      $files = unserialize(JFile::read($files_temp_file));
      //JFile::delete('bilder');
    }

    $refresher->reset(null, null, 'Loading Files');

    if(   $task != 'check_images'
      &&  $task != 'search_orphans'
      &&  $task != 'store_images'
      &&  (is_null($files) || $files === false)
      )
    {
      $files['thumb'] = JFolder::files($this->_ambit->get('thumb_path'), '.', true, true);
      $files['img']   = JFolder::files($this->_ambit->get('img_path'), '.', true, true);
      $files['orig']  = JFolder::files($this->_ambit->get('orig_path'), '.', true, true);

      //$this->_mainframe->setUserState('joom.maintenance.files', serialize($files));
      JFile::write($files_temp_file, serialize($files));

      if(!$refresher->check())
      {
        $this->_mainframe->setUserState('joom.maintenance.task', 'load_files');
          //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
          //JFile::write($folders_temp_file, serialize($folders));
        $refresher->refresh();
      }
    }

    $query = $this->_buildCheckQuery();
    $this->_db->setQuery($query);
    $this->_images = $this->_db->loadObjectList('id');

    $refresher->reset(null, null, 'Check Images');

    $types = array('thumb', 'img', 'orig');

    if($task != 'search_orphans' && $task != 'store_images')
    {
      $start = ($task == 'check_images') ? false : true;
      $refresher->reset(count($this->_images), $start, 'Check Images');

      $images = null;
      if(JFile::exists($images_temp_file))
      {
        //$images = unserialize($this->_mainframe->getUserState('joom.maintenance.images'));
        $images = unserialize(JFile::read($images_temp_file));
      }
      if(is_null($images) || $images === false)
      {
        $images = array();
      }

      $count = 0;
      foreach($this->_images as $key => &$row)
      {
        $images[$key]->corrupt = false;

        foreach($types as $type)
        {
          $images[$key]->$type = false;
          $file = $this->_ambit->getImg($type.'_path', $row);
          if(JFile::exists($file))
          {
            $images[$key]->$type  = $this->_ambit->getImg($type.'_url', $row);
            $file_key                  = array_search($file, $files[$type]);
            if($file_key !== false)
            {
              unset($files[$type][$file_key]);
            }
          }
          else
          {
            /*if($type != 'orig')
            {
              $row->corrupt = true;
            }*/

            // At the moment, images without original files are treated as corrupt, too.
            $images[$key]->corrupt   = true;
          }
        }

        if($row->owner && !isset($users[$row->owner]))
        {
          $images[$key]->owner       = -1;
          $images[$key]->corrupt     = true;
        }
        else
        {
          $images[$key]->owner = $row->owner;
        }

        $images[$key]->refid  = $key;
        $images[$key]->catid  = $row->catid;
        $images[$key]->title  = $row->imgtitle;

        // TODO: Check for valid category
        /*if(!in_array($row->catid, $this->categories))
        {
          $row->catid       = 0;
          $row->corrupt     = true;
        }*/

        $count++;

        if(!$refresher->check())
        {
          $this->_mainframe->setUserState('joom.maintenance.task', 'check_images');
          $this->_mainframe->setUserState('joom.maintenance.imgkey', $key);
          //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
          //JFile::write('testtesttest', serialize($folders));
          //$this->_mainframe->setUserState('joom.maintenance.images', serialize($images));
          JFile::write($images_temp_file, serialize($images));
                  //$this->_mainframe->setUserState('joom.maintenance.files', serialize($files));
                  JFile::write($files_temp_file, serialize($files));
          $refresher->refresh(count($this->_images) - $count);
        }
      }

      //$this->_mainframe->setUserState('joom.maintenance.images', serialize($images));
      JFile::write($images_temp_file, serialize($images));
    }

    $refresher->reset(null, null, 'Search Orphans');

    if($task != 'store_images')
    {
      //$images = unserialize($this->_mainframe->getUserState('joom.maintenance.images'));
      $images = null;
      if(JFile::exists($images_temp_file))
      {
        //////$images = unserialize($this->_mainframe->getUserState('joom.maintenance.images'));
        $images = unserialize(JFile::read($images_temp_file));
      }
      if(is_null($images) || $images === false)
      {
        $images = array();
      }


      $type = $this->_mainframe->getUserState('joom.maintenance.type');
      if($type == 'img')
      {
        $types = array('img', 'orig');
      }
      else
      {
        if($type == 'orig')
        {
          $types = array('orig');
        }
      }

      $img_types = array('gif', 'jpg', 'png', 'jpeg', 'jpe');

      foreach($types as $type)
      {
        foreach($files[$type] as $file_key => $file)
        {
          if(!strpos($file, 'index.html'))
          {
            $suggestion = false;

            if(in_array(JFile::getExt($file), $img_types))
            {
              $query = $this->_buildCheckQuery();
              $this->_db->setQuery($query);
              $this->_images = $this->_db->loadObjectList('id');

              foreach($this->_images as $key => &$image)
              {
                if($type == 'thumb')
                {
                  if($image->imgthumbname == basename($file))
                  {
                    $suggestion = array('id' => $image->id, 'imgtitle' => $image->imgtitle);
                    break;
                  }
                }
                else
                {
                  if($image->imgfilename == basename($file))
                  {
                    $suggestion = array('id' => $image->id, 'imgtitle' => $image->imgtitle);
                    break;
                  }
                }

                if(!$refresher->check())
                {
                  $this->_mainframe->setUserState('joom.maintenance.task', 'search_orphans');
                  $this->_mainframe->setUserState('joom.maintenance.imgkey', $key);
                  $this->_mainframe->setUserState('joom.maintenance.type', $type);
          //$this->_mainframe->setUserState('joom.maintenance.folders', serialize($folders));
          JFile::write($folders_temp_file, serialize($folders));
                  //$this->_mainframe->setUserState('joom.maintenance.files', serialize($files));
                  JFile::write($files_temp_file, serialize($files));
                  //$this->_mainframe->setUserState('joom.maintenance.images', serialize($images));
                  JFile::write($images_temp_file, serialize($images));
                  $refresher->refresh();
                }
              }
            }
            else
            {
              $type = 'unknown';
            }

            $orphan = array('fullpath' => $file, 'type' => $type);
            if($suggestion)
            {
              $orphan['refid']  =  $suggestion['id'];
              $orphan['title']  =  $suggestion['imgtitle'];
            }

            $orphans  = &$this->getTable('joomgalleryorphans');

            $orphans->bind($orphan);

            $orphans->id    = 0;

            $orphans->check();
            $orphans->store();

            // Map orphan and image
            if($suggestion)
            {
              $orphan_column = $type.'orphan';
              $images[$suggestion['id']]->$orphan_column = $orphans->id;
            }
          }

          unset($files[$type][$file_key]);
        }
      }

      //$this->_mainframe->setUserState('joom.maintenance.images', serialize($images));
      JFile::write($images_temp_file, serialize($images));
    }

    //$images = unserialize($this->_mainframe->getUserState('joom.maintenance.images'));
    $images = null;
    if(JFile::exists($images_temp_file))
    {
      //$images = unserialize($this->_mainframe->getUserState('joom.maintenance.images'));
      $images = unserialize(JFile::read($images_temp_file));
    }
    if(is_null($images) || $images === false)
    {
      $images = array();
    }


    $row = &$this->getTable('joomgallerymaintenance');

    $start = ($this->_mainframe->getUserState('joom.maintenance.task') == 'store_images') ? false : true;
    $refresher->reset(count($images), $start, 'Store Images');

    foreach($images as $key => $image)
    {
      if($image->corrupt)
      {
        $row->thumborphan = 0;
        $row->imgorphan   = 0;
        $row->origorphan  = 0;

        $row->bind($image);

        $row->id    = 0;

        $row->check();
        $row->store();
      }

      unset($images[$key]);

      if(!$refresher->check())
      {
        $this->_mainframe->setUserState('joom.maintenance.task', 'store_images');
        //$this->_mainframe->setUserState('joom.maintenance.images', serialize($images));
        JFile::write($images_temp_file, serialize($images));
        $refresher->refresh(count($images));
      }
    }

    $this->_mainframe->setUserState('joom.maintenance.task', null);
    $this->_mainframe->setUserState('joom.maintenance.catkey', null);
    $this->_mainframe->setUserState('joom.maintenance.imgkey', null);
    $this->_mainframe->setUserState('joom.maintenance.type', null);
    //$this->_mainframe->setUserState('joom.maintenance.files', null);
    JFile::delete($files_temp_file);
    //$this->_mainframe->setUserState('joom.maintenance.images', null);
    JFile::delete($images_temp_file);
    //$this->_mainframe->setUserState('joom.maintenance.folders', null);
    JFile::delete($folders_temp_file);
    //$this->_mainframe->setUserState('joom.maintenance.categories', null);
    JFile::delete($categories_temp_file);
    $this->_mainframe->setUserState('joom.maintenance.checked', time());
    $refresher->reset(null, null, 'Finalizing');
    $refresher->refresh(null, 'display');
  }

  /**
   * Method to get all users which are currently registered
   *
   * @access  public
   * @return  array   An array of users
   * @since   1.5.5
   */
  function getUsers()
  {
    if(empty($this->_users))
    {
      $and = '';
  		/*if(false)
      {
  		  // Does not include registered users in the list
  			$and = 'AND gid > 18';
  		}*/
  
  		$this->_db->setQuery("SELECT
                              id,
                              name
  		                      FROM
                              #__users
  		                      WHERE
                                  block = 0
                              ".$and
                          );
  		$this->_users = $this->_db->loadObjectList('id');
  	}

    return $this->_users;
  }

  /**
   * Returns the query for loading all images for the 'check' function
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the images data from the database
   * @since   1.5.5
   */
  function _buildCheckQuery()
  {
    $query = "SELECT
                id,
                catid,
                imgtitle,
                imgfilename,
                imgthumbname,
                owner
              FROM
                "._JOOM_TABLE_IMAGES."
              ".$this->_buildCheckWhere()."
              ".$this->_buildCheckOrderby();

    return $query;
  }

  /**
   * Returns the query for loading all categories for the 'check' function
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the categories data from the database
   * @since   1.5.5
   */
  function _buildCheckCategoriesQuery()
  {
    $query = "SELECT
                cid,
                parent,
                name,
                owner
              FROM
                "._JOOM_TABLE_CATEGORIES."
              ".$this->_buildCheckCategoriesWhere()."
              ".$this->_buildCheckCategoriesOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for loading all images for the 'check' function
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildCheckWhere()
  {
    $where = '';

    $key = $this->_mainframe->getUserState('joom.maintenance.imgkey');

    if(!is_null($key))
    {
      $where = 'WHERE id > '.$key;
    }

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for loading all images for the 'check' function
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildCheckOrderBy()
  {
    $orderby = 'ORDER BY id ASC';

    return $orderby;
  }

  /**
   * Returns the 'where' part of the query for loading all categories for the 'check' function
   *
   * @access  protected
   * @return  string    The 'where' part of the query
   * @since   1.5.5
   */
  function _buildCheckCategoriesWhere()
  {
    $where = '';

    $key = $this->_mainframe->getUserState('joom.maintenance.catkey');

    if(!is_null($key))
    {
      $where = 'WHERE cid > '.$key;
    }

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for loading all categories for the 'check' function
   *
   * @access  protected
   * @return  string    The 'order by' part of the query
   * @since   1.5.5
   */
  function _buildCheckCategoriesOrderBy()
  {
    $orderby = 'ORDER BY cid ASC';

    return $orderby;
  }
}