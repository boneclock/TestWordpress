<?php
/**
 * Comment Template.
 *
 * @package Mega Test
 * @sing Mega Test 0.1
 */
?>

<?php if(post_password_required()) return; ?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'shape' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', 'mega_test' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mega_test' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mega_test' ) ); ?></div>
            </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>

        <ol class="commentlist">
            <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use shape_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define shape_comment() and that will be used instead.
             * See shape_comment() in inc/template-tags.php for more.
             */
            wp_list_comments( array( 'callback' => 'mega_test_comment' ) );
            ?>
        </ol><!-- .commentlist -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php _e( 'Comment navigation', 'mega_test' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mega_test' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mega_test' ) ); ?></div>
            </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'mega_test' ); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div>