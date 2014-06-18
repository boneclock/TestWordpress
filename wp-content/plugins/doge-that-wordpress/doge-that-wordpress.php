<?php
/**
 * Plugin Name: Doge That WordPress
 * Plugin URI: http://dogeweather.com
 * Version: 1.0
 * Author: DogeLover
 * Description: Add a little doge touch
 */

function dtw_titles($title){
    if(in_the_loop()){
        $random_nb = rand(1,3);

        switch($random_nb):
            case 1:
                return dtw_getDogePng(). "Much " . $title;
            case 2:
                return dtw_getDogePng(). "Wow " . $title;
            case 3:
                return dtw_getDogePng(). "So very " . $title;
            default:
                return "Doge " . $title . dtw_getDogePng();
        endswitch;
    }
    return $title;
}

function dtw_getDogePng(){
    return '<img alt="doge" width="40" height="40" src="'. plugins_url() .'/doge-that-wordpress/img/doge.png" />';
}

add_filter('the_title','dtw_titles');

function dtw_footer(){
    echo dtw_getDogePng();
}

add_action('wp_footer','dtw_footer');

function dtw_admin_page(){
    include('admin/doge-that-wordpress-admin.php');
}

function dtw_admin_menu(){
    $page_title = 'Doge That Wordpress - Settings';
    $menu_title = 'Doge That Wordpress';
    $capability = 'manage_options';
    $menu_slug = 'doge-that-wordpress';
    $function = 'dtw_admin_page';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

add_action('admin_menu','dtw_admin_menu');