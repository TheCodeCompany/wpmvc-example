<?php
/**
 * Genre.php
 *
 * @package ExampleCorp\Core\Model\Taxonomy
 */

namespace ExampleCorp\Core\Model\Taxonomy;

use WPMVC\Model\TaxonomyTermModel;

/**
 * Genre taxonomy Model.
 */
class Genre extends TaxonomyTermModel {

	/**
	 * WordPress taxonomy.
	 */
	const TAXONOMY_NAME = 'genre';
}
