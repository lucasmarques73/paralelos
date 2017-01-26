<?php
/**
* @package	 ccVAOM
* @author    Chill Creations <info@chillcreations.com>
* @link      http://www.chillcreations.com
* @copyright Copyright (C) 2009 - 2010 Chill Creations
* @license	 GNU/GPL, see LICENSE.php for full license.
**/
defined('_JEXEC') or die('Restricted access');

class versionRead{

	var $targetFile;
	var $error;
	var $errorText;
	var $data;
	var $timeout;

	function versionRead($targetFile){
		//INITIALIZE
		$this->targetFile=$targetFile;
		$this->error=false;
		$this->timeout=10; //TIMEOUT IN SECONDS

		if(!empty($this->targetFile)){
			$this->downloadContents();
		}
		else{
			$this->errorText="Filename not specififed in class constructor";
			$this->error=true;
		}
	}

	function getFileContents(){
		if(!$this->hasError()){
			return $this->data;
		}
		return false;
	}

	function hasError(){
		if($this->error){
			return true;
		}
		return false;
	}

	function getError(){
		return $this->errorText;
	}

	function downloadContents(){
		$data=NULL;
		//CHECK TO SEE IF WE ARE USING PHP 4.3+
		if(function_exists('file_get_contents')){
			$this->data=$this->openWithFileGetContents();
		}
		else{
			$this->data=$this->openWithFOpen();
		}
	}

	function openWithFileGetContents(){
		$data=NULL;
		//SET TIMEOUT (PHP 4.3+ ONLY)
		ini_set('default_socket_timeout', $this->timeout);
		//RETRIEVE FILE
		if(!$data=@file_get_contents($this->targetFile)){
			$this->errorText='file_get_contents of ' . $this->targetFile . ' failed.';
			$this->error=true;
		}
		return $data;
	}

	function openWithFOpen(){
		$data=NULL;
		//RETRIEVE FILE
		if($dataFile = @fopen($this->targetFile, "r" )){
			while (!feof($dataFile)) {
				$data.= fgets($dataFile, 4096);
			}
			fclose($dataFile);
		}
		else{
			$this->errorText='fopen of ' . $this->targetFile . ' failed.';
			$this->error=true;
		}
		return $data;
	}
}