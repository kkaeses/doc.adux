<?php

$sides = get_option('blake_sidebar_name_names');
if (is_string($sides)) $sides = explode(BLAKE_SEPARATOR, $sides);
$outputsidebars = array(array("id"=>"defaultblogsidebar", "name" => "Blog Sidebar"));
if (!empty($sides)){
	foreach ($sides as $s){
		if ($s != ""){
			array_push($outputsidebars, array("id"=>$s, "name"=>$s));
		}
	}	
}

$blake_info_options= array( array(
"name" => "Header Layout",
"type" => "title",
"img" => BLAKE_IMAGES_URL."icon_home.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"header_layout", "name"=>"Header"), array("id"=>"logotype", "name" =>"Logotype"), array("id"=>"top_panel", "name"=>"Top Bar"), array("id"=>"search", "name"=>"Search"))
),

array(
"type" => "subtitle",
"id"=>'header_layout'
),

array(
	'type' => 'goto',
	'name' => 'header',
	'desc' => 'Style this Element'
),

array(
	"type" => "documentation",
	"text" => '<h3>Header Style</h3>'
),

array(
	"name" => "Header Style",
	"id" => "blake_header_style_light_dark",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light"), array("id"=>"dark","name"=>"Dark")),
	"desc" => "If you choose the <strong>Light Style</strong> the theme will apply the <strong>Dark</strong> logo and menu settings.<br/> If you choose the <strong>Dark Style</strong> the theme will apply the <strong>Light</strong> logo and menu settings. ",
	"std" => "light"
),


array(
"type" => "documentation",
"text" => '<h3>Fixed Header</h3>'
),

array(
"name" => "Fixed Header?",
"id" => "blake_fixed_menu",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> the header will be always visible, not only at the top of the page."
),

array(
"name" => "Hide on Start?",
"id" => "blake_header_hide_on_start",
"type" => "checkbox",
"std" => "off",
"desc" => "If set to <strong>ON</strong> the header will appear from the top of the page after scrolling."
),

array(
	"name" => "Page Content (on multipage templates)",
	"id" => "blake_content_to_the_top",
	"type" => "select",
	"options" => array(array("id"=>"off","name"=>"Content starts after the header"), array("id"=>"on","name"=>"Content behind the header")),
	"std" => "on"
),

array(
"type" => "documentation",
"text" => '<h3>Header After Scroll</h3>'
),

array(
"name" => "Header After Scroll?",
"id" => "blake_header_after_scroll",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> you will have options to style a second header to display different from the one appearing in the top of the page."
),

array(
	"name" => "Header After Scroll Style",
	"id" => "blake_header_after_scroll_style_light_dark",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light"), array("id"=>"dark","name"=>"Dark")),
	"desc" => "If you choose the <strong>Light Style</strong> the theme will apply the <strong>Dark</strong> logo and menu settings.<br/> If you choose the <strong>Dark Style</strong> the theme will apply the <strong>Light</strong> logo and menu settings. ",
	"std" => "light"
),

array(
"type" => "documentation",
"text" => '<h3>Header Shrink Effect</h3>'
),

array(
"name" => "Header Shrink Effect?",
"id" => "blake_header_shrink_effect",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> you will be able to change the sizes of the contents (header included)."
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Woocommerce Cart</h3>"
),

array(
	"name" => "Woocommerce Cart",
	"id" => "blake_woocommerce_cart",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the Woocommerce Cart."
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Social Icons</h3>"
),

array(
	"name" => "Social Icons",
	"id" => "blake_social_icons_menu",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the social icons."
),

array(
"type" => "documentation",
"text" => '<h3>Header Layout</h3>'
),

array(
	"type" => "documentation",
	"text" => '<p><b>Note:</b> After choose the header style, go to the next tab <b>Top Bar</b> and add your contents.</p>'
),

array(
	"name" => "Header Style Type",
	"id" => "blake_header_style_type",
	"type" => "select",
	"options" => array(array('id'=>'style1', 'name'=>'Style 1'), array('id'=>'style2','name'=>'Style 2'), array('id'=>'style3','name'=>'Style 3'), array('id'=>'style4','name'=>'Style 4')),
	"std" => 'style1'
),

array(
	"type" => "close"
),

/* logotype new place */
array(
"type" => "subtitle",
"id"=>'logotype'
),

array(
	'type' => 'goto',
	'name' => 'logotype',
	'desc' => 'Style this Element'
),

array(
	"type" => "documentation",
	"text" => "<h3>Logo</h3>"
),

array(
	"name" => "Logo <strong>Light</strong> URL",
	"id" => "blake_logo_image_url_light",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://upperinc.com/previews/wp/blake/wp-content/uploads/2016/05/logo-light.png"
),

array(
	"name" => "Logo <strong>Light</strong> Retina URL",
	"id" => "blake_logo_retina_image_url_light",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://upperinc.com/previews/wp/blake/wp-content/uploads/2016/05/logo-light@2x.png"
),

array(
	"name" => "Logo <strong>Dark</strong> URL",
	"id" => "blake_logo_image_url_dark",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://upperinc.com/previews/wp/blake/wp-content/uploads/2016/05/logo.png"
),

array(
	"name" => "Logo <strong>Dark</strong> Retina URL",
	"id" => "blake_logo_retina_image_url_dark",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://upperinc.com/previews/wp/blake/wp-content/uploads/2016/05/logo@2x.png"
),

array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * Top Contents
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'top_panel'
),

	array(
		"type" => "documentation",
		"text" => "<h3>Top Bar Contents</h3>"
	),
	
	array(
		"name" => "Enable Top Info Bar",
		"id" => "blake_info_above_menu",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays an above menu information container."
	),
	
	array(
		"name" => "WPML Widget",
		"id" => "blake_wpml_menu_widget",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays the WPML widget if available."
	),
	
	array(
		"name" => "Display Top Bar Menu",
		"id" => "blake_top_bar_menu",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays the Top Bar Menu. You need to assign a Menu to the Top Bar Location in <strong>Appearance > Menus</strong>."
	),
	
	array(
		"name" => "Telephone",
		"id" => "blake_telephone_menu",
		"type" => "text",
		"desc" => "Insert number to display above the menu. <br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Email",
		"id" => "blake_email_menu",
		"type" => "text",
		"desc" => "Insert email to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Address",
		"id" => "blake_address_menu",
		"type" => "text",
		"desc" => "Insert address to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Text Field",
		"id" => "blake_text_field_menu",
		"type" => "text",
		"desc" => "Insert a custom text line.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Enable Social Icons",
		"id" => "blake_enable_socials",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"type" => "close"
	),
	
	array(
		"type" => "subtitle",
		"id"=>'search'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Options</h3>"
	),
	
	array(
		"name" => "Enable Search",
		"id" => "blake_enable_search",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Enable Ajax Search",
		"id" => "blake_enable_ajax_search",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "If enabled, displays search results on typing."
	),
	
	array(
		"name" => "Search all contents ?",
		"id" => "blake_enable_search_everything",
		"type" => "checkbox",
		"std" => 'on',
		"desc" => "If enabled the search will go through not only posts and pages, but all of the website's content."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Page Results</h3>"
	),
	
	array(
		"name" => "Secondary Title",
		"id" => "blake_search_secondary_title",
		"type" => "text",
		"desc" => "If set, will display this as a secondary title."
	),
	
	array(
		"name" => "Sidebar ?",
		"id" => "blake_search_archive_sidebar",
		"type" => "select",
		"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"left", "name"=>"Left"), array("id"=>"right", "name"=>"Right")),
		"std"=>"right"
	),
	
	array(
		"name" => "Choose your Sidebar",
		"id" => "blake_search_sidebars_available",
		"type" => "select",
		"options" => $outputsidebars
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Results Ajax Details</h3>"
	),
	
	array(
		"name" => "Show Author ?",
		"id" => "blake_search_show_author",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Show Date ?",
		"id" => "blake_search_show_date",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Show Tags ?",
		"id" => "blake_search_show_tags",
		"type" => "checkbox",
		"std" => 'off'
	),
	
	array(
		"name" => "Show Categories ?",
		"id" => "blake_search_show_categories",
		"type" => "checkbox",
		"std" => 'off'
	),

	array(
		"type" => "close"
	),	
	
	
	array(
	"type" => "close"));

blake_add_options($blake_info_options);