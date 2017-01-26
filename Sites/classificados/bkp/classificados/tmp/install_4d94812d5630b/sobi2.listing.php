<?php
/**
* @version $Id: sobi2.listing.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobiListings {
	 /**
     * details view
     *
     * @param integer $catid
     */
    function showListing( $catid = 0 )
    {
    	$config	=& sobi2Config::getInstance();
		$Itemid	= $config->sobi2Itemid;
		$sobi2Frontend = &$config->getFrontend();
		$requestParams =& $config->get_( "requestParams" );
    	echo $sobi2Frontend->getHeader();
    	if($catid < 2 && $config->showComponentDescription) {
    		if( $config->cacheL2Enabled && $output = $config->sobiCache->getContent( $requestParams, "componentdescr")) {
    			echo $output;
    		}
    		else {
	    		sobi2Config::import("category.class");
	    		$sobi2Desc = new sobi2Category( 1 );
	    		if( $config->key( "general", "com_desc_exec_mambots", true ) ) {
	    			$sobi2Desc->description = HTML_SOBI::execMambots($sobi2Desc->description);
	    		}
	    		$output = "\n\n\n<table class=\"sobi2CompDesc\">\n\t<tr>";
	    		$output .= "\n\t\t<td>";
	    		if($sobi2Desc->image) {
	    			$output .= "\n\t\t\t<img src=\"{$config->liveSite}{$config->catImagesFolder}{$sobi2Desc->image}\"  style=\"float:{$sobi2Desc->image_position};\" alt=\"{$config->componentName}\" title=\"{$config->componentName}\"/>";
	    		}
	    		$output .=  $sobi2Desc->description;
	    		$output .=  "\n\t\t</td>";
	    		$output .=  "\n\t</tr>\n\n\n</table>";
				if( $config->cacheL2Enabled ) {
				 	$config->sobiCache->addContent( $output, $requestParams, "componentdescr" );
				}
				echo $output;
    		}
    	}
    	/*
    	 * case no catid we shown frontpage
    	 */
    	if( $catid < 2 ) {
    		/*
	    	 * if we don't have catid but the category listing should be shown on front page
	    	 */
    		if( $config->cacheL2Enabled && $output = $config->sobiCache->getContent( $requestParams, "catlist")) {
    			echo $output;
    		}
	    	else {
	    		if( !isset( $sobi2Desc ) ) {
		    		sobi2Config::import("category.class");
		    		$sobi2Desc = new sobi2Category( 1 );
		    	}
				if($config->showCatListOnFp) {
					echo $output = $sobi2Frontend->getCatListing( $sobi2Desc );
				}
				if( $config->cacheL2Enabled ) {
				 	$config->sobiCache->addContent( $output, $requestParams, "catlist" );
				}
	    	}
			if(count($config->S2_plugins)) {
	    		foreach($config->S2_plugins as $plugin) {
	    			if(method_exists($plugin, "onShowListing")) {
						echo $plugin->onShowListing( $catid );
	    			}
	    		}
	    	}
	    	/*
	    	 * if we don't have catid but the listing should be shown on front page
	    	 */
	    	$cacheEntries = true;
			if( $config->showListingOnFp ) {
	    		if( $config->cacheL2Enabled
	    			&& ( $coutput = $config->sobiCache->getContent( $requestParams, "entrieslist") )
	    			&& ( $cPageNav = $config->sobiCache->getContent( $requestParams, "pagenav") )
	    		) {
	    			echo $coutput;
	    			$cacheEntries = false;
	    		}
	    		else {
					$output  = "\n\t\t<table class=\"sobi2Listing\">";
	    			$output .= $sobi2Frontend->getListing( $sobi2Desc );
	    			$output .= "\n\t\t\t</tr>\n\t\t</table>\n";
	    			echo $output;
    			}
				if( $config->cacheL2Enabled && $cacheEntries ) {
				 	$config->sobiCache->addContent( $output, $requestParams, "entrieslist" );
				}
			}
    	}
    	/*
    	 * if catid we shown some category
    	 */
    	elseif( $catid > 1 ) {
    		sobi2Config::import("category.class");
    		$sobi2Cat = new sobi2Category($catid);
    		$sobi2Cat->countVisit();
    		if( !$config->cacheL2Enabled || !($output = $config->sobiCache->getContent( $requestParams, "catdescription"))) {
		    	$output = null;
    			if($config->showCatDesc) {
		    		$output .= "\n\n\n<table class=\"sobi2CompDesc\">\n\t<tr>";
		    		$output .= "\n\t\t<td>";
		    		if($sobi2Cat->image) {
		    			$output .= "\n\t\t\t<img src='{$config->liveSite}{$config->catImagesFolder}{$sobi2Cat->image}'  style='float:{$sobi2Cat->image_position};' alt='{$sobi2Cat->introtext}' title='{$sobi2Cat->name}'/>";
		    		}
		    		if( $config->key( "general", "cat_desc_exec_mambots", true ) ) {
		    			$output .= HTML_SOBI::execMambots($sobi2Cat->description);
		    		}
		    		else {
		    			$output .= $sobi2Cat->description;
		    		}
		    		$output .= "\n\t\t</td>";
		    		$output .= "\n\t</tr>\n\n\n</table>";
		    		if( $config->cacheL2Enabled ) {
						$config->sobiCache->addContent( $output, $requestParams, "catdescription" );
		    		}
		    	}
    		}
    		echo $output;
		    /*
	    	 * if we have catid and the subcategory listing should be shown in category view
	    	 */
			if($config->showCatListInCat) {
				if( !$config->cacheL2Enabled || !($output = $config->sobiCache->getContent( $requestParams, "catlist"))) {
					$output = $sobi2Frontend->getCatListing( $sobi2Cat );
		    		if( $config->cacheL2Enabled ) {
						$config->sobiCache->addContent( $output, $requestParams, "catlist" );
		    		}
				}
				echo $output;
			}
			if(count($config->S2_plugins)) {
	    		foreach( $config->S2_plugins as $name => $plugin ) {
	    			if( method_exists( $plugin, "onShowListing" ) ) {
						echo $config->S2_plugins[$name]->onShowListing( $catid );
	    			}
	    		}
	    	}
			/*
			 * show items in this category
			 */
			if( !$config->cacheL2Enabled
				|| !( $output = $config->sobiCache->getContent( $requestParams, "entrieslist") )
				|| !( $cPageNav = $config->sobiCache->getContent( $requestParams, "pagenav") )
			) {
				$output = "\n\t\t<table class=\"sobi2Listing\">";
				$output .= $sobi2Frontend->getListing( $sobi2Cat );
				$output .= "\n\t\t\t</tr>\n\t\t</table>\n";
	    		if( $config->cacheL2Enabled ) {
					$config->sobiCache->addContent( $output, $requestParams, "entrieslist" );
	    		}
			}
			echo $output;
    	}
		/*
		 * if listing was builded show the page navigation footer
		 */
		if( $sobi2Frontend->pageNav || ( isset( $cPageNav ) && $cPageNav ) ) {
			if( isset( $cPageNav ) && $cPageNav ) {
				echo $cPageNav;
			}
			else {
				$output = '<div id="sobi2PageNav">';
				if($catid > 1 ) {
					$link = "index.php?option=com_sobi2&amp;catid={$catid}&amp;Itemid={$Itemid}";
				}
				else {
					$link =  "index.php?option=com_sobi2&amp;Itemid={$Itemid}";
				}
				$output .= sobi2bridge::writePagesLinks( $sobi2Frontend->pageNav, $link );
				$output .= '</div>';
				if( $config->cacheL2Enabled ) {
				 	$config->sobiCache->addContent( $output, $requestParams, "pagenav" );
				}
				echo $output;
			}
		}
    	echo $sobi2Frontend->getFooter();

    }
    /**
     * Enter description here...
     *
     */
    function showMyListing()
    {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		$uid = sobi2Config::request( $_REQUEST, "uid", 0 );
		$expired = false;

		if( !$uid ) {
			$my =& $config->getUser();
			$uid = $my->id;
			$expired = $config->key("users_own_listing", "can_see_expired");
			$url = "index.php?option=com_sobi2&amp;sobi2Task=usersListing&amp;Itemid={$config->sobi2Itemid}";
		}
		else {
			$url = "index.php?option=com_sobi2&amp;sobi2Task=usersListing&amp;uid={$uid}&amp;Itemid={$config->sobi2Itemid}";
		}
		if( !$uid ) {
			sobi2Config::redirect( $config->key( "redirects", "user_listing_no_entries", "index.php" ), _SOBI2_USER_OWN_NO_LISTING );
		}
		$user =&sobi2bridge::jUser( $database );
		$user->load( $uid );

		$title = str_replace( array( "%username%" ,"%name%" ), array( $user->username, $user->name ), _SOBI2_USER_OWN_LISTING );

		$published = !$config->key("users_own_listing", "can_see_unpublished");
		$published = $published ? " AND published = 1 " : null;
		$query = "SELECT itemid FROM #__sobi2_item WHERE owner = {$user->id}{$published}";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showMyListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["usersListing"] ) && $config->templates["usersListing"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["usersListing"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
			sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }

		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 					*/
							null, 																	/* cids 					*/
							$url,  																	/* $navMenuUrl 				*/
							$title,																	/* $header 					*/
							null,																	/* $stringForItems 			*/
							null,			  														/* $stringForCats 			*/
							$title,																	/* $addToPathway			*/
							$title,																	/* $addToSiteTitle 			*/
							0,																		/* $defCid 					*/
							"usersListing",															/* $pluginTask				*/
							null,																	/* $itemsOrdering 			*/
							null,																	/* $catsOrdering 			*/
							null,																	/* $pluginsArgs 			*/
							$expired																/* $forceUnpublishedItems 	*/
		);
    }
	 /**
     * Alphabetical listing
     *
     * @param string $letter
     */
     function showAlphaListing( $letter )
     {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		$now = $config->getTimeAndDate();
		$letter = $database->getEscaped( $letter );
		$letter = urldecode( $letter );
		if ( isset( $letter[1] ) && $letter[1] == "-" ) {
			$search = "[{$letter[0]}-{$letter[2]}]";
			$phrase = "{$letter[0]}-{$letter[2]}";
		}
		else {
			$phrase = $search = $letter;
		}

		$query = "SELECT itemid FROM #__sobi2_item WHERE UPPER(title) RLIKE '^{$search}' AND (published = 1 AND publish_down > '{$now}' OR publish_down = '{$config->nullDate}') ";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showAlphaListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$query = "SELECT catid FROM #__sobi2_categories WHERE UPPER(name) RLIKE '^{$search}'";
		$database->setQuery($query);
		$cids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showAlphaListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$url = "index.php?option=com_sobi2&amp;letter={$letter}&amp;Itemid={$config->sobi2Itemid}";

		$pluginsArgs['letter'] = &$letter;

		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["alphaListings"] ) && $config->templates["alphaListings"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["alphaListings"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
        	sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }
		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 			*/
							$cids, 																	/* cids 			*/
							$url,  																	/* $navMenuUrl 		*/
							_SOBI2_ALPHA_HEADER." <b>\"{$phrase}\"</b>" ,							/* $header 			*/
							_SOBI2_ALPHA_ITEMS_WITH_LETTER." <b>\"{$phrase}\"</b>",					/* $stringForItems 	*/
							_SOBI2_ALPHA_CATS_WITH_LETTER." <b>\"{$phrase}\"</b>",  				/* $stringForCats 	*/
							_SOBI2_ALPHA_HEADER." <b>\"{$phrase}\"</b>",							/* $addToPathway	*/
							_SOBI2_ALPHA_LETTER." \"{$phrase}\"",									/* $addToSiteTitle 	*/
							0,																		/* $defCid 			*/
							"alphaListings",														/* $pluginTask		*/
							"title",																/* $itemsOrdering	*/
							"name",																	/* $catsOrdering	*/
							$pluginsArgs															/* $pluginsArgs 	*/
		);
     }
	 /**
     * listing by tag
     *
     * @param string $tag
     */
    function showListingByTag( $tag )
    {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();

		$now = $config->getTimeAndDate();

		$tag = $database->getEscaped($tag);
		$tag = urldecode( $tag );

		$query = "SELECT itemid FROM #__sobi2_item WHERE metakey RLIKE '[[:<:]]{$tag}[[:>:]]' AND (published = 1 AND publish_down > '{$now}' OR publish_down = '{$config->nullDate}') ";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showListingByTag: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$url = "index.php?option=com_sobi2&amp;tag={$tag}&amp;Itemid={$config->sobi2Itemid}";

		$pluginsArgs['tag'] = &$tag;
		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["taggedListings"] ) && $config->templates["taggedListings"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["taggedListings"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
        	sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }

		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 			*/
							null, 																	/* cids 			*/
							$url,  																	/* $navMenuUrl 		*/
							_SOBI2_ENTRIES_TAGGED_WITH." <b>\"{$tag}\"</b>" ,								/* $header 			*/
							null,																	/* $stringForItems 	*/
							null,														  			/* $stringForCats 	*/
							_SOBI2_TAGGED_HEADER." <b>\"{$tag}\"</b>",								/* $addToPathway	*/
							_SOBI2_TAGGED_HEADER." \"{$tag}\"",										/* $addToSiteTitle 	*/
							0,																		/* $defCid 			*/
							"taggedListings",														/* $pluginTask		*/
							"title",																/* $itemsOrdering	*/
							"name",																	/* $catsOrdering	*/
							$pluginsArgs															/* $pluginsArgs 	*/
		);
    }
	 /**
     * popular listing
     */
    function showPopularListing( )
    {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		$now = $config->getTimeAndDate();

		$task = sobi2Config::request($_REQUEST, 'sobi2Task', null);


		$query = "SELECT itemid FROM #__sobi2_item WHERE (published = 1 AND publish_down > '{$now}' OR publish_down = '{$config->nullDate}') ORDER BY hits DESC LIMIT 0, 30";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showPopularListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		if($task == "popular") {
			$query = "SELECT catid FROM #__sobi2_categories WHERE published = 1 ORDER BY count DESC LIMIT 0, 6";
			$database->setQuery($query);
			if ($database->getErrorNum()) {
				trigger_error("showPopularListing: DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$cids = $database->loadResultArray();
			$header = _SOBI2_POPULAR_HEADER;
			$itemsHeader = _SOBI2_POPULAR_LISTING;
		}
		else {
			$itemsHeader = null;
			$header = _SOBI2_POPULAR_LISTING;
			$cids = array();
		}

		$url = "index.php?option=com_sobi2&amp;sobi2Task={$task}&amp;Itemid={$config->sobi2Itemid}";

		$pluginsArgs['cats'] = &$cats;

		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["popularListings"] ) && $config->templates["popularListings"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["popularListings"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
        	sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }

		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 			*/
							$cids, 																	/* cids 			*/
							$url,  																	/* $navMenuUrl 		*/
							$header,																/* $header 			*/
							$itemsHeader,															/* $stringForItems 	*/
							_SOBI2_POPULAR_CATS,										  			/* $stringForCats 	*/
							$header,																/* $addToPathway	*/
							$header,																/* $addToSiteTitle 	*/
							0,																		/* $defCid 			*/
							"popularListings",														/* $pluginTask		*/
							"hits DESC",															/* $itemsOrdering	*/
							"count DESC",															/* $catsOrdering	*/
							$pluginsArgs															/* $pluginsArgs 	*/
		);
    }
	 /**
     * popular listing
     */
    function showUpdatedListing()
    {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		$now = $config->getTimeAndDate();

		$query = "SELECT itemid FROM #__sobi2_item WHERE (published = 1 AND publish_down > '{$now}' OR publish_down = '{$config->nullDate}') ORDER BY last_update DESC LIMIT 0, 30";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showUpdatedListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$url = "index.php?option=com_sobi2&amp;sobi2Task=updated&amp;Itemid={$config->sobi2Itemid}";

		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["updatedListings"] ) && $config->templates["updatedListings"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["updatedListings"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
        	sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }

		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 			*/
							null, 																	/* cids 			*/
							$url,  																	/* $navMenuUrl 		*/
							_SOBI2_UPDATED_HEADER,													/* $header 			*/
							null,																	/* $stringForItems 	*/
							null,														  			/* $stringForCats 	*/
							_SOBI2_UPDATED_LISTING,													/* $addToPathway	*/
							_SOBI2_UPDATED_LISTING,													/* $addToSiteTitle 	*/
							0,																		/* $defCid 			*/
							"updatedListings",														/* $pluginTask		*/
							"last_update DESC",														/* $itemsOrdering	*/
							null																	/* $catsOrdering	*/
		);
    }
	 /**
     * popular listing
     */
    function showNewListing()
    {
		$config =& sobi2Config::getInstance();
		$database = $config->getDb();
		$now = $config->getTimeAndDate();

		$query = "SELECT itemid FROM #__sobi2_item WHERE (published = 1 AND publish_down > '{$now}' OR publish_down = '{$config->nullDate}') ORDER BY publish_up DESC LIMIT 0, 30";
		$database->setQuery($query);
		$sids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("showNewListing: DB reports: ".$database->stderr(), E_USER_WARNING);
		}

		$url = "index.php?option=com_sobi2&amp;sobi2Task=showNew&amp;Itemid={$config->sobi2Itemid}";

		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        if( isset( $config->templates["newListings"] ) && $config->templates["newListings"] ) {
        	if( !$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->templates["newListings"]}|sobi2.vc.tmpl" ) ) {
        		$template = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" );
        	}
        }
		if( !$template ) {
			$template = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
		}
		$fetchErr = intval(sobi2Config::request($_REQUEST, 'err', 0));
        if( $config->debugTmpl && !$fetchErr ) {
			sobi2Config::parseTemplate( $template );
        }
        else {
        	sobi2Config::import( $template, "absolute" );
        }

		echo HTML_SOBI::buildCustomListing(
							$sids, 																	/* $sids 			*/
							null, 																	/* cids 			*/
							$url,  																	/* $navMenuUrl 		*/
							_SOBI2_NEW_LISTINGS_HEADER,												/* $header 			*/
							null,																	/* $stringForItems 	*/
							null,														  			/* $stringForCats 	*/
							_SOBI2_NEW_LISTINGS_LISTING,											/* $addToPathway	*/
							_SOBI2_NEW_LISTINGS_LISTING,											/* $addToSiteTitle 	*/
							0,																		/* $defCid 			*/
							"newListings",															/* $pluginTask		*/
							"publish_up DESC",														/* $itemsOrdering	*/
							null																	/* $catsOrdering	*/
		);
    }
}
?>