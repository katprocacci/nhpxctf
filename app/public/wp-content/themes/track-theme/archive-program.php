<?php

get_header(); 
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone'
));
?>

<ul class="link-list min-list">

<div class="container container--narrow page-section">
  <?php 
    while(have_posts()) {
      the_post(); ?>
        <li><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php }
    echo paginate_links();
  ?>

</ul>

</div>

<?php
get_footer();
?>