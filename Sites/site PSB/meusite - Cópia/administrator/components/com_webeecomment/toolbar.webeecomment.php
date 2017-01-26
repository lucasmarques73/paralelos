<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// DEVNOTE: Pull in the class that will be used to actually display our toolbar.
require_once( JApplicationHelper::getPath( 'toolbar_html' ) );


switch ($task) 
{
	default:
		TOOLBAR_webeeComment::_DEFAULT();
		break;
	case "disable":
		TOOLBAR_webeeComment::_DISABLE();
		break;
	case "CSS":
		TOOLBAR_webeeComment::_CSS();
		break;
	case "about":
		TOOLBAR_webeeComment::_ABOUT();
		break;
	case "edit":
		TOOLBAR_webeeComment::_EDIT();
		break;
}
?>