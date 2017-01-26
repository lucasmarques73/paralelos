<?php
// "VCNT for Joomla 1.5"
// Author: Viktor Vogel
// URL: http://www.kubik-rubik.de
// version 1.5-1 (for more details see http://www.kubik-rubik.de/joomla-hilfe/modul-vcnt-visitorcounter-joomla-1.5)
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

	$today			=	@$params->get('today')			?	@$params->get('today')			:	'Today';
	$yesterday		=	@$params->get('yesterday')		?	@$params->get('yesterday')		:	'Yesterday';
	$all			=	@$params->get('all')			?	@$params->get('all')			:	'All';
	$locktime		=	@$params->get('locktime')		?	@$params->get('locktime')		:	'60';
	$preset			=	@$params->get('preset')			?	@$params->get('preset')			:	'0';
	$x_month		=	@$params->get('month')			?	@$params->get('month')			:	'Month';
	$x_week			=	@$params->get('week')			?	@$params->get('week')			:	'Week';	
	$s_today		=	@$params->get('s_today');
	$s_yesterday	=	@$params->get('s_yesterday');
	$s_all			=	@$params->get('s_all');
	$s_week			=	@$params->get('s_week');
	$s_month		=	@$params->get('s_month');
	$s_clean		=	@$params->get('s_clean');
	$copy 			= 	@$params->def( 'copy', 1 );
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$path = JModuleHelper::getLayoutPath('mod_vcnt', 'default');
if (file_exists($path)) {
	require($path);
}