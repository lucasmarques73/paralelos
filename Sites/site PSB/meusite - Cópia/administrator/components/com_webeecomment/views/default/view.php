<?php
/**
 * @version 2.1	
 * @package Webee Comment
 * @copyright Copyright (C) 2010 Onno Groen. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */
 

jimport( 'joomla.application.component.view' );

/**
 * @package Webee Comments
 */
class DefaultComponentView extends JView
{
	var $page;
	var $pagesize;
	var $field;
	var $filter;
	var $db;
	var $pages;
	var $requestURI;
	/**
	 * Display the view
	 */
	function display($task, $page = 1, $pagesize = 20, $field = "", $filter = "")
	{
		// Set Basic Properties
		$baseURL = JURI::getPath();
		$this->page = $page;
		$this->pagesize = $pagesize;
		$this->field = $field;
		$this->filter = $filter;
		$this->db =& JFactory::getDBO();
		
		
		
		// Add Javascript
		$document = &JFactory::getDocument();
		$jsPath = 'components/com_webeecomment/JavaScript/administrator.js';
		$cssPath = JURI::base() . 'components/com_webeecomment/css/';
		$document->addScript(JURI::base() . $jsPath);
		JHTML::stylesheet('administrator.css', $cssPath);
		
		// Get total count of comments and derive number of pages based on page size.
		$query = "SELECT COUNT(*) as count FROM " . $this->db->nameQuote('#__webeeComment_Comment');
		$this->db->setQuery($query);
		$result = $this->db->loadObject();
		if ($pagesize != "All")
		{
			$this->pages = ceil($result->count / $this->pagesize);
		}
		else
		{
			$this->pages = 1;
		}
		
				
		//Set Document Title
		$document = & JFactory::getDocument();
		$document->setTitle("Webee Comment - Manage Comments");
		
		
    	// Determine task and process request.
		switch ($task)
		{
			case "admin":
				$this->_displayList();
				break;
			case "remove";
				$this->_deleteSelection();
				$this->_displayList();
				break;
			case "publish";
				$this->_publishSelection();
				$this->_displayList();
				break;
			case "unpublish";
				$this->_unpublishSelection();
				$this->_displayList();
				break;
			case "disable";
				$this->_disableList();
				break;
			case "returnCategories":
  				$this->_returnCategories();
  				break;
  			case "returnArticles":
  				$this->_returnArticles();
  				break;
  			case "saveDisables":
  				$this->_saveDisables();
  				break;
  			case "checkDisable":
  				$this->_checkDisable();
  				break;
  			case "CSS" : 
  				$this->_editCSS();
  				break;
  			case "saveCSS":
  				$this->_saveCSS();
  				break;
			case "saveComment":
  				$this->_saveComment();
  				break;
  			case "about":
  				$this->_about();
  				break;
			case "edit";
				$this->_editComment();
				break;
			default:
				break;
			
		}
  	}
  	/**
  	 * _getSQL - This function currently returns the SQL necessary to load one page of data
  	 *           for the displayList function.  Future functionality may include a more generic
  	 *           SQL builder for the entire application.
  	 *
  	 * @return string $sql
  	 */
  	function _getSQL()
  	{
  		$sql = "";
		$sql .= "SELECT * FROM " . $this->db->nameQuote('#__webeeComment_Comment');
  		// If header clicked to sort, add sort by this field.
		if ($this->field)
  		{
  			if ($this->field == "")
  			{
  				$sql .= " ORDER BY " . $this->db->nameQuote('saved');
  			}
  			else
  			{
  				$sql .= " ORDER BY " . $this->db->nameQuote($this->field);
  			}
  		}
		if ($this->pagesize != "All")
		{
			$sql .= " LIMIT " . ($this->page - 1) * $this->pagesize . ", " . $this->pagesize;
		}
		return $sql;
  	}
  	/**
  	 * _displayList - displays one page of data with all accompanying controls to the 
  	 *                admin user.  Future versions will expand functionality to include
  	 *                sorting and filters.  
  	 */
   	function _displayList()
  	{
  		//////////////////////////////////////
  		// Get list of comments to display. //
  		//////////////////////////////////////
  		$this->db->setQuery($this->_getSQL());
		$results = $this->db->loadObjectList();
		
		$request = JURI::current() . "?option=com_webeecomment";
		/* -- if showmessage, show the message -- */
		if(isset($_GET['showmessage']))
		{
			echo '<dl id="system-message"><dt class="message">Message</dt><dd class="message message fade"><ul><li>' . $_GET['showmessage'] . '</li></ul></dd></dl>';
		}
		/////////////////////////////////////////////////
		// adminForm form with necessary hidden fields.//
		/////////////////////////////////////////////////  
		echo '<form action="' . $request . '" method="post" name="adminForm" id="adminForm">';
		// Hidden Inputs
		echo '<input type="hidden" id="task" name="task" value ="' . $task . '">';
		echo '<input type="hidden" id="boxchecked" name="boxchecked" value = "0">';
		echo '<input type="hidden" id="checkedlist" name="checkedlist">';
		echo '<input type="hidden" id="pagesize" name="pagesize" value="' . $this->pagesize . '">';
		
		////////////////////////////////
		// Beginning of display table.//
		////////////////////////////////
		echo '<table class="adminlist" cellspacing="1">';
		
		///////////////////////////////////
		//       Header Information      //
		///////////////////////////////////
		echo '<thead><tr>';
		$this->field = "id";
		$url = "index.php?option=com_webeecomment&task=administer&page=" .$this->page.  "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
		echo '<th width="5"><a href="' . $url . '">#</a></th>';
		echo '<th width="5"><input type="checkbox" name="toggle" value="" onclick="checkall(this.checked);"></th>';
		$this->field = "articleId";
		$url = "index.php?option=com_webeecomment&task=administer&page=" .$this->page.   "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
		echo '<th><a href="' . $url . '">Article Name</a></th>';
		$this->field = "handle";
		$url = "index.php?option=com_webeecomment&task=administer&page=" .$this->page.   "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
		echo '<th class="title"><a href="' . $url . '">Comment by</a></th>';
		echo '<th>E-mail</th>';
		echo '<th>Website</th>';
		echo '<th>Published</th>';
		$this->field = "saved";
		$url = "index.php?option=com_webeecomment&task=administer&page=" .$this->page.   "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
		echo '<th><a href="' . $url . '">Time</a></th>';
		/*echo '<th>IP Address</th>';*/
		echo '<th>Comment</th>';
		echo '<th>Edit</th>';
		echo '</tr></thead>';
		
		/////////////////////////////////////
		//         Footer Information      //
		/////////////////////////////////////
		echo '<tfoot><tr>';
		echo '<tr>';
		echo '<td colspan="15">';
		echo '<del class="container"><div class="pagination">';
		echo '<div class="limit">Display #<select name="limit" id="limit" class="inputbox" size="1" onchange="submitbutton(false);">';
		
		$values = array('10', '15', '20', '25', '30', '50', '100', 'All');
		foreach ($values as $value)
		{
			echo '<option value="' . $value . '"';
			if ($value == $this->pagesize)
			{
				echo ' selected="selected"';	
			}
			echo '>' . $value . '</option>';
		}		
		echo '</select></div>';
		
		if ($this->page > 1)
		{
			$offon = "";
			$prev = $this->page - 1;
			$start = 1;
			$url = "index.php?option=com_webeecomment&task=administer&page=" . $prev . "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
			$starthref = '<a href="' . $url . '">';
			$url = "index.php?option=com_webeecomment&task=administer&page=" . $start . "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
			$prevhref = '<a href="' . $url . '">';
			$hreftail = '</a>';
		}
		else
		{
			$offon = " off";
			$starthref = '<span>';
			$prevhref = '<span>';
			$hreftail = '</span>';
		}
		echo '<div class="button2-right' . $offon . '"><div class="start">'. $starthref . 'Start' . $hreftail . '</div></div>';
		echo '<div class="button2-right' . $offon . '"><div class="prev">' . $prevhref . 'Prev' . $hreftail . '</div></div>';
		echo '<div class="button2-left"><div class="page">';
		for ($i=1; $i <= $this->pages; $i++)
		{
			if ($this->page == $i)
			{
				echo "<span>" . $i . "</span>";
			}
			else
			{
				$url = "index.php?option=com_webeecomment&task=administer&page=" . $i . "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
				echo '<a href="' . $url . '" title="' . $i . '">' . $i . '</a>';
			}
		}
		echo '</div></div>';
		if ($this->pages > $this->page)
		{
			$offon = "";
			$end = $this->pages;
			$next = $this->page + 1;
			$url = "index.php?option=com_webeecomment&task=administer&page=" . $next . "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
			$nexthref = '<a href="' . $url . '">';
			$url = "index.php?option=com_webeecomment&task=administer&page=" . $end . "&pagesize=" . $this->pagesize . "&field=" . $this->field . "&filter=" . $this->filter;
			$endhref = '<a href="' . $url . '">';
			
			$hreftail = '</a>';
					
		}
		else
		{
			$offon = " off";
			$nexthref = "<span>";
			$endhref = "<span>";
			$hreftail = "</span>";
		}
		echo '<div class="button2-left' . $offon . '"><div class="next">' . $nexthref . 'Next' . $hreftail . '</div></div>';
		echo '<div class="button2-left' . $offon . '"><div class="end">' . $endhref . 'End' . $hreftail . '</div></div>';
			
		echo '<div class="limit">Page' . $this->page . ' of ' . $this->pages . '</div>';
		echo '<input type="hidden" name="limitstart" value="0" /></div></del>';
		echo '</td>';
		echo '</tr></tfoot>';
		echo '<tbody>';
		$rowstyle = 0;
		$path = str_replace("/administrator", "", JURI::base()) . "index.php?";
		if ($results)
		{
			foreach ($results as $result)
			{
				echo '<tr class="row' . $rowstyle . '">';
				echo '<td>';
				echo $result->id;
				echo '</td>';
				echo '<td>';
				echo '<input type="checkbox" name="checked' . $result->id . '" id="checked' . $result->id . '" onclick="checkbox();">';
				echo '</td>';
				echo '<td>';
				$query = "SELECT " . $this->db->nameQuote('title') . ', ' . $this->db->nameQuote('id') ." from " . $this->db->nameQuote('#__content') . " WHERE " . $this->db->nameQuote('id') . " = " . $result->articleId;
	   			$this->db->setQuery($query);
	   			$articleName = $this->db->loadResult();
				echo '<a href="' . $path . 'option=com_content&view=article&id=' . $result->articleId . '" target="_blank">' . $articleName . "</a>";
				echo '</td>';
				echo '<td>';
				if ($result->isUser)
	   			{
	   				$query = "SELECT " . $this->db->nameQuote('username') . " from " . $this->db->nameQuote('#__users') . " WHERE " . $this->db->nameQuote('id') . " = " . $result->handle;
	   				$this->db->setQuery($query);
	   				$handle = $this->db->loadResult();
	   			}
	   			else
	   			{
	   				$handle = $result->handle;
	   			}
	   			echo $handle;
				echo '</td>';
				echo '<td>';
				if($result->email != "")
				{
					echo '<a href="mailto:' . $result->email . '">' . $result->email . '</a>';
				}
				echo '</td>';
				echo '<td>';
				if($result->website != "")
				{
					echo '<a href="' . $result->website . '">' . $result->website . '</a>'; 
				}
				echo '</td>';
				echo '<td>';
				$path = JURI::base() . "index.php?";
				if ($result->published)
				{
					echo "<center><a href=\"javascript:document.getElementById('checked" . $result->id . "').checked = true; checkbox(); document.adminForm.checkedlist.value =" . $result->id . "; document.adminForm.task.value = 'unpublish'; document.adminForm.submit();\"' title='Unpublish'><img style='border: none;' src='" . JURI::base() . "images/publish_g.png' /></a></center>";
				}
				else
				{
					echo "<center><a href=\"javascript:document.getElementById('checked" . $result->id . "').checked = true; checkbox(); document.adminForm.checkedlist.value =" . $result->id . "; document.adminForm.task.value = 'publish'; document.adminForm.submit();\"' title='Publish'><img style='border: none;' src='" . JURI::base() . "images/publish_x.png' /></a></center>";
				}
				echo '</td>';
				echo '<td>';
				echo $result->saved;
				echo '</td>';
				/*echo '<td>';
				echo $result->ipAddress;
				echo '</td>';*/
				echo '<td>';
				echo $result->content;
				echo '</td>';
				echo '<td align="center">';
				echo '<center><a href="' . $path . 'option=com_webeecomment&task=edit&id=' . $result->id . '" title="Edit Comment"><img style="border: none;" src="' . JURI::base() . 'components/com_webeecomment/images/edit_f2.png" width="16" /></a></center>';
				echo '</td>';
				if ($rowstyle == 1)
				{
					$rowstyle = 0;
				}
				else
				{
					$rowstyle = 1;
				}
				echo '</tr>';
			}	
		}
				
		echo '</tbody>';
		echo '</table>';
		echo '</form>';
  	}
  	function _deleteSelection()
  	{
  		$items = explode("|", $_POST['checkedlist']);
  		$deletedItems = new ArrayObject();
  		if ($items)
  		{
  			if (is_array($items))
  			{
  				foreach($items as $item)
  				{
  				if (strlen($item) > 0)
  					{
  						$deletedItems->append($item);
  					}
  				}
  			}
  			else
  			{
  				$items = str_replace("|", "", $items);
  				$deletedItems->append($items);	
  			}
  			$sql = "DELETE FROM " . $this->db->nameQuote('#__webeeComment_Comment') . " WHERE " . $this->db->nameQuote('id') . " IN (";
  			$count = 0;
  			foreach ($deletedItems as $item)
  			{
  				if ($count == 0)
  				{
  					$sql .= $item;
  					$count = 1;
  				}
  				else
  				{
  					$sql .= ", " . $item;
					$count++;
  				}
  			}
  			$sql .= ")";
  			$this->db->execute($sql);
			header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=(".$count.") Comments Deleted");
  		}
  		
  	}
  	function _publishSelection()
  	{
  		$items = explode("|", $_POST['checkedlist']);
  		$publishedItems = new ArrayObject();
  		if ($items)
  		{
  			if (is_array($items))
  			{
  				foreach($items as $item)
  				{
  				if (strlen($item) > 0)
  					{
  						$publishedItems->append($item);
  					}
  				}
  			}
  			else
  			{
  				$items = str_replace("|", "", $items);
  				$publishedItems->append($items);	
  			}
  			$sql = "UPDATE " . $this->db->nameQuote('#__webeeComment_Comment') . " SET " . $this->db->nameQuote('published') . " = 1 WHERE " . $this->db->nameQuote('id') . " IN (";
  			
  			$count = 0;
  			foreach ($publishedItems as $item)
  			{
  				if ($count == 0)
  				{
  					$sql .= $item;
  					$count = 1;
  				}
  				else
  				{
  					$sql .= ", " . $item;
					$count++;
  				}
  			}
  			$sql .= ")";
  			$this->db->execute($sql);
			header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=(".$count.") Comments Published");
  		}
  		
  	}
  	function _unpublishSelection()
  	{
  	$items = explode("|", $_POST['checkedlist']);
  		$unpublishedItems = new ArrayObject();
  		if ($items)
  		{
  			if (is_array($items))
  			{
  				foreach($items as $item)
  				{
  					if (strlen($item) > 0)
  					{
  						$unpublishedItems->append($item);
  					}
  					
  				}
  			}
  			else
  			{
  				$items = str_replace("|", "", $items);
  				$unpublishedItems->append($items);	
  			}
  			$sql = "UPDATE " . $this->db->nameQuote('#__webeeComment_Comment') . " SET " . $this->db->nameQuote('published') . " = 0 WHERE " . $this->db->nameQuote('id') . " IN (";
  			
  			$count = 0;
  			foreach ($unpublishedItems as $item)
  			{
  				if ($count == 0)
  				{
  					$sql .= $item;
  					$count = 1;
  				}
  				else
  				{
  					$sql .= ", " . $item;
					$count++;
  				}
  			}
  			$sql .= ")";
  			$this->db->execute($sql);
  		}
		header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=(".$count.") Comments Unpublished");
  	}
	function _disableList()
	{
			// Get List of Sections
			$this->db =& JFactory::getDBO();
			$sql = "SELECT id, title FROM #__sections";
			$this->db->setQuery($sql);
			$results = $this->db->loadObjectList();
			$path = JURI::base() . "index2.php?option=com_webeecomment";
			
			
			echo '<div style="width: 300px; float: left; margin: 0px 10px 10px 0px; border: 1px solid #cdcdcd; padding: 10px;"><strong>Sections</strong><br /><br />Click on a section to see the comment status.<br />';
			echo '<select name="section" id="section" style="width: 200px; margin: 10px 0px 10px 0px;" id="section" size="8" onchange="checkDisable(' . "'" . 'section' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'sectionButton' . "'" . ');">';
			//echo '<option value=""></option>';
			foreach ($results as $result)
			{
				echo '<option value="' . $result->id . '">' . $result->title . '</option>';
			}
			
			
			echo '</select><br /><span>Status:&nbsp;<span id="sectionDisableStatus"></span><br />';
			echo '<input type="button" style="margin: 10px 0px 0px 0px;" value="Disable" id="sectionButton" onclick="saveDisable(' . "'" . 'section' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'sectionButton' . "'" . ');"></div>';
			
			// Get List of Categories
			$this->db =& JFactory::getDBO();
			$sql = "SELECT id, title FROM #__categories";
			$this->db->setQuery($sql);
			$results = $this->db->loadObjectList();
			$path = JURI::base() . "index2.php?option=com_webeecomment";
			
			
			echo '<div style="width: 300px; float: left; margin: 0px 10px 10px 0px; border: 1px solid #cdcdcd; padding:10px;"><strong>Categories</strong><br /><br />Click on a category to see the comment status.<br />';
			echo '<select name="category" id="category" style="width: 200px; margin: 10px 0px 10px 0px;" id="section" size="8" onchange="checkDisable(' . "'" . 'category' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'categoryButton' . "'" . ');">';
			//echo '<option value=""></option>';
			foreach ($results as $result)
			{
				echo '<option value="' . $result->id . '">' . $result->title . '</option>';
			}
			
			
			echo '</select><br /><span>Status:&nbsp;<span id="categoryDisableStatus"></span><br />';
			echo '<input type="button" style="margin: 10px 0px 0px 0px;" value="Disable" id="categoryButton" onclick="saveDisable(' . "'" . 'category' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'categoryButton' . "'" . ');"></div>';
			
			// Get List of Articles
			$this->db =& JFactory::getDBO();
			$sql = "SELECT id, title FROM #__content";
			$this->db->setQuery($sql);
			$results = $this->db->loadObjectList();
			$path = JURI::base() . "index2.php?option=com_webeecomment";
			
			
			echo '<div style="width: 300px; float: left; margin: 0px 10px 10px 0px; border: 1px solid #cdcdcd; padding:10px;"><strong>Articles</strong><br /><br />Click on an article to see the comment status.<br />';
			echo '<select name="article" id="article" style="width: 200px; margin: 10px 0px 10px 0px;" id="section" size="8" onchange="checkDisable(' . "'" . 'article' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'articleButton' . "'" . ');">';
			//echo '<option value=""></option>';
			foreach ($results as $result)
			{
				echo '<option value="' . $result->id . '">' . $result->title . '</option>';
			}
			
			
			echo '</select><br /><span>Status:&nbsp;<span id="articleDisableStatus"></span><br />';
			echo '<input type="button" style="margin: 10px 0px 0px 0px;" value="Disable" id="articleButton" onclick="saveDisable(' . "'" . 'article' . "'" . ', ' . "'" . $path . "'" . ', ' . "'" . 'articleButton' . "'" . ');"></div>';
	}
	function _returnCategories()
	{
		$sectionId = JRequest::getVar('sectionId', -1);
		$this->db = & JFactory::getDBO();
		$sql = "SELECT id, title FROM #__categories where section = " . $sectionId ;
		$this->db->setQuery($sql);
		$results = $this->db->loadObjectList();
		$path = JURI::base() . "index2.php?option=com_webeecomment";
		echo '<option value=""></option>';
		foreach ($results as $result)
		{
			echo '<option value="' . $result->id . '">' . $result->title . '</option>';
		}
	}
	function _returnArticles()
	{
		$categoryId = JRequest::getVar('categoryId', -1);
		$this->db = & JFactory::getDBO();
		$sql = "SELECT id, title FROM #__content where catid = " . $categoryId;
		$this->db->setQuery($sql);
		$results = $this->db->loadObjectList();
		$path = JURI::base() . "index2.php?option=com_webeecomment";
		echo '<option value=""></option>';
		foreach ($results as $result)
		{
			echo '<option value="' . $result->id . '">' . $result->title . '</option>';
		}
	}
	function _saveDisables()
	{
		$type = JRequest::getVar('type', "");
		$targetId = JRequest::getVar('targetId', -1);
		$this->db = & JFactory::getDBO();
		$sql = "SELECT id FROM #__webeeComment_Disabled where type='" . $type . "' and target_id = " . $targetId;
		$this->db->setQuery($sql);
		
		$found = $this->db->loadResult();
	
		if ($found)
		{
			// Delete record.
			$sql = "DELETE FROM #__webeeComment_Disabled where id=" . $found;
			$this->db->execute($sql);
			echo "Disable";
		}
		else
		{
			// Write Record
			
			$sql = "INSERT INTO #__webeeComment_Disabled (target_id, type) values (" . $targetId . ", '" . $type . "')";
			$this->db->execute($sql);
			echo "Enable";
		}
	
		echo "";
	}
	
