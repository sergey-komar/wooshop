<?php
// РАСПРОДАЖА В КАРТОЧКЕ ТОВАРА НА СТРАНИЦЕ МАГАЗИНА

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>

<div class="product-card-offer">

	<?php if ( $product->is_on_sale() ) : ?>

		<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="onsale offer-hit">' . esc_html__( 'Sale', 'wooeshop' ) . '</div>', $post, $product ); ?>

	<?php endif; ?>

	
	<!-- ЕСЛИ ТОВАР В ИЗБРАННЫХ ТО ВЫВОДИТ ПЛАШКУ HIT -->
	<?php if ( $product->is_featured() ): ?>
		<div class="offer-new"><?php _e( 'Hit', 'wooeshop' ) ?></div>
	<?php endif; ?>

</div><!-- ./product-card-offer -->
