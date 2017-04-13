<?php
/*
Template Name: Under Construction Template
*/
get_header(); //the_post();
$theid = (isset($blake_uc_id)) ? $blake_uc_id : get_the_ID();
$post = get_post($theid);
if (class_exists('Ultimate_VC_Addons')) {
	if(stripos($post->post_content, 'font_call:')){
		preg_match_all('/font_call:(.*?)"/',$post->post_content, $display);
		$blake_import_fonts = array_unique( $display[1] );
		enquque_ultimate_google_fonts_optimzed($blake_import_fonts);
		
		$standardfonts = array('Arial','Arial Black','Helvetica','Helvetica Neue','Courier New','Georgia','Impact','Lucida Sans Unicode','Times New Roman', 'Trebuchet MS','Verdana','');
		$importfonts = "";
	
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
	}
}
?>
<body class="page-template page-template-template-under-construction page-template-template-under-construction-php <?php echo esc_attr("the-id-is-".$theid.""); ?>">
	<div class="fullwindow_rev">
		<?php
		$daslider = get_post_meta($theid, 'underconstruction_rev_value', true);
		if ($daslider){
			if (substr($daslider, 0, 10) === "revSlider_"){
				if (!function_exists('putRevSlider')){
					echo 'Please install the missing plugin - Revolution Slider.';
				} else {
					putRevSlider(substr($daslider, 10));
				}
			}
		} else {
			echo "You need to create and a Revolution Slider instance and then choose it in this Page Options.";
		}
		?>
	</div>
	<div class="fullwindow_content container">
		<div class="tb-row">
			<div class="tb-cell">
				<?php 
					echo do_shortcode($post->post_content);
					/* custom element css */
					$shortcodes_custom_css = get_post_meta( $theid, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_custom_css ) ) {
						blake_set_custom_inline_css($shortcodes_custom_css);
					}
				?>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
<div id="templatepath" class="blake_helper_div"><?php echo esc_url(get_template_directory_uri())."/"; ?></div>
<div id="homeURL" class="blake_helper_div"><?php echo esc_url(home_url('/')); ?>/</div>
<div id="styleColor" class="blake_helper_div"><?php $blake_styleColor = "#".get_option("blake_style_color"); echo esc_html($blake_styleColor);?></div>		
<div id="headerStyleType" class="blake_helper_div"><?php $headerStyleType = get_option("blake_header_style_type"); echo esc_html($headerStyleType); ?></div>
<div class="blake_helper_div" id="reading_option"><?php 
	$blake_reading_option = get_option('blake_blog_reading_type');
	if ($blake_reading_option == "scrollauto"){
		$detect = new Mobile_Detect();
		if ($detect->isMobile())
			$blake_reading_option = "scroll";
	}
	echo esc_html($blake_reading_option); 
?></div>
<div class="blake_helper_div" id="blake_no_more_posts_text"><?php echo sprintf(esc_html__("%s", "blake"), get_option('blake_no_more_posts_text')); ?></div>
<div class="blake_helper_div" id="blake_load_more_posts_text"><?php echo sprintf(esc_html__("%s", "blake"), get_option('blake_load_more_posts_text'));  ?></div>
<div class="blake_helper_div" id="blake_loading_posts_text"><?php echo sprintf(esc_html__("%s", "blake"), get_option('blake_loading_posts_text'));  ?></div>
<div class="blake_helper_div" id="blake_links_color_hover"><?php echo esc_html(get_option('blake_links_color_hover')); ?></div>
<div class="blake_helper_div" id="blake_enable_images_magnifier"><?php echo esc_html(get_option('blake_enable_images_magnifier')); ?></div>
<div class="blake_helper_div" id="blake_thumbnails_hover_option"><?php echo esc_html(get_option('blake_thumbnails_hover_option')); ?></div>
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
</body>