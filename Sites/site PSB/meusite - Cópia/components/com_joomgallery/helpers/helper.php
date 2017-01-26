<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/helpers/helper.php $
// $Id: helper.php 2604 2010-12-01 14:36:07Z chraneco $
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
 * JoomGallery Global Helper
 *
 * @static
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomHelper
{
  /**
   * Replace bbcode tags to HTML tags
   *
   * 1. replace linefeed to <br />
   * 2. replace b/u/i/url/email tags
   *
   * @TODO: Move this into the JHTMLJoomGallery class?
   *
   * @access  public
   * @param   string  $text The text to be modified
   * @return  string  The modified text
   * @since   1.0.0
   */
  function BBDecode($text)
  {
    $text = nl2br($text);
    static $bbcode_tpl    = array();
    static $patterns      = array();
    static $replacements  = array();

    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if((strpos($text, '[') === false || strpos($text, ']') === false))
    {
      return $text;
    }

    // [b] and [/b] for bolding text.
    $text = str_replace('[b]',  '<b>',  $text);
    $text = str_replace('[/b]', '</b>', $text);

    // [u] and [/u] for underlining text.
    $text = str_replace('[u]',  '<u>',  $text);
    $text = str_replace('[/u]', '</u>', $text);

    // [i] and [/i] for italicizing text.
    $text = str_replace('[i]',  '<i>',  $text);
    $text = str_replace('[/i]', '</i>', $text);

    if(!count($bbcode_tpl))
    {
      // We do URLs in several different ways..
      $bbcode_tpl['url']    = '<span class="bblink"><a href="{URL}" target="_blank">{DESCRIPTION}</a></span>';
      $bbcode_tpl['email']  = '<span class="bblink"><a href="mailto:{EMAIL}">{EMAIL}</a></span>';
      $bbcode_tpl['url1']   = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
      $bbcode_tpl['url1']   = str_replace('{DESCRIPTION}', '\\1\\2', $bbcode_tpl['url1']);
      $bbcode_tpl['url2']   = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
      $bbcode_tpl['url2']   = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);
      $bbcode_tpl['url3']   = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
      $bbcode_tpl['url3']   = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url3']);
      $bbcode_tpl['url4']   = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
      $bbcode_tpl['url4']   = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url4']);
      $bbcode_tpl['email']  = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

      // [url]xxxx://www.phpbb.com[/url] code..
      $patterns[1]      = '#\[url\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si';
      $replacements[1]  = $bbcode_tpl['url1'];
      // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
      $patterns[2]      = '#\[url\]([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si';
      $replacements[2]  = $bbcode_tpl['url2'];
      // [url=xxxx://www.phpbb.com]phpBB[/url] code..
      $patterns[3]      = '#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si';
      $replacements[3]  = $bbcode_tpl['url3'];
      // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
      $patterns[4]      = '#\[url=([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si';
      $replacements[4]  = $bbcode_tpl['url4'];
      //[email]user@domain.tld[/email] code..
      $patterns[5]      = '#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si';
      $replacements[5]  = $bbcode_tpl['email'];
    }

    $text = preg_replace($patterns, $replacements, $text);

    return $text;
  }

  /**
   * Fix text for output in JavaScript Code
   *
   * @access  public
   * @param   string  $text   The text to fix
   * @param   int     $bbcode Decode bb code, defaults to false
   * @return  string  The fixed text
   * @since   1.0.0
   */
  function fixForJS($text, $bbcode = false)
  {
    $config = & JoomConfig::getInstance();

    if($bbcode && $config->get('jg_bbcodesupport') == 1)
    {
      $text = JoomHelper::BBDecode($text);
    }
    $text = str_replace("\"", "\&quot;", $text);
    $text = str_replace("'",  "\'", $text);
    $text = preg_replace('/[\n\t\r]*/', '', $text);

    return $text;
  }

  /**
   * Wrap text
   *
   * @access  public
   * @param   string  $text The text to wrap
   * @param   int     $nr   Number of chars to wrap
   * @return  string  The wrapped text
   * @since   1.0.0
   */
  function processText($text, $nr = 40)
  {
    $mytext   = explode(' ', trim($text));
    $newtext  = array();
    foreach($mytext as $k => $txt)
    {
      if(strlen($txt) > $nr)
      {
        $txt  = wordwrap($txt, $nr, '- ', 1);
      }
      $newtext[]  = $txt;
    }
    return implode(' ', $newtext);
  }

  /**
   * Reads the category path from array
   * If not set read database and add to array
   *
   * @access  public
   * @param   int     $catid  The ID of the category of which the catpath is requested
   * @return  string  The catpath of the category
   * @since   1.0.0
   */
  function getCatPath($catid)
  {
    static $catpath = array();

    if(!isset($catpath[$catid]))
    {
      $database = & JFactory::getDBO();
      $database->setQuery(" SELECT
                              catpath
                            FROM
                              "._JOOM_TABLE_CATEGORIES."
                            WHERE
                              cid= ".$catid
                          );

      if(!$path = $database->loadResult())
      {
        $catpath[$catid] = '/';
      }
      else
      {
        $catpath[$catid] = $path.'/';
      }
    }

    return $catpath[$catid];
  }

  /**
   * Check the upload time of picture and determine if it is within a setted span
   * of time and so marked as NEW
   *
   * @access  public
   * @param   int     $uptime   Upload time in seconds
   * @param   int     $daysnew  Span of time in days
   * @return  string  The HTML output of the new icon or empty string
   * @since   1.0.0
   */
  function checkNew($uptime, $daysnew)
  {
    $isnew = '';

    // Get the seconds from starting time of Unix Epoch (January 1 1970 00:00:00 GMT)
    // to now in seconds
    $thistime   = time();
    // Calculate the seconds according to days setted for new
    // See configuration manager
    $timefornew = 86400 * $daysnew;
    // If span of time since upload is lower than span of time setted in config
    if(($thistime - strtotime($uptime)) < $timefornew)
    {
      // Show the 'new' image
      $isnew = JHTML::_('joomgallery.icon', 'new.png', 'New');
    }

    return $isnew;
  }

  /**
   * Checks images of category and possibly sub-categories
   * and calls checkNew() to decide if NEW
   *
   * @access  public
   * @param   string  $catids_values  IDs of categories ('x,y')
   * @return  string  HTML output of the new icon or empty string
   * @since   1.0.0
   */
  function checkNewCatg($cid)
  {
    $config = & JoomConfig::getInstance();
    $db     = & JFactory::getDBO();
    $user   = & JFactory::getUser();
    $isnewcat = '';

    // Get all sub-categories including the current category
    $catids = JoomHelper::getAllSubCategories($cid, true);

    if(count($catids))
    {
      // Implode array to a comma separated string if more than one element in array
      $catid_values = implode(',', $catids);
      // Search in db the categories in $catids_values
      $db->setQuery( "SELECT
                        MAX(imgdate)
                      FROM
                        "._JOOM_TABLE_IMAGES." AS a
                      LEFT JOIN
                        "._JOOM_TABLE_CATEGORIES." AS c
                      ON
                        c.cid = a.catid
                      WHERE
                        a.catid     IN ($catid_values)
                    ");
      $maxdate = $db->loadResult();
      if($db->getErrorNum())
      {
        JError::raiseWarning(500, $db->getErrorMsg());
      }

      // If maxdate = NULL no image found
      // Otherwise check the date to 'new'
      if($maxdate)
      {
        $isnewcat = JoomHelper::checkNew($maxdate, $config->get('jg_catdaysnew'));
      }
    }

    // If no new found at all
    // Return empty string
    return $isnewcat;
  }

  /**
   * Constructs the Pathway/Breadcrumbs for the category links
   *
   * @TODO: Just used by the favourites view (layout:list). What happened with it in userpanel?
   *
   * @access  public
   * @param   int     $cat        Category ID
   * @param   boolean $with_home  true, if the home link shall be included, defaults to true
   * @return  string  fully constructed HTML pathname with links
   * @since   1.0.0
   */
  function categoryPathLink($cat, $with_home = true)
  {
    $database = & JFactory::getDBO();
    $user = & JFactory::getUser();

    $cat=intval( $cat );
    $parent_id=$cat;

    while ( $parent_id ) {
      $query="SELECT *
          FROM #__joomgallery_catg
          WHERE cid=$cat AND access <= '".$user->get('aid')."'";
      $database->setQuery( $query );
      $result = $database->loadObject();
      if (!isset($result)) return '';
      $parent_id = $result->parent;
      $cid = $result->cid;
      $catname = $result->name;
      $name='    <a href="'. JRoute::_('index.php?option=com_joomgallery&view=category&catid='.$cat._JOOM_ITEMID).'" class="jg_pathitem">' . $catname  . '</a>' . "\n";
      // write path
      if ( empty( $path ) ) {
        $path = $name;
      } else {
        $path = $name . '    &raquo; '."\n" . $path;
      }
      // next loop
      $cat=$parent_id;
    }
    if($with_home) {
      $home = '    <a href="'. JRoute::_('index.php?option=com_joomgallery&view=gallery'._JOOM_ITEMID) . '" class="jg_pathitem">' . JText::_('JGS_COMMON_HOME') . '</a>';
      $pathName = $home . "\n" . '    &raquo; '."\n" . $path . ' ';
    } else {
      $pathName = $path;
    }

    return $pathName;
  }

 /**
   * Counts all images in a category and their sub-categories
   * for DefaultView and CategoryView
   *
   * @access  public
   * @param   int  $cat Category ID
   * @param   bool true to count the pictures in the root category
   * @return  int  Number of all images in categories->subcategories....
   * @since   1.0.0
   */
  function getNumberOfLinks($cat, $rootcat = true)
  {
    $cat      = (int) $cat;
    $piccount = 0;

    // Get category structure from ambit
    $ambit = JoomAmbit::getInstance();
    $cats = $ambit->getCategoryStructure();

    $parentcats       = array();
    $parentcats[$cat] = true;
    $branchfound      = false;

    // Determine start index in separate loop for better performance
    $startindex = 0;
    $stopindex = count($cats);
    for($i = 0; $i < $stopindex; $i++)
    {
      if($cats[$i]->cid == $cat)
      {
        $startindex = $i;
        if($rootcat)
        {
          $piccount += $cats[$i]->piccount;
        }
        break;
      }
    }

    // Count all images in branch
    for($i = $startindex + 1; $i < $stopindex; $i++)
    {
      $parentcat = $cats[$i]->parent;
      if(isset($parentcats[$parentcat]))
      {
        $parentcat = $cats[$i]->cid;
        $parentcats[$parentcat] = true;
        $piccount += $cats[$i]->piccount;
        $branchfound = true;
      }
      else
      {
        if($branchfound)
        {
          // Branch has been processed completely
          break;
        }
      }
    }

    return $piccount;
  }

  /**
   * Construct page title
   *
   * @access  public
   * @param   string  $text
   * @param   string  $catname
   * @param   string  $imgtitle
   * @return  string  modified title
   * @since   1.0.0
   */
  function createPagetitle($text, $catname = '', $imgtitle = '')
  {
    preg_match_all('/(\[\!.*?\!\])/i', $text, $results);
    define('JGS_COMMON_CATEGORY', JText::_('JGS_COMMON_CATEGORY'));
    define('JGS_COMMON_IMAGE', JText::_('JGS_COMMON_IMAGE'));
    for($i = 0; $i<count($results[0]); $i++)
    {
      $replace = str_replace('[!', '', $results[0][$i]);
      $replace = str_replace('!]', '', $replace);
      $replace = trim($replace);
      $replace2 = str_replace('[!', '\[\!', $results[0][$i]);
      $replace2 = str_replace('!]', '\!\]', $replace2);
      $text = preg_replace('/('.$replace2.')/ie', $replace, $text);
    }
    $text = str_replace('#cat', $catname,   $text);
    $text = str_replace('#img', $imgtitle,  $text);

    return $text;
  }

  /**
   * Returns all categories and their sub-categories with published or no images
   *
   * @access  public
   * @param   int     $cat        Category ID
   * @param   boolean $rootcat    True, if $cat shall also be returned as an
   *                              element of the array
   * @param   boolean $noimgcats  True if @return shall also include categories
   *                              with no images
   * @return  array   An array of found categories
   * @since   1.5.5
   */
  function getAllSubCategories($cat, $rootcat = false, $noimgcats = false)
  {
    $cat              = (int) $cat;
    $parentcats       = array();
    $parentcats[$cat] = true;
    $branchfound      = false;
    $allsubcats       = array();

    // Get category structure from ambit
    $ambit = JoomAmbit::getInstance();
    $cats  = $ambit->getCategoryStructure();

    // Determine start index in separate loop for better performance
    $startindex = 0;
    $stopindex = count($cats);
    $catfound = false;
    for($i = 0; $i < $stopindex; $i++)
    {
      if($cats[$i]->cid == $cat)
      {
        $startindex = $i;
        $catfound = true;
        break;
      }
    }

    if (!$catfound)
    {
      return $allsubcats;
    }

    // Find all cats which are subcategories of cat
    for($i = $startindex+1; $i < $stopindex; $i++)
    {
      $parentcat = $cats[$i]->parent;
      if(isset($parentcats[$parentcat]))
      {
        $parentcat = $cats[$i]->cid;
        $parentcats[$parentcat] = true;
        $branchfound = true;
        if(!$noimgcats)
        {
          // Only categories with images
          if($cats[$i]->piccount > 0)
          {
            // Subcategory with images in array
            $allsubcats[] = $cats[$i]->cid;
          }
        }
        else
        {
          $allsubcats[] = $cats[$i]->cid;
        }
      }
      else
      {
        if($branchfound)
        {
          // branch has been processed completely
          break;
        }
      }
    }

    // Add rootcat
    if($rootcat)
    {
      if(!$noimgcats)
      {
        // Includes images
        if($cats[$startindex]->piccount > 0)
        {
          $allsubcats[] = $cat;
        }
      }
      else
      {
        $allsubcats[] = $cat;
      }
    }

    return $allsubcats;
  }

  /**
   * Returns all parent categories of a specific category
   *
   * @access  public
   * @param   int     $category The ID of the specific child category
   * @param   boolean $child    True, if category itself shall also be returned, defaults to false
   * @return  array   An array of parent category objects with cid,name,parent
   * @since   1.5.5
   */
  function getAllParentCategories($category, $child = false)
  {
    // Get category structure from ambit
    $ambit    = JoomAmbit::getInstance();
    $cats = $ambit->getCategoryStructure();
    $parents  = array();
    $stopindex = count($cats);
    $startindex = 0;

    // Search for category in $cats
    for ($x=0; $x < $stopindex ; $x++)
    {
      if ($cats[$x]->cid == $category)
      {
        $startindex = $x;
        // Insert category itself in array if needed
        if($child)
        {
          $parents[$category]->cid    = $category;
          $parents[$category]->name   = $cats[$x]->name;
          $parents[$category]->parent = $cats[$x]->parent;
        }
      }
    }
    $parentcat = $cats[$startindex]->parent;
    // Iterate reverse from precedor of cat in $startindex to find the parents
    for ($x = $stopindex-1; $x >= 0; $x--)
    {
      // Parent found
      if ($cats[$x]->cid == $parentcat)
      {
          $parents[$cats[$x]->cid]->cid    = $cats[$x]->cid;
          $parents[$cats[$x]->cid]->name   = $cats[$x]->name;
          $parents[$cats[$x]->cid]->parent = $cats[$x]->parent;
          $parentcat = $cats[$x]->parent;
          // Rootparent found
          if ($parentcat == 0)
          {
            break;
          }
      }
    }
    // Reverse the array to get the right order
    $parents = array_reverse($parents, true);
    return $parents;
  }

  /**
   * Counts the hits of all images in a category and their sub-categories
   *
   * @access  publc
   * @param   int   the category ID
   * @param   bool  true to count in addition the hits of the root category
   * @return  int   The number of total hits
   * @since   1.0.0
   */
  function getTotalHits(&$cat, $rootcat=true)
  {
    $cat      = (int) $cat;
    $hitcount = 0;

    // Get category structure from ambit
    $ambit = JoomAmbit::getInstance();
    $cats = $ambit->getCategoryStructure();

    $parentcats       = array();
    $parentcats[$cat] = true;
    $branchfound      = false;

    // Determine start index in separate loop for better performance
    $startindex = 0;
    $stopindex = count($cats);
    for($i = 0; $i < $stopindex; $i++)
    {
      if($cats[$i]->cid == $cat)
      {
        $startindex = $i;
        if ($rootcat)
        {
          $hitcount += $cats[$i]->hitcount;
        }
        break;
      }
    }

    // Count all hits in branch
    for($i = $startindex + 1; $i < $stopindex; $i++)
    {
      $parentcat = $cats[$i]->parent;
      if(isset($parentcats[$parentcat]))
      {
        $parentcat = $cats[$i]->cid;
        $parentcats[$parentcat] = true;
        $hitcount += $cats[$i]->hitcount;
        $branchfound = true;
      }
      else
      {
        if($branchfound)
        {
          // Branch has been processed completely
          break;
        }
      }
    }

    return $hitcount;
  }

  /**
   * Returns all available smileys in an array
   *
   * @access  public
   * @return  array   An array with the smileys
   * @since   1.5.0
   */
  function getSmileys()
  {
    $config = & JoomConfig::getInstance();

    $path = _JOOM_LIVE_SITE.'components/com_joomgallery/assets/images/smilies/'. $config->jg_smiliescolor . '/';

    $smileys                      = array();
    $smileys[':smile:']           = $path.'sm_smile.gif';
    $smileys[':cool:']            = $path.'sm_cool.gif';
    $smileys[':grin:']            = $path.'sm_biggrin.gif';
    $smileys[':wink:']            = $path.'sm_wink.gif';
    $smileys[':none:']            = $path.'sm_none.gif';
    $smileys[':mad:']             = $path.'sm_mad.gif';
    $smileys[':sad:']             = $path.'sm_sad.gif';
    $smileys[':dead:']            = $path.'sm_dead.gif';

    if($config->get('jg_anismilie'))
    {
      $smileys[':yes:']           = $path.'sm_yes.gif';
      $smileys[':lol:']           = $path.'sm_laugh.gif';
      $smileys[':smilewinkgrin:'] = $path.'sm_smilewinkgrin.gif';
      $smileys[':razz:']          = $path.'sm_bigrazz.gif';
      $smileys[':roll:']          = $path.'sm_rolleyes.gif';
      $smileys[':eek:']           = $path.'sm_bigeek.gif';
      $smileys[':no:']            = $path.'sm_no.gif';
      $smileys[':cry:']           = $path.'sm_cry.gif';
    }

    $dispatcher = & JDispatcher::getInstance();
    $dispatcher->trigger('onJoomGetSmileys', array(&$smileys));

    return $smileys;
  }

  /**
   * At the moment just a wrapper function for JModuleHelper::getModules()
   *
   * @access  public
   * @param   string  $pos  The position name
   * @return  array   An array of module objects
   * @since   1.5.0
   */
  function getModules($pos)
  {
    $view   = JRequest::getCmd('view');

    $position = 'jg_'.$pos;
    $modules  = & JModuleHelper::getModules($position);

    $views = array( ''            => 'gal',
                    'gallery'     => 'gal',
                    'category'    => 'cat',
                    'detail'      => 'dtl',
                    'toplist'     => 'tpl',
                    'search'      => 'sea',
                    'favourites'  => 'fav',
                    'userpanel'   => 'usp',
                    'upload'      => 'upl'
                  );
    if(isset($views[$view]))
    {
      $position = $position.'_'.$views[$view];
      $ind_mods = & JModuleHelper::getModules($position);
      $modules = array_merge($modules, $ind_mods);
    }

    $ind_mods = & JModuleHelper::getModules($position.'_'.$view);
    $modules  = array_merge($modules, $ind_mods);

    return $modules;
  }

  /**
   * Renders modules provided by getModules()
   *
   * @access  public
   * @param   string  $pos  he position name
   * @return  array   An array of rendered modules
   * @since   1.5.5
   */
  function getRenderedModules($pos)
  {
    static $renderer;

    $modules  = JoomHelper::getModules($pos);

    if(count($modules))
    {
      if(!isset($renderer))
      {
        $document = &JFactory::getDocument();
        $renderer = $document->loadRenderer('module');
      }

      $style    = -2;
      $params   = array('style' => $style);

      foreach($modules as $key => $module)
      {
        $modules[$key]->rendered = $renderer->render($module, $params);
      }
    }

    return $modules;
  }

  /**
   * Sets all params for the output depending on the view and the config settings
   *
   * @access  public
   * @param   $params The parameter object
   * @since   1.5.5
   */
  function prepareParams(&$params)
  {
    $config = & JoomConfig::getInstance();
    $user   = & JFactory::getUser();
    $view   = JRequest::getCmd('view');

    // Gallery Title
    if(!JRequest::getInt('Itemid') && $config->get('jg_showgalleryheader'))
    {
      $params->set('show_page_title', 1);
    }

    // Pathway
    if($view != 'gallery' || $config->get('jg_showgallerysubhead'))
    {
      // Pathway in the header
      if($config->get('jg_showpathway') == 1 || $config->get('jg_showpathway') == 3)
      {
        $params->set('show_header_pathway', 1);
      }
      // Pathway in the footer
      if($config->get('jg_showpathway') >= 2)
      {
        $params->set('show_footer_pathway', 1);
      }
    }

    // Search in the header
    if($config->get('jg_search') == 1 || $config->get('jg_search') == 3)
    {
      $params->set('show_header_search', 1);
    }
    //Search in the footer
    if($config->get('jg_search') >= 2)
    {
      $params->set('show_footer_search', 1);
    }

    // Backlink in the header
    if($config->get('jg_showbacklink') == 1 || $config->get('jg_showbacklink') == 3)
    {
      $params->set('show_header_backlink', 1);
    }
    // Backlink in the footer
    if($config->get('jg_showbacklink') >= 2)
    {
      $params->set('show_footer_backlink', 1);
    }

    // All Images in the header
    if($config->get('jg_showallpics') == 1 || $config->get('jg_showallpics') == 3)
    {
      $params->set('show_header_allpics', 1);
    }
    // All Images in the footer
    if($config->get('jg_showallpics') >= 2)
    {
      $params->set('show_footer_allpics', 1);
    }

    // All Hits in the header
    if($config->get('jg_showallhits') == 1 || $config->get('jg_showallhits') == 3)
    {
      $params->set('show_header_allhits', 1);
    }
    // All Hits in the footer
    if($config->get('jg_showallhits') >= 2)
    {
      $params->set('show_footer_allhits', 1);
    }

    // Link to userpanel in the header
    if($config->get('jg_userspace') == 1)
    {
      if(   (($config->get('jg_showuserpanel') == 1) && ($user->get('aid') > 0))
         || (($config->get('jg_showuserpanel') > 0 ) && ($user->get('aid') == 2))
         || ($config->get('jg_showuserpanel') == 3)
        )
      {
        if($user->get('aid') != 0)
        {
          $params->set('show_mygal', 1);
        }
        else
        {
          $params->set('show_mygal_no_access', 1);
        }
      }
    }

    // Link to favourites in the header
    if($config->get('jg_favourites'))
    {
      if($view != 'favourites')
      {
        if(   (($config->get('jg_showdetailfavourite') == 0) && ($user->get('aid') >= 1))
           || (($config->get('jg_showdetailfavourite') == 1) && ($user->get('aid') == 2))
           || (($config->get('jg_usefavouritesforpubliczip') == 1) && ($user->get('aid') < 1))
          )
        {
          if( ($config->get('jg_usefavouritesforzip') == 1)
             || (($config->get('jg_usefavouritesforpubliczip') == 1) && ($user->get('aid') < 1))
            )
          {
            $params->set('show_favourites', 1);
          }
          else
          {
            $tooltip_text = JText::_('JGS_COMMON_FAVOURITES_DOWNLOAD_TIPTEXT', true);
            if($config->get('jg_zipdownload') && $view != 'createzip')
            {
              $tooltip_text .= ' '.JText::_('JGS_COMMON_DOWNLOADZIP_DOWNLOAD_ALLOWED_TIPTEXT', true);
            }
            $params->set('show_favourites', 2);
            $params->set('favourites_tooltip_text', $tooltip_text);
          }
        }
        else
        {
          if(($config->get('jg_favouritesshownotauth') == 1/*) && ($user->get('aid') < 1*/))
          {
            if($config->get('jg_usefavouritesforzip') == 1)
            {
              $params->set('show_favourites', 3);
            }
            else
            {
              $params->set('show_favourites', 4);
            }
          }
        }
      }
      else
      {
        if(     $config->get('jg_zipdownload')
            || ($user->get('id') < 1 && $config->get('jg_usefavouritesforpubliczip'))
          )
        {
          $params->set('show_favourites', 5);
        }
      }
    }

    // Toplist
    if(     $config->get('jg_whereshowtoplist') == 0
        || ($config->get('jg_whereshowtoplist')  > 0 && $view == 'gallery')
        || ($config->get('jg_whereshowtoplist') == 2 && $view == 'category')
      )
    {
      // Toplist in the header
      if(    $config->get('jg_showtoplist') > 0
          && $config->get('jg_showtoplist') < 3
        )
      {
        $params->set('show_header_toplist', 1);
      }
      // Toplist in the footer
      if($config->get('jg_showtoplist') > 1)
      {
        $params->set('show_footer_toplist', 1);
      }
    }

    // RM/SM Legend in the footer
    if($config->get('jg_rmsm') == 1 && ($view == 'gallery' || $view == 'category'))
    {
      $params->set('show_rmsm_legend', 1);
    }

    // Separator in the footer
    if($view == 'detail')
    {
      $params->set('show_footer_separator', 1);
    }

    // Credits in the footer
    if($config->get('jg_suppresscredits'))
    {
      $params->set('show_credits', 1);
    }
  }

  /**
   * Creates the target and the label of the backlinks
   *
   * @TODO: All the queries in this function are unnecessary,
   * because all the information is already loaded in the models
   *
   * @access  public
   * @param   object  $params The parameter object
   * @param   int     $id     ID of the current category if we are in category view, ID of current image if we are in detail view
   * @return  array   0 => target, 1 => label
   * @since   1.5.5
   */
  function getBackLink(&$params, $id = 0)
  {
    $database = & JFactory::getDBO();
    $view = JRequest::getCmd('view');

    // Disable backlink in gallery view
    if($view == 'gallery')
    {
      $params->set('show_header_backlink', 0);
      $params->set('show_footer_backlink', 0);
    }

    if($view == 'category')
    {
      // Sub-category and category view
      $query = "  SELECT
                    parent
                  FROM
                    "._JOOM_TABLE_CATEGORIES."
                  WHERE
                    cid = ".$id."
                  ";
      $database->setQuery($query);
      $catid = $database->loadResult();
      if($catid != 0)
      {
        // Sub-category -> parent category
        $target = JRoute::_('index.php?view=category&catid='.$catid);
        $label  = JText::_('JGS_COMMON_BACK_TO_CATEGORY');
      }
      else
      {
        // Category view -> gallery view
        $target = JRoute::_('index.php?view=gallery');
        $label  = JText::_('JGS_COMMON_BACK_TO_GALLERY');
      }
    }
    else
    {
      if($view == 'detail')
      {
        // Detail view -> category view
        $query = "  SELECT
                      catid
                    FROM
                      "._JOOM_TABLE_IMAGES."
                    WHERE
                      id = ".$id."
                    ";
        $database->setQuery($query);
        $catid = $database->loadResult();

        $target = JRoute::_('index.php?view=category&catid='.$catid).'#category';
        $label  = JText::_('JGS_COMMON_BACK_TO_CATEGORY');
      }
      else
      {
        // General
        $target = "javascript:history.back();";
        $label  = JText::_('JGS_COMMON_BACK');
      }
    }

    return array($target, $label);
  }

  /**
   * Returns the current and total number of images and hits
   *
   * @access  public
   * @param   $params The parameter object
   * @return  array   0 => images, 1 => hits
   * @since   1.5.5
   */
  function getPicsAndHits(&$params)
  {
    // Get category structure from ambit
    $ambit    = JoomAmbit::getInstance();
    $cats     = $ambit->getCategoryStructure();
    $hitcount = 0;
    $piccount = 0;

    $catssize = count($cats);

    for($i = 0; $i < $catssize; $i++)
    {
      $hitcount += $cats[$i]->hitcount;
      $piccount += $cats[$i]->piccount;
    }
    $array    = array();
    $array[]  = number_format($piccount, 0, JText::_('JGS_COMMON_DECIMAL_SEPARATOR'), JText::_('JGS_COMMON_THOUSANDS_SEPARATOR'));

    if($params->get('show_header_allhits') || $params->get('show_footer_allhits'))
    {
      $array[]  = number_format($hitcount, 0, JText::_('JGS_COMMON_DECIMAL_SEPARATOR'), JText::_('JGS_COMMON_THOUSANDS_SEPARATOR'));
    }
    else
    {
      $array[] = 0;
    }
    return $array;
  }

  /**
   * Resort an array of category objects to ensure, that a parent category
   * is always listed before it's child categories. The function expects a $cats
   * category list, which is already sorted by parent ascending.
   *
   * @access  public
   * @param   array   $cats         Array of category objects to resort
   * @param   array   $catssorted   Resorted category object array
   * @return  void
   * @since   1.5.5
   */
  function sortCategoryList(&$cats, &$catssorted)
  {
    // First create a two dimensional array containing the child category objects
    // for each parent category id
    $children = array();
    foreach($cats as $cat)
    {
      $pcid = $cat->parent;
      $list = isset($children[$pcid]) ? $children[$pcid] : array();
      $list[] = $cat;
      $children[$pcid] = $list;
    }

    // Now resort the given $cats array with the help of the $children array
    JoomHelper::sortCategoryListRecurse(0, $children, $catssorted);
  }

  /**
   * Helper function for JoomHelper::sortCategoryList().
   *
   * @access  public
   * @param   int     $catid          Category id
   * @param   array   $children       Two dimensional array containing the child
   *                                  category objects for each parent category id
   * @param   array   $catssorted     Resorted category object array
   * @return  void
   * @since   1.5.6
   */
  function sortCategoryListRecurse($catid, &$children, &$catssorted)
  {
    if(isset($children[$catid]))
    {
      foreach($children[$catid] as $cat)
      {
        $catssorted[] = $cat;
        JoomHelper::sortCategoryListRecurse($cat->cid, $children, $catssorted);
      }
    }
  }

  /**
   * Returns the rating clause for an SQL - query dependent on the
   * rating calculation method selected.
   *
   * @access  public
   * @param   string  $tablealias   Table alias
   * @return  string  Rating clause
   * @since   1.5.6
   */
  function getSQLRatingClause($tablealias = '')
  {
    $db                   = & JFactory::getDBO();
    $config               = & JoomConfig::getInstance();
    static $avgimgvote    = 0.0;
    static $avgimgrating  = 0.0;
    static $avgdone       = false;

    $maxvoting            = $config->get('jg_maxvoting');
    $imgvotesum           = 'imgvotesum';
    $imgvotes             = 'imgvotes';
    if($tablealias != '')
    {
      $imgvotesum = $tablealias.'.'.$imgvotesum;
      $imgvotes   = $tablealias.'.'.$imgvotes;
    }

    // Standard rating clause
    $clause = 'ROUND(LEAST(IF(imgvotes > 0, '.$imgvotesum.'/'.$imgvotes.', 0.0), '.(float)$maxvoting.'), 2)';

    // Advanced (weigthed) rating clause (Bayes)
    if($config->get('jg_ratingcalctype') == 1)
    {
      if(!$avgdone)
      {
        // Needed values for weighted rating calculation
        $db->setQuery('SELECT
                         count(*) As imgcount,
                         SUM(imgvotes) As sumimgvotes,
                         SUM(imgvotesum/imgvotes) As sumimgratings
                       FROM
                         '._JOOM_TABLE_IMAGES.'
                        WHERE
                          imgvotes > 0'
                      );
        $row = $db->loadObject();
        if($row != null)
        {
          if($row->imgcount > 0)
          {
            $avgimgvote   = round($row->sumimgvotes / $row->imgcount, 2 );
            $avgimgrating = round($row->sumimgratings / $row->imgcount, 2);
            $avgdone      = true;
          }
        }
      }
      if($avgdone)
      {
        $clause = 'ROUND(LEAST(IF(imgvotes > 0, (('.$avgimgvote.'*'.$avgimgrating.') + '.$imgvotesum.') / ('.$avgimgvote.' + '.$imgvotes.'), 0.0), '.(float)$maxvoting.'), 2)';
      }
    }

    return $clause;
  }
}