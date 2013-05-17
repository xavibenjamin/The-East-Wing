<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php get_header() ?>

<div class="container">
  <div class="row">
    <div class="sevencol statement">
      <h2>Aw snap! What happened? This page doesn't exist!</h2>
      <p>Should be something here? <a href="/contact" class="button">Get in touch</a></p>
    </div>
    <div class="fivecol last">
      <img class="right" src="<?php bloginfo('template_url'); ?>/img/tim-character.png" />
    </div>  
  </div>
</div>
