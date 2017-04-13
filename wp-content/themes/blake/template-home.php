<?php
/*
Template Name: Homepage Template
*/

get_header(); blake_print_menu(false);

	$this_page_id = get_the_ID();

	$homeType = get_post_meta($this_page_id, 'homeStyle_value', true);
	switch($homeType){
		case "slider":
			if (get_post_meta($this_page_id, 'parallaxEffect_value', true) == 'yes') blake_print_slider($this_page_id, true);
			else blake_print_slider($this_page_id);
		break;
		case "image": case "video":
			?>
			<section id="home" class="homepage_parallax <?php echo esc_attr($homeType); if (get_post_meta($this_page_id, 'parallaxEffect_value', true) == 'yes') echo " parallax"; ?>">
				<?php
					if ($homeType == "image"){
						$media = get_post_meta($this_page_id, 'homeParallaxMedia_value', true);
						$media = explode("|!|",$media);
						?>
						<div id="parallax-home" <?php if (get_post_meta($this_page_id, 'parallaxEffect_value', true) == 'yes') echo 'class="parallax" data-stellar-background-ratio="0.5" '; ?> style="background-image: url(<?php echo esc_url($media[1]); ?>);background-size:cover;text-align:center;">
							<div class="parallax-overlay parallax-overlay-pattern"></div>
							<?php blake_print_intro($this_page_id); ?>
						</div>
						<?php
					} else {
						?>
						<div id="parallax-home" <?php if (get_post_meta($this_page_id, 'parallaxEffect_value', true) == 'yes') echo 'class="parallax" data-stellar-ratio="0.5"'; ?>>
							<?php blake_print_intro($this_page_id, true); ?>
							
							<?php
								if (get_post_meta($this_page_id, 'homeVideoSource_value', true) != 'youtube'){
									?>
									<div class="video-container <?php if (get_post_meta($this_page_id, 'parallaxEffect_value', true) == 'yes') echo 'parallax'; ?>">
									<?php
									$media = get_post_meta($this_page_id, 'homeParallaxMedia_video_value', true);
									$media = explode("|!|",$media);
									$controls = (get_post_meta($this_page_id, 'homeVideoControls_value', true) == 'yes') ? "true" : "false";
									echo do_shortcode("[video src='".$media[1]."' preload='true' autoplay='true' loop='true' controls='".$controls."']");
									?>
									</div>
									<?php
								}
							?>
						</div>
						<?php
						if (get_post_meta($this_page_id, 'homeVideoSource_value', true) == 'youtube'){
							$controls = (get_post_meta($this_page_id, 'homeVideoControls_value', true) == 'yes') ? "true" : "false";
							?>
							<div class="player" style="display:block; margin: auto; background: rgba(0,0,0,0.5)" data-property="{videoURL:'<?php echo esc_url(get_post_meta($this_page_id, 'homeYoutubeLink_value', true)); ?>',  optimizeDisplay:true, showControls:<?php echo esc_attr($controls); ?>,containment:'#parallax-home',startAt:0,mute:<?php echo (get_post_meta($this_page_id,'homeVideoMuted_value', true) == 'yes') ? "true" : "false"; ?>,autoPlay:true,player:true,loop:true,opacity:1,stopMovieOnBlur:true}"></div>

							<?php
						}
					}
				
				$blake_inline_script = '
					jQuery(document).ready(function(){
						if (jQuery(".homepage_parallax #home-slider").length){
							jQuery(".home-slide").each(function(){
							    contentSize = jQuery(this).find(".home-slide-content");
						        contentSize.fitText(1);
							});
							jQuery("#home-slider.flexslider").flexslider({
								animation: "swing",
								direction: "vertical",
								slideshow: true,
								slideshowSpeed: 3500,
								animationDuration: 1000,
								directionNav: false,
								controlNav: true,
								smootheHeight: true
							});
						}
					});
				';
				wp_add_inline_script('blake', $blake_inline_script, 'after');
				?>
			</section>
			<div class="clear"></div>
			<?php
		break;
	}
	
	$thepost = get_post($this_page_id);
	?>
	<section class="page_content section_page-<?php echo esc_attr($this_page_id); ?>" id="section_page-<?php echo esc_attr($this_page_id); ?>" data-section-title="<?php echo esc_attr($thepost->post_title); ?>">
		<div class="container">
		<?php
			if (vc_is_inline()){
				wp_reset_query();
				the_content();
			} else {
				$content = wpb_js_remove_wpautop($thepost->post_content, true);
				if(stripos($thepost->post_content, 'font_call:')){
					preg_match_all('/font_call:(.*?)"/',$thepost->post_content, $display);
					enquque_ultimate_google_fonts_optimzed($display[1]);
				}
				echo do_shortcode($thepost->post_content);
				/* check the content for ultimate addons shortcodes */
				blake_content_shortcoder($thepost->post_content);
				/* custom element css */
				$shortcodes_custom_css = get_post_meta( $this_page_id, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					blake_set_custom_inline_css($shortcodes_custom_css);
				}
			}
		?>
		</div>
	</section>
	<?php
		
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
	
	if (!empty($theMenu)){
		$args = array(
	        'order'                  => 'ASC',
	        'orderby'                => 'menu_order',
	        'post_type'              => 'nav_menu_item',
	        'post_status'            => 'publish',
	        'output'                 => ARRAY_A,
	        'output_key'             => 'menu_order',
	        'nopaging'               => true,
	        'update_post_term_cache' => false 
	    );
		$items = wp_get_nav_menu_items( $theMenu->slug, $args );
		
		$outsiders = array();
		//$firstHome = true;
		foreach ($items as $i){
			$thisID = $i->object_id;
			$template = get_post_meta($thisID, '_wp_page_template', true);
			
			if ($this_page_id != $thisID){
				if ($template === "one-page-template.php"){
					$thepost = get_post($thisID);
					?>
					<section class="page_content section_page-<?php echo esc_attr($thisID); ?>" id="section_page-<?php echo esc_attr($thisID); ?>" data-section-title="<?php echo esc_attr($thepost->post_title); ?>">
						<div class="container">
						<?php
							$content = wpb_js_remove_wpautop($thepost->post_content, true);
							if(stripos($thepost->post_content, 'font_call:')){
								preg_match_all('/font_call:(.*?)"/',$thepost->post_content, $display);
								enquque_ultimate_google_fonts_optimzed($display[1]);
							}
							
							/* check the content for ultimate addons shortcodes */
							blake_content_shortcoder($thepost->post_content);
							
							echo do_shortcode($thepost->post_content);
							
							/* custom element css */
							$shortcodes_custom_css = get_post_meta( $thisID, '_wpb_shortcodes_custom_css', true );
							if ( ! empty( $shortcodes_custom_css ) ) {
								blake_set_custom_inline_css($shortcodes_custom_css);
							}
						?>
						</div>
					</section>
					<?php
				} else {
					array_push($outsiders, $thisID);
				}	
			}
			
		}
	}
		
	?>
	
		    		
<?php get_footer(); ?>