<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/category/view.html.php $
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
 * HTML View class for the category edit view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewCategory extends JoomGalleryView
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
    jimport('joomla.html.pane');

    $item   = & $this->get('Data');
    $isNew  = ($item->cid < 1);

    $title = JText::_('JGA_CATMAN_CATEGORY_MANAGER').' :: ';
    if($isNew)
    {
      $title .= JText::_('JGA_CATMAN_ADD_CATEGORY');
      $item->published = 1;
    }
    else
    {
      $title .= JText::_('JGA_CATMAN_EDIT_CATEGORY');
    }
    $title .= ' ' .JText::_('JGA_COMMON_CATEGORY');

    JToolBarHelper::title($title);
    JToolbarHelper::save('save', 'JGA_COMMON_TOOLBAR_SAVE');
    JToolbarHelper::apply('apply', 'JGA_COMMON_TOOLBAR_APPLY');
    JToolbarHelper::cancel('cancel', 'JGA_COMMON_TOOLBAR_CANCEL');
    JToolbarHelper::spacer();

    $this->_doc->addScriptDeclaration('    var ffwrong = "'.$this->_config->get('jg_wrongvaluecolor').'";');

    $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published );
    $lists['catgs']     = JHTML::_('joomselect.categorylist', $item->parent, 'parent', 'id="parent"', $item->cid);

    $orderings = $this->get('Orderings');
    $script = '    var originalOrder   = '.$item->ordering.';
    var originalParent  = '.$item->parent.';
    var orders          = new Array();';
    $i = 0;
    foreach($orderings as $k => $items)
    {
      foreach($items as $v)
      {
        $script .= '
    orders['.$i++.'] = new Array("'.$k.'", "'.$v->value.'", "'.$v->text.'");';
      }
    }
    $this->_doc->addScriptDeclaration($script);

    if($item->catimage)
    {
      $imgsource = $this->_ambit->getImg('thumb_url', $item->catimage, null, $item->cid);
    }
    else
    {
      $imgsource = '../images/blank.png';
    }

    $editor = & JFactory::getEditor();

    // Create the form
    $form = new JParameter('', JPATH_COMPONENT.DS.'elements'.DS.'category.xml');
    $form->set('owner',         $item->owner);
    $form->set('access',        $item->access);
    $form->set('ordering',      $item->ordering);
    $form->set('catimage',      $item->catimage);
    $form->set('img_position',  $item->img_position);
    $form->set('metadesc',      $item->metadesc);
    $form->set('metakey',       $item->metakey);

    $pane = &JPane::getInstance('sliders', array('allowAllClose' => true));
    $this->assignRef('item',      $item);
    $this->assignRef('editor',    $editor);
    $this->assignRef('lists',     $lists);
    $this->assignRef('isNew',     $isNew);
    $this->assignRef('imgsource', $imgsource);
    $this->assignRef('form',      $form);
    $this->assignRef('pane',      $pane);

    $this->_ambit->script('JGA_CATMAN_ALERT_CATEGORY_MUST_HAVE_TITLE');

    parent::display($tpl);
  }
}