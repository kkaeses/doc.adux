<?php
function blake_styles(){

	 if (!is_admin()){
		
		wp_enqueue_style('blake-blog', BLAKE_CSS_PATH .'blog.css'); 
	 	wp_enqueue_style('blake-bootstrap', BLAKE_CSS_PATH .'bootstrap.css');
		wp_enqueue_style('blake-icons', BLAKE_CSS_PATH .'icons-font.css');
		wp_enqueue_style('blake-component', BLAKE_CSS_PATH .'component.css');
		
		wp_enqueue_style('blake-IE', BLAKE_CSS_PATH .'IE.css');	
		wp_style_add_data('blake-IE','conditional','lt IE 9');
		
		wp_enqueue_style('blake-editor', get_template_directory_uri().'/editor-style.css');
		wp_enqueue_style('blake-woo-layout', BLAKE_CSS_PATH .'blake-woo-layout.css');
		wp_enqueue_style('blake-woo', BLAKE_CSS_PATH .'blake-woocommerce.css');
		wp_enqueue_style('blake-ytp', BLAKE_CSS_PATH .'mb.YTPlayer.css');
		wp_enqueue_style('blake-retina', BLAKE_CSS_PATH .'retina.css');
		
	}
}
add_action('wp_enqueue_scripts', 'blake_styles', 1);

?>