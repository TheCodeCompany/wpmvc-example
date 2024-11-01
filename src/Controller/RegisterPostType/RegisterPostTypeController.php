<?php
/**
 * RegisterPostTypeController.php
 *
 * @package ExampleCorp\Core\Controller
 */

namespace ExampleCorp\Core\Controller\RegisterPostType;

use ExampleCorp\Core\Controller\Controller;

/**
 * Base foundation for registering and managing a post type.
 */
abstract class RegisterPostTypeController extends Controller {

	/**
	 * Registers the post type and base features.
	 */
	public function set_up(): void {
		$this->add_actions();
	}

	/**
	 * Adds actions for post type registration.
	 */
	protected function add_actions(): void {
		add_action( 'init', [ $this, 'register_post_type' ] );
	}

	/**
	 * Registers the post type in WordPress.
	 *
	 * @return \WP_Error|\WP_Post_Type
	 */
	public function register_post_type(): \WP_Error|\WP_Post_Type {
		$wp_post_type = null;

		$post_type = $this->get_post_type();
		$args      = $this->get_register_post_type_args();

		$wp_post_type = register_post_type( $post_type, $args );

		return $wp_post_type;
	}

	/**
	 * Gets the post type.
	 *
	 * @return string
	 */
	abstract protected function get_post_type(): string;

	/**
	 * Gets the arguments for post type registration to be passed to
	 * `register_post_type` in WordPress.
	 *
	 * @return array
	 */
	abstract protected function get_register_post_type_args(): array;

	/**
	 * Gets the singular label for the post type.
	 *
	 * @return string
	 */
	abstract protected function get_label_singular(): string;

	/**
	 * Gets the plural label for the post type.
	 *
	 * @return string
	 */
	abstract protected function get_label_plural(): string;

	/**
	 * Gets the labels for the post type.
	 *
	 * @return array
	 */
	abstract protected function get_post_type_args_labels(): array;
}
