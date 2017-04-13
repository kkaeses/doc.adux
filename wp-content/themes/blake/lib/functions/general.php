<?php
/**
 * This file contain some general functions:
 * -enqueuing CSS and JS files
 * -inserting the JavaScript init code into the head
 * -set the default thumbnail size
 * -print pagination function
 * -register navigation menus function
 *
 */


/**
 * ADD THE ACTIONS
 */
add_action('admin_enqueue_scripts', 'blake_admin_init');
add_action('admin_head', 'blake_admin_head_add');
add_action('init', 'blake_menus' );
add_action('admin_menu', 'blake_add_theme_menu');
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

add_theme_support('menus');
add_theme_support('automatic-feed-links');


/**
 * Enqueues the JavaScript files needed depending on the current section.
 */
function blake_admin_init(){
	global $current_screen, $blake_data;
	
	wp_enqueue_media();
	wp_enqueue_script( 'gallery' );
	
	if($current_screen->base=='post'){
		//enqueue the script and CSS files for the TinyMCE editor formatting buttons
		wp_enqueue_script('jquery-ui-dialog', array('jquery'));
		wp_enqueue_script('blake-page-options',BLAKE_SCRIPT_URL.'page-options.js', array('jquery'));
		wp_enqueue_script('blake-colorpicker',BLAKE_SCRIPT_URL.'colorpicker.js', array('jquery'));

		//set the style files
		add_editor_style('lib/formatting-buttons/custom-editor-style.css');
		wp_enqueue_style('blake-page-style',BLAKE_CSS_URL.'page_style.css');
		wp_enqueue_style('blake-colorpicker-style',BLAKE_CSS_URL.'colorpicker.css');
		wp_enqueue_script('blake-ajaxupload',BLAKE_SCRIPT_URL.'ajaxupload.js', array('jquery'));
		wp_enqueue_script('blake-options',BLAKE_SCRIPT_URL.'options.js', array('jquery'));
		wp_enqueue_script('blake-options-des',BLAKE_SCRIPT_URL.'options_upper.js', array('jquery'));
	}

	if(isset($_GET['page']) && ( $_GET['page']==BLAKE_OPTIONS_PAGE || $_GET['page']==BLAKE_STYLE_OPTIONS_PAGE || $_GET['page']==BLAKE_DEMOS_PAGE)){
		//enqueue the scripts for the Options page
		wp_enqueue_script('jquery-ui-core', array('jquery'));
		wp_enqueue_script('jquery-ui-sortable', array('jquery'));
		wp_enqueue_script('jquery-ui-dialog', array('jquery'));
		wp_enqueue_script('blake-jquery-co',BLAKE_SCRIPT_URL.'jquery-co.js', array('jquery'));
		wp_enqueue_script('blake-ajaxupload',BLAKE_SCRIPT_URL.'ajaxupload.js', array('jquery'));
		wp_enqueue_script('blake-colorpicker',BLAKE_SCRIPT_URL.'colorpicker.js', array('jquery'));
		wp_enqueue_script('blake-options',BLAKE_SCRIPT_URL.'options.js', array('jquery'));
		wp_enqueue_script('blake-options-des',BLAKE_SCRIPT_URL.'options_upper.js', array('jquery'));
		wp_enqueue_script('blake-jquery-ui',BLAKE_SCRIPT_URL.'jquery-ui-1.8.17.custom.min.js', array('jquery'));

		//enqueue the styles for the Options page
		wp_enqueue_style('blake-admin-style',BLAKE_CSS_URL.'admin_style.css');
		wp_enqueue_style('blake-colorpicker-style',BLAKE_CSS_URL.'colorpicker.css');
		wp_enqueue_style('blake-jqueryui-style',BLAKE_CSS_URL.'cupertino/jquery-ui-1.8.17.custom.css');
		
		echo "<div class='blake_fixed_menu hidden'>".esc_html(get_option('blake_fixed_menu'))."</div>";
		echo "<div class='blake_header_after_scroll hidden'>".esc_html(get_option('blake_header_after_scroll'))."</div>";
		echo "<div class='blake_header_shrink_effect hidden'>".esc_html(get_option('blake_header_shrink_effect'))."</div>";

		if (get_option("blake_show_sec_footer") == "on"){
			if (get_option("blake_footer_display_logo") == "on"){
				echo "<div class='blake_footer_logo_type hidden'>".esc_html(get_option('blake_footer_logo_type'))."</div>";	
			}
			if (get_option("blake_footer_display_social_icons") == "on"){
				echo "<div class='blake_footer_display_social_icons hidden'>".get_option('blake_footer_display_social_icons')."</div>";	
			}
		}
	}

	if(defined('BLAKE_PORTFOLIO_POST_TYPE') && $current_screen->id==BLAKE_PORTFOLIO_POST_TYPE){
		//enqueue the scripts needed for the add/edit portfolio post
		wp_enqueue_script('blake-ajaxupload',BLAKE_SCRIPT_URL.'ajaxupload.js', array('jquery'));
		wp_enqueue_script('blake-options',BLAKE_SCRIPT_URL.'options.js', array('jquery'));
		wp_enqueue_media();
		wp_enqueue_script( 'custom-header' );
	}

	if($current_screen->id=='page'){
		//enqueue the scripts needed for the add/edit page page
		wp_enqueue_script('blake-options',BLAKE_SCRIPT_URL.'page-options.js', array('jquery'));
		wp_enqueue_script('blake-options2',BLAKE_SCRIPT_URL.'options.js', array('jquery'));
		wp_enqueue_script('blake-ajaxupload',BLAKE_SCRIPT_URL.'ajaxupload.js', array('jquery'));
	}

	if(isset($_GET['page']) && defined('BLAKE_PORTFOLIO_POST_TYPE') && $_GET['page']==BLAKE_PORTFOLIO_POST_TYPE){
		wp_enqueue_script('jquery-ui-core', array('jquery'));
		wp_enqueue_script('jquery-ui-widget', array('jquery'));
		wp_enqueue_script('jquery-ui-sortable', array('jquery'));
		wp_enqueue_script('jquery-ui-dialog', array('jquery'));
		wp_enqueue_script('blake-ajaxupload',BLAKE_SCRIPT_URL.'ajaxupload.js', array('jquery'));
		wp_enqueue_script('blake-options',BLAKE_SCRIPT_URL.'options.js', array('jquery'));
		wp_enqueue_script('blake-custom-page',BLAKE_SCRIPT_URL.'custom-page.js', array('jquery'));
		//enqueue the styles for the Options page
		wp_enqueue_style('blake-admin-style',BLAKE_CSS_URL.'custom_page.css');
		wp_enqueue_style('jquery-ui-dialog');
	}

}

