<?php
/*
    Our portfolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme!
    tagDiv - 2017
*/


/**
 * Load the speed booster framework + theme specific files
 */
define( 'NBD_THEME_PATH', get_template_directory() );
// load the deploy mode
require_once('td_deploy_mode.php');

// load the config
require_once('includes/td_config.php');
add_action('td_global_after', array('td_config', 'on_td_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


// load the wp booster
require_once('includes/wp_booster/td_wp_booster_functions.php');


require_once('includes/td_css_generator.php');
require_once('includes/shortcodes/td_misc_shortcodes.php');
require_once('includes/widgets/td_page_builder_widgets.php'); // widgets


/*
 * mobile theme css generator
 * in wp-admin the main theme is loaded and the mobile theme functions are not included
 * required in td_panel_data_source
 * @todo - look for a more elegant solution(ex. generate the css on request)
 */
require_once('mobile/includes/td_css_generator_mob.php');


/* ----------------------------------------------------------------------------
 * Woo Commerce
 */

// breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs');
function td_woocommerce_breadcrumbs() {
	return array(
		'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
		'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
		'wrap_after' => '</div>',
		'before' => '',
		'after' => '',
		'home' => _x('Home', 'breadcrumb', 'woocommerce'),
	);
}

// use own pagination
if (!function_exists('woocommerce_pagination')) {
	// pagination
	function woocommerce_pagination() {
		echo td_page_generator::get_pagination();
	}
}

// Override theme default specification for product 3 per row


// Number of product per page 8
add_filter('loop_shop_per_page', create_function('$cols', 'return 24;'));

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // 4 products per row
	}
}

if (!function_exists('woocommerce_output_related_products')) {
	// Number of related products
	function woocommerce_output_related_products() {
		woocommerce_related_products(array(
			'posts_per_page' => 4,
			'columns' => 2,
			'orderby' => 'rand',
		)); // Display 4 products in rows of 1
	}
}




/* ----------------------------------------------------------------------------
 * bbPress
 */
// change avatar size to 40px
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size) {
	$author_avatar = '';
	if ($size == 14) {
		$size = 40;
	}
	$topic_id = bbp_get_topic_id( $topic_id );
	if ( !empty( $topic_id ) ) {
		if ( !bbp_is_topic_anonymous( $topic_id ) ) {
			$author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
		} else {
			$author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
		}
	}
	return $author_avatar;
}
add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);



//add_action('shutdown', 'test_td');

function test_td () {
    if (!is_admin()){
        td_api_base::_debug_get_used_on_page_components();
    }

}


/**
 * tdStyleCustomizer.js is required
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    add_action('wp_footer', 'td_theme_style_footer');
		// new live theme demos
	    function td_theme_style_footer() {
			    ?>
			    <div id="td-theme-settings" class="td-live-theme-demos td-theme-settings-small">
				    <div class="td-skin-body">
					    <div class="td-skin-wrap">
						    <div class="td-skin-container td-skin-buy"><a target="_blank" href="http://themeforest.net/item/newspaper/5489609?ref=tagdiv">BUY NEWSPAPER NOW!</a></div>
						    <div class="td-skin-container td-skin-header">GET AN AWESOME START!</div>
						    <div class="td-skin-container td-skin-desc">With easy <span>ONE CLICK INSTALL</span> and fully customizable options, our demos are the best start you'll ever get!!</div>
						    <div class="td-skin-container td-skin-content">
							    <div class="td-demos-list">
								    <?php
								    $td_demo_names = array();

								    foreach (td_global::$demo_list as $demo_id => $stack_params) {
									    $td_demo_names[$stack_params['text']] = $demo_id;
									    ?>
									    <div class="td-set-theme-style"><a href="<?php echo td_global::$demo_list[$demo_id]['demo_url'] ?>" class="td-set-theme-style-link td-popup td-popup-<?php echo $td_demo_names[$stack_params['text']] ?>" data-img-url="<?php echo td_global::$get_template_directory_uri ?>/demos_popup/large/<?php echo $demo_id; ?>.jpg"><span></span></a></div>
								    <?php } ?>
									<div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty1"></a></div>
									<div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty2"></a></div>
								    <div class="clearfix"></div>
							    </div>
						    </div>
						    <div class="td-skin-scroll"><i class="td-icon-read-down"></i></div>
					    </div>
				    </div>
				    <div class="clearfix"></div>
				    <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide"></a></div>
				    <div class="td-screen-demo" data-width-preview="380"></div>
			    </div>
			    <?php
	    }

}

/*td_demo_state::update_state("art_creek", 'full');*/

