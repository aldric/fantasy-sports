<?php

if (!class_exists('BookmakerOffer_Widget')) {
    class BookmakerOffer_Widget extends WP_Widget
    {
        private $repository;
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                'agt_bookmaker_offer',
                    /*Widget name will appear in UI*/
                __('AGT Bookmaker Offer Widget', 'supermagpro-child'),
                    /*Widget description*/
                array('description' => __('Bookmaker Offer', 'supermagpro-child'))
            );
            $this->repository = new Bookmaker_Repository();
        }

        public function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        public function form($instance)
        {
            echo '<br />';
        }

        public function widget($args, $instance)
        {
            if ($args == null)
                return '';
            $widget_id = 'widget_' . $args['widget_id'];
            global $post;
            if ($post == null)
                return '';

            $bookies = array();
            if (have_rows('bookmakers', $widget_id)) {
                while (have_rows('bookmakers', $widget_id)) {
                    the_row();
                    $bookie = get_sub_field('bookmaker', $widget_id);
                    $image = wp_get_attachment_image_src($bookie->bk_image, 'full')[0];
                    $bonus = $bookie->bk_bonus;
                    $aff_link_color = $bookie->bk_aff_link_color;
                    $aff_link = $bookie->bk_aff_link;
                    $aff_text_short = $bookie->bk_aff_text_short;
                    array_push($bookies, array(
                        'image' => $image,
                        'bonus' => $bonus,
                        'aff_link_color' => $aff_link_color,
                        'aff_link' => $aff_link,
                        'aff_text_short' => $aff_text_short
                    ));
                }
                $data = array(
                    'widget_title' => get_field('widget_title', $widget_id),
                    'bookies' => $bookies
                );
            }
            echo ViewRenderer::render('bk-offer-widget.php', $data);
        }
    }

    add_action('widgets_init', function () {
        register_widget('BookmakerOffer_Widget');
    });
}
