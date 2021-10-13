<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

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
    echo $values[0];
    echo $values[1];
}

?>

<footer class="site-footer">
    <div class="site-info container">

        <!-- <p>Birthed <a href="http://bckmn.com/naked-wordpress" rel="theme">Naked</a>
            on <a href="http://wordpress.org" rel="generator">Wordpress</a>
            by <a href="http://bckmn.com" rel="designer">Joshua Beckman</a> -->
        <!-- </p> -->

        <p> By UC Students </p>

    </div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>

</html>