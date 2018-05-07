<div class="td-footer-wrapper td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
    <div class="td-container">

	    <div class="td-pb-row">
		    <div class="td-pb-span12">
			    <?php
                $tds_footer_top_title = td_util::get_option('tds_footer_top_title');
			    // ad spot
			    echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'footer_top', 'spot_title' => $tds_footer_top_title));
			    ?>
		    </div>
	    </div>

        <div class="td-pb-row">

            <div class="td-pb-span4">
                <?php
                td_global::vc_set_custom_column_number(1);

                echo td_global_blocks::get_instance('td_block_7')->render(array(
                    'custom_title' => __td('SẢN PHẨM MỚI NHẤT', TD_THEME_NAME),
                    'limit' => 3,
                    'installed_post_types' => 'product'
                ));
                ?>
                <?php dynamic_sidebar('Footer 1'); ?>
            </div>

            <div class="td-pb-span4">
                <?php
                td_global::vc_set_custom_column_number(1);

                echo td_global_blocks::get_instance('td_block_7')->render(array(
                    'custom_title' => __td('SẢN PHẨM PHỔ BIẾN', TD_THEME_NAME),
                    'limit' => 3,
                    'sort' => 'popular',
                    'installed_post_types' => 'product'
                ));
                ?>
                <?php dynamic_sidebar('Footer 2'); ?>
            </div>

            <div class="td-pb-span4">
                <?php
                td_global::vc_set_custom_column_number(1);

                echo td_global_blocks::get_instance('td_block_popular_categories')->render(array(
                    'custom_title' => __td('POPULAR CATEGORY', TD_THEME_NAME),
                    'taxonomy'   =>  'product_cat',
                    'include'   =>  '576,856,853,863,854,855,857',
                    'limit' => 9,
                    'after_html' => '<li><a href="http://dulichpandora.com/ve-may-bay-gia-re/">Vé máy bay giá rẻ</a></li>',
                ));
                ?>
                <?php dynamic_sidebar('Footer 3'); ?>
            </div>
        </div>
    </div>
    <div class="td-footer-bottom-full">
        <div class="td-container">
            <div class="td-pb-row">
                <?php locate_template('parts/footer/td_footer_extra_bottom.php', true); ?>
            </div>
        </div>
    </div>
</div>