<?php
define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('SITE_URL', site_url());
define('SITE_PATH', get_home_path());
define('HOME_URL', home_url());
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

if (function_exists('add_theme_support')) {
    // Add Menu Support
  	add_theme_support('navigation-bar');
    add_theme_support('menus');
    add_theme_support('automatic-feed-links');
    add_theme_support( 'custom-widgets' );
  
  
   add_theme_support( 'custom-background' );
  
    add_theme_support('post-thumbnails');
    add_image_size('content_image', 1980, '', false);
    add_image_size('events_thumb', 634, 634, true);
    add_image_size('half_column', 990, '', false);
    add_image_size('team_member', 984, 804, true);
    add_image_size('friends', 428, 428, true);
  	add_image_size('menu_template', 428, 428, true);
    
    add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');
    function remove_default_image_sizes($sizes) {
        unset($sizes['medium']);
        unset($sizes['medium_large']);
        unset($sizes['large']);
        return $sizes;
    }
}

if(function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'General Settings',
		'menu_title' => 'General Settings',
		'menu_slug'	 => 'general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
    ));

    acf_add_options_page(array(
        'page_title'  => 'Header Settings',
		'menu_title'  => 'Header Settings',
        'menu_slug'	  => 'header-settings',
        'parent_slug' => 'general-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false
    ));
    
    
    acf_add_options_page(array(
        'page_title'  => 'Cookies & Tracking',
		'menu_title'  => 'Cookies & Tracking',
        'menu_slug'	  => 'cookies-settings',
        'parent_slug' => 'general-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false
    ));
  
   

    acf_add_options_page(array(
        'page_title'  => 'Footer Settings',
		'menu_title'  => 'Footer Settings',
        'menu_slug'	  => 'footer-settings',
        'parent_slug' => 'general-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false
	));
}

function theme_block_categories($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'theme-blocks',
                'title' => __('Theme Blocks', 'rora')
            ),
        )
    );
}
add_filter('block_categories', 'theme_block_categories', 10, 2);

function register_acf_block_types() {
    /*acf_register_block_type(array(
        'name'              => 'frontpage-header-block',
        'title'             => __('Frontpage Header Block', 'rora'),
        'description'       => __('Frontpage Header Block.', 'rora'),
        'render_callback'	=> 'my_acf_block_render_callback',
        'category'          => 'theme-blocks',
        'icon'              => 'admin-settings',
        'keywords'          => array('frontpage', 'header', 'block'),
    ));*/
    acf_register_block_type(array(
        'name'              => 'text-columns-block',
        'title'             => __('Text Columns Block', 'rora'),
        'description'       => __('Text Columns Block.', 'rora'),
        'render_callback'	=> 'my_acf_block_render_callback',
        'category'          => 'theme-blocks',
        'icon'              => 'admin-settings',
        'keywords'          => array('text', 'columns', 'block'),
    ));
    acf_register_block_type(array(
        'name'              => 'content-image-block',
        'title'             => __('Content Image Block', 'rora'),
        'description'       => __('Content Image Block.', 'rora'),
        'render_callback'	=> 'my_acf_block_render_callback',
        'category'          => 'theme-blocks',
        'icon'              => 'admin-settings',
        'keywords'          => array('content', 'image', 'block'),
    ));
    acf_register_block_type(array(
        'name'              => 'text-button-block',
        'title'             => __('Text Button Block', 'rora'),
        'description'       => __('Text Button Block.', 'rora'),
        'render_callback'	=> 'my_acf_block_render_callback',
        'category'          => 'theme-blocks',
        'icon'              => 'admin-settings',
        'keywords'          => array('text', 'button', 'block'),
    ));
}

function my_acf_block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);

	if(file_exists(get_theme_file_path("/blocks/{$slug}.php"))) {
		include(get_theme_file_path("/blocks/{$slug}.php"));
	}
}

if(function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}

// navigation
function template_nav() {
	wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
		)
	);
}

// Load styles
function template_styles() {
    wp_register_style('bootstrap', THEME_URL . '/assets/css/bootstrap.min.css', array(), filemtime(THEME_DIR . '/assets/css/bootstrap.min.css'), 'all');

    wp_register_style('styles', THEME_URL . '/scss/css/styles.css', array('bootstrap'), filemtime(THEME_DIR . '/scss/css/styles.css'), 'all');
    wp_enqueue_style('styles');
}

function admin_styles() {
    wp_register_style('admin_styles', THEME_URL . '/scss/css/admin.css', array(), filemtime(THEME_DIR . '/scss/css/admin.css'), 'all');
    wp_enqueue_style('admin_styles');
}

function template_scripts() {
   if($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
       wp_register_script('bootstrap', THEME_URL . '/assets/js/bootstrap.bundle.min.js', array('jquery'), filemtime(THEME_DIR . '/assets/js/bootstrap.bundle.min.js'));

       wp_register_script('script', THEME_URL . '/js/script.js', array('jquery', 'bootstrap'), filemtime(THEME_DIR . '/js/script.js'));
       wp_enqueue_script('script');
    }
}

