<?php

get_header(); 
pageBanner(array(
  'title' => 'Past Meets',
  'subtitle' => 'A recap of our season'
));
?>

<div class="container container--narrow page-section">
  <?php 

    $today = date('Ymd');
    $pastMeets = new WP_Query(array(
        'paged' => get_query_var('paged', 1),
        'post_type' => 'meet',
        'meta_key' => 'meet_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
            'key' => 'meet_date',
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric'
            )
        )
        ));

    while($pastMeets->have_posts()) {
      $pastMeets->the_post();
        get_template_part('/template-parts/content-meet');
    }
    echo paginate_links(array(
        'total' => $pastMeets->max_num_pages
    ));
  ?>
</div>

<?php
get_footer();
?>