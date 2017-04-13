(function ($) {
    var Shortcodes = vc.shortcodes;
	window.VcTwitterScrollerView = vc.shortcode_view.extend({
		firstCallback: true,
	    ready:function (e) {
	        window.VcTwitterScrollerView.__super__.ready.call(this, e);
			var el = this;
			if (this.use_default_content){
				updateTwitterScrollerOpts(this);
			}
			jQuery(el.$el).children('.vc_controls').find('.vc_control-btn-edit').click(function(){ 
				updateTwitterScrollerOpts(el);
			});
	    }
	});
	
	function updateTwitterScrollerOpts(el){
		clearInterval(twitterInterval);
		var twitterInterval = setInterval(function(){
			if (jQuery('#vc_ui-panel-edit-element div[data-vc-ui-element="panel-edit-element-tab"]').children().length){
				if (jQuery('select[name=des_twitter_slideshow]').val() === 'yes'){
					jQuery('input[name=des_twitter_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=des_twitter_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_twitter_slideshow]').change(function(){
					if (jQuery('select[name=des_twitter_slideshow]').val() === 'yes'){
						jQuery('input[name=des_twitter_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_twitter_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_twitter_direction_nav]').val() === 'yes'){
					jQuery('select[name=des_twitter_direction_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_twitter_direction_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_twitter_direction_nav]').change(function(){
					if (jQuery('select[name=des_twitter_direction_nav]').val() === 'yes'){
						jQuery('select[name=des_twitter_direction_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_twitter_direction_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_twitter_control_nav]').val() === 'yes'){
					jQuery('select[name=des_twitter_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_twitter_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_twitter_control_nav]').change(function(){
					if (jQuery('select[name=des_twitter_control_nav]').val() === 'yes'){
						jQuery('select[name=des_twitter_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_twitter_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});
				clearInterval(twitterInterval);
			}
		},300);
	}
})(window.jQuery);