<?php
/**
 * Category.php
 *
 * @package MyApp\Core\Model\Taxonomy
 */

namespace MyApp\Core\Model\Taxonomy;

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
