<!DOCTYPE html>
<html lang="<?php language_attributes()?>">
<head>
    <meta charset="<?php bloginfo('charset')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head()?>
</head>
<body <?php body_class()?>>
<?php wp_body_open(  )?>
<div class="wrapper">

    <header class="header">
        <div class="header-top py-1">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-4">


                    <!-- Выводим кастомайзер в настройках темы -->
                    <?php
                        global $wooeshop_theme_options;
                        $wooeshop_theme_options = wooeshop_theme_options(); 
                     ?>
                        <div class="header-top-phone d-flex align-items-center h-100">
                              <!-- Выводим кастомайзер в настройках темы -->
                            <?php if ( ! empty( $wooeshop_theme_options['phone'] ) ): ?>
                            <i class="fa-solid fa-mobile-screen"></i>
                            <a href="+<?php echo str_replace( array( ' ', '-', '+' ), array( '', '', '' ), $wooeshop_theme_options['phone'] ) ?>" class="ms-2">123-456-7890</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-sm-4 d-none d-sm-block">
                        <ul class="social-icons d-flex justify-content-center">
                              <!-- Выводим кастомайзер в настройках темы -->
                            <?php if ( ! empty( $wooeshop_theme_options['youtube'] ) ): ?>
                            <li>
                                <a href="<?php echo $wooeshop_theme_options['youtube'] ?>">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                              <!-- Выводим кастомайзер в настройках темы -->
                            <?php if ( ! empty( $wooeshop_theme_options['facebook'] ) ): ?>
                            <li>
                                <a href="<?php echo $wooeshop_theme_options['facebook'] ?>">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                              <!-- Выводим кастомайзер в настройках темы -->
                            <?php if ( ! empty( $wooeshop_theme_options['instagram'] ) ): ?>
                            <li>
                                <a href="<?php echo $wooeshop_theme_options['instagram'] ?>">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4">
                        <div class="header-top-account d-flex justify-content-end">
                            <div class="btn-group me-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Account
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">Sign In</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Sign Up</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        EN
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">RU</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">DE</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ./header-top-account -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ./header-top -->

        <div class="header-middle bg-white py-4">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <a href="<?php echo home_url('/')?>" class="header-logo h1"><?php bloginfo('name');?></a>
                    </div>

                    <div class="col-sm-6 mt-2 mt-md-0">
                        <!-- <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Searching..."
                                    aria-label="Searching..." aria-describedby="button-search">
                                <button class="btn btn-outline-warning" type="submit" id="button-search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form> -->
                        <?php aws_get_search_form( true ); ?>
                    </div>

                </div>
            </div>

        </div>
        <!-- ./header-middle -->
    </header>
   
    <div class="header-bottom sticky-top" id="header-nav">
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start" id="offcanvasNavbar" tabindex="-1"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Catalog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'menu-header',
                            'container' => false,
                            'menu_class' => 'navbar-nav',
                            'walker' => new Wooeshop_Header_Menu
                        ])
                        ?>
                       
                    </div>
                </div>

                <?php if(! is_cart()) :?>
                <div>
                    <a href="#" class="btn p-1">
                        <i class="fa-solid fa-heart"></i>
                        <span class="badge text-bg-warning cart-badge bg-warning rounded-circle">3</span>
                    </a>

                    
                    <button class="btn p-1" id="cart-open" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge text-bg-warning cart-badge bg-warning rounded-circle">
                        <?php //echo WC()->cart->get_cart_contents_count(); ?>
                        <?php echo count( WC()->cart->get_cart() ); ?>
                        </span>
                    </button>
                </div>
                <?php endif;?>

            </div>
        </nav>
    </div>
    <!-- ./header-bottom -->
    <?php if(! is_cart()) :?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php woocommerce_mini_cart();?>
            <!-- <div class="table-responsive">
                <table class="table offcanvasCart-table">
                    <tbody>
                        <tr>
                            <td class="product-img-td"><a href="#"><img src="assets/img/products/1.jpg" alt=""></a>
                            </td>
                            <td><a href="#">Product 1 Lorem ipsum dolor, sit amet consectetur adipisicing.</a></td>
                            <td>$65</td>
                            <td>&times;1</td>
                            <td><button class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-img-td"><a href="#"><img src="assets/img/products/2.jpg" alt=""></a>
                            </td>
                            <td><a href="#">Product 2</a></td>
                            <td>$80</td>
                            <td>&times;2</td>
                            <td><button class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-img-td"><a href="#"><img src="assets/img/products/3.jpg" alt=""></a>
                            </td>
                            <td><a href="#">Product 3</a></td>
                            <td>$100</td>
                            <td>&times;1</td>
                            <td><button class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end">Total:</td>
                            <td>$325</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="#" class="btn btn-outline-warning">Cart</a>
                <a href="#" class="btn btn-outline-secondary">Checkout</a>
            </div> -->

            
        </div>
    </div>
    <?php endif;?>
    
