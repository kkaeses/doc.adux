<?php

class Blake_Twitter_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'twitter_widget', 'description' => esc_html__('Show your tweets on your site.', 'blake'));
		parent::__construct(false, 'UPPER _ Twitter', $widget_ops);
	}
function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['twitteruser'])){
			$twitteruser = esc_attr($instance['twitteruser']);  	
		} else $twitteruser = "";
		
		if (isset($instance['ntweets'])){
			$ntweets = esc_attr($instance['ntweets']); 	
		} else $ntweets = "";
		
?>  
        
      <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></label></p> 
       <p><label for="<?php echo esc_attr($this->get_field_id('ntweets')); ?>">&#8212; <?php esc_html_e('Number Tweets to show','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ntweets')); ?>" name="<?php echo esc_attr($this->get_field_name('ntweets')); ?>" type="text" value="<?php echo esc_attr($ntweets); ?>" /><br><span class="flickr-stuff">If 0 will show the last tweet.</span></label></p>
        
<?php
	}
	
function update($new_instance, $old_instance) {
	// processes widget options to be saved
	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['ntweets'] = $new_instance['ntweets'];
	return $instance;
}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $ntweets = $instance['ntweets'];
    if ($ntweets == "") $ntweets = 1;
    $twitter_data_is_filled = true;
	if ( (get_option("blake_twitter_username") == "") || (get_option("twitter_consumer_key") == "") || (get_option("twitter_consumer_secret") == "") || (get_option("twitter_user_token") == "") || (get_option("twitter_user_secret") == "") || (get_option("blake_twitter_number_tweets") == "") ){
		$twitter_data_is_filled = false;
	}
    if ($twitter_data_is_filled) wp_enqueue_script( 'blake-tweet', BLAKE_JS_PATH .'twitter/jquery.tweet.js', array(),'1.0',$in_footer = true);
    ?>
    
    <div class="twitter_container widget">
	    
	    <?php if ( !empty( $title ) ) { echo wp_kses_post($before_title . $title . $after_title); } ?>
	    
			<div id="twitter_update_list">
			 <?php
				 if ($twitter_data_is_filled){
					
					$blake_inline_script = '
						jQuery(document).ready(function(){
							jQuery("#twitter_update_list").destweet({
								modpath: jQuery("#templatepath").html()+"js/twitter/index.php",
						        username: "'.get_option("blake_twitter_username").'",
						        page: 1,
						        avatar_size: 0,
					            count: '.esc_js($ntweets).'
						    });
						});
					';
					wp_add_inline_script('blake', $blake_inline_script, 'after');
				 } else {
					 ?>
					 <p>Please fill the fields on the <strong>Appearance > Blake Options > Twitter and Social Icons > Twitter</strong> panel with your credentials.</p>
					 <?php
				 }
			 ?>
			</div>
		</div>
    
    <?php
  
	}
}
register_widget('Blake_Twitter_Widget');

?>
