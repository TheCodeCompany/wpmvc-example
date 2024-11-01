<?php
/**
 * Movie.php
 *
 * @package MyApp\Core\Model\Post
 */

namespace MyApp\Core\Model\Post;

/**
 * A movie post type.
 */
class Movie extends GenericPost {

	/**
	 * WordPress post type.
	 */
	public const POST_TYPE = 'movie';
}
