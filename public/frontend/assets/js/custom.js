(function($) {
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        $(this).find('input[type="submit"]').prop('disabled', !0);
        var token = $('meta[name="csrf-token"]').attr('content');
        var _email = $(this).find('input[type="email"]').val();
        var _pass = $(this).find('input[type="password"]').val();
        $.ajax({
            url: '/guest',
            type: "POST",
            dataType: "json",
            data: {
                '_method': 'POST',
                '_token': token,
                'email': _email,
                'password': _pass
            },
            success: function(res) {
                if (res.response == '200') {
                    location.reload()
                } else {
                    $('#login-form').find('#login-form-error-message').css('display', 'block');
                    $('#login-form').find('#login-form-error-message').addClass('login-form-error-message');
                    $('#login-form').find('input[type="email"]').focus();
                    $('#login-form').find('input[type="submit"]').prop('disabled', !1)
                }
            }
        })
    });
    $('#forgot-link').on('click', function(e) {
        e.preventDefault();
        $('#reg-log-inner').css('display', 'none');
        $('#forgot-inner').find('h3').css('text-transform', 'none');
        $('#forgot-inner').css('display', 'block')
    });
    $('#forgot-form').on('submit', function(e) {
        e.preventDefault();
        $(this).find('input[type="submit"]').prop('disabled', !0);
        var _token = $('meta[name="csrf-token"]').attr('content');
        var _email = $(this).find('input[type="email"]').val();
        $.ajax({
            url: '/password/email',
            type: "POST",
            dataType: "json",
            data: {
                '_method': 'POST',
                '_token': _token,
                'email': _email
            },
            beforeSend: function() {
                $('.loader').css("display", "block")
            },
            success: function(res) {
                if (res.response == '200') {
                    $('#forgot-form-error-message').html('We have e-mailed your password reset link!');
                    $('#forgot-form-error-message').css('display', 'block');
                    if ($('#forgot-form-error-message').hasClass('alert-danger')) {
                        $('#forgot-form-error-message').removeClass('alert-danger');
                        $('#forgot-form-error-message').addClass('alert-success')
                    } else {
                        $('#forgot-form-error-message').addClass('alert-success');
                        $('#forgot-form').find('input[type="email"]').val('')
                    }
                } else {
                    $('#forgot-form-error-message').html('This email does not match our record!');
                    $('#forgot-form-error-message').css('display', 'block');
                    $('#forgot-form-error-message').addClass('alert alert-warning')
                }
            },
            error: function(error) {
                $('#forgot-form-error-message').html('This email does not match our record!');
                $('#forgot-form-error-message').css('display', 'block');
                if ($('#forgot-form-error-message').hasClass('alert-success')) {
                    $('#forgot-form-error-message').removeClass('alert-success')
                    $('#forgot-form-error-message').addClass('alert-danger')
                } else {
                    $('#forgot-form-error-message').addClass('alert-danger')
                }
            },
            complete: function() {
                $('.loader').css("display", "none")
            }
        })
    });
    $('#forgot-form').find('input[type="email"]').on('focus', function() {
        $('#forgot-form-error-message').css('display', 'none');
        $('#forgot-form').find('input[type="submit"]').prop('disabled', !1)
    });
    $('#register-form').on('submit', function(e) {
        e.preventDefault();
        $(this).find('input[type="submit"]').prop('disabled', !0);
        var _token = $('meta[name="csrf-token"]').attr('content');
        var _name = $(this).find('input[name="name"]').val();
        var _email = $(this).find('input[name="email"]').val();
        var _pass = $(this).find('input[name="password"]').val();
        var _cpass = $(this).find('input[name="password_confirmation"]').val();
        var _promo = $(this).find('input[type="checkbox"]').is(':checked') ? 'on' : 'off';
        $.ajax({
            url: '/register',
            type: "POST",
            dataType: "json",
            data: {
                '_method': 'POST',
                '_token': _token,
                'name': _name,
                'email': _email,
                'password': _pass,
                'password_confirmation': _cpass,
                'promotions': _promo
            },
            beforeSend: function() {
                $('#preloader').css("display", "block")
            },
            success: function(res) {
                console.log(res.response);
                $('#register-form')[0].reset();
                $('.popup-container').removeClass('fadeIn');
                $('.popup-overlay').removeClass('fadeIn');
                Swal.fire("You have registered successfully.", 'Congratulation!', 'success')
                location.reload()
            },
            error: function(error) {
                $('#register-form-error-message').html(error.responseJSON.errors.email[0]);
                $('#register-form-error-message').css('display', 'block')
            },
            complete: function() {
                $('#preloader').css("display", "none")
            }
        })
        $(this).find('input[type="submit"]').prop('disabled', !1)
    });
    $(document).ready(function() {
        if ($('.description-color-btn').length !== 0) {
            var dots = $('.description-color-btn');
            var len = dots.length;
            $(dots[len - 1]).trigger('click');
            len--;
            setInterval(function() {
                if (dots.length >= len) {
                    len--;
                    $(dots[len]).trigger('click');
                    if (len == 0) {
                        len = dots.length
                    }
                }
            }, 20000)
        }
    });
    $('#description-color-dropdown').on('change', function() {
        var color_id = $(this).val();
        var token = $('meta[name="csrf-token"]').attr('content');
        if (color_id) {
            $.ajax({
                type: "GET",
                url: "/description/get/attributes/" + color_id,
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                dataType: "json",
                beforeSend: function() {
                    $.each(['#description-size-dropdown', '#description-quantity-dropdown', '#description-qty-price'], function(indexInArray, valueOfElement) {
                        $(valueOfElement).val('');
                        $(valueOfElement).attr('disabled');
                        var parent = $(valueOfElement).parent('.quick-border').parent('.quick-selection');
                        if (!parent.hasClass('disabled')) {
                            parent.addClass('disabled')
                        }
                    });
                    $('#description-size-dropdown').html('<option value="">--Select Size--</option>');
                    $('#description-quantity-dropdown').html('<option value="">--Quantity--</option>');
                    $('.loader').css("visibility", "visible")
                },
                success: function(response) {
                    if (response.error != undefined && response.error != '') {
                        Swal.fire(response.error, '', 'error')
                    } else {
                        var options = '';
                        $.each(response.attributes, function(idx, el) {
                            var size = '';
                            switch (el.size) {
                                case "1":
                                    size = 'One Size';
                                    break;
                                case "s":
                                    size = 'Small';
                                    break;
                                case "m":
                                    size = 'Medium';
                                    break;
                                case "l":
                                    size = 'Large';
                                    break;
                                case "xl":
                                    size = 'Extra Large';
                                    break;
                                case "2xl":
                                    size = '2 Extra Large';
                                    break;
                                case "3xl":
                                    size = '3 Extra Large';
                                    break;
                                case "4xl":
                                    size = '4 Extra Large';
                                    break
                            }
                            options = options + '<option value="' + el.id + '"' + ' data-inventory="' + el.color_stock + '" ' + (el.color_stock <= 0 ? ' disabled' : '') + '>' + size + ' ' + (el.color_stock <= 0 ? ' <em style="color:#ff0000;">(Sold Out)</em>' : '')+' ($'+el.price + ')</option>'
                        });
                        $('#description-size-dropdown').parent('.quick-border').parent('.quick-selection').removeClass('disabled');
                        $('#description-size-dropdown').removeAttr('disabled');
                        $('#description-size-dropdown').append(options);
                        $('#description-color-image').val(response.color_image)
                        $('#description-color-image-alt').val(response.color_image_alt_text)
                    }
                },
                complete: function() {
                    $('.loader').css("visibility", "hidden")
                }
            })
        }
    });
    $('#description-size-dropdown').on('change', function() {
        var color_id = $('#description-color-dropdown').val();
        var attribute_id = $(this).val();
        var token = $('meta[name="csrf-token"]').attr('content');
        if (color_id && attribute_id) {
            $.ajax({
                url: '/description/get/quantity/' + color_id + '_' + attribute_id,
                type: "GET",
                dataType: "json",
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                beforeSend: function() {
                    $('.loader').css("visibility", "visible");
                    $.each(['#description-quantity-dropdown', '#description-qty-price'], function(indexInArray, valueOfElement) {
                        $(valueOfElement).val('');
                        $(valueOfElement).attr('disabled');
                        var parent = $(valueOfElement).parent('.quick-border').parent('.quick-selection');
                        if (!parent.hasClass('disabled')) {
                            parent.addClass('disabled')
                        }
                    });
                    $('#description-quantity-dropdown').html('<option value="">--Quantity--</option>')
                },
                success: function(stock) {
                    if (stock) {
                        $('#attribute-id').val(attribute_id);
                        var options = '';
                        for (var i = 1; i <= stock.left; i++) {
                            options = options + '<option value="' + i + '" data-cid="' + color_id + '">' + i + '</option>'
                        }
                        $('#description-quantity-dropdown').parent('.quick-border').parent('.quick-selection').removeClass('disabled');
                        $('#description-quantity-dropdown').removeAttr('disabled');
                        $('#description-quantity-dropdown').append(options)
                    }
                },
                complete: function() {
                    $('.loader').css("visibility", "hidden")
                }
            })
        } else {
            $('#description-quantity-dropdown').empty();
            $('#description-quantity-dropdown').append('<option value="">--Quantity--</option>');
            $('#description-qty-price').val('')
        }
    });
    $('#description-quantity-dropdown').on('change', function() {
        var quantity = $(this).val();
        var attribute_id = $('#attribute-id').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        if (attribute_id) {
            $.ajax({
                url: '/description/get/quantity/price/' + attribute_id,
                type: "GET",
                dataType: "json",
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                beforeSend: function() {
                    $('.loader').css("visibility", "visible");
                    $('#description-qty-price').val('');
                    $('#description-qty-price').attr('disabled');
                    var parent = $('#description-qty-price').parent('.quick-border').parent('.quick-selection');
                    if (!parent.hasClass('disabled')) {
                        parent.addClass('disabled')
                    }
                },
                success: function(data) {
                    var total = parseInt(quantity) * parseInt(data[attribute_id]);
                    $('#description-qty-price').val('');
                    $('#description-qty-price').val('$' + total + '.00');
                    $('#description-total-price').val('');
                    $('#description-total-price').val(total);
                    $('#description-qty-price').parent('.quick-border').parent('.quick-selection').removeClass('disabled');
                    $('#description-qty-price').removeAttr('disabled')
                },
                complete: function() {
                    $('.loader').css("visibility", "hidden")
                }
            })
        } else {
            $('#description-qty-price').val('');
            $('#description-total-price').val('')
        }
    });
    $(window).on('load', calculateCardMainHeight);
    $(window).on('resize', calculateCardMainHeight);

    function calculateCardMainHeight() {
        var wh = parseInt($(window).height()),
            hh = parseInt($('body#cart header').height()),
            fh = 0,
            ch = 0;
        if ($(window).width() <= 767) {
            fh = parseInt($('body#cart header .nav-container').height());
            ch = wh - hh - fh - 20
        } else {
            fh = parseInt($('body#cart .footer-inner-page').height());
            ch = wh - hh - fh - 27
        }
        $('body#cart .cart-container .cart-main').css('min-height', ch + 'px')
    }
    $(document).on('click', '.cart-remove-item', function(e) {
        e.preventDefault();
        var cartid = $(this).data('cartid');
        var token = $('meta[name="csrf-token"]').attr('content');
        var parent = $(this).parent('div').parent('.row').parent('.floating-cart-item');
        if (cartid) {
            $.ajax({
                url: '/cart/delete/' + cartid,
                type: "GET",
                dataType: "json",
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                success: function(data) {
                    if (data.success) {
                        var current_item_on_top = (parseInt($('.item-badge').html()) == 0) ? null : parseInt($('.item-badge').html());
                        current_item_on_top = current_item_on_top - 1;
                        $('.cart-badge, .item-badge').html(data.count);
                        $(".addtocart-screen-scroll").load(" .addtocart-screen-scroll");
                        if (current_item_on_top == 0) {
                            $(".addtocart-screen").css('height', '250px')
                        }
                        parent.slideUp(function() {
                            parent.remove();
                            var sizel = $('li#desktop_' + data.response).data('sizel');
                            var sizes = $('li#desktop_' + data.response).data('sizes');
                            $('li#desktop_' + data.response).removeClass('out-of-stock');
                            $('li#desktop_' + data.response + '>img').attr('src', '/frontend/assets/images/' + sizel + '.png');
                            $('#drop_mobile_' + data.response).html(sizes.toUpperCase())
                        })
                    }
                }
            })
        }
    });
    $(document).on('click', '.cart-remove-item-cart', function(e) {
        e.preventDefault();
        var parent = $(this).parent('.cart-row');
        var cartid = $(this).data('cartid');
        var token = $('meta[name="csrf-token"]').attr('content');
        if (cartid) {
            $.ajax({
                url: '/cart/delete/' + cartid,
                type: "GET",
                dataType: "json",
                data: {
                    '_method': 'GET',
                    '_token': token
                },
                success: function(data) {
                    if (data.success) {
                        parent.slideUp(function() {
                            parent.remove();
                            setTimeout(function() {
                                var total = 0;
                                $('.cart-row').each(function(idx, row) {
                                    var price = parseFloat($('.cart-inner>.cart-total>.cart-total-inner>h3', row).html().replace('$', ''));
                                    total = total + price
                                });
                                total = total.toFixed(2);
                                $('.cart-check-container .cart-check-inner .cart-grand h3#cart-total-amount').html("$" + total);
                                $('.cart-badge, i.item-badge').html(data.count)
                            }, 100)
                        })
                    }
                }
            })
        }
    });
    $('#billing_country, #shipping_country').on('change', function(event) {
        var statesid = $(this).attr('data-statesid');
        var country_code = $(this).val();
        $.ajax({
            type: "GET",
            url: "/cart/checkout/get_states",
            data: {
                '_method': 'GET',
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'country_code': country_code
            },
            dataType: "json",
            success: function(response) {
                var options = '<option value=""> &mdash; State &mdash;</option>';
                if (response) {
                    $(response).each(function(idx, state) {
                        options = options + '<option value="' + (state.code == '' ? state.name : state.code) + '">' + state.name + '</option>'
                    });
                    $('#' + statesid).removeAttr('disabled')
                }
                $('#' + statesid).html(options)
            }
        })
    });
    $('a#get_shipping_rates_action').on('click', function(event) {
        event.preventDefault();
        getShippingRatesFromShippo();
        return !1
    });
    if ($(document).find('.shipping-rate-control').length > 0) {
        $(document).find('.shipping-rate-control').on('change', updateCartTotalWithRates)
    }
    $(document).find('.get-shipping-on-change').each(function(idx, el) {
        $(el).on('change', getShippingRatesFromShippo)
    });

    function getShippingRatesFromShippo() {
        var name = '',
            company = '',
            street1 = '',
            street2 = '',
            city = '',
            state = '',
            zip = '',
            country = '',
            phone = '',
            email = '';
        var total = $('#cart_amount').val();
        if ($('#address-checkbox').prop('checked') == !0) {
            name = $('input#billing_fullname').val();
            email = $('input#billing_email').val();
            street1 = $('input#billing_address').val();
            city = $('input#billing_city').val();
            state = $('select#billing_state').val();
            zip = $('input#billing_zip').val();
            country = $('select#billing_country').val()
        } else {
            name = $('input#shipping_fullname').val();
            email = $('input#shipping_email').val();
            street1 = $('input#shipping_address').val();
            city = $('input#shipping_city').val();
            state = $('select#shipping_state').val();
            zip = $('input#shipping_zip').val();
            country = $('select#shipping_country').val()
        }
        if (state == '' || zip == '') {
            $('#shipping_rates_selection').html('<strong class="red-limited">Please provide at least state and zip to get shipping rates.</strong>');
            $('#get_shipping_rates_response').html('');
            $('a#get_shipping_rates_action').attr('disabled', !0);
            $('#shipping_object_id').val('');
            return !1
        } else {
            $('#shipping_rates_selection').html('<strong class="red-limited">Waiting...</strong>')
        }
        $('#get_shipping_rates_response').html('It may take few seconds to get rates. Working on that, please wait...');
        $('a#get_shipping_rates_action').attr('disabled', !0);
        $('#shipping_object_id').val('');
        setTimeout(function() {
            $.ajax({
                type: "GET",
                url: "/cart/checkout/get_shipping_rates",
                data: {
                    '_method': 'GET',
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'name': name,
                    'company': company,
                    'street1': street1,
                    'street2': street2,
                    'city': city,
                    'state': state,
                    'country': country,
                    'zip': zip,
                    'phone': phone,
                    'email': email,
                    'total': total
                },
                dataType: "json",
                async: !1,
                success: function(response) {
                    if (response == 'Free Shipping') {
                        html = '<label for="free_shipping_rates"  class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">' + ' Free Shipping ($0.00) ' + '<input type="radio" name="shipping_rates" id="free_shipping_rates" class="shipping-rate-control" value="0" style="margin: 0 0 0 10px;" checked>' + '</label>'
                    } else {
                        var html = '';
                        $(response).each(function(idx, el) {
                            html = html + '<label for="' + el.object_id + '"  class="col-md-12" style="margin-bottom: 15px; font-weight: 900; font-size: 1.1em; cursor: pointer;">' + el.provider + ' (' + el.amount + ')' + '<input type="radio" name="shipping_rates" id="' + el.object_id + '" class="shipping-rate-control" value="' + el.amount + '" data-provider="' + el.provider + '" style="margin: 0 0 0 10px;">' + '</label>'
                        })
                    }
                    $('#get_shipping_rates_response').html('');
                    $.when($('#shipping_rates_selection').html(html)).then(function() {
                        $(document).find('.shipping-rate-control').on('change', updateCartTotalWithRates)
                    });
                    $.when(getSalesTaxRates(state, 'US')).then(updateCartTotalWithRates)
                },
                error: function(response) {
                    var errors = $.parseJSON(response.responseText);
                    var errorHtml = '<ul>';
                    $(errors).each(function(idx, error) {
                        errorHtml = errorHtml + '<li class="red-limited">' + error + '</li>'
                    });
                    errorHtml = errorHtml + '</ul>';
                    $('#get_shipping_rates_response').html(errorHtml);
                    $('#shipping_rates_selection').html('<strong class="red-limited">Error.</strong>')
                },
                complete: function() {
                    $('a#get_shipping_rates_action').removeAttr('disabled')
                }
            })
        }, 500)
    }

    function getSalesTaxRates(state, country) {
        $.ajax({
            type: "GET",
            url: "/cart/checkout/get_salestax_rate",
            data: {
                '_method': 'GET',
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'state': state,
                'country': country
            },
            dataType: "json",
            async: !1,
            success: function(response) {
                var rate = parseFloat(response).toFixed(2);
                var cart_amount = $('#cart_amount').val(),
                    sales_tax_amount = 0;
                sales_tax_amount = (parseFloat(rate) / 100) * parseFloat(cart_amount);
                $('#sales_tax_rate_container').html('$' + sales_tax_amount.toFixed(2));
                $('#sales_tax_rate').val(sales_tax_amount.toFixed(2))
            },
            error: function() {
                var rate = parseFloat(0.00).toFixed(2);
                $('#get_shipping_rates_response').html('<strong class="red-limited">No tax rate found of given state (' + state + ') in ' + country + '.');
                $('#sales_tax_rate_container').html('$' + rate);
                $('#sales_tax_rate').val(rate)
            }
        })
    }

    function updateCartTotalWithRates() {
        var shipping_rate = 0;
        var shipping_object_id = '';
        var shipping_provider = '';
        if ($(document).find('.shipping-rate-control').length > 0) {
            $(document).find('.shipping-rate-control').each(function(idx, el) {
                if ($(el).prop('checked')) {
                    $.ajax({
                        type: "POST",
                        url: "/cart/checkout/add_shipping_rates",
                        data: {
                            '_method': 'POST',
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'shipping_object_id': $(el).attr('id')
                        },
                        dataType: "json",
                        async: !1,
                        success: function(response) {},
                        error: function() {
                            $('#get_shipping_rates_response').html('<strong class="red-limited">Something Went Wrong</strong>')
                        }
                    });
                    shipping_rate = $(el).val();
                    shipping_object_id = $(el).attr('id');
                    shipping_provider = $(el).attr('data-provider')
                }
            })
        }
        var sales_tax_rate = $('#sales_tax_rate').val(),
            cart_amount = $('#cart_amount').val(),
            sales_tax_amount = 0;
        shipping_rate = !shipping_rate ? 0 : parseFloat(shipping_rate).toFixed(2);
        sales_tax_rate = !sales_tax_rate ? 0 : parseFloat(sales_tax_rate).toFixed(2);
        cart_amount = !cart_amount ? 0 : parseFloat(cart_amount).toFixed(2);
        var new_total = parseFloat(shipping_rate) + parseFloat(sales_tax_rate) + parseFloat(cart_amount);
        new_total = parseFloat(new_total).toFixed(2);
        $('#total_amount').val(new_total);
        $('.checkout-total .price b').html('$' + new_total);
        $('#paypal_checkout_form input#shipping_charges').val(shipping_rate);
        $('#paypal_checkout_form input[name="shipping"]').val(shipping_rate);
        $('#paypal_checkout_form input#tax_rate').val(sales_tax_rate);
        $('#paypal_checkout_form input[name="tax_rate"]').val(sales_tax_rate);
        $('#shipping_object_id').val(shipping_object_id);
        $('#shipping_provider').val(shipping_provider)
    }
    $('#address-checkbox').on('click', function() {
        var status = $(this).prop('checked');
        if (status) {
            $('#shipping_address_container').hide('500');
            $('#shipping_address_container').find('input, select').attr('disabled', !0);
            $('#billing_address').bind('change', getShippingRatesFromShippo);
            $('#billing_city').bind('change', getShippingRatesFromShippo);
            $('#billing_zip').bind('change', getShippingRatesFromShippo);
            $('#billing_country').bind('change', getShippingRatesFromShippo);
            $('#billing_state').bind('change', getShippingRatesFromShippo)
        } else {
            $('#shipping_address_container').show('500');
            $('#shipping_address_container').find('input, select').attr('disabled', !1);
            $('#billing_address').unbind('change');
            $('#billing_city').unbind('change');
            $('#billing_zip').unbind('change');
            $('#billing_country').unbind('change');
            $('#billing_state').unbind('change')
        }
        getShippingRatesFromShippo()
    });
    $('#add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');
        var formData = $(this).serializeArray();
        $.ajax({
            url: '/add-cart',
            type: "POST",
            dataType: "json",
            data: {
                'data': formData,
                '_method': 'POST',
                '_token': token
            },
            beforeSend: function() {
                $('.loader').css("visibility", "visible");
                $('#btn-add-to-cart-description input').prop('disabled', !0)
            },
            success: function(res) {
                if (res.response == 'success') {
                    var price = $('#description-total-price').val();
                    var quantity = $('#description-quantity-dropdown').val();
                    var subtotal = $('#top-cart-subtotal-price').length > 0 ? $('#top-cart-subtotal-price').attr('data-subtotal') : 0;
                    var grandtotal = (parseFloat(price) * parseInt(quantity)) + parseFloat(subtotal);
                    var pname = $('.description-content>h1:first-of-type').html();
                    var img = '/img/products/drop/' + $('#description-color-image').val();
                    var alt = $('#description-color-image-alt').val();
                    var current_item_on_top = (parseInt($('.item-badge').html()) == 0) ? null : parseInt($('.item-badge').html());
                    current_item_on_top = current_item_on_top + 1;
                    $('.item-badge').html(res.count);
                    $('#category-add-cart-popup').html('<img id="category-add-cart-popup" src="' + img + '" alt="' + alt + '">');
                    $('#category-add-cart-popup-product-name').html(pname);
                    $('#category-add-cart-popup-total-items').html(res.count);
                    $('#category-add-cart-popup-total-price').html('$'+ parseFloat(res.item_total).toFixed(2));
                    $('#category-add-cart-popup-subtotal-price').html('$'+ parseFloat(res.cart_subtotal).toFixed(2));
                    $('#category-add-cart-popup-quantity').html(res.item_qty);
                    var current = parseInt($('.cart-button-mobile .cart-badge').html());
                    $('.cart-button-mobile .cart-badge').html(res.count);
                    $('.reposition .cart-badge').html(res.count);
                    $('.scroll-cart .cart-badge').html(res.count);
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
                    $(".addtocart-screen-scroll").load(" .addtocart-screen-scroll");
                    $(".addtocart-screen").css('height', '');
                    $.each(['#description-size-dropdown', '#description-quantity-dropdown', '#description-qty-price'], function(indexInArray, valueOfElement) {
                        $(valueOfElement).val('');
                        $(valueOfElement).prop('disabled', !0);
                        var parent = $(valueOfElement).parent('.quick-border').parent('.quick-selection');
                        if (!parent.hasClass('disabled')) {
                            parent.addClass('disabled')
                        }
                    });
                    $('#description-size-dropdown').html('<option value="">--Select Size--</option>');
                    $('#description-quantity-dropdown').html('<option value="">--Quantity--</option>');
                    $('#add-to-cart-form')[0].reset()
                }
            },
            complete: function() {
                $('.loader').css("visibility", "hidden");
                $('#btn-add-to-cart-description input').prop('disabled', !1)
            }
        })
    });
    $('input[name="pay_with"]').each(function(index, el) {
        $(el).click(function() {
            if ($(el).prop('checked') == !0 && $(el).val() == 'stripe') {
                if ($('#pay_with_stripe_div').css('display') == 'none') {
                    $('#pay_with_stripe_div').slideDown();
                    $('#cardName').attr('required', !0);
                    $('#cardNumber').attr('required', !0);
                    $('#cardExpiry').attr('required', !0);
                    $('#cardCVC').attr('required', !0)
                }
            } else {
                $('#pay_with_stripe_div').slideUp(function() {
                    $('#cardName').removeAttr('required');
                    $('#cardNumber').removeAttr('required');
                    $('#cardExpiry').removeAttr('required');
                    $('#cardCVC').removeAttr('required')
                })
            }
            if ($(el).prop('checked') == !0 && $(el).val() == 'paypal') {
                if ($('#pay_with_paypal_div').css('display') == 'none') {
                    $('#pay_with_paypal_div').slideDown()
                }
            } else {
                $('#pay_with_paypal_div').slideUp()
            }
        })
    });
    $('#checkout-form').on('submit', function(event) {
        var shipping_rate = 0;
        if ($(document).find('.shipping-rate-control').length > 0) {
            $(document).find('.shipping-rate-control').each(function(idx, el) {
                if ($(el).prop('checked')) {
                    shipping_rate = $(el).val()
                }
            })
        }
        var sales_tax_rate = $('#sales_tax_rate').val();
        if (!shipping_rate || !sales_tax_rate) {
            Swal.fire('You have not selected any rates yet. Please get rates first and select on shipping rate to continue.', '', 'warning')
            if ($(document).find('.shipping-rate-control').length <= 0) {
                $('a#get_shipping_rates_action').trigger('click')
            }
            return !1
        }
        if ($('#pay_with_paypal').prop('checked') == !0) {
            event.preventDefault();
            $('.popup-overlay').css({
                'visibility': 'visible',
                'opacity': '1'
            }).show();
            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "/cart/checkout/paypal/saveorder",
                data: $('#checkout-form').serialize(),
                dataType: "json",
                success: function(response) {
                    $('#order_id').val(response.id);
                    $('#return').val($('#return').val().replace('hash_data', response.hash_data));
                    $('#cancel_return').val($('#cancel_return').val().replace('hash_data', response.hash_data));
                    $('#notify_url').val($('#notify_url').val().replace('hash_data', response.hash_data));
                    setTimeout(function() {
                        window.location.href = "/checkout/paypal/" + response.id
                    }, 500)
                },
            });
            return !1
        }
    });
    const element = document.getElementById('hidden-pagination-control');
    if (element != null) {
        element.addEventListener('jplist.state', (e) => {
            $('.cat-pagin').find('li').removeClass('active');
            $('.jplist-selected').parent('li').addClass('active')
        }, !1)
    }
    $(document).on('submit', '.contact-form-submittable', function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var _subject = $(this).find('input[name="subject"]').val();
        var _email = $(this).find('input[name="subject_email"]').val();
        var _message = $(this).find('textarea[name="message"]').val();
        var _g_recaptcha_response = grecaptcha.getResponse();
        $.ajax({
            url: '/contact',
            type: "POST",
            dataType: "json",
            data: {
                '_method': 'POST',
                '_token': _token,
                'subject': _subject,
                'subject_email': _email,
                'message': _message,
                'g-recaptcha-response': _g_recaptcha_response
            },
            beforeSend: function() {
                $('#preloader').css("display", "block")
            },
            success: function(res) {
                if (res.response == '200') {
                    $('.contact-form-container').addClass('jump-up');
                    $('.thanks').css('display', 'block')
                } else if (res.response == '204') {
                    Swal.fire('Validate a reCaptcha please!', '', 'warning')
                }
            },
            complete: function() {
                $('#preloader').css("display", "none")
            }
        })
    });
    $(document).on('submit', '#checkout-form', function(e) {
        $('#preloader').css("display", "block")
    });
    $('img').mousedown(function(e) {
        if (e.button == 2) {
            return !1
        }
    });
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('.faqs-tab a').click(function(e) {
        e.preventDefault();
        var diff;
        if ($(window).width() > 320 && $(window).width() < 390) {
            diff = 200
        } else if ($(window).width() > 390 && $(window).width() < 450) {
            diff = 300
        } else if ($(window).width() > 1920) {
            diff = 550
        } else {
            diff = 400
        }
        var position = $($(this).attr("href") + ' > .faq-first-question').offset().top - diff;
        $("body, html").animate({
            scrollTop: position
        }, 800, )
    });
    $('.cat-op').click(function() {
        $(this).addClass('hvr-pop')
    });
    $('.mobile-only a img').click(function() {
        $('.tooltip').delay(3000).fadeOut('fast')
    });
    $.fn.equalHeights = function() {
        var max_height = 0;
        $(this).each(function() {
            max_height = Math.max($(this).height(), max_height)
        });
        $(this).each(function() {
            $(this).height(max_height)
        })
    };

    function goToPageJPList(el) {
        var maxVal = $(el).attr('max');
        if (parseInt($(el).val()) > parseInt(maxVal)) {
            $(el).val(maxVal)
        }
        if ($(el).val() <= 0) {
            $(el).val(1)
        }
    }
    $('#reset_jplist_filter').click(function(event) {
        var $this = $(this);
        event.preventDefault();
        $('img.non-selected').css('display', 'block');
        $('img.selected').css('display', 'none');
        setTimeout(function() {
            $this.blur();
            $('body').focus()
        }, 500);
        return !1
    });
    $('.hvr-forward').click(function(event) {
        var li = $(this);
        if ($(window).width() <= 767) {
            li.css({
                '-webkit-transform': 'translateX(8px)',
                'transform': 'translateX(8px)'
            });
            setTimeout(function() {
                li.css({
                    '-webkit-transform': 'translateX(0px)',
                    'transform': 'translateX(0px)'
                })
            }, 300)
        }
    });
    $('.hvr-backward').click(function(event) {
        var li = $(this);
        if ($(window).width() <= 767) {
            li.css({
                '-webkit-transform': 'translateX(-8px)',
                'transform': 'translateX(-8px)'
            });
            setTimeout(function() {
                li.css({
                    '-webkit-transform': 'translateX(0px)',
                    'transform': 'translateX(0px)'
                })
            }, 300)
        }
    });
    new WOW().init();
    if ($('body').is('#homepage')) {
        window.addEventListener('load', function() {
            var HomeCarousel = document.getElementsByClassName('carousel-inner');
            for (var i = 0; i < HomeCarousel.length; i++) {
                var inner = HomeCarousel[i];
                var activeImg = inner.getElementsByClassName('active')[0].getElementsByTagName('img')[0];
                var imgHeight = activeImg.height;
                var screenWidth = window.screen.width;
                var percentage = (screenWidth - imgHeight) / screenWidth;
                var innerChildren = inner.children;
                for (var j = 0; j < inner.children.length; j++) {}
            }
            var num_rows = $('.new-arrivals-section .size-15').length;
            if (num_rows == 1) {
                $('.new-arrivals-section').css('margin-bottom', '15vh')
            }
            var rows = document.getElementsByClassName('size-15');
            var brackets = document.getElementsByClassName('bracket');
            for (var k = 0; k < rows.length; k++) {
                var rowsHeight = rows[k].offsetHeight - 30;
                brackets[k].setAttribute("style", "height:" + rowsHeight + "px");
                brackets[k].classList.add('bracket-bounce-in-left')
            }
        })
    }
    if ($('body').is('#about') || $('body').is('#contact')) {
        $('.basket-about').hover(function() {
            $('#cart-screen').css({
                'z-index': '99999',
                'opacity': 1,
                'transition': '0.5s all ease-in-out',
                'top': '6%',
            });
            $('body').css("overflow", "hidden")
        }, function() {})
    }
    if ($('body').is('#description') || $('body').is('#faq')) {
        $('.basket-faq').hover(function() {
            $('#cart-screen').css({
                'z-index': '99999',
                'opacity': 1,
                'transition': '0.5s all ease-in-out',
                'top': '7%',
            });
            $('body').css("overflow", "hidden")
        }, function() {})
    }
    if ($('body').is('#category')) {
        $(window).on("load", function() {
            setTimeout(function() {
                jplist.init();
            }, 500);
        });
        $('.items-container').fadeIn(1600);
        var x, i, j, selElmnt, a, b, c;
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < selElmnt.length; j++) {
                c = document.createElement("DIV");
                c.setAttribute("data-size", selElmnt.options[j].innerHTML);
                var price = selElmnt.options[j].dataset.price;

                if (selElmnt.options[j].dataset.colorstock != undefined && selElmnt.options[j].dataset.colorstock <= 0) {
                    if(price != undefined){
                      c.innerHTML = '<span class="price_mobile_dropdown">($'+price+')</span>'+selElmnt.options[j].innerHTML + ' <span class="sold-out">(sold out)</span>'
                    }else {
                      c.innerHTML = selElmnt.options[j].innerHTML + ' <span class="sold-out">(sold out)</span>'
                    }

                } else {

                  if(price != undefined){
                    c.innerHTML = '<span class="price_mobile_dropdown">($'+price+')</span>'+selElmnt.options[j].innerHTML
                  }else {
                    c.innerHTML = selElmnt.options[j].innerHTML
                  }
                }
                c.setAttribute('id', 'drop_' + selElmnt.options[j].getAttribute('id'));
                c.addEventListener("click", function(e) {
                  //console.log(this.dataset.size);
                  var size = this.dataset.size;
                    var y, i, k, s, h;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < s.length; i++) {
                        if (s.options[i].innerHTML == size) {
                            s.selectedIndex = i;

                            h.innerHTML = size;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            for (k = 0; k < y.length; k++) {
                                y[k].removeAttribute("class")
                            }
                            this.setAttribute("class", "same-as-selected");
                            break
                        }
                    }
                    h.click()
                });
                b.appendChild(c)
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active")
            })
        }

        function closeAllSelect(elmnt) {
            var x, y, i, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            for (i = 0; i < y.length; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active")
                }
            }
            for (i = 0; i < x.length; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide")
                }
            }
        }
        document.addEventListener("click", closeAllSelect);
        $(document).ready(function() {
            $('.select-items div').click(function() {
                $(this).parent().siblings('.select-selected').css('color', '#DD8028');
                $('.select-items').addClass('select-hide')
            })
        });
        $.myjQuery = function() {
            var rows = $('.main-cat > .row > .items-container').find('.category-item-box');
            if (rows.length == 0) {
                $('.mode-cat').css({
                    'position': 'relative',
                    'top': '800px'
                });
                $('.footer-inner-page').css({
                    'position': 'relative',
                    'top': '800px'
                })
            } else if (rows.length <= 4) {
                $('.mode-cat').css({
                    'position': 'relative',
                    'top': '300px'
                });
                $('.footer-inner-page').css({
                    'position': 'relative',
                    'top': '300px'
                })
            } else {
                $('.mode-cat').css({
                    'position': '',
                    'top': ''
                });
                $('.footer-inner-page').css({
                    'position': '',
                    'top': ''
                })
            }
        };
        document.body.addEventListener('DOMSubtreeModified', function() {
            $.myjQuery()
        }, !1);
        setTimeout(function() {
            $('.equal-heights > div:not(.ignore-equal-height)').equalHeights()
        }, 500)
    }
    if ($('body').is('#cart')) {
        setTimeout(function() {
            $('.equal-heights > div').equalHeights()
        }, 1000)
    }
})(jQuery);
(function($) {
    $(window).on('load', function() {
        if ($('.homepage-urbanenigma-slider').length > 0) {
            $('.homepage-urbanenigma-slider').each(function(index, parent) {
                var slider = $('.slider-inner', $(parent));
                var items_length = $('.f-item', slider).length - 1;
                var durationList = !1;
                var durationList1 = $('.f-item', slider).map(function(index, item) {
                    return item.getAttribute('data-scroll1')
                });
                var durationList2 = $('.f-item', slider).map(function(index, item) {
                    return item.getAttribute('data-scroll2')
                });
                slider.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: !1,
                    slickGoTo: !1,
                    dots: !1,
                    autoplay: !1,
                    adaptiveHeight: !0,
                    speed: 1000
                });
                var slideIndex = currentSlide = inter = 0;
                var changeHomepageSlide = function(timing, durationList) {
                    setTimeout(function() {
                        if (timing !== 0) {
                            slider.slick('slickNext');
                            $('.urbanenigma-slider-indicator>li', $(parent)).each(function(idx, el) {
                                if ($(el).hasClass('active')) {
                                    $(el).removeClass('active')
                                }
                            });
                            currentSlide = slider.slick('slickCurrentSlide');
                            $('.urbanenigma-slider-indicator>li:eq(' + currentSlide + ')', $(parent)).addClass('active')
                        }
                        if (slideIndex >= durationList.length) {
                            slideIndex = 0;
                            if (!durationList || durationList == durationList2) {
                                durationList = durationList1
                            } else {
                                durationList = durationList2
                            }
                        }
                        changeHomepageSlide(durationList[slideIndex++], durationList)
                    }, parseInt(timing) * 1000)
                }
                changeHomepageSlide(0, durationList1);
                $('.urbanenigma-slider-indicator > li', $(parent)).each(function(idx, li) {
                    var li = $(li);
                    li.click(function(event) {
                        var slide_index = li.attr('data-slideindex');
                        var sliderid = '#' + li.attr('data-sliderid');
                        $(sliderid).slick('slickGoTo', parseInt(slide_index));
                        $('.urbanenigma-slider-indicator>li').each(function(idx, el) {
                            if ($(el).hasClass('active')) {
                                $(el).removeClass('active')
                            }
                        });
                        li.addClass('active')
                    })
                })
            })
        }
        if ($('.description-img').length) {
            $('.description-img').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: !1,
                autoplaySpeed: 1000,
                prevArrow: '<a href="javascript:;" class="slick-prev"><img src="' + location.origin + '/frontend/assets/images/desc-arrow-left.png" /></a>',
                nextArrow: '<a href="javascript:;" class="slick-next"><img src="' + location.origin + '/frontend/assets/images/desc-arrow-right.png" /></a>'
            });
            var durationListDesc = $('.description-img img.slide-image:not(.slick-cloned)').map(function(index, item) {
                return item.getAttribute('data-scroll1')
            });
            slideIndex = 0;
            var changeDescriptionSlide = function(timing) {
                setTimeout(function() {
                    if (timing !== 0) {
                        $('.description-img').slick('slickNext')
                    }
                    if (slideIndex >= durationListDesc.length) {
                        slideIndex = 0
                    }
                    changeDescriptionSlide(durationListDesc[slideIndex++])
                }, parseInt(timing) * 1000)
            }
            changeDescriptionSlide(0)
        }
    })
})(jQuery)

function showLoader() {
    $('.popup-overlay').css({
        'visibility': 'visible',
        'opacity': '1'
    }).show();
    $('#preloader').show()
}

function hideLoader() {
    $('.popup-overlay').css({
        'visibility': 'hidden',
        'opacity': '0'
    }).show();
    $('#preloader').hide()
}
