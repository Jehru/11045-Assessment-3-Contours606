<?php

/**
 * Template Name: About Page
 */

get_header(); // This fxn gets the header.php file and renders it
?>

<?php

// $test = get_post_meta(get_post_ID(), 'marker_group', true);

$entries = get_post_meta(74, 'marker_group', true);

foreach ((array)$entries as $key => $entry) {

    $title = $content = $url = $lat = $long = '';

    if (isset($entry['title']))
        $title = esc_html($entry['title']);
    if (!empty($title)) {
        echo '<h3>' . $title . '</h3>';
    }

    if (isset($entry['description']))
        $content = $entry['description'];
    if (!empty($content)) {
        echo '<p>' . $content . '</p>';
    }


    if (isset($entry['url']))
        $url = esc_html($entry['url']);
    if (!empty($url)) {
        echo '<a href="' . $url . '"> Link Here</a>';
    }


    if (isset($entry['lat']))
        $lat = esc_html($entry['lat']);
    if (!empty($lat)) {
        echo '<p> Latitude' . $lat . '</p>';
    }

    if (isset($entry['long']))
        $long = esc_html($entry['long']);
    if (!empty($long)) {
        echo '<p> Longitude' . $long . '</p>';
    }

    if (isset($entry['image']))
        $image = esc_html($entry['image']);
    // $image = wp_get_attachment_image(get_post_meta(get_the_ID(), 'image', 1), 'medium');
    if (!empty($image)) {
        // echo '<p> Longitude' . $long . '</p>';
    }

    // $url = wp_get_attachment_image(get_post_meta(get_the_ID(), 'image', 1), 'medium');

    $locations[] = array($title, $lat, $long, $content, $url, $image);
}


?>

<?php get_footer();
?>