<?php get_header(); ?>

<main class="portfolio-archive">
    <h1>Our Portfolio</h1>
    
    <div class="portfolio-filters">
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'portfolio_category',
            'hide_empty' => true,
        ));
        
        if ($categories) :
        ?>
            <ul class="filter-list">
                <li><a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="active">All</a></li>
                <?php foreach ($categories as $category) : ?>
                    <li><a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="portfolio-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="portfolio-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="portfolio-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="portfolio-content">
                    <h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                    
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    if ($categories) :
                    ?>
                        <div class="portfolio-tags">
                            <?php foreach ($categories as $category) : ?>
                                <span class="tag"><?php echo $category->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>" class="btn">View Project</a>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>

    <?php
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => 'Previous',
        'next_text' => 'Next',
    ));
    ?>
</main>

<?php get_footer(); ?> 