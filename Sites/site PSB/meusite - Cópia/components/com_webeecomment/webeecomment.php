<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_COMPONENT.DS.'controllers'.DS.'default.php');
require_once( JPATH_COMPONENT.DS.'models'.DS.'webeecomment.php' );
require_once (JPATH_COMPONENT.DS.'views'.DS.'default'.DS.'view.php');

// Create the controller
$classname  = 'webeecommentController_'.$controller;
$articleId = JRequest::getVar('articleId');
$controller = new $classname( array('default_task' => 'display') );

// Perform the Request task
$controller->execute( JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();

// This function is part of the ongoing process to successfully handle UTF code.
function utf8Urldecode($value)
{
    if (is_array($value)) {
        foreach ($value as $key => $val) {
            $value[$key] = utf8Urldecode($val);
        }
    } else {
        $value = preg_replace('/%([0-9a-f]{2})/ie', 'chr(hexdec($1))', (string) $value);
    }

    return $value;
}



?>
