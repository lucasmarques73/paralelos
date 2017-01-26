<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/elements/thumbnail.php $
// $Id: thumbnail.php 2566 2010-11-03 21:10:42Z mab $
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
 * Renders a thumbnail selection element
 *
 * @package     JoomGallery
 * @subpackage  Parameter
 * @since       1.5.5
 */
class JElementThumbnail extends JElement
{
  /**
   * Element name
   *
   * @access  protected
   * @var     string
   */
  var	$_name = 'Thumbnail';

  function fetchElement($name, $value, &$node, $control_name)
  {
    $db         = & JFactory::getDBO();
    $doc        = & JFactory::getDocument();
    $fieldName	= $control_name.'['.$name.']';

    $ambit = & JoomAmbit::getInstance();

    $img =& JTable::getInstance('joomgalleryimages', 'Table');
    if($value)
    {
      $img->load($value);
    }
    else
    {
      $img->imgfilename = JText::_('JGA_CATMAN_SELECT_THUMBNAIL_TIP');
    }

    $ambit   = & JoomAmbit::getInstance();

    $cids     = JRequest::getVar('cid', array(), '', 'array');

    if(isset($cids[0]))
    {
      $catid    = intval($cids[0]);
      $catpath  = JoomHelper::getCatPath($catid);
    }
    else
    {
      $catid    = 0;
      $catpath  = '';
    }

    $path = $ambit->get('thumb_url').$catpath;

    $js = "
    function joom_selectimage(id, title, object, filename) {
      document.getElementById(object + '_id').value = filename;
      document.getElementById(object + '_name').value = title;
      $('remove_button').removeClass('jg_displaynone');
      if (document.forms.adminForm.".$name."_id.value!='') {document.imagelib.src='".$path."' + filename} else {document.imagelib.src='../images/blank.png'}
      document.getElementById('sbox-window').close();
    }
    function joom_clearthumb() {
      $('remove_button').addClass('jg_displaynone');
      document.getElementById('catimage_id').value = 0;document.imagelib.src='../images/blank.png';
    }";
    $doc->addScriptDeclaration($js);

    $link = 'index.php?option=com_joomgallery&view=mini&extended=-1&tmpl=component&object='.$name.'&type=category&catid='.$catid;

    JHTML::_('behavior.modal', 'a.modal');
    $html = "\n".'<div style="float: left;"><input style="background: #ffffff;" type="hidden" id="'.$name.'_name" value="'.htmlspecialchars($img->imgtitle, ENT_QUOTES, 'UTF-8').'" disabled="disabled" /></div>';
    $html .= '<div id="select_button" class="button2-left"><div class="blank"><a class="modal" title="'.JText::_('JGA_CATMAN_SELECT_THUMBNAIL_TIP').'" href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 480}}">'.JText::_('JGA_CATMAN_SELECT_THUMBNAIL').'</a></div></div>'."\n";
    $html .= "\n".'<input type="hidden" id="'.$name.'_id" name="'.$fieldName.'" value="'.$value.'" />';
    $html .= '<a id="remove_button" '.(!$value?'class="jg_displaynone" ':'').'title="'.JText::_('JGA_CATMAN_REMOVE_CATTHUMB_TIP').'" href="javascript:joom_clearthumb();"><img src="images/publish_x.png" alt="Remove" /></a>';

    return $html;
  }
}