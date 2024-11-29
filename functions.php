<?php
// https://woocommerce.com/document/woocommerce-theme-developer-handbook/#section-5
// https://codex.wordpress.org/Theme_Customization_API

//Шорт коды вукомерс
//https://woocommerce.com/document/woocommerce-shortcodes/#products

// ВЫВОД КАТЕГОРИЙ
// https://woo.com/document/woocommerce-shortcodes/#product-category 

// УБИРАЕМ ПОЛЯ В ОФОРМЛЕНИИ ЗАКАЗА
// https://developer.woocommerce.com/docs/customizing-checkout-fields-using-actions-and-filters/


function shop__scrript(){
    wp_enqueue_style('wooshop-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    wp_enqueue_style('wooshop-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');
    wp_enqueue_style('wooshop-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('wooshop-owlcarousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css');
    wp_enqueue_style('wooshop-owlcarousel-default', get_template_directory_uri() . '/assets/owlcarousel/owl.theme.default.min.css');
    wp_enqueue_style( 'wooeshop-fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css' );
    wp_enqueue_style('wooshop-custom', get_template_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_style('wooshop-style', get_template_directory_uri() . '/assets/css/main.css');


    wp_enqueue_script('jquery');//подключаем jquery который уже есть в wp
    wp_enqueue_script('wooshop-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', [], '2024', true);
    wp_enqueue_script('wooshop-owlcarousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', [], '2024', true);
    wp_enqueue_script( 'wooeshop-fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), false, true );
    wp_enqueue_script('wooshop-js', get_template_directory_uri() . '/assets/js/main.js', [], '2024', true);
}

add_action('wp_enqueue_scripts', 'shop__scrript');


function debug($data){
    echo '<pre>' . print_r($data, 1) .'</pre>';
}


function shop(){
    load_textdomain('wooeshop', get_template_directory() . '/languages');//переводы

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');//ВКЛЮЧАЕМ ПОДДЕРЖКУ woocomerce
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus(
        array(
            'menu-header' => __('Header menu', 'wooeshop'),
       
        )
        );
}
add_action('after_setup_theme', 'shop');




// САЙДБАР
add_action( 'widgets_init', function () {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'wooeshop' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'wooeshop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
} );



require_once get_template_directory() . '/inc/woocommerce-hooks.php';
require_once get_template_directory() . '/inc/class-wooeshop-header-menu.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/cpt.php';


