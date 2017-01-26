<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/interface.php $
// $Id: interface.php 2630 2011-01-04 06:56:09Z aha $
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
 * The JoomGallery interface class provides an interface / API
 * to other Joomla extensions to use functions of the Gallery,
 * e.g. to display thumbnails in a Plugin or Module.
 *
 * You just need to include this file, create an interface object
 * and set some options if you want to adjust the output, before
 * using one of the functions.
 * If you display any HTML output, you should once call getPageHeader()
 * first
 *
 * @package JoomGallery
 * @since   1.0.0
 */
class JoomInterface
{
  /**
   * Holds the interface configuration
   *
   * @access  protected
   * @var     array
   */
  var $_config = array();

  /**
   * Holds the JoomGallery configuration
   *
   * @access  protected
   * @var     object
   */
  var $_jg_config  = null;

  /**
   * Holds the stored interface configuration
   *
   * @access  protected
   * @var     array
   */
  var $_storedConfig = array();

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function JoomInterface()
  {
    // Register some classes
    JLoader::register('JoomHelper', JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'helper.php');
    JLoader::register('JoomConfig', JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'config.php');
    JLoader::register('JoomAmbit',  JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'ambit.php');
    JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'tables');
    JHTML::addIncludePath(JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'html');
    require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'includes'.DS.'defines.php');

    $this->_mainframe = & JFactory::getApplication();
    $this->_db        = & JFactory::getDBO();
    $this->_ambit     = & JoomAmbit::getInstance();
    $this->_jg_config = & JoomConfig::getInstance();

    // Include language for display
    $language = & JFactory::getLanguage();
    $language->load('com_joomgallery');

    // Load JoomGallery plugins
    JPluginHelper::importPlugin('joomgallery');

    // Set some default values for options given in global JG config (may be overridden)
    $this->_config['showhits']        = $this->_jg_config->get('jg_showhits');
    $this->_config['showpicasnew']    = $this->_jg_config->get('jg_showpicasnew');
    $this->_config['showtitle']       = $this->_jg_config->get('jg_showtitle');
    $this->_config['showauthor']      = $this->_jg_config->get('jg_showauthor');
    $this->_config['showrate']        = $this->_jg_config->get('jg_showcatrate');
    $this->_config['shownumcomments'] = $this->_jg_config->get('jg_showcatcom');
    $this->_config['showdescription'] = $this->_jg_config->get('jg_showcatdescription');

    $this->_config['openimage']       = $this->_jg_config->get('jg_detailpic_open');

    // Further defaults (not given by JG config)
    // - Category path links to category
    $this->_config['showcatlink']     = 1;
    // - Comma-separated list of categories to filter from (empty: all categories, default)
    $this->_config['categoryfilter']  = '';
    // - Display last comment (see Module JoomImages) not implemented yet!
    $this->_config['showlastcomment'] = 0;
    // - Make use of unpublished images and images in unpublished categories: TODO
    $this->_config['showunpublished'] = 0;

    $this->storeConfig();
  }

  /**
   * Passes a whole array of config items, existing (default)
   * values are overwritten if a new item with the same key
   * is passed.
   *
   * @access  public
   * @param   array   $config An array of settings
   * @return  void
   * @since   1.0.0
   */
  function setConfig($config)
  {
    foreach($config as $key => $value)
    {
      $config[$key] = $this->_db->getEscaped($value);
    }
    // Merge new array into existing one, overwriting if needed:
    $this->_config = array_merge($this->_config, $config);
  }

  /**
   * Sets a single option in the interface settings
   * If the key already exists, the setting will be overridden.
   *
   * @access  public
   * @param   string  $key    The key of the new setting
   * @param   string  $value  The value of the new setting
   * @return  void
   * @since   1.0.0
   */
  function addConfig($key, $value = '')
  {
    $this->_config[$key] = $this->_db->getEscaped($value);
  }

  /**
   * Requests string (e.g. modification of a SQL query or true/false)
   * associated with config option $key.
   * If the according value has not been set with addConfig
   * before, a default is returned. Config options are not used
   * directly for security.
   *
   * @access  public
   * @param   string  $key The key of the requested setting
   * @return  string  The requested setting, boolean false, if the key was not found
   * @since   1.0.0
   */
  function getConfig($key)
  {
    if(array_key_exists($key, $this->_config))
    {
      // Access filtered to special keys (DB query strings)
      if($key == 'hidebackend')
      {
        if($this->_config['hidebackend'] == 'true')
        {
          return " AND jg.useruploaded = '1' ";
        }
        else
        {
          return '';
        }
      }
      elseif($key == 'categoryfilter')
      {
        $catids = trim($this->_db->getEscaped($this->_config['categoryfilter']));
        if($catids != '')
        {
          return " AND jg.catid IN (".$catids.") ";
        }
        else
        {
          return '';
        }
      }
      else
      {
        // Regular keys
        return $this->_config[$key];
      }
    }
    else
    {
      return false;
    }
  }

  /**
   * Stores the config in order to be able to reset it later on
   *
   * @access  public
   * @return  void
   * @since   1.5.0
   */
  function storeConfig()
  {
    $this->_storedConfig = $this->_config;
  }

  /**
   * Resets the config in order to get the settings as they were
   * at the point of time when 'storeConfig' was called lastly.
   *
   * @access  public
   * @return  void
   * @since   1.5.0
   */
  function resetConfig()
  {
    $this->_config = $this->_storedConfig;
  }

  /**
   * Returns config value associated with config option $key
   * of the global configuration of JoomGallery.
   *
   * @access  public
   * @param   string  $key The key of the requested setting
   * @return  string  The requested setting, boolean false, if the key was not found
   * @since   1.0.0
   */
  function getJConfig($key)
  {
    return $this->_jg_config->get($key);
  }

  /**
   * Returns the JoomGallery ambit object
   *
   * @access  public
   * @return  object  JoomAmbit object
   * @since   1.5.5
   */
  function getAmbit()
  {
    return $this->_ambit;
  }

  /**
   * Returns version string of installed JoomGallery
   *
   * @access  public
   * @return  string  The version string
   * @since   1.5.0
   */
  function getGalleryVersion()
  {
    return '1.5.6.2';
  }

  /**
   * Returns an Itemid associated with the gallery.
   *
   * At first check out, if an Itemid was set via the interface,
   * if not, take the Itemid provided by JoomAmbit.
   *
   * @access  public
   * @param   boolean True, if a string like '&Itemid=X' should be returned.
   * @return  string  The Itemid for use in URLs ('&Itemid=X')
   * @since   1.0.0
   */
  function getJoomId($string = true)
  {
    if(isset($this->_config['Itemid']) && $this->_config['Itemid'])
    {
      $Itemid = intval($this->_config['Itemid']);

      return ($string && $Itemid) ? '&Itemid='.$Itemid : $Itemid;
    }
    else
    {
      return $this->_ambit->getItemid($string);
    }
  }

  /**
   * Corrects a link with the right 'option' and 'Itemid' vars of JoomGallery
   *
   * @access  public
   * @param   string  The link to complete
   * @param   boolean True, if all '&' appearances shall be replaced with '&amp;', defaults to true
   * @return  string  The corrected link
   * @since   1.5.5
   */
  function route($url, $xhtml = true)
  {
    // Get the router
    $router = &$this->_mainframe->getRouter();
    // Get current values of vars 'option' and 'Itemid'
    $option = $router->getVar('option');
    $Itemid = $router->getVar('Itemid');
    // Set vars 'option' and 'Itemid'
    $router->setVar('option', 'com_joomgallery');
    $router->setVar('Itemid', $this->getJoomId(false));

    $url = JRoute::_($url, $xhtml);
    $routervars = $router->getVars();
    if(is_null($option))
    {
      // Delete the var from array
      unset($routervars['option']);
    }
    else
    {
      $routervars['option'] = $option;
    }
    if(is_null($Itemid))
    {
      unset($routervars['Itemid']);
    }
    else
    {
      $routervars['Itemid'] = $Itemid;
    }
    $router->setVars($routervars, false);

    return $url;
  }

  /**
   * Simple forwarding of JHTML::_('joomgallery.openimage'):
   * Returns the link to the detail image.
   *
   * @access  public
   * @param   int/object  $img  The image ID or the image object to use
   * @return  string      Link to the detail image
   * @since   1.5.5
   */
  function getImageLink($img, $type = false)
  {
    // Get the router
    $router = &$this->_mainframe->getRouter();
    // Get current values of vars 'option' and 'Itemid'
    $option = $router->getVar('option');
    $Itemid = $router->getVar('Itemid');

    // Set vars 'option' and 'Itemid'
    $router->setVar('option', 'com_joomgallery');
    $router->setVar('Itemid', $this->getJoomId(false));

    $link = JHTML::_('joomgallery.openimage', $this->_config['openimage'], $img, $type, $this->getConfig('group'));

    // Reset vars 'option' and 'Itemid'
    // if the preserved values are null delete the var formerly setted
    // from array of vars
    $routervars = $router->getVars();
    if(is_null($option))
    {
      // Delete the var from array
      unset($routervars['option']);
    }
    else
    {
      $routervars['option'] = $option;
    }
    if(is_null($Itemid))
    {
      unset($routervars['Itemid']);
    }
    else
    {
      $routervars['Itemid'] = $Itemid;
    }
    $router->setVars($routervars, false);
    return $link;
  }

  /**
   * Adds all elements needed to display JoomGallery images
   * properly like CSS. The necessary Javascript is included in
   * the JoomGallery JHTML function openImage().
   *
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function getPageHeader()
  {
    $document = & JFactory::getDocument();

    // Add the CSS file generated from backend settings
    $document->addStyleSheet($this->_ambit->getStyleSheet('joom_settings.css'));

    // Add the main CSS file
    $document->addStyleSheet($this->_ambit->getStyleSheet('joomgallery.css'));

    // Add invidual CSS file if it exists
    if(file_exists(JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'css'.DS.'joom_local.css'))
    {
      $document->addStyleSheet($this->_ambit->getStyleSheet('joom_local.css'));
    }
  }

  /**
   * Creates HTML for linked thumbnail of one image,
   * with display options and style just like in JG
   *
   * @access  public
   * @param   db-obj  $obj    DB-row coming from this interface, e.g. getPicsByCategory
   * @param   boolean $linked If true, we will link the thumbnail, defaults to true
   * @param   string  $class  Optional, addional css class name which is assigned to the img tag
   * @param   string  $div    Optional css class name which is assigned to a div around the img tag
   * @param   string  $extra  Optional, adddional HTML code, which is placed in the img tag
   * @param   string  $type   Optional, image type the link shall open (thumb, img, orig)
   * @return  string  HTML displaying thumbnail (linked, like configured in JG if $linked = true)
   * @since   1.0.0
   */
  function displayThumb($obj, $linked = true, $class = null, $div = null, $extra = null, $type = false)
  {
    $output = '';
    if($obj->id != '')
    {
      // Get the router
      $router = &$this->_mainframe->getRouter();
      // Get current values of vars 'option' and 'Itemid'
      $option = $router->getVar('option');
      $Itemid = $router->getVar('Itemid');
      // Set vars 'option' and 'Itemid'
      $router->setVar('option', 'com_joomgallery');
      $router->setVar('Itemid', $this->getJoomId(false));

      if($div)
      {
        $output .= '<div class="'.$div.'">';
      }
      if($linked)
      {
        // Check for link to category
        if(isset($this->_config['catlink']) && $this->_config['catlink'] == 1)
        {
          $link = JRoute::_('index.php?&view=category&catid='.$obj->catid.$this->getJoomId());
        }
        else
        {
          $link = JHTML::_('joomgallery.openimage', $this->_config['openimage'], $obj, $type, $this->getConfig('group'));
        }

        $output .= '  <a href="'.$link.'" class="jg_catelem_photo">';
      }
      if($class)
      {
        $class = ' '.$class;
      }
      if($extra)
      {
        $extra = ' '.$extra;
      }
      $output   .= '    <img src="'.$this->_ambit->getImg('thumb_url', $obj).'" class="jg_photo'.$class.'" alt="'.$obj->imgtitle.'"'.$extra.' />';
      if($linked)
      {
        $output .= '  </a>';
      }
      if($div)
      {
        $output .= '</div>';
      }
      $routervars = $router->getVars();
      if(is_null($option))
      {
        // Delete the var from array
        unset($routervars['option']);
      }
      else
      {
        $routervars['option'] = $option;
      }
      if(is_null($Itemid))
      {
        unset($routervars['Itemid']);
      }
      else
      {
        $routervars['Itemid'] = $Itemid;
      }
      $router->setVars($routervars, false);
    }
    else
    {
      $output .= "    &nbsp;\n";
    }
    return $output;
  }

  /**
   * Creates HTML for linked detail image of one picture-$obj,
   * with display options & style just like in JG
   *
   * @access  public
   * @param   db-obj  $obj    DB-row coming from this interface, e.g. getPicsByCategory
   * @param   boolean $linked If true, we will link the thumbnail, defaults to true
   * @param   string  $class  Optional, addional css class name which is assigned to the img tag
   * @param   string  $div    Optional css class name which is assigned to a div around the img tag
   * @param   string  $extra  Optional, addional HTML code, which is placed in the img tag
   * @param   string  $type   Optional, image type the link shall open (thumb, img, orig)
   * @return  string  HTML displaying detail image (linked, like configured in JG if $linked = true)
   * @since   1.0.0
   */
  function displayDetail($obj, $linked = true, $class = null, $div = null, $extra = null, $type = false)
  {
    $output = '';
    if($obj->id != '')
    {
      // Get the router
      $router = &$this->_mainframe->getRouter();
      // Get current values of vars 'option' and 'Itemid'
      $option = $router->getVar('option');
      $Itemid = $router->getVar('Itemid');
      // Set vars 'option' and 'Itemid'
      $router->setVar('option', 'com_joomgallery');
      $router->setVar('Itemid', $this->getJoomId(false));

      if($div)
      {
        $output .= '<div class="'.$div.'">';
      }
      if($linked)
      {
        // Check for link to category
        if(isset($this->_config['catlink']) && $this->_config['catlink'] == 1)
        {
          $link = JRoute::_('index.php?&view=category&catid='.$obj->catid.$this->getJoomId());
        }
        else
        {
          $link = JHTML::_('joomgallery.openimage', $this->_config['openimage'], $obj, $type, $this->getConfig('group'));
        }

        $output .= '  <a href="'.$link.'" class="jg_catelem_photo">';
      }
      if($class)
      {
        $class = ' '.$class;
      }
      if($extra)
      {
        $extra = ' '.$extra;
      }
      $output   .= '    <img src="'.$this->_ambit->getImg('img_url', $obj).'" class="jg_photo'.$class.'" alt="'.$obj->imgtitle.'"'.$extra.' />';
      if($linked)
      {
        $output .= '  </a>';
      }
      if($div)
      {
        $output .= '</div>';
      }
      $routervars = $router->getVars();
      if(is_null($option))
      {
        // Delete the var from array
        unset($routervars['option']);
      }
      else
      {
        $routervars['option'] = $option;
      }
      if(is_null($Itemid))
      {
        unset($routervars['Itemid']);
      }
      else
      {
        $routervars['Itemid'] = $Itemid;
      }
      $router->setVars($routervars, false);
    }
    else
    {
      $output .= "    &nbsp;\n";
    }

    return $output;
  }

  /**
   * Creates HTML for description of one image,
   * with display options and style just like in JG.
   * Adjustments are possible via the interface options.
   *
   * @access  public
   * @param   object  $obj  DB-row coming from this interface, e.g. getPicsByCategory
   * @return  string  HTML of thumb description (like configured in JG or in the interface)
   * @since   1.0.0
   */
  function displayDesc($obj)
  {
    if($this->getConfig('disable_infos'))
    {
      return '';
    }

    $output = "<ul>\n";

    if($this->getConfig('showtitle') || $this->getConfig('showpicasnew'))
    {
      $output .= "  <li>";
      if($this->getConfig('showtitle'))
      {
        $output .= '<b>'.$obj->imgtitle.'</b>';
      }
      if($this->getConfig('showpicasnew'))
      {
        $output.= JoomHelper::checkNew($obj->imgdate, $this->_jg_config->get('jg_daysnew'));;
      }
      $output .= "  </li>\n";
    }

    if($this->getConfig('showauthor'))
    {
      if($obj->imgauthor)
      {
        $authorowner = $obj->imgauthor;
      }
      else
      {
        $authorowner = JHTML::_('joomgallery.displayname', $obj->owner);
      }

      $output .= "  <li>".JText::sprintf('JGS_COMMON_AUTHOR_VAR', $authorowner);
      $output .= "</li>\n";
    }

    if($this->getConfig('showcategory'))
    {
      $catpath =
      $output .= "  <li>";

      if($this->getConfig('showcatlink'))
      {
        $catlink = '<a href="'.JRoute::_('index.php?option=com_joomgallery&view=category&catid='.$obj->catid.$this->getJoomId())
                   .'">'.$obj->cattitle
                   .'</a>';
        $output .= JText::sprintf('JGS_COMMON_CATEGORY_VAR',$catlink);
      }
      else
      {
        $output .= JText::sprintf('JGS_COMMON_CATEGORY_VAR',$obj->cattitle);
        $output .= $obj->cattitle;
      }
      $output .= "  </li>";
    }

    if($this->getConfig('showhits'))
    {
      $output .= "  <li>".JText::sprintf('JGS_COMMON_HITS_VAR', $obj->hits)."</li>";
    }
    if($this->getConfig('showrate'))
    {
      if($obj->imgvotes > 0)
      {
        $fimgvotesum = number_format($obj->vote, 2, ',', '.');
        $frating = $fimgvotesum.' ('.$obj->imgvotes .  JText::_('JGS_COMMON_VOTES') . ')';
      }
      else
      {
        $frating =  JText::_('JGS_COMMON_NO_VOTES');
      }

      $output .= '  <li>'. JText::sprintf('JGS_COMMON_RATING_VAR', $frating).'</li>';
    }
    if ($this->getConfig('showimgdate'))
    {
      $output .= '<li>'.sprintf(JText::_('JGS_COMMON_UPLOAD_DATE'),'<br />'.$obj->imgdate).'</li>';
    }

    if($this->getConfig('shownumcomments'))
    {
      $output .='  <li>'. JText::sprintf('JGS_COMMON_COMMENTS_VAR', $obj->cmtcount).'</li>';
    }
    if($this->getConfig('showdescription')  && $obj->imgtext)
    {
      $output .= '  <li>'. JText::sprintf('JGS_COMMON_DESCRIPTION_VAR', $obj->imgtext).'</li>';
    }

    $results  = $this->_mainframe->triggerEvent('onJoomAfterDisplayThumb', array($obj->id));
    $output  .= trim(implode('', $results));

    $output .= '</ul>';

    return $output;
  }

  function displayThumbs($rows)
  {
    if(empty($rows))
    {
      return '';
    }

    $numcols = $this->getConfig('columns');
    if(!$numcols)
    {
      $numcols = $this->getConfig('default_columns');
      if(!$numcols)
      {
        $numcols = 2;
      }
    }

    $elem_width =  floor(99 / $numcols);

    $return     = '';
    $return    .= "\n".'<div class="gallerytab">'."\n";
    $return    .= '<div class="jg_row sectiontableentry2">';
    $rowcount   = 0;
    $itemcount  = 0;

    foreach($rows as $row)
    {
      if(($itemcount % $numcols == 0) && ($itemcount != 0))
      {
          $return .='</div><div class="jg_row sectiontableentry'.($rowcount % 2 + 1).'">'."\n";
          $rowcount++;
      }

      $return .= '<div class="jg_element_cat" style="width:'.$elem_width.'%">'."\n";
      if($this->getConfig('type') == 'img' || $this->getConfig('type') == 'orig')
      {
        $return .= '  '.$this->displayDetail($row);
      }
      else
      {
        $return .= '  '.$this->displayThumb($row);
      }

      if(!$this->getConfig('disable_infos'))
      {
        $return .= '  <div class ="jg_catelem_txt">'."\n";
        $return .= '    '.$this->displayDesc($row);
        $return .= '  </div>'."\n";
      }

      $return .= '</div>'."\n";

      $itemcount++;
    }

    $return.= '</div>'."\n".'</div>';

    return $return;
  }

  /**
   * Returns the number of images of a user
   *
   * @access  public
   * @param   int     $userId The user ID of the user.
   * @param   int     $aid    GroupID of user (for restricted access images)
   * @return  int     Number of images the user has uploaded
   * @since   1.0.0
   */
  function getNumPicsOfUser($userId, $aid = 0)
  {
    $userId   = intval($userId);
    $aid      = intval($aid);

    $query = "  SELECT
                  COUNT(jg.id)
                FROM
                  "._JOOM_TABLE_IMAGES." as jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access   <= ".$aid."
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved = 1
                  AND jg.owner = $userId
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns the number of pictures a user is tagged in
   *
   * @access  public
   * @param   int     $userId The ID of the user.
   * @param   int     $aid    GroupID of user (for restricted access images)
   * @return  int     Number of images the user is tagged in
   * @since   1.0.0
   */
  function getNumPicsUserTagged($userId, $aid = 0)
  {
    $userId = intval($userId);
    $aid    = intval($aid);

    $query = "  SELECT
                  COUNT(nid)
                FROM
                  "._JOOM_TABLE_NAMESHIELDS." AS jgn
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgn.npicid = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                    jgc.access  <= $aid
                ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                AND jg.approved = 1
                AND jgn.nuserid = $userId
            ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns the number of images a user has favoured
   *
   * @access  public
   * @param   int     $userId The ID of the user.
   * @param   int     $aid    GroupID of user (for restricted access images)
   * @return  int     Number of images the user has favoured
   * @since   1.0.0
   */
  function getNumPicsUserFavoured($userId, $aid = 0)
  {
    $userId   = intval($userId);

    $query    = " SELECT
                    piclist
                  FROM
                    "._JOOM_TABLE_USERS."
                  WHERE
                    uuserid = ".$userId."
                ";
    $this->_db->setQuery($query);
    $piclist = $this->_db->loadResult();

    if(!$piclist)
    {
      return 0;
    }

    $query = "  SELECT
                  COUNT(jg.id)
                FROM
                  "._JOOM_TABLE_IMAGES." as jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND jg.id IN ($piclist)
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns the number of images a user has commented on
   *
   * @access  public
   * @param   int     $userId The ID of the user.
   * @param   int     $aid    GroupID of user (for restricted access images)
   * @return  int     Number of images the user hs commented on
   * @since   1.0.0
   */
  function getNumCommentsUser($userId, $aid = 0)
  {
    $userId   = intval($userId);
    $aid      = intval($aid);

    $query = "  SELECT
                  COUNT(cmtid)
                FROM
                  "._JOOM_TABLE_COMMENTS." AS jgco
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgco.cmtpic = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access     <= $aid
                  AND jgco.published  = 1
                  AND jgco.approved   = 1
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved     = 1
                  AND jgco.userid     = $userId
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns the total number of comments (published) in the gallery
   *
   * @access  public
   * @param   int   $aid  GroupID of viewing user (for restricted access images)
   * @return  int   The number of comments published in the gallery
   */
  function getNumComments($aid = 0)
  {
    $userId   = intval($userId);
    $aid      = intval($aid);

    $query = "  SELECT
                  COUNT(cmtid)
                FROM
                  "._JOOM_TABLE_COMMENTS." AS jgco
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgco.cmtpic = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access     <= $aid
                  AND jgco.published  = 1
                  AND jgco.approved   = 1
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved     = 1
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns images of a user
   *
   * @access  public
   * @param   int     $userId     Joomla ID of user
   * @param   int     $aid        Joomla GroupID of viewing user (access rights). 0 for public viewable!
   * @param   string  $sorting    String for DB sorting
   * @param   int     $numPics    Limit number of pictures; leave away to return all
   * @param   int     $limitStart Where to start returning $numPics images
   * @return  array   An array of image objects from the database
   * @since   1.0.0
   */
  function getPicsOfUser($userId, $aid, $sorting, $numPics = null, $limitStart = 0)
  {
    // Validation
    $userId   = intval($userId);
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);

    if(is_null($numPics))
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart = intval($limitStart);
      $numPics    = intval($numPics);

      $limit = "LIMIT ".$limitStart.", ".$numPics;
    }

    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                    cmtpic=jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath as catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= ",
                  jgco.cmttext,
                  jgco.cmtdate,
                  jgco.userid ,
                  jgco.cmtid
                ";
    }
    $query .="
                FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco
                  ON
                    jg.id = jgco.cmtpic
                  LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco2
                  ON
                        jgco.cmtpic   = jgco2.cmtpic
                    AND jgco.cmtdate  < jgco2.cmtdate
                  WHERE
                    jgco2.cmtpic IS NULL
                    AND
                ";
    }
    else
    {
      $query .= " WHERE ";
    }
    $query .= "       jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND jg.owner = $userId";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                  ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

   /**
   * Returns images a user is tagged in
   *
   * @access  public
   * @param   int     $userId     Joomla ID of user
   * @param   int     $aid        Joomla GroupID of viewing user (access rights). 0 for public viewable!
   * @param   string  $sorting    String for DB sorting
   * @param   int     $numPics    Limit number of pictures; leave away to return all
   * @param   int     $limitStart Where to start returning $numPics pictures
   * @return  array   An array of image objects from the database
   * @since   1.0.0
   */
  function getPicsUserTagged($userId, $aid, $sorting, $numPics = null, $limitStart = 0)
  {
    // Validation
    $userId   = intval($userId);
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);
    if(is_null($numPics))
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart = intval($limitStart);
      $numPics    = intval($numPics);

      $limit = "LIMIT ".$limitStart.", ".$numPics;
    }
    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                    cmtpic = jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  jg.owner,
                  jg.imgauthor,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath as catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= ",
                    jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid,
                    jgco.cmtid
                ";
    }
    $query .= " FROM
                  "._JOOM_TABLE_NAMESHIELDS." AS jgn
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgn.npicid = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco
                  ON
                    jg.id = jgco.cmtpic
                  LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." jgco2
                  ON
                        jgco.cmtpic   = jgco2.cmtpic
                    AND jgco.cmtdate  < jgco2.cmtdate
                  WHERE
                    jgco2.cmtpic IS NULL
                    AND ";
    }
    else
    {
      $query .= " WHERE ";
    }
      $query .= "       jgc.access   <= $aid
                    ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                    AND jg.approved   = 1
                    AND jgn.nuserid   = $userId";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                  ".$limit;

    $this->_db->setQuery($query);
    return $this->_db->loadObjectList();
  }

  /**
   * Returns the images a user has favoured
   *
   * @access  public
   * @param   int     $userId     Joomla ID of user
   * @param   int     $aid        Joomla GroupID of viewing user (access rights). 0 for public viewable!
   * @param   string  $sorting    String for DB sorting
   * @param   int     $numPics    Limit number of images, leave away to return all
   * @param   int     $limitStart Where to start returning $numPics images
   * @return  array   An array of image objects from the database
   * @since   1.0.0
   */
  function getPicsUserFavoured($userId, $aid, $sorting, $numPics = null, $limitStart = 0)
  {
    // Validation
    $userId   = intval($userId);
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);
    if(is_null($numPics))
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart = intval($limitStart);
      $numPics    = intval($numPics);

      $limit = "LIMIT ".$limitStart.", ".$numPics;
    }

    $query = "  SELECT
                  piclist
                FROM
                  "._JOOM_TABLE_USERS."
                WHERE
                  uuserid = $userId
              ";
    $this->_db->setQuery($query);
    $piclist = $this->_db->loadResult();

    if(!$piclist)
    {
      return null;
    }

    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                    cmtpic = jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath AS catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " , jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid ,
                    jgco.cmtid
                ";
    }
    $query .="  FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
  if($this->getConfig('showlastcomment'))
  {
    $query .= " LEFT JOIN
                  "._JOOM_TABLE_COMMENTS." AS jgco
                ON
                  jg.id = jgco.cmtpic
                LEFT JOIN
                  "._JOOM_TABLE_COMMENTS." AS jgco2
                ON
                      jgco.cmtpic   = jgco2.cmtpic
                  AND jgco.cmtdate  < jgco2.cmtdate
                WHERE
                      jgco2.cmtpic IS NULL
                  AND
              ";
  }
  else
  {
    $query .= " WHERE ";
  }
  $query .= "       jgc.access   <= $aid
                ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                AND jg.approved   = 1
                AND jg.id IN (".$piclist .")";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                  ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

  /**
   * Returns the comments of a user on images
   *
   * @access  public
   * @param   int     $userId     Joomla ID of user
   * @param   int     $aid        Joomla GroupID of viewing user (access rights). 0 for public viewable!
   * @param   string  $sorting    String for DB sorting (default: newest by ID)
   * @param   int     $numPics    Limit number of images, leave away to return all
   * @param   int     $limitStart Where to start returning $numPics images
   * @return  array   An array of image objects from the database
   * @since   1.0.0
   */
  function getCommentsUser($userId, $aid, $sorting = "jgco.cmtid DESC", $numComments = null, $limitStart = 0)
  {
    $userId   = intval($userId);
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);
    if(is_null($numComments))
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart  = intval($limitStart);
      $numComments = intval($numComments);

      $limit = "LIMIT ".$limitStart.", ".$numComments;
    }

    $query = "  SELECT
                  jgco.cmttext,
                  jgco.cmtdate,
                  jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath as catpath
                FROM
                  "._JOOM_TABLE_COMMENTS." AS jgco
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgco.cmtpic = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access     <= $aid
                  AND jgco.published  = 1
                  AND jgco.approved   = 1
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved     = 1
                  AND jgco.userid     = $userId";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                  ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

  /**
   * Returns the all (or some ;) ) comments in the gallery as DB-rows
   *
   * @access  public
   * @param   int     $userId     Joomla ID of user
   * @param   string  $sorting    String for DB sorting (default: Newest by ID)
   * @param   int     $numPics    Limit number of comments; leave away to return all
   * @param   int     $limitStart Where to start returning $numPics comments
   * @return  array   An array of comment objects from the database
   * @since   1.0.0
   */
  function getComments($aid = 0, $sorting = "jgco.cmtid DESC", $numComments = null, $limitStart = 0)
  {
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);
    if(is_null($numComments))
    {
      // No limit given: Return all comments
      $limit = '';
    }
    else
    {
      $limitStart  = intval($limitStart);
      $numComments = intval($numComments);

      $limit = "LIMIT ".$limitStart.", ".$numComments;
    }

    $query = "  SELECT
                  jgco.cmttext,
                  jgco.cmtdate,
                  jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath AS catpath
                FROM
                  "._JOOM_TABLE_COMMENTS." AS jgco
                LEFT JOIN
                  "._JOOM_TABLE_IMAGES." AS jg
                ON
                  jgco.cmtpic = jg.id
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access     <= $aid
                  AND jgco.published  = 1
                  AND jgco.approved   = 1
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved     = 1";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                  ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

  /**
   * Returns db-row of one image, with optional access verification
   *
   * @access  public
   * @param   int     $picid  ID of images in gallery
   * @param   int     $aid    Optional, GroupID of viewing user, leave away for public access
   * @return  object  The image object from the database
   * @since   1.0.0
   */
  function getPicture($picid, $aid = 0)
  {
    $picid    = intval($picid);
    $aid      = intval($aid);

    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= "(
                    SELECT
                      COUNT(cmtid)
                    FROM
                      "._JOOM_TABLE_COMMENTS."
                    WHERE
                      cmtpic=jg.id
                  ) AS cmtcount,
                  ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath AS catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " , jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid ,
                    jgco.cmtid
                ";
    }
    $query .= " FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco
                  ON
                    jg.id = jgco.cmtpic
                  LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco2
                  ON
                        jgco.cmtpic   = jgco2.cmtpic
                    AND jgco.cmtdate  < jgco2.cmtdate
                  WHERE jgco2.cmtpic IS NULL
                    AND
                ";
    }
    else
    {
      $query .= " WHERE ";
    }
    $query .= "       jgc.access   <= $aid
                  AND jg.approved   = 1
                  AND jg.id         = $picid
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadObject();
  }

  /**
   * Returns the db-row of a random image, to which a
   * user with GroupID=$aid has access to
   * (e.g. for a simple 1pic module)
   *
   * @access  public
   * @param   int     $aid  Optional access verification, leave away for public access
   * @return  object  An image object from the database
   * @since   1.0.0
   */
  function getRandomPicture($aid = 0)
  {
    $aid      = intval($aid);

    $query = "SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE cmtpic=jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= " jg.id,
                jg.catid,
                jg.imgthumbname,
                jg.imgfilename,
                jg.owner,
                jg.imgauthor,
                jg.imgdate,
                jg.imgtitle,
                jg.imgtext,
                jg.hits,
                jg.imgvotes,
                ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                jgc.name AS cattitle,
                jgc.catpath AS catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= "   ,jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid ,
                    jgco.cmtid
                ";
    }
    $query .="  FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
             ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= "LEFT JOIN
                  "._JOOM_TABLE_COMMENTS." AS jgco
                ON
                  jg.id = jgco.cmtpic
                LEFT JOIN
                  "._JOOM_TABLE_COMMENTS." AS jgco2
                ON
                      jgco.cmtpic   = jgco2.cmtpic
                  AND jgco.cmtdate  < jgco2.cmtdate
                WHERE
                  jgco2.cmtpic IS NULL
                  AND
              ";
    }
    else
    {
      $query .= " WHERE ";
    }
    $query .= "       jgc.access   <= $aid
                  AND jg.approved   = 1";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  RAND()";

    $this->_db->setQuery($query);

    return $this->_db->loadObject();
  }

  /**
   * Returns the number of images in a category
   *
   * @access  public
   * @param   int     $catid  ID of category
   * @param   int     $aid    GroupID of user (for restricted access images)
   * @return  int     The number of images in the category
   * @since   1.0.0
   */
  function getNumPicsByCategory($catid, $aid = 0)
  {
    $catid    = intval($catid);
    $aid      = intval($aid);
    $query = "  SELECT
                  COUNT(jg.id)
                FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND jg.catid      = $catid
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns image objects of all images in a category
   *
   * @access  public
   * @param   int     $catid      The ID of the category
   * @param   int     $aid        GroupID of user (for restricted access images)
   * @param   string  $sorting    Sorting string
   * @param   int     $numPics    Limit number of images, leave away to return all
   * @param   int     $limitStart Where to start returning $numPics images
   * @return  array   An array of comment objects from the database
   * @since   1.0.0
   */
  function getPicsByCategory($catid, $aid, $sorting, $numPics = null, $limitStart = 0)
  {
    // Validation
    $catid    = intval($catid);
    $aid      = intval($aid);
    $sorting  = $this->_db->getEscaped($sorting);
    if(is_null($numPics) || $numPics === false)
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart = intval($limitStart);
      $numPics    = intval($numPics);

      $limit = "LIMIT ".$limitStart.", ".$numPics;
    }

    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                    cmtpic = jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath AS catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " , jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid ,
                    jgco.cmtid
                ";
    }
    $query .= " FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco
                  ON
                    jg.id = jgco.cmtpic
                  LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco2
                  ON
                        jgco.cmtpic   = jgco2.cmtpic
                    AND jgco.cmtdate  < jgco2.cmtdate
                  WHERE
                    jgco2.cmtpic IS NULL
                  AND
                ";
    }
    else
    {
      $query .= " WHERE ";
    }
    $query .= "       jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND jg.catid      = $catid";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
                ORDER BY
                  ".$sorting."
                ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

  /**
   * Returns number of images matching the search string
   * (e.g. for pre-filtering, pagination)
   *
   * @access  public
   * @param   string  $searchstring The string to use for the search
   * @param   int     $aid          Group of viewing user (for access rights)
   * @return  int     The number of images matching the search string
   * @since   1.0.0
   */
  function getNumPicsBySearch($searchstring, $aid = 0)
  {
    $aid          = intval($aid);
    $searchstring = $this->_db->getEscaped(strtolower(trim($searchstring)));

    $query = "  SELECT
                  COUNT(jg.id)
                FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
                WHERE
                      jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND (     jg.imgtitle LIKE '%$searchstring%'
                        OR  jg.imgtext LIKE '%$searchstring%'
                      )
              ";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }

    $this->_db->setQuery($query);

    return $this->_db->loadResult();
  }

  /**
   * Returns db-rows of images matching the search string
   * E.g. useful for a search mambot
   *
   * @access  public
   * @param   string  $searchstring The string to use for the search
   * @param   int     $aid          GroupID of user (for restricted access images)
   * @param   string  $sorting      Sorting string
   * @param   int     $numPics      Limit number of images, leave away to return all
   * @param   int     $limitStart   Where to start returning $numPics images
   * @return  array   An array of image objects from the database
   * @since   1.0.0
   */
  function getPicsBySearch($searchstring, $aid, $sorting, $numPics = null, $limitStart = 0)
  {
    $aid          = intval($aid);
    $searchstring = $this->_db->getEscaped(strtolower(trim($searchstring)));
    $sorting      = $this->_db->getEscaped($sorting);

    $dispatcher = & JDispatcher::getInstance();
    $additional = $dispatcher->trigger('onJoomSearch', array($searchstring));

    if(is_null($numPics))
    {
      // No limit given: Return all images
      $limit = '';
    }
    else
    {
      $limitStart = intval($limitStart);
      $numPics    = intval($numPics);

      $limit = "LIMIT ".$limitStart.", ".$numPics;
    }

    $query = "  SELECT ";
    if($this->getConfig('shownumcomments'))
    {
      $query .= " (
                  SELECT
                    COUNT(cmtid)
                  FROM
                    "._JOOM_TABLE_COMMENTS."
                  WHERE
                    cmtpic = jg.id
                  ) AS cmtcount,
                ";
    }
    $query .= "   jg.id,
                  jg.catid,
                  jg.imgthumbname,
                  jg.imgfilename,
                  jg.owner,
                  jg.imgauthor,
                  jg.imgdate,
                  jg.imgtitle,
                  jg.imgtext,
                  jg.hits,
                  jg.imgvotes,
                  ".JoomHelper::getSQLRatingClause('jg')." AS vote,
                  jgc.name AS cattitle,
                  jgc.catpath AS catpath
              ";
    if($this->getConfig('showlastcomment'))
    {
      $query .= " , jgco.cmttext,
                    jgco.cmtdate,
                    jgco.userid ,
                    jgco.cmtid
                ";
    }
    foreach($additional as $add)
    {
      $query .= ', '.implode(', ', $add[0])."
                ";
    }
    $query .= " FROM
                  "._JOOM_TABLE_IMAGES." AS jg
                LEFT JOIN
                  "._JOOM_TABLE_CATEGORIES." AS jgc
                ON
                  jgc.cid = jg.catid
              ";
    foreach($additional as $add)
    {
      $query .= implode(" \n", $add[1])."
              ";
    }
    if($this->getConfig('showlastcomment'))
    {
      $query .= " LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco
                  ON
                    jg.id = jgco.cmtpic
                  LEFT JOIN
                    "._JOOM_TABLE_COMMENTS." AS jgco2
                  ON
                        jgco.cmtpic   = jgco2.cmtpic
                    AND jgco.cmtdate  < jgco2.cmtdate
                  WHERE
                    jgco2.cmtpic IS NULL
                    AND
                ";
    }
    else
    {
      $query .= " WHERE ";
    }
    $query .= "       jgc.access   <= $aid
                  ".$this->getConfig('categoryfilter').$this->getConfig('hidebackend')."
                  AND jg.approved   = 1
                  AND (     jg.imgtitle LIKE '%$searchstring%'
                        OR  jg.imgtext LIKE '%$searchstring%'
                        ";
    foreach($additional as $add)
    {
      $query .= "OR ".implode(" \nOR ", $add[2]);
    }
    $query .= ")";
    if(!$this->getConfig('showunpublished'))
    {
      $query .= " AND jgc.published = 1
                  AND jg.published  = 1";
    }
    $query .= "
              ORDER BY
                ".$sorting."
                ".$limit;

    $this->_db->setQuery($query);

    return $this->_db->loadObjectList();
  }

  /**
   * Creates a new category out of the information of the given object
   *
   * @access  public
   * @param   object  Should hold all the information about the new category
   * @param   int     The ID of the new category, false, if an error occured
   * @since   1.5.0
   */
  function createCategory($obj)
  {
    jimport('joomla.filesystem.file');
    JLoader::register('JoomFile', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'file.php');

    $row = & JTable::getInstance('joomgallerycategories', 'Table');
    $row->bind($obj);

    if(!$row->name)
    {
      JError::raiseWarning(500, JText::_('No valid category name given'));
      return false;
    }

    // Ensure that the data is valid
    if(!$row->check())
    {
      return false;
    }

    // Store the data in the database
    if(!$row->store())
    {
      return false;
    }

    // Now we have the ID of the new category
    // and the catpath can be built
    $row->catpath = JoomFile::fixFilename($row->name).'_'.$row->cid;
    if($row->parent)
    {
      $row->catpath = JoomHelper::getCatPath($row->parent).$row->catpath;
    }
    // So store again, but afore let's create the alias
    $row->check();
    if(!$row->store())
    {
      return false;
    }

    // Create necessary folders and files
    $origpath   = JPATH_ROOT.DS.$this->_jg_config->get('jg_pathoriginalimages').$row->catpath;
    $imgpath    = JPATH_ROOT.DS.$this->_jg_config->get('jg_pathimages').$row->catpath;
    $thumbpath  = JPATH_ROOT.DS.$this->_jg_config->get('jg_paththumbs').$row->catpath;
    $result     = array();
    $result[]   = JFolder::create($origpath);
    $result[]   = JoomFile::copyIndexHtml($origpath);
    $result[]   = JFolder::create($imgpath);
    $result[]   = JoomFile::copyIndexHtml($imgpath);
    $result[]   = JFolder::create($thumbpath);
    $result[]   = JoomFile::copyIndexHtml($thumbpath);

    if(in_array(false, $result))
    {
      return false;
    }
    else
    {
      // New category successfully created
      $row->reorder('parent = '.$row->parent);
      return $row->cid;
    }
  }

  /**
   * Is automatically called when an unknown method is called.
   * This will happen if JoomGallery is not uptodate.
   * Works only with PHP 5.
   *
   * @access  protected
   * @param   string    Name of the unknown method
   * @param   array     Array of parameters given to the unknown method
   * @return  void
   * @since   1.5.0
   */
  function __call($name, $params)
  {
    JError::raiseError('501', 'JoomGallery is not uptodate. Function '.$name.' does not exist');
  }
}