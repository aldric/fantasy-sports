<?php

if (!class_exists('DailyGame_Widget')) {
    class DailyGame_Widget extends WP_Widget
    {
        private $repository;
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                'agt_daily_game',
                    /*Widget name will appear in UI*/
                __('AGT DailyGame Widget', 'supermagpro-child'),
                    /*Widget description*/
                array('description' => __('DailyGame', 'supermagpro-child'))
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
            $data = new DailyGameWidget();
            $data->widget_title = get_field('widget_title', $widget_id);
            $data->event_punchline = get_field('event_punchline', $widget_id);
            $data->event_date = get_field('event_date', $widget_id);
            $data->team_left = get_field('team_left', $widget_id);
            $data->team_right = get_field('team_right', $widget_id);
            $data->affiliate_link = get_field('affiliate_link', $widget_id);
            $data->affiliate_text = get_field('affiliate_text', $widget_id);

            if (have_rows('odds', $widget_id)) {
                while (have_rows('odds', $widget_id)) {
                    the_row();
                    array_push($data->odds, array(
                        'label' => get_sub_field('odd_label', $widget_id),
                        'value' => get_sub_field('odd_value', $widget_id)
                    ));
                }
            }
            echo ViewRenderer::render('dg-widget.php', $data);
        }
    }

    add_action('widgets_init', function () {
        register_widget('DailyGame_Widget');
    });
}

class DailyGameWidget
{
    public $widget_title;
    public $odds;
    public $event_punchline;
    public $event_date;
    public $team_left;
    public $team_right;
    public $affiliate_link;
    public $affiliate_text;

    public function __construct()
    {
        $this->odds = array();
    }
}
