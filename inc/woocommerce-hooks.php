<?php
// ОТКЛЮЧАЕМ ВСЕ СТИЛИ woocommerce
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//КАРТОЧКА ТОВАРА УБИРАЕМ ССЫЛКУ В КОТОРУЮ ОБЁРНУТА КАРТОЧКА
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);


//КАРТОЧКА ТОВАРА ДОБАВЛЯЕМ СВОЙ ТЕГ H4 И ССЫЛКУ НАЗВАНИЮ ТОВАРА
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', function() {
    global $product;
    echo '
     <h4>
        <a href="'. $product->get_permalink() . '"> '. $product->get_title() .'</a>
        </h4>
    ';
});


//РЕЙТИНГ ОТКРЕПЛЯЕМ
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//ОТКРЕПЛЯЕМ СООБЩЕНИЕ О ДОБАВЛЕНИИ В КОРЗИНУ
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);


//МЕНЯЕМ РЕЙТИНГ ДЕЛАЕМ ТАК, ЧТОБЫ ЕСЛИ НЕТ ОЦЕНОК ПОКАЗЫВАЛ ПУСТЫЕ ЗВЁЗДЫ
add_filter( 'woocommerce_product_get_rating_html', function ( $html, $rating, $count ) {
	$html = '';
	/* translators: %s: rating */
	$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
	$html  = '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>';
	return $html;
}, 10, 3 );


//СВОЙ ШОРТКОД ДЛЯ СЛАЙДЕРА В НОВИНКАХ НА ГЛАВНОЙ СТРАНИЦЕ
// custom shortcode
add_shortcode( 'wooeshop_recent_products', 'wooeshop_recent_products' );
function wooeshop_recent_products( $atts ){
	global $woocommerce_loop, $woocommerce;

	extract( shortcode_atts( array(
		'limit' => '12',
		'orderby' => 'date',
		'order' => 'DESC',
	), $atts ) );

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'product',
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $limit,
	);

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'recent-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php endif;

	wp_reset_postdata();

	return '<div class="woocommerce"><div class="owl-carousel owl-theme owl-carousel-full">' . ob_get_clean() . '</div></div>';
}


//AJAX ДЛЯ КОРЗИНЫ иконки кол-во
add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$fragments['span.cart-badge'] = '<span class="badge text-bg-warning cart-badge bg-warning rounded-circle">' . count( WC()->cart->get_cart() ) . '</span>';
	return $fragments;
} );


//ХЛЕБНЫЕ КРОШКИ
// https://woo.com/document/customise-the-woocommerce-breadcrumb/
add_filter( 'woocommerce_breadcrumb_defaults', function () {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<div class="col-12"><nav class="breadcrumbs"><ul>',
		'wrap_after'  => '</ul></nav></div>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => __( 'Home', 'wooeshop' ),
	);
} );


//ИЗОБРАЖЕНИЕ КАТЕГОРИИ НА АРХИВНОЙ СТРАНИЦЕ
// https://woo.com/document/woocommerce-display-category-image-on-category-archive/
function wooeshop_get_shop_thumb() {
	$html = '';
	if ( is_product_category() ){
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			$html .= '<img src="' . $image . '" alt="' . $cat->name . '" class="img-thumbnail">';
		}
	}
	return $html;
}


//КАРТОЧКА КАТЕГРОИЙ НА ГЛАВНОЙ ВЫВОДИМ ЗАГОЛОВОК В H5  И ВЫВОДИМ ПОКАЗАНИЯ СЧЁТКИКА ТОВАРОВ КАТЕГОРИИ
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', function ( $category ) {
	echo "<h5 class='mt-2 categories-home'>{$category->name} <span>({$category->count})</span></h5>";
}, 10 );


// УБИРАЕМ САЙДБАР СО СТРАНИЦЕ ТОВАРА ХУК template_redirect НУЖЕН ДЛЯ КОРРЕКТНОЙ РАБОТЫ ЕСЛИ ЕГО НЕ БУДЕТ И ПРОСТО УБРАТЬ remove_action ТО САЙДБАР УБЕРЁТСЯ ВЕЗДЕ. 
/*add_action( 'template_redirect', function () {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
} );*/

// ОТКРЕПЛЯЕМ ОТ woocommerce_after_single_product_summary  ТОВАРЫ upsel И related
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// УБИРАЕМ НЕ НУЖНЫЕ ПОЛЯ НА СТРАНИЦЕ ОФОРМЛЕНИЯ ЗАКАЗА
add_filter( 'woocommerce_default_address_fields' , function ( $fields ) {
	unset( $fields['company'], $fields['address_2'], $fields['postcode'] );
	return $fields;
} );

// КНОПКА ПОДТВЕРДИТЬ ЗАКАЗ НА СТРАНИЦЕ ОФОРМЛЕНИЯ ЗАКАЗА
add_filter( 'woocommerce_order_button_html', function ( $button ) {
	$btn = str_replace( 'button alt', 'button alt btn btn-warning', $button );
	return '<div class="d-grid mt-3">' . $btn . '</div>';
} );