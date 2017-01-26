<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/config.php $
// $Id: config.php 2624 2011-01-02 19:50:37Z erftralle $
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
 * JoomGallery Configuration Helper
 *
 * Provides handling with all configuration settings of the gallery
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomConfig extends JObject
{
  /**
   * Configuration variables
   *
   * @access  protected
   * @var     string, int
   */
  var $jg_pathimages;
  var $jg_pathoriginalimages;
  var $jg_paththumbs;
  var $jg_pathftpupload;
  var $jg_pathtemp;
  var $jg_wmpath;
  var $jg_wmfile;
  var $jg_dateformat;
  var $jg_checkupdate;
  var $jg_filenamewithjs;
  var $jg_filenamesearch;
  var $jg_filenamereplace;
  var $jg_thumbcreation;
  var $jg_fastgd2thumbcreation;
  var $jg_impath;
  var $jg_resizetomaxwidth;
  var $jg_maxwidth;
  var $jg_picturequality;
  var $jg_useforresizedirection;
  var $jg_cropposition;
  var $jg_thumbwidth;
  var $jg_thumbheight;
  var $jg_thumbquality;
  var $jg_uploadorder;
  var $jg_useorigfilename;
  var $jg_filenamenumber;
  var $jg_delete_original;
  var $jg_wrongvaluecolor;
  var $jg_msg_upload_type;
  var $jg_msg_upload_recipients;
  var $jg_msg_comment_type;
  var $jg_msg_comment_recipients;
  var $jg_msg_comment_toowner;
  var $jg_msg_report_type;
  var $jg_msg_report_recipients;
  var $jg_msg_report_toowner;
  var $jg_realname;
  var $jg_cooliris;
  var $jg_coolirislink;
  var $jg_contentpluginsenabled;
  var $jg_itemid;
  var $jg_userspace;
  var $jg_approve;
  var $jg_usercat;
  var $jg_maxusercat;
  var $jg_userowncatsupload;
  var $jg_maxuserimage;
  var $jg_maxfilesize;
  var $jg_category;
  var $jg_usercategory;
  var $jg_usercatacc;
  var $jg_maxuploadfields;
  var $jg_useruploadnumber;
  var $jg_special_gif_upload;
  var $jg_delete_original_user;
  var $jg_newpiccopyright;
  var $jg_newpicnote;
  var $jg_showrating;
  var $jg_maxvoting;
  var $jg_ratingcalctype;
  var $jg_ratingdisplaytype;
  var $jg_ajaxrating;
  var $jg_onlyreguservotes;
  var $jg_showcomment;
  var $jg_anoncomment;
  var $jg_namedanoncomment;
  var $jg_approvecom;
  var $jg_bbcodesupport;
  var $jg_smiliesupport;
  var $jg_anismilie;
  var $jg_smiliescolor;
  var $jg_anchors;
  var $jg_tooltips;
  var $jg_dyncrop;
  var $jg_dyncropposition;
  var $jg_dyncropwidth;
  var $jg_dyncropheight;
  var $jg_firstorder;
  var $jg_secondorder;
  var $jg_thirdorder;
  var $jg_pagetitle_cat;
  var $jg_pagetitle_detail;
  var $jg_showgalleryhead;
  var $jg_showpathway;
  var $jg_completebreadcrumbs;
  var $jg_search;
  var $jg_showallpics;
  var $jg_showallhits;
  var $jg_showbacklink;
  var $jg_suppresscredits;
  var $jg_showuserpanel;
  var $jg_showallpicstoadmin;
  var $jg_showminithumbs;
  var $jg_openjs_padding;
  var $jg_openjs_background;
  var $jg_dhtml_border;
  var $jg_show_title_in_dhtml;
  var $jg_show_description_in_dhtml;
  var $jg_lightbox_speed;
  var $jg_lightbox_slide_all;
  var $jg_resize_js_image;
  var $jg_disable_rightclick_original;
  var $jg_showgallerysubhead;
  var $jg_showallcathead;
  var $jg_colcat;
  var $jg_catperpage;
  var $jg_ordercatbyalpha;
  var $jg_showgallerypagenav;
  var $jg_showcatcount;
  var $jg_showcatthumb;
  var $jg_showrandomcatthumb;
  var $jg_ctalign;
  var $jg_showtotalcatimages;
  var $jg_showtotalcathits;
  var $jg_showcatasnew;
  var $jg_catdaysnew;
  var $jg_showdescriptioningalleryview;
  var $jg_rmsm;
  var $jg_showrmsmcats;
  var $jg_showemptycats;
  var $jg_showsubsingalleryview;
  var $jg_showcathead;
  var $jg_usercatorder;
  var $jg_usercatorderlist;
  var $jg_showcatdescriptionincat;
  var $jg_showpagenav;
  var $jg_showpiccount;
  var $jg_perpage;
  var $jg_catthumbalign;
  var $jg_colnumb;
  var $jg_detailpic_open;
  var $jg_lightboxbigpic;
  var $jg_showtitle;
  var $jg_showpicasnew;
  var $jg_daysnew;
  var $jg_showhits;
  var $jg_showauthor;
  var $jg_showowner;
  var $jg_showcatcom;
  var $jg_showcatrate;
  var $jg_showcatdescription;
  var $jg_showcategorydownload;
  var $jg_showcategoryfavourite;
  var $jg_category_report_images;
  var $jg_showsubcathead;
  var $jg_showsubcatcount;
  var $jg_colsubcat;
  var $jg_subperpage;
  var $jg_showpagenavsubs;
  var $jg_subcatthumbalign;
  var $jg_showsubthumbs;
  var $jg_showrandomsubthumb;
  var $jg_showdescriptionincategoryview;
  var $jg_ordersubcatbyalpha;
  var $jg_showtotalsubcatimages;
  var $jg_showtotalsubcathits;
  var $jg_showdetailpage;
  var $jg_showdetailnumberofpics;
  var $jg_cursor_navigation;
  var $jg_disable_rightclick_detail;
  var $jg_detail_report_images;
  var $jg_report_images_notauth;
  var $jg_showdetailtitle;
  var $jg_showdetail;
  var $jg_showdetailaccordion;
  var $jg_showdetaildescription;
  var $jg_showdetaildatum;
  var $jg_showdetailhits;
  var $jg_showdetailrating;
  var $jg_showdetailfilesize;
  var $jg_showdetailauthor;
  var $jg_showoriginalfilesize;
  var $jg_showdetaildownload;
  var $jg_downloadfile;
  var $jg_downloadwithwatermark;
  var $jg_watermark;
  var $jg_watermarkpos;
  var $jg_bigpic;
  var $jg_bigpic_open;
  var $jg_bbcodelink;
  var $jg_showcommentsunreg;
  var $jg_showcommentsarea;
  var $jg_send2friend;
  var $jg_minis;
  var $jg_motionminis;
  var $jg_motionminiWidth;
  var $jg_motionminiHeight;
  var $jg_miniWidth;
  var $jg_miniHeight;
  var $jg_minisprop;
  var $jg_nameshields;
  var $jg_nameshields_others;
  var $jg_nameshields_unreg;
  var $jg_show_nameshields_unreg;
  var $jg_nameshields_height;
  var $jg_nameshields_width;
  var $jg_slideshow;
  var $jg_slideshow_timer;
  var $jg_slideshow_transition;
  var $jg_slideshow_transtime;
  var $jg_slideshow_maxdimauto;
  var $jg_slideshow_width;
  var $jg_slideshow_heigth;
  var $jg_slideshow_infopane;
  var $jg_slideshow_carousel;
  var $jg_slideshow_arrows;
  var $jg_showexifdata;
  var $jg_geotagging;
  var $jg_subifdtags;
  var $jg_ifdotags;
  var $jg_gpstags;
  var $jg_showiptcdata;
  var $jg_iptctags;
  var $jg_showtoplist;
  var $jg_toplist;
  var $jg_topthumbalign;
  var $jg_toptextalign;
  var $jg_toplistcols;
  var $jg_whereshowtoplist;
  var $jg_showrate;
  var $jg_showlatest;
  var $jg_showcom;
  var $jg_showthiscomment;
  var $jg_showmostviewed;
  var $jg_favourites;
  var $jg_showdetailfavourite;
  var $jg_favouritesshownotauth;
  var $jg_maxfavourites;
  var $jg_zipdownload;
  var $jg_usefavouritesforpubliczip;
  var $jg_usefavouritesforzip;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function __construct($id = null)
  {
    $db = & JFactory::getDBO();

    if(is_null($id))
    {
      // Later on create the ability for
      // different settings for each usertype
      /*$user = & JFactory::getUser();
      $id   = $user->get('gid');*/
      $id = 1;
    }

    $id = intval($id);

    $this->_id = $id;

    $config = & JTable::getInstance('joomgalleryconfig', 'Table');
    $config->load($this->_id);

    // Get config values
    $properties = $config->getProperties();
    foreach($properties as $key => $value)
    {
      $this->$key = $value;
    }
  }

  /**
   * Returns a reference to the global Config object, only creating it if it
   * doesn't already exist.
   *
   * This method must be invoked as:
   *    <pre>  $config = & JoomAmbit::getInstance();</pre>
   *
   * @access  public
   * @param   int         The ID of the requested configuration row
   * @return  JoomConfig  The Config object.
   * @since   1.5.5
   */
  function &getInstance($id = null)
  {
    static $instances;

    if(!isset($instances))
    {
      $instances = array();
    }

    if(empty($instances[$id]))
    {
      $config = new JoomConfig($id);
      $instances[$id] = $config;
    }

    return $instances[$id];
  }

  /**
   * Save configuration in database
   *
   * @access  public
   * @param   object/array  $newconfig  Holds the new settings to store
   * @param   boolean       $new        False if the current settings shall be overriden
   * @return  boolean True on successful insert/update of configuration, false otherwise
   * @since   1.5.5
   */
  function save($newconfig = null, $new = false)
  {
    if(!is_null($newconfig))
    {
      $data = (array) $newconfig;
    }
    else
    {
      $data = $this->getProperties();
    }

    $config = & JTable::getInstance('joomgalleryconfig', 'Table');

    if(!$new)
    {
      // Allow saving just for the current id (at the moment)
      $config->load($this->_id);
      #$config->id = $this->_id;
    }

    $config->bind($data);

    if(!$config->check())
    {
      return false;
    }

    if(!$config->store())
    {
      return false;
    }

    // Publish new config values
    $properties = $config->getProperties();
    foreach($properties as $key => $value)
    {
      $this->$key = $value;
    }

    if(!$this->_saveCSS())
    {
      return false;
    }

    return true;
  }

  /**
   * Save joom_settings.css according to the configuration settings
   *
   * @access  protected
   * @return  boolean   True on success, false otherwise
   * @since   1.5.5
   */
  function _saveCSS()
  {
    // Common settings

    // Calculation of colum widths
    // Gallery view
    $colwidth_gal = floor(99 / $this->jg_colcat);
    // Category view
    $colwidth_cat = floor(99 / $this->jg_colnumb);
    // Sub-category view
    $colwidth_subcat = floor(99 / $this->jg_colsubcat);

    // Alignment of container for text and image
    // if ct_align=0, alternating alignments
    // jg_element_gal
    $jg_gal_container = "";
    // jg_photo_container
    $jg_gal_elemimg = "";
    // jg_element_txt
    $jg_gal_elemtxt = "";
    $jg_gal_elemtxt_subs = "";

    // Gallery view
    // User defined alignment for category thumb
    if($this->jg_showcatthumb == 2 )
    {
      if($this->jg_colcat == 1)
      {
        $jg_gal_container = "  text-align:left !important;\n";
      }
      else
      {
        $jg_gal_container    = "  float:left;\n";
      }
    }
    // Activated random view of thumbs or no thumbs
    // Alignment on one columned view not with float, instead text-align
    if($this->jg_showcatthumb == 1 || $this->jg_showcatthumb == 0)
    {
      switch($this->jg_ctalign)
      {
        case 1:
          // Left aligned
          // One column -> text-align
          if($this->jg_colcat == 1)
          {
            $jg_gal_container = "  text-align:left !important;\n";
            $jg_gal_elemtxt = "  text-align:left !important; \n";
            $jg_gal_elemtxt_subs = "  text-align:left !important; \n";
          }
          else
          {
            $jg_gal_container = "  float:left;\n";
            $jg_gal_elemtxt = "  float:left;\n";
            $jg_gal_elemtxt_subs = "  float:left;\n";
          }
          break;
        case 2:
          // Right aligned
          // One column -> text-align
          if($this->jg_colcat == 1 || $this->jg_catperpage == 1)
          {
            $jg_gal_container = "  text-align:right !important;\n";
          }
          else
          {
            $jg_gal_container = "  float:right;\n";
          }
          $jg_gal_elemtxt = "  text-align:right !important;\n";
          $jg_gal_elemtxt_subs =  "  float:right;\n  text-align:right !important;";
          break;
        case 3:
          // Centered
          if ($this->jg_colcat == 1 || $this->jg_catperpage == 1)
          {
            $jg_gal_container = "  text-align:center;\n";
          }
          else
          {
            $jg_gal_container = "  float:left;\n";
          }
          $jg_gal_elemtxt      = "  text-align:center !important;\n";
          $jg_gal_elemtxt_subs = "  text-align:center !important;\n";
          break;

        default:
          // =0 alternating, classes with *_r implied right placement
          // in joomgallery.css
          $jg_gal_container    = "  float:left;\n";
          $jg_gal_elemtxt      = "  text-align:left !important;\n";
          $jg_gal_elemtxt_subs = "  text-align:left !important;\n";
          break;
      }

      // Alignment of thumb
      // Only with activated random view
      switch($this->jg_ctalign)
      {
        case 1:
          // Left aligned
          $jg_gal_elemimg = "  float:left;\n";
          break;
        case 2:
          // Right aligned
          $jg_gal_elemimg = "  float:right;\n";
          break;
        case 3:
          // Centered
          $jg_gal_elemimg = "  text-align:center !important;\n";
          break;
        default:
          // Alternating
          $jg_gal_elemimg = "  float:left;\n";
          break;
      }
    }

    // Category view
    switch($this->jg_catthumbalign)
    {
      case 1:
        // Left aligned
        $cat_container="  float:left;";
        $cat_photo="  float:left;";
        $cat_txt="  text-align:left !important;";
        break;
      case 2:
        // Right aligned
        $cat_container="  float:right;\n  text-align:right !important;";
        $cat_photo="  text-align:right !important;";
        $cat_txt="  text-align:right !important;";
        break;
      case 3:
        // Centered
        if($this->jg_colnumb == 1)
        {
          $cat_container="  text-align:center !important;";
          $cat_photo="  text-align:center !important;";
          $cat_txt="  display:block;\n  text-align:center !important;";
        }
        else
        {
          $cat_container="  float:left;\n  text-align:center !important;";
          $cat_photo="  text-align:center !important;";
          $cat_txt="  text-align:center !important;";
        }
        break;
    }

    // Sub-category view
    // User defined alignment for subcategory thumb
    if($this->jg_showsubthumbs == 1 )
    {
      if($this->jg_colsubcat == 1)
      {
        $subcat_container = "  text-align:left !important;\n";
      }
      else
      {
        $subcat_container    = "  float:left;\n";
      }
    }
    // Activated random view of thumbs or no thumbs
    if($this->jg_showsubthumbs == 2 || $this->jg_showsubthumbs == 0)
    {
      switch($this->jg_subcatthumbalign)
      {
        case 1:
          // Left aligned
          if($this->jg_colsubcat == 1)
          {
            $subcat_container="  text-align:left !important;";
            $subcat_photo="  float:left;";
            $subcat_txt="  text-align:left !important;";
          }
          else
          {
            $subcat_container="  float:left;";
            $subcat_photo="  float:left;";
            $subcat_txt="  text-align:left !important;";
          }
          break;
        case 2:
          // Right aligned
          if($this->jg_colsubcat == 1)
          {
            $subcat_container="  text-align:right !important;";
            $subcat_photo="  float:right;";
            $subcat_txt="  text-align:right !important;";
          }
          else
          {
            $subcat_container="  float:right;\n  text-align:right !important;";
            $subcat_photo="  float:right;";
            $subcat_txt="  text-align:right !important;";
          }
          break;
        case 3:
          // Centered
          if($this->jg_colsubcat == 1)
          {
            $subcat_container="  text-align:center !important;";
            $subcat_photo="  text-align:center !important;";
            $subcat_txt="  display:block;\n  text-align:center !important;";
          }
          else
          {
            $subcat_container="  float:left;\n  text-align:center !important;";
            $subcat_photo="  text-align:center !important;\n";
            $subcat_txt="  clear:both;\n  text-align:center !important;";
          }
          break;
      }
    }

    // Toplist view
    $colwidth_top = floor (99 / $this->jg_toplistcols);

    // Only if activated
    if($this->jg_showtoplist != 0)
    {
      switch($this->jg_topthumbalign)
      {
        case 1:
          // Image left aligned
          if($this->jg_toplistcols == 1)
          {
            $top_container="";
            $top_photo="  width:49%;\n  float:left;";

            switch($this->jg_toptextalign)
            {
              // Alignment of text
              case 1:
                // Left aligned
                $top_txt="  text-align:left !important;";
                break;
              case 2:
                // Right aligned
                $top_txt="  text-align: right !important;";
                break;
              case 3:
                // Centered
                $top_txt="  text-align: center !important;";
                break;
            }
            $top_txt .= "\n  width:49%;\n  float:left;";
          }
          else
          {
            $top_container="  float:left;\n  height:100%;";
            $top_photo="";
            $top_txt="  text-align:left !important;";
          }
          break;

        case 2:
          // Image right aligned
          if($this->jg_toplistcols == 1)
          {
            $top_container="";
            $top_photo="  width:49%;\n  float:left;\n  text-align:right !important;";

            switch($this->jg_toptextalign)
            {
              // Alignment of text
              case 1:
                // Left aligned
                $top_txt="  text-align:left !important;";
                break;
              case 2:
                // Right aligned
                $top_txt="  text-align: right !important;";
                break;
              case 3:
                // Centered
                $top_txt="  text-align: center !important;";
                break;
            }
            $top_txt .= "\n  width:49%;\n  float:left;";
          }
          else
          {
            $top_container="  float:left;\n  height:100%;\n  text-align:right !important;";
            $top_photo="";
            $top_txt="  text-align: right !important;";
          }
          break;

        case 3:
          // Image centered
          if($this->jg_toplistcols == 1)
          {
            $top_container="";
            $top_photo="  width:49%;\n  float:left;\n  text-align:center;";

            switch($this->jg_toptextalign)
            {
              // Alignment of text
              case 1:
                // Left aligned
                $top_txt="  text-align:left !important;";
                break;
              case 2:
                // Right aligned
                $top_txt="  text-align: right !important;";
                break;
              case 3:
                // Centered
                $top_txt="  text-align: center !important;";
                break;
            }
            $top_txt .= "\n  width:49%;\n  float:left;";
          }
          else
          {
            $top_container="  float:left;\n  height:100%;\n  text-align:center !important;";
            $top_photo="";
            $top_txt="  text-align: center !important;";
          }
          break;
      }
    }

    // Detail view
    if($this->jg_minis != 0 && $this->jg_minisprop == 2 )
    {
      $minidimensions  = "height:".$this->jg_miniHeight."px";
    }
    else
    {
      if($this->jg_minisprop == 1 )
      {
        $minidimensions  = "width:".$this->jg_miniWidth."px";
      }
      else
      {
        $minidimensions  = "width:".$this->jg_miniWidth."px;\n";
        $minidimensions .= "height:".$this->jg_miniHeight."px;\n";
      }
    }

    // Composing and output of CSS

    $css_settings = "
/* Joomgallery CSS
CSS Styles generated by settings in the Joomgallery backend.
DO NOT EDIT - this file will be overwritten every time the config is saved.
Adjust your styles in joom_local.css instead.

CSS Styles, die ueber die Speicherung der Konfiguration im Backend erzeugt werden.
BITTE NICHT VERAENDERN - diese Datei wird  mit dem naechsten Speichern ueberschrieben.
Bitte nehmen Sie Aenderungen in der Datei joom_local.css in diesem
Verzeichnis vor. Sie koennen sie neu erstellen oder die schon vorhandene
joom_local.css.README umbenennen und anpassen
*/\n\n";

    // Gallery view
    $css_settings .= "/* Gallery view */\n";

    // Container with eventually picture and categorytext
    $css_settings .= ".jg_element_gal, .jg_element_gal_r {\n";
    $css_settings .= $jg_gal_container;
    $css_settings .= "  width:".$colwidth_gal."%;\n";
    $css_settings .= "}\n";

    // Text
    $css_settings .= ".jg_element_txt {\n";
    $css_settings .= $jg_gal_elemtxt;
    $css_settings .= "}\n";

    // Text sub-categories
    $css_settings .= ".jg_element_txt_subs {\n";
    $css_settings .= $jg_gal_elemtxt_subs;
    $css_settings .= "  font-size: 0.9em;\n";
    $css_settings .= "}\n";

    // Image if activated
    if($this->jg_showcatthumb == 1 && !empty($jg_gal_elemimg))
    {
      $css_settings .= ".jg_photo_container {\n";
      $css_settings .= $jg_gal_elemimg;
      $css_settings .= "}\n";
    }

    // Category view
    $css_settings .= "\n/* Category view */\n";
    $css_settings .= ".jg_element_cat {\n";
    $css_settings .= "  width:".$colwidth_cat."%;\n";
    $css_settings .= $cat_container."\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_catelem_cat a{\n";
    $css_settings .= "  height:".$this->jg_thumbheight."px;\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_catelem_photo {\n";
    $css_settings .= $cat_photo."\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_catelem_txt {\n";
    $css_settings .= $cat_txt."\n";
    $css_settings .= "}\n";
    if($this->jg_ratingdisplaytype == 1)
    {
      // Rating with star graphic
      $css_settings .= ".jg_starrating_cat {\n";
      $css_settings .= "  width:".(int)($this->jg_maxvoting * 16)."px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_gr.png".") 0 0 repeat-x;\n";
      switch($this->jg_catthumbalign)
      {
        case 2:
          $css_settings .= "  margin-left: auto;\n";
          break;
        case 3:
          $css_settings .= "  margin: 0 auto;\n";
          break;
        default:
          break;
      }
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_cat div {\n";
      $css_settings .= "  height:16px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_orange.png".") 0 0 repeat-x;\n";
      $css_settings .= "  margin-left: 0;\n";
      $css_settings .= "  margin-right: auto;\n";
      $css_settings .= "}\n";
    }

    // Sub-category view
    $css_settings .= "\n/* Subcategory view */\n";
    $css_settings .= ".jg_subcatelem_cat, .jg_subcatelem_cat_r{\n";
    $css_settings .= "  width:".$colwidth_subcat."%;\n";
    $css_settings .= $subcat_container."\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_subcatelem_cat a{\n";
    $css_settings .= "  height:".$this->jg_thumbheight."px;\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_subcatelem_photo {\n";
    $css_settings .= $subcat_photo."\n";
    $css_settings .= "}\n";
    $css_settings .= ".jg_subcatelem_txt {\n";
    $css_settings .= $subcat_txt."\n";
    $css_settings .= "}\n";

    // Detail view
    $css_settings .= "\n/* Detail view */\n";
    // Motiongallery only if activated
    if($this->jg_minis != 0)
    {
      $css_settings .= ".jg_minipic {\n";
      $css_settings .= "  ".$minidimensions.";\n";
      $css_settings .= "}\n";

      $css_settings .= "#motioncontainer {\n";
      $css_settings .= "  width:".$this->jg_motionminiWidth."px; /* Set to gallery width, in px or percentage */\n";
      $css_settings .= "  height:".$this->jg_motionminiHeight."px;/* Set to gallery height */\n";
      $css_settings .= "}\n";
    }
    if($this->jg_ratingdisplaytype == 1)
    {
      // Rating with star graphic
      $css_settings .= ".jg_starrating_detail {\n";
      $css_settings .= "  width:".(int)($this->jg_maxvoting * 16)."px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_gr.png".") 0 0 repeat-x;\n";
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_detail div {\n";
      $css_settings .= "  height:16px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_orange.png".") 0 0 repeat-x;\n";
      $css_settings .= "}\n";
      // Rating bar
      $css_settings .= ".jg_starrating_bar,\n";
      $css_settings .= ".jg_starrating_bar div:hover,\n";
      $css_settings .= ".jg_starrating_bar div:active,\n";
      $css_settings .= ".jg_starrating_bar div:focus,\n";
      $css_settings .= ".jg_starrating_bar .jg_current-rating {\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_rating.png) left -1000px repeat-x;\n";
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_bar {\n";
      $css_settings .= "  position:relative;\n";
      $css_settings .= "  width:".(int)($this->jg_maxvoting * 24)."px;\n";
      $css_settings .= "  height:24px;\n";
      $css_settings .= "  overflow:hidden;\n";
      $css_settings .= "  list-style:none;\n";
      $css_settings .= "  margin:0px auto !important;\n";
      $css_settings .= "  padding:0 !important;\n";
      $css_settings .= "  background-position:left top;\n";
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_bar li {\n";
      $css_settings .= "  display:inline;\n";
      $css_settings .= "  padding:0 !important;\n";
      $css_settings .= "  margin:0 !important;\n";
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_bar div,\n";
      $css_settings .= ".jg_starrating_bar .jg_current-rating {\n";
      $css_settings .= "  position:absolute;\n";
      $css_settings .= "  top:0;\n";
      $css_settings .= "  left:0;\n";
      $css_settings .= "  text-indent:-1000em;\n";
      $css_settings .= "  height:24px;\n";
      $css_settings .= "  line-height:24px;\n";
      $css_settings .= "  outline:none;\n";
      $css_settings .= "  overflow:hidden;\n";
      $css_settings .= "  border: none;\n";
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_bar div:hover,\n";
      $css_settings .= ".jg_starrating_bar div:active,\n";
      $css_settings .= ".jg_starrating_bar div:focus {\n";
      $css_settings .= "  background-position:left bottom;\n";
      $css_settings .= "}\n";
      for($i=0; $i<$this->jg_maxvoting; $i++)
      {
        $css_settings .= ".jg_starrating_bar div.jg_star_".($i + 1)." {\n";
        $css_settings .= "  width:".(int)(100.0 / (float)$this->jg_maxvoting * (float)($i + 1))."%;\n";
        $css_settings .= "  z-index:".(($this->jg_maxvoting + 1) - $i).";\n";
        $css_settings .= "  cursor:pointer;\n";
        $css_settings .= "  display:inline;\n";
        $css_settings .= "}\n";
      }
      $css_settings .= ".jg_starrating_bar .jg_current-rating {\n";
      $css_settings .= "  z-index:1;\n";
      $css_settings .= "  background-position:left center;\n";
      $css_settings .= "}\n";
    }

    // Name tags only if activated
    if($this->jg_nameshields != 0)
    {
      $css_settings .=".nameshield {\n";
      $css_settings .="  line-height:".$this->jg_nameshields_height."px;\n";
      $css_settings .="}\n";
    }

    // Toplist view (special)
    $css_settings .= "\n/* Special view - Toplists*/\n";
    $css_settings .= ".jg_topelement, .jg_favelement {\n";
    $css_settings .= "  width:".$colwidth_top."%;\n";
    $css_settings .= "  height:auto;\n";
    $css_settings .= $top_container."\n";
    $css_settings .= "}\n";

    $css_settings .= ".jg_topelem_photo, .jg_favelem_photo {\n";
    $css_settings .= $top_photo."\n";
    $css_settings .= "}\n";

    $css_settings .= ".jg_topelem_txt, .jg_favelem_txt {\n";
    $css_settings .= $top_txt."\n";
    $css_settings .= "}\n";

    if($this->jg_ratingdisplaytype == 1)
    {
      // Rating with star graphic
      $css_settings .= ".jg_starrating_fav, .jg_starrating_top  {\n";
      $css_settings .= "  width:".(int)($this->jg_maxvoting * 16)."px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_gr.png".") 0 0 repeat-x;\n";
      $setting = (($this->jg_toplistcols == 1) ? $this->jg_toptextalign : $this->jg_topthumbalign);
      switch($setting)
      {
        case 2:
          $css_settings .= "  margin-left: auto;\n";
          break;
        case 3:
          $css_settings .= "  margin: 0 auto;\n";
          break;
        default:
          break;
      }
      $css_settings .= "}\n";
      $css_settings .= ".jg_starrating_fav div, .jg_starrating_top div {\n";
      $css_settings .= "  height:16px;\n";
      $css_settings .= "  background: url(".JURI::root()."components/"._JOOM_OPTION."/assets/images/star_orange.png".") 0 0 repeat-x;\n";
      $css_settings .= "  margin-left: 0;\n";
      $css_settings .= "  margin-right: auto;\n";
      $css_settings .= "}\n";
    }

    // Save the file
    jimport('joomla.filesystem.file');
    $css_settings_file = JPATH_ROOT.DS.'components'.DS._JOOM_OPTION.DS.'assets'.DS.'css'.DS.'joom_settings.css';
    if(!JFile::write($css_settings_file, $css_settings))
    {
      return false;
    }

    return true;
  }
}