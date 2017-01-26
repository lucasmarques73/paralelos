<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/helpers/html/joomselect.php $
// $Id: joomselect.php 2333 2010-08-29 14:59:21Z chraneco $
/******************************************************************************\
**   JoomGallery  1.5                                                         **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                          **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Utility class for creating HTML select lists
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
   * @access  public
   * @param   int     $cat    The category ID
   * @param   string  $cname  The name of HTML select according to $_POST variable
   * @param   string  $extra  HTML Code
   * @param   int     $orig   catid - filled if category shall be excluded
   * @return  string  The HTML output
   */
  function categoryList($cat, $cname = 'catid', $extra = null, $orig = null)
  {
    $database = & JFactory::getDBO();
  
    //get all categories from DB in array of objects and mark them all to 'not ready'
    $query = "SELECT cid, parent,name,'0' as ready
              FROM #__joomgallery_catg";
    $database->setQuery($query);
    $rows = $database->loadObjectList("cid");
  
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
      foreach ($ignore as $catignore){
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
   * Aufbau HTML Auswahlliste der vom User angelegten Kategorien
   * und der fuer den Upload freigegebenen Katgeorien
   *
   * @TODO: Make use of select.genericlist
   *
   * @access  public
   * @param   int     $cid      catid akt cat oder parent
   * @param   int     $ignoreme cid, ignore the sub categories of this category
   * @param   string  $cname    Name of the HTML elemt
   * @param   boolean $upload   True if we are creating the list for the categories in which users may upload images
   * @return  string  The HTML output
   */
  function userCategoryList($cid, $ignoreme = null, $cname = 'catid', $upload = false)
  {
    $config   = & JoomConfig::getInstance();
    $database = & JFactory::getDBO();
    $user     = & JFactory::getUser();

    //im Backend fuer den Userupload freigegebene Kategorien
    if($upload)
    {
      if(!empty($config->jg_category))
      {
        $allowedcats = $config->jg_category;
      } 
    }
    else
    {
      //im Backend fuer die Anlage von Userkategorien freigegebene Kategorien    
      if(!empty($config->jg_usercategory))
      {
        $allowedcats = $config->jg_usercategory;
      }
      else
      {
        $allowedcats = '';
      }
    }

    $query = "  SELECT 
                  cid, 
                  parent, 
                  name ,
                  '0' AS ready
                FROM 
                  "._JOOM_TABLE_CATEGORIES;

    if ($upload && !$config->jg_userowncatsupload)
    {
      $query .= " WHERE owner != 0";
    }
    else
    {
      $query .= " WHERE owner = ".$user->get('id');
    }

    if(!empty($allowedcats))
    {
       $query .= ' OR cid IN ('.$allowedcats.')';
    }

    $query .= ' OR cid = '.$cid;
  
    $database->setQuery($query);
    $rows = $database->loadObjectList('cid');

    $countrows = count($rows);

    if($countrows == 0)
    {
      return null;
    }

    $output = "<select name=\"".$cname."\" class=\"inputbox\">\n";

    //wenn cname = parent und ignoreme != null, dann die Cats loeschen, die direkt
    //oder indirekt child der cat=ignoreme sind, 
    //$cid = Cat des Parent, $ignoreme=akt. Cat
    //nur bei Edit Cat
    if($cname == 'parent' && $ignoreme != null)
    {
      $ignorearr   = array();//zu ignorierende cats
      $ignorearr[] = $ignoreme;//akt. Cat aufnehmen
      $backendcats = explode(',', $allowedcats);
      foreach($rows as $key => $obj)
      {
        //wenn Backendcat -> ueberspringen
        //ebenso die aktuelle Cat
        if(in_array($key, $backendcats) || $key == $ignoreme)
        {
          continue;
        }
        $found  = false;
        $parent = $obj->parent;
        while(array_key_exists($parent, $rows) && !in_array($key, $ignorearr) && !$found)
        {
          $ignore[] = $key;
          if ($parent == $ignoreme)
          {
            $found =  true;
            break;
          }
          $parent = $rows[$parent]->parent;
        }
        if(!$found)
        {
          $ignore = array();
        }
        else
        {
          $ignorearr = array_merge($ignorearr, $ignore);
        }
      }

      //aus Array die in $ignore gesammelten nicht auszugebenden cats entfernen
      foreach($ignorearr as $catignore)
      {
        unset($rows[$catignore]);
      }
    }

    //Iteration through array and completion of the shown path in the input box
    foreach($rows as $key => $obj)
    {
      $parent = $obj->parent;

      //at first try to complete the name with a look in the array
      //to avoid unnecessary db queries
      while($parent != 0)
      {
        if(isset($rows[$parent]))
        {
          $rows[$key]->name = $rows[$parent]->name . ' &raquo; ' . $rows[$key]->name;
          //if found parent element includes completed pathname
          //leave the while to set the actual element to ready
          if($rows[$parent]->ready == true)
          {
            break;
          }
          else
          {
            $parent = $rows[$parent]->parent;
          }
        }
        else
        {
          $query = "  SELECT 
                        parent,
                        name 
                      FROM 
                        #__joomgallery_catg 
                      WHERE 
                        cid = ".$parent;
          $database->setQuery($query);
          $parentcat = $database->loadObject();
          $parent    = $parentcat->parent;
          $rows[$key]->name = $parentcat->name . ' &raquo; ' . $rows[$key]->name; 
        }
      }
      //mark cat element as ready when path of them completed
      $rows[$key]->ready = true;
    }

    //sort the array with key pathname if more than one element
    if(count($rows) > 1)
    {
      usort($rows, array('JHTMLJoomSelect', 'sortCatArray'));
    }

    //build the html
    foreach($rows as $key => $obj)
    {
      $output .= "<option value=\"".$obj->cid."\"";
      if($cid == $obj->cid)
      {
        $output .= " selected=\"selected\"";
      }
      $output .=">".$obj->name."</option>\n";
    }
    $output .= "</select>\n";

    return $output; 
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
                username AS text
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
      $users[] = JHTML::_('select.option',  '0', JText::_('JGS_DETAIL_NAMETAGS_SELECT_USER'));
      $users = array_merge($users, $db->loadObjectList());
    }
    else
    {
      $users = $db->loadObjectList();
    }

    return JHTML::_('select.genericlist', $users, $name, 'class="inputbox"'. $javascript, 'value', 'text', $active);
  }

  /**
   * Callback function for sorting an array of objects to assembled names of
   * categories with alle parent categories
   * @see categoryList() and userCategoryList()
   *
   * @access  public
   * @param   object $a element one
   * @param   object $b element two
   * @return  int 0 if names equal, -1 if a < b, 1 if a > b
   */
  function sortCatArray($a, $b)
  {
    return strcmp($a->name, $b->name);
  }
}