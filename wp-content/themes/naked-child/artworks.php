<?php

/**
 * Template Name: Artworks Page
 */

get_header(); // This fxn gets the header.php file and renders it 
?>


<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php
			while ( have_posts() ) : the_post();

				//the_content();
				?><h2><?php get_field( "title" );?></h2><?php
			?>
			
			<?php global $post; // required
				$args = array('category_name' => 'Artworks'); // include post category Architects
				$custom_posts = get_posts($args);
				foreach($custom_posts as $post) : setup_postdata($post);  
				?><h3><strong><a href='<?php the_permalink(); echo"'>"; the_title(); ?></a></strong></h3><?php
					echo'<div style="min-height:220px;"><p>';
					$images = get_field('artworks_image');
					if (!empty($images)):
						//$images = implode(',',$images);
						$images_arr = explode (",", strval($images));  
						?><img style="float:left; margin-right:100px; height:200px;" src="<?php echo $images_arr[0]; ?>" /><?php
					endif;
					?>

					<p style="font-size: 16px; text-align: left;"><?php the_field( "artworks_information" ); ?></p>
					<?php
					echo"</p><br>";
					echo "</div><br><hr>";
				endforeach;
			endwhile;
			?>
        </div><!-- #content -->
    </div><!-- #primary -->
<?php do_action( 'spacious_after_body_content' ); ?>



<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>
