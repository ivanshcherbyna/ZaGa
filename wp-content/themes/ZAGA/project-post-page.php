<?php
/*
 * Template Name:Project
 * Template Post Type: post
 */
?>
<?php get_header(); ?>
 <?php global $mytheme, $post;
 $project_meta_first_image = redux_post_meta(THEME_OPT, $post,'first-image');
 $project_meta_plan_image = redux_post_meta(THEME_OPT, $post,'plan-image');
 $project_meta_plan_3d_image = redux_post_meta(THEME_OPT, $post,'3d-plan-image');
 $project_meta_gallery_ids = explode(',',redux_post_meta(THEME_OPT, $post,'opt-gallery'));

 ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
 <section class="progect-info">
        <div class="container padding-left">
            <h1 class="h1"><?php the_title(); ?></h1>
            <div class="row col2">
                <div class="item">
                    <p> <?php the_content(); ?></p>
                </div>
                <div class="item">
                    <?php if(!empty($project_meta_first_image['url'])): ?>
                        <img src="<?php echo $project_meta_first_image['url']?>" alt="" class="image-project">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endwhile;
endif; ?>
<?php if(!empty($project_meta_plan_image['url']) && !empty($project_meta_plan_3d_image['url'])): ?>

<section class="blueprints">
    <div class="container row col2">
        <img src="<?php echo $project_meta_plan_image['url']; ?>" alt="" class="item padding-left">
        <img src="<?php echo $project_meta_plan_3d_image['url']; ?>" alt="" class="item padding-left">
    </div>
</section>

<?php endif; ?>
<?php if(!empty($project_meta_gallery_ids[0])): ?>

<section class="gallery">
    <div class="container row col3">
        <?php foreach ($project_meta_gallery_ids as $image_id):
        $image = wp_get_attachment_image_url($image_id,'full');?>

        <a href="<?php echo $image; ?>" class="item"><img src="<?php echo $image; ?>" alt="" ></a>
        <?php endforeach; ?>
    </div>
</section>
    <script type="text/javascript">
        jQuery(function(){
        jQuery(".gallery .container a").lightBox({
            overlayBgColor: '#FFF',
            overlayOpacity: 0.6,
            imageLoading: '<?php echo get_template_directory_uri();?>/inc/lightbox/images/lightbox-ico-loading.gif',
            imageBtnClose: '<?php echo get_template_directory_uri();?>/inc/lightbox/images/lightbox-btn-close.gif',
            imageBtnPrev: '<?php echo get_template_directory_uri();?>/inc/lightbox/images/lightbox-btn-prev.gif',
            imageBtnNext: '<?php echo get_template_directory_uri();?>/inc/lightbox/images/lightbox-btn-next.gif',
            imageBlank: '<?php echo get_template_directory_uri();?>/inc/lightbox/images/lightbox-blank.gif',
            containerResizeSpeed: 350,
            // txtImage: 'Image',
            // txtOf: 'from'
             });
        });

    </script>
<?php endif; ?>


<?php get_footer(); ?>
