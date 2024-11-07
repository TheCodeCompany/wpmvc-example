<?php
/**
 * Example code for adding WP Cli commands in your site.
 *
 * @package MyApp\Core\Controller
 */
namespace MyApp\Core\Controller;

use WPMVC\Core\Controller;
use WP_CLI;

/**
 * Example class for adding WP CLI commands.
 */
class ExampleWpCliController extends Controller {

	/**
	 * Setup your WP cli commands
	 *
	 * @return void
	 */
	public function set_up() {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			// Register the command properly with the 'clisample' namespace
			WP_CLI::add_command( 'clisample get-user-count', array( $this, 'get_row_count' ) );
		}
	}

	/**
	 * Sample function to get the row count of the wp_users table.
	 *
	 * @return void
	 */
	public function get_row_count() {
		global $wpdb;
		$result = $wpdb->get_results( 'SELECT COUNT(*) AS row_count FROM wp_users' );
		if ( ! $result ) {
			WP_CLI::error( 'Failed to execute query.' );
		}

		WP_CLI::success( 'Row count: ' . $result[0]->row_count );
	}
}
