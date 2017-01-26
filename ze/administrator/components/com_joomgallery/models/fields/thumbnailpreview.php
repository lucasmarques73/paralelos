<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/models/fields/thumbnailpreview.php $
// $Id: thumbnailpreview.php 3773 2012-05-07 15:28:36Z erftralle $
/****************************************************************************************\
**   JoomGallery  2                                                                     **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Renders a thumbnail preview form field
 *
 * @package JoomGallery
 * @since   2.0
 */
class JFormFieldThumbnailpreview extends JFormField
{
  /**
   * The form field type.
   *
   * @var     string
   * @since   2.0
   */
  protected $type = 'Thumbnailpreview';

  /**
   * Returns the HTML for a thumbnail preview form field.
   *
   * @return  object    The thumbnail preview form field.
   * @since   2.0
   */
  protected function getInput()
  {
    return '<img src="'.$this->value.'" id="'.$this->id.'" name="'.$this->name.'" border="2" alt="'.JText::_('COM_JOOMGALLERY_COMMON_THUMBNAIL_PREVIEW').'">';
  }
}