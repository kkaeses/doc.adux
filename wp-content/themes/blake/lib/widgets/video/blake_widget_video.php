<?php

class Blake_Video_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'video_widget', 'description' => esc_html__('Show your videos from Youtube or Vimeo.', 'blake'));
		parent::__construct(false, 'UPPER _ Video', $widget_ops);
	}
	
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']);
	} else {
		$title = " ";	
	}
	
	
	if (!isset($instance['v_type'])) $instance['v_type'] = 'you';
	if ($instance['v_type'] == "you"){
		$v_type = "you";
	} else {
		$v_type = "vim";
	}
		
	if (isset($instance['v_id'])){
		$v_id = esc_attr($instance['v_id']);
	} else {
		$v_id = "";
	}
	
	$order = $v_type;
		
?>  
        
     <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title', 'blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
    <p><label>&#8212; <?php esc_html_e('Video Hoster', 'blake'); ?> &#8212;<br>
		<input type="radio" name="<?php echo esc_attr($this->get_field_name('v_type')); ?>" value="you" <?php if($order == 'you' || !$order) echo 'checked'; ?>> <?php esc_html_e('Youtube', 'blake'); ?><br>
		<input type="radio" name="<?php echo esc_attr($this->get_field_name('v_type')); ?>" value="vim" <?php if($order == 'vim') echo 'checked'; ?>> <?php esc_html_e('Vimeo', 'blake'); ?><br>
    </label></p>
    <p><label for="<?php echo esc_attr($this->get_field_id('v_id')); ?>">&#8212; <?php esc_html_e('Video ID', 'blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('v_id')); ?>" name="<?php echo esc_attr($this->get_field_name('v_id')); ?>" type="text" value="<?php echo esc_attr($v_id); ?>" /></label></p>
        
<?php
	}
function update($new_instance, $old_instance) {

	// processes widget options to be saved
	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['v_type'] = $new_instance['v_type'];
    $instance['v_id'] = $new_instance['v_id'];
		return $instance;
	}
	
	function widget($args, $instance) {
			
		extract($args);	
		
	    $title = apply_filters('widget_title', $instance['title'], $instance);
	    $v_type = $instance['v_type'];
	    $v_id = $instance['v_id'];

	    
	    ?>
	    
	
		  <div class="video_widget widget">
			  
		  	<?php if ( !empty( $title ) ) { echo wp_kses_post($before_title . $title . $after_title); } ?>
		  	
		  	<?php if($v_type == 'you'){ ?>
		  		<div class="video_frame vendor">
		  			<iframe src="http://www.youtube.com/embed/<?php echo esc_html($v_id); ?>?&amp;wmode=transparent&amp;autoplay=0&amp;autohide=1&amp;showinfo=0&amp;rel=0" frameborder="0" width="205" height="150"></iframe>
		  		</div>
		  	<?php } ?>
		  	
		  	<?php if($v_type == 'vim'){ ?>
		  		<div class="video_frame vendor">
		  			<iframe src="http://player.vimeo.com/video/<?php echo esc_html($v_id); ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0" width="205" height="150" webkitAllowFullScreen allowFullScreen></iframe>
		  		</div>
		  	<?php } ?>
		  </div>
	    <?php
	  
	}
}
register_widget('Blake_Video_Widget');

?>
