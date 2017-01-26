<?php
/**
* @version $Id: adm.installer.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
 * no direct access
 */
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class sobi2Installer {
    /**
     * Enter description here...
     *
     * @return string
     */
    function installPlugin()
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
    	$msg = _SOBI2_PLUGINS_INSTALLER_ERROR;
    	if(isset($_FILES["sobi2Lang"]) && is_array($_FILES["sobi2Lang"])){
    		$file = $_FILES["sobi2Lang"];
    		$fileExt = substr( $file['name'], -3 );
    		if($fileExt == 'zip') {
    			$packageName = strtolower(substr( $file['name'], 0,-4 ));
    			$path = _SOBI_ADM_PATH.DS."includes".DS."install".DS;
    			if(is_dir($path.$packageName)) {
    				$config->removeDirRecursive($path.$packageName);
    			}
				chdir($path);
				@mkdir($packageName,0777);
    			$path = "{$path}{$packageName}".DS;
    			@sobi2Config::chmodRecursive($path,0777,0777);
    			if(@move_uploaded_file($file['tmp_name'], $path.strtolower($packageName.'.zip'))) {
    				sobi2Config::import("administrator|includes|pcl|pclzip.lib", "root");
    				$zipfile = new PclZip($path.$packageName.'.zip');
    				if(!$zipfile->extract(PCLZIP_OPT_PATH, $path)) {
    					$msg = _SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR;
    					trigger_error("adminConfig::installPlugin():"._SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR." {$path}, {$packageName} ", E_USER_WARNING );
    				}
    				else {
    					sobi2Config::import("includes|xml_domit|xml_domit_lite_parser", "adm");
    					$dir = opendir($path);
    					$foundXML = false;
    					while ($installFile = readdir($dir)) {
    						if (strstr($installFile, ".xml")) {
    							$XMLfile = $installFile;
    							$foundXML = true;
    							break;
    						}
    					}
    					closedir($dir);
    					if (!$foundXML) {
    						return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE.' : '.__LINE__;
    					}
    					$packageName = str_replace(".xml", null, $XMLfile);
    					$newPath = _SOBI_ADM_PATH.DS."includes".DS."install".DS.$packageName.DS;
		    			if($path != $newPath) {
		    				if (is_dir($newPath)) {
		    					$config->removeDirRecursive($newPath);
		    				}
							rename($path, $newPath);
							$path = $newPath;
		    			}
		    			$XMLfile = $path.$XMLfile;
    					$xmlDoc = new DOMIT_Lite_Document();
						$xmlDoc->resolveErrors( true );
						$iso = explode( '=', _ISO );
						if( !strstr( strtoupper( $iso[1]), 'UTF' ) ) {
							if (!$xmlDoc->loadXML( $XMLfile, false, true )) {
								return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
							}
						}
						else {
							if (!$xmlDoc->loadXML_utf8( $XMLfile, false, true )) {
								return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
							}
						}
						$root = $xmlDoc->documentElement;
						if($root->getTagName() != 'sobi2plugin') {
							return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
						}
						/*
						 * getting basic information
						 */
						$node = $root->getElementsByPath('name',1);
						$name = $node->getText();
						$node = $root->getElementsByPath('nameId',1);
						$nameId = $node->getText();
						$node = $root->getElementsByPath('description',1);
						$description = $node->getText();
						$node = $root->getElementsByPath('author',1);
						$author = $node->getText();
						$node = $root->getElementsByPath('authorEmail',1);
						$authorEmail = $node->getText();
						$node = $root->getElementsByPath('authorUrl',1);
						$authorUrl = $node->getText();
						$node = $root->getElementsByPath('version',1);
						$version = $node->getText();
						$node = $root->getElementsByPath('initFile',1);
						$initFile = $node->getText();

						$query = "SELECT COUNT(*) FROM `#__sobi2_plugins` WHERE `name_id` = '{$nameId}'";
						$database->setQuery( $query );
						$exist = $database->loadResult();
						if($database->getErrorNum()) {
							trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
						}
						if($exist) {
							return _SOBI2_PLUGINS_INSTALLER_ALLREADY_EXISTST.' : '.__LINE__;
						}
						$pos = count($config->S2_plugins) + 1;
						$statement = "INSERT INTO `#__sobi2_plugins` " .
								"( `name_id` , `version` , `name` , `in_details` , `in_listing` , " .
								"`description` , `author` , `author_email` , `author_url` , `position` , " .
								"`init_file` , `options` , `params` , `list_pos` , `dv_pos` , `form_pos` , `enabled` ) " .
								"VALUES ( '{$nameId}', '{$version}', '{$name}', '1', '1', '{$description}', '{$author}', " .
								"'{$authorEmail}', '{$authorUrl}', '{$pos}', '{$initFile}', NULL , NULL , NULL , NULL , NULL , '1') ;";
						$database->setQuery($statement);
						$database->query();
						if($database->getErrorNum()) {
							trigger_error("adminConfig::installPlugin():".$database->stderr());
							return "DB Error";
						}
						/*
						 * get id
						 */
						$query = "SELECT MAX(`id`) FROM `#__sobi2_plugins`";
						$database->setQuery( $query );
						$pid = $database->loadResult();
						if($database->getErrorNum()) {
							trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
						}

						/*
						 * create folder
						 */
						$frontPath = _SOBI_FE_PATH.DS."plugins".DS.$nameId;
						$config->sobiMakePath( $frontPath );
						$FilesNode = $root->getElementsByPath( 'files', 1 );
						$FeFiles = $FilesNode->getElementsByPath( 'frontend', 1 );
						$files = $FeFiles->childNodes;
						if( count( $files ) ) {
							foreach ( $files as $file ) {
								$FileName = $file->getText();
								$Folder = $file->getAttribute( 'folder' );
								if( $Folder ) {
									$Folder = str_replace( array( '\\', '/', '|' ), DS, $Folder );
									if( !sobi2Config::translateDirPath( "{$frontPath}|{$Folder}", 'absolute', true ) ) {
										$config->sobiMakePath( sobi2Config::translateDirPath( $frontPath, 'absolute' ), $Folder );
									}
									if( file_exists( $path.$Folder.DS.$FileName ) ) {
										if( !@copy( $path.$Folder.DS.$FileName, $frontPath.DS.$Folder.DS.$FileName ) ) {
											trigger_error( "adminConfig::installPlugin(): Could not copy {$path}{$Folder}/{$FileName} to {$frontPath}/{$Folder}/{$FileName}", E_USER_WARNING );
											return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
										}
									}
									elseif ( file_exists( $path.DS.$FileName ) ) {
										if( !@copy( $path.$FileName, $frontPath.DS.$Folder.DS.$FileName ) ) {
											trigger_error( "adminConfig::installPlugin(): Could not copy {$path}{$FileName} to {$frontPath}/{$Folder}/{$FileName}", E_USER_WARNING );
											return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
										}
									}
									else {
										trigger_error( "adminConfig::installPlugin(): Could find file {$FileName} within the package", E_USER_WARNING );
										return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
									}
								}
								else {
									if( !@copy( "{$path}{$FileName}", $frontPath.DS.$FileName ) ) {
										trigger_error("adminConfig::installPlugin(): Could not copy {$path}{$FileName} to {$frontPath}/{$FileName}");
										return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
									}
								}
							}
						}
						$backendPath = _SOBI_ADM_PATH.DS."plugins".DS.$nameId;
						$config->sobiMakePath( $backendPath );
						$BeFiles = $FilesNode->getElementsByPath( 'backend', 1 );
						$files = $BeFiles->childNodes;
						if( count( $files ) ) {
							foreach ( $files as $file ) {
								$FileName = $file->getText();
								$Folder = $file->getAttribute( 'folder' );
								if( $Folder ) {
									$Folder = str_replace( array( '\\', '/', '|' ), DS, $Folder );
									if( !sobi2Config::translateDirPath( "{$backendPath}|{$Folder}", 'absolute', true ) ) {
										$config->sobiMakePath( sobi2Config::translateDirPath( $backendPath, 'absolute' ), $Folder );
									}
									if( file_exists( $path.$Folder.DS.$FileName ) ) {
										if( !@copy( $path.$Folder.DS.$FileName, $backendPath.DS.$Folder.DS.$FileName ) ) {
											trigger_error( "adminConfig::installPlugin(): Could not copy {$path}{$Folder}/{$FileName} to {$backendPath}/{$Folder}/{$FileName}", E_USER_WARNING );
											return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
										}
									}
									elseif ( file_exists( $path.DS.$FileName ) ) {
										if( !@copy( $path.$FileName, $backendPath.DS.$Folder.DS.$FileName ) ) {
											trigger_error( "adminConfig::installPlugin(): Could not copy {$path}{$FileName} to {$backendPath}/{$Folder}/{$FileName}", E_USER_WARNING );
											return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
										}
									}
									else {
										trigger_error( "adminConfig::installPlugin(): Could find file {$FileName} within the package", E_USER_WARNING );
										return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
									}
								}
								else {
									if( !@copy( "{$path}{$FileName}", $backendPath.DS.$FileName ) ) {
										trigger_error("adminConfig::installPlugin(): Could not copy {$path}{$FileName} to {$backendPath}/{$FileName}");
										return _SOBI2_PLUGINS_INSTALLER_COPY_ERROR.' : '.__LINE__;
									}
								}
							}
						}
						/*
						 * db queries
						 */
						$db = $root->getElementsByPath( 'queries', 1 );
						$queries = $db->childNodes;
						if( count( $queries ) ) {
							foreach( $queries as $query ) {
								$statement = $query->getText();
								if(strstr($statement,'_sobi2_config') || strstr($statement,'_sobi2_field') || strstr($statement,'_sobi2_cat') || strstr($statement,'_sobi2_lang')) {
									$statement = $query->getText();
								}
								else {
									$statement = str_replace('#__', '#__sobi2_plugin_', $query->getText());
								}

								$database->setQuery($statement);
								$database->query();
								if($database->getErrorNum()) {
									trigger_error("adminConfig::installPlugin():".$database->stderr(), E_USER_WARNING );
									return "Error inserting: {$statement}";
								}
								$table = $query->getAttribute("table");
								if(sizeof($table) > 0) {
									$table = $query->getAttribute("table");
									$statement = "INSERT INTO `#__sobi2_plugins_tables` ( `pid` , `table` )" .
												 "VALUES ( '{$pid}', '{$table}' ); ";
									$database->setQuery($statement);
									$database->query();
									if($database->getErrorNum()) {
										trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
									}
								}
							}
						}
						$installPath = $path;
						if(file_exists("{$backendPath}".DS."install.php")) {
							include_once("{$backendPath}".DS."install.php");
						}
						$msg = $nameId._SOBI2_PLUGINS_INSTALLER_INSTALLED;
						$config->removeDirRecursive($installPath);
    				}
    			}
    		}
    	}
    	$config->sobiCache->clearAll();
    	return $msg;
    }

    /**
     * Enter description here...
     *
     * @return string
     */
    function installTemplate()
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', 'templates' );
    	$msg = null;
    	if( isset( $_FILES[ 'sobi2tpl' ] ) && is_array( $_FILES[ 'sobi2tpl' ] ) ) {
    		$file = $_FILES[ 'sobi2tpl' ];
    		$fileExt = substr( $file[ 'name' ], -3 );
    		if( $fileExt == 'zip' ) {
    			$packageName = strtolower( substr( $file[ 'name' ], 0,-4 ) );
    			$path = _SOBI_ADM_PATH.DS."includes".DS."install".DS;
    			chdir( $path );
    			if( !is_dir( $packageName ) ) {
    				mkdir( $packageName, 0777 );
    			}
    			$path = "{$path}{$packageName}".DS;
    			sobi2Config::chmodRecursive( $path,0777,0777 );
    			if( move_uploaded_file( $file[ 'tmp_name' ], $path.strtolower( $packageName.'.zip' ) ) ) {
    				sobi2Config::import( 'administrator|includes|pcl|pclzip.lib', 'root' );
    				$zipfile = new PclZip( $path.$packageName.'.zip' );
    				if( !$zipfile->extract( PCLZIP_OPT_PATH, $path ) ) {
    					$msg = _SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR.' : '.__LINE__;
    					trigger_error( 'adminConfig::installLang():'._SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR." {$path}, {$packageName} " );
    				}
    				else {
    					sobi2Config::import( 'includes|xml_domit|xml_domit_lite_parser', 'adm' );
    					$dir = opendir( $path );
    					$foundXML = false;
    					while ( $installFile = readdir( $dir ) ) {
    						if ( strstr( $installFile, '.xml' ) ) {
    							$XMLfile = $installFile;
    							$foundXML = true;
    							break;
    						}
    					}
    					closedir( $dir );
    					if ( !$foundXML ) {
    						sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE.' : '.__LINE__ );
    						return;
    					}
    					$packageName = str_replace( '.xml', null, $XMLfile );
    					mkdir( sobi2Config::translateDirPath( "templates|{$packageName}", 'front', false ) );
    					$newPath = _SOBI_ADM_PATH.DS.'includes'.DS.'install'.DS.$packageName.DS;
		    			if( $path != $newPath ) {
		    				if ( is_dir( $newPath ) ) {
		    					$config->removeDirRecursive( $newPath );
		    				}
							rename( $path, $newPath );
							$path = $newPath;
		    			}
		    			$XMLfile = $path.$XMLfile;
    					$xmlDoc = new DOMIT_Lite_Document();
						$xmlDoc->resolveErrors( true );
						$iso = explode( '=', _ISO );
						if( !strstr( strtoupper( $iso[1]), 'UTF' ) ) {
							if (!$xmlDoc->loadXML( $XMLfile, false, true )) {
								sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__ );
							}
						}
						else {
							if (!$xmlDoc->loadXML_utf8( $XMLfile, false, true )) {
								sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__ );
							}
						}
						$root = $xmlDoc->documentElement;
						if( $root->getTagName() != 'sobi2template' ) {
							sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__ );
						}
						if( file_exists( $path.'sobi2.details.tmpl.php' ) ) {
							copy( $path.'sobi2.details.tmpl.php', sobi2Config::translatePath( "templates|{$packageName}|sobi2.details.tmpl", 'front', false ) );
						}
						if( file_exists( $path.'sobi2.vc.tmpl.php' ) ) {
							copy( $path.'sobi2.vc.tmpl.php', sobi2Config::translatePath( "templates|{$packageName}|sobi2.vc.tmpl", 'front', false ) );
						}
						if( file_exists( $path.'sobi2.form.tmpl.php' ) ) {
							copy( $path.'sobi2.form.tmpl.php', sobi2Config::translatePath( "templates|{$packageName}|sobi2.form.tmpl", 'front', false ) );
						}
						$File = $root->getElementsByPath( 'thumb', 1 );
						if( $File ) {
							$thumb = $File->getText();
							if( $thumb ) {
								copy( $path.$thumb, sobi2Config::translatePath( "templates|{$packageName}|{$thumb}", 'front', false, '' ) );
							}
						}
						copy( $path.$packageName.'.xml', sobi2Config::translatePath( "templates|{$packageName}|{$packageName}", 'front', false, '.xml' ) );
						$afiles = $root->getElementsByPath( 'files', 1 );
						if( $afiles->hasChildNodes() ) {
							$files = $afiles->childNodes;
							if( !empty( $files ) ) {
								foreach ( $files as $afile ) {
									$folder = $afile->getAttribute( 'folder' );
									$afileName = $afile->getText();
									if( $folder ) {
										$folder = str_replace( array( '\\', '/', '|' ), DS, $folder );
										if( !sobi2Config::translateDirPath( "templates|{$packageName}|{$folder}", 'front', true ) ) {
											$config->sobiMakePath( sobi2Config::translateDirPath( "templates|{$packageName}" ), $folder );
										}
										if( file_exists( $path.$afileName ) ) {
											copy( $path.$afileName, sobi2Config::translatePath( "templates|{$packageName}|{$folder}|{$afileName}", 'front', false, '' ) );
										}
										elseif( file_exists( $path.$folder.DS.$afileName ) ) {
											copy( $path.$folder.DS.$afileName, sobi2Config::translatePath( "templates|{$packageName}|{$folder}|{$afileName}", 'front', false, '' ) );
										}
										else {
											trigger_error( "Cannot find file {$afileName} in package", E_USER_WARNING );
										}
									}
									elseif( file_exists( $path.$afileName ) ) {
										copy( $path.$afileName, sobi2Config::translatePath( "templates|{$packageName}|{$afileName}", 'front', false, '' ) );
									}
									else {
										trigger_error( "Cannot find file {$afileName} in package", E_USER_WARNING );
									}
								}
							}
						}
					}
					$node = $root->getElementsByPath( 'name', 1 );
					if( $node ) {
						$packageName = $node->getText();
					}
					$config->removeDirRecursive( $path );
					$msg = str_replace( '%name%', "'{$packageName}'", _SOBI2_TPL_INSTALLED_OK );
    			}
    			else {
    				$msg = _SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR.' : '.__LINE__;
    			}
    		}
    		else {
    			$msg = _SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR.' : '.__LINE__;
    		}
    	}
    	else {
    		$msg = _SOBI2_CONFIG_LANGMAN_NO_FILE.' : '.__LINE__;
    	}
    	sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
    }

    /**
     * Enter description here...
     *
     * @return string
     */
    function installLang()
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
    	$msg = null;
    	if(isset($_FILES["sobi2Lang"]) && is_array($_FILES["sobi2Lang"])){
    		$file = $_FILES["sobi2Lang"];
    		$fileExt = substr( $file['name'], -3 );
    		if($fileExt == 'zip') {
    			$packageName = strtolower(substr( $file['name'], 0,-4 ));
    			$path = _SOBI_ADM_PATH.DS."includes".DS."install".DS;
    			chdir($path);
    			if(!is_dir($packageName)) {
    				@mkdir($packageName,0777);
    			}
    			$path = "{$path}{$packageName}".DS;
    			@sobi2Config::chmodRecursive($path,0777,0777);
    			if(@move_uploaded_file($file['tmp_name'], $path.strtolower($packageName.'.zip'))) {
    				sobi2Config::import("administrator|includes|pcl|pclzip.lib", "root");
    				$zipfile = new PclZip($path.$packageName.'.zip');
    				if(!$zipfile->extract(PCLZIP_OPT_PATH, $path)) {
    					$msg = _SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR;
    					trigger_error("adminConfig::installLang():"._SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR." {$path}, {$packageName} ");
    				}
    				else {
    					sobi2Config::import("includes|xml_domit|xml_domit_lite_parser", "adm");
    					$dir = opendir($path);
    					$foundXML = false;
    					while ($installFile = readdir($dir)) {
    						if (strstr($installFile, ".xml")) {
    							$XMLfile = $installFile;
    							$foundXML = true;
    							break;
    						}
    					}
    					closedir($dir);
    					if (!$foundXML) {
    						return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE.' : '.__LINE__;
    					}
    					$packageName = str_replace(".xml", null, $XMLfile);
    					$newPath = _SOBI_ADM_PATH.DS."includes".DS."install".DS.$packageName.DS;
		    			if($path != $newPath) {
		    				if (is_dir($newPath)) {
		    					$config->removeDirRecursive($newPath);
		    				}
							rename($path, $newPath);
							$path = $newPath;
		    			}
		    			$XMLfile = $path.$XMLfile;
    					$xmlDoc = new DOMIT_Lite_Document();
						$xmlDoc->resolveErrors( true );
						$iso = explode( '=', _ISO );
						if( !strstr( strtoupper( $iso[1]), 'UTF' ) ) {
							if (!$xmlDoc->loadXML( $XMLfile, false, true )) {
								return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
							}
						}
						else {
							if (!$xmlDoc->loadXML_utf8( $XMLfile, false, true )) {
								return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
							}
						}
						$root = $xmlDoc->documentElement;
						if($root->getTagName() != 'sobi2lang') {
							return _SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR.' : '.__LINE__;
						}

						$lang = $root->getElementsByPath('language',1);
						$language = $lang->getText();

						$files = $root->getElementsByPath('files',1);

						$File = $files->getElementsByPath('front_file',1);
						@sobi2Config::chmodRecursive( _SOBI_FE_PATH.DS."languages",0777,0777);
						@sobi2Config::chmodRecursive( _SOBI_ADM_PATH.DS."languages", 0777,0777);
						if($File)
							$frontFile = $File->getText();
						if (!$frontFile || (!copy($path.$frontFile, _SOBI_FE_PATH.DS."languages".DS.$frontFile))) {
							return _SOBI2_CONFIG_LANGMAN_FP_FILE_COPY_ERROR.' : '.__LINE__;
						}

						$File = $files->getElementsByPath('backend_file',1);
						if($File) {
							$beFile = $File->getText();
							if (!$beFile || (!copy($path.$beFile, _SOBI_ADM_PATH.DS."languages".DS.$beFile))) {
								$msg .= _SOBI2_CONFIG_LANGMAN_BE_FILE_COPY_ERROR.' : '.__LINE__;
							}
						}

						$File = $files->getElementsByPath('syscheck_file',1);
						if($File) {
							$scFile = $File->getText();
							if (!$scFile || (!copy($path.$scFile, _SOBI_ADM_PATH.DS."languages".DS.$scFile))) {
								;
							}
						}

						$File = $files->getElementsByPath('flag_img',1);
						if($File)
							$imgFile = $File->getText();
						if ($imgFile)
							@copy($path.$imgFile, _SOBI_ADM_PATH.DS."images".DS."flags".DS.$imgFile);

						$xml = str_replace(".php", ".xml", $frontFile);
						@copy($XMLfile, _SOBI_ADM_PATH.DS."languages".DS.$xml);

						$File = $files->getElementsByPath('about_file',1);
						if($File) {
							$aboutFile = $File->getText();
							if ($aboutFile)	{
								@copy($path.$aboutFile, _SOBI_ADM_PATH.DS."includes".DS."about".DS.$aboutFile);
							}
						}
						$labels = $root->getElementsByPath('labels',1);
						$Labels = array();
						if(!$labels->hasChildNodes())
							$msg .= _SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR.' : '.__LINE__;
						$Labels = $labels->childNodes;
						if(count($Labels) == 0)
							$msg .= _SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR.' : '.__LINE__;

						$labelMsg = _SOBI2_CONFIG_LANGMAN_ALL_LABELS_INSTALLED;
						foreach($Labels as $Label) {
							$fieldId = $Label->getAttribute("id");
							$fieldName = "field_".$Label->getAttribute("name");
							$fieldLabel = $Label->getText();
							$statement = "INSERT INTO `#__sobi2_language` VALUES ('{$fieldName}', '{$fieldLabel}', '', 'fields', {$fieldId}, '{$language}') ON DUPLICATE KEY UPDATE langValue = '{$fieldLabel}';";
							$database->setQuery($statement);
							$database->query();
							if ($database->getErrorNum()) {
									$statement = "UPDATE `#__sobi2_language` " .
											 "SET `langKey` = '{$fieldName}', " .
											 "`langValue` = '{$fieldLabel}', " .
											 "`sobi2Section` = 'fields', " .
											 "`fieldid`= '{$fieldId}' " .
											 " WHERE (`langKey` = '{$fieldName}' AND " .
											 "`sobi2Lang` = '{$language}');";
									$database->setQuery($statement);
									$database->query();
									if($database->getErrorNum()) {
										trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
										$labelMsg = _SOBI2_CONFIG_LANGMAN_NOT_ALL_LABELS_INSTALLED;
									}
							}
						}
						$msg .=  $labelMsg;
    				}
					@sobi2Config::chmodRecursive( _SOBI_FE_PATH.DS."languages",0777,0777);
					@sobi2Config::chmodRecursive( _SOBI_ADM_PATH.DS."languages", 0777,0777);
					@sobi2Config::chmodRecursive($path,0664,0775);
					$config->removeDirRecursive($path);
    			}
    			else {
    				$msg = _SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR.' : '.__LINE__;
    			}
    		}
    		else {
    			$msg = _SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR.' : '.__LINE__;
    		}
    	}
    	else {
    		$msg = _SOBI2_CONFIG_LANGMAN_NO_FILE.' : '.__LINE__;
    	}
    	return $msg;
    }
    function removeTpl( $tpl )
    {
    	if( strlen( $tpl ) < 3 ) {
    		return _SOBI2_INSTALLER_TPL_DELETE_ERROR.' : '.__LINE__;
    	}
    	$config =& adminConfig::getInstance();
    	if( !sobi2Config::translateDirPath( 'templates|'.$tpl, 'front', true ) ) {
			return _SOBI2_INSTALLER_TPL_DELETE_ERROR.' : '.__LINE__;
    	}
    	if( $config->removeDirRecursive( sobi2Config::translateDirPath( 'templates|'.$tpl ) ) ) {
    		return str_replace( '%name%', "'{$tpl}'",  _SOBI2_INSTALLER_TPL_DELETE_OK );
    	}
    	else {
    		return _SOBI2_INSTALLER_TPL_DELETE_ERROR.' : '.__LINE__;
    	}
    }
	function removeLang( $lang )
	{
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
		if( $lang != "english" ) {
			$statement = "DELETE FROM #__sobi2_language WHERE  sobi2Lang = '{$lang}'";
			$database->setQuery( $statement );
			$database->query();
			if( $database->getErrorNum() ) {
				trigger_error( "DB reports: ".$database->stderr(), E_USER_WARNING );
			}
		}
		if( !$lang ) {
			return "Error G1";
		}
		$msg = _SOBI2_LANG_REMOVED;
		if( $file = sobi2Config::translatePath( "languages|{$lang}", "adm", true, ".xml" ) ) {
			if( !unlink( $file ) ) {
				$msg = _SOBI2_LANG_REM_ERROR.' : '.__LINE__." (X1)";
				trigger_error("adminConfig::removeLang(): Cannot remove file: {$file}");
			}
		}
		else {
			return  _SOBI2_LANG_NOT_REM_ERROR;
		}
		if($file = sobi2Config::translatePath( "images|flags|{$lang}", "adm", true, ".gif")) {
			if(!unlink($file)) {
				$msg = _SOBI2_LANG_REM_ERROR.' : '.__LINE__." (I1)";
				trigger_error("adminConfig::removeLang(): Cannot remove file: {$file}");
			}
		}
		if($file = sobi2Config::translatePath( "languages|admin.{$lang}", "adm", true )) {
			if(!unlink($file)) {
				$msg = _SOBI2_LANG_REM_ERROR.' : '.__LINE__." (B1)";
				trigger_error("adminConfig::removeLang(): Cannot remove file: {$file}");
			}
		}
		if($file = sobi2Config::translatePath( "languages|{$lang}")) {
			if(!unlink($file)) {
				$msg = _SOBI2_LANG_REM_ERROR.' : '.__LINE__." (F1)";
				trigger_error("adminConfig::removeLang(): Cannot remove file: {$file}");
			}
		}
		else {
			$msg = _SOBI2_LANG_REM_ERROR.' : '.__LINE__." (F2)";
		}
		return $msg;
	}
    function removePlugin( $pid = 0, $pTables = null )
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
    	$msg = null;
    	if( !$pid && ( !is_array( $pTables ) || empty( $pTables ) ) ) {
    		return _SOBI2_PLUGINS_INSTALLER_PID_MISSING.' : '.__LINE__;
    	}
    	if( $pid ) {
    		$query = "SELECT `name_id` FROM `#__sobi2_plugins` WHERE `id` = '{$pid}'";
			$database->setQuery( $query );
			$plugin = $database->loadResult();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
						/*
			 * removing files
			 */
			@sobi2Config::chmodRecursive( $config->S2_pluginsPath.DS.$plugin.DS,0777,0777);
			@sobi2Config::chmodRecursive( $config->S2_pluginsAdmPath.DS.$plugin.DS,0777,0777);
			$delMsg = false;

			if(!($config->removeDirRecursive( $config->S2_pluginsPath.DS.$plugin.DS ) ) ) {
				$delMsg = true;
			}

			if(!($config->removeDirRecursive( $config->S2_pluginsAdmPath.DS.$plugin.DS ) ) ) {
				$delMsg = true;
			}

			if($delMsg) {
				$msg .= _SOBI2_PLUGINS_INSTALLER_PI_DELETE_FILES_ERROR.' : '.__LINE__;
			}

			@sobi2Config::chmodRecursive( $config->S2_pluginsPath, 0664,0775);
			@sobi2Config::chmodRecursive( $config->S2_pluginsAdmPath ,0664,0775);
	    }
		if(count( $pTables )) {
			foreach( $pTables as $table ) {
				$statement = "DROP TABLE `{$table}`";
				$database->setQuery($statement);
				$database->query();
				if($database->getErrorNum()) {
					$msg .= _SOBI2_PLUGINS_INSTALLER_PI_DROP_ERROR.' : '.__LINE__;
					trigger_error("adminConfig::removePlugin(): Cannot drop table '{$table}'", E_USER_WARNING);
				}
				else {
					$msg .= "\n{$table} "._SOBI2_PLUGINS_DATATABLE_DELETED;
				}
			}
		}
		$statement = "DELETE FROM `#__sobi2_plugins` WHERE `id` = '{$pid}'";
		$database->setQuery($statement);
		$database->query();
		if($database->getErrorNum()) {
			$msg .= _SOBI2_PLUGINS_INSTALLER_PI_DELETE_ERROR.' : '.__LINE__;
			trigger_error("adminConfig::removePlugin(): Cannot remove plugin entry", E_USER_WARNING);
		}
		if(!$msg) {
			$msg .= isset($plugin) ? $plugin . _SOBI2_PLUGINS_INSTALLER_REMOVED : _SOBI2_PLUGINS_INSTALLER_REMOVED;
		}
		$config->sobiCache->clearAll();
		return  $msg;
    }
    /**
     * @param string $which
     */
    function saveTemplate( $which = null )
    {
    	$config =& adminConfig::getInstance();
    	$option = "com_sobi2";
		$tplcontent = $_REQUEST['templateContent'];
		$enable_write = sobi2Config::request($_POST,'enable_write',null);
		$disable_write = sobi2Config::request($_POST,'disable_write',null);
		$tpl = sobi2Config::request( $_REQUEST, 'stpl', $config->defTemplate );
		if( $which == "vc") {
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.vc.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
			}
			$config->useDetailsView = (int) sobi2Config::request($_POST,'useDetailsView',0);
			$config->setValueInDB($config->useDetailsView,"useDetailsView","frontpage");
			$redirect_url =  "index2.php?option={$option}&task=editVCTemplate&stpl={$tpl}";
		}
		elseif ( $which == "form" ) {
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.form.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.form.tmpl" );
			}
			$config->useDetailsView = (int) sobi2Config::request($_POST,'useFormTpl',0);
			$config->setValueInDB($config->useDetailsView,"useFormTpl","general");
			$redirect_url =  "index2.php?option={$option}&task=editFormTemplate&stpl={$tpl}";
		}
		else {
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.details.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.details.tmpl" );
			}
			$redirect_url =  "index2.php?option=$option&task=editTemplate&stpl={$tpl}";
		}
		if (!$tplcontent ){
			$redirect_msg = "Operation failed: no content";
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $redirect_url, $redirect_msg );
		}
		if ($enable_write) {
			chmod($templatefile, 0770);
		}
		if (is_writable( $templatefile ) == false){
			$redirect_msg = "Operation failed: file is unwritable";
			$config->sobiCache->clearAll();
			sobi2Config::redirect( $redirect_url, $redirect_msg );
		}
		if ($fileopen = fopen ($templatefile, "w")) {
			if(!(fputs( $fileopen, stripslashes( $tplcontent ) ))) {
				$redirect_msg = "Cannot write into file {$templatefile}";
			}
			else {
				$redirect_msg = _SOBI2_CHANGES_SAVED;
			}
			fclose( $fileopen );
		}
		if ($disable_write) {
			chmod($templatefile, 0440);
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $redirect_url, $redirect_msg );
    }
    function saveCSS()
    {
		$option = "com_sobi2";
		$csscontent = sobi2Config::request( $_POST, 'csscontent', '', 0x0002 );
		$enable_write = sobi2Config::request($_POST,'enable_write',null);
		$disable_write = sobi2Config::request($_POST,'disable_write',null);
    	$config =& adminConfig::getInstance();
		$cssfile =  $config->absolutePath.DS."components".DS."com_sobi2".DS."includes".DS."com_sobi2.css";
		if (!$csscontent ){
			$redirect_url =  "index2.php?option={$option}&task=editCSS";
			$redirect_msg = "Operation failed: no content";
			sobi2Config::redirect( $redirect_url, $redirect_msg );
		}
		if ($enable_write) {
			chmod( $cssfile, 0770 );
		}
		if (is_writable( $cssfile ) == false){
			$redirect_url =  "index2.php?option={$option}&task=editCSS";
			$redirect_msg = "Operation failed: file is unwritable";
			sobi2Config::redirect( $redirect_url, $redirect_msg );
		}
		if ($fileopen = fopen ($cssfile, "w")) {
			fputs( $fileopen, stripslashes( $csscontent ) );
			fclose( $fileopen );
			$redirect_msg = _SOBI2_CHANGES_SAVED;
			$redirect_url =  "index2.php?option={$option}&task=editCSS";
		}
		if ($disable_write) {
			chmod( $cssfile, 0440 );
		}
		sobi2Config::redirect( $redirect_url, $redirect_msg );
    }
	function removeSobi()
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$query = "show tables like '{$config->DBprefix}sobi2_%'";
		$database->setQuery( $query );
		$tables = $database->loadResultArray();
		$ok = true;
		$t = null;
		foreach( $tables as $table ) {
			$t .= "Dropping table <span style=\"color:red;\">{$table}</span><br/>" ;
			$database->setQuery( "DROP TABLE {$table};" );
			if ( !$database->query() ) {
				$ok = false;
			}
		}
		sobi2Config::debOut( $t );
		if ( $ok ) {
			sobi2Config::redirect( "index2.php?option=com_installer&element=component", _SOBI2_DB_REMOVED_MSG );
		}
		else {
			sobi2Config::redirect( "index2.php?option=com_installer&element=component", _SOBI2_DB_REMOVE_ERROR_MSG );
		}
	}
}
?>