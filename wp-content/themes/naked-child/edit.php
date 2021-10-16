<?php
/*
Template Name: edit
*/ ?>
<?php
// Use ACF head, for front end forms
acf_form_head();
get_header();

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
?>
<?php
get_footer();
?>