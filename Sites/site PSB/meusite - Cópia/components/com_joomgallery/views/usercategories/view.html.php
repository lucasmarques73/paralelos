<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/usercategories/view.html.php $
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
 * HTML View class for the user categories list view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewUsercategories extends JoomGalleryView
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
      $breadcrumbs->addItem(JText::_('JGS_COMMON_CATEGORIES'));
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $pathway = null;
    if($this->_config->get('jg_showpathway'))
    {
      $pathway  = '<a href="'.JRoute::_('index.php?view=userpanel').'">'.JText::_('JGS_COMMON_USER_PANEL').'</a>';
      $pathway .= ' &raquo; '.JText::_('JGS_COMMON_CATEGORIES');
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

    /*//Prepare pagelimit choices
    $default_limit  = $this->_mainframe->getCfg('list_limit');
    $limit          = $this->_mainframe->getUserStateFromRequest('joom.userpanel.limit', 'limit', $default_limit, 'int');
    $limitstart     = JRequest::getInt('limitstart', 1);#$this->_mainframe->getUserStateFromRequest('joom.userpanel.limitstart', 'limitstart', 0, 'int');

    // In case limit has been changed, adjust limitstart accordingly
    $limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );

    //Prepare category and search choices
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
        //number of images changes now, so go to first page
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

    //Sortierung der Bilder
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

    //Filter
    $s_options[] = JHTML::_('select.option', 0, JText::_('JGS_COMMON_ALL')); 
    $s_options[] = JHTML::_('select.option', 1, JText::_('JGS_COMMON_OPTION_APPROVED_ONLY'));
    $s_options[] = JHTML::_('select.option', 2, JText::_('JGS_COMMON_OPTION_NOT_APPROVED_ONLY'));

    $lists['filter'] = JHTML::_('select.genericlist', $s_options, 'filter',
            'class="inputbox" size="1" onchange="form.submit();"',
            'value', 'text', $filter);*/

    // Get data from the model
    $rows   = &$this->get('Categories');
    #$total  = &$this->get('Total');

    if($this->_config->get('jg_newpicnote') && !$this->get('AdminLogged'))
    {
      $params->set('show_categories_notice', 1);
    }

    if(     $this->get('AdminLogged')
        || ($this->_config->get('jg_maxusercat') - count($rows)) > 0
      )
    {
      $params->set('show_category_button', 1);
    }

    // Create the navigation, only if images exist
    $pagination = null;
    /*if($total)
    {
      jimport('joomla.html.pagination');
      $pagination = new JPagination($total, $limitstart, $limit);
    }*/

    $this->assignRef('params',          $params);
    $this->assignRef('rows',            $rows);
    $this->assignRef('pagination',      $pagination);
    #$this->assignRef('lists',           $lists);
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