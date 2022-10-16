<?php

/**
 * Plugin Name:       Webnar's
 * Plugin URI:        https://codingzon.com
 * Description:       This is webnar's plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            CodingZon
 * Author URI:        https://codingzon.com
 * License:           GPL v2 or later
 * Text Domain:       Webnars
 * Domain Path:       languages
 */


if (!defined('ABSPATH')) exit(); // No direct access allowed

function cst_enqueueFile2()
{
    wp_register_script('vueJsfileCst', plugin_dir_url(__FILE__) . 'public/js/app.js', NULL, 1.0, true);
    wp_localize_script('vueJsfileCst', 'localAccess', array(
        'nonce' => wp_create_nonce('wp_rest'),
        'apiSiteURL' => get_site_url() . '/wp-json',
    ));
}
add_action('wp_enqueue_scripts', 'cst_enqueueFile2');

//  //Add shortscode
function func_wp_vue()
{
    wp_enqueue_script('vueJsfileCst');

    $str = "<div id='app'></div>";
    return $str;
} // end function
add_shortcode('wpvue', 'func_wp_vue');


// ===============================

add_action('rest_api_init', function () {
    register_rest_route(
        'api/webonars',
        '/student',
        array(
            'methods' => 'POST',
            'callback' => 'createNewUser',
        )
    );
});


function createNewUser(WP_REST_Request $request)
{
    
    // $my_post = array(
    //     'post_title'    => 'My post',
    //     'post_content'  => 'This is my post.',
    //     'post_status'   => 'publish',
    //     'post_author'   => 1,
    //     'post_category' => array(8, 39)
    // );

    // // Insert the post into the database.
    // $res = wp_insert_post($my_post);
    // return wp_send_json($res);

    try {
        $user_id = username_exists($request['username']);
        if ($user_id) {
            return wp_send_json([
                'message'            => __('Username already exists.', 'Webnars'),
            ], 400);
        }
        if (email_exists($request['email'])) {
            return wp_send_json([
                'message'            => __('Email already exists.', 'Webnars'),
            ], 400);
        }
        $user_id = wp_create_user($request['username'], $request['username'], $request['email']);

        return wp_send_json([
            'message'            => __('Congratulation', 'Webnars'),
        ], 200);
    } catch (\Throwable $th) {
        return wp_send_json([
            'message'            => $th->getMessage(),
        ], 400);
    }
}
