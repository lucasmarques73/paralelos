<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/joomgallery.php $
// $Id: joomgallery.php 1930 2010-03-06 12:25:59Z mab $
/****************************************************************************************\
**   JoomGallery  1.5                                                                   **
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
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'includes'.DS.'defines.php');

// Enable JoomGallery plugins
JPluginHelper::importPlugin('joomgallery');

// Register some classes
JLoader::register('JoomGalleryModel', JPATH_COMPONENT.DS.'model.php');
JLoader::register('JoomGalleryView',  JPATH_COMPONENT.DS.'view.php');
JLoader::register('JoomHelper',       JPATH_COMPONENT.DS.'helpers'.DS.'helper.php');
JLoader::register('JoomConfig',       JPATH_COMPONENT.DS.'helpers'.DS.'config.php');
JLoader::register('JoomAmbit',        JPATH_COMPONENT.DS.'helpers'.DS.'ambit.php');
JLoader::register('JoomFile',         JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'file.php');
JTable::addIncludePath(               JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

// Create the controller
$controller = new JoomGalleryController();

// Perform the request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();