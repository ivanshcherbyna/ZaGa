<?php
/*
 *  Author: Lenlay
 */

define('THEME_OPT', 'mytheme', true);
/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Localisation Support
    // load_theme_textdomain(THEME_OPT, get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// Load scripts
function lwp_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('themescripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('themescripts');
    }
}
function zaga_footer_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('main', get_template_directory_uri() . '/inc/urich/js/main.min.js', array('jquery'), '1.0.0',true); // Custom scripts
        wp_enqueue_script('main');
        wp_register_script('slick', get_template_directory_uri() . '/inc/urich/js/slick.min.js', array('jquery'), '1.0.0',true); // Custom scripts
        wp_enqueue_script('slick');
        wp_register_script('jquery-3.3.1', get_template_directory_uri() . '/inc/urich/js/jquery-3.3.1.min.js', array('jquery'), '3.3.1',true); // Custom scripts
        wp_enqueue_script('jquery-3.3.1');
        wp_register_script('lightbox', get_template_directory_uri() . '/inc/lightbox/jquery.lightbox-0.5.pack.js', array('jquery'), '0.5',true); // Custom scripts
        wp_enqueue_script('lightbox');
        wp_register_script('async_script',get_template_directory_uri().'/inc/urich/async_script.js',array('jquery'), '1.0.0',true);
        wp_enqueue_script('async_script');

    }
}
function google_maps_script(){

    if (is_front_page()) {
        wp_enqueue_script('google_js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyALgake3VEJ1m28OFf8_5_B-z3AL-dGIN0&callback=initMap', '', '', true);
        wp_register_script('google_map', get_template_directory_uri() . '/inc/urich/google_map.js', array('jquery'), '1.0.0');
        wp_enqueue_script('google_map');
        wp_localize_script('google_map', 'image_url', array('custom_url' => get_template_directory_uri() . '/inc/urich/map_marker.png'));
    }
}
// Load styles
function lwp_styles() {

    wp_register_style('themestyle', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css'), 'all');
    wp_enqueue_style('themestyle');
    wp_register_style('lightboxstyle', get_template_directory_uri() . '/inc/lightbox/css/jquery.lightbox-0.5.css');
    wp_enqueue_style('lightboxstyle');
}
function zaga_styles() {

    wp_register_style('zaga_styles', get_template_directory_uri() . '/inc/urich/css/style.min.css');
    wp_enqueue_style('zaga_styles');
}


// HTML5 Blank navigation
function lwp_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'wrapper',
		'container_id'    => 'main-menu',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="menu">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Register Navigation
function register_lwp_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', THEME_OPT),
    ));
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'teatrhotel'),
        'description' => __('Description for this widget-area...', THEME_OPT),
        'id' => 'widget-area-1',
        'before_widget' => '<ul class="off-canvas-list">',
        'after_widget' => '</ul>',
        'before_title' => '<li><label><h3>',
        'after_title' => '</h3></label></li>'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function lwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function lwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function lwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function lwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function lwpcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'lwp_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'zaga_footer_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'lwp_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'zaga_styles'); // Add ZAGA Theme Stylesheet
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('init', 'register_lwp_menu'); // Add HTML5 Blank Menu
add_action('init', 'lwp_pagination'); // Add our HTML5 Pagination
add_action('wp_enqueue_scripts','google_maps_script');// custom incude maps scripts

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

include_once 'inc/loader.php';

