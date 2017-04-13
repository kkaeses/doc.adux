<?php
/**
 * @package WordPress
 * @subpackage Blake
 */
?>
	
	<div id="big_footer">

		<?php
		if (get_option("blake_show_primary_footer") == "on"){
			?>
			<div id="primary_footer">
		    	<div class="container">
			    	<?php
			    	/* Show Newsletter in Footer */
					if (get_option("blake_newsletter_enabled") == "on"){
						$code = get_option("blake_mailchimp_code");
						if (!empty($code)){
						    $output = '<div class="newsletter_shortcode footer_newsletter"><div class="mail-box"><div class="mail-news"><div class="news-l"><div class="banner"><h3>'.sprintf(esc_html("%s", "blake"), get_option("blake_newsletter_text")).'</h3><p>'.sprintf(esc_html("%s", "blake"), get_option("blake_newsletter_stext")).'</p></div><div class="form">';
							$output .= stripslashes($code);
							$output .= '</div></div></div></div></div>';			
						} else {
							$output = '<div class="newsletter_shortcode">'.esc_html__('You need to fill the inputs on the Appearance > Blake Options > Newsletter panel in order to work.','blake').'</div>';
						}			
						$output = wp_kses_no_null( $output, array( 'slash_zero' => 'keep' ) );
						$output = wp_kses_js_entities($output);
						$output = wp_kses_normalize_entities($output);
						echo wp_kses_hook($output, 'post', array()); // WP changed the order of these funcs and added args to wp_kses_hook		
					
					}?>	
	    		<?php
	    		
					if(get_option("blake_footer_number_cols") == "one"){ ?>
						<div class="footer_sidebar col-xs-12 col-md-12"><?php blake_print_sidebar('footer-one-column'); ?></div>
					<?php }
					if(get_option("blake_footer_number_cols") == "two"){ ?>
						<div class="footer_sidebar col-xs-12 col-md-6"><?php blake_print_sidebar('footer-two-column-left'); ?></div>
						<div class="footer_sidebar col-xs-12 col-md-6"><?php blake_print_sidebar('footer-two-column-right'); ?></div>
					<?php }
					if(get_option("blake_footer_number_cols") == "three"){
						if(get_option("blake_footer_columns_order") == "one_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-three-column-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-three-column-center'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-three-column-right'); ?></div>
						<?php }
						if(get_option("blake_footer_columns_order") == "one_two_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-three-column-left-1_3'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php blake_print_sidebar('footer-three-column-right-2_3'); ?></div>
						<?php }
						if(get_option("blake_footer_columns_order") == "two_one_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php blake_print_sidebar('footer-three-column-left-2_3'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-three-column-right-1_3'); ?></div>
						<?php }
					}
					if(get_option("blake_footer_number_cols") == "four"){
						if(get_option("blake_footer_columns_order_four") == "one_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-center-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-center-right'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-right'); ?></div>
						<?php }
						if(get_option("blake_footer_columns_order_four") == "two_one_two_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-left-1_2_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-6"><?php blake_print_sidebar('footer-four-column-center-2_2_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php blake_print_sidebar('footer-four-column-right-1_2_4'); ?></div>
						<?php }
						if(get_option("blake_footer_columns_order_four") == "three_one_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php blake_print_sidebar('footer-four-column-left-3_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-four-column-right-1_4'); ?></div>
						<?php }
						if(get_option("blake_footer_columns_order_four") == "one_three_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php blake_print_sidebar('footer-four-column-left-1_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php blake_print_sidebar('footer-four-column-right-3_4'); ?></div>
						<?php }
					}
				?>
				</div>
		    </div>
			<?php
		}
	?>
    
    <?php
	    if (get_option("blake_show_sec_footer") == "on"){
		    ?>
		    <div id="secondary_footer">
				<div class="container">
					
					<?php
						/* FOOTER LOGOTYPE */
						if (get_option("blake_footer_display_logo") == 'on'){
						?>
						<a class="footer_logo align-<?php echo esc_attr(get_option("blake_footer_logo_alignment")); ?>" href="<?php echo esc_url(home_url("/")); ?>" tabindex="-1">
				        	<?php
				    			$alone = true;
			    				if (get_option("blake_footer_logo_retina_image_url") != ""){
				    				$alone = false;
			    				}
		    					?>
		    					<img class="footer_logo_normal <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" src="<?php echo esc_url(get_option("blake_footer_logo_image_url")); ?>" alt="<?php esc_attr_e("", "blake"); ?>" title="<?php esc_attr_e("", "blake"); ?>">
			    					
			    				<?php 
			    				if (get_option("blake_footer_logo_retina_image_url") != ""){
			    				?>
				    				<img class="footer_logo_retina" style="display:none; position: relative;" src="<?php echo esc_url(get_option("blake_footer_logo_retina_image_url")); ?>" alt="<?php esc_attr_e("", "blake"); ?>" title="<?php esc_attr_e("", "blake"); ?>">
			    				<?php
		    					}
			    			?>
				        </a>
						<?php
						}
						
						/* FOOTER CUSTOM TEXT */
						if (get_option("blake_footer_display_custom_text") == "on"){
						?>
						<div class="footer_custom_text <?php echo esc_attr(get_option("blake_footer_custom_text_alignment")); ?>"><?php echo do_shortcode(stripslashes(get_option("blake_footer_custom_text"))); ?></div>
						<?php
						}
						
						/* FOOTER SOCIAL ICONS */
						if (get_option("blake_footer_display_social_icons") == "on"){
						?>
						<div class="social-icons-fa align-<?php echo esc_attr(get_option("blake_footer_social_icons_alignment")); ?>">
					        <ul>
							<?php
								$icons = array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"));
								foreach ($icons as $i){
									if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
									?>
									<li>
										<a href="<?php echo esc_url(get_option("blake_icon-".$i[0])); ?>" target="_blank" class="<?php echo esc_attr(strtolower($i[0])); ?>" title="<?php echo esc_attr($i[1]); ?>"><i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i></a>
									</li>
									<?php
									}
								}
							?>
						    </ul>
						</div>
						<?php
						}
						
						
					?>
				</div>
			</div>
		    <?php
	    }
    ?>
	</div>

