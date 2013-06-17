<?php if (get_field('check_for_sponsor', 'options')) : ?>
  <h2>Sponsored By</h2>
  <div class="ad">
     <a href="<?php the_field('ad_url', 'options'); ?>" target="_blank"><img src="<?php the_field('ad_image', 'options'); ?>" width="150" height="100" /></a>
     <h3><a href="<?php the_field('ad_url', 'options'); ?>" target="_blank"><?php the_field('ad_title', 'options'); ?></a></h3>
     <p><?php the_field('ad_description', 'options'); ?></p>
  </div><!-- .ad -->

<?php else : ?>

  <h2>Sponsored By</h2>
  <div class="ad">
     <a href="http://timlikestoteach.com/"><img src="http://theeastwing.net/wp-content/uploads/2013/03/timlikestoteach_ad.png" width="150" height="100" /></a>
     <h3><a href="http://timlikestoteach.com/">Tim Likes to Teach</a></h3>
     <p>Learn Web Design, Front-End Development and more with Tim Smith.</p>
   </div><!-- .ad -->

<?php endif; ?>
