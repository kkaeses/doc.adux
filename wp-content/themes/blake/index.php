<?php
/**
 * @package WordPress
 * @subpackage Blake
 */
	get_header();
	
		$blake_reading_option = get_option("blake".'_blog_reading_type');
		$blake_more = 0; 
	
		$menuLocations = get_nav_menu_locations();
		
		$menuID = 0;
		if (isset($menuLocations['PrimaryNavigation'])){
			$menuID = $menuLocations['PrimaryNavigation'];
		}
		$theMenus = wp_get_nav_menus($menuID);
		$theMenu = array();
		
		for ($idx = 0; $idx < count($theMenus); $idx++){
			if ($theMenus[$idx]->term_id == $menuID){
				$theMenu = $theMenus[$idx];
			}
		}
	
		define('BLAKE_IS_FIRST_PAGE', true);		
		get_template_part('blog-template');
	
?>

<div class="clear"></div>
	
	
<?php get_footer(); ?>