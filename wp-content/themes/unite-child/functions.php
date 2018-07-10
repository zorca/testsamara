<?php

if ( ! function_exists('custom_post_type_movies') ) {

    // Register Custom Post Type "movies"
    function custom_post_type_movies() {

        $labels = array(
            'name'                  => _x( 'Фильмы', 'Post Type General Name', 'testsamara' ),
            'singular_name'         => _x( 'Фильм', 'Post Type Singular Name', 'testsamara' ),
            'menu_name'             => __( 'Фильмы', 'testsamara' ),
            'name_admin_bar'        => __( 'Фильм', 'testsamara' ),
            'archives'              => __( 'Архивы фильмов', 'testsamara' ),
            'attributes'            => __( 'Атрибуты фильмов', 'testsamara' ),
            'parent_item_colon'     => __( 'Дочерний фильм:', 'testsamara' ),
            'all_items'             => __( 'Все фильмы', 'testsamara' ),
            'add_new_item'          => __( 'Добавить новый фильм', 'testsamara' ),
            'add_new'               => __( 'Добавить новый', 'testsamara' ),
            'new_item'              => __( 'Новый фильм', 'testsamara' ),
            'edit_item'             => __( 'Редактировать фильм', 'testsamara' ),
            'update_item'           => __( 'Обновить фильм', 'testsamara' ),
            'view_item'             => __( 'Просомтр фильма', 'testsamara' ),
            'view_items'            => __( 'Просмотр фильмов', 'testsamara' ),
            'search_items'          => __( 'Поиск фильма', 'testsamara' ),
            'not_found'             => __( 'Не найдено', 'testsamara' ),
            'not_found_in_trash'    => __( 'Не найдено в корзине', 'testsamara' ),
            'featured_image'        => __( 'Постер фильма', 'testsamara' ),
            'set_featured_image'    => __( 'Установить постер фильма', 'testsamara' ),
            'remove_featured_image' => __( 'Удалить постер фильма', 'testsamara' ),
            'use_featured_image'    => __( 'Использовать как постер фильма', 'testsamara' ),
            'insert_into_item'      => __( 'Вставить', 'testsamara' ),
            'uploaded_to_this_item' => __( 'Загрузить', 'testsamara' ),
            'items_list'            => __( 'Список', 'testsamara' ),
            'items_list_navigation' => __( 'Навигация по списку', 'testsamara' ),
            'filter_items_list'     => __( 'Фильтрация списка', 'testsamara' ),
        );
        $args = array(
            'label'                 => __( 'Фильм', 'testsamara' ),
            'description'           => __( 'Тип записи Фильм', 'testsamara' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
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
    add_action( 'init', 'custom_post_type_movies', 0 );

}

if ( ! function_exists( 'custom_taxonomy_genres' ) ) {

    // Register Custom Taxonomy "genre"
    function custom_taxonomy_genres() {

        $labels = array(
            'name'                       => _x( 'Жанры', 'Taxonomy General Name', 'testsamara' ),
            'singular_name'              => _x( 'Жанр', 'Taxonomy Singular Name', 'testsamara' ),
            'menu_name'                  => __( 'Жанр', 'testsamara' ),
            'all_items'                  => __( 'Все жанры', 'testsamara' ),
            'parent_item'                => __( 'Родительский жанр', 'testsamara' ),
            'parent_item_colon'          => __( 'Родительский жанр:', 'testsamara' ),
            'new_item_name'              => __( 'Новый жанр', 'testsamara' ),
            'add_new_item'               => __( 'Добавить новый жанр', 'testsamara' ),
            'edit_item'                  => __( 'Редактировать жанр', 'testsamara' ),
            'update_item'                => __( 'Обновить жанр', 'testsamara' ),
            'view_item'                  => __( 'Просмотр жанра', 'testsamara' ),
            'separate_items_with_commas' => __( 'Жанры, разделенные запятыми', 'testsamara' ),
            'add_or_remove_items'        => __( 'Добавить или удалить жанры', 'testsamara' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'testsamara' ),
            'popular_items'              => __( 'Популярные', 'testsamara' ),
            'search_items'               => __( 'Поиск жанров', 'testsamara' ),
            'not_found'                  => __( 'Не найдено', 'testsamara' ),
            'no_terms'                   => __( 'Нет жанров', 'testsamara' ),
            'items_list'                 => __( 'Список жанров', 'testsamara' ),
            'items_list_navigation'      => __( 'Навигация по списку', 'testsamara' ),
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
    add_action( 'init', 'custom_taxonomy_genres', 0 );

}

if ( ! function_exists( 'custom_taxonomy_countries' ) ) {

    // Register Custom Taxonomy
    function custom_taxonomy_countries() {

        $labels = array(
            'name'                       => _x( 'Страны', 'Taxonomy General Name', 'testsamara' ),
            'singular_name'              => _x( 'Страна', 'Taxonomy Singular Name', 'testsamara' ),
            'menu_name'                  => __( 'Страна', 'testsamara' ),
            'all_items'                  => __( 'Все страны', 'testsamara' ),
            'parent_item'                => __( 'Родительская страна', 'testsamara' ),
            'parent_item_colon'          => __( 'Родительская страна:', 'testsamara' ),
            'new_item_name'              => __( 'Новая страна', 'testsamara' ),
            'add_new_item'               => __( 'Добавить новую страну', 'testsamara' ),
            'edit_item'                  => __( 'Редактировать страну', 'testsamara' ),
            'update_item'                => __( 'Обновить страну', 'testsamara' ),
            'view_item'                  => __( 'Просмотр страны', 'testsamara' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'testsamara' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'testsamara' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'testsamara' ),
            'popular_items'              => __( 'Популярные', 'testsamara' ),
            'search_items'               => __( 'Search Items', 'testsamara' ),
            'not_found'                  => __( 'Не найдено', 'testsamara' ),
            'no_terms'                   => __( 'Нет стран', 'testsamara' ),
            'items_list'                 => __( 'Items list', 'testsamara' ),
            'items_list_navigation'      => __( 'Items list navigation', 'testsamara' ),
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
    add_action( 'init', 'custom_taxonomy_countries', 0 );

}

if ( ! function_exists( 'custom_taxonomy_years' ) ) {

    // Register Custom Taxonomy "years"
    function custom_taxonomy_years() {

        $labels = array(
            'name'                       => _x( 'Годы', 'Taxonomy General Name', 'testsamara' ),
            'singular_name'              => _x( 'Год', 'Taxonomy Singular Name', 'testsamara' ),
            'menu_name'                  => __( 'Год', 'testsamara' ),
            'all_items'                  => __( 'Все годы', 'testsamara' ),
            'parent_item'                => __( 'Parent Item', 'testsamara' ),
            'parent_item_colon'          => __( 'Parent Item:', 'testsamara' ),
            'new_item_name'              => __( 'Новый год', 'testsamara' ),
            'add_new_item'               => __( 'Добавить новый год', 'testsamara' ),
            'edit_item'                  => __( 'Редактировать год', 'testsamara' ),
            'update_item'                => __( 'Обновить год', 'testsamara' ),
            'view_item'                  => __( 'Просмотр года', 'testsamara' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'testsamara' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'testsamara' ),
            'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'testsamara' ),
            'popular_items'              => __( 'Популярные', 'testsamara' ),
            'search_items'               => __( 'Search Items', 'testsamara' ),
            'not_found'                  => __( 'Не найдено', 'testsamara' ),
            'no_terms'                   => __( 'Нет года', 'testsamara' ),
            'items_list'                 => __( 'Items list', 'testsamara' ),
            'items_list_navigation'      => __( 'Items list navigation', 'testsamara' ),
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
    add_action( 'init', 'custom_taxonomy_years', 0 );

}

if ( ! function_exists( 'custom_taxonomy_actors' ) ) {

    // Register Custom Taxonomy "actors"
    function custom_taxonomy_actors() {

        $labels = array(
            'name'                       => _x( 'Актеры', 'Taxonomy General Name', 'testsamara' ),
            'singular_name'              => _x( 'Актер', 'Taxonomy Singular Name', 'testsamara' ),
            'menu_name'                  => __( 'Актер', 'testsamara' ),
            'all_items'                  => __( 'Все актеры', 'testsamara' ),
            'parent_item'                => __( 'Parent Item', 'testsamara' ),
            'parent_item_colon'          => __( 'Parent Item:', 'testsamara' ),
            'new_item_name'              => __( 'Новый актер', 'testsamara' ),
            'add_new_item'               => __( 'Добавить нового актера', 'testsamara' ),
            'edit_item'                  => __( 'Редактировать актера', 'testsamara' ),
            'update_item'                => __( 'Обновить актера', 'testsamara' ),
            'view_item'                  => __( 'Просмотр актера', 'testsamara' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'testsamara' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'testsamara' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'testsamara' ),
            'popular_items'              => __( 'Популярные', 'testsamara' ),
            'search_items'               => __( 'Поиск', 'testsamara' ),
            'not_found'                  => __( 'Не найдено', 'testsamara' ),
            'no_terms'                   => __( 'Нет актеров', 'testsamara' ),
            'items_list'                 => __( 'Список актеров', 'testsamara' ),
            'items_list_navigation'      => __( 'Навигация по списку актеров', 'testsamara' ),
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
    add_action( 'init', 'custom_taxonomy_actors', 0 );

}
