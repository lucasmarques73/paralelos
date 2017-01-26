<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/helpers/messenger.php $
// $Id: messenger.php 2537 2010-10-17 22:07:03Z chraneco $
/****************************************************************************************\
**   JoomGallery  1.5                                                                   **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * JoomGallery Messenger
 *
 * Sends all kind of messages in the gallery.
 * If a message is going to be send as a personal message
 * the event 'onJoomBeforeSendMessage' will be triggered afore.
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomMessenger extends JObject
{
  /**
   * Message data array
   *
   * @access  protected
   * @var     array
   */
  var $_message = array();

  /**
   * Recipients
   *
   * @access  protected
   * @var     array
   */
  var $_recipients = array();

  /**
   * All available modes
   *
   * @access  protected
   * @var     array
   */
  var $_modes = array();

  /**
   * Current mode
   *
   * @access  protected
   * @var     string
   */
  var $_mode = null;

  /**
   * Current type
   *
   * @access  public
   * @var     int
   */
  var $type = 0;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function __construct()
  {
    parent::__construct();

    $config = & JoomConfig::getInstance();

    // Predefined message send modes
    if(!$recipients = $config->get('jg_msg_upload_recipients'))
    {
      $db = & JFactory::getDBO();
      $db->setQuery(" SELECT
                        id
                      FROM
                        #__users
                      WHERE
                        sendEmail = '1'
                   ");
      $db_recipients  = $db->loadResultArray();
      $recipients     = $db_recipients;
    }
    else
    {
      $recipients = explode(',', $recipients);
    }
    $this->_modes['upload']     ['recipients']  = $recipients;
    $this->_modes['upload']     ['type']        = $config->get('jg_msg_upload_type');

    if(!$recipients = $config->get('jg_msg_comment_recipients'))
    {
      if(!isset($db_recipients))
      {
        $db = & JFactory::getDBO();
        $db->setQuery(" SELECT
                          id
                        FROM
                          #__users
                        WHERE
                          sendEmail = '1'
                     ");
        $recipients = $db->loadResultArray();
      }
      else
      {
        $recipients = $db_recipients;
      }
    }
    else
    {
      $recipients = explode(',', $recipients);
    }
    $this->_modes['comment']    ['recipients']  = $recipients;
    $this->_modes['comment']    ['type']        = $config->get('jg_msg_comment_type');

    if(!$recipients = $config->get('jg_msg_report_recipients'))
    {
      if(!isset($db_recipients))
      {
        $db = & JFactory::getDBO();
        $db->setQuery(" SELECT
                          id
                        FROM
                          #__users
                        WHERE
                          sendEmail = '1'
                     ");
        $recipients = $db->loadResultArray();
      }
      else
      {
        $recipients = $db_recipients;
      }
    }
    else
    {
      $recipients = explode(',', $recipients);
    }
    $this->_modes['report']     ['recipients']  = $recipients;
    $this->_modes['report']     ['type']        = $config->get('jg_msg_report_type');

    $this->_modes['send2friend']['recipients']  = array();
    $this->_modes['send2friend']['type']        = 1;

    $this->_modes['default']    ['recipients']  = array();
    $this->_modes['default']    ['type']        = 2;
  }

  /**
   * Method to send a message
   *
   * <pre>
   * $message = array(
   *                    'recipient' => (int/string) 65 (user ID) || 'localhost@localhost.de (address)
   *                    'from'      => (int/string) 65 (user ID) || 'localhost@localhost.de (address)
   *                    'fromname'  => (string)     'Username'
   *                    'subject'   => (string)     'Subject line'
   *                    'body'      => (string)     'Message'
   *                    'mode'      => (string)     'upload' || 'comment' || 'send2friend'
   *                    'type'      => (int)        0 (global setting according to mode) || 1 (mail) || 2 (msg) || 3 (both)
   *                  );
   * </pre>
   *
   * @access  public
   * @param   array   $message  Array which holds the message data
   * @return  boolean True on success, false otherwise
   * @since   1.5.5
   */
  function send($message)
  {
    if(!$this->_loadMessage($message))
    {
      return false;
    }

    // Send message depending of the selected type
    $result_array = array();
    if($this->type == 1 || $this->type == 3)
    {
      $result_array[] = $this->_sendMail();
    }
    if($this->type == 2 || $this->type == 3)
    {
      $result_array[] = $this->_sendMsg();
    }

    if(in_array(false, $result_array, true))
    {
      return false;
    }

    return true;
  }

  /**
   * Method to add one ore more recipients for the next delivery
   *
   * @access  public
   * @param   array   $recipients An array of recipients or a single one as a string
   * @return  void
   * @since   1.5.5
   */
  function addRecipients($recipients)
  {
    if(is_array($recipients))
    {
      $this->_recipients    = array_merge($this->_recipients, $recipients);
    }
    else
    {
      $this->_recipients[]  = $recipients;
    }
  }

  /**
   * Method to add a message send mode
   *
   * @access  public
   * @param   array   $mode Holds the data of the additional mode
   * @return  boolean True on success, false otherwise
   * @since   1.5.5
   */
  function addMode($mode)
  {
    if(     isset($mode['name'])        && $name = $mode['name']
        &&  isset($mode['recipients'])  && is_array($mode['recipients'])
        &&  isset($mode['type'])        && is_numeric($mode['type'])
      )
    {
      unset($mode['name']);
      $this->_modes[$name] = $mode;
      return true;
    }

    return false;
  }

  /**
   * Returns the data of a specific message send mode
   *
   * @access  public
   * @param   array   $mode The key of the requested mode
   * @return  array   An array that holds the data of the requested mode
   * @since   1.5.5
   */
  function getModeData($mode = 'default')
  {
    if(!isset($this->_modes[$mode]))
    {
      $mode = 'default';
    }

    return $this->_modes[$mode];
  }

  /**
   * Returns the recipients which are currently selected.
   *
   * Merges the recipients of the currently selected mode and the additional
   * recipients added by the method addRecipients().
   *
   * @access  public
   * @return  array   An array of recipients
   * @since   1.5.5
   */
  function getRecipients()
  {
    return array_unique(array_merge($this->_modes[$this->_mode]['recipients'], $this->_recipients));
  }

  /**
   * Returns the type of a specific mode.
   *
   * @access  public
   * @param   string  The mode of which the type is requested
   * @return  array   The requested type, 2 if $mode was false
   * @since   1.5.5
   */
  function getType($mode = false)
  {
    if($mode)
    {
      $mode = $this->getModeData($mode);
      return $mode['type'];
    }
    else
    {
      return 2;
    }
  }

  /**
   * Checks if sufficent information are given to send a message
   * and prepares the message for getting sent.
   *
   * @access  protected
   * @param   array     $message  Array which should hold all information about the message.
   * @return  boolean   True if message may be sent, false otherwise.
   * @since   1.5.5
   */
  function _loadMessage($message)
  {
    if(     /*!isset($message['from'])
        ||*/  !isset($message['subject'])
        ||  !isset($message['body'])
        /*||  empty($message['from'])*/
        ||  !$message['subject']
        ||  !$message['body']
      )
    {
      JError::raiseNotice(500, 'Unsufficient Information to send message');
      return false;
    }

    if(isset($message['recipient']) && $message['recipient'])
    {
      $this->addRecipients($message['recipient']);
    }

    // TODO: Clean variables
    $message['subject'] = $message['subject'];
    $message['body']    = $message['body'];

    $this->_message = $message;
    $this->_subject = $this->_message['subject'];
    $this->_text    = $this->_message['body'];

    $this->_loadMode();

    return true;
  }

  /**
   * Loads the message send mode according to the loaded message.
   *
   * @access  protected
   * @return  void
   * @since   1.5.5
   */
  function _loadMode()
  {
    if(isset($this->_message['mode']))
    {
      $this->_mode = $this->_message['mode'];
    }
    else
    {
      $this->_mode = 'default';
    }

    if(!array_key_exists($this->_mode, $this->_modes))
    {
      JError::raiseError(500, 'Unknown JoomGallery send message mode');
    }

    if(isset($this->_message['type']) && $this->_message['type'])
    {
      $this->type = $this->_message['type'];
    }
    else
    {
      $this->type = $this->getType($this->_mode);
    }
  }

  /**
   * Sends a message as an electronic mail.
   *
   * @access  protected
   * @return  booelean  True on success, JError object otherwise
   * @since   1.5.5
   */
  function _sendMail()
  {
    $from = null;
    if(isset($this->_message['from']))
    {
      if(is_numeric($this->_message['from']))
      {
        $user = &JFactory::getUser($this->_message['from']);

        // Ensure that a valid user was selected
        if(is_object($user))
        {
          $from = $user->get('email');
        }
      }
      else
      {
        //if(JMailHelper::isEmailAddress($this->_message['from']))
        //{
          $from = $this->_message['from'];
        //}
      }
    }
    if(!$from)
    {
      $mainframe  = & JFactory::getApplication('site');
      $from       = $mainframe->getCfg('mailfrom');
    }

    if(!isset($this->_message['fromname']) || !$this->_message['fromname'])
    {
      if(!isset($user) || !is_object($user))
      {
        $fromname = $mainframe->getCfg('mailfrom');
      }
      else
      {
        $fromname = $user->get('name');
      }
    }
    else
    {
      $fromname = $this->_message['fromname'];
    }

    $recipients = array();
    foreach($this->getRecipients() as $recipient)
    {
      if(is_numeric($recipient))
      {
        $user = &JFactory::getUser($recipient);

        // Ensure that a valid user was selected
        if(is_object($user))
        {
          $recipients[] = $user->get('email');
        }
      }
      else
      {
        $recipients[] = $recipient;
      }
    }

    // Remove duplicate values
    $recipients = array_unique($recipients);

    if(JUtility::sendMail($from, $fromname, $recipients, $this->_subject,  $this->_text) !== true)
    {
      return false;
    }

    return true;
  }

  /**
   * Sends a message as a personal message (PM).
   *
   * @access  protected
   * @return  booelean  True on success, false otherwise
   * @since   1.5.5
   */
  function _sendMsg()
  {
    $db = & JFactory::getDBO();
    require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_messages'.DS.'tables'.DS.'message.php' );

    if($this->_message['from'] && is_numeric($this->_message['from']))
    {
      $from = $this->_message['from'];
    }
    else
    {
      // Select a super administrator
      $db->setQuery(" SELECT
                        id
                      FROM
                        #__users
                      WHERE
                        gid = 25
                    ");
      $from = $db->loadResult();
    }

    $recipients = array();
    foreach($this->getRecipients() as $recipient)
    {
      if(is_numeric($recipient))
      {
        $recipients[] = $recipient;
      }
    }

    $msg          = new TableMessage($db);
    $result_array = array();
    foreach($recipients as $recipient)
    {
      $message = array( 'from'      => $from,
                        'recipient' => $recipient,
                        'subject'   => $this->_subject,
                        'text'      => $this->_text,
                        'mode'      => $this->_mode
                      );
      $mainframe = & JFactory::getApplication('site');
      if($mainframe->triggerEvent('onJoomBeforeSendMessage', array($message)) !== false)
      {
        $result_array[] =  $msg->send($from, $recipient, $this->_subject, $this->_text);

        // Reset messenger
        $msg->message_id = 0;
      }
    }

    if(in_array(false, $result_array))
    {
      JError::raiseNotice(500, $msg->getError());
      return false;
    }

    return true;
  }
}