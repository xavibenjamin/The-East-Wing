<?php get_header(); ?>

<div class="contain content-header">
  <div class="five left">
    <div class="guest-info">
      <h2>Next on The East Wing</h2>
      <img src="<?php the_field('guest_image', 'options'); ?>" alt="<?php the_field('guest_name', 'options'); ?>"/>
      <h3><a href="<?php the_field('guest_url', 'options'); ?>"><?php the_field('guest_name', 'options'); ?></a></h3>
      <p>Airing the week of: <span><?php $date = DateTime::createFromFormat('Ymd', get_field('air_date', 'options')); echo $date->format('F jS, Y'); ?></span></p>

    </div><!-- end .guest-info -->
  </div><!-- end .twelve -->

  <!-- Insert Ad Code here -->
  <div class="five right adspot">
      <?php get_sidebar(); ?>
  </div>
</div>

<div class="grid_max">
    <?php if ( is_home() ) {
      query_posts($query_string . '&cat=-109, -111');
    } ?>
   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="three left entry">
    <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cover-art' ); ?><h2><?php the_title(); ?></h2></a>

    <p class="date">Posted on <?php the_time('F j, Y');?></p>

</div> <!-- end .entry -->
    
<?php endwhile; endif; ?>

<div class="twelve">
      <?php wp_pagenavi(); ?>
</div><!-- .twelve -->

</div> <!-- end .grid_max -->
<?php get_footer(); ?>