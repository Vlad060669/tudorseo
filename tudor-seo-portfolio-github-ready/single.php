<?php get_header(); ?>

<main class="blog-post">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
                <div class="post-meta">
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                    <span class="post-author">By <?php the_author(); ?></span>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-image">
                    <?php the_post_thumbnail('large', array('loading' => 'lazy')); ?>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <footer class="post-footer">
                <div class="post-tags">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) {
                        foreach ($tags as $tag) {
                            echo '<span>' . esc_html($tag->name) . '</span>';
                        }
                    }
                    ?>
                </div>
            </footer>
        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

        <nav class="post-navigation">
            <?php
            the_post_navigation(array(
                'prev_text' => '← Previous Post',
                'next_text' => 'Next Post →',
            ));
            ?>
        </nav>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?> 