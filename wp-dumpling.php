<?php
/**
 * Plugin Name: WP Dumpling
 * Description: A WordPress Plugin to integrate the Dumpling package as a replacement for var_dump.
 * Version: 1.0
 * Author: Your Name
 */
// namespace WP_Dumpling;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once __DIR__ . '/vendor/Dumpling/vendor/autoload.php';

use Dumpling\Config;
use WP_CLI;

// Setup configurations
Config::set( 'assetBaseUrl', plugin_dir_url( __FILE__ ) . 'vendor/Dumpling/assets/dist/' );
Config::set( 'templateFilePath', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/templates/dump_template.php' );
Config::set( 'themesPath', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/themes' );
// logDirectory
Config::set( 'logDirectory', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/logs/' );


if ( ! function_exists( 'dumpling' ) ) {
	function dumpling( $data, $var_name = 'Variable' ) {
		// Calling the namespaced dumpling function
		return \Dumpling\Functions\dumpling( $data, $var_name );
	}
}



$test_array = array(
	'This is plugin file' => '⚙️',
	'one'                 => '1',
	'two'                 => '2',
	'three'               => '3',
	'four'                => '4',
	'five'                => '5',
);

dumpling( $test_array );




if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once plugin_dir_path( __FILE__ ) . 'src/CLI/DumplingCLICommand.php';
	require_once plugin_dir_path( __FILE__ ) . 'src/CLI/DumplingBlockTypesCommand.php';
	\WP_CLI::add_command( 'dumpling block_types', 'WP_Dumpling\CLI\DumplingBlockTypesCommand' );
	\WP_CLI::add_command( 'dumpling', '\WP_Dumpling\CLI\DumplingCLICommand' );

}