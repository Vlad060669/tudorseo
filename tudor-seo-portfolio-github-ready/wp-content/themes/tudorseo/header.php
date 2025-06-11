<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<button id="toggleTheme">Toggle Dark Mode</button>

<header>
    <nav class="navbar">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="VT Logo - Precision. Passion. Progress." style="height:60px; width:auto; display:inline-block; vertical-align:middle;">
        </a>
        <h1 style="display:inline-block; vertical-align:middle; margin-left:1rem;"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'nav-links',
            'fallback_cb' => false,
        ));
        ?>
    </nav>
</header> 