<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/admin.joomgallery.php $
// $Id: admin.joomgallery.php 2566 2010-11-03 21:10:42Z mab $
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

// Require the base controller and the defines
require_once(JPATH_COMPONENT.DS.'controller.php');
require_once(JPATH_COMPONENT.DS.'includes'.DS.'defines.php');

// Require specific controller if requested
if($controller = JRequest::getCmd('controller', 'control'))
{
  $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
  if(file_exists($path))
  {
    require_once $path;
  }
  else
  {
    $controller = '';
  }
}

// Register some classes
JLoader::register('JoomGalleryModel', JPATH_COMPONENT.DS.'model.php');
JLoader::register('JoomGalleryView',  JPATH_COMPONENT.DS.'view.php');
JLoader::register('JoomExtensions',   JPATH_COMPONENT.DS.'helpers'.DS.'extensions.php');
JLoader::register('JoomHelper',       JPATH_COMPONENT.DS.'helpers'.DS.'helper.php');
JLoader::register('JoomConfig',       JPATH_COMPONENT.DS.'helpers'.DS.'config.php');
JLoader::register('JoomAmbit',        JPATH_COMPONENT.DS.'helpers'.DS.'ambit.php');
JLoader::register('JoomFile',         JPATH_COMPONENT.DS.'helpers'.DS.'file.php');
JTable::addIncludePath(               JPATH_COMPONENT.DS.'tables');

// Create the controller
$classname	= 'JoomGalleryController'.$controller;
$controller = new $classname();

// Perform the request task
$controller->execute(JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();