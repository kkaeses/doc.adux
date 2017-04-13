<?php

class Blake_ContactForm_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'contact_form_widget', 'description' => esc_html__('Minimalist contact form.', 'blake'));
		parent::__construct(false, 'UPPER _ Contact Form', $widget_ops);
	}
function form($instance) {

	if (isset($instance['title'])){
		$title = esc_attr($instance['title']); 
	} else $title = "";
		
	if (isset($instance['emailto'])){
		$emailto = esc_attr($instance['emailto']);  
	} else $emailto = "";
	
	if (isset($instance['emailsubject'])){
		$emailsubject = esc_attr($instance['emailsubject']); 
	} else $emailsubject = "";
	
	if (isset($instance['invalidname'])){
		$invalidname = esc_attr($instance['invalidname']); 
	} else $invalidname = "";

	if (isset($instance['invalidmail'])){
		$invalidmail = esc_attr($instance['invalidmail']); 
	} else $invalidmail = "";

	if (isset($instance['invalidmsg'])){
		$invalidmsg = esc_attr($instance['invalidmsg']); 
	} else $invalidmsg = "";

	if (isset($instance['successmessage'])){
		$successmessage = esc_attr($instance['successmessage']);
	} else $successmessage = "";
		
	if (isset($instance['errormessage'])){
		$errormessage = esc_attr($instance['errormessage']);
	} else $errormessage = "";
		
?>  
        
       <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title', 'blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p> 
       <p><label for="<?php echo esc_attr($this->get_field_id('emailto')); ?>">&#8212; <?php esc_html_e('Email To', 'blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('emailto')); ?>" name="<?php echo esc_attr($this->get_field_name('emailto')); ?>" type="text" value="<?php echo esc_attr($emailto); ?>" /></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('emailsubject')); ?>">&#8212; <?php esc_html_e('Email Subject','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('emailsubject')); ?>" name="<?php echo esc_attr($this->get_field_name('emailsubject')); ?>" type="text" value="<?php echo esc_attr($emailsubject); ?>" /><br></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('invalidname')); ?>">&#8212; <?php esc_html_e('Invalid Name','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('invalidname')); ?>" name="<?php echo esc_attr($this->get_field_name('invalidname')); ?>" type="text" value="<?php echo esc_attr($invalidname); ?>" /><br></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('invalidmail')); ?>">&#8212; <?php esc_html_e('Invalid Email','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('invalidmail')); ?>" name="<?php echo esc_attr($this->get_field_name('invalidmail')); ?>" type="text" value="<?php echo esc_attr($invalidmail); ?>" /><br></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('invalidmsg')); ?>">&#8212; <?php esc_html_e('Invalid Message','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('invalidmsg')); ?>" name="<?php echo esc_attr($this->get_field_name('invalidmsg')); ?>" type="text" value="<?php echo esc_attr($invalidmsg); ?>" /><br></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('successmessage')); ?>">&#8212; <?php esc_html_e('Successful Email Message','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('successmessage')); ?>" name="<?php echo esc_attr($this->get_field_name('successmessage')); ?>" type="text" value="<?php echo esc_attr($successmessage); ?>" /><br></label></p>
       <p><label for="<?php echo esc_attr($this->get_field_id('errormessage')); ?>">&#8212; <?php esc_html_e('Error Email Message','blake'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('errormessage')); ?>" name="<?php echo esc_attr($this->get_field_name('errormessage')); ?>" type="text" value="<?php echo esc_attr($errormessage); ?>" /><br></label></p>
        
<?php
	}
function update($new_instance, $old_instance) {
	// processes widget options to be saved
	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['emailto'] = $new_instance['emailto'];
    $instance['emailsubject'] = $new_instance['emailsubject'];
    $instance['invalidname'] = $new_instance['invalidname'];
    $instance['invalidmail'] = $new_instance['invalidmail'];
    $instance['invalidmsg'] = $new_instance['invalidmsg'];
    $instance['successmessage'] = $new_instance['successmessage'];
    $instance['errormessage'] = $new_instance['errormessage'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $emailto = $instance['emailto'];
    $emailsubject = $instance['emailsubject'];
    $invalidname = $instance['invalidname'];
    $invalidmail = $instance['invalidmail'];
    $invalidmsg = $instance['invalidmsg'];
    $successmessage = $instance['successmessage'];
    $errormessage = $instance['errormessage'];
        
    ?>
    <div class="widget contact-widget-container">
    <?php 
	    if (!empty($title)) { ?>
			<h4><?php echo wp_kses_post($title); ?></h4><hr>
		<?php } ?>
			
		<div class="contact-form">
			<div class="message_success form_success"></div>
			<form method="post" action="#" class="validateform">
				<ul class="forms">
					<li>
						<input type="text" name="name" class="yourname txt corner-input" onfocus="if (jQuery(this).val() === '<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_name')); ?>') jQuery(this).val(''); blake_checkerror(this);" onblur="if (jQuery(this).val() === '') jQuery(this).val('<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_name')); ?>');  var v = jQuery(this).val(); jQuery('.yourname_val').html(v);" value="<?php printf(esc_html__("%s", "blake"), get_option("blake".'_cf_name')); ?>">
						<div class="yourname_val blake_helper_div"></div>
						<div class="yourname_error blake_helper_div"><?php echo wp_kses_post($invalidname); ?></div>
					</li>
					<li>
						<input style="margin: 10px 0;" type="text" name="email" class="youremail txt corner-input" onfocus="if (jQuery(this).val() === '<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_email')); ?>') jQuery(this).val(''); blake_checkerror(this);" onblur="if (jQuery(this).val() === '') jQuery(this).val('<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_email')); ?>'); var v = jQuery(this).val(); jQuery('.youremail_val').html(v);" value="<?php printf(esc_html__("%s", "blake"), get_option("blake".'_cf_email')); ?>">
						<div class="youremail_val blake_helper_div"></div>
						<div class="youremail_error blake_helper_div"><?php echo wp_kses_post($invalidmail); ?></div>
					</li>
					<li>
						<textarea name="message" class="yourmessage textarea message corner-input" rows=20 cols=30 onfocus="if (jQuery(this).html() === '<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_message')); ?>') jQuery(this).html('');" onblur="if (jQuery(this).html() === '') jQuery(this).html('<?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_message')); ?>');"><?php printf(esc_html__("%s", 'blake'), get_option("blake".'_cf_message')); ?></textarea>
						<div class="yourmessage_val blake_helper_div"></div>
						<div class="yourmessage_error blake_helper_div"><?php echo wp_kses_post($invalidmsg); ?></div>
					</li>
					<li>
						<a id="send-comment" href="javascript:;" onclick="blake_sendemail(jQuery(this),'<?php echo esc_attr($emailto); ?>', '<?php printf(esc_html__("%s",'blake'), $emailsubject); ?>', '', '', '', '<?php printf(esc_html__("%s",'blake'), $successmessage); ?>', '<?php printf(esc_html__("%s",'blake'), $errormessage); ?>')" class="submit"><?php echo sprintf(esc_html__("%s", "blake"), get_option("blake_cf_send")); ?></a>
					</li>
				</ul>
			</form>
		</div>
	</div>
    <?php
  
	}
}
register_widget('Blake_ContactForm_Widget');

?>
