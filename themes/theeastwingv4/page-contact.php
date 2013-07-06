<?php get_header(); ?>


<section class="main-content" role="main">
  <div class="contain">
    <?php the_post(); ?>

    <h1 class="page-title"><?php the_title(); ?></h1>

    <div class="text">
      <p>Have a question for the show, or guest, or in general? Use the form below. If you're interested in sponsoring the show, please consult the <a href="/sponsorship">Sponsorship page</a>.</p>
      
      <?php gravity_form('Contact Form', false, false, false, '', true); ?>
  

    </div><!-- .text -->








  </div><!-- .contain -->
</section>

<?php get_footer(); ?>



