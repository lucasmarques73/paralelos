fx.Slide = Class.create();
fx.Slide.prototype = {
	setOptions: function(options) {
		this.options = {
			delay: 50,
			opacity: false
		}
		Object.extend(this.options, options || {});
	},

	initialize: function(togglers, sliders, options) {
		this.sliders  = sliders;
		this.togglers = togglers;
		this.setOptions(options);
		sliders.each(function(el, i){
			options.onComplete = function(){
				if (el.offsetHeight > 0) el.style.height = '1%';
			}
			el.fx = new fx.Combo(el, options);
			el.fx.hide();
		});
		var found = false;
		togglers.each(function(toggler, i){
		var div = Element.find(toggler, 'nextSibling'); //element.find is located in prototype.lite

			if (window.location.href.indexOf(toggler.title) > 0) {
				this.toggle(div, toggler);
				found = true;
			}
			if (!found) {
				toggler.onclick = function(){
					 this.toggle(sliders[0], toggler);
				}.bind(this);
			}
			toggler.onclick = function(){
				this.toggle(sliders[i], toggler);
			}.bind(this);

		}.bind(this));
	},

	toggle: function(slider, toggler){

		this.sliders.each(function(el, i){
			if (el.offsetHeight > 0) this.clear(el);
		}.bind(this));

		this.togglers.each(function(el, i){
			Element.removeClassName(el, 'title-smenu-down');
		}.bind(this));
		if (slider.offsetHeight == 0) {
			setTimeout(function(){this.clear(slider);}.bind(this), this.options.delay);
			Element.addClassName(toggler, 'title-smenu-down');
		}
	},

	clear: function(slider){
		slider.fx.clearTimer();
		slider.fx.toggle();
	}
}