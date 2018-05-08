<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 * @author  Onizuka Nghĩa
 */

td_global::$current_template = 'woo';


get_header();

//set the template id, used to get the template specific settings
$template_id = 'woo';


$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)


// vars
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$description_bottom = get_field('description_bottom', $queried_object);

$template = get_field('template', $queried_object);
$intro_text = get_field('intro_text', $queried_object);
$archive_header_bg = get_field('archive_header_bg', $queried_object);


// sidebar position used to align the breadcrumb on sidebar left + sidebar first on mobile issue
$td_sidebar_position = '';
if($loop_sidebar_position == 'sidebar_left') {
	$td_sidebar_position = 'td-sidebar-left';
}

?>
	<div class="td-main-content-wrap td-main-page-wrap td-container-wrap" style="padding-bottom: 0;">

	<?php if($template != 'landing_page' || ($template == 'landing_page' && !$intro_text)) { ?>
		<?php if(is_product_tag()) { ?>
			<div class="archive_header <?php echo $archive_header_bg ? 'has_bg' : '';?>" style="<?php echo $archive_header_bg ? 'background-image: url('. $archive_header_bg .')' : '';?>">
				<div class="td-container">
					<center>
						<h1 style="text-transform: uppercase;"><?php echo single_tag_title();?></h1>
						<p>Bạn đang xem các sản phẩm <a href="<?php get_term_link(get_queried_object()->slug); ?>"><strong><?php echo single_tag_title();?></strong></a> được giới thiệu với đầy đủ thông tin chi tiết và giá cả hấp dẫn nhất.  <strong><?php echo single_tag_title();?></strong> là sản phẩm được rất nhiều khách hàng quan tâm tìm kiếm và đăng ký sử dụng, vì thế vui lòng liên hệ ngay với tư vấn bán hàng để được hỗ trợ booking tốt nhất. Hiện đang có <strong><?php echo get_queried_object()->count; ?></strong> sản phẩm <strong><?php echo single_tag_title();?></strong>.</p>
					</center>
					<?php do_action( 'woocommerce_archive_description' ); ?>
				</div>
			</div>
		<?php }else { ?>
			<?php if(get_the_archive_description()):?>
			<div class="archive_header <?php echo $archive_header_bg ? 'has_bg' : '';?>" style="<?php echo $archive_header_bg ? 'background-image: url('. $archive_header_bg .')' : '';?>">
				<div class="td-container">
					<?php do_action( 'woocommerce_archive_description' ); ?>
					<?php if (is_product_category() && !is_product_category('my-pham-spa')): ?>
						<div id="archive-filters">
							<form id="tour_filter">
							<?php foreach( $GLOBALS['tour_filter'] as $filter ): 
								
								// get the field's settings without attempting to load a value
								$field = get_field_object( $filter['key'], 3703, false, false );									

								// set value if available
								if( isset($_GET[ $filter['key'] ]) ) {		
									$field['value'] = explode(',', $_GET[ $filter['key'] ]);		
								}else{
									$field['value'] = null;
								}
								?>
								<div class="filter" data-filter="<?php echo $filter['key']; ?>">
									<i class="<?php echo $filter['icon']; ?>" aria-hidden="true"></i>
									<?php create_field( $field ); ?>
								</div>

							<?php endforeach; ?>
								<button type="submit"><i class="fa fa-search" aria-hidden="true"></i>Tìm kiếm</button>
								<div style="clear: both;"></div>
							</form>
						</div>

						<script type="text/javascript">
							(function($) {	
								var form_data = $('#tour_filter').serialize();
								$('#tour_filter').submit(function (e) {
									e.preventDefault();
									if ( form_data != $(this).serialize() ) {
										$(this).find('[type=submit]').html('<i class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>Loading...');

										var url = '<?php global $wp; echo home_url(add_query_arg(array(),$wp->request)); ?>';
										args = {};			

												// loop over filters
												$('#tour_filter .filter').each(function(){
													var filter = $(this).data('filter'),
													vals = [];												
													$(this).find("[name*='acf']").each(function(){	
														vals.push( encodeURI($(this).val()) );	
													});
													if(vals != "") args[filter] = vals.join(',');			
												});

												// update url
												url += '?';
												$.each(args, function( name, value ){			
													url += name + '=' + value + '&';			
												});
												url = url.slice(0, -1);
												window.location.href = url;
											}else{
												alert('Chưa có dữ liệu để lọc!');
											}
										});
							})(jQuery);
						</script>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		<?php } ?>
	<?php } ?>
		
	<?php get_template_part( 'woocommerce-category-details' ); ?>

		<div id="products" class="td-container <?php echo $td_sidebar_position; ?>">
			<div class="td-pb-row">
				<div class="td-pb-span12 td-main-content">
					<div class="td-ss-main-content">
						<?php 
						if ( have_posts() ) :
							do_action( 'woocommerce_before_shop_loop' );
							woocommerce_product_loop_start();
							woocommerce_product_subcategories();

							while ( have_posts() ) : the_post();
								do_action( 'woocommerce_shop_loop' );
								wc_get_template_part( 'content', 'product' );
							endwhile;

							woocommerce_product_loop_end();
							do_action( 'woocommerce_after_shop_loop' );
						elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
							do_action( 'woocommerce_no_products_found' );
						endif; ?>

						<?php // woocommerce_content(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="nb_block block_why_choose_us">
			<div class="td-container">
				<div class="block-title-wrap">
					<h4 class="block-title"><span>6 lý do sử dụng dịch vụ của chúng tôi</span></h4>
					<p class="block-subtitle">Chúng tôi cung cấp những sản phẩm du lịch độc đáo, chất lượng cho từng cá nhân riêng lẻ đến những nhóm đoàn lớn.</p>
				</div>
				<ul class="reasons">
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason chuyen-sau"></i>
						</div>
						<div class="reason-text">Dịch vụ chuyên sâu về các sản phẩm và dịch vụ về Spa, Yoga &amp; Làm Đẹp</div>
					</li>
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason tiet-kiem"></i>
						</div>
						<div class="reason-text">Tiết kiệm hơn cho chị em vì thường xuyên có các Deal giảm giá khuyến mại hấp dẫn</div>
					</li>
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason tu-van"></i>
						</div>
						<div class="reason-text">Đội ngũ tư vấn trung thực và gần gũi khách hàng như chị em</div>
					</li>
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason chat-luong"></i>
						</div>
						<div class="reason-text">Sản phẩm được chọn lọc, đánh giá chất lượng trước khi giới thiệu cho khách hàng</div>
					</li>
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason chi-tiet"></i>
						</div>
						<div class="reason-text">Thông tin sản phẩm đa dạng lựa chọn, rõ ràng, chi tiết, có đánh giá từ người dùng</div>
					</li>
					<li class="reason-item">
						<div class="reason-icon">
							<i class="icon-reason khach-vip"></i>
						</div>
						<div class="reason-text">Có các chương trình và sản phẩm thiết kế riêng cho khách hàng VIP, nhóm đoàn</div>
					</li>
				</ul>
			</div>
		</div>


		<?php if(is_product_tag()) { ?>
			<div class="td-container" style="padding-top: 50px; padding-bottom: 50px;">
				<div class="term-description-bottom">
					<div class="content js-content">
						<p><a href="<?php echo home_url();?>"><strong><?php echo COMPANY_NAME;?></strong></a> cung cấp nhiều lựa chọn sản phẩm <a href="<?php get_term_link(get_queried_object()->slug); ?>"><strong><?php echo single_tag_title();?></strong></a> với chính sách hợp lý và giá cả hấp dẫn nhất từ các kênh đối tác uy tín. <strong><?php echo single_tag_title();?></strong> là sản phẩm được rất nhiều khách hàng quan tâm tìm kiếm và đăng ký sử dụng, vì thế vui lòng liên hệ ngay với tư vấn bán hàng để được hỗ trợ booking tốt nhất.</p>
					</div>
					<div class="show-more">
						<a class="js-show-more" href="#">Xem Thêm Nội Dung</a>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if($description_bottom){ ?>
			<div class="td-container" style="padding-top: 50px; padding-bottom: 50px;">
				<div class="term-description-bottom">
					<div class="content js-content">
						<?php echo $description_bottom; ?>
					</div>
					<div class="show-more">
						<a class="js-show-more" href="#">Xem Thêm Nội Dung</a>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	</div> <!-- /.td-main-content-wrap -->

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".js-content").each(function() {
	            var e = $(this),
	                t = e.data("max-height") || 500,
	                a = e.parent().find(".js-show-more");

	            var text_expand = "Xem thêm nội dung",
	                text_collapse = "Thu gọn nội dung";

	            e.addClass("expand"), 
	            e.outerHeight() > t ? 
	            (e.removeClass("expand"), e.css("max-height", t), a.text(text_expand),
	            a.click(function(n) {
	                n.preventDefault();
	                var i = $(this).offset().top - window.pageYOffset;
	                e.toggleClass("expand"), 
	                e.hasClass("expand") ? (a.text(text_collapse), e.css("max-height", "none")) : (a.text(text_expand), e.css("max-height", t), $("html,body").animate({
	                    scrollTop: a.offset().top - i
	                }, 0))
	            })) : a.hide()
	        });
		});
	</script>
<?php
get_footer();
?>