<?php
/**
 * @package WordPress
 * @subpackage Blake
 */

get_header(); ?>

	
	<?php if ( have_posts() ) {
		while ( have_posts() ){
			the_post(); 
				$type = get_post_type();
		} }
		if ($type === "post") get_template_part('post-archive', 'archive');
		?>

	
<?php get_footer(); ?>