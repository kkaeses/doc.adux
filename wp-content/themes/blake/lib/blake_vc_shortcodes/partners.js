(function ($) {
    var Shortcodes = vc.shortcodes;

	window.VcPartnersView = vc.shortcode_view.extend({
		ready:function (e) {
	        window.VcPartnersView.__super__.ready.call(this, e);
			var el = this;
			if (this.use_default_content){
				updatePartnersOpts(el);
			}
			jQuery(el.$el).children('.vc_controls').find('.vc_control-btn-edit').click(function(){ 
				updatePartnersOpts(el);
			});
	    }
	});
	
	function updatePartnersOpts(el){
		clearInterval(partnersInterval);
		var partnersInterval = setInterval(function(){
			if (jQuery('#vc_ui-panel-edit-element div[data-vc-ui-element="panel-edit-element-tab"]').children().length){
				if (jQuery('select[name=des_partners_owl_autoplay]').val() === 'yes'){
					jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_partners_owl_autoplay]').change(function(){
					if (jQuery('select[name=des_partners_owl_autoplay]').val() === 'yes'){
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=innerborder]').val() === 'yes' && jQuery('select[name=scroller]').val() === "no"){
					jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=innerborder]').unbind('change').change(function(){
					if (jQuery('select[name=innerborder]').val() === 'yes' && jQuery('select[name=scroller]').val() === "no"){
						jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','none');
					}	
				});

				if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
					jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_partners_owl_navigation]').unbind('change').change(function(){
					if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
					jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_partners_owl_pagination]').unbind('change').change(function(){
					if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_partners_owl_autoplay]').val() === "yes"){
					jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_partners_owl_autoplay]').unbind('change').change(function(){
					if (jQuery('select[name=des_partners_owl_autoplay]').val() === "yes"){
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=scroller]').val() === "yes"){
					jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','block');
					jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').add(jQuery('input[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=innerborder]').closest('.vc_shortcode-param')).add(jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param')).css('display','none');

					if (jQuery('select[name=des_partners_owl_autoplay]').val() === "yes"){
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
					}

					if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}

					if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
					}

					if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes"){
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
					if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes"){
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
					}
				} else {
					jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','none');	
					jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').add(jQuery('input[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=innerborder]').closest('.vc_shortcode-param')).css('display','block');

					if (jQuery('select[name=innerborder]').val() === 'yes' && jQuery('select[name=scroller]').val() === "no"){
						jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','none');
					}

				}
				jQuery('select[name=scroller]').unbind('change').change(function(){
					if (jQuery('select[name=scroller]').val() === "yes"){
						jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','block');
						jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').add(jQuery('input[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=innerborder]').closest('.vc_shortcode-param')).add(jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param')).css('display','none');

						if (jQuery('select[name=des_partners_owl_autoplay]').val() === "yes"){
							jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('input[name=des_partners_owl_animation_speed]').closest('.vc_shortcode-param').css('display','none');
						}

						if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
							jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
						}

						if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes" && jQuery('select[name=scroller]').val() === "yes"){
							jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
						}


	if (jQuery('select[name=des_partners_owl_navigation]').val() === "yes"){
							jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_partners_owl_nav_style]').closest('.vc_shortcode-param').css('display','none');
						}
						if (jQuery('select[name=des_partners_owl_pagination]').val() === "yes"){
							jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_partners_owl_pag_style]').closest('.vc_shortcode-param').css('display','none');
						}
					} else {
						jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').add(jQuery('select[name=des_partners_owl_autoplay]').closest('.vc_shortcode-param').nextUntil(jQuery('select[name=number_per_row]').closest('.vc_shortcode-param'))).css('display','none');	
						jQuery('select[name=number_per_row]').closest('.vc_shortcode-param').add(jQuery('input[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=row_height]').closest('.vc_shortcode-param')).add(jQuery('select[name=innerborder]').closest('.vc_shortcode-param')).css('display','block');

						if (jQuery('select[name=innerborder]').val() === 'yes' && jQuery('select[name=scroller]').val() === "no"){
							jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('input[name=inner_border_color]').closest('.vc_shortcode-param').css('display','none');
						}

					}
				});
				
				//the categories mambo jambo
				if (jQuery('.partners_cats_field').val() == -1 || jQuery('.partners_cats_field').val() == "" || jQuery('.partners_cats_field').val() == "0"){
					jQuery('.vc_wrapper-param-type-partners_cats .partners_categories input').attr('checked','checked');
				}
				
				clearInterval(partnersInterval);
			}
		},300);
	}
})(window.jQuery);
