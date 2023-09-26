<?php

namespace Dumpling\Traits;

use Dumpling\Services\Logger;
use Dumpling\Config;

trait JsTrait {
	public function getJsContent(): string {
		$jsPath = Config::get( 'assetBaseUrl' ) . 'js/index.min.js';

		if ( ! file_exists( $jsPath ) ) {
			$errorMessage = "JS file not found at: {$jsPath}";

			// Use Logger service to log error message
			Logger::logError( $errorMessage );

			// Die or return empty string based on the environment
			if ( Config::get( 'isDevelopment', false ) ) {
				die( $errorMessage );
			}
			return '';
		}
		return file_get_contents( $jsPath );
	}
}