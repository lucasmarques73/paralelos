// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/branches/components/com_joomgallery/assets/js/joomscript.js $
// $Id: joomscript.js 1530 2009-08-11 06:22:43Z aha $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2009  M. Andreas Boettcher                                    **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

function joom_singleuploadcheck()
{
  var form = document.SingleUploadForm;
  form.gentitle.style.backgroundColor = '';
  form.catid.style.backgroundColor = '';
  var doublefiles = false;
  // do field validation
  if (form.gentitle.value == ''|| form.gentitle.value == null) {
    alert(JText._('JGA_COMMON_ALERT_IMAGE_MUST_HAVE_TITLE'));
    form.gentitle.style.backgroundColor = jg_ffwrong;
    form.gentitle.focus();
    return false;
  } else if (form.catid.value == "0") {
    alert(JText._('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY'));
    form.catid.style.backgroundColor = jg_ffwrong;
    form.catid.focus();
    return false;
    //Prueft ob ueberhaupt Dateien angeben wurden.
  } else {
    var zaehl = 0;
    var arenofiles = true;
    var fullfields = new Array();
    var screenshotfieldname = new Array();
    var screenshotfieldvalue = new Array();
    for(i=0;i<jg_inputcounter;i++) {
      screenshotfieldname[i] = 'arrscreenshot['+i+']';
      screenshotfieldvalue[i] = document.getElementsByName(screenshotfieldname[i])[0].value;
      document.getElementsByName(screenshotfieldname[i])[0].style.backgroundColor='';
      if(screenshotfieldvalue[i] != "") {
        arenofiles = false;
        fullfields[zaehl] = i;
        zaehl++;
      }
    }
  }
  if(arenofiles) {
    alert(JText._('JGA_IMGMAN_CHOOSE_IMAGE'));
    document.getElementsByName(screenshotfieldname[0])[0].focus();
    document.getElementsByName(screenshotfieldname[0])[0].style.backgroundColor = jg_ffwrong;
    return false;
    //Prueft ob die Dateitypen auch .jpg,.gif und .png sind
  } else {
    var extensionsnotok = false;
    var searchextensiontest = new Array();
    var searchextension = new Array();
    //However you have to define this RegExp for each item.
    for (i=0;i<fullfields.length;i++) {
      searchextension[i] = new RegExp('\.jpg$|\.jpe$|\.jpeg$|\.gif$|\.png$','ig');
    }
    for(i=0;i<fullfields.length;i++) {
      searchextensiontest = searchextension[i].test(screenshotfieldvalue[fullfields[i]]);
      if(searchextensiontest!=true) {
        extensionsnotok = true;
        document.getElementsByName(screenshotfieldname[fullfields[i]])[0].style.backgroundColor = jg_ffwrong;
      }
    }
  }
  if(extensionsnotok) {
    alert(JText._('JG_COMMON_ALERT_WRONG_EXTENSION'));
    document.getElementsByName(screenshotfieldname[0])[0].focus();
    return false;
    //Wenn eine Javascriptueberpruefung in den Configurations gewuenscht wurde wird der Dateinamen auf Sonderzeichen ueberprueft
  } else {
    var filenamesnotok = false;
    if(jg_filenamewithjs!=0) {
      var searchwrongchars = /[^ a-zA-Z0-9_-]/;
      var lastbackslash = new Array();
      var endoffilename = new Array();
      var filename = new Array();
      for(i=0;i<fullfields.length;i++) {
        lastbackslash[i] = screenshotfieldvalue[fullfields[i]].lastIndexOf('\\');
        endoffilename[i] = screenshotfieldvalue[fullfields[i]].lastIndexOf('\.')-screenshotfieldvalue[fullfields[i]].length;
        if(lastbackslash[i]<1) {
         lastbackslash[i] = screenshotfieldvalue[fullfields[i]].lastIndexOf('/');
        }
        filename[i] = screenshotfieldvalue[fullfields[i]].slice(lastbackslash[i]+1,endoffilename[i]);
        if(searchwrongchars.test(filename[i])) {
          filenamesnotok = true;
          document.getElementsByName(screenshotfieldname[fullfields[i]])[0].style.backgroundColor = jg_ffwrong;
        }
      }
    }
  }
  if(filenamesnotok) {
    alert(JText._('JG_COMMON_ALERT_WRONG_FIILENAME'));
    document.getElementsByName(screenshotfieldname[0])[0].focus();
    return false;
  } else if(fullfields.length>1) {
    var feld1 = new Number();
    var feld2 = new Number();
    for(i=0;i<fullfields.length;i++) {
      for(j=fullfields.length-1;j>i;j--) {
        if(screenshotfieldvalue[fullfields[i]].indexOf(screenshotfieldvalue[fullfields[j]])==0) {
          doublefiles = true;
          document.getElementsByName(screenshotfieldname[fullfields[i]])[0].style.backgroundColor = jg_ffwrong;
          document.getElementsByName(screenshotfieldname[fullfields[j]])[0].style.backgroundColor = jg_ffwrong;
          feld1 = i+1;
          feld2 = j+1
          alert(JText._('JGA_UPLOAD_ALERT_FILENAME_DOUBLE_ONE') + ' ' + feld1 + ' ' + JText._('JGA_UPLOAD_ALERT_FILENAME_DOUBLE_TWO') + ' ' + feld2 + '.');
        }
      }
    }
  }
  if(doublefiles) {
    document.getElementsByName(screenshotfieldname[0])[0].focus();
    return false;
  } else {
    form.submit();
    return true;
  }
}

