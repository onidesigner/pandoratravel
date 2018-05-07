<?php
class td_block_why_choose_us extends td_block {

	private $atts = array(); //the atts used for rendering the current block

	function render($atts, $content = null) {
		parent::render($atts);

		$this->atts = shortcode_atts(
			array(
				'custom_title' => '',
				'custom_subtitle' => '',
				'bg_box' => '',

				'reason_icon_item0'			=> '',
				'reason_text_item0'			=> '',
				'reason_icon_item1'			=> '',
				'reason_text_item1'			=> '',
				'reason_icon_item2'			=> '',
				'reason_text_item2'			=> '',
				'reason_icon_item3'			=> '',
				'reason_text_item3'			=> '',
				'reason_icon_item4'			=> '',
				'reason_text_item4'			=> '',
				'reason_icon_item5'			=> '',
				'reason_text_item5'			=> '',
			), $atts);

		$items = array();
		for ($i = 0; $i < 6; $i++ ) {
			if ( ! empty( $this->atts['reason_icon_item' . $i] ) ) {
				$items[] = array(
					'icon' => $this->atts['reason_icon_item' . $i],
					'text' => $this->atts['reason_text_item' . $i]
				);
			}
		}

		$custom_title = $this->atts['custom_title'];
		$custom_subtitle = $this->atts['custom_subtitle'];
		$bg_box = $this->atts['bg_box'];

		$buffy = '';

		$buffy .= '<div class="nb_block block_why_choose_us" ' . $this->get_block_html_atts() . '>';
			$buffy .= '<div class="td-container">';

			//get the block css
			$buffy .= $this->get_block_css();

			// block title wrap
			$buffy .= '<div class="block-title-wrap">';
				if(!empty($custom_title)) $buffy .= '<h4 class="block-title"><span>'.$custom_title.'</span></h4>';
				if(!empty($custom_subtitle)) $buffy .= '<p class="block-subtitle">'.$custom_subtitle.'</p>';
			$buffy .= '</div>';


			if(count($items) > 0) {
				$buffy .= '<ul class="reasons">';
				foreach($items as $item) {

					$buffy .= '<li class="reason-item">';
						$buffy .= '<div class="reason-icon"><i class="icon-reason '.$item['icon'].'"></i></div>';
						$buffy .= '<div class="reason-text">'.$item['text'].'</div>';
					$buffy .= '</li>';
				}
				$buffy .= '</ul>';
			}
		

			$buffy .= '</div>';
		$buffy .= '</div>';

		return $buffy;
	}
}