<?php
/**
* @version $Id: admin.category.class.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
/**
 *
 */
class adminSobiCategoryHtml {
    /**
     * @param adminSobiCategory $category
     * @param string $returnTask
     * @param int $catId
     */
    function showForm( &$category, $returnTask, $catId = 0 )
    {
		$config =& adminConfig::getInstance();
		$my	= &$config->getUser();
		$mainframe	= &$config->getMainframe();
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		sobi2Config::import( 'includes|adm.helper.class', 'adm' );

    	if(defined("_JEXEC")) {
    		define("_SOBI2_ADM_PASSED", true);
    		include_once("toolbar.sobi2.php");
    	}

    	if( $config->useSigsiuTree ) {
    		$mainframe->addCustomHeadTag("<link href=\"{$config->liveSite}/components/com_sobi2/includes/com_sobi2.css\" rel=\"stylesheet\" type=\"text/css\" />");
    		adminSobiCategoryHtml::getAjaxCategories( $category );
    	}
    	else {
    		require_once( _SOBI_ADM_PATH.DS.'includes'.DS.'dtree.js.php' );
			adminSobiCategoryHtml::getCategories( $category );
    	}
		if( $category->catid ) {
			if ($category->checked_out && $category->checked_out != $my->id && $category->checked_out_time > $config->checkOutTime) {
				sobi2Config::redirect( $sobi2AdminUrl.'&amp;task='.$returnTask.'&amp;catid='.$catId, _SOBI2_CATEGORY_CHECKED_OUT );
			}
			else {
				$category->checkOutCategory($my->id);
			}
		    $title = "<small> "._SOBI2_TOOLBAR_EDIT." <small>[ {$category->name} ] </small></small>";
		}
		else {
			$category->published = 1;
			$title = "<small> "._SOBI2_ADD_NEW_CAT." </small>";
		}
    	sobi2Config::loadOverlib();
    	?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			if ( form.name.value == "" ) {
				alert("<?php echo _SOBI2_CAT_WITHOUT_NAME; ?>");
			}
			else if ( form.name.selectedCatID == "" ) {
				alert("<?php echo _SOBI2_CAT_WITHOUT_PARENT; ?>");
			}
			else {
				form.selectedCatID.disabled = false;
				submitform(pressbutton);
			}
		}
		</script>
			<form action="index2.php" method="post" name="adminForm">
			<table class="SobiAdminHeading">
				<tr>
					<th class="categories">
						<?php echo _SOBI2_CATS_MANAGER; ?>: <?php echo $title; ?>
					</th>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td valign="top" width="70%">
						<table class="SobiAdminForm">
							<tr>
								<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CAT_DETAILS; ?></th>
							</tr>
							<tr>
								<td width="30%" ><?php echo _SOBI2_CAT_NAME;?></td>
								<td width="70%" ><input class="text_area" type="text" name="name" value="<?php echo $category->name; ?>" size="30" maxlength="100" /></td>
							</tr>
							<tr>
								<td><?php echo _SOBI2_CAT_INTROTEXT; ?></td>
								<td><input class="text_area" type="text" name="introtext" value="<?php echo $category->introtext ; ?>" size="50" maxlength="100" />&nbsp;<?php echo sobiHTML::toolTip(_SOBI2_CAT_INTROTEXT_EXPL); ?></td>
							</tr>
							<tr>
								<td colspan="2" style="vertical-align:top;"><br/><?php echo _SOBI2_CAT_DESCRIPTION; ?>
								<br/><br/><?php sobi2bridge::editorArea( 'categoryDescription',   $category->description , 'categoryDescription', '100%;', '300', '60', '20' ) ; ?></td>
							</tr>
						</table>
					<?php
						if(!empty($config->S2_plugins)) {
							foreach ($config->S2_plugins as $plugin) {
								if(method_exists($plugin,"onEditCategory")) {
									$plugin->onEditCategory();
								}
							}
						}
					?>
					</td>
					<td valign="top" width="30%">
					<?php
						if ( !$category->count ) {
							$visibility = "style='display: none; visibility: hidden;'";
						} else {
							$visibility = "";
						}
						if ( $category->catid == 0 ) {
							$itemInfoVisibility = "style='display: none; visibility: hidden;'";
						} else {
							$itemInfoVisibility = "";
						}
					?>
				      <script type="text/javascript">
				      	function resethits() {
				      		document.getElementById('hits_counter').value = 0;
				      		var nullCounter = document.createTextNode('0');
				      		document.getElementById('hits').removeChild(document.getElementById('hits').firstChild);
				      		document.getElementById('hits').appendChild(nullCounter);
				      	}
				      </script>
					<table class="SobiAdminForm" width="100%">
						<tr>
							<th colspan="2">
								<?php echo _SOBI2_PUBLISHING_U; ?>
							</th>
						</tr>
						<tr>
							<td width="20%"><?php echo _SOBI2_PUBLISHED; ?>: </td>
							<td><input type="checkbox" name="published" value="1" <?php echo $category->published ? 'checked="checked"' : ''; ?> /></td>
						</tr>
						<tr>
						      <td width="20%"><div <?php echo $visibility; ?>><?php echo _SOBI2_HITS; ?>: </div></td>
						      <td><div <?php echo $visibility; ?>><b id="hits"><?php echo $category->count; ?></b></div></td>
						</tr>
					    <tr>
					      <td width="20%"></td>
					      <td>
		   					<div <?php echo $visibility; ?>>
								<input name="reset_hits" type="button" class="button" value="<?php echo _SOBI2_HITS_RESET; ?>" onclick="resethits();" />
							</div>
						  </td>
					    </tr>
					    <tr>
					      <td width="20%"><div <?php echo $itemInfoVisibility; ?>>CatID: </div></td>
					      <td><b><?php echo $category->catid; ?></b></td>
					    </tr>
					</table>
					<table class="SobiAdminForm" width="100%">
						<tr>
							<th colspan="2">
								<?php echo _SOBI2_IMAGE_U; ?>
							</th>
							<th >
								<?php echo _SOBI2_PREVIEW; ?>
							</th>
						</tr>
						<tr>
							<td style="vertical-align:top;"><label for="image"><?php echo  _SOBI2_IMAGE_U; ?>: </label></td>
							<td style="vertical-align:top;"><?php echo sobi2AdmHelper::amImages( 'image', $category->image, null, $config->catImagesFolder ); ?></td>
							<td width="30%" style="vertical-align:top; height:100px" rowspan="2">
								<br/>
								<script type="text/javascript">
								if ( document.forms[0].image.options.value!='' ){
								  jsimg='..<?php echo $config->catImagesFolder;?>' + getSelectedValue( 'adminForm', 'image' );
								} else {
								  jsimg='../images/M_images/blank.png';
								}
								document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="Preview" />');
								</script>
							</td>
						</tr>
						<tr>
							<td style="vertical-align:top;"><label for="image_position"><?php echo _SOBI2_IMAGE_POS; ?>: </label></td>
							<td style="vertical-align:top;"><?php echo sobi2AdmHelper::amPositions( 'image_position', $category->image_position, NULL, 0, 0 ); ?></td>
						</tr>
						<tr>
							<td style="vertical-align:top;"><label for="icon"><?php echo  _SOBI2_ICON; ?>: </label></td>
							<td style="vertical-align:top;"><?php echo sobi2AdmHelper::amImages( 'icon', $category->icon, null, $config->catImagesFolder ); ?>&nbsp;<label for="icon"><?php echo sobiHTML::toolTip(_SOBI2_CAT_ICON_EXPL); ?></label><br/>&nbsp;</td>
						</tr>
					</table>
					<table class='SobiAdminForm' width='100%'>
						<tr>
							<th colspan='2'><?php echo  _SOBI2_CATEGORIES_H; ?></th>
						</tr>
						<tr>
							<td colspan="2">
								<h3><?php echo  _SOBI2_SELECT_PARENT_CAT; ?></h3>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php echo  _SOBI2_SELECTED_PARENT_ID; ?>:
								<input name="selectedCatID" id="selectedCatID" class="inputbox" type="text" size="5" disabled value="<?php echo $category->parentCat; ?>"/>
							</td>
						</tr>
							<?php echo  $category->dTree; ?>
							<?php if(!$config->useSigsiuTree) { ?>
						<tr>
							<td colspan="2">
								<hr>
								<img src="<?php echo $config->liveSite; ?>/administrator/components/com_sobi2/images/parent.png">
								<?php echo _SOBI2_PARENT_CAT; ?>
								<img src="<?php echo $config->liveSite; ?>/administrator/components/com_sobi2/images/editing.png">
								<?php echo _SOBI2_EDITING_CAT; ?>
							</td>
						</tr>
							<?php } ?>
					</table>
					<table class='SobiAdminForm' width='100%'>
						<tr>
							<th colspan='2'><?php echo _SOBI2_CAT_TPL; ?></th>
						</tr>
						<tr class="row1">
							<td colspan="2">
								<h3><?php echo _SOBI2_CAT_CHOOSE_TPL; ?></h3>
							</td>
						</tr>
						<tr class="row0">
							<td colspan="2">
								<?php echo _SOBI2_CAT_CHOOSE_TPL_EXPL; ?>
							</td>
						</tr>
						<tr class="row1">
							<td width="50%"><?php echo _SOBI2_AVAILABLE_TPL; ?></td>
							<td><?php echo sobi2AdmHelper::templatesChooser( $category->tpl ); ?></td>
						</tr>
						<tr class="row0">
							<td width="50%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE; ?></td>
							<td>
							<input type="text" style="text-align: center;" class="text_area" name="lineOnSite" value="<?php echo $category->lineOnSite; ?>" size="5" maxlength="5"/>
							</td>
						</tr>
						<tr class="row1">
							<td width="50%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE; ?></td>
							<td>
							<input type="text" style="text-align: center;" class="text_area" name="itemsInLine" value="<?php echo $category->itemsInLine; ?>" size="5" maxlength="5"/>
							</td>
						</tr>

