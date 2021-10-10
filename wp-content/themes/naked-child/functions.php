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
<?php
}
add_action('wp_head', 'wpb_hook_javascript');
?>

<?php

// Testing CMB2
add_action('cmb2_admin_init', 'cmb2_sample_metaboxes');
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes()
{

    $cmb = new_cmb2_box(array(
        'id'            => 'repeater_demo',  // Belgrove Bouncing Castles
        'title'         => 'Contour Map Markers',
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
        'name' => 'Work of Art Title *',
        'desc' => 'Enter the post title for the link text.',
        'id'   => 'title',
        'type' => 'text',
        'required' => 'required',
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
        'name' => 'Latitude *',
        'id'   => 'lat',
        'type' => 'text',
        'required' => 'required',
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name' => 'Longitude *',
        'id'   => 'long',
        'type' => 'text',
        'required' => 'required',
    ));

    $cmb->add_group_field($marker_group_id, array(
        'name'    => 'Upload an image',
        'desc'    => 'Upload an image',
        'id'      => 'image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
        ),
        'preview_size' => 'medium', // Image size to use when previewing in the admin.
    ));
    $cmb->add_group_field($marker_group_id, array(
        'name'    => 'Audio file',
        'desc'    => 'Upload an audio file',
        'id'      => 'audio',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            // 'type' => array(
            //     'image/gif',
            //     'image/jpeg',
            //     'image/png',
            // ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));
}
