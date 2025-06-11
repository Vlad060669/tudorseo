<?php get_header(); ?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Tudor SEO</h1>
            <p>Professional Web Development & SEO Services</p>
            <a href="#contact" class="btn">Get Started</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="services-grid">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'services',
                'posts_per_page' => 3
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
            ?>
                <div class="service-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="service-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <div class="service-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio">
        <h2>Our Work</h2>
        <div class="portfolio-grid">
            <?php
            $portfolio = new WP_Query(array(
                'post_type' => 'portfolio',
                'posts_per_page' => 3
            ));

            if ($portfolio->have_posts()) :
                while ($portfolio->have_posts()) : $portfolio->the_post();
            ?>
                <div class="portfolio-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="portfolio-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="portfolio-content">
                        <h3><?php the_title(); ?></h3>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn">View Project</a>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="contact-form" title="Contact form"]'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?> 