<?php

/* sets the type of pagination [scroll, autoscroll, paged, default] */
wp_reset_query();
$blake_reading_option = get_option('blake_blog_reading_type');
if (is_archive() || is_single() || is_search() || is_page_template('blog-template.php') || is_page_template('blog-masonry-template.php')) {

	$nposts = get_option('posts_per_page');

	$blake_more = 0;
	$blake_pag = 0;

	$orderby="";
	$category="";
	$nposts = "";
	$order = "";

	$blake_pag = $wp_query->query_vars['paged'];
	if (!is_numeric($blake_pag)) $blake_pag = 1;
	$max = 0;

	switch ($blake_reading_option){
		case "scrollauto": 

				// Add code to index pages.
				if( !is_singular() ) {	

					if (is_search()){

						$blake_reading_option = get_option('blake_blog_reading_type');
						$se = get_option("blake_enable_search_everything");

						$nposts = get_option('posts_per_page');

						$blake_pag = $wp_query->query_vars['paged'];
						if (!is_numeric($blake_pag)) $blake_pag = 1;

						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $blake_pag,
								's' => esc_html($_GET['s'])
							);

						    $blake_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $blake_pag,
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);

						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $blake_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

						    $blake_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $blake_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);
						}

						$max = ceil($counter->post_count / $nposts);
						$blake_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

					} else {

						// What page are we on? And what is the pages limit?
						$max = $wp_query->max_num_pages;
						$blake_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

					}
					
					$blake_inline_script = '
						jQuery(document).ready(function($){
							if (jQuery("#reading_option").html() === "scrollauto" && !jQuery("body").hasClass("single")){ 
								window.blake_loadingPoint = 0;
								//monitor page scroll to fire up more posts loader
								window.clearInterval(window.blake_interval);
								window.blake_interval = setInterval("blake_monitorScrollTop()", 1000 );
							}
						});
					';
					wp_add_inline_script('blake', $blake_inline_script, 'after');

				} else {

				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'paged' => $blake_pag,
	    				'post_status' => 'publish'
	    			);

	    		    $blake_the_query = new WP_Query( $args );

		    		$max = $blake_the_query->max_num_pages;
		    		$blake_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

		    		$blake_inline_script = '
						jQuery(document).ready(function($){
							if (jQuery("#reading_option").html() === "scrollauto" && !jQuery("body").hasClass("single")){ 
								window.blake_loadingPoint = 0;
								//monitor page scroll to fire up more posts loader
								window.clearInterval(window.blake_interval);
								window.blake_interval = setInterval("blake_monitorScrollTop()", 1000 );
							}
						});
					';
					wp_add_inline_script('blake', $blake_inline_script, 'after');

	    		}
			break;
		case "scroll": 

				// Add code to index pages.
				if( !is_singular() ) {	

					if (is_search()){

						$nposts = get_option('posts_per_page');

						$se = get_option("blake_enable_search_everything");

						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $blake_pag,
								's' => esc_html($_GET['s'])
							);

						    $blake_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $blake_pag,
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);

						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $blake_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

						    $blake_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $blake_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);
						}

						$max = ceil($counter->post_count / $nposts);
						$blake_pag = 1;

						$blake_pag = $wp_query->query_vars['paged'];
						if (!is_numeric($blake_pag)) $blake_pag = 1;

					} else {
						// What page are we on? And what is the pages limit?
						$max = $wp_query->max_num_pages;
						$blake_paged = $blake_pag;

					}


				} else {

					$orderby = "";
					$category = "";

				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'post_status' => 'publish'
	    			);

	    		    $blake_the_query = new WP_Query( $args );


		    		$max = $blake_the_query->max_num_pages;
		    		$blake_pag = 1;

					$blake_pag = $wp_query->query_vars['paged'];
					if (!is_numeric($blake_pag)) $blake_pag = 1;		    			    				
	    		}

			break;
	}
	?>
	<div class="blake_helper_div" id="loader-startPage"><?php echo esc_html($blake_pag); ?></div>
	<div class="blake_helper_div" id="loader-maxPages"><?php echo esc_html($max); ?></div>
	<div class="blake_helper_div" id="loader-nextLink"><?php echo next_posts($max, false); ?></div>
	<div class="blake_helper_div" id="loader-prevLink"><?php echo previous_posts($max, false); ?></div>
	<?php
}

