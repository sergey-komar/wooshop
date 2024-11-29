<?php
//ШАБЛОН СОПУТСТВУЮЩИЕ ТОВАРЫ

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<!-- УБИРАЕМ ЭТУ ФУНКЦИЮ ТАК КАК ОНА СОЗДАЁТ ОБЕРТКИ LOOP-START И LOOP-END -->
		<?php // woocommerce_product_loop_start(); ?>


			<div class="owl-carousel owl-theme owl-carousel-full">
				<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				// ПОДКЛЮЧАЕМ ШАБЛОН recent-product
				wc_get_template_part( 'content', 'recent-product' );
				?>

				<?php endforeach; ?>
			</div>
			

		<!-- УБИРАЕМ ЭТУ ФУНКЦИЮ ТАК КАК ОНА СОЗДАЁТ ОБЕРТКИ LOOP-START И LOOP-END -->
		<?php // woocommerce_product_loop_end(); ?>

	</section>

	<?php
endif;

wp_reset_postdata();
