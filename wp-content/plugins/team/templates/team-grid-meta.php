<?php

/*
* @Author 		ParaTheme
* @Folder	 	Team/Templates
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

			
			$html.= '<div class="team-meta" >';
				
			$meta_keys = get_post_meta($post_id, 'team_grid_meta_keys', true );
			$meta_keys = explode(',',$meta_keys);
			
			$html_meta = '';
			
			foreach($meta_keys as $key)
				{
				$html_meta.= '<div class="meta-single" >';
				
				$html_meta.= do_shortcode(get_post_meta(get_the_ID(), $key, true ));
				$html_meta.= '</div>';
				}		
				
			$html .= apply_filters( 'team_grid_filter_meta', $html_meta );	
				
			$html.= '</div>';
	

