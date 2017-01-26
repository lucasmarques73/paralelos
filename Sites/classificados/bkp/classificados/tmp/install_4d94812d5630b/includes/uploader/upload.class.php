<?php
/**
* @version $Id: upload.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class SobiFileUploader {
	/**
	 * upload directory rel.
	 *
	 * @var string
	 */
	var $directory = null;
 	/**
 	 * upload directory abs.
 	 * @var string
 	 */
	var $uploadDirectory = null;
 	/**
 	 * @var string
 	 */
	var $task = null;
 	/**
 	 * @var array
 	 */
	var $filesIds = array();
 	/**
 	 * @var int
 	 */
	var $itemId = null;
 	/**
 	 * @var boolean
 	 */
	var $subDirItem = 1;
 	/**
 	 * @var array
 	 */
	var $filesExtentions = array(
			'jpg',
	 		'gif',
	 		'jpeg',
	 		'png',
	 		'bmp',
	 		'wav',
	 		'mp3',
	 		'midi',
	 		'asf',
	 		'avi',
	 		'pdf',
	 		'zip',
	 		'gz',
	 		'tar',
	 		'rar',
	 		'wma',
	 		'mpg',
	 		'mpeg',
	 		'wmv',
	 		'avi',
	 		'flv',
	 		'mov',
	 		'doc',
	 		'xls',
	 		'odt',
	 );
 	/**
 	 * @var array
 	 */
 	var $disalowedFiles = array(
 						"script",
                        "executable",
                        "html",
                        "xml",
                        "java",
                        "C++ program",
                        "C program",
                        "link",
                        "lib",
                        "object",
                        "python",
                        "perl"
	);
 	/**
 	 * @var array
 	 */
 	var $disalowedText = array(
 						"script",
                        "iframe",
                        "html",
                        "xml",
                        "java",
                        "sql",
                        "CREATE TABLE",
                        "ALTER TABLE",
                        "INSERT INTO",
                        "function",
                        "<?",
                        "bash",
                        "#!",
                        "applet",
                        "meta",
                        "form",
                        "onmouseover",
                        "onmouseout"
	);
	/**
	 * constructor
	 * @param string $task
	 * @param string $subdirectory
	 * @param int $itemId
	 * @param boolean $subDirItem
	 * @return SobiFileUploader
	 */
	function SobiFileUploader($subdirectory = null, $itemId = 0, $subDirItem = true, $init = false, $task = "uploadFile")
	{
    	$config 					=& sobi2Config::getInstance();
		$mainframe					= &$config->getMainframe();
		$directory 					= _SOBI_CMSROOT.DS.trim($subdirectory);
		if($init) {
			$this->task = $task;
			$mainframe->addCustomHeadTag($this->addScript());
		}
		if(!is_dir($directory)) {
			$config->sobiMakePath($directory);
		}
		if(is_dir($directory)) {
			$this->uploadDirectory = $directory;
			$this->directory = $subdirectory;
			$this->itemId = $itemId;
			$this->subDirItem = $subDirItem ? 1 : 0;
			if($subDirItem && $this->itemId) {
				if(!$this->uploadDirectory."/".$this->itemId) {
					$config->sobiMakePath($this->uploadDirectory."/".$this->itemId);
				}
				$this->uploadDirectory .= "/".$this->itemId;
			}
		}
		else {
			trigger_error("SobiFileUploader::SobiFileUploader(): Directory {$directory} does not exist", E_USER_WARNING);
		}
	}
	/**
	 * display, or return field
	 *
	 * @param int $fileId
	 * @param boolean $display
	 * @return string
	 */
	function showField($fileId, $display = true) {
		if (in_array($fileId, $this->filesIds)) {
			trigger_error("SobiFileUploader::showField(): This Id is allready used");
			return null;
		}
		else {
			$this->filesIds[] = $fileId;
			if($display) {
				echo $this->createField($fileId);
			}
			else {
				return $this->createField($fileId);
			}
		}
	}
	/**
	 * uploading file
	 *
	 * @return string
	 */
	function uploadFile()
	{
		defined( '_SOBI2_UPLOADER_CORE_PASSED' ) or die( 'Restricted access' );
		$fileId = sobi2Config::request($_POST,"fileId",null);
		$tempFile = $_FILES["sobiAjaxUpload"]["tmp_name"]["file"];
		if( ( $fileType = exec( 'file '.escapeshellarg( $tempFile ) ) ) && strlen( $fileType ) ) {
			foreach ( $this->disalowedFiles as $value ) {
				if( stristr( $fileType,$value ) ) {
					trigger_error( "SobiFileUploader::uploadFile(): "._SOBI2_UPLOAD_DISSALLOWED_FILETYPE." {$fileType}" );
					echo _SOBI2_UPLOAD_DISSALLOWED_FILETYPE;
					$this->showField( $fileId );
					return null;
				}
			}
			if ( stristr( $fileType,"ASCII" ) ) {
				$c = file_get_contents( $tempFile );
				foreach ( $this->disalowedText as $value ) {
					if( stristr( $c,$value ) ) {
						trigger_error( "SobiFileUploader::uploadFile(): "._SOBI2_UPLOAD_DISSALLOWED_FILETYPE." {$fileType}", E_WARNING);
						echo _SOBI2_UPLOAD_DISSALLOWED_FILETYPE;
						$this->showField( $fileId);
						return null;
					}
				}
			}
		}
		else {
			/**
			 * @todo
			 */
			trigger_error( 'SobiFileUploader::uploadFile(): cannot check file for type' );
		}
		$file = $_FILES["sobiAjaxUpload"]["name"]["file"];
		$allowedFile = false;
		$fileExt = explode( '.', $file );
		$fileExt = $fileExt[ count( $fileExt ) - 1 ];
		foreach( $this->filesExtentions as $allowableExt ) {
			if ( stristr( $fileExt, $allowableExt ) ) {
				$allowedFile = true;
				break;
			}
		}
		if(!$allowedFile) {
			trigger_error("SobiFileUploader::uploadFile(): "._SOBI2_UPLOAD_DISSALLOWED_FILETYPE." {$file}");
			echo _SOBI2_UPLOAD_DISSALLOWED_FILETYPE;
			$this->showField($fileId);
			return null;
		}
		if($allowedFile) {
			$t = $this->uploadDirectory."/".$file;
			$t = str_replace("//","/",$t);
			if(move_uploaded_file($tempFile,$t)) {
				echo _SOBI2_FILE_UPLOADED;
			}
			else {
				echo _SOBI2_FILE_NOT_UPLOADED;
				$this->showField($fileId);
				return null;
			}
		}
	}
	/**
	 * build field for upload
	 *
	 * @param int $fileId
	 * @return string
	 */
	function createField( $fileId )
	{
    	$config =& sobi2Config::getInstance();
		$index 	= $config->key( "frontpage", "upload_ajax_target_file", "index2.php" );
		$href = "{$config->liveSite}/{$index}?option=com_sobi2&sobi2Task={$this->task}&no_html=1&sobi2Id={$this->itemId}&subdir={$this->directory}&subDirItem={$this->subDirItem}";
		ob_start();
		?>
		<div id="respCont_<?php echo $fileId; ?>">
 			<form id="form_<?php echo $fileId; ?>" name="form_<?php echo $fileId; ?>" action="<?php echo $href;?>" method="post" enctype="multipart/form-data" onsubmit="return AIM.submit(this, {'onStart' : startCallback, 'onComplete' : completeCallback}, 'respCont_<?php echo $fileId; ?>')">
 				<div>
 					<label>
 						<?php echo _SOBI2_UPLOAD_FILE;?>
 					</label>
 					<input type="file" name="sobiAjaxUpload[file]" />
 					<input type="submit" class="button" value="<?php echo _SOBI2_UPLOAD;?>" />
 				</div>
     		</form>
 		</div>
 		<input type="hidden" name="files[]" value="<?php echo $fileId; ?>"/>
		<?php
		$field = ob_get_contents();
		ob_end_clean();
		return $field;
	}
	/**
	 * build java script
	 *
	 * @return string
	 */
	function addScript() {
		ob_start();
		?>
		<script type="text/javascript">
		/**
		*
		*  AJAX IFRAME METHOD (AIM)
		*  http://www.webtoolkit.info/
		*
		**/
        var respCont = "";
        function startCallback() {
             // make something useful before submit (onStart)
             return true;
         }
         function completeCallback(response) {
             document.getElementById(respCont).innerHTML = response;
         }
 		 AIM = {
			frame : function(c) {
				var n = 'f' + Math.floor(Math.random() * 99999);
				var d = document.createElement('DIV');
				d.innerHTML = '<iframe style="display:none" src="about:blank" id="'+n+'" name="'+n+'" onload="AIM.loaded(\''+n+'\')"></iframe>';
				document.body.appendChild(d);
				var i = document.getElementById(n);
				if (c && typeof(c.onComplete) == 'function') {
					i.onComplete = c.onComplete;
				}
				return n;
			},
			form : function(f, name) {
				f.setAttribute('target', name);
			},
			submit : function(f, c, d) {
				respCont = d;
				AIM.form(f, AIM.frame(c));
				if (c && typeof(c.onStart) == 'function') {
					return c.onStart();
				} else {
					return true;
				}
			},
			loaded : function(id) {
				var i = document.getElementById(id);
				if (i.contentDocument) {
					var d = i.contentDocument;
				} else if (i.contentWindow) {
					var d = i.contentWindow.document;
				} else {
					var d = window.frames[id].document;
				}
				if (d.location.href == "about:blank") {
					return;
				}
				if (typeof(i.onComplete) == 'function') {
					i.onComplete(d.body.innerHTML);
				}
			}
		}
		</script>
		<?php
		$script = ob_get_contents();
		ob_end_clean();
		return $script;
	}
}
?>