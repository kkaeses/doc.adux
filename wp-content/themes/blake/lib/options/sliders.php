<?php
	
	$blake_general_options= array( array(
		"name" => "Sliders Settings",
		"type" => "title",
		"img" => BLAKE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"flex", "name"=>"Flex Slider"), array("id"=>"rev","name" => "Revolution Slider"))
	),
	
		
	/* ------------------------------------------------------------------------*
	 * Flex Slider
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'flex'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>POSTS - Flex Slider Settings</h3>"
	),

	array(
		"name" => "Show Direction Controls",
		"id" => "blake_posts_flex_navigation",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),

	array(
		"name" => "Show Controls",
		"id" => "blake_posts_flex_controls",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Transition Effect",
		"id" => "blake_posts_flex_transition",
		"type" => "select",
		"options" => array(array("name"=>"Slide", "id"=>"slide"), array("name"=>"Fade", "id"=>"fade")),
		"std" => "random",
		"description" => ""
	),
	
	array(
		"name" => "Transition Duration",
		"id" => "blake_posts_flex_transition_duration",
		"type" => "text",
		"std" => 500,
		"description" => "The duration of the transition between slides."
	),
	
	array(
		"name" => "Slide Duration",
		"id" => "blake_posts_flex_slide_duration",
		"type" => "text",
		"std" => 5500,
		"description" => "The duration of each slide"
	),
	
	array(
		"name" => "Autoplay",
		"id" => "blake_posts_flex_autoplay",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Pause on Hover",
		"id" => "blake_posts_flex_pause_hover",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => "Play/Pause on mouse out/over"
	),
	
	array(
		"name" => "Slider Height",
		"id" => "blake_posts_flex_height",
		"type" => "text",
		"std" => "400px",
		"description" => "The height of the slider."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>PROJECTS - Flex Slider Settings</h3>"
	),

	array(
		"name" => "Show Direction Controls",
		"id" => "blake_projs_flex_navigation",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),

	array(
		"name" => "Show Controls",
		"id" => "blake_projs_flex_controls",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Transition Effect",
		"id" => "blake_projs_flex_transition",
		"type" => "select",
		"options" => array(array("name"=>"Slide", "id"=>"slide"), array("name"=>"Fade", "id"=>"fade")),
		"std" => "random",
		"description" => ""
	),
	
	array(
		"name" => "Transition Duration",
		"id" => "blake_projs_flex_transition_duration",
		"type" => "text",
		"std" => 500,
		"description" => "The duration of the transition between slides."
	),
	
	array(
		"name" => "Slide Duration",
		"id" => "blake_projs_flex_slide_duration",
		"type" => "text",
		"std" => 5500,
		"description" => "The duration of each slide"
	),
	
	array(
		"name" => "Autoplay",
		"id" => "blake_projs_flex_autoplay",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Pause on Hover",
		"id" => "blake_projs_flex_pause_hover",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => "Play/Pause on mouse out/over"
	),
	
	array(
		"name" => "Slider Height",
		"id" => "blake_projs_flex_height",
		"type" => "text",
		"std" => "400px",
		"description" => "The height of the slider."
	),
	
	array(
		"type" => "close"
	),
	
	/* ------------------------------------------------------------------------*
	 * Revolution Slider
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'rev'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Revolution Slider Settings</h3>"
	),

	
	array(
		"type" => "documentation",
		"text" => "<p>You can adjust the settings indivually for each created Revolution Slider in the <a href='admin.php?page=revslider'>Revolution Slider menu page</a>.</p>"
	),	
	/*close array*/
	
	array(
		"type" => "close"
	),
	
	array(
		"type" => "close"
	));
	
	blake_add_options($blake_general_options);
	
?>