<?php
/**
 * Formats Settings Config File
 *
 * @since      1.1.1
 * @package    realhomes-currency-switcher
 * @subpackage realhomes-currency-switcher/admin/ere-settings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'id'     => 'currencies-formats',
	'title'  => esc_html__( 'Supported Currencies Format', RCS_TEXT_DOMAIN ),
	'group'  => 'currencies',
	'fields' => array(
		array(
			'id'         => 'rcs_formats_html',
			'name'       => 'rcs_formats_html',
			'type'       => 'callback',
			'callback'   => array( 'Realhomes_Currency_Switcher_ERE_Settings', 'render_formats_html' ),
		),
	),
);
