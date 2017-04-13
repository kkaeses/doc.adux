<?php
/*
Template Name: Blog Masonry Template
*/
get_header(); blake_print_menu();

	$blake_thisPostID = get_the_ID(); 

	if (get_post_meta($blake_thisPostID, "blake_enable_custom_pagetitle_options_value", true) == "no" || !get_post_meta($blake_thisPostID, "blake_enable_custom_pagetitle_options_value", true)){
		$type = get_option("blake_header_type");
		$thecolor = blake_hex2rgb(get_option("blake_header_color")); 
		$opacity = intval(str_replace("%","",get_option("blake_header_opacity")))/100;
		$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
		$image = get_option("blake_header_image"); 
		$pattern = is_string(get_option("blake_header_pattern")) ? BLAKE_PATTERNS_URL.get_option("blake_header_pattern") : ""; 
		$custompattern = get_option("blake_header_custom_pattern"); 
		//$height = get_option("blake_header_height"); 
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
	} else {
		$type = get_post_meta($blake_thisPostID, "blake_header_type_value", true);
		$thecolor = blake_hex2rgb(get_post_meta($blake_thisPostID, "blake_header_color_value", true)); 
		$opacity = intval(str_replace("%","",get_post_meta($blake_thisPostID, "blake_header_color_opacity_value", true)))/100;
		$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
		$image = get_post_meta($blake_thisPostID, "blake_header_image_value", true);
		$image = explode('|!|',$image);
		if (isset($image[1])) $image = explode('|*|',$image[1]);
		$image = $image[0];
		$pattern = BLAKE_PATTERNS_URL.get_post_meta($blake_thisPostID, "blake_header_pattern_value", true).".jpg";
		$custompattern = get_option("blake_header_custom_pattern_value"); 
		$margintop = get_post_meta($blake_thisPostID, "blake_header_text_margin_top_value", true);
		$banner = get_post_meta($blake_thisPostID, "blake_banner_slider_value", true);
		$showtitle = get_post_meta($blake_thisPostID, "blake_hide_pagetitle_value", true) == "yes" ? true : false;
		$showsectitle = get_post_meta($blake_thisPostID, "blake_hide_sec_pagetitle_value", true) == "yes" ? true : false;
		$tcolor = get_post_meta($blake_thisPostID, "blake_header_text_color_value", true);
		$tsize = intval(str_replace(" ", "", get_post_meta($blake_thisPostID, "blake_header_text_size_value", true)),10)."px";
		$tfont = get_post_meta($blake_thisPostID, "blake_header_text_font_value", true);
		$stcolor = get_post_meta($blake_thisPostID, "blake_secondary_title_text_color_value", true);
		$stsize = intval(str_replace(" ", "", get_post_meta($blake_thisPostID, "blake_secondary_title_text_size_value", true)),10)."px";
		$stfont = get_post_meta($blake_thisPostID, "blake_secondary_title_font_value", true);
		$stmargin = intval(str_replace(" ", "", get_post_meta($blake_thisPostID, "blake_header_secondary_text_margin_top_value", true)),10)."px";
		$originalalign = get_post_meta($blake_thisPostID, "blake_header_text_alignment_value", true);
		$pt_parallax = get_post_meta($blake_thisPostID, "blake_pagetitle_image_parallax_value", true) == "on" ? true : false;
		$pt_overlay = get_post_meta($blake_thisPostID, "blake_pagetitle_image_overlay_value", true) == "on" ? true : false;
		$pt_overlay_type = get_post_meta($blake_thisPostID, "blake_pagetitle_overlay_type_value", true);
		$pt_overlay_the_color = blake_hex2rgb(get_post_meta($blake_thisPostID, "blake_pagetitle_overlay_color_value", true));
		$pt_overlay_pattern = BLAKE_PATTERNS_URL.get_post_meta($blake_thisPostID, "blake_pagetitle_overlay_pattern_value", true).".jpg";
		$pt_overlay_opacity = intval(str_replace("%","",get_post_meta($blake_thisPostID, "blake_pagetitle_overlay_opacity_value", true)))/100;
		$pt_overlay_color = "rgba(".$pt_overlay_the_color[0].",".$pt_overlay_the_color[1].",".$pt_overlay_the_color[2].",".$pt_overlay_opacity.")";
		$breadcrumbs = get_post_meta($blake_thisPostID, "blake_enable_breadcrumbs_value", true) == "yes" ? "on" : "off";
		$breadcrumbs_margintop = intval(str_replace(" ", "", get_post_meta($blake_thisPostID, "blake_breadcrumbs_margin_top_value", true)),10)."px";
		$pagetitlepadding = intval(str_replace(" ", "", get_post_meta($blake_thisPostID, "blake_page_title_padding_value", true)),10)."px";
	}
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
		    	$blake_output = "";
		 		if ($height != "") $blake_output.= "height: ". $height . ";";
				if ($type == "none") $blake_output.= "background: none;"; 
				if ($type == "color") $blake_output.= "background: " . $color . ";";
				if ($type == "image") $blake_output.= "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
	 			if ($type == "pattern") $blake_output.= "background: url('" . $pattern . "') 0 0 repeat;";
		 			
	 			if (defined("BLAKE_IS_FIRST_PAGE")) echo "margin-top:60px;";
				echo esc_attr($blake_output);
				
	    	?>">
	    	<?php
		    	if ($type == "image" && $pt_overlay){
			    	$blake_output = "";
			    	echo '<div class="pagetitle_overlay" style="'; 
			    	if ($pt_overlay_type == "color") $blake_output.= 'background-color:'.$pt_overlay_color;
			    	else $blake_output.= 'background:url('.$pt_overlay_pattern.') repeat;opacity:'.$pt_overlay_opacity.';';
			    	echo esc_attr($blake_output).'"></div>';
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
							<h1 class="page_title" style="<?php echo esc_attr("color: #$tcolor; font-size: $tsize; font-family: '{$principalfont[0]}';font-weight: {$principalfont[1]};");?><?php if ($margintop != "") echo esc_attr("margin-top: ".intval($margintop,10)."px;"); ?>">
								<?php if (get_option('blake_blog_single_primary_title') != "" && !is_array(get_option('blake_blog_single_primary_title'))) echo wp_kses_post(get_option('blake_blog_single_primary_title')); else echo wp_kses_post(get_the_title($blake_thisPostID)); ?>
							</h1>
							<?php
						}
		    			if ($showsectitle){
			    			if (get_post_meta($post->ID, 'secondaryTitle_value', true) != "" || get_option('blake_blog_secondary_title') != ""){
						    	?>
							    <h2 class="secondaryTitle" style="<?php echo esc_attr("color: #$stcolor; font-size: $stsize; line-height: $stsize; font-family: '{$secondaryfont[0]}';font-weight:{$secondaryfont[1]}; margin-top:{$stmargin};");?>">
							    	<?php echo wp_kses_post(get_post_meta($post->ID, 'secondaryTitle_value', true)); ?>
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
	
	$sidebar_scheme = get_post_meta($blake_thisPostID, 'sidebar_for_default_value', true);
	$sidebar = get_post_meta($blake_thisPostID, 'sidebars_available_value', true);
	if (!$sidebar) $sidebar = "defaultblogsidebar";
	switch ($sidebar_scheme){
		case "none":
			if (!defined("BLAKE_IS_FIRST_PAGE")){
				?>
				<div class="content-before-blog">
					<?php 
						blake_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default wideblog">
				<div class="master_container">
					<section class="page_content">
						<div class="container">
						<?php blake_print_masonry_blog(); ?>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
		case "left":
			if (!defined("BLAKE_IS_FIRST_PAGE")){
				?>
				<div class="content-before-blog">
					<?php 
						blake_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default">
				<div class="master_container container">
					<section class="page_content left sidebar col-xs-12 col-md-4">
						<div class="blog-sidebar-bg">
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
						?>
						</div>
					</section>
					<section class="page_content right col-xs-12 col-md-8">
						<?php blake_print_masonry_blog(); ?>
					</section>
				</div>
			</div>
			<?php
		break;
		case "right":
			if (!defined("BLAKE_IS_FIRST_PAGE")){
				?>
				<div class="content-before-blog">
					<?php 
						blake_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default">
				<div class="master_container container">
					<section class="page_content left col-xs-12 col-md-8">
						<?php blake_print_masonry_blog(); ?>
					</section>
					<section class="page_content right sidebar col-xs-12 col-md-4">
						<div class="blog-sidebar-bg">
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
							?>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
		default:
			if (!defined("BLAKE_IS_FIRST_PAGE")){
				?>
				<div class="content-before-blog">
					<?php 
						blake_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default wideblog">
				<div class="master_container">
					<section class="page_content">
						<div class="container">
						<?php blake_print_masonry_blog(); ?>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
	}
	
	$blake_inline_script = '
		jQuery(document).ready(function(){
			var forceGutter = 50; // change to false to return to the normal behavior.
			(function(e){"use strict";e.Isotope.prototype._getMasonryGutterColumns=function(){var e=this.options.masonry&&this.options.masonry.gutterWidth||0;var t=this.element.width();this.masonry.columnWidth=this.options.masonry&&this.options.masonry.columnWidth||this.$filteredAtoms.outerWidth(true)||t;this.masonry.columnWidth+=e;this.masonry.cols=Math.floor((t+e)/this.masonry.columnWidth);this.masonry.cols=Math.max(this.masonry.cols,1)};e.Isotope.prototype._masonryReset=function(){this.masonry={};this._getMasonryGutterColumns();var e=this.masonry.cols;this.masonry.colYs=[];while(e--){this.masonry.colYs.push(0)}};e.Isotope.prototype._masonryResizeChanged=function(){var e=this.masonry.cols;this._getMasonryGutterColumns();return this.masonry.cols!==e};e(document).ready(function(){var t=e(".journal");var n=0;var r=0;var i=function(){var e=parseInt(t.data("columns"));var i=t.data("gutterSpace");var s=t.width();var o=0;if(isNaN(i)){i=.02}else if(i>.05||i<0){i=.02}if(s<568){e=1}else if(s<768){e-=2}else if(s<991){e-=1;if(e<2){e=2}}if(e<1){e=1}r=forceGutter!=false ? forceGutter : Math.floor(s*i);var u=r*(e-1);var a=s-u;n=Math.floor(a/e);o=r;if(1==e){o=20}t.children(".journal-post").css({width:n+"px",marginBottom:o+"px"})};i();window.iso = t.isotope({itemSelector:".journal-post",resizable:false,masonry:{columnWidth:n,gutterWidth:r}});t.imagesLoaded(function(){i();t.isotope({itemSelector:".journal-post",resizable:true,masonry:{columnWidth:n,gutterWidth:r}})});e(window).smartresize(function(){i();t.isotope({masonry:{columnWidth:n,gutterWidth:r}})});var s=e(".wc-shortcodes-filtering .wc-shortcodes-term");s.click(function(i){i.preventDefault();s.removeClass("wc-shortcodes-term-active");e(this).addClass("wc-shortcodes-term-active");var o=e(this).attr("data-filter");t.isotope({filter:o,masonry:{columnWidth:n,gutterWidth:r}});return false})})})(jQuery);
			
			jQuery(".flexslider").flexslider({
				animation: "fade",
				slideshow: true,
				slideshowSpeed: 3500,
				animationDuration: 1000,
				directionNav: true,
				controlNav: true,
				smootheHeight:false,
				start: function(slider) {
				  slider.removeClass("loading").css("overflow","");
				}
				
			});
		});
	';
	wp_add_inline_script('blake', $blake_inline_script, 'after');
	
	function blake_print_masonry_blog(){
		
		$pag = 1;
		global $wp_query;
		$pag = $wp_query->query_vars['paged'];

		$cattype = "category__in";
		if (strpos(get_post_meta(get_the_ID(), 'posts_filter_categories_value', true), ',') !== false){
			$categories = explode(',',get_post_meta(get_the_ID(), 'posts_filter_categories_value', true));	
		} else {
			$cattype = "cat";
			$categories = get_post_meta(get_the_ID(), 'posts_filter_categories_value', true);
		}
		
		$tagtype = "tag__in";
		if (strpos(get_post_meta(get_the_ID(), 'posts_filter_tags_value', true), ',') !== false){
			$tags = explode(",",get_post_meta(get_the_ID(), 'posts_filter_tags_value', true));	
		} else {
			$tagtype = "tag_id";
			$tags = get_post_meta(get_the_ID(), 'posts_filter_tags_value', true);
		}
		$authortype = "author__in";
		if (strpos(get_post_meta(get_the_ID(), 'posts_filter_authors_value', true), ',') !== false){
			$authors = explode(",",get_post_meta(get_the_ID(), 'posts_filter_authors_value', true));
		} else {
			$authortype = "author";
			$authors = get_post_meta(get_the_ID(), 'posts_filter_authors_value', true);
		}
		$orderby = get_post_meta(get_the_ID(), 'posts_filter_orderby_value', true);
		$order = get_post_meta(get_the_ID(), 'posts_filter_order_value', true);
		
		if (!isset($nposts)) $nposts = get_option('posts_per_page');
		$args = array(
			'showposts' => $nposts,
	    	'orderby' => $orderby,
	    	'order' => $order,
	    	$cattype => $categories,
	    	$tagtype => $tags,
	    	$authortype => $authors,
	    	'post_status' => 'publish',
	    	'paged' => $pag
	    );
	    	    
	    global $post, $wp_query;
	    
	    $blake_the_query = new WP_Query( $args );
	    				    
	    if ($blake_the_query->have_posts()){ 
	    
	    	if (get_post_meta(get_the_ID(), 'posts_add_category_filter_value', true) == 'yes' && count($categories) > 2){
		    	?>
		    	<ul class="posts_category_filter">
			    	<li class="showall" onclick="window.iso.isotope({filter:'*'});"><?php esc_html_e('All','blake'); if (get_post_meta(get_the_ID(), 'posts_add_category_filter_counter_value', true) == 'yes'){ ?>
							<span class="counter"></span>
							<?php
							}
							?></li>
			    	<?php
				    	foreach($categories as $cat){
					    	$thiscat = get_category($cat);
					    	?>
					    	<li class="<?php echo "cat-".esc_attr($thiscat->slug); ?>" onclick="window.iso.isotope({filter:'.<?php echo "cat-".esc_attr($thiscat->slug); ?>'});"><?php echo wp_kses_post($thiscat->name);
							if (get_post_meta(get_the_ID(), 'posts_add_category_filter_counter_value', true) == 'yes'){ ?>
							<span class="counter"></span>
							<?php
							}
							?> 
					    	</li>
					    	<?php
				    	}
			    	?>
		    	</ul>
		    	
		    	<?php	
			    $blake_inline_script = '
			    	jQuery(document).ready(function(){
				    	jQuery(".posts_category_filter .showall .counter").text(" ("+jQuery("article").length+")");
						jQuery(".posts_category_filter li:not(.showall)").each(function(){
							jQuery(this).find(".counter").text(" ("+jQuery("article."+jQuery(this).attr("class")).length+")");
						});
			    	});
			    ';
			    wp_add_inline_script('blake', $blake_inline_script, 'after');
	    	}
	    
			?> 
	    
	    	<div class="post-listing journal isotope" data-columns="3" data-gutter-space="60" >
		    	
	    	<?php
		    	
			    while ($blake_the_query->have_posts()){
				    $blake_the_query->the_post();
				    $postid = get_the_ID();
				    
				    $post_categories = wp_get_post_categories( $postid );
				    $post_categories_class = array();
				    foreach ($post_categories as $cat){
					    $thisCat = get_category($cat);
					    $post_categories_class[] = "cat-".$thisCat->slug;
				    }
				    
				    ?>
				    <article id="<?php echo esc_attr("post-".get_the_ID()); ?>" class="post journal-post isotope-item <?php echo esc_attr(get_post_meta(get_the_ID(), 'posttype_value', true)); if (is_sticky()) echo esc_attr(" sticky"); echo " ".implode(" ", $post_categories_class); ?>">
						
						<div class="blog-default-bg-masonry">
							
								<div class="post-content fadeInUpBig">
							    <?php
								    $posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
								    switch($posttype){
							    		case "image":
							    		
							    			if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
											?>
												<div class="featured-image">
													<a href="<?php esc_url(the_permalink()); ?>" title="">
														<img alt="" src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($postid))); ?>" title="<?php esc_attr(the_title()); ?>"/>
														<span class="post_overlay">
															<i class="fa fa-plus" aria-hidden="true"></i>
														</span>
													</a>
												</div>
												<div class="padding-box-masonry">
													<div class="the_title"><h2><a href="<?php esc_attr(the_permalink()); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
													<div class="post-summary"><?php wp_kses_post(the_excerpt()); ?></div>
													<div class="metas">
														<div class="date">
															<p><i class="fa fa-calendar-o"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
														</div>
														
														 <div class="comments-lovepost">
								                            <div class="comments-count">
								                            	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
								                            </div>
								                            
								                            <?php if( function_exists('zilla_likes') ){ ?>
									                        <div class="lovepost"><?php zilla_likes(); ?></div>
									                        <?php } ?>
							                            </div>
													</div>
												</div>
												<?php 
											}
							    			
							    		break;
		
							    		case "slider": 
											$randClass = rand(0,1000);
											?>
												<div class="light">
													<div class="flexslider <?php echo esc_attr($posttype); ?>">
														<ul class="slides">
															<?php
																$sliderData = get_post_meta($postid, "sliderImages_value", true);
																$slide = explode("|*|",$sliderData);
															    foreach ($slide as $s){
															    	if ($s != ""){
															    		$params = explode("|!|",$s);
															    		$attachment = get_post( $params[0] );
															    		echo "<li>";
															    		echo "<img src='".esc_url($params[1])."' alt=''>";
															    		echo "</li>";	
															    	}
															    }
															?>
														</ul>
													</div>
												</div>
												
												<div class="padding-box-masonry">
													<div class="the_title"><h2><a href="<?php esc_url(the_permalink()); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
													<div class="post-summary"><?php wp_kses_post(the_excerpt()); ?></div>
													<div class="metas">
														<div class="date">
															<p><i class="fa fa-calendar-o"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
														</div>
														
														 <div class="comments-lovepost">
								                            <div class="comments-count">
								                            	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
								                            </div>
								                            
								                            <?php if( function_exists('zilla_likes') ){ ?>
									                        <div class="lovepost"><?php zilla_likes(); ?></div>
									                        <?php } ?>
							                            </div>
													</div>
												</div>
											<?php
							    		break;
		
							    		case "audio":
											?>
											
											<div class="audioContainer">
												<?php
													if (get_post_meta($postid, 'audioSource_value', true) == 'embed') echo get_post_meta($postid, 'audioCode_value', true); 
													else {
														$audio = explode("|!|",get_post_meta($postid, 'audioMediaLibrary_value', true));
														if (isset($audio[1])) {
															$ext = explode(".",$audio[1]);
															if (isset($ext)) $ext = $ext[count($ext)-1];
															?>
															<audio controls="controls"><source type="audio/<?php echo esc_attr($ext); ?>" src="<?php echo esc_url($audio[1]); ?>"></audio>
															<?php
														}
													}
												?>
											</div>
												
											<div class="padding-box-masonry">
													
												<div class="the_title"><h2><a href="<?php the_permalink(); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
												<div class="post-summary"><?php wp_kses_post(the_excerpt()); ?></div>
												<div class="metas">
													<div class="date">
														<p><i class="fa fa-calendar-o"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
													</div>
													
													 <div class="comments-lovepost">
							                            <div class="comments-count">
							                            	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
							                            </div>
							                            
							                            <?php if( function_exists('zilla_likes') ){ ?>
								                        <div class="lovepost"><?php zilla_likes(); ?></div>
								                        <?php } ?>
						                            </div>
												</div>
											</div>
											<?php
							    		break;
							    		
							    		case "video":
							    			?>
							    			
							    			
								    			<div class="post-video <?php echo get_post_meta($postid, "videoSource_value", true); ?>">
													<div class="vendor">
													<?php
														$videosType = get_post_meta($postid, "videoSource_value", true);
														if ($videosType != "embed"){
															$videos = get_post_meta($postid, "videoCode_value", true);
															$videos = preg_replace( '/\s+/', '', $videos );
															$vid = explode(",",$videos);
														}
														switch (get_post_meta($postid, "videoSource_value", true)){
															case "media":
																$video = explode("|!|",get_post_meta($postid, 'videoMediaLibrary_value', true));
																if (isset($video[1])) {
																	$ext = explode(".",$video[1]);
																	if (isset($ext)) $ext = $ext[count($ext)-1];
																	?>
																	<video controls="controls" class="video-controls"><source type="video/<?php echo esc_attr($ext); ?>" src="<?php echo esc_url($video[1]); ?>"></video>
																	<?php
																}
															break;
															case "youtube":
																if (isset($vid[0])) echo "<iframe src='//www.youtube.com/embed/".esc_attr($vid[0])."' frameborder='0' allowfullscreen></iframe>";
																break;
															case "vimeo":
																if (isset($vid[0])) echo '<iframe src="https://player.vimeo.com/video/'.esc_attr($vid[0]).'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
																break;
														}						
													?>
													</div>
								    			</div>
											
											
											<div class="padding-box-masonry">
											
												<div class="the_title"><h2><a href="<?php the_permalink(); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
												<div class="post-summary"><?php wp_kses_post(the_excerpt()); ?></div>
												<div class="metas">
													<div class="date">
														<p><i class="fa fa-calendar-o"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
													</div>
													
													 <div class="comments-lovepost">
							                            <div class="comments-count">
							                            	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
							                            </div>
							                            
							                            <?php if( function_exists('zilla_likes') ){ ?>
								                        <div class="lovepost"><?php zilla_likes(); ?></div>
								                        <?php } ?>
						                            </div>
												</div>
											
											</div>
											<?php
							    		break;
							    		
							    		case "quote":
							    			?>
							    			<a href="<?php the_permalink(); ?>">
								    			<div class="post-quote">
						                        	<blockquote><i class="fa fa-quote-left"></i> <?php echo wp_kses_post(get_post_meta($postid, 'quote_text_value', true)); ?> <i class="fa fa-quote-right"></i></blockquote>
						                        	<span class="author-quote">-- <?php echo wp_kses_post(get_post_meta($postid, 'quote_author_value', true)); ?> --</span>
						                        </div>
					                        </a>

							    			<?php
							    		break;
		
										case "link":
											?>
											<div class="padding-box-masonry">
												<h2 class="post-title post-link">
													<?php
														$linkurl = get_post_meta($postid, 'link_url_value', true) != '' ? get_post_meta($postid, 'link_url_value', true) : get_permalink();
														$linktext = get_post_meta($postid, 'link_text_value', true) != '' ? get_post_meta($postid, 'link_text_value', true) : $linkurl;
													?>
													<a href="<?php echo esc_url($linkurl); ?>" target="_blank"><?php echo esc_html($linktext); ?></a>
						                        </h2>
						                        
											</div>
											<?php
										break;
							    		
							    		case "text": default:
							    			?>
							    			
							    			<div class="padding-box-masonry">
							    				<div class="the_title no-feature"><h2><a href="<?php the_permalink(); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
												<div class="post-summary"><?php wp_kses_post(the_excerpt()); ?></div>
												<div class="metas">
													<div class="date">
														<p><i class="fa fa-calendar-o"></i><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
													</div>
													
													 <div class="comments-lovepost">
							                            <div class="comments-count">
							                            	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
							                            </div>
							                            
							                            <?php if( function_exists('zilla_likes') ){ ?>
								                        <div class="lovepost"><?php zilla_likes(); ?></div>
								                        <?php } ?>
						                            </div>
												</div>
							    			</div>
							    			
							    			<?php
							    		break;
						    		}
								    ?>
							    
							    
							</div>
						</div>
				    </article>
				    <?php
			    }
			    
			    ?>
	    	</div>
	    <?php
		}
		?>
		<div class="navigation">
			<?php
				$blake_reading_option = get_option('blake_blog_reading_type');
				wp_reset_postdata();
				if ($blake_reading_option != "paged" && $blake_reading_option != "dropdown"){ 
					next_posts_link( '<div class="next-posts"><i class="fa fa-angle-left"></i>'.sprintf(esc_html__("%s", "blake"), get_option("blake_previous_text")).'</div>', $blake_the_query->max_num_pages);  
					previous_posts_link('<div class="prev-posts">'.sprintf(esc_html__("%s", "blake"), get_option("blake_next_text")).'<i class="fa fa-angle-right"></i></div>', $blake_the_query->max_num_pages);  
				} else {
					blake_wp_pagenavi();
				}
			?>	
		</div>
		<?php
	}
	
get_footer(); ?>