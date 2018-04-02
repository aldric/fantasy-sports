<?php

if (!class_exists('Bookmaker_Repository')) {
    class Bookmaker_Repository
    {
        public function __construct()
        {
        }

        public function get_bookmaker_data($bookmaker_name)
        {
            $the_query = new WP_Query(array(
                'post_type' => 'fiche_bookmaker',
                'name' => $bookmaker_name,
            ));
            $data;
            if ($the_query->have_posts()) {
                global $post;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    setup_postdata($post);
                    $data = $this->get_ranking_data($post);
                }
                wp_reset_postdata();
            }

            return $data;
        }

        public function get_bookmakers_data($bookies_array)
        {
            $the_query = new WP_Query(array(
                'post_type' => 'fiche_bookmaker',
                'post_name__in' => $bookies_array,
            ));
            $data = array();

            if ($the_query->have_posts()) {
                global $post;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    setup_postdata($post);
                    array_push($data, $this->get_ranking_data($post));
                }
                wp_reset_postdata();
            }

            return $data;
        }

        private function coerse_null_value($value, $default_value)
        {
            return $value == null ? $default_value : $value;
        }

        private function get_ranking_data($p)
        {
            $ranking_data = null;
            if ($p) {
                $id = $p->ID;
                $name = get_field('bk_name', $id);
                $ranking_data = new RankingData($name, $id);

                $ranking_data->image = get_field('bk_image', $id);
                $ranking_data->rating = get_field('bk_rating', $id);
               
                $ranking_data->first_deposit = get_field('bk_first_deposit', $id);
                $ranking_data->first_deposit_label = get_field('bk_first_deposit_label', $id);

                $ranking_data->min_withdraw = get_field('bk_min_wd_amt', $id);
                $ranking_data->min_withdraw_label = get_field('bk_min_wd_amt_label', $id);
                
                $ranking_data->min_bet = get_field('bk_min_bet', $id);
                $ranking_data->min_bet_label = get_field('bk_min_bet_label', $id);

                $ranking_data->bonus = get_field('bk_bonus', $id);
                $ranking_data->bonus_label = get_field('bk_bonus_label', $id);
                
                $ranking_data->bonus_type = get_field('bk_bonus_type', $id);
                $ranking_data->bonus_type_label = get_field('bk_bonus_type_label', $id);
                
                $ranking_data->odds = get_field('bk_odds', $id);
                $ranking_data->odds_label = get_field('bk_odds_label', $id);

                $apps = get_field('bk_mobile_app', $id);
                
                $apps = is_array($apps) ? $apps : array();
                
                $ranking_data->apps_label = get_field('bk_mobile_app_label', $id);
                $ranking_data->ios = array_search('ios', $apps) > -1;
                $ranking_data->android = array_search('android', $apps) > -1;
                $ranking_data->windows = array_search('windows', $apps) > -1;

                $ranking_data->arjel_licence = get_field('bk_arjel_licence', $id);
                $ranking_data->cashout = get_field('bk_cashout', $id);
                $ranking_data->streaming = get_field('bk_streaming', $id);
                $ranking_data->live_bets = get_field('bk_live_bets', $id);
                
                $ranking_data->aff_link = get_field('bk_aff_link', $id);
                $ranking_data->aff_link_color = get_field('bk_aff_link_color', $id);
                $ranking_data->aff_text_long = get_field('bk_aff_text_long', $id);
                $ranking_data->aff_text_short = get_field('bk_aff_text_short', $id);
                
                $ranking_data->review_link = get_field('bk_review_link', $id);
                $ranking_data->review_text_long = get_field('bk_review_text_long', $id);
                $ranking_data->review_text_short = get_field('bk_review_text_short', $id);
                
                $ranking_data->fantasy_league = get_field('bk_fantasy_league', $id);
                $ranking_data->fl_name = $this->coerse_null_value(get_field('bk_fl_name', $id), "");
                $ranking_data->fl_image = $this->coerse_null_value(get_field('bk_fl_image', $id), "");
                
                $ranking_data->rating_fl = get_field('bk_rating_fl', $id);
                $ranking_data->fl_buyin_label = get_field('bk_fl_buyin_label', $id);
                $ranking_data->fl_buyin = get_field('bk_fl_buyin', $id);
                $ranking_data->fl_maxgain_label = get_field('bk_fl_maxgain_label', $id);
                $ranking_data->fl_maxgain = get_field('bk_fl_maxgain', $id);
                $ranking_data->aff_link_fl = get_field('bk_aff_link_fl', $id);
                $ranking_data->aff_link_fl_color = get_field('bk_aff_link_fl_color', $id);
                $ranking_data->aff_text_fl_long = get_field('bk_aff_text_fl_long', $id);
                $ranking_data->aff_text_fl_short = get_field('bk_aff_text_fl_short', $id);
                $ranking_data->fl_available_sports_label = get_field('bk_fl_available_sports_label', $id);

                $sports = get_field('bk_fl_available_sports', $id);
                
                $sports = is_array($sports) ? $sports : array();
                $ranking_data->football = array_search('football', $sports) > -1;
                $ranking_data->basketball = array_search('basketball', $sports) > -1;
            }

            return $ranking_data;
        }
    }

    class RankingData
    {
        public $name;
        public $id;
        public $widget_title;
        public $widget_title_fl;
        public $image;
        public $rating;
        public $first_deposit;
        public $first_deposit_label;
        public $min_withdraw;
        public $min_withdraw_label;
        public $min_bet;
        public $min_bet_label;
        public $bonus;
        public $bonus_label;
        public $bonus_type;
        public $odds;
        public $odds_label;

        public $apps_label;
        public $ios;
        public $android;
        public $windows;

        public $arjel_licence;
        public $cashout;
        public $streaming;
        public $live_bets;

        public $aff_link;
        public $aff_link_color;
        public $aff_text_long;
        public $aff_text_short;
        
        public $review_link;
        public $review_text_long;
        public $review_text_short;

        public $fantasy_league;
        public $fl_name;
        public $fl_image;
        public $fl_buyin_label;
        public $fl_buyin;
        public $fl_maxgain_label;
        public $fl_maxgain;
        public $football;
        public $basketball;
        public $aff_link_fl;
        public $aff_link_fl_color;
        public $aff_text_fl_long;
        public $aff_text_fl_short;

        public function __construct($name, $id)
        {
            $this->name = $name;
            $this->id = $id;
        }
    }
}
