<?php
/**
 * GenericPost.php
 *
 * @package ExampleCorp\Core\Model\Post
 */

namespace ExampleCorp\Core\Model\Post;

use WPMVC\Model\GenericPostModel;

/**
 * Generic post (of any type) used. Holds common logic shared between all post
 * types.
 *
 * @package ExampleCorp\Core\Model\Post
 */
class GenericPost extends GenericPostModel {

	/**
	 * The post instance. The foundation for instance data.
	 *
	 * @var mixed
	 */
	protected $parent;

	/**
	 * =========================================================================
	 * Parent methods.
	 * -------------------------------------------------------------------------
	 */

	/**
	 * Retrieves the parent post object for the current post.
	 *
	 * If the current post has a parent (i.e., it's a child post), this method
	 * initializes the parent post object as an instance of this class.
	 * If the current post doesn't have a parent it returns null, or the parent is already initialized,
	 * it simply returns the existing parent post object.
	 *
	 * @return mixed The parent post object if exists, null otherwise.
	 */
	protected function get_parent(): mixed {

		if ( $this->post_parent && null === $this->parent ) {
			$class  = get_called_class();
			$parent = new $class( $this->post_parent );

			if ( $parent ) {
				$this->parent = $parent;
			}
		}

		return $this->parent;
	}
}
