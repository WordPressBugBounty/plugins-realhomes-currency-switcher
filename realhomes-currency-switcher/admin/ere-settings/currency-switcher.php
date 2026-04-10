<?php
/**
 * Currency Switcher Options
 *
 * @since   1.1.1
 * @package Easy_Real_Estate
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$currency_switcher_settings_config = array(
	'id'     => 'currency-switcher',
	'title'  => esc_html__( 'Currency Switcher', RCS_TEXT_DOMAIN ),
	'icon'   => 'currency-switcher',
	'order'  => 66,
	'tags'   => array( 'currency_switcher', 'currency', 'switcher' ),
	'fields' => array()
);

return apply_filters( 'rhcs_currency_switcher_settings_config', $currency_switcher_settings_config );