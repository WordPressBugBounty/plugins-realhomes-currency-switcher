<?php
/**
 * RealHomes Currency Switcher Settings.
 *
 * This class is used to initialize the settings page of this plugin.
 *
 * @since      1.0.0
 * @package    realhomes-currency-switcher
 * @subpackage realhomes-currency-switcher/admin
 */

if ( ! class_exists( 'Realhomes_Currency_Switcher_Settings' ) ) {
	/**
	 * Realhomes_Currency_Switcher_Settings
	 *
	 * Class for RealHomes Currency Switcher Settings. It is
	 * responsible for handling the settings page of the
	 * plugin.
	 *
	 * @since 1.0.0
	 */
	class Realhomes_Currency_Switcher_Settings {

		/**
		 * Add plugin settings page menu to the dashboard settings menu.
		 *
		 * @since  1.0.0
		 */
		public function settings_page_menu() {

			add_submenu_page(
				'real_homes',
				esc_html__( 'Currencies Settings', 'realhomes-currency-switcher' ),
				esc_html__( 'Currencies Settings', 'realhomes-currency-switcher' ),
				'manage_options',
				'realhomes-currencies-settings',
				array( $this, 'render_settings_page' ),
                5
			);

		}

		/**
		 * Render settings on the settings page.
		 *
		 * @since  1.0.0
		 */
		public function render_settings_page() {

			$rcs_settings = get_option( 'rcs_settings' );

			?>
			<div id="realhomes-settings-wrap">
				<form method="post" action="options.php">
                    <header class="settings-header">
                        <h1><?php esc_html_e( 'RealHomes Currency Switcher Settings', 'realhomes-currency-switcher' ); ?><span class="current-version-tag"><?php echo REALHOMES_CURRENCY_SWITCHER_VERSION; ?></span></h1>
                        <p class="credit">
                            <a class="logo-wrap" href="https://themeforest.net/item/real-homes-wordpress-real-estate-theme/5373914?aid=inspirythemes" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" height="29" width="29" viewBox="0 0 36 41">
                                    <style>
                                        .a {
                                            fill: #4E637B;
                                        }
                                        .b {
                                            fill: white;
                                        }
                                        .c {
                                            fill: #27313D !important;
                                        }
                                    </style><g>
                                        <path d="M25.5 14.6C28.9 16.6 30.6 17.5 34 19.5L34 11.1C34 10.2 33.5 9.4 32.8 9 30.1 7.5 28.4 6.5 25.5 4.8L25.5 14.6Z" class="a"></path>
                                        <path d="M15.8 38.4C16.5 38.8 17.4 38.8 18.2 38.4 20.8 36.9 22.5 35.9 25.5 34.2 22.1 32.2 20.4 31.3 17 29.3 13.6 31.3 11.9 32.2 8.5 34.2 11.5 35.9 13.1 36.9 15.8 38.4" mask="url(#mask-2)" class="a"></path>
                                        <path d="M24.3 25.1C25 24.7 25.5 23.9 25.5 23L25.5 14.6 17 19.5 17 29.3 24.3 25.1Z" fill="#C8ED1E"></path>
                                        <path d="M18.2 10.4C17.4 10 16.5 10 15.8 10.4L8.5 14.6 17 19.5 25.5 14.6 18.2 10.4Z" fill="#F9FAF8"></path>
                                        <path d="M8.5 23C8.5 23.9 8.9 24.7 9.7 25.1L17 29.3 17 19.5 8.5 14.6 8.5 23Z" fill="#88B2D7"></path>
                                        <path d="M8.5 14.6C5.1 16.6 3.4 17.5 0 19.5L0 11.1C0 10.2 0.5 9.4 1.2 9 3.8 7.5 5.5 6.5 8.5 4.8L8.5 14.6Z" mask="url(#mask-4)" class="a"></path>
                                        <path d="M34 27.9L34 19.5 25.5 14.6 25.5 23C25.5 23.4 25.4 23.8 25.1 24.2L33.6 29.1C33.8 28.7 34 28.3 34 27.9" fill="#5E9E2D"></path>
                                        <path d="M25.1 24.2C24.9 24.6 24.6 24.9 24.3 25.1L17 29.3 25.5 34.2 32.8 30C33.1 29.8 33.4 29.5 33.6 29.1L25.1 24.2Z" fill="#6FBF2C"></path>
                                        <path d="M17 10.1C17.4 10.1 17.8 10.2 18.2 10.4L25.5 14.6 25.5 4.8 18.2 0.6C17.8 0.4 17.4 0.3 17 0.3L17 10.1Z" fill="#BDD2E1"></path>
                                        <path d="M1.2 30L8.5 34.2 17 29.3 9.7 25.1C9.3 24.9 9 24.6 8.8 24.2L0.3 29.1C0.5 29.5 0.8 29.8 1.2 30" fill="#418EDA"></path>
                                        <path d="M8.8 24.2C8.6 23.8 8.5 23.4 8.5 23L8.5 14.6 0 19.5 0 27.9C0 28.3 0.1 28.7 0.3 29.1L8.8 24.2Z" fill="#3570AA"></path>
                                        <path d="M15.8 0.6L8.5 4.8 8.5 14.6 15.8 10.4C16.2 10.2 16.6 10.1 17 10.1L17 0.3C16.6 0.3 16.2 0.4 15.8 0.6" fill="#A7BAC8"></path>
                                    </g>
                                </svg>InspiryThemes
                            </a>
                        </p>
                    </header>
                    <div class="settings-content">
						<?php settings_errors(); ?>
                        <div class="form-wrapper">
	                        <?php settings_fields( 'rcs_settings_group' ); ?>
                            <table class="form-table">
                                <tbody>
                                <!-- Currency switcher enable disable -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Currency Switcher', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $enable_currency_switcher = ! empty( $rcs_settings['enable_currency_switcher'] ) ? $rcs_settings['enable_currency_switcher'] : '';
				                        ?>
                                        <input id="rcs_settings[enable_currency_switcher]" name="rcs_settings[enable_currency_switcher]" type="checkbox" value="1" <?php checked( 1, $enable_currency_switcher ); ?> />
                                        <label class="description" for="rcs_settings[enable_currency_switcher]"><?php esc_html_e( 'Enable Currency Swithcer on frontend side.', 'realhomes-currency-switcher' ); ?></label>
                                    </td>
                                </tr>

                                <!-- Alternative Currencies enable/disable -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Digital Currencies', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $enable_digital_currencies = ! empty( $rcs_settings['enable_digital_currencies'] ) ? $rcs_settings['enable_digital_currencies'] : '';
				                        ?>
                                        <input id="rcs_settings[enable_digital_currencies]" name="rcs_settings[enable_digital_currencies]" type="checkbox" value="1" <?php checked( 1, $enable_digital_currencies ); ?> />
                                        <label class="description" for="rcs_settings[enable_digital_currencies]"><?php esc_html_e( 'Enable Digital Currencies such as Bitcoin, Litecoin, etc.', 'realhomes-currency-switcher' ); ?></label>
                                    </td>
                                </tr>

                                <!-- App ID -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'App ID*', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $app_id = ! empty( $rcs_settings['app_id'] ) ? $rcs_settings['app_id'] : '';
				                        ?>
                                        <input id="rcs_settings[app_id]" name="rcs_settings[app_id]" type="text" class="regular-text" value="<?php echo esc_attr( $app_id ); ?>"/>
                                        <p class="description"><label for="rcs_settings[app_id]"><?php echo sprintf( esc_html__( 'You can get your Open Exchange Rate App ID from %s.', 'realhomes-currency-switcher' ), '<a href="https://support.openexchangerates.org/article/121-your-app-id" target="_blank">here</a>' ); ?></label></p>
                                    </td>
                                </tr>

                                <!-- Update frequency -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Update Interval', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $update_frequency = isset( $rcs_settings['update_interval'] ) ? esc_attr( $rcs_settings['update_interval'] ) : 'daily';
				                        ?>
                                        <select name="rcs_settings[update_interval]" id="update_interval" class="regular-text">
                                            <option value="hourly" <?php selected( $update_frequency, 'hourly', true ); ?>><?php esc_html_e( 'Hourly', 'realhomes-currency-switcher' ); ?></option>
                                            <option value="daily" <?php selected( $update_frequency, 'daily', true ); ?>><?php esc_html_e( 'Daily', 'realhomes-currency-switcher' ); ?></option>
                                            <option value="weekly" <?php selected( $update_frequency, 'weekly', true ); ?>><?php esc_html_e( 'Weekly', 'realhomes-currency-switcher' ); ?></option>
                                        </select>
                                        <p class="description"><label for="rcs_settings[update_interval]"><?php esc_html_e( 'Set how frequent you want to update the currency exchange rates.', 'realhomes-currency-switcher' ); ?></label></p>
                                    </td>
                                </tr>

                                <!-- Auto Active Currency -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Auto Select Active Currency', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $auto_active_currency = isset( $rcs_settings['auto_active_currency'] ) ? esc_attr( $rcs_settings['auto_active_currency'] ) : 'false';
				                        ?>
                                        <label for="isp_settings_publish_property_yes">
                                            <input type="radio" id="rcs-aac-true" <?php checked( $auto_active_currency, 'true', true ); ?> name="rcs_settings[auto_active_currency]" value="true">
		                                    <?php esc_html_e( 'Enable', 'realhomes-currency-switcher' ); ?>
                                        </label>
                                        <br />
                                        <label for="isp_settings_publish_property_yes">
                                            <input type="radio" id="rcs-aac-false" <?php checked( $auto_active_currency, 'false', true ); ?> name="rcs_settings[auto_active_currency]" value="false">
		                                    <?php esc_html_e( 'Disable', 'realhomes-currency-switcher' ); ?>
                                        </label>
                                        <p class="description">
                                            <label for="rcs_settings[auto_active_currency]"><?php esc_html_e( 'The selected base currency in the next option will not be effective if this option is enabled. Currency will be switched to the visitor native currency automatically unless visitor change it to any other currency using currency switcher.', 'realhomes-currency-switcher' ); ?></label>
                                        </p>
                                    </td>
                                </tr>

                                <!-- Base Currency -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Base Currency', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
                                        <select name="rcs_settings[base_currency]" id="base_currency" class="regular-text">
					                        <?php
					                        $base_crrency = isset( $rcs_settings['base_currency'] ) ? esc_attr( $rcs_settings['base_currency'] ) : 'usd';
					                        $currencies   = get_option( 'realhomes_currencies_data' );
					                        if ( ! empty( $currencies ) && is_array( $currencies ) ) {
						                        $currencies = get_option( 'realhomes_currencies_data' );
						                        if ( ! empty( $currencies ) && is_array( $currencies ) ) {
							                        foreach ( $currencies as $code => $info ) {
								                        echo '<option value="' . esc_attr( $code ) . '" ' . selected( $base_crrency, $code, true ) . '>' . esc_html( $info['name'] ) . '</option>';
							                        }
						                        }
					                        } else {
						                        echo '<option value="USD">' . esc_html__( 'United States Dollar', 'realhomes-currency-switcher' ) . '</option>';
					                        }
					                        ?>
                                        </select>
                                        <p class="description"><label for="rcs_settings[base_currency]"><?php esc_html_e( 'Price format settings of easy real estate plugin, will be overwritten by base currency’s default format.', 'realhomes-currency-switcher' ); ?></label></p>
                                    </td>
                                </tr>

                                <!-- Supported currencies by the current site -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Allowed Currencies', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $supported_currencies = empty( $rcs_settings['supported_currencies'] ) ? 'USD,EUR,GBP' : $rcs_settings['supported_currencies'];
				                        ?>
                                        <textarea id="rcs_settings[supported_currencies]" name="rcs_settings[supported_currencies]" type="text" class="regular-text"><?php echo esc_attr( $supported_currencies ); ?></textarea>
                                        <p class="description"><label for="rcs_settings[supported_currencies]"><?php esc_html_e( 'Provide comma separated list of currency codes in capital letters. Maximum 5 codes allowed.', 'realhomes-currency-switcher' ); ?></label></p>
                                        <p class="description"><label for="rcs_settings[supported_currencies]">
						                        <?php
						                        // Translators: OpenExchangeRates Currencies List.
						                        echo sprintf( esc_html__( 'You can find full list of supported currencies by %s.', 'realhomes-currency-switcher' ), '<a href="https://openexchangerates.org/currencies" target="_blank">clicking here</a>' );
						                        ?>
                                            </label></p>
                                    </td>
                                </tr>

                                <!-- Expiry period for switched currency -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Expiry Period of Switched Currency', 'realhomes-currency-switcher' ); ?>
                                    </th>
                                    <td>
				                        <?php
				                        $switched_currency_expiry = isset( $rcs_settings['switched_currency_expiry'] ) ? esc_attr( $rcs_settings['switched_currency_expiry'] ) : 'day';
				                        ?>
                                        <select name="rcs_settings[switched_currency_expiry]" id="update_interval" class="regular-text">
                                            <option value="3600" <?php selected( $switched_currency_expiry, '3600', true ); ?>><?php esc_html_e( 'One Hour', 'realhomes-currency-switcher' ); ?></option>
                                            <option value="86400" <?php selected( $switched_currency_expiry, '86400', true ); ?>><?php esc_html_e( 'One Day', 'realhomes-currency-switcher' ); ?></option>
                                            <option value="604800" <?php selected( $switched_currency_expiry, '604800', true ); ?>><?php esc_html_e( 'One Week', 'realhomes-currency-switcher' ); ?></option>
                                            <option value="2592000" <?php selected( $switched_currency_expiry, '2592000', true ); ?>><?php esc_html_e( 'One Month', 'realhomes-currency-switcher' ); ?></option>
                                        </select>
                                        <p class="description"><label for="rcs_settings[switched_currency_expiry]"><?php esc_html_e( 'This is for website visitor.', 'realhomes-currency-switcher' ); ?></label></p>
                                    </td>
                                </tr>

                                <!-- Force update currencies rates -->
                                <tr>
                                    <th scope="row">
				                        <?php esc_html_e( 'Update Currencies Rates', 'realhomes-currency-switcher' ); ?>
				                        <?php
				                        $last_update = get_option( 'realhomes_currencies_last_update' );
				                        if ( ! empty( $last_update ) ) {
					                        ?>
                                            <span class="currencies-last-update"><?php echo '<em>Last updated on:</em>' . esc_html( $last_update ); ?></span>
					                        <?php
				                        }
				                        ?>
                                    </th>
                                    <td>
                                        <input id="rcs_settings[update_currencies_rates]" name="rcs_settings[update_currencies_rates]" type="checkbox" value="1" />
                                        <label class="description" for="rcs_settings[update_currencies_rates]"><?php esc_html_e( 'Checking this box will immediately fetch latest currencies exchange rates on Save Options.', 'realhomes-currency-switcher' ); ?></label>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
	                        <?php submit_button(); ?>
                        </div>
                    </div>
                    <footer class="settings-footer">
                        <p><span class="dashicons dashicons-editor-help"></span><?php printf( esc_html__( 'For help, please consult the %1$s documentation %2$s of the plugin.', 'realhomes-currency-switcher' ), '<a href="https://realhomes.io/documentation/currency-switcher/" target="_blank">', '</a>' ); ?></p>
                        <p><span class="dashicons dashicons-feedback"></span><?php printf( esc_html__( 'For feedback, please provide your %1$s feedback here! %2$s', 'realhomes-currency-switcher' ), '<a href="' . esc_url( add_query_arg( array( 'page' => 'realhomes-feedback' ), get_admin_url() . 'admin.php' ) ) . '" target="_blank">', '</a>' ); ?></p>
                    </footer>
				</form>
			</div>
			<?php
		}

		/**
		 * Register settings for the plugin.
		 *
		 * @since  1.0.0
		 */
		public function register_settings() {
			register_setting( 'rcs_settings_group', 'rcs_settings' );
		}

	}
}
