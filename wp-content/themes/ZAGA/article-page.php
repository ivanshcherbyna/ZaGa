<?php
/*
 * Template Name:Article
 * Template Post Type: post
 */
?>
<?php get_header(); ?>
<?php global $mytheme, $post;
$author=get_the_author_meta( 'display_name' ,$post->post_author);
$post_date_string=$post->post_date; //string format in db 2018-07-25 12:31:08
$post_date = new DateTime($post_date_string);
$post_date=$post_date->format('F j, Y'); // object format in June 2, 2018?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section class="article">
        <div class="container">
            <h1 class="h1"><?php the_title(); ?></h1>
            <p class="post__author">Posted <?php echo $post_date; ?> by <a href="#" class="post__author-link"><?php echo $author; ?></a></p>
            <div class="wrapper padding">
                <div class="content">
                    <?php the_content(); ?>
                </div>
                <div class="share">
                    <span>Share with:</span>
                    <div class="social">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/home?status=<?php echo get_permalink();?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </div>
                </div>

                <h2 class="h2">Comments</h2>
                <div class="comments">
                    <?php echo get_post_comments($post); ?>
                </div>
                
                <div class="post-a-comment">
                    <?php echo my_comment_form(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endwhile;
endif; ?>


<?php get_footer(); ?>
