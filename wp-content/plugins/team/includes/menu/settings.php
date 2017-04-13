<?php	

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 	



if(empty($_POST['team_hidden'])){
		$team_member_slug = get_option( 'team_member_slug' );		
		$team_member_meta_fields = get_option( 'team_member_meta_fields' );		
		$team_member_social_field = get_option( 'team_member_social_field' );

	}
else{	
		if($_POST['team_hidden'] == 'Y') {
			//Form data sent

			$team_member_slug = sanitize_text_field($_POST['team_member_slug']);
			update_option('team_member_slug', $team_member_slug);
			
			if(empty($_POST['team_member_meta_fields'])){
				
				$_POST['team_member_meta_fields'] = array();
				}
			$team_member_meta_fields = stripslashes_deep($_POST['team_member_meta_fields']);
			update_option('team_member_meta_fields', $team_member_meta_fields);

			$team_member_social_field = stripslashes_deep($_POST['team_member_social_field']);
			update_option('team_member_social_field', $team_member_social_field);

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'team' ); ?></strong></p></div>
	
			<?php
			} 
	}
	



	$class_team_functions = new class_team_functions();
	$default_social_field = $class_team_functions->team_member_social_field();

?>


<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(team_plugin_name.' Settings', 'team')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="team_hidden" value="Y">
        <?php settings_fields( 'team_plugin_options' );
				do_settings_sections( 'team_plugin_options' );
			
		?>

    <div class="para-settings team-settings">
    
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active"><i class="fa fa-cogs"></i> Options</li>       
            <li nav="2" class="nav2"><i class="fa fa-hand-o-right"></i> Help & Support</li>    
        </ul> <!-- tab-nav end --> 
		<ul class="box">
       		<li style="display: block;" class="box1 tab-box active">
            
                <div class="option-box">
                    <p class="option-title"><?php _e('Team member slug.','team'); ?></p>
                    <p class="option-info"><?php _e('ex: volunteers','team'); ?></p>   
					<input type="text" size="30" placeholder="team_member_slug"   name="team_member_slug" value="<?php if(!empty($team_member_slug)) echo $team_member_slug; ?>" />
                              
            	</div>
                <div class="option-box">
                    <p class="option-title"><?php _e('Custom meta fields on team member profile.','team'); ?></p>
                    <p class="option-info"><?php _e('','team'); ?></p>
                
                
                
            <div class="">
                <table class="widefat team-member-meta-fields">
                <thead>
                    <tr> 
                    <th>Sorting</th>                   
                    <th>Meta Name</th>
                    <th >Meta Key<br/><i style="font-size:10px;">Must be unique, no blank space, can use (_)underscore</i></th>
                    <th>Remove</th>            
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    
                    if(empty($team_member_meta_fields)){
                        
                        $team_member_meta_fields = array(
                                                    //'address' => array('name'=>'Address','meta_key'=>'team_address'),
                                                    //'mobile' => array('name'=>'Mobile','meta_key'=>'team_mobile'),											
                                                );
                        
                        }
                    //var_dump($team_member_skill);
                    
                        foreach ($team_member_meta_fields as $meta_key=>$meta_info) {
                            
                            ?>
                    <tr>
                    <td class="sorting"></td>
                    <td>
                        
                        <?php //var_dump($skill_info); ?>
                    
                        <input type="text" size="30" placeholder="Meta Name"   name="team_member_meta_fields[<?php echo $meta_key; ?>][name]" value="<?php if(!empty($team_member_meta_fields[$meta_key]['name'])) echo $team_member_meta_fields[$meta_key]['name']; ?>" />
                    
                    </td>
                    <td>
                        <input type="text" size="30" placeholder="meta_key"   name="team_member_meta_fields[<?php echo $meta_key; ?>][meta_key]" value="<?php if(!empty($team_member_meta_fields[$meta_key]['meta_key'])) echo $team_member_meta_fields[$meta_key]['meta_key']; ?>" />
                    </td>
                    
                    <td>
                    <span class="remove-meta">X</span>
                    </td>            
                    </tr>
                        <?php
                        }
                ?>
                </tbody>
                </table>
                
                <div class="button add_team_member_meta">Add new</div>
            </div>
                
                
 <script>
 jQuery(document).ready(function($)
	{
		$(function() {
			$( ".team-member-meta-fields tbody" ).sortable();
			//$( ".items" ).disableSelection();
			});
		
		})

