<?php
/**
* @version $Id: helper.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class sobi2Helper {

	/**
	 * Enter description here...
	 *
	 * @param int $catId
	 * @return string
	 */
	function getCatName( $catId )
	{
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		static $catNames = array();
		if( $catId == 0 || $catId == 1 ) {
			$catName = "root";
		}
		else {
			if( isset( $catNames[$catId] ) && !empty( $catNames[$catId] )) {
				return $catNames[$catId];
			}
			$query = "SELECT `name` FROM `#__sobi2_categories` WHERE `catid` = {$catId}";
			$database->setQuery( $query );
			$catName = $database->loadResult();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$catNames[$catId] = $catName;
		}
		return $catName;
	}
    /**
     * Converting gived ini-string to an array
     *
     * @param string $str
     * @return array
     */
    function iniToArr( $str )
    {
    	$arr = array();
    	if( strlen( $str ) < 5 ) {
    		return $arr;
    	}
    	$sec = false;
    	$str = explode( "\n", $str );
    	foreach( $str as $line ) {
    		$line = trim( $line );
    		if ( strlen( $line ) > 0 && $line[0] != ';' ) {
		        if ( $line[0] == '[' ) {
		            $arr[ trim( substr( $line, 1, -1 ) ) ] = array();
		            $curSec =&  $arr[ trim( substr( $line, 1, -1 ) ) ];
		            $sec = true;
		            continue;
		        }
		        if( count( explode( '=', $line, 2 ) ) < 1 ) {
		        	continue;
		        }
		        list( $key, $value ) = explode( '=', $line, 2 );
		        if( $sec ) {
		        	$curSec[trim( $key )] = trim( $value );
		        }
		        else {
		        	$arr[trim( $key )] = trim( $value );
		        }
    		}
    	}
    	return $arr;
    }
    /**
     * Converting gived array to ini-string
     *
     * @param unknown_type $arr
     * @return unknown
     */
    function arrToIni( $arr )
    {
    	$str = null;
    	if( is_array( $arr ) && !empty( $arr) ) {
    		foreach ( $arr as $k => $v ) {
    			if( is_array( $v ) ) {
    				$str .= "\n[{$k}]".sobi2Config::arrToIni( $v );
    			}
    			else {
    				$str .= "\n{$k} = {$v}";
    			}
    		}
    	}
    	return $str;
    }
    /**
     * giving all available languages
     *
     * @param boolean $sbox - if sbox, returning it as selectbox.
     * @param string $selected - selected language in selectbox
     * @param string $js - javaScript for selectbox
     * @param string $name - name of selectbox
     * @return array
     */
    function getLanguages($sbox=true,$selected=null,$js=null,$name = 'slang')
    {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	if(!$selected) {
    		$selected = $config->sobi2Language;
    	}
    	$query = "SELECT DISTINCT `sobi2Lang` FROM `#__sobi2_language`";
    	$database->setQuery( $query );
    	$langs  =$database->loadObjectList();
		if ($database->getErrorNum()) {
			 trigger_error('getLanguages:'.$database->stderr());
		}
    	if(!$sbox) {
    		return $langs;
    	}
    	else {
    		$langBox = array();
    		foreach($langs as $lang) {
    			$langBox[] = sobiHTML::makeOption( $lang->sobi2Lang, $lang->sobi2Lang);
    		}
    		return sobiHTML::selectList( $langBox, $name, 'size="1" class="inputbox" '.$js , 'value', 'text', $selected );
    	}
    }
    function getExistingFieldsList($selected, $name = 'field')
    {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	$fieldsSelect = array();
    	$query = "SELECT DISTINCT sfields.fieldid, label.langKey AS name " .
    			"FROM `#__sobi2_fields` AS sfields " .
    			"LEFT JOIN `#__sobi2_language` AS label ON label.fieldid = sfields.fieldid WHERE (sfields.fieldtype = '1' OR sfields.fieldtype = '5') AND sobi2Section != 'field_opt' ";
    	$database->setQuery( $query );
    	$fields = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if(count($fields) != 0) {
			$fieldsSelect[] = sobiHTML::makeOption( 0, _SOBI2_SELECT);
			foreach($fields as $field) {
				$fieldsSelect[] = sobiHTML::makeOption( $field->fieldid, $field->name);
			}
		}
    	return sobiHTML::selectList( $fieldsSelect, $name, 'size="1" class="text_area"', 'value', 'text', $selected);
    }
	function getGeoPosition($sobiId)
	{
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$GeoPos = array();

		$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = '{$config->googleMapsLatField}' AND `itemid` = '$sobiId' ";
		$database->setQuery( $query );
		$GeoPos['lat'] = trim( $database->loadResult() );
		$GeoPos['lat'] = str_replace(',','.',$GeoPos['lat']);

		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = '{$config->googleMapsLongField}' AND `itemid` = '$sobiId'";
		$database->setQuery( $query );
		$GeoPos['long'] = trim( $database->loadResult() );
		$GeoPos['long'] = str_replace(',','.',$GeoPos['long']);

		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $GeoPos;
	}

	function countURLClick()
	{
		$config =& sobi2Config::getInstance();
		$db =& $config->getDb();
		if( $config->key( 'details_view', 'count_human_visit_only', true ) ) {
			$browser = sobi2Config::translateUserAgent();
			if( $browser[ 'type' ] != 'normal' ) {
				return false;
			}
		}
		$sid = ( int ) sobi2Config::request( $_GET, 'sid', 0 );
		$fid = ( int ) sobi2Config::request( $_GET, 'fid', 0 );
		$cookies = sobi2Config::request( $_COOKIE, 'SobiCC', null );
		if( $cookies && is_array( $cookies ) ) {
			if( isset( $cookies[ $sid ] ) && isset( $cookies[ $sid ][ $fid ] ) ) {
				return false;
			}
		}
		if( $sid && $fid ) {
			$db->setQuery( "UPDATE #__sobi2_fields_data SET data_int = data_int + 1 WHERE itemid = {$sid} AND fieldid = {$fid}" );
			$db->query();
			if ( $db->getErrorNum() ) {
				trigger_error( 'DB reports: '.$db->stderr(), E_USER_WARNING );
			}
			setcookie( "SobiCC[{$sid}][{$fid}]", 1 );
		}
		exit();
	}

	function checkHTTP( $entry )
	{
		if( $entry ){
			if( !stristr( $entry, 'http://' ) && !stristr( $entry, 'https://' ) )
				$entry = 'http://'.$entry;
			return $entry;
		}
		else {
			return null;
		}
	}
    function getBrowser( $userAgent )
    {
		$browser 		= array();
		$browser["browser"]  = null;
		$browserTypes[] = array( 'opera', true, 'op', 'normal' );
		$browserTypes[] = array( 'omniweb', true, 'omni', 'normal' );
		$browserTypes[] = array( 'msie', true, 'ie', 'normal' );
		$browserTypes[] = array( 'konqueror', true, 'konq', 'normal' );
		$browserTypes[] = array( 'safari', true, 'saf', 'normal' );
		$browserTypes[] = array( 'gecko', true, 'moz', 'normal' );
		$browserTypes[] = array( 'icab', false, 'icab', 'normal' );
		$browserTypes[] = array( 'crazy browser', true, 'ie', 'normal' );
		/* bots */
		$browserTypes[] = array( 'googlebot', false, 'google', 'bot' );
		$browserTypes[] = array( 'mediapartners-google', false, 'adsense', 'bot' );
		$browserTypes[] = array( 'yahoo-verticalcrawler', false, 'yahoo', 'bot' );
		$browserTypes[] = array( 'yahoo! slurp', false, 'yahoo', 'bot' );
		$browserTypes[] = array( 'yahoo-mm', false, 'yahoomm', 'bot' );
		$browserTypes[] = array( 'inktomi', false, 'inktomi', 'bot' );
		$browserTypes[] = array( 'slurp', false, 'inktomi', 'bot' );
		$browserTypes[] = array( 'fast-webcrawler', false, 'fast', 'bot' );
		$browserTypes[] = array( 'msnbot', false, 'msn', 'bot' );
		$browserTypes[] = array( 'ask jeeves', false, 'ask', 'bot' );
		$browserTypes[] = array( 'teoma', false, 'ask', 'bot' );
		$browserTypes[] = array( 'scooter', false, 'scooter', 'bot' );
		$browserTypes[] = array( 'openbot', false, 'openbot', 'bot' );
		$browserTypes[] = array( 'ia_archiver', false, 'ia_archiver', 'bot' );
		$browserTypes[] = array( 'zyborg', false, 'looksmart', 'bot' );
		$browserTypes[] = array( 'almaden', false, 'ibm', 'bot' );
		$browserTypes[] = array( 'baiduspider', false, 'baidu', 'bot' );
		$browserTypes[] = array( 'psbot', false, 'psbot', 'bot' );
		$browserTypes[] = array( 'gigabot', false, 'gigabot', 'bot' );
		$browserTypes[] = array( 'naverbot', false, 'naverbot', 'bot' );
		$browserTypes[] = array( 'surveybot', false, 'surveybot', 'bot' );
		$browserTypes[] = array( 'boitho.com-dc', false, 'boitho', 'bot' );
		$browserTypes[] = array( 'objectssearch', false, 'objectsearch', 'bot' );
		$browserTypes[] = array( 'answerbus', false, 'answerbus', 'bot' );
		$browserTypes[] = array( 'sohu-search', false, 'sohu', 'bot' );
		$browserTypes[] = array( 'iltrovatore-setaccio', false, 'il-set', 'bot' );
		/* libs */
		$browserTypes[] = array( 'w3c_validator', false, 'w3c', 'lib' );
		$browserTypes[] = array( 'wdg_validator', false, 'wdg', 'lib' );
		$browserTypes[] = array( 'libwww-perl', false, 'libwww-perl', 'lib' );
		$browserTypes[] = array( 'jakarta commons-httpclient', false, 'jakarta', 'lib' );
		$browserTypes[] = array( 'python-urllib', false, 'python-urllib', 'lib' );
		/* downloads acc */
		$browserTypes[] = array( 'getright', false, 'getright', 'download' );
		$browserTypes[] = array( 'wget', false, 'wget', 'download' );

		$browserTypes[] = array( 'mozilla/4.', false, 'ns', 'text' );
		$browserTypes[] = array( 'mozilla/3.', false, 'ns', 'text' );
		$browserTypes[] = array( 'mozilla/2.', false, 'ns', 'text' );
		$browserTypes[] = array( 'netpositive', false, 'netp', 'text' );
		$browserTypes[] = array( 'lynx', false, 'lynx', 'text' );
		$browserTypes[] = array( 'elinks ', false, 'elinks', 'text' );
		$browserTypes[] = array( 'elinks', false, 'elinks', 'text' );
		$browserTypes[] = array( 'links ', false, 'links', 'text' );
		$browserTypes[] = array( 'links', false, 'links', 'text' );
		$browserTypes[] = array( 'w3m', false, 'w3m', 'text' );
		$browserTypes[] = array( 'webtv', false, 'webtv', 'text' );
		$browserTypes[] = array( 'amaya', false, 'amaya', 'text' );
		$browserTypes[] = array( 'dillo', false, 'dillo', 'text' );
		$browserTypes[] = array( 'ibrowse', false, 'ibrowse', 'text' );
		$browserTypes[] = array( 'sonyericssonp800', false, 'sonyericssonp800', 'text' );

		$matches = array();
    	if(strpos($userAgent,"MSIE") !== false && strpos($userAgent,"Opera") === false && strpos($userAgent,"Netscape") === false)
        {
            $found = preg_match("/MSIE ([0-9]{1}\.[0-9]{1,2})/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Internet Explorer " . $matches[1];
            }
			$browser["dom"] = 1;
			$browser["type"] = "normal";
        }
        elseif(strpos($userAgent,"Gecko"))
        {
            $found = preg_match("/Firefox\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Mozilla Firefox " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
            $found = preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Netscape " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
            $found = preg_match("/Safari\/([0-9]{2,3}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Safari " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
            $found = preg_match("/Galeon\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Galeon " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
            $found = preg_match("/Konqueror\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Konqueror " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
            if( !isset( $browser["browser"] ) || empty( $browser["browser"] ) )  {
            	$browser["browser"] = "Gecko based";
            }
			$browser["dom"] = 1;
			$browser["type"] = "normal";
        }

        elseif(strpos($userAgent,"Opera") !== false)
        {
            $found = preg_match("/Opera[\/ ]([0-9]{1}\.[0-9]{1}([0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Opera " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
			$browser["dom"] = 1;
			$browser["type"] = "normal";
        }
        elseif (strpos($userAgent,"Lynx") !== false)
        {
            $found = preg_match("/Lynx\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Lynx " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
			$browser["dom"] = 0;
			$browser["type"] = "text";
        }
        elseif (strpos($userAgent,"Netscape") !== false)
        {
            $found = preg_match("/Netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/",$userAgent,$matches);
            if($found)
            {
                $browser["browser"] = "Netscape " . $matches[1];
                $browser["ver"] =  $matches[1];
            }
			$browser["dom"] = 1;
			$browser["type"] = "normal";
        }
        else
        {
            $browser["browser"] = false;
            $browser["ver"] = null;
        }
        if( !isset( $browser["type"] ) || empty( $browser["type"] ) ) {
	        $browser["type"] = null;
        	foreach ($browserTypes as $browserType) {
	        	if( stristr($userAgent, $browserType[0] ) ) {
					if( ! isset( $browser["browser"] ) || empty( $browser["browser"] ) ) {
						$browser["browser"] = $browserType[0];
					}
					$browser["dom"] = $browserType[1];
					$browser["type"] = $browserType[3];
	        	}
	        }
		}
        return $browser;
    }
    /**
     * @param string $userAgent
     * @return string
     */
    function getOs( $userAgent )
    {
		$Unix = array( 'unixware', 'solaris', 'sunos', 'sun4', 'sun5', 'suni86', 'sun', 'freebsd', 'openbsd', 'bsd' , 'irix5', 'irix6', 'irix', 'hpux9', 'hpux10', 'hpux11', 'hpux', 'hp-ux', 'aix1', 'aix2', 'aix3', 'aix4', 'aix5', 'aix', 'sco', 'unixware', 'mpras', 'reliant','dec', 'sinix', 'unix' );
		$Linux = array( 'Kanotix', 'Mepis', 'Debian', 'openSUSE', 'Red Hat', 'Slackware', 'Mandrake', 'Gentoo', 'PCLinuxOS', 'SUSE', 'Fedora', 'Sabayon', 'Mint', 'MEPIS', 'Mandriva', 'Damn Small', 'Slackware', 'CentOS', 'KNOPPIX', 'Zenwalk', 'Puppy', 'Arch', 'Dreamlinux', 'Vector', 'Freespire', 'sidux', 'Elive', 'Xubuntu', 'SLAX', 'redhat', 'Ubuntu', 'Xandros', 'Linspire');
		$LinuxArch = array ( 'i386', 'i586', 'i686' );// not use currently

    	$userAgent = strtolower($userAgent);
		$osArr = array();

        if(strpos($userAgent,"windows nt 5.1") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "XP";
        }
        elseif (strpos($userAgent,"windows 98") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "98";
        }
        elseif (strpos($userAgent,"windows nt 5.0") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "2000";
        }
        elseif (strpos($userAgent,"windows nt 5.2") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "2003 server";
        }
        elseif (strpos($userAgent,"windows nt 6.0") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "Vista";
        }
        elseif (strpos($userAgent,"windows nt") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "NT";
        }
        elseif (strpos($userAgent,"win 9x 4.90") !== false && strpos($userAgent,"win me"))
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "ME";
        }
        elseif (strpos($userAgent,"win ce") !== false)
        {
            $osArr["name"] = "Windows";
            $osArr["ver"] = "CE";
        }
        elseif (strpos($userAgent,"mac os x") !== false) {
            $osArr["name"] =  "Mac OS X";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"macintosh") !== false)  {
            $osArr["name"] =  "Macintosh";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"linux") !== false) {
            $osArr["name"] =  "Linux";
            foreach ($LinuxArch as $arch) {
            	if (strpos($userAgent,$arch) !== false) {
            		$osArr["name"] .= " ".$arch;
            		break;
            	}
            }
            $osArr["ver"] = null;
            foreach ( $Linux as $distro ) {
            	if (strpos( strtolower($userAgent), strtolower($distro)) !== false) {
            		$osArr["ver"] = $distro;
            		break;
            	}
            }
        }
        elseif (strpos($userAgent,"freebsd") !== false) {
            $osArr["name"] =  "Free BSD";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"openbsd") !== false) {
            $osArr["name"] =  "Open BSD";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"pc-bsd") !== false) {
            $osArr["name"] =  "PC-BSD";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"netbsd") !== false) {
            $osArr["name"] =  "NetBSD";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"bsd") !== false) {
            $osArr["name"] =  "BSD";
            $osArr["ver"] = null;
        }
        elseif (strpos($userAgent,"symbian") !== false) {
            $osArr["name"] =  "Symbian";
            $osArr["ver"] = null;
        }
        else {
            $osArr["name"] =  "unknow";
            $osArr["ver"] = null;
			foreach ($Unix as $ix) {
				if (strpos(strtolower($userAgent),strtolower($ix)) !== false) {
					$osArr["name"] =  $ix;
				}
			}
        }
		return $osArr;
    }
}
?>