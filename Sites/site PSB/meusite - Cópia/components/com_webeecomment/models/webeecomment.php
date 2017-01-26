<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

jimport( 'joomla.application.component.model' );

/**
 * @package Joomla
 * @subpackage Config
 */
class webeecommentComponentModel extends JModel
{	
	/** @var object JTable object */
	var $_table = '#__webeeComment_Comment';

	/**
	 * Returns the internal table object
	 * @return JTable
	 */
	function &getTable()
	{
		if ($this->_table == null) {
			$this->_table = JTable::getInstance('component', $this->getDBO() );
		}
		return $this->_table;
	}

	/**
	 * Get the params for the configuration variables
	 */
	function &getParams()
	{
		static $instance;

		if ($instance == null)
		{
			$table = &$this->getTable();
			$option = preg_replace( '#\W#', '', $table->option );

			// work out file path
			$path = JPATH_ADMINISTRATOR . '/components/' . $option . '/config.xml';
			if (file_exists( $path ))
			{
				$instance = new JParameter( $table->params, $path );
			}
			else
			{
				$instance = new JParameter( $table->params );
			}
		}
		return $instance;
	}
}
?>
