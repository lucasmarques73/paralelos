<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/helpers/ambit.php $
// $Id: ambit.php 2601 2010-11-30 20:03:54Z aha $
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
 * JoomGallery Ambit Class
 *
 * @package     JoomGallery
 * @since       1.5.5
 */
class JoomAmbit extends JObject
{
  /**
   * @TODO: Variable comments
   */
  var $icon_url   = '';
  var $css_url    = '';
  var $js_url     = '';
  var $thumb_url  = '';
  var $img_url    = '';
  var $orig_url   = '';
  var $thumb_path = '';
  var $img_path   = '';
  var $orig_path  = '';
  var $temp_path  = '';
  var $ftp_path   = '';
  #var $version    = '';
  var $_Itemid    = null;
  var $_external  = false;
  var $_categorystructure = null;

  /**
   * Constructor
   *
   * Presets all variables
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function __construct()
  {
    $config = JoomConfig::getInstance();
    $this->_config = $config;

    // Fill all variables
    $this->icon_url   = JURI::root().'components/'._JOOM_OPTION.'/assets/images/';
    $this->css_url    = JURI::base().'components/'._JOOM_OPTION.'/assets/css/';
    $this->js_url     = JURI::base().'components/'._JOOM_OPTION.'/assets/js/';

    $this->thumb_url  = JURI::root().$config->get('jg_paththumbs');
    $this->img_url    = JURI::root().$config->get('jg_pathimages');
    $this->orig_url   = JURI::root().$config->get('jg_pathoriginalimages');

    $this->thumb_path = JPath::clean(JPATH_ROOT.DS.$config->get('jg_paththumbs'));
    $this->img_path   = JPath::clean(JPATH_ROOT.DS.$config->get('jg_pathimages'));
    $this->orig_path  = JPath::clean(JPATH_ROOT.DS.$config->get('jg_pathoriginalimages'));

    $this->temp_path  = JPath::clean(JPATH_ROOT.DS.$config->get('jg_pathtemp'));
    $this->ftp_path   = JPath::clean(JPATH_ROOT.DS.$config->get('jg_pathftpupload'));
  }

  /**
   * Returns a reference to the global Ambit object, only creating it if it
   * doesn't already exist.
   *
   * This method must be invoked as:
   *    <pre>  $ambit = & JoomAmbit::getInstance();</pre>
   *
   * @access  public
   * @return  JoomAmbit The Ambit object.
   * @since   1.5.5
   */
  function &getInstance()
  {
    static $instance;

    if(!isset($instance))
    {
      $instance = new JoomAmbit();
    }

    return $instance;
  }

  /**
   * Returns the URL to an icon
   *
   * @access  public
   * @param   string  $icon The filename of the icon
   * @return  string  The URL to the icon
   * @since   1.5.5
   */
  function getIcon($icon)
  {
    return $this->get('icon_url').$icon;
  }

  /**
   * Returns the URL to a style sheet
   *
   * @access  public
   * @param   string  $stylesheet The filename of the style sheet
   * @return  string  The URL to the style sheet
   * @since   1.5.5
   */
  function getStyleSheet($stylesheet)
  {
    return $this->get('css_url').$stylesheet;
  }

  /**
   * Returns the URL to a script file
   *
   * @access  public
   * @param   string  $script The filename of the script file
   * @return  string  The URL to the script file
   * @since   1.5.5
   */
  function getScript($script)
  {
    return $this->get('js_url').$script;
  }

