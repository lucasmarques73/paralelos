<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/controllers/categories.php $
// $Id: categories.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery Categories Controller
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryControllerCategories extends JoomGalleryController
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
    JRequest::setVar('view', 'categories');

    // Register tasks
    $this->registerTask('new',              'edit');
    $this->registerTask('apply',            'save');
    $this->registerTask('unpublish',        'publish');
    #$this->registerTask('reject',          'approve');
    $this->registerTask('accesspublic',     'access');
    $this->registerTask('accessregistered', 'access');
    $this->registerTask('accessspecial',    'access');
    $this->registerTask( 'orderup',         'order');
    $this->registerTask( 'orderdown',       'order');

    // Submenu
    /* TODO */
  }

  /**
   * Publishes or unpublishes one or more categories
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
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_CATEGORIES_SELECTED'));
      $this->redirect();
    }

    $model = $this->getModel('categories');
    if($count = $model->publish($cid, $publish))
    {
      if($count != 1)
      {
        $msg = JText::sprintf($publish ? 'JGA_CATMAN_MSG_CATEGORIES_PUBLISHED' : 'JGA_CATMAN_MSG_CATEGORIES_UNPUBLISHED', $count);
      }
      else
      {
        $msg = JText::_($publish ? 'JGA_CATMAN_MSG_CATEGORY_PUBLISHED' : 'JGA_CATMAN_MSG_CATEGORY_UNPUBLISHED');
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
   * Approves or rejects one or more comments
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
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_CATEGORIES_SELECTED'));
      $this->redirect();
    }

    $model = $this->getModel('categories');
    if($count = $model->publish($cid, $publish, 'approve'))
    {
      if($count != 1)
      {
        $msg = JText::sprintf($publish ? 'JGA_CATMAN_MSG_CATEGORIES_APPROVED' : 'JGA_CATMAN_MSG_CATEGORIES_REJECTED', $count);
      }
      else
      {
        $msg = JText::_($publish ? 'JGA_CATMAN_MSG_CATEGORY_APPROVED' : 'JGA_CATMAN_MSG_CATEGORY_REJECTED');
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
   * Removes one or more categories
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function remove()
  {
    $model = $this->getModel('categories');
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
        $msg  = JText::_('JGA_CATMAN_MSG_CATEGORY_DELETED');
      }
      else
      {
        $msg  = JText::sprintf('JGA_CATMAN_MSG_CATEGORIES_DELETED', $count);
      }
    }

    // Some messages are enqueued by the model
    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, $type);
  }

  /**
   * Removes one or more categories even though there
   * are still images or sub-categories in them.
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function deletecompletely()
  {
    $mainframe  = & JFactory::getApplication('administrator');
    $categories = $mainframe->getUserState('joom.categories.delete.categories');
    $images     = $mainframe->getUserState('joom.categories.delete.images');

    if(!$categories || !is_array($categories) || !count($categories))
    {
      $this->setRedirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_CATEGORIES_SELECTED'), 'notice');
      return;
    }

    require_once JPATH_COMPONENT.DS.'helpers'.DS.'refresher.php';

    $refresher = new JoomRefresher();

    $img_count = $mainframe->getUserState('joom.categories.delete.img_count');
    if(is_null($img_count))
    {
      $img_count = 0;
    }
    $cat_count = $mainframe->getUserState('joom.categories.delete.cat_count');
    if(is_null($cat_count))
    {
      $cat_count = 0;
    }

    if($images && is_array($images) && count($images))
    {
      $model  = $this->getModel('images');
      $row    = $model->getTable('joomgalleryimages');
      foreach($images as $key => $image)
      {
        // Check whether image still exists.
        // It may have been deleted before if categories were selected
        // to delete as well as their sub-categories.
        if($row->load($image))
        {
          JRequest::setVar('cid', array($image));
          if(!$model->delete())
          {
            if($img_count)
            {
              if($img_count == 1)
              {
                $msg  = JText::_('JGA_CATMAN_MSG_IMAGE_DELETED');
              }
              else
              {
                $msg  = JText::sprintf('JGA_CATMAN_MSG_IMAGES_DELETED', $img_count);
              }
              $mainframe->enqueueMessage($msg);
            }

            $this->setRedirect($this->_ambit->getRedirectUrl(), $model->getError(), 'error');
            return;
          }

          $img_count++;

          unset($images[$key]);
        }

        if(!$refresher->check())
        {
          $mainframe->setUserState('joom.categories.delete.images', $images);
          $mainframe->setUserState('joom.categories.delete.img_count', $img_count);
          $refresher->refresh();
        }
      }
    }

    $model  = $this->getModel('categories');
    $row    = $model->getTable('joomgallerycategories');
    for($i = count($categories) - 1; $i >= 0; $i--)
    {
      foreach($categories[$i] as $key => $category)
      {
        // Check whether category still exists.
        // It may have been deleted before if categories were selected
        // to delete as well as their sub-categories.
        if($row->load($category))
        {
          JRequest::setVar('cid', array($category));
          if(!$model->delete())
          {
            if($img_count)
            {
              if($img_count == 1)
              {
                $msg  = JText::_('JGA_CATMAN_MSG_IMAGE_DELETED');
              }
              else
              {
                $msg  = JText::sprintf('JGA_CATMAN_MSG_IMAGES_DELETED', $img_count);
              }
              $mainframe->enqueueMessage($msg);
            }
            if($cat_count)
            {
              if($cat_count == 1)
              {
                $msg  = JText::_('JGA_CATMAN_MSG_CATEGORY_DELETED');
              }
              else
              {
                $msg  = JText::sprintf('JGA_CATMAN_MSG_CATEGORIES_DELETED', $cat_count);
              }
              $mainframe->enqueueMessage($msg);
            }

            $this->setRedirect($this->_ambit->getRedirectUrl(), $model->getError(), 'error');
            return;
          }

          $cat_count++;

          unset($categories[$i][$key]);
        }
        
        if(!$refresher->check() && count($categories[0]))
        {
          $mainframe->setUserState('joom.categories.delete.categories', $categories);
          $mainframe->setUserState('joom.categories.delete.img_count', $img_count);
          $mainframe->setUserState('joom.categories.delete.cat_count', $cat_count);
          $refresher->refresh();
        }
      }
    }

    if($img_count)
    {
      if($img_count == 1)
      {
        $msg  = JText::_('JGA_CATMAN_MSG_IMAGE_DELETED');
      }
      else
      {
        $msg  = JText::sprintf('JGA_CATMAN_MSG_IMAGES_DELETED', $img_count);
      }
      $mainframe->enqueueMessage($msg);
    }

    if($cat_count == 1)
    {
      $msg  = JText::_('JGA_CATMAN_MSG_CATEGORY_DELETED');
    }
    else
    {
      $msg  = JText::sprintf('JGA_CATMAN_MSG_CATEGORIES_DELETED', $cat_count);
    }

    // Reset all user states of this task
    $mainframe->setUserState('joom.categories.delete', null);

    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg);
  }

  /**
   * Changes the access level of a category
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function access()
  {
    $task = JRequest::getCmd('task');
    $cid  = JRequest::getVar('cid', array(0), 'post', 'array');
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

    // Create and load the category object
    $row = & JTable::getInstance('joomgallerycategories', 'Table');
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
   * Displays the edit form of a category
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function edit()
  {
    JRequest::setVar('view',    'category');
    JRequest::setVar('layout',  'form');
    JRequest::setVar('hidemainmenu', 1);

    parent::display();
  }

  /**
   * Saves a category
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function save()
  {
    $model = $this->getModel('category');

    if($cid = $model->store())
    {
      $msg  = JText::_('JGA_CATMAN_MSG_CATEGORY_SAVED');
      $this->setRedirect($this->_ambit->getRedirectUrl(null, $cid), $msg);
    }
    else
    {
      $msg  = $model->getError();
      $this->setRedirect($this->_ambit->getRedirectUrl(), $msg, 'error');
    }
  }

  /**
   * Moves the order of a category
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
      $row = & JTable::getInstance('joomgallerycategories', 'Table');
      $row->load((int)$cid[0]);
      $row->move($dir, 'parent ='.$row->parent);
      $row->reorder('parent = '.$row->parent);
    }

    $this->setRedirect($this->_ambit->getRedirectUrl());
  }

  /**
   * Saves the order of the categories
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function saveOrder()
  {
    $cid    = JRequest::getVar('cid', array(0), 'post', 'array');
    $order  = JRequest::getVar('order', array (0), 'post', 'array');

    // Create and load the categories table object
    $row = & JTable::getInstance('joomgallerycategories', 'Table');

    // Update the ordering for items in the cid array
    for($i = 0; $i < count($cid); $i ++)
    {
      $row->load((int)$cid[$i]);
      if($row->ordering != $order[$i])
      {
        $row->ordering = $order[$i];
        if(!$row->store())
        {
          JError::raiseError( 500, $this->_db->getErrorMsg() );
          return false;
        }
      }
    }

    $row->reorderAll();

    $msg = JText::_('JGA_COMMON_MSG_NEW_ORDERING_SAVED');
    $this->setRedirect($this->_ambit->getRedirectUrl(), $msg);
  }

  /**
   * Cancel editing or creating a category
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