<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/detail/view.html.php $
// $Id: view.html.php 2587 2010-11-18 17:31:48Z erftralle $
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
 * HTML View class for the detail view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewDetail extends JoomGalleryView
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
    if($this->_user->get('aid') == 0 && $this->_config->get('jg_showdetailpage') == 0)
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery'),
                                  JText::_('JGS_COMMON_MSG_NOT_ALLOWED_VIEW_IMAGE'), 'notice');
    }

    $images     = $this->get('Images');
    $image      = $this->get('Image');
    $slideshow  = JRequest::getInt('slideshow');
    $params     = &$this->_mainframe->getParams();

    // Breadcrumbs
    if(     $this->_config->get('jg_completebreadcrumbs')
        ||  $this->_config->get('jg_showpathway')
        ||  $this->_config->get('jg_pagetitle_detail')
      )
    {
      $parents  = JoomHelper::getAllParentCategories($image->catid, true);
    }

    $menus = &JSite::getMenu();
    $menu  = $menus->getActive();
    if($menu && isset($menu->query['view'])
       && $menu->query['view'] != 'detail'
       && $this->_config->get('jg_completebreadcrumbs'))
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

          $breadcrumbs->addItem($image->imgtitle);
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
            $breadcrumbs->addItem($image->imgtitle);
          }
          break;
      }
    }

    // JoomGallery Pathway
    $pathway = null;
    if($this->_config->get('jg_showpathway'))
    {
      $pathway = '<a href="'.JRoute::_('index.php?view=gallery').'" class="jg_pathitem">'.JText::_('JGS_COMMON_HOME').'</a> &raquo; ';

      foreach($parents as $parent)
      {
        $pathway  .= '<a href="'.JRoute::_('index.php?view=category&catid='.$parent->cid).'" class="jg_pathitem">'.$parent->name.'</a> &raquo; ';
      }

      $pathway .= $image->imgtitle;
    }

    // Page Title
    if($this->_config->get('jg_pagetitle_detail'))
    {
      $pagetitle  = JoomHelper::createPagetitle($this->_config->get('jg_pagetitle_detail'),
                                                $parents[$image->catid]->name,
                                                $image->imgtitle
                                              );
      $this->_doc->setTitle(JText::_('JGS_COMMON_GALLERY').' - '.$pagetitle);
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $backtarget = JRoute::_('index.php?view=category&catid='.$image->catid); //see above
    $backtext   = JText::_('JGS_COMMON_BACK_TO_CATEGORY');

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
    // Load modules at position 'detailbtm'
    $modules['detailbtm'] = JoomHelper::getRenderedModules('detailbtm');
    if(count($modules['detailbtm']))
    {
      $params->set('show_detailbtm_modules', 1);
    }

    // Meta data
    if($image->metadesc)
    {
      $this->_doc->setDescription($image->metadesc);
    }
    if($image->metakey)
    {
      $this->_doc->setMetadata('keywords', $image->metakey);
    }

    if($this->_mainframe->getCfg('MetaTitle') == '1')
    {
      $this->_mainframe->addMetaTag('title', $image->imgtitle);
    }
    if($this->_mainframe->getCfg('MetaAuthor') == '1' && $image->imgauthor)
    {
      $this->_mainframe->addMetaTag('author', $image->imgauthor);
    }

    // Accordion
    if($this->_config->get('jg_showdetailaccordion'))
    {
      $toggler = 'class="joomgallery-toggler"';
      $slider  = 'class="joomgallery-slider"';
      JHTML::_('behavior.mootools');
      $accordionscript= 'window.addEvent(\'domready\', function(){
        new Accordion
        (
          $$(\'h4.joomgallery-toggler\'),
          $$(\'div.joomgallery-slider\'),
          {
            onActive: function(toggler, i)
            {
              toggler.addClass(\'joomgallery-toggler-down\');
              toggler.removeClass(\'joomgallery-toggler\');
            },
            onBackground: function(toggler, i)
            {
              toggler.addClass(\'joomgallery-toggler\');
              toggler.removeClass(\'joomgallery-toggler-down\');
            },
            duration: 300,
            display:-1,
            show:0,
            opacity: false,
            alwaysHide: true
           });
        });';
      $this->_doc->addScriptDeclaration($accordionscript);
    }
    else
    {
      $toggler = '';
      $slider  = '';
    }

    // Linked
    if( (    ($this->_config->get('jg_bigpic') == 1 && $this->_user->get('aid') > 0)
          ||  $this->_config->get('jg_bigpic') == 2
        )
        && !$slideshow
        && $image->bigger_orig
        &&
        (     !$this->_config->get('jg_nameshields')
          || (!$this->_config->get('jg_show_nameshields_unreg') && !$this->_user->get('username'))
        )
      )
    {
      $params->set('image_linked', 1);
    }

    // Original size
    if(     $image->orig_exists
        &&  $this->_config->get('jg_showoriginalfilesize')
        && !$slideshow
      )
    {
      $params->set('show_original_size', 1);
    }

    // Pagination
    if(isset($images[$image->position-1]) && !$slideshow)
    {
      $params->set('show_previous_link', 1);
      $pagination['previous']['link'] = JRoute::_('index.php?view=detail&id='.$images[$image->position-1]->id).JHTML::_('joomgallery.anchor');
      if($this->_config->get('jg_showdetailnumberofpics'))
      {
        $params->set('show_previous_text', 1);
        $pagination['previous']['text'] = JText::sprintf('JGS_DETAIL_IMG_IMAGE_OF_IMAGES', $image->position, count($images));
      }
    }
    if(isset($images[$image->position+1]) && !$slideshow)
    {
      $params->set('show_next_link', 1);
      $pagination['next']['link'] = JRoute::_('index.php?view=detail&id='.$images[$image->position+1]->id).JHTML::_('joomgallery.anchor');
      if($this->_config->get('jg_showdetailnumberofpics'))
      {
        $params->set('show_next_text', 1);
        $pagination['next']['text'] = JText::sprintf('JGS_DETAIL_IMG_IMAGE_OF_IMAGES', $image->position+2, count($images));
      }
    }

    // Nametags
    if(     !$slideshow
        &&  ( ($this->_config->get('jg_nameshields') && $this->_user->get('id'))
          ||  ($this->_config->get('jg_nameshields_unreg') && !$this->_user->get('id'))
            )
      )
    {
      $nametags       = $this->get('Nametags');

      if($this->_user->get('id') || $nametags)
      {
        $params->set('show_nametags', 1);
        $this->assignRef('nametags', $nametags);
      }

      $already_tagged = false;
      foreach($nametags as $nametag)
      {
        if($nametag->nuserid == $this->_user->get('id'))
        {
          $already_tagged = true;
          break;
        }
      }

      if(     $this->_config->get('jg_nameshields')
          &&  $this->_user->get('id')
          && !$slideshow
          && (!$already_tagged || $this->_config->get('jg_nameshields_others'))
        )
      {
        $params->set('show_movable_nametag', 1);

        $length             = strlen($this->_user->get('username')) * $this->_config->get('jg_nameshields_width');
        $nametag            = array();
        $nametag['length']  = $length;
        $nametag['name']    = $this->_user->get('username');
        $nametag['link']    = JRoute::_('index.php?task=savenametag');
        $this->assignRef('nametag', $nametag);

        JHTML::_('behavior.mootools');
        if($this->_config->get('jg_nameshields_others'))
        {
          JHTML::_('behavior.modal');
          JHTML::_('behavior.tooltip', '.nametagWithTip', array('hideDelay' => 1000,
                                                                'fixed' => true,
                                                                'onShow' => 'function(tip){addtooltips(tip);}',
                                                                'className' => 'nametag-tool'));
        }
      }
    }

    $script = '';

    // Slideshow
    if($this->_config->get('jg_slideshow'))
    {
      $params->set('slideshow_enabled', 1);

      if($slideshow)
      {
        JHTML::_('behavior.mootools');
        $this->_doc->addStyleSheet($this->_ambit->getScript('smoothgallery/css/jd.gallery.css'));
        $this->_doc->addScript($this->_ambit->getScript('smoothgallery/scripts/jd.gallery.js'));

        // No include if standard effects 'fade/crossfade/fadebg' chosen

        switch ($this->_config->get('jg_slideshow_transition'))
        {
          case 0:
            $transition = 'fade';
            break;
          case 1:
            $transition = 'fadeslideleft';
            $this->_doc->addScript($this->_ambit->getScript('smoothgallery/scripts/jd.gallery.transitions.js'));
            break;
          case 2:
            $transition = 'crossfade';
            break;
          case 3:
            $transition = 'continuoushorizontal';
            $this->_doc->addScript($this->_ambit->getScript('smoothgallery/scripts/jd.gallery.transitions.js'));
            break;
          case 4:
            $transition = 'continuousvertical';
            $this->_doc->addScript($this->_ambit->getScript('smoothgallery/scripts/jd.gallery.transitions.js'));
            break;
          case 5:
            $transition = 'fadebg';
            break;
          default:
            $transition = 'fade';
            break;
        }

        // The slideshow needs an array of objects
        $script .= 'var photo = new Array();
                  function joom_createphotoobject(image,thumbnail,linkTitle,link,title,description,number,date,hits,rating,filesizedtl,filesizeorg,author,detaillink) {
                    this.image = image;
                    this.thumbnail = thumbnail;
                    this.linkTitle = linkTitle;
                    this.link =link;
                    this.title = title;
                    this.description = description;
                    this.transition="'.$transition.'";
                    this.number=number;
                    this.date=date,
                    this.hits=hits,
                    this.rating=rating,
                    this.filesizedtl=filesizedtl,
                    this.filesizeorg=filesizeorg,
                    this.author=author,
                    this.detaillink=detaillink
                  }';
        $number      = 0;
        $maxwidth    = 0;
        $maxheight   = 0;
        $imgstartidx = 0;
        foreach($images as $row)
        {
          // Description
          if($row->imgtext != '')
          {
            $description =JoomHelper::fixForJS($row->imgtext);
          }
          else
          {
            $description = '&nbsp;';
          }
          // Date
          if($row->imgdate != '')
          {
            $date = JHTML::_('date', $row->imgdate, JText::_('DATE_FORMAT_LC1'));
          }
          else
          {
            $date = '';
          }
          // Rating
          $rating = addslashes(JHTML::_('joomgallery.rating', $row, true, 'jg_starrating_detail'));
          // File size of detail image
          if($this->_config->get('jg_showdetailfilesize'))
          {
            $filesizedtl = @filesize($this->_ambit->getImg('img_path', $row));
            $filesizedtl = number_format($filesizedtl/1024, 2, JText::_('JGS_COMMON_DECIMAL_SEPARATOR'), JText::_('JGS_COMMON_THOUSANDS_SEPARATOR'))." KB";
            list($width, $height, $type, $attr) = @getimagesize($this->_ambit->getImg('img_path', $row));
            $filesizedtl .= ' ('.$width.' x '.$height.'px)&nbsp';
          }
          else
          {
            $filesizedtl  = '&nbsp;';
          }
          // File size of original image
          if($this->_config->get('jg_showoriginalfilesize'))
          {
            $filesizeorg = @filesize($this->_ambit->getImg('orig_path', $row));
            $filesizeorg = number_format($filesizeorg/1024, 2, JText::_('JGS_COMMON_DECIMAL_SEPARATOR'), JText::_('JGS_COMMON_THOUSANDS_SEPARATOR'))." KB";
            list($width, $height, $type, $attr) = @getimagesize($this->_ambit->getImg('orig_path', $row));
            $filesizeorg .= ' ('.$width.' x '.$height.'px)&nbsp';
          }
          else
          {
            $filesizeorg  = '&nbsp;';
          }

          // Author-owner
          if($this->_config->get('jg_showdetailauthor'))
          {
            if($row->imgauthor)
            {
              $author = $row->imgauthor;
            }
            else
            {
              $author = JHTML::_('joomgallery.displayname', $row->imgowner, 'detail');
            }
          }
          else
          {
            $author   = '';
          }
          if ($this->_config->get('jg_slideshow_maxdimauto'))
          {
            // Get dimensions of image for calculating the max. width/height
            // of all images
            $dimensions = getimagesize($this->_ambit->getImg('img_path', $row));
            if($dimensions[0] > $maxwidth)
            {
              $maxwidth   = $dimensions[0];
            }
            if($dimensions[1] > $maxheight)
            {
              $maxheight  = $dimensions[1];
            }
          }

          $script .= '
            photo['.$number.'] = new joom_createphotoobject(
            "'.str_replace('&amp;', '&', $this->_ambit->getImg('img_url', $row)).'",//image
            "'.$this->_ambit->getImg('thumb_url', $row).'",//thumbnail
            "'.$row->imgtitle.'",//linkTitle
            "'.str_replace('&amp;', '&', $this->_ambit->getImg('img_url', $row)).'",//link
            "'.JoomHelper::fixForJS($row->imgtitle).'",//title
            "'.$description.'",
            '.$number.',
            "'.$date.'",
            "'.$row->hits.'",
            "'.$rating.'",
            "'.$filesizedtl.'",
            "'.$filesizeorg.'",
            "'.str_replace(array("\r\n", "\r", "\n"), '', addcslashes($author, '"')).'",
            "'.JHTML::_('joomgallery.openimage', 0, $row).'"
          );';
          // set start image index for slideshow
          if($row->id == $image->id)
          {
            $imgstartidx = $number;
          }
          $number++;
        }
        if (!$this->_config->get('jg_slideshow_maxdimauto'))
        {
          $maxwidth   =$this->_config->get('jg_slideshow_width');
          $maxheight  =$this->_config->get('jg_slideshow_heigth');
        }
        $script .= 'var joom_slideshow=null;
                    function startGallery() {
                        joom_slideshow = new gallery($(\'jg_dtl_photo\'), {
                        timed: true,
                        delay: '.$this->_config->get('jg_slideshow_timer').',
                        fadeDuration: '.$this->_config->get('jg_slideshow_transtime').',
                        showArrows: '.$this->_config->get('jg_slideshow_arrows').',
                        showCarousel: '.$this->_config->get('jg_slideshow_carousel').',
                        textShowCarousel: \''.JText::_('JGS_DETAIL_SLIDESHOW_IMAGES').'\',
                        showInfopane: '.$this->_config->get('jg_slideshow_infopane').',
                        embedLinks: false,
                        manualData:photo,
                        preloader:false,
                        populateData:false,
                        maxWidth:'.$maxwidth.',
                        maxHeight:'.$maxheight.',
                        imgstartidx:'.$imgstartidx.'
                     });
                   }
                   window.addEvent(\'domready\', startGallery);
                   function joom_stopslideshow() {
                     var url = photo[joom_slideshow.getCurrentIter()].detaillink + \''.JHTML::_('joomgallery.anchor').'\';
                     location.href = url.replace(/\&amp;/g,\'&\');
                   }
        ';
      }
      else
      {
        $script .= "function joom_startslideshow() {\n"
                .  "  document.jg_slideshow_form.submit();\n"
                .  "}\n";
      }
    }

    // Rightclick / Cursor navigation
    if($this->_config->get('jg_disable_rightclick_detail'))
    {
      $script .= '
    var jg_photo_hover = 0;
    document.oncontextmenu = function() {
      if(jg_photo_hover==1) {
        return false;
      } else {
        return true;
      }
    }
    function joom_hover() {
      jg_photo_hover = (jg_photo_hover==1) ? 0 : 1;
    }';

    }

    if($this->_config->get('jg_cursor_navigation') == 1)
    {
      $script .= 'document.onkeydown = joom_cursorchange;';
    }

    $this->_doc->addScriptDeclaration($script);

    // MotionGallery
    if($this->_config->get('jg_minis') && $this->_config->get('jg_motionminis') == 2)
    {
      $this->_doc->addScript($this->_ambit->getScript('motiongallery.js'));
      $script = "\n"
              . "   /***********************************************\n"
              . "   * CMotion Image Gallery- © Dynamic Drive DHTML code library (www.dynamicdrive.com)\n"
              . "   * Visit http://www.dynamicDrive.com for hundreds of DHTML scripts\n"
              . "   * This notice must stay intact for legal use\n"
              . "   * Modified by Jscheuer1 for autowidth and optional starting positions\n"
              . "   ***********************************************/";
      $this->_doc->addScriptDeclaration($script);

      $custom = "  <!-- Do not edit IE conditional style below -->"
              . "\n"
              . "  <!--[if gte IE 5.5]>"
              . "\n"
              . "  <style type=\"text/css\">\n"
              . "     #motioncontainer {\n"
              . "       width:expression(Math.min(this.offsetWidth, maxwidth)+'px');\n"
              . "     }\n"
              . "  </style>\n"
              . "  <![endif]-->"
              . "\n"
              . "  <!-- End Conditional Style -->";
      $this->_doc->addCustomTag($custom);
    }

    // Icons
    if(!$slideshow)
    {
      // Zoom
      if($image->bigger_orig)
      {
        if(    ($this->_config->get('jg_bigpic') == 1 && $this->_user->get('aid') > 0)
            || ($this->_config->get('jg_bigpic') == 2)
          )
        {
          $params->set('show_zoom_icon', 1);
        }
        else if($this->_config->get('jg_bigpic') == 1 && $this->_user->get('aid') < 1)
        {
          $params->set('show_zoom_icon', -1);
        }
      }

      // Download
      if(    $image->orig_exists
          || $this->_config->get('jg_downloadfile') != 1
        )
      {
        if(    ($this->_config->get('jg_showdetaildownload') == 1 && $this->_user->get('aid') >= 1)
            || ($this->_config->get('jg_showdetaildownload') == 2 && $this->_user->get('aid') == 2)
            || ($this->_config->get('jg_showdetaildownload') == 3)
          )
        {
          $params->set('show_download_icon', 1);
          $params->set('download_link', JRoute::_('index.php?task=download&id='.$image->id));
        }
        else
        {
          if($this->_config->get('jg_showdetaildownload') == 1 && $this->_user->get('aid') < 1)
          {
            $params->set('show_download_icon', -1);
          }
        }
      }

      // Nametags
      if($this->_config->get('jg_nameshields') && $this->_user->get('id'))
      {
        if(!$this->_config->get('jg_nameshields_others'))
        {
          if(!$already_tagged)
          {
            $params->set('show_nametag_icon', 1);
          }
          else
          {
            $params->set('show_nametag_icon', 2);
            $params->set('nametag_link', JRoute::_('index.php?task=removenametag&id='.$image->id, false));
          }
        }
        else
        {
          $params->set('show_nametag_icon', 3);
        }
      }
      else
      {
        if(    $this->_config->get('jg_nameshields')
            && !$this->_user->get('id')
            && $this->_config->get('jg_show_nameshields_unreg')
          )
        {
          $params->set('show_nametag_icon', -1);
        }
      }

      // Favourites
      if($this->_config->get('jg_favourites'))
      {
        if(   ($this->_config->get('jg_showdetailfavourite') == 0 && $this->_user->get('aid') >= 1)
           || ($this->_config->get('jg_showdetailfavourite') == 1 && $this->_user->get('aid') == 2)
           || ($this->_config->get('jg_usefavouritesforpubliczip') == 1 && $this->_user->get('aid') < 1)
          )
        {
          $params->set('favourites_link', JRoute::_('index.php?task=addimage&id='.$image->id));
          if(     $this->_config->get('jg_usefavouritesforzip') == 1
              || ($this->_config->get('jg_usefavouritesforpubliczip') == 1 && $this->_user->get('aid') < 1)
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
          if($this->_config->get('jg_favouritesshownotauth') == 1)
          {
            if($this->_config->get('jg_usefavouritesforzip') == 1)
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

      // Report
      if($this->_config->get('jg_detail_report_images'))
      {
        if($this->_user->get('id') || $this->_config->get('jg_detail_report_images') == 2)
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
    }

    $extra = '';
    if($this->_config->get('jg_disable_rightclick_detail') == 1)
    {
      $extra = 'onmouseover="javascript:joom_hover();" onmouseout="javascript:joom_hover();"';
    }

    $event = new stdClass();

    if(!$slideshow)
    {
      if($this->_config->get('jg_lightbox_slide_all'))
      {
        $params->set('show_all_in_popup', 1);

        $popup = array();

        $popup['before']  = JHTML::_('joomgallery.popup', $images, 0, $image->position);
        $popup['after']   = JHTML::_('joomgallery.popup', $images, $image->position + 1);

        $this->assignRef('popup', $popup);
      }

      // Pane
      // Load modules at position 'detailpane'
      $modules['detailpane'] = JoomHelper::getRenderedModules('detailpane');
      if(count($modules['detailpane']))
      {
        $params->set('show_detailpane_modules', 1);
      }

      // Exif data
      if(    $this->_config->get('jg_showexifdata')
          && $image->orig_exists
          && extension_loaded('exif')
          && function_exists('exif_read_data')
        )
      {
        $exifdata = $this->get('Exifdata');
        if($exifdata)
        {
          $params->set('show_exifdata', 1);
          $this->assignRef('exifdata', $exifdata);
        }
      }

      // GeoTagging data
      if(    $this->_config->get('jg_geotagging')
          && $image->orig_exists
          && extension_loaded('exif')
          && function_exists('exif_read_data')
        )
      {
        $mapdata_array = $this->get('Mapdata');
        if($mapdata_array)
        {
          $mapdata = '';

          if(isset($mapdata_array['N']))
          {
            $mapdata .= $mapdata_array['N'];
          }
          else
          {
            if(isset($mapdata_array['S']))
            {
              $mapdata .= '-'.$mapdata_array['S'];
            }
          }

          $mapdata .= ', ';

          if(isset($mapdata_array['E']))
          {
            $mapdata .= $mapdata_array['E'];
          }
          else
          {
            if(isset($mapdata_array['W']))
            {
              $mapdata .= '-'.$mapdata_array['W'];
            }
          }

          if($mapdata)
          {
            $params->set('show_map', 1);
            $this->assignRef('mapdata', $mapdata);

            $this->_doc->addScript('http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key='.$this->_config->get('jg_geotagging'));

            $this->_ambit->script('JGS_DETAIL_MAPS_BROWSER_IS_INCOMPATIBLE');
          }
        }
      }

      // IPTC data
      if(    $this->_config->get('jg_showiptcdata')
          && $image->orig_exists
        )
      {
        $iptcdata = $this->get('Iptcdata');
        if($iptcdata)
        {
          $params->set('show_iptcdata', 1);
          $this->assignRef('iptcdata', $iptcdata);
        }
      }

      // Rating
      if($this->_config->get('jg_showrating'))
      {
        if($this->_config->get('jg_onlyreguservotes') && $this->_user->get('aid') == 0)
        {
          // Set voting_area to 3 to show only the message in template
          $params->set('show_voting_area', 3);
          $params->set('voting_message', JText::_('JGS_DETAIL_LOGIN_FIRST'));
        }
        else
        {
          if($this->_config->get('jg_onlyreguservotes') && $image->owner == $this->_user->get('id'))
          {
            // Set voting_area to 3 to show only the message in template
            $params->set('show_voting_area', 3);
            $params->set('voting_message', JText::_('JGS_DETAIL_RATING_NOT_ON_OWN_IMAGES'));
          }
          else
          {
            // Set to 1 will show the voting area
            $params->set('show_voting_area', 1);
            $params->set('ajaxvoting', $this->_config->get('jg_ajaxrating'));
            if($this->_config->get('jg_ratingdisplaytype') == 0)
            {
              // Set to 0 will show textual voting bar with radio buttons
              $params->set('voting_display_type', 0);

              $selected = floor($this->_config->get('jg_maxvoting') / 2) + 1;
              $voting   = '';
              // TODO: Use of JHTML::_('select.radiolist');
              for($i = 1; $i <= $this->_config->get('jg_maxvoting'); $i++)
              {
                if($i == $selected)
                {
                  $checked = ' checked="checked"';
                }
                else
                {
                  $checked = '';
                }

                $voting .= '
              <input type="radio" value="'.$i.'" name="imgvote"'.$checked.' />';
              }
              $maxvoting = $i-1;

              $this->assignRef('voting', $voting);
              $this->assignRef('maxvoting', $maxvoting);
            }
            else if($this->_config->get('jg_ratingdisplaytype') == 1)
            {
              // Set to 1 will show graphical voting bar with stars
              $params->set('voting_display_type', 1);

              $this->assignRef('maxvoting', $this->_config->get('jg_maxvoting'));
            }
          }
        }
      }

      if($this->_config->get('jg_bbcodelink'))
      {
        $current_uri  = & JURI::getInstance(JURI::base());
        $current_host = $current_uri->toString(array('scheme', 'host', 'port'));

        $params->set('show_bbcode', 1);

        if(    $this->_config->get('jg_bbcodelink') == 1
            || $this->_config->get('jg_bbcodelink') == 3
          )
        {
          // Ensure that the correct host and path is prepended
          $uri  = & JFactory::getUri($image->img_src);
          $uri->setHost($current_host);
          $params->set('bbcode_img', str_replace(array('&', 'http://http://'), array('&amp;', 'http://'), $uri->toString()));
        }

        if(    $this->_config->get('jg_bbcodelink') == 2
            || $this->_config->get('jg_bbcodelink') == 3
          )
        {
          $url = JRoute::_('index.php?view=detail&id='.$image->id).JHTML::_('joomgallery.anchor');

          // Ensure that the correct host and path is prepended
          $uri  = & JFactory::getUri($url);
          $uri->setHost($current_host);
          $params->set('bbcode_url', str_replace('&', '&amp;', $uri->toString()));
        }
      }

      if($this->_config->get('jg_showcomment'))
      {
        $params->set('show_comments_block', 1);

        // Check whether user is allowed to comment
        if(      $this->_config->get('jg_anoncomment')
            || (!$this->_config->get('jg_anoncomment') && $this->_user->get('id'))
          )
        {
          $params->set('commenting_allowed', 1);

          $plugins          = $this->_mainframe->triggerEvent('onJoomGetCaptcha');
          $event->captchas  = implode('', $plugins);

          $this->_doc->addScriptDeclaration('    var jg_use_code = '.$params->get('use_easycaptcha', 0).';');

          if($this->_config->get('jg_bbcodesupport'))
          {
            $params->set('bbcode_status', JText::_('JGS_DETAIL_BBCODE_ON'));
          }
          else
          {
            $params->set('bbcode_status', JText::_('JGS_DETAIL_BBCODE_OFF'));
          }

          if($this->_config->get('jg_smiliesupport'))
          {
            $params->set('smiley_support', 1);
            $smileys = JoomHelper::getSmileys();
            $this->assignRef('smileys', $smileys);
          }

          $this->_ambit->script('JGS_DETAIL_SENDTOFRIEND_ALERT_ENTER_NAME_EMAIL');
          $this->_ambit->script('JGS_DETAIL_COMMENTS_ALERT_ENTER_COMMENT');
          $this->_ambit->script('JGS_DETAIL_COMMENTS_ALERT_ENTER_CODE');
        }

        // Check whether user is allowed to read comments
        if(     $this->_user->get('username')
           || (!$this->_user->get('username') && $this->_config->get('jg_showcommentsunreg') == 0)
          )
        {
          $comments = $this->get('Comments');

          if(!$comments)
          {
            $params->set('no_comments_message', JText::_('JGS_DETAIL_COMMENTS_NOT_EXISTING'));
            if($params->get('commenting_allowed'))
            {
              $params->set('no_comments_message2', JText::_('JGS_DETAIL_COMMENTS_WRITE_FIRST'));
            }
          }
          else
          {
            $params->set('show_comments', 1);

            // Editor logged?
            if(    $this->_user->get('gid') > 23
                || $this->_user->get('gid') == 20
              )
            {
              $params->set('editor_logged', 1);
            }

            foreach($comments as $key => $comment)
            {
              // Display author name or notice that the author is a guest
              if($comment->userid)
              {
                $comments[$key]->author = JHTML::_('joomgallery.displayname', $comment->userid, 'comment');
              }
              else
              {
                if($this->_config->get('jg_namedanoncomment'))
                {
                  if($comment->cmtname != JText::_('JGS_COMMON_GUEST'))
                  {
                    $comments[$key]->author = JText::sprintf('JGS_DETAIL_COMMENTS_GUEST_NAME', $comment->cmtname);
                  }
                  else
                  {
                    $comments[$key]->author = $comment->cmtname;
                  }
                }
                else
                {
                  $comments[$key]->author = JText::_('JGS_COMMON_GUEST');
                }
              }

              // Process comment text
              $text     = $comment->cmttext;
              $text     = JoomHelper::processText($text);
              if($this->_config->get('jg_bbcodesupport'))
              {
                $text = JoomHelper::BBDecode($text);
              }
              if($this->_config->get('jg_smiliesupport'))
              {
                $smileys = JoomHelper::getSmileys();
                foreach($smileys as $i => $sm)
                {
                  $text = str_replace($i, '<img src="'.$sm.'" border="0" alt="'.$i.'" title="'.$i.'" />', $text);
                }
              }
              $comments[$key]->text = $text;
            }

            $this->assignRef('comments', $comments);
          }
        }
        else
        {
          $params->set('no_comments_message', JText::_('JGS_DETAIL_COMMENTS_NOT_FOR_UNREG'));
        }
      }

      if($this->_config->get('jg_send2friend'))
      {
        $params->set('show_send2friend_block', 1);

        if($this->_user->get('id'))
        {
          $params->set('show_send2friend_form', 1);
        }
        else
        {
          $params->set('send2friend_message', JText::_('JGS_DETAIL_LOGIN_FIRST'));
        }
      }
    }

    $icons        = $this->_mainframe->triggerEvent('onJoomDisplayIcons', array('detail.image', $image));
    $event->icons = implode('', $icons);

    $this->assignRef('params',          $params);
    $this->assignRef('pagination',      $pagination);
    $this->assignRef('image',           $image);
    $this->assignRef('images',          $images);
    $this->assignRef('extra',           $extra);
    $this->assignRef('slideshow',       $slideshow);
    $this->assignRef('slider',          $slider);
    $this->assignRef('toggler',         $toggler);
    $this->assignRef('pathway',         $pathway);
    $this->assignRef('modules',         $modules);
    $this->assignRef('event',           $event);
    $this->assignRef('backtarget',      $backtarget);
    $this->assignRef('backtext',        $backtext);
    $this->assignRef('numberofpics',    $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',  $numbers[1]);
    }

    $this->_doc->addScript($this->_ambit->getScript('detail.js'));

    parent::display($tpl);
  }
}