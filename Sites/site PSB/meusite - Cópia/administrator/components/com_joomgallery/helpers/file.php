<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/file.php $
// $Id: file.php 2566 2010-11-03 21:10:42Z mab $
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
 * JoomGallery File Class
 *
 * @static
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomFile
{
  /**
   * Cleaning of file/category name
   * optionally replace extension if present
   * replace special chars defined in backend
   *
   * @param   string  $orig               The original filename
   * @param   boolean $replace_extension  True for stripping the extension
   * @return  string  Cleaned name (with or without extension)
   * @since   1.0.0
   */
  function fixFilename($orig, $replace_extension = false)
  {
    $config = & JoomConfig::getInstance();

    $orig = strtolower(basename($orig));

    // Replace special chars
    $filenamesearch = $config->get('jg_filenamesearch');
    if(!empty($filenamesearch))
    {
      $filenamesearch  = explode("|", $config->get('jg_filenamesearch'));
    }
    else
    {
      $filenamesearch = array();
    }

    $filenamereplace = $config->get('jg_filenamereplace');
    if(!empty($filenamereplace))
    {
      $filenamereplace = explode("|", $config->get('jg_filenamereplace'));
    }
    else
    {
      $filenamereplace = array();
    }

    // Replace whitespace with underscore
    array_push($filenamesearch, '\s');
    array_push($filenamereplace, '_');
    // Replace other stuff
    array_push($filenamesearch, '[^a-z_0-9-]');
    array_push($filenamereplace, '');

    // Checks for different array-length
    $lengthsearch  = count($filenamesearch);
    $lengthreplace = count($filenamereplace);
    if($lengthsearch > $lengthreplace)
    {
      while($lengthsearch > $lengthreplace)
      {
        array_push($filenamereplace, '');
        $lengthreplace = $lengthreplace + 1;
      }
    }
    else
    {
      if($lengthreplace > $lengthsearch)
      {
        while($lengthreplace > $lengthsearch)
        {
          array_push($filenamesearch, '');
          $lengthsearch = $lengthsearch + 1;
        }
      }
    }

    // Checks for extension
    $extensions = array('.jpeg','.jpg','.jpe','.gif','.png');
    $extension  = false;
    for($i = 0; $i < count($extensions); $i++)
    {
      $extensiontrue = substr_count($orig, $extensions[$i]);
      if($extensiontrue !=0 )
      {
        $extension = true;
        // If extension found, break
        break;
      }
    }
    // Replace extension if present
    if($extension)
    {
      $fileextension        = JFile::getExt($orig);
      $fileextensionlength  = strlen($fileextension);
      $filenamelength       = strlen($orig);
      $filename             = substr($orig, -$filenamelength, -$fileextensionlength - 1);
     // No extension found (Batchupload)
    }
    else
    {
      $filename = $orig;
    }
    for($i = 0; $i < $lengthreplace; $i++)
    {
      $searchstring = '!'.$filenamesearch[$i].'+!i';
      $filename     = preg_replace($searchstring, $filenamereplace[$i], $filename);
    }
    if($extension && !$replace_extension)
    {
      // Return filename with extension for regular upload
      return $filename.'.'.$fileextension;
    }
    else
    {
      // Return filename without extension for batchupload
      return $filename;
    }
  }

  /**
   * If an image is not readable for getimagesize
   * we set the rights of this image to 777
   * and back to 644 afterwards
   *
   * @TODO This function will probably be never necessary
   *
   * @param   string  $file The file from which we want the information
   * @return  array   The image info or boolean false if an error occured
   * @since   1.5.0
   */
  function getImageSize($file)
  {
    // Ensure that path is valid and clean
    $file = JPath::clean($file);

    // Maybe it works without changes
    $info = getimagesize($file);
    if($info)
    {
      return $info;
    }

    // Initialize variables
    static $ftpOptions;
    if(!isset($ftpOptions))
    {
      jimport('joomla.client.helper');
      $ftpOptions = JClientHelper::getCredentials('ftp'); 
    } 

    if ($ftpOptions['enabled'] == 1)
    {
      // Connect the FTP client
      jimport('joomla.client.ftp');
      $ftp = &JFTP::getInstance(
        $ftpOptions['host'], $ftpOptions['port'], null,
        $ftpOptions['user'], $ftpOptions['pass']
      );

      // Translate path to FTP path
      $ftp_file = JPath::clean(str_replace(JPATH_ROOT, $ftpOptions['root'], $file), '/');
      $ftp->chmod($ftp_file, 0777);

      $info = getimagesize($file);

      $ftp->chmod($ftp_file, 0644);
    }
    else
    {
      JPath::setPermissions($file, 0777);

      $info = getimagesize($file);

      JPath::setPermissions($file, 0644);
    }

    return $info;
  }

  /**
   * Changes the permissions of a directory (or file)
   * either by the FTP-Layer if enabled
   * or by JPath::setPermissions (chmod()).
   *
   * Not sure but probable: J! 1.6 will use
   * FTP-Layer automatically in setPermissions
   * so JoomFile::chmod will become unnecessary.
   *
   * @param   string        $dir  Directory or file for which the permissions will be changed
   * @param   octal number  $mode Permissions which will be applied to $dir
   * @return  boolean       True on success, false otherwise
   * @since   1.5.0
   */
  function chmod($dir, $mode)
  {
    static $ftpOptions;

    if(!isset($ftpOptions))
    {
      // Initialize variables
      jimport('joomla.client.helper');
      $ftpOptions = JClientHelper::getCredentials('ftp');  
    }

    if($ftpOptions['enabled'] == 1)
    {
      // Connect the FTP client
      jimport('joomla.client.ftp');
      $ftp = &JFTP::getInstance(
        $ftpOptions['host'], $ftpOptions['port'], null,
        $ftpOptions['user'], $ftpOptions['pass']
      );
      // Translate path to FTP path
      $dir = JPath::clean(str_replace(JPATH_ROOT, $ftpOptions['root'], $dir), '/');
      return $ftp->chmod($dir, $mode);
    }
    else
    {
      return JPath::setPermissions(JPath::clean($dir), $mode, $mode);
    }
  }

  /**
   * Resize image with functions from gd/gd2/imagemagick
   * 
   * Cropping function adapted from
   * 'Resize Image with Different Aspect Ratio'
   * Author: Nash
   * Website: http://nashruddin.com/Resize_Image_to_Different_Aspect_Ratio_on_the_fly
   *
   * @TODO: Check whether resizing is necessary before getting started
   *
   * @param   &string $debugoutput            debug information
   * @param   string  $src_file               Path to source file
   * @param   string  $dest_file              Path to destination file
   * @param   int     $useforresizedirection  Thumbnails only:
   *                                          Resize to width/height ratio or free setting
   * @param   int     $new_width              Width to resize
   * @param   int     $thumbheight            Height to resize
   * @param   int     $method                 1=gd1, 2=gd2, 3=im
   * @param   int     $dest_qual              $config->jg_thumbquality/jg_picturequality
   * @param   boolean $max_width              true=resize to maxwidth
   * @param   int     $cropposition           $config->jg_cropposition
   * @return  boolean True on success, false otherwise
   * @since   1.0.0
   */
  function resizeImage( &$debugoutput, $src_file, $dest_file, $useforresizedirection,
                        $new_width, $thumbheight, $method, $dest_qual, $max_width = false, $cropposition)
  {
    $config = & JoomConfig::getInstance();

    // Ensure that the pathes are valid and clean
    $src_file  = JPath::clean($src_file);
    $dest_file = JPath::clean($dest_file);

    // Doing resize instead of thumbnail, copy original and remove it.
    // @TODO check this extensions if needful
    $imagetype = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD',
                       6 => 'BMP', 7 => 'TIFF', 8 => 'TIFF', 9 => 'JPC', 10 => 'JP2',
                       11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF');
    $imginfo = getimagesize($src_file);

    if ($imginfo == null)
    {
      // @TODO message
      die(JText::_('JG_UPLOAD_FILE_NOT_FOUND'));
    }
    $imginfo[2] = $imagetype[$imginfo[2]];
    // GD can only handle JPG & PNG images
    if ($imginfo[2] != 'JPG'
        && $imginfo[2] != 'PNG'
        && $imginfo[2] != 'GIF'
        && ($method == 'gd1' || $method == 'gd2')
        )
    {
      // @TODO message
      die(JText::_('JG_UPLOAD_GD_ONLY_JPG_PNG'));
    }
    // Height/width
      $srcWidth  = $imginfo[0];
      $srcHeight = $imginfo[1];
    // For free resizing and cropping the center
    $offsetx = null;
    $offsety = null;
    if ($max_width)
    {
      $debugoutput .= JText::_('JG_UPLOAD_RESIZE_TO_MAX') . "<br />";
      $ratio = max($srcHeight,$srcWidth) / $new_width ;
      //$ratio = $srcWidth / $new_width;
    }
    else
    {
      // Resizing to thumbnail
      $debugoutput .= JText::_('JG_UPLOAD_CREATE_THUMBNAIL_FROM') . " $imginfo[2], $imginfo[0] x $imginfo[1]...<br />";
      switch ($useforresizedirection)
      {
        // Convert to height ratio
        case 0:
          $ratio = ($srcHeight / $thumbheight);
          $testwidth = ($srcWidth / $ratio);
          // If new width exceeds setted max. width
          if($testwidth > $new_width)
          {
        $ratio = ($srcWidth / $new_width);
          }
          break;
        // Convert to width ratio
        case 1:
          $ratio = ($srcWidth / $new_width);
        $testheight = ($srcHeight/$ratio);
        // If new height exceeds the setted max. height
        if($testheight>$thumbheight)
        {
          $ratio = ($srcHeight/$thumbheight);
        }
          break;
        // Free resizing and cropping the center
        case 2:
          if ($srcWidth < $new_width)
          {
            $new_width = $srcWidth;
      }
          if ($srcHeight < $thumbheight)
          {
            $thumbheight = $srcHeight;
          }
          // Expand the thumbnail's aspect ratio
          // to fit the width/height of the image
          $ratiowidth = $srcWidth / $new_width;
          $ratioheight = $srcHeight / $thumbheight;
          if ($ratiowidth < $ratioheight)
          {
            $ratio = $ratiowidth;
          }
      else
      {
            $ratio = $ratioheight;
          }
          // Calculate the offsets for cropping the source image according
          // to thumbposition
          switch ($cropposition)
        {
            // Left upper corner
            case 0:
              $offsetx = 0;
              $offsety = 0;
              break;
            // Right upper corner
            case 1:
              $offsetx = floor(($srcWidth - ($new_width * $ratio)));
              $offsety = 0;
              break;
            // Center
            case 2:
              $offsetx = floor(($srcWidth - ($new_width * $ratio)) * 0.5);
              $offsety = floor(($srcHeight - ($thumbheight * $ratio)) * 0.5);
              break;
            // Left lower corner
            case 3:
              $offsetx = 0;
              $offsety = floor(($srcHeight - ($thumbheight * $ratio)));
              break;
            // Right lower corner
            case 4:
              $offsetx = floor(($srcWidth - ($new_width * $ratio)));
              $offsety = floor(($srcHeight - ($thumbheight * $ratio)));
              break;
            // @TODO error, meanwhile the center
            default:
              $offsetx = floor(($srcWidth - ($new_width * $ratio)) * 0.5);
              $offsety = floor(($srcHeight - ($thumbheight * $ratio)) * 0.5);
              break;
        }
      }
    }
    if (is_null($offsetx) && is_null($offsety))
    {
    $ratio = max($ratio, 1.0);

    $destWidth  = (int)($srcWidth / $ratio);
    $destHeight = (int)($srcHeight / $ratio);
    }
    else
    {
      $destWidth = $new_width;
      $destHeight = $thumbheight;
      $srcWidth  = (int)($destWidth * $ratio);
      $srcHeight = (int)($destHeight * $ratio);
    }
    // Method for creation of the resized image
    switch($method)
    {
      case 'gd1':
        if(!function_exists('imagecreatefromjpeg'))
        {
          $debugoutput.=JText::_('JG_UPLOAD_GD_LIBARY_NOT_INSTALLED');
          return false;
        }
        if($imginfo[2] == 'JPG')
        {
          $src_img = imagecreatefromjpeg($src_file);
        }
        else
        {
          if ($imginfo[2] == 'PNG')
          {
            $src_img = imagecreatefrompng($src_file);
          }
          else
          {
            $src_img = imagecreatefromgif($src_file);
          }
        }
        if(!$src_img)
        {
          $ERROR = $lang_errors['invalid_image'];
          return false;
        }
        $dst_img = imagecreate($destWidth, $destHeight);
        if (!is_null($offsetx) && !is_null($offsety))
        {
          imagecopyresized($dst_img, $src_img, 0, 0, $offsetx, $offsety,
                           $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
        }
        else
        {
        imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $destWidth,
                         (int)$destHeight, $srcWidth, $srcHeight);
        }
        if(!@imagejpeg($dst_img, $dest_file, $dest_qual))
        {
          // Workaround for servers with wwwrun problem
          $dir = dirname($dest_file);
          JoomFile::chmod($dir, 0777);
          imagejpeg($dst_img, $dest_file, $dest_qual);
          JoomFile::chmod($dir, 0755);
        }
        imagedestroy($src_img);
        imagedestroy($dst_img);
        break;
      case 'gd2':
        if(!function_exists('imagecreatefromjpeg'))
        {
          $debugoutput.=JText::_('JG_UPLOAD_GD_LIBARY_NOT_INSTALLED');
          return false;
        }
        if(!function_exists('imagecreatetruecolor'))
        {
          $debugoutput.=JText::_('JG_UPLOAD_GD_NO_TRUECOLOR');
          return false;
        }
        if($imginfo[2] == 'JPG')
        {
          $src_img = imagecreatefromjpeg($src_file);
        }
        else
        {
          if($imginfo[2] == 'PNG')
          {
          $src_img = imagecreatefrompng($src_file);
          }
          else
          {
            $src_img = imagecreatefromgif($src_file);
          }
        }

        if(!$src_img)
        {
          $ERROR = $lang_errors['invalid_image'];
          return false;
        }
        $dst_img = imagecreatetruecolor($destWidth, $destHeight);

        if ($config->jg_fastgd2thumbcreation == 0)
        {
          if (!is_null($offsetx) && !is_null($offsety))
          {
            imagecopyresampled($dst_img, $src_img, 0, 0, $offsetx, $offsety,
                               $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
          }
          else
          {
          imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth,
                             (int)$destHeight, $srcWidth, $srcHeight);
        }
        }
        else
        {
          if (!is_null($offsetx) && !is_null($offsety))
          {
            JoomFile::fastImageCopyResampled($dst_img, $src_img, 0, 0, $offsetx, $offsety,
                               $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
          }
          else
          {
          JoomFile::fastImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth,
                             (int)$destHeight, $srcWidth, $srcHeight);
        }
        }

        if(!@imagejpeg($dst_img, $dest_file, $dest_qual))
        {
          // Workaround for servers with wwwrun problem
          $dir = dirname($dest_file);
          JoomFile::chmod($dir, 0777);
          imagejpeg($dst_img, $dest_file, $dest_qual);
          JoomFile::chmod($dir, 0755);
        }
        imagedestroy($src_img);
        imagedestroy($dst_img);
        break;
      case 'im':
        $disabled_functions = explode(',', ini_get('disabled_functions'));
        foreach($disabled_functions as $disabled_function)
        {
          if(trim($disabled_function) == 'exec')
          {
            return false;
          }
        }
  
        if(!empty($config->jg_impath))
        {
          $convert_path=$config->jg_impath.'convert';
        }
        else
        {
          $convert_path='convert';
        }
        $commands = '';
        // Crop the source image before resiszing if offsets setted before
        // example of crop: convert input -crop destwidthxdestheight+offsetx+offsety +repage output
        // +repage needed to delete the canvas
        if (!is_null($offsetx) && !is_null($offsety))
        {
          $commands .= ' -crop "'.$srcWidth.'x'.$srcHeight.'+'.$offsetx.'+'.$offsety.'" +repage';
        }
        // Finally the resize
        $commands  .= ' -resize "'.$destWidth.'x'.$destHeight.'" -quality "'.$dest_qual.'" -unsharp "3.5x1.2+1.0+0.10"';
        $convert    = $convert_path.' '.$commands.' "'.$src_file.'" "'.$dest_file.'"';
        //echo $convert.'<br />';
        $return_var = null;
        $dummy      = null;
        @exec($convert, $dummy, $return_var);
        if($return_var != 0)
        {
          // Workaround for servers with wwwrun problem
          // TODO: necessary here? probably test required
          $dir = dirname($dest_file);
          JoomFile::chmod($dir, 0777);
          @exec($convert, $dummy, $return_var);
          JoomFile::chmod($dir, 0755);
          if($return_var != 0)
          {
            return false;
          }
        }
        break;
      default:
        JError::raiseError('500', JText::_('JGA_UPLOAD_UNSUPPORTED_RESIZING_METHOD'));
        break;
    }

    // Set mode of uploaded picture
    JPath::setPermissions($dest_file);

    // We check that the image is valid
    $imginfo = getimagesize($dest_file);
    if(!$imginfo)
    {
      return false;
    }

    return true;
  }

  /**
   * Fast resizing of images with GD2
   * Notice: need up to 3/4 times more memory
   * http://de.php.net/manual/en/function.imagecopyresampled.php#77679
   * Plug-and-Play fastimagecopyresampled function replaces much slower
   * imagecopyresampled. Just include this function and change all
   * "imagecopyresampled" references to "fastimagecopyresampled".
   * Typically from 30 to 60 times faster when reducing high resolution
   * images down to thumbnail size using the default quality setting.
   * Author: Tim Eckel - Date: 09/07/07 - Version: 1.1 -
   * Project: FreeRingers.net - Freely distributable - These comments must remain.
   *
   * Optional "quality" parameter (defaults is 3). Fractional values are allowed,
   * for example 1.5. Must be greater than zero.
   * Between 0 and 1 = Fast, but mosaic results, closer to 0 increases the mosaic effect.
   * 1 = Up to 350 times faster. Poor results, looks very similar to imagecopyresized.
   * 2 = Up to 95 times faster.  Images appear a little sharp,
   *                              some prefer this over a quality of 3.
   * 3 = Up to 60 times faster.  Will give high quality smooth results very close to
   *                             imagecopyresampled, just faster.
   * 4 = Up to 25 times faster.  Almost identical to imagecopyresampled for most images.
   * 5 = No speedup.             Just uses imagecopyresampled, no advantage over
   *                             imagecopyresampled.
   *
   * @param   string  $dst_image  path to destination image
   * @param   string  $src_image  path to source image
   * @param   int     $dst_x      destination x point left above
   * @param   int     $dst_y      destination y point left above
   * @param   int     $src_x      source x point left above
   * @param   int     $src_y      source y point left above
   * @param   int     $dst_w      destination width
   * @param   int     $dst_h      destination height
   * @param   int     $src_w      source width
   * @param   int     $src_h      source height
   * @param   int     $quality    quality of destination (fix = 3) read instructions above
   * @return  boolean True on success, false otherwise
   * @since   1.0.0
   */
  function fastImageCopyResampled(&$dst_image, $src_image, $dst_x, $dst_y,
                                  $src_x, $src_y, $dst_w, $dst_h,
                                  $src_w, $src_h, $quality = 3)
  {
    if(empty($src_image) || empty($dst_image) || $quality <= 0)
    {
      return false;
    }

    if($quality < 5 && (($dst_w * $quality) < $src_w || ($dst_h * $quality) < $src_h))
    {
      $temp = imagecreatetruecolor($dst_w * $quality + 1, $dst_h * $quality + 1);
      imagecopyresized  ($temp, $src_image, 0, 0, $src_x, $src_y, $dst_w * $quality + 1,
                         $dst_h * $quality + 1, $src_w, $src_h);
      imagecopyresampled($dst_image, $temp, $dst_x, $dst_y, 0, 0, $dst_w,
                         $dst_h, $dst_w * $quality, $dst_h * $quality);
      imagedestroy      ($temp);
    }
    else
    {
      imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w,
                         $dst_h, $src_w, $src_h);
    }
    return true;
  }

  /**
   * Copies an index.html file into a specified folder
   *
   * @param   string  The folder path to copy the index.html file into
   * @return  boolean True on success, false otherwise
   * @since   1.5.5
   */
  function copyIndexHtml($folder)
  {
    jimport('joomla.filesystem.file');

    $src  = JPATH_ROOT.DS.'components'.DS.'com_joomgallery'.DS.'assets'.DS.'index.html';
    $dest = JPath::clean($folder.DS.'index.html');

    return JFile::copy($src, $dest);
  }
}