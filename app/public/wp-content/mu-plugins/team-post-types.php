<?php

function team_post_types() {
    //Campus Post Type
    register_post_type('campus', array(
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));

    //Meet Post Type
    register_post_type('meet', array(
        'capability_type' => 'meet',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'meets'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Meets',
            'add_new_item' => 'Add New Meet',
            'edit_item' => 'Edit Meet',
            'all_items' => 'All Meets',
            'singular_name' => 'Meet'
        ),
        'menu_icon' => 'dashicons-calendar-alt'
    ));

    //Program Post Type
    register_post_type('program', array(
        'supports' => array('title'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    //Coach Post Type
    register_post_type('coach', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'labels' => array(
            'name' => 'Coaches',
            'add_new_item' => 'Add New Coach',
            'edit_item' => 'Edit Coach',
            'all_items' => 'All Coaches',
            'singular_name' => 'Coach'
        ),
        'menu_icon' => 'dashicons-admin-users'
    ));

    //Note Post Type
    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    //Like Post Type
    register_post_type('like', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    ));
}

add_action('init', 'team_post_types');

?>