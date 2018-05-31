<div class="bk-box">
    <?php foreach ($data as $bookie) : $i = 1; if (!$bookie->fantasy_league) break; ?>
    <div v-for="bank in banks" style="width:250px;" class="mat-card">
    <!-- <div class="top-right">
        <div class="badge-ribbon"></div>
        <div class="box-note"><?php echo $i; ?></div>
    </div> -->
        <div class="flex-container">
            <div class="bk-center h4"><?php echo $bookie->name; ?></div>
            <div class="bk-img"><img src="<?php echo $bookie->fl_image; ?>" alt="<?php echo 'Logo '.$bookie->fl_name; ?>" /></div>
            <div class="bk-center h4"><?php echo $bookie->fl_name; ?></div>
            <div class="bk-note">
            <ul class="rating-gold">
                <?php
                $note = $bookie->rating_fl;
                while (0.5 < $note) {
                    $note--;
                    echo '<li style="display: inline;"><i class="fa fa-star fa-2x" ></i></li>';
                }
                if ($note == 0.5) {
                    echo '<li style="display: inline;"><i class="fa fa-star-half-o fa-2x"></i></li>';
                }
                ?>
            </ul>
            </div>
            <div class="bk-line"><span class="h5"><?php echo $bookie->bonus_label; ?></span><span class="h4 bl text-success-2"><?php echo $bookie->bonus; ?></span></div>
            <div class="bk-line"><span class="h5"><?php echo $bookie->bonus_type_label; ?></span><span class="h4 bl text-success-2"><?php echo $bookie->bonus_type; ?></span></div>
            <div class="bk-line"><span class="h5"><?php echo $bookie->fl_buyin_label; ?></span><span class="h4 bl text-success-2"><?php echo $bookie->fl_buyin; ?></span></div>
            <div class="bk-line"><span class="h5"><?php echo $bookie->fl_maxgain_label; ?></span><span class="h4 bl text-success-2"><?php echo $bookie->fl_maxgain; ?></span></div>
            <div class="bk-line">
                <span class="h5"><?php echo $bookie->fl_available_sports_label; ?></span>
                <span class="h4">
                    <?php if($bookie->football) : ?>
                    <div class="foot-logo" style="width:32px"> </div>
                    <?php endif; ?>
                    <?php if($bookie->basketball) : ?>
                    <div class="basket-logo" style="width:32px"> </div>
                    <?php endif; ?>
                </span>
            </div>

            <div class="bk-center"><a class="btn-mat <?php echo $bookie->aff_link_fl_color; ?>" href="<?php echo $bookie->aff_link_fl != null ? $bookie->aff_link_fl : $bookie->aff_link; ?>" role="button" target="_blank" rel="nofollow"><?php echo $bookie->aff_text_fl_short; ?></a></div>
            <div class="bk-center">
                <a class="alert-link text-success-2 review-link" href="<?php echo $bookie->review_link; ?>" ><?php echo $bookie->review_text_short; ?></a>
            </div>
        </div>
    </div>
    <?php $i++; endforeach ?>
</div>