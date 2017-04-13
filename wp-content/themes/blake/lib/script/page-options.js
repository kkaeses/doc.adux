var upperPageOptions={
	
	updateCaptionsList: function(){
		var newVal = "";
		jQuery('.captions_list_container .captions_list_item').each(function(){
			newVal += jQuery(this).find('.saved_text').html()+"|!|";
		});
		jQuery('textarea[name=introCaptionsList_value]').val(newVal);
	},
		
	init:function(){
		
		if (jQuery('#blake_enable_breadcrumbs_value').length){
			jQuery('#blake_enable_breadcrumbs_value').change(function(){
				if (jQuery(this).val() == "yes"){
					jQuery('#blake_breadcrumbs_margin_top_noncename').parent().removeClass('optoff').css('display','block');
				} else {
					jQuery('#blake_breadcrumbs_margin_top_noncename').parent().addClass('optoff').css('display','none');
				}
			}).trigger('change');
		}
		
		if (jQuery('#sidebar_value').length){
			jQuery('#sidebar_value').change(function(){
				if (jQuery(this).val() != "none"){
					jQuery('#sidebar_which_value').parent().removeClass('hiddenoption').css('display','block');
				} else {
					jQuery('#sidebar_which_value').parent().addClass('hiddenoption').css('display','none');					
				}
			}).trigger('change');
		}
		
		//custom page title options
		jQuery('#blake_enable_custom_pagetitle_options_value').change(function(){
			if (jQuery('#blake_enable_custom_pagetitle_options_value').val() == 'yes'){
				jQuery('#blake_header_type_value').closest('.option-container').css('display','block');
				showElements(jQuery('#blake_enable_custom_pagetitle_options_value').closest('.option-container').nextUntil(jQuery('.underconstructionoptions')).removeClass('hiddenoption'), 0);
				jQuery('#blake_header_type_value').trigger('change');
				jQuery('#blake_enable_breadcrumbs_value').trigger('change');
			} else {
				hideElements(jQuery('#blake_enable_custom_pagetitle_options_value').closest('.option-container').nextUntil(jQuery('.underconstructionoptions')).addClass('hiddenoption'), 0);
			}
		}).trigger('change');
		
		//custom header style options
		jQuery('#blake_enable_custom_header_options_value').change(function(){
			if (jQuery('#blake_enable_custom_header_options_value').val() == 'yes'){
				showElements( jQuery('#blake_custom_header_pre_value').closest('.option-container').add( jQuery('#blake_custom_header_after_value').closest('.option-container') ).add( jQuery('#blake_enable_website_loading_value').closest('.option-container') ).removeClass('hiddenoption optoff') , 0);
			} else {
				hideElements( jQuery('#blake_custom_header_pre_value').closest('.option-container').add( jQuery('#blake_custom_header_after_value').closest('.option-container') ).add( jQuery('#blake_enable_website_loading_value').closest('.option-container') ).addClass('hiddenoption') , 0);
			}
		}).trigger('change');
		
		if (jQuery('#blake_header_type_value').val() != 'without'){
			if (jQuery('#blake_hide_pagetitle_value').val() == 'yes'){
				jQuery('#blake_hide_pagetitle_value').closest('.option-container').nextUntil(jQuery('#blake_header_text_margin_top_noncename').parent().next()).not('script').css('display','block');
			} else jQuery('#blake_hide_pagetitle_value').closest('.option-container').nextUntil(jQuery('.underconstructionoptions')).css('display','none');
		}
		jQuery('#blake_hide_pagetitle_value').change(function(){
			if (jQuery('#blake_header_type_value').val() != 'without'){
				if (jQuery('#blake_hide_pagetitle_value').val() == 'yes'){
					jQuery('#blake_hide_pagetitle_value').closest('.option-container').nextUntil(jQuery('#blake_header_text_margin_top_noncename').parent().next()).not('script').css('display','block');
				} else jQuery('#blake_hide_pagetitle_value').closest('.option-container').nextUntil(jQuery('#blake_header_text_margin_top_noncename').parent().next()).css('display','none');
			}
		});
		
		if (jQuery('#blake_header_type_value').val() != 'without'){
			if (jQuery('#blake_hide_sec_pagetitle_value').val() == 'yes'){
				jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').nextUntil(jQuery('#blake_header_text_margin_top_noncename').parent().next()).not('script').css('display','block');
			} else jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').nextUntil(jQuery('#blake_header_text_margin_top_noncename').parent().next()).css('display','none');
		}
		
		jQuery('#blake_hide_sec_pagetitle_value').change(function(){
			if (jQuery('#blake_header_type_value').val() != 'without'){
				if (jQuery('#blake_hide_sec_pagetitle_value').val() == 'yes'){
					jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').nextUntil(jQuery('.breadcrumboptions')).not('script').css('display','block');
				} else jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').nextUntil(jQuery('.breadcrumboptions')).css('display','none');
			}
		});
		
		jQuery('#blake_pagetitle_image_overlay_value').change(function(){
			if (jQuery(this).val() == "on"){
				jQuery('#blake_pagetitle_overlay_type_value').closest('.option-container')
					.add(jQuery('#blake_pagetitle_overlay_opacity_noncename').closest('.option-container'))
				.css('display','block');
				jQuery('#blake_pagetitle_overlay_type_value').change();
			} else {
				jQuery('#blake_pagetitle_overlay_type_value').closest('.option-container').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_slider').closest('.option-container').next()).andSelf()
					.add(jQuery('#blake_pagetitle_overlay_pattern_value').closest('.option-container'))
				.css('display','none');
			}
		});
		
		jQuery('#blake_pagetitle_overlay_type_value').change(function(){
			if (jQuery(this).val() == "color"){
				jQuery('#blake_pagetitle_overlay_color').closest('.option-container').css('display','block');
				jQuery('#blake_pagetitle_overlay_pattern_noncename').closest('.option-container').css('display','none');
			} else {
				jQuery('#blake_pagetitle_overlay_color').closest('.option-container').css('display','none');
				jQuery('#blake_pagetitle_overlay_pattern_noncename').closest('.option-container').css('display','block');
			}
		});
		
		jQuery('#blake_header_type_value').change(function(){
			switch (jQuery('#blake_header_type_value').val()){
				case "without":
					jQuery('#blake_header_image_noncename').closest('.option-container').nextUntil(jQuery('#blake_breadcrumbs_margin_top_noncename').closest('.option-container')).add(jQuery('#blake_breadcrumbs_margin_top_noncename').closest('.option-container')).add(jQuery('#blake_header_image_noncename').closest('.option-container')).css('display','none');	
				break;
				case "color":
					jQuery('#blake_header_image_noncename').closest('.option-container')
						.add(jQuery('#blake_header_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_custom_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_banner_slider_value').closest('.option-container'))
					.css('display','none');
					jQuery('#blake_header_color_noncename').closest('.option-container').add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container')).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container'))
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').prev()).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container').prev())
						.add(jQuery('#blake_header_text_alignment_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_height_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_color_opacity_noncename').closest('.option-container'))
						.add(jQuery('#blake_page_title_padding_noncename').closest('.option-container'))
						.add(jQuery('.breadcrumboptions').nextUntil(jQuery('.underconstructionoptions')).andSelf())
					.css('display','block');
					
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_noncename').closest('.option-container').next()).andSelf().css('display','none');
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').css('display','block');
					jQuery('#blake_hide_sec_pagetitle_value').add(jQuery('#blake_hide_pagetitle_value')).add(jQuery('#blake_enable_breadcrumbs_value')).trigger('change');
				break;
				case "image":
					jQuery('#blake_header_color_noncename').closest('.option-container')
						.add(jQuery('#blake_header_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_custom_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_banner_slider_value').closest('.option-container'))
						.add(jQuery('#blake_header_color_opacity_noncename').closest('.option-container'))
					.css('display','none');
					jQuery('#blake_header_image_noncename').closest('.option-container').add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container')).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container'))
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').prev()).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container').prev())
						.add(jQuery('#blake_header_text_alignment_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_height_noncename').closest('.option-container'))
						.add(jQuery('#blake_page_title_padding_noncename').closest('.option-container'))
						.add(jQuery('.breadcrumboptions').nextUntil(jQuery('.underconstructionoptions')).andSelf())
					.css('display','block');
					jQuery('#blake_hide_sec_pagetitle_value').add(jQuery('#blake_hide_pagetitle_value')).add(jQuery('#blake_enable_breadcrumbs_value')).trigger('change');
					
					// erererererere
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').add(jQuery('#blake_pagetitle_image_overlay_value').closest('.option-container')).css('display','block');
					jQuery('#blake_pagetitle_image_overlay_value').change();
					
				break;
				case "pattern":
					jQuery('#blake_header_image_noncename').closest('.option-container')
						.add(jQuery('#blake_header_color_noncename').closest('.option-container'))
						.add(jQuery('#blake_banner_slider_value').closest('.option-container'))
						.add(jQuery('#blake_header_custom_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_color_opacity_noncename').closest('.option-container'))
					.css('display','none');
					jQuery('#blake_header_pattern_noncename').closest('.option-container')
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container')).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container'))
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').prev()).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container').prev())
						.add(jQuery('#blake_header_text_alignment_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_height_noncename').closest('.option-container'))
						.add(jQuery('#blake_page_title_padding_noncename').closest('.option-container'))
						.add(jQuery('.breadcrumboptions').nextUntil(jQuery('.underconstructionoptions')).andSelf())
					.css('display','block');
					
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_noncename').closest('.option-container').next()).andSelf().css('display','none');
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').css('display','block');		
					jQuery('#blake_hide_sec_pagetitle_value').add(jQuery('#blake_hide_pagetitle_value')).add(jQuery('#blake_enable_breadcrumbs_value')).trigger('change');
				break;
				case "custom_pattern":
					jQuery('#blake_header_image_noncename').closest('.option-container')
						.add(jQuery('#blake_header_color_noncename').closest('.option-container'))
						.add(jQuery('#blake_banner_slider_value').closest('.option-container'))
						.add(jQuery('#blake_header_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_color_opacity_noncename').closest('.option-container'))
					.css('display','none');
					jQuery('#blake_header_custom_pattern_noncename').closest('.option-container')
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container')).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container'))
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').prev()).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container').prev())
						.add(jQuery('#blake_header_text_alignment_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_height_noncename').closest('.option-container'))
						.add(jQuery('#blake_page_title_padding_noncename').closest('.option-container'))
						.add(jQuery('.breadcrumboptions').nextUntil(jQuery('.underconstructionoptions')).andSelf())
					.css('display','block');
					
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_noncename').closest('.option-container').next()).andSelf().css('display','none');
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').css('display','block');
					jQuery('#blake_hide_sec_pagetitle_value').add(jQuery('#blake_hide_pagetitle_value')).add(jQuery('#blake_enable_breadcrumbs_value')).trigger('change');
				break;
				case "banner":
					jQuery('#blake_header_image_noncename').closest('.option-container')
						.add(jQuery('#blake_header_color_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_custom_pattern_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_color_opacity_noncename').closest('.option-container'))
						.add(jQuery('#blake_page_title_padding_noncename').closest('.option-container'))
					.css('display','none');

					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').nextUntil(jQuery('#blake_pagetitle_overlay_opacity_noncename').closest('.option-container').next()).andSelf().css('display','none');

					jQuery('#blake_banner_slider_value').closest('.option-container').add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container')).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container'))
						.add(jQuery('#blake_hide_sec_pagetitle_value').closest('.option-container').prev()).add(jQuery('#blake_hide_pagetitle_value').closest('.option-container').prev())
						.add(jQuery('#blake_header_text_alignment_noncename').closest('.option-container'))
						.add(jQuery('#blake_header_height_noncename').closest('.option-container'))
						.add(jQuery('.breadcrumboptions').nextUntil(jQuery('.underconstructionoptions')).andSelf())
					.css('display','block');
					jQuery('#blake_pagetitle_image_parallax_value').closest('.option-container').css('display','block');
					jQuery('#blake_hide_sec_pagetitle_value').add(jQuery('#blake_hide_pagetitle_value')).add(jQuery('#blake_enable_breadcrumbs_value')).trigger('change');
				break;
			}

		});
		
		if (jQuery('#homeStyle_value').length){
			jQuery('#homeStyle_value').closest('.option-container').append('<ul class="homepage_styles_container" />');
			jQuery('#homeStyle_value option').each(function(){
				var opt = jQuery(this);
				if (jQuery(this).is(':selected')){
					jQuery('.homepage_styles_container').append('<li class="homepage_styles_thumbs selected"><div class="homepage_styles_thumbs_image_container"><img src="'+jQuery('#homeStyle_value').siblings('.temppath').html()+'/images/homepage_style_thumb_'+jQuery(opt).val()+'.png" title="homepage_style_thumb_'+jQuery(opt).val()+'.png" /></div>'+jQuery(opt).html()+'</li>');
				} else {
					jQuery('.homepage_styles_container').append('<li class="homepage_styles_thumbs"><div class="homepage_styles_thumbs_image_container"><img src="'+jQuery('#homeStyle_value').siblings('.temppath').html()+'/images/homepage_style_thumb_'+jQuery(opt).val()+'.png" title="homepage_style_thumb_'+jQuery(opt).val()+'.png" /></div>'+jQuery(opt).html()+'</li>');	
				}
			});
			jQuery('.homepage_styles_thumbs').click(function(){
				jQuery('#homeStyle_value').val( jQuery('#homeStyle_value option').eq(jQuery(this).index()).val() );
				jQuery(this).addClass('selected').siblings().removeClass('selected');
				upperPageOptions.updateHomeStyleOptions();
			});
		}
		
		if (jQuery('#videoSource_value').length){
			jQuery('#videoMediaLibrary_noncename').closest('.option-container').css({'border':'none','padding-left':'0px', 'float':'left', 'width':'100%'}).appendTo(jQuery('#videoSource_value').closest('.option-container'));
			jQuery('#videoCode_noncename').parent().css({'float':'left', 'width':'100%'});
			if (jQuery('#videoSource_value').val() === "youtube" || jQuery('#videoSource_value').val() === "vimeo"){
				showElements(jQuery('#videoCode_noncename').parent(),0);
				hideElements(jQuery('#videoMediaLibrary_noncename').closest('.option-container'),0);
			} else {
				hideElements(jQuery('#videoCode_noncename').parent(),0);
				showElements(jQuery('#videoMediaLibrary_noncename').closest('.option-container'),0);
			}
			jQuery('#videoSource_value').change(function(){
				if (jQuery('#videoSource_value').val() === "youtube" || jQuery('#videoSource_value').val() === "vimeo"){
					showElements(jQuery('#videoCode_noncename').parent(),0);
					hideElements(jQuery('#videoMediaLibrary_noncename').closest('.option-container'),0);
				} else {
					hideElements(jQuery('#videoCode_noncename').parent(),0);
					showElements(jQuery('#videoMediaLibrary_noncename').closest('.option-container'),0);
				}				
			});
		}
		
		if (jQuery('#audioSource_value').length){
			jQuery('#audioCode_noncename').parent().add(jQuery('#audioMediaLibrary_noncename').parent()).css({'border':'none','padding-left':'0px', 'float':'left', 'width':'100%'}).appendTo(jQuery('#audioSource_noncename').parent());
			if (jQuery('#audioSource_value').val() === "embed"){
				showElements(jQuery('#audioCode_noncename').parent(),0);
				hideElements(jQuery('#audioMediaLibrary_noncename').closest('.option-container'),0);
			} else {
				hideElements(jQuery('#audioCode_noncename').parent(),0);
				showElements(jQuery('#audioMediaLibrary_noncename').closest('.option-container'),0);
			}
			jQuery('#audioSource_value').change(function(){
				if (jQuery('#audioSource_value').val() === "embed"){
					showElements(jQuery('#audioCode_noncename').parent(),0);
					hideElements(jQuery('#audioMediaLibrary_noncename').closest('.option-container'),0);
				} else {
					hideElements(jQuery('#audioCode_noncename').parent(),0);
					showElements(jQuery('#audioMediaLibrary_noncename').closest('.option-container'),0);
				}
			});
		}
		
		/* video source homepage */
		if (jQuery('#homeVideoSource_value').length){
			upperPageOptions.updateVideoSourceOptions();
			jQuery('#homeVideoSource_value').change(function(){ upperPageOptions.updateVideoSourceOptions(); });
		}
		
		/* logo type */
		if (jQuery('#introLogo_value').length){
			upperPageOptions.updateLogoTypeOptions();
			jQuery('#introLogo_value').change(function(){ upperPageOptions.updateLogoTypeOptions(); });
		}
		
		/* captions */
		if (jQuery('textarea[name=introCaptionsList_value]').length){
		
			jQuery(document).on('keypress', '.captions_list_item input', function(e){
				if ( e.which == 13 ) {
					e.preventDefault();
					jQuery(this).css('display','none').siblings('.saved_text').html(jQuery(this).val());
					upperPageOptions.updateCaptionsList();
				}
			});
			
			var captions = jQuery('textarea[name=introCaptionsList_value]').val();
				captions = captions.split("|!|");
			jQuery('textarea[name=introCaptionsList_value]').css('display','none').before('<div class="captions_list_container" />');
			if (captions.length > 0){
				for (i=0; i<captions.length; i++){
					if (captions[i] != ""){
						jQuery('.captions_list_container').append('<div class="captions_list_item"><div class="saved_text" onclick="jQuery(this).siblings(\'input\').css(\'display\',\'block\').focus();">'+captions[i]+'</div><input type="text" value="'+captions[i]+'" onblur="jQuery(this).css(\'display\',\'none\').siblings(\'.saved_text\').html(jQuery(this).val());upperPageOptions.updateCaptionsList();"/><a title="Delete Image" class="removeImage" style="position:absolute;top:5px;right:5px;width:26px;height:23px;background:url('+jQuery('.temppath').html()+'/images/admin-delete-icon.png) no-repeat;cursor:pointer;" onclick="jQuery(this).parent().remove();upperPageOptions.updateCaptionsList();" ></a></div>');
					}
				}	
			}
			jQuery('textarea[name=introCaptionsList_value]').before('<input class="button add-new-caption" type="button" value="Add New Caption" style="width:auto;text-align:center;margin-top: 10px;"/>');
			jQuery('.add-new-caption').click(function(){
				jQuery('.captions_list_container').append('<div class="captions_list_item"><div class="saved_text" onclick="jQuery(this).siblings(\'input\').css(\'display\',\'block\').focus();"></div><input type="text" value="Your text here." onblur="jQuery(this).css(\'display\',\'none\').siblings(\'.saved_text\').html(jQuery(this).val());upperPageOptions.updateCaptionsList();"/><a title="Delete Image" class="removeImage" style="position:absolute;top:5px;right:5px;width:26px;height:23px;background:url('+jQuery('.temppath').html()+'/images/admin-delete-icon.png) no-repeat;cursor:pointer;" onclick="jQuery(this).parent().remove();upperPageOptions.updateCaptionsList();" ></a></div>').find('.captions_list_item input').last().css('display','block').focus();
			});
			
			jQuery('.captions_list_container').sortable({
				placeholder: '.captions_list_container',
				items: 'div.captions_list_item',
				dropOnEmpty: true,
				forceHelperSize: true,
				appendTo: "parent",
				start: function(event,ui){
					ui.item.css({
					  	'transition': 'none',
						'-webkit-transition': 'none',
						'-moz-transition': 'none',
						'-ms-transition': 'none',
						'-o-transition': 'none'
					});
				},
				stop: function(event,ui){
					upperPageOptions.updateCaptionsList();
				}
			});
			
			upperPageOptions.updateCaptionsOptions();
			jQuery('#introCaptionsEnable_value').change(function(){ upperPageOptions.updateCaptionsOptions(); });
		}
		
		if (jQuery('#introContinueType_value').length){
			upperPageOptions.updateContinueButtonTypeOptions();
			jQuery('#introContinueType_value').change(function(){ upperPageOptions.updateContinueButtonTypeOptions(); });
		}
		
		if (jQuery('#introContinueEnable_value').length){
			upperPageOptions.updateContinueButtonOptions();
			jQuery('#introContinueEnable_value').change(function(){ upperPageOptions.updateContinueButtonOptions(); });
		}
	
		/* ENDOF FLASH NEW STUFF */

		/* new - sidebars on pages */
		jQuery('#sidebar_for_default_value').parent().css('display','none');
		jQuery('#sidebars_available_value').parent().css('display','none');
		if (jQuery('#post_type').length > 0 && jQuery('#post_type').val() == "page"){
			jQuery('#pageparentdiv.postbox .inside').append('<h4 class="page-option-title">Page Layout</h4><div class="des_layouts" title="none" /><div class="des_layouts" title="left" /><div class="des_layouts" title="right" /></div>');
			jQuery('#sidebars_available_value').add(jQuery('#sidebars_available_value').siblings()).wrapAll('<div class="blake_sidebars_available" style="display:none;"/>');
			jQuery('#pageparentdiv.postbox .inside').css('display','inline-block').append(jQuery('.blake_sidebars_available'));
			jQuery('#pageparentdiv.postbox .inside .des_layouts').each(function(){
				if (jQuery(this).attr('title') === jQuery('#sidebar_for_default_value').val()){
					jQuery(this).addClass('selected');
				} else {
					jQuery(this).removeClass('selected');
				}
				if (jQuery('#pageparentdiv.postbox .inside .des_layouts.selected').attr('title') === "none"){
					jQuery('#pageparentdiv.postbox .inside .blake_sidebars_available').css('display','none');
				} else {
					jQuery('#pageparentdiv.postbox .inside .blake_sidebars_available').css('display','block');
				}
			
				jQuery(this).click(function(){
					jQuery(this).siblings().removeClass('selected');
					jQuery(this).addClass('selected');
					jQuery('#sidebar_for_default_value').val(jQuery(this).attr('title'));
					if (jQuery('#pageparentdiv.postbox .inside .des_layouts.selected').attr('title') === "none"){
						jQuery('#pageparentdiv.postbox .inside .blake_sidebars_available').css('display','none');
					} else {
						jQuery('#pageparentdiv.postbox .inside .blake_sidebars_available').css('display','block');
					}
				});
			});	
		}

		/* des_templater */
		jQuery('#new-meta-box-des-templater .inside .option-container:even').each(function(){
			jQuery(this).append(jQuery(this).next());
		});
		jQuery('#new-meta-box-des-templater .inside > .option-container .option-container').each(function(){
			jQuery(this).css({ 'margin-right': '40px', 'margin-top': '-100px', 'border': 'none', 'float':'right'});
			if (!jQuery(this).find('select option').length){
				jQuery(this).find('select').css('display','none').after('<h4>No templates found for this section.</h4>');
				jQuery(this).css({'margin-top':'0px', 'float':'left','display':'block'}).siblings().css('display','none');
			}
			if (jQuery(this).children('select').val() == null){
				jQuery(this).parent().siblings('select').val('no');
				jQuery(this).css('display','block');
			}
		});
		jQuery('#new-meta-box-des-templater .inside > .option-container > select').each(function(e){
			
			if (jQuery(this).val() === "no"){
				jQuery(this).siblings('.option-container').fadeOut(1, function(){
					jQuery('#new-meta-box-des-templater .option-container h4:not(.page-option-title').parent().css('display','block');
				});
			}
			jQuery(this).change(function(){
				if (jQuery(this).val() === "yes"){
					jQuery(this).siblings('.option-container').css('display','block');
				} else {
					jQuery(this).siblings('.option-container').css('display','none');
				}
			});
		});
		
	
		this.setColorPickerFunc();
		/* check template type */
		if (jQuery('#page_template').length){
			if (jQuery('#page_template').val() == "default") jQuery('#page_template').val('one-page-template.php');
			jQuery('#page_template option[value="default"]').css('display','none');
			upperPageOptions.updateCustomPageOpts();
			jQuery('#page_template').change(function(e){ upperPageOptions.updateCustomPageOpts(); });
		}
		
		/* flex custom options on projects */
		if (jQuery('#custom_slider_opts_value').length){
			this.updateCustomFlex();
			jQuery('#custom_slider_opts_value').change(function(e){ upperPageOptions.updateCustomFlex(); });
		}
		
		/* breadcrumbs */
		if (jQuery('#des_custom_breadcrumbs_value').length){
			this.updateBreadcrumbs();
			jQuery('#des_custom_breadcrumbs_value').change(function(e){ upperPageOptions.updateBreadcrumbs(); });
		}
		
		/* newsletter */
		if (jQuery('#des_custom_newsletter_value').length){
			this.updateNewsletter();
			jQuery('#des_custom_newsletter_value').change(function(e){ upperPageOptions.updateNewsletter(); });
		}
		
		if (jQuery('#homepageslider_value').val() === "no_slider"){
			jQuery('#homepageslider_value option[value=no_slider]').eq(0).attr('selected', true);
		}
		
		/* if post type option is available */
		if (jQuery('#posttype_value').length){
			jQuery('.thumb_slides_container').siblings('.description').remove();
			jQuery('#videoCode_noncename').parent().appendTo( jQuery('#videoCode_noncename').parent().prev() );
			jQuery('#videoCode_noncename').parent().removeClass('option-container');	
			upperPageOptions.updatePostTypeOpts();
			jQuery('#posttype_value').change(function(e){ upperPageOptions.updatePostTypeOpts(); });
		}
		
		/* if portfolio type option is available */
		if (jQuery('#portfolioType_value').length){
			jQuery('#videoCode_noncename').parent().appendTo( jQuery('#videoCode_noncename').parent().prev() );
			jQuery('#videoCode_noncename').parent().removeClass('option-container');
			upperPageOptions.updatePortfolioTypeOpts();
			jQuery('#portfolioType_value').change(function(e){ upperPageOptions.updatePortfolioTypeOpts(); });
		}
		
		upperPageOptions.updateHomeStyleOptions();
		jQuery('#page_template').add(jQuery('#blake_header_type_value')).trigger('change');
	},
	
	updateHomeStyleOptions: function(){
		switch( jQuery('#homeStyle_value').val() ){
			case "slider":
				jQuery('#homepageDefaultSlider_value').closest('.option-container').removeClass('optoff');
				showElements(jQuery('#homepageDefaultSlider_value').closest('.option-container'),0);
				hideElements(jQuery('#homeVideoSource_noncename').closest('.option-container').add(jQuery('#homeVideoSource_noncename').closest('.option-container').nextUntil(jQuery('#homeVideoMuted_noncename').parent())).add(jQuery('#homeVideoMuted_noncename').parent()),0);
				
				jQuery('.option-description.videoHelper').css('display','none');
				hideElements(jQuery('#introLogo_noncename').parent().add(jQuery('#introLogo_noncename').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent())),0);
				//jQuery('#parallaxEffect_value').parent().css('display','none');
				jQuery('#homeParallaxMedia_video_noncename').closest('.option-container').css('display','none');
				jQuery('#homeParallaxMedia_noncename').closest('.option-container').css('display','none');
				
			break;
			case "image":
				jQuery('#homepageDefaultSlider_value').closest('.option-container').addClass('optoff');
				hideElements(jQuery('#homepageDefaultSlider_value').closest('.option-container'),0);
								hideElements(jQuery('#homeVideoSource_noncename').closest('.option-container').add(jQuery('#homeVideoSource_noncename').closest('.option-container').nextUntil(jQuery('#homeVideoMuted_noncename').parent())).add(jQuery('#homeVideoMuted_noncename').parent()).not(jQuery('#homeParallaxMedia_noncename').parent()),0);
								
				jQuery('#homeParallaxMedia_noncename').closest('.option-container').css('display','block');
				showElements(jQuery('#introLogo_noncename').parent().add(jQuery('#introLogo_noncename').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent())),0);
				jQuery('.option-description.videoHelper').css('display','none');
				jQuery('#parallaxEffect_value').parent().css('display','block');
				jQuery('#homeParallaxMedia_noncename').closest('.option-container').css('display','block');
				jQuery('#homeParallaxMedia_video_noncename').closest('.option-container').css('display','none');
				
			break;
			case "video": 
				jQuery('#homepageDefaultSlider_value').closest('.option-container').addClass('optoff');
				hideElements(jQuery('#homepageDefaultSlider_value').closest('.option-container'),0);
				
