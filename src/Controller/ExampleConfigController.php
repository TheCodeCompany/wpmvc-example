<?php
/**
 * Example configuration usage.
 *
 * @package MyApp\Core\Controller
 */

namespace MyApp\Core\Controller;

use WPMVC\Core\Controller;

/**
 * Example of how to use the WPMVC configuration manager.
 * This provides an example route which can be accessed via:
 *
 *  /example/config
 */
class ExampleConfigController extends Controller {

	/**
	 * Boot the controller.
	 *
	 * @return void
	 */
	public function set_up() {

		$this->route->add(
			[
				'regex'    => '^example/config/?$',
				'callback' => [ $this, 'route_example_config' ],
			]
		);

	}

	/**
	 * Callback for example route.
	 *
	 * @return void
	 */
	public function route_example_config() {

		echo '<pre>';

		// You can get the entire config file value like so.
		$config_file = $this->config->get( 'example' );

		echo 'example config file = ';
		var_dump( $config_file );  // phpcs:ignore
		echo '<br>';

		// You can pull a sinlge config item like so.
		$environment = $this->config->get( 'example', 'location' );

		echo 'example config item = ';
		var_dump( $environment );  // phpcs:ignore
		echo '<br>';

		echo '</pre>';

	}

}
