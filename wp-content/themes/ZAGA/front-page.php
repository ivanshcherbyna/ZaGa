<?php
/*
 * Template Name:Home
 *
 */
?>
<?php get_header();
$current_post_image_src=get_the_post_thumbnail_url($post,'full');
?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section class="about-us" id="about">
        <div class="container padding">
            <div class="row col2">
                <div class="item left-block">
                    <h2 class="h2">About us</h2>
                    <div class="description"><?php the_content(); // Dynamic Content ?></div>
                    <span class="h2">Our Specialization</span>
                    <div class="specialization">
                        <img src="<?php echo get_template_directory_uri();?>/inc/urich/image/ic-architecture.png" alt="">
                        <img src="<?php echo get_template_directory_uri();?>/inc/urich/image//interiors.png" alt="">
                        <img src="<?php echo get_template_directory_uri();?>/inc/urich/image/ic-planing.png" alt="">
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo $current_post_image_src; ?>" alt="">
                </div>
            </div>
        </div>
    </section>
<?php endwhile;
        endif; ?>

<section class="our-projects">

    <div class="container">
        <h2 class="h2 padding">Our Projects</h2>
        <div class="row col3">
            <?php do_action('show_last_posts','projects',6);?>


        </div>
    </div>
</section>

<section class="get-in-touch">
    <div class="container">
        <h2 class="h2 padding">Get in touch</h2>
        <div class="row col2">
             <div class="item map">
                 <div id="map_canvas">

                 </div>
                    <?php //echo do_shortcode('[wpgmza id="1"]'); ?>
                 <div class="map__info">
                    <p class="map__number">+3 8(073) 654-33-35</p>
                    <p class="map__email">info@Zaga.com</p>
                    <p class="map__address">Kiev, Obolonska,14A</p>
                 </div>
             </div>
             <div class="item contact-form">
                <?php echo do_shortcode('[contact-form-7 id="63" title="Contact form 1"]');?>
            </div>
        </div>    
    </div>
</section>


<?php get_footer();
//do_action('include_maps_script');
?>
