<?php
/**
 * The template for displaying product widget entries
 * @author  Onizuka Nghĩa
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$author_id  = get_post_field( 'post_author', get_the_ID() );
$author     = get_user_by( 'id', $author_id );
$store_info = dokan_get_store_info( $author_id );

if ( !empty( $store_info['store_name'] ) ) $store_name = $store_info['store_name'];
else $store_name = $author->display_name; 

// Review
$users_rating = RWP_API::get_reviews_box_users_rating( get_the_ID(), -1, 'review_service', true );
foreach ($users_rating['scores'] as $scores) {
    $total_score = $total_score + $scores['score'];
}
$final_score = $total_score/count($users_rating['scores']);
?>
<li <?php post_class(); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="product_head">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			</div>
		</a>

		<div class="vendor-avatar">
			<?php echo get_avatar( $author_id, 70, '', $store_name); ?>
		</div>
	</div>

	<div class="product_main">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
		</a>
		
		<div class="review">
			<span>Tổng đánh giá</span> 
			<div class="score">
				<div class="stars small">
					<div style="width: <?php echo (80/100)*$final_score*10; ?>px;"></div>
				</div>
			</div>
			(<?php echo $users_rating['count']; ?>)
		</div>

		<?php woocommerce_get_template( 'loop/price.php' ); ?>
	</div>
</li>
