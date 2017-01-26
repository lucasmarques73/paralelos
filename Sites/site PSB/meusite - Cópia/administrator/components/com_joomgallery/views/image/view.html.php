<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/image/view.html.php $
// $Id: view.html.php 2566 2010-11-03 21:10:42Z mab $
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
 * HTML View class for the image edit view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewImage extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display($tpl = null)
  {
    jimport('joomla.filesystem.file');
    jimport('joomla.html.pane');

    $item   = & $this->get('Data');
    $isNew  = ($item->id < 1);

    $title = JText::_('JGA_IMGMAN_IMAGE_MANAGER').' :: ';

    // Set vote average to 0, it will only be used if we are editing an existent image
    $voteavg = 0;

    if($isNew)
    {
      $title .= JText::_('JGA_IMGMAN_IMAGE_ADD');
      $lists['detail_cats'] = JHTML::_('joomselect.categorylist', $item->detail_catid, 'detail_catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"');
      // Categories drop down for thumbnail
      $lists['thumb_cats']  = JHTML::_('joomselect.categorylist', $item->thumb_catid, 'thumb_catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"');

      // Create the path for original and detail images
      $detail_catpath = JoomHelper::getCatPath($item->detail_catid);
      $detail_path    = $this->_ambit->get('img_path').$detail_catpath;

      // Read the folder for original and detail images
      $detail_files  = JFolder::files($detail_path, '\.bmp$|\.gif$|\.jpg$|\.png$|\.jpeg$|\.jpe$');

      // Array of images
      $images = array(JHTML::_('select.option', '', JText::_('JGA_COMMON_PLEASE_SELECT_IMAGE')));

      foreach($detail_files as $file)
      {
        $images[] = JHTML::_('select.option', $file);
      }

      // TODO: Replace image and thumbnail select list generation with JHTML::_('list.images');
      // $lists['thumbs'] = JHTML::_('list.images', 'catimage', $item->catimage, null, null/*$this->_config->get('jg_paththumbs').$catpath*/);
      $lists['imagelist'] = JHTML::_('select.genericlist', $images, 'imgfilename',
                                   "class=\"inputbox\" size=\"1\" "
                                   . "onchange=\"javascript:"
                                   . "if (document.forms[0].imgfilename.options[selectedIndex].value!='') {"
                                   .   "document.imagelib2.src='".$this->_ambit->getImg('img_url', $item->imgfilename, null, $item->detail_catid)."' "
                                   .   "+ document.forms[0].imgfilename.options[selectedIndex].value;"
                                   .   "document.adminForm.submit();"
                                   . "} else {"
                                   .   "document.imagelib2.src='../images/M_images/blank.png'"
                                   . "}\"",'value', 'text', $item->imgfilename);

      // Create the path for the thumbnails
      $thumb_catpath  = JoomHelper::getCatPath($item->thumb_catid);
      $thumb_path     = $this->_ambit->get('img_path').$thumb_catpath;

      // Read the folder for the thumbnails
      $thumb_files  = JFolder::files($thumb_path, '\.bmp$|\.gif$|\.jpg$|\.png$|\.jpeg$|\.jpe$');

      // Array of thumbnails
      $thumbs = array(JHTML::_('select.option', '', JText::_('JGA_IMGMAN_PLEASE_SELECT_THUMBNAIL')));

      foreach($thumb_files as $file)
      {
        $thumbs[] = JHTML::_('select.option', $file);
      }

      $lists['thumblist'] = JHTML::_('select.genericlist', $thumbs, 'imgthumbname',
                                     "class=\"inputbox\" size=\"1\""
                                     . " onchange=\"javascript:"
                                     . "if (document.forms[0].imgthumbname.options[selectedIndex].value!='') {"
                                     .   "document.imagelib.src='".$this->_ambit->getImg('thumb_url', $item->imgthumbname, null, $item->thumb_catid)."' "
                                     .   "+ document.forms[0].imgthumbname.options[selectedIndex].value"
                                     . "} else {"
                                     .   "document.imagelib.src='../images/M_images/blank.png'"
                                     . "}\"",
                                     'value', 'text', $item->imgthumbname);

      // If original exists
      if(JFile::exists($this->_ambit->getImg('orig_path', $item->imgfilename, null, $item->detail_catid)))
      {
        // Show it as existent
        $orig_msg = '<div style="color:green;">[ '.JText::_('JGA_IMGMAN_ORIGINAL_EXIST').' ]</div>';
      }
      else
      {
        // Or otherwise as not existent
        $orig_msg = '<div style="color:red;">[ '.JText::_('JGA_IMGMAN_ORIGINAL_NOT_EXIST').' ]</div>';
      }
      $this->assignRef('orig_msg',    $orig_msg);

      // Drop down list for choosing original image
      $lists['copy_original'] = JHTML::_('select.booleanlist', 'copy_original',
                                         'class="inputbox" size="1"', $item->copy_original);
    }
    else
    {
      $title .= JText::_('JGA_IMGMAN_IMAGE_EDIT');
      if($item->imgvotes > 0)
      {
        $voteavg = JoomHelper::getRating($item->id);
      }
    }

    JToolBarHelper::title($title);
    JToolbarHelper::save('save', 'JGA_COMMON_TOOLBAR_SAVE');
    JToolbarHelper::apply('apply', 'JGA_COMMON_TOOLBAR_APPLY');
    JToolbarHelper::cancel('cancel', 'JGA_COMMON_TOOLBAR_CANCEL');
    JToolbarHelper::spacer();

    $lists['cats']        = JHTML::_('joomselect.categorylist', $item->catid , 'catid', 'size="1"');
    $lists['published']   = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published);
    $lists['access']      = '';#JHTML::_('list.accesslevel', $item);
