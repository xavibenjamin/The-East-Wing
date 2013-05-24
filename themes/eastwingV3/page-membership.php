<?php get_header() ?>

  <div class="grid_max">

    <?php the_post(); ?>

    <div class="seven">
      <h2><?php the_title(); ?></h2>
      <?php the_content(''); ?>

      <table class="memberships">
        <tbody>
          <tr>
            <th>Memberships</th>
            <th>Monthly</th>
            <th>Yearly</th>
          </tr>
          <tr>
            <td><h4>The East Wing Listener</h4></td>
            <td><a href="https://anythingoes.memberful.com/orders/new?subscription=49">$4/month</a></td>
            <td><a href="https://anythingoes.memberful.com/orders/new?subscription=51">$40/year</a></td>
          </tr>
          <tr>
            <td><h4>The East Wing Executive Producer</h4></td>
            <td><a href="https://anythingoes.memberful.com/orders/new?subscription=50">$10/month</a></td>
            <td><a href="https://anythingoes.memberful.com/orders/new?subscription=52">$110/year</a></td>
          </tr>
        </tbody>
      </table>

    </div><!-- .seven -->
  </div><!-- .grid_max -->


<?php get_footer() ?>