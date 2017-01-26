// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/assets/js/mini.js $
// $Id: mini.js 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                                    **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

function insertJoomPluWithId(id)
{
  thumb     = document.getElementById('jg_bu_typethumb').checked;
  img       = document.getElementById('jg_bu_typeimg').checked;
  orig      = document.getElementById('jg_bu_typeorig').checked;
  dtl_link  = document.getElementById('jg_bu_linked1').checked;
  cat_link  = document.getElementById('jg_bu_linked2').checked;
  //position  = document.getElementById('jg_bu_position').value;
  opt_class = document.getElementById('jg_bu_class').value;
  text      = document.getElementById('jg_bu_text').value;
  alttext   = document.getElementById('jg_bu_alttext').value;

  options = new Array();

  if(img)
  {
    type = 'img';
    options.push('type=orig');
  }
  else
  {
    if(orig)
    {
      type = 'orig';
    }
    else
    {
      type = 'thumb';
    }
  }

  container = false;
  /*if(position == 'right')
  {
    align = ' jg_floatright';
  }
  else
  {
    if(position == 'left')
    {
      align = ' jg_floatleft';
    }
    else
    {
      if(position == 'center')
      {
        container = true;
      }
      else
      {
        align = ' jg_floatnone';
      }
    }
  }*/

  if(alttext)
  {
    alt = alttext;
  }
  else
  {
    alt = 'joomplu:' + id;
  }

  if(opt_class)
  {
    opt_class = ' ' + opt_class;
  }
  else
  {
    opt_class = '';
  }

  tag = '';

  if(container)
  {
    tag = tag + '<div class="jg_photo_container_c">';
  }

  if(cat_link)
  {
    options.push('catlink=1');
    dtl_link = true;
  }

  options_string = '';
  if(options.length)
  {
    options_string = ' ' + options.join('|');
  }

  if(dtl_link)
  {
    tag = tag + '<a href="joomplu:' + id + options_string + '" class="jg_catelem_photo' + opt_class + '">';
  }

  if(text)
  {
    tag = tag + text;
  }
  else
  {
    tag  = tag + '<img src="index.php?option=com_joomgallery&view=image&format=raw&id=' + id + '&type=' + type + '" class="jg_photo' + opt_class + '" alt="' + alt + '" />';
  }

  if(dtl_link)
  {
    tag = tag + '</a>';
  }

  if(container)
  {
    tag = tag + '</div>';
  }

  window.parent.jInsertEditorText(tag, 'text');
  window.parent.document.getElementById('sbox-window').close();
}

function insertCategory(id)
{
  textlink  = document.getElementById('jg_bu_category1').checked;

  if(textlink)
  {
    linkedtext = document.getElementById('jg_bu_category_linkedtext').value;
    if(!linkedtext)
    {
      alert('Please enter text');
      document.getElementById('category_catid').selectedIndex = 0;
      return false;
    }

    tag = '<a href="index.php?option=com_joomgallery&view=category&catid=' + id + '">' + linkedtext + '</a>';
  }
  else
    {
    number    = document.getElementById('jg_bu_thumbnail_number').value;
    columns   = document.getElementById('jg_bu_thumbnail_columns').value;
    ordering  = document.getElementById('jg_bu_thumbnail_ordering').value;

    tag = '{joomplucat:' + id;

    options = new Array();

    if(number)
    {
      options.push('limit=' + number);
    }

    if(columns && columns != 2)
    {
      options.push('columns=' + columns);
    }

    if(ordering != 0)
    {
      options.push('ordering=random')
    }

    if(options.length)
    {
      tag = tag + ' ' + options.join('|');
    }

    tag = tag + '}';
  }

  window.parent.jInsertEditorText(tag, 'text');
  window.parent.document.getElementById('sbox-window').close();
}