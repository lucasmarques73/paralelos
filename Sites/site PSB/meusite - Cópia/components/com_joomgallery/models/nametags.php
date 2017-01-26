<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/nametags.php $
// $Id: nametags.php 2566 2010-11-03 21:10:42Z mab $
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
 * Gallery Component Model
 *
 * @package     Joomla
 * @subpackage  Content
 * @since       1.5.5.0
 */
class JoomGalleryModelNametags extends JoomGalleryModel
{
  /**
   * Constructor
   *
   * @since 1.5.5.0
   */
  function __construct()
  {
    parent::__construct();

    $id = JRequest::getInt('id');
    $this->setId((int)$id);
  }

  /**
   * Method to set the image id
   *
   * @access  public
   * @param   int   Image ID number
   * @since   1.5.5.0
   */
  function setId($id)
  {
    // Set new image ID if valid
    if(!$id)
    {
      JError::raiseError(500, JText::_('JGS_COMMON_NO_IMAGE_SPECIFIED'));
    }
    $this->_id  = $id;
  }

  /**
   * Method to get the identifier
   *
   * @access  public
   * @return  int identifier
   * @since   1.5.5.0
   */
  function getId()
  {
    return $this->_id;
  }

  /**
   * Method to save a nametag
   *   
   * @access  public
   * @return  array Image data array
   * @since   1.5.5.0
   */
  function save()
  {
    $yvalue   = JRequest::getInt('yvalue',  0, 'post');
    $xvalue   = JRequest::getInt('xvalue',  0, 'post');
    $height   = $this->_config->get('jg_nameshields_height');

    if(!$by = $this->_user->get('id'))
    {
      JError::raiseError(500, JText::_('JGS_COMMON_PERMISSION_DENIED'));
    }

    if($this->_config->get('jg_nameshields_others'))
    {
      $userid = JRequest::getInt('userid');
    }
    else
    {
      $userid = $by;
    }

    $user = & JFactory::getUser($userid);
    if(!is_object($user))
    {
      $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_ERROR_SAVING'));
      return false;
    }

    $this->_db->setQuery("SELECT
                            nid
                          FROM
                            "._JOOM_TABLE_NAMESHIELDS."
                          WHERE
                                npicid  = ".$this->_id."
                            AND nuserid = ".$userid."
                        ");
    if($this->_db->loadResult())
    {
      if($userid == $by)
      {
        $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_YOU_ARE_ALREADY_TAGGED'));
      }
      else
      {
        $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_USER_ALREADY_TAGGED'));
      }
      return false;
    }

    $length = strlen($user->get('username')) * $this->_config->get('jg_nameshields_width');

    if(($xvalue < $height) && ($yvalue < $length))
    {
      $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_NOT_SAVED'));
      return false;
    }
  
    $this->_db->setQuery("SELECT
                            MIN(nzindex)
                          FROM
                            "._JOOM_TABLE_NAMESHIELDS."
                          WHERE
                            npicid = ".$this->_id."
                        ");
    $zindex = $this->_db->loadResult();
    if(!$zindex)
    {
      $zindex = 500;
    }
    else
    {
      $zindex--;
    }

    $row  = & $this->getTable('joomgallerynameshields');
    $date = & JFactory::getDate();

    $row->npicid  = $this->_id;
    $row->nuserid = $userid;
    $row->nxvalue = $xvalue;
    $row->nyvalue = $yvalue;
    $row->by      = $by;
    $row->nuserip = $_SERVER['REMOTE_ADDR'];
    $row->ndate   = $date->toMySQL();
    $row->nzindex = $zindex;

    if(!$row->store())
    {
      $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_ERROR_SAVING'));
      return false;
    }

    $this->_mainframe->triggerEvent('onJoomAfterTag', array($row));

    if($this->_config->get('jg_msg_nametag') && $by != $userid)
    {
      $image = &$this->getTable('joomgalleryimages');
      $image->load($this->_id);

      $user = & JFactory::getUser($by);
      $name = $this->_config->get('jg_realname') ? $user->get('name') : $user->get('username');

      require_once(JPATH_COMPONENT.DS.'helpers'.DS.'messenger.php');
      $messenger  = new JoomMessenger();
      $message    = array(
                          'from'      => $by,
                          'recipient' => $userid,
                          'subject'   => JText::_('JGS_YOU_WERE_TAGGED'),
                          'body'      => JText::sprintf('JGS_USER_TAGGED_YOU_ON_IMAGE', $name, $image->imgtitle, $this->_id),
                          'mode'      => 'nametag'
                        );

      $messenger->send($message);
    }

    return true;
  }

  /**
   * Method to get all the images of the current image's catagory
   * The image has to be loaded first, because we need the catid   
   *   
   * @access  public
   * @return  array   Images data array
   * @since   1.5.5.0
   */
  function remove()
  {
    if(!$userid = $this->_user->get('id'))
    {
      JError::raiseError(500, JText::_('JGS_COMMON_PERMISSION_DENIED'));
    }

    if(!$this->_config->get('jg_nameshields_others'))
    {
      $this->_db->setQuery("DELETE
                            FROM 
                              "._JOOM_TABLE_NAMESHIELDS."
                            WHERE 
                                  npicid  = ".$this->_id." 
                              AND nuserid = ".$userid."
                          ");
      if(!$this->_db->query())
      {
        $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_ERROR_DELETING'));
        return false;
      }
    }
    else
    {
      $nid = JRequest::getInt('nid');

      $row = &$this->getTable('joomgallerynameshields');
      $row->load($nid);
      if($row->nuserid == $userid || $row->by == $userid || $this->_user->get('gid') > 23)
      {
        if(!$row->delete())
        {
          $this->setError(JText::_('JGS_DETAIL_NAMETAGS_MSG_ERROR_DELETING'));
          return false;
        }
      }
    }

    return true;
  }
}