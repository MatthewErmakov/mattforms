<?php
/**
 * Plugin Name:          MattForms
 * Plugin URI:           https://wpmatt.com/plugins/mattforms
 * Author:               MattWP
 * Author URI:           https://wpmatt.com/about
 * GitHub Plugin URI:    https://github.com/mattwp/mattwp
 *
 * Version:              1.0.0
 * Requires at least:    5.4
 * Tested up to:         6.4.1
 *
 * Text Domain:          mattforms
 * Domain Path:          /languages/
 *
 * @category             Plugin
 * @copyright            Copyright © 2012 Matthew Yermakov, Copyright © 2021 WPMatt
 * @author               Matthew Yermakov, WPMatt
 * @package              MattForms
 * @license              GPL2
 */

namespace MattForms;

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

$kernel = new App\Kernel( 
    '1.0.0',                      // Plugin version
    'mattforms',                  // Plugin text domain
    plugin_dir_path( __FILE__ ),  // Plugin directory path
    plugin_dir_url( __FILE__ )    // Plugin URL path
);

// run Kernel instance
$kernel->run();
