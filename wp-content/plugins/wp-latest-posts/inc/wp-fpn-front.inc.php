<?php

/** WP Frontpage News front display class * */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

class wpcuFPN_Front {

    const CSS_DEBUG = false;

    /**
     * config crop in here
     * crop const
     */
    const DEFAULT_TITLE_EM_SIZE = 1.24;
    const TIMELINE_TITLE_EM_SIZE = 1.35;
    const SMOOTH_TITLE_EM_SIZE = 1.35;
    const MASONRY_GID_TITLE_EM_SIZE = 1.35;
    const MASONRY_CATEGORY_TITLE_EM_SIZE = 1.35;
    const PORTFOLIO_TITLE_EM_SIZE = 1.15;
    const DEFAULT_TEXT_EM_SIZE = 1.4;
    const TIMELINE_TEXT_EM_SIZE = 1.6875;
    const SMOOTH_TEXT_EM_SIZE = 1.4;
    const MASONRY_GID_TEXT_EM_SIZE = 1.21;
    const MASONRY_CATEGORY_TEXT_EM_SIZE = 1.23;
    const PORTFOLIO_TEXT_EM_SIZE = 1.1;

    public $widget;
    private $html = '';
    private $posts = array();
    private $prepared = false;
    private $boxes = array();

    /**
     * Sets up widget options
     * 
     * @param object $widget
     */
    public function __construct($widget) {
        $this->widget = $widget;
        if(strpos( $this->widget->settings["theme"], 'portfolio') !== false) {
            $this->widget->settings["theme"] = 'portfolio';
        }elseif(strpos( $this->widget->settings["theme"], 'masonry-category') !== false) {
            $this->widget->settings["theme"] = 'masonry-category';
        }elseif(strpos( $this->widget->settings["theme"], 'masonry') !== false){
            $this->widget->settings["theme"] = 'masonry';
        }elseif(strpos($this->widget->settings["theme"], 'smooth') !== false){
            $this->widget->settings["theme"] = 'smooth-effect';
        }elseif(strpos($this->widget->settings["theme"], 'timeline') !== false){
            $this->widget->settings["theme"] = 'timeline';
        }else{
            $this->widget->settings["theme"] = 'default';
        }
        /*
         * If Premium Theme ! reset box
         */
        if ( $this->widget->settings["theme"] == 'portfolio' || $this->widget->settings["theme"] == 'masonry' || $this->widget->settings["theme"] == 'masonry-category' || $this->widget->settings["theme"] == 'smooth-effect' || $this->widget->settings["theme"] == 'timeline'
        ) {
            $this->resetsettingsPremium();
        } else {
            /**
             * check WPLP Block
             */
            $this->widget->settings["theme"] = 'default';
            if (empty($this->widget->settings['image_size'])) {
                $this->widget->settings['image_size'] = "thumbnailSize";
            }
            if (empty($this->widget->settings['source_category'])) {
                $this->widget->settings['source_category'][0] = '_all';
            }

            $this->setupDefaultlayout();
        }

        $this->posts = $this->queryPosts();
        // Hook WP

        $this->prepared = true;

        //TODO: boxes setup will depend on theme template + pro filter
        $this->boxes = array('top', 'left', 'right', 'bottom');
    }

    private function setupDefaultlayout() {
        if ((isset($this->widget->settings['dfThumbnail'])) &&
                (isset($this->widget->settings['dfTitle'])) &&
                (isset($this->widget->settings['dfAuthor'])) &&
                (isset($this->widget->settings['dfDate'])) &&
                (isset($this->widget->settings['dfCategory'])) &&
                (isset($this->widget->settings['dfText'])) &&
                (isset($this->widget->settings['dfReadMore']))) {

            if ($this->widget->settings['dfThumbnailPosition'] == "left") {

                $this->widget->settings["box_top"] = array();


                $this->widget->settings["box_left"] = array($this->widget->settings['dfThumbnail']);
                $this->widget->settings["box_right"] = array(
                    $this->widget->settings['dfTitle'],
                    $this->widget->settings['dfAuthor'],
                    $this->widget->settings['dfDate'],
                    $this->widget->settings['dfCategory'],
                    $this->widget->settings['dfText'],
                    "Custom_Fields",
                    $this->widget->settings['dfReadMore'],
                );

                $this->widget->settings["box_bottom"] = array();
            } elseif ($this->widget->settings['dfThumbnailPosition'] == "right") {

                $this->widget->settings["box_top"] = array();


                $this->widget->settings["box_left"] = array(
                    $this->widget->settings['dfTitle'],
                    $this->widget->settings['dfAuthor'],
                    $this->widget->settings['dfDate'],
                    $this->widget->settings['dfCategory'],
                    $this->widget->settings['dfText'],
                    "Custom_Fields",
                    $this->widget->settings['dfReadMore'],
                );
                $this->widget->settings["box_right"] = array($this->widget->settings['dfThumbnail']);

                $this->widget->settings["box_bottom"] = array();
            } else {
                $this->widget->settings["box_top"] = array($this->widget->settings['dfThumbnail'], $this->widget->settings['dfTitle']);

                $this->widget->settings["box_left"] = array();
                $this->widget->settings["box_right"] = array();

                $this->widget->settings["box_bottom"] = array(
                    $this->widget->settings['dfAuthor'],
                    $this->widget->settings['dfDate'],
                    $this->widget->settings['dfCategory'],
                    $this->widget->settings['dfText'],
                    "Custom_Fields",
                    $this->widget->settings['dfReadMore'],
                );
            }
        }
    }

    /**
     * Reset Box Settings
     * 
     */
    private function resetsettingsPremium() {

        if ( $this->widget->settings["theme"] == 'masonry-category' ) {
            $this->widget->settings["box_top"] = array("ImageFull", "Title");
        } elseif ( $this->widget->settings["theme"] == 'portfolio' ) {
            $this->widget->settings["box_top"] = array("Thumbnail", "Title");
        } elseif ( $this->widget->settings["theme"] =='smooth-effect' ) {
            $this->widget->settings["box_top"] = array("Category", "Date");
        } elseif ( $this->widget->settings["theme"] == 'timeline' ) {
            $this->widget->settings["box_top"] = array("ImageFull");
        } else {
            $this->widget->settings["box_top"] = array("ImageFull", "Title", "Date", "Text", "Custom_Fields");
        }
        $this->widget->settings["box_left"] = null;
        $this->widget->settings["box_right"] = null;
        if ( $this->widget->settings["theme"] == 'masonry-category' ) {
            $this->widget->settings["box_bottom"] = array("Category");
        } elseif ( $this->widget->settings["theme"] == 'portfolio' ) {
            $this->widget->settings["box_bottom"] = array("Category");
        } elseif ( $this->widget->settings["theme"] == 'smooth-effect' ) {
            $this->widget->settings["box_bottom"] = array("Title", "Text", "Custom_Fields", "Read more");
        } elseif ( $this->widget->settings["theme"] == 'timeline') {
            $this->widget->settings["box_bottom"] = array("ImageFull", "Title", "Category", "Text", "Custom_Fields", "Read more", "Date");
        } else {
            $this->widget->settings["box_bottom"] = array("Read more");
        }

        $this->widget->settings['margin_top'] = 0;
        $this->widget->settings['margin_right'] = 0;
        $this->widget->settings['margin_bottom'] = 0;
        $this->widget->settings['margin_left'] = 0;
    }

