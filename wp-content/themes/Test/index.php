<?php get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content">
        <?php if(have_posts()) : ?>

            <?php mega_test_content_nav('nav_above') ?>
            <?php while(have_posts()): the_post() ?>
                <?php
                    /* Include the Post-Format-specific template for the content.
                    * If you want to overload this in a child theme then include a file
                    * called content-___.php (where ___ is the Post Format name) and    that will be used instead.
                    */
                    get_template_part( 'content', get_post_format() );
                ?>
            <?php endwhile; ?>
            <?php mega_test_content_nav('nav_below') ?>
        <?php else: ?>
            <?php get_template_part( 'no-results', 'index' ); ?>
        <?php endif; ?>
    </div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>