<?php
/**
 * Example REST endpoints.
 *
 * @package MyApp\Core\Controller
 */

namespace MyApp\Core\Controller;

use WPMVC\Core\Controller;
use WPMVC\View\ThemeableView;

/**
 * Example of how to define a custom route.
 * This provides an example route which can be accessed via:
 *
 *  /example/123
 */
class ExampleRouteController extends Controller {

	/**
	 * Boot the controller.
	 * This is where routes should be registered.
	 *
	 * @return void
	 */
	public function set_up() {

		$this->route->add(
			[
				'regex'    => '^example/([0-9]+)/?$',
				'callback' => [ $this, 'route_example' ],
			]
		);

	}

	/**
	 * Callback for example/arg route.
	 *
	 * @param string $arg Argument.
	 * @return void
	 */
	public function route_example( $arg ) {

		$view = new ThemeableView(
			$this->config,
			'example/example'
		);

		$view->set_param( 'example', 'This is an example' );

		$view->render();

	}

}
