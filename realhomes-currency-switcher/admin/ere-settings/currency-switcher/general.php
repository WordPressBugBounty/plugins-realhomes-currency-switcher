<?php
/**
 * General Settings Config File
 *
 * @since      1.1.1
 * @package    realhomes-currency-switcher
 * @subpackage realhomes-currency-switcher/admin/ere-settings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$last_update      = get_option( 'realhomes_currencies_last_update' );
$last_update_desc = '';
if ( ! empty( $last_update ) ) {
	$last_update_desc = '<br/><span class="currencies-last-update"><em>' . esc_html__( 'Last updated on:', RCS_TEXT_DOMAIN ) . '</em> ' . esc_html( $last_update ) . '</span>';
}

$max_currencies_options = array();
for ( $i = 1; $i <= 50; $i++ ) {
	$max_currencies_options[ $i ] = $i;
}

$currency_switcher_options_fields[] = array(
	'id'            => 'enable_currency_switcher',
	'name'          => 'enable_currency_switcher',
	'parent_option' => 'rcs_settings',
	'type'          => 'buttons',
	'title'         => esc_html__( 'Currency Switcher', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Enable Currency Switcher on frontend side.', RCS_TEXT_DOMAIN ),
	'options'       => array(
		'1' => esc_html__( 'Enable', RCS_TEXT_DOMAIN ),
		''  => esc_html__( 'Disable', RCS_TEXT_DOMAIN ),
	),
	'default'       => '',
);

$currency_switcher_options_fields[] = array(
	'id'            => 'enable_digital_currencies',
	'name'          => 'enable_digital_currencies',
	'parent_option' => 'rcs_settings',
	'type'          => 'buttons',
	'title'         => esc_html__( 'Digital Currencies', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Enable Digital Currencies such as Bitcoin, Litecoin, etc.', RCS_TEXT_DOMAIN ),
	'options'       => array(
		'1' => esc_html__( 'Enable', RCS_TEXT_DOMAIN ),
		''  => esc_html__( 'Disable', RCS_TEXT_DOMAIN ),
	),
	'default'       => '',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'app_id',
	'name'          => 'app_id',
	'parent_option' => 'rcs_settings',
	'type'          => 'text',
	'title'         => esc_html__( 'App ID*', RCS_TEXT_DOMAIN ),
	'subtitle'      => sprintf( esc_html__( 'You can get your Open Exchange Rate App ID from %s.', RCS_TEXT_DOMAIN ), '<a href="https://support.openexchangerates.org/article/121-your-app-id" target="_blank">here</a>' ),
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'update_interval',
	'name'          => 'update_interval',
	'parent_option' => 'rcs_settings',
	'type'          => 'select',
	'title'         => esc_html__( 'Update Interval', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Set how frequent you want to update the currency exchange rates.', RCS_TEXT_DOMAIN ),
	'options'       => array(
		'hourly' => esc_html__( 'Hourly', RCS_TEXT_DOMAIN ),
		'daily'  => esc_html__( 'Daily', RCS_TEXT_DOMAIN ),
		'weekly' => esc_html__( 'Weekly', RCS_TEXT_DOMAIN ),
	),
	'default'       => 'daily',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'auto_active_currency',
	'name'          => 'auto_active_currency',
	'parent_option' => 'rcs_settings',
	'type'          => 'select',
	'title'         => esc_html__( 'Auto Select Active Currency', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Automatically switch visitor currency based on location (using IP detection).', RCS_TEXT_DOMAIN ),
	'options'       => array(
		''     => esc_html__( 'Disable', RCS_TEXT_DOMAIN ),
		'true' => esc_html__( 'Enable', RCS_TEXT_DOMAIN ),
	),
	'default'       => '',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'base_currency',
	'name'          => 'base_currency',
	'parent_option' => 'rcs_settings',
	'type'          => 'text',
	'title'         => esc_html__( 'Base Currency', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Price format settings of easy real estate plugin, will be overwritten by base currency\'s default format.', RCS_TEXT_DOMAIN ),
	'default'       => 'USD',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'supported_currencies',
	'name'          => 'supported_currencies',
	'parent_option' => 'rcs_settings',
	'type'          => 'textarea',
	'title'         => esc_html__( 'Supported Currencies', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Provide comma separated list of currency codes in capital letters.', RCS_TEXT_DOMAIN ) . '<br/><a href="https://openexchangerates.org/currencies" target="_blank">' . esc_html__( 'You can find full list of supported currencies by clicking here.', RCS_TEXT_DOMAIN ) . '</a>',
	'default'       => 'USD,EUR,GBP',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'max_currencies',
	'name'          => 'max_currencies',
	'parent_option' => 'rcs_settings',
	'type'          => 'select',
	'title'         => esc_html__( 'Number of Currencies to Display on Frontend', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Set the number of currencies that should appear on the frontend. The maximum allowed is 50.', RCS_TEXT_DOMAIN ),
	'options'       => $max_currencies_options,
	'default'       => 5,
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'switched_currency_expiry',
	'name'          => 'switched_currency_expiry',
	'parent_option' => 'rcs_settings',
	'type'          => 'select',
	'title'         => esc_html__( 'Expiry Period of Switched Currency', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'This is for website visitor.', RCS_TEXT_DOMAIN ),
	'options'       => array(
		'3600'    => esc_html__( 'One Hour', RCS_TEXT_DOMAIN ),
		'86400'   => esc_html__( 'One Day', RCS_TEXT_DOMAIN ),
		'604800'  => esc_html__( 'One Week', RCS_TEXT_DOMAIN ),
		'2592000' => esc_html__( 'One Month', RCS_TEXT_DOMAIN ),
	),
	'default'       => '86400',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);

$currency_switcher_options_fields[] = array(
	'id'            => 'update_currencies_rates',
	'name'          => 'update_currencies_rates',
	'parent_option' => 'rcs_settings',
	'type'          => 'buttons',
	'title'         => esc_html__( 'Update Currencies Rates', RCS_TEXT_DOMAIN ),
	'subtitle'      => esc_html__( 'Check this securely to immediately fetch latest currencies exchange rates on Save Options.', RCS_TEXT_DOMAIN ) . $last_update_desc,
	'options'       => array(
		'1' => esc_html__( 'Update Now', RCS_TEXT_DOMAIN ),
		''  => esc_html__( 'No', RCS_TEXT_DOMAIN ),
	),
	'default'       => '',
	'condition'     => array( 'rcs_settings[enable_currency_switcher]' => '1' ),
);


$currency_switcher_general_setting_config = array(
	'id'        => 'currency-switcher-general',
	'pre_title' => esc_html__( 'Currency Switcher', RCS_TEXT_DOMAIN ),
	'title'     => esc_html__( 'General', RCS_TEXT_DOMAIN ),
	'group'     => 'currencies',
	'order'     => 1,
	'fields'    => $currency_switcher_options_fields
);

return apply_filters( 'rhcs_currency_switcher_general_settings_config', $currency_switcher_general_setting_config );