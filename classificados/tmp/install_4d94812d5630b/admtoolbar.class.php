<?php
/**
* @version $Id: admtoolbar.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
* Based on mosMenuBar from Mambo / Joomla
*/
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobiAdmToolbar {

	/**
	* Writes the start of the button bar table
	*/
	function startTable() {
		?>
		<table cellpadding="0" cellspacing="0" border="0" id="sobitoolbar" style="float:right">
		<tr valign="middle" align="center">
		<?php
	}

	/**
	* Writes a custom option and task button for the button bar
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	function custom( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
		$icon 	= ( $iconOver ? $iconOver : $icon );
		$image = sobiAdmToolbar::checkImage( $icon, $alt );
		if ($listSelect) {
			$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{submitbutton('$task')}";
		} else {
			$href = "javascript:submitbutton('$task')";
		}

		if ($icon && $iconOver) {
			?>
			<td><p class="tableCell">
				<a href="<?php echo $href;?>">
					<?php echo $image; ?><br /><?php echo $alt; ?></a>
			</p></td>
			<?php
		} else {
			?>
			<td><p class="tableCell">
				<a href="<?php echo $href;?>"><br /><?php echo $alt; ?></a>
			</p></td>
			<?php
		}
	}
	function checkImage( $icon, $alt ) {
		if(eregi("msie",$_SERVER['HTTP_USER_AGENT']) && !eregi("opera",$_SERVER['HTTP_USER_AGENT'])) {
			$val = explode(" ",stristr($_SERVER['HTTP_USER_AGENT'],"msie"));
            $browser = $val[0];
            $version = $val[1];
			if(strtoupper($browser) == "MSIE") {
				$version = ereg_replace("[^0-9]", "", $version);
				if($version <= 60) {
					$image 	= '<img src="components/com_sobi2/images/toolbar/blank.gif" style="width: 100px; height: 100px; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'components/com_sobi2/images/toolbar/'.$icon.'\'", sizingMethod=\'scale\')" />';
				}
				else {
					$image 	= '<img src="components/com_sobi2/images/toolbar/'.$icon.'" alt="'.$alt.'" />';
				}
			}
		}
		else {
			$image 	= '<img src="components/com_sobi2/images/toolbar/'.$icon.'" alt="'.$alt.'" />';
		}
		return $image;
	}
	/**
	* Writes a custom option and task button for the button bar.
	* Extended version of custom() calling hideMainMenu() before submitbutton().
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	function customX( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
		$icon 	= ( $iconOver ? $iconOver : $icon );
		$image = sobiAdmToolbar::checkImage( $icon, $alt );

		if ($listSelect) {
			$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to $alt');}else{hideMainMenu();submitbutton('$task')}";
		} else {
			$href = "javascript:hideMainMenu();submitbutton('$task')";
		}

		if ($icon && $iconOver) {
			?>
			<td><p class="tableCell">
				<a href="<?php echo $href;?>">
					<?php echo $image; ?>
					<br /><?php echo $alt; ?></a>
			</p></td>
			<?php
		} else {
			?>
			<td><p class="tableCell">
				<a href="<?php echo $href;?>">
					<br /><?php echo $alt; ?></a>
			</p></td>
			<?php
		}
	}
	/**
	* Writes a media_manager button
	* @param string The sub-drectory to upload the media to
	*/
	function media_manager( $directory='', $alt='Upload' ) {
    	$config 					=& adminConfig::getInstance();
		$mainframe					= &$config->getMainframe();
		$cur_template = $mainframe->getTemplate();
		$icon =  'upload.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="#" onclick="popupWindow('popups/uploadimage.php?directory=<?php echo $directory; ?>&amp;t=<?php echo $cur_template; ?>','win1',250,100,'no');">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</p></td>
		<?php
	}

	/**
	* Writes the common 'new' icon for the button bar
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function addNew( $task='new', $alt='New' ) {
		$icon =  'new.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes the common 'new' icon for the button bar.
	* Extended version of addNew() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function addNewX( $task='new', $alt='New' ) {
		$icon =  'new.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:hideMainMenu();submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'publish' button
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function publish( $task='publish', $alt='Publish' ) {
		$icon =  'publish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'publish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function publishList( $task='publish', $alt='Publish' ) {
		$icon =  'publish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
	 	<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to publish'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
	 	<?php
	}

	/**
	* Writes a common 'default' button for a record
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function makeDefault( $task='default', $alt='Default' ) {
		$icon =  'publish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item to make default'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'assign' button for a record
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function assign( $task='assign', $alt='Assign' ) {
		$icon =  'publish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item to assign'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'unpublish' button
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function unpublish( $task='unpublish', $alt='Unpublish' ) {
		$icon =  'unpublish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'unpublish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function unpublishList( $task='unpublish', $alt='Unpublish' ) {
		$icon =  'unpublish.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to unpublish'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'archive' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function archiveList( $task='archive', $alt='Archive' ) {
		$icon =  'archive.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to archive'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes an unarchive button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function unarchiveList( $task='unarchive', $alt='Unarchive' ) {
		$icon =  'upload.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a news story to unarchive'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editList( $task='edit', $alt='Edit' ) {
		$icon =  'edit.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a list of records.
	* Extended version of editList() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editListX( $task='edit', $alt='Edit' ) {
		$icon =  'edit.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template html
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editHtml( $task='edit_source', $alt='Edit&nbsp;HTML' ) {
		$icon =  'html.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template html.
	* Extended version of editHtml() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editHtmlX( $task='edit_source', $alt='Edit&nbsp;HTML' ) {
		$icon =  'html.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}"">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template css
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editCss( $task='edit_css', $alt='Edit&nbsp;CSS' ) {
		$icon =  'css.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {submitbutton('<?php echo $task;?>', '');}"">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template css.
	* Extended version of editCss() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function editCssX( $task='edit_css', $alt='Edit&nbsp;CSS' ) {
		$icon =  'css.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select an item from the list to edit'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'delete' button for a list of records
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function deleteList( $msg='', $task='remove', $alt='Delete' ) {
		$icon =  'trash.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items? <?php echo $msg;?>')){ submitbutton('<?php echo $task;?>');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a common 'delete' button for a list of records.
	* Extended version of deleteList() calling hideMainMenu() before submitbutton().
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function deleteListX( $msg='', $task='remove', $alt='Delete' ) {
		$icon =  'trash.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items? <?php echo $msg;?>')){ hideMainMenu();submitbutton('<?php echo $task;?>');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Write a trash button that will move items to Trash Manager
	*/
	function trash( $task='remove', $alt='Trash', $check=true ) {
		$icon =  'trash.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );

		if ( $check ) {
			$js = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to Trash'); } else { submitbutton('$task');}";
		} else {
			$js = "javascript:submitbutton('$task');";
		}

		?>
		 <td><p class="tableCell">
			<a href="<?php echo $js; ?>">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a preview button for a given option (opens a popup window)
	* @param string The name of the popup file (excluding the file extension)
	*/
	function preview( $popup='', $updateEditors=false,  $alt = null ) {
    	$config 					=& sobi2Config::getInstance();
		$database					= &$config->getDb();
		$icon =  'preview.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt = null );

		$sql = "SELECT template"
		. "\n FROM #__templates_menu"
		. "\n WHERE client_id = 0"
		. "\n AND menuid = 0";
		$database->setQuery( $sql );
		$cur_template = $database->loadResult();
		?>
		<td><p class="tableCell">
			<script type="text/javascript">
			<!--
			function popup() {
				<?php
				if ($updateEditors) {
					getEditorContents( 'editor1', 'introtext' );
					getEditorContents( 'editor2', 'fulltext' );
				}
				?>
				window.open('popups/<?php echo $popup;?>.php?t=<?php echo $cur_template; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
			}
			//-->
			</script>
		 	<a href="#" onclick="popup();">
				<?php echo $image2; ?>
				<br />Preview</a>
		</p></td>
		<?php
	}

	/**
	* Writes a preview button for a given option (opens a popup window)
	* @param string The name of the popup file (excluding the file extension for an xml file)
	* @param boolean Use the help file in the component directory
	*/
	function help( $ref, $com=false,  $alt = null ) {
		$config =& adminConfig::getInstance();
		$icon =  'help.png';
		$image2 = sobiAdmToolbar::checkImage( $icon,  $alt = null );
		$helpUrl 	= sobi2Config::request( $GLOBALS, 'mosConfig_helpurl', '' );

		if ( $helpUrl == 'http://help.mamboserver.com' ) {
			$helpUrl = 'http://help.joomla.org';
		}

		if ($com) {
	   // help file for 3PD Components
			$url = $config->liveSite . '/administrator/components/' . $GLOBALS['option'] . '/help/';
			if (!eregi( '\.html$', $ref ) && !eregi( '\.xml$', $ref )) {
				$ref = $ref . '.html';
			}
			$url .= $ref;
		} else if ( $helpUrl ) {
	   // Online help site as defined in GC
			$ref .= $GLOBALS['_VERSION']->getHelpVersion();
			$url = $helpUrl . '/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=' . urlencode( $ref );
		} else {
	   // Included html help files
			$url = $config->liveSite . '/help/';
			if (!eregi( '\.html$', $ref ) && !eregi( '\.xml$', $ref )) {
				$ref = $ref . '.html';
			}
			$url .= $ref;
		}
		?>
		<td><p class="tableCell">
			<a href="#" onclick="window.open('<?php echo $url;?>', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');">
				<?php echo $image2; ?>
				<br />Help</a>
		</p></td>
		<?php
	}

	/**
	* Writes a save button for a given option
	* Apply operation leads to a save action only (does not leave edit mode)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function apply( $task='apply', $alt='Apply' ) {
		$icon =  'apply.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a save button for a given option
	* Save operation leads to a save and then close action
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function save( $task='save', $alt='Save' ) {
		$icon =  'save.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a save button for a given option (NOTE this is being deprecated)
	*/
	function savenew(  $alt = null ) {
		$icon =  'save.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('savenew');">
				<?php echo $image2; ?>
				<br />Save</a>
		</p></td>
		<?php
	}

	/**
	* Writes a save button for a given option (NOTE this is being deprecated)
	*/
	function saveedit(  $alt = null ) {
		$icon =  'save.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('saveedit');">
				<?php echo $image2; ?>
				<br />Save</a>
		</p></td>
		<?php
	}

	/**
	* Writes a cancel button and invokes a cancel operation (eg a checkin)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	function cancel( $task='cancel', $alt='Cancel' ) {
		$icon =  'close.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		?>
		<td><p class="tableCell">
			<a href="javascript:submitbutton('<?php echo $task;?>');">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</p></td>
		<?php
	}

	/**
	* Writes a cancel button that will go back to the previous page without doing
	* any other operation
	*/
	function back( $alt='Back', $href='' ) {
		$icon =  'back.png';
		$image2 = sobiAdmToolbar::checkImage( $icon, $alt );
		if ( $href ) {
			$link = $href;
		} else {
			$link = 'javascript:window.history.back();';
		}
		?>
		<td><p class="tableCell">
			<a href="<?php echo $link; ?>">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</p></td>
		<?php
	}

	/**
	* Write a divider between menu buttons
	*/
	function divider() {
		$icon =  'menu_divider.png';
		$image	= '<img src="components/com_sobi2/images/toolbar/'.$icon.'" alt=""/>';
		?>
		<td>
			<?php echo $image; ?>
		</td>
		<?php
	}

	/**
	* Writes a spacer cell
	* @param string The width for the cell
	*/
	function spacer( $width='' ) {
		if ($width != '') {
			?>
			<td width="<?php echo $width;?>">&nbsp;</td>
			<?php
		} else {
			?>
			<td>&nbsp;</td>
			<?php
		}
	}

	/**
	* Writes the end of the menu bar table
	*/
	function endTable() {
		?>
		</tr>
		</table>
		<?php
	}
}
?>