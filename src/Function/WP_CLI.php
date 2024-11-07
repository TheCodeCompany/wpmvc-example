<?php
/**
 * Adds WP CLI helper functions.
 *
 * @package MyApp\Core
 */

namespace WPMVC\Core;

/**
 * Returns if WP CLI is loaded and available.
 *
 * @return bool
 */
function is_wp_cli(): bool {
	return defined( 'WP_CLI' ) && WP_CLI && class_exists( 'WP_CLI' );
}
