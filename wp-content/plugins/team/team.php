<?php
/*
Plugin Name: Team
Plugin URI: http://www.pickplugins.com/item/team-responsive-meet-the-team-grid-for-wordpress/
Description: Fully responsive and mobile ready meet the team showcase plugin for wordpress.
Version: 1.20
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright: 	2015 pickplugins

*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class Team{
	
	public function __construct(){
	
		define('team_plugin_url', plugins_url('/', __FILE__) );
		define('team_plugin_dir', plugin_dir_path( __FILE__ ) );
		define('team_wp_url', 'http://wordpress.org/plugins/team/' );
		define('team_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/team' );
		define('team_pro_url', 'http://www.pickplugins.com/item/team-responsive-meet-the-team-grid-for-wordpress/' );
		define('team_demo_url', 'http://www.pickplugins.com/demo/team/' );
		define('team_conatct_url', 'http://pickplugins.com/contact' );
		define('team_qa_url', 'http://pickplugins.com/questions/' );
		define('team_plugin_name', 'Team' );
		define('team_plugin_version', '1.20' );
		define('team_customer_type', 'free' );	 // pro & free	
		define('team_share_url', 'http://wordpress.org/plugins/team/' );
		define('team_tutorial_video_url', '//www.youtube.com/embed/8OiNCDavSQg?rel=0' );
		define('team_tutorial_doc_url', 'http://pickplugins.com/docs/documentation/team/' );		
		
		include( 'includes/class-post-types.php' );
		include( 'includes/class-post-meta.php' );		
		include( 'includes/class-settings.php' );		
		include( 'includes/class-functions.php' );
		include( 'includes/class-shortcodes.php' );

		include( 'templates/single-team_member-hook.php' );
		include( 'includes/team-functions.php' );
		//include( 'includes/Mobile_Detect.php' );		
		//include( 'includes/mobble.php' );	

		add_action( 'wp_enqueue_scripts', array( $this, 'team_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'team_admin_scripts' ) );
		//add_action( 'admin_footer', array( $this, 'colorpickersjs' ) );				
		//add_action( 'admin_enqueue_scripts', 'wptuts_add_color_picker' );
		
		register_activation_hook( __FILE__, array( $this, 'team_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'team_deactivation' ) );
		//register_uninstall_hook( __FILE__, array( $this, 'team_uninstall' ) );		
		
		add_action( 'plugins_loaded', array( $this, 'team_load_textdomain' ));
		
		add_filter('widget_text', 'do_shortcode');
		}
		
		
	public function team_load_textdomain() {
	  load_plugin_textdomain( 'team', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}

		
	public function team_install(){
		
		team_update_team_member_social_field();
		
		// Reset permalink
		$team_class_post_types= new team_class_post_types();
		$team_class_post_types->team_posttype_team_member();
		flush_rewrite_rules();
		
		
		do_action( 'team_action_install' );
		
		}		
		
	public function team_uninstall(){
		
		do_action( 'team_action_uninstall' );
		}		
		
	public function team_deactivation(){
		
		do_action( 'team_action_deactivation' );
		}
		
		
	public function team_front_scripts(){
			
		wp_enqueue_script('jquery');
		wp_enqueue_script('team_front_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));	
		wp_localize_script('team_front_js', 'team_ajax', array( 'team_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		//wp_enqueue_style('team_front_style', team_plugin_url.'css/style.css'); //ssl issue
		wp_enqueue_style('team_front_style', plugins_url( 'css/style.css', __FILE__ ));
		wp_enqueue_style('single-team-member', plugins_url( 'assets/front/css/single-team-member.css', __FILE__ ));		
		//wp_enqueue_style('owl.carousel', plugins_url( 'css/owl.carousel.css', __FILE__ ));		
		//wp_enqueue_style('owl.theme', plugins_url( 'css/owl.theme.css', __FILE__ ));		
		//wp_enqueue_style('owl.carousel', team_plugin_url.'css/owl.carousel.css');	 //ssl issue
		//wp_enqueue_style('owl.theme', team_plugin_url.'css/owl.theme.css');	//ssl issue
		
		
		//wp_enqueue_script('owl.carousel', plugins_url( '/js/owl.carousel.js' , __FILE__ ) , array( 'jquery' ));		
				
		//wp_enqueue_script('jquery.mixitup.min', plugins_url( '/js/jquery.mixitup.min.js' , __FILE__ ) , array( 'jquery' ));		
		//wp_enqueue_script('jquery.mixitup-pagination', plugins_url( '/js/jquery.mixitup-pagination.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('masonry.pkgd.min', plugins_url( '/js/masonry.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));
		
		//wp_enqueue_script('isotope.pkgd.min', plugins_url( '/js/isotope.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));		
		


		do_action('team_action_front_scripts');
		}		
		
	public function team_admin_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('jquery-ui-droppable');
		
		wp_enqueue_script('team_admin_js', plugins_url( '/js/scripts-admin.js' , __FILE__ ) , array( 'jquery' ));			
		wp_localize_script('team_admin_js', 'team_admin_ajax', array( 'team_admin_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_style('team_admin_style', plugins_url( 'css/style-admin.css', __FILE__ ));	
		//wp_enqueue_style('team_admin_style', team_plugin_url.'css/style-admin.css'); //ssl issue
		
		wp_enqueue_style('font-awesome', plugins_url( 'assets/global/css/font-awesome.css', __FILE__ ));
		
		//wp_enqueue_script('jquery.tablednd', plugins_url( '/js/jquery.tablednd.js' , __FILE__ ) , array( 'jquery' ));

		
		
		//wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'color-picker', plugins_url('/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), true, true );
		
		
		//ParaAdmin
		//wp_enqueue_style('ParaAdmin', team_plugin_url.'ParaAdmin/css/ParaAdmin.css'); //ssl issue
		wp_enqueue_style('ParaAdmin', plugins_url( 'ParaAdmin/css/ParaAdmin.css', __FILE__ ));
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		
		do_action('team_action_admin_scripts');
		}		
		





	}
	
	new Team();
	

	
	