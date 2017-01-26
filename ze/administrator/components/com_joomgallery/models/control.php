<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/models/control.php $
// $Id: control.php 3839 2012-09-03 17:17:47Z chraneco $
/****************************************************************************************\
**   JoomGallery 2                                                                      **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Control panel model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelControl extends JoomGalleryModel
{
  /**
   * Menu data array
   *
   * @var     array
   */
  protected $_data;

  /**
   * Returns the query for loading the menu entries
   *
   * @return  object  The query to be used to retrieve the menu entries from the database
   * @since   1.5.5
   */
  protected function _buildQuery()
  {
    $query = $this->_db->getQuery(true)
          ->select('*')
          ->from('#__menu')
          ->where('parent_id != 1')
          ->where("menutype = 'main'");

    $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=images%'";
    $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=categories%'";
    $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=comments%'";
    $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=migration%'";
    $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=help%'";

    $canDo = JoomHelper::getActions();
    if($this->_config->get('jg_disableunrequiredchecks') || $canDo->get('joom.upload') || count(JoomHelper::getAuthorisedCategories('joom.upload')))
    {
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=upload%'";
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=batchupload%'";
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=ftpupload%'";
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=jupload%'";
    }
    if($canDo->get('core.admin'))
    {
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=config%'";
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=cssedit%'";
      $where[] = "link LIKE 'index.php?option=com_joomgallery&controller=maintenance%'";
    }

    $query->where('('.implode(' OR ', $where).')')
          ->order('id');

    return $query;
  }

  /**
   * Retrieves the data of the backend menu entries for JoomGallery
   *
   * @return  array   An array of objects containing the data of the menu entries from the database
   * @since   1.5.5
   */
  public function getData()
  {
    // Lets load the data if it doesn't already exist
    if(empty($this->_data))
    {
      $query = $this->_buildQuery();
      $this->_data = $this->_getList($query);
    }

    return $this->_data;
  }
}