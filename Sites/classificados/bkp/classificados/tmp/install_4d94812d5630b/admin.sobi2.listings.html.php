<?php
/**
* @version $Id: admin.sobi2.listings.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
class ADM_LHTML_SOBI {
	function getListing( &$par, $catId = 1 )
	{
		$config =& adminConfig::getInstance();
		$mainframe =& $config->getMainframe();

		?> <form action="index2.php" method="post" name="adminForm"> <?php
		$search = $mainframe->getUserStateFromRequest( "search", 'search', '' );
		$onlyStart = $mainframe->getUserStateFromRequest("onlyStart", "onlyStart", 0);
		$stateFilter = $mainframe->getUserStateFromRequest( "statefilter", "statefilter", "all" );

		$catsRows = $par->getCats($catId);
		$returnTask = "listing&amp;catid={$catId}";
		if($catId == -1) {
			$itemsRows = $par->getAllItems($search);
			$catName = _SOBI2_LISTING_ALL_ENTRIES;
		}
		else {
			$itemsRows = $par->getItems($catId,$search);
			$catName = $config->getSobiStr($par->getCatName($catId));
	 		if(!empty($config->S2_plugins)) {
	 			foreach ($config->S2_plugins as $plugin) {
	 				if(method_exists($plugin, "onAdmListingStart")) {
	 					$plugin->onAdmListingStart( $catId );
	 				}
	 			}
	 		}
		?>
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="categories"><?php echo _SOBI2_CATS_MANAGER; ?><small> [ <?php echo $catName ?> ] </small></th>
			</tr>
		</table>

		<?php
			if( count( $catsRows ) ) {
		?>
		<table class="SobiAdminList">
			<tr>
				<th width="10" align="left">
					#
				</th>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($catsRows);?>);" />
				</th>
				<th class="title">
					<?php echo _SOBI2_CAT_NAME; ?>
				</th>
				<th class="title" width="50%">
					<?php echo _SOBI2_CAT_INTROTEXT; ?>
				</th>
				<th width="5%">
					<?php echo _SOBI2_PUBLISHED; ?>
				</th>
				<th colspan="2" width="10">
					<?php echo _SOBI2_REORDER; ?>
				</th>
				<th width="10px">
					<?php echo _SOBI2_ORDER; ?>
				</th>
				<th width="1%">
					<a href="javascript: saveorder( <?php echo count($catsRows)-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
				</th>
				<th width="5%">
					CatID
				</th>
			</tr>
			<?php $par->getCatsListing($catsRows,$returnTask); ?>
		</table>

<?php 			}
							else echo _SOBI2_NO_CATS_IN_CAT;
		}
 		if(!empty($config->S2_plugins)) {
 			foreach ($config->S2_plugins as $plugin) {
 				if(method_exists($plugin, "onAdmAfterCatsListing")) {
 					$plugin->onAdmAfterCatsListing( $catId );
 				}
 			}
 		}
?>
		<br/><br/>
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th colspan="3" class="edit"><?php echo _SOBI2_LISTING_MANAGER?><small> [ <?php echo $catName ?> ] </small></th>
			</tr>
			<tr>
				<td>
					<span class="tableHeaderFilter"><?php echo _SOBI2_LISTING_FILTER; ?></span>
					<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onchange="document.adminForm.submit();" />
					<input type="checkbox" id="onlyStartSw" name="onlyStartSw" value="1"  <?php echo $onlyStart == 2 ? "checked='checked'" : null;?> onclick="if(this.checked == true) { document.getElementById('onlyStart').value = 2; } else { document.getElementById('onlyStart').value = 1; } " /><span class="tableHeaderFilter"><label for="onlyStartSw"><?php echo _SOBI2_LISTING_MANAGER_SEARCH_ONLY_START;?></label></span>
				</td>
				<td style="text-align:right">
					<?php
						$filter = array();
						$filter[] = sobiHTML::makeOption( "all", _SOBI2_LISTING_MANAGER_STATUS_FILTER_ALL );
						$filter[] = sobiHTML::makeOption( "exp", _SOBI2_LISTING_MANAGER_STATUS_FILTER_E );
						$filter[] = sobiHTML::makeOption( "pub", _SOBI2_LISTING_MANAGER_STATUS_FILTER_P );
						$filter[] = sobiHTML::makeOption( "npub", _SOBI2_LISTING_MANAGER_STATUS_FILTER_UP );
						$filter[] = sobiHTML::makeOption( "app", _SOBI2_LISTING_MANAGER_STATUS_FILTER_A );
						$filter[] = sobiHTML::makeOption( "unapp", _SOBI2_LISTING_MANAGER_STATUS_FILTER_UA );
					?>
					<span class="tableHeaderFilter"><?php echo _SOBI2_LISTING_MANAGER_STATUS_FILTER; ?></span>
					<?php echo sobiHTML::selectList( $filter, "statefilter", 'size="1" class="text_area" onchange="document.adminForm.submit();"', 'value', 'text', $stateFilter ); ?>
				</td>
				<td></td>
			</tr>
		</table>
		<?php
			if( $itemsRows ) {
		?>

		<table class="SobiAdminList">
			<tr>
				<th width="10" align="left">
					#
				</th>
				<th width="20"  align="center">
					<input type="checkbox" name="toggleItems" value="" onClick="sobi2CheckAll(<?php echo count($itemsRows);?>);" />
				</th>
				<th class="title">
					<?php echo _SOBI2_LISTING_TITLE?>
				</th>
		<?php if($catId == -1 && $par->nonFreeOptionExisting()) { ?>
				<th align="center" >
					<?php echo _SOBI2_ALL_LISTING_NON_FREE_OPT?>
				</th>
		<?php } ?>
				<th align="center">
					<?php echo _SOBI2_LISTING_ADDED?>
				</th>
				<th align="center" width="10px">
					<?php echo _SOBI2_PUBLISHED?>
				</th>
				<th align="center" width="10px">
					<?php echo _SOBI2_APPROVED?>
				</th>
		<?php if($catId != -1) { ?>
				<th align="center" colspan="2" width="5%">
					<?php echo _SOBI2_REORDER?>
				</th>
				<th align="center" width="10px">
					<?php echo _SOBI2_ORDER?>
				</th>
				<th width="10px">
					<a href="javascript: sobi2CheckAll_button( <?php echo count($itemsRows)-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
				</th>
		<?php } ?>
				<th align="center" width="5%">
					ID
				</th>
			</tr>
		<?php ADM_LHTML_SOBI::getItemsListing( $par, $itemsRows, $returnTask, $catId ); ?>
		</table>
		<?php }
		  	else {
		  		echo _SOBI2_NO_ITEMS_IN_CAT;
		  	}
		?>
		<div style="text-align:center;"><?php echo $par->pageNav->getListFooter(); ?></div>
		<?php
			if(!empty($config->S2_plugins)) {
	 			foreach ($config->S2_plugins as $plugin) {
	 				if(method_exists($plugin, "onAdmListingEnd")) {
	 					$plugin->onAdmListingEnd( $catId );
	 				}
	 			}
	 		}
		?>
		<input type="hidden" name="option" id="option" value="com_sobi2" />
		<input type="hidden" name="task" id="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="onlyStart" id="onlyStart" value="<?php echo $onlyStart; ?>" />
		<input type="hidden" name="catid" value="<?php echo $catId ?>" />
		<input type="hidden" name="returnTask" value="<?php echo $returnTask ?>"/>
		</form>
		<?php
	}
	function getCatsListing( &$par, $cats, $returnTask=null )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config =& adminConfig::getInstance();

		$count = 0;
		sobi2Config::import( 'includes|adm.helper.class', 'adm' );
		foreach($cats as $cat) {
			$count++;
			$checked 	= sobi2AdmHelper::checkedOutProcessing( $cat, ( $count - 1 ) );
			$published	= sobi2AdmHelper::publishedProcessing( $cat, ( $count - 1 ) );
			?>
				<tr class="row<?php echo $count%2;?>">
					<td>
						<?php echo $count; ?>
					</td>
					<td>
						<?php echo $checked; ?>
					</td>
					<td>
						<a href="<?php echo $sobi2AdminUrl;?>&amp;task=edit&amp;categoryId=<?php echo $cat->id; ?>&amp;hidemainmenu=1&amp;returnTask=<?php echo $returnTask; ?>">
						<?php echo $config->getSobiStr($cat->name); ?>
						</a>
					</td>
					<td>
						<?php echo $config->getSobiStr($cat->introtext); ?>
					</td>
					<td align="center">
						<?php echo $published; ?>
					</td>
					<td align="center">
						<?php echo $par->catPageNav->orderUpIcon($count-1); ?>
					</td>
					<td align="center">
						<?php echo $par->catPageNav->orderDownIcon( $count-1, count($cats) ); ?>
					</td>
					<td colspan="2">
						<input type="text" name="order[]" size="5" value="<?php echo $cat->ordering; ?>" class="text_area" style="text-align: center" />
					</td>
					<td align="center">
						<?php echo $cat->id; ?>
					</td>
				</tr>
			<?php
			unset( $cat );
		}
	}
	function getItemsListing( &$par, $items, $returnTask = null, $catId )
	{
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		$config =& adminConfig::getInstance();

		$count = 0;
		?>
		<script type="text/javascript">
			function sobi2CheckAll( n, fldName ) {
			  if (!fldName) {
			     fldName = 'sItem';
			  }
				var f = document.adminForm;
				var c = f.toggleItems.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					cb = eval( 'f.' + fldName + '' + i );
					if (cb) {
						cb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.boxchecked.value = n2;
				} else {
					document.adminForm.boxchecked.value = 0;
				}
			}
			function sobi2CheckAll_button( n ) {
				for ( var j = 0; j <= n; j++ ) {
					box = eval( "document.adminForm.sItem" + j );
					if ( box ) {
						if ( box.checked == false ) {
							box.checked = true;
						}
					} else {
						alert("cannot change the order of items, as an item in the list is `Checked Out`");
						return;
					}
				}
				submitform('saveorder');
			}
		</script>

		<?php
		foreach( $items as $item ) {
			$count++;
			$checked    = $par->CheckedOutProcessing($item, $count-1);
			$published	= $par->PublishedProcessing($item, $count-1);
			$confirmed	= $par->ConfirmedProcessing($item, $count-1);
			$approved	= $par->ApprovedProcessing($item, $count-1);
		?>

				<tr class="row<?php echo $count%2;?>">
	    				<td width="10">
	    					<?php echo sobi2bridge::pnRowNumber( $par->pageNav, ( $count - 1 ) ); ?>
	    				</td>
						<td width="20" align="center">
							<?php echo $checked; ?>
						</td>
						<td class="title">
							<a href="<?php echo $sobi2AdminUrl;?>&amp;task=edit&amp;sobi2Id=<?php echo $item->id; ?>&amp;hidemainmenu=1&amp;returnTask=<?php echo $returnTask; ?>">
							<?php echo $config->getSobiStr($item->title); ?>
							</a>
						</td>
				<?php if($catId == -1 && $par->nonFreeOptionExisting()) { ?>
						<td align="center" valign="middle">
							<?php echo $par->nonFreeOption($item->id); ?>
						</td>
				<?php } ?>
						<td align="center" width="10%">
							<?php echo $item->publish_up; ?>
						</td>
						<td align="center" width="5%">
							<?php echo $published; ?>
						</td>
						<!--
						<td align="center" width="5%">
							<?php echo $confirmed;?>
						</td>
						-->
						<td align="center" width="5%">
							<?php echo $approved; ?>
						</td>
				<?php if($catId != -1) { ?>
						<td align="center">
							<?php echo $par->orderUpIcon($count-1); ?>
						</td>
						<td align="center">
							<?php echo $par->orderDownIcon( $count-1, count($items) ); ?>
						</td>
						<td colspan="2">
							<input type="text" name="itemsOrder[]" size="5" value="<?php echo $item->ordering; ?>" class="text_area" style="text-align: center" />
						</td>
				<?php } ?>
						<td align="center" width="5%">
							<?php echo $item->id; ?>
						</td>
	    			</tr>
			<?php
		unset($item);
		}
	}
	function getUnapproved( &$par )
	{
		$itemsRows = $par->getUnapprovedItems();
		?>
		<form action="index2.php" method="post" name="adminForm">
			    		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			    			<tr>
			    				<th class="edit"><?php echo _SOBI2_UNAPPROVED_MANAGER?></th>
			    			</tr>
			    		</table>

						<?php
							if(sizeof($itemsRows) > 0) {
						?>

			    		<table class="SobiAdminList">
			    			<tr>
			    				<th width="10" align="left">
			    					#
			    				</th>
								<th width="20">
									<input type="checkbox" name="toggleItems" value="" onClick="sobi2CheckAll(<?php echo count($itemsRows);?>);" />
								</th>
								<th class="title">
									<?php echo _SOBI2_LISTING_TITLE?>
								</th>
						<?php if($par->nonFreeOptionExisting()) { ?>
								<th align="center" >
									<?php echo _SOBI2_ALL_LISTING_NON_FREE_OPT?>
								</th>
						<?php } ?>

								<th align="center" width="50px">
									<?php echo _SOBI2_LISTING_OWNER?>
								</th>
								<th align="center" width="10%">
									<?php echo _SOBI2_LISTING_OWNER_TYPE?>
								</th>
								<th align="center" width="10%">
									<?php echo _SOBI2_LISTING_ADDED?>
								</th>
								<th align="center" width="10px">
									<?php echo _SOBI2_PUBLISHED?>
								</th>
								<!--
								<th align="center" width="10px">
									<?php echo _SOBI2_CONFIRMED?>
								</th>
								-->
								<th align="center" width="10px">
									<?php echo _SOBI2_APPROVED?>
								</th>
								<th align="center" width="5%">
									ID
								</th>
			    			</tr>
			    			<?php $par->getUnapprovedListing($itemsRows); ?>
			    		</table>
						  <?php }
						  	else echo _SOBI2_NO_ITEMS_AW_APP; ?>

		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<input type="hidden" name="option" value="com_sobi2"/>
		<input type="hidden" name="returnTask" value="getUnapproved"/>
		</form>
		<?php
	}
	function getUnapprovedListing( &$par, $itemsRows )
	{
		$config			=& adminConfig::getInstance();
		$sobi2AdminUrl	= "index2.php?option=com_sobi2";

		$config =& adminConfig::getInstance();

		$returnTask = 'getUnapproved';
		$count = 0;
		?>
		<script type="text/javascript">
			function sobi2CheckAll( n, fldName ) {
			  if (!fldName) {
			     fldName = 'sItem';
			  }
				var f = document.adminForm;
				var c = f.toggleItems.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					cb = eval( 'f.' + fldName + '' + i );
					if (cb) {
						cb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.boxchecked.value = n2;
				} else {
					document.adminForm.boxchecked.value = 0;
				}
			}
			function sobi2CheckAll_button( n ) {
				for ( var j = 0; j <= n; j++ ) {
					box = eval( "document.adminForm.sItem" + j );
					if ( box ) {
						if ( box.checked == false ) {
							box.checked = true;
						}
					} else {
						alert("cannot change the order of items, as an item in the list is `Checked Out`");
						return;
					}
				}
				submitform('saveorder');
			}
		</script>

		<?php
		foreach($itemsRows as $item) {
			$count++;
			$checked    = $par->CheckedOutProcessing($item, $count-1);
			$published	= $par->PublishedProcessing($item, $count-1);
			$confirmed	= $par->ConfirmedProcessing($item, $count-1);
			$approved	= $par->ApprovedProcessing($item, $count-1);
		?>

				<tr class="row<?php echo $count%2;?>">
	    				<td width="10">
	    					<?php echo $count; ?>
	    				</td>
						<td width="20">
							<?php echo $checked; ?>
						</td>
						<td class="title">
							<a href="<?php echo $sobi2AdminUrl;?>&amp;task=edit&amp;sobi2Id=<?php echo $item->id; ?>&amp;hidemainmenu=1&amp;returnTask=<?php echo $returnTask; ?>">
							<?php echo $config->getSobiStr($item->title); ?></a>
						</td>
				<?php if($par->nonFreeOptionExisting()) { ?>
						<td align="center" valign="middle">
							<?php echo $par->nonFreeOption($item->id); ?>
						</td>
				<?php } ?>

						<td align="center" width="10%">
						<?php
							if($item->uid != 0) {
						?>
							<a href="<?php echo $config->liveSite; ?>/administrator/index2.php?option=com_users&amp;task=editA&amp;id=<?php echo $item->uid; ?>&amp;hidemainmenu=1"><?php echo $item->name; ?> (<?php echo $item->username; ?>)</a>
						<?php
							} else {
								echo _SOBI2_GUEST;
								$item->usertype = _SOBI2_GUEST;
							 }
						?>

						</td>
						<td align="center" width="10%">
							<?php echo $item->usertype; ?>
						</td>
						<td align="center" width="10%">
							<?php echo $item->publish_up; ?>
						</td>
						<td align="center" width="5%">
							<?php echo $published; ?>
						</td>
						<!--
						<td align="center" width="5%">
							<?php echo $confirmed;?>
						</td>
						-->
						<td align="center" width="5%">
							<?php echo $approved; ?>
						</td>
						<td align="center" width="5%">
							<?php echo $item->id; ?>
						</td>
	    			</tr>
			<?php
		}
	}
	function getCats( &$par, $catid = 1 )
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		if($catid == 0)
			$catid = 1;

		$query = "SELECT categories.catid as id, categories.name, published, introtext, checked_out, checked_out_time, users.name AS editor, ordering " .
				 "FROM `#__sobi2_cats_relations` AS relations " .
				 "LEFT JOIN `#__sobi2_categories` AS categories ON categories.catid = relations.catid " .
				 "LEFT JOIN #__users AS users ON users.id = categories.checked_out " .
				 "WHERE `parentid` = {$catid} " .
				 "ORDER BY {$config->catsOrdering}";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$par->catTotal 		= count($database->loadObjectList());
		$par->catPageNav 	=& sobi2bridge::jPageNav( $par->catTotal, 0, 0 );
		return $database->loadObjectList();

	}
	function getItems( &$par, $catid = 1, $search )
	{
		$config =& adminConfig::getInstance();
		$mainframe =& $config->getMainframe();
		$database =& $config->getDb();

		$limit = intval( $mainframe->getUserStateFromRequest( "limit", 'limit', $mainframe->getCfg('list_limit') ) );
		$par->limit = $limit;
		$limitstart = intval( $mainframe->getUserStateFromRequest( "limitstart", 'limitstart', 0 ) );
		$par->limitstart = $limitstart;

		$onlyStart = (int) sobi2Config::request($_REQUEST, "onlyStart", 0);
		if(!$onlyStart) {
			$onlyStart = $mainframe->getUserStateFromRequest("onlyStart","onlyStart",0);
		}
		$mainframe->setUserState("onlyStart", $onlyStart);

		$statefilter = sobi2Config::request($_REQUEST, "statefilter", 0);
		if(!$statefilter) {
			$statefilter = $mainframe->getUserStateFromRequest("statefilter","statefilter", "all");
		}
		$mainframe->setUserState("statefilter", $statefilter);

		switch ( $statefilter ) {
			case "exp":
				$statefilter = "AND ( items.publish_down < '{$now}' AND  items.publish_down != '{$null}' ) ";
				break;
			case "pub":
				$statefilter = "AND items.published = 1 AND ( items.publish_down > '{$now}' OR items.publish_down = '{$null}' ) ";
				break;
			case "npub":
				$statefilter = "AND ( items.published = 0 OR ( items.publish_down < '{$now}' AND  items.publish_down != '{$null}' ) )";
				break;
			case "app":
				$statefilter = "AND items.approved = 1";
				break;
			case "unapp":
				$statefilter = "AND items.approved = 0";
				break;
			default:
				$statefilter =null;
				break;
		}
		if( $search ) {
			if($onlyStart == 2) {
				$and = "AND `title` RLIKE '^{$search}'";
			}
			else {
				$and = "AND `title` LIKE '%{$search}%'";
			}
		}
		else {
			$and = null;
		}
		if($catid == 0) {
			$catid = 1;
		}
		$query = "SELECT items.itemid as id " .
				 "FROM `#__sobi2_cat_items_relations` AS relations " .
				 "LEFT JOIN `#__sobi2_item` AS items ON items.itemid = relations.itemid ".
				 "WHERE `catid` = {$catid} {$and} {$statefilter} " .
				 "ORDER BY relations.ordering";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$total = sizeof($database->loadObjectList());
		$par->total = $total;
		$par->pageNav =& sobi2bridge::jPageNav( $total, $limitstart, $limit );
		if( !$limit ) {
			$l = null;
		}
		else {
			$l = "LIMIT {$limitstart} , {$limit} ";
		}
		$query = "SELECT items.itemid as id, title, published, confirm, approved, publish_up , publish_down, checked_out, relations.ordering, " .
				 "checked_out_time, editor.name as editor " .
				 "FROM `#__sobi2_cat_items_relations` AS relations " .
				 "LEFT JOIN `#__sobi2_item` AS items ON items.itemid = relations.itemid " .
				 "LEFT JOIN #__users AS editor ON items.checked_out = editor.id ".
				 "WHERE `catid` = {$catid} {$and} {$statefilter} " .
				 "ORDER BY relations.ordering {$l}";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $database->loadObjectList();

	}
	function getAllItems( &$par, $search )
	{
		$config =& adminConfig::getInstance();
		$mainframe =& $config->getMainframe();
		$database =& $config->getDb();
		$limit = intval( $mainframe->getUserStateFromRequest( "limit", 'limit', $mainframe->getCfg('list_limit') ) );
		$par->limit = $limit;

		$limitstart = intval( $mainframe->getUserStateFromRequest( "limitstart", 'limitstart', 0 ) );
		$par->limitstart = $limitstart;
		$onlyStart = (int) sobi2Config::request($_REQUEST, "onlyStart", 0);

		if(!$onlyStart) {
			$onlyStart = $mainframe->getUserStateFromRequest("onlyStart","onlyStart",0);
		}
		$mainframe->setUserState("onlyStart", $onlyStart);
		$mainframe->setUserState("onlyStart", $onlyStart);

		$statefilter = sobi2Config::request($_REQUEST, "statefilter", 0);
		if(!$statefilter) {
			$statefilter = $mainframe->getUserStateFromRequest("statefilter","statefilter", "all");
		}
		$mainframe->setUserState("statefilter", $statefilter);

		$now = $config->getTimeAndDate();
		$null = $config->getNullDate();
		switch ( $statefilter ) {
			case "exp":
				$statefilter = "AND ( items.publish_down < '{$now}' AND items.publish_down != '{$null}' ) ";
				break;
			case "pub":
				$statefilter = "AND items.published = 1 AND ( items.publish_down > '{$now}' OR items.publish_down = '{$null}' ) ";
				break;
			case "npub":
				$statefilter = "AND ( items.published = 0 OR ( items.publish_down < '{$now}' AND  items.publish_down != '{$null}' ) )";
				break;
			case "app":
				$statefilter = "AND items.approved = 1";
				break;
			case "unapp":
				$statefilter = "AND items.approved = 0";
				break;
			default:
				$statefilter =null;
				break;
		}

		if($search) {
			if($onlyStart == 2) {
				$where = "AND `title` RLIKE '^{$search}'";
			}
			else {
				$where = "AND `title` LIKE '%{$search}%'";
			}
		}
		else {
			$where = null;
		}
		$query = "SELECT items.itemid as id " .
				 "FROM `#__sobi2_item` AS items WHERE items.itemid > 0 {$where} {$statefilter} ".
				 "ORDER BY items.publish_up";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$total = sizeof($database->loadObjectList());
		$par->total = $total;
		$par->pageNav =& sobi2bridge::jPageNav( $total, $limitstart, $limit );
		if( !$limit ) {
			$l = null;
		}
		else {
			$l = "LIMIT {$limitstart} , {$limit} ";
		}
		$query = "SELECT items.itemid as id, title, published, confirm, approved, publish_up, publish_down, checked_out, " .
				 "checked_out_time, editor.name as editor " .
				 "FROM `#__sobi2_item` AS items  " .
				 "LEFT JOIN #__users AS editor ON items.checked_out = editor.id WHERE items.itemid > 0 {$where} {$statefilter} ".
				 "ORDER BY items.publish_up {$l}";
		$database->setQuery( $query );
		$r = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $r;

	}
	function getUnapprovedItems()
	{
		$config =& adminConfig::getInstance();
		$database =& $config->getDb();
		$query = "SELECT itemid as id, title, published, confirm, approved, publish_up, publish_down, checked_out, " .
				"users.name, users.username, users.usertype, users.id as uid, checked_out_time, editor.name as editor " .
				"FROM `#__sobi2_item` AS items LEFT JOIN #__users AS users ON items.owner = users.id " .
				"LEFT JOIN #__users AS editor ON items.checked_out = editor.id WHERE `approved` = 0";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		return $database->loadObjectList();
	}

}
?>