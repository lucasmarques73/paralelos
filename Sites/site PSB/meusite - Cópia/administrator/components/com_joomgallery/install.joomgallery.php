<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/install.joomgallery.php $
// $Id: install.joomgallery.php 2639 2011-01-09 19:29:51Z mab $
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
 * Install method
 * is called by the installer of Joomla!
 *
 * @access  protected
 * @return  void
 * @since   1.5.5
 */
function com_install()
{
  $mainframe  = & JFactory::getApplication('administrator');
  $db         = & JFactory::getDBO();
  jimport('joomla.filesystem.file');
  jimport('joomla.filesystem.folder');

  // CCS Styles
  $cssfile  = '
  <style type="text/css">
p {
  margin:0.3em 0;
  padding:0.2em 0;
}
.infobox {
  margin:0.5em 0;
  padding:0.4em 0 0.4em 1em;
  background-color:#f0f0f0;
  border:2px solid #000;
}
.headline {
  font-size:1.5em;
  text-align:center;
  font-weight:bold;
}
.headline2 {
  font-size:1.3em;
  text-align:center;
  font-weight:bold;
}
.headline3 {
  text-align:center;
  font-weight:bold;
}
.oktext {
  color:#2d2;
  font-weight:bold;
}
.notoktext {
  color:#d22;
  font-weight:bold;
}
.noticetext {
  color:#f38201;
  font-weight:bold;
}
.button2-left{
  margin-top:10px;
  margin-bottom:30px;
}
.jg_floatright{
  float:right;
}
</style>';

  echo $cssfile;

  //$src  = 'components' .DS. 'com_joomgallery' .DS. 'mod_joomadminmodule';
  //$dest = 'modules' .DS. 'mod_joomadminmodule';

  /*if(!JFolder::move($src, $dest, JPATH_ADMINISTRATOR)){
    $mainframe->enqueueMessage( JText::_('Unable to install JoomAdminModule!') );
  }*/

  $install  = true;
  $xml = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'joomgallery.xml';
  if(JFile::exists($xml))
  {
    $install = false;
  }

  if($install)
  {
    $abort = false;
    if(version_compare('5', PHP_VERSION, '>'))
    {
      $abort = true;
      JError::raiseWarning(100, 'JoomGallery needs at least PHP5 to run smoothly.');
    }
    if(version_compare('4.1', $db->getVersion(), '>'))
    {
      $abort = true;
      JError::raiseWarning(100, 'JoomGallery needs at least MySQL 4.1 (better MySQL 5) to run smoothly.');
    }
    if($abort)
    {
      return false;
    }

    // Insert configuration settings
    $db = & JFactory::getDBO();
    $query = "
INSERT IGNORE INTO `#__joomgallery_config`
  VALUES (
  /* id */ 1,
  /* ### General settings->path and directories ####*/
  /*jg_pathimages*/         'images/joomgallery/details/',
  /*jg_pathoriginalimages*/ 'images/joomgallery/originals/',
  /*jg_paththumbs*/         'images/joomgallery/thumbnails/',
  /*jg_pathftpupload*/      'components/com_joomgallery/ftp_upload/',
  /*jg_pathtemp*/           'administrator/components/com_joomgallery/temp/',
  /*jg_wmpath*/             'components/com_joomgallery/assets/images/',
  /*jg_wmfile*/             'watermark.png',
  /*jg_dateformat*/         '%d.%m.%Y %H:%M:%S',
  /*jg_checkupdate*/        1,

  /* ### General settings->Replacements ####*/
  /*jg_filenamewithjs*/     1,
  /*jg_filenamesearch*/     'ä|ö|ü|ß',
  /*jg_filenamereplace*/    'ae|oe|ue|ss',

  /* ### General settings->Image Processing ####*/
  /*jg_thumbcreation*/          'gd2',
  /*jg_fastgd2thumbcreation*/   1,
  /*jg_impath*/                 '',
  /*jg_resizetomaxwidth*/       1,
  /*jg_maxwidth*/               400,
  /*jg_picturequality*/         100,
  /*jg_useforresizedirection*/  0,
  /*jg_cropposition*/           2,
  /*jg_thumbwidth*/             133,
  /*jg_thumbheight*/            100,
  /*jg_thumbquality*/           100,

  /* ### General settings->Backend Upload ####*/
  /*jg_uploadorder*/        1,
  /*jg_useorigfilename*/    0,
  /*jg_filenamenumber*/     1,
  /*jg_delete_original*/    0,
  /*jg_wrongvaluecolor*/    '#f00',

  /* ### General settings->Messages ####*/
  /*jg_msg_upload_type*/        2,
  /*jg_msg_upload_recipients*/  '',
  /*jg_msg_comment_type*/       2,
  /*jg_msg_comment_recipients*/ '',
  /*jg_msg_comment_toowner*/    0,
  /*jg_msg_report_type*/       2,
  /*jg_msg_report_recipients*/ '',
  /*jg_msg_report_toowner*/    0,

  /* ### General settings->Additional functions ####*/
  /*jg_realname*/               0,
  /*jg_cooliris*/               0,
  /*jg_coolirislink*/           0,
  /*jg_contentpluginsenabled*/  1,
  /*jg_itemid*/                 '',

  /* ### User Access rights->User upload ####*/
  /*jg_userspace*/            1,
  /*jg_approve*/              0,
  /*jg_usercat*/              1,
  /*jg_maxusercat*/           10,
  /*jg_userowncatsupload*/    0,
  /*jg_maxuserimage*/         500,
  /*jg_maxfilesize*/          2000000,
  /*jg_category*/             '',
  /*jg_usercategory*/         '',
  /*jg_usercatacc*/           1,
  /*jg_useruploadsingle*/     1,
  /*jg_maxuploadfields*/      3,
  /*jg_useruploadbatch*/      1,
  /*jg_useruploadjava*/       1,
  /*jg_useruploadnumber*/     0,
  /*jg_special_gif_upload*/   1,
  /*jg_delete_original_user*/ 2,
  /*jg_newpiccopyright*/      1,
  /*jg_newpicnote*/           1,

  /* ### User Access rights->Rating ####*/
  /*jg_showrating*/         1,
  /*jg_maxvoting*/          5,
  /*jg_ratingcalctype*/     0,
  /*jg_ratingdisplaytype*/  0,
  /*jg_ajaxrating*/         0,
  /*jg_onlyreguservotes*/   0,

  /* ### User Access rights->Comments ####*/
  /*jg_showcomment*/      1,
  /*jg_anoncomment*/      1,
  /*jg_namedanoncomment*/ 1,
  /*jg_approvecom*/       1,
  /*jg_bbcodesupport*/    1,
  /*jg_smiliesupport*/    1,
  /*jg_anismilie*/        0,
  /*jg_smiliescolor*/     'grey',

  /* ### Frontend Settings->General Settings ####*/
  /*jg_anchors*/         1,
  /*jg_tooltips*/        2,
  /*jg_dyncrop*/         0,
  /*jg_dyncropposition*/ 2,
  /*jg_dyncropwidth*/    100,
  /*jg_dyncropheight*/   100,
  /* ### Frontend Settings->Picture Ordering ####*/
  /*jg_firstorder*/   'ordering ASC',
  /*jg_secondorder*/  'imgdate DESC',
  /*jg_thirdorder*/   'imgtitle DESC',

  /* ### Frontend Settings->Page Title ####*/
  /*jg_pagetitle_cat*/    '[! JGS_COMMON_CATEGORY!]: #cat',
  /*jg_pagetitle_detail*/ '[! JGS_COMMON_CATEGORY!]: #cat - [! JGS_COMMON_IMAGE!]:  #img',

  /* ### Frontend Settings->Header and Footer ####*/
  /*jg_showgalleryhead*/      1,
  /*jg_showpathway*/          1,
  /*jg_completebreadcrumbs*/  1,
  /*jg_search*/               0,
  /*jg_showallpics*/          3,
  /*jg_showallhits*/          1,
  /*jg_showbacklink*/         3,
  /*jg_suppresscredits*/      1,

  /* ### Frontend Settings->User Panel ####*/
  /*jg_showuserpanel*/      3,
  /*jg_showallpicstoadmin*/ 1,
  /*jg_showminithumbs*/     1,

  /* ### Frontend Settings->Popup Functions ####*/
  /*jg_openjs_padding*/               10,
  /*jg_openjs_background*/            '#fff',
  /*jg_dhtml_border*/                 '#808080',
  /*jg_show_title_in_dhtml*/          0,
  /*jg_show_description_in_dhtml*/    1,
  /*jg_lightbox_speed*/               5,
  /*jg_lightbox_slide_all*/           1,
  /*jg_resize_js_image*/              1,
  /*jg_disable_rightclick_original*/  1,

  /* ### Gallery View->General Settings ####*/
  /*jg_showgallerysubhead*/           1,
  /*jg_showallcathead*/               1,
  /*jg_colcat*/                       3,
  /*jg_catperpage*/                   9,
  /*jg_ordercatbyalpha*/              0,
  /*jg_showgallerypagenav*/           1,
  /*jg_showcatcount*/                 1,
  /*jg_showcatthumb*/                 1,
  /*jg_showrandomcatthumb*/           3,
  /*jg_ctalign*/                      1,
  /*jg_showtotalcatimages*/           1,
  /*jg_showtotalcathits*/             1,
  /*jg_showcatasnew*/                 1,
  /*jg_catdaysnew*/                   7,
  /*jg_showdescriptioningalleryview*/ 1,
  /*jg_rmsm*/                         1,
  /*jg_showrmsmcats*/                 1,
  /*jg_showsubsingalleryview*/        0,

  /* ### Category View->General Settings ####*/
  /*jg_showcathead*/              1,
  /*jg_usercatorder*/             1,
  /*jg_usercatorderlist*/         'date,title',
  /*jg_showcatdescriptionincat*/  1,
  /*jg_showpagenav*/              2,
  /*jg_showpiccount*/             1,
  /*jg_perpage*/                  8,
  /*jg_catthumbalign*/            1,
  /*jg_colnumb*/                  2,
  /*jg_detailpic_open*/           0,
  /*jg_lightboxbigpic*/           1,
  /*jg_showtitle*/                1,
  /*jg_showpicasnew*/             1,
  /*jg_daysnew*/                  10,
  /*jg_showhits*/                 1,
  /*jg_showauthor*/               1,
  /*jg_showowner*/                1,
  /*jg_showcatcom*/               1,
  /*jg_showcatrate*/              1,
  /*jg_showcatdescription*/       1,
  /*jg_showcategorydownload*/     0,
  /*jg_showcategoryfavourite*/    0,
  /*jg_category_report_images*/   0,

  /* ### Category View->Sub-Categories ####*/
  /*jg_showsubcathead*/                 1,
  /*jg_showsubcatcount*/                1,
  /*jg_colsubcat*/                      2,
  /*jg_subperpage*/                     8,
  /*jg_showpagenavsubs*/                1,
  /*jg_subcatthumbalign*/               3,
  /*jg_showsubthumbs*/                  2,
  /*jg_showrandomsubthumb*/             1,
  /*jg_showdescriptionincategoryview*/  1,
  /*jg_ordersubcatbyalpha*/             0,
  /*jg_showtotalsubcatimages*/          1,
  /*jg_showtotalsubcathits*/            1,

  /* ### Detail View->General Settings ####*/
  /*jg_showdetailpage*/             1,
  /*jg_showdetailnumberofpics*/     1,
  /*jg_cursor_navigation*/          1,
  /*jg_disable_rightclick_detail*/  0,
  /*jg_detail_report_images*/       1,
  /*jg_report_images_notauth*/      1,
  /*jg_showdetailtitle*/            1,
  /*jg_showdetail*/                 1,
  /*jg_showdetailaccordion*/        0,
  /*jg_showdetaildescription*/      1,
  /*jg_showdetaildatum*/            1,
  /*jg_showdetailhits*/             1,
  /*jg_showdetailrating*/           1,
  /*jg_showdetailfilesize*/         1,
  /*jg_showdetailauthor*/           1,
  /*jg_showoriginalfilesize*/       1,
  /*jg_showdetaildownload*/         1,
  /*jg_downloadfile*/               2,
  /*jg_downloadwithwatermark*/      1,
  /*jg_watermark*/                  0,
  /*jg_watermarkpos*/               9,
  /*jg_bigpic*/                     2,
  /*jg_bigpic_open*/                6,
  /*jg_bbcodelink*/                 3,
  /*jg_showcommentsunreg*/          1,
  /*jg_showcommentsarea*/           2,
  /*jg_send2friend*/                1,

  /* ### Detail View->Motiongallery ####*/
  /*jg_minis*/            1,
  /*jg_motionminis*/      2,
  /*jg_motionminiWidth*/  400,
  /*jg_motionminiHeight*/ 50,
  /*jg_miniWidth*/        28,
  /*jg_miniHeight*/       28,
  /*jg_minisprop*/        2,

  /* ### Detail View->Nametags ####*/
  /*jg_nameshields*/            0,
  /*jg_nameshields_others*/     1,
  /*jg_nameshields_unreg*/      1,
  /*jg_show_nameshields_unreg*/ 0,
  /*jg_nameshields_height*/     10,
  /*jg_nameshields_width*/      6,

  /* ### Detail View->Slideshow Settings ####*/
  /*jg_slideshow*/              1,
  /*jg_slideshow_timer*/        6000,
  /*jg_slideshow_transition*/   0,
  /*jg_slideshow_transtime*/    2000,
  /*jg_slideshow_maxdimauto*/   0,
  /*jg_slideshow_width*/        640,
  /*jg_slideshow_heigth*/       480,
  /*jg_slideshow_infopane*/     0,
  /*jg_slideshow_carousel*/     0,
  /*jg_slideshow_arrows*/       0,

  /* ### Detail View->Exif data ####*/
  /*jg_showexifdata*/   0,
  /*jg_geotagging*/     '',
  /*jg_subifdtags*/     '',
  /*jg_ifdotags*/       '',
  /*jg_gpstags*/        '',

  /* ### Detail View->IPTC data ####*/
  /*jg_showiptcdata*/   0,
  /*jg_iptctags*/       '',

  /* ### Toplists ####*/
  /*jg_showtoplist*/        2,
  /*jg_toplist*/            12,
  /*jg_topthumbalign*/      1,
  /*jg_toptextalign*/       1,
  /*jg_toplistcols*/        1,
  /*jg_whereshowtoplist*/   0,
  /*jg_showrate*/           1,
  /*jg_showlatest*/         1,
  /*jg_showcom*/            1,
  /*jg_showthiscomment*/    1,
  /*jg_showmostviewed*/     1,

  /* ### Favorites ####*/
  /*jg_favourites*/                 0,
  /*jg_showdetailfavourite*/        0,
  /*jg_favouritesshownotauth*/      0,
  /*jg_maxfavourites*/              0,
  /*jg_zipdownload*/                0,
  /*jg_usefavouritesforpubliczip*/  0,
  /*jg_usefavouritesforzip*/        0
  );";

    $db->setQuery($query);
    if(!$db->query())
    {
      $mainframe->enqueueMessage(JText::_('Unable to insert default configuration data!'));
      return false;
    }

    // Create image directories
    require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'file.php');
    $thumbpath  = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'thumbnails';
    $imgpath    = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'details';
    $origpath   = JPATH_ROOT.DS.'images'.DS.'joomgallery'.DS.'originals';
    $result     = array();
    $result[]   = JFolder::create($thumbpath);
    $result[]   = JoomFile::copyIndexHtml($thumbpath);
    $result[]   = JFolder::create($imgpath);
    $result[]   = JoomFile::copyIndexHtml($imgpath);
    $result[]   = JFolder::create($origpath);
    $result[]   = JoomFile::copyIndexHtml($origpath);

    if(in_array(false, $result))
    {
      $mainframe->enqueueMessage(JText::_('Unable to create image directories!'));
      return false;
    }

    // Create news feed module
    $subdomain = '';
    $language = & JFactory::getLanguage();
    if(strpos($language->getTag(), 'de-') === false)
    {
      $subdomain = 'en.';
    }

    $row = & JTable::getInstance('module');
    $row->title = 'JoomGallery News';
    $row->ordering = 1;
    $row->position = 'joom_cpanel';
    $row->published = 1;
    $row->showtitle = 1;
    $row->iscore = 0;
    $row->access = 0;
    $row->client_id = 1;
    $row->module = 'mod_feed';
    $row->params = 'cache=1
    cache_time=15
    moduleclass_sfx=
    rssurl=http://www.'.$subdomain.'joomgallery.net/feed/rss.html
    rssrtl=0
    rsstitle=1
    rssdesc=0
    rssimage=1
    rssitems=3
    rssitemdesc=1
    word_count=30';
    if(!$row->store())
    {
      $mainframe->enqueueMessage(JText::_('Unable to insert feed module data!'));
      return false;
    }

    // joom_settings.css
    $temp = JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_settings.temp.css';
    $dest = JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_settings.css';

    if(!JFile::move($temp, $dest))
    {
      $mainframe->enqueueMessage(JText::_('Unable to copy joom_settings.css!'));
      return false;
    } ?>
  <div style="margin:0px auto; text-align:center; width:360px;">
    <img src="components/com_joomgallery/assets/images/joom_logo.png" alt="JoomGallery Logo" />
    <h3 class="headline oktext">JoomGallery was installed successfully.</h3>
    <p>You may now start using JoomGallery or download specific language files afore:</p>
    <div class="button2-left" style="margin-left:70px;">
      <div class="blank">
        <a title="Start" onclick="location.href='index.php?option=com_joomgallery';" href="#">Start now!</a>
      </div>
    </div>
    <div class="button2-left jg_floatright" style="margin-right:70px;">
      <div class="blank">
        <a title="Languages" onclick="location.href='index.php?option=com_joomgallery&controller=help';" href="#">Languages</a>
      </div>
    </div>
    <div style="clear:both;"></div>
  </div>
<?php
  }
  else
  { ?>
  <div style="margin:0px auto; text-align:center; width:360px;">
    <img src="components/com_joomgallery/assets/images/joom_logo.png" alt="JoomGallery Logo" />
  </div>
<?php

    $newversion = '1.5.6.2';

    //Check the maximum execution time of the script
    //set secure setting of the real execution time
    $max_execution_time = @ini_get('max_execution_time');

    //try to set the max execution time to 60s if lower than
    //if not succesful the return value will be the old time, so use this
    if ($max_execution_time < 60)
    {
      @ini_set('max_execution_time', '60');
      $max_execution_time = @ini_get('max_execution_time');
    }

    $maxtime            = (int) $max_execution_time * 0.8;
    $starttime          = time();

    // Tell JoomGallery to do the update check again after the update
    $mainframe->setUserState('joom.update.checked', null);

    $jg_update_error = false;

    if (JFile::exists(JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_settings.temp.css'))
    {
      if(!JFile::delete(JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_settings.temp.css'))
      {
        $mainframe->enqueueMessage(JText::_('Unable to delete temporary joom_settings.temp.css!'));
        $jg_update_error = true;
      }
    }
    // - Start Update Info - //
    echo "<div class=\"infobox headline\">\n";
    echo "  Update JoomGallery to version: ".$newversion."\n";
    echo "</div>\n";

    $database     = & JFactory::getDBO();
    $tables       = array('#__joomgallery', '#__joomgallery_catg', '#__joomgallery_comments',
                          /*'#__joomgallery_countstop',*/ '#__joomgallery_nameshields',
                          '#__joomgallery_votes'/*, '#__joomgallery_users'*/);
    $table_list   = $database->getTableList();
    $tablefields  = $database->getTableFields($tables);
    $dbprefix     = $database->getPrefix();

    echo "<div class=\"infobox\">\n";
    echo "<p class=\"headline2\">Database</p>";

    $missing_fields = array('jg_cropposition'                   => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 2,
                                                                          'after'   => 'jg_useforresizedirection'
                                                                          ),
                            'jg_dyncropheight'                  => array( 'type'    => 'int',
                                                                          'length'  => 5,
                                                                          'value'   => 100,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_dyncropwidth'                   => array( 'type'    => 'int',
                                                                          'length'  => 5,
                                                                          'value'   => 100,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_dyncropposition'                => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 2,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_dyncrop'                        => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_tooltips'                       => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 2,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_anchors'                        => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_smiliescolor'
                                                                        ),
                            'jg_showsubsingalleryview'          => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_showrmsmcats'
                                                                        ),
                            'jg_showpagenavsubs'                => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_subperpage'
                                                                        ),
                            'jg_msg_report_toowner'             => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_report_recipients'          => array( 'type'    => 'text',
                                                                          'value'   => '',
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_report_type'                => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 2,
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_comment_toowner'            => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_comment_recipients'         => array( 'type'    => 'text',
                                                                          'value'   => '',
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_comment_type'               => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_upload_recipients'          => array( 'type'    => 'text',
                                                                          'value'   => '',
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_msg_upload_type'                => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_wrongvaluecolor'
                                                                        ),
                            'jg_itemid'                         => array( 'type'    => 'varchar',
                                                                          'length'  => 10,
                                                                          'value'   => '',
                                                                          'after'   => 'jg_coolirislink'
                                                                        ),
                            'jg_contentpluginsenabled'          => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_coolirislink'
                                                                        ),
                            'jg_showdescriptioningalleryview'   => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_catdaysnew'
                                                                        ),
                            'jg_showdescriptionincategoryview'  => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_showrandomsubthumb'
                                                                        ),
                            'jg_nameshields_others'             => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_nameshields'
                                                                        ),
                            'jg_slideshow_arrows'               => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_carousel'             => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_infopane'             => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_heigth'               => array( 'type'    => 'int',
                                                                          'length'  => 3,
                                                                          'value'   => 480,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_width'                => array( 'type'    => 'int',
                                                                          'length'  => 3,
                                                                          'value'   => 640,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_maxdimauto'           => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_transtime'            => array( 'type'    => 'int',
                                                                          'length'  => 3,
                                                                          'value'   => 2000,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_slideshow_transition'           => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_slideshow_timer'
                                                                        ),
                            'jg_geotagging'                     => array( 'type'    => 'varchar',
                                                                          'length'  => 1,
                                                                          'value'   => '',
                                                                          'after'   => 'jg_showexifdata'
                                                                        ),
                            'jg_showtotalcatimages'             => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_ctalign'
                                                                        ),
                            'jg_showtotalsubcatimages'          => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_ordersubcatbyalpha'
                                                                        ),
                            'jg_ajaxrating'                     => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_maxvoting'
                                                                        ),
                            'jg_ratingdisplaytype'              => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_maxvoting'
                                                                        ),
                            'jg_ratingcalctype'                 => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_maxvoting'
                                                                        ),
                            'jg_category_report_images'         => array( 'type'    => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_showcategoryfavourite'
                                                                        ),
                            'jg_report_images_notauth'           => array( 'type'   => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_disable_rightclick_detail'
                                                                        ),
                            'jg_detail_report_images'            => array( 'type'   => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 0,
                                                                          'after'   => 'jg_disable_rightclick_detail'
                                                                        ),
                            'jg_useruploadsingle'                => array( 'type'   => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_usercatacc'
                                                                        ),
                            'jg_useruploadbatch'                 => array( 'type'   => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_maxuploadfields'
                                                                        ),
                            'jg_useruploadjava'                  => array( 'type'   => 'int',
                                                                          'length'  => 1,
                                                                          'value'   => 1,
                                                                          'after'   => 'jg_maxuploadfields'
                                                                        )
                            );

    echo '<p>Database table '.$dbprefix.'joomgallery_config : ';
    //Install new table #_joomgallery_config if not exists
    $database->setQuery(" SELECT id FROM #__joomgallery_config");
    $config_id  = $database->loadResult();
    if(is_null($config_id))
    {
      echo 'not filled';
      echo '</p>';
      //Migrate existing config
      if(!$jg_update_error)
      {
        echo '<p>Migrate your existing configuration from file in new table</p>';

        require_once(JPATH_ADMINISTRATOR. DS .'components'.DS.'com_joomgallery'.DS.'joomgallery.config.php');

        if(class_exists('Joom_Config'))
        {
          $oldconfig = new Joom_Config();
        }
        else
        {
          $configfile   = JFile::read(JPATH_ADMINISTRATOR. DS .'components'.DS.'com_joomgallery'.DS.'joomgallery.config.php');
          $config_rows  = explode("\n", $configfile);
          foreach($config_rows as $config_row)
          {
            if(strpos($config_row, '$') === false)
            {
              continue;
            }
            $config_parts     = explode('=', $config_row);
            $key              = trim(str_replace('$', '', $config_parts[0]));
            $value            = trim(str_replace(array('"', "'", ';'), '', $config_parts[1]));
            $oldconfig->$key  = $value;
          }

          //drop primary key of #__joomgallery_countstop and add index ('idx_cspicid')
          echo '<p>Drop primary key of '.$dbprefix.'joomgallery_countstop and add index (\'idx_cspicid\'): ';
          $query = 'ALTER TABLE `#__joomgallery_countstop` DROP PRIMARY KEY ,
                    ADD INDEX `idx_cspicid` ( `cspicid` )';
          $database->setQuery($query);
          if($database->query())
          {
            echo '<span class="oktext">ok</span>';
          }
          else
          {
            $jg_update_error = true;
            echo '<span class="notoktext">not ok</span>';
          }
          echo '</p>';
        }

        $query = 'INSERT INTO #__joomgallery_config
                  VALUES (1';

        //check the existence of new, if not existent insert them
        //'jg_checkupdate' (1)
        //'jg_showsubsingalleryview' (0)
        //'jg_showpagenavsubs' (1)
        //'jg_showiptcdata' (0)
        //'jg_iptctags' ('')

        $insertvars = array();
        if(!isset($oldconfig->jg_checkupdate))
        {
          $insertvars['jg_dateformat'] = ',1';
          echo '<p>Inserting 1 new configuration variable for update check</p>';
        }
        if (!isset($oldconfig->jg_showiptcdata) && !isset($oldconfig->jg_iptctags))
        {
          $insertvars['jg_gpstags'] = ',0,\'\'';
          echo '<p>Inserting 2 new configuration variables for IPTC</p>';
        }
        foreach($missing_fields as $key => $data)
        {
          $insertvars[$data['after']][] = ','.(($data['type'] != 'int') ? "'".$data['value']."'" : $data['value']);
          echo '<p>Inserting 1 new configuration variable (\''.$key.','.(($data['type'] != 'int') ? "'".$data['value']."'" : $data['value']).'\')</p>';
        }

        //******************* Correct config vars ********************************
        //correct the paths (no leading slash, one trailing slash)
        $patharray=array();
        $patharray['jg_pathimages']=$oldconfig->jg_pathimages;
        $patharray['jg_pathoriginalimages']=$oldconfig->jg_pathoriginalimages;
        $patharray['jg_paththumbs']=$oldconfig->jg_paththumbs;
        $patharray['jg_pathftpupload']=$oldconfig->jg_pathftpupload;
        $patharray['jg_pathtemp']=$oldconfig->jg_pathtemp;
        $patharray['jg_wmpath']=$oldconfig->jg_wmpath;

        foreach ($patharray as $key => $value)
        {
          //remove all blanks and DS (/ or \) from start and end
          $patharray[$key]=trim($patharray[$key],"/\\");
          //and build new with one trailing slash
          $patharray[$key]=$patharray[$key].'/';
        }
        //write new paths back to old config
        $oldconfig->jg_pathimages=$patharray['jg_pathimages'];
        $oldconfig->jg_pathoriginalimages=$patharray['jg_pathoriginalimages'];
        $oldconfig->jg_paththumbs=$patharray['jg_paththumbs'];
        $oldconfig->jg_pathftpupload=$patharray['jg_pathftpupload'];
        $oldconfig->jg_pathtemp=$patharray['jg_pathtemp'];
        $oldconfig->jg_wmpath=$patharray['jg_wmpath'];

        //Delete the _ from LF constants
        $oldconfig->jg_pagetitle_cat=str_replace('_JGS_CATEGORY', 'JGS_COMMON_CATEGORY', $oldconfig->jg_pagetitle_cat);
        $oldconfig->jg_pagetitle_detail=str_replace(array('_JGS_CATEGORY', '_JGS_PICTURE'), array('JGS_COMMON_CATEGORY', 'JGS_COMMON_IMAGE'), $oldconfig->jg_pagetitle_detail);

        // Set the value of jg_slideshow_timer for new slideshow
        $oldconfig->jg_slideshow_timer = 6000;

        //******************* END correct config vars ****************************

        //delete config vars which aren't used anymore
        foreach($oldconfig as $key => $value)
        {
          $removed_config_settings = array( 'jg_lightbox_overlay', 'jg_combuild', 'jg_bridge',
                                            'jg_slideshow_usefilter', 'jg_slideshow_filterbychance',
                                            'jg_slideshow_filtertimer', 'jg_showsliderepeater',
                                            'jg_secimages');
          if(!in_array($key, $removed_config_settings))
          {
            $query .= ', \''.$value.'\' /*'.$key.'*/';
          }

          foreach($insertvars as $insert_key => $insert_value)
          {
            if(is_array($insert_value))
            {
              //multiple values after the same key
              $insert_value = array_reverse($insert_value);
              foreach($insert_value as $insert_value_single)
              {
                if($key == $insert_key && !is_null($insert_value_single))
                {
                  $query .= $insert_value_single.'/*'.$key.'*/';
                }
              }
            }
            else
            {
              //only one new value after this key
              if($key == $insert_key && !is_null($insert_value))
              {
                $query .= $insert_value.'/*'.$key.'*/';
              }
            }
          }
        }
        //******************* Write config in DB (insert/update ) ****************
        $query .= ')';
        $database->setQuery($query);
        //******************* END write config in DB (insert/update ) ************

        echo '<p>';
        if($database->query())
        {
          //check because lightbox is not available anymore
          $query = "SELECT jg_detailpic_open, jg_bigpic_open
                      FROM #__joomgallery_config";
          $database->setQuery($query);
          $result = $database->loadObject();
          if($result->jg_detailpic_open == 4)
          {
            $result->jg_detailpic_open = 6;
          }
          if($result->jg_bigpic_open == 4)
          {
            $result->jg_bigpic_open = 6;
          }
          $query = "UPDATE #__joomgallery_config
                      SET jg_detailpic_open = '".$result->jg_detailpic_open."',
                          jg_bigpic_open = '".$result->jg_bigpic_open."'";
          $database->setQuery($query);
          $database->query();

          echo '<span class="oktext">Migration of configuration ok</span>';
        }
        else
        {
          $database->getErrorMsg();
          $jg_update_error = true;
          echo '<span class="notoktext">Migration of configuration not ok</span>';
        }
        echo '</p>';
      }
    }
    else
    {
      //check for missing or altered fields
      echo 'configuration table exists</p>';

      //the id of the row has to be 1 now
      if(!$config_id)
      {
        echo '<p>Change id of default settings row to \'1\': ';
        $query = 'UPDATE `#__joomgallery_config` SET id = 1';
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          echo '<span class="notoktext">not ok</span>';
          $database->getErrorMsg();
        }
        echo '</p>';
      }

      // Change timer of slideshow from seconds to default of 6000 in milliseconds
      $query = 'SELECT jg_slideshow_timer FROM #__joomgallery_config';
      $database->setQuery($query);
      $slideshowtimer = $database->loadResult();

      if ($slideshowtimer < 100)
      {
        echo '<p>Change timer of slideshow (jg_slideshow_timer) to \'6000\': ';
        $query = 'UPDATE `#__joomgallery_config` SET jg_slideshow_timer = 6000';
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          echo '<span class="notoktext">not ok</span>';
          $database->getErrorMsg();
        }
      }

      $configtablefields  = $database->getTableFields('#__joomgallery_config');
      //change type of 'jg_pagetitle_cat' and 'jg_pagetitle_detail' to 'text'
      if($configtablefields['#__joomgallery_config']['jg_pagetitle_cat'] != 'text')
      {
        echo '<p>Change type of \'jg_pagetitle_cat\' and \'jg_pagetitle_detail\' to \'text\': ';
        $query = 'ALTER TABLE `#__joomgallery_config`
                    CHANGE `jg_pagetitle_cat` `jg_pagetitle_cat` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                    CHANGE `jg_pagetitle_detail` `jg_pagetitle_detail` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL';
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          echo '<span class="notoktext">not ok</span><br />';
          echo $database->getErrorMsg();
        }
        echo '</p>';
      }
      // Change content of jg_pagetitle_cat and jg_pagetitle_detail regarding
      // to new language constants since 1.5.5
      // JGS_PICTURE -> JGS_COMMON_IMAGE
      // JGS_CATEGORY -> JGS_COMMON_CATEGORY
      $query = 'SELECT jg_pagetitle_cat, jg_pagetitle_detail FROM #__joomgallery_config';
      $database->setQuery($query);
      $titlefields = $database->loadObject();

      if (strpos($titlefields->jg_pagetitle_cat, 'JGS_CATEGORY')
          || strpos($titlefields->jg_pagetitle_cat, 'JGS_PICTURE')
          || strpos($titlefields->jg_pagetitle_detail, 'JGS_CATEGORY')
          || strpos($titlefields->jg_pagetitle_detail, 'JGS_PICTURE'))
      {
        $titlefields->jg_pagetitle_cat  = str_replace('JGS_CATEGORY', 'JGS_COMMON_CATEGORY',  $titlefields->jg_pagetitle_cat);
        $titlefields->jg_pagetitle_cat  = str_replace('JGS_PICTURE',  'JGS_COMMON_IMAGE',   $titlefields->jg_pagetitle_cat);
        $titlefields->jg_pagetitle_detail  = str_replace('JGS_CATEGORY', 'JGS_COMMON_CATEGORY',  $titlefields->jg_pagetitle_detail);
        $titlefields->jg_pagetitle_detail  = str_replace('JGS_PICTURE',  'JGS_COMMON_IMAGE',   $titlefields->jg_pagetitle_detail);

        echo '<p>Replace old language constants JGS_PICTURE and JGS_CATEGORY in pagetitle_cat and jg_pagetitle_detail: ';
        $query  = "UPDATE #__joomgallery_config
                SET jg_pagetitle_cat = '$titlefields->jg_pagetitle_cat',
                jg_pagetitle_detail = '$titlefields->jg_pagetitle_detail'";
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          echo '<span class="notoktext">not ok</span><br />';
          echo $database->getErrorMsg();
        }
        echo '</p>';
      }

      //change type of 'jg_category' and 'jg_usercategory' to 'text'
      if($configtablefields['#__joomgallery_config']['jg_category'] != 'text')
      {
        echo '<p>Change type of \'jg_category\' and \'jg_usercategory\' to \'text\': ';
        $query = 'ALTER TABLE `#__joomgallery_config`
                    CHANGE `jg_category` `jg_category` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                    CHANGE `jg_usercategory` `jg_usercategory` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL';
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          echo '<span class="notoktext">not ok</span><br />';
          echo $database->getErrorMsg();
        }
        echo '</p>';
      }

      //check existence of various fields
      echo '<p>Check for missing fields in configuration table:<br />';
      $configuptodate = true;

      foreach($missing_fields as $key => $data)
      {
        if(!array_key_exists($key, $configtablefields['#__joomgallery_config']))
        {
          $configuptodate = false;
          echo $key.' not found<br />';
          $query='ALTER TABLE #__joomgallery_config
                  ADD `'.$key.'` '.$data['type'].(($data['type'] != 'text') ? '('.$data['length'].')' : '').' NOT NULL
                  AFTER `'.$data['after'].'`;';
          $database->setQuery($query);
          if($database->query())
          {
            if($data['value'])
            {
              $query="UPDATE #__joomgallery_config
                      SET ".$key." = ".(($data['type'] != 'int') ? "'".$data['value']."'" : $data['value']);
              $database->setQuery($query);
              if($database->query())
              {
                echo '<span class="oktext">'.$key.' successfully added</span><br />';
              }
              else
              {
                echo $database->getErrorMsg();
                $jg_update_error = true;
                echo '<span class="notoktext">Error inserting the default configuration value for '.$key.'</span><br />';
              }
            }
            else
            {
              echo '<span class="oktext">'.$key.' successfully added</span><br />';
            }
          }
          else
          {
              echo $database->getErrorMsg();
              $jg_update_error = true;
              echo '<span class="notoktext">Error adding '.$key.'</span><br />';
          }
        }
      }
      if($configuptodate)
      {
        echo '<span class="oktext">configuration table is up-to-date</span>';
      }
      echo '</p>';
    }

   //******************* Update #__joomgallery table *****************************

    echo '<p>Check for missing fields in images table:<br />';
    $images_table_uptodate = true;
    $newfields  = array('alias'     => array( 'type'    =>  'varchar',
                                              'length'  =>  255,
                                              'default' =>  '',
                                              'after'   =>  'imgtitle'
                                            ),
                        'access'    => array( 'type'    =>  'tinyint',
                                              'length'  =>  3,
                                              'default' =>  0,
                                              'after'   =>  'imgvotesum'
                                            ),
                        'metadesc'  => array( 'type'    =>  'text',
                                              'after'   =>  'ordering'
                                            ),
                        'metakey'   => array( 'type'    =>  'text',
                                              'after'   =>  'ordering'
                                            ),
                        'params'    => array( 'type'    =>  'text',
                                              'after'   =>  'ordering'
                                            )
                        );
    foreach($newfields as $key => $data)
    {
      if(!array_key_exists($key, $tablefields['#__joomgallery']))
      {
        $images_table_uptodate = false;
        echo $key.' not found<br />';
        $query='ALTER TABLE #__joomgallery
                ADD `'.$key.'` '.$data['type'].(($data['type'] != 'text') ? '('.$data['length'].')' : '').'
                NOT NULL'.(isset($data['default']) ? ' default \''.$data['default'].'\'' : '').'
                AFTER `'.$data['after'].'`;';
        $database->setQuery($query);
        if($database->query())
        {
            echo '<span class="oktext">'.$key.' successfully added</span><br />';
        }
        else
        {
            $database->getErrorMsg();
            $jg_update_error = true;
            echo '<span class="notoktext">Error adding '.$key.'</span><br />';
        }
      }
    }

    //altered fields
    if(!array_key_exists('hits', $tablefields['#__joomgallery']))
    {
      $images_table_uptodate = false;
      echo 'hits not found<br />';
      $query='ALTER TABLE `#__joomgallery` CHANGE `imgcounter` `hits` int(11) NOT NULL DEFAULT \'0\'';
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">\'imgcounter\' successfully renamed to \'hits\'</span><br />';
      }
      else
      {
        $database->getErrorMsg();
        $jg_update_error = true;
        echo '<span class="notoktext">Error renaming \'imgcounter\' to \'hits\'</span><br />';
      }
    }
    if($images_table_uptodate)
    {
      echo '<span class="oktext">images table is up-to-date</span>';
    }
    echo '</p>';

   //******************* Update #__joomgallery_catg table ************************
    echo '<p>Check for missing fields in categories table:<br />';
    $categories_table_uptodate = true;
    $newfields  = array('alias'     => array( 'type'    =>  'varchar',
                                              'length'  =>  255,
                                              'default' =>  '',
                                              'after'   =>  'name'
                                            ),
                        'metadesc'  => array( 'type'    =>  'text',
                                              'after'   =>  'catpath'
                                            ),
                        'metakey'   => array( 'type'    =>  'text',
                                              'after'   =>  'catpath'
                                            ),
                        'params'    => array( 'type'    =>  'text',
                                              'after'   =>  'catpath'
                                            )
                        );
    foreach($newfields as $key => $data)
    {
      if(!array_key_exists($key, $tablefields['#__joomgallery_catg']))
      {
        $categories_table_uptodate = false;
        echo $key.' not found<br />';
        $query='ALTER TABLE #__joomgallery_catg
                ADD `'.$key.'` '.$data['type'].(($data['type'] != 'text') ? '('.$data['length'].')' : '').'
                NOT NULL'.(isset($data['default']) ? ' default \''.$data['default'].'\'' : '').'
                AFTER `'.$data['after'].'`;';
        $database->setQuery($query);
        if($database->query())
        {
          echo '<span class="oktext">'.$key.' successfully added</span><br />';
        }
        else
        {
          $database->getErrorMsg();
          $jg_update_error = true;
          echo '<span class="notoktext">Error adding '.$key.'</span><br />';
        }
      }
    }

    // Fields to be altered
    // set default of owner from NULL to 0
    echo '<p>Check for fields in categories table to be altered:<br />';
    $query="SELECT default(owner) FROM `#__joomgallery_catg`";
    $db->setQuery($query);
    $result = $db->loadResult();

    // The following three lines should be removed after the next update
    $query='ALTER TABLE `#__joomgallery_catg` CHANGE `owner` `owner` int(11) NOT NULL DEFAULT 0';
    $database->setQuery($query);
    $database->query();

    // Check if default = NULL, then alter to 0
    if(is_null($result))
    {
      $categories_table_uptodate = false;
      echo '<p>Alter default value of field owner to 0: <br />';
      $query='ALTER TABLE `#__joomgallery_catg` CHANGE `owner` `owner` int(11) NOT NULL DEFAULT 0';
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">Default value of field owner successfully altered to 0</span><br />';
      }
      else
      {
        $database->getErrorMsg();
        $jg_update_error = true;
        echo '<span class="notoktext">Error in altering default value of owner to 0</span><br />';
      }
    }

    if($categories_table_uptodate)
    {
      echo '<span class="oktext">categories table is up-to-date</span>';
    }
    echo '</p>';

    //******************* Insert Aliases and Migrate Dates ***********************

    // Do we have to correct the catpaths?
    $query = "SELECT COUNT(cid) FROM #__joomgallery_catg WHERE substring(catpath,1,1) = '/'";
    $database->setQuery($query);
    $correct_catpaths = $database->loadResult();
    if($correct_catpaths)
    {
      echo '<p>Correct catpaths: ';
      $query = "UPDATE #__joomgallery_catg SET catpath = substring(catpath,2) WHERE substring(catpath,1,1) = '/'";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="notoktext">not ok</span>';
      }
      echo '</p>';
    }

    $alter_images_dates   = false;
    $alter_comments_dates = false;
    $alter_nametags_dates = false;

    if(!$config_id || $correct_catpaths)
    {
      echo '<p>Create aliases for all images and categories: ';

      require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php');
      JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'tables');

      $alias_not_completed          = false;
      $alias_error                  = false;
      $migrate_dates_not_completed  = false;
      $migrate_dates_error          = false;
      $img_count                    = 0;
      $cat_count                    = 0;

      if(!$config_id)
      {
        $database->setQuery(" SELECT
                                id
                              FROM
                                "._JOOM_TABLE_IMAGES
                            );

        if($images = $database->loadResultArray())
        {
          $row  = & JTable::getInstance('joomgalleryimages', 'Table');

          // Loop through selected images
          foreach($images as $key => $id)
          {
            $row->load($id);

            if(is_numeric($row->imgdate))
            {
              $row->imgdate = date('Y-m-d H:i:s', $row->imgdate);
            }

            $row->check();

            if(!$row->store())
            {
              $alias_error = true;
            }
            $img_count++;

            unset($images[$key]);

            // Check remaining time
            $timeleft = -(time() - $starttime - $maxtime);
            if($timeleft <= 0 && count($images))
            {
              $alias_not_completed = true;
              break;
            }
          }
        }
        if(!$alias_not_completed)
        {
          $alter_images_dates = true;
        }
      }
      else
      {
        $images = array();
      }

      $database->setQuery(" SELECT
                              cid
                            FROM
                              "._JOOM_TABLE_CATEGORIES
                          );

      $categories = $database->loadResultArray();
      if($categories && !$alias_not_completed)
      {
        $row  = & JTable::getInstance('joomgallerycategories', 'Table');

        // Loop through selected categories
        foreach($categories as $key => $id)
        {
          $row->load($id);

          // Trim slashes
          $row->catpath = trim($row->catpath, '/');

          $row->alias = '';

          $row->check();

          if(!$row->store())
          {
            $alias_error = true;
          }
          $cat_count++;

          unset($categories[$key]);

          // Check remaining time
          $timeleft = -(time() - $starttime - $maxtime);
          if($timeleft <= 0 && count($categories))
          {
            $alias_not_completed = true;
            break;
          }
        }
      }

      if(!$config_id)
      {
        $database->setQuery(" SELECT
                                cmtid
                              FROM
                                "._JOOM_TABLE_COMMENTS
                            );

        $comments = $database->loadResultArray();
        if($comments && !$alias_not_completed && !$config_id)
        {
          $row  = & JTable::getInstance('joomgallerycomments', 'Table');

          // Loop through selected comments
          foreach($comments as $key => $id)
          {
            $row->load($id);

            if(/*$migrate_comments_dates && */is_numeric($row->cmtdate))
            {
              $row->cmtdate = date('Y-m-d H:i:s', $row->cmtdate);
            }

            $row->check();

            if(!$row->store())
            {
              $migrate_dates_error = true;
            }

            unset($comments[$key]);

            // Check remaining time
            $timeleft = -(time() - $starttime - $maxtime);
            if($timeleft <= 0 && count($comments))
            {
              $migrate_dates_not_completed = true;
              break;
            }
          }
        }
        if($comments && !$migrate_dates_not_completed)
        {
          $alter_comments_dates = true;
        }


        $database->setQuery(" SELECT
                                nid
                              FROM
                                "._JOOM_TABLE_NAMESHIELDS
                            );

        $nametags = $database->loadResultArray();
        if($nametags && !$alias_not_completed && !$migrate_dates_not_completed)
        {
          $row  = & JTable::getInstance('joomgallerynameshields', 'Table');

          // Loop through selected nametags
          foreach($nametags as $key => $id)
          {
            $row->load($id);

            if(/*$migrate_nametags_dates && */is_numeric($row->ndate))
            {
              $row->ndate = date('Y-m-d H:i:s', $row->ndate);
            }

            $row->check();

            if(!$row->store())
            {
              $migrate_dates_error = true;
            }

            unset($nametags[$key]);

            // Check remaining time
            $timeleft = -(time() - $starttime - $maxtime);
            if($timeleft <= 0 && count($nametags))
            {
              $migrate_dates_not_completed = true;
              break;
            }
          }
        }
        if($nametags && !$migrate_dates_not_completed)
        {
          $alter_nametags_dates = true;
        }
      }

      if($alias_error)
      {
        echo '<span class="notoktext">not ok</span>';
      }
      else
      {
        if($alias_not_completed && (count($images) || count($categories)))
        {
          $mainframe->enqueueMessage(JText::_('Please note: If you are going to use Joomla Core-SEF with JoomGallery, aliases for all images and categories have to be set. Please read the update infos below.'), 'notice'); ?>
  <span class="noticetext">not completed. Please click <a href="javascript:document.aliasForm.submit();">here</a> in order to complete this task,
    but afore ensure that the update was successfull otherwise. If you have a very large gallery it will take some time to complete this task, so please be patient.
  </span>
  <form action="index.php?option=com_joomgallery&amp;controller=maintenance&amp;task=setalias&amp;migrate_date_columns=1" name="aliasForm" method="post">
    <span>
      <input type="hidden" name="images" value="<?php echo implode(',', $images); ?>" />
      <input type="hidden" name="categories" value="<?php echo implode(',', $categories); ?>" />
    </span>
  </form>
  <?php }
        else
        {
          echo '<span class="oktext">ok</span>';
        }
      }

      echo '<p>Migrate date columns in #__joomgallery, #__joomgallery_comments and #__joomgallery_nameshields: ';
      if($migrate_dates_error)
      {
        echo '<span class="notoktext">not ok</span>';
      }
      else
      {
        if($alter_nametags_dates || $alter_comments_dates)
        {
          $mainframe->enqueueMessage(JText::_('Please note: Migration of all stored dates was not completed. Please read the update infos below.'), 'notice'); ?>
  <span class="noticetext">not completed. Please click <a href="javascript:document.aliasForm.submit();">here</a> in order to complete this task,
    but afore ensure that the update was successfull otherwise. If you have a very large gallery it will take some time to complete this task, so please be patient.
  </span>
  <form action="index.php?option=com_joomgallery&amp;controller=maintenance&amp;task=migratedates" name="aliasForm" method="post">
    <span>
      <input type="hidden" name="comments" value="<?php echo implode(',', $comments); ?>" />
      <input type="hidden" name="nametags" value="<?php echo implode(',', $nametags); ?>" />
    </span>
  </form>
  <?php }
        else
        {
          echo '<span class="oktext">ok</span>';
        }
      }
    }

    if($tablefields['#__joomgallery']['imgdate'] != 'datetime')
    {
      $images_table_uptodate = false;
      echo '<p>Change type of \'imgdate\' to \'datetime\' in _joomgallery: ';
      $query = "ALTER TABLE `#__joomgallery` CHANGE `imgdate` `imgdate` DATETIME NOT NULL ";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="oktext">not ok</span>';
        $database->getErrorMsg();
      }
      echo '</p>';
    }

   //******************* Update #__joomgallery_comments table *****************

    echo '<p>Check for missing fields in nameshields table:<br />';
    $comments_table_uptodate = true;

    // Altered fields
    if($tablefields['#__joomgallery_comments']['cmtdate'] != 'datetime')
    {
      $comments_table_uptodate = false;
      echo '<p>Change type of \'cmtdate\' to \'datetime\' in _joomgallery_comments: ';
      $query = "ALTER TABLE `#__joomgallery_comments` CHANGE `cmtdate` `cmtdate` DATETIME NOT NULL ";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="oktext">not ok</span>';
        $database->getErrorMsg();
      }
      echo '</p>';
    }

    if($comments_table_uptodate)
    {
      echo '<span class="oktext">comments table is up-to-date</span>';
    }
    echo '</p>';

   //******************* Update #__joomgallery_nameshields table *****************

    echo '<p>Check for missing fields in nameshields table:<br />';
    $nameshields_table_uptodate = true;
    $newfields  = array('by'        => array( 'type'    =>  'int',
                                              'length'  =>  11,
                                              'default' =>  0,
                                              'after'   =>  'nyvalue'
                                            )
                        );
    foreach($newfields as $key => $data)
    {
      if(!array_key_exists($key, $tablefields['#__joomgallery_nameshields']))
      {
        $nameshields_table_uptodate = false;
        echo $key.' not found<br />';
        $query='ALTER TABLE #__joomgallery_nameshields
                ADD `'.$key.'` '.$data['type'].(($data['type'] != 'text') ? '('.$data['length'].')' : '').'
                NOT NULL'.(isset($data['default']) ? ' default \''.$data['default'].'\'' : '').'
                AFTER `'.$data['after'].'`;';
        $database->setQuery($query);
        if($database->query())
        {
          if($key == 'by')
          {
            /* TODO? */
            echo '<span class="oktext">'.$key.' successfully added</span><br />';
          }
          else
          {
            echo '<span class="oktext">'.$key.' successfully added</span><br />';
          }
        }
        else
        {
          $database->getErrorMsg();
          $jg_update_error = true;
          echo '<span class="notoktext">Error adding '.$key.'</span><br />';
        }
      }
    }

    //altered fields
    if($tablefields['#__joomgallery_nameshields']['ndate'] != 'datetime')
    {
      $nameshields_table_uptodate = false;
      echo '<p>Change type of \'ndate\' to \'datetime\': ';
      $query = "ALTER TABLE `#__joomgallery_nameshields` CHANGE `ndate` `ndate` DATETIME NOT NULL ";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="oktext">not ok</span>';
        $database->getErrorMsg();
      }
      echo '</p>';
    }

    if($nameshields_table_uptodate)
    {
      echo '<span class="oktext">nameshields table is up-to-date</span>';
    }
    echo '</p>';

    //******************* Update #__joomgallery_votes table ***********************

    echo '<p>Check for missing and unnecessary fields in votes table:<br />';
    $votes_table_uptodate = true;

    // Altered fields
    if($tablefields['#__joomgallery_votes']['datevoted'] != 'datetime')
    {
      $votes_table_uptodate = false;
      echo '<p>Change type of \'datevoted\' to \'datetime\': ';
      $query = "ALTER TABLE `#__joomgallery_votes` CHANGE `datevoted` `datevoted` DATETIME NOT NULL ";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="oktext">not ok</span>';
        $database->getErrorMsg();
      }
      echo '</p>';
    }

    // Unnecessary fields
    if(isset($tablefields['#__joomgallery_votes']['timevoted']))
    {
      $votes_table_uptodate = false;
      echo '<p>Remove field \'timevoted\': ';
      $query = "ALTER TABLE `#__joomgallery_votes` DROP `timevoted`";
      $database->setQuery($query);
      if($database->query())
      {
        echo '<span class="oktext">ok</span>';
      }
      else
      {
        echo '<span class="oktext">not ok</span>';
        $database->getErrorMsg();
      }
      echo '</p>';
    }

    if($votes_table_uptodate)
    {
      echo '<span class="oktext">votes table is up-to-date</span>';
    }
    echo '</p>';

    //****************************************************************************

    echo '</div>';

    //******************* Insert Feed-Module **************************************
    $query = "SELECT COUNT(*) FROM #__modules
                WHERE position = 'joom_cpanel' AND module = 'mod_feed'";
    $database->setQuery($query);
    if(!$database->loadResult())
    {
      $subdomain = '';
      $language = & JFactory::getLanguage();
      if(strpos($language->getTag(), 'de-') === false)
      {
        $subdomain = 'en.';
      }
      $row = & JTable::getInstance('module');
      $row->title = 'JoomGallery News';
      $row->ordering = 1;
      $row->position = 'joom_cpanel';
      $row->published = 1;
      $row->showtitle = 1;
      $row->iscore = 0;
      $row->access = 0;
      $row->client_id = 1;
      $row->module = 'mod_feed';
      $row->params = 'cache=1
      cache_time=15
      moduleclass_sfx=
      rssurl=http://www.'.$subdomain.'joomgallery.net/feed/rss.html
      rssrtl=0
      rsstitle=1
      rssdesc=0
      rssimage=1
      rssitems=3
      rssitemdesc=1
      word_count=30';
      echo '<div class="infobox">'."\n";
      echo '<p class="headline2">News feed module</p>'."\n";
      if($row->store())
      {
        echo '<p class="oktext">Insert news feed module ok</p>';
      }
      else
      {
        echo '<p class="notoktext">Insert news feed module not ok</p>';
      }
      echo '</div>';
    }
    else
    {
      $query = "SELECT params FROM #__modules
                  WHERE position = 'joom_cpanel' AND module = 'mod_feed'";
      $database->setQuery($query);
      $params = $database->loadResult();
      $old_feed_url = 'rssurl=http://en.joomgallery.net/?format=feed&type=rss';
      if(strpos($params, $old_feed_url) !== false)
      {
        $subdomain = '';
        $language = & JFactory::getLanguage();
        if(strpos($language->getTag(), 'de-') === false)
        {
          $subdomain = 'en.';
        }
        $new_feed_url = 'rssurl=http://www.'.$subdomain.'joomgallery.net/feed/rss.html';
        $params = str_replace($old_feed_url, $new_feed_url, $params);
        $query = "UPDATE #__modules SET params = '".$params."'
                    WHERE position = 'joom_cpanel' AND module = 'mod_feed'
                    LIMIT 1";
        $database->setQuery($query);
        echo '<div class="infobox">'."\n";
        echo '<p class="headline2">News feed module</p>'."\n";
        if($database->query())
        {
          echo '<p class="oktext">Update news feed module ok</p>';
        }
        else
        {
          echo '<p class="notoktext">Update news feed module not ok</p>';
        }
        echo '</div>';
      }
    }

    //******************* Delete folders/files ************************************
    echo '<div class="infobox">'."\n";
    echo '<p class="headline2">File system</p>'."\n";

    $delete_folders = array();

    echo '<p>';
    echo 'Looking for orphaned files and folders from the old installation<br />';

    //Folders
    //admin language files
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'adminlanguage';
    //frontend language files
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'language';
    //lightbox
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'lightbox';
    //frontend classes folder
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'classes';
    //backend classes folder
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'classes';
    //frontend includes folder
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'includes';
    //wz_dragdrop script
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'wz_dragdrop';
    //accordion script
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'accordion';
    //motiongallery script (moved to another place)
    $delete_folders[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'motiongallery';
    //old folder of exif and iptc data arrays
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'adminexif';
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'adminiptc';
    //old html include folder (files in folder 'includes' have to be deleted separately because this directory is still used)
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'html';
    //java applet was copied to frontend
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'java';
    // With introducing the maintenance manager the votes manager isn't necessary anymore
    $delete_folders[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'views'.DS.'votes';

    // Unzipped folder of latest auto update with cURL
    $temp_dir = false;
    $query = "SELECT jg_pathtemp FROM #__joomgallery_config";
    $database->setQuery($query);
    $temp_dir = $database->loadResult();
    if($temp_dir)
    {
      //$delete_folders[] = JPATH_SITE.DS.$temp_dir.'update';

      $newest = array(0, '');
      $xml_file = JPATH_SITE.DS.$temp_dir.'update'.DS.'joomgallery.xml';
      if(JFile::exists($xml_file))
      {
        $newest = array(filemtime($xml_file), JPATH_SITE.DS.$temp_dir.'update');
      }

      for($i = 0; $i <= 100; $i++)
      {
        $update_folder = JPATH_SITE.DS.$temp_dir.'update'.$i;
        if(JFolder::exists($update_folder))
        {
          if(JFile::exists($update_folder.DS.'joomgallery.xml'))
          {
            $file_time = filemtime($update_folder.DS.'joomgallery.xml');
            if($file_time > $newest[0])
            {
              $newest = array($file_time, $update_folder);
            }
          }
        }
      }

      for($i = 0; $i <= 100; $i++)
      {
        $update_folder = JPATH_SITE.DS.$temp_dir.'update'.$i;
        if(JFolder::exists($update_folder))
        {
          if($update_folder == $newest[1])
          {
            $delete_folders[] = $update_folder.DS.'admin';
            $delete_folders[] = $update_folder.DS.'site';
            JPath::setPermissions($update_folder, '0755');
          }
          else
          {
            $delete_folders[] = $update_folder;
          }
        }
      }
    }

    $deleted = false;

    $jg_delete_error = false;
    foreach($delete_folders as $delete_folder)
    {
      if(JFolder::exists($delete_folder))
      {
        echo 'delete folder: '.$delete_folder.' : ';
        $result = JFolder::delete($delete_folder);
        if($result == true)
        {
          $deleted  = true;
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          $jg_delete_error = true;
          echo '<span class="notoktext">not ok</span>';
        }
        echo '<br />';
      }
    }

    //Files
    //delete the joomgallery.config.php only when migration of configuration
    //succesful
    if($jg_update_error == true)
    {
      $delete_file  = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'joomgallery.config.php';
      if(JFile::exists($delete_file))
      {
        echo 'delete file: '.$delete_file.' : ';
        $result=JFile::delete($delete_file);
        if($result == true)
        {
          $deleted  = true;
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          $jg_delete_error = true;
          echo '<span class="notoktext">not ok</span>';
        }
        echo '<br />';
      }
    }

    $delete_files = array();

    //Thickbox3 files
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'thickbox3'.DS.'js'.DS.'jquery-latest.js';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'js'.DS.'thickbox3'.DS.'js'.DS.'thickbox-compressed.js';

    //Update file
    if($temp_dir)
    {
      $delete_files[] = JPATH_SITE.DS.$temp_dir.'update.zip';
    }

    //CSS files
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_category.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_common.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_common2.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_detail.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_favourites.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_mini.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_special.css';
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_user.css';

    $delete_files[] = JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_settings.temp.css';

    //modules.class.php
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'classes'.DS.'modules.class.php';

    //files of old structure (none MVC)
    $delete_files[] = JPATH_SITE.DS.'components'.DS.'com_joomgallery'.DS.'joomgallery.html.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'admin.joomgallery.html.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'common.joomgallery.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'joomgallery.class.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'toolbar.joomgallery.html.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'toolbar.joomgallery.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.categories.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.comments.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.configuration.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.cssedit.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.help.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.migration.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.pictures.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.uploads.php';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'admin.votes.php';

    //cache file of the newsfeed for the update checker
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'cache'.DS.md5('http://www.joomgallery.net/components/com_newversion/rss/extensions.rss').'.spc';
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'cache'.DS.md5('http://www.en.joomgallery.net/components/com_newversion/rss/extensions.rss').'.spc';

    // Zip file of latest auto update with cURL
    $delete_files[] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'temp'.DS.'update.zip';

    foreach($delete_files as $delete_file)
    {
      if(JFile::exists($delete_file))
      {
        echo 'delete file: '.$delete_file.' : ';
        $result = JFile::delete($delete_file);
        if($result == true)
        {
          $deleted  = true;
          echo '<span class="oktext">ok</span>';
        }
        else
        {
          $jg_delete_error = true;
          echo '<span class="notoktext">not ok</span>';
        }
        echo '<br />';
      }
    }
   //******************* END delete folders/files ************************************

    if($deleted)
    {
      if($jg_delete_error)
      {
        echo '<span class="notoktext">problems in deletion of files/folders</span>';
        $jg_update_error = true;
      }
      else
      {
        echo '<span class="oktext">files/folders sucessfully deleted</span>';
      }
    }
    else
    {
      echo '<span class="oktext">nothing to delete</span>';
    }

    echo '</p>';
    echo '</div>';

    //******************* Write joom_settings.css ************************************
    echo '<div class="infobox">'."\n";
    echo '<p class="headline2">CSS</p>'."\n";;
    echo '<p>';
    echo 'Update configuration dependent CSS settings: ';

    require_once JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php';
    JLoader::register('JoomConfig', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'config.php');
    JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'tables');

    $config =& JoomConfig::getInstance();
    if(!$config->save())
    {
      $jg_update_error = true;
      echo '<span class="notoktext">not ok</span>';
    }
    else
    {
      echo '<span class="oktext">ok</span>';
    }

    echo '</p>';
    echo '</div>';
    //******************* End write joom_settings.css ************************************

    if($jg_update_error)
    {
      echo '<h3 class="headline notoktext">Problem with the update to JoomGallery version '.$newversion.'<br />Please read the update infos above</h3>';
      $mainframe->enqueueMessage(JText::_('Problem with the update to JoomGallery version '.$newversion.'. Please read the update infos below'), 'error');
    }
    else
    { ?>
  <div style="margin:0px auto; text-align:center; width:360px;">
    <img src="components/com_joomgallery/assets/images/joom_logo.png" alt="JoomGallery Logo" />
    <h3 class="headline oktext">JoomGallery was updated to version <?php echo $newversion; ?> successfully.</h3>
    <p>You may now go on using JoomGallery or update your language files for JoomGallery:</p>
    <div class="button2-left" style="margin-left:70px;">
      <div class="blank">
        <a title="Start" onclick="location.href='index.php?option=com_joomgallery';" href="#">Go on!</a>
      </div>
    </div>
    <div class="button2-left jg_floatright" style="margin-right:70px;">
      <div class="blank">
        <a title="Languages" onclick="location.href='index.php?option=com_joomgallery&controller=help';" href="#">Languages</a>
      </div>
    </div>
    <div style="clear:both;"></div>
  </div>
<?php
    }

    // Inform user if he has to update PHP or MySQL
    if(version_compare('5', PHP_VERSION, '>'))
    {
      JError::raiseWarning(100, 'JoomGallery 1.5.5 needs at least PHP5 to tun smoothly. Please immediately ask your hoster whether he is able to upgrade it. If not, please import a backup of JoomGallery 1.5.0.');
    }
    if(version_compare('4.1', $db->getVersion(), '>'))
    {
      JError::raiseWarning(100, 'JoomGallery 1.5.5 needs at least MySQL 4.1 (better MySQL 5) to run smoothly. Please immediately ask your hoster whether he is able to upgrade it. If not, please import a backup of JoomGallery 1.5.0.');
    }
  }
}