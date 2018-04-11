<?php

//[bookmaker-box bookies='betclic|netbet|winamax']
function bkbox_func($atts, $content = null)
{
    return get_data_and_render('bk-box.php', $atts);
}
add_shortcode('bookmaker-box', 'bkbox_func');

//[fantasy-box bookies='betclic|netbet|winamax']
function flbox_func($atts, $content = null)
{
    return get_data_and_render('fl-box.php', $atts);
}
add_shortcode('fantasy-box', 'flbox_func');


function get_data_and_render($template, $atts)
{
    $a = shortcode_atts(array(
        'bookies' => '',
    ), $atts);
    $bookies_input = $a['bookies'];
    $repository = new Bookmaker_Repository();
    $br = $bookies_input == '' ? null : explode("|", $bookies_input);
    $data = $repository->get_bookmakers_data($br);
    usort($data, function($k1, $k2) use($br) {
        return array_search(strtolower($k1->name), $br) > array_search(strtolower($k2->name), $br) ? 1 : -1;
    });
    return ViewRenderer::render($template, $data);
}