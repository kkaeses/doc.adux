(function ($) {
    var Shortcodes = vc.shortcodes;

	window.VcButtonsView = vc.shortcode_view.extend({
		ready:function (e) {
	        window.VcButtonsView.__super__.ready.call(this, e);
			var el = this;
			if (this.use_default_content){
				updateButtonsOpts(this);
			}
			jQuery(el.$el).children('.vc_controls').find('.vc_control-btn-edit').click(function(){ 
				updateButtonsOpts(el);
			});
	    }
	});
	
	function updateButtonsOpts(el){
		var buttonsInt = setInterval(function(){
			if (jQuery('#vc_ui-panel-edit-element div[data-vc-ui-element="panel-edit-element-tab"]').children().length){
				jQuery('select[name=icon_enabled]').unbind('change');
				if (jQuery('select[name=icon_enabled]').val() == 'yes') jQuery('.blake_fa_block').closest('.vc_shortcode-param').css('display','block');
				else jQuery('.blake_fa_block').closest('.vc_shortcode-param').css('display','none');

				jQuery('select[name=icon_enabled]').change(function(){
					if (jQuery('select[name=icon_enabled]').val() == 'yes') jQuery('.blake_fa_block').closest('.vc_shortcode-param').css('display','block');
					else jQuery('.blake_fa_block').closest('.vc_shortcode-param').css('display','none');
				});
				clearInterval(buttonsInt);
			}
		}, 300);
	}
})(window.jQuery);