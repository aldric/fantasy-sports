<?php
setlocale(LC_ALL, 'fr_FR');
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

            $should_display = get_field('should_display_daily_game_widget', $post->ID);

            if (!$should_display)
                return '';

            $data = new DailyGameWidget();
            $data->widget_title = get_field('widget_title', $widget_id);
            $data->display_as_carousel = get_field('use_carousel', $widget_id);
            $data->carousel_name = get_field('carousel_name', $widget_id);

            if (have_rows('highlighted_events', $widget_id)) {
                while (have_rows('highlighted_events', $widget_id)) {
                    the_row();
                    $evt = get_sub_field('event', $widget_id);
                    $event = new Event();
                    $event->event_name = $evt->event_name;
                    $event->event_logo = $evt->event_logo;
                    $event->event_punchline = $evt->event_punchline;
                    $event->event_date = $evt->date;
                    $event->team_left = $evt->team_left;
                    $event->team_right = $evt->team_right;
                    $event->team_left_logo = $evt->team_left_logo;
                    $event->team_right_logo = $evt->team_right_logo;
                    $event->affiliate_link = $evt->affiliate_link;
                    $event->affiliate_text = $evt->affiliate_text;

                    if (have_rows('odds', $evt)) {
                        while (have_rows('odds', $evt)) {
                            the_row();
                            array_push($event->odds, array(
                                'label' => get_sub_field('odd_label', $evt),
                                'value' => get_sub_field('odd_value', $evt)
                            ));
                        }
                    }
                    array_push($data->events, $event);
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
    public $display_as_carousel;
    public $carousel_name;

    public $events;

    public function __construct()
    {
        $this->events = array();
    }
}

class Event
{
    public $odds;
    public $event_punchline;
    public $event_date;
    public $event_name;
    public $event_logo;
    public $team_left;
    public $team_left_logo;
    public $team_right;
    public $team_right_logo;
    public $affiliate_link;
    public $affiliate_text;
    public function __construct()
    {
        $this->odds = array();
    }
}