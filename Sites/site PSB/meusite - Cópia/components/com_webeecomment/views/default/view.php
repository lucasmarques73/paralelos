<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

jimport( 'joomla.application.component.view' );
jimport( 'joomla.html.editor');
/**
 * @package Joomla
 * @subpackage Config
 */
class DefaultComponentView extends JView
{
	/**
	 * Display the view
	 */
	function display($Text)
	{
			// The display logic that is in the controller should be here.  Will fix in future version.
			echo $Text;
  }
}
?>