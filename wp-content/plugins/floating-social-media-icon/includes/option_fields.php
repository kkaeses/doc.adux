<?php
/********************** ICON SETTINGS PAGE ******************************/
/* 	Premium Info HTML - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_premium_advert_above_form()
{
 global $acx_si_fsmi_hide_advert,$acx_si_credit;
if($acx_si_fsmi_hide_advert == "no")
{
	echo "<span class='acx_fsmi_q_sep'></span>";
?>
<div id="acx_fsmi_premium">
<a style="margin: 10px 0px 0px 10px; font-weight: bold; font-size: 14px; display: block;" href="http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=fully-featured&utm_medium=fsmi&utm_campaign=plugin" target="_blank"><?php _e('Fully Featured - Premium Floating Social Media Icon is Available With Tons of Extra Features! - Click Here','floating-social-media-icon'); ?></a>
</div> <!-- acx_fsmi_premium -->
<?php } ?>
<h2 style="width: 100%; font-size: 2px; padding: 0px; line-height: 0px; color: white;">.</h2>
<?php
if($acx_si_credit != "yes")
{	
echo "<span class='acx_fsmi_q_sep'></span>";?>
<div id='acx_backlink' align='center'>
<?php _e('Please do a favour by enabling back-link to our site. ','floating-social-media-icon'); ?><a href="admin.php?page=Acurax-Social-Icons-Settings&backlink=enable"><?php _e('Okay, Enable.','floating-social-media-icon'); ?></a> 
</div>
<?php 
}	
	echo "<span class='acx_fsmi_q_sep'></span>";
}  add_action('acx_fsmi_hook_option_above_page_left','acx_fsmi_premium_advert_above_form',50);

/* 	Premium Info HTML - Save - Get - Set Default Logic Starts Here */
/* 	Current Theme HTML - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_current_icon_html()
{
	global $acx_si_theme , $acx_si_icon_size;
	$acx_string = __("Your Current Theme is","floating-social-media-icon");
	print_acx_fsmi_option_block_start($acx_string.' ' .$acx_si_theme);	
	 echo "<div class='image_div'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/twitter.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/facebook.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/googleplus.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/pinterest.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/youtube.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/linkedin.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/feed.png' style='height:
			".$acx_si_icon_size."px'>
			<img src='".ACX_FSMI_BASE_LOCATION."images/themes/".$acx_si_theme."/instagram.png' style='height:
			".$acx_si_icon_size."px'>
		</div>"; 
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_current_icon_html',100);
/* 	Current Theme Save - Get - Set Default Logic Ends Here */
/* 	Icon Theme Settings - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_icon_theme_settings_html()
{
	global $acx_si_theme,$social_icon_array_order,$acx_fsmi_themes_array;
	if(is_serialized($social_icon_array_order))
	{
	$social_icon_array_order = unserialize($social_icon_array_order);
	}
	$acx_string = __('Icon Theme Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
?>
<div id="acx_si_theme_display">
<?php

	foreach($acx_fsmi_themes_array as $k => $v)
	{ 
		$k = $k+1 ;
	?>
		<label class="acx_si_single_theme_display <?php if ($acx_si_theme == $k) { echo "selected"; } ?>" id="icon_selection">
		<div class="acx_si_single_label"><?php _e('Theme','floating-social-media-icon');?> <?php echo $k; ?><br><input type="radio" name="acx_si_theme" value="<?php echo $k; ?>"<?php if ($acx_si_theme == $k) { echo " checked"; } ?>></div>
		<div class="image_div">
			<?php
				foreach ($social_icon_array_order as $key => $value)
				{
					if ($value == 0) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/twitter.png'>"; 
					} 	else 
					if ($value == 1) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/facebook.png'>"; 
					}	else 
					if ($value == 2) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/googleplus.png'>"; 
					}	else
	 
					if ($value == 3) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/pinterest.png'>"; 
					}	else
					if ($value == 4) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/youtube.png'>"; 
					}	else 
					if ($value == 5) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/linkedin.png'>"; 
					}
					else
					if ($value == 6) 
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/feed.png'>"; 
					}
					else if($value == 7)
					{
						echo "<img src='".$v['path']."images/themes/". $k ."/instagram.png'>"; 
					}
				}
			?>			
		</div>
		</label>
	<?php
	}
	?>
</div> <!-- acx_si_theme_display -->
<?php
	echo "<span class='note'></span>";
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_icon_theme_settings_html',200);
function acx_fsmi_icon_theme_settings_ifpost()
{
	global $acx_si_theme;
	$acx_si_theme = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_theme'));
	if(!is_numeric($acx_si_theme))
	{
		$acx_si_theme = 1;
	}
	update_option('acx_si_theme', $acx_si_theme);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_icon_theme_settings_ifpost');
function acx_fsmi_icon_theme_settings_else()
{
	global $acx_si_theme,$social_icon_array_order;
	$acx_si_theme = get_option('acx_si_theme');
	$social_icon_array_order = get_option('social_icon_array_order');
	if(is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = unserialize($social_icon_array_order);
	}

} add_action('acx_fsmi_hook_option_postelse','acx_fsmi_icon_theme_settings_else');
function acx_fsmi_icon_theme_settings_after_else()
{
	global $acx_si_theme;
	if ($acx_si_theme == "") 
	{
		$acx_si_theme = "1";
	}
} add_action('acx_fsmi_hook_option_after_else','acx_fsmi_icon_theme_settings_after_else');
/* 	Icon Theme Settings Save - Get - Set Default Logic Ends Here */
/* 	Icon Theme Size - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_icon_theme_size_html()
{
	global $acx_si_icon_size;
	$acx_string = __('Icon Size Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
	?>
	<select name="acx_si_icon_size" style="width: 99.7%">
			<option value="16"<?php if ($acx_si_icon_size == "16") { echo 'selected="selected"'; } ?>>16<?php _e('px','floating-social-media-icon'); ?> X 16<?php _e('px','floating-social-media-icon'); ?> </option>
			<option value="25"<?php if ($acx_si_icon_size == "25") { echo 'selected="selected"'; } ?>>25<?php _e('px','floating-social-media-icon'); ?> X 25<?php _e('px','floating-social-media-icon'); ?> </option>
			<option value="32"<?php if ($acx_si_icon_size == "32") { echo 'selected="selected"'; } ?>>32<?php _e('px','floating-social-media-icon'); ?> X 32<?php _e('px','floating-social-media-icon'); ?> </option>
			<option value="40"<?php if ($acx_si_icon_size == "40") { echo 'selected="selected"'; } ?>>40<?php _e('px','floating-social-media-icon'); ?> X 40<?php _e('px','floating-social-media-icon'); ?> </option>
			<option value="48"<?php if ($acx_si_icon_size == "48") { echo 'selected="selected"'; } ?>>48<?php _e('px','floating-social-media-icon'); ?> X 48<?php _e('px','floating-social-media-icon'); ?> </option>
			<option value="55"<?php if ($acx_si_icon_size == "55") { echo 'selected="selected"'; } ?>>55<?php _e('px','floating-social-media-icon'); ?> X 55<?php _e('px','floating-social-media-icon'); ?> </option>
		</select>
<?php	
echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_icon_theme_size_html',300);
function acx_fsmi_icon_theme_size_ifpost()
{
	global $acx_si_icon_size;
	$acx_si_icon_size = acx_fsmi_post_isset_check('acx_si_icon_size');
	update_option('acx_si_icon_size', $acx_si_icon_size);
	
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_icon_theme_size_ifpost');
function acx_fsmi_icon_theme_size_else()
{
	global $acx_si_icon_size;
	$acx_si_icon_size = get_option('acx_si_icon_size');

} add_action('acx_fsmi_hook_option_postelse','acx_fsmi_icon_theme_size_else');
function acx_fsmi_icon_theme_size_after_else()
{
	global $acx_si_icon_size;
	if ($acx_si_icon_size == "") { $acx_si_icon_size = "32"; }

} add_action('acx_fsmi_hook_option_after_else','acx_fsmi_icon_theme_size_after_else');

/* Icon Theme Size Save - Get - Set Default Logic Ends Here */
/*	Icon Theme Order - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_icon_theme_order_html()
{
	global $acx_si_icon_size,$social_icon_array_order,$acx_si_theme;
	if(is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = unserialize($social_icon_array_order);
	}
	$acx_string = __("Social Media Icon Display Order - Drag and Drop to Reorder","floating-social-media-icon");
	print_acx_fsmi_option_block_start($acx_string);
	?>
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery(function() 
		{
			jQuery("#contentLeft ul").sortable(
			{ 
				opacity: 0.5, cursor: 'move', update: function() 
				{
					var order = jQuery(this).sortable("serialize") + '&action=acx_fsmi_saveorder'+'&acx_fsmi_saveorder_es=<?php echo wp_create_nonce("acx_fsmi_saveorder_es"); ?>'; 
					jQuery.post(ajaxurl, order, function(theResponse)
					{
						jQuery("#contentRight").html(theResponse);
					}); 															 
				}								  
			});
		});
	});	
	</script>
	<?php
	echo "<div class='acx_fsmi_admin_left_section_c'>
		<div id='contentLeft'>
			<ul>";
			foreach ($social_icon_array_order as $key => $value)
			{
				echo "<li id='recordsArray_$value'>";
				if ($value == 0) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/twitter.png' border='0'><br> Twitter"; 
				} 	else 
				if ($value == 1) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/facebook.png'  border='0'><br> Facebook"; 
				}	else 
				if ($value == 2) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/googleplus.png' border='0'><br> Google Plus"; 
				}	else
				 
				if ($value == 3) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/pinterest.png' border='0'><br> Pinterest"; 
				}	else
				if ($value == 4) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/youtube.png' border='0'><br> Youtube"; 
				}	else 
				if ($value == 5) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/linkedin.png' border='0'><br> Linkedin"; 
				}
				else
				if ($value == 6) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/feed.png' border='0'><br>  Rss Feed"; 
				}
				else
				if ($value == 7) 
				{
					echo "<img src='".ACX_FSMI_BASE_LOCATION."images/themes/". $acx_si_theme ."/instagram.png' border='0'><br>  Instagram"; 
				}
				echo "</li>	";
			}	
			echo "</ul>
		</div>
		<div id='contentRight'></div> <!-- contentRight -->";
 _e("Drag and Reorder Icons (It will automatically save on reorder)","floating-social-media-icon" ); 
echo "</div> <!-- acx_fsmi_admin_left_section_c -->";
	
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_icon_theme_order_html',400);

/* 	Icon Theme Order Save - Get - Set Default Logic Ends Here */
/* 	Social Media Configuration Save - Get  - Set Default Logic Starts Here */
function acx_fsmi_social_media_config_html()
{
	 $acx_string = __('Social Media Configuration','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
	do_action('acx_fsmi_icons_option_field');
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_social_media_config_html',500);
/* Social Media Icon Settings field Starts here */
function acx_fsmi_social_media_twitter_icon_field()
{
	global $acx_si_twitter;
	echo "<span class='label' style='width:50%;'>". __('Twitter Username:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_twitter'  style='width:49%;' value='".$acx_si_twitter."' placeholder='".__('eg: acuraxdotcom','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_twitter_icon_field',100);
function acx_fsmi_twitter_post_if()
{
	global $acx_si_twitter;
	$acx_si_twitter = acx_fsmi_post_isset_check('acx_si_twitter');
	update_option('acx_si_twitter', $acx_si_twitter);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_twitter_post_if');
function acx_fsmi_twitter_post_else()
{
	global $acx_si_twitter;
	$acx_si_twitter = get_option('acx_si_twitter');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_twitter_post_else');
function acx_fsmi_social_media_facebook_icon_field()
{
	global $acx_si_facebook;
	echo "<span class='acx_fsmi_q_sep'></span>";
	echo "<span class='label' style='width:50%;'>". __('Facebook Profile URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_facebook' style='width:49%;' value='".$acx_si_facebook."' placeholder='".__('eg: http://www.facebook.com/AcuraxInternational','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_facebook_icon_field',200);
function acx_fsmi_facebook_post_if()
{
	global $acx_si_facebook;
	$acx_si_facebook = acx_fsmi_post_isset_check('acx_si_facebook');
	if($acx_si_facebook != "")
	{
		if (substr($acx_si_facebook, 0, 4) != 'http') {
		$acx_si_facebook = 'http://' . $acx_si_facebook;
		} if($acx_si_facebook == "http://#") { $acx_si_facebook = "#"; }
	}	update_option('acx_si_facebook', $acx_si_facebook);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_facebook_post_if');

function acx_fsmi_facebook_post_else()
{
	global $acx_si_facebook;
	$acx_si_facebook = get_option('acx_si_facebook');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_facebook_post_else');
function acx_fsmi_social_media_gplus_icon_field()
{	global $acx_si_gplus;
	echo "<span class='label' style='width:50%;'> ". __('Google Plus URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_gplus' style='width:49%;' value='".esc_url($acx_si_gplus)."' placeholder='".__('Enter Your Complete Google Plus Url Starting With http://','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_gplus_icon_field',300);
function acx_fsmi_gplus_post_if()
{
	global $acx_si_gplus;
	$acx_si_gplus = esc_url_raw(acx_fsmi_post_isset_check('acx_si_gplus'));
	update_option('acx_si_gplus', $acx_si_gplus);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_gplus_post_if');
function acx_fsmi_gplus_post_else()
{
	global $acx_si_gplus;
	$acx_si_gplus = get_option('acx_si_gplus');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_gplus_post_else');
function acx_fsmi_social_media_pinterest_icon_field()
{ 	global $acx_si_pinterest;
	echo "<span class='label' style='width:50%;'> ". __('Pinterest URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_pinterest' style='width:49%;' value='".esc_url($acx_si_pinterest)."' placeholder='".__('Enter Your Complete Pinterest Url Starting With http://','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_pinterest_icon_field',400);
function acx_fsmi_pinterest_post_if()
{
	global $acx_si_pinterest;
	$acx_si_pinterest = esc_url_raw(acx_fsmi_post_isset_check('acx_si_pinterest'));
	update_option('acx_si_pinterest', $acx_si_pinterest);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_pinterest_post_if');
function acx_fsmi_pinterest_post_else()
{
	global $acx_si_pinterest;
	$acx_si_pinterest = get_option('acx_si_pinterest');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_pinterest_post_else');
function acx_fsmi_social_media_youtube_icon_field()
{
	global $acx_si_youtube;
	echo "<span class='label' style='width:50%;'>". __('Youtube URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_youtube' style='width:49%;' value='".esc_url($acx_si_youtube)."' placeholder='".__('http://www.youtube.com/user/acuraxdotcom','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_youtube_icon_field',500);
function acx_fsmi_youtube_post_if()
{
	global $acx_si_youtube;
	$acx_si_youtube = esc_url_raw(acx_fsmi_post_isset_check('acx_si_youtube'));
	update_option('acx_si_youtube', $acx_si_youtube);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_youtube_post_if');
function acx_fsmi_youtube_post_else()
{
	global $acx_si_youtube;
	$acx_si_youtube = get_option('acx_si_youtube');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_youtube_post_else');
function acx_fsmi_social_media_linkedin_icon_field()
{
	global $acx_si_linkedin;
	echo "<span class='label' style='width:50%;'>". __('Linkedin URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_linkedin' style='width:49%;' value='".esc_url($acx_si_linkedin)."' placeholder='".__('http://www.linkedin.com/company/acurax-international','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";	
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_linkedin_icon_field',600);
function acx_fsmi_linkedin_post_if()
{
	global $acx_si_linkedin;
		$acx_si_linkedin = esc_url_raw(acx_fsmi_post_isset_check('acx_si_linkedin'));
	update_option('acx_si_linkedin', $acx_si_linkedin);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_linkedin_post_if');
function acx_fsmi_linkedin_post_else()
{
	global $acx_si_linkedin;
	$acx_si_linkedin = get_option('acx_si_linkedin');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_linkedin_post_else');
function acx_fsmi_social_media_feed_field()
{
	global $acx_si_feed;
	echo "<span class='label' style='width:50%;'>". __('Feed URL:','floating-social-media-icon')."</span>";
	echo "<input type='text' name='acx_si_feed' style='width:49%;' value='".esc_url($acx_si_feed)."'  placeholder='".__('http://www.yourwebsite.com/feed','floating-social-media-icon')."'>";
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_feed_field',700);
function acx_fsmi_feed_post_if()
{
	global $acx_si_feed;
	$acx_si_feed = esc_url_raw(acx_fsmi_post_isset_check('acx_si_feed'));
	update_option('acx_si_feed', $acx_si_feed);
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_feed_post_if');
function acx_fsmi_feed_post_else()
{
	global $acx_si_feed;
	$acx_si_feed = get_option('acx_si_feed');
} 
add_action('acx_fsmi_hook_option_postelse','acx_fsmi_feed_post_else');

function acx_fsmi_social_media_insta_field()
{	
	global $acx_si_instagram;
	if (defined('ACX_FSMIP_VERSION') == false) {

		echo "<span class='label' style='width:50%;'>". __('Instagram URL:','floating-social-media-icon')."</span>";
		echo "<input type='text' name='acx_si_instagram' style='width:49%;' value='".esc_url($acx_si_instagram)."'  placeholder='".__('https://www.instagram.com/username','floating-social-media-icon')."'>";
		echo "<span class='acx_fsmi_q_sep'></span>";
	}
	else if( defined('ACX_FSMIP_VERSION') == true && ACX_FSMIP_VERSION >= "3.0")
	{ 
		echo "<span class='label' style='width:50%;'>". __('Instagram URL:','floating-social-media-icon')."</span>";
		echo "<input type='text' name='acx_si_instagram' style='width:49%;' value='".esc_url($acx_si_instagram)."'  placeholder='".__('https://www.instagram.com/username','floating-social-media-icon')."'>";
		echo "<span class='acx_fsmi_q_sep'></span>";
	}
	
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_social_media_insta_field',800);

function acx_fsmi_instagram_post_if()
{
	global $acx_si_instagram;
	$acx_si_instagram = esc_url_raw(acx_fsmi_post_isset_check('acx_si_instagram'));
	update_option('acx_si_instagram', $acx_si_instagram);
}add_action('acx_fsmi_hook_option_onpost','acx_fsmi_instagram_post_if');
function acx_fsmi_instagram_post_else()
{
	global $acx_si_instagram;
	$acx_si_instagram = get_option('acx_si_instagram');
}	add_action('acx_fsmi_hook_option_postelse','acx_fsmi_instagram_post_else'); 
function acx_fsmi_custom_icon_btn_field()
{
?><span class='button fsmi_info_premium fsmi_info_lb' lb_title='<?php _e('Adding Extra Icons Feature','floating-social-media-icon'); ?>' lb_content='<?php _e('Its possible to add any number of extra icons by uploading them and you can link them to anywhere you need.','floating-social-media-icon'); ?><br><br><?php _e('Lets say, you needs to have an icon which links to your contact page or services page, you can do that.','floating-social-media-icon'); ?><br><br><i><?php _e('This feature is only available in our premium version - ','floating-social-media-icon'); ?><a href="http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=extra-icon&utm_medium=fsmi&utm_campaign=plugin" target="_blank"><?php _e('Compare Features','floating-social-media-icon'); ?></a> / <a href="http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=fsmi&utm_campaign=premium-info" target="_blank"><?php _e('Order Now','floating-social-media-icon'); ?></a>'><?php _e('Add Custom Icon','floating-social-media-icon'); ?></span><?php
echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_icons_option_field','acx_fsmi_custom_icon_btn_field',800);
/* Social Media Icon Settings field Ends here */
/* Social Media Integration Settings Save - Get  - Set Default Logic Starts Here 
*/
function acx_fsmi_social_media_integration_html()
{
	global $acx_si_display;
	$acx_string = __('Social Media Integration Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
?>
<select name="acx_si_display">
<option value="auto"<?php if ($acx_si_display == "auto") { echo 'selected="selected"'; } ?>><?php _e('Automatic Only (Will Float) - Shortcode and PHP code will not show icons','floating-social-media-icon'); ?></option>
<option value="manual"<?php if ($acx_si_display == "manual") { echo 'selected="selected"'; } ?>><?php _e('Manual Only (Using Shortcode or PHP Code - Will not float)','floating-social-media-icon'); ?></option>
<option value="both"<?php if ($acx_si_display == "both") { echo 'selected="selected"'; } ?>><?php _e('Automatic and Manual (Shortcode/PHP will not float but Automatic will Float)','floating-social-media-icon'); ?></option>
</select>
<span class='acx_fsmi_q_sep'></span>	
<?php $code = ' <?php if (function_exists("DISPLAY_ACURAX_ICONS")) { DISPLAY_ACURAX_ICONS(); } ?>';
?><span class='acx_fsmi_q_sep'></span>
	<span class='note'><?php _e('If you select display mode as "Automatic Only" , it will show automatically but will not show anything for shortcode or php code, If you select as "Manual Only", It will not automatically show floating icons but you can place','floating-social-media-icon');?></span>
	<span class='acx_fsmi_q_sep'></span>
	<?php highlight_string($code); ?><span class='acx_fsmi_q_sep'></span>
<span class='note'><?php _e('in your theme file or use the shortcode','floating-social-media-icon');?> <span style="color: #000000;background:rgba(0, 0, 0, 0.07) none repeat scroll 0 0;" class="code">&nbsp;[DISPLAY_ACURAX_ICONS]</span><?php _e(', to display the Social Icons where ever you want, If you select "Automatic and Manual", It will automatically show floating icons and will also show icons for shortcode and php code.','floating-social-media-icon');?></span>
<?php	
echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_hook_option_fields','acx_fsmi_social_media_integration_html',600);
function acx_fsmi_social_media_integration_ifpost()
{
	global $acx_si_display ;
	$acx_si_display = acx_fsmi_post_isset_check('acx_si_display');
	update_option('acx_si_display', $acx_si_display);
	
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_social_media_integration_ifpost');
function acx_fsmi_social_media_integration_else()
{
	global $acx_si_display;
	$acx_si_display = get_option('acx_si_display');
} add_action('acx_fsmi_hook_option_postelse','acx_fsmi_social_media_integration_else');
function acx_fsmi_social_media_integration_after_else()
{
	global $acx_si_display;
	if ($acx_si_display == "") { $acx_si_display = "both"; }
} add_action('acx_fsmi_hook_option_after_else','acx_fsmi_social_media_integration_after_else');

/* Social Media Integration Settings Save - Get - Set Default Logic Ends Here */
/* Define Fly Animation Start and End Position Save - Get  - Set Default Logic Starts Here 
*/
function acx_fsmi_animation_position_html()
{
	$acx_string = __('Define Fly Animation Start and End Position','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
?>
<span class="fsmi_p_info_start_end fsmi_info_premium fsmi_info_lb" lb_title="<?php _e('Configure Fly Animation Start and End Position','floating-social-media-icon');?>" lb_content="<?php _e('You can configure the floating social media icons fly animation start and end position, By default it fly from top left to bottom right.','floating-social-media-icon');?><br><br><i><?php _e('This feature is only available in our premium version - ','floating-social-media-icon');?><a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=fly-animation&utm_medium=fsmi&utm_campaign=plugin' target='_blank'><?php _e('Compare Features','floating-social-media-icon');?></a> / <a href='http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=fsmi&utm_campaign=premium-info' target='_blank'><?php _e('Order Now','floating-social-media-icon');?></a>"></span>
<?php
echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
} 
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
if($acx_si_fsmi_hide_advert == "no")
{ 
	add_action('acx_fsmi_hook_option_fields','acx_fsmi_animation_position_html',700);
}
/*  Credit Link Save - Get  - Set Default Logic Starts Here */
function acx_fsmi_credit_link_html()
{
	global $acx_si_credit;
		$acx_string = __('Credit Link Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);
	?>
	<select name="acx_si_credit">
	<option value="yes"<?php if ($acx_si_credit == "yes") { echo 'selected="selected"'; } ?>><?php _e('Yes, Its Okay to Show Credit Link','floating-social-media-icon');?> </option>
	<option value="no"<?php if ($acx_si_credit == "no") { echo 'selected="selected"'; } ?>><?php _e('No, I dont Like to Show Credit Link','floating-social-media-icon');?></option>
	</select>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
	echo "<span class='note'>".__('We Appreciate You Link Back to Our Website, Its just a small font size link :)','floating-social-media-icon')."</span>";
	print_acx_fsmi_option_block_end();
} 
$acx_si_credit = get_option('acx_si_credit');
if($acx_si_credit == "yes") 
{
	add_action('acx_fsmi_hook_option_fields','acx_fsmi_credit_link_html',800);
}	
function acx_fsmi_social_media_credit_ifpost()
{
	global $acx_si_credit ;
	$acx_si_credit = acx_fsmi_post_isset_check('acx_si_credit');
	update_option('acx_si_credit', $acx_si_credit);
	
} add_action('acx_fsmi_hook_option_onpost','acx_fsmi_social_media_credit_ifpost');
/* Credit Link Save - Get  - Set Default Logic Starts Here */
/* Define Submit Button Starts Here */
function acx_fsmi_submit_button_html()
{
	echo "<span class='acx_fsmi_q_sep'></span>";?>
	<span id='acx_fsmi_save_btn' style='clear:both;'><input type='submit' name='Submit' class='button button-primary' value='<?php _e('Save Configuration','floating-social-media-icon'); ?>' /></span>
	<?php
echo "<span class='acx_fsmi_q_sep'></span>";
} 
add_action('acx_fsmi_hook_option_fields','acx_fsmi_submit_button_html',900);
/* Define Submit Button Ends Here */
/* Define options above if post Starts Here */
function acx_fsmi_options_above_if()
{
	global $acx_si_credit;
	$acx_si_credit = get_option('acx_si_credit');
	if ($acx_si_credit == "") {	$acx_si_credit = 'no'; }
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
	if ($acx_si_fsmi_hide_advert == "") {	$acx_si_fsmi_hide_advert = 'no'; }
	$get_backlink = "";
	if(ISSET($_GET["backlink"]))
	{
		$get_backlink = sanitize_text_field($_GET["backlink"]);
	}
	if($get_backlink == "enable") {
	update_option('acx_si_credit', 'yes');
	?>
	<style type='text/css'>
	#acx_backlink
	{
	display:none;
	}
	</style>
<?php }
}
add_action('acx_fsmi_hook_option_above_ifpost','acx_fsmi_options_above_if',100);
/*
Define options above if post Ends Here
*/
/* Define options in else  post Starts Here
*/

function acx_fsmi_social_media_else()
{
	global $acx_si_installed_date,$acx_si_credit,$social_icon_array_order,$acx_si_fsmi_hide_advert;
	$acx_si_installed_date = get_option('acx_si_installed_date');
	if ($acx_si_installed_date=="")
	{ 	$acx_si_installed_date = time();
		update_option('acx_si_installed_date', $acx_si_installed_date);
	}

	$acx_si_credit = get_option('acx_si_credit');
	if ($acx_si_credit == "") {	$acx_si_credit = 'no'; }
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
	if ($acx_si_fsmi_hide_advert == "") { $acx_si_fsmi_hide_advert = 'no'; }
	do_action('acx_fsmi_array_refresh');
	$social_icon_array_order = get_option('social_icon_array_order');
	$social_icon_array_order = unserialize($social_icon_array_order);
} add_action('acx_fsmi_hook_option_postelse','acx_fsmi_social_media_else',100);
/* Define options in else  post Ends Here */

/* Comparison HTML Starts Here */
 function acx_fsmi_show_comparison()
{
	global $acx_si_fsmi_hide_advert;
	if($acx_si_fsmi_hide_advert == "no")
	{
		echo "<span class='acx_fsmi_q_sep'></span>";
		do_action('acx_fsmi_comparison_premium',1);
		echo "<span class='acx_fsmi_q_sep'></span>";
	}
}
add_action('acx_fsmi_hook_option_footer','acx_fsmi_show_comparison',400); 
/* Comparison HTML Ends Here */
/* Footer HTML Starts Here */
function acx_fsmi_show_footer_contact_section()
{
?><p class="widefat" style="padding:8px;width:99%;"><?php _e('Something Not Working Well? Have a Doubt? Have a Suggestion?','floating-social-media-icon'); ?> - <a href="http://www.acurax.com/contact.php" target="_blank"><?php _e('Contact us now','floating-social-media-icon'); ?></a> |<?php _e(' Need a Custom Designed Theme For your Blog or Website? Need a Custom Header Image?','floating-social-media-icon'); ?> - <a href="http://www.acurax.com/contact.php" target="_blank"><?php _e('Contact us now','floating-social-media-icon'); ?></a></p>
<?php
echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_hook_option_footer','acx_fsmi_show_footer_contact_section',500); 
/* Footer HTML Ends Here */

/******************* MISC PAGE ****************************************/
/* 	Premium Info HTML - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_misc_premium_advert_above_form()
{
	 global $acx_si_fsmi_hide_advert,$acx_si_credit;
	if($acx_si_fsmi_hide_advert == "no")
	{
		echo "<span class='acx_fsmi_q_sep'></span>";
	?>
	<div id="acx_fsmi_premium">
	<a style="margin: 10px 0px 0px 10px; font-weight: bold; font-size: 14px; display: block;" href="http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=misc-fully-featured&utm_medium=fsmi&utm_campaign=plugin" target="_blank"><?php _e('Fully Featured - Premium Floating Social Media Icon is Available With Tons of Extra Features! - Click Here','floating-social-media-icon'); ?></a>
	</div> <!-- acx_fsmi_premium -->
	<?php 
	} ?>
	<h2 style="width: 100%; font-size: 2px; padding: 0px; line-height: 0px; color: white;">.</h2>
	<?php
	if($acx_si_credit != "yes")
	{	
		echo "<span class='acx_fsmi_q_sep'></span>";?>
		<div id='acx_backlink' align='center'>
		<?php _e('Please do a favour by enabling back-link to our site.','floating-social-media-icon'); ?> <a href="admin.php?page=Acurax-Social-Icons-Settings&backlink=enable"><?php _e('Okay, Enable.','floating-social-media-icon'); ?></a> 
		</div>
		<?php 

	}	
	echo "<span class='acx_fsmi_q_sep'></span>";
}  add_action('acx_fsmi_misc_hook_option_above_page_left','acx_fsmi_misc_premium_advert_above_form',50);

/* 	Premium Info HTML - Save - Get - Set Default Logic Starts Here */

/* 	Theme Conflict/Misc Settings HTML - Save - Get - Set Default Logic Starts Here */
function acx_fsmi_misc_theme_conflict_html()
{
	$acx_string  = __('Acurax Theme Conflict/Misc Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);	
	do_action('acx_fsmi_misc_theme_conflict_option_field');
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_misc_hook_option_fields','acx_fsmi_misc_theme_conflict_html',100);
function acx_fsmi_icon_vertical_field()
{
	global $acx_si_fsmi_float_fix;?>
<span class="label" style="width:50%;"><?php _e("Icons Vertical Issue?","floating-social-media-icon"); ?><a style="cursor:pointer;" class="fsmi_info_premium fsmi_info_lb" lb_title="<?php _e("Icon Shows Vertical Instead of Horizontal","floating-social-media-icon"); ?>" lb_content="<?php _e("If your social media icons is displaying vertically instead of horizontal, You can change this settings.","floating-social-media-icon"); ?>">[?]</a></span>
	
	<select name="acx_si_fsmi_float_fix" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_float_fix == "yes") { echo 'selected="selected"'; } ?>><?php _e('Yes,Make My Vertical Icons Horizontal','floating-social-media-icon'); ?></option>
<option value="no"<?php if ($acx_si_fsmi_float_fix == "no") { echo 'selected="selected"'; } ?>><?php _e('No, I Dont Have Any Issues','floating-social-media-icon'); ?></option>
</select>

	<?php echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_theme_conflict_option_field','acx_fsmi_icon_vertical_field',100);
function acx_fsmi_float_fix_if()
{
	global $acx_si_fsmi_float_fix;
	$acx_si_fsmi_float_fix = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_float_fix'));
	update_option('acx_si_fsmi_float_fix', $acx_si_fsmi_float_fix);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_float_fix_if');

function acx_fsmi_fsmi_float_fix_else()
{
	global $acx_si_fsmi_float_fix;
	$acx_si_fsmi_float_fix = get_option('acx_si_fsmi_float_fix');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_fsmi_float_fix_else'); 
function acx_fsmi_fsmi_float_fix_after_else()
{
	global $acx_si_fsmi_float_fix;

if ($acx_si_fsmi_float_fix == "") {	$acx_si_fsmi_float_fix = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_fsmi_float_fix_after_else');
function acx_fsmi_theme_warning_ignore()
{
	global $acx_si_fsmi_theme_warning_ignore;
	echo "<span class='label' style='width:50%;'>". __('Ignore Theme Warning?','floating-social-media-icon')."</span>";
	?>
<select name="acx_si_fsmi_theme_warning_ignore" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_theme_warning_ignore == "yes") { echo 'selected="selected"'; } ?>><?php _e('Yes, Everything is working fine and and i still see theme warning - Fix This','floating-social-media-icon'); ?></option>
<option value="no"<?php if ($acx_si_fsmi_theme_warning_ignore == "no") { echo 'selected="selected"'; } ?>><?php _e('No, I Have No Issues','floating-social-media-icon'); ?></option>
</select>

	<?php echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_theme_conflict_option_field','acx_fsmi_theme_warning_ignore',200);
function acx_fsmi_theme_warning_ignore_if()
{
	global $acx_si_fsmi_theme_warning_ignore;
	$acx_si_fsmi_theme_warning_ignore = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_theme_warning_ignore'));
	update_option('acx_si_fsmi_theme_warning_ignore', $acx_si_fsmi_theme_warning_ignore);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_theme_warning_ignore_if');

function acx_fsmi_theme_warning_ignore_else()
{
	global $acx_si_fsmi_theme_warning_ignore;
	$acx_si_fsmi_theme_warning_ignore = get_option('acx_si_fsmi_theme_warning_ignore');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_theme_warning_ignore_else');
function acx_fsmi_theme_warning_ignore_after_else()
{
	global $acx_si_fsmi_theme_warning_ignore;
	if ($acx_si_fsmi_theme_warning_ignore == "") {	$acx_si_fsmi_theme_warning_ignore = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_theme_warning_ignore_after_else');
function acx_fsmi_set_icons_vertical()
{
	echo "<span class='label' style='width:50%;'>". __('Set Icons Vertical?','floating-social-media-icon')."";
	?>
<a style="cursor:pointer;" class="fsmi_info_premium fsmi_info_lb" lb_title="<?php _e("Display Icons Vertically","floating-social-media-icon"); ?>" lb_content="<?php _e("Its possible to make the social icons align vertical or horizontal, You can set the number of icons to have a in a row, by adjusting the slider, So you can set # of icons in a row to 1 makes it looks vertical.","floating-social-media-icon"); ?><br><br><i><?php _e("This feature is only available in our premium version - ","floating-social-media-icon"); ?><a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=vertical-icon&utm_medium=fsmi&utm_campaign=plugin' target='_blank'><?php _e("Compare Features","floating-social-media-icon"); ?></a> / <a href='http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=fsmi&utm_campaign=premium-info' target='_blank'><?php _e("Order Now","floating-social-media-icon"); ?></a>">[?]</a></span>
<span name="acx_si_fsmi_theme_demo_vertical" class="fsmi_p_info_icon_h fsmi_info_premium fsmi_info_lb" lb_title="<?php _e("Display Icons Vertically","floating-social-media-icon"); ?>" lb_content="<?php _e("Its possible to make the social icons align vertical or horizontal, You can set the number of icons to have a in a row, by adjusting the slider, So you can set # of icons in a row to 1 makes it looks vertical.","floating-social-media-icon"); ?><br><br><i><?php _e("This feature is only available in our premium version - ","floating-social-media-icon"); ?><a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=vertical-icon&utm_medium=fsmi&utm_campaign=plugin' target='_blank'><?php _e("Compare Features","floating-social-media-icon"); ?></a> / <a href='http://clients.acurax.com/order.php?pid=fsmi_power&utm_source=fsmi&utm_campaign=premium-info' target='_blank'><?php _e("Order Now","floating-social-media-icon"); ?></a>">
</span>
	<?php echo "<span class='acx_fsmi_q_sep'></span>";
}
global $acx_si_fsmi_hide_advert;
if($acx_si_fsmi_hide_advert == "no")
{
	add_action('acx_fsmi_misc_theme_conflict_option_field','acx_fsmi_set_icons_vertical',300);
}
function acx_fsmi_disable_mob_float()
{
	global $acx_si_fsmi_disable_mobile;
	echo "<span class='label' style='width:50%;'>".__('Disable Floating On Mob Devices?','floating-social-media-icon'). "<a style='cursor:pointer;' class='fsmi_info_premium fsmi_info_lb' lb_title='".__('Disable Floating Icons on Mobile Devices','floating-social-media-icon') ."' lb_content='". __('Depends on some theme design, the floating icons can make visibility issues on mobile devices, if you are experiencing such an issue, you can disable the floating icons on mobile devices.','floating-social-media-icon')."' >[?]</a> </span>";
	
	?>
<select name="acx_si_fsmi_disable_mobile" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_disable_mobile == "yes") { echo 'selected="selected"'; } ?>><?php _e('Yes, Lets disable it','floating-social-media-icon');?> </option>
<option value="no"<?php if ($acx_si_fsmi_disable_mobile == "no") { echo 'selected="selected"'; } ?>><?php _e('No, Thats fine','floating-social-media-icon' ); ?></option>
</select>
	<?php echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_theme_conflict_option_field','acx_fsmi_disable_mob_float',400);
function acx_fsmi_disable_mob_float_if()
{
	global $acx_si_fsmi_disable_mobile;
	$acx_si_fsmi_disable_mobile = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_disable_mobile'));
	update_option('acx_si_fsmi_disable_mobile', $acx_si_fsmi_disable_mobile);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_disable_mob_float_if');
function acx_fsmi_disable_mob_float_else()
{
	global $acx_si_fsmi_disable_mobile;
	$acx_si_fsmi_disable_mobile = get_option('acx_si_fsmi_disable_mobile');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_disable_mob_float_else');
function acx_fsmi_disable_mob_float_after_else()
{
	global $acx_si_fsmi_disable_mobile;

if ($acx_si_fsmi_disable_mobile == "") {	$acx_si_fsmi_disable_mobile = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_disable_mob_float_after_else');
function acx_fsmi_no_follow_link()
{
	global $acx_si_fsmi_no_follow;
	echo "<span class='label' style='width:50%;'>". __('No follow links? ','floating-social-media-icon')."<a style='cursor:pointer;' class='fsmi_info_premium fsmi_info_lb' lb_title='". __('Icon Link No Follow Settings','floating-social-media-icon')."' lb_content='". __('Would you like to disable Nofollow on Icon links? You can configure this option to Yes','floating-social-media-icon')."'>[?]</a></span>";
	?>
<select name="acx_si_fsmi_no_follow" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_no_follow == "yes") { echo 'selected="selected"'; } ?>><?php _e('No,Thats fine','floating-social-media-icon'); ?></option>
<option value="no"<?php if ($acx_si_fsmi_no_follow == "no") { echo 'selected="selected"'; } ?>><?php _e('Yes, Lets Disable No Follow','floating-social-media-icon'); ?> </option>
</select>
	<?php echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_theme_conflict_option_field','acx_fsmi_no_follow_link',500);
function acx_fsmi_no_follow_if()
{
	global $acx_si_fsmi_no_follow;
	$acx_si_fsmi_no_follow = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_no_follow'));
	update_option('acx_si_fsmi_no_follow', $acx_si_fsmi_no_follow);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_no_follow_if');
function acx_fsmi_no_follow_else()
{
	global $acx_si_fsmi_no_follow;
	$acx_si_fsmi_no_follow = get_option('acx_si_fsmi_no_follow');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_no_follow_else');
function acx_fsmi_no_follow_after_else()
{
	global $acx_si_fsmi_no_follow;
	if ($acx_si_fsmi_no_follow == "") {	$acx_si_fsmi_no_follow = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_no_follow_after_else');
/* 	Theme Conflict/Misc Settings HTML - Get - Set Default Logic Ends Here */
/* 	Acurax Service/Info Settings HTML - Get - Set Default Logic Starts Here */
function acx_fsmi_misc_service_info_html()
{
	$acx_string = __('Acurax Service/Info Settings','floating-social-media-icon');
	print_acx_fsmi_option_block_start($acx_string);	
	do_action('acx_fsmi_misc_service_info');
	echo "<span class='acx_fsmi_q_sep'></span>";
	print_acx_fsmi_option_block_end();
}  add_action('acx_fsmi_misc_hook_option_fields','acx_fsmi_misc_service_info_html',200);
function acx_fsmi_service_info_option()
{
	global $acx_fsmi_acx_service_banners;
	echo "<span class='label' style='width:50%;'>". __('Acurax Service Info ','floating-social-media-icon')."</span>";?>
	<select name="acx_fsmi_acx_service_banners" style="width:49%;">
	<option value="yes"<?php if ($acx_fsmi_acx_service_banners == "yes") { echo 'selected="selected"'; } ?>><?php _e('Show Acurax Service Banner','floating-social-media-icon');?></option>
	<option value="no"<?php if ($acx_fsmi_acx_service_banners == "no") { echo 'selected="selected"'; } ?>><?php _e('Hide Acurax Service Banner','floating-social-media-icon'); ?></option>
	</select>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_service_info','acx_fsmi_service_info_option',100);
function acx_fsmi_service_info_if()
{
	global $acx_fsmi_acx_service_banners;
	$acx_fsmi_acx_service_banners = sanitize_text_field(acx_fsmi_post_isset_check('acx_fsmi_acx_service_banners'));
	update_option('acx_fsmi_acx_service_banners', $acx_fsmi_acx_service_banners);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_service_info_if');
function acx_fsmi_service_info_else()
{
	global $acx_fsmi_acx_service_banners;
	$acx_fsmi_acx_service_banners = get_option('acx_fsmi_acx_service_banners');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_service_info_else');
function acx_fsmi_service_info_after_else()
{
	global $acx_fsmi_acx_service_banners;

if ($acx_fsmi_acx_service_banners == "") {	$acx_fsmi_acx_service_banners = "yes"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_service_info_after_else');
/* 	Acurax Service/Info Settings HTML - Get - Set Default Logic Ends Here */

/* 	Premium Version Info Settings HTML - Get - Set Default Logic Starts Here */
function acx_fsmi_misc_premium_info_option()
{
	global $acx_si_fsmi_hide_advert;
	echo "<span class='label' style='width:50%;'>". __('Premium Version Info ','floating-social-media-icon')."</span>";?>
	<select name="acx_si_fsmi_hide_advert" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_hide_advert == "yes") { echo 'selected="selected"'; } ?>><?php _e('Hide Premium Version Infos','floating-social-media-icon'); ?></option>
<option value="no"<?php if ($acx_si_fsmi_hide_advert == "no") { echo 'selected="selected"'; } ?>><?php _e('Show Premium Version Infos','floating-social-media-icon');?></option>
</select>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_service_info','acx_fsmi_misc_premium_info_option',200);
function acx_fsmi_premium_info_if()
{
	global $acx_si_fsmi_hide_advert;
	$acx_si_fsmi_hide_advert = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_hide_advert'));
	update_option('acx_si_fsmi_hide_advert', $acx_si_fsmi_hide_advert);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_premium_info_if');

function acx_fsmi_premium_info_else()
{
	global $acx_si_fsmi_hide_advert;
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_premium_info_else');
function acx_fsmi_premium_info_after_else()
{
	global $acx_si_fsmi_hide_advert;
if ($acx_si_fsmi_hide_advert == "") {	$acx_si_fsmi_hide_advert = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_premium_info_after_else');

/* 	Premium Version Info Settings  Settings HTML - Get - Set Default Logic Ends Here */
/* 	Expert Support Menu Settings HTML - Get - Set Default Logic Starts Here */
function acx_fsmi_misc_expert_support_option()
{
	global $acx_si_fsmi_hide_expert_support_menu;
	echo "<span class='label' style='width:50%;'>". __('Expert Support Menu','floating-social-media-icon')."</span>";?>
	<select name="acx_si_fsmi_hide_expert_support_menu" style="width:49%;">
<option value="yes"<?php if ($acx_si_fsmi_hide_expert_support_menu == "yes") { echo 'selected="selected"'; } ?>><?php _e('Hide Expert Support Menu From Acurax');?></option>
<option value="no"<?php if ($acx_si_fsmi_hide_expert_support_menu == "no") { echo 'selected="selected"'; } ?>><?php _e('Show Expert Support Menu From Acurax');?></option>
</select>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_service_info','acx_fsmi_misc_expert_support_option',300);
function acx_fsmi_expert_support_if()
{
	global $acx_si_fsmi_hide_expert_support_menu;
	$acx_si_fsmi_hide_expert_support_menu = sanitize_text_field(acx_fsmi_post_isset_check('acx_si_fsmi_hide_expert_support_menu'));
	update_option('acx_si_fsmi_hide_expert_support_menu', $acx_si_fsmi_hide_expert_support_menu);
} add_action('acx_fsmi_misc_hook_option_onpost','acx_fsmi_expert_support_if');
function acx_fsmi_expert_support_else()
{
	global $acx_si_fsmi_hide_expert_support_menu;
	$acx_si_fsmi_hide_expert_support_menu = get_option('acx_si_fsmi_hide_expert_support_menu');
} 
add_action('acx_fsmi_misc_hook_option_postelse','acx_fsmi_expert_support_else');
function acx_fsmi_expert_support_after_else()
{
	global $acx_si_fsmi_hide_expert_support_menu;

if ($acx_si_fsmi_hide_expert_support_menu == "") {	$acx_si_fsmi_hide_expert_support_menu = "no"; }
} add_action('acx_fsmi_misc_hook_option_after_else','acx_fsmi_expert_support_after_else');
/*	Expert Support Menu Settings  Settings HTML - Get - Set Default Logic Ends Here */

/* Define Misc Submit Button Starts Here */
function acx_fsmi_misc_submit_button_html()
{
	echo "<span class='acx_fsmi_q_sep'></span>";?>
	<input type='submit' name='Submit' class='button button-primary' value='<?php _e('Save Settings','floating-social-media-icon'); ?>' />
	<?php
echo "<span class='acx_fsmi_q_sep'></span>";
} 
add_action('acx_fsmi_misc_hook_option_fields','acx_fsmi_misc_submit_button_html',300);
/* Define Misc Submit Button Ends Here */
/* Comparison HTML Starts Here */
 function acx_fsmi_misc_show_comparison()
{
	global $acx_si_fsmi_hide_advert;
	if($acx_si_fsmi_hide_advert == "no")
	{
		echo "<span class='acx_fsmi_q_sep'></span>";
		do_action('acx_fsmi_comparison_premium',1);
		echo "<span class='acx_fsmi_q_sep'></span>";
	}
}
add_action('acx_fsmi_misc_hook_option_footer','acx_fsmi_misc_show_comparison',100); 
/* Comparison HTML Starts Here */

/* Footer HTML Starts Here */
function acx_fsmi_misc_show_footer_contact_section()
{
	echo "<span class='acx_fsmi_q_sep'></span>";
?><p class="widefat" style="padding:8px;width:99%;">
<?php _e('Something Not Working Well? Have a Doubt? Have a Suggestion? -','floating-social-media-icon'); ?> <a href="http://www.acurax.com/contact.php" target="_blank"><?php _e('Contact us now','floating-social-media-icon'); ?></a> | <?php _e('Need a Custom Designed Theme For your Blog or Website? Need a Custom Header Image? ','floating-social-media-icon'); ?>- <a href="http://www.acurax.com/contact.php" target="_blank"><?php _e('Contact us now','floating-social-media-icon');?></a></p>
<?php
echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_misc_hook_option_footer','acx_fsmi_misc_show_footer_contact_section',200); 
/* Footer HTML Ends Here */
/*********************************** PREMIUM *****************************************************************/
/* Premium Updation HTML Starts Here */
function acx_fsmi_premium_html()
{
	$td_get = "";
	if(ISSET($_GET['td']))
	{
		$td_get = $_GET['td'];
	}
	if($td_get == 'hide') 
	{
		update_option('acx_si_td', "hide");
		?>
		<style type='text/css'>
		#acx_td_fsmi
		{
		display:none;
		}
		</style>

		<div class="error" style="background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
		<?php _e('Thanks again for using the plugin.','floating-social-media-icon');?>
		</div>
		<?php
	}
}
add_action('acx_fsmi_premium_hook_option_footer','acx_fsmi_premium_html',100);
/* Premium Updation HTML Ends Here */
/* Comparison  HTML Starts Here */
function acx_fsmi_premium_comparison_html()
{
	echo "<span class='acx_fsmi_q_sep'></span>";
	do_action('acx_fsmi_comparison_premium',1);
	echo "<span class='acx_fsmi_q_sep'></span>";
}
add_action('acx_fsmi_premium_hook_option_footer','acx_fsmi_premium_comparison_html',200);
/* Comparison  HTML Ends Here */
/********************************************************* Help Page *****************************************************/
/* Premium Ad on the top starts Here*/
function acx_fsmi_help_html()
{
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
	
	if($acx_si_fsmi_hide_advert == "no")
	{ ?>
	<div id="acx_fsmi_premium">
	<a style="margin: 10px 0px 0px 10px; font-weight: bold; font-size: 14px; display: block;" href="http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?feature=compare&utm_source=help-fully-featured&utm_medium=fsmi&utm_campaign=plugin" target="_blank"><?php _e('Fully Featured - Premium Floating Social Media Icon is Available With Tons of Extra Features! - Click Here'); ?></a>
	<!-- a style="margin: -14px 0px 0px 10px; float: left;" href="http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/?utm_source=plugin&utm_medium=highlight_yellow&utm_campaign=fsmi" target="_blank"><img src="<?php echo plugins_url('images/yellow.png', __FILE__);?>"></a -->
	</div> <!-- acx_fsmi_premium -->
<?php } 
}
add_action('acx_fsmi_help_hook_option_above_page_left','acx_fsmi_help_html',100);
/* Premium Ad on the top Ends Here*/

/* Help/Support HTML  starts Here*/
function acx_fsmi_help_support_html()
{
?>
<h2 style="text-align:center;"><?php _e('Floating Social Media Icon - Wordpress Plugin - Help/Support','floating-social-media-icon');?></h2>
<p style="text-align:center;"><?php _e('Thank you for using Floating Social Media Icon Plugin For Your Wordpress Social Media Profile Linking Need.','floating-social-media-icon')?></p>
<h3 style="text-align:center;"><a href="http://clients.acurax.com/link.php?id=8" target="_blank" class="button"><?php _e('Click here to open the FAQ and Help Page','floating-social-media-icon'); ?></a></h3>
<?php }
add_action('acx_fsmi_help_hook_option_above_page_left','acx_fsmi_help_support_html',200);

/* Help/Support HTML  starts Here*/
/* Comparison HTML  starts Here*/

 function acx_fsmi_help_show_comparison()
{
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
	if($acx_si_fsmi_hide_advert == "no")
	{
		echo "<span class='acx_fsmi_q_sep'></span>";
		do_action('acx_fsmi_comparison_premium',1);
		echo "<span class='acx_fsmi_q_sep'></span>";
	}
}
add_action('acx_fsmi_help_hook_option_above_page_left','acx_fsmi_help_show_comparison',300); 
/* Comparison HTML  Ends Here*/
/********************************************************* Expert  Page *****************************************************/
/* Troubleshooter page options Starts Here*/
function acx_fsmi_quick_fix_applied()
{	
	global $fix_applied;
	if($fix_applied == 1)
	{
	echo "<div style='background: none repeat scroll 0% 0% lightgreen; width: 300px; text-align: center; margin-right: auto; margin-left: auto; padding: 7px 7px 5px; border-top-right-radius: 7px; border-top-left-radius: 7px; border-bottom: 2px solid green;'>". __('Action Completed Successfully','floating-social-media-icon')."</div>";
	}
}
add_action('acx_fsmi_exprt_hook_option_form_head','acx_fsmi_quick_fix_applied',120);
function acx_fsmi_expert_icon_select_html()
{	
	global $page;
	if($page == "Acurax-Social-Icons-Troubleshooter")
	{
		echo "<h2 class='acx_fsmi_option_head'>". __('Floating Social Media Icon Troubleshooting','floating-social-media-icon')."</h2>"; 
		echo "<span class='acx_fsmi_q_sep'></span>";?>
<p style="font-weight:bold;text-align:center;color:darkred;"><?php _e('IMPORTANT NOTE: Please do troubleshooting only if you got instructions from support or know what you are going to do.','floating-social-media-icon') ;?></p>

<?php
	echo "<span class='acx_fsmi_q_sep'></span>";?>
<p class="widefat" style="background: none repeat scroll 0% 0% menu; border-bottom: 2px dashed lavender; border-right: 2px dashed lavender; margin-bottom: 15px; margin-top: 8px; padding: 8px; width: 99%;">	<?php _e("1) Icon Selection Display Fix: ","floating-social-media-icon" ); 
echo "<span class='acx_fsmi_q_sep'></span>";
	}
}
add_action('acx_fsmi_exprt_hook_option_above_page_left','acx_fsmi_expert_icon_select_html',200);
function acx_fsmi_expert_quick_fix_html()
{
	global $page;
	if($page == "Acurax-Social-Icons-Troubleshooter")
	{
	echo "<span class='acx_fsmi_q_sep'></span>";?>
	<?php _e("If you cant find any icons on the icon theme/style selection section, try this fix","floating-social-media-icon" ); ?>
	<a href="admin.php?page=Acurax-Social-Icons-Troubleshooter&quickfix=1&sid=<?php echo wp_create_nonce('acx_fsmi_qfix'); ?>" class="acx_trouble_fixit"><?php _e('Click here to try this fix!','floating-social-media-icon');?></a>
	</p>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
	}
}
add_action('acx_fsmi_exprt_hook_option_above_page_left','acx_fsmi_expert_quick_fix_html',300);
function acx_fsmi_exprt_quick_fix_add()
{
	global $social_icon_array_order,$fix_applied,$page;
	if(is_serialized($social_icon_array_order))
	{
	$social_icon_array_order = unserialize($social_icon_array_order);
	}
	$page = $quick_fix = $sid = "";
	if(ISSET($_GET['page']))
	{
		$page = $_GET['page'];
	}
	if(ISSET($_GET['quickfix']))
	{
		$quick_fix = sanitize_text_field($_GET['quickfix']);
	} 
	if(ISSET($_GET['sid']))
	{
		$sid = sanitize_text_field($_GET['sid']);
	} 
	if (!wp_verify_nonce($sid,'acx_fsmi_qfix'))
	{
		$sid = "";
	}
	if(!current_user_can('manage_options'))
	{
		$sid = "";
	}

	$fix_applied = 0;
	if($sid != "")
	{
		if($quick_fix == 1)
		{
			do_action('acx_fsmi_array_refresh');
			$fix_applied = 1;
		}
	}
}
add_action('acx_fsmi_exprt_hook_option_exprt_quick','acx_fsmi_exprt_quick_fix_add',100);
function acx_fsmi_expert_down_note_html()
{
	global $page;
	if($page == "Acurax-Social-Icons-Troubleshooter")
	{
		echo "<span class='acx_fsmi_q_sep'></span>";?>
	<p style="text-align:center;"><?php _e('We will be adding more troubleshooting quick fix options according to users requests','floating-social-media-icon');?></p>
	<?php
	echo "<span class='acx_fsmi_q_sep'></span>";
	acx_fsmi_quick_form();
	}
}
add_action('acx_fsmi_exprt_hook_option_above_page_left','acx_fsmi_expert_down_note_html',400);
/* Troubleshooter page options Ends Here*/
/* Addon Page */
function acx_fsmi_addon_list_section()
{
	$fsmi_addons_intro = array();
	$fsmi_addons_intro[] = array(
							'name' => __('Social Media Icon - Power Addon','floating-social-media-icon'),
							'img' => plugins_url('/images/power_addon.jpg',dirname(__FILE__)),
							'desc' => __('This addon is packed with more sharp quality icons and can upload any number of icons.Social Media Function Option allows you to set the icon as share icons or profile linking icons,it also adds option in page and posts, while editing to define Social Media Meta Tags. Share icons can also be integrated automatically to page/post.','floating-social-media-icon'),
							'url' => 'http://www.acurax.com/products/floating-social-media-icon-wordpress-plugin/?feature=fsmi_power&utm_source=fsmi&utm_medium=addon-page',
							'button' => __('View Details','floating-social-media-icon')
							);
							?>
							<div id="fsmi_addons_intro_holder">
<?php
foreach($fsmi_addons_intro as $key => $value)
{
?>
<div class="fsmi_addons_intro" onclick="window.open('<?php echo $value['url']; ?>'); return false;">
<img src="<?php echo $value['img']; ?>">
<h3><?php echo $value['name']; ?></h3>
<p>
<?php echo $value['desc']; ?>
</p>
<a class="fsmi_addon_button" href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['button']; ?></a>
</div> <!-- fsmi_addons_intro -->
<?php } ?>
</div> <!-- fsmi_addons_intro_holder -->
<?php
}
add_action("acx_fsmi_addon_hook_option_field_content","acx_fsmi_addon_list_section",10);
/* Addon Page */
?>