<?php
	
Class blake_walker_nav_menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' );
	    $display_depth = ( $depth + 1);
	    $classes = array(
	        'sub-menu',
	        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
	        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
	        'menu-depth-' . $display_depth
	        );
	    $class_names = implode( ' ', $classes );
	    $output .= "\n" . $indent . '<ul class="dropdown-menu ' . esc_attr($class_names) . '">' . "\n";
	}
  	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $wp_query, $homes;
	    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
	    $depth_classes = array(
	        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
	        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
	        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
	        'menu-item-depth-' . $depth
	    );
	    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    $iconsclass = "";
	    if (!empty($classes)){
	    	for ($i=0; $i<count($classes); $i++){
		    	if (isset($classes[$i]) && substr($classes[$i], 0, 2) === "fa"){
			    	$iconsclass .= " ".$classes[$i];
			    	unset($classes[$i]);
		    	}
	    	}
	    }
	    if ($iconsclass != "") $iconsclass = "<i class='main-menu-icon ".esc_attr($iconsclass)."'></i>";
	    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		$pid = explode(" ",$class_names);
		$thyid = 0;
		foreach ($pid as $p){
			if (substr( $p, 0, 5 ) === "page-"){
				$thyid = substr($p,5);
			}
		}
		$template = get_post_meta($thyid, '_wp_page_template', true);
		$outsider = ($template === "page.php" || $template === "blog-template.php" || $template === "blog-masonry-template.php" || $template === "template-home.php" || $template === "woocommerce.php" || $template === "template-under-construction.php" || $template === "template-blank.php") ? " outsider" : "";
		
		if ($template === "template-home.php") $homes++;
		if ($template === "template-home.php" && $homes == 1) $outsider .= " mainhomepage";
	    $output .= $indent . '<li id="nav-menu-item-'. esc_attr($item->ID) . '" class="' . esc_attr($depth_class_names) . ' ' . esc_attr($class_names) . '">';
  
	    // link attributes
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		if (!empty($item->url)){
			if ($outsider != ""){
				if ($template === "one-page-template.php"){
					$attributes .= ' href="./#section_page-'.esc_attr($thyid).'"';
				} else {
					if ($template === 'template-home.php' && $homes == 1){
						$attributes .= ' href="#home"';
					} else {
						$attributes .= ' href="' . esc_attr(esc_url( $item->url )) . '"';
					}	
				}
			} else {
				$custom = false;
				foreach ($pid as $p){
					if ($p === "menu-item-object-custom"){
						$custom = true;
					}
				}
				if ($custom) $attributes .= ' href="' . esc_attr( esc_url($item->url) ) . '"';
				else $attributes .= ' href="#section_page-'.$thyid.'"';
			}
		}
	    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' . $outsider : 'main-menu-link' ) . $outsider . '"';
  
	    $item_output = sprintf( '%1$s<a%2$s>%7$s%3$s%4$s%5$s</a>%6$s',
	        $args->before,
	        $attributes,
	        $args->link_before,
	        apply_filters( 'the_title', $item->title, $item->ID ),
	        $args->link_after,
	        $args->after,
	        $iconsclass
	    );
  
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class blake_walker_nav_menu_outsider extends Walker_Nav_Menu {
  
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' );
	    $display_depth = ( $depth + 1);
	    $classes = array(
	        'sub-menu',
	        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
	        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
	        'menu-depth-' . $display_depth
	        );
	    $class_names = implode( ' ', $classes );
	    $output .= "\n" . $indent . '<ul class="dropdown-menu ' . esc_attr($class_names) . '">' . "\n";
	}
  
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $wp_query;
	    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
	    $depth_classes = array(
	        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
	        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
	        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
	        'menu-item-depth-' . $depth
	    );
	    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    
	    $iconsclass = "";
	    if (!empty($classes)){
	    	for ($i=0; $i<count($classes); $i++){
		    	if (isset($classes[$i]) && substr($classes[$i], 0, 2) === "fa"){
			    	$iconsclass .= " ".$classes[$i];
			    	unset($classes[$i]);
		    	}
	    	}
	    }
	    if ($iconsclass != "") $iconsclass = "<i class='main-menu-icon ".esc_attr($iconsclass)."'></i>";
	    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	    
	    $pid = explode(" ",$class_names);
		$thyid = 0;
		foreach ($pid as $p){
			if (substr( $p, 0, 5 ) == "page-" && substr( $p, 0, 10 ) != "page-item-"){
				$thyid = substr($p,5);
			}
		}
	    $template = get_post_meta($thyid, '_wp_page_template', true);
	    $output .= $indent . '<li id="nav-menu-item-'. esc_attr($item->ID) . '" class="' . esc_attr($depth_class_names) . ' ' . esc_attr($class_names) . '">';
  
	    // link attributes
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		if (!empty($item->url)){
			if ($template === "one-page-template.php"){
				$attributes .= ' href="' . esc_url( home_url( '/' ) ) . "#section_page-" . esc_attr($thyid) . '"';
			} else {
				$attributes .= ' href="' . esc_attr( $item->url ) . '"';	
			}
		}
	    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
  
	    $item_output = sprintf( '%1$s<a%2$s>%7$s%3$s%4$s%5$s</a>%6$s',
	        $args->before,
	        $attributes,
	        $args->link_before,
	        apply_filters( 'the_title', $item->title, $item->ID ),
	        $args->link_after,
	        $args->after,
	        $iconsclass
	    );
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

?>