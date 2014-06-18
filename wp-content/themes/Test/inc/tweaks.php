<?php
/**
 * Custom functions that acts independently of the theme templates
 *
 * note that some of those functionality could be replace by core features in future versions.
 *
 * @package Mega Test
 * @since Mega Test 0.1
 */

/*
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
 * @since Mega Test 0.1
 */
function mega_test_page_menu_args($args){
    $args['show_home'] = true;
    return $args;
}
add_filter('wp_page_menu_args', 'mega_test_page_menu_args');

/*
 * Adds Custom classes to the array of body classes.
 * @since Mega Test 0.1
 */
function mega_test_body_classes($classes){
    //Adds a class of group-blog to blogs with more than 1 published author
    if( is_multi_author()){
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter('body_class', 'mega_test_body_classes');

/*
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment.
 * @since Mega Test 0.1
 */
function mega_test_enhanced_image_navigation( $url, $id ){
    if(! is_attachment() && ! wp_attachment_is_image($id))
        return $url;

    $image = get_post($id);
    if(! empty($image->post_parent) && $image->post_parent != $id)
        $url .= '#main';

    return $url;
}
add_filter('attachment_link', 'mega_test_enhanced_image_navigation');