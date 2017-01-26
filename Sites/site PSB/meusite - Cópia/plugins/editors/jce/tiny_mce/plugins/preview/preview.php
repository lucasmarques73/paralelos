<?php
/**
* @version		$Id: browser.php 158 2009-07-11 13:20:12Z happynoodleboy $
* @package      JCE
* @copyright    Copyright (C) 2005 - 2009 Ryan Demmer. All rights reserved.
* @author		Ryan Demmer
* @license      GNU/GPL
* JCE is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname( __FILE__ ) .DS. 'classes' .DS. 'preview.php' );

$preview =& Preview::getInstance();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $preview->getLanguageTag();?>" lang="<?php echo $preview->getLanguageTag();?>" dir="<?php echo $preview->getLanguageDir();?>" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="IE=8" http-equiv="X-UA-Compatible">
  <?php
  $preview->printScripts();
  $preview->printCss();
  ?>
  <title>{#preview.preview_desc}</title>
</head>
<body xml:lang="<?php echo $preview->getLanguage(); ?>" style="display: none;">
  <form onsubmit="return false;" action="<?php echo $preview->getFormAction();?>" target="_self" method="post" enctype="multipart/form-data">
    <div id="content"><!-- Gets filled with editor contents --></div>
    <input type="hidden" id="data" name="data" value="" />
    <input type="hidden" id="token" name="<?php echo $preview->getToken();?>" value="1" />
  </form>
</body>
</html>