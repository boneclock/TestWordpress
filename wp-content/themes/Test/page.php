<?php
/**
 * Template for displaying pages
 *
 * @package Mega Test
 * @since Mega Test 0.1
 */
?>
<? get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <!--The Loop-->
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('content','page'); ?>
            <?php comments_template('', true); ?>
        <?php endwhile; ?>
    </div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>