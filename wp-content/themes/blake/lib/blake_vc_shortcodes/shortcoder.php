<?php
	require_once(
		$_POST['thepath']."wp-" 
		. "loa". "d.p" ."hp");
	$post_object = get_post( $_POST['id'] );
	if (function_exists('wpb_js_remove_wpautop') == true)
		echo wpb_js_remove_wpautop($post_object->post_content);
	else echo wp_kses_post($post_object->post_content);
?>