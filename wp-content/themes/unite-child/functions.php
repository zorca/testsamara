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
