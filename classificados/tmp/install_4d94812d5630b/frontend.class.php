<?php
/**
* @version $Id: frontend.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
/* no direct access */
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class frontend {
	/**
	 * @var string
	 */
	var $sobi2Header = null;
	/**
	 * @var string
	 */
	var $sobi2Footer = null;
	/**
	 * @var string
	 */
	var $listing = null;
	/**
	 * @var int
	 */
	var $limit = 9;
	/**
	 * @var int
	 */
	var $limitstart = 0;
	/**
	 * @var mosPageNav
	 */
	var $pageNav = null;
	/**
	 * @var int
	 */
	var $totalResults = null;
	/**
	 * @var array
	 */
	var $catList = null;
	/**
	 * @var array
	 */
    var $catParents = array();
    /**
     * @var array
     */
    var $catChilds = array();
	var $params = null;
	var $cid = 0;
    /**
     * @param int $catid
     * @param mosParameters $params
     * @param string $sobi2Task
     * @return frontend
     */
    function frontend( $catid = 0, $params, $sobi2Task )
    {
    	$this->buildHeader($catid,$params,$sobi2Task);
    	$this->params =& $params;
    	$this->cid = $catid;
    }
	/**
	 * @param int $catid
	 */
	function getParentCats ( $catid )
	{
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();

		$query = "SELECT parentid from `#__sobi2_cats_relations` WHERE `catid`={$catid}";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * the category with catid = 1 is the root category
		 */
		if($catid != 1) {
    		array_push($this->catParents, $catid);
		}
    	/*
    	 * if we still have a results
    	 */
    	if(sizeof($database->loadResult()) != 0) {
			$this->getParentCats($database->loadResult());
    	}

	}
	/**
	 * @param int $catid
	 */
	function getChildCats( $catid )
	{
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		/*
		 * the category with catid = 1 is the root category
		 */
		if($catid != 1 ) {
    		array_push($this->catChilds, $catid);
		}
		if(!($results = $config->sobiCache->get("childs_{$catid}","cats_childs"))) {
	    	$query = "SELECT `catid` FROM `#__sobi2_cats_relations` WHERE `parentid`= {$catid} ";
			$database->setQuery( $query );
			$results = $database->loadObjectList();
			if ($database->getErrorNum()) {
				trigger_error("frontend::getChildCats(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$config->sobiCache->add("childs_{$catid}",$results,"cats_childs");
		}
    	/*
    	 * if we still have a results
    	 */
		if( isset( $results ) && count( $results ) > 0 &&  $results != -100 ) {
			foreach($results as $result) {
				$this->getChildCats($result->catid);
			}
		}
	}
    /**
     * @param int $catid
     * @param mosParameters $params
     * @param string $sobi2Task
     */
    function buildHeader ($catid = 0,$params,$sobi2Task)
    {
		$no_html = intval(sobi2Config::request($_REQUEST, 'no_html', 0));
		if( $no_html ) {
			return null;
		}
    	$config	=& sobi2Config::getInstance();
    	$j15 	= false;
    	if( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) {
    		$document 	=& JFactory::getDocument();
    		$j15 		= true;
    	}
   		$mainframe 	=& $config->getMainframe();
    	$database 	=& $config->getDb();
    	$Itemid 	= $config->sobi2Itemid;
		$catid 		= $catid ? $catid : 1;
    	/*
    	 * first handle meta tags and pathway
    	 */
    	if( $catid ) {
    		$query = "SELECT catid, name, introtext, description FROM `#__sobi2_categories` WHERE `catid`={$catid}";
			$database->setQuery( $query );
			$metadata = null;
			if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
				$metadata = $database->loadObject();
			}
	    	else {
	    		$database->loadObject( $metadata );
	    	}
			if ( $database->getErrorNum() ) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( count( $metadata ) ) {
				$metaDesc = $config->getSobiStr( $config->componentName." ".$config->getSobiStr( $metadata->description ) );
				$metaDesc = str_replace( "\n"," ", $metaDesc );
				if( $catid == 1 ) {
					$metaDesc .= ' '.$config->key( "frontpage", "frontpage_add_to_meta_description", null );
				}
				$metaDesc = sobiHTML::cleanText( $metaDesc );
				if( $j15 ) {
					$cur = $document->get( 'description' );
					if( strlen( $cur ) ) {
						$metaDesc = $cur .'. ' . $metaDesc;
					}
					$document->setDescription( $metaDesc );
				}
				else {
					$mainframe->appendMetaTag( 'description', $metaDesc );
				}
				$metaKeys = $config->getSobiStr( $config->componentName.", ".$config->getSobiStr( $metadata->introtext ) );
				$metaKeys = str_replace( "\n", "," , $metaKeys );
				if( $catid == 1 ) {
					$metaKeys .= ' '.$config->key( "frontpage", "frontpage_add_to_meta_keys", null );
				}
				$metaKeys = sobiHTML::cleanText ( $metaKeys );
				if( $j15 ) {
					$document->setMetadata( 'keywords', $metaKeys );
				}
				else {
					$mainframe->appendMetaTag( 'keywords', $metaKeys );
				}
			}
			if( $j15 ) {
				$cur = $document->getGenerator();
				$gen = " Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName );
				if( strlen( $cur ) ) {
					$gen = $cur .'. ' . $gen;
				}
				$document->setGenerator( $gen );
			}
			else {
				$mainframe->appendMetaTag( "generator", "Sigsiu Online Business Index ".$config->getSobiStr( $config->componentName ) );
			}
			/*
			 * build new pathway
			 */
			$cat = null;
			$this->getParentCats( $catid );
			$this->catParents = array_reverse( $this->catParents );
			$title = null;
			$count = 0;
			$catNames = array();
			foreach( $this->catParents as $cid ) {
				$query = "SELECT catid, name, introtext FROM `#__sobi2_categories` WHERE (`catid`={$cid} AND `published` = 1)";
				$database->setQuery($query);
				if( !$config->forceLegacy && class_exists( "JDatabase" ) ) {
					$cat = $database->loadObject();
				}
		    	else {
		    		$database->loadObject( $cat );
		    	}
				if ( $database->getErrorNum() ) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$href = "index.php?option=com_sobi2&amp;catid={$cid}&amp;Itemid={$Itemid}";
				$href = sobi2Config::sef( $href );
				$cat->introtext = isset( $cat->introtext ) ? $config->getSobiStr( $cat->introtext ) : null;
				$cat->name 		= isset( $cat->name ) ? $config->getSobiStr( $cat->name ) : null;
				$catNames[] 	= $cat->name;
				$count++;
				if( $count == count( $this->catParents ) && $sobi2Task != "sobi2Details" ) {
					$config->appendPathWay( "{$cat->name}&nbsp;", $cat->name );
				}
				else {
					$config->appendPathWay( "<a href=\"{$href}\" title=\"{$cat->introtext}\" class=\"pathway\">{$cat->name}</a>&nbsp;", $cat->name );
				}
				if( $config->key( "frontpage", "catlist_browser_title_add_cats", true ) && isset( $cat->name ) ) {
					$title = $title." - {$cat->name} ";
				}
			}
			$config->set( "sobicatnames", $catNames );
			$comName = $config->key( "frontpage", "catlist_browser_title_add_com_name", true ) ? $config->componentName : null;
			$mainframe->setPageTitle( html_entity_decode( $comName.$title ) );
			if( $config->useRSSfeed ) {
				$index = $config->key( "general", "rss_target_file", "index2.php" );
				$index = ( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) ? 'index.php' : $index;
				$RSSH = sobi2Config::sef( "{$index}?option=com_sobi2&amp;sobi2Task=rss&amp;no_html=1&amp;catid={$catid}&amp;Itemid={$config->sobi2Itemid}" );
				$mainframe->addCustomHeadTag("<link rel=\"alternate\" type=\"application/rss+xml\" title=\"{$comName}{$title}\" href=\"{$RSSH}\" />");
			}
    	}
    	elseif( $config->useRSSfeed ) {
			$index = $config->key( "general", "rss_target_file", "index2.php" );
			$index = ( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) ? 'index.php' : $index;
			$RSSH = sobi2Config::sef( "{$index}?option=com_sobi2&amp;sobi2Task=rss&amp;no_html=1&amp;catid={$catid}&amp;Itemid={$config->sobi2Itemid}" );
			$mainframe->addCustomHeadTag( "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"{$config->componentName}\" href=\"{$RSSH}\" />" );
    	}
		$this->sobi2Header = "\n<!-- start of Sigsiu Online Business Index 2 component -->" .
							 "\n<div class=\"componentheading". $params->get( 'pageclass_sfx' )."\">{$config->componentName}</div>" .
							 "\n <div class='sobi2'> \n";

		$alphaTaskIgnore = $config->key( "alpha_index", "ignore_task", null );
		if( $alphaTaskIgnore && !empty( $alphaTaskIgnore ) ) {
			$alphaTaskIgnore = explode( ",", $alphaTaskIgnore );
			if( is_array( $alphaTaskIgnore ) && in_array( $sobi2Task, $alphaTaskIgnore ) ) {
				$config->showAlphaIndex = false;
			}
		}
		if( $config->showAlphaIndex ) {
		 	$letters = $config->key("alpha_index", "letters", "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0-9");
		 	if( $letters ) {
		 		$letters = explode( "," , $letters );
		 	}
		 	else {
		 		$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0-9");
		 	}
			$azindex = array();
		 	foreach ( $letters as $letter ) {
				$x = urlencode( $letter );
		 		$href = sobi2Config::sef("index.php?option=com_sobi2&amp;letter={$x}&amp;Itemid={$config->sobi2Itemid}");
		 		$azindex[] = "<a href=\"{$href}\" class=\"sobi2AlphaLinks\">{$letter}</a>\n\t\t\t";
			}
	 		if(!empty($azindex)) {
	 			$this->sobi2Header .= "<div id=\"sobi2AlphaLinks\">\n\t\t\t\t\t";
	 			$this->sobi2Header .= implode("&nbsp;|&nbsp;", $azindex);
	 			$this->sobi2Header .= "</div>\n\t\t";
	 		}
		}
		/*
    	 * build header menu
    	 */
    	if($config->showComponentLink || $config->showAddNewEntryLink || $config->showSearchLink) {
    		$this->sobi2Header .= "\n\n\n<table class=\"sobi2Header\">\n\t<tr>";
    		if( $config->showComponentLink ) {
    			$comHref = sobi2Config::sef( 'index.php?option=com_sobi2&amp;Itemid=' . $Itemid );
    			$sobiName = $config->key( $config->sobi2Language, "top_menu_sobi_name", $config->componentName );
    			$startPageLink = '<a class="sobi2Header" href="'. $comHref .'">' . $sobiName . '</a>';
    			$this->sobi2Header = $this->sobi2Header."\n\t\t<td id=\"sobi2HeaderComLink\" > {$startPageLink} </td>";
    		}
    		if($config->showSearchLink) {
    			$searchHref = sobi2Config::sef( 'index.php?option=com_sobi2&amp;sobi2Task=search&amp;Itemid=' . $Itemid);
    			$searchLink = '<a class="sobi2Header" href="'. $searchHref .'">' . _SOBI2_SEARCH_H . '</a>';
    			$this->sobi2Header = $this->sobi2Header."\n\t\t<td id=\"sobi2HeaderSearchLink\"> {$searchLink} </td>";
    		}
    		if($config->showAddNewEntryLink && $config->allowFeEntr) {
    			$addHref = sobi2Config::sef( 'index.php?option=com_sobi2&amp;sobi2Task=addNew&amp;Itemid=' . $Itemid);
    			$addLink = '<a class="sobi2Header" href="'. $addHref .'">' . _SOBI2_ADD_NEW_ENTRY . '</a>';
    			$this->sobi2Header = $this->sobi2Header."\n\t\t<td id=\"sobi2HeaderAddLink\" > {$addLink} </td>";
    		}
    		$msg = sobi2Config::request( $_REQUEST, "mosmsg", null);
    		$msg = $msg ? "<div id=\"sobimsg\" class=\"message\">{$msg}</div>" : null;
    		$this->sobi2Header = $this->sobi2Header."\n\t</tr>\n</table>\n\n{$msg}\n\n";
    	}
    }
    /**
     * @param mosParameters $params
     * @param int $cid
     */
    function buildFooter( $params, $cid = 1 )
    {
    	$config =& sobi2Config::getInstance(); $database =& $config->getDb(); ob_start(); sobiHTML::BackButton($params); $b = ob_get_contents(); ob_end_clean(); $h = null; $this->runF( $h ); if( $cid ) { $category = "&amp;catid={$cid}"; } else { $category = null;}
    	if( $config->useRSSfeed ) {
			$index = $config->key( "general", "rss_target_file", "index2.php" );
			$index = ( defined( '_JEXEC' ) && class_exists( 'JApplication' ) ) ? 'index.php' : $index;
			$RSSH = sobi2Config::sef( "{$index}?option=com_sobi2&amp;sobi2Task=rss&amp;no_html=1&amp;catid={$category}&amp;Itemid={$config->sobi2Itemid}" );
    		$rss = "<a href=\"{$RSSH}\" title=\"RSS Feeds\"><img src=\"{$config->liveSite}/components/com_sobi2/images/feed.gif\" alt=\"RSS Feeds\"/></a>";
    	}
    	else {
    		$rss = null;
    	}
		if( function_exists( "memory_get_usage" ) ) {
			$memUsage = number_format( memory_get_usage() - $config->memStart );
		}
		else {
			$memUsage = null;
		}
		$time = microtime( true ) - $config->timeStart;
		$q = count( $database->_log ) - $config->queryStart;
    	$this->sobi2Footer = '' .
    			"\n <table class=\"sobi2Footer\"> \n" .
    			"\t <tr><td id=\"sobi2Footer\">{$h}</td>" .
    			"\t <td id=\"sobi2rss\">{$rss}</td></tr>" .
				"\t <tr><td colspan=\"2\">{$b}</td></tr>" .
	    		"\n </table>\n" .
    			"\n </div> \n" .
    			"\n<!-- end of Sigsiu Online Business Index 2 component Memory {$memUsage} / Time {$time} / Queries: {$q} --> \n" ;
    }
    /**
     * @return string
     */
    function getHeader()
    {
    	return $this->sobi2Header;
    }
    /**
     * @return string
     */
    function getFooter()
    {
    	$this->buildFooter($this->params,$this->cid);
    	return $this->sobi2Footer;
    }
    /**
     * check if someone trying to overwrite the mambo/joomla
     * gloabal variables
     * @return string
     */
    function runF( &$h )
    {
		$config =& sobi2Config::getInstance();
		$protected = array(); $protected[] = 'my'; $protected[] = 'mosConfig_absolute_path'; $protected[] = 'mosConfig_live_site'; $protected[] = 'database'; $protected[] = 'sobi2AdminUrl'; $protected[] = 'includesPath'; $h = array(); $h[0] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'J'.'o'.'o'.'m'.'l'.'a'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'C'.'o'.'m'.'p'.'o'.'n'.'e'.'n'.'t'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';   $h[1] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'J'.'o'.'o'.'m'.'l'.'a'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'E'.'x'.'t'.'e'.'n'.'s'.'i'.'o'.'n'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';$check = "pby";
		$protected[] = 'config'; $protected[] = 'sobi2Frontend'; $protected[] = 'mosConfig_offset'; $protected[] = 'mainframe'; $protected[] = 'acl'; $protected[] = 'mosConfig_mailfrom'; $protected[] = 'mosConfig_fromname'; $protected[] = 'sobi2Lang'; $h[2] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'J'.'o'.'o'.'m'.'l'.'a'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'C'.'o'.'m'.'p'.'o'.'n'.'e'.'n'.'t'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t/'.'s'.'ob'.'i2.ht'.'ml'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';   $h[3] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'J'.'o'.'o'.'m'.'l'.'a'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'E'.'x'.'t'.'e'.'n'.'s'.'i'.'o'.'n'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t/'.'s'.'ob'.'i2.ht'.'ml'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';
		$protected[] = 'sobi2Admin'; $protected[] = 'mosConfig_lang'; $protected[] = 'mosConfig_sitename'; $protected[] = 'iso';   $h[3] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'M'.'a'.'m'.'b'.'o'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'E'.'x'.'t'.'e'.'n'.'s'.'i'.'o'.'n'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';   $h[4] = 'P'.'o'.'w'.'e'.'r'.'e'.'d'.' '.'b'.'y'.' '.'<'.'a '.'title'.'="'.'S'.'O'.'B'.'I'.'2'.' - '.'M'.'a'.'m'.'b'.'o'.' '.'D'.'i'.'r'.'e'.'c'.'t'.'o'.'r'.'y'.' '.'C'.'o'.'m'.'p'.'o'.'n'.'e'.'n'.'t'.'" h'.'r'.'e'.'f="h'.'t'.'t'.'p'.':'.'/'.'/'.'w'.'w'.'w'.'.'.'s'.'i'.'g'.'s'.'i'.'u'.'.n'.'e'.'t/'.'s'.'ob'.'i2.ht'.'ml'.'" '.'t'.'a'.'rg'.'et'.'="_'.'b'.'l'.'a'.'nk'.'">S'.'i'.'g'.'s'.'i'.'u.N'.'E'.'T</a>';   $h[] = $h[0];  $h[] = $h[0];  $h[] = $h[0];  $h[] = $h[0];  $h[] = $h[0];  $h[] = $h[0];
		foreach( $protected as $var ) {
			if( isset( $_REQUEST[ $var ] ) ) {
				unset( $_REQUEST );
				unset( $_POST );
				unset( $_GET );
				@sobi2Config::chmodRecursive( _SOBI_FE_PATH.DS."logfile.txt", 0777, 0777 );
				$log = fopen( _SOBI_FE_PATH.DS."logfile.txt","a+" );
				$today = date( "D M j G:i:s T Y" );
				$ip = $_SERVER[ "REMOTE_ADDR" ];
				$ref = $_SERVER[ "HTTP_REFERER" ];
				if( !$ref ) {
					$ref = "none";
				}
				$host = $_SERVER[ "REMOTE_HOST" ];
				if( !$host ) {
					$host = gethostbyaddr( $_SERVER[$ip] );
				}
				$browser = $_SERVER[ "HTTP_USER_AGENT" ];
				$requestet = $_SERVER ["REQUEST_URI" ];
				if( $host ) {
					$hostname = "\t Hostname: {$host} \n";
				}
				$logMsg = "{$today} - [Possible hacking attempt]: \n" .
						"\t Trying to override {$var}\n" .
						"\t IP: {$ip} \n" .
						"{$hostname}".
						"\t Requestet URI: {$requestet} \n" .
						"\t Refferer: {$ref} \n" .
						"\t Browser: {$browser}\n" .
						"---------------------------------------------------------\n";
				fwrite( $log, $logMsg );
				fclose( $log );
				sobi2Config::redirect( $config->key( "redirects", "trying_to_overwrite_globals", "index.php" ), "Invalid request" );
			}
		}
		$h = $config->$check ? $h[ rand( 0, ( count( $h ) - 1 ) ) ] : null;
    }
    /**
     * @param sobi2Category $cat
     */
    function buildListing( $cat )
    {
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$my	= &$config->getUser();
		$catid = $cat->catid;
		$catid = $catid < 2 ? 0 : $catid;
 		/*
 		 * build the page navigation and limits for one page
 		 */
    	$now = $config->getTimeAndDate();
  		$Itemid = $config->sobi2Itemid;
   		$this->limit = $config->itemsInLine * $config->lineOnSite;

    	if(sobi2Config::request($_REQUEST, 'limitstart', 0)) {
    		$this->limitstart = intval(sobi2Config::request($_REQUEST, 'limitstart', 0));
    	}
    	else {
    		$this->limitstart  = 0;
    	}

    	if($this->limit) {
    		$limits = " LIMIT {$this->limitstart}, {$this->limit} ";
    	}
    	else {
    		$limits = null;
    	}
    	$pluginsMod = false;
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			$pluginsMod = ( method_exists( $plugin, "onEntriesList" ) ) ? true : $pluginsMod;
    		}
		}
    	/*
    	 * if listing should be shown on front page get all published items
    	 */
    	$results = $config->sobiCache->get("listingOnCat_{$catid}_{$this->limitstart}", "listing");
	    if(!$results || $pluginsMod || is_integer($results)) {
	    	if($catid == 0 && $config->showListingOnFp) {
	    		   $query = "SELECT itemid FROM `#__sobi2_item` WHERE (`published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}'))";
	    	}
	    	else if($catid != 0) {
	    		$or = null;
	    		if($config->showEntriesFromSubcats) {
		    		$this->getChildCats($catid);
		    		foreach($this->catChilds as $cid) {
		    			$or = $or."OR `catid` = {$cid} ";
		    		}
		    		unset($this->catChilds);
		    		$this->catChilds = array();
	    		}
	    		$query = "SELECT DISTINCT relation.itemid FROM `#__sobi2_cat_items_relations` AS relation " .
	    				 "LEFT JOIN `#__sobi2_item` AS items ON relation.itemid = items.itemid " .
	    				 "WHERE ((`catid` = {$catid} {$or}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) )";
	    	}
		    $database->setQuery($query);
		    $sids = $database->loadResultArray();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( is_array( $sids ) && !empty( $sids  ) ) {
		    	if( $config->isset_( "curDisplSidList" ) ) {
					$curDisplSidList =& $config->get_( "curDisplSidList" );
					$curDisplSidList = array_intersect( $curDisplSidList, $sids );
				}
				else {
					$config->set_( "curDisplSidList", $sids );
				}
				$config->set_( "curDisplSidListQuery", $query );
			}
			if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	    			if(method_exists($plugin, "onEntriesList")) {
						$plugin->onEntriesList( $sids );
	    			}
	    		}
			}
			$ids = (!empty($sids)) ? implode(" , ", $sids) : null;
	    	$this->totalResults = sizeof( $sids );
	    	if(!$pluginsMod) {
	    		$config->sobiCache->add("count_{$catid}",$this->totalResults,"itemsCount");
	    	}

	    	$this->listing = null;
	    	if($this->totalResults) {
		    	/*
		    	 * if listing should be shown on front page get all published items
		    	 */
		    	if($catid == 0 && $config->showListingOnFp) {
		    		$config->listingOrdering = str_replace("relation.","",$config->listingOrdering);
		    		$query = "SELECT itemid, title, owner, image, icon, background FROM `#__sobi2_item` AS items " .
		    				 "WHERE (`published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) AND items.itemid IN({$query}) ) ORDER BY {$config->listingOrdering} {$limits}";
		    	}
		    	else if( $catid != 0 ) {
		    	/*
		    	 * if show listing in category
		    	 */
	    		$query = "SELECT DISTINCT relation.itemid, title, owner, image, background, icon FROM `#__sobi2_cat_items_relations` AS relation " .
	    				 "LEFT JOIN `#__sobi2_item` AS items ON relation.itemid = items.itemid " .
	    				 "WHERE ((`catid` = {$catid} {$or}) AND `published` = '1' AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) AND items.itemid IN({$query}) ) ORDER BY {$config->listingOrdering} {$limits}";

		    	}
				$database->setQuery($query);
				$results = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("frontend::buildListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				if(!$pluginsMod) {
					$config->sobiCache->add("listingOnCat_{$catid}_{$this->limitstart}",$results,"listing");
				}
	    	}
    	}
		if(!$this->totalResults) {
	    	if(!($this->totalResults = $config->sobiCache->get("count_{$catid}","itemsCount"))) {
		    	$this->getChildCats($catid);
		    	if(is_array($this->catChilds)) {
		    		$cats = implode(" , ", $this->catChilds);
		    		unset($this->catChilds);
		    		$this->catChilds = array();
		    	}
		    	else {
		    		$cats = $catid;
		    	}
	    		$now = $config->getTimeAndDate();
	    		$query = "SELECT COUNT(rel.itemid) FROM `#__sobi2_cat_items_relations` AS rel " .
		    			 "LEFT JOIN `#__sobi2_item` AS sitem ON rel.itemid = sitem.itemid " .
		    			 "WHERE(sitem.published = '1' AND (sitem.publish_down > '{$now}' OR sitem.publish_down = '{$config->nullDate}') AND rel.catid IN ({$cats}))";
				$database->setQuery($query);
				$this->totalResults = $database->loadResult();
				if ($database->getErrorNum()) {
					trigger_error("frontend::buildListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$config->sobiCache->add("count_{$catid}",$this->totalResults,"itemsCount");
	    	}
			$this->totalResults = $config->sobiCache->get("count_{$catid}","itemsCount");
		}
    	$this->pageNav =& sobi2bridge::jPageNav( $this->totalResults, $this->limitstart, $this->limit );

		$tdTrCounter = 0;
		if(is_array($results) && !empty($results)) {
			$this->listing = $this->listing."\n\t\t\t<tr>";

			$width = 100/$config->itemsInLine;
			$width = "style='width: {$width}%; ";

			foreach($results as $result) {
				/*
				 * check if need to display <tr>
				 */
				if($tdTrCounter%$config->itemsInLine == 0 && $tdTrCounter != 0)
					$this->listing = $this->listing."\n\t\t\t</tr>\n\t\t\t<tr>";

				$style = $width;
				if($result->background && file_exists( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$result->background}")) {
					$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$result->background});";
				}
				else if(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg)))
				   	$style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";

				if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor)))
					$style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
				else
					$style = $style."'";

				$this->listing = $this->listing."\n\t\t\t\t<td {$style}>";

				$tdTrCounter++;
				$result->title = $config->getSobiStr($result->title);

				/*
				 * case showing editable item
				 */

				if(($my->id != 0 && $my->id == $result->owner) || $config->checkPerm()) {
					if( $config->allowUserToEditEntry || $config->checkPerm() ) {
						$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=editSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}&amp;catid={$catid}";
						$this->listing = $this->listing."<input type='button' class='button sobi2EditEntryButton' onclick=\"location.href='{$href}'\"  name='editEntry' value='"._SOBI2_LISTING_EDIT_ENTRY_BT."'/>";
					}
					if( $config->allowUserDelete || $config->checkPerm() ) {
						$href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=deleteSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}&amp;catid={$catid}";
						$this->listing = $this->listing."<input type='button' class='button sobi2EditEntryButton' onclick=\"if(confirm('"._SOBI2_CONFIRM_DELETE."') == true) location.href='{$href}'\" name='editEntry' value='"._SOBI2_LISTING_DELET_ENTRY_BT."'/>";
					}
				}
				if(!$my->id && !$config->allowAnoDetails) {
					$onClick = "onclick='alert(\""._SOBI2_JS_NOT_LOGGED_FOR_DETAILS."\"); return false;'";
					$href = "#";
				}
				else {
					$href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;catid={$catid}&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}";
					$href = sobi2Config::sef($href);
					$onClick = null;
				}

				/*
				 * show icon or image in VCard
				 */
				$result->title = sobi2Config::replaceEntities($result->title);
		    	if( !$result->icon && $config->key( "frontpage", "default_ico" ) ) {
	            	$result->icon = $config->key( "frontpage", "default_ico" );
	            }
	            if( !$result->image && $config->key( "frontpage", "default_img" ) ) {
	            	$result->image = $config->key( "frontpage", "default_img" );
	            }
				if($config->showIcoInVC && $result->icon != '') {
					$ico = $config->liveSite.$config->imagesFolder.$result->icon;
					$this->listing = $this->listing."\n\t\t\t\t\t<a href=\"{$href}\" {$onClick}><img src=\"{$ico}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
				}

				if($config->showImgInVC && $result->image != '') {
					$img = $config->liveSite.$config->imagesFolder.$result->image;
					$this->listing = $this->listing."\n\t\t\t\t\t<a href=\"{$href}\" {$onClick}><img src=\"{$img}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
				}
				$this->listing = $this->listing."\n\t\t\t\t\t<p class=\"sobi2ItemTitle\"><a href=\"{$href}\" {$onClick} title=\"{$result->title}\" >{$result->title}</a></p>";
				$fields = array();
				if(!$fieldids = $config->sobiCache->get("field_vcard")) {
					$query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
							 "WHERE `in_vcard`= 1 AND `enabled` = 1 " .
							 "ORDER BY position";
					$database->setQuery($query);
					$fieldids = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$config->sobiCache->add("field_vcard",$fieldids);
				}
				if($fieldids && !is_integer($fieldids)) {
					sobi2Config::import("field.class");
					foreach($fieldids as $fieldid) {
						$fields[] = new sobiField($fieldid->fieldid, $result->itemid);
					}
				}
				/*
				 * getting fields data
				 */
		        if( count($fields) ) {
	                foreach($fields as $field) {
	                	$data = null;
	                    $field->name = $config->getSobiStr($field->fieldname);
	                    $field->label = $config->getSobiStr($field->label);
	                    if($field->fieldType == 2) {
							$field->data = $config->getSobiStr($field->data, true);
							$data = $field->data;
	                    }
	                    elseif( $field->fieldType == 1 || $field->fieldType == 5 || $field->fieldType == 7 ) {
							$field->data = $config->getSobiStr($field->data);
							if( $field->isUrl == 4 ) {
								$data = $field->customCode;
							}
							else {
								$data = $field->data;
							}
	                    }
	                    elseif($field->fieldType == 3) {
							$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
							$field->with_label = 1;
	                     }
						elseif($field->fieldType == 6) {
							$field->data = $field->selectedValues;
							if(is_array($field->data) && !empty($field->data)) {
								$data = "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
								foreach ($field->data as $opt) {
									$data .= "\n\t<li>{$opt}</li>";
								}
								$data .= "\n</ul>";
							}
						}
						$tag = "span";
	                    if(strlen($data) > 0) {

							static $noFollows = null;
							static $noFollowsCheck = false;
							if( !$noFollowsCheck ) {
								$noFollows = $config->key( "url", "nofollow" );
								if( $noFollows ) {
									$noFollows = explode( ",", $noFollows );
								}
								else {
									$noFollows = array();
								}
								$noFollowsCheck = true;
							}
							if($field->isUrl == 1) {
								if( in_array( $field->fieldid, $noFollows )) {
									$noFollow = " rel=\"nofollow\" ";
								}
								else {
									$noFollow = null;
								}
								$data = "<a href=\"{$data}\"{$noFollow} title=\"{$result->title}\" target=\"_blank\">{$field->label}</a>";
							}
							elseif($field->isUrl == 2) {
								$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
							}
							elseif($field->isUrl == 3) {
								$data = "<img src=\"{$data}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
							}
							if($field->with_label) {
								if( $field->fieldType != 6 ) {
									$data = "<{$tag} class=\"sobi2Listing_{$field->name}\"><span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}</{$tag}>";
								}
								else {
									$data = "<span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}";
								}
							}
							else {
								if( $field->fieldType != 6 ) {
									$data = "<{$tag} class=\"sobi2Listing_{$field->name}\">{$data}</{$tag}>";
								}
							}
							if($field->in_newline) {
								$data = "<br/>".$data;
							}
		                    $this->listing = $this->listing."\n\t\t\t\t\t{$data}";
	                    }
	                }
		        }
				$this->listing .= $this->getPlugins($result->itemid);
				$this->listing = $this->listing."\n\t\t\t\t</td>";
			}
			/*
			 * on end check if last <tr> have $config->itemsInLine <td>'s
			 */
			if($tdTrCounter%$config->itemsInLine != 0) {
	    		if( ($f = $config->key( "frontpage", "empty_cell_calback_function", false )) && function_exists( $f )) {
	    			$ecell = call_user_func( $f );
	    		}
	    		else {
	    			$ecell = "&nbsp;";
	    		}
				$colspan = $config->itemsInLine - ($tdTrCounter%$config->itemsInLine);
				$this->listing = $this->listing."\n\t\t\t\t<td class=\"sobi2EmptyCell\" colspan=\"{$colspan}\">{$ecell}\n\t\t\t\t</td>";
			}

		}
		// wenn noch keine Eintraege da, dann korrekt schliessen
		else {
			$this->listing = $this->listing."\n\t\t\t<tr><td></td>";
		}
	}

    /**
     * @param sobi2Category $cat
     * @return string
     */
    function buildListingWithTemplate( $cat )
    {
		$config  =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$my = &$config->getUser();
        $catid = $cat->catid;
        $catid = $catid < 2 ? 0 : $catid;
        $template = $config->defTemplate;
        if( isset( $cat->tpl ) && $cat->tpl ) {
        	if( sobi2Config::translatePath( "{$config->templatesDir}|{$cat->tpl}|sobi2.vc.tmpl" ) ) {
        		$template = $cat->tpl;
        		$config->loadTplCss( $template );
        	}
        }
        if( !sobi2Config::translatePath( "{$config->templatesDir}|{$template}|sobi2.vc.tmpl" ) ) {
        	$template = 'default';
        }
		if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$template}|sobi2.vc.tmpl" ) ) {
             $this->buildListing( $cat );
             return null;
        }
 		/*
 		 * build the page navigation and limits for one page
 		 */
    	$now = $config->getTimeAndDate();
  		$Itemid = $config->sobi2Itemid;
   		$this->limit = $config->itemsInLine * $config->lineOnSite;

    	if(sobi2Config::request($_REQUEST, 'limitstart', 0)) {
    		$this->limitstart = intval(sobi2Config::request($_REQUEST, 'limitstart', 0));
    	}
    	else {
    		$this->limitstart  = 0;
    	}
		$limits = null;
    	if($this->limit) {
    		$limits = " LIMIT {$this->limitstart}, {$this->limit} ";
    	}
    	$pluginsMod = false;
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			$pluginsMod = (method_exists($plugin, "onEntriesList")) ? true : $pluginsMod;
    		}
		}
    	/*
    	 * if listing should be shown on front page get all published items
    	 */
    	$results = $config->sobiCache->get("listingOnCat_{$catid}_{$this->limitstart}", "listing");
	    if(!$results || $pluginsMod || is_integer($results)) {
	    	if($catid == 0 && $config->showListingOnFp) {
	    		   $query = "SELECT itemid FROM `#__sobi2_item` WHERE (`published` = 1 AND `publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}')";
	    	}
	    	else if($catid != 0) {
	    		$or = null;
	    		if($config->showEntriesFromSubcats) {
		    		$this->getChildCats($catid);
		    		foreach($this->catChilds as $cid) {
		    			$or = $or."OR `catid` = {$cid} ";
		    		}
		    		unset($this->catChilds);
		    		$this->catChilds = array();
	    		}
	    		$query = "SELECT DISTINCT relation.itemid FROM `#__sobi2_cat_items_relations` AS relation " .
	    				 "LEFT JOIN `#__sobi2_item` AS items ON relation.itemid = items.itemid " .
	    				 "WHERE ((`catid` = {$catid} {$or}) AND `published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) )";
	    	}
		    $database->setQuery($query);
		    $sids = $database->loadResultArray();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( is_array( $sids ) && !empty( $sids  ) ) {
		    	if( $config->isset_( "curDisplSidList" ) ) {
					$curDisplSidList =& $config->get_( "curDisplSidList" );
					$curDisplSidList = array_intersect( $curDisplSidList, $sids );
				}
				else {
					$config->set_( "curDisplSidList", $sids );
				}
				$config->set_( "curDisplSidListQuery", $query );
			}
			if( count( $config->S2_plugins ) ) {
	    		foreach( $config->S2_plugins as $name => $plugin ) {
	    			if( method_exists( $plugin, "onEntriesList" ) ) {
						$config->S2_plugins[$name]->onEntriesList( $sids );
	    			}
	    		}
			}
			$ids = (!empty($sids)) ? implode(" , ", $sids) : null;
	    	$this->totalResults = sizeof($sids);
	    	$this->listing = null;
	    	if($this->totalResults) {
		    	/*
		    	 * if listing should be shown on front page get all published items
		    	 */
		    	if($catid == 0 && $config->showListingOnFp) {
		    		$config->listingOrdering = str_replace("relation.","",$config->listingOrdering);
		    		$query = "SELECT itemid, title, owner, image, icon, background FROM `#__sobi2_item` AS items " .
		    				 "WHERE (`published` = 1 AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) AND items.itemid IN({$query}) ) ORDER BY {$config->listingOrdering} {$limits}";
		    	}
		    	else if( $catid != 0 ) {
		    	/*
		    	 * if show listing in category
		    	 */
		    		$query = "SELECT DISTINCT relation.itemid, title, owner, image, background, icon FROM `#__sobi2_cat_items_relations` AS relation " .
		    				 "LEFT JOIN `#__sobi2_item` AS items ON relation.itemid = items.itemid " .
		    				 "WHERE ((`catid` = {$catid} {$or}) AND `published` = '1' AND (`publish_down` > '{$now}' OR `publish_down` = '{$config->nullDate}' ) AND items.itemid IN({$query}) ) ORDER BY {$config->listingOrdering} {$limits}";

		    	}
				$database->setQuery($query);
				$results = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("frontend::buildListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
	    	}
    	}
		if(!$this->totalResults) {
	    	if(!($this->totalResults = $config->sobiCache->get("count_{$catid}","itemsCount"))) {
		    	$this->getChildCats($catid);
		    	if(is_array($this->catChilds)) {
		    		$cats = implode(" , ", $this->catChilds);
		    		unset($this->catChilds);
		    		$this->catChilds = array();
		    	}
		    	else {
		    		$cats = $catid;
		    	}
	    		$now = $config->getTimeAndDate();
	    		$query = "SELECT COUNT(rel.itemid) FROM `#__sobi2_cat_items_relations` AS rel " .
		    			 "LEFT JOIN `#__sobi2_item` AS sitem ON rel.itemid = sitem.itemid " .
		    			 "WHERE(sitem.published = '1' AND (sitem.publish_down > '{$now}' OR sitem.publish_down = '{$config->nullDate}') AND rel.catid IN ({$cats}))";
				$database->setQuery($query);
				$this->totalResults = $database->loadResult();
				if ($database->getErrorNum()) {
					trigger_error("frontend::buildListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$config->sobiCache->add("count_{$catid}",$this->totalResults,"itemsCount");
	    	}
			$this->totalResults = $config->sobiCache->get("count_{$catid}","itemsCount");
		}
    	$this->pageNav =& sobi2bridge::jPageNav( $this->totalResults, $this->limitstart, $this->limit );
        $tdTrCounter = 0;
            if( is_array( $results ) && ! empty( $results )) {
                    $this->listing = $this->listing."\n\t\t\t<tr>";
                    $width = 100/$config->itemsInLine;
                    $width = "style='width: {$width}%; ";
                    foreach($results as $result) {
                            $deleteButton = null;
                            $editButton = null;
                            $ico = null;
                            $img = null;

                            /*
                             * check if need to display <tr>
                             */
                            if($tdTrCounter%$config->itemsInLine == 0 && $tdTrCounter != 0)
                                    $this->listing = $this->listing."\n\t\t\t</tr>\n\t\t\t<tr>";

                            $style = $width;
                            if($result->background && file_exists( _SOBI_FE_PATH.DS."images".DS."backgrounds".DS."{$result->background}")) {
                                    $style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$result->background});";
                            }
                            else if(isset($config->sobi2BackgroundImg) && !(empty($config->sobi2BackgroundImg)))
                                    $style = $style."background-image: url({$config->liveSite}/components/com_sobi2/images/backgrounds/{$config->sobi2BackgroundImg});";

                            if(isset($config->sobi2BorderColor) && !(empty($config->sobi2BorderColor)))
                                    $style = $style."border-style: solid; border-color: #{$config->sobi2BorderColor}'";
                            else
                                    $style = $style."'";


                            $tdTrCounter++;
                            $result->title = $config->getSobiStr($result->title);

                            /*
                             * case showing editable item
                             */

                            if( ($my->id != 0 && $my->id == $result->owner) || $config->checkPerm() ) {
                                    if( $config->allowUserToEditEntry || $config->checkPerm() ) {
                                            $href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=editSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}&amp;catid={$catid}";
                                            $editButton = "<input type=\"button\" class=\"button sobi2EditEntryButton\" onclick=\"location.href='{$href}'\"  name=\"editEntry\" value=\""._SOBI2_LISTING_EDIT_ENTRY_BT."\"/>";
                                    }
                                    if( $config->allowUserDelete || $config->checkPerm() ) {
                                            $href = "{$config->liveSite}/index.php?option=com_sobi2&amp;sobi2Task=deleteSobi&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}&amp;catid={$catid}";
                                            $deleteButton = "<input type=\"button\" class=\"button sobi2EditEntryButton\" onclick=\"if(confirm('"._SOBI2_CONFIRM_DELETE."') == true) location.href='{$href}'\" name=\"editEntry\" value=\""._SOBI2_LISTING_DELET_ENTRY_BT."\"/>";
                                    }
                            }
                            if(!$my->id && !$config->allowAnoDetails) {
                                    $onClick = "onclick='alert(\""._SOBI2_JS_NOT_LOGGED_FOR_DETAILS."\"); return false;'";
                                    $href = "#";
                            }
                            else {
                                    $href = "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;catid={$catid}&amp;sobi2Id={$result->itemid}&amp;Itemid={$Itemid}";
                                    $href = sobi2Config::sef($href);
                                    $onClick = null;
                            }
							$result->title = sobi2Config::replaceEntities($result->title);
                            /*
                             * show icon or image in VCard
                             */

                            if( !$result->icon && $config->key( "frontpage", "default_ico" ) ) {
                            	$result->icon = $config->key( "frontpage", "default_ico" );
                            }

                            if( !$result->image && $config->key( "frontpage", "default_img" ) ) {
                            	$result->image = $config->key( "frontpage", "default_img" );
                            }

                            if($config->showIcoInVC && $result->icon != '') {
                                    $ico = $config->liveSite.$config->imagesFolder.$result->icon;
                                    $ico = "<a href='{$href}' {$onClick}><img src=\"{$ico}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
                            }

                            if($config->showImgInVC && $result->image != '') {
                                    $img = $config->liveSite.$config->imagesFolder.$result->image;
                                    $img = "<a href=\"{$href}\" {$onClick}><img src=\"{$img}\" alt=\"{$result->title}\" title=\"{$result->title}\" /></a>";
                            }

                            $title = "<p class=\"sobi2ItemTitle\"><a href=\"{$href}\" {$onClick} title=\"{$result->title}\" >{$result->title}</a></p>";
                            $fields = array();
                            static $fieldids = null;
                            if( !$fieldids ) {
                                $query = "SELECT `fieldid` FROM `#__sobi2_fields` " .
                                                 "WHERE `in_vcard`= 1 AND `enabled` = 1 " .
                                                 "ORDER BY position";
                                $database->setQuery($query);
                                $fieldids = $database->loadResultArray();
								if ($database->getErrorNum()) {
									trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
								}
                                $config->sobiCache->add("field_vcard",$fieldids);
                            }
                            if( $fieldids ) {
                            	if( $config->cacheL3Enabled ) {
                                	sobi2Config::import( "sobi2.class" );
                                	$s = new  sobi2( $result->itemid );
                                	foreach ( $s->myFields as $field ) {
                                		if( in_array( $field->fieldid, $fieldids ) ) {
                                			$fields[] =& $s->myFields[ $field->fieldname ];
                                		}
                                	}
                                }
                                else {
	                            	sobi2Config::import("field.class");
	                            	foreach($fieldids as $fieldid) {
	                                   $fields[] = new sobiField($fieldid, $result->itemid);
	                                }
                                }
                            }
                            /*
                             * getting fields data
                             */
                            $fieldsFormated = array();
                            $fieldsObjects = array();
                            if( count( $fields ) ) {
                            	foreach($fields as $field) {
                                	$data = null;
                                    $field->name = $config->getSobiStr($field->fieldname);
                                    $field->label = $config->getSobiStr($field->label);
                                    if($field->fieldType == 2) {
										$field->data = $config->getSobiStr($field->data, true);
										$data = $field->data;
                                    }
                                    elseif( $field->fieldType == 1 || $field->fieldType == 5 || $field->fieldType == 7 ) {
										$field->data = $config->getSobiStr($field->data);
										if( $field->isUrl == 4 ) {
											$data = $field->customCode;
										}
										else {
											$data = $field->data;
										}
                                    }
                                    elseif($field->fieldType == 3) {
										$data = $field->data ? _SOBI2_CHECKBOX_YES : _SOBI2_CHECKBOX_NO;
										$field->with_label = 1;
                                     }
									elseif($field->fieldType == 6) {
										$field->data = $field->selectedValues;
										if(is_array($field->data) && !empty($field->data)) {
											$data = "\n<ul class = \"sobi2Listing_{$field->fieldname}\">";
											foreach ($field->data as $opt) {
												$data .= "\n\t<li>{$opt}</li>";
											}
											$data .= "\n</ul>";
										}
									}
                                    if(strlen($data) > 0) {
										$tag = "span";
										static $noFollows = null;
										static $noFollowsCheck = false;
										if( !$noFollowsCheck ) {
											$noFollows = $config->key( "url", "nofollow" );
											if( $noFollows ) {
												$noFollows = explode( ",", $noFollows );
											}
											else {
												$noFollows = array();
											}
											$noFollowsCheck = true;
										}
										if($field->isUrl == 1) {
											if( in_array( $field->fieldid, $noFollows )) {
												$noFollow = " rel=\"nofollow\" ";
											}
											else {
												$noFollow = null;
											}
											$data = "<a href=\"{$data}\"{$noFollow} title=\"{$result->title}\" target=\"_blank\">{$field->label}</a>";
										}
										elseif($field->isUrl == 2) {
											$data =  sobiHTML::emailCloaking( $data, 1, $field->label, 0 );
										}
										elseif($field->isUrl == 3) {
											$data = "<img src=\"{$data}\" title=\"{$field->label}\" alt=\"{$field->label}\" />";
										}
										if($field->with_label) {
											if( $field->fieldType != 6 ) {
												$data = "<{$tag} class=\"sobi2Listing_{$field->name}\"><span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}</{$tag}>";
											}
											else {
												$data = "<span class=\"sobi2Listing_{$field->name}_label\">{$field->label}:</span> {$data}";
											}
										}
										else {
											if( $field->fieldType != 6 ) {
												$data = "<{$tag} class=\"sobi2Listing_{$field->name}\">{$data}</{$tag}>";
											}
										}
										if($field->in_newline) {
											$data = "<br/>".$data;
										}
                                    }
                                    $fieldsFormated[$field->name] = $data;
                                    $fieldsObjects[$field->name] = $field;
                                }
                            }
                            $plugins = $this->getPlugins($result->itemid,false);
							$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
					        if( $config->debugTmpl && !$fetchErr ) {
					        	sobi2Config::parseTemplate( $template );
					        }
					        else {
					        	sobi2Config::import( $template, "absolute" );
					        }
					        sobi2Config::import("sobi2.class");
                            ob_start();
                            sobi2VCview($result->itemid, $style, $ico, $img, $title, $fieldsObjects, $fieldsFormated, $plugins, $editButton, $deleteButton);
                            $this->listing .= ob_get_contents();
                            ob_end_clean();
            }
            /*
             * on end check if last <tr> have $config->itemsInLine <td>'s
             */
            if($tdTrCounter%$config->itemsInLine != 0) {
		    		if( ($f = $config->key( "frontpage", "empty_cell_calback_function", false )) && function_exists( $f )) {
		    			$ecell = call_user_func( $f );
		    		}
		    		else {
		    			$ecell = "&nbsp;";
		    		}
                    $colspan = $config->itemsInLine - ($tdTrCounter%$config->itemsInLine);
                    $this->listing = $this->listing."\n\t\t\t\t<td class='sobi2EmptyCell' colspan='{$colspan}'>{$ecell}\n\t\t\t\t</td>";
            }
        }
        // wenn noch keine Eintraege da, dann korrekt schliessen
        else {
                $this->listing = $this->listing."\n\t\t\t<tr><td></td>";
        }
    }
    /**
     * @param int $catid
     * @return string
     */
    function getListing( &$cat )
    {
		$config	=& sobi2Config::getInstance();
		if($config->useDetailsView) {
			$this->buildListingWithTemplate( $cat );
		}
		else {
			$this->buildListing( $cat );
		}
    	return $this->listing;
    }

    /**
     * @param int $catid
     */
    function buildCatListing ( $cat )
    {
		$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$catid = $cat->catid;
		/*
		 * category with id is the root category
		 */
    	if(!$catid || $catid == 0) {
    		$catid = 1;
    	}
    	$pluginsMod = false;
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			$pluginsMod = (method_exists($plugin, "onCategoryList")) ? true : $pluginsMod;
    		}
		}
    	$Itemid = $config->sobi2Itemid;
		$results = $config->sobiCache->get("catBase_{$catid}","categories");

		if(!$results || $pluginsMod || is_integer($results)) {
			$query = "SELECT relations.catid " .
					 "FROM `#__sobi2_categories`" .
					 "LEFT JOIN `#__sobi2_cats_relations` AS relations ON `#__sobi2_categories`.catid = relations.catid " .
					 "WHERE `parentid` = {$catid} AND `published` = 1 ORDER BY {$config->catsOrdering}";
			$database->setQuery($query);
			$cids = $database->loadResultArray();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	    	$ids = (!empty($cids)) ? implode(" , ", $cids) : null;

			if ($database->getErrorNum()) {
				trigger_error("frontend::buildCatListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	    			if(method_exists($plugin, "onCategoryList")) {
						$plugin->onCategoryList( $cids );
	    			}
	    		}
			}
			if( count( $cids ) ) {
				$query = "SELECT * FROM #__sobi2_categories WHERE catid IN({$ids}) AND published = 1 ORDER BY {$config->catsOrdering}";
				$database->setQuery($query);
				$results = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("frontend::buildCatListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				if(!$pluginsMod) {
					$config->sobiCache->add("catBase_{$catid}",$results,"categories");
				}
			}
    	}
		if(is_array($results) && !empty($results)) {
			if( $config->isset_( "curDisplCatsList" ) ) {
				$curCats =& $config->get_( "curDisplCatsList" );
				$curCats = array_intersect( $curCats, $results );
			}
			else {
				$config->set_( "curDisplCatsList", $results );
			}
			$tdTrCounter = 0;
			$this->catList = $this->catList."\n\t<table id='sobi2CatListSymbols'>";
			$this->catList = $this->catList."\n\t\t<tr>";
			$width = 100/$config->catsListInLine;
			$width = "style='width: {$width}%;'";
			foreach($results as $result) {
				$countItems = null;
				if($tdTrCounter%$config->catsListInLine == 0 && $tdTrCounter != 0) {
					$this->catList = $this->catList."\n\t\t\t</tr>\n\t\t\t<tr>";
				}
				$this->catList = $this->catList."\n\t\t\t\t<td $width>";
				$tdTrCounter++;

				$href = "index.php?option=com_sobi2&amp;catid={$result->catid}&amp;Itemid={$Itemid}";
				$href = sobi2Config::sef($href);

				if($config->showCatItemsCount) {
					$countItems = $this->countItemsInCat($result->catid, $result->name);
				}
				$result->name = $config->getSobiStr($result->name);
				$result->introtext = $config->getSobiStr($result->introtext);
				$subcatsIgnore = $config->key( "frontpage", "subcats_ignore", null );
				if( $subcatsIgnore ) {
					$subcatsIgnore = explode( ",", $subcatsIgnore );
				}
				if( $config->subcatsShow && !( is_array( $subcatsIgnore ) && in_array( "catlist_{$catid}", $subcatsIgnore ) ) ) {
					$limit = $config->subcatsNumber;
					$limit = $config->key( "frontpage", "subcats_tbc", true ) ? ++$limit : $limit;
					$query = "SELECT scat.name, scat.introtext, scat.catid FROM #__sobi2_cats_relations AS srel LEFT JOIN #__sobi2_categories AS scat ON srel.catid = scat.catid WHERE srel.parentid = {$result->catid} AND scat.published = 1 ORDER BY {$config->subcatsOrdering} LIMIT {$limit}";
					$database->setQuery( $query );
					$subcats = array();
					$res = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("frontend::buildCatListing(): DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$tbc = false;
					if( count( $res ) >  $config->subcatsNumber ) {
						unset( $res[ $config->subcatsNumber ] );
						$tbc = true;
					}
					if( $res && !empty( $res ) ) {
						foreach ( $res as $subcat ) {
							$h = sobi2Config::sef("index.php?option=com_sobi2&amp;catid={$subcat->catid}&amp;Itemid={$config->sobi2Itemid}");
							$t = sobiHTML::cleanText( $subcat->introtext );
							$subcat->name = $config->getSobiStr( $subcat->name );
							$subcats[] = "<span class=\"sobi2SubcatsListItems\"><a href=\"{$h}\" title=\"{$t}\">{$subcat->name}</a></span>";
						}
					}
					if( !empty( $subcats ) ) {
						$subcats = implode( $config->key( "frontpage", "subcats_delimiter", ", "), $subcats );
						if( $tbc ) {
							$subcats .= "<span class=\"sobi2SubcatsListItems\"><a href=\"{$href}\" title=\"{$result->name}\">".$config->key( "frontpage", "subcats_tbc", " ... " )."</a></span>";
						}
						$subcats = "<span class=\"sobi2SubcatsList\">{$subcats}</span>";
						$result->introtext .= $subcats;
					}
				}
				if($result->icon && strlen($result->icon) > 0) {
					if(file_exists(_SOBI_CMSROOT.$config->catImagesFolder.$result->icon)) {
						$img = $config->liveSite.$config->catImagesFolder.$result->icon;
						if(stristr( $img, ".png" )) {
							$img = sobi2Config::checkPNGImage( $img, "{$result->name}", "float:left; border-style:none;", "sobi2CatIco" );
						}
						else {
							$img = "<img src=\"{$img}\" class=\"sobi2CatIco\" alt=\"{$result->name}\"/>";
						}
						$this->catList = $this->catList."\n\t\t\t\t\t<a href=\"{$href}\">{$img}</a>";
					}
				}
				$result->name = sobi2Config::replaceEntities($result->name);
				$this->catList = $this->catList."\n\t\t\t\t\t<p class=\"sobi2CatName\"><a href=\"{$href}\">{$result->name}</a>{$countItems}</p>";
				$this->catList = $this->catList."\n\t\t\t\t\t<p class=\"sobi2CatsListSymbolsIntrotext\">{$result->introtext}</p>" .
						"\n\t\t\t\t</td>";

			}
			if($tdTrCounter%$config->catsListInLine != 0) {
	    		if( ($f = $config->key( "frontpage", "cat_empty_cell_calback_function", false )) && function_exists( $f )) {
	    			$ecell = call_user_func( $f );
	    		}
	    		else {
	    			$ecell = "&nbsp;";
	    		}
				$colspan = $config->catsListInLine - ($tdTrCounter%$config->catsListInLine);
				$this->catList = $this->catList."\n\t\t\t\t<td class=\"sobi2EmptyCell\" colspan=\"{$colspan}\">\n\t\t\t\t\t{$ecell}\n\t\t\t\t</td>";
			}
			$this->catList = $this->catList."\n\t\t</tr>\n\t</table>\n";
		}
    }
    /**
     * @param int $catid
     * @return string
     */
    function getCatListing( &$cat )
    {
    	if(!$this->catList) {
    		$this->buildCatListing( $cat );
    	}
    	return $this->catList;
    }

    /**
     * @param int $catid
     * @param string $catname
     * @return string
     */
    function countItemsInCat( $catid, $catname )
    {
    	$config = &sobi2Config::getInstance();
    	$database = &$config->getDb();
		$items = 0;
		$subCats = 0;

    	$cache =& $config->sobiCache;
    	$counter = $cache->getObj( 0, 0, $catid, 0, true, true );
    	if( is_array( $counter ) ) {
    		$items = $counter['items'];
    		$subCats = $counter['cats'];
    	}
		if($items < 0) {
			$items = 0;
		}
		if($subCats < 1) {
			$subCatsStr = "-";
		}
		else {
			$subCatsStr = "{$subCats}";
		}
		if($items < 1) {
			$itemsStr = "-";
		}
		else {
			$itemsStr = "{$items}";
		}

    	$string = "<span class=\"sobi2CountSeparator\">&nbsp;(</span>";
		if( $config->key("frontpage", "catlist_count_entries", true) ) {
    		$string .= "<span class=\"sobi2EditlinktipItems\">".
						sobiHTML::toolTip(addslashes(_SOBI2_ITEMS_IN_THIS_CAT.$items),addslashes(_SOBI2_ITEMS_IN_CAT.$catname),'','',$itemsStr, '#',0 ).
				   	   	"</span>";
		}
		if( $config->key("frontpage", "catlist_count_cats", true) && $config->key("frontpage", "catlist_count_entries", true) ) {
			$string .= "<span class=\"sobi2CountSeparator\">" ._SOBI2_ITEMS_CATS_SEPARATOR. "</span>";
		}
		if( $config->key("frontpage", "catlist_count_cats", true) ) {
			$string .=  "<span class=\"sobi2EditlinktipCats\">" .
				   		sobiHTML::toolTip(addslashes(_SOBI2_SUBCATS_IN_THIS_CAT.$subCats),addslashes(_SOBI2_SUBCATS_IN_CAT.$catname),'','',$subCatsStr, '#',0 ).
				   		"</span>";
		}
		$string .= "<span class=\"sobi2CountSeparator\">&nbsp;)</span>";
    	return $string;
    }
    /**
     * getting plugins functions
     *
     * @param int $sobi2Id
     * @param bool $html
     * @return array
     */
    function getPlugins( $sobi2Id, $html = true )
    {
		$config =& sobi2Config::getInstance();
    	$plugins = null;
    	$pluginsArray = array();

    	if(count($config->S2_plugins)) {
    		if($html) {
    			$plugins = "\n\t\t<table class='sobi2Listing_plugins'>\n\t\t\t<tr>";
    		}
    		foreach($config->S2_plugins as $name => $plugin) {
    			if($plugin->listingStyle) {
    				$class = "class='{$plugin->listingStyle}'";
    			}
    			else {
    				$class = null;
    			}
    			if(method_exists($plugin,"showListing")) {
    				if($html) {
	    				$row = "<td {$class}>".$plugin->showListing($sobi2Id)."</td>";
	    				$plugins .= $row;
    				}
    				else {
    					$pluginsArray[$name] = $plugin->showListing($sobi2Id);
    				}
    			}
				// Start XHMTL 1.0 Transitional Compliance workaround
				else {
					if( $html ) {
						$plugins.="\n\t\t\t<td></td>";
					}
				}
				// End XHMTL 1.0 Transitional Compliance workaround
    		}
    		if($html) {
    			$plugins .= "\n\t\t\t</tr>\n\t\t</table>";
    		}
    	}
    	if($html) {
    		return $plugins;
    	}
    	else {
    		return $pluginsArray;
    	}
    }
    /**
     * plugin method by CoolAcid
     *
     * @param string $data
     * @return string
     */
    function runPlugins($data)
    {
		$config	=& sobi2Config::getInstance();
    	if(count($config->S2_plugins)) {
    		 foreach($config->S2_plugins as $name => $plugin) {
    		 	if(method_exists($plugin,"replaceData")) {
    		 		 $data = $plugin->replaceData($data);
    		 	}
    		 }
    	}
    	return $data;
    }
}
?>