<?php
$store_user    = get_userdata( get_query_var( 'author' ) );
$store_info    = dokan_get_store_info( $store_user->ID );
$store_tabs    = dokan_get_store_tabs( $store_user->ID );
$social_fields = dokan_get_social_profile_fields();

$dokan_appearance = get_option( 'dokan_appearance' );
$profile_layout = empty( $dokan_appearance['store_header_template'] ) ? 'default' : $dokan_appearance['store_header_template'];
$store_address = dokan_get_seller_short_address( $store_user->ID, false );

$general_settings = get_option( 'dokan_general', [] );
$banner_width = ! empty( $general_settings['store_banner_width'] ) ? $general_settings['store_banner_width'] : 625;

if ( ( 'default' === $profile_layout ) || ( 'layout2' === $profile_layout ) ) {
    $profile_img_class = 'profile-img-circle';
} else {
    $profile_img_class = 'profile-img-square';
}

if ( 'layout3' === $profile_layout ) {
    unset( $store_info['banner'] );

    $no_banner_class = ' profile-frame-no-banner';
    $no_banner_class_tabs = ' dokan-store-tabs-no-banner';

} else {
    $no_banner_class = '';
    $no_banner_class_tabs = '';
}

?>
<div class="profile-frame<?php echo $no_banner_class; ?>">

    <div class="profile-info-box profile-layout-<?php echo $profile_layout; ?>">
        <?php if ( isset( $store_info['banner'] ) && !empty( $store_info['banner'] ) ) { ?>
            <img src="<?php echo wp_get_attachment_url( $store_info['banner'] ); ?>"
                 alt="<?php echo isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : ''; ?>"
                 title="<?php echo isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : ''; ?>"
                 class="profile-info-img">
        <?php } else { ?>
            <div class="profile-info-img dummy-image">&nbsp;</div>
        <?php } ?>

        <div class="profile-info-summery-wrapper dokan-clearfix">
            <div class="profile-info-summery">
                <div class="profile-info-head">
                    <div class="profile-img <?php echo $profile_img_class; ?>">
                        <?php echo get_avatar( $store_user->ID, 150 ); ?>
                    </div>
                    <?php if ( isset( $store_info['store_name'] ) && 'default' === $profile_layout ) { ?>
                        <h1 class="store-name"><?php echo esc_html( $store_info['store_name'] ); ?></h1>
                    <?php } ?>
                </div>

                <div class="profile-info">
                    <?php if ( isset( $store_info['store_name'] ) && 'default' !== $profile_layout ) { ?>
                        <h1 class="store-name"><?php echo esc_html( $store_info['store_name'] ); ?></h1>
                    <?php } ?>

                    <ul class="dokan-store-info">
                        <?php if ( isset( $store_address ) && !empty( $store_address ) ) { ?>
                            <li class="dokan-store-address"><i class="fa fa-map-marker"></i>
                                <?php echo $store_address; ?>
                            </li>
                        <?php } ?>

                        <?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
                            <li class="dokan-store-phone">
                                <i class="fa fa-mobile"></i>
                                <a href="tel:<?php echo esc_html( $store_info['phone'] ); ?>"><?php echo esc_html( $store_info['phone'] ); ?></a>
                            </li>
                        <?php } ?>

                        <?php if ( isset( $store_info['show_email'] ) && $store_info['show_email'] == 'yes' ) { ?>
                            <li class="dokan-store-email">
                                <i class="fa fa-envelope-o"></i>
                                <a href="mailto:<?php echo antispambot( $store_user->user_email ); ?>"><?php echo antispambot( $store_user->user_email ); ?></a>
                            </li>
                        <?php } ?>

                        <li class="dokan-store-rating">
                            <i class="fa fa-star"></i>
                            <?php dokan_get_readable_seller_rating( $store_user->ID ); ?>
                        </li>
                    </ul>

                    <?php if ( $social_fields ) { ?>
                        <div class="store-social-wrapper">
                            <ul class="store-social">
                                <?php foreach( $social_fields as $key => $field ) { ?>
                                    <?php if ( isset( $store_info['social'][ $key ] ) && !empty( $store_info['social'][ $key ] ) ) { ?>
                                        <li>
                                            <a href="<?php echo esc_url( $store_info['social'][ $key ] ); ?>" target="_blank"><i class="fa fa-<?php echo $field['icon']; ?>"></i></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>

<!-- ACF information -->
<?php
 $user_id = $store_user->ID;

// Define prefixed user ID
$user_acf_prefix = 'user_';
$user_id_prefixed = $user_acf_prefix . $user_id;
?>


<?php $field = get_field_object('loai_kinh_doanh', $user_id_prefixed); ?>
<?php if($field['value'] != ''): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
			<?php the_field( 'loai_kinh_doanh', $user_id_prefixed ) ?>
		</div>					
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'dich_vu_spa', $user_id_prefixed ); 
$field_array = get_field( 'dich_vu_spa', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'dich_vu_tham_my', $user_id_prefixed ); 
$field_array = get_field( 'dich_vu_tham_my', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'nang_mui', $user_id_prefixed ); 
$field_array = get_field( 'nang_mui', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'tham_my_mat', $user_id_prefixed ); 
$field_array = get_field( 'tham_my_mat', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'tham_my_ham_mat', $user_id_prefixed ); 
$field_array = get_field( 'tham_my_ham_mat', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'tham_my_nguc', $user_id_prefixed ); 
$field_array = get_field( 'tham_my_nguc', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'hut_mo', $user_id_prefixed ); 
$field_array = get_field( 'hut_mo', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>


<?php $field = get_field_object( 'hut_mo_copy', $user_id_prefixed ); 
$field_array = get_field( 'hut_mo_copy', $user_id_prefixed );
if ( $field_array ): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
            <ul>
            <?php foreach ( $field_array as $item ):
				echo '<li>'.$item.'</li>';
			endforeach; ?>   
			</ul>
        </div>				
	</div>
<?php endif; ?>

<?php $field = get_field_object('lich_su', $user_id_prefixed); ?>
<?php if($field['value'] != ''): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
			<?php the_field( 'lich_su', $user_id_prefixed ) ?>
		</div>					
	</div>
<?php endif; ?>

<?php $field = get_field_object('nhan_su', $user_id_prefixed); ?>
<?php if($field['value'] != ''): ?>
<div class="nbd-field">
	<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
		<div class="nbd-field-content">
			<?php the_field( 'nhan_su', $user_id_prefixed ) ?>
		</div>					
	</div>
<?php endif; ?>

<?php $field = get_field_object( 'thong_tin_khac', $user_id_prefixed ); ?>
<?php if( have_rows('thong_tin_khac') ): ?>
	<div class="nbd-field">
		<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>					
		<div class="nbd-field-content">
		<?php while ( have_rows('thong_tin_khac') ) : the_row(); ?>
			<div>
				<strong><?php the_sub_field('tieu_de');?></strong>
				<div><?php the_sub_field('noi_dung'); ?></div>
			</div>
		<?php endwhile; ?>
		</div>					
	</div>
<?php endif; ?>


<?php 

$images = get_field('thu_vien_anh', $user_id_prefixed);

if( $images ): $i = 0; ?>
<div class="msacwl-slider-wrap msacwl-row-clearfix">
    <div id="msacwl-slider-1" class="msacwl-slider msacwl-design-12 msacwl-slider-popup" data-slider-nav-for='msacwl-slider-nav-1'>
        <div class="msacwl-gallery-slider msacwl-common-slider">
        <?php foreach( $images as $image ): $i++; ?>
            <div class="msacwl-slide" data-item-index="<?php echo $i; ?>">
                <div class="msacwl-img-wrap" style='height:450px;'>
                    <a class="msacwl-img-link" href="<?php echo $image['url']; ?>"></a>
                    <img class="msacwl-img" src="<?php echo $image['url']; ?>" title="<?php echo $image['alt']; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
                <?php if($image['caption']): ?>
                <div class="msacwl-image-title"><?php echo $image['caption']; ?></div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="msacwl-slider-conf">{&quot;autoplay&quot;:&quot;true&quot;,&quot;autoplay_speed&quot;:&quot;3000&quot;,&quot;speed&quot;:&quot;300&quot;,&quot;arrows&quot;:&quot;true&quot;,&quot;dots&quot;:&quot;false&quot;,&quot;loop&quot;:&quot;true&quot;,&quot;nav_slide_column&quot;:&quot;7&quot;}</div>
    </div>

    <div class="msacwl-slider-nav-1 msacwl-slider-nav design-12">
        <?php foreach( $images as $image ): ?>
        <div class="slick-image-nav">
            <img class="msacwl-slider-nav-img" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<script type='text/javascript' src='<?php echo WP_IGSP_PRO_URL ?>assets/js/jquery.magnific-popup.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='<?php echo WP_IGSP_PRO_URL ?>assets/js/slick.min.js?ver=1.2.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var WpIsgp = {"is_mobile":"0","is_rtl":"0"};
/* ]]> */
</script>
<script type='text/javascript' src='<?php echo WP_IGSP_PRO_URL ?>assets/js/wp-igsp-pro-public.js?ver=1.2.1'></script>

<!-- ACF information -->

                </div> <!-- .profile-info -->
            </div><!-- .profile-info-summery -->
        </div><!-- .profile-info-summery-wrapper -->
    </div> <!-- .profile-info-box -->
</div> <!-- .profile-frame -->

<?php if ( $store_tabs ) { ?>
    <div class="dokan-store-tabs<?php echo $no_banner_class_tabs; ?>">
        <ul class="dokan-list-inline">
            <?php foreach( $store_tabs as $key => $tab ) { ?>
                <li><a href="<?php echo esc_url( $tab['url'] ); ?>"><?php echo $tab['title']; ?></a></li>
            <?php } ?>
            <?php do_action( 'dokan_after_store_tabs', $store_user->ID ); ?>
        </ul>
    </div>
<?php } ?>