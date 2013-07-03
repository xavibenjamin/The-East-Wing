<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="The East Wing is a podcast brought to you by Tim Smith, that talks with industry experts about design, solving problems and the keys to creating products with value." />
	
  <title><?php if (is_home()) { ?><?php bloginfo('name'); ?> » <?php bloginfo('description'); ?><?php } else { ?><?php wp_title($sep = ''); ?> » <?php bloginfo('name'); ?><?php } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" />

  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	  
  <!-- Responsify -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/global.css"/> 

	<!-- Responsify -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/responsify.css"/>

  <!-- Typekit Code -->
  <script type="text/javascript" src="//use.typekit.net/ohk1cik.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>  

  <!--WP Generated Header -->
  <?php wp_head(); ?>
  <!--End WP Generated Header -->
  
</head>


<body <?php body_class($class); ?>>




<header role="banner">
  <section class="nav-bar">
    <div class="contain">    
      <nav role="navigation" class="header-nav">
        <a href="/">Episodes</a>
        <a href="/get-in-touch">Contact</a>
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

      <div class="description">
        <p>The East Wing is a weekly show that talks about design, user experience, problem solving and the keys to creating products with value.</p>
      </div> <!-- end .description -->
    </div> <!-- end .contain -->
  </section><!-- end .statement -->
  
</header>




