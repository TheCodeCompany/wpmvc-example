<?php
/**
 * Category.php
 *
 * @package ExampleCorp\Core\Model\Taxonomy
 */

namespace ExampleCorp\Core\Model\Taxonomy;

use WPMVC\Model\TaxonomyTermModel;

/**
 * Category taxonomy Model.
 */
class Category extends TaxonomyTermModel {

	/**
	 * WordPress taxonomy.
	 */
	const TAXONOMY_NAME = 'category';
}
