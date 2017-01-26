<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/helpers/upload.php $
// $Id: upload.php 2566 2010-11-03 21:10:42Z mab $
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
 * Upload methods for frontend
 *
 * - Batch (Zip)
 * - Single upload
 * - JAVA Applet (jupload)
 *
 * @package JoomGallery
 * @since   1.0.0
 */
class JoomUpload
{
  /**
   * @TODO: Variable comments
   */
  var $catid;
  var $file_delete;
  var $original_delete;
  var $create_special_gif;
  var $arrscreenshot;
  var $_adminlogged = false;
  var $imgname_separator;
  var $counter;
  var $debug = false;
  var $_debugoutput;
  var $_config;
  var $_ambit;
  var $_mainframe;
  var $_db;
  var $_user;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.0.0
   */
  function JoomUpload()
  {
    // If the applet checks for the serverProtocol, it issues a HEAD request
    // -> Simply return an empty doc.
    if ($_SERVER['REQUEST_METHOD'] == 'HEAD')
    {
      $type = JRequest::getCmd('type');
      if($type == 'java')
      {
        jexit();
      }
    }

    $this->_config    = & JoomConfig::getInstance();
    $this->_ambit     = & JoomAmbit::getInstance();
    $this->_mainframe = & JFactory::getApplication('site');
    $this->_db        = & JFactory::getDBO();
    $this->_user      = & JFactory::getUser();

    $this->catid              = JRequest::getInt('catid');
    $this->original_delete    = JRequest::getBool('original_delete', false, 'post');
    $this->create_special_gif = JRequest::getBool('create_special_gif', false, 'post');
    $this->arrscreenshot      = JRequest::getVar('arrscreenshot', '', 'files');
    $this->imgname_separator  = JText::_('JGS_UPLOAD_IMAGENAME_SEPARATOR');
    if($this->imgname_separator == 'space')
    {
      $this->imgname_separator = ' ';
    }
    $this->_debugoutput       = '';

    // TODO: Maybe create option to select state before uploading
    $this->published          = 1;
    $this->access             = 0;

    // No user logged in
    if(!$this->_user->get('id'))
    {
      $this->_mainframe->redirect(JRoute::_('index.php', false), JText::_('JGS_COMMON_MSG_YOU_ARE_NOT_LOGGED'), 'notice');
    }

    if($this->_user->get('gid') > 23)
    {
      $this->_adminlogged = true;
    }
    else
    {
      $this->counter = $this->getImageNumber();
    }
  }

  /**
   * Calls the correct upload method according to the specified type
   *
   * @access  public
   * @return  boolean True on success, false otherwise
   * @since   1.5.0
   */
  function upload($type = 'single')
  {
    jimport('joomla.filesystem.file');

    switch($type)
    {
      case 'batch':
        return $this->uploadBatch();
        break;
      case 'java':
        return $this->uploadJava();
        break;
      default:
        return $this->uploadSingles();
        break;
     }
  }

