<?php
/*
(c) Copyright: www.fijiwebdesign.com. Distribution is prohibited!
*/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$html = $params->get( 'fwd_html' );
$clean_js = $params->get( 'clean_js' );
$clean_css = $params->get( 'clean_css' );
$clean_all = $params->get( 'clean_all' );

if (!$clean_all) {
	if ($clean_js) {
		preg_match("/<script(.*)>(.*)<\/script>/i", $html, $matches);
		if ($matches) {
			foreach ($matches as $i=>$match) {
				$clean_js = str_replace('<br />', '', $match);
				$html = str_replace($match, $clean_js, $html);
			}
		}
	}
	if ($clean_css) {
		preg_match("/<style(.*)>(.*)<\/style>/i", $html, $matches);
		if ($matches) {
			foreach ($matches as $i=>$match) {
				$clean_js = str_replace('<br />', '', $match);
				$html = str_replace($match, $clean_js, $html);
			}
		}
	}
} else {
	$html = str_replace('<br />', '', $html);
}

echo $html;

 ?>
