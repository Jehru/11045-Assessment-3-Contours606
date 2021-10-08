# 11045-Assessment-3-Contours606

To add a leaflet JS map and custom forms
Download CMB2 Plugin

in functions.php add

```
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

```

In the map page add

```
<?php
    $entries = get_post_meta(get_the_ID(), 'marker_group', true);

    $locations = array();

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

    $locations[] = array($title, $lat, $long);
}

?>

```

Remove the get_footer from the map page and add this to the footer instead

```

<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to finish
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

</main><!-- / end page container, begun in the header -->


<script>
	// create map and set center and zoom level
	var map = new L.map("mapid");
	map.setView([-35.235551, 149.08373], 16);

	var mapboxTileUrl =
		"https://api.mapbox.com/styles/v1/jehru/ckufaj4xe04ls17lo8lpph3dq/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamVocnUiLCJhIjoiY2t1ZXJ2aWphMDUxZzJucGhoeThweHFiOCJ9.nrR0xAhCQRjqdYf2ILx1wg";

	L.tileLayer(mapboxTileUrl, {
		attribution: 'Background map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
	}).addTo(map);
</script>

<?php
foreach ($locations as $values) {
	// Prints out the title values
	// echo $values[0];

	// Prints out the latitude values
	// echo $values[1];

	// Prints out the longitude values
	// echo $values[2];
?>

	<script>
		// for (var i = 0; i < locations.length; i++) {
		marker = new L.marker([<?php echo $values[1] ?>, <?php echo $values[2] ?>])
			.bindPopup('<?php echo $values[0] ?>')
			.addTo(map);
		// }
	</script>

<?php
}
?>

<footer class="site-footer">
	<div class="site-info container">

		<p>Birthed <a href="http://bckmn.com/naked-wordpress" rel="theme">Naked</a>
			on <a href="http://wordpress.org" rel="generator">Wordpress</a>
			by <a href="http://bckmn.com" rel="designer">Joshua Beckman</a>
		</p>

	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website.
// Removing this fxn call will disable all kinds of plugins.
// Move it if you like, but keep it around.
?>

</body>

</html>
```

Now Add some values into the custom fields and see the markers added to the page

Helpful Sources Used in Dev (may need to refer later)
References used in development

Maybe Useful openterrain mapping
https://github.com/openterrain/openterrain/wiki/Terrain-Data

Adding multiple map markers in leafletJS
https://stackoverflow.com/questions/42968243/how-to-add-multiple-markers-in-leaflet-js

Simple LeafletJs tutorial
http://zevross.com/blog/2014/10/28/tips-for-creating-leafleft-js-maps/
Need leaflet id in dom before calling it in script
https://stackoverflow.com/questions/42647735/leaflet-map-container-not-found

CMB2
https://github.com/CMB2/CMB2/wiki/Field-Types#group
https://www.damiencarbery.com/2017/11/demo-of-cmb2-repeater-fields/
https://gist.github.com/carasmo/8c7aa4c6d94517fc4c7d

Passing variables to JS from Php
https://hackthestuff.com/article/how-to-pass-php-variables-to-javascript
https://stackoverflow.com/questions/3045619/how-to-store-values-from-foreach-loop-into-an-array
