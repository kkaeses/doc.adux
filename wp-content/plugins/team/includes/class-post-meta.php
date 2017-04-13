<?php

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 	

class team_class_post_meta{
	
	
	public function __construct(){


		add_action('add_meta_boxes', array($this, 'meta_boxes_team_member_meta_fileds'));
		add_action('save_post', array($this, 'meta_boxes_team_member_save_meta_fileds'));	
		
		//meta box action for "team_member"
		add_action('add_meta_boxes', array($this, 'meta_boxes_team_member_social'));
		add_action('save_post', array($this, 'meta_boxes_team_member_social_save'));
		
	
		
		//meta box action for "team"
		add_action('add_meta_boxes', array($this, 'meta_boxes_team'));
		add_action('save_post', array($this, 'meta_boxes_team_save'));
		

		}
	
	
	
	public function meta_boxes_team_member_meta_fileds($post_type) {
			$post_types = array('team_member');
	 
			//limit meta box to certain post types
			if (in_array($post_type, $post_types)) {
				add_meta_box('team_member_metabox_meta_fileds',
				'Team Member Meta Fields',
				array($this, 'team_member_meta_box_function_meta_fileds'),
				$post_type,
				'normal',
				'high');
			}
		}
	
	
	public function team_member_meta_box_function_meta_fileds($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('team_member_nonce_check', 'team_member_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
        $team_member_position = get_post_meta($post -> ID, 'team_member_position', true);		
        $team_member_link_to_post = get_post_meta($post -> ID, 'team_member_link_to_post', true);
	

 
 
		$team_member_meta_fields = get_option('team_member_meta_fields');
		
		if(empty($team_member_meta_fields)){
				$team_member_meta_fields = array(
											'address' => array('name'=>'Address','meta_key'=>'team_address'),
											//'mobile' => array('name'=>'Mobile','meta_key'=>'team_mobile'),											
										);
			
			}
 
 		foreach($team_member_meta_fields as $meta_key=>$meta_info){
			
			${$meta_info['meta_key']} = get_post_meta($post -> ID, $meta_info['meta_key'], true);
			
			}
 
 
        // Display the form, using the current value.
		
		echo '<div class="para-settings">';
		echo '<div class="option-box">';
		echo '<p class="option-title">'.__('Member Position','team').'</p>';
		echo '<p class="option-info"></p>';
		
		
		
		echo '<input type="text" size="30" placeholder="Team Leader"   name="team_member_position" value="';
		if(!empty($team_member_position)) 
		echo $team_member_position;
		echo '" />';
		echo '</div>';



		echo '<div class="option-box">';
		echo '<p class="option-title">'.__('Custom link to this member.','team').'</p>';
		echo '<p class="option-info"></p>';

		echo '<input type="text" size="30" placeholder="http://hello.com/project-sample"   name="team_member_link_to_post" value="';
		if(!empty($team_member_link_to_post)) 
		echo $team_member_link_to_post;
		echo '" />';
		echo '</div>';
		
		?>
       
        
        <?php
		
		foreach($team_member_meta_fields as $meta_key=>$meta_info){
			
			
			
			?>
            <div class="option-box">
                <p class="option-title"><?php echo ucfirst($meta_info['name']); ?></p>
                <p class="option-info"></p>
                <input type="text" size="30" placeholder=""   name="<?php echo $meta_info['meta_key']; ?>" value="<?php if(!empty(${$meta_info['meta_key']})) echo ${$meta_info['meta_key']}; ?>" />
            </div>
            <?php
			
			}
		
		
		
        ?>
        
        
        
        
        
        
        
        

        
       </div> <!-- // end of para-settings -->
        
        
		<?php

    }





public function meta_boxes_team_member_save_meta_fileds($post_id) {
 
        /*
         * We need to verify this came from the our screen and with 
         * proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if (!isset($_POST['team_member_nonce_check_value']))
            return $post_id;
 
        $nonce = $_POST['team_member_nonce_check_value'];
 
        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'team_member_nonce_check'))
            return $post_id;
 
        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
 
        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {
 
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
 
        } else {
 
            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }
 
        /* OK, its safe for us to save the data now. */
 
        // Sanitize the user input.
        $team_member_position = sanitize_text_field($_POST['team_member_position']); 
        $team_member_link_to_post = sanitize_text_field($_POST['team_member_link_to_post']);
	
 
        // Update the meta field.
        update_post_meta($post_id, 'team_member_position', $team_member_position);		
        update_post_meta($post_id, 'team_member_link_to_post', $team_member_link_to_post);
		
		
		$team_member_meta_fields = get_option('team_member_meta_fields');
		
		if(empty($team_member_meta_fields)){
				$team_member_meta_fields = array(
											'address' => array('name'=>'Address','meta_key'=>'team_address'),
											//'mobile' => array('name'=>'Mobile','meta_key'=>'team_mobile'),											
										);
			
			}
		
		foreach($team_member_meta_fields as $meta_key=>$meta_info){
			
				$meta_key = $meta_info['meta_key'];

				$meta_key_value = sanitize_text_field($_POST[$meta_key]); 
				update_post_meta($post_id, $meta_key, $meta_key_value);
				
			}
		
		
		
		
		
		
    }
	





	
	
	
	
	public function meta_boxes_team_member_social($post_type) {
			$post_types = array('team_member');
	 
			//limit meta box to certain post types
			if (in_array($post_type, $post_types)) {
				add_meta_box('team_member_metabox',
				'Team Member Social Info',
				array($this, 'team_member_social_meta_box_function'),
				$post_type,
				'normal',
				'high');
			}
		}
		
		
	public function team_member_social_meta_box_function($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('team_member_nonce_check', 'team_member_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
        $team_member_social_links = get_post_meta($post -> ID, 'team_member_social_links', true);
		
		$team_member_social_field = get_option( 'team_member_social_field' );
		
 		//var_dump($team_member_social_field);
		
		if(empty($team_member_social_field))
			{
				$class_team_functions = new class_team_functions();
				$team_member_social_field = $class_team_functions->team_member_social_field();
				
			}
 
        // Display the form, using the current value.
		
		echo '<div class="para-settings">';

		foreach ($team_member_social_field as $field_key=>$field_info) {
			if(!empty($field_key))
				{
					if($field_key == 'skype')
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php _e(' Member Skype.','team'); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="skypeusername"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}

					else if($field_key == 'mobile')
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php _e(' Member Mobile .','team'); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="+01895632456"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}						

					else if($field_key == 'phone')
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php _e(' Member Telephone .','team'); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="+01895632456"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}						

					else if($field_key == 'email')
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php _e(' Member Email.','team'); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="hello@exapmle.com"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}
					else if($field_key == 'website')
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php _e(' Member Website.','team'); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="http://exapmle.com"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}
					else
						{
						?>
						
                        <div class="option-box">
                            <p class="option-title"><?php echo ucfirst($field_info['name']); ?></p>
                            <p class="option-info"></p>
                            <input type="text" size="30" placeholder="http://exapmle.com/username"   name="team_member_social_links[<?php echo $field_key; ?>]" value="<?php if(!empty($team_member_social_links[$field_key])) echo $team_member_social_links[$field_key]; ?>" />
                        </div> 
						
						<?php
						}					

                    }
            }



		echo '</div>'; // end of para-settings 

    }




