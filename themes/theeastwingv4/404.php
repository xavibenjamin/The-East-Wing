<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php get_header() ?>

<div class="grid_max">
    <div class="six left">
      <h2>Aw snap! What happened? This page doesn't exist!</h2>
      <p>Should be something here? <a href="/contact" class="button">Get in touch</a></p>
    </div>
    <div class="five last">
      <img src="<?php bloginfo('template_url'); ?>/img/tim-character.png" />
    </div>  
</div><!-- end .grid_max -->

<?php get_footer(); ?>