<?php

/*
* @Author 		ParaTheme
* @Folder	 	Team/Templates
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
		

		$title_text = apply_filters( 'team_grid_filter_title', get_the_title() );		
	
	
		if($team_items_link_to_post == 'yes')
			{
			$html.= '<a href="'.get_permalink(get_the_ID()).'"><div class="team-title" style="color:'.$team_items_title_color.';font-size:'.$team_items_title_font_size.'">'.$title_text.'
			</div></a>';
			}
		else if($team_items_link_to_post == 'custom')
			{
		
			if(!empty($team_member_link_to_post))
				{
				$html.= '<a href="'.$team_member_link_to_post.'"><div class="team-title" style="color:'.$team_items_title_color.';font-size:'.$team_items_title_font_size.'">'.$title_text.'
			</div></a>';
				}
			else
				{
				$html.= '<a href="#"><div class="team-title" style="color:'.$team_items_title_color.';font-size:'.$team_items_title_font_size.'">'.$title_text.'
			</div></a>';
				}
			}
			
		else if($team_items_link_to_post == 'popup')
			{
				
				$html.= '<div class="team-title team-popup" ><a teamid="'.get_the_ID().'" class="team-popup" style="color:'.$team_items_title_color.';font-size:'.$team_items_title_font_size.'" href="#">'.$title_text.'</a>
			</div>';
			
			
			
			
			$content = apply_filters('the_content', get_the_content());
			
			
			if($team_items_popup_content=='full')
				{
					$popup_content = $content;
				}
			elseif($team_items_popup_content=='excerpt')
				{
					$popup_content = wp_trim_words( $content , $team_items_popup_excerpt_count, ' <a style="color:'.$team_items_content_color.';" class="read-more" href="'. get_permalink() .'">'.$team_items_popup_excerpt_text.'</a>' );
				}

				
	
			}
			
			
						
		else
			{
			$html.= '<div class="team-title" style="color:'.$team_items_title_color.';font-size:'.$team_items_title_font_size.'">'.$title_text.'</div>';
			}
			
			

