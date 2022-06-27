

$(function($) {
    ("use strict");


    $(document).on('click', '.product_payment_gateway_check', function(){

        let gateway_check = $(this).attr('id');

        $('.product_payment_gateway_check').removeClass('active');

        $(this).addClass('active');

        if(gateway_check == 'Paypal'){

            $('#payment_gateway_check').attr('action', $('#product_paypal').val());
            console.log( $('#payment_gateway_check').attr('action'));
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required',false);
            $('#payment_gateway_check').removeClass('product_paystack');

        }
        else if(gateway_check == 'Stripe'){

            $('#payment_gateway_check').attr('action', $('#product_stripe').val());
            $('.payment_show_check').removeClass('d-none');
            $('.payment_show_check input').prop('required',true);
            $('#payment_gateway_check').removeClass('product_paystack');

        }
        else if(gateway_check == 'Paytm'){

            $('#payment_gateway_check').attr('action', $('#product_paytm').val());
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required',false);
            $('#payment_gateway_check').removeClass('product_paystack');

        }
        else if(gateway_check == 'Cash On Delivery'){
            
            $('#payment_gateway_check').attr('action', $('#product_cash_on_delivery').val());
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required',false);
            $('#payment_gateway_check').removeClass('product_paystack');

        }
        else if(gateway_check == 'Paystack'){

            $('#payment_gateway_check').attr('action', $('#product_paystack').val());
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required',false);
            $('#payment_gateway_check').addClass('product_paystack');

        }

        $('#payment_gateway').val($(this).attr('data-href'));

    });



    $(document).on('change', '.shipping-charge' , function(){
        let cost = parseFloat($(this).attr('data'));
        let total = parseFloat($('.grand_total').attr('data'));
        let grand_total = parseFloat(cost + total);

        $('.grand_total').html(grand_total.toFixed(2));

        $('.shipping_cost').html(cost);

    });


    jQuery(document).ready(function(){

        // message show sweet alert
        const Toast2 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        function success(message) {
            Toast2.fire({
                icon: 'success',
                title: message
            })
        };
        function error(message) {
            Toast2.fire({
                icon: 'error',
                title: message
            })
        };

        $(document).on('click','.subclick', function(){
            let current_qty = parseInt($('.cart-amount').val());

            if(current_qty > 1){
                $('.cart-amount').val(current_qty - 1);
            }else{
                error('Minimun Quantity Must be 1');
            }
        });

        $(document).on('click', '.addclick', function(){
            let stock = $('#current_stock').val();
            let current_qty = parseInt($('.cart-amount').val());

            if(current_qty < stock){
                $('.cart-amount').val(current_qty + 1);
            }else{
                error('Maximun Quntity is  ' +  stock);
            }
        });
         
        $(document).on('keyup', '.cart-amount', function(){
            let stock = $('#current_stock').val();
            let current_qty = parseInt($(this).val());

            if(current_qty > stock){
                error('Maximun Quntity is  ' +  stock);
                $('.cart-amount').val(stock);
            }
            
            if(current_qty <= 0){
                error('Minimun Quantity Must be 1');
                $('.cart-amount').val(1);
            }
            
            if(current_qty > 0 && current_qty < stock){
                $('.cart-amount').val(current_qty);
            }
            
        });

        // add to cart
        $(document).on('click','.add-to-cart', function(event){
            event.preventDefault();
            let Url = $(this).attr('data-href');
            let cartItemCount = $('.cart-amount').val();

            if( typeof cartItemCount === 'undefined'){
                cartItemCount = 1;
            }

            $.get(Url + ',,,' + cartItemCount , function(res){
                if(res.message){
                    success(res.message);
                    $('.cart-amount').val(1);
                }else{
                    error(res.error);
                    $('.cart-amount').val(1);
                }
                
            });

        });

        // Remove form cart
        $(document).on('click', '.item-remove', function(e){
            e.preventDefault();

            let removeItm = $(this).attr('rel');
            let removeItmUrl = $(this).attr('data-href');

            $.get(removeItmUrl , function(res){
                if(res.message){
                    success(res.message);
                    if(res.count == 0){
                        $(".total-item-info").remove();
                        $(".cart-table").remove();
                        $(".cart-middle").remove();
                        $('.remove_before').html(`
                        <div class="container">
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-light py-5 text-center">
                                <h3 class="text-uppercase">Cart is empty!</h3>
                            </div>
                        </div>
                        </div>
                    </div>
                        `
                        );
                    }
                    $('.cart-item-view').text(res.count);
                    $('.cart-total-view').text(res.total);
                    $('.remove' + removeItm).remove();
                }else{
                    error(res.error);
                }
            })
        })


    });

    if (document.body.dataset.notification == undefined) {
        return false;
    } else {

        var data = JSON.parse(document.body.dataset.notificationMessage);
        var msg = data.messege;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        switch (data.alert) {
            case 'info':
                Toast.fire({
                    icon: 'info',
                    title: msg
                })
                break;
            case 'success':
                Toast.fire({
                    icon: 'success',
                    title: msg
                })
                break;
            case 'warning':
                Toast.fire({
                    icon: 'warning',
                    title: msg
                })
                break;
            case 'error':
                Toast.fire({
                    icon: 'error',
                    title: msg
                })
                break;
        }
    };

});


//Things learned
//DOM traversal using previousElementSibling
//element.insertBefore
//reduct method