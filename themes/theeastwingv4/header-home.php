<!DOCTYPE html>
<head>

  <!-- 

  @@@@@@@@@@@@@@@@@  @@@   @@@          @@@ 
  @@@@@@@@@@@@@@@@@  @@@   @@@@        @@@@
         @@@         @@@   @@@ @      @ @@@
         @@@         @@@   @@@  @@  @@  @@@
         @@@         @@@   @@@   @@@    @@@
         @@@         @@@   @@@          @@@
         @@@         @@@   @@@          @@@
         @@@         @@@   @@@          @@@

  How much does a polar bear weigh? Just enough to break the ice.

  Made with love in beautiful Saint Paul, Minnesota.
  The East Wing © 2013 Anythin’ Goes LLC and Timothy B. Smith.

  -->

	<meta charset="utf-8" />
	<meta name="description" content="The East Wing is a podcast brought to you by Tim Smith, that talks with industry experts about design, solving problems and the keys to creating products with value." />
	
  <title><?php if (is_home()) { ?><?php bloginfo('name'); ?> » <?php bloginfo('description'); ?><?php } else { ?><?php wp_title($sep = ''); ?> » <?php bloginfo('name'); ?><?php } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" />

  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	  
  <!-- Global -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/global.css"/> 

  <!-- Typekit Code -->
  <script type="text/javascript" src="//use.typekit.net/ohk1cik.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>  

  <!--WP Generated Header -->
  <?php wp_head(); ?>
  <!--End WP Generated Header -->
  
</head>


<body <?php body_class($class); ?>>

  <?php if (get_field('live_stream', 'options')) : ?>
    <div class="live-banner">
      <div class="contain">
        <div class="recording animated pulse"></div>
        <p>ON AIR: The East Wing #<?php the_field('live_episode_number', 'options'); ?> with Tim Smith - <a href="/live">Listen</a> </p>
      </div>
    </div>

  <?php endif; ?>




<header role="banner">
  <section class="nav-bar">
    <div class="contain">    
      <nav role="navigation" class="header-nav">
        <a href="/">Episodes</a>
        <a href="/contact">Contact</a>
        <a href="/sponsorship">Sponsorship</a>
        <a href="/membership">Membership</a>    
      </nav>
      
      <div class="subscribe-search">
        <ul class="subscribe">
          <li>Subscribe:</li>
          <li><a href="http://itunes.apple.com/us/podcast/the-east-wing/id503801143" target="_blank" class="itunes">
            <span aria-hidden="true" data-icon="i"></span>
            <span class="screen-reader-text">Subscribe on iTunes</span>
          </a></li>
          <li><a href="http://theeastwing.net/feed/podcast" target="_blank" class="rss">
            <span aria-hidden="true" data-icon="r"></span>
            <span class="screen-reader-text">Subscribe via RSS</span>
          </a></li>
        </ul>

        <div class="search-form">
          <?php get_search_form(); ?>
        </div><!-- .search -->
      </div><!-- end .subscribe-search -->

    </div> <!-- end .contain -->
  </section><!-- end .nav-bar -->

  <section class="statement">
    <div class="contain">
      <a href="/" class="logo">The East Wing</a>
    </div> <!-- end .contain -->
  </section><!-- end .statement -->
  
</header>

<section class="alt-description">
  <div class="contain">
    <p>The East Wing is a weekly interview show featuring established and up-and-coming designers, developers, and entrepreneurs.</p>
    <p><small>The East Wing broadcasts live. <a href="/schedule">See the schedule</a></small>.</p>
  </div>
</section>

<section class="guest-sponsor-bar">
  <div class="contain">
      
      <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'sponsors',
        'showposts' => '1'   
      )); 
      ?>

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

      <div class="adspot">
        <h2>Sponsored By</h2>
        <?php the_post_thumbnail(); ?>
        <h3><a href="<?php the_field('ad_url'); ?>"><?php the_title(); ?></a></h3>
        <?php the_content(); ?>
      </div>
      
      <?php wp_reset_postdata(); endwhile; ?>

      <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'upcoming-guests',
        'showposts' => '1'   
      )); 
      ?>

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <div class="guest-info">
          <h2>Next on The East Wing</h2>
          <?php the_post_thumbnail(); ?>
          <h3><a href="<?php the_field('guest_url'); ?>"><?php the_title(); ?></a></h3>
          <p>Airing on: <span><?php $date = DateTime::createFromFormat('Ymd', get_field('air_date')); echo $date->format('F jS, Y'); ?></span></p>
        </div>
      
      <?php wp_reset_postdata(); endwhile; ?>


  </div><!-- end .contain -->
</section>




