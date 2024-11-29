<?php
// ЗАГОЛОВОК В КАРТОЧКЕ ТОВАРА НА СТРАНИЦЕ ТОВАРА

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_title( '<h1 class="product_title entry-title section-title h3"><span>', '</span></h1>' );
