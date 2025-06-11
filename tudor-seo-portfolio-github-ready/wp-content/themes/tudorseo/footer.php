    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'container' => false,
            'menu_class' => 'footer-links',
            'fallback_cb' => false,
        ));
        ?>
    </footer>

    <?php wp_footer(); ?>
</body>
</html> 