<?php
/**
 *  Dokan Dashboard Template
 *  @author  Onizuka Nghĩa
 */
?>
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
            <header class="dokan-dashboard-header">
                <h1 class="entry-title">Diễn đàn hỗ trợ</h1>
            </header>
            <div class="dokan-report-wrap">
                <ul class="dokan_tabs">
                    <li class="
                            <?php if(( isset($_GET["view"]) && $_GET["view"] == 'topics' ) || empty($_GET["view"])){ echo 'active'; } ?>                            
                            ">
                        <a href="<?php echo dokan_get_navigation_url( 'forums' ); ?>?view=topics"><?php _e( 'Topics Started', 'bbpress' ); ?></a>
                    </li>
                    <li class="
                            <?php if( isset($_GET["view"]) && $_GET["view"] == 'replies' ){ echo 'active'; } ?>                            
                            ">
                        <a href="<?php echo dokan_get_navigation_url( 'forums' ); ?>?view=replies"><?php _e( 'Replies Created', 'bbpress' ); ?></a>
                    </li>
                </ul>

                <div id="dokan_tabs_container">
                    <div class="tab-pane active" id="home">
                        <div id="bbpress-forums" class="dokan-reports-wrap">
                            <?php if(( isset($_GET["view"]) && $_GET["view"] == 'topics' ) || empty($_GET["view"])){ ?>
                            <div id="bbp-user-topics-started">
                                <div class="bbp-user-section">
                                    <?php if ( bbp_get_user_topics_started( get_current_user_id(), 'topics-created') ) : ?>
                                        <?php bbp_get_template_part( 'bbpress/pagination', 'topics' ); ?>
                                        <?php bbp_get_template_part( 'bbpress/loop', 'topics' ); ?>
                                    <?php else : ?>
                                        <p><?php bbp_is_user_home() ? _e( 'You have not created any topics.', 'bbpress' ) : _e( 'This user has not created any topics.', 'bbpress' ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php }else if( isset($_GET["view"]) && $_GET["view"] == 'replies' ){ ?>
                            <div id="bbp-user-replies-started">
                                <div class="bbp-user-section">
                                    <?php if ( bbp_get_user_replies_created( get_current_user_id(), 'replies-created') ) : ?>
                                        <?php bbp_get_template_part( 'bbpress/pagination', 'replies' ); ?>
                                        <?php bbp_get_template_part( 'bbpress/loop', 'replies' ); ?>
                                    <?php else : ?>
                                        <p><?php bbp_is_user_home() ? _e( 'You have not created any topics.', 'bbpress' ) : _e( 'This user has not created any topics.', 'bbpress' ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
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