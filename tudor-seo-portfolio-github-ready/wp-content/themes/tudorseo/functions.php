<?php
/**
 * Tudor SEO Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme Setup
function tudorseo_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'tudorseo'),
        'footer' => esc_html__('Footer Menu', 'tudorseo'),
    ));
}
add_action('after_setup_theme', 'tudorseo_setup');

// Enqueue scripts and styles
function tudorseo_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('tudorseo-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue custom styles
    wp_enqueue_style('tudorseo-custom', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.0');
    
    // Enqueue custom scripts
    wp_enqueue_script('tudorseo-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'tudorseo_scripts');

// Register Custom Post Types
function tudorseo_register_post_types() {
    // Portfolio Post Type
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => __('Portfolio', 'tudorseo'),
            'singular_name' => __('Portfolio Item', 'tudorseo'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'rewrite' => array('slug' => 'portfolio'),
    ));

    // Services Post Type
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Services', 'tudorseo'),
            'singular_name' => __('Service', 'tudorseo'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-clipboard',
        'rewrite' => array('slug' => 'services'),
    ));
}
add_action('init', 'tudorseo_register_post_types');

// Register widget areas
function tudorseo_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'tudorseo'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'tudorseo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'tudorseo_widgets_init');

// Include required files
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/content-migration.php';

// Add migration page to admin menu
function tudorseo_add_migration_page() {
    add_theme_page(
        'Content Migration',
        'Content Migration',
        'manage_options',
        'tudorseo-migration',
        'tudorseo_migration_page'
    );
}
add_action('admin_menu', 'tudorseo_add_migration_page');

// Register Custom Taxonomies
function tudorseo_register_taxonomies() {
    // Portfolio Categories
    register_taxonomy('portfolio_category', 'portfolio', array(
        'labels' => array(
            'name' => __('Portfolio Categories', 'tudorseo'),
            'singular_name' => __('Portfolio Category', 'tudorseo'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));

    // Service Categories
    register_taxonomy('service_category', 'services', array(
        'labels' => array(
            'name' => __('Service Categories', 'tudorseo'),
            'singular_name' => __('Service Category', 'tudorseo'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'tudorseo_register_taxonomies');

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true); 