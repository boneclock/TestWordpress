<?php
/**
 * Plugin Name: Doge That WordPress
 * Plugin URI: http://dogeweather.com
 * Version: 1.0
 * Author: DogeLover
 * Description: Add a little doge touch
 */

function doge_that_title($title){
    if(in_the_loop()){
        $random_nb = rand(1,3);

        switch($random_nb):
            case 1:
                return getDogePng(). "Much " . $title;
            case 2:
                return getDogePng(). "Wow " . $title;
            case 3:
                return getDogePng(). "So very " . $title;
            default:
                return "Doge " . $title . getDogePng();
        endswitch;
    }
    return $title;
}

function getDogePng(){
    return '<img alt="doge" width="40" height="40" src="'. plugins_url() .'/doge-that-wordpress/img/doge.png" />';
}

add_filter('the_title','doge_that_title');

function doge_that_footer(){
    echo getDogePng();
}

add_action('wp_footer','doge_that_footer');

function doge_admin_page(){
    echo '<h2>Doge</h2>';
}

function add_doge_options(){
    add_options_page(__('Doge Settings','doge'), __('Doge Settings','doge'), 1, "doge-settings", doge_admin_page());
}

add_action('admin_menu','add_doge_options');