<?php

add_action('rest_api_init', 'teamLikeRoutes');

function teamLikeRoutes() {
    register_rest_route('team/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));

    register_rest_route('team/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}

function createLike($data) {
    if (is_user_logged_in()) {
        $coach = sanitize_text_field($data['coachId']);

        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_coach_id',
                    'compare' => '=',
                    'value' => $coach
                )
            )
        ));

        if($existQuery->found_posts == 0 AND get_post_type($coach) == 'coach') {
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => 'Fifth PHP Create Post Test',
                'meta_input' => array(
                    'liked_coach_id' => $coach
                )
            )); 
        } else {
            die("Invalid coach ID");
        }
    } else {
        die("Only logged in users can create a like");
    }
}

function deleteLike($data) {
    $likeId = sanitize_text_field($data['like']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);
        return "Congrats, like deleted";
    } else {
        die("You don't have permission to delete that.");
    }
}