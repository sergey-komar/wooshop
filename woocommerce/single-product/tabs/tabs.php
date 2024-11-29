<?php
// ТАБЫ В КАРТОЧКЕ ТОВАРА

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs nav nav-tabs" role="tablist">
			<?php $i = 0; foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="nav-item <?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<button class="nav-link <?php if ( ! $i ) echo 'active' ?>" data-bs-target="#tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</button>
				</li>
			<?php $i++; endforeach; ?>
		</ul>

        <div class="tab-content" id="myTabContent">
            <?php $i = 0; foreach ( $product_tabs as $key => $product_tab ) : ?>
                <div class="tab-pane fade <?php if ( ! $i ) echo 'show active' ?> woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab2" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                    <?php
                    if ( isset( $product_tab['callback'] ) ) {
                        call_user_func( $product_tab['callback'], $key, $product_tab );
                    }
                    ?>
                </div>
            <?php $i++; endforeach; ?>
        </div>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
