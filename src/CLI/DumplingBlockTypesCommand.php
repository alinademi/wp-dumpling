<?php
namespace WP_Dumpling\CLI;

use WP_CLI_Command;
use WP_CLI;

class DumplingBlockTypesCommand extends WP_CLI_Command {

	/**
	 * Dump the registered block types.
	 *
	 * ## EXAMPLES
	 *
	 *     wp dumpling block_types
	 *
	 */
	public function __invoke() {
		$block_types = \WP_Block_Type_Registry::get_instance()->get_all_registered();
		if ( empty( $block_types ) ) {
			WP_CLI::error( 'No block types are registered.' );
			return;
		}
		$dumpling = new \Dumpling\Dumpling();
		$dumpling->dump( $block_types, 'Registered Block Types' );
	}
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'dumpling block_types', 'WP_Dumpling\CLI\DumplingBlockTypesCommand' );
}