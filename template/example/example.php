<?php
/**
 * Example template.
 *
 * @package wpmvc-example
 */

?>
<h1>Example Template</h1>

<p>
This is an example of a parameter passed to the template:
</p>

<code>
$this->get_param( 'example' ) = "<?php echo esc_html( $this->get_param( 'example' ) ); ?>""
</code>
