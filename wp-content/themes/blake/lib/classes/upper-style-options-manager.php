<?php

/**
 * This is the main class for managing options. Its purpose is to build an options page by a predefined
 * set of options. This class contains the functionality for printing the whole options page - its header,
 * footer and all the options inside.
 */
class BlakeStyleOptionsManager{

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
	 * The main constructor for the BlakeStyleOptionsManager class
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
			echo '<div class="note_box">Welcome to '.esc_html($this->themename).' theme! On this page you can set the main options
			of the theme. For more information about the theme setup, please refer to the documentation included, which
			is located within the "documentation" folder of the downloaded zip file. We hope you will enjoy working with the theme!</div>';
			
		}
		echo '<div id="blake-content-container"><form method="post" id="blake-style-options">';
		if ( function_exists('wp_nonce_field') ){
			wp_nonce_field('blake-theme-update-style-options','blake-theme-style-options');
		}
		echo '<div id="sidebar"><div id="logo"></div><div id="navigation"><ul>';

		$i=1;
		foreach ($this->options as $value) {

			if($value['type']=='title'){
				$namestr = str_replace(" ", "_", $value['name']);
				$namestr = str_replace("_/", "", $namestr);
				echo '<li><span><a href="#navigation-'.esc_attr($i).'"><div class="'.esc_attr(strtolower(str_replace(" ", "_", $value['name']))).'"></div><i class="fa fa-'.esc_attr(strtolower($namestr)).'-painel" style="position:relative;float:left;line-height:47px;margin-left:20px;margin-right:5px;font-size: 15px;"></i><span>'.esc_html($value['name']).'</span></a></span></li>';
				$i++;
			}
		}

		echo '</ul></div></div><div id="content"><div id="header"><h3 id="theme_name">'.esc_html($this->themename).' <span>v.'.esc_html($this->blake_version).'</span></h3><a class="online-doc" href="http://docs.upperinc.com/blake-wp/" target="_blank"><i class="fa fa-file-text-o"> </i>&nbsp; Online Documentation</a><a class="support" target="_blank" href="http://upperinc.com/support"><i class="fa fa-comments-o"></i> Help & Support Forum</a></div><input type="submit" value="Save Changes" class="save-button" /><div id="options_container">';
	}
	
	/**
	 * Prints the footer of the options panel.
	 */
	function print_footer(){
		echo '</div></div><div id="blake-footer"><div id="follow-upper"> 
			 <p>Follow us</p><ul>
			 <li><a href="http://facebook.com/UpperInc" title="Upper on Facebook"><img src="'.esc_url($this->blake_images_url).'facebook.png" /></a></li>
			 <li><a href="http://twitter.com/UpperInc" title="Upper on Twitter"><img src="'.esc_url($this->blake_images_url).'twitter.png" /></a></li>
			 
			 
			 </ul></div><input type="hidden" name="action" value="save" />
			 <input type="submit" value="Save Changes" class="save-button" />
			 </div>	
			</form></div>';
	}

	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	function print_options(){
		$i=0;
		foreach ($this->options as $value) {
			switch ( $value['type'] ) {
				case 'open':
					$this->print_subnavigation($value, $i);
				break;
				case 'subtitle':
					$this->print_subtitle($value, $i);
				break;
				case 'close':
					$this->print_close();
				break;
				case 'title':
					$i++;
				break;
				case 'text':
					$this->print_text_field($value);
				break;
				case 'slider':
					$this->print_slider_field($value);
				break;		
				case 'textarea':
					$this->print_textarea($value);
				break;
				case 'select':
					$this->print_select($value);
				break;
				case 'multicheck':
					$this->print_multicheck($value);
				break;
				case 'color':
					$this->print_color($value);
				break;
				case 'upload':
					$this->print_upload($value);
				break;
				
				/* PARIS NEW STUFF */
				
				case 'opacity_slider':
					$this->print_opacity_slider($value);
				break;
				
				case 'upload_from_media':
					$this->print_upload_from_media($value);
				break;
				
				case 'checkbox':
					$this->print_checkbox($value);
				break;
				case 'checkbox-text-image':
					$this->print_checkbox_text_image($value);
				break;
				case 'checkbox-left-right':
					$this->print_checkbox_left_right($value);
				break;
				case 'checkbox-light-dark':
					$this->print_checkbox_light_dark($value);
				break;
				case 'custom':
					$this->print_custom($value);
				break;
				case 'pattern':
					$this->print_stylebox($value, 'pattern');
				break;
				case 'stylecolor':
					$this->print_stylebox($value, 'color');
				break;
				case 'documentation':
					$this->print_text($value);	
				break;
				case 'mediaupload':
					$this->print_mediaupload($value);
				break;
			}
		}
	}

	/**
	 * Prints the subnavigation tabs for each of the main navigation blocks.
	 * @param $value the option that contains the data that needs to be printed
	 * @param $i the index of the main navigation block to which the subnavigation belongs to
	 */
	function print_subnavigation($value, $i){
		echo '<div id="navigation-'.esc_attr($i).'" class="main-navigation-container">';
		if($value['subtitles']){
			echo '<div id="tab_navigation-'.esc_attr($i).'" class="tab_navigation" ><ul>';
			foreach($value['subtitles'] as $subtitle){
				echo '<li><a href="#tab_navigation-'.esc_attr($i).'-'.esc_attr($subtitle['id']).'" class="tab"><span>'.esc_html($subtitle['name']).'</span></a></li>';
			}
			echo '</ul></div>';
	 	}
	}
	
	/**
	 * Prints a subtitle - a single tab title
	 * @param $value the option array that contains the data to be printed
	 * @param $i the index of the content block that will be opened when the tab is clicked
	 */
	function print_subtitle($value, $i){
		echo '<div id="tab_navigation-'.esc_attr($i).'-'.esc_attr($value['id']).'" class="sub-navigation-container">';
	}
	
	/**
	 * Prints a closing div tag.
	 */
	function print_close(){
		echo '</div>';
	}
	
	/**
	 * Prints the code that goes after each option.
	 * @param $value the array that contains all the data for the option
	 */
	function close_option($value){
		if(isset($value['desc'])){
			echo '<a href="" class="help-button"><div class="help-dialog" title="'.esc_attr($value['name']).'"><p>'.wp_kses_post($value['desc']).'</p></div></a>';
		}
		echo wp_kses_post($this->after_option);
	}

	/**
	 * Prints a standart text field.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Text Field Title",
	 *	"id" => $shortname."_test_textfield",
	 *	"type" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_text_field($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="'.esc_attr($value['type']).'" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	function print_slider_field($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="slider" title="'.esc_attr($value['id']).'"></div><input class="option-input slider-input" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" style="text-align: center; border: 0; background: none; color: #314572; width: 201px; padding: 5px 0 0 0; margin: 0; font-style: italic;" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Textarea Name",
	 *	"id" => $shortname."_test_textarea",
	 *	"type" => "textarea")
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_textarea($value){
		if (isset($value['name']))
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo ' <textarea name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" class="option-textarea" cols="" rows="">'.wp_kses_post($input_value).'</textarea>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a select drop down menu.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Featured Category",
	 *	"id" => $shortname."_featured_cat",
	 *	"type" => "select",
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_select($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
			
		echo '<select class="option-select" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'">';
		
		foreach ($value['options'] as $option) {
			$attr='';
			if (isset($option['id'])){
				if ( get_option( $value['id'] ) == $option['id']) {
					$attr = ' selected="selected"';
				 }
			 	 if ( $option['id'] == 'disabled') {
					$attr.= ' disabled="disabled"';
				 }
				 if (isset($option['class'])){
					$attr.=' class="'.esc_attr($option['class']).'"';			 	
				 }
				echo '<option '.$attr.' value="'.esc_attr($option['id']).'">'.esc_html($option['name']).'</option>';
			}	 
		} 
	
		echo '</select>';
		$this->close_option($value);
	}	
	
	
	/**
	 * Prints a multicheck widget.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Exclude categories",
	 *	"id" => $shortname."_exclude_cat",
	 *	"type" => "multicheck",
	 *  "class" => "exclude", //exclude|include
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_multicheck($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		
		$checked_class=$value['class']==''?'include':$value['class'];
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" class="hidden-value" /><div class="option-check '.esc_attr($checked_class).'">';
		
		$input_array=explode(',',$input_value);
		foreach ($value['options'] as $option) {
			$class='';	
			 if (in_array($option['id'], $input_array)) {
				$class = ' selected-check';
			 }
			echo '<div class="check-holder"><a href="" class="check'.esc_attr($class).'" title="'.esc_attr($option['id']).'"></a><span class="check-value">'.esc_html($option['name']).'</span></div>'; 
		} 
		echo '</div>';
	
		$this->close_option($value);
	}	
	
	/**
	 * Prints a text field with a color picker option.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Headings color",
	 *	"id" => $shortname."_heading_color",
	 *	"type" => "color"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_color($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<span class="numbersign">&#35;</span><input class="option-input color" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" />';
		echo '<div class="color-preview" style="background-color:#'.esc_html($input_value).'"></div>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a text field with an upload button.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Logo image",
	 *	"id" => $shortname."_logo_image",
	 *	"type" => "upload"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_upload($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input upload" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" />';
		echo '<div id="'.esc_attr($value['id']).'_button" class="upload-button upload-logo" ><a class="blake-button alignright"><span class="upload-panel">Upload</span></a></div><br/>';
		
		//call the script for this upload button particularly
		$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
		$blake_admin_inline_script .= '
			jQuery(document).ready(function(){
				blake_StyleOptionsManager.loadUploader(jQuery("div#'.esc_js($value['id']).'_button"), "'.esc_js($this->blake_utils_url).'upload-handler.php", "'.esc_js($this->blake_uploads_url).'");
			});
		';
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
		
		$this->close_option($value);
	}
		
	
	/* opacity slider - goes from nod to hundred. making this values editable in the future would be nice. */
	function print_opacity_slider($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="slider opacity-slider" title="'.esc_attr($value['id']).'"></div><input class="option-input slider-input" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" style="text-align: center; border: 0; background: none; color: #314572; width: 201px; padding: 5px 0 0 15px; margin: 0; font-style: italic;" />';
		$this->close_option($value);
	}
	
	
	/**
	 * Prints a text field with an upload button.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Logo image",
	 *	"id" => $shortname."_logo_image",
	 *	"type" => "uploadFromMedia"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_upload_from_media($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		?>
		
		<div class="uploader" id="upload-<?php echo esc_attr($value['id']); ?>">
		  <?php echo '<input class="option-input upload" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" style="display:none;"/>'; ?>
		  <textarea type="textarea" style="display:none;"><?php echo wp_kses_post($input_value); ?></textarea>
		  <input class="button buttonUploader" name="<?php echo esc_attr($value['id']); ?>_button" id="<?php echo esc_attr($value['id']); ?>_button" value="Select Media" style="width:auto;text-align:center;"/>
		  <img class="previewimg" src="<?php echo esc_url($input_value); ?>" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;"/>
		</div>
		
		<?php
		$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
		$blake_admin_inline_script .= '
			jQuery(document).ready(function(){
				var uploadbox = "#upload-'.esc_js($value["id"]).'";
				var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
				var thumbs = jQuery(uploadbox + " .option-input").val();
				for (var i = 0; i < thumbs.length; i++){
					if (thumbs != ""){
						var url = thumbs;
						jQuery(uploadbox + " .previewimg").attr("src",url).css("display","block");
					}
				}
				jQuery(uploadbox + " .buttonUploader").click(function(e) {
					var button = jQuery(this);
					var id = button.attr("id").replace("upload-", "").replace("_button","");
					var custom_uploader = wp.media({
						title: "Select Media",
						button: {
							text: "Select Media"
						},
						multiple: false
					})
					.on("select", function() {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						if (attachment){
							jQuery(uploadbox + " .previewimg").attr("src",attachment.url).css("display","block");
						}
						jQuery("#"+id).val(attachment.url);
					})
					.open(button);
					return false;
				});
			});
		';
		wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
		
		$this->close_option($value);
	}
	
	
	
	
	
	/**
	 * Prints a checkbox - this is the ON/OFF widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox",
	 *	"std" => "off"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std']))
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="on-off"><span></span></div>';
		if(isset($input_value) && $input_value=='true'){
			$input_value='on';
		}
		if(isset($input_value) && $input_value=='false'){
			$input_value='off';
		}
		if (isset($input_value))
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the TEXT/IMAGE widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-text-image",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_text_image($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="text-image"><span></span></div>';
		if($input_value=='true'){
			$input_value='text';
		}
		if($input_value=='false'){
			$input_value='image';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the LEFT/RIGHT widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-left-right",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_left_right($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="left-right"><span></span></div>';
		if($input_value=='true'){
			$input_value='right';
		}
		if($input_value=='false'){
			$input_value='left';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox with images - this is the LIGHT/DARK widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "images",
	 *	"std" => "light"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_light_dark($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="light-dark"><span></span></div>';
		if($input_value=='true'){
			$input_value='light';
		}
		if($input_value=='false'){
			$input_value='dark';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a widget for selecting styles for the theme. Generally it prints different buttons with
	 * different styles set to them so that the user can select one of them. It can be mostly used for 
	 * selecting a color or a pattern from a given range.
	 * 
	 * EXAMPLE USAGE OF PATTERNS:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name" => "Theme Pattern",
	 *	"id" => $shortname."_pattern",
	 *	"type" => "pattern",
	 *	"options" => $patterns
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 * @param $type the type of the buttons, so far the supported values are "color" and "pattern"
	 */
	function print_stylebox($value, $type){
		
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<div class="styles-holder">';
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" /><ul>';
		
		$counter=0;
		foreach ($value['options'] as $option) {
			//set a style the option if this is an option for selecting a color or pattern 
			if($type=='pattern') {
				//this is a pattern, set a background image to it
				if($option != "none")
					$style='background-image:url('.BLAKE_PATTERNS_URL.$option.');';
				else
					$style='background-image:none;';
			}elseif($type=='color'){
				//this is a color, set background color to it
				$style='background-color:#'.$option.';';
			}
			$class=$option==$input_value?'selected-style':'';
			
			echo '<li onclick="jQuery(this).parents(\'.sub-navigation-container\').find(\'#'."blake".'_style_color\').attr(\'value\',\''.esc_js($option).'\'); jQuery(this).parents(\'.sub-navigation-container\').find(\'.color-preview\').css(\'background-color\',\'#'.esc_js($option).'\');" style="'.esc_attr($style).'" class="'.esc_attr($class).'"><a class="style-box" title="'.esc_attr($option).'" href=""></a></li>';
		} 
		echo '</ul></div>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a custom set of fields with an Add button - this field will be mostly used when 
	 * several items that share the same data structure needs to be added. For example, this can be very
	 * useful for adding images to the slider with different options- title, link, etc.
	 * So far the fields that are supported by this function are text field, text field with upload button and a 
	 * textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name"=>"Add Slider Image",
	 *	"id"=>'thumbnail_slider',
	 *	"type"=>"custom",
	 *	"button_text"=>'Add image',
	 *	"preview"=>"thumbnail_image_name",
	 *		"fields"=>array(
	 *			array('id'=>'thumbnail_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	 *			array('id'=>'thumbnail_image_title', 'type'=>'text', 'name'=>'Image Title'),
	 *			array('id'=>'thumbnail_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
	 *		)
	 *	)
     * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_custom($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title.'<br/><br/><br/>');
		
		$field_ids=array();
		$field_names=array();
		$is_textarea=array();
		
		foreach($value['fields'] as $field){
			echo '<div class="custom-option"><span class="custom-heading">'.esc_html($field['name']).'</span>';
			switch($field['type']){
				case 'text':
					//print a standart text field
					echo '<input type="text" id="'.esc_attr($field['id']).'" name="'.esc_html($field['id']).'"/>';
					$is_textarea[]="false";
				break;
				case 'upload':
					//print a field with an upload button
					echo '<input class="option-input upload" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" type="text" />';
					echo '<div id="'.esc_attr($field['id']).'_button" class="upload-button upload-logo" ><a class="blake-button alignright"><span>Upload</span></a></div><br/>';
					echo '<script type="text/javascript">jQuery(document).ready(function($){
								blake_StyleOptionsManager.loadUploader(jQuery("div#'.esc_js($field['id']).'_button"), "'.esc_js($this->blake_utils_url).'upload-handler.php", "'.esc_js($this->blake_uploads_url).'");
						});</script>';
					$preview=$field['id'];
					$is_textarea[]="false";
				break;
				case 'textarea':
					//print a textarea
					echo '<textarea id="'.esc_attr($field['id']).'" name="'.esc_attr($field['id']).'"></textarea>';
					$is_textarea[]="true";
				break;
				case 'select':
					if (isset($value['std'])) $std = $field['std']; 
					else $std = "";
					$input_value = $this->get_field_value($field['id'], $std);
					
					echo '<select class="option-select" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">';

					foreach ($field['options'] as $option) {
						$attr='';	
						 if ( get_option( $field['id'] ) == $option['id']) {
							$attr = ' selected="selected"';
						 }
					 	 if ( $field['id'] == 'disabled') {
							$attr.= ' disabled="disabled"';
						 }
						 if($option['class']){
							$attr.=' class="'.esc_attr($option['class']).'"';			 	
						 }
						echo '<option '.esc_attr($attr).' value="http://fonts.googleapis.com/css?family='.$option['id'].'">'.$option['name'].'</option>'; 
					} 

					echo '</select><div>';
					$this->close_option($value);
					$is_textarea[]="true";
				break;
				
				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					
					$output .= '<div id="'.esc_attr($value['id']).'" class="sorter">';
					
					
					if ($sortlists) {
					
						foreach ($sortlists as $group=>$sortlist) {
						
							$output .= '<ul id="'.esc_attr($value['id']).'_'.$group.'" class="sortlist_'.esc_attr($value['id']).'">';
							$output .= '<h3>'.wp_kses_post($group).'</h3>';
							
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-placebo" type="hidden" name="'.esc_attr($value['id']).'['.esc_attr($group).'][placebo]" value="placebo">';
									
								if ($key != "placebo") {
								
									$output .= '<li id="'.esc_attr($key).'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.esc_attr($value['id']).'['.esc_attr($group).']['.esc_attr($key).']" value="'.esc_attr($list).'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}
					
					$output .= '</div>';
				break;
			}
			if (isset($value['std'])) $std = $value['std']; 
			else $std = "";
			$saved_value=$this->get_field_value( $field['id'].'s',$std );
						
			$saved_value=stripslashes($saved_value);
			echo '<input type="hidden" name="'.esc_attr($field['id']).'s" id="'.esc_attr($field['id']).'s" value="'.esc_attr($saved_value).'" />';
			echo '<textarea style="display:none;" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">'.wp_kses_post($saved_value).'</textarea></div>';
			$field_ids[]=$field['id'];
			$field_names[]=$field['name'];
			
			if ($field['id'] == "blake_google_fonts_name"){
				$fonts = explode("|*|",$saved_value);
				if (count($fonts) > 1){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){';
					foreach($fonts as $f){
						if ($f != "")
							echo 'jQuery(\'#add_google_font_list\').append(\'<li><b>Font URL: </b><span class="blake_google_fonts_name_span">'.$f.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';
					}
					echo '});
					</script>';	
				}
			}
			
			
			if ($field['id'] == "blake_sidebar_name_name"){
				$sidebars = explode("|*|",$saved_value);
				
				if (count($sidebars) > 0){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){';
						
					foreach($sidebars as $s){
						if ($s != ""){
							echo 'jQuery(\'#sidebar_name_list\').append(\'<li><b>Name: </b><span class="blake_sidebar_name_span">'.$s.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';	
						}
					}
					echo '});
					</script>';	
				}
			}
		}
		
		//print the add button
		echo '<a class="blake-button custom-option-button" id="'.esc_attr($value['id']).'_button"><span>'.wp_kses_post($value['button_text']).'</span></a>';
		
		//print the list that will contain the added items
		//if ($value['id'] != 'blake_reset_options_button')
		echo '<ul id="'.esc_attr($value['id']).'_list" class="sortable"></ul>';
		
		$idsString=implode('","', $field_ids);
		$namesString=implode('","', $field_names);
		$textareaString=implode(',', $is_textarea);
		
		if (isset($value['preview'])) $prv = $value['preview']; 
		else $prv = "";
		
		//call the script that enables the functionality for adding custom fields
		$updir = wp_upload_dir();
		$optsxml = $updir['baseurl']."/style_options.xml";
		$urlassign = get_template_directory_uri()."/lib/functions/getstyleXML.php?url=".esc_url(get_home_path());
		
		echo '<script type="text/javascript">
			jQuery(document).ready(function($){
				blake_StyleOptionsManager.setCustomFieldsFunc("'.esc_js($value['id']).'", ["'.esc_js($idsString).'"], ["'.esc_js($namesString).'"], ['.esc_js($textareaString).'] , "'.esc_js($prv).'",  "");
				jQuery(\'#blake_export_style_options_button\').css({\'position\':\'relative\',\'float\':\'left\'}).attr(\'target\',\'_blank\').unbind().click(function(){
					window.open("'.esc_js($urlassign).'");
				});
			});
		</script>';
		
		$this->close_option($value);
	}
		
	/**
	 * Gets the saved value for a field
	 * @param $id the ID of the field
	 * @param $std the default value for the field
	 * @return string if there is a saved value, it returns the saved value,
	 * if not - it returns the default value
	 */
	function get_field_value($id, $std){
		if ( get_option( $id ) != "" || $this->first_save) {
			if (is_array(get_option($id)))
				return "";
			else 
				return stripslashes((string)get_option($id)); 
		} else {
			return stripslashes($std); 
		}
	}
	
	function print_text($value){
		echo wp_kses_post($this->before_option);
		echo wp_kses_post($value['text']);
		$this->close_option($value);
	}
	
	/**
	 * Prints the message that is displayed when the options have been saved
	 */
	function print_saved_message(){
		echo '<div class="note_box" id="saved_box">'.esc_html($this->themename).' settings saved.</div>';	
	}
	
	/**
	 * Prints the message that is displayed when the options have been reset
	 */
	function print_reset_message(){
		echo '<div><p>'.esc_html($this->themename).' settings reset.</p></div>';	
	}
	
	function print_mediauploader($value){
		dump($value);
		$modal_update_href = esc_url( add_query_arg( array(
		    'page' => 'blake_gallery',
		    '_wpnonce' => wp_create_nonce('blake_gallery_options'),
		), admin_url('upload.php') ) );

		echo esc_url($modal_update_href);
		
	}
	
}