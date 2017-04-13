<?php
function acx_fsmi_nonce_check()
{
	if (!isset($_POST['acx_fsmi_nonce']))  die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if (!wp_verify_nonce($_POST['acx_fsmi_nonce'],'acx_fsmi_nonce')) die("<br><br>".__('Sorry, You have no permission to do this action...','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if(!current_user_can('manage_options')) die("<br><br>".__('Sorry, You have no permission to do this action...','floating-social-media-icon')."</a>");
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_nonce_check',1);
function acx_fsmi_nonce_field()
{
	echo "<input name='acx_fsmi_nonce' type='hidden' value='".wp_create_nonce('acx_fsmi_nonce')."' />";
	echo "<input name='acx_fsmi_hidden' type='hidden' value='Y' />";
} add_action('acx_fsmi_hook_option_fields','acx_fsmi_nonce_field',10);
function acx_fsmi_option_form_start()
{
	echo "<form name='acx_fsmi_form' id='acx_fsmi_form'  method='post' action='".str_replace( '%7E', '~',$_SERVER['REQUEST_URI'])."'>";
} add_action('acx_fsmi_hook_option_form_head','acx_fsmi_option_form_start',100);
function acx_fsmi_option_form_end()
{
	echo "</form>";
}  add_action('acx_fsmi_hook_option_form_footer','acx_fsmi_option_form_end',100);
function acx_fsmi_option_div_start()
{
	echo "<div id=\"acx_fsmi_option_page_holder\"> \n";
	acx_fsmi_hook_function('acx_fsmi_hook_option_above_page_left');
	echo "<div class=\"acx_fsmi_option_page_left\"> \n";
} add_action('acx_fsmi_hook_option_form_head','acx_fsmi_option_div_start',30);
function acx_fsmi_option_sidebar_start()
{
	echo "</div> <!-- acx_fsmi_option_page_left --> \n";
	echo "<div class=\"acx_fsmi_option_page_right\"> \n";
}  add_action('acx_fsmi_hook_option_sidebar','acx_fsmi_option_sidebar_start',10);
function acx_fsmi_option_sidebar_end()
{
	echo "</div> <!-- acx_fsmi_option_page_right --> \n";
	acx_fsmi_hook_function('acx_fsmi_hook_option_footer');
	echo "</div> <!-- acx_fsmi_option_page_holder --> \n";
} add_action('acx_fsmi_hook_option_sidebar','acx_fsmi_option_sidebar_end',500);
function acx_print_option_page_title()
{
	$acx_string = __("Acurax Social Icons Options","floating-social-media-icon");
 echo print_acx_fsmi_option_heading($acx_string);
} add_action('acx_fsmi_hook_option_form_head','acx_print_option_page_title',50);

function display_acx_fsmi_saved_success()
{ ?>
<div class="updated"><p><strong><?php _e('Your Settings Saved Successfully.','floating-social-media-icon'); ?></strong></p></div>
<script type="text/javascript">
 setTimeout(function(){
		jQuery('.updated').fadeOut('slow');
		
		}, 4000);

</script>
<?php
}   add_action('acx_fsmi_hook_option_onpost','display_acx_fsmi_saved_success',5000);
function acx_fsmi_lb_infobox()
{ ?>
<script type="text/javascript">
jQuery( ".fsmi_info_lb" ).click(function() {
	var lb_title = jQuery(this).attr('lb_title');
	var lb_content = jQuery(this).attr('lb_content');
	var html= '<div id="acx_fsmi_c_icon_p_info_lb_h" style="display:none;"><div class="acx_fsmi_c_icon_p_info_c"><span class="acx_fsmi_c_icon_p_info_close" onclick="fsmi_remove_info()"></span><h4>'+lb_title+'</h4><div class="acx_fsmi_c_icon_p_info_content">'+lb_content+'</div></div></div> <!-- acx_fsmi_c_icon_p_info_lb_h -->';
	jQuery( "body" ).append(html)
	jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).fadeIn();
});

function fsmi_remove_info()
{
	jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).fadeOut()
	jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).remove();
};
</script>
<?php
} add_action('acx_fsmi_hook_option_footer','acx_fsmi_lb_infobox');
add_action('acx_fsmi_misc_hook_option_footer','acx_fsmi_lb_infobox');
function acx_fsmi_service_banners()
{
?>
<div id="acx_fsmi_sidebar">
<?php $acx_fsmi_service_banners = get_option('acx_fsmi_acx_service_banners');
if ($acx_fsmi_service_banners != "no") { ?>
<div id="acx_ad_banners_fsmi">
<a href="http://www.acurax.com/?utm_source=fsmi&utm_campaign=sidebar_banner_1" target="_blank" class="acx_ad_fsmi_1">
<div class="acx_ad_fsmi_title"><?php _e('Need Help on Wordpress?','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_title -->
<div class="acx_ad_fsmi_desc"><?php _e('Instant Solutions for your wordpress Issues','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_desc -->
</a> <!--  acx_ad_fsmi_1 -->

<a href="http://www.acurax.com/branding/?utm_source=fsmi&utm_campaign=sidebar_banner_2" target="_blank" class="acx_ad_fsmi_1">
<div class="acx_ad_fsmi_title"><?php _e('Unique Design For Better Branding','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_title -->
<div class="acx_ad_fsmi_desc acx_ad_fsmi_desc2" style="padding-top: 0px; padding-left: 50px; height: 41px; font-size: 13px; text-align: center;"><?php _e('Get Responsive Custom Designed Website For High Conversion','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_desc -->
</a> <!--  acx_ad_fsmi_1 -->

<a href="http://www.acurax.com/social-profile-design/?utm_source=fsmi&utm_campaign=sidebar_banner_3" target="_blank" class="acx_ad_fsmi_1">
<div class="acx_ad_fsmi_title"><?php _e('Brand Your Social Media Profiles','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_title -->
<div class="acx_ad_fsmi_desc acx_ad_fsmi_desc3" style="padding-top: 0px; height: 110px; text-align: left; font-size: 12px; line-height: 20px;"><?php _e('Social Profile Design means customizing and designing your online presence across many social networks in a professional way to maximize your customer engagement.<br><br>Order and Get Social Media Elements in 24 Hours','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_desc -->
</a> <!--  acx_ad_fsmi_1 -->

</div> <!--  acx_ad_banners_fsmi -->
<?php } else { ?>
<div class="acx_fsmi_sidebar_widget">
<div class="acx_fsmi_sidebar_w_title"><?php _e('Affordable Website Services','floating-social-media-icon');?></div> <!-- acx_ad_fsmi_title -->
<div class="acx_fsmi_sidebar_w_content">
<?php _e('We know you are in the process of improving your website, and we the team at Acurax is always available for hire. ','floating-social-media-icon'); ?><a href="http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=sidebar_text_1" target="_blank"><?php _e('Get in touch','floating-social-media-icon') ;?></a>
</div>
</div> <!-- acx_fsmi_sidebar_widget -->
<div class="acx_fsmi_sidebar_widget">
<div class="acx_fsmi_sidebar_w_title"><?php _e('Brand Your Social Media Profiles','floating-social-media-icon');?></div>
<div class="acx_fsmi_sidebar_w_content"><?php _e('Social Profile Design means customizing and designing your online presence across many social networks in a professional way to maximize your customer engagement.','floating-social-media-icon');?> <br><br><a href="http://www.acurax.com/social-profile-design/?utm_source=fsmi&utm_campaign=sidebar_text_2" target="_blank"><?php _e('Order and Get Social Media Elements in 24 Hours','floating-social-media-icon'); ?></a></div>
</div> <!-- acx_fsmi_sidebar_widget -->
<div class="acx_fsmi_sidebar_widget">
<div class="acx_fsmi_sidebar_w_title"><?php _e('Partner With Us','floating-social-media-icon'); ?></div> <!-- acx_ad_fsmi_title -->
<div class="acx_fsmi_sidebar_w_content acx_fsmi_sidebar_w_content_p_slide">
</div>
</div> <!-- acx_fsmi_sidebar_widget -->
<script type="text/javascript">
var acx_fsmi = new Array("<?php _e('<b>Are you an Agency?</b>, You can Outsource your projects to the team at Acurax...<br><br><a href=\'http://www.acurax.com/partner-with-us/?utm_source=fsmi&utm_campaign=sidebar_text_partner\' target=\'_blank\'>Know More...</a>','floating-social-media-icon'); ?>","<?php _e('<ul><li>- Expert team with timely delivery</li><li>- Reducing the project cost</li><li>- Single Point of contact</li><li>- 100% White-label + Non disclosed agreement</li></ul><a href=\'http://www.acurax.com/partner-with-us/?utm_source=fsmi&utm_campaign=sidebar_text_partner\' target=\'_blank\'>Know More...</a>','floating-social-media-icon'); ?>","<?php _e('<ul><li>- Ability to handle multiple projects at a time</li><li>- Well documented project management on project management system</li><li>- No Communication Barriers. Email/support ticket/IM via Skype, Yahoo, Hangouts and Phone etc...</li></ul><a href=\'http://www.acurax.com/partner-with-us/?utm_source=fsmi&utm_campaign=sidebar_text_partner\' target=\'_blank\'>Know More...</a>','floating-social-media-icon'); ?>");
var current_loaded = 0;
function acx_fsmi_t_rotate()
{
	// acx_fsmi_text = acx_fsmi[Math.floor(Math.random()*acx_fsmi.length)];
	acx_fsmi_count = (acx_fsmi.length-1);
	acx_fsmi_text = acx_fsmi[current_loaded];
	jQuery(".acx_fsmi_sidebar_w_content_p_slide").fadeOut('fast');
	jQuery(".acx_fsmi_sidebar_w_content_p_slide").html(acx_fsmi_text);
	jQuery(".acx_fsmi_sidebar_w_content_p_slide").fadeIn('slow');
	current_loaded = current_loaded+1;
	if(current_loaded > acx_fsmi_count)
	{
		current_loaded = 0;
	}
}
jQuery(document).ready(function() {
	acx_fsmi_t_rotate();
	setInterval(function(){ acx_fsmi_t_rotate(); }, 4000);
});
</script>
<?php } ?>
<div class="acx_fsmi_sidebar_widget">
<div class="acx_fsmi_sidebar_w_title"><?php _e('Rate us on wordpress.org','floating-social-media-icon'); ?></div>
<div class="acx_fsmi_sidebar_w_content" style="text-align:center;font-size:13px;"><b><?php _e('Thank you for being with us... If you like our plugin then please show us some love','floating-social-media-icon');?> </b></br>
<a href="https://wordpress.org/support/view/plugin-reviews/<?php echo ACX_FSMI_WP_SLUG; ?>/" target="_blank" style="text-decoration:none;">
<span id="acx_fsmi_stars">
<span class="dashicons dashicons-star-filled"></span>
<span class="dashicons dashicons-star-filled"></span>
<span class="dashicons dashicons-star-filled"></span>
<span class="dashicons dashicons-star-filled"></span>
<span class="dashicons dashicons-star-filled"></span>
</span>
<span class="acx_fsmi_star_button button button-primary"><?php _e('Click Here','floating-social-media-icon'); ?></span>
</a>
<p><?php _e('If you are facing any issues, kindly post them at plugins support forum','floating-social-media-icon');?> <a href="http://wordpress.org/support/plugin/<?php echo ACX_FSMI_WP_SLUG; ?>/" target="_blank"><?php _e('here','floating-social-media-icon'); ?></a>
</div>
</div> <!-- acx_fsmi_sidebar_widget -->
</div> <!--  acx_fsmi_sidebar -->
<?php
} add_action('acx_fsmi_hook_option_sidebar','acx_fsmi_service_banners',100);
 add_action('acx_fsmi_misc_hook_option_sidebar','acx_fsmi_service_banners',100);
/********************************************** MISC Page*********************************************/
function acx_fsmi_misc_nonce_check()
{
	if (!isset($_POST['acx_fsmi_misc_nonce'])) die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if (!wp_verify_nonce($_POST['acx_fsmi_misc_nonce'],'acx_fsmi_misc_nonce')) die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if(!current_user_can('manage_options')) die("<br><br>".__('Sorry, You have no permission to do this action...','floating-social-media-icon')."</a>");
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_misc_nonce_check',1);
function acx_fsmi_misc_nonce_field()
{
	echo "<input name='acx_fsmi_misc_nonce' type='hidden' value='".wp_create_nonce('acx_fsmi_misc_nonce')."' />";
	echo "<input name='acx_fsmi_misc_hidden' type='hidden' value='Y' />";
} add_action('acx_fsmi_misc_hook_option_fields','acx_fsmi_misc_nonce_field',10);
function acx_fsmi_misc_option_form_start()
{
	echo "<form name='acx_fsmi_misc_form' id='acx_fsmi_form'  method='post' action='".str_replace( '%7E', '~',$_SERVER['REQUEST_URI'])."'>";
} add_action('acx_fsmi_misc_hook_option_form_head','acx_fsmi_misc_option_form_start',100);
function acx_fsmi_misc_option_form_end()
{
	echo "</form>";
}  add_action('acx_fsmi_misc_hook_option_form_footer','acx_fsmi_misc_option_form_end',100);
function acx_fsmi_misc_option_div_start()
{
	echo "<div id=\"acx_fsmi_option_page_holder\"> \n";
	acx_fsmi_hook_function('acx_fsmi_misc_hook_option_above_page_left');
	echo "<div class=\"acx_fsmi_option_page_left\"> \n";
} add_action('acx_fsmi_misc_hook_option_form_head','acx_fsmi_misc_option_div_start',30);
function acx_fsmi_misc_option_sidebar_start()
{
	echo "</div> <!-- acx_fsmi_option_page_left --> \n";
	echo "<div class=\"acx_fsmi_option_page_right\"> \n";
}  add_action('acx_fsmi_misc_hook_option_sidebar','acx_fsmi_misc_option_sidebar_start',10);
function acx_fsmi_misc_option_sidebar_end()
{
	echo "</div> <!-- acx_fsmi_option_page_right --> \n";
	acx_fsmi_hook_function('acx_fsmi_misc_hook_option_footer');
	echo "</div> <!-- acx_fsmi_option_page_holder --> \n";
} add_action('acx_fsmi_misc_hook_option_sidebar','acx_fsmi_misc_option_sidebar_end',500);
function acx_misc_print_option_page_title()
{
		$acx_string = __("Acurax Social Icons Misc Settings","floating-social-media-icon");
 echo print_acx_fsmi_option_heading($acx_string);
} add_action('acx_fsmi_misc_hook_option_form_head','acx_misc_print_option_page_title',50);

function display_acx_fsmi_misc_saved_success()
{ ?>
<div class="updated"><p><strong><?php _e('Acurax Floating Social Icons Misc Settings Saved!.','floating-social-media-icon' ); ?></strong></p></div>
<script type="text/javascript">
		 setTimeout(function(){
				jQuery('.updated').fadeOut('slow');
				
				}, 4000);

		</script>

<?php
}   add_action('acx_fsmi_misc_hook_option_onpost','display_acx_fsmi_misc_saved_success',5000);
/******************************************************* HELP *****************************************************/
function acx_fsmi_help_option_div_start()
{
	echo "<div id=\"acx_fsmi_option_page_holder\"> \n";
	acx_fsmi_hook_function('acx_fsmi_help_hook_option_above_page_left');
} add_action('acx_fsmi_help_hook_option_form_head','acx_fsmi_help_option_div_start',100);
function acx_fsmi_help_option_sidebar_end()
{

	echo "</div> <!-- acx_fsmi_option_page_holder --> \n";
} add_action('acx_fsmi_help_hook_option_sidebar','acx_fsmi_help_option_sidebar_end',500);
/*********************************************** Expert Support *************************************************/
function acx_fsmi_exprt_option_div_start()
{
	echo "<div id=\"acx_fsmi_option_page_holder\"> \n";
	
} add_action('acx_fsmi_exprt_hook_option_form_head','acx_fsmi_exprt_option_div_start',100);
function acx_fsmi_exprt_option_sidebar_end()
{
acx_fsmi_hook_function('acx_fsmi_exprt_hook_option_above_page_left');
	echo "</div> <!-- acx_fsmi_option_page_holder --> \n";
} 
add_action('acx_fsmi_exprt_hook_option_sidebar','acx_fsmi_exprt_option_sidebar_end',500);

/*********************************************** Addons Page *************************************************/
function acx_fsmi_addon_option_div_start()
{
	echo "<div id=\"acx_fsmi_option_page_holder\" class=\"acx_fsmi_option_page_hold_cvr\"> \n";
	acx_fsmi_hook_function('acx_fsmi_addon_hook_option_above_page_cvr');
	echo "<div class=\"acx_fsmi_addon_option_page_cvr\"> \n";
} add_action('acx_fsmi_addon_hook_option_page_head','acx_fsmi_addon_option_div_start',30);
function acx_fsmi_addon_hook_heading()
{
	$acx_string = __("Acurax Social Icons  - Available Addons","floating-social-media-icon");
 echo print_acx_fsmi_option_heading($acx_string);
}
add_action("acx_fsmi_addon_hook_option_above_page_cvr","acx_fsmi_addon_hook_heading");
function acx_fsmi_addon_option_sidebar_start()
{
	acx_fsmi_hook_function('acx_fsmi_addon_hook_option_field_content');
	echo "</div> <!-- acx_fsmi_addon_option_page_cvr --> \n";
}  add_action('acx_fsmi_addon_hook_option_page','acx_fsmi_addon_option_sidebar_start',10);
function acx_fsmi_addon_option_sidebar_end()
{
	acx_fsmi_hook_function('acx_fsmi_addon_hook_option_footer');
	echo "</div> <!-- acx_fsmi_option_page_holder --> \n";
} add_action('acx_fsmi_addon_hook_option_page','acx_fsmi_addon_option_sidebar_end',500);
?>