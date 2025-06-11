<?php
/**
 * Vladimir Tudor Portfolio Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme Setup
function vladimirtudor_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'vladimirtudor'),
        'footer' => esc_html__('Footer Menu', 'vladimirtudor'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'vladimirtudor_setup');

// Enqueue scripts and styles
function vladimirtudor_scripts() {
    wp_enqueue_style('vladimirtudor-style', get_stylesheet_uri());
    wp_enqueue_script('vladimirtudor-script', get_template_directory_uri() . '/script.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'vladimirtudor_scripts');

// Register Custom Post Types
function vladimirtudor_register_post_types() {
    // Portfolio Post Type
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => __('Portfolio', 'vladimirtudor'),
            'singular_name' => __('Portfolio Item', 'vladimirtudor'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
    ));

    // Services Post Type
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Services', 'vladimirtudor'),
            'singular_name' => __('Service', 'vladimirtudor'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-clipboard',
    ));
}
add_action('init', 'vladimirtudor_register_post_types');

// Register Custom Taxonomies
function vladimirtudor_register_taxonomies() {
    // Portfolio Categories
    register_taxonomy('portfolio_category', 'portfolio', array(
        'labels' => array(
            'name' => __('Portfolio Categories', 'vladimirtudor'),
            'singular_name' => __('Portfolio Category', 'vladimirtudor'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));

    // Service Categories
    register_taxonomy('service_category', 'services', array(
        'labels' => array(
            'name' => __('Service Categories', 'vladimirtudor'),
            'singular_name' => __('Service Category', 'vladimirtudor'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'vladimirtudor_register_taxonomies'); 