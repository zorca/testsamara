<?php

/**
 * The CPT functionality of the plugin.
 *
 * @link       https://zorca.org
 * @since      1.0.0
 *
 */

class Movies_Database_Cpt {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    // Register Custom Post Type "movies"
    function custom_post_type_movies() {

        $labels = array(
            'name'                  => _x( 'Фильмы', 'Post Type General Name', 'movies-database' ),
            'singular_name'         => _x( 'Фильм', 'Post Type Singular Name', 'movies-database' ),
            'menu_name'             => __( 'Фильмы', 'movies-database' ),
            'name_admin_bar'        => __( 'Фильм', 'movies-database' ),
            'archives'              => __( 'Архивы фильмов', 'movies-database' ),
            'attributes'            => __( 'Атрибуты фильмов', 'movies-database' ),
            'parent_item_colon'     => __( 'Дочерний фильм:', 'movies-database' ),
            'all_items'             => __( 'Все фильмы', 'movies-database' ),
            'add_new_item'          => __( 'Добавить новый фильм', 'movies-database' ),
            'add_new'               => __( 'Добавить новый', 'movies-database' ),
            'new_item'              => __( 'Новый фильм', 'movies-database' ),
            'edit_item'             => __( 'Редактировать фильм', 'movies-database' ),
            'update_item'           => __( 'Обновить фильм', 'movies-database' ),
            'view_item'             => __( 'Просомтр фильма', 'movies-database' ),
            'view_items'            => __( 'Просмотр фильмов', 'movies-database' ),
            'search_items'          => __( 'Поиск фильма', 'movies-database' ),
            'not_found'             => __( 'Не найдено', 'movies-database' ),
            'not_found_in_trash'    => __( 'Не найдено в корзине', 'movies-database' ),
            'featured_image'        => __( 'Постер фильма', 'movies-database' ),
            'set_featured_image'    => __( 'Установить постер фильма', 'movies-database' ),
            'remove_featured_image' => __( 'Удалить постер фильма', 'movies-database' ),
            'use_featured_image'    => __( 'Использовать как постер фильма', 'movies-database' ),
            'insert_into_item'      => __( 'Вставить', 'movies-database' ),
            'uploaded_to_this_item' => __( 'Загрузить', 'movies-database' ),
            'items_list'            => __( 'Список', 'movies-database' ),
            'items_list_navigation' => __( 'Навигация по списку', 'movies-database' ),
            'filter_items_list'     => __( 'Фильтрация списка', 'movies-database' ),
        );
        $args = array(
            'label'                 => __( 'Фильм', 'movies-database' ),
            'description'           => __( 'Тип записи Фильм', 'movies-database' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-video-alt',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'movies', $args );

    }

    // Register metabox "movie_execution" for "movies"
    function custom_meta_box_movie_execution() {
        add_meta_box('movie_execution', 'Прокат фильма', function($post) {
            wp_nonce_field( basename( __FILE__ ), 'seo_metabox_nonce' );
            $html = '';
            $html .= '<label>Стоимость сеанса <input type="text" name="moviecost" value="' . get_post_meta($post->ID, 'movie_cost',true) . '" /></label> ';
            $html .= '<label>Дата выхода в прокат <input type="text" name="moviedate" value="' . get_post_meta($post->ID, 'movie_date',true) . '" /></label> ';
            echo $html;
        }, 'movies', 'normal', 'high');
    }

    function custom_meta_box_movie_execution_save( $post_id ) {
        if ( !isset( $_POST['seo_metabox_nonce'] ) || !wp_verify_nonce( $_POST['seo_metabox_nonce'], basename( __FILE__ ) ) )
            return $post_id;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
            return $post_id;
        if ( !current_user_can( 'edit_post', $post_id ) )
            return $post_id;
        $post = get_post($post_id);
        if ($post->post_type == 'movies') {
            update_post_meta($post_id, 'movie_cost', esc_attr($_POST['moviecost']));
            update_post_meta($post_id, 'movie_date', $_POST['moviedate']);
        }
        return $post_id;
    }

    // Register Custom Taxonomy "genres"
    function custom_taxonomy_genres() {

        $labels = array(
            'name'                       => _x( 'Жанры', 'Taxonomy General Name', 'movies-database' ),
            'singular_name'              => _x( 'Жанр', 'Taxonomy Singular Name', 'movies-database' ),
            'menu_name'                  => __( 'Жанр', 'movies-database' ),
            'all_items'                  => __( 'Все жанры', 'movies-database' ),
            'parent_item'                => __( 'Родительский жанр', 'movies-database' ),
            'parent_item_colon'          => __( 'Родительский жанр:', 'movies-database' ),
            'new_item_name'              => __( 'Новый жанр', 'movies-database' ),
            'add_new_item'               => __( 'Добавить новый жанр', 'movies-database' ),
            'edit_item'                  => __( 'Редактировать жанр', 'movies-database' ),
            'update_item'                => __( 'Обновить жанр', 'movies-database' ),
            'view_item'                  => __( 'Просмотр жанра', 'movies-database' ),
            'separate_items_with_commas' => __( 'Жанры, разделенные запятыми', 'movies-database' ),
            'add_or_remove_items'        => __( 'Добавить или удалить жанры', 'movies-database' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'movies-database' ),
            'popular_items'              => __( 'Популярные', 'movies-database' ),
            'search_items'               => __( 'Поиск жанров', 'movies-database' ),
            'not_found'                  => __( 'Не найдено', 'movies-database' ),
            'no_terms'                   => __( 'Нет жанров', 'movies-database' ),
            'items_list'                 => __( 'Список жанров', 'movies-database' ),
            'items_list_navigation'      => __( 'Навигация по списку', 'movies-database' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'genres', array( 'movies' ), $args );

    }

    // Register Custom Taxonomy "countries"
    function custom_taxonomy_countries() {

        $labels = array(
            'name'                       => _x( 'Страны', 'Taxonomy General Name', 'movies-database' ),
            'singular_name'              => _x( 'Страна', 'Taxonomy Singular Name', 'movies-database' ),
            'menu_name'                  => __( 'Страна', 'movies-database' ),
            'all_items'                  => __( 'Все страны', 'movies-database' ),
            'parent_item'                => __( 'Родительская страна', 'movies-database' ),
            'parent_item_colon'          => __( 'Родительская страна:', 'movies-database' ),
            'new_item_name'              => __( 'Новая страна', 'movies-database' ),
            'add_new_item'               => __( 'Добавить новую страну', 'movies-database' ),
            'edit_item'                  => __( 'Редактировать страну', 'movies-database' ),
            'update_item'                => __( 'Обновить страну', 'movies-database' ),
            'view_item'                  => __( 'Просмотр страны', 'movies-database' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'movies-database' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'movies-database' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'movies-database' ),
            'popular_items'              => __( 'Популярные', 'movies-database' ),
            'search_items'               => __( 'Search Items', 'movies-database' ),
            'not_found'                  => __( 'Не найдено', 'movies-database' ),
            'no_terms'                   => __( 'Нет стран', 'movies-database' ),
            'items_list'                 => __( 'Items list', 'movies-database' ),
            'items_list_navigation'      => __( 'Items list navigation', 'movies-database' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'countries', array( 'movies' ), $args );

    }

    // Register Custom Taxonomy "years"
    function custom_taxonomy_years() {

        $labels = array(
            'name'                       => _x( 'Годы', 'Taxonomy General Name', 'movies-database' ),
            'singular_name'              => _x( 'Год', 'Taxonomy Singular Name', 'movies-database' ),
            'menu_name'                  => __( 'Год', 'movies-database' ),
            'all_items'                  => __( 'Все годы', 'movies-database' ),
            'parent_item'                => __( 'Parent Item', 'movies-database' ),
            'parent_item_colon'          => __( 'Parent Item:', 'movies-database' ),
            'new_item_name'              => __( 'Новый год', 'movies-database' ),
            'add_new_item'               => __( 'Добавить новый год', 'movies-database' ),
            'edit_item'                  => __( 'Редактировать год', 'movies-database' ),
            'update_item'                => __( 'Обновить год', 'movies-database' ),
            'view_item'                  => __( 'Просмотр года', 'movies-database' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'movies-database' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'movies-database' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'movies-database' ),
            'popular_items'              => __( 'Популярные', 'movies-database' ),
            'search_items'               => __( 'Search Items', 'movies-database' ),
            'not_found'                  => __( 'Не найдено', 'movies-database' ),
            'no_terms'                   => __( 'Нет года', 'movies-database' ),
            'items_list'                 => __( 'Items list', 'movies-database' ),
            'items_list_navigation'      => __( 'Items list navigation', 'movies-database' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'years', array( 'movies' ), $args );

    }

    // Register Custom Taxonomy "actors"
    function custom_taxonomy_actors() {

        $labels = array(
            'name'                       => _x( 'Актеры', 'Taxonomy General Name', 'movies-database' ),
            'singular_name'              => _x( 'Актер', 'Taxonomy Singular Name', 'movies-database' ),
            'menu_name'                  => __( 'Актер', 'movies-database' ),
            'all_items'                  => __( 'Все актеры', 'movies-database' ),
            'parent_item'                => __( 'Parent Item', 'movies-database' ),
            'parent_item_colon'          => __( 'Parent Item:', 'movies-database' ),
            'new_item_name'              => __( 'Новый актер', 'movies-database' ),
            'add_new_item'               => __( 'Добавить нового актера', 'movies-database' ),
            'edit_item'                  => __( 'Редактировать актера', 'movies-database' ),
            'update_item'                => __( 'Обновить актера', 'movies-database' ),
            'view_item'                  => __( 'Просмотр актера', 'movies-database' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'movies-database' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'movies-database' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'movies-database' ),
            'popular_items'              => __( 'Популярные', 'movies-database' ),
            'search_items'               => __( 'Поиск', 'movies-database' ),
            'not_found'                  => __( 'Не найдено', 'movies-database' ),
            'no_terms'                   => __( 'Нет актеров', 'movies-database' ),
            'items_list'                 => __( 'Список актеров', 'movies-database' ),
            'items_list_navigation'      => __( 'Навигация по списку актеров', 'movies-database' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'actors', array( 'movies' ), $args );

    }

}
