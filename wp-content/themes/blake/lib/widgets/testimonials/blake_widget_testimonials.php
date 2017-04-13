<?php

class Blake_Testimonials_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'testimonials_widget', 'description' => esc_html__('Show your testimonials on your site.','blake'));
		parent::__construct(false, 'UPPER _ Testimonials', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['autoplay'])){
			$autoplay = esc_attr($instance['autoplay']); 	
		} else $autoplay = "";
		
		if (isset($instance['hidearrows'])){
			$hidearrows = esc_attr($instance['hidearrows']); 	
		} else $hidearrows = "";
		
		if (isset($instance['hidenav'])){
			$hidenav = esc_attr($instance['hidenav']); 	
		} else $hidenav = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']); 	
		} else $categories = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
		if (isset($instance['hideauthor'])){
			$hideauthor = esc_attr($instance['hideauthor']); 	
		} else $hideauthor = "";
		
		if (isset($instance['hidecompany'])){
			$hidecompany = esc_attr($instance['hidecompany']); 	
		} else $hidecompany = "";
		
?>  
        
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
       <p><label for="<?php echo esc_attr($this->get_field_id('nshow')); ?>">&#8212; <?php esc_html_e('Number Testimonials to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nshow')); ?>" name="<?php echo esc_attr($this->get_field_name('nshow')); ?>" type="text" value="<?php echo esc_attr($nshow); ?>" /><br><span class="flickr-stuff">If 0 will show all testimonials.</span></label></p>
       <p class="testimonials_autoplay_select"><label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">&#8212; <?php esc_html_e('Scroll Items Automatically','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="autoplay" <?php if($autoplay == "autoplay") echo 'checked'; ?>/></label></p>       
	   
	   <p class="testimonials_hidearrows_select"><label for="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>">&#8212; <?php esc_html_e('Hide Navigation Arrows','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>" name="<?php echo esc_attr($this->get_field_name('hidearrows')); ?>" type="checkbox" value="hidearrows" <?php if($hidearrows == "hidearrows") echo 'checked'; ?> /></label></p>
		
		<p class="testimonials_hidenav_select"><label for="<?php echo esc_attr($this->get_field_id('hidenav')); ?>">&#8212; <?php esc_html_e('Hide Navigation','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidenav')); ?>" name="<?php echo esc_attr($this->get_field_name('hidenav')); ?>" type="checkbox" value="hidenav" <?php if($hidenav == "hidenav") echo 'checked'; ?> /></label></p>

       <p><label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">&#8212; <?php esc_html_e('Categories','blake'); ?> &#8212;</label><input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($categories); ?>" /></p>
       <div class="widget-testimonials-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'testimonials_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		$selected_cats = explode(",", $categories);
		$categories = get_categories($args);
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input <?php if (in_array($cats->slug, $selected_cats)) echo 'checked="checked" '; ?>onchange="var checked_inputs = []; jQuery(this).closest('.widget-testimonials-categories').find('input:checked').each(function(){ checked_inputs.push(jQuery(this).val()); }); jQuery(this).closest('.widget-testimonials-categories').find('.widget-testimonials-categories').val( checked_inputs.join(',') );" type="checkbox" name="<?php echo esc_attr($cats->slug); ?>" value="<?php echo esc_attr($cats->slug); ?>"><?php echo esc_attr($cats->cat_name); ?></label>
				<?php
			}
			?>
			<input style="display:none;" type="text" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widget-testimonials-categories" value="<?php echo esc_attr($instance['categories']); ?>"  />
			<?php
		} else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php esc_html_e("No Categories defined.", "blake"); ?></i> <?php }
	       
       ?>
       </div>
       
       <p><label for="<?php echo esc_attr($this->get_field_id('hideauthor')); ?>">&#8212; <?php esc_html_e('Hide Author','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hideauthor')); ?>" name="<?php echo esc_attr($this->get_field_name('hideauthor')); ?>" type="checkbox" value="hideauthor" <?php if($hideauthor == "hideauthor") echo 'checked'; ?>/></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('hidecompany')); ?>">&#8212; <?php esc_html_e('Hide Company','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidecompany')); ?>" name="<?php echo esc_attr($this->get_field_name('hidecompany')); ?>" type="checkbox" value="hidecompany" <?php if($hidecompany == "hidecompany") echo 'checked'; ?>/></label></p> 
        
<?php
	}
function update($new_instance, $old_instance) {
	// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['hideauthor'] = $new_instance['hideauthor'];
	    $instance['hidecompany'] = $new_instance['hidecompany'];
   	    $instance['hidearrows'] = $new_instance['hidearrows'];
	    $instance['hidenav'] = $new_instance['hidenav'];
		return $instance;
	}
	
