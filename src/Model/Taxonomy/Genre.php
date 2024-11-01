<?php
/**
 * Genre.php
 *
 * @package MyApp\Core\Model\Taxonomy
 */

namespace MyApp\Core\Model\Taxonomy;

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
