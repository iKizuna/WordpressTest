<div class="event-summary">
  <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
    <span class="event-summary__month"><?php 
      // This part of code using custom fields and DataTime() to create a date format adapted to our needs
  	  // Get RAW date
      $eventDate = get_field( 'event_date', false, false );
      // THEN create object
      $eventDate = new DateTime( $eventDate );
      echo $eventDate->format( 'M' );
    ?></span>
    <span class="event-summary__day"><?php echo $eventDate->format( 'd' ); ?></span>  
  </a>
  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <p><?php 
    //Function to displaying the contents of events
    if(has_excerpt()){
      echo get_the_excerpt();
    }else {
      echo wp_trim_words(get_the_content(), 18);
    } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
  </div>
</div>