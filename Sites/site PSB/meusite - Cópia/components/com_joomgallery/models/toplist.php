<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/models/toplist.php $
// $Id: toplist.php 2566 2010-11-03 21:10:42Z mab $
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
 * @since 1.5
 */
class JoomGalleryModelToplist extends JoomGalleryModel
{
  /**
   * constructor
   */
  function __construct()
  {
    parent::__construct();
  }

  /**
   *
   */
  function getLastCommented()
  {
    if($this->_loadLastCommented())
    {
      return $this->_lastCommented;
    }

    return array();
  }

  /**
   *
   */
  function _loadLastCommented()
  {
    if(empty($this->_lastCommented))
    {
      $rows = null;
      $this->_mainframe->triggerEvent('onJoomGetLastComments', array(&$rows, $this->_config->get('jg_toplist')));

      if(!$rows)
      {
        $this->_db->setQuery("SELECT
                                a.*,
                                cc.*,
                                ca.*,
                                a.owner AS owner,
                                ".JoomHelper::getSQLRatingClause('a')." AS rating
                              FROM
                                "._JOOM_TABLE_IMAGES." AS a,
                                "._JOOM_TABLE_CATEGORIES." AS ca,
                                "._JOOM_TABLE_COMMENTS." AS cc
                              WHERE
                                            a.id = cc.cmtpic
                                AND a.catid      = ca.cid
                                AND a.published  = 1
                                AND a.approved   = 1
                                AND cc.published = 1
                                AND ca.published = 1
                                AND cc.approved  = 1
                                AND ca.access   <= ".$this->_user->get('aid')."
                              ORDER BY
                                cc.cmtdate DESC
                              LIMIT ".$this->_config->get('jg_toplist')
                            );

        if(!$rows = $this->_db->loadObjectList())
        {
          return false;
        }
      }

      $this->_lastCommented = $rows;
    }

    return true;
  }

  /**
   *
   */
  function getLastAdded()
  {
    if($this->_loadLastAdded())
    {
      return $this->_lastAdded;
    }

    return array();
  }

  /**
   *
   */
  function _loadLastAdded()
  {
    if(empty($this->_lastAdded))
    {
      $this->_db->setQuery("SELECT
                              *,
                              a.owner AS owner,
                              ".JoomHelper::getSQLRatingClause('a')." AS rating
                            FROM
                              "._JOOM_TABLE_IMAGES." As a,
                              "._JOOM_TABLE_CATEGORIES." AS ca
                            WHERE
                                       a.catid = ca.cid
                              AND a.published  = 1
                              AND a.approved   = 1
                              AND ca.published = 1
                              AND ca.access   <= ".$this->_user->get('aid')."
                            ORDER BY
                              a.id DESC
                            LIMIT ".$this->_config->get('jg_toplist')
                          );

      if(!$rows = $this->_db->loadObjectList())
      {
        return false;
      }

      $this->_lastAdded = $rows;
    }

    return true;
  }

  /**
   *
   */
  function getTopRated()
  {
    if($this->_loadTopRated())
    {
      return $this->_topRated;
    }

    return array();
  }

  /**
   *
   */
  function _loadTopRated()
  {
    if(empty($this->_topRated))
    {
      $this->_db->setQuery("SELECT
                              *,
                              a.owner AS owner,
                              ".JoomHelper::getSQLRatingClause('a')." AS rating
                            FROM
                              "._JOOM_TABLE_IMAGES." AS a,
                              "._JOOM_TABLE_CATEGORIES." AS ca
                            WHERE
                                       a.catid = ca.cid
                              AND a.imgvotes   > '0'
                              AND a.published  = 1
                              AND a.approved   = 1
                              AND ca.published = 1
                              AND ca.access   <= ".$this->_user->get('aid')."
                            ORDER BY
                              rating DESC,
                              imgvotesum DESC
                            LIMIT ".$this->_config->get('jg_toplist')
                          );

      if(!$rows = $this->_db->loadObjectList())
      {
        return false;
      }

      $this->_topRated = $rows;
    }

    return true;
  }

  /**
   *
   */
  function getMostViewed()
  {
    if($this->_loadMostViewed())
    {
      return $this->_mostViewed;
    }

    return array();
  }

  /**
   *
   */
  function _loadMostViewed()
  {
    if(empty($this->_mostViewed))
    {
      $this->_db->setQuery("SELECT
                              *,
                              a.owner AS owner,
                              ".JoomHelper::getSQLRatingClause('a')." AS rating
                            FROM
                              "._JOOM_TABLE_IMAGES." AS a,
                              "._JOOM_TABLE_CATEGORIES." AS ca
                            WHERE
                                  a.hits > 0
                              AND a.catid      = ca.cid
                              AND a.published  = 1
                              AND a.approved   = 1
                              AND ca.published = 1
                              AND ca.access   <= ".$this->_user->get('aid')."
                            ORDER BY
                              hits DESC
                            LIMIT ".$this->_config->get('jg_toplist')
                          );

      if(!$rows = $this->_db->loadObjectList())
      {
        return false;
      }

      $this->_mostViewed = $rows;
    }

    return true;
  }

  /**
   * Method to get the number of comments of a specific image
   *
   * @TODO
   *
   * @access  public
   * @return  int     The number of comments
   * @since   1.5.5.0
   */
  function getCommentsNumber($id)
  {
    // Check how many comments exist
    $this->_db->setQuery("SELECT
                            COUNT(*)
                          FROM
                            "._JOOM_TABLE_COMMENTS."
                          WHERE
                                cmtpic    = ".$id."
                            AND approved  = 1
                            AND published = 1
                         ");
    return $this->_db->loadResult();
  }
}