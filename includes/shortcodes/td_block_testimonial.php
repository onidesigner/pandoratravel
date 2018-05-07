<?php
class td_block_testimonial extends td_block {

	private $atts = array(); //the atts used for rendering the current block

	function render($atts, $content = null) {
		parent::render($atts);

		$this->atts = shortcode_atts(
			array(
				'custom_title' => '',
				'custom_subtitle' => '',
				'bg_box' => '',
				'loop' => '',
				'items_desktop' => '3',
				'items_tab' => '2',
				'items_mobile' => '1',
				'autoplay' => '',
				'autoplay_timeout' => '5000',
				'autoplay_hover_pause' => '',
				'display_dots' => '',
				'display_nav' => '',
				'lazyload' => '',

				'client_image_item0'		=> '',
				'client_name_item0'			=> '',
				'client_designation_item0'	=> '',
				'client_company_item0'		=> '',
				'client_location_item0'		=> '',
				'client_review_content_item0'=> '',
				'client_review_star_item0'	=> '',
				'client_facebook_url_item0'	=> '',
				'client_twitter_url_item0'	=> '',
				'client_google_url_item0'	=> '',

				'client_image_item1'		=> '',
				'client_name_item1'			=> '',
				'client_designation_item1'	=> '',
				'client_company_item1'		=> '',
				'client_location_item1'		=> '',
				'client_review_content_item1'=> '',
				'client_review_star_item1'	=> '',
				'client_facebook_url_item1'	=> '',
				'client_twitter_url_item1'	=> '',
				'client_google_url_item1'	=> '',

				'client_image_item2'		=> '',
				'client_name_item2'			=> '',
				'client_designation_item2'	=> '',
				'client_company_item2'		=> '',
				'client_location_item2'		=> '',
				'client_review_content_item2'=> '',
				'client_review_star_item2'	=> '',
				'client_facebook_url_item2'	=> '',
				'client_twitter_url_item2'	=> '',
				'client_google_url_item2'	=> '',

				'client_image_item3'		=> '',
				'client_name_item3'			=> '',
				'client_designation_item3'	=> '',
				'client_company_item3'		=> '',
				'client_location_item3'		=> '',
				'client_review_content_item3'=> '',
				'client_review_star_item3'	=> '',
				'client_facebook_url_item3'	=> '',
				'client_twitter_url_item3'	=> '',
				'client_google_url_item3'	=> '',

				'client_image_item4'		=> '',
				'client_name_item4'			=> '',
				'client_designation_item4'	=> '',
				'client_company_item4'		=> '',
				'client_location_item4'		=> '',
				'client_review_content_item4'=> '',
				'client_review_star_item4'	=> '',
				'client_facebook_url_item4'	=> '',
				'client_twitter_url_item4'	=> '',
				'client_google_url_item4'	=> '',

			), $atts);

		$items = array();
		for ($i = 0; $i < 5; $i++ ) {
			if ( ! empty( $this->atts['client_image_item' . $i] ) ) {
				$items[] = array(
					'image' => $this->atts['client_image_item' . $i],
					'name' => $this->atts['client_name_item' . $i],
					'designation' => $this->atts['client_designation_item' . $i],
					'company' => $this->atts['client_company_item' . $i],
					'location' => $this->atts['client_location_item' . $i],
					'review_content' => $this->atts['client_review_content_item' . $i],
					'review_star' => (int)$this->atts['client_review_star_item' . $i],
					'facebook_url' => $this->atts['client_facebook_url_item' . $i],
					'twitter_url' => $this->atts['client_twitter_url_item' . $i],
					'google_url' => $this->atts['client_google_url_item' . $i],
				);
			}
		}

		$custom_title = $this->atts['custom_title'];
		$custom_subtitle = $this->atts['custom_subtitle'];
		$bg_box = $this->atts['bg_box'];
		$items_desktop = $this->atts['items_desktop'];
		$items_tab = $this->atts['items_tab'];
		$items_mobile = $this->atts['items_mobile'];
		$autoplay = $this->atts['autoplay'] == 'yes' ? 'true' : 'false' ;
		$autoplay_timeout = $this->atts['autoplay_timeout'];
		$autoplay_hover_pause = $this->atts['autoplay_hover_pause'] == 'yes' ? 'true' : 'false' ;
		$display_dots = $this->atts['display_dots'] == 'yes' ? 'true' : 'false' ;
		$display_nav = $this->atts['display_nav'] == 'yes' ? 'true' : 'false' ;
		$lazyload = $this->atts['lazyload'] == 'yes' ? 'true' : 'false' ;
		$loop = $this->atts['loop'] == 'yes' ? 'true' : 'false' ;


		$buffy = '';

		$buffy .= "<link rel='stylesheet' href='".get_template_directory_uri()."/testimonial/assets/css/testimonial.css' type='text/css' media='all' />";
		$buffy .= "<link rel='stylesheet' href='".get_template_directory_uri()."/testimonial/assets/vendor/slick/slick-theme.css' type='text/css' media='all' />";
		$buffy .= "<link rel='stylesheet' href='".get_template_directory_uri()."/testimonial/assets/vendor/slick/slick.css' type='text/css' media='all' />";


		$buffy .= '<div class="nb_block block_testimonial" ' . $this->get_block_html_atts() . '>';
		$buffy .= '<div class="td-container">';

		//get the block css
		$buffy .= $this->get_block_css();

		// block title wrap
		// 
		$buffy .= '<div class="block-title-wrap">';
			if(!empty($custom_title)) $buffy .= '<h4 class="block-title"><span>'.$custom_title.'</span></h4>';
			if(!empty($custom_subtitle)) $buffy .= '<p class="block-subtitle">'.$custom_subtitle.'</p>';
		$buffy .= '</div>';


		if(count($items) > 0) {
		$buffy .= '<div class="rt-container-fluid tss-wrapper" data-layout="carousel11" data-desktop-col="'.$items_desktop.'" data-tab-col="'.$items_tab.'" data-mobile-col="'.$items_mobile.'">';
			$buffy .= "<div data-title='Loading ...' class='rt-row tss-carousel11 tss-even tss-pre-loader'>";

				$buffy .= "<div class='tss-carousel' 
	                data-loop='".$loop."' 
	                data-items-desktop='".$items_desktop."' 
	                data-items-tab='".$items_tab."' 
	                data-items-mobile='".$items_mobile."' 
	                data-autoplay='".$autoplay."' 
	                data-autoplay-timeout='".$autoplay_timeout."' 
	                data-autoplay-hover-pause='".$autoplay_hover_pause."' 
	                data-dots='".$display_dots."' 
	                data-nav='".$display_nav."' 
	                data-lazy-load='".$lazyload."' 
	                data-auto-height='false' 
	                data-rtl='false' 
	                data-smart-speed='2000'>";

				foreach($items as $item) {

					if(empty($item['image'])) $item['image'] = get_template_directory_uri()."/testimonial/assets/img/avatar.png";

					$buffy .= '<div class="rt-col-md-12 rt-col-sm-12 rt-col-xs-12 even-grid-item tss-grid-item carousel-item even-grid-item default-margin tss-img-circle">';
						$buffy .= '<div class="single-item-wrapper">';

							$buffy .= '<div class="tss-meta-info">
	                            <div class="profile-img-wrapper">
	                                <img width="150" height="150" src="'.wp_get_attachment_url($item['image']).'" class="rt-responsive-img" alt="'.$item['name'].'" />
	                            </div>
	                        </div>';
	                        $buffy .= '<div class="item-content-wrapper">
	                            <div class="item-content">
	                            	<i class="fa fa-quote-left" aria-hidden="true"></i>
	                            	'.$item['review_content'].'
	                            	<i class="fa fa-quote-right" aria-hidden="true"></i>
	                            </div>
	                        </div>';
	                        $buffy .= '<h3 class="author-name">'.$item['name'].'</h3>';
	                        $buffy .= '<h4 class="author-bio">';
	                            if(!empty($item['designation']))
	                            	$buffy .= '<span class="author-designation">'.$item['designation'].'</span>, ';
	                            if(!empty($item['company']))
	                            	$buffy .= '<span class="item-company">'.$item['company'].'</span>, ';
	                            if(!empty($item['location']))
	                            	$buffy .= '<span class="author-location">'.$item['location'].'</span>';
	                        $buffy .= '</h4>';

	                        if( !empty($item['review_star']) ) {
	                        $buffy .= '<div class="rating-wrapper">';
	                        	for($i = 1; $i <= $item['review_star']; $i++){
	                            	$buffy .= '<span data-star="'.$i.'" class="star-'.$i.' fa fa-star" aria-hidden="true"></span>';
	                        	}
	                        $buffy .= '</div>';
	                    	}

	                        if( !empty($item['facebook_url']) || !empty($item['twitter_url']) || !empty($item['google_url']) ) {
	                        $buffy .= '<div class="author-social">';
	                            if(!empty($item['facebook_url']))
	                            	$buffy .= '<a href="'.$item['facebook_url'].'"><span class="fa fa-facebook-square"></span></a>';
	                            if(!empty($item['twitter_url'])) 
	                            	$buffy .= '<a href="'.$item['twitter_url'].'"><span class="fa fa-twitter-square"></span></a>';
	                            if(!empty($item['google_url'])) 
	                            	$buffy .= '<a href="'.$item['google_url'].'"><span class="fa fa-google-plus-square"></span></a>';
	                        $buffy .= '</div>';
	                    	}

						$buffy .= '</div>';

					$buffy .= '</div>';
				}

				$buffy .= '</div>';

				$buffy .= '<div class="rt-loading-overlay"></div>';
            	$buffy .= '<div class="rt-loading rt-ball-clip-rotate"><div></div></div>';

			$buffy .= '</div>';
		$buffy .= '</div>';
		}
		

		$buffy .= '</div>';
		$buffy .= '</div>';

		$buffy .= "<script type='text/javascript' src='".get_template_directory_uri()."/testimonial/assets/vendor/slick/slick.min.js'></script>";
		$buffy .= "<script type='text/javascript' src='".get_template_directory_uri()."/testimonial/assets/vendor/isotope/imagesloaded.pkgd.min.js'></script>";
		$buffy .= "<script type='text/javascript' src='".get_template_directory_uri()."/testimonial/assets/js/testimonial.js'></script>";

		return $buffy;
	}
}