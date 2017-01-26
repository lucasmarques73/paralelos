<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/category/view.html.php $
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
 * HTML View class for the category view
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
    $params = &$this->_mainframe->getParams();

    // Prepare params for header and footer
    JoomHelper::prepareParams($params);

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

    $backlink = JoomHelper::getBackLink($params, JRequest::getInt('catid'));

    $numbers  = JoomHelper::getPicsAndHits($params);

    // Categories pagination
    $totalcategories = &$this->get('TotalCategories');

    // Calculation of the number of total pages
    $catperpage = $this->_config->get('jg_subperpage');
    if(!$catperpage)
    {
      $catperpage = 10;
    }
    $cattotalpages = floor($totalcategories / $catperpage);
    $offcut     = $totalcategories % $catperpage;
    if($offcut > 0)
    {
      $cattotalpages++;
    }

    $totalcategories = number_format($totalcategories, 0, ',', '.');
    // Get the current page
    $catpage = JRequest::getInt('catpage', 0);
    if($catpage > $cattotalpages)
    {
      $catpage = $cattotalpages;
      if($catpage <= 0)
      {
        $catpage = 1;
      }
    }
    else
    {
      if($catpage < 1)
      {
        $catpage = 1;
      }
    }

    // Limitstart
    $limitstart = ($catpage - 1) * $catperpage;
    JRequest::setVar('catlimitstart', $limitstart);

    if(/*$this->_config->get('jg_showcatcount') || */$cattotalpages > 1 && $totalcategories != 0)
    {
      if($this->_config->get('jg_showpagenavsubs') <= 2)
      {
        $params->set('show_pagination_cat_top', 1);
      }
      if($this->_config->get('jg_showpagenavsubs') >= 2)
      {
        $params->set('show_pagination_cat_bottom', 1);
      }
    }

    // Images pagination
    $totalimages = &$this->get('TotalImages');

    // Calculation of the number of total pages
    $perpage = $this->_config->get('jg_perpage');
    if(!$perpage)
    {
      $perpage = 10;
    }
    $totalpages = floor($totalimages / $perpage);
    $offcut     = $totalimages % $perpage;
    if($offcut > 0)
    {
      $totalpages++;
    }

    $totalimages = number_format($totalimages, 0, ',', '.');
    // Get the current page
    $page = JRequest::getInt('page', 0);
    if($page > $totalpages)
    {
      $page = $totalpages;
      if($page <= 0)
      {
        $page = 1;
      }
    }
    else
    {
      if($page < 1)
      {
        $page = 1;
      }
    }

    // Limitstart
    $limitstart = ($page - 1) * $perpage;

    if($this->_config->get('jg_bigpic_open') > 4)
    {
      $params->set('show_all_in_popup', 1);

      // We need all images of this category
      $images = &$this->get('Images');

      $popup = array();

      $end    = ($page - 1) * $perpage;
      $start  = $page * $perpage;
      $popup['before']  = JHTML::_('joomgallery.popup', $images, 0, $end);
      $popup['after']   = JHTML::_('joomgallery.popup', $images, $start);

      $this->assignRef('popup', $popup);

      // Now we have to select the images according to the pagination
      $images = array_slice($images, $limitstart, $perpage);
    }
    else
    {
      JRequest::setVar('limitstart', $limitstart);

      $images = &$this->get('Images');
    }

    if(/*$this->_config->get('jg_showcatcount') || */$totalpages > 1 && $totalimages != 0)
    {
      if($this->_config->get('jg_showpagenav') <= 2)
      {
        $params->set('show_pagination_img_top', 1);
      }
      if($this->_config->get('jg_showpagenav') >= 2)
      {
        $params->set('show_pagination_img_bottom', 1);
      }
    }

    $cat        = &$this->get('Category');

    // Meta data
    if($cat->metadesc)
    {
      $this->_doc->setDescription($cat->metadesc);
    }
    if($cat->metakey)
    {
      $this->_doc->setMetadata('keywords', $cat->metakey);
    }

    if($this->_mainframe->getCfg('MetaTitle') == '1' && isset($cat->imgtitle))
    {
      $this->_mainframe->addMetaTag('title', $cat->imgtitle);
    }
    /*if($this->_mainframe->getCfg('MetaAuthor') == '1' && $cat->author)
    {
      $this->_mainframe->addMetaTag('author', $cat->author);
    }*/

    // Breadcrumbs
    if($this->_config->get('jg_completebreadcrumbs') || $this->_config->get('jg_showpathway'))
    {
      $parents  = JoomHelper::getAllParentCategories($cat->cid);
    }

    $menus = &JSite::getMenu();
    $menu  = $menus->getActive();
    if($menu && array_key_exists('view',$menu->query) && $this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();
      switch($menu->query['view'])
      {
        case '':
        case 'gallery':
          foreach($parents as $parent)
          {
            $breadcrumbs->addItem($parent->name, 'index.php?view=category&catid='.$parent->cid);
          }

          $breadcrumbs->addItem($cat->name);
          break;
        case 'category':
          $skip = true;
          foreach($parents as $key => $parent)
          {
            if($skip)
            {
              if($key == $menu->query['catid'])
              {
                $skip = false;
              }
            }
            else
            {
              $breadcrumbs->addItem($parent->name, 'index.php?view=category&catid='.$parent->cid);
            }
          }

          if(!$skip)
          {
            $breadcrumbs->addItem($cat->name);
          }
          break;
        default:
          break;
      }
    }
    /*if($this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();

      foreach($parents as $parent)
      {
        $breadcrumbs->addItem($parent->name, 'index.php?view=category&catid='.$parent->cid);
      }

      $breadcrumbs->addItem($cat->name);
    }*/

    // JoomGallery Pathway
    $pathway = '';
    if($this->_config->get('jg_showpathway'))
    {
      $pathway = '<a href="'.JRoute::_('index.php?view=gallery').'" class="jg_pathitem">'.JText::_('JGS_COMMON_HOME').'</a> &raquo; ';

      foreach($parents as $parent)
      {
        $pathway  .= '<a href="'.JRoute::_('index.php?view=category&catid='.$parent->cid).'" class="jg_pathitem">'.$parent->name.'</a> &raquo; ';
      }

      $pathway .= $cat->name;
    }

    // Page title
    if($this->_config->get('jg_pagetitle_cat'))
    {
      $pagetitle = JoomHelper::createPagetitle( $this->_config->get('jg_pagetitle_cat'),
                                                $cat->name
                                              );
      $this->_doc->setTitle(JText::_('JGS_COMMON_GALLERY').' - '.$pagetitle);
    }

    // jg_subcatthumbcatalign only effective with random thumbs
    if($this->_config->get('jg_showsubthumbs') == 2)
    {
      if($this->_config->get('jg_subcatthumbalign') == 1)
      {
        // Left
        $gallerycontainer = 'jg_subcatelem_cat';
      }
      else
      {
        // Right
        $gallerycontainer = 'jg_subcatelem_cat_r';
      }
    }
    else
    {
      // No thumb or own defined alignment
      $gallerycontainer = 'jg_subcatelem_cat';
    }

    $categories = &$this->get('Categories');

    foreach($categories as $key => $category)
    {
      $categories[$key]->isnew = '';
      if($this->_config->get('jg_showcatasnew'))
      {
        // Check if an image in this category or in sub-categories is marked with 'new'
        $categories[$key]->isnew = JoomHelper::checkNewCatg($categories[$key]->cid);
      }

      $categories[$key]->pictures = JoomHelper::getNumberOfLinks($category->cid);
      if($categories[$key]->pictures == 1)
      {
        $categories[$key]->picorpics = 'JGS_GALLERY_ONE_IMAGE';
      }
      else
      {
        $categories[$key]->picorpics = 'JGS_GALLERY_IMAGES';
      }

      // Random choice of category/thumbnail
      if($this->_config->get('jg_showsubthumbs') == 2)
      {
        switch($this->_config->get('jg_showrandomsubthumb'))
        {
          // Only from current category
          case 1:
            $random_catid = $category->cid;
            break;
          // Only from sub-categories
          case 2:
            // Get array of all sub-categories without the current category
            // Only with images
            $allsubcats = JoomHelper::getAllSubCategories($category->cid, false);
            if(count($allsubcats))
            {
              $random_catid = $allsubcats[mt_rand(0, count($allsubcats)-1)];
            }
            else
            {
              $random_catid = 0;
            }
            break;
          // From both
          case 3:
            // Get array of all sub-categories including the current category
            // Only with images
            $allsubcats = JoomHelper::getAllSubCategories($category->cid, true);
            if(count($allsubcats))
            {
              $random_catid = $allsubcats[mt_rand(0, count($allsubcats)-1)];
            }
            else
            {
              $random_catid = 0;
            }
            break;
          default:
            $random_catid = 0;
            break;
        }
      }
      // Count the hits of all images in category and sub-categories
      if($this->_config->get('jg_showtotalsubcathits'))
      {
        $categories[$key]->totalhits = JoomHelper::getTotalHits($category->cid);
      }

      $categories[$key]->thumb_src = null;
      if($this->_config->get('jg_showsubthumbs') > 0 && $this->_user->get('aid') >= $category->access)
      {
        if($this->_config->get('jg_showsubthumbs') == 2)
        {
          // Random image, only if there are $randomcat(s)
          if(    $this->_config->get('jg_showrandomsubthumb') == 1
             || ($this->_config->get('jg_showrandomsubthumb') >= 2 && $random_catid != 0)
            )
          {
            $model  = &$this->getModel();

            if($row = &$model->getRandomImage($category->cid, $random_catid))
            {
              $cropx    = null;
              $cropy    = null;
              $croppos  = null;
              if($this->_config->get('jg_dyncrop'))
              {
                $cropx    = $this->_config->get('jg_dyncropwidth');
                $cropy    = $this->_config->get('jg_dyncropheight');
                $croppos  = $this->_config->get('jg_dyncropposition');
            }
              $categories[$key]->thumb_src = $this->_ambit->getImg('thumb_url', $row, null, 0, true, $cropx, $cropy, $croppos);
          }
        }
        }
        else
        {
          if($category->catimage)
          {
            $cropx    = null;
            $cropy    = null;
            $croppos  = null;
            if($this->_config->get('jg_dyncrop'))
            {
              $cropx    = $this->_config->get('jg_dyncropwidth');
              $cropy    = $this->_config->get('jg_dyncropheight');
              $croppos  = $this->_config->get('jg_dyncropposition');
            }
            $categories[$key]->thumb_src = $this->_ambit->getImg('thumb_url', $category->catimage, null, $category->cid, true, $cropx, $cropy, $croppos);

            // Own choice of alignment
            switch($categories[$key]->img_position)
            {
              // Right
              case 1:
                $categories[$key]->photocontainer = 'jg_subcatelem_photo_r';
                $categories[$key]->textcontainer  = 'jg_subcatelem_txt_r';
                break;
              // Centered
              case 2:
                $categories[$key]->photocontainer = 'jg_subcatelem_photo_c';
                $categories[$key]->textcontainer  = 'jg_subcatelem_txt_c';
                break;
              // Left
              default:
                $categories[$key]->photocontainer = 'jg_subcatelem_photo_l';
                $categories[$key]->textcontainer  = 'jg_subcatelem_txt_l';
                break;
            }
          }
          else
          {
            $categories[$key]->textcontainer  = 'jg_subcatelem_txt';
          }
        }
      }

      $categories[$key]->event  = new stdClass();

      // Additional HTML added by plugins
      $results  = $this->_mainframe->triggerEvent('onJoomAfterDisplayCatThumb', array($category->cid));
      $categories[$key]->event->afterDisplayCatThumb  = trim(implode('', $results));

      /*// Additional icons added by plugins
      $results  = $this->_mainframe->triggerEvent('onJoomDisplayIcons', array('category.category', $category));
      $categories[$key]->event->icons                 = trim(implode('', $results));*/
    }

    // Download icon
    if(   (($this->_config->get('jg_showcategorydownload') == 1) && ($this->_user->get('aid') >= 1))
       || (($this->_config->get('jg_showcategorydownload') == 2) && ($this->_user->get('aid') == 2))
       || (($this->_config->get('jg_showcategorydownload') == 3))
      )
    {
      $params->set('show_download_icon', 1);
    }
    else
    {
      if(($this->_config->get('jg_showcategorydownload') == 1) && ($this->_user->get('aid') < 1))
      {
        $params->set('show_download_icon', -1);
      }
    }

    // Favourites icon
    if($this->_config->get('jg_favourites') && $this->_config->get('jg_showcategoryfavourite'))
    {
      if(   ($this->_config->get('jg_showdetailfavourite') == 0 && $this->_user->get('aid') >= 1)
         || ($this->_config->get('jg_showdetailfavourite') == 1 && $this->_user->get('aid') == 2)
         || ($this->_config->get('jg_usefavouritesforpubliczip') == 1 && $this->_user->get('aid') < 1)
        )
      {
        if(    $this->_config->get('jg_usefavouritesforzip')
           || ($this->_config->get('jg_usefavouritesforpubliczip') && $this->_user->get('aid') < 1)
          )
        {
          $params->set('show_favourites_icon', 2);
        }
        else
        {
          $params->set('show_favourites_icon', 1);
        }
      }
      else
      {
        if(($this->_config->get('jg_favouritesshownotauth') == 1))
        {
          if($this->_config->get('jg_usefavouritesforzip'))
          {
            $params->set('show_favourites_icon', -2);
          }
          else
          {
            $params->set('show_favourites_icon', -1);
          }
        }
      }
    }

    // Report icon
    if($this->_config->get('jg_category_report_images'))
    {
      if($this->_user->get('id') || $this->_config->get('jg_category_report_images') == 2)
      {
        $params->set('show_report_icon', 1);

        JHTML::_('behavior.modal');
      }
      else
      {
        if($this->_config->get('jg_report_images_notauth'))
        {
          $params->set('show_report_icon', -1);
        }
      }
    }

    foreach($images as $key => $image)
    {
      $cropx    = null;
      $cropy    = null;
      $croppos  = null;
      if($this->_config->get('jg_dyncrop'))
      {
        $cropx    = $this->_config->get('jg_dyncropwidth');
        $cropy    = $this->_config->get('jg_dyncropheight');
        $croppos  = $this->_config->get('jg_dyncropposition');
        $images[$key]->imgwh = 'width="'.$cropx.'" height="'.$cropy.'"';
      }
      else
      {
      // Get dimensions for width and height attribute in img tag
      $imgwh  = getimagesize($this->_ambit->getImg('thumb_path', $image));
      $images[$key]->imgwh = $imgwh[3];
      }
      $images[$key]->thumb_src = $this->_ambit->getImg('thumb_url', $image, null, 0, true, $cropx, $cropy, $croppos);

      if(   !is_file($this->_ambit->getImg('orig_path', $image))
         && $this->_config->get('jg_downloadfile') == 1
        )
      {
        $params->set('show_download_icon', 0);
      }

      if($this->_config->get('jg_showpicasnew'))
      {
        $images[$key]->isnew = JoomHelper::checkNew($image->imgdate, $this->_config->get('jg_daysnew'));
      }

      $images[$key]->link = JHTML::_('joomgallery.openimage', $this->_config->get('jg_detailpic_open'), $image);

      if($this->_config->get('jg_showauthor'))
      {
        if($image->imgauthor)
        {
          $images[$key]->authorowner = $image->imgauthor;
        }
        else
        {
          if($this->_config->get('jg_showowner'))
          {
            $images[$key]->authorowner = JHTML::_('joomgallery.displayname', $image->owner);
          }
          else
          {
            $images[$key]->authorowner = JText::_('JGS_COMMON_NO_DATA');
          }
        }
      }

      $images[$key]->event  = new stdClass();

      // Additional HTML added by plugins
      $results  = $this->_mainframe->triggerEvent('onJoomAfterDisplayThumb', array($image->id));
      $images[$key]->event->afterDisplayThumb = trim(implode('', $results));

      // Additional icons added by plugins
      $results  = $this->_mainframe->triggerEvent('onJoomDisplayIcons', array('category.image', $image));
      $images[$key]->event->icons             = trim(implode('', $results));
    }

    if($this->_config->get('jg_cooliris') && count($images))
    {
      $href = JRoute::_('index.php?view=category&catid='.$cat->cid.'&page='.$page.'&format=raw');
      $attribs = array('id' => 'gallery', 'type' => 'application/rss+xml', 'title' => 'Cooliris');
      $this->_doc->addHeadLink($href, 'alternate', 'rel', $attribs);

      if($this->_config->get('jg_coolirislink'))
      {
        $this->_doc->addScript('http://lite.piclens.com/current/piclens.js');
      }
    }

    $order_url = null;
    if($this->_config->get('jg_usercatorder') && count($images))
    {
      $orderby   = JRequest::getCmd('orderby');
      $orderdir  = JRequest::getCmd('orderdir');

      // If navigation active insert current startpage and sub-startpage
      if(!empty($page))
      {
        if(!empty($catpage))
        {
          $sort_url = JRoute::_('index.php?view=category&catid='.$cat->cid.'&startpage='.$page.'&substartpage='.$catpage).JHTML::_('joomgallery.anchor', 'category');
        }
        else
        {
          $sort_url = JRoute::_('index.php?view=category&catid='.$cat->cid.'&startpage='.$page).JHTML::_('joomgallery.anchor', 'category');
        }
      }
      else
      {
        $sort_url = JRoute::_('index.php?view=category&catid='.$cat->cid).JHTML::_('joomgallery.anchor', 'category');
      }

      $order_url = '';
      if($orderby)
      {
        $order_url.= '&orderby='.$orderby;
      }
      if($orderdir)
      {
        $order_url .= '&orderdir='.$orderdir;
      }

      $this->assignRef('sort_url',  $sort_url);
      $this->assignRef('order_by',  $orderby);
      $this->assignRef('order_dir', $orderdir);
    }

    $this->assignRef('params',            $params);
    $this->assignRef('gallerycontainer',  $gallerycontainer);
    $this->assignRef('category',          $cat);
    $this->assignRef('images',            $images);
    $this->assignRef('categories',        $categories);
    $this->assignRef('totalimages',       $totalimages);
    $this->assignRef('totalpages',        $totalpages);
    $this->assignRef('page',              $page);
    $this->assignRef('totalcategories',   $totalcategories);
    $this->assignRef('cattotalpages',     $cattotalpages);
    $this->assignRef('catpage',           $catpage);
    $this->assignRef('order_url',         $order_url);
    $this->assignRef('pathway',           $pathway);
    $this->assignRef('modules',           $modules);
    $this->assignRef('backtarget',        $backlink[0]);
    $this->assignRef('backtext',          $backlink[1]);
    $this->assignRef('numberofpics',      $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',    $numbers[1]);
    }

    /* TODO
    $link	= '&format=feed&limitstart=';
    $attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
    $this->_doc->addHeadLink(JRoute::_($link.'&type=rss'), 'alternate', 'rel', $attribs);
    $attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
    $this->_doc->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);*/

    // include dTree script, dTree styles and treeview styles, if neccessary
    /*if($this->_config->get('jg_showsubsingalleryview'))
    {
      $this->_doc->addStyleSheet($this->_ambit->getScript('dTree/css/jg_dtree.css'));
      $this->_doc->addStyleSheet($this->_ambit->getScript('dTree/css/jg_treeview.css'));
      $this->_doc->addScript($this->_ambit->getScript('dTree/js/jg_dtree.js'));
    }*/

    parent::display($tpl);
  }
}