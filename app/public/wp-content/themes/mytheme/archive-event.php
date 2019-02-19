<?php
get_header(); 
?>
    
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
     <h1 class="page-banner__title">All Events</h1>
      <div class="page-banner__intro">
        <p>Look at My new Events</p>
    </div>
  </div>  
</div>

<div class="container container--narrow page-section">
  <?php

    while(have_posts()) {

      the_post(); ?>

      <div class="event-summary">
              <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php 
                  // This part of code using custom fields and DataTime() to create a date format adapted to our needs
                  // Get RAW date
                  $the_event_date = get_field( 'event_date', false, false );
                  // THEN create object
                  $the_event_date = new DateTime( $the_event_date );
                  echo $the_event_date->format( 'M' );
                ?></span>
                <span class="event-summary__day"><?php echo $the_event_date->format( 'd' ); ?></span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
              </div>
            </div>

    <?php
    }
    //This function adds a links to subpage if we will have too much posts on one site
    echo paginate_links();
  ?>

  <hr class="section-break">

  <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events archive.</a></p>
</div>

<?php
get_footer();
?>