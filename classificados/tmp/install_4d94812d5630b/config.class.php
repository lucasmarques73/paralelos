<?php
/**
* @version $Id: config.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
	( defined( '_SOBI2_' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) || ( trigger_error( 'Restricted access'.__FILE__, E_USER_ERROR ) && exit() );
	defined( '_SOBI2_' )   || define( '_SOBI2_', true );
	defined( '_ISO' ) || define( '_ISO', 'charset=utf8' );
	if( !defined( 'DS' ) ) {
		define( 'DS', DIRECTORY_SEPARATOR );
	}
	if( !function_exists( 'sefRelToAbs' ) && !defined( '_JEXEC' ) ) {
		require_once( _SOBI_CMSROOT.DS.'includes'.DS.'sef.php' );
	}
	if( !function_exists( 'sobi_make_pattern' ) ){
		/**
		 * Enter description here...
		 *
		 * @param unknown_type $pat
		 */
		function sobi_make_pattern( &$pat ) {
		   $pat = '/'.preg_quote( $pat, '/' ).'/i';
		}
	}
	if( !function_exists( 'str_ireplace' ) ){
		function str_ireplace( $search, $replace, $subject ){
		   if( is_array( $search ) ){
		       array_walk( $search, 'sobi_make_pattern' );
		   }
		   else{
		       $search = '/'.preg_quote($search, '/').'/i';
		   }
		   return preg_replace( $search, $replace, $subject );
		}
	}
defined( '_SOBI_FE_PATH' ) || define( '_SOBI_FE_PATH', dirname(__FILE__) );
defined( '_SOBI_CMSROOT' ) || define("_SOBI_CMSROOT", str_replace( DS."components".DS."com_sobi2", "", _SOBI_FE_PATH ) );
defined("_SOBI2_")  || define("_SOBI2_", true);
sobi2Config::import("includes|inc|custom.functions");
/**
 * Configuration keys and some helper funcions
 *
 */
class sobi2Config {
	/**
	 * @var boolean
	 */
	 var $forceLegacy = false;
	/**
	  * @var boolean
	  */
	 var $forceCustomHead = true;
	 /**
	  * @var boolean
	  */
	 var $useSigsiuTree = true;
	 /**
	  * @var array
	  */
	 var $aTreeImages = array();
	 /**
	  * @var boolean
	  */
	 var $debug = 0;
	 /**
	  * @var boolean
	  */
	 var $debugTmpl = 1;
	 /**
	  * @var boolean
	  */
	 var $allowFeEntr = true;
	 /**
	  * @var boolean
	  */
	 var $useDetailsView = 1;
	 /**
	  * @var boolean
	  */
	 var $useFormTpl = 1;
	 /**
	  * @var array
	  */
	 var $allowableFilesExt = array ('gif','jpg','png');
	 /**
	  * @var array
	  */
 	 var $allowedExtAudio = array('.mp3','.wav','.wma');
	 /**
	  * @var array
	  */
     var $allowedExtVideo = array('.mpg','mpeg','.wmv','.avi','.flv','.mov', '.swf');
	 /**
	  * @var array
	  */
 	 var $allowedEmbedUrl = array(
 	 					'http://www.youtube.com',
 	 					'http://www.myvideo.de'
 	 				);
	/**
	 * disallowed tags in input fields
	 *
	 * @var string array
	 */
	var $disalowedtags = array(
						"script",
                        "object",
                        "iframe",
                        "applet",
                        "meta",
                        "form",
                        "onmouseover",
                        "onmouseout"
		);
	/**
	 *
	 * @var array
	 */
	var $waySearchFields = array();
	/**
	 *
	 * @var array
	 */
	var $storeHouse = array();
	 /**
	  * component name
	  *
	  * @var string
	  */
	 var $componentName = null;
	 /**
	  * language for SOBI2
	  *
	  * @var string
	  */
	 var $sobi2Language = null;
	 /**
	  * @var boolean
	  */
	 var $showComponentLink = 1;
	 /**
	  * @var boolean
	  */
	 var $showSearchLink = 1;
	 /**
	  * @var boolean
	  */
	 var $showComponentDescInSearch = 1;
	 /**
	  * @var boolean
	  */
	 var $showAddNewEntryLink = 1;
	 /**
	  * @var boolean - not used
	  */
	 var $showLevelUpLink = 1;
	 /**
	  * @var boolean - not used
	  */
	 var $showPromoted = 1;
	 /**
	  * @var integer - not used
	  */
	 var $promoItemsInLine = 2;
	 /**
	  * @var integer - not used
	  */
	 var $publishedItems = 0;
	 /**
	  * @var boolean
	  */
	 var $useSecurityCode = 1;
	 /**
	  * @var int
	  */
	 var $mailAdmGid = "25";
	 /**
	  * @var int
	  */
	 var $mailSoJ = 0;
	 /**
	  * @var int
	  */
	 var $mailFieldId = 7;
	 /**
	  * @var boolean
	  */
	 var $needToAcceptEntryRules = 1;
	 /**
	  * @var frontend
	  */
	 var $frontend = null;
	 /**
	  * first part of entry rules label
	  *
	  * @var string
	  */
	 var $acceptEntryRules1 = null;
	 /**
	  * label for url in entry rules label
	  *
	  * @var string
	  */
	 var $entryRulesURLlabel = null;
	 /**
	  * @var string
	  */
	 var $header = null;
	 /**
	  * @var integer
	  */
	 var $dmod = 775;
	 /**
	  * @var bool
	  */
	 var $cmod = 0;
	 /**
	  * @var integer - not used
	  */
	 var $fmod = 664;
	 /**
	  * second part of entry rules label
	  *
	  * @var string
	  */
	 var $acceptEntryRules2 = null;
	 /**
	  * @var integer
	  */
	 var $allowUsingImg = 1;
	 /**
	  * @var integer
	  */
	 var $allowUsingIco = 1;
	 /**
	  * @var boolean - not used
	  */
	 var $entryRulesURLextern = null;
	 /**
	  * @var string url for entry rules
	  */
	 var $entryRulesURL = null;
	 /**
	  * @var string
	  */
	 var $currency = null;
	 /**
	  * @var string
	  */
	 var $payPalCurrency = null;
	 /**
	  * @var integer - number of allowed categories for one entry
	  */
	 var $maxCatsForEntry = 1;
	 /**
	  * @var array
	  */
	 var $catPrices = array();
	 /**
	  * @var boolean - nut used
	  */
	 var $checkReferer = null;
	 /**
	  * @var time - std expirations time for an entry
	  */
	 var $entryExpirationTime = 0;
	 /**
	  * @var time - std expirations time for an entry
	  */
	 var $renewDiscount = 0;
	 /**
	  * @var time - std expirations time for an entry
	  */
	 var $renewExpirationTime = 0;
	 /**
	  * @var boolean
	  */
	 var $allowRenew = 0;
	 /**
	  * @var boolean
	  */
	 var $allowRenewDaysForExp = 0;
	 /**
	  * @var boolean
	  */
	 var $renewDeleteFees = 0;
	 /**
	  * @var boolean
	  */
	 var $allowQuickEdit = 0;
	 /**
	  * @var boolean
	  */
	 var $autopublishEntry = 0;
	 /**
	  * @var boolean - not used
	  */
	 var $needToConfirmNew = 0;
	 /**
	  * @var boolean - notify admins about new entry
	  */
	 var $notifyAdmins = 1;
	 /**
	  * @var array
	  */
	 var $settings = array();
	 /**
	  * @var boolean - allow duplicating entries title
	  */
	 var $allowMultiTitle = 0;
	 /**
	  * @var boolean
	  */
	 var $showListingOnFp = 1;
	 /**
	  * @var integer
	  */
	 var $itemsInLine = 3;
	 /**
	  * @var boleintegeran
	  */
	 var $lineOnSite = 3;
	 /**
	  * @var boolean
	  */
	 var $showCatListOnFp = 1;
	 /**
	  * @var boolean
	  */
	 var $showCatListInCat = 1;
	 /**
	  * @var integer - not used
	  */
	 var $catListAs = 2;
	 /**
	  * @var integer
	  */
	 var $catsListInLine = 3;
	 /**
	  * @var boolean
	  */
	 var $showEntriesFromSubcats = 1;
	 /**
	  * @var boolean
	  */
	 var $showIcoInVC = 1;
	 /**
	  * @var boolean
	  */
	 var $showImgInVC = 0;
	 /**
	  * @var float
	  */
	 var $priceForImg = null;
	 /**
	  * @var float
	  */
	 var $priceForIco = null;
	 /**
	  * @var boolean
	  */
	 var $allowUserToEditEntry = null;
	 /**
	  * @var string
	  */
	 var $imagesFolder = "/images/com_sobi2/clients/";
	 /**
	  * @var string
	  */
	 var $catImagesFolder = "/images/stories/";
	 /**
	  * @var string
	  */
	 var $templatesDir = "templates";
	 /**
	  * @var array
	  */
	 var $templates = array();
	 /**
	  * @var string
	  */
	 var $defTemplate = "default";
	 /**
	  * @var boolean
	  */
	 var $useMeta = null;
	 /**
	  * @var boolean
	  */
	 var $showIcoInDetails = null;
	 /**
	  * @var boolean
	  */
	 var $showImageInDetails = null;
	 /**
	  * @var boolean
	  */
	 var $useWaySearch = null;
	 /**
	  * @var boolean
	  */
	 var $showAlphaIndex = true;
	 /**
	  * @var string
	  */
	 var $waySearchUrl = null;
	 /**
	  * @var string
	  */
	 var $waySearchLabel = null;
	 /**
	  * @var boolean - send email with selected not free options
	  */
	 var $mailFees = null;
	 /**
	  * @var boolean
	  */
	 var $useBankTransfer = null;
	 /**
	  * @var boolean
	  */
	 var $usePayPal = null;
	 /**
	  * @var string
	  */
	 var $bankData = null;
	 /**
	  * @var string
	  */
	 var $payPalMail = null;
	 /**
	  * @var string
	  */
	 var $payPalReturnUrl = null;
	 /**
	  * @var string
	  */
	 var $payPalUrl = null;
	 /**
	  * @var string
	  */
	 var $payTitle = null;
	 /**
	  * @var string
	  */
	 var $curencyDecSeparator = '.';
	 /**
	  * @var integer
	  */
	 var $allowUserDelete = 2;
	 /**
	  * @var string
	  */
	 var $listingOrdering = "ordering";
	 /**
	  * @var string
	  */
	 var $catsOrdering = "ordering";
	 /**
	  * @var string
	  */
	 var $subcatsOrdering = "ordering";
	 /**
	  * @var int
	  */
	 var $subcatsNumber = 5;
	 /**
	  * @var bool
	  */
	 var $subcatsShow = 1;
	 /**
	  * @var string
	  */
	 var $nullDate = null;
	 /**
	  * @var time
	  */
	 var $checkOutTime = null;
	 /**
	  * @var boolean
	  */
	 var $showComponentDescription = null;
	 /**
	  * @var boolean
	  */
	 var $showCatDesc = null;
	 /**
	  * @var string - std background image
	  */
	 var $sobi2BackgroundImg = null;
	 /**
	  * @var string - std border color
	  */
	 var $sobi2BorderColor = null;
	 /**
	  * @var string - security image
	  */
	 var $secImgBgColor = null;
	 /**
	  * @var string - security image
	  */
	 var $secImgFontColor = null;
	 /**
	  * @var string - security image
	  */
	 var $secImgLineColor = null;
	 /**
	  * @var string - security image
	  */
	 var $secImgBorderColor = null;
	 /**
	  * @var boolean
	  */
	 var $showAddedDate = null;
	 /**
	  * @var boolean
	  */
	 var $showHits = null;
	 /**
	  * @var string - label of the entry title input box
	  */
	 var $efEntryTitleLabel = null;
	 /**
	  * @var integer - length of the entry title input box
	  */
	 var $efEntryTitleLength = 30;
	 /**
	  * @var string - label of the image input box
	  */
	 var $efImgLabel = null;
	 /**
	  * @var string - label of the image input box
	  */
	 var $efIcoLabel = null;
	 /**
	  * @var integer
	  */
	 var $thumbWidth = 50;
	 /**
	  * @var integer
	  */
	 var $thumbHeigth = 50;
	 /**
	  * @var integer
	  */
	 var $imgWidth = 50;
	 /**
	  * @var integer
	  */
	 var $imgHeigth = 50;
	 /**
	  * @var boolean - allow anonymous entries
	  */
	 var $allowAnonymous = 0;
	 /**
	  * @var integer - sobi2 menu id (Joomla! - Itemid)
	  */
	 var $sobi2Itemid = null;
	 /**
	  * @var bool
	  */
	 var $forceMenuId = true;
	 /**
	  * @var boolean - notify author when he add a new entry
	  */
	 var $notifyAuthorNew = null;
	 /**
	  * @var boolean - notify author about changes in his entry
	  */
	 var $notifyAuthorChanges = null;
	 /**
	  * @var boolean - notify admin about changes
	  */
	 var $notifyAdminChanges = null;
	 /**
	  * @var boolean
	  */
	 var $notifyAuthorRenew = null;
	 /**
	  * @var boolean
	  */
	 var $notifyAdminRenew = null;
	 /**
	  * @var boolean - notify author when his entry is approved
	  */
	 var $emailOnAppr = null;
	 /**
	  * @var integer - max size of uploaded file
	  */
	 var $maxFileSize = null;
	 /**
	  * @var string - google API key
	  */
	 var $googleMapsApiKey = null;
	 /**
	  * @var integer
	  */
	 var $googleMapsWidth = null;
	 /**
	  * @var integer
	  */
	 var $googleMapsHeight = null;
	 /**
	  * @var integer
	  */
	 var $googleMapsBubble = null;
	 /**
	  * @var integer - field id
	  */
	 var $googleMapsLongField = null;
	 /**
	  * @var integer - field id
	  */
	 var $googleMapsLatField = null;
	 /**
	  * @var integer
	  */
	 var $googleMapsZoom = null;
	 /**
	  * @var boolean
	  */
	 var $useGoogleMaps = null;
	 /**
	  * @var string
	  */
	 var $mailFooter = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnSubmitTitle = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnSubmitText = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnUpdateTitle = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnUpdateText = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailPaymentsTitle = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailPaymentsText = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnSubmitTitle = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnSubmitText = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnRenewTitle = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnRenewText = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnRenewTitle = null;
	 /**
	  * @var string
	  */
	 var $AdmEmailOnRenewText = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnUpdateTitle = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnUpdateText = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnApproveTitle = null;
	 /**
	  * @var string
	  */
	 var $UserEmailOnApproveText = null;
	 /**
	  * @var string
	  */
	 var $UserEmailPaymentsTitle = null;
	 /**
	  * @var string
	  */
	 var $UserEmailPaymentsText = null;
	 /**
	  * @var boolean - mail the selected not free options to admins too
	  */
	 var $mailFeesAdm = null;
	 /**
	  * @var boolean - Show the number of entries and subcategories behind the category name in category list
	  */
	 var $showCatItemsCount = 1;
	 /**
	  * @var boolean
	  */
	 var $allowAddingToParentCats = null;
	 /**
	  * @var array - array of plugins objects
	  */
	 var $S2_plugins = array();
	 /**
	  * @var string
	  */
	 var $S2_pluginsPath = null;
	 /**
	  * @var integer - could change the administrations permisions
	  */
	 var $admPermission = null;
	 /**
	  * @var boolean
	  */
	 var $allowUsingBackground = null;
	 /**
	  * @var boolean - allow not registered user to see the details view page
	  */
	 var $allowAnoDetails = null;
	 /**
	  * @var object - menu parameters
	  */
	 var $params = null;
	 /**
	  * Price for basic entry
	  *
	  * @var float
	  */
	 var $basicPrice = 0;
	 /**
	  * Label for basic entry - if not free
	  *
	  * @var string
	  */
	 var $basicPriceLabel = '';
	 /**
	  * enable/disable cache
	  *
	  * @var boolean
	  */
	 var $cacheEnabled = false;
	 /**
	  * caceh lifetime
	  *
	  * @var integer
	  */
	 var $cacheLifetime = 0;
	 /**
	  * enable/disable cache
	  *
	  * @var boolean
	  */
	 var $cacheL2Enabled = true;
	 /**
	  * enable/disable cache
	  *
	  * @var boolean
	  */
	 var $cacheL2dvEnabled = false;
	 /**
	  * cache lifetime
	  *
	  * @var integer
	  */
	 var $cacheL2Lifetime = 900;
	 /**
	  * cache lifetime
	  *
	  * @var integer
	  */
	 var $cacheL2strLen = 50000;
	 /**
	  * enable/disable cache
	  *
	  * @var boolean
	  */
	 var $cacheL3Enabled = true;
	 /**
	  *
	  * @var integer
	  */
	 var $cacheL3strLen = 50000;
	 /**
	  * chache drectory
	  *
	  * @var string
	  */
	 var $cacheDir = '';
	 /**
	  * @var boolean - small controls for google maps (zoom etc)
	  */
	 var $googleSmallMapControl = true;
	 /**
	  * @var boolean - map type controls hybrid/map
	  */
	 var $googleMapTypeControl = false;
	 /**
	  * Control for RSS Feeds
	  *
	  * @var boolean
	  */
	 var $useRSSfeed = true;
	 /**
	  * sitch using of the ajax search
	  * @since RC 2.7.4
	  * @var bool
	  */
	 var $useAjaxSearch = true;
	 /**
	  * @var bool
	  */
	 var $ajaxSearchUseSlider = true;
	 /**
	  * @var bool
	  */
	 var $ajaxSearchSlidInOnStart = true;
	 /**
	  * @var bool
	  */
	 var $ajaxSearchSlidInAfterSearch = true;
	 /**
	  * @var bool
	  */
	 var $ajaxSearchCatsForFields = false;
	 /**
	  * @var int
	  */
	 var $ajaxSearchCatsContHeight = 100;
	 /**
	  * @var bool
	  */
	 var $ajaxSearchCatsFieldsDepend = true;
	 /**
	  * all config values
	  *
	  * @var array
	  */
	 var $configValues = array();
	 /**
	  * Cache object
	  *
	  * @var sobiCache
	  */
	 var $sobiCache = null;
	 /**
	  * Mambo/Joomla database object
	  *
	  * @var database
	  */
	 var $database = null;
	 /**
	  * Mambo/Joomla user object
	  *
	  * @var mosUser
	  */
	 var $user = null;
	 /**
	  * @var string
	  */
	 var $absolutePath = null;
	 /**
	  * @var string
	  */
	 var $liveSite = null;
	 /**
	  * @var mosMainFrame
	  */
	 var $mainframe = null;
	 /**
	  * @var string
	  */
	 var $offset = null;
	 /**
	  * @var string
	  */
	 var $sitename = null;
	 /**
	  * @var gacl
	  */
	 var $acl = null;
	 /**
	  * @var string
	  */
	 var $mailfrom = null;
	 /**
	  * @var string
	  */
	 var $fromname = null;
	 /**
	  * @var string
	  */
	 var $globalLang = null;
	 /**
	  * @var string
	  */
	 var $DBhost = null;
	 /**
	  * @var string
	  */
	 var $DBuser  = null;
	 /**
	  * @var string
	  */
	 var $DBpassword = null;
	 /**
	  * @var string
	  */
	 var $DBname = null;
	 /**
	  * @var string
	  */
	 var $DBprefix = null;
	 /**
	  * @var bool
	  */
	 var $pby = true;
	 /**
	  * @var int
	  */
	 var $memStart  = 0;
	 /**
	  * @var int
	  */
	 var $timeStart  = 0;
	 /**
	  * @var int
	  */
	 var $queryStart  = 0;
	 /**
	  * @var string
	  */
	 var $secret = null;

