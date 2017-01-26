<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/ambit.php $
// $Id: ambit.php 2566 2010-11-03 21:10:42Z mab $
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
  var $version    = '';
  var $_external  = false;

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
    $config     = & JoomConfig::getInstance();
    $mainframe  = & JFactory::getApplication('administrator');

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

    if(!$this->version = $mainframe->getUserState('joom.version.string'))
    {
      $this->version    = JoomExtensions::getGalleryVersion();
      $mainframe->setUserState('joom.version.string', $this->version);
    }
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
   * Returns the URL for a redirect
   *
   * @access  public
   * @param   string  $controller The controller used in the redirect url
   *                              if it is null, we will use the same
   *                              controller as in the current request,
   *                              if it is an empty string, we will redirect
   *                              to the control panel of the gallery
   * @param   int     $id         The ID of a category or image to redirect to
   *                              if the task was 'apply'
   * @param   string  $key        The parameter name to use in the URL for the ID
   * @return  string  The redirect URL
   * @since   1.5.5
   */
  function getRedirectUrl($controller = null, $id = null, $key = 'cid')
  {
    $url = 'index.php?option='._JOOM_OPTION;

    if(is_null($controller))
    {
      $url .= '&controller='.JRequest::getCmd('controller');
      if(!is_null($id) AND JRequest::getCmd('task') == 'apply')
      {
        $url .= '&task=edit&'.$key.'='.$id;
      }
    }
    else
    {
      if($controller)
      {
        $url .= '&controller='.$controller;
      }
    }

    return $url;
  }

  /**
   * Returns the URL or the path to an image
   *
   * @access  public
   * @param   string            $type   The type of the URL or path
   * @param   string/object/int $img    Filename, database object or ID of the image
   * @param   int               $catid  The ID of the category in which the image is stored
   * @return  string            The URL or the path to the image
   * @since   1.5.5
   */
  function getImg($type, $img, $id = 0, $catid = 0)
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

    // TODO: enable possibility of images outside of the domain
    //       or protected with 'deny from all' per .htaccess,
    //       the following shows, how this could be possible
    if(   strpos($type, 'url')
      &&
        (    $this->_external
          #|| $this->_config->get('jg_watermark')
          || strpos($type, 'img')   !== false
          || strpos($type, 'orig')  !== false
        )
      )
    {
      #$type = str_replace('_url','', $type);
      #return  JRoute::_('index.php?view=image&format=raw&type='.$type.'&id='.$id);
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
   * @return  array   An array of all stored strings
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
}