<?php
/*
 * Plugin Name: e주보 Creator
 * Plugin URI: http://m.elgrace.com
 * Description: A plugin to create the e주보 for Elgrace church
 * Author: Matthew Weaver
 * Version: 1.0
 * Author URI: http://m.elgrace.com
 */

// Set up our WordPress Plugin
function jk_check_WP_ver()
{
   if ( version_compare( get_bloginfo( 'version' ), '3.1', '<' ) )
   {
      wp_die("You must update WordPress to use this plugin!");
   }
   
   if ( get_option( 'jk_op_array' ) === false )
   {
//      $options_array['jk_op_yt_username'] = 'jaskokoyn';
//      $options_array['jk_op_version'] = '1';
      add_option( 'jk_op_array', $options_array );
   }
}
register_activation_hook( __FILE__, 'jk_check_WP_ver' );

// Include or Require any files
include('inc/process.php');
include('inc/display-options.inc.php');
include('inc/menus.inc.php');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
$styleurl = plugins_url( 'css/style.css' , __FILE__ );
wp_register_style( 'jubostyle', $styleurl );


// Action & Filter Hooks
add_action( 'admin_menu', 'jk_add_admin_menu' );
add_action( 'admin_post_jk_save_youtube_option', 'process_jk_youtube_options' );
add_action( 'admin_post_jk_save_youtube_option2', 'process_jk_youtube_options2' );
add_action( 'admin_post_jk_save_youtube_option3', 'process_jk_youtube_options3' );
//add_action( 'admin_post_jb_submit_wednesday', 'process_jb_wednesday_jubo' );
?>