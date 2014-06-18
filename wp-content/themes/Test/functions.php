<?php
/**
 * Mega Test functinos and definitions
 *
 * @package Mega Test
 * @sing Mega Test 0.1
 */

if( ! isset($content_width))
    $content_width = 654;

if( ! function_exists('mega_test_setup')):
    // Setup theme defaults

    function mega_test_setup(){
        //Custom template tags for this theme
        require(get_template_directory() . '/inc/template-tags.php');

        //Custom functions that act independently of the theme templates
        require(get_template_directory() . '/inc/tweaks.php');

        //Make theme available for translation.
        load_theme_textdomain('mega-test', get_template_directory() . '/languages');

        //Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        //Enable support for the Aside Post Format
        add_theme_support('post-formats', array('aside'));

        //This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'mega-test')
        ));
    }
endif;
add_action('after_setup_theme', 'mega_test_setup');

//Register widgetized area and update sidebar with default widgets
function mega_test_widgets_init(){
    register_sidebar( array(
       'name' => __('Primary Widget Area', 'mega_test'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>'
    ));
    register_sidebar( array(
        'name' => __('Secondary Widget Area', 'mega_test'),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>'
    ));
}
add_action('widgets_init', 'mega_test_widgets_init');

//Enqueue Scripts and styles
function mega_test_scripts(){
    wp_enqueue_style('style', get_stylesheet_uri());

    if(is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140612', true);

    if(is_singular() && wp_attachment_is_image())
        wp_enqueue_script('keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20140612');
}
add_action('wp_enqueue_scripts', 'mega_test_scripts');

function mega_test_custom_background(){
    $args = array(
      'default-color' => 'e9e0d1'
    );

    $args = apply_filters('mega_test_custom_background_args', $args);

    if(function_exists('wp_get_theme'))
        add_theme_support('custom-background', $args);
    else{
        define('BACKGROUND_COLOR', $args['default-color']);
        define('BACKGROUND_IMAGE', $args['default-image']);
        add_theme_support('custom-background');
    }
}
add_action('after_setup_theme', 'mega_test_custom_background');