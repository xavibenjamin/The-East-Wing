<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="The East Wing is a podcast brought to you by Tim Smith, that talks with industry experts about design, solving problems and the keys to creating products with value." />
	
  <title><?php if (is_home()) { ?><?php bloginfo('name'); ?> » <?php bloginfo('description'); ?><?php } else { ?><?php wp_title($sep = ''); ?> » <?php bloginfo('name'); ?><?php } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" />

  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	  
  <!-- Responsify -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/global.css"/> 

	<!-- Responsify -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/responsify.css"/>

  <!-- Typekit Code -->
  <script type="text/javascript" src="//use.typekit.net/ohk1cik.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>  

  <!--WP Generated Header -->
  <?php wp_head(); ?>
  <!--End WP Generated Header -->
  
</head>


<body <?php body_class($class); ?>>  
<header>
	<div class="contain">
		<div class="twelve">
			<h1 class="logo"><a href="/">The East Wing</a></h1>

			<div class="description">
			<p>The East Wing is a weekly show that talks about design, user experience, problem solving and the keys to creating products with value. Hosted by <a href="http://ttimsmith.com" target="_blank">Tim Smith</a>.</p>
			</div> <!-- end .description -->
			</div> <!-- end .twelve -->
	</div><!-- end .contain -->
</header>

<div class="navigation">
<div class="contain">
<div class="twelve">
<nav>
  <a href="/about">About</a>
  <a href="/membership">Membership</a>
  <a href="/get-in-touch">Contact</a>
  <a href="/sponsorship">Sponsorship</a>
  <a href="http://itunes.apple.com/us/podcast/the-east-wing/id503801143" target="_blank" class="itunes">Subscribe on iTunes</a>
  <a href="http://theeastwing.net/feed/podcast" target="_blank" class="rss">Subscribe via RSS</a>
</nav>

<div class="search">
  <?php get_search_form(); ?>
</div><!-- .search -->

</div> <!-- end .twelve -->
</div> <!-- end .contain -->
</div> <!-- end .navigation -->


