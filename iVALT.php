<?php

header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
// header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval';");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: same-origin");
header("Feature-Policy: geolocation 'none'; microphone 'self'");
header("Cross-Origin-Resource-Policy: same-site");
// Remove X-Powered-By header
header_remove('X-Powered-By');
header_remove('Server');
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ivalt.com/author/
 * @since             1.0.0
 * @package           iVALT
 *
 * @wordpress-plugin
 * Plugin Name:       iVALT
 * Plugin URI:        https://ivalt.com/
 * Description:       This plugin uses mobile biometrics to log into your WordPress website. Faster and more secure than 2FA.
 * Version:           1.0.0
 * Author:            iVALT
 * Author URI:        https://ivalt.com/author/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       iVALT
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WebID_VERSION', '1.0.0' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}	

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-web-id-activator.php
 */
function activate_web_id() {
    require_once plugin_dir_path(__FILE__) . 'database/class-web-id-tables-generator.php';
	require_once plugin_dir_path(__FILE__) . 'includes/class-web-id-activator.php';
	WebID_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-web-id-deactivator.php
 */
function deactivate_web_id() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-web-id-deactivator.php';
	Ivalt_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_web_id' );
register_deactivation_hook( __FILE__, 'deactivate_web_id' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-webID.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_web_id() {

	$plugin = new WebID();
	$plugin->run();

}
run_web_id();
