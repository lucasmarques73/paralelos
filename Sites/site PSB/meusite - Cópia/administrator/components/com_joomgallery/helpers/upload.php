<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/upload.php $
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
 * Upload methods for backend
 *
 * - Batch (Zip)
 * - FTP
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
  var $debug;
  var $gentitle;
  var $gendesc;
  var $photocred;
  var $file_delete;
  var $original_delete;
  var $create_special_gif;
  var $arrscreenshot;
  var $zippack;
  var $imgname_separator;
  var $_ambit;
  var $_config;
  var $_mainframe;
  var $_user;

  /**
   * Constructor
   *
   * @access  protected
   * @param   string $task  Type of upload
   * @return  void
   * @since   1.0.0
   */
  function JoomUpload($task)
  {
    jimport('joomla.filesystem.file');

    $this->_db                = & JFactory::getDBO();
    $this->_user              = & JFactory::getUser();
    $this->_ambit             = & JoomAmbit::getInstance();
    $this->_config            = & JoomConfig::getInstance();
    $this->_mainframe         = & JFactory::getApplication('administrator');


    $this->debug              = $this->_mainframe->getUserStateFromRequest('joom.upload.debug', 'debug', false, 'post', 'bool');
    $this->debugoutput        = '';//$this->_mainframe->getUserState('joom.upload.debugoutput', 'debugoutput', '', 'post', 'string');
    $this->gentitle           = $this->_db->getEscaped($this->_mainframe->getUserStateFromRequest('joom.upload.imgtitle', 'gentitle', '', 'post'));
    $this->gendesc            = $this->fixEntry($this->_mainframe->getUserStateFromRequest('joom.upload.imgtext', 'gendesc', '', 'post'));
    $this->photocred          = $this->fixEntry($this->_mainframe->getUserStateFromRequest('joom.upload.imgauthor', 'photocred', '', 'post'));

    $this->file_delete        = JRequest::getBool('file_delete', false, 'post');
    $this->original_delete    = JRequest::getBool('original_delete', false, 'post');
    $this->create_special_gif = JRequest::getBool('create_special_gif', false, 'post');
    $this->arrscreenshot      = JRequest::getVar('arrscreenshot', '', 'files');
    $this->zippack            = JRequest::getVar('zippack', '', 'files');

    $this->catid              = $this->_mainframe->getUserStateFromRequest('joom.upload.catid', 'catid', 0, 'int');
    $this->imgname_separator  = JText::_('JGA_UPLOAD_IMAGENAME_SEPARATOR');
    if($this->imgname_separator == 'space')
    {
      $this->imgname_separator = ' ';
    }

    // TODO: maybe create option to select state before uploading
    $this->published          = 1;
    $this->access             = 0;

    switch($task)
    {
      // Single upload
      case 'uploadhandler':
        $this->uploadSingles();
        break;
      // ZIP upload
      case 'batchuploadhandler':
        $this->uploadBatch();
        break;
      // FTP upload
      case 'ftpuploadhandler':
        $this->uploadFTP();
        break;
      // JAVA upload
      case 'juploadhandler_receive':
        $this->appletReceive();
        break;
      default:
        jexit('JOOMGALLERYUPLOADERROR Wrong Task');
        break;
    }
  }

  /**
   * Single upload
   *
   * Up to 10 images are chosen and uploaded afore.
   *
   * @access  public
   * @return  void
   * @since   1.0.0
   */
  function uploadSingles()
  {
    for($i = 0; $i < count($this->arrscreenshot['error']); $i++)
    {
      $this->debugoutput .= '<hr />';
      $pos = $i+1;
      $this->debugoutput .= JText::sprintf('JGA_UPLOAD_POSITION', $pos) . '<br />';
      // Any image entry at position?
      // (4=UPLOAD_ERR_NO_FILE constant since PHP 4.3.0)
      // If not continue with next entry
      if($this->arrscreenshot['error'][$i] == 4)
      {
        $this->debugoutput .= JText::_('JG_UPLOAD_ERROR_FILE_NOT_UPLOADED').'<br />';
        continue;
      }
      // Check all other error codes except UPLOAD_ERR_NO_FILE
      if($this->arrscreenshot["error"][$i] > 0)
      {
        $this->debugoutput .= $this->checkError($this->arrscreenshot["error"][$i]).'<br />';
        $this->debug        = true;
        continue;
      }

      $screenshot         = $this->arrscreenshot["tmp_name"][$i];
      $screenshot_name    = $this->arrscreenshot["name"][$i];
      $screenshot_name    = JoomFile::fixFilename($screenshot_name);
      $this->debugoutput .= $screenshot_name . '<br />';

      $tag = strtolower(JFile::getExt($screenshot_name));

      // Check the possible available memory for image resizing.
      // If not available echo error message and continue with next image.
      if(!$this->checkMemory($screenshot, $tag))
      {
        $this->debug = true;
        continue;
      }

      // Create new filename
      // If generic filename set in backend use them
      if($this->_config->get('jg_useorigfilename'))
      {
        $screenshot_name = JoomFile::fixFilename($screenshot_name);
      }
      else
      {
        $screenshot_name = JoomFile::fixFilename($this->gentitle);
      }

      $newfilename = $this->_genFilename($screenshot_name, $tag);

      // Move uploaded image to originals
      if((($tag == 'jpeg') || ($tag == 'jpg') || ($tag == 'jpe') || ($tag == 'gif') || ($tag == 'png'))
          && strlen($screenshot) > 0 && $screenshot != 'none')
      {
        $return = JFile::upload($screenshot, $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
        if(!$return)
        {
          $this->debugoutput .= JText::sprintf('JG_UPLOAD_ERROR_UPLOADING', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . '<br />';
          $this->debug        = true;
          continue;
        }

        $return = JoomFile::chmod($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), '0644');
        if(!$return)
        {
          $this->debugoutput .= $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid) . ' ' . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          null
                          );
          $this->debug        = true;
          continue;
        }

        // Create thumbnail
        $return = JoomFile::resizeImage($this->debugoutput,
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
          $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          null
                          );
          $this->debug        = true;
          continue;
        }
        $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED') . '<br />';

        // Optionally create detail image
        if(
            $this->_config->get('jg_resizetomaxwidth')
          &&
            (   !$this->create_special_gif
              ||
                ($tag != 'gif' && $tag != 'png')
            )
          )
        {
          $return = JoomFile::resizeImage($this->debugoutput,
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
            $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            null,
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            continue;
          }
          $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH') . '...<br />';
        }
        else
        {
          $return = JFile::copy($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                                $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          if(!$return)
          {
            $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            null,
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            continue;
          }

          $return = JoomFile::chmod($this->_ambit->getImg('img_path', $newfilename, null, $this->catid),'0644');
          if(!$return)
          {
            $this->debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid).' '.JText::_('JGA_COMMON_CHECK_PERMISSIONS');
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            continue;
          }
        }

        if($this->_config->get('jg_delete_original') == 1 || ($this->_config->get('jg_delete_original') == 2 && $this->original_delete))
        {
          // Remove image from originals if chosen in backend
          if(JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
          {
            $this->debugoutput .= JText::_('JGA_UPLOAD_OUTPUT_ORIGINAL_DELETED') . '<br />';
          }
          else
          {
            $this->debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid))
                         . ' '
                         . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
            $this->rollback(null,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );

            $this->debug        = true;
            continue;
          }
        }

        if($this->_config->get('jg_useorigfilename'))
        {
          $fileextensionlength  = strlen($tag);
          $filenamelength       = strlen($screenshot_name);
          $imgname              = substr($screenshot_name, -$filenamelength, -$fileextensionlength-1);
        }
        else
        {
          $imgname = $this->gentitle;
        }

        $date = JFactory::getDate();

        $row = & JTable::getInstance('joomgalleryimages', 'Table');
        $row->load();

        $row->catid         = $this->catid;
        $row->imgtitle      = $imgname;
        $row->imgauthor     = $this->photocred;
        $row->imgtext       = $this->gendesc;
        $row->imgdate       = $date->toMySQL();
        $row->published     = $this->published;
        $row->access        = $this->access;
        $row->imgfilename   = $newfilename;
        $row->imgthumbname  = $newfilename;
        $row->owner         = $this->_user->get('id');
        $row->approved      = 1;
        $row->ordering      = $this->_getOrdering($row);

        if(!$row->check())
        {
          $this->debugoutput .= $row->getError();
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                                 );
          $this->debug        = true;
          continue;
        }

        if(!$row->store())
        {
          $this->debugoutput .= $row->getError();
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
      }
      else
      {
        $this->debugoutput .= JText::_('JG_UPLOAD_WRONG_FILENAME');
        $this->debug        = true;
        continue;
      }
    }

    if(!$this->debug)
    {
      if($redirect = JRequest::getVar('redirect', '', '', 'base64'))
      {
        $url  = base64_decode($redirect);
        if(JURI::isInternal($url))
        {
          $msg  = JText::_('JG_UPLOAD_MSG_SUCCESSFULL');
          $this->_mainframe->redirect(JRoute::_($url, false), $msg);
        }
      }

      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JG_UPLOAD_MSG_SUCCESSFULL'));
    }
    else
    {
      echo $this->debugoutput;
    }
  }

  /**
   * Extract images from zip
   *
   * @access  public
   * @return  void
   * @since   1.0.0
   */
  function uploadBatch()
  {
    if(!JFolder::exists($this->_ambit->get('temp_path')))
    {
      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JG_UPLOAD_ERROR_TEMP_MISSING'), 'error');
    }

    // Require zip class
    require_once(JPATH_ADMINISTRATOR.DS.'includes'.DS.'pcl'.DS.'pclzip.lib.php');

    // Check existence of uploaded zip
    if(!JFile::exists($this->zippack['tmp_name']))
    {
      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JG_UPLOAD_ERROR_FILE_NOT_UPLOADED'), 'error');
    }

    // Make temp path writeable if it is not, workaround for servers with wwwrun-problem
    $permissions_changed = false;
    if(!is_writeable($this->_ambit->get('temp_path')))
    {
      JoomFile::chmod($this->_ambit->get('temp_path'), '0777');
      $permissions_changed = true;
    }

    // Create ZIP object, make array containing file info, and extract files to temporary location
    $this->zippack = $this->zippack['tmp_name'];
    $zipfile = new PclZip($this->zippack);
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
      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), $zipfile->errorInfo(true), 'error');
    }

    $sizeofzip = sizeof($ziplist);

    // For each file extracted from zip get original filename and create unique filename.
    // Copy to new location, delete file in temp. location, make thumbnail and add to database.
    $this->debugoutput .= '<hr />';
    if($sizeofzip == 1)
    {
      $this->debugoutput .= JText::_('JGA_UPLOAD_OUTPUT_FILE_IN_BATCH');
    }
    else
    {
      $this->debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_FILES_IN_BATCH', $sizeofzip);
    }
    $this->debugoutput .= '<hr />';
    usort($ziplist, array($this, 'sortBatch'));
    $ziplist = array_reverse($ziplist);

    for($i = 0; $i < $sizeofzip; $i++)
    {
      // Get the filename without path, JFile::getName() does not
      // work on local installations
      $filepathinfos  = pathinfo($ziplist[$i]['filename']);
      $origfilename   = $filepathinfos['basename'];
      $fileextension  = strtolower(JFile::getExt($origfilename));

      // Check the possible available memory for image resizing.
      // If not available echo error message and continue with next image
      if(!$this->checkMemory($this->_ambit->get('temp_path').$origfilename, $fileextension))
      {
        $this->debug = true;
        continue;
      }

      // Get the serial number if use of original name is deactivated
      // and numbering is activated
      if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber'))
      {
        $picserial = $this->_getSerial();
      }

      // Check for path exploits, and replace spaces
      if($this->_config->get('jg_useorigfilename'))
      {
        $compacttitle = JoomFile::fixFilename($origfilename,1);
      }
      else
      {
        $compacttitle = JoomFile::fixFilename($this->gentitle);
      }

      if($this->_config->get('jg_filenamenumber'))
      {
        $newfilename = $this->_genFilename($compacttitle, $fileextension, $picserial);
      }
      else
      {
        $newfilename = $this->_genFilename($compacttitle, $fileextension);
      }

      $this->debugoutput .= '<hr />' . "\n";
      $this->debugoutput .= JText::sprintf('JG_UPLOAD_FILENAME', $origfilename) . '<br />';
      $this->debugoutput .= JText::sprintf('JG_UPLOAD_NEW_FILENAME', $newfilename) . '<br />';

      // Move the image from temp. folder to originals folder
      $return = JFile::move($this->_ambit->get('temp_path').$origfilename,
                            $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));


      if(!$return)
      {
        $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
        $this->debug        = true;
        continue;
      }

      // Set permissions to 644
      $return = JoomFile::chmod($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), '0644');
      if(!$return)
      {
        $this->debugoutput .= $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid).' '.JText::_('JGA_COMMON_CHECK_PERMISSIONS').'<br/>';