$blake_styleColor = "#".esc_html(get_option("blake_style_color"));
$bodyLayoutType = get_option("blake_body_layout_type");
$headerType = get_option("blake_header_type");
?>
<div id="bodyLayoutType" class="blake_helper_div"><?php echo esc_html($bodyLayoutType); ?></div>
<div id="headerType" class="blake_helper_div"><?php echo esc_html($headerType); ?></div>
<?php 
	if (get_option("blake_body_shadow") == "on"){
		?>
			<div id="bodyShadowColor" class="blake_helper_div"><?php echo "#".esc_html(get_option("blake_body_shadow_color")); ?></div>
		<?php
	}
	$headerStyleType = get_option("blake_header_style_type");
?>
<div id="templatepath" class="blake_helper_div"><?php echo esc_url(get_template_directory_uri())."/"; ?></div>
<div id="homeURL" class="blake_helper_div"><?php echo esc_url(home_url("/")); ?>/</div>
<div id="styleColor" class="blake_helper_div"><?php echo "#".esc_html(get_option("blake_style_color")); ?></div>	
<div id="headerStyleType" class="blake_helper_div"><?php echo esc_html($headerStyleType); ?></div>
<div class="blake_helper_div" id="reading_option"><?php 
	if ($blake_reading_option == "scrollauto"){
		$detect = new Mobile_Detect();
		if ($detect->isMobile())
			$blake_reading_option = "scroll";
	}
	echo esc_html($blake_reading_option); 
?></div>
<div class="blake_helper_div" id="blake_no_more_posts_text"><?php printf(esc_html__("%s", "blake"), get_option('blake_no_more_posts_text')); ?></div>
<div class="blake_helper_div" id="blake_load_more_posts_text"><?php printf(esc_html__("%s", "blake"), get_option('blake_load_more_posts_text'));  ?></div>
<div class="blake_helper_div" id="blake_loading_posts_text"><?php printf(esc_html__("%s", "blake"), get_option('blake_loading_posts_text'));  ?></div>
<div class="blake_helper_div" id="blake_links_color_hover"><?php echo esc_html(get_option('blake_links_color_hover')); ?></div>
<div class="blake_helper_div" id="blake_enable_images_magnifier"><?php echo esc_html(get_option('blake_enable_images_magnifier')); ?></div>
<div class="blake_helper_div" id="blake_thumbnails_hover_option"><?php echo esc_html(get_option('blake_thumbnails_hover_option')); ?></div>
<div id="homePATH" class="blake_helper_div"><?php echo ABSPATH; ?></div>
<div class="blake_helper_div" id="blake_menu_color">#<?php echo esc_html(get_option("blake_menu_color")); ?></div>
<div class="blake_helper_div" id="blake_fixed_menu"><?php echo esc_html(get_option("blake_fixed_menu")); ?></div>
<div class="blake_helper_div" id="blake_thumbnails_effect"><?php if (get_option("blake_animate_thumbnails") == "on") echo esc_html(get_option("blake_thumbnails_effect")); else echo "none"; ?></div>
<div class="blake_helper_div loadinger">
	<img alt="loading" src="<?php echo esc_url(get_template_directory_uri()). '/images/ajx_loading.gif' ?>">
