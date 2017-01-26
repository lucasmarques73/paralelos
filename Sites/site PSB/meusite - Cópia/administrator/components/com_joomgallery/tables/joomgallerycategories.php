<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/tables/joomgallerycategories.php $
// $Id: joomgallerycategories.php 2566 2010-11-03 21:10:42Z mab $
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

/**
 * JoomGallery categories table class
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class TableJoomgalleryCategories extends JTable
{
  /** @var int Primary key */
  var $cid          = null;
  /** @var int */
  var $owner        = 0;
  /** @var string */
  var $name         = null;
  /** @var string */
  var $alias        = null;
  /** @var int */
  var $parent       = 0;
  /** @var string */
  var $description  = null;
  /** @var int */
  var $ordering     = 0;
  /** @var string */
  var $access       = 0;
  /** @var int */
  var $published    = 0;
  /** @var string */
  var $catimage     = null;
  /** @var int */
  var $img_position = null;
  /** @var string */
  var $catpath      = null;
  /** @var string */
  var $params       = null;
  /** @var string */
  var $metakey      = null;
  /** @var string */
  var $metadesc     = null;

  /**
  /* @param database A database connector object
  */
  function TableJoomgalleryCategories(&$db)
  {
    parent::__construct(_JOOM_TABLE_CATEGORIES, 'cid', $db);
  }

	/**
	 * Overloaded check function
	 *
	 * @access  public
	 * @return  boolean true on success
	 * @since   1.5.5
	 */
	function check()
	{
		/*
		TODO: This filter is too rigorous,need to implement more configurable solution
		// specific filters
		$filter = & JFilterInput::getInstance( null, null, 1, 1 );
		$this->introtext = trim( $filter->clean( $this->introtext ) );
		$this->fulltext =  trim( $filter->clean( $this->fulltext ) );
		*/

		if(empty($this->name))
    {
			$this->setError(JText::_('JG_COMMON_ERROR_CATEGORY_MUST_HAVE_TITLE'));
			return false;
		}

    JFilterOutput::objectHTMLSafe($this->name);

    // Trim slashes from catpath
    $this->catpath = trim($this->catpath, '/');

		if(empty($this->alias))
    {
      if(!empty($this->catpath))
      {
        $catpath  = explode('/', trim($this->catpath, '/'));
        $segments = array();
        foreach($catpath as $segment)
        {
          $segment    = str_replace('_', ' ', rtrim(rtrim($segment, '0123456789'), '_'));
          $segments[] = JFilterOutput::stringURLSafe($segment);
        }
        $this->alias = implode('/', $segments);
      }
		}

		if(trim(str_replace('-', '', $this->alias)) == '' && !empty($this->catpath))
    {
			$datenow      = & JFactory::getDate();
			$this->alias  = $datenow->toFormat('%Y-%m-%d-%H-%M-%S');
		}

		// clean up keywords -- eliminate extra spaces between phrases
		// and cr (\r) and lf (\n) characters from string
		if(!empty($this->metakey))
    {
      // array of characters to remove
			$bad_characters = array("\n", "\r", "\"", '<', '>');
      // remove bad characters
			$after_clean = JString::str_ireplace($bad_characters, '', $this->metakey);
      // create array using commas as delimiter
			$keys = explode(',', $after_clean);
			$clean_keys = array(); 
			foreach($keys as $key)
      {
        // ignore blank keywords
				if(trim($key))
        {  
					$clean_keys[] = trim($key);
				}
			}
      // put array back together delimited by ', '
			$this->metakey = implode(', ', $clean_keys);
		}
		
		// clean up description -- eliminate quotes and <> brackets
		if(!empty($this->metadesc))
    {
			$bad_characters = array("\"", '<', '>');
			$this->metadesc = JString::str_ireplace($bad_characters, '', $this->metadesc);
		}

		return true;
	}

  function reorderAll()
  {
    $query = 'SELECT DISTINCT parent
                FROM '.$this->_db->nameQuote($this->_tbl);
    $this->_db->setQuery($query);
    $parents = $this->_db->loadResultArray();

    foreach($parents as $parent)
    {
      $this->reorder('parent = '.$parent);
    }
  }

  /**
   * Returns the ordering value to place a new item first in its group
   *
   * @access  public
   * @param   string query WHERE clause for selecting MAX(ordering).
   * @return  int    the ordring number
   */
  function getPreviousOrder($where = '')
  {
    if(!in_array('ordering', array_keys($this->getProperties())))
    {
      $this->setError(get_class($this).' does not support ordering');
      return false;
    }

    $query = 'SELECT MIN(ordering)' .
        ' FROM ' . $this->_tbl .
        ($where ? ' WHERE '.$where : '');

    $this->_db->setQuery($query);
    $maxord = $this->_db->loadResult();

    if($this->_db->getErrorNum())
    {
      $this->setError($this->_db->getErrorMsg());
      return false;
    }

    return $maxord - 1;
  }
}
