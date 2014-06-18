<?php
/**
 * Template for single post
 *
 * @package Mega Test
 * @since Mega Test 0.1
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php while(have_posts()):the_post(); ?>

            <?php mega_test_content_nav('nav-above'); ?>

            <?php get_template_part('content','single') ?>

            <?php mega_test_content_nav('nav-below'); ?>

            <?php
                //If comments are open or we have at least one comment, load up the comment template
                if(comments_open() || get_comments_number() != '0')
                    comments_template('',true);
            ?>

        <?php endwhile; ?>
    </div>
</div>

<?php get_sidebar() ?>

<?php get_footer() ?>
