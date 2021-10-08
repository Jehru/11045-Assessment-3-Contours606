<?php
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// Adding Custom JavaScript. Testing for leaflet js directly injected no plugins
function wpb_hook_javascript()
{
?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <script>
        // function init() {
        //     // create map and set center and zoom level
        //     var map = new L.map("mapid");
        //     map.setView([-35.235551, 149.08373], 16);

        //     var mapboxTileUrl =
        //         "https://api.mapbox.com/styles/v1/jehru/ckufaj4xe04ls17lo8lpph3dq/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamVocnUiLCJhIjoiY2t1ZXJ2aWphMDUxZzJucGhoeThweHFiOCJ9.nrR0xAhCQRjqdYf2ILx1wg";

        //     L.tileLayer(mapboxTileUrl, {
        //         attribution: 'Background map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
        //     }).addTo(map);




        // for (var i = 0; i < planes.length; i++) {
        //     marker = new L.marker([planes[i][1], planes[i][2]])
        //         .bindPopup(planes[i][0])
        //         .addTo(map);
        // }

        <?php
        // $lat = get_field('latitude', 74);
        // $long = get_field('longitude', 74);
        // $title = get_field('title', 74);
        // $artist = get_field('artist', 74);
        // $link = get_field('link', 74);
        // $map = get_field('test', 74);
        ?>
    </script>
<?php
}
add_action('wp_head', 'wpb_hook_javascript');
?>

<?php

// Testing Krappy CMB2
add_action('cmb2_admin_init', 'cmb2_sample_metaboxes');
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes()
{

    $cmb = new_cmb2_box(array(
        'id'            => 'repeater_demo',  // Belgrove Bouncing Castles
        'title'         => 'Repeater Demo',
        'object_types'  => array('page',), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $marker_group_id = $cmb->add_field(array(
        'id'          => 'marker_group',
        'type'        => 'group',
        'repeatable'  => true,
        'options'     => array(
            'group_title'   => 'Post {#}',
            'add_button'    => 'Add Another Post',
            'remove_button' => 'Remove Post',
            'closed'        => true,  // Repeater fields closed by default - neat & compact.
            'sortable'      => true,  // Allow changing the order of repeated groups.
        ),
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Work of Art Title',
        'desc' => 'Enter the post title for the link text.',
        'id'   => 'title',
        'type' => 'text',
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Url to page',
        'desc' => 'Enter the url of the post.',
        'id'   => 'url',
        'type' => 'text_url',
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Brief Desc',
        'description' => 'Write a short description for this entry',
        'id'   => 'description',
        'type' => 'textarea_small',
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Latitude',
        'id'   => 'lat',
        'type' => 'text',
    ));

    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Longitude',
        'id'   => 'long',
        'type' => 'text',
    ));
}
