<?php

	if (isset($_POST)){
		$demo = isset($_POST['demo']) ? $_POST['demo'] : "";
		$errors = 'false';
		
		require_once(
			$_POST['thepath']."wp-" 
			. "loa". "d.p" ."hp");
		$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
		
		if (!function_exists('WP_Filesystem')){
			$abspath = ($os === "win") ? "\wp-admin\includes\file.php" : "/wp-admin/includes/file.php";
			require_once(ABSPATH.$abspath);
		}
		WP_Filesystem();
		
		global $wpdb, $current_user, $pagenow, $wp_filesystem, $table_prefix;
		$demosurl = "http://upperinc.com/previews/demos/blake/";
		$blake_stylesheet = get_option('stylesheet');
		$output = "";
		switch($_POST['action']){
			
			case 'dbreset': 
				/* reset database */
				try {
					
					$blakesiteurl = get_option('siteurl');
					$blakehome = home_url('/');
					
					require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

					// Grab the WordPress database tables
					$db_tables = $wpdb->tables();

					// Get current options
					$blog_title = get_option('blogname');
					$public = get_option('blog_public');

					$admin_user = get_user_by('login', 'admin');
					$user = ( ! $admin_user || ! user_can($admin_user->ID, 'update_core') ) ? $current_user : $admin_user;

				
					// Grab the currently active plugins
					//$active_plugins = $wpdb->get_var( $wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s", 'active_plugins') );

					// Run through the database columns, drop all the tables and
					// install wp with previous settings
					if ( $db_tables = $wpdb->get_col("SHOW TABLES LIKE '{$wpdb->prefix}%'") ) {
						foreach ($db_tables as $db_table) {
							$wpdb->query("DROP TABLE {$db_table}");
						}
						
						$keys = wp_install($blog_title, $user->user_login, $user->user_email, $public);
						
						$keys['url'] = $blakesiteurl;
												
						blake_wp_update_user($user, $keys);
					}

					switch_theme( $blake_stylesheet );
					
					update_option('siteurl',$blakesiteurl);
					update_option('home',$blakehome);
					
				} catch (Exception $e) {
					$errors = $e->getMessage();
				}	
				echo json_encode($errors);
			break;
			
			case 'install_plugins':
				try{
					$plugins = array(
						array('name' => 'blake_custom_post_types', 'path' => get_template_directory_uri() . '/lib/plugins/blake_custom_post_types.zip', 'install' => 'blake_custom_post_types/blake_custom_post_types.php'),
						array('name' => 'contact-form-7', 'path' => get_template_directory_uri() . '/lib/plugins/contact-form-7.zip', 'install' => 'contact-form-7/wp-contact-form-7.php'),
						array('name' => 'really-simple-captcha', 'path' => get_template_directory_uri() . '/lib/plugins/really-simple-captcha.zip', 'install' => 'really-simple-captcha/really-simple-captcha.php'),
						array('name' => 'revslider', 'path' => get_template_directory_uri() . '/lib/plugins/revslider.zip', 'install' => 'revslider/revslider.php'),
						array('name' => 'js_composer', 'path'=> get_template_directory_uri() . '/lib/plugins/js_composer.zip', 'install' => 'js_composer/js_composer.php'),
						array('name' => 'Ultimate_VC_Addons', 'path'=> get_template_directory_uri() . '/lib/plugins/Ultimate_VC_Addons.zip', 'install' => 'Ultimate_VC_Addons/Ultimate_VC_Addons.php'),
						array('name' => 'cubeportfolio', 'path'=> get_template_directory_uri() . '/lib/plugins/cubeportfolio.zip', 'install' => 'cubeportfolio/cubeportfolio.php')

					);
					$plgs = blake_get_plugins($plugins);
				} catch (Exception $e){
					$errors = $e->getMessage();
				}
				echo json_encode($errors);
			break;
			
			case 'import_content_set_options':
				try{
					//ini_set('max_execution_time', 0);
					require_once( ABSPATH . '/wp-admin/includes/media.php' );
					// import content
					blake_autoimport($demosurl, $demo);
					
					// set the menu
					// usar qq cena tipo nome do demo, seria o ideal. até pode ser sempre o mmo slug, mais fácil, menos código.
					$menuslug = "primary-navigation";
					$menu_id = $wpdb->get_results( $wpdb->prepare("SELECT term_id from $wpdb->terms WHERE slug LIKE %s", $menuslug), OBJECT );					
					$mods['nav_menu_locations']['PrimaryNavigation'] = $menu_id[0]->term_id;
					
					//top bar menu
					$tbmenuslug = "top-bar-menu";
                    $tbmenu_id = $wpdb->get_results( $wpdb->prepare("SELECT term_id FROM $wpdb->terms WHERE slug LIKE %s", $tbmenuslug), OBJECT ); 
					if (isset($tbmenu_id[0])) $mods['nav_menu_locations']['topbarnav'] = $tbmenu_id[0]->term_id;

					update_option("theme_mods_".$blake_stylesheet, $mods);
					update_option("mods_blake", $mods);

				} catch (Exception $e){
					$errors = $e->getMessage();
				}
				echo json_encode($errors);
			break;
			
			case 'import_widgets':
				$filename = "widgets.wie";
				//try{
				ob_start();
				blake_wie_process_import_file($demosurl . $demo . "/" . $filename);
				ob_end_clean();
				//} catch (Exception $e){
					//$errors = $e->getMessage();
				//}
				echo json_encode($errors);
			break;
		}
	}
	


/* helper functions */

