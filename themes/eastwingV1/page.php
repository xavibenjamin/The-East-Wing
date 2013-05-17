<?php get_header() ?>
<div class="container">
  <div class="row content">
    <div class="eightcol">
      
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php the_content(''); ?>

      <?php endwhile; endif; ?>

    </div><!-- .eightcol -->
</div><!-- .row content -->
</div><!-- .container -->
      
      
<?php get_footer() ?>
