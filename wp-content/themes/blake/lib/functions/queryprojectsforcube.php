<?php

	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	
	require_once(
		$_POST['thepath']."wp-" 
		. "loa". "d.p" ."hp");

	global $wpdb;
	$nprojs = $_POST['nprojects'] > 0 ? $_POST['nprojects'] : 99999999999;
	if (isset($_POST['action'])){
		switch($_POST['action']){
			case "import":
				$insertion_errors = false;
				$portfoliotype = get_option("blake_portfolio_permalink") ? get_option("blake_portfolio_permalink") : "portfolio";
				
				$query_portfolios = empty($_POST['portfolios']) ? -1 : $_POST['portfolios'];
				$query_categories = empty($_POST['categories']) ? -1 : $_POST['categories'];
				
				$args = array(
					'post_type' => "'".$portfoliotype."'",
					'posts_per_page' => -1,
					'orderby' => "'".$_POST['orderby']."'",
					'order' => "'".strtoupper($_POST['order'])."'",
					'tax_query' => array(
						array(
							'taxonomy' 	=> 'portfolio_type',
							'field'		=> 'term_id',
							'terms'		=> $query_portfolios
						),
						array(
							'taxonomy' 	=> 'portfolio_category',
							'field'		=> 'term_id',
							'terms'		=> $query_categories
						)
					)
				);
				$allposts = get_posts($args);

				$categoriesfilter = array();
				
				$projectsoutput = "";
				$counter = 0;
				
				foreach ($allposts as $post){
					if ($counter < $nprojs){
						// FILTERS
						$filters_slugs = "";
						$filters_nicenames = "";
						$categories = get_the_terms( $post->ID, 'portfolio_category' );
						if (isset($_POST['categories'])){
							if (!$categories) {
								$filters_slugs = "uncategorized";
								$filters_nicenames = esc_html__("Uncategorized", "blake");
								if (!array_key_exists($filters_slugs, $categoriesfilter)) $categoriesfilter[$filters_slugs] = $filters_nicenames;
							}
							else {
								$first = true;
								foreach ($categories as $cat){
									if ($first){
										$filters_slugs = $cat->slug;
										$filters_nicenames = $cat->name;
										$first = false;
									} else {
										$filters_slugs .= " ".$cat->slug;
										$filters_nicenames .= " / ".$cat->name;
									}
									if (!array_key_exists($cat->slug, $categoriesfilter)) $categoriesfilter[$cat->slug] = $cat->name;
								}
							}	
						} else {
							if (!$categories) {
								$filters_slugs = "uncategorized";
								$filters_nicenames = esc_html__("Uncategorized", "blake");
								if (!array_key_exists($filters_slugs, $newcategories)) $newcategories[$filters_slugs] = $filters_nicenames;
							}
							else {
								$first = true;
								foreach ($categories as $cat){
									if ($first){
										$filters_slugs = $cat->slug;
										$filters_nicenames = $cat->name;
										$first = false;
									} else {
										$filters_slugs .= " ".$cat->slug;
										$filters_nicenames .= " / ".$cat->name;
									}
									if (!array_key_exists($cat->slug, $newcategories)) $newcategories[$cat->slug] = $cat->name;
								}
							}
						}
						// FEATURED_IMAGE
						$featuredimage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID )) ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID )) : "http://ipsumimage.appspot.com/400x300,3481c8";
						// PROJECT LINK
						//$project_url = $post->guid;
						$project_url = get_permalink();
						// VIEW LARGER MEDIA
						$mediatype = "larger";
						switch (get_post_meta($post->ID, 'portfolioType_value', true)){
							case "image":
								$images = get_post_meta($post->ID, 'sliderImages_value', true);
								if ($images){
									$firstimage = explode("|*|", $images);
									$firstimage = $firstimage[0];
									$medialink = explode("|!|", $firstimage);
									$medialink = $medialink[1];
								} else $medialink = $featuredimage;
							break;
							case "video":
								$mediatype = "video"; 
								if (get_post_meta($post->ID, 'videoSource_value', true) === 'youtube') {
									$medialink = explode(",", get_post_meta($post->ID,'videoCode_value',true));	
									$medialink = "http://www.youtube.com/watch?v=".$medialink[0];
								} else if (get_post_meta($post->ID, 'videoSource_value', true) === 'vimeo'){
									$medialink = explode(",", get_post_meta($post->ID,'videoCode_value',true));	
									$medialink = "http://www.vimeo.com/".$medialink[0];
								} else {
									$medialink = get_post_meta($post->ID, 'videoMediaLibrary_value', true);
									$medialink = explode("|*|", $medialink);
									$medialink = $medialink[0];
									$medialink = explode("|!|", $medialink);
									$medialink = $medialink[1];
								}
							break;
							case "other":
								$medialink = $featuredimage;
							break;
						}
						$title = "";
						$title .= strip_tags($post->post_title);
						$author = "";
						$author = $wpdb->get_results($wpdb->prepare("SELECT user_nicename FROM $wpdb->users WHERE ID = %d", $post->post_author), ARRAY_A);
						if (isset($author[0]) && isset($author[0]['user_nicename'])) $author = "by ".$author[0]['user_nicename'];
						else $author = "DUMMY TEXT";
						
						$itemoutput = "";
						switch ($_POST['template']){
							case "juicy-projects":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$project_url}\" class=\"cbp-singlePage cbp-l-caption-buttonLeft\" data-cbp-selector=\"automatically\">more info</a><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view {$mediatype}</a></div></div></div></div><div class=\"cbp-l-grid-projects-title\">{$title}</div><div class=\"cbp-l-grid-projects-desc\">{$filters_nicenames}</div></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <div class=\"cbp-caption\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignCenter\"> <div class=\"cbp-l-caption-body\"> <a href=\"{$project_url}\" class=\"cbp-singlePageInline cbp-l-caption-buttonLeft\" data-cbp-selector=\"automatically\">more info</a> <a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view {$mediatype}</a> </div> </div> </div> </div> <div class=\"cbp-l-grid-projects-title\">{$title}</div> <div class=\"cbp-l-grid-projects-desc\">{$filters_nicenames}</div> </div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonLeft\">more info</a><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view larger</a></div></div></div></div><div class=\"cbp-l-grid-projects-title\">{$title}</div><div class=\"cbp-l-grid-projects-desc\">{$filters_nicenames}</div></div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$project_url}\" class=\"cbp-simpleLink cbp-l-caption-buttonLeft\">more info</a><a href=\"{$featuredimage}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view larger</a></div></div></div></div><div class=\"cbp-l-grid-projects-title\">{$title}</div><div class=\"cbp-l-grid-projects-desc\">{$filters_nicenames}</div></div>";
									break;
								}
							break;
							case "lightbox-gallery":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <a href=\"{$medialink}\" class=\"cbp-caption cbp-lightbox\" data-title=\"{$title}\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignLeft\"> <div class=\"cbp-l-caption-body\"> <div class=\"cbp-l-caption-title\">{$title}</div> <div class=\"cbp-l-caption-desc\">{$author}</div> </div> </div> </div> </a> </div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-simpleLink\" data-title=\"{$title}\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
								}
							break;
							case "meet-the-team":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROFILE</div></div></div></div></a><a href=\"{$project_url}\" class=\"cbp-l-grid-team-name cbp-singlePage\" data-cbp-selector=\"automatically\">{$title}</a><div class=\"cbp-l-grid-team-position\">{$filters_nicenames}</div></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROFILE</div></div></div></div></a><a href=\"{$project_url}\" class=\"cbp-l-grid-team-name cbp-singlePageInline\" data-cbp-selector=\"automatically\">{$title}</a><div class=\"cbp-l-grid-team-position\">{$filters_nicenames}</div></div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$featuredimage}\" class=\"cbp-caption cbp-lightbox\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROFILE</div></div></div></div></a><a href=\"{$featuredimage}\" class=\"cbp-l-grid-team-name cbp-lightbox\">{$title}</a><div class=\"cbp-l-grid-team-position\">{$filters_nicenames}</div></div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <a href=\"{$project_url}\" class=\"cbp-caption cbp-simpleLink\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignCenter\"> <div class=\"cbp-l-caption-body\"> <div class=\"cbp-l-caption-text\">VIEW PROFILE</div> </div> </div> </div> </a> <a href=\"{$project_url}\" class=\"cbp-simpleLink cbp-l-grid-team-name\">{$title}</a><div class=\"cbp-l-grid-team-position\">{$filters_nicenames}</div> </div>";
									break;
								}
							break;
							case "full-box":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <a href=\"{$medialink}\" class=\"cbp-caption cbp-lightbox\" data-title=\"{$title} {$author}\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignLeft\"> <div class=\"cbp-l-caption-body\"> <div class=\"cbp-l-caption-title\">{$title}</div> <div class=\"cbp-l-caption-desc\">{$author}</div> </div> </div> </div> </a> </div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-simpleLink\" data-title=\"{$title}\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignLeft\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
								}
							break;
							case "masonry":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs} cbp-l-grid-masonry-height2 cbp-item-height-2\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs} cbp-l-grid-masonry-height2 cbp-item-height-2\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs} cbp-l-grid-masonry-height2\"> <a class=\"cbp-caption cbp-lightbox\" data-title=\"{$title}\" href=\"{$medialink}\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignCenter\"> <div class=\"cbp-l-caption-body\"> <div class=\"cbp-l-caption-title\">{$title}</div> <div class=\"cbp-l-caption-desc\">{$author}</div> </div> </div> </div> </a> </div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs} cbp-l-grid-masonry-height2 cbp-item-height-2\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-simpleLink\" data-title=\"{$title}\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-title\">{$title}</div><div class=\"cbp-l-caption-desc\">{$author}</div></div></div></div></a></div>";
									break;
								}
							break;
							case "blog-posts":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROJECT</div></div></div></div></a><a href=\"{$project_url}\" class=\"cbp-l-grid-blog-title\">{$title}</a><div class=\"cbp-l-grid-blog-date\">".get_the_date("d", $post->ID) . " " . get_the_date("F", $post->ID). " " . get_the_date("Y", $post->ID)."</div>";
										if ($post->comment_status === 'open'){
											$itemoutput .= "<div class=\"cbp-l-grid-blog-split\">|</div><a href=\"#\" class=\"cbp-l-grid-blog-comments\">".$post->comment_count." comment";
											if ($post->comment_count != 1) $itemoutput .= "s";
											$itemoutput .= "</a>";
										}								
										$itemoutput .= "<div class=\"cbp-l-grid-blog-desc\">".$post->post_excerpt."</div> </div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROJECT</div></div></div></div></a><a href=\"{$project_url}\" class=\"cbp-l-grid-blog-title\">{$title}</a><div class=\"cbp-l-grid-blog-date\">".get_the_date("d", $post->ID) . " " . get_the_date("F", $post->ID). " " . get_the_date("Y", $post->ID)."</div>";
										if ($post->comment_status === 'open'){
											$itemoutput .= "<div class=\"cbp-l-grid-blog-split\">|</div><a href=\"#\" class=\"cbp-l-grid-blog-comments\">".$post->comment_count." comment";
											if ($post->comment_count != 1) $itemoutput .= "s";
											$itemoutput .= "</a>";
										}								
										$itemoutput .= "<div class=\"cbp-l-grid-blog-desc\">".$post->post_excerpt."</div> </div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$featuredimage}\" class=\"cbp-caption cbp-lightbox\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><div class=\"cbp-l-caption-text\">VIEW PROJECT</div></div></div></div></a><a href=\"{$project_url}\" class=\"cbp-l-grid-blog-title\">{$title}</a><div class=\"cbp-l-grid-blog-date\">".get_the_date("d", $post->ID) . " " . get_the_date("F", $post->ID). " " . get_the_date("Y", $post->ID)."</div>";
										if ($post->comment_status === 'open'){
											$itemoutput .= "<div class=\"cbp-l-grid-blog-split\">|</div><a href=\"#\" class=\"cbp-l-grid-blog-comments\">".$post->comment_count." comment";
											if ($post->comment_count != 1) $itemoutput .= "s";
											$itemoutput .= "</a>";
										}								
										$itemoutput .= "<div class=\"cbp-l-grid-blog-desc\">".$post->post_excerpt."</div> </div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <a href=\"{$project_url}\" target=\"_blank\" class=\"cbp-simpleLink cbp-caption\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignCenter\"> <div class=\"cbp-l-caption-body\"> <div class=\"cbp-l-caption-text\">VIEW PROJECT</div> </div> </div> </div> </a> <a href=\"{$project_url}\" target=\"_blank\" class=\"cbp-l-grid-blog-title\">{$title}</a> <div class=\"cbp-l-grid-blog-date\">".get_the_date("d", $post->ID) . " " . get_the_date("F", $post->ID). " " . get_the_date("Y", $post->ID)."</div>";
										if ($post->comment_status === 'open'){
											$itemoutput .= "<div class=\"cbp-l-grid-blog-split\">|</div><a href=\"#\" class=\"cbp-l-grid-blog-comments\">".$post->comment_count." comment";
											if ($post->comment_count != 1) $itemoutput .= "s";
											$itemoutput .= "</a>";
										}								
										$itemoutput .= "<div class=\"cbp-l-grid-blog-desc\">".$post->post_excerpt."</div> </div>";
									break;
								}
							break;
							case "masonry-projects":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$project_url}\" class=\"cbp-singlePage cbp-l-caption-buttonLeft\" data-cbp-selector=\"automatically\">more info</a><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view {$mediatype}</a></div></div></div></div><div class=\"cbp-l-grid-masonry-projects-title\">{$title}</div><div class=\"cbp-l-grid-masonry-projects-desc\">{$filters_nicenames}</div></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"> <div class=\"cbp-caption\"> <div class=\"cbp-caption-defaultWrap\"> <img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"> </div> <div class=\"cbp-caption-activeWrap\"> <div class=\"cbp-l-caption-alignCenter\"> <div class=\"cbp-l-caption-body\"> <a href=\"{$project_url}\" class=\"cbp-singlePageInline cbp-l-caption-buttonLeft\" data-cbp-selector=\"automatically\">more info</a> <a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view {$mediatype}</a> </div> </div> </div> </div> <div class=\"cbp-l-grid-masonry-projects-title\">{$title}</div> <div class=\"cbp-l-grid-masonry-projects-desc\">{$filters_nicenames}</div> </div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonLeft\">more info</a><a href=\"{$medialink}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view larger</a></div></div></div></div><div class=\"cbp-l-grid-masonry-projects-title\">{$title}</div><div class=\"cbp-l-grid-masonry-projects-desc\">{$filters_nicenames}</div></div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><div class=\"cbp-caption\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"><div class=\"cbp-l-caption-alignCenter\"><div class=\"cbp-l-caption-body\"><a href=\"{$project_url}\" class=\"cbp-simpleLink cbp-l-caption-buttonLeft\">more info</a><a href=\"{$featuredimage}\" class=\"cbp-lightbox cbp-l-caption-buttonRight\" data-title=\"{$title}\">view larger</a></div></div></div></div><div class=\"cbp-l-grid-masonry-projects-title\">{$title}</div><div class=\"cbp-l-grid-masonry-projects-desc\">{$filters_nicenames}</div></div>";
									break;
								}
							break;
							case "awesome-work":
								switch($_POST['layout']){
									case "singlepage":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePage\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"></div></a><div class=\"cbp-l-grid-work-title\">{$title}</div><div class=\"cbp-l-grid-work-desc\">{$author}</div></div>";
									break;
									case "singlepageinline":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$project_url}\" class=\"cbp-caption cbp-singlePageInline\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"></div></a><div class=\"cbp-l-grid-work-title\">{$title}</div><div class=\"cbp-l-grid-work-desc\">{$author}</div></div>";
									break;
									case "lightbox":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$medialink}\" class=\"cbp-caption cbp-lightbox\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"></div></a><div class=\"cbp-l-grid-work-title\">{$title}</div><div class=\"cbp-l-grid-work-desc\">{$author}</div></div>";
									break;
									case "simplelink":
										$itemoutput = "<div class=\"des-project cbp-item {$filters_slugs}\"><a href=\"{$medialink}\" class=\"cbp-caption cbp-simpleLink\" data-title=\"{$title}\" data-cbp-selector=\"automatically\"><div class=\"cbp-caption-defaultWrap\"><img src=\"{$featuredimage}\" alt=\"\" width=\"100%\"></div><div class=\"cbp-caption-activeWrap\"></div></a><div class=\"cbp-l-grid-work-title\">{$title}</div><div class=\"cbp-l-grid-work-desc\">{$author}</div></div>";
									break;
								}
							break;
						}
						$projectsoutput .= $itemoutput;	
						$counter++;
					}
				}
				
				if (!isset($_POST['categories'])) $categoriesfilter = $newcategories;
				echo json_encode(array("output" => $projectsoutput, "categories" => $categoriesfilter));
				
			break;
			
			case "update_popups":
				$table_name = $wpdb->prefix."cubeportfolio";
				echo json_encode($wpdb->get_results( $wpdb->prepare("UPDATE $table_name SET popup = %s WHERE id=%d", stripslashes($_POST['items']),$_POST["current_portfolio_ID"] ), ARRAY_A ));
			break;
		}	
	}
	
?>