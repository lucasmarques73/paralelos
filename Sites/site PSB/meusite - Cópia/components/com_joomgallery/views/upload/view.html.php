<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/views/upload/view.html.php $
// $Id: view.html.php 2566 2010-11-03 21:10:42Z mab $
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
 * HTML View class for the upload view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewUpload extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display($tpl = null)
  {
    if(   !$this->_config->get('jg_userspace') 
       || ($this->_config->get('jg_showuserpanel') == 2 && $this->_user->get('aid') != 2)
      )
    {
      // You are not allowed...
      $msg = JText::_('ALERTNOTAUTH');
      if(!$this->_user->get('id'))
      {
        $msg .= '<br />' . JText::_('You need to login.');
      }

      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), $msg, 'notice');
    }

    if(!$this->_user->get('id'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=gallery', false), JText::_('JGS_COMMON_MSG_YOU_ARE_NOT_LOGGED'), 'notice');
    }

    $params     = &$this->_mainframe->getParams();

    // Breadcrumbs
    if($this->_config->get('jg_completebreadcrumbs'))
    {
      $breadcrumbs  = &$this->_mainframe->getPathway();
      $breadcrumbs->addItem(JText::_('JGS_COMMON_USER_PANEL'), 'index.php?view=userpanel');
      $breadcrumbs->addItem(JText::_('JGS_COMMON_UPLOAD_NEW_IMAGE'));
    }

    // Header and footer
    JoomHelper::prepareParams($params);

    $pathway = null;
    if($this->_config->get('jg_showpathway'))
    {
      $pathway  = '<a href="'.JRoute::_('index.php?view=userpanel').'">'.JText::_('JGS_COMMON_USER_PANEL').'</a>';
      $pathway .= ' &raquo; '.JText::_('JGS_COMMON_UPLOAD_NEW_IMAGE');
    }

    $backtarget = JRoute::_('index.php?view=gallery');
    $backtext   = JText::_('JGS_COMMON_BACK_TO_GALLERY');

    $numbers    = JoomHelper::getPicsAndHits($params);

    if(!$params->get('page_title'))
    {
      $params->set('page_title', JText::_('JGS_COMMON_GALLERY'));
    }

    // Load modules at position 'top'
    $modules['top'] = JoomHelper::getRenderedModules('top');
    if(count($modules['top']))
    {
      $params->set('show_top_modules', 1);
    }
    // Load modules at position 'btm'
    $modules['btm'] = JoomHelper::getRenderedModules('btm');
    if(count($modules['btm']))
    {
      $params->set('show_btm_modules', 1);
    }

    // No restrictions for administrators
    if(!$this->get('AdminLogged'))
    {
      $count = &$this->get('ImageNumber');

      if($count >= $this->_config->get('jg_maxuserimage'))
      {
        $msg = JText::sprintf('JGS_UPLOAD_OUTPUT_MAY_ADD_MAX_OF', $this->_config->get('jg_maxuserimage'));
        $this->_mainframe->redirect(JRoute::_('index.php?view=userpanel', false), $msg, 'notice');
      }

      $inputcounter   = $this->_config->get('jg_maxuserimage') - $count;
      $remainder      = $inputcounter;
      if($inputcounter > $this->_config->get('jg_maxuploadfields'))
      {
        $inputcounter = $this->_config->get('jg_maxuploadfields');
      }

      $maxfilesizekb = number_format($this->_config->get('jg_maxfilesize') / 1024, 2, ',', '.');

      $this->assignRef('count',         $count);
      $this->assignRef('remainder',     $remainder);
      $this->assignRef('maxfilesizekb', $maxfilesizekb);
    }
    else
    {
      $inputcounter = $this->_config->get('jg_maxuploadfields');
    }
    $this->assignRef('inputcounter', $inputcounter);
    $this->_doc->addScriptDeclaration('    var jg_inputcounter = '.$inputcounter.';');

    // No restricted categories for administrators
    if($this->get('AdminLogged'))
    {
      $lists['cats'] = JHTML::_('joomselect.categorylist', 0, 'catid', ' class="inputbox"');
    }
    else
    {
      // If $this->_config->get('jg_userowncatsupload') == true
      // users will be only allowed to upload to their own categories
      $lists['cats'] = JHTML::_('joomselect.usercategorylist', 0, null, 'catid', true);
    }

    $this->assignRef('params',          $params);
    $this->assignRef('lists',           $lists);
    $this->assignRef('pathway',         $pathway);
    $this->assignRef('modules',         $modules);
    $this->assignRef('backtarget',      $backtarget);
    $this->assignRef('backtext',        $backtext);
    $this->assignRef('numberofpics',    $numbers[0]);
    if(isset($numbers[1]))
    {
      $this->assignRef('numberofhits',  $numbers[1]);
    }

    jimport('joomla.html.pane');
    $pane = JPane::getInstance('tabs');
    $this->assignRef('tabs', $pane);

    // Check the php.ini setting 'session.cookie_httponly'
    // If set and = 1 then build the parameter 'readCookieFrom Navigator=false'
    // in Applet (new since V 4.2.1c)
    // and provide the cookie with sessionname=token in parameter 'specificHeaders' 
    $cookieNavigator  = true;
    $sesscook         = @ini_get('session.cookie_httponly');
    if(!empty($sesscook) && $sesscook == 1)
    {
      $cookieNavigator    = false;
      // Get the current session
      $currentSession     = JSession::getInstance('', array());
      $sessionname        = $currentSession->getName();
      // Function getToken() delivers wrong token, so get the right one
      // from $_COOKIE array (since PHP 4.1.0)
      $sessiontoken       = $_COOKIE[$sessionname];
    }

    $this->assignRef('cookieNavigator', $cookieNavigator);
    $this->assignRef('sessionname',     $sessionname);
    $this->assignRef('sessiontoken',    $sessiontoken);

    $this->_doc->addScript($this->_ambit->getScript('userpanel.js'));
    $this->_doc->addScriptDeclaration('    var jg_filenamewithjs = '.$this->_config->jg_filenamewithjs.';
    var jg_ffwrong = \''.$this->_config->get('jg_wrongvaluecolor').'\';');
    $this->_ambit->script('JGS_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY');
    $this->_ambit->script('JGS_COMMON_ALERT_YOU_MUST_SELECT_ONE_IMAGE');
    $this->_ambit->script('JG_COMMON_ALERT_YOU_MUST_SELECT_ONE_FILE');
    $this->_ambit->script('JGS_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE');
    $this->_ambit->script('JGS_COMMON_ALERT_FILENAME_DOUBLE_ONE');
    $this->_ambit->script('JGS_COMMON_ALERT_FILENAME_DOUBLE_TWO');
    $this->_ambit->script('JGS_ALERT_WRONG_FILENAME');
    $this->_ambit->script('JG_COMMON_ALERT_WRONG_EXTENSION');
    $this->_ambit->script('JGS_ALERT_WRONG_VALUE');

    parent::display($tpl);
  }
}