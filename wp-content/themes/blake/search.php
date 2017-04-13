<?php
/**
 * @package WordPress
 * @subpackage Blake
**/

get_header(); blake_print_menu(); 

	/* pagetitle options related. */
	$type = get_option("blake_header_type");
	$thecolor = blake_hex2rgb(get_option("blake_header_color")); 
	$opacity = intval(str_replace("%","",get_option("blake_header_opacity")))/100;
	$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
	$image = get_option("blake_header_image"); 
	$pattern = is_string(get_option("blake_header_pattern")) ? BLAKE_PATTERNS_URL.get_option("blake_header_pattern") : ""; 
	$custompattern = get_option("blake_header_custom_pattern"); 
	$margintop = get_option("blake_header_text_margin_top");	
	$banner = get_option("blake_banner_slider");
	$showtitle = get_option("blake_hide_pagetitle") == "on" ? true : false;
	$showsectitle = get_option("blake_hide_sec_pagetitle") == "on" ? true : false;
	$tcolor = get_option("blake".'_header_text_color');
	$tsize = intval(str_replace(" ", "", get_option("blake".'_header_text_size')),10)."px";
	$tfont = get_option("blake".'_header_text_font');
	$stcolor = get_option("blake".'_secondary_title_text_color');
	$stsize = intval(str_replace(" ", "", get_option("blake".'_secondary_title_text_size')),10)."px";
	$stfont = get_option("blake".'_secondary_title_font');
	$stmargin = intval(str_replace(" ", "", get_option("blake".'_header_sec_text_margin_top')),10)."px";
	$originalalign = get_option("blake_header_text_alignment");
	$pt_parallax = get_option("blake_pagetitle_image_parallax") == "on" ? true : false;
	$pt_overlay = get_option("blake_pagetitle_image_overlay") == "on" ? true : false;
	$pt_overlay_type = get_option("blake_pagetitle_overlay_type");
	$pt_overlay_the_color = blake_hex2rgb(get_option("blake_pagetitle_overlay_color"));
	$pt_overlay_pattern = (is_string(get_option("blake_pagetitle_overlay_pattern"))) ? BLAKE_PATTERNS_URL.get_option("blake_pagetitle_overlay_pattern") : "";
	$pt_overlay_opacity = intval(str_replace("%","",get_option("blake_pagetitle_overlay_opacity")))/100;
	$pt_overlay_color = "rgba(".$pt_overlay_the_color[0].",".$pt_overlay_the_color[1].",".$pt_overlay_the_color[2].",".$pt_overlay_opacity.")";
	$breadcrumbs = get_option("blake_breadcrumbs");
	$breadcrumbs_margintop = get_option('blake_breadcrumbs_text_margin_top');
	$pagetitlepadding = get_option('blake_page_title_padding');
	$height = "auto";
	$sidebar_scheme = get_option('blake_search_archive_sidebar');
	$sidebar = get_option('blake_search_sidebars_available');
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

	/* endof pagetitle options stuff. */
	
	/* search code related. counters and stuff. */
	$blake_reading_option = get_option('blake_blog_reading_type');
	$blake_more = 0;

	$orderby="";
	$category="";
	$nposts = "";

	$pag = 1;
	$pag = $wp_query->query_vars['paged'];
	if (!is_numeric($pag)) $pag = 1;
 
	
	$se = get_option("blake_enable_search_everything");

	if ($se == "on"){
		$args = array(
			'showposts' => get_option('posts_per_page'),
			'post_status' => 'publish',
			'paged' => $pag,
			's' => esc_html($_GET['s'])
		);
	    
	    $blake_the_query = new WP_Query( $args );
	    
	    $args2 = array(
			'showposts' => -1,
			'post_status' => 'publish',
			's' => esc_html($_GET['s'])
		);
		
		$counter = new WP_Query($args2);
		
	} else {
		$args = array(
			'showposts' => get_option('posts_per_page'),
			'post_status' => 'publish',
			'paged' => $pag,
			'post_type' => 'post',
			's' => esc_html($_GET['s'])
		);
			
	    $blake_the_query = new WP_Query( $args );
	    
	    $args2 = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'post_type' => 'post',
			's' => esc_html($_GET['s'])
		);
		
		$counter = new WP_Query($args2);
	}
	/* endof search stuff. */
	
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
				<div class="container <?php echo esc_attr($originalalign); ?>" style="padding:<?php echo esc_attr($pagetitlepadding); ?> 15px;">
					<div class="pageTitle" style="text-align:<?php echo esc_attr($textalign); ?>;<?php echo esc_attr($ptitleaux); ?>">
					<?php
						if ($showtitle){
							?>
							<h1 class="page_title" style="<?php echo esc_attr("color: #$tcolor; font-size: $tsize; font-family: '{$principalfont[0]}', sans-serif;font-weight: {$principalfont[1]}; ");?><?php if ($margintop != "") echo esc_attr("margin-top: ".intval($margintop,10)."px;"); ?>">
								<?php echo wp_kses_post($counter->post_count . " " . sprintf(esc_html__("%s", "blake"), get_option("blake_search_results_text")) . " &#8216;" . $_GET['s'] ."&#8217;"); ?>
							</h1>
							<?php
						}
		    			if ($showsectitle){
			    			if (is_string(get_option("blake_search_secondary_title")) && get_option("blake_search_secondary_title") != ""){
						    	?>
							    <h2 class="secondaryTitle" style="<?php echo esc_attr("color: #$stcolor; font-size: $stsize; line-height: $stsize; font-family: '{$secondaryfont[0]}'; font-weight:{$secondaryfont[1]}; margin-top:{$stmargin};");?>">
							    	<?php echo wp_kses_post(get_option("blake_search_secondary_title")); ?>
							    </h2>
					    		<?php
					    	}
		    			}
		    		?>
		    		</div>
		    		
				</div>
		<?php }
		?>
		</div> <!-- end of fullwidth section -->
		<?php 
	}
	
	if (!$sidebar) $sidebar = "defaultblogsidebar";
	switch ($sidebar_scheme){
		case "none":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content">
						<?php blake_print_search_results(); ?>
					</section>
				</div>
			</div>
			<?php
		break;
		case "left":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content left sidebar col-xs-12 col-md-3">
						<?php 
						if ($sidebar === "defaultblogsidebar"){
							get_sidebar();
						} else {
							if ( function_exists('dynamic_sidebar')) { 
								ob_start();
							    do_shortcode(dynamic_sidebar($sidebar));
							    $html = ob_get_contents();
							    ob_end_clean();
							    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
								$html = wp_kses_js_entities($html);
								$html = wp_kses_normalize_entities($html);
								echo wp_kses_hook($html, 'post', array()); 
							}
						}
						wp_reset_postdata();
						?>
					</section>
					<section class="page_content right col-xs-12 col-md-9">
						<?php blake_print_search_results(); ?>
					</section>
				</div>
			</div>
			<?php
		break;
		case "right":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content left col-xs-12 col-md-9">
						<?php blake_print_search_results(); ?>
					</section>
					<section class="page_content right sidebar col-xs-12 col-md-3">
						<?php 
						wp_reset_postdata();
						if ($sidebar === "defaultblogsidebar"){
							get_sidebar();
						} else {
							if ( function_exists('dynamic_sidebar')) { 
								ob_start();
							    do_shortcode(dynamic_sidebar($sidebar));
							    $html = ob_get_contents();
							    ob_end_clean();
							    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
								$html = wp_kses_js_entities($html);
								$html = wp_kses_normalize_entities($html);
								echo wp_kses_hook($html, 'post', array());
							}
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
				<div class="container">
					<section class="page_content">
						<?php blake_print_search_results(); ?>
					</section>
				</div>
			</div>
			<?php
		break;
	}
	
	function blake_print_search_results(){
		global $blake_the_query;
		if ($blake_the_query->have_posts()){
		?> 
		
		<div class="post-listing">
			<?php			    
			    while ( $blake_the_query->have_posts() ) : 
						
			    	$blake_the_query->the_post();
		    		global $blake_more;
			    		$blake_more = 0;
					
					?>
			    	
			    	<article id="post-<?php esc_attr(the_ID()); ?>" <?php if (is_sticky()) post_class('sticky'); else post_class(); ?>>
				    	
				    	
				    	<div class="the_title"><h2><a href="<?php esc_url(the_permalink()); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
    		
			    		<div class="metas-container">
	    			
			    			<p class="blog-date"><i class="fa fa-calendar"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
			    			<p><a class="the_author" href="?author=<?php esc_attr(the_author_meta('ID')); ?>"><i class="fa fa-user"></i> <?php esc_html(the_author_meta('nickname')); ?></a></p>
							
							<?php
								$posttags = get_the_tags();
								if ($posttags) {
									$first = true;
									echo '<p><i class="fa fa-tags"></i> ';
									foreach($posttags as $tag) {
										if ($tag->name != "uncategorized"){
											if ($first){
												echo "<a href='".esc_url( home_url( '/' ) )."tag/".esc_attr($tag->slug)."'>".esc_html($tag->name)."</a>"; 
												$first = false;
											} else {
												echo "<span class='tags-on-icons'>, </span><a href='".esc_url( home_url( '/' ) )."tag/".esc_attr($tag->slug)."'>".esc_html($tag->name)."</a>";
											}		
										}								    
								  	}
								  	echo '</p>';
								}
							?>
							<?php
								$postcats = get_the_category();
								if ($postcats) {
									$first = true;
									echo '<p><i class="fa fa-pencil-square-o"></i> ';
									foreach($postcats as $cat) {
										if ($cat->name != "uncategorized"){
											if ($first){
												echo "<a href='".esc_url( home_url( '/' ) )."category/".esc_attr($cat->slug)."'>".esc_html($cat->name)."</a>"; 
												$first = false;
											} else {
												echo "<span class='tags-on-icons'>, </span><a href='".esc_url( home_url( '/' ) )."category/".esc_attr($cat->slug)."'>".esc_html($cat->name)."</a>"; 
											}	
										}									    
								  	}
								  	echo '</p>';
								}
							?>
							
							<p><a href="#comments"><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></a></p>
			    		</div>
			    							    
					    <div class="des-sc-dots-divider"></div>
						
				    </article> <!-- end of post -->
				    	
			    <?php endwhile; ?>
			    		
	    	</div> <!-- end of post-listing -->
					
			<div class="navigation">
				<?php
					$blake_reading_option = get_option('blake_blog_reading_type');
					if ($blake_reading_option != "paged" && $blake_reading_option != "dropdown"){ 
						$blake_the_query = new WP_Query();
					?>
						<?php  next_posts_link('<div class="next-posts">&laquo; ' . sprintf(esc_html__("%s", "blake"), get_option("blake_previous_results")).'</div>', $blake_the_query->max_num_pages);  ?>
						<?php  previous_posts_link('<div class="prev-posts">'.sprintf(esc_html__("%s", "blake"), get_option("blake_next_results")) . ' &raquo;</div>', $blake_the_query->max_num_pages); ?>
					<?php
					} else { 
						blake_wp_pagenavi();
					}
				?>
			</div>

									
		<?php  }  else { ?>
	
		<div class="post-listing">
			<div class="pageTitle">
				<h2 class="hsearchtitle"><?php echo sprintf(esc_html__("%s", "blake"), get_option("blake_no_results_text"));  ?></h2>
				<p class="titleSep"></p>
			</div>
		</div>
		
		
	<?php }
	}
	?>
	
<?php get_footer(); ?>