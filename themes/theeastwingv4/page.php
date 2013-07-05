<?php get_header() ?>

<section class="main-content" role="main">
  <div class="contain">
    
  <?php the_post(); ?>

  <h2 class="page-title"><?php the_title(); ?></h2>
        
    <div class="text">
      <?php the_content(''); ?>


    </div><!-- .text -->
</div><!-- .contain -->
</section>
      
<?php get_footer() ?>