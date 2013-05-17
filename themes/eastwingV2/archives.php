<?php
/*
Template Name: Archives
*/
get_header()?>

<?php		
$recentposts = get_posts('');
foreach ($recentposts as $post) :
   setup_postdata($post); ?>    
   
<div class="container">
  <div class="row">
    <div class="eightcol content">
      <h2><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


      <?php the_excerpt('')?> 
      
      <ul class="meta_info">
          <li><?php the_time('M j, Y');?></li>
          <li><?php the_tags('#', ' #'); ?></li>
        </ul>
      
    </div><!-- .ninecol content --> 
       
  </div><!-- .row -->
</div><!-- .container -->

<?php endforeach; ?>

<div class="container">
  <div class="row">
    <div class="twelvecol">
      <?php next_posts_link('&laquo; Previous Articles') ?> <?php previous_posts_link('Newer Articles &raquo;') ?>
    </div><!-- .twelvecol -->
  </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
