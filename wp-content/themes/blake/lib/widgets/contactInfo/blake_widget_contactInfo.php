<?php

class Blake_ContactInfo_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'contact_info_widget', 'description' => esc_html__('Minimalist contact information.', 'blake'));
		parent::__construct(false, 'UPPER _ Contact Info', $widget_ops);
	}
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']); 
	} else $title = "";

	if (isset($instance['type'])){
		$type = esc_attr($instance['type']); 
	} else $type = "";
		
	if (isset($instance['customicon'])){
		$customicon = esc_attr($instance['customicon']);
	} else $customicon = "";
	
	if (isset($instance['content'])){
		$content = esc_attr($instance['content']); 
	} else $content = "";
	
	if (isset($instance['center'])){
		$center = esc_attr($instance['center']); 
	} else $center = "";
	
?>  
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title', 'blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo wp_kses_post($title); ?>" /></label></p> 
       
       <p><label for="<?php echo esc_attr($this->get_field_id('type')); ?>">&#8212; <?php esc_html_e('Info Type', 'blake'); ?> &#8212;<br/>
       <select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>" onchange="if (jQuery(this).val() === 'other') jQuery('#<?php echo esc_js($this->get_field_id('customicon')); ?>').parent().add(jQuery('#<?php echo esc_js($this->get_field_id('customicon')); ?>').parent().siblings('.icons-container')).add(jQuery(this).closest('p').siblings('.selectedIcon')).css('display','block'); else jQuery('#<?php echo esc_js($this->get_field_id('customicon')); ?>').parent().add(jQuery('#<?php echo esc_js($this->get_field_id('customicon')); ?>').parent().siblings('.icons-container')).add(jQuery(this).closest('p').siblings('.selectedIcon')).css('display','none');">
    		<option value="telephone" <?php if ($type === "telephone") echo " selected"; ?>>Telephone</option>
			<option value="email" <?php if ($type === "email") echo " selected"; ?>>Email</option>
			<option value="address" <?php if ($type === "address") echo " selected"; ?>>Address</option>
			<option value="other" <?php if ($type === "other") echo " selected"; ?>>Other</option>
        </select>
       </label></p>
       
       <p <?php if ($type != "other") echo 'style="display:none;"'; ?>>
       <input style="display:none;" class="widefat" id="<?php echo esc_attr($this->get_field_id('customicon')); ?>" name="<?php echo esc_attr($this->get_field_name('customicon')); ?>" type="text" value="<?php echo esc_attr($customicon); ?>" />
       <label for="<?php echo esc_attr($this->get_field_id('customicon')); ?>">&#8212; <?php esc_html_e('Custom Icon', 'blake'); ?> &#8212;<br/>
	       <?php
		       $icons = array('fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-ambulance','fa-anchor','fa-android','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left','fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h','fa-arrows-v','fa-asterisk','fa-automobile','fa-backward','fa-ban','fa-bank','fa-bar-chart-o','fa-barcode','fa-bars','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bitbucket','fa-bitbucket-square','fa-bitcoin','fa-bold','fa-bolt','fa-bomb','fa-book','fa-bookmark','fa-bookmark-o','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-cab','fa-calendar','fa-calendar-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-certificate','fa-chain','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square','fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-cny','fa-code','fa-code-fork','fa-codepen','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-copy','fa-credit-card','fa-crop','fa-crosshairs','fa-css3','fa-cube','fa-cubes','fa-cut','fa-cutlery','fa-dashboard','fa-database','fa-dedent','fa-delicious','fa-desktop','fa-deviantart','fa-digg','fa-dollar','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edit','fa-eject','fa-ellipsis-h','fa-ellipsis-v','fa-empire','fa-envelope','fa-envelope-o','fa-envelope-square','fa-eraser','fa-eur','fa-euro','fa-exchange','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-facebook','fa-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-movie-o','fa-file-o','fa-file-pdf-o','fa-file-photo-o','fa-file-picture-o','fa-file-powerpoint-o','fa-file-sound-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-file-zip-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-flag','fa-flag-checkered','fa-flag-o','fa-blake','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-forward','fa-foursquare','fa-frown-o','fa-gamepad','fa-gavel','fa-gbp','fa-ge','fa-gear','fa-gears','fa-gift','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-gittip','fa-glass','fa-globe','fa-google','fa-google-plus','fa-google-plus-square','fa-graduation-cap','fa-group','fa-h-square','fa-hacker-news','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-history','fa-home','fa-hospital-o','fa-html5','fa-image','fa-inbox','fa-indent','fa-info','fa-info-circle','fa-inr','fa-instagram','fa-institution','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key','fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-leaf','fa-legal','fa-lemon-o','fa-level-down','fa-level-up','fa-life-bouy','fa-life-ring','fa-life-saver','fa-lightbulb-o','fa-link','fa-linkedin','fa-linkedin-square','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left','fa-long-arrow-right','fa-long-arrow-up','fa-magic','fa-magnet','fa-mail-forward','fa-mail-reply','fa-mail-reply-all','fa-male','fa-map-marker','fa-maxcdn','fa-medkit','fa-meh-o','fa-microphone','fa-microphone-slash','fa-minus','fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mobile','fa-mobile-phone','fa-money','fa-moon-o','fa-mortar-board','fa-music','fa-navicon','fa-openid','fa-outdent','fa-pagelines','fa-paper-plane','fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-paste','fa-pause','fa-paw','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-phone','fa-phone-square','fa-photo','fa-picture-o','fa-pied-piper','fa-pied-piper-alt','fa-pied-piper-square','fa-pinterest','fa-pinterest-square','fa-plane','fa-play','fa-play-circle','fa-play-circle-o','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-power-off','fa-print','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question','fa-question-circle','fa-quote-left','fa-quote-right','fa-ra','fa-random','fa-rebel','fa-recycle','fa-reddit','fa-reddit-square','fa-refresh','fa-renren','fa-reorder','fa-repeat','fa-reply','fa-reply-all','fa-retweet','fa-rmb','fa-road','fa-rocket','fa-rotate-left','fa-rotate-right','fa-rouble','fa-rss','fa-rss-square','fa-rub','fa-ruble','fa-rupee','fa-save','fa-scissors','fa-search','fa-search-minus','fa-search-plus','fa-send','fa-send-o','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shield','fa-shopping-cart','fa-sign-in','fa-sign-out','fa-signal','fa-sitemap','fa-skype','fa-slack','fa-sliders','fa-smile-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc','fa-sort-down','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-sort-up','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star','fa-star-half','fa-star-half-empty','fa-star-half-full','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-stop','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-suitcase','fa-sun-o','fa-superscript','fa-support','fa-table','fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down','fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle','fa-times-circle-o','fa-tint','fa-toggle-down','fa-toggle-left','fa-toggle-right','fa-toggle-up','fa-trash-o','fa-tree','fa-trello','fa-trophy','fa-truck','fa-try','fa-tumblr','fa-tumblr-square','fa-turkish-lira','fa-twitter','fa-twitter-square','fa-umbrella','fa-underline','fa-undo','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-unsorted','fa-upload','fa-usd','fa-user','fa-user-md','fa-users','fa-video-camera','fa-vimeo-square','fa-vine','fa-vk','fa-volume-down','fa-volume-off','fa-volume-up','fa-warning','fa-wechat','fa-weibo','fa-weixin','fa-wheelchair','fa-windows','fa-won','fa-wordpress','fa-wrench','fa-xing','fa-xing-square','fa-yahoo','fa-yen','fa-youtube','fa-youtube-play','fa-youtube-square');
			$output = '<div class="icons-container" style="height:180px;overflow-y:auto;margin-bottom:15px;';
			if ($type != "other") $output.='display:none;';
			$output.='">';
			foreach($icons as $i){
				$output .= '<i class="fa '.$i;
				if ($i == $customicon) $output .= ' selected';
				$output .= '" onclick="jQuery(\'#'.$this->get_field_id('customicon').'\').val(\''.$i.'\');jQuery(this).addClass(\'selected\').siblings().removeClass(\'selected\'); jQuery(this).parent().siblings(\'.selectedIcon\').children(\'i\').remove(); jQuery(this).parent().siblings(\'.selectedIcon\').append(jQuery(this).clone().removeClass(\'selected\'));" style="cursor:pointer;height:30px;width:30px;margin:2px;border:1px solid #333;font-size:25px;line-height:30px;text-align:center;"></i>';
			}
			$output .= '</div>';
			$output .= '<div class="selectedIcon" style="height:43px;line-height:43px;">Selected Icon: ';
			if ($customicon != "") $output .= '<i class="fa '.$customicon.'" style="height:30px;width:30px;margin:2px;border:1px solid #333;font-size:25px;line-height:30px;text-align:center;"></i>';
			$output.='</div>';
			
						$output = wp_kses_no_null( $output, array( 'slash_zero' => 'keep' ) );
			$output = wp_kses_js_entities($output);
			$output = wp_kses_normalize_entities($output);
			echo wp_kses_hook($output, 'post', array()); // WP changed the order of these funcs and added args to wp_kses_hook

	       ?>
       </label></p>
        
       <p><label for="<?php echo esc_attr($this->get_field_name('content')); ?>">&#8212; <?php esc_html_e('Info Content', 'blake'); ?> &#8212;      
       <textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" value="<?php echo esc_attr($content); ?>"><?php echo wp_kses_post($content); ?></textarea>
       </label></p>
       
       <label for="<?php echo esc_attr($this->get_field_name('center')); ?>" style="position:relative;float:left;width:100%;margin: 0 0 10px 0px;"><input type="checkbox" name="<?php echo esc_attr($this->get_field_name('center')); ?>" id="<?php echo esc_attr($this->get_field_id('center')); ?>" value="<?php echo esc_attr($center); ?>" <?php if ($center) echo "checked"; ?> onchange="jQuery(this).val(jQuery(this).is(':checked'));">&nbsp;Centered ?</label>
        
<?php
	}
function update($new_instance, $old_instance) {
	// processes widget options to be saved
	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['type'] = $new_instance['type'];
    $instance['customicon'] = $new_instance['customicon'];
    $instance['content'] = $new_instance['content'];
    $instance['center'] = $new_instance['center'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = $instance['title'];
    $type = $instance['type'];
    $customicon = $instance['customicon'];
    $content = $instance['content'];
    $center = $instance['center'];
    
    
    ?>
    <div class="widget widget-contact-info">
		<?php if ($title) echo '<h4>'. $title .'</h4><hr>'; ?>
		<div class="widget-contact-content <?php if ($center) echo "centered"; ?>">
			<i class="fa <?php
			    if ($type != "other"){
				    switch ($type){
					    case "telephone": echo "fa-phone"; break;
					    case "email": echo "fa-envelope"; break;
					    case "address": echo "fa-map-marker"; break;
				    }
			    } else echo esc_attr($customicon);
		    ?>"></i>
		    <div class="widget-contact-info-content"><?php echo do_shortcode($content); ?></div>			
		</div>
    </div>
    <?php
	}
}
register_widget('Blake_ContactInfo_Widget');

?>
