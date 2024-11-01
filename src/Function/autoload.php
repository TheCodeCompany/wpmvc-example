<?php
/**
 * Autoload function files.
 *
 * @package MyApp\Core\Function
 */

$function_files = glob( __DIR__ . DIRECTORY_SEPARATOR . '*.php' );
foreach ( $function_files as $function_file ) {
	require_once $function_file;
}
