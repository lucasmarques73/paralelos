<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/tables/joomgallerymaintenance.php $
// $Id: joomgallerymaintenance.php 4276 2013-05-23 11:05:11Z chraneco $
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
 * JoomGallery maintenance table class
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class TableJoomgalleryMaintenance extends JTable
{
  /** @var int Primary key */
  var $id           = null;
  /** @var int */
  var $refid        = null;
  /** @var int */
  var $catid        = null;
  /** @var int */
  var $owner        = null;
  /** @var string */
  var $title        = null;
  /** @var string */
  var $thumb        = null;
  /** @var string */
  var $img          = null;
  /** @var string */
  var $orig         = null;
  /** @var string */
  var $thumborphan  = null;
  /** @var string */
  var $imgorphan    = null;
  /** @var string */
  var $origorphan   = null;
  /** @var int */
  var $type         = null;
  
  function TableJoomgalleryMaintenance(&$db)
  {
    parent::__construct(_JOOM_TABLE_MAINTENANCE, 'id', $db);
  }

  function reorderAll()
  {
    $query = 'SELECT DISTINCT catid
                FROM '.$this->_db->nameQuote($this->_tbl);
    $this->_db->setQuery($query);
    $catids = $this->_db->loadResultArray();

    foreach($catids as $catid)
    {
      $this->reorder('catid = '.$catid);
    }
  }

  /**
   * Returns the ordering value to place a new item first in its group
   *
   * @access  public
   * @param   string query WHERE clause for selecting MAX(ordering).
   * @return  int    the ordring number
   */
  function getPreviousOrder($where = '')
  {
    if(!in_array('ordering', array_keys($this->getProperties())))
    {
      $this->setError(get_class($this).' does not support ordering');
      return false;
    }

    $query = 'SELECT MIN(ordering)' .
        ' FROM ' . $this->_tbl .
        ($where ? ' WHERE '.$where : '');

    $this->_db->setQuery($query);
    $maxord = $this->_db->loadResult();

    if($this->_db->getErrorNum())
    {
      $this->setError($this->_db->getErrorMsg());
      return false;
    }

    return $maxord - 1;
  }
}