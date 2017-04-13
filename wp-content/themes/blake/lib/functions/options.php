<?php
/* ------------------------------------------------------------------------*
 * This file contains the main theme options functionality.
 * ------------------------------------------------------------------------*/

/**
 * ADD THE ACTIONS
 */
if ( isset($_GET['page']) && $_GET['page'] == BLAKE_OPTIONS_PAGE ){
	//options actions
	add_action('init', 'blake_init_options_functionality');  
	add_action('init', 'blake_set_options'); 
}

if ( isset($_GET['page']) && $_GET['page'] == BLAKE_STYLE_OPTIONS_PAGE ){
	//options actions
	add_action('init', 'blake_init_style_options_functionality');  
	add_action('init', 'blake_set_style_options'); 
}


/**
 * Inits the options functionality. Loads the files that contain the options arrays
 * to populate the global options array.
 */
/*
function blake_init_style_options_functionality(){
	global $blake_style_options;

	$blake_style_options=array();

	//get all the categories
	$categories=get_categories('hide_empty=0');
	$blake_categories=array();
	for($i=0; $i<sizeof($categories); $i++){
		$blake_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}

	//load the files that contain the options
	$blake_options_files=array('styles');
	foreach($blake_options_files as $file){
		require_once(BLAKE_OPTIONS_PATH.$file.'.php');
	}
}
*/
/**
 * Inits the options functionality. Loads the files that contain the options arrays
 * to populate the global options array.
 */
function blake_init_style_options_functionality(){
	global $blake_style_options;

	$blake_style_options=array();

	//get all the categories
	$categories=get_categories('hide_empty=0');
	$blake_categories=array();
	for($i=0; $i<sizeof($categories); $i++){
		$blake_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}

	//load the files that contain the options
	$blake_style_options_files=array('style-general', 'style-website-loading', 'style-header-top-bar', 'style-logotype', 'style-menu', 'style-search', 'style-pagetitle', 'style-footer', 'style-typography', 'style-import-export');
	foreach($blake_style_options_files as $file){
		require_once(BLAKE_OPTIONS_PATH.$file.'.php');
	}
}


/**
 * Sets the Options save functionality.
 */
function blake_set_style_options(){
	global $blake_style_options;
	
	$nonsavable_types=array('open', 'close','subtitle','title','documentation');

	//insert the default values if the fields are empty
	foreach ($blake_style_options as $value) {

		if(isset($value['id'])){
			if(get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
				update_option( $value['id'], $value['std']);
			}
		}
	}
	
	//save the field's values if the Save action is present
	if ( $_GET['page'] == BLAKE_STYLE_OPTIONS_PAGE ) {
	
		if (isset($_REQUEST['action'])){
			if ( 'save' == $_REQUEST['action'] ) {
				
				//verify the nonce
				if ( empty($_POST) || !wp_verify_nonce($_POST['blake-theme-style-options'],'blake-theme-update-style-options') ){
					print 'Sorry, your nonce did not verify.';
					exit;
				} else {
					
					if (!get_option("blake_style_first_save")){
						update_option("blake_style_first_save",'true');
					}
					
					$uploaddir = wp_upload_dir();
					$filename = $uploaddir['basedir']."/style_options.xml";
					$doc = new DOMDocument('1.0');
					$doc->formatOutput = true;
					$root = $doc->createElement('root');

					foreach ($blake_style_options as $value) {
						
						if (isset($value['id'])){
							if( isset( $_REQUEST[ $value['id'] ] ) && !in_array($value['type'], $nonsavable_types)) {
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
								
								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								$valText = $doc->createTextNode($_REQUEST[$value['id']]);
								$val->appendChild($valText);
								
								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($value['id']);
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
																				
							} else if(!in_array($value['type'], $nonsavable_types)){
								delete_option( $value['id'] );
							}	
						}
	
						/*
						Update the values for the custom options that contain unlimited suboptions - for example when having
						 * a slider with fields "title" and "imageurl", for all the entities the titles will be saved in one field,
						 * separated by a separator. In this case, if the field name is slider_title and it contains some data like
						 * title 1|*|title2|*|title3 (|*| is the separator), then all this data will be saved into a custom field
						 * with id slider_titles.
						 */
						if($value['type']=='custom'){
							foreach($value['fields'] as $field){
								update_option( $field['id'].'s', $_REQUEST[ $field['id'].'s' ] );

								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								if (isset($_REQUEST[$value['id']]))
									$valText = $doc->createTextNode($_REQUEST[$value['id']]);
								$val->appendChild($valText);
								
								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($value['id']);
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
																
								
							}
						}
					}
					
					$doc->appendChild($root);
					$doc->save($filename);		
					header("Location: themes.php?page=".BLAKE_STYLE_OPTIONS_PAGE."&saved=true");
					die;
				}
			}	
		}
	}

}



