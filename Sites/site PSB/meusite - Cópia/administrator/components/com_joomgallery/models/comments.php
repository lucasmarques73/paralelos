<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/models/comments.php $
// $Id: comments.php 2566 2010-11-03 21:10:42Z mab $
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
 * Comments model
 *
 * Saves, removes, publishes, unpublishes, approves,
 * rejects and loads comments.
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModelComments extends JoomGalleryModel
{
  /**
   * Comments data array
   *
   * @access  protected
   * @var     array
   */
  var $_comments;

	/**
	 * Comments number
	 *
   * @access  protected
	 * @var     int
	 */
	var $_total = null;

  /**
   * Returns the query for loading all comments
   *
   * @access  protected
   * @return  string    The query to be used to retrieve the rows from the database
   * @since   1.5.5
   */
  function _buildQuery()
  {
    $query = "SELECT
                c.*,
                a.id,
                a.imgthumbname,
                a.catid
              FROM
                "._JOOM_TABLE_COMMENTS." AS c
              LEFT JOIN
                "._JOOM_TABLE_IMAGES." AS a
              ON
                a.id = c.cmtpic
              ".$this->_buildWhere()."
              ".$this->_buildOrderby();

    return $query;
  }

  /**
   * Returns the 'where' part of the query for loading all comments
   *
   * @access  protected
   * @return  string    The 'where' part of the query for loading all comments
   * @since   1.5.5
   */
  function _buildWhere()
  {
    $where = '';

    if($filter = JRequest::getString('search'))
    {
      $filter = $this->_db->Quote('%'.$this->_db->getEscaped($filter, true).'%', false);
      $where .= 'WHERE cmttext LIKE '.$filter;
    }

    return $where;
  }

  /**
   * Returns the 'order by' part of the query for loading all comments
   *
   * @access  protected
   * @return  string    The 'order by' part of the query for loading all comments
   * @since   1.5.5
   */
  function _buildOrderBy()
  {
    #$sort = JRequest::getInt('sort');

    $sortorder  = 'cmtdate DESC';
    /*switch($sort)
    {
      case 0:
        $sortorder = 'c.ordering ASC';
        break;
      case 1:
        $sortorder = 'c.ordering DESC';
        break;
      case 2:
        $sortorder = 'c.catpath ASC';
        break;
      case 3:
        $sortorder = 'c.catpath DESC';
        break;
      case 4:
        $sortorder = 'c.cid ASC';
        break;
      case 5:
        $sortorder = 'c.cid DESC';
        break;
      case 6:
        $sortorder = 'c.name ASC';
        break;
      case 7:
        $sortorder = 'c.name DESC';
        break;
      case 8:
        $sortorder = 'c.owner ASC';
        break;
      case 9:
        $sortorder = 'c.owner DESC';
        break;
      default:
        break;
    }*/

    if($sortorder != '')
    {
      $orderby = 'ORDER BY '.$sortorder;
    }

    return $orderby;
  }

  /**
   * Retrieves the comments data
   *
   * @access  public
   * @return  array   Array of objects containing the comments data from the database
   * @since   1.5.5
   */
  function getComments()
  {
    // Lets load the data if it doesn't already exist
    if(empty($this->_comments))
    {
      jimport('joomla.filesystem.file');

      // Get the pagination request variables
      $limit      = JRequest::getVar('limit', 0, '', 'int');
      $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

      $query = $this->_buildQuery();
      $this->_comments = $this->_getList($query, $limitstart, $limit);

      foreach($this->_comments as $key => $comment)
      {
        if($comment->userid > 0)
        {
          $this->_comments[$key]->cmtname = JHTML::_('joomgallery.displayname', $comment->userid);
        }

        $this->_comments[$key]->cmttext   = JoomHelper::processText($comment->cmttext);

        $this->_comments[$key]->imgsource = null;
        if($comment->imgthumbname)
        {
          $file = $this->_ambit->getImg('thumb_path', $comment);
          if(JFile::exists($file))
          {
            $imginfo                          = getimagesize($file);
            $this->_comments[$key]->imgsource = $this->_ambit->getImg('thumb_url', $comment);
            $this->_comments[$key]->imgwidth  = $imginfo[0];
            $this->_comments[$key]->imgheight = $imginfo[1];
          }
        }
      }
    }

    return $this->_comments;
  }

  /**
	 * Method to get the total number of comments
	 *
	 * @access  public
	 * @return  int     The total number of comments in the gallery
   * @since   1.5.5
	 */
	function getTotal()
	{
		// Lets load the comments number if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

  /**
   * Method to delete one or more comments
   *
   * @access	public
   * @return	int	    The number of successfully deleted comments, boolean false if an error occured
   * @since   1.5.5
   */
  function delete()
  {
    $cids = JRequest::getVar('cid', array(0), 'post', 'array');

    $row = & $this->getTable('joomgallerycomments');

    if(count($cids))
    {
      foreach($cids as $cid)
      {
        if (!$row->delete($cid))
        {
          $this->setError($row->getErrorMsg());
          return false;
        }
      }

      return count($cids);
    }

    return false;
  }

  /**
   * Method to publish, unpublish, approve or reject one or more comments
   *
   * @access	public
   * @param   array   $cid      Array of comment IDs to perform the task on
   * @param   int     $publish  1 for publishing or approving, 0 for unpublishing or rejecting
   * @param   string  $task     The task to perform ('publish' or 'approve')
   * @return	int	    The number of successfully processed comments, false otherwise
   * @since   1.5.5
   */
  function publish($cid, $publish = 1, $task = 'publish')
  {
    JArrayHelper::toInteger($cid);
    $cids = implode(',', $cid);

    $column = 'approved';
    if($task == 'publish')
    {
      $column = 'published';
    }

    $query = "UPDATE
                "._JOOM_TABLE_COMMENTS."
              SET
                ".$column." = ".(int) $publish."
              WHERE
                cmtid IN (".$cids." )";
    $this->_db->setQuery($query);
    if(!$this->_db->query())
    {
      return false;
    }

    // Message about new comment to image owner
    if($column == 'approved' && $publish && $this->_config->get('jg_msg_comment_toowner'))
    {
      require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'messenger.php');
      $messenger  = new JoomMessenger();

      foreach($cid as $id)
      {
        // Load comment data
        $comment  = &$this->getTable('joomgallerycomments');
        $comment->load($id);

        if(!$name = $comment->cmtname)
        {
          $user = & JFactory::getUser($comment->userid);
          $name = $user->get('name');
        }

        // Load image data
        $image    = &$this->getTable('joomgalleryimages');
        $image->load($comment->cmtpic);

        if($image->owner &&  $image->owner != $comment->userid)
        {
          $mode       = $messenger->getModeData('comment');
          $message    = array(
                              'from'      => $this->_user->get('id'),
                              'subject'   => JText::_('JGA_MESSAGE_NEW_COMMENT_TO_OWNER_SUBJECT'),
                              'body'      => JText::sprintf('JGA_MESSAGE_NEW_COMMENT_TO_OWNER_BODY', $name, $image->imgtitle, $image->id),
                              'type'      => $mode['type']
                            );

          $message['recipient'] = $image->owner;

          $messenger->send($message);
        }
      }
    }

    return count($cid);
  }
}
