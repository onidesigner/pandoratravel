<?php
/**
 * Woocommerce Product Details with field ACF
 * @author  Onizuka Nghĩa
 */

$i = 1;
?>

	<?php echo do_shortcode('[meta_gallery_slider dots="false" slider_height="450" navigation="true" nav_image_size="thumbnail" design="design-12" nav_slide_column="7" popup="true"]'); ?>
	
	<?php $field = get_field_object('hightlight'); ?>
	<?php if( ($field['value'] != '') || !empty( get_the_content() ) ): ?> 	
	<div class="block"> 
		<div class="block-content">
			<?php the_content();?>
			
			<?php if($field['value'] != ''): ?>
			<h3><?php echo $field['label']; ?></h3>			
			<?php the_field( 'hightlight' ); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="block"> 
		<h3 class="block-title"><span>Thông tin chương trình</span></h3>
		<div class="block-content">
		<div class="informations">
			<?php // Loại dịch vụ 
				$field = get_field_object('loai_dich_vu'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-flag" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'loai_dich_vu' ) ?></div>
				</div>
			<?php endif; ?>


			<?php // Thời gian
				$field = get_field_object('duration');
				$value = $field['value'];
				$label = $field['choices'][ $value ];
			?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value">
							<?php echo $label; ?>
							<?php if($value == 'one_day'){ ?>
								( <?php the_field( 'time_duration' ); ?> giờ )
							<?php } ?>

							<?php if($values == 'multiple_day'){ ?>
								( <?php the_field( 'number_of_day' ); ?> ngày <?php the_field( 'number_of_night' ); ?> đêm )
							<?php } ?>
					</div>
				</div>
			<?php endif; ?>


			<?php // Số lượng tối thiểu
				$field = get_field_object('so_luong_toi_thieu'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-users" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'so_luong_toi_thieu' ) ?> khách</div>
				</div>
			<?php endif; ?>


			<?php // Tỉnh thành
				$field = get_field_object('tinh_thanh', get_the_ID());
				$value = $field['value'];
				$label = $field['choices'][ $value ];
				?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value">
						<?php echo $label ? $label : $value; ?>
					</div>
				</div>
			<?php endif; ?>


			<?php // Thời gian bắt đầu
				$field = get_field_object('departure_time'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'departure_time' ) ?></div>
				</div>
			<?php endif; ?>


			<?php // Phương tiện di chuyển
				$field = get_field_object('transportation'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-taxi" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'transportation' ) ?></div>
				</div>
			<?php endif; ?>


			<?php // Không bao gồm trong chương trình
				$field = get_field_object('encludes'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item list-style-no">
					<div class="info-label">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'encludes' ) ?></div>
				</div>
			<?php endif; ?>

			<?php // Điều khoản dịch vụ
				$field = get_field_object('booking_terms'); 
				$array = get_field( 'booking_terms' );?>
			<?php if( $array ): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value">
						<ul>
						<?php foreach ( $array as $item ): echo '<li>'.$item.'</li>'; endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>		

			<?php // Chính sách đăng ký
				$field = get_field_object('booking_policies'); ?>
			<?php if($field['value'] != ''): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value"><?php the_field( 'booking_policies' ) ?></div>
				</div>
			<?php endif; ?>

			<?php // Các hoạt động
				$field = get_field_object('cac_hoat_dong'); 
				$array = get_field( 'cac_hoat_dong' );?>
			<?php if( $array ): ?>
				<div class="info-item">
					<div class="info-label">
						<i class="fa fa-tags" aria-hidden="true"></i> <?php echo $field['label']; ?>
					</div>
					<div class="info-value">
						<ul>
							<?php foreach ( $array as $item ): echo '<li>'.$item.'</li>'; endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		</div>
		</div>
	</div>

	<?php // Bản đồ địa điểm
		$field = get_field_object('location');
		$array = get_field('location');
		?>
	<?php if( $array ): ?>
	<div class="block"> 
		<h3 class="block-title"><span><?php echo $field['label']; ?></span></h3>
		<div class="block-content">
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $array['lat']; ?>" data-lng="<?php echo $array['lng']; ?>"></div>
			</div>
		</div>
	</div>
	<?php endif; ?>	

	<?php 
	$value = get_field_object('duration');
	$empty = true;

	if($value['value'] != ''): ?>
	<div class="block"> 
		<h3 class="block-title"><span>Lịch trình tour</span></h3>
		<div class="block-content">

			<?php // Chi tiet 1 ngay
				if($value['value'] == 'one_day'){
					$field = get_field_object('day_program');

					if($field['value'] != ''):
						the_field( 'day_program' );
						$empty = false;
					endif;
				} ?>

			<?php // Chi tiet nhieu ngay
				if($value['value'] == 'multiple_day'){
					$field = get_field_object('itinerary');

					if ( have_rows( 'itinerary' ) ) : ?>
					<div class="itinerary">
						<?php while ( have_rows( 'itinerary' ) ) : the_row(); ?>
							<div class="day_details">
								<div class="day_date">Ngày <?php the_sub_field('day_tour');?></div>
								<div class="day_title"><?php the_sub_field('day_'); ?></div>
								<div class="day_desc">
									<div><?php the_sub_field('day_activities'); ?></div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php 
						$empty = false;
					endif;
				} ?>

			<?php if($empty): ?>
				<div>Chưa cập nhật</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	

	<?php  if( get_field('includes')
			|| get_field('food_and_beverage')
			|| get_field('cac_loai_am_thuc')
			|| get_field('other_activities_')
			|| get_field('special_notes') ): ?>
	<div class="block"> 
		<h3 class="block-title"><span>Hành trình chi tiết tour</span></h3>
		<div class="block-content">	

			<?php // Bao gồm trong chương trình
				$field = get_field_object('includes');
				if($field['value'] != ''): ?>
				<div class="nbd-field">
					<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>					
					<div class="nbd-field-content">
						<?php the_field( 'includes' ); ?>
					</div>					
				</div>
			<?php endif; ?>

			<?php // Ẩm thực phục vụ
				$field = get_field_object('food_and_beverage');
				if($field['value'] != ''): ?>
				<div class="nbd-field">
					<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>					
					<div class="nbd-field-content">
						<?php the_field( 'food_and_beverage' ); ?>
					</div>					
				</div>
			<?php endif; ?>

			<?php // Các loại ẩm thực
				$field = get_field_object('cac_loai_am_thuc'); 
				$booking_terms_array = get_field( 'cac_loai_am_thuc' );
				if ( $booking_terms_array ):
				?>
                <div class="nbd-field">
                   <div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>
                    <div class="nbd-field-content">
                    	<ul>
						<?php 
							foreach ( $booking_terms_array as $booking_terms_item ):
								echo '<li>'.$booking_terms_item.'</li>';
							endforeach;					
						?>   
						</ul>
                    </div>
                </div> 
			<?php endif; ?>

			<?php // Các hoạt động khác
				$field = get_field_object('other_activities_');
				if($field['value'] != ''): ?>
				<div class="nbd-field">
					<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>					
					<div class="nbd-field-content">
						<?php the_field( 'other_activities_' ); ?>
					</div>					
				</div>
			<?php endif; ?>

			<?php // Lưu ý đặc biệt 
				$field = get_field_object('special_notes');
				if( have_rows('special_notes') ): ?>
				<div class="nbd-field">
					<div class="nbd-field-header"><h3><?php echo $field['label']; ?></h3></div>					
					<div class="nbd-field-content">
						<?php while ( have_rows('special_notes') ) : the_row(); ?>
							<div>
								<strong><?php the_sub_field('note_highlight');?></strong>
								<div><?php the_sub_field('note_detail'); ?></div>
							</div>
						<?php endwhile; ?>
					</div>					
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php $field = get_field_object('quy_trinh_tri_lieu'); ?>
	<?php if( have_rows('quy_trinh_tri_lieu') ): ?>
	<div class="block"> 
		<h3 class="block-title"><span><?php echo $field['label']; ?></span></h3>
		<div class="block-content">
			<div class="steps">
			<?php while ( have_rows('quy_trinh_tri_lieu') ) : the_row(); ?>
				<div class="step_details">
					<div class="step_number">Bước <span class="number"><?php the_sub_field('buoc_thu_tu');?></span></div>
					<div class="step_box">
						<div class="step_title"><strong><?php the_sub_field('chu_de_chinh'); ?></strong></div>
						<?php if(get_sub_field('chi_tiet_thuc_hien') != ''): ?>
						<div class="step_desc"><?php the_sub_field('chi_tiet_thuc_hien'); ?></div>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php $field = get_field_object('accommodations'); ?>
	<?php if( have_rows('accommodations') ): ?>
	<div class="block"> 
		<h3 class="block-title"><span><?php echo $field['label']; ?></span></h3>
		<div class="block-content">

			<?php $field1 = get_field_object('dia_diem_to_chuc'); ?>
			<?php if($field1['value'] != ''): ?>
				<?php the_field( 'dia_diem_to_chuc' ); ?><br/>
			<?php endif; ?>

			<?php while ( have_rows('accommodations') ) : the_row(); ?>
			<div class="field-box">
				<div class="field-title"><?php the_sub_field('tieu_de_luu_tru');?></div>
				<div class="field-content">
					<div class="field-desc">
						<?php $images = get_sub_field('gallery_ảnh');
						if( $images ): ?>
						<div class="field-gallery">
							<a href="#gallery_<?php echo $i; ?>" class="open-gallery-link">
								<img src="<?php echo $images[0]['sizes']['shop_catalog']; ?>" alt="<?php echo $images[0]['alt']; ?>" />
								<?php if (count($images) > 1) { ?>
									<span class="count"><i class="fa fa-picture-o" aria-hidden="true"></i> Xem tất cả <?php echo count($images); ?> ảnh</span>
								<?php } ?>
							</a>
						</div>
						<div id="gallery_<?php echo $i; ?>" class="mfp-hide">
							<?php foreach ($images as $image) :
								echo '<img class="slide" src="'. $image['url'] .'">';
							endforeach ?>
						</div>
						<?php $i++; ?>
						<?php endif; ?>

						<?php the_sub_field('chi_tiet_luu_tru'); ?>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>


	<?php $field = get_field_object('ho_tro_dieu_tri'); ?>
	<?php if( have_rows('ho_tro_dieu_tri') ): ?>
	<div class="block"> 
		<h3 class="block-title"><span><?php echo $field['label']; ?></span></h3>
		<div class="block-content">
			<?php while ( have_rows('ho_tro_dieu_tri') ) : the_row(); ?>
			<div class="field-box">
				<div class="field-title"><?php the_sub_field('tieu_de');?></div>
				<div class="field-content">
					<div class="field-desc">
						<?php $images = get_sub_field('gallery_ảnh');
						if( $images ): ?>
						<div class="field-gallery">
							<a href="#gallery_<?php echo $i; ?>" class="open-gallery-link">
								<img src="<?php echo $images[0]['sizes']['shop_catalog']; ?>" alt="<?php echo $images[0]['alt']; ?>" />
								<?php if (count($images) > 1) { ?>
									<span class="count"><i class="fa fa-picture-o" aria-hidden="true"></i> Xem tất cả <?php echo count($images); ?> ảnh</span>
								<?php } ?>
							</a>
						</div>
						<div id="gallery_<?php echo $i; ?>" class="mfp-hide">
							<?php foreach ($images as $image) :
								echo '<img class="slide" src="'. $image['url'] .'">';
							endforeach ?>
						</div>
						<?php $i++; ?>
						<?php endif; ?>

						<?php the_sub_field('noi_dung'); ?>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php $field = get_field_object('yoga_spa'); ?>
	<?php if( have_rows('yoga_spa') ): ?>
	<div class="block"> 
		<h3 class="block-title"><span><?php echo $field['label']; ?></span></h3>
		<div class="block-content">
			<?php while ( have_rows('yoga_spa') ) : the_row(); ?>
			<div class="field-box">
				<div class="field-title"><?php the_sub_field('tieu_de');?></div>
				<div class="field-content">
					<div class="field-desc">
						<?php $images = get_sub_field('gallery_ảnh');
						if( $images ): ?>
						<div class="field-gallery">
							<a href="#gallery_<?php echo $i; ?>" class="open-gallery-link">
								<img src="<?php echo $images[0]['sizes']['shop_catalog']; ?>" alt="<?php echo $images[0]['alt']; ?>" />
								<?php if (count($images) > 1) { ?>
									<span class="count"><i class="fa fa-picture-o" aria-hidden="true"></i> Xem tất cả <?php echo count($images); ?> ảnh</span>
								<?php } ?>
							</a>
						</div>
						<div id="gallery_<?php echo $i; ?>" class="mfp-hide">
							<?php foreach ($images as $image) :
								echo '<img class="slide" src="'. $image['url'] .'">';
							endforeach ?>
						</div>
						<?php $i++; ?>
						<?php endif; ?>

						<?php the_sub_field('noi_dung'); ?>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.open-gallery-link').click(function() {
		var gallery_id = $(this).attr('href');
		var items = [];

		$( gallery_id ).find('.slide').each(function() {
			items.push( {
				src: $(this).attr('src')
			} );
		});

		console.log(items);
	  
		$.magnificPopup.open({
			items:items,
			type: 'image',
			gallery: {
				enabled: true 
			}
		});
	});
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhyKmHVZvlHspdThfJQ31qX_WzeV623k4"></script>
<script type="text/javascript">
(function($) {
function new_map( $el ) {
	var $markers = $el.find('.marker');
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};	
	var map = new google.maps.Map( $el[0], args);
	map.markers = [];
	$markers.each(function(){
    	add_marker( $(this), map );
	});
	center_map( map );
	return map;
}
function add_marker( $marker, map ) {
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});
	map.markers.push( marker );
	if( $marker.html() )
	{
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
		});
	}
}

function center_map( map ) {
	var bounds = new google.maps.LatLngBounds();
	$.each( map.markers, function( i, marker ){
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});
	if( map.markers.length == 1 ){
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else{
		map.fitBounds( bounds );
	}
}
var map = null;

$(document).ready(function(){
	$('.acf-map').each(function(){
		map = new_map( $(this) );
	});

});

})(jQuery);
</script>