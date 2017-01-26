<?php
/**
* @version $Id: progressbar.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) or die( 'Restricted access' );
/**
 * Displaying dynamic progress bar.
 * Script based on progress bar script from Juha Suni <juha.suni@sparecom.fi>
 * Example of use:
 * $pbar = new sobiproProgressbar();
 * $pbar->progress(20, "Progress of script +20%");
 *
 */
class sobiproProgressbar
{
	/**
	 * Current progress
	 * @access private
	 * @var integer
	 */
	var $_progress = 0;
	var $image = null;
	var $bgimage = null;
	/**
	 * default constructor
	 */
	function __construct( $img = "components/com_sobi2/images/mailerbar-single.gif",  $bgimg = "components/com_sobi2/images/mailerbar-bg.gif" )
	{
		$this->image = $img;
		$this->bgimage = $bgimg;
		ob_end_flush();
		flush();
		echo '<head><style type="text/css">
				/* Style for progressbar - start */
				.sppbar_progressbar {
					background-image: url('.$bgimg.');
					background-repeat: no-repeat;
					height: 60px;
					width: 514px;
					margin-right: auto;
					margin-left: auto;
				}
				.sppbar_baritems {
					padding-top: 10px;
					padding-left: 7px;
					text-align: left;
				}
				.sppbar_percentbox {
					background-color: #FFFFFF;
					position: absolute;
					left: 50%;
					width: 514px;
					top: 260px;
					margin-left: -257px;
					height: 90px;
					font-family: "Trebuchet MS", Arial, Helvetica;
					font-size: 24px;
					font-weight: bold;
					color: #999999;
					text-align: center;
				}
				.sppbar_msgbox {
					background-color: #FFFFFF;
					position: absolute;
					left: 50%;
					width: 514px;
					top:140px;
					margin-left: -257px;
					height: 30px;
					font-family: "Trebuchet MS", Arial, Helvetica;
					font-size: 24px;
					font-weight: bold;
					color: #999999;
					text-align: center;
				}
				/* Style for progressbar - end */
		</style></head>
		';
		echo '<div class="sppbar_progressbar"/>';
		echo '<div class="sppbar_baritems"/>';
	}
	function sobiproProgressbar( $img = "components/com_sobi2/images/mailerbar-single.gif",  $bgimg = "components/com_sobi2/images/mailerbar-bg.gif" )
	{
		$this->__construct( $img, $bgimg );
	}
	/**
	 * Displaying progress
	 * @param integer $percent number of percent to progress
	 * @param string $msg current step message
	 */
	function progress($percent = 0, $msg = null)
	{
    	$config =& sobi2Config::getInstance();
		$progress = $percent - $this->_progress;
		$this->_progress = $percent;
		flush();
		echo "<span class=\"sppbar_percentbox\" style=\"z-index:{$percent};\">{$percent} %</span>";
		if($msg) {
			echo "<span class=\"sppbar_msgbox\" style=\"z-index:{$percent};\">{$msg}</span>";
		}
		for($i = 1; $i <= $progress; $i++) {
			echo '<img src="'.$config->liveSite.'/'.$this->image.'" width="5" height="15">';
		}
		flush();
	}
}
?>