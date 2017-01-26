<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/uninstall.joomgallery.php $
// $Id: uninstall.joomgallery.php 2566 2010-11-03 21:10:42Z mab $
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
 * Uninstall method
 * is called by the installer of Joomla!
 *
 * @access  protected
 * @return  void
 * @since   1.5.5
 */
function com_uninstall()
{
  $db = & JFactory::getDBO();
  $db->setQuery("DELETE FROM #__modules WHERE position = 'joom_cpanel'");
  $db->query();
  $thumbpath  = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'thumbnails';
  $imgpath    = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'details';
  $origpath   = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'originals';
  if(JFolder::exists($thumbpath))
  {
    JFolder::delete($thumbpath);
  }
  if(JFolder::exists($imgpath))
  {
    JFolder::delete($imgpath);
  }
  if(JFolder::exists($origpath))
  {
    JFolder::delete($origpath);
  }
  echo 'JoomGallery was uninstalled successfully!<br />
        Please remember to remove your images folders manually
        if you didn\'t use JoomGallery\'s default directories.';
}