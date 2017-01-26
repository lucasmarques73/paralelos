<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/elements/image.php $
// $Id: image.php 2566 2010-11-03 21:10:42Z mab $
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
 * Renders an image selection element
 *
 * @package     JoomGallery
 * @subpackage  Parameter
 * @since       1.5.5
 */
class JElementImage extends JElement
{
  /**
   * Element name
   *
   * @access  protected
   * @var     string
   */
  var	$_name = 'Image';

  function fetchElement($name, $value, &$node, $control_name)
  {
    require_once(JPATH_BASE.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php');

    $db         = & JFactory::getDBO();
    $doc        = & JFactory::getDocument();
    $fieldName	= $control_name.'['.$name.']';

    JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'tables');
    $img =& JTable::getInstance('joomgalleryimages', 'Table');
    if($value)
    {
      $img->load($value);
    }
    else
    {
      $img->imgtitle = JText::_('JGA_LAYOUT_COMMON_CHOOSE_IMAGE');
    }

    $js = "
    function joom_selectimage(id, title, object) {
      document.getElementById(object + '_id').value = id;
      document.getElementById(object + '_name').value = title;
      document.getElementById('sbox-window').close();
    }";
    $doc->addScriptDeclaration($js);

    $link = 'index.php?option=com_joomgallery&view=mini&extended=0&tmpl=component&catid=0&object='.$name;

    JHTML::_('behavior.modal', 'a.modal');
    $html = "\n".'<div style="float: left;"><input style="background: #ffffff;" type="text" id="'.$name.'_name" value="'.htmlspecialchars($img->imgtitle, ENT_QUOTES, 'UTF-8').'" disabled="disabled" /></div>';
    $html .= '<div class="button2-left"><div class="blank"><a class="modal" title="'.JText::_('JGA_LAYOUT_COMMON_CHOOSE_IMAGE').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 375}}">'.JText::_('Select').'</a></div></div>'."\n";
    $html .= "\n".'<input type="hidden" id="'.$name.'_id" name="'.$fieldName.'" value="'.(int)$value.'" />';

    return $html;
  }
}