/**
 * Inits the options functionality. Loads the files that contain the options arrays
 * to populate the global options array.
 */
function blake_init_options_functionality(){
	global $blake_options;

	$blake_options=array();

	//get all the categories
	$categories=get_categories('hide_empty=0');
	$blake_categories=array();
	for($i=0; $i<sizeof($categories); $i++){
		$blake_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}

	//load the files that contain the options
	$blake_options_files=array('general', 'header-menu', 'widgetsarea', 'sliders', 'newsletter', 'translation', 'social', 'customcss', 'data');
	
	foreach($blake_options_files as $file){
		require_once(BLAKE_OPTIONS_PATH.$file.'.php');
	}
}


/**
 * Sets the Options save functionality.
 */
function blake_set_options(){
	global $blake_options;
	
	$nonsavable_types=array('open', 'close','subtitle','title','documentation');

	//insert the default values if the fields are empty
	foreach ($blake_options as $value) {
		if(isset($value['id'])){
			if(get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
				update_option( $value['id'], $value['std']);
			}
		}
	}
	
	//save the field's values if the Save action is present
	if ( $_GET['page'] == BLAKE_OPTIONS_PAGE ) {
	
		if (isset($_REQUEST['action'])){
			if ( 'save' == $_REQUEST['action'] ) {
				//verify the nonce
				if ( empty($_POST) || !wp_verify_nonce($_POST['blake-theme-options'],'blake-theme-update-options') ){
					print 'Sorry, your nonce did not verify.';
					exit;
				} else {
					
					if (!get_option("blake_first_save")){
						update_option("blake_first_save",'true');
					}
					
					$uploaddir = wp_upload_dir();
					$filename = $uploaddir['basedir']."/options.xml";
					$doc = new DOMDocument('1.0');
					$doc->formatOutput = true;
					$root = $doc->createElement('root');

					foreach ($blake_options as $value) {
						
						if (isset($value['id'])){
							if( isset( $_REQUEST[ $value['id'] ] ) && !in_array($value['type'], $nonsavable_types)) {
								
								if ($value['id'] === "blake_portfolio_permalink"){
									$oldval = get_option("blake_portfolio_permalink");
									$newval = $_REQUEST[$value['id']];
									
									if ($oldval !== $newval){
										global $wpdb;
										$args = array(
											'posts_per_page' => -1,
											'post_type' => "$oldval"
										);
										$theposts = get_posts( $args );
										foreach ($theposts as $p){
											$oldGuid = $p->guid;
											$aux1 = explode("?post_type=",$oldGuid);
											$newGuid = home_url('/')."?post_type=".$newval."&amp;p=".$p->ID;
											$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET guid = %s WHERE ID = %d", $newGuid, $p->ID) );
											$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET post_type = %s WHERE ID = %d", $newval, $p->ID) );
										}
									} 
									
								}
								
								if ($value['id'] == 'ultimate_selected_google_fonts'){
									if (isset($_REQUEST[$value['id']])) update_option( $value['id'], unserialize(stripslashes(($_REQUEST[$value['id']]))));
								} else {
									update_option( $value['id'], $_REQUEST[ $value['id'] ]  );	
								}
								
								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								if ($value['id'] == 'ultimate_selected_google_fonts'){
									$fontsvalue = stripslashes($_REQUEST[$value['id']]);
									$valText = $doc->createTextNode($fontsvalue);
								} else $valText = $doc->createTextNode($_REQUEST[$value['id']]);
								$val->appendChild($valText);
								
								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($value['id']);
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
																				
							} else if(!in_array($value['type'], $nonsavable_types)){
								delete_option( $value['id'] );
							}	
						}
	
						/*
						Update the values for the custom options that contain unlimited suboptions - for example when having
						 * a slider with fields "title" and "imageurl", for all the entities the titles will be saved in one field,
						 * separated by a separator. In this case, if the field name is slider_title and it contains some data like
						 * title 1|*|title2|*|title3 (|*| is the separator), then all this data will be saved into a custom field
						 * with id slider_titles.
						 */
						if($value['type']=='custom'){
							foreach($value['fields'] as $field){
								update_option( $field['id'].'s', $_REQUEST[ $field['id'].'s' ] );
									
								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								if (isset($_REQUEST[$field['id'].'s']))
									$valText = $doc->createTextNode($_REQUEST[$field['id'].'s']);
								$val->appendChild($valText);

								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($field['id'].'s');
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
							}
						}
					}
					$doc->appendChild($root);
					$doc->save($filename);		
					header("Location: themes.php?page=".BLAKE_OPTIONS_PAGE."&saved=true");
					die;
				}
			}	
		}
	}

}

