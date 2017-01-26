<?php
/**
* @version $Id: admin.sobi2.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class HTML_SOBI extends ADM_HTML_SOBI {}
class ADM_HTML_SOBI {

	var $pageNav 		= null;
	var $limitstart 	= null;
	var $total 			= null;
	var $limit 			= null;
	var $catPageNav 	= null;
	var $catTotal		= null;

	function ADM_HTML_SOBI() {
    	$config =& adminConfig::getInstance();
    	if(!(defined("_SOBI_MAMBO"))) {
    		$config->addCustomHeadTag("<link rel='stylesheet' href='{$config->liveSite}/administrator/components/com_sobi2/includes/admin.sobi2.css' type='text/css'/>");
    	}
    	$config->loadOverlib();
	}

	function showHtml( $catid = 1 )
	{
   		$no_html = intval(sobi2Config::request($_REQUEST, 'no_html', 0));
	    if(!$no_html){
	    	$adminMenu = new sobi2Menu();
	    	$config =& adminConfig::getInstance();
	    	if( $config->recount && $config->showCatItemsCount ) {
	    		echo "<div style='text-align:center; width:100%;clear:both'>"._SOBI2_TOOLBAR_RECOUNT_NEEDED."</div>";
	    	}
	    	if(defined("_JEXEC")) {
	    		define("_SOBI2_ADM_PASSED", true);
	    		include_once("toolbar.sobi2.php");
	    	}
	    	?>
	    	<div style="text-align:left; clear:both;">
				<table border="0" width="100%">
				  <tbody>
				  	<tr>
				      <td width="220" valign="top">
				      	<?php $adminMenu->showMenu();?>
				      </td>
				      <td valign="top">
				      <?php
					    	echo '<div style="clear:both;">';
					    	$this->getMain($catid);
					    	echo '</div>';
				      ?>
				      </td>
				    </tr>
				  </tbody>
				</table>
			</div>
	    	<?php
	    }
	    else {
	    	$this->getMain($catid);
	    }
	}
	function getMain($catid = 1)
	{
		$task = sobi2Config::request( $_REQUEST, 'task', '' );
		if(!$task) {
			$task = sobi2Config::request( $_REQUEST, 'sobi2Task', '' );
		}
		$config =& adminConfig::getInstance();

		$catid = intval(sobi2Config::request($_REQUEST, 'catid', 0));
		if(isset($task)) {
			switch($task) {
				case 'listing':
					$this->getListing($catid);
					break;
				case 'move':
					$cid = sobi2Config::request( $_POST, 'cid', array(0));
					$cidCount = intval($cid[0]);
					$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
					$sItemIDCount = intval($sItemID[0]);
					if($cidCount !=  0)
					{
						$this->moveCategory($cid,$catid);
					}
					else if($sItemIDCount != 0)
					{
						$this->moveItem($sItemID,$catid);
					}
						break;
				case 'copy':
					$cid = sobi2Config::request( $_POST, 'cid', array(0));
					$cidCount = intval($cid[0]);
					$sItemID = sobi2Config::request( $_POST, 'sItem', array(0));
					$sItemIDCount = intval($sItemID[0]);
					if($cidCount !=  0)
					{
						$this->copyCategory($cid,$catid);
					}
					else if($sItemIDCount != 0)
					{
						$this->copyItem($sItemID,$catid);
					}
						break;
				case 'getUnapproved':
					$this->getUnapproved($catid);
					break;
				case 'editFields':
					$this->fieldsListing(sobi2Config::request( $_REQUEST, 'slang', $config->sobi2Language));
					break;
				case 'genConf':
				case 'efConf':
				case 'viewConf':
				case 'payConf':
				case 'editCSS':
				case 'editTemplate':
				case 'editVCTemplate':
				case 'editFormTemplate':
				case 'langMan':
				case 'templates':
				case 'registry':
				case 'emails':
				case 'recount':
					$this->generalConfig($task);
					break;
				case 'vercheck':
					$this->generalConfig($task);
					break;
				case 'errlog':
				case 'syscheck':
					$this->generalConfig($task);
					break;
				case 'about':
					$this->aboutSobi();
					break;
				case 'eula':
					include_once(_SOBI_ADM_PATH.DS."includes".DS."about".DS."eula.html");
					break;
				case 'plugins':
					$this->pluginConfig(sobi2Config::request( $_REQUEST, 'S2_plugin',null));
					break;
				case 'pluginsManager':
					$config->pluginManager();
					break;
				default:
					$this->startConfig($catid);
					break;
			}
		}
		else {
			$this->startConfig($catid);
		}
	}
	function startConfig( $catId = 1 )
	{
		$this->getListing($catId);
	}
	function getCatName( $catId )
	{
		sobi2Config::import("includes|adm.helper.class", "adm");
		return sobi2Helper::getCatName( $catId );
	}
	function getListing( $catId = 1 )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getListing( $this, $catId );
	}
	function getCats( $catid = 1 )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getCats( $this, $catid );
	}
	function getCatsListing( $cats,$returnTask=null )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getCatsListing( $this, $cats, $returnTask );
	}
	function getItems( $catid = 1, $search )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getItems( $this, $catid, $search );
	}
	function getAllItems( $search )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getAllItems( $this, $search );
	}
	function getItemsListing( $items,$returnTask = null, $catId )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getItemsListing( $this, $items, $returnTask, $catId );
	}
	function nonFreeOptionExisting()
	{
		static $checked = false;
		static $e;
		if(!$checked) {
			$config =& adminConfig::getInstance();
			$db = &$config->getDb();
			$q = "SELECT round( sum( amount ) ) AS sum FROM `#__sobi2_payments` ";
			$db->setQuery($q);
			$e = $db->loadResult();
			if ($db->getErrorNum()) {
				trigger_error("ADM_HTML_SOBI::nonFreeOptionExisting(): DB reports: ".$db->stderr(), E_USER_WARNING);
			}
		}
		return $e;
	}
	function nonFreeOption( $id )
	{
		$config =& adminConfig::getInstance();
		$db = &$config->getDb();

		static $f = false;
		static $amounts = array();
		if(!$f) {
			$f = true;
			$config->getEditForm();
		}
		if(!$amounts || empty($amounts)) {
			$query = "SELECT sid, SUM( amount ) AS sum FROM `#__sobi2_payments` GROUP BY sid";
			$db->setQuery($query);
			$objects = $db->loadObjectList();
			foreach ( $objects as $object ) {
				$amounts[$object->sid] = $object->sum;
			}
			if ($db->getErrorNum()) {
				trigger_error("ADM_HTML_SOBI::nonFreeOption(): DB reports: ".$db->stderr(), E_USER_WARNING);
			}
		}
		$sum = key_exists( $id, $amounts) ? $amounts[$id] : 0;
		if( $sum ) {
			$img = sobi2Config::checkPNGImage( $config->liveSite.'/administrator/components/com_sobi2/images/nfo_k.png', "", "border-style:none;" );
			return "&nbsp;{$img}&nbsp;".$config->getCurrencyFormat( $sum );
		}
		else {
			$img 	= "administrator/images/publish_x.png";
			return sobiHTML::toolTip( _SOBI2_CONFIG_DEBUG_LEVEL_0, _SOBI2_CONFIG_DEBUG_LEVEL_0, null, $img );
		}
	}
	function ApprovedProcessing( $row, $i )
	{
		$img 	= $row->approved ? 'publish_g.png' : 'publish_x.png';
		$task 	= $row->approved ? 'unapprove' : 'approve';
		$alt 	= $row->approved ? 'Not Approved': 'Approved';
		$action	= $row->approved ? _SOBI2_TOOLBAR_UNAPPROVE : _SOBI2_TOOLBAR_APPROVE;

		$href = '
		<a href="javascript: void(0);" onclick="return listItemTask(\'sItem'. $i .'\',\''. $task .'\')" title="'. $action .'">
		<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
		</a>'
			;
		return $href;
	}
	function ConfirmedProcessing( $row, $i )
	{
	}
	function CheckedOutProcessing( $row, $i, $name='sItem' )
	{
    	$config =& sobi2Config::getInstance();
		$my 	= &$config->getUser();
		if ( $row->checked_out && $row->checked_out != $my->id ) {
			sobi2Config::import( 'includes|adm.helper.class', 'adm' );
			$checked = sobi2AdmHelper::checkedOut( $row );
		}
		else {
			$checked = $this->idBox( $i, $row->id, ( $row->checked_out && $row->checked_out != $my->id ), $name );
		}
		return $checked;
	}
	function PublishedProcessing( $row, $i )
	{
		$config =& adminConfig::getInstance();
		if(($row->publish_down < date( 'Y-m-d H:i:s', time() + $config->offset * 60 * 60  )) && ($row->publish_down != $config->nullDate))
			$img 	= $row->published ? 'publish_r.png' : 'publish_x.png';
		else
			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
		$task 	= $row->published ? 'unpublish' : 'publish';
		$alt 	= $row->published ? 'Published' : 'Unpublished';
		$action	= $row->published ? _SOBI2_TOOLBAR_UNPUBLISH : _SOBI2_TOOLBAR_PUBLISH;

		$href = '
		<a href="javascript: void(0);" onclick="return listItemTask(\'sItem'. $i .'\',\''. $task .'\')" title="'. $action .'">
		<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
		</a>'
		;
		return $href;
	}

	function idBox( $rowNum, $recId, $checkedOut=false, $name='sItem' )
	{
		if ( $checkedOut ) {
			return '';
		} else {
			return '<input type="checkbox" id="'.$name.$rowNum.'" name="'.$name.'[]" value="'.$recId.'" onclick="isChecked(this.checked);" />';
		}
	}
	function orderDownIcon( $i, $n, $condition=true, $task='orderdown', $scope = 'sItem', $alt=_SOBI2_MOVE_DOWN )
	{
		if (($i < $n-1 || $i+$this->limitstart < $this->total-1) && $condition) {
			return '<a href="#reorder" onClick="return listItemTask(\''.$scope.''.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  			return '&nbsp;';
		}
	}
	function orderUpIcon( $i, $condition=true, $task='orderup', $scope = 'sItem', $alt=_SOBI2_MOVE_UP )
	{
		if (($i > 0 || ($i+$this->limitstart > 0)) && $condition) {
			return '<a href="#reorder" onClick="return listItemTask(\''.$scope.''.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  			return '&nbsp;';
		}
	}
	function moveItem( $sItemIDs,$catid )
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::moveItem( $sItemIDs,$catid );
	}
	function getCatsForDtree()
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::getCatsForDtree();
	}
	function getAjaxCatsTree($cid = 1, $cat = false)
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::getAjaxCatsTree( $cid, $cat );
	}
	function getCatsTree($catsList, $catid, $workingCat = false)
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::getCatsTree( $catsList, $catid, $workingCat );
	}
	function copyItem( $sItemIDs,$catid )
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::copyItem( $sItemIDs,$catid );
	}
	function moveCategory( $cid,$catid )
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::moveCategory($cid,$catid);
	}
	function copyCategory( $cid,$catid )
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::copyCategory($cid,$catid);
	}
	function addCatsSerie( $catid )
	{
		sobi2Config::import("admin.sobi2.static.html", "adm");
		return ADM_SHTML_SOBI::addCatsSerie( $catid );
	}
	function getUnapproved( $catid )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getUnapproved( $this, $catid );
	}
	function getUnapprovedItems()
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getUnapprovedItems();
	}
	function getUnapprovedListing( $itemsRows )
	{
		sobi2Config::import("admin.sobi2.listings.html", "adm");
		return ADM_LHTML_SOBI::getUnapprovedListing( $this, $itemsRows );
	}
	function fieldsListing($lang=null)
	{
		sobi2Config::import("admin.field.class.html", "adm");
		return fieldHtml::fieldsListing( $lang );
	}
	function FreeFieldProcessing( $row, $i )
	{
		$img 	= $row->is_free ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->is_free ? _SOBI2_FIELD_FREE: _SOBI2_FIELD_NOT_FREE;
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function EnabledProcessing( $row, $i )
	{
		$img 	= $row->published ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->published ? _SOBI2_FIELD_ENABLED : _SOBI2_FIELD_DISABLED;
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function RequiredFieldProcessing( $row, $i )
	{
		$img 	= $row->is_required ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->is_required ? _SOBI2_FIELD_REQUIRED: _SOBI2_FIELD_NOT_REQUIRED;
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function SViewFieldProcessing( $row, $i ) {
		$img 	= $row->in_vcard ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->in_vcard ? _SOBI2_YES_U: _SOBI2_NO_U;
		$alt	= _SOBI2_FIELD_IN_VCARD.": {$alt}";
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function DViewFieldProcessing( $row, $i )
	{
		$img 	= $row->in_details ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->in_details ? _SOBI2_YES_U: _SOBI2_NO_U;
		$alt	= _SOBI2_FIELD_IN_DETAILS.": {$alt}";
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function EditableFieldProcessing( $row, $i )
	{
		$img 	= $row->isEditable ? 'tick.png' : 'publish_x.png';
		$alt 	= $row->isEditable ? _SOBI2_YES_U: _SOBI2_NO_U;
		$img 	= "administrator/images/$img";
		$href  	= sobiHTML::toolTip( _SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE, $alt, null, $img );
		return $href;
	}
	function generalConfig( $task )
	{
		sobi2Config::import("admin.config.class.html", "adm");
		return adminConfig_HTML::generalConfig( $task );
	}
	function uninstallSOBI( )
	{
    	sobi2Config::import("includes|about|about", "adm");
    	return uninstallSOBI();
    }
    function pluginConfig( $pluginName )
    {
		sobi2Config::import("admin.config.class.html", "adm");
		return adminConfig_HTML::pluginConfig( $pluginName );
    }
    function aboutSobi()
    {
    	sobi2Config::import("includes|about|about", "adm");
    	return aboutSobi();
    }
}
?>