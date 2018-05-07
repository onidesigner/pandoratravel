<?php
/**
 *  Dokan Dashboard Template
 *  @author  Onizuka Nghĩa
 */
?>
<?php acf_form_head(); ?>
<div class="dokan-dashboard-wrap">
    <?php
        /**
         *  dokan_dashboard_content_before hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_before' );
    ?>

    <div class="dokan-dashboard-content">

        <?php
            /**
             *  dokan_dashboard_content_before hook
             *
             *  @hooked show_seller_dashboard_notice
             *
             *  @since 2.4
             */
            do_action( 'dokan_help_content_inside_before' );
        ?>

        <article class="help-content-area">
      <?php 
            $current_user = wp_get_current_user();
        
            $options = array(
                'post_id' => 'user_'.$current_user->ID,
                'field_groups' => array(2326),
                'form' => true, 
                'return' => add_query_arg( 'updated', 'true', dokan_get_navigation_url( 'store-info' ) ), 
                'html_before_fields' => '',
                'html_after_fields' => '',
                'submit_value' => 'Update' 
            );
            acf_form( $options );
        ?>

        </article><!-- .dashboard-content-area -->

         <?php
            /**
             *  dokan_dashboard_content_inside_after hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_inside_after' );
        ?>


    </div><!-- .dokan-dashboard-content -->

    <?php
        /**
         *  dokan_dashboard_content_after hook
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_after' );
    ?>

</div><!-- .dokan-dashboard-wrap -->