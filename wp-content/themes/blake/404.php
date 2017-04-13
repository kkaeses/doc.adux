<?php get_header(); blake_print_menu(); ?>

	<div class="container">
		<div class="entry-header">
			<div class="error-c">
				<img src="<?php echo esc_url(get_template_directory_uri() . "/images/error.png");?>" title=""/>
				<br>
				<h1 class="heading-error"><?php wp_kses_post(printf(esc_html__( "%s", "blake" ), stripslashes_from_strings_only(get_option('blake_404_heading')))); ?></h1>
							
				<p class="text-error"><?php wp_kses_post(printf(esc_html__( "%s", "blake" ), stripslashes_from_strings_only(get_option('blake_404_text')))); ?></p>
				
				<a href="<?php echo esc_url(home_url("/")); ?>" class="errorbutton"><?php printf(esc_html__("%s","blake"), get_option('blake_404_button_text')); ?></a>
			</div>
			
		</div>
	</div>
<?php
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

wp_footer(); ?>