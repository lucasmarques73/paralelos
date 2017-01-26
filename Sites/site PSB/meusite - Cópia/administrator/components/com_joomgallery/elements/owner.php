<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/elements/owner.php $
// $Id: owner.php 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Renders an owner list element
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JElementOwner extends JElement
{
  /**
   * Element name
   *
   * @access  protected
   * @var     string
   */
  var  $_name = 'Owner';

  function fetchElement($name, $value, &$node, $control_name)
  {
    // TODO: set 'NO USER' in the language file to 'Administrator' or something like that
    return JHTML::_('list.users', $control_name.'['.$name.']', $value, true, null, 'name', false);
  }
}