						<tr class="row0">
							<td width="50%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE; ?></td>
							<td>
							<input type="text" style="text-align: center;" class="text_area" name="catsListInLine" value="<?php echo $category->catsListInLine; ?>" size="5" maxlength="5"/>
							</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			<input type="hidden" name="categoryId" value="<?php echo $category->catid; ?>" />
			<input type="hidden" name="option" value="com_sobi2" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="hits_counter" id="hits_counter" value="<?php echo $category->count; ?>"/>
			<input type="hidden" name="editing" value="category" />
			<input type="hidden" name="catid" value="<?php echo $catId ?>" />
			<input type="hidden" name="returnTask" value="<?php echo $returnTask; ?>&amp;catid=<?php echo $catId; ?>"/>
			</form>
    	<?php
    }
   /**
    * @param adminSobiCategory $category
    */
   function getCategories( &$category )
   {
		$config =& adminConfig::getInstance();
		$database= &$config->getDb();
    	$onSelctedCatJs = "\n<script type='text/javascript'>" .
    					  "\n\t" .
    					  "function onSelectedCat(id) { " .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCatID').value = id;" .
    					  "\n\t }" .
    					  "\n\t" .
    					  "\n</script>";

    	echo $onSelctedCatJs;

    	$query = "SELECT  cats.catid,  parentid, name, ordering " .
			 "FROM `#__sobi2_cats_relations` AS rel " .
			 "LEFT JOIN `#__sobi2_categories` AS cats ON rel.catid = cats.catid " .
			 "ORDER BY cats.ordering";

    	$database->setQuery( $query );
    	$categoryList = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("getCategories: DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	$category->dTree = null;
    	if(sizeof($categoryList) > 0) {
	    	$category->dTree = $category->dTree."\n\t\t\t\t\t<tr>\n\t\t\t\t\t\t <td>";
	    	$href = "javascript:onSelectedCat(\'1\' )";
	    	$category->dTree = $category->dTree."" .
	    					"\n <br/>" .
	    					"\n<div class=\"dtree\">" .
	    					"\n<script type='text/javascript'>" .
	    					"\n\t" .
	    					"sobi2Cats = new dTree('sobi2Cats');" .
	    					"\n\t" .
	    					"sobi2Cats.add(0,-1,'root','{$href}');";

	    	foreach($categoryList as $category) {
				$category->name = $config->jsAddSlashes($config->getSobiStr($category->name));
				if($category->parentid == 1) {
					$category->parentid--;
				}
	    		$href = "javascript:onSelectedCat(\'{$category->catid}\' )";
	    		if($category->parentCat == $category->catid && $category->catid != 0) {
	    			$category->dTree = $category->dTree."\n\t sobi2Cats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/administrator/components/com_sobi2/images/parent.png' ,'{$config->liveSite}/administrator/components/com_sobi2/images/parent.png');";
	    		}
	    		elseif($category->catid == $category->catid && $category->catid != 0) {
	    			$category->dTree = $category->dTree."\n\t sobi2Cats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/administrator/components/com_sobi2/images/editing.png' ,'{$config->liveSite}/administrator/components/com_sobi2/images/editing.png');";
	    		}
	    		else {
	    			$category->dTree = $category->dTree."\n\t sobi2Cats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/components/com_sobi2/images/folder.gif' ,'{$config->liveSite}/components/com_sobi2/images/folderopen.gif');";
	    		}
	    	}
	    	$category->dTree = $category->dTree."\n\t document.write(sobi2Cats); \n </script> \n </div>" .
	    		    				"\n\t\t\t\t\t\t</td></tr>";
    	}
    }
   /**
    * Enter description here...
    *
    * @param sobi2Category $category
    */
   function getAjaxCategories( &$category )
   {
		sobi2Config::import("includes|SigsiuTree|SigsiuTree");
		$config = adminConfig::getInstance();
		$tree = new SigsiuTree($config->aTreeImages);
		$href = "javascript:onSelectedCat('{cid}')";
		$rootHref = "javascript:onSelectedCat('1')";
		$tree->init("SigsiuTreeCats",$href,"div","SigsiuTreeCats",false,null, $category->catid ,$rootHref);
		$SigsiuTree = $tree->getTree();
    	$onSelctedCatJs = "\n<script type='text/javascript'>" .
    					  "\n\t" .
    					  "function onSelectedCat(id) { " .
    					  "\n\t\t" .
    					  "document.getElementById('selectedCatID').value = id;" .
    					  "\n\t }" .
    					  "\n\t" .
    					  "\n</script>";
    	echo $onSelctedCatJs;
    	$category->dTree = $category->dTree."\n\t\t\t\t\t<tr>\n\t\t\t\t\t\t <td>{$SigsiuTree}</td></tr>";
    }
}
?>