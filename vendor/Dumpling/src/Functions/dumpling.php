<?php

namespace Dumpling\Functions;

if ( ! function_exists( 'Dumpling\Functions\dumpling' ) ) {
	function dumpling( $data, $var_name = 'Variable' ) {
		static $dumpling = null;

		if ( $dumpling === null ) {
			$dumpling = new \Dumpling\Dumpling();
		}

		$dumpling->dump( $data, $var_name );
	}
}