</script>
                
                
                
                </div>
            
            
            
            
            
            
			<div class="option-box">
				<p class="option-title"><?php _e('Display social field on team member profile.','team'); ?></p>
 				<p class="option-info"><?php _e('By adding bellow input you can control extra input field under member page. if you want to remove one profile field then please empty this field and save changes or to add new profile field simply click add new. some default profile fields are mobile, website, email, skype, facebook, twitter, googleplus, pinterest.','team'); ?></p>
                
            <div class="button reset_team_member_social_field">Reset</div>
			<table class="team_member_social_field widefat " id="team_member_social_field">
                <thead><tr><th>Sort</th><th>Meta name</th><th>Meta key</th><th>Icon</th><th>Visibility</th><th>Remove</th>
                
                </tr>  
              </thead>
            <?php 

			
			if(empty($team_member_social_field)){
					$team_member_social_field = $default_social_field;
				}

            foreach ($team_member_social_field as $field_key=>$field_info) {
                if(!empty($field_key))
                    {
                        ?>
                    <tr><td class="sorting"></td>
                    <td>

                    <input name="team_member_social_field[<?php echo $field_key; ?>][name]" type="text" value="<?php if(isset($team_member_social_field[$field_key]['name'])) echo $team_member_social_field[$field_key]['name']; ?>" />
                    </td>                    
                    
                    <td>
                    
					<input name="team_member_social_field[<?php echo $field_key; ?>][meta_key]" type="text" value="<?php if(isset($team_member_social_field[$field_key]['meta_key'])) echo $team_member_social_field[$field_key]['meta_key']; ?>" />
                    
                   
                    </td>
                    
                    <td>
                    <span style=" <?php if(!empty($team_member_social_field[$field_key]['icon'])) echo 'background:url('.$team_member_social_field[$field_key]['icon'].') no-repeat scroll 0 0 rgba(0, 0, 0, 0);';  ?>" title="Icon for this field." class="team_member_social_icon <?php if(empty($team_member_social_field[$field_key]['icon'])) echo 'empty_icon';?>" icon-name="<?php echo $field_key; ?>"> </span>
                    
                    <input class="team_member_social_icon team_member_social_icon_<?php echo $field_key; ?>" name="team_member_social_field[<?php echo $field_key; ?>][icon]" type="hidden" value="<?php if(isset($team_member_social_field[$field_key]['icon'])) echo $team_member_social_field[$field_key]['icon']; ?>" />
                    
                    
                    </td>
                    <td>
                    
                    <?php if(isset($team_member_social_field[$field_key]['visibility'])) $checked = 'checked'; else $checked = ''; ?>
                    
                    
                    <input <?php echo $checked; ?> name="team_member_social_field[<?php echo $field_key; ?>][visibility]" type="checkbox" value="1" />
                    
                    </td>                    
                    <td>
                    
                    <?php
                    if($field_info['can_remove']=='yes'){
					?>
                    
                    <span class="remove_icon">X</span>

                    <?php
					}
					else{
						echo '<span title="Can\'t remove.">...</span>';
						
						}
					
					?>
                    
                    <input name="team_member_social_field[<?php echo $field_key; ?>][can_remove]" type="hidden" value="<?php echo $field_info['can_remove']; ?>" />
                    
                    
                    </td>
                    
                    
                    </tr>
                        <?php
						
						
                    
                    }
            }
            
            ?>

                    
                    </table> 
                    
        
        
 
        
 <script>
 jQuery(document).ready(function($)
	{
		$(function() {
			$( "#team_member_social_field tbody" ).sortable();
			//$( ".items" ).disableSelection();
			});
		
		})

</script>
        
        
        
        
                    <div class="button new_team_member_social_field"><?php _e('Add New','team'); ?></div>
        
                </div>

            
            </li>
                        
            <li style="display: none;" class="box2 tab-box">
            
				<div class="option-box">
                    <p class="option-title">Plugin info ?</p>
                    <p class="option-info">
					<?php
                
                    if(team_customer_type=="free")
                        {
                    
                            echo 'You are using <strong> '.team_customer_type.' version  '.team_plugin_version.'</strong> of <strong>'.team_plugin_name.'</strong>, To get more feature you could try our premium version. ';
                            echo '<br /><a href="'.team_pro_url.'">'.team_pro_url.'</a>';
                            
                        }
                    else
                        {
                    
                            echo 'Thanks for using <strong> premium version  '.team_plugin_version.'</strong> of <strong>'.team_plugin_name.'</strong> ';	
                            
                            
                        }
                    
                     ?>       

                    
                    </p>

                </div>
            
				<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo team_qa_url; ?>"><?php echo team_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br /> please read <strong>documentation</strong> here <a href="<?php echo team_tutorial_doc_url; ?>"><?php echo team_tutorial_doc_url; ?></a>

                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Submit Reviews...</p>
                    <p class="option-info">We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.</p>
                	<img class="team-pro-pricing" src="<?php echo team_plugin_url."css/five-star.png";?>" /><br />
                    <a target="_blank" href="<?php echo team_wp_reviews; ?>">
                		<?php echo team_wp_reviews; ?>
               		</a>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
                    <?php
                   		$class_team_functions = new class_team_functions();
						echo $class_team_functions->team_share_plugin();
					?>
                </div>
                
				<div class="option-box">
                    <p class="option-title">Video Tutorial</p>
                    <p class="option-info">Please watch this video tutorial.</p>
                	<iframe width="640" height="480" src="<?php echo team_tutorial_video_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                
                
                
                
            </li>            
        </ul>
    
    
		

        
    </div>






<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','team' ); ?>" />
                </p>
		</form>


</div>
