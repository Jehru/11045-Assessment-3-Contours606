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

					// echo $locations[0] . '<br>' . $locations[1] . '<br>' . $locations[2] . '<br>';

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

					<div class="the-content">
						<?php the_content();
						// This call the main content of the page, the stuff in the main text box while composing.
						// This will wrap everything in p tags
						?>

						<?php wp_link_pages(); // This will display pagination links, if applicable to the page 
						?>
					</div>
					<!-- the-content -->


					<!--Adding the custom Map ID-->
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
<?php get_footer(); // This fxn gets the footer.php file and renders it 
?>