<?php
	
	$blake_general_options= array( array(
		"name" => "Custom CSS",
		"type" => "title",
		"img" => BLAKE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"customcss", "name"=>"Custom CSS"))
	),
	
	
	
	/* ------------------------------------------------------------------------*
	 * CUSTOM CSS
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'customcss'
	),
	
	array(
		"type" => "documentation",
		"text" => "<p>You can use this textarea to add your custom CSS. This will be loaded last so it will override the other CSS from the theme. Tags will be striped.</p>"
	),
	
	array(
		"name" => "Apply Custom CSS",
		"id" => "enable_custom_css",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"id" => "blake_custom_css",
		"type" => "textarea",
		"params" => "blake_rich_editor"
	),
			
	array(
		"type" => "close"
	));
	
	blake_add_options($blake_general_options);
	
?>