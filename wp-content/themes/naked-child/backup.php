<?php
/*
Template Name: edit
*/
get_header();

if (isset($_GET['post-id'])) {
    $postid = $_GET['post-id'];
}
$post_complete = get_post($postid);

$title = $post_complete->post_title;

$content = $post_complete->post_content;

$attachmen = $post_complete->post_mime_type;

$post_author = $post_complete->post_author;

$auth_id = $current_user->ID;

if (isset($_POST['post_title'])) {
    echo $posttit = $_POST['post_title'];
}
$at_arg = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_parents' => $postid
);
$attachments = get_posts($at_arg);
if ($attachments) {
    foreach ($attachments as $attachment) {
        echo wp_get_attachment_url($attachment, false);
    }
}


if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) &&  $_POST['action'] == "new_post") {

    // Do some minor form validation to make sure there is content
    if (isset($_POST['title'])) {
        $title =  $_POST['title'];
    } else {
        echo 'Please enter the wine name';
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        echo 'Please enter some notes';
    }

    $tags = $_POST['post_tags'];
    $post_cat = $_POST['cat'];
    // ADD THE FORM INPUT TO $new_post ARRAY
    $new_post = array(
        'post_title'    =>    $title,
        'post_content'    =>    $description,
        'post_category' =>   $post_cat,  // Usable for custom taxonomies too
        'tags_input'    =>    array($tags),
        'post_status'    =>    'pending',           // Choose: publish, preview, future, draft, etc.
        'post_type'    =>    'post'  //'post',page' or use a custom post type if you want to
    );

    //SAVE THE POST
    $pid = wp_update_post($new_post);

    //SET OUR TAGS UP PROPERLY
    wp_set_post_tags($pid, $_POST['post_tags']);

    if (isset($_POST['price']))
        update_post_meta($pid, 'price', esc_attr($_POST['price']));

    //REDIRECT TO THE NEW POST ON SAVE
    $link = get_permalink($pid);
    wp_redirect(home_url());



    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            $newupload = insert_attachment($file, $pid);
            // $newupload returns the attachment id of the file that
            // was just uploaded. Do whatever you want with that now.
        }
    } // END THE IF STATEMENT THAT STARTED THE WHOLE FORM

    //POST THE POST YO
    do_action('wp_update_post', 'wp_update_post');
}

?>
<section id="main-content">

    <!-- Submit a Project Form  -->
    <?php if (!is_user_logged_in()) : ?>
        <p class="warning">
        </p><!-- .warning -->
    <?php else : ?>
        <?php _e('You must be logged in to post your project.', 'project'); ?>

        <?php if ($post_author == $current_user->ID) { ?>


            <form id="edit_post" name="edit_post" method="post" action="<?php bloginfo('url'); ?>/edit-post/" enctype="multipart/form-data">



                <!-- post name -->
                <table>
                    <tr>
                        <td> <label for="title">Post Title:</label> </td>
                        <td>
                            <input type="text" id="title" value="<?php echo $title; ?>" tabindex="5" name="title" />
                        </td>
                    </tr>


                    <!-- post Category -->
                    <tr class="category">
                        <td> <label for="cat">Category:</label> </td>
                        <td> <?php $select_cats = wp_dropdown_categories(array('echo' => 0, 'taxonomy' => 'category', 'hide_empty' => 0));
                                $select_cats = str_replace("name='cat' id=", "name='cat[]' multiple='multiple' id=", $select_cats);
                                echo $select_cats;
                                ?> </td>

                    </tr>


                    <!-- post Content -->
                    <tr class="content">
                        <td> <label for="description"> Post Content : </label> </td>
                        <td> <textarea id="description" tabindex="15" name="description" cols="50" rows="10"> <?php echo $content; ?> </textarea> </td>
                    </tr>




                    <tr>
                        <td> <label for="thumbnail">Thumbnail Image:</label></td>
                        <td> <input type="file" id="async-upload" name="async-upload">

                            <input type="text" value="<?php echo get_attached_file($attachment->ID); ?>" name="atta" id="atta" />
                        </td>
                    </tr>
                    <!-- post tags -->
                    <tr class="tags">
                        <td> <label for="post_tags">Additional Keywords (comma separated):</label> </td>
                        <td> <input type="text" value="" tabindex="35" name="post_tags" id="post_tags" /> </td>
                    </tr>

                    <tr class="submit">
                        <td colspan="2"> <input type="submit" value="Post Review" tabindex="40" class="button" name="submit" /> </td>
                    </tr>

                </table>

            </form>
            </div>



        <?php } else {  ?>

            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php } ?>

    <?php endif; ?>

</section>
<?php //get_sidebar();

get_footer();

// 
?>