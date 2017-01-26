<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/elements/ordering.php $
// $Id: ordering.php 2566 2010-11-03 21:10:42Z mab $
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
 * Renders an ordering list element
 *
 * @package     JoomGallery
 * @subpackage  Parameter
 * @since       1.5.5
 */
class JElementOrdering extends JElement
{
  /**
   * Element name
   *
   * @access  protected
   * @var     string
   */
  var $_name = 'Ordering';

  function fetchElement($name, $value, &$node, $control_name)
  {
    $html = '
    <script language="javascript" type="text/javascript">
      <!--
      writeDynaList( \'class="inputbox" name="ordering" id="ordering" size="1"\', orders, originalParent, originalParent, originalOrder );
      //-->
    </script>
  ';
    return $html;
  }
}