showElements(jQuery('#homeVideoSource_noncename').closest('.option-container').add(jQuery('#homeVideoSource_noncename').closest('.option-container').nextUntil(jQuery('#homeVideoMuted_noncename').parent()).not(jQuery('#homeParallaxMedia_noncename'))).add(jQuery('#homeVideoMuted_noncename').parent()),0);

showElements(jQuery('#introLogo_noncename').parent().add(jQuery('#introLogo_noncename').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent())),0);
				jQuery('.option-description.videoHelper').css('display','block');
				jQuery('#parallaxEffect_value').parent().css('display','block');
				
				jQuery('#homeParallaxMedia_video_noncename').closest('.option-container').css('display','block');
				jQuery('#homeParallaxMedia_noncename').closest('.option-container').css('display','none');
				upperPageOptions.updateVideoSourceOptions();

			break;
		}
	},
	
	updateVideoSourceOptions: function(){
		switch(jQuery('#homeVideoSource_value').val()){
			case "youtube":
				showElements(jQuery('#homeYoutubeLink_noncename').parent().removeClass('optoff'),0);
				hideElements(jQuery('#homeParallaxMedia_video_noncename').parent().addClass('optoff'),0);
			break;
			case "media":
				showElements(jQuery('#homeParallaxMedia_video_noncename').parent().removeClass('optoff'),0);
				hideElements(jQuery('#homeYoutubeLink_noncename').parent().addClass('optoff'),0);
			break;
		}
	},
	
	updateLogoTypeOptions: function(){
		switch(jQuery('#introLogo_value').val()){
			case "image":
				var hideElems = [
					jQuery('#introLogo_value').parent().next().next().next().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next(),
					jQuery('#introLogo_value').parent().next().next(),
					jQuery('#introLogo_value').parent().next(),
				];
				jQuery(hideElems).map(function(){this.toArray();});
				jQuery(hideElems).each(function(){ jQuery(this).addClass('optoff'); });
				hideElements(hideElems,0);
				var showElems = [
					jQuery('.logo_intro_container').parent(),
					jQuery('.logo_intro_container').parent().next(),
				];
				jQuery(showElems).map(function(){this.toArray();});
				jQuery(showElems).each(function(){ jQuery(this).removeClass('optoff'); });
				showElements(showElems.reverse(),0);
			break;
			case "text":
				var showElems = [
					jQuery('#introLogo_value').parent().next().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next().next(),
					jQuery('#introLogo_value').parent().next().next().next(),
					jQuery('#introLogo_value').parent().next().next(),
					jQuery('#introLogo_value').parent().next(),
				];
				jQuery(showElems).map(function(){this.toArray();});
				jQuery(showElems).each(function(){ jQuery(this).removeClass('optoff'); });
				showElements(showElems.reverse(),0);
				var hideElems = [
					jQuery('.logo_intro_container').parent(),
					jQuery('.logo_intro_container').parent().next(),
				];
				jQuery(hideElems).map(function(){this.toArray();});
				jQuery(hideElems).each(function(){ jQuery(this).addClass('optoff'); });
				hideElements(hideElems,0);
			break;
			case "none":
				jQuery('#introLogo_value').parent().nextUntil(jQuery('#introCaptionsEnable_value').parent()).addClass('optoff');
				hideElements(jQuery('#introLogo_value').parent().nextUntil(jQuery('#introCaptionsEnable_value').parent()),0);
			break;
		}
	},
	
	updateCaptionsOptions: function(){
		var elements = [
			jQuery('#introCaptionsEnable_value').parent().next().next().next(),
			jQuery('#introCaptionsEnable_value').parent().next().next(),
			jQuery('#introCaptionsEnable_value').parent().next()
		];
		jQuery(elements).map(function(){this.toArray();});
		if (jQuery('#introCaptionsEnable_value').val() === "yes"){
			jQuery(elements).each(function(){ jQuery(this).removeClass('optoff'); });
			showElements(elements.reverse(),0);
		} else {
			jQuery(elements).each(function(){ jQuery(this).addClass('optoff'); });
			hideElements(elements,0);
		}
	},
	
	updateContinueButtonOptions: function(){
		if (jQuery('#introContinueEnable_value').val() === "yes"){
			jQuery('#introContinueEnable_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()).removeClass('optoff');
			showElements(jQuery('#introContinueEnable_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()), 0);
		} else {
			jQuery('#introContinueEnable_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()).addClass('optoff');
			hideElements(jQuery('#introContinueEnable_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()), 0);
		}
	},
	
	updateContinueButtonTypeOptions: function(){
		if (jQuery('#introContinueType_value').val() === "text"){
			jQuery('#introContinueType_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()).removeClass('optoff');
			showElements(jQuery('#introContinueType_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()), 0);
		} else {
			jQuery('#introContinueType_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()).addClass('optoff');
			hideElements(jQuery('#introContinueType_value').parent().nextUntil(jQuery('#secondaryTitle_noncename').parent()), 0);
		}
	},
	
	updateBreadcrumbs: function(){
		if (jQuery('#des_custom_breadcrumbs_value').val() == "off"){
			hideElements(jQuery('#des_custom_breadcrumbs_value').parent().next(), 0);
		} else showElements(jQuery('#des_custom_breadcrumbs_value').parent().next(), 0); 
	},
	
	updateNewsletter: function(){
		if (jQuery('#des_custom_newsletter_value').val() == "off"){
			hideElements(jQuery('#des_custom_newsletter_value').parent().next(), 0);
		} else showElements(jQuery('#des_custom_newsletter_value').parent().next(), 0); 
	},
	
	setColorPickerFunc:function(){
		//set the colorpciker to be opened when the input has been clicked
		
		jQuery('input.color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val('#'+hex);
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		});
		
	},
	updateCustomFlex:function(){
		var elements = [
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next(),
			jQuery('#custom_slider_opts_value').parent().next(),
			jQuery('#projs_flex_height_noncename').parent()
		];
		if (jQuery('#custom_slider_opts_value').val() == "off"){
			jQuery(elements).map(function(){this.toArray();});
			jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
			hideElements(elements,0);
		} else {
			jQuery(elements).map(function(){this.toArray();});
			jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
			showElements(elements.reverse(),0);
		}
	},
	updateCustomPageOpts: function(){
		/* make custom page options available according to the page template type */
		switch (jQuery('#page_template').val()){
			case "page.php":
				jQuery('#new-meta-boxes').css('display','block');
				toggleHomepageOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > div.des_layouts').css('display','block');
				if (jQuery('#sidebar_for_default_value').val() != "none"){
					jQuery('#pageparentdiv.postbox .inside > .blake_sidebars_available').css('display','block');
				}
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).css('display','none');
				togglePageOptions("show");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','none');
			break;
			
			case "one-page-template.php":
				jQuery('#new-meta-boxes').css('display','none');
				toggleHomepageOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .blake_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').css('display','none');
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).css('display','none');
				togglePageOptions("hide");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','none');
			break;
	
			case "template-home.php":
				jQuery('#new-meta-boxes').css('display','block');
				toggleHomepageOptions("show");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .blake_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').css('display','none');
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).css('display','none');
				togglePageOptions("hide");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','none');
				jQuery('#blake_enable_custom_header_options_value').closest('.option-container').css('display','block').removeClass('hiddenoption');
				upperPageOptions.updateHomeStyleOptions();
			break;
			
			case "template-under-construction.php":
				jQuery('#new-meta-boxes').css('display','block');
				toggleHomepageOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .blake_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').css('display','none');
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).removeClass('hiddenoption').css('display','block');
				togglePageOptions("hide");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','none');
			break;
			
			case "blog-template.php": case "blog-masonry-template.php": 
				jQuery('#new-meta-boxes').css('display','block');
				toggleHomepageOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > div.des_layouts').css('display','block');
				if (jQuery('#sidebar_for_default_value').val() != "none"){
					jQuery('#pageparentdiv.postbox .inside > .blake_sidebars_available').css('display','block');
				}
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).css('display','none');
				togglePageOptions("show");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','block');
			break;
			
			case "template-blank.php":
				jQuery('#new-meta-boxes').css('display','none');
				toggleHomepageOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').css('display','none');
				jQuery('#underconstruction_rev_value').closest('.option-container').add(jQuery('#underconstruction_rev_value').closest('.option-container').prev()).addClass('hiddenoption').css('display','none');
				togglePageOptions("hide");
				jQuery('.blogoptions').nextUntil(jQuery('.pagetitleoptions')).andSelf().css('display','none');
			break;
		}
		jQuery('#blake_header_type_value').trigger('change');
		jQuery('#blake_enable_breadcrumbs_value').trigger('change');
	},
	updatePostTypeOpts: function(){
		jQuery('#posttype_value').parent().nextUntil(jQuery('#audioCode_noncename').parent().next()).addClass('optoff');
		hideElements(jQuery('#posttype_value').parent().nextUntil(jQuery('#audioSource_noncename').parent().next()),0);
		switch(jQuery('#posttype_value').val()){
			case "slider":
				jQuery('#sliderImages_noncename').parent().prev().andSelf().removeClass('optoff');
				showElements(jQuery('#sliderImages_noncename').parent().prev().andSelf(),0);
			break;
			case "video":
				jQuery('#videoSource_noncename').parent().prev().andSelf().removeClass('optoff');
				showElements(jQuery('#videoSource_noncename').parent().prev().andSelf(),0);
			break;
			case "audio":
				jQuery('#audioSource_noncename').parent().prev().andSelf().removeClass('optoff');
				showElements(jQuery('#audioSource_noncename').parent().prev().andSelf(),0);
			break;
			case "quote":
				jQuery('#quote_text_noncename').parent().prev().nextUntil(jQuery('.ui-dialog-titlebar')).andSelf().removeClass('optoff');
				showElements(jQuery('#quote_text_noncename').parent().prev().nextUntil(jQuery('.ui-dialog-titlebar')).andSelf(),0);
			break;
			case "link":
				jQuery('#link_text_noncename').parent().prev().nextUntil(jQuery('.ui-dialog-titlebar')).andSelf().removeClass('optoff');
				showElements(jQuery('#link_text_noncename').parent().prev().nextUntil(jQuery('.ui-dialog-titlebar')).andSelf(),0);
			break;
		}
	},
	updatePortfolioTypeOpts: function(){
		switch(jQuery('#portfolioType_value').val()){
			case "image":
				jQuery('#sliderImages_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()).removeClass('optoff');
				showElements(jQuery('#sliderImages_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()),0);
				jQuery('#videoSource_noncename').parent().prev().andSelf().addClass('optoff');
				hideElements(jQuery('#videoSource_noncename').parent().prev().andSelf(),0);
				
								jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent()).andSelf().removeClass('optoff');
				showElements(				jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent()).andSelf(),0);
				upperPageOptions.updateCustomFlex();
			break;
			case "video":
				jQuery('#videoSource_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()).removeClass('optoff');
				showElements(jQuery('#videoSource_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()),0);
				jQuery('#sliderImages_noncename').parent().prev().andSelf().addClass('optoff');
				hideElements(jQuery('#sliderImages_noncename').parent().prev().andSelf(),0);
				
				jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent().next()).andSelf().addClass('optoff');
				hideElements(				jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent().next()).andSelf(),0);
			break;
			case "other":
				jQuery('#sliderImages_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()).addClass('optoff');
				hideElements(jQuery('#sliderImages_noncename').parent().prev().andSelf().add(jQuery('#singleLayout_noncename').parent()),0);
				jQuery('#videoSource_noncename').parent().prev().andSelf().addClass('optoff');
				hideElements(jQuery('#videoSource_noncename').parent().prev().andSelf(),0);
				
								jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent().next()).andSelf().addClass('optoff');
				hideElements(				jQuery('#custom_slider_opts_noncename').parent().nextUntil(jQuery('#projs_flex_height_noncename').parent().next()).andSelf(),0);
			break;
		}
	}
};

function toggleBodyLayoutTypeOpts(action){
	var showElms = [
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next()

	];
	jQuery(showElms).map(function(){this.toArray();});
	jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
	var hideElms = [
		jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next().next(),
		jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next()
	];
	jQuery(hideElms).map(function(){this.toArray();});
	jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
	switch(action){
		case "show":
			jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
			showElements(showElms.reverse(),0);
			break;
		case "hide":
			jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
			hideElements(hideElms,0);
			break;
	}
}

function toggleHomepageOptions(action){
	switch (action){
		case "show":
			showElements(jQuery('.homepageoptions').nextAll().andSelf(), 0);
			break;
		case "hide":
			hideElements(jQuery('.homepageoptions').nextAll().andSelf(), 0);
			break;
	}
}


function togglePageOptions(action){
	switch (action){
		case "show":
			showElements(jQuery('.pagetitleoptions').nextUntil(jQuery('.underconstructionoptions')).andSelf().removeClass('hiddenoption'),0);
			jQuery('#blake_enable_custom_pagetitle_options_value').trigger('change');
			jQuery('#blake_enable_custom_header_options_value').trigger('change');
			break;
		case "hide":
			hideElements(jQuery('.pagetitleoptions').nextUntil(jQuery('.underconstructionoptions')).andSelf().addClass('hiddenoption'),0);
			break;
	}
}


function showElements(elements,idx){
	if (elements[idx] && jQuery(elements[idx]).prop('tagName').toLowerCase() != 'script'){
		if (!jQuery(elements[idx]).hasClass('optoff')){
			jQuery(elements[idx]).css('display','block');
			showElements(elements, idx + 1 );
		} else {
			showElements(elements, idx + 1 );	
		}
	}
}

function hideElements(elements,idx){
	if(elements[idx]){
	    jQuery(elements[idx]).css('display','none');
	    hideElements(elements, idx + 1 );
	}
}


jQuery(function(){
	upperPageOptions.init();
});

