<?php
get_header(); 
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'Look at all our actual programss.'
));
?>

<div class="container container--narrow page-section">

  <ul class="link-list min-list">
    <?php

      while(have_posts()) {

        the_post(); ?>

        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        
      <?php
      }
      //This function adds a links to subpage if we will have too much posts on one site
      echo paginate_links();
    ?>
  </ul>

</div>

<?php
get_footer();
?>