// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/assets/js/admin.joomscript.js $
// $Id: admin.joomscript.js 1639 2009-10-30 10:51:06Z aha $
/*******************************************************************************
 * **************************************************************************************\ *
 * JoomGallery 1.5.5 ** * By: JoomGallery::ProjectTeam ** * Copyright (C) 2008 -
 * 2009 M. Andreas Boettcher ** * Based on: JoomGallery 1.0.0 by
 * JoomGallery::ProjectTeam ** * Released under GNU GPL Public License ** *
 * License: http://www.gnu.org/copyleft/gpl.html or have a look ** * at
 * administrator/components/com_joomgallery/LICENSE.TXT ** \
 ******************************************************************************/

// test the values in configuration manager and delete the not modified values
// in DOM
function joom_testDefaultValues()
{
  var what = document.adminForm;
  var result;
  var todelete = Array();
  var todeletecount = 0;
  var elemcount = what.elements.length;
  var elem = null;
  var elemType = null;
  var myName = null;

  for ( var i = 0; i < elemcount; i++)
  {
    result = false;
    elem = what.elements[i];
    elemType = what.elements[i].type;
    myName = what.elements[i].name;

    if (myName.substr(0, 3) == "jg_")
    {
      if (elemType == "text")
      {
        if (String(elem.value) == String(elem.defaultValue))
        {
          todelete[todeletecount++] = myName;
        }
        else
        {
          result = true; // save
        }
      }
      else if (elemType == "select-one" || elemType == "select-multiple")
      {
        var l = elem.options.length;
        for ( var k = 0; k < l; k++)
        {
          if (String(elem.options[k].selected) != String(elem.options[k].defaultSelected))
          {
            result = true; // save
            break;
          }
        }
        if (!result)
        {
          todelete[todeletecount++] = myName;
        }
      }
    }
  }

  for ( var i = 0; i < todeletecount; i++)
  {
    var elem = document.getElementsByName(todelete[i])[0];
    elem.parentNode.removeChild(elem);
  }
}
