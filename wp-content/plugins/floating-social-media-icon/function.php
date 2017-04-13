<?php
function acx_fsmi_theme_array_filter_hook()
{
	global $acx_fsmi_themes_array;
	$acx_fsmi_themes_array = array();
	
	$acx_fsmi_themes_array = apply_filters('acx_fsmi_theme_array_filter',$acx_fsmi_themes_array);	
} add_action('init','acx_fsmi_theme_array_filter_hook');
function acx_fsmi_theme_array_filter_fn($acx_fsmi_themes_array)
{
	return $acx_fsmi_themes_array;
} add_filter('acx_fsmi_theme_array_filter','acx_fsmi_theme_array_filter_fn',5);

function acx_fsmi_theme_add_filter_fn($acx_fsmi_themes_array)
{
	for($i = 0;$i < 30 ;$i++)
	{
		$acx_fsmi_themes_array[$i] = array(
			'id' => $i,
			'path' => ACX_FSMI_BASE_LOCATION
		);
	}
	return $acx_fsmi_themes_array;
}
add_filter('acx_fsmi_theme_array_filter','acx_fsmi_theme_add_filter_fn',55);
function acx_fsmi_styles() 
{	
	wp_register_style('acx_fsmi_admin_style', plugins_url('css/style_admin.css?v='.ACX_FSMI_C_VERSION, __FILE__));
	wp_enqueue_style('acx_fsmi_admin_style');
	
	wp_register_style('acx_fsmiaddons_style', plugins_url('css/fsmi_addons.css?v='.ACX_FSMI_C_VERSION, __FILE__));
	wp_enqueue_style('acx_fsmiaddons_style');
	
	wp_register_style('acx_fsmi_box_style', plugins_url('css/layout.css?v='.ACX_FSMI_C_VERSION, __FILE__));
	wp_enqueue_style('acx_fsmi_box_style');
}
add_action('admin_enqueue_scripts', 'acx_fsmi_styles');
function acx_fsmi_css()
{
	wp_register_style('acx_fsmi_styles', plugins_url('css/style.css?v='.ACX_FSMI_C_VERSION, __FILE__));
	wp_enqueue_style('acx_fsmi_styles');
}
add_action('admin_enqueue_scripts','acx_fsmi_css');
add_action('wp_enqueue_scripts','acx_fsmi_css');
function acx_si_custom_admin_js()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
}	add_action( 'admin_enqueue_scripts', 'acx_si_custom_admin_js' );
function print_acx_fsmi_option_heading($heading)
{
	$heading_format = "<h2 class='acx_fsmi_option_head'>";
	$heading_format .= $heading;
	$heading_format .= "</h2>";
	return $heading_format;
}
function print_acx_fsmi_option_block_start($title,$pre_fix="",$suf_fix="")
{
	global $acx_fsmi_options_uid;
	if(!$acx_fsmi_options_uid || $acx_fsmi_options_uid == "")
	{
	$acx_fsmi_options_uid = 0;
	}
	$acx_fsmi_options_uid = $acx_fsmi_options_uid+1;
	echo "<div class='acx_fsmi_q_holder acx_fsmi_q_holder_".$acx_fsmi_options_uid."'>";
	echo $pre_fix;
	echo "<h4>".$title."</h4>";
	echo $suf_fix;
	echo "<div class='acx_fsmi_q_holder_c acx_fsmi_q_holder_c_".$acx_fsmi_options_uid."'>";
}
function print_acx_fsmi_option_block_end()
{
	echo "</div> <!-- acx_fsmi_q_holder_c -->";
	echo "</div> <!-- acx_fsmi_q_holder -->";
}
function acx_fsmi_post_isset_check($field)
{
	$value = "";
	if(ISSET($_POST[$field]))
	{
		$value = $_POST[$field];
	}
	return $value;
}

function acx_fsmi_quick_form()
{
if(ISSET($_SERVER['HTTP_HOST']))
{
$acx_installation_url = $_SERVER['HTTP_HOST'];
} else
{
$acx_installation_url = "";
}
?>
<div class="acx_fsmi_es_common_raw acx_fsmi_es_common_bg">
	<div class="acx_fsmi_es_middle_section">
    
    <div class="acx_fsmi_es_acx_content_area">
    	<div class="acx_fsmi_es_wp_left_area">
        <div class="acx_fsmi_es_wp_left_content_inner">
        	<div class="acx_fsmi_es_wp_main_head"><?php _e('Get Expert Support For Your Website Needs Instantly','floating-social-media-icon');?></div> <!-- wp_main_head -->
            <div class="acx_fsmi_es_wp_sub_para_des"><?php _e('Acurax offer a number of WordPress related services: Form installing WordPress on your domain to offering support for existing WordPress sites.','floating-social-media-icon'); ?></div> <!-- acx_fsmi_es_wp_sub_para_des -->
            <div class="acx_fsmi_es_wp_acx_service_list">
            	<ul>
                <li><?php _e('Troubleshoot WordPress Site Issues','floating-social-media-icon'); ?></li>
                    <li><?php _e('Recommend & Install Plugins For Improved WordPress Performance','floating-social-media-icon'); ?></li>
                    <li><?php _e('Create, Modify, Or Customise, Themes','floating-social-media-icon'); ?></li>
                    <li><?php _e('Explain Errors And Recommend Solutions','floating-social-media-icon'); ?></li>
                    <li><?php _e('Custom Plugin Development According To Your Needs','floating-social-media-icon'); ?></li>
                    <li><?php _e('Plugin Integration Support','floating-social-media-icon'); ?></li>
                    <li><?php _e('Many','floating-social-media-icon'); ?> <a href="http://www.acurax.com/?utm_source=fsmi&utm_campaign=expert_support" target="_blank"><?php _e('More...','floating-social-media-icon'); ?></a></li>
               </ul>
            </div> <!-- acx_fsmi_es_wp_acx_service_list -->
            
   <div class="acx_fsmi_es_wp_send_ylw_para"><?php _e('We Have Extensive Experience in WordPress Troubleshooting,Theme Design & Plugin Development.','floating-social-media-icon'); ?></div> <!-- acx_fsmi_es_wp_secnd_ylw_para-->
   
        </div> <!-- acx_fsmi_es_wp_left_content_inner -->
        </div> <!-- acx_fsmi_es_wp_left_area -->
        
        <div class="acx_fsmi_es_wp_right_area">
        	<div class="acx_fsmi_es_wp_right_inner_form_wrap">
            	<div class="acx_fsmi_es_wp_inner_wp_form">
                <div class="acx_fsmi_es_wp_form_head"><?php _e('WE ARE DEDICATED TO HELP YOU. SUBMIT YOUR REQUEST NOW..!','floating-social-media-icon'); ?></div> <!-- acx_fsmi_es_wp_form_head -->
                <form class="acx_fsmi_es_wp_support_acx">
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_right"><input type="text" placeholder="<?php _e('Name*','floating-social-media-icon'); ?>" id="acx_name"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_left"><input type="email" placeholder="<?php _e('Email*','floating-social-media-icon'); ?>" id="acx_email"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_right"><input type="text" placeholder="<?php _e('Phone Number*','floating-social-media-icon'); ?>" id="acx_phone"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_left"><input type="text" placeholder="<?php _e('Website URL*','floating-social-media-icon'); ?>" value="<?php echo $acx_installation_url; ?>" id="acx_weburl"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><input type="text" placeholder="<?php _e('Subject*','floating-social-media-icon'); ?>" id="acx_subject"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><textarea placeholder="<?php _e('Question*','floating-social-media-icon'); ?>" id="acx_question"></textarea></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><input class="acx_fsmi_es_wp_acx_submit" type="button" value="<?php _e('SUBMIT REQUEST','floating-social-media-icon'); ?>" onclick="acx_quick_fsmi_request_submit();"></span> <!-- acx_fsmi_es_cnvas_input -->
                </form>
                </div> <!-- acx_fsmi_es_wp_inner_wp_form -->
            </div> <!-- acx_fsmi_es_wp_right_inner_form_wrap -->
        </div> <!-- acx_fsmi_es_wp_left_area -->
    </div> <!-- acx_fsmi_es_acx_content_area -->
    
    <div class="acx_fsmi_es_footer_content_cvr">
    <div class="acx_fsmi_es_wp_footer_area_desc"><?php _e('Its our pleasure to thank you for using our plugin and being with us. We always do our best to help you on your needs.','floating-social-media-icon'); ?></div> <!--acx_fsmi_es_wp_footer_area_desc -->
    </div> <!-- acx_fsmi_es_footer_content_cvr -->
    
    </div> <!-- acx_fsmi_es_middle_section -->
</div> <!--acx_fsmi_es_common_raw -->
<script type="text/javascript">
var request_acx_form_status = 0;
function acx_quick_form_reset()
{
jQuery("#acx_subject").val('');
jQuery("#acx_question").val('');
}
acx_quick_form_reset();
function acx_quick_fsmi_request_submit()
{
var acx_name = jQuery("#acx_name").val();
var acx_email = jQuery("#acx_email").val();
var acx_phone = jQuery("#acx_phone").val();
var acx_weburl = jQuery("#acx_weburl").val();
var acx_subject = jQuery("#acx_subject").val();
var acx_question = jQuery("#acx_question").val();
var order = '&action=acx_quick_fsmi_request_submit&acx_name='+acx_name+'&acx_email='+acx_email+'&acx_phone='+acx_phone+'&acx_weburl='+acx_weburl+'&acx_subject='+acx_subject+'&acx_question='+acx_question+'&acx_smw_es=<?php echo wp_create_nonce("acx_smw_es"); ?>'; 
if(request_acx_form_status == 0)
{
request_acx_form_status = 1;
jQuery.post(ajaxurl, order, function(quick_request_acx_response)
{
if(quick_request_acx_response == 1)
{
alert('<?php _e('Your Request Submitted Successfully!','floating-social-media-icon'); ?>');
acx_quick_form_reset();
request_acx_form_status = 0;
} else if(quick_request_acx_response == 2)
{
alert('<?php _e('Please Fill Mandatory Fields.','floating-social-media-icon'); ?>');
request_acx_form_status = 0;
} else
{
alert('<?php _e('There was an error processing the request, Please try again.','floating-social-media-icon'); ?>');
acx_quick_form_reset();
request_acx_form_status = 0;
}
});
} else
{
alert('<?php _e('A request is already in progress.','floating-social-media-icon'); ?>');
}
}
</script>
<?php }
add_action('acx_fsmi_troubleshoot_hook_option_footer','acx_fsmi_quick_form');

