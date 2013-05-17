<?php get_header() ?>
<div class="container">
  <div class="row content">
    
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="twelvecol thetitle">
      <h2><?php the_title(); ?></h2>
    </div><!-- .twelvecol -->
    
    <div class="eightcol">

      <?php the_content(''); ?>

      <?php endwhile; endif; ?>

    </div><!-- .eightcol -->
</div><!-- .row content -->
</div><!-- .container -->
      
      
<?php get_footer() ?>
