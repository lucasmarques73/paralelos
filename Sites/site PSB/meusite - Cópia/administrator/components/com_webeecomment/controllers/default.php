<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

jimport( 'joomla.application.component.controller' );

/**
 * Note: this view is intended only to be opened in a popup
 * @package Joomla
 * @subpackage Config
 */
class webeeCommentController_ extends JController
{

	/**
	 * Custom Constructor
	 */
	//DEVNOTE: register task - Register (map) a task to a method in the class
	//function registerTask( $task, $method )
	function __construct( $default = array())
	{
		parent::__construct( $default );
	}


	/**
	 * Cancel operation
	 */
	function cancel()
	{
		$this->setRedirect( 'index.php' );
	}
	
	function display() 
  {
  	//echo $this->_task;
  	//dump($this);
  	global $mainframe;
  	//dump($mainframe);
  	$task = $this->_task; 
  	$page = JRequest::getVar('page', 1);
  	$pagesize = JRequest::getVar('pagesize', 20);
  	$orderfield = JRequest::getVar('field', "");
  	$filter = JRequest::getVar('filter', "");
  	switch ($this->_task)
  	{
  		case "administer":
  	   		$target = "admin";
  	   		break;
		case "admin":
  	   		$target = "admin";
  	   		break;
  		case "remove":
  			$target = "remove";
  			break;
  		case "publish":
  			$target = "publish";
  			break;
  		case "unpublish":
  			$target = "unpublish";
  			break;
  		case "disable":
  			$target = "disable";
  			break;
  		case "returnCategories":
  			$target = "returnCategories";
  			break;
  		case "returnArticles":
  			$target = "returnArticles";
  			break;
  		case "saveDisables":
  			$target = "saveDisables";
  			break;
  		case "checkDisable":
  			$target = "checkDisable";
  			break;
  		case "CSS":
  			$target = "CSS";
  			break;
  		case "saveCSS":
  			$target = "saveCSS";
  			break;
		case "saveComment":
  			$target = "saveComment";
  			break;
  		case "about":
  			$target = "about";
  			break;
		case "edit":
  			$target = "edit";
  			break;
  	   	default:
  	   		$target = "admin";
  	   		break;
  	}
  	
  	$model = &JModel::getInstance( 'webeecommentComponentModel' );
	$table = &$model->getTable();
	   	
	   $view = new DefaultComponentView( );
	   $view->setModel( $model, true );
	   $view->display($target, $page, $pagesize, $orderfield, $filter);
  } 
}
?>