/**
 * Calls the options manager to print the Options page.
 */
function blake_theme_admin() {
	global $blake_options,$blake_options_manager;

	$blake_options_manager=new BlakeOptionsManager("Blake", BLAKE_IMAGES_URL, BLAKE_UTILS_URL, BLAKE_UPLOADS_URL, BLAKE_VERSION);
	$blake_options_manager->set_options($blake_options);

	if ( isset($_REQUEST['saved'] )) {
		$blake_options_manager->print_saved_message();
	}
	if ( isset($_REQUEST['reset'] )) {
		$blake_options_manager->print_reset_message();
	}

	$blake_options_manager->print_heading("");
	$blake_options_manager->print_options();
	$blake_options_manager->print_footer();
}


/**
 * Calls the style options manager to print the Style Options page.
 */
function blake_theme_style_options_admin() {
	global $blake_style_options, $blake_style_options_manager;

	$blake_style_options_manager=new BlakeStyleOptionsManager("Blake", BLAKE_IMAGES_URL, BLAKE_UTILS_URL, BLAKE_UPLOADS_URL, BLAKE_VERSION);
	$blake_style_options_manager->set_options($blake_style_options);

	if ( isset($_REQUEST['saved'] )) {
		$blake_style_options_manager->print_saved_message();
	}
	if ( isset($_REQUEST['reset'] )) {
		$blake_style_options_manager->print_reset_message();
	}

	$blake_style_options_manager->print_heading("");
	$blake_style_options_manager->print_options();
	$blake_style_options_manager->print_footer();
}



/**
 * Calls the style options manager to print the Style Options page.
 */
function blake_theme_demos_admin() {
	global $blake_demos_manager;

	$blake_demos_manager=new BlakeDemosManager("Blake", BLAKE_IMAGES_URL, BLAKE_UTILS_URL, BLAKE_UPLOADS_URL, BLAKE_VERSION);

	$blake_demos_manager->print_heading("");
	$blake_demos_manager->print_options();
	$blake_demos_manager->print_footer();
}




/**
 * Adds all the options that an array contains to the current global options array.
 * @param $option_arr the array that contains the options values
 */
function blake_add_options($option_arr){
	global $blake_options;

	foreach($option_arr as $option){
		$blake_options[]=$option;
	}
}

function blake_add_style_options($option_arr){
	global $blake_style_options;

	foreach($option_arr as $option){
		$blake_style_options[]=$option;
	}
}

/**
 * Gets an option
 * @param $option the option's second part of the ID (after the theme's shortname part)
 */
function blake_get_opt($option){
	return stripslashes(get_option("blake".$option));
}


function blake_get_custom_sidebars(){
	$res=array();
	$sides=get_option('blake_sidebar_name_names');
	if($sides){
		$res=explode(BLAKE_SEPARATOR, $sides);
		array_pop($res);
	}
	return $res;
}


