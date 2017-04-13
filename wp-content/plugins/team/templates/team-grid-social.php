<?php

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
		
			$html.= '<div class="team-social '.$team_social_icon_style.'" >';
			
			
			$team_member_social_field = get_option( 'team_member_social_field' );
			
			if(empty($team_member_social_field))
				{
					$team_member_social_field = array("skype"=>"skype","email"=>"email","website"=>"website", "facebook"=>"facebook","twitter"=>"twitter","googleplus"=>"googleplus","pinterest"=>"pinterest");
					
				}
			
			$html_social = '';
			
            foreach ($team_member_social_field as $field_key=>$field_info) {
				
				
                if(!empty($field_key) && !empty($team_member_social_links[$field_key]))
                    {
						
						if(!empty($team_member_social_field[$field_key]['icon']))
							{
							$icon_bg = 'style="background-image:url('.$team_member_social_field[$field_key]['icon'].')"';
							}
						else
							{
							$icon_bg = '';
							}
						
						
					
					
					if($field_key == 'website')
						{
							$html_social.= '<span '.$icon_bg.' class="website">
								<a target="_blank" href="'.$team_member_social_links[$field_key].'"></a>
							</span>';
						}
					elseif($field_key == 'email')
						{
							$html_social.= '<span '.$icon_bg.' class="email">
								<a href="mailto:'.$team_member_social_links[$field_key].'"></a>
							</span>';
						}
						
					elseif($field_key == 'skype')
						{
							$html_social.= '<span '.$icon_bg.' class="skype">
								<a  title="'.$field_key.'" href="skype:'.$team_member_social_links[$field_key].'"></a>
							</span>';
						}
						
					elseif($field_key == 'mobile')
						{
							$html_social.= '<span '.$icon_bg.' class="mobile">
								<a  title="'.$field_key.'" href="tel:'.$team_member_social_links[$field_key].'"></a>
							</span>';
						}
						
						
					elseif($field_key == 'phone')
						{
							$html_social.= '<span '.$icon_bg.' class="mobile">
								<a  title="'.$field_key.'" href="tel:'.$team_member_social_links[$field_key].'"></a>
							</span>';
						}						
											
						
					else
						{
							$html_social.= '<span '.$icon_bg.' class="'.$field_key.'" >
								<a target="_blank" href="'.$team_member_social_links[$field_key].'"> </a>
							</span>';
						}					
						

                    
                    }
            }

			$html .= apply_filters( 'team_grid_filter_social', $html_social );

			$html.= '</div>';
			