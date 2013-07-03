<?php get_header('home'); ?>


<section class="guest-sponsor-bar">
  <div class="contain">

    <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'upcoming-guests',
        'showposts' => '1'   
      )); 
      ?>

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <div class="guest-info">
          <h2>Next on The East Wing</h2>
          <?php the_post_thumbnail(); ?>
          <h3><a href="<?php the_field('guest_url'); ?>"><?php the_title(); ?></a></h3>
          <p>Airing the week of: <span><?php $date = DateTime::createFromFormat('Ymd', get_field('air_date')); echo $date->format('F jS, Y'); ?></span></p>
        </div>
      
      <?php wp_reset_postdata(); endwhile; ?>

      
      <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'sponsors',
        'showposts' => '1'   
      )); 
      ?>

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

      <div class="adspot">
        <h2>Sponsored By</h2>
        <?php the_post_thumbnail(); ?>
        <h3><a href="<?php the_field('ad_url'); ?>"><?php the_title(); ?></a></h3>
        <p><?php the_content(); ?></p>
      </div>
      
      <?php wp_reset_postdata(); endwhile; ?>


  </div><!-- end .contain -->
</section>

<div class="grid_max">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

<div class="three left entry">
    <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cover-art' ); ?><h2><?php the_title(); ?></h2></a>

    <p class="date">Posted on <?php the_time('F j, Y');?></p>

</div> <!-- end .entry -->
    
<?php endwhile; ?>
<?php endif; ?>

<div class="twelve">
      <?php wp_pagenavi(); ?>
</div><!-- .twelve -->

</div> <!-- end .grid_max -->
<?php get_footer(); ?>