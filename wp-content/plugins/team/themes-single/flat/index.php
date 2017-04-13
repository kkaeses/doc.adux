<?php

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit; // if direct access  


	$post_id = get_the_ID();
	include team_plugin_dir.'/templates/team-grid-variables.php';
	
	$team_member_position = get_post_meta(get_the_ID(), 'team_member_position', true );
	$team_member_social_links = get_post_meta( get_the_ID(), 'team_member_social_links', true );

	$team_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$team_thumb_url = $team_thumb['0'];
	
	$team_items_content='full';


	$html = '';
	$html.= '<div class="team-meamber-single">';
	
	//include team_plugin_dir.'/templates/team-grid-thumbnail.php';
	//include team_plugin_dir.'/templates/team-grid-title.php';	
	include team_plugin_dir.'/templates/team-grid-position.php';	
	include team_plugin_dir.'/templates/team-grid-social.php';
	$html.= '<div class="team-content">'.get_the_content().'</div>';	
	
	//include team_plugin_dir.'/templates/team-grid-skill.php';	
	
	$html.= '</div>';	
	