<?php
/**
* @version $Id: rss.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

// no direct access
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class sobi2RRS {
	var $nrOfEntries = 10;
	var $items = null;
	var $category = null;
	function sobi2RRS( $cid = 1 )
	{
    	$config =& sobi2Config::getInstance();
    	$this->nrOfEntries = $config->key( "general", "rss_number_of_entries", 10 );
		$database = &$config->getDb();
		$order = intval(sobi2Config::request($_REQUEST, 'order', 1));

		switch($order) {
			case 5:
				$sortBy = " RAND() ";
				break;
			case 4:
				$sortBy = "item.last_update";
				break;
			case 3:
				$sortBy = "item.publish_down";
				break;
			case 2:
				$sortBy = "item.hits";
				break;
			default:
			case 1:
				$sortBy = "item.publish_up";
				break;
		}

		$now = $config->getTimeAndDate();

		if( $cid <= 1 ) {
			$cid = 1;
			$query = "SELECT `title`, `itemid` FROM `#__sobi2_item` AS item WHERE item.published = 1 AND (item.publish_down > '{$now}' OR item.publish_down = '{$config->nullDate}' ) ORDER BY {$sortBy} DESC LIMIT {$this->nrOfEntries}";
		}
		else {
			$query = "SELECT `title`, rel.itemid FROM `#__sobi2_item` AS item LEFT JOIN `#__sobi2_cat_items_relations` AS rel ON rel.itemid = item.itemid WHERE item.published = 1 AND rel.catid = '{$cid}' AND (item.publish_down > '{$now}' OR item.publish_down = '{$config->nullDate}' ) ORDER BY {$sortBy} DESC LIMIT {$this->nrOfEntries}";
		}
		$database->setQuery( $query );
		if($database->getErrorNum()) {
			trigger_error("sobi2RRS::sobi2RRS():".$database->stderr());
		}
		$this->items = $database->loadObjectList();
		sobi2Config::import("category.class");
		$this->category = new sobi2Category($cid);
	}
	function showFeed()
	{
    	$config =& sobi2Config::getInstance();

		$charset = _ISO;
		$iso = explode( '=', _ISO );
		$encoding = strtoupper($iso[1]);
		$now = date( "r", strtotime( $config->getTimeAndDate() ) );

		$catDescription = $this->cleanHtml($this->category->description);
		if($this->category->catid != 1) {
			$catName = $this->cleanHtml("{$config->sitename} - {$config->componentName} - {$this->category->name}");
		}
		else {
			$catName = $this->cleanHtml("{$config->sitename} - {$config->componentName}");
		}
		if($this->category->catid) {
			$catUrl = sobi2Config::sef("index.php?option=com_sobi2&amp;catid={$this->category->catid}&amp;Itemid={$config->sobi2Itemid}");
		}
		else {
			$catUrl = sobi2Config::sef("index.php?option=com_sobi2&amp;Itemid={$config->sobi2Itemid}");
		}
		if ( !( strstr( $catUrl, 'http' ) ) ) {
			$catUrl  = "{$config->liveSite}/{$catUrl}";
		}
		$catImg = null;

		header( "Content-type: application/rss+xml; {$charset}" );
		ob_clean();
		echo "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>";
		echo "\n<rss version=\"2.0\">";
		echo "\n\t<channel>";
		echo "\n\t\t<title>{$catName}</title>";
		echo "\n\t\t<description>{$catDescription}</description>";

		if(isset($this->category->image) && $this->category->image != null && file_exists(_SOBI_CMSROOT.DS."images".DS."stories".DS."{$this->category->image}")) {
			$catImg = $this->category->image;
		}

		else if(isset($this->category->icon) && $this->category->icon != null  && file_exists(_SOBI_CMSROOT.DS."images".DS."stories".DS."{$this->category->icon}")) {
			$catImg = $this->category->icon;
		}
		else {
			$catImg = null;
		}

		if($catImg) {
			echo "\n\t\t<image>";
			echo "\n\t\t\t<title>{$catName}</title>";
			echo "\n\t\t\t<url>{$config->liveSite}{$config->catImagesFolder}{$catImg}</url>";
			echo "\n\t\t\t<link>{$catUrl}</link>";
			echo "\n\t\t</image>";
		}
		echo "\n\t\t<link>{$catUrl}</link>";
		echo "\n\t\t<lastBuildDate>{$now}</lastBuildDate>";
		echo "\n\t\t<generator>Sigsiu Online Business Index 2 FeedCreator</generator>";
		if( count( $this->items ) ) {
			sobi2Config::import("sobi2.class");
			foreach( $this->items as $item ) {
				$sobi = new sobi2( $item->itemid, true );
				$date = date( "r", strtotime( $sobi->publish_up ) );
				$itemTitle = $this->cleanHtml( $config->getSobiStr( $item->title ) );
				$itemUrl = sobi2Config::sef( "index.php?option=com_sobi2&amp;sobi2Task=sobi2Details&amp;catid={$this->category->catid}&amp;sobi2Id={$item->itemid}&amp;Itemid={$config->sobi2Itemid}" );
				if( !( strstr( $itemUrl, 'http' ) ) ) {
					$itemUrl  = "{$config->liveSite}/{$itemUrl}";
				}

				if(isset($sobi->customFieldsData['field_description']) && $sobi->customFieldsData['field_description']) {
					$description = $sobi->customFieldsData['field_description'];
					$description = $this->cleanHtml($description);
				}
				else {
					$description = null;
				}
				echo "\n\t\t<item>";
				echo "\n\t\t\t<title>{$itemTitle}</title>";
				echo "\n\t\t\t<link>{$itemUrl}</link>";
				echo "\n\t\t\t<description>{$description}</description>";
				echo "\n\t\t\t<pubDate>{$date}</pubDate>";
				echo "\n\t\t</item>";
				unset($sobi);
			}
		}
		echo "\n\t</channel>";
		echo "\n</rss>";
	}
	function cleanHtml($description)
	{
		$description = str_replace("<p>"," ",$description);
		$description = str_replace("<br>"," ",$description);
		$description = str_replace("<br/>"," ",$description);
		$description = str_replace("<br />"," ",$description);
		$description = sobiHTML::cleanText($description);
		return $description;
	}
}
?>
