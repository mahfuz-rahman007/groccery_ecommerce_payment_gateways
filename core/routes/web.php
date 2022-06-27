<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'setlang'], function () {
    Route::get('/', 'Front\FrontController@index')->name('front.index');
    Route::get('/changelang/{lang}', 'Front\FrontController@changeLang')->name('changeLang');

    Route::get('/product/{slug}', 'Front\ProductController@product_details')->name('front.product-details');


    Route::get('/add-to-cart/{id}', 'Front\ProductController@addToCart')->name('add.cart');
    Route::get('/cart', 'Front\ProductController@cart')->name('front.cart');
    Route::post('/cart/update', 'Front\ProductController@updatecart')->name('cart.update');
    Route::get('/cart/item/remove/{id}', 'Front\ProductController@removecart')->name('cart.item.remove');

    Route::get('/checkout', 'Front\ProductController@checkout')->name('front.checkout');

    // paypal
    Route::post('/product/paypal/submit', 'Payment\Product\PaypalController@store')->name('product.paypal.submit');
    Route::get('/product/order/paypal/cancel', 'Payment\Product\PaypalController@paycancel')->name('product.payment.cancel');
    Route::get('/product/paypal/return', 'Payment\Product\PaypalController@payreturn')->name('product.payment.return');
    Route::get('/product/paypal/notify', 'Payment\Product\PaypalController@notify')->name('product.payment.notify');
    // stripe
    Route::post('/product/stripe/submit', 'Payment\Product\StripeController@store')->name('product.stripe.submit');
    // paytm
    Route::post('/paytm/submit', 'Payment\Product\PaytmController@store')->name('product.paytm.submit');
    // cash-on-delivary
    Route::post('/cash_on_delivery/submit', 'Payment\Product\CashOnDeliveryController@store')->name('product.cash_on_delivery.submit');
    // Paystack
    Route::post('/paystack/submit', 'Payment\Product\PaystackController@store')->name('product.paystack.submit');

    // user routes
    Route::group(['prefix' => 'user'], function () {

        Route::get('/login', 'User\LoginController@login')->name('user.login');
        Route::post('/login/submit', 'User\LoginController@loginSubmit')->name('user.login.submit');
        Route::get('/logout', 'User\LoginController@logout')->name('user.logout');

        Route::get('/register', 'User\RegisterController@register')->name('user.register');
        Route::post('/register/submit', 'User\RegisterController@registerSubmit')->name('user.register.submit');
        Route::get('/register/verify/{token}', 'User\RegisterController@token')->name('user.register.token');

        Route::get('/dashboard', 'User\UserController@index')->name('user.dashboard');
        Route::get('/edit-profile', 'User\UserController@editprofile')->name('user.editprofile');
        Route::post('/update-profile/{id}', 'User\UserController@updateprofile')->name('user.updateprofile');
        Route::get('/change-password', 'User\UserController@change_password')->name('user.change_password');
        Route::post('/update-password/{id}', 'User\UserController@update_password')->name('user.update_password');

        // Route::get('/bill-pay', 'User\UserController@bill_pay')->name('user.billpay');
        // Route::get('/bill-pay/view/{id}/', 'User\UserController@billpay_view')->name('user.billpay_view');

        // Route::get('/product-orders', 'User\UserController@product_order')->name('user.product.order');
        // Route::get('/product-order/{id}', 'User\UserController@product_order_details')->name('user.product.orderDetails');

    });
});


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {

    Route::get('/', 'Admin\LoginController@login')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@authenticate')->name('admin.auth');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

    Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    // Admin Profile Routes
    Route::get('/profile/edit', 'Admin\ProfileController@edit_profile')->name('admin.edit_profile');
    Route::post('/profile/update', 'Admin\ProfileController@update_profile')->name('admin.update_profile');
    Route::get('/profile/password/edit', 'Admin\ProfileController@edit_password')->name('admin.edit_password');
    Route::post('/profile/password/update', 'Admin\ProfileController@update_password')->name('admin.update_password');

    // Setting Routes
    // Basic Information
    Route::get('/basicinfo', 'Admin\SettingController@basicinfo')->name('admin.setting.basicinfo');
    Route::post('/basicinfo/update/{id}', 'Admin\SettingController@updatebasicinfo')->name('admin.setting.updatebasicinfo');
    Route::post('/commoninfo/update', 'Admin\SettingController@updatecommoninfo')->name('admin.setting.updatecommoninfo');

    // Emal Configuration
    Route::get('/email-config', 'Admin\EmailController@config')->name('admin.mail.config');
    Route::post('/email-config/submit', 'Admin\EmailController@configUpdate')->name('admin.mail.config.update');

    // Seo Info Routes
    Route::get('/seoinfo', 'Admin\SettingController@seoinfo')->name('admin.seoinfo');
    Route::post('/seoinfo/update/{id}', 'Admin\SettingController@seoinfoUpdate')->name('admin.seoinfoUpdate');

    // About Routes
    Route::get('/about', 'Admin\AboutController@about')->name('admin.about');
    Route::post('/about/content/update/{id}', 'Admin\AboutController@aboutContentUpdate')->name('admin.aboutContent.update');

    // Currency  Route
    Route::get('/currency', 'Admin\CurrencyController@currency')->name('admin.currency');
    Route::get('/currency/add', 'Admin\CurrencyController@add')->name('admin.currency.add');
    Route::post('/currency/store', 'Admin\CurrencyController@store')->name('admin.currency.store');
    Route::post('/currency/delete/{id}/', 'Admin\CurrencyController@delete')->name('admin.currency.delete');
    Route::get('/currency/edit/{id}/', 'Admin\CurrencyController@edit')->name('admin.currency.edit');
    Route::post('/currency/update/{id}/', 'Admin\CurrencyController@update')->name('admin.currency.update');
    Route::get('/currency/status/set/{id}', 'Admin\CurrencyController@status')->name('admin.currency.status');

    // Payment Settings Route
    Route::get('/payment/gateways', 'Admin\PaymentGatewayController@index')->name('admin.payment.index');
    Route::get('/payment/gateways/edit/{id}', 'Admin\PaymentGatewayController@edit')->name('admin.payment.edit');
    Route::post('/payment/gateways/update/{id}', 'Admin\PaymentGatewayController@update')->name('admin.payment.update');
    Route::get('/payment/gateways/{delete}', 'Admin\PaymentGatewayController@delete')->name('admin.payment.delete');

    // Shipping Method  Route
    Route::get('/shipping/methods/', 'Admin\ShippingMethodController@shipping')->name('admin.shipping.index');
    Route::get('/shipping/method/add', 'Admin\ShippingMethodController@add')->name('admin.shipping.add');
    Route::post('/shipping/method/store', 'Admin\ShippingMethodController@store')->name('admin.shipping.store');
    Route::post('/shipping/method/delete/{id}/', 'Admin\ShippingMethodController@delete')->name('admin.shipping.delete');
    Route::get('/shipping/method/edit/{id}/', 'Admin\ShippingMethodController@edit')->name('admin.shipping.edit');
    Route::post('/shipping/method/update/{id}/', 'Admin\ShippingMethodController@update')->name('admin.shipping.update');
    Route::get('/shipping/method/status/set/{id}', 'Admin\ShippingMethodController@status')->name('admin.shipping.status');

    // Product category  Route
    Route::get('/product-category', 'Admin\PcategoryController@pcategory')->name('admin.pcategory');
    Route::get('/product-category/add', 'Admin\PcategoryController@add')->name('admin.pcategory.add');
    Route::post('/product-category/store', 'Admin\PcategoryController@store')->name('admin.pcategory.store');
    Route::post('/product-category/delete/{id}/', 'Admin\PcategoryController@delete')->name('admin.pcategory.delete');
    Route::get('/product-category/edit/{id}/', 'Admin\PcategoryController@edit')->name('admin.pcategory.edit');
    Route::post('/product-category/update/{id}/', 'Admin\PcategoryController@update')->name('admin.pcategory.update');

    // Product  Route
    Route::get('/product', 'Admin\ProductController@products')->name('admin.product');
    Route::get('/product/add', 'Admin\ProductController@add')->name('admin.product.add');
    Route::post('/product/store', 'Admin\ProductController@store')->name('admin.product.store');
    Route::post('/product/delete/{id}/', 'Admin\ProductController@delete')->name('admin.product.delete');
    Route::get('/product/edit/{id}/', 'Admin\ProductController@edit')->name('admin.product.edit');
    Route::post('/product/update/{id}/', 'Admin\ProductController@update')->name('admin.product.update');


    // Product Order Routes
    Route::get('/product/all/orders', 'Admin\ProductOrderController@all')->name('admin.all.product.orders');
    Route::get('/product/pending/orders', 'Admin\ProductOrderController@pending')->name('admin.pending.product.orders');
    Route::get('/product/processing/orders', 'Admin\ProductOrderController@processing')->name('admin.processing.product.orders');
    Route::get('/product/completed/orders', 'Admin\ProductOrderController@completed')->name('admin.completed.product.orders');
    Route::get('/product/rejected/orders', 'Admin\ProductOrderController@rejected')->name('admin.rejected.product.orders');
    
    Route::post('/product/orders/status', 'Admin\ProductOrderController@status')->name('admin.product.orders.status');
    Route::post('/product/orders/payment/status', 'Admin\ProductOrderController@payment_status')->name('admin.product.payment.status');
    Route::get('/product/orders/detais/{id}', 'Admin\ProductOrderController@details')->name('admin.product.details');
    Route::post('/product/order/delete', 'Admin\ProductOrderController@orderDelete')->name('admin.product.order.delete');



    // Slider Routes
    Route::get('/slider', 'Admin\SliderController@slider')->name('admin.slider');
    Route::get('/slider/add', 'Admin\SliderController@sliderAdd')->name('admin.sliderAdd');
    Route::post('/slider/store', 'Admin\SliderController@sliderStore')->name('admin.sliderStore');
    Route::get('/slider/edit/{id}', 'Admin\SliderController@sliderEdit')->name('admin.sliderEdit');
    Route::post('/slider/update/{id}', 'Admin\SliderController@sliderUpdate')->name('admin.sliderUpdate');
    Route::post('/slider/delete/{id}', 'Admin\SliderController@sliderDelete')->name('admin.sliderDelete');

    // Admin Language Routes
    Route::get('/languages', 'Admin\LanguageController@index')->name('admin.language.index');
    Route::get('/language/add', 'Admin\LanguageController@add')->name('admin.language.add');
    Route::post('/language/store', 'Admin\LanguageController@store')->name('admin.language.store');
    Route::get('/language/edit/{id}', 'Admin\LanguageController@edit')->name('admin.language.edit');
    Route::post('/language/update/{id}', 'Admin\LanguageController@update')->name('admin.language.update');
    Route::get('/language/edit/keyword/{id}', 'Admin\LanguageController@editKeyword')->name('admin.language.editKeyword');
    Route::post('/language/update/keyword/{id}', 'Admin\LanguageController@updateKeyword')->name('admin.language.updateKeyword');
    Route::post('/language/default/{id}', 'Admin\LanguageController@default')->name('admin.language.default');
    Route::post('/language/delete/{id}', 'Admin\LanguageController@delete')->name('admin.language.delete');

    // Admin Footer Logo Text Routes
    Route::get('/footer', 'Admin\FooterController@index')->name('admin.footer.index');
    Route::post('/footer/update/{id}', 'Admin\FooterController@update')->name('admin.footer.update');
});