  /**
   * Single upload
   *
   * A number of images is chosen and uploaded afore.
   *
   * @access  public
   * @return  void
   * @since   1.0.0
   */
  function uploadSingles()
  {
    $this->_debugoutput .= '<p />';
    for($i = 0; $i < count($this->arrscreenshot['error'])/*$this->_config->get('jg_maxuploadfields')*/; $i++)
    {
      if(!$this->_adminlogged && $this->counter > $this->_config->get('jg_maxuserimage') - 1)
      {
        $this->_debugoutput .= '<hr />'.JText::sprintf('JGS_UPLOAD_OUTPUT_MAY_ADD_MAX_OF', $this->_config->get('jg_maxuserimage')).'<br />';
        break;
      }
      $screenshot          = $this->arrscreenshot['tmp_name'][$i];
      $screenshot_name     = $this->arrscreenshot['name'][$i];
      $screenshot_filesize = $this->arrscreenshot['size'][$i];
      $ii = $i + 1;

      // Any image entry at position?
      // (4=UPLOAD_ERR_NO_FILE constant since PHP 4.3.0)
      // If not continue with next entry
      if($this->arrscreenshot['error'][$i] == 4)
      {
        continue;
      }

      $plugins  = $this->_mainframe->triggerEvent('onJoomBeforeUpload');
      if(in_array(false, $plugins, true))
      {
        continue;
      }

      // Check for path exploits, and replace spaces
      $screenshot_name = JoomFile::fixFilename($screenshot_name);
      // Get extension
      $tag = strtolower(JFile::getExt($screenshot_name));

      if($this->_config->get('jg_useruploadnumber'))
      {
        $filecounter = $this->_getSerial();
        $praefix = substr($screenshot_name, 0, strpos(strtolower($screenshot_name), $tag) - 1);
        $newfilename = $this->_genFilename($praefix, $tag, $filecounter);
      }
      else
      {
        $newfilename = $this->_genFilename($screenshot_name, $tag);
      }

      // Image size must not exceed the setting in backend except for Admin/SuperAdmin
      if($screenshot_filesize > $this->_config->get('jg_maxfilesize') && !$this->_adminlogged)
      {
        $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_MAX_ALLOWED_FILESIZE', $this->_config->get('jg_maxfilesize'));
        continue;
      }
      // Check for right format
      if(   ($tag == 'jpeg') || ($tag == 'jpg') || ($tag == 'jpe')
         || ($tag == 'gif')  || ($tag == 'png')
        )
      {
        $this->_debugoutput .= '<hr />'.JText::sprintf('Position: ', $ii).'<br />';
        $this->_debugoutput .= $ii . ". " . $screenshot_name . "<br />";

        // If image already exists
        if(JFile::exists($this->_ambit->getImg('img_path', $newfilename, null, $this->catid)))
        {
          // TODO: Still necessary? (-> random numbers in filename)
          $this->_debugoutput .= JText::_('JGS_UPLOAD_OUTPUT_SAME_IMAGE_ALREADY_EXIST');
          continue;
        }

        // We'll assume that this file is ok because with open_basedir,
        // we can move the file, but may not be able to access it until it's moved
        $return = JFile::upload($screenshot, $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
        if(!$return)
        {
          $this->_debugoutput .= JText::sprintf('JG_UPLOAD_ERROR_UPLOADING', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)).'<br />';
          continue;
        }

        $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_UPLOAD_COMPLETE') . '...<br />';
        if(!$img_info = getimagesize($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
        {
          // getimagesize didn't find a valid image or this is some sort of hacking attempt
          // TODO: What is this for?
          JFile::delete($this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          jexit();
        }

        // Check the possible available memory for image resizing.
        // If not available echo error message and continue with next image.
        if(!$this->checkMemory($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), $tag))
        {
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          null
                          );
          continue;
        }

        // Create thumb
        $return = JoomFile::resizeImage($this->_debugoutput,
                                        $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid),
                                        $this->_config->get('jg_useforresizedirection'),
                                        $this->_config->get('jg_thumbwidth'),
                                        $this->_config->get('jg_thumbheight'),
                                        $this->_config->get('jg_thumbcreation'),
                                        $this->_config->get('jg_thumbquality'),
                                        false,
                                        $this->_config->get('jg_cropposition')
                                        );
        if(!$return)
        {
          $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          null
                          );
          continue;
        }
        $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED') . '...<br />';

        // Create detail image
        if($this->_config->get('jg_resizetomaxwidth') && ($this->_config->get('jg_special_gif_upload') == 0
           || !$this->create_special_gif || ($tag != 'gif' && $tag != 'png'))
          )
        {
          $return = JoomFile::resizeImage($this->_debugoutput,
                                          $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                                          false,
                                          $this->_config->get('jg_maxwidth'),
                                          false,
                                          $this->_config->get('jg_thumbcreation'),
                                          $this->_config->get('jg_picturequality'),
                                          true,
                                          0
                                          );
          if(!$return)
          {
            $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            null,
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            continue;
          }
          $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH') . '<br />';
        }
        else
        {
          $return = JFile::copy($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          if(!$return)
          {
            $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            null,
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            continue;
          }
        }

        if(     $this->_config->get('jg_delete_original_user') == 1
           ||  ($this->_config->get('jg_delete_original_user') == 2 && $this->original_delete)
          )
        {
          if(JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
          {
            $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_ORIGINAL_DELETED') . '<br />';
          }
          else
          {
            $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . ' ' . JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
            $this->rollback(null,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            continue;
          }
       }

        $row  = & JTable::getInstance('joomgalleryimages', 'Table');
        $data = JRequest::get('post');
        if(!$row->bind($data, JText::_('JGS_UPLOAD_OPTION_APPROVED_OWNER_PUBLISHED')))
        {
          $this->_debugoutput .= $row->getError();
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }

        $date = & JFactory::getDate();
        $row->imgdate   = $date->toMySQL();
        $row->owner     = $this->_user->get('id');
        $row->published = $this->published;
        $row->access    = $this->access;

        // Uploads of admin/superadmin are approved
        if($this->_config->get('jg_approve') == 1 &&  !$this->_adminlogged)
        {
          $row->approved = 0;
        }
        else
        {
          $row->approved = 1;
        }
        $row->imgfilename  = $newfilename;
        $row->imgthumbname = $newfilename;
        $row->useruploaded = 1;
        $row->ordering     = $this->_getOrdering($row);

        // Add counter number if set in backend
        if($this->_config->get('jg_useruploadnumber'))
        {
          $row->imgtitle = $row->imgtitle.$this->imgname_separator.$filecounter;
        }

        if(!$row->check())
        {
          $this->_debugoutput .= $row->getError();
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                                 );
          $this->debug        = true;
          continue;
        }

        if(!$row->store())
        {
          $this->_debugoutput .= $row->getError();
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
        else
        {
          // Message about new image
          require_once(JPATH_COMPONENT.DS.'helpers'.DS.'messenger.php');
          $messenger  = new JoomMessenger();
          $message    = array(
                                'from'      => $this->_user->get('id'),
                                'subject'   => JText::_('JGS_UPLOAD_MESSAGE_NEW_IMAGE_UPLOADED'),
                                'body'      => JText::sprintf('JGS_MESSAGE_NEW_IMAGE_SUBMITTED_BODY', $this->_user->get('username'), $row->imgtitle),
                                'mode'      => 'upload'
                              );
          $messenger->send($message);

          $this->_debugoutput .= JText::_('JGS_UPLOAD_OUTPUT_IMAGE_SUCCESSFULLY_ADDED') . '<br />';
          $this->_debugoutput .= JText::sprintf('JG_UPLOAD_NEW_FILENAME', $newfilename) . '<br /><br />';

          $this->_mainframe->triggerEvent('onJoomAfterUpload', array($row));
          $this->counter++;
        }
      }
      else
      {
        $this->_debugoutput .= JText::_('JGS_UPLOAD_OUTPUT_INVALID_IMAGE_TYPE');
        continue;
      }
    }

    echo $this->_debugoutput;

    if(JRequest::getBool('redirect'))
    {
      return true;
    }

    JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
?>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=upload'); ?>">
        <?php echo JText::_('JGS_UPLOAD_MORE_UPLOADS'); ?>
      </a>
    </p>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=userpanel'); ?>">
        <?php echo JText::_('JGS_COMMON_BACK_TO_USER_PANEL') ;?>
      </a>
    </p>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=gallery'); ?>">
        <?php echo JText::_('JGS_COMMON_BACK_TO_GALLERY'); ?>
      </a>
    </p>
<?php
    return true;
  }

  /**
   * Extract images from zip
   *
   * @access  public
   * @return  boolean True on success, false otherwise.
   * @since   1.0.0
   */
  function uploadBatch()
  {
    if(!JFolder::exists($this->_ambit->get('temp_path')))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=upload&tab=batch', false), JText::_('JG_UPLOAD_ERROR_TEMP_MISSING'), 'error');
    }

    // Require zip class
    require_once(JPATH_ADMINISTRATOR.DS.'includes'.DS.'pcl'.DS.'pclzip.lib.php');

    // Check existence of uploaded zip
    $zippack = JRequest::getVar('zippack', '', 'files');
    if(!JFile::exists($zippack['tmp_name']))
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=upload&tab=batch', false), JText::_('JG_UPLOAD_ERROR_FILE_NOT_UPLOADED'), 'error');
    }

    // Make temp path writeable if it is not, workaround for servers with wwwrun-problem
    $permissions_changed = false;
    if(!is_writeable($this->_ambit->get('temp_path')))
    {
      JoomFile::chmod($this->_ambit->get('temp_path'), '0777');
      $permissions_changed = true;
    }

    // Create ZIP object, make array containing file info, and extract files to temporary location
    $zippack = $zippack['tmp_name'];
    $zipfile = new PclZip($zippack);
    $ziplist = $zipfile->extract( PCLZIP_OPT_PATH, $this->_ambit->get('temp_path'),
                                  PCLZIP_OPT_REMOVE_ALL_PATH,
                                  PCLZIP_OPT_BY_PREG, "/^(.*).((jpg)|(JPG)|(jpeg)|(JPEG)|(jpe)|(JPE)|(png)|(PNG)|(gif)|(GIF))$/");

    // Set back temp path permissions if they were changed before
    if($permissions_changed)
    {
      JoomFile::chmod($this->_ambit->get('temp_path'), '0755');
    }

    // Check error code of extraction
    if($zipfile->error_code != 1)
    {
      $this->_mainframe->redirect(JRoute::_('index.php?view=upload&tab=batch', false), $zipfile->errorInfo(true), 'error');
    }

    $sizeofzip = sizeof($ziplist);

    // For each file extracted from zip get original filename and create unique filename.
    // Copy to new location, delete file in temp. location, make thumbnail and add to database
    $this->_debugoutput .= '<hr />';
    if($sizeofzip == 1)
    {
      $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_FILE_IN_BATCH');
    }
    else
    {
      $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_FILES_IN_BATCH', $sizeofzip);
    }

    $this->_debugoutput .= '<hr />';
    usort($ziplist, array($this, 'sortBatch'));
    $ziplist = array_reverse($ziplist);

    // Counter of successfully uploaded images
    $counter = 0;

    for($i = 0; $i < $sizeofzip; $i++)
    {
      if(!$this->_adminlogged && $this->counter > $this->_config->get('jg_maxuserimage') - 1)
      {
        $this->_debugoutput .= '<hr />'.JText::sprintf('JGS_UPLOAD_OUTPUT_MAY_ADD_MAX_OF', $this->_config->get('jg_maxuserimage')).'<br />';
        break;
      }
      // Trigger event 'onJoomBeforeUpload'
      $plugins  = $this->_mainframe->triggerEvent('onJoomBeforeUpload');
      if(in_array(false, $plugins, true))
      {
        continue;
      }

      // Get the filename without path, JFile::getName() does not
      // work on local installations
      $filepathinfos  = pathinfo($ziplist[$i]['filename']);
      $origfilename   = $filepathinfos['basename'];
      $fileextension  = strtolower(JFile::getExt($origfilename));

      // Check the possible available memory for image resizing.
      // If not available echo error message and continue with next image.
      if(!$this->checkMemory($this->_ambit->get('temp_path').$origfilename, $fileextension))
      {
        $this->debug = true;
        continue;
      }

      // Check for path exploits, and replace spaces
      //if($this->_config->get('jg_useorigfilename'))
      //{
        $compacttitle = JoomFile::fixFilename($origfilename, true);
      //}
      //else
      //{
      //  $compacttitle = JoomFile::fixFilename($this->imgtitle);
      //}

      if($this->_config->get('jg_useruploadnumber'))
      {
        $picserial    = $this->_getSerial();
        $newfilename  = $this->_genFilename($compacttitle, $fileextension, $picserial);
      }
      else
      {
        $newfilename  = $this->_genFilename($compacttitle, $fileextension);
      }

      $this->_debugoutput .= '<hr />' . "\n";
      $this->_debugoutput .= JText::sprintf('JG_UPLOAD_FILENAME', $origfilename) . '<br />';
      $this->_debugoutput .= JText::sprintf('JG_UPLOAD_NEW_FILENAME', $newfilename) . '<br />';

      // Move the image from temp. folder to originals folder
      $return = JFile::move($this->_ambit->get('temp_path').$origfilename,
                            $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
      if(!$return)
      {
        $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_COPYING', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
        $this->debug        = true;
        continue;
      }

      // Set permissions to 644
      $return = JoomFile::chmod($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), '0644');
      if(!$return)
      {
        $this->_debugoutput .= $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid).' '.JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
/*
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        null,
                        null
                        );
        $this->debug        = true;
        continue;
*/
      }

      $this->_debugoutput .= JText::_('JG_UPLOAD_START') . '<br />';
      $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_UPLOAD_COMPLETE') . '<br />';

      // Create the thumb from original image
      $return = JoomFile::resizeImage($this->_debugoutput,
                                      $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                      $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid),
                                      $this->_config->get('jg_useforresizedirection'),
                                      $this->_config->get('jg_thumbwidth'),
                                      $this->_config->get('jg_thumbheight'),
                                      $this->_config->get('jg_thumbcreation'),
                                      $this->_config->get('jg_thumbquality'),
                                      false,
                                      $this->_config->get('jg_cropposition')
                                      );
      if(!$return)
      {
        $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        null,
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }
      $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED') . '<br />';

