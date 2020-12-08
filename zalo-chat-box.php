<?php
/**
 * Plugin Name: A Zalo Chat Box
 * Description: A Zalo Chat Box.
 * Version: 1.0.4
 */
if (! defined( 'ABSPATH' )) die;

define( 'ZCB_VERSION', '1.0.0' );
define( 'ZCB_FILE', __FILE__ );
define( 'ZCB_NAME', basename(ZCB_FILE) );
define( 'ZCB_BASE_NAME', plugin_basename( ZCB_FILE ));
define( 'ZCB_PATH' , plugin_dir_path( ZCB_FILE ));
define( 'ZCB_URL', plugin_dir_url( ZCB_FILE ));
define( 'ZCB_ASSETS_URL', ZCB_URL . 'assets/' );

require_once ZCB_PATH . '/inc/class-zalo-chat-box.php';
Zalo_Chat_Box::instance();