/*print_r(td_global::$all_theme_panels_list);*/
function my_acf_init() {		acf_update_setting('google_api_key', 'AIzaSyBhyKmHVZvlHspdThfJQ31qX_WzeV623k4');}add_action('acf/init', 'my_acf_init');


/**
 * NghiaHoang function
 */
// add_filter( 'avatar_defaults', 'crunchifygravatar' ); 
// function crunchifygravatar ($avatar_defaults) {
//     $myavatar = get_bloginfo('template_directory') . '/images/avatar.jpg';
//     $avatar_defaults[$myavatar] = "Dichvuspa Avatar";
//     return $avatar_defaults;
// }



function add_persian_to_acf_google_map($api){
	$api['language'] = 'vi';
	return $api;
}
add_filter('acf/fields/google_map/api', 'add_persian_to_acf_google_map');

add_action( 'woocommerce_after_single_product_summary', 'add_review_product', 10 );
 
function add_review_product() {
    echo do_shortcode('[rwp_box id="-1"  template="review_service"]');
}
 
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );

function woo_custom_description_tab( $tabs ) {

	$tabs['description']['callback'] = 'woo_custom_description_tab_content';
    unset( $tabs['seller'] );
    unset( $tabs['more_seller_product'] );

	return $tabs;
}


// remove Empty Paragraphs
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);



add_filter( 'woocommerce_login_redirect', 'ckc_login_redirect', 10, 2 );
function ckc_login_redirect( $redirect_url, $user ) {
	// Change this to the url to Updates page
	if( $user->roles[0] == 'seller' ) {
		return dokan_get_navigation_url('dashboard');   
	}
	return $redirect_url;
}



// Add new tab in dokan dashboard
add_filter( 'dokan_query_var_filter', 'dokan_load_document_menu' );
function dokan_load_document_menu( $query_vars ) {
    $query_vars['store-info'] = 'store-info';
    $query_vars['forums']     = 'forums';
    return $query_vars;
}
add_filter( 'dokan_get_dashboard_nav', 'dokan_add_help_menu' );
function dokan_add_help_menu( $settings ) {
    // $settings['settings']['sub']['store-info'] = array(
    //     'title' => __( 'Thông tin', 'dokan'),
    //     'icon'  => '<i class="fa fa-address-card-o"></i>',
    //     'url'   => dokan_get_navigation_url( 'settings/store-info' ),
    //     'pos'   => 10
    // );
    $settings['store-info'] = array(
        'title' => __( 'Thông tin', 'dokan'),
        'icon'  => '<i class="fa fa-address-card-o"></i>',
        'url'   => dokan_get_navigation_url( 'store-info' ),
        'pos'   => 90
    );
    $settings['forums'] = array(
        'title' => __( 'Forums', 'bbpress'),
        'icon'  => '<i class="fa fa-comments"></i>',
        'url'   => dokan_get_navigation_url( 'forums' ),
        'pos'   => 60
    );
    return $settings;
}
add_action( 'dokan_load_custom_template', 'dokan_load_template' );
function dokan_load_template( $query_vars ) {
    if ( isset($query_vars['store-info']) ) {
        require_once dirname( __FILE__ ). '/dokan-dashboard-more.php';
    }
    if ( isset($query_vars['forums']) ) {
        require_once dirname( __FILE__ ). '/dokan-dashboard-forums.php';
    }
}




/*-- Add my Reviews --*/
function add_tab_endpoint() {
    add_rewrite_endpoint( 'danh-gia', EP_ROOT | EP_PAGES );
} 
add_action( 'init', 'add_tab_endpoint' );
 
function tab_query_vars( $vars ) {
    $vars[] = 'danh-gia';
    return $vars;
} 
add_filter( 'query_vars', 'tab_query_vars', 10 );
 
function add_tab_link_my_account( $items ) {
    unset( $items['downloads'] );
    $items['dashboard']       = __('Bảng tin');
    $items['orders']          = __('Đơn hàng');
    $items['edit-address']    = __('Địa chỉ');
    $items['payment-methods'] = __('Thanh toán');
    $items['edit-account']    = __('Thông tin tài khoản');
    $items['request-quote']   = __('Yêu cầu báo giá');
    $items['danh-gia']        = __('Đánh giá');
    $items['support']         = __('Hỗ trợ Ticket');
    $items['customer-logout'] = __('Đăng xuất');
    return $items;
} 
add_filter( 'woocommerce_account_menu_items', 'add_tab_link_my_account' );

function tab_content() {
	echo do_shortcode('[rwp_user_reviews user="'. get_current_user_id() .'" order="latest"]');
}
add_action( 'woocommerce_account_danh-gia_endpoint', 'tab_content' );



