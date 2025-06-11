<?php get_header(); ?>

<main class="services-archive">
    <h1>Our Services</h1>
    
    <div class="services-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="service-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="service-content">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'service_category');
                    if ($categories) :
                    ?>
                        <div class="service-tags">
                            <?php foreach ($categories as $category) : ?>
                                <span class="tag"><?php echo $category->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>" class="btn">Learn More</a>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?> 