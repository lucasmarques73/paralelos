<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/userpanel/view.html.php $
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
 * HTML View class for the user panel view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewUserpanel extends JoomGalleryView
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

    $params = &$this->_mainframe->getParams();

    // Breadcrumbs
    if($this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();
      $breadcrumbs->addItem(JText::_('JGS_COMMON_USER_PANEL'));
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $pathway  = JText::_('JGS_COMMON_USER_PANEL');

    $backtarget = JRoute::_('index.php?view=gallery');
    $backtext   = JText::_('JGS_COMMON_BACK_TO_GALLERY');

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

    // Button 'Categories' will just be displayed if there are categories
    // created by the user which additionally have a valid access level
    // or if there is at least one backend category with a valid access level.
    // For administrators all categories are displayed and the button is
    // always displayed for them.
    if($this->get('AdminLogged'))
    {
      $params->set('show_categories_button', 1);
      $params->set('show_upload_button', 1);
    }
    else
    {
      // Get user categories which already exist and which have a valid
      // access level for the user and additionally all backend categories
      // which have a valid access level for the user and which are
      // approved in backend for the frontend.
      $result           = &$this->get('Categories');
      $jg_category      = $this->_config->get('jg_category');
      $jg_usercategory  = $this->_config->get('jg_usercategory');
      if(!empty($jg_category))
      {
        $jgcats = explode(',', $this->_config->get('jg_category'));
      }
      else
      {
        $jgcats = array();
      }
      if($this->_config->get('jg_usercat') && !empty($jg_usercategory))
      {
        $jgusercats = explode(',', $this->_config->get('jg_usercategory'));
      }
      else
      {
        $jgusercats = array();
      }

      // Display upload button just if there are backend categories
      // which are selected to be allowed to upload to or if there
      // are categories created by the user.
      // Remove catids of jg_usercat from $result if existent, but just if the
      // categorie is not approved for the frontend upload in the same time.
      $resultarr = $result;
      if($this->_config->get('jg_usercat') && !empty($jg_usercategory))
      {
        $resultarr = array_diff($resultarr, array_diff($jgusercats, $jgcats));
      }
      if(count($resultarr))
      {
        $params->set('show_upload_button', 1);
      }

      // Check whether the categories button will be displayed.
      // Remove catids of jg_category from $result if existent, but just
      // if the category is not approved for being parent category for
      // user categories in backend in the same time.
      if($this->_config->get('jg_usercat'))
      {
        $resultarr = $result;
        if(!empty($jg_category))
        {
          $resultarr = array_diff($resultarr, array_diff($jgusercats, $jgcats));
        }
        if(count($resultarr))
        {
          $params->set('show_categories_button', 1);
        }
      }
    }

    // Prepare pagelimit choices
    $default_limit  = $this->_mainframe->getCfg('list_limit');
    $limit          = $this->_mainframe->getUserStateFromRequest('joom.userpanel.limit', 'limit', $default_limit, 'int');
    $limitstart     = JRequest::getInt('limitstart', 1);#$this->_mainframe->getUserStateFromRequest('joom.userpanel.limitstart', 'limitstart', 0, 'int');

    // In case limit has been changed, adjust limitstart accordingly
    $limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );

    // Prepare category and search choices
    #$catid          = $this->_mainframe->getUserStateFromRequest('joom.userpanel.catid', 'catid', 0);
    #$searchtext     = $this->_mainframe->getUserStateFromRequest('joom.userpanel.search', 'search', '');
    #$filter         = $this->_mainframe->getUserStateFromRequest('joom.userpanel.filter', 'filter', 0);
    $ordering       = $this->_mainframe->getUserStateFromRequest('joom.userpanel.ordering','ordering', 0);

    $filter       = JRequest::getInt('filter', null);
    $filter_state = $this->_mainframe->getUserState('joom.userpanel.filter');
    if(is_null($filter))
    {
      $filter = $filter_state;
      if(is_null($filter))
      {
        $filter = 0;
      }
    }
    else
    {
      $this->_mainframe->setUserState('joom.userpanel.filter', $filter);
      if($filter != $filter_state)
      {
        // Number of images changes now, so go to first page
        $limitstart = 1;
      }
    }

    JRequest::setVar('limitstart', $limitstart);

    #JRequest::setVar('catid',     (int) $catid);
    JRequest::setVar('limit',     (int) $limit);
    #JRequest::setVar('search',    $searchtext);
		JRequest::setVar('ordering',  (int) $ordering);
		JRequest::setVar('filter',    $filter);

    $lists = array();

    // Sortierung der Bilder
    $o_options[] = JHTML::_('select.option', 0, JText::_('JGS_COMMON_OPTION_ORDERBY_DATE_ASC'));
    $o_options[] = JHTML::_('select.option', 1, JText::_('JGS_COMMON_OPTION_ORDERBY_DATE_DESC'));
    $o_options[] = JHTML::_('select.option', 2, JText::_('JGS_COMMON_OPTION_ORDERBY_TITLE_ASC'));
    $o_options[] = JHTML::_('select.option', 3, JText::_('JGS_COMMON_OPTION_ORDERBY_TITLE_DESC'));
    $o_options[] = JHTML::_('select.option', 4, JText::_('JGS_COMMON_OPTION_ORDERBY_HITS_ASC'));
    $o_options[] = JHTML::_('select.option', 5, JText::_('JGS_COMMON_OPTION_ORDERBY_HITS_DESC'));
    $o_options[] = JHTML::_('select.option', 6, JText::_('JGS_COMMON_OPTION_ORDERBY_CATNAME_ASC') .' - '. JText::_('JGS_COMMON_OPTION_ORDERBY_TITLE_ASC'));
    $o_options[] = JHTML::_('select.option', 7, JText::_('JGS_COMMON_OPTION_ORDERBY_CATNAME_DESC') .' - '. JText::_('JGS_COMMON_OPTION_ORDERBY_TITLE_DESC'));

    $lists['ordering'] = JHTML::_('select.genericlist', $o_options, 'ordering',
            'class="inputbox" size="1" onchange="form.submit();"',
            'value', 'text', $ordering);

    // Filter
    $s_options[] = JHTML::_('select.option', 0, JText::_('JGS_COMMON_ALL'));
    $s_options[] = JHTML::_('select.option', 1, JText::_('JGS_COMMON_OPTION_APPROVED_ONLY'));
    $s_options[] = JHTML::_('select.option', 2, JText::_('JGS_COMMON_OPTION_NOT_APPROVED_ONLY'));

    $lists['filter'] = JHTML::_('select.genericlist', $s_options, 'filter',
            'class="inputbox" size="1" onchange="form.submit();"',
            'value', 'text', $filter);

    // Get data from the model
    $rows   = &$this->get('Images');
    $total  = &$this->get('Total');

    // Create the navigation, only if images exist
    $pagination = null;
    if($total)
    {
      jimport('joomla.html.pagination');
      $pagination = new JPagination($total, $limitstart, $limit);
    }

    $this->assignRef('params',          $params);
    $this->assignRef('rows',            $rows);
    $this->assignRef('pagination',      $pagination);
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
    parent::display($tpl);
  }
}