<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/tables/joomgalleryimages.php $
// $Id: joomgalleryimages.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery images table class
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class TableJoomgalleryImages extends JTable
{
  /** @var int Primary key */
  var $id           = null;
  /** @var int */
  var $catid        = null;
  /** @var string */
  var $imgtitle     = null;
  /** @var string */
  var $alias        = null;
  /** @var string */
  var $imgauthor    = null;
  /** @var string */
  var $imgtext      = null;
  /** @var string */
  var $imgdate      = null;
  /** @var int */
  var $hits         = 0;
  /** @var int */
  var $imgvotes     = null;
  /** @var int */
  var $imgvotesum   = null;
  /** @var int */
  var $published    = null;
  /** @var string */
  var $imgfilename  = null;
  /** @var string */
  var $imgthumbname = null;
  /** @var string */
  var $checked_out  = null;
  /** @var string */
  var $owner        = 0;
  /** @var int */
  var $approved     = null;
  /** @var int */
  var $access       = null;
  /** @var int */
  var $useruploaded = null;
  /** @var int */
  var $ordering     = null;
  /** @var string */
  var $params       = null;
  /** @var string */
  var $metakey      = null;
  /** @var string */
  var $metadesc     = null;
  
  function TableJoomgalleryImages(&$db)
  {
    parent::__construct(_JOOM_TABLE_IMAGES, 'id', $db);
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

    if(empty($this->imgtitle))
    {
      $this->setError(JText::_('JG_COMMON_ERROR_IMAGE_MUST_HAVE_TITLE'));
      return false;
    }

    if(empty($this->catid))
    {
      $this->setError(JText::_('JG_COMMON_ERROR_NO_CATEGORY_SELECTED'));
      return false;
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

    if(empty($this->alias))
    {
      // TODO: We are NOT allowed to store the row at this point,
      // so we have to find another way to get the correct ID of the new image
      // (or we add the ID after storing, for this we would have to override the JTable store method).
      if(!$this->store())
      {
        return false;
      }
      $this->alias = $this->imgtitle.'-'.$this->id;
    }
    $this->alias = JFilterOutput::stringURLSafe($this->alias);

    if(trim(str_replace('-', '', $this->alias)) == '')
    {
      $datenow      = & JFactory::getDate();
      $this->alias  = $datenow->toFormat('%Y-%m-%d-%H-%M-%S');
    }

    return true;
  }

  function reorderAll()
  {
    $query = 'SELECT DISTINCT catid
                FROM '.$this->_db->nameQuote($this->_tbl);
    $this->_db->setQuery($query);
    $catids = $this->_db->loadResultArray();

    foreach($catids as $catid)
    {
      $this->reorder('catid = '.$catid);
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
