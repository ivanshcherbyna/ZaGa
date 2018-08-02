<?php
/*
 * Template Name:Contact
 * Template Post Type: page
 */
?>
<?php get_header(); ?>
<?php global $mytheme; ?>

<div id="big-map" style="background-image:url(<?php if(!empty($mytheme['contact-bg'])):echo $mytheme['contact-bg']['url']; endif;?>)">
    <div class="container">
        <div class="big-map-info">
            <div class="big-map-info__phone">
                <p class="big-map-info__title">Phone</p>
                <p class="big-map-info__description">
                    <?php if(!empty($mytheme['contact_phones_list'])): foreach ($mytheme['contact_phones_list'] as $current_phone):?>
                    <?php echo $current_phone['current_num_phone'];?><br>
                    <?php endforeach; endif; ?>
                </p>
            </div>
            <div class="big-map-info__email">
                <p class="big-map-info__title">E-mail</p>
                <p class="big-map-info__description">
                    <?php if(!empty($mytheme['contact-email'])): echo $mytheme['contact-email']; endif; ?>
                </p>
            </div>
            <div class="big-map-info__address">
                <p class="big-map-info__title">Address</p>
                <p class="big-map-info__description">
                    <?php  if(!empty($mytheme['contact-adress'])): echo $mytheme['contact-adress'];  endif;?>
                </p>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
