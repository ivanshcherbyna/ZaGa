<?php
/*
 * Template Name:Blog
 * Template Post Type: page
 */
?>
<?php get_header(); ?>
<?php //global $mytheme, $post;
$number_posts=(isset($_GET['number_pagination']))? $_GET['number_pagination']:null?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section class="blog-page">
        <div class="container">

            <?php do_action('show_blog_posts','blog', $number_posts); ?>


        </div>
    </section>
<?php endwhile;
endif; ?>


<?php get_footer(); ?>
