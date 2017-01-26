<?php

/*
 * @version		$Id: view.html.php 1.2.1 2012-05-03 $
 * @package		Joomla
 * @copyright   Copyright (C) 2012-2013 MrVinoth
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport( 'joomla.application.component.view');

class AllVideoShareViewDashboard extends JView {

    function display($tpl = null) {
	    $model = $this->getModel();
		
		$server = $model->getserver();
		$this->assignRef('server', $server);
		
		$recentvideos = $model->getrecentvideos();
		$this->assignRef('recentvideos', $recentvideos);
		
		$recentcategories = $model->getrecentcategories();
		$this->assignRef('recentcategories', $recentcategories);
		
		$popularvideos = $model->getpopularvideos();
		$this->assignRef('popularvideos', $popularvideos);
		
		JToolBarHelper::title(JText::_('ALL_VIDEO_SHARE'), 'allvideoshare');		
		$help = & JToolBar::getInstance('toolbar');
		$help->appendButton( 'Popup', 'help', 'help', 'http://allvideoshare.mrvinoth.com', 900, 500 );
		
		JSubMenuHelper::addEntry(JText::_('DASHBOARD'), 'index.php?option=com_allvideoshare', true);	
		JSubMenuHelper::addEntry(JText::_('PLAYERS'), 'index.php?option=com_allvideoshare&view=players');	
		JSubMenuHelper::addEntry(JText::_('CATEGORIES'), 'index.php?option=com_allvideoshare&view=categories');		
		JSubMenuHelper::addEntry(JText::_('VIDEOS'), 'index.php?option=com_allvideoshare&view=videos');
		JSubMenuHelper::addEntry(JText::_('APPROVAL_QUEUE'), 'index.php?option=com_allvideoshare&view=approval');
		JSubMenuHelper::addEntry(JText::_('GENERAL_CONFIGURATION'), 'index.php?option=com_allvideoshare&view=config');
		JSubMenuHelper::addEntry(JText::_('LICENSING'), 'index.php?option=com_allvideoshare&view=licensing');
		
        parent::display($tpl);
    }
	
}

?>