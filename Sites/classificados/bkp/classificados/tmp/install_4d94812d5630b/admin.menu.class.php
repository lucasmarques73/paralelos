<?php
/**
* @version $Id: admin.menu.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class sobi2Menu {
    /**
     *
     * @var array
     */
    var $categoryList = array();
    /**
     *
     * @var int
     */
    var $catTreeHeight = 200;

    var $task = null;
    /**
     *
     * @return sobi2Menu
     */
    function sobi2Menu()
    {
    	$config =& adminConfig::getInstance();
    	if($config->useSigsiuTree) {
    		$config->addCustomHeadTag("<link href=\"{$config->liveSite}/components/com_sobi2/includes/com_sobi2.css\" rel=\"stylesheet\" type=\"text/css\" />");
    	}
    	else {
    		sobi2Config::import("includes|dtree.js", "adm");
    	}
		$this->task = sobi2Config::request( $_REQUEST, 'task', '' );
		switch ( $this->task ) {
			case "genConf":
			case "efConf":
			case "viewConf":
			case "payConf":
			case "langMan":
			case "editFields":
			case "registry":
			case "uninstall":
			case "recount":
				$tab = "configTab";
				break;
			case "editCSS":
			case "editTemplate":
			case "emails":
			case "editVCTemplate":
			case "editFormTemplate":
			case "templates":
				$tab = "templatesTab";
				break;
			case "pluginsManager":
			case "plugins":
				$tab = "pluginsTab";
				break;
			case "about":
			case "vercheck":
			case "errlog":
			case "eula":
			case "syscheck":
				$tab = "aboutTab";
				break;
			default:
				$tab = "listingTab";
				break;
		}
		$config->addCustomScript( "
			function initSobiMenu() {
				document.getElementById('configTab').style.display = 'none';
				document.getElementById('pluginsTab').style.display = 'none';
				document.getElementById('templatesTab').style.display = 'none';
				document.getElementById('aboutTab').style.display = 'none';
				document.getElementById('listingTab').style.display = 'none';
				document.getElementById('{$tab}').style.display = 'block';
			}
			function openMenu( tab ) {
				document.getElementById('configTab').style.display = 'none';
				document.getElementById('pluginsTab').style.display = 'none';
				document.getElementById('aboutTab').style.display = 'none';
				document.getElementById('templatesTab').style.display = 'none';
				document.getElementById('listingTab').style.display = 'none';
				document.getElementById(tab).style.display = 'block';
			}
		");
    }
    /**
     *
     */
    function showMenu()
    {
    	$config	=& adminConfig::getInstance();
    	$catId = intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) );
    	if( $catId ) {
    		$this->task = $this->task."&amp;catid=".$catId;
    	}
		$sobi2AdminUrl 					= "index2.php?option=com_sobi2";
		$notAppHref 					= $sobi2AdminUrl."&amp;task=getUnapproved";
		$addCat		 					= $sobi2AdminUrl."&amp;task=addCat&amp;returnTask={$this->task}";
		$addCats	 					= $sobi2AdminUrl."&amp;task=addCats&amp;catid={$catId}&amp;returnTask={$this->task}";
		$addEntry	 					= $sobi2AdminUrl."&amp;task=addItem&amp;returnTask={$this->task}";
		$fieldsHref 					= $sobi2AdminUrl."&amp;task=editFields";
		$genConfHref 					= $sobi2AdminUrl."&amp;task=genConf";
		$efConfHref 					= $sobi2AdminUrl."&amp;task=efConf";
		$viewConfHref 					= $sobi2AdminUrl."&amp;task=viewConf";
		$paymentOptionHref 				= $sobi2AdminUrl."&amp;task=payConf";
		$registryHref 					= $sobi2AdminUrl."&amp;task=registry";
		$cssHref 						= $sobi2AdminUrl."&amp;task=editCSS";
		$tmplHref 						= $sobi2AdminUrl."&amp;task=editTemplate";
		$aboutHref 						= $sobi2AdminUrl."&amp;task=about";
		$uninstallHref 					= $sobi2AdminUrl."&amp;task=uninstall";
		$allEntriesHref					= $sobi2AdminUrl."&amp;task=listing&amp;catid=-1";
		$langManHref 					= $sobi2AdminUrl."&amp;task=langMan";
		$mailHref 						= $sobi2AdminUrl."&amp;task=emails";
		$verHref 						= $sobi2AdminUrl."&amp;task=vercheck";
		$pluginsMan 					= $sobi2AdminUrl."&amp;task=pluginsManager";
		$errlog 						= $sobi2AdminUrl."&amp;task=errlog";
		$VCtmplHref 					= $sobi2AdminUrl."&amp;task=editVCTemplate";
		$eulaHref 						= $sobi2AdminUrl."&amp;task=eula";
		$FormtmplHref 					= $sobi2AdminUrl."&amp;task=editFormTemplate";
		$recountHref 					= $sobi2AdminUrl."&amp;task=recount";
		$syscheckHref 					= $sobi2AdminUrl."&amp;task=syscheck";
		$templates 						= $sobi2AdminUrl."&amp;task=templates";
		?>
		<a href="http://www.Sigsiu.NET" target="_blank" title="Sigsiu.NET Software Development and Webdesign">
		<img src="<?php echo $config->getLiveSite();?>/administrator/components/com_sobi2/images/logo-blue.jpg" alt="Sigsiu.NET Software Development and Webdesign" style="border-style:none;"/>
		</a>
		<div id="accordionTabs" class="menuTabs">
		      	<div class="menuTabHeader" id="listingTabHeader" onclick="openMenu('listingTab');"><div class="menuWrapper"><?php echo _SOBI2_MENU_LISTING_AND_CATS ?></div></div>
		        <div class="contentTabHeader" id="listingTab"><div class="menuWrapper">
		        		  <ul>
						    <li><a href="<?php echo $notAppHref ?>"><?php echo _SOBI2_MENU_AWAITING_APPR;?> (<?php echo $this->getNotApproved();?>)</a></li>
						    <li><a href="<?php echo $allEntriesHref ?>"><?php echo _SOBI2_LISTING_ALL_ENTRIES;?> (<?php echo $this->getAllEntries();?>)</a></li>
						    <li><a href="<?php echo $addEntry ?>"><?php echo _SOBI2_TOOLBAR_ADD_NEW_ITEM;?></a></li>
						    <li><a href="<?php echo $addCat ?>"><?php echo _SOBI2_TOOLBAR_ADD_NEW_CAT;?></a></li>
						    <li><a href="<?php echo $addCats ?>"><?php echo _SOBI2_TOOLBAR_ADD_CATS_SERIE;?></a></li>
						    <?php
					    		foreach($config->S2_plugins as $id => $plugin) {
					 				if(method_exists($plugin, "createOwnListingMenuEntry")) {
					 					$menuEntry = $plugin->createOwnListingMenuEntry();
					 					echo "\n\t<li>{$menuEntry}\n\t</li>\n";
					 				}
					    		}
						    ?>
						  </ul>
						  <hr/>
						  <?php $this->getCatTree();?>
		        </div></div>
		        <div class="menuTabHeader" id="configTabHeader" onclick="openMenu('configTab');"><div class="menuWrapper"><?php echo _SOBI2_MENU_CONFIG ?></div></div>
		        <div class="contentTabHeader" id="configTab"><div class="menuWrapper">
						  <ul>
						    <li><a href="<?php echo $fieldsHref; ?>"><?php echo _SOBI2_FIELDS_MANAGER;?></a></li>
						    <li><a href="<?php echo $genConfHref; ?>"><?php echo _SOBI2_MENU_GENERAL_CONFIG;?></a></li>
						    <li><a href="<?php echo $efConfHref; ?>"><?php echo _SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG;?></a></li>
						    <li><a href="<?php echo $viewConfHref; ?>"><?php echo _SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG;?></a></li>
						    <li><a href="<?php echo $paymentOptionHref; ?>"><?php echo _SOBI2_CONFIG_PAYMENTS_OPTIONS;?></a></li>
						    <li><a href="<?php echo $langManHref; ?>"><?php echo _SOBI2_MENU_LANG_MANAGER;?></a></li>
						    <li><a href="<?php echo $registryHref; ?>"><?php echo _SOBI2_MENU_REG_MANAGER;?></a></li>
						    <li><a href="<?php echo $recountHref; ?>"><?php echo _SOBI2_TOOLBAR_RECOUNT_CATS_F;?></a></li>
						    <li><a href="<?php echo $uninstallHref; ?>"><?php echo _SOBI2_MENU_UNINSTALL_SOBI;?></a></li>
						    <?php
					    		foreach($config->S2_plugins as $id => $plugin) {
					 				if(method_exists($plugin, "createOwnConfigMenuEntry")) {
					 					$menuEntry = $plugin->createOwnConfigMenuEntry();
					 					echo "\n\t<li>{$menuEntry}\n\t</li>\n";
					 				}
					    		}
						    ?>
						  </ul>
		        </div></div>

		        <div class="menuTabHeader" id="templatesTabHeader" onclick="openMenu('templatesTab');"><div class="menuWrapper"><?php echo _SOBI2_MENU_TEMPLATES_AND_CSS ?></div></div>
		        <div class="contentTabHeader" id="templatesTab"><div class="menuWrapper">
						  <ul>
						  	<li><a href="<?php echo $templates ?>"><?php echo _SOBI2_MENU_TEMPLATES;?></a></li>
						    <li><a href="<?php echo $tmplHref ?>"><?php echo _SOBI2_MENU_EDIT_TEMPLATE;?></a></li>
						    <li><a href="<?php echo $VCtmplHref ?>"><?php echo _SOBI2_MENU_EDIT_VC_TEMPLATE;?></a></li>
						    <li><a href="<?php echo $FormtmplHref ?>"><?php echo _SOBI2_MENU_EDIT_FORM_TEMPLATE;?></a></li>
						    <li><a href="<?php echo $cssHref ?>"><?php echo _SOBI2_MENU_EDIT_CSS;?></a></li>
						    <li><a href="<?php echo $mailHref ?>"><?php echo _SOBI2_MENU_EMAILS;?></a></li>
						    <?php
					    		foreach($config->S2_plugins as $id => $plugin) {
					 				if(method_exists($plugin, "createOwnTemplateMenuEntry")) {
					 					$menuEntry = $plugin->createOwnTemplateMenuEntry();
					 					echo "\n\t<li>{$menuEntry}\n\t</li>\n";
					 				}
					    		}
						    ?>
						  </ul>
		        </div></div>


		        <div class="menuTabHeader" id="pluginsTabHeader" onclick="openMenu('pluginsTab');"><div class="menuWrapper"><?php echo _SOBI2_MENU_PLUGINS_HEADER ?></div></div>
		        <div class="contentTabHeader" id="pluginsTab"><div class="menuWrapper">
						  <ul>
						    <li><a href="<?php echo $pluginsMan ?>"><?php echo _SOBI2_MENU_PLUGINS_MANAGER;?></a></li>
						  	<?php echo $this->getPlugins($sobi2AdminUrl); ?>
						  </ul>
		        </div></div>
 	           <div class="menuTabHeader" id="aboutTabHeader" onclick="openMenu('aboutTab');"><div class="menuWrapper"><?php echo _SOBI2_MENU_ABOUT ?></div></div>
		       <div class="contentTabHeader" id="aboutTab"><div class="menuWrapper">
						  <ul>
						    <li><a href="<?php echo $eulaHref ?>"><?php echo _SOBI2_MENU_EULA;?></a></li>
						    <li><a href="<?php echo $aboutHref ?>"><?php echo _SOBI2_MENU_ABOUT_SOBI;?></a></li>
						    <li><a href="<?php echo $verHref ?>"><?php echo _SOBI2_MENU_VER_CHECKER;?></a></li>
						    <li><a href="<?php echo $errlog ?>"><?php echo _SOBI2_MENU_ERRLOG;?></a></li>
						    <li><a href="<?php echo $syscheckHref ?>"><?php echo _SOBI2_MENU_GEN_DEB_REP;?></a></li>
						    <?php
					    		foreach($config->S2_plugins as $id => $plugin) {
					 				if(method_exists($plugin, "createOwnAboutMenuEntry")) {
					 					$menuEntry = $plugin->createOwnAboutMenuEntry();
					 					echo "\n\t<li>{$menuEntry}\n\t</li>\n";
					 				}
					    		}
						    ?>
						  </ul>
		      </div></div>
		</div>
		<br/>
		<a href="http://www.Sigsiu.NET" target="_blank" title="Sigsiu.NET Software Development and Webdesign">&copy;&nbsp;Sigsiu.NET</a>
		<script type="text/javascript">initSobiMenu();</script>
  		<?php
    }
    /**
     *
     * @param string $sobi2AdminUrl
     * @return string
     */
    function getPlugins( $sobi2AdminUrl )
    {
    	$config =& adminConfig::getInstance();
    	$list = null;
    	if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $id => $plugin) {
    			$pluginhref = "{$sobi2AdminUrl}&amp;task=plugins&S2_plugin={$id}";
    			$list .= "\n\t<li><a href='$pluginhref'>{$plugin->name}</a>\n\t</li>\n";
    		}
    		foreach($config->S2_plugins as $id => $plugin) {
 				if(method_exists($plugin, "createOwnPluginMenuEntry")) {
 					$menuEntry = $plugin->createOwnPluginMenuEntry();
 					$list .= "\n\t<li>{$menuEntry}\n\t</li>\n";
 				}
    		}
    	}
    	return $list;
    }
    /**
     *
     * @return int
     */
    function getNotApproved()
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
    	$query = "SELECT COUNT(*) FROM `#__sobi2_item` WHERE `approved` = 0";
    	$database->setQuery($query);
    	$items = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	return $items;
    }
    /**
     *
     * @return object
     */
    function getAllEntries()
    {
    	$config =& adminConfig::getInstance();
    	$database =& $config->getDb();
    	$query = "SELECT COUNT(*) FROM `#__sobi2_item`";
    	$database->setQuery($query);
    	$items = $database->loadResult();
		if($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
    	return $items;
    }
    /**
     *
     */
    function getCatTree()
    {
    	$config	=& adminConfig::getInstance();
    	$database =& $config->getDb();
		$sobi2AdminUrl = "index2.php?option=com_sobi2";
		if($config->useSigsiuTree) {
			sobi2Config::import("includes|SigsiuTree|SigsiuTree");
			$tree = new SigsiuTree($config->aTreeImages);
			$href = "index2.php?option=com_sobi2&amp;task=listing&amp;catid={cid}";
			$rootHref = "index2.php?option=com_sobi2";
			$tree->init("SigsiuTreeAdmMenu",$href,"div","SigsiuTreeAdmMenu",false,null,intval( sobi2Config::request( $_REQUEST, 'catid', 0 ) ), $rootHref);
			$SigsiuTree = $tree->getTree();
			echo $SigsiuTree;
		}
		else {
	    	$query = "SELECT  cats.catid,  parentid, name, ordering " .
	    			 "FROM `#__sobi2_cats_relations` AS rel " .
	    			 "LEFT JOIN `#__sobi2_categories` AS cats ON rel.catid = cats.catid " .
	    			 "ORDER BY cats.ordering";

	    	$database->setQuery( $query );
	    	$this->categoryList = $database->loadObjectList();
			if($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
	 		echo    "\n<div class=\"dtree\">" .
					"\n<script type='text/javascript'>" .
					"\n\t" .
					"sobi2Cats = new dTree('sobi2Cats');" .
					"\n\t" .
					"sobi2Cats.useCookies = false;" .
					"\n\t" .
					"sobi2Cats.add(0,-1,'root', '{$sobi2AdminUrl}');";

	 		if(sizeof($this->categoryList) > 0) {
		    	$this->catTreeHeight = sizeof($this->categoryList)*27;
		    	foreach($this->categoryList as $category) {
		    		if($category->parentid == 1) {
		    			$category->parentid = 0;
		    		}
					$category->name = $config->jsAddSlashes($config->getSobiStr($category->name));
		    		$href = $sobi2AdminUrl."&amp;task=listing&amp;catid={$category->catid}";
		    		echo "\n\t sobi2Cats.add({$category->catid},{$category->parentid},'{$category->name}','{$href}','','','{$config->liveSite}/administrator/components/com_sobi2/images/folder.gif' ,'{$config->liveSite}/administrator/components/com_sobi2/images/folderopen.gif');";
		    	}
	 		}
	    	echo "\n\t document.write(sobi2Cats); \n </script> \n </div>";
		}
    }
}
?>