<?php get_header(); ?>

  <?php the_post(); ?>

  <h1 class="page-title">Sponsor the Show</h1>

  <div class="content">
    <p>Thanks for your interest in sponsoring The East Wing! We're looking for sponsors whose products or services will really benefit our listeners.</p>

    <h3>The Nitty Gritty</h3>
    <ul>
      <li>The show can have up to two sponsor slots. These are done at the top of the show.</li>
      <li>By sponsoring, you get: a 30&ndash;60 second read at the top of the show, a permanent link in the show notes (which shows up in the RSS feed), and a mention from The East Wing twitter account.</li>
      <li>Each month, The East Wing averages ~20k downloads, and a growing group of people that listen live.</li>
    </ul>
    <p>Fill out the form below, and we'll get back to you as soon as&nbsp;possible!</p>

    <?php gravity_form('Sponsorship', false, false, false, '', true); ?>

  </div><!-- .content -->

<?php get_footer(); ?>

