<?php

/*
* @Author 		ParaTheme
* @Folder	 	Team/Includes
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 	


class class_team_shortcodes  {
	
	
    public function __construct()
    {
		
		add_shortcode( 'team', array( $this, 'team_display' ) );
		//add_shortcode( 'team_single', array( $this, 'team_single_display' ) );


    }
	
	public function team_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'id' => "",
	
					), $atts);
	
				$html = '';
				$post_id = $atts['id'];
	
				$team_themes = get_post_meta( $post_id, 'team_themes', true );
				
				$class_team_functions = new class_team_functions();
				$team_themes_dir = $class_team_functions->team_themes_dir();
				$team_themes_url = $class_team_functions->team_themes_url();

							

				include $team_themes_dir[$team_themes].'/index.php';				
	
				include team_plugin_dir.'/templates/team-grid-custom-css.php';
	
				$html.= '<link  type="text/css" media="all" rel="stylesheet"  href="'.$team_themes_url[$team_themes].'/style.min.css" >';	
	
				return $html;
	
	
	}



	public function team_single_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'themes' => "flat",
	
					), $atts);
	
				$html = '';
				$themes = $atts['themes'];

				
				$class_team_functions = new class_team_functions();
				$team_single_themes_dir = $class_team_functions->team_single_themes_dir();
				$team_single_themes_url = $class_team_functions->team_single_themes_url();

				echo '<link  type="text/css" media="all" rel="stylesheet"  href="'.$team_single_themes_url[$themes].'/style.min.css" >';				

				include $team_single_themes_dir[$themes].'/index.php';				
	
				return $html;
	
	
	}







}


new class_team_shortcodes();

