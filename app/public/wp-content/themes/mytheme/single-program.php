<?php
  
  get_header();

  while(have_posts()) {
    the_post(); ?>
    <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

  	<div class="metabox metabox--position-up metabox--with-home-link">
      	<p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main">
      	<?php the_title(); ?> 
    </div>

  	<div class="generic-content"><?php the_content(); ?></div>

    <?php 
          $today = date('Ymd');
          $homepageEvents = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'orderby' => 'meta_value_num', //Thanks for 'orderby', 'meta_key' and 'order' our data will be sort by the newest comming event
            'meta_key' => 'event_date',
            'order' => 'ASC',
            'meta_query' => array( //This query delete a past data
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              ),
              array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )   
            )
          ));
          //This function shows our custom Datas
          while($homepageEvents->have_posts()){
            $homepageEvents->the_post(); ?>
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
                <p><?php 
                //Function to displaying the contents of datas
                if(has_excerpt()){
                  echo get_the_excerpt();
                }else {
                  echo wp_trim_words(get_the_content(), 18);
                } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
              </div>
            </div>
          <?php }
    ?>

   </div>    
  <?php }

  get_footer();

?>