/*
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        null,
                        null
                        );
        $this->debug        = true;
        continue;
*/
      }

      $this->debugoutput .= JText::_('JG_UPLOAD_START') . '<br />';
      $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_UPLOAD_COMPLETE') . '<br />';

      // Create the thumb from original image
      $return = JoomFile::resizeImage($this->debugoutput,
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
        $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        null,
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        continue;
      }
      $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED') . '<br />';

      // Create the detail image from original
      if($this->_config->get('jg_resizetomaxwidth'))
      {
        $return = JoomFile::resizeImage($this->debugoutput,
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
          $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
          $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                          null,
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
        $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH') . '...<br />';
      }
      else
      {
        // Otherwise only copy the image from original to detail
        $return = JFile::copy($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                              $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));

        if(!$return)
        {
          $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
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
          $this->debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid).' '.JText::_('JGA_COMMON_CHECK_PERMISSIONS').'<br/>';
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

      if($this->_config->get('jg_delete_original') == 1 || ($this->_config->get('jg_delete_original') == 2 && $this->original_delete))
      {
        // Delete original if chosen
        $return = JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
        if(!$return)
        {
          $this->debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . ' ' . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
          $this->rollback(null,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
       $this->debugoutput .= JText::_('JGA_UPLOAD_OUTPUT_ORIGINAL_DELETED') . '<br />';
      }

      if($this->_config->get('jg_useorigfilename'))
      {
        $fileextensionlength  = strlen($fileextension);
        $filenamelength       = strlen($origfilename);
        $imgname              = substr($origfilename, -$filenamelength, -$fileextensionlength-1);
      }
      else
      {
        if($this->_config->get('jg_filenamenumber') == 1)
        {
          $imgname = $this->gentitle.$this->imgname_separator.$picserial;
        }
        else
        {
          $imgname = $this->gentitle;
        }
      }

      $date = JFactory::getDate();

      $row = & JTable::getInstance('joomgalleryimages', 'Table');
      $row->load();

      $row->catid         = $this->catid;
      $row->imgtitle      = $imgname;
      $row->imgauthor     = $this->photocred;
      $row->imgtext       = $this->gendesc;
      $row->imgdate       = $date->toMySQL();
      $row->published     = $this->published;
      $row->access        = $this->access;
      $row->imgfilename   = $newfilename;
      $row->imgthumbname  = $newfilename;
      $row->owner         = $this->_user->get('id');
      $row->approved      = 1;
      $row->ordering      = $this->_getOrdering($row);

      if(!$row->check())
      {
        $this->debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                               );
        $this->debug        = true;
        continue;
      }

      if(!$row->store())
      {
        $this->debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                               );
        $this->debug        = true;
        continue;
      }
    }

    $this->debugoutput .= '<hr /><br />' . "\n";
    if(!$this->debug)
    {
      if($redirect = JRequest::getVar('redirect', '', 'method', 'base64'))
      {
        $url  = base64_decode($redirect);
        if(JURI::isInternal($url))
        {
          $msg  = JText::_('JG_UPLOAD_MSG_SUCCESSFULL');
          $this->_mainframe->redirect(JRoute::_($url, false), $msg);
        }
      }

      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JG_UPLOAD_MSG_SUCCESSFULL'));
    }
    else
    {
      echo $this->debugoutput;
    }
  }

  /**
   * FTP Upload
   * Several images uploaded via FTP before are moved to a category
   *
   * @access  public
   * @return  void
   * @since   1.0.0
  */
  function uploadFTP()
  {
    $subdirectory = $this->_db->getEscaped($this->_mainframe->getUserStateFromRequest('joom.upload.ftp.subdirectory', 'subdirectory', DS, 'post', 'string'));
    $ftpfiles     = $this->_mainframe->getUserStateFromRequest('joom.upload.ftp.files', 'ftpfiles', array(), 'array');

    if(!$ftpfiles && JRequest::getBool('ftpfiles'))
    {
      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JGA_COMMON_MSG_NO_IMAGES_SELECTED'), 'notice');
    }

    // Load the refresher
    require_once JPATH_COMPONENT.DS.'helpers'.DS.'refresher.php';
    $refresher = new JoomRefresher(array('remaining' => count($ftpfiles), 'start' => JRequest::getBool('ftpfiles')));

    foreach($ftpfiles as $key => $screenshot_name)
    {
      // Check remaining time
      if(!$refresher->check())
      {
        $this->_mainframe->setUserState('joom.upload.ftp.files', $ftpfiles);
        //$this->_mainframe->setUserState('joom.upload.debugoutput', $this->debugoutput);
        $this->_mainframe->setUserState('joom.upload.debug', $this->debug);
        $refresher->refresh(count($ftpfiles));
      }

      $fileextension = strtolower(JFile::getExt($screenshot_name));

      if($this->_config->get('jg_useorigfilename'))
      {
        $compacttitle = JoomFile::fixFilename($screenshot_name, 1);
      }
      else
      {
        $compacttitle = JoomFile::fixFilename($this->gentitle);
      }

      // Check the possible available memory for image resizing.
      // If not available echo error message and continue with next image.
      if(!$this->checkMemory(JPath::clean($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name), $fileextension))
      {
        $this->debug = true;
        unset($ftpfiles[$key]);
        continue;
      }

      if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber'))
      {
        // Get the serial number if use of original name is deactivated
        // and numbering is activated
        $picserial    = $this->_getSerial();
        $newfilename  = $this->_genFilename($compacttitle, $fileextension, $picserial);
      }
      else
      {
        $newfilename = $this->_genFilename($compacttitle, $fileextension);
      }

      $this->debugoutput .= '<p />';
      $this->debugoutput .= $screenshot_name . '<br />';

      // Create thumbnail
      $return = JoomFile::resizeImage($this->debugoutput,
                                      $this->_ambit->get('ftp_path').$subdirectory.$screenshot_name,
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
        $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)).'<br />';
        $this->debug        = true;
        unset($ftpfiles[$key]);
        continue;
      }

      $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED') . '<br />';

      // Create detail image only if jpg and maxwidth set
      if(
          $this->_config->get('jg_resizetomaxwidth')
        &&
          (   !$this->create_special_gif
            ||
              ($fileextension != 'gif' && $fileextension != 'png')
          )
        )
      {
        $return = JoomFile::resizeImage($this->debugoutput,
                                        $this->_ambit->get('ftp_path').$subdirectory.$screenshot_name,
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
          $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid)) . '<br />';
          $this->rollback(null,
                          null,
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          unset($ftpfiles[$key]);
          continue;
        }

        $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH') . '...<br />';
      }
      else
      {
        // Otherwise only copy the image
        $return = JFile::copy(JPath::clean($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name),
                              $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));

        if(!$return)
        {
          $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', JPath::clean($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name));
          $this->debug        = true;
          unset($ftpfiles[$key]);
          continue;
        }
        $return = JoomFile::chmod($this->_ambit->getImg('img_path', $newfilename, null, $this->catid), '0644');
        if(!$return)
        {
          $this->debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid).': '.JText::_('JGA_COMMON_CHECK_PERMISSIONS');
          $this->rollback(null,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          unset($ftpfiles[$key]);
          continue;
        }
      }

      // Copy or move image in originals?
      if(!(
            $this->_config->get('jg_delete_original') == 1
          ||
            (
              $this->_config->get('jg_delete_original') == 2
            &&
              $this->original_delete
            )
          )
        )
      {
        // Create original image file in original.
        // If file has to be deleted from upload directory move it to originals
        if($this->file_delete)
        {
          if(!JFile::move(JPath::clean($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name),
                          $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
          {
            $this->debugoutput .= JText::sprintf('JGA_UPLOAD_COULD_NOT_DELETE_IMAGE', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)) . '<br />';
            $this->rollback(null,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            unset($ftpfiles[$key]);
            continue;
          }

          $return = JoomFile::chmod($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), '0644');
          if(!$return)
          {
            $this->debugoutput .= $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid).': '.JText::_('JGA_COMMON_CHECK_PERMISSIONS');
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            unset($ftpfiles[$key]);
            continue;
          }
        }
        else
        {
          // Otherwise copy them into originals
          $return = JFile::copy(JPath::clean($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name),
                                $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
          if(!$return)
          {
            $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid));
            $this->rollback(null,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            unset($ftpfiles[$key]);
            continue;
          }
          $return = JoomFile::chmod($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid), '0644');
          if(!$return)
          {
            $this->debugoutput .= $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid).' '.JText::_('JGA_COMMON_CHECK_PERMISSIONS');
            $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            unset($ftpfiles[$key]);
            continue;
          }
        }
      }
      else
      {
        // Original image shall not be created
        // Optionally delete it from upload directory
        if($this->file_delete)
        {
          if(!JFile::delete($this->_ambit->get('ftp_path').$subdirectory.$screenshot_name))
          {
            $this->debugoutput .= JText::_('JGA_UPLOAD_COULD_NOT_DELETE_IMAGE') . '<br />';
            $this->rollback(null,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
            unset($ftpfiles[$key]);
            continue;
          }
          else
          {
            $this->debugoutput .= JText::_('JGA_UPLOAD_OUTPUT_ORIGINAL_DELETED') . '<br />';
          }
        }
      }

      if($this->_config->get('jg_useorigfilename'))
      {
        $fileextensionlength  = strlen($fileextension);
        $filenamelength       = strlen($screenshot_name);
        $imgname              = substr($screenshot_name, -$filenamelength, -$fileextensionlength-1);
      }
      else
      {
        if($this->_config->get('jg_filenamenumber') == 1)
        {
          $imgname = $this->gentitle.$this->imgname_separator.$picserial;
        }
        else
        {
          $imgname = $this->gentitle;
        }
      }

      $date = JFactory::getDate();

      $row = & JTable::getInstance('joomgalleryimages', 'Table');
      $row->load();

      $row->catid         = $this->catid;
      $row->imgtitle      = $imgname;
      $row->imgauthor     = $this->photocred;
      $row->imgtext       = $this->gendesc;
      $row->imgdate       = $date->toMySQL();
      $row->published     = $this->published;
      $row->access        = $this->access;
      $row->imgfilename   = $newfilename;
      $row->imgthumbname  = $newfilename;
      $row->owner         = $this->_user->get('id');
      $row->approved      = 1;
      $row->ordering      = $this->_getOrdering($row);

      if(!$row->check())
      {
        $this->debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                               );
        $this->debug        = true;
        unset($ftpfiles[$key]);
        continue;
      }

      if(!$row->store())
      {
        $this->debugoutput .= $row->getError();
        $this->rollback($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                        $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                        );
        $this->debug        = true;
        unset($ftpfiles[$key]);
        continue;
      }

      unset($ftpfiles[$key]);
    }

    $this->debugoutput .= '<hr /><br />';
    if(!$this->debug)
    {
      if($redirect = JRequest::getVar('redirect', '', 'method', 'base64'))
      {
        $url  = base64_decode($redirect);
        if(JURI::isInternal($url))
        {
          $msg  = JText::_('JG_UPLOAD_MSG_SUCCESSFULL');
          $this->_mainframe->redirect(JRoute::_($url, false), $msg);
        }
      }

      $this->_mainframe->redirect($this->_ambit->getRedirectUrl(), JText::_('JG_UPLOAD_MSG_SUCCESSFULL'));
    }
    else
    {
      echo $this->debugoutput;
    }
  }

  /**
   * JAVA Applet upload
   *
   * @access  public
   * @return  void
   * @since   1.0.0
  */
  function appletReceive()
  {
    // If the applet checks for the serverProtocol, it issues a HEAD request
    // -> Simply return an empty doc.
    if ($_SERVER['REQUEST_METHOD'] == 'HEAD')
    {
      jexit();
    }

    // The Applet recognize an error with the text 'JOOMGALLERYUPLOADERROR'
    // and shows them within an JS alert box

    // Check common requirements
    // No catid
    if($this->catid == 0)
    {
      jexit('JOOMGALLERYUPLOADERROR '.JText::_('JGA_JUPLOAD_YOU_MUST_SELECT_CATEGORY'));
    }
    // No common title
    if(!$this->_config->get('jg_useorigfilename') && !$this->gentitle)
    {
      jexit('JOOMGALLERYUPLOADERROR '.JText::_('JG_UPLOAD_JUPLOAD_IMAGE_MUST_HAVE_TITLE'));
    }

    // Category path
    $catpath = JoomHelper::getCatPath($this->catid);

    foreach($_FILES as $file => $fileArray)
    {
      // If 'delete originals' chosen in backend and the image
      // shall be uploaded resized this will be done locally in the applet.
      // Then, only the detail image will be uploaded,
      // therefore adjust path of destination category.
      if($this->_config->get('jg_delete_original') == 1 && $this->_config->get('jg_resizetomaxwidth'))
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
      if($this->_config->get('jg_useorigfilename'))
      {
        $screenshot_name  = JoomFile::fixFilename($screenshot_name);
      }
      else
      {
        $screenshot_name  = JoomFile::fixFilename($this->gentitle);
      }

      $newfilename        = $this->_genFilename($screenshot_name, $tag);

      // Move uploaded image in destination folder (original or details)
      if(strlen($screenshot) > 0 && $screenshot != 'none')
      {
        $return = JFile::upload($screenshot, $picpath.$catpath.$newfilename);
        if(!$return)
        {
          $this->debugoutput .= JText::sprintf('JG_UPLOAD_ERROR_UPLOADING', $picpath.$catpath.$newfilename) . '<br />';
          $this->debug        = true;
          continue;
        }

        $return = JoomFile::chmod($picpath.$catpath.$newfilename, '0644');
        if(!$return)
        {
          $this->debugoutput .= JPath::clean($picpath.$catpath.$newfilename) . ' ' . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
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
        $return = JoomFile::resizeImage($this->debugoutput,
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
          $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_THUMBNAIL_NOT_CREATED', $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid));
          $this->rollback($picpath.$catpath.$newfilename,
                          null,
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }
        $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_THUMBNAIL_CREATED');

        // Optionally create detail image.
        // Not if 'delete originals' and resize set in backend
        // In this case the applet made the resize and uploads the detail image
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
            $return = JoomFile::resizeImage($this->debugoutput,
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
              $this->debugoutput .= JText::sprintf('JGA_UPLOAD_OUTPUT_IMG_NOT_CREATED', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
              $this->debug        = true;
              continue;
            }
            $this->debugoutput .=  JText::_('JG_UPLOAD_OUTPUT_RESIZED_TO_MAXWIDTH')."\n";
          }
          else
          {
            $return = JFile::copy($picpath.$catpath.$newfilename,
                                  $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
            if(!$return)
            {
              $this->debugoutput .= JText::sprintf('JG_UPLOAD_PROBLEM_COPYING', $this->_ambit->getImg('img_path', $newfilename, null, $this->catid));
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
            $this->debugoutput .= $this->_ambit->getImg('img_path', $newfilename, null, $this->catid) . ' ' . JText::_('JGA_COMMON_CHECK_PERMISSIONS');
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

        // Delete original image only if set in upload window.
        // Not if set in backend.
        if($this->_config->get('jg_delete_original') == 2 && $this->original_delete)
        {
          if(JFile::delete($this->_ambit->getImg('orig_path', $newfilename, null, $this->catid)))
          {
            $this->debugoutput .=  JText::_('JGA_UPLOAD_OUTPUT_ORIGINAL_DELETED');
          }
          else
          {
            $this->debugoutput .= JText::sprintf('JG_UPLOAD_OUTPUT_PROBLEM_DELETING_ORIGINAL', $this->_ambit->getImg('orig_path', $newfilename, null, $this->catid))
                                  . ' ' .
                                  JText::_('JGA_COMMON_CHECK_PERMISSIONS');
            $this->rollback($picpath.$catpath.$newfilename,
                            $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                            $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                            );
            $this->debug        = true;
          }
        }

        if($this->_config->get('jg_useorigfilename'))
        {
          $fileextensionlength  = strlen($tag);
          $filenamelength       = strlen($screenshot_name);
          $imgname              = substr($screenshot_name, -$filenamelength, -$fileextensionlength-1);
        }
        else
        {
          $imgname = $this->gentitle;
        }

        $date = JFactory::getDate();

        $row = & JTable::getInstance('joomgalleryimages', 'Table');
        $row->load();

        $row->catid         = $this->catid;
        $row->imgtitle      = $imgname;
        $row->imgauthor     = $this->photocred;
        $row->imgtext       = $this->gendesc;
        $row->imgdate       = $date->toMySQL();
        $row->published     = $this->published;
        $row->access        = $this->access;
        $row->imgfilename   = $newfilename;
        $row->imgthumbname  = $newfilename;
        $row->owner         = $this->_user->get('id');
        $row->approved      = 1;
        $row->ordering      = $this->_getOrdering($row);

        if(!$row->check())
        {
          $this->debugoutput .= $row->getError();
          $this->rollback($picpath.$catpath.$newfilename,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
          continue;
        }

        if(!$row->store())
        {
          $this->debugoutput .= $row->getError();
          $this->rollback($picpath.$catpath.$newfilename,
                          $this->_ambit->getImg('img_path', $newfilename, null, $this->catid),
                          $this->_ambit->getImg('thumb_path', $newfilename, null, $this->catid)
                          );
          $this->debug        = true;
        }
      }
      else
      {
        $this->debugoutput .= JText::_('JG_UPLOAD_WRONG_FILENAME');
        $this->debug        = true;
      }
    }

    if ($this->debug)
    {
      echo("\nJOOMGALLERYUPLOADERROR\n");
    }
    else
    {
      echo "\nJOOMGALLERYUPLOADSUCCESS\n";
    }

    echo $this->debugoutput;
    jexit();
  }

  /**
   * Generates filenames
   * e.g. <Name/gen. Title>_<opt. Filecounter>_<Date>_<Random Number>.<Extension>
   *
   * @access  protected
   * @param   string    $filename     Original upload name e.g. 'malta.jpg'
   * @param   string    $tag          File extension e.g. 'jpg'
   * @param   int       $filecounter  Optionally a filecounter
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

      // Store the next value in the session
      $this->_mainframe->setUserState('joom.upload.filecounter', $picserial + 1);

      return $picserial;
    }

    // Calculate the initial value
    $picserial = 0;

    // Start value set in backend
    // No negative or 0 starting value
    $filecounter = $this->_mainframe->getUserStateFromRequest('joom.upload.filecounter', 'filecounter', 0, 'post', 'int');
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
   * Analyses an error code and outputs its text
   *
   * @access  public
   * @param   int     $uploaderror  The errorcode
   * @return  void
   * @since   1.0.0
   */
  function checkError($uploaderror)
  {
    // Common PHP errors
    $uploadErrors = array(
      1 => JText::_('JGA_UPLOAD_ERROR_PHP_MAXFILESIZE'),
      2 => JText::_('JGA_UPLOAD_ERROR_HTML_MAXFILESIZE'),
      3 => JText::_('JGA_UPLOAD_ERROR_FILE_PARTLY_UPLOADED')
    );

    if(in_array($uploaderror, $uploadErrors))
    {
      echo JText::_('JGA_UPLOAD_ERROR_CODE') . $uploadErrors[$uploaderror] . '<br />';
    }
    else
    {
      echo JText::_('JGA_UPLOAD_ERROR_CODE') . JText::_('JGA_UPLOAD_ERROR_UNKNOWN') . ' <br />';
    }
  }

  /**
   * Calculates whether the memory limit is enough great
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
      $imageInfo  = getimagesize($filename);
      $jpgpic     = false;
      switch(strtoupper($format))
      {
        case 'GIF':
          // Measured factor 1 is better
          $channel  = 1;
          break;
        case 'JPG':
        case 'JPEG':
        case 'JPE':
          $channel  = $imageInfo['channels'];
          $jpgpic   = true;
          break;
        case 'PNG':
          // No channel for png
          $channel  = 3;
          break;
      }

      $MB   = 1048576;
      $K64  = 65536;

      if($this->_config->get('jg_fastgd2thumbcreation')
        && $jpgpic
        && $this->_config->get('jg_thumbcreation') == 'gd2')
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
        $this->debugoutput .= JText::_('JG_UPLOAD_OUTPUT_ERROR_MEM_EXCEED').
                        $memoryNeededMB." MByte ("
                        .$memoryNeeded.") Serverlimit: "
                        .$memory_limit/$MB."MByte (".$memory_limit.")<br/>";
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
      if(JFile::delete($original))
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_ORGDEL_OK').'</p>';
      }
      else
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_ORGDEL_NOK').'</p>';
      }
    }

    if(!is_null($detail) && JFile::exists($detail))
    {
      if(JFile::delete($detail))
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_DTLDEL_OK').'</p>';
      }
      else
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_DTLDEL_NOK').'</p>';
      }
    }

    if(!is_null($thumb) && JFile::exists($thumb))
    {
      if(JFile::delete($thumb))
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_THBDEL_OK').'</p>';
      }
      else
      {
        $this->debugoutput .= '<p>'.JText::_('JG_UPLOAD_OUTPUT_RB_THBDEL_NOK').'</p>';
      }
    }
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

  /**
   * Modify text
   * 1. trim spaces
   * 2. strip all html tags
   * 3. convert to htl entities
   * 4. escape them
   *
   * @ TODO: Is there a wrapper of JRequest::getVar() which does the same?
   *
   * @param   string  $text
   * @return  string  modified text
   */
  function fixEntry($text)
  {
    $text = trim($text);

    if($text)
    {
      $text = strip_tags($text);
      $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
      $text = $this->_db->getEscaped($text);
    }

    return $text;
  }
}
