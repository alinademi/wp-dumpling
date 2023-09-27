<?php
/**
 * Plugin Name: WP Dumpling
 * Description: A WordPress Plugin to integrate the Dumpling package as a replacement for var_dump.
 * Version: 1.0
 * Author: Your Name
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once __DIR__ . '/vendor/Dumpling/vendor/autoload.php';

use Dumpling\Dumpling;
use Dumpling\Config;

// Setup configurations
Config::set( 'assetBaseUrl', plugin_dir_url( __FILE__ ) . 'vendor/Dumpling/assets/dist/' );
Config::set( 'templateFilePath', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/templates/dump_template.php' );
Config::set( 'themesPath', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/themes' );
// logDirectory
Config::set( 'logDirectory', plugin_dir_path( __FILE__ ) . 'vendor/Dumpling/logs/' );


if ( ! function_exists( 'WP_CLI\Runner\maybe_auto_launch' ) ) {
	function dumpling( $variable ) {
		$dumpling = new Dumpling();
		$dumpling->dump( $variable );
	}
}



$test_array = array(
	'one'   => '1',
	'two'   => '2',
	'three' => '3',
	'four'  => '4',
	'five'  => '5',
);

dumpling( $test_array );



// use the above class to dump blocks recursively with their inner blocks in the post content
function dump_blocks( $post_id ) {
	$post   = get_post( $post_id );
	$blocks = parse_blocks( $post->post_content );
	$blocks = array_map( function ($block) {
		$block['innerBlocks'] = array_map( function ($inner_block) {
			return $inner_block->blockName;
		}, $block['innerBlocks'] );
		return $block;
	}, $blocks );
	dumpling( $blocks );
}
add_action( 'the_post', 'dump_blocks' );

// add_action( 'admin_footer', function () use ($test_array) {
// 	dumpling( $test_array );
// } );



// function wp_dumpling_enqueue_scripts() {
// // Get the configured paths from the Dumpling package and enqueue them in WordPress.
// $assetBaseUrl = Config::get( 'assetBaseUrl' ); // Here, Config refers to Dumpling\Config due to the use statement
// above.

// // Enqueue Styles.
// wp_enqueue_style( 'wp-dumpling-styles', $assetBaseUrl . 'css/styles.min.css' );

// // Enqueue Scripts.
// wp_enqueue_script( 'wp-dumpling-scripts', $assetBaseUrl . 'js/index.min.js', array(), false, true );
// }

// // Hook to enqueue the scripts and styles.
// add_action( 'wp_enqueue_scripts', 'wp_dumpling_enqueue_scripts' );