    /**
     * Default constructor - initialazing all standard configuration keys
     */
    function sobi2Config()
    {
    	/* critical section */
    	$GLOBALS['sobi2_config_construct_cs'] = true;
		sobi2Config::loadBridge();
		sobi2bridge::init( $this );

		if( $settingsFile = sobi2Config::translatePath( "includes|inc|config", "front", true, ".ini" ) ) {
			$this->settings = parse_ini_file( $settingsFile, true );
			$this->imagesFolder = $this->key( "general", "images_folder", "/images/com_sobi2/clients/" );
			$this->catImagesFolder = $this->key( "general", "cat_images_folder", "/images/stories/" );
			$this->templatesDir = $this->key( "general", "templates_dir", "templates" );
//			$this->defTemplate = $this->key( "general", "def_template", "default" );
			$this->disalowedtags = explode( "|", $this->key( "general", "disallowed_tags", "script|object|iframe|applet|meta|form|onmouseover|onmouseout" ) );
			array_walk( $this->disalowedtags, "sobi2trim" );
			$this->allowableFilesExt = explode( "|", $this->key( "general", "allowed_files_ext", "gif|jpg|png" ) );
			array_walk( $this->allowableFilesExt, "sobi2trim" );
			$this->allowedExtAudio = explode( "|", $this->key( "general", "allowed_ext_audio", ".mp3|.wav|.wma") );
			array_walk( $this->allowedExtAudio, "sobi2trim" );
			$this->allowedExtVideo = explode( "|", $this->key( "general", "allowed_ext_video", ".mpg|mpeg|.wmv|.avi|.flv|.mov|.swf" ) );
			array_walk( $this->allowedExtVideo, "sobi2trim" );
			$this->allowedEmbedUrl = explode( "|", $this->key( "general", "allowed_embbed_url", "http://www.youtube.com|http://www.myvideo.de" ) );
			array_walk( $this->allowedEmbedUrl, "sobi2trim" );
			$this->forceCustomHead = $this->key( "general", "force_custom_head_tag", true );
		}
		if( $this->key( "compat", "use_mos_conf_livesite", false ) ) {
			if( class_exists( 'JURI' ) ) {
				$this->liveSite =  substr_replace( JURI::root(), '', -1, 1 );
			}
			else {
				global $mosConfig_live_site;
				$this->liveSite	= $mosConfig_live_site;
			}
		}
		else {
			$protocol = ( ( sobi2Config::request( $_SERVER, "SERVER_PORT", 0 ) == 443 ) || sobi2Config::request( $_SERVER, "HTTPS", false ) ) ? "https" : "http";
			$host = sobi2Config::request( $_SERVER, "HTTP_HOST", null );
			if( $host && $protocol ) {
				$path = sobi2Config::request( $_SERVER, "SCRIPT_NAME", null );
				$path = str_replace( array( "/index.php", "/index2.php", "/index3.php" ), null, $path );
				$subdir = null;
				if( defined( "_SOBI2_ADMIN" ) ) {
					if( $path != "/administrator" ) {
						$subdir = str_replace( "/administrator", null, $path );
					}
				}
				else {
					if( strlen( $path ) ) {
						$subdir = $path;
					}
				}
				$this->liveSite	= "{$protocol}://{$host}{$subdir}";
			}
			else {
				trigger_error( "Cannot investigate live site address |{$protocol}://{$host}{$subdir}|" );
				if( class_exists( 'JURI' ) ) {
					$this->liveSite =  substr_replace( JURI::root(), '', -1, 1 );
				}
				else {
					global $mosConfig_live_site;
					$this->liveSite	= $mosConfig_live_site;
				}
			}
		}
		$query = "SELECT `configValue`, `configKey` FROM `#__sobi2_config`";
		$this->database->setQuery( $query );
		$configValues = $this->database->loadObjectList();
		if ( $this->database->getErrorNum() ) {
			trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
		}
		foreach ( $configValues as $value ) {
			$this->configValues[$value->configKey] = $value->configValue;
		}
		$this->S2_pluginsPath =  _SOBI_FE_PATH.DS."plugins";
		$this->nullDate = $this->getNullDate();
		$this->sobi2Language = $this->getValueFromDB("frontpage", "language");

		if($this->sobi2Language == 'default') {
			$this->sobi2Language = $this->globalLang;
    		if( !defined("_SOBI2_ADMIN") ) {
	    		$this->efEntryTitleLabel 	= $this->key( $this->sobi2Language, "ef_entry_title_label", $this->getSobiStr($this->getValueFromDB("editForm", "efEntryTitleLabel"))) ;
	    		$this->efImgLabel 			= $this->key( $this->sobi2Language, "ef_img_label", $this->getSobiStr($this->getValueFromDB("editForm", "efImgLabel")) ) ;
	    		$this->efIcoLabel 			= $this->key( $this->sobi2Language, "ef_ico_label",  $this->getSobiStr($this->getValueFromDB("editForm", "efIcoLabel")) );
	    		$this->acceptEntryRules1 	= $this->key( $this->sobi2Language, "ef_accept_entry_rules1", $this->getSobiStr($this->getValueFromDB("editForm", "acceptEntryRules1") ) );
	    		$this->entryRulesURLlabel 	= $this->key( $this->sobi2Language, "ef_entry_rules_url_label", $this->getSobiStr($this->getValueFromDB("editForm", "entryRulesURLlabel") ) );
	    		$this->acceptEntryRules2 	= $this->key( $this->sobi2Language, "ef_accept_entry_rules2", $this->getSobiStr($this->getValueFromDB("editForm", "acceptEntryRules2")) ) ;
	    		$this->entryRulesURL 		= $this->key( $this->sobi2Language, "ef_entry_rules_url", $this->getSobiStr($this->getValueFromDB("editForm", "entryRulesURL")) );
	    		$this->componentName 		= $this->key( $this->sobi2Language, "directory_name", $this->getSobiStr($this->getValueFromDB("editForm", "componentName") ) );
	    		$this->basicPriceLabel 		= $this->key( $this->sobi2Language, "basic_price_label", $this->getSobiStr($this->getValueFromDB("general","basicPriceLabel") ) );
			}
			else {
	    		$this->efEntryTitleLabel 	= $this->getSobiStr($this->getValueFromDB("editForm", "efEntryTitleLabel"));
		    	$this->efImgLabel 			= $this->getSobiStr($this->getValueFromDB("editForm", "efImgLabel"));
		    	$this->efIcoLabel			= $this->getSobiStr($this->getValueFromDB("editForm", "efIcoLabel"));
				$this->acceptEntryRules1 	= $this->getSobiStr($this->getValueFromDB("editForm","acceptEntryRules1"));
				$this->entryRulesURLlabel 	= $this->getSobiStr($this->getValueFromDB("editForm","entryRulesURLlabel"));
				$this->acceptEntryRules2 	= $this->getValueFromDB("editForm","acceptEntryRules2");
				$this->entryRulesURL 		= $this->getValueFromDB("editForm", "entryRulesURL");
				$this->componentName 		= $this->getSobiStr($this->getValueFromDB("general", "componentName"));
				$this->basicPriceLabel 		= $this->getValueFromDB("general","basicPriceLabel");
			}
		}
		else {
    		$this->efEntryTitleLabel 	= $this->getSobiStr($this->getValueFromDB("editForm", "efEntryTitleLabel"));
	    	$this->efImgLabel 			= $this->getSobiStr($this->getValueFromDB("editForm", "efImgLabel"));
	    	$this->efIcoLabel			= $this->getSobiStr($this->getValueFromDB("editForm", "efIcoLabel"));
			$this->acceptEntryRules1 	= $this->getSobiStr($this->getValueFromDB("editForm","acceptEntryRules1"));
			$this->entryRulesURLlabel 	= $this->getSobiStr($this->getValueFromDB("editForm","entryRulesURLlabel"));
			$this->acceptEntryRules2 	= $this->getValueFromDB("editForm","acceptEntryRules2");
			$this->entryRulesURL 		= $this->getValueFromDB("editForm", "entryRulesURL");
			$this->componentName 		= $this->getSobiStr($this->getValueFromDB("general", "componentName"));
			$this->basicPriceLabel 		= $this->getValueFromDB("general","basicPriceLabel");
		}
    	$this->efEntryTitleLength = $this->getValueFromDB("editForm", "efEntryTitleLength");

		$this->debug = $this->getValueFromDB("frontpage", "debug");
		$this->debugTmpl = $this->getValueFromDB("frontpage", "debugTmpl");
		if($this->debug == 0) {
			$this->debug = 8;
		}
		$this->showComponentLink = $this->getValueFromDB("frontpage", "showComponentLink");
		$this->showSearchLink = $this->getValueFromDB("frontpage", "showSearchLink");

		$this->showAddNewEntryLink = $this->getValueFromDB("frontpage", "showAddNewEntryLink");
		$this->entryExpirationTime = $this->getValueFromDB("general","entryExpirationTime");
		$this->autopublishEntry = $this->getValueFromDB("general", "autopublishEntry");
		$this->showListingOnFp = $this->getValueFromDB("frontpage", "showListingOnFp");

		$this->allowRenew = $this->getValueFromDB("general","allowRenew");
		$this->allowRenewDaysForExp = $this->getValueFromDB("general","allowRenewDaysForExp");
		$this->renewDeleteFees = $this->getValueFromDB("payment","renewDeleteFees");
		$this->renewDiscount = $this->getValueFromDB("general","renewDiscount");
		$this->renewExpirationTime = $this->getValueFromDB("general","renewExpirationTime");
		if( !$this->renewExpirationTime && !defined("_SOBI2_ADMIN") ) {
			$this->renewExpirationTime = $this->entryExpirationTime;
		}

		$this->itemsInLine = $this->getValueFromDB("frontpage", "itemsInLine");
		$this->itemsInLine = $this->itemsInLine > 0 ? $this->itemsInLine : 2;
		$this->defTemplate = $this->getValueFromDB("general", "defTpl");
		if( $this->defTemplate != 'default' ) {
			$this->loadTplCss( $this->defTemplate );
		}
		$this->lineOnSite = $this->getValueFromDB("frontpage", "lineOnSite");
		$this->lineOnSite = $this->lineOnSite > 0 ? $this->lineOnSite : 4;

		$this->showCatListOnFp = $this->getValueFromDB("frontpage", "showCatListOnFp");
		$this->showCatListInCat = $this->getValueFromDB("frontpage", "showCatListInCat");
		$this->catListAs = $this->getValueFromDB("frontpage", "catListAs");

		$this->catsListInLine = $this->getValueFromDB("frontpage", "catsListInLine");
		$this->catsListInLine = $this->catsListInLine > 0 ? $this->catsListInLine : 1;

		$this->showEntriesFromSubcats = $this->getValueFromDB("frontpage", "showEntriesFromSubcats");
		$this->currency = $this->getValueFromDB("editForm", "currency");

		$this->showIcoInVC = $this->getValueFromDB("frontpage", "showIcoInVC");
		$this->showImgInVC = $this->getValueFromDB("frontpage", "showImgInVC");
		$this->curencyDecSeparator = $this->getValueFromDB("general", "curencyDecSeparator");
		$this->allowUserToEditEntry = $this->getValueFromDB("general", "allowUserToEditEntry");
		$this->allowUserDelete = $this->getValueFromDB("general", "allowUserDelete");
		$this->allowQuickEdit = $this->getValueFromDB("general", "allowQuickEdit");
		$this->listingOrdering = $this->getValueFromDB("general", "listingOrdering");
		$this->catsOrdering = $this->getValueFromDB("general", "catsOrdering");
		$this->useMeta = $this->getValueFromDB("general", "useMeta");
		$this->checkOutTime = date('Y-m-d H:i:s', time() - (5 * 60 * 60) + ($this->offset * 60 * 60));
		$this->showComponentDescription = $this->getValueFromDB("frontpage", "showComponentDescription");

		$this->showCatDesc = $this->getValueFromDB("frontpage", "showCatDesc");
		$this->subcatsShow = $this->getValueFromDB("frontpage", "subcatsShow");
		$this->subcatsNumber = $this->getValueFromDB("frontpage", "subcatsNumber");
		$this->subcatsOrdering = $this->getValueFromDB("frontpage", "subcatsOrdering");
		$this->subcatsNumber = $this->subcatsNumber > 0 ? $this->subcatsNumber : 2;

		$this->sobi2BorderColor = $this->getValueFromDB("general", "sobi2BorderColor");
		$this->sobi2BackgroundImg = $this->getValueFromDB("general", "sobi2BackgroundImg");
		$this->maxCatsForEntry = $this->getValueFromDB("editForm", "maxCatsForEntry");
		$this->showCatItemsCount = $this->getValueFromDB("general", "showCatItemsCount");
		$this->allowUsingBackground = $this->getValueFromDB("general","allowUsingBackground");
		$this->pby = $this->getValueFromDB("general","pby");
		$this->allowAnoDetails = $this->getValueFromDB("general","allowAnoDetails");
		$this->basicPrice = $this->getValueFromDB("general","basicPrice");

		$this->showAlphaIndex = $this->getValueFromDB("frontpage", "showAlphaIndex");
		$this->ajaxSearchSlidInAfterSearch = $this->getValueFromDB("frontpage", "ajaxSearchSlidInAfterSearch");
		$this->ajaxSearchSlidInOnStart = $this->getValueFromDB("frontpage", "ajaxSearchSlidInOnStart");
		$this->ajaxSearchUseSlider = $this->getValueFromDB("frontpage", "ajaxSearchUseSlider");
		$this->ajaxSearchCatsForFields = $this->getValueFromDB("frontpage", "ajaxSearchCatsForFields");
		$this->ajaxSearchCatsContHeight = $this->getValueFromDB("frontpage", "ajaxSearchCatsContHeight");
		$this->ajaxSearchCatsFieldsDepend = $this->getValueFromDB("frontpage", "ajaxSearchCatsFieldsDepend");
		$this->mailAdmGid = $this->getValueFromDB("general","mailAdmGid");
		$this->mailFieldId = $this->getValueFromDB("general","mailFieldId");
		$this->mailSoJ = $this->getValueFromDB("general","mailSoJ");
		$this->showComponentDescInSearch = $this->getValueFromDB("search","showComponentDescInSearch");
		$this->allowFeEntr = $this->getValueFromDB("general","allowFeEntr");
		$this->cmod = $this->key( "general", "change_file_permissions", false );
		$this->dmod = $this->key( "general", "directories_permissions", 755 );
		$this->fmod = $this->key( "general", "files_permissions", 664 );
		$this->useFormTpl = $this->getValueFromDB("general","useFormTpl");

		$this->cacheL2Enabled = $this->getValueFromDB("cache","cacheL2Enabled");
		$this->cacheL2dvEnabled = $this->cacheL2Enabled ? $this->getValueFromDB("cache","cacheL2dvEnabled") : false;
		$this->cacheL2Lifetime = $this->getValueFromDB("cache", "cacheL2Lifetime");
		$this->cacheL2strLen = $this->getValueFromDB("cache", "cacheL2strLen");
		$this->cacheL3Enabled = $this->getValueFromDB("cache","cacheL3Enabled");
		$this->cacheL3strLen = $this->getValueFromDB("cache", "cacheL3strLen");

		sobi2Config::import( 'sobi2.cache.class' );
		$this->sobiCache = new sobiCache($this);

		$this->forceMenuId = $this->getValueFromDB("general", "forceMenuId");
		$Itemid = (int) sobi2Config::request( $_REQUEST, "Itemid", 0 );

		if( !( $this->forceMenuId ) && !( defined( "_SOBI2_ADMIN" ) ) ) {
			$query = "SELECT COUNT(*) FROM `#__menu` WHERE `id` = {$Itemid} AND `link` LIKE '%com_sobi2%'  AND `published` = '1'";
			$this->database->setQuery( $query );
			$c = $this->database->loadResult();
			if ( $this->database->getErrorNum() ) {
				trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
			}
			if( !$c ) {
				$this->forceMenuId = true;
			}
		}

		if( ( $this->forceMenuId ||  !$Itemid )) {
			if( !( class_exists( 'JFactory' ) ) ) {
				$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_sobi2%' AND `type` = 'components' AND `published` = '1' LIMIT 1";
			}
			else {
				$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_sobi2%' AND `type` = 'component' AND `published` = '1' LIMIT 1";
			}
			$this->database->setQuery( $query );
			$this->sobi2Itemid = $this->database->loadResult();
			if ( $this->database->getErrorNum() ) {
				trigger_error( "DB reports: ".$this->database->stderr(), E_USER_WARNING);
			}
			sobi2Config::loadBridge();
			$menu =& sobi2bridge::jMenu( $this->database );
			$menu->load( $this->sobi2Itemid );
			if( empty( $this->sobi2Itemid ) ) {
				$this->sobi2Itemid = 0;
			}
			if( $this->forceMenuId ) {
				$this->sobiCache->add("menuId",$this->sobi2Itemid);
			}
		}
		else {
			$this->sobi2Itemid = (int) $Itemid;
		}

		$this->useDetailsView = $this->getValueFromDB("frontpage", "useDetailsView");
		$this->useRSSfeed = $this->getValueFromDB("general","useRSSfeed");
		$this->useSigsiuTree = $this->key( "compat", "use_sigsiutree", true );
		$aTreeImgs = $this->getValueFromDB("general","SigsiuTreeImages");
		$aTreeImgs = explode(",",$aTreeImgs);
		foreach ($aTreeImgs as $img) {
			$img = explode("=",$img);
			$this->aTreeImages[trim($img[0])] = trim($img[1]);
			unset($img);
		}

		unset($aTreeImgs);
		$waySearchFields = $this->getValueFromDB("general","waySearchFields");
		$waySearchFields = explode(";", $waySearchFields);
		foreach ($waySearchFields as $field) {
			if($field && !empty($field)) {
				$field = explode("=", $field);
				$this->waySearchFields[trim($field[0])] = trim($field[1]);
			}
		}
	 	$this->googleSmallMapControl = $this->key( "google_maps", "small_map_control", true );
	 	$this->googleMapTypeControl = $this->key( "google_maps", "map_type_control", false );
	 	$this->publishedItems = $this->key("users_own_listing", "can_see_expired") ? 4 : 0;
		$this->getEmails();
		$this->getDetails();
		$this->getEditForm();
		$GLOBALS['sobi2_config_construct_cs'] = false;
    }
    /**
     * @param string $tpl
     */
    function loadTplCss( $tpl )
    {
		if( $css = sobi2Config::translateDirPath( "templates|{$tpl}|css", 'front', true ) ) {
			$cssDir = opendir( $css );
			while ( $file = readdir( $cssDir ) ) {
				$f = explode( '.', $file );
				if( strtolower( $f[ count( $f ) - 1 ] ) == 'css' ) {
					$this->loadCSS( "components/com_sobi2/templates/{$tpl}/css/{$file}" );
				}
			}
		}
    }
    /**
     * @param string $name
     * @param mixed $attr
     */
    function set( $name, $attr )
    {
    	$this->storeHouse[$name] = $attr;
    }
    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    function get( $name, $default = null )
    {
    	return isset($this->storeHouse[$name]) ? $this->storeHouse[$name] : $default;
    }
    /**
     * @param string $name
     * @param mixed $attr
     */
    function set_( $name, &$attr )
    {
    	$this->storeHouse[$name] = &$attr;
    }
    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    function & get_( $name )
    {
    	return $this->storeHouse[$name];
    }
    /**
     * @param string $name
     * @return bool
     */
    function isset_( $name )
    {
    	return isset($this->storeHouse[$name]) ? true : false;
    }

