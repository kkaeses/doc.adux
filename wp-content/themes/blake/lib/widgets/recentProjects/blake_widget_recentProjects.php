<?php

class Blake_Projects_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'projects_widget', 'description' => esc_html__('Show your Projects on your site.','blake'));
		parent::__construct(false, 'UPPER _ Projects', $widget_ops);
	}
	function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['cubeid'])){
			$cubeid = esc_attr($instance['cubeid']); 	
		} else $cubeid = "";		
		
		if (isset($instance['autoplay'])){
			$autoplay = esc_attr($instance['autoplay']); 	
		} else $autoplay = "";

		if (isset($instance['desktops'])){
			$desktops = esc_attr($instance['desktops']); 	
		} else $desktops = "";
		
		if (isset($instance['tabs'])){
			$tabs = esc_attr($instance['tabs']); 	
		} else $tabs = "";
		
		if (isset($instance['mobiles'])){
			$mobiles = esc_attr($instance['mobiles']); 	
		} else $mobiles = "";
		
		if (isset($instance['hidearrows'])){
			$hidearrows = esc_attr($instance['hidearrows']); 	
		} else $hidearrows = "";
		
		if (isset($instance['hidenav'])){
			$hidenav = esc_attr($instance['hidenav']); 	
		} else $hidenav = "";
		
		?>  
                
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
       
       <!-- NEW -->
       <p>
	        <label>&#8212; <?php esc_html_e('Cube Portfolio','blake'); ?> &#8212;<br>
	        <?php
				global $wpdb, $table_prefix;
		        $sql = "SELECT id, name FROM ".$table_prefix."cubeportfolio WHERE active=%d";
		        $cbps = $wpdb->get_results($wpdb->prepare($sql, 1));
				
				if (!empty($cbps)){
					?>
					<select id="<?php echo esc_attr($this->get_field_id('cubeid')); ?>" name="<?php echo esc_attr($this->get_field_name('cubeid')); ?>" style="margin-left:15px;">
					<?php
					foreach($cbps as $cbp){
						?>
						<option value="<?php echo esc_attr($cbp->id); ?>" <?php if ($cubeid == $cbp->id) echo "selected"; ?>><?php echo esc_html($cbp->name); ?></option>
						<?php
			        }
			        ?>
					</select>
			        <?php
				} else {
					?>
					<p><?php esc_html_e("There are no cubeportolio instances.", "blake"); ?></p>
					<?php
				}
	        ?>
	        </label>
	    </p>
       <!-- NEW -->

	   <p class="projects_autoplay_select"><label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">&#8212; <?php esc_html_e('Scroll Items Automatically','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="autoplay" <?php if($autoplay == "autoplay") echo 'checked'; ?>/></label></p>
	   
	   <p class="projects_hidearrows_select"><label for="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>">&#8212; <?php esc_html_e('Hide Navigation Arrows','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidearrows')); ?>" name="<?php echo esc_attr($this->get_field_name('hidearrows')); ?>" type="checkbox" value="hidearrows" <?php if($hidearrows == "hidearrows") echo 'checked'; ?> /></label></p>
		
		<p class="projects_hidenav_select"><label for="<?php echo esc_attr($this->get_field_id('hidenav')); ?>">&#8212; <?php esc_html_e('Hide Navigation','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('hidenav')); ?>" name="<?php echo esc_attr($this->get_field_name('hidenav')); ?>" type="checkbox" value="hidenav" <?php if($hidenav == "hidenav") echo 'checked'; ?> /></label></p>
	   
		<h4><?php esc_html_e("Define the number of items to show in each display","blake"); ?></h4>
		<p><label for="<?php echo esc_attr($this->get_field_id('desktops')); ?>">&#8212; <?php esc_html_e('Desktops','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('desktops')); ?>" name="<?php echo esc_attr($this->get_field_name('desktops')); ?>" type="text" value="<?php echo esc_attr($desktops); ?>" /></label></p> 
		
		<p><label for="<?php echo esc_attr($this->get_field_id('tabs')); ?>">&#8212; <?php esc_html_e('Tablets','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tabs')); ?>" name="<?php echo esc_attr($this->get_field_name('tabs')); ?>" type="text" value="<?php echo esc_attr($tabs); ?>" /></label></p> 

		<p><label for="<?php echo esc_attr($this->get_field_id('mobiles')); ?>">&#8212; <?php esc_html_e('Mobiles','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mobiles')); ?>" name="<?php echo esc_attr($this->get_field_name('mobiles')); ?>" type="text" value="<?php echo esc_attr($mobiles); ?>" /></label></p> 

		<?php
		$blake_admin_inline_script = '
			jQuery(document).ready(function(){
				jQuery("#'.esc_js($this->get_field_id('cubeid')).'").change(function(){ jQuery(this).find("option[selected]").removeAttr("selected"); });
			});
		';
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
	}
	
	function update($new_instance, $old_instance) {
	// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['cubeid'] = $new_instance['cubeid'];
	    $instance['autoplay'] = $new_instance['autoplay'];
	    $instance['desktops'] = $new_instance['desktops'];
	    $instance['tabs'] = $new_instance['tabs'];
	    $instance['mobiles'] = $new_instance['mobiles'];
   	    $instance['hidearrows'] = $new_instance['hidearrows'];
	    $instance['hidenav'] = $new_instance['hidenav'];

		return $instance;
	}
	
	function widget($args, $instance) {
		
		global $vc_addons_url;		
		wp_enqueue_style('cubeportfolio-jquery-css');
        wp_enqueue_script('cubeportfolio-jquery-js');
        wp_enqueue_media();
		
		extract($instance);
		$title = apply_filters('widget_title', $instance['title'], $instance);
		$cubeid = $instance['cubeid'] ? $instance['cubeid'] : -1;
		$autoplay = (isset($instance['autoplay'])) ? "yes" : "no";
		$desktops = $instance['desktops'] ? $instance['desktops'] : 1;
		$tabs = $instance['tabs'] ? $instance['tabs'] : 1;
		$mobiles = $instance['mobiles'] ? $instance['mobiles'] : 1;
   	    $hidearrows = (isset($instance['hidearrows'])) ? "yes" : false;
		$hidenav = (isset($instance['hidenav'])) ? "yes" : false;
		
		$getCube = do_shortcode('[cubeportfolio id="'.$cubeid.'"]');
		global $getCubeCSS;
		global $vc_addons_url;
		wp_enqueue_script('ult-slick');
		wp_enqueue_script('ultimate-appear');
		wp_enqueue_script('ult-slick-custom');
		wp_enqueue_style("ult-slick", $vc_addons_url."assets/min-css/slick.min.css");
		wp_enqueue_style("ult-icons", $vc_addons_url."assets/min-css/icons.min.css");
		wp_enqueue_style("ult-slick-animate", $vc_addons_url."assets/min-css/animate.min.css");
		
		?>
		<div class="des_cubeportfolio_widget_helper blake_helper_div cubeid-<?php echo esc_attr($cubeid); ?>"><?php
			if (function_exists('wpb_js_remove_wpautop') == true)
				echo wpb_js_remove_wpautop($getCube);
			else echo wp_kses_post($getCube);
		?></div>
		<?php


		ob_start();
		echo '<div class="widget des_cubeportfolio_widget">';
			
			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
			if (!empty($title)) { echo "<h4>$title</h4><hr>"; }
			
			$uid = uniqid(rand());
			$uniqid = uniqid(rand());
			
			$getCubeCSS = blake_get_string_between($getCube, "<style type='text/css'>", "</style>" );
			$getCubeCSS = str_replace("#cbpw-wrap".$cubeid, "#ult-carousel-".$uniqid, $getCubeCSS);
			$getCubeCSS = str_replace("#cbpw-grid".$cubeid, ".ult-carousel-".$uid, $getCubeCSS);

			echo '<div id="ult-carousel-'.$uniqid.'" class="ult-carousel-wrapper ult_horizontal" data-gutter="10"><div class="ult-carousel-'.$uid.'"></div></div>';
		echo '</div>';
		
		$blake_inline_script = '
			jQuery(document).ready(function(){
				jQuery(".des_cubeportfolio_widget_helper.cubeid-'.esc_js($cubeid).' .cbp-item").each(function(e){
					var elem = jQuery(this);
					jQuery(".ult-carousel-'.esc_js($uid).'").append("<div class=\'ult-item-wrap cbp\' data-animation=\'animated no-animation\'></div>");
					jQuery(this).clone(true,true).appendTo( jQuery(".ult-carousel-'.esc_js($uid).' .ult-item-wrap").eq(e) );
				});
				
				var theid = jQuery(".ult-carousel-'.esc_js($uid).'").closest(".des_cubeportfolio_widget").siblings(".des_cubeportfolio_widget_helper").children("div").attr("id");
						
				if (jQuery(".ult-carousel-'.esc_js($uid).'").closest("#big_footer").length){
					jQuery(".ult-carousel-'.esc_js($uid).'").slick({';
					if (!$hidenav) $blake_inline_script .= 'dots:true,';
					if ($autoplay=='yes') $blake_inline_script .= 'autoplay:true,autoplaySpeed:5000,';
					$blake_inline_script .= 'speed:300,infinite:true,';
					if (!$hidearrows) $blake_inline_script .= 'arrows:true,';
					$blake_inline_script .= 'adaptiveHeight:true,';
					if (!$hidearrows){ 
						$blake_inline_script .= 'nextArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-next default\'><i class=\'ultsl-arrow-right6\'></i></button>",prevArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-prev default\'><i class=\'ultsl-arrow-left6\'></i></button>",';
					}
					$blake_inline_script .= 'swipe:true,draggable:true,touchMove:true,slidesToScroll:'.esc_js($desktops).',slidesToShow:'.esc_js($desktops).',swipe:true,draggable:true,touchMove:true,responsive:[{breakpoint:1024,settings:{slidesToShow:'.esc_js($desktops).',slidesToScroll:'.esc_js($desktops).'}},{breakpoint:767,settings:{slidesToShow:'.esc_js($tabs).',slidesToScroll:'.esc_js($tabs).'}},{breakpoint:480,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}},{breakpoint:0,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}}],pauseOnHover:true,pauseOnDotsHover:true,mobileFirst:true,customPaging:function(slider,i){return "<i type=\'button\' style=\'color:#333333;\' class=\'ultsl-record\' data-role=\'none\'></i>";},}).on("beforeChange", function(event, slick, currentSlide, nextSlide){ jQuery(slick.$slides[nextSlide]).add(jQuery(slick.$slides[currentSlide]).next()).add(jQuery(slick.$slides[currentSlide]).prev()).css("height", jQuery(slick.$slides[nextSlide]).find(".cbp-caption-defaultWrap img").height()+"px"); });
					
					var rtime = new Date(1, 1, 2000, 12,00,00);
					var timeout = false;
					var delta = 200;
					jQuery(window).on("resize", function() {
					    rtime = new Date();
					    if (timeout === false) {
					        timeout = true;
					        setTimeout(function(){
						        jQuery(".ult-carousel-'.esc_js($uid).'").slick("slickGoTo",0, false);
								jQuery(".ult-carousel-'.esc_js($uid).' .cbp-item").each(function(){ 
									jQuery(this).height(jQuery(this).find(".cbp-caption-defaultWrap img").height()+"px"); 
									jQuery(this).find("a.cbp-singlePage").click(function(){
								        jQuery(".des_cubeportfolio_widget_helper.cubeid-'.esc_js($cubeid).' .cbp-item").eq(jQuery(this).closest(".ult-item-wrap").data("slick-index")).find("a.cbp-singlePage").click(); 
							        });
							        jQuery(this).find("a.cbp-singlePageInline").click(function(){
								        jQuery(".des_cubeportfolio_widget_helper.cubeid-'.esc_js($cubeid).' .cbp-item").eq(jQuery(this).closest(".ult-item-wrap").data("slick-index")).find(".cbp-singlePageInline").click(); 
							        });
								});
					        }, delta);
					    }
					});
					
					jQuery(window).on("load", function(){
						jQuery(".ult-carousel-'.esc_js($uid).'").slick("slickGoTo",0, false);
						jQuery(".ult-carousel-'.esc_js($uid).' .cbp-item").each(function(){ jQuery(this).height(jQuery(this).find(".cbp-caption-defaultWrap img").height()+"px"); });
					});
					
				} else {
					jQuery(".ult-carousel-'.esc_js($uid).'").slick({';
					if (!$hidenav) $blake_inline_script .= 'dots:true,';
					if ($autoplay=='yes') $blake_inline_script .= 'autoplay:true,autoplaySpeed:5000,';
					$blake_inline_script .= 'speed:300,infinite:true,';
					if (!$hidearrows) $blake_inline_script .= 'arrows:true,';
					$blake_inline_script .= 'adaptiveHeight:true,';
					if (!$hidearrows){
						$blake_inline_script .= 'nextArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-next default\'><i class=\'ultsl-arrow-right6\'></i></button>",prevArrow:"<button type=\'button\' style=\'color:#333333; font-size:24px;\' class=\'slick-prev default\'><i class=\'ultsl-arrow-left6\'></i></button>",';
					}
					$blake_inline_script .= 'slidesToScroll:'.esc_js($desktops).',slidesToShow:'.esc_js($desktops).',swipe:true,draggable:true,touchMove:true,responsive:[{breakpoint:1024,settings:{slidesToShow:'.esc_js($desktops).',slidesToScroll:'.esc_js($desktops).'}},{breakpoint:767,settings:{slidesToShow:'.esc_js($tabs).',slidesToScroll:'.esc_js($tabs).'}},{breakpoint:480,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}},{breakpoint:0,settings:{slidesToShow:'.esc_js($mobiles).',slidesToScroll:'.esc_js($mobiles).'}}],pauseOnHover:true,pauseOnDotsHover:true,mobileFirst:true,customPaging:function(slider,i){return "<i type=\'button\' style=\'color:#333333;\' class=\'ultsl-record\' data-role=\'none\'></i>";},});
					
					jQuery(".ult-carousel-'.esc_js($uid).' .cbp-item").each(function(){ jQuery(this).height(jQuery(this).find(".cbp-caption-defaultWrap img").height()+"px"); });
					
					var rtime = new Date(1, 1, 2000, 12,00,00);
					var timeout = false;
					var delta = 200;
					jQuery(window).on("resize", function() {
					    rtime = new Date();
					    if (timeout === false) {
					        timeout = true;
					        setTimeout(function(){
						        jQuery(".ult-carousel-'.esc_js($uid).' .cbp-item").each(function(){ 
							        jQuery(this).height(jQuery(this).find(".cbp-caption-defaultWrap img").height()+"px"); 
							        jQuery(this).find("a.cbp-singlePage").click(function(){
								        jQuery(".des_cubeportfolio_widget_helper.cubeid-'.esc_js($cubeid).' .cbp-item").eq(jQuery(this).closest(".ult-item-wrap").data("slick-index")).find("a.cbp-singlePage").click(); 
							        });
							        jQuery(this).find("a.cbp-singlePageInline").click(function(){
								        jQuery(".des_cubeportfolio_widget_helper.cubeid-'.esc_js($cubeid).' .cbp-item").eq(jQuery(this).closest(".ult-item-wrap").data("slick-index")).find(".cbp-singlePageInline").click(); 
							        });
							    });
					        }, delta);
					    }
					});
					jQuery(window).on("load", function(){
						jQuery(".ult-carousel-'.esc_js($uid).' .cbp-item").each(function(){ jQuery(this).height(jQuery(this).find(".cbp-caption-defaultWrap img").height()+"px"); });
					});
					
				}
				
			});
			
			jQuery(window).load(function(){
				jQuery("#ult-carousel-'.esc_js($uniqid).'").addClass(jQuery("#cbpw-wrap'.esc_js($cubeid).' > .cbp").attr("class")).removeClass("cbp cbp-ratio-even").find("img").css({"visibility":"visible","z-index":5});
			})
		';
		
		wp_add_inline_script('blake', $blake_inline_script, 'after');
			
		$blake_inline_css = $getCubeCSS . "
			.ult-carousel-".esc_html($uid)." .cbp-item{position:relative;float:left;width:100% !important;max-height:100%;top: 0px !important;}
			.ult-carousel-".esc_html($uid)." .cbp:after{visibility:hidden;}
			.ult-carousel-".esc_html($uid)." .cbp-caption-defaultWrap img, .ult-carousel-".esc_html($uid)." .cbp-item{opacity:1 !important;}
			#ult-carousel-".esc_html($uniqid).".cbp-l-grid-fullScreen {visibility:visible;overflow:visible;}
			.ult-carousel-".esc_html($uid)." .slick-dots {top: 100%; bottom: 0 !important; margin-top: 10px !important;}
			.ult-carousel-".esc_html($uid)." button{opacity:0;transition:all .2s linear .5s;}
			.ult-carousel-".esc_html($uid).":hover button{opacity:1;transition:all 0s linear 0s;}
			#ult-carousel-".esc_html($uniqid)." .slick-slide{margin:0px !important;}
		";
		
		blake_set_custom_inline_css($blake_inline_css);
				
		echo ob_get_clean();
	}
}
register_widget('Blake_Projects_Widget');
?>