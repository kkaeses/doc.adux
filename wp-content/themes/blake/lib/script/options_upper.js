jQuery(document).ready(function($){ 
	
	/* custom css */
	var _default_custom_css = jQuery('#enable_custom_css').val();
	jQuery('#enable_custom_css').change(function(){
		if (jQuery('#enable_custom_css').val() == "on"){
			jQuery('#enable_custom_css').parent().next().next().fadeIn(500);
		} else {
			jQuery('#enable_custom_css').parent().next().next().fadeOut(500);
		} 
	}).trigger('change');
	
	/* website loader options */
	var _default_website_loader = jQuery('#blake_enable_website_loader').val();
	jQuery('#blake_enable_website_loader').change(function(){
		if (jQuery('#blake_enable_website_loader').val() == "on"){
			jQuery('#blake_website_loader').closest('.option').add(jQuery('#blake_enable_website_loader_percentage').closest('.option')).fadeIn(500);
		} else {
			jQuery('#blake_website_loader').closest('.option').add(jQuery('#blake_enable_website_loader_percentage').closest('.option')).fadeOut(500);
		}
	}).trigger('change');
	
	
	/* body boxed layout options */
	jQuery('#blake_bodybg_type').change(function(){
		if (jQuery(this).val() == 'image') {
			jQuery('#upload-blake_bodybg_type_image').closest('.option').fadeIn(500);
			jQuery('#blake_bodybg_type_color').closest('.option').fadeOut(500);
		} else {
			jQuery('#upload-blake_bodybg_type_image').closest('.option').fadeOut(500);
			jQuery('#blake_bodybg_type_color').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	jQuery('#blake_body_type').change(function(){
		if (jQuery(this).val() == 'body_boxed'){
			jQuery('#blake_bodybg_type').trigger('change').closest('.option').fadeIn(500);
		} else {
			jQuery(this).closest('.option').nextAll().fadeOut(500);
		}
	}).trigger('change');
	
	/* footer custom text editor */
	var submiter = jQuery('.textarea_wysiwyg_container input#submit');
		submiter.css('display','none');
	jQuery('input.save-button').click(function(){ submiter.click(); });
	
	/* footer - secondary one. */
	if (!jQuery('.blake_footer_display_social_icons').length){
		jQuery('#blake_sec_footer_social_icons_size').parent()
			.add(jQuery('#blake_sec_footer_social_icons_color').parent())
			.add(jQuery('#blake_sec_footer_social_icons_hover_color').parent())
		.css('display','none');
	}
	
	/* headers and menus */
	if (jQuery('.blake_fixed_menu').html() == 'on' && jQuery('.blake_header_shrink_effect').html() == 'on' && jQuery('.blake_header_after_scroll').html() == 'on'){
		jQuery('#blake_logo_after_scroll_size').parent().prev().nextAll().andSelf().css('display','block');
		jQuery('#blake_logo_font').parent().nextUntil(jQuery('#blake_logo_margin_top').parent()).andSelf()
			.add(jQuery('#blake_logo_after_scroll_size').parent().nextUntil(jQuery('#blake_logo_after_scroll_margin_top').parent()).andSelf())
			.css('display','none');
	} else {
		jQuery('#blake_logo_after_scroll_size').parent().prev().nextAll().andSelf().css('display','none');
		if (jQuery('.blake_header_after_scroll').html() == 'on'){

		} else {
			jQuery('#blake_headerbg_after_scroll_type_light').parent().prev().nextAll().andSelf().css('display','none');
// 			jQuery('#blake_menu_after_scroll_bg_color_light').parent().prev().nextAll().andSelf().css('display','none');
			jQuery('#blake_headerbg_after_scroll_type_dark').parent().prev().nextAll().andSelf().css('display','none');
// 			jQuery('#blake_menu_after_scroll_bg_color_dark').parent().prev().nextAll().andSelf().css('display','none');

		}
	}
	
	/* logo type */
/* 	if (jQuery('.blake_logo_type.hidden').html() != 'text') */ jQuery('#blake_logo_font').parent().nextUntil(jQuery('#blake_logo_margin_top').parent()).andSelf()
		.add(jQuery('#blake_logo_after_scroll_size').parent().nextUntil(jQuery('#blake_logo_after_scroll_margin_top').parent()).andSelf())
		.css('display','none');
	
	if (jQuery('.blake_header_after_scroll').html() == 'on'){
		//menu
		if (jQuery('.blake_header_shrink_effect').html() == 'off'){
			jQuery('#blake_menu_after_scroll_font_size').closest('.option')
				.add(jQuery('#blake_menu_after_scroll_margin_top').closest('.option'))
				.add(jQuery('#blake_menu_after_scroll_padding_bottom').closest('.option'))
			.css('display','none');
		}
		//background afterscroll options
		jQuery('#blake_headerbg_after_scroll_type').change(function(){
			switch (jQuery('#blake_headerbg_after_scroll_type').val()){
				case "color":
					jQuery('#blake_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#blake_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','block');
					jQuery('#blake_headerbg_after_scroll_image').closest('.option')
						.add(jQuery('#blake_headerbg_after_scroll_pattern').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_custom_pattern').closest('.option'))
					.css('display','none');
				break;
				case "image":
					jQuery('#blake_headerbg_after_scroll_image').closest('.option').css('display','block');
					jQuery('#blake_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#blake_headerbg_after_scroll_pattern').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
				case "pattern":
					jQuery('#blake_headerbg_after_scroll_pattern').closest('.option').css('display','block');
					jQuery('#blake_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#blake_headerbg_after_scroll_image').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
				case "custom_pattern":
					jQuery('#blake_headerbg_after_scroll_pattern').closest('.option').css('display','block');
					jQuery('#blake_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#blake_headerbg_after_scroll_image').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#blake_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
			}	
		});
		jQuery('#blake_headerbg_after_scroll_type').trigger('change');	
	} else {
		// no after scroll neither shrink 
		jQuery('#blake_menu_after_scroll_font_size').closest('.option').prev().nextAll().andSelf().css('display','none');
	}

	jQuery('#blake_social_icons_style_four').parent().next().find('p').appendTo(jQuery('#blake_social_icons_style_four').parent());
	jQuery('#blake_social_icons_style_four').parent().next().remove();
	jQuery('#blake_social_icons_style_four').siblings('p').css({'clear':'both','float':'left'});

	/*limit portfolio custom permalink*/
	jQuery('#blake_portfolio_permalink').attr('maxlength',20);
	jQuery('#blake_portfolio_permalink').parent().next().css({
		'margin-top': '-15px',
		'z-index': 81,
		'background': 'white',
		'border-bottom': '1px solid #EDEDED',
		'color':'#999'
	});

	/* header style type */
	jQuery('#blake_header_style_type').parent().css('display','none');
	jQuery('#blake_header_style_type option').each(function(e){
		var alt = "";
		switch(e){
			case 0:
				alt = "ESQ: logo ---- DIR: menu + socials";
			break;
			case 1:
				alt = "ESQ: logo + icons ---- DIR: socials";
			break;
			case 2:
				alt = "CENTER: logo + menu + socials possivelmente (tudo centrado)";
			break;
			case 3:
				alt = "CENTER: metade menu + logo + metade menu";
			break;
		}
		if (jQuery(this).is(':selected')){
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container selected"><img class="style-'+e+'" src="" alt="'+alt+'" /></div>');
		} else {
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container"><img class="style-'+e+'" src="" alt="'+alt+'" /></div>');
		}
	});
	jQuery('#blake_header_style_type').parents('.sub-navigation-container').on("click", "img", function(){
		var idx = jQuery(this).attr('class').split('le-');
		jQuery('#blake_header_style_type').val( jQuery('#blake_header_style_type option').eq(idx[1]).val() );
		jQuery(this).parent().addClass('selected').siblings().removeClass('selected');
	});
	/* endof header style type */

	var def_sidebars = jQuery('#sidebar_name_list').html();

	jQuery('#tab_navigation-9-customcss textarea').keydown(function(e) {
	    if(e.keyCode === 9) { // tab was pressed
	        // get caret position/selection
	        var start = this.selectionStart;
	        var end = this.selectionEnd;
	
	        var $this = $(this);
	        var value = $this.val();
	
	        $this.val(value.substring(0, start)
	                    + "\t"
	                    + value.substring(end));
	
	        this.selectionStart = this.selectionEnd = start + 1;
	        e.preventDefault();
	    }
	});

	jQuery('#blake_export_options_button, #blake_export_style_options_button').css('top',0).parent().find('br').remove();

	/*panel options*/
	jQuery('#blake_import_options_button').parent().append('<a class="blake-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="blake_apply_imported_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#blake_import_options_button').siblings('.blake-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#blake_import_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#blake_reset_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#blake_reset_options_button').siblings('ul').css('display','none');
	jQuery('#blake_reset_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlPath = jQuery('#templatepath').html()+"/blake_original_panel_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	/*panel style options*/
	jQuery('#blake_import_style_options_button').parent().append('<a class="blake-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="blake_apply_imported_style_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#blake_import_style_options_button').siblings('.blake-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#blake_import_style_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#blake_reset_style_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#blake_reset_style_options_button').siblings('ul').css('display','none');
	jQuery('#blake_reset_style_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlPath = jQuery('#templatepath').html()+"/blake_original_panel_style_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	var _default_menu_add_border = jQuery('#blake_menu_add_border').val();
	jQuery('#blake_menu_add_border').change(function(){
		if (jQuery(this).val() == "on"){
			jQuery('#blake_menu_border_color').parent().fadeIn(500);
		} else {
			jQuery('#blake_menu_border_color').parent().fadeOut(500);
		}
	}).trigger('change');
	
	var _default_ajax_search = jQuery('#blake_enable_ajax_search').val();
	jQuery('#blake_enable_ajax_search').change(function(){
		if (jQuery(this).val() == "on"){
			jQuery('#blake_search_show_author').parent().prev().nextAll().andSelf().fadeIn(500);
		} else jQuery('#blake_search_show_author').parent().prev().nextAll().andSelf().fadeOut(500);
	}).trigger('change');
	
	var _default_search = jQuery('#blake_enable_search').val();
	jQuery('#blake_enable_search').change(function(){
		if (jQuery(this).val() == "on" ){
			jQuery(this).parent().nextUntil(jQuery('#blake_search_sidebars_available').parent().next()).fadeIn(500);
			jQuery('#blake_enable_ajax_search').trigger('change');
		} else jQuery(this).parent().nextAll().fadeOut(500);
	}).trigger('change');
	
	var _default_footer_display_social_icons = jQuery('#blake_footer_display_social_icons').val();
	jQuery('#blake_footer_display_social_icons').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery('#blake_footer_social_icons_alignment').parent().fadeIn(500);
		} else {
			jQuery('#blake_footer_social_icons_alignment').parent().fadeOut(500);
		}
	}).trigger('change');
	
	var _default_footer_display_custom_text = jQuery('#blake_footer_display_custom_text').val();
	jQuery('#blake_footer_display_custom_text').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery('#blake_footer_custom_text').closest('.option').add(jQuery('#blake_footer_custom_text_alignment').closest('.option')).fadeIn(500);
		} else {
			jQuery('#blake_footer_custom_text').closest('.option').add(jQuery('#blake_footer_custom_text_alignment').closest('.option')).fadeOut(500);
		}
	}).trigger('change');
	
	var _default_footer_display_logo = jQuery('#blake_footer_display_logo').val();
	jQuery('#blake_footer_display_logo').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery(this).parent().nextUntil(jQuery('#blake_footer_display_social_icons').parent()).css('display','block');
		} else {
			jQuery(this).parent().nextUntil(jQuery('#blake_footer_display_social_icons').parent()).css('display','none');
		}
	}).trigger('change');
	


	
	var _default_under_construction = jQuery('#blake_enable_under_construction').val();
	if (_default_under_construction === "on"){
		jQuery('#blake_under_construction_page').parent().fadeIn(500);
	} else {
		jQuery('#blake_under_construction_page').parent().fadeOut(500);
	}
	jQuery('#blake_enable_under_construction').change(function(){
		if (_default_under_construction === "on"){
			jQuery('#blake_under_construction_page').parent().fadeIn(500);
		} else {
			jQuery('#blake_under_construction_page').parent().fadeOut(500);
		}		
	});
	
	var _default_animate_thumbnails = jQuery('#blake_animate_thumbnails').val();
	if (_default_animate_thumbnails === "on"){
		jQuery('#blake_thumbnails_effect').parent().fadeIn(500);
	} else {
		jQuery('#blake_thumbnails_effect').parent().fadeOut(500);
	}
	jQuery('#blake_animate_thumbnails').change(function(){
		if (_default_animate_thumbnails === "on"){
			jQuery('#blake_thumbnails_effect').parent().fadeIn(500);
		} else {
			jQuery('#blake_thumbnails_effect').parent().fadeOut(500);
		}
	});
	
	var _default_body_shadow = jQuery('#blake_body_shadow').val();
	if (_default_body_shadow === "on"){
		jQuery('#blake_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#blake_body_shadow').parent().next().fadeOut(500).addClass('optoff');
	}
	jQuery('#blake_body_shadow').change(function(){
		if (_default_body_shadow === "on"){
			jQuery('#blake_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#blake_body_shadow').parent().next().fadeOut(500).addClass('optoff');
		}
	});
	
	//body background type
	var _default_body_background = jQuery('#blake_body_type').val();
	switch(_default_body_background){
		case "image":
			jQuery('#blake_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().fadeIn(500).removeClass('optoff');
			break;
		case "color":
			jQuery('#blake_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#blake_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
		case "pattern": case "custom_pattern":
			jQuery('#blake_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#blake_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#blake_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#blake_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
	}
	jQuery('#blake_body_type').change(function(){
		var _default_body_background = jQuery('#blake_body_type').val();
		switch(_default_body_background){
			case "image":
				jQuery('#blake_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().fadeIn(500).removeClass('optoff');
				break;
			case "color":
				jQuery('#blake_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#blake_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
			case "pattern": case "custom_pattern":
				jQuery('#blake_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#blake_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#blake_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#blake_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
		}
	});
	
	//show primary footer options
	var _default_show_primary_footer = jQuery('#blake_show_primary_footer').val();
	jQuery('#blake_show_primary_footer').change(function(){
		if (_default_show_primary_footer === "on"){
			jQuery('#blake_show_primary_footer').parent().nextUntil(jQuery('#blake_footerbg_headingscolor').parent().next()).fadeIn(500);
			jQuery('#blake_footerbg_type').trigger('change');
		} else {
			jQuery('#blake_show_primary_footer').parent().nextUntil(jQuery('#blake_footerbg_headingscolor').parent().next()).fadeOut(500);
		}
	}).trigger('change');
	
	//show secondary footer options
	var _default_show_secondary_footer = jQuery('#blake_show_sec_footer').val();
	jQuery('#blake_show_sec_footer').change(function(){
		if (_default_show_secondary_footer === "on"){
			jQuery('#blake_show_sec_footer').parent().nextAll().fadeIn(500);
			jQuery('#blake_sec_footerbg_type').trigger('change');
		} else {
			jQuery('#blake_show_sec_footer').parent().nextAll().fadeOut(500);
		}
	}).trigger('change');
	
	var _default_contentbg_type = jQuery('#blake_contentbg_type').val();
	switch (_default_contentbg_type){
		case "color":
			jQuery('#blake_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#blake_contentbg_type').change(function(){
		switch (_default_contentbg_type){
			case "color":
				jQuery('#blake_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}	
	});
	
	var _default_headerbg_type_light = jQuery('#blake_headerbg_type_light').val();
	switch (_default_headerbg_type_light){
		case "color":
			jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_headerbg_image_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#blake_headerbg_type_light').change(function(){
		switch (_default_headerbg_type_light){
			case "color":
				jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_headerbg_image_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});


	var _default_headerbg_after_scroll_type_light = jQuery('#blake_headerbg_after_scroll_type_light').val();
	switch (_default_headerbg_after_scroll_type_light){
		case "color":
			jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#blake_headerbg_after_scroll_type_light').change(function(){
		switch (_default_headerbg_after_scroll_type_light){
			case "color":
				jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});

	
	var _default_headerbg_type_dark = jQuery('#blake_headerbg_type_dark').val();
	switch (_default_headerbg_type_dark){
		case "color":
			jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_headerbg_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#blake_headerbg_type_dark').change(function(){
		switch (_default_headerbg_type_dark){
			case "color":
				jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_headerbg_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});
	
	var _default_headerbg_after_scroll_type_dark = jQuery('#blake_headerbg_after_scroll_type_dark').val();
	switch (_default_headerbg_after_scroll_type_dark){
		case "color":
			jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#blake_headerbg_after_scroll_type_dark').change(function(){
		switch (_default_headerbg_after_scroll_type_dark){
			case "color":
				jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});
	
	
	var _default_toppanelbg_type = jQuery('#blake_toppanelbg_type').val();
	switch (_default_toppanelbg_type){
		case "color":
			jQuery('#blake_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#blake_toppanelbg_type').change(function(){
		switch (_default_toppanelbg_type){
			case "color":
				jQuery('#blake_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_sec_footerbg_type = jQuery('#blake_sec_footerbg_type').val();
	switch (_default_sec_footerbg_type){
		case "color":
			jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
	}
	jQuery('#blake_sec_footerbg_type').change(function(){
		switch (_default_sec_footerbg_type){
			case "color":
				jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
		}
	});
	
	
	var _default_footerbg_type = jQuery('#blake_footerbg_type').val();
	switch (_default_footerbg_type){
		case "color":
			jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#blake_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#blake_footerbg_type').change(function(){
		switch (_default_footerbg_type){
			case "color":
				jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#blake_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#blake_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_twitter_newsletter_type = jQuery('#blake_twitter_newsletter_type').val();
	switch (_default_twitter_newsletter_type){
		case "color":
			jQuery('#blake_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#blake_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#blake_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
			jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#blake_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#blake_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
			jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#blake_twitter_newsletter_type').change(function(){
		switch (_default_twitter_newsletter_type){
			case "color":
				jQuery('#blake_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#blake_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#blake_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
				jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#blake_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#blake_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
				jQuery('#blake_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	//style > body - body layout type
	var _default_body_layout_type = jQuery('#blake_body_layout_type').val();
	if (_default_body_layout_type === "full"){
		jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().next().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().next().fadeOut(500);
		jQuery('#blake_body_layout_type').parent().next().fadeOut(500);
	} else {
		if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().next().fadeIn(500);
		if (!jQuery('#blake_body_layout_type').parent().next().hasClass('optoff'))
			jQuery('#blake_body_layout_type').parent().next().fadeIn(500);
	}
	jQuery('#blake_body_layout_type').change(function(){
		if (_default_body_layout_type === "full"){
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().next().fadeOut(500);
			jQuery('#blake_body_layout_type').parent().next().fadeOut(500);
		} else {
			if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().next().fadeIn(500);
			if (!jQuery('#blake_body_layout_type').parent().next().hasClass('optoff'))
				jQuery('#blake_body_layout_type').parent().next().fadeIn(500);
		}
	});
	
	var _default_overlay_type = jQuery('#blake_pagetitle_overlay_type').val();
	jQuery('#blake_pagetitle_overlay_type').change(function(){
		_default_overlay_type = jQuery('#blake_pagetitle_overlay_type').val();
		if (jQuery('#blake_pagetitle_overlay_type').val() == "color"){
			jQuery('#blake_pagetitle_overlay_color').closest('.option').fadeIn(500);
			jQuery('#blake_pagetitle_overlay_pattern').closest('.option').fadeOut(500);
		} else {
			jQuery('#blake_pagetitle_overlay_color').closest('.option').fadeOut(500);
			jQuery('#blake_pagetitle_overlay_pattern').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	var _default_overlay_type_shop = jQuery('#blake_pagetitle_overlay_type_shop').val();
	jQuery('#blake_pagetitle_overlay_type_shop').change(function(){
		_default_overlay_type_shop = jQuery('#blake_pagetitle_overlay_type_shop').val();
		if (jQuery('#blake_pagetitle_overlay_type_shop').val() == "color"){
			jQuery('#blake_pagetitle_overlay_color_shop').closest('.option').fadeIn(500);
			jQuery('#blake_pagetitle_overlay_pattern_shop').closest('.option').fadeOut(500);
		} else {
			jQuery('#blake_pagetitle_overlay_color_shop').closest('.option').fadeOut(500);
			jQuery('#blake_pagetitle_overlay_pattern_shop').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	var _default_overlay_enable = jQuery('#blake_pagetitle_image_overlay').val();
	jQuery('#blake_pagetitle_image_overlay').change(function(){
		_default_overlay_enable = jQuery('#blake_pagetitle_image_overlay').val();
		if (jQuery('#blake_pagetitle_image_overlay').val() == "on"){
			jQuery('#blake_pagetitle_overlay_opacity').closest('.option').add(jQuery('#blake_pagetitle_overlay_type').closest('.option')).fadeIn(500);
			jQuery('#blake_pagetitle_overlay_type').change();
		} else {
			jQuery('#blake_pagetitle_overlay_type').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).andSelf().fadeOut(500);
		}
	}).trigger('change');
	
	var _default_overlay_enable_shop = jQuery('#blake_pagetitle_image_overlay_shop').val();
	jQuery('#blake_pagetitle_image_overlay_shop').change(function(){
		_default_overlay_enable_shop = jQuery('#blake_pagetitle_image_overlay_shop').val();
		if (jQuery('#blake_pagetitle_image_overlay_shop').val() == "on"){
			jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').add(jQuery('#blake_pagetitle_overlay_type_shop').closest('.option')).fadeIn(500);
			jQuery('#blake_pagetitle_overlay_type_shop').change();
		} else {
			jQuery('#blake_pagetitle_overlay_type_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).andSelf().fadeOut(500);
		}
	}).trigger('change');
	
	//style > header - background type
	var _default_header_bkg = jQuery('#blake_header_type').val();
	jQuery('#blake_header_type').change(function(){
		var _default_header_bkg = jQuery('#blake_header_type').val();
		switch (_default_header_bkg){
			case "without": 			
				jQuery('#blake_header_type').parent().nextAll().fadeOut(500);
			break;
			case "none": case "border":
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
				.fadeIn(500);
				
				
				
				jQuery('#upload-blake_header_image').parent()
					.add(jQuery('#blake_header_color').parent()).add(jQuery('#blake_header_opacity').parent())
					.add(jQuery('#blake_header_pattern').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern').parent())
				.fadeOut(500);
				
				jQuery('#blake_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).andSelf().fadeOut();
				
			break;
			case "image":
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
				.fadeIn(500);
				
				jQuery('#upload-blake_header_image').parent().fadeIn(500);
				
				jQuery('#blake_header_color').parent().add(jQuery('#blake_header_opacity').parent())
					.add(jQuery('#blake_header_pattern').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern').parent())
					.add(jQuery('#blake_banner_slider').parent())
				.fadeOut(500);
				
				jQuery('#blake_pagetitle_image_parallax').closest('.option').add(jQuery('#blake_pagetitle_image_overlay').closest('.option')).fadeIn(500);
				jQuery('#blake_pagetitle_image_overlay').change();
				
			break;
			case "color":
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_header_color').parent()
					.add(jQuery('#blake_header_opacity').parent())
				.fadeIn(500);
				
				jQuery('#upload-blake_header_image').parent()
					.add(jQuery('#blake_header_pattern').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern').parent())
					.add(jQuery('#blake_banner_slider').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "pattern":
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_header_pattern').closest('.option').fadeIn(500);
				
				jQuery('#upload-blake_header_image').parent()
					.add(jQuery('#blake_header_color').parent()).add(jQuery('#blake_header_opacity').parent())
					.add(jQuery('#upload-blake_header_custom_pattern').parent())
					.add(jQuery('#blake_banner_slider').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "custom_pattern":
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-blake_header_custom_pattern').parent().fadeIn(500);
				
				jQuery('#upload-blake_header_image').parent()
					.add(jQuery('#blake_header_color').parent()).add(jQuery('#blake_header_opacity').parent())
					.add(jQuery('#blake_header_pattern').closest('.option'))
					.add(jQuery('#blake_banner_slider').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "banner":
			
				jQuery('#blake_header_text_alignment').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_banner_slider').parent().fadeIn(500);
				
				jQuery('#upload-blake_header_image').parent()
					.add(jQuery('#blake_header_color').parent()).add(jQuery('#blake_header_opacity').parent())
					.add(jQuery('#blake_header_pattern').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
		}
		if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "custom_pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
			jQuery('#blake_header_height').parent().fadeIn(500);
			jQuery('#blake_header_text_alignment').parent().fadeIn(500);
			jQuery('#blake_hide_pagetitle').add(jQuery('#blake_hide_sec_pagetitle')).add(jQuery('#blake_breadcrumbs')).trigger('change');
		}
	}).trigger('change');
	
	
	var _default_header_bkg_shop = jQuery('#blake_header_type_shop').val();
	jQuery('#blake_header_type_shop').change(function(){
		var _default_header_bkg_shop = jQuery('#blake_header_type_shop').val();
		switch (_default_header_bkg_shop){
			case "without": 			
				jQuery('#blake_header_type_shop').parent().nextAll().fadeOut(500);
			break;
			case "none": case "border":
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
				.fadeIn(500);
				
				
				
				jQuery('#upload-blake_header_image_shop').parent()
					.add(jQuery('#blake_header_color_shop').parent()).add(jQuery('#blake_header_opacity_shop').parent())
					.add(jQuery('#blake_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern_shop').parent())
				.fadeOut(500);
				
				jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).andSelf().fadeOut();
				
			break;
			case "image":
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
				.fadeIn(500);
				
				jQuery('#upload-blake_header_image_shop').parent().fadeIn(500);
				
				jQuery('#blake_header_color_shop').parent().add(jQuery('#blake_header_opacity_shop').parent())
					.add(jQuery('#blake_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern_shop').parent())
					.add(jQuery('#blake_banner_slider_shop').parent())
				.fadeOut(500);
				
				jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').add(jQuery('#blake_pagetitle_image_overlay_shop').closest('.option')).fadeIn(500);
				jQuery('#blake_pagetitle_image_overlay_shop').change();
				
			break;
			case "color":
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_header_color_shop').parent()
					.add(jQuery('#blake_header_opacity_shop').parent())
				.fadeIn(500);
				
				jQuery('#upload-blake_header_image_shop').parent()
					.add(jQuery('#blake_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern_shop').parent())
					.add(jQuery('#blake_banner_slider_shop').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "pattern":
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_header_pattern_shop').closest('.option').fadeIn(500);
				
				jQuery('#upload-blake_header_image_shop').parent()
					.add(jQuery('#blake_header_color_shop').parent()).add(jQuery('#blake_header_opacity_shop').parent())
					.add(jQuery('#upload-blake_header_custom_pattern_shop').parent())
					.add(jQuery('#blake_banner_slider_shop').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "custom_pattern":
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-blake_header_custom_pattern_shop').parent().fadeIn(500);
				
				jQuery('#upload-blake_header_image_shop').parent()
					.add(jQuery('#blake_header_color_shop').parent()).add(jQuery('#blake_header_opacity_shop').parent())
					.add(jQuery('#blake_header_pattern_shop').closest('.option'))
					.add(jQuery('#blake_banner_slider_shop').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "banner":
			
				jQuery('#blake_header_text_alignment_shop').parent().prev().andSelf()
					.add(jQuery('#blake_hide_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_hide_sec_pagetitle_shop').parent().prev().andSelf())
					.add(jQuery('#blake_breadcrumbs_shop').parent().prev().andSelf())
					.add(jQuery('#blake_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#blake_banner_slider_shop').parent().fadeIn(500);
				
				jQuery('#upload-blake_header_image_shop').parent()
					.add(jQuery('#blake_header_color_shop').parent()).add(jQuery('#blake_header_opacity_shop').parent())
					.add(jQuery('#blake_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-blake_header_custom_pattern_shop').parent())
				.fadeOut(500);
				
							jQuery('#blake_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
		}
		if (_default_header_bkg_shop == "border" || _default_header_bkg_shop == "image" || _default_header_bkg_shop == "pattern" || _default_header_bkg_shop == "custom_pattern" || _default_header_bkg_shop == "banner" || _default_header_bkg_shop == "color"){
			jQuery('#blake_header_height_shop').parent().fadeIn(500);
			jQuery('#blake_header_text_alignment_shop').parent().fadeIn(500);
			jQuery('#blake_hide_pagetitle_shop').add(jQuery('#blake_hide_sec_pagetitle_shop')).add(jQuery('#blake_breadcrumbs_shop')).trigger('change');
		}
	}).trigger('change');
	
	
	var _default_seo_options = jQuery('#blake_enable_theme_seo').val();
	if (_default_seo_options === "on"){
		jQuery('#blake_enable_theme_seo').closest('.option').siblings().not(jQuery('#blake_enable_theme_seo').closest('.option').prev()).fadeIn(500);
	} else {
		jQuery('#blake_enable_theme_seo').closest('.option').siblings().not(jQuery('#blake_enable_theme_seo').closest('.option').prev()).fadeOut(500);
	}
	jQuery('#blake_enable_theme_seo').change(function(e){
		if (_default_seo_options === "on"){
			jQuery('#blake_enable_theme_seo').closest('.option').siblings().not(jQuery('#blake_enable_theme_seo').closest('.option').prev()).fadeIn(500);
		} else {
			jQuery('#blake_enable_theme_seo').closest('.option').siblings().not(jQuery('#blake_enable_theme_seo').closest('.option').prev()).fadeOut(500);
		}
	});
	
	//google fonts
	var _default_google_fonts = jQuery('#blake_enable_google_fonts').val();
	if (_default_google_fonts === "on"){
		jQuery('#blake_enable_google_fonts').parent().next().fadeIn(500);
	} else {
		jQuery('#blake_enable_google_fonts').parent().next().fadeOut(500);
	}
	jQuery('#blake_enable_google_fonts').change(function(){
		if (_default_google_fonts === "on"){
			jQuery('#blake_enable_google_fonts').parent().next().fadeIn(500);
		} else {
			jQuery('#blake_enable_google_fonts').parent().next().fadeOut(500);
		}		
	});
	
	//General > Projects > Enlarge pics
	var _default_proj_layout = jQuery('#blake_single_layout').val(); 
	if (_default_proj_layout === "fullwidth_slider"){
		jQuery('#blake_projects_enlarge_images').parent('.option').fadeOut(500);
	} else {
		jQuery('#blake_projects_enlarge_images').parent('.option').fadeIn(500);
	}
	jQuery('#blake_single_layout').change(function(e){
		if (_default_proj_layout === "fullwidth_slider"){
			jQuery('#blake_projects_enlarge_images').parent('.option').fadeOut(500);
		} else {
			jQuery('#blake_projects_enlarge_images').parent('.option').fadeIn(500);
		}
	});
	
	
	// social shares on projects
	var _default_project_single_social = jQuery('#blake_project_single_social_shares').val();
	if (_default_project_single_social == "on") jQuery('#blake_project_single_socials').closest('.option').fadeIn(500);
	else jQuery('#blake_project_single_socials').closest('.option').fadeOut(500);
	jQuery('#blake_project_single_social_shares').change(function(){
		if (jQuery(this).val() == "on")
			jQuery('#blake_project_single_socials').closest('.option').fadeIn(500);
		else jQuery('#blake_project_single_socials').closest('.option').fadeOut(500);
	});
	
	// social shares on posts
	var _default_post_single_social = jQuery('#blake_post_single_social_shares').val();
	if (_default_post_single_social == "on") jQuery('#blake_post_single_socials').closest('.option').fadeIn(500);
	else jQuery('#blake_post_single_socials').closest('.option').fadeOut(500);
	jQuery('#blake_post_single_social_shares').change(function(){
		if (jQuery(this).val() == "on")
			jQuery('#blake_post_single_socials').closest('.option').fadeIn(500);
		else jQuery('#blake_post_single_socials').closest('.option').fadeOut(500);
	});
	
	//General > Projects > Open|Close Cats
	var _default_enable_open_close_categories = jQuery('#blake_enable_open_close_categories').val();
	if (_default_enable_open_close_categories === "on"){
		jQuery('#blake_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#blake_categories_initial_state').parent().fadeOut(500).addClass('optoff');
	}
	jQuery('#blake_enable_open_close_categories').change(function(e){
		var _default_enable_open_close_categories = jQuery('#blake_enable_open_close_categories').val();
		if (_default_enable_open_close_categories === "on"){
			jQuery('#blake_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#blake_categories_initial_state').parent().fadeOut(500).addClass('optoff');
		}	
	});
	
	//FOOTER RIGHT CONTENT OPTIONS
	var _default_footer_right = jQuery('#blake_footer_right_content').val();
	if (_default_footer_right === "text"){
		jQuery('#blake_footer_right_text').parent('.option').fadeIn(500);
	} else {
		jQuery('#blake_footer_right_text').parent('.option').fadeOut(500);
	}
	jQuery('#blake_footer_right_content').change(function(e){
		if (_default_footer_right === "text"){
			jQuery('#blake_footer_right_text').parent('.option').fadeIn(500);
		} else {
			jQuery('#blake_footer_right_text').parent('.option').fadeOut(500);
		}	
	});
	
	var tp_cols_default = jQuery('#blake_toppanel_number_cols').val();	  
 	if(tp_cols_default == "three"){
 		jQuery("#blake_toppanel_columns_order").parent().fadeIn(500);
 		jQuery("#blake_toppanel_columns_order_four").parent().fadeOut(500);
 	} else if (tp_cols_default == "four"){
 		jQuery("#blake_toppanel_columns_order_four").parent().fadeIn(500);
 		jQuery("#blake_toppanel_columns_order").parent().fadeOut(500);
 	} else {
 		jQuery("#blake_toppanel_columns_order").parent().fadeOut(500);
 		jQuery("#blake_toppanel_columns_order_four").parent().fadeOut(500);
 	}
 	
	jQuery('#blake_toppanel_number_cols').change(function(e){
		if(tp_cols_default == "three"){
	 		jQuery("#blake_toppanel_columns_order").parent().fadeIn(500);
	 		jQuery("#blake_toppanel_columns_order_four").parent().fadeOut(500);
	 	} else if (tp_cols_default == "four"){
	 		jQuery("#blake_toppanel_columns_order_four").parent().fadeIn(500);
	 		jQuery("#blake_toppanel_columns_order").parent().fadeOut(500);
	 	} else {
	 		jQuery("#blake_toppanel_columns_order").parent().fadeOut(500);
	 		jQuery("#blake_toppanel_columns_order_four").parent().fadeOut(500);
	 	}
 	});
 	
 	//WIDGETS AREA
	var _default_widgets_area = jQuery('#blake_enable_widgets_area').val();
	var indexWidget = parseInt(jQuery('#blake_enable_widgets_area').parents('.option').index(),10);
	if (_default_widgets_area === "on"){
		for (var i=1; i<4; i++){
			jQuery('#blake_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
		}
		jQuery('#blake_toppanel_number_cols').change();
	} else {
		for (var i=1; i<4; i++){
			jQuery('#blake_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
		}
	}
	jQuery('#blake_enable_widgets_area').change(function(e){
		if (_default_widgets_area === "on"){
			for (var i=1; i<4; i++){
				jQuery('#blake_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
			}
			jQuery('#blake_toppanel_number_cols').change();
		} else {
			for (var i=1; i<4; i++){
				jQuery('#blake_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
			}
		}
	});
	
	//breadcrumbs
	var _default_breadcrumbs = jQuery('#blake_breadcrumbs').val();
	if (_default_breadcrumbs === "on"){
		jQuery('#blake_breadcrumbs').parent().nextAll().fadeIn(500);
	} else {
		jQuery('#blake_breadcrumbs').parent().nextAll().fadeOut(500);
	}
	jQuery('#blake_breadcrumbs').change(function(e){
		if (_default_breadcrumbs === "on"){
			jQuery('#blake_breadcrumbs').parent().nextAll().fadeIn(500);
		} else {
			jQuery('#blake_breadcrumbs').parent().nextAll().fadeOut(500);
		}
	});
	
	//pagetitle
	var _default_hide_pagetitle = jQuery('#blake_hide_pagetitle').val();
	if (_default_hide_pagetitle === "on"){
		jQuery('#blake_hide_pagetitle').parent().nextUntil(jQuery('#blake_hide_pagetitle').parent().next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#blake_hide_pagetitle').parent().nextUntil(jQuery('#blake_hide_pagetitle').parent().next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#blake_hide_pagetitle').change(function(e){
		if (_default_hide_pagetitle === "on"){
			jQuery('#blake_hide_pagetitle').parent().nextUntil(jQuery('#blake_hide_pagetitle').parent().next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#blake_hide_pagetitle').parent().nextUntil(jQuery('#blake_hide_pagetitle').parent().next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	//secondary title 
	var _default_hide_sec_pagetitle = jQuery('#blake_hide_sec_pagetitle').val();
	if (_default_hide_sec_pagetitle === "on"){
		jQuery('#blake_hide_sec_pagetitle').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle').parent().next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#blake_hide_sec_pagetitle').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle').parent().next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#blake_hide_sec_pagetitle').change(function(e){
		if (_default_hide_sec_pagetitle === "on"){
			jQuery('#blake_hide_sec_pagetitle').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle').parent().next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#blake_hide_sec_pagetitle').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle').parent().next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	
	
	//breadcrumbs
	var _default_breadcrumbs_shop = jQuery('#blake_breadcrumbs_shop').val();
	if (_default_breadcrumbs_shop === "on"){
		jQuery('#blake_breadcrumbs_shop').parent().nextAll().fadeIn(500);
	} else {
		jQuery('#blake_breadcrumbs_shop').parent().nextAll().fadeOut(500);
	}
	jQuery('#blake_breadcrumbs_shop').change(function(e){
		if (_default_breadcrumbs_shop === "on"){
			jQuery('#blake_breadcrumbs_shop').parent().nextAll().fadeIn(500);
		} else {
			jQuery('#blake_breadcrumbs_shop').parent().nextAll().fadeOut(500);
		}
	});
	
	//pagetitle
	var _default_hide_pagetitle_shop = jQuery('#blake_hide_pagetitle_shop').val();
	if (_default_hide_pagetitle_shop === "on"){
		jQuery('#blake_hide_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_pagetitle_shop').parent().next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#blake_hide_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_pagetitle_shop').parent().next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#blake_hide_pagetitle_shop').change(function(e){
		if (_default_hide_pagetitle_shop === "on"){
			jQuery('#blake_hide_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_pagetitle_shop').parent().next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#blake_hide_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_pagetitle_shop').parent().next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	//secondary title 
	var _default_hide_sec_pagetitle_shop = jQuery('#blake_hide_sec_pagetitle_shop').val();
	if (_default_hide_sec_pagetitle_shop === "on"){
		jQuery('#blake_hide_sec_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle_shop').parent().next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#blake_hide_sec_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle_shop').parent().next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#blake_hide_sec_pagetitle_shop').change(function(e){
		if (_default_hide_sec_pagetitle_shop === "on"){
			jQuery('#blake_hide_sec_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle_shop').parent().next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#blake_hide_sec_pagetitle_shop').parent().nextUntil(jQuery('#blake_hide_sec_pagetitle_shop').parent().next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	
	
	//pagetitle shadow
	var _default_page_title_shadow = jQuery('#blake_page_title_shadow').val();
	if (_default_page_title_shadow === "on"){
		jQuery('#blake_page_title_shadow').parent().next().fadeIn(500);
	} else {
		jQuery('#blake_page_title_shadow').parent().next().fadeOut(500);
	}
	jQuery('#blake_page_title_shadow').change(function(e){
		if (_default_page_title_shadow === "on"){
			jQuery('#blake_page_title_shadow').parent().next().fadeIn(500);
		} else {
			jQuery('#blake_page_title_shadow').parent().next().fadeOut(500);
		}
	});
	
  	//SOCIAL ICONS 
  	var _default_enable_socials = jQuery('#blake_enable_socials').val();
  	if (_default_enable_socials === "on"){
		jQuery('#blake_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeIn(500);
		});
  	} else {
	  	jQuery('#blake_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeOut(500);
		});
  	}
	jQuery('#blake_enable_socials').change(function(e){
		var _default_enable_socials = jQuery('#blake_enable_socials').val();
	  	if (_default_enable_socials === "on"){
			jQuery('#blake_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeIn(500);
			});
	  	} else {
		  	jQuery('#blake_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeOut(500);
			});
	  	}
	});

	// TOP PANEL & SOCIAL BAR MAMBO JAMBO
	var _default_top_panel = jQuery('#blake_enable_top_panel').val();
	if (_default_top_panel === "on"){
		for (var i=jQuery('#blake_enable_top_panel').parent().index()+1; i< jQuery('#blake_toppanel_headingscolor').parent().index()+1; i++){
			if (!jQuery('#tab_navigation-1-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
	} else {
		for (var i=jQuery('#blake_enable_top_panel').parent().index()+1; i< jQuery('#blake_toppanel_headingscolor').parent().index()+1; i++){
			jQuery('#tab_navigation-1-header').children().eq(i).fadeOut(500);
		}
  	}
	jQuery('#blake_enable_top_panel').change(function(e){
	  	if (_default_top_panel === "on"){
			for (var i=jQuery('#blake_enable_top_panel').parent().index()+1; i< jQuery('#blake_toppanel_headingscolor').parent().index()+1; i++){
				if (!jQuery('#tab_navigation-1-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-1-header').children().eq(i).fadeIn(500);
			}
		} else {
			for (var i=jQuery('#blake_enable_top_panel').parent().index()+1; i< jQuery('#blake_toppanel_headingscolor').parent().index()+1; i++){
				jQuery('#tab_navigation-1-header').children().eq(i).fadeOut(500);
			}
	  	}
	});
	
	
	//suggested colors
	jQuery('#tab_navigation-1-general a.style-box').each(function(){
		jQuery(this).click(function(){
			jQuery('#blake_style_color')
				.attr('value',jQuery(this).attr('title'))
				.siblings('.color-preview').css('background-color', '#'+jQuery(this).attr('title'));
		});
	});
	
	jQuery('.styles-holder a.style-box[title='+jQuery('#blake_style_color').val()+']').parent().addClass('selected-style');
	
  	// 404
	var def_notfound = jQuery('#blake_404_error_image').val();
	if (def_notfound == "off")	
		jQuery('#blake_404_error_image_url').parent().fadeOut(500);
	else
		jQuery('#blake_404_error_image_url').parent().fadeIn(500);

	jQuery('#blake_404_error_image').change(function(e){
		if (def_notfound == "off")	
			jQuery('#blake_404_error_image_url').parent().fadeOut(500);
		else
			jQuery('#blake_404_error_image_url').parent().fadeIn(500);
 	});
 	
 	//HOMEPAGE LAYOUT
 	jQuery("#blake_homepage_static_image_url").parent().fadeOut(500);
 	
 	jQuery('#blake_homepage_slider').change(function(e){
 		if(jQuery(this).val() == 'static')
 			jQuery("#blake_homepage_static_image_url").parent().fadeIn(500);
 		else
 			jQuery("#blake_homepage_static_image_url").parent().fadeOut(500);
 			
 	});
 	 	
 	//CONTACT FORM TEXTAREA
 	jQuery("textarea[name=walker_contacts_email_default_content]").css("width", "440px").css("height", "270px");
 	
 	
 	//FOOTER
 	var cols_default  = jQuery('#blake_footer_number_cols').val();
	switch(cols_default){
		case "one": case "two":
	 		jQuery("#blake_footer_columns_order").parent().fadeOut(500);
	 		jQuery("#blake_footer_columns_order_four").parent().fadeOut(500);				
		break;
		case "three":
			jQuery("#blake_footer_columns_order").parent().fadeIn(500);
			jQuery("#blake_footer_columns_order_four").parent().fadeOut(500);
		break;
		case "four":
			jQuery("#blake_footer_columns_order_four").parent().fadeIn(500);
			jQuery("#blake_footer_columns_order").parent().fadeOut(500);	
		break;
	}
	 	
	jQuery('#blake_footer_number_cols').change(function(e){
		switch(cols_default){
			case "one": case "two":
		 		jQuery("#blake_footer_columns_order").parent().fadeOut(500);
		 		jQuery("#blake_footer_columns_order_four").parent().fadeOut(500);				
			break;
			case "three":
				jQuery("#blake_footer_columns_order").parent().fadeIn(500);
				jQuery("#blake_footer_columns_order_four").parent().fadeOut(500);
			break;
			case "four":
				jQuery("#blake_footer_columns_order_four").parent().fadeIn(500);
				jQuery("#blake_footer_columns_order").parent().fadeOut(500);	
			break;
		}
 	});
  

	//show twitter newsletter footer options
	var _default_show_twitter_newsletter_footer = jQuery('#blake_show_twitter_newsletter_footer').val();
	if (_default_show_twitter_newsletter_footer === "on"){
		for (var i= jQuery('#blake_show_twitter_newsletter_footer').parent().index(); i<jQuery('#blake_twitter_newsletter_borderscolor').parent().index(); i++){
			if (!jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#blake_show_twitter_newsletter_footer').parent().index(); i<jQuery('#blake_twitter_newsletter_borderscolor').parent().index(); i++){
			jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#blake_show_twitter_newsletter_footer').change(function(){
		if (_default_show_twitter_newsletter_footer === "on"){
			for (var i= jQuery('#blake_show_twitter_newsletter_footer').parent().index(); i<jQuery('#blake_twitter_newsletter_borderscolor').parent().index(); i++){
				if (!jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#blake_show_twitter_newsletter_footer').parent().index(); i<jQuery('#blake_twitter_newsletter_borderscolor').parent().index(); i++){
				jQuery('#blake_show_twitter_newsletter_footer').closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	
  var _default_after_scroll_header = jQuery('#blake_header_after_scroll').val();
  if (_default_after_scroll_header == 'on'){
	  jQuery('#blake_header_shrink_effect').parent().prev().andSelf()
	  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
	  .fadeIn(500);
  } else {
	  jQuery('#blake_header_shrink_effect').parent().prev().andSelf()
	  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
	  .fadeOut(500);
  }
  jQuery('#blake_header_after_scroll').change(function(){
	  if (_default_after_scroll_header == 'on'){
		  jQuery('#blake_header_shrink_effect').parent().prev().andSelf()
		  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
		  .fadeIn(500);
	  } else {
		  jQuery('#blake_header_shrink_effect').parent().prev().andSelf()
		  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
		  .fadeOut(500);
	  }
  });
  
  
  var _default_fixed_menu = jQuery('#blake_fixed_menu').val();
  if (_default_fixed_menu == 'on'){
	  jQuery('#blake_header_after_scroll').trigger('change').parent().prev().andSelf()
  	  	.add(jQuery('#blake_header_hide_on_start').parent())
	  	.add(jQuery('#blake_content_to_the_top').parent())
	  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
	  .fadeIn(500);
  } else {
	  jQuery('#blake_header_after_scroll').parent().prev().andSelf()
	  	.add(jQuery('#blake_header_shrink_effect').parent().prev().andSelf())
	  	.add(jQuery('#blake_header_hide_on_start').parent())
	  	.add(jQuery('#blake_content_to_the_top').parent())
	  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
	  .fadeOut(500);  
  }
  jQuery('#blake_fixed_menu').change(function(){
	  if (_default_fixed_menu == 'on'){
		  jQuery('#blake_header_after_scroll').trigger('change').parent().prev().andSelf()
		  	.add(jQuery('#blake_header_hide_on_start').parent())
		  	.add(jQuery('#blake_content_to_the_top').parent())
		  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
		  .fadeIn(500);
	  } else {
		  jQuery('#blake_header_after_scroll').parent().prev().andSelf()
		  	.add(jQuery('#blake_header_shrink_effect').parent().prev().andSelf())
		  	.add(jQuery('#blake_header_hide_on_start').parent())
		  	.add(jQuery('#blake_content_to_the_top').parent())
		  	.add(jQuery('#blake_header_after_scroll_style_light_dark').parent())
		  .fadeOut(500);  
	  }	  
  });
  
  
  
  // continuous check for changed value
  setInterval(function () {
	  
	  //custom css
	  if (jQuery('#enable_custom_css').val() != _default_custom_css){
		  _default_custom_css = jQuery('#enable_custom_css').val();
		  jQuery('#enable_custom_css').change();
	  }
	  
	if (jQuery('#blake_menu_add_border').val() != _default_menu_add_border){
		_default_menu_add_border = jQuery('#blake_menu_add_border').val();
		jQuery('#blake_menu_add_border').change();
	}

  	if (jQuery('#blake_footer_display_logo').val() != _default_footer_display_logo){
		_default_footer_display_logo = jQuery('#blake_footer_display_logo').val();
		jQuery('#blake_footer_display_logo').change();
	}
	
	if (jQuery('#blake_footer_display_social_icons').val() != _default_footer_display_social_icons){
		_default_footer_display_social_icons = jQuery('#blake_footer_display_social_icons').val();
		jQuery('#blake_footer_display_social_icons').change();
	}
	if (jQuery('#blake_footer_display_custom_text').val() != _default_footer_display_custom_text){
		_default_footer_display_custom_text = jQuery('#blake_footer_display_custom_text').val();
		jQuery('#blake_footer_display_custom_text').change();
	}
	  
	if (jQuery('#blake_enable_theme_seo').val() != _default_seo_options){
		_default_seo_options = jQuery('#blake_enable_theme_seo').val();
		jQuery('#blake_enable_theme_seo').change();
	}
  
	// under construction
	if (jQuery('#blake_enable_under_construction').val() != _default_under_construction){
		_default_under_construction = jQuery('#blake_enable_under_construction').val();
		jQuery('#blake_enable_under_construction').change();
	}

	//fixed menu
	if (jQuery('#blake_fixed_menu').val() != _default_fixed_menu){
	  	_default_fixed_menu = jQuery('#blake_fixed_menu').val();
	  	jQuery('#blake_fixed_menu').change();
  	}
  	
  	//after scroll menu
  	if (jQuery('#blake_header_after_scroll').val() != _default_after_scroll_header){
	  	_default_after_scroll_header = jQuery('#blake_header_after_scroll').val();
	  	jQuery('#blake_header_after_scroll').trigger('change');
  	}


	//breadcrumbs
	if (jQuery('#blake_breadcrumbs').val() != _default_breadcrumbs){
		_default_breadcrumbs = jQuery('#blake_breadcrumbs').val();
		jQuery('#blake_breadcrumbs').change();
	}

	//display secondary page title
	if (jQuery('#blake_hide_sec_pagetitle').val() != _default_hide_sec_pagetitle){
		_default_hide_sec_pagetitle = jQuery('#blake_hide_sec_pagetitle').val();
		jQuery('#blake_hide_sec_pagetitle').change();
	}
	
	//display page title
	if (jQuery('#blake_hide_pagetitle').val() != _default_hide_pagetitle){
		_default_hide_pagetitle = jQuery('#blake_hide_pagetitle').val();
		jQuery('#blake_hide_pagetitle').change();
	}
	
	
	//breadcrumbs_shop
	if (jQuery('#blake_breadcrumbs_shop').val() != _default_breadcrumbs_shop){
		_default_breadcrumbs_shop = jQuery('#blake_breadcrumbs_shop').val();
		jQuery('#blake_breadcrumbs_shop').change();
	}

	//display secondary page title
	if (jQuery('#blake_hide_sec_pagetitle_shop').val() != _default_hide_sec_pagetitle_shop){
		_default_hide_sec_pagetitle_shop = jQuery('#blake_hide_sec_pagetitle_shop').val();
		jQuery('#blake_hide_sec_pagetitle_shop').change();
	}
	
	//display page title
	if (jQuery('#blake_hide_pagetitle_shop').val() != _default_hide_pagetitle_shop){
		_default_hide_pagetitle_shop = jQuery('#blake_hide_pagetitle_shop').val();
		jQuery('#blake_hide_pagetitle_shop').change();
	}

	//pagetitle shadow
	if (jQuery('#blake_page_title_shadow').val() != _default_page_title_shadow){
		_default_page_title_shadow = jQuery('#blake_page_title_shadow').val();
		jQuery('#blake_page_title_shadow').change();
	}

	//show secondary footer options
  	if (jQuery('#blake_show_sec_footer').val() != _default_show_secondary_footer){
	  	_default_show_secondary_footer = jQuery('#blake_show_sec_footer').val();
	  	jQuery('#blake_show_sec_footer').change();
  	}
	
	//show primary footer options
  	if (jQuery('#blake_show_primary_footer').val() != _default_show_primary_footer){
	  	_default_show_primary_footer = jQuery('#blake_show_primary_footer').val();
	  	jQuery('#blake_show_primary_footer').change();
  	}

  	//body type options
  	if (jQuery('#blake_contentbg_type').val() != _default_contentbg_type){
	  	_default_contentbg_type = jQuery('#blake_contentbg_type').val();
	  	jQuery('#blake_contentbg_type').change();
  	}
  
  	//show twitter newsletter footer options
  	if (jQuery('#blake_show_twitter_newsletter_footer').val() != _default_show_twitter_newsletter_footer){
	  	_default_show_twitter_newsletter_footer = jQuery('#blake_show_twitter_newsletter_footer').val();
	  	jQuery('#blake_show_twitter_newsletter_footer').change();
  	}
  	
  	// header type light
  	if (jQuery('#blake_headerbg_type_light').val() != _default_headerbg_type_light){
	  	_default_headerbg_type_light = jQuery('#blake_headerbg_type_light').val();
	  	jQuery('#blake_headerbg_type_light').change();
  	}
  	
  	// header type dark
  	if (jQuery('#blake_headerbg_type_dark').val() != _default_headerbg_type_dark){
	  	_default_headerbg_type_dark = jQuery('#blake_headerbg_type_dark').val();
	  	jQuery('#blake_headerbg_type_dark').change();
  	}
  	
  	// header after scroll type light
  	if (jQuery('#blake_headerbg_after_scroll_type_light').val() != _default_headerbg_after_scroll_type_light){
	  	_default_headerbg_after_scroll_type_light = jQuery('#blake_headerbg_after_scroll_type_light').val();
	  	jQuery('#blake_headerbg_after_scroll_type_light').change();
  	}
  	
  	// header after scroll type dark
  	if (jQuery('#blake_headerbg_after_scroll_type_dark').val() != _default_headerbg_after_scroll_type_dark){
	  	_default_headerbg_after_scroll_type_dark = jQuery('#blake_headerbg_after_scroll_type_dark').val();
	  	jQuery('#blake_headerbg_after_scroll_type_dark').change();
  	}

  	// show header & top contents type
  	if (jQuery('#blake_toppanelbg_type').val() != _default_toppanelbg_type){
	  	_default_toppanelbg_type = jQuery('#blake_toppanelbg_type').val();
	  	jQuery('#blake_toppanelbg_type').change();
  	}
  	
  	// secondary footer type opts
  	if (jQuery('#blake_sec_footerbg_type').val() != _default_sec_footerbg_type){
	  	_default_sec_footerbg_type = jQuery('#blake_sec_footerbg_type').val();
	  	jQuery('#blake_sec_footerbg_type').change();
  	}
  	
  	// primary footer type opts
  	if (jQuery('#blake_footerbg_type').val() != _default_footerbg_type){
	  	_default_footerbg_type = jQuery('#blake_footerbg_type').val();
	  	jQuery('#blake_footerbg_type').change();
  	}
  	
  	// twitter newsletter type opts 
  	if (jQuery('#blake_twitter_newsletter_type').val() != _default_twitter_newsletter_type){
	  	_default_twitter_newsletter_type = jQuery('#blake_twitter_newsletter_type').val();
	  	jQuery('#blake_twitter_newsletter_type').change();
  	}
  	
  	// thumbails animate
  	if (jQuery('#blake_animate_thumbnails').val() != _default_animate_thumbnails){
	  	_default_animate_thumbnails = jQuery('#blake_animate_thumbnails').val();
	  	jQuery('#blake_animate_thumbnails').change();
  	}
  	
  	//body shadow
  	if (jQuery('#blake_body_shadow').val() != _default_body_shadow){
	  	_default_body_shadow = jQuery('#blake_body_shadow').val();
	  	jQuery('#blake_body_shadow').change();
  	}
  
  	//body background type
  	if (jQuery('#blake_body_type').val() != _default_body_background){
	  	_default_body_background = jQuery('#blake_body_type').val();
	  	jQuery('#blake_body_type').change();
  	}
  
  	//body layout page
  	if (jQuery('#blake_body_layout_type').val() != _default_body_layout_type){
	  	_default_body_layout_type = jQuery('#blake_body_layout_type').val();
	  	jQuery('#blake_body_layout_type').change();
  	}
  
  	//header background type
  	if (jQuery('#blake_header_type').val() != _default_header_bkg){
	  	_default_header_bkg = jQuery('#blake_header_type').val();
	  	jQuery('#blake_header_type').change();
  	}
  	
  	//header background type _shop
  	if (jQuery('#blake_header_type_shop').val() != _default_header_bkg_shop){
	  	_default_header_bkg_shop = jQuery('#blake_header_type_shop').val();
	  	jQuery('#blake_header_type_shop').change();
  	}
  
  	//google fonts
  	if (jQuery('#blake_enable_google_fonts').val() != _default_google_fonts){
	  	_default_google_fonts = jQuery('#blake_enable_google_fonts').val();
	  	jQuery('#blake_enable_google_fonts').change();
  	}
  
  	//projects enlarge pics
  	if (jQuery('#blake_single_layout').val() != _default_proj_layout){
	 	_default_proj_layout = jQuery('#blake_single_layout').val();
	 	jQuery('#blake_single_layout').change();
  	}
  	
  	//projects open|close
  	if (jQuery('#blake_enable_open_close_categories').val() != _default_enable_open_close_categories){
	 	_default_enable_open_close_categories = jQuery('#blake_enable_open_close_categories').val();
	 	jQuery('#blake_enable_open_close_categories').change();
  	}
  
  	//FOOTER RIGHT CONTENT
    if (jQuery('#blake_footer_right_content').val() != _default_footer_right){
	    _default_footer_right = jQuery('#blake_footer_right_content').val();
	    jQuery('#blake_footer_right_content').change();
    }
    
    //TOPPANEL
    if ( jQuery('#blake_enable_top_panel').val() != _default_top_panel ) {
    	_default_top_panel = jQuery('#blake_enable_top_panel').val();
		jQuery('#blake_enable_top_panel').change();    
    }
    
    //WIDGETS AREA
    if (jQuery('#blake_enable_widgets_area').val() != _default_widgets_area){
	    _default_widgets_area = jQuery('#blake_enable_widgets_area').val();
	    jQuery('#blake_enable_widgets_area').change();
    }
    
    //SOCIAL ICONS
    if (jQuery('#blake_enable_socials').val() != _default_enable_socials){
	    _default_enable_socials = jQuery('#blake_enable_socials').val();
	    jQuery('#blake_enable_socials').change();
    }
    
    //404
    if (jQuery('#blake_404_error_image').val() != def_notfound){
		def_notfound = jQuery('#blake_404_error_image').val();
		jQuery('#blake_404_error_image').change();
    }
    
    //SIDEBAR
    if (jQuery('#sidebar_name_list').html() != def_sidebars){
	    var sidebars = "";
	    jQuery('#sidebar_name_list li').each(function(){
		    sidebars += jQuery(this).children('span').html()+"|*|";
	    });
	    jQuery('input#blake_sidebar_name_names').val(sidebars);
	    def_sidebars = jQuery('#sidebar_name_list').html();
    }
    
    //FOOTER
    if ( jQuery('#blake_footer_number_cols').val() != cols_default ) {
    	cols_default  = jQuery('#blake_footer_number_cols').val();
		jQuery('#blake_footer_number_cols').change();    
    }
    
    //TOP PANEL
    if ( jQuery('#blake_toppanel_number_cols').val() != tp_cols_default ) {
    	tp_cols_default  = jQuery('#blake_toppanel_number_cols').val();
		jQuery('#blake_toppanel_number_cols').change();  
    }
    
    if (jQuery('#blake_enable_ajax_search').val() != _default_ajax_search){
	    _default_ajax_search = jQuery('#blake_enable_ajax_search').val();
	    jQuery('#blake_enable_ajax_search').change();
    }
    
    if (jQuery('#blake_enable_search').val() != _default_search){
	 	_default_search = jQuery('#blake_enable_search').val();
	 	jQuery('#blake_enable_search').change();
    }
    
    if (jQuery('#blake_enable_website_loader').val() != _default_website_loader){
	    _default_website_loader = jQuery('#blake_enable_website_loader').val();
	    jQuery('#blake_enable_website_loader').change();
    }
    
    if (jQuery('#blake_pagetitle_image_overlay').val() != _default_overlay_enable){
	    _default_overlay_enable = jQuery('#blake_pagetitle_image_overlay').val();
	    jQuery('#blake_pagetitle_image_overlay').change();
    }
    
    if (jQuery('#blake_pagetitle_image_overlay_shop').val() != _default_overlay_enable_shop){
	    _default_overlay_enable_shop = jQuery('#blake_pagetitle_image_overlay_shop').val();
	    jQuery('#blake_pagetitle_image_overlay_shop').change();
    }
        
    if (jQuery('#blake_pagetitle_overlay_type').val() != _default_overlay_type){
	    _default_overlay_type = jQuery('#blake_pagetitle_overlay_type').val();
	    jQuery('#blake_pagetitle_overlay_type').change();
    }
    
    if (jQuery('#blake_pagetitle_overlay_type_shop').val() != _default_overlay_type_shop){
	    _default_overlay_type_shop = jQuery('#blake_pagetitle_overlay_type_shop').val();
	    jQuery('#blake_pagetitle_overlay_type_shop').change();
    }
    
    //project single socials
	if (jQuery('#blake_project_single_social_shares').val() != _default_project_single_social){
		_default_project_single_social = jQuery('#blake_project_single_social_shares').val();
		jQuery('#blake_project_single_social_shares').change();
	}
	
	//post single socials
	if (jQuery('#blake_post_single_social_shares').val() != _default_post_single_social){
		_default_post_single_social = jQuery('#blake_post_single_social_shares').val();
		jQuery('#blake_post_single_social_shares').change();
	}
    
  }, 1000);

});
