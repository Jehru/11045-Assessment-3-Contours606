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

    <!-- FullScreen -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

<?php
}
add_action('wp_head', 'wpb_hook_javascript');
?>

<?php
// function kv_create_edit_page()
// {

//     $page = get_pages();
//     $edit_page = array('slug' => 'edit-post',    'title' => 'Edit Posts from the front-end');

//     foreach ($pages as $page) {
//         $apage = $page->post_name;
//         switch ($apage) {
//             case 'edit':
//                 $edit_found = '1';
//                 break;
//             default:
//                 $no_page;
//         }
//     }

//     if ($edit_found != '1') {
//         $page_id = wp_insert_post(array(
//             'post_title' => $edit_page['title'],
//             'post_type' => 'page',
//             'post_name' => $edit_page['slug'],
//             'post_status' => 'publish',
//             'post_excerpt' => 'User profile and author page details page ! '
//         ));
//         add_post_meta($page_id, '_wp_page_template', 'kv-edit.php');
//     }
// }
// add_action('admin_init', 'kv_create_edit_page');
// 
?>