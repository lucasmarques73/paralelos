<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/controllers/images.php $
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
 * JoomGallery Images Controller
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryControllerImages extends JoomGalleryController
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

    // Set view
    JRequest::setVar('view', 'images');

    // Register tasks
    $this->registerTask('new',              'edit');
    $this->registerTask('apply',            'save');
    $this->registerTask('unpublish',        'publish');
    $this->registerTask('reject',           'approve');
    $this->registerTask('accesspublic',     'access');
    $this->registerTask('accessregistered', 'access');
    $this->registerTask('accessspecial',    'access');
    $this->registerTask('orderup',          'order');
    $this->registerTask('orderdown',        'order');

    // Submenu
    /* TODO */
  }

  /**
   * Publishes or unpublishes one or more images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function publish()
  {
    // Initialize variables
    $cid      = JRequest::getVar('cid', array(), 'post', 'array');
    $task     = JRequest::getCmd('task');
    $publish  = ($task == 'publish');

    if(empty($cid))
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'));
      $this->redirect();
    }

    $model = $this->getModel('images');
    if($count = $model->publish($cid, $publish))
    {
      if($count != 1)
      {
        $msg = JText::sprintf($publish ? 'JGA_IMGMAN_MSG_IMAGES_PUBLISHED' : 'JGA_IMGMAN_MSG_IMAGES_UNPUBLISHED', $count);
      }
      else
      {
        $msg = JText::_($publish ? 'JGA_IMGMAN_MSG_IMAGE_PUBLISHED' : 'JGA_IMGMAN_MSG_IMAGE_UNPUBLISHED');
      }
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg);
    }
    else
    {
      $msg = JText::_('JGA_COMMON_MSG_ERROR_PUBLISHING_UNPUBLISHING');
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, 'error');
    }
  }

  /**
   * Approves or rejects one or more images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function approve()
  {
    // Initialize variables
    $cid      = JRequest::getVar('cid', array(), 'post', 'array');
    $task     = JRequest::getCmd('task');
    $publish  = ($task == 'approve');

    if(empty($cid))
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'));
      $this->redirect();
    }

    $model = $this->getModel('images');
    if($count = $model->publish($cid, $publish, 'approve'))
    {
      if($count != 1)
      {
        $msg = JText::sprintf($publish ? 'JGA_IMGMAN_MSG_IMAGES_APPROVED' : 'JGA_IMGMAN_MSG_IMAGES_REJECTED', $count);
      }
      else
      {
        $msg = JText::_($publish ? 'JGA_IMGMAN_MSG_IMAGE_APPROVED' : 'JGA_IMGMAN_MSG_IMAGE_REJECTED');
      }
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg);
    }
    else
    {
      $msg = JText::_('JGA_COMMON_MSG_ERROR_APPROVING_REJECTING');
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, 'error');
    }
  }

  /**
   * Removes one or more images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function remove()
  {
    $model = $this->getModel('images');
    if(!$count = $model->delete())
    {
      $msg  = $model->getError();
      $type = 'error';
    }
    else
    {
      $type = 'message';
      if($count == 1)
      {
        $msg  = JText::_('JGA_IMGMAN_MSG_IMAGE_DELETED');
      }
      else
      {
        $msg  = JText::sprintf('JGA_IMGMAN_MSG_IMAGES_DELETED', $count);
      }
    }

    // Some messages are enqueued by the model
    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, $type);
  }

  /**
   * Changes the access level of an image
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function access()
  {
    $task = JRequest::getCmd('task');
    $cid  = JRequest::getVar('cid', array(), 'post', 'array');
    $cid  = $cid[0];

    switch($task)
    {
      case 'accesspublic':
        $access = 0;
        break;
      case 'accessregistered':
        $access = 1;
        break;
      case 'accessspecial':
        $access = 2;
        break;
      default:
        $access = 0;
        break;
    }

    // Create and load the images table object
    $row = & JTable::getInstance('joomgalleryimages', 'Table');
    $row->load($cid);
    $row->access = $access;

    // Store the changes
    if (!$row->store())
    {
      JError::raiseError(500, $row->getError());
      return false;
    }

    $this->setRedirect($this->_ambit->getRedirectUrl());
  }

  /**
   * Displays the edit form for one or multiple images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function edit()
  {
    $cid = JRequest::getVar('cid', array(), '', 'array');
    if(count($cid) <= 1)
    {
      if(count($cid))
      {
        $exploded = explode(',', $cid[0]);
        if(count($exploded) > 1)
        {
          JRequest::setVar('cid',   $exploded);
          JRequest::setVar('view',  'editimages');
        }
        else
        {
          JRequest::setVar('view',  'image');
        }
      }
      else
      {
        JRequest::setVar('view',  'image');
      }
    }
    else
    {
      JRequest::setVar('view',  'editimages');
    }

    JRequest::setVar('layout',  'form');
    JRequest::setVar('hidemainmenu', 1);

    parent::display();
  }

  /**
   * Saves one or more images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function save()
  {
    $model = $this->getModel('image');

    $data = JRequest::get('post', 4);

    // Editing more than one image?
    if(isset($data['cids']))
    {
      // Selected images
      $cids_string  = $data['cids'];
      $cids         = explode(',', $cids_string);

      // We need selected fields
      if(!isset($data['change']))
      {
        $this->setRedirect($this->_ambit->getRedirectUrl(null, implode(',', $cids)), JText::_('JGA_IMGMAN_MSG_NO_BOXES_FOR_EDITING_CHECKED'), 'notice');
        return;
      }

      // Selected fields to edit
      $change = $data['change'];

      // Delete all unselected fields
      foreach($data as $key => $value)
      {
        if(!in_array($key, $change))
        {
          unset($data[$key]);
        }
      }

      // Save each image
      $return = array();
      foreach($cids as $cid)
      {
        $data['cid']  = $cid;
        $return[]     = $model->store($data);
      }

      if(!in_array(false, $return))
      {
        $this->setRedirect($this->_ambit->getRedirectUrl(null, implode(',', $cids)), JText::sprintf('JGA_IMGMAN_MSG_IMAGES_SAVED', count($return)));
      }
      else
      {
        $this->setRedirect($this->_ambit->getRedirectUrl(), JText::sprintf('JGA_IMGMAN_MSG_ERROR_SAVING_IMAGES'), 'error');
      }
      return;
    }

    // Editing only one image
    if($cid = $model->store())
    {
      $msg  = JText::_('JGA_IMGMAN_MSG_IMAGE_SAVED');
      $this->setRedirect($this->_ambit->getRedirectUrl(null, $cid), $msg);
    }
    else
    {
      $msg  = $model->getError();
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, 'error');
    }
  }

  /**
   * Moves the order of an image
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function order()
  {
    $cid = JRequest::getVar('cid', array(), 'post', 'array');

    // Direction
    $dir  = 1;
    $task = JRequest::getCmd('task');
    if($task == 'orderup')
    {
      $dir = -1;
    }

    if(isset($cid[0]))
    {
      $row = & JTable::getInstance('joomgalleryimages', 'Table');
      $row->load((int)$cid[0]);
      $row->move($dir, 'catid = '.$row->catid);
      $row->reorder('catid = '.$row->catid);
    }

    $this->setRedirect($this->_ambit->getRedirectUrl());
  }

  /**
   * Saves the order of the images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function saveOrder()
  {
    $cid    = JRequest::getVar('cid', array(), 'post', 'array');
    $order  = JRequest::getVar('order', array (0), 'post', 'array');

    // Create and load the images table object
    $row = & JTable::getInstance('joomgalleryimages', 'Table');

    // Update the ordering for items in the cid array
    for($i = 0; $i < count($cid); $i ++)
    {
      $row->load((int)$cid[$i]);
      if($row->ordering != $order[$i])
      {
        $row->ordering = $order[$i];
        if(!$row->store())
        {
          JError::raiseError(500, $this->_db->getErrorMsg());
          return false;
        }
      }
    }

    $row->reorderAll();

    $msg = JText::_('JGA_COMMON_MSG_NEW_ORDERING_SAVED');
    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg);
  }

  /**
   * Displays the move form
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function showmove()
  {
    JRequest::setVar('view',    'move');
    JRequest::setVar('hidemainmenu', 1);

    parent::display();
  }

  /**
   * Moves images to another category
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function move()
  {
    $cid    = JRequest::getVar('cid', array(), 'post', 'array');
    $catid  = JRequest::getInt('catid');

    if(!count($cid))
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'), 'notice');
      $this->redirect();
    }
    if(!$catid)
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_IMGMAN_MSG_NO_CATEGORY_SELECTED'), 'notice');
      $this->redirect();
    }

    $success = array();
    $model = $this->getModel('image');
    foreach($cid as $id)
    {
      $success[] = $model->moveImage($id, $catid);
    }

    if(in_array(false, $success) === false)
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_IMGMAN_MSG_IMAGES_MOVED'));
    }
    else
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_IMGMAN_MSG_ERROR_MOVING_IMAGES'), 'error');
    }
  }

  /**
   * Recreates thumbnails and detail images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function recreate()
  {
    $model  = $this->getModel('images');
    $count  = $model->recreate();
    if(!$count[0])
    {
      $type = 'error';
      $msg  = $model->getError();
    }
    else
    {
      $type = 'message';
      if($count[0] == 1)
      {
        $msg  = JText::_('JGA_COMMON_MSG_THUMBNAIL_RECREATED');
      }
      else
      {
        $msg  = JText::sprintf('JGA_COMMON_MSG_THUMBNAILS_RECREATED', $count[0]);
      }
      if($count[1])
      {
        if($count[1] == 1)
        {
          $msg  .= '</li><li>'.JText::_('JGA_COMMON_MSG_IMAGE_RECREATED');
        }
        else
        {
          $msg  .= '</li><li>'.JText::sprintf('JGA_COMMON_MSG_IMAGES_RECREATED', $count[1]);
        }
      }
    }

    // Some messages are enqueued by the model
    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, $type);
  }

  /**
   * Resets hits of an image
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function resetHits()
  {
    $id = JRequest::getInt('cid');

    // Instantiate and load an image table
    $row = & JTable::getInstance('joomgalleryimages', 'Table');
    $row->load($id);
    $row->hits = 0;
    $row->store();

    JRequest::setVar('task', 'apply');
    $msg = JText::_('JGA_IMGMAN_MSG_HITS_RESETED');
    $this->setRedirect($this->_ambit->getRedirectUrl(null, $id), $msg);
  }

  /**
   * Resets votes of an image
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function resetVotes()
  {
    $id = JRequest::getInt('cid');

    // Instantiate and load an image table
    $row = & JTable::getInstance('joomgalleryimages', 'Table');
    $row->load($id);
 
    // Delete votes for image
    $row->imgvotes = 0;
    $row->imgvotesum = 0;
    $query = "DELETE FROM "._JOOM_TABLE_VOTES." WHERE picid = ".$row->id;
    $this->_db->setQuery($query);
    if(!$this->_db->query())
    {
      JError::raiseError(0, $row->getError());
      return false;
    }
    $row->store();

    JRequest::setVar('task', 'apply');
    $msg = JText::_('JGA_IMGMAN_MSG_VOTES_RESETED');
    $this->setRedirect($this->_ambit->getRedirectUrl(null, $id), $msg);
  }

  /**
   * Cancel creating, editing or moving images
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function cancel()
  {
    $this->setRedirect($this->_ambit->getRedirectUrl());
  }
}