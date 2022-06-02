app.ready(function(){


    /*******************    Dynamic Product Attributes Fields Generate Here   *************************/
    var maxField = 1000; //Input fields increment limitation
    var addButton = $('.add_field'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="form-group row field_wrapper">\n' +
        '                            <div class="form-inline">\n' +
        '                                <div class="col-sm-3">\n' +
        '                                    <div class="form-group">\n' +
        '                                        <input class="form-control" name="sku[]" id="sku" type="text" placeholder="SKU" required>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="col-sm-3">\n' +
        '                                    <div class="form-group">\n' +
        /*'                                        <input class="form-control" name="size[]" id="size" type="text" placeholder="Size" required>\n' +*/
        '                                            <select class="form-control" name="size[]" id="size" required>\n' +
        '                                                <option value="0">-- Select Size --</option>\n' +
        '                                                <option value="1">One Size</option>\n' +
        '                                                <option value="s">S</option>\n' +
        '                                                <option value="m">M</option>\n' +
        '                                                <option value="l">L</option>\n' +
        '                                                <option value="xl">XL</option>\n' +
        '                                                <option value="2xl">2XL</option>\n' +
        '                                                <option value="3xl">3XL</option>\n' +
        '                                                <option value="4xl">4XL</option>\n' +
        '                                            </select>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="col-sm-3">\n' +
        '                                    <div class="form-group">\n' +
        '                                        <input class="form-control" name="price[]" id="price" type="text" placeholder="Price" required>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="col-sm-3">\n' +
        '                                    <a href="javascript:void(0)" class="btn btn-danger remove_button"><i class="fa fa-minus"></i></a>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                    </div>';

    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).after(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $('div').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents('.field_wrapper').remove(); //Remove field html
        x--; //Decrement field counter
    });

    //If one size is selected, no other size attribute are allowed for this product
    $(document).on('change', '#size', function(event){
        var parent = $(this).parent('.form-group').parent('.col-sm-3').parent('.form-inline').parent('.field_wrapper');
        if( $(this).val() == 1 ) {
            parent.addClass('current');
            $(document).find('.remove_button, .add_field').fadeOut('fast');
            $(document).find('.field_wrapper').each(function(idx, el){
                if( !$(el).hasClass('current') ) {
                    $(el).slideUp('fast');
                }
            });

        }
        else {
            parent.removeClass('current');
            $(document).find('.remove_button, .add_field').fadeIn('fast');
            $(document).find('.field_wrapper').slideDown('fast');
        }
    });
    /*******************   ./Dynamic Product Attributes Fields Generate Here   *************************/

    /*******************    Dynamic Attributes Colors Fields Generate Here   *************************/
    var color_maxField = 10; //Input fields increment limitation
    var color_addButton = $('.add_color_field'); //Add button selector
    var color_wrapper = $('.color_field_wrapper'); //Input field wrapper
    var color_fieldHTML = '<div class="form-group row color_field_wrapper">\n' +
        '                        <div class="form-inline">\n' +
        '                            <div class="col-sm-5">\n' +
        '                                <div class="form-group">\n' +
        '                                    <input class="form-control" name="color_code[]" id="color_code" type="text" value="#33cabb" data-provide="colorpicker" required>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-5">\n' +
        '                                <div class="form-group">\n' +
        '                                    <input class="form-control" name="color_name[]" id="color_name" type="text" placeholder="Color Name" required>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-2">\n' +
        '                                <a href="javascript:void(0)" class="btn btn-danger remove_button"><i class="fa fa-minus"></i></a>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>';

    var y = 1; //Initial field counter is 1

    //Once add button is clicked
    $(color_addButton).click(function(){
        //Check maximum number of input fields
        if(y < color_maxField){
            y++; //Increment field counter
            $(color_wrapper).after(color_fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $('div').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents('.color_field_wrapper').remove(); //Remove field html
        y--; //Decrement field counter
    });
    /*******************   ./Dynamic Attributes Colors Fields Generate Here   *************************/

    /*******************    Dynamic Image Fields Generate Here   *************************/
    var image_maxField = 10; //Input fields increment limitation
    var image_addButton = $('.add_image_field'); //Add button selector
    var image_wrapper = $('.image_field_wrapper'); //Input field wrapper
    var image_fieldHTML = '<div class="form-group row color_field_wrapper">\n' +
        '                        <div class="form-inline">\n' +
        '                            <div class="col-sm-2">\n' +
        '                                <div class="form-group">\n' +
        '                                    <input class="form-control" name="color_code[]" id="color_code" type="text" value="#33cabb" data-provide="colorpicker" required>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-2">\n' +
        '                                <div class="form-group">\n' +
        '                                    <input class="form-control" name="color_name[]" id="color_name" type="text" placeholder="Color Name" required>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-4">\n' +
        '                                <div class="form-group">\n' +
        '                                    <input class="form-control" name="product_image[]" id="product_image" type="file" accept="image/*" required>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-3">\n' +
        '                                <div class="form-group">\n' +
        '                                    <select class="form-control" name="show_to_option[]">\n' +
        '                                        <option value="1" selected>Yes</option>\n' +
        '                                        <option value="0">No</option>\n' +
        '                                      </select>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="col-sm-1">\n' +
        '                                <div class="form-group">\n' +
        '                                     <a href="javascript:void(0)" class="btn btn-danger remove_button"><i class="fa fa-minus"></i></a>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>';

    var z = 1; //Initial field counter is 1

    //Once add button is clicked
    $(image_addButton).click(function(){
        //Check maximum number of input fields
        if(z < image_maxField){
            z++; //Increment field counter
            $(image_wrapper).after(image_fieldHTML); //Add field html
        }

    });


    //Once remove button is clicked
    $('div').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parents('.image_field_wrapper').remove(); //Remove field html
        z--; //Decrement field counter
    });
    /*******************   ./Dynamic Image Fields Generate Here   *************************/

    // Customer Detail
    $('.view-customer-detail').click(function () {
        var cid = $(this).data('cid');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/dashboard/detail-customer/'+cid,
            type:"GET",
            dataType:"json",
            data: { '_method': 'GET', '_token': token },
            beforeSend: function(){
                //$('#loader').css("visibility", "visible");
                $('#customerDetailModal').find('tbody').children('tr').remove();
            },

            success:function(res) {
                var row = '';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing Name</th>\n' +
                    '                            <td>'+res.billing_fullname+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing Email</th>\n' +
                    '                            <td>'+res.billing_email+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing Address</th>\n' +
                    '                            <td>'+res.billing_address+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing City</th>\n' +
                    '                            <td>'+res.billing_city+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing State</th>\n' +
                    '                            <td>'+res.billing_state+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Billing Zip</th>\n' +
                    '                            <td>'+res.billing_zip+'</td>\n' +
                    '                        </tr>';

                row += '<tr>\n' +
                    '                            <th scope="row">Same Address</th>\n' +
                    '                            <td>'+res.same_address+'</td>\n' +
                    '                        </tr>';

                if(res.same_address != 'Yes') {

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping Name</th>\n' +
                        '                            <td>' + res.shipping_fullname + '</td>\n' +
                        '                        </tr>';

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping Email</th>\n' +
                        '                            <td>' + res.shipping_email + '</td>\n' +
                        '                        </tr>';

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping Address</th>\n' +
                        '                            <td>' + res.shipping_address + '</td>\n' +
                        '                        </tr>';

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping City</th>\n' +
                        '                            <td>' + res.shipping_city + '</td>\n' +
                        '                        </tr>';

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping State</th>\n' +
                        '                            <td>' + res.shipping_state + '</td>\n' +
                        '                        </tr>';

                    row += '<tr>\n' +
                        '                            <th scope="row">Shipping Zip</th>\n' +
                        '                            <td>' + res.shipping_zip + '</td>\n' +
                        '                        </tr>';

                }

                $('#customerDetailModal').find('tbody').append(row);

            },
            complete: function(){
                //$('#loader').css("visibility", "hidden");
                $('#customerDetailModal').modal('show');
            }
        });

    });
    /******** ./Customer Detail ************/

    // Order Detail
    /* $(document).on('click', '.view-order-detail', function () {
        var oid = $(this).data('oid');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/dashboard/detail-order/"+oid,
            type: "GET",
            dataType: "json",
            data: {
                '_method': 'GET',
                '_token': token
            },
            beforeSend: function(){
                //$('#loader').css("visibility", "visible");
                $('#orderDetailModal').find('tbody').children('tr').remove();
            },

            success:function(response) {
                var res = response[0];
                console.log(response)

                var rows = '';

                rows += '<tr>\n' +
                    '                            <th scope="row">order_id</th>\n' +
                    '                            <td>'+res.order_id+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_fullname</th>\n' +
                    '                            <td>'+res.billing_fullname+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_email</th>\n' +
                    '                            <td>'+res.billing_email+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_address</th>\n' +
                    '                            <td>'+res.billing_address+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_city</th>\n' +
                    '                            <td>'+res.billing_city+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_state</th>\n' +
                    '                            <td>'+res.billing_state+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">billing_zip</th>\n' +
                    '                            <td>'+res.billing_zip+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">same_address</th>\n' +
                    '                            <td>'+res.same_address+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_fullname</th>\n' +
                    '                            <td>'+res.shipping_fullname+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_email</th>\n' +
                    '                            <td>'+res.shipping_email+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_address</th>\n' +
                    '                            <td>'+res.shipping_address+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_city</th>\n' +
                    '                            <td>'+res.shipping_city+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_state</th>\n' +
                    '                            <td>'+res.shipping_state+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">shipping_zip</th>\n' +
                    '                            <td>'+res.shipping_zip+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">payment_status</th>\n' +
                    '                            <td>'+res.payment_status+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">payment_charge_id</th>\n' +
                    '                            <td>'+res.payment_charge_id+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">currency</th>\n' +
                    '                            <td>'+res.currency+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">brand</th>\n' +
                    '                            <td>'+res.brand+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">country</th>\n' +
                    '                            <td>'+res.country+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">session_id</th>\n' +
                    '                            <td>'+res.session_id+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">order_date</th>\n' +
                    '                            <td>'+res.order_date+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">product_id</th>\n' +
                    '                            <td>'+res.product_id+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">product_name</th>\n' +
                    '                            <td>'+res.product_name+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">product_code</th>\n' +
                    '                            <td>'+res.product_code+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">category</th>\n' +
                    '                            <td>'+res.category+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">collection</th>\n' +
                    '                            <td>'+res.collection+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">sku</th>\n' +
                    '                            <td>'+res.sku+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">size</th>\n' +
                    '                            <td>'+res.size+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">color_name</th>\n' +
                    '                            <td>'+res.color_name+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">quantity</th>\n' +
                    '                            <td>'+res.quantity+'</td>\n' +
                    '                        </tr>\n' +
                    '    <tr>\n' +
                    '                            <th scope="row">price</th>\n' +
                    '                            <td>'+res.price+'</td>\n' +
                    '                        </tr>';


                $('#orderDetailModal').find('tbody').append(rows);

            },
            complete: function(){
                //$('#loader').css("visibility", "hidden");
                $('#orderDetailModal').modal('show');
            }
        });

    }); */
    $(document).on('click', '.view-order-detail', function () {
        var oid = $(this).data('oid');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/dashboard/detail-order/"+oid,
            type: "GET",
            dataType: "html",
            data: {
                '_method': 'GET',
                '_token': token
            },
            beforeSend: function(){
                $('#order_modal_body').html('');
                // $('#loader').css("visibility", "visible");
                // $('#orderDetailModal').find('tbody').children('tr').remove();
            },
            success:function(response) {
                // console.log(response)
                $.when( $('#order_modal_body').html(response) ).then(function(){
                    $('#orderDetailModal').modal('show');
                });
            },
            error: function() {

            }
        });
    });
    /************ ./Order Detail **************/

    // Order Status Change
    $('#order-status').on('change', function () {
        var oid = $(this).data('oid');
        var cid = $(this).data('cid');
        var token = $('meta[name="csrf-token"]').attr('content');
        var sid = $(this).val();

        swal({
            title: 'Are you sure?',
            text: "It will notify the customer via email",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/dashboard/order-status/' + oid + '/' + sid + '/' + cid,
                        type: "GET",
                        dataType: "json",
                        data: {'_method': 'GET', '_token': token},
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            if (response.code == '200') {
                                swal({
                                    title: "Changed!",
                                    text: "Order status has been changed and email sent successfully!",
                                    type: "success",
                                    showConfirmButton: true

                                }).then(function () {
                                    location.reload();
                                });

                            } else {
                                swal({
                                    title: "Changed!",
                                    text: "Order status has been changed but email was not sent!",
                                    type: "warning",
                                    showConfirmButton: false

                                }).then(function () {
                                    location.reload();
                                });
                            }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
        }

        }).then(function() {

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                var i = $('#order-status').find(':disabled')[0].index;
                $('#order-status').prop('selectedIndex', i);
            }

        }).catch(swal.noop);

    });

    /************ ./Order Select All Checkbox **************/
    $('.orders-check-all').change(function(event){
        var check = $(this).prop('checked');
        $('.orders-checks').each(function(idx, chk){
            $(chk).prop('checked', check);
        });
    });


    $('.orders-checks').change(function(event){
        var checkall = true;
        $('.orders-checks').each(function(idx, chk){
            if( $(this).prop('checked') == false) {
                checkall = false;
            }
        });
        $('.orders-check-all').prop('checked', checkall)
    });

    /************ ./Order Multi-selection Action **************/
    $('#orders_action').change(function(event){
        console.log($(this).val());
        if( $(this).val() == 'status' ){
            $('#orders_action_status_label').fadeIn('fast');
        }
        else {
            $('#orders_action_status_label').fadeOut('fast');
        }
    });

    $('#orders_action_form').submit(function(event){
        var selected = [];
        var action1 = $('#orders_action').val();
        var action2 = $('#orders_action_status').val();
        $('.orders-checks').each(function(idx, chk){
            if( $(chk).prop('checked') == true) {
                mtochecked = true;
                selected.push( $(chk).val() );
            }
        });
        if( action1 == '' ) {
            alert('Please select an action to perform.');
            return false;
        }
        if( action2 == '' ) {
            alert('Please select status to change.');
            return false;
        }
        if( selected.length <= 0 ) {
            alert('Please select atleast one order to perform action.');
            return false;
        }
    });

    /************ ./Order Status Change **************/

    // Attribute Color Stock Update
    $('.attribute-color-stock-update').click(function () {
        var acid = $(this).data('acid');
        var token = $('meta[name="csrf-token"]').attr('content');
        var stock = $(this).siblings('input').val();

        $.ajax({
            url: '/dashboard/update-attribute-color-stock',
            type:"POST",
            dataType:"json",
            data: { '_method': 'POST', '_token': token, 'acid': acid, 'stock': stock },
            beforeSend: function(){
                //$('#loader').css("visibility", "visible");
            },

            success:function(response) {

                if(response.code == '200') {

                    if (response.code == '200') {
                        swal({
                            title: "Updated!",
                            text: "Stock has been updated successfully!",
                            type: "success",
                            showConfirmButton: true

                        }).then(function () {
                            location.reload();
                        });
                    }
                }

            },
            complete: function(){
                //$('#loader').css("visibility", "hidden");
            }
        });

    });
    /************ ./Attribute Color Stock Update **************/

    // Attribute max cart qty Update
    $('.attribute-color-max-qty-update').click(function () {
        var acid = $(this).data('acid');
        var token = $('meta[name="csrf-token"]').attr('content');
        var max_cart_qty = $(this).siblings('#max_cart_qty_'+acid).val();
        
        $.ajax({
            url: '/dashboard/update-attribute-max-cart-qty',
            type:"POST",
            dataType:"json",
            data: { '_method': 'POST', '_token': token, 'acid': acid, 'max_cart_qty': max_cart_qty },
            beforeSend: function(){
                //$('#loader').css("visibility", "visible");
            },

            success:function(response) {

                if(response.code == '200') {

                    if (response.code == '200') {
                        swal({
                            title: "Updated!",
                            text: "Max Qty has been updated successfully!",
                            type: "success",
                            showConfirmButton: true

                        }).then(function () {
                            location.reload();
                        });
                    }
                }

            },
            complete: function(){
                //$('#loader').css("visibility", "hidden");
            }
        });

    });
    /************ ./Attribute max cart qty Update **************/

    // Delete Product
    $(document).on('click', '.delete-product', function () {
        var pid = $(this).data('pid');
        var token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the product with all its images",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/dashboard/delete-product',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'pid': pid },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Product has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Product has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./Delete Product **************/

    // multi Delete Product
    $(document).on('click', '.multi-delete-product', function () {


      var checkedVals = $('.sub_chk:checkbox:checked').map(function() {
    return this.value;
    }).get();

        var ids = checkedVals.join(",");
        var token = $('meta[name="csrf-token"]').attr('content');

        if(ids == ''){
          swal({
              title: "Error!",
              text: "Please Select the product!",
              type: "warning"
          });
          return false;
        }


        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the selected products["+ids+"] with all its images.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/dashboard/delete-multi-product',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'ids': ids },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Product has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Product has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./multi Delete Product **************/
    $('input[type="radio"].admin-filter-cat').change(function(){
        var current = this;
        var cls = 'input[type="radio"].admin-filter-cat.' + $(current).data('type');
        var catids = new Array();
        var ajaxData = new Object();
        var filter_cat = $(current).val();
        $(cls).each(function(index, el){
            if( $(current).attr('id') != $(el).attr('id') ) {
                $(el).prop('checked', false);
            }
        });
        $('input[type="radio"].admin-filter-cat').each(function(idx, el){
            if( $(el).prop('checked') ) {
                catids.push( $(el).data('catid') + "__"  + $(el).val() );
            }
        });
        console.log(ajaxData);
        var tempOverlayStyle = '<style type="text/css" id="deleteme">'+
                                '.categories.main-content {' +
                                    'position: relative;' +
                                '}' +
                                '.categories.main-content:before {' +
                                    'content: "Working...";' +
                                    'position: absolute;' +
                                    'width: 100%;' +
                                    'height: 100%;' +
                                    'background: rgba(0,0,0,0.5);' +
                                    'left: 0;' +
                                    'top: 0;' +
                                    'z-index: 9;' +
                                    'text-align: center;' +
                                    'vertical-align: middle;' +
                                    'padding-top: 20%;' +
                                    'color: #fff;' +
                                    'font-size: 2em;' +
                                    'font-weight: bold;' +
                                '}' +
                            '</style>';
        $('.categories.main-content').before(tempOverlayStyle);

        $.ajax({
            type: "POST",
            url: "/dashboard/manage-category/update-filter-category",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'catids': catids
            },
            dataType: "json",
            success: function (response) {
            },
            error: function() {
                alert('Something went wrong, please again later.');
            },
            complete: function() {
                $('style#deleteme').remove();
            }
        });
    });

});
