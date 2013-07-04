<?php get_header(); ?>

<section class="main-content" role="main">
  <div class="contain">
  
  <h2 class="page-title">Latest Off Air Episodes</h2>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="entry">
        <?php the_post_thumbnail( 'cover-art' ); ?>
        <div class="text">
          <p class="pubdate">
            <span class="screen-reader-text">Calendar Icon</span>
            <span class="icon" data-icon="c"></span>
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F jS, Y');?></time>
          </p>
          <h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>">#<?php the_field('episode_number'); ?>: <?php the_title();?></a></h2>
          <?php the_excerpt(); ?>
        </div><!-- .text -->

      </article><!-- .entry -->
    <?php endwhile; endif; ?>
  </div><!-- .contain -->

  <section class="page-navigation">
    <div class="contain">
      <?php wp_pagenavi(); ?>
    </div>
  </section>

</section><!-- .main-content -->



<?php get_footer(); ?>