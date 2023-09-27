<?php

namespace Dumpling\Interfaces;


interface OutputInterface {
	public function render( $data, $var_name );
}