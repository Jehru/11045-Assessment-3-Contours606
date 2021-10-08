<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to begin 
	/* rendering the page and display the header/nav
	/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title>
		<?php bloginfo('name'); // show the blog name, from settings 
		?> |
		<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page 
		?>
	</title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php // We are loading our theme directory style.css by queuing scripts in our functions.php file, 
	// so if you want to load other stylesheets,
	// I would load them with an @import call in your style.css
	?>

	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. 
	?>
	<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

	<?php wp_head();
	// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
	// (right here) into the head of your website. 
	// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
	// Move it if you like, but I would keep it around.
	?>


	<script>
		function init() {
			// create map and set center and zoom level
			var map = new L.map("mapid");
			map.setView([-35.235551, 149.08373], 16);

			var mapboxTileUrl =
				"https://api.mapbox.com/styles/v1/jehru/ckufaj4xe04ls17lo8lpph3dq/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamVocnUiLCJhIjoiY2t1ZXJ2aWphMDUxZzJucGhoeThweHFiOCJ9.nrR0xAhCQRjqdYf2ILx1wg";

			L.tileLayer(mapboxTileUrl, {
				attribution: 'Background map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
			}).addTo(map);

			var marker = L.marker([-35.235551, 149.08373]).addTo(map);
			marker.bindPopup(
				'<b>Second Skin</b><br>By Karla Dickens. <a href= "https://www.canberra.edu.au/on-campus/art-collection/the-art-collection/second-skin-by-karla-dickens"> Link Here</a>'
			);
		}
	</script>
</head>

<body onload="init()" <?php body_class();
						// This will display a class specific to whatever is being loaded by Wordpress
						// i.e. on a home page, it will return [class="home"]
						// on a single post, it will return [class="single postid-{ID}"]
						// and the list goes on. Look it up if you want more.
						?>>

	<header id="masthead" class="site-header">
		<div class="container center">

			<nav class="site-navigation main-navigation">
				<?php wp_nav_menu(array('theme_location' => 'primary')); // Display the user-defined menu in Appearance > Menus 
				?>
			</nav><!-- .site-navigation .main-navigation -->
		</div>
		<div class="center">

			<div id="brand">
				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url('/')); // Link to the home page 
								?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); // Title it with the blog name 
											?>" rel="home"><?php bloginfo('name'); // Display the blog name 
															?></a>
				</h1>
				<h4 class="site-description">
					<?php bloginfo('description'); // Display the blog description, found in General Settings 
					?>
				</h4>
			</div><!-- /brand -->

			<div class="clear"></div>
		</div>
		<!--/container -->

	</header><!-- #masthead .site-header -->

	<main class="main-fluid">
		<!-- start the page containter -->