<?php
/**
 * Template Name: Events Archive
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
        'post_status' => 'publish',  
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

/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();