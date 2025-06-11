<?php
/**
 * Custom functions for Tudor SEO theme
 */

/**
 * Add custom image sizes
 */
function tudorseo_custom_image_sizes() {
    add_image_size('portfolio-thumbnail', 600, 400, true);
    add_image_size('service-thumbnail', 400, 300, true);
    add_image_size('blog-thumbnail', 800, 500, true);
}
add_action('after_setup_theme', 'tudorseo_custom_image_sizes');

/**
 * Customize excerpt length
 */
function tudorseo_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'tudorseo_excerpt_length');

/**
 * Customize excerpt more
 */
function tudorseo_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'tudorseo_excerpt_more');

/**
 * Add custom classes to body
 */
function tudorseo_body_classes($classes) {
    // Add dark mode class if enabled
    if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
        $classes[] = 'dark-mode';
    }
    return $classes;
}
add_filter('body_class', 'tudorseo_body_classes');

/**
 * Add custom meta boxes for portfolio items
 */
function tudorseo_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_details',
        __('Portfolio Details', 'tudorseo'),
        'tudorseo_portfolio_meta_box_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'tudorseo_add_portfolio_meta_boxes');

/**
 * Portfolio meta box callback
 */
function tudorseo_portfolio_meta_box_callback($post) {
    wp_nonce_field('tudorseo_portfolio_meta_box', 'tudorseo_portfolio_meta_box_nonce');

    $client = get_post_meta($post->ID, '_portfolio_client', true);
    $date = get_post_meta($post->ID, '_portfolio_date', true);
    $url = get_post_meta($post->ID, '_portfolio_url', true);
    ?>
    <p>
        <label for="portfolio_client"><?php _e('Client:', 'tudorseo'); ?></label>
        <input type="text" id="portfolio_client" name="portfolio_client" value="<?php echo esc_attr($client); ?>" class="widefat">
    </p>
    <p>
        <label for="portfolio_date"><?php _e('Date:', 'tudorseo'); ?></label>
        <input type="date" id="portfolio_date" name="portfolio_date" value="<?php echo esc_attr($date); ?>" class="widefat">
    </p>
    <p>
        <label for="portfolio_url"><?php _e('Project URL:', 'tudorseo'); ?></label>
        <input type="url" id="portfolio_url" name="portfolio_url" value="<?php echo esc_url($url); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Save portfolio meta box data
 */
function tudorseo_save_portfolio_meta_box_data($post_id) {
    if (!isset($_POST['tudorseo_portfolio_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['tudorseo_portfolio_meta_box_nonce'], 'tudorseo_portfolio_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['portfolio_client'])) {
        update_post_meta($post_id, '_portfolio_client', sanitize_text_field($_POST['portfolio_client']));
    }

    if (isset($_POST['portfolio_date'])) {
        update_post_meta($post_id, '_portfolio_date', sanitize_text_field($_POST['portfolio_date']));
    }

    if (isset($_POST['portfolio_url'])) {
        update_post_meta($post_id, '_portfolio_url', esc_url_raw($_POST['portfolio_url']));
    }
}
add_action('save_post', 'tudorseo_save_portfolio_meta_box_data');

/**
 * Add custom meta boxes for services
 */
function tudorseo_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Service Details', 'tudorseo'),
        'tudorseo_service_meta_box_callback',
        'services',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'tudorseo_add_service_meta_boxes');

/**
 * Service meta box callback
 */
function tudorseo_service_meta_box_callback($post) {
    wp_nonce_field('tudorseo_service_meta_box', 'tudorseo_service_meta_box_nonce');

    $icon = get_post_meta($post->ID, '_service_icon', true);
    $price = get_post_meta($post->ID, '_service_price', true);
    ?>
    <p>
        <label for="service_icon"><?php _e('Icon Class:', 'tudorseo'); ?></label>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat">
        <span class="description"><?php _e('Enter Font Awesome icon class (e.g., fa-code)', 'tudorseo'); ?></span>
    </p>
    <p>
        <label for="service_price"><?php _e('Price:', 'tudorseo'); ?></label>
        <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Save service meta box data
 */
function tudorseo_save_service_meta_box_data($post_id) {
    if (!isset($_POST['tudorseo_service_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['tudorseo_service_meta_box_nonce'], 'tudorseo_service_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }

    if (isset($_POST['service_price'])) {
        update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
    }
}
add_action('save_post', 'tudorseo_save_service_meta_box_data'); 