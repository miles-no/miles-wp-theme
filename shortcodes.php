<?php

include_once "miles_limes.php";
include_once "shortcode_util.php";

function register_shortcodes(): void
{
    add_shortcode('show-consultant', 'shortcode_show_consultant');
    add_shortcode('show-consultant-group', 'shortcode_show_consultant_group');
}

function shortcode_show_consultant($atts): string
{
    $consultantList = miles_limes\get_consultants(null, null, $atts["email"]);

    $consultant = $consultantList[0];

    return shortcode_util\toWebComponent($atts['wc_name'], consultant_to_webcomponent($consultant), null);
}

function shortcode_show_consultant_group($atts): string
{
    $office = $atts['office'];
    $area = $atts['area'];
    $webComponent = $atts["wc_name"];

    $consultantList = miles_limes\get_consultants($office, $area, null);

    $result = '';
    foreach ($consultantList as $consultant) {
        $result .= shortcode_util\toWebComponent($webComponent, consultant_to_webcomponent($consultant), null);
    }

    return $result;
}

function consultant_to_webcomponent($consultant): array
{
    return array(
        'name' => $consultant["name"],
        'location' => $consultant["office"],
        'jobtitle' => $consultant["title"],
        'image' => $consultant["imageUrlThumbnail"],
        'email' => $consultant["email"],
        'phone' => $consultant["telephone"],
    );
}