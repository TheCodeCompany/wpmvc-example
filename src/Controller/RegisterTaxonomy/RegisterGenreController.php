<?php
/**
 * RegisterGenreController.php
 *
 * @package MyApp\Core\Controller
 */

namespace MyApp\Core\Controller\RegisterTaxonomy;

use MyApp\Core\Model\Post\Movie;
use MyApp\Core\Model\Taxonomy\Genre;

/**
 * Registers the genre taxonomy.
 */
class RegisterGenreController extends RegisterTaxonomyController {

	/**
	 * Gets the taxonomy name.
	 *
	 * @return string
	 */
	protected function get_taxonomy_name(): string {
		return Genre::TAXONOMY_NAME;
	}

	/**
	 * Gets the arguments for taxonomy registration to be passed to
	 * `register_taxonomy` in WordPress.
	 *
	 * @return array
	 */
	protected function get_taxonomy_args(): array {
		return [
			'label'                 => $this->get_plural_label(),
			'labels'                => $this->get_taxonomy_args_labels(),
			'public'                => true,
			'publicly_queryable'    => true,
			'hierarchical'          => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'query_var'             => true,
			'rewrite'               => [
				'slug'       => $this->get_taxonomy_name(),
				'with_front' => true,
			],
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'show_tagcloud'         => true,
			'rest_base'             => $this->get_taxonomy_name(),
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'rest_namespace'        => 'wp/v2',
			'show_in_quick_edit'    => true,
			'sort'                  => false,
			'show_in_graphql'       => false,
		];
	}

	/**
	 * Gets the object types this taxonomy is associated with.
	 *
	 * @return array|string
	 */
	protected function get_taxonomy_object_types(): array {
		$post_types = [
			Movie::POST_TYPE,
		];
		return $post_types;
	}

	/**
	 * Gets the singular label for the post type.
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return __( 'Genre', 'example-corp' );
	}

	/**
	 * Gets the plural label for the post type.
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return __( 'Genres', 'example-corp' );
	}

	/**
	 * Gets the labels for the taxonomy, to be passed to `register_taxonomy`.
	 *
	 * @return array
	 */
	protected function get_taxonomy_args_labels(): array {
		return [
			'name'                       => _x( 'Genres', 'example-corp' ),
			'singular_name'              => _x( 'Genre', 'example-corp' ),
			'menu_name'                  => __( 'Genres', 'example-corp' ),
			'all_items'                  => __( 'All Genres', 'example-corp' ),
			'edit_item'                  => __( 'Edit Genre', 'example-corp' ),
			'view_item'                  => __( 'View Genre', 'example-corp' ),
			'update_item'                => __( 'Update Genre', 'example-corp' ),
			'add_new_item'               => __( 'Add New Genre', 'example-corp' ),
			'new_item_name'              => __( 'New Genre Name', 'example-corp' ),
			'parent_item'                => __( 'Parent Genres', 'example-corp' ),
			'parent_item_colon'          => __( 'Parent Genres:', 'example-corp' ),
			'search_items'               => __( 'Search Genres', 'example-corp' ),
			'popular_items'              => __( 'Popular Genres', 'example-corp' ),
			'separate_items_with_commas' => __( 'Separate genres with commas', 'example-corp' ),
			'add_or_remove_items'        => __( 'Add or remove genres', 'example-corp' ),
			'choose_from_most_used'      => __( 'Choose from most used genres', 'example-corp' ),
			'not_found'                  => __( 'No genres found', 'example-corp' ),
			'back_to_items'              => __( '&larr; Go to Genres', 'example-corp' ),
		];
	}
}
