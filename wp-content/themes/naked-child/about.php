<?php

/**
 * Template Name: About Page
 */

get_header(); // This fxn gets the header.php file and renders it 

?>
<div id="primary" class="row-fluid">
	<div id="content" role="main" class="span8 offset2">

		<?php if (have_posts()) :
			// Do we have any posts/pages in the databse that match our query?
		?>

			<?php while (have_posts()) : the_post();
				// If we have a page to show, start a loop that will display it
			?>

				<article class="post">

					<h1 class="title"><?php the_title(); // Display the title of the page 
										?></h1>


					<?php
					// Get the values from the CMB2 marker group 
					// 		Pass the id from the form page, in this case this is the page
					$entries = get_post_meta(get_the_ID(), 'marker_group', true);

					// Create array value for storing the values 
					$locations = array();

					// For each items inputted 
					foreach ((array)$entries as $key => $entry) {

						// Declare the variables and set them as empty
						$title = $content = $url = $lat = $long = '';

						// If the entry exists create the title
						//		If the value is not empty show it on the page
						if (isset($entry['title']))
							$title = esc_html($entry['title']);
						if (!empty($title)) {
							echo '<h3>' . $title . '</h3>';
						}

						// Do the same as above for the description
						if (isset($entry['description']))
							$content = $entry['description'];
						if (!empty($content)) {
							echo '<p>' . $content . '</p>';
						}

						// Do the same as above for the url
						if (isset($entry['url']))
							$url = esc_html($entry['url']);
						if (!empty($url)) {
							echo '<a href="' . $url . '"> Link Here</a>';
						}

						// Do the same as above for the latitude
						if (isset($entry['lat']))
							$lat = esc_html($entry['lat']);
						if (!empty($lat)) {
							echo '<p> Latitude' . $lat . '</p>';
						}

						// Do the same as above for the longitude
						if (isset($entry['long']))
							$long = esc_html($entry['long']);
						if (!empty($long)) {
							echo '<p> Longitude' . $long . '</p>';
						}

						// Do the same as above for the image
						if (isset($entry['image']))
							$image = esc_html($entry['image']);
						// if (!empty($image)) {
						// echo '<p> Longitude' . $image . '</p>';
						// }

						// Pass all of these values to the locations array (this is used in the map markers)
						$locations[] = array($title, $lat, $long, $content, $url, $image);
					}

					?>

					<div class="the-content">
						<?php the_content();
						// This call the main content of the page, the stuff in the main text box while composing.
						// This will wrap everything in p tags
						?>

						<?php wp_link_pages(); // This will display pagination links, if applicable to the page 
						?>
					</div>
					<!-- the-content -->


					<!-- Add the custom Map ID to the page -->
					<div id="mapid">
					</div>

				</article>

			<?php endwhile; // OK, let's stop the page loop once we've displayed it 
			?>

		<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
		?>

			<article class="post error">
				<h1 class="404"> Nothing posted yet < /h1>
					</ article>

				<?php endif; // OK, I think that takes care of both scenarios (having a page or not having a page to show) 
				?>

	</div>
	<!-- #content .site-content -->
</div>
<!--#primary.content - area-->
<?php //get_footer(); // This fxn gets the footer.php file and renders it 
?>


<!-- Footer directly called on the main page due to the custom JavaScript required to show the map -->
<!-- 		and the map markers  -->

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
	// Prints out the title values
	// echo $values[0];

	// Prints out the latitude values
	// echo $values[1];

	// Prints out the longitude values
	// echo $values[2];

	// echo $values[3];

	// echo $values[4];

	// Show images
	// echo $values[5];
?>

	<script>
		// Write the content to an item, this shows the items via the map markers 
		// 		Values 1-5 are the items from the array created above
		var popupContent = "<div class='popup'><img src='<?php echo $values[5] ?>' class='popup-image'><div class='popup-text'> <h4><?php echo $values[0] ?> </h4><p> <?php echo $values[3] ?> </p><a href=' <?php echo $values[4] ?> '> See More </a></div></div>";

		marker = new L.marker([<?php echo $values[1] ?>, <?php echo $values[2] ?>])
			.bindPopup(popupContent, {
				maxWidth: 500
			}).addTo(map);
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