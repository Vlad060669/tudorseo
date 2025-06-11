<?php
/**
 * Content Migration Helper Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Migrate Portfolio Items
 */
function tudorseo_migrate_portfolio() {
    // Sample portfolio items
    $portfolio_items = array(
        array(
            'title' => 'E-commerce Website',
            'content' => 'A modern e-commerce platform built with React and Node.js.',
            'client' => 'Fashion Store',
            'date' => '2024-01-15',
            'url' => 'https://example.com/ecommerce',
            'image' => 'portfolio-1.jpg'
        ),
        array(
            'title' => 'Mobile App Development',
            'content' => 'Cross-platform mobile application for fitness tracking.',
            'client' => 'FitLife',
            'date' => '2024-02-01',
            'url' => 'https://example.com/mobile-app',
            'image' => 'portfolio-2.jpg'
        ),
        array(
            'title' => 'Corporate Website',
            'content' => 'Responsive corporate website with custom CMS.',
            'client' => 'TechCorp',
            'date' => '2024-02-15',
            'url' => 'https://example.com/corporate',
            'image' => 'portfolio-3.jpg'
        )
    );

    foreach ($portfolio_items as $item) {
        $post_data = array(
            'post_title'    => $item['title'],
            'post_content'  => $item['content'],
            'post_status'   => 'publish',
            'post_type'     => 'portfolio'
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            // Add meta data
            update_post_meta($post_id, '_portfolio_client', $item['client']);
            update_post_meta($post_id, '_portfolio_date', $item['date']);
            update_post_meta($post_id, '_portfolio_url', $item['url']);

            // Set featured image
            $image_path = get_template_directory() . '/assets/images/' . $item['image'];
            if (file_exists($image_path)) {
                $upload = wp_upload_bits($item['image'], null, file_get_contents($image_path));
                if (!$upload['error']) {
                    $wp_filetype = wp_check_filetype($item['image'], null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($item['image']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    $attachment_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                    set_post_thumbnail($post_id, $attachment_id);
                }
            }
        }
    }
}

/**
 * Migrate Services
 */
function tudorseo_migrate_services() {
    // Sample services
    $services = array(
        array(
            'title' => 'Web Development',
            'content' => 'Custom website development using modern technologies.',
            'icon' => 'fa-code',
            'price' => '$1000+'
        ),
        array(
            'title' => 'Mobile App Development',
            'content' => 'Native and cross-platform mobile applications.',
            'icon' => 'fa-mobile-alt',
            'price' => '$2000+'
        ),
        array(
            'title' => 'SEO Optimization',
            'content' => 'Search engine optimization to improve your online presence.',
            'icon' => 'fa-search',
            'price' => '$500+'
        )
    );

    foreach ($services as $service) {
        $post_data = array(
            'post_title'    => $service['title'],
            'post_content'  => $service['content'],
            'post_status'   => 'publish',
            'post_type'     => 'services'
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            // Add meta data
            update_post_meta($post_id, '_service_icon', $service['icon']);
            update_post_meta($post_id, '_service_price', $service['price']);
        }
    }
}

/**
 * Migrate Blog Posts
 */
function tudorseo_migrate_blog_posts() {
    // Sample blog posts
    $blog_posts = array(
        array(
            'title' => 'JavaScript Performance Optimization',
            'content' => 'Learn how to optimize your JavaScript code for better performance.',
            'date' => '2024-03-01',
            'category' => 'Development'
        ),
        array(
            'title' => 'The Future of Web Development',
            'content' => 'Exploring upcoming trends and technologies in web development.',
            'date' => '2024-03-15',
            'category' => 'Technology'
        ),
        array(
            'title' => 'Building Accessible Websites',
            'content' => 'Best practices for creating accessible and inclusive web experiences.',
            'date' => '2024-03-30',
            'category' => 'Accessibility'
        )
    );

    foreach ($blog_posts as $post) {
        $post_data = array(
            'post_title'    => $post['title'],
            'post_content'  => $post['content'],
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_date'     => $post['date']
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            // Add category
            wp_set_post_categories($post_id, array($post['category']));
        }
    }
}

/**
 * Create Pages
 */
function tudorseo_create_pages() {
    $pages = array(
        'Home' => array(
            'template' => 'front-page.php',
            'content' => 'Welcome to Tudor SEO - Your Web Development Partner'
        ),
        'About' => array(
            'template' => 'page-about.php',
            'content' => 'Learn more about Tudor SEO and our mission.'
        ),
        'Services' => array(
            'template' => 'page-services.php',
            'content' => 'Explore our range of web development services.'
        ),
        'Portfolio' => array(
            'template' => 'page-portfolio.php',
            'content' => 'View our latest projects and client work.'
        ),
        'Blog' => array(
            'template' => 'page-blog.php',
            'content' => 'Read our latest articles and insights.'
        ),
        'Contact' => array(
            'template' => 'page-contact.php',
            'content' => 'Get in touch with us for your next project.'
        )
    );

    foreach ($pages as $title => $page) {
        $post_data = array(
            'post_title'    => $title,
            'post_content'  => $page['content'],
            'post_status'   => 'publish',
            'post_type'     => 'page'
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            update_post_meta($post_id, '_wp_page_template', $page['template']);
        }
    }
}

/**
 * Set up menu
 */
function tudorseo_setup_menu() {
    // Create menu
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Add pages to menu
        $pages = get_pages();
        foreach ($pages as $page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => $page->post_title,
                'menu-item-object' => 'page',
                'menu-item-object-id' => $page->ID,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish'
            ));
        }

        // Assign menu to theme location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

/**
 * Run migration
 */
function tudorseo_run_migration() {
    // Create pages
    tudorseo_create_pages();

    // Migrate portfolio items
    tudorseo_migrate_portfolio();

    // Migrate services
    tudorseo_migrate_services();

    // Migrate blog posts
    tudorseo_migrate_blog_posts();

    // Set up menu
    tudorseo_setup_menu();
}

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

// Migration page callback
function tudorseo_migration_page() {
    ?>
    <div class="wrap">
        <h1>Content Migration</h1>
        <p>Click the button below to migrate your content to WordPress.</p>
        <form method="post">
            <?php wp_nonce_field('tudorseo_migration', 'tudorseo_migration_nonce'); ?>
            <input type="submit" name="tudorseo_migrate" class="button button-primary" value="Start Migration">
        </form>
    </div>
    <?php

    if (isset($_POST['tudorseo_migrate']) && check_admin_referer('tudorseo_migration', 'tudorseo_migration_nonce')) {
        tudorseo_run_migration();
        echo '<div class="notice notice-success"><p>Migration completed successfully!</p></div>';
    }
} 