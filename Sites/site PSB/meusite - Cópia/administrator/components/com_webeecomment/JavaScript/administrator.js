// AJAX Response Object.
	var xmlHttpObjects = new Array();
	var xmlHttp;
	String.prototype.trim = function() 
	{
		return this.replace(/^\s+|\s+$/g,"");
	}
 	function submitbutton(pressbutton)
	{
		if(pressbutton == 'publish' || pressbutton == 'unpublish' || pressbutton == 'remove')
		{
			var form = document.adminForm;
			var selects = document.getElementsByTagName("select");
			if (selects != null)
			{
				form.pagesize.value = selects[0].options[selects[0].selectedIndex].value;
			}
			 
			var checkboxes = document.getElementsByTagName("input");
			for (var i=0; i< checkboxes.length; i++)
			{
				if (checkboxes[i].type == "checkbox")
				{
					if (checkboxes[i].name.substring(0, 7) == "checked")
					{
						var name = checkboxes[i].name.substring(7);
						if (checkboxes[i].checked == true)
						{
							form.checkedlist.value += name + "|";
						}
					}
				}
			}
			submitform(pressbutton);
		}
		if(pressbutton == 'saveCSS' || pressbutton == 'saveComment')
		{
			document.adminForm.submit();
		}
		if(pressbutton == 'editCSS')
		{
			window.location = 'index.php?option=com_webeecomment&task=CSS';
		}
		if(pressbutton == 'disable')
		{
			window.location = 'index.php?option=com_webeecomment&task=disable';
		}
		if(pressbutton == 'help')
		{
			popupWindow('http://www.onnogroen.nl/webee/help/index.html', 'Support', 640, 480, 1)
		}
		if(pressbutton == 'apply')
		{
			document.adminForm.goto.value = window.location;
			document.adminForm.submit();
		}
		if(pressbutton == 'back')
		{
			window.location = 'index.php?option=com_webeecomment&task=admin';
		}
	}
	
	function checkbox()
	{
	    var	form  = document.adminForm;
	    form.boxchecked.value = 1;
	}
	
	function checkall(toggle)
	{
		var checkboxes = document.getElementsByTagName("input");
		for (var i=0; i < checkboxes.length; i++)
		{
			if (checkboxes[i].type == "checkbox")
			{
				checkboxes[i].checked = toggle;
			}
		}
		if (toggle) {checkbox();} else {document.adminForm.boxchecked.value = 0;}
	}
	
	//////////////////////////////////
	//        Disable Comment       //
	//////////////////////////////////

function loadCategories(id, sectionId, path)
{
	var url=path + "&task=returnCategories&sectionId=" + sectionId;
	callPHP(url, xmlHttpObjects.length, id);
}

function loadArticles(id, categoryId, path)
{
	var url=path + "&task=returnArticles&categoryId=" + categoryId;
	callPHP(url, xmlHttpObjects.length, id);
}

function saveDisable(type, path, buttonId)
{
	var list = document.getElementById(type);
	var id = list.options[list.selectedIndex].value
	var url=path + "&format=raw&task=saveDisables&type=" + type + "&targetId=" + id;
	callSavePHP(url, xmlHttpObjects.length, buttonId, type);
}

function checkDisable(type, path, buttonId)
{
	var list = document.getElementById(type);
	var id = list.options[list.selectedIndex].value
	var url=path + "&format=raw&task=checkDisable&type=" + type + "&targetId=" + id;
	callSavePHP(url, xmlHttpObjects.length, buttonId, type);
}


////////////////////
// AJAX Functions //
////////////////////
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
 	{
 		// IE 7 - Security Problem if it uses XMLHttpRequest();
 		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}
	catch (e)
 	{
 		//Internet Explorer
 		try
  		{
  			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  		}
 		catch (e)
  		{
  			// Firefox, Opera 8.0+, Safari
 			xmlHttp=new XMLHttpRequest();
  		}
 	}
	return xmlHttp;
}

function callPHP(url, index, id)
{
	if (url==""){return;}
	// Call PHP Program with AJAX.
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
 	xmlHttpObjects[index] = xmlHttp;
 	xmlHttpObjects[index].onreadystatechange= function() {
 		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 		{ 
 		    var count = 0;
 			var response = xmlHttpObjects[index].responseText;
 			// Fill target item with options.
 			var dropdown = document.getElementById(id);
 			dropdown.innerHTML = response;
 		} 
 	}
	xmlHttpObjects[index].open("GET",url,true);
	xmlHttpObjects[index].send(null);
}	

function callSavePHP(url, index, id, typeList)
{
	if (url==""){return;}
	// Call PHP Program with AJAX.
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return;
 	}
 	xmlHttpObjects[index] = xmlHttp;
 	xmlHttpObjects[index].onreadystatechange= function() {
 		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 		{ 
 		    var count = 0;
 			var response = xmlHttpObjects[index].responseText;
 			// Fill target item with options.
 			var button = document.getElementById(id);
 			button.value = response;
 			if(response == 'Enable')
 			{
 				document.getElementById(typeList + 'DisableStatus').innerHTML = 'Comments for this section are disabled';
 				document.getElementById(typeList + 'DisableStatus').style.color = '#ff0000';
 			}
 			else
 			{
 				document.getElementById(typeList + 'DisableStatus').innerHTML = 'Comments for this section are enabled';
 				document.getElementById(typeList + 'DisableStatus').style.color = '#009900';
 			}
 			
 		} 

 	}
	xmlHttpObjects[index].open("GET",url,true);
	xmlHttpObjects[index].send(null);
}		
	
	