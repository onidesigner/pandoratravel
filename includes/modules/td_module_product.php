<?php

class td_module_product extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();

        $product = wc_get_product( $this->post->ID );

        $author_id  = get_post_field( 'post_author', $this->post->ID );
        $author     = get_user_by( 'id', $author_id );
        $store_info = dokan_get_store_info( $author_id );

        if ( !empty( $store_info['store_name'] ) ) $store_name = $store_info['store_name'];
        else $store_name = $author->display_name; 

        // Review
        $total_score = 0;
        $users_rating = RWP_API::get_reviews_box_users_rating( $this->post->ID, -1, 'review_service', true );
        foreach ($users_rating['scores'] as $scores) {
            $total_score = $total_score + $scores['score'];
        }
        $final_score = $total_score/count($users_rating['scores']);

        // Flash sale
        $regular = $product->get_regular_price();
        $sale = $product->get_sale_price();

        $duration = get_field('duration', $this->post->ID);
        $time_duration = get_field('time_duration', $this->post->ID) ? get_field('time_duration', $this->post->ID) : 0;
        $number_of_day = get_field('number_of_day', $this->post->ID) ? get_field('number_of_day', $this->post->ID) : 0;
        $number_of_night = get_field('number_of_night', $this->post->ID) ? get_field('number_of_night', $this->post->ID) : 0;

        $tinh_thanh_field = get_field_object('tinh_thanh', $this->post->ID);
        $tinh_thanh_value = $tinh_thanh_field['value'];
        $tinh_thanh_label = $tinh_thanh_field['choices'][ $tinh_thanh_value ];

        ?>

        <div class="product <?php echo $this->get_module_classes();?>">
            <div class="td-module-image">
                <div class="sale-flash">

                <?php if ( $product->is_on_sale() ) :

                    $percent = round(($regular - $sale) / $regular * 100);
                    $text = $regular > $sale ? '-' : '+';

                    if($percent > 0)
                        echo '<span class="onsale">'. $text . $percent .'%</span>';

                endif; ?>

                <?php if($duration) :

                    if($duration == 'one_day')
                        echo '<span class="duration">'. $time_duration.' giờ</span>';

                    if($duration == 'multiple_day')
                        echo '<span class="duration">'. $number_of_day.'N'. $number_of_night .'Đ</span>';

                endif; ?>

                </div>

                <?php echo $this->get_image('td_324x235');?>
                
                <?php /*--- Vender Avatar
                <div class="vendor-avatar">
                    <?php echo get_avatar( $author_id, 70, '', $store_name); ?>
                </div> */ ?>
           
                <div class="td-module-meta-info-top">
                    <?php if($tinh_thanh_value != ''){ ?>
                    <div class="locale">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $tinh_thanh_label ? $tinh_thanh_label : $tinh_thanh_value; ?> 
                    </div>
                    <?php } ?>
                    <div class="views">
                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo td_page_views::get_page_views($this->post->ID); ?>                        
                    </div>
                </div>
            </div>
            <?php echo $this->get_title();?>

            <div class="td-module-meta-info">
                <div class="review">
                    <span>Tổng đánh giá</span> 
                    <div class="score">
                        <div class="stars small">
                            <div style="width: <?php echo (80/100)*$final_score*10; ?>px;"></div>
                        </div>
                    </div>
                    (<?php echo $users_rating['count']; ?>)
                </div>
                <div class="price">
                    <?php if ( $price_html = $product->get_price_html() ) : ?>
                        <?php echo $price_html; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php return ob_get_clean();
    }
}