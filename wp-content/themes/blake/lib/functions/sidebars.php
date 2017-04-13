<?php
/**
 * This file contains the sidebars functionality.
 *
 */

/**
 * ADD THE ACTIONS
 */
add_action('widgets_init', 'blake_load_sidebar_names');
add_action('widgets_init', 'blake_register_all_sidebars' );

/**
 * Loads all the existing sidebars to be registered into the global
 * manager object.
 */
function blake_load_sidebar_names(){
	global $blake_data;
	
	//there always should be one default sidebar
	$blake_sidebars=array();

	//get the sidebar names that have been saved as option
	$sidebar_strings=get_option('_sidebar_names');
	$generated_sidebars=explode(BLAKE_SEPARATOR, $sidebar_strings);
	array_pop($generated_sidebars);
	$blake_generated_sidebars=array();

	//add the generated sidebars to the default ones
	foreach($generated_sidebars as $sidebar){
		$blake_sidebars[]=array('name'=>$sidebar, 'id'=>blake_convert_to_class($sidebar));
		$blake_generated_sidebars[]=array('name'=>$sidebar, 'id'=>blake_convert_to_class($sidebar));
	}

	//set the main sidebars to the global manager object
	$blake_data->blake_sidebars=$blake_sidebars;
	//set the footer sidebars to the global manager object
	
	$sides = blake_get_custom_sidebars();
	
	$blake_c_sidebars = array();
	
	foreach($sides as $s){
		$blake_c_sidebars[]=array('name'=>$s, 'id'=>blake_convert_to_class($s));
	}
	
	$blake_data->blake_custom_sidebars = $blake_c_sidebars;
	
	/*TOP PANEL SIDEBARS*/
	if(get_option("blake_toppanel_number_cols") == "one")
		$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel One Column', 'id'=>'toppanel-one-column'));
	if(get_option("blake_toppanel_number_cols") == "two")
		$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-two-column-left'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-two-column-right'));
	if(get_option("blake_toppanel_number_cols") == "three"){
		if(get_option("blake_toppanel_columns_order") == "one_three")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-three-column-left'), array('name'=>'Top Panel Center Column', 'id'=>'toppanel-three-column-center'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-three-column-right'));
		if(get_option("blake_toppanel_columns_order") == "one_two_three")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/3)', 'id'=>'toppanel-three-column-left-1_3'), array('name'=>'Top Panel Right Column (2/3)', 'id'=>'toppanel-three-column-right-2_3'));
		if(get_option("blake_toppanel_columns_order") == "two_one_three")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (2/3)', 'id'=>'toppanel-three-column-left-2_3'), array('name'=>'Top Panel Right Column (1/3)', 'id'=>'toppanel-three-column-right-1_3'));
	}
	if(get_option("blake_toppanel_number_cols") == "four"){
		if(get_option("blake_toppanel_columns_order_four") == "one_four")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-four-column-left'), array('name'=>'Top Panel Center-Left Column', 'id'=>'toppanel-four-column-center-left'), array('name'=>'Top Panel Center-Right Column', 'id'=>'toppanel-four-column-center-right'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-four-column-right'));
		if(get_option("blake_toppanel_columns_order_four") == "two_one_two_four")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/4)', 'id'=>'toppanel-four-column-left-1_2_4'), array('name'=>'Top Panel Center Column (2/4)', 'id'=>'toppanel-four-column-center-2_2_4'), array('name'=>'Top Panel Right Column (1/4)', 'id'=>'toppanel-four-column-right-1_2_4'));
		if(get_option("blake_toppanel_columns_order_four") == "three_one_four")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (3/4)', 'id'=>'toppanel-four-column-left-3_4'), array('name'=>'Top Panel Right Column (1/4)', 'id'=>'toppanel-four-column-right-1_4'));
		if(get_option("blake_toppanel_columns_order_four") == "one_three_four")
			$blake_data->blake_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/4)', 'id'=>'toppanel-four-column-left-1_4'), array('name'=>'Top Panel Right Column (3/4)', 'id'=>'toppanel-four-column-right-3_4'));
	}
	
	/* FOOTER SIDEBARS */
	if(get_option("blake_footer_number_cols") == "one")
		$blake_data->blake_footer_sidebars=array(array('name'=>'Footer One Column', 'id'=>'footer-one-column'));
	if(get_option("blake_footer_number_cols") == "two")
		$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-two-column-left'), array('name'=>'Footer Right Column', 'id'=>'footer-two-column-right'));
	if(get_option("blake_footer_number_cols") == "three"){
		if(get_option("blake_footer_columns_order") == "one_three")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-three-column-left'), array('name'=>'Footer Center Column', 'id'=>'footer-three-column-center'), array('name'=>'Footer Right Column', 'id'=>'footer-three-column-right'));
		if(get_option("blake_footer_columns_order") == "one_two_three")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column (1/3)', 'id'=>'footer-three-column-left-1_3'), array('name'=>'Footer Right Column (2/3)', 'id'=>'footer-three-column-right-2_3'));
		if(get_option("blake_footer_columns_order") == "two_one_three")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column (2/3)', 'id'=>'footer-three-column-left-2_3'), array('name'=>'Footer Right Column (1/3)', 'id'=>'footer-three-column-right-1_3'));
	}
	if(get_option("blake_footer_number_cols") == "four"){
		if(get_option("blake_footer_columns_order_four") == "one_four")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-four-column-left'), array('name'=>'Footer Center-Left Column', 'id'=>'footer-four-column-center-left'), array('name'=>'Footer Center-Right Column', 'id'=>'footer-four-column-center-right'), array('name'=>'Footer Right Column', 'id'=>'footer-four-column-right'));
		if(get_option("blake_footer_columns_order_four") == "two_one_two_four")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column (1/4)', 'id'=>'footer-four-column-left-1_2_4'), array('name'=>'Footer Center Column (2/4)', 'id'=>'footer-four-column-center-2_2_4'), array('name'=>'Footer Right Column (1/4)', 'id'=>'footer-four-column-right-1_2_4'));
		if(get_option("blake_footer_columns_order_four") == "three_one_four")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column (3/4)', 'id'=>'footer-four-column-left-3_4'), array('name'=>'Footer Right Column (1/4)', 'id'=>'footer-four-column-right-1_4'));
		if(get_option("blake_footer_columns_order_four") == "one_three_four")
			$blake_data->blake_footer_sidebars=array(array('name'=>'Footer Left Column (1/4)', 'id'=>'footer-four-column-left-1_4'), array('name'=>'Footer Right Column (3/4)', 'id'=>'footer-four-column-right-3_4'));
	}
	
}


