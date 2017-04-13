<?php

/** WP Latest Posts main class * */
class wpcuWPFnPlugin extends YD_Plugin {

    //TODO: separate front-end and back-end methods, only include necessary code

    const CUSTOM_POST_NEWS_WIDGET_NAME = 'wpcuwpfp-news-widget';
    const CUSTOM_POST_NONCE_NAME = 'wpcufpn_editor_tabs';
    const POSITIVE_INT_GT1 = 'positive_integer_1+';  //Those fields need to have a positive integer value greater than 1
    const BOOL = 'bool';       //Booleans
    const FILE_UPLOAD = 'file_upload';    //File uploads
    const LI_TO_ARRAY = 'li_to_array';    //Convert sortable lists to array
    const DEFAULT_IMG_PREFIX = 'wpcufpn_default_img_';  //Default uploaded image file prefix
    const MAIN_FRONT_STYLESHEET = 'css/wpcufpn_front.css';  //Main front-end stylesheet
    const MAIN_FRONT_SCRIPT = 'js/wpcufpn_front.js';  //Main front-end jQuery script
    const DEFAULT_IMG = 'img/default-image-fpnp.png'; //Default thumbnail image
    //const   THEME_LIBRARY                   = 'themes/default/default.php';
    const USE_LOCAL_JS_LIBS = true;

    /** Field default values * */
    private $_field_defaults = array(
        'default_img' => '',
        'source_type' => 'src_category',
        'cat_post_source_order' => 'date',
        'cat_post_source_asc' => 'desc',
        'cat_source_order' => 'date',
        'cat_source_asc' => 'desc',
        'pg_source_order' => 'order',
        'pg_source_asc' => 'desc',
        'show_title' => 1, // Wether or not to display the block title
        'amount_pages' => 1,
        'amount_cols' => 3,
        'pagination' => 2,
        'max_elts' => 5,
        'off_set' => 0, //number posts to skip
        'total_width' => 100,
        'total_width_unit' => 0, //%
        'crop_title' => 2,
        'crop_title_len' => 1,
        'crop_text' => 2,
        'crop_text_len' => 2,
        'autoanimation' => 0,
        'autoanimation_trans' => 1,
        'theme' => 'default',
        'box_top' => array(),
        'box_left' => array('Thumbnail'),
        'box_right' => array('Title', 'Date', 'Text'),
        'box_bottom' => array(),
        'thumb_img' => 1, // 0 == use featured image
        'image_size' => 'mediumSize',
        'thumb_width' => 150, // in px
        'thumb_height' => 150, // in px
        'crop_img' => 0, // 0 == do not crop (== resize to fit)
        'margin_left' => 0,
        'margin_top' => 0,
        'margin_right' => 4,
        'custom_css' => '',
        'margin_bottom' => 4,
        'date_fmt' => '',
        'no_post_text' => '',
        'read_more' => '',
        'default_img_previous' => '', // Overridden in constructor
        'default_img' => '', // Overridden in constructor
        'dfThumbnail' => 'Thumbnail',
        'dfTitle' => 'Title',
        'dfText' => 'Text',
        'dfDate' => 'Date',
        'dfCategory' => 'Category',
    );

    /** Specific field value properties to enforce * */
    private $_enforce_fields = array(
        'amount_pages' => self::POSITIVE_INT_GT1,
        'amount_cols' => self::POSITIVE_INT_GT1,
        'amount_rows' => self::POSITIVE_INT_GT1,
        'max_elts' => self::POSITIVE_INT_GT1,
        'default_img' => self::FILE_UPLOAD,
        'box_top' => self::LI_TO_ARRAY,
        'box_left' => self::LI_TO_ARRAY,
        'box_right' => self::LI_TO_ARRAY,
        'box_bottom' => self::LI_TO_ARRAY,
    );

    /** Drop-down menu values * */
    private $_pagination_values = array(
        'None',
        'Arrows',
        'Arrows with bullets',
        'Bullets'
    );
    public $_width_unit_values = array(
        '%',
        'em',
        'px'
    );
    private $_thumb_img_values = array(
        'Use featured image',
        //'Use first attachment',
        'Use first image'
    );

    /**
     * Headers for style.css files.
     *
     * @static
     * @access private
     * @var array
     */
    private static $file_headers = array(
        'Name' => 'Theme Name',
        'ThemeURI' => 'Theme URI',
        'Description' => 'Description',
        'Author' => 'Author',
        'AuthorURI' => 'Author URI',
        'Version' => 'Version',
        'Template' => 'Template',
        'Status' => 'Status',
        'Tags' => 'Tags',
        'TextDomain' => 'Text Domain',
        'DomainPath' => 'Domain Path',
    );

    /**
     * Counts how many widgets are being displayed
     * @var int
     */
    public $widget_count = 0;

    /**
     * Constructor
     * 
     */
    public function __construct($opts) {

        parent::YD_Plugin($opts);
        $this->form_blocks = $opts['form_blocks']; // YD Legacy (was to avoid "backlinkware")

        /** Check PHP and WP versions upon install * */
        register_activation_hook(dirname(dirname(__FILE__)), array($this, 'activate'));

        //add_action('init', array($this, 'checkUsed'));

        /** Setup default image * */
        $this->_field_defaults['default_img_previous'] = plugins_url(self::DEFAULT_IMG, dirname(__FILE__));

        $this->_field_defaults['default_img'] = plugins_url(self::DEFAULT_IMG, dirname(__FILE__));

        /** Sets up custom post types * */
        add_action('init', array($this, 'setupCustomPostTypes'));

        /** Register our widget (implemented in separate wp-fpn-widget.inc.php class file) * */
        add_action('widgets_init', function() {
            register_widget('wpcuFPN_Widget');
        });

        /** Register our shortcode * */
        add_shortcode('frontpage_news', array($this, 'applyShortcode'));


        add_filter('post_updated_messages', array($this, 'wpcufpn_custom_update_messages'));
        if (is_admin()) {
            if(is_multisite()){
                switch_to_blog(get_current_blog_id());
                $current_screen = $_SERVER['REQUEST_URI'];
                $post_type = isset($_GET['post']) ? get_post_type($_GET['post']) : "";
                if (isset($_GET['post_type']) && strpos($current_screen,'post-new.php') !== FALSE) {
                    $post_type = $_GET['post_type'];
                }

                restore_current_blog();
            }else{
                global $pagenow;
                $post_type = isset($_GET['post']) ? get_post_type($_GET['post']) : "";
                if (isset($_GET['post_type']) && $pagenow == "post-new.php") {
                    $post_type = $_GET['post_type'];
                }
            }
            if (wpcuWPFnPlugin::CUSTOM_POST_NEWS_WIDGET_NAME == $post_type) {


                /** Load tabs ui + drag&drop ui * */
                add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));

                /** Load admin css for tabs * */
                add_action('admin_init', array($this, 'addAdminStylesheets'));

                add_action( 'wp_print_scripts', array($this,'dequeueAdminScripts'));
            }

            /** Customize custom post editor screen * */
            //add_action( 'admin_head', array( $this, 'changeIcon' ) );	//Unused
            add_action('admin_menu', array($this, 'setupCustomMetaBoxes'));
            add_action('admin_menu', array($this, 'setupCustomMenu'));
            add_action('save_post', array($this, 'saveCustomPostdata'));

            /** Customize Tiny MCE Editor * */
            add_action('admin_init', array($this, 'setupTinyMce'));
            add_action('in_admin_footer', array($this, 'editorFooterScript'));

            /** Tiny MCE 4.0 fix * */
            if (get_bloginfo('version') >= 3.9) {
                add_action('media_buttons', array($this, 'editorButton'), 1000); //1000 = put it at the end
            }

            if (!class_exists('wpcuWPFnProPlugin'))
                add_filter('plugin_row_meta', array($this, 'addProLink'), 10, 2);

