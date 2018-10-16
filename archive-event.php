<?php
/**
 * Template Name: Testimonial Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive 
 */
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop

add_action( 'genesis_loop', 'child_do_custom_loop' );
 
function child_do_custom_loop() {
 
    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args
    $args = array(
        'post_type' => 'event',
        'meta_key'    => '_event_start_date',  // load up the event_date meta
        'orderby'     => 'meta_value',  // sort by the event_date
        'order'       => 'asc',
        'posts_per_page'=> '12',
        'paged'            => $paged,   
        'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
            array(
                'key' => '_event_start_date', // Check the start date field
                'value' => date("Y-m-d"), // Set today's date (note the similar format)
                'compare' => '>=', // Return the ones greater than today's date
                'type' => 'DATE' // Let WordPress know we're working with date
                )
            ),
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}


//add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
function custom_do_grid_loop() { 
 
    $args = array(
    'post_type' => 'event', // enter your custom post type
    'meta_key'    => '_event_start_date',  // load up the event_date meta
    'orderby'     => 'meta_value',  // sort by the event_date
    'order'       => 'asc',   
    'posts_per_page'=> '6', // overrides posts per page in theme settings
    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
        array(
            'key' => '_event-start-date', // Check the start date field
            'value' => date("Y-m-d"), // Set today's date (note the similar format)
            'compare' => '>=', // Return the ones greater than today's date
            'type' => 'DATE' // Let WordPress know we're working with date
            )
        ),
    );
    $loop = new WP_Query( $args );
 if( $loop->have_posts() ):
 
 while( $loop->have_posts() ): $loop->the_post(); global $post;
 echo '<div id="testimonials">';
 echo '<div class="one-fourth first">';
 echo '<div class="quote-obtuse"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
 echo '</div>'; 
 echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
 echo '<h3>' . get_the_title() . '</h3>'; 
 echo '</div>';
 echo '</div>';
 
 endwhile;
 
 endif;

}

/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();