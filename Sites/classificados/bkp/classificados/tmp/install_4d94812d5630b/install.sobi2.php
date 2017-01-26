<?php
/**
* @version $Id: install15.sobi2.php 4828 2009-01-05 12:38:12Z Radek Suski $
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

defined( '_JEXEC' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
define( '_SOBI2_V', '$Revision: 4828 $' );

function com_install()
{
	$database =& JFactory::getDBO();
	$path = JPATH_SITE;
	@ini_set('max_execution_time', '180');

	if( !defined( 'DS' ) ) {
		define( 'DS', DIRECTORY_SEPARATOR );
	}
	if( file_exists( $path.DS."administrator".DS."includes".DS."pcl".DS."pclzip.lib.php" ) ) {
		require_once( $path.DS."administrator".DS."includes".DS."pcl".DS."pclzip.lib.php" );
	}

	$archivename = $path.DS."administrator".DS."components".DS."com_sobi2".DS."includes".DS."install".DS."crystalsvg.zip";
	$zipfile = new PclZip($archivename);
	$zipfile->extract(PCLZIP_OPT_PATH, $path.DS."images".DS."stories".DS);

	$archivename = $path.DS."administrator".DS."components".DS."com_sobi2".DS."includes".DS."install".DS."langs.zip";
	$zipfile = new PclZip($archivename);
	$zipfile->extract(PCLZIP_OPT_PATH, $path.DS."administrator".DS."components".DS."com_sobi2".DS."languages".DS);

	@unlink($path.DS."images".DS."stories".DS."folder_add_f2.png");
	@unlink($path.DS."images".DS."stories".DS."properties_f2.png");

	@chdir($path.DS."images".DS);
	@mkdir("com_sobi2", 0777);
	@chdir($path.DS.images.DS."com_sobi2".DS);
	@mkdir("clients", 0777);
	if( defined( "_JEXEC" ) && class_exists( "JRequest" ) ) {
		$m = JFactory::getApplication( 'site' );
		$m->redirect( 'index2.php?option=com_sobi2&sinstall=screen', 'A instalação do SOBI2 não está concluída. Por favor terminar a primeira instalação' );
	}
	else {
		mosRedirect( 'index2.php?option=com_sobi2&sinstall=screen', 'A instalação do SOBI2 não está concluída. Por favor terminar a primeira instalação' );
	}
}

function installSobi2()
{
	$t = eregi_replace( '^[:alpha:]', null, $_GET['sinstall'] );
	if( $t == 'screen' ) {
		echo '<div style="background: transparent url(components/com_sobi2/images/sobi2_logo48.jpg) no-repeat scroll left center; font-size: 18px; font-weight: bold; color: rgb(198, 73, 52); text-align: left; padding-left: 50px; padding-top: 20px;  height: 50px;">Sigsiu Online Business Index 2</div>';
		echo '<h2 style="padding-left: 50px; color:blue; text-align:left!important;">Clique para finalizar a instalação do componente SOBI2:&nbsp;';
		echo '<button style="font-weight: bold; color: red; font-size: 16px; width: 300px; height: 30px;" onclick="window.location=\'index2.php?option=com_sobi2&sinstall=install\'">Instalar dados do SOBI2</button></h2>';
	}
	elseif( $t == 'install' ) {
		$msg = null;
		$msg .= installConfig();
		$msg .= installSobiData();
		if( ( @unlink( dirname( __FILE__ ).DIRECTORY_SEPARATOR.'install.sobi2.php' ) ) ) {
			$msg .= '<big style="font-weight: bold; color:blue;"><br/><big><tt>SOBI2 foi instalado - instalação concluída</tt></big></big><br/>';
			if( defined( "_JEXEC" ) && class_exists( "JRequest" ) ) {
				$mmsg = null;
				$session =& JFactory::getSession();
				$session->set('application.queue', array( array( 'message' => 'SOBI2 foi instalado - instalação concluída', 'type' => 'message' ) ) );
			}
			else {
				$mmsg = '&mosmsg=SOBI2 foi instalado - instalação concluída';
			}
			$time = defined( 'SIR' ) ? 5000 : 2000;
			$msg .= "<script> function Finish() { document.location.href='index2.php?option=com_sobi2&task=about{$mmsg}'; } setTimeout( 'Finish()', {$time} ) </script>";
			$msg .= '<br/><br/><big style="font-weight: bold; color:blue; text-align:center;"><tt>Por favor, aguarde um segundo... redirecionando.</tt></big><br/>';
		}
		else {
			$msg .= '<br/><tt><h3 style="text-align:left;"><big style="font-weight: bold; color:red; text-align:center;"><img src="components/com_sobi2/images/error.png"/>&nbsp;ERRO:</big> A instalação parece estar Ok, mas não é possível excluir o arquivo de instalação... <br/><br/> Se você estiver usando a camada FTP Joomla 1.5, por favor <big style="font-weight: bold; color:red; text-align:center;">desabilite-a</big> ou desinstale este componente, porque SOBI2 não é capaz de funcionar corretamente neste modo. <br/><br/>Você também pode tentar remover manualmente o seguinte arquivo: administrator/components/com_sobi2/install.sobi2.php</h3></tt>';
		}
		echo $msg;
	}
	else {
		exit( 'Accesso restrito' );
	}
}
function installSobiData()
{
	$database =& JFactory::getDBO();
	$msg = null;

	$query = "SELECT `id` FROM #__components WHERE `option` = 'com_sobi2'";
	$database->setQuery( $query );
	$id = $database->loadResult();

	$query = "UPDATE #__menu SET componentid = {$id} WHERE link LIKE 'index.php?option=com_sobi2%'";
	$database->setQuery( $query );
	$database->query();

	$query = "DELETE FROM #__sobi2_fields_data WHERE data_bool = 1 AND expiration != 'NULL'";
	$database->setQuery( $query );
	$database->query();

	$query = "SELECT COUNT(*) FROM #__sobi2_fields";
	$database->setQuery($query);
	if( $database->loadResult() ) {
		$msg .= '<big style="font-weight: bold; color: rgb(255, 0, 0);"><big><tt>menu entries fixed ....</tt></big></big><br/>';

		$query = "SELECT configValue FROM #__sobi2_config WHERE configKey = 'version' AND sobi2Section = 'version'";
		$database->setQuery($query);
		$ver = $database->loadResult();
		$ver = ereg_replace("[^0-9]","",$ver);

		$query = "ALTER TABLE #__sobi2_language CHANGE langValue langValue VARCHAR( 255 ) ";
		$database->setQuery($query);
		$database->query();

		$query = "ALTER TABLE #__sobi2_item CHANGE title title VARCHAR( 255 )";
		$database->setQuery($query);
		$database->query();

		if( $ver < 3400 ) {
			$query = "ALTER TABLE #__sobi2_fields_data ADD INDEX field_item ( fieldid , itemid ) ";
			$database->setQuery($query);
			$database->query();
		}
		if( $ver < 4400 ) {
			$query = 'ALTER TABLE #__sobi2_fields_data ADD data_int INT( 20 ) DEFAULT \'0\' AFTER data_bool , ADD data_float FLOAT  DEFAULT \'0\' AFTER data_int , ADD data_char VARCHAR( 255 ) AFTER data_float;';
			$database->setQuery($query);
			$database->query();
		}
		$query = 'UPDATE #__sobi2_config SET configValue = \''._SOBI2_V.'\' WHERE configKey = \'version\' AND sobi2Section = \'version\' LIMIT 1 ;';
		$database->setQuery( $query );
		$database->query();
		if( $ver < 3400 ) {
			$msg .= '<br/><big style="font-weight: bold; font-size: 18px; color: rgb(255, 0, 0);"><big><tt>Você tem uma versão do SOBI2 atualizada a partir de uma versão mais antiga. Por favor, note que desde a versão 2.8.3 RC os arquivos de  template são armazenados em outro diretório ( components/com_sobi2/templates/default ). Portanto, se você precisa restaurar o seu template antigo, copie esses arquivos para o novo local. Se você editar os templates através do editor de templates no painel de administração, os templates serão salvos automaticamente para o local correto.</tt></big></big><br/>';
		}
		return $msg;
	}

	/* fields */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (1, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (2, 1, 0, NULL, NULL, 1, 0, 10, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 2, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (3, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 3, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (4, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 4, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (5, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 5, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (6, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 1, 1, 6, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (7, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 0, 1, 0, 0, 1, 7, 0, 1, 1, 2, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (8, 1, 0, NULL, NULL, 0, 10, 100, 0, 0, 30, 'inputbox', 1, 1, 0, 0, 1, 1, 8, 0, 0, 1, 1, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (9, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 1, 0, 0, 0, 1, 9, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (10, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 1, 0, 0, 0, 1, 10, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (11, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 1, 0, 0, 0, 1, 11, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (12, 1, 0, NULL, NULL, 1, 0, 100, 0, 0, 30, 'inputbox', 1, 1, 0, 0, 0, 1, 12, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_fields VALUES (13, 2, 1, NULL, NULL, 0, 25, 0, 20, 50, 0, 'inputbox', 1, 1, 0, 0, 0, 1, 13, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', 0);";

	/* categories */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_categories VALUES (1, 'root category', 'articles.jpg', 'right', 'Sigsiu Online Business Index 2', '', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 0, NULL, '');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_categories VALUES (2, 'First Category', '', 'left', 'First Category Description', 'First Category Introtex', 1, 0, '0000-00-00 00:00:00', 1, 0, 0, NULL, 'folder_red_open.png');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_cats_relations VALUES (2, 1);";

	/* labels */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_street', 'Street', '', 'fields', 1, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_postcode', 'Postcode', '', 'fields', 2, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_city', 'City', '', 'fields', 3, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_county', 'County', '', 'fields', 4, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_federal_state', 'Federal State', '', 'fields', 5, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_country', 'Country', '', 'fields', 6, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_email', 'Email', '', 'fields', 7, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_website', 'Website', '', 'fields', 8, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_contact_person', 'Contact Person', '', 'fields', 9, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_phone', 'Phone', '', 'fields', 10, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_fax', 'Fax', '', 'fields', 11, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_hotline', 'Hotline', '', 'fields', 12, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_description', 'Description', '', 'fields', 13, 'english');";

	/* brazilian_portuguese by Elvis Vinicicus <elvisvinicius@gmail.com> */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_street', 'Endereço', '', 'fields', 1, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_postcode', 'Código Postal', '', 'fields', 2, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_city', 'Cidade', '', 'fields', 3, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_county', 'Bairro', '', 'fields', 4, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_federal_state', 'Estado', '', 'fields', 5, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_country', 'País', '', 'fields', 6, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_email', 'e-mail', '', 'fields', 7, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_website', 'WebSite', '', 'fields', 8, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_contact_person', 'Contato', '', 'fields', 9, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_phone', 'Telefone', '', 'fields', 10, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_fax', 'Fax', '', 'fields', 11, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_hotline', 'Celular', '', 'fields', 12, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('field_description', 'Descrição', '', 'fields', 13, 'brazilian_portuguese');";

	/* emails */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_submit_title', '', 'Your entry in {sobi} on {sitename}', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_submit_text', '', 'Your entry in {sobi} on {sitename} was added and awaiting approval.', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_update_title', '', 'Your entry in {sobi} on {sitename} has been updated', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_update_text', '', 'Your entry in {sobi} on {sitename} has been updated. \n {link_details}', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_approve_title', '', 'Your entry in {sobi} on {sitename} has been approved', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_approve_text', '', 'Your entry in {sobi} on {sitename} has been approved. \n {link_details}', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_payments_title', '', 'Your entry in {sobi} on {sitename} (Payments details)', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_payments_text', '', '\nThank you for your interest in our products.\n-----------------------\n\nYou added an entry in: {sobi} on {sitename} \n\nYou have chosen the following not free options: \n{selected_options} \n\nTotal Amount: {total} \nPlease send the money to the following account: \n{bank_data} or pay with PayPal: \n{paypal_url}', 'emails', null, 'english');";

	/* brazilian_portuguese by Elvis Vinicicus <elvisvinicius@gmail.com> */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_submit_title', '', 'Sua entrada em {sobi} no {sitename}', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_submit_text', '', 'Sua entrada em {sobi} no {sitename} foi cadastrada e aguarda aprovação.', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_update_title', '', 'Sua entrada em {sobi} no {sitename} foi atualizada', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_update_text', '', 'Sua entrada em {sobi} no {sitename} foi atualizada. \n {link_details}', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_approve_title', '', 'Sua entrada em {sobi} no {sitename} foi aprovada', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_approve_text', '', 'Sua entrada em {sobi} no {sitename} foi aprovada. \n {link_details}', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_payments_title', '', 'Sua entrada em {sobi} no {sitename} (Payments details)', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_payments_text', '', '\nObrigado pelo seu interesse em nossos produtos.\n-----------------------\n\nVocê cadastrou uma entrada em: {sobi} no {sitename} \n\nVocê escolheu as seguintes opções não gratuitas:\n {selected_options} \n\nValor Total: {total} \nPor favor enviar o pagamento à seguinte conta: \n{bank_data} ou efetue o pagamento com PayPal: \n{paypal_url}', 'emails', null, 'brazilian_portuguese');";

	$msg .= '<big style="font-weight: bold; color: rgb(255, 0, 0);"><big><tt>Instalando dados iniciais...</tt></big></big><br/>';
	foreach ( $installQueries as $query ) {
		$database->setQuery($query);
		$database->query();
		if( $database->getErrorNum() ) {
			$msg .= '<br>'.$database->stderr();
			defined( 'SIR' ) || define( 'SIR', true );
		}
	}
	return $msg;
}
function installConfig()
{
	$database =& JFactory::getDBO();
	$msg = null;

	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_cat_items_relations` ( `catid` int(11) NOT NULL default '0', `itemid` int(11) NOT NULL default '0', `ordering` int(11) NOT NULL, PRIMARY KEY  (`catid`,`itemid`), KEY `itemid` (`itemid`), KEY `catid` (`catid`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_categories` ( `catid` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(100) default NULL, `image` char(100) default NULL, `image_position` varchar(10) default NULL, `description` text, `introtext` varchar(100) default NULL, `published` tinyint(1) default NULL, `checked_out` int(11) default NULL, `checked_out_time` datetime default NULL, `ordering` int(11) default NULL, `access` tinyint(3) default NULL, `count` int(11) default NULL, `params` text, `icon` varchar(100) NOT NULL, PRIMARY KEY  (`catid`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_cats_relations` ( `catid` int(11) NOT NULL default '0', `parentid` int(11) NOT NULL default '0', PRIMARY KEY  (`catid`,`parentid`), KEY `category_parent_id` (`parentid`), KEY `category_child_id` (`catid`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_config` ( `configKey` varchar(100) NOT NULL default '', `configValue` TEXT default NULL, `sobi2Section` varchar(100) NOT NULL default '', `description` text, PRIMARY KEY  (`configKey`,`sobi2Section`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_fields` ( `fieldid` int(11) NOT NULL AUTO_INCREMENT, `fieldType` int(11) default NULL, `wysiwyg` tinyint(1) default NULL, `fieldDescription` text, `explanation` text, `is_free` tinyint(1) default NULL, `payment` double default NULL, `fieldChars` int(11) default NULL, `fieldRows` int(11) default NULL, `fieldColumns` int(11) default NULL, `preferred_size` int(11) default NULL, `CSSclass` text, `enabled` tinyint(1) default NULL, `isEditable` tinyint(1) default NULL, `is_required` tinyint(1) default NULL, `in_promoted` tinyint(1) default NULL, `in_vcard` tinyint(1) default NULL, `in_details` tinyint(1) NOT NULL, `position` int(11) default NULL, `in_search` int(2) NOT NULL, `with_label` tinyint(1) NOT NULL, `in_newline` tinyint(1) NOT NULL, `isUrl` int(2) NOT NULL, `checked_out` int(11) NOT NULL, `checked_out_time` datetime NOT NULL, `displayed` tinyint(1) NOT NULL, PRIMARY KEY  (`fieldid`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_fields_data` ( `id` int(11) NOT NULL auto_increment, `fieldid` int(11) default NULL, `data_txt` text, `data_bool` tinyint(1) default NULL, `data_int` int(20) DEFAULT '0', `data_float` float DEFAULT '0', `data_char` varchar(255) NOT NULL, `itemid` int(11) default NULL, `expiration` datetime default NULL, PRIMARY KEY  (`id`), KEY `itemid` (`itemid`) ); ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_item` ( `itemid` int(11) NOT NULL AUTO_INCREMENT, `title` varchar(255) default NULL, `hits` int(11) default NULL, `visits` int(11) default NULL, `published` tinyint(1) default NULL, `confirm` tinyint(1) NOT NULL, `approved` tinyint(1) NOT NULL, `archived` tinyint(1) default NULL, `publish_up` datetime default NULL, `publish_down` datetime default NULL, `checked_out` int(11) default NULL, `checked_out_time` datetime NOT NULL, `ordering` int(11) default NULL, `owner` int(11) NOT NULL, `icon` varchar(200) NOT NULL, `image` varchar(200) NOT NULL, `background` VARCHAR(100), `options` TEXT, `params` TEXT, `ip` varchar(15) NOT NULL, `last_update` datetime NOT NULL, `updating_user` int(11) NOT NULL, `updating_ip` varchar(15) NOT NULL, `metakey` varchar(200) NOT NULL, `metadesc` text NOT NULL, PRIMARY KEY  (`itemid`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_language` ( `langKey` varchar(50) NOT NULL default '', `langValue` varchar(255) NOT NULL default '', `description` text, `sobi2Section` varchar(10) NOT NULL default '', `fieldid` int(11) default NULL, `sobi2Lang` varchar(50) NOT NULL default '', PRIMARY KEY (langKey,sobi2Lang) ); ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_plugins` ( `id` int(11) NOT NULL auto_increment, `name_id` varchar(20) NOT NULL, `version` varchar(10) NOT NULL, `name` varchar(50) NOT NULL, `in_details` tinyint(1) default NULL, `in_listing` tinyint(1) default NULL, `description` text, `author` varchar(50) default NULL, `author_email` varchar(50) NOT NULL, `author_url` varchar(50) NOT NULL, `position` int(11) default NULL, `init_file` varchar(50) default NULL, `options` varchar(50) default NULL, `params` text, `list_pos` int(11) default NULL, `dv_pos` int(11) default NULL, `form_pos` int(11) default NULL, `enabled` tinyint(1) default NULL, PRIMARY KEY  (`id`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_plugins_tables` ( `pid` int(11) NOT NULL, `table` varchar(50) NOT NULL, PRIMARY KEY  (`pid`,`table`) ) ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_cache` ( `validtime` int(11) NOT NULL, `task` varchar(20) NOT NULL, `sid` int(11) NOT NULL, `cid` int(11) NOT NULL, `uid` tinyint(11) NOT NULL, `limitstart` int(11) NOT NULL, `limitall` tinyint(11) NOT NULL, `Itemid` int(11) NOT NULL, `section` varchar(50) NOT NULL, `params` text NOT NULL, `html` blob NOT NULL, `opt` text NOT NULL, `slang` varchar(50) NOT NULL, `schecksum` varchar(50) NOT NULL, KEY `sid` (`sid`), KEY `cid` (`cid`), KEY `uid` (`uid`), KEY `validtime` (`validtime`), KEY `slang` (`slang`), KEY `section` (`section`), KEY `task` (`task`) ); ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_cobj` ( `atime` int(11) NOT NULL, `sid` int(11) NOT NULL, `cid` int(11) NOT NULL, `svars` text NOT NULL, `oid` int(11) NOT NULL, `cl` int(11) NOT NULL, `params` text NOT NULL, `slang` varchar(50) NOT NULL, `schecksum` varchar(50) NOT NULL, PRIMARY KEY  (`sid`,`cid`,`oid`,`cl`,`slang`), KEY `sid` (`sid`), KEY `cid` (`cid`), KEY `cl` (`cl`), KEY `slang` (`slang`) ); ";
	$installQueries[] = " CREATE TABLE IF NOT EXISTS `#__sobi2_payments` ( `pid` int(11) NOT NULL auto_increment, `sid` int(11) NOT NULL, `reference` varchar(255) NOT NULL, `amount` float NOT NULL, `date` datetime NOT NULL, `payed` tinyint(4) NOT NULL, `payed_date` datetime NOT NULL, `email_send` datetime NOT NULL, `fid` int(11) NOT NULL, `params` TEXT, PRIMARY KEY  (`pid`) ) ";

	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('componentName', 'SOBI2', 'general', NULL), ('showComponentLink', '1', 'frontpage', NULL), ('showSearchLink', '1', 'frontpage', NULL);";
	/* set default language to brazilian_portuguese - by Elvis Vinicicus <elvisvinicius@gmail.com> */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showAddNewEntryLink', '1', 'frontpage', NULL),('language', 'brazilian_portuguese', 'frontpage', NULL),('useSecurityCode', '1', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('needToAcceptEntryRules', '1', 'editForm', NULL),('entryRulesURLextern', '0', 'editForm', NULL),('entryRulesURL', 'http://change.me.com/rules.html', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('currency', 'EUR', 'editForm', NULL),('maxCatsForEntry', '5', 'editForm', 'define max categories for one entry');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('cat2price', '0', 'editForm', NULL),('cat3price', '0', 'editForm', NULL),('cat4price', '0', 'editForm', NULL),('cat5price', '0', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('acceptEntryRules1', 'I accept the', 'editForm', NULL),('entryRulesURLlabel', 'terms of use', 'editForm', NULL),('acceptEntryRules2', 'of this Company', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('entryExpirationTime', '0', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('autopublishEntry', '0', 'general', NULL),('pby', '1', 'general', NULL),('allowRenew', '0', 'general', NULL),('renewDiscount', '0', 'general', NULL),('renewExpirationTime', '0', 'general', NULL),('allowRenewDaysForExp', '14', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('notifyAdmins', '1', 'editForm', NULL),('notifyAuthorNew', '1', 'editForm', NULL),('notifyAuthorChanges', '1', 'editForm', NULL),('notifyAdminChanges', '1', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowMultiTitle', '0', 'editForm', NULL),('emailOnAppr', '1', 'editForm', NULL),('showListingOnFp', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('lineOnSite', '5', 'frontpage', NULL),('itemsInLine', '2', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showCatListInCat', '1', 'frontpage', NULL),('showCatListOnFp', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('catListAs', '2', 'frontpage', '1 = list,\r\n2 = symbols with icon and introtext');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('debugTmpl', '1', 'frontpage', NULL),('debug', '8', 'frontpage', NULL),('catsListInLine', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showEntriesFromSubcats', '1', 'frontpage', NULL),('showImgInVC', '0', 'frontpage', NULL),('showIcoInVC', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowUsingImg', '1', 'editForm', '0 - no\r\n1 - yes and is free\r\n2- yes but is no free');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowUsingIco', '1', 'editForm', '0 - no\r\n1 - yes and is free\r\n2- yes but is no free');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('priceForIco', '0', 'editForm', NULL),('priceForImg', '0', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowUserToEditEntry', '1', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showComponentDescription', '1', 'frontpage', NULL),('showCatDesc', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('searchShowCountryList', '1', 'search', NULL),('searchShowFederalList', '1', 'search', NULL),('searchShowCountyList', '1', 'search', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('useMeta', '1', 'general', NULL),('showIcoInDetails', '0', 'details', NULL),('showImageInDetails', '1', 'details', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('waySearchLabel', 'WaySearch', 'details', NULL),('useWaySearch', '1', 'details', NULL), ('waySearchUrl', 'http://maps.google.com/?ie=UTF8&hl=en&q=STREET+ZIPCODE+CITY+COUNTY+FEDSTATE+COUNTRY', 'details', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('mailFees', '1', 'payment', NULL),('mailFeesAdm', '1', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('useBankTransfer', '2', 'payment', NULL),('usePayPal', '1', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('curencyDecSeparator', ',', 'general', NULL),('bankData', '<![CDATA[ Account Owner<br />\r\nAccount No.: 8274230479<br />\r\Bank No.: 8038012380<br />\r\nIBAN: 234242343018<br />\r\nBIC: 07979079779ABCDEFGH]]>', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('payTitle', 'Entry in SOBI', 'payment', NULL),('payPalMail', 'change@me.com', 'payment', NULL),('payPalCurrency', 'EUR', 'payment', NULL),('payPalUrl', 'https://www.paypal.com/cgi-bin/webscr', 'payment', NULL),('payPalReturnUrl', '', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showCatItemsCount', '1', 'general', NULL),('listingOrdering', 'items.publish_up ASC', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowUserDelete', '2', 'general', '0 - no\r\n1 - yes\r\n2 - only unpublish');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('secImgBorderColor', '000000', 'editForm', NULL),('secImgLineColor', '666666', 'editForm', NULL),('secImgFontColor', '000000', 'editForm', NULL),('sobi2BackgroundImg', 'grey.gif', 'general', NULL),('sobi2BorderColor', '808080', 'general', NULL),('secImgBgColor', 'F9FAFA', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showHits', '1', 'details', NULL),('showAddedDate', '1', 'details', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('imgHeigth', '300', 'editForm', NULL),('imgWidth', '300', 'editForm', NULL),('thumbHeigth', '80', 'editForm', NULL),('thumbWidth', '80', 'editForm', NULL),('efIcoLabel', 'Icon', 'editForm', NULL),('efImgLabel', 'Logo', 'editForm', NULL),('efEntryTitleLength', '20', 'editForm', NULL),('efEntryTitleLabel', 'Title', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('maxFileSize', '307200', 'editForm', NULL),('allowAnonymous', '1', 'editForm', NULL),('catsOrdering', 'ordering ASC', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('googleMapsZoom', '14', 'google', NULL),('googleMapsWidth', '280', 'google', NULL),('googleMapsLongField', '0', 'google', NULL),('googleMapsLatField', '0', 'google', NULL),('googleMapsHeight', '120', 'google', NULL),('googleMapsBubble', '0', 'google', NULL),('googleMapsApiKey', '0', 'google', NULL),('useGoogleMaps', '0', 'details', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('allowAddingToParentCats', '1', 'editForm', NULL),('allowAnoDetails', '1', 'general', NULL),('allowUsingBackground', '0', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('mailFooter', '\n\nCompany Name\nCompany Address\nCompany Email\n\n', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_submit_title', 'An entry in {sobi} on {sitename} has been added', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_submit_text', 'An entry in {sobi} on {sitename} has been added. \n\n User: {user} \nTitle: {title} \n\n{link_details}', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_update_title', 'An entry in {sobi} on {sitename} has been updated', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_update_text', 'An entry in {sobi} on {sitename} has been updated. \n\nUser: {user} \nTitle: {title} \n\n{link_details}', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_payments_title', 'An entry in {sobi} on {sitename} (payments details)', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_payments_text', 'An entry in {sobi} on {sitename} has been added. \n\nUser: {user} \nTitle: {title} \n\n{link_details} \n\n{selected_options} \n\nTotal Amount: {total} \n\nExpiration date: {expiration_date}', 'payment', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('emailOnRenew', '1', 'editForm', NULL),('emailOnRenewAdm', '1', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_renew_title', 'An entry in {sobi} on {sitename} has been renewed', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('email_on_renew_text', 'An entry in {sobi} on {sitename} has been renewed. \n\n User: {user} \nTitle: {title} \n\n{link_details}', 'editForm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('basicPriceLabel', 'Basic entry', 'general', NULL),('basicPrice', '0', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('recount', '1', 'cache', NULL),('admPermission', '0', 'adm', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('cacheL3strLen', '500000', 'cache', NULL),('cacheL3Enabled', '1', 'cache', NULL),('cacheL2strLen', '500000', 'cache', NULL),('cacheL2Lifetime', '432000', 'cache', NULL),('cacheL2dvEnabled', '0', 'cache', NULL),('cacheL2Enabled', '1', 'cache', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('showAlphaIndex', '0', 'frontpage', NULL),('useDetailsView', '0', 'frontpage', NULL),('useRSSfeed', '1', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('SigsiuTreeImages', 'root = components/com_sobi2/images/base.gif,join = components/com_sobi2/images/join.gif,joinBottom = components/com_sobi2/images/joinbottom.gif,plus = components/com_sobi2/images/plus.gif,plusBottom = components/com_sobi2/images/plusbottom.gif,minus = components/com_sobi2/images/minus.gif,minusBottom = components/com_sobi2/images/minusbottom.gif,folder = components/com_sobi2/images/folder.gif,folderOpen = components/com_sobi2/images/folderopen.gif,line = components/com_sobi2/images/line.gif, empty = components/com_sobi2/images/empty.gif', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('ajaxSearchCatsFieldsDepend', '0', 'frontpage', NULL),('ajaxSearchCatsContHeight', '100', 'frontpage', NULL),('ajaxSearchCatsForFields', '0', 'frontpage', NULL),('ajaxSearchSlidInAfterSearch', '1', 'frontpage', NULL),('ajaxSearchSlidInOnStart', '1', 'frontpage', NULL),('ajaxSearchUseSlider', '1', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('mailAdmGid', '25', 'general', NULL),('mailFieldId', '7', 'general', NULL),('mailSoJ', '0', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('waySearchFields', 'STREET=1;ZIPCODE=2;CITY=3;COUNTRY=6;FEDSTATE=5;COUNTY=4', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('forceMenuId', '1', 'general', NULL),('showComponentDescInSearch', '1', 'general', NULL),('useFormTpl', '0', 'general', NULL),('allowFeEntr', '1', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('subcatsOrdering', 'ordering', 'frontpage', NULL),('subcatsShow', '0', 'frontpage', NULL),('subcatsNumber', '5', 'frontpage', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('version', '"._SOBI2_V."', 'version', NULL),('renewDeleteFees', '0', 'payment', NULL),('allowQuickEdit', '0', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_config VALUES ('defTpl', 'default', 'general', NULL);";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_renew_title', '', 'Your entry in {sobi} on {sitename} has been renewed', 'emails', null, 'english');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_renew_text', '', 'Your entry in {sobi} on {sitename} has been renewed. \n {link_details}', 'emails', null, 'english');";

	/* brazilian_portuguese by Elvis Vinicicus <elvisvinicius@gmail.com> */
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_renew_title', '', 'Sua entrada em {sobi} no {sitename} foi renovada', 'emails', null, 'brazilian_portuguese');";
	$installQueries[] = "INSERT IGNORE INTO #__sobi2_language VALUES ('email_on_renew_text', '', 'Sua entrada em {sobi} no {sitename} foi renovada. \n {link_details}', 'emails', null, 'brazilian_portuguese');";

	$msg .= '<big style="font-weight: bold; color: rgb(255, 0, 0);"><big><tt>Instalando dados base...</tt></big></big><br/>';
	foreach ( $installQueries as $query ) {
		$database->setQuery($query);
		$database->query();
		if( $database->getErrorNum() ) {
			defined( 'SIR' ) || define( 'SIR', true );
			$msg .= '<br/>'.$database->stderr();
		}
	}
	return $msg;
}
?>
