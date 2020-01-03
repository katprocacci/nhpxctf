<?php

add_action('rest_api_init', 'teamRegisterSearch');

function teamRegisterSearch() {
    register_rest_route('team/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'teamSearchResults'
    ));
}

function teamSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'coach', 'program', 'campus', 'meet'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'coaches' => array(),
        'programs' => array(),
        'meets' => array(),
        'campuses' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if(get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }

        if(get_post_type() == 'coach') {
            array_push($results['coaches'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }

        if(get_post_type() == 'program') {
            $relatedCampuses = get_field('related_campus');

            if ($relatedCampuses) {
                foreach($relatedCampuses as $campus) {
                    array_push($results['campuses'], array(
                        'title' => get_the_title($campus),
                        'permalink' => get_the_permalink($campus)
                    ));
                }
            }

            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'id' => get_the_id()
            ));
        }

        if(get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if(get_post_type() == 'meet') {
            $meetDate = new DateTime(get_field('meet_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }

            array_push($results['meets'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $meetDate->format('M'),
                'day' => $meetDate->format('d'),
                'description' => $description
            ));
        }
    }

    if ($results['programs']) {
        $programsMetaQuery = array('relation' => 'OR');

        foreach($results['programs'] as $item) {
            array_push($programsMetaQuery, array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '""' . $item['id'] . '""'
            ));
        }
    
        $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('coach', 'meet'),
            'meta_query' => $programsMetaQuery
        ));
    
        while($programRelationshipQuery->have_posts()) {
            $programRelationshipQuery->the_post();

            if(get_post_type() == 'meet') {
                $meetDate = new DateTime(get_field('meet_date'));
                $description = null;
                if (has_excerpt()) {
                    $description = get_the_excerpt();
                } else {
                    $description = wp_trim_words(get_the_content(), 18);
                }
    
                array_push($results['meets'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'month' => $meetDate->format('M'),
                    'day' => $meetDate->format('d'),
                    'description' => $description
                ));
            }
    
            if(get_post_type() == 'coach') {
                array_push($results['coaches'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
            }
        }
    
        $results['coaches'] = array_values(array_unique($results['coaches'], SORT_REGULAR));
        $results['meets'] = array_values(array_unique($results['meets'], SORT_REGULAR));
    }

    if ($results['programs']) {
        $programsMetaQuery = array('relation' => 'OR');

    foreach($results['programs'] as $item) {
        array_push($programsMetaQuery, array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => '"' . $item['id'] . '"'
        ));
    }

    $programRelationshipQuery = new WP_Query(array(
        'post_type' => array('coach', 'meet'),
        'meta_query' => $programsMetaQuery
    ));

    while($programRelationshipQuery->have_posts()) {
        $programRelationshipQuery->the_post();

        if(get_post_type() == 'meet') {
            $meetDate = new DateTime(get_field('meet_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }

            array_push($results['meets'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $meetDate->format('M'),
                'day' => $meetDate->format('d'),
                'description' => $description
            ));
        }

        if(get_post_type() == 'coach') {
            array_push($results['coaches'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }

    }

    $results['coaches'] = array_values(array_unique($results['coaches'], SORT_REGULAR));
    $results['meets'] = array_values(array_unique($results['meets'], SORT_REGULAR));
    }

    return $results;

}