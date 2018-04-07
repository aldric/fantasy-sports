<?php 

// register_activation_hook(__FILE__, 'my_activation');

// function my_activation()
// {
//     if (!wp_next_scheduled('get_last_odds_hook')) {
//         wp_schedule_event(time(), 'hourly', 'get_last_odds_hook');
//     }
// }

// add_action('get_last_odds_hook', 'get_them');

// function get_them()
// {
// //http://partner.netbetsport.fr/xmlreports/fluxcotes.xml
// // http://xml.cdn.betclic.com/football_live_frfrfr.xml
// // http://xml.cdn.betclic.com/odds_frfr.xml

//     $file = download_url('http://xml.cdn.betclic.com/odds_frfr.xml');
//     if (!unlink($file)) {
//         echo ("Error deleting $file");
//     } else {
//         echo ("Deleted $file");
//     }
// }

// add_action('cron_request', 'wpse_cron_add_xdebug_cookie', 10, 2);

// /**
//  * Allow debugging of wp_cron jobs
//  *
//  * @param array $cron_request_array
//  * @param string $doing_wp_cron
//  *
//  * @return array $cron_request_array with the current XDEBUG_SESSION cookie added if set
//  */
// function
//     wpse_cron_add_xdebug_cookie($cron_request_array, $doing_wp_cron)
// {
//     if (empty($_COOKIE['XDEBUG_SESSION'])) {
//         return ($cron_request_array);
//     }

//     if (empty($cron_request_array['args']['cookies'])) {
//         $cron_request_array['args']['cookies'] = array();
//     }
//     $cron_request_array['args']['cookies']['XDEBUG_SESSION'] = $_COOKIE['XDEBUG_SESSION'];

//     return ($cron_request_array);
// }

// register_deactivation_hook(__FILE__, 'my_deactivation');

// function my_deactivation()
// {
//     wp_clear_scheduled_hook('my_hourly_event');
// }