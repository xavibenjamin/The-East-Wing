<?php get_header() ?>

<div class="grid_max">
    
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
    <div class="seven">
    <h2><?php the_title(); ?></h2>
      <?php the_content(''); ?>

      <?php endwhile; endif; ?>

    </div><!-- .seven -->
</div><!-- .grid_max -->
      
      
<?php get_footer() ?>