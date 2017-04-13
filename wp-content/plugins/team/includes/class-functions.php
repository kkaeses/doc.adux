<?php

/*
* @Author 		ParaTheme
* Copyright: 	2015 ParaTheme
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 	


class class_team_functions  {
	
	
    public function __construct()
    {
		
		
		//$this->settings_page = new Team_Settings();
		
		
		//add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
       //add_action('admin_menu', array($this, 'create_menu'));
    }
	

		
		
	public function team_member_posttype($posttype = array('team_member'))
		{
			return apply_filters('team_member_posttype', $posttype);
		}
		
	public function team_member_taxonomy($taxonomy = 'team_group')
		{
			return apply_filters('team_member_taxonomy', $taxonomy); //string only
		}		
		
		
		
		
	public function team_member_social_field()
		{
			
/*
			$social_field = array(
									"mobile"=>"Mobile",					
									"website"=>"Website",						
									"email"=>"Email",						
									"skype"=>"Skype",					
									"facebook"=>"Facebook",
									"twitter"=>"Twitter",
									"googleplus"=>"Google plus",
									"pinterest"=>"Pinterest",
									"linkedin"=>"Linkedin",
									"vimeo"=>"Vimeo",															
					);

*/
					
					
					
			$social_field = array(
									"mobile"=>array('meta_key'=>"mobile",'name'=>"Mobile",'icon'=>'','visibility'=>'1','can_remove'=>'no',),					
									"website"=>array('meta_key'=>"website",'name'=>"Website",'icon'=>'','visibility'=>'1','can_remove'=>'no',),
									"email"=>array('meta_key'=>"email",'name'=>"Email",'icon'=>'','visibility'=>'1','can_remove'=>'no',),						
									"skype"=>array('meta_key'=>"skype",'name'=>"Skype",'icon'=>'','visibility'=>'1','can_remove'=>'no',),					
									"facebook"=>array('meta_key'=>"facebook",'name'=>"Facebook",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"twitter"=>array('meta_key'=>"twitter",'name'=>"Twitter",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"googleplus"=>array('meta_key'=>"googleplus",'name'=>"Google plus",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"pinterest"=>array('meta_key'=>"pinterest",'name'=>"Pinterest",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"linkedin"=>array('meta_key'=>"linkedin",'name'=>"Linkedin",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"vimeo"=>array('meta_key'=>"vimeo",'name'=>"Vimeo",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),														
					);					
					
			return apply_filters( 'team_member_social_field', $social_field );

			}		
		
		
		
		
		
	public function team_grid_items()
		{

			$team_grid_items = array(
					'thumbnail'=>__('Thumbnail','team'),
					'title'=>__('Title','team'),
					'position'=>__('Position / Role','team'),
					'content'=>__('Content / Biography','team'),
					'social'=>__('Social','team'),
					);

			$team_grid_items = apply_filters('team_grid_items',$team_grid_items);


			return $team_grid_items;

			}




		
	public function team_themes($themes = array())
		{

			 $themes = array(
							'flat'=>'Flat',
							'rounded'=>'Rounded',
							'zoom-out'=>'Zoom Out',					
																
							);
			
			foreach(apply_filters( 'team_themes', $themes ) as $theme_key=> $theme_name)
				{
					$theme_list[$theme_key] = $theme_name;
				}

			
			return $theme_list;

		}
	
		
	public function team_themes_dir($themes_dir = array())
		{
			$main_dir = team_plugin_dir.'themes/';
			
			$themes_dir = array(
							'flat'=>$main_dir.'flat',
							'rounded'=>$main_dir.'rounded',
							'zoom-out'=>$main_dir.'zoom-out',
																			
							);


			foreach(apply_filters( 'team_themes_dir', $themes_dir ) as $theme_key=> $theme_dir)
				{
					$theme_list_dir[$theme_key] = $theme_dir;
				}

			return $theme_list_dir;

		}


	public function team_themes_url($themes_url = array())
		{
			$main_url = team_plugin_url.'themes/';
			
			$themes_url = array(
							'flat'=>$main_url.'flat',
							'rounded'=>$main_url.'rounded',
							'zoom-out'=>$main_url.'zoom-out',
							);

			foreach(apply_filters( 'team_themes_url', $themes_url ) as $theme_key=> $theme_url)
				{
					$theme_list_url[$theme_key] = $theme_url;
				}



			return $theme_list_url;

		}


// Single Team Member 



		
	public function team_single_themes($themes = array())
		{

			$themes = array(
							'flat'=>'Flat',
							
							);
			
			foreach(apply_filters( 'team_single_themes', $themes ) as $theme_key=> $theme_name)
				{
					$theme_list[$theme_key] = $theme_name;
				}

			
			return $theme_list;

		}
	
		
	public function team_single_themes_dir($themes_dir = array())
		{
			$main_dir = team_plugin_dir.'themes-single/';
			$themes_dir = $this->team_themes();

			foreach($themes_dir as $theme_key=> $theme_dir)
				{
					$theme_list_dir[$theme_key] = $main_dir.$theme_key;
				}

			return $theme_list_dir;

		}


	public function team_single_themes_url($themes_url = array())
		{
			$main_url = team_plugin_url.'themes-single/';
			$themes_url = $this->team_themes();			

			foreach($themes_url as $theme_key=> $theme_url)
				{
					$theme_list_url[$theme_key] = $main_url.$theme_key;
				}

			return $theme_list_url;

		}
















		
	public function team_share_plugin()
		{
			
			?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=652982311485932";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="http://paratheme.com/items/team-responsive-meet-the-team-grid-for-wordpress" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            
            <br /><br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo team_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo team_share_url; ?>" data-text="<?php echo team_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}






}


new class_team_functions();