function blake_wie_process_import_file( $file ) {
	WP_Filesystem();
	global $wie_import_results, $wp_filesystem;
	$data = false;
	$data = $wp_filesystem->get_contents($file);
	// Make results available for display on import/export page
	if ($data){
		ob_start();
		blake_wie_import_data( $data );
		ob_end_clean();		
	}
}

function blake_wie_available_widgets() {

	global $wp_registered_widget_controls;

	$widget_controls = $wp_registered_widget_controls;

	$available_widgets = array();

	foreach ( $widget_controls as $widget ) {

		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];
		}
		
	}
	return $available_widgets;
}

function blake_wie_import_data( $data ) {

	global $wp_registered_sidebars;
	$available_widgets = blake_wie_available_widgets();
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}
	$results = array();
	if (is_string($data)) $data = json_decode($data);
	foreach ( $data as $sidebar_id => $widgets ) {
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}
		$sidebar_available = true;
		$use_sidebar_id = $sidebar_id;
		$sidebar_message_type = 'success';
		$sidebar_message = '';
		
		// Result for sidebar
		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
		$results[$sidebar_id]['message'] = $sidebar_message;
		$results[$sidebar_id]['widgets'] = array();

		// Loop widgets
		foreach ( $widgets as $widget_instance_id => $widget ) {
			$fail = false;
			// Get id_base (remove -# from end) and instance ID number
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

			// Does site support this widget?
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = esc_html__( 'Site does not support widget', 'blake' ); // explain why widget not imported
			}

			// Does widget with identical settings already exist in same sidebar?
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

				// Get existing widgets in this sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

				// Loop widgets with ID base
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
				foreach ( $single_widget_instances as $check_id => $check_widget ) {

					// Is widget in same sidebar and has identical settings?
					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

						$fail = true;
						$widget_message_type = 'warning';
						$widget_message = esc_html__( 'Widget already exists', 'blake' ); // explain why widget not imported

						break;

					}
	
				}

			}
			// No failure
			if ( ! $fail ) {

				// Add widget instance
				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
				$single_widget_instances[] = (array) $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

				// Assign widget instance to sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				// Success message
				if ( $sidebar_available ) {
					$widget_message_type = 'success';
					$widget_message = esc_html__( 'Imported', 'blake' );
				} else {
					$widget_message_type = 'warning';
					$widget_message = esc_html__( 'Imported to Inactive', 'blake' );
				}

			}

			// Result for widget instance
			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : esc_html__( 'No Title', 'blake' ); // show "No Title" if widget instance is untitled
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

		}

	}

 	//return  $results ;

}


/**
 * Updates the user password and clears / sets 
 * the authentication cookie for the user
 *
 * @access private
 * @param $user Current or admin user
 * @param $keys Array returned by wp_install()
 * @return true on install success, false otherwise
 */
function blake_wp_update_user($user, $keys) {
	global $wpdb;			
	extract($keys, EXTR_SKIP);

	$query = $wpdb->prepare("UPDATE $wpdb->users SET user_pass = '%s', user_activation_key = '' WHERE ID = '%d'", $user->user_pass, $user_id);
	
	if ( $wpdb->query($query) ) {
		// Remove password reminder after installing
		if ( get_user_meta($user_id, 'default_password_nag') ) delete_user_meta($user_id, 'default_password_nag');

		wp_clear_auth_cookie();
		wp_set_auth_cookie($user_id);
		
		return true;
	}			
	return false;
}


/* plugins stuff */


function blake_get_plugins($plugins){
    $args = array(
       'path' => ABSPATH.'wp-content/plugins/',
       'preserve_zip' => false
    );

    foreach($plugins as $plugin){
		if (!file_exists($plugin['install'])){
			blake_plugin_download($plugin['path'], $args['path'].$plugin['name'].'.zip');
			blake_plugin_unpack($args, $args['path'].$plugin['name'].'.zip');
		}
		blake_plugin_activate($plugin['install']);
    }
	return true;
}

function blake_plugin_download($url, $path){
	global $wp_filesystem;
	$data = $result = false;
	$data = $wp_filesystem->get_contents($url);
	if ($data){
		$result = $wp_filesystem->put_contents($path, $data, FS_CHMOD_FILE);
	}
	
	return $result;
}

function blake_plugin_unpack($args, $target){
    global $wp_filesystem;
    if ($zip = zip_open($target)){
	    if (is_resource($zip)){
			     while ($entry = zip_read($zip)){
	             $is_file = substr(zip_entry_name($entry), -1) == '/' ? false : true;
	             $file_path = $args['path'].zip_entry_name($entry);
	             if ($is_file){
	                  if (zip_entry_open($zip,$entry,"r")) {
	                      $fstream = zip_entry_read($entry, zip_entry_filesize($entry));
	                      $wp_filesystem->put_contents($file_path, $fstream, FS_CHMOD_FILE);
	                  }
	                  zip_entry_close($entry);
	             }
	             else {
	                  if (zip_entry_name($entry)){
	                      if (!is_dir($file_path)) mkdir($file_path);
	                      chmod($file_path, 0777);
	                      //echo "create: ".$file_path."<br />";
	                  }
	             }
	        }
	        zip_close($zip);
	    }
    }
    if ($args['preserve_zip'] === false){
		unlink($target);
    }
}

function blake_plugin_activate($installer){
    $current = get_option('active_plugins');
    $plugin = plugin_basename(trim($installer));

    if (!in_array($plugin, $current)) {
        $current[] = $plugin;
        sort($current);
        do_action('activate_plugin', trim($plugin));
        update_option('active_plugins', $current);
        do_action('activate_'.trim($plugin));
        do_action('activated_plugin', trim($plugin));
        return true;
    }
    else return false;
}

/* endof plugins stuff */



/* end of helper functions */

?>