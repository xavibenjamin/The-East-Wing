<?php get_header() ?>

  <?php the_post(); ?>

  <h1 class="page-title"><?php the_title(); ?></h1>

  <div class="content">
    <?php the_content(''); ?>
  </div><!-- .content -->

<?php get_footer() ?>
