<?php
	
	$blake_fonts_array = blake_fonts_array_builder();
	
	$blake_style_general_options= array( array(
		"name" => "Typography",
		"type" => "title",
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"text", "name"=>"Typography"))
	),
	
	/* ------------------------------------------------------------------------*
	 * TYPOGRAPHY
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'text'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Links</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_links_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_links_size",
		"type" => "slider",
		"std" => "15px",
		"desc" => "Choose the size of your &lt;a&gt; tag."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_links_color",
		"type" => "color",
		"desc" => 'Select a custom color for your &lt;a&gt; tag.',
		"std" => "777777"
	),
	
	array(
		"name" => "Color (hover)",
		"id" => "blake_links_color_hover",
		"type" => "color",
		"desc" => 'Select a custom color for your &lt;a&gt; tag hover state.',
		"std" => "50CCB3"
	),
	
	array(
		"name" => "Background Color (hover)",
		"id" => "blake_links_bg_color_hover",
		"type" => "color",
		"desc" => 'Select a custom color for the background of your &lt;a&gt; tag hover state.'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Paragraphs</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_p_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_p_size",
		"type" => "slider",
		"std" => "15px",
		"desc" => "Choose the size of your &lt;p&gt; tag."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_p_color",
		"type" => "color",
		"desc" => 'Select a custom color for your &lt;p&gt; tag.',
		"std" => "777777"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H1 Tag</h3>"
	),
	
	
	array(
		"name" => "Font",
		"id" => "blake_h1_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h1_size",
		"type" => "slider",
		"std" => "36px",
		"desc" => "Choose the size of your H1 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h1_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H1 tag.',
		"std"=> "303030"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H2 Tag</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_h2_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h2_size",
		"type" => "slider",
		"std" => "32px",
		"desc" => "Choose the size of your H2 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h2_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H2 tag.',
		"std" => "303030"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H3 Tag</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_h3_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h3_size",
		"type" => "slider",
		"std" => "25px",
		"desc" => "Choose the size of your H3 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h3_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H3 tag.',
		"std" => "303030"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H4 Tag</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_h4_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h4_size",
		"type" => "slider",
		"std" => "22px",
		"desc" => "Choose the size of your H4 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h4_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H4 tag.',
		"std"=> "303030"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H5 Tag</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_h5_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h5_size",
		"type" => "slider",
		"std" => "18px",
		"desc" => "Choose the size of your H5 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h5_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H5 tag.',
		"std" => "303030"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>H6 Tag</h3>"
	),
	
	array(
		"name" => "Font",
		"id" => "blake_h6_font",
		"type" => "select",
		"options" => $blake_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => 'Helvetica Neue'
	),
	
	array(
		"name" => "Size",
		"id" => "blake_h6_size",
		"type" => "slider",
		"std" => "16px",
		"desc" => "Choose the size of your H6 tag (pixels)."
	),
	
	array(
		"name" => "Color",
		"id" => "blake_h6_color",
		"type" => "color",
		"desc" => 'Select a custom color for your H6 tag.',
		"std" => "8c8c8c"
	),
	
	array(
		"type" => "close"
	),
	
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	blake_add_style_options($blake_style_general_options);
	
?>