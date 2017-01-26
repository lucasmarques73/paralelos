<?php
/**
* @version $Id: fsystem.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' )  || ( trigger_error( "Restricted access", E_USER_ERROR ) && exit() );
class sobi2Fsystem {
	function makePath( $config, $base, $path = null,  $mode = null )
	{
		if( strlen( $path ) ) {
			$path = DS.$path;
		}
		// replace possible folder separators
		$path = str_replace( array( '\\', '/', '|' ) , DS, $path );
		// remove doubles
		$path = str_replace( array( DS.DS ) , DS, $path );
		// check if dir exists
		if ( file_exists( $base.$path ) ) {
			return true;
		}
		// set mode
		$origmask = umask( 0 );
		if( $config->dmod ) {
			$mode = octdec( $config->dmod );
		}
		else {
			$mode = ( 0777 - $origmask );
		}
		$parts = explode( DS, $path );
		$n = count( $parts );
		$ret = true;
		if ( $n < 1 ) {
			$ret = mkdir( $base, $mode) ;
		}
		else {
			$path = $base;
			for ($i = 0; $i < $n; $i++) {
				$path .= $parts[$i] . DS;
				if ( !file_exists( $path ) ) {
					if ( !mkdir( substr( $path,0,-1 ), $mode ) ) {
						$ret = false;
						break;
					}
				}
			}
		}
		if ( isset( $origmask ) ) {
			umask( $origmask );
		}
		return $ret;
	}
	/**
	 * creating transparent png images for IE <= 6.0
	 *
	 * @param string $icon
	 * @param string $alt
	 * @return string
	 */
	function checkPNGImage( $icon, $alt, $style = null, $class = null, $title = null )
	{
		$config =& sobi2Config::getInstance();
		$class = $class ? "class='{$class}'" : null;
		$style2 = $style ? "style=\"{$style}\"" : null;
		$title = $title ? "title=\"{$title}\"" : null;
		$image = "<img src=\"{$icon}\" alt=\"{$alt}\" {$class} {$title} {$style2}/>";
		if( !$config->key("general", "use_png_fix", true ) ) {
			return $image;
		}
		if(isset($_SERVER['HTTP_USER_AGENT']) && (eregi("msie",$_SERVER['HTTP_USER_AGENT']) && !eregi("opera",$_SERVER['HTTP_USER_AGENT']))) {
			$v = explode(" ",stristr($_SERVER['HTTP_USER_AGENT'],"msie"));
            $browser = isset( $v[0] ) ? $v[0] : null;
            $version = isset( $v[1] ) ? $v[1] : 0;
			if(strtoupper($browser) == "MSIE") {
				$version = ereg_replace("[^0-9]", "", $version);
				if($version <= 60) {
					$image = "<img src=\"{$config->liveSite}/components/com_sobi2/images/blank.gif\" {$class} {$title} style=\"{$style} filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{$icon}'\", sizingMethod='crop'\"/>";
					if( $config->key("general", "cachel2_ignore_ie6", true ) ) {
						$config->cacheL2Enabled = false;
					}
				}
			}
		}
		return $image;
	}
	function chmodRecursive( $path, $fmode = null, $dmode = null, $force = false )
	{
		$config =& sobi2Config::getInstance();
		if( !$config->cmod || empty( $config->cmod ) ) {
			return false;
		}
		if( !$force ) {
			$fmode = $config->fmod;
			$dmode = $config->dmod;
		}
		$fmode = $fmode < 600 ? decoct( $fmode ) : $fmode;
		$dmode = $dmode < 600 ? decoct( $dmode ) : $dmode;
		if( !strstr( strtoupper( PHP_OS ), "WIN") && function_exists( "exec" ) ) {
			$path = escapeshellarg( $path );
			if( $fmode ) {
				$fmode = (int) $fmode;
				@exec( "find {$path} -type f -exec chmod {$fmode} {} \;" );
			}
			if( $dmode ) {
				$dmode = (int) $dmode;
				@exec( "find {$path} -type d -exec chmod {$dmode} {} \;" );
			}
		}
		else {
			if( defined( '_JEXEC' ) && class_exists( 'JRequest' ) ) {
				jimport( 'joomla.filesystem.path' );
				return JPath::setPermission( $path, $fmode, $dmode );
			}
			else {
				return mosChmodRecursive( $path, $fmode, $dmode );
			}
		}
	}
    /**
     * Clear and remove a directory recursive
     *
     * @param string $dir
     */
    function removeDirRecursive( $dir )
    {
    	$dir = str_replace(array("/","\\"), DS, $dir);
    	$dir = str_replace(DS.DS, DS, $dir);
    	$return = false;
    	if( $dir == _SOBI_CMSROOT  ||
    		$dir == _SOBI_FE_PATH  ||
    		( strlen($dir) < strlen(_SOBI_CMSROOT) + 3 ) ) {
    		trigger_error("Trying to remove protected directory |{$dir}|", E_USER_WARNING );
    		return false;
    	}
		if (is_dir($dir) && $handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
			  if ($file != "." && $file != "..") {
			    if (is_dir($dir.DS.$file)) {
			      sobi2Fsystem::removeDirRecursive($dir.DS.$file);
			    }
			    else {
			      unlink($dir.DS.$file);
			    }
			  }
			}
			closedir($handle);
	    	if(rmdir($dir)) {
    			$return = true;
	    	}
		}
    	return $return;
    }
}
?>