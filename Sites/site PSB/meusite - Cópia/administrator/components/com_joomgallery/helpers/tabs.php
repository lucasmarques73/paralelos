<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/tabs.php $
// $Id: tabs.php 2566 2010-11-03 21:10:42Z mab $
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
 * Tab Creation Handler Class
 *
 * This class was taken from Joomla's Core and has been modified by including
 * the function startNestedTab, which was taken from
 * http://www.perfectdesigning.net/development_projects/support/joomla!_tab_system.html
 *
 * @package JoomGallery
 * @since   1.0.0
 */
class JoomTabs
{
  /**
   * Defines if cookies shall be used
   *
   * @access  public
   * @var     int
   */
  var $useCookies = 1;

  /**
   * Constructor
   * Includes files needed for displaying tabs and sets cookie options.
   *
   * @access  protected
   * @param   int $useCookies If set to 1 cookie will hold last used tab between page refreshes
   * @return  void
   * @since   1.0.0
   */
  function JoomTabs($useCookies = 1)
  {
    $doc = & JFactory::getDocument();

    $doc->addStyleSheet(_JOOM_LIVE_SITE.'includes/js/tabs/tabpane.css', 'text/css', 'all');
    $doc->addScript(_JOOM_LIVE_SITE.'includes/js/tabs/tabpane_mini.js');

    $css_style  = "    .dynamic-tab-pane-control .tab-row .tab {\n";
    $css_style .= "      width: auto;\n";
    $css_style .= "      padding: 5px 5px 2px 5px;\n";
    $css_style .= "      background: #E7E7E7;\n";
    $css_style .= "      border:1px solid #949a9c\n    }\n\n";
    $css_style .= "    .dynamic-tab-pane-control .tab-row .tab.selected {\n";
    $css_style .= "      width: auto !important;\n";
    $css_style .= "      background: #fff !important;\n";
    $css_style .= "      border-top-color:#949a9c;\n";
    $css_style .= "      border-top-width:1px;\n";
    $css_style .= "      border-top-style:solid;\n";
    $css_style .= "      border-left-color:#949a9c;\n";
    $css_style .= "      border-left-width:1px;\n";
    $css_style .= "      border-left-style:solid;\n";
    $css_style .= "      border-right-color:#949a9c;\n";
    $css_style .= "      border-right-width:1px;\n";
    $css_style .= "      border-right-style:solid;\n";
    $css_style .= "      border-bottom-color: #fff;\n";
    $css_style .= "      border-bottom-width:1px;\n";
    $css_style .= "      border-bottom-style:solid;\n";
    $css_style .= "      padding: 3px 2px 2px 5px;\n";
    $css_style .= "      margin: 1px 0px 1px 3px;\n";
    $css_style .= "      top: 0px;\n";
    $css_style .= "      height: 17px;\n    }\n\n";
    $css_style .= "    .dynamic-tab-pane-control .tab-row .tab.hover {\n";
    $css_style .= "      width: auto;\n";
    $css_style .= "      background: #fff;\n    }\n";
    $doc->addStyleDeclaration($css_style);

    $this->useCookies = $useCookies;
  }

  /**
   * Creates a tab pane and creates JS obj
   *
   * @access  public
   * @param   string  The Tab Pane name
   * @return  void
   * @since   1.0.0
   */
  function startPane($id)
  {
?>
  <div class="tab-page" id="<?php echo $id; ?>">
    <script type="text/javascript">
      var tabPane1 = new WebFXTabPane(document.getElementById('<?php echo $id; ?>'), <?php echo $this->useCookies; ?>);
    </script>
<?php
  }

  /**
   * Ends Tab Pane
   *
   * @access  public
   * @return  void
   * @since   1.0.0
   */
  function endPane()
  {
?>
  </div>
<?php
  }

  /**
   * Creates a tab with title text and starts that tabs page
   *
   * @access  public
   * @param   string  $tabText  This is what is displayed on the tab
   * @param   string  $paneid   This is the parent pane to build this tab on
   * @return  void
   * @since   1.0.0
   */
  function startTab($tabText, $paneid)
  {
?>
      <div class="tab-page" id="<?php echo $paneid; ?>">
        <h2 class="tab"><?php echo $tabText; ?></h2>
        <script type="text/javascript">
          tabPane1.addTabPage(document.getElementById('<?php echo $paneid; ?>'));
        </script>
<?php
  }

  /**
   * Ends a tab page
   *
   * @access  public
   * @return  void
   * @since   1.0.0
   */
  function endTab()
  {
?>
    </div>
<?php
  }

  /**
   * Creates a nsted tab with title text and starts that tabs page
   *
   * @access  public
   * @param   string  $tabText  This is what is displayed on the tab
   * @return  void
   * @since   1.0.0
   */
  function startNestedTab($tabText)
  {
?>
    <div class="tab-page">
      <h2 class="tab"><?php echo $tabText; ?></h2>
<?php
  }
}