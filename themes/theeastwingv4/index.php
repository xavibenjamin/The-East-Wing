<?php get_header('home'); ?>

<section class="main-content" role="main">
  <div class="contain">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="entry">
        <?php the_post_thumbnail( 'cover-art' ); ?>
        <h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>"><?php the_title();?></a></h2>
        <p class="pubdate"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F jS, Y');?></time></p>
        <?php the_excerpt(); ?>

      </article><!-- .entry -->
    <?php endwhile; endif; ?>
  </div><!-- .contain -->
</section>

<section class="page-navigation">
  <div class="contain">
    <?php wp_pagenavi(); ?>
  </div>
</section>

<?php get_footer(); ?>