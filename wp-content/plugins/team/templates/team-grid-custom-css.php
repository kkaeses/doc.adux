<?php

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	$html .= '<style type="text/css">';
	
	$html .= '
	
	.team-container-'.$post_id.'{
		background:'.$team_container_bg_color.' url('.$team_bg_img.') repeat scroll 0 0;
		text-align:'.$team_grid_item_align.';
		
		}
	
	';	
	
	$html .= '#team-'.$post_id.' .team-item{
			
			text-align:'.$team_item_text_align.';
			margin:'.$team_items_margin.';
			}
			';	

	$html .= '
	@media only screen and (min-width: 1024px ) {
	#team-'.$post_id.' .team-item{width:'.$team_items_max_width.'}
	
	}
	
	@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
	#team-'.$post_id.' .team-item{width:'.$team_items_width_tablet.'}
	}
	
	@media only screen and ( min-width: 320px ) and ( max-width: 767px ) {
	#team-'.$post_id.' .team-item{width:'.$team_items_width_mobile.'}
	}';

	
	
	
	
	
	
		if(!empty($team_items_custom_css))
			{
				$html .= $team_items_custom_css;	
			}
	
	
	
		if(!empty($team_pagination_bg_color))
			{
				$html .= '
				.paginate .page-numbers {
				background: none repeat scroll 0 0 '.$team_pagination_bg_color.' !important;
				}
				';	
			}
			
		if(!empty($team_pagination_active_bg_color))
			{
				$html .= '
				.team-container .paginate .current, .team-container .paginate .page-numbers:hover{
				background: none repeat scroll 0 0 '.$team_pagination_active_bg_color.' !important;
				}
				';	
			}
	
	
		if(!empty($team_items_social_icon_width) || !empty($team_items_social_icon_height))
			{
				$html .= '
				
						#team-'.$post_id.' .team-social span {
						  width: '.$team_items_social_icon_width.' !important;
						  height:'.$team_items_social_icon_height.' !important;
						}
						';	
			}
	
	
		
	$html .= '</style>';
	