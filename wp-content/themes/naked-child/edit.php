<?php
/*
Template Name: Edit
*/
?>

<?php
// Use ACF head, for front end forms
// User must be logged in so that 
if (is_user_logged_in() || current_user_can('publish_posts')) { // Execute code if user is logged in
    acf_form_head();
    wp_deregister_style('wp-admin');
}

get_header();
?>
<div id="primary" class="row-fluid">
    <div id="content" role="main" class="span8 offset2">

        <?php
        if (!(is_user_logged_in() || current_user_can('publish_posts'))) {
            echo '<p>You must be logged in to edit this.</p>';
        } else {
            // Get the post id from the url (or somewhere else, doesnt matter though)
            $post_id = $_GET['post-id'];
            // echo $post_id;

            // Show the ar
            // get_field('artworks_title', $post_id);

            // Show each form in the ACF Form as editable options
            //      This then updates it to that post ID and makes sure to show the title and 
            while (have_posts()) : the_post();
                acf_form(array(
                    'post_id' => $post_id,
                    'post_title'    => true,
                    'post_content'  => true,
                    'submit_value'  => ('Update the work of art')
                ));

            endwhile;
        }
        ?>


    </div>
</div>
<?php
get_footer();
?>