/**
 * Gets an array containing options settings and if there is an option for adding
 * multiple entities of one type, generates addional array elements for these entities.
 * For example: If there have been created 2 additional sliders, it will append
 * to option elements to this array for each slider.
 * @param $opt_array the array to be modified
 * @return an array containing the custom entity options
 */
function blake_add_custom_options($opt_array){
	$new_blake_options=array();

	foreach($opt_array as $option){
		if($option['type']=='multiple_custom'){
			//insert the new custom options here
				
			$saved_values=get_option($option['refers']);
			$saved_array=explode(BLAKE_SEPARATOR, $saved_values);
			if(sizeof($saved_array)>1){
				array_pop($saved_array);
				foreach($saved_array as $custom_name){
					$id=blake_convert_to_class($custom_name);
					$custom_option=array(
					"id"=>$id,
					"name"=>$option["name"].$custom_name,
					"button_text"=>$option["button_text"],
					"type"=>"custom",
					"preview"=>$id.$option["preview"]
					);
						
					//generate new fields with different unique IDs
					$fields=$option['fields'];
					for($i=0; $i<sizeof($fields);$i++){
						$fields[$i]['id']=$id.$fields[$i]['id'];
					}
						
					$custom_option['fields']=$fields;
						
					array_push($new_blake_options, $custom_option);
				}
			}
				
		} else{
			//this is just a normal option, just append it into the new array
			array_push($new_blake_options, $option);
		}
	}

	return $new_blake_options;
}

function blake_fonts_array_builder(){
	$defaultfonts = array();
	$res = array(array("id" => "", "name"=> "---- Standard Fonts ----", "class" => "select_font_type"), array("id" => "Arial", "name" => "Arial", "class" => "select_font_name"), array("id" => "Arial Black", "name" => "Arial Black", "class" => "select_font_name"), array("id" => "Helvetica", "name" => "Helvetica", "class" => "select_font_name"), array("id" => "Helvetica Neue", "name" => "Helvetica Neue", "class" => "select_font_name"), array("id" => "Courier New", "name" => "Courier New", "class" => "select_font_name"), array("id" => "Georgia", "name" => "Georgia", "class" => "select_font_name"), array("id" => "Impact", "name" => "Impact", "class" => "select_font_name"), array("id" => "Lucida Sans Unicode", "name" => "Lucida Sans", "class" => "select_font_name"), array("id" => "Times New Roman", "name" => "Times New Roman", "class" => "select_font_name"), array("id" => "Trebuchet MS", "name" => "Trebuchet MS", "class" => "select_font_name"), array("id" => "Verdana", "name" => "Verdana", "class" => "select_font_name"));
	array_push($res, $defaultfonts);
	$selected_fonts = get_option('ultimate_selected_google_fonts');
	if(!empty($selected_fonts)) {
		array_push($res, array("id" => "", "name"=> "---- Custom Fonts ----", "class" => "select_font_type"));
		foreach($selected_fonts as $key => $sfont){
			if(!empty($sfont['variants'])){
				$variant = false;
				array_push($res, array("id" => $sfont['font_name']."|normal", "name" => $sfont['font_name']." Normal", "class" => "select_font_name"));
				foreach($sfont['variants'] as $svkey => $svariants){
					if ($svariants['variant_selected'] == 'true'){
						$variant = true;
						array_push($res,array("id" => $sfont['font_name']."|".$svariants['variant_value'], "name" => $sfont['font_name']." {$svariants['variant_value']}", "class" => "select_font_name"));
					}
				}
				if (!$variant){
					array_push($res, array("id" => $sfont['font_name'], "name" => $sfont['font_name'], "class" => "select_font_name"));
				}
			} else array_push($res, array("id" => $sfont['font_name'], "name" => $sfont['font_name'], "class" => "select_font_name"));
		}
	}
	return $res;
}

function blake_portfolio_types(){
	//load the porftfolio categeories
	$portf_categories=array(array('id'=>'all', 'name'=>'All Portfolios'));
	if (function_exists('blake_get_taxonomies')){
		$portf_taxonomies=blake_get_taxonomies('portfolio_type');
		if (isset($portf_taxonomies)){
			foreach($portf_taxonomies as $taxonomy){
				$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->slug);
			}			
		}
	}
	return $portf_categories;
}

