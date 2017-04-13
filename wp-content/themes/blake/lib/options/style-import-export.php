<?php
	
	$blake_style_general_options= array( array(
		"name" => "Import / Export Options",
		"type" => "title",
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"impexp", "name"=>"Import / Export"))
	),
	
	/* IMPORT EXPORT OPTIONS NEW STUFF */

	array(
		"type" => "subtitle",
		"id" => "impexp"
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Export Options</h3>"
	),
	
	array(
		"name" => "Export Options",
		"id" => "blake_export_style_options",
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
		"id" => "blake_import_style_options",
		"type" => "upload",
		"desc" => "Load Panel Options from a previously created file."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Reset Options</h3>"
	),
	
	array(
		"name" => "Restore Options",
		"id" => "blake_reset_style_options",
		"type" => "custom",
		"button_text" => 'Reset Panel Options',
		"desc" => "Restore all the Panel Options to their original value.",
	    "fields" => array()
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