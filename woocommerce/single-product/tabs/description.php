<?php
// ЗАГОЛОВОК У ТАБОВ В КАРТОЧКЕ ТОВАРА ВКЛАДКА ОПИСАНИЕ

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

?>

<?php if ( $heading ) : ?>
	<h3><?php echo esc_html( $heading ); ?></h3>
<?php endif; ?>

<?php the_content(); ?>