/**
 * Scripts Style in Your Profile
 */
function style_your_profile(){

    echo '<script type="text/javascript">jQuery(document).ready(function($) {

	//Auto set Rental Product is Product type default.
	// if($("#titlewrap input[name=post_title]").val() == ""){
	//   $("#product-type").val("redq_rental").change();
	//   $(".settings_options.settings_tab a").click();
	// }

	// $("form#your-profile > h2:first").remove(); // remove the "Personal Options" title  

	// $("form#your-profile tr.user-rich-editing-wrap").parent().parent().remove();

	$("table.form-table tr.wpas-after-reply-wrap").parent().parent().prev().remove();
	$("table.form-table tr.wpas-after-reply-wrap").parent().parent().remove();

	$("table.form-table tr.wpas-after-reply-wrap").parent().parent().prev().remove();
	$("table.form-table tr.wpas-after-reply-wrap").parent().parent().remove();
	  
	$("table.form-table tr.user-url-wrap").remove();// remove the "Website" field in the "Contact Info" section  
	$("table.form-table tr.user-googleplus-wrap").remove();  
	$("table.form-table tr.user-twitter-wrap").remove();  
	$("table.form-table tr.user-facebook-wrap").remove();  
	$("table.form-table tr.user-behance-wrap").remove();  
	$("table.form-table tr.user-blogger-wrap").remove();  
	$("table.form-table tr.user-delicious-wrap").remove();  
	$("table.form-table tr.user-deviantart-wrap").remove();  
	$("table.form-table tr.user-digg-wrap").remove();  
	$("table.form-table tr.user-dribbble-wrap").remove();  
	$("table.form-table tr.user-evernote-wrap").remove();  
	$("table.form-table tr.user-flickr-wrap").remove();  
	$("table.form-table tr.user-forrst-wrap").remove();  
	$("table.form-table tr.user-grooveshark-wrap").remove();  
	$("table.form-table tr.user-instagram-wrap").remove();  
	$("table.form-table tr.user-lastfm-wrap").remove();  
	$("table.form-table tr.user-linkedin-wrap").remove();  
	$("table.form-table tr.user-mail-1-wrap").remove();  
	$("table.form-table tr.user-myspace-wrap").remove();  
	$("table.form-table tr.user-path-wrap").remove();
	$("table.form-table tr.user-paypal-wrap").remove();  
	$("table.form-table tr.user-pinterest-wrap").remove();  
	$("table.form-table tr.user-reddit-wrap").remove();  
	$("table.form-table tr.user-rss-wrap").remove();  
	$("table.form-table tr.user-share-wrap").remove();  
	$("table.form-table tr.user-skype-wrap").remove();  
	$("table.form-table tr.user-soundcloud-wrap").remove();  
	$("table.form-table tr.user-spotify-wrap").remove();  
	$("table.form-table tr.user-stackoverflow-wrap").remove();  
	$("table.form-table tr.user-steam-wrap").remove();  
	$("table.form-table tr.user-stumbleupon-wrap").remove();  
	$("table.form-table tr.user-tumblr-wrap").remove();  
	$("table.form-table tr.user-vimeo-wrap").remove();  
	$("table.form-table tr.user-vk-wrap").remove();  
	$("table.form-table tr.user-windows-wrap").remove();  
	$("table.form-table tr.user-wordpress-wrap").remove();  
	$("table.form-table tr.user-yahoo-wrap").remove();  
	$("table.form-table tr.user-youtube-wrap").remove();

	$(".yoast.yoast-settings").remove(); 

	$(("#your-profile")).prepend(\'<ul id="navigation"></ul>\');

	// Style Your Profile
	$("#your-profile > .form-table").each(function(index) {
		title = $(this).prev();
		title.addClass("hndle");

		title_text = title.text();
		box_id = "metabox_"+ index;

		title.wrap( \'<div class="metabox-holder" id="metabox_\'+ index +\'"></div>\' ).wrap( \'<div class="postbox"></div>\' );
		$("#navigation").append(\'<li><a href="#\'+ box_id + \'">\'+ title_text +\'</a></li>\');

		$(this).appendTo("#"+ box_id +" .postbox");

	    $(this).wrap( \'<div class="inside"></div>\' ).wrap( \'<div class="main"></div>\' );
	});


	function fixDiv() {
	    var $cache = $("#navigation");
	    if ($(window).scrollTop() > 275)
	        $cache.css({
	            \'position\': \'fixed\',
	            \'top\': \'50px\',
	            \'right\': \'20px\'
	        });
	    else
	        $cache.css({
	            \'position\': \'\',
	            \'top\': \'\',
	            \'right\': \'\'
	        });
	}
	$(window).scroll(fixDiv);
	fixDiv();

	$(document).on("click", \'#navigation a[href^="#"]\', function(e) {
	    // target element id
	    var id = $(this).attr("href");

	    // target element
	    var $id = $(id);
	    if ($id.length === 0) {
	        return;
	    }

	    // prevent standard hash navigation (avoid blinking in IE)
	    e.preventDefault();

	    // top position relative to the document
	    var pos = $id.offset().top - 50;

	    // animated top scrolling
	    $("body, html").animate({scrollTop: pos});
	});

	function onScroll(event){
	    var scrollPos = $(document).scrollTop();
	    $("#navigation a").each(function () {
	        var currLink = $(this);
	        var refElement = $(currLink.attr("href"));
	        if ((refElement.position().top) <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	            $("#navigation a").removeClass("active");
	            currLink.addClass("active");
	        }
	        else{
	            currLink.removeClass("active");
	        }
	    });
	}
	onScroll();
	$(document).on("scroll", onScroll);


	});</script>'; 

	echo '<style>
	#wp-user-avatars-user-settings {border: 1px solid #e5e5e5;-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);background: #fff;}
	#wp-user-avatars-user-settings label {font-size: 13px;}
	#wp-user-avatars-user-settings br, #wp-user-avatars-user-settings .wp-user-avatar-rating-description, #wp-user-avatars-user-settings .fancy-hidden {display: none;}
	#wp-user-avatars-ratings fieldset {padding-left: 110px;}
	#wp-user-avatars-user-settings .wp-user-avatar-rating {margin-right: 15px;}
	#wp-user-avatars-user-settings h2 {font-size: 14px;padding: 8px 12px;margin: 0;line-height: 1.4;border-bottom: 1px solid #eee;}
	#wp-user-avatars-user-settings table {margin: 0;padding: 0;}
	#wp-user-avatars-user-settings th {display: none;}
	#wp-user-avatars-user-settings td {padding: 10px;}
	#wp-user-avatars-user-settings p.submit {margin: 0;padding: 10px;border-top: 1px solid #ddd;background-color: #f5f5f5;text-align: right;}

	#navigation{
		border: 1px solid #e5e5e5;
		-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
		background: #fff;
		z-index: 9;
		width: 250px;
		position: fixed;
		right: 0;
		top: 50px;
	}
	#navigation li{
		margin: 0;	
	}
	#navigation a{
		text-decoration: none;
		display: block;
		font-size: 14px;
		padding: 8px 12px;
		margin: 0;
		line-height: 1.4;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 35px;
	}
	#navigation li:last-child a{
		border-bottom: 0;
	}
	#navigation a:before{
		content: "\f341";
		font-family: dashicons;
		font-size: 20px;
		position: absolute;
		line-height: 36px;
		top: 0;
		left: 10px;
	}
	#navigation a.active{
		background-color: #efefef;
	}


	@media screen and (min-width: 1110px) {
	    #your-profile .metabox-holder {
			padding-right: 420px;
		}
	    #wp-user-avatars-user-settings {
			position: absolute;
			top: 0px;
			right: 0;
			width: 390px;
		}
	    #navigation{
			position: absolute;
			width: 390px;
			right: 0;
			top: 250px;
		}
	}
	</style>';
}
  
