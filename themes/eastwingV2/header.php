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
  <img class="hide" src="<?php bloginfo('template_url'); ?>/img/eastwing_podcast_artwork_600.png" />
  
<header id="banner">
  
<div class="container">
  <div class="row header">
    <div class="twelvecol">
      <h1 class="logo"><a href="/">The East Wing</a></h1>
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

<div id="description">
  <div class="container">
    <div class="row">
      <div class="eightcol">
         <p>The East Wing is a weekly show, hosted by <a href="http://timothybsmith.com" target="_blank">Tim Smith</a> &amp; <a href="http://galengidman.com/" target="_blank">Galen Gidman</a>,  that talks about design, user experience problem solving and the keys to creating products with value.</p>
        <ul class="subscribe">
          <li class="itunes"><a href="http://itunes.apple.com/us/podcast/the-east-wing/id503801143" target="_blank">Subscribe on iTunes</a></li>
          <li><a href="http://feeds.feedburner.com/eastwingpodcast" target="_blank">Subscribe via RSS</a></li>
        </ul><!-- end .subscribe -->
      </div><!-- .eightcol -->
    </div><!-- .row -->
  </div><!-- .container -->  
</div><!-- #linen -->
