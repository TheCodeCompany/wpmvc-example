<?php
/**
 * Plugin Name: Example Corp WPMVC
 * Description: WPMVC plugin for Example Corp.
 * Version:     1.0.0-alpha
 *
 * @package ExampleCorp
 */

namespace ExampleCorp;

use WPMVC\Core\Application;
use ExampleCorp\Core\Controller\RegisterPostType\RegisterMovieController;
use ExampleCorp\Core\Controller\RegisterTaxonomy\RegisterGenreController;

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';

	define( 'ExampleCorp\APP_NAME', 'example-corp' );

	$example_corp_app = new Application(
		APP_NAME,  // The application name / slug.
		__DIR__,  // The application root directory.
		[  // The application controllers
			
			// Custom Post types.
			new RegisterMovieController(),

			// Custom Taxonomies.
			new RegisterGenreController(),
		]
	);

} elseif ( function_exists( 'is_local' ) && is_local() ) {
	// Trigger an error for local environment only.
	wp_die( 'Run the project script build.sh, or run composer build for the Example Corp Plugin. "wp-content/mu-plugins/example-corp/".', E_USER_ERROR ); // phpcs:ignore
}
