<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/helper.php $
// $Id: helper.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery Global Helper for the Backend
 *
 * @static
 * @package JoomGallery
 * @since 1.5.5
 */
class JoomHelper
{
  /**
   * Returns all parent categories of a specific category
   *
   * @param   int     $category The ID of the specific child category
   * @param   boolean $child    True, if category itself shall also be returned, defaults to false
   * @return  array   An array of parent category objects
   * @since   1.5.5
   */
  function getAllParentCategories($category, $child = false)
  {
    static $categories = false;

    if($categories === false)
    {
      $db   = & JFactory::getDBO();
      $user = & JFactory::getUser();

      $db->setQuery("SELECT
                      cid,
                      name,
                      parent
                    FROM
                      "._JOOM_TABLE_CATEGORIES."
                    WHERE
                          published = 1
                      AND access <= ".$user->get('aid')."
                  ");
      $categories = $db->loadObjectList('cid');
    }

    $parents = array();

    $category = $categories[$category];

    if($child)
    {
      array_unshift($parents, $category);
    }

    while($category)
    {
      if(isset($categories[$category->parent]))
      {
        $category = $categories[$category->parent];
        array_unshift($parents, $category);
      }
      else
      {
        $category = false;
      }
    }

    return $parents;
  }

  /**
   * Wrap text
   *
   * @param   string  $text Text to wrap
   * @param   int     $nr   Number of chars to wrap
   * @return  string  Wrapped text
   * @since   1.0.0
   */
  function processText($text, $nr = 40)
  {
    $mytext   = explode(' ', trim($text));
    $newtext  = array();
    foreach($mytext as $k => $txt)
    {
      if(strlen($txt) > $nr)
      {
        $txt  = wordwrap($txt, $nr, '- ', 1);
      }
      $newtext[]  = $txt;
    }

    return implode(' ', $newtext);
  }

  /**
   * Reads the category path from array.
   * If not set read db and add to array.
   *
   * @param   int     $catid  The ID of the category
   * @return  string  The category path
   * @since   1.0.0
   */
  function getCatPath($catid)
  {
    static $catpath = array();

    if(!isset($catpath[$catid]))
    {
      $database = & JFactory::getDBO();
      $database->setQuery(" SELECT
                              catpath
                            FROM
                              "._JOOM_TABLE_CATEGORIES."
                            WHERE
                              cid= ".$catid
                          );

      if(!$path = $database->loadResult())
      {
        $catpath[$catid] = '';
      }
      else
      {
        $catpath[$catid] = $path.'/';
      }
    }

    return $catpath[$catid];
  }

  /**
   * Returns the rating clause for an SQL - query dependent on the
   * rating calculation method selected.
   *
   * @access  public
   * @param   string  $tablealias   Table alias
   * @return  string  Rating clause
   * @since   1.5.6
   */
  function getSQLRatingClause($tablealias = '')
  {
    $db                   = & JFactory::getDBO();
    $config               = & JoomConfig::getInstance();
    static $avgimgvote    = 0.0;
    static $avgimgrating  = 0.0;
    static $avgdone       = false;

    $maxvoting            = $config->get('jg_maxvoting');
    $imgvotesum           = 'imgvotesum';
    $imgvotes             = 'imgvotes';
    if($tablealias != '')
    {
      $imgvotesum = $tablealias.'.'.$imgvotesum;
      $imgvotes   = $tablealias.'.'.$imgvotes;
    }

    // Standard rating clause
    $clause = 'ROUND(LEAST(IF(imgvotes > 0, '.$imgvotesum.'/'.$imgvotes.', 0.0), '.(float)$maxvoting.'), 2)';

    // Advanced (weigthed) rating clause (Bayes)
    if($config->get('jg_ratingcalctype') == 1)
    {
      if(!$avgdone)
      {
        // Needed values for weighted rating calculation
        $db->setQuery('SELECT
                         count(*) As imgcount,
                         SUM(imgvotes) As sumimgvotes,
                         SUM(imgvotesum/imgvotes) As sumimgratings
                       FROM
                         '._JOOM_TABLE_IMAGES.'
                        WHERE
                          imgvotes > 0'
                      );
        $row = $db->loadObject();
        if($row != null)
        {
          if($row->imgcount > 0)
          {
            $avgimgvote   = round($row->sumimgvotes / $row->imgcount, 2 );
            $avgimgrating = round($row->sumimgratings / $row->imgcount, 2);
            $avgdone      = true;
          }
        }
      }
      if($avgdone)
      {
        $clause = 'ROUND(LEAST(IF(imgvotes > 0, (('.$avgimgvote.'*'.$avgimgrating.') + '.$imgvotesum.') / ('.$avgimgvote.' + '.$imgvotes.'), 0.0), '.(float)$maxvoting.'), 2)';
      }
    }

    return $clause;
  }
  /**
   * Returns the rating of an image
   *
   * @access  public
   * @param   string  $imgid   Image id to get the rating for
   * @return  float   Rating
   * @since   1.5.6
   */
  function getRating($imgid)
  {
    $db     = & JFactory::getDBO();
    $rating = 0.0;

    $db->setQuery('SELECT
                    '.JoomHelper::getSQLRatingClause().' AS rating
                  FROM
                    '._JOOM_TABLE_IMAGES.'
                  WHERE
                    id = '.$imgid
                 );
    if(($result = $db->loadResult()) != null)
    {
      $rating = $result;
    }

    return $rating;
  }
}