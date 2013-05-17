<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="The East Wing is a podcast brought to you by Tim Smith, that talks with industry experts about design, solving problems and the keys to creating products with value." />
	
  <title><?php if (is_home()) { ?><?php bloginfo('name'); ?> » <?php bloginfo('description'); ?><?php } else { ?><?php wp_title($sep = ''); ?> » <?php bloginfo('name'); ?><?php } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" />
	
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/1140.css" type="text/css" media="screen" />
	
	<!-- Adaptive Styles -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/styles.css" type="text/css" media="screen" />
	
	<!-- My styles -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>"/>
  
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/css3-mediaqueries.js"></script>
	
	<script src="<?php bloginfo('template_url'); ?>/js/audiojs/audio.min.js"></script>
	
	<script>
    audiojs.events.ready(function() {
      var as = audiojs.createAll();
    });
  </script>

  <!--WP Generated Header -->
  <?php wp_head(); ?>
  <!--End WP Generated Header -->
  
</head>


<body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  
<header id="banner">
<div class="container">
  <div class="row header">
    <div class="sixcol">
      <h1 class="logo"><a href="/">Laugh If You Want Too</a></h1>
    </div>
    
    <div class="sixcol last banner-statement">
      <p>The East Wing is a podcast brought to you by <a href="http://timothybsmith.com" target="_blank">Tim Smith</a>. It talks with industry experts about design, solving problems and the keys to creating products with value.</p>
      
      <p><a href="http://itunes.apple.com/us/podcast/the-east-wing/id503801143" target="_blank" class="button">Subscribe on iTunes</a></p>
    </div> 
    
  </div> <!-- end .row .header--> 
</div> <!-- end .container -->
</header>

<div id="nav">
  <div class="container">
    <div class="row">
      <ul class="navigation">
        <?php wp_list_pages('title_li=');?>
      </ul>
    </div><!-- .row -->
  </div>  <!-- end .container -->
</div> <!-- end #nav -->

<div id="linen">
  <div class="container">
    <div class="row">
      <div class="eightcol">
        <ul class="subscribe">
          <li><a href="http://feeds.feedburner.com/eastwingpodcast" target="_blank">Subscribe via RSS</a></li>
          <li class="tweet"><a href="https://twitter.com/#!/the_eastwing" target="_blank">Follow on Twitter</a></li>
          <li class="email"><a href="http://eepurl.com/iOmuP" target="_blank">Sign Up for the Newsletter</a>
        </ul><!-- end .subscribe -->
      </div><!-- .eightcol -->
    </div><!-- .row -->
  </div><!-- .container -->
</div><!-- #linen -->
