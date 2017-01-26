<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


/**
* @package Joomla
* @subpackage Config
*/
class TOOLBAR_webeeComment
{
	function _DEFAULT() {
		JToolBarHelper::title("Manage Comments", "webee");
		JToolBarHelper::publish();
		JToolBarHelper::unpublish();
		JToolBarHelper::deleteList();
		JToolBarHelper :: custom( 'editCSS', 'css.png', 'css.png', 'Edit CSS', false, false );
		JToolBarHelper :: custom( 'disable', 'default.png', 'default.png', 'Settings', false, false );
		JToolBarHelper::preferences('com_webeecomment', '350');
		JToolBarHelper :: custom( 'help', 'help.png', 'help.png', 'Support', false, false );
	}
	function _DISABLE() {
		JToolBarHelper::title("Settings", "webee");
		JToolBarHelper :: custom( 'back', 'cancel.png', 'cancel.png', 'Close', false, false );
	}
	function _CSS() {
		JToolBarHelper::title("Edit CSS", "webee");
		JToolBarHelper :: custom( 'saveCSS', 'save.png', 'save.png', 'Save', false, false );
		JToolBarHelper::apply();
		JToolBarHelper :: custom( 'back', 'cancel.png', 'cancel.png', 'Close', false, false );
	}
	function _ABOUT() {
		JToolBarHelper::title("About", "webee");
		JToolBarHelper :: custom( 'back', 'back.png', 'back.png', 'Back', false, false );
	}
	function _EDIT() {
		JToolBarHelper::title("Edit Comment", "webee");
		JToolBarHelper :: custom( 'saveComment', 'save.png', 'save.png', 'Save', false, false );
		JToolBarHelper::apply();
		JToolBarHelper :: custom( 'back', 'cancel.png', 'cancel.png', 'Close', false, false );
	}
}
?>
