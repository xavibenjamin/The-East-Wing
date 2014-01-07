<?php get_header() ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <article class="entry">

        <h2><?php the_title();?> <small>Episode #<?php the_field('episode_number'); ?></small></h2>
        <p class="pubdate"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F jS, Y');?></time>

        <?php
          $connected = new WP_Query( array(
            'connected_type' => 'EastWing_to_OffAir',
            'connected_items' => get_queried_object(),
            'nopaging' => true,
            ));

          if ($connected->have_posts() ) : $connected->the_post(); ?>

          &middot; <a href="<?php the_permalink(); ?>">Listen to Parent Episode</a>

          <?php wp_reset_postdata(); endif; ?>

        </p>
        <?php the_content(); ?>

      </article>


    <?php endwhile; endif; ?>


<?php get_footer() ?>
