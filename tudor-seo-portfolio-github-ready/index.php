<?php get_header(); ?>

<main class="blog-index">
    <?php if (have_posts()) : ?>
        <div class="blog-grid">
            <?php while (have_posts()) : the_post(); ?>
                <article class="blog-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="blog-image">
                            <?php the_post_thumbnail('large', array('loading' => 'lazy')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="blog-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                            <span class="post-author">By <?php the_author(); ?></span>
                        </div>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => 'Previous',
            'next_text' => 'Next',
        ));
        ?>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?> 