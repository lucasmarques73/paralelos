/**
 * @package      JCE
 * @copyright    Copyright (C) 2005 - 2010 Ryan Demmer. All rights reserved.
 * @author		   Ryan Demmer
 * @license      GNU/GPL
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
tinyMCEPopup.requireLangPack();

var PreviewDialog = {
    init : function() {
        new Preview();
    }
};
var Preview = Plugin.extend({
    initialize : function() {
        var ed = tinyMCEPopup.editor;
        $('content').addClass('loader').empty();

        var content = ed.getContent();

        this.xhr('showPreview', {'data' : content}, function(s) {
            var iframe = new Element('iframe', {
                scrolling   : 'no',
                frameborder : 0,
                width       : '100%',
                height      : '100%',
                src         : 'javascript:""'
            }).injectInside($('content'));

            var html = '<html><head xmlns="http://www.w3.org/1999/xhtml">';
            html += '<base href="' + tinymce.settings['document_base_url'] + '" />';
            html += '<meta http-equiv="X-UA-Compatible" content="IE=7" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';

            // get css
            var css = tinymce.explode(ed.getParam('content_css'));

            // insert css
            html += '<link href="' + tinyMCEPopup.getWindowArg('url') + '/css/content.css" rel="stylesheet" type="text/css" />';

            tinymce.each(css, function(url) {
                html += '<link href="' + url + '" rel="stylesheet" type="text/css" />';
            });
            
            s = s || '';

            html += '</head><body>';
            html += s;
            html += '</body></html>';

            var win 	= iframe.contentWindow;
            var doc 	= win.document;
            var height 	= doc.documentElement.clientHeight || doc.body.clientHeight || win.innerHeight || 0;

            iframe.setAttribute('height', parseFloat(height) - 20);

            doc.open();
            doc.write(html);
            doc.close();

            $('content').removeClass('loader');
            
            var wm = ed.windowManager;
            
            if (typeof wm != 'undefined' && typeof wm.onResize != 'undefined') {
            	wm.onResize.add(function(s) {
            		iframe.setAttribute('height', parseFloat(s.height) - 20);
            	});
            }
        });

    }

});
tinyMCEPopup.onInit.add(PreviewDialog.init, PreviewDialog);