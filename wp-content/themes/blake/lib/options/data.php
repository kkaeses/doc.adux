<?php
	
	$blake_general_options= array( array(
		"name" => "Import / Export Options",
		"type" => "title",
		"img" => BLAKE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"impexp", "name"=>"Import / Export Options"))
	),
	
	
	
	/* ------------------------------------------------------------------------*
	 * Top Panel
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'impexp'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Export Options</h3>"
	),
	
	array(
		"name" => "Export Options",
		"id" => "blake_export_options",
		"type" => "custom",
		"button_text" => 'Save Options as...',
		"desc" => "Creates a File containing all your current Panel Options.",
	    "fields" => array()
	),

	array(
		"type" => "documentation",
		"text" => "<h3>Import Options</h3>"
	),
	
	array(
		"name" => "Import Options",
		"id" => "blake_import_options",
		"type" => "upload",
		"desc" => "Load Panel Options from a previously created file."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Reset Options</h3>"
	),
	
	array(
		"name" => "Restore Options",
		"id" => "blake_reset_options",
		"type" => "custom",
		"button_text" => 'Reset Panel Options',
		"desc" => "Restore all the Panel Options to their original value.",
	    "fields" => array()
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