add_action('admin_head-user-edit.php','style_your_profile');
add_action('admin_head-profile.php','style_your_profile');


function show_nicename( $user ) {
	if (!current_user_can('edit_users')){
		return;
	}
	?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_nicename">User nicename</label></th>
            <td>
                <input type="text" name="user_nicename" id="user_nicename" value="<?php echo esc_attr($user->data->user_nicename); ?>" class="regular-text" /><br />
                <span class="description">Sẽ được sử dụng làm permalink</span>
            </td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'show_nicename' ); //show in my profile.php page
add_action( 'edit_user_profile', 'show_nicename' ); //show in my profile.php page
add_action( 'user_new_form', 'show_nicename' ); //to add the fields after the user-new.php form


function the_slug_exists($nicename) {
    global $wpdb;
    if($wpdb->get_row("SELECT user_nicename FROM wp_users WHERE user_nicename = '" . $nicename . "'", 'ARRAY_A')) {
        return true;
    } else {
        return false;
    }
}

function save_nicename( $user_id ) {
	if (!current_user_can('edit_users')){
		return;
	}

	$nicename = sanitize_title($_POST['user_nicename']);
	$user = get_user_by( 'ID', $user_id );
	if($nicename != $user->data->user_nicename ){
		if(!the_slug_exists($nicename))
	    	wp_update_user( array( 'ID' => $user_id, 'user_nicename' => $nicename ) );
	}
}
add_action( 'personal_options_update', 'save_nicename' ); //for profile page update
add_action( 'edit_user_profile_update', 'save_nicename' ); //for profile page update
add_action( 'user_register', 'save_nicename' ); //for user-new.php page new user addition



