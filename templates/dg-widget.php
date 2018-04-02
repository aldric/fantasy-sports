
<aside class="daily-games-widget">
<h3 class="widget-title"><span><?php echo $data->widget_title; ?></span></h3>
<div class="mat-card">
    <div class="mat-container">
        <div class="slide-caption">
            <strong><?php echo $data->event_punchline; ?></strong>
            <div class="match-time"><?php echo $data->event_date; ?></div>
        </div>
        <div class="teams">
          <div class="left">
             <div><img src="/fantasy/football-graphics/france/normal/868.png" /></div>
             <div class="team-caption"><?php echo $data->team_left; ?></div>
            </div>
            <div class="right">
              <div><img src="/fantasy/football-graphics/france/normal/866.png" /></div>
              <div class="team-caption"><?php echo $data->team_right; ?></div>
          </div>
        </div>
        <!-- <?php echo $data->affiliate_link; ?>
        <?php echo $data->affiliate_text; ?> -->
        <div style="color:white;">
            <?php foreach($data->odds as $odd) : ?>
             <span> <?php echo $odd['label'].' '.$odd['value']; ?> </span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</aside>