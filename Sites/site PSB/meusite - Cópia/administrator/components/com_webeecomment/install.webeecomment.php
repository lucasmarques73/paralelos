<?php

function com_install() {
	
	$db = JFactory::getDBO ();
	$query = "ALTER TABLE " . $db->nameQuote ( '#__webeeComment_Comment' ) . " ADD COLUMN ipAddress TEXT DEFAULT ''";
	$result = $db->execute ( $query );
	define('_CLT_INSTALLER_ICONPATH', JURI::root().'administrator/components/com_webeecomment/images/'); 
	$query2 = "UPDATE #__components SET admin_menu_img = '"._CLT_INSTALLER_ICONPATH."menu-icon.png' WHERE name='Webee Comments'";
	$result2 = $db->execute ($query2);
	return true;
}
?>
