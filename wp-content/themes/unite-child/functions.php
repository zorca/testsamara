<?php

function database_movies_list( $atts ){
    $recent_movies_list = wp_get_recent_posts(
        array(
            'post_type'   => 'movies',
            'post_status' => 'publish',
            'numberposts' => 5,
        ));
    $output = '<ul>';
    foreach( $recent_movies_list as $movie ){
        setup_postdata( $movie );
        $output .= '<li><a href="' . get_permalink($movie['ID'])  . '">' . $movie['post_title'] . '</a></li>';
    }
    $output .= '</ul>';
    wp_reset_postdata();
    return $output;
}
add_shortcode( 'database-movies-list', 'database_movies_list' );
