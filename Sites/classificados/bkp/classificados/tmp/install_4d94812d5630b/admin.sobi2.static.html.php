<?php
/**
* @version $Id: admin.sobi2.static.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class ADM_SHTML_SOBI {
	function moveItem( $sItemIDs,$catid )
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$itemsArray = array();
		foreach($sItemIDs as $sobi2Id) {
			$query = "SELECT `title` FROM `#__sobi2_item` WHERE `itemid` = {$sobi2Id}";
			$database->setQuery( $query );
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$itemsArray = $itemsArray + array($sobi2Id => $database->loadResult());
		}
		ADM_SHTML_SOBI::moveItemHtml($itemsArray, $catid);
	}
	function moveItemHtml( $itemsList, $catid )
	{
		$config =& adminConfig::getInstance();
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="edit"><?php echo _SOBI2_ITEM_MOVE?></th>
			</tr>
		</table>
		  <h2><?php echo _SOBI2_ITEMS_TO_MOVE ?></h2>

 <table style="text-align: left; width: 100%;">
  	<tr>
  		<td style="vertical-align: top; width: 40%;">
	  		<table class="SobiAdminList" style="float:left; clear:left; width: 100%;">
				<tr>
					<th colspan="2" width="5px">#</th>
					<th><?php echo _SOBI2_LISTING_TITLE ?></th>
					<th width="10px">ID</th>
				</tr>

	<?php
		$count = 0;
		foreach($itemsList as $sobi2Id => $sobi2Title) {
			$count++;
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><input type="checkbox" id="sItem<?php echo $count; ?>" name="sItem[]" value="<?php echo $sobi2Id; ?>" checked onclick="isChecked(this.checked);" /></td>
					<td><?php echo $config->getSobiStr($sobi2Title); ?></td>
					<td><?php echo $sobi2Id; ?></td>
				</tr>
			<?php
		}
	?>
		  </table>
	</td>
	<td style="vertical-align: top; ">
		 <?php
				if($config->useSigsiuTree) {
					ADM_SHTML_SOBI::getAjaxCatsTree( $catid );
				}
				else {
					ADM_SHTML_SOBI::getCatsTree(ADM_SHTML_SOBI::getCatsForDtree(), $catid, true);
				}
		 ?>
	</td>
</tr>
</table>
	 	<input type="hidden" name="returnTask" value="listing&amp;catid=<?php echo $catid ?>"/>
	 	<input type='hidden' name='targetCat' id='selectedCat' value='1'/>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="catid" value="<?php echo $catid ?>" />
	</form>
	<?php
	}
	function getCatsForDtree()
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
    	$query = "SELECT  cats.catid,  parentid, name, ordering " .
    			 "FROM `#__sobi2_cats_relations` AS rel " .
    			 "LEFT JOIN `#__sobi2_categories` AS cats ON rel.catid = cats.catid " .
    			 "ORDER BY {$config->catsOrdering}";
    	$database->setQuery( $query );
    	$cats = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	return $cats;
	}
	function getAjaxCatsTree($cid = 1, $cat = false)
	{
		sobi2Config::import("includes|SigsiuTree|SigsiuTree");
		$config =& adminConfig::getInstance();
		$tree = new SigsiuTree($config->aTreeImages);
		$href = "javascript:onSelectedCat('{cid}')";
		if($cat) {
			$rootHref = "javascript:onSelectedCat('1')";
		}
		$tree->init("SigsiuTreeCats",$href,"div","SigsiuTreeCats",false,null,$cid);
		$SigsiuTree = $tree->getTree();
		?>
  		<script type="text/javascript">
  			function onSelectedCat(category) {
  				document.getElementById('selectedCat').value = category;
  			}
		</script>
  		<table class="SobiAdminList" style="float:left;">
			<tr>
				<th><?php echo _SOBI2_SELECT_TARGER_CAT ?></th>
			</tr>
			<tr><td><?php echo $SigsiuTree; ?></td></tr>
		</table>
		<?php
	}
	function getCatsTree($catsList, $catid, $workingCat = false)
	{
		$config =& adminConfig::getInstance();
		?>
  		<script type="text/javascript">
  			function onSelectedCat(category) {
  				document.getElementById('selectedCat').value = category;
  			}
		</script>

  		<table class="SobiAdminList" style="float:left;">
			<tr>
				<th><?php echo _SOBI2_SELECT_TARGER_CAT ?></th>
			</tr>
			<tr>
			<td>
			<?php
		 		echo    "\n<div class=\"dtree\">" .
						"\n<script type='text/javascript'>" .
						"\n\t" .
						"sobi2CatsM = new dTree('sobi2CatsM');" .
						"\n\t";
				if ($workingCat == true) {
					$href = "javascript:onSelectedCat(\'1\')";
					echo "sobi2CatsM.add(0,-1,'root', '{$href}');";
				}
				else
					echo "sobi2CatsM.add(0,-1,'root');";

		    	foreach($catsList as $category) {
		    		if($category->parentid == 1)
		    			$category->parentid --;
	    			$href = "javascript:onSelectedCat(\'{$category->catid}\')";
	    			$catName = $config->jsAddSlashes($config->getSobiStr($category->name));
		    		echo "\n\t sobi2CatsM.add({$category->catid},{$category->parentid},'{$catName}','{$href}','','','{$config->liveSite}/components/com_sobi2/images/folder.gif' ,'{$config->liveSite}/components/com_sobi2/images/folderopen.gif');";
		    	}
		    	echo "\n\t document.write(sobi2CatsM); \n " .
		    		 "\n\t sobi2CatsM.openAll(); " .
		    		 "\n </script> \n </div>";
			?>
			</td>
			</tr>
		</table>
		<?php
	}
	function copyItem( $sItemIDs,$catid )
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$itemsArray = array();
		foreach( $sItemIDs as $sobi2Id ) {
			$query = "SELECT `title` FROM `#__sobi2_item` WHERE `itemid` = {$sobi2Id}";
			$database->setQuery( $query );
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$itemsArray = $itemsArray + array($sobi2Id => $database->loadResult());
		}
		ADM_SHTML_SOBI::copyItemHtml( $itemsArray, $catid );
	}
	function copyItemHtml( $itemsList, $catid ) {
		$config =& adminConfig::getInstance();
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="edit"><?php echo _SOBI2_ITEM_COPY?></th>
			</tr>
		</table>
		  <h2><?php echo _SOBI2_ITEMS_TO_COPY ?></h2>

 <table style="text-align: left; width: 100%;">
  	<tr>
  		<td style="vertical-align: top; width: 40%;">
	  		<table class="SobiAdminList" style="float:left; clear:left; width: 100%;">
				<tr>
					<th colspan="2" width="5px">#</th>
					<th><?php echo _SOBI2_LISTING_TITLE ?></th>
					<th width="10px">ID</th>
				</tr>

	<?php
		$count = 0;
		foreach($itemsList as $sobi2Id => $sobi2Title) {
			$count++;
			?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><input type="checkbox" id="sItem<?php echo $count ?>" name="sItem[]" value="<?php echo $sobi2Id; ?>" checked onclick="isChecked(this.checked);" /></td>
					<td><?php echo $config->getSobiStr($sobi2Title); ?></td>
					<td><?php echo $sobi2Id; ?></td>
				</tr>
			<?php
		}
	?>
		  </table>
	</td>
	<td style="vertical-align: top; ">
		 <?php
				if($config->useSigsiuTree) {
					ADM_SHTML_SOBI::getAjaxCatsTree( $catid );
				}
				else {
					ADM_SHTML_SOBI::getCatsTree(ADM_SHTML_SOBI::getCatsForDtree(),$catid, true);
				}
		 ?>
	</td>
</tr>
</table>
	 	<input type='hidden' name='targetCat' id='selectedCat' value='1'/>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="catid" value="<?php echo $catid ?>" />
		<input type="hidden" name="returnTask" value="listing&amp;catid=<?php echo $catid ?>"/>
	</form>
	<?php
	}

	function moveCategory($cid,$catid)
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$catsArray = array();
		foreach($cid as $id) {
			$query = "SELECT `name` FROM `#__sobi2_categories` WHERE `catid` = {$id}"; echo "<br>";
			$database->setQuery( $query );
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$catsArray = $catsArray + array($id => $database->loadResult());
		}
		ADM_SHTML_SOBI::moveCategoryHtml($catsArray, $catid);
	}
	function moveCategoryHtml($catsList, $catid) {
		$config =& adminConfig::getInstance();
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="categories"><?php echo _SOBI2_CAT_MOVE?></th>
			</tr>
		</table>
		  <h2><?php echo _SOBI2_CATS_TO_MOVE ?></h2>

 <table style="text-align: left; width: 100%;">
  	<tr>
  		<td style="vertical-align: top; width: 40%;">
	  		<table class="SobiAdminList" style="float:left; clear:left; width: 100%;">
				<tr>
					<th colspan="2" width="5px">#</th>
					<th><?php echo _SOBI2_CAT_NAME ?></th>
					<th width="10px">ID</th>
				</tr>

	<?php
		$count = 0;
		foreach($catsList as $cid => $catTitle) {
			$count++;
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><input type="checkbox" id="sItem<?php echo $count; ?>" name="cid[]" value="<?php echo $cid; ?>" checked onclick="isChecked(this.checked);" /></td>
					<td><?php echo $config->getSobiStr($catTitle); ?></td>
					<td><?php echo $cid; ?></td>
				</tr>
			<?php
		}
	?>
		  </table>
	</td>
	<td style="vertical-align: top; ">
		 <?php
				if($config->useSigsiuTree) {
					ADM_SHTML_SOBI::getAjaxCatsTree($cid,true);
				}
				else {
					ADM_SHTML_SOBI::getCatsTree(ADM_SHTML_SOBI::getCatsForDtree(),$catid, true);
				}
		 ?>
	</td>
</tr>
</table>
	 	<input type='hidden' name='targetCat' id='selectedCat' value='1'/>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="catid" value="<?php echo $catid ?>" />
		<input type="hidden" name="returnTask" value="listing&amp;catid=<?php echo $catid ?>"/>
	</form>
	<?php
	}

	function copyCategory($cid,$catid)
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$catsArray = array();
		foreach($cid as $id) {
			$query = "SELECT `name` FROM `#__sobi2_categories` WHERE `catid` = {$id}";
			$database->setQuery( $query );
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$catsArray = $catsArray + array($id => $database->loadResult());
		}
		ADM_SHTML_SOBI::copyCategoryHtml($catsArray, $catid);
	}
	function copyCategoryHtml($catsList, $catid) {
		$config =& adminConfig::getInstance();
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="categories"><?php echo _SOBI2_CAT_COPY?></th>
			</tr>
		</table>
		  <h2><?php echo _SOBI2_CATS_TO_COPY ?></h2>

 <table style="text-align: left; width: 100%;">
  	<tr>
  		<td style="vertical-align: top; width: 40%;">
	  		<table class="SobiAdminList" style="float:left; clear:left; width: 100%;">
				<tr>
					<th colspan="2" width="5px">#</th>
					<th><?php echo _SOBI2_CAT_NAME ?></th>
					<th width="10px">ID</th>
					<th width="100px"><?php echo _SOBI2_CAT_COPY_ITEMS_TOO ?></th>
				</tr>

	<?php
		$count = 0;
		foreach($catsList as $cid => $catTitle) {
			$count++;
			?>
				<tr class="row<?php echo $count%2;?>">
					<td><?php echo $count; ?></td>
					<td><input type="checkbox" id="sItem<?php echo $count ?>" name="cid[]" value="<?php echo $cid; ?>" checked onclick="isChecked(this.checked);" /></td>
					<td><?php echo $config->getSobiStr($catTitle); ?></td>
					<td><?php echo $cid; ?></td>
					<td>
						<input style="float:right; margin-right: 10px;" type="checkbox" id="cItems<?php echo $count; ?>" name="cItems[]" value="<?php echo $cid ?>" checked onclick="isChecked(this.checked);" /></td>
				</tr>
			<?php
		}
	?>
		  </table>
	</td>
	<td style="vertical-align: top; ">
		 <?php
				if($config->useSigsiuTree) {
					ADM_SHTML_SOBI::getAjaxCatsTree($cid,true);
				}
				else {
					ADM_SHTML_SOBI::getCatsTree(ADM_SHTML_SOBI::getCatsForDtree(),$catid, true);
				}
		 ?>
	</td>
</tr>
</table>
	 	<input type='hidden' name='targetCat' id='selectedCat' value='1'/>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="catid" value="<?php echo $catid ?>" />
		<input type="hidden" name="returnTask" value="listing&amp;catid=<?php echo $catid ?>"/>
	</form>
	<?php
	}
	function addCatsSerie( $catid )
	{
    	if(defined("_JEXEC")) {
    		define("_SOBI2_ADM_PASSED", true);
    		include_once("toolbar.sobi2.php");
    	}
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="categories"><?php echo _SOBI2_TOOLBAR_ADD_CATS_SERIE?></th>
			</tr>
		</table>

		 <table style="text-align: left; width: 100%;">
		  	<tr>
		  		<td style="vertical-align: top; width: 40%;">
			  		<table class="SobiAdminList" style="float:left; clear:left; width: 100%;">
						<tr>
							<th><?php echo _SOBI2_ADD_CATS_SERIE_NAMES;?></th>
						</tr>
						<tr>
							<td><?php echo _SOBI2_ADD_CATS_SERIE_NAMES_EXPL;?></td>
						</tr>
						<tr>
							<td><textarea name="cnames" id="cnames" cols="100" rows="8" class="text_area"></textarea></td>
						</tr>
					</table>
			</td>
		</tr>
		</table>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="cid" value="<?php echo $catid ?>" />
		<input type="hidden" name="returnTask" value="listing&amp;catid=<?php echo $catid ?>"/>
	</form>
	<?php
	}
}
?>