global $pagenow;
if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php" ) {
    //Do redirect
    header( 'Location: '.esc_url(admin_url()).'admin.php?page='.BLAKE_DEMOS_PAGE.'&activated=true' ) ;
}


/**
 * Inserts scripts for initializing the JavaScript functionality for the relevant section.
 */
function blake_admin_head_add(){

	if(isset($_GET['page']) && $_GET['page']==BLAKE_OPTIONS_PAGE){
		//init the options js functionality
		$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
		$blake_admin_inline_script .= '
			jQuery(document).ready(function(){
				jQuery(".slider").each(function(){
					var value = parseInt(jQuery(this).siblings(".slider-input").val());
					jQuery(this).empty().slider({
						range: "min",
						value: value,
						min: 0,
						max: 100,
						slide: function( event, ui ) {
							jQuery( "#"+jQuery(this).attr("title") ).val( ui.value + " px" );
						}
					});
				});
				blakeOptions.init({cookie:true});
			});
		';
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
	}
	
	if(isset($_GET['page']) && $_GET['page']==BLAKE_STYLE_OPTIONS_PAGE){
		//init the options js functionality
		
		$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
		$blake_admin_inline_script .= '
			jQuery(document).ready(function(){
				jQuery(".slider").each(function(){
					var value = parseInt(jQuery(this).siblings(".slider-input").val());
					jQuery(this).empty().slider({
						range: "min",
						value: value,
						min: 0,
						max: 100,
						slide: function( event, ui ) {
							if (jQuery(this).hasClass("opacity-slider")){
								jQuery( "#"+jQuery(this).attr("title") ).val( ui.value + "%" );
							} else {
								jQuery( "#"+jQuery(this).attr("title") ).val( ui.value + " px" );	
							}
						}
					});
				});
				blake_StyleOptionsManager.init({cookie:true});
			});
		';
		if (isset($_GET['dgtt'])){
			$blake_admin_inline_script .= '
				jQuery(window).load(function(){
					jQuery("a[href=\'#tab_navigation-1-'.esc_js(esc_html($_GET['dgtt'])).'\']").click();
				});
			';
		}
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
	}
}