</div>
<div class="blake_helper_div" id="permalink_structure"><?php echo esc_html(get_option('permalink_structure')); ?></div>
<div class="blake_helper_div" id="headerstyle3_menucolor">#<?php echo esc_html(get_option("blake_menu_color")); ?></div>
<div class="blake_helper_div" id="disable_responsive_layout"><?php echo esc_html(get_option('blake_disable_responsive')); ?></div>
<div class="blake_helper_div" id="filters-dropdown-sort"><?php esc_html_e('Sort Gallery','blake'); ?></div>
<div class="blake_helper_div" id="templatepath"><?php echo esc_url(get_template_directory_uri()); ?></div>
<div class="blake_helper_div" id="searcheverything"><?php echo esc_html(get_option("blake_enable_search_everything")); ?></div>
<div class="blake_helper_div" id="blake_header_shrink"><?php if (get_option('blake_fixed_menu') == 'on'){if (get_option('blake_header_after_scroll') == 'on'){if (get_option('blake_header_shrink_effect') == 'on'){echo "yes";} else echo "no";}} ?></div>
<div class="blake_helper_div" id="blake_header_after_scroll"><?php if (get_option('blake_fixed_menu') == 'on'){if (get_option('blake_header_after_scroll') == 'on'){echo "yes";} else echo "no";} ?></div>
<div class="blake_helper_div" id="blake_grayscale_effect"><?php echo esc_html(get_option("blake_enable_grayscale")); ?></div>
<div class="blake_helper_div" id="blake_enable_ajax_search"><?php echo esc_html(get_option("blake_enable_ajax_search")); ?></div>
<div class="blake_helper_div" id="blake_menu_add_border"><?php echo esc_html(get_option("blake_menu_add_border")); ?></div>
<div class="blake_helper_div" id="blake_newsletter_input_text"><?php echo esc_html(get_option('blake_newsletter_input_text')); ?></div>
<div class="blake_helper_div" id="blake_content_to_the_top"><?php echo esc_html(get_option('blake_content_to_the_top')); ?></div>
<div class="blake_helper_div" id="blake_update_section_titles"><?php echo esc_html(get_option('blake_update_section_titles')); ?></div>
<?php 
	$standardfonts = array('Arial','Arial Black','Helvetica','Helvetica Neue','Courier New','Georgia','Impact','Lucida Sans Unicode','Times New Roman', 'Trebuchet MS','Verdana','');
	$importfonts = "";
	$blake_import_fonts = blake_get_import_fonts();

	foreach ($blake_import_fonts as $font){
		if (!in_array($font,$standardfonts)){
			$font = str_replace(" ","+",str_replace("|",":",$font));
			if ($importfonts=="") $importfonts .= $font;
			else {
				if (strpos($importfonts, $font) === false)
					$importfonts .= "|{$font}";
			}
		}
	}

	if ($importfonts!="") {
		$blake_import_fonts = $importfonts;
		blake_set_import_fonts($blake_import_fonts);
		blake_google_fonts_scripts();
	}
	
	$howmany_header_social_icons = blake_get_social_icons();
	$blake_style_inline = "header .header_social_icons, header .header_social_icons_wrapper{min-width:".esc_attr($howmany_header_social_icons*25)."px;}";
	blake_set_custom_inline_css($blake_style_inline);

	if (get_option("blake_enable_gotop") == "on"){
		?>
		<p id="back-top"><a href="#home"><i class="fa fa-angle-up"></i></a></p>
		<?php
	}
	
	blake_get_team_profiles_content();
	blake_get_custom_inline_css();
	
	wp_footer(); 

	if (get_option("blake_body_type") == "body_boxed"){
		?>
		</div>
		<?php
	}
	
?>
</body>
</html>