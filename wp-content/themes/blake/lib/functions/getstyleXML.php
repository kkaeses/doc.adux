<?php
	
	require_once(
		$_GET['url']."wp-" 
		. "loa". "d.p" ."hp");
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	
	if (!function_exists('WP_Filesystem')){
		$abspath = ($os === "win") ? "\wp-admin\includes\file.php" : "/wp-admin/includes/file.php";
		require_once(ABSPATH.$abspath);
		WP_Filesystem();
	}
	
	global $wp, $wp_filesystem;
	
	$uploaddir = wp_upload_dir();
	$filename = ($os === "win") ? $uploaddir['basedir']."\style_options.xml" : $uploaddir['basedir']."/style_options.xml";

	header('Content-Disposition: attachment;filename=style_options.xml');
    header("Content-Type: application/force-download");

	$xml = $wp_filesystem->get_contents($filename);
	print $xml;

?>
