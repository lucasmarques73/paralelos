<?php
/**
* @version $Id: about.php 4820 2009-01-05 11:46:25Z Radek Suski $
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

    function aboutSobi()
    {
		$config =& adminConfig::getInstance();
		$rssAddShop = "http://shop.sigsiu.net/shop/rssfeed/";
		$rssAddPlugs = "http://www.sigsiu.net/download/plugins/rss";
		$rssAddMods = "http://www.sigsiu.net/download/modules/rss";
		$rssAddBots = "http://www.sigsiu.net/download/bots/rss";
		$rssAddTemplates = "http://www.sigsiu.net/download/templates/rss";
		$rssAddTools = "http://www.sigsiu.net/download/tools/rss";
		$rssAddLangs = "http://www.sigsiu.net/download/languages/rss";
		$rssSigsiu = "http://www.sigsiu.net/index.php?option=com_rd_rss&id=2";
    	$tabs = new sobiTabs( true );
		$tabs->startPane("aboutsobi");
		$tabs->startTab(_SOBI2_MENU_ABOUT_SOBI,"about");
		if(file_exists( _SOBI_ADM_PATH.DS."includes".DS."about".DS."{$config->sobi2Language}.html" )) {
			include_once( _SOBI_ADM_PATH.DS."includes".DS."about".DS."{$config->sobi2Language}.html" );
		}
		else {
			include_once(_SOBI_ADM_PATH.DS."includes".DS."about".DS."english.html");
		}
		$tabs->endTab();
		$tabs->startTab(_SOBI2_ABOUT_ADDONS,"addons");

		?>
		<form action="index2.php" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
		<table class="SobiAdminForm" border="1" width="100%">
		<?php

		sobi2Config::import("includes|xml_domit|xml_domit_rss_lite", "adm");
		$rssdoc = new xml_domit_rss_document_lite( $rssAddShop, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td width="30%" style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td style="vertical-align: top;">
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddPlugs, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddMods, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddBots, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddTemplates, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddLangs, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		$rssdoc = new xml_domit_rss_document_lite( $rssAddTools, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td>
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		?></table><?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_ABOUT_PBY,"pby");
		?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_ABOUT_PBY; ?></th>
		    </tr>
		    <tr class="row1">
		      <td valign="top" colspan="2">
				<?php echo _SOBI2_ABOUT_PBY_SUPPORT; ?>
		      </td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      		<?php echo _SOBI2_ABOUT_PBY_SHOW ;?>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('pby', 'class="inputbox" onclick="if(this.value == 0) alert(\''._SOBI2_ABOUT_PBY_JS_SUPPORT.'\')"', $config->pby );?></td>
		    </tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_ABOUT_NEWS,"news");
		?><table class="SobiAdminForm" border="1" width="100%"><?php
		$rssdoc = new xml_domit_rss_document_lite( $rssSigsiu, _SOBI_CMSROOT.DS."cache".DS );
		$totalChannels = $rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) {
			$currChannel = $rssdoc->getChannel($i);
			?>
			    <tr>
			    	<th colspan="2" style="text-align:left;">
			    		RSS [<small>&nbsp;
			    		<a style="color:#E0E0FF;" href="<?php echo $currChannel->getLink();?>" title="<?php echo $currChannel->getTitle(); ?>" target="_blank">
			    		<?php echo $currChannel->getTitle(); ?>
			    		</a>
			    		&nbsp;</small>]
			    	</th>
			    </tr>
			<?php
			$totalItems = $currChannel->getItemCount();
			for ($j = 0; $j < $totalItems; $j++) {
				$currItem = $currChannel->getItem($j);
				?>
					<tr class="row<?php echo $j%2;?>">
						<td width="30%" style="vertical-align: top;">
							<a href="<?php echo $currItem->getLink();?>" target="_blank"> <?php echo $currItem->getTitle()?></a>
						</td>
						<td style="vertical-align: top;">
							<?php echo $currItem->getDescription();?>
						</td>
					</tr>
				<?php
			}
		}
		?></table><?php
		$tabs->endTab();

		?>
		<input type="hidden" name="option" id="option" value="com_sobi2" />
		<input type="hidden" name="returnTask" value="about"/>
		<input type="hidden" name="task" id="task" value="" />
    	</form>
    <?php
    }
	function uninstallSOBI( )
	{
	$href = adminConfig::fixLink( 'index2.php?option=com_sobi2&task=removeDB' );
		echo _SOBI2_UNINSTALL_DB_TXT;
	?>
	<form action="index2.php" method="post" enctype='multipart/form-data' name="adminForm">
		<div style="text-align:left;">
  			<input style="font-weight: bold; color: rgb(255, 0, 0); " class="button" onclick="if(window.confirm('<?php echo _SOBI2_UNINSTALL_DB_CONFIRM; ?>')) window.location='<?php echo $href; ?>';" type="button" name="<?php echo _SOBI2_UNINSTALL_DB_LINK; ?>" value="<?php echo _SOBI2_UNINSTALL_DB_LINK; ?>"/>
		</div>
		<input type="hidden" name="option" value="com_sobi2" />
		<input type="hidden" name="task" value="" />
	</form>
	<?php
    }
?>