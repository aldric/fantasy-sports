
<aside class="bk-offer-widget">
<h3 class="widget-title"><span><?php echo $data['widget_title']; ?></span></h3>
  <?php foreach ($data['bookies'] as $bookie) : ?>
    <div class="mat-card">
        <div class="bk-line">
          <div class="bk-img"><img src="<?php echo $bookie['image']; ?>" /></div>
          <div><span class="h6"><?php echo $bookie['bonus']; ?></span></div>
          <div><a class="btn-mat <?php echo $bookie['aff_link_color'] ?>" href="<?php echo $bookie['aff_link']; ?>" role="button" target="_blank" rel="nofollow"><?php echo $bookie['aff_text_short']; ?></a></div>
        </div>
    </div>    
<?php endforeach; ?>
</aside>