/**
 * Registers all the sidebars that have been created.
 */
function blake_register_all_sidebars(){
	global $blake_data;

	$blake_sidebars=$blake_data->blake_sidebars;
	$blake_custom_sidebars=$blake_data->blake_custom_sidebars;
	if (isset($blake_data->blake_footer_sidebars))
		$blake_footer_sidebars=$blake_data->blake_footer_sidebars;
	else $blake_footer_sidebars = array();
	if (isset($blake_data->blake_toppanel_sidebars))
		$blake_toppanel_sidebars=$blake_data->blake_toppanel_sidebars;
	else $blake_toppanel_sidebars = array();
	
	//register all the sidebars
	if (function_exists('register_sidebar')){

		//register the sidebars
		foreach($blake_sidebars as $sidebar){
			blake_register_sidebar($sidebar['name'], $sidebar['id']);
		}
		
		if ( $blake_custom_sidebars && ! is_wp_error( $blake_custom_sidebars ) ) {
		//register the custom sidebars
			foreach($blake_custom_sidebars as $sidebar){
				blake_register_custom_sidebar($sidebar['name'], $sidebar['id']);
			}
		}

		if ( $blake_toppanel_sidebars && ! is_wp_error( $blake_toppanel_sidebars ) ) {
		//register the top panel column sidebars
			foreach($blake_toppanel_sidebars as $sidebar){
				blake_register_toppanel_sidebar($sidebar['name'], $sidebar['id']);
			}
		}

		if ( $blake_footer_sidebars && ! is_wp_error( $blake_footer_sidebars ) ) {
		//register the footer column sidebars
			foreach($blake_footer_sidebars as $sidebar){
				blake_register_footer_sidebar($sidebar['name'], $sidebar['id']);
			}
		}
	}
}



/**
 * Registers a sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function blake_register_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="sidebar-box %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4><div class="double-line"></div>',
	));
}

/**
 * Registers a custom column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function blake_register_custom_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="custom-widget %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Registers a top panel column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function blake_register_toppanel_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Registers a footer column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function blake_register_footer_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Prints a sidebar.
 * @param $name the name of the sidebar to print
 */
function blake_print_sidebar($name){
	if ( function_exists('dynamic_sidebar')) { 
		$html = dynamic_sidebar($name);
		blake_content_shortcoder($html);
		do_shortcode($html);
	}
}

/**
 * Converts a name that consists of more words and different characters to a class (id).
 * @param $name the name to convert
 */
function blake_convert_to_class($name){
	return strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
}

function blake_get_import_fonts(){
	global $blake_import_fonts;
	return $blake_import_fonts;
}

function blake_set_import_fonts($in){
	global $blake_import_fonts;
	$aux = $aux2 = array();
	if (is_string($in)){
		$in = str_replace("+", " ", $in);
		$aux = explode("|", $in);
		foreach ($aux as $a){
			$aux2[] = str_replace(":", "|", $a);
		}
	} else {
		$aux2 = $in;
	}
	if (is_string($blake_import_fonts)){
		$blake_import_fonts = explode("|", $blake_import_fonts);
	}
	$blake_import_fonts = array_merge($aux2, $blake_import_fonts);
}