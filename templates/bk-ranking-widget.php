
<aside class="bk-widget">
<h3 class="widget-title"><span><?php echo $data->widget_title; ?></span></h3>
    <div class="mat-card">
        <div class="bk-img"><img src="<?php echo $data->image; ?>" /></div>
        <div class="bk-note">
        <ul class="rating-gold">
            <?php
            $note = $data->rating;
            while (0.5 < $note) {
                $note--;
                echo '<li style="display: inline;"><i class="fa fa-star fa-3x" ></i></li>';
            }
            if ($note == 0.5) {
                echo '<li style="display: inline;"><i class="fa fa-star-half-o fa-3x"></i></li>';
            }
            ?>
        </ul>
        </div>
        <div class="bk-line"><span class="h5"><?php echo $data->bonus_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->bonus; ?></span></div>
        <div class="bk-line"><span class="h5"><?php echo $data->bonus_type_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->bonus_type; ?></span></div>
        <div class="bk-line"><span class="h5"><?php echo $data->first_deposit_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->first_deposit; ?></div>
        <div class="bk-line"><span class="h5"><?php echo $data->odds_label; ?></span>
            <span class="h5 rating-gold">
                <?php for ($x = 0; $x < $data->odds; $x++) { ?>
                    <i class="fa fa-eur fa-2x" aria-hidden="true"></i>
                <?php 
            } ?>
            </span>
        </div>
        <div class="bk-line"><span class="h5"><?php echo $data->min_withdraw_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->min_withdraw; ?></span></div>
        <div class="bk-line"><span class="h5"><?php echo $data->min_bet_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->min_bet; ?></span></div>
        <div class="bk-line">
            <span class="h5">Paris en direct</span>
            <span class="h4 <?php echo Helper::get_bg($data->live_bets); ?>"><?php echo Helper::get_icon($data->live_bets); ?></span>
        </div>
       <div class="bk-line">
           <span class="h5">Cashout</span>
           <span class="h4 <?php echo Helper::get_bg($data->cashout); ?>"><?php echo Helper::get_icon($data->cashout); ?></span>
       </div>
      <div class="bk-line">
           <span class="h5">Matchs en direct</span>
           <span class="h4 <?php echo Helper::get_bg($data->streaming); ?>"><?php echo Helper::get_icon($data->streaming); ?></span>
       </div>
        <div class="bk-line">
            <span class="h5"><?php echo $data->apps_label; ?></span>
            <span>
            <?php
            if ($data->ios) {
                echo Helper::get_mobile_icon('ios');
            }

            if ($data->android) {
                echo Helper::get_mobile_icon('android');
            }

            if ($data->windows) {
                echo Helper::get_mobile_icon('windows');
            } ?>

            </span>
         </div>
      
        <div class="bk-center">
            <a class="btn-mat orange" href="<?php echo $data->aff_link; ?>" role="button" target="_blank" rel="nofollow"><?php echo $data->aff_text_long; ?></a>
        </div>
       
       
        <?php if ($data->arjel_licence) { ?>
        <div class="arjel-logo"></div>
        <?php 
    } ?>
    </div>
</aside>
<?php if ($data->fantasy_league) { ?>
<aside class="bk-widget">
  <h3 class="widget-title"><span><?php echo $data->widget_title_fl; ?></span></h3>
  <div class="mat-card">
    <div class="bk-center h3"><?php echo $data->fl_name; ?></div>
    <div class="bk-note">
        <ul class="rating-gold">
            <?php
            $note = $data->rating_fl;
            while (0.5 < $note) {
                $note--;
                echo '<li style="display: inline;"><i class="fa fa-star fa-3x" ></i></li>';
            }
            if ($note == 0.5) {
                echo '<li style="display: inline;"><i class="fa fa-star-half-o fa-3x"></i></li>';
            }
            ?>
        </ul>
        </div>
    <div class="bk-center h4"><img src="<?php echo $data->fl_image; ?>"></img></div>
    <div class="bk-line"><span class="h5"><?php echo $data->bonus_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->bonus; ?></span></div>
    <div class="bk-line"><span class="h5"><?php echo $data->bonus_type_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->bonus_type; ?></span></div>
    <div class="bk-line"><span class="h5"><?php echo $data->fl_buyin_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->fl_buyin; ?></span></div>
    <div class="bk-line"><span class="h5"><?php echo $data->fl_maxgain_label; ?></span><span class="h4 bl text-success-2"><?php echo $data->fl_maxgain; ?></span></div>
    <div class="bk-line">
        <span class="h5"><?php echo $data->fl_available_sports_label; ?></span>
        <span class="h4">
            <?php if($data->football) : ?>
              <div class="foot-logo"> </div>
            <?php endif; ?>
            <?php if($data->basketball) : ?>
              <div class="basket-logo"> </div>
            <?php endif; ?>
        </span>
       </div>

    <div class="bk-center"><a class="btn-mat cyan" href="<?php echo $ranking_data->aff_link_fl != null ? $ranking_data->aff_link_fl : $data->aff_link; ?>" role="button" target="_blank" rel="nofollow"><?php echo $data->aff_text_fl_long; ?></a></div>
  </div>    
</aside>
<?php 
} ?>
