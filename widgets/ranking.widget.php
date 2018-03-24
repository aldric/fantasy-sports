<?php

if (!class_exists('Ranking_Widget')) {
    class Ranking_Widget extends WP_Widget
    {
        private $repository;
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                'agt_bookmaker_ranking',
                    /*Widget name will appear in UI*/
                __('AGT Bookmaker Ranking Widget', 'supermagpro-child'),
                    /*Widget description*/
                array('description' => __('Bookmaker Ranking', 'supermagpro-child'))
            );
            $this->repository = new Bookmaker_Repository();
        }

        public function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        public function form($instance)
        {
            // $title = esc_attr($instance["title"]);
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
            $current_id = $post->ID;
            $post_object = get_field('bk_linked', $current_id);
            if ($post_object == null) {
                return;
            }

            $data = $this->repository->get_bookmaker_data($post_object->post_name);
            if ($data != null) {
                $data->widget_title = get_field('widget_ranking_title', $widget_id) . ' ' . $data->name;
                $data->widget_title_fl =  get_field('widget_ranking_title_fl', $widget_id) . ' ' . $data->name;
                echo ViewRenderer::render('bk-ranking-widget.php', $data);
            //     $review = new BankReviewJson($data->name,
            //                                  $data->address,
            //                                  $data->image,
            //                                  $data->welcome_offer,
            //                                  $data->affiliate_link,
            //                                  round($data->mean / 20, 2),
            //                                  'Revue de la banque en ligne : '.$data->name,
            //                                  $data->opinion_text,
            //                                  $data->bank_phone);
            //     echo '<script type="text/javascript"> var bankRankingWidget='.json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).';</script>';
            //     echo '<script type = "application/ld+json" >'.$review->toJson().'</script>';
            }
        }
    }

    add_action('widgets_init', function () {
        register_widget('Ranking_Widget');
    });
}