add_action('show_last_posts','get_my_posts',10,2);
function get_my_posts($category_slug, $numbers=-1)
    {
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'numberposts' => $numbers,
            'category_name' => $category_slug,
            'post_status' => 'publish',
            'post_type' => array('post')
        );
        $posts = get_posts($args);

        foreach ($posts as $post) :

            setup_postdata($post);
            $title = get_the_title($post);
            $link =get_permalink($post->ID);
            $image=get_the_post_thumbnail_url($post,'full');
           ?>
                    <div class="item hover-on-block" style="background-image: url(<?php echo $image;?>)">
                       <div class="active-hover">
                       <h4 class="h2"><?php echo $title; ?></h4>
                            <a href="<?php echo $link; ?>" class="btn-more">Read More</a>
                        </div>

                  </div>

       <?php
        endforeach;
        wp_reset_postdata();
    }

    add_action('show_blog_posts','get_my_blog',10,2);

    function get_my_blog($category_slug, $number_pagination=null)
    {
        $all_posts_args=array(
            'orderby' => 'date',
            'order' => 'DESC',
            'numberposts' => -1,
            'category_name' => $category_slug,
            'post_status' => 'publish',
            'fields'          => 'ids',
            'post_type' => array('post')

        );
        $all_post_ids=get_posts($all_posts_args);


    $args = array(
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => $category_slug,
        'post_status' => 'publish',
        'post_type' => array('post'),
    );

        $pagination =  $number_pagination; //if set current pagination
        $numberposts = empty($pagination)? 3:null; // if not set current pagination (show last 3 posts) for start page

    $args['include']=$pagination;
    $args['numberposts']=$numberposts;

    $posts = get_posts($args);
    echo '<input type="hidden" class="all-numbers-posts hidden" value="'.implode( "," ,$all_post_ids).'" data="'.get_permalink().'"/>';
    echo '<div class="posts">';

        foreach ($posts as $post) :

    setup_postdata($post);
    $title = get_the_title($post);

    $content=$post->post_content;
    $post_author_id=$post->post_author;
    $post_author= get_the_author_meta( 'display_name' , $post_author_id );
    $part_content= substr($content,0,150); // only 150 symbols of post content preview
    $link =get_permalink($post->ID);
    $post_date_string=$post->post_date; //string format in db 2018-07-25 12:31:08
    $post_date = new DateTime($post_date_string);
    $post_date=$post_date->format('F j, Y'); // object format in June 2, 2018
    $image=get_the_post_thumbnail_url($post,'full');

    ?>
        <!-- Post -->
        <div class="post">
            <div class="post__image">
                <img src="<?php echo $image; ?>" alt="blog">
            </div>
            <div class="post__info">
                <h2 class="h2"><?php echo $title; ?></h2>
                <div class="post__description"><?php echo $part_content; ?>…</div>
                <hr>
                <p class="post__author">Posted on <?php echo $post_date; ?> by <a href="#" class="post__author-link">  <?php echo $post_author; ?></a></p>
                <a href="<?php echo $link; ?>" class="btn-more">Read More</a>
            </div>
        </div>
        <!-- End post -->

<?php
endforeach;
echo '</div>';
?>

 <div class="pagination">
                <ul>

                </ul>
            </div>
<?php
wp_reset_postdata(); // reset
}

/*--- Customization comments----*/
function my_comment_form_before() {
    ob_start();
    return null;
}
add_action( 'comment_form_before', 'my_comment_form_before' );

function my_comment_form() {

        $args = array(
            'fields' => array(
                'author' => '<div class="row"><div class="input-field"><input placeholder="Name" id="author" name="author" type="text" value="" /></div>',
                'email'  => '<div class="input-field"><input placeholder="E-mail" id="email" name="email" value=""  maxlength="100" /></div></div> ',
            ),
            'comment_field' => '<div class="input-field"><textarea id="comment" name="comment" cols="30" rows="10"  placeholder="Comment"></textarea></div>',
            'class_submit' => 'btn-more',
            'label_submit' => 'Send',
            'comment_notes_before' => '',
            'comment_notes_after' => '<p class="required-fields-are-marked">'. __( 'Your email address will not be published. Required fields are marked *' ) . '</p>',
            'title_reply'=>'',
            'title_reply_before'=>'',
        );

        add_filter('comment_form_fields', 'my_reorder_comment_fields');
        function my_reorder_comment_fields( $fields ){
            // die(print_r( $fields )); // show fields

            $new_fields = array(); // new array of fields

            $myorder = array('author','email'); // sort for flieds

            foreach( $myorder as $key ){
                $new_fields[ $key ] = $fields[ $key ];
                unset( $fields[ $key ] );
            }
            if( $fields )
                foreach( $fields as $key => $val )
                    $new_fields[ $key ] = $val;

            return $new_fields;
        }

        return comment_form($args);

}

function get_post_comments($post){
    $args = array(

        'order'               => 'DESC',
        'parent'              => '',
        'post_author__in'     => '',
        'post_author__not_in' => '',
        'post_id'             => $post->ID,
        'post__in'            => '',
        'post__not_in'        => '',
        'post_author'         => '',
        'post_name'           => '',
        'post_parent'         => '',
        'post_status'         => '',
        'post_type'           => '',
        'status'              => 'all',
        'type'                => '',
        'type__in'            => '',
        'type__not_in'        => '',
        'user_id'             => '',
        'search'              => '',
        'count'               => false,
        'meta_key'            => '',
        'meta_value'          => '',
        'meta_query'          => '',
        'date_query'          => null, // See WP_Date_Query
        'hierarchical'        => false,
        'update_comment_meta_cache'  => true,
        'update_comment_post_cache'  => false,
    );

    if( $comments = get_comments( $args ) ){
        foreach( $comments as $comment ){
            echo '<div class="comment">
                            <p class="comment__name">'.$comment->comment_author.'</p>
                            <p class="comment__text">'.$comment->comment_content.'</p>
                      
                       </div>
                       <hr>';

        }
    }
}
/*--- Customization comments----*/
/*
 * Active class for current menu
 *
 */
//add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 1);
//
//function special_nav_class ($classes) {
//    if (in_array('current-menu-item', $classes) ){
//        $classes[] = 'active ';
//    }
//    return $classes;
//}


remove_action('wp_head', 'wp_generator');
?>
