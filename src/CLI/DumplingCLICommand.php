<?php

namespace WP_Dumpling\CLI;

use WP_CLI_Command;
use Dumpling\Dumpling;

class DumplingCLICommand extends WP_CLI_Command {

	/**
	 * Dumps information about a variable.
	 *
	 * ## OPTIONS
	 *
	 * <variable>
	 * : The variable you want to dump.
	 *
	 * [--var_name=<var_name>]
	 * : The name of the variable you want to dump.
	 * ---
	 * default: 'Variable'
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp dumpling $variable
	 *     wp dumpling $variable --var_name='My Variable'
	 *
	 * @when after_wp_load
	 */
	public function dump( $args, $assoc_args ) {
		$identifier = $args[0];
		$type       = $assoc_args['type'] ?? 'option';
		$var_name   = $assoc_args['var_name'] ?? 'Variable';

		switch ( $type ) {
			case 'option':
				$variable = get_option( $identifier, 'Option does not exist.' );
				break;
			case 'post':
				$variable = get_post( $identifier );
				break;
			case 'user':
				$variable = get_user_by( 'id', $identifier );
				break;
			case 'block':
				$post_id = $assoc_args['post_id'] ?? null;
				if ( $post_id ) {
					// Get block(s) from the specified post
					$variable = $this->get_blocks_from_post( $post_id, $identifier );
				} else {
					// Get block(s) from all posts
					$variable = $this->get_all_blocks( $identifier );
				}
				break;
			default:
				WP_CLI::error( 'Invalid type provided.' );
				return;
		}

		$dumpling = new \Dumpling\Dumpling();
		$dumpling->dump( $variable, $var_name );
	}

	private function get_blocks_from_post( $post_id, $block_name ) {
		$post_content = get_post_field( 'post_content', $post_id );
		// Here you might parse the $post_content and extract the specified block(s)
		// based on block name or other criteria
		return $extracted_block;
	}

	private function get_all_blocks( $block_name ) {
		// Here you might perform a query to get all blocks of the specified type
		// from all posts, and return them
		return $all_blocks;
	}
}