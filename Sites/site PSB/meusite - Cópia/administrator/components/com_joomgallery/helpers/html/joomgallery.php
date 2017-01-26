<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/html/joomgallery.php $
// $Id: joomgallery.php 2322 2010-08-27 14:37:19Z chraneco $
/******************************************************************************\
**   JoomGallery  1.5 RC2                                                     **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                          **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Utility class for creating HTML Grids
 *
 * @static
 * @package JoomGallery
 * @since   1.5.5
 */
class JHTMLJoomGallery
{
  /**
   * Displays the approved state as an clickable button
   */
  function approved( &$row, $i, $actionA = 'Reject image', $actionR = 'Approve image', $altA = 'Approved', $altR = 'Rejected', $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='')
  {
    $img 	= $row->approved ? $imgY : $imgX;
    $task 	= $row->approved ? 'reject' : 'approve';
    $alt 	= $row->approved ? JText::_($altA) : JText::_($altR);
    $action = $row->approved ? JText::_($actionA) : JText::_($actionR);

    $href = '
    <a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$task .'\')" title="'. $action .'">
    <img src="images/'. $img .'" border="0" alt="'. $alt .'" /></a>'
    ;

    return $href;
  }

  /**
   * Displays the type of an image or category
   */
  function type(&$row, $user_uploaded = 'JGA_COMMON_USER_UPLOAD', $admin_uploaded = 'JGA_COMMON_ADMIN_UPLOAD')
  {
    if(
        (isset($row->useruploaded)
          AND $row->useruploaded
        ) 
        OR 
        (!isset($row->useruploaded)
          AND $row->owner
        )
      )
    {
    $img    = 'users.png';
    $title  = JText::_($user_uploaded);
    }
    else
    {
    $img    = 'credits.png';
    $title  = JText::_($admin_uploaded);
    }

    $html = '<img src="../includes/js/ThemeOffice/'.$img.'" alt="'.$title.'" title="'.$title.'" />'
    ;

    return $html;
  }

  /**
   * Displays the name or user name of a category, image or comment owner
   * and may link it to the profiles of other extensions (if available).
   *
   * @param   int     $userId
   * @param   bool    $extended
   * @return  string  The user's name
   * @since   1.5.5
   */
  function displayname($userId, $extended = true)
  {
    $userId = intval($userId);

    if(!$userId)
    {
      return JText::_('Administrator');
    }

    $config     = & JoomConfig::getInstance();
    $dispatcher = & JDispatcher::getInstance();

    // Enable JoomGallery plugins
    #JPluginHelper::importPlugin('joomgallery');

    $realname   = $config->get('jg_realname');

    $plugins    = $dispatcher->trigger('onJoomDisplayUser', array($userId, $realname, $extended));

    foreach($plugins as $plugin)
    {
      if($plugin)
      {
        return $plugin;
      }
    }

    $user = & JFactory::getUser($userId);

    if($realname)
    {
      $username = $user->get('name');
    }
    else
    {
      $username = $user->get('username');
    }

    return $username;
  }

  /**
   * Displays the credits
   *
   * @return  void
   * @since   1.5.5
   */
  function credits()
  {
    $ambit = & JoomAmbit::getInstance();
?>
<div class="footer" align="center">
  <p><br />
    <a href="http://www.joomgallery.net" target="_blank">
      <img src="<?php echo $ambit->getIcon('powered_by.gif'); ?>"  class="jg-poweredby" style="border:#666 solid 1px; padding:2px;display:block;clear:both;" alt="Powered by JoomGallery" />
    </a>
  </p>
  By:
  <a href="mailto:team@joomgallery.net">
    JoomGallery::ProjectTeam
  </a>
  <br />
  [Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam]
  <br />
  <?php echo 'Version '.$ambit->get('version'); ?>
</div>
<?php
  }

  /**
   * returns a select list of available accesslevels
   */
  /*function access($value = null, $name = 'access')
  {
    $db = & JFactory::getDBO();
    $db->setQuery('SELECT id, name FROM #__groups');

    $arr = array();
    $groups = $db->loadObjectList();
    foreach($groups as $group)
    {
      $arr[] = JHTML::_('select.option', $group->id, JText::_($group->name));
    }

    return JHTML::_('select.genericlist', $arr, $name, null, 'value', 'text', $value, $name);
  }*/

  /**
   * returns a select list of available usergroups
   */
  /*function usergroup($value = null, $name = 'access')
  {
    $acl    =& JFactory::getACL();
    $gtree  = $acl->get_group_children_tree(null, 'USERS', false);

    return JHTML::_('select.genericlist', $gtree, $name, null, 'value', 'text', $value, $name);
  }*/

  /**
   * Construct an indent list of items
   * @see showBackendAllowedCat
   *
   * @TODO: combine with treeRecurse?
   *
   * @param int $id
   * @param string $indent   indent chars
   * @param string $list
   * @param int $children
   * @param int $maxlevel recursion level
   * @param int $level
   * @param string $seperator
   * @return string indented list
   */
  function catTreeRecurse($id, $indent = '&nbsp;&nbsp;&nbsp;', $list, &$children, $seperator = '&raquo;')
  {
    if(isset($children[$id]))
    {
      foreach($children[$id] as $v)
      {
        $id = $v->cid;
        $txt = $v->name;
        $pt = $v->parent;
        $list[$id] = $v;
        $list[$id]->treename = $indent . $txt;
        $list = JHTMLJoomGallery::catTreeRecurse($id, $indent . $txt . $seperator, $list, $children);
      }
    }
    return $list;
  }

  function treeRecurse($id, $indent, $list, &$children)
  {
    if(isset($children[$id]))
    {
      foreach($children[$id] as $v)
      {
        $id = $v->cid;

        $pre    = '&raquo;&nbsp;';
        $spacer = '&nbsp;&nbsp;&nbsp;';

        if($v->parent == 0)
        {
          $txt 	= $v->name;
        }
        else
        {
          $txt 	= $pre . $v->name;
        }

        $pt = $v->parent;
        $list[$id] = $v;
        $list[$id]->name = $indent.$txt;
        $list = JHTMLJoomGallery::TreeRecurse($id, $indent . $spacer, $list, $children);
      }
    }
    return $list;
  }

  /**
   * creates the path to a category which can be displayed
   *
   * @TODO: Add a parameter '$linked'? The items can be linked to the
   *        category view then and pathway could be created more easily.
   */           
  function categoryPath($catid, $separator = ' &raquo; ')
  {
    static $path;

    if(!isset($path))
    {
      $path = array();
    }

    $catid = intval($catid);
    if(empty($path[$catid]))
    {
      $database = & JFactory::getDBO();
      $user = & JFactory::getUser();

      $cat = $catid;
      if(!$catid)
      {
        return;
      }
      $parent_id = true;
      while($parent_id)
      {
        //read name and parent_id
        $query = "SELECT
                    name, parent
                  FROM
                    "._JOOM_TABLE_CATEGORIES."
                  WHERE
                        cid     = $cat
                    AND access <='".$user->get('aid')."'";
        $database->setQuery($query);
        $result = $database->loadObject();
        $parent_id = $result->parent;
        $name = $result->name;
        // add path to array
        if(empty($path[$catid]))
        {
          $path[$catid] = $name;
        }
        else
        {
          $path[$catid] = $name . ' &raquo; ' . $path[$catid];
        }
        // Next loop
        $cat = $parent_id;
      }
    }

    return $path[$catid] . ' ';
  }
}