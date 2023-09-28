<?php

namespace Dumpling\Handlers;

use Dumpling\Config;

class AssetHandler {

	private static $jsIncluded = false;
	private static $cssIncluded = false;
	private static $themeDataIncluded = false;

	public static function includeJS() {
		if ( self::$jsIncluded )
			return '';
		self::$jsIncluded = true;
		$jsUrl            = Config::get( 'assetBaseUrl' ) . 'js/index.min.js';
		return "<script defer src=\"" . htmlspecialchars( $jsUrl ) . "\"></script>";
	}

	public static function includeCSS() {
		if ( self::$cssIncluded )
			return '';
		self::$cssIncluded = true;
		$cssUrl            = Config::get( 'assetBaseUrl' ) . 'css/styles.min.css';
		return "<link rel=\"stylesheet\" href=\"" . htmlspecialchars( $cssUrl ) . "\">";
	}

	public static function includeThemeData( $themeData ) {
		if ( self::$themeDataIncluded )
			return '';
		self::$themeDataIncluded = true;
		return "<script id=\"theme-data\" type=\"application/json\" data-themes=\"" .
			htmlspecialchars( json_encode( $themeData ), ENT_QUOTES, 'UTF-8' ) . "\"></script>";
	}
}
