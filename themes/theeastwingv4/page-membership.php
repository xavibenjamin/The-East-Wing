<?php get_header() ?>

  
<section class="main-content" role="main">
  <div class="contain">
    
  <?php the_post(); ?>

      <h2 class="page-title">Become a Member</h2>
      
      <div class="text">
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

      <p><small>The memberships are recurring. However, you can cancel at anytime <a href="https://anythingoes.memberful.com/auth/sign_in">here</a>.</small></p>

    </div><!-- .text -->



  </div><!-- .contain -->
</section>

<?php get_footer() ?>