            //ajax of mutilsite
            add_action('wp_ajax_change_cat_multisite',array($this,'change_cat_multisite'));
        } else {

            /** Load our theme stylesheet on the front if necessary * */
            add_action('wp_print_styles', array($this, 'addStylesheet'));

            /** Load our fonts on the front if necessary * */
            add_action('wp_print_styles', array($this, 'addFonts'));

            /** Load our front-end slide control script * */
            //add_action( 'wp_print_scripts', array( $this, 'addFrontScript' ),0 );
            add_action('the_posts', array($this, 'prefixEnqueue'), 100);
            //add_action( 'after_setup_theme', array( $this, 'child_theme_setup' ) );
        }
    }
    /**
     * change category of blog
     */
    public function change_cat_multisite(){
        if(isset($_POST['val_blog']))
            $val_blog = $_POST['val_blog'];
        if(isset($_POST['type']))
            $type = $_POST['type'];

        $output = '';
        $cats = array();
        if('all_blog' == $val_blog){
            $blogs = get_sites();
            foreach ($blogs as $blog){
                switch_to_blog( (int)$blog->blog_id );
                if(strpos($type,'post') !== false){
                    $allcats = get_categories();
                }elseif(strpos($type,'page') !== false){
                    $allcats = get_pages();
                }elseif(strpos($type,'tag') !== false){
                    $allcats = get_tags();
                }
                foreach ($allcats as $allcat) {
                    $cats[] = $allcat;
                }
                restore_current_blog();
            }
        }else{
            switch_to_blog((int)$val_blog);
            if(strpos($type,'post') !== false){
                $cats = get_categories();
            }elseif(strpos($type,'page') !== false){
                $cats = get_pages();
            }elseif(strpos($type,'tag') !== false){
                $cats = get_tags();
            }
            restore_current_blog();

        }

        if(strpos($type,'post') !== false){
            $output .= '<ul  class="post_field">';
            $output .= '<li><input id="cat_all" type="checkbox" name="wpcufpn_source_category[]" value="_all" ' . (isset($source_cat_checked['_all']) ? $source_cat_checked['_all'] : '') . ' />' .
                '<label for="cat_all" class="post_cb">All</li>';
            foreach ($cats as $k => $cat) {
                $output .= '<li><input id="ccb_' . $k . '" type="checkbox" name="wpcufpn_source_category[]" value="' .$k.'_'.
                    $cat->term_id . '" class="post_cb" />';
                $output .= '<label for="ccb_' . $k . '" class="post_cb">' . $cat->name . '</label></li>';
            }
            $output .= '</ul>';
        }elseif(strpos($type,'page') !== false){
            $output .= '<ul class="page_field">';
            $output .= '<li><input id="page_all" type="checkbox" name="wpcufpn_source_pages[]" value="_all" />' .
                '<label for="page_all" class="page_cb">All Pages</li>';

            foreach ($cats as $k => $page){
                $output .= '<li><input id="pcb_' . $k. '" type="checkbox" name="wpcufpn_source_pages[]" value="' .$k.'_'.
                    $page->ID . '" class="page_cb" />';
                $output .= '<label for="pcb_' . $k . '" class="page_cb">' . $page->post_title . '</label></li>';
            }
            $output .= '</ul>';	//fields
        }elseif(strpos($type,'tag') !== false){
            $output .= '<ul class="tag_field">';
            $output .= '<li><input id="tags_all" type="checkbox" name="wpcufpn_source_tags[]" value="_all"  />' .
                '<label for="tags_all" class="tag_cb">All tags</li>';

            foreach ($cats as $k => $tag){
                $output .= '<li><input id="tcb_' . $k . '" type="checkbox" name="wpcufpn_source_tags[]" value="' .$k.'_'.
                    $tag->term_id . '"  class="tag_cb" />';
                $output .= '<label for="tcb_' . $k . '" class="tag_cb">' . $tag->name . '</label></li>';
            }
            $output .= '</ul>';
        }

        echo json_encode(array('output' => $output,'type' => $type));
        exit;
    }

    /**
     * Plugin Activation hook function to check for Minimum PHP and WordPress versions
     * @see http://wordpress.stackexchange.com/questions/76007/best-way-to-abort-plugin-in-case-of-insufficient-php-version
     * 
     * @param string $wp Minimum version of WordPress required for this plugin
     * @param string $php Minimum version of PHP required for this plugin
     */
    public function activate($wp = '3.2', $php = '5.3.1') {
        global $wp_version;
        if (version_compare(PHP_VERSION, $php, '<')) {
            $flag = 'PHP';
        } elseif (version_compare($wp_version, $wp, '<')) {
            $flag = 'WordPress';
        } else {
            $this->checkUsed();
            return;
        }
        $version = 'PHP' == $flag ? $php : $wp;
        deactivate_plugins(basename(__FILE__));
        wp_die('<p>The <strong>WP Latest Posts</strong> plugin requires ' . $flag . '  version ' . $version . ' or greater.</p>', 'Plugin Activation Error', array('response' => 200, 'back_link' => TRUE));
    }

    /**
     * check user
     * use new theme default for new users
     */
    public function checkUsed() {
        global $wpdb;
        $oldBlock = get_option("_wpcufpn_onceLoad");
        if (empty($oldBlock)) {
            $meta_key = "_wpcufpn_settings";
            $postsId = $wpdb->get_results($wpdb->prepare(" SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s ", $meta_key));
            if (!empty($postsId)) {
                foreach ($postsId as $postId) {
                    $postId = $postId->post_id;
                    $postMeta = get_post_meta($postId, "_wpcufpn_settings", true);
                    if (strpos($postMeta['theme'], "default")) {
                        $postMeta['theme'] = addslashes($postMeta['theme']);
                        update_post_meta($postId, "_wpcufpn_settings", $postMeta);
                    }
                }
            }
            $onceLoad = 1;
            add_option("_wpcufpn_onceLoad", $onceLoad, "", "no");
        }
    }

    /**
     * Sets up WP custom post types
     * 
     */
    public function setupCustomPostTypes() {
        $labels = array(
            'name' => __('WP Latest Posts Blocks', 'wp-latest-posts'),
            'singular_name' => __('WPLP Block', 'wp-latest-posts'),
            'add_new' => __('Add New', 'wp-latest-posts'),
            'add_new_item' => __('Add New WPLP Block', 'wp-latest-posts'),
            'edit_item' => __('Edit WPLP Block', 'wp-latest-posts'),
            'new_item' => __('New WPLP Block', 'wp-latest-posts'),
            'all_items' => __('All News Blocks', 'wp-latest-posts'),
            'view_item' => __('View WPLP Block', 'wp-latest-posts'),
            'search_items' => __('Search WPLP Blocks', 'wp-latest-posts'),
            'not_found' => __('No WPLP Block found', 'wp-latest-posts'),
            'not_found_in_trash' => __('No WPLP Block found in Trash', 'wp-latest-posts'),
            'parent_item_colon' => '',
            'menu_name' => __('Latest Posts', 'wp-latest-posts')
        );
        register_post_type(self::CUSTOM_POST_NEWS_WIDGET_NAME, array(
            'public' => false,
            'show_ui' => true,
            'menu_position' => 5,
            'labels' => $labels,
            'supports' => array(
                'title', 'author'
            ),
            'menu_icon' => 'dashicons-admin-page',
        ));
    }

    /** change message Latest Posts updated */
    public function wpcufpn_custom_update_messages($messages) {

        $messages['wpcuwpfp-news-widget'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => __('Latest Posts updated.', 'wp-latest-posts'),
        );

        return $messages;
    }

    /**
     * Append our theme stylesheet if necessary
     * 
     */
    function addStylesheet() {
        /*
          TODO: is there a way to load our theme stylesheet only where necessary?
          global $wpcufpn_needs_stylesheet;
          if( !$wpcufpn_needs_stylesheet )
          return;
         */

        $myStyleUrl = plugins_url(self::MAIN_FRONT_STYLESHEET, dirname(__FILE__));
        $myStylePath = plugin_dir_path(dirname(__FILE__)) . self::MAIN_FRONT_STYLESHEET;

        if (file_exists($myStylePath)) {
            wp_register_style('myStyleSheets', $myStyleUrl);
            wp_enqueue_style('myStyleSheets');
        }
    }

    /**
     * Append our fonts if necessary
     *
     */
    function addFonts() {
        /*
          TODO: is there a way to load our fonts only where necessary?
          global $wpcufpn_needs_fonts;
          if( !$wpcufpn_needs_fonts )
          return;
         */

        $myFontsUrl = 'https://fonts.googleapis.com/css?' .
                'family=Raleway:400,500,600,700,800,900|' .
                'Alegreya:400,400italic,700,700italic,900,900italic|' .
                'Varela+Round' .
                '&subset=latin,latin-ext';

        wp_register_style('myFonts', $myFontsUrl);
        wp_enqueue_style('myFonts');
    }

    /**
     * Append our front-end script if necessary
     * 
     */
    function addFrontScript() {
        //TODO: load only if necessary (is this possible ?)

        wp_enqueue_script(
                'wpcufpn-front', plugins_url(self::MAIN_FRONT_SCRIPT, dirname(__FILE__)), array('jquery'), '0.1', true
        );
    }

    /**
     * Save our custom setting fields in the WP database
     * 
     * @param inc $post_id
     * @return inc $post_id (unchanged)
     */
    public function saveCustomPostdata($post_id) {
        global $post;

        if (self::CUSTOM_POST_NEWS_WIDGET_NAME != get_post_type($post_id))
            return $post_id;

        if (!isset($_POST[self::CUSTOM_POST_NONCE_NAME . '_nonce']))
            return $post_id;

        $nonce = $_POST[self::CUSTOM_POST_NONCE_NAME . '_nonce'];
        if (!wp_verify_nonce($nonce, self::CUSTOM_POST_NONCE_NAME))
            return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        if (!current_user_can('edit_post', $post_id))
            return $post_id;

        if(is_multisite()){
            switch_to_blog(get_current_blog_id());
                $my_settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
            restore_current_blog();
        }else{
            $my_settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
        }
        $my_settings = wp_parse_args($my_settings, $this->_field_defaults);

        /** File uploads * */
        //error_log( 'FILES: ' . serialize( $_FILES ) );	//Debug
        foreach ($_FILES as $field_name => $field_value) {
            if (preg_match('/^wpcufpn_/', $field_name)) {
                //error_log( 'matched wpcufpn_' );			//Debug
                $new_field_name = preg_replace('/^wpcufpn_/', '', $field_name);
                if (is_uploaded_file($_FILES[$field_name]['tmp_name'])) {
                    $uploads = wp_upload_dir();
                    $upload_dir = ( $uploads['path'] ) . '/';
                    $upload_url = ( $uploads['url'] ) . '/';
                    if (preg_match('/(\.[^\.]+)$/', $_FILES[$field_name]['name'], $matches))
                        $ext = $matches[1];
                    $upload_file = self::DEFAULT_IMG_PREFIX . date("YmdHis") . $ext;
                    if (rename($_FILES[$field_name]['tmp_name'], $upload_dir . $upload_file)
                    ) {
                        chmod($upload_dir . $upload_file, 0664);
                        // $this->update_msg .= __( 'Temporary file ' ) . $_FILES["game_image"]["tmp_name"] .
                        //	" was moved to " . $upload_dir . $upload_file;
                        //var_dump( $_FILES["game_image"] );
                        $my_settings[$new_field_name] = $upload_url . $upload_file;
                        //error_log( 'renamed ' . $upload_url . $upload_file );	//Debug
                    } else {
                        $this->update_msg .= __('Processing of temporary uploader file has failed' .
                                        ' please check for file directory ') . $upload_dir;
                        //error_log( $this->update_msg );	//Debug
                    }
                } else {
                    //error_log( '!is_uploaded_file(' . $_FILES[$field_name]['tmp_name'] . ')' );	//Debug

                    /** keep the previous image * */
                    if (isset($_POST[$field_name . '_previous'])) {
                        $my_settings[$new_field_name] = $_POST[$field_name . '_previous'];
                    }
                }
            }
        }
        //var_dump($_POST);
        /** Normal fields * */
        foreach ($_POST as $field_name => $field_value) {
            if (preg_match('/^wpcufpn_/', $field_name)) {
                if (preg_match('/_none$/', $field_name))
                    continue;
                $field_name = preg_replace('/^wpcufpn_/', '', $field_name);
                if (is_array($field_value)) {
                    $my_settings[$field_name] = $field_value;
                } else {
                    if (preg_match('/^box_/', $field_name)) {
                        /** No sanitizing for those fields that are supposed to contain html * */
                        $my_settings[$field_name] = $field_value;
                    } else {
                        $my_settings[$field_name] = sanitize_text_field($field_value);
                    }

                    /** Enforce specific field value properties * */
                    if (isset($this->_enforce_fields[$field_name])) {
                        if (self::POSITIVE_INT_GT1 == $this->_enforce_fields[$field_name]) {
                            $my_settings[$field_name] = intval($my_settings[$field_name]);
                            if ($my_settings[$field_name] < 1)
                                $my_settings[$field_name] = 1;
                        }
                        if (self::BOOL == $this->_enforce_fields[$field_name]) {
                            $my_settings[$field_name] = intval($my_settings[$field_name]);
                            if ($my_settings[$field_name] < 1)
                                $my_settings[$field_name] = 0;
                            if ($my_settings[$field_name] >= 1)
                                $my_settings[$field_name] = 1;
                        }
                        if (self::FILE_UPLOAD == $this->_enforce_fields[$field_name]) {
                            //Do nothing I guess.
                        }
                        if (self::LI_TO_ARRAY == $this->_enforce_fields[$field_name]) {
                            if ($field_value) {
                                $values = preg_split('/<\/li><li[^>]*>/i', $field_value);
                            } else {
                                $values = array();
                            }
                            if ($values)
                                array_walk($values, function(&$value, $key) {
                                    $value = strip_tags($value);
                                });
                            $my_settings[$field_name] = $values;
                        }
                    }
                }
            }
        }
        update_post_meta($post_id, '_wpcufpn_settings', $my_settings);

        return $post_id;
    }

    /**
     * Loads js/ajax scripts
     * 
     */
    public function loadAdminScripts($hook) {

        /** Only load on post edit admin page * */
        if ('post.php' != $hook && 'post-new.php' != $hook)
            return $hook;

        if (wpcuWPFnPlugin::CUSTOM_POST_NEWS_WIDGET_NAME != get_post_type())
            return $hook;
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-mouse');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('jquery-ui-button');
        wp_enqueue_script('jquery-ui-slider');

        wp_enqueue_script(
                'wpcufpn-easing', plugins_url('js/materialize/jquery.easing.1.3.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-velocity', plugins_url('js/materialize/velocity.min.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-tabs', plugins_url('js/materialize/tabs.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-dropdown', plugins_url('js/materialize/dropdown.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-form', plugins_url('js/materialize/forms.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-dropify', plugins_url('js/dropify/js/dropify.min.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-picker', plugins_url('js/materialize/picker.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-picker-date', plugins_url('js/materialize/picker.date.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script(
                'wpcufpn-back', plugins_url('js/wpcufpn_back.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        wp_enqueue_script('wp-color-picker');

        wp_enqueue_script('wpcufpn-newColorPicker', plugins_url('js/wpcufpn_newColorPicker.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );

        /** add codemirror js */
        wp_enqueue_script('wpcufpn-codemirror', plugins_url('codemirror/lib/codemirror.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );
        /** mode css */
        wp_enqueue_script('wpcufpn-codemirrorMode', plugins_url('codemirror/mode/css/css.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );

        wp_enqueue_script('wpcufpn-codemirrorAdmin', plugins_url('js/wpcufpn_codemirrorAdmin.js', dirname(__FILE__)), array('jquery'), '0.1', true
        );

    }

    /**
     * Load additional admin stylesheets
     * of jquery-ui
     *
     */
    function addAdminStylesheets() {


        /** add color picker css */
        wp_enqueue_style('wp-color-picker');

        wp_register_style('uiStyleSheet', plugins_url('css/jquery-ui-custom.css', dirname(__FILE__)));
        wp_enqueue_style('uiStyleSheet');

        wp_register_style('wpcufpn_dropify', plugins_url('js/dropify/css/dropify.min.css', dirname(__FILE__)));
        wp_enqueue_style('wpcufpn_dropify');

        wp_register_style('wpcufpnAdmin', plugins_url('css/wpcufpn_admin.css', dirname(__FILE__)));
        wp_enqueue_style('wpcufpnAdmin');

        wp_register_style('unifStyleSheet', plugins_url('css/uniform/css/uniform.default.css', dirname(__FILE__)));
        wp_enqueue_style('unifStyleSheet');

        /** add codemirror css */
        wp_register_style('wpcufpn_codemirror', plugins_url('codemirror/lib/codemirror.css', dirname(__FILE__)));
        wp_enqueue_style('wpcufpn_codemirror');

        wp_register_style('wpcufpn_codemirrorTheme', plugins_url('codemirror/theme/3024-day.css', dirname(__FILE__)));
        wp_enqueue_style('wpcufpn_codemirrorTheme');
    }
    /*
     * Dequeue some js
     */

    public function dequeueAdminScripts(){
        wp_dequeue_script('sdf_bs_js_admin');
        //fix conflict with bootstrap theme
        wp_dequeue_script('bootstrap');
        wp_dequeue_script('cp_scripts_admin');

    }
    /**
     * Customizes the default custom post type editor screen:
     * - removes default meta-boxes
     * - adds our own settings meta-boxes
     * 
     */
    public function setupCustomMetaBoxes() {
        remove_meta_box('slugdiv', self::CUSTOM_POST_NEWS_WIDGET_NAME, 'core');
        remove_meta_box('authordiv', self::CUSTOM_POST_NEWS_WIDGET_NAME, 'core');

        add_meta_box(
                'wpcufpnnavtabsbox', __('WP Latest Posts Block Settings', 'wp-latest-posts'), array($this, 'editorTabs'), self::CUSTOM_POST_NEWS_WIDGET_NAME, 'normal', 'core'
        );
    }

    /**
     * Adds our admin menu item(s)
     * 
     */
    public function setupCustomMenu() {
        add_submenu_page(
                'edit.php?post_type=wpcuwpfp-news-widget', 'About...', 'About...', 'activate_plugins', 'about-wpfpn', array($this, 'displayAboutTab')
        );
    }

    /**
     * Create navigation tabs in the main configuration screen
     * 
     */
    public function editorTabs() {
        wp_nonce_field(self::CUSTOM_POST_NONCE_NAME, self::CUSTOM_POST_NONCE_NAME . '_nonce');

        //TODO: externalize js, cleanup obsolete/commented code
        ?>

        <div style="background:#fff; border: none;" class="ui-tabs ui-widget ui-widget-content ui-corner-all">

            <script type="text/javascript">
                (function ($) {
                    $(document).ready(function () {
                        $("#wpcufpn_spinner").hide();
                        $("#wpcufpnnavtabs").show();

                        //$('.wpcufpntabs').tabs();

                        $('#tab-1 ul.hidden').hide();

                        $('.source_type_sel').click(function (e) {
                            $(".wpcufpn_source_type_section").hide();
                            $('#div-' + $(this).val()).show();
                        });

                        $('#div-' + $('input[name=wpcufpn_source_type]:checked').val()).show();

                        /** You can check the all box or any other boxes, but not both **/
                        $('#cat_all').click(function (e) {
                            if ($(this).is(':checked')) {
                                $('.cat_cb').attr('checked', false);
                            }
                        });
                        $('.cat_cb').click(function (e) {
                            if ($(this).is(':checked')) {
                                $('#cat_all').attr('checked', false);
                            }
                        });



                        $('.slider').slider({
                            min: 0,
                            max: 50,
                            slide: function (event, ui) {
                                field = event.target.id.substr(7);
                                $("#" + field).val(ui.value);
                            }
                        });
                        $('.slider').each(function () {
                            var field = this.id.substr(7);
                            $(this).slider({
                                min: 0,
                                max: 50,
                                value: $("#" + field).val(),
                                slide: function (event, ui) {
                                    $("#" + field).val(ui.value);
                                }
                            });
                        });
                        $('#margin_sliders input').change(function () {
                            $('#slider_' + this.id).slider('value', $(this).val());
                        });

                        $('form').attr('enctype', 'multipart/form-data');

                    });
                })(jQuery);
                function console_log(msg) {
                    if (window.console) {
                        window.console.log(msg);
                    }
                }
            </script>
            <span  class="spinner" id="wpcufpn_spinner" style="visibility:visible;float:left;margin-top: -8px;"></span>
            <div id="wpcufpnnavtabs" class="wpcufpntabs" style="display: none">
                <ul class="tabs z-depth-1">
                    <li class="tab"><a href="#tab-1"><?php _e('Content source', 'wp-latest-posts'); ?></a></li>
                    <li class="tab"><a href="#tab-2"><?php _e('Display and theme', 'wp-latest-posts'); ?></a></li>
                    <li class="tab"><a href="#tab-3"><?php _e('Images source', 'wp-latest-posts'); ?></a></li>
                    <li class="tab"><a href="#tab-4"><?php _e('Advanced', 'wp-latest-posts'); ?></a></li>
                </ul>

                <div id="tab-1" class="metabox_tabbed_content wpcufpntabs">
        <?php $this->displayContentSourceTab(); ?>
                </div>

                <div id="tab-2" class="metabox_tabbed_content">
        <?php $this->displayDisplayThemeTab(); ?>
                </div>

                <div id="tab-3" class="metabox_tabbed_content">
        <?php $this->displayImageSourceTab(); ?>
                </div>

                <div id="tab-4" class="metabox_tabbed_content">
        <?php $this->displayAdvancedTab(); ?>
                </div>

            </div>

        </div>
        <?php
    }

    /**
     * Wp Latest Posts Widget Content source Settings tab
     * 
     */
    private function displayContentSourceTab() {
        global $post;
        $checked = array();
        $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
        if (empty($settings))
            $settings = $this->_field_defaults;

        if (!isset($settings['source_type']) || !$settings['source_type'])
            $settings['source_type'] = 'src_category';

        $source_type_checked[$settings['source_type']] = ' checked="checked"';


        $tabs = array(
            'tab-1-1' => array(
                'id' => 'tab-src_category',
                'name' => __('Post categories', 'wp-latest-posts'),
                'value' => 'src_category',
                'method' => array($this, 'displayContentSourceCategoryTab')
            ),
            'tab-1-2' => array(
                'id' => 'tab-src_page',
                'name' => __('Pages', 'wp-latest-posts'),
                'value' => 'src_page',
                'method' => array($this, 'displayContentSourcePageTab')
            )
        );
        $tabs = apply_filters('wpcufpn_src_type', $tabs);
        ?>

        <!--		<ul class="hidden">
        <?php foreach ($tabs as $tabhref => $tab) : ?>
                                    <li><a href="#<?php echo $tabhref; ?>" id="<?php echo $tab['id']; ?>"><?php echo $tab['name']; ?></a></li>
        <?php endforeach; ?>
                        </ul>-->

        <ul class="horizontal">
        <?php $idx = 0; ?>
        <?php foreach ($tabs as $tabhref => $tab) : ?>
                <li><input type="radio" name="wpcufpn_source_type" id="sct<?php echo ++$idx; ?>" value="<?php echo $tab['value']; ?>" class="source_type_sel with-gap" <?php echo (isset($source_type_checked[$tab['value']]) ? $source_type_checked[$tab['value']] : ""); ?> />
                    <label for="sct<?php echo $idx; ?>" class="post_radio"><?php echo $tab['name']; ?></label></li>
        <?php endforeach; ?>
        </ul>

        <?php foreach ($tabs as $tabhref => $tab) : ?>
            <div id="div-<?php echo $tab['value']; ?>" class="wpcufpn_source_type_section">
            <?php call_user_func($tab['method']); ?>
            </div>
        <?php endforeach; ?>

                    <?php
                }

                /**
                 * Wp Latest Posts Widget Display and theme Settings tab
                 *
                 */
                private function displayDisplayThemeTab() {
                    global $post;
                    $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
                    if (empty($settings))
                        $settings = $this->_field_defaults;

                    if (isset($settings['show_title']))
                        $show_title_checked[$settings['show_title']] = ' checked="checked"';
                    if (isset($settings['pagination']))
                        $pagination_selected[$settings['pagination']] = ' selected="selected"';
                    if (isset($settings['total_width_unit']))
                        $units_selected[$settings['total_width_unit']] = ' selected="selected"';


                    /*
                     * 
                     * Specific parameters with Mansonry
                     * 
                     */
                    $classdisabled = "";
                    if (strpos($settings["theme"], 'masonry') || strpos($settings["theme"], 'portfolio')) {
                        $classdisabled = " disabled";
                    }

                    $classdisabledsmooth = "";
                    if (strpos($settings["theme"], 'timeline')) {
                        $classdisabledsmooth = " disabled";
                    }

                    echo '<div class="wpcu-inner-admin-col">';

                    // -block---------------------------------- //
                    echo '<div class="wpcu-inner-admin-block">';
                    echo '<ul class="fields">';

                    /** Show title radio button set * */
                    echo '<li class="field"><label class="coltab">' . __('Show title', 'wp-latest-posts') . '</label>' .
                    '<span class="radioset">' .
                    '<input id="show_title1" type="radio" name="wpcufpn_show_title" value="0" ' . (isset($show_title_checked[0]) ? $show_title_checked[0] : '') . '/>' .
                    '<label for="show_title1">' . __('Off', 'wp-latest-posts') . '</label>' .
                    '<input id="show_title2" type="radio" name="wpcufpn_show_title" value="1" ' . (isset($show_title_checked[1]) ? $show_title_checked[1] : '') . '/>' .
                    '<label for="show_title2">' . __('On', 'wp-latest-posts') . '</label>' .
                    '</span>';
                    echo '</li>';

                    /*
                     * display number of columns
                     */
                    echo '<li class="field ' . $classdisabledsmooth . '"><label for="   amount_cols" class="coltab">' . __('Number of columns', 'wp-latest-posts') . '</label>' .
                    '<input id="amount_cols" type="text" name="wpcufpn_amount_cols" value="' . htmlspecialchars(isset($settings['amount_cols']) ? $settings['amount_cols'] : '3' ) . '" class="short-text" ' . $classdisabledsmooth . '/></li>';
                    /*
                     * display number of rows
                     */
                    echo '<li class="field ' . $classdisabled . $classdisabledsmooth . '"><label for="amount_rows" class="coltab">' . __('Number of rows', 'wp-latest-posts') . '</label>' .
                    '<input id="amount_rows" type="text" name="wpcufpn_amount_rows" value="' . htmlspecialchars(isset($settings['amount_rows']) ? $settings['amount_rows'] : '' ) . '" class="short-text" ' . $classdisabled . $classdisabledsmooth . '/></li>';

                    /** Pagination drop-down * */
                    echo '<li class="field ' . $classdisabled . $classdisabledsmooth . '"><label for="pagination" class="coltab">' . __('Pagination', 'wp-latest-posts') . '</label>' .
                    '<select id="pagination" name="wpcufpn_pagination" class="browser-default ' . $classdisabled . $classdisabledsmooth . '" >';
                    foreach ($this->_pagination_values as $value => $text) {
                        echo '<option value="' . $value . '" ' . (isset($pagination_selected[$value]) ? $pagination_selected[$value] : '') . '>';
                        echo htmlspecialchars(__($text, 'wp-latest-posts'));
                        echo '</option>';
                    }
                    echo '</select></li>';
                    /*
                     * display max elements
                     */
                    echo '<li class="field"><label for="max_elts" class="coltab">' . __('Max number of elements', 'wp-latest-posts') . '</label>' .
                    '<input id="max_elts" type="text" name="wpcufpn_max_elts" value="' . htmlspecialchars(isset($settings['max_elts']) ? $settings['max_elts'] : '' ) . '" class="short-text" /></li>';
                    /*
                     * display total width
                     */
                    echo '<li class="field"><label for="total_width" class="coltab">' . __('Total width', 'wp-latest-posts') . '</label>' .
                    '<input id="total_width" type="text" name="wpcufpn_total_width" value="' . htmlspecialchars(isset($settings['total_width']) ? $settings['total_width'] : '' ) . '" class="short-text" />';

                    /** Width units drop-down * */
                    echo '<select id="total_width_unit" class="browser-default" name="wpcufpn_total_width_unit">';
                    foreach ($this->_width_unit_values as $value => $text) {
                        echo '<option value="' . (isset($value) ? $value : '') . '" ' . (isset($units_selected[$value]) ? $units_selected[$value] : '') . '>' .
                        $text . '</option>';
                    }
                    echo '</select></li>';
                    /** offset number posts to skip */
                    echo '<li class="field"><label for="off_set" class="coltab">' . __('Number of posts to skip:', 'wp-latest-posts') . '</label>' .
                    '<input id="off_set" type="text" name="wpcufpn_off_set" value="' . htmlspecialchars(isset($settings['off_set']) ? $settings['off_set'] : '' ) . '" class="short-text" />';
                    $theme_name = basename($settings['theme']);

                    do_action('wpcufpn_display_button_loadmore', $settings);

                    do_action('wpcufpn_display_force_hover_icon', $settings);
                    echo '<div class="on_icon_selector">';
                    do_action('wpcufpn_display_icon_selector', $settings);
                    echo '</div>';
                    do_action('wpcufpn_displayandtheme_add_fields', $settings);
                    echo '</ul>'; //fields
                    echo '</div>'; //wpcu-inner-admin-block
                    // ---------------------------------------- //

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '<div class="card wpcufpn_notice light-blue notice notice-success is-dismissible below-h2">' .
                        '<div class="card-content white-text">' .
                        __(
                                'Additional advanced customization features<br/> and various beautiful ' .
                                'pre-configured templates and themes<br/> are available with the optional ' .
                                '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" >pro add-on</a>.'
                        ) .
                        '</div></div>';
                    } else {
                        do_action('wpcufpn_displaytheme_col1_add_fields', $settings);
                    }

                    echo '</div>'; //wpcu-inner-admin-col
                    echo '<div class="wpcu-inner-admin-col">';

                    if (isset($settings['theme']))
                        $theme_selected[$settings['theme']] = ' selected="selected"';

                    // -block---------------------------------- //
                    echo '<div class="wpcu-inner-admin-block with-title with-border">';
                    echo '<h4>Theme choice and preview</h4>';
                    echo '<ul class="fields">';

                    /** Theme drop-down * */
                    echo '<li class="field input-field input-select"><label for="theme" class="coltab">' . __('Theme', 'wp-latest-posts') . '</label>' .
                    '<select id="theme" name="wpcufpn_theme">';
                    $all_themes = (array) $this->themeLister();
                    wp_localize_script('wpcufpn-back', 'themes', $all_themes);
                    //var_dump( $all_themes );	//Debug
                    foreach ($all_themes as $dir => $theme) {

                        $disabled = "";
                        echo '<option  value="' . $dir . '" ' . (isset($theme_selected[$dir]) ? $theme_selected[$dir] : '') . '>';
                        echo $theme['name'];
                        echo '</option>';
                    }
                    echo '</select></li>';

                    echo '</ul>'; //fields
                    echo '<div class="wpcufpn-theme-preview">';

                    /** enforce default (first found theme) * */
                    if (!isset($settings['theme']) || 'default' == $settings['theme']) {
                        reset($all_themes);
                        $settings['theme'] = key($all_themes);
                    }

                    if (isset($all_themes[$settings['theme']]['theme_url'])) {
                        $screenshot_file_url = $all_themes[$settings['theme']]['theme_url'] . '/screenshot.png';
                        $screenshot_file_path = $all_themes[$settings['theme']]['theme_root'] . '/screenshot.png';
                    } else {
                        $screenshot_file = false;
                    }
                    //echo 'screenshot file: ' . $screenshot_file . '<br/>';	//Debug
                    if (isset($screenshot_file_path) && file_exists($screenshot_file_path)) {
                        echo '<img alt="preview" src="' . $screenshot_file_url .
                        '" style="width:100%;height:100%;" />';
                    }
                    echo '</div>';
                    echo '</div>'; //wpcu-inner-admin-block
                    // ---------------------------------------- //

                    $box_top = $box_left = $box_right = $box_bottom = '';


                    /*
                     * 
                     * Remove configuration
                     * 
                     */

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        $classdisabled = " disabled";
                    } else {
                        $classdisabled = "";
                    }
                    /**
                     * check WPLP Block
                     */
                    include_once(dirname(plugin_dir_path(__FILE__)) . '/themes/default/default.php');
                }

                /**
                 * Wp Latest Posts Widget Image source Settings tab
                 *
                 */
                private function displayImageSourceTab() {
                    global $post;
                    $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
                    if (empty($settings))
                        $settings = $this->_field_defaults;

                    if (isset($settings['thumb_img']))
                        $thumb_selected[$settings['thumb_img']] = ' selected="selected"';

                    echo '<ul class="fields">';

                    /** Thumbnail image src drop-down * */
                    echo '<li class="field input-field input-select width33"><label for="thumb_img" class="coltab">' . __('Select Image', 'wp-latest-posts') . '</label>' .
                    '<select id="thumb_img" name="wpcufpn_thumb_img">';
                    foreach ($this->_thumb_img_values as $value => $text) {
                        echo '<option value="' . $value . '" ' . (isset($thumb_selected[$value]) ? $thumb_selected[$value] : '') . '>';
                        echo htmlspecialchars(__($text, 'wp-latest-posts'));
                        echo '</option>';
                    }
                    echo '</select></li>';

                    /**
                     * selected
                     */
                    $imageThumbSizeSelected = '';
                    $imageMediumSizeSelected = '';
                    $imageLargeSizeSelected = '';

                    /**
                     * fix notice when update from old version
                     */
                    if (!isset($settings['image_size'])) {
                        $settings['image_size'] = "";
                    }

                    if ($settings['image_size'] == "thumbnailSize") {
                        $imageThumbSizeSelected = 'selected="selected"';
                    } elseif ($settings['image_size'] == "mediumSize") {

                        $imageMediumSizeSelected = 'selected="selected"';
                    } elseif ($settings['image_size'] == "largeSize") {

                        $imageLargeSizeSelected = 'selected="selected"';
                    }
                    /** image Size field * */
                    echo '<li class="field input-field input-select width33"><label for="thumb_width" class="coltab">' . __('Image size', 'wp-latest-posts') . '</label>' .
                    '<select id="wpcufpn_imageThumbSize" name="wpcufpn_image_size">
				<option  ' . $imageThumbSizeSelected . ' value="thumbnailSize" >' . __('Thumbnail', 'wp-latest-posts') . '</option>

				<option  ' . $imageMediumSizeSelected . ' value="mediumSize" >' . __('Medium', 'wp-latest-posts') . '</option>

                <option  ' . $imageLargeSizeSelected . ' value="largeSize" >' . __('Large', 'wp-latest-posts') . '</option>

			</select></li>';

                    do_action('wpcufpn_displayimagesource_crop_add_fields', $settings);

                    /** Sliders * */
                    // -block---------------------------------- //
                    echo '<div id="margin_sliders" class="wpcu-inner-admin-block with-title with-border">';
                    echo '<h4>Image margin</h4>';
                    echo '<ul class="fields">';
                    echo '<li class="field"><label for="margin_left" class="coltab">' . __('Margin left', 'wp-latest-posts') . '</label>' .
                    '<span id="slider_margin_left" class="slider"></span>' .
                    '<input id="margin_left" type="text" name="wpcufpn_margin_left" value="' . htmlspecialchars(isset($settings['margin_left']) ? $settings['margin_left'] : '' ) . '" class="short-text" /></li>';
                    echo '<li class="field"><label for="margin_top" class="coltab">' . __('Margin top', 'wp-latest-posts') . '</label>' .
                    '<span id="slider_margin_top" class="slider"></span>' .
                    '<input id="margin_top" type="text" name="wpcufpn_margin_top" value="' . htmlspecialchars(isset($settings['margin_top']) ? $settings['margin_top'] : '' ) . '" class="short-text" /></li>';
                    echo '<li class="field"><label for="margin_right" class="coltab">' . __('Margin right', 'wp-latest-posts') . '</label>' .
                    '<span id="slider_margin_right" class="slider"></span>' .
                    '<input id="margin_right" type="text" name="wpcufpn_margin_right" value="' . htmlspecialchars(isset($settings['margin_right']) ? $settings['margin_right'] : '' ) . '" class="short-text" /></li>';
                    echo '<li class="field"><label for="margin_bottom" class="coltab">' . __('Margin bottom', 'wp-latest-posts') . '</label>' .
                    '<span id="slider_margin_bottom" class="slider"></span>' .
                    '<input id="margin_bottom" type="text" name="wpcufpn_margin_bottom" value="' . htmlspecialchars(isset($settings['margin_bottom']) ? $settings['margin_bottom'] : '' ) . '" class="short-text" /></li>';
                    echo '</ul>'; //fields
                    echo '</div>'; //wpcu-inner-admin-block
                    // ---------------------------------------- //

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '<div class="card wpcufpn_notice light-blue notice notice-success is-dismissible below-h2">' .
                        '<div class="card-content white-text">' .
                        __(
                                'Additional advanced customization features are available with the optional ' .
                                '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" >pro add-on</a>.'
                        ) .
                        '</div></div>';
                    } else {
                        do_action('wpcufpn_imagesource_add_fields', $settings);
                    }
                }

                /**
                 * Wp Latest Posts Widget Advanced Settings tab
                 *
                 */
                private function displayAdvancedTab() {
                    global $post;
                    $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
                    if (empty($settings))
                        $settings = $this->_field_defaults;

                    echo '<ul class="fields">';

                    echo '<li class="field"><label for="date_fmt" class="coltab">' . __('Date format', 'wp-latest-posts') . '</label>' .
                    '<input id="date_fmt" type="text" name="wpcufpn_date_fmt" value="' . htmlspecialchars(isset($settings['date_fmt']) ? $settings['date_fmt'] : '' ) . '" class="short-text" />
			<a id="wpcufpn_dateFormat" target="_blank" href="http://php.net/manual/en/function.date.php"> ' . __('Date format', 'wp-latest-posts') . ' </a>
			</li>';

                    echo '<li class="field"><label for="text_content" class="coltab">' . __('Text Content', 'wp-latest-posts') . '</label>' .
                    '<select name="wpcufpn_text_content" class="browser-default" id="text_content">' .
                    '<option value="0" ' . ((isset($settings['text_content']) && $settings['text_content'] == "0") ? "selected" : '') . ' class="short-text">' . __('Full content', 'wp-latest-posts') . '</option>' .
                    '<option value="1" ' . ((isset($settings['text_content']) && $settings['text_content'] == "1") ? "selected" : '') . ' class="short-text">' . __('Excerpt content', 'wp-latest-posts') . '</option>' .
                    '</select> </li>';

                    echo '<li class="field"><label for="no_post_text" class="coltab">' . __('No post text', 'wp-latest-posts') . '</label>' .
                    '<input id="no_post_text" type="text" name="wpcufpn_no_post_text" value="' . htmlspecialchars(isset($settings['no_post_text']) ? $settings['no_post_text'] : '' ) . '" class="short-text" /></li>';


                    echo '</ul>'; //fields

                    echo '<hr/><div><label for="custom_css" class="coltab" style="vertical-align:top">' . __('Custom CSS', 'wp-latest-posts') . '</label>' .
                    '<textarea id="custom_css" cols="100" rows="5" name="wpcufpn_custom_css">' . ( isset($settings['custom_css']) ? $settings['custom_css'] : '' ) . '</textarea></div>';

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '<div class="card wpcufpn_notice light-blue notice notice-success is-dismissible below-h2">' .
                        '<div class="card-content white-text">';
                        echo '<p>' . __('Looking out for more advanced features?', 'wp-latest-posts') . '</p>';
                        echo '<p>' . __('Check out our optional <a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" style="text-decoration:none;s">"Pro" add-on</a>.', 'wp-latest-posts') . '</p>';
                        echo '</div></div>';
                    } else {
                        do_action('wpcufpn_displayadvanced_add_fields', $settings);
                    }

                    if (isset($post->ID) && isset($post->post_title) && (!empty($post->post_title))) {
                        echo '<hr style="clear:both"/><div><label for="phpCodeInsert" class="coltab" style="margin:10px 0 5px">' . __('Copy & paste this code into a template file to display this WPLP block', 'wp-latest-posts') . '</label>' .
                        '<br><textarea readonly id="phpCodeInsert" cols="100" rows="2" name="wpcufpn_phpCodeInsert">' . __('echo do_shortcode(\'[frontpage_news widget="' . $post->ID . '" name="' . $post->post_title . '"]\');', "wp-latest-posts") . '</textarea></div>';
                    }
                }

                /**
                 * Wp Latest Posts Widget About tab
                 *
                 */
                public function displayAboutTab() {

                    wp_enqueue_script('jquery');
                    wp_enqueue_script('jquery-ui');
                    wp_enqueue_script('javascript', plugins_url('/js/wpcufpn_about.js', dirname(__FILE__)), array('jquery'), '1.0.0', true);

                    wp_register_style('wpcufpnAdmin', plugins_url('css/wpcufpn_admin.css', dirname(__FILE__)));
                    wp_enqueue_style('wpcufpnAdmin');

                    echo '<div class="about_content">';

                    echo '<p> </p>';

                    /** Support information * */
                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '<div class="card wpcufpn_notice light-blue" style="margin-right:20px"><div class="card-content white-text" >';
                        echo '<span class="card-title">' . __('Get Pro version', 'wp-latest-posts') . '</span>';
                        echo '<p><em>' . __('Optional add-on is currently not installed or not enabled', 'wp-latest-posts') .
                        '&rarr; <a href="http://www.joomunited.com/wordpress-products/wp-latest-posts">' . __('get it here !', 'wp-latest-posts') . '</a></em></p>';
                        /** Marketing * */
                        echo '<iframe src="//player.vimeo.com/video/77775570" width="485" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="http://vimeo.com/77775570">';


                        echo '<table class="feature-listing">
				<tbody>
				<tr class="header-feature"><th class="feature col1"><strong></strong></th><th class="feature col2"><strong>FREE </strong></th><th class="feature col2"><strong>PRO </strong></th></tr>
				
				<tr class="ligne2">
				<td>
				<p>Private ticket support</p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/no.png', dirname(__FILE__)) . '" alt="no" width="16" height="16"></p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/yes.png', dirname(__FILE__)) . '" alt="yes" width="16" height="15"></p>
				</td>
				</tr>
				<tr class="ligne1">
				<td>
				<p>4 responsive premium themes</p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/no.png', dirname(__FILE__)) . '" alt="no" width="16" height="16"></p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/yes.png', dirname(__FILE__)) . '" alt="yes" width="16" height="15"></p>
				</td>
				</tr>
				<tr class="ligne2">
				<td>
				<p>Color chooser to fit your WordPress theme</p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/no.png', dirname(__FILE__)) . '" alt="no" width="16" height="16"></p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/yes.png', dirname(__FILE__)) . '" alt="yes" width="16" height="15"></p>
				</td>
				</tr>
				<tr class="ligne1">
				<td>
				<p>Load content from WordPress tags</p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/no.png', dirname(__FILE__)) . '" alt="no" width="16" height="16"></p>
				</td>
				<td class="feature-text">
				<p style="text-align: center;"><img style="margin: 0px;" src="' . plugins_url('img/yes.png', dirname(__FILE__)) . '" alt="yes" width="16" height="15"></p>
				</td>
				</tr>
				<tr>
				<td colspan="3"><br/>
				<i>And more...</i>
				<td>
				</tbody>
				</table><br/><br/>';


                        echo '<div class="flexslider"><ul class="slides">';
                        echo '<li><img src="' . plugins_url('img/gridtheme.png', dirname(__FILE__)) . '" alt="JoomUnited Logo" /></li>';
                        echo '<li><img src="' . plugins_url('img/categorygrid.png', dirname(__FILE__)) . '" alt="JoomUnited Logo" /></li>';
                        echo '<li><img src="' . plugins_url('img/smoothhover.png', dirname(__FILE__)) . '" alt="JoomUnited Logo" /></li>';
                        echo '<li><img src="' . plugins_url('img/timeline.png', dirname(__FILE__)) . '" alt="JoomUnited Logo" /></li>';
                        echo '</ul></div>';

                        echo '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" class="getthepro">'
                        . __('Get the Pro version now !', 'wp-latest-posts')
                        . '</a>';

                        echo '</div></div>';
                    } else {
                        do_action('wpcufpn_display_about', $this->version);
                    }

                    echo '<div class="card wpcufpn_notice light-blue"><div class="card-content white-text">';
                    echo '<p>' . __('Initially released in october 2013 by <a href="http://www.joomunited.com/">JoomUnited</a>') . '</p>';
                    echo '<p>WP Latest Posts WordPress plugin version ' . $this->version . '</p>';
                    echo '<p>' . __('Author: ') . ' JoomUnited</p>';
                    echo '<p>' . __('Your current version of WordPress is: ') . get_bloginfo('version') . '</p>';
                    echo '<p>' . __('Your current version of PHP is: ') . phpversion() . '</p>';
                    echo '<p>' . __('Your hosting provider\'s web server currently runs: ') . $_SERVER['SERVER_SOFTWARE'] . '</p>';
                    echo '<p><em>' . __('Please specify all of the above information when contacting us for support.') . '</em></p>';

                    echo '<p><a href="http://www.joomunited.com/wordpress-products/wp-latest-posts">WP Latest Posts official support site</a></p>';
                    echo '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts">';
                    echo '<img src="' . plugins_url('img/wpcu-logo-white.png', dirname(__FILE__)) . '" alt="JoomUnited Logo" /></a>';
                    echo '</div></div>';
                    echo '</div>';
                }

                /**
                 * Content source tab for post categories
                 * 
                 */
                private function displayContentSourceCategoryTab() {

                    global $post;
                    $source_cat_checked = array();
                    $checked = array();
                    $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
                    if (empty($settings))
                        $settings = $this->_field_defaults;

                    if (!isset($settings['source_category']) || empty($settings['source_category']) || !$settings['source_category'])
                        $settings['source_category'] = array('_all');

                    foreach ($settings['source_category'] as $cat) {
                        $source_cat_checked[$cat] = ' checked="checked"';
                    };

                    if (isset($settings['cat_post_source_order']))
                        $source_order_selected[$settings['cat_post_source_order']] = ' selected="selected"';
                    if (isset($settings['cat_post_source_asc']))
                        $source_asc_selected[$settings['cat_post_source_asc']] = ' selected="selected"';
                    if(is_multisite()){
                        if( !isset($settings['mutilsite_cat']) || empty($settings['mutilsite_cat']) || !$settings['mutilsite_cat'] )
                            $settings['mutilsite_cat'] = "";
                        $all_blog = get_sites();
                        echo '<ul>';
                        echo '<li class="field "> 
                        <div class="width33 input-field input-select">
			            <label for="mutilsite_select_post" class="post_cb">'.__( 'Multisite selection', 'wp-latest-posts-addon' ).' : </label>		
		                <select id="mutilsite_select_post" class="mutilsite_select" name="wpcufpn_mutilsite_cat">
				             <option value="all_blog">'.__( 'All blog', 'wp-latest-posts-addon' ).'</option>' . '';
                        foreach ($all_blog as $val) {
                            $detail = get_blog_details((int)$val->blog_id);
                            $check = ($settings['mutilsite_cat'] == $val->blog_id) ? ' selected="selected"' : '';
                            echo '<option value="' .$val->blog_id . '" '.$check.'> ' . $detail->blogname . ' </option>';
                        }
                        echo '</select></div></li>';
                        echo '</ul>';
                    }

                    echo '<ul class="fields">';

                    echo '<li class="field postcat">';
                    echo '<ul  class="post_field">';
                    echo '<li><input id="cat_all" type="checkbox" name="wpcufpn_source_category[]" value="_all" ' . (isset($source_cat_checked['_all']) ? $source_cat_checked['_all'] : '') . ' />' .
                    '<label for="cat_all" class="post_cb">All</li>';

                    if(is_multisite()){
                        if('all_blog' == $settings['mutilsite_cat']){
                            $blogs = get_sites();
                            foreach ($blogs as $blog){
                                switch_to_blog( (int)$blog->blog_id );
                                $allcats = get_categories();
                                foreach ($allcats as $allcat) {
                                    $cats[] = $allcat;
                                }
                                restore_current_blog();
                            }
                        }else{
                            switch_to_blog((int)$settings['mutilsite_cat']);
                            $cats = get_categories();
                            restore_current_blog();

                        }
                        foreach ($cats as $k => $cat) {
                            echo '<li><input id="ccb_' . $k . '" type="checkbox" name="wpcufpn_source_category[]" value="' .$k.'_'.
                                $cat->term_id . '" ' . (isset($source_cat_checked[$k.'_'.$cat->term_id]) ? $source_cat_checked[$k.'_'.$cat->term_id] : "") . ' class="post_cb" />';
                            echo '<label for="ccb_' . $k . '" class="post_cb">' . $cat->name . '</label></li>';
                        }
                    }else{
                        $cats = get_categories();
                        foreach ($cats as $k => $cat) {
                            echo '<li><input id="ccb_' . $k . '" type="checkbox" name="wpcufpn_source_category[]" value="' .
                                $cat->term_id . '" ' . (isset($source_cat_checked[$cat->term_id]) ? $source_cat_checked[$cat->term_id] : "") . ' class="post_cb" />';
                            echo '<label for="ccb_' . $k . '" class="post_cb">' . $cat->name . '</label></li>';
                        }
                    }

                    echo '</ul></li>';
                    if (class_exists('wpcuWPFnProPlugin') && is_plugin_active('advanced-custom-fields/acf.php')) {
                        $display = false;
                        $rule_customs = apply_filters('wpcufpn_get_rules_custom_fields', $settings);
                        foreach ($rule_customs as $rule_custom) {
                            foreach ($rule_custom as $rule) {
                                if ('post' == $rule['value'] && '==' == $rule['operator']) {
                                    $display = true;
                                }
                            }
                        }
                        //Advanced custom fields
                        if ($display) {
                            do_action('wpcufpn_display_advanced_custom_fields', $settings, 'post');
                        } else {
                            echo '<li><input type="hidden" name="wpcufpn_advanced_custom_fields" value=""/></li>';
                        }
                    }
                    echo '<li class="order_field field input-field input-select">';
                    echo '<label for="cat_post_source_order" class="coltab">' . __('Order by', 'wp-latest-posts') . '</label>';
                    echo '<select name="wpcufpn_cat_post_source_order" id="cat_post_source_order" >';
                    echo '<option value="date" ' . (isset($source_order_selected['date']) ? $source_order_selected['date'] : "") . '>' . __('By date', 'wp-latest-posts') . '</option>';
                    echo '<option value="title" ' . (isset($source_order_selected['title']) ? $source_order_selected['title'] : "") . '>' . __('By title', 'wp-latest-posts') . '</option>';
                    echo '<option value="random" ' . (isset($source_order_selected['random']) ? $source_order_selected['random'] : "") . '>' . __('By random', 'wp-latest-posts') . '</option>';
                    //echo '<option value="order" ' . $source_order_selected['order'] . '>' . __( 'By order', 'wp-latest-posts' ) . '</option>';
                    echo '</select>';
                    echo '</li>'; //field

                    echo '<li class="order_dir field input-field input-select">';
                    echo '<label for="cat_post_source_asc" class="coltab">' . __('Posts sort order', 'wp-latest-posts') . '</label>';
                    echo '<select name="wpcufpn_cat_post_source_asc" id="cat_post_source_asc">';
                    echo '<option value="asc" ' . (isset($source_asc_selected['asc']) ? $source_asc_selected['asc'] : "") . '>' . __('Ascending', 'wp-latest-posts') . '</option>';
                    echo '<option value="desc" ' . (isset($source_asc_selected['desc']) ? $source_asc_selected['desc'] : "") . '>' . __('Descending', 'wp-latest-posts') . '</option>';
                    echo '</select>';
                    echo '</li>'; //field

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '</ul><div class="card wpcufpn_notice light-blue notice notice-success is-dismissible below-h2" >' .
                        '<div class="card-content white-text">' .
                        __(
                                'Additional content source options are available with the optional ' .
                                '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" >pro addon</a>.'
                        ) .
                        '</div></div><ul>';
                    } else {
                        do_action('wpcufpn_source_category_add_fields', $settings);
                    }

                    echo '</ul>'; //fields
                }

                /**
                 * Content source tab for pages
                 *
                 */
                private function displayContentSourcePageTab() {
                    global $post;
                    $checked = array();
                    $settings = get_post_meta($post->ID, '_wpcufpn_settings', true);
                    if (empty($settings))
                        $settings = $this->_field_defaults;

                    if (isset($settings['pg_source_order']))
                        $source_order_selected[$settings['pg_source_order']] = ' selected="selected"';
                    if (isset($settings['pg_source_asc']))
                        $source_asc_selected[$settings['pg_source_asc']] = ' selected="selected"';

                    if(is_multisite()){
                        if( !isset($settings['mutilsite_page']) || empty($settings['mutilsite_page']) || !$settings['mutilsite_page'] )
                            $settings['mutilsite_page'] = "";
                        $all_blog = get_sites();
                        echo '<ul>';
                        echo '<li class="field "> 
                        <div class="width33 input-field input-select">
			            <label for="mutilsite_select_page" class="page_cb">'.__( 'Multisite selection', 'wp-latest-posts-addon' ).' : </label>		
		                <select id="mutilsite_select_page" class="mutilsite_select" name="wpcufpn_mutilsite_page">
				             <option value="all_blog">'.__( 'All blog', 'wp-latest-posts-addon' ).'</option>' . '';
                        foreach ($all_blog as $val) {
                            $detail = get_blog_details((int)$val->blog_id);
                            $check = ($settings['mutilsite_page'] == $val->blog_id) ? ' selected="selected"' : '';
                            echo '<option value="' .$val->blog_id . '" '.$check.'> ' . $detail->blogname . ' </option>';
                        }
                        echo '</select></div></li>';
                        echo '</ul>';
                    }

                    echo '<ul class="fields">';

                    echo '<li class="field pagecat">';
                    echo '<ul class="page_field">';

                    if (!class_exists('wpcuWPFnProPlugin')) {
                        echo '<li><input id="pages_all" type="checkbox" name="wpcufpn_source_pages[]" value="_all" checked="checked"  disabled="disabled" />' .
                        '<label for="pages_all" class="post_cb">All</li>';
                        echo '<li><div class="card wpcufpn_notice light-blue notice notice-success is-dismissible below-h2">' .
                        '<div class="card-content white-text">' .
                        __(
                                'Additional content source options are available with the optional ' .
                                '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts" target="_blank" >pro addon</a>.'
                        ) .
                        '</div></div></li>';
                    } else {
                        do_action('wpcufpn_source_page_add_fields', $settings);
                    }

                    echo '</ul>';
                    if (class_exists('wpcuWPFnProPlugin') && is_plugin_active('advanced-custom-fields/acf.php')) {
                        $display = false;
                        $rule_customs = apply_filters('wpcufpn_get_rules_custom_fields', $settings);
                        foreach ($rule_customs as $rule_custom) {
                            foreach ($rule_custom as $rule) {
                                if ('page' == $rule['value'] && '==' == $rule['operator']) {
                                    $display = true;
//                               
                                }
                            }
                        }
                        //Advanced custom fields
                        if ($display) {
                            do_action('wpcufpn_display_advanced_custom_fields', $settings, 'page');
                        } else {
                            echo '<li><input type="hidden" name="wpcufpn_advanced_custom_fields_page" value=""/></li>';
                        }
                    }
                    echo '</li>'; //field			                             

                    echo '<li class="field order_field input-field input-select">';
                    echo '<label for="pg_source_order" class="coltab">' . __('Order by', 'wp-latest-posts') . '</label>';
                    echo '<select name="wpcufpn_pg_source_order" id="pg_source_order" >';
                    echo '<option value="order" ' . (isset($source_order_selected['order']) ? $source_order_selected['order'] : "") . '>' . __('By order', 'wp-latest-posts') . '</option>';
                    echo '<option value="title" ' . (isset($source_order_selected['title']) ? $source_order_selected['title'] : "") . '>' . __('By title', 'wp-latest-posts') . '</option>';
                    echo '<option value="date" ' . (isset($source_order_selected['date']) ? $source_order_selected['date'] : "") . '>' . __('By date', 'wp-latest-posts') . '</option>';
                    echo '<option value="random" ' . (isset($source_order_selected['random']) ? $source_order_selected['random'] : "") . '>' . __('By random', 'wp-latest-posts') . '</option>';
                    echo '</select>';
                    echo '</li>'; //field

                    echo '<li class="order_dir field input-field input-select">';
                    echo '<label for="pg_source_asc" class="coltab">' . __('Pages sort order', 'wp-latest-posts') . '</label>';
                    echo '<select name="wpcufpn_pg_source_asc" id="pg_source_asc">';
                    echo '<option value="asc" ' . (isset($source_asc_selected['asc']) ? $source_asc_selected['asc'] : "") . '>' . __('Ascending', 'wp-latest-posts') . '</option>';
                    echo '<option value="desc" ' . (isset($source_asc_selected['desc']) ? $source_asc_selected['desc'] : "") . '>' . __('Descending', 'wp-latest-posts') . '</option>';
                    echo '</select>';
                    echo '</li>'; //field

                    echo '</ul>'; //fields
                }

                /**
                 * Builds the drop-down list of available themes
                 * for this plugin
                 * 
                 */
                function themeLister() {
                    $found_themes = array();
                    $theme_root = dirname(dirname(__FILE__)) . '/themes';
                    //echo 'theme dir: ' . $theme_root . '<br/>';	//Debug
                    $dirs = @ scandir($theme_root);
                    foreach ($dirs as $k => $v) {
                        if (!is_dir($theme_root . '/' . $v) || $v[0] == '.' || $v == 'CVS') {
                            unset($dirs[$k]);
                        } else {
                            $dirs[$k] = array(
                                'path' => $theme_root . '/' . $v,
                                'url' => plugins_url('themes/' . $v, dirname(__FILE__))
                            );
                        }
                    }

                    /** Load Pro add-on themes * */
                    $dirs = apply_filters('wpcufpn_themedirs', $dirs);

                    if (!$dirs)
                        return false;
                    //var_dump( $dirs );	//Debug
                    foreach ($dirs as $dir) {
                        //echo 'dir: ' . $dir . '<br/>';	//debug
                        if (file_exists($dir['path'] . '/style.css')) {
                            $headers = get_file_data($dir['path'] . '/style.css', self::$file_headers, 'theme');
                            //var_dump( $headers );	//Debug
                            $name = $headers['Name'];
                            if ('Default theme' == $name)
                                $name = ' ' . $name; // <- this makes it sort always first
                            $found_themes[basename($dir['path'])] = array(
                                'name' => $name,
                                'dir' => basename($dir['path']),
                                'theme_file' => $dir['path'] . '/style.css',
                                'theme_root' => $dir['path'],
                                'theme_url' => $dir['url']
                            );
                        }
                    }
                    asort($found_themes);
                    return $found_themes;
                }

                /**
                 * Customize Tiny MCE Editor 
                 * 
                 */
                public function setupTinyMce() {
                    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
                        add_filter('mce_buttons', array($this, 'filter_mce_button'));
                        add_filter('mce_external_plugins', array($this, 'filter_mce_plugin'));
                        add_filter('mce_css', array($this, 'plugin_mce_css'));
                    }
                }

                public function filter_mce_button($buttons) {
                    array_push($buttons, '|', 'wpcufpn_button');
                    return $buttons;
                }

                public function filter_mce_plugin($plugins) {
                    if (get_bloginfo('version') < 3.9) {
                        $plugins['wpcufpn'] = plugins_url('js/wpcufpn_tmce_plugin.js', dirname(__FILE__));
                    } else {
                        $plugins['wpcufpn'] = plugins_url('js/wpcufpn_tmce_plugin-3.9.js', dirname(__FILE__));
                    }
                    return $plugins;
                }

                public function plugin_mce_css($mce_css) {
                    if (!empty($mce_css))
                        $mce_css .= ',';

                    $mce_css .= plugins_url('css/wpcufpn_tmce_plugin.css', dirname(__FILE__));

                    return $mce_css;
                }

                /**
                 * Add insert button above tinyMCE 4.0 (WP 3.9+)
                 * 
                 */
                public function editorButton() {
                    $args = "";

                    $args = wp_parse_args($args, array(
                        'text' => __('Add Latest Posts', 'wp-latest-posts'),
                        'class' => 'button',
                        'echo' => true
                            ));

                    /** Print button * */
                    //$button = '<a href="javascript:void(0);" class="wpcufpn-button ' . $args['class'] . '" title="' . $args['text'] . '" data-target="' . $args['target'] . '" data-mfp-src="#su-generator" data-shortcode="' . (string) $args['shortcode'] . '">' . $args['icon'] . $args['text'] . '</a>';
                    $button = '<a href="#TB_inline?height=150&width=150&inlineId=wpcufpn-popup-wrap&modal=true" ' .
                            'class="wpcufpn-button thickbox ' . $args['class'] . '" ' .
                            'title="' . $args['text'] . '">' .
                            '<span style = "vertical-align: text-top" class="dashicons dashicons-admin-page"></span>' . $args['text'] .
                            '</a>'
                    ;

                    /** Prepare insertion popup * */
                    add_action('admin_footer', array($this, 'insertPopup'));

                    if ($args['echo'])
                        echo $button;
                    return $button;
                }

                /**
                 * Prepare block insertion popup for admin editor with tinyMCE 4.0 (WP 3.9+)
                 * 
                 */
                public function insertPopup() {
                    ?>

        <div id="wpcufpn-popup-wrap" class="media-modal wp-core-ui" style="display:none">
            <a class="media-modal-close" href="#" onClick="javascript:tb_remove();" title="Close"><span class="media-modal-icon"></span></a>
            <div id="wpcufpn-select-content" class="media-modal-content">

                <div class="wpcufpn-frame-title" style="margin-left: 30px;"><h1><?php echo __('WP Latest Posts', 'wp-latest-posts'); ?></h1></div>

                <div id="wpcufpn_widgetlist" style="margin:50px auto;">
        <?php if ($widgets = get_posts(array('post_type' => self::CUSTOM_POST_NEWS_WIDGET_NAME, 'posts_per_page' => -1))) : ?>
                        <select id="wpcufpn_widget_select">
                            <option><?php echo __('Select which block to insert:', 'wp-latest-posts'); ?></option>
            <?php foreach ($widgets as $widget) : ?>
                                <option value="<?php echo $widget->ID; ?>"><?php echo $widget->post_title; ?></option>
            <?php endforeach; ?>
                        </select>
        <?php else : ?>
                        <p><?php echo __('No Latest Posts Widget has been created.', 'wp-latest-posts'); ?></p>
                        <p><?php echo __('Please create one to use this button.', 'wp-latest-posts'); ?></p>
        <?php endif; ?>
                </div>

                <script>
                    (function ($) {
                        $('#wpcufpn_widgetlist').on('change', function (e) {
                            insertShortcode($('option:selected', this).val(), $('option:selected', this).text());
                            $('#wpcufpn_widgetlist').find('option:first').attr('selected', 'selected');
                            tb_remove();
                        });
                        function insertShortcode(widget_id, widget_title) {
                            var shortcode = '[frontpage_news';
                            if (null != widget_id)
                                shortcode += ' widget="' + widget_id + '"';
                            if (null != widget_title)
                                shortcode += ' name="' + widget_title + '"';
                            shortcode += ']';

                            /** Inserts the shortcode into the active editor and reloads display **/
        //				    	var ed = tinyMCE.activeEditor;
        //
        //                            ed.execCommand('mceInsertContent', 0, shortcode);
        //                            setTimeout(function() { ed.hide(); }, 1);
        //                            setTimeout(function() { ed.show(); }, 10);
        //
                            wpcufpn_send_to_editor(shortcode);
                        }

                        var wpActiveEditor, wpcufpn_send_to_editor;

                        wpcufpn_send_to_editor = function (html) {
                            var editor,
                                    hasTinymce = typeof tinymce !== 'undefined',
                                    hasQuicktags = typeof QTags !== 'undefined';

                            if (!wpActiveEditor) {
                                if (hasTinymce && tinymce.activeEditor) {
                                    editor = tinymce.activeEditor;
                                    wpActiveEditor = editor.id;
                                } else if (!hasQuicktags) {
                                    return false;
                                }
                            } else if (hasTinymce) {
                                editor = tinymce.get(wpActiveEditor);
                            }

                            if (editor && !editor.isHidden()) {
                                editor.execCommand('mceInsertContent', 0, html);
                                setTimeout(function () {
                                    editor.hide();
                                }, 1);
                                setTimeout(function () {
                                    editor.show();
                                }, 10);

                            } else if (hasQuicktags) {
                                QTags.insertContent(html);
                            } else {
                                document.getElementById(wpActiveEditor).value += html;
                            }

                            // If the old thickbox remove function exists, call it
                            if (window.tb_remove) {
                                try {
                                    window.tb_remove();
                                } catch (e) {
                                }
                            }
                        };
                    })(jQuery);
                </script>

                <style>
                    /** tinyMce button + widget selector **/
                    #wpcufpn_widgetlist {
                        min-width:150px;
                        max-width:250px;
                        overflow: hidden;
                        border: 3px solid #eee;
                        background: #fff;
                        z-index: 100;
                    }

                    #wpcufpn_widgetlist select {
                        min-height:70px;
                        min-width:250px;
                        padding: 5px;
                        margin-bottom: -5px;
                    }
                </style>
            </div>
        </div>
        <?php
    }

    /**
     * Adds a js script to the post and page editor screen footer
     * to configure our tinyMCE extension
     * with the list of available widgets
     * 
     */
    public function editorFooterScript() {
        //TODO: return false if not page/post edit screen

        echo '<script>';
        echo "var wpcufpn_widgets = new Array();\n";
        $widgets = get_posts(array('post_type' => self::CUSTOM_POST_NEWS_WIDGET_NAME, 'posts_per_page' => -1));
        foreach ($widgets as $widget) {
            echo "wpcufpn_widgets['$widget->ID']='" . esc_html($widget->post_title) . "';\n";
        }
        echo '</script>';
    }

    /**
     * Add Style and script in head and footer
     * 
     */
    public function prefixEnqueue($posts) {
        if (empty($posts) || is_admin())
            return $posts;
        $pattern = get_shortcode_regex();


        foreach ($posts as $post) {
            preg_match_all('/' . $pattern . '/s', $post->post_content, $matches);
            $widgetIDArray = array();
            $trig = false;
            foreach ($matches as $matchtest) {
                if (is_array($matchtest)) {
                    foreach ($matchtest as $matchtestsub) {
                        preg_match_all('/widget="(.*?)"/s', $matchtestsub, $widgetIDarray);
                        //print_r($widgetIDarray); die();
                        foreach ($widgetIDarray as $widgetID) {
                            if (!empty($widgetID)) {
                                if (is_array($widgetID)) {
                                    foreach ($widgetID as $widgetIDunique) {
                                        if (is_numeric($widgetIDunique) && !in_array($widgetIDunique, $widgetIDArray, true)) {
                                            $widgetIDArray[] = $widgetIDunique;
                                        }
                                    }
                                } else {
                                    if (is_numeric($widgetIDunique) && !in_array($widgetIDunique, $widgetIDArray, true)) {
                                        $widgetIDArray[] = $widgetIDunique;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    preg_match_all('/widget="(.*?)"/s', $matchtestsub, $widgetIDarray);
                    foreach ($widgetIDarray as $widgetID) {
                        if (!empty($widgetID)) {
                            if (is_array($widgetID)) {
                                foreach ($widgetID as $widgetIDunique) {
                                    if (is_numeric($widgetIDunique) && !in_array($widgetIDunique, $widgetIDArray, true)) {
                                        $widgetIDArray[] = $widgetIDunique;
                                    }
                                }
                            } else {
                                if (is_numeric($widgetIDunique) && !in_array($widgetIDunique, $widgetIDArray, true)) {
                                    $widgetIDArray[] = $widgetIDunique;
                                }
                            }
                        }
                    }
                }
            }

            /*
              foreach ($matches[2] as $matche => $matchkey) {
              if ($matchkey == 'frontpage_news') {
              $widgetIDArray[]=$matche;
              }
              }
             */
            foreach ($widgetIDArray as $widgetIDitem) {
                $widget = get_post($widgetIDitem);
                if (isset($widget) && !empty($widget)) {
                    $widget->settings = get_post_meta($widget->ID, '_wpcufpn_settings', true);
                    $front = new wpcuFPN_Front($widget);
                    add_action('wp_print_styles', array($front, "loadThemeStyle"));
                    add_action('wp_head', array($front, 'customCSS'));
                    add_action('wp_print_scripts', array($front, "loadThemeScript"));
                }
            }

            /*
              if (is_array($matche) && $matche[2] == 'frontpage_news') {
              echo "<pre>";
              print_r($matche);
              echo "</pre>";
              preg_match('/widget="(.*?)"/s', $matche[3], $widgetID);
              $widget = get_post( $widgetID[1] );
              $widget->settings = get_post_meta( $widget->ID, '_wpcufpn_settings', true );
              $front = new wpcuFPN_Front( $widget );
              //$front->loadThemeStyle();
              add_action( 'wp_print_styles',array($front,"loadThemeStyle"));
              add_action('wp_head',array( $front, 'customCSS' ));
              add_action( 'wp_print_scripts',array($front,"loadThemeScript"));
              } */
        }
        return $posts;
    }

    /**
     * Returns content of our shortcode
     * 
     */
    public function applyShortcode($args = array()) {

        $html = '';

        $widget_id = $args['widget'];
        $widget = get_post($widget_id);
        if (isset($widget) && !empty($widget)) {
            $widget->settings = get_post_meta($widget->ID, '_wpcufpn_settings', true);
            $front = new wpcuFPN_Front($widget);
            $front->loadThemeStyle();
            $front->loadThemeScript();
            $html .= $front->display(false);
        } else {
            $html .= "\n<!-- WPFN: this News Widget is not initialized -->\n";
        }

        return $html;
    }

    /**
     * Sets up the settings page in the WP back-office
     *
     */
    private function display_page() {

        include( 'back-office-display.inc.php' );
    }

    public function addProLink($links, $file) {
        $base = plugin_basename($this->plugin_file);
        if ($file == $base) {
            $links[] = '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts">'
                    . __('Get "pro" add-on') . '</a>';
            $links[] = '<a href="http://www.joomunited.com/wordpress-products/wp-latest-posts">'
                    . __('Support') . '</a>';
        }
        return $links;
    }

    // \/------------------------------------------ STANDARD ------------------------------------------\/

    /**
     * overloaded
     * Displays a standard plugin settings page in the Settings menu of the WordPress administration interface
     *
     * @see trunk/inc/YD_Plugin#plugin_options()
     */
    public function plugin_options() {

        /** reserved to contributors * */
        if (!current_user_can('edit_posts')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        if (class_exists('ydfgOP')) {
            $op = new ydfgOP($this);
        } else {
            $op = new YD_OptionPage($this);
        }
        if ($this->option_page_title) {
            $op->title = $this->option_page_title;
        } else {
            $op->title = __($this->plugin_name, $this->tdomain);
        }
        $op->sanitized_name = $this->sanitized_name;
        $op->yd_logo = '';
        $op->support_url = $this->support_url;
        $op->initial_funding = $this->initial_funding;    // array( name, url )
        $op->additional_funding = $this->additional_funding; // array of arrays
        $op->version = $this->version;
        $op->translations = $this->translations;
        $op->plugin_dir = $this->plugin_dir;
        $op->has_cache = $this->has_cache;
        $op->option_page_text = $this->option_page_text;
        $op->plg_tdomain = $this->tdomain;
        $op->donate_block = $this->op_donate_block;
        $op->credit_block = $this->op_credit_block;
        $op->support_block = $this->op_support_block;
        $this->option_field_labels['disable_backlink'] = 'Disable backlink in the blog footer:';
        $op->option_field_labels = $this->option_field_labels;
        $op->form_add_actions = $this->form_add_actions;
        $op->form_method = $this->form_method;
        if ($_GET['do'] || $_POST['do'])
            $op->do_action($this);
        $op->header();
        if (class_exists('ydfgOP')) {
            $op->styles();
        }
        $op->option_values = get_option($this->option_key);

        $this->display_page();

        if ($this->has_cron)
            $op->cron_status($this->crontab);
    }

}
?>