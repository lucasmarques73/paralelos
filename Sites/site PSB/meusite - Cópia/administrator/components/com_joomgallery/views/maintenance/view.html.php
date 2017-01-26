<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/views/maintenance/view.html.php $
// $Id: view.html.php 2562 2010-11-01 14:17:10Z erftralle $
/******************************************************************************\
**   JoomGallery  1.5                                                         **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                          **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the maintenance manager view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewMaintenance extends JoomGalleryView
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
    JToolBarHelper::title(JText::_('JGA_MAIMAN_MAINTENANCE_MANAGER'), 'mediamanager');
    JToolbarHelper::custom('cpanel', 'config.png', 'config.png', 'JGA_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    $this->_doc->addStyleDeclaration('    .icon-32-refresh {
      background-image:url(templates/khepri/images/toolbar/icon-32-refresh.png);
    }');

    $lists = array();

    jimport('joomla.html.pane');
    $tabs = array('images'      => 0,
                  'categories'  => 1,
                  'orphans'     => 2,
                  'folders'     => 3,
                  'votes'       => 4,
                  'nametags'    => 5,
                  'comments'    => 6,
                  'database'    => 7
                  );
    $tab  = JRequest::getCmd('tab');
    if(!$tab || !isset($tabs[$tab]))
    {
      $tab = 'images';
    }
    $pane = & JPane::getInstance('tabs', array('startOffset' => $tabs[$tab]));

    $checked = $this->_mainframe->getUserState('joom.maintenance.checked');

    $default_limit  = $this->_mainframe->getCfg('list_limit');

    switch($tab)
    {
      case 'categories':
        // Select list of the batch jobs for the categories
        $b_options              = array();
        $b_options[]            = JHTML::_('select.option', '',                   JText::_('JGA_MAIMAN_SELECT_JOB'));
        $b_options[]            = JHTML::_('select.option', 'setuser',            JText::_('JGA_MAIMAN_OPTION_SET_NEW_USER'));
        $b_options[]            = JHTML::_('select.option', 'addorphanedfolders', JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANED_FOLDERS'));
        $b_options[]            = JHTML::_('select.option', 'create',             JText::_('JGA_MAIMAN_OPTION_CREATE_FOLDERS'));
        $b_options[]            = JHTML::_('select.option', 'removecategory',     JText::_('JGA_MAIMAN_CT_OPTION_REMOVE_CATEGORIES'));
        $lists['cat_jobs']      = JHTML::_( 'select.genericlist', $b_options, 'job',
                                            'class="inputbox" size="1" onchange="joom_selectbatchjob(this.value);"',
                                            'value', 'text');

        // Prepare pagelimit choices for the categories
        $default_limit  = $this->_mainframe->getCfg('list_limit');
        $cat_limit      = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.limit',       'limit',      $default_limit, 'int');
        $cat_limitstart = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.limitstart',  'limitstart', 0,              'int');

        // Prepare category and search choices for the categories
        $cat_catid      = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.catid',     'cat_catid',    0,  'int');
        $cat_searchtext = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.search',    'cat_search',   '');
        $cat_filter     = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.filter',    'cat_filter',   0,  'int');
        $cat_ordering   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.categories.ordering',  'cat_ordering', 0,  'int');

        JRequest::setVar('cat_catid',       (int) $cat_catid);
        JRequest::setVar('cat_limit',       (int) $cat_limit);
        JRequest::setVar('cat_limitstart',  (int) $cat_limitstart);
        JRequest::setVar('cat_search',      $cat_searchtext);
        JRequest::setVar('cat_ordering',    (int) $cat_ordering);
        JRequest::setVar('cat_filter',      $cat_filter);

        $this->assignRef('cat_searchtext',  $cat_searchtext);

        $lists['cat_cats']      = JHTML::_( 'joomselect.categorylist', $cat_catid, 'cat_catid',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"');

        $f_options              = array();
        $f_options[]            = JHTML::_('select.option', 0, JText::_('JGA_COMMON_OPTION_ALL_IMAGES'));
        $f_options[]            = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_MISSING_THUMB_FOLDER_ONLY'));
        $f_options[]            = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OPTION_MISSING_IMG_FOLDER_ONLY'));
        $f_options[]            = JHTML::_('select.option', 3, JText::_('JGA_MAIMAN_OPTION_MISSING_ORIG_FOLDER_ONLY'));
        $f_options[]            = JHTML::_('select.option', 4, JText::_('JGA_MAIMAN_OPTION_MISSING_USER_ONLY'));
        $lists['cat_filter']    = JHTML::_( 'select.genericlist', $f_options, 'cat_filter',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                            'value', 'text', $cat_filter);

        $o_options              = array();
        $o_options[]            = JHTML::_('select.option', 0, JText::_('JGA_CATMAN_ORDERBY_CATNAME_ASC'));
        $o_options[]            = JHTML::_('select.option', 1, JText::_('JGA_CATMAN_ORDERBY_CATNAME_DESC'));
        $lists['cat_ordering']  = JHTML::_( 'select.genericlist', $o_options, 'cat_ordering',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                            'value', 'text', $cat_ordering);

        if(!is_null($checked))
        {
          // Get data from the model
          $items      = & $this->get('Categories');
          $total      = & $this->get('TotalCategories');
          $limitstart = $cat_limitstart;
          $limit      = $cat_limit;
        }
        break;
      case 'orphans':
        // Select list of the batch jobs for the orphans
        $b_options              = array();
        $b_options[]            = JHTML::_('select.option', '',                 JText::_('JGA_MAIMAN_SELECT_JOB'));
        $b_options[]            = JHTML::_('select.option', 'addorphan',        JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANS'));
        $b_options[]            = JHTML::_('select.option', 'applysuggestions', JText::_('JGA_MAIMAN_APPLY_SUGGESTIONS'));
        $b_options[]            = JHTML::_('select.option', 'deleteorphan',     JText::_('JGA_MAIMAN_REMOVE_ORPHANS'));
        $lists['orphan_jobs']   = JHTML::_( 'select.genericlist', $b_options, 'job',
                                            'class="inputbox" size="1"',
                                            'value', 'text');

        // Prepare pagelimit choices for the orphans
        $orphan_limit       = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.limit',      'limit',      $default_limit, 'int');
        $orphan_limitstart  = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.limitstart', 'limitstart', 0,              'int');

        // Prepare category and search choices for the orphans
        $orphan_proposal   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.proposal',  'orphan_proposal',  0,  'int');
        $orphan_searchtext = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.search',    'orphan_search',    '');
        $orphan_filter     = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.filter',    'orphan_filter',    0,  'int');
        $orphan_ordering   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.orphans.ordering',  'orphan_ordering',  0,  'int');

        JRequest::setVar('orphan_proposal',   (int) $orphan_proposal);
        JRequest::setVar('orphan_limit',      (int) $orphan_limit);
        JRequest::setVar('orphan_limitstart', (int) $orphan_limitstart);
        JRequest::setVar('orphan_search',     $orphan_searchtext);
        JRequest::setVar('orphan_ordering',   (int) $orphan_ordering);
        JRequest::setVar('orphan_filter',     $orphan_filter);

        $this->assignRef('orphan_searchtext', $orphan_searchtext);

        $p_options                = array();
        $p_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OPTION_ALL_FILES'));
        $p_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_PROPOSAL_AVAILABLE'));
        $p_options[]              = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OPTION_NO_PROPOSAL_AVAILABLE'));
        $lists['orphan_proposal'] = JHTML::_( 'select.genericlist', $p_options, 'orphan_proposal',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $orphan_proposal);

        $f_options                = array();
        $f_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OPTION_ALL_FILES'));
        $f_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_TYPE_THUMB_ONLY'));
        $f_options[]              = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OPTION_TYPE_IMG_ONLY'));
        $f_options[]              = JHTML::_('select.option', 3, JText::_('JGA_MAIMAN_OPTION_TYPE_ORIG_ONLY'));
        $f_options[]              = JHTML::_('select.option', 4, JText::_('JGA_MAIMAN_OPTION_TYPE_UNKNOWN_ONLY'));
        $lists['orphan_filter']   = JHTML::_( 'select.genericlist', $f_options, 'orphan_filter',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $orphan_filter);

        $o_options                = array();
        $o_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OPTION_ORDERBY_FILENAME_ASC'));
        $o_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_ORDERBY_FILENAME_DESC'));
        $lists['orphan_ordering'] = JHTML::_( 'select.genericlist', $o_options, 'orphan_ordering',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $orphan_ordering);

        if(!is_null($checked))
        {
          // Get data from the model
          $items      = & $this->get('Orphans');
          $total      = & $this->get('TotalOrphans');
          $limitstart = $orphan_limitstart;
          $limit      = $orphan_limit;
        }
        break;
      case 'folders':
        // Select list of the batch jobs for the orphans
        $b_options              = array();
        $b_options[]            = JHTML::_('select.option', '',                         JText::_('JGA_MAIMAN_SELECT_JOB'));
        $b_options[]            = JHTML::_('select.option', 'addorphanedfolder',        JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANED_FOLDERS'));
        $b_options[]            = JHTML::_('select.option', 'applyfoldersuggestions',   JText::_('JGA_MAIMAN_APPLY_SUGGESTIONS'));
        $b_options[]            = JHTML::_('select.option', 'deleteorphanedfolder',     JText::_('JGA_MAIMAN_OF_OPTION_REMOVE_ORPHANED_FOLDERS'));
        $lists['folder_jobs']   = JHTML::_( 'select.genericlist', $b_options, 'job',
                                            'class="inputbox" size="1"',
                                            'value', 'text');

        // Prepare pagelimit choices for the orphans
        $folder_limit       = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.limit',       'limit',      $default_limit, 'int');
        $folder_limitstart  = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.limitstart',  'limitstart', 0,              'int');

        // Prepare category and search choices for the orphans
        $folder_proposal   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.proposal', 'folder_proposal',  0,  'int');
        $folder_searchtext = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.search',   'folder_search',    '');
        $folder_filter     = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.filter',   'folder_filter',    0,  'int');
        $folder_ordering   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.folder.ordering', 'folder_ordering',  0,  'int');

        JRequest::setVar('folder_proposal',   (int) $folder_proposal);
        JRequest::setVar('folder_limit',      (int) $folder_limit);
        JRequest::setVar('folder_limitstart', (int) $folder_limitstart);
        JRequest::setVar('folder_search',     $folder_searchtext);
        JRequest::setVar('folder_ordering',   (int) $folder_ordering);
        JRequest::setVar('folder_filter',     $folder_filter);

        $this->assignRef('folder_searchtext', $folder_searchtext);

        $p_options                = array();
        $p_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OF_OPTION_ALL_FOLDERS'));
        $p_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OF_OPTION_PROPOSAL_AVAILABLE_FOLDERS'));
        $p_options[]              = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OF_OPTION_NO_PROPOSAL_AVAILABLE_FOLDERS'));
        $lists['folder_proposal'] = JHTML::_( 'select.genericlist', $p_options, 'folder_proposal',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $folder_proposal);

        $f_options                = array();
        $f_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OPTION_ALL_FILES'));
        $f_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_TYPE_THUMB_ONLY'));
        $f_options[]              = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OPTION_TYPE_IMG_ONLY'));
        $f_options[]              = JHTML::_('select.option', 3, JText::_('JGA_MAIMAN_OPTION_TYPE_ORIG_ONLY'));
        $f_options[]              = JHTML::_('select.option', 4, JText::_('JGA_MAIMAN_OPTION_TYPE_UNKNOWN_ONLY'));
        $lists['folder_filter']   = JHTML::_( 'select.genericlist', $f_options, 'folder_filter',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $folder_filter);

        $o_options                = array();
        $o_options[]              = JHTML::_('select.option', 0, JText::_('JGA_MAIMAN_OF_OPTION_ORDERBY_FOLDERNAME_ASC'));
        $o_options[]              = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OF_OPTION_ORDERBY_FOLDERNAME_DESC'));
        $lists['folder_ordering'] = JHTML::_( 'select.genericlist', $o_options, 'folder_ordering',
                                              'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                              'value', 'text', $folder_ordering);

        if(!is_null($checked))
        {
          // Get data from the model
          $items      = & $this->get('OrphanedFolders');
          $total      = & $this->get('TotalOrphanedFolders');
          $limitstart = $folder_limitstart;
          $limit      = $folder_limit;
        }
        break;
      default:
        // Select list of the batch jobs for the images
        $b_options              = array();
        $b_options[]            = JHTML::_('select.option', '',           JText::_('JGA_MAIMAN_SELECT_JOB'));
        $b_options[]            = JHTML::_('select.option', 'setuser',    JText::_('JGA_MAIMAN_OPTION_SET_NEW_USER'));
        $b_options[]            = JHTML::_('select.option', 'addorphans', JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANS'));
        $b_options[]            = JHTML::_('select.option', 'recreate',   JText::_('JGA_MAIMAN_OPTION_RECREATE'));
        $b_options[]            = JHTML::_('select.option', 'remove',     JText::_('JGA_MAIMAN_OPTION_REMOVE_IMAGES'));
        $lists['img_jobs']    = JHTML::_( 'select.genericlist', $b_options, 'job',
                                            'class="inputbox" size="1" onchange="joom_selectbatchjob(this.value);"',
                                            'value', 'text');

        // Prepare pagelimit choices for the images
        $img_limit      = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.limit',       'limit',      $default_limit, 'int');
        $img_limitstart = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.limitstart',  'limitstart', 0,              'int');

        // Prepare category and search choices for the images
        $img_catid      = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.catid',     'img_catid',    0,  'int');
        $img_searchtext = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.search',    'img_search',   '');
        $img_filter     = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.filter',    'img_filter',   0,  'int');
        $img_ordering   = $this->_mainframe->getUserStateFromRequest('joom.maintenance.display.images.ordering',  'img_ordering', 0,  'int');

        JRequest::setVar('img_catid',       (int) $img_catid);
        JRequest::setVar('img_limit',       (int) $img_limit);
        JRequest::setVar('img_limitstart',  (int) $img_limitstart);
        JRequest::setVar('img_search',      $img_searchtext);
        JRequest::setVar('img_ordering',    (int) $img_ordering);
        JRequest::setVar('img_filter',      $img_filter);

        $this->assignRef('img_searchtext',  $img_searchtext);

        $lists['img_cats']      = JHTML::_( 'joomselect.categorylist', $img_catid, 'img_catid',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"');

        $f_options              = array();
        $f_options[]            = JHTML::_('select.option', 0, JText::_('JGA_COMMON_OPTION_ALL_IMAGES'));
        $f_options[]            = JHTML::_('select.option', 1, JText::_('JGA_MAIMAN_OPTION_MISSING_THUMB_ONLY'));
        $f_options[]            = JHTML::_('select.option', 2, JText::_('JGA_MAIMAN_OPTION_MISSING_IMG_ONLY'));
        $f_options[]            = JHTML::_('select.option', 3, JText::_('JGA_MAIMAN_OPTION_MISSING_ORIG_ONLY'));
        $f_options[]            = JHTML::_('select.option', 4, JText::_('JGA_MAIMAN_OPTION_MISSING_USER_ONLY'));
        $lists['img_filter']    = JHTML::_( 'select.genericlist', $f_options, 'img_filter',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                            'value', 'text', $img_filter);

        $o_options              = array();
        $o_options[]            = JHTML::_('select.option', 0, JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_ASC'));
        $o_options[]            = JHTML::_('select.option', 1, JText::_('JGA_COMMON_OPTION_ORDERBY_IMGTITLE_DESC'));
        $lists['img_ordering']  = JHTML::_( 'select.genericlist', $o_options, 'img_ordering',
                                            'class="inputbox" size="1" onchange="document.adminForm.submit();"',
                                            'value', 'text', $img_ordering);

        if(!is_null($checked))
        {
          // Get data from the model
          $items      = & $this->get('Images');
          $total      = & $this->get('TotalImages');
          $limitstart = $img_limitstart;
          $limit      = $img_limit;
        }
        break;
    }

    if(!is_null($checked))
    {
      jimport('joomla.html.pagination');$limit;
      $pagination = new JPagination($total, $limitstart, $limit);

      $this->assignRef('items',       $items);
      $this->assignRef('pagination',  $pagination);
    }

    $information = $this->get('Information');
    $image    = JURI::root(true).'/includes/js/ThemeOffice/warning.png';
    $warning  = '<img src="'.$image.'" border="0" alt="Warning" height="10" width="10" />';
    foreach($information as $key => $found)
    {
      if($found)
      {
        $information[$key] = '&nbsp;'.$warning;
      }
      else
      {
        $information[$key] = '';
      }
    }

    $this->assignRef('current_tab',   $tab);
    $this->assignRef('checked',       $checked);
    $this->assignRef('information',   $information);
    $this->assignRef('pane',          $pane);
    $this->assignRef('lists',         $lists);

    $this->_doc->addScript($this->_ambit->getScript('maintenance.js'));

    // Language
    $this->_ambit->script('JGA_MAIMAN_ALERT_RESET_VOTES_CONFIRM');
    $this->_ambit->script('JGA_MAIMAN_NT_ALERT_RESET_NAMETAGS_CONFIRM');
    $this->_ambit->script('JGA_MAIMAN_CM_ALERT_RESET_COMMENTS_CONFIRM');

    JHTML::_('behavior.tooltip');

    parent::display($tpl);
  }

  function cross($title = 'JGA_MAIMAN_MISSING')
  {
    $title = JText::_($title);
    return '<img src="images/publish_x.png" border="0" alt="'.$title.'" title="'.$title.'" class="hasTip" />';
  }

  function tick($title = 'JGA_MAIMAN_AVAILABLE')
  {
    $title = JText::_($title);
    return '<img src="images/tick.png" border="0" alt="'.$title.'" title="'.$title.'" class="hasTip" />';
  }

  function correct($task, $id, $title = 'Apply', $js = false, $extra = null)
  {
    if($js)
    {
      $link = $js;
    }
    else
    {
      $link = 'index.php?option='._JOOM_OPTION.'&amp;controller=maintenance&amp;task='.$task.'&amp;cid='.$id.$extra;
    }

    return '<span class="hasTip" title="'.$title.'"><a href="'.$link.'">
              <img src="components/com_joomgallery/assets/images/joom_maintenance.png" border="0" alt="'.$title.'" /></a></span>';
  }

  function warning($title, $text)
  {
    return JHTML::_('tooltip', $text, $title, 'warning.png');
  }
}