<?php

namespace Dumpling\Traits;

use Dumpling\Config;
use Dumpling\Services\Logger;

trait ThemeDataTrait {

	private function getThemeData() {
		$themesPath = Config::get( 'themesPath', __DIR__ . '/../../themes' );
		if ( ! is_dir( $themesPath ) || ! is_readable( $themesPath ) ) {
			Logger::logError( "Cannot read from the themes directory: {$themesPath}" );
			return [];
		}

		$themesData = [];

		foreach ( scandir( $themesPath ) as $file ) {
			if ( '.' === $file || '..' === $file )
				continue;

			$filePath = $themesPath . '/' . $file;

			if ( is_file( $filePath ) ) {
				$themeName                = pathinfo( $file, PATHINFO_FILENAME );
				$themesData[ $themeName ] = json_decode( file_get_contents( $filePath ), true );

				if ( json_last_error() !== JSON_ERROR_NONE ) {
					Logger::logError( "Error decoding JSON for file {$filePath}: " . json_last_error_msg() );
				}
			}
		}

		return $themesData;
	}
}