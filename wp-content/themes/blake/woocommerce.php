<?php
	get_header(); blake_print_menu();
	$blake_thisPostID = get_the_ID(); 
	$woocommerce = blake_get_the_woo();	
	
	$type = get_option("blake_header_type_shop");
	$thecolor = blake_hex2rgb(get_option("blake_header_color_shop")); 
	$opacity = intval(str_replace("%","",get_option("blake_header_opacity_shop")))/100;
	$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
	$image = get_option("blake_header_image_shop"); 
	$pattern = BLAKE_PATTERNS_URL.get_option("blake_header_pattern_shop"); 
	$custompattern = get_option("blake_header_custom_pattern_shop"); 
	$margintop = get_option("blake_header_text_margin_top_shop");	
	$banner = get_option("blake_banner_slider_shop");
	$showtitle = get_option("blake_hide_pagetitle_shop") == "on" ? true : false;
	$showsectitle = get_option("blake_hide_sec_pagetitle_shop") == "on" ? true : false;
	$tcolor = get_option("blake_header_text_color_shop");
	$tsize = intval(str_replace(" ", "", get_option("blake_header_text_size_shop")),10)."px";
	$tfont = get_option("blake_header_text_font_shop");
	$stcolor = get_option("blake_secondary_title_text_color_shop");
	$stsize = intval(str_replace(" ", "", get_option("blake_secondary_title_text_size_shop")),10)."px";
	$stfont = get_option("blake_secondary_title_font_shop");
	$stmargin = intval(str_replace(" ", "", get_option("blake_header_sec_text_margin_top_shop")),10)."px";
	$originalalign = get_option("blake_header_text_alignment_shop");
	$pt_parallax = get_option("blake_pagetitle_image_parallax_shop") == "on" ? true : false;
	$pt_overlay = get_option("blake_pagetitle_image_overlay_shop") == "on" ? true : false;
	$pt_overlay_type = get_option("blake_pagetitle_overlay_type_shop");
	$pt_overlay_the_color = blake_hex2rgb(get_option("blake_pagetitle_overlay_color_shop"));
	$pt_overlay_pattern = (is_string(get_option("blake_pagetitle_overlay_pattern_shop"))) ? BLAKE_PATTERNS_URL.get_option("blake_pagetitle_overlay_pattern_shop") : "";
	$pt_overlay_opacity = intval(str_replace("%","",get_option("blake_pagetitle_overlay_opacity_shop")))/100;
	$pt_overlay_color = "rgba(".$pt_overlay_the_color[0].",".$pt_overlay_the_color[1].",".$pt_overlay_the_color[2].",".$pt_overlay_opacity.")";
	$breadcrumbs = get_option("blake_breadcrumbs_shop");
	$breadcrumbs_margintop = get_option('blake_breadcrumbs_text_margin_top_shop');
	$pagetitlepadding = get_option('blake_page_title_padding_shop');
	$height = "auto";

	$textalign = $originalalign;
	if ($originalalign == "titlesleftcrumbsright") $textalign = "left";
	if ($originalalign == "titlesrightcrumbsleft") $textalign = "right";
	
	$blake_import_fonts[] = $tfont;
	$principalfont = explode("|",$tfont);
	$principalfont[0] = $principalfont[0]."', 'Arial', 'sans-serif";
	if (!isset($principalfont[1])) $principalfont[1] = "";
		
	$blake_import_fonts[] = $stfont;
	$secondaryfont = explode("|",$stfont);
	$secondaryfont[0] = $secondaryfont[0]."', 'Arial', 'sans-serif";
	if (!isset($secondaryfont[1])) $secondaryfont[1] = "";
		
	if ($type != "without"){
		
		$ptitleaux = $bcaux = "";
		if ($originalalign == "titlesleftcrumbsright" || $originalalign == "titlesrightcrumbsleft"){
    		$ptitleaux .= "max-width: 50%;";
    		$bcaux .= "max-width: 50%;";
    		if ($originalalign == "titlesleftcrumbsright"){
				$ptitleaux .= "float:left;";
				$bcaux .= "float:right;";
			} else {
				$ptitleaux .= "float:right;";
				$bcaux .= "float:left;";
			}
		}
		$bcaux .= "margin-top:".intval($breadcrumbs_margintop,10)."px;";
		switch($originalalign){
			case "left": case "titlesrightcrumbsleft":
				$bcaux .= "text-align: left;";
			break;
			case "right": case "titlesleftcrumbsright":
				$bcaux .= "text-align:right;";
			break;
			case "center": 
				$bcaux .= "text-align:center;";
			break;
		}
		?>
		<div class="fullwidth-container <?php if ($type == "pattern") echo "bg-pattern"; ?> <?php if ($pt_parallax) echo "parallax"; ?>" <?php if ($pt_parallax) echo 'data-stellar-ratio="0.5"'; ?> style="
	    	<?php 
		 		if ($height != "") echo "height: ". esc_html($height) . ";";
				if ($type == "none") echo "background: none;"; 
				if ($type == "color") echo "background: " . esc_html($color) . ";";
				if ($type == "image") echo "background: url(" . esc_url($image) . ") no-repeat; background-size: 100% auto;";  
	 			if ($type == "pattern") echo "background: url('" . esc_url($pattern) . "') 0 0 repeat;";
	    	?>">
	    	<?php
		    	if ($type == "image" && $pt_overlay){
			    	echo '<div class="pagetitle_overlay" style="'; 
			    	if ($pt_overlay_type == "color") echo 'background-color:'.esc_html($pt_overlay_color);
			    	else echo 'background:url('.esc_url($pt_overlay_pattern).') repeat;opacity:'.esc_html($pt_overlay_opacity).';';
			    	echo '"></div>';
		    	}
		    	if ($type === "banner"){
			    	?> <div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div> <?php
		    	} else {
		    	?>
				<div class="container" style="padding:<?php echo esc_attr($pagetitlepadding); ?> 15px;">
					<div class="pageTitle" style="text-align:<?php echo esc_attr($textalign); ?>;<?php echo esc_attr($ptitleaux); ?>">
					<?php
						if ($showtitle){
							?>
							<h1 class="page_title" style="<?php echo esc_attr("color: #$tcolor; font-size: $tsize; font-family: '{$principalfont[0]}';font-weight: {$principalfont[1]};");?><?php if ($margintop != "") echo esc_attr("margin-top: ".intval($margintop,10)."px;"); ?>">
								<?php
									if ( is_product() || is_product_category() || is_product_tag() ){
						    		   echo esc_html(get_option("blake_shop_primary_title"));
					    		   	} else {
						    		   woocommerce_page_title();
					    		   	}
								?>
							</h1>
							<?php
						}
		    			if ($showsectitle){
			    			if (get_post_meta($blake_thisPostID, 'secondaryTitle_value', true) != ""){
						    	?>
							    <h2 class="secondaryTitle" style="<?php echo esc_attr("color: #$stcolor; font-size: $stsize; line-height: $stsize; font-family: '{$secondaryfont[0]}';font-weight:{$secondaryfont[1]}; margin-top:{$stmargin};");?>">
							    	<?php 
								    	if (get_post_meta($blake_thisPostID, 'secondaryTitle_value', true) != "") echo esc_html(get_post_meta($blake_thisPostID, 'secondaryTitle_value', true));
								    	else esc_html(get_option('blake_shop_secondary_title'));
								    ?>
							    </h2>
					    		<?php
					    	}
		    			}
		    		?>
		    		</div>
		    		<?php
		    		if ($breadcrumbs == "on"){
			    		?>
			    		<div class="blake_breadcrumbs" style="<?php echo esc_attr($bcaux); ?>">
							<?php blake_the_breadcrumb(); ?>
			    		</div>
			    		<?php
					}
					?>
				</div>
		<?php }
		?>
		</div>	
		<?php
	}


	$sidebar_scheme = get_option('blake_woo_sidebar_scheme');
	$sidebar = get_option('blake_woo_sidebar');
	switch ($sidebar_scheme){
		case "none":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<section class="page_content" id="section_page-<?php echo esc_attr($blake_thisPostID); ?>">
					<div class="container">
					<?php  woocommerce_content(); ?>
					</div>
				</section>
			</div>
			<?php
		break;
		case "left":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content left sidebar col-xs-12 col-md-3">
						<?php 
						if ( function_exists('dynamic_sidebar')) { 
							if ($sidebar == 'defaultblogsidebar'){
								get_sidebar();
							} else {
								ob_start();
							    do_shortcode(dynamic_sidebar($sidebar));
							    $html = ob_get_contents();
							    ob_end_clean();
							    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
								$html = wp_kses_js_entities($html);
								$html = wp_kses_normalize_entities($html);
								echo wp_kses_hook($html, 'post', array());
							}
						} else {
							get_sidebar();
						}
						?>
					</section>
					<section class="page_content right col-xs-12 col-md-9" id="section_page-<?php echo esc_attr($blake_thisPostID); ?>">
						<?php  woocommerce_content(); ?>
					</section>
				</div>
			</div>
			<?php
		break;
		case "right":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content left col-xs-12 col-md-9" id="section_page-<?php echo esc_attr($blake_thisPostID); ?>">
						<?php  woocommerce_content(); ?>
					</section>
					<section class="page_content right sidebar col-xs-12 col-md-3">
						<?php 
						if ( function_exists('dynamic_sidebar')) { 
							if ($sidebar == 'defaultblogsidebar'){
								get_sidebar();
							} else {
								ob_start();
							    do_shortcode(dynamic_sidebar($sidebar));
							    $html = ob_get_contents();
							    ob_end_clean();
							    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
								$html = wp_kses_js_entities($html);
								$html = wp_kses_normalize_entities($html);
								echo wp_kses_hook($html, 'post', array());
							}
						} else {
							get_sidebar();
						}	
						?>
					</section>
				</div>
			</div>
			<?php
		break;
		default:
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<section class="page_content" id="section_page-<?php echo esc_attr($blake_thisPostID); ?>">
					<div class="container">
					<?php woocommerce_content(); ?>
					</div>
				</section>
			</div>
			<?php
		break;
	}

		
get_footer(); ?>