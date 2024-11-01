<?php
/**
 * Tag.php
 *
 * @package MyApp\Core\Model\Taxonomy
 */

namespace MyApp\Core\Model\Taxonomy;

use WPMVC\Model\TaxonomyTermModel;

/**
 * Post Tag taxonomy Model.
 */
class Tag extends TaxonomyTermModel {

	/**
	 * WordPress taxonomy.
	 */
	const TAXONOMY_NAME = 'post_tag';
}
