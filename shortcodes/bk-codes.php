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
        'alt' => '',
    ), $atts);
    $bookies_input = $a['bookies'];
    $alts_input = $a['alt'];
    $repository = new Bookmaker_Repository();
    $br = $bookies_input == '' ? null : explode("|", $bookies_input);
    $al = $alts_input == '' ? null : explode("|", $alts_input);

    $data = $repository->get_bookmakers_data($br);
    usort($data, function ($k1, $k2) use ($br) {
        return array_search(strtolower($k1->name), $br) > array_search(strtolower($k2->name), $br) ? 1 : -1;
    });
    return ViewRenderer::render($template, $data);
}

/*
[pronos headerDate="Date et heure" headerComp="Compétitions" headerMatch="Match" headerProno="Notre prono foot" headerBet="Pariez"]
  [prono date="01/01/2018" time="20h" comp="/images/football/competitions/small/7.png" alt="alt 01" team1="OM" team2="PSG" one="1.36" x="5" two="2.6" choice="x" link="http://netbet.fr/best-odds/qff?id=123456" linkText="plop !"]
   [prono date="01/01/2018" time="20h" comp="/images/football/competitions/small/7.png" alt="alt 02" team1="OM" team2="PSG" one="1.36" x="5" two="2.6" choice="x" link="http://netbet.fr/best-odds/qff?id=123456" linkText="Pariez !" ]
  ...
  ...
[/pronos] 
 */
function pronos_func($atts, $content = null)
{
    $a = shortcode_atts(array(
        'headerdate' => '',
        'headercomp' => '',
        'headermatch' => '',
        'headerprono' => '',
        'headerbet' => ''
    ), $atts);
    $output = '<div class="f-table"><div class="f-table-row f-table-header">';
    $output .= $a['headerdate'] != '' ? '<div class="f-table-row-item"><div class="h6">' . $a['headerdate'] . '</div></div>' : '';
    $output .= $a['headercomp'] != '' ?  '<div class="f-table-row-item"><div class="h6">' . $a['headercomp'] . '</div></div>': '';
    $output .= $a['headermatch'] != '' ?  '<div class="f-table-row-item"><div class="h6">' . $a['headermatch'] . '</div></div>': '';
    $output .= $a['headerprono'] != '' ?  '<div class="f-table-row-item"><div class="h6">' . $a['headerprono'] . '</div></div>': '';
    $output .= $a['headerbet'] != '' ?  '<div class="f-table-row-item"><div class="h6">' . $a['headerbet'] . '</div></div>': '';
    $output .= '</div>';

    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('pronos', 'pronos_func');

function prono_func($atts, $content = null)
{
    $a = shortcode_atts(array(
        'date' => '30/05/2018',
        'time' => '21h00',
        'comp' => '/images/football/competitions/small/20.png',
        'alt' => 'alt text',
        'team1' => 'Olympique de Marseille',
        'team2' => 'Paris Saint Germain',
        'one' => '',
        'x' => '',
        'two' => '',
        'choice' => '',
        'link' => 'about:blank',
        'linkText' => 'Pariez !!'

    ), $atts);
    $oneClass = $a['choice'] == 'one' ? 'primary' : '';
    $xClass = $a['choice'] == 'x' ? 'primary' : '';
    $twoClass = $a['choice'] == 'two' ? 'primary' : '';

    $content = '<div class="f-table-row">';
    $content .= '<div class="f-table-row-item"><div class="h5">' . $a['date'] . ' ' . $a['time'] . '</div></div>';
    $content .= '<div class="f-table-row-item"><div><img src="' . $a['comp'] . '" alt="' . $a['alt'] . '" /></div></i</div></div>';
    $content .= '<div class="f-table-row-item"><div class="h5"><div class="' . $oneClass . '-c" >' . $a['team1'] . '</div><div class="' . $twoClass . '-c" >' . $a['team2'] . '</div></div></div>';
    $content .= $a['one'] != '' ? '<div class="f-table-row-item"><div><span class="btn-floating btn-odd ' . $oneClass . '">' . $a['one'] . '</span>' : '';
    $content .= $a['x'] != '' ? '<span class="btn-floating btn-odd ' . $xClass . '">' . $a['x'] . '</span>' : '';
    $content .= $a['two'] != '' ? '<span class="btn-floating btn-odd ' . $twoClass . '">' . $a['two'] . '</span></div></div>' : '';
    $content .= '<div class="f-table-row-item"><div><a class="btn-mat btn-small orange" href="' . $a['link'] . '" role="button" target="_blank" rel="nofollow">' . $a['linkText'] . '</a></div></div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('prono', 'prono_func');
//<span class="btn-floating btn-odds primary">
//http://inlehmansterms.net/2014/10/11/responsive-tables-with-flexbox/
//https://developer.mozilla.org/fr/docs/Web/CSS/attr
                
