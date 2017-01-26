
// AJAX Response Object.
var xmlHttpObjects = new Array();
var xmlHttp;
var activeComments = 0;

String.prototype.trim = function() 
{
	return this.replace(/^\s+|\s+$/g,"");
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
 			var split = response.split("|");
 			if (split.length > 1)
 			{
 				count = split[1];
 				response = split[0];
 				var divcount = document.getElementsByTagName('div');
 				var countname = id.replace("COMMENT", "COUNT");
 				
 				for (var i = 0; i < divcount.length; i++)
 				{
 					if (divcount[i].id == countname)
 					{
 						divcount[i].innerHTML = "<p>Comments (" + count.trim() + ")</p>";
	 				}
	 			}
 			}
 			//alert(response);
 			var divs = document.getElementsByTagName('div');
 			for (var i = 0; i < divs.length; i++)
 			{
 				if (divs[i].id == id)
 				{
 					divs[i].innerHTML = response;
 				}
 			}
 			
 			
 		} 

 	}
	xmlHttpObjects[index].open("GET",url,true);
	xmlHttpObjects[index].send(null);
	
}





function expandComments(id, path, articleId)
{
	if(activeComments == 0)
	{
    	var url=path + "&task=default&articleId=" + articleId;
		callPHP(url, xmlHttpObjects.length, id);
		activeComments = id;
	}
	else
	{
		if(id == activeComments)
		{
			hideComments(activeComments);
			activeComments = 0;
		}
		else
		{
			hideComments(activeComments);
			var url=path + "&task=default&articleId=" + articleId;
			callPHP(url, xmlHttpObjects.length, id);
			activeComments = id;
		}
	}
}
function hideComments(id, path, articleId)
{
    var divs = document.getElementsByTagName('div');
 	for (var i = 0; i < divs.length; i++)
 	{
 		if (divs[i].id == id)
 		{
 			divs[i].innerHTML = "";
 		}
 	}
}
function addComments(id, path, articleId)
{
	var url=path + "&task=add&articleId=" + articleId;
	callPHP(url, xmlHttpObjects.length, id);
}
function saveComment(id, path, articleId)
{
    //alert('save comment');
	var url=path + "&task=save&articleId=" + articleId;
	var append = "";
	var form = document.getElementById('ADD' + id);
	append += "&web=" + encodeURIComponent(form.web.value);
	append += "&email=" + encodeURIComponent(form.email.value);
	append += "&user=" + encodeURIComponent(form.user.value);
	append += "&comments=" + encodeURIComponent(form.comments.value);
	append += "&captcha_code=" + encodeURIComponent(form.captcha_code.value);
	// This line is probably the key to getting proper data to the PHP side with UTF-8.  
	//var encappend = encodeURIComponent(append);
	url += append;
	callPHP(url, xmlHttpObjects.length, id);
}


function toHand()
{
	document.body.style.cursor = 'pointer';
}

function toDefault()
{
	document.body.style.cursor = 'default';
}