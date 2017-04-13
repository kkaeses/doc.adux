<?php

/*
* @Author 		ParaTheme
* @Folder	 	Team/Templates
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/
if ( ! defined('ABSPATH')) exit; // if direct access  



		global $wp_query;
		
		if(($team_content_source=="latest"))
			{
			
				$wp_query = new WP_Query(
					array (
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,
						'posts_per_page' => $team_total_items,
						'paged' => $paged,
						
						) );
			
			
			}		
		
	

		elseif(($team_content_source=="year"))
			{
			
				$wp_query = new WP_Query(
					array (
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,
						'year' => $team_content_year,
						'posts_per_page' => $team_total_items,
						'paged' => $paged,
						) );

			}

		elseif(($team_content_source=="month"))
			{
			
				$wp_query = new WP_Query(
					array (
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,
						'year' => $team_content_month_year,
						'monthnum' => $team_content_month,
						'posts_per_page' => $team_total_items,
						'paged' => $paged,
						
						) );

			}

		elseif($team_content_source=="taxonomy")
			{
				$wp_query = new WP_Query(
					array (
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,						
						'posts_per_page' => $team_total_items,
						'paged' => $paged,
						
						'tax_query' => array(
							array(
								   'taxonomy' => $team_taxonomy,
								   'field' => 'id',
								   'terms' => $team_taxonomy_terms,
							)
						)
						
						) );
			}


		
		elseif(($team_content_source=="post_id"))
			{
			
				$wp_query = new WP_Query(
					array (
						'post__in' => $team_post_ids,
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,
						'posts_per_page' => $team_total_items,
						'paged' => $paged,

						) );
			
			
			}
		else
			{
			
				$wp_query = new WP_Query(
					array (
						'post_type' => $team_posttype,
						'orderby' => $team_query_orderby,
						'order' => $team_query_order,
						'posts_per_page' => $team_total_items,
						'paged' => $paged,
						
						) );
			
			
			}
			

