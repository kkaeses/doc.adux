<?php
/**
 * @package WordPress
 * @subpackage Blake
 */
 	
	remove_action('load-update-core.php','wp_update_plugins');
	add_filter('site_transient_update_plugins','__return_false');
	add_filter('pre_site_transient_update_plugins','__return_false');
	
	add_action( 'after_setup_theme', 'blake_setup' );
	
	function blake_setup(){
		
		//remove notifications
		add_action( 'vc_before_init', 'blake_vcSetAsTheme' );
		function blake_vcSetAsTheme() {
		    vc_set_as_theme(true);
		}
		if (function_exists( 'set_revslider_as_theme' )){
			add_action( 'init', 'blake_set_revslider_as_theme' );
			function blake_set_revslider_as_theme() {
				set_revslider_as_theme();
			}
		}
	
		/** 
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );
		
		/* Add theme-supported features. */
		add_theme_support( 'title-tag' );
			
		/**
		 * This theme uses post thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		
		/**
		 *	This theme supports woocommerce
		 */
		add_theme_support( 'woocommerce' );
			
		/**
		 *	This theme supports editor styles
		 */
		add_editor_style("/css/layout-style.css");
		
		/* Add custom actions. */
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'blake', get_template_directory() . '/languages' );
			
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
		/*
	
		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		if ( ! isset( $content_width ) )
			$content_width = 900;
		
		
		//declare some global variables that will be used everywhere
		global $blake_new_meta_boxes,
		$blake_new_meta_post_boxes,
		$blake_new_meta_portfolio_boxes,
		$blake_buttons,
		$blake_data;
		$blake_new_meta_boxes=array();
		$blake_new_meta_post_boxes=array();
		$blake_new_meta_portfolio_boxes=array();
		$blake_buttons=array();
		$blake_data=new stdClass();
		
		
		/*----------------------------------------------------------------
		 *  DEFINE THE MAIN CONSTANTS
		 *---------------------------------------------------------------*/
		//main theme info constants
		
		$my_theme = wp_get_theme();
		define("BLAKE_VERSION", $my_theme->Version);
		//define the main paths and URLs
		define("BLAKE_LIB_PATH", get_template_directory() . '/lib/');
		define("BLAKE_LIB_URL", get_template_directory_uri().'/lib/');
		define("BLAKE_JS_PATH", get_template_directory_uri().'/js/');
		define("BLAKE_CSS_PATH", get_template_directory_uri().'/css/');
	
		define("BLAKE_FUNCTIONS_PATH", BLAKE_LIB_PATH . 'functions/');
		define("BLAKE_FUNCTIONS_URL", BLAKE_LIB_URL.'functions/');
		define("BLAKE_CLASSES_PATH", BLAKE_LIB_PATH.'classes/');
		define("BLAKE_OPTIONS_PATH", BLAKE_LIB_PATH.'options/');
		define("BLAKE_WIDGETS_PATH", BLAKE_LIB_PATH.'widgets/');
		define("BLAKE_SHORTCODES_PATH", BLAKE_LIB_PATH.'shortcodes/');
		define("BLAKE_PLUGINS_PATH", BLAKE_LIB_PATH.'plugins/');
		define("BLAKE_UTILS_URL", BLAKE_LIB_URL.'utils/');
		
		define("BLAKE_IMAGES_URL", BLAKE_LIB_URL.'images/');
		define("BLAKE_CSS_URL", BLAKE_LIB_URL.'css/');
		define("BLAKE_SCRIPT_URL", BLAKE_LIB_URL.'script/');
		define("BLAKE_PATTERNS_URL", get_template_directory_uri().'/images/blake_patterns/');
		$uploadsdir=wp_upload_dir();
		define("BLAKE_UPLOADS_URL", $uploadsdir['url']);
		define("BLAKE_SEPARATOR", '|*|');
		define("BLAKE_OPTIONS_PAGE", 'blake_options');
		define("BLAKE_STYLE_OPTIONS_PAGE", 'blake_style_options');
		define("BLAKE_DEMOS_PAGE", 'blake_demos');
	
		/*----------------------------------------------------------------
		 *  INCLUDE THE FUNCTIONS FILES
		 *---------------------------------------------------------------*/
				
		require_once (BLAKE_FUNCTIONS_PATH.'general.php');  //some main common functions
		require_once (BLAKE_FUNCTIONS_PATH.'stylesheet.php');  //some main common functions
		add_action('wp_enqueue_scripts', 'blake_style', 1);
		add_action('wp_enqueue_scripts','blake_custom_head', 2);
		add_action('wp_enqueue_scripts', 'blake_scripts', 10);
		//add_action('wp_head','blake_css_options', 13);
	
		
		require_once (BLAKE_FUNCTIONS_PATH.'sidebars.php');  //the sidebar functionality
		if ( isset($_GET['page']) && $_GET['page'] == BLAKE_OPTIONS_PAGE ){
			require_once (BLAKE_CLASSES_PATH.'upper-options-manager.php');  //the theme options manager functionality
		}
		if ( isset($_GET['page']) && $_GET['page'] == BLAKE_STYLE_OPTIONS_PAGE ){
			require_once (BLAKE_CLASSES_PATH.'upper-style-options-manager.php');  //the theme options manager functionality
		}
		if ( isset($_GET['page']) && $_GET['page'] == BLAKE_DEMOS_PAGE ){
			require_once (BLAKE_CLASSES_PATH.'upper-demos-manager.php');  //the theme options manager functionality
		}
			
		require_once (BLAKE_CLASSES_PATH.'upper-templater.php');  
		require_once (BLAKE_CLASSES_PATH.'upper-custom-data-manager.php');  
		require_once (BLAKE_CLASSES_PATH.'upper-custom-page.php');  
		require_once (BLAKE_CLASSES_PATH.'upper-custom-page-manager.php');  
		require_once (BLAKE_FUNCTIONS_PATH.'custom-pages.php');  //the comments functionality
		require_once (BLAKE_FUNCTIONS_PATH.'ajax.php');  //AJAX handler functions
		require_once (BLAKE_FUNCTIONS_PATH.'comments.php');  //the comments functionality
		require_once (BLAKE_WIDGETS_PATH.'widgets.php');  //the widgets functionality
		if (function_exists('blake_add_widgets')) blake_add_widgets();
		require_once (BLAKE_FUNCTIONS_PATH.'options.php');  //the theme options functionality
		require_once (BLAKE_LIB_PATH.'classes/Mobile_Detect.php');
		
		if (is_admin()){
			require_once (BLAKE_FUNCTIONS_PATH. 'meta.php');  //adds the custom meta fields to the posts and pages
			add_action('admin_enqueue_scripts','blake_admin_style');
		}
		$functions_path = get_template_directory() . '/functions/';
		
		add_filter('add_to_cart_fragments' , 'blake_woocommerce_header_add_to_cart_fragment' );
		
		// Declare sidebar widget zone
		if (function_exists('register_sidebar')) {
			register_sidebar(array(
				'name' => esc_html__( 'Blog Sidebar', 'blake' ),
				'id'   => 'sidebar-widgets',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>'
			));
		}
		
		if (!function_exists('blake_wp_pagenavi')){ 
			$including = $functions_path. 'wp-pagenavi.php';
		    require_once($including);
		}
		
		/* ------------------------------------------------------------------------ */
		/* Misc
		/* ------------------------------------------------------------------------ */
		// Post Thumbnail Sizes
		if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
		
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'blake_blog', 1000, 563, true );				// Standard Blog Image
			add_image_size( 'blake_mini', 80, 80, true ); 				// used for widget thumbnail
			add_image_size( 'blake_portfolio', 600, 400, true );			// also for blog-medium
			add_image_size( 'blake_regular', 500, 500, true ); 
			add_image_size( 'blake_wide', 1000, 500, true ); 
			add_image_size( 'blake_tall', 500, 1000, true );
			add_image_size( 'blake_widetall', 1000, 1000, true ); 
		}
		
		/* tgm plugin activator */
		/**
		 * Include the TGM_Plugin_Activation class.
		 */
		require_once get_template_directory() . '/lib/functions/class-tgm-plugin-activation.php';
		
		add_action( 'tgmpa_register', 'blake_register_required_plugins' );	
		
		if ( class_exists('VCExtendAddonClass')){
			// Finally initialize code
			new VCExtendAddonClass();
		}
		
		if (get_option("blake_enable_smooth_scroll") == "on"){
			update_option('ultimate_smooth_scroll','enable');
		} else update_option('ultimate_smooth_scroll','disable');
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}
	
	function blake_admin_style(){
		wp_enqueue_style('blake-fa-painel', BLAKE_CSS_PATH .'font-awesome-painel.min.css');
		wp_enqueue_script( 'blake-admin', BLAKE_JS_PATH .'blake-admin.js', array(), '1',$in_footer = true);
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*  THEME REQUIRES
	/*-----------------------------------------------------------------------------------*/
	require_once (get_template_directory().'/inc/theme-styles.php');
	
	
	function blake_custom_head(){
		wp_enqueue_script('blake-html5trunk', get_template_directory_uri().'/js/html5.js', '1');
		wp_script_add_data( 'blake-html5trunk', 'conditional', 'lt IE 9' );
	}
	
	function blake_style() {
	  	wp_enqueue_style('blake_js_composer_front');
		wp_style_add_data( 'blake_js_composer_front', 'conditional', 'lt IE 9' );
		
		wp_enqueue_style( 'blake-style', get_bloginfo( 'stylesheet_url' ), array(), '1' );
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*  LOAD THEME SCRIPTS
	/*-----------------------------------------------------------------------------------*/
	function blake_scripts(){
	
		if (!is_admin()){
			global $vc_addons_url, $post;
	   	    wp_enqueue_script( 'blake_utils', BLAKE_JS_PATH .'utils.js', array('jquery'),'1.0',$in_footer = true);
	  	    wp_enqueue_script( 'blake', BLAKE_JS_PATH .'blake.js', array('jquery'), '1',$in_footer = true);
	  	    wp_enqueue_script( 'jquery.twitter', BLAKE_JS_PATH .'twitter/jquery.tweet.js', array(),'1.0',$in_footer = true);
	  	    
	  		wp_enqueue_script('cubeportfolio-jquery-js',$in_footer = false);
			wp_enqueue_style('cubeportfolio-jquery-css',$in_footer = false);
			
			if (is_search()){
				if (class_exists('Ultimate_VC_Addons')) {
					wp_enqueue_script('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-js/ultimate.min.js', array('jquery'),'1');
					wp_enqueue_style('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-css/ultimate.min.css');
				}
			}
			if (is_single()){
				wp_enqueue_style( 'prettyphoto'); wp_enqueue_script( 'prettyphoto'); 
			}
			if (isset($post->ID)) $template = get_post_meta( $post->ID, '_wp_page_template' ,true );
						
			if (isset($template) && ( $template == 'template-blank.php' || $template == 'template-under-construction.php' || $template == 'template-home.php' ) || is_404()){
				if (class_exists('Ultimate_VC_Addons')) {
					wp_enqueue_script('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-js/ultimate.min.js', array('jquery'),'1');
					wp_enqueue_style('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-css/ultimate.min.css');
					wp_enqueue_script('ultimate-script');
					wp_enqueue_script('ultimate-vc-params');
				}
			}
	  	   
			wp_enqueue_script('blake-IE', BLAKE_JS_PATH.'IE.js', array(), '1',$in_footer = true);
			wp_script_add_data('blake-IE','conditional','lt IE 9');
		}
	}


	/*-----------------------------------------------------------------------------------*/
	/*  FUNCTION FOR INSTALL AND REGISTER THEME PLUGINS
	/*-----------------------------------------------------------------------------------*/
	function blake_register_required_plugins() {
	
		$plugins = array(
	
			// This is an example of how to include a plugin pre-packaged with a theme
				
				array(
					'name'     				=> esc_html('Contact Form 7','blake'), // The plugin name
					'slug'     				=> esc_html('contact-form-7','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/contact-form-7.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),	
				
				array(
					'name'     				=> esc_html('Really Simple CAPTCHA','blake'), // The plugin name
					'slug'     				=> esc_html('really-simple-captcha','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/really-simple-captcha.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),	
				
				array(
					'name'     				=> esc_html('Revolution Slider','blake'), // The plugin name
					'slug'     				=> esc_html('revslider','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/revslider.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
				
				array(
					'name'     				=> esc_html('WPBakery Visual Composer','blake'), // The plugin name
					'slug'     				=> esc_html('js_composer','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/js_composer.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
				
				array(
					'name'     				=> esc_html('Ultimate Addons for Visual Composer','blake'), // The plugin name
					'slug'     				=> esc_html('Ultimate_VC_Addons','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/Ultimate_VC_Addons.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
								
				array(
					'name'     				=> esc_html('Blake Custom Post Types','blake'), // The plugin name
					'slug'     				=> esc_html('blake_custom_post_types','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/blake_custom_post_types.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
				
				array(
					'name'     				=> esc_html('Cube Portfolio','blake'), // The plugin name
					'slug'     				=> esc_html('cubeportfolio','blake'), // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory() . '/lib/plugins/cubeportfolio.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
			
			
		);
	
		// Change this to your theme text domain, used for internationalising strings
		$config = array(
			'domain'       		=> 'blake',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',
			'parent_slug'  => 'themes.php',            			// Parent menu slug.
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required Plugins', 'blake' ),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'blake' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'blake' ), // %1$s = plugin name
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'blake' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'blake' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'blake' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'blake' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'blake' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'blake' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'blake' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'blake' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'blake' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'blake' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'blake' ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'blake' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'blake' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'blake' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa( $plugins, $config );
	
	}
	

	
	/*-----------------------------------------------------------------------------------*/
	/*  THEME REQUIRES
	/*-----------------------------------------------------------------------------------*/
 	if (file_exists(get_stylesheet_directory().'/inc/theme-intro.php')) require_once (get_stylesheet_directory().'/inc/theme-intro.php');
 	else require_once (get_template_directory().'/inc/theme-intro.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-header.php')) require_once (get_stylesheet_directory().'/inc/theme-header.php');
 	else require_once (get_template_directory().'/inc/theme-header.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-walker-menu.php')) require_once (get_stylesheet_directory().'/inc/theme-walker-menu.php');
 	else require_once (get_template_directory().'/inc/theme-walker-menu.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-homeslider.php')) require_once (get_stylesheet_directory().'/inc/theme-homeslider.php');
 	else require_once (get_template_directory().'/inc/theme-homeslider.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-breadcrumb.php')) require_once (get_stylesheet_directory().'/inc/theme-breadcrumb.php');
 	else require_once (get_template_directory().'/inc/theme-breadcrumb.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-menu.php')) require_once (get_stylesheet_directory().'/inc/theme-menu.php');
 	else require_once (get_template_directory().'/inc/theme-menu.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-woocart.php')) require_once (get_stylesheet_directory().'/inc/theme-woocart.php');
 	else require_once (get_template_directory().'/inc/theme-woocart.php');
 	
	
	/*-----------------------------------------------------------------------------------*/
	/*  FUNCTION FOR ONE CLICK FEATURE
	/*-----------------------------------------------------------------------------------*/
	function blake_autoimport($url, $demo) {
		
		$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
		if (!function_exists('WP_Filesystem')){
			$abspath = ($os === "win") ? "\wp-admin\includes\file.php" : "/wp-admin/includes/file.php";
			require_once(ABSPATH.$abspath);
		}
		WP_Filesystem();
		global $wpdb, $wp_filesystem;
		
	    // get the file
	    require_once get_template_directory() . '/lib/classes/upper-content-import.php';
	
	    if ( ! class_exists( 'blake_Auto_Importer' ) )
	        die( 'blake_Auto_Importer not found' );
	
	    // call the function
		$upload_dir = wp_upload_dir();
		$demo_file = $url.$demo."/contents.xml";
		$tempfile = $upload_dir['basedir'] . '/temp.xml' ;
		$data = $wp_filesystem->get_contents($demo_file);
		$result = $wp_filesystem->put_contents($tempfile, $data, FS_CHMOD_FILE);
		
		if ($result){
			$args = array(
	            'file'        => $tempfile,
	            'map_user_id' => 0
	        );
	        blake_auto_import( $args );
		}
	
	}


	/*-----------------------------------------------------------------------------------*/
	/*  HEX TO RGB
	/*-----------------------------------------------------------------------------------*/
	function blake_hex2rgb($hex = "000000") {
		if (is_array($hex)) $hex = "000000";
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}



	function blake_get_string_between($string, $start, $end){
	    $string = " ".$string;
	    $ini = strpos($string,$start);
	    if ($ini == 0) return "";
	    $ini += strlen($start);
	    $len = strpos($string,$end,$ini) - $ini;
	    return substr($string,$ini,$len);
	}
	
	/* Remove VC Modules */
	if (function_exists('vc_remove_element')){
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_posts_slider');
		vc_remove_element('vc_gallery');
		vc_remove_element('vc_images_carousel');
		vc_remove_element('vc_button');
		vc_remove_element('vc_cta_button');
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*  INCLUDE ADDONS IN BLAKE THEME
	/*-----------------------------------------------------------------------------------*/
	function blake_content_shortcoder($post_content){
		
		$dependancy = array('jquery');
		global $vc_addons_url;
			
		if (isset($vc_addons_url) && $vc_addons_url != ""){
			$js_path = 'assets/min-js/';
			$css_path = 'assets/min-css/';
			$ext = '.min';
			$isAjax = true;
			$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
	
			// register js
			wp_register_script('ultimate-script',$vc_addons_url.'assets/min-js/ultimate.min.js',array('jquery', 'jquery-ui-core' ), '1.0', false);
			wp_register_script('ultimate-appear',$vc_addons_url.$js_path.'jquery-appear'.$ext.'.js',array('jquery'), '1.0');
			wp_register_script('ultimate-custom',$vc_addons_url.$js_path.'custom'.$ext.'.js',array('jquery'), '1.0');
			wp_register_script('ultimate-vc-params',$vc_addons_url.$js_path.'ultimate-params'.$ext.'.js',array('jquery'), '1.0');
			if($ultimate_smooth_scroll === 'enable') {
				$smoothScroll = 'SmoothScroll-compatible.min.js';
			}
			else {
				$smoothScroll = 'SmoothScroll.min.js';
			}
			wp_register_script('ultimate-smooth-scroll',$vc_addons_url.'assets/min-js/'.$smoothScroll,array('jquery'),'1.0',true);
			wp_register_script("ultimate-modernizr",$vc_addons_url.$js_path.'modernizr-custom'.$ext.'.js',array('jquery'),'1.0');
			wp_register_script("ultimate-tooltip",$vc_addons_url.$js_path.'tooltip'.$ext.'.js',array('jquery'),'1.0');
	
			// register css
			wp_register_style('ultimate-animate',$vc_addons_url.$css_path.'animate'.$ext.'.css',array(),'1.0');
			wp_register_style('ultimate-style',$vc_addons_url.$css_path.'style'.$ext.'.css',array(),'1.0');
			wp_register_style('ultimate-style-min',$vc_addons_url.'assets/min-css/ultimate.min.css',array(),'1.0');
			wp_register_style('ultimate-tooltip',$vc_addons_url.$css_path.'tooltip'.$ext.'.css',array(),'1.0');
	
			$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
			if($ultimate_smooth_scroll == "enable" || $ultimate_smooth_scroll === 'enable') {
				wp_enqueue_script('ultimate-smooth-scroll');
			}
	
			if(function_exists('vc_is_editor')){
				if(vc_is_editor()){
					wp_enqueue_style('vc-fronteditor',$vc_addons_url.'assets/min-css/vc-fronteditor.min.css');
				}
			}
	
			$ultimate_global_scripts = bsf_get_option('ultimate_global_scripts');
			if($ultimate_global_scripts === 'enable') {
				wp_enqueue_script('ultimate-modernizr');
				wp_enqueue_script('jquery_ui');
				wp_enqueue_script('masonry');
				if(defined('DISABLE_ULTIMATE_GOOGLE_MAP_API') && (DISABLE_ULTIMATE_GOOGLE_MAP_API == true || DISABLE_ULTIMATE_GOOGLE_MAP_API == 'true'))
					$load_map_api = false;
				else
					$load_map_api = true;
				if($load_map_api)
					wp_enqueue_script('googleapis');
				wp_enqueue_script('ultimate-script');
				wp_enqueue_script('ultimate-modal-all');
				wp_enqueue_script('jquery.shake',$vc_addons_url.$js_path.'jparallax'.$ext.'.js');
				wp_enqueue_script('jquery.vhparallax',$vc_addons_url.$js_path.'vhparallax'.$ext.'.js');
	
				wp_enqueue_style('ultimate-style-min');
				wp_enqueue_style("ult-icons");
				wp_enqueue_style('ultimate-vidcons',$vc_addons_url.'assets/fonts/vidcons.css');
				wp_enqueue_script('jquery.ytplayer',$vc_addons_url.$js_path.'mb-YTPlayer'.$ext.'.js');
	
				$Ultimate_Google_Font_Manager = new Ultimate_Google_Font_Manager;
				$Ultimate_Google_Font_Manager->enqueue_selected_ultimate_google_fonts();
	
				return false;
			}
	
			if(!is_404() && !is_search()){
	
				global $post;
	
				if(!$post) return false;
				if(stripos($post_content, 'font_call:'))
				{
					preg_match_all('/font_call:(.*?)"/',$post_content, $display);
					enquque_ultimate_google_fonts_optimzed($display[1]);
				}
				$ultimate_js = "enable";
	
				if ($ultimate_js == 'enable' )
				{
					if( stripos( $post_content, '[swatch_container')
						|| stripos( $post_content, '[ultimate_modal')
					)
					{
						wp_enqueue_script('ultimate-modernizr');
					}
	
					if( stripos( $post_content, '[ultimate_exp_section') ||
						stripos( $post_content, '[info_circle') ) {
						wp_enqueue_script('jquery_ui');
					}
	
					if( stripos( $post_content, '[icon_timeline') ) {
						wp_enqueue_script('masonry');
					}
	
					if($isAjax == true) { // if ajax site load all js
						wp_enqueue_script('masonry');
					}
	
					if( stripos( $post_content, '[ultimate_google_map') ) {
						if(defined('DISABLE_ULTIMATE_GOOGLE_MAP_API') && (DISABLE_ULTIMATE_GOOGLE_MAP_API == true || DISABLE_ULTIMATE_GOOGLE_MAP_API == 'true'))
							$load_map_api = false;
						else
							$load_map_api = true;
						if($load_map_api)
							wp_enqueue_script('googleapis');
					}
	
					if( stripos( $post_content, '[ult_range_slider') ) {
						wp_enqueue_script('jquery-ui-mouse');
						wp_enqueue_script('jquery-ui-widget');
						wp_enqueue_script('jquery-ui-slider');
						wp_enqueue_script('ult_range_tick');
						wp_enqueue_script('ult_ui_touch_punch');
					}
	
					wp_enqueue_script('ultimate-script');
	
					if( stripos( $post_content, '[ultimate_modal') ) {
						wp_enqueue_script('ultimate-modal-all');
					}
				}
				$ultimate_css = "enable";
	
				if ($ultimate_css == "enable"){
					wp_enqueue_style('ultimate-style-min');
					if( stripos( $post_content, '[ultimate_carousel') ) {
						wp_enqueue_style("ult-icons");
					}
				} 
			}
		}
	}	

	/*-----------------------------------------------------------------------------------*/
	/*  REQUIRED FOR WOOCOMMERCE CART
	/*-----------------------------------------------------------------------------------*/
	require_once (get_template_directory().'/inc/theme-woocart.php');
	
	
	function blake_allowed_tags() {
		global $allowedtags, $allowedposttags;
		$allowedtags['option'] = array('style'=>array(), 'id'=>array(), 'name'=>array(), 'class'=>array(), 'value'=>array(), 'selected'=>array());
		$allowedtags['input'] = array('style'=>array(), 'id'=>array(), 'name'=>array(), 'class'=>array(), 'value'=>array(), 'selected'=>array(), 'type'=>array(), 'onchange'=>array(), 'placeholder'=>array());
		$allowedtags['label'] = array('for'=>array());
		$allowedtags['iframe'] = array('style'=>array(), 'src'=>array(), 'allowfullscreen'=>array());
		$allowedposttags['div']['aria-hidden'] = array();
		$allowedposttags['div']['style'] = array();
		$allowedtags = array_merge($allowedtags, $allowedposttags);
	}
	add_action('init', 'blake_allowed_tags', 10);

	function blake_get_the_woo(){
		global $woocommerce;
		return isset($woocommerce) ? $woocommerce : array(); 
	}

	/*-----------------------------------------------------------------------------------*/
	/*  LOAD GOOGLE FONTS
	/*-----------------------------------------------------------------------------------*/
	function blake_fonts_url() {
		global $blake_import_fonts;
		
		$aux = array();
		foreach ($blake_import_fonts as $font){
			$aux[] = str_replace("|", ":", str_replace(" ", "+", $font));
		}
		
		$aux = array_unique($aux);
		
		if(($key = array_search("Helvetica+Neue", $aux)) !== false) {
		    unset($aux[$key]);
		}
		if(($key = array_search("Helvetica", $aux)) !== false) {
		    unset($aux[$key]);
		}
		
		$blake_import_fonts = implode("|", $aux);
	    $font_url = '';
	    /*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'blake' ) ) {
	        $font_url = add_query_arg( 'family', $blake_import_fonts, "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
	
	function blake_google_fonts_scripts() {
	    wp_enqueue_style( 'blake-google-fonts', blake_fonts_url(), '' );
	}

	function blake_get_social_icons(){
		global $howmany_header_social_icons;
		return $howmany_header_social_icons;
	}
	
	function blake_get_custom_inline_css(){
		global $blake_inline_css;
		wp_enqueue_style('blake-custom-style', BLAKE_CSS_PATH .'blake-custom.css',99);
		wp_add_inline_style('blake-custom-style', $blake_inline_css);

	}
	
	function blake_set_custom_inline_css($css){
		global $blake_inline_css;
		$blake_inline_css .= $css;
	}
	
	function blake_set_team_profiles_content($content){
		global $blake_team_profiles;
		if (!isset($blake_team_profiles)) $blake_team_profiles = '';
		$blake_team_profiles .= $content;
	}
	
	function blake_get_team_profiles_content(){
		global $blake_team_profiles;
		if (isset($blake_team_profiles)){
			$blake_team_profiles = wp_kses_no_null( $blake_team_profiles, array( 'slash_zero' => 'keep' ) );
			$blake_team_profiles = wp_kses_js_entities($blake_team_profiles);
			$blake_team_profiles = wp_kses_normalize_entities($blake_team_profiles);
			echo wp_kses_hook($blake_team_profiles, 'post', array());
		}
	}