function acx_quick_fsmi_request_submit_callback()
{
	$acx_name =  $acx_email =  $acx_phone =  $acx_weburl = $acx_subject = $acx_question = $acx_smw_es = "";
	if(ISSET($_POST['acx_name']))
	{
		$acx_name =  $_POST['acx_name'];
	}
	if(ISSET($_POST['acx_email']))
	{
		$acx_email =  $_POST['acx_email'];
	}
	if(ISSET($_POST['acx_phone']))
	{
		$acx_phone =  $_POST['acx_phone'];
	}
	if(ISSET($_POST['acx_weburl']))
	{
		$acx_weburl =  $_POST['acx_weburl'];
	}
	if(ISSET($_POST['acx_subject']))
	{
		$acx_subject =  $_POST['acx_subject'];
	}
	if(ISSET($_POST['acx_question']))
	{
		$acx_question =  $_POST['acx_question'];
	}
	if(ISSET($_POST['acx_smw_es']))
	{
		$acx_smw_es = $_POST['acx_smw_es'];
	}
	if (!wp_verify_nonce($acx_smw_es,'acx_smw_es'))
	{
		$acx_smw_es == "";
	}
	if(!current_user_can('manage_options'))
	{
		$acx_smw_es == "";
	}
	if($acx_smw_es == "" || $acx_name == "" || $acx_email == "" || $acx_phone == "" || $acx_weburl == "" || $acx_subject == "" || $acx_question == "")
	{
		echo 2;
	}
	else
	{
		$current_user_acx = wp_get_current_user();
		$current_user_acx = $current_user->user_email;
		if($current_user_acx == "")
		{
			$current_user_acx = $acx_email;
		}
		$headers[] = "from: ". $acx_name . ' <' . $current_user_acx . '>';
		$headers[] = "Content-Type: text/html; charset=UTF-8"; 
		$message = "Name: ".$acx_name . "\r\n <br>";
		$message = $message ."E-mail: ".$acx_email . "\r\n <br>";
		if($acx_phone != "")
		{
			$message = $message ."Phone: ".$acx_phone . "\r\n <br>";
		}
		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$acx_question = wordwrap($acx_question, 70, "\r\n <br>");
		$message = $message ."Request From: FSMI - Expert Help Request Form  \r\n <br>"; 
		$message = $message . "Website:".$acx_weburl . "\r\n <br>";
		$message = $message . "Question:" .$acx_question . "\r\n <br>";
		$message = stripslashes($message);
		$acx_subject = "Plugin Support - " . $acx_subject;
		$emailed = wp_mail( 'info@acurax.com', $acx_subject, $message, $headers );
		if($emailed)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	die(); // this is required to return a proper result
}add_action('wp_ajax_acx_quick_fsmi_request_submit','acx_quick_fsmi_request_submit_callback');

//*************** Include style.css in Header ********
// Getting Option From DB *****************************	
$acx_si_theme = get_option('acx_si_theme');
$acx_si_credit = get_option('acx_si_credit');
$acx_si_display = get_option('acx_si_display');
$acx_si_twitter = get_option('acx_si_twitter');
$acx_si_facebook = get_option('acx_si_facebook');
$acx_si_youtube = get_option('acx_si_youtube');
$acx_si_linkedin = get_option('acx_si_linkedin');
$acx_si_gplus = get_option('acx_si_gplus');
$acx_si_pinterest = get_option('acx_si_pinterest');
$acx_si_feed = get_option('acx_si_feed');
$acx_si_instagram = get_option('acx_si_instagram');
$acx_si_icon_size = get_option('acx_si_icon_size');
$acx_si_fsmi_float_fix = get_option('acx_si_fsmi_float_fix');
$acx_si_fsmi_theme_warning_ignore = get_option('acx_si_fsmi_theme_warning_ignore');
$acx_si_fsmi_disable_mobile = get_option('acx_si_fsmi_disable_mobile');
// *****************************************************
$social_icon_array_order = get_option('social_icon_array_order');
if(is_serialized($social_icon_array_order))
{
$social_icon_array_order = unserialize($social_icon_array_order);
}

function acx_fsmi_orderarray_refresh()
{
	global $social_icon_array_order;
	/* Starting The Logic Count and Re Configuring Order Array */	
	$total_arrays = ACX_FSMI_TOTAL_STATIC_SERVICES; // Number Of Static Services ,<< Earlier its 10
	if(is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = unserialize($social_icon_array_order);
	}
	if($social_icon_array_order == "")
	{
	$social_icon_array_order = array();
	}	
	if (empty($social_icon_array_order)) 
	{
		for( $i = 0; $i < $total_arrays; $i++ )
		{
			array_push($social_icon_array_order,$i);
		}
		
		if(!is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = serialize($social_icon_array_order);
		}
		update_option('social_icon_array_order', $social_icon_array_order);
	} else 
	{
		// Counting and Adding New Keys (UPGRADE PURPOSE)
		$social_icon_array_order = get_option('social_icon_array_order');
		if(is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = unserialize($social_icon_array_order);
		}
		$social_icon_array_count = count($social_icon_array_order); 
		if ($social_icon_array_count < $total_arrays) 
		{
			for( $i = $social_icon_array_count; $i < $total_arrays; $i++ )
			{
				array_push($social_icon_array_order,$i);
			} // for
		} else
		{
		//	$acx_diff = ($social_icon_array_count - $total_arrays);
			$acx_temp_array = $social_icon_array_order;
			foreach ($social_icon_array_order as $key => $value)
			{
				if($social_icon_array_order[$key]>=$total_arrays || !is_numeric($value))
				{
					unset($acx_temp_array[$key]);
				}
			}
			$acx_temp_array = array_values($acx_temp_array);
			$social_icon_array_order = $acx_temp_array;
		}
		if(!is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = serialize($social_icon_array_order);
		}
		update_option('social_icon_array_order', $social_icon_array_order);
	} // else closing of if array null
/* Ending The Logic Count and Re Configuring Order Array */	
}
function acx_fsmi_array_refresh_hook()
{
	add_action('acx_fsmi_array_refresh','acx_fsmi_orderarray_refresh',50);
}
add_action("init","acx_fsmi_array_refresh_hook");
// Check Credit Link

// Options Value Checker
function check_acx_credit($yes,$no)
{ 
	$acx_si_credit = get_option('acx_si_credit');
	if($acx_si_credit != "no") 
	{ 
		echo $yes;
	} 
	else 
	{ 
		echo $no; 
	} 
}

function acurax_si_simple($acx_array) // Added Default "" // Updated << and V (alt added to Images Title Added to Links)
{
	// Getting Globals *****************************	
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed,$acx_si_instagram, $acx_si_icon_size;
	// *****************************************************
	$theme = $size = '';
	if(is_array($acx_array) && array_key_exists('theme',$acx_array))
	{
		$theme = $acx_array['theme'];	
	}
	if(empty($acx_array))
	{
		$acx_array = array('theme' =>$acx_si_theme,
							'size' =>$acx_si_icon_size
							
							);
	}
	if(is_array($acx_array) && array_key_exists('size',$acx_array))
	{
		$size = $acx_array['size'];	
	}
	if($size == "")
	{
		$size = $acx_si_icon_size;
	}
	if($size != "")
	{
		$size = $size."px";
		$acx_si_icon_height_width_attribute = "height='".$size."' width='".$size."'";
	} else
	{
	$acx_si_icon_height_width_attribute = "";
	}
	if ($theme == "") { $acx_si_touse_theme = $acx_si_theme; } else { $acx_si_touse_theme = $theme; }
		//******** MAKING EACH BUTTON LINKS ********************
		$acx_si_fsmi_no_follow = get_option('acx_si_fsmi_no_follow');
		if($acx_si_fsmi_no_follow == 'yes')
		{
			$acx_si_fsmi_rel = "rel='nofollow'";
		}
		else{
			$acx_si_fsmi_rel = "";
		}
		if	($acx_si_twitter == "") { $twitter_link = ""; } else 
		{
			$alt_text_twitter =  __('Visit Us On Twitter','floating-social-media-icon');
			$twitter_link = "<a href='http://www.twitter.com/". $acx_si_twitter ."' target='_blank' ".$acx_si_fsmi_rel."  title='".$alt_text_twitter."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/twitter.png' style='border:0px;' alt='".$alt_text_twitter."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_facebook == "") { $facebook_link = ""; } else 
		{
			$alt_text_facebook =  __('Visit Us On Facebook','floating-social-media-icon');
			$facebook_link = "<a href='". $acx_si_facebook ."' target='_blank' ".$acx_si_fsmi_rel." title='".$alt_text_facebook."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/facebook.png' style='border:0px;' alt='".$alt_text_facebook."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_gplus == "") { $gplus_link = ""; } else 
		{
			$alt_text_gplus =  __('Visit Us On Google Plus','floating-social-media-icon');
			$gplus_link = "<a href='". $acx_si_gplus ."' target='_blank' ".$acx_si_fsmi_rel."  title='".$alt_text_gplus."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/googleplus.png' style='border:0px;' alt='".$alt_text_gplus."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_pinterest == "") { $pinterest_link = ""; } else 
		{
			$alt_text_pinterest =  __('Visit Us On Pinterest','floating-social-media-icon');
			$pinterest_link = "<a href='". $acx_si_pinterest ."' target='_blank'  ".$acx_si_fsmi_rel." title='".$alt_text_pinterest."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/pinterest.png' style='border:0px;' alt='".$alt_text_pinterest."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_youtube == "") { $youtube_link = ""; } else 
		{
			$alt_text_youtube =  __('Visit Us On Youtube','floating-social-media-icon');
			$youtube_link = "<a href='". $acx_si_youtube ."' target='_blank' ".$acx_si_fsmi_rel." title='".$alt_text_youtube."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/youtube.png' style='border:0px;' alt='".$alt_text_youtube."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_linkedin == "") { $linkedin_link = ""; } else 
		{
			$alt_text_linkedin =  __('Visit Us On Linkedin','floating-social-media-icon');
			$linkedin_link = "<a href='". $acx_si_linkedin ."' target='_blank' ".$acx_si_fsmi_rel." title='".$alt_text_linkedin."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/linkedin.png' style='border:0px;' alt='".$alt_text_linkedin."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_feed == "") { $feed_link = ""; } else 
		{
			$alt_text_feed =  __('Check Our Feed','floating-social-media-icon');
			$feed_link = "<a href='". $acx_si_feed ."' target='_blank' ".$acx_si_fsmi_rel." title='".$alt_text_feed."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/feed.png' style='border:0px;' alt='".$alt_text_feed."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_instagram == "") { $instagram_link = ""; } else 
		{
			$alt_text_instagram =  __('Visit Us On Instagram','floating-social-media-icon');
			$instagram_link = "<a href='". $acx_si_instagram ."' target='_blank' ".$acx_si_fsmi_rel." title='".$alt_text_instagram."'>" . "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_touse_theme ."/instagram.png' style='border:0px;' alt='".$alt_text_instagram."' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		
		
		
	$social_icon_array_order = get_option('social_icon_array_order');
	if(is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = unserialize($social_icon_array_order);
	}
	if($social_icon_array_order == "")
	{
		$social_icon_array_order = array();
	}
	$html = '' ;
	foreach ($social_icon_array_order as $key => $value)
	{
		if ($value == 0) { $html .= $twitter_link; } 
		else if ($value == 1) { $html .= $facebook_link; } 
		else if ($value == 2) {  $html .=  $gplus_link; } 
		else if ($value == 3) {  $html .=  $pinterest_link; } 
		else if ($value == 4) {  $html .=  $youtube_link; } 
		else if ($value == 5) {  $html .=  $linkedin_link; } 
		
		else if ($value == 6) {  $html .=  $feed_link; }
		else if ($value == 7) {  $html .=  $instagram_link; }
	
	}
	$html = apply_filters('acx_fsmip_si_simple',$acx_array,$html);

return $html;
} //acurax_si_simple()
function filter_acx_fsmip_si_simple($acx_array,$html)
{
	if($html != '' && $acx_array != '')
	{
		return $html;
	}
}
add_filter('acx_fsmip_si_simple','filter_acx_fsmip_si_simple',999,2);
function acx_theme_check_wp_head() {
	$template_directory = get_template_directory();
	// If header.php exists in the current theme, scan for "wp_head"
	$file = $template_directory . '/header.php';
	if (is_file($file)) {
		$search_string = "wp_head";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_head() not found:
		echo "<div class=\"highlight\" style=\"margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred; padding: 1%; width: 97%; border-radius: 7px;\">" . __('Your theme needs to be fixed for plugins to work (Especially Floating Social Media Icon). To fix your theme, use the ','floating-social-media-icon')."<a href=\"theme-editor.php\">".__('Theme Editor','floating-social-media-icon')."</a> ".__('to insert','floating-social-media-icon')." <code>".htmlspecialchars("<?php wp_head(); ?>")."</code> ".__('just before the ','floating-social-media-icon')."<code>".htmlspecialchars("</head>")."</code> ".__("line of your theme's","floating-social-media-icon")."<code>".__('header.php','floating-social-media-icon')."</code> ".__('file. - [If everything is working properly, you can disable this warning at','floating-social-media-icon')." <a href=\"admin.php?page=Acurax-Social-Icons-Misc\">".__('misc page','floating-social-media-icon')."</a>]" . "</div>";
	}
} // theme check 
if($acx_si_fsmi_theme_warning_ignore != "yes")
{
add_action('admin_notices', 'acx_theme_check_wp_head');
}
function acx_theme_check_wp_footer() {
	$template_directory = get_template_directory();
	
	// If footer.php exists in the current theme, scan for "wp_footer"
	$file = $template_directory . '/footer.php';
	if (is_file($file)) {
		$search_string = "wp_footer";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_footer() not found:
		echo "<div class=\"highlight\" style=\"margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred; padding: 1%; width: 97%; border-radius: 7px;\">" . __('Your theme needs to be fixed for plugins to work (Especially Floating Social Media Icon). To fix your theme, use the ','floating-social-media-icon')."<a href=\"theme-editor.php\">" . __('Theme Editor','floating-social-media-icon')."</a>" . __(' to insert ','floating-social-media-icon')."<code>".htmlspecialchars("<?php wp_footer(); ?>")."</code>" . __(' just before the ','floating-social-media-icon')."<code>".htmlspecialchars("</body>")."</code>" . __(" line of your theme's ","floating-social-media-icon")."<code>" . __('footer.php','floating-social-media-icon')."</code>" . __(' file. - [If everything is working properly, you can disable this warning at ','floating-social-media-icon')."<a href=\"admin.php?page=Acurax-Social-Icons-Misc\">" . __('misc page','floating-social-media-icon')."</a>]" . "</div>";
	}
}
if($acx_si_fsmi_theme_warning_ignore != "yes")
{
add_action('admin_notices', 'acx_theme_check_wp_footer');
}
function acurax_icons()
{
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed,$acx_si_instagram,$acx_si_icon_size;
			
	if($acx_si_twitter != "" || $acx_si_facebook != "" || $acx_si_youtube != "" || $acx_si_linkedin != ""  || 
	$acx_si_pinterest != "" || $acx_si_gplus != "" || $acx_si_feed != "" || $acx_si_instagram != "" )
	{
	//*********************** STARTED DISPLAYING THE ICONS ***********************
		echo "\n\n\n<!-- Starting Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n";
		echo "<div id='divBottomRight' style='text-align:center;'>";
		$acx_to_pass_array = array(
		'theme' => $acx_si_theme,
		'size'  => $acx_si_icon_size
		);
		echo acurax_si_simple($acx_to_pass_array);
		echo "</div>\n";
		echo "<!-- Ending Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
	//*****************************************************************************
	} // Chking null fields
	
} // Ending acurax_icons();
// Setting X Y values for javascript
$x = -170;
$y = -60;
function acx_load_floating_js()
{ 
	global $x;
	global $y;
	//*************** STARTING PUMBING JAVASCIRPT *******************************
	echo "\n\n\n<!-- Starting Javascript For Social Media Icon From Acurax International www.acurax.com -->\n";	
	$acx_si_icon_size = get_option('acx_si_icon_size');
	////////////////////////////////////////////////////////////////////////////
	//STARTING CROSS CHECK			    $count,$icon_size,$set_value  
	function acx_si_check_loaded_count($count,$icon_size,$set_x_value,$set_y_value)
	{
		// Defining Values To Use
		$acx_si_icon_size = get_option('acx_si_icon_size'); // Getting Value From DB :)
		$acx_si_twitter = get_option('acx_si_twitter');
		$acx_si_facebook = get_option('acx_si_facebook');
		$acx_si_youtube = get_option('acx_si_youtube');
		$acx_si_linkedin = get_option('acx_si_linkedin');
		$acx_si_feed = get_option('acx_si_feed');
		$acx_si_instagram = get_option('acx_si_instagram');
		$acx_si_gplus = get_option('acx_si_gplus');
		$acx_si_pinterest = get_option('acx_si_pinterest');
		$count_check = 0;
		$l1 = 0;
		$l2 = 0;
		$l3 = 0;
		$l4 = 0;
		$l5 = 0;
		$l6 = 0;
		$l7 = 0;
		$l8 = 0;
		if ($acx_si_twitter != "") { $l1 = 1; }
		if ($acx_si_facebook != "") { $l2 = 1; }
		if ($acx_si_youtube != "") { $l3 = 1; }
		if ($acx_si_linkedin != "") { $l4 = 1; }
		if ($acx_si_gplus != "") { $l5 = 1; }
		if ($acx_si_pinterest != "") { $l6 = 1; }
		if ($acx_si_feed != "") { $l7 = 1; }
		if ($acx_si_instagram != "") { $l8 = 1; }
		$count_check = $l1 + $l2 + $l3 + $l4 + $l5 + $l6 + $l7 + $l8;
		if ($acx_si_icon_size == $icon_size && $count_check == $count)
		{
			global $x;
			global $y;
			$x = $set_x_value;
			$y = $set_y_value;
		}
	} // ENDING THE FUNCTION TO CROS CHECK
	/**************************************************************************
	CONDITIONS STARTING HERE  
	if X Decreases then move to Right
	If Y Decreases then Move to Down
	***************************************************************************/
	// Icon Size 16 Starts Here
	acx_si_check_loaded_count(1,16,-170,-35);
	acx_si_check_loaded_count(2,16,-170,-35);
	acx_si_check_loaded_count(3,16,-170,-35);
	acx_si_check_loaded_count(4,16,-170,-35);
	acx_si_check_loaded_count(5,16,-170,-35);
	acx_si_check_loaded_count(6,16,-170,-35);
	acx_si_check_loaded_count(7,16,-170,-35);
	acx_si_check_loaded_count(8,16,-170,-35);
	// *********************************
	// Icon Size 25 Starts Here
	acx_si_check_loaded_count(1,25,-160,-50);
	acx_si_check_loaded_count(2,25,-160,-50);
	acx_si_check_loaded_count(3,25,-160,-50);
	acx_si_check_loaded_count(4,25,-160,-50);
	acx_si_check_loaded_count(5,25,-160,-50);
	acx_si_check_loaded_count(6,25,-180,-50);
	acx_si_check_loaded_count(7,25,-180,-50);
	acx_si_check_loaded_count(8,25,-180,-50);
	// *********************************
	// Icon Size 32 Starts Here
	acx_si_check_loaded_count(1,32,-170,-55);
	acx_si_check_loaded_count(2,32,-170,-55);
	acx_si_check_loaded_count(3,32,-170,-55);
	acx_si_check_loaded_count(4,32,-170,-55);
	acx_si_check_loaded_count(5,32,-190,-70);
	acx_si_check_loaded_count(6,32,-160,-80);
	acx_si_check_loaded_count(7,32,-160,-80);
	acx_si_check_loaded_count(8,32,-160,-80);
	// *********************************
	// Icon Size 40 Starts Here
	acx_si_check_loaded_count(1,40,-170,-65);
	acx_si_check_loaded_count(2,40,-170,-65);
	acx_si_check_loaded_count(3,40,-170,-65);
	acx_si_check_loaded_count(4,40,-170,-105);
	acx_si_check_loaded_count(5,40,-170,-105);
	acx_si_check_loaded_count(6,40,-170,-105);
	acx_si_check_loaded_count(7,40,-170,-145);
	acx_si_check_loaded_count(8,40,-170,-145);
	// *********************************
	// Icon Size 48 Starts Here
	acx_si_check_loaded_count(1,48,-170,-75);
	acx_si_check_loaded_count(2,48,-170,-75);
	acx_si_check_loaded_count(3,48,-170,-75);
	acx_si_check_loaded_count(4,48,-170,-120);
	acx_si_check_loaded_count(5,48,-170,-120);
	acx_si_check_loaded_count(6,48,-170,-120);
	acx_si_check_loaded_count(7,48,-170,-175);
	acx_si_check_loaded_count(8,48,-170,-175);
	// *********************************
	// Icon Size 55 Starts Here
	acx_si_check_loaded_count(1,55,-170,-80);
	acx_si_check_loaded_count(2,55,-170,-80);
	acx_si_check_loaded_count(3,55,-170,-135);
	acx_si_check_loaded_count(4,55,-170,-135);
	acx_si_check_loaded_count(5,55,-190,-135);
	acx_si_check_loaded_count(6,55,-190,-135);
	acx_si_check_loaded_count(7,55,-190,-200);
	acx_si_check_loaded_count(8,55,-190,-200);
	// *********************************
	/**************************************************************************
	CONDITIONS ENDING HERE
	***************************************************************************/
	?>
	<script type="text/javascript">
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	var px = document.layers ? "" : "px";
	function JSFX_FloatDiv(id, sx, sy)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		window[id + "_obj"] = el;
		if(d.layers)el.style=el;
		el.cx = el.sx = sx;el.cy = el.sy = sy;
		el.sP=function(x,y){this.style.left=x+px;this.style.top=y+px;};
		el.flt=function()
		{
			var pX, pY;
			pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
			document.documentElement && document.documentElement.clientWidth ? 
			document.documentElement.clientWidth : document.body.clientWidth;
			pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
			document.documentElement.scrollTop : document.body.scrollTop;
			if(this.sy<0) 
			pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
			document.documentElement.clientHeight : document.body.clientHeight;
			this.cx += (pX + this.sx - this.cx)/8;this.cy += (pY + this.sy - this.cy)/8;
			this.sP(this.cx, this.cy);
			setTimeout(this.id + "_obj.flt()", 40);
		}
		return el;
	}
	jQuery( document ).ready(function() {
	JSFX_FloatDiv("divBottomRight", <?php echo $x; ?>, <?php echo $y; ?>).flt();
	});
	</script>
	<?php echo "<!-- Ending Javascript Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
} 	if ($acx_si_display == "auto" || $acx_si_display == "both") 
	{
		add_action('wp_footer', 'acx_load_floating_js',101);
	}
// Starting Footer PBL
function pbl_footer() 
{
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed,$acx_si_instagram;
	//********** CHECKING CREDIT LINK STATUS ******************
	if($acx_si_twitter != "" || $acx_si_facebook != "" || $acx_si_youtube != "" || $acx_si_linkedin != ""  || $acx_si_pinterest != "" || $acx_si_gplus != "" || $acx_si_feed != "" || $acx_si_instagram != "")
	{
		
		if($acx_si_credit == "yes") 
		{ 
			$acx_fsmi_bl_style="text-align:center;font-family:arial;font-size:12px;text-decoration:none;";
			echo "<div style='".$acx_fsmi_bl_style."'>";
			$acx_get_url = "http://";
			$acx_get_url .= $_SERVER['HTTP_HOST'];
			$acx_get_url .= $_SERVER['REQUEST_URI'];
			$acx_installation_domain = $_SERVER['HTTP_HOST'];
			$acx_installation_domain = str_replace("www.","",$acx_installation_domain);
			$acx_installation_domain = str_replace(".","_",$acx_installation_domain);
			if($acx_installation_domain == "") { $acx_installation_domain = "not_defined";}
			$x = strlen($acx_get_url);
			if(($x % 10) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>".__('Animated Social Media Icons','floating-social-media-icon')."</a> ".__(' by ','floating-social-media-icon')."<a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>".__('Acurax Wordpress Development Company','floating-social-media-icon')."</a>";
			} else if(($x % 9) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>".__('Floating Social Media Icons','floating-social-media-icon')."</a> ".__(' by ','floating-social-media-icon')."<a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>".__('Acurax Wordpress Designers','floating-social-media-icon')."</a>";
			} else if(($x % 8) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>".__('Social Media Integration','floating-social-media-icon')."</a>".__(' by ','floating-social-media-icon')." <a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>".__('Acurax Wordpress Developers','floating-social-media-icon')."</a>";
			} else if(($x % 7) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>".__('Plugin for Social Media','floating-social-media-icon')."</a>". __('  by ','floating-social-media-icon')."<a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>".__('Acurax Wordpress Design Studio','floating-social-media-icon')."</a>";
			} else if(($x % 6) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('Social Media Widget','floating-social-media-icon')."</a>". __(' Powered by','floating-social-media-icon')." <a href='http://www.acurax.com/webdevelopment/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>".__('Acurax Web Development Company','floating-social-media-icon')."</a>";
			}
			else if(($x % 5) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Social Media Icons','floating-social-media-icon')."</a> ". __(' Powered by ','floating-social-media-icon')."<a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>".__('Acurax Web Design Company','floating-social-media-icon')."</a>";
			} 
			else if(($x % 4) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Social Network Integration','floating-social-media-icon')."</a> ". __(' by','floating-social-media-icon')." <a href='http://www.acurax.com/social-profile-design/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Acurax Social Media Branding Company','floating-social-media-icon')."</a>";
			} else if(($x % 3) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Social Network Widget','floating-social-media-icon')."</a>". __('  by ','floating-social-media-icon')."<a href='http://www.acurax.com/web-solution-consultation/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Acurax Small Business Website Designers','floating-social-media-icon')."</a>";
			} else if(($x % 2) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('Customized Social Media Icons','floating-social-media-icon')."</a>". __(' from ','floating-social-media-icon')."<a href='http://www.acurax.com/digital-marketing/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('Acurax Digital Marketing Agency','floating-social-media-icon')."</a>";
			} else if(($x % 1) == 0)
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('Animated Social Media Icons','floating-social-media-icon')."</a>". __(' by','floating-social-media-icon')." <a href='http://www.acurax.com/webdesigning/?utm_source=fsmi&utm_campaign=blink' target='_blank'  style='".$acx_fsmi_bl_style."'>". __('Acurax Responsive Web Designing Company','floating-social-media-icon')."</a>";
			} else 
			{
			echo "<a href='http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('SocialMedia Integration','floating-social-media-icon')."</a> ". __('Powered by','floating-social-media-icon')." <a href='http://www.acurax.com/ecommerce/?utm_source=fsmi&utm_campaign=blink' target='_blank' style='".$acx_fsmi_bl_style."'>". __('Acurax ecommerce Website Design Company','floating-social-media-icon')."</a>";
			}
			// Ending Crediting
			echo "</div>";
		} 
	}
} add_action('wp_footer', 'pbl_footer'); // pbl_footer
function extra_style_acx_icon() // updated added class acx_fsmi_float_fix support
{
	global $acx_si_icon_size, $acx_si_fsmi_float_fix, $acx_si_display, $acx_si_fsmi_disable_mobile;
	if($acx_si_fsmi_disable_mobile == "") { $acx_si_fsmi_disable_mobile = "no"; }
		echo "\n\n\n<!-- Starting Styles For Social Media Icon From Acurax International www.acurax.com -->\n<style type='text/css'>\n";
		echo "#divBottomRight img \n{\n";
		echo "width: " . $acx_si_icon_size . "px; \n}\n";
		
			if ($acx_si_display == "manual") 
			{
				echo "#divBottomRight \n{\n";
				echo "min-width:0px; \n";
				echo "position: static; \n}\n";
			}
			if ($acx_si_fsmi_float_fix == "yes") 
			{
				echo ".acx_fsmi_float_fix a \n{\n";
				echo "display:inline-block; \n}\n";
			}
			if($acx_si_fsmi_disable_mobile == "yes")
			{
				echo "@media only screen and (max-width:650px) \n{\n#divBottomRight \n{\n";
				echo "display:none !important; \n}\n}\n";
			}
			
		echo "</style>\n<!-- Ending Styles For Social Media Icon From Acurax International www.acurax.com -->\n\n\n\n";
}	add_action('admin_head', 'extra_style_acx_icon'); // ADMIN
	add_action('wp_head', 'extra_style_acx_icon'); // PUBLIC 

	$acx_si_display = get_option('acx_si_display');
if	($acx_si_display == "auto" || $acx_si_display == "both") 
{
	add_action('wp_footer', 'acurax_icons',100);
}
$acx_si_sc_id = 0; // Defined to assign shortcode unique id
function DISPLAY_ACURAX_ICONS_SC($atts)
{
	global $acx_si_display, $acx_si_icon_size, $acx_si_sc_id, $acx_fsmi_themes_array;
	extract(shortcode_atts(array(
	"theme" => '',
	"size" => $acx_si_icon_size,
	"align" => 'center'
	), $atts));
	if($align == "center")
	{
	$align = "center";
	} else if($align == "left")
	{
	$align = "left";
	} else if($align == "right")
	{
	$align = "right";
	} else
	{
	$align = "center";
	}
	if (!is_numeric($theme)) { $theme = ""; } else {
	if ($theme > count($acx_fsmi_themes_array)) { $theme = ""; }
	}
	if (!is_numeric($size)) { $size = $acx_si_icon_size; } else {
	if ($size > 55) { $size = $acx_si_icon_size; }
	}
	if ($acx_si_display != "auto" || $acx_si_display == "both") 
	{
		$acx_si_sc_id = $acx_si_sc_id + 1;
		ob_start();
		echo "<style>\n";
		echo "#short_code_si_icon img \n {";
		echo "width:" . $size . "px; \n}\n";
		echo ".scid-" . $acx_si_sc_id . " img \n{\n";
		echo "width:" . $size . "px !important; \n}\n";
		echo "</style>";
		echo "<div id='short_code_si_icon' style='text-align:".$align.";' class='acx_fsmi_float_fix scid-" . $acx_si_sc_id . "'>"; // updated
		$acx_to_pass_array = array(
		'theme' => $theme,
		'size'  => $size,
		'align'  => $align
		);
		echo  acurax_si_simple($acx_to_pass_array);
		echo "</div>";
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	} 
	else echo "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
} // DISPLAY_ACURAX_ICONS_SC
//DISPLAY_ACURAX_ICONS();
function DISPLAY_ACURAX_ICONS($theme="",$size="",$align="",$function="",$animation="",$opacity="")
{
	$acx_html = '';
	global $acx_si_display, $acx_si_icon_size,$acx_fsmi_themes_array;

	if($align == "center")
	{
	$align = "center";
	} else if($align == "left")
	{
	$align = "left";
	} else if($align == "right")
	{
	$align = "right";
	} else
	{
	$align = "center";
	}
	if (!is_numeric($theme)) { $theme = ""; } else {
	if ($theme > count($acx_fsmi_themes_array)) { $theme = ""; }
	}
	if (!is_numeric($size)) { $size = $acx_si_icon_size; } else {
	if ($size > 55) { $size = $acx_si_icon_size; }
	}
		$acx_to_pass_array = array(
		'theme' => $theme,
		'size'  => $size,
		'align' => $align,
		'function' => $function,
		'animation' => $animation,
		'opacity' => $opacity
		);
	if ($acx_si_display != "auto" || $acx_si_display == "both") 
	{
		$acx_html .= "\n\n\n<!-- Starting Styles For Social Media Icon (PHP CODE) From Acurax International www.acurax.com 
		-->\n<style 
		type='text/css'>\n";
		$acx_html .= "#short_code_si_icon img \n{\n";
		$acx_html .= "width: " . $size . "px; \n}\n";
		$acx_html .= "</style>\n<!-- Ending Styles For Social Media Icon (PHP CODE) From Acurax International www.acurax.com 
		-->\n\n\n\n";
		$acx_html .= "<div id='short_code_si_icon' style='text-align:".$align.";'>";
		$acx_html .= acurax_si_simple($acx_to_pass_array);
		$acx_html .= "</div>";
	}
	else $acx_html .= "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
	
	$acx_html = apply_filters('acx_fsmip_display_icons_php',$acx_to_pass_array,$acx_html);
echo $acx_html;
	
} // DISPLAY_ACURAX_ICONS
function filter_acx_fsmip_display_icons($acx_to_pass_array,$acx_html)
{
	return $acx_html;
}
 add_filter('acx_fsmip_display_icons_php','filter_acx_fsmip_display_icons',100,2);
		
function acx_not_auto()
{
	echo "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
}
if	($acx_si_display != "auto" || $acx_si_display == "both") 
{
	add_shortcode( 'DISPLAY_ACURAX_ICONS', 'DISPLAY_ACURAX_ICONS_SC' ); // Defining Shortcode to show Social Media Icon
}
else
{
	add_shortcode( 'DISPLAY_ACURAX_ICONS', 'acx_not_auto' ); // Defining Shortcode to show Select Manual
}    

// wp-admin Notices >> Finish Upgrade
//-- **************** CODE TO FIND PAGE STARTS HERE ********************************
if(ISSET($_GET['page']))
{
$acx_si_current_page = $_GET['page'];
} else
{
$acx_si_current_page = "";
}
//-- **************** CODE TO FIND PAGE ENDS HERE***********************************
$total_arrays = ACX_FSMI_TOTAL_STATIC_SERVICES; // Number Of Services
$social_icon_array_order = get_option('social_icon_array_order');
if(is_serialized($social_icon_array_order))
{
	$social_icon_array_order = unserialize($social_icon_array_order);
}

$social_icon_array_count = count($social_icon_array_order); 
if ($social_icon_array_count < $total_arrays) 
{
	do_action('acx_fsmi_array_refresh');
}
$acx_fsmi_si_current_version = get_option('acx_fsmi_si_current_version');
if($acx_fsmi_si_current_version != ACX_FSMI_C_VERSION) // Current Version
{
	$acx_fsmi_si_current_version = ACX_FSMI_C_VERSION;  // Current Version
	update_option('acx_fsmi_si_current_version', $acx_fsmi_si_current_version);
}
// wp-admin Notices >> Plugin not configured
function acx_si_pluign_not_configured()
{
    echo '<div class="updated">
	<p><b>'. __('Congratulations!, You Have Successfully Installed Floating Social Media Icon, The Plugin Is Not Configured - ','floating-social-media-icon').'<a href="admin.php?page=Acurax-Social-Icons-Settings">'. __('Click Here to Configure','floating-social-media-icon').'</a></b></p></div>';
}
if ($social_icon_array_count == $total_arrays) 
{
	if ($acx_si_twitter == "" && $acx_si_facebook == "" && $acx_si_youtube == "" && $acx_si_linkedin == ""  && $acx_si_pinterest == "" && $acx_si_gplus == "" && $acx_si_feed == "" && $acx_si_instagram == "")
	{
		if($acx_si_current_page != "Acurax-Social-Icons-Settings")
		{
		add_action('admin_notices', 'acx_si_pluign_not_configured',1);
		}
	} // Chking If Plugin Not Configured
} // Chking $social_icon_array_count == $total_arrays
// wp-admin Notices >> Plugin not configured
function acx_si_pluign_promotion()
{
$acx_tweet_text_array = array
						(
						__("I Use Floating SocialMedia wordpress plugin from @acuraxdotcom and you should too","floating-social-media-icon"),
						__("Floating Social Media wordpress Plugin from @acuraxdotcom is Awesome","floating-social-media-icon"),
						__("Thanks @acuraxdotcom for developing such a wonderful social media wordpress plugin","floating-social-media-icon"),
						__("Actually i am looking for a social media Plugin like this. Thanks @acuraxdotcom","floating-social-media-icon"),
						__("Its very nice to use Floating Social media wordpress Plugin from @acuraxdotcom","floating-social-media-icon"),
						__("I installed Floating Social Media.. from @acuraxdotcom,  It works wonderful","floating-social-media-icon"),
						__("The floating social media icon wordpress plugin looks soo nice.. thanks @acuraxdotcom", "floating-social-media-icon"),
						__("It awesome to use Floating Social Media wordpress plugin from @acuraxdotcom","floating-social-media-icon"),
						__("Floating Social Media wordpress Plugin that i use Looks awesome and works terrific","floating-social-media-icon"),
						__("I am using Floating Social Media Icon wordpress Plugin from @acuraxdotcom I like it!","floating-social-media-icon"),
						__("The socialmedia plugin from @acuraxdotcom Its simple looks good and works fine","floating-social-media-icon"),
						__("Ive been using this social media plugin for a while now and it is attractive","floating-social-media-icon"),
						__("Floating Social Media Icon wordpress plugin is Fantastic Plugin","floating-social-media-icon"),
						__("Floating Social Media Icon wordpress plugin was easy to use and works great. thank you!","floating-social-media-icon"),
						__("Good and flexible wp socialmedia plugin especially for beginners.","floating-social-media-icon"),
						__("Easily the best socialmedia wordpress plugin of the type I have used ! THANKS! @acuraxdotcom","floating-social-media-icon")
						);
$acx_tweet_text = array_rand($acx_tweet_text_array, 1);
$acx_tweet_text = $acx_tweet_text_array[$acx_tweet_text];

$acx_si_installed_date = get_option('acx_si_installed_date');
if ($acx_si_installed_date=="") { $acx_si_installed_date = time();}
$acx_fsmi_next_date = get_option('acx_fsmi_next_date');
$acx_fsmi_days_till_today_from_install = time()-$acx_si_installed_date;
$acx_fsmi_days_till_today_from_install = round(($acx_fsmi_days_till_today_from_install/60/60/24))." Days";

global $current_user;
//get_currentuserinfo();
wp_get_current_user();
$acx_fsmi_current_user = $current_user->display_name;
if($acx_fsmi_current_user == "")
{
$acx_fsmi_current_user = "Webmaster";
}

    echo '<div id="acx_td_fsmi" class="notice">'. __("Hey","floating-social-media-icon").' <b>'.$acx_fsmi_current_user.'</b>'. __(", Do you know? You were using Floating Social Media Icon Wordpress Plugin for the last","floating-social-media-icon").' <b>'.$acx_fsmi_days_till_today_from_install.'</b>'. __(", We are sure, your visitors loved the flying icons.","floating-social-media-icon").'<br>'. __("From the bottom of our heart, we the team @ ","floating-social-media-icon").'<a href="http://www.acurax.com/?utm_source=fsmi&utm_campaign=days" style="font-weight: normal; margin-left: 0px; color: rgb(68, 68, 68);" target="_blank">'. __("Acurax Technologies","floating-social-media-icon").'</a>'. __(" thank you for being with us, and we appreciate your feedback,reviews and support.","floating-social-media-icon").'<br><a href="https://wordpress.org/support/view/plugin-reviews/floating-social-media-icon?filter=5" target="_blank">'. __("Rate 5★'s on wordpress","floating-social-media-icon").'</a><a href="https://twitter.com/share?url=http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/&text='.$acx_tweet_text.' -" target="_blank">'. __("Tell Your Followers","floating-social-media-icon").'</a><a href="admin.php?page=Acurax-Social-Icons-Premium">'. __("Premium Version Benefits","floating-social-media-icon").'</a><a href="admin.php?page=Acurax-Social-Icons-Premium&td=hide">'. __("Hide for Now","floating-social-media-icon").'</a></div>';
}
$acx_si_installed_date = get_option('acx_si_installed_date');
if ($acx_si_installed_date=="") { $acx_si_installed_date = time();}
$acx_fsmi_d = 30;
$acx_fsmi_prom = false;

if(get_option('acx_si_td') == "")
{
	$acx_fsmi_next_date = $acx_si_installed_date+((60*60*24)*$acx_fsmi_d);
	update_option('acx_fsmi_next_date', $acx_fsmi_next_date);
	update_option('acx_si_td', "show");
}
$acx_fsmi_next_date = get_option('acx_fsmi_next_date');

if(time() > $acx_fsmi_next_date)
{
	$acx_fsmi_prom = true;
}
if ($acx_fsmi_prom == true && get_option('acx_si_td') == "show")
{
	add_action('admin_notices', 'acx_si_pluign_promotion',1);
}

// Starting Widget Code
class Acx_Social_Icons_Widget extends WP_Widget
{
    // Register the widget
	function __construct() 
	{
        // Set some widget options
        $widget_options = array( 
		'description' => __('Allow users to show Social Media Icons From Floating Social Media Icon Plugin','floating-social-media-icon'),
		'classname' => 'acx-fsmi-social-icons-desc' );
        // Set some control options (width, height etc)
        $control_options = array( 'width' => 300 );
        // Actually create the widget (widget id, widget name, options...)
         parent::__construct( 'acx-social-icons-widget', 'Acurax Social Icons', $widget_options, $control_options );
    }
    // Output the content of the widget
    function widget($args, $instance) 
	{
        extract( $args ); // Don't worry about this
        // Get our variables
        $title = apply_filters( 'widget_title', $instance['title'] );
		$icon_size = $instance['icon_size'];
		$icon_theme = $instance['icon_theme'];
		$icon_align = $instance['icon_align'];
        // This is defined when you register a sidebar
        echo $before_widget;
        // If our title isn't empty then show it
        if ( $title ) 
		{
            echo $before_title . $title . $after_title;
        }
		
		do_action('acx_fsmi_add_icon_customize_style',$instance,$this->get_field_id('widget'));
		echo "<style>\n";
		echo "." . $this->get_field_id('widget') . " img \n{\n";
		echo "width:" . $icon_size . "px; \n } \n";
		echo "</style>";
		echo "<div id='acurax_si_simple' class='acx_fsmi_float_fix " . $this->get_field_id('widget') . "'"; // updated
		if($icon_align != "") { echo " style='text-align:" . $icon_align . ";'>"; } else { echo " style='text-align:center;'>"; }
			 $acx_to_pass_array = array(
		'theme' => $icon_theme,
		'size'  => $icon_size,
		'align'  => $icon_align
		);
		echo acurax_si_simple($acx_to_pass_array);
		echo "</div>";
        // This is defined when you register a sidebar
        echo $after_widget;
    }
	// Output the admin options form
	function form($instance) 
	{
		global $acx_fsmi_themes_array;
		// These are our default values
		$defaults = array( 
		'title' => __('Social Media Icons','floating-social-media-icon'),
		'icon_size' => '32' );
		// This overwrites any default values with saved values
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:' ,'floating-social-media-icon'); ?></label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
				value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Size:' ,'floating-social-media-icon'); ?></label>
<select class="widefat" name="<?php echo $this->get_field_name('icon_size'); ?>" id="<?php echo $this->get_field_id('icon_size'); ?>">
<option value="16" <?php if ($instance['icon_size'] == "16") { echo 'selected="selected"'; } ?>>16<?php _e('px','floating-social-media-icon'); ?> X 16<?php _e('px','floating-social-media-icon'); ?> </option>
<option value="25" <?php if ($instance['icon_size'] == "25") { echo 'selected="selected"'; } ?>>25<?php _e('px','floating-social-media-icon'); ?> X 25<?php _e('px','floating-social-media-icon'); ?> </option>
<option value="32" <?php if ($instance['icon_size'] == "32") { echo 'selected="selected"'; } ?>>32<?php _e('px','floating-social-media-icon'); ?> X 32<?php _e('px','floating-social-media-icon'); ?> </option>
<option value="40" <?php if ($instance['icon_size'] == "40") { echo 'selected="selected"'; } ?>>40<?php _e('px','floating-social-media-icon'); ?> X 40<?php _e('px','floating-social-media-icon'); ?> </option>
<option value="48" <?php if ($instance['icon_size'] == "48") { echo 'selected="selected"'; } ?>>48<?php _e('px','floating-social-media-icon'); ?> X 48<?php _e('px','floating-social-media-icon'); ?> </option>
<option value="55" <?php if ($instance['icon_size'] == "55") { echo 'selected="selected"'; } ?>>55<?php _e('px','floating-social-media-icon'); ?> X 55<?php _e('px','floating-social-media-icon'); ?> </option>
</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_theme'); ?>"><?php _e('Icon Theme:' ,'floating-social-media-icon'); ?></label>
<select class="widefat" name="<?php echo $this->get_field_name('icon_theme'); ?>" id="<?php echo $this->get_field_id('icon_theme'); ?>">
<option value="" <?php if(!ISSET($instance['icon_theme'])) { echo 'selected="selected"'; } ?>><?php _e('Default Theme Design' ,'floating-social-media-icon');?></option>
<?php
foreach($acx_fsmi_themes_array as $k => $v)
{ 
	$k = $k+1 ;

?>
<option value="<?php echo $k; ?>" <?php if(ISSET($instance['icon_theme'])){if($instance['icon_theme'] == $k) { echo 'selected="selected"'; } }?>><?php _e('Theme Design' ,'floating-social-media-icon'); ?> <?php echo $k; ?> </option>
<?php
}	?>
</select>
			</p>
<p>
	<label for="<?php echo $this->get_field_id('icon_align'); ?>"><?php _e('Icon Align:' ,'floating-social-media-icon'); ?></label>
	<select class="widefat" name="<?php echo $this->get_field_name('icon_align'); ?>" id="<?php echo $this->get_field_id('icon_align'); ?>">
	<option value="" <?php if(!ISSET($instance['icon_align'])) { echo 'selected="selected"'; } ?>><?php _e('Default','floating-social-media-icon') ;?> </option>
	<option value="left" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "left") { echo 'selected="selected"'; }} ?>><?php _e('Left','floating-social-media-icon') ;?> </option>
	<option value="center" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "center") { echo 'selected="selected"'; }} ?>><?php _e('Center' ,'floating-social-media-icon') ;?> </option>
	<option value="right" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "right") { echo 'selected="selected"';} } ?>><?php _e('Right','floating-social-media-icon') ;?>  </option>
	</select>
</p>
		<?php
	}
	// Processes the admin options form when saved
	function update($new_instance, $old_instance) 
	{
		// Get the old values
		$instance = $old_instance;
		// Update with any new values (and sanitise input)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_theme'] = strip_tags( $new_instance['icon_theme'] );
		$instance['icon_align'] = strip_tags( $new_instance['icon_align'] );
		return $instance;
	}
} add_action('widgets_init', create_function('', 'return register_widget("Acx_Social_Icons_Widget");'));
// Ending Widget Codes 
function socialicons_comparison($ad=2)
{
$ad_1 = '
</hr>
<a name="compare"></a><div id="ss_middle_wrapper" style="margin-top:10px;"> 
		<div id="ss_middle_center"> 
			<div id="ss_middle_inline_block"> 
			
				<div class="middle_h2_1"> 
					<h2>'. __("Limited on Features ?","floating-social-media-icon").'</h2>
					<h3>'. __("Compare and Decide","floating-social-media-icon").'</h3>
				</div><!-- middle_h2_1 -->
				
				<div id="ss_features_table"> 
				
					<div id="ss_table_header"> 
						<div class="tb_h1"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
							<div class="tb_h2"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h2 -->
							<div class="tb_h3"> <div class="ss_download"> </div><!-- ss_download --> </div><!-- tb_h3 -->
						<div class="tb_h4 fsmi_tb_h4"> <a href="http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=plugin_fsmi_settings_table&utm_medium=link&utm_campaign=compare_buynow" target="_blank"><div class="ss_buy_now"> </div><!-- ss_buy_now --></a> </div><!-- tb_h4 -->
					</div><!-- ss_table_header -->
						
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 197px;"> '. __("Display ","floating-social-media-icon").'</div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("More Sharp Quality Icons","floating-social-media-icon").'</li>
									<li>'. __("20+ Icon Theme/Style","floating-social-media-icon").'</li>
										<li>'. __("Can Choose Icon Theme/Style","floating-social-media-icon").'</li>
											<li>'. __("Can Choose Icon Size","floating-social-media-icon").'</li>
												<li>'. __("Automatic/Manual Integration","floating-social-media-icon").'</li>
													<li>'. __("Set MouseOver text for each icon in Share Mode","floating-social-media-icon").'</li>
												<li>'. __("Set MouseOver text for each icon in Profile Link Mode","floating-social-media-icon").'</li>
											<li>'. __("Option to HIDE Invididual Share Icon","floating-social-media-icon").'</li>
											<li>'. __("Option to hide icon on mobile devices","floating-social-media-icon").'</li>
											<li>'. __("Option to hide icon on specific pages/post","floating-social-media-icon").'</li>
											<li>'. __("Option to set icon size for mobile devices","floating-social-media-icon").'</li>
											<li>'. __("Align icons on phpcode or shortcode","floating-social-media-icon").'</li>
										<li><strong>'. __("Set Floating Icons in Vertical","floating-social-media-icon").'</strong></li>
									<li><strong>'. __("Define how many icons in 1 row","floating-social-media-icon").'</strong></li>
									<li><strong><strong>'. __("Add Unlimited # of Custom Icons","floating-social-media-icon").'</strong></strong></li>
								<li class="ss_last_one"><strong>'. __("Custom Icons Can Link to Your Website Pages","floating-social-media-icon").'</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE ","floating-social-media-icon").'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_no"> </div><!-- ss_no -->
											<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_yes"> </div><!-- ss_yes -->										
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->
					
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;">'. __(" Icon Function","floating-social-media-icon").' </div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Link to Social Media Profile","floating-social-media-icon").'</li>
								<li><strong>'. __("Share On Social Media","floating-social-media-icon").'</strong></li>
								<li>'. __("Option to add twitter username and hashtags to tweets","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Option to Define Tweet Prefix and Suffix","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE","floating-social-media-icon").' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> '. __("Animation","floating-social-media-icon").' </div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Fly Animation</li>
								<li class="ss_last_one"><strong>'. __("Mouse Over Effects","floating-social-media-icon").'</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE ","floating-social-media-icon").'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 84px;"> '. __("Fly Animation Repeat Interval","floating-social-media-icon").'</div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Based On Time in Seconds","floating-social-media-icon").'</li>
									<li><strong>'. __("Based On Time in Minutes","floating-social-media-icon").'</strong></li>
										<li>'. __("Based On Time in Hours","floating-social-media-icon").'</li>
									<li>'. __("Based on Page Views","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Based On Page Views and Time","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE ","floating-social-media-icon").'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> '. __("Multiple Fly Animation","floating-social-media-icon").'<br/></div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Can Choose Fly Start Position","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Can Choose Fly End Position","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE","floating-social-media-icon").' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->				

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 52px;">'.__("Easy to Configure","floating-social-media-icon").'</div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Ajax Based Settings Page","floating-social-media-icon").'</li>
									<li>'. __("Drag & Drop Reorder Icons","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Easy to Configure","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE","floating-social-media-icon").' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">'. __("Widget Support","floating-social-media-icon").' </div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Multiple Widgets","floating-social-media-icon").'</li>
									<li>'. __("Separate Icon Style/Theme For Each","floating-social-media-icon").'</li>
										<li>'. __("Separate Icon Size For Each","floating-social-media-icon").'</li>
										<li>'. __("Set whether the icons to Link Profiles/SHARE","floating-social-media-icon").'</li>
									<li><strong>'. __("Separate Mouse Over Multiple Animation for Each","floating-social-media-icon").'</strong></li>
								<li class="ss_last_one">'. __("Separate Default Opacity for Each","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE ","floating-social-media-icon").'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">'. __("Shortcode Support ","floating-social-media-icon").'</div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Multiple Instances","floating-social-media-icon").'</li>
									<li>'. __("Separate Icon Style/Theme For Each","floating-social-media-icon").'</li>
										<li><strong>'. __("Separate Icon Size For Each","floating-social-media-icon").'</strong></li>
										<li>'. __("Set whether the icons to Link Profiles/SHARE","floating-social-media-icon").'</li>
									<li>'. __("Separate Mouse Over Multiple Animation for Each","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Separate Default Opacity for Each","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE ","floating-social-media-icon").'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'.__("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>'. __("Feature Group","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 126px;">'. __("PHP Code Support","floating-social-media-icon").' </div><!-- -->
						<div class="tb_h1 mini"> <h3>'. __("Features","floating-social-media-icon").'</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>'. __("Multiple Instances","floating-social-media-icon").'</li>
									<li>'. __("Use Outside Loop","floating-social-media-icon").'</li>
										<li>'. __("Separate Icon Style/Theme For Each","floating-social-media-icon").'</li>
											<li>'. __("Separate Icon Size For Each","floating-social-media-icon").'</li>
										<li><strong>'. __("Set whether the icons to Link Profiles/SHARE","floating-social-media-icon").'</strong></li>
									<li>'. __("Separate Mouse Over Multiple Animation for Each","floating-social-media-icon").'</li>
								<li class="ss_last_one">'. __("Separate Default Opacity for Each","floating-social-media-icon").'</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>'. __("FREE","floating-social-media-icon").' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">'. __("PREMIUM","floating-social-media-icon").'</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->						
				</div><!-- ss_features_table -->		

			<div id="ad_fsmi_2_button_order" style="float: left; width: 100%;">
<a href="http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --></div></div></div>';
$ad_2='<div id="ad_fsmi_2"> <a href="http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_enjoy" target="_blank"><div id="ad_fsmi_2_button"></div></a> </div> <!-- ad_fsmi_2 --><br>
<div id="ad_fsmi_2_button_order">
<a http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --> ';
if($ad=="" || $ad == 2) { echo $ad_2; } else if ($ad == 1) { echo $ad_1; } else { echo $ad_2; } 
} // Updated
add_action('acx_fsmi_comparison_premium','socialicons_comparison',1);

