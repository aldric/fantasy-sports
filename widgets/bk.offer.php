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
            $data = $this->repository->get_bookmakers_data('');
            $data[0]->widget_title = get_field('widget_ranking_title', $widget_id);
            echo ViewRenderer::render('bk-offer-widget.php', $data);
        }
    }

    add_action('widgets_init', function () {
        register_widget('BookmakerOffer_Widget');
    });
}
