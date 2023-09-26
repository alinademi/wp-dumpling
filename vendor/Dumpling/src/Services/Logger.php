<?php

namespace Dumpling\Services;

use Dumpling\Config;

class Logger {
	public static function logError( $message ) {
		$logDirectory = Config::get( 'logDirectory', __DIR__ . '/../../logs/' );

		if ( ! is_dir( $logDirectory ) ) {
			mkdir( $logDirectory, 0777, true );
		}

		$logFile    = $logDirectory . 'error.log';
		$logMessage = '[' . date( 'Y-m-d H:i:s' ) . '] ' . $message . PHP_EOL;

		error_log( $logMessage, 3, $logFile );
	}
}