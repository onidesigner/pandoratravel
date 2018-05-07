<?php
/**
 *  Dokan Vendor
 *  @author  Onizuka Nghĩa
 */

global $product;

$author_id  = get_post_field( 'post_author', $product->get_id() );
$author     = get_user_by( 'id', $author_id );
$store_info = dokan_get_store_info( $author->ID );


$style = "";
if ( isset( $store_info['banner'] ) && !empty( $store_info['banner'] ) ) {
    $style .= 'background-image: url('. wp_get_attachment_url( $store_info['banner'] ) .');';
}
if ( !empty( $store_info['store_name'] ) ) $store_name = $store_info['store_name'];
else $store_name = $author->display_name;

$users_rating = RWP_API::get_reviews_box_users_rating( get_the_ID(), -1, 'review_service', true );
$total_score = 0;
?>
            <div class="card hovercard">
                <div class="cardheader" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/cover_user.jpg');"></div>
                <img alt="Pandora Spa & Retreat" src="<?php echo get_template_directory_uri(); ?>/images/avatar_user.jpg" class="avatar photo" height="150" width="150">
                <div class="info">
                    <div class="title">
                        <a>Pandora Việt Nam Travel</a>
                    </div>
                    <div class="contacts">
                        <p class="contact">
                            <i class="fa fa-phone" aria-hidden="true"></i> Điện thoại: <a href="tel:02462752228">024.6275.2228</a>
                        </p>
                        <p class="contact">
                            <i class="fa fa-mobile" aria-hidden="true"></i> Hotline: <a href="tel:0968081384">096.808.1384</a>
                        </p>
                        <p class="contact">
                            <i class="fa fa-envelope" aria-hidden="true"></i> Email: <a href="mailto:travel@pandoravietnam.com">travel@pandoravietnam.com</a>
                        </p>
                    </div>
                </div>
                <div class="contacts contact-request">
                    <p class="title">Yêu cầu liên hệ</p>
                    <p><center>Hoặc để lại số điện thoại - email, <br/>chúng tôi sẽ liên hệ cho bạn</center></p>
                    <?php echo do_shortcode('[contact-form-7 id="6786" title="Yêu cầu liên hệ"]'); ?>
                </div>
            </div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var error = false;

    $('.modal-call.contact-request-btn').click(function(e){
        if($('input[name=your-contact]').val() == ''){
            alert('Lỗi, Vui lòng nhập số điện thoại hoặc email của bạn...');
            error = true;
        }else{
            error = false;
        }
    });
    $('.modal-call').each(function() {
        var modal = $($(this).attr('href'));
        var btn = $(this);
        var span = modal.find(".modal-close");

        // When the user clicks the button, open the modal 
        btn.click(function() {
            if((typeof error == 'undefined') || ((typeof error !== 'undefined')  && !error)) {
                modal.css('display','block');
            }
        });

        // When the user clicks on <span> (x), close the modal
        span.click(function() {
            modal.css('display','none');
        })

        // When the user clicks anywhere outside of the modal, close it
        $(window).click(function(event) {
            if (event.target == modal) {
                modal.css('display','none');
            }
        })
    });


    var wpcf7Elm = document.querySelector( '.wpcf7' );
 
    wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
        $($('.modal-call.contact-request-btn').attr('href')).css('display','none');

        setTimeout(function() {
            $('div.wpcf7-response-output').fadeOut('fast');
        }, 2000);
    }, false );

});
</script>