	function _checkDisable()
	{
		$type = JRequest::getVar('type', "");
		$targetId = JRequest::getVar('targetId', -1);
		$this->db = & JFactory::getDBO();
		$sql = "SELECT id FROM #__webeeComment_Disabled where type='" . $type . "' and target_id = " . $targetId;
		$this->db->setQuery($sql);
		
		$found = $this->db->loadResult();
	
		if ($found)
		{
			echo "Enable";
		}
		else
		{
			echo "Disable";
		}
	
		echo "";
	}
	function _editCSS()
	{
		$path = JPATH_COMPONENT_ADMINISTRATOR;
		$file = fopen($path . "/webeecomment.css", 'r+');
		$target = JURI::base() . "index2.php?option=com_webeecomment&task=saveCSS";
		$CSS = fread($file, filesize($path . "/webeecomment.css"));
		//$theData = str_replace("\n", "<BR>", $CSS);
		echo '<form method="post" name="adminForm" id="adminForm" action="' . $target . '">';
		echo '<input type="hidden" id="task" name="task" value ="saveCSS">';
		echo '<textarea id="csstext" rows="30" cols="100" style="width: 100%;" onchange="css.value = this.value;">';
		echo $CSS;
		echo '</textarea><br>';
		echo '<input type="hidden" value="' . $CSS . '" id="css" name="css">';
		echo '<input type="hidden" value="" id="goto" name="goto">';
		echo '</form>';
	}
	function _editComment()
	{
		$CommentId = JRequest::getVar('id', 0);
		$this->db = & JFactory::getDBO();
		$sql = "SELECT content FROM #__webeeComment_Comment where id=" . $CommentId;
		$this->db->setQuery($sql);
		
		$found = $this->db->loadResult();
	
		if ($found)
		{
			$comment = $found;
			$target = JURI::base() . "index2.php?option=com_webeecomment&task=saveComment";
			echo '<form id="adminForm" name="adminForm" action="' . $target . '" method="post">';
			echo '<textarea id="commenttext" rows="8" cols="100" style="width: 100%;" onchange="comment.value = this.value;">';
			echo $comment;
			echo '</textarea><br>';
			echo '<input type="hidden" value="' . $comment . '" id="comment" name="comment">';
			echo '<input type="hidden" value="' . $CommentId . '" id="commentid" name="commentid">';
			echo '<input type="hidden" value="saveComment" id="task" name="task">';
			echo '<input type="hidden" value="" id="goto" name="goto">';
			echo '</form>';
		}
		else
		{
			header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=Comment%20Not%20Found");
		}
	}
	function _saveComment()
	{
		$Comment = JRequest::getVar('comment', -1);
		$CommentID = JRequest::getVar('commentid', -1);
		$this->db = &JFactory::getDBO();
		$insertComment = $this->db->Quote($Comment);
		$sql = "UPDATE " . $this->db->nameQuote('#__webeeComment_Comment') . " SET content = " . $insertComment . " WHERE id = " . $CommentID;
		$this->db->setQuery($sql);
		$this->db->execute($sql);
		if(isset($_POST['goto']))
		{
			if($_POST['goto'] != '')
			{
				header('Location:' . $_POST['goto']);
			}
			else
			{
				header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=Successfully%20Saved%20Comment");
			}
		}
	}
	function _saveCSS()
	{
		$CSS = JRequest::getVar('css', -1);
		$path = JPATH_COMPONENT_ADMINISTRATOR;
		$file = fopen($path . "/webeecomment.css", 'w+');
		fwrite($file, $CSS);
		fclose($file);
		if(isset($_POST['goto']))
		{
			if($_POST['goto'] != '')
			{
				header('Location:' . $_POST['goto']);
			}
			else
			{
				header('Location:' . JURI::base() . "index2.php?option=com_webeecomment&task=admin&showmessage=CSS%20Successfully%20Saved");
			}
		}
	}
	function _about()
	{
		echo '<p><strong>Webee Comments</strong></p>
<p>Webee Comments is a simple and to-the-point AJAX comment component for Joomla! 1.5.</p><p><strong>Features</strong></p><ul style="margin: 0px 0px 0px 15px; padding: 0px;"><li>W3C valid output</li><li>Easy styling</li><li>BBCode based comments</li><li>Guest commenting</li><li>Publish comment configuration</li></ul><p><strong>Author</strong></p><p>This component was based on a similiar component which did not offer enough opportunities for styling and disabling comments. This component has been completely overhauled and now works with some significant differences.</p><p>Onno Groen<br /><a href="mailto:onnogroen@jump4design.nl">onnogroen@jump4design.nl</a></p>';
	}
}
?>