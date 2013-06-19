<?php get_header() ?>

<div class="grid_max">

  <!-- Insert Ad Code here -->
  <div class="four adspot right">
      <?php get_sidebar(); ?>
  </div>  


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <div class="seven left">

      <h2><?php the_title(); ?></h2>
      <p class="date">Posted on <?php the_time('F j, Y');?></p>
        
      <?php the_content('Read More') ?>
      
      <ul class="meta_info">
        <li><?php the_tags('#', ' #'); ?></li>
        <li><a href="http://twitter.com/home?status=Currently listening to <?php the_permalink(); ?> /via @the_eastwing" title="Share on Twitter" target="_blank">Share on Twitter</a> &middot; <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook" target="blank">Share on Facebook</a></li>
        <li>
          <?php previous_post_link('%link', 'Previous Episode', TRUE); ?>
          <?php if(!get_adjacent_post(true, '', true)) { 
            echo '<span class="inactive">Previous Episode</span>'; 
          } ?>
          &middot;
          <?php next_post_link('%link', 'Next Episode', TRUE); ?>
          <?php if(!get_adjacent_post(true, '', false)) { 
            echo '<span class="inactive">Next Episode</span>'; 
          } ?>
        </li>
      </ul>
    </div> <!-- end .eight -->


<?php endwhile; endif; ?>

</div> <!-- end .grid_max -->


<?php get_footer() ?>
