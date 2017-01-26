<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* @version 1.0: mod_S5 Tell a Friend
* @copyright (C) 2008 Shape 5 LLC
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Author: www.shape5.com - Professional Template Community
*/

/**
* INDIQUE É UMA ADAPTAÇÃO DO TELL A FRIEND DA SHAPE 5
* TRADUZIDO E ADAPTADO POR JOOMLAFÁCIL WWW.JOOMLAFACIL.COM.BR
*/

$text  = $params->get( 'text');

echo "$text";  

?>
 <center><input type="button" class="button" value="INDIQUE" onclick="s5_open_taf_popup()"/></center>

<script type="text/javascript">
var s5_taf_parent = window.location;
function s5_open_taf_popup() {
window.open('modules/mod_JF_INDIQUE/JF_INDIQUE.htm','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=570,left=50,top=50,titlebar=yes')
}
</script>