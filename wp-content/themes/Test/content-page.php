<?php
/**
 * Template for displaying page content
 *
 * @package Mega Test
 * @since Mega Test 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry-content">
        <?php the_content();?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'shape' ), 'after' => '</div>' ) ); ?>
        <?php edit_post_link( __( 'Edit', 'shape' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
</article>