  /**
   * Returns the URL or the path to an image
   *
   * @access  public
   * @param   string            $type   The type of the URL or path
   * @param   string/object/int $img    Filename, database object or ID of the image
   * @param   int               $catid  The ID of the category in which the image is stored
   * @param   boolean           $route  True, if URLs should be parsed by the router
   * @param   int               $cropwidth  Width of cropped image if required
   * @param   int               $cropheight Height of cropped image if required
   * @param   int               $croppos    Offset position of cropping window
   * @return  string            The URL or the path to the image
   * @since   1.5.5
   */
  function getImg($type, $img, $id = null, $catid = 0, $route = true, $cropwidth = null, $cropheight = null, $croppos = null)
  {
    $types = array('thumb_path', 'thumb_url', 'img_path', 'img_url', 'orig_path', 'orig_url');
    if(!in_array($type, $types))
    {
      JError::raiseError(500, JText::sprintf('Wrong image type: %s', $type));
    }

    if(!is_object($img))
    {
      if(is_numeric($img))
      {
        $img = $this->getImgObject($img);
      }
      else
      {
        if(!is_null($id))
        {
          $img = $this->getImgObject($id);
        }
        else
        {
          // Try to find the image data with the help of its filename
          // No call when $cropwidth has no value
          // @TODO obsolete DB call when the custom image for category in DB
          // will be provided by image ID not by the image name
          if(!is_null($cropwidth))
          {
            $db = & JFactory::getDBO();
            $query = "SELECT
                        id,
                        catid,
                        imgfilename,
                        imgthumbname
                      FROM
                        "._JOOM_TABLE_IMAGES."
                      WHERE
                            imgfilename = '".$img."'
                        OR  imgthumbname = '".$img."'";
            $db->setQuery($query);
            if(!$img = $db->loadObject())
            {
              JError::raiseError(500, 'Unable to find requested image data');
            }
          }
        }
      }
    }

    if(is_object($img))
    {
      $id     = $img->id;
      $catid  = $img->catid;
      if($type == 'thumb_path' || $type == 'thumb_url')
      {
        $img = $img->imgthumbname;
      }
      else
      {
        $img = $img->imgfilename;
      }
    }

    // TODO: Enable possibility of images outside of the domain
    //       or protected with 'deny from all' per .htaccess,
    //       the following shows, how this could be possible
    if(   strpos($type, 'url')
      &&
        (    $this->_external
          || ($this->_config->get('jg_watermark') && strpos($type, 'thumb') === false)
          || strpos($type, 'img')   !== false
          || strpos($type, 'orig')  !== false
          || !is_null($cropwidth)
        )
      )
    {
      $type = str_replace('_url','', $type);
      $url  = 'index.php?view=image&format=raw&type='.$type.'&id='.$id;
      if(!is_null($cropwidth))
      {
        $url .= '&width='.$cropwidth.'&height='.$cropheight.'&pos='.$croppos;
      }

      if($route)
      {
        return JRoute::_($url);
      }

      return $url;
    }

    $catpath  = JoomHelper::getCatPath($catid);

    // Create the complete path
    $img      = $this->$type . $catpath . $img;

    if(strpos($type, 'path'))
    {
      $img = JPath::clean($img);
    }

    return $img;
  }

  /**
   * Returns the database row of a specific image
   *
   * @access  public
   * @param   int     $id The ID of the image to load
   * @return  object  The database row of the image
   * @since   1.5.5
   */
  function getImgObject($id)
  {
    static $images  = array();
    static $row;

    if(!isset($images[$id]))
    {
      if(!isset($row))
      {
        $row = & JTable::getInstance('joomgalleryimages', 'Table');
      }

      if(!$row->load($id))
      {
        JError::raiseError(500, JText::_('Image with ID %d not found', $id));
      }

      $properties = $row->getProperties();
      foreach($properties as $key => $value)
      {
        $images[$id]->$key = $value;
      }
    }

    return $images[$id];
  }

  /**
   * Translates a string into the current language and stores it in the JavaScript language store.
   * Will be replaced by JText::script() in Joomla 1.6
   *
   * @access  public
   * @param   string  $string The JText key.
   * @return  array   Array of stored strings
   * @since   1.5.5
   */
  function script($string = null)
  {
    static $strings;

    // Instante the array if necessary.
    if(!is_array($strings))
    {
      $strings = array();
    }

    // Add the string to the array if not null.
    if($string !== null)
    {
      // Normalize the key and translate the string.
      $strings[strtoupper($string)] = JText::_($string);
    }

    return $strings;
  }

