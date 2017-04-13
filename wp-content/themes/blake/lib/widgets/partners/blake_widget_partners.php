<?php

class Blake_Partners_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'partners_widget', 'description' => esc_html__('Show your partners on your site.','blake'));
		parent::__construct(false, 'UPPER _ Partners', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";

		if (isset($instance['effect'])){
			$effect = esc_attr($instance['effect']); 	
		} else $effect = "";		
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']); 	
		} else $categories = "";
		
		if (isset($instance['nshow'])){
			$nshow = esc_attr($instance['nshow']);  	
		} else $nshow = "";
		
		if (isset($instance['autoplay'])){
			$autoplay = esc_attr($instance['autoplay']); 	
		} else $autoplay = "";
		
		if (isset($instance['hidearrows'])){
			$hidearrows = esc_attr($instance['hidearrows']); 	
		} else $hidearrows = "";
		
		if (isset($instance['hidenav'])){
			$hidenav = esc_attr($instance['hidenav']); 	
		} else $hidenav = "";
		
		if (isset($instance['tooltip'])){
			$tooltip = esc_attr($instance['tooltip']); 	
		} else $tooltip = "";
?>  
        
      <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo wp_kses_post($title); ?>" /></label></p> 
       
       <p>
	        <label>&#8212; <?php esc_html_e('Partners Effect','blake'); ?> &#8212;<br>
	        <select id="<?php echo esc_attr($this->get_field_id('effect')); ?>" name="<?php echo esc_attr($this->get_field_name('effect')); ?>" style="margin-left:15px;">
		        <option value='opacity' <?php if ($effect == "opacity") echo "selected"; ?>>Opacity</option>
		        <option value='greyscale' <?php if ($effect == "greyscale") echo "selected"; ?>>Greyscale</option>
	        </select>
	        </label>
	    </p>
       
        <p><label for="<?php echo esc_attr($this->get_field_id('tooltip')); ?>">&#8212; <?php esc_html_e('Display Tooltip','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('tooltip')); ?>" name="<?php echo esc_attr($this->get_field_name('tooltip')); ?>" type="checkbox" value="tooltip" <?php if($tooltip == "tooltip") echo 'checked'; ?> /></label></p>
       
       <p><label for="<?php echo esc_attr($this->get_field_id('nshow')); ?>">&#8212; <?php esc_html_e('Number Partners to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nshow')); ?>" name="<?php echo esc_attr($this->get_field_name('nshow')); ?>" type="text" value="<?php echo esc_attr($nshow); ?>" /><br><span class="flickr-stuff">If 0 will show all partners.</span></label></p>
       
       <p><label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">&#8212; <?php esc_html_e('Categories','blake'); ?> &#8212;<input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($categories); ?>" /></label></p>
       <div class="widget-partners-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'partners_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		$selected_cats = explode(",", $categories);
		$categories = get_categories($args);
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input <?php if (in_array($cats->slug, $selected_cats)) echo 'checked="checked" '; ?>onchange="var checked_inputs = []; jQuery(this).closest('.widget-partners-categories').find('input:checked').each(function(){ checked_inputs.push(jQuery(this).val()); }); jQuery(this).closest('.widget-partners-categories').find('.widget-partners-categories').val( checked_inputs.join(',') );" type="checkbox" name="<?php echo esc_attr($cats->slug); ?>" value="<?php echo esc_attr($cats->slug); ?>"><?php echo esc_attr($cats->cat_name); ?></label>
				<?php
			}
			?>
			<input style="display:none;" type="text" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widget-partners-categories" value="<?php echo esc_attr($instance['categories']); ?>"  />
			<?php
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php esc_html_e("No Categories defined.", "blake"); ?></i> <?php }
       ?>
       </div>  
       
       <p class="partners_autoplay_select"><label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">&#8212; <?php esc_html_e('Scroll Items Automatically','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="autoplay" <?php if($autoplay == "autoplay") echo 'checked'; ?> /></label></p>
        
        <p class="partners_hidearrows_select"><label for="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>">&#8212; <?php esc_html_e('Hide Navigation Arrows','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>" name="<?php echo esc_attr($this->get_field_name('hidearrows')); ?>" type="checkbox" value="hidearrows" <?php if($hidearrows == "hidearrows") echo 'checked'; ?> /></label></p>
		
		<p class="partners_hidenav_select"><label for="<?php echo esc_attr($this->get_field_id('hidenav')); ?>">&#8212; <?php esc_html_e('Hide Navigation','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidenav')); ?>" name="<?php echo esc_attr($this->get_field_name('hidenav')); ?>" type="checkbox" value="hidenav" <?php if($hidenav == "hidenav") echo 'checked'; ?> /></label></p>
       <?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['effect'] = $new_instance['effect'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['hidearrows'] = $new_instance['hidearrows'];
	    $instance['hidenav'] = $new_instance['hidenav'];
	    $instance['tooltip'] = $new_instance['tooltip'];
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
		$title = apply_filters('widget_title', $instance['title'], $instance);
	    $autoplay = (isset($instance['autoplay'])) ? "yes" : "no";
	    $hidearrows = (isset($instance['hidearrows'])) ? "yes" : false;
		$hidenav = (isset($instance['hidenav'])) ? "yes" : false;
		if (empty($nshow) || $nshow == 0 ) $nshow = -1;
	    
	    $thecats = array();
		if ($categories != "all"){
	    	$cats = explode(",",$categories);
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		$args = array(
			'numberposts' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'partners',
			'post_status' => 'publish' 
		);
		$partners = get_posts( $args );	
		$filteredpartners = array();
		if ($categories != "all"){
			foreach ($partners as $p){
				$partnerscats = get_the_terms($p->ID, 'partners_category');
				$found = false;
				if (!empty($partnerscats)){
					foreach ($partnerscats as $pcats){
						foreach ($thecats as $pc){
							if ($pcats->slug == $pc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredpartners, $p);
						$partners = $filteredpartners;
					}
				}
			}			
		}
		
		$tooltip = ($tooltip == "tooltip") ? "withtooltip" : "";
	    
	    global $vc_addons_url;
	    wp_enqueue_script('ult-slick');
		wp_enqueue_script('ultimate-appear');
		wp_enqueue_script('ult-slick-custom');
		wp_enqueue_style("ult-slick", $vc_addons_url."assets/min-css/slick.min.css");
		wp_enqueue_style("ult-icons", $vc_addons_url."assets/min-css/icons.min.css");
		wp_enqueue_style("ult-slick-animate", $vc_addons_url."assets/min-css/animate.min.css");
	    
	    echo '<div class="widget des_partners_widget '.$tooltip.'">';
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		if (!empty($title)) { echo "<h4>$title</h4><hr>"; }
		
		ob_start();
		$uid = uniqid(rand());
		$uniqid = uniqid(rand());
		echo '<div id="ult-carousel-'.$uniqid.'" class="ult-carousel-wrapper ult_horizontal" data-gutter="10">';
			echo '<div class="ult-carousel-'.$uid.'">';
			ultimate_override_shortcodes(10, 'no-animation');
			foreach ($partners as $post){
				echo '<div class="ult-item-wrap" data-animation="animated no-animation">';
				$output = "";
				$output .= "<a target='_blank' href='";
				if (get_post_meta($post->ID, 'link_value', true) != ""){
					$output .= get_post_meta($post->ID, 'link_value', true);
				} else $output .= "javascript:;";
				$output .= "' title='".$post->post_title."'><img class='logopartner' src='".wp_get_attachment_url( get_post_thumbnail_id($post->ID))."' alt='".$post->post_title."' title='".$post->post_title."'/></a>";
				echo wp_kses_hook($output, 'post', array()); // WP changed the order of these funcs and added args to wp_kses_hook
				echo '</div>';
			}
			ultimate_restore_shortcodes();
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
					$blake_inline_script .= 'slidesToScroll:1,slidesToShow:1,swipe:true,draggable:true,touchMove:true,responsive:[{breakpoint:1024,settings:{slidesToShow:1,slidesToScroll:1,}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}],pauseOnHover:true,pauseOnDotsHover:true,customPaging:function(slider,i){return "<i type=\'button\' style=\'color:#333333;\' class=\'ultsl-record\' data-role=\'none\'></i>";},});';
					
					if ($tooltip == 'withtooltip'){
						$blake_inline_script .= 'jQuery(".ult-carousel-'.esc_js($uid).' .ult-item-wrap > a").tooltip();';
					}
					
		$blake_inline_script .= '
			});
		';
		if ($effect == 'greyscale'){
			$blake_inline_script .= '
			jQuery(window).load(function(){
				jQuery("#ult-carousel-'.esc_js($uniqid).'").find(".logopartner").each(function(){jQuery(this).greyScale({fadeTime:500,reverse:false});});
			});
			';
		}
		wp_add_inline_script('blake', $blake_inline_script, 'after');
		
	    echo ob_get_clean();
		
		echo '</div>';
	}
}
register_widget('Blake_Partners_Widget');

?>
