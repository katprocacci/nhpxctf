<?php

get_header(); 
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is going on in our world.'
));
?>

<div class="container container--narrow page-section">
  <?php 
    while(have_posts()) {
      the_post();
      get_template_part('/template-parts/content-meet');
    }
    echo paginate_links();
  ?>

<hr class="section-break">

<p>Looking for a recap of past meets? <a href="<?php echo site_url('/past-meets') ?>">Check our our past meets archive!</a></p>

</div>

<?php
get_footer();
?>