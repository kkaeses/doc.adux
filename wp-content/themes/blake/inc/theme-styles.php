<?php
	
/*-----------------------------------------------------------------------------------*/
/*  Blake Theme Styles
/*-----------------------------------------------------------------------------------*/

function blake_custom_style() {
	
	global $blake_custom, $blake_styleColor, $post, $blake_import_fonts, $blake_header_bgstyle_pre, $blake_header_bgstyle_after;
	$theid = get_the_ID();
	$blake_styleColor = "#".get_option("blake_style_color");
	if ("#".get_option("blake_style_color") != $blake_styleColor) $blake_styleColor = "#".get_option("blake_style_color");
	$blake_styleColor_rgb = blake_hex2rgb($blake_styleColor);
	$bodyLayoutType = get_option("blake_body_layout_type");
	$headerType = get_option("blake_header_type");
	
	$blake_header_bgstyle_pre = get_option('blake_header_style_light_dark', 'light') == 'light' ? 'light' : 'dark';
	$blake_header_bgstyle_after = get_option('blake_header_after_scroll_style_light_dark', 'light') == 'light' ? 'light' : 'dark';
	
	if (is_singular() && get_post_meta($theid, 'blake_enable_custom_header_options_value', true) == 'yes'){
		$blake_header_bgstyle_pre = get_post_meta($theid, 'blake_custom_header_pre_value', true);
		$blake_header_bgstyle_after = get_post_meta($theid, 'blake_custom_header_after_value', true);
	}
	
	$blake_header_style_pre = $blake_header_bgstyle_pre == 'dark' ? 'light' : 'dark';
	$blake_header_style_after = $blake_header_bgstyle_after == 'dark' ? 'light' : 'dark';
	
	global $blake_import_fonts;
	
	$blake_style_data = "";
	
	$blake_style_data .= ".widget li a:after, .widget_nav_menu li a:after, .custom-widget.widget_recent_entries li a:after{
		color: #".esc_html(get_option('blake_p_color')).";
	}
	body, p, .lovepost a, .widget ul li a, .widget p, .widget span, .widget ul li, .the_content ul li, .the_content ol li, #recentcomments li, .custom-widget h4, .widget.widget-newsletter h3, .widget.des_cubeportfolio_widget h4, .widget.des_recent_posts_widget h4, .custom-widget ul li a, .des_partners_widget h4, .aio-icon-description, li, .smile_icon_list li .icon_description p, .contact-widget-container h4{
		";
		$font = get_option('blake_p_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "" ;
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."' ,sans-serif;
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_p_size'), 10))."px;
		color: #".esc_html(get_option('blake_p_color')).";
	}
	
	.map_info_text{
		";
		$font = get_option('blake_p_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."' ,sans-serif;
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_p_size')), 10)."px;
		color: #".esc_html(get_option('blake_p_color'))." !important;
	}
	
	a, .pageXofY .pageX, .pricing .bestprice .name, .filter li a:hover, .widget_links ul li a:hover, #contacts a:hover, .title-color, .ms-staff-carousel .ms-staff-info h4, .filter li a:hover, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, a.go-about:hover, .text_color, .navbar-nav .dropdown-menu a:hover, .profile .profile-name, #elements h4, #contact li a:hover, #agency-slider h5, .ms-showcase1 .product-tt h3, .filter li a.active, .contacts li i, .big-icon i, .navbar-default.dark .navbar-brand:hover,.navbar-default.dark .navbar-brand:focus, a.p-button.border:hover, .navbar-default.light-menu .navbar-nav > li > a.selected, .navbar-default.light-menu .navbar-nav > li > a.selected:hover, .navbar-default.light-menu .navbar-nav > li > a.selected, .navbar-default.light-menu .navbar-nav > .open > a,.navbar-default.light-menu .navbar-nav > .open > a:hover, .navbar-default.light-menu .navbar-nav > .open > a:focus, .light-menu .dropdown-menu > li > a:focus, a.social:hover:before, .symbol.colored i, .icon-nofill, .slidecontent-bi .project-title-bi p a:hover, .grid .figcaption a.thumb-link:hover, .tp-caption a:hover, .btn-1d:hover, .btn-1d:active, #contacts .tweet_text a, #contacts .tweet_time a, .social-font-awesome li a:hover, h2.post-title a:hover, .tags a:hover, .blake-button-color span, #contacts .form-success p, .nav-container .social-icons-fa a i:hover, .the_title h2 a:hover, .widget ul li a:hover, .nav-previous-nav1:hover a, .nav-next-nav1:hover a, .blake_breadcrumbs a:hover, .special_tabs.icontext .label.current a, .special_tabs.text .label.current a, #big_footer .widget-newsletter .banner .text_color, .custom-widget .widget-newsletter .banner .text_color, .des-pages .postpagelinks, .widget_nav_menu .current-menu-item > a, .team-position{
	  color: ".esc_html($blake_styleColor).";
	}
	
	.aio-icon-read, .tp-caption a.text_color, #big_footer .social-icons-fa a i:hover{color: ".esc_html($blake_styleColor)." !important;}
	
	.homepage_parallax .home-logo-text a.light:hover, .homepage_parallax .home-logo-text a.dark:hover, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a, #big_footer .newsletter_shortcode .banner h3 .text_color, .widget li a:hover:before, .widget_nav_menu li a:hover:before, .footer_sidebar ul li a:hover:before, .custom-widget li a:hover:before, .special_tabs.icontext .label.current i, .single-portfolio .social-shares ul li a:hover, .partners-container .slick-dots .slick-active i{
		color: ".esc_html($blake_styleColor)." !important;
	}
	
	a.sf-button.hide-icon, .tabs li.current, .readmore:hover, .navbar-default .navbar-nav > .open > a,.navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, a.p-button:hover, a.p-button.colored, .light #contacts a.p-button, .tagcloud a:hover, .rounded.fill, .colored-section, .pricing .bestprice .price, .pricing .bestprice .signup, .signup:hover, .divider.colored, .services-graph li span, .no-touch .hi-icon-effect-1a .hi-icon:hover, .hi-icon-effect-1b .hi-icon:hover, .no-touch .hi-icon-effect-1b .hi-icon:hover, .symbol.colored .line-left, .symbol.colored .line-right, .projects-overlay #projects-loader, .panel-group .panel.active .panel-heading, .double-bounce1, .double-bounce2, .blake-button-color-1d:after, .container1 > div, .container2 > div, .container3 > div, .cbp-l-caption-buttonLeft:hover, .cbp-l-caption-buttonRight:hover, .flex-control-paging li a.flex-active, .post-content a:hover .post-quote, .post-listing .post a:hover .post-quote, h2.post-title.post-link:hover, .blake-button-color-1d:after, .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range,.blake_little_shopping_bag .overview span.minicart_items, .nav-previous:hover, .nav-next:hover, .next-posts:hover, .prev-posts:hover, .btn-contact-left input, .single #commentform .form-submit #submit, a#send-comment, .newsletter_shortcode form input.button, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a i.vc_tta-controls-icon, .errorbutton, .single-portfolio .social-shares ul li a:hover i{
		background-color:".esc_html($blake_styleColor).";
	}
	
	.wpcf7 .blake-form-main-slider .slider-button input, .flip-box-wrap .flip_link a:hover, .vc_btn3-style-custom:hover, .btn-contact-left.inversecolor input:hover{
		background-color:".esc_html($blake_styleColor)." !important;color: #fff !important;
	}
	.flip-box-wrap .flip_link a:hover{border: 2px solid ".esc_html($blake_styleColor)."}
	.widget .slick-dots li.slick-active i, .style-light .slick-dots li.slick-active i, .style-dark .slick-dots li.slick-active i{color: ".esc_html($blake_styleColor)." !important;opacity: 1;}
	
	
	.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale{
		background-color:".esc_html($blake_styleColor).";
		color: #fff !important;
	}
	.nav-container a.button.blake_minicart_checkout_but:hover, .nav-container a.button.blake_minicart_cart_but:hover{
		background-color: ".esc_html($blake_styleColor)." !important;
		color: #fff !important;
		border: 2px solid ".esc_html($blake_styleColor)." !important;
		opacity: 1;
	}
	.blake-button-color-1d:hover, .blake-button-color-1d:active{
		border: 1px double ".esc_html($blake_styleColor).";
	}
	
	.blake-button-color{
		background-color:".esc_html($blake_styleColor).";
		color: ".esc_html($blake_styleColor).";
	}

	.widget_posts .tabs li.current{border: 1px solid ".esc_html($blake_styleColor).";}
	.hi-icon-effect-1 .hi-icon:after{box-shadow: 0 0 0 3px ".esc_html($blake_styleColor).";}
	.colored-section:after {border: 20px solid ".esc_html($blake_styleColor).";}
	.filter li a.active, .filter li a:hover, .panel-group .panel.active .panel-heading{border:1px solid ".esc_html($blake_styleColor).";}
	.navbar-default.light-menu.border .navbar-nav > li > a.selected:before, .navbar-default.light-menu.border .navbar-nav > li > a.selected:hover, .navbar-default.light-menu.border .navbar-nav > li > a.selected{
		border-bottom: 1px solid ".esc_html($blake_styleColor).";
	}
	
	.cbp-l-caption-alignCenter .cbp-l-caption-buttonLeft:hover, .cbp-l-caption-alignCenter .cbp-l-caption-buttonRight:hover {
	    background-color: #212121 !important;
	    color: #fff !important;
	}
	
	.doubleborder{
		border: 6px double ".esc_html($blake_styleColor).";
	}
	
	
	.special_tabs.icon .current .blake_icon_special_tabs{
		background: ".esc_html($blake_styleColor).";
		border: 1px solid transparent;
	}
	.blake-button-color, .des-pages .postpagelinks, .tagcloud a:hover{
		border: 1px solid ".esc_html($blake_styleColor).";
	}
	
	.navbar-collapse ul.menu-depth-1 li:not(.blake_mega_hide_link) a, .dl-menuwrapper li:not(.blake_mega_hide_link) a, .gosubmenu, .nav-container .blake_minicart ul li {";
		$font = get_option('blake_sub_menu_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."', sans-serif;
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_sub_menu_font_size'),10))."px;
		color: #".esc_html(get_option('blake_sub_menu_color')).";";
		if (get_option('blake_sub_menu_uppercase') === 'on') $blake_style_data .= "text-transform: uppercase;\n";
		$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_sub_menu_letter_spacing'),10))."px;
	}
	.dl-back{color: #".get_option('blake_sub_menu_color').";}
	
	.navbar-collapse ul.menu-depth-1 li:not(.blake_mega_hide_link):hover > a, .dl-menuwrapper li:not(.blake_mega_hide_link):hover > a, .dl-menuwrapper li:not(.blake_mega_hide_link):hover > a, .dl-menuwrapper li:not(.blake_mega_hide_link):hover > .gosubmenu, .dl-menuwrapper li.dl-back:hover, .navbar-nav .dropdown-menu a:hover i{
		color: #".get_option('blake_sub_menu_color_hover').";
	}
	
	ul.menu-depth-1, ul.menu-depth-1 ul, ul.menu-depth-1 li, #dl-menu ul{";
		$color = blake_hex2rgb(get_option("blake_sub_menu_bg_color"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sub_menu_bg_opacity")))/100).") !important;
	}
	
	.navbar-collapse .blake_mega_menu ul.menu-depth-2, .navbar-collapse .blake_mega_menu ul.menu-depth-2 ul {background-color: transparent !important;} 
	
	li:not(.blake_mega_menu) ul.menu-depth-1 li:hover, li.blake_mega_menu li.menu-item-depth-1 li:hover, .dl-menu li:hover{";
		$color = blake_hex2rgb(get_option("blake_sub_menu_bg_color_hover"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sub_menu_bg_opacity")))/100).") !important;
	}
	
	.navbar-collapse li:not(.blake_mega_menu) ul.menu-depth-1 li:not(:first-child){
		border-top: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
	}
	
	.navbar-collapse li.blake_mega_menu ul.menu-depth-2{
		border-right: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
	}
	#dl-menu ul li:not(:last-child) a, .blake_sub_menu_border_color{
		border-bottom: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
	}
	
	.navbar-collapse > ul > li > a{";
		$font = get_option('blake_menu_font_pre_'.$blake_header_style_pre); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."', sans-serif;
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_menu_font_size_pre_'.$blake_header_style_pre),10))."px;
		color: #".esc_html(get_option('blake_menu_color_pre_'.$blake_header_style_pre)).";";
		if (get_option('blake_menu_uppercase_pre_'.$blake_header_style_pre) === 'on') $blake_style_data .= "text-transform: uppercase;\n"; else $blake_style_data .= "text-transform:none;\n";
		$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_menu_letter_spacing_pre_'.$blake_header_style_pre),10))."px;
	}
	
	.navbar-collapse > ul > li > a:hover, .navbar-collapse > ul > li.current-menu-ancestor > a, .navbar-collapse > ul > li.current-menu-item > a, .navbar-collapse > ul > li > a.selected{
		color: #".esc_html(get_option('blake_menu_color_hover_pre_'.$blake_header_style_pre)).";
	}
	";	
	if (get_option('blake_menu_add_border_pre_'.$blake_header_style_pre) == "on"){
		$blake_style_data .= ".navbar-collapse ul.menu-depth-1, .nav-container .blake_minicart{border-top:3px solid #".get_option('blake_menu_border_color_pre_'.$blake_header_style_pre)." !important;}";
	}
	$blake_style_data .= "
	.navbar-default .navbar-nav > li > a {
		padding-right:".esc_html(intval(get_option('blake_menu_side_margin_pre_'.$blake_header_style_pre),10))."px;
		padding-left:".esc_html(intval(get_option('blake_menu_side_margin_pre_'.$blake_header_style_pre),10))."px;
		padding-top:".esc_html(intval(get_option('blake_menu_margin_top_pre_'.$blake_header_style_pre),10))."px;
		padding-bottom:".esc_html(intval(get_option('blake_menu_padding_bottom_pre_'.$blake_header_style_pre),10))."px;
	}
	
	header.style1 .header_social_icons, header.style2 .header_social_icons, header.style1 .search_trigger, header.style2 .search_trigger, header.style1 .blake_dynamic_shopping_bag, header.style2 .blake_dynamic_shopping_bag{
		padding-top:".esc_html(intval(get_option('blake_menu_margin_top_pre_'.$blake_header_style_pre),10))."px;
		padding-bottom:".esc_html(intval(get_option('blake_menu_padding_bottom_pre_'.$blake_header_style_pre),10))."px;
	}
	
	header:not(.header_after_scroll) .navbar-nav > li > ul{
		margin-top:".esc_html(intval(get_option('blake_menu_padding_bottom_pre_'.$blake_header_style_pre),10))."px;
	}

	header:not(.header_after_scroll) .dl-menuwrapper button:after{
		background: #".esc_html(get_option('blake_menu_color_hover_pre_'.$blake_header_style_pre)).";
		box-shadow: 0 6px 0 #".esc_html(get_option('blake_menu_color_hover_pre_'.$blake_header_style_pre)).", 0 12px 0 #".esc_html(get_option('blake_menu_color_hover_pre_'.$blake_header_style_pre)).";
	}

	.blake_minicart_wrapper{
		padding-top: ".esc_html(intval(get_option('blake_menu_padding_bottom_pre_'.$blake_header_style_pre),10))."px;
	}
	
	li.blake_mega_hide_link > a, li.blake_mega_hide_link > a:hover{";
		$font = get_option('blake_label_menu_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."' !important;
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_label_menu_font_size'),10))."px !important;
		color: #".esc_html(get_option('blake_label_menu_color'))." !important;";
		if (get_option('blake_label_menu_uppercase') === 'on') $blake_style_data .= "text-transform: uppercase !important;\n";
		$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_label_menu_letter_spacing'),10))."px !important;
	}
	
	.nav-container .blake_minicart li a:hover {";
		$font = get_option('blake_label_menu_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		color: #".esc_html(get_option('blake_label_menu_color'))." !important;
		text-decoration: none;
	}
	.nav-container .blake_minicart li a{";
		$font = get_option('blake_sub_menu_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_sub_menu_font_size'),10))."px;
		color: #".esc_html(get_option('blake_sub_menu_color')).";";
		if (get_option('blake_sub_menu_uppercase') === 'on') $blake_style_data .= "text-transform: uppercase;\n";
		$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_sub_menu_letter_spacing')),10)."px;
	}
	
	.dl-trigger{";
		$font = get_option('blake_menu_font_pre_'.$blake_header_style_pre); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."' !important;
		font-weight: ".esc_html($font[1])." !important;
		font-size: ".esc_html(intval(get_option('blake_menu_font_size_pre_'.$blake_header_style_pre),10))."px;";
		if (get_option('blake_menu_uppercase_pre_'.$blake_header_style_pre) === 'on') $blake_style_data .= "text-transform: uppercase;\n";
		$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_menu_letter_spacing_pre_'.$blake_header_style_pre),10))."px;
	}
	
	.blake_minicart{";
		$color = blake_hex2rgb(get_option("blake_sub_menu_bg_color"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sub_menu_bg_opacity")))/100).") !important;
	}
	
	.page_content a, header a, #big_footer a{";
		$font = get_option('blake_links_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_links_size'), 10))."px;
		color: #".esc_html(get_option('blake_links_color'))."
	}
	.page_content a:hover, header a:hover, #big_footer a:hover{
		color: #".esc_html(get_option('blake_links_color_hover')).";
		background-color: #".esc_html( is_array(get_option('blake_links_bg_color_hover')) ? "" : get_option('blake_links_bg_color_hover') ).";
	}
	
	h1{";
		$font = get_option('blake_h1_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h1_size'), 10))."px;
		color: #".esc_html(get_option('blake_h1_color')).";
	}
	
	h2{";
		$font = get_option('blake_h2_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h2_size'), 10))."px;
		color: #".esc_html(get_option('blake_h2_color')).";
	}
	
	h3{";
		$font = get_option('blake_h3_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h3_size'), 10))."px;
		color: #".esc_html(get_option('blake_h3_color')).";
	}
	
	h4{";
		$font = get_option('blake_h4_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h4_size'), 10))."px;
		color: #".esc_html(get_option('blake_h4_color')).";
	}
	.widget h2 > .widget_title_span, .wpb_content_element .wpb_accordion_header a, .custom-widget h4, .widget.widget-newsletter h3, .widget.des_cubeportfolio_widget h4, .widget.des_recent_posts_widget h4, .des_partners_widget h4, .contact-widget-container h4{
		color: #".esc_html(get_option('blake_h4_color')).";
	}
	.ult-item-wrap .title h4{font-size: 16px !important;}
	.wpb_content_element .wpb_accordion_header.ui-accordion-header-active a{color: ".esc_html($blake_styleColor).";}
	h5{";
		$font = get_option('blake_h5_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h5_size'), 10))."px;
		color: #".esc_html(get_option('blake_h5_color')).";
	}
	
	h6{";
		$font = get_option('blake_h6_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option('blake_h6_size'), 10))."px;
		color: #".esc_html(get_option('blake_h6_color')).";
	}
		
	header.navbar{";
		switch (get_option('blake_headerbg_type_'.$blake_header_bgstyle_pre)){
			case "color":
				$color = blake_hex2rgb(get_option("blake_headerbg_color_".$blake_header_bgstyle_pre));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_headerbg_opacity_".$blake_header_bgstyle_pre)))/100).");";
			break;
			case "image":
				$blake_style_data .= "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
				$blake_style_data .= "background: url(" . esc_url(get_option("blake_headerbg_image_".$blake_header_bgstyle_pre)) . ") no-repeat fixed !important; background-size: cover !important;";  
			break;
			case "pattern":
				$blake_style_data .= "background: url('" . esc_url(get_template_directory_uri()) . "/images/blake_patterns/" . get_option("blake_headerbg_pattern_".$blake_header_bgstyle_pre) . "') 0 0 repeat !important;";
			break;
			case "custom_pattern":
				$blake_style_data .= "background: url('" . esc_url(get_option("blake_headerbg_custom_pattern_".$blake_header_bgstyle_pre)) . "') 0 0 repeat !important;";
			break;
		}
	$blake_style_data .= "
	}
	
	body#boxed_layout{";
		switch (get_option("blake_bodybg_type")){
			case "image":
				$blake_style_data .= "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;width: 100%;height: 100%;
	background-attachment: fixed !important;";
				$blake_style_data .= "background: url(" . esc_url(get_option("blake_bodybg_type_image")) . ") no-repeat;";  
			break;
			case "color":
	 			$blake_style_data .= "background-color: #" . esc_html(get_option("blake_bodybg_type_color")) . ";";
			break;
		}
	$blake_style_data .= "
	}
	
	header a.navbar-brand{";
		if (get_option("blake_logo_margin_top")) 
			$blake_style_data .= "margin-top: " . str_replace(" ", "", get_option("blake_logo_margin_top")) . ";margin-bottom: " . str_replace(" ", "", get_option("blake_logo_margin_top")) . ";"; 
		if (get_option("blake_logo_margin_left")) $blake_style_data .= "margin-left: " . str_replace(" ", "", get_option("blake_logo_margin_left")) . ";"; 
		if (get_option("blake_logo_height")) $blake_style_data .= "height:" . get_option("blake_logo_height") . ";";
	$blake_style_data .= "
	}
	header a.navbar-brand img{max-height: ".esc_html(intval(get_option('blake_logo_height'),10))."px;}";
			
	$header_after_scroll = false;
	if (get_option('blake_fixed_menu') == 'on'){
		if (get_option('blake_header_after_scroll') == 'on'){
			$header_after_scroll = true;
			$blake_style_data .= "
			header.navbar.header_after_scroll, header.header_after_scroll .navbar-nav > li.blake_mega_menu > .dropdown-menu, header.header_after_scroll .navbar-nav > li:not(.blake_mega_menu) .dropdown-menu{";
				switch (get_option('blake_headerbg_after_scroll_type_'.$blake_header_bgstyle_after)){
					case "color":
						$color = blake_hex2rgb(get_option("blake_headerbg_after_scroll_color_".$blake_header_bgstyle_after));
						$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_headerbg_after_scroll_opacity_".$blake_header_bgstyle_after)))/100).")";
					break;
					case "image":
						$blake_style_data .= "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
						$blake_style_data .= "background: url(" . esc_url(get_option("blake_headerbg_after_scroll_image_".$blake_header_bgstyle_after)) . ") no-repeat fixed !important; background-size: cover !important;";  
					break;
					case "pattern":
						$blake_style_data .= "background: url('" . esc_url(get_template_directory_uri()) . "/images/blake_patterns/" . get_option("blake_headerbg_after_scroll_pattern_".$blake_header_bgstyle_after) . "') 0 0 repeat !important;";
					break;
					case "custom_pattern":
						$blake_style_data .= "background: url('" . esc_url(get_option("blake_headerbg_after_scroll_custom_pattern_".$blake_header_bgstyle_after)) . "') 0 0 repeat !important;";
					break;
				}
			$blake_style_data .= "
			}
			";
			$header_shrink = false;
			if (get_option('blake_fixed_menu') == 'on'){
				if (get_option('blake_header_after_scroll') == 'on'){
					if (get_option('blake_header_shrink_effect') == 'on'){
						$header_shrink = true;
						$blake_style_data .= "header.header_after_scroll a.navbar-brand img.logo_after_scroll{max-height: ". esc_html(intval(get_option('blake_logo_reduced_height'),10))."px;}";
					}
				}
			}
			
			$blake_style_data .= "
			header.header_after_scroll .navbar-collapse ul.menu-depth-1 li:not(.blake_mega_hide_link) a, header.header_after_scroll .dl-menuwrapper li:not(.blake_mega_hide_link) a, header.header_after_scroll .gosubmenu {
				color: #".esc_html(get_option('blake_sub_menu_color')).";
			}
			header.header_after_scroll .dl-back{color: #".esc_html(get_option('blake_sub_menu_color')).";}
			
			header.header_after_scroll .navbar-collapse ul.menu-depth-1 li:not(.blake_mega_hide_link):hover > a, header.header_after_scroll .dl-menuwrapper li:not(.blake_mega_hide_link):hover > a, header.header_after_scroll .dl-menuwrapper li:not(.blake_mega_hide_link):hover > a, header.header_after_scroll .dl-menuwrapper li:not(.blake_mega_hide_link):hover > header.header_after_scroll .gosubmenu, header.header_after_scroll .dl-menuwrapper li.dl-back:hover{
				color: #".esc_html(get_option('blake_sub_menu_color_hover')).";
			}
			
			header.header_after_scroll ul.menu-depth-1, header.header_after_scroll ul.menu-depth-1 ul, header.header_after_scroll ul.menu-depth-1 ul li, header.header_after_scroll #dl-menu ul{";
				$color = blake_hex2rgb(get_option("blake_sub_menu_bg_color"));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sub_menu_bg_opacity")))/100).") !important;
			}
			
			header.header_after_scroll .navbar-collapse .blake_mega_menu ul.menu-depth-2, header.header_after_scroll .navbar-collapse .blake_mega_menu ul.menu-depth-2 ul {background-color: transparent !important;} 
			
			header.header_after_scroll li:not(.blake_mega_menu) ul.menu-depth-1 li:hover, header.header_after_scroll li.blake_mega_menu li.menu-item-depth-1 li:hover, header.header_after_scroll #dl-menu ul li:hover{";
				$color = blake_hex2rgb(get_option("blake_sub_menu_bg_color_hover"));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sub_menu_bg_opacity")))/100).") !important;
			}
			
			header.header_after_scroll .navbar-collapse li:not(.blake_mega_menu) ul.menu-depth-1 li:not(:first-child){
				border-top: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
			}
			header.header_after_scroll .navbar-collapse li.blake_mega_menu ul.menu-depth-2{
				border-right: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
			}
			header.header_after_scroll #dl-menu li:not(:last-child) a, header.header_after_scroll #dl-menu ul li:not(:last-child) a{
				border-bottom: 1px solid #".esc_html(get_option('blake_sub_menu_border_color')).";
			}
			
			.header_after_scroll .navbar-collapse > ul > li > a{";
				$font = get_option('blake_menu_font_after_'.$blake_header_style_after); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
				$blake_style_data .= "
				font-family: '".wp_kses_post($font[0])."';
				font-weight: ".esc_html($font[1]).";
				font-size: ".esc_html(intval(get_option('blake_menu_font_size_after_'.$blake_header_style_after),10))."px;
				color: #".esc_html(get_option('blake_menu_color_after_'.$blake_header_style_after)).";";
				if (get_option('blake_menu_uppercase_after_'.$blake_header_style_after) === 'on') $blake_style_data .= "text-transform: uppercase;\n"; else $blake_style_data .= "text-transform:none;\n";
				$blake_style_data .= "letter-spacing: ".esc_html(intval(get_option('blake_menu_letter_spacing_after_'.$blake_header_style_after),10))."px;
			}
			
			.header_after_scroll .navbar-collapse > ul > li > a:hover, .header_after_scroll .navbar-collapse > ul > li.current-menu-ancestor > a, .header_after_scroll .navbar-collapse > ul > li.current-menu-item > a, .header_after_scroll .navbar-collapse > ul > li > a.selected{
				color: #".esc_html(get_option('blake_menu_color_hover_after_'.$blake_header_style_after)).";
			}
			
			.header_after_scroll .dl-menuwrapper button:after{
				background: #".esc_html(get_option('blake_menu_color_hover_after_'.$blake_header_style_after)).";
				box-shadow: 0 6px 0 #".esc_html(get_option('blake_menu_color_hover_after_'.$blake_header_style_after)).", 0 12px 0 #".esc_html(get_option('blake_menu_color_hover_after_'.$blake_header_style_after)).";
			}";
			
			if (get_option('blake_menu_add_border_after_'.$blake_header_style_after) == "on"){
				$blake_style_data .= ".header_after_scroll .navbar-collapse ul.menu-depth-1, .header_after_scroll .nav-container .blake_minicart{border-top:3px solid #".get_option('blake_menu_border_color_after_'.$blake_header_style_after)." !important;}";
			}
			$blake_style_data .= "
			header.header_after_scroll li.blake_mega_hide_link > a, header.header_after_scroll li.blake_mega_hide_link > a:hover{
				color: #".esc_html(get_option('blake_label_menu_after_scroll_color'))." !important;
			}";
			
			$header_shrink = false;
			if (get_option('blake_fixed_menu') == 'on'){
				if (get_option('blake_header_after_scroll') == 'on'){
					if (get_option('blake_header_shrink_effect') == 'on'){
						$header_shrink = true;
						$blake_style_data .= "
						header.header_after_scroll.navbar-default .navbar-nav > li > a {
							padding-right:".esc_html(intval(get_option('blake_menu_side_margin_after_'.$blake_header_style_after),10))."px;
							padding-left:".esc_html(intval(get_option('blake_menu_side_margin_after_'.$blake_header_style_after),10))."px;
							padding-top:".esc_html(intval(get_option('blake_menu_margin_top_after_'.$blake_header_style_after),10))."px;
							padding-bottom:".esc_html(intval(get_option('blake_menu_padding_bottom_after_'.$blake_header_style_after),10))."px;
						}
						
						header.header_after_scroll.style1 .header_social_icons, header.header_after_scroll.style2 .header_social_icons, header.header_after_scroll.style1 .search_trigger, header.header_after_scroll.style2 .search_trigger, header.header_after_scroll.style1 .blake_dynamic_shopping_bag, header.header_after_scroll.style2 .blake_dynamic_shopping_bag{
							padding-top:".esc_html(intval(get_option('blake_menu_margin_top_after_'.$blake_header_style_after),10))."px;
							padding-bottom:".esc_html(intval(get_option('blake_menu_padding_bottom_after_'.$blake_header_style_after),10))."px;
						}
						
						header.header_after_scroll .navbar-nav > li > ul{
							margin-top:".esc_html(intval(get_option('blake_menu_padding_bottom_after_'.$blake_header_style_after),10))."px;
						}
					
						header.header_after_scroll .blake_minicart_wrapper{
							padding-top:".esc_html(intval(get_option('blake_menu_padding_bottom_after_'.$blake_header_style_after),10))."px;
						}
						";
					}
				}
			}
		}
	}
		
	$header_shrink = false;
	if (get_option('blake_fixed_menu') == 'on'){
		if (get_option('blake_header_after_scroll') == 'on'){
			if (get_option('blake_header_shrink_effect') == 'on'){
				$header_shrink = true;
				$blake_style_data .= "
				header.header_after_scroll a.navbar-brand{";
					if (get_option("blake_logo_after_scroll_margin_top")) $blake_style_data .= "margin-top: " . str_replace(" ", "", get_option("blake_logo_after_scroll_margin_top")) . ";margin-bottom: " . str_replace(" ", "", get_option("blake_logo_after_scroll_margin_top")) . ";"; 
					if (get_option("blake_logo_after_scroll_margin_left")) $blake_style_data .= "margin-left: " . str_replace(" ", "", get_option("blake_logo_after_scroll_margin_left")) . ";"; 
					if (get_option("blake_logo_reduced_height")) $blake_style_data .= "height:" . get_option("blake_logo_reduced_height") . ";"; 
					else {
						if (get_option("blake_logo_height")) $blake_style_data .= "height:" . get_option("blake_logo_height") . ";";
					}
				$blake_style_data .= "
				}
				header.header_after_scroll a.navbar-brand h1{
					font-size: " . str_replace(" ", "", get_option("blake_logo_after_scroll_size")) . " !important;
				}
				";
			}
		}
	}
	
	if (get_option("blake_info_above_menu") == "on"){
		$color = blake_hex2rgb(get_option("blake_topbar_bg_color"));
		$blake_style_data .= "
		header .top-bar .top-bar-bg, header .top-bar #lang_sel a.lang_sel_sel, header .top-bar #lang_sel > ul > li > ul > li > a{
			background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_topbar_bg_opacity")))/100).");
		}
		header .top-bar ul.phone-mail li, header .top-bar ul.phone-mail li i{
			color: #".esc_html(get_option("blake_topbar_text_color")).";
		}
		header .top-bar a, header .top-bar ul.phone-mail li a{
			color: #".esc_html(get_option("blake_topbar_links_color"))." !important;
		}
		header .top-bar a:hover, header .top-bar ul.phone-mail li a:hover{
			color: #".esc_html(get_option("blake_topbar_links_hover_color"))." !important;
		}
		header .top-bar .social-icons-fa li a{
			color: #".esc_html(get_option("blake_topbar_social_color"))." !important;
		}
		header .top-bar .social-icons-fa li a:hover{
			color: #".esc_html(get_option("blake_topbar_social_hover_color"))." !important;
		}
		header .top-bar *{
			border-color: #".esc_html(get_option("blake_topbar_borders_color"))." !important;
		}
		header .top-bar .down-button{
			border-color: transparent rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_topbar_bg_opacity")))/100).") transparent transparent !important;
		}
		header .top-bar.opened .down-button{
			border-color: transparent #fff transparent transparent !important;
		}
		";
	}
	$blake_style_data .= "
	#primary_footer > .container{
		padding-top:".esc_html(intval(get_option('blake_primary_footer_padding_top'),10))."px;
		padding-bottom:".esc_html(intval(get_option('blake_primary_footer_padding_bottom'),10))."px;
	}
	#primary_footer{";
		switch (get_option("blake_footerbg_type")){
			case "image":
				$blake_style_data .= "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
				$blake_style_data .= "background: url(" . esc_url(get_option("blake_footerbg_image")) . ") no-repeat; background-size: cover !important;";  
			break;
			case "color":
				$color = blake_hex2rgb(get_option("blake_footerbg_color"));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_footerbg_color_opacity")))/100).");";
			break;
			case "pattern":
				$blake_style_data .= "background: url('" . esc_url(get_template_directory_uri()) . "/images/blake_patterns/" . esc_html(get_option("blake_footerbg_pattern")) . "') 0 0 repeat !important;";
			break;
			case "custom_pattern":
				$blake_style_data .= "background: url('" . esc_url(get_option("blake_footerbg_custom_pattern")) . "') 0 0 repeat !important;";
			break;
		}
	$blake_style_data .= "
	}

	#primary_footer input, #primary_footer textarea{";
		switch (get_option("blake_footerbg_type")){
			case "image": case "pattern": case "custom_pattern":
				$blake_style_data .= "background: transparent;";  
			break;
			case "color":
				$color = blake_hex2rgb(get_option("blake_footerbg_color"));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_footerbg_color_opacity")))/100).");";
			break;
		}
	$blake_style_data .= "
	}
	#primary_footer input, #primary_footer textarea{
		border: 1px solid #".esc_html(get_option("blake_footerbg_borderscolor")).";
	}
	#primary_footer hr, .footer_sidebar ul li a{
		border-top: 1px solid #".esc_html(get_option("blake_footerbg_borderscolor")).";
	}
	.footer_sidebar ul li:last-child{
		border-bottom: 1px solid #".esc_html(get_option("blake_footerbg_borderscolor")).";
	}
	#primary_footer a{
		color: #".esc_html(get_option("blake_footerbg_linkscolor")).";
	}
	
	#primary_footer, #primary_footer p, #big_footer input, #big_footer textarea{
		color: #".esc_html(get_option("blake_footerbg_paragraphscolor")).";
	}
	
	#primary_footer .footer_sidebar > h4, #primary_footer .footer_sidebar > .widget > h4 {
		color: #".esc_html(get_option("blake_footerbg_headingscolor")).";
	}
	
	#secondary_footer{";
		switch (get_option("blake_sec_footerbg_type")){
			case "image":
				$blake_style_data .= "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
				$blake_style_data .= "background: url(" . esc_url(get_option("blake_sec_footerbg_image")) . ") no-repeat fixed !important; background-size: cover !important;";  
			break;
			case "color":
				$color = blake_hex2rgb(get_option("blake_sec_footerbg_color"));
				$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_sec_footerbg_color_opacity")))/100).");";
			break;
			case "pattern":
				$blake_style_data .= "background: url('" . esc_url(get_template_directory_uri()) . "/images/blake_patterns/" . esc_html(get_option("blake_sec_footerbg_pattern")) . "') 0 0 repeat !important;";
			break;
			case "custom_pattern":
				$blake_style_data .= "background: url('" . esc_url(get_option("blake_sec_footerbg_custom_pattern")) . "') 0 0 repeat !important;";
			break;
		}
		$blake_style_data .= "
		padding-top:".esc_html(intval(get_option('blake_secondary_footer_padding_top'),10))."px;
		padding-bottom:".esc_html(intval(get_option('blake_secondary_footer_padding_bottom'),10))."px;
	}";
	
	if (get_option("blake_show_sec_footer") == "on"){
		if (get_option("blake_footer_display_logo") == "on"){
			if (get_option('blake_footer_logo_type') == "text"){
				$blake_style_data .= "
				#secondary_footer .footer_logo .logo{";
					$font = get_option('blake_sec_footer_logo_font'); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
					$blake_style_data .= "
					font-family: '".wp_kses_post($font[0])."';
					font-weight: ".esc_html($font[1]).";
					font-size: ".esc_html(intval(get_option('blake_sec_footer_logo_font_size'), 10))."px;
					color: #".esc_html(get_option('blake_sec_footer_logo_font_color')).";
				}
				#secondary_footer .footer_logo .logo:hover{
					color: #".esc_html(get_option('blake_sec_footer_logo_font_hover_color')).";
				}
				
				#secondary_footer .social-icons-fa a{
					font-size: ".esc_html(intval(get_option('blake_sec_footer_social_icons_size'),10))."px;
					line-height: ".esc_html(intval(get_option('blake_sec_footer_social_icons_size'),10))."px;
					color: #".esc_html(get_option('blake_sec_footer_social_icons_color')).";
				}
				#secondary_footer .social-icons-fa a:hover{
					color: #".esc_html(get_option('blake_sec_footer_social_icons_hover_color')).";
				}
				";
			}
		}
	}
	$blake_style_data .= "
	header .search_input{";
		$color = blake_hex2rgb(get_option("blake_search_input_background_color"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_search_input_background_opacity")))/100).");
	}
	header .search_input input.search_input_value{";
		$font = get_option("blake_search_input_font"); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; 	if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
	}
	header .search_input input.search_input_value, header .search_close{
		font-size: ".esc_html(intval(get_option("blake_search_input_font_size"),10))."px;
		color: #".esc_html(get_option("blake_search_input_font_color")).";
	}
	header .search_input .ajax_search_results ul{";
		$color = blake_hex2rgb(get_option("blake_search_result_background_color"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_search_result_background_opacity")))/100).");
	}
	header .search_input .ajax_search_results ul li.selected{";
		$color = blake_hex2rgb(get_option("blake_search_selected_result_background_color"));
		$blake_style_data .= "background-color: rgba(".esc_html($color[0].",".$color[1].",".$color[2].",".intval(str_replace("%","",get_option("blake_search_result_background_opacity")))/100).");
	}
	header .search_input .ajax_search_results ul li{
		border-bottom: 1px solid #".esc_html(get_option("blake_search_result_borders")).";
	}
	header .search_input .ajax_search_results ul li a{";
		$font = get_option("blake_search_input_font"); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; 	if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option("blake_search_result_font_size"),10))."px;
		color: #".esc_html(get_option("blake_search_result_font_color"))."
	}
	header .search_input .ajax_search_results ul li.selected a{
		color: #".esc_html(get_option("blake_search_selected_result_font_color"))."
	}
	header .search_input .ajax_search_results ul li a span, header .search_input .ajax_search_results ul li a span i{";
		$font = get_option("blake_search_result_details_font"); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		font-size: ".esc_html(intval(get_option("blake_search_result_details_font_size"),10))."px;
		color: #".esc_html(get_option("blake_search_result_details_font_color"))."
	}
	header .search_input .ajax_search_results ul li.selected a span{
		color: #".esc_html(get_option("blake_search_selected_result_details_font_color"))."
	}";
	
	if (is_user_logged_in() && get_option("blake_fixed_menu") == "on"){
		global $wpdb;
		$res = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id=%d AND meta_key=%s", get_current_user_id(), 'show_admin_bar_front'), OBJECT );
		
		if ($res && $res[0]->meta_value == "true"){
			$blake_style_data .= "
			body:not(.vc_editor) header { top:32px !important; }
			@media screen and (max-width:782px) {
				body:not(.vc_editor) header, body:not(.vc_editor) header .down-button {
					top:45px !important;
				}
				body:not(.vc_editor) header .top-bar-bg{
					margin-top: 44px !important;
				}
				#wpadminbar{position: fixed;}
			}
			";
		}
	}
	
	$loader = (is_page_template() && get_post_meta(get_the_ID(), 'blake_enable_custom_header_options_value', true) == "yes") ? get_post_meta(get_the_ID(), 'blake_enable_website_loading_value', true) : get_option("blake_enable_website_loader");
	if ($loader == "on"){
		$blake_style_data .= "
		body #blake_website_load, #blake_website_load .load2 .loader:before, #blake_website_load .load2 .loader:after, #blake_website_load .load3 .loader:after{background: #".esc_html(get_option("blake_loader_background")).";}
		
		.ball-pulse>div, .ball-pulse-sync>div, .ball-scale>div, .ball-rotate>div, .ball-rotate>div:before, .ball-clip-rotate>div, .ball-clip-rotate-pulse>div:first-child, .ball-beat>div, .ball-scale-multiple>div, .ball-triangle-path>div, .ball-pulse-rise>div, .ball-grid-beat>div, .ball-grid-pulse>div, .ball-spin-fade-loader>div, .ball-zig-zag>div, .ball-zig-zag-deflect>div, .line-scale>div, .line-scale-party>div, .line-scale-pulse-out>div, .line-scale-pulse-out-rapid>div, .line-spin-fade-loader>div, .square-spin>div, .pacman>div:nth-child(3),.pacman>div:nth-child(4),.pacman>div:nth-child(5),.pacman>div:nth-child(6), .cube-transition>div, .ball-rotate>div:after, .ball-rotate>div:before, #blake_website_load .load3 .loader:before, #blake_website_load .load3 .loader:before{background-color: #".esc_html(get_option("blake_loader_color")).";}

		.ball-clip-rotate>div{border-top-color: #".esc_html(get_option("blake_loader_color")).";border-left-color: #". esc_html(get_option("blake_loader_color")).";border-right-color: #".esc_html(get_option("blake_loader_color")).";}

		.ball-clip-rotate-pulse>div:last-child, .ball-clip-rotate-multiple>div:last-child{border-top-color: #".esc_html(get_option("blake_loader_color")).";border-bottom-color: #".esc_html(get_option("blake_loader_color")).";}
		
		.ball-clip-rotate-multiple>div{border-right-color: #".esc_html(get_option("blake_loader_color")).";border-left-color:#". esc_html(get_option("blake_loader_color")).";}

		.ball-triangle-path>div, .ball-scale-ripple>div, .ball-scale-ripple-multiple>div{border-color:#".esc_html(get_option("blake_loader_color")).";}
		
		.pacman>div:first-of-type, .pacman>div:nth-child(2){border-top-color: #".esc_html(get_option("blake_loader_color")).";border-left-color: #".esc_html(get_option("blake_loader_color")).";border-bottom-color: #".esc_html(get_option("blake_loader_color")).";}
		
		.load2 .loader{box-shadow:inset 0 0 0 1em #".esc_html(get_option("blake_loader_color")).";}";
		$color = blake_hex2rgb(get_option("blake_loader_color"));
		$blake_style_data .= "
		.load3 .loader{background:#".esc_html(get_option("blake_loader_color")).";background:-moz-linear-gradient(left, #".esc_html(get_option("blake_loader_color"))." 10%, rgba(".esc_html($color[0].",".$color[1].",".$color[2]).", 0) 42%);background:-webkit-linear-gradient(left, #".esc_html(get_option("blake_loader_color"))." 10%, rgba(".esc_html($color[0].",".$color[1].",".$color[2]).", 0) 42%);background:-o-linear-gradient(left, #".esc_html(get_option("blake_loader_color"))." 10%, rgba(".esc_html($color[0].",".$color[1].",".$color[2]).", 0) 42%);background:-ms-linear-gradient(left, #".esc_html(get_option("blake_loader_color"))." 10%, rgba(".esc_html($color[0].",".$color[1].",".$color[2]).", 0) 42%);background:linear-gradient(to right, #".esc_html(get_option("blake_loader_color"))." 10%, rgba(".esc_html($color[0].",".$color[1].",".$color[2]).", 0) 42%);}
			
		.load6 .loader{font-size:50px;text-indent:-9999em;overflow:hidden;width:1em;height:1em;border-radius:50%;position:relative;-webkit-transform:translateZ(0);-ms-transform:translateZ(0);transform:translateZ(0);-webkit-animation:load6 1.7s infinite ease;animation:load6 1.7s infinite ease}@-webkit-keyframes 'load6'{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg);box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}5%,95%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}10%,59%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.087em -0.825em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.173em -0.812em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.256em -0.789em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.297em -0.775em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}20%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.338em -0.758em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.555em -0.617em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.671em -0.488em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.749em -0.34em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}38%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.377em -0.74em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.645em -0.522em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.775em -0.297em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.82em -0.09em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg);box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}}@keyframes 'load6'{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg);box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}5%,95%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}10%,59%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.087em -0.825em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.173em -0.812em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.256em -0.789em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.297em -0.775em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}20%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.338em -0.758em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.555em -0.617em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.671em -0.488em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.749em -0.34em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}38%{box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", -0.377em -0.74em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", -0.645em -0.522em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", -0.775em -0.297em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", -0.82em -0.09em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg);box-shadow:0 -0.83em 0 -0.4em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.42em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.44em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.46em #".esc_html(get_option("blake_loader_color")).", 0 -0.83em 0 -0.477em #".esc_html(get_option("blake_loader_color")).";}}";
		
		if (get_option("blake_enable_website_loader_percentage") == "on"){
			$blake_style_data .= "
			body #blake_website_load .percentage{";
				$font = get_option("blake_loader_percentage_font"); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; if (!isset($font[1])) $font[1] = "";
				$blake_style_data .= "
				font-family: '".wp_kses_post($font[0])."', sans-serif;
				font-weight: ".esc_html($font[1]).";
				font-size: ".esc_html(intval(get_option("blake_loader_percentage_font_size"),10))."px;
				color: #".esc_html(get_option("blake_loader_percentage_font_color")).";
			}
			";
		}
	}
	
	$blake_style_data .= "
	.blake_breadcrumbs, .blake_breadcrumbs a, .blake_breadcrumbs span{";
		$font = get_option("blake_breadcrumbs_font"); $blake_import_fonts[] = $font; $font = explode("|",$font); $font[0] = $font[0]."', 'Arial', 'sans-serif"; 		if (!isset($font[1])) $font[1] = "";
		$blake_style_data .= "
		font-family: '".wp_kses_post($font[0])."';
		font-weight: ".esc_html($font[1]).";
		color: #".esc_html(get_option("blake_breadcrumbs_color")).";
		font-size: ".esc_html(intval(get_option("blake_breadcrumbs_size"),10))."px;
	}

	#menu_top_bar > li ul{background: #".get_option("blake_topbar_submenu_bg_color").";}
	#menu_top_bar > li ul li:hover{background: #".get_option("blake_topbar_submenu_bg_hover_color").";}
	#menu_top_bar > li ul a{color: #".get_option("blake_topbar_submenu_text_color")." !important;}
	#menu_top_bar > li ul a:hover, #menu_top_bar > li ul li:hover > a{color: #".esc_html(get_option("blake_topbar_submenu_text_hover_color"))." !important;}
	
	header.navbar .nav-container i{color: #".get_option("blake_header_icons_color_".$blake_header_bgstyle_pre).";}
	header.navbar .nav-container i:hover:not(.dropdown-menu i:hover){color: #".get_option("blake_header_icons_hover_color_".$blake_header_bgstyle_pre).";}
	header.header_after_scroll.navbar .nav-container i{color: #".get_option("blake_header_after_scroll_icons_color_".$blake_header_bgstyle_after).";}
	header.header_after_scroll.navbar .nav-container i:hover{color: #".esc_html(get_option("blake_header_after_scroll_icons_hover_color_".$blake_header_bgstyle_after)).";}";

	if (get_option("enable_custom_css") == "on"){
		$blake_customcss = get_option("blake_custom_css");
		if (gettype($blake_customcss) === "string" && $blake_customcss != "") {
			$blake_style_data .= stripslashes($blake_customcss);
		}
	}

	wp_add_inline_style('blake-style', $blake_style_data);
	
}
add_action( 'wp_enqueue_scripts', 'blake_custom_style', 2 );

?>