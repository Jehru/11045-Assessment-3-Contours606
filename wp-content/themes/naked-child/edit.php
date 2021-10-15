<?php //acf_form_head(); 
?>
<?php

/**
 * Template Name: Edit
 */

get_header(); ?>





<!-- ACF CODE, This works? but only for the last possible posts -->

<div id="primary" class="row-fluid">

    <div id="content" role="main" class="span8 offset2">

        <?php /* The loop */ ?>
        <?php while (have_posts()) : the_post();

            //while (have_rows('uc_contours_works_of_art', 74)) : the_row();

        ?>

            <h1><?php the_title(); ?></h1>
            <!-- Testing Edit Posts -->

            <?php the_content(); ?>

            <p>My custom field: <?php
                                // Based on Artwork category and Dawoons Code
                                // $custom_posts = get_posts(array('category', 'artworks')); // Inlcude category Artworks


                                // Create for loop which gets the values
                                // foreach ($custom_posts as $post) : setup_postdata($post);


                                //     // Get the values neccessary for map markers
                                // $lat = get_field('artworks_lat');
                                //     $long = get_field('artworks_long');
                                //     $title = get_field('artworks_title');
                                //     $image = get_field('artworks_image');
                                //     $creator = get_field('artworks_creator');
                                // endforeach;

                                // Based on Repeater Fields
                                // if (have_rows('uc_contours_works_of_art')) :

                                //     // Loop through rows.
                                //     while (have_rows('uc_contours_works_of_art')) : the_row();

                                //         // Load sub field values.
                                //         $title = get_sub_field('title');
                                //         $image = get_sub_field('image');
                                //         $creator = get_sub_field('creator');
                                //         $lat = get_sub_field('latitude');
                                //         $long = get_sub_field('longitude');

                                //     // // echo $lat;
                                //     // // echo $long;

                                //     // // End loop.
                                //     endwhile;
                                // endif;

                                // if (have_rows('uc_contours_works_of_art', 74)) :


                                // the_repeater_field('uc-')
                                // the_sub_field('title');
                                // the_sub_field('image');
                                // the_sub_field('creator');
                                // the_sub_field('latitude');
                                // the_sub_field('longitude');


                                // $categories = get_categories('artworks');

                                // if ($categories) {
                                //     foreach ($categories as $category) {
                                //         echo $category->name;

                                //         $lat = get_field('artworks_lat');
                                //         $long = get_field('artworks_long');
                                //         $title = get_field('artworks_title');
                                //         $image = get_field('artworks_image');
                                //         $creator = get_field('artworks_creator');
                                //         echo $lat;
                                //     }
                                // }


                                ?></p>

            <?php //acf_form(); 
            ?>

        <?php endwhile; ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>