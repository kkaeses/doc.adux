<?php

class Blake_RecentPostsSidebar_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'recentPostsSidebar_widget', 'description' => esc_html__('Show your recent blog posts on your site.', 'blake'));
		parent::__construct(false, 'UPPER _ Recent Posts', $widget_ops);
	}

	function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['nposts'])){
			$nposts = esc_attr($instance['nposts']);	
		} else $nposts = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']);  
		} else $categories = "";
		
		if (isset($instance['orderby'])){
			$orderby = esc_attr($instance['orderby']);	
		} else $orderby = "";
		
		if (isset($instance['order'])){
			$order = esc_attr($instance['order']);  	
		} else $order = "";
        
        if (isset($instance['autoplay'])){
			$autoplay = esc_attr($instance['autoplay']); 	
		} else $autoplay = "";
		
        if (isset($instance['hidearrows'])){
			$hidearrows = esc_attr($instance['hidearrows']); 	
		} else $hidearrows = "";
		
		if (isset($instance['hidenav'])){
			$hidenav = esc_attr($instance['hidenav']); 	
		} else $hidenav = "";
		
		if (isset($instance['desktops'])){
			$desktops = esc_attr($instance['desktops']); 	
		} else $desktops = "";
		
		if (isset($instance['tabs'])){
			$tabs = esc_attr($instance['tabs']); 	
		} else $tabs = "";
		
		if (isset($instance['mobiles'])){
			$mobiles = esc_attr($instance['mobiles']); 	
		} else $mobiles = "";
        
        ?>
        
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" ></label></p> 
        <p><label for="<?php echo esc_attr($this->get_field_id('nposts')); ?>">&#8212; <?php esc_html_e('Number Posts to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nposts')); ?>" name="<?php echo esc_attr($this->get_field_name('nposts')); ?>" type="text" value="<?php echo esc_attr($nposts); ?>" ><br><span class="flickr-stuff">If 0 will show all posts.</span></label></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">&#8212; <?php esc_html_e('Categories','blake'); ?> &#8212;<input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($categories); ?>" ></label></p>
       <div class="widget-recent-posts-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		$selected_cats = explode(",", $categories);
		$categories = get_categories( $args );
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input <?php if (in_array($cats->slug, $selected_cats)) echo 'checked="checked" '; ?>onchange="var checked_inputs = []; jQuery(this).closest('.widget-recent-posts-categories').find('input:checked').each(function(){ checked_inputs.push(jQuery(this).val()); }); jQuery(this).closest('.widget-recent-posts-categories').find('.widget-posts-categories').val( checked_inputs.join(',') );" type="checkbox" name="<?php echo esc_attr($cats->slug); ?>" value="<?php echo esc_attr($cats->slug); ?>"><?php echo esc_html($cats->cat_name); ?></label>
				<?php
			}
			?>
			<input style="display:none;" type="text" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widget-posts-categories" value="<?php echo esc_attr($instance['categories']); ?>"  />
			<?php
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php esc_html_e("No Categories defined.", "blake"); ?></i> <?php }
	       
       ?>
       </div>
       
	    <p><label>&#8212; <?php esc_html_e('Order by','blake'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="title" <?php if($orderby == 'title') echo 'checked'; ?>> <?php esc_html_e('Title','blake'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="date" <?php if($orderby == 'date') echo 'checked'; ?>> <?php esc_html_e('Date','blake'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="author" <?php if($orderby == 'author') echo 'checked'; ?>> <?php esc_html_e('Author','blake'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="comment_count" <?php if($orderby == 'comment_count') echo 'checked'; ?>> <?php esc_html_e('Number Comments','blake'); ?><br>
	    </p>
	    <p><label>&#8212; <?php esc_html_e('Order','blake'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('order')); ?>" value="asc" <?php if($order == 'asc') echo 'checked'; ?>> <?php esc_html_e('Ascending','blake'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('order')); ?>" value="desc" <?php if($order == 'desc') echo 'checked'; ?>> <?php esc_html_e('Descending','blake'); ?><br>
	    </p>
	    
		<p class="posts_autoplay_select"><label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">&#8212; <?php esc_html_e('Scroll Items Automatically','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="autoplay" <?php if($autoplay == "autoplay") echo 'checked'; ?> /></label></p>
		
		<p class="posts_hidearrows_select"><label for="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>">&#8212; <?php esc_html_e('Hide Navigation Arrows','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>" name="<?php echo esc_attr($this->get_field_name('hidearrows')); ?>" type="checkbox" value="hidearrows" <?php if($hidearrows == "hidearrows") echo 'checked'; ?> /></label></p>
		
		<p class="posts_hidenav_select"><label for="<?php echo esc_attr($this->get_field_id('hidenav')); ?>">&#8212; <?php esc_html_e('Hide Navigation','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidenav')); ?>" name="<?php echo esc_attr($this->get_field_name('hidenav')); ?>" type="checkbox" value="hidenav" <?php if($hidenav == "hidenav") echo 'checked'; ?> /></label></p>
		
		<h4><?php esc_html_e("Define the number of items to show in each display","blake"); ?></h4>
		<p><label for="<?php echo esc_attr($this->get_field_id('desktops')); ?>">&#8212; <?php esc_html_e('Desktops','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('desktops')); ?>" name="<?php echo esc_attr($this->get_field_name('desktops')); ?>" type="text" value="<?php echo esc_attr($desktops); ?>" /></label></p> 
		
		<p><label for="<?php echo esc_attr($this->get_field_id('tabs')); ?>">&#8212; <?php esc_html_e('Tablets','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tabs')); ?>" name="<?php echo esc_attr($this->get_field_name('tabs')); ?>" type="text" value="<?php echo esc_attr($tabs); ?>" /></label></p> 

		<p><label for="<?php echo esc_attr($this->get_field_id('mobiles')); ?>">&#8212; <?php esc_html_e('Mobiles','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mobiles')); ?>" name="<?php echo esc_attr($this->get_field_name('mobiles')); ?>" type="text" value="<?php echo esc_attr($mobiles); ?>" /></label></p>
		    
		<?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['nposts'] = $new_instance['nposts'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['orderby'] = $new_instance['orderby'];
	    $instance['order'] = $new_instance['order'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['hidearrows'] = $new_instance['hidearrows'];
	    $instance['hidenav'] = $new_instance['hidenav'];
		
		$instance['desktops'] = $new_instance['desktops'];
	    $instance['tabs'] = $new_instance['tabs'];
	    $instance['mobiles'] = $new_instance['mobiles'];

		return $instance;
	}
	
	function widget($args, $instance) {
		$blake_inline_script = '';
		extract($instance);
	    $nposts = ($instance['nposts'] != "" && intval($instance['nposts']) > 0) ? intval($instance['nposts']) : -1;
	    $categories = $instance['categories'];
	    $orderby = $instance['orderby'];
	    $order = $instance['order'];
	    $autoplay = (isset($instance['autoplay'])) ? "yes" : "no";
		$hidearrows = (isset($instance['hidearrows'])) ? "yes" : false;
		$hidenav = (isset($instance['hidenav'])) ? "yes" : false;

		$desktops = $instance['desktops'] ? $instance['desktops'] : 1;
		$tabs = $instance['tabs'] ? $instance['tabs'] : 1;
		$mobiles = $instance['mobiles'] ? $instance['mobiles'] : 1;

	   	global $post, $wp_query;

	   	if ($categories != ""){
		   	$categories = explode(",", $categories);
		   	$catsids = array();
		   	foreach ($categories as $cats){
			   	$aux = get_term_by('slug', $cats, 'category', OBJECT);
			   	$catsids[] = $aux->term_id;
		   	}
		   	$args = array(
				'showposts' => $nposts,
				'orderby' => $orderby,
				'order' => $order,
				'post_status' => 'publish',
				'tax_query' => array(
			        array(
			            'taxonomy' => 'category',
			            'field'    => 'term_slug',
			            'terms'    => $catsids
			        )
			    )
			);
	   	} else {
		   	$args = array(
				'showposts' => $nposts,
				'orderby' => $orderby,
				'order' => $order,
				'post_status' => 'publish'
			);
	   	}
		$losposts = get_posts($args);
		
		global $vc_addons_url;
		wp_enqueue_script('ult-slick');
		wp_enqueue_script('ultimate-appear');
		wp_enqueue_script('ult-slick-custom');
		wp_enqueue_style("ult-slick", $vc_addons_url."assets/min-css/slick.min.css");
		wp_enqueue_style("ult-icons", $vc_addons_url."assets/min-css/icons.min.css");
		wp_enqueue_style("ult-slick-animate", $vc_addons_url."assets/min-css/animate.min.css");		
		
		echo '<div class="widget des_recent_posts_widget">';
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		if (!empty($title)) { echo "<h4>$title</h4><hr>"; }
		
		ob_start();
		$uid = uniqid(rand());
		$uniqid = uniqid(rand());
		echo '<div id="ult-carousel-'.$uniqid.'" class="ult-carousel-wrapper ult_horizontal" data-gutter="10">';
			echo '<div class="ult-carousel-'.$uid.'">';
			if (function_exists('ultimate_override_shortcodes')) ultimate_override_shortcodes(10, 'no-animation');
			foreach ($losposts as $post){
				$posttype = (get_post_meta($post->ID, 'posttype_value', true) == "") ? "text" : get_post_meta($post->ID, 'posttype_value', true);
				echo '<div class="ult-item-wrap '.$posttype.'" data-animation="animated no-animation">';
				
				switch ($posttype){
					case "image":
						if (wp_get_attachment_url( get_post_thumbnail_id($post->ID))){
							?>
							<div class="featured-image">
								<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo wp_kses_post($post->post_title); ?>">
									<img alt="<?php echo esc_attr($post->post_title); ?>" src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID))); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
									<span class="post_overlay">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</span>
								</a>
							</div>
							<?php
						}
					break;
					case "slider":
						$randClass = rand(0,1000);
						?>
						<div class="flexslider <?php echo esc_attr($posttype); ?>" id="<?php echo esc_attr($randClass); ?>">
							<ul class="slides">
								<?php
									$sliderData = get_post_meta($post->ID, "sliderImages_value", true);
									$slide = explode("|*|",$sliderData);
								    foreach ($slide as $s){
								    	if ($s != ""){
								    		$params = explode("|!|",$s);
								    		$attachment = get_post( $params[0] );
								    		echo "<li><img src='".$params[1]."' alt='' title='".$attachment->post_excerpt."'></li>";	
								    	}
								    }
								?>
							</ul>
						</div>
						<?php
						$blake_inline_script .= '
							jQuery(window).load(function(){	
								jQuery("#'.esc_js($randClass).'.flexslider").flexslider({
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
					break;
					case "audio":
		    			?>
						<div class="audioContainer">
							<?php
								if (get_post_meta($post->ID, 'audioSource_value', true) == 'embed') echo get_post_meta($post->ID, 'audioCode_value', true); 
								else {
									$audio = explode("|!|",get_post_meta($post->ID, 'audioMediaLibrary_value', true));
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
						<?php
		    		break;
		    		
		    		case "video":
		    			?>
		    			<div class="post-video">
							<div class="video-thumb">
								<div class="video-wrapper vendor">
								<?php
									$videosType = get_post_meta($post->ID, "videoSource_value", true);
									if ($videosType != "embed"){
										$videos = get_post_meta($post->ID, "videoCode_value", true);
										$videos = preg_replace( '/\s+/', '', $videos );
										$vid = explode(",",$videos);
									}
									switch (get_post_meta($post->ID, "videoSource_value", true)){
										case "media":
											$video = explode("|!|",get_post_meta($post->ID, 'videoMediaLibrary_value', true));
											if (isset($video[1])) {
												$ext = explode(".",$video[1]);
												if (isset($ext)) $ext = $ext[count($ext)-1];
												?>
												<video controls="controls" style="width: 100%;"><source type="video/<?php echo esc_attr($ext); ?>" src="<?php echo esc_url($video[1]); ?>"></video>
												<?php
											}
										break;
										case "youtube":
											if (isset($vid[0])) echo "<iframe src='//www.youtube.com/embed/".$vid[0]."' frameborder='0' allowfullscreen></iframe>";
											break;
										case "vimeo":
											if (isset($vid[0])) echo '<iframe src="https://player.vimeo.com/video/'.$vid[0].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
											break;
									}						
								?>
								</div>
							</div>
						</div>
						<?php
		    		break;
				}
				?>
				<div class="title"><a href="<?php echo get_permalink($post->ID); ?>"><h4><?php echo wp_kses_post($post->post_title); ?></h4></a></div>
				
				<?php
					if ($posttype != "quote" && $posttype != "link"){
						?>
						<div class="excerpt"><?php
							$content = $post->post_content;
							$pos=strpos($content, '<!--more-->');
							$more_tag = '';
							if ($pos){
								$text = explode('<!--more-->', $content);
								$text = $text[0];
								$text = strip_shortcodes( $text );				
						        $text = apply_filters('the_content', $text);
						        $text = str_replace(']]>', ']]&gt;', $text);
								echo wp_kses_post($text." ".$more_tag);
							} else {
								$text = strip_shortcodes( $post->post_content );				
						        $text = apply_filters('the_content', $text);
						        $text = str_replace(']]>', ']]&gt;', $text);
						        $excerpt_length = apply_filters('excerpt_length', 55);
						        $excerpt_more = apply_filters('excerpt_more', ' ' . $more_tag);
						        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
								echo apply_filters('wp_trim_excerpt', $text);
							}
						?></div>
					<?php
					}
				?>
				<div class="metas">
					<div class="date">
						<p><?php echo get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y"); ?></p>
					</div>
					
					 <div class="comments-lovepost">
                        <div class="comments-count">
                        	<p><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></p>
                        </div>
                       
                    </div>
				</div>
				<?php
					if ($posttype == "quote" || $posttype == "link"){
						if ($posttype == "quote"){
							?>
							<div class="post-quote">
	                        	<blockquote><i class="fa fa-quote-left"></i> <?php echo get_post_meta($post->ID, 'quote_text_value', true); ?> <i class="fa fa-quote-right"></i></blockquote>
	                        	<span class="author-quote">-- <?php echo get_post_meta($post->ID, 'quote_author_value', true); ?> --</span>
	                        </div>
							<?php
						} else {
							?>
							<h2 class="post-title post-link">
								<?php
									$linkurl = get_post_meta($post->ID, 'link_url_value', true) != '' ? get_post_meta($post->ID, 'link_url_value', true) : get_permalink($post->ID);
									$linktext = get_post_meta($post->ID, 'link_text_value', true) != '' ? get_post_meta($post->ID, 'link_text_value', true) : $linkurl;
								?>
								<a href="<?php echo esc_url($linkurl); ?>" target="_blank"><?php echo wp_kses_post($linktext); ?></a>
	                        </h2>
							<?php
						}
					}
				echo '</div>';
			}
			ultimate_restore_shortcodes();
			echo '</div>';
		echo '</div>';
		
		$blake_inline_script .= '
			jQuery(document).ready(function(){
				jQuery(".ult-carousel-'.esc_js($uid).'").slick({';
					if (!$hidenav) $blake_inline_script .= 'dots:true,';
					if ($autoplay=='yes') $blake_inline_script .= 'autoplay:true,autoplaySpeed:5000,';
					$blake_inline_script .= 'speed:300,infinite:true,';
					if (!$hidearrows) $blake_inline_script .= 'arrows:true,';
					$blake_inline_script .= 'adaptiveHeight:true,';
					if (!$hidearrows){
						$blake_inline_script .= 'prevArrow:"<button type=\'button\' style=\'color: rgb(51, 51, 51); font-size: 24px; display: block;\' class=\'slick-prev default\'><i class=\'ultsl-arrow-left6\'></i></button>",nextArrow:"<button type=\'button\' style=\'color: rgb(51, 51, 51); font-size: 24px; display: block;\' class=\'slick-next default\'><i class=\'ultsl-arrow-right6\'></i></button>",';
					}
					$blake_inline_script .= 'slidesToScroll:'.esc_js($desktops).',slidesToShow:'.esc_js($desktops).',swipe:true,draggable:true,touchMove:true,responsive:[{breakpoint:1024,settings:{slidesToShow:'.esc_js($desktops).',slidesToScroll:'.esc_js($desktops).'}},{breakpoint:767,settings:{slidesToShow:'.esc_js($tabs).',slidesToScroll:'.esc_js($tabs).'}},{breakpoint:480,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}},{breakpoint:0,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}}],pauseOnHover:true,pauseOnDotsHover:true,mobileFirst:true,customPaging:function(slider,i){return "<i type=\'button\' style=\'color:#333333;\' class=\'ultsl-record\' data-role=\'none\'></i>";},});
			});
		';
		wp_add_inline_script('blake', $blake_inline_script, 'after');
		
		echo ob_get_clean();
		
		echo '</div>';
		
	}
}
register_widget('Blake_RecentPostsSidebar_Widget');

?>