// Register template Navigation
function register_template_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'rora'), // Main Navigation
    ));
}
add_action('init', 'register_template_menu');

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
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

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Add Actions
add_action('get_header', 'template_styles');
add_action('admin_enqueue_scripts', 'admin_styles');
add_action('get_footer', 'template_scripts');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class');
add_filter('widget_text', 'do_shortcode');
add_filter('widget_text', 'shortcode_unautop');
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
add_filter('the_category', 'remove_category_rel_from_category_list');
add_filter('the_excerpt', 'shortcode_unautop');
add_filter('the_excerpt', 'do_shortcode');
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
add_filter('wpcf7_autop_or_not', '__return_false');

// Remove Filters
remove_filter('the_excerpt', 'wpautop');

/* Disable comments */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

// Remove comments links from admin bar
add_action('init', function () {
    if(is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/* Remove items from admin menu */
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    
    // Hide pages form admin menu for all users exept developer
    if(get_current_user_id() !== 1){
        remove_menu_page('edit.php?post_type=acf-field-group');
        remove_menu_page('duplicator');
    }
});


// Fix svg missing dimentions
add_filter('wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4);
function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
    if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
        if(is_array($size)) {
            $image[1] = $size[0];
            $image[2] = $size[1];
        } elseif(($xml = simplexml_load_file($image[0])) !== false) {
            $attr = $xml->attributes();
            $viewbox = explode(' ', $attr->viewBox);
            $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
            $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
        } else {
            $image[1] = $image[2] = null;
        }
    }
    return $image;
}

function get_svg_dimentions($file) {
    $sizes = [];
    
    if($file['mime_type'] == 'image/svg+xml') {
        $file_contents = file_get_contents(str_replace(SITE_URL, SITE_PATH, $file['url']));
        $xmlget = simplexml_load_string($file_contents);
        $xmlattributes = $xmlget->attributes();
        $file_width = (string) $xmlattributes->width; 
        $file_height = (string) $xmlattributes->height;

        if($file_width && $file_width !== '') {
            $sizes['width'] = str_replace('px', '', $file_width);
        }
        if($file_height && $file_height !== '') {
            $sizes['height'] = str_replace('px', '', $file_height);
        }
    }

    return $sizes;
}


function events_custom_post() {
    register_post_type('events',
        array(
        'labels' => array(
            'name' => __('Events', 'rora'),
            'singular_name' => __('Event', 'rora'),
            'add_new' => __('Add New Event', 'rora'),
            'add_new_item' => __('Add New Event', 'rora'),
            'edit' => __('Edit', 'rora'),
            'edit_item' => __('Edit Event', 'rora'),
            'new_item' => __('New Event', 'rora'),
            'view' => __('View Events', 'rora'),
            'view_item' => __('View Event', 'rora'),
            'search_items' => __('Search Events', 'rora'),
            'not_found' => __('Events not found', 'rora'),
            'archive_seo_title' => __('Events','rora'),
            'not_found_in_trash' => __('Events not found', 'rora')
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => false,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array(
            'title',
            'author',
            'editor',
            'thumbnail',
            'page-attributes',
            'revisions',
            'custom-fields'
        ),
        'can_export' => true,
        'show_in_rest'       => true,
  		'rest_base'          => 'events_custom_post',
  		'rest_controller_class' => 'WP_REST_Posts_Controller'
    ));
}
add_action('init', 'events_custom_post');

// Tracking scripts
function getAnalytics() {
	include(locate_template("ajax/analytics-ajax.php"));
	die;
}

add_action('wp_ajax_getAnalytics', 'getAnalytics');
add_action('wp_ajax_nopriv_getAnalytics', 'getAnalytics');

// Remove editor from some page templates
function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        $disabledTemplates = [
            'page-templates/template-menu.php',
            'page-templates/template-events.php',
        ];

        if(in_array($template, $disabledTemplates)) {
            remove_post_type_support('page', 'editor');
        }
    }
}
add_action('init', 'remove_editor');

function add_mailerlite_subscriber($email, $name) {
    $api = get_field('mailerlite_api', 'options');
    $group_id = get_field('mailerlite_group_id', 'options');
    
    if(!$api || !$group_id || !$email || !$name) return false;
    
    require 'mailerlite/autoload.php';
    $mailerliteClient = new \MailerLiteApi\MailerLite($api);
    $groupsApi = $mailerliteClient->groups();
    
    $subscriber = [
        'email' => $email,
        'fields' => [
            'name' => $name,
        ]
    ];

    $response = $groupsApi->addSubscriber($group_id, $subscriber);

    return $response;
}

add_action('wpcf7_before_send_mail', 'wpcf7_proccess_newsletter');
function wpcf7_proccess_newsletter($contact_form){
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    $form_id = $wpcf7->id;
    $newsletter_form_ids = array(
        454,
        492,
        496
    );

    if(!in_array($form_id, $newsletter_form_ids) || !$submission) return;

    $data = $submission->get_posted_data();

    if(empty($data)) return;

    $name = isset($data['your-name']) ? $data['your-name'] : false;
    $email = isset($data['your-email']) ? $data['your-email'] : false;

    if(!$name || !$email) return;

    add_mailerlite_subscriber($email, $name);

    return $wpcf7;
}

?>