(function ($) {
    var Shortcodes = vc.shortcodes;

	window.VcTeamView = vc.shortcode_view.extend({
		ready:function (e) {
	        window.VcTeamView.__super__.ready.call(this, e);
			if (this.use_default_content){
				updateTeamOpts(this, 300);
			}
			jQuery(this.$el).children('.vc_controls').find('.vc_control-btn-edit').click(function(){ 
				updateTeamOpts(this, 300);
			});
	    }
	});
	
	function updateTeamOpts(el, timer){
		var teamInterval = setInterval(function(){
			if (jQuery('#vc_ui-panel-edit-element div[data-vc-ui-element="panel-edit-element-tab"]').children().length){
				clearInterval(teamInterval);
				if (jQuery('select[name=des_team_owl_autoplay]').val() === "yes"){
					jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_team_owl_autoplay]').change(function(){
					if (jQuery('select[name=des_team_owl_autoplay]').val() === "yes"){
						jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_team_owl_navigation]').val() === 'yes'){
					jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_team_owl_navigation]').change(function(){
					if (jQuery('select[name=des_team_owl_navigation]').val() === 'yes'){
						jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_team_owl_pagination]').val() === 'yes'){
					jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_team_owl_pagination]').change(function(){
					if (jQuery('select[name=des_team_owl_navigation]').val() === 'yes'){
						jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=scroller]').val() === "yes"){
					jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','block');
					jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').nextAll().andSelf().not('script').css('display','none');
					if (jQuery('select[name=des_team_owl_autoplay]').val() === "yes"){
						jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
					}
					if (jQuery('select[name=des_team_owl_navigation]').val() === 'yes'){
						jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
					if (jQuery('select[name=des_team_owl_pagination]').val() === 'yes'){
						jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
					}
				} else {
					jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','none');	
					jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').andSelf().nextAll().not('script').css('display','block');						
				}
				jQuery('select[name=scroller]').change(function(){
					if (jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','block');
						jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').nextAll().andSelf().not('script').css('display','none');
						if (jQuery('select[name=des_team_owl_autoplay]').val() === "yes"){
							jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('input[name=des_team_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
						}
						if (jQuery('select[name=des_team_owl_navigation]').val() === 'yes'){
							jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_team_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
						}
						if (jQuery('select[name=des_team_owl_pagination]').val() === 'yes'){
							jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_team_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
						}
					} else {
						jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_team_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','none');	
						jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').nextAll().andSelf().not('script').css('display','block');						
					}
				});
				
				//the categories mambo jambo
				if (jQuery('.team_cats_field').val() == -1 || jQuery('.team_cats_field').val() == "" || jQuery('.team_cats_field').val() == "0"){
					jQuery('.vc_wrapper-param-type-team_cats .team_categories input').attr('checked','checked');
				}
			}
		},timer);
	}
})(window.jQuery);
