/*!
 * main.js
 */
(function($) {
    $(document).ready(function() {
        function scrollToAnchor(aid) {
            var aTag = $("section[name='" + aid + "']");
            $('html,body').animate({
                scrollTop: aTag.offset().top
            }, 'slow')
        }
        $("#neo-link").click(function() {
            scrollToAnchor('neo-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $("#heart-link").click(function() {
            scrollToAnchor('heart-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $("#alternate-link").click(function() {
            scrollToAnchor('alternate-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $("#lol-link").click(function() {
            scrollToAnchor('lol-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $("#am-x-link").click(function() {
            scrollToAnchor('am-x-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $("#am-y-link").click(function() {
            scrollToAnchor('am-y-link');
            $("#cat-popup").removeClass("fadeIn");
            $('.popup-overlay').removeClass('fadeIn')
        });
        $('.mobile-burger-menu, .burger-menu-top').on('click', function(event) {
            $('.burger').trigger('click')
        });
        $('.burger').on('click', function() {
            $('.mobile-burger-menu, .burger-menu-top').toggleClass('is-active');
            $(this).toggleClass('is-active');
            $('nav').toggleClass('popin')
        });
        $('.search-button-mobile a').click(function() {
            if ($('.search-button-mobile').hasClass('is-active')) {
                $('.search-button-mobile').removeClass('is-active');
                $('.search-box-container.fadeIn').removeClass('fadeIn')
            } else {
                $('.search-button-mobile').addClass('is-active');
                $('.search-box-container').addClass('fadeIn');
                setTimeout(function() {
                    $('#searchBox').focus()
                }, 300)
            }
        });
        $('.search-box-container span a').on('click', function() {
            $('.search-button-mobile.is-active').removeClass('is-active');
            $('.search-box-container.fadeIn').removeClass('fadeIn')
        });
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            var messageOffset = ($(".message-section").offset() !== undefined) ? $(".message-section").offset().top : 0;
            var messageOuter = ($(".message-section").offset() !== undefined) ? $(".message-section").outerHeight() : 0;
            var message = messageOffset - messageOuter;
            if ((scrollTop > message - 700)) {
                $('.yellow-cart').addClass('stick-cart');
                $('.yellow-cart').css('bottom', '5%')
            } else {
                $('.yellow-cart').removeClass('stick-cart');
                $('.yellow-cart').css('bottom', '40%')
            }
        });
        $(".change-item").hover(function() {
            var imageChange = $(this).children().attr('data-image-change');
            $(this).parent().parent().siblings().children().children().children().attr('src', imageChange)
        });
        $(".change-item").click(function() {
            var imageChange = $(this).children().attr('data-image-change');
            $(this).parent().parent().siblings().children().children().children().attr('src', imageChange)
        });
        $('.description-img').on('setPosition', function() {});
        $(window).on('resize', function(e) {});
        $(window).on('load', function(e) {});

        function jbResizeSlider() {
            $slickSlider = $('.description-img');
            $slickSlider.find('.slick-slide').height('auto');
            var slickTrack = $slickSlider.find('.slick-track');
            var slickTrackHeight = $(slickTrack).height();
            $slickSlider.find('.slick-slide').css('height', slickTrackHeight + 'px')
        }
        $(".click-register").click(function() {
            $('.popup-container').addClass('fadeIn');
            $('.popup-overlay').addClass('fadeIn')
        });
        $(".reg-log-close span").click(function(e) {
            e.preventDefault();
            $('.popup-container').removeClass('fadeIn');
            $('.popup-overlay').removeClass('fadeIn')
        });
        $(".popup-overlay").click(function(e) {
            e.preventDefault();
            $('.popup-container').removeClass('fadeIn');
            $(this).removeClass('fadeIn')
        });
        $(".register-mobile").click(function() {
            $(".login-mobile").removeClass('reg-log-active');
            $(this).addClass('reg-log-active');
            $('.reg-log-target').removeClass('reg-log-show').removeClass('reg-log-hide');
            $('.reg-log-key').removeClass('reg-log-show').removeClass('reg-log-hide');
            $('.login-inner').addClass('reg-log-hide');
            $('.register-inner').addClass('reg-log-show');
            $('.reg-log-key').addClass('reg-log-hide')
        });
        $(".login-mobile").click(function() {
            $(".register-mobile").removeClass('reg-log-active');
            $(this).addClass('reg-log-active');
            $('.reg-log-target').removeClass('reg-log-show').removeClass('reg-log-hide');
            $('.reg-log-key').removeClass('reg-log-show').removeClass('reg-log-hide');
            $('.register-inner').addClass('reg-log-hide');
            $('.login-inner').addClass('reg-log-show');
            $('.reg-log-key').addClass('reg-log-show')
        });
        $(".quick-purhcase-close span").click(function(e) {
            e.preventDefault();
            $('#quick-purchase-popup').removeClass('fadeIn');
            $('.popup-overlay').removeClass('fadeIn')
        });
        $(".popup-overlay").click(function(e) {
            e.preventDefault();
            $('#quick-purchase-popup').removeClass('fadeIn');
            $(this).removeClass('fadeIn')
        });
        $('.quick-image-selected').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: !1,
            fade: !0,
            asNavFor: '.quick-sub-choices'
        });
        $('.quick-sub-choices').slick({
            arrows: !0,
            prevArrow: '<button class="slick-prev"><</button>',
            nextArrow: '<button class="slick-next">></button>',
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.quick-image-selected',
            infinite: !0,
            focusOnSelect: !0
        });
        $(".click-category").click(function() {
            $('#cat-popup').addClass('fadeIn');
            $('.popup-overlay').addClass('fadeIn')
        });
        $(".cat-dd-close span").click(function(e) {
            e.preventDefault();
            $('#cat-popup').removeClass('fadeIn');
            $('.popup-overlay').removeClass('fadeIn')
        });
        $(".popup-overlay").click(function(e) {
            e.preventDefault();
            $('#cat-popup').removeClass('fadeIn');
            $(this).removeClass('fadeIn');
            $('.cat-op').removeClass('hvr-pop')
        });
        $('#first').carousel({
            interval: 30000
        });
        $('#second').carousel({
            interval: 35000
        });
        $('#third').carousel({
            interval: 8000
        });
        $('#fourth').carousel({
            interval: 150000
        });
        $('#last').carousel({
            interval: 25000
        });
        $('#first-2').carousel({
            interval: 30000
        });
        $('#second-2').carousel({
            interval: 35000
        });
        $('#third-2').carousel({
            interval: 8000
        });
        $('#fourth-2').carousel({
            interval: 150000
        });
        $('#last-2').carousel({
            interval: 25000
        })
    });
    $(document).ready(function() {
        $('.gallery-image').click(function() {
            $('.gallery-enlarger').addClass('enlarge-show');
            $('.popup-overlay').addClass('fadeIn')
        });
        $('.cat-enlarge').click(function() {
            var cid = $(this).data('cid');
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/colorwise-category-gallery-images/' + cid,
                type: "GET",
                dataType: "json",
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                beforeSend: function() {
                    $('.category-gallery-image-ol').children().remove();
                    $('.category-gallery-image-item').children().remove()
                },
                success: function(res) {
                    var counter = 0;
                    $.each(res, function(key, value) {
                        var active_class = (key == 0 ? "active" : "");
                        var imgPath = '/img/products/drop/' + value.filename;
                        var ol = '<li data-target="#cat" data-slide-to="' + counter + '" class="' + active_class + '">\n' + '                    <div class="thumbnail-container thumb-cont">\n' + '                        <img src="' + imgPath + '" alt="thumb">\n' + '                    </div>\n' + '                </li>';
                        var item = '<div class="item ' + active_class + '">\n' + '                    <img src="' + imgPath + '" alt="thumb">\n' + '                    <div class="carousel-caption capt-cat">\n' + '                    </div>\n' + '                </div>';
                        counter++;
                        $('.category-gallery-image-ol').append(ol);
                        $('.category-gallery-image-item').append(item)
                    })
                },
                complete: function() {
                    $('.gallery-enlarger').addClass('enlarge-show');
                    $('.popup-overlay').addClass('fadeIn')
                }
            })
        });
        $(".popup-overlay").click(function() {
            $('.gallery-enlarger').removeClass('enlarge-show');
            $('.popup-overlay').removeClass('fadeIn')
        });
        $(".close-big").click(function() {
            $('.gallery-enlarger').removeClass('enlarge-show');
            $('.popup-overlay').removeClass('fadeIn');
            $('.cat-op').removeClass('hvr-pop')
        });
        $('img.thumb').click(function() {
            $('.enlarge-position>img').replaceWith(this)
        });
        var scrollButton = $('#scroll-top');
        $(window).scroll(function() {
            $(this).scrollTop() >= 700 ? scrollButton.show() : scrollButton.hide()
        });
        scrollButton.click(function() {
            $('html,body').animate({
                scrollTop: 0
            }, 800)
        });
        $(document).on('click', '.cat-size li', function() {
            if ($(this).hasClass('out-of-stock') == !1) {
                if ($(this).hasClass('scalling-li')) {
                    $(this).removeClass('scalling-li')
                } else {
                    $(this).siblings('li').removeClass('scalling-li');
                    $(this).addClass('scalling-li')
                }
            } else {
                Swal.fire("This item is out of stock.", '', 'warning')
            }
        });
        $('.faq-content').each(function(index, content) {
            var clickable = $(this).children('.faq-question');
            var collapseable = $(this).children('.answer-container');
            $(clickable).click(function(event) {
                if ($('>div', collapseable).hasClass('hide-answer')) {
                    $('>div', collapseable).removeClass('hide-answer')
                } else {
                    $('>div', collapseable).addClass('hide-answer')
                }
                $('>span>i', clickable).toggleClass('rotate')
            })
        });
        $('.car-cont').click(function() {
            var selected_item = $(this).parent().siblings('div').children('select');
            var scalling_li = $(this).parent().siblings('ul').find('.scalling-li');
            var selected_item_val = selected_item.val();
            var selected_item_values = selected_item_val.split('-');
            var selected_item_stock = parseInt(selected_item_values[2]);
            if (selected_item_stock == 0) {
                Swal.fire("This item is out of stock.", '', 'warning')
                return !1
            }
            var cat_size_img = $(this).parent().siblings('ul').children('li').hasClass('scalling-li');
            var cat_size_sel = parseInt(selected_item_val);
            if (cat_size_img || cat_size_sel > 0) {
                var pid = $(this).children('img').data('pid');
                if (cat_size_img == !1) {
                    var t = selected_item_val;
                    var z = t.split('-');
                    var cid = parseInt(z[1])
                } else {
                    var cid = (cat_size_sel > 0 ? cat_size_sel : scalling_li.data('pacid'))
                }
                var aid = (cat_size_sel > 0 ? cat_size_sel : scalling_li.data('aid'));
                var qty = 1;
                var pname = $(this).children('img').data('pname');
                var price = parseInt($(this).siblings('span').find('h2').data('price'));
                var img = $('div#cat-thumb-' + $('img.add-cart', this).attr('data-cid') + ' ol.carousel-indicators.thumb-indicators>li.active>.thumbnail-container.thumb-cont>img').attr('src');
                var alt = $('div#cat-thumb-' + $('img.add-cart', this).attr('data-cid') + ' ol.carousel-indicators.thumb-indicators>li.active>.thumbnail-container.thumb-cont>img').attr('alt');
                var token = $('meta[name="csrf-token"]').attr('content');
                var formData = [{
                    name: "product_id",
                    value: pid
                }, {
                    name: "description-color-attribute-color-id",
                    value: cid
                }, {
                    name: "description-size-attribute-id",
                    value: aid
                }, {
                    name: "description-quantity",
                    value: qty
                }, {
                    name: "description-price",
                    value: price
                }];
                $.ajax({
                    url: '/add-cart',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'data': formData,
                        '_method': 'POST',
                        '_token': token,
                        'called_from': 'category_page'
                    },
                    success: function(res) {
                        if (res.response == 'success') {
                            var subtotal = $('#top-cart-subtotal-price').length > 0 ? $('#top-cart-subtotal-price').attr('data-subtotal') : 0;
                            var grandtotal = parseFloat(subtotal) + parseFloat(price);
                            var current_item_on_top = (parseInt($('.item-badge').html()) == 0) ? null : parseInt($('.item-badge').html());
                            current_item_on_top = current_item_on_top + 1;
                            $('.item-badge').html(current_item_on_top);
                            $('#category-add-cart-popup').html('<img id="category-add-cart-popup" src="' + img + '" alt="' + alt + '">');
                            $('#category-add-cart-popup-product-name').html(pname);

                            $('#category-add-cart-popup-total-items').html(res.count);
                            $('#category-add-cart-popup-total-price').html('$'+ parseFloat(res.item_total).toFixed(2));
                            $('#category-add-cart-popup-subtotal-price').html('$'+ parseFloat(res.cart_subtotal).toFixed(2));
                            $('#category-add-cart-popup-quantity').html(res.item_qty);


                            var current = parseInt($('.cart-button-mobile .cart-badge').html());
                            $('.cart-button-mobile .cart-badge').html(current + 1);
                            $('.reposition .cart-badge').html(current + 1);
                            $('.scroll-cart .cart-badge').html(current + 1);
                            $('.pop-up-cat').css({
                                'z-index': '99999999999',
                                'opacity': 1,
                                'transition': '0.3s all ease-in-out',
                                'top': '-3%',
                            });
                            $('.fixed-popup').css('z-index', '999999999998');
                            $('.popup-bg').css({
                                'z-index': '999999999999',
                                'opacity': 0.3,
                                'transition': '0.3s all ease-in-out',
                            });
                            $(this).addClass('click-pop');
                            scalling_li.removeClass('.scalling-li');
                            $(".addtocart-screen-scroll").load(" .addtocart-screen-scroll");
                            $(".addtocart-screen").css('height', '');
                            if (parseInt(res.quantity_left) <= 0) {
                                var size = scalling_li.data('sizel')
                                scalling_li.addClass('out-of-stock');
                                $('img', scalling_li).attr('src', '/frontend/assets/images/' + size + '_out.png');
                                $(document).find('#drop_mobile_' + aid + '_' + cid).append(' <span class="sold-out">(sold out)</span>')
                            }
                        }
                    },
                    error: function() {
                        Swal.fire("Item not available in inventory.", '', 'warning')
                    },
                    complete: function() {
                        $('.select-selected').html('Size');
                        $('.select-selected').removeAttr('style');
                        $('.select-selected').removeClass('select-arrow-active');
                        $('.select-items > div').removeClass('same-as-selected');
                        $('ul.cat-size > li').removeClass('scalling-li');
                        $('.custom-select>select').val(0)
                    }
                })
            } else {
                Swal.fire("Please select the size first.", '', 'warning')
            }
        });
        $('.close-popup, .popup-bg, .continueshopping-incart').click(function() {
            $('.pop-up-cat').css({
                'z-index': '-2',
                'opacity': 0,
                'top': '10%'
            });
            $('.fixed-popup').css('z-index', '-2');
            $('.popup-bg').css({
                'z-index': '-2',
                'opacity': 0
            });
            $('.car-cont').removeClass('click-pop')
        });
        $('.basket').hover(function() {
            var floatingCartTop = parseInt($(this).offset().top) + parseInt($(this).outerHeight()) + 40;
            var floatingCartRight = parseInt($(window).outerWidth()) - parseInt($('header .nav-search input').offset().left) - 30;
            if ($(window).width() > 767) {
                $('#cart-screen').css({
                    'z-index': '99999',
                    'opacity': 1,
                    'transition': '0.5s all ease-in-out',
                    'top': floatingCartTop,
                    'right': floatingCartRight,
                    'left': 'auto'
                })
            } else {
                $('#cart-screen').css({
                    'z-index': '99999',
                    'opacity': 1,
                    'transition': '0.5s all ease-in-out',
                    'top': '5%',
                    'right': 'auto',
                    'left': '50%',
                    'transform': 'translateX(-50%)',
                    'height': '85%'
                })
            }
            $('body').css("overflow", "hidden")
        }, function() {});
        $('#cart-xs').click(function() {
            $('#cart-screen').css({
                'z-index': '99999',
                'opacity': 1,
                'transition': '0.5s all ease-in-out',
                'top': '5%',
                'right': 'auto',
                'left': '50%',
                'transform': 'translateX(-50%)',
                'height': '85%'
            });
            $('body').css("overflow", "hidden")
        });
        $(document).on('click', '.close-cart-shiping', function() {
            $('#cart-screen').css({
                'z-index': '-1',
                'opacity': 0,
                'top': '6%'
            });
            $('.add-cart').removeClass('click-pop');
            $('body').css("overflow-y", "scroll")
        });
        $(document).on('click', '.main-cont', function() {
            $('#cart-screen').css({
                'z-index': '-1',
                'opacity': 0,
                'top': '6%'
            });
            $('.add-cart').removeClass('click-pop');
            $('body').css("overflow-y", "scroll")
        });
        $(".button-cart").on("click", function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1
                } else {
                    newVal = 0
                }
            }
            $button.parent().find("input").val(newVal)
        });
        $('.non-selected').click(function() {
            $(this).css('display', 'none');
            $(this).next().css('display', 'block')
        });
        $('.selected').click(function() {
            $(this).css('display', 'none');
            $(this).prev().css('display', 'block')
        });
        $('.description-main .description-img').on('click',function(e) {
            var mouseX = e.pageX;
            var mouseY = e.pageY;

            var headerPosition = $("header .logo-container").position();
            var headerHeight = $("header .logo-container").height();
            var headerWidth = $("header .logo-container").width();

            var headerPositionX = Math.ceil(headerWidth + headerPosition.left);
            var headerPositionY = Math.ceil(headerHeight + headerPosition.top);

            if(mouseX < headerPositionX && mouseY < headerPositionY){
                window.location.href = "/";
            }
        });
        $('.description-main .description-img').mousemove(function(e) {
            var mouseX = e.pageX;
            var mouseY = e.pageY;

            var headerPosition = $("header .logo-container").position();
            var headerHeight = $("header .logo-container").height();
            var headerWidth = $("header .logo-container").width();

            var headerPositionX = Math.ceil(headerWidth + headerPosition.left);
            var headerPositionY = Math.ceil(headerHeight + headerPosition.top);

            if(mouseX < headerPositionX && mouseY < headerPositionY){
                $(this).css("cursor", "pointer");
            }else{
                $(this).css("cursor", "default");
            }
        });
        $('.cat-side').length > 0 ? $('.cat-side').swipe({
            click: function(event, target) {
                $(".side.jplist-panel").toggleClass("side-show");
                $(".visible-xs.cat-side").toggleClass("cat-side-show");
                $("#filter_tab_arrow").toggleClass("tab-arrow-open");
            },
            swipeStatus: function(event, phase, direction, distance, duration, fingers) {
                if (phase == "move" && direction == "right") {
                    $('.cat-side').addClass('cat-side-show');
                    $('.side').addClass('side-show');
                    $('.tab-arrow').addClass('tab-arrow-open');
                    return !1
                }
                if (phase == "move" && direction == "left") {
                    $(".cat-side").removeClass('cat-side-show');
                    $('.side').removeClass('side-show');
                    $('.tab-arrow').removeClass('tab-arrow-open');
                    return !1
                }
            }
        }) : !1
    })
})(jQuery);
