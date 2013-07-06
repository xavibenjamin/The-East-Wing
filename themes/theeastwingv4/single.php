<?php get_header() ?>

<section class="main-content" role="main">
  <div class="contain">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article class="entry">
        <?php if (the_post_thumbnail( 'cover-art' )) : ?>
            <?php the_post_thumbnail('cover-art'); ?>
        <?php else : ?>
          <img src="http://theeastwing.s3.amazonaws.com/wp-content/uploads/2012/12/eastwing_podcast_artwork_600-265x265.png" alt="The East Wing Podcast Artwork" />
        <?php endif; ?>
        <div class="text">
          <p class="pubdate">
            <span class="screen-reader-text">Calendar Icon</span>
            <span class="icon" data-icon="c"></span>
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F jS, Y');?></time>
          
          <?php
            $connected = new WP_Query( array(
              'connected_type' => 'EastWing_to_OffAir',
              'connected_items' => get_queried_object(),
              'nopaging' => true,
              ));

            if ($connected->have_posts() ) : $connected->the_post(); ?>

            &middot; <a href="<?php the_permalink(); ?>">Listen to the Off Air</a>

            <?php wp_reset_postdata(); endif; ?>
            
          </p>
          <h2><?php the_title();?> <small>Episode #<?php the_field('episode_number'); ?></small></h2>
          <?php the_content(); ?>

          <div class="meta-info">
            
            <h4>Share</h4>
            <ul class="sharing">
              <li>
                <span class="screen-reader-text">Twitter Icon</span>
                <span class="icon twitter" data-icon="t"></span>
                <a href="http://twitter.com/home?status=The East Wing <?php the_field('episode_number');?> with @ttimsmith and <?php the_title(); ?> - <?php the_permalink(); ?>" title="Share on Twitter" target="_blank">Share on Twitter</a>
              </li>
              <li>
                <span class="screen-reader-text">Facebook Icon</span>
                <span class="icon facebook" data-icon="f"></span>
                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook" target="blank">Share on Facebook</a>

              </li>
            </ul>

            <nav class="episode-navigation">
              <?php previous_post_link('%link', 'Previous Episode', TRUE); ?>
              <?php if(!get_adjacent_post(true, '', true)) { 
                echo '<span class="inactive">Previous Episode</span>'; 
              } ?>
              &middot;
              <?php next_post_link('%link', 'Next Episode', TRUE); ?>
              <?php if(!get_adjacent_post(true, '', false)) { 
                echo '<span class="inactive">Next Episode</span>'; 
              } ?>
            </nav>
          </div>

        </div><!-- .text -->
      </article>
      
      
    </div> <!-- end .eight -->


<?php endwhile; endif; ?>   






  </div><!-- .contain -->
</section><!-- .main-content -->


<?php get_footer() ?>
