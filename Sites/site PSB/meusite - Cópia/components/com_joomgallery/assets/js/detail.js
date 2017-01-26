// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/components/com_joomgallery/assets/js/detail.js $
// $Id: detail.js 2617 2010-12-21 13:56:04Z erftralle $
/*******************************************************************************
 * **************************************************************************************\ *
 * JoomGallery 1.5.5 ** * By: JoomGallery::ProjectTeam ** * Copyright (C) 2008 -
 * 2009 M. Andreas Boettcher ** * Based on: JoomGallery 1.0.0 by
 * JoomGallery::ProjectTeam ** * Released under GNU GPL Public License ** *
 * License: http://www.gnu.org/copyleft/gpl.html or have a look ** * at
 * administrator/components/com_joomgallery/LICENSE.TXT ** \
 ******************************************************************************/

// Javascript for SmilieInsert and Form Check
function joom_getcoordinates()
{
  document.nameshieldform.xvalue.value = document.getElementById("jg-movable-nametag").offsetTop;
  document.nameshieldform.yvalue.value = document.getElementById("jg-movable-nametag").offsetLeft;
  document.nameshieldform.submit();
}

function selectnametag(id, username)
{
  window.parent.document.getElementById('jg-movable-nametag').removeClass('jg_displaynone');
  window.parent.document.getElementById('jg-movable-nametag').setText(username);
  window.parent.document.nameshieldform.userid.value = id;
  width = username.length * jg_nameshields_width;
  window.parent.document.getElementById('jg-movable-nametag').style.width = width + 'px';
  window.parent.document.getElementById('sbox-window').close();
}

function addtooltips(tip)
{
  if($('jg-movable-nametag-icon'))
  {
    $('jg-movable-nametag-icon').cloneEvents($('jg-tooltip-helper-1'));
  }

  $$('.nametagRemoveIcon').cloneEvents($('jg-tooltip-helper-2'));

  tip.setStyle('visibility', 'visible');
}

function joom_validatecomment()
{
  if (document.commentform.cmttext.value == '')
  {
    alert(JText._('JGS_DETAIL_COMMENTS_ALERT_ENTER_COMMENT'));
  }
  else
  {
    if (document.commentform.jg_captcha_code != null
        && document.commentform.jg_captcha_code.value == '')
    {
      alert(JText._('JGS_DETAIL_COMMENTS_ALERT_ENTER_CODE'));
    }
    else
    {
      document.commentform.submit();
    }
  }
}

function joom_smilie(thesmile)
{
  document.commentform.cmttext.value += thesmile + ' ';
  document.commentform.cmttext.focus();
}

function joom_validatesend2friend()
{
  if ((document.send2friend.send2friendname.value == '')
      || (document.send2friend.send2friendemail.value == ''))
  {
    alert(JText._('JGS_DETAIL_SENDTOFRIEND_ALERT_ENTER_NAME_EMAIL'));
  }
  else
  {
    document.send2friend.submit();
  }
}

function joom_cursorchange(e)
{
  active_slimbox = document.getElementById("lbOverlay");
  if (active_slimbox != null && active_slimbox.style.visibility == "visible" )
  {
    return;
  }

  var target;
  if (typeof e =='undefined')
  {
    //IE
    target = document.activeElement.type;
  }
  else
  {
    //other
    if (typeof e.explicitOriginalTarget == 'undefined')
    {
      //Opera
      target = e.target.type;
    }
    else
    {
      //Firefox
      target = e.explicitOriginalTarget.type;
    }
  }
  if (typeof target=="undefined" || target.indexOf("text") != 0)
  {
    if (navigator.appName == "Microsoft Internet Explorer")
    {
      taste = window.event.keyCode;
    }
    else
    {
      taste = e.which;
    }
    switch (taste)
    {
      case 37:
        if (document.form_jg_back_link)
        {
          window.location = document.form_jg_back_link.action;
        }
        break;
      case 39:
        if (document.form_jg_forward_link)
        {
          window.location = document.form_jg_forward_link.action;
        }
        break;
      default:
        break;
    }
  }
}

// Get vote value in case of standard voting with radio buttons
function joomGetVoteValue()
{
  return $('ratingform').getElements('input').filter(function(input)
  {
    return /radio|checkbox/.test(input.getAttribute('type')) && input.checked;
  })[0].value;
}

// Do an AJAX vote
function joomAjaxVote(url, postdata)
{
  // Remove message div from previous vote, if any
  if($chk($('jg_ajaxvoting_message')))
  {
    $('jg_ajaxvoting_message').remove();
  } 
  
  // Show spinner
  $('jg_voting').addClass('jg_spinner');
  
  // Set slider height style to auto to force dynamic slider height adaption with mootools 1.11 
  if($$('#jg_voting .joomgallery-slider').length > 0)
  {
    $('jg_voting').getChildren()[1].setStyle('height', 'auto');
  }

  new Ajax( url,
            {
              method: 'post',
              data: postdata,
              onComplete: function(response)
              {
                joomAjaxVoteResponse(response);
              }
            }).request();
}

// Process the response of an AJAX vote
function joomAjaxVoteResponse(response)
{
  if(response != '')
  {
    var response = Json.evaluate(response);

    if(response.error == 0)
    {
      // Refresh rating display
      $('jg_photo_rating').setHTML(response.rating);

      // Refresh rating tooltip
      if(response.tooltipclass != null)
      {
        if(response.tooltipclass == 'default')
        {
          var tooltips = new Tips($$('.hasHintAjaxVote'), { maxTitleChars: 50,
                                                            fixed: false
                                                          });
        }
        else
        {
          var tooltips = new Tips($$('.hasHintAjaxVote'), { maxTitleChars: 50,
                                                            fixed: false,
                                                            className: response.tooltipclass
                                                          });
        }
      }
    }

    $('jg_voting').removeClass('jg_spinner');

    // Show the voting result message    
    if($chk($('jg_starrating_bar')))
    {
      new Element('div', {'id': 'jg_ajaxvoting_message', 'style': 'text-align: center;'}).injectBefore($('jg_starrating_bar'));
    }
    else
    {
      new Element('div', {'id': 'jg_ajaxvoting_message'}).injectBefore($('ratingform'));
    }
    $('jg_ajaxvoting_message').setHTML(response.message);
  }
}