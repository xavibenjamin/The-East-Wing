<?php get_header('home'); ?>


<div class="grid_max">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

<div class="three left entry">
    <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cover-art' ); ?><h2><?php the_title(); ?></h2></a>

    <p class="date">Posted on <?php the_time('F j, Y');?></p>

</div> <!-- end .entry -->
    
<?php endwhile; ?>
<?php endif; ?>

<div class="twelve">
      <?php wp_pagenavi(); ?>
</div><!-- .twelve -->

</div> <!-- end .grid_max -->
<?php get_footer(); ?>