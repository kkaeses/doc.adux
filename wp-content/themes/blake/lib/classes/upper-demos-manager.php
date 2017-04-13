<?php

/**
 * This is the main class for managing options. Its purpose is to build an options page by a predefined
 * set of options. This class contains the functionality for printing the whole options page - its header,
 * footer and all the options inside.
 */
class BlakeDemosManager{

	var $options=array();
	var $before_option_title='<div class="option"><h4>';
	var $after_option_title='</h4>';
	var $before_option='<div class="option">';
	var $after_option='</div>';
	var $blake_images_url='';
	var $blake_utils_url='';
	var $blake_uploads_url='';
	var $blake_version='';
	var $themename='';
	var $first_save='';
	
	/**
	 * The main constructor for the BlakeOptionsManager class
	 * @param $themename the name of the the theme
	 * @param $options_url the URL of the options directory
	 * @param $images_url the URL of the functions directory
	 * @param $uploads_url the URL of the uploads directory
	 */
	function __construct($themename, $images_url, $utils_url, $uploads_url, $version){
		$this->themename=$themename;
		$this->blake_images_url=$images_url;
		$this->blake_utils_url=$utils_url;
		$this->blake_uploads_url=$uploads_url;
		$this->blake_version=$version;
		$this->first_save=get_option("blake_first_save");
	}

	/**
	 * Returns the options array.
	 */
	function get_options(){
		return $this->options;
	}
	
	/**
	 * Sets the options array.
	 */
	function set_options($options){
		$this->options=$options;
	}

	/**
	 * Adds an array of options to the current options array.
	 * @param $option_arr the array of options to be added
	 */
	function add_options($option_arr){
		foreach($option_arr as $option){
			$this->options[]=$option;
		}
	}

	/**
	 * Prints the heading of the options panel.
	 * @param $heading_text the welcoming heading text
	 */
	function print_heading($heading_text){
		echo "<div id='templatepath' style='display:none;'>".esc_url(get_template_directory_uri())."</div>";
		
		if(isset($_GET['activated'])&&$_GET['activated']=='true'){
			
			$opt = get_option('blake_enable_website_loader');
			if (!is_string($opt)) {
				echo '<iframe style="display:none;" src="'.esc_url(get_admin_url()).'admin.php?page=blake_options"></iframe>';
			}
			$sopt = get_option('blake_style_color');
			if (!is_string($sopt)) {
				echo '<iframe style="display:none;" src="'.esc_url(get_admin_url()).'admin.php?page=blake_style_options"></iframe>';
			}
			
			echo '<div class="note_box">Welcome to '.esc_html($this->themename).' theme! On this page you can set the main options
			of the theme. For more information about the theme setup, please refer to the documentation included, which
			is located within the "documentation" folder of the downloaded zip file. We hope you will enjoy working with the theme!</div>';
		}
		
		?>
		<div id="blake_demos_container" class="blake_demos_page"><div class="blake_demos_content"></div>
		<?php
	}
	
