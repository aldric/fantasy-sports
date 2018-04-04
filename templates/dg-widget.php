
<aside class="daily-games-widget">
<h3 class="widget-title"><span><?php echo $data->widget_title; ?></span></h3>
<?php if ($data->display_as_carousel) : ?>
<div class="bxslider <?php echo $data->carousel_name; ?>">
<?php endif; ?>
    <?php foreach ($data->events as $event) : ?>
    <div class="mat-card">
        <div class="mat-container">
            <div class="slide-caption">
                <div><img src="<?php echo $event->event_logo; ?>" /><span><?php echo $event->event_name; ?></span></div>
                <div class="match-time"><?php echo $event->event_date; ?></div>
            </div>
            <div class="teams">
                <div class="left">
                    <div class="team-img"><img src="<?php echo $event->team_left_logo; ?>" /></div>
                    <div class="team-caption"><?php echo $event->team_left; ?></div>
                </div>
                <div class="right">
                    <div class="team-img"><img src="<?php echo $event->team_right_logo; ?>" /></div>
                    <div class="team-caption"><?php echo $event->team_right; ?></div>
                </div>
            </div>
            <div class="slide-footer">
                <?php echo $event->event_punchline; ?>
            </div>
            <div class="odds">
                <?php foreach ($event->odds as $odd) : ?>
                <div> 
                    <div><?php echo $odd['label']; ?></div>
                    <div><a class="btn-mat green odd-value" href="<?php echo $event->affiliate_link; ?>" target="_blank" rel="nofollow"><?php echo $odd['value']; ?></a></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="overlay-b"><div><a class="btn-mat green" href="<?php echo $event->affiliate_link; ?>" target="_blank" rel="nofollow"><?php echo $event->affiliate_text; ?></a></div></div>
        </div>
    </div>
    <?php endforeach; ?>
<?php if ($data->display_as_carousel) : ?>
</div>
<?php endif; ?>

</aside>
<?php if ($data->display_as_carousel) : ?>
<script>
    jQuery(function(){
        jQuery('aside.daily-games-widget <?php echo '.' . $data->carousel_name; ?>').bxSlider({
            auto: true,
            captions:true,
            pager: true,
            speed:500
        });
    });
</script>
<?php endif; ?>