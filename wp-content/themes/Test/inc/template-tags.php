<?php
/**
 * Custom template tags for this theme
 *
 * note that some of those functionality could be replace by core features in future versions.
 *
 * @package Mega Test
 * @since Mega Test 0.1
 */

if(!function_exists('mega_test_posted_on')):
    /*
     * Print HTML with meta information for the current post-date/time and author.
     * @since Mega Test 0.1
     */
    function mega_test_posted_on(){
        printf( __('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time>' .
            '</a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%7$s" rel="author">' .
            '%7$s</a></span></span>', 'mega_test'),
            esc_url(get_permalink()),
            esc_attr(get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_url( get_author_posts_url(get_the_author_meta(('ID')))),
            esc_attr( sprintf(__('View all posts by %s','mega_test'), get_the_author())),
            esc_html(get_the_author())
        );
    }
endif;

/*
 * Returns true if a blog has more than 1 category
 * @since Mega Test 0.1
 */
function mega_test_categorized_blog(){
    if(($categories = get_transient('categories')) === false){
        $categories = get_categories(array('hide_empty' => 1));
        $categories = count($categories);
        set_transient('categories', $categories);
    }

    if($categories != '1')
        return true;
    else
        return false;
}

/*
 * Flush out the transcients used in mega_test_categorized_blog
 * @since Mega Test 0.1
 */
function mega_test_category_transient_flusher(){
    delete_transient('categories');
}
add_action('edit_category', 'mega_test_category_transient_flusher');
add_action('save_post', 'mega_test_category_transient_flusher');

if ( ! function_exists( 'mega_test_content_nav' ) ):
    /**
     * Display navigation to next/previous pages when applicable
     *
     * @since Mega Test 0.1
     */
    function mega_test_content_nav( $nav_id ) {
        global $wp_query, $post;

        // Don't print empty markup on single pages if there's nowhere to navigate.
        if ( is_single() ) {
            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous )
                return;
        }

        // Don't print empty markup in archives if there's only one page.
        if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
            return;

        $nav_class = 'site-navigation paging-navigation';
        if ( is_single() )
            $nav_class = 'site-navigation post-navigation';

        ?>
        <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
            <h1 class="assistive-text"><?php _e( 'Post navigation', 'shape' ); ?></h1>

            <?php if ( is_single() ) : // navigation links for single posts ?>

                <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'shape' ) . '</span> %title' ); ?>
                <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'shape' ) . '</span>' ); ?>

            <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

                <?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'shape' ) ); ?></div>
                <?php endif; ?>

                <?php if ( get_previous_posts_link() ) : ?>
                    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'shape' ) ); ?></div>
                <?php endif; ?>

            <?php endif; ?>

        </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
    }
endif;

if(!function_exists('mega_test_comment')):
    /*
     * Template For comments and pingbacks
     * @sing Mega Test 0.1
     */

    function mega_test_comment($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;
        switch($comment->comment_type):
            case 'pingback':
            case 'trackback':
        ?>
        <li class="post pingback">
            <p>
                <?php _e('Pingback:', 'mega_test'); ?> <?php comment_author_link(); ?>
                <?php edit_comment_link(__('(Edit)','mega_test'), ' '); ?>
            </p>
        <?php
                break;
            default:
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <footer>
                    <div class="comment-author vcard">
                        <?php echo get_avatar( $comment, 40 ); ?>
                        <?php printf( __( '%s <span class="says">says:</span>', 'shape' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    </div><!-- .comment-author .vcard -->
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php _e( 'Your comment is awaiting moderation.', 'shape' ); ?></em>
                        <br />
                    <?php endif; ?>

                    <div class="comment-meta commentmetadata">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <time pubdate datetime="<?php comment_time( 'c' ); ?>">
                                <?php
                                /* translators: 1: date, 2: time */
                                printf( __( '%1$s at %2$s', 'shape' ), get_comment_date(), get_comment_time() ); ?>
                            </time>
                        </a>
                        <?php edit_comment_link( __( '(Edit)', 'shape' ), ' ' );
                        ?>
                    </div><!-- .comment-meta .commentmetadata -->
                </footer>

                <div class="comment-content"><?php comment_text(); ?></div>

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </article><!-- #comment-## -->
        <?php
            break;
        endswitch;
    }
endif;