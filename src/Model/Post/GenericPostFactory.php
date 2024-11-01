<?php
/**
 * Generic Post Factory.
 *
 * @package MyApp\Core\Model\Post
 */

namespace MyApp\Core\Model\Post;

use WPMVC\Model\GenericPostModelFactory;

/**
 * Generic Post Factory.
 */
class GenericPostFactory extends GenericPostModelFactory {

	/**
	 * Wraps the given WP_Post in the post class used by this factory. This
	 * method should be overwritten if extending this class. Assumes post is
	 * valid.
	 *
	 * @param \WP_Post|object $post The post instance to wrap.
	 *
	 * @return GenericPost
	 */
	public function wrap( $post ) {
		return new GenericPost( $post );
	}
}