function joom_batchuploadcheck() {
  var form = document.BatchUploadForm;
  form.zippack.style.backgroundColor = '';
  form.catid.style.backgroundColor = '';/*";
if(!$this->_config->get('jg_useorigfilename'))
{
  $script .= "*/
    form.gentitle.style.backgroundColor = '';/*";
}
$script .= "*/
  if (form.zippack.value == '' || form.zippack.value == null) {
    alert(JText._('JG_COMMON_ALERT_YOU_MUST_SELECT_ONE_FILE'));
    form.zippack.style.backgroundColor = jg_ffwrong;
    form.zippack.focus();
    return false;
  }/*";
if(!$this->_config->get('jg_useorigfilename'))
{
  $script .= " */else if (form.gentitle.value == '' || form.gentitle.value == null) {
    alert(JText._('JGA_ALERT_PICTURE_MUST_HAVE_TITLE'));
    form.gentitle.style.backgroundColor = jg_ffwrong;
    form.gentitle.focus();
    return false;
  }/*";
}
$script .= "*/
  var filecounterok = true;/*";
if(!$this->_config->get('jg_useorigfilename') && $this->_config->get('jg_filenamenumber'))
{
  $script .= "*/
  form.filecounter.style.backgroundColor = '';
  if (form.filecounter.value != '') {
    var searchwrongchars1 = /[^0-9]/;
    if(searchwrongchars1.test(form.filecounter.value)) {
      filecounterok = false;
      alert(JText._('JG_COMMON_ALERT_WRONG_VALUE'));
      form.filecounter.style.backgroundColor = jg_ffwrong;
      form.filecounter.focus();
      return false;
    }
  }/*";
}
$script .= "*/
  if (form.catid.value == '0' && filecounterok) {
    alert(JText._('JGA_COMMON_ALERT_YOU_MUST_SELECT_CATEGORY'));
    form.catid.style.backgroundColor = jg_ffwrong;
    form.catid.focus();
    return false;
  } else {
    var filenamesnotok = false;/*";
if($this->_config->get('jg_filenamewithjs') != 0  && $this->_config->get('jg_useorigfilename') == 0)
{
  $script .= "*/
     var searchwrongchars = /[^ a-zA-Z0-9_-]/;
     if(searchwrongchars.test(form.gentitle.value)) {
       filenamesnotok = true;
     }/*";
}
$script .= "*/
  }
  if(filenamesnotok) {
    alert(JText._('JGA_ALERT_WRONG_FILENAME'));
    form.gentitle.style.backgroundColor = jg_ffwrong;
    form.gentitle.focus();
    return false;
  } else {
    form.submit();
    return true;
  }
}

function joom_checkme2() {
  var form = document.adminForm;
  form.gentitle.style.backgroundColor = '';
  form.catid.style.backgroundColor = '';
  // do field validation
  if (form.gentitle.value == '' || form.gentitle.value == null) {
    alert(JText._('JGA_ALERT_PICTURE_MUST_HAVE_TITLE'));
    form.gentitle.style.backgroundColor = jg_ffwrong;
    form.gentitle.focus();
    return false;
  } else if (form.catid.value == '0') {
    alert(JText._('JGA_ALERT_YOU_MUST_SELECT_CATEGORY'));
    form.catid.style.backgroundColor = jg_ffwrong;
    form.catid.focus();
    return false;
  } else {
    form.submit();
    return true;
  }
}

function submit_button() {
  var form = document.usercatForm;
  // do field validation
  form.name.style.backgroundColor = '';
  try {
    document.usercatForm.onsubmit();
  }
  catch(e){}
  if (form.name.value == '' || form.name.value == null) {
    alert(JText._('JGA_ALERT_CATEGORY_MUST_HAVE_TITLE'));
    form.name.style.backgroundColor = jg_ffwrong;
    form.name.focus();
  } else {
    form.button[0].disabled=true;//save
    form.button[1].disabled=true;//cancel
    form.submit();
  }
}