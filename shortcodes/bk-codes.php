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


function get_data_and_render($template, $atts) {
    $a = shortcode_atts(array(
        'bookies' => '',
    ), $atts);
    $bookies_input = $a['banks'];
    $repository = new Bookmaker_Repository();
    $data = $repository->get_bookmakers_data($bookies_input);
    return ViewRenderer::render($template, $data);
}