/*
    $query  = "SELECT ordering AS value, imgtitle AS text
                FROM #__joomgallery
                ORDER BY ordering";
    $orders = JHTML::_('list.genericordering', $query);

    $lists['ordering']  = JHTML::_('select.genericlist', $orders, 'ordering', 'class="inputbox" size="1"',
                                  'value', 'text', intval($item->ordering));
*/
    $lists['owner']     = JHTML::_('list.users', 'owner', $item->owner, true, null, 'name', false);

    if($item->imgfilename)
    {
      if($isNew)
      {
        $imgsource = $this->_ambit->getImg('img_url', $item->imgfilename, null, $item->detail_catid);
      }
      else
      {
        $imgsource = $this->_ambit->getImg('img_url', $item->imgfilename, null, $item->catid);
      }
    }
    else
    {
      $imgsource = '../images/blank.png';
    }

    if($item->imgthumbname)
    {
      if($isNew)
      {
        $thumbsource = $this->_ambit->getImg('thumb_url', $item->imgthumbname, null, $item->thumb_catid);
      }
      else
      {
        $thumbsource = $this->_ambit->getImg('thumb_url', $item->imgthumbname, null, $item->catid);
      }
    }
    else
    {
      $thumbsource = '../images/blank.png';
    }

    $editor = & JFactory::getEditor();

    // Create the form
    $form = new JParameter('', JPATH_COMPONENT.DS.'elements'.DS.'image.xml');
    $form->set('owner',     $item->owner);
    $form->set('imgauthor', $item->imgauthor);
    $form->set('metadesc',  $item->metadesc);
    $form->set('metakey',   $item->metakey);

    $pane = &JPane::getInstance('sliders', array('allowAllClose' => true));

    $this->assignRef('item',        $item);
    $this->assignRef('editor',      $editor);
    $this->assignRef('lists',       $lists);
    $this->assignRef('orig_msg',    $orig_msg);
    $this->assignRef('isNew',       $isNew);
    $this->assignRef('imgsource',   $imgsource);
    $this->assignRef('thumbsource', $thumbsource);
    $this->assignRef('voteavg',     $voteavg);
    $this->assignRef('form',        $form);
    $this->assignRef('pane',        $pane);

    // Language
    $this->_ambit->script('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');
    $this->_ambit->script('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY');
    $this->_ambit->script('JGA_IMGMAN_ALERT_SELECT_IMAGE_FILENAME');
    $this->_ambit->script('JGA_IMGMAN_ALERT_SELECT_THUMBNAIL_FILENAME');
    $this->_ambit->script('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');

    $this->_doc->addScriptDeclaration('    var ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');

    parent::display($tpl);
  }
}