      // Create the detail image from original
      if($this->_config->get('jg_resizetomaxwidth'))
      {
        $return = JoomFile::resizeImage($this->_debugoutput,
                                        $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                                        false,
                                        $this->_config->get('jg_maxwidth'),
                                        false,
                                        $this->_config->get('jg_thumbcreation'),
                                        $this->_config->get('jg_picturequality'),
                                        true,
                                        0
                                        );
        if(!$return)
        {
          $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
        $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH') . '...<br />';
      }
      else
      {
        // Otherwise only copy the image from original to detail
        $return = JFile::copy($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                              $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));

        if(!$return)
        {
          $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
        $return = JoomFile::chmod($this->_ambit->getImg('img_path', $newfilename, null, $this->catid), '0644');
        if(!$return)
        {
          $this->_debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid).' '.JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
/*
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
*/
        }
      }

      if($this->_config->get('jg_delete_original_user') == 1 || ($this->_config->get('jg_delete_original_user') == 2 && $this->original_delete))
      {
        // Delete original if set in backend
        $return = JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
        if(!$return)
        {
          $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . ' ' . JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
          $this->rollback(null,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
       $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_ORIGINAL_DELETED') . '<br />';
      }

      $date = JFactory::getDate();

      $row = & JTable::getInstance('joomgalleryimages', 'Table');
      $data = JRequest::get('post');
      $row->load();
      if(!$row->bind($data))
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }

      // Uploads of admin/superadmin are approved
      if($this->_config->get('jg_approve') == 1 &&  !$this->_adminlogged)
      {
        $row->approved = 0;
      }
      else
      {
        $row->approved = 1;
      }

      $row->catid         = $this->catid;
      //if($this->_config->get('jg_useorigfilename'))
      //{
      //  $fileextensionlength  = strlen($fileextension);
      //  $filenamelength       = strlen($origfilename);
      //  $imgname              = substr($origfilename, -$filenamelength, -$fileextensionlength-1);
      //}
      //else
      //{
        if($this->_config->get('jg_useruploadnumber'))
        {
          $row->imgtitle = $row->imgtitle.$this->imgname_separator.$picserial;
        }
      //}

      //$row->imgauthor     = $this->photocred;
      $row->imgdate       = $date->toMySQL();
      $row->published     = $this->published;
      $row->access        = $this->access;
      $row->imgfilename   = $newfilename;
      $row->imgthumbname  = $newfilename;
      $row->useruploaded  = 1;
      $row->owner         = $this->_user->get('id');
      $row->ordering      = $this->_getOrdering($row);

      if(!$row->check())
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                               );
        $this->debug        = true;
        continue;
      }

      if(!$row->store())
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                               );
        $this->debug        = true;
        continue;
      }
      else
      {
        $this->_debugoutput .= JText::_('JGS_UPLOAD_OUTPUT_IMAGE_SUCCESSFULLY_ADDED') . '<br />';
        $this->_debugoutput .= JText::sprintf('JG_UPLOAD_NEW_FILENAME', $newfilename) . '<br /><br />';
        $counter ++;
        $this->_mainframe->triggerEvent('onJoomAfterUpload', array($row));
        $this->counter++;
      }
    }

    // Message about new images
    if($counter)
    {
      require_once(JPATH_COMPONENT.DS.'helpers'.DS.'messenger.php');
      $messenger  = new JoomMessenger();
      $message    = array(
                            'from'      => $this->_user->get('id'),
                            'subject'   => JText::_('JGS_MESSAGE_NEW_IMAGES_SUBMITTED_SUBJECT'),
                            'body'      => JText::sprintf('JGS_MESSAGE_NEW_IMAGES_SUBMITTED_BODY', $this->_user->get('username'), $counter),
                            'mode'      => 'upload'
                          );
      $messenger->send($message);
    }

    $this->_debugoutput .= '<hr /><br />';
    if(/*!*/$this->debug)
    {
      //$this->_mainframe->redirect(JRoute::_('index.php?view=upload&tab=batch', false), JText::_('JG_UPLOAD_MSG_SUCCESSFULL'));
    }

    echo $this->_debugoutput;

    JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
