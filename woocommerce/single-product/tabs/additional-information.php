<?php
// ЗАГОЛОВОК У ТАБОВ В КАРТОЧКЕ ТОВАРА ВКЛАДКА ДЕТАЛИ

defined( 'ABSPATH' ) || exit;

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );

?>

<?php if ( $heading ) : ?>
	<h4><?php echo esc_html( $heading ); ?></h4>
<?php endif; ?>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