public function meta_boxes_team_member_social_save($post_id) {
 
        /*
         * We need to verify this came from the our screen and with 
         * proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if (!isset($_POST['team_member_nonce_check_value']))
            return $post_id;
 
        $nonce = $_POST['team_member_nonce_check_value'];
 
        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'team_member_nonce_check'))
            return $post_id;
 
        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
 
        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {
 
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
 
        } else {
 
            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }
 
        /* OK, its safe for us to save the data now. */
 
        // Sanitize the user input.
        $team_member_social_links = stripslashes_deep($_POST['team_member_social_links']); 
 
        // Update the meta field.

        update_post_meta($post_id, 'team_member_social_links', $team_member_social_links);			
		
    }
	
	
	
	

	
/*
Team Post
*/	
	
	
	public function meta_boxes_team($post_type) {
			$post_types = array('team');
	 
			//limit meta box to certain post types
			if (in_array($post_type, $post_types)) {
				add_meta_box('team_metabox',
				'Team Options',
				array($this, 'team_meta_box_function'),
				$post_type,
				'normal',
				'high');
			}
		}
	public function team_meta_box_function($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('team_nonce_check', 'team_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
	$team_bg_img = get_post_meta( $post->ID, 'team_bg_img', true );
	$team_container_bg_color = get_post_meta( $post->ID, 'team_container_bg_color', true );	
	
	$team_themes = get_post_meta( $post->ID, 'team_themes', true );
	$team_social_icon_style = get_post_meta( $post->ID, 'team_social_icon_style', true );	
	$team_masonry_enable = get_post_meta( $post->ID, 'team_masonry_enable', true );	
	
	$team_grid_item_align = get_post_meta( $post->ID, 'team_grid_item_align', true );	
	$team_item_text_align = get_post_meta( $post->ID, 'team_item_text_align', true );	
	$team_total_items = get_post_meta( $post->ID, 'team_total_items', true );	
	$team_pagination_display = get_post_meta( $post->ID, 'team_pagination_display', true );	

	$team_query_order = get_post_meta( $post->ID, 'team_query_order', true );
	$team_query_orderby = get_post_meta( $post->ID, 'team_query_orderby', true );


	$team_content_source = get_post_meta( $post->ID, 'team_content_source', true );
	
	if(empty($team_content_source))
		{
			$team_content_source = 'latest';
		}
	
	
	$team_content_year = get_post_meta( $post->ID, 'team_content_year', true );
	$team_content_month = get_post_meta( $post->ID, 'team_content_month', true );
	$team_content_month_year = get_post_meta( $post->ID, 'team_content_month_year', true );	


	$team_taxonomy_terms = get_post_meta( $post->ID, 'team_taxonomy_terms', true );
	
	$team_post_ids = get_post_meta( $post->ID, 'team_post_ids', true );	

	
	
	
	$team_items_title_color = get_post_meta( $post->ID, 'team_items_title_color', true );	
	$team_items_title_font_size = get_post_meta( $post->ID, 'team_items_title_font_size', true );

	$team_items_position_color = get_post_meta( $post->ID, 'team_items_position_color', true );
	$team_items_position_font_size = get_post_meta( $post->ID, 'team_items_position_font_size', true );

	$team_pagination_bg_color = get_post_meta( $post->ID, 'team_pagination_bg_color', true );
	$team_pagination_active_bg_color = get_post_meta( $post->ID, 'team_pagination_active_bg_color', true );


	$team_items_content = get_post_meta( $post->ID, 'team_items_content', true );
	if(empty($team_items_content))
		{
			$team_items_content = 'excerpt';
		}
	
	$team_items_content_color = get_post_meta( $post->ID, 'team_items_content_color', true );	
	$team_items_content_font_size = get_post_meta( $post->ID, 'team_items_content_font_size', true );		

	$team_items_excerpt_count = get_post_meta( $post->ID, 'team_items_excerpt_count', true );	
	$team_items_excerpt_text = get_post_meta( $post->ID, 'team_items_excerpt_text', true );	
	
	$team_items_thumb_size = get_post_meta( $post->ID, 'team_items_thumb_size', true );
	$team_items_link_to_post = get_post_meta( $post->ID, 'team_items_link_to_post', true );	
	$team_items_max_width = get_post_meta( $post->ID, 'team_items_max_width', true );
	$team_items_width_mobile = get_post_meta( $post->ID, 'team_items_width_mobile', true );	
	$team_items_width_tablet = get_post_meta( $post->ID, 'team_items_width_tablet', true );			
		
	$team_items_thumb_max_hieght = get_post_meta( $post->ID, 'team_items_thumb_max_hieght', true );	
	
	$team_items_margin = get_post_meta( $post->ID, 'team_items_margin', true );		
	$team_items_social_icon_width = get_post_meta( $post->ID, 'team_items_social_icon_width', true );	
	$team_items_social_icon_height = get_post_meta( $post->ID, 'team_items_social_icon_height', true );	
	
	$team_items_custom_css = get_post_meta( $post->ID, 'team_items_custom_css', true );
 
	$team_items_popup_content = get_post_meta( $post->ID, 'team_items_popup_content', true );

	$team_items_popup_excerpt_count = get_post_meta( $post->ID, 'team_items_popup_excerpt_count', true );
	$team_items_popup_excerpt_text = get_post_meta( $post->ID, 'team_items_popup_excerpt_text', true );
	$team_items_popup_width = get_post_meta( $post->ID, 'team_items_popup_width', true );
	$team_items_popup_height = get_post_meta( $post->ID, 'team_items_popup_height', true );

	if(empty($team_items_popup_content))
		{
			$team_items_popup_content = 'full';
		}




	$team_grid_items = get_post_meta( $post->ID, 'team_grid_items', true );
	$team_grid_items_hide = get_post_meta( $post->ID, 'team_grid_items_hide', true );		
	$team_grid_meta_keys = get_post_meta( $post->ID, 'team_grid_meta_keys', true );
	
	$team_items_skill_bg_color = get_post_meta( $post->ID, 'team_items_skill_bg_color', true );	
	
 

 
 
 
 
 
 
	// Display the form, using the current value.
	$class_team_functions = new class_team_functions();
	
	$team_id = $post->ID;
		
		?>
        
        
        <div class="para-settings">
            <ul class="tab-nav">
            <li nav="1" class="nav1 active"><i class="fa fa-code"></i> <?php _e('Shortcode','team'); ?></li>        
            <li nav="2" class="nav2"><i class="fa fa-cogs"></i> <?php _e('Options','team'); ?></li>
            <li nav="3" class="nav3"><i class="fa fa-diamond"></i> <?php _e('Style','team'); ?></li>
            <li nav="4" class="nav4"><i class="fa fa-users"></i> <?php _e('Query Member','team'); ?></li>          
            <li nav="5" class="nav5"><i class="fa fa-bug"></i> <?php _e('Custom CSS','team'); ?></li>
            <li nav="7" class="nav6"><i class="fa fa-qrcode"></i> <?php _e('Layout Builder','team'); ?></li>

        </ul> <!-- tab-nav end -->
		<ul class="box">
        
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-title"><?php _e('Shortcode.','team'); ?></p>
                    <p class="option-info"><?php _e('Copy this shortcode and paste on page or post where you want to display Team. <br />Use PHP code to your themes file to display Team.','team'); ?></p>
					<textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[team <?php echo 'id="'.$post->ID.'"';?>]</textarea><br />
					<textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[team id='; echo "'".$post->ID."']"; echo '"); ?>'; ?></textarea>  

                </div> 
            
            </li>    
        
        
            <li style="display: none;" class="box2 tab-box">
				<div class="option-box">
                    <p class="option-title"><?php _e('Total number of members on each page(pagination).','team'); ?></p>
                    <p class="option-info"><?php _e('You can display pagination or Total number of member on grid.','team'); ?></p>
                    <input type="text" placeholder="ex:5 - Number Only"   name="team_total_items" value="<?php if(!empty($team_total_items))echo $team_total_items; else echo 5; ?>" />
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Display Pagination</p>
                    <p class="option-info"></p>
                    
					<select name="team_pagination_display"  >
                    <option value="no" <?php if($team_pagination_display=="no")echo "selected"; ?>>No</option>
                    <option value="yes" <?php if($team_pagination_display=="yes")echo "selected"; ?>>Yes</option>
                                      
                    </select>
                  
                </div>  
                
                
                
                
                
     
                          
				<div class="option-box">
                    <p class="option-title"><?php _e('Link to Member.','team'); ?></p>
                    <p class="option-info"><?php _e('Clickable link to post team member.','team'); ?></p>
                    <select name="team_items_link_to_post" >
                   		<option value="no" <?php if($team_items_link_to_post=="no")echo "selected"; ?>>No</option>
                    	<option value="yes" <?php if($team_items_link_to_post=="yes")echo "selected"; ?>>Custom Post</option>
                        <option value="custom" <?php if($team_items_link_to_post=="custom")echo "selected"; ?>>Custom Link</option>
                    </select>
                </div>   


				<div class="option-box">
                    <p class="option-title"><?php _e('Grid item max Width(px).','team'); ?></p>
                    <p class="option-info"><?php _e('Maximum width for grid items.','team'); ?></p>
                    
                    <div>
                    <?php _e('For Destop: (min-width:1024px)','team'); ?> <br/>
					<input type="text" name="team_items_max_width" placeholder="ex:150px, px or %" id="team_items_max_width" value="<?php if(!empty($team_items_max_width)) echo $team_items_max_width; else echo "280px"; ?>" />
                    </div>
					
                    <br>

					<div>
                    <?php _e('For Tablet: ( min-width:768px )','team'); ?> <br/>
					<input type="text" name="team_items_width_tablet" placeholder="ex:150px, px or %" id="team_items_width_tablet" value="<?php if(!empty($team_items_width_tablet)) echo $team_items_width_tablet; else echo "45%"; ?>" />                    
                    </div> 
                    <br>
                    
                    <div>             
                    <?php _e('For Mobile: ( min-width : 320px, )','team'); ?> <br/>
					<input type="text" name="team_items_width_mobile" placeholder="ex:150px, px or %" id="team_items_width_mobile" value="<?php if(!empty($team_items_width_mobile)) echo $team_items_width_mobile; else echo "90%"; ?>" />
                    </div>                   
                                      
                    
                    
                    
                    
                </div> 




				<div class="option-box">
                    <p class="option-title"><?php _e('Grid Items Margin (px).','team'); ?></p>
                    <p class="option-info"><?php _e('You can use general CSS rules for margin, ex:10px, <br /> 10px 10px, <br /> 10px 10px 10px, <br /> 10px 10px 10px 10px.','team'); ?></p>
					<input type="text" name="team_items_margin" placeholder="ex:20px number with px" id="team_items_margin" value="<?php if(!empty($team_items_margin)) echo $team_items_margin; else echo "15px"; ?>" />
				</div>

            
 
				<div class="option-box">
                    <p class="option-title"><?php _e('Grid Items Text Align.','team'); ?></p>
                    <p class="option-info"></p>
                    <select id="team_item_text_align" name="team_item_text_align"  >
                    <option class="team_item_text_align" value="left" <?php if($team_item_text_align=="left")echo "selected"; ?>>Left</option>
                    
                    <option class="team_item_text_align" value="center" <?php if($team_item_text_align=="center")echo "selected"; ?>>Center</option>
                    
                    <option class="team_item_text_align" value="right" <?php if($team_item_text_align=="right")echo "selected"; ?>>Right</option>                    
                    </select>
				</div>  
            
            
            
            </li>
			<li style="display: none;" class="box3 tab-box">
				<div class="option-box">
                    <p class="option-title"><?php _e('Themes.','team'); ?></p>
                    <p class="option-info"><?php _e('Themes for Team grid.','team'); ?></p>
                    <?php
					
					
					
						$team_themes_list = $class_team_functions->team_themes();


					?>
                    
                    
                    
                    <select name="team_themes"  >
                    
                    <?php
                    	
						foreach($team_themes_list as $key => $value)
							{
								?>
                                <option value="<?php echo $key; ?>" <?php if($team_themes== $key )echo "selected"; ?>><?php echo $value; ?></option>
                                
                                <?php
								
								
							}
					
					?>

                    </select>
				</div>
            
            
            
            
            
            
            
            
				<div class="option-box">
                    <p class="option-title"><?php _e('Active Masonry Grid.','team'); ?></p>
                    <p class="option-info"><?php _e('Masonry Style grid.','team'); ?></p>
                    <select name="team_masonry_enable"  >
                    <option  value="no" <?php if($team_masonry_enable=="no")echo "selected"; ?>><?php _e('No','team'); ?></option>
                    <option  value="yes" <?php if($team_masonry_enable=="yes")echo "selected"; ?>><?php _e('Yes','team'); ?></option>
             
                    </select>
				</div>            
            

            
            
  
            
            
				             

<div class="option-box">
                	<p class="option-title"><?php _e('Container Options.','team'); ?></p>
                    <p class="option-info"><?php _e('Background image:','team'); ?></p>
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo team_plugin_url; ?>assets/global/images/bg/dark_embroidery.png" />
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo team_plugin_url; ?>assets/global/images/bg/dimension.png" />
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo team_plugin_url; ?>assets/global/images/bg/eight_horns.png" /> 
                    <br />                    
                    <input type="text" id="team_bg_img" class="team_bg_img" name="team_bg_img" value="<?php echo $team_bg_img; ?>" /> <div onClick="clear_container_bg_image()" class="button clear-container-bg-image"> <?php _e('Clear','team'); ?></div>
                    
                    <script>
					
					function bg_img_src(img){
						
						src =img.src;
						
						document.getElementById('team_bg_img').value  = src;
						
						}
					
					function clear_container_bg_image(){

						document.getElementById('team_bg_img').value  = '';
						
						}					
					
					
					</script>
                    
                    <p class="option-info"><?php _e('Background color:','team'); ?></p>
                    <input type="text" name="team_container_bg_color" class="team_color" value="<?php if(!empty($team_container_bg_color)) echo $team_container_bg_color; ?>" />
                    
                    
                    <p class="option-info"><?php _e('Text align:','team'); ?></p>
                    <select id="team_grid_item_align" name="team_grid_item_align"  >
                    <option class="team_grid_item_align" value="left" <?php if($team_grid_item_align=="left")echo "selected"; ?>>Left</option>
                    
                    <option class="team_grid_item_align" value="center" <?php if($team_grid_item_align=="center")echo "selected"; ?>>Center</option>
                    
                    <option class="team_grid_item_align" value="right" <?php if($team_grid_item_align=="right")echo "selected"; ?>>Right</option>                    
                    </select>
                    
                </div>


				<div class="option-box">
                    <p class="option-title"><?php _e('Pagination.','team'); ?></p>
                    <p class="option-info"><?php _e('Pagination default background color.','team'); ?></p>
                    <input type="text" name="team_pagination_bg_color" id="team_pagination_bg_color" value="<?php if(!empty($team_pagination_bg_color)) echo $team_pagination_bg_color; else echo "#2eb3f8"; ?>" />
                    
                    
                    <p class="option-info"><?php _e('Pagination active background color.','team'); ?></p>
                    <input type="text" name="team_pagination_active_bg_color" id="team_pagination_active_bg_color" value="<?php if(!empty($team_pagination_active_bg_color)) echo $team_pagination_active_bg_color; else echo "#249bd9"; ?>" />
                    
				</div>


            
            </li>
			<li style="display: none;" class="box4 tab-box">
            
            
            

            
            
            
				<div class="option-box">
                    <p class="option-title"><?php _e('Query orderby','team'); ?></p>
                    <p class="option-info"></p>
                    <select name="team_query_orderby" >
                    <option value="none" <?php if($team_query_orderby=="none") echo "selected"; ?>>None</option>
                    <option value="ID" <?php if($team_query_orderby=="ID") echo "selected"; ?>>ID</option>
                    <option value="date" <?php if($team_query_orderby=="date") echo "selected"; ?>>Date</option>
                    <option value="rand" <?php if($team_query_orderby=="rand") echo "selected"; ?>>Rand</option>
                    <option value="title" <?php if($team_query_orderby=="title") echo "selected"; ?>>Title(post title)</option>
                    <option value="name" <?php if($team_query_orderby=="name") echo "selected"; ?>>Name(post slug)</option>                          
                    
                    
               

                    </select>
                </div> 
            
            
            
            
            
				<div class="option-box">
                    <p class="option-title"><?php _e('Query order','team'); ?></p>
                    <p class="option-info"></p>
                    <select name="team_query_order" >
                    <option value="ASC" <?php if($team_query_order=="ASC") echo "selected"; ?>>ASC</option>
                    <option value="DESC" <?php if($team_query_order=="DESC") echo "selected"; ?>>DESC</option>

                    </select>
                </div>
            
				<div class="option-box">
                    <p class="option-title"><?php _e('Filter Member.','team'); ?></p>
                    <p class="option-info"></p>
<ul class="content_source_area" >

            <li><input class="team_content_source" name="team_content_source" id="team_content_source_latest" type="radio" value="latest" <?php if($team_content_source=="latest")  echo "checked";?> /> <label for="team_content_source_latest"><?php _e('Display from Latest Published Member.','team'); ?></label>
            <div class="team_content_source_latest content-source-box"><?php _e('Team items will query from latest published Members.','team'); ?></div>
            </li>

            <li><input class="team_content_source" name="team_content_source" id="team_content_source_year" type="radio" value="year" <?php if($team_content_source=="year")  echo "checked";?> /> <label for="team_content_source_year"><?php _e('Display from Only Year.','team'); ?></label>
            
            <div class="team_content_source_year content-source-box"><?php _e('Member items will query from a year.','team'); ?>
            <input type="text" size="7" class="team_content_year" name="team_content_year" value="<?php if(!empty($team_content_year))  echo $team_content_year;?>" placeholder="2014" />
            </div>
            </li>
            
            
            <li><input class="team_content_source" name="team_content_source" id="team_content_source_month" type="radio" value="month" <?php if($team_content_source=="month")  echo "checked";?> /> <label for="team_content_source_month"><?php _e('Display from Month.','team'); ?></label>
            
            <div class="team_content_source_month content-source-box"><?php _e('Member items will query from Month of a year.','team'); ?><br />
			<input type="text" size="7" class="team_content_month_year" name="team_content_month_year" value="<?php if(!empty($team_content_month_year))  echo $team_content_month_year;?>" placeholder="2014" />            
			<input type="text" size="7" class="team_content_month" name="team_content_month" value="<?php if(!empty($team_content_month))  echo $team_content_month;?>" placeholder="06" />
            </div>
            </li>            

            </ul>
            </div>
            
            
            
            
            
            
            
            </li>

            <li style="display: none;" class="box5 tab-box">
				<div class="option-box">
                    <p class="option-title"><?php _e('Custom CSS for this Team Grid.','team'); ?></p>
                    <p class="option-info"><?php _e('Do not use &lt;style>&lt;/style> tag, you can use bellow prefix to your css, sometime you need use "!important" to overrid.','team'); ?>
                    <br/>
                    <b>#team-<?php echo $team_id ; ?></b>
                    </p>
                   	<?php
                    
					$empty_css_sample = '.team-container #team-'.$team_id.'{}\n.team-container #team-'.$team_id.' .team-item{}\n.team-container #team-'.$team_id.' .team-thumb{}\n.team-container #team-'.$team_id.' .team-title{}\n.team-container #team-'.$team_id.' .team-content{}';
					
					
					?>

                    <textarea style="width:80%; min-height:150px" name="team_items_custom_css"><?php if(!empty($team_items_custom_css)) echo htmlentities($team_items_custom_css); else echo str_replace('\n', PHP_EOL, $empty_css_sample); ?></textarea>
                    
				</div>
            
            
            </li>
            
                      
            
            <li style="display: none;" class="box7 tab-box">
				<div class="option-box">
                    <p class="option-title"><?php _e('Layout builder','team'); ?></p>
                    <p class="option-info"><?php _e('You can sort grid items from here.','team'); ?></p>
                    
                    <div class="team-grid-builder">
                    
                    <?php
                    $class_team_functions = new class_team_functions();
					
					if(empty($team_grid_items))
						{

							$team_grid_items = $class_team_functions->team_grid_items();

						}
					else
						{
							
							$team_grid_items = array_merge($team_grid_items,$class_team_functions->team_grid_items());
						}
					
					
					foreach($team_grid_items as $item_key=>$item_name)
						{
							echo '<div title="Click to expand" class="item"><div class="header">';
							echo '<label title="Checked to Hide on frontend">';
							
							
							if(!empty($team_grid_items_hide[$item_key]))
								{
									$checked = 'checked';
								}
							else
								{
									$checked = '';
								}
							echo '<input type="checkbox" title="Checked to Hide on frontend" '.$checked.' value="yes" name="team_grid_items_hide['.$item_key.']" />';				
							echo 'Hide on Frontend</label>';
							echo '<input type="hidden" name="team_grid_items['.$item_key.']" value="'.$item_name.'"/>';
							echo $item_name.'</div>';
							
							if($item_key == 'meta')
								{
									echo '<div class="item-option"><br/>';
									echo '<b>'.__('Meta key\'s','team').'</b> <br />'.__('Separtates by comma','team').'<br/>';
									
									if(empty($team_grid_meta_keys))
										{
											$team_grid_meta_keys = 'dummy';	
										}
									echo '<input type="text" placeholder="meta_key_1,meta_key_2" name="team_grid_meta_keys" value="'.$team_grid_meta_keys.'" size="20"/>';
									echo '</div>';
								}
							elseif($item_key == 'thumbnail'){
								
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Thumbnail Size.','team'); ?></p>
                                        <p class="option-info"><?php _e('Thumbnail size of member on grid.','team'); ?></p>
                                        <select name="team_items_thumb_size" >
                                        <option value="none" <?php if($team_items_thumb_size=="none")echo "selected"; ?>><?php _e('None','team'); ?></option>
                                        <option value="thumbnail" <?php if($team_items_thumb_size=="thumbnail")echo "selected"; ?>><?php _e('Thumbnail','team'); ?></option>
                                        <option value="medium" <?php if($team_items_thumb_size=="medium")echo "selected"; ?>><?php _e('Medium','team'); ?></option>
                                        <option value="large" <?php if($team_items_thumb_size=="large")echo "selected"; ?>><?php _e('Large','team'); ?></option>       
                                        <option value="full" <?php if($team_items_thumb_size=="full")echo "selected"; ?>><?php _e('Full','team'); ?></option>   
                                        </select>
                                    </div> 
                                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Grid item thumbnail max Height(px).','team'); ?></p>
                                        <p class="option-info"><?php _e('Maximum Height for grid items thumbnail.','team'); ?></p>
                                        <input type="text" name="team_items_thumb_max_hieght" placeholder="ex:150px number with px" id="team_items_thumb_max_hieght" value="<?php if(!empty($team_items_thumb_max_hieght)) echo $team_items_thumb_max_hieght; else echo "10000px"; ?>" />
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                <?php
								
							}								
								
							elseif($item_key == 'title'){
								
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Font Color.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_title_color" id="team_items_title_color" value="<?php if(!empty($team_items_title_color)) echo $team_items_title_color; else echo "#333"; ?>" />
                                    </div>
                                    
                                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Font Size.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_title_font_size" placeholder="ex:14px number with px" id="team_items_title_font_size" value="<?php if(!empty($team_items_title_font_size)) echo $team_items_title_font_size; else echo "14px"; ?>" />
                                    </div>
                                    
                                    
                                </div>
                                <?php
								
							}
								
							elseif($item_key == 'position'){
								
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Member Position Font Color.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_position_color" placeholder="#ffffff" id="team_items_position_color" value="<?php if(!empty($team_items_position_color)) echo $team_items_position_color; else echo "#333"; ?>" />
                                    </div>
                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Member Position Font Size.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_position_font_size" placeholder="ex:12px number with px" id="team_items_position_font_size" value="<?php if(!empty($team_items_position_font_size)) echo $team_items_position_font_size; else echo "13px"; ?>" />
                                    </div>
                                    
                                    
                                </div>
                                <?php
							}		
							
							elseif($item_key == 'social'){
								
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Social icons size(px).','team'); ?></p>
                                        <p class="option-info"><?php _e('you can change social icons height & width here.','team'); ?></p>					Width:<br />
                                        <input type="text" name="team_items_social_icon_width" placeholder="ex:20px number with px"  value="<?php if(!empty($team_items_social_icon_width)) echo $team_items_social_icon_width; else echo "25px"; ?>" />
                                        <br />
                                        Height:<br/>
                                        <input type="text" name="team_items_social_icon_height" placeholder="ex:20px number with px"  value="<?php if(!empty($team_items_social_icon_height)) echo $team_items_social_icon_height; else echo "25px"; ?>" />
                                    </div>            
                                
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Social icon style.','team'); ?></p>
                                        <p class="option-info"><?php _e('','team'); ?></p>
                                        <select name="team_social_icon_style"  >
                                        <option  value="flat" <?php if($team_social_icon_style=="flat")echo "selected"; ?>><?php _e('Flat','team'); ?></option>
                                        <option  value="rounded" <?php if($team_social_icon_style=="rounded")echo "selected"; ?>><?php _e('Rounded','team'); ?></option>
                                        <option  value="rounded-border" <?php if($team_social_icon_style=="rounded-border")echo "selected"; ?>><?php _e('Rounded Border','team'); ?></option>                    
                                        <option  value="semi-rounded" <?php if($team_social_icon_style=="semi-rounded")echo "selected"; ?>><?php _e('Semi Rounded','team'); ?></option>
                                        </select>
                                    </div>
                                    
                                    
                                </div>
                                <?php
							}							
							
							
							
							
							
							
							
													
							elseif($item_key == 'content'){
								
								?>
                                <div class="item-option">

                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Member Bio Content Display.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <ul class="content_source_area" >
                                            <li>
                                                <input class="team_content_source" name="team_items_content" id="team_items_content" type="radio" value="full" <?php if($team_items_content=="full")  echo "checked";?> /> 
                                                <label for="team_items_content"><?php _e('Display full content.','team'); ?></label>
                                                <div class="team_items_content content-source-box">
                                                <?php _e('Member bio content will display from full content.','team'); ?>
                                                </div>
                                            </li>
                                            <li>
                                                <input class="team_content_source" name="team_items_content" id="team_items_excerpt" type="radio" value="excerpt" <?php if($team_items_content=="excerpt")  echo "checked";?> /> 
                                                <label for="team_items_excerpt"><?php _e('Display excerpt','team'); ?></label>
                                                <div class="team_items_excerpt content-source-box">
                                                <?php _e('Member bio content will display from excerpt.','team'); ?><br />
                                                <?php _e('Excrept Length:','team'); ?>
                                                <input type="text" placeholder="25" size="4" name="team_items_excerpt_count" value="<?php if(!empty($team_items_excerpt_count))  echo $team_items_excerpt_count; else echo 30; ?>" />
                                                <br />
                                                <?php _e('Read More Text:','team'); ?>
                                                <input type="text" placeholder="Read More..." size="10" name="team_items_excerpt_text" value="<?php if(!empty($team_items_excerpt_text))  echo $team_items_excerpt_text; else echo 'Read More'; ?>" />
                                                
                                                </div>
                                            </li>                        
                    
                                        </ul>
                                    </div>

                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Font Color.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_content_color" id="team_items_content_color" value="<?php if(!empty($team_items_content_color)) echo $team_items_content_color; else echo "#333"; ?>" />
                                    </div>
                    
                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Font Size.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" placeholder="ex:12px number with px" name="team_items_content_font_size" id="team_items_content_font_size" value="<?php if(!empty($team_items_content_font_size)) echo $team_items_content_font_size; else echo "13px"; ?>" />
                                    </div>
                                    
                                    
                                </div>
                                <?php
							}									
								
							elseif($item_key == 'popup'){
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Member Bio Popup Content Display.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <ul class="content_source_area" >
                                            <li>
                                                <input class="team_content_source" name="team_items_popup_content" id="team_items_popup_content" type="radio" value="full" <?php if($team_items_popup_content=="full")  echo "checked";?> /> 
                                                <label for="team_items_popup_content"><?php _e('Display full content.','team'); ?></label>
                                                <div class="team_items_popup_content content-source-box">
                                                <?php _e('Member bio content will display from full content.','team'); ?>
                                                </div>
                                            </li>
                                            
                                            
                                            <li>
                                                <input class="team_content_source" name="team_items_popup_content" id="team_items_popup_excerpt" type="radio" value="excerpt" <?php if($team_items_popup_content=="excerpt")  echo "checked";?> /> 
                                                <label for="team_items_popup_excerpt"><?php _e('Display excerpt.','team'); ?></label>
                                                <div class="team_items_popup_excerpt content-source-box">
                                                <?php _e('Member bio content will display from excerpt.','team'); ?><br />
                                                <?php _e('Excrept Length:','team'); ?>
                                                <input type="text" placeholder="25" size="4" name="team_items_popup_excerpt_count" value="<?php if(!empty($team_items_popup_excerpt_count))  echo $team_items_popup_excerpt_count; else echo '25'; ?>" />
                                                <br />
                                                <?php _e('Read More Text:','team'); ?> 
                                                <input type="text" placeholder="Read More..." size="10" name="team_items_popup_excerpt_text" value="<?php if(!empty($team_items_popup_excerpt_text))  echo $team_items_popup_excerpt_text; else echo 'Read More'; ?>" />
                                                
                                                </div>
                                            </li>                        
                    
                                        </ul>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Popup box width.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" placeholder="80%" name="team_items_popup_width" id="team_items_popup_width" value="<?php if(!empty($team_items_popup_width)) echo $team_items_popup_width; else echo "80%"; ?>" />
                                    </div>
                                    
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Popup box height.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" placeholder="70%" name="team_items_popup_height" id="team_items_popup_height" value="<?php if(!empty($team_items_popup_height)) echo $team_items_popup_height; else echo "70%"; ?>" />
                                    </div>                                   
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                <?php
								
								
								
								
								
								
								
								
								}	
							elseif($item_key == 'skill'){
								?>
                                <div class="item-option">
                                    <div class="option-box">
                                        <p class="option-title"><?php _e('Font Color.','team'); ?></p>
                                        <p class="option-info"></p>
                                        <input type="text" name="team_items_skill_bg_color" id="team_items_skill_bg_color" value="<?php if(!empty($team_items_skill_bg_color)) echo $team_items_skill_bg_color; else echo "#399fe7"; ?>" />
                                    </div>
                                </div>
                                
                                <?php
								
							}
								
							
							
							echo '</div>';
						}
					
					?>
                    

                        
                    </div>
                    
 <script>
 jQuery(document).ready(function($)
	{
$(function() {
$( ".team-grid-builder" ).sortable();
//$( ".items-container" ).disableSelection();
});

})

</script>
				</div>
            </li>



            
            
		</ul><!-- box end -->
        
    </div>
    


    
			<script>
				jQuery(document).ready(function($){
					$('#team_items_position_color, #team_items_content_color, #team_items_title_color ').wpColorPicker();
				});
			</script>
    
    
    
    <?php
		
		
		
		

    }
	
	
public function meta_boxes_team_save($post_id) {
 
        /*
         * We need to verify this came from the our screen and with 
         * proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if (!isset($_POST['team_nonce_check_value']))
            return $post_id;
 
        $nonce = $_POST['team_nonce_check_value'];
 
        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'team_nonce_check'))
            return $post_id;
 
        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
 
        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {
 
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
 
        } else {
 
            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }
 
        /* OK, its safe for us to save the data now. */
 
  // Sanitize user input.
	$team_bg_img = sanitize_text_field( $_POST['team_bg_img'] );
	$team_container_bg_color = sanitize_text_field( $_POST['team_container_bg_color'] );	
	
	$team_themes = sanitize_text_field( $_POST['team_themes'] );
	$team_social_icon_style = sanitize_text_field( $_POST['team_social_icon_style'] );	
	$team_masonry_enable = sanitize_text_field( $_POST['team_masonry_enable'] );	
	
	$team_grid_item_align = sanitize_text_field( $_POST['team_grid_item_align'] );	
	$team_item_text_align = sanitize_text_field( $_POST['team_item_text_align'] );	
	$team_total_items = sanitize_text_field( $_POST['team_total_items'] );		
	$team_pagination_display = sanitize_text_field( $_POST['team_pagination_display'] );

	$team_items_content = sanitize_text_field( $_POST['team_items_content'] );
	$team_items_excerpt_count = sanitize_text_field( $_POST['team_items_excerpt_count'] );	
	$team_items_excerpt_text = sanitize_text_field( $_POST['team_items_excerpt_text'] );	
	
	$team_query_order = sanitize_text_field( $_POST['team_query_order'] );	
	$team_query_orderby = sanitize_text_field( $_POST['team_query_orderby'] );		
	
	$team_content_source = sanitize_text_field( $_POST['team_content_source'] );
	$team_content_year = sanitize_text_field( $_POST['team_content_year'] );
	$team_content_month = sanitize_text_field( $_POST['team_content_month'] );
	$team_content_month_year = sanitize_text_field( $_POST['team_content_month_year'] );
		
	if(empty($_POST['team_taxonomy_terms']))
		{
			$_POST['team_taxonomy_terms'] = '';
		}
		
	$team_taxonomy_terms = stripslashes_deep( $_POST['team_taxonomy_terms'] );
	
	if(empty($_POST['team_post_ids']))
		{
			$_POST['team_post_ids'] = '';
		}
		
	$team_post_ids = stripslashes_deep( $_POST['team_post_ids'] );	

	
	$team_items_title_color = sanitize_text_field( $_POST['team_items_title_color'] );	
	$team_items_title_font_size = sanitize_text_field( $_POST['team_items_title_font_size'] );	

	$team_items_position_color = sanitize_text_field( $_POST['team_items_position_color'] );
	$team_items_position_font_size = sanitize_text_field( $_POST['team_items_position_font_size'] );	

	$team_items_content_color = sanitize_text_field( $_POST['team_items_content_color'] );	
	$team_items_content_font_size = sanitize_text_field( $_POST['team_items_content_font_size'] );	
	
	$team_pagination_bg_color = sanitize_text_field( $_POST['team_pagination_bg_color'] );	
	$team_pagination_active_bg_color = sanitize_text_field( $_POST['team_pagination_active_bg_color'] );	

	$team_items_thumb_size = sanitize_text_field( $_POST['team_items_thumb_size'] );
	$team_items_link_to_post = sanitize_text_field( $_POST['team_items_link_to_post'] );	
	$team_items_max_width = sanitize_text_field( $_POST['team_items_max_width'] );
	$team_items_width_mobile = sanitize_text_field( $_POST['team_items_width_mobile'] );
	$team_items_width_tablet = sanitize_text_field( $_POST['team_items_width_tablet'] );	
	
	$team_items_thumb_max_hieght = sanitize_text_field( $_POST['team_items_thumb_max_hieght'] );	
	
	$team_items_margin = sanitize_text_field( $_POST['team_items_margin'] );	
	$team_items_social_icon_width = sanitize_text_field( $_POST['team_items_social_icon_width'] );	
	$team_items_social_icon_height = sanitize_text_field( $_POST['team_items_social_icon_height'] );
				
	$team_items_custom_css = sanitize_text_field( $_POST['team_items_custom_css'] );
	
	
	$team_items_popup_content = sanitize_text_field( $_POST['team_items_popup_content'] );
	$team_items_popup_excerpt_count = sanitize_text_field( $_POST['team_items_popup_excerpt_count'] );
	$team_items_popup_excerpt_text = sanitize_text_field( $_POST['team_items_popup_excerpt_text'] );
	$team_items_popup_width = sanitize_text_field( $_POST['team_items_popup_width'] );
	$team_items_popup_height = sanitize_text_field( $_POST['team_items_popup_height'] );



 
	$team_grid_items = stripslashes_deep( $_POST['team_grid_items'] ); 
	$team_grid_items_hide = stripslashes_deep( $_POST['team_grid_items_hide'] ); 
	$team_grid_meta_keys = sanitize_text_field( $_POST['team_grid_meta_keys'] ); 
 
 	$team_items_skill_bg_color = sanitize_text_field( $_POST['team_items_skill_bg_color'] ); 
 
 
 
  // Update the meta field in the database.
	update_post_meta( $post_id, 'team_bg_img', $team_bg_img );
	update_post_meta( $post_id, 'team_container_bg_color', $team_container_bg_color );	
	
	update_post_meta( $post_id, 'team_themes', $team_themes );
	update_post_meta( $post_id, 'team_social_icon_style', $team_social_icon_style );	
	update_post_meta( $post_id, 'team_masonry_enable', $team_masonry_enable );	
	
	update_post_meta( $post_id, 'team_grid_item_align', $team_grid_item_align );	
	update_post_meta( $post_id, 'team_item_text_align', $team_item_text_align );	
	update_post_meta( $post_id, 'team_total_items', $team_total_items );	
	update_post_meta( $post_id, 'team_pagination_display', $team_pagination_display );

	update_post_meta( $post_id, 'team_query_order', $team_query_order );
	update_post_meta( $post_id, 'team_query_orderby', $team_query_orderby );

	update_post_meta( $post_id, 'team_items_content', $team_items_content );
	update_post_meta( $post_id, 'team_items_excerpt_count', $team_items_excerpt_count );	
	update_post_meta( $post_id, 'team_items_excerpt_text', $team_items_excerpt_text );	

	update_post_meta( $post_id, 'team_content_source', $team_content_source );
	update_post_meta( $post_id, 'team_content_year', $team_content_year );
	update_post_meta( $post_id, 'team_content_month', $team_content_month );
	update_post_meta( $post_id, 'team_content_month_year', $team_content_month_year );	


	update_post_meta( $post_id, 'team_taxonomy_terms', $team_taxonomy_terms );

	update_post_meta( $post_id, 'team_post_ids', $team_post_ids );	



	update_post_meta( $post_id, 'team_items_title_color', $team_items_title_color );
	update_post_meta( $post_id, 'team_items_title_font_size', $team_items_title_font_size );

	update_post_meta( $post_id, 'team_items_position_color', $team_items_position_color );
	update_post_meta( $post_id, 'team_items_position_font_size', $team_items_position_font_size );	

	update_post_meta( $post_id, 'team_items_content_color', $team_items_content_color );
	update_post_meta( $post_id, 'team_items_content_font_size', $team_items_content_font_size );

	update_post_meta( $post_id, 'team_pagination_bg_color', $team_pagination_bg_color );
	update_post_meta( $post_id, 'team_pagination_active_bg_color', $team_pagination_active_bg_color );

	update_post_meta( $post_id, 'team_items_thumb_size', $team_items_thumb_size );
	update_post_meta( $post_id, 'team_items_link_to_post', $team_items_link_to_post );	
	update_post_meta( $post_id, 'team_items_max_width', $team_items_max_width );
	update_post_meta( $post_id, 'team_items_width_mobile', $team_items_width_mobile );
	update_post_meta( $post_id, 'team_items_width_tablet', $team_items_width_tablet );
	
	update_post_meta( $post_id, 'team_items_thumb_max_hieght', $team_items_thumb_max_hieght );
	
	update_post_meta( $post_id, 'team_items_margin', $team_items_margin );
	update_post_meta( $post_id, 'team_items_social_icon_width', $team_items_social_icon_width );	
	update_post_meta( $post_id, 'team_items_social_icon_height', $team_items_social_icon_height );
	
	update_post_meta( $post_id, 'team_items_custom_css', $team_items_custom_css );
	
	
	update_post_meta( $post_id, 'team_items_popup_content', $team_items_popup_content );	
	update_post_meta( $post_id, 'team_items_popup_excerpt_count', $team_items_popup_excerpt_count );	
	update_post_meta( $post_id, 'team_items_popup_excerpt_text', $team_items_popup_excerpt_text );	
	update_post_meta( $post_id, 'team_items_popup_width', $team_items_popup_width );		
	update_post_meta( $post_id, 'team_items_popup_height', $team_items_popup_height );	
	

	
	update_post_meta( $post_id, 'team_grid_items', $team_grid_items );
	update_post_meta( $post_id, 'team_grid_items_hide', $team_grid_items_hide );
	update_post_meta( $post_id, 'team_grid_meta_keys', $team_grid_meta_keys );
	
	update_post_meta( $post_id, 'team_items_skill_bg_color', $team_items_skill_bg_color );	
	
		
    }	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}
	
	new team_class_post_meta();