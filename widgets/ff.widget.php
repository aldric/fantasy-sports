<?php
setlocale(LC_ALL, 'fr_FR');
if (!class_exists('FantasyFormation_Widget')) {
    class FantasyFormation_Widget extends WP_Widget
    {
        private $repository;
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                'agt_fantasy_formation',
                    /*Widget name will appear in UI*/
                __('AGT FantasyFormation Widget', 'supermagpro-child'),
                    /*Widget description*/
                array('description' => __('FantasyFormation', 'supermagpro-child'))
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
            $should_display = get_field('should_display_fantasy_widget', $post->ID);

            if (!$should_display)
                return '';

            $data = new FantasyFormationWidget();
            $data->widget_title = get_field('widget_title', $widget_id);
            $data->affiliate_link = get_field('affiliate_link', $widget_id);
            $data->affiliate_text = get_field('affiliate_text', $widget_id);
            $data->team_goal_keeper = get_field('team_goal_keeper', $widget_id);

            $players = array();
            if (have_rows('players', $widget_id)) {
                while (have_rows('players', $widget_id)) {
                    the_row();
                    array_push($players, get_sub_field('player', $widget_id));
                }
            }
            $data->team_formation = get_field('team_formation', $widget_id);

            $team_formation = explode('-', $data->team_formation);
            $data->team_one = array_slice($players, 0, $team_formation[0]);
            $data->team_two = array_slice($players, $team_formation[0], $team_formation[1]);
            $data->team_three = array_slice($players, $team_formation[0] + $team_formation[1], $team_formation[2]);

            if (count($team_formation) == 4) {
                $data->team_four = array_slice($players, $team_formation[0] + $team_formation[1] + $team_formation[2], $team_formation[3]);
            }

            echo ViewRenderer::render('ff-widget.php', $data);
        }
    }

    add_action('widgets_init', function () {
        register_widget('FantasyFormation_Widget');
    });
}

class FantasyFormationWidget
{
    public $widget_title;
    public $affiliate_link;
    public $affiliate_text;
    public $team_formation;
    public $team_goal_keeper;
    public $team_one;
    public $team_two;
    public $team_three;
    public $team_four;

    public function __construct()
    {
        $this->team_one = array();
        $this->team_two = array();
        $this->team_three = array();
        $this->team_four = array();
    }
}