add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
    $cart_total = $woocommerce->cart->get_cart_total();
    ob_start(); ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'woocommerce' ); ?>">
    	<div class="cart-icon">
    		<i class="fa fa-shopping-bag" aria-hidden="true"></i>
    		<?php  if ( $count > 0 ) { ?><span class="cart-contents-count"><?php echo esc_html( $count ); ?></span><?php } ?>
    	</div>
    	<div class="cart-total"><?php // echo $cart_total; ?></div>
    	<div class="clearfix"></div>
    </a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

/* Remove page title woocommerce */
add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {return false;}


/* Change Free! to Custom text */
add_filter( 'woocommerce_variable_free_price_html', 'hide_free_price' );
add_filter( 'woocommerce_free_price_html', 'hide_free_price' );
add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price' );

function hide_free_price($price){
	return '<span class="amount">' . __( 'Liên hệ' ) . '</span>';
}


/* Change the placeholder image */
add_action( 'init', 'custom_fix_thumbnail' );
function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
	function custom_woocommerce_placeholder_img_src( $src ) {
	    $src = get_template_directory_uri().'/images/placeholder.jpg';
	    return $src;
	}
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields', 999999 ); 
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);

    $user = wp_get_current_user();
    $first_name = $user ? $user->user_firstname : '';
    $last_name = $user ? $user->user_lastname : '';
    $display_name = ($user && $user->display_name) ? $user->display_name : $last_name.' '.$first_name;

    $fields['billing']['billing_first_name']['label'] = 'Họ tên';
    $fields['billing']['billing_first_name']['placeholder'] = 'Nhập Họ và tên';
    $fields['billing']['billing_first_name']['value'] = $display_name;
    $fields['billing']['billing_first_name']['class'] = array('full-row');

	$fields['billing']['billing_email']['priority'] = 21;
	$fields['billing']['billing_phone']['priority'] = 22;

    return $fields;
}


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}


/**
 * Post filter
 */
$GLOBALS['tour_filter'] = [
	[
		'icon'      => 'fa fa-map-marker',
		'key'       => 'tinh_thanh',
		'compare'   => '='
	],
	// [
	// 	'icon'      => 'fa fa-leaf',
	// 	'key'       => 'loai_dich_vu',
	// 	'compare'   => '='
	// ],
	[
		'icon'      => 'fa fa-calendar',
		'key'       => 'duration',
		'compare'   => '='
	],
];

add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts( $query ) {
	$tour_filter = $GLOBALS['tour_filter'];

	if( !is_admin() && $query->is_main_query() && $query->is_tax('product_cat')) {
		$meta_query = array();

		foreach ($tour_filter as $meta) {
			$key = $meta['key'];
			$compare = $meta['compare'];

			if( $_GET[$key] ) {
				$meta_query[] = array(
					'key'       => $key,
					'value'     => urldecode($_GET[$key]),
					'compare'   => $compare,
				);
			}
		};

		if(count($meta_query) > 0){
			$query->set('meta_query', $meta_query);
		}
	}

	return;
}

// ---------------------------------------------
// Remove Cross Sells From Default Position  
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' ); 
function bbloomer_change_cross_sells_columns( $columns ) {return 4;}

add_filter( 'woocommerce_cross_sells_total', 'bbloomer_change_cross_sells_product_no' );  
function bbloomer_change_cross_sells_product_no( $columns ) {return 4;}

require_once( trailingslashit(get_template_directory()) . '/includes/change-quantity-on-checkout-woocommerce.php' );

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 30 );

add_filter( 'auto_update_plugin', '__return_false' );


add_action("template_redirect", 'redirect_checkout_if_cart_empty');
function redirect_checkout_if_cart_empty(){
    global $woocommerce;
    if( is_checkout() && WC()->cart->cart_contents_count == 0){
        wp_safe_redirect( get_permalink( woocommerce_get_page_id( 'shop' ) ) );
    }
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title',
    function() {
        echo woocommerce_get_product_thumbnail(array( 323, 219));
    },
    10
);


define( 'COMPANY_NAME', 'Pandora Việt Nam Travel' );

add_filter('autoptimize_filter_cachecheck_sendmail','__return_false');