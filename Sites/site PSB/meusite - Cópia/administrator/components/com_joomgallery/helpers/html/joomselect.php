<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/html/joomselect.php $
// $Id: joomselect.php 1904 2010-03-02 20:57:30Z mab $
/******************************************************************************\
**   JoomGallery  1.5 RC2                                                     **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                          **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Utility class for creating HTML Grids
 *
 * @static
 * @package JoomGallery
 * @since   1.5.5
 */
class JHTMLJoomSelect
{
  /**
   * Construct HTML list of all categories
   *
   * @TODO: Make use of select.genericlist
   *
   * @param int $cat catid
   * @param string $cname name of HTML select according to $_POST variable
   * @param string $extra HTML Code
   * @param int $orig catid - filled if category shall be excluded
   * @return string HTML Code
   */
  function categoryList($cat, $cname = 'catid', $extra = null, $orig=null)
  {
    $database = & JFactory::getDBO();
  
    //get all categories from DB in array of objects and mark them all to 'not ready'
    $query = "SELECT cid, parent,name,'0' as ready
              FROM #__joomgallery_catg";
    $database->setQuery($query);
    $rows = $database->loadObjectList('cid');
  
    //if 'parent' set array of categories with parent = actual category
    //to ignore them
    if ($cname=='parent' && $orig != null) {
      $ignore=array();
    }
  
    //Head of HTML code
    $output = "<select name=\"$cname\" class=\"inputbox\" $extra >\n";
    $output .= "  <option value=\"0\"></option>\n";
  
    //no categories found, close the HTML and return
    if (count($rows)==0){
      $output .= "</select>\n";
      return $output;
    }
  
    //Loop through array of objects and construct the path
    foreach ($rows as $key => $obj) {
      $parent=$obj->parent;
      if ($cname=='parent' && $orig != null) {
        if ($parent==$orig || in_array($parent,$ignore)) {
          //act. category found, add them to ignore array
          if (!in_array($key,$ignore)) {
            $ignore[]=$key;
            continue;
          }
        }else{
          //check if in parent path way up there is the cat=$orig
          //then exclude all involved cats
          $parentcat=null;
          $parentcats=array();
          $parentcat=$rows[$key]->parent;
          while ($parentcat!=0 && $parentcat!=$orig){
            $parentcat=$rows[$parentcat]->parent;
            $parentcats[]=$parentcat;
          }
          if (!empty($parentcats) && in_array($orig,$parentcats)) {
            //if found add the collected cats to ignore array
            $ignore[]=$key;
            $ignore=array_merge($ignore,$parentcats);
            //free array of parentcats
            $parentcats=array();
            continue;
          }
        }
      }
  
      //if root category go to next element
      if ($parent != 0){
        //if path of parent already constructed, take them directly
        if ($rows[$parent]->ready){
          $rows[$key]->name = $rows[$parent]->name . ' &raquo; ' . $rows[$key]->name;
        } else {
          while ($parent!=0){
            $rows[$key]->name = $rows[$parent]->name . ' &raquo; ' . $rows[$key]->name;
  
            //if path of actual parent already constructed, break the while
            //othwerwise continue with next parent
            if ($rows[$parent]->ready){
              break;
            }else{
              $parent=$rows[$parent]->parent;
            }
          }
        }
      }
      //path completed, mark them as ready
      $rows[$key]->ready="1";
    }
  
    //remove from array the cats collected in ignore array
    if ($cname=='parent' && $orig != null) {
      foreach ($ignore as $catignore)
      {
        unset ($rows[$catignore]);
      }
    }
  
    //sort the array by pathname
    usort($rows, array('JHTMLJoomSelect', 'sortCatArray'));
  
    //construct the HTML for each cat
    foreach ($rows as $key => $obj) {
      //category must not be parent to itself
      if($cname != 'parent' || ($cname == 'parent' && $obj->cid != $orig)){
        $output .="<option value=\"".$obj->cid."\"";
        if($cat==$obj->cid) {
          $output .= " selected=\"selected\"";
        }
        $output .=">".$obj->name."</option>\n";
      }
    }
    $output .= "</select>\n";

    return $output;
  }

  /**
   * Construct HTML list of allowed categories in backend
   *
   * @param int $cat
   * @param string $cname
   * @param string $extras
   * @return string
   */
  function allowedCategoryList($selected, $name = 'jg_category[]', $extras = '')
  {
    static $items;

    if(!isset($items))
    {
      $db = & JFactory::getDBO();

      // Get all categories created in backend
      $db->setQuery(" SELECT
                        cid,
                        parent,
                        name
                      FROM
                        "._JOOM_TABLE_CATEGORIES."
                      WHERE
                        owner = 0
                      ORDER BY
                        name
                    ");

      $items = $db->loadObjectList();

      // Establish the hierarchy of the menu
      $children = array();
      // First pass - collect children
      foreach($items as $v)
      {
        $pt = $v->parent;
        $list = isset($children[$pt]) ? $children[$pt] : array();
        array_push($list, $v);
        $children[$pt] = $list;
      }

      // Second pass - get an indent list of the items
      $list = JHTML::_('joomgallery.cattreerecurse', 0, '', array(), $children);

      // Assemble menu items to the array
      $items   = array();
      $items[] = JHTML::_('select.option','', ' ');
      foreach ($list as $item)
      {
        $items[] = JHTML::_('select.option', $item->cid, $item->treename);
      }

      asort($items);
    }

    // Build the html select list
    return  JHTML::_('select.genericlist', $items, $name,
                     'class="inputbox" multiple="multiple" size="6" '.$extras,
                     'value', 'text', $selected);
  }

  /**
   * Construct HTML list of users
   *
   * @access  public
   * @param   string  $name       name of the HTML select list to use
   * @param   array   $active     array of selected users
   * @param   boolean $nouser     true, if 'No user' should be included on top of the list
   * @param   string  $javascript additional code in the select list
   * @param   string  $order      column to order by
   * @param   boolean $reg        true, if registered users should be ignored
   * @return  string  the HTML output
   */
  function users($active, $name, $nouser = false, $javascript = null, $order = 'name', $reg = false)
  {
    $db = & JFactory::getDBO();

    $and = '';
    if($reg)
    {
    // does not include registered users in the list
      $and = ' AND gid > 18';
    }

    $query = 'SELECT
                id AS value,
                name AS text
              FROM
                #__users
              WHERE
                      block = 0
                '.$and.'
              ORDER BY
                '.$order;
    $db->setQuery($query);
    if($nouser)
    {
      $users[] = JHTML::_('select.option',  '0', '- '. JText::_( 'No User' ) .' -' );
      $users = array_merge($users, $db->loadObjectList());
    }
    else
    {
      $users = $db->loadObjectList();
    }

    return JHTML::_('select.genericlist', $users, $name, 'class="inputbox" multiple="multiple" size="6" '. $javascript, 'value', 'text', $active);
  }

  /**
   * Callback function for sorting an array of objects to assembled names of
   * categories with alle parent categories
   * @see categoryList()
   *
   * @param object $a
   * @param object $b
   * @return 0 if names equal, -1 if a < b, 1 if a > b
   */
  function sortCatArray($a,$b)
  {
    return strcmp($a->name, $b->name);
  }
}