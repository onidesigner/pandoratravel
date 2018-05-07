<div class="td-container-wrap request-form-wrap">
    <div class="td-container">
        <img class="vn_girl" src="<?php echo get_template_directory_uri(); ?>/images/vn_girl_customer.png"/>
        <div class="td-pb-row">
            <div class="td-pb-span8">
                <div class="request-info">
                    <h2>Tư vấn 24/7 mọi thông tin về voucher</h2>
                    <div class="td-pb-row">
                        <div class="td-pb-span6">
                            <div class="hotline-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="tel:+842462752228"><strong>024.6275.2228</strong><p>(Điện thoại)</p></a>
                            </div>
                        </div>
                        <div class="td-pb-span6">
                            <div class="hotline-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="tel:+84968081384"><strong>096.808.1384</strong><p>(Hotline)</p></a>
                            </div>
                        </div>
                    </div>

                    <address>
                        Cty CP Dịch Vụ Và Giải Pháp Doanh Nghiệp Pandora Việt Nam<br/>
                        MST: 0107729564 - Cấp bởi SKHDT Hà Nội<br/>
                        VPGD: P.2102 - M3MB khu B, 91 Nguyễn Chí Thanh, Đống Đa, HN<br/>
                        Email: travel@pandoravietnam.com
                    </address>
                </div>
            </div>
            <div class="td-pb-span4">
                <div class="request-form">
                    <h2>Yêu Cầu Tư Vấn Du Lịch</h2>
                    <?php echo do_shortcode('[contact-form-7 id="4296" title="Yêu cầu đặt voucher"]');?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Instagram -->

<?php if (td_util::get_option('tds_footer_instagram') == 'show') { ?>

<div class="td-main-content-wrap td-footer-instagram-container td-container-wrap <?php echo td_util::get_option('td_full_footer_instagram'); ?>">
    <?php
    //get the instagram id from the panel
    $tds_footer_instagram_id = td_instagram::strip_instagram_user(td_util::get_option('tds_footer_instagram_id'));
    ?>

    <div class="td-instagram-user">
        <h4 class="td-footer-instagram-title">
            <?php echo  __td('Follow us on Instagram', TD_THEME_NAME); ?>
            <a class="td-footer-instagram-user-link" href="https://www.instagram.com/<?php echo $tds_footer_instagram_id ?>" target="_blank">@<?php echo $tds_footer_instagram_id ?></a>
        </h4>
    </div>

    <?php
    //get the other panel seetings
    $tds_footer_instagram_nr_of_row_images = intval(td_util::get_option('tds_footer_instagram_on_row_images_number'));
    $tds_footer_instagram_nr_of_rows = intval(td_util::get_option('tds_footer_instagram_rows_number'));
    $tds_footer_instagram_img_gap = td_util::get_option('tds_footer_instagram_image_gap');
    $tds_footer_instagram_header = td_util::get_option('tds_footer_instagram_header_section');

    //show the insta block
    echo td_global_blocks::get_instance('td_block_instagram')->render(
        array(
            'instagram_id' => $tds_footer_instagram_id,
            'instagram_header' => /*td_util::get_option('tds_footer_instagram_header_section')*/ 1,
            'instagram_images_per_row' => $tds_footer_instagram_nr_of_row_images,
            'instagram_number_of_rows' => $tds_footer_instagram_nr_of_rows,
            'instagram_margin' => $tds_footer_instagram_img_gap
        )
    );

    ?>
</div>

<?php } ?>


<!-- Footer -->
<?php
if (td_util::get_option('tds_footer') != 'no') {
    td_api_footer_template::_helper_show_footer();
}
?>


<!-- Sub Footer -->
<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-container td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span td-sub-footer-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'=> 'td-subfooter-menu',
                            'fallback_cb' => 'td_wp_footer_menu'
                        ));

                        //if no menu
                        function td_wp_footer_menu() {
                            //do nothing?
                        }
                        ?>
                </div>

                <div class="td-pb-span td-sub-footer-copy">
                    <?php
                    $tds_footer_copyright = stripslashes(td_util::get_option('tds_footer_copyright'));
                    $tds_footer_copy_symbol = td_util::get_option('tds_footer_copy_symbol');

                    //show copyright symbol
                    if ($tds_footer_copy_symbol == '') {
                        echo '&copy; ';
                    }

                    echo $tds_footer_copyright;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

<script type="text/javascript">
    (function() {
        var p = jQuery('.product .woocommerce-loop-product__title, .product .td-module-title a');
        var h = 38;
        p.each( function( index, element ){
            while (jQuery(this).outerHeight() > h) {
                jQuery(this).text(function (index, text) {
                    return text.replace(/\W*\s(\S)*$/, '...');
                });
            }
        });
    }(jQuery));
</script>
</body>
</html>