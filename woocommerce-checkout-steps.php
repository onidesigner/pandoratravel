<?php
/**
 * Step Checkout template by Onizuka
 * @author  Onizuka Nghĩa
 */
global $woocommerce;

$steps = [
    [
        'title' => 'Chọn dịch vụ',
        'icon'  => 'fa fa-shopping-basket',
        'url'   => $woocommerce->cart->get_cart_url()
    ],
    [
        'title' => 'Thông tin đặt hàng',
        'icon'  => 'fa fa-file-text-o',
        'url'   => $woocommerce->cart->get_checkout_url()
    ],
    [
        'title' => 'Xác nhận đặt chỗ',
        'icon'  => 'fa fa-money',
        'url'   => '#'
    ]
];

if(is_cart() || is_checkout() || is_order_received_page()) {
	if(is_cart()){$active = 0;}
	if(is_checkout()){$active = 1;}
	if(is_order_received_page()){$active = 2;}
?>

    <ol class="progress-steps">
    	<?php 
    	foreach ($steps as $idx => $step) {

			$class = '';
			if($active == $idx){ $class = 'is-active'; }
			else if($idx < $active){ $class = 'is-complete'; }

			$idx = $idx + 1;
			if($idx == count($steps)){ $class .= ' progress__last'; }

			echo '<li data-step="'.$idx.'" class="'.$class.'"><a href="'.$step['url'].'">'.$step['title'].'</a></li>';
    	} ?>
    </ol>

<?php } ?>