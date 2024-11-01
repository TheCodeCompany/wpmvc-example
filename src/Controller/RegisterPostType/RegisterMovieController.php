<?php
/**
 * RegisterMovieController.php
 *
 * @package ExampleCorp\Core\Controller
 */

namespace ExampleCorp\Core\Controller\RegisterPostType;

use ExampleCorp\Core\Model\Post\Movie;

/**
 * Registers the Movie post type.
 */
class RegisterMovieController extends RegisterPostTypeController {

	/**
	 * Gets the post type.
	 *
	 * @return string
	 */
	protected function get_post_type(): string {
		return Movie::POST_TYPE;
	}

	/**
	 * Gets the arguments for post type registration to be passed to
	 * `register_post_type` in WordPress.
	 *
	 * @return array
	 */
	protected function get_register_post_type_args(): array {
		return [
			'label'                 => $this->get_label_plural(),
			'labels'                => $this->get_post_type_args_labels(),
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rest_namespace'        => 'wp/v2',
			'has_archive'           => false,
			'has_archive_string'    => '',
			'exclude_from_search'   => false,
			'capability_type'       => 'post',
			'hierarchical'          => true,
			'can_export'            => true,
			'rewrite'               => [
				'slug'       => 'movies',
				'with_front' => true,
			],
			'rewrite_slug'          => '',
			'rewrite_withfront'     => true,
			'query_var'             => true,
			'query_var_slug'        => '',
			'menu_position'         => '',
			'show_in_menu'          => true,
			'show_in_menu_string'   => '',
			'menu_icon'             => 'dashicons-video-alt',
			'delete_with_user'      => false,
			'map_meta_cap'          => true,
			'supports'              => [ 'title', 'thumbnail', 'page-attributes', 'editor' ],
			'show_in_graphql'       => false,
		];
	}

	/**
	 * Gets the singular label for the post type.
	 *
	 * @return string
	 */
	protected function get_label_singular(): string {
		return __( 'Movie', 'example-corp' );
	}

	/**
	 * Gets the plural label for the post type.
	 *
	 * @return string
	 */
	protected function get_label_plural(): string {
		return __( 'Movies', 'example-corp' );
	}

	/**
	 * Gets the labels for the post type. This used to be driven by the parent class using single/plural variables
	 * but is now handled statically due to standards not allowing variables within $text.
	 *
	 * @return array
	 */
	protected function get_post_type_args_labels(): array {
		return [
			'name'                  => _x( 'Movies', 'Post Type General Name', 'example-corp' ),
			'singular_name'         => _x( 'Movie', 'Post Type Singular Name', 'example-corp' ),
			'menu_name'             => __( 'Movies', 'example-corp' ),
			'name_admin_bar'        => __( 'Movie', 'example-corp' ),
			'archives'              => __( 'Movies Archives', 'example-corp' ),
			'attributes'            => __( 'Movie Attributes', 'example-corp' ),
			'parent_item_colon'     => __( 'Parent Movie:', 'example-corp' ),
			'all_items'             => __( 'All Movies', 'example-corp' ),
			'add_new_item'          => __( 'Add New Movie', 'example-corp' ),
			'add_new'               => __( 'Add New', 'example-corp' ),
			'new_item'              => __( 'New Movie', 'example-corp' ),
			'edit_item'             => __( 'Edit Movie', 'example-corp' ),
			'update_item'           => __( 'Update Movie', 'example-corp' ),
			'view_item'             => __( 'View Movie', 'example-corp' ),
			'view_items'            => __( 'View Movies', 'example-corp' ),
			'search_items'          => __( 'Search Movies', 'example-corp' ),
			'not_found'             => __( 'Not found', 'example-corp' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'example-corp' ),
			'featured_image'        => __( 'Featured Image', 'example-corp' ),
			'set_featured_image'    => __( 'Set featured image', 'example-corp' ),
			'remove_featured_image' => __( 'Remove featured image', 'example-corp' ),
			'use_featured_image'    => __( 'Use as featured image', 'example-corp' ),
			'insert_into_item'      => __( 'Insert into movies', 'example-corp' ),
			'uploaded_to_this_item' => __( 'Uploaded to this movie', 'example-corp' ),
			'items_list'            => __( 'Movies list', 'example-corp' ),
			'items_list_navigation' => __( 'Movies list navigation', 'example-corp' ),
			'filter_items_list'     => __( 'Filter movies list', 'example-corp' ),
		];
	}
}
