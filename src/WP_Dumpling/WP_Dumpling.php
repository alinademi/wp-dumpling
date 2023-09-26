<?php

namespace WP_Dumpling\WP_Dumpling;

use Dumpling\Dumpling;

class WP_Dumpling {
	private $dumpling;

	public function __construct() {
		$this->init();
	}

	private function init() {
		$this->dumpling = new Dumpling( [ 
			'css' => WP_DUMPLING_PATH . 'Dumpling/assets/css/index.css',
			'js'  => WP_DUMPLING_PATH . 'Dumpling/assets/js/index.js',
		] );

		$this->register_hooks();
	}

	private function register_hooks() {
		// Hook registration logic
	}

	public static function activate() {
		// Activation logic
	}

	public static function deactivate() {
		// Deactivation logic
	}

	public static function uninstall() {
		// Uninstall logic
	}
}