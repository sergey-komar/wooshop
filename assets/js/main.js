(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})();

window.addEventListener('scroll', function () {
    document.getElementById('header-nav').classList.toggle('headernav-scroll', window.scrollY > 135);
});



//ВСТАВЛЯЕМ ЭТО  jQuery(document).ready(function ($) ЧТОБЫ ИСПРАВИТЬ ОШИБКУ В КОНСОЛЛИ jQuery
jQuery(document).ready(function ($) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

    $('#top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });

    $(".owl-carousel-full").owlCarousel({
        margin: 20,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    //ПРЕЛОАДЕР ПРИ ДОБАВЛЕНИИ В КОРЗИНУ
    // https://gist.github.com/bagerathan/2b57e7413bfdd09afa04c7be8c6a617f
    $('body').on('adding_to_cart', function (e, btn, data) {
        btn.closest('.product-card').find('.ajax-loader').fadeIn();
    });

    $('body').on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
        btn.closest('.product-card').find('.ajax-loader').fadeOut();
    });


    

    $('main.main').on('click', '.quantity button', function () {
        let btn = $(this);
        let inputQty = btn.parent().find('.qty');
        let prevValue = +(inputQty.val());
        let newValue = 1;
        if (btn.hasClass('btn-plus')) {
            newValue = prevValue + 1;
        } else {
            if (prevValue > 1) {
                newValue = prevValue - 1;
            }
        }
        inputQty.val(newValue);

        $('.update-cart').prop('disabled', false);
    });
    

});

if(Fancybox){
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
      });
  }