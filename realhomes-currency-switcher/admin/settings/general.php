<?php
/**
 * General Settings Tab Content.
 *
 * @since    1.0.16
 * @package  realhomes-currency-switcher
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$rcs_settings = get_option( 'rcs_settings' );
?>
<form method="post" action="options.php">
	<?php settings_fields( 'rcs_settings_group' ); ?>
	<table class="form-table">
		<tbody>
		<!-- Currency switcher enable disable -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Currency Switcher', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$enable_currency_switcher = ! empty( $rcs_settings['enable_currency_switcher'] ) ? $rcs_settings['enable_currency_switcher'] : '';
				?>
				<input id="rcs_settings[enable_currency_switcher]" name="rcs_settings[enable_currency_switcher]" type="checkbox" value="1" <?php checked( 1, $enable_currency_switcher ); ?> />
				<label class="description" for="rcs_settings[enable_currency_switcher]"><?php esc_html_e( 'Enable Currency Swithcer on frontend side.', RCS_TEXT_DOMAIN ); ?></label>
			</td>
		</tr>

		<!-- Alternative Currencies enable/disable -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Digital Currencies', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$enable_digital_currencies = ! empty( $rcs_settings['enable_digital_currencies'] ) ? $rcs_settings['enable_digital_currencies'] : '';
				?>
				<input id="rcs_settings[enable_digital_currencies]" name="rcs_settings[enable_digital_currencies]" type="checkbox" value="1" <?php checked( 1, $enable_digital_currencies ); ?> />
				<label class="description" for="rcs_settings[enable_digital_currencies]"><?php esc_html_e( 'Enable Digital Currencies such as Bitcoin, Litecoin, etc.', RCS_TEXT_DOMAIN ); ?></label>
			</td>
		</tr>

		<!-- App ID -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'App ID*', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$app_id = ! empty( $rcs_settings['app_id'] ) ? $rcs_settings['app_id'] : '';
				?>
				<input id="rcs_settings[app_id]" name="rcs_settings[app_id]" type="text" class="regular-text" value="<?php echo esc_attr( $app_id ); ?>"/>
				<p class="description"><label for="rcs_settings[app_id]"><?php echo sprintf( esc_html__( 'You can get your Open Exchange Rate App ID from %s.', RCS_TEXT_DOMAIN ), '<a href="https://support.openexchangerates.org/article/121-your-app-id" target="_blank">here</a>' ); ?></label></p>
			</td>
		</tr>

		<!-- Update frequency -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Update Interval', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$update_frequency = isset( $rcs_settings['update_interval'] ) ? esc_attr( $rcs_settings['update_interval'] ) : 'daily';
				?>
				<select name="rcs_settings[update_interval]" id="update_interval" class="regular-text">
					<option value="hourly" <?php selected( $update_frequency, 'hourly', true ); ?>><?php esc_html_e( 'Hourly', RCS_TEXT_DOMAIN ); ?></option>
					<option value="daily" <?php selected( $update_frequency, 'daily', true ); ?>><?php esc_html_e( 'Daily', RCS_TEXT_DOMAIN ); ?></option>
					<option value="weekly" <?php selected( $update_frequency, 'weekly', true ); ?>><?php esc_html_e( 'Weekly', RCS_TEXT_DOMAIN ); ?></option>
				</select>
				<p class="description"><label for="rcs_settings[update_interval]"><?php esc_html_e( 'Set how frequent you want to update the currency exchange rates.', RCS_TEXT_DOMAIN ); ?></label></p>
			</td>
		</tr>

		<!-- Auto Active Currency -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Auto Select Active Currency', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$auto_active_currency = ! empty( $rcs_settings['auto_active_currency'] ) ? $rcs_settings['auto_active_currency'] : '';
				?>
				<select name="rcs_settings[auto_active_currency]" id="auto_active_currency" class="regular-text">
					<option value="" <?php selected( $auto_active_currency, '', true ); ?>><?php esc_html_e( 'Disable', RCS_TEXT_DOMAIN ); ?></option>
					<option value="true" <?php selected( $auto_active_currency, 'true', true ); ?>><?php esc_html_e( 'Enable', RCS_TEXT_DOMAIN ); ?></option>
				</select>
				<p class="description"><label for="rcs_settings[auto_active_currency]"><?php esc_html_e( 'Automatically switch visitor currency based on location (using IP detection).', RCS_TEXT_DOMAIN ); ?></label></p>
			</td>
		</tr>

		<!-- Base currency of the website -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Base Currency', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$base_currency = empty( $rcs_settings['base_currency'] ) ? 'USD' : $rcs_settings['base_currency'];
				?>
				<input id="rcs_settings[base_currency]" name="rcs_settings[base_currency]" type="text" class="regular-text" value="<?php echo esc_attr( $base_currency ); ?>"/>
				<p class="description"><label for="rcs_settings[base_currency]"><?php esc_html_e( 'Price format settings of easy real estate plugin, will be overwritten by base currency\'s default format.', RCS_TEXT_DOMAIN ); ?></label></p>
			</td>
		</tr>

		<!-- Supported currencies by the current site -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Supported Currencies', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$supported_currencies = empty( $rcs_settings['supported_currencies'] ) ? 'USD,EUR,GBP' : $rcs_settings['supported_currencies'];
				?>
				<textarea id="rcs_settings[supported_currencies]" name="rcs_settings[supported_currencies]" type="text" class="regular-text"><?php echo esc_attr( $supported_currencies ); ?></textarea>
				<p class="description"><label for="rcs_settings[supported_currencies]"><?php esc_html_e( 'Provide comma separated list of currency codes in capital letters.', RCS_TEXT_DOMAIN ); ?></label></p>
				<p class="description"><label for="rcs_settings[supported_currencies]">
					<?php
					echo sprintf( esc_html__( 'You can find full list of supported currencies by %s.', RCS_TEXT_DOMAIN ), '<a href="https://openexchangerates.org/currencies" target="_blank">clicking here</a>' );
					?>
				</label></p>
			</td>
		</tr>

		<!-- Number of currencies to display on frontend -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Number of Currencies to Display on Frontend', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$max_currencies = isset( $rcs_settings['max_currencies'] ) ? intval( $rcs_settings['max_currencies'] ) : 5;
				?>
				<select name="rcs_settings[max_currencies]" id="max_currencies" class="regular-text">
					<?php
					for ( $i = 1; $i <= 50; $i++ ) {
						echo '<option value="' . esc_attr( $i ) . '" ' . selected( $max_currencies, $i, false ) . '>' . esc_html( $i ) . '</option>';
					}
					?>
				</select>
				<p class="description">
					<label for="rcs_settings[max_currencies]">
						<?php esc_html_e( 'Set the number of currencies that should appear on the frontend. The maximum allowed is 50.', RCS_TEXT_DOMAIN ); ?>
					</label>
				</p>
			</td>
		</tr>

		<!-- Expiry period for switched currency -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Expiry Period of Switched Currency', RCS_TEXT_DOMAIN ); ?>
			</th>
			<td>
				<?php
				$switched_currency_expiry = isset( $rcs_settings['switched_currency_expiry'] ) ? esc_attr( $rcs_settings['switched_currency_expiry'] ) : 'day';
				?>
				<select name="rcs_settings[switched_currency_expiry]" id="switched_currency_expiry" class="regular-text">
					<option value="3600" <?php selected( $switched_currency_expiry, '3600', true ); ?>><?php esc_html_e( 'One Hour', RCS_TEXT_DOMAIN ); ?></option>
					<option value="86400" <?php selected( $switched_currency_expiry, '86400', true ); ?>><?php esc_html_e( 'One Day', RCS_TEXT_DOMAIN ); ?></option>
					<option value="604800" <?php selected( $switched_currency_expiry, '604800', true ); ?>><?php esc_html_e( 'One Week', RCS_TEXT_DOMAIN ); ?></option>
					<option value="2592000" <?php selected( $switched_currency_expiry, '2592000', true ); ?>><?php esc_html_e( 'One Month', RCS_TEXT_DOMAIN ); ?></option>
				</select>
				<p class="description"><label for="rcs_settings[switched_currency_expiry]"><?php esc_html_e( 'This is for website visitor.', RCS_TEXT_DOMAIN ); ?></label></p>
			</td>
		</tr>

		<!-- Force update currencies rates -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Update Currencies Rates', RCS_TEXT_DOMAIN ); ?>
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
				<label class="description" for="rcs_settings[update_currencies_rates]"><?php esc_html_e( 'Checking this box will immediately fetch latest currencies exchange rates on Save Options.', RCS_TEXT_DOMAIN ); ?></label>
			</td>
		</tr>

		</tbody>
	</table>

	<?php submit_button(); ?>
</form>
