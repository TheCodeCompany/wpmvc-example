<?php
/**
 * Tag.php
 *
 * @package ExampleCorp\Core\Model\Taxonomy
 */

namespace ExampleCorp\Core\Model\Taxonomy;

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