?>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=upload&tab=batch'); ?>">
        <?php echo JText::_('JGS_UPLOAD_MORE_UPLOADS'); ?>
      </a>
    </p>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=userpanel'); ?>">
        <?php echo JText::_('JGS_COMMON_BACK_TO_USER_PANEL') ;?>
      </a>
    </p>
    <p>
      <?php echo JHTML::_('joomgallery.icon', 'arrow.png', 'arrow'); ?>
      <a href="<?php echo JRoute::_('index.php?view=gallery'); ?>">
        <?php echo JText::_('JGS_COMMON_BACK_TO_GALLERY'); ?>
      </a>
    </p>
<?php
    return true;
  }

  /**
   * JAVA Applet upload
   *
   * @access  public
   * @return  void
   * @since   1.0.0
  */
  function uploadJava()
  {
    // The Applet recognize an error with the text 'JOOMGALLERYUPLOADERROR'
    // and shows them within an JS alert box

    // Check common requirements
    // No catid
    if(!$this->catid)
    {
      jexit('JOOMGALLERYUPLOADERROR '.JText::_('JG_UPLOAD_JUPLOAD_SELECT_CATEGORY'));
    }

    // No common title
    if(/*!$this->_config->get('jg_useorigfilename') && */!JRequest::getVar('imgtitle', '', 'post'))
    {
      jexit('JOOMGALLERYUPLOADERROR '.JText::_('JG_UPLOAD_JUPLOAD_IMAGE_MUST_HAVE_TITLE'));
    }

    // Category path
    $catpath = JoomHelper::getCatPath($this->catid);

    foreach($_FILES as $file => $fileArray)
    {
      if(!$this->_adminlogged && $this->counter > $this->_config->get('jg_maxuserimage') - 1)
      {
        $this->debug = true;
        $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_MAY_ADD_MAX_OF', $this->_config->get('jg_maxuserimage'));
        break;
      }
      // Trigger event 'onJoomBeforeUpload'
      $plugins  = $this->_mainframe->triggerEvent('onJoomBeforeUpload');
      if(in_array(false, $plugins, true))
      {
        echo 'Upload was stopped by a plugin';
        continue;
      }

      // If 'delete originals' is chosen in backend and the image
      // shall be uploaded resized this will be done locally in the applet.
      // Then, only the detail image will be uploaded,
      // therefore adjust path of destination category.
      if($this->_config->get('jg_delete_original_user') == 1 && $this->_config->get('jg_resizetomaxwidth'))
      {
        $no_original  = true;
        $picpath      = $this->_ambit->get('img_path');
      }
      else
      {
        $no_original  = false;
        $picpath      = $this->_ambit->get('orig_path');
      }

      $screenshot       = $fileArray['tmp_name'];
      $screenshot_name  = $fileArray['name'];
      $screenshot_name  = JoomFile::fixFilename($screenshot_name);
      $tag              = strtolower(JFile::getExt($screenshot_name));

      // Check the possible available memory for image resizing.
      // If not available echo error message and continue with next image.
      if(!$this->checkMemory($screenshot, $tag))
      {
        $this->debug = true;
        continue;
      }

      // Create new filename
      // If generic filename set in backend use them
      //if($this->_config->get('jg_useorigfilename'))
      //{
        $screenshot_name  = JoomFile::fixFilename($screenshot_name);
      //}
      //else
      //{
      //  $screenshot_name  = JoomFile::fixFilename($this->imgtitle);
      //}

      $newfilename        = $this->_genFilename($screenshot_name, $tag);

      // Move uploaded image in destination folder (original or details)
      if(strlen($screenshot) < 1 || $screenshot == 'none')
      {
        $this->_debugoutput .= JText::_('JG_UPLOAD_WRONG_FILENAME');
        $this->debug        = true;
        continue;
      }

      $return = JFile::upload($screenshot, $picpath.$catpath.$newfilename);
      if(!$return)
      {
        $this->_debugoutput .= JText::_('JG_UPLOAD_ERROR_UPLOADING', $picpath.$catpath.$newfilename) . '<br />';
        $this->debug        = true;
        continue;
      }

      $return = JoomFile::chmod($picpath.$catpath.$newfilename, '0644');
      if(!$return)
      {
        $this->_debugoutput .= JPath::clean($picpath.$catpath.$newfilename) . ' ' . JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
/*
        $this->rollback($picpath.$catpath.$newfilename,
                        null,
                        null
                        );
        $this->debug        = true;
        continue;
*/
      }

      // Create thumbnail
      $return = JoomFile::resizeImage($this->_debugoutput,
                                      $picpath.$catpath.$newfilename,
                                      $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid),
                                      $this->_config->get('jg_useforresizedirection'),
                                      $this->_config->get('jg_thumbwidth'),
                                      $this->_config->get('jg_thumbheight'),
                                      $this->_config->get('jg_thumbcreation'),
                                      $this->_config->get('jg_thumbquality'),
                                      false,
                                      $this->_config->get('jg_cropposition')
                                      );
      if(!$return)
      {
        $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
        $this->rollback($picpath.$catpath.$newfilename,
                        null,
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }
      $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED');

      // Create detail image.
      // Not if 'delete originals' and resize set in backend.
      // In this case the applet made the resize and uploads the detail image.
      if(!$no_original)
      {
        if(
            $this->_config->get('jg_resizetomaxwidth')
          &&
            (   !$this->create_special_gif
              ||
                ($fileextension != 'gif' && $fileextension != 'png')
            )
          )
        {
          $return = JoomFile::resizeImage($this->_debugoutput,
                                          $picpath.$catpath.$newfilename,
                                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                                          false,
                                          $this->_config->get('jg_maxwidth'),
                                          false,
                                          $this->_config->get('jg_thumbcreation'),
                                          $this->_config->get('jg_picturequality'),
                                          true,
                                          0
                                          );
          if(!$return)
          {
            $this->_debugoutput .= JText::sprintf('JGS_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->debug        = true;
            continue;
          }
          $this->_debugoutput .=  JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH')."\n";
        }
        else
        {
          $return = JFile::copy($picpath.$catpath.$newfilename,
                                $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          if(!$return)
          {
            $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->rollback($picpath.$catpath.$newfilename,
                            null,
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            continue;
          }
        }

        $return = JoomFile::chmod($this->_ambit->getImg('img_path', $newfilename, null, $this->catid), '0644');
        if(!$return)
        {
          $this->_debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid) . ' ' . JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
/*
          $this->rollback($picpath.$catpath.$newfilename,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
*/
        }
      }

      // Delete original image only if set in upload window
      // Not if set in backend
      if($this->_config->get('jg_delete_original_user') == 2 && $this->original_delete)
      {
        if(JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
        {
          $this->_debugoutput .=  JText::_('JG_UPLOAD_OUTPUT_ORIGINAL_DELETED');
        }
        else
        {
          $this->_debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid))
                                . ' ' .
                                JText::_('JGS_UPLOAD_OUTPUT_CHECK_PERMISSIONS');
          $this->rollback($picpath.$catpath.$newfilename,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
        }
      }

      $date = JFactory::getDate();

      $row = & JTable::getInstance('joomgalleryimages', 'Table');
      $data = JRequest::get('post');
      $row->load();
      if(!$row->bind($data))
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($picpath.$catpath.$newfilename,
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }

      // Uploads of admin/superadmin are approved
      if($this->_config->get('jg_approve') == 1 &&  !$this->_adminlogged)
      {
        $row->approved = 0;
      }
      else
      {
        $row->approved = 1;
      }

      $row->catid         = $this->catid;
      //if($this->_config->get('jg_useorigfilename'))
      //{
      //  $fileextensionlength  = strlen($tag);
      //  $filenamelength       = strlen($screenshot_name);
      //  $imgname              = substr($screenshot_name, -$filenamelength, -$fileextensionlength-1);
      //}
      //else
      //{
        //$row->imgtitle = $this->imgtitle;
      //}

      //$row->imgauthor     = $this->photocred;
      //$row->imgtext       = $this->gendesc;
      $row->imgdate       = $date->toMySQL();
      $row->published     = $this->published;
      $row->access        = $this->access;
      $row->imgfilename   = $newfilename;
      $row->imgthumbname  = $newfilename;
      $row->useruploaded  = 1;
      $row->owner         = $this->_user->get('id');
      $row->ordering      = $this->_getOrdering($row);

      if(!$row->check())
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($picpath.$catpath.$newfilename,
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }

      if(!$row->store())
      {
        $this->_debugoutput .= $row->getError();
        $this->rollback($picpath.$catpath.$newfilename,
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
      }
      else
      {
        $this->_mainframe->triggerEvent('onJoomAfterUpload', array($row));
        $this->counter++;
      }
    }

    /*// TODO: Message about new images (how?)
    require_once(JPATH_COMPONENT.DS.'helpers'.DS.'messenger.php');
    $messenger  = new JoomMessenger();
    $message    = array(
                          'from'      => $this->_user->get('id'),
                          'subject'   => JText::_('JGS_MESSAGE_NEW_IMAGES_SUBMITTED_SUBJECT'),
                          'body'      => JText::sprintf('JGS_MESSAGE_NEW_IMAGES_SUBMITTED_BODY', $this->_user->get('username'), $counter),
                          'mode'      => 'upload'
                        );
    $messenger->send($message);*/

    if($this->debug)
    {
      echo "JOOMGALLERYUPLOADERROR ";
    }
    else
    {
      echo "\nJOOMGALLERYUPLOADSUCCESS\n";
    }

    echo $this->_debugoutput;
    jexit();
  }

  /**
   * Generates filenames
   * e.g. <Name/gen. Title>_<opt. Filecounter>_<Date>_<Random Number>.<Extension>
   *
   * @access  protected
   * @param   string    $filename     Original upload name e.g. 'malta.jpg'
   * @param   string    $tag          File extension e.g. 'jpg'
   * @param   int       $filecounter  Optinally a filecounter
   * @return  string    The generated filename
   * @since   1.0.0
   */
  function _genFilename($filename, $tag, $filecounter = null)
  {
    $filedate = date('Ymd');

    mt_srand();
    $randomnumber = mt_rand(1000000000, 2099999999);

    // Remove filetag = $tag incl '.'
    // Only if exists in filename
    if(stristr($filename, $tag))
    {
      $filename = substr($filename, 0, strlen($filename)-strlen($tag)-1);
    }

    // New filename
    if(is_null($filecounter))
    {
      $newfilename = $filename.'_'.$filedate.'_'.$randomnumber.'.'.$tag;
    }
    else
    {
      $newfilename = $filename.'_'.$filecounter.'_'.$filedate.'_'.$randomnumber.'.'.$tag;
    }

    return $newfilename;
  }

  /**
   * Calculates the serial number for images files and title batch upload
   *
   * @access  protected
   * @return  int       New serial number
   * @since   1.0.0
   */
  function _getSerial()
  {
    static $picserial;

    // Check if the initial value is already calculated
    if(isset($picserial))
    {
      $picserial++;
      return $picserial;
    }

    // Calculate the initial value
    $picserial = 0;

    // Start value set in backend
    // No negative or 0 starting value
    $filecounter = JRequest::getInt('filecounter', 0, 'post');
    if($filecounter < 1)
    {
      $picserial = 1;
    }
    else
    {
      $picserial = $filecounter;
    }

    return $picserial;
  }

  /**
   * Sets new ordering according to $config->jg_uploadorder
   *
   * @access  protected
   * @param   object    $row  Holds the data of the new image
   * @return  int       The new ordering number
   * @since   1.0.0
   */
  function _getOrdering(&$row)
  {
    switch($this->_config->get('jg_uploadorder'))
    {
      case 1:
        $ordering = $row->getPreviousOrder('catid = '.$row->catid);
        break;
      case 2:
        $ordering = $row->getNextOrder('catid = '.$row->catid);
        break;
      default;
        $ordering = 1;
        break;
    }

    return $ordering;
  }

  /**
   * Calculates whether the memory limit is enough
   * to work on a specific image.
   *
   * @access  public
   * @param   string  $filename The filename of the image and the path to it.
   * @param   string  $format   The image file type (e.g. 'gif', 'jpg' or 'png')
   * @return  boolean True, if we have enough memory to work, false otherwise
   * @since   1.0.0
   */
  function checkMemory($filename, $format)
  {
    if((function_exists('memory_get_usage')) && (ini_get('memory_limit')))
    {
      $imageInfo = getimagesize($filename);
      $jpgpic = false;
      switch(strtoupper($format))
      {
        case 'GIF':
          // Measured factor 1 is better
          $channel = 1;
          break;
        case 'JPG':
        case 'JPEG':
        case 'JPE':
          $channel = $imageInfo['channels'];
          $jpgpic=true;
          break;
        case 'PNG':
          // No channel for png
          $channel = 3;
          break;
      }
      $MB  = 1048576;
      $K64 = 65536;

      if($this->_config->get('jg_fastgd2thumbcreation') && $jpgpic && $this->_config->get('jg_thumbcreation') == 'gd2')
      {
        // Function of fast gd2 creation needs more memory
        $corrfactor = 2.1;
      }
      else
      {
        $corrfactor = 1.7;
      }

      $memoryNeeded = round(($imageInfo[0]
                             * $imageInfo[1]
                             * $imageInfo['bits']
                             * $channel / 8
                             + $K64)
                             * $corrfactor);

      $memoryNeeded = memory_get_usage() + $memoryNeeded;
      // Get memory limit
      $memory_limit = @ini_get('memory_limit');
      if(!empty($memory_limit) && $memory_limit != 0)
      {
        $memory_limit = substr($memory_limit, 0, -1) * 1024 * 1024;
      }

      if($memory_limit != 0 && $memoryNeeded > $memory_limit)
      {
        $memoryNeededMB = round ($memoryNeeded / 1024 / 1024, 0);
        $this->_debugoutput .= JText::_('JG_UPLOAD_OUTPUT_ERROR_MEM_EXCEED').
                        $memoryNeededMB." MByte ("
                        .$memoryNeeded.") Serverlimit: "
                        .$memory_limit/$MB."MByte (".$memory_limit.")<br/>" ;
        return false;
      }
    }

    return true;
  }

  /**
   * Rollback an erroneous upload
   *
   * @access  public
   * @param   string  $original Path to original image
   * @param   string  $detail   Path to detail image
   * @param   string  $thumb    Path to thumbnail
   * @return  void
   * @since   1.0.0
   */
  function rollback($original, $detail, $thumb)
  {
    if(!is_null($original) && JFile::exists($original))
    {
      $return = JFile::delete($original);
      if($return)
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_ORGDEL_OK').'</p>';
      }
      else
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_ORGDEL_NOK').'</p>';
      }
    }

    if(!is_null($detail) && JFile::exists($detail))
    {
      $return = JFile::delete($detail);
      if($return)
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_DTLDEL_OK').'</p>';
      }
      else
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_DTLDEL_NOK').'</p>';
      }
    }

    if(!is_null($thumb) && JFile::exists($thumb))
    {
      $return = JFile::delete($thumb);
      if($return)
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_THBDEL_OK').'</p>';
      }
      else
      {
        $this->_debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_THBDEL_NOK').'</p>';
      }
    }
  }
  /**
   * Returns the number of images of the current user
   *
   * @access  public
   * @return  int     The number of images of the current user
   * @since   1.5.5
   */
  function getImageNumber()
  {
    $this->_db->setQuery("SELECT
                            COUNT(id)
                          FROM
                            "._JOOM_TABLE_IMAGES."
                          WHERE
                            owner = ".$this->_user->get('id')
                        );
    return $this->_db->loadResult();
  }

  /**
   * Callback function for sorting the array in batch upload by filename
   *
   * @TODO: Get rid of preg_replace
   *
   * @access  public
   * @param   string  $a Left content
   * @param   string  $b Right content
   * @return  int     The number which determines the new ordering
   */
  function sortBatch($a, $b)
  {
    $searchstring = '/[^0-9]/';
    $a = preg_replace($searchstring, '', $a['filename']);
    $b = preg_replace($searchstring, '', $b['filename']);
    if($a < $b)
    {
      return 1;
    }
    else
    {
      if($a > $b)
      {
        return -1;
      }
      else
      {
        return 0;
      }
    }
  }
}