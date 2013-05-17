<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="ninecol">
      <?php wp_pagenavi(); ?>
    </div><!-- .ninecol -->
  </div><!-- .row -->
</div><!-- .container -->

<div class="container">
  <div class="row">
    
    <!-- Insert Ad Code Here -->

    <?php if (have_posts()) : ?>
    
      <?php while (have_posts()) : the_post(); ?>

    <div class="ninecol content">
      <h2><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      <ul class="date">
          <li><?php the_time('F j, Y');?></li>
      </ul>

      <?php the_excerpt('')?>
      
      <ul class="meta_info">
          <li><?php the_tags('#', ' #'); ?></li>
      </ul>
      
    </div><!-- .ninecol content -->
    
<?php endwhile; ?>
<?php endif; ?>

  </div><!-- .row -->
</div><!-- .container -->

<div class="container">
  <div class="row">
    <div class="ninecol">
      <?php wp_pagenavi(); ?>
    </div><!-- .ninecol -->
  </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
