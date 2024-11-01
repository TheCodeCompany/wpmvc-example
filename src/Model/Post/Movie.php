<?php
/**
 * Movie.php
 *
 * @package ExampleCorp\Core\Model\Post
 */

namespace ExampleCorp\Core\Model\Post;

/**
 * A movie post type.
 */
class Movie extends GenericPost {

	/**
	 * WordPress post type.
	 */
	public const POST_TYPE = 'movie';
}
