<?php
/**
* @version $Id: secimg.php 4363 2008-08-29 10:52:23Z Radek Suski $
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2007 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/lgpl.html GNU/LGPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation.
*/
session_name('sobi2seccode');
session_start();
session_register('sobi2seccode');
mt_srand((double)microtime()*1000000);
$seccode = mt_rand(10000, 99999);
$_SESSION['sobi2seccode'] = $seccode;
$secImgBgColor = $_GET['bgcolor'];
$secImgFontColor = $_GET['fontcolor'];
$secImgLineColor = $_GET['linecolor'];
$secImgBorderColor = $_GET['bordercolor'];
$type = $_GET['type'];

$im = ImageCreate(60, 18) or die('Image create error!');

$bgcolor = imagecolorallocate($im, sprintf("%03d",hexdec(substr($secImgBgColor, 0,2))), sprintf("%03d",hexdec(substr($secImgBgColor, 2,2))), sprintf("%03d",hexdec(substr($secImgBgColor, 4,2))));
$fontcolor = imagecolorallocate($im, sprintf("%03d",hexdec(substr($secImgFontColor, 0,2))), sprintf("%03d",hexdec(substr($secImgFontColor, 2,2))), sprintf("%03d",hexdec(substr($secImgFontColor, 4,2))));
$linecolor = imagecolorallocate($im, sprintf("%03d",hexdec(substr($secImgLineColor, 0,2))), sprintf("%03d",hexdec(substr($secImgLineColor, 2,2))), sprintf("%03d",hexdec(substr($secImgLineColor, 4,2))));
$bordercolor = imagecolorallocate($im, sprintf("%03d",hexdec(substr($secImgBorderColor, 0,2))), sprintf("%03d",hexdec(substr($secImgBorderColor, 2,2))), sprintf("%03d",hexdec(substr($secImgBorderColor, 4,2))));

for($x=10; $x <= 100; $x+=10)
    ImageLine($im, $x, 0, $x, 50, $linecolor);

ImageLine($im, 0, 9, 100, 9, $linecolor);
ImageLine($im, 0, 0, 0, 50, $bordercolor);
ImageLine($im, 0, 0, 100, 0, $bordercolor);
ImageLine($im, 0, 17, 100, 17, $bordercolor);
ImageLine($im, 59, 0, 59, 17, $bordercolor);
ImageString($im, 5, 8, 1, $seccode, $fontcolor);


switch($type) {
  default:
  case 'jpg':
    // JPEG output
    Header("Content-Type: image/jpeg");
    imagejpeg($im,"",75);
  break;

  case 'png':
    // JPEG output
    Header("Content-Type: image/png");
    imagepng($im);
  break;

  case 'gif':
    // JPEG output
    Header("Content-Type: image/gif");
    imagegif($im);
  break;

  case 'JPG':
    // JPEG output
    Header("Content-Type: image/jpeg");
    ImageJPEG($im,"",75);
  break;

  case 'PNG':
    // PNG output
    Header("Content-Type: image/png");
    ImagePNG($im);
  break;

  case 'GIF':
    // GIF output
    Header("Content-Type: image/gif");
    ImageGIF($im);
  break;
}
ImageDestroy($im);
?>
