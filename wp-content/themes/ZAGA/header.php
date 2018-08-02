<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
        <?php global $mytheme, $post;
        $current_post_image_src=get_the_post_thumbnail_url($post,'full');
        $site_description=get_bloginfo('description', 'display');
        ?>
	</head>
	<body <?php body_class(); ?>>

	<!-- wrapper -->
	<div class="wrapper_head">
        <?php if ( is_front_page() ) :
	?>
        <header class="header1" style="background-image: url('<?php echo $mytheme['header-background-img']['url'];?>');">
            <div class="logo-block">
                <div class="logo">
                    <a href="/" ><img src="<?php echo $mytheme['logo-img']['url'];?>" alt="logo site"></a>
                    <p class="logo-description"><?php echo $site_description;?></p>
                </div>
            </div>
            <i id="menu-toggle" class="fa fa-bars" aria-hidden="true"></i>
            <div class="container">

                    <!-- nav -->
                        <?php lwp_nav(); ?>
                    <!-- /nav -->

                <div class="info-post">
                    <h1 class="h1"><?php echo $mytheme['head-text'];?></h1>
                    <p><?php echo $mytheme['head-content-text'];?></p>
                    <a href="<?php echo $mytheme['link-head-text'];?>" class="btn-more"><?php echo $mytheme['head-button'];?></a>
                </div>
            </div>
        </header>
    </div>

            <?php else: ?>

            <header class="header2" style="background-image: url('<?php echo $current_post_image_src;?>');">
                <div class="logo-block">
                    <div class="logo">
                        <a href="/" ><img src="<?php echo $mytheme['logo-img']['url'];?>" alt="logo site"></a>
                        <p class="logo-description"><?php echo $site_description;?></p>
                    </div>
                </div>
                <i id="menu-toggle" class="fa fa-bars" aria-hidden="true"></i>
                <div class="container">

                    <!-- nav -->
                        <?php lwp_nav(); ?>
                    <!-- /nav -->
                </div>
            </header>
<?php endif; ?>
    <div id="adaptive-menu"></div>
