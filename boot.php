<?php
/**
 * Plugin Name: Example Corp WPMVC
 * Description: WPMVC plugin for Example Corp.
 * Version:     1.0.0-alpha
 *
 * @package MyApp
 */

namespace MyApp;

use WPMVC\Core\Application;
use MyApp\Core\Controller\RegisterPostType\RegisterMovieController;
use MyApp\Core\Controller\RegisterTaxonomy\RegisterGenreController;

// Uncomment this to enable WP CLI commands. Don't forget to include wp cli dependency in composer.json.
// use MyApp\Core\Controller\ExampleWpCliController;
// use function MyApp\Core\is_wp_cli;

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';

	define( 'MyApp\APP_NAME', 'tcc-importer' );

	// Initialize controllers array
	$controllers = array(
		// Custom Post types.
		new RegisterMovieController(),

		// Custom Taxonomies.
		new RegisterGenreController(),
	);

	// Add the controllers that you need to run in WP CLI. This will make sure that the controllers are only loaded when WP CLI is available.
	if ( php_sapi_name() == 'cli' ) {
		// Uncomment this to enable WP CLI commands. Don't forget to include wp cli dependency in composer.json.
		// $controllers[] = new ExampleWpCliController();
	}

	// Instantiate the Application with the controllers array
	$my_app = new Application(
		APP_NAME,  // The application name / slug.
		__DIR__,   // The application root directory.
		$controllers // The controllers array
	);

} elseif ( function_exists( 'is_local' ) && is_local() ) {
	// Trigger an error for local environment only.
	wp_die( 'Run the project script build.sh, or run composer build for the Example Corp Plugin. "wp-content/mu-plugins/example-corp/".', E_USER_ERROR ); // phpcs:ignore
}
