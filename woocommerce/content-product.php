<?php
//КАРТОЧКА ТОВАРА

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// ПРОВЕРЯЕМ НАХОДИМСЯ ЛИ НА ГЛАВНОЙ СТРАНИЦЕ или НА СТРАНИЦЕ ПОИСКА, ЕСЛИ ДА ПОДСТАВЛЯЕМ ОДНИ КЛАССЫ ЕСЛИ НЕТ, ТО ДРУГИЕ
$product_classes = (is_front_page() || is_search() || is_product()) ? 'col-lg-3 col-md-4 col-sm-6 mb-3' : 'col-lg-4 col-sm-6 mb-3';
?>
<div <?php wc_product_class( $product_classes, $product ); ?>>
	<div class="product-card">
		<div class="ajax-loader">
			<img src="<?php echo get_template_directory_uri()?>/assets/img/ripple.svg" alt="img">
		</div>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>


	<!-- ОБОРАЧИВАЕМ КАРТИНКУ В НУЖНЫЙ КЛАСС И ДЕЛАЕМ ЕЁ ССЫЛКОЙ -->
	<div class="product-thumb">
		<!-- <a href="<?php the_permalink()?>"> -->
		<a href="<?php echo $product->get_permalink();?>">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		</a>
	</div><!-- product-thumb -->


	<div class="product-details">
		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<!-- ОПИСАНИЕ ТОВАРА -->
	 	<div class="product-excerpt mb-2"><?php the_content('');?></div>


		<div class="product-bottom-details">
			
			<?php
	
			// РЕЙТИНГ ВЫВОДИМ
			echo '<div class="shop-rating">';
			woocommerce_template_loop_rating();

			// КОЛЛИЧЕСТВО РАЙТИНГА
			$rating_cnt = $product->get_rating_count();
			echo '<div class="woostudy-rating-count"> <small>(' . $rating_cnt . ')</small> </div>';
			echo '</div>';

			
			echo '<div class="text-center">';
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );

			echo '</div>';
			?>
			
			</div><!-- product-bottom-details -->
		</div><!-- product-details -->
	</div> <!-- product-card -->
</div><!-- col-lg-3 col-md-4 col-sm-6 mb-3 -->
