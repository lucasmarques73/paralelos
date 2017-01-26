<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/gallery/view.html.php $
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
 * HTML View class for the gallery view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewGallery extends JoomGalleryView
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

    $pathway  = null;

    $backlink = JoomHelper::getBackLink($params);

    $numbers  = JoomHelper::getPicsAndHits($params);

    // Get number of all root categories
    $total = &$this->get('Total');

    // Calculation of the number of total pages
    $catperpage = $this->_config->get('jg_catperpage');
    if(!$catperpage)
    {
      $catperpage = 10;
    }
    $totalpages = floor($total / $catperpage);
    $offcut     = $total % $catperpage;
    if($offcut > 0)
    {
      $totalpages++;
    }

    $total = number_format($total, 0, ',', '.');
    // Get the current page
    $page = JRequest::getInt('page', 0);
    if($page > $totalpages)
    {
      $page = $totalpages;
    }
    if($page < 1)
    {
      $page = 1;
    }

    // Limitstart
    $limitstart = ($page - 1) * $catperpage;
    JRequest::setVar('limitstart', $limitstart);

    if(/*$this->_config->get('jg_showcatcount') || */$totalpages > 1 && $total != 0)
    {
      if(($this->_config->get('jg_showgallerypagenav') == 1) || ($this->_config->get('jg_showgallerypagenav') == 2))
      {
        $params->set('show_pagination_top', 1);
      }
      if(($this->_config->get('jg_showgallerypagenav') == 2) || ($this->_config->get('jg_showgallerypagenav') == 3))
      {
        $params->set('show_pagination_bottom', 1);
      }
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

      // Get all number of all images in category and sub-categories
      $categories[$key]->pictures = JoomHelper::getNumberOfLinks($categories[$key]->cid);

      if($categories[$key]->pictures == 1)
      {
        $categories[$key]->picorpics = 'JGS_GALLERY_ONE_IMAGE';
      }
      else
      {
        $categories[$key]->picorpics = 'JGS_GALLERY_IMAGES';
      }

      // Random choice of category/thumbnail
      if($this->_config->get('jg_showcatthumb') == 1)
      {
        switch ($this->_config->get('jg_showrandomcatthumb'))
        {
          // Only from current category
          case 1:
            $random_catid = $categories[$key]->cid;
            break;
          // Only from sub-categories
          case 2:
            // Get array of all sub-categories without the current category
            // Only with images
            $allsubcats = JoomHelper::getAllSubCategories($categories[$key]->cid, false);
            if (count($allsubcats))
            {
              $random_catid = $allsubcats[mt_rand(0, count($allsubcats)-1)];
            }
            else
            {
              $random_catid=0;
            }
            break;
          // From both
          case 3:
            // Get array of all sub-categories including the current category
            // Only with images
            $allsubcats = JoomHelper::getAllSubCategories($categories[$key]->cid, true);
            if (count($allsubcats))
            {
              $random_catid = $allsubcats[mt_rand(0, count($allsubcats)-1)];
            }
            else
            {
              $random_catid=0;
            }
            break;
          default:
            $random_catid = 0;
            break;
        }
      }
      // Count the hits of all images in category and sub-categories
      if($this->_config->get('jg_showtotalcathits'))
      {
        $categories[$key]->totalhits = JoomHelper::getTotalHits($categories[$key]->cid);
      }

      $categories[$key]->thumb_src = null;
      if($this->_config->get('jg_showcatthumb') > 0 && $this->_user->get('aid') >= $categories[$key]->access)
      {
        if($this->_config->get('jg_showcatthumb') == 1)
        {
          // Random image, only if there are $randomcat(s)
          if(    $this->_config->get('jg_showrandomcatthumb') == 1
             || ($this->_config->get('jg_showrandomcatthumb') >= 2 && $random_catid != 0)
            )
          {
            $model  = &$this->getModel();
            if($row = &$model->getRandomImage($categories[$key]->cid, $random_catid))
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
          if($categories[$key]->catimage)
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
            $categories[$key]->thumb_src = $this->_ambit->getImg('thumb_url', $categories[$key]->catimage, null, $categories[$key]->cid, true, $cropx, $cropy, $croppos);
          }

          switch($category->img_position)
          {
            case 1:
              //r Right
              $categories[$key]->photocontainer = 'jg_photo_container_r';
              $categories[$key]->textcontainer  = 'jg_element_txt_r';
              break;
            case 2:
              // Centered
              $categories[$key]->photocontainer = 'jg_photo_container_c';
              $categories[$key]->textcontainer  = 'jg_element_txt_c';
              break;
            default:
              // Left
              $categories[$key]->photocontainer = 'jg_photo_container_l';
              $categories[$key]->textcontainer  = 'jg_element_txt_l';
              break;
          }
        }
      }
    }

    $this->assignRef('params',          $params);
    $this->assignRef('rows',            $categories);
    $this->assignRef('total',           $total);
    $this->assignRef('totalpages',      $totalpages);
    $this->assignRef('page',            $page);
    $this->assignRef('pathway',         $pathway);
    $this->assignRef('modules',         $modules);
    $this->assignRef('backtarget',      $backlink[0]);
    $this->assignRef('backtext',        $backlink[1]);
    $this->assignRef('numberofpics',    $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',  $numbers[1]);
    }

    // include dTree script, dTree styles and treeview styles, if neccessary
    if($this->_config->get('jg_showsubsingalleryview'))
    {
      $this->_doc->addStyleSheet($this->_ambit->getScript('dTree/css/jg_dtree.css'));
      $this->_doc->addStyleSheet($this->_ambit->getScript('dTree/css/jg_treeview.css'));
      $this->_doc->addScript($this->_ambit->getScript('dTree/js/jg_dtree.js'));
    }

    parent::display($tpl);
  }
}