/**
 * Add the main setting menu for the theme.
 */
function blake_add_theme_menu(){
	add_theme_page( "Blake", "Blake"." Options", 'delete_pages', BLAKE_OPTIONS_PAGE, 'blake_theme_admin', BLAKE_LIB_URL.'/images/upper.png');
	add_theme_page( "Blake", "Blake"." Style Options", 'delete_pages', BLAKE_STYLE_OPTIONS_PAGE, 'blake_theme_style_options_admin', BLAKE_LIB_URL.'/images/upper.png');
	add_theme_page( "Blake", "Blake"." Demos", 'delete_pages', BLAKE_DEMOS_PAGE, 'blake_theme_demos_admin', BLAKE_LIB_URL.'/images/upper.png');
}

/* ------------------------------------------------------------------------*
 * LOCALE AND TRANSLATION
 * ------------------------------------------------------------------------*/

load_theme_textdomain( 'blake', get_template_directory() . '/lang' );

/**
 * Returns a text depending on the settings set. By default the theme gets uses
 * the texts set in the Translation section of the Options page. If multiple languages enabled,
 * the default language texts are used from the Translation section and the additional language
 * texts are used from the added .mo files within the lang folder.
 * @param $textid the ID of the text
 */
function blake_text($textid){

	$locale=get_locale();
	$int_enabled=get_option("blake_enable_translation")=='on'?true:false;
	$default_locale=get_option("blake_def_locale");

	if($int_enabled && $locale!=$default_locale){
		//use translation - extract the text from a defined .mo file
		return $textid;
	}else{
		//use the default text settings
		return stripslashes(get_option("blake".$textid));
	}
}


/* ------------------------------------------------------------------------*
 * SET THE THUMBNAILS
 * ------------------------------------------------------------------------*/


if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('post_box_img', 550, 250, true);
	add_image_size('static-header-img', 950, 350, true);
}


/**
 * Prints the pagination. Checks whether the WP-Pagenavi plugin is installed and if so, calls
 * the function for pagination of this plugin. If not- shows prints the previous and next post links.
 */
function print_pagination(){
	if(function_exists('blake_wp_pagenavi')){
	 blake_wp_pagenavi();
	}else{?>
<div id="blog_nav_buttons" class="navigation">
<div class="alignleft"><?php if (!function_exists('icl_object_id')) previous_posts_link('<span>&laquo;</span> '.blake_text('_previous_text')); else previous_posts_link('<span>&laquo;</span> '.esc_html__('Older Entries','blake')); ?></div>
<div class="alignright"><?php if (!function_exists('icl_object_id')) next_posts_link(blake_text('_next_text').' <span>&raquo;</span>'); else next_posts_link(esc_html__('Newer Entries','blake').' <span>&raquo;</span>'); ?></div>
</div>
	<?php
	}
}


/**
 * Register the main menu for the theme.
 */
function blake_menus() {
	register_nav_menu('PrimaryNavigation', 'Main Navigation');
	register_nav_menu('woonav', 'WooCommerce Menu');
	register_nav_menu('topbarnav', 'Top Bar Navigation');
}

function special_nav_class($classes, $item){
    $classes[] = $item->object . "-" . $item->object_id;
    return $classes;
}

/**
 * Removes an item from an array by specifying its value
 * @param $array the array from witch to remove the item
 * @param $val the value to be removed
 * @return returns the initial array without the removed item
 */
function blake_remove_item_by_value($array, $val = '') {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;

	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}

	return array_values($array);
}

