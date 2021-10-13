<?php

/**
 * Template Name: Map Page
 */

get_header(); // This fxn gets the header.php file and renders it 
?>
<!-- Show the default content -->
<div id="primary" class="row-fluid">
    <div id="content" role="main" class="span8 offset2">

        <?php

        // Check if rows exists.
        if (have_rows('uc_contours_works_of_art')) :

            // Loop through rows.
            while (have_rows('uc_contours_works_of_art')) : the_row();

                // Load sub field values.
                $title = get_sub_field('title');
                $image = get_sub_field('image');
                $creator = get_sub_field('creator');

                $lat = get_sub_field('latitude');
                $long = get_sub_field('longitude');

                // echo $lat;
                // echo $long;

                // Store values in array for later on 
                //      These are stored for the map markers
                $locations[] = array($lat, $long, $title, $image, $creator);
            // End loop.
            endwhile;
        endif;
        ?>

        <!-- Show the Map-->
        <div id="mapid"></div>



    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->


<!-- Footer, needs to be placed here manually to give a constistent for loop for the map marker script -->

</main><!-- / end page container, begun in the header -->

<script>
    // Get the time to be able to change the map
    var date = new Date().getHours(); // 22
    console.log(date + ":00 (24 hour time / only hours)");

    // Create map and set center and zoom level
    var map = new L.map("mapid");
    map.setView([-35.235551, 149.08373], 16);

    // Show Day/Night map
    // If its day time show the day map
    if (7 < date && date < 18) {
        console.log("Day Time")
        var mapboxTileUrl =
            "https://api.mapbox.com/styles/v1/jehru/ckuerzmta08qb17loz85yatl4/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamVocnUiLCJhIjoiY2t1ZXJ2aWphMDUxZzJucGhoeThweHFiOCJ9.nrR0xAhCQRjqdYf2ILx1wg";
    } else {
        // Otherwise show the night map
        console.log("Night Time")
        var mapboxTileUrl =
            "https://api.mapbox.com/styles/v1/jehru/ckufaj4xe04ls17lo8lpph3dq/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamVocnUiLCJhIjoiY2t1ZXJ2aWphMDUxZzJucGhoeThweHFiOCJ9.nrR0xAhCQRjqdYf2ILx1wg";
    }

    // Add the url to map and give attribution
    L.tileLayer(mapboxTileUrl, {
        attribution: 'Background map data &copy; <a href="http://openstreetmap.org">Mapbox</a> contributors',
    }).addTo(map);
</script>
<?php

foreach ($locations as $values) {
    // $values 0 = lat 
    // $values 1 = long
    // $values 2 = title 
    // $values 3 = image
    // $values 4 = creator  
?>
    <script>
        // Write the content to an item, this shows the items via the map markers 
        // 		Values 1-5 are the items from the array created above
        // 
        // Still need to figure out where the pages are going to be for the url links
        // 
        var popupContent = "<div class='popup'><img src='<?php echo $values[3] ?>' class='popup-image'><div class='popup-text'> <h4><?php echo $values[2] ?> </h4><p> By <?php echo $values[4] ?> </p><a href=' <?php // echo $values[4] 
                                                                                                                                                                                                                ?> '> See More </a></div></div>";

        marker = new L.marker([<?php echo $values[0] ?>, <?php echo $values[1] ?>])
            .bindPopup(popupContent, {
                maxWidth: 500
            }).addTo(map);
    </script>


<?php
}
?>

<footer class="site-footer">
    <div class="site-info container">

        <!-- <p>Birthed <a href="http://bckmn.com/naked-wordpress" rel="theme">Naked</a>
            on <a href="http://wordpress.org" rel="generator">Wordpress</a>
            by <a href="http://bckmn.com" rel="designer">Joshua Beckman</a> -->
        <!-- </p> -->

        <p> By UC Students Edit this footer when footer content is decided</p>

    </div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>

</html>