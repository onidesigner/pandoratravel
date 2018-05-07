<?php
/**
 * Dokan Seller registration form
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<div class="show_if_seller"<?php echo $role_style; ?>>

    <div class="split-row form-row-wide">
        <p class="form-row form-group">
            <input type="text" class="input-text form-control" name="fname" id="first-name" value="<?php if ( ! empty( $postdata['fname'] ) ) echo esc_attr($postdata['fname']); ?>" required="required" placeholder="<?php _e( 'First Name', 'dokan-lite' ); ?>"/>
        </p>

        <p class="form-row form-group">
            <input type="text" class="input-text form-control" name="lname" id="last-name" value="<?php if ( ! empty( $postdata['lname'] ) ) echo esc_attr($postdata['lname']); ?>" required="required" placeholder="<?php _e( 'Last Name', 'dokan-lite' ); ?>" />
        </p>
    </div>

    <p class="form-row form-group form-row-wide">
        <input type="text" class="input-text form-control" name="shopname" id="company-name" value="<?php if ( ! empty( $postdata['shopname'] ) ) echo esc_attr($postdata['shopname']); ?>" required="required" placeholder="<?php _e( 'Shop Name', 'dokan-lite' ); ?>" />
    </p>

    <p class="form-row form-group form-row-wide">
        <strong id="url-alart-mgs" class="pull-right"></strong>
        <input type="text" class="input-text form-control" name="shopurl" id="seller-url" value="<?php if ( ! empty( $postdata['shopurl'] ) ) echo esc_attr($postdata['shopurl']); ?>" required="required" placeholder="<?php _e( 'Shop URL', 'dokan-lite' ); ?>" />
        <small><?php echo home_url() . '/' . dokan_get_option( 'custom_store_url', 'dokan_general', 'store' ); ?>/<strong id="url-alart"></strong></small>
    </p>

    <p class="form-row form-group form-row-wide">
        <input type="text" class="input-text form-control" name="phone" id="shop-phone" value="<?php if ( ! empty( $postdata['phone'] ) ) echo esc_attr($postdata['phone']); ?>" required="required" placeholder="<?php _e( 'Phone Number', 'dokan-lite' ); ?>" />
    </p>
    <?php 
        
        $show_toc = dokan_get_option( 'enable_tc_on_reg', 'dokan_general' );
        
        if ( $show_toc == 'on' ) {
            $toc_page_id = dokan_get_option( 'reg_tc_page', 'dokan_pages' );
            if ( $toc_page_id != -1 ) {
                $toc_page_url = get_permalink( $toc_page_id );
    ?>
            <p class="form-row form-group form-row-wide">
                <input class="tc_check_box" type="checkbox" id="tc_agree" name="tc_agree" required="required">
                <label style="display: inline" for="tc_agree"><?php echo sprintf( __( 'I have read and agree to the <a target="_blank" href="%s">Terms &amp; Conditions</a>.', 'dokan-lite' ), $toc_page_url ); ?></label>
            </p>    
            <?php } ?>
        <?php } ?>
    <?php  do_action( 'dokan_seller_registration_field_after' ); ?>

</div>

<?php do_action( 'dokan_reg_form_field' ); ?>

<p class="form-row form-group user-role">
        <span class="radio radio-inline td-pb-span6">
            <input type="radio" name="role" id="customer" value="customer"<?php checked( $role, 'customer' ); ?>>
            <label for="customer"><?php _e( 'I am a customer', 'dokan-lite' ); ?></label>
        </span>
        <span class="radio radio-inline td-pb-span6">
            <input type="radio" name="role" id="seller" value="seller"<?php checked( $role, 'seller' ); ?>>
            <label for="seller"><?php _e( 'I am a vendor', 'dokan-lite' ); ?></label>
        </span>
    <?php do_action( 'dokan_registration_form_role', $role ); ?>
</p>
