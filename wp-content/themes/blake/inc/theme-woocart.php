<?php
	
function blake_print_woocommerce_button(){
	global $woocommerce;
	if (isset($woocommerce) && get_option("blake_woocommerce_cart") == "on"){ ?>
		<div class="blake_dynamic_shopping_bag">
    
            <div class="blake_little_shopping_bag_wrapper">
                <div class="blake_little_shopping_bag">
                    <div class="title">
	                	<i class="line-icons-bag2"></i>
	                </div>
	                
	                <div class="overview"><span class="minicart_items"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'blake'), $woocommerce->cart->cart_contents_count); ?></span></div>
                </div>
                <div class="blake_minicart_wrapper">
                    <div class="blake_minicart">
                    <?php                                    
                    echo '<ul class="cart_list">';                                        
                        if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                        
                            $_product = $cart_item['data'];                                            
                            if ($_product->exists() && $cart_item['quantity']>0) :                                            
                                echo '<li class="cart_list_product">';                                                
                                    echo '<a class="cart_list_product_img" href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . $_product->get_image().'</a>';                                                    
                                    echo '<div class="cart_list_product_title">';
                                        $blake_product_title = $_product->get_title();
                                        $blake_short_product_title = (strlen($blake_product_title) > 28) ? substr($blake_product_title, 0, 25) . '...' : $blake_product_title;
                                        echo '<a href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . apply_filters('woocommerce_cart_widget_product_title', $blake_short_product_title, $_product) . '</a>';
                                        echo '<div class="cart_list_product_quantity">'.$cart_item['quantity'].'x</div>';
                                    echo '</div>';
                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'blake') ), $cart_item_key );
                                    echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                    echo '<div class="clr"></div>';                                                
                                echo '</li>';                                         
                            endif;                                        
                        endforeach;
                        ?>
                                
                        <div class="minicart_total_checkout">                                        
                            <?php esc_html_e('Cart subtotal', 'blake'); ?><span><?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></span>                                   
                        </div>
                        
                         <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button blake_minicart_cart_but"><?php esc_html_e('View Bag', 'blake'); ?></a>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button blake_minicart_checkout_but"><?php esc_html_e('Checkout', 'blake'); ?></a>
                        
                        <?php                                        
                        else: echo '<li class="empty">'.esc_html__('No products in the cart.','blake').'</li>'; endif;                                    
                    echo '</ul>';                                    
                    ?>                                                                        
    
                    </div>
                </div>
                
            </div>
            
            <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="blake_little_shopping_bag_wrapper_mobiles"><span><?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?></span></a>
        
        </div>
    <?php
	}
}

function blake_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<div class="blake_dynamic_shopping_bag">
        <div class="blake_little_shopping_bag_wrapper">
            <div class="blake_little_shopping_bag" style="background: transparent !important;">
                <div class="title">
                	<i class="line-icons-bag2"></i>
                </div>
                <div class="overview"><span class="minicart_items"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'blake'), $woocommerce->cart->cart_contents_count); ?></span></div>
            </div>
            <div class="blake_minicart_wrapper">
                <div class="blake_minicart">
                <?php
                echo '<ul class="cart_list">';
                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                        $_product = $cart_item['data'];
                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
                            echo '<li class="cart_list_product">';
                                echo '<a class="cart_list_product_img" href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . $_product->get_image().'</a>';
                                echo '<div class="cart_list_product_title">';
                                    $blake_product_title = $_product->get_title();
                                    $blake_short_product_title = (strlen($blake_product_title) > 28) ? substr($blake_product_title, 0, 25) . '...' : $blake_product_title;
                                    echo '<a href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . apply_filters('woocommerce_cart_widget_product_title', $blake_short_product_title, $_product) . '</a>';
                                    echo '<div class="cart_list_product_quantity">'.$cart_item['quantity'].'x</div>';
                                echo '</div>';
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'blake') ), $cart_item_key );
                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                echo '<div class="clr"></div>';
                            echo '</li>';
                        endif;
                    endforeach;
                    ?>
                    <div class="minicart_total_checkout">
                        <?php esc_html_e('Cart subtotal', 'blake'); ?><span><?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></span>
                    </div>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button blake_minicart_cart_but"><?php esc_html_e('View Bag', 'blake'); ?></a>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button blake_minicart_checkout_but"><?php esc_html_e('Checkout', 'blake'); ?></a>
                    <?php                                    
                    else: echo '<li class="empty">'.esc_html__('No products in the cart.','blake').'</li>'; endif;
                echo '</ul>';
                ?>
                </div>
            </div>
        </div>
        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="blake_little_shopping_bag_wrapper_mobiles"><span><?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?></span></a>
    </div>
	<?php
	$fragments['div.blake_dynamic_shopping_bag' ] = ob_get_clean();
	return $fragments;
}

?>