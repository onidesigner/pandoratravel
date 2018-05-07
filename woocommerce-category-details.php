<?php
/**
 * Woocommerce Category Details with field ACF
 * @author  Onizuka Nghĩa
 */

// vars
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$template = get_field('template', $queried_object);

$intro_text = get_field('intro_text', $queried_object);
$intro_css = '';
$intro_bg = get_field('intro_bg', $queried_object);

$image_box_style_1 = get_field('image_box_style_1', $queried_object);
$bgcolor_style_1 = get_field('bgcolor_style_1', $queried_object);
$title_style_1 = get_field('title_style_1', $queried_object);
$subtitle_style_1 = get_field('subtitle_style_1', $queried_object);
$items_style_1 = get_field('items_style_1', $queried_object);

$image_box_style_2 = get_field('image_box_style_2', $queried_object);
$bgcolor_style_2 = get_field('bgcolor_style_2', $queried_object);
$title_style_2 = get_field('title_style_2', $queried_object);
$subtitle_style_2 = get_field('subtitle_style_2', $queried_object);
$items_style_2 = get_field('items_style_2', $queried_object);

$image_box_style_3 = get_field('image_box_style_3', $queried_object);
$bgcolor_style_3 = get_field('bgcolor_style_3', $queried_object);
$title_style_3 = get_field('title_style_3', $queried_object);
$subtitle_style_3 = get_field('subtitle_style_3', $queried_object);
$items_style_3 = get_field('items_style_3', $queried_object);

$box_text_image = get_field('box_text_image', $queried_object);
$bgcolor_box_text_image = get_field('bgcolor_box_text_image', $queried_object);
$title_box_text_image = get_field('title_box_text_image', $queried_object);
$subtitle_box_text_image = get_field('subtitle_box_text_image', $queried_object);
$content_box_text_image = get_field('content_box_text_image', $queried_object);
$media_box_text_image = get_field('media_box_text_image', $queried_object);

if($intro_bg) { $intro_css .= 'background-image: url("'.$intro_bg.'");';}
?>
<?php if($template == 'landing_page') { ?>
	<?php if($intro_text) { ?>
	<div class="nb_block block_intro" style='<?php echo $intro_css;?>'>
		<div class="td-container">
			<?php echo $intro_text;?>

			<?php /* Demo
			<h1 class="title">Voucher Vinpearl Nha Trang<br/>Golf Land Resort & Villas</h1>
			<h3 class="subtitle">Thiết kế riêng theo từng nhu cầu của bạn</h3>
			<a href="#products" class="action">Tiết kiệm 50%. Xem ngay >></a>
			<p class="desc">Phân phối bởi đại lý chính thức, cấp 1 của VIN GROUP</p>
			<div class="top-hotline">
				<p>Gọi hotline để được tư vấn ngay</p>
				<div class="hotlines">
					<div class="hotline-box">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:+842462752228"><strong>024.6275.2228</strong><p>(Điện thoại)</p></a>
					</div>
					<div class="hotline-box">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:+84968081384"><strong>096.808.1384</strong><p>(Hotline)</p></a>
					</div>
				</div>
			</div>
			*/ ?>
		</div>
	</div>
	<?php } ?>

	<?php if($image_box_style_1) { ?>
		<div class="nb_block bg_<?php echo $bgcolor_style_1;?>">
			<div class="td-container">
				<div class="block-title-wrap">
					<h4 class="block-title"><span><?php echo $title_style_1;?></span></h4>
					<p class="block-subtitle"><?php echo $subtitle_style_1;?></p>
				</div>
				<div class="block-content-wrap">
					<?php if( have_rows('items_style_1', $queried_object) ): ?>
					<?php while ( have_rows('items_style_1', $queried_object) ) : the_row(); ?>
					<div class="item-box hover02">
						<div class="image">
							<?php $image = get_sub_field('image', $queried_object); ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						</div>
						<div class="info">
							<h3 class="title"><?php the_sub_field('title', $queried_object);?></h3>
							<p class="desc"><?php the_sub_field('desc', $queried_object);?></p>
						</div>						
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php if($image_box_style_2) { ?>
		<div class="nb_block bg_<?php echo $bgcolor_style_2;?>">
			<div class="td-container">
				<div class="block-title-wrap">
					<h4 class="block-title"><span><?php echo $title_style_2;?></span></h4>
					<p class="block-subtitle"><?php echo $subtitle_style_2;?></p>
				</div>
				<div class="block-content-wrap" style="text-align: center;">
					<?php if( have_rows('items_style_2', $queried_object) ): ?>
					<?php while ( have_rows('items_style_2', $queried_object) ) : the_row(); ?>
					<div class="image-box hover02">
						<a href="<?php the_sub_field('url', $queried_object);?>" title="<?php the_sub_field('title', $queried_object);?>">
							<div class="image">
								<?php $image = get_sub_field('image', $queried_object); ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							</div>
							<div class="info">
								<h3 class="title"><?php the_sub_field('title', $queried_object);?></h3>
								<p class="desc"><?php the_sub_field('desc', $queried_object);?></p>
							</div>
						</a>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php if($image_box_style_3) { ?>
		<div class="nb_block block_package_vourcher bg_<?php echo $bgcolor_style_3;?>">
			<div class="td-container">
				<div class="block-title-wrap">
					<h4 class="block-title"><span><?php echo $title_style_3;?></span></h4>
					<p class="block-subtitle"><?php echo $subtitle_style_3;?></p>
				</div>
				<div class="block-content-wrap">
					<ul>
						<?php if( have_rows('items_style_3', $queried_object) ): ?>
						<?php while ( have_rows('items_style_3', $queried_object) ) : the_row(); ?>
						<li class="package_item hover01">
							<div class="package_thumb">
								<?php $image = get_sub_field('image', $queried_object); ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							</div>
							<div class="package_info">
								<div class="package_info_inner">
									<h3 class="package_name"><?php the_sub_field('title', $queried_object);?></h3>
									<p class="package_desc"><?php the_sub_field('desc', $queried_object);?></p>
								</div>
								<a class="package_url" href="<?php the_sub_field('url', $queried_object);?>">Xem ngay</a>
							</div>
						</li>
						<?php endwhile; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php if($box_text_image) { ?>
		<div class="nb_block bg_<?php echo $bgcolor_box_text_image;?>">
			<div class="td-container">
				<div class="block-title-wrap">
					<h4 class="block-title"><span><?php echo $title_box_text_image;?></span></h4>
					<p class="block-subtitle"><?php echo $subtitle_box_text_image;?></p>
				</div>
				<div class="block-content-wrap">
					<div class="media-box">
						<?php echo $media_box_text_image;?>
					</div>
					<?php echo $content_box_text_image;?>
				</div>
			</div>
		</div>
	<?php } ?>
<?php } ?>