function blake_get_proj(){
	
	$blake_proj2=array(array('id'=>'default', 'name'=>'Default'));
	if (function_exists('blake_get_projects')){
		$blake_proj1 = blake_get_projects();
		foreach($blake_proj1 as $dp){
			$blake_proj2[]=array("name"=>$dp['p_title'], "id"=>$dp['p_id']);
		}
	}

	return $blake_proj2;
}


function blake_get_all_google_fonts(){
	$blake_google_fonts = array(	array( 'name' => "Cantarell", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Cardo", 'variant' => ''),
		array( 'name' => "Crimson Text", 'variant' => ''),
		array( 'name' => "Droid Sans", 'variant' => ':r,b'),
		array( 'name' => "Droid Sans Mono", 'variant' => ''),
		array( 'name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
		array( 'name' => "IM Fell DW Pica", 'variant' => ':r,i'),
		array( 'name' => "Inconsolata", 'variant' => ''),
		array( 'name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
		array( 'name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Lobster", 'variant' => ''),
		array( 'name' => "Molengo", 'variant' => ''),
		array( 'name' => "Nobile", 'variant' => ':r,b,i,bi'),
		array( 'name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
		array( 'name' => "Old Standard TT", 'variant' => ':r,b,i'),
		array( 'name' => "Reenie Beanie", 'variant' => ''),
		array( 'name' => "Tangerine", 'variant' => ':r,b'),
		array( 'name' => "Vollkorn", 'variant' => ':r,b'),
		array( 'name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
		array( 'name' => "Cuprum", 'variant' => ''),
		array( 'name' => "Neucha", 'variant' => ''),
		array( 'name' => "Neuton", 'variant' => ''),
		array( 'name' => "PT Sans", 'variant' => ':r,b,i,bi'),
		array( 'name' => "PT Sans Caption", 'variant' => ':r,b'),
		array( 'name' => "PT Sans Narrow", 'variant' => ':r,b'),
		array( 'name' => "Philosopher", 'variant' => ''),
		array( 'name' => "Allerta", 'variant' => ''),
		array( 'name' => "Allerta Stencil", 'variant' => ''),
		array( 'name' => "Arimo", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Arvo", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Bentham", 'variant' => ''),
		array( 'name' => "Coda", 'variant' => ':800'),
		array( 'name' => "Cousine", 'variant' => ''),
		array( 'name' => "Covered By Your Grace", 'variant' => ''),
		array( 'name' => "Geo", 'variant' => ''),
		array( 'name' => "Just Me Again Down Here", 'variant' => ''),
		array( 'name' => "Puritan", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Raleway", 'variant' => ':100'),
		array( 'name' => "Tinos", 'variant' => ':r,b,i,bi'),
		array( 'name' => "UnifrakturCook", 'variant' => ':bold'),
		array( 'name' => "UnifrakturMaguntia", 'variant' => ''),
		array( 'name' => "Mountains of Christmas", 'variant' => ''),
		array( 'name' => "Lato", 'variant' => ''),
		array( 'name' => "Orbitron", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Allan", 'variant' => ':bold'),
		array( 'name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Copse", 'variant' => ''),
		array( 'name' => "Kenia", 'variant' => ''),
		array( 'name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Vibur", 'variant' => ''),
		array( 'name' => "Sniglet", 'variant' => ':800'),
		array( 'name' => "Syncopate", 'variant' => ''),
		array( 'name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
		array( 'name' => "Merriweather", 'variant' => ''),
		array( 'name' => "Maiden Orange", 'variant' => ''),
		array( 'name' => "Just Another Hand", 'variant' => ''),
		array( 'name' => "Kristi", 'variant' => ''),
		array( 'name' => "Corben", 'variant' => ':b'),
		array( 'name' => "Gruppo", 'variant' => ''),
		array( 'name' => "Buda", 'variant' => ':light'),
		array( 'name' => "Lekton", 'variant' => ''),
		array( 'name' => "Luckiest Guy", 'variant' => ''),
		array( 'name' => "Crushed", 'variant' => ''),
		array( 'name' => "Chewy", 'variant' => ''),
		array( 'name' => "Coming Soon", 'variant' => ''),
		array( 'name' => "Crafty Girls", 'variant' => ''),
		array( 'name' => "Fontdiner Swanky", 'variant' => ''),
		array( 'name' => "Permanent Marker", 'variant' => ''),
		array( 'name' => "Rock Salt", 'variant' => ''),
		array( 'name' => "Sunshiney", 'variant' => ''),
		array( 'name' => "Unkempt", 'variant' => ''),
		array( 'name' => "Calligraffitti", 'variant' => ''),
		array( 'name' => "Cherry Cream Soda", 'variant' => ''),
		array( 'name' => "Homemade Apple", 'variant' => ''),
		array( 'name' => "Irish Growler", 'variant' => ''),
		array( 'name' => "Kranky", 'variant' => ''),
		array( 'name' => "Schoolbell", 'variant' => ''),
		array( 'name' => "Slackey", 'variant' => ''),
		array( 'name' => "Walter Turncoat", 'variant' => ''),
		array( 'name' => "Radley", 'variant' => ''),
		array( 'name' => "Meddon", 'variant' => ''),
		array( 'name' => "Kreon", 'variant' => ':r,b'),
		array( 'name' => "Dancing Script", 'variant' => ''),
		array( 'name' => "Goudy Bookletter 1911", 'variant' => ''),
		array( 'name' => "PT Serif Caption", 'variant' => ':r,i'),
		array( 'name' => "PT Serif", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Astloch", 'variant' => ':b'),
		array( 'name' => "Bevan", 'variant' => ''),
		array( 'name' => "Anton", 'variant' => ''),
		array( 'name' => "Expletus Sans", 'variant' => ':b'),
		array( 'name' => "VT323", 'variant' => ''),
		array( 'name' => "Pacifico", 'variant' => ''),
		array( 'name' => "Candal", 'variant' => ''),
		array( 'name' => "Architects Daughter", 'variant' => ''),
		array( 'name' => "Indie Flower", 'variant' => ''),
		array( 'name' => "League Script", 'variant' => ''),
		array( 'name' => "Cabin Sketch", 'variant' => ':b'),
		array( 'name' => "Quattrocento", 'variant' => ''),
		array( 'name' => "Amaranth", 'variant' => ''),
		array( 'name' => "Irish Grover", 'variant' => ''),
		array( 'name' => "Oswald", 'variant' => ''),
		array( 'name' => "EB Garamond", 'variant' => ''),
		array( 'name' => "Nova Round", 'variant' => ''),
		array( 'name' => "Nova Slim", 'variant' => ''),
		array( 'name' => "Nova Script", 'variant' => ''),
		array( 'name' => "Nova Cut", 'variant' => ''),
		array( 'name' => "Nova Mono", 'variant' => ''),
		array( 'name' => "Nova Oval", 'variant' => ''),
		array( 'name' => "Nova Flat", 'variant' => ''),
		array( 'name' => "Terminal Dosis Light", 'variant' => ''),
		array( 'name' => "Michroma", 'variant' => ''),
		array( 'name' => "Miltonian", 'variant' => ''),
		array( 'name' => "Miltonian Tattoo", 'variant' => ''),
		array( 'name' => "Annie Use Your Telescope", 'variant' => ''),
		array( 'name' => "Dawning of a New Day", 'variant' => ''),
		array( 'name' => "Sue Ellen Francisco", 'variant' => ''),
		array( 'name' => "Waiting for the Sunrise", 'variant' => ''),
		array( 'name' => "Special Elite", 'variant' => ''),
		array( 'name' => "Quattrocento Sans", 'variant' => ''),
		array( 'name' => "Smythe", 'variant' => ''),
		array( 'name' => "The Girl Next Door", 'variant' => ''),
		array( 'name' => "Aclonica", 'variant' => ''),
		array( 'name' => "News Cycle", 'variant' => ''),
		array( 'name' => "Damion", 'variant' => ''),
		array( 'name' => "Wallpoet", 'variant' => ''),
		array( 'name' => "Over the Rainbow", 'variant' => ''),
		array( 'name' => "MedievalSharp", 'variant' => ''),
		array( 'name' => "Six Caps", 'variant' => ''),
		array( 'name' => "Swanky and Moo Moo", 'variant' => ''),
		array( 'name' => "Bigshot One", 'variant' => ''),
		array( 'name' => "Francois One", 'variant' => ''),
		array( 'name' => "Sigmar One", 'variant' => ''),
		array( 'name' => "Carter One", 'variant' => ''),
		array( 'name' => "Holtdesd One SC", 'variant' => ''),
		array( 'name' => "Paytone One", 'variant' => ''),
		array( 'name' => "Monofett", 'variant' => ''),
		array( 'name' => "Rokkitt", 'variant' => ''),
		array( 'name' => "Megrim", 'variant' => ''),
		array( 'name' => "Judson", 'variant' => ':r,ri,b'),
		array( 'name' => "Didact Gothic", 'variant' => ''),
		array( 'name' => "Play", 'variant' => ':r,b'),
		array( 'name' => "Ultra", 'variant' => ''),
		array( 'name' => "Metrophobic", 'variant' => ''),
		array( 'name' => "Mako", 'variant' => ''),
		array( 'name' => "Shanti", 'variant' => ''),
		array( 'name' => "Caudex", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Jura", 'variant' => ''),
		array( 'name' => "Ruslan Display", 'variant' => ''),
		array( 'name' => "Brawler", 'variant' => ''),
		array( 'name' => "Nunito", 'variant' => ''),
		array( 'name' => "Wire One", 'variant' => ''),
		array( 'name' => "Podkova", 'variant' => ''),
		array( 'name' => "Muli", 'variant' => ''),
		array( 'name' => "Maven Pro", 'variant' => ''),
		array( 'name' => "Tenor Sans", 'variant' => ''),
		array( 'name' => "Limelight", 'variant' => ''),
		array( 'name' => "Playfair Display", 'variant' => ''),
		array( 'name' => "Artifika", 'variant' => ''),
		array( 'name' => "Lora", 'variant' => ''),
		array( 'name' => "Kameron", 'variant' => ':r,b'),
		array( 'name' => "Cedarville Cursive", 'variant' => ''),
		array( 'name' => "Zeyada", 'variant' => ''),
		array( 'name' => "La Belle Aurore", 'variant' => ''),
		array( 'name' => "Shadows Into Light", 'variant' => ''),
		array( 'name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Nixie One", 'variant' => ''),
		array( 'name' => "Redressed", 'variant' => ''),
		array( 'name' => "Bangers", 'variant' => ''),
		array( 'name' => "Open Sans Condensed", 'variant' => ':300,300italic'),
		array( 'name' => "Open Sans", 'variant' => ':r,i,b,bi'),
		array( 'name' => "Varela", 'variant' => ''),
		array( 'name' => "Goblin One", 'variant' => ''),
		array( 'name' => "Asset", 'variant' => ''),
		array( 'name' => "Gravitas One", 'variant' => ''),
		array( 'name' => "Hammersmith One", 'variant' => ''),
		array( 'name' => "Stardos Stencil", 'variant' => ''),
		array( 'name' => "Love Ya Like A Sister", 'variant' => ''),
		array( 'name' => "Loved by the King", 'variant' => ''),
		array( 'name' => "Bowlby One SC", 'variant' => ''),
		array( 'name' => "Forum", 'variant' => ''),
		array( 'name' => "Patrick Hand", 'variant' => ''),
		array( 'name' => "Varela Round", 'variant' => ''),
		array( 'name' => "Yeseva One", 'variant' => ''),
		array( 'name' => "Give You Glory", 'variant' => ''),
		array( 'name' => "Modern Antiqua", 'variant' => ''),
		array( 'name' => "Bowlby One", 'variant' => ''),
		array( 'name' => "Tienne", 'variant' => ''),
		array( 'name' => "Istok Web", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Yellowtail", 'variant' => ''),
		array( 'name' => "Pompiere", 'variant' => ''),
		array( 'name' => "Unna", 'variant' => ''),
		array( 'name' => "Rosario", 'variant' => ''),
		array( 'name' => "Leckerli One", 'variant' => ''),
		array( 'name' => "Snippet", 'variant' => ''),
		array( 'name' => "Ovo", 'variant' => ''),
		array( 'name' => "IM Fell English", 'variant' => ':r,i'),
		array( 'name' => "IM Fell English SC", 'variant' => ''),
		array( 'name' => "Gloria Hallelujah", 'variant' => ''),
		array( 'name' => "Kelly Slab", 'variant' => ''),
		array( 'name' => "Black Ops One", 'variant' => ''),
		array( 'name' => "Carme", 'variant' => ''),
		array( 'name' => "Aubrey", 'variant' => ''),
		array( 'name' => "Federo", 'variant' => ''),
		array( 'name' => "Delius", 'variant' => ''),
		array( 'name' => "Rochester", 'variant' => ''),
		array( 'name' => "Rationale", 'variant' => ''),
		array( 'name' => "Abel", 'variant' => ''),
		array( 'name' => "Marvel", 'variant' => ':r,b,i,bi'),
		array( 'name' => "Actor", 'variant' => ''),
		array( 'name' => "Delius Swash Caps", 'variant' => ''),
		array( 'name' => "Smokum", 'variant' => ''),
		array( 'name' => "Tulpen One", 'variant' => ''),
		array( 'name' => "Coustard", 'variant' => ':r,b'),
		array( 'name' => "Andika", 'variant' => ''),
		array( 'name' => "Alice", 'variant' => ''),
		array( 'name' => "Questrial", 'variant' => ''),
		array( 'name' => "Comfortaa", 'variant' => ':r,b'),
		array( 'name' => "Geostar", 'variant' => ''),
		array( 'name' => "Geostar Fill", 'variant' => ''),
		array( 'name' => "Volkhov", 'variant' => ''),
		array( 'name' => "Voltaire", 'variant' => ''),
		array( 'name' => "Montez", 'variant' => ''),
		array( 'name' => "Short Stack", 'variant' => ''),
		array( 'name' => "Vidaloka", 'variant' => ''),
		array( 'name' => "Aldrich", 'variant' => ''),
		array( 'name' => "Numans", 'variant' => ''),
		array( 'name' => "Days One", 'variant' => ''),
		array( 'name' => "Gentium Book Basic", 'variant' => ''),
		array( 'name' => "Monoton", 'variant' => ''),
		array( 'name' => "Alike", 'variant' => ''),
		array( 'name' => "Delius Unicase", 'variant' => ''),
		array( 'name' => "Abril Fatface", 'variant' => ''),
		array( 'name' => "Dorsa", 'variant' => ''),
		array( 'name' => "Antic", 'variant' => ''),
		array( 'name' => "Passero One", 'variant' => ''),
		array( 'name' => "Fandesd Text", 'variant' => ''),
		array( 'name' => "Prociono", 'variant' => ''),
		array( 'name' => "Merienda One", 'variant' => ''),
		array( 'name' => "Changa One", 'variant' => ''),
		array( 'name' => "Julee", 'variant' => ''),
		array( 'name' => "Prata", 'variant' => ''),
		array( 'name' => "Adamina", 'variant' => ''),
		array( 'name' => "Sorts Mill Goudy", 'variant' => ''),
		array( 'name' => "Terminal Dosis", 'variant' => ''),
		array( 'name' => "Sansita One", 'variant' => ''),
		array( 'name' => "Chivo", 'variant' => ''),
		array( 'name' => "Spinnaker", 'variant' => ''),
		array( 'name' => "Poller One", 'variant' => ''),
		array( 'name' => "Alike Angular", 'variant' => ''),
		array( 'name' => "Gochi Hand", 'variant' => ''),
		array( 'name' => "Poly", 'variant' => ''),
		array( 'name' => "Andada", 'variant' => ''),
		array( 'name' => "Federant", 'variant' => ''),
		array( 'name' => "Ubuntu Condensed", 'variant' => ''),
		array( 'name' => "Ubuntu Mono", 'variant' => '')
	);
	return $blake_google_fonts;
}

?>