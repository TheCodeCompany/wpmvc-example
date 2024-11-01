<?php
/**
 * RegisterTaxonomyController.php
 *
 * @package ExampleCorp\Core\Controller
 */

namespace ExampleCorp\Core\Controller\RegisterTaxonomy;

use ExampleCorp\Core\Controller\Controller;

/**
 * Base foundation for registering a taxonomy.
 */
abstract class RegisterTaxonomyController extends Controller {

	/**
	 * Registers the taxonomy and supporting features.
	 *
	 * @return void
	 */
	public function set_up(): void {
		add_action( 'init', [ $this, 'register_taxonomy' ] );
	}

	/**
	 * Registers the taxonomy.
	 *
	 * @return void
	 */
	public function register_taxonomy(): void {
		register_taxonomy( $this->get_taxonomy_name(), $this->get_taxonomy_object_types(), $this->get_taxonomy_args() );
	}

	/**
	 * Gets the name for the taxonomy.
	 *
	 * @return string
	 */
	abstract protected function get_taxonomy_name(): string;

	/**
	 * Gets the object types this taxonomy is associated with.
	 *
	 * @return array|string
	 */
	abstract protected function get_taxonomy_object_types(): array|string;

	/**
	 * Gets the args to pass to `register_taxonomy`.
	 *
	 * @return array
	 */
	abstract protected function get_taxonomy_args(): array;

	/**
	 * Gets the singular label for the taxonomy.
	 *
	 * @return string
	 */
	abstract public function get_singular_label(): string;

	/**
	 * Gets the plural label for the taxonomy.
	 *
	 * @return string
	 */
	abstract public function get_plural_label(): string;

	/**
	 * Gets the labels for the taxonomy, to be passed to `register_taxonomy`.
	 *
	 * @return array
	 */
	abstract protected function get_taxonomy_args_labels(): array;
}
