<?php get_header() ?>
<div class="container">
  <div class="row content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
    
    <div class="twelvecol thetitle">
      <h2><?php the_title(); ?></h2>
      <ul class="date">
        <li>Posted on <?php the_time('F j, Y');?></li>
      </ul>
    </div><!-- .twelvecol -->
    
      <div class="threecol last right">
        <?php get_sidebar(); ?>
      </div>
    
    <div class="eightcol">     
      <?php the_content('Read More') ?>
      
      
        <ul class="post-nav">
          <li><?php previous_post_link('%link', '&larr;'); ?></li>
          <li><?php next_post_link('%link', '&rarr;'); ?></li>
        </ul>
        
        <div class="share">
          <p><a href="http://twitter.com/home?status=Currently listening to <?php the_permalink(); ?> /via @the_eastwing" title="Share on Twitter" target="_blank">Share on Twitter</a> &middot; <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook" target="blank">Share on Facebook</a></p>
        </div>
      
      <ul class="meta_info">
        <li><?php the_tags('#', ' #'); ?></li>
      </ul>
      
      </div><!-- .eightol -->
 </div><!-- .row content -->
</div><!-- .container -->

<?php endwhile; endif; ?>


<?php get_footer() ?>