    /**
     * Converting gived ini-string to an array
     *
     * @param string $str
     * @return array
     */
    function iniToArr( $str )
    {
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::iniToArr( $str );
    }
    /**
     * Converting gived array to ini-string
     *
     * @param unknown_type $arr
     * @return unknown
     */
    function arrToIni( $arr )
    {
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::arrToIni( $arr );
    }
    /**
     * @param string $section
     * @param string $key
     * @param string $def
     * @return string
     */
    function & key( $section, $key = null, $def = false )
    {
    	if( !$key ) {
    		if( is_array( $this->settings ) && isset( $this->settings[$section] ) ) {
    			return $this->settings[$section];
    		}
    		else {
    			return $def;
    		}
    	}
    	elseif( is_array( $this->settings ) && isset( $this->settings[$section][$key] ) ) {
    		return $this->settings[$section][$key];
    	}
    	else {
    		return $def;
    	}
    }
    /**
     * importing file
     *
     * @param string $path
     * @param string $start
     * @param string $ext
     * @param bool $require
     * @param bool $once
     * @param bool $warning
     */
    function import( $path, $start = "front", $warning = true, $once = true, $ext = ".php" )
    {
    	switch ( $start ) {
    		case "root":
    			$include = _SOBI_CMSROOT.DS;
    			break;
    		case "front":
    			$include = _SOBI_FE_PATH.DS;
    			break;
    		case "adm":
    			if(defined("_SOBI_ADM_PATH")) {
    				$include = _SOBI_ADM_PATH.DS;
    			}
    			else {
    				return false;
    			}
    			break;
    		default:
    		case "absolute":
    			$include = null;
    			break;
    	}
    	if( strstr( $path, $ext ) ) {
    		$ext = null;
    	}
		$include = $include ? $include.DS.$path.$ext : $path.$ext;
    	$include = str_replace( '|', DS, $include );
    	$include = str_replace( DS.DS, DS, $include );
    	if( !file_exists( $include ) || !is_readable( $include ) ) {
    		if( $warning ) {
    			trigger_error("sobi2Config::import(): File {$include} does not exist or is not readable.", E_USER_WARNING);
    		}
    		return false;
    	}
		else {
    		if( $once ) {
    			if( !include_once( $include ) ) {
					if( $warning ) {
		    			trigger_error("sobi2Config::import(): Cannot import file {$include}", E_USER_WARNING);
		    		}
		    		return false;
    			}
    			else {
    				return true;
    			}
    		}
    		else {
    			if( !include( $include ) ) {
					if( $warning ) {
		    			trigger_error("sobi2Config::import(): Cannot import file {$include}", E_USER_WARNING);
		    		}
		    		return false;
    			}
    			else {
    				return true;
    			}
    		}
		}
    }
    /**
     * Enter description here...
     *
     * @param string $path
     * @param string $start
     * @param bool $existCheck
     * @param string $ext
     * @return string
     */
    function translatePath( $path, $start = "front", $existCheck = true, $ext = ".php" )
    {
    	switch ($start) {
    		case "root":
    			$spoint = _SOBI_CMSROOT.DS;
    			break;
    		case "front":
    			$spoint = _SOBI_FE_PATH.DS;
    			break;
    		case "adm":
    			if(defined("_SOBI_ADM_PATH")) {
    				$spoint = _SOBI_ADM_PATH.DS;
    			}
    			else {
    				return false;
    			}
    			break;
    		case "absolute":
    		default:
    			$spoint = null;
    			break;
    	}
    	if( strlen( $ext ) && strstr( $path, $ext ) ) {
    		$ext = null;
    	}
    	$path = $spoint ? $spoint.DS.$path.$ext : $path.$ext;
    	$path = str_replace("|", DS, $path);
    	$path = str_replace(DS.DS, DS, $path);
    	if($existCheck) {
    		if(!file_exists($path) || !is_readable($path)) {
    			return false;
    		}
    		else {
    			return $path;
    		}
    	}
    	else {
    		return $path;
    	}
    }
    /**
     * @param string $path
     * @param string $start
     * @param bool $existCheck
     * @return string
     */
    function translateDirPath( $path, $start = "front", $existCheck = false )
    {
		return sobi2Config::translatePath( $path, $start, $existCheck, null);
    }
	/**
	 * @return mosUser
	 */
	function & getUser()
	{
		return $this->user;
	}
	/**
	 * @return database
	 */
	function & getDb()
	{
		return $this->database;
	}
	/**
	 * @return string
	 */
	function getAbsolutePath()
	{
		return $this->absolutePath;
	}
	/**
	 * @return string
	 */
	function getLiveSite()
	{
		return $this->liveSite;
	}
	/**
	 * @return string
	 */
	function getGlobalLang()
	{
		return $this->globalLang;
	}
	/**
	 * @return string
	 */
	function getSiteName()
	{
		return $this->sitename;
	}
	/**
	 * @return mosMainFrame
	 */
	function & getMainframe()
	{
		return $this->mainframe;
	}
	/**
	 * @return frontend
	 */
	function & getFrontend()
	{
		return $this->frontend;
	}
	/**
	 * @return frontend
	 */
	function setFrontend( &$frontend )
	{
		$this->frontend = &$frontend;
	}
	/**
	 * @return string
	 */
	function getOffset()
	{
		return $this->offset;
	}
	/**
	 * @return string
	 */
	function parseTemplate( $tpl, $content = null )
	{
		static $parsed = array();
		if( in_array( $tpl, $parsed )) {
			return true;
		}
		$parsed[] = $tpl;
		ini_set("display_errors","on");
		@ini_set('track_errors', '1');
		$url = $_SERVER['QUERY_STRING']."&err=1&no_html=1";
		$config =& sobi2Config::getInstance();
		if( !file_exists( $tpl ) ) {
			trigger_error("sobi2config::parseTemplate(): Template file |{$tpl}| does not exist ");
			sobi2config::debOut( "sobi2config::parseTemplate(): Template file |{$tpl}| does not exist " );
			return false;
		}
		else{
			if( !$content ) {
				ob_start();
				$content = eval('?' . '>' . rtrim( file_get_contents( $tpl ) ) );
				ob_end_clean();
			}
        	if( $content === false ) {
				ob_end_clean();
        		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
				header('Cache-Control: no-cache');
        		ob_start();
        		highlight_file( $tpl );
				$tplContent = ob_get_contents();
				ob_end_clean();
				if( $stream = fopen( "{$config->liveSite}/index.php?{$url}", 'r') ) {
    				if( function_exists( "stream_get_contents" ) ) {
						$err = stream_get_contents( $stream ) ;
    				}
    				else {
						$err = null;
						while ( !feof( $stream ) ) {
						  $err .= fread( $stream, 8192 );
						}
    				}
    				fclose($stream);
				}
				else {
					$err = null;
				}
				$tplContent = explode( "<br />", $tplContent );
				if( $err ) {
					$l = strpos( $err, "Parse error:");
					$err = substr( $err, $l );
					$l = strpos( $err, "on line");
					$errNr = str_replace( "on line", null, substr( $err, $l ) );
					$errNr = ereg_replace("[^0-9]", null ,$errNr );
					$err = str_replace( _SOBI_FE_PATH, " ... ", $err );
					$err = str_replace( "Parse error", "SOBI2 template parse error", $err );
					$config->debOut( $err );
				}
        		if( $tplContent && isset( $errNr ) && $errNr ) {
					$counter = 0;
        			foreach ( $tplContent as $line ) {
        				$counter++;
						if( $errNr && $counter == $errNr) {
							echo "<div style=\"color:red; border-color: #990000; border-style:solid\">{$counter}&nbsp;&nbsp;&nbsp;";
						}
						else {
							echo "<b style=\"color:black;\">{$counter}:</b>&nbsp;&nbsp;&nbsp;";
						}
        				echo $line;
						if( $errNr && $counter == $errNr) {
							echo "</div>";
						}
						else {
							echo "<br/>";
						}
					}
					exit();
        		}
        		else {
					trigger_error("sobi2config::parseTemplate(): Cannot parse template file |{$tpl}| ");
					sobi2config::debOut( "sobi2config::parseTemplate(): Cannot parse template file |{$tpl}|  " );
        		}
        		return false;
        	}
        	else {
        		return true;
        	}
		}
	}
	/**
	 * singleton
	 *
	 * @return sobi2Config
	 */
	function & getInstance()
	{
		if( isset( $GLOBALS['sobi2_config_construct_cs'] ) && $GLOBALS['sobi2_config_construct_cs'] == true) {
			sobi2Config::debOut("Critical Error: calling \"getInstance\" method from the config constructor.");
			sobi2Config::debOut("Please notify <a href=\"http://www.sigsiu.net/forum/index.php/board,21.0.html\">SOBI2 Development Team</a>");
			ob_start();
			if( function_exists( "debug_print_backtrace" ) ) {
				debug_print_backtrace();
			}
			else {
				print_r( debug_backtrace() );
			}
			$bugtrace = ob_get_contents();
			ob_end_clean();
			$bugtrace = str_replace( "\n", "<br/>", $bugtrace );
			$bugtrace = str_replace( _SOBI_CMSROOT, null, $bugtrace );
			sobi2Config::debOut( 'Debug Output: <br/><span style="color: red;">'.$bugtrace.'<span>' );
			exit();
		}
		static $config;
		if(defined("_SOBI2_ADMIN")) {
			adminConfig::getInstance();
		}
		if( !is_a( $config, "sobi2Config" ) ) {
			$config = new sobi2Config();
		}
		return $config;
	}
	/**
	 * Adding selected css script to header
	 *
	 * @param string $script - script name to add
	 */
	function loadCSS( $script )
	{
		$this->addCustomHeadTag("<link rel=\"stylesheet\" href=\"{$this->liveSite}/{$script}\" type=\"text/css\"/>");
	}
	/**
	 * Adding selected script to header
	 *
	 * @param string $script - script name to add
	 * @param string $ext - script file extension
	 * @param string $params - parameters for script
	 */
	function loadScript($script, $ext='js', $params = null)
	{
		$params = $params ? "?{$params}" : null;
		static $l = array();
		if(!key_exists($script, $l)) {
			$l[] = $script;
			$this->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$this->liveSite}/components/com_sobi2/includes/js/{$script}.{$ext}{$params}\"></script>");
		}
	}
	/**
	 * adding javascript to header
	 * @param string $script
	 * @param bool $noScriptTag
	 */
	function addCustomScript( $script, $addScriptTag = true, $skipComments = false )
	{
		$s = null;
		$s = $addScriptTag ? "\n\t<script type=\"text/javascript\">" : null;
    	if(!$skipComments) {
			$s .= "\n\t<!--";
	    	$s .= "\n\t/* <![CDATA[ */";
	    	$s .= "\n\t\t".$script;
	    	$s .= "\n\t/* ]]> */";
	    	$s .= "\n\t// -->";
    	}
    	else {
    		$s .= $script;
    	}
    	$s = $addScriptTag ? $s."\n  </script>" : $s;
   		$this->addCustomHeadTag($s);
	}

	/**
	 * @param string $html
	 * @param bool $force
	 */
	function addCustomHeadTag( $html, $force = false )
	{
		if( ( defined("_SOBI_MAMBO" ) && ( defined("_SOBI2_ADMIN" ) || eregi( "index2.php", $_SERVER['REQUEST_URI'] ) ) ) || $force ) {
			if( $this->forceCustomHead ) {
				if( !( $this->forceAddCustomHeadTags( $html ) ) ) {
					echo "\n<!-- not possible to add head tag -> direct output --> \n\t {$html} \n <!--//-->\n\n";
				}
			}
			else {
				echo $html;
			}
    	}
    	else {
    		$this->mainframe->addCustomHeadTag( $html );
    	}
		$this->header .= $html;
	}
	/**
	 * @param string $html
	 */
	function appendPathWay( $html )
	{
    	if( defined( "_JEXEC" ) && class_exists( "JRequest" ) ) {
			$pattern = '/"[^"]*"/';
			preg_match($pattern, $html, $matches);
    		$url = isset( $matches[0] ) ? $matches[0] : null;
    		if( !$url ) {
    			$title = strip_tags( str_replace( "&nbsp;", null, $html ) );
    		}
    		else {
	    		$url = str_replace( array( '"', $this->liveSite."/", "amp;" ), null, $url );
				$title = strip_tags( str_replace( "&nbsp;", null, $html ) );
    		}
    		$pathway =& $this->mainframe->getPathway();
    		$pathway->addItem( $title, $url );
    	}
		else {
			$this->mainframe->appendPathWay( $html );
		}
	}
	/**
	 * @param string $title
	 */
	function setPageTitle ( $title )
	{
		$this->mainframe->setPageTitle( html_entity_decode( $title ) );
	}
    /**
     * security function to check if user have permision to be an admin
     * @return boolean
     */
    function checkPerm()
    {
    	$this->admPermission = $this->getValueFromDB( 'adm','admPermission' );
    	$return = false;
		if( !$this->admPermission ) {
    		if( class_exists( 'JFactory') ) {
    			$user = & JFactory::getUser();
				if ( $user->authorize( 'com_users', 'manage' ) ) {
					$return =  true;
				}
    		}
    		else {
				if( $this->acl->acl_check( 'administration', 'manage', 'users', $this->user->usertype, 'components', 'com_users' ) ) {
	    			$return = true;
	    		}
	    		else {
	    			$return = false;
	    		}
    		}
		}
		elseif( $this->admPermission == 1 ) {
    		if( class_exists( 'JFactory') ) {
    			$user = & JFactory::getUser();
				if ( $user->authorize( 'com_content', 'edit', 'content', 'all' ) ) {
					$return =  true;
				}
    		}
	    	else {
				if( $this->acl->acl_check( 'action', 'edit', 'users', $this->user->usertype, 'content', 'all' ) ) {
		    			$return = true;
				}
		    	else {
		    		$return = false;
		    	}
    		}
		}
    	if( count( $this->S2_plugins ) ) {
    		foreach( $this->S2_plugins as $plugin ) {
				if( method_exists( $plugin, 'permissionsCheck' ) ) {
					$plugin->permissionsCheck( $return );
    			}
    		}
    	}
    	return $return;
    }
    /**
     * initialazing all parameters needed for new entry/edit form
     *
     */
    function getEditForm()
    {
    	if( $this->user->id && !$this->key( "edit_form", "seccode_registered", true ) ) {
    		$this->useSecurityCode = false;
    	}
    	else {
    		$this->useSecurityCode = defined("_JEXEC") ? false : $this->getValueFromDB("editForm", "useSecurityCode");
    	}
    	$this->secImgBgColor = $this->getValueFromDB("editForm", "secImgBgColor");
    	$this->secImgFontColor = $this->getValueFromDB("editForm", "secImgFontColor");
    	$this->secImgLineColor = $this->getValueFromDB("editForm", "secImgLineColor");
    	$this->secImgBorderColor = $this->getValueFromDB("editForm", "secImgBorderColor");
		$this->needToAcceptEntryRules = $this->getValueFromDB("editForm", "needToAcceptEntryRules");
		$this->entryRulesURLextern = $this->getValueFromDB("editForm", "entryRulesURLextern");

		if( !$this->catPrices = $this->key("cats_payment") ) {
			$this->catPrices[2] = $this->getValueFromDB("editForm", "cat2price");
			$this->catPrices[3] = $this->getValueFromDB("editForm", "cat3price");
			$this->catPrices[4] = $this->getValueFromDB("editForm", "cat4price");
			$this->catPrices[5] = $this->getValueFromDB("editForm", "cat5price");
		}
		else {
			$this->maxCatsForEntry = count($this->catPrices);
		}
		$this->checkReferer = $this->getValueFromDB("editForm", "checkReferer");
		$this->allowMultiTitle = $this->getValueFromDB("editForm","allowMultiTitle");
		$this->allowUsingImg = $this->getValueFromDB("editForm", "allowUsingImg");
		if($this->allowUsingImg) {
			$this->priceForImg = $this->getValueFromDB("editForm", "priceForImg");
		}
		$this->allowUsingIco = $this->getValueFromDB("editForm", "allowUsingIco");
		if($this->allowUsingIco) {
			$this->priceForIco = $this->getValueFromDB("editForm", "priceForIco");
		}
		$this->needToConfirmNew = $this->getValueFromDB("editForm", "needToConfirmNew");
		$this->thumbWidth = $this->getValueFromDB("editForm", "thumbWidth");
		$this->thumbHeigth = $this->getValueFromDB("editForm", "thumbHeigth");
		$this->imgWidth = $this->getValueFromDB("editForm", "imgWidth");
		$this->imgHeigth = $this->getValueFromDB("editForm", "imgHeigth");
		$this->allowAnonymous = $this->getValueFromDB("editForm", "allowAnonymous");
		$this->notifyAuthorNew = $this->getValueFromDB("editForm", "notifyAuthorNew");
		$this->notifyAuthorChanges = $this->getValueFromDB("editForm", "notifyAuthorChanges");
		$this->notifyAdminChanges = $this->getValueFromDB("editForm", "notifyAdminChanges");
		$this->notifyAdmins = $this->getValueFromDB("editForm", "notifyAdmins");
		$this->emailOnAppr = $this->getValueFromDB("editForm", "emailOnAppr");
		$this->maxFileSize = $this->getValueFromDB("editForm", "maxFileSize") / 1024;
		$this->mailFooter = "\n\n".$this->getValueFromDB("editForm", "mailFooter");
		$this->allowAddingToParentCats = $this->getValueFromDB("editForm", "allowAddingToParentCats");
    }
    /**
     * initialazing all parameters for details view
     *
     */
    function getDetails()
    {
    	$this->showIcoInDetails = $this->getValueFromDB("details", "showIcoInDetails");
    	$this->showImageInDetails = $this->getValueFromDB("details", "showImageInDetails");
    	$this->useWaySearch = $this->getValueFromDB("details", "useWaySearch");
    	$this->waySearchUrl = $this->getValueFromDB("details", "waySearchUrl");
    	$this->waySearchLabel = $this->getValueFromDB("details", "waySearchLabel");
    	$this->showHits = $this->getValueFromDB("details", "showHits");
    	$this->showAddedDate = $this->getValueFromDB("details", "showAddedDate");
    	$this->useGoogleMaps = $this->getValueFromDB("details", "useGoogleMaps");
    	if($this->useGoogleMaps) {
    		$this->getGoogleMaps();
    	}
    }
    /**
     * initialazing all parameters for payment class
     */
    function getPayment()
    {
    	$this->mailFees = $this->getValueFromDB("payment", "mailFees");
    	$this->mailFeesAdm = $this->getValueFromDB("payment", "mailFeesAdm");
    	$this->useBankTransfer = $this->getValueFromDB("payment", "useBankTransfer");
    	$this->usePayPal = $this->getValueFromDB("payment", "usePayPal");
    	$this->bankData = $this->getSobiStr($this->getValueFromDB("payment", "bankData"));
    	$this->payPalMail  = $this->getValueFromDB("payment", "payPalMail");
    	$this->payPalUrl  = $this->getValueFromDB("payment", "payPalUrl");
    	if(!$this->payPalUrl) {
    		$this->payPalUrl = "https://www.paypal.com/cgi-bin/webscr";
    	}
    	$this->payTitle = $this->getSobiStr($this->getValueFromDB("payment", "payTitle"));
    	$this->payPalCurrency  = $this->getValueFromDB("payment", "payPalCurrency");
    	$this->payPalReturnUrl = $this->getValueFromDB("payment", "payPalReturnUrl");
    	if(!$this->payPalReturnUrl) {
    		$this->payPalReturnUrl = $this->liveSite;
    	}
    	$this->mailFooter = "\n\n".$this->getValueFromDB("editForm", "mailFooter");
    }
    /**
     * initialazing all parameters needed for google maps
     */
    function getGoogleMaps() {
    	$this->googleMapsApiKey = $this->getValueFromDB("google", "googleMapsApiKey");
    	$this->googleMapsBubble = $this->getValueFromDB("google","googleMapsBubble");
    	$this->googleMapsHeight = $this->getValueFromDB("google","googleMapsHeight");
    	$this->googleMapsLatField = $this->getValueFromDB("google","googleMapsLatField");
    	$this->googleMapsLongField = $this->getValueFromDB("google","googleMapsLongField");
    	$this->googleMapsWidth = $this->getValueFromDB("google","googleMapsWidth");
    	$this->googleMapsZoom = $this->getValueFromDB("google", "googleMapsZoom");
    }
    function restoreDefaultErrorHandler()
    {
		restore_error_handler();
    }
	/**
	 * returning subcategories info
	 *
	 * @param integer $parent
	 * @return array
	 */
	function getCategories( $parent = 1 )
	{
		$published = null;
		if($parent < 1) {
			$parent = 1;
		}
		if(!(defined('_SOBI2_ADMIN')))  {
			$published = " published = 1 AND ";
		}
		 /* don't know exactly why but if I do it with only one query this whole thing will not be translate with JoomFish */
		 /* Only if I split it in two queries it will b translated */
		$query = "SELECT relations.catid " .
			 "FROM `#__sobi2_categories`" .
			 "LEFT JOIN `#__sobi2_cats_relations` AS relations ON `#__sobi2_categories`.catid = relations.catid " .
			 "WHERE `parentid` = {$parent} AND `published` = 1 ";
		$this->database->setQuery( $query );
		$cids = $this->database->loadResultArray();
		if ($this->database->getErrorNum()) {
			trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
		}

		if( count( $cids ) ) {
			$ids = (!empty($cids)) ? implode(" , ", $cids) : null;
			$query = "SELECT * FROM #__sobi2_categories WHERE catid IN({$ids}) AND published = 1 ORDER BY {$this->catsOrdering}";
			$this->database->setQuery( $query );
		}
    	$return = $this->database->loadObjectList();
		if ($this->database->getErrorNum()) {
			trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
		}
    	return $return;
	}
	/**
	 * getting childs cats for a category
	 *
	 * @param int $catid
	 * @param array $catChilds
	 */
	function getChildCats( $catid, &$catChilds )
	{
		if( $catid != 1 ) {
    		array_push($catChilds, $catid);
		}
		if(!($results = $this->sobiCache->get("childs_{$catid}","cats_childs"))) {
	    	$query = "SELECT `catid` FROM `#__sobi2_cats_relations` WHERE `parentid`={$catid}";
			$this->database->setQuery( $query );
			$results = $this->database->loadObjectList();
			$this->sobiCache->add("childs_{$catid}",$results,"cats_childs");
		}
    	/*
    	 * if we still have a results
    	 */
		if(count( $results ) > 0 &&  $results != -100 ) {
			foreach($results as $result) {
				$this->getChildCats($result->catid, $catChilds);
			}
		}
	}
	/**
	 * returning parent cats for
	 *
	 * @param integer $catid
	 * @param array $parents
	 */
	function getParentCats ($catid, &$parents)
	{

		$query = "SELECT parentid FROM `#__sobi2_cats_relations` WHERE `catid`={$catid}";
		$this->database->setQuery( $query );
		/*
		 * the category with catid = 1 is the root category
		 */
		if($catid != 1) {
			array_push($parents, $catid);
		}
    	/*
    	 * if we still have a results
    	 */
    	if(sizeof($this->database->loadResult()) != 0) {
			$this->getParentCats($this->database->loadResult(),$parents);
    	}
	}
    /**
     * give all emails textes and titles
     *
     * @param string $lang - language
     * @param boolean $remark - remark if sending email. No remark if editing email templates
     */
    function getEmails($lang = null, $remark = true)
    {
    	if(!$lang) {
    		$lang = $this->sobi2Language;
    	}
		$this->notifyAuthorNew 		= ($this->getValueFromDB("editForm", "notifyAuthorNew"));
		$this->notifyAuthorChanges 	= ($this->getValueFromDB("editForm", "notifyAuthorChanges"));
		$this->notifyAdminChanges 	= ($this->getValueFromDB("editForm", "notifyAdminChanges"));
		$this->notifyAdmins 		= ($this->getValueFromDB("editForm", "notifyAdmins"));
		$this->emailOnAppr 			= ($this->getValueFromDB("editForm", "emailOnAppr"));
		$this->mailFeesAdm 			= ($this->getValueFromDB("payment", "mailFeesAdm"));
		$this->notifyAuthorRenew 	= ($this->getValueFromDB("editForm", "emailOnRenew"));
		$this->notifyAdminRenew 	= ($this->getValueFromDB("editForm", "emailOnRenewAdm"));
    	/*
    	 * emails for admin
    	 */
    	$this->AdmEmailOnSubmitText 	=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_submit_text"));
    	$this->AdmEmailOnSubmitTitle 	=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_submit_title"));
    	$this->AdmEmailOnUpdateText 	=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_update_text"));
    	$this->AdmEmailOnUpdateTitle 	=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_update_title"));
    	$this->AdmEmailPaymentsText 	=  $this->getSobiStr($this->getValueFromDB("payment", "email_payments_text"));
    	$this->AdmEmailPaymentsTitle 	=  $this->getSobiStr($this->getValueFromDB("payment", "email_payments_title"));
    	$this->AdmEmailOnRenewText 		=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_renew_text"));
    	$this->AdmEmailOnRenewTitle		=  $this->getSobiStr($this->getValueFromDB("editForm", "email_on_renew_title"));
    	/*
    	 * emails for user
    	 */
    	$this->UserEmailOnApproveText 	= $this->getSobiStr($this->getLangValue("email_on_approve_text","description", $lang));
    	$this->UserEmailOnApproveTitle 	= $this->getSobiStr($this->getLangValue("email_on_approve_title","description", $lang));
    	$this->UserEmailOnSubmitText 	= $this->getSobiStr($this->getLangValue("email_on_submit_text","description", $lang));
    	$this->UserEmailOnSubmitTitle 	= $this->getSobiStr($this->getLangValue("email_on_submit_title","description", $lang));
    	$this->UserEmailOnUpdateText 	= $this->getSobiStr($this->getLangValue("email_on_update_text","description", $lang));
    	$this->UserEmailOnUpdateTitle 	= $this->getSobiStr($this->getLangValue("email_on_update_title","description", $lang));
    	$this->UserEmailPaymentsText 	= $this->getSobiStr($this->getLangValue("email_payments_text","description", $lang));
    	$this->UserEmailPaymentsTitle 	= $this->getSobiStr($this->getLangValue("email_payments_title","description", $lang));
    	$this->UserEmailOnRenewText 	= $this->getSobiStr($this->getLangValue("email_on_renew_text","description", $lang));
    	$this->UserEmailOnRenewTitle 	= $this->getSobiStr($this->getLangValue("email_on_renew_title","description", $lang));
		/*
		 * if not editing
		 */
		if( $remark ) {
	    	$this->AdmEmailOnSubmitText 	= $this->stringDecode($this->AdmEmailOnSubmitText);
	    	$this->AdmEmailOnSubmitTitle 	= $this->stringDecode($this->AdmEmailOnSubmitTitle);
	    	$this->AdmEmailOnUpdateText 	= $this->stringDecode($this->AdmEmailOnUpdateText);
	    	$this->AdmEmailPaymentsText 	= $this->stringDecode($this->AdmEmailPaymentsText);
	    	$this->AdmEmailPaymentsTitle 	= $this->stringDecode($this->AdmEmailPaymentsTitle);
	    	$this->AdmEmailOnRenewText 		= $this->stringDecode($this->AdmEmailOnRenewText);
	    	$this->AdmEmailOnRenewTitle 	= $this->stringDecode($this->AdmEmailOnRenewTitle);
	    	$this->UserEmailOnApproveText 	= $this->stringDecode($this->UserEmailOnApproveText);
	    	$this->UserEmailOnApproveTitle 	= $this->stringDecode($this->UserEmailOnApproveTitle);
	    	$this->UserEmailOnSubmitText 	= $this->stringDecode($this->UserEmailOnSubmitText);
	    	$this->UserEmailOnSubmitTitle 	= $this->stringDecode($this->UserEmailOnSubmitTitle);
	    	$this->UserEmailOnUpdateText 	= $this->stringDecode($this->UserEmailOnUpdateText);
	    	$this->UserEmailOnUpdateTitle 	= $this->stringDecode($this->UserEmailOnUpdateTitle);
	    	$this->UserEmailPaymentsText 	= $this->stringDecode($this->UserEmailPaymentsText);
	    	$this->UserEmailPaymentsTitle 	= $this->stringDecode($this->UserEmailPaymentsTitle);
	    	$this->UserEmailOnRenewText 	= $this->stringDecode($this->UserEmailOnRenewText);
	    	$this->UserEmailOnRenewTitle 	= $this->stringDecode($this->UserEmailOnRenewTitle);

	    	$this->AdmEmailOnSubmitText 	= $this->replaceMarkers( $this->AdmEmailOnSubmitText );
			$this->AdmEmailOnSubmitTitle 	= $this->replaceMarkers( $this->AdmEmailOnSubmitTitle );

	    	$this->UserEmailOnSubmitText 	= $this->replaceMarkers( $this->UserEmailOnSubmitText );
	    	$this->UserEmailOnSubmitTitle 	= $this->replaceMarkers( $this->UserEmailOnSubmitTitle );

	    	$this->AdmEmailOnUpdateText 	= $this->replaceMarkers( $this->AdmEmailOnUpdateText );
			$this->AdmEmailOnUpdateTitle 	= $this->replaceMarkers( $this->AdmEmailOnUpdateTitle );

	    	$this->AdmEmailOnRenewText 		= $this->replaceMarkers( $this->AdmEmailOnRenewText );
			$this->AdmEmailOnRenewTitle 	= $this->replaceMarkers( $this->AdmEmailOnRenewTitle );

			$this->AdmEmailPaymentsText 	= $this->replaceMarkers( $this->AdmEmailPaymentsText );
	    	$this->AdmEmailPaymentsTitle 	= $this->replaceMarkers( $this->AdmEmailPaymentsTitle );

	    	$this->UserEmailPaymentsText 	= $this->replaceMarkers( $this->UserEmailPaymentsText );
	    	$this->UserEmailPaymentsTitle 	= $this->replaceMarkers( $this->UserEmailPaymentsTitle );

	    	$this->UserEmailOnApproveText 	= $this->replaceMarkers( $this->UserEmailOnApproveText );
	    	$this->UserEmailOnApproveTitle 	= $this->replaceMarkers( $this->UserEmailOnApproveTitle );

	    	$this->UserEmailOnUpdateText 	= $this->replaceMarkers( $this->UserEmailOnUpdateText );
	    	$this->UserEmailOnUpdateTitle 	= $this->replaceMarkers( $this->UserEmailOnUpdateTitle );

	    	$this->UserEmailOnRenewText 	= $this->replaceMarkers( $this->UserEmailOnRenewText );
	    	$this->UserEmailOnRenewTitle 	= $this->replaceMarkers( $this->UserEmailOnRenewTitle );

		}
    }
    /**
     * Replacing general placeholders
     *
     * @param string $string - string to replace
     * @return string $string
     */
    function replaceMarkers( $string )
    {
    	$string = str_replace("{sobi}", $this->componentName, $string);
    	$string = str_replace("{sitename}", $this->sitename, $string);
    	if( !defined( '_SOBI2_ADMIN' ) && is_object( $this->user ) ) {
    		$string = str_replace("{user}", $this->user->username, $string);
    	}
    	$string = str_replace("{expiration_time}",$this->entryExpirationTime, $string);
    	return $string;
    }
    /**
     * encoding email subject to 7-Bit ASCII
     *
     * @param string $str
     * @return string
     */
    function makeSubject( $str )
    {
		if( $this->key( "string", "mail_subject_base64", true ) ) {
	    	$iso = defined("_ISO") ? explode( '=', _ISO ) : array( null, "UTF-8");
			$str = base64_encode( $str );
	    	$str = "=?{$iso[1]}?B?{$str}=?=";
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
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::getLanguages( $sbox , $selected, $js, $name);
    }
    /**
     * Enter description here...
     *
     * @param array $arr named array
     * @param string $name key to search for
     * @param mixed $def default value
     * @param int $mask
     * @return mixed
     */
    function request( &$arr, $name, $def = null, $mask = 0 )
    {
    	if( defined( "_JEXEC" ) && class_exists( "JRequest" ) ) {
    		if( $arr === $_REQUEST ) {
    			$array = 'default';
    		}
    		elseif( $arr === $_POST ) {
    			$array = 'POST';
    		}
    		elseif( $arr === $_GET ) {
    			$array = 'GET';
    		}
    		elseif( $arr === $_COOKIE ) {
    			$array = 'COOKIE';
    		}
    		elseif( $arr === $_SERVER ) {
    			$array = 'SERVER';
    		}
    		elseif( $arr === $_FILES ) {
    			$array = 'FILES';
    		}
    		elseif( $arr === $_ENV ) {
    			$array = 'ENV';
    		}
    		return JRequest::getVar( $name, $def, $array, 'none', $mask );
    	}
    	else {
    		return mosGetParam( $arr, $name, $def, $mask );
    	}
    }    /**
     * @param string $url
     * @return string
     */
    function sef( $url )
    {
    	$config =& sobi2Config::getInstance();
    	if( $config->key( "frontpage", "sef_on", true ) ) {
    		if( class_exists( 'JURI' ) ) {
				$url = str_replace( '&amp;', '&', $url );
				$uri    = JURI::getInstance();
				$prefix = $uri->toString( array( 'scheme', 'host', 'port' ) );
				return $prefix.JRoute::_( $url );
    		}
    		else {
    			return sefRelToAbs( $url );
    		}
    	}
    	else {
    		return $this->liveSite."/".$url;
    	}
    }
    /**
     * @param string $url
     * @param string $msg
     */
    function redirect( $url, $msg = null )
    {
		if( defined( '_JEXEC' ) && class_exists( 'JFactory' ) ) {
			$msg = strip_tags( $msg );
			$url = str_replace( "&amp;", "&", $url );
			$m = JFactory::getApplication( 'site' );
			$m->redirect( $url, $msg );
		}
    	sobi2Config::import("includes|phpInputFilter|class.inputfilter", "root");
    	$iFilter = new InputFilter();
		$url = $iFilter->process( $url );
		if ( $iFilter->badAttributeValue( array( 'href', $url ) ) ) {
			$url = "index.php";
		}
		else {
			if ( !empty( $msg ) ) {
				$msg = $iFilter->process( $msg );
			}
			if ( trim( $msg ) ) {
			 	if ( strpos( $url, '?' ) ) {
					$url .= '&mosmsg=' . urlencode( $msg );
				}
				else {
					$url .= '?mosmsg=' . urlencode( $msg );
				}
			}
		}
		if ( headers_sent() ) {
			echo "<script>document.location.href='{$url}';</script>\n";
		}
		else {
			@ob_end_clean(); // clear output buffer
			header( 'HTTP/1.1 301 Moved Permanently' );
			header( "Location: ". $url );
		}
		exit();
    }
    /**
     * getting language depends values
     *
     * @param string $key - config key to get
     * @param string $value - field to get (configKey or description for lang keys)
     * @param string $lang - language for this key
     * @return string
     */
    function getLangValue($key,$value,$lang = null)
    {
    	if(!$lang) {
    		$lang = $this->sobi2Language;
    	}
    	static $langValues = array();
    	static $loaded = false;
    	if( !$loaded ) {
	    	$query = "SELECT * FROM `#__sobi2_language` ORDER BY `sobi2Lang`" ;
	    	$this->database->setQuery( $query );
	    	$v = $this->database->loadObjectList();
			if ($this->database->getErrorNum()) {
				trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
			}
			if( !empty( $v ) ) {
				foreach( $v as $k ) {
					$langValues[$k->sobi2Lang][$k->langKey] = array(
														"langValue" => $k->langValue,
														"description" => $k->description,
														"sobi2Section" => $k->sobi2Section,
														"fieldid" => $k->fieldid
													   );
				}
			}
			$loaded = true;
    	}
    	$curLangValues =& $langValues[$lang];
    	if( isset( $curLangValues[$key] ) && $curLangValues[$key] ) {
    		$return = $curLangValues[$key][$value];
    	}
    	else {
	    	if(!$return = $this->sobiCache->get("{$lang}_{$key}","labels")) {
		    	$query = "SELECT `{$value}` FROM `#__sobi2_language` " .
		    			 "WHERE (`langKey` = '{$key}' AND `sobi2Lang` = '{$lang}')";
		    	$this->database->setQuery( $query );
		    	$return  = $this->database->loadResult();
				if ($this->database->getErrorNum()) {
					trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
				}
				else if(!$return) {
			    	$query = "SELECT `{$value}` FROM `#__sobi2_language` " .
			    			 "WHERE (`langKey` = '{$key}' AND `sobi2Lang` = 'english')";
			    	$this->database->setQuery( $query );
			    	$return  = $this->database->loadResult();
					if ($this->database->getErrorNum()) {
						trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
					}
				}
				$this->sobiCache->add("{$lang}_{$key}",$return,"labels");
	    	}
    	}
		return $return;
    }
    /**
     * This function getting values from Databes for configuration keys
     *
     * @param string $sobi2Section
     * @param string $configKey
     * @return string
     */
    function getValueFromDB($sobi2Section, $configKey)
    {
    	if(!isset($this->configValues[$configKey])) {
	    	$query = "SELECT `configValue` FROM `#__sobi2_config` " .
	    			 "WHERE (`configKey` = '{$configKey}' " .
	    			 "AND `sobi2Section` = '{$sobi2Section}')";
	    	$this->database->setQuery( $query );
	    	$return  = $this->database->loadResult();
			if ($this->database->getErrorNum()) {
				trigger_error("DB reports: ".$this->database->stderr(), E_USER_WARNING);
			}
			else
				return $return;
    	}
    	else {
    		return $this->configValues[$configKey];
    	}
    }
    /**
     * lists all existing fields
     *
     * @param string $selected
     * @param string $name
     * @return sobiHTML::selectList
     */
    function getExistingFieldsList($selected, $name = 'field')
    {
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::getExistingFieldsList($selected, $name );
    }
	/**
	 * getting latitude and longitude for google maps
	 *
	 * @param integer $sobiId - id of sobi entry
	 * @return array
	 */
	function getGeoPosition($sobiId)
	{
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::getGeoPosition($sobiId);
	}
    /**
     * getting null date for database
     *
     * @return string
     */
    function getNullDate() {
		/*
		 * fix for mambo (by Websmurf)
		 */
		if(function_exists("database::getNullDate")){
		    $nullDate = $this->database->getNullDate();
		 }
		 else {
		    $nullDate = "0000-00-00 00:00:00";
		 }
		 return $nullDate;
    }
	/**
	 * Function to check if a Header Tag ($headTag) has already been output in the HTML Header and if not, output it.
	 *
	 * @param string $headTag
	 * @return bool
	 */
	function forceAddCustomHeadTags( $headTag )
	{
		/* Save the existing output buffer */
		$buf = ob_get_contents();
		$buf = trim( $buf );
		if( !strstr( $buf, "<head>" ) ) {
			return false;
		}
	   	if ( !empty( $buf ) && !headers_sent() ) {
			/* Clean (erase) the output buffer */
			ob_clean();
			/* 'i' for case-insensitive search */
        	$strMatch = '/<\/head>/i';
         	$strReplace = $headTag."</head>";
         	/* find and replace the first string match only */
         	if( !( $buf = preg_replace( $strMatch, $strReplace, $buf, 1 ) ) ) {
         		echo $buf;
         		return false;
         	}
         	if( !strstr( $buf, $headTag ) ) {
         		echo $buf;
         		return false;
         	}
         	/* Output the updated output buffer */
         	echo $buf;
         	return true;
	   }
	   return false;
	}
    /**
     * returning mos date or mos date + number of days
     *
     * @param integer $days
     * @return datetime
     */
    function getTimeAndDate( $days = null )
    {
    	if( $days ) {
    		return date( 'Y-m-d H:i:s', time() + ( $days * 24 * 60 * 60 ) + ( $this->getOffset() * 60 * 60 ) );
    	}
    	else {
    		return date( 'Y-m-d H:i:s', time() + $this->getOffset() * 60 * 60  );
    	}
    }
    /**
     * not used anymore.
     *
     * @param string $string
     * @return string
     */
    function cleanString( $string )
    {
    	sobi2Config::import("includes|string.class");
    	return sobi2String::cleanString( $string );
    }
    /**
     * overloading
     * @return void
     */
    function loadOverlib()
    {
    	$no_html = sobi2Config::request( $_REQUEST, "no_html", 0, 2 );
		if( $no_html ) {
			return false;
		}
    	static $loaded = false;
    	$legacy = false;
   		$config =& sobi2Config::getInstance();
    	if(!$loaded) {
			if( defined( "_JEXEC" )  && class_exists( "JHTML" ) ) {
				if( defined( "_SOBI2_ADMIN" ) ) {
					if( $config->key( "compat", "use_j10_tooltip_be" ) ) {
						$legacy = true;
					}
				}
				else {
					if( $config->key( "compat", "use_j10_tooltip_fe" ) ) {
						$legacy = true;
					}
				}
			}
			else {
				$legacy = true;
			}
			if( $legacy ) {
	    		$b = "\n<script language=\"javascript\" type=\"text/javascript\" src=\"{$config->liveSite}/includes/js/overlib_mini.js\"></script>";
				$b .= "\n<script language=\"javascript\" type=\"text/javascript\" src=\"{$config->liveSite}/includes/js/overlib_hideform_mini.js\"></script>\n";
	    		$config->addCustomHeadTag( $b );
			}
			else {
				JHTML::_('behavior.tooltip');
			}
    		$loaded = true;
    	}
    }
	function loadCalendar( $format = null, $theme = null )
	{
		static $loaded = false;
    	if( !$loaded ) {
			if( !$theme ) {
				$theme = $this->key( "calendar", "theme", "system" );
			}
			if( !( sobi2Config::translatePath( "includes|js|jscalendar|calendar-{$theme}", "front", true, ".css" ) ) ) {
				$theme = "system";
			}
			if( !$format ) {
				$format = $this->key( "calendar", "date_format", _SOBI2_CALENDAR_FORMAT  );
			}
			$formatTxt = $this->key( "calendar", "date_format_txt", "D, M d" );
			$lang = $this->key( "calendar", "language", _SOBI2_CALENDAR_LANG );
			if( !( sobi2Config::translatePath( "includes|js|jscalendar|lang|calendar-{$lang}", "front", true, ".js" ) ) ) {
				$lang = "en";
			}
    		$this->addCustomHeadTag("<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$this->liveSite}/components/com_sobi2/includes/js/jscalendar/calendar-{$theme}.css\"/>");
    		$this->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$this->liveSite}/components/com_sobi2/includes/js/jscalendar/calendar.js\"></script>");
    		$this->addCustomScript(
    		'
    		function showSobiCalendar( id, bid, format )
				{
					if( !format ) {
						format = "'.$format.'";
					}
					var el = document.getElementById( id );
					if ( calendar != null ) {
						calendar.hide();
						calendar.parseDate( el.value );
					} else {
						var cal = new Calendar( true, null, SobiSelectedDate, SobiCloseCal );
						calendar = cal;
						SobiCal = cal;
						cal.setRange( 1900, 2090 );
						calendar.create();
					}
					calendar.setDateFormat( format );
					calendar.setTtDateFormat( "'.$formatTxt.'" )
					calendar.parseDate( el.value );
					calendar.sel = el;
					calendar.showAtElement( document.getElementById( bid ) );
					return false;
				}
				function SobiCloseCal( c ) {
					c.hide();
				}
				function SobiSelectedDate( c, d ) {
					c.sel.value = d;
				}
    		'
    		);
    		$this->addCustomHeadTag("<script type=\"text/javascript\" src=\"{$this->liveSite}/components/com_sobi2/includes/js/jscalendar/lang/calendar-{$lang}.js\"></script>");
    		$loaded = true;
    	}
	}
    /**
     * not used anymore.
     *
     * @param string $string
     * @return string
     */
    function escapeSpacialHTML( $string )
    {
		$trans = get_html_translation_table(ENT_QUOTES);
		return strtr($string, $trans);
    }
    /**
     * transforming string to use it with javaScript
     *
     * @param string $str
     * @return string
     */
    function jsAddSlashes( $str )
    {
    	sobi2Config::import("includes|string.class");
    	return sobi2String::jsAddSlashes( $str );
	}
	/**
	 * adding  "http://" to url's if not added
	 *
	 * @param string $entry
	 * @return string
	 */
	function checkHTTP( $entry )
	{
    	sobi2Config::import("includes|helper.class");
    	return sobi2Helper::checkHTTP( $entry ) ;
	}
	/**
	 * MySQL injections filter
	 *
	 * @param string $string - string to clean
	 * @return string
	 */
	function clearSQLinjection($string)
	{
		if(!$string) {
			return null;
		}
		$iso = explode( '=', _ISO );
		if( !strstr( strtoupper( $iso[1]), 'UTF' ) ) {
			$string = htmlentities($string);
		}
		$string = addslashes($string);
		$string = $this->database->getEscaped($string);
		return $string;
	}
	/**
	 * reversing MySQL injection filter
	 *
	 * @param string $string - string to decode
	 * @return string
	 */
	function getSobiStr( $string )
	{
		if( $string ) {
			$iso = defined("_ISO") ? explode( '=', _ISO ) : array( null, "UTF-8");
			if( strtoupper($iso[1]) != "UTF-8" ) {
				$string = stripcslashes( stripslashes( stripslashes( html_entity_decode( $string ) ) ) );
			}
			else {
				$string = stripcslashes( stripslashes( stripslashes( $string ) ) );
			}
			if( !strstr( "<script", $string  ) ) {
				$string = str_replace( "& ", "&amp; ", $string );
			}
		}
		while ( strstr( $string, "\'" ) ) {
			$string = stripcslashes( $string );
		}
		return  $string;
	}
	/**
	 * global definied currency format
	 *
	 * @param float $value
	 * @param boolean $withCurrency - value to transform to curency format
	 * @return string
	 */
	function getCurrencyFormat($value, $withCurrency = true)
	{
		$string = number_format($value, 2, $this->curencyDecSeparator, ' ');
		if($withCurrency) {
			$string = str_replace( array( "%value%", "%currency%" ), array( $string, $this->currency ), $this->key( "string", "currency_format", "%value% %currency%") );
		}
		return $string;
	}
	/**
	 * checking if the category has child categories
	 *
	 * @param integer $catid - category id to check
	 * @return boolean
	 */
	function catHasChild($catid)
	{
		$hasChild = $this->sobiCache->get("countChilds_{$catid}","cats_childs");
		if(!$hasChild) {
			$query = "SELECT COUNT(`catid`) FROM `#__sobi2_cats_relations` WHERE `parentid` = '{$catid}'";
			$this->database->setQuery( $query );
			$hasChild = $this->database->loadResult();
			$this->sobiCache->add("countChilds_{$catid}", $hasChild ,"cats_childs");
		}
		if($hasChild && $hasChild != -100) {
			return true;
		}
		else {
			return false;
		}
	}
	/**
	* @param path The starting file or directory (no trailing slash)
	* @return TRUE=all succeeded FALSE=one or more chmods failed
	*/
	function sobiChmodRecursive( $path )
	{
		return sobi2Config::chmodRecursive( $path, $this->fmod, $this->dmod );
	}
	/**
	* Orginal mosMakePath joomla function. Creating directory
	* @param string - An existing base path
	* @param string - A path to create from the base path
	* @global integer - Directory permissions
	* @return boolean - True if successful
	*/
	function sobiMakePath($base, $path=null, $mode = NULL)
	{
    	sobi2Config::import("includes|fsystem.class");
    	return sobi2Fsystem::makePath( $this, $base, $path, $mode );
	}
	function loadBridge()
	{
    	static $loaded = false;
    	if( $loaded ) {
    		return $loaded;
    	}
		$file = ( defined( '_JEXEC' ) && class_exists( 'JRequest' ) && !$this->forceLegacy ) ? 'j15' : 'j10';
    	sobi2Config::import( "includes|bridge|{$file}" );
    	$loaded = true;
	}
	/**
	 * to revert UTF-8 encoding (ajax)
	 *
	 * @param string $string
	 * @return string
	 */
	function stringDecode( $string )
	{
		$iso = defined( "_ISO" ) ? explode( '=', _ISO ) : array( null, "UTF-8" );
		if(strtoupper( $iso[1] ) == 'UTF-8') {
			return $string;
		}
		if( $this->key( "string", "mb_convert_encoding", true ) && function_exists( "mb_convert_encoding" ) ) {
			$string = mb_convert_encoding( $string, $iso[1], "UTF-8" );
		}
		elseif( $this->key( "string", "iconv", true ) && function_exists( "iconv" ) ) {
			$string = iconv("UTF-8",$iso[1], $string);
		}
		else {
			switch($iso[1]) {
				default:
				case 'iso-8859-1':
					$string = utf8_decode($string);
					break;
				case 'iso-8859-2':
					$string = $this->utf82iso88592($string);
					break;
				case 'UTF-8':
					break;
			}
		}
		return $string;
	}
	/**
	 * to save in UTF-8 encoding (ajax)
	 *
	 * @param string $string
	 * @return string
	 */
	function stringEncode($string)
	{
		$iso = defined("_ISO") ? explode( '=', _ISO ) : array( null, "UTF-8");
		if(strtoupper($iso[1]) == 'UTF-8') {
			return $string;
		}
		if( $this->key( "string", "mb_convert_encoding", true ) && function_exists( "mb_convert_encoding" ) ) {
			$string = mb_convert_encoding( $string, "UTF-8", $iso[1] );
		}
		if ( $this->key( "string", "iconv", true ) && function_exists( "iconv" ) ) {
			$string = iconv($iso[1],"UTF-8",$string);
		}
		else {
			switch($iso[1]) {
				default:
				case 'iso-8859-1':
					$string = utf8_encode($string);
					break;
				case 'iso-8859-2':
					$string = $this->iso885922utf8($string);
					break;
				case 'UTF-8':
					break;
			}
		}
		return $string;
	}
	/**
	 * Enter description here...
	 *
	 * @return array
	 */
	function translateUserAgent()
	{
		static $browser;
		if(is_array($browser) && !empty($browser)) {
			return $browser;
		}
    	sobi2Config::import("includes|helper.class");
		$browser = array();
		$browser = sobi2Helper::getBrowser( sobi2Config::request($_SERVER, "HTTP_USER_AGENT", 0, 0x0004) );
		$os = sobi2Helper::getOs( sobi2Config::request($_SERVER, "HTTP_USER_AGENT", 0, 0x0004) );
		$browser["os"] = $os["name"];
		$browser["os_ver"] = $os["ver"];
		return $browser;
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
    	sobi2Config::import("includes|fsystem.class");
    	return sobi2Fsystem::checkPNGImage( $icon, $alt, $style, $class, $title );
	}
	/**
	 * Enter description here...
	 *
	 * @param string $str
	 * @return string
	 */
	function replaceEntities( $str )
	{
//		if(!$str || empty($str)) {
//			return null;
//		}
//		$iso = explode( '=', _ISO );
//		if(strtoupper($iso[1]) != "UTF-8") {
//			$str = html_entity_decode($str);
//		}
		return $str;
	}
	/**
	 * janusz@poczta.fm 25-Oct-2003 05:54
	 * Here are functions to PROPERLY de/encode Unicode (UTF-8) string to ISO-8859-2 (Polish character set).
	 * Regards, Janusz
	 * @param string $tekscik
	 * @return string
	 */
	function utf82iso88592( $tekscik )
	{
    	sobi2Config::import("includes|string.class");
    	return sobi2String::utf82iso88592( $tekscik );
	}
	/**
	 * janusz@poczta.fm 25-Oct-2003 05:54
	 * Here are functions to PROPERLY de/encode Unicode (UTF-8) string to ISO-8859-2 (Polish character set).
	 * Regards, Janusz
	 * @param string $tekscik
	 * @return string
	 */
	function iso885922utf8( $tekscik )
	{
    	sobi2Config::import("includes|string.class");
    	return sobi2String::iso885922utf8( $tekscik );
	}
	/**
	 * function for send emails
	 *
	 * @param string $subject
	 * @param string $massage
	 * @param string $addresse
	 * @param boolean $forAdmin
	 * @param string $fromMail
	 * @param string $fromName
	 * @param integer $sobiId
	 * @param bool $html
	 * @param string $cc
	 * @param string $bcc
	 * @param string $replyTo
	 * @param string $replyToName
	 */
	function sendSobiMail($subject, $massage, $addresse = null, $forAdmin = false, $fromMail = null, $fromName = null, $sobiId = 0, $html = 0, $cc = null, $bcc = null, $replyTo = null, $replyToName = null )
	{
    	sobi2Config::import("includes|mail.class");
    	return sobi2Mail::send( $subject, $massage, $addresse, $forAdmin, $fromMail, $fromName, $sobiId, $html, $cc, $bcc, $replyTo, $replyToName );
	}
	/**
	 * @param string $path
	 * @param int $fmode
	 * @param int $dmode
	 */
	function chmodRecursive ( $path, $fmode = null, $dmode = null, $force = false )
	{
    	sobi2Config::import("includes|fsystem.class");
    	return sobi2Fsystem::chmodRecursive ( $path, $fmode, $dmode, $force );
	}
    /**
     * write errors to log file
     *
     * @param string $msg
     */
    function logSobiError( $msg )
    {
		if($this->debug == -1 || !(strstr( $msg, "com_sobi2")) || strstr($msg, "session")) {
			return null;
		}
		@sobi2Config::chmodRecursive(_SOBI_CMSROOT.DS."administrator".DS."components".DS."com_sobi2".DS."error_logfile.txt",0777,0777);
    	if(!$log = @fopen(_SOBI_CMSROOT.DS."administrator".DS."components".DS."com_sobi2".DS."error_logfile.txt","a+")) {
    		return null;
    	}
		$now = $this->getTimeAndDate();

		if(isset($_SERVER["REMOTE_ADDR"])) {
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		else {
			$ip = "none";
		}
		if(isset($_SERVER["HTTP_REFERER"])) {
			$ref = $_SERVER["HTTP_REFERER"];
		}
		else {
			$ref = "none";
		}
		if(isset($_SERVER["HTTP_USER_AGENT"])) {
			$browser = $_SERVER["HTTP_USER_AGENT"];
		}
		else {
			$browser = "none";
		}
		if(isset($_SERVER["REQUEST_URI"])) {
			$requestet = $_SERVER["REQUEST_URI"];
		}
		else {
			$requestet = "none";
		}
		$msg = str_replace( "\n", " <br/> ", $msg );
		$logMsg = "{$now}: \n" .
				"\t IP: {$ip} \n" .
				"\t Requestet URI: {$requestet} \n" .
				"\t Refferer: {$ref} \n" .
				"\t Browser: {$browser}\n" .
				"\t Error: {$msg} \n" .
				"---------------------------------------------------------\n";
		fwrite($log, $logMsg);
		fclose($log);
		@sobi2Config::chmodRecursive( _SOBI_CMSROOT.DS."administrator".DS."components".DS."com_sobi2".DS."error_logfile.txt",0664,0775 );
    }
    /**
     * Clear and remove a directory recursive
     *
     * @param string $dir
     */
    function removeDirRecursive( $dir )
    {
    	sobi2Config::import("includes|fsystem.class");
    	return sobi2Fsystem::removeDirRecursive( $dir );
    }
    /**
     * @param string $str
     */
    function debOut( $str, $out = false )
    {
    	if( !$str ) {
    		$str = "Empty";
    	}
    	if( $out ) {
    		echo "<!--";
    	}
    	else {
    		echo "<h4>";
    	}
    	if( is_array( $str ) ) {
    		print_r( $str );
    	}
    	else {
    		echo $str;
    	}
    	if( $out ) {
    		echo "-->";
    	}
		else {
			echo "</h4>";
		}
    }
}
if(!function_exists("overideErrorHandling")) {
/**
 * @param integer $errno
 * @param string $msg
 * @param string $file
 * @param string $line
 * @param array $context
 */
	function overideErrorHandling($errno, $msg, $file, $line, $context)
	{
		/* if critical section do nothing */
		if( isset( $GLOBALS['sobi2_config_construct_cs'] ) && $GLOBALS['sobi2_config_construct_cs'] == true ) {
			return false;
		}
		if( !stristr( $file,"com_sobi2") || strstr( $file, "session" ) || strstr( $msg, "ob_end_clean" ) ) {
			return null;
		}
		$config =& sobi2Config::getInstance();
    	if( $errno != 2048 ) {
			if( $config->debug > 100 ) {
				$debugLevel = $config->debug - 100;
			}
			else {
				$debugLevel = $config->debug;
			}
			if( $debugLevel == 9 ||
				( $debugLevel == 8 && ( $errno < 8 || $errno == 512 || $errno == 256 ) ) ||
				( $debugLevel == 7 && $errno == 256 ) )
			{
	    			$config->logSobiError("{$msg} (Error number:{$errno}) in file: {$file} at the line: {$line}.");
			}
    	}
	}
}
if( !function_exists( 'sobi2trim' ) ) {
	 /**
	  * @param array $v
	  */
	 function sobi2trim( &$v )
	 {
	 	$v = trim( $v );
	 }
}
?>