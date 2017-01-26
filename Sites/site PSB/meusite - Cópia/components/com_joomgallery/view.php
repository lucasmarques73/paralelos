<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/view.php $
// $Id: view.php 2566 2010-11-03 21:10:42Z mab $
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

jimport( 'joomla.application.component.view');

/**
 * Parent HTML View Class for JoomGallery
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryView extends JView
{
  /**
   * JApplication object
   *
   * @access  protected
   * @var     object
   */
  var $_mainframe;

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
  var $_user;

  /**
   * JDocument object
   *
   * @access  protected
   * @var     object
   */
  var $_doc;

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

    $this->_mainframe = & JFactory::getApplication('site');
    $this->_user      = & JFactory::getUser();
    $this->_doc       = & JFactory::getDocument();

    JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');

    // If we are just displaying an image we don't need anything else
    if(JRequest::getCmd('format') == 'raw' || JRequest::getCmd('format') == 'feed')
    {
      return;
    }

    // Add the CSS file generated from backend settings
    $this->_doc->addStyleSheet($this->_ambit->getStyleSheet('joom_settings.css'));

    // Add the main CSS file
    $this->_doc->addStyleSheet($this->_ambit->getStyleSheet('joomgallery.css'));

    // Add invidual CSS file if it exists
    if(file_exists(JPATH_COMPONENT.DS.'assets'.DS.'css'.DS.'joom_local.css'))
    {
      $this->_doc->addStyleSheet($this->_ambit->getStyleSheet('joom_local.css'));
    }

    $pngbehaviour = "  <!-- Do not edit IE conditional style below -->"
                  . "\n"
                  ."  <!--[if lte IE 6]>"
                  . "\n"
                  . "  <style type=\"text/css\">\n"
                  . "    .pngfile {\n"
                  . "      behavior:url('".JURI::root()."components/com_joomgallery/assets/js/pngbehavior.htc') !important;\n"
                  . "    }\n"
                  . "  </style>\n"
                  . "  <![endif]-->"
                  . "\n"
                  . "  <!-- End Conditional Style -->";
    $this->_doc->addCustomTag($pngbehaviour);
	}

  /**
   * Returns all found modules published at the given position
   *
   * @access  public
   * @param   string  The name of the module position to load
   * @return  string  The HTML output of the modules for displaying them
   * @since   1.5.5
   */
  function loadModules($pos)
  {
    $html = '';

    $modules = JoomHelper::getRenderedModules($pos);
    if(count($modules))
    {
      ob_start();
      foreach($modules as $module): ?>
  <div class="jg_module">
<?php   if($module->showtitle): ?>
    <div class="sectiontableheader">
      <h4>
        <?php echo $module->title; ?>&nbsp;
      </h4>
    </div>
<?php   endif;
        echo $module->rendered; ?>
  </div>
<?php endforeach;
      $html = ob_get_contents();
      ob_end_clean();
    }

    return $html;
  }
}