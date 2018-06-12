<aside>
    <?php if (strlen($data->widget_title) > 0) : ?>    
    <h3 class="widget-title"><span><?php echo $data->widget_title; ?></span></h3>
    <h4 class="widget-subtitle"><?php echo $data->widget_subtitle; ?></span></h4>
    <?php endif; ?>
    <div>
        <div class="mat-card ff-card">
            <div class="fantasy-card">
                <div class="team-display">
                    <div class="team-line">
                        <div class="team-player">
                            <div><?php echo $data->team_goal_keeper; ?></div>
                        </div>
                    </div>
                    <div class="team-line">
                        <?php foreach ($data->team_one as $player) : ?>
                            <div class="team-player">
                                <div><?php echo $player; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="team-line">
                        <?php foreach ($data->team_two as $player) : ?>
                        <div class="team-player">
                            <div><?php echo $player; ?></div>
                        </div>
                        <?php endforeach; ?>    
                    </div>
                    <div class="team-line">
                        <?php foreach ($data->team_three as $player) : ?>
                        <div class="team-player">
                            <div><?php echo $player; ?></div>
                        </div>
                        <?php endforeach; ?>    
                    </div>
                    <?php if (count($data->team_four) > 0) : ?>
                        <div class="team-line">
                            <?php foreach ($data->team_four as $player) : ?>
                            <div class="team-player">
                                <div><?php echo $player; ?></div>
                            </div>
                            <?php endforeach; ?>                            
                        </div>
                    <?php endif; ?>
                    <div class="team-formation">
                        <?php echo $data->team_formation; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="ff-cta">
            <a class="btn-mat btn-small orange" href="<?php echo $data->affiliate_link; ?>" target="_blank" rel="nofollow"><?php echo $data->affiliate_text; ?></a>
        </div>
    </div>
</aside>
