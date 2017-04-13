<?php
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_above_ifpost');
if(ISSET($_POST['acx_fsmi_misc_hidden']))
{
	$acx_fsmi_misc_hidden = $_POST['acx_fsmi_misc_hidden'];
} 
else
{
	$acx_fsmi_misc_hidden = "";
}
if($acx_fsmi_misc_hidden == 'Y') 
{
	acx_fsmi_hook_function('acx_fsmi_misc_hook_option_onpost');
} else
{
	acx_fsmi_hook_function('acx_fsmi_misc_hook_option_postelse');
}
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_after_else');
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_form_head');
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_fields');
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_form_footer');
acx_fsmi_hook_function('acx_fsmi_misc_hook_option_sidebar');
?>
