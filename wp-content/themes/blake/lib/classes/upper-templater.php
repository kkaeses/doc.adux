<?php

/**
 * This class contains some templating functions - for building HTML code.
 *
 */
Class BlakeTemplater{

	/**
	 * Builds a template for a single custom page list item.
	 * @param $post the post object that represents the item
	 * @param $custom_page a custom page object that represents tha custom page
	 * @param $prefix the prefix of the fields in the form
	 */
	function get_custom_page_list_template($post, $custom_page, $prefix){
		$html='<li id="'.$post->ID.'">';
		if($custom_page->preview_image!='none'){

			if($custom_page->post_type == 'photo_collection' || $custom_page->post_type == 'slider_collection' || $custom_page->post_type == 'camera_collection')
				$html.= '<img src="'.esc_url(get_post_meta($post->ID, $prefix.$custom_page->preview_image, true)).'" />';
			else
				$html.= '<img src="http://li72-68.members.linode.com/media/localtv/site_logos/video_logo_1.jpg" />';
		}
		$html.='<div class="item-wrapper">';
		foreach($custom_page->fields as $field){
			$required=isset($field['required'])?'required':'notrequired';
			$html.='<div class="item"><label>'.esc_html($field['name']).': </label><span class="'.esc_attr($prefix.$field['id'].' '.$field['type'].' '.$required).'">';

			switch($field['id']){
				case 'title':
					$html.=$post->post_title;
					break;
				case 'content':
					$html.=$post->post_content;
					break;
				default:
					$html.=get_post_meta($post->ID, $prefix.$field['id'], true);
					break;
			}
			$html.='</span></div>';
		}
		$html.='</div><input type="hidden" value="'.esc_attr($post->ID).'" id="itemid" name="itemid" /><div class="edit-button hover"></div><div class="delete-button hover"></div><div class="loading"></div></li>';

		return $html;
	}
	
	/**
	 * Returns the HTML that is before each item custom section.
	 * @param $title the title of the item
	 */
	function get_before_custom_section($title){
		$html= '<div class="custom-item-wrapper"><div class="ui-icon ui-icon-triangle-1-e arrow"></div><h3>'.esc_html($title).'</h3>';
		if($title!=BLAKE_DEFAULT_TERM){
			$html.='<div class="delete-slider-button hover"></div>';
		}
		$html.='<div class="custom-section">';
		return $html;
	}
	
	/**
	 * Returns the HTML that is after each item custom section. 
	 */
	function get_after_custom_section(){
		return '</div></div>';
	}

	/**
	 * Builds the template for a custom page form with all the input fields needed.
	 * @param $title the title of the form
	 * @param $category the category that corresponds to the current instance (each instance represents a different category)
	 * @param $custom_page a custom page object that represents the custom page
	 * @param $prefix the prefix of the fields in the form
	 */
	function get_custom_page_form_template($title, $category, $custom_page, $prefix){
		$html='<div class="custom-container"><form class="custom-page-form"><table class="form-table">';

		foreach($custom_page->fields as $field){
			$html.= '<tr><td><span class="custom-heading">'.esc_html($field['name']).'</span></td><td>';
			switch($field['type']){
				case 'text':
					//print a standart text field
					$class=isset($field['required'])?'required':'';
					$html.= '<input type="text" id="'.esc_attr($field['id']).'" name="'.esc_attr($prefix.$field['id']).'" class="'.esc_attr($class).'"/>';
					break;
				case 'radio':
					//print a standart text field
					$class=isset($field['required'])?'required':'';
					$help = 0;
					foreach($field['options'] as $opt){
						$html.= '<label style="padding-left: 20px; padding-right: 8px;" for="'.esc_attr($field['id'].$help).'">'.esc_html($opt).'</label><input type="radio" id="'.esc_attr($field['id'].$help).'" name="'.esc_attr($prefix.$field['id']).'" class="'.esc_attr($class).'" value="'.esc_attr($opt).'" onchange="if(jQuery(this).val() == \'Video\'){jQuery(\'.custom-page-form tr\').each(function(){jQuery(this).css(\'display\', \'none\'); jQuery(this).siblings(\'tr\').eq(0).css(\'display\', \'\'); jQuery(this).find(\'#video_url\').parent().parent().css(\'display\', \'\'); jQuery(this).find(\'#video_id\').parent().parent().css(\'display\', \'\');});jQuery(\'.custom-option-button\').parent().parent().css(\'display\', \'\');} else {jQuery(\'.custom-page-form tr\').each(function(){jQuery(this).css(\'display\', \'\'); jQuery(this).siblings(\'tr\').eq(0).css(\'display\', \'\'); jQuery(this).find(\'#video_url\').parent().parent().css(\'display\', \'none\'); jQuery(this).find(\'#video_id\').parent().parent().css(\'display\', \'none\');}); jQuery(\'.custom-option-button\').parent().parent().css(\'display\', \'\');}"/>';
						$help++;
					}
					
					break;
				case 'select':
					//print a standart text field
					$class=isset($field['required'])?'required':'';
					$html.= '<select id="'.esc_attr($field['id']).'" name="'.esc_attr($prefix.$field['id']).'" class="'.esc_attr($class).'">';
					foreach($field['options'] as $opt){
						if (isset($opt['value']) && isset($opt['name']))
							$html .= '<option value="'.esc_attr($opt["value"]).'">'.esc_html($opt["name"]).'</option>';
					}
					$html .= "</select>";
					break;
				case 'select-color':
					//print a standart text field
					$class=isset($field['required'])?'required':'';
					$html.= '<select id="'.esc_attr($field['id']).'" name="'.esc_attr($prefix.$field['id']).'" class="'.esc_attr($class).'">';
					foreach($field['options'] as $opt){
						$html .= '<option value="'.esc_attr($opt["value"]).'">'.esc_html($opt["name"]).'</option>';
					}
					$html .= "</select>";
					break;
				case 'upload':
					$class=isset($field['required'])?'required':'';
					$button_id='upload_button'.$category;
					$field_id=$field['id'];
					//print a field with an upload button
					$html.= '<input class="option-input upload '.esc_attr($class).'" name="'.esc_attr($prefix.$field['id']).'" id="'.esc_attr($field_id).'" type="text" />';
					$html.= '<div id="'.esc_attr($button_id).'" class="upload-button button" >Upload</div><br/>';

					$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
					$blake_admin_inline_script .= '
						jQuery(document).ready(function(){
							blakeOptions.loadUploader(jQuery("div#'.esc_js($button_id).'"), "'.BLAKE_UTILS_URL.'upload-handler.php", "'.BLAKE_UPLOADS_URL.'");
						});
					';
					wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');

					break;
				case 'upload2':
					$class=isset($field['required'])?'required':'';
					$button_id='upload2_button'.$category;
					$field_id=$field['id'];
					//print a field with an upload button
					$html.= '<input class="option-input upload '.esc_attr($class).'" name="'.esc_attr($prefix.$field['id']).'" id="'.esc_attr($field_id).'" type="text" />';
					$html.= '<div id="'.esc_attr($button_id).'2" class="upload-button button" >Upload</div><br/>';
					
					$blake_admin_inline_script = (isset($blake_admin_inline_script)) ? $blake_admin_inline_script : "";
					$blake_admin_inline_script .= '
						jQuery(document).ready(function(){
							blakeOptions.loadUploader(jQuery("div#'.esc_js($button_id).'2"), "'.BLAKE_UTILS_URL.'upload-handler.php", "'.BLAKE_UPLOADS_URL.'");
						});
					';
					wp_add_inline_script('blake-admin', $blake_admin_inline_script, 'after');
					
					break;
				case 'textarea':
					//print a textarea
					$class=isset($field['required'])?'required':'';
					$html.= '<textarea id="'.esc_attr($field['id']).'" name="'.esc_attr($prefix.$field['id']).'" class="'.esc_attr($class).'" "></textarea>';
					break;
			}
			$html.='</td></tr>';
		}


		$html.='<tr><td colspan="2">';
		//display some hidden inputs with the main item data that may be used in AJAX requests later
		$html.='<input type="hidden" name="category" value="'.esc_attr($category).'" class="category" />';
		$html.='<input type="hidden" name="default_title" value="'.esc_attr($title).'" />';
		$html.='<input type="hidden" name="post_type" value="'.esc_attr($custom_page->post_type).'" />';

		$html.='<div class="loading"></div>';
		//print the add button
		$html.= '<a class="button custom-option-button" ><span>ADD</span></a>';

		$html.='</td></tr></table>';

		$html.='</form></div>';
		return $html;

	}
}