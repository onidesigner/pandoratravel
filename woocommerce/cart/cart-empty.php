<?php
/**
 * Empty cart page
 * @author  Onizuka Nghĩa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>

<center>
<img src="<?php echo get_template_directory_uri(); ?>/images/empty_cart.png"/>

<?php
/**
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' ); ?>

<br/>

<?php
if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Return to shop', 'woocommerce' ) ?>
		</a>
	</p>
<?php endif; ?>
</center>