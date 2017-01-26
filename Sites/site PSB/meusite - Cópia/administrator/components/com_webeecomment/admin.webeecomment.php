<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_COMPONENT.DS.'controllers'.DS.'default.php');
require_once( JPATH_COMPONENT.DS.'models'.DS.'webeecomment.php' );
require_once (JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'view.php');

// Create the controller
$classname  = 'webeecommentController_'.$controller;
//echo $classname;
//echo JRequest::getVar('task' );

//exit;
$controller = new $classname( array('default_task' => 'display') );
//$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getVar('task' ));

// Redirect if set by the controller
$controller->redirect();

 
?>
