<?php
// ОФОРМЛЕНИЕ ЗАКАЗА

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ВСТАВЛЯЕМ ХУК С АРХИВНОЙ СТРАНИЦЫ ЧТОБЫ БЫЛА ОБЁРТКА НА СТРАНИЦЕ КОРЗИНЫ
do_action( 'woocommerce_before_main_content' );


do_action( 'woocommerce_before_checkout_form', $checkout );?>


	<?php
	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
		echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
		return;
	}
	?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<div class="row">
		<div class="col-lg-8 mb-3">
			<div class="checkout p-3 h-100 bg-white">
				<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col2-set" id="customer_details">
					<div class="">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>

			</div>
		</div>
		

		<div class="col-lg-4 mb-3">
			<div class="cart-summary p-3 sidebar">
				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
				
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order table-responsive">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>	
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

 <!-- ВСТАВЛЯЕМ ХУК С АРХИВНОЙ СТРАНИЦЫ ЧТОБЫ БЫЛА ОБЁРТКА НА СТРАНИЦЕ КОРЗИНЫ -->
<?php do_action( 'woocommerce_after_main_content' );?>