    /**
     * Selects posts to display in our widget
     * 
     */
    private function queryPosts() {

        wp_reset_postdata();

        /** for posts and page source_types * */
        if (
                'src_category' == $this->widget->settings['source_type'] ||
                'src_page' == $this->widget->settings['source_type'] ||
                'src_custom_post_type' == $this->widget->settings['source_type']
        ) {

            /** source_types (post_type) * */
            $post_type = 'post';
            if ('src_category' == $this->widget->settings['source_type'])
                $post_type = 'post';
            if ('src_page' == $this->widget->settings['source_type'])
                $post_type = 'page';
            if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                $post_type = $this->widget->settings["custom_post_type"];
            }


            /** source_order (order_by) * */
            $order_by = 'date';
            if ('src_category' == $this->widget->settings['source_type']) {
                if ('date' == $this->widget->settings['cat_post_source_order'])
                    $order_by = 'date';
                if ('title' == $this->widget->settings['cat_post_source_order'])
                    $order_by = 'title';
                if ('order' == $this->widget->settings['cat_post_source_order'])
                    $order_by = 'menu_order';
                if ('random' == $this->widget->settings['cat_post_source_order'])
                    $order_by = 'rand';
            }
            if ('src_page' == $this->widget->settings['source_type']) {
                if ('date' == $this->widget->settings['pg_source_order'])
                    $order_by = 'date';
                if ('title' == $this->widget->settings['pg_source_order'])
                    $order_by = 'title';
                if ('order' == $this->widget->settings['pg_source_order'])
                    $order_by = 'menu_order';
                if ('random' == $this->widget->settings['pg_source_order'])
                    $order_by = 'rand';
            }
            if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                if ('date' == $this->widget->settings['cat_source_order'])
                    $order_by = 'date';
                if ('title' == $this->widget->settings['cat_source_order'])
                    $order_by = 'title';
                if ('order' == $this->widget->settings['cat_source_order'])
                    $order_by = 'menu_order';
                if ('random' == $this->widget->settings['cat_source_order'])
                    $order_by = 'rand';
            }

