<?php get_header(); ?>
  <?php the_post(); ?>

  <h1 class="page-title"><?php the_title(); ?></h1>

  <div class="content">
    <p>Have a question for the show, or guest, or in general? Use the form below. If you're interested in sponsoring the show, please consult the <a href="/sponsorship">Sponsorship page</a>.</p>

    <?php gravity_form('Contact Form', false, false, false, '', true); ?>


  </div><!-- .content -->

<?php get_footer(); ?>
