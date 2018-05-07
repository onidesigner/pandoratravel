<?php
class td_block_promo_banners extends td_block {

	private $atts = array(); //the atts used for rendering the current block

	function render($atts, $content = null) {
		parent::render($atts);

		$this->atts = shortcode_atts(
			array(
				'slider_shortcode' => '',

				'banner_image_item0'        => '',
				'banner_title_item0'        => '',
				'banner_url_item0'          => '',
				
				'banner_image_item1'        => '',
				'banner_title_item1'        => '',
				'banner_url_item1'          => '',
				
				'banner_image_item2'        => '',
				'banner_title_item2'        => '',
				'banner_url_item2'          => '',


				'cat_image_item0'           => '',
				'cat_title_item0'           => '',
				'cat_url_item0'             => '',

				'cat_image_item1'           => '',
				'cat_title_item1'           => '',
				'cat_url_item1'             => '',

				'cat_image_item2'           => '',
				'cat_title_item2'           => '',
				'cat_url_item2'             => '',

				'cat_image_item3'           => '',
				'cat_title_item3'           => '',
				'cat_url_item3'             => '',

				'cat_image_item4'           => '',
				'cat_title_item4'           => '',
				'cat_url_item4'             => ''
			), $atts);


		$banner_items = array();
		for ($i = 0; $i < 3; $i++ ) {
			if ( ! empty( $this->atts['banner_image_item' . $i] ) ) {
				$banner_items[] = array(
					'image' => $this->atts['banner_image_item' . $i],
					'title' => $this->atts['banner_title_item' . $i],
					'url' => $this->atts['banner_url_item' . $i]
				);
			}
		}

		$cat_items = array();
		for ($i = 0; $i < 5; $i++ ) {
			if ( ! empty( $this->atts['cat_image_item' . $i] ) ) {
				$cat_items[] = array(
					'image' => $this->atts['cat_image_item' . $i],
					'title' => $this->atts['cat_title_item' . $i],
					'url' => $this->atts['cat_url_item' . $i]
				);
			}
		}

		$slider_shortcode = $this->atts['slider_shortcode'];

		$no_banner = count($banner_items) > 0 ? false : true;


		$buffy = '';

		$buffy .= '<div id="promo_banners" class="nb_block block_promo_banners" ' . $this->get_block_html_atts() . '>';
		$buffy .= '<div class="td_block_inner">';

		//get the block css
		$buffy .= $this->get_block_css();

		$buffy .= '<div class="td-block-row">';

		if ($no_banner) $buffy .= '<div class="td-block-span12">';
		else $buffy .= '<div class="td-block-span9">';

		if (!empty($slider_shortcode)) {
			$buffy .= '<div class="promo-slider">';
			if ($_GET['td_action'] == 'tdc_edit'){
				$buffy .= '<div class="tdc_external_shortcode" style="height: 340px;"><span>rev_slider alias="'.$slider_shortcode.'"</span></div>';
			} else {
				$buffy .= do_shortcode('[rev_slider alias="'.$slider_shortcode.'"]');
			}
			$buffy .= '</div>';
		}
		if(count($cat_items) > 0) {
			$buffy .= '<div class="promo-cats">';
			foreach($cat_items as $item) {
				$buffy .= '<a href="'.$item['url'].'" title="'.$item['title'].'">';
				$buffy .= '<img src="'.wp_get_attachment_image_src($item['image'], 'td_324x235')[0].'" alt="'.$item['title'].'">';
				$buffy .= '<span>'.$item['title'].'</span>';
				$buffy .= '</a>';
			}
			$buffy .= '</div>';
		}
		$buffy .= '</div>';

		if(count($banner_items) > 0) {
			$buffy .= '<div class="promo-banners td-block-span3">';
			foreach($banner_items as $item) {
				$buffy .= '<a href="'.$item['url'].'" title="'.$item['title'].'">';
				$buffy .= '<img src="'.wp_get_attachment_image_src($item['image'], 'td_356x220')[0].'" alt="'.$item['title'].'">';
				$buffy .= '</a>';
			}
			$buffy .= '</div>';
		}
		$buffy .= '</div>';		

		$buffy .= '</div>';
		$buffy .= '</div>';

		return $buffy;
	}
}