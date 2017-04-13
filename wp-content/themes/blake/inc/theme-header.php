<?php
	
function blake_print_menu($ispagephp = true, $isfirstpage = false){
	global $blake_header_bgstyle_pre, $blake_header_bgstyle_after;
	$header_shrink = "";
	if (get_option('blake_fixed_menu') == 'on'){
		if (get_option('blake_header_after_scroll') == 'on'){
			if (get_option('blake_header_shrink_effect') == 'on'){
				$header_shrink = " header_shrink";
			}
		}
	}
	$header_after_scroll = false;
	if (get_option('blake_fixed_menu') == 'on'){
		if (get_option('blake_header_after_scroll') == 'on'){
			$header_after_scroll = true;
		}
	}
	$typeofheader = get_option("blake_header_style_type");
	
	?>
	<header class="navbar navbar-default navbar-fixed-top <?php echo esc_attr($typeofheader); ?> <?php if (get_option('blake_fixed_menu') == 'off') echo " header_not_fixed"; else if (get_option('blake_header_hide_on_start') == "on" && !$ispagephp) echo " hide-on-start"; ?>">
		
		<?php
		if (get_option("blake_info_above_menu") == "on"){
			?>
			<div class="top-bar">
				<div class="top-bar-bg">
					<div class="container clearfix">
						<div class="slidedown">
						    <div class="col-xs-12 col-sm-12">
							<?php
								/* social icons */
								if (get_option("blake_enable_socials") == "on"){
									?>
										<div class="social-icons-fa">
									        <ul>
											<?php
												$icons = array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"));
												foreach ($icons as $i){
													if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
													?>
													<li>
														<a href="<?php echo esc_url(get_option("blake_icon-".$i[0])); ?>" target="_blank" class="<?php echo esc_attr(strtolower($i[0])); ?>" title="<?php echo esc_attr($i[1]); ?>"><i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i></a>
													</li>
													<?php
													}
												}
											?>
										    </ul>
										</div>
									<?php	
								}
								/* company infos */
								if ( get_option("blake_telephone_menu") != "" || get_option("blake_email_menu") != "" || get_option("blake_address_menu") != "" || get_option("blake_text_field_menu") != "" ){
									?>
									<ul class="phone-mail">
										<?php if ( is_string(get_option("blake_telephone_menu")) && get_option("blake_telephone_menu") != "" ){ ?>
											<li><i class="fa fa-phone"></i><?php printf(esc_html__("%s", "blake"), get_option("blake_telephone_menu")); ?></li>
										<?php } ?>
										<?php if ( is_string(get_option("blake_email_menu")) && get_option("blake_email_menu") != "" ){ ?>
											<li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_url(get_option("blake_email_menu")); ?>"><?php echo esc_html(get_option("blake_email_menu")); ?></a></li>
										<?php } ?>
										<?php if ( is_string(get_option("blake_address_menu")) && get_option("blake_address_menu") != "" ){ ?>
											<li><i class="fa fa-map-marker"></i><?php echo wp_kses_post(get_option("blake_address_menu")); ?></li>
										<?php } ?>
										<?php if ( is_string(get_option("blake_text_field_menu")) && get_option("blake_text_field_menu") != "" ){ ?>
											<li><i class="fa fa-info-circle"></i><?php echo wp_kses_post(get_option("blake_text_field_menu")); ?></li>
										<?php } ?>
									</ul>
									<?php
								}
								
								/* wpml menu */
								if (get_option("blake_wpml_menu_widget") == "on") { 								
									if (function_exists('icl_object_id')) { ?>
										<div class="menu_wpml_widget">	
											<?php do_action('icl_language_selector'); ?>
										</div>
									<?php 
									}
								}
								/* topbar menu */
								if (get_option("blake_top_bar_menu") == "on"){
									?>
									<div class="top-bar-menu">
										<?php wp_nav_menu( array( 'theme_location' => 'topbarnav', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_top_bar' )); ?>
									</div>
									<?php
								}
							?>
							</div>
						</div>
					</div>
				</div>
				<a href="#" class="down-button"><i class="fa fa-plus"></i></a><!-- this appear on small devices -->
			</div>
			<?php
			$blake_inline_script = '
				jQuery(document).ready(function(){
					"use strict";
					if (jQuery(this).width() > 768) {
						jQuery("a.down-button").removeClass("current");
						jQuery(".slidedown").removeAttr("style");
					}
					jQuery("a.down-button").bind("click", function () {
					  if (jQuery(this).hasClass("current")) {
						  jQuery(this).removeClass("current");
						  jQuery(this).parent().parent().find(".slidedown").slideUp("slow", function(){ jQuery(this).closest(".top-bar").removeClass("opened"); });
						  return false;
					  } else {
						  jQuery(this).addClass("current").closest(".top-bar").addClass("opened");
						  jQuery(this).parent().parent().find(".slidedown").slideDown("slow");
						  return false;
					  }
					});
				});
				jQuery(window).resize(function(){
					if (jQuery(this).width() > 768) {
						jQuery("a.down-button").removeClass("current");
						jQuery(".slidedown").removeAttr("style");
					}
				});
			';
			wp_add_inline_script('blake', $blake_inline_script, 'after');
		}
		
		if ($typeofheader == "style4" && (get_option("blake_social_icons_menu") == "on" || get_option("blake_enable_search") || get_option("blake_woocommerce_cart") == "on")){
			?>
			<div class="style4_social_search container">
				<?php
					if (get_option("blake_social_icons_menu") == "on"){
						?>
						<div class="header_social_icons <?php if (get_option("blake_social_icons_menu") == "on") echo "with-social-icons"; ?>">
							<div class="header_social_icons_wrapper">
							<?php
								global $howmany_header_social_icons; $howmany_header_social_icons = 0;
								$icons = array_reverse(array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble")));
								foreach ($icons as $i){
									if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
										$howmany_header_social_icons++;
									?>
									<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("blake_icon-".$i[0])); ?>', '_blank');">
										<i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i>
				                    </div>
									<?php
									}
								}
							?>	
							</div>
						</div>
						<?php
					}
					if (get_option("blake_enable_search") == "on"){
						?>
						<div class="search_trigger"><i class="fa fa-search"></i></div>
						<?php
					}
					blake_print_woocommerce_button();
				?>
			</div>
			<?php
		}
		
		
		?>
		
		<div class="nav-container container">
	    	<div class="navbar-header">
		    	<?php if ($typeofheader == "style4"){ ?>
		    	<div class="new-menu-wrapper">
			    	<div class="new-menu-left"><div class="new-menu-bearer"><ul class="navbar-nav nav"></ul></div></div>
			    	<div class="new-menu-right"><div class="new-menu-bearer"><ul class="navbar-nav nav"></ul></div></div>
			    </div>
		    	<?php } ?>
				<a class="navbar-brand nav-to" href="<?php echo esc_url(home_url("/")); ?>" tabindex="-1">
	        	<?php 
					$blake_header_style_pre = $blake_header_bgstyle_pre == 'dark' ? 'light' : 'dark';
					$blake_header_style_after = $blake_header_bgstyle_after == 'dark' ? 'light' : 'dark';
					
					$alone = true;
    				if (get_option("blake_logo_retina_image_url_".$blake_header_style_pre) != ""){
	    				$alone = false;
    				}
					?>
					<img class="logo_normal <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" src="<?php echo esc_url(get_option("blake_logo_image_url_".$blake_header_style_pre)); ?>" alt="<?php esc_html_e("", "blake"); ?>" title="<?php esc_html_e("", "blake"); ?>">
    					
    				<?php 
    				if (get_option("blake_logo_retina_image_url_".$blake_header_style_pre) != ""){
    				?>
	    				<img class="logo_retina" style="display:none; position: relative;" src="<?php echo esc_url(get_option("blake_logo_retina_image_url_".$blake_header_style_pre)); ?>" alt="<?php esc_html_e("", "blake"); ?>" title="<?php esc_html_e("", "blake"); ?>">
    				<?php
					}
					/* blake_header_after_scroll option */
	    			if ($header_after_scroll || get_option('blake_header_hide_on_start') == 'on'){
		    			$alone = true;
	    				if (get_option("blake_logo_retina_image_url_".$blake_header_style_after) != ""){
		    				$alone = false;
	    				}
    					?>
    					<img class="logo_normal logo_after_scroll <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" alt="<?php esc_html_e("", "blake"); ?>" title="<?php esc_html_e("", "blake"); ?>" src="<?php echo esc_url(get_option("blake_logo_image_url_".$blake_header_style_after)); ?>">
	    					
	    				<?php 
	    				if (get_option("blake_logo_retina_image_url_".$blake_header_style_after) != ""){
	    				?>
		    				<img class="logo_retina logo_after_scroll" style="display:none; position: relative;" src="<?php echo esc_url(get_option("blake_logo_retina_image_url_".$blake_header_style_after)); ?>" alt="<?php esc_html_e("", "blake"); ?>" title="<?php esc_html_e("", "blake"); ?>">
	    				<?php
    					}
	    			}
	    		?>
		        </a>
			</div>
			
			<?php
				if ($typeofheader == "style4" && (get_option("blake_social_icons_menu") == "on" || get_option("blake_enable_search") || get_option("blake_woocommerce_cart") == "on")){
					?>
					<div class="style4_social_search_mobile container">
						<?php
							if (get_option("blake_social_icons_menu") == "on"){
								?>
								<div class="header_social_icons <?php if (get_option("blake_social_icons_menu") == "on") echo "with-social-icons"; ?>">
									<div class="header_social_icons_wrapper">
									<?php
										blake_print_woocommerce_button();
										if (get_option("blake_enable_search") == "on"){
											?>
											<div class="search_trigger"><i class="fa fa-search"></i></div>
											<?php
										}
										global $howmany_header_social_icons; $howmany_header_social_icons = 0;
										$icons = array_reverse(array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble")));
										foreach ($icons as $i){
											if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
												$howmany_header_social_icons++;
											?>
											<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("blake_icon-".$i[0])); ?>', '_blank');">
												<i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i>
						                    </div>
											<?php
											}
										}
									?>
									</div>
								</div>
								<?php
							}
						?>
					</div>
					<?php
				}
				
				if (get_option("blake_header_style_type") == "style3"){
					?>
					<div class="header_social_icons <?php if (get_option("blake_social_icons_menu") == "on") echo "with-social-icons"; ?>">
						<?php 
							if (get_option("blake_social_icons_menu") == "on"){
								?>
								<div class="header_social_icons_wrapper">
								<?php
									global $howmany_header_social_icons; $howmany_header_social_icons = 0;
									$icons = array_reverse(array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble")));
									foreach ($icons as $i){
										if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
											$howmany_header_social_icons++;
										?>
										<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("blake_icon-".$i[0])); ?>', '_blank');">
											<i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i>
					                    </div>
										<?php
										}
									}
								?>	
								</div>
								<?php
							}
							//search trigger
							if (get_option("blake_enable_search") == "on"){
								?>
								<div class="search_trigger_mobile"><i class="fa fa-search"></i></div>
								<?php
							}
						?>
					</div>
					<?php
				}
			?>
			
			<div class="navbar-collapse collapse">
				<?php 
					if (!$isfirstpage){
						if ($ispagephp){
							wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new blake_walker_nav_menu_outsider, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','blake') ) );
						} 
						else {
							global $homes;
							$homes = 0;
							wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new blake_walker_nav_menu, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','blake') ) );
						} 	
					}
				?>
			</div>
			
			
			<?php
				if ($typeofheader != "style3" && $typeofheader != "style4"){
					?>
					<div class="header_social_icons <?php if (get_option("blake_social_icons_menu") == "on") echo "with-social-icons"; ?>">
						<?php
							if (get_option("blake_social_icons_menu") == "on" ){
								?>
								<div class="header_social_icons_wrapper">
								<?php
									global $howmany_header_social_icons; $howmany_header_social_icons = 0;
									$icons = array_reverse(array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble")));
									foreach ($icons as $i){
										if (is_string(get_option("blake_icon-".$i[0])) && get_option("blake_icon-".$i[0]) != ""){
											$howmany_header_social_icons++;
										?>
										<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("blake_icon-".$i[0])); ?>', '_blank');">
											<i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i>
					                    </div>
										<?php
										}
									}
								?>	
								</div>
								<?php
							}
							//search trigger
							if (get_option("blake_enable_search") == "on"){
								?>
								<div class="search_trigger_mobile"><i class="fa fa-search"></i></div>
								<?php
							}
						?>
					</div>
					<?php
					blake_print_woocommerce_button();
				}
			?>
			
			<?php
				//search trigger
				if (get_option("blake_enable_search") == "on" && $typeofheader != "style4"){
					?>
					<div class="search_trigger"><i class="fa fa-search"></i></div>
					<?php
				}
			?>
			 
			<?php
				if (!$isfirstpage){
					?>
					<div id="dl-menu" class="dl-menuwrapper">
						<div class="dl-trigger-wrapper">
							<button class="dl-trigger"><!-- <?php printf(esc_html__("%s","blake"), get_option("blake_open_menu")); ?> --></button>
						</div>
						<?php 
							if ($ispagephp){
								wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'dl-menu', 'walker' => new blake_walker_nav_menu_outsider, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','blake') ) );
							} 
							else {
								global $homes;
								$homes = 0;
								wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'dl-menu', 'walker' => new blake_walker_nav_menu, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','blake') ) );
							} 
						?>
					</div>
					<?php
				}
			?>
			
			
		</div>
		
		<?php
		//the search input
		if (get_option("blake_enable_search") == "on"){
			?>
			<form autocomplete="off" role="search" method="get" class="search_input <?php echo esc_attr(get_option("blake_search_open_effect")); ?>" action="<?php echo home_url( '/' ); ?>">
				<div class="search_close">
					<i class="fa fa-times"></i>
				</div>
				<div class="container">
					<input value="" name="s" class="search_input_value" type="text" placeholder="<?php printf(esc_html__("%s","blake"), get_option("blake_search_box_text")); ?>" />
					<input class="hidden" type="submit" id="searchsubmit" value="Search" />
					<div class="ajax_search_results"><ul></ul></div>
				</div>
			</form>	
			<?php
		}
		?>
		
	</header>
	<?php
}

?>