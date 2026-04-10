<?php
/**
 * RealHomes Currency Switcher Settings for Easy Real Estate.
 *
 * This class is used to inject the settings of this plugin
 * into the Easy Real Estate existing custom options panel.
 *
 * @since      1.1.1
 * @package    realhomes-currency-switcher
 * @subpackage realhomes-currency-switcher/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Realhomes_Currency_Switcher_ERE_Settings' ) ) {

	class Realhomes_Currency_Switcher_ERE_Settings {

		public function __construct() {
			add_filter( 'ere_settings_config', array( $this, 'add_ere_currencies_config' ) );
			add_action( 'ere_after_settings_saved', array( $this, 'handle_ere_save' ) );
		}

		public function add_ere_currencies_config( $configs ) {

			// Create the parent tab
			$configs['currencies'] = array(
				'id'    => 'currencies',
				'title' => esc_html__( 'Currencies Settings', RCS_TEXT_DOMAIN ),
				'order' => 40,
				'icon'  => 'currency',
				'group' => null, // Parent container
			);

			// Load General Settings sub-tab
			$general_config = include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ere-settings/currency-switcher/general.php';
			if ( is_array( $general_config ) ) {
				$configs[ $general_config['id'] ] = $general_config;
			}

			// Load Formats Settings sub-tab
			$formats_config = include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ere-settings/currency-switcher/formats.php';
			if ( is_array( $formats_config ) ) {
				$configs[ $formats_config['id'] ] = $formats_config;
			}

			return $configs;
		}

		public static function render_formats_html() {
			?>
			<div class="rcs-formats-wrapper">
				<p class="rcs-section-description" style="margin-bottom: 20px;"><?php esc_html_e( 'Customize the display format for each supported currency. Changes will override default formats.', RCS_TEXT_DOMAIN ); ?></p>
				<?php
				$rcs_settings         = get_option( 'rcs_settings' );
				$custom_formats       = get_option( 'rcs_custom_currency_formats', array() );
				$currencies_data      = get_option( 'realhomes_currencies_data', array() );
				$supported_currencies = ! empty( $rcs_settings['supported_currencies'] )
					? sanitize_text_field( $rcs_settings['supported_currencies'] )
					: 'USD,EUR,GBP';
				$supported_list       = array_map( 'trim', explode( ',', strtoupper( $supported_currencies ) ) );

				if ( ! empty( $supported_list ) && ! empty( $currencies_data ) ) :
					echo '<div class="rcs-currency-formats-wrap">';
					foreach ( $supported_list as $currency_code ) :
						if ( empty( $currencies_data[ $currency_code ] ) ) {
							continue;
						}

						$currency_info    = $currencies_data[ $currency_code ];
						$custom_format    = ! empty( $custom_formats[ $currency_code ] ) ? $custom_formats[ $currency_code ] : array();
						$current_symbol   = ! empty( $custom_format['symbol'] ) ? $custom_format['symbol'] : ( ! empty( $currency_info['symbol'] ) ? $currency_info['symbol'] : $currency_code );
						$current_pos      = ! empty( $custom_format['position'] ) ? $custom_format['position'] : ( ! empty( $currency_info['position'] ) ? $currency_info['position'] : 'before' );
						$current_spacing  = isset( $custom_format['symbol_spacing'] ) ? $custom_format['symbol_spacing'] : ( isset( $currency_info['symbol_spacing'] ) ? $currency_info['symbol_spacing'] : '' );
						$current_dec      = isset( $custom_format['decimals'] ) ? $custom_format['decimals'] : ( isset( $currency_info['decimals'] ) ? $currency_info['decimals'] : 2 );
						$current_thou     = isset( $custom_format['thousands_sep'] ) ? $custom_format['thousands_sep'] : ( isset( $currency_info['thousands_sep'] ) ? $currency_info['thousands_sep'] : ',' );
						$current_dec_sep  = isset( $custom_format['decimals_sep'] ) ? $custom_format['decimals_sep'] : ( isset( $currency_info['decimals_sep'] ) ? $currency_info['decimals_sep'] : '.' );
						$current_rounding = isset( $custom_format['rounding'] ) ? $custom_format['rounding'] : 'none';
						?>
						<div class="rcs-currency-format-panel" data-currency="<?php echo esc_attr( $currency_code ); ?>">
							<div class="rcs-panel-header" data-currency="<?php echo esc_attr( $currency_code ); ?>">
								<span class="rcs-panel-toggle dashicons dashicons-arrow-down-alt2"></span>
								<strong><?php echo esc_html( $currency_code ); ?></strong>
								<span class="rcs-currency-name"><?php echo esc_html( $currency_info['name'] ); ?></span>
								<span class="rcs-format-preview" data-currency="<?php echo esc_attr( $currency_code ); ?>"></span>
							</div>
							<div class="rcs-panel-content" style="display: none;">
								<div class="rcs-format-fields">
									<div class="rcs-field">
										<label><?php esc_html_e( 'Symbol', RCS_TEXT_DOMAIN ); ?></label>
										<input type="text" name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][symbol]" value="<?php echo esc_attr( $current_symbol ); ?>" class="rcs-format-input regular-text" data-field="symbol" data-currency="<?php echo esc_attr( $currency_code ); ?>" />
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Position', RCS_TEXT_DOMAIN ); ?></label>
										<select name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][position]" class="rcs-format-input regular-text" data-field="position" data-currency="<?php echo esc_attr( $currency_code ); ?>">
											<option value="before" <?php selected( $current_pos, 'before' ); ?>><?php esc_html_e( 'Before Price', RCS_TEXT_DOMAIN ); ?></option>
											<option value="after" <?php selected( $current_pos, 'after' ); ?>><?php esc_html_e( 'After Price', RCS_TEXT_DOMAIN ); ?></option>
										</select>
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Symbol Spacing', RCS_TEXT_DOMAIN ); ?></label>
										<select name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][symbol_spacing]" class="rcs-format-input regular-text" data-field="symbol_spacing" data-currency="<?php echo esc_attr( $currency_code ); ?>">
											<option value="" <?php selected( $current_spacing, '' ); ?>><?php esc_html_e( 'No Space', RCS_TEXT_DOMAIN ); ?></option>
											<option value=" " <?php selected( $current_spacing, ' ' ); ?>><?php esc_html_e( 'Space', RCS_TEXT_DOMAIN ); ?></option>
										</select>
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Decimals', RCS_TEXT_DOMAIN ); ?></label>
										<input type="number" name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][decimals]" value="<?php echo esc_attr( $current_dec ); ?>" min="0" max="6" class="rcs-format-input regular-text" data-field="decimals" data-currency="<?php echo esc_attr( $currency_code ); ?>" />
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Thousands Separator', RCS_TEXT_DOMAIN ); ?></label>
										<input type="text" name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][thousands_sep]" value="<?php echo esc_attr( $current_thou ); ?>" class="rcs-format-input regular-text" data-field="thousands_sep" data-currency="<?php echo esc_attr( $currency_code ); ?>" maxlength="10" />
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Decimals Separator', RCS_TEXT_DOMAIN ); ?></label>
										<input type="text" name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][decimals_sep]" value="<?php echo esc_attr( $current_dec_sep ); ?>" class="rcs-format-input regular-text" data-field="decimals_sep" data-currency="<?php echo esc_attr( $currency_code ); ?>" maxlength="10" />
									</div>
									<div class="rcs-field">
										<label><?php esc_html_e( 'Rounding', RCS_TEXT_DOMAIN ); ?></label>
										<select name="rcs_custom_currency_formats[<?php echo esc_attr( $currency_code ); ?>][rounding]" class="rcs-format-input regular-text" data-field="rounding" data-currency="<?php echo esc_attr( $currency_code ); ?>">
											<option value="none" <?php selected( $current_rounding, 'none' ); ?>><?php esc_html_e( 'No Rounding', RCS_TEXT_DOMAIN ); ?></option>
											<option value="ceil" <?php selected( $current_rounding, 'ceil' ); ?>><?php esc_html_e( 'Round Up', RCS_TEXT_DOMAIN ); ?></option>
											<option value="floor" <?php selected( $current_rounding, 'floor' ); ?>><?php esc_html_e( 'Round Down', RCS_TEXT_DOMAIN ); ?></option>
										</select>
									</div>
									<div class="rcs-field rcs-field-preview">
										<label><?php esc_html_e( 'Preview: ', RCS_TEXT_DOMAIN ); ?></label>
										<span class="rcs-live-preview" data-currency="<?php echo esc_attr( $currency_code ); ?>"></span>
									</div>
								</div>
								<button type="button" class="button rcs-reset-format" data-currency="<?php echo esc_attr( $currency_code ); ?>" data-default-symbol="<?php echo esc_attr( $currency_info['symbol'] ); ?>" data-default-position="<?php echo esc_attr( $currency_info['position'] ); ?>" data-default-spacing="" data-default-decimals="<?php echo esc_attr( $currency_info['decimals'] ); ?>" data-default-thousands="<?php echo esc_attr( $currency_info['thousands_sep'] ); ?>" data-default-decimals-sep="<?php echo esc_attr( $currency_info['decimals_sep'] ); ?>" data-default-rounding="none">
									<?php esc_html_e( 'Reset to Default', RCS_TEXT_DOMAIN ); ?>
								</button>
							</div>
						</div>
						<?php
					endforeach;
					echo '</div>';
				else :
					echo '<p class="rcs-no-currencies">' . esc_html__( 'No supported currencies found. Please add currencies to the "Supported Currencies" field in the General Settings tab and save settings.', RCS_TEXT_DOMAIN ) . '</p>';
				endif;
				?>
			</div>
			<?php
		}

		public function handle_ere_save( $post_data ) {

			// If the force update checkbox is checked, trigger an update and remove it from DB.
			if ( isset( $post_data['rcs_settings']['update_currencies_rates'] ) && '1' === $post_data['rcs_settings']['update_currencies_rates'] ) {
				do_action( 'realhomes_update_currencies' );
				$rcs_settings = get_option( 'rcs_settings', array() );
				if ( isset( $rcs_settings['update_currencies_rates'] ) ) {
					unset( $rcs_settings['update_currencies_rates'] );
					update_option( 'rcs_settings', $rcs_settings );
				}
			}

			// Handle Formats save
			if ( isset( $post_data['rcs_custom_currency_formats'] ) ) {
				$formats = wp_unslash( $post_data['rcs_custom_currency_formats'] );

				if ( ! is_array( $formats ) ) {
					return;
				}

				$sanitized = array();

				foreach ( $formats as $currency_code => $format ) {
					$code = strtoupper( sanitize_text_field( $currency_code ) );

					if ( strlen( $code ) < 2 || strlen( $code ) > 4 ) {
						continue;
					}

					$sanitized[ $code ] = array(
						'symbol'         => isset( $format['symbol'] ) ? wp_kses_post( $format['symbol'] ) : $code,
						'position'       => isset( $format['position'] ) && in_array( $format['position'], array( 'before', 'after' ), true ) ? $format['position'] : 'before',
						'symbol_spacing' => isset( $format['symbol_spacing'] ) && ' ' === $format['symbol_spacing'] ? ' ' : '',
						'decimals'       => isset( $format['decimals'] ) ? absint( $format['decimals'] ) : 2,
						'thousands_sep'  => isset( $format['thousands_sep'] ) ? sanitize_text_field( $format['thousands_sep'] ) : ',',
						'decimals_sep'   => isset( $format['decimals_sep'] ) ? sanitize_text_field( $format['decimals_sep'] ) : '.',
						'rounding'       => isset( $format['rounding'] ) && in_array( $format['rounding'], array( 'none', 'ceil', 'floor' ), true ) ? $format['rounding'] : 'none',
					);

					// Limit decimals to 0-6 range
					if ( $sanitized[ $code ]['decimals'] > 6 ) {
						$sanitized[ $code ]['decimals'] = 6;
					}
				}

				update_option( 'rcs_custom_currency_formats', $sanitized );
			}
		}

	}

	new Realhomes_Currency_Switcher_ERE_Settings();
}
