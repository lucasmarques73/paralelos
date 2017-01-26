/**
 * @version		$Id: editor.js 36 2011-01-20 12:59:29Z happy_noodle_boy $
 * @package      JCE
 * @copyright    Copyright (C) 2005 - 2009 Ryan Demmer. All rights reserved.
 * @author		Ryan Demmer
 * @license      GNU/GPL
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
(function() {
	var DOM = tinymce.DOM, Event = tinymce.dom.Event;
	tinymce.create('JContentEditor.Editor.SourceEditor', {
		
		options : {
			advcode		: 1,
	        highlight	: 1,
	        numbers		: 1,
			wrap		: 1,
	        I18n	: {
	            highlight	: 'Highlight',
	            numbers		: 'Line Numbers',
	            wrap		: 'Wrap Long Lines',
				undo		: 'Undo',
				redo		: 'Redo'
	        }
		},
		
		editor : null,
		
		/**
		 * Constructs a new EditorTabs instance.
		 *
		 * @constructor
		 * @method EditorTabs
		 * @param {Object} s Optional settings object.
		 */
		SourceEditor : function(el, p, o) {
			var t = this;
			tinymce.extend(this.options, o);

			this.element = el;
			this.parent  = p;
		},
		
		get : function() {
			return this.editor;
		},
		
		/**
		 * Simple HTML Indentation
		 * @param {String} h HTML string to indent
		 */
		indent : function(h) {
			// simple indentation
			h = h.replace(/<(\/?)(ul|hr|table|meta|link|tbody|tr|object|body|head|html|map)(|[^>]+)>\s*/g, '\n<$1$2$3>\n');
			h = h.replace(/\s*<(p|h[1-6]|blockquote|div|title|style|pre|script|td|li|area)(|[^>]+)>/g, '\n<$1$2>');
			h = h.replace(/<\/(p|h[1-6]|blockquote|div|title|style|pre|script|td|li)>\s*/g, '</$1>\n');
			h = h.replace(/\n\n/g, '\n');
			
			return tinymce.trim(h);
		},
		
		setSize : function() {
			var el 	= this.element, s = tinymce.settings;
			var tbl = DOM.get('jce_source_' + el.id + '_tbl');
			
			var w = DOM.getStyle(el, 'width');
	        var h = DOM.getStyle(el, 'height');
	        
	        if (s.theme_advanced_resizing_use_cookie) {
	            var o = tinymce.util.Cookie.getHash("TinyMCE_" + el.id + "_size");
	            
	            if (o) {
	                w = o.cw;
					h = o.ch;
	            }
	        }
			
			if (s.theme_advanced_resize_horizontal) {
	            var n = DOM.get(el.id + '_tbl');
				if (!n) {
					n = tbl;
				}
				// Make sure that the size is never smaller than the over all ui
	            if (w < n.clientWidth) {
					w = n.clientWidth;
				}
	        }

	        tbl.style.width = tbl.style.height = '';
	        
	        DOM.setStyles(DOM.select('iframe, textarea', tbl), {
	            'height': h,
				'width' : w
	        });
		},
		
		/**
		 * Create textarea element as clone of original textarea
		 */
		createTextArea : function() {
			var el = this.element;

			var parent 	= DOM.get('jce_source_' + el.id + '_parent');
			var div 	= DOM.create('div');
			
			if (!tinymce.isIE && el.style.width == '100%') {
				div.style.marginRight = '10px';
			}
			
			DOM.add(DOM.select('td.mceIframeContainer', parent), div);
			
			var ta = el.cloneNode(true);
			
			// remove name
			ta.removeAttribute('name');
			
			DOM.setAttribs(ta, {
				'id' : 'jce_source_' + el.id + '_textarea'
			});

			ta.className = 'mceEditor';
			
			DOM.add(div, ta);
			DOM.show(ta);
			
			this.setSize();

			return ta;
		},
		
		/**
		 * Create CodeMirror Editor Object
		 */
		createCodeMirror : function() {
			var t = this, el = this.element;

            // Set base url
            var url = tinymce.settings['document_base_url'] + 'plugins/editors/jce/libraries/';
            // Load scripts
            var scriptLoader = new tinymce.dom.ScriptLoader();
            scriptLoader.add(url + 'js/codemirror/codemirror.js');
			
			var parent 	= DOM.get('jce_source_' + el.id + '_parent');
			var div 	= DOM.create('div', {style : 'overflow:hidden;'});
			
			if (!tinymce.isIE && el.style.width == '100%') {
				div.style.paddingRight = '20px';
			}
			
			tinymce.each(['undo', 'redo'], function(n) {
				t.addButton(n);
			});
			
			tinymce.each(['highlight', 'wrap', 'numbers'], function(n) {
				t.addButton(n, true);
			});
			
			DOM.add(DOM.select('td.mceIframeContainer', parent), div);
			
			// set standard parsers (xml,css,javascript)
			var parsers = ['parsers.js'];
			var styles	= [url + 'css/codemirror/colors.css'];
			var base 	= ['base.js'];
			
			/* Closure compiler string (rename editor.js to edit.js)
			 * java -jar compiler.jar --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/util.js --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/stringstream.js --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/select.js --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/undo.js --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/edit.js --js /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/tokenize.js --js_output_file /Users/ryandemmer/Sites/15x/plugins/editors/jce/libraries/js/codemirror/base.js
			 */
			
			// load php parser on demand
			if (tinymce.settings['code_php']) {
				parsers = parsers.concat(parsers, ['parsephp.js', 'parsephphtmlmixed.js', 'tokenizephp.js']);
				styles 	= styles.concat(styles, [url + '/css/codemirror/phpcolors.css']);
			}
            
            scriptLoader.loadQueue(function() {
                // Create new editor
                window.setTimeout(function() {				
					var content = t.indent(el.value);

					var cm = new CodeMirror(div, {
                        content			: content,
                        height			: 'auto',
						width			: '100%',
						path			: url + 'js/codemirror/',
						basefiles		: base, 
                       	parserfile		: parsers,
                        stylesheet		: styles,
                        indentUnit		: 4,
                        reindentOnLoad	: true,
                        initCallback	: function() {
                            // Rest cursor position for Firefox if document is blank
                            if (tinymce.isGecko && el.value == '') {
                                cm.setCode(' ');
                                cm.jumpToLine(1);
                            }
                            // reindent code
                            cm.reindent();
                            
                            DOM.setStyle(cm.frame, 'width', '100%');
                            
                            tinymce.each(['highlight', 'wrap', 'numbers'], function(s) {
                                var n = DOM.get('jce_source_' + el.id + '_' + s);
								t.toggleOption(s, n);
                            });
							
							// resize
					        t.setSize();
							
							// hide loader
							JContentEditor.hideLoader(el);
                        }
                    });
					
					t.editor 	= cm;
					t.editor.visible = true;
					cm.frame.id = 'jce_source_' + el.id + '_iframe';

                    cm.highlight = function(el, s) {
                        var DOM = tinymce.DOM, p = this.wrapping.parentNode, ta = DOM.get('jce_source_' + el.id + '_textarea');

						var loader = JContentEditor.showLoader(el);
						DOM.insertAfter(loader, cm.frame);

                        if (s) {
							if (ta) {
                                // pass code to main textarea
                                el.value = ta.value;
                                // pass code to codemirror
                                this.setCode(ta.value);
                                // remove textarea parent
                                DOM.remove(ta.parentNode);
                            }

                            // show codemirror
                            DOM.show(div);
							
							t.toggleOption('wrap', DOM.get('jce_source_' + el.id + '_wrap'));
							
							this.focus();

                        } else {
							ta = t.createTextArea();

							// transfer source
							ta.value = cm.getCode();
							
                            // hide codemirror
                            DOM.hide(div);
							
							// show new textarea
                            DOM.show(ta.parentNode);
							
							t.toggleOption('wrap', DOM.get('jce_source_' + el.id + '_wrap'));
                        }
						var disabled = ['numbers', 'undo', 'redo'];

                        if (!s) {
						    tinymce.each(disabled, function(v) {
								DOM.removeClass('jce_source_' + el.id + '_' + v, 'mceButtonEnabled');
								DOM.addClass('jce_source_' + el.id + '_' + v, 'mceButtonDisabled');
							});
                        } else {
                             tinymce.each(disabled, function(v) {
								DOM.addClass('jce_source_' + el.id + '_' + v, 'mceButtonEnabled');
								DOM.removeClass('jce_source_' + el.id + '_' + v, 'mceButtonDisabled');
							});
                        }
						
						DOM.remove(loader);
                    };
                    
                    // patch in hide function
                    cm.hide = function() {
                        var p, ta = DOM.get('jce_source_' + el.id + '_textarea');
						
                        if (ta && !DOM.isHidden(ta)) {
							el.value = ta.value;
							p = ta.parentNode;
                        } else {
                            el.value = cm.getCode();
							p = this.wrapping.parentNode;
                        }
						// hide codemirror parent
                        DOM.hide(p);
                    };
                    
                    // patch in show function
                    cm.show = function() {
                        var p, ta = DOM.get('jce_source_' + el.id + '_textarea');
                        
						if (ta && !DOM.isHidden(ta)) {
							ta.value = el.value;
							p = ta.parentNode;
                        } else {
							cm.setCode(el.value);
							
							// Rest cursor position for Firefox if document is blank
                            if (tinymce.isGecko && el.value == '') {
                                cm.setCode(' ');
                                cm.jumpToLine(1);
                            }
							
							p = this.wrapping.parentNode;
                        }
						// show codemirror parent div
						DOM.show(p);
                    };
                }, 10);
            });
		},
		
		/**
		 * Create simple textarea source editor
		 */
		createSourceEditor : function() {
			var el = this.element;
			
			// create textarea
			var ta 		= this.createTextArea();	
			// pass value		
			ta.value 	= el.value;

			// add buttons
			//this.addButton('wrap', true);

			// create editor object
			this.editor = {
				frame 	: DOM.get('jce_source_' + el.id + '_textarea'),
				show 	: function() {
					ta.value = el.value;
					DOM.show(this.frame.parentNode);
				},
				hide : function() {
					el.value = this.frame.value;
					DOM.hide(this.frame.parentNode);
				},
				getCode : function() {
					return this.frame.value;
				},
				setCode : function(v) {
					this.frame.value = v;
				},
				visible : true
			};
			
			this.toggleOption('wrap', DOM.get('jce_source_' + el.id + '_wrap'));

			return ta;
		},
	    
	    /**
	     * Toggle Source Editor
	     */
	    toggleSourceEditor : function() {
	        var el = this.element, parent = this.parent;
			
			var url = tinymce.settings['document_base_url'] + 'plugins/editors/jce/libraries/';
			// load css
			DOM.loadCSS(url + 'css/codemirror/editor.css');

			// create simple textarea
			if (tinymce.isIE6 || this.options.advcode == 0) {				
				var ta = DOM.get('jce_source_' + el.id + '_textarea');
				
				if (!ta) {
					ta = this.createSourceEditor();
				} else {
					ta.value = el.value;
				}
				DOM.show(ta.parentNode);
				// hide loader
				JContentEditor.hideLoader(el);
			// create codemirror editor
			} else {
				var ed = this.editor;
				
				if (!ed) {
					this.createCodeMirror();
				} else {
					var loader = JContentEditor.showLoader(el);
					DOM.insertAfter(loader, ed.frame);
					ed.show();
					ed.visible = true;
					window.setTimeout(function(){
						ed.reindent();
						DOM.remove(loader);
					}, 10);
				}
			}
			
			DOM.show(parent);
	    },
		
		/**
	     * Toggle CodeMirror command
	     * @param {Object} s Option eg: highlight, numbers, wrapping
	     * @param {Object} n Option Checkbox
	     */
	    toggleOption: function(s, n) {
	        var el = this.element, ed = this.editor, b, ln, ta = DOM.get('jce_source_' + el.id + '_textarea'), state;
			
			state = DOM.hasClass(n, 'mceButtonActive') ? 1 : 0;
			
			tinymce.util.Cookie.set('jce_source_' + el.id + '_' + n, state);
	        
	        switch (s) {
	            case 'highlight':
	                ed.highlight(el, state);
	                break;
	            case 'numbers':
	                if (ed) {
						ed.setLineNumbers(state);
						if (tinymce.isIE) {
							ed.wrapping.parentNode.style.paddingRight = (b ? '20px' : '0px');
						}
	                } else {
	                    return false;
	                }
	                break;
	            case 'wrap':
					if (ed) {
						if (ta) {
							this.setWrap(state); 
	                    } else {
	                        b 	= ed.frame.contentWindow.document.body;
							ln 	= DOM.get('jce_source_' + el.id + '_numbers');
	                        
							if (!tinymce.isIE) {
								if (DOM.hasClass(ln, 'mceButtonActive')) {
									// hide line numbers
									ed.setLineNumbers(false);
								}
							}
	                        if (state) {
	                            DOM.addClass(b, 'wrap');
	                        } else {
	                            DOM.removeClass(b, 'wrap');
	                        }
	                        if (!tinymce.isIE) {
								if (DOM.hasClass(ln, 'mceButtonActive')) {
									// show line numbers
									ed.setLineNumbers(true);
								}
							}
	                    }
	                } else {
	                    this.setWrap(state);
	                }
	                break;
				case 'undo':
					 if (ed && !ta) {
					 	ed.undo();
					 }
					break;
				case 'redo':
					if (ed && !ta) {
					 	ed.redo();
					}
					break;
	        }
	    },
		
		getContent : function() {
			var el = this.element, ed = this.editor, ta = DOM.get('jce_source_' + el.id + '_textarea'), v;
			
			if (ta && DOM.hasClass(ta, 'mceEditor')) {
				v = ta.value;
			} else {
				v = ed.getCode();
			}
			
			return this.clean(v);
		},
		
		isVisible : function() {
			if (this.editor) {
				return this.editor.visible;
			}
			return false;
		},
		
		hide : function() {
			this.editor.visible = false;
			this.editor.hide();
		},
		
		// pass content to textarea
		save : function() {
			var v = this.getContent();
			this.element.value = v;
		},
		
		insert : function(v) {
			var el = this.element, ed = this.editor, ta = DOM.get('jce_source_' + el.id + '_textarea');
			
			if (ta && DOM.hasClass(ta, 'mceEditor')) {
				JContentEditor.insertIntoTextarea(ta, v);
			} else {
				ed.replaceSelection(v);
			}
		},
		
		/**
		 * Clean content. Rudimentary cleanup of invalid elements
		 * @param {String} v HTML String
		 */
		clean : function(v) {
			var r, el;
			
			// remove invalid elements
	        tinymce.each(tinymce.explode(tinymce.settings['invalid_elements']), function(n) {
	            r = '<' + n + '[^>]*>([\\s\\S]*?)<\/' + n + '>';
	            v = v.replace(new RegExp(r, 'gi'), '');
	        });
	        // Remove PHP if not enabled
	        if (!tinymce.settings['code_php']) {
	            v = v.replace(/<\?(php)?([\s\S]*?)\?>/gi, '');
	        }
			
			return v;
		},
		
		/**
	     * Translate a string
	     * @param {String} s string to translate
	     */
	    translate: function(s) {
	        return this.options.I18n[s] || s;
	    },
		
		addButton : function(n, sticky) {
			var t = this, el = this.element, state;
			
			var cookie = tinymce.util.Cookie.get('jce_source_' + el.id + '_' + n);
			
			if (cookie == null) {
				cookie = this.options[n];
			}
			
			state = cookie == 1;
			
			var toolbar = DOM.select('table.mceToolbarRow1 tr td', DOM.get('jce_source_' + el.id + '_tbl'));
			var btn 	= DOM.create('td');
			
			var link = DOM.add(btn, 'a', {
				title 	: this.translate(n),
				'class'	: 'mceButton mceButtonEnabled',
				href 	: 'javascript:;',
				id		: 'jce_source_' + el.id + '_' + n
			});
	            
			DOM.add(link, 'span', {
				'class'	: 'mceIcon jce_source_' + n
			});
				
			var len 	= toolbar.length;
			var index 	= len > 1 ? len - 2 : len;
			
			DOM.insertAfter(btn, toolbar[index]);
			
			if (state && sticky) {
	        	DOM.addClass(link, 'mceButtonActive');
	        }
			
	        Event.add(link, 'click', function(e) {
	            e.preventDefault();
	            
	            if (DOM.hasClass(link, 'mceButtonDisabled')) {
	                return false;
	            }
	            
				if (sticky) {			
		            if (DOM.hasClass(link, 'mceButtonActive')) {
		                DOM.removeClass(link, 'mceButtonActive');
						state = 0;
		            } else {
		                DOM.addClass(link, 'mceButtonActive');
						state = 1;
		            }
					
					tinymce.util.Cookie.set(link.id, state);
				}
				
	            t.toggleOption(n, link);
	        });
		},
		
		/**
	     * Set CodeMirror / Textarea word wrapping
	     * @param {Object} el Textarea element
	     * @param {Boolean} s State
	     */
	    setWrap: function(s) {		
			var el = this.element, ta = DOM.get('jce_source_' + el.id + '_textarea'), v, n;
			var wrap = (s) ? 'soft' : 'off';
			
			if (ta) {
				ta.wrap = wrap;
				if (!tinymce.isIE) {
					v = ta.value;
					n = ta.cloneNode(true);
					n.setAttribute("wrap", wrap);
					ta.parentNode.replaceChild(n, ta);
					n.value = v;
					
					ta = n;
				}
				if (s) {
					DOM.addClass(ta, 'wrap');		
					if (tinymce.isIE && !document.querySelector) {
						DOM.addClass(ta, 'ie_wrap');
					}
				} else {
					DOM.removeClass(ta, 'wrap');
					DOM.removeClass(ta, 'ie_wrap');
				}
			}
	    }
	});
})();