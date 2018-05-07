<?php
/**
 * Product loop sale flash
 * @author  Onizuka Nghĩa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$regular = $product->regular_price;
$sale = $product->price;
?>

<div class="sale-flash">

<?php if ( $product->is_on_sale() ) :

    $percent = round(($regular - $sale) / $regular * 100);
    $text = $regular > $sale ? '-' : '+';

    if($percent > 0)
    	echo '<span class="onsale">'. $text . $percent .'%</span>';

endif; ?>

<?php if(get_field('duration')) :

	$time_duration = get_field('time_duration') ? get_field('time_duration') : 0;
	$number_of_day = get_field('number_of_day') ? get_field('number_of_day') : 0;
	$number_of_night = get_field('number_of_night') ? get_field('number_of_night') : 0;

	if(get_field('duration') == 'one_day')
		echo '<span class="duration">'. $time_duration.' giờ</span>';

	if(get_field('duration') == 'multiple_day')
		echo '<span class="duration">'. $number_of_day.'N'. $number_of_night .'Đ</span>';

endif; ?>

</div>