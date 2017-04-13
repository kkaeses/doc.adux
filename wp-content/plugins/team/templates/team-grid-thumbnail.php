<?php
/*
* @Author 		ParaTheme
* @Folder	 	Team/Templates
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


		if(!empty($team_thumb_url))
			{
				$html_thumb = '';
				
			$html.= '<div style="max-height:'.$team_items_thumb_max_hieght.';" class="team-thumb">';
			
			if($team_items_link_to_post == 'yes')
				{
				$html_thumb.= '<a href="'.get_permalink(get_the_ID()).'"><img src="'.$team_thumb_url.'" /></a>';
				}
			else if($team_items_link_to_post == 'custom')
				{
					if(!empty($team_member_link_to_post))
						{
						$html_thumb.= '<a href="'.$team_member_link_to_post.'"><img src="'.$team_thumb_url.'" /></a>';
						}
					else
						{
						$html_thumb.= '<a href="#"><img src="'.$team_thumb_url.'" /></a>';
						}
					
				}
				
			else if($team_items_link_to_post == 'popup')
				{
				$html_thumb.= '<img teamid="'.get_the_ID().'" class="team-popup" src="'.$team_thumb_url.'" />';
					
				}				
				
			else
				{
				$html_thumb.= '<img src="'.$team_thumb_url.'" />';
				}
			
			$html .= apply_filters( 'team_grid_filter_thumbnail', $html_thumb );
			$html.= '</div>';
			}
