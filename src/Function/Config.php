<?php
/**
 * Config functions.
 *
 * @package ExampleCorp\Core\Function
 */

namespace ExampleCorp\Core;

use WPMVC\Library\Config;

/**
 * Get the configuration instance for the application.
 *
 * @return Config|null
 */
function get_config() {
	$config = null;

	// TODO don't use global, get config using APP_NAME.
	global $example_corp_app;
	$config = $example_corp_app->get_config();

	return $config;
}
