<?php

/**
 * Template Name: Map Page
 */

get_header(); // This fxn gets the header.php file and renders it 
?>
<!-- Show the default content -->
<div id="primary" class="row-fluid">
    <!-- <div id="content" role="main" class="span8 offset2"> -->
    <div id="content" role="main">


        <?php

        // Doesn't use repeaters
        //      Gets the artworks category
        $custom_posts = get_posts(array('category', 2)); // Inlcude category Artworks

        $locations = array(); // Create locations for markers 

        // Create for loop which gets the values
        foreach ($custom_posts as $post) : setup_postdata($post);

            // Get the values neccessary for map markers
            // $lat = get_field('artworks_lat');
            // $long = get_field('artworks_long');

            $title = get_field('artworks_title');

            // Remove any white space after a title
            $trimmed_title = rtrim($title);

            // For the Url replace the space in a work with a '-' 
            $url_title = str_replace(' ', '-', $trimmed_title);

            $creator = get_field('artworks_creator');

            $image = get_field('artworks_image');
            // If the image is empty, i.e. no value then use a placeholder
            if ($image == '') {
                $image = 'https://www.freeiconspng.com/uploads/no-image-icon-6.png';
            } else {
                $image = get_field('artworks_image');
            }

            // Get the map field and the lat and long from the markers added
            //      Converts the lat and long to strings via strval
            // $map_Loc = get_field('artworks_map');
            // $mapLat = strval($map_Loc['lat']);
            // $mapLong =  strval($map_Loc['lng']);


            $gmaps_field = get_field('artworks_map');
            $gmaps_lat = strval($gmaps_field['lat']);
            $gmaps_lng = strval($gmaps_field['lng']);

            $field_lat = get_field('artworks_lat');
            $field_lng = get_field('artworks_long');

            // If the map marker is not added use the lat and long field inputs
            //      This is the only way to do it via the front end form
            $lat = $gmaps_lat ? $gmaps_lat : $field_lat;
            $lng = $gmaps_lng ? $gmaps_lng : $field_lng;


            // Store them as array, used later on in the script 
            // $locations[] = array($lat, $long, $title, $image, $creator, $url_title);
            $locations[] = array($lat, $lng, $title, $image, $creator, $url_title);


        endforeach;

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

    // https://github.com/Leaflet/Leaflet.fullscreen
    // Adding FullScreen control 
    map.addControl(new L.Control.Fullscreen());

    // Show Day/Night map
    // If its day time show the day map
    if (7 < date && date < 18) {
        console.log("Day Time")
        var mapboxTileUrl =
            "https://api.mapbox.com/styles/v1/foxtails/ckuoon09sl7ta17qiqx2jutib/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZm94dGFpbHMiLCJhIjoiY2t1ajVuNzB6MnVzNzJ4bm5naWkwbTR6cCJ9.fINbH3iNnWVT_8BWWhh3HQ";
    } else {
        // Otherwise show the night map
        console.log("Night Time")
        var mapboxTileUrl =
            "https://api.mapbox.com/styles/v1/foxtails/ckuj7x1dbb2xp18mq9fls6q9n/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZm94dGFpbHMiLCJhIjoiY2t1ajVuNzB6MnVzNzJ4bm5naWkwbTR6cCJ9.fINbH3iNnWVT_8BWWhh3HQ";

        // Create a full fledge night mode
        $('.home').css('background', '#292929');
        $('.home').css('color', '#ffffff');
        $('.site-title a').css('color', '#ffffff')
        $('.page_item a').css('color', '#ffffff')


    }

    // Add the url to map and give attribution
    L.tileLayer(mapboxTileUrl, {
        attribution: ' Background map data &copy; <a href="https://www.mapbox.com/">Mapbox</a> contributors',
    }).addTo(map);
</script>
<?php

// For each location, create a map marker 
foreach ($locations as $values) {
    // $values 0 = lat 
    // $values 1 = long
    // $values 2 = title 
    // $values 3 = image
    // $values 4 = creator  
    // $values 5 = url with no spaces  


?>
    <script>
        // Write the content to an item, this shows the items via the map markers 
        // 		Values 1-5 are the items from the array created above

        var popupContent = "<div class='popup'><img src='<?php echo $values[3] ?>' class='popup-image'><div class='popup-text'> <h4><?php echo $values[2] ?> </h4><p> By <?php echo $values[4] ?> </p><a href=' <?php echo $values[5] ?> '> See More </a></div></div>";

        // var popupContent = "Hi there"

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
        <p>This website was produced by students in the Faculty of Arts & Design, University of Canberra, 2021.</p>
    </div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around. -35.239991 149.08373
?>

</body>

</html>