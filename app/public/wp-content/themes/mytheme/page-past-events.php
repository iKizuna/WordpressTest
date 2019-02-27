<?php
get_header(); 
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of past events.'
));
?>

<div class="container container--narrow page-section">
  <?php

     $today = date('Ymd');
          $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            'orderby' => 'meta_value_num', //Thanks for 'orderby', 'meta_key' and 'order' our events will be sort by the newest comming event
            'meta_key' => 'event_date',
            'order' => 'ASC',
            'meta_query' => array( //This query delete a past events
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
              )
            )
          ));

    while($pastEvents->have_posts()) {

      $pastEvents->the_post(); 
      get_template_part('template-parts/content-event');
    }
    //This function adds a links to subpage if we will have too much posts on one site
    echo paginate_links(array(
      'total' => $pastEvents->max_num_pages
    ));
  ?>
</div>

<?php
get_footer();
?>