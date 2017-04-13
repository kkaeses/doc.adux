<?php
/* 
Plugin Name: Social Media Flying Icons | Floating Social Media Icon
Plugin URI: http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/
Description: Floating Social Media Icon / Social Media Floating Icons  is a complete solution that help you to have Interactive Social Media Icons on your website which links to your social media profiles. The icons will catch your visitors attention by flying from top left to bottom right of your website.Its highly customizable with Drag and Drop Icon Reorder, Icon Size, Multiple Icon Styles etc.
Author: Acurax 
Version: 4.2.2
Author URI: http://www.acurax.com/home.php
License: GPLv2 or later
Text Domain: floating-social-media-icon
*/

/*

Copyright 2008-current  Acurax International  ( website : www.acurax.com )

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/ 
define("ACX_FSMI_BASE_LOCATION",plugin_dir_url( __FILE__ ));
define("ACX_FSMI_WP_SLUG","floating-social-media-icon");
define('ACX_FSMI_TOTAL_STATIC_SERVICES', 8);
define('ACX_FSMI_C_VERSION', '4.2.2');
include_once(plugin_dir_path( __FILE__ ).'/function.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/hooks.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/hook_functions.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/option_fields.php');
include_once(plugin_dir_path( __FILE__ ).'includes/acx-fsmi-licence-activation.php');
//*********** Include Additional Menu ********************
function AcuraxLinks($links, $file) {
	$plugin = plugin_basename(__FILE__);
	// create link
	$acx_installation_domain = $_SERVER['HTTP_HOST'];
	$acx_installation_domain = str_replace("www.","",$acx_installation_domain);
	$acx_installation_domain = str_replace(".","_",$acx_installation_domain);
	if($acx_installation_domain == "") { $acx_installation_domain = "not_defined";}
	if ($file == $plugin) {
	
		return array_merge( $links, array( 
			'<div id="plugin_page_links"><a href="http://www.acurax.com?utm_source=wp&utm_medium=link&utm_campaign=plugin-page&ref=' . $acx_installation_domain . '" target="_blank">' . __('Acurax International') . '</a>',
			'<a href="http://www.acurax.com/services/wordpress-designing-experts.php?utm_source=wp&utm_medium=link&utm_campaign=plugin-page&ref=' . $acx_installation_domain . '" target="_blank">' . __('Wordpress Expert Support') . '</a>',
			'<a href="http://www.acurax.com/services/wordpress-designing-experts.php?utm_source=wp&utm_medium=link&utm_campaign=plugin-page&ref=' . $acx_installation_domain . '" target="_blank">' . __('Need Help Configuring Plugins?') . '</a>',
			'<a href="http://www.acurax.com/services/wordpress-designing-experts.php?utm_source=wp&utm_medium=link&utm_campaign=plugin-page&ref=' . $acx_installation_domain . '" target="_blank">' . __('Instant Quick Support') . '</a>'
		));
	}
	return $links;
}	add_filter('plugin_row_meta', 'AcuraxLinks', 10, 2 );
//*********************************************************
function acx_fsmi_options() 
{
	include(plugin_dir_path( __FILE__ ).'/includes/acx_fsmi_options.php');
}
function acx_fsmi_expert_support() 
{
	include(plugin_dir_path( __FILE__ ).'/includes/expert_support.php');
}
function acx_fsmi_social_icon_help() 
{
	include(plugin_dir_path( __FILE__ ).'/includes/acx_fsmi_social_help.php');
}
function acx_fsmi_addons_page() 
{
	include(plugin_dir_path( __FILE__ ).'includes/acx_fsmi_addons.php');
}
function acx_fsmi_social_icon_premium() 
{
	include(plugin_dir_path( __FILE__ ).'/includes/acx_fsmi_premium.php');
}
function acx_fsmi_social_icon_misc() 
{
	include(plugin_dir_path( __FILE__ ).'/includes/acx_fsmi_misc.php');
}
function acx_fsmi_admin_actions()
{
	$acx_si_fsmi_hide_expert_support_menu = get_option('acx_si_fsmi_hide_expert_support_menu');
	add_menu_page(  __( 'Acurax Social Icon Plugin Configuration', 'floating-social-media-icon' ), __( 'Floating Social Media Settings', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Settings','acx_fsmi_options',ACX_FSMI_BASE_LOCATION.'/images/admin.png' ); // manage_options for admin
	
	add_submenu_page( 'Acurax-Social-Icons-Settings', __( 'Acurax Social Icon Premium', 'floating-social-media-icon' ),  __( 'Premium', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Premium' ,'acx_fsmi_social_icon_premium');
	
	add_submenu_page( 'Acurax-Social-Icons-Settings', __( 'Acurax Social Icon Misc Settings', 'floating-social-media-icon' ),  __( 'Misc', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Misc' ,'acx_fsmi_social_icon_misc');
	
	add_submenu_page('Acurax-Social-Icons-Settings', __('Acurax Social Icon Available Add-ons','floating-social-media-icon'), __('Add-ons','floating-social-media-icon'), 'manage_options', 'Acurax-Social-Icons-Add-ons' ,'acx_fsmi_addons_page');
	
	add_submenu_page(  'Acurax-Social-Icons-Settings', __( 'Acurax Troubleshooter', 'floating-social-media-icon' ),  __( 'Troubleshoot', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Troubleshooter' ,'acx_fsmi_expert_support');
	if($acx_si_fsmi_hide_expert_support_menu == "no") {
		
	add_submenu_page(  'Acurax-Social-Icons-Settings', __( 'Expert Wordpress Support From Acurax', 'floating-social-media-icon' ),  __( 'Expert Support', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Expert-Support' ,'acx_fsmi_expert_support');
	
	}
	add_submenu_page(  'Acurax-Social-Icons-Settings', __( 'Acurax Social Icon Help and Support', 'floating-social-media-icon' ),  __( 'Help', 'floating-social-media-icon' ), 'manage_options', 'Acurax-Social-Icons-Help' ,'acx_fsmi_social_icon_help');		
}
if (is_admin())
{
	add_action('admin_menu', 'acx_fsmi_admin_actions');
}
?>