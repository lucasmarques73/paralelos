<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/refresher.php $
// $Id: refresher.php 2566 2010-11-03 21:10:42Z mab $
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
 * Helper class which handles refreshes afore script timeouts
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomRefresher extends JObject
{
  /**
   * @TODO: Variable comments
   */
  var $max_execution_time;
  var $starttime;
  var $maxtime;
  var $_mainframe;
  var $_controller;
  var $_task;
  var $_msg;
  var $_remaining;
  var $_total;
  var $_showprogress;
  var $_name;

  /**
   * Constructor
   *
   * @access  protected
   * @param   array     $params An array with optional parameters
   * @return  void
   * @since   1.5.5
   */
  function __construct($params = array())
  {
    $this->_mainframe = & JFactory::getApplication('administrator');

    if(isset($params['controller']))
    {
      $this->_controller    = $params['controller'];
    }
    else
    {
      $this->_controller    = JRequest::getCmd('controller');
    }

    if(isset($params['task']))
    {
      $this->_task          = $params['task'];
    }
    else
    {
      $this->_task          = JRequest::getCmd('task');
    }

    if(isset($params['msg']))
    {
      $this->_msg           = $params['msg'];
    }
    else
    {
      $this->_msg           = false;
    }

    if(isset($params['remaining']))
    {
      $this->_remaining     = $params['remaining'];

      if(isset($params['start']) && $params['start'])
      {
        $this->_total       = $params['remaining'];
        $this->_mainframe->setUserState('joom.refresher.total', $this->_total);
      }
      else
      {
        $this->_total       = $this->_mainframe->getUserState('joom.refresher.total');
      }

      $this->_showprogress  = $this->_total ? true : false;
    }

    if(isset($params['name']) && $params['name'])
    {
      $this->_name          = $params['name'];
    }

    $this->init();
  }

  /**
   * Initializes the refresher by storing current time
   *
   * @access  public
   * @return  void
   * @since   1.5.5
   */
  function init()
  {
    // Check the maximum execution time of the script
    // Set secure setting of the real execution time
    $max_execution_time = @ini_get('max_execution_time');

    // Try to set the max execution time to 60s if lower than
    // If not successful the return value will be the old time, so use this
    if($max_execution_time < 60)
    {
      @ini_set('max_execution_time', '60');
      $max_execution_time = @ini_get('max_execution_time');
    }
    $this->max_execution_time = $max_execution_time;
    $this->maxtime            = (int) $this->max_execution_time * 0.8;
    $this->starttime          = time();

    /*$this->counter            = $this->_mainframe->getUserState('joom.refresh.counter');
    if(is_null($this->counter))
    {
      $this->counter = 0;
    }*/
  }

  /**
   * Resets the progressbar or the name of the current task
   *
   * @access  public
   * @param   int     $remaining  Number of remaining steps
   * @param   boolean $start      Determines whether $remaining holds the total number of steps
   * @param   string  $name       Name of the task to display
   * @return  void
   * @since   1.5.6
   */
  function reset($remaining = null, $start = null, $name = null)
  {
    if(!is_null($remaining))
    {
      $this->_remaining     = $remaining;

      if(!is_null($start) && $start)
      {
        $this->_total       = $remaining;
        $this->_mainframe->setUserState('joom.refresher.total', $this->_total);
      }
      else
      {
        $this->_total       = $this->_mainframe->getUserState('joom.refresher.total');
      }

      $this->_showprogress  = $this->_total ? true : false;
    }
    else
    {
      $this->_showprogress  = false;
    }

    if(!is_null($name) && $name)
    {
      $this->_name          = $name;
    }
  }

  /**
   * Checks the remaining time
   *
   * @access  public
   * @return  boolean True: Time remains, false: No more time left
   * @since   1.5.5
   */
  function check()
  {
    $timeleft = -(time() - $this->starttime - $this->maxtime);
    if($timeleft > 0)
    {
      return true;
    }

    return false;
  }

  /**
   * Make a redirect
   *
   * @access  public
   * @param   int     $remaining  Number of remaining steps
   * @param   string  $task       The task which will be called after the redirect
   * @param   string  $msg        An optional message which will be enqueued (this is currently disabled)
   * @param   string  $type       Type of the message (one of 'message', 'notice', 'error')
   * @param   string  $controller The controller which will be called after the redirect
   * @return  void
   * @since   1.5.5
   */
  function refresh($remaining = null, $task = null, $msg = null, $type = null, $controller = null)
  {
    if($remaining)
    {
      $this->_remaining = $remaining;
    }

    if($this->_msg && is_null($task))
    {
      $this->_mainframe->enqueueMessage(JText::_('JGA_COMMON_REDIRECT'));
    }
    if(!$task)
    {
      $task = $this->_task;
    }
    if(!$controller)
    {
      $controller = $this->_controller;
    }

    //if($this->counter > 15)
    //{
      //$this->_interruptRefreshing($task, $controller);
    //}
    //else
    //{
      //$this->_mainframe->setUserState('joom.refresh.counter', $this->counter + 1);
    //}

    $url = 'index.php?option='._JOOM_OPTION.'&controller='.$controller.'&task='.$task;
    $onclick = 'document.location.href=\''.$url.'\';';

    echo '<?xml version="1.0" encoding="utf-8"?'.'>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <!--<meta http-equiv="refresh" content="0;url=<?php echo $url; ?>" />-->
    <link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
    <link href="templates/khepri/css/template.css" rel="stylesheet" type="text/css" />
<?php if($this->_showprogress): ?>
      <style type="text/css">
        div.progressbar {
          border:1px solid #000;
          background-color:white;
          width:500px;
          height:28px;
          padding:1px;
          margin-top:5px;
          margin-right:auto;
          margin-left:auto;
        }
       
        div.progress {
          background-color:#0F0;
          height:28px;
          width:<?php echo floor((($this->_total - $this->_remaining) / $this->_total) * 100); ?>%;
        }
      </style>
<?php endif; ?>
      <title><?php echo JText::_('JGA_COMMON_REFRESHER_IN_PROGRESS'); ?></title>
  </head>
  <body>
    <div class="TODO" style="width:600px; margin:auto; border: 1px dashed silver; padding: 5px;">
      <div class="TODO" style="font-weight:bold; margin-bottom:10px;">
        <?php echo JText::_('JGA_COMMON_REFRESHER_PLEASE_WAIT'); ?>
<?php if($this->_name): ?>
        <br />
        <?php echo JText::sprintf('JGA_COMMON_REFRESHER_CURRENT_TASK', '<span style="color:green;">'.$this->_name.'</span>'); ?>
<?php endif; ?>
      </div>
      <div style="text-align:center; margin-bottom:5px;"><img src="../media/system/images/spinner.gif" alt="spinner" width="16" height="16" /></div>
      <!--<input type="submit" value="<?php echo JText::_('Continue'); ?>" onclick="<?php echo $onclick; ?>" />-->
<?php if($this->_showprogress): ?>
      <div class="progressbar" title="<?php echo JText::sprintf('JGA_COMMON_REFRESHER_PROGRESSBAR', $this->maxtime); ?>">
        <div class="progress"></div>
      </div>
      <div class="small" style="text-align:center;color:grey;"><?php echo JText::sprintf('JGA_COMMON_REFRESHER_PROGRESSBAR', $this->maxtime); ?></div>
<?php endif;
      if($this->_msg):
        $doc = &JFactory::getDocument();
        $renderer = $doc->loadRenderer('message');
        echo $renderer->render();
      endif; ?>
    </div>
    <script type="text/javascript"><?php echo $onclick; ?></script>
  </body>
</html><?php
    $this->_mainframe->close();
    //$this->_mainframe->redirect($url, $msg, $type);
  }

  /**
   * Interrupts refreshing by offering a button to continue manually
   *
   * @access  public
   * @param   string  $task       The task to continue with
   * @param   string  $controller The controller to redirect to
   * @return  void
   * @since   1.5.5
   * @deprecated as of version 1.5.6
   */
  /*function _interruptRefreshing($task, $controller)
  { ?>
<html>
  <head>
    <link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
    <link href="templates/khepri/css/template.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="TODO" style="width:600px; margin:auto; border: 1px dashed silver; padding: 5px;">
<?php $doc = &JFactory::getDocument();
      $renderer = $doc->loadRenderer('message');
      echo $renderer->render();
      $onclick = 'document.location.href=\'index.php?option='._JOOM_OPTION.';&controller='.$controller.'&task='.$task.'\';'; ?>
      <div class="TODO" style="font-weight:bold; margin-bottom:10px;"><?php echo JText::sprintf('JGA_MAIMAN_MSG_REFRESHER_INTERRUPT_EXPLANATION', $this->counter); ?></div>
      <input type="submit" value="<?php echo JText::_('Continue'); ?>" onclick="<?php echo $onclick; ?>" />
    </div>
  </body>
</html><?php
    $this->_mainframe->setUserState('joom.refresh.counter', 0);
    jexit();
  }*/
}