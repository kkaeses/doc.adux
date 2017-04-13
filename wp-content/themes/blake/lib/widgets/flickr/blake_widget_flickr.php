<?php

class Blake_Flickr_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'flickr_widget', 'description' => esc_html__('Show your flickr photos on your site.','blake'));
		parent::__construct(false, 'UPPER _ Flickr Photos', $widget_ops);
	}
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']); 
	} else $title = "";
		
	if (isset($instance['flickrid'])){
		$flickrid = esc_attr($instance['flickrid']);  		
	} else $flickrid = "";
	
	if (isset($instance['nphotos'])){
		$nphotos = esc_attr($instance['nphotos']); 
	} else $nphotos = "";

	if (isset($instance['linkprofile'])){
		$linkprofile = esc_attr($instance['linkprofile']); 
	} else $linkprofile = "";
		
?>  
        
       <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
       <p><label for="<?php echo esc_attr($this->get_field_id('flickrid')); ?>">&#8212; <?php esc_html_e('Flickr ID','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickrid')); ?>" name="<?php echo esc_attr($this->get_field_name('flickrid')); ?>" type="text" value="<?php echo esc_attr($flickrid); ?>" /></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('nphotos')); ?>">&#8212; <?php esc_html_e('Number Photos to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nphotos')); ?>" name="<?php echo esc_attr($this->get_field_name('nphotos')); ?>" type="text" value="<?php echo esc_attr($nphotos); ?>" /><br><span class="flickr-stuff">If 0 will show 20 photos.</span></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('linkprofile')); ?>">&#8212; <?php esc_html_e('Link to Profile','blake'); ?> &nbsp;<input id="<?php echo esc_attr($this->get_field_id('linkprofile')); ?>" name="<?php echo esc_attr($this->get_field_name('linkprofile')); ?>" type="checkbox" value="yes" <?php if($linkprofile == "yes") echo 'checked'; ?>/><br><span class="flickr-stuff">Title with link to your profile.</span></label></p> 
        
<?php
	}
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['flickrid'] = $new_instance['flickrid'];
    $instance['nphotos'] = $new_instance['nphotos'];
    $instance['linkprofile'] = $new_instance['linkprofile'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $flickrid = $instance['flickrid'];
    $nphotos = $instance['nphotos'];
    $linkprofile = $instance['linkprofile'];
    
    if(empty($nphotos) || $nphotos == 0 )
    	$nphotos = 20;
    
    wp_enqueue_script('flickr', get_template_directory_uri() .'/js/jflickrfeed.js', array(), '2.5.2',$in_footer = true);
    ?>
    
    <div class="widget flickr_container">
		<?php if (!empty($title)) { ?>
			<h4><?php 
  			
  				if($linkprofile == 'yes') echo "<a href='http://www.flickr.com/photos/" . $flickrid . "/' target='_blank'>" . $title . "</a>";
  				else echo wp_kses_post($title);
  			
  		?></h4><hr><?php } ?>
		<ul id="flickr" class="thumbs"></ul>
	</div>

	<?php
	$blake_inline_script = '
		jQuery(document).ready(function(){
			jQuery("#flickr").jflickrfeed({
				limit: '.esc_js($nphotos).',
				qstrings: {
					id: "'.esc_js($flickrid).'"
				},
				itemTemplate: "<li>"+
								"<a href=\'{{link}}\' title=\'{{title}}\' target=\'_blank\'>" +
									"<img src=\'{{image_s}}\' alt=\'{{title}}\' />" +
								"</a>" +
							  "</li>"
			});
		});
	';
	wp_add_inline_script('blake', $blake_inline_script, 'after');
	}
}
register_widget('Blake_Flickr_Widget');

?>
