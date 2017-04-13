<?php
	
function blake_menu_item_class_select(){
    global $pagenow;
    if ($pagenow == "nav-menus.php"){
	    wp_enqueue_script('jquery-ui-dialog');
	    wp_enqueue_style('blake-admin-style',BLAKE_CSS_URL.'custom_page.css');
	    $des_icons = array('fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-ambulance','fa-anchor','fa-android','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left','fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h','fa-arrows-v','fa-asterisk','fa-automobile','fa-backward','fa-ban','fa-bank','fa-bar-chart-o','fa-barcode','fa-bars','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bitbucket','fa-bitbucket-square','fa-bitcoin','fa-bold','fa-bolt','fa-bomb','fa-book','fa-bookmark','fa-bookmark-o','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-cab','fa-calendar','fa-calendar-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-certificate','fa-chain','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square','fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-cny','fa-code','fa-code-fork','fa-codepen','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-copy','fa-credit-card','fa-crop','fa-crosshairs','fa-css3','fa-cube','fa-cubes','fa-cut','fa-cutlery','fa-dashboard','fa-database','fa-dedent','fa-delicious','fa-desktop','fa-deviantart','fa-digg','fa-dollar','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edit','fa-eject','fa-ellipsis-h','fa-ellipsis-v','fa-empire','fa-envelope','fa-envelope-o','fa-envelope-square','fa-eraser','fa-eur','fa-euro','fa-exchange','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-facebook','fa-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-movie-o','fa-file-o','fa-file-pdf-o','fa-file-photo-o','fa-file-picture-o','fa-file-powerpoint-o','fa-file-sound-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-file-zip-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-flag','fa-flag-checkered','fa-flag-o','fa-flash','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-forward','fa-foursquare','fa-frown-o','fa-gamepad','fa-gavel','fa-gbp','fa-ge','fa-gear','fa-gears','fa-gift','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-gittip','fa-glass','fa-globe','fa-google','fa-google-plus','fa-google-plus-square','fa-graduation-cap','fa-group','fa-h-square','fa-hacker-news','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-history','fa-home','fa-hospital-o','fa-html5','fa-image','fa-inbox','fa-indent','fa-info','fa-info-circle','fa-inr','fa-instagram','fa-institution','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key','fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-leaf','fa-legal','fa-lemon-o','fa-level-down','fa-level-up','fa-life-bouy','fa-life-ring','fa-life-saver','fa-lightbulb-o','fa-link','fa-linkedin','fa-linkedin-square','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left','fa-long-arrow-right','fa-long-arrow-up','fa-magic','fa-magnet','fa-mail-forward','fa-mail-reply','fa-mail-reply-all','fa-male','fa-map-marker','fa-maxcdn','fa-medkit','fa-meh-o','fa-microphone','fa-microphone-slash','fa-minus','fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mobile','fa-mobile-phone','fa-money','fa-moon-o','fa-mortar-board','fa-music','fa-navicon','fa-openid','fa-outdent','fa-pagelines','fa-paper-plane','fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-paste','fa-pause','fa-paw','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-phone','fa-phone-square','fa-photo','fa-picture-o','fa-pied-piper','fa-pied-piper-alt','fa-pinterest','fa-pinterest-square','fa-plane','fa-play','fa-play-circle','fa-play-circle-o','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-power-off','fa-print','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question','fa-question-circle','fa-quote-left','fa-quote-right','fa-ra','fa-random','fa-rebel','fa-recycle','fa-reddit','fa-reddit-square','fa-refresh','fa-renren','fa-reorder','fa-repeat','fa-reply','fa-reply-all','fa-retweet','fa-rmb','fa-road','fa-rocket','fa-rotate-left','fa-rotate-right','fa-rouble','fa-rss','fa-rss-square','fa-rub','fa-ruble','fa-rupee','fa-save','fa-scissors','fa-search','fa-search-minus','fa-search-plus','fa-send','fa-send-o','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shield','fa-shopping-cart','fa-sign-in','fa-sign-out','fa-signal','fa-sitemap','fa-skype','fa-slack','fa-sliders','fa-smile-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc','fa-sort-down','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-sort-up','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star','fa-star-half','fa-star-half-empty','fa-star-half-full','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-stop','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-suitcase','fa-sun-o','fa-superscript','fa-support','fa-table','fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down','fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle','fa-times-circle-o','fa-tint','fa-toggle-down','fa-toggle-left','fa-toggle-right','fa-toggle-up','fa-trash-o','fa-tree','fa-trello','fa-trophy','fa-truck','fa-try','fa-tumblr','fa-tumblr-square','fa-turkish-lira','fa-twitter','fa-twitter-square','fa-umbrella','fa-underline','fa-undo','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-unsorted','fa-upload','fa-usd','fa-user','fa-user-md','fa-users','fa-video-camera','fa-vimeo-square','fa-vine','fa-vk','fa-volume-down','fa-volume-off','fa-volume-up','fa-warning','fa-wechat','fa-weibo','fa-weixin','fa-wheelchair','fa-windows','fa-won','fa-wordpress','fa-wrench','fa-xing','fa-xing-square','fa-yahoo','fa-yen','fa-youtube','fa-youtube-play','fa-youtube-square');
	
	$blake_inline_script = '
		function blake_removeIcon(el){
		    el.siblings(".edit-menu-item-classes").val( " "+el.siblings(".edit-menu-item-classes").val().replace(el.siblings("i").attr("class"), ""));
		    el.siblings("i").remove();
		    el.remove();
	    }
	    
	    function blake_override_class_options(){
		    var holders = jQuery(".menu-item-settings p.field-css-classes > label").not(".des");
		    holders.each(function(){
			    var theid = jQuery(this).closest(".menu-item-settings").attr("id");
			    jQuery(this).addClass("des");
			    jQuery(this).removeClass("hidden-field").css("display","block");
 			    jQuery(this).contents().filter(function () { return this.nodeType === 3; }).remove();
			    jQuery(this).prepend("<label class=\'blake_input\' for=\'blake_mega_menu\'>Mega Menu?  </label><input type=\'checkbox\' name=\'blake_mega_menu\'><label class=\'blake_input\' for=\'blake_mega_hide_title\'>Hide Title?  </label><input type=\'checkbox\' name=\'blake_mega_hide_title\'><br/><label class=\'blake_input\' for=\'blake_mega_hide_link\'>Just Label (Without Link) ?  </label><input type=\'checkbox\' name=\'blake_mega_hide_link\'><br/><a href=\'#\' class=\'blake_select_icon button\' >Select Icon</a><br/><br/>");
			    
			    /* check if menu item has already an icon and present it. also check the boxes if the class exists. */
			    if (jQuery(this).find("input.edit-menu-item-classes").val()){
				    var itemClasses = jQuery(this).find("input.edit-menu-item-classes").val().split(" ");
				    var found = "false";
				    for (var i=0; i<itemClasses.length; i++){
					    if (itemClasses[i].indexOf("fa-") > -1) {
						    found = itemClasses[i];
					    }
					    if (itemClasses[i].indexOf("blake_mega_hide_link") > -1) jQuery(this).find("input[name=\'blake_mega_hide_link\']").attr("checked","checked");
					    if (itemClasses[i].indexOf("blake_mega_hide_title") > -1) jQuery(this).find("input[name=\'blake_mega_hide_title\']").attr("checked","checked");
					    if (itemClasses[i].indexOf("blake_mega_menu") > -1) jQuery(this).find("input[name=\'blake_mega_menu\']").attr("checked","checked");
				    }
				    if (found != "false"){
					    jQuery(this).find(".blake_select_icon.button").after( "<i class=\'fa "+found+"\' style=\'position:relative;top:2px;margin-left:10px;margin-right:10px;width: 30px;height: 30px;font-size: 25px;border: 1px solid;text-align: center;line-height: 30px;\'></i><a class=\'des_remove_icon\' href=\'javascript:;\' onclick=\'blake_removeIcon(jQuery(this));\'>Remove Icon</a>" );
				    }
			    }
			    
				jQuery(this).find("input").each(function(){
					jQuery(this).bind("change", function(){
						if (jQuery(this).is(":checked")) jQuery(this).siblings(".edit-menu-item-classes").val( jQuery(this).siblings(".edit-menu-item-classes").val() + " " + jQuery(this).attr("name") );
						else jQuery(this).siblings(".edit-menu-item-classes").val( jQuery(this).siblings(".edit-menu-item-classes").val().replace(" " + jQuery(this).attr("name"),"") );
					});
				});
				jQuery(this).find(".blake_select_icon").click(function(){
					jQuery(".blake_icon_container").dialog({modal:true, height: parseInt(jQuery(window).height()*.8, 10), width: parseInt(jQuery(window).width()*.8, 10), autoOpen: false});
					jQuery(".blake_icon_container").parent().attr("data-rel",theid).css({position : "fixed"}).end().dialog("open");
				});
		    });			
		}
		
		jQuery(document).ready(function(){
			blake_override_class_options();
			jQuery(".submit-add-to-menu").click(function(){ 
				var new_item = false;
				if (jQuery(this).attr("id") === "submit-posttype-page" && jQuery("#posttype-page input:checked").length > 0) new_item = true;
				if (jQuery(this).attr("id") === "submit-customlinkdiv" && jQuery("#custom-menu-item-name").val() != "" && !jQuery("#custom-menu-item-name").hasClass("input-with-default-title") && jQuery("#custom-menu-item-url").val() != "" && jQuery("#custom-menu-item-url").val() != "http://") nav_item = true;
				if (jQuery(this).attr("id") === "submit-taxonomy-category" && jQuery("#add-category input:checked").length > 0) new_item = true;
				if (new_item){
					var check_for_new_item = setInterval(function(){
						if (jQuery(".menu-item-settings p.field-css-classes label").not(".des").not(".blake_input").length){
							clearInterval(check_for_new_item);
							blake_override_class_options();
						}
					}, 100);
				}
			});
		});
	';
	wp_add_inline_script('blake-admin', $blake_inline_script, 'after');
	?>
	
	<div class="blake_icon_container">
		<?php
			$first = true;
			foreach ($des_icons as $i){
				if ($first) {
					$first = false;
					echo "<i class='fa ".esc_attr($i)." selected' data-rel='fa ".esc_attr($i)."' onclick='jQuery(this).addClass(\"selected\").siblings().removeClass(\"selected\");'></i>";
				} else echo "<i class='fa $i' data-rel='fa $i' onclick='jQuery(this).addClass(\"selected\").siblings().removeClass(\"selected\");'></i>";
			}
		?>
		<div class="clear" style="height:10px;"></div>
		<a href="javascript:;" onclick=" if (jQuery('#'+jQuery(this).closest('.ui-dialog').attr('data-rel')+ ' .des_remove_icon').length) jQuery('#'+jQuery(this).closest('.ui-dialog').attr('data-rel')+ ' .des_remove_icon').click(); jQuery('#'+jQuery(this).closest('.ui-dialog').attr('data-rel')+ ' .edit-menu-item-classes').val( jQuery('#'+jQuery(this).closest('.ui-dialog').attr('data-rel')+ ' .edit-menu-item-classes').val() + ' ' + jQuery(this).siblings('i.selected').attr('data-rel')); jQuery('#'+jQuery(this).closest('.ui-dialog').attr('data-rel')+ ' .blake_select_icon.button').after('<a class=\'des_remove_icon\' href=\'javascript:;\' onclick=\'blake_removeIcon(jQuery(this));\'>Remove Icon</a>').after( '<i class=\''+jQuery(this).siblings('i.selected').attr('data-rel')+'\' style=\'position:relative;top:2px;margin-left:10px;margin-right:10px;width: 30px;height: 30px;font-size: 25px;border: 1px solid;text-align: center;line-height: 30px;\'></i>' );   jQuery('.blake_icon_container').dialog('close');" class="button button_ok">OK</a>
		<a href="javascript:;" onclick="jQuery('.blake_icon_container').dialog('close');" class="button button_cancel">Cancel</a>
	</div>
    <?php
    }
}
add_action('admin_footer','blake_menu_item_class_select');

?>