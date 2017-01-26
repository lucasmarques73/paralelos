<?php
/**
* @version $Id: sobi2.vc.tmpl.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

/*please do not remove this line */
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

/* ------------------------------------------------------------------------------
 * This is the template for the V-Card View
 * ------------------------------------------------------------------------------
 */
/* Don't remove this line! */
function sobi2VCview($id, $style, $ico, $img, $title, $fieldsObjects, $fieldsFormatted, $plugins, $editButton = null, $deleteButton = null)
{
//	For advanced templating comment in the next line if you need to access other sobi2 object proporties
//	$mySobi = new sobi2( $id );
//	$config =& sobi2Config::getInstance();
//  $waySearchLink = HTML_SOBI::createWaySearchUrl( $id );
?>
<!-- here starts the template -->

<td <?php echo $style; ?>>
	<?php echo $editButton; ?>
	<?php echo $deleteButton; ?>
	<?php echo $ico; ?>
	<?php echo $img; ?>

 	<?php echo $title; ?>
	<?php echo HTML_SOBI::customFieldsData($fieldsFormatted);?>

<!-- here ends the template -->

<!-- Don't remove these lines! -->
</td><?php
}
?>
