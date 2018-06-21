<?php
/**
 * Plugin Name:     Ziddy Mailchimp
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     A Wordpress plugin for managing Mailchimp subscriptions
 * Author:          Zach Townsend
 * Author URI:      zachtownsend.net
 * Text Domain:     ziddy-mailchimp
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Ziddy_Mailchimp
 */
/**
 * ================
 * Plugin Constants
 * ================
 */

/**
 * The plugin slug
 */
define( 'ZIDDY_MAILCHIMP_SLUG', 'ziddy-mailchimp' );

/**
 * Plugin version
 */
define( 'ZIDDY_MAILCHIMP_VERSION', '0.1.0' );

/**
 * Plugin root path
 */
define( 'ZIDDY_MAILCHIMP_PLUGIN_ROOT', plugin_dir_path( dirname( __FILE__ ) ) . 'ziddy-mailchimp/' );

/**
 * ============
 * Dependencies
 * ============
 */
require 'vendor/autoload.php';
require_once 'includes/class-ziddy-mailchimp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ziddy_mailchimp() {
	$plugin = new Ziddy_Mailchimp();
	$plugin->run();
}
run_ziddy_mailchimp();
