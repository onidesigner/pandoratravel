<?php
/*  ----------------------------------------------------------------------------
    footer extra bottom section FOOTER LOGO + DESCRIPTION + SOCIAL ICONS
 */

$td_footer_logo = td_util::get_option('tds_footer_logo_upload');
$td_footer_retina_logo = td_util::get_option('tds_footer_retina_logo_upload');
$td_top_logo = td_util::get_option('tds_logo_upload');
$td_top_retina_logo = td_util::get_option('tds_logo_upload_r');
$td_footer_text = td_util::get_option('tds_footer_text');
$td_footer_email = td_util::get_option('tds_footer_email');
$td_logo_alt = td_util::get_option('tds_logo_alt');
$td_footer_logo_alt = td_util::get_option('tds_footer_logo_alt');
$td_logo_title = td_util::get_option('tds_logo_title');
$td_footer_logo_title = td_util::get_option('tds_footer_logo_title');

// if there's no footer logo alt set use the alt from the header logo
if (empty($td_footer_logo_alt)) {
    $td_footer_logo_alt = $td_logo_alt;
}

// if there's no footer logo title set use the title from the header logo
if (empty($td_footer_logo_title)) {
    $td_footer_logo_title = $td_logo_title;
}

if (!empty($td_footer_retina_logo)) {
    // retina logo width of the normal logo
    $retina_footer_logo_id = attachment_url_to_postid($td_footer_logo);

    $retina_footer_logo_width = '';
    if ($retina_footer_logo_id !== 0) {
        $img_properties = wp_get_attachment_image_src($retina_footer_logo_id, 'full');
        if ($img_properties !== false && !empty($img_properties[1])) {
            $retina_footer_logo_width = $img_properties[1];
        }
    }
}

$buffy = '';

// column 1 logo
$buffy .= '<div class="td-pb-span3"><aside class="footer-logo-wrap">';
    if (!empty($td_footer_logo)) { // if have footer logo
        if (empty($td_footer_retina_logo)) { // if don't have a retina footer logo load the normal logo
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img src="' . $td_footer_logo . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '"/></a>';
        } else {
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img class="td-retina-data" src="' . $td_footer_logo . '" data-retina="' . esc_attr($td_footer_retina_logo) . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '" width="' . esc_attr($retina_footer_logo_width) . '" /></a>';
        }
    } else { // if you don't have a footer logo load the top logo
        if (empty($td_top_retina_logo)) {
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img src="' . $td_top_logo . '" alt="' . $td_logo_alt . '" title="' . $td_logo_title . '"/></a>';
        } else {
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img class="td-retina-data" src="' . $td_top_logo . '" data-retina="' . esc_attr($td_top_retina_logo) . '" alt="' . $td_logo_alt . '" title="' . $td_logo_title . '" width="' . esc_attr($retina_footer_logo_width) . '" /></a>';
        }
    }

    $td_get_social_network = td_options::get_array('td_social_networks');
    if(!empty($td_get_social_network)) {
        $buffy .= '<div class="footer-social-wrap td-social-style-2">';
        foreach($td_get_social_network as $social_id => $social_link) {
            if(!empty($social_link)) {
                $buffy .= td_social_icons::get_icon($social_link, $social_id, true);
            }
        }
        $buffy .= '</div>';
    }


$buffy .= '</aside></div>';

// column 2 description
$buffy .= '<div class="td-pb-span4"><aside class="footer-text-wrap">';
    $buffy .= '<div class="block-title"><span>' . __td('ABOUT US', TD_THEME_NAME) . '</span></div>';
    $buffy .= stripcslashes($td_footer_text);
$buffy .= '</aside></div>';

// column 3 social icons
	$buffy .= '<div class="td-pb-span5"><aside class="footer-text-wrap">';
	    $buffy .= '<div class="block-title"><span>' . __td('ĐƠN VỊ CHỦ QUẢN', TD_THEME_NAME) . '</span></div>';
	    //get the socials that are set by user
	    $buffy .= '<strong>Cty CP Dịch Vụ Và Giải Pháp Doanh Nghiệp Pandora Việt Nam</strong><br/>
<i class="fa fa-certificate" aria-hidden="true"></i> MST: <strong>0107729564</strong> - Cấp bởi SKHDT Hà Nội<br/>
<i class="fa fa-building" aria-hidden="true"></i> VPGD: <a href="https://goo.gl/maps/TQDG5HqhdCD2" target="_blank">P.2102 - M3M4 khu B, 91 Nguyễn Chí Thanh, Đống Đa, HN</a><br/>
<i class="fa fa-phone" aria-hidden="true"></i> Điện thoại: <a href="tel:+842462752228">024.6275.2228</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<i class="fa fa-mobile" aria-hidden="true"></i> Hotline: <a href="tel:+840968081384">096.808.1384</a><br/>
<i class="fa fa-envelope" aria-hidden="true"></i> Email: <a href="mailto:travel@pandoravietnam.com">travel@pandoravietnam.com</a>';
	$buffy .= '</aside></div>';

echo $buffy;