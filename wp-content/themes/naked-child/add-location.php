<?php

/**
 * Template Name: Add-Location
 */


if (is_user_logged_in() || current_user_can('publish_posts')) { // Execute code if user is logged in
    acf_form_head();
    wp_deregister_style('wp-admin');
}
get_header();
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
                    if (!(is_user_logged_in() || current_user_can('publish_posts'))) {
                        echo '<p>You must be a registered author to post.</p>';
                    } else {
                        acf_form(array(
                            'post_id' => 'new_post',
                            'field_groups' => array(280), // ADD CUSTOM FIELDS ID HERE, Local Site is 172. Live Site is 280
                            'post_title' => true, // This will show the title filed
                            'post_content' => true, // This will show the content field
                            'form' => true,
                            'new_post' => array(
                                // 'post_type' => 'books', // For Custom post types
                                // 'label' => 'artworks',
                                'post_status' => 'publish' // You may use other post statuses like draft, private etc.
                            ),
                            'return' => '%post_url%',
                            // 'return' => '%home_url%',
                            'submit_value' => 'Submit Location',
                        ));
                    }
                    ?>

                    <?php wp_link_pages(); // This will display pagination links, if applicable to the page 
                    ?>
    </div><!-- the-content -->

    </article>

<?php endwhile; // OK, let's stop the page loop once we've displayed it 
?>

<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) 
?>

    <article class="post error">
        <h1 class="404">Nothing posted yet</h1>
    </article>

<?php endif; // OK, I think that takes care of both scenarios (having a page or not having a page to show) 
?>

</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
<?php get_footer(); // This fxn gets the footer.php file and renders it 
?>