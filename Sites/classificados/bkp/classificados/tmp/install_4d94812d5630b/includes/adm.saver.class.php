<?php
/**
* @version $Id: adm.saver.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

class sobi2Saver {
    function saveMailOnPaymentAdmin( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'mailFeesAdm', 1 ) ),'mailFeesAdm' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailPaymentsText', $config->AdmEmailPaymentsText ) ),'email_payments_text' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailPaymentsTitle', $config->AdmEmailPaymentsTitle ) ), 'email_payments_title' );
    }
    function saveMailOnUpdatetAdmin( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAdminChanges', 1 ) ), 'notifyAdminChanges' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnUpdateText', $config->AdmEmailOnUpdateText ) ), 'email_on_update_text' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnUpdateTitle', $config->AdmEmailOnUpdateTitle ) ), 'email_on_update_title' );
    }
    function saveMailOnRenewAdmin( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAdminRenew', 1 ) ), 'emailOnRenewAdm' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnRenewText', $config->AdmEmailOnRenewText ) ), 'email_on_renew_text' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnRenewTitle', $config->AdmEmailOnRenewTitle ) ), 'email_on_renew_title' );
    }

    function saveMailOnSubmitAdmin( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAdmins' , 1 ) ),'notifyAdmins' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnSubmitText', $config->AdmEmailOnSubmitText ) ), 'email_on_submit_text' );
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'AdmEmailOnSubmitTitle', $config->AdmEmailOnSubmitTitle ) ), 'email_on_submit_title' );
    }
    function saveMailOnPayment( &$config )
    {
    	$config->setLangValue( 'description', 'email_payments_text', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailPaymentsText', $config->UserEmailPaymentsText ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    	$config->setLangValue( 'description', 'email_payments_title', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailPaymentsTitle', $config->UserEmailPaymentsTitle ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    }
    function saveMailOnApprove( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'emailOnAppr' ) ), 'emailOnAppr' );
    	$config->setLangValue( 'description', 'email_on_approve_text', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnApproveText', $config->UserEmailOnApproveText ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    	$config->setLangValue( 'description', 'email_on_approve_title', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnApproveTitle', $config->UserEmailOnApproveTitle ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    }
    function saveMailOnUpdateUser( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAuthorChanges' ) ),'notifyAuthorChanges' );
    	$config->setLangValue( 'description','email_on_update_text', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnUpdateText', $config->UserEmailOnUpdateText ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    	$config->setLangValue( 'description','email_on_update_title', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnUpdateTitle', $config->UserEmailOnUpdateTitle ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    }
    function saveMailOnRenewUser( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAuthorRenew' ) ),'emailOnRenew' );
    	$config->setLangValue( 'description', 'email_on_renew_text', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnRenewText', $config->UserEmailOnRenewText ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    	$config->setLangValue( 'description', 'email_on_renew_title', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnRenewTitle',$config->UserEmailOnRenewTitle ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    }
    function saveUserEmailOnSubmit( &$config )
    {
    	$config->setValueInDB( intval( sobi2Config::request( $_REQUEST, 'notifyAuthorNew' ) ),'notifyAuthorNew' );
    	$config->setLangValue( 'description', 'email_on_submit_text', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnSubmitText', $config->UserEmailOnSubmitText ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    	$config->setLangValue( 'description', 'email_on_submit_title', $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'UserEmailOnSubmitTitle', $config->UserEmailOnSubmitTitle ) ), sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language ) );
    }
    function saveMailFooter( &$config )
    {
    	$config->setValueInDB( $config->clearSQLinjection( sobi2Config::request( $_REQUEST, 'mailFooter' ) ),'mailFooter' );
    }
    function savePby( &$config )
    {
    	$config->setValueInDB(intval(sobi2Config::request( $_REQUEST, 'pby')),'pby');
    }
    function setDefTpl( &$config )
    {
    	$config->setValueInDB( strval( sobi2Config::request( $_REQUEST, 'tpl', 'default' ) ), 'defTpl' );
    	sobi2Config::redirect( 'index2.php?option=com_sobi2&task=templates' );
    }
    function setGenConf( &$config )
    {
		if( !$config->checkPerm() ) {
			$config->noPerms();
		}
		sobi2Config::import( 'category.class' );
		sobi2Config::import( 'admin.category.class', 'adm' );
		$sobi2Desc = new adminSobiCategory( 1 );
		$sobi2Desc->description = strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'componentDescription',null, 0x0002 )));
		$sobi2Desc->image = strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'image' )));
		$sobi2Desc->image_position = strval(sobi2Config::request( $_POST, 'image_position' ));
		$sobi2Desc->updateData();

		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'componentName' ))),'componentName');
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'sobi2Language' ))),'language');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showListingOnFP' )),'showListingOnFP');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'itemsInLine' )),'itemsInLine');
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'listingOrdering' )),'listingOrdering');
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'defTpl', 'default' )),'defTpl');
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'catsOrdering' )),'catsOrdering');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'lineOnSite' )),'lineOnSite');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showCatListOnFp' )),'showCatListOnFp');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'catsListInLine' )),'catsListInLine');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showCatDesc' )),'showCatDesc');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showIcoInVC' )),'showIcoInVC');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showImgInVC' )),'showImgInVC');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showEntriesFromSubcats' )),'showEntriesFromSubcats');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showComponentLink' )),'showComponentLink');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showSearchLink' )),'showSearchLink');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showAddNewLink' )),'showAddNewEntryLink');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showComponentDescription' )),'showComponentDescription');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showComponentDescription' )),'showComponentDescription');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'useMeta' )),'useMeta');
		$config->sobi2BorderColor = str_replace('#','',sobi2Config::request( $_POST, 'sobi2BorderColor' ));
		$config->setValueInDB(strval($config->sobi2BorderColor),'sobi2BorderColor');
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'backgroundimage' )),'sobi2BackgroundImg');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowUserToEditEntry' )),'allowUserToEditEntry');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowQuickEdit' )),'allowQuickEdit');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowUserDelete' )),'allowUserDelete');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showCatItemsCount' )),'showCatItemsCount');
		$config->debug = sobi2Config::request( $_POST, 'debug', $config->debug );
		$config->debugTmpl = sobi2Config::request( $_POST, 'debugTmpl', $config->debugTmpl );
		$config->setValueInDB($config->debugTmpl, 'debugTmpl');
		$displayErrors = sobi2Config::request( $_POST, 'displayErrors', $config->debug > 100 ? 1 : 0 );
		if($config->debug < 100 && $displayErrors) {
			$config->debug += 100;
		}
		$config->setValueInDB($config->debug, 'debug');
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'subcatsOrdering' )),'subcatsOrdering');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'subcatsNumber' )),'subcatsNumber');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'subcatsShow' )),'subcatsShow');
		$config->cacheEnabled = intval(sobi2Config::request($_POST,'cacheEnabled', 0));
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL2Enabled' )),'cacheL2Enabled');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL2dvEnabled' )),'cacheL2dvEnabled');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL2Lifetime' )),'cacheL2Lifetime');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL2strLen' )),'cacheL2strLen');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL3Enabled' )),'cacheL3Enabled');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'cacheL3strLen' )),'cacheL3strLen');
		$config->setValueInDB($config->cacheDir,'cacheDir','cache');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'useRSSfeed', $config->useRSSfeed )),'useRSSfeed');
		$SigsiuTreeImgs = null;
		$SigsiuTreeImgs .= 'root='.sobi2Config::request( $_POST, 'atreeImgsRoot', 'components/com_sobi2/images/base.gif' ).',';
		$SigsiuTreeImgs .= 'folder='.sobi2Config::request( $_POST, 'atreeImgsFolder', 'components/com_sobi2/images/folder.gif' ).',';
		$SigsiuTreeImgs .= 'folderOpen='.sobi2Config::request( $_POST, 'atreeImgsFolderOpen', 'components/com_sobi2/images/folderopen.gif' ).',';
		$SigsiuTreeImgs .= 'join='.sobi2Config::request( $_POST, 'atreeImgsJoin', 'components/com_sobi2/images/join.gif' ).',';
		$SigsiuTreeImgs .= 'joinBottom='.sobi2Config::request( $_POST, 'atreeImgsJoinBottom', 'components/com_sobi2/images/joinbottom.gif' ).',';
		$SigsiuTreeImgs .= 'plus='.sobi2Config::request( $_POST, 'atreeImgsJoinPlus', 'components/com_sobi2/images/plus.gif' ).',';
		$SigsiuTreeImgs .= 'plusBottom='.sobi2Config::request( $_POST, 'atreeImgsJoinPlusBottom', 'components/com_sobi2/images/plusbottom.gif' ).',';
		$SigsiuTreeImgs .= 'minus='.sobi2Config::request( $_POST, 'atreeImgsJoinMinus', 'components/com_sobi2/images/minus.gif' ).',';
		$SigsiuTreeImgs .= 'minusBottom='.sobi2Config::request( $_POST, 'atreeImgsJoinMinusBottom', 'components/com_sobi2/images/minusbottom.gif' ).',';
		$SigsiuTreeImgs .= 'line='.sobi2Config::request( $_POST, 'atreeImgsLine', 'components/com_sobi2/images/line.gif' ).',';
		$SigsiuTreeImgs .= 'empty='.sobi2Config::request( $_POST, 'atreeImgsEmpty', 'components/com_sobi2/images/empty.gif' ).'';
		$config->setValueInDB($SigsiuTreeImgs,'SigsiuTreeImages');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showAlphaIndex', $config->showAlphaIndex )),'showAlphaIndex');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchUseSlider', $config->ajaxSearchUseSlider )),'ajaxSearchUseSlider');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchSlidInOnStart', $config->ajaxSearchSlidInOnStart )),'ajaxSearchSlidInOnStart');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchSlidInAfterSearch', $config->ajaxSearchSlidInAfterSearch )),'ajaxSearchSlidInAfterSearch');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchCatsForFields', $config->ajaxSearchCatsForFields )),'ajaxSearchCatsForFields');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchCatsContHeight', $config->ajaxSearchCatsContHeight )),'ajaxSearchCatsContHeight');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'ajaxSearchCatsFieldsDepend', $config->ajaxSearchCatsFieldsDepend )),'ajaxSearchCatsFieldsDepend');
		$mgids = sobi2Config::request( $_POST, 'mailAdmGid', array() );
		if(is_array($mgids) && !empty($mgids)) {
			if( in_array('29', $mgids )) {
				unset( $mgids[array_search( '29',$mgids )] );
			}
			if(in_array( '30', $mgids )) {
				unset( $mgids[array_search( '30',$mgids )] );
			}
			if(is_array($mgids) && !empty($mgids)) {
				$config->mailAdmGid = implode(',' , $mgids);
			}
		}
		$config->setValueInDB($config->mailAdmGid,'mailAdmGid');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'mailFieldId', $config->mailFieldId )),'mailFieldId');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'mailSoJ', $config->mailSoJ )),'mailSoJ');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showComponentDescInSearch', $config->showComponentDescInSearch )),'showComponentDescInSearch');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'forceMenuId', $config->forceMenuId )),'forceMenuId');
	}
    function setEfConf( &$config )
    {
		if(!$config->checkPerm()) {
			$config->noPerms();
		}
		$msg = null;
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'basicPriceLabel' ))),'basicPriceLabel');
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'efEntryTitleLabel' ))),'efEntryTitleLabel');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'efEntryTitleLength' )),'efEntryTitleLength');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowMultiTitle' )),'allowMultiTitle');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowUsingImg' )),'allowUsingImg');
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'efImgLabel',$config->efImgLabel ))),'efImgLabel');
		$config->priceForImg = str_replace(',','.',sobi2Config::request( $_POST, 'priceForImg' ));
		$config->setValueInDB(floatval($config->priceForImg),'priceForImg');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowUsingIco' )),'allowUsingIco');
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'efIcoLabel', $config->efIcoLabel ))),'efIcoLabel');
		$config->priceForIco = str_replace(',','.',sobi2Config::request( $_POST, 'priceForIco' ));
		$config->setValueInDB(floatval($config->priceForIco),'priceForIco');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'maxCatsForEntry' )),'maxCatsForEntry');
		$config->catPrices[2] = str_replace(',','.',sobi2Config::request( $_POST, 'catPrices2' ));
		$config->setValueInDB(floatval($config->catPrices[2]),'cat2price');
		$config->catPrices[3] = str_replace(',','.',sobi2Config::request( $_POST, 'catPrices3' ));
		$config->setValueInDB(floatval($config->catPrices[3]),'cat3price');
		$config->catPrices[4] = str_replace(',','.',sobi2Config::request( $_POST, 'catPrices4' ));
		$config->setValueInDB(floatval($config->catPrices[4]),'cat4price');
		$config->catPrices[5] = str_replace(',','.',sobi2Config::request( $_POST, 'catPrices5' ));
		$config->setValueInDB(floatval($config->catPrices[5]),'cat5price');
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'autopublishEntry' )),'autopublishEntry');
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'needToAcceptEntryRules' )),'needToAcceptEntryRules');
    	$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'acceptEntryRules1' ))),'acceptEntryRules1');
    	$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'entryRulesURLlabel'))),'entryRulesURLlabel');
    	$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'entryRulesURL' ))),'entryRulesURL');
    	$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'acceptEntryRules2' ))),'acceptEntryRules2');
    	$secImg = intval(sobi2Config::request( $_POST, 'useSecurityCode' ));
    	if($secImg) {
    		if(function_exists('imagejpeg') || function_exists('imagepng') || function_exists('imagegif'))
    			$config->setValueInDB('1','useSecurityCode');
    		else {
    			$config->setValueInDB('0','useSecurityCode');
    			$msg = ' '._SOBI2_CONFIG_SECIMG_USING_FAILED;
    		}
    	}
    	else
    		$config->setValueInDB('0','useSecurityCode');
    	$config->secImgFontColor = str_replace('#','',sobi2Config::request( $_POST, 'secImgFontColor' ));
    	$config->setValueInDB(strval($config->secImgFontColor),'secImgFontColor');
    	$config->secImgLineColor = str_replace('#','',sobi2Config::request( $_POST, 'secImgLineColor' ));
    	$config->setValueInDB(strval($config->secImgLineColor),'secImgLineColor');
    	$config->secImgBorderColor = str_replace('#','',sobi2Config::request( $_POST, 'secImgBorderColor' ));
    	$config->setValueInDB(strval($config->secImgBorderColor),'secImgBorderColor');
    	$config->secImgBgColor = str_replace('#','',sobi2Config::request( $_POST, 'secImgBgColor' ));
    	$config->setValueInDB(strval($config->secImgBgColor),'secImgBgColor');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'thumbWidth' , $config->thumbWidth)),'thumbWidth');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'thumbHeigth', $config->thumbHeigth )),'thumbHeigth');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imgWidth', $config->imgWidth )),'imgWidth');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imgHeigth', $config->imgHeigth )),'imgHeigth');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowAnonymous' )),'allowAnonymous');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowRenew' )),'allowRenew');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowRenewDaysForExp' )),'allowRenewDaysForExp');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'renewDiscount' )),'renewDiscount');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'renewExpirationTime' )),'renewExpirationTime');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'renewDeleteFees' )),'renewDeleteFees');

		$expTime = intval(sobi2Config::request( $_POST, 'entryExpirationTime' ));
		if($expTime == 0 || !$expTime || $expTime == null)
			$expTime = $config->nullDate;
		$config->setValueInDB($expTime,'entryExpirationTime');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'maxFileSize' ) * 1024),'maxFileSize');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowAddingToParentCats' )),'allowAddingToParentCats');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowUsingBackground' )),'allowUsingBackground');
		$config->basicPrice = str_replace(',','.',sobi2Config::request( $_POST, 'basicPrice' ));
		$config->setValueInDB(floatval($config->basicPrice),'basicPrice');
		$config->setValueInDB(sobi2Config::request( $_POST, 'allowFeEntr', 0 ),'allowFeEntr');
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imgHeigth', $config->imgHeigth )),'imgHeigth');
		return $msg;
    }
    function setViewConf( &$config )
    {
		if(!$config->checkPerm()) {
			$config->noPerms();
		}
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showIcoInDetails' )),"showIcoInDetails");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showImageInDetails' )),"showImageInDetails");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showAddedDate' )),"showAddedDate");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showHits' )),"showHits");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'useWaySearch' )),"useWaySearch");
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'waySearchUrl' )),"waySearchUrl");
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'waySearchLabel', null, 0x0002 )),"waySearchLabel");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'useGoogleMaps' )),"useGoogleMaps");
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'googleMapsApiKey' )),"googleMapsApiKey");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsBubble' )),"googleMapsBubble");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsLatField' )),"googleMapsLatField");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsLongField' )),"googleMapsLongField");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsWidth' )),"googleMapsWidth");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsHeight' )),"googleMapsHeight");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'googleMapsZoom' )),"googleMapsZoom");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowAnoDetails' )),"allowAnoDetails");
		$wsSTREET 		= (int) sobi2Config::request( $_POST, "wsSTREET", null );
		$wsZIPCODE 		= (int) sobi2Config::request( $_POST, "wsZIPCODE", null );
		$wsCITY 		= (int) sobi2Config::request( $_POST, "wsCITY", null );
		$wsCOUNTRY 		= (int) sobi2Config::request( $_POST, "wsCOUNTRY", null );
		$wsFEDSTATE 	= (int) sobi2Config::request( $_POST, "wsFEDSTATE", null );
		$wsCOUNTY		= (int) sobi2Config::request( $_POST, "wsCOUNTY", null );
		$waySearchFields = "STREET={$wsSTREET};ZIPCODE={$wsZIPCODE};CITY={$wsCITY};COUNTRY={$wsCOUNTRY};FEDSTATE={$wsFEDSTATE};COUNTY={$wsCOUNTY};";
		$config->setValueInDB( $waySearchFields, "waySearchFields" );
    }
    function setPaymentConf( &$config )
    {
		if(!$config->checkPerm()) {
			$config->noPerms();
		}
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'currency' )),"currency");
		$config->setValueInDB(strval(sobi2Config::request( $_POST, 'curencyDecSeparator' )),"curencyDecSeparator");
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'payTitle' ))),"payTitle");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'useBankTransfer' )),"useBankTransfer");
		$config->bankData = nl2br(sobi2Config::request( $_POST, 'bankData',$config->bankData, 0x0002));
		$config->setValueInDB(strval($config->clearSQLinjection($config->bankData)),"bankData");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'usePayPal' )),"usePayPal");
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'payPalMail',$config->payPalMail ))),"payPalMail");
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'payPalUrl',$config->payPalUrl ))),"payPalUrl");
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'payPalCurrency',$config->payPalCurrency ))),"payPalCurrency");
		$config->setValueInDB(strval($config->clearSQLinjection(sobi2Config::request( $_POST, 'payPalReturnUrl',$config->payPalReturnUrl ))),"payPalReturnUrl");
    }
	function saveSobi()
	{
		sobi2Config::import( "admin.sobi2.class", "adm" );
		$sobi2AdminUrl= "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', null );
		$config =& adminConfig::getInstance();
		$sobi2Id = intval( sobi2Config::request( $_REQUEST, 'sobi2Id', 0 ) );
		$catid = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
		$url = null;
		/*
		 * if updating
		 */
		if( isset( $sobi2Id ) && $sobi2Id ) {
	 		$config->getEditForm();
	 		$newSobi = new adminSobi( $sobi2Id );
	 		$m = $newSobi->updateSobi();
	 		$newSobi->checkInSobi();
		}
		else {
			$newSobi = new adminSobi();
			$r = $newSobi->saveSobi();
			$m = $r["msg"];
			$url = "index2.php?option=com_sobi2&amp;task=edit&amp;sobi2Id={$r["id"]}&amp;hidemainmenu=1&amp;{$returnTask}=listing&amp;catid={$catid}";
		}
		$config->sobiCache->clearAll();
		$task = sobi2Config::request( $_REQUEST, 'task', null );
		if( $task == "apply" ) {
			if( !$url ) {
				$url = sobi2Config::request( $_SERVER, "HTTP_REFERER", null );
			}
			sobi2Config::redirect( $url, $m );
		}
		else {
			sobi2Config::redirect( $sobi2AdminUrl."&amp;task={$returnTask}", $m );
		}
	}
	function saveCategory()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask	= sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config	=& adminConfig::getInstance();
		$msg = _SOBI2_CHANGES_SAVED;
		$categoryId = intval( sobi2Config::request( $_REQUEST, 'categoryId', 0 ) );
		$url = null;
		/*
		 * if updating
		 */
		sobi2Config::import("category.class");
		sobi2Config::import("admin.category.class", "adm");
		if( isset( $categoryId ) && $categoryId ) {
	 		$sobi2Cat = new adminSobiCategory( $categoryId );
	 		$sobi2Cat->getDataFromRequest();
	 		$msg = $sobi2Cat->updateData();
	 		$sobi2Cat->checkInCategory();
		}
		else {
	 		$sobi2Cat = new adminSobiCategory();
	 		$sobi2Cat->getDataFromRequest();
	 		$id = $sobi2Cat->saveData();
	 		$catid = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
	 		$url = "index2.php?option=com_sobi2&task=edit&categoryId={$id}&hidemainmenu=1&returnTask={$returnTask}&catid={$catid}";
		}
		$config->sobiCache->clearAll();
		$task = sobi2Config::request( $_REQUEST, 'task', null );
		if( $task == "apply" ) {
			if( !$url ) {
				$url = sobi2Config::request( $_SERVER, "HTTP_REFERER", null );
			}
			sobi2Config::redirect( $url, $msg );
		}
		else {
			sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
		}
	}
	function saveCats()
	{
		$catid	= sobi2Config::request( $_REQUEST, 'cid', 1 );
		$sobi2AdminUrl = "index2.php?option=com_sobi2&amp;catid={$catid}";
		$config	=& adminConfig::getInstance();
		$msg = _SOBI2_CHANGES_SAVED;
		sobi2Config::import("category.class");
		sobi2Config::import("admin.category.class", "adm");
		$cnames = sobi2Config::request( $_REQUEST, 'cnames', null );
		$cnames = explode(";", $cnames);
		if(is_array($cnames) && !empty($cnames)) {
			foreach ($cnames as $name) {
				unset( $introtext );
				unset( $icon );
				if(strstr($name, ":")) {
					$name = explode(":", $name);
					$introtext = $name[1];
					$icon = isset($name[2]) ? $name[2] : null;
					$name = $name[0];
				}
				if(strlen($name)) {
					$sobi2Cat = new adminSobiCategory();
					$sobi2Cat->name = trim($name);
					$sobi2Cat->parentCat = $catid;
					$sobi2Cat->introtext = isset($introtext) ? trim($introtext) : null;
					$sobi2Cat->published = 1;
					$sobi2Cat->icon = isset($icon) ? trim($icon) : null;
					$sobi2Cat->saveData();
				}
				unset($sobi2Cat);
				unset($name);
			}
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl, $msg );
	}
	function saveField( $lang )
	{
		sobi2Config::import("field.class");
		sobi2Config::import("admin.field.class", "adm");
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', null );
		$config =& adminConfig::getInstance();
		$fid = intval( sobi2Config::request( $_REQUEST, 'fieldId', 0 ) );
		$url = null;
		if(isset($fid) && $fid != 0) {
			$field = new field($fid);
			$field->getDataFromRequest();
			$msg = $field->updateField($lang);
			$field->checkInField();
		}
		else {
			$field = new field($lang);
			$field->getDataFromRequest();
			$r = $field->saveField( $lang );
			$msg = $r["msg"];
			$url = "index2.php?option=com_sobi2&slang={$lang}&task=editField&sField={$r["id"]}&hidemainmenu=1";
		}
		$config->sobiCache->clearAll();
		$task = sobi2Config::request( $_REQUEST, 'task', null );
		if( $task == "apply" ) {
			if( !$url ) {
				$url = sobi2Config::request( $_SERVER, "HTTP_REFERER", null );
			}
			sobi2Config::redirect( $url, $msg );
		}
		else {
			sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}&slang={$lang}", $msg );
		}
	}
	function saveRegistry( &$config )
	{
		$valArr = sobi2Config::request( $_REQUEST, "reg", array() );
		$iniStr = null;

		$fileAdd =  sobi2Config::translatePath("includes|inc|config", "front", true, ".ini" );
		$file = file_get_contents( $fileAdd );
		if( !strlen( $file ) ) {
			trigger_error( "cannot open config.ini file ");
			sobi2Config::redirect( "index2.php?option=com_sobi2&task=registry", "cannot open config.ini file" );
		}
		$file = explode( "\n", $file );
		foreach ( $file as $line ) {
			$line = ltrim( $line );
			if( isset( $line[0] ) && $line[0] == ";") {
				$iniStr .= "{$line}\n";
			}
			else {
				break;
			}
		}
		foreach ( $valArr as $k => $v ) {
			if( isset( $v['section'] ) ) {
				$iniStr .= "\n[{$k}]\n";
				unset( $v['section'] );
				foreach ( $v as $i ) {
					if( isset( $i['key'] ) && strlen( $i['key'] ) ) {
						if( isset( $i['enabled'] ) && $i['enabled'] ) {
							$semi = null;
						}
						else {
							$semi = ";";
						}
						$iniStr .= "{$semi}{$i['key']} = \"{$i['value']}\"\n";
					}
				}
			}
			if( isset( $v['comment'] ) ) {
				$iniStr .= "\n{$v['comment']}\n";
			}
		}
		$redirect_url =  "index2.php?option=com_sobi2&task=registry";
		if ( $fileopen = fopen ( $fileAdd, "w")) {
			fputs( $fileopen, $iniStr );
			fclose( $fileopen );
			$redirect_msg = _SOBI2_CHANGES_SAVED;
		}
		else {
			$redirect_msg = _SOBI2_REG_MANAGER_SAVE_ERR;
			trigger_error( _SOBI2_REG_MANAGER_SAVE_ERR." in {$fileAdd}", E_USER_WARNING );
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $redirect_url, $redirect_msg );
	}
	function saveConfig()
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$returnTask = sobi2Config::request( $_REQUEST, 'returnTask', '' );
		$config =& adminConfig::getInstance();
		$msg =_SOBI2_CHANGES_SAVED;
		switch($returnTask) {
			case'genConf':
				$config->setGenConf();
				break;
			case'efConf':
				$msg .= $config->setEfConf();
				break;
			case'viewConf':
				$config->setViewConf();
				break;
			case'payConf':
				$config->setPaymentConf();
				break;
			case'editCSS':
				$config->saveCSS();
				break;
			case'editTemplate':
				$config->saveTemplate();
				break;
			case'editVCTemplate':
				$config->saveTemplate("vc");
				break;
			case'editFormTemplate':
				$config->saveTemplate("form");
				break;
			case'about':
				$config->savePby();
				break;
			case'registry':
				sobi2Saver::saveRegistry( $config );
				break;
		}
		$config->sobiCache->clearAll();
		sobi2Config::redirect( $sobi2AdminUrl."&task={$returnTask}", $msg );
	}
	function recountCats()
	{
		?>
		<table class="SobiAdminForm" width="100%">
		<tr class="row0">
		<td>
		<?php
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$cache =& $config->sobiCache;
		$limit = $config->key( "general", "recount_limit_at_once", 250 );
		$limitstart = (int) sobi2Config::request( $_GET, 'lstart', 0 );
		if( !$limitstart ) {
			$cache->clearAll();
		}
		$query = "SELECT catid FROM #__sobi2_categories WHERE published = 1 LIMIT {$limitstart}, {$limit}";
		$lstart = $limitstart + $limit;
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$count = 0;
		$cats = $database->loadResultArray();
		if( !empty( $cats ) ) {
			foreach ( $cats as $cat ) {
				$count++;
				$counter = array();
	    		$childs = array();
	    		$config->getChildCats( $cat, $childs );
	    		if( is_array( $childs ) && !empty( $childs ) ) {
					$childs = implode(" , ", $childs);
		    		$query = "SELECT COUNT(*) FROM #__sobi2_categories WHERE catid IN ({$childs}) AND published = 1";
		    		$database->setQuery( $query );
		    		$counter['cats'] = $database->loadResult() - 1;
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
	    		}
	    		else {
	    			$counter['cats'] = 0;
	    			$childs = $cat;
	    		}
				$now = $config->getTimeAndDate();
	    		$distinct = $config->key( "frontpage", "catlist_count_entries_once", true ) ? " DISTINCT " : null;
    			$query = "SELECT COUNT({$distinct}rel.itemid) FROM `#__sobi2_cat_items_relations` AS rel " .
	    			 "LEFT JOIN `#__sobi2_item` AS sitem ON rel.itemid = sitem.itemid " .
	    			 "WHERE(sitem.published = '1' AND (sitem.publish_down > '{$now}' OR sitem.publish_down = '{$config->nullDate}') AND rel.catid IN ({$childs}))";
				$database->setQuery($query);
				$items = $database->loadResult();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$counter['items'] = $items;
				$cache->removeObj( 0, $cat, 0, true, true );
				$cache->addObj( $counter, 0, 0, $cat, 0, true );
			}
			if( $count < $limit ) {
				$count = $limitstart + $count;
				echo _SOBI2_TOOLBAR_RECOUNT_DONE."<b>{$count}</b>"._SOBI2_TOOLBAR_RECOUNT_DONE_C;
				$cache->clearAll();
		    	$statement = "UPDATE `#__sobi2_config` SET `configValue` = '0' WHERE `configKey` = 'recount' AND `sobi2Section` = 'cache' LIMIT 1 ;";
		    	$database->setQuery($statement);
		    	$database->query();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				return true;
			}
			else {
				$count = $limitstart + $count;
				echo "<b>{$count}</b>"._SOBI2_TOOLBAR_RECOUNTED_SOFAR."&nbsp;";
				echo "&nbsp<form name=\"counter\">"._SOBI2_TOOLBAR_RECOUNT_WAIT."&nbsp;<input style=\"border-style:none;font-size:20px;\" type=\"text\" size=\"60\" name=\"count\"></form>";
				echo "
				<script>
					function relocate()
					{
						document.location.href='index3.php?option=com_sobi2&task=ccount&no_html=1&lstart={$lstart}';
					}
 					var msec = 0
 					var seconds = 10;
 					document.counter.count.value='10'
					function display()
					{
 						if( seconds <= 0 )
 						{
 							document.counter.count.value='"._SOBI2_TOOLBAR_RECOUNT_RESTART."';
 						}
 						else {
							if ( msec <= 0 ) {
	    						msec = 9
	    						seconds -= 1
	 						}
		 					if ( msec <= -1 ){
		    					msec = 0
		    					seconds += 1
		 					}
		 					else {
		    					msec -= 1
		 					}
	    					document.counter.count.value=seconds + '.' + msec;
	    					setTimeout('display()',100)
	 					}
					}
					display();
					setTimeout('relocate()',10000)
				</script>\n";
			}
		}
		else {
			$cache->clearAll();
	    	$statement = "UPDATE `#__sobi2_config` SET `configValue` = '0' WHERE `configKey` = 'recount' AND `sobi2Section` = 'cache' LIMIT 1 ;";
	    	$database->setQuery($statement);
	    	$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			echo "<br/>"._SOBI2_TOOLBAR_RECOUNT_DONE.$limitstart._SOBI2_TOOLBAR_RECOUNT_DONE_C;
			?>
			</td>
			</tr>
			</table>
			<?php
			return true;
		}
	}
}
?>