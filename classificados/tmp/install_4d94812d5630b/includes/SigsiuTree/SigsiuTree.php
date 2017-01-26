<?php
/**
* @version $Id: SigsiuTree.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class SigsiuTree {
	/**
	 * array with all needed images
	 *
	 * @var array
	 */
	var $images = array(
							"root" => "components/com_sobi2/images/base.gif",
							"join" => "components/com_sobi2/images/join.gif",
							"joinBottom" => "components/com_sobi2/images/joinbottom.gif",
							"plus" => "components/com_sobi2/images/plus.gif",
							"plusBottom" => "components/com_sobi2/images/plusbottom.gif",
							"minus" => "components/com_sobi2/images/minus.gif",
							"minusBottom" => "components/com_sobi2/images/minusbottom.gif",
							"folder" => "components/com_sobi2/images/folder.gif",
							"folderOpen" => "components/com_sobi2/images/folderopen.gif",
							"line" => "components/com_sobi2/images/line.gif",
							"empty" => "components/com_sobi2/images/empty.gif"
						);
	/**
	 * cats tree
	 *
	 * @var string
	 */
	var $tree = null;
	/**
	 * task
	 *
	 * @var string
	 */
	var $task = null;

	/**
	 * constructor
	 *
	 * @param array $images
	 * @return SigsiuTree
	 */
	function SigsiuTree($images = null)
	{
    	$config =& sobi2Config::getInstance();
		if($images && is_array($images)) {
			foreach ($images as $img => $loc) {
				if(file_exists(_SOBI_CMSROOT.DS.$loc)) {
					$this->images[$img] = $loc;
				}
			}
		}
		foreach ($this->images as $img => $loc) {
			$this->images[$img] = "{$config->liveSite}/{$loc}";
		}
	}
	/**
	 * init tree
	 *
	 * @param string $link
	 * @param string $specialLink
	 * @param string $tag
	 * @param integer $id
	 * @param boolean $sef
	 * @return string $tree
	 */
	function init($task = "SigsiuTree", $link = "{sobi2}&amp;catid={cid}&amp;Itemid={Itemid}", $tag = "div", $id = "sobiCats", $sef = true, $specialLink = null, $catId = 0, $rootLink = null)
	{
    	$config =& sobi2Config::getInstance();
		$mainframe = &$config->getMainframe();
    	$this->task = $task;
    	$root = $this->getCategories(1);
    	$tree = null;
    	$tree .= "\n\t<{$tag} class=\"sigsiuTree\">";
    	if($rootLink) {
    		$rootCat = new stdClass();
			$rootCat->catid = 1;
			$rootCat->parentid = 0;
			$rootCat->name = _SOBI2_CATEGORIES_H;
			$rootCat->introtext = null;
			$rootCat->ordering = 0;
    		$rootLink = $this->parseLink($rootLink,$rootCat,$sef);
    		$tree .= "\n\t\t<{$tag} class=\"sigsiuTreeNode\"><a href=\"{$rootLink}\" id=\"{$id}_imgFolderUrl0\"><img id=\"{$id}0\" src=\"{$this->images['root']}\" alt=\"\"/></a><a href=\"{$rootLink}\" class = \"treeNode\" id=\"{$id}_CatUrl0\">"._SOBI2_CATEGORIES_H."</a></{$tag}>";
    	}
    	else {
    		$tree .= "\n\t\t<{$tag} class=\"sigsiuTreeNode\"><img id=\"{$id}0\" src=\"{$this->images['root']}\" alt=\"\"/>"._SOBI2_CATEGORIES_H."</{$tag}>";
    	}
    	$tree .= "\n\t\t<{$tag} id=\"{$id}\" class=\"clip\" style=\"display: block;\">";
    	$countNodes = count($root,0);
		$lastNode = 0;
		$matrix = null;
    	foreach ($root as $cat) {
    		$countNodes --;
			$cat->name = $this->cleanString($cat->name, false);
			$cat->introtext = $this->cleanString($cat->introtext);
    		$url = $this->parseLink($link, $cat, $sef);
    		$hasChilds = $config->catHasChild($cat->catid);
    		$tree .= "\n\t\t\t<{$tag} class=\"sigsiuTreeNode\">";
    		if($hasChilds) {
				if($specialLink) {
					$url = $this->parseLink($specialLink,$cat,$sef);
				}
    			if($countNodes == 0) {
					$tree .= "\n\t\t\t\t\t<a href=\"javascript:stmExpand({$cat->catid},0);\" id=\"{$id}_imgUrlExpand{$cat->catid}\">\n\t\t\t\t\t\t<img src=\"{$this->images['plusBottom']}\" id=\"{$id}_imgExpand{$cat->catid}\"  style=\"border-style:none;\" alt=\"expand\"/>\n\t\t\t\t\t</a>";
					$matrix .= "\n\t\t\t smtImgMatrix[{$cat->catid}] = new Array('plusBottom');";
				}
				else {
    				$tree .= "\n\t\t\t\t\t<a href=\"javascript:stmExpand({$cat->catid},0);\" id=\"{$id}_imgUrlExpand{$cat->catid}\">\n\t\t\t\t\t\t<img src=\"{$this->images['plus']}\" id=\"{$id}_imgExpand{$cat->catid}\"  style=\"border-style:none;\" alt=\"expand\"/>\n\t\t\t\t\t</a>";
    				$matrix .= "\n\t\t\t smtImgMatrix[{$cat->catid}] = new Array('plus');";
				}
    		}
    		else {
				if($countNodes == 0) {
					$tree .= "\n\t\t\t\t\t<img src=\"{$this->images['joinBottom']}\" style=\"border-style:none;\" id=\"{$id}_imgJoin{$cat->catid}\" alt=\"\"/>";
					$matrix .= "\n\t\t\t smtImgMatrix[{$cat->catid}] = new Array('join');";
				}
				else {
					$tree .= "\n\t\t\t\t\t<img src=\"{$this->images['join']}\" style=\"border-style:none;\" id=\"{$id}_imgJoin{$cat->catid}\" alt=\"\"/>";
					$matrix .= "\n\t\t\t smtImgMatrix[{$cat->catid}] = new Array('joinBottom');";
				}
    		}
    		if($countNodes == 0) {
    			$lastNode = $cat->catid;
    		}
    		$cat->name = str_replace("\\", "",$cat->name);
    		$tree .= "\n\t\t\t\t\t<a href=\"{$url}\" id=\"{$id}_imgFolderUrl{$cat->catid}\">\n\t\t\t\t\t\t<img src=\"{$this->images['folder']}\" style=\"border-style:none;\" id=\"{$id}_imgFolder{$cat->catid}\" alt=\"\"/>\n\t\t\t\t\t</a>\n\t\t\t\t\t<a href=\"{$url}\" class = \"treeNode\" id=\"{$id}_CatUrl{$cat->catid}\">\n\t\t\t\t\t\t{$cat->name}\n\t\t\t\t\t</a>";
    		$tree .= "\n\t\t\t</{$tag}>";
    		if($hasChilds) {
    			$tree .= "\n\t\t\t<{$tag} id=\"{$id}_childsContainer{$cat->catid}\" class=\"clip\" style=\"display: block; display:none;\"></{$tag}>";
    		}
    	}
    	$tree .= "\n\t\t</{$tag}>";
    	$tree .= "\n\t</{$tag}>\n\n";

    	$parents = array();
    	if( $config->key( "general", "sigsiutree_adm_auto_exp") ) {
	    	$parents = array();
	    	if($catId) {
				$this->getParentCats( $catId,$parents );
				$parents = array_reverse( $parents );
	    	}
	    	if($parents) {
	    		$tree .= '<script type="text/javascript">';
	    		$tree .= "\n\t\t\t for(a = 0; a < smtParents.length - 1; a++) { ";
	    		$tree .= "\n\t\t\t\t t = 300 * a;";
	    		$tree .= "\n\t\t\t\t window.setTimeout('stmExpand(' + smtParents[a] + ', ' + a + ');', t );";
	    		$tree .= "\n\t\t\t }";
	    		$tree .= "</script>";
	    	}
    	}
		if(defined("_SOBI2_ADMIN") && defined("_SOBI_MAMBO")) {
    		echo $this->createHeader($id, $tag, $lastNode,$matrix,$parents);
		}
		else {
			$mainframe->addCustomHeadTag($this->createHeader($id, $tag, $lastNode,$matrix,$parents));
		}
    	$this->tree = $tree;
	}
	/**
	 * returning information about subcats in XML format
	 *
	 * @param int $catid
	 * @param string $link
	 * @param string $specialLink
	 * @param string $tag
	 * @param boolean $sef
	 */
	function addNodes($catid, $link = "{sobi2}&amp;catid={cid}&amp;Itemid={Itemid}", $tag = "div", $sef = true, $specialLink = null)
	{
    	$config =& sobi2Config::getInstance();
		// setting error reportiing to off because every warning or notice destroying the xml declaration
		error_reporting(E_ERROR);
		$childs = $this->getCategories($catid);
		$iso = explode( '=', _ISO );
		$iso = strtoupper($iso[1]);
		/* the @ operator seems not to work correctly ... */
		$ErrorReporting = error_reporting( E_ERROR );
		while ( @ob_end_clean() );
		error_reporting( $ErrorReporting );
		header('Content-type: application/xml');
		echo "<?xml version=\"1.0\" encoding=\"{$iso}\"?>";
		echo "\n<root>";
		if(count($childs)) {
			foreach ($childs as $cat) {
				$hasChilds = $config->catHasChild($cat->catid) ? 1 : 0;
				$cat->name = $this->cleanString($cat->name);
				$cat->introtext = $this->cleanString($cat->introtext);
				if($hasChilds && $specialLink) {
					$url = $this->parseLink($specialLink,$cat,$sef);
				}
				else {
					$url = $this->parseLink($link,$cat,$sef);
				}
				echo "\n\t <category>";
				echo "\n\t\t <catid>{$cat->catid}</catid>";
				echo "\n\t\t <name>{$cat->name}</name>";
				echo "\n\t\t <introtext>{$cat->introtext}</introtext>";
				echo "\n\t\t <parentid>{$cat->parentid}</parentid>";
				echo "\n\t\t <childs>{$hasChilds}</childs>";
				echo "\n\t\t <url>{$url}</url>";
				echo "\n\t </category>";
			}
		}
		echo "\n</root>";
		/* we don't need any others information so we can go out */
		exit();
	}
	/**
	 * returning subcategories info
	 *
	 * @param integer $parent
	 * @return array
	 */
	function getCategories($parent = 1)
	{
    	$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$published = null;
		if($parent < 1) {
			$parent = 1;
		}
		if(!(defined('_SOBI2_ADMIN')))  {
			$published = " published = 1 AND ";
		}
		$query = "SELECT `#__sobi2_cats_relations`.catid " .
    			 "FROM `#__sobi2_cats_relations` " .
    			 "LEFT JOIN `#__sobi2_categories` ON `#__sobi2_categories`.catid = `#__sobi2_cats_relations`.catid " .
    			 "WHERE {$published} `#__sobi2_cats_relations`.parentid = {$parent} ";
		$database->setQuery( $query );
		$cids = $database->loadResultArray();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		if(count($config->S2_plugins)) {
    		foreach($config->S2_plugins as $plugin) {
    			if(method_exists($plugin, "onCategoryList")) {
					$plugin->onCategoryList( $cids );
    			}
    		}
		}
    	if(!count($cids)) {
    		return null;
    	}
		$ids = (!empty($cids)) ? implode(" , ", $cids) : null;
		$query = "SELECT `#__sobi2_cats_relations`.catid, parentid, name,  introtext,  ordering " .
    			 "FROM `#__sobi2_cats_relations` " .
    			 "LEFT JOIN `#__sobi2_categories` ON `#__sobi2_categories`.catid = `#__sobi2_cats_relations`.catid " .
    			 "WHERE `#__sobi2_cats_relations`.catid IN ({$ids})".
				 "ORDER BY {$config->catsOrdering}";
    	$database->setQuery( $query );
    	$ret = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
 		return $ret;
	}
	/**
	 * parse link (replace placeholders)
	 *
	 * @param string $link
	 * @param object $cat
	 * @param boolean $sef
	 * @return string
	 */
	function parseLink($link, $cat, $sef = true)
	{
    	$config	=& sobi2Config::getInstance();
		static $placeHolders = array(
			"{sobi2}",
			"{cid}",
			"{pid}",
			"{name}",
			"{introtext}",
			"{ordering}",
			"{Itemid}"
			);
		$replacement = array(
			"index.php?option=com_sobi2",
			$cat->catid,
			$cat->parentid,
			$cat->name,
			$cat->introtext,
			$cat->ordering,
			$config->sobi2Itemid
			);
		$link = str_replace($placeHolders, $replacement, $link);
		if($sef) {
			$link = sobi2Config::sef($link);
		}
		return $link;
	}
	/**
	 * buliding javascript for header
	 *
	 * @param integer $id
	 * @param string $tag
	 * @param interger $lastNode
	 * @param string $matrix
	 * @return script
	 */
	function createHeader($id, $tag, $lastNode,$matrix,$parents)
	{
    	$config =& sobi2Config::getInstance();
    	$targetAddress = $config->liveSite;
    	$index = $config->key( "frontpage", "stree_ajax_target_file", "index2.php" );
    	if(defined('_SOBI2_ADMIN')) {
    		$targetAddress .= "/administrator";
    	}
		ob_start();
    	?>
    	<script type="text/javascript">
    	<!--
    	/* <![CDATA[ */
			var stmcid = 0;
			var smtLastNode = <?php echo $lastNode;?>;
			var smtImgs = new Array();
			var smtImgMatrix = new Array();
			var smtParents = new Array();
			var smtSemaphor = 0;
			<?php
				foreach ($this->images as $img => $loc) {
					echo "\n\t\t\t smtImgs['{$img}'] = '{$loc}';";
				}
				echo "\n";
				echo $matrix;
				echo "\n";
				echo "\n\t";
				if($parents) {
					$c = 0;
					foreach ($parents as $cid) {
						echo "\n\t\t\t smtParents[{$c}] = $cid;";
						$c++;
					}
					echo "\n";
					echo "\n\t";
				}
			?>
    		function stmExpand(catid, deep) {
    			stmcid = catid;
				url = "<?php echo $targetAddress; ?>/<?php echo $index;?>?option=com_sobi2&catid=" + stmcid + "&no_html=1&sobi2Task=<?php echo $this->task;?>";
				stmMakeRequest(url,deep,catid)
			}
			function stmAddSubcats(XMLDoc,deep,ccatid) {
				var categories = XMLDoc.getElementsByTagName('category');
				var subcats = "";
				deep++;
				for(i = 0; i < categories.length; i++) {
					var category = categories[i];
					var catid = category.getElementsByTagName('catid').item(0).firstChild.data;
					var name = category.getElementsByTagName('name').item(0).firstChild.data;
					var introtext = category.getElementsByTagName('introtext').item(0).firstChild.data;
					var parentid = category.getElementsByTagName('parentid').item(0).firstChild.data;
					var url = category.getElementsByTagName('url').item(0).firstChild.data;
					var childs = category.getElementsByTagName('childs').item(0).firstChild.data;
					var join = "<img src='"+smtImgs['join']+"' alt=''>";
					var childContainer = "";
					var margin = "";
					name = name.replace("\\", "");
					introtext = introtext.replace("\\", "");
					url = url.replace("\\\\", "");
					for(j = 0; j < deep; j++) {
						if(smtImgMatrix[parentid][j]) {
							switch(smtImgMatrix[parentid][j]) {
								case 'empty':
								case 'plusBottom':
								case 'minusBottom':
									image = 'empty';
									break;
								case 'plus':
								case 'minus':
								case 'line':
									image = 'line';
									break
							}
						}
						else {
							image = 'empty';
						}
						if(!smtImgMatrix[catid]) {
							catArray = new Array();
							catArray[j]  = image;
							smtImgMatrix[catid] = catArray;
						}
						else {
							smtImgMatrix[catid][j] = image;
						}
						margin = margin + "<img src='"+ smtImgs[image] +"' style='border-style:none;' alt=''/>";
					}
					if(childs == 1) {
						join = "<a href='javascript:stmExpand(" + catid + ", " + deep + ");' id='<?php echo $id; ?>_imgUrlExpand" + catid + "'><img src='"+ smtImgs['plus'] + "' id='<?php echo $id; ?>_imgExpand" + catid + "'  style='border-style:none;' alt='expand'/></a>";
						smtImgMatrix[catid][j] = 'plus';
					}
					if(stmcid == smtLastNode) {
						line = "<img src='"+smtImgs['empty']+"' alt=''>";
					}
					if(i == categories.length - 1) {
						if(childs == 1) {
							join = "<a href='javascript:stmExpand(" + catid + ", " + deep + ");' id='<?php echo $id; ?>_imgUrlExpand" + catid + "'><img src='"+ smtImgs['plusBottom'] + "' id='<?php echo $id; ?>_imgExpand" + catid + "'  style='border-style:none;' alt='expand'/></a>";
							smtImgMatrix[catid][j] = 'plusBottom';
						}
						else {
							join = "<img src='"+smtImgs['joinBottom']+"' style='border-style:none;' alt=''/>";
							smtImgMatrix[catid][j] = 'joinBottom';
						}
					}
					subcats = subcats + "<div class='sigsiuTreeNode'>" + margin  + join + "<a id='<?php echo $id; ?>" + catid + "' href=\"" + url + "\"><img src='"+smtImgs['folder']+"' id='<?php echo $id; ?>_imgFolder" + catid + "' alt=''></a><a class = 'treeNode' id='<?php echo $id; ?>" + catid + "' href=\"" + url + "\">" + name + "</a></div>";
					if(childs == 1) {
						subcats = subcats + "<<?php echo $tag;?> class='clip' id='<?php echo $id;?>_childsContainer" + catid + "' style='display: block;  display:none;'></div>"
					}
				}
				var childsCont = "<?php echo $id;?>_childsContainer" + ccatid;
				document.getElementById(childsCont).innerHTML = subcats;
			}
		    function stmMakeRequest(url,deep,catid) {
		    	var stmHttpRequest;
		        if (window.XMLHttpRequest) {
		            stmHttpRequest = new XMLHttpRequest();
		            if (stmHttpRequest.overrideMimeType) {
		                stmHttpRequest.overrideMimeType('text/xml');
		            }
		        }
		        else if (window.ActiveXObject) {
		            try { stmHttpRequest = new ActiveXObject("Msxml2.XMLHTTP"); }
		                catch (e) {
                           try { stmHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); }
		                   catch (e) {}
		                 }
		        }
		        if (!stmHttpRequest) {
		            alert('Sorry but I Cannot create an XMLHTTP instance');
		            return false;
		        }
		        stmHttpRequest.onreadystatechange = function() { stmGetSubcats(stmHttpRequest,deep,catid); };
		        stmHttpRequest.open('GET', url, true);
		        stmHttpRequest.send(null);
		    }
		    function stmGetSubcats(stmHttpRequest,deep,catid) {
		    	if (stmHttpRequest.readyState == 4) {
		    		if (stmHttpRequest.status == 200) {
		    			document.getElementById("<?php echo $id;?>_imgFolder"+catid).src = smtImgs['folderOpen'];
		            	 if(stmcid == smtLastNode) {
		            	 	document.getElementById("<?php echo $id;?>_imgExpand"+catid).src = smtImgs['minusBottom'];
		            	 }
		            	 else if(document.getElementById("<?php echo $id;?>_imgExpand"+catid).src == smtImgs['plusBottom']){
		            	 	document.getElementById("<?php echo $id;?>_imgExpand"+catid).src = smtImgs['minusBottom'];
		            	 }
		            	 else {
		            	 	document.getElementById("<?php echo $id;?>_imgExpand"+catid).src = smtImgs['minus'];
		            	 }
		            	 document.getElementById("<?php echo $id;?>_imgUrlExpand"+catid).href = "javascript:stmColapse(" + catid + ", " + deep + ");";
		            	 document.getElementById("<?php echo $id;?>_childsContainer" + catid).style.display = "";
		                 stmAddSubcats(stmHttpRequest.responseXML,deep,catid);
		            }
		            else {
		                alert('There was a problem with the request.');
		            }
		        }
		    }
		    function stmColapse(id, deep) {
		    	document.getElementById("<?php echo $id;?>_childsContainer" + id).style.display = "none";
				document.getElementById("<?php echo $id;?>_imgFolder"+id).src = smtImgs['folder'];
				if(id == smtLastNode) {
					document.getElementById("<?php echo $id;?>_imgExpand"+id).src = smtImgs['plusBottom'];
				}
	           	else if(document.getElementById("<?php echo $id;?>_imgExpand"+stmcid).src == smtImgs['minusBottom']){
            	 	document.getElementById("<?php echo $id;?>_imgExpand"+stmcid).src = smtImgs['plusBottom'];
            	}
				else {
					document.getElementById("<?php echo $id;?>_imgExpand"+id).src = smtImgs['plus'];
				}
				document.getElementById("<?php echo $id;?>_imgUrlExpand"+id).href = "javascript:stmExpand(" + id  + ", " + deep + ");";
		    }
		/* ]]> */
		// -->
    	</script>
    	<?php
		$script = ob_get_contents();
		ob_end_clean();
		return $script;
	}
	/**
	 * std getter
	 *
	 * @return string
	 */
	function getTree()
	{
		return $this->tree;
	}
	/**
	 * returning parent cats for
	 *
	 * @param integer $catid
	 * @param array $parents
	 */
	function getParentCats ($catid, &$parents)
	{
    	$config	=& sobi2Config::getInstance();
		$database  = &$config->getDb();

		$query = "SELECT parentid from `#__sobi2_cats_relations` WHERE `catid`={$catid}";
		$database->setQuery( $query );
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		/*
		 * the category with catid = 1 is the root category
		 */
		if($catid != 1) {
    		array_push($parents, $catid);
		}
    	/*
    	 * if we still have a results
    	 */
    	if(sizeof($database->loadResult()) != 0)
			$this->getParentCats($database->loadResult(),$parents);
	}
	/**
	 * cleaning string for javascript
	 *
	 * @param string $string
	 * @param bool $xml
	 * @return string
	 */
	function cleanString($string, $xml = true)
	{
    	$config =& sobi2Config::getInstance();
		if(!$string) {
			return ".";
		}
		$string = $config->jsAddSlashes($config->getSobiStr($string));
		$string = str_replace("\\\\", "\\",$string);
		$string = str_replace('x26', "&", $string );
		if($xml) {
			$string = str_replace('\&', "&amp;", $string );
		}
		return $string;
	}
}
?>