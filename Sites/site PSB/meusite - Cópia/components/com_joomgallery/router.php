<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/router.php $
// $Id: router.php 2566 2010-11-03 21:10:42Z mab $
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
 * Builds the SEF URL for all links in JoomGallery
 *
 * @static
 * @param   array $query  An array containing all paramters of the original URL
 * @return  array An array of the segments which will be added to the SEF URL
 * @since   1.5.5
 */
function JoomGalleryBuildRoute(&$query)
{
  $segments = array();
  $db       = & JFactory::getDBO();

  if(!defined('_JOOM_OPTION'))
  {
    require_once JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php';
  }

  /*// get a menu item based on Itemid or currently active
  $menu = &JSite::getMenu();
  if(empty($query['Itemid']))
  {
    $menuItem = &$menu->getActive();
  }
  else
  {
    $menuItem = &$menu->getItem($query['Itemid']);
  }
  $mView  = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
  $mCatid = (empty($menuItem->query['catid'])) ? null : $menuItem->query['catid'];
  $mId    = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];*/

  if(isset($query['view']) && $query['view'] == 'toplist')
  {
    if(isset($query['type']))
    {
      switch($query['type'])
      {
        case 'toprated':
          $segments[] = JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_TOP_RATED'));
          break;
        case 'lastadded':
          $segments[] = JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_ADDED'));
          break;
        case 'lastcommented':
          $segments[] = JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_COMMENTED'));
          break;
        default:
          $segments[] = JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_MOST_VIEWED'));
          break;
      }
    }
    else
    {
      $segments[] = JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_MOST_VIEWED'));
    }
      unset($query['type']);
      unset($query['view']);
  }

  if(isset($query['view']) && $query['view'] == 'edit')
  {
    $segments[] = 'edit';
    $db->setQuery(" SELECT
                        alias
                      FROM
                        "._JOOM_TABLE_IMAGES."
                      WHERE
                        id = ".$query['id']);
    if(!$segment = $db->loadResult())
    {
      // TODO: Append ID of image if alias was not found?
      $segment = 'alias-not-found';//$query['id'];
    }
    $segments[] = $segment;
    unset($query['view']);
    unset($query['id']);
  }

  if(isset($query['view']) && $query['view'] == 'editcategory')
  {
    if(isset($query['catid']))
    {
      $segments[] = 'editcategory';
      $db->setQuery(" SELECT
                        alias
                      FROM
                        "._JOOM_TABLE_CATEGORIES."
                      WHERE
                        cid = ".$query['catid']);
      if(!$segment = $db->loadResult())
      {
        // TODO: Append ID of category if alias was not found?
        $segment = 'alias-not-found';//$query['catid'];
      }
      $segments[] = $segment;
    }
    else
    {
      $segments[] = 'newcategory';
    }
    unset($query['view']);
    unset($query['catid']);
  }

  if(isset($query['view']) && $query['view'] == 'gallery')
  {
    unset($query['view']);

    JLoader::register('JoomRouting', JPATH_ROOT.DS.'components'.DS._JOOM_OPTION.DS.'helpers'.DS.'routing.php');
    if(isset($query['Itemid']) && $Itemid = JoomRouting::checkItemid($query['Itemid']))
    {
      $query['Itemid'] = $Itemid;
    }
  }
  if(isset($query['view']) && $query['view'] == 'image')
  {
    $segments[] = 'image';
    unset($query['view']);
    #unset($query['format']);
  }
  if(isset($query['view']) && $query['view'] == 'mini')
  {
    $segments[] = 'mini';
    unset($query['view']);
  }
  if(isset($query['view']) && $query['view'] == 'search')
  {
    $segments[] = 'search';
    unset($query['view']);
  }
  if(isset($query['view']) && $query['view'] == 'upload')
  {
    $segments[] = 'upload';
    unset($query['view']);
  }
  if(isset($query['view']) && $query['view'] == 'usercategories')
  {
    $segments[] = 'usercategories';
    unset($query['view']);
  }
  if(isset($query['view']) && $query['view'] == 'userpanel')
  {
    $segments[] = 'userpanel';
    unset($query['view']);
  }

  if(isset($query['view']) && $query['view'] == 'favourites')
  {
    $segments[] = 'favourites';

    unset($query['view']);

    if(isset($query['layout']))
    {
      /*if(!empty($query['Itemid']) && isset($menuItem->query['layout'])) {
        if ($query['layout'] == $menuItem->query['layout']) {

          unset($query['layout']);
        }
      } else {*/
        if($query['layout'] == 'default')
        {
          unset($query['layout']);
        }
      #}
    }
  }

  if(isset($query['view']) and $query['view'] == 'category')
  {
    /*if($mId != intval($query['catid']) || $mView != $view)
    {*/
      $db->setQuery(" SELECT
                        alias
                      FROM
                        "._JOOM_TABLE_CATEGORIES."
                      WHERE
                        cid = ".$query['catid']);
      if(!$segment = $db->loadResult())
      {
        // TODO: Append ID of category if alias was not found?
        $segment = 'alias-not-found';//$query['catid'];
      }
      $segments[] = $segment;
    /*}*/
    unset($query['catid']);
    unset($query['view']);
  }

  if(isset($query['id']) && isset($query['view']) && $query['view'] == 'detail')
  {
    #if(empty($query['Itemid']))
    #{
      $db->setQuery(" SELECT
                        catid, alias
                      FROM
                        "._JOOM_TABLE_IMAGES."
                      WHERE
                        id = ".$query['id']);
      $result_array = $db->loadAssoc();
      $db->setQuery(" SELECT
                        alias
                      FROM
                        "._JOOM_TABLE_CATEGORIES."
                      WHERE
                        cid = ".$result_array['catid']);
      if(!$segment = $db->loadResult())
      {
        // TODO: Append ID of category if alias was not found?
        $segment = 'alias-not-found';//$result_array['catid'];
      }
      $segments[] = $segment;
      if(!$segment = $result_array['alias'])
      {
        // TODO: Append ID of image if alias was not found?
        $segment = 'alias-not-found';//$query['id'];
      }
      $segments[] = $segment;
    /*}
    else
    {
      if(isset($menuItem->query['id']))
      {
        if($query['id'] != $mId)
        {
          $segments[] = $query['id'];
        }
      }
      else
      {
        $segments[] = $query['id'];
      }
    }*/
    unset($query['id']);
    unset($query['view']);
  }

  return $segments;
}

/**
 * Analyses a SEF URL to retreive the parameters for JoomGallery
 *
 * @static
 * @param   array $query  An array containing the segments of the SEF URL
 * @return  array An array of the parameters retreived
 * @since   1.5.5
 */
function JoomGalleryParseRoute($segments)
{
  require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php');
  JLoader::register('JoomRouting', JPATH_ROOT.DS.'components'.DS._JOOM_OPTION.DS.'helpers'.DS.'routing.php');

  $vars = array();

  $language = & JFactory::getLanguage();
  $language->load('com_joomgallery'); 
  if(   $segments[0] == str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_TOP_RATED')))
    ||  $segments[0] == str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_ADDED')))
    ||  $segments[0] == str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_COMMENTED')))
    ||  $segments[0] == str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_MOST_VIEWED')))
    )
  {
    $vars['view'] = 'toplist';

    switch($segments[0])
    {
      case str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_TOP_RATED'))):
        $vars['type'] = 'toprated';
        break;
      case str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_ADDED'))):
        $vars['type'] = 'lastadded';
        break;
      case str_replace('-', ':', JFilterOutput::stringURLSafe(JText::_('JGS_COMMON_TOPLIST_LAST_COMMENTED'))):
        $vars['type'] = 'lastcommented';
        break;
      default:
        break;
    }

    return $vars;
  }

  if($segments[0] == 'newcategory')
  {
    $vars['view'] = 'editcategory';
    return $vars;
  }

  if($segments[0] == 'editcategory')
  {
    array_shift($segments);
    if($result_array = JoomRouting::getId($segments))
    {
      $vars['catid'] = $result_array['id'];
    }
    $vars['view'] = 'editcategory';

    return $vars;
  }

  if($segments[0] == 'edit')
  {
    array_shift($segments);
    if($result_array = JoomRouting::getId($segments))
    {
      $vars['id']   = $result_array['id'];
      $vars['view'] = 'edit';
    }
    else
    {
      $vars['view'] = 'upload';
    }

    return $vars;
  }

  if($segments[0] == 'image')
  {
    $vars['view'] = 'image';
    #$vars['format'] = 'raw';
    return $vars;
  }

  if($result_array = JoomRouting::getId($segments))
  {
    if($result_array['view'] == 'category')
    {
      $vars['view']   = 'category';
      $vars['catid']  = $result_array['id'];
    }
    else
    {
      $vars['view']   = 'detail';
      $vars['id']  = $result_array['id'];
    }

    return $vars;
  }

  $valid_views = array( 'downloadzip',
                        'favourites',
                        'mini',
                        'search',
                        'upload',
                        'usercategories',
                        'userpanel'
                      );
  if(in_array($segments[0], $valid_views))
  {
    $vars['view'] = $segments[0];
    return $vars;
  }

  $vars['view'] = 'gallery';

  return $vars;
}