<?php
/**
 * Example REST endpoints.
 *
 * @package MyApp\Core\Controller
 */

namespace MyApp\Core\Controller;

use WPMVC\Core\Controller;

/**
 * Example of how to define a WordPress REST endpoint.
 * This will create an example endpoint, accessible via:
 *  /wp-json/example/v1/example/123
 */
class ExampleRESTController extends Controller {

	/**
	 * Boot the controller.
	 * This is where REST endpoint should be registered.
	 *
	 * @return void
	 */
	public function set_up() {

		$this->rest->endpoint(
			[
				'namespace'           => 'example',
				'action'              => 'example/(?P<id>\d+)',
				'method'              => [ \WP_REST_Server::READABLE ],
				'callback'            => [ $this, 'rest_example' ],
				'permission_callback' => [ $this, 'permission_check' ],
				'args'                => [
					'id' => [
						'required' => true,
						// 'validate_callback' => [ $this, 'validate_id' ],
					],
				],
			]
		);

	}

	/**
	 * Callback for example/arg REST endpoint.
	 *
	 * @param \WP_REST_Request $request The WP Rest Request.
	 * @param array            $params  The parameters for the request.
	 *
	 * @return array
	 */
	public function rest_example( $request, $params ) {

		// Build URL for example route.
		$url = sprintf(
			'%s/example/%s',
			home_url(),
			$request->get_param( 'id' )
		);

		$response = [
			'url' => $url,
		];

		return $response;

	}

	/**
	 * Verify a REST endpoint.
	 *
	 * @param \WP_REST_Request $request
	 * @param array            $params
	 *
	 * @return bool|false|int
	 */
	public function permission_check( \WP_REST_Request $request, $params ) {
		$is_valid = false;

		// https://developer.wordpress.org/rest-api/using-the-rest-api/authentication/

		// Authenticate user (verify the user is who they claim they are).

		// Authorise action for user (verify the user is allowed to do what they're trying to do).

		return $is_valid;
	}

}
