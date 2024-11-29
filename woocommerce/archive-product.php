<?php
//Общая страница магазина

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$content_search = is_search() ? 'col-12' : 'col-lg-9 col-md-8';

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );
?>

		<?php if(! is_search()) :?>
		<div class="col-lg-3 col-md-4">
			<?php
			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
			?>
		</div>
		<?php endif;?>
		<div class="<?php echo $content_search;?>">
			<div class="row">
				<div class="col-12">
					<!-- ВЫРЕЗАЛ КУСОК КОДА ИЗ ПАПКИ LOOP ФАЙЛА HEADER М ВТСАВИЛ СЮДА -->
					<?php
					/**
					 * Hook: woocommerce_show_page_title.
					 *
					 * Allow developers to remove the product taxonomy archive page title.
					 *
					 * @since 2.0.6.
					 */
					if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
						?>
						<h1 class="woocommerce-products-header__title page-title section-title h3">
							<span><?php woocommerce_page_title(); ?></span>
						</h1>
					<?php endif; ?>
				</div> <!--col-12-->

				<!-- ВЫВОДИМ КАРТИНКУ КАТЕГОРИЙ КОД ФУНКЦИИ НАПИСАН В WOOCOMMERCE-HOOKS -->
					<?php if($shop_img = wooeshop_get_shop_thumb()) : ?>
						<div class="col-4 col-sm-2">
							<?php echo $shop_img;?>
						</div>
						<div class="col-8 col-sm-10">
						<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @since 1.6.2.
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
						?>
						</div>
					<?php else :?>
						<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @since 1.6.2.
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
						?>
					<?php endif;?>
				
					<!-- ВЫРЕЗАЛ КУСОК КОДА ИЗ ПАПКИ LOOP ФАЙЛА HEADER М ВТСАВИЛ СЮДА -->
			</div>
			<!-- СООБЩЕНИЕ О ДОБАВЛЕНИ В КОРЗИНУ КОГДА НЕТ AJAX -->
			<div class=""><?php woocommerce_output_all_notices();?></div>
			<?php
			if ( woocommerce_product_loop() ) { ?>
			<div class="d-flex justify-content-between order-sort">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>
			</div>
			
			<?php
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>

				
		</div>

			<?php
				/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
 			get_footer( 'shop' );
 			?>