<?php get_header() ?>

  <div class="grid_max">

    <?php the_post(); ?>

    <div class="seven">
      

      <?php if (get_field('live_stream', 'options')) : ?>
        <h2>On Air</h2>
        <p>
          The East Wing #<?php the_field('live_episode_number', 'options'); ?> with Tim Smith<br>
          <strong>Guest:</strong> <?php the_field('live_guest_name', 'options'); ?>
        </p>
      
      <?php if ( is_user_logged_in() ) : ?>
        <p><a href="http://twitter.com/home?status=On Air: The East Wing <?php the_field('live_episode_number', 'options'); ?> with @ttimsmith - <?php the_permalink(); ?>" target="_blank">Tweet</a></p>
      <?php endif; ?>

      <?php else : ?>
      <h2>Previously Recorded</h2>
    
      <p>This show broadcasts live Tuesdays at 2pm US Central time. You can subscribe to the Live Broadcast calendar <a href="/schedule">here</a>.</p>

    <?php endif; ?>

    <audio class="live-audio" autoplay name="media"><source src="http://108.163.197.114:8189/;&lang=en&codec=mp3&volume=75&tracking=false&skin=/ffmp3/ffmp3-mcclean.xml&title=The+East+Wing&jsevents=false&welcome" type="audio/mpeg"></audio>
      
    <iframe src="http://webchat.freenode.net?channels=theeastwing&uio=d4" width="647" height="400"></iframe>



    </div><!-- .seven -->
  </div><!-- .grid_max -->


<?php get_footer() ?>