function widget($args, $instance) {
	
	global $vc_addons_url;		
	wp_enqueue_script('ult-slick');
	wp_enqueue_script('ultimate-appear');
	wp_enqueue_script('ult-slick-custom');
	wp_enqueue_style("ult-slick", $vc_addons_url."assets/min-css/slick.min.css");
	wp_enqueue_style("ult-icons", $vc_addons_url."assets/min-css/icons.min.css");
	wp_enqueue_style("ult-slick-animate", $vc_addons_url."assets/min-css/animate.min.css");


	extract($instance);	
	if(empty($nshow) || $nshow == 0 ) $nshow = -1;
	$autoplay = (isset($instance['autoplay'])) ? "yes" : "no";
    $hidearrows = (isset($instance['hidearrows'])) ? "yes" : false;
	$hidenav = (isset($instance['hidenav'])) ? "yes" : false;
	$hideauthor = (isset($instance['hideauthor'])) ? "yes" : false;
	$hidecompany = (isset($instance['hidecompany'])) ? "yes" : false;
    $thecats = array();
    if (strlen($categories) > 0 ){
    	$cats = explode("|*|",$categories);
    	foreach($cats as $c){
    		if ($c != ""){
    			array_push($thecats, $c);
    		}
    	}
    }
    $qargs = array(
			'numberposts' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'testimonials',
			'post_status' => 'publish' );
		
	$testi = get_posts( $qargs );
	$filteredtestis = array();
	
	foreach ($testi as $t){
		$testcats = get_the_terms($t->ID, 'testimonials_category');
		$found = false;
		if (is_array($testcats)){
			foreach ($testcats as $ttcats){
				foreach ($thecats as $tc){
					if ($ttcats->slug == $tc) $found = true;	
				}
			}
			if ($found) {
				array_push($filteredtestis, $t);
				$testi = $filteredtestis;
			}	
		}
	}
	
	echo '<div class="widget des_testimonials_widget">';
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		if (!empty($title)) { echo "<h4>$title</h4><hr>"; }
		
		ob_start();
		$uid = uniqid(rand());
		$uniqid = uniqid(rand());
		echo '<div id="ult-carousel-'.$uniqid.'" class="ult-carousel-wrapper ult_horizontal" data-gutter="10">';
			echo '<div class="ult-carousel-'.$uid.'">';
			ultimate_override_shortcodes(10, 'no-animation');
			foreach ($testi as $t){
				echo '<div class="ult-item-wrap" data-animation="animated no-animation">';
				
		      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != ""){
			      	?>
			      	<div class="featured_image_widget">
				  		<div class="rotate-bg"></div>
				  		<img title="<?php echo get_post_meta($t->ID, "author_value", true); ?>" alt="<?php echo get_post_meta($t->ID, "author_value", true); ?>" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($t->ID)); ?>" />
				  	</div>
			      	<?php
		      	}
		      	?>
		      	<div class="testi-text">
			      	<p><?php 
				      		if (function_exists('wpb_js_remove_wpautop') == true)
								echo wpb_js_remove_wpautop($t->post_content);
							else echo wp_kses_post($t->post_content);
				      	?>
				    </p>
		      	</div>
		      	<div class="testi-info">
		      	<?php
		      		if ($hideauthor != "yes"){
			      		if (get_post_meta($t->ID, "author_link_value", true) != ""){
		      				?>
		      				<span class="author">
		      					<a href="<?php echo get_post_meta($t->ID, "author_link_value", true); ?>"><?php echo get_post_meta($t->ID, "author_value", true); ?></a>
		      				</span>
		      				<?php
	      				}
	      				else {
		      				?>
		      				<span class="author"><?php echo get_post_meta($t->ID, "author_value", true); ?></span>
		      				<?php
	      				}
		      		}
		      		if ($hideauthor != "yes" && $hidecompany != "yes"){
			      		?><span style="position:relative;left: -2px;">, </span><?php
		      		}
		      		if ($hidecompany != "yes"){
			      		if (get_post_meta($t->ID, "company_link_value", true) != ""){
				  			?>
				  			<span class="company">
				  				<a href="<?php echo get_post_meta($t->ID, "company_link_value", true); ?>"><?php echo get_post_meta($t->ID, "company_value", true); ?></a>
				  			</span>
				  			<?php
			      		} else {
			      			?>
			      			<span class="company"><?php echo get_post_meta($t->ID, "company_value", true); ?></span>
				  			<?php
		      			}
	      			}
		      		?>		      		
				</div>
				<?php

				echo '</div>';
			}
			ultimate_restore_shortcodes();
			echo '</div>';
		echo '</div>';
		
	echo '</div>';
	
	$blake_inline_script = '
		jQuery(document).ready(function(){
			jQuery(".ult-carousel-'.esc_js($uid).'").slick({';
			if (!$hidenav) $blake_inline_script .= 'dots:true,';
			if ($autoplay=='yes') $blake_inline_script .= 'autoplay:true,autoplaySpeed:5000,';
			$blake_inline_script .= 'speed:300,infinite:true,';
			if (!$hidearrows) $blake_inline_script .= 'arrows:true,';
			$blake_inline_script .= 'adaptiveHeight:true,';
			if (!$hidearrows){
				$blake_inline_script .= 'nextArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-next default\'><i class=\'ultsl-arrow-right6\'></i></button>",prevArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-prev default\'><i class=\'ultsl-arrow-left6\'></i></button>",';
			}
			$blake_inline_script .= 'slidesToScroll:1,slidesToShow:1,swipe:true,draggable:true,touchMove:true,responsive:[{breakpoint:1024,settings:{slidesToShow:1,slidesToScroll:1,}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}],pauseOnHover:true,pauseOnDotsHover:true,customPaging:function(slider,i){return "<i type=\'button\' style=\'color:#333333;\' class=\'ultsl-record\' data-role=\'none\'></i>";},});
		});
	';
	wp_add_inline_script('blake', $blake_inline_script, 'after');

	echo ob_get_clean();

	}
}
register_widget('Blake_Testimonials_Widget');

?>
