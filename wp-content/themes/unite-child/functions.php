<?php

function database_movies_list( $atts ){
    $movies_list_query = new WP_Query('post_type=movies');
    $output = '<ul>';
    while ( $movies_list_query->have_posts() ) : $movies_list_query->the_post();
        $output .= '<h3><a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) . '">' . get_the_title() . '</a></h3>';
    endwhile;
    $output .= '</ul>';
    wp_reset_query();
    return $output;
}
add_shortcode( 'database-movies-list', 'database_movies_list' );
