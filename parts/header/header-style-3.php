<!--
Header style 3
-->

<div class="td-header-wrap td-header-style-3">

    <div class="td-header-top-menu-full td-container-wrap <?php echo td_util::get_option('td_full_top_bar'); ?>">
        <div class="td-container td-header-row td-header-top-menu">
            <?php td_api_top_bar_template::_helper_show_top_bar() ?>
        </div>
    </div>

    <div class="td-banner-wrap-full td-container-wrap <?php echo td_util::get_option('td_full_header'); ?>">
        <div class="td-container td-header-row td-header-header">
            <div class="td-pb-row">
                <div class="td-pb-span3">
                    <div class="td-header-sp-logo">
                        <?php locate_template('parts/header/logo-h1.php', true);?>
                    </div>                    
                </div>
                <div class="td-pb-span6">
                    <div class="header-search-wrap">
                        <div class="header-search">
                            <?php echo do_shortcode('[wd_asp id=1]'); ?>
                        </div>
                        <a id="td-header-search-button-mob" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
                    </div>
                </div>
                <div class="td-pb-span3">
                    <div class="td-header-profile">
                    <?php 
                        //show login widget
                        if (td_util::get_option('tds_login_sign_in_widget') == 'show') {
                            //test if user is logd in or not
                            $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
                            
                            if ( is_user_logged_in() ) {
                                //get current logd in user data
                                global $current_user;
                                
                                if ( !dokan_is_user_customer( $current_user->ID ) ) {
                                    $user_url = dokan_get_navigation_url();
                                }

                                //<span class="td-sp-ico-logout"></span>
                                echo '<div class="my-profile"><a href="' . $user_url . '" class="td_user_logd_in">' .
                                                get_avatar($current_user->ID, 36) . 'Hi, ' . $current_user->display_name . '</a></div>';
                            }else{
                                echo '<div class="my-profile"><a href="' . $user_url . '" class="td_user_logd_in">' .
                                                get_avatar($current_user->ID, 36) . 'Hi, Khách</a></div>';
                            }
                        }
                    ?>
                    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
                        $count = WC()->cart->cart_contents_count;
                        $cart_total = WC()->cart->get_cart_total(); ?>
                        <div class="my-cart">
                            <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'woocommerce' ); ?>">
                                <div class="cart-icon">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <?php  if ( $count > 0 ) { ?><span class="cart-contents-count"><?php echo esc_html( $count ); ?></span><?php } ?>
                                </div>
                                <div class="cart-total"><?php // echo $cart_total; ?></div>
                                <div class="clearfix"></div>
                            </a>
                        </div> 
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="td-header-menu-wrap-full td-container-wrap <?php echo td_util::get_option('td_full_menu'); ?>">
        <div class="td-header-menu-wrap">
            <div class="td-container td-header-row td-header-main-menu black-menu">
                <?php locate_template('parts/header/header-menu.php', true);?>
            </div>
        </div>
    </div>

    <div class="header-sliderBG bg-1" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_slider1.jpg');"></div>
    <div class="header-sliderBG bg-2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_slider2.jpg');"></div>
    <div class="header-sliderBG bg-3" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_slider3.jpg');"></div>

</div>