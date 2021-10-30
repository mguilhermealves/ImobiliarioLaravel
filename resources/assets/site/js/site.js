jQuery(document).ready(function($) {

    $(document).ready(function() {
        $(".menu-toogle").click(function() {
            $(".painel-menu-usuario").toggleClass("menu-ativo");
        });
        $(".close-menu").click(function() {
            $(".painel-menu-usuario").removeClass("menu-ativo");
        });
    });

    jQuery('.slider-home').slick({
        arrows: false,
        autoplay: true,
        dots: true,
        slidesToShow: 1,
        variableWidth: false
    });

    jQuery('.lista-parceiros').slick({
        arrows: false,
        autoplay: true,
        dots: false,
        rows: 1,
        slidesToShow: 4,
        responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 1,
            }
        },]
    });

    jQuery('.lista-palestras').slick({
        arrows: false,
        autoplay: true,
        dots: true,
        slidesToShow: 4,
        variableWidth: false,
        responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 1,
            }
        },]
    });

    jQuery('.lista-videos').slick({
        arrows: true,
        autoplay: false,
        dots: false,
        slidesToShow: 4,
        variableWidth: false,
        responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 1,
            }
        },]
    });

    jQuery('.lista-numeros').slick({
        arrows: true,
        autoplay: false,
        dots: false,
        slidesToShow: 1,       
    });




    jQuery('.list-anunciantes').slick({
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",
        arrows: true,
        autoplay: false,
        slidesToShow: 4,
        responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 1,
            }
        }, ]
    });

    jQuery('.carrosel-sobre').slick({
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",
        arrows: true,
        autoplay: false,
        slidesToShow: 3,
    });

    jQuery('.slide-galeria').slick({
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",
        arrows: true,
        autoplay: false,
        slidesToShow: 1,
    });




    var position = jQuery(window).scrollTop();

    window.onscroll = function() {
        scrollFunction();
    };

    jQuery(function() {
        scrollFunction();
    });


    function scrollFunction() {
        if (document.body.scrollTop > 35 || document.documentElement.scrollTop > 35) {
            jQuery("#topopage").addClass('bg-ativo');



        } else {
            jQuery("#topopage").removeClass('bg-ativo');

        }
    }


    var maskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
            }
        };

    jQuery('.telefone input[type="tel"]').on('focus', function() {

        jQuery('.telefone input[type="tel"]').mask(maskBehavior, options);

    });

    jQuery('.telefone input[type="text"]').on('focus', function() {

        jQuery('.telefone input[type="text"]').mask(maskBehavior, options);

    });


    jQuery('.cep input[type="text"]').on('focus', function() {

        jQuery('.cep input[type="text"]').mask('00000-000');

    });

    jQuery('.cpf input[type="text"]').on('focus', function() {

        jQuery('.cpf input[type="text"]').mask('000.000.000-00');

    });

    jQuery('.cnpj input[type="text"]').on('focus', function() {

        jQuery('.cnpj input[type="text"]').mask('00.000.000/0000-00');

    });

    jQuery('body').on('change', '.filtro-cidade', function() {
        $val = jQuery(this).val();
        if ($val.length > 0) {
            jQuery(this).parents('.caixa-resultado').find('.agencia').each(function() {
                if (jQuery(this).data('cidade').search(new RegExp($val, "i")) < 0) {
                    jQuery(this).fadeOut();
                } else {
                    jQuery(this).show();
                }
            });
        } else {
            jQuery(this).parents('.caixa-resultado').find('.agencia').each(function() {
                jQuery(this).show();
            });
        }
    });


    $("#queroInscrever").on('click',function(){
        $('html, body').animate({
            scrollTop: $(".form-inscricao").offset().top
        }, 2000);
    });
   


});