<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

jimport( 'joomla.application.component.view' );

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
		dump($this);
		// load the component's language file
		//DEVNOTE: load component language. Print language name on thr last line.
		//
		$lang =& JFactory::getLanguage();
		$lang->load('component');
		
		//DEVNOTE: set document title
		$document = & JFactory::getDocument();
		    
    //DEVNOTE: Print Comment and language name
		?><BR> <H1><?php	echo Comments;?></H1>
      <BR><BR><H3><?php echo $lang->getName(); ?></H3><?php 
  }
}
?>