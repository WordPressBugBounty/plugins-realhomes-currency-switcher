/**
 * Currency Format Settings JavaScript
 * Handles panel toggling, live preview updates, and reset functionality.
 *
 * @since 1.0.16
 */
jQuery(function ($) {
	'use strict';

	// Initialize previews on page load
	$('.rcs-currency-format-panel').each(function () {
		var currency = $(this).find('.rcs-panel-header').data('currency');
		if (currency) {
			updatePreview(currency);
		}
	});

	// Panel toggle functionality - using event delegation for flexibility
	$(document).on('click', '.rcs-panel-header', function () {
		var $header = $(this);
		$header.toggleClass('active');
		$header.next('.rcs-panel-content').slideToggle(200);
	});

	// Live preview update on input change - using event delegation
	$(document).on('input change', '.rcs-format-input', function () {
		var currency = $(this).data('currency');
		if (currency) {
			updatePreview(currency);
		}
	});

	// Reset to default button - using event delegation
	$(document).on('click', '.rcs-reset-format', function () {
		var $btn = $(this);
		var currency = $btn.data('currency');
		var $panel = $btn.closest('.rcs-currency-format-panel');

		// Reset form fields to default values
		$panel.find('[data-field="symbol"]').val($btn.data('default-symbol'));
		$panel.find('[data-field="position"]').val($btn.data('default-position'));
		$panel.find('[data-field="symbol_spacing"]').val($btn.data('default-spacing') || '');
		$panel.find('[data-field="decimals"]').val($btn.data('default-decimals'));
		$panel.find('[data-field="thousands_sep"]').val($btn.data('default-thousands'));
		$panel.find('[data-field="decimals_sep"]').val($btn.data('default-decimals-sep'));
		$panel.find('[data-field="rounding"]').val($btn.data('default-rounding') || 'none');

		updatePreview(currency);
	});

	/**
	 * Update the preview for a specific currency
	 */
	function updatePreview(currency) {
		// Direct selector instead of .has() for better performance
		var $panel = $('.rcs-currency-format-panel[data-currency="' + currency + '"]');
		if (!$panel.length) {
			return;
		}

		var symbol = $panel.find('[data-field="symbol"]').val() || currency;
		var position = $panel.find('[data-field="position"]').val() || 'before';
		var spacing = $panel.find('[data-field="symbol_spacing"]').val() || '';

		// Robust decimals validation using Number.isFinite()
		var decimalsRaw = parseInt($panel.find('[data-field="decimals"]').val(), 10);
		var decimals = Number.isFinite(decimalsRaw) && decimalsRaw >= 0 ? decimalsRaw : 0;

		// Use || fallback since .val() returns empty string, not undefined
		var thousandsSep = $panel.find('[data-field="thousands_sep"]').val();
		var decimalsSep = $panel.find('[data-field="decimals_sep"]').val();
		thousandsSep = (thousandsSep !== undefined && thousandsSep !== '') ? thousandsSep : ',';
		decimalsSep = (decimalsSep !== undefined && decimalsSep !== '') ? decimalsSep : '.';

		// Apply rounding to sample price
		var rounding = $panel.find('[data-field="rounding"]').val() || 'none';
		var samplePrice = 1234567.89;
		if (rounding === 'ceil') {
			samplePrice = Math.ceil(samplePrice);
		} else if (rounding === 'floor') {
			samplePrice = Math.floor(samplePrice);
		}

		// Format sample price
		var formattedPrice = formatPrice(samplePrice, decimals, thousandsSep, decimalsSep);

		// Build preview with symbol position
		var preview = (position === 'before')
			? symbol + spacing + formattedPrice
			: formattedPrice + spacing + symbol;

		// Only decode HTML entities if symbol contains encoded characters
		if (symbol.indexOf('&') !== -1) {
			preview = decodeHtml(preview);
		}

		$('.rcs-format-preview[data-currency="' + currency + '"]').text(preview);
		$('.rcs-live-preview[data-currency="' + currency + '"]').text(preview);
	}

	/**
	 * Format a number with custom separators
	 */
	function formatPrice(price, decimals, thousandsSep, decimalsSep) {
		var fixed = price.toFixed(decimals);
		var parts = fixed.split('.');
		var intPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
		var decPart = parts[1] || '';

		return (decimals > 0 && decPart) ? intPart + decimalsSep + decPart : intPart;
	}

	/**
	 * Decode HTML entities
	 */
	function decodeHtml(text) {
		var textarea = document.createElement('textarea');
		textarea.innerHTML = text;
		return textarea.value;
	}

});
