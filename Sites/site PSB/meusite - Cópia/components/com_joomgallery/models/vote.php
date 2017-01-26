<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/vote.php $
// $Id: vote.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery Votes model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelVote extends JoomGalleryModel
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

    $id = JRequest::getInt('id');
    $this->setId($id);
  }

  /**
   * Method to set the image identifier
   *
   * @access  public
   * @param   int     $id The image ID
   * @since   1.5.5
   */
  function setId($id)
  {
    // Set new image ID if valid
    if(!$id)
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_NO_IMAGE_SPECIFIED'), 'notice');
    }
    $this->_id  = $id;
  }

  /**
   * Method to get the image ID
   *
   * @access  public
   * @return  int     The image ID
   * @since   1.5.5
   */
  function getId()
  {
    return $this->_id;
  }

  /**
   * Method to vote an image
   *
   * @access  public
   * @param   string  $error_msg  Error message
   * @param   boolean $ajax_req   True if function call was initiated by a ajax request view
   *                              , false otherwise
   * @return  boolean True on success, false otherwise
   * @since   1.5.5
   */
  function vote(&$error_msg = '', $ajax_req = false)
  {
    // Check for hacking attempt
    $this->_db->setQuery("SELECT
                            a.owner
                          FROM
                            "._JOOM_TABLE_IMAGES." AS a
                          LEFT JOIN
                            "._JOOM_TABLE_CATEGORIES." AS c ON c.cid = a.catid
                          WHERE
                                a.published = 1
                            AND a.approved  = 1
                            AND a.id        = ".$this->_id."
                            AND c.access   <= ".$this->_user->get('aid')."
                        ");

    $owner = $this->_db->loadResult();
    if(is_null($owner) || ($this->_config->get('jg_onlyreguservotes') && !$this->_user->get('id')))
    {
      $error_msg = 'Stop Hacking attempt!';
      if(!$ajax_req)
      {
        die($error_msg);
      }

      return false;
    }

    // No votes for image owner allowed
    if($this->_config->get('jg_onlyreguservotes') && $this->_user->get('id') == $owner)
    {
      $error_msg = JText::_('JGS_DETAIL_RATING_NOT_ON_OWN_IMAGES');
      if(!$ajax_req)
      {
        $this->_mainframe->redirect(JRoute::_('index.php?view=detail&id='.$this->_id, false), $error_msg, 'notice');
      }

      return false;
    }

    $vote = JRequest::getInt('imgvote');
    // Check if vote was manipulated with modifying the HTML code
    if($vote < 1 || $vote > $this->_config->get('jg_maxvoting'))
    {
      $error_msg = 'Stop Hacking attempt!';
      if(!$ajax_req)
      {
        die($error_msg);
      }

      return false;
    }

    if($this->_config->get('jg_onlyreguservotes') && $this->_user->get('aid') > 0)
    {
      // Get voted or not
      $this->_db->setQuery("SELECT
                              COUNT(*)
                            FROM
                              "._JOOM_TABLE_VOTES."
                            WHERE
                                  userid  = ".$this->_user->get('id')."
                              AND picid   = ".$this->_id."
                          ");

      // Vote or enqueue notice
      if($this->_db->loadResult())
      {
        $error_msg = JText::_('JGS_DETAIL_RATINGS_MSG_YOUR_VOTE_NOT_COUNTED');
        if(!$ajax_req)
        {
          // Enqueue notice and get back to details page
          $this->_mainframe->redirect(JRoute::_('index.php?view=detail&id='.$this->_id, false), $error_msg, 'notice');
        }

        return false;
      }
    }

    // Get old values from database
    $this->_db->setQuery("SELECT
                            imgvotes,
                            imgvotesum
                          FROM
                            "._JOOM_TABLE_IMAGES."
                          WHERE
                            id = ".$this->_id."
                        ");
    $row = $this->_db->loadObject();

    // Recalculate with the new vote
    $row->imgvotes++;
    $row->imgvotesum = $row->imgvotesum + $vote;

    // Trigger event 'onJoomBeforeVote'
    $plugins  = $this->_mainframe->triggerEvent('onJoomBeforeVote', array(&$row, $vote));
    if(in_array(false, $plugins, true))
    {
      return false;
    }

    // Save new values
    $this->_db->setQuery("UPDATE
                            "._JOOM_TABLE_IMAGES."
                          SET
                            imgvotes   = ".$row->imgvotes.",
                            imgvotesum = ".$row->imgvotesum."
                          WHERE
                            id = ".$this->_id."
                        ");
    if(!$this->_db->query())
    {
      $error_msg = $this->_db->getErrorMsg();
      $this->setError($error_msg);
      return false;
    }

    // Store log of vote
    $row  = & $this->getTable('joomgalleryvotes');
    $date = & JFactory::getDate();

    $row->picid     = $this->_id;
    $row->userid    = $this->_user->get('id');
    $row->userip    = $_SERVER['REMOTE_ADDR'];
    $row->datevoted = $date->toMySQL();
    $row->vote      = $vote;

    if(!$row->store())
    {
      $error_msg = $row->getErrorMsg();
      $this->setError($error_msg);
      return false;
    }

    $this->_mainframe->triggerEvent('onJoomAfterVote', array($row, $vote));

    return true;
  }
}