  /**
   * Returns an Itemid of JoomGallery.
   *
   * At first, check if an Itemid was set in the configuration manager.
   * If yes, use this one. If not, we use the Itemid of a menu item associated
   * with the gallery.
   * To prevent malformed URLs e.g. for SEF, an empty string is returned if no valid
   * Itemid can be found in the database.
   *
   * @access  public
   * @param   boolean     True, if a string like '&Itemid=X' should be constructed.
   * @return  int/string  An Itemid of the gallery.
   * @since   1.0.0
   */
  function getItemid($string = true)
  {
    if(!isset($this->_Itemid) || is_null($this->_Itemid))
    {
      $Itemid = intval($this->_config->get('jg_itemid'));

      if($Itemid)
      {
        $this->_Itemid = $Itemid;
      }
      else
      {
        $db = & JFactory::getDBO();
        $db->setQuery(" SELECT
                          id
                        FROM
                          #__menu
                        WHERE
                              link LIKE '%"._JOOM_OPTION."&view=gallery%'
                          AND access = 0
                        ORDER BY
                          id DESC
                      ");
        $Itemid = $db->loadResult();

        if(!$Itemid)
        {
          $db->setQuery(" SELECT
                            id
                          FROM
                            #__menu
                          WHERE
                                link LIKE '%"._JOOM_OPTION."%'
                            AND access = 0
                          ORDER BY
                            id DESC
                        ");
          $Itemid = $db->loadResult();
        }

        if($Itemid = intval($Itemid))
        {
          $this->_Itemid = $Itemid;
        }
        else
        {
          $this->_Itemid = '';
        }
      }
    }

    return ($string && $this->_Itemid) ? '&Itemid='.$this->_Itemid : $this->_Itemid;
  }

  /**
   * Returns the category structure of the gallery
   *
   * @access  public
   * @return  array   An array of categories/sub-categories
   * @since   1.5.5
   */
  function getCategoryStructure()
  {
    // Check if already read from database
    if(is_null($this->_categorystructure))
    {
      // Creation of array
      $database = & JFactory::getDBO();
      $user     = & JFactory::getUser();

      // Read all categories from database
      $query = "SELECT
                  c.cid,
                  c.parent,
                  c.name
                FROM
                  "._JOOM_TABLE_CATEGORIES." AS c
                WHERE
                  c.published = 1";

      // If 'Display RM- and SM Categories' is set to yes, no restrictions
      // in access of query. So these categories are shown as text with RM or SM
      if(!$this->_config->get('jg_showrmsmcats'))
      {
        $query .="  AND c.access <= '".$user->get('aid')."'";
      }

      $query .="  ORDER BY c.parent";

      $database->setQuery($query);
      $categories = $database->loadObjectList();

      // Get picture count and hits count
      $query = "SELECT catid,
                       count(id) as piccount,
                       sum(hits) as hitcount
                FROM
                  "._JOOM_TABLE_IMAGES."
                WHERE
                  approved = 1 AND published = 1";

      $query .="  GROUP BY catid";

      $database->setQuery($query);
      $catcounts = $database->loadObjectList('catid');

      // Merge the arrays
      $endindex = count($categories);
      for ($i =0; $i < $endindex; $i++)
      {
        // Cast to int where needful
        $categories[$i]->cid    = (int) $categories[$i]->cid;
        $categories[$i]->parent = (int) $categories[$i]->parent;

        if (isset($catcounts[$categories[$i]->cid]))
        {
           $categories[$i]->piccount = (int) $catcounts[$categories[$i]->cid]->piccount;
           $categories[$i]->hitcount = (int) $catcounts[$categories[$i]->cid]->hitcount;
        }
        else
        {
           $categories[$i]->piccount = 0;
           $categories[$i]->hitcount = 0;
        }
      }
      $this->_categorystructure = Array();
      JoomHelper::sortCategoryList($categories, $this->_categorystructure);
    }

    return $this->_categorystructure;
  }

  /**
   * Returns the category structure of the gallery from cache
   *
   * @access  public
   * @return  array   An array of categories/sub-categories
   * @since   1.5.5
   */
//  function getCategoryStructureFromCache()
//  {
//    jimport('joomla.cache.cache');
//    jimport('joomla.cache.callback');
//
//    // TODO Parameter for set caching and caching lifetime
//    if(is_null($this->_categorystructure))
//    {
//      $cache = JCache::getInstance('callback', array
//        (
//          'defaultgroup'  => 'joomgallery',
//          'cachebase'     => JPATH_BASE . '/cache/',
//          'lifetime'      => 60,
//          'language'      => 'en-GB',
//          'storage'       => 'file'
//        )
//      );
//
//      // enabling caching
//      $cache->setCaching(true);
//
//      // Cache id must be unique to what you are caching
//      $cache_id = md5('joomgallery_CategoryStructure');
//
//      $this->_categorystructure = $cache->get(array($this, 'getCategoryStructureFromDB') , array(), $cache_id);
//    }
//
//    return $this->_categorystructure;
//  }
}