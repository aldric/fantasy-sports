<div class="bk-box">
    <?php foreach ($data as $bookie) : $i = 1; ?>
    <div v-for="bank in banks" style="width:250px;" class="mat-card">
    <!-- <div class="top-right">
        <div class="badge-ribbon"></div>
        <div class="box-note"><?php echo $i; ?></div>
        </div> -->
        <div class="flex-container">
            <!-- <div class="bk-center h4"><?php echo $i . '.' . $bookie->name; ?></div> -->
            <div class="bk-img"><img src="<?php echo $bookie->image; ?>" /></div>
            <div class="bk-note">
            <ul class="rating-gold">
                <?php
                $note = $bookie->rating;
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
            <div class="bk-line">
                <span class="h5 <?php echo Helper::get_bg($bookie->live_bets); ?>"><?php echo Helper::get_icon($bookie->live_bets); ?></span>
                <span class="h5">Paris en direct</span>
            </div>
            <div class="bk-line">
                <span class="h5 <?php echo Helper::get_bg($bookie->cashout); ?>"><?php echo Helper::get_icon($bookie->cashout); ?></span>
                <span class="h5">Cashout</span>
            </div>
            <div class="bk-line">
                <span class="h5 <?php echo Helper::get_bg($bookie->streaming); ?>"><?php echo Helper::get_icon($bookie->streaming); ?></span>
                <span class="h5">Matchs en direct</span>
            </div>
            
            <div class="bk-center">
                <a class="btn-mat <?php echo $bookie->aff_link_color; ?>" href="<?php echo $bookie->aff_link; ?>" role="button" target="_blank" rel="nofollow"><?php echo $bookie->aff_text_short; ?></a>
            </div>
            <div class="bk-center">
                <a class="alert-link text-success-2 review-link" href="<?php echo $bookie->review_link; ?>" ><?php echo $bookie->review_text_short; ?></a>
            </div>
        </div>
    </div>
    <?php $i++; endforeach ?>
</div>