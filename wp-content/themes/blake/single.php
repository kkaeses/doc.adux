<?php
/**
 * @package WordPress
 * @subpackage Blake
 */

get_header(); blake_print_menu(); ?>
	
	<?php 
		if (have_posts()) {
			the_post(); 
			$type = get_post_type();
			$portfolio_permalink = get_option("blake_portfolio_permalink");
			switch ($type){
				case "post":
					get_template_part('post-single', 'single');
				break;
				case $portfolio_permalink:
					get_template_part('proj-single', 'single');
				break;
				default:
					the_content();
				break;
			}
		}
	?>
	
<?php get_footer(); ?>