            /** source_asc (order) * */
            $order = 'DESC';
            if ('src_category' == $this->widget->settings['source_type']) {
                if ('desc' == $this->widget->settings['cat_post_source_asc'])
                    $order = 'DESC';
                if ('asc' == $this->widget->settings['cat_post_source_asc'])
                    $order = 'ASC';
            }
            if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                if ('desc' == $this->widget->settings['cat_source_asc'])
                    $order = 'DESC';
                if ('asc' == $this->widget->settings['cat_source_asc'])
                    $order = 'ASC';
            }
            if ('src_page' == $this->widget->settings['source_type']) {
                if ('desc' == $this->widget->settings['pg_source_asc'])
                    $order = 'DESC';
                if ('asc' == $this->widget->settings['pg_source_asc'])
                    $order = 'ASC';
            }

            /** max_elts (limit / posts_per_page) * */
            $limit = 10;
            if ($this->widget->settings['max_elts'] > 0)
                $limit = $this->widget->settings['max_elts'];

            $offSet = null;
            if (isset($this->widget->settings['off_set']) && $this->widget->settings['off_set'] > 0) {
                $offSet = $this->widget->settings['off_set'];
            }

            $args = array(
                'post_type' => $post_type,
                'orderby' => $order_by,
                'order' => $order,
                'posts_per_page' => $limit,
                'offset' => $offSet
            );
            if(is_multisite()){

                if('src_category' == $this->widget->settings['source_type']){
                    if(isset($this->widget->settings['mutilsite_cat']) && 'all_blog' == $this->widget->settings['mutilsite_cat']){
                        $blogs = get_sites();
                        foreach ($blogs as $blog){
                            switch_to_blog( (int)$blog->blog_id );
                            if('src_category' == $this->widget->settings['source_type'] && '_all' == $this->widget->settings['source_category'][0]){
                                $cat_all = get_categories();
                                foreach ($cat_all as $cat) {
                                    $args['category__in'][] = (string) ($cat->term_id);
                                }
                            }elseif ('src_category' == $this->widget->settings['source_type']) {
                                $source = $this->widget->settings['source_category'];
                                foreach($source as $v){
                                    $sour = substr($v,strpos($v,'_')+1);
                                    $args['category__in'][] = $sour;
                                }
                            }
                            $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);
                            $allposts = get_posts($args);
                            foreach ($allposts as $post){
                                $post->curent_blog_id = (int)$blog->blog_id;
                                $posts[] = $post;
                            }
                            restore_current_blog();
                        }
                    }elseif(isset($this->widget->settings['mutilsite_cat'])){
                        switch_to_blog((int)$this->widget->settings['mutilsite_cat']);
                        if('src_category' == $this->widget->settings['source_type'] && '_all' == $this->widget->settings['source_category'][0]){
                            $cat_all = get_categories();
                            foreach ($cat_all as $cat) {
                                $args['category__in'][] = (string) ($cat->term_id);
                            }
                        }elseif ('src_category' == $this->widget->settings['source_type']) {
                            $source = $this->widget->settings['source_category'];
                            foreach($source as $v){
                                $sour = substr($v,strpos($v,'_')+1);
                                $args['category__in'][] = $sour;

                            }
                        }
                        $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);
                        $posts = get_posts($args);
                        foreach ($posts as $post){
                            $post->curent_blog_id = (int)$this->widget->settings['mutilsite_cat'];
                        }
                        restore_current_blog();
                    }
                }

                //source page
                if('src_page' == $this->widget->settings['source_type']){
                    if(isset($this->widget->settings['mutilsite_page']) && 'all_blog' == $this->widget->settings['mutilsite_page']){
                        if (!in_array("_all", $this->widget->settings['source_pages'])) {
                            $source = $this->widget->settings['source_pages'];
                            foreach($source as $v){
                                $sour = substr($v,strpos($v,'_')+1);
                                $args["post__in"][] = $sour;

                            }
                        }
                        $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);

                        $blogs = get_sites();
                        foreach ($blogs as $blog){
                            switch_to_blog( (int)$blog->blog_id );
                            $allposts = get_posts($args);
                            foreach ($allposts as $post){
                                $post->curent_blog_id = (int)$blog->blog_id;
                                $posts[] = $post;
                            }
                            restore_current_blog();
                        }
                    }elseif(isset($this->widget->settings['mutilsite_page']) ){
                        switch_to_blog((int)$this->widget->settings['mutilsite_page']);
                        if ('src_page' == $this->widget->settings['source_type'] && isset($this->widget->settings['source_pages'])) {
                            if (!in_array("_all", $this->widget->settings['source_pages'])) {
                                $source = $this->widget->settings['source_pages'];
                                foreach($source as $v){
                                    $sour = substr($v,strpos($v,'_')+1);
                                    $args["post__in"][] = $sour;

                                }
                            }
                        }
                        $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);
                        $posts = get_posts($args);
                        foreach ($posts as $post){
                            $post->curent_blog_id = (int)$this->widget->settings['mutilsite_page'];
                        }
                        restore_current_blog();
                    }
                }

                //source custom post

                if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                    if(!empty($this->widget->settings['custom_post_type'])){
                        $custom = $this->widget->settings['custom_post_type'];
                        $blog_id = substr($custom,0,strpos($custom,'_'));
                        $post_type = substr($custom,strpos($custom,'_')+1);
                        $args['post_type'] = $post_type;
                    }
                    if(!empty($blog_id)){
                        switch_to_blog((int)$blog_id);
                        if (isset($this->widget->settings['custom_post_taxonomy'])) {
                            if ($this->widget->settings['custom_post_taxonomy'] == "" || $this->widget->settings['custom_post_taxonomy'] == 'all_taxonomies') {
                                //get post by all
                            } else {
                                $args["tax_query"] = array(array(
                                    'taxonomy' => $this->widget->settings['custom_post_taxonomy'],
                                    'field' => 'term_id'
                                ));
                            }
                            // get posts by terms
                            if (isset($args['tax_query'][0]['taxonomy'])) {
                                if ($this->widget->settings['custom_post_term'] == "" || "all_terms" == $this->widget->settings['custom_post_term']) {
                                    $terms = get_terms($this->widget->settings['custom_post_taxonomy'], array('hide_empty' => false));
                                    $term_ids = wp_list_pluck($terms, 'term_id');
                                    $args["tax_query"][0]['terms'] = array_values($term_ids);
                                } else {
                                    $args["tax_query"][0]['terms'] = (int) $this->widget->settings['custom_post_term'];
                                }
                            }
                        }
                        $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);

                        $posts = get_posts($args);
                        foreach ( $posts as $post){
                            $post->curent_blog_id = (int)$blog_id;
                        }
                        restore_current_blog();
                    }
                }

            }else{
                //fix custom post type again
                if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                    if (isset($this->widget->settings['custom_post_taxonomy'])) {
                        if ($this->widget->settings['custom_post_taxonomy'] == "" || $this->widget->settings['custom_post_taxonomy'] == 'all_taxonomies') {
                            //get post by all
                        } else {
                            $args["tax_query"] = array(array(
                                'taxonomy' => $this->widget->settings['custom_post_taxonomy'],
                                'field' => 'term_id'
                            ));
                        }
                        // get posts by terms
                        if (isset($args['tax_query'][0]['taxonomy'])) {
                            if ($this->widget->settings['custom_post_term'] == "" || "all_terms" == $this->widget->settings['custom_post_term']) {
                                $terms = get_terms($this->widget->settings['custom_post_taxonomy'], array('hide_empty' => false));
                                $term_ids = wp_list_pluck($terms, 'term_id');
                                $args["tax_query"][0]['terms'] = array_values($term_ids);
                            } else {
                                $args["tax_query"][0]['terms'] = (int) $this->widget->settings['custom_post_term'];
                            }
                        }
                    }

                    //fix custom post type
                    if (!empty($this->widget->settings['custom_post_type'])) {
                        $args['post_type'] = $this->widget->settings['custom_post_type'];
                    }
                }

                /** include specifics pages * */
                if ('src_page' == $this->widget->settings['source_type'] && isset($this->widget->settings['source_pages'])) {
                    if (!in_array("_all", $this->widget->settings['source_pages'])) {
                        $args["post__in"] = $this->widget->settings['source_pages'];
                    }
                }


                /** filter by category * */
                if (
                    'src_category' == $this->widget->settings['source_type'] &&
                    isset($this->widget->settings['source_category']) &&
                    '_all' != $this->widget->settings['source_category'][0]
                ) {
                    $args['category__in'] = $this->widget->settings['source_category'];
                } else if ('src_category' == $this->widget->settings['source_type']) {
                    $cat_all = get_categories();
                    foreach ($cat_all as $cat) {
                        $args['category__in'][] = (string) ($cat->term_id);
                    }
                }

                $args = apply_filters('wpcufpn_src_category_args', $args, $settings = $this->widget->settings);

                $posts = get_posts($args);
            }

        } elseif (
                'src_tags' == $this->widget->settings['source_type']
        ) {


            $post_type = 'post';
            $order_by = 'date';

            $limit = 10;
            if ($this->widget->settings['max_elts'] > 0)
                $limit = $this->widget->settings['max_elts'];

            if(is_multisite()){
                if(isset($this->widget->settings['mutilsite_tag']) && !empty($this->widget->settings['mutilsite_tag'])){
                    if('all_blog' == $this->widget->settings['mutilsite_tag']){
                        $blogs = get_sites();
                        foreach ($blogs as $blog){
                            switch_to_blog( (int)$blog->blog_id );
                            if(isset($this->widget->settings['source_tags']) && !empty($this->widget->settings['source_tags'])){
                                foreach ($this->widget->settings['source_tags'] as $tag) {
                                    if ($tag == "_all") {
                                        $tags = get_tags();
                                        foreach ($tags as $tag)
                                            $source_tag[] = $tag->term_id;
                                    } else {
                                        $tag = substr($tag,strpos($tag,'_')+1);
                                        $source_tag[] = $tag;
                                    }
                                }
                            }
                            $args = array(
                                'post_type' => $post_type,
                                'orderby' => $order_by,
                                'order' => isset($order) ? $order : '',
                                'posts_per_page' => $limit,
                                'tax_query' => array(array(
                                    'taxonomy' => 'post_tag',
                                    'field' => 'term_id',
                                    'terms' => isset($source_tag) ? $source_tag : ''
                                ))
                            );
                            $allposts = get_posts($args);
                            foreach ($allposts as $post){
                                $post->curent_blog_id = (int)$blog->blog_id;
                                $posts[] = $post;
                            }
                            restore_current_blog();
                        }
                    }else{
                        switch_to_blog((int)$this->widget->settings['mutilsite_tag']);
                            if(isset($this->widget->settings['source_tags']) && !empty($this->widget->settings['source_tags'])){
                                foreach ($this->widget->settings['source_tags'] as $tag) {
                                    if ($tag == "_all") {
                                        $tags = get_tags();
                                        foreach ($tags as $tag)
                                            $source_tag[] = $tag->term_id;
                                    } else {
                                        $tag = substr($tag,strpos($tag,'_')+1);
                                        $source_tag[] = $tag;
                                    }
                                }
                            }
                        $args = array(
                            'post_type' => $post_type,
                            'orderby' => $order_by,
                            'order' => isset($order) ? $order : '',
                            'posts_per_page' => $limit,
                            'tax_query' => array(array(
                                'taxonomy' => 'post_tag',
                                'field' => 'term_id',
                                'terms' => isset($source_tag) ? $source_tag : ''
                            ))
                        );

                        $posts = get_posts($args);
                        foreach ( $posts as $post){
                            $post->curent_blog_id = (int)$this->widget->settings['mutilsite_tag'];
                        }
                        restore_current_blog();
                    }
                }

            }else{
                if (isset($this->widget->settings['source_tags']) && !empty($this->widget->settings['source_tags'])) {
                    foreach ($this->widget->settings['source_tags'] as $tag) {
                        if ($tag == "_all") {
                            $tags = get_tags();
                            foreach ($tags as $tag)
                                $source_tag[] = $tag->term_id;
                        } else {
                            $source_tag[] = $tag;
                        }
                    }
                }


                $args = array(
                    'post_type' => $post_type,
                    'orderby' => $order_by,
                    'order' => isset($order) ? $order : '',
                    'posts_per_page' => $limit,
                    'tax_query' => array(array(
                        'taxonomy' => 'post_tag',
                        'field' => 'term_id',
                        'terms' => isset($source_tag) ? $source_tag : ''
                    ))
                );

                $posts = get_posts($args);
            }

        }

        wp_reset_postdata();

        $posts = (isset($posts) ? $posts : '');

        //sort array posts to get most recent one sort by date
        if(is_multisite()) {
            if(is_array($posts)) {
                usort($posts, function ($a, $b) {
                    return strtotime($b->post_date) - strtotime($a->post_date);
                });
                $posts = array_slice($posts, 0, $this->widget->settings['max_elts'], true);
            }
        }
        
        return
                $this->posts = apply_filters('wpcufpn_front_queryposts', $posts, $this->widget);
    }

    /**
     * add Custom CSS in HTML footer
     * 
     */
    public function customCSS() {
        $customCSS = $this->widget->settings['custom_css'];
        echo '<style type="text/css">' . $customCSS . '</style>';
    }

    /**
     * Front end display
     * 
     */
    public function display($echo = true, $is_sidebar_widget = false) {

        if ($this->posts) {
            $this->container($is_sidebar_widget);
        } elseif (isset($this->widget->settings['no_post_text']) && !empty($this->widget->settings['no_post_text'])) {
            $this->html .=$this->widget->settings['no_post_text'];
        } else {
            $this->html .= __('No content has been found here, sorry :)', 'wp-latest-posts');
        }

        /** call pro plugin additional source type display modes * */
        $this->html = apply_filters('wpcufpn_front_display', $this->html, $this->widget);

        if ($echo)
            echo $this->html;

        return $this->html;
    }

    /** call display ajax * */
    public function displayByAjax($echo = true, $themeclass = NULL) {
        if ($this->posts) {
            $this->loop($themeclass);
        } elseif (isset($this->widget->settings['no_post_text']) && !empty($this->widget->settings['no_post_text'])) {
            $this->html .=$this->widget->settings['no_post_text'];
        }

        /** call pro plugin additional source type display modes * */
        $this->html = apply_filters('wpcufpn_front_display', $this->html, $this->widget);

        if ($echo)
            echo $this->html;

        return $this->html;
    }

    /**
     * This dynamically loads theme styles as inline html styles
     * 
     */
    public function loadThemeScript() {
        global $wpcu_wpfn;
        if($this->widget->settings['theme'] == 'masonry' || $this->widget->settings['theme'] == 'masonry-category' || $this->widget->settings['theme'] == 'smooth-effect' || $this->widget->settings['theme'] == 'timeline' || $this->widget->settings['theme'] == 'portfolio'){
            $theme_root = '';
            $dirs = apply_filters('wpcufpn_plugindir',$theme_root);
            $theme = $dirs .'/'.$this->widget->settings['theme'];
        }else{
             $theme = dirname(plugin_dir_path(__FILE__)).'/themes/'.$this->widget->settings['theme'];
        }
        $theme_dir = basename($theme);
        if ($theme_dir == 'masonry' || $theme_dir == 'masonry-category') {
            wp_enqueue_script(
                    'wpcufpn_addon_front', plugins_url("wp-latest-posts-addon/js") . "/wpcufpn_addon_front.js", array('jquery'), '0.1', true
            );
            wp_enqueue_script(
                    'wpcufpn_addon_imagesloaded', plugins_url('js/imagesloaded.pkgd.min.js', dirname(__FILE__)), array('jquery'), '0.1', true
            );
        }

        $id = $this->widget->ID;
        $nbrow = (isset($this->widget->settings['amount_rows']) ? $this->widget->settings['amount_rows'] : 0);
        $pagination = (isset($this->widget->settings['pagination']) ? $this->widget->settings['pagination'] : 0);
        $autoanimate = (isset($this->widget->settings['autoanimation']) ? $this->widget->settings['autoanimation'] : 0);
        $autoanimatetrans = (isset($this->widget->settings['autoanimation_trans']) ? $this->widget->settings['autoanimation_trans'] : 0);
        $animationloop = (isset($this->widget->settings['autoanim_loop']) ? $this->widget->settings['autoanim_loop'] : 0);
        $slideshowspeed = (isset($this->widget->settings['autoanim_slideshowspeed']) ? $this->widget->settings['autoanim_slideshowspeed'] : 0);
        $slidespeed = (isset($this->widget->settings['autoanim_slidespeed']) ? $this->widget->settings['autoanim_slidespeed'] : 0);
        $pausehover = (isset($this->widget->settings['autoanim_pause_hover']) ? $this->widget->settings['autoanim_pause_hover'] : 0);
        $pauseaction = (isset($this->widget->settings['autoanim_pause_action']) ? $this->widget->settings['autoanim_pause_action'] : 0);
        $slidedirection = (isset($this->widget->settings['autoanimation_slidedir']) ? $this->widget->settings['autoanimation_slidedir'] : 0);
        if (file_exists($theme . '/script.js')) {
            $handle = 'themes-wplp-' . $theme_dir;
            wp_enqueue_script($handle, plugins_url("wp-latest-posts-addon/themes/") . $theme_dir . "/script.js", array('jquery'),$wpcu_wpfn->version, true);
            $data_array= array(
                'id' => $id,
                'nbrow' => $nbrow,
                'pagination' =>$pagination,
                'autoanimate' => $autoanimate,
                'autoanimatetrans' => $autoanimatetrans,
                'animationloop' => $animationloop,
                'slideshowspeed' => $slideshowspeed,
                'slidespeed' => $slidespeed,
                'pausehover' => $pausehover,
                'pauseaction' => $pauseaction,
                'slidedirection' => $slidedirection,
               
            );
            wp_localize_script( $handle, 'WPLP_'.(int)$id, $data_array );

        } else {
           
            wp_enqueue_script('scriptdefault-wplp', plugins_url("wp-latest-posts/js/") . "/wpcufpn_front.js", array('jquery'), '1.0', true);
            $data_array= array(
                'id' => $id,
                'pagination' =>$pagination,
                'autoanimate' => $autoanimate,
                'autoanimatetrans' => $autoanimatetrans,
                'animationloop' => $animationloop,
                'slideshowspeed' => $slideshowspeed,
                'slidespeed' => $slidespeed,
                'pausehover' => $pausehover,
                'pauseaction' => $pauseaction,
                'slidedirection' => $slidedirection,
               
            );
            wp_localize_script( 'scriptdefault-wplp', 'WPLP_'.(int)$id, $data_array );
            
        }
    }

    /**
     * This dynamically loads theme styles as inline html styles
     * 
     */
    public function loadThemeStyle() {
        if($this->widget->settings['theme'] == 'masonry' || $this->widget->settings['theme'] == 'masonry-category' || $this->widget->settings['theme'] == 'smooth-effect' || $this->widget->settings['theme'] == 'timeline' || $this->widget->settings['theme'] == 'portfolio'){
            $theme_root = '';
            $dirs = apply_filters('wpcufpn_plugindir',$theme_root);
            $theme = $dirs .'/'.$this->widget->settings['theme'];
        }else{
             $theme = dirname(plugin_dir_path(__FILE__)).'/themes/'.$this->widget->settings['theme'];
        }
        $theme_dir = basename($theme);

        if (file_exists($theme . '/style.css')) {
            apply_filters('wpcufpn_load_inline_style', $this->widget->settings ,$theme_dir, $this->widget->ID);
        }
    }

    /**
     * This is the main container of our widget
     * also acts as outside framing container of a slideshow
     * 
     */
    private function container($is_sidebar_widget = false) {

        $style_cont = '';
        $orientation = 'vertical';

        /** Container width * */
        if (
                isset($this->widget->settings['total_width']) &&
                'auto' != strtolower($this->widget->settings['total_width']) &&
                $this->widget->settings['total_width']
        ) {
            global $wpcu_wpfn;
            $style_cont .= 'width:' . $this->widget->settings['total_width'] . $wpcu_wpfn->_width_unit_values[$this->widget->settings['total_width_unit']] . ';';
        }

        /** Slider width * */
        if (
                isset($this->widget->settings['amount_pages']) &&
                $this->widget->settings['amount_pages'] > 1
        ) {
            $percent = $this->widget->settings['amount_pages'] * 100;
            $style_slide = 'width: ' . $percent . '%;';
            $orientation = 'horizontal';

            /** Test colonnes * */
            $style_slide .= '-webkit-column-count: 1;';
            $style_slide .= '-moz-column-count: 1;';
            $style_slide .= 'column-count: 1;';
        } else {
            $style_slide = 'width: 100%;';
        }

        if (self::CSS_DEBUG) {
            $style_cont .= 'border:1px solid #C00;';
            $style_slide .= 'border:1px solid #0C0;';
        }

        $this->html .= '<div class="wpcufpn_outside wpcufpn_widget_' . $this->widget->ID . '" style="' . $style_cont . '">';

        /** Widget block title * */
        if (
                !$is_sidebar_widget &&
                isset($this->widget->settings['show_title']) &&
                $this->widget->settings['show_title'] == 1
        ) {
            $this->html .= '<span class="wpcu_block_title">' . $this->widget->post_title . '</span>';
        }

        $theme_class = ' ' . basename($this->widget->settings['theme']);

        $default_class = "";
        $theme_classpro = "";
        $masonry_class = "";
        $smooth_class = "";
        $slideClass = '';
        $timelineClass = '';
        $portfolio_Class = "";

        /**
         * theme $portfolioClass
         */
        if ($theme_class == " portfolio") {
            $theme_classpro = " pro";
            $portfolio_Class = "portfolioContainer_" . $this->widget->ID;
        }

        if ($theme_class == " masonry" || $theme_class == " masonry-category") {
            $theme_classpro = " pro";
            $masonry_class = "masonrycontainer_" . $this->widget->ID;
        }

        if ($theme_class == " smooth-effect") {
            $theme_classpro = " pro";
            $smooth_class = "smoothcontainer_" . $this->widget->ID;
            $style_cont = "";
            $style_slide = "";
            $slideClass = " slides";
        }

        if ($theme_class == " timeline") {
            $theme_classpro = " pro";
            $timelineClass = "timeline_" . $this->widget->ID;
        }

        if ($theme_class == " default") {
            $default_class = "default_" . $this->widget->ID;
        }
        $themeclass = "";
        $themedefaut = "";
        if ($themeclass == "") {
            $style_cont = "";
            $themedefaut = " defaultflexslide";
        }

        $amount_cols_class = ' cols' . $this->widget->settings['amount_cols'];

        /** Container div * */
        $this->html .= '<div id="wpcufpn_widget_' . $this->widget->ID . '" class="wpcufpn_widget_'.basename($this->widget->settings['theme']).' wpcufpn_container ' . $orientation . $themedefaut . $theme_class . $theme_classpro . $amount_cols_class . '" data-post="' . $this->widget->ID . '" style="' . $style_cont . '" >';
        $this->html .= '<ul class="wpcufpn_listposts' . $slideClass . $themedefaut . '" id="' . $default_class . $portfolio_Class . $masonry_class . $smooth_class . $timelineClass . '" style="' . $style_slide . '" >';
        $this->loop($theme_class);
        $this->html .= '</ul>';
        if (is_plugin_active('wp-latest-posts-addon/wp-frontpage-news-pro-addon.php')) {
            if ($theme_class == " masonry" || $theme_class == " masonry-category") {
                if (isset($this->widget->settings['load_more']) && $this->widget->settings['load_more'] == 1) {
                    $this->html .= '<div id="wpcufpn_front_loadmore" >';
                    $this->html .= '<input type="button" id="wpcufpn_front_load_element" class="wpcufpn_front_load_element" value="' . __('Load more', 'wp-latest-posts') . '" />';
                    $this->html .= '</div>';
                }
            }
        }
        $this->html .= '</div>';
        $this->html .= '</div>';
    }

    /**
     * This loops through the posts to display in our widget
     * Each post is like a frame if there is a slider
     * although the slider may list more than one frame in a page
     * depending on the theme template
     * 
     */
    private function loop($themeclass = NULL) {
        global $post;
        global $more;
        $more = 1;

        $style = '';
        if (isset($this->widget->settings['amount_cols']) && ( $this->widget->settings['amount_cols'] > 0 )) {
            $percent = 100 / $this->widget->settings['amount_cols'];

            if (
                    isset($this->widget->settings['amount_pages']) &&
                    $this->widget->settings['amount_pages'] > 1
            )
                $percent = $percent / $this->widget->settings['amount_pages'];

            if (self::CSS_DEBUG)
                $percent = $percent - 1;
            $style .= 'width:' . $percent . '%;';
        }
        if (self::CSS_DEBUG)
            $style .= 'border:1px solid #00C;';

        /*
          if( isset( $this->widget->settings['amount_rows'] ) && ( $this->widget->settings['amount_rows'] > 0 ) ) {
          $this->html .= '';
          }
         */

        /*
         * If themeClass = masonry
         * 
         */

        if ($themeclass == " masonry" ||
                $themeclass == ' masonry-category' ||
                $themeclass == ' smooth-effect' ||
                $themeclass == " timeline" ||
                $themeclass == " portfolio")
            $style = "";


        if ($themeclass == " default")
            $style = "";

        $backgroundimageLI = false;
        if ($themeclass == ' smooth-effect')
            $backgroundimageLI = true;


        //$themeclass
        //if( isset( $this->widget->settings['amount_rows'] ) && ( $this->widget->settings['amount_rows'] > 1 ) ) {


        if ($themeclass == " default") {
            $i = 0;
            $counter = 0;
            $countercols = 0;
            $correcstyle = $style;

            foreach ($this->posts as $post) {
                $i++;
                $counter++;
                $countercols++;


                setup_postdata($post);


                $parentClass = "";
                if ($counter != 1) {
                    $style = 'width:' . (100 / $this->widget->settings['amount_cols']) . '%;box-sizing: border-box;-moz-box-sizing: border-box;';
                    $parentClass = "";
                } else {
                    $style = $correcstyle;
                    $parentClass = "parent ";
                }



                $this->html .= '<li class="' . $parentClass . '" style="' . $style . '"><div class="insideframe">';
                if ($counter == 1) {
                    $this->html .= '<ul style="' . $style . '">';
                    $this->html .= '<li class="" style="width:' . (100 / $this->widget->settings['amount_cols']) . '%;box-sizing: border-box;-moz-box-sizing: border-box;"><div class="insideframe">';
                }
                $this->frame();

                if ($counter == ($this->widget->settings['amount_rows'] * $this->widget->settings['amount_cols']) || $i == count($this->posts)) {
                    $this->html .= '</div></li>';
                    $this->html .= "</ul>";
                    $counter = 0;
                }

                $this->html .= '</div></li>';
            }
            wp_reset_postdata();
        } else {
            $i = 0;

            foreach ($this->posts as $post) {
                $i++;
                setup_postdata($post);
                if ($backgroundimageLI) {
                    // Smooth Hover
                    if ($this->widget->settings["thumb_img"] == 0) {
                        //echo "feature image";				
                        $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                    } else {
                        $imgsrc = "";
                        if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(get_the_ID()), $matches)) {
                            $img = $matches[1][0];
                            global $wpdb;
                            $attachment_id = false;
                            $attachment_url = $img;
                            // Get the upload directory paths
                            $upload_dir_paths = wp_upload_dir();
                            if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
                                $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
                                $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
                                $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
                            }
                            if ($attachment_id)
                                $imgsrc = wp_get_attachment_image_src($attachment_id, "full");
                            else
                                $imgsrc[0] = $img;
                        }
                    }


                    $color = $this->widget->settings["colorpicker"];
                    $color = $this->hex2rgba($this->widget->settings["colorpicker"], 0.7);
                    $colorfull = $this->hex2rgba($this->widget->settings["colorpicker"], 1);

                    if (!$imgsrc)
                        $imgsrc[0] = $this->widget->settings['default_img'];




                    //$style = "background-color:$colorfull;background-image:url('" . $imgsrc[0] . "')";			
                    $style = "background-image:url('" . $imgsrc[0] . "')";
                }


                $this->html .= '<li id="wpcufpn_li_' . $this->widget->ID . '_' . $post->ID . '" data-post="' . $post->ID . '" class="postno_' . $i . $themeclass . ' li-item-id" style="' . $style . '"><div class="insideframe">';
                $this->frame();
                $this->html .= '</div></li>';
            }
            wp_reset_postdata();
        }
    }

    /**
     * One frame displays data about just one post or article
     * The data is organized geometrically into template boxes or blocks
     * 
     */
    private function frame() {
        foreach ($this->boxes as $box) {
            //$function = 'box_' . $box;	//Maybe later to have full customization of a box
            $function = 'box_misc';
            $this->$function($box);  //Variable function name
        }
    }

    /**
     * Builds the content of a block of info for a post
     * inside a frame.
     * $before and $after are only output if there is actual content for that box
     * 
     * @param string $before
     * @param string $after
     */
    private function boxContent($before, $after, $box_name) {
        $my_html = '';

        //TODO: retrieve fields from theme to display inside this box?
        $fields = $this->widget->settings['box_' . $box_name];
        //if( !$fields )
        //	return;
        if (is_array($fields)) {
            foreach ($fields as $field) {
                if ($inner = $this->field($field)) {
                    $my_html .= '<span class="' . sanitize_title($field) . '">';
                    $my_html .= $inner;
                    $my_html .= '</span>';
                }
            }
        }
        //if( !$my_html )
        //	return;

        $this->html .= $before;
        $this->html .= $my_html;
        $this->html .= $after;
    }

    /**
     * Formats a field for front-end display 
     * 
     * @param string $field
     * @return string : html output
     */
    private function field($field) {
        if (empty($field))
            return "";
        global $post;
        $cropTextSize = "";
        $cropTitleSize = "";
        if ( $this->widget->settings["theme"] == 'portfolio') {
            $cropTextSize = self::PORTFOLIO_TEXT_EM_SIZE;
            $cropTitleSize = self::PORTFOLIO_TITLE_EM_SIZE;
        } elseif (strpos($this->widget->settings["theme"], 'masonry') !== FALSE) {
            if ( $this->widget->settings["theme"] == 'masonry-category' ) {
                $cropTextSize = self::MASONRY_CATEGORY_TEXT_EM_SIZE;
                $cropTitleSize = self::MASONRY_CATEGORY_TITLE_EM_SIZE;
            } else {
                $cropTextSize = self::MASONRY_GID_TEXT_EM_SIZE;
                $cropTitleSize = self::MASONRY_GID_TITLE_EM_SIZE;
            }
        } elseif( $this->widget->settings["theme"] == 'smooth-effect' ) {
            $cropTextSize = self::SMOOTH_TEXT_EM_SIZE;
            $cropTitleSize = self::SMOOTH_TITLE_EM_SIZE;
        } elseif ($this->widget->settings["theme"] == 'timeline') {
            $cropTextSize = self::TIMELINE_TEXT_EM_SIZE;
            $cropTitleSize = self::TIMELINE_TITLE_EM_SIZE;
        } else {
            $cropTextSize = self::DEFAULT_TEXT_EM_SIZE;
            $cropTitleSize = self::DEFAULT_TITLE_EM_SIZE;
        }

        /** Title field * */
        if ('Title' == $field) {


            $before = $after = '';

            $title = $post->post_title;
            $title = apply_filters("the_title", $title, $post->ID);

            if ($this->widget->settings['crop_title'] == 0) {  // word cropping
                if (function_exists('wp_trim_words'))
                    $title = wp_trim_words($title, $this->widget->settings['crop_title_len']);
            }
            if ($this->widget->settings['crop_title'] == 1) {  // char cropping
                $title = strip_tags($title);
                $title = mb_substr($title, 0, $this->widget->settings['crop_title_len']);
            }
            if ($this->widget->settings['crop_title'] == 2) { // line limitting
                $style = 'height:' . ( $this->widget->settings['crop_title_len'] * $cropTitleSize ) . 'em';
                if (1 == $this->widget->settings['crop_title_len']) {
                    $before = '<span style="' . $style . '" class="line_limit">';
                } else {
                    $before = '<span style="' . $style . '" class="line_limit nowrap">';
                }
                $after = '</span>';
            }

            return $before . $title . $after;
        }

        /** Text field * */
        if ('Text' == $field) {
            $before = $after = '';

            $text = $post->post_content;
            if (isset($this->widget->settings["text_content"]) && $this->widget->settings["text_content"] == "0") {
                $text = $post->post_content;
            } elseif (isset($this->widget->settings["text_content"]) && $this->widget->settings["text_content"] == "1") {
                $text = $post->post_excerpt;
            }

            $text = strip_shortcodes($text);
            $text = apply_filters('the_content', $text);
            $text = str_replace(']]>', ']]&gt;', $text);
            $text = wp_trim_words($text, 55, "");
            $strlen = $text;
            $croplength = (int) $this->widget->settings['crop_text_len'];
            if ($this->widget->settings['crop_text'] == 0) {  // word cropping
                if (function_exists('wp_trim_words'))
                    $text = wp_trim_words($text, $this->widget->settings['crop_text_len']);
                if ($croplength < str_word_count($strlen)) {
                    $text.= "...";
                }
            }
            if ($this->widget->settings['crop_text'] == 1) {  // char cropping
                $text = strip_tags($text);
                $text = mb_substr($text, 0, $this->widget->settings['crop_text_len']);
                $text = mb_substr($text, 0, mb_strripos($text, " "));
                if ($croplength < strlen($strlen)) {
                    $text.= "...";
                }
            }
            if ($this->widget->settings['crop_text'] == 2) {  // line limitting
                $before = '<span style="max-height:' . ($this->widget->settings['crop_text_len'] * $cropTextSize ) . 'em" class="line_limit">';
                $after = '</span>';
                $text.= "...";
            }

            return $before . $text . $after;
        }

        if ("ImageFull" == $field) {
            if ($this->widget->settings["thumb_img"] == 0) {
                //echo "feature image";
                if(is_multisite()){
                    switch_to_blog($post->curent_blog_id);
                        $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                    restore_current_blog();
                }else{
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                }

            } else {
                if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(get_the_ID()), $matches)) {
                    $img = $matches[1][0];
                    global $wpdb;
                    $attachment_id = false;
                    $attachment_url = $img;
                    // Get the upload directory paths
                    $upload_dir_paths = wp_upload_dir();
                    if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
                        $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
                        $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
                        $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
                    }
                    if ($attachment_id)
                        $imgsrc = wp_get_attachment_image_src($attachment_id, "full");
                    else
                        $imgsrc[0] = $img;
                }
            }

            if (!isset($imgsrc[0]))
                $imgsrc[0] = $this->widget->settings['default_img'];


            $img = '<img src="' . $imgsrc[0] . '"  alt="' . htmlentities($post->post_title) . '"  class="wpcufpn_default" />';
            $before = '<span class="img_cropper ' . get_post_format() . '">';
            $after = '</span>';

            return $before . $img . $after;
        }

        /** First image field * */
        /** Thumbnail field * */
        if ('Thumbnail' == $field) {

            $sizing = null;
            $fetchImageSize = null;
            $style = '';
            /*
             * cropping mode off
             */

            if (isset($this->widget->settings['crop_img']) && $this->widget->settings['crop_img'] == 0) {

                $imageSize = "";
                if (isset($this->widget->settings['image_size']) && !empty($this->widget->settings['image_size'])) {
                    $imageSize = $this->widget->settings['image_size'];
                }
                $fetchImageSize = $this->fetchImageSize($imageSize);
            }

            /**
             * cropping mode on
             */ elseif (isset($this->widget->settings['crop_img']) && $this->widget->settings['crop_img'] == 1) {
                $sizing = array(
                    $this->widget->settings['thumb_width'],
                    $this->widget->settings['thumb_height']
                );

                $style .= 'position: absolute;';
                $style .= 'top: 50%;';
                $style .= 'margin-top: ' . ( 0 - ( $this->widget->settings['thumb_height'] / 2 ) ) . 'px;';
            }


            /** Find image * */
            if ((isset($this->widget->settings['thumb_img']) && $this->widget->settings['thumb_img'] == 0)) { //
                /** Use featured image of post * */
                if ( $this->widget->settings["theme"] == 'portfolio' ) {
                    if(is_multisite()){
                        switch_to_blog($post->curent_blog_id);
                        $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                        restore_current_blog();
                    }else{
                        $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                    }
                } else {
                    if(is_multisite()){
                        switch_to_blog($post->curent_blog_id);
                        if (isset($sizing) && !empty($sizing)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $sizing);
                        } elseif (isset($fetchImageSize) && !empty($fetchImageSize)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $fetchImageSize);
                        }
                        restore_current_blog();
                    }else{
                        if (isset($sizing) && !empty($sizing)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $sizing);
                        } elseif (isset($fetchImageSize) && !empty($fetchImageSize)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $fetchImageSize);
                        }

                    }
                }
                $src = $srca[0];
            } elseif (isset($this->widget->settings['thumb_img']) && $this->widget->settings['thumb_img'] == 1) {
                /** Use first image of post * */
                $imageSize = "";
                /**
                 * get Image Size from setting
                 */
                if (isset($this->widget->settings['image_size']) && !empty($this->widget->settings['image_size'])) {
                    $imageSize = $this->widget->settings['image_size'];
                }
                $fetchImageSize = $this->fetchImageSize($imageSize);


                global $post;
                /**
                 * get post content
                 */
                if (preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $post->post_content, $matches)) {
                    $imageTag = $matches[0];
                }

                $class = "";
                $src = "";
                /**
                 * get src Image
                 */
                if (!empty($imageTag)) {

                    $xmlDoc = new DOMDocument();
                    @$xmlDoc->loadHTML($imageTag);
                    $tags = $xmlDoc->getElementsByTagName('img');

                    foreach ($tags as $order => $tag) {
                        $class = $tag->getAttribute('class');
                        $src = $tag->getAttribute('src');
                    }
                    preg_match('/\d+/', $class, $matches);
                    $firstImageId = $matches;
                    if (!empty($firstImageId)) {
                        $firstImageId = implode(" ", $firstImageId);
                        if(is_multisite()){
                            switch_to_blog($post->curent_blog_id);
                                $srca = wp_get_attachment_image_src(intval($firstImageId), $fetchImageSize);
                                $src = $srca[0];
                            restore_current_blog();
                        }else{
                            $srca = wp_get_attachment_image_src(intval($firstImageId), $fetchImageSize);
                            $src = $srca[0];
                        }

                    }
                } else {
                    if(is_multisite()){
                        switch_to_blog($post->curent_blog_id);
                            $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
                            if (is_array($attachments) && !empty($attachments)) {
                                $first_attachment = array_shift($attachments);
                                $srca = wp_get_attachment_image_src($first_attachment->ID);
                                $src = $srca[0];
                            }
                        restore_current_blog();
                    }else{
                        $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));

                        if (is_array($attachments) && !empty($attachments)) {
                            $first_attachment = array_shift($attachments);
                            $srca = wp_get_attachment_image_src($first_attachment->ID);
                            $src = $srca[0];
                        }
                    }

                }

            } else {
                /** Use default WP thumbnail * */
                if ( $this->widget->settings["theme"] == 'portfolio' ) {
                    if(is_multisite()){
                        switch_to_blog($post->curent_blog_id);
                        $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                        restore_current_blog();
                    }else{
                        $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
                    }

                } else {
                    if(is_multisite()){
                        switch_to_blog($post->curent_blog_id);
                            if (isset($sizing) && !empty($sizing)) {
                                $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $sizing);
                            } elseif (isset($fetchImageSize) && !empty($fetchImageSize)) {
                                $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $fetchImageSize);
                            }
                        restore_current_blog();
                    }else{
                        if (isset($sizing) && !empty($sizing)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $sizing);
                        } elseif (isset($fetchImageSize) && !empty($fetchImageSize)) {
                            $srca = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $fetchImageSize);
                        }
                    }


                }
                $src = $srca[0];
            }
            /* DEBUG
              echo 'img_src: ' . $this->widget->settings['thumb_img'] . '<br/>';
              echo 'post_id: ' . get_the_ID() . '<br/>';
              echo 'src: ' . $src . '<br/><br/>';
             */

            /** If no thumb or first image get default image * */
            if (isset($src) && $src) {
                $img = '<img src="' . $src . '" style="' . $style . '" alt="' . get_the_title() . '" class="wpcufpn_thumb" />';
            } else {
                if (isset($this->widget->settings['default_img']) && $this->widget->settings['default_img']) {
                    $srcDefaultImage = $this->widget->settings['default_img'];

                    $img = '<img src="' . $srcDefaultImage . '" style="' . $style . '" alt="' . get_the_title() . '"  class="wpcufpn_default" />';
                } else {
                    $img = '<span class="img_placeholder" style="' . $style . '" class="wpcufpn_placeholder"></span>';
                }
            }

            /** Image cropping & margin * */
            $style = '';
            if (isset($this->widget->settings['crop_img']) && $this->widget->settings['crop_img'] == 1) {

                $style .= 'width:' . $this->widget->settings['thumb_width'] . 'px;';
                $style .= 'height:' . $this->widget->settings['thumb_height'] . 'px;';
            } else {

                if ( $this->widget->settings["theme"] == 'portfolio' ) {
                    $style .= 'height:' . $this->widget->settings['thumb_height'] . 'px;';
                } elseif ( $this->widget->settings["theme"] == "default" ) {
                    $imageSize = "";
                    if (isset($this->widget->settings['image_size']) && !empty($this->widget->settings['image_size'])) {
                        $imageSize = $this->widget->settings['image_size'];
                    }
                    $fetchImageSize = $this->fetchImageSize($imageSize);


                    if (($fetchImageSize == "medium") || ($fetchImageSize == "large")) {
                        $style .= 'height:' . $this->widget->settings['thumb_height'] . 'px;';
                    }
                }
            }

            if (isset($this->widget->settings['margin_top']) && $this->widget->settings['margin_top'] > 0)
                $style .= 'margin-top:' . $this->widget->settings['margin_top'] . 'px;';
            if (isset($this->widget->settings['margin_right']) && $this->widget->settings['margin_right'] > 0)
                $style .= 'margin-right:' . $this->widget->settings['margin_right'] . 'px;';
            if (isset($this->widget->settings['margin_bottom']) && $this->widget->settings['margin_bottom'] > 0)
                $style .= 'margin-bottom:' . $this->widget->settings['margin_bottom'] . 'px;';
            if (isset($this->widget->settings['margin_left']) && $this->widget->settings['margin_left'] > 0)
                $style .= 'margin-left:' . $this->widget->settings['margin_left'] . 'px;';

            $style .= 'max-width:100%;';

            $before = '<span class="img_cropper" style="' . $style . '">';
            $after = '</span>';

            return $before . $img . $after;
        }

        /** Read more field * */
        if ('Read more' == $field) {
            if (isset($this->widget->settings['read_more']) && $this->widget->settings['read_more']) {
                return __($this->widget->settings['read_more']);
            } else {
                return __('Read more...', 'wp-latest-posts');
            }
        }
        if (is_plugin_active('advanced-custom-fields/acf.php')) {
            //advanced custom fields
            if ('Custom_Fields' == $field) {
                $idPost = get_the_ID();
                if ('src_category' == $this->widget->settings['source_type']) {
                    if (!empty($this->widget->settings['advanced_custom_fields_post']) && $this->widget->settings['advanced_custom_fields_post'] != 'default') {
                        $obj = get_page_by_title($this->widget->settings['advanced_custom_fields_post'], $output = OBJECT, 'acf');
                        $taxonomys = $this->widget->settings['advanced_fields_taxonomy_post'];
                    }
                } elseif ('src_page' == $this->widget->settings['source_type']) {
                    if (!empty($this->widget->settings['advanced_custom_fields_page']) && $this->widget->settings['advanced_custom_fields_page'] != 'default') {
                        $obj = get_page_by_title($this->widget->settings['advanced_custom_fields_page'], $output = OBJECT, 'acf');
                        $taxonomys = $this->widget->settings['advanced_fields_taxonomy_page'];
                    }
                } elseif ('src_custom_post_type' == $this->widget->settings['source_type']) {
                    if (!empty($this->widget->settings['advanced_custom_fields_custompost']) && $this->widget->settings['advanced_custom_fields_custompost'] != 'default') {
                        $obj = get_page_by_title($this->widget->settings['advanced_custom_fields_custompost'], $output = OBJECT, 'acf');
                        $taxonomys = $this->widget->settings['advanced_fields_taxonomy_custompost'];
                    }
                }
                if(!empty($obj)){
                    $fields = $this->getACF($obj->ID, $taxonomys);
                    $custom_field_postmeta = apply_filters('wpcufpn_get_fields', array(), $obj->ID);
                    $outputHtml = array();
                    foreach ($custom_field_postmeta as $v) {
                        if (in_array($v['key'], $fields)) {
                            $outputHtml[] = $this->displayCustomField($this->widget->settings, $idPost, $v);
                        }
                    }
                    return implode('<br/>', $outputHtml);

                }
            }
        }
        if ('Category' == $field) {

            if ('src_custom_post_type' == $this->widget->settings['source_type']) {
                //$cats= get_the_taxonomies($this->widget->settings['custom_post_taxonomy']);
                if(is_multisite()){
                    $custom = $this->widget->settings['custom_post_type'];
                    switch_to_blog($post->curent_blog_id);
                    $argstax = array();
                    $cats = wp_get_post_terms(get_the_ID(), (isset($this->widget->settings['custom_post_taxonomy']) ? $this->widget->settings['custom_post_taxonomy'] : ''), $argstax);
                    if (isset($this->widget->settings['custom_post_term']) && $this->widget->settings['custom_post_term'] != '' ) {
                        $cats = array(get_term_by("id", $this->widget->settings['custom_post_term'], $this->widget->settings['custom_post_taxonomy']));
                    }
                    restore_current_blog();

                }else{
                    $argstax = array();

                    $cats = wp_get_post_terms(get_the_ID(), (isset($this->widget->settings['custom_post_taxonomy']) ? $this->widget->settings['custom_post_taxonomy'] : ''), $argstax);
                    if (isset($this->widget->settings['custom_post_term']) && $this->widget->settings['custom_post_term'] != '' ) {
                        $cats = array(get_term_by("id", $this->widget->settings['custom_post_term'], $this->widget->settings['custom_post_taxonomy']));
                    }
                }

                $listcat = "";
                for ($i = 0; $i < count($cats); $i++) {
                    if ($i > 0)
                        $listcat.= " / ";
                    $listcat.=$cats[$i]->name;
                }
            }
            else {
                if(is_multisite()){
                    switch_to_blog($post->curent_blog_id);
                    $cats = get_the_category();
                    restore_current_blog();
                }else{
                    $cats = get_the_category();
                }

                $listcat = "";

                for ($i = 0; $i < count($cats); $i++) {
                    if ($i > 0)
                        $listcat.= " / ";
                    $listcat.=$cats[$i]->cat_name;
                }
            }




            return $listcat;
        }

        /** Author field * */
        if ('Author' == $field) {
            if(is_multisite()){
                switch_to_blog($post->curent_blog_id);
                $author =  get_the_author();
                restore_current_blog();
                return $author;
            }else{
                return get_the_author();
            }
        }

        /** Date field * */
        if ('Date' == $field) {
            if (isset($this->widget->settings['date_fmt']) && $this->widget->settings['date_fmt']) {
                return get_the_date($this->widget->settings['date_fmt']);
            } else {
                return get_the_date();
            }
        }

        return "\n<!-- wpcuFPN Unknown field: " . strip_tags($field) . " -->\n";
    }

    /**
     * Default template for standard boxes
     *
     */
    public function displayCustomField($settings, $idPost, $fields) {
        $result = "";
        $acf_val = get_field($fields['key'], $idPost, true);
        $before = '<span class="acf-' . $fields['type'] . '">';
        $after = '</span>';
        if ($settings['display_custom_field_title'] == 1) {
            $title = '<span class="act-title-' . $fields['type'] . '" >' . $fields['label'] . ': </span>';
        } else
            $title = '';
        if (!empty($acf_val)) {
            switch ($fields['type']) {
                case 'image':
                    $result = '<img src="' . $acf_val['url'] . '"  alt="' . htmlentities($fields['name']) . '"  class="custom-fields-image" />';

                    break;
                case 'date_picker':
                    if (isset($this->widget->settings['date_fmt']) && $this->widget->settings['date_fmt']) {
                        $display_format = $this->widget->settings['date_fmt'];
                    } else {
                        $display_format = get_option('date_format');
                    }
                    $result = date($display_format, strtotime($acf_val));

                    break;
                case 'file':
                    $icon = wp_mime_type_icon($acf_val['id']);
                    $size = size_format(filesize(get_attached_file($acf_val['id'])));
                    $explode = explode('/', $acf_val['url']);
                    $name = end($explode);
                    $result = ' <ul class="hl file">
                                 <li>
                                         <img class="acf-file-icon" src="' . $icon . '" alt=""/>
                                         
                                 </li>
                                 <li>
                                    <a class="acf-file-name" href="' . $acf_val['url'] . '" target="_blank">' . $name . '</a>
                                    <span>Size:</span>
                                    <span class="acf-file-size">' . $size . '</span>
                                 </li>
                         </ul>   ';

                    break;
                default:
                    $result = $acf_val;
                    break;
            }

            $result = $title . $before . $result . $after;
        }
        return $result;
    }

    public function getACF($id, $taxonomys) {
        $result = array();
        if ("all_fields" == $taxonomys[0]) {
            $custom_field_postmeta = apply_filters('wpcufpn_get_fields', array(), $id);
            foreach ($custom_field_postmeta as $v) {
                $values = get_post_meta($id, $v['key']);
                foreach ($values as $value) {
                    $result[] = $value['key'];
                }
            }
        } else {
            $result = $taxonomys;
        }
        return $result;
    }

    private function box_misc($box_name) {
        global $post;


        $style = '';
        if (self::CSS_DEBUG)
            $style = 'style="border:1px solid #999"';

        $before = '';
        if ('left' == $box_name)
            $before .= '<table><tr>';

        if ('left' == $box_name || 'right' == $box_name) {
            $before .= '<td ';
        } else {
            $before .= '<div ';
        }
        $before .= 'id="wpcufpn_box_' . $box_name . '_' . $this->widget->ID . '_' . $post->ID . '" class="wpcu-front-box ' . $box_name . '" ' . $style . '>';
        if(is_multisite()){
            $before .= '<a href="' . get_blog_permalink( $post->curent_blog_id, $post->ID ) . '">';
        }else{
            $before .= '<a href="' . get_permalink() . '">';
        }

        $after = '';
        $after .= '</a>';
        if ('left' == $box_name || 'right' == $box_name) {
            $after .= '</td>';
        } else {
            $after .= '</div>';
        }
        if ('right' == $box_name)
            $after .= '</tr></table>';

        $this->boxContent($before, $after, $box_name);
    }

    private function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color))
            return $default;

        //Sanitize $color if "#" is provided 
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }

    private function fetchImageSize($imageSize) {
        switch ($imageSize) {
            case 'thumbnailSize':
                $fetchImageSize = 'thumbnail';
                break;

            case 'mediumSize':
                $fetchImageSize = 'medium';
                break;

            case 'largeSize':
                $fetchImageSize = 'large';
                break;
        }
        return $fetchImageSize;
    }

}

?>