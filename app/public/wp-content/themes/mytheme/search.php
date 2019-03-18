<?php
get_header();
pageBanner(array(
  'title' => 'Search Results',
  'subtitle' => 'You searched for &ldquo;' . get_search_query() . '&rdquo;'
));
?>

<div class="container container--narrow page-section">
  <?php
  if(have_posts()){
    while(have_posts()) {

      the_post(); 

      get_template_part('template-parts/content', get_post_type());
    }
    //This function adds a links to subpage if we will have too much posts on one site
    echo paginate_links();
    } else{
      echo '<h2 class="headline headline--small-plus"> No results match that search. </h2>';
    }
    get_search_form();
  ?>
</div>

<?php
get_footer();
?>