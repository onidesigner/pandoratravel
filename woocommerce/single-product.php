<?php
/**
 * The Template for displaying all single products.
 * @author  Onizuka Nghĩa
 */

td_global::$current_template = 'woo_single';

$td_mod_single = new td_module_single($post);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>
    <div class="td-main-content-wrap td-container-wrap td-post-template-3">
        <div class="td-post-header td-container">
            <div class="td-crumb-container"><?php woocommerce_breadcrumb(); ?></div>
            <div class="td-post-header-holder td-image-gradient">

                <?php echo $td_mod_single->get_image('td_1068x0'); ?>

                <header class="td-post-title">
                    <?php echo $td_mod_single->get_category(); ?>
                    <?php echo $td_mod_single->get_title();?>

                    <div class="td-post-sub-title"><?php the_excerpt(); ?></div>

                    <div class="td-module-meta-info">
                        <?php echo $td_mod_single->get_author();?>
                        <?php echo $td_mod_single->get_date(false);?>
                        <?php echo $td_mod_single->get_views();?>
                        <?php echo $td_mod_single->get_comments();?>
                    </div>

                </header>
            </div>
        </div>

        <div class="td-container product">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content td-post-content">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

                        <div class="footer-bar">
                            <div class="hotline">
                                <a class="" href="tel:+84968081384">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i> 
                                    <span class="text-xs">096.808.1384</span>
                                    <span class="text-xxs">Hotline</span>
                                </a>
                            </div>
                            <div class="single_add_to_cart">
                                <a class="single_add_to_cart_button button alt" href="javascript:void(0)" onclick="click_to_form();">Thêm vào giỏ</a>
                            </div>
                        </div>

                        <?php 
                        $terms = get_the_terms( get_the_ID(), 'product_tag' );
                        if (!empty($terms)) {
                            echo '<div class="td-post-source-tags">';
                            echo '<ul class="td-tags td-post-small-box clearfix">';
                            echo '<li><span>' . __td('TAGS', TD_THEME_NAME) . '</span></li>';
                            foreach ($terms as $term) {
                                echo '<li><a href="' . get_term_link($term) . '" rel="tag">' . $term->name . '</a></li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="td-pb-span4 td-main-sidebar">
                    <div class="td-ss-main-sidebar">

                        <?php if (!has_term(array(801,802,854), 'product_cat')) { ?>
                        <div class="summary entry-summary">                            
                            <h3 class="summary-head"><span>Đặt ngay dịch vụ</span></h3>
                            <?php do_action( 'woocommerce_single_product_summary' ); ?>
                        </div>
                        <?php } ?>

                        <?php get_template_part( 'dokan-vendor-info' ); ?>

                        <div class="clearfix"></div>

                        <div class="block">
                            <h3 class="block-title"><span>TẠI SAO CHỌN CHÚNG TÔI</span></h3>
                            <div class="block-content">
                                <ul class="reasons">
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                            <i class="icon-reason chuyen-sau"></i>
                                        </div>
                                        <div class="reason-text">
                                            Một trong những trang Thương Mại Điện Tử về Du Lịch uy tín hàng đầu Việt Nam
                                        </div>
                                    </li>
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                            <i class="icon-reason khach-vip"></i>
                                        </div>
                                        <div class="reason-text">
                                            Sản phẩm Tour đa dạng, chất lượng, phạm vi cung cấp rộng lớn
                                        </div>
                                    </li>
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                        <i class="icon-reason tiet-kiem"></i>
                                        </div>
                                        <div class="reason-text">
                                            Giá Tour ưu đãi tốt nhất
                                        </div>
                                    </li>
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                            <i class="icon-reason chat-luong"></i>
                                        </div>
                                        <div class="reason-text">
                                            Đặt Tour dễ dàng nhanh chóng
                                        </div>
                                    </li>
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                            <i class="icon-reason chi-tiet"></i>
                                        </div>
                                        <div class="reason-text">
                                            Thanh toán an toàn, thuận tiện và linh hoạt
                                        </div>
                                    </li>
                                    <li class="reason-item">
                                        <div class="reason-icon">
                                            <i class="icon-reason tu-van"></i>
                                        </div>
                                        <div class="reason-text">
                                            Đội ngũ nhân viên tư vấn chuyên nghiệp, nhiệt tình và thân thiện
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.td-main-content-wrap -->

    <script type="text/javascript">
        function click_to_form(){
            jQuery('html,body').animate({
                scrollTop: jQuery('.summary.entry-summary').offset().top - 20 
            }, 500);
        }
        jQuery(document).ready(function(){
            jQuery('.footer-bar .single_add_to_cart_button').text(jQuery('form.cart .single_add_to_cart_button').text());
        });
    </script>

    <script>
        (function($) {
            $.fn.spinner = function() {
                this.each(function() {
                    var el = $(this);

                    // add elements
                    el.wrap('<span class="spinner"></span>');     
                    el.before('<span class="sub"><i class="fa fa-minus" aria-hidden="true"></i></span>');
                    el.after('<span class="add"><i class="fa fa-plus" aria-hidden="true"></i></span>');

                    var min = el.attr('min') ? parseInt(el.attr('min')) : 0;
                    var max = el.attr('max') ? parseInt(el.attr('max')) : 9999;

                    if(el.is(':disabled') != true){
                        // substract
                        el.parent().on('click', '.sub', function () {
                            if (el.val() > min)
                                el.val( function(i, oldval) { return --oldval; }).change();
                        });

                        // increment
                        el.parent().on('click', '.add', function () {
                            if (el.val() < max)
                                el.val( function(i, oldval) { return ++oldval; }).change();
                        });
                    }
                });
            };
        })(jQuery);

        jQuery('input[type=number]').spinner();
    </script>
<?php
get_footer();
?>