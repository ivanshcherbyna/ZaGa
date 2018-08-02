<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = THEME_OPT;

if ( !function_exists( "redux_add_metaboxes" ) ):
	function redux_add_metaboxes($metaboxes) {

        $homepage_options = array();

        $homepage_fields = array(
		'title' => 'Home',
		'icon_class'    => 'icon-large',
		'icon'          => 'el-icon-list-alt',
		'fields' => array(
			array(
				'id'     => 'head-text',
				'type'   => 'text',
				'title'  => __( 'Heading text')
			),
            array(
				'id'     => 'head-button',
				'type'   => 'text',
				'title'  => __( 'Heading text of button')
			),
            array(
                'id'     => 'head-content-text',
                'type'   => 'editor',
                'title'  => __( 'Content after head text')
            ),
            array(
                'id'     => 'link-head-text',
                'type'   => 'text',
                'title'  => __( 'url')
            ),
		)
	);

	$homepage_options[] = $homepage_fields;
	//project page
    $projectpage_options = array();

            $projectpage_fields = array(
            'title' => 'Project fields',
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-list-alt',
            'fields' => array(
                array(
                    'id'     => 'first-image',
                    'type'   => 'media',
                    'title'  => __( 'First image',THEME_OPT)
                ),
                array(
                    'id'     => 'plan-image',
                    'type'   => 'media',
                    'title'  => __( 'Plan image',THEME_OPT)
                ),
                array(
                    'id'     => '3d-plan-image',
                    'type'   => 'media',
                    'title'  => __( '3d plan image',THEME_OPT)
                ),
                array(
                    'id'       => 'opt-gallery',
                    'type'     => 'gallery',
                    'title'    => __('Add/Edit Gallery', THEME_OPT),
                    'desc'     => __('Put here please gallery images.', THEME_OPT),
                )

            )
        );

        $projectpage_options[] = $projectpage_fields;

        $contactpage_options = array();

        $contactpage_fields = array(
            'title' => 'Contact fields',
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-list-alt',
            'fields' => array(
                array(
                    'id'     => 'contact-bg',
                    'type'   => 'media',
                    'title'  => __( 'Background image',THEME_OPT)
                ),
                array(
                    'id'               => 'contact_phones_list',
                    'type'             => 'repeatable_list',
                    'accordion'      => true,
                    'title'            => __('Phones', 'mytheme'),
                    'add_button'     => __( 'Add phone'),
                    'remove_button'  => __( 'Delete phone'),
                    'fields'         => array(
                        array(
                            'id'       => 'current_num_phone',
                            'type'     => 'text',
                            'title'    => __('Current phone', 'mytheme'),
                        )
                    )
                ),
                array(
                    'id'     => 'contact-email',
                    'type'   => 'text',
                    'title'  => __( 'Contact e-mail',THEME_OPT)
                ),
             array(
                    'id'     => 'contact-adress',
                    'type'   => 'text',
                    'title'  => __( 'Contact Adress',THEME_OPT)
                    ),

                )

        );

        $contactpage_options[] =$contactpage_fields;

	$metaboxes[] = array(
		'id'            => 'home-page-options',
		'title'         => __( 'Page options', THEME_OPT ),
		'post_types'    => array( 'page' ),
		'page_template' => array('front-page.php'),
		'position'      => 'normal', // normal, advanced, side
		'priority'      => 'high', // high, core, default, low
		'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		'sections'      => $homepage_options,
	);
	$metaboxes[] = array(
		'id'            => 'project-page-options',
		'title'         => __( 'Post project options', THEME_OPT ),
		'post_types'    => array( 'post' ),
		'page_template' => array('project-post-page.php'),
		'position'      => 'normal', // normal, advanced, side
		'priority'      => 'high', // high, core, default, low
		'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		'sections'      => $projectpage_options,
	);
	$metaboxes[] = array(
		'id'            => 'contact-page-options',
		'title'         => __( 'Page contact options', THEME_OPT ),
		'post_types'    => array( 'page' ),
		'page_template' => array('contact.php'),
		'position'      => 'normal', // normal, advanced, side
		'priority'      => 'high', // high, core, default, low
		'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		'sections'      => $contactpage_options,
	);

	return $metaboxes;
  }
  add_action("redux/metaboxes/{$redux_opt_name}/boxes", 'redux_add_metaboxes');
endif;

