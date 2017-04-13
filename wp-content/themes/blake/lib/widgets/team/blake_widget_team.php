<?php

class Blake_Team_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'team_widget', 'description' => esc_html__('Show your team on your site.','blake'));
		parent::__construct(false, 'UPPER _ Team', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";		

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
?>  
        
      <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
       
       <p><label for="<?php echo esc_attr($this->get_field_id('nshow')); ?>">&#8212; <?php esc_html_e('Number Team to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nshow')); ?>" name="<?php echo esc_attr($this->get_field_name('nshow')); ?>" type="text" value="<?php echo esc_attr($nshow); ?>" /><br><span class="flickr-stuff">If 0 will show all your team members.</span></label></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">&#8212; <?php esc_html_e('Categories','blake'); ?> &#8212;<input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($categories); ?>" /></label></p>
        
       <div class="widget-team-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'team_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		$selected_cats = explode(",", $categories);
		$categories = get_categories($args);
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input <?php if (in_array($cats->slug, $selected_cats)) echo 'checked="checked" '; ?>onchange="var checked_inputs = []; jQuery(this).closest('.widget-team-categories').find('input:checked').each(function(){ checked_inputs.push(jQuery(this).val()); }); jQuery(this).closest('.widget-team-categories').find('.widget-team-categories').val( checked_inputs.join(',') );" type="checkbox" name="<?php echo esc_attr($cats->slug); ?>" value="<?php echo esc_attr($cats->slug); ?>"><?php echo esc_attr($cats->cat_name); ?></label>
				<?php
			}
			?>
			<input style="display:none;" type="text" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widget-team-categories" value="<?php echo esc_attr($instance['categories']); ?>"  />
			<?php
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php esc_html_e("No Categories defined.", "blake"); ?></i> <?php }
       ?>
       </div>
	   
	    <p class="team_autoplay_select"><label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">&#8212; <?php esc_html_e('Scroll Items Automatically','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="autoplay" <?php if($autoplay == "autoplay") echo 'checked'; ?>/></label></p>
	   
	   <p class="team_hidearrows_select"><label for="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>">&#8212; <?php esc_html_e('Hide Navigation Arrows','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>" name="<?php echo esc_attr($this->get_field_name('hidearrows')); ?>" type="checkbox" value="hidearrows" <?php if($hidearrows == "hidearrows") echo 'checked'; ?> /></label></p>
		
		<p class="team_hidenav_select"><label for="<?php echo esc_attr($this->get_field_id('hidenav')); ?>">&#8212; <?php esc_html_e('Hide Navigation','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidenav')); ?>" name="<?php echo esc_attr($this->get_field_name('hidenav')); ?>" type="checkbox" value="hidenav" <?php if($hidenav == "hidenav") echo 'checked'; ?> /></label></p>

	<?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['nshow'] = $new_instance['nshow'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['categories'] = $new_instance['categories'];
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
		$title = apply_filters('widget_title', $instance['title'], $instance);
	    $autoplay = (isset($instance['autoplay'])) ? "yes" : "no";
   	    $hidearrows = (isset($instance['hidearrows'])) ? "yes" : false;
		$hidenav = (isset($instance['hidenav'])) ? "yes" : false;

		if(empty($nshow) || $nshow == 0 ) $nshow = -1;

		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
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
			'post_type' => 'team',
			'post_status' => 'publish' 
		);
			
		$team = get_posts( $args );
		$filteredteam = array();
		
		if ($categories != "all"){
			foreach ($team as $t){
				$teamcats = get_the_terms($t->ID, 'team_category');
				$found = false;
				if (is_array($teamcats) && !empty($teamcats)){
					foreach ($teamcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredteam, $t);
						$team = $filteredteam;
					}	
				}
			}			
		}
	

		echo '<div class="widget des_team_widget">';
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		if (!empty($title)) { echo "<h4>$title</h4><hr>"; }
		
		ob_start();
		$uid = uniqid(rand());
		$uniqid = uniqid(rand());
		echo '<div id="ult-carousel-'.$uniqid.'" class="ult-carousel-wrapper ult_horizontal" data-gutter="10">';
			echo '<div class="ult-carousel-'.$uid.'">';
			ultimate_override_shortcodes(10, 'no-animation');
			
			static $blake_team_index = 1;
			$blake_team_index_aux = 1;

			foreach ($team as $t){
				
				echo '<div class="ult-item-wrap" data-animation="animated no-animation">';
				
				$output = "";
				$output .= '<a data-toggle="modal" href="#widget-member'.$blake_team_index.'-'.$blake_team_index_aux.'" class="modal-popup-link team-profile profile-id-'.$t->ID.'"><img src="'; 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $t->ID ), 'single-post-thumbnail' );
				$output .= $image[0];
				$output .= '" alt="'.$t->post_title.'" class="animated fadeInUp" style="opacity: 1;" /><div class="tooltip-desc"><div class="tooltip-content"><p><strong>'.$t->post_title.'</strong></p></div></div></a>';
				$blake_team_index_aux++;
				if (function_exists('wpb_js_remove_wpautop') == true)
					echo wpb_js_remove_wpautop($output);
				else echo wp_kses_post($output);
				echo '</div>';
			}
			//$output .= '</div>';
			ultimate_restore_shortcodes();
			echo '</div>';
		echo '</div>';
		
		echo '</div>';
		
		$blake_team_index_aux = 1;
		
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
		
		$team_profile_contents = '';
		foreach ($team as $t){
			$team_profile_contents .= '<div id="widget-member'.$blake_team_index.'-'.$blake_team_index_aux.'" class="modal team_member_profile_content"><div class="container">'.do_shortcode($t->post_content).'</div><a href="#" class="close" data-dismiss="modal">x</a></div>';
			$blake_team_index_aux++;
		}
		blake_set_team_profiles_content($team_profile_contents);
		echo ob_get_clean();
		$blake_team_index++;
		
	}
}
register_widget('Blake_Team_Widget');

?>
