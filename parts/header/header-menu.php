<div id="td-header-menu" role="navigation">
    <div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>
    <div class="td-main-menu-logo td-logo-in-header">
        <?php
        if (td_util::get_option('tds_logo_menu_upload') == '') {
            locate_template('parts/header/logo.php', true, false);
        } else {
            locate_template('parts/header/logo-mobile.php', true, false);
        }?>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'menu_class'=> 'sf-menu',
        'fallback_cb' => 'td_wp_page_menu',
        'walker' => new td_tagdiv_walker_nav_menu()
    ));


    //if no menu
    function td_wp_page_menu() {
        //this is the default menu
        echo '<ul class="sf-menu">';
        echo '<li class="menu-item-first"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
        echo '</ul>';
    }
    ?>
</div>