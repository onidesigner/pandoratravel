<?php 
/**
 * Add_Quantity_On_Checkout
 **/
if (!class_exists('Change_Quantity_On_Checkout')) {

	class Change_Quantity_On_Checkout {

		public $plugin_version = '1.0';
		public function __construct() {
            add_filter ('woocommerce_cart_item_name',              array( $this, 'cqoc_add_quantitytest'), 10, 3 );
    	    add_filter ('woocommerce_checkout_cart_item_quantity', array( $this, 'cqoc_add_quantity'), 10, 2 );
    	    add_action( 'wp_footer',                               array( $this, 'cqoc_populate_postcode' ), 10 );
     	    add_action( 'init',                                    array( $this, 'cqoc_load_ajax' ) );
        }
		public static function cqoc_add_quantitytest( $product_title, $cart_item, $cart_item_key ) {
		    /*
		     * It will add Delete button, Quanitity field of the checkout page Table.
		     */
		    if (  is_checkout() ) {
		        $cart     = WC()->cart->get_cart();
                foreach ( $cart as $cart_key => $cart_value ){
                   if ( $cart_key == $cart_item_key ){
                        $product_id = $cart_item['product_id'];
                        $_product   = $cart_item['data'] ;
                        $return_value = sprintf(
                          '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                          esc_url( WC()->cart->get_remove_url( $cart_key ) ),
                          __( 'Remove this item', 'woocommerce' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        );

                        $product_thumbnail = get_the_post_thumbnail( $cart_item['product_id'], array('60', '60') );
                        $product_permalink = get_the_permalink( $product_id );

                        $return_value .= '<div class="product_thumbnail"><a href="'. $product_permalink .'">'. $product_thumbnail .'</a></div>' ;
                        $return_value .= '<div class="product_info">';
                        $return_value .= '<a href="'. $product_permalink .'"><span class="product_name" >'. $product_title .'</span></a>' ;
                        // if ( $_product->is_sold_individually() ) {
                        //   $return_value .= sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_key );
                        // } else {
                        //   $return_value .= woocommerce_quantity_input( array(
                        //       'input_name'  => "cart[{$cart_key}][qty]",
                        //       'input_value' => $cart_item['quantity'],
                        //       'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                        //       'min_value'   => '1'
                        //           ), $_product, false );
                        // }
                        // if($_product->get_price_html() !=''):
                        //   $return_value .= ' × <span class="product-price sr-price">'.WC()->cart->get_product_price( $_product ).'</span>';
                        // endif;
                        $return_value .= '</div>';
                        return $return_value;
                    }
                }
		    }else{
		        /*
		         * It will return the product name on the cart page.
		         * As the filter used on checkout and cart are same.
		         */
		        $_product   = $cart_item['data'] ;
		        $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
		        if ( ! $product_permalink ) {
		            $return_value = $_product->get_title() . '&nbsp;';
		        } else {
		            $return_value = sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title());
		        }
		        return $return_value;
		    }
		}

		/*
		 * It will remove the selected quantity count from checkout page table.
		 */
    	public static function cqoc_add_quantity( $cart_item, $cart_item_key ) {
    	   $product_quantity = '';
    	   return $product_quantity;
    	}
    	
    	function cqoc_populate_postcode(){
    	     
            if (  is_checkout() ) {
			
    		// $plugin_version = $this->plugin_version;
			  // wp_enqueue_style( 'cqoc_checkout', plugins_url( '/assets/css/change-quantity-on-checkout.css', __FILE__ ), '', $plugin_version, false );
            ?>
                <script type="text/javascript">
					
                    <?php  $admin_url = get_admin_url(); ?>
					jQuery("form.checkout").on("change", "input.qty", function(){
                        
                        var data = {
                    		action: 'cqoc_update_order_review',
                    		security: wc_checkout_params.update_order_review_nonce,
                    		post_data: jQuery( 'form.checkout' ).serialize()
                    	};
						
                    	jQuery.post( '<?php echo $admin_url; ?>' + 'admin-ajax.php', data, function( response )
                		{
                            jQuery( 'body' ).trigger( 'update_checkout' );
						});
                    });
                </script>
             <?php  
             }
        }
        
        function cqoc_load_ajax() {
        
            if ( !is_user_logged_in() ){
                add_action( 'wp_ajax_nopriv_cqoc_update_order_review', array( &$this, 'cqoc_update_order_review' ) );
            } else{
                add_action( 'wp_ajax_cqoc_update_order_review',        array( &$this, 'cqoc_update_order_review' ) );
            }
        
        }
        
        function cqoc_update_order_review() {
             
            $values = array();
            parse_str($_POST['post_data'], $values);
            $cart = $values['cart'];
            foreach ( $cart as $cart_key => $cart_value ){
                WC()->cart->set_quantity( $cart_key, $cart_value['qty'], false );
                WC()->cart->calculate_totals();
                woocommerce_cart_totals();
            }
            exit;
        }
	}
}
$change_quantity_on_checkout = new Change_Quantity_On_Checkout();