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
				esc_html__( 'Currencies Settings', RCS_TEXT_DOMAIN ),
				esc_html__( 'Currencies Settings', RCS_TEXT_DOMAIN ),
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
			?>
			<div id="realhomes-settings-wrap">
				<header class="settings-header">
					<h1><?php esc_html_e( 'RealHomes Currency Switcher Settings', RCS_TEXT_DOMAIN ); ?><span class="current-version-tag"><?php echo REALHOMES_CURRENCY_SWITCHER_VERSION; ?></span></h1>
					<p class="credit">
						<a class="logo-wrap" href="https://themeforest.net/item/real-homes-wordpress-real-estate-theme/5373914?aid=inspirythemes" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" height="29" width="29" viewBox="0 0 36 41">
								<style>
									.a { fill: #4E637B; }
									.b { fill: white; }
									.c { fill: #27313D !important; }
								</style>
								<g>
									<path d="M25.5 14.6C28.9 16.6 30.6 17.5 34 19.5L34 11.1C34 10.2 33.5 9.4 32.8 9 30.1 7.5 28.4 6.5 25.5 4.8L25.5 14.6Z" class="a"></path>
									<path d="M15.8 38.4C16.5 38.8 17.4 38.8 18.2 38.4 20.8 36.9 22.5 35.9 25.5 34.2 22.1 32.2 20.4 31.3 17 29.3 13.6 31.3 11.9 32.2 8.5 34.2 11.5 35.9 13.1 36.9 15.8 38.4" class="a"></path>
									<path d="M24.3 25.1C25 24.7 25.5 23.9 25.5 23L25.5 14.6 17 19.5 17 29.3 24.3 25.1Z" fill="#C8ED1E"></path>
									<path d="M18.2 10.4C17.4 10 16.5 10 15.8 10.4L8.5 14.6 17 19.5 25.5 14.6 18.2 10.4Z" fill="#F9FAF8"></path>
									<path d="M8.5 23C8.5 23.9 8.9 24.7 9.7 25.1L17 29.3 17 19.5 8.5 14.6 8.5 23Z" fill="#88B2D7"></path>
									<path d="M8.5 14.6C5.1 16.6 3.4 17.5 0 19.5L0 11.1C0 10.2 0.5 9.4 1.2 9 3.8 7.5 5.5 6.5 8.5 4.8L8.5 14.6Z" class="a"></path>
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
					<?php
					$current_tab = 'general';
					if ( isset( $_GET['tab'] ) && array_key_exists( sanitize_key( $_GET['tab'] ), $this->tabs() ) ) {
						$current_tab = sanitize_key( $_GET['tab'] );
					}
					$this->tabs_nav( $current_tab );
					?>
					<div class="form-wrapper">
						<?php
						$tab_file = RH_CURRENCY_SWITCHER_DIR . 'admin/settings/' . $current_tab . '.php';
						if ( file_exists( $tab_file ) ) {
							require_once $tab_file;
						}
						?>
					</div>
				</div>
				<footer class="settings-footer">
					<p><span class="dashicons dashicons-editor-help"></span><?php printf( esc_html__( 'For help, please consult the %1$s documentation %2$s of the plugin.', RCS_TEXT_DOMAIN ), '<a href="https://realhomes.io/documentation/currency-switcher/" target="_blank">', '</a>' ); ?></p>
					<p><span class="dashicons dashicons-feedback"></span><?php printf( esc_html__( 'For feedback, please provide your %1$s feedback here! %2$s', RCS_TEXT_DOMAIN ), '<a href="' . esc_url( add_query_arg( array( 'page' => 'realhomes-feedback' ), get_admin_url() . 'admin.php' ) ) . '" target="_blank">', '</a>' ); ?></p>
				</footer>
			</div>
			<?php
		}

		/**
		 * Returns available tabs for settings page.
		 *
		 * @since  1.0.16
		 * @return array
		 */
		public function tabs() {
			return array(
				'general' => esc_html__( 'General Settings', RCS_TEXT_DOMAIN ),
				'formats' => esc_html__( 'Supported Currencies Format', RCS_TEXT_DOMAIN ),
			);
		}

		/**
		 * Renders tab navigation.
		 *
		 * @since  1.0.16
		 * @param  string $current_tab Current active tab.
		 */
		public function tabs_nav( $current_tab ) {
			$tabs = $this->tabs();
			?>
			<div class="nav-tab-wrapper rcs-nav-tabs">
				<?php
				foreach ( $tabs as $slug => $title ) {
					$active_class = ( $current_tab === $slug ) ? 'nav-tab-active' : '';
					$tab_url      = ( $current_tab === $slug ) ? '#' : admin_url( 'admin.php?page=realhomes-currencies-settings&tab=' . $slug );
					echo '<a class="nav-tab ' . esc_attr( $active_class ) . '" href="' . esc_url( $tab_url ) . '">' . esc_html( $title ) . '</a>';
				}
				?>
			</div>
			<?php
		}

		/**
		 * Register settings for the plugin.
		 *
		 * @since  1.0.0
		 */
		public function register_settings() {
			// General settings
			register_setting( 'rcs_settings_group', 'rcs_settings' );

			// Currency formats - separate group to prevent conflict
			register_setting(
				'rcs_formats_group',
				'rcs_custom_currency_formats',
				array(
					'type'              => 'array',
					'sanitize_callback' => array( $this, 'sanitize_custom_formats' ),
					'default'           => array(),
				)
			);
		}

		/**
		 * Sanitize the custom currency formats array.
		 *
		 * @since  1.0.16
		 * @param  array $formats Raw formats from form submission.
		 * @return array Sanitized formats.
		 */
		public function sanitize_custom_formats( $formats ) {
			if ( ! is_array( $formats ) ) {
				return array();
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

			return $sanitized;
		}

	}
}