function acx_fsmi_saveorder_callback()
{
	if(!isset($_POST['acx_fsmi_saveorder_es'])) die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if(!wp_verify_nonce($_POST['acx_fsmi_saveorder_es'],'acx_fsmi_saveorder_es')) die("<br><br>".__('Sorry, You have no permission to do this action...','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	global $wpdb;
	$social_icon_array_order = $_POST['recordsArray'];
	if (current_user_can('manage_options')) {
	if(!is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = serialize($social_icon_array_order);
	}
	update_option('social_icon_array_order', $social_icon_array_order);
	echo "<div id='acurax_notice' align='center' style='width: 420px; font-family: arial; font-weight: normal; font-size: 22px;'>";
	_e("Social Media Icon's Order Saved","floating-social-media-icon");
	echo "</div><script type='text/javascript'>
		 setTimeout(function(){
				jQuery('#acurax_notice').fadeOut('slow');
				
				}, 4000);

		</script><br>";
}
	die(); // this is required to return a proper result
} add_action('wp_ajax_acx_fsmi_saveorder', 'acx_fsmi_saveorder_callback');
// refresh 
function acx_fsmi_install_licence_refresh_callback()
{
	if (!isset($_POST['acx_fsmi_install_licence_refresh_w_c_n'])) die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	if (!wp_verify_nonce($_POST['acx_fsmi_install_licence_refresh_w_c_n'],'acx_fsmi_install_licence_refresh_w_c_n')) die("<br><br>".__('Unknown Error Occurred, Try Again... ','floating-social-media-icon')."<a href=''>".__('Click Here','floating-social-media-icon')."</a>");
	
	$key = $licence = $id = "";
	$response_stat = "failed";
	if(ISSET($_POST['key']))
	{
		$key = $_POST['key'];
	}
	if(ISSET($_POST['licence']))
	{
		$licence = $_POST['licence'];
	}
	if(function_exists('check_acx_pfsmi_license') && !function_exists('acx_check_fsmip_offline_license'))
	{
		$result = check_acx_pfsmi_license($licence,'',true,$id);
	} else
	{
		$result = array();
	}
	if(ISSET($result["localkey"]))
	{
		$local_key = $result["localkey"];
	}
	else{
		$local_key = "";
	}
	$acx_fsmip_licence_array = get_option('acx_fsmip_licence_array');
	if(is_serialized($acx_fsmip_licence_array))
	{
		$acx_fsmip_licence_array = unserialize($acx_fsmip_licence_array);
	}
	if($acx_fsmip_licence_array == "" || !is_array($acx_fsmip_licence_array))
	{
		$acx_fsmip_licence_array = array();
	}
	$acx_fsmi_purchased_li_array = get_option('acx_fsmi_purchased_li_array');
	if(is_serialized($acx_fsmi_purchased_li_array))
	{
		$acx_fsmi_purchased_li_array = unserialize($acx_fsmi_purchased_li_array);
	}
	if($acx_fsmi_purchased_li_array == "" || !is_array($acx_fsmi_purchased_li_array))
	{
		$acx_fsmi_purchased_li_array = array();
	}
	if(ISSET($result["status"]))
	{
		if($result["status"] == 'Active')
		{
			if(ISSET($acx_fsmip_licence_array[$key]))
			{
				if($local_key != "")
				{
					$acx_fsmip_licence_array[$key]['local_key'] = $local_key;
					
					if(!is_serialized($acx_fsmip_licence_array))
					{
						$acx_fsmip_licence_array = serialize($acx_fsmip_licence_array);
					}
					update_option('acx_fsmip_licence_array',$acx_fsmip_licence_array);
					
				}
			}
			
		} 
		$acx_fsmi_purchased_li_array[$licence]['status'] = $result['status'];
		if(!is_serialized($acx_fsmi_purchased_li_array))
		{
			$acx_fsmi_purchased_li_array = serialize($acx_fsmi_purchased_li_array);
		}
		update_option('acx_fsmi_purchased_li_array',$acx_fsmi_purchased_li_array); 
		$response_stat = "success";
	}
	echo $response_stat;
	die();
}
add_action("wp_ajax_acx_fsmi_install_licence_refresh","acx_fsmi_install_licence_refresh_callback");
function acx_fsmi_license_refresh_with_forcing($acx_license,$addon_key)
{
	$acx_fsmi_ip =  isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
	$acx_fsmi_domain = $_SERVER['SERVER_NAME'];
	$acx_fsmi_directory = dirname(__FILE__);
	$acx_fsmi_args = array(
		'action' 	=> 'acx-li-check-latest-version',
		'method'	=> 'addon_activation',
		'directory' => $acx_fsmi_directory,
		'unique_id' => $addon_key,
		'domain' 	=> $acx_fsmi_domain,
		'ip' 		=> $acx_fsmi_ip,
		'licence' 	=> $acx_license
	);
	$acx_fsmi_unique_id = "";
	$response_stat = "failed";
	$acx_fsmip_licence_array = get_option('acx_fsmip_licence_array');
	if(is_serialized($acx_fsmip_licence_array))
	{
		$acx_fsmip_licence_array = unserialize($acx_fsmip_licence_array);
	}
	if($acx_fsmip_licence_array == "" || !is_array($acx_fsmip_licence_array))
	{
		$acx_fsmip_licence_array = array();
	}
		$acx_fsmip_retry_array = get_option('acx_fsmip_retry_array');
	if(is_serialized($acx_fsmip_retry_array))
	{
		$acx_fsmip_retry_array = unserialize($acx_fsmip_retry_array);
	}
	if($acx_fsmip_retry_array == "")
	{
		$acx_fsmip_retry_array = array();
	}
	if(!is_array($acx_fsmip_retry_array))
	{
		$acx_fsmip_retry_array = array();
	}
	if(ISSET($acx_fsmip_retry_array[$acx_license]['activation_licence_check']))
	{
		if($acx_fsmip_retry_array[$acx_license]['activation_licence_check'] >= 3)
		{
			$retry = false;	
		}
	}
	if($retry == true)
	{
		$response = acx_fsmi_licence_activation_api_request( $acx_fsmi_args );
		$response = json_decode($response, true);
	}
	
	if(!ISSET($response['response_status']) && !ISSET($response['status']))
	{
		if(ISSET($acx_fsmip_retry_array[$acx_license]['activation_licence_check']))
		{
			$acx_fsmip_retry_array[$acx_license]['activation_licence_check'] = $acx_fsmip_retry_array[$acx_license]['activation_licence_check'] + 1;
		}
		else{
			$acx_fsmip_retry_array[$acx_license]['activation_licence_check'] =  1;
		}
	}
	else
	{
		if($response['response_status'] == "success" &&  $response['status'] == "Active")
		{
			$acx_fsmi_purchased_li_array = get_option('acx_fsmi_purchased_li_array');
			if(is_serialized($acx_fsmi_purchased_li_array))
			{
				$acx_fsmi_purchased_li_array = unserialize($acx_fsmi_purchased_li_array);
			}
			if($acx_fsmi_purchased_li_array == "" || !is_array($acx_fsmi_purchased_li_array))
			{
				$acx_fsmi_purchased_li_array = array();
			}
			$acx_fsmi_unique_id = trim($response['unique_id']);
			$acx_fsmi_purchased_li_array[$acx_license] = array(
			'slug' => $response['slug'],
			'status' => $response['status'],
			'download_dynamic_url' => $response['download_dynamic_url']
			); 
			// update licence array
			
			$acx_fsmip_licence_array[$acx_fsmi_unique_id]['addon_name'] = $response['name'];
			$acx_fsmip_licence_array[$acx_fsmi_unique_id]['licence_code'] = $acx_license;
			if($response['localkey'] != "")
			{
				$acx_fsmip_licence_array[$acx_fsmi_unique_id]['local_key'] = $response['localkey'];
			}
			if(!is_serialized($acx_fsmip_licence_array))
			{
				$acx_fsmip_licence_array = serialize($acx_fsmip_licence_array);
			}
			update_option('acx_fsmip_licence_array',$acx_fsmip_licence_array); 
			if(!is_serialized($acx_fsmi_purchased_li_array))
			{
				$acx_fsmi_purchased_li_array = serialize($acx_fsmi_purchased_li_array);
			}
			update_option('acx_fsmi_purchased_li_array',$acx_fsmi_purchased_li_array); 
			$acx_fsmip_retry_array[$acx_license]['activation_licence_check'] =  0;
			if(!is_serialized($acx_fsmip_retry_array))
			{
				$acx_fsmip_retry_array = serialize($acx_fsmip_retry_array);
			}
			update_option('acx_fsmip_retry_array',$acx_fsmip_retry_array);
			$response_stat = $response['response_status'];
		}
	}

	return $response_stat;
}
function acx_fsmi_load_plugin_textdomain() {
    load_plugin_textdomain( 'floating-social-media-icon', FALSE, basename( dirname( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'acx_fsmi_load_plugin_textdomain' );
?>