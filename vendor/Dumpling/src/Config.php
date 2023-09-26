<?php

namespace Dumpling;

use Dumpling\Services\Logger;

/**
 * Class Config
 * Manages configurations and settings for the Dumpling package.
 *
 * @package Dumpling
 */
class Config {

	/**
	 * @var array Configurations storage.
	 * Each config has an associated 'type' and 'value'.
	 * Types:
	 * 'dir': Represents a directory path and ensures that it ends with a '/'.
	 * 'file': Represents a file path and ensures that it ends with a '/'.
	 * 'url': Represents a URL and ensures that it ends with a '/'.
	 * 'bool': Represents a boolean value.
	 * 'string': Represents a string value.
	 */
	private static $configs = [ 
		'isDevelopment'    => [ 'value' => false, 'type' => 'bool' ],
		'logDirectory'     => [ 'value' => __DIR__ . '/../../logs/', 'type' => 'dir' ],
		'logErrors'        => [ 'value' => true, 'type' => 'bool' ],
		'outputBuffering'  => [ 'value' => true, 'type' => 'bool' ],
		'defaultTheme'     => [ 'value' => 'base16', 'type' => 'string' ],
		'assetBaseUrl'     => [ 'value' => '/assets/dist/', 'type' => 'url' ],
		'templateFilePath' => [ 'value' => __DIR__ . '/../../templates/dump_template.php', 'type' => 'file' ],
		'themesPath'       => [ 'value' => __DIR__ . '/../../themes', 'type' => 'dir' ],
	];

	/**
	 * Retrieves a configuration value.
	 *
	 * @param string $key The key of the configuration.
	 * @param mixed $default The default value to return if the configuration key does not exist.
	 * @return mixed The configuration value.
	 */
	public static function get( $key, $default = null ) {
		if ( ! isset( self::$configs[ $key ] ) ) {
			self::logError( "Config key {$key} is not set." );
			return $default;
		}

		$configItem = self::$configs[ $key ];
		$value      = $configItem['value'];
		$type       = $configItem['type'];

		switch ( $type ) {
			case 'dir':
				return rtrim( $value, '/' ) . '/';
			case 'file':
				return rtrim( $value, '/' );
			case 'url':
				return rtrim( $value, '/' ) . '/';
			default:
				return $value;
		}
	}

	/**
	 * Sets a configuration value.
	 *
	 * @param string $key The key of the configuration.
	 * @param mixed $value The value to set.
	 */
	public static function set( $key, $value ) {
		if ( ! isset( self::$configs[ $key ] ) ) {
			self::logError( "Config key {$key} is not set." );
			return;
		}

		$type = self::$configs[ $key ]['type'];
		switch ( $type ) {
			case 'dir':
			case 'file':
			case 'url':
				$value = rtrim( $value, '/' );
				break;
			case 'bool':
				$value = (bool) $value;
				break;
			case 'string':
				$value = (string) $value;
				break;
		}

		self::$configs[ $key ]['value'] = $value;
	}

	private static function logError( $message ) {
		Logger::logError( $message );
	}
}