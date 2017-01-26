<?php
/**
* @version $Id: video.field.php 4820 2009-01-05 11:46:25Z Radek Suski $
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2006 - 2009 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
*/
/*
 *  no direct access
 */
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
global $sobiMediaObject;
$sobiMediaObject .= "\n\t <object classid='clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA' id='{$cssId}' type='application/x-oleobject' height='$h' width='$w'>";
$sobiMediaObject .= "\n\t\t <param name='FileName' value='{$data}' />";
$sobiMediaObject .= "\n\t\t <param name='url' value='{$data}' />";
$sobiMediaObject .= "\n\t\t <param name='ShowStatusBar' value='true' />";
$sobiMediaObject .= "\n\t\t <param name='DisplayBackColor' value='0' />";
$sobiMediaObject .= "\n\t\t <param name='TransparentAtStart' value='true' />";
$sobiMediaObject .= "\n\t\t <param name='showcontrols' value='true' />";
$sobiMediaObject .= "\n\t\t <embed src='{$data}' showstatusbar='1' transparentatstart='true' type='video/x-ms-wvx' autostart='{$autostart}' showcontrols='1' height='$h' width='$w' >";
$sobiMediaObject .= "\n\t </object>";
?>