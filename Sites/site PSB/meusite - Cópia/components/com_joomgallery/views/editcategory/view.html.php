<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/editcategory/view.html.php $
// $Id: view.html.php 2614 2010-12-12 22:22:41Z erftralle $
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
 * HTML View class for the edit view for categories
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewEditcategory extends JoomGalleryView
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
    if(   !$this->_config->get('jg_userspace')
       || ($this->_config->get('jg_showuserpanel') == 2 && $this->_user->get('aid') != 2)
      )
    {
      // You are not allowed...
      $msg = JText::_('ALERTNOTAUTH');
      if(!$this->_user->get('id'))
      {
        $msg .= '<br />' . JText::_('You need to login.');
      }

      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), $msg, 'notice');
    }

    if(!$this->_user->get('id'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_MSG_YOU_ARE_NOT_LOGGED'), 'notice');
    }

    $params           = &$this->_mainframe->getParams();

    // Breadcrumbs
    if($this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();
      $breadcrumbs->addItem(JText::_('JGS_COMMON_USER_PANEL'), 'index.php?view=userpanel');
      $breadcrumbs->addItem(JText::_('JGS_COMMON_CATEGORIES'), 'index.php?view=usercategories');
      if(JRequest::getInt('catid'))
      {
        $breadcrumbs->addItem(JText::_('JGS_EDITCATEGORY_MODIFY_CATEGORY'));
      }
      else
      {
        $breadcrumbs->addItem(JText::_('JGS_COMMON_NEW_CATEGORY'));
      }
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $pathway = null;
    if($this->_config->get('jg_showpathway'))
    {
      $pathway  = '<a href="'.JRoute::_('index.php?view=userpanel').'">'.JText::_('JGS_COMMON_USER_PANEL').'</a>';
      $pathway .= ' &raquo; <a href="'.JRoute::_('index.php?view=usercategories').'">'.JText::_('JGS_COMMON_CATEGORIES').'</a>';
      if(JRequest::getInt('catid'))
      {
        $pathway .= ' &raquo; '.JText::_('JGS_EDITCATEGORY_MODIFY_CATEGORY');
      }
      else
      {
        $pathway .= ' &raquo; '.JText::_('JGS_COMMON_NEW_CATEGORY');
      }
    }

    $backtarget = JRoute::_('index.php?view=userpanel'); //see above
    $backtext   = JText::_('JGS_COMMON_BACK_TO_USER_PANEL');

    $numbers  = JoomHelper::getPicsAndHits($params);

    if(!$params->get('page_title'))
    {
      $params->set('page_title', JText::_('JGS_COMMON_GALLERY'));
    }

    // Load modules at position 'top'
    $modules['top'] = JoomHelper::getRenderedModules('top');
    if(count($modules['top']))
    {
      $params->set('show_top_modules', 1);
    }
    // Load modules at position 'btm'
    $modules['btm'] = JoomHelper::getRenderedModules('btm');
    if(count($modules['btm']))
    {
      $params->set('show_btm_modules', 1);
    }

    $category = &$this->get('Category');

    if(JRequest::getInt('catid') && $category->owner != $this->_user->get('id') && !$this->get('AdminLogged'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_MSG_NOT_ALLOWED_TO_EDIT_IMAGE'), 'notice');
    }

    $lists = array();

    $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $category->published );

    $query  = " SELECT
                  ordering AS value,
                  name AS text
                FROM
                  "._JOOM_TABLE_CATEGORIES;
    if(!$this->get('AdminLogged'))
    {
      $query .= "
                WHERE
                  owner = ".$this->_user->get('id');
    }
    $query .= "
                ORDER BY
                  ordering
              ";
    $orders = JHTML::_('list.genericordering', $query);

    $lists['ordering']  = JHTML::_('select.genericlist', $orders, 'ordering', 'class="inputbox" size="1"',
                                  'value', 'text', intval($category->ordering));

    // TODO: set 'NO USER' in the language file to 'Administrator' or something like that
    #$lists['owner']     = JHTML::_('list.users', 'owner', $item->owner, true, null, 'name', false);

    // TODO: use JHTML::_('list.positions') instead? (but it saves 'left' for example instead of 0)
    /*$align[]        = JHTML::_('select.option','0' , JText::_('JGA_LEFT'));
    $align[]        = JHTML::_('select.option','1' , JText::_('JGA_RIGHT'));
    $align[]        = JHTML::_('select.option','2' , JText::_('JGA_CENTER'));
    $lists['align'] = JHTML::_('select.genericlist', $align, 'img_position', 'class="inputbox" size="1"',
                                'value', 'text', $item->img_position);*/

    #$lists['thumbs'] = JHTML::_('list.images', 'catimage', $category->catimage, null, null/*$this->_config->get('jg_paththumbs').$catpath*/);

    // Administrators may select all categories
    if($this->get('AdminLogged'))
    {
      $lists['catgs'] = JHTML::_('joomselect.categorylist', $category->parent, 'parent', '', $category->cid);
    }
    else
    {
      $lists['catgs'] = JHTML::_('joomselect.usercategorylist', $category->parent, $category->cid, 'parent');
    }

    // If it is allowed to change the access level of the category
    // search the level which is in between of the aid of the user
    // and the level which is set in backend for the parent category
    $lists['access'] = null;
    if($this->_config->get('jg_usercatacc') || $this->get('AdminLogged'))
    {
      $groups = &$this->get('Groups');

      // The select list will be just displayed if more than one access level was found
      if(count($groups) > 1)
      {
        $lists['access'] = JHTML::_('select.genericlist', $groups, 'access',
                                    'class="inputbox" size="1"', 'value', 'text', intval($category->access));
      }
    }

    // The list of the available and allowed category thumbnails will
    // just be created if we are dealing with an existing category
    $lists['thumbs'] = null;
    if($category->cid)
    {
      $thumbs_array = array(JHTML::_('select.option', '', JText::_('JGS_EDITCATEGORY_SELECT_THUMBNAIL')));

      $thumbs = &$this->get('Thumbnails');
      foreach($thumbs as $filename)
      {
        $thumbs_array[] = JHTML::_('select.option', $filename);
      }

      $catpath = JoomHelper::getCatPath($category->cid);

      $lists['thumbs'] = JHTML::_('select.genericlist', $thumbs_array, 'catimage', 'class="inputbox" size="1"'
      . " onchange=\"javascript:"
      . "if (document.usercatForm.catimage.options[selectedIndex].value != '') {"
      .   "document.imagelib.src='".$this->_ambit->get('thumb_url').$category->catpath."' "
      .   "+ document.usercatForm.catimage.options[selectedIndex].value"
      . "} else {"
      .   "document.imagelib.src='".JURI::root()."images/blank.png'}\"",
        'value', 'text', $category->catimage);
    }

    /*// If the category list is empty, the image is in a backend category
    // which isn't available for the user anymore or it is the only category.
    // In this case simply display the name of the category.
    if(!$lists['catgs'])
    {
      $row = & JTable::getInstance('joomgallerycategories', 'Table');
      $row->load($category->parent);
      $lists['catgs'] = $row->name;
    }*/

    $this->assignRef('params',          $params);
    $this->assignRef('category',        $category);
    $this->assignRef('lists',           $lists);
    $this->assignRef('pathway',         $pathway);
    $this->assignRef('modules',         $modules);
    $this->assignRef('backtarget',      $backtarget);
    $this->assignRef('backtext',        $backtext);
    $this->assignRef('numberofpics',    $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',  $numbers[1]);
    }

    $this->_doc->addScript($this->_ambit->getScript('userpanel.js'));
    $this->_doc->addScriptDeclaration('    var jg_ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');
    $this->_ambit->script('JGS_COMMON_ALERT_CATEGORY_MUST_HAVE_TITLE');

    parent::display($tpl);
  }
}