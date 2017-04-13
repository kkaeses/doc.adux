<?php
	
	$blake_fonts_array = blake_fonts_array_builder();
	
	$blake_style_general_options= array( array(
		"name" => "Menus",
		"type" => "title",
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"light-top-menu", "name"=>"Top Menu Items Light"), array("id"=>"dark-top-menu", "name"=>"Top Menu Items Dark"), array("id"=>"sub-items", "name"=>"Sub Menu Items"))
	),
	
	/* ------------------------------------------------------------------------*
	 * MENU OPTIONS
	 * ------------------------------------------------------------------------*/
	
	
	
	array(
		"type" => "subtitle",
		"id"=>'light-top-menu'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Top Menu Items Light</h3>'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>PRE-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "blake_menu_font_pre_light",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_menu_color_pre_light",
		"type" => "color",
		"std" => "ebebeb"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "blake_menu_color_hover_pre_light",
		"type" => "color",
		"std" => "ffffff"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_menu_font_size_pre_light",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_menu_uppercase_pre_light",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_menu_letter_spacing_pre_light",
		"type" => "text",
		"std" => "0px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "blake_menu_add_border_pre_light",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "blake_menu_border_color_pre_light",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "blake_menu_side_margin_pre_light",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "blake_menu_margin_top_pre_light",
		"type" => "text",
		"std" => "25px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "blake_menu_padding_bottom_pre_light",
		"type" => "text",
		"std" => "25px"
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>AFTER-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "blake_menu_font_after_light",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_menu_color_after_light",
		"type" => "color",
		"std" => "ebebeb"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "blake_menu_color_hover_after_light",
		"type" => "color",
		"std" => "ffffff"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_menu_font_size_after_light",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_menu_uppercase_after_light",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_menu_letter_spacing_after_light",
		"type" => "text",
		"std" => "0px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "blake_menu_add_border_after_light",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "blake_menu_border_color_after_light",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "blake_menu_side_margin_after_light",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "blake_menu_margin_top_after_light",
		"type" => "text",
		"std" => "20px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "blake_menu_padding_bottom_after_light",
		"type" => "text",
		"std" => "18px"
	),

	array("type"=>"close"),
	
	array(
		"type" => "subtitle",
		"id"=>'dark-top-menu'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Top Menu Items Dark</h3>'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>PRE-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "blake_menu_font_pre_dark",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_menu_color_pre_dark",
		"type" => "color",
		"std" => "585858"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "blake_menu_color_hover_pre_dark",
		"type" => "color",
		"std" => "333333"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_menu_font_size_pre_dark",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_menu_uppercase_pre_dark",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_menu_letter_spacing_pre_dark",
		"type" => "text",
		"std" => "0px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "blake_menu_add_border_pre_dark",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "blake_menu_border_color_pre_dark",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "blake_menu_side_margin_pre_dark",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "blake_menu_margin_top_pre_dark",
		"type" => "text",
		"std" => "25px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "blake_menu_padding_bottom_pre_dark",
		"type" => "text",
		"std" => "20px"
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>AFTER-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "blake_menu_font_after_dark",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_menu_color_after_dark",
		"type" => "color",
		"std" => "a1a1a1"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "blake_menu_color_hover_after_dark",
		"type" => "color",
		"std" => "333333"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_menu_font_size_after_dark",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_menu_uppercase_after_dark",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_menu_letter_spacing_after_dark",
		"type" => "text",
		"std" => "0px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "blake_menu_add_border_after_dark",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "blake_menu_border_color_after_dark",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "blake_menu_side_margin_after_dark",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "blake_menu_margin_top_after_dark",
		"type" => "text",
		"std" => "20px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "blake_menu_padding_bottom_after_dark",
		"type" => "text",
		"std" => "18px"
	),
	
	array("type"=>"close"),
	
	array(
		"type" => "subtitle",
		"id"=>'sub-items'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Sub Menu Items</h3>'
	),
		
	array(
		"name" => "Font",
		"id" => "blake_sub_menu_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_sub_menu_color",
		"type" => "color",
		"std" => "949494"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "blake_sub_menu_color_hover",
		"type" => "color",
		"std" => "f5f5f5"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_sub_menu_font_size",
		"type" => "slider",
		"std" => "13px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_sub_menu_uppercase",
		"type" => "checkbox",
		"std" => "off"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_sub_menu_letter_spacing",
		"type" => "text",
		"std" => "0px"
	),
	
	
	array(
		"name" => "Background Color",
		"id" => "blake_sub_menu_bg_color",
		"type" => "color",
		"std" => "1f1f1f"
	),
	
	array(
		"name" => "Background Opacity",
		"id" => "blake_sub_menu_bg_opacity",
		"type" => "opacity_slider",
		"std" => "100"
	),
	
	array(
		"name" => "Background Color Hover",
		"id" => "blake_sub_menu_bg_color_hover",
		"type" => "color",
		"std" => "1f1f1f"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "blake_sub_menu_border_color",
		"type" => "color",
		"std" => "242424"
	),
	
	
	array(
		"type" => "documentation",
		"text" => '<h3>Just Label (Without Link)</h3>'
	),
	
	array(
		"name" => "Font",
		"id" => "blake_label_menu_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "blake_label_menu_color",
		"type" => "color",
		"std" => "f2f2f2"
	),
	
	array(
		"name" => "Font Size",
		"id" => "blake_label_menu_font_size",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "blake_label_menu_uppercase",
		"type" => "checkbox",
		"std" => "off"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "blake_label_menu_letter_spacing",
		"type" => "text",
		"std" => "0px"
	),
	
	array("type"=>"close"),

	/*close array*/
	
	array(
		"type" => "close"
	));
	
	blake_add_style_options($blake_style_general_options);
	
?>