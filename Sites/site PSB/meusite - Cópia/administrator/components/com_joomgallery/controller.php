<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/controller.php $
// $Id: controller.php 2566 2010-11-03 21:10:42Z mab $
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

jimport('joomla.application.component.controller');

/**
 * JoomGallery Component Controller
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryController extends JController
{
  /**
   * JApplication object
   *
   * @access  protected
   * @var     object
   */
  #var $_mainframe;

  /**
   * JoomConfig object
   *
   * @access  protected
   * @var     object
   */
  var $_config;

  /**
   * JoomAmbit object
   *
   * @access  protected
   * @var     object
   */
  var $_ambit;

  /**
   * JUser object, holds the current user data
   *
   * @access  protected
   * @var     object
   */
  #var $_user;

  /**
   * JDatabase object
   *
   * @access  protected
   * @var     object
   */
  var $_db;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function __construct($config = array())
  {
		parent::__construct($config);

    $this->_ambit     = & JoomAmbit::getInstance();
    $this->_config    = & JoomConfig::getInstance();

    /*$this->_mainframe = & JFactory::getApplication('site');
    $this->_user      = & JFactory::getUser();*/
    $this->_db        = & JFactory::getDBO();

    // Uncomment following line to disable update check
    // $this->_config->set('jg_checkupdate', 0);
	}

  /**
   * Use javascript translation framework of Joomla 1.6 right now.
   * Once we are in Joomla 1.6 replace all $this->_ambit->script() appearences
   * with JText::script() and remove the following code (and the one in joomgallery.js).
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function display()
  {
    parent::display();

    if(count($this->_ambit->script()))
    {
      $strings      = $this->_ambit->script();
      $enc_strings  = array();
      foreach($strings as $key => $value)
      {
        $enc_strings[] = '"'.$key.'":"'.$value.'"';
      }
      $string = '{'.implode(',', $enc_strings).'}';

      $tab      = '  ';
      $lnEnd    = "\n";
      $strHtml  = $tab.$tab.'var JText = (function() {'.$lnEnd;
      $strHtml .= $tab.$tab.$tab.'var strings = '.$string.';'.$lnEnd;
      $strHtml .= $tab.$tab.$tab.'return (typeof JText == \'undefined\' ? strings : JText.load(strings));'.$lnEnd;
      $strHtml .= $tab.$tab.'})();'.$lnEnd;

      $doc      = & JFactory::getDocument();
      $doc->addScriptDeclaration($strHtml);
    }
  }
}