<?php
/*
 * Template Name:Projects
 * Template Post Type: page
 */
?>
<?php get_header(); ?>
<?php global $mytheme, $post;?>

<section class="our-projects">

    <div class="container">
        <h2 class="h2 padding">Our Projects</h2>
        <div class="row col3">
            <?php do_action('show_last_posts','projects');?>


        </div>
    </div>
</section>


<?php get_footer(); ?>
