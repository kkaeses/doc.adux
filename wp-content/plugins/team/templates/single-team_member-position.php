<?php

/*
* @Author 		ParaTheme
* @Folder	 	Team/Templates
* @version     3.0.5

* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
		

		$position = get_post_meta(get_the_ID(), 'team_member_position', true);
	
	?>
	<div class="team-position"><?php echo $position; ?></div>