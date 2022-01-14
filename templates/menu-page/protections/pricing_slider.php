<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use wpWax\dLawyers\Directorist_Support;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$min_max_price = Directorist_Support::get_max_min_price();

?>
<div class="directorist-search-field">

	<?php if ( !empty($data['label']) ): ?>
		<label><?php echo esc_html( $data['label'] ); ?></label>
	<?php endif; ?>

	<div class="directorist-form-group">
		<div class="consultation_ranger default-ad-search">
			<div class="card-content">
				<div class="form-group">
					<div class="price-range rs-primary">
						<div class="price-range__input-values d-none">
							<input type="hidden" name="price[0]" class="price-range__input-values__min" value="">
							<input type="hidden" name="price[1]" class="price-range__input-values__max" value="">
							<input type="hidden" class="pricing-range__values" data-currency-symbol="<?php echo Directorist_Support::get_currency_symbol(); ?>" data-min-price="<?php echo isset( $min_max_price['min'] ) ? $min_max_price['min'] : 0; ?>" data-max-price="<?php echo isset( $min_max_price['max'] ) ? $min_max_price['max'] : ''; ?>">
						</div>
						<div class="slider-range"></div>
						<p class="slider-peragraph">
							<span class="amount"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>