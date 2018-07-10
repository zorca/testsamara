<?php get_header(); ?>

        <div id="primary" class="content-area col-sm-12 col-md-12">
            <main id="main" class="site-main" role="main">
                <?php
                    $recent_movies_list = wp_get_recent_posts(
                    array(
                    'post_type'   => 'movies',
                    'post_status' => 'publish',
                    'numberposts' => 4,
                    ));

                    $output = '<div class="row">';
                        foreach( $recent_movies_list as $movie ){
                        setup_postdata( $movie );
                        $output .=
                            '<div class="col-sm-6">
                                <div class="movie">
                                    <a href="' . get_permalink($movie['ID'])  . '">
                                        <h4>' . $movie['post_title'] . '</h4>
                                    </a>
                                    <div class="row">
                                        <div class="col-sm-6">'
                                            . get_the_post_thumbnail($movie['ID'], 'medium') .
                                        '</div>
                                        <div class="col-sm-6">
                                            <ul>
                                                <li>Цена билета: '. get_post_meta( $movie['ID'], 'movie_cost' )[0] . ' руб.</li>
                                                <li>Дата выхода: '. get_post_meta( $movie['ID'], 'movie_date' )[0] . '</li>
                                                <li>'. get_the_term_list( $movie['ID'], 'genres', 'Жанры: ', ',', '' ) . '</li>
                                                <li>'. get_the_term_list( $movie['ID'], 'countries', 'Страна: ', ',', '' ) . '</li>
                                                <li>'. get_the_term_list( $movie['ID'], 'years', 'Годы: ', ',', '' ) . '</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        $output .= '</div>';
                    echo $output;
                    wp_reset_postdata();
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->

<?php get_footer(); ?>