<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/tables/joomgallerynameshields.php $
// $Id: joomgallerynameshields.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery nametags table class
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class TableJoomgalleryNameshields extends JTable
{
  /** @var int Primary key */
  var $nid      = null;
  /** @var int */
  var $npicid   = null;
  /** @var int */
  var $nuserid  = null;
  /** @var int */
  var $nxvalue  = null;
  /** @var int */
  var $nyvalue  = null;
  /** @var int */
  var $by       = null;
  /** @var string */
  var $nuserip  = null;
  /** @var int */
  var $ndate    = null;
  /** @var int */
  var $nzindex  = null;

  function TableJoomgalleryNameshields(&$db)
  {
    parent::__construct(_JOOM_TABLE_NAMESHIELDS, 'nid', $db);
  }
}