	/**
	 * Prints the footer of the options panel.
	 */
	function print_footer(){
		?>
		</div> <!-- endof#blake_demos_container -->
		<div class="blake_demo_status" title="Applying the demo" style="display:none;">
			<span class="spinner is-active"></span>
			Installing the theme.<br/>
			Status:
			<ul class="blake_demo_progress"></ul>
		</div>
		<?php
	}

	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	function print_options(){
		
		
		// complete the installation. import revsliders and the rest. cube and whatnot.
		WP_Filesystem();
		global $wp_filesystem;
		if (isset($_GET['demo'])){
			global $wpdb;
			
			$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
			$blake_admin_inline_script .= '
				jQuery(document).ready(function(){
					jQuery(".blake_demo_status").html("<span class=\'spinner is-active\'></span>Almost done! Just a few moments now!<br/>").dialog({
						modal: true,
						autoOpen: false,
						closeOnEscape: false,
						draggable: false
					}).css({ "min-height":"40px", "padding-top":"20px", "text-align":"center" });
					jQuery(".blake_demo_status").dialog("open");
				});
			';
			wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
			
			// import revsliders instances. this is a new version of the revslider. need to check the new method.
			//rev
			try{
				if (function_exists('blake_add_increase_time')) blake_add_increase_time();
				
				$dir = "http://upperinc.com/previews/demos/blake/" . $_GET['demo'] . "/revdemos/";
				//get the zips
				$zips = $matches = array();
				$revlist = $dir."revlist.txt";
				
				$thefile = $wp_filesystem->get_contents($revlist);
				if ($thefile != false){
					$revs = explode(",", $thefile);
					foreach ($revs as $rev){
						$zips[] = $dir.$rev;
					}
				}
				
				require_once( ABSPATH . '/wp-content/plugins/revslider/revslider.php' );
				$rs = new RevSlider();
				$errors = false;
				
				foreach($zips as $zip){
					$slug = explode("/",$zip);
					$slug = str_replace(".zip","",$slug[count($slug)-1]);
					$uploads = wp_upload_dir();
					$newfile = $uploads['basedir']."/".$slug.".zip";
					$filecopy = $wp_filesystem->get_contents($zip);
					$copy = $wp_filesystem->put_contents( $newfile, $filecopy, FS_CHMOD_FILE );
					ob_start();
					$response = $rs->importSliderFromPost(true, true, $newfile); 
					if (!$response['success']) $errors = true;
					ob_end_clean();
				}
				
				
				if (!$errors){
					//cubes.
					if ($wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."cubeportfolio"."'") != $wpdb->prefix."cubeportfolio"){
						$charset_collate = ( ( !empty($wpdb->charset) )? ' DEFAULT CHARACTER SET ' . $wpdb->charset : '' ) .
			                               ( ( !empty($wpdb->collate) )? ' COLLATE ' . $wpdb->collate : '');
						$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."cubeportfolio"." (
			                        id              INT(10)       UNSIGNED AUTO_INCREMENT NOT NULL,
			                        active          TINYINT(1)    UNSIGNED NOT NULL DEFAULT %d,
			                        name            VARCHAR(255)  NOT NULL,
			                        type            VARCHAR(255)  NOT NULL,
			                        customcss       TEXT          NOT NULL,
			                        options         TEXT          NOT NULL,
			                        loadMorehtml    TEXT,
			                        template        TEXT,
			                        filtershtml     TEXT,
			                        googlefonts     TEXT,
			                        popup           MEDIUMTEXT,
			                        jsondata        MEDIUMTEXT,
			                        PRIMARY KEY (id),
			                        INDEX(active)
			                    ){$charset_collate};";
			            $wpdb->query($wpdb->prepare($sql, 1));
			            $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."cubeportfolio_items"." (
			                        id                INT(10)       UNSIGNED AUTO_INCREMENT NOT NULL,
			                        cubeportfolio_id  INT(10)       UNSIGNED NOT NULL,
			                        sort              TINYINT(1)    UNSIGNED NOT NULL DEFAULT %d,
			                        page              TINYINT(2)    UNSIGNED NOT NULL,
			                        items             TEXT          NOT NULL,
			                        isLoadMore        TEXT,
			                        isSinglePage      TEXT,
			                        PRIMARY KEY(id),
			                        INDEX(cubeportfolio_id)
			                    ){$charset_collate};";
			             $wpdb->query($wpdb->prepare($sql, 1));
					}
					
					$cubefp = "http://upperinc.com/previews/demos/blake/" . $_GET['demo'] . "/cubeportfolio.json";
					global $encode_data;
					$encode_data = $wp_filesystem->get_contents($cubefp);
					if ($encode_data != false){
						require_once( ABSPATH . '/wp-content/plugins/cubeportfolio/php/des_CubePortfolioImport.php' );
						$cubeimport = new des_CubePortfolioImport($encode_data);
					}

                    global $table_prefix;
					//icomoonies
					$table_name = $table_prefix."posts";
					$query = "SELECT * FROM {$table_name} WHERE post_title=%s AND post_type=%s LIMIT %d";
					$results = $wpdb->get_results($wpdb->prepare($query, 'line-icons','attachment',1), ARRAY_A);
					if (isset($results[0])){
						$icomoonurl = $results[0]['guid'];
						$icomoonname = substr($icomoonurl, strrpos($icomoonurl, '/') + 1);
						
						$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
						$blake_admin_inline_script .= '
							jQuery(document).ready(function(){
								jQuery.ajax({
									type: "POST",
									url: ajaxurl,
									data: {
										action: "smile_ajax_add_zipped_font",
										values: {
											id : "'.esc_js($results[0]['ID']).'",
											title: "line-icons",
											filename: "'.esc_js($icomoonname).'",
											url: "'.esc_js($icomoonurl).'",
											name: "'.str_replace(".zip", "", $icomoonname).'"
										},
									},
									complete: function(data){
										jQuery(".blake_demo_status").html("All done!<br/>Enjoy!");
										setTimeout(function(){
											jQuery(".blake_demo_status").parent().fadeOut(2000, function(){ jQuery(".blake_demo_status").dialog("destroy"); });
										}, 3000);
									}
								});
							});
						';
						wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
						
					} else {
						$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
						$blake_admin_inline_script .= '
							jQuery(document).ready(function(){
								jQuery(".blake_demo_status").html("All done!<br/>Enjoy!");
								setTimeout(function(){
									jQuery(".blake_demo_status").parent().fadeOut(2000, function(){ jQuery(".blake_demo_status").dialog("destroy"); });
								}, 3000);
							});
						';
						wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
					}
				}
			} catch(Exception $e){
				$errors = $e->getMessage();
				echo json_encode($errors);
			}	
		}
		
		$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
		$blake_admin_inline_script .= '
			jQuery(document).ready(function(){
				jQuery.ajax({
					url: "http://upperinc.com/previews/demos/blake/dtveta.php",
					dataType: "html",
					type: "POST",
					data: {
						templatepath: "'.get_template_directory_uri().'",
						thepath: jQuery("#homePATH").html()
					},
					success: function(data) {
						jQuery("#blake_demos_container .blake_demos_content").append(data);
						jQuery("#blake_demos_container .blake_demos_content .theme-actions a").each(function(){
							jQuery(this).click(function(){
								var url = "'.get_template_directory_uri().'/lib/functions/blake_demo_installer.php";
								var lo_demo = jQuery(this).closest(".theme").attr("data-theme-slug");
								var errors = false;
								var confirmdemo = confirm("This will reset the Wordpress Database so your contents will be lost! Are you sure you want to continue?");
								if (confirmdemo == true){
									if (jQuery(".blake_demo_status").data("uiDialog")) jQuery(".blake_demo_status").dialog("destroy");
									jQuery(".blake_demo_status").attr("title","Applying the demo").html("<span class=\'spinner is-active\'></span>Installing the theme.<br/>Status:<ul class=\'blake_demo_progress\'></ul>").dialog({
										modal: true,
										closeOnEscape: false,
										autoOpen: false,
										draggable: false,
										buttons: [ { text: "Ok", click: function() {  } } ],
										open: function () {
											jQuery(this).closest(".ui-dialog")
												.find(".ui-button") // the first button
												.addClass("ui-state-disabled").blur();
										}
									}).css("text-align","left").find("button").addClass("ui-state-disabled");
									
									jQuery(".blake_demo_status").dialog("open");
									jQuery(".blake_demo_status").data("uiDialog").uiButtonSet.find("button").click(function(){
										var vlocal = window.location.toString();
										if (vlocal.indexOf("&demo") > 0){
											vlocal = vlocal.substr(0, vlocal.indexOf("&demo"));
										}
										window.location = vlocal + "&demo=" + lo_demo;
									});
									
									jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 0%");
									jQuery(".blake_demo_progress").append("<li class=\'des_step_db\'>Database Reset...</li>");
		
									/* reset database & activate theme */
									jQuery.ajax({
										url: url,
										dataType: "json",
										type: "POST",
										data: { 
											demo: lo_demo ,
											action: "dbreset",
											thepath: jQuery("#homePATH").html()
										},
										success: function(response){
											if (response.toString() != "false"){
												errors = response;
											} else {
												jQuery(".blake_demo_progress .des_step_db").html("Database Reset [OK]");
												jQuery(".blake_demo_progress").append("<li>Theme Reactivation [OK]</li>");
												jQuery(".blake_demo_status").dialog("option", "position", "center");
												
												jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 15%");
												jQuery(".blake_demo_progress").append("<li class=\'des_step_plugins\'>Installing Plugins...</li>");
		
												/* plugins installation */
												jQuery.ajax({
													url: url,
													dataType: "json",
													type: "POST",
													data: { 
														demo : lo_demo ,
														action: "install_plugins",
														thepath: jQuery("#homePATH").html()
													},
													success: function(response){
														if (response.toString() != "false"){
															errors = response;
															jQuery(".blake_demo_progress").after("<div class=\'error\'>An unexpected error has occurred. Please <a href=\'#\' onclick=\'javascript:window.location=window.location;\'>refresh</a> the page and try again. If the problem persists, please <a href=\'https://upperinc.com/support/\'>contact us</a>.</div>");
														} else {
															
															jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 35%");
															jQuery(".blake_demo_progress .des_step_plugins").html("Plugins Installed [OK]");
															jQuery(".blake_demo_status").dialog("option", "position", "center");
		
															// set panel options
															jQuery(".blake_demo_progress").append("<li class=\'des_step_panels\'>Setting Panels Options...</li>");
															var xmlPath = "http://upperinc.com/previews/demos/blake/"+lo_demo+"/options.xml";
															var xmlStylePath = "http://upperinc.com/previews/demos/blake/"+lo_demo+"/style_options.xml";
															
															var xmlHandler = jQuery("#templatepath").html()+"/lib/script/loadSettings.php";
															jQuery.ajax({
																url: xmlHandler,
																type: "POST",
																dataType: "json",
																data: {
																	xmlPath: xmlPath,
																	xmlStylePath: xmlStylePath,
																	thepath: jQuery("#homePATH").html()
																},
																success: function (c) {
																	if (c != "false"){
																		errors = c;
																		jQuery(".blake_demo_progress").after("<div class=\'error\'>An unexpected error has occurred. Please <a href=\'#\' onclick=\'javascript:window.location=window.location;\'>refresh</a> the page and try again. If the problem persists, please <a href=\'https://upperinc.com/support/\'>contact us</a>.</div>");
																	} else {
																		jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 60%");
																		jQuery(".blake_demo_progress .des_step_panels").html("Panels Options [OK]");
																		jQuery(".blake_demo_status").dialog("option", "position", "center");
																		jQuery(".blake_demo_progress").append("<li class=\'des_step_contents\'>Importing Contents...</li>");
																		var desitimeout = Math.floor(Math.random() * 12) + 3;
																		var incre = Math.floor(Math.random() * 2) + 1;
																		var perc = 60;
																		blake_import_percentage(desitimeout,incre,perc);
																		
																		// import contents and set homepage and menu
																		jQuery.ajax({
																			url: url,
																			dataType: "json",
																			type: "POST",
																			data: { 
																				demo: lo_demo ,
																				action: "import_content_set_options",
																				thepath: jQuery("#homePATH").html()
																			},
																			complete: function(response){
																				//throws error on failed media import.
																				if (response.status != 200){
																					errors = response;
																					jQuery(".blake_demo_progress").after("<div class=\'error\'>An unexpected error has occurred. Please <a href=\'#\' onclick=\'javascript:window.location=window.location;\'>refresh</a> the page and try again. If the problem persists, please <a href=\'http://support.upperinc.net\'>contact us</a>.</div>");
																				} else {			
																					if (desitimeout){
																						desitimeout = false;
																						clearInterval(window.desigtimeout);
																					}
																					jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 90%");
																					jQuery(".blake_demo_progress .des_step_contents").html("Import Contents [OK]");
																					jQuery(".blake_demo_progress").append("<li>Set Menu [OK]</li>");
																					jQuery(".blake_demo_status").dialog("option", "position", "center");
																					jQuery(".blake_demo_progress").append("<li class=\'des_step_widgets\'>Importing Widgets...</li>");
			
																					// Import Widgets
																					jQuery.ajax({
																						url: url,
																						dataType: "json",
																						type: "POST",
																						data: { 
																							demo: lo_demo ,
																							action: "import_widgets",
																							thepath: jQuery("#homePATH").html()
																						},
																						complete: function(response){
																							jQuery(".blake_demo_status .spinner").removeClass("is-active");
																							jQuery(".blake_demo_progress .des_step_widgets").html("Import Widgets [OK]");
																							jQuery(".blake_demo_status").dialog("option", "position", "center");
																							// Reload to complete. 
																							jQuery(".blake_demo_status").append("<p style=\'left:20px; line-height: 15px;\'>Process almost complete.<br/>Click OK to Continue.</p>");
																							jQuery("button.ui-button.ui-state-disabled").removeClass("ui-state-disabled");
																							jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - 100%");
																						}
																					});
																				}
																			}
																		});
																	}
																}
															});
														}
													}
												});	
											}
										}
									});
								} else {
									console.log("Process aborted by user. Exit.");
								}	
							});
						});
					}
				});
			});
			
			function blake_import_percentage(desitimeout, incre, perc){
				window.desigtimeout = setTimeout(function(){
					if (perc < 90){
						if (perc+incre > 89) incre=89-perc;
						perc = perc+incre;
						jQuery(".blake_demo_status").dialog("option", "title", "Applying the demo - "+perc+"%");
						desitimeout = Math.floor(Math.random() * 12) + 5;
						incre = Math.floor(Math.random() * 2) + 1;
						blake_import_percentage(desitimeout,incre,perc);
					} else {
						clearTimeout(window.desigtimeout);
						desitimeout = false;
					}
				}, desitimeout*1000);
			}
			
		';
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');	
	}

}