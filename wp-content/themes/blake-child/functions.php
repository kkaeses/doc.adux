<?php

	if (!defined('UPPER_SHORTNAME')) define('UPPER_SHORTNAME', 'blake');


	function my_search_filter( $query ){
   		if ( $query->is_search ){
        		$query->set( 'category__not_in','news' );
   		 }
   	return $query;
	}
	add_filter('pre_get_posts','my_search_filter');





function cool_scripts(){
	wp_enqueue_script('cool-stuff', get_stylesheet_directory_uri() . '/js/script.js',  array('jquery'), '1.0.0',true);
}
add_action('wp_enqueue_scripts','cool_scripts');


if (! function_exists( 'exclure_pages_recherche' ) ):
/*
** Exclut les pages de la recherche Wordpress
** Retourne seulement les articles
*/
function exclure_pages_recherche($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','exclure_pages_recherche');
endif;
?>
