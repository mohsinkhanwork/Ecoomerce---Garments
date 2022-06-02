<?php

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



/*
|--------------------------------------------------------------------------
|                           Urban Store Front-End
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['comingsoon.check']], function () {
    Route::get('/coming-soon', function () {
        return view('frontend.coming-soon');
    });
});
    // Guest/Customer Routes
    Route::group(['middleware' => ['admin.check', 'comingsoon.check']], function () {

        // Home Page
        Route::get('/', 'IndexController@index')->name('index');

        // Category Page
        Route::get('/collection', 'IndexController@category')->name('collection');

        // Category Page
        //Route::get('/category-gallery-images/{pid}', 'IndexController@getCategoryGalleryImages');

        // ColorWise Category Page
        Route::get('/colorwise-category-gallery-images/{cid}', 'IndexController@getColorWiseCategoryGalleryImages');

        // About Page
        Route::get('/about', 'IndexController@about')->name('about');

        // Faqs Page
        Route::get('/faqs', 'IndexController@faqs')->name('faqs');

        // Contact Page
        Route::get('/contact', 'IndexController@contact')->name('contact');

        // Privacy Policy Page
        Route::get("privacy-policy",'IndexController@privacy');
        //Terms and Condition Page
        Route::get("terms-and-condition",'IndexController@terms');
        // Description Page
        Route::get('/product/{pid}/{color?}', 'IndexController@viewDescription')->name('product.detail');

        // Description GET Color Dropdown
        Route::get('/description/get/color/{aid}', 'IndexController@getDescriptionColorDropdown');

        // Description GET Attributes Dropdown
        Route::get('/description/get/attributes/{ids}', 'IndexController@getDescriptionAttributeDropdown');

        // Description GET Quantity Dropdown
        Route::get('/description/get/quantity/{cid}', 'IndexController@getDescriptionQuantityDropdown');

        // Description GET Quantity Price
        Route::get('/description/get/quantity/price/{aid}', 'IndexController@getDescriptionQuantityPrice');

        // Add To Cart
        Route::match(['get', 'post'], '/add-cart', 'ProductController@addToCart');

        // Cart Page
        Route::match(['get', 'post'], '/cart', 'ProductController@cart')->name('cart');

        // Cart Delete Item
        Route::get('/cart/delete/{cartid}', 'ProductController@deleteCart');

        // Cart Update Item
        Route::post('/cart/update/{cartid}', 'ProductController@updateQuantity')->name('update.cart');

        // Checkout Page
        Route::get('/cart/checkout', 'CheckoutController@viewCheckout')->name('checkout.old');
        Route::get('/cart/checkout-new', 'CheckoutController@viewCheckoutNew')->name('checkout');
        Route::post('/cart/pay', 'CheckoutController@payCheckoutNew')->name('pay.checkout.new');
        Route::match(['get', 'post'], '/checkout/paypal/{order_id}', 'CheckoutController@checkoutPaypal')->name('checkout.paypal');
        Route::get('/payment/success', 'CheckoutController@getExpressCheckoutSuccess')->name('checkout.success.paypal');

        // Checkout Payment
        Route::match(['get', 'post'], '/cart/checkout/pay', 'CheckoutController@payCheckout')->name('pay');
        Route::post('/cart/checkout/paypal/saveorder', 'CheckoutController@paypalSaveOrder');
        Route::get('/cart/checkout/paypal/status/{status}/{order_id}', 'CheckoutController@paypalUpdateOrderStatus');

        //Ajax Requests
        Route::get('/cart/checkout/get_shipping_rates', 'CheckoutController@getShippingRatesFromShippo');
        Route::post('/cart/checkout/get_shipping_rates_new', 'CheckoutController@getShippingRatesFromShippoNew');
        Route::post('/cart/checkout/add_shipping_rates', 'CheckoutController@addShippingRatesToCart');
        Route::get('/cart/checkout/get_salestax_rate', 'CheckoutController@getSalesTaxRates');
        Route::get('/cart/checkout/get_states', 'CheckoutController@getStatesByCountryCode');
        Route::post('promo_code', 'CheckoutController@promoCode')->name('cart.promo_code');
        Route::post('promo_code_remove', 'CheckoutController@promoCodeRemove')->name('cart.promo_code_remove');

        /* Route::get( '/cart/checkout/paypal/cancel', 'CheckoutController@paypalCancel');
        Route::get( '/cart/checkout/paypal/success', 'CheckoutController@paypalSuccess');
        Route::get( '/cart/checkout/paypal/notify', 'CheckoutController@paypalNotify'); */

        // Contact Form
        Route::post('/contact', 'ContactController@contactUs');


        Route::get("/thankyou", function () {
            return View::make("frontend.pages.thankyou");
        });

        Route::post('/subscribe', 'SubscriberController@saveSubscriber')->name('user.subscribe');
    });

/*
|--------------------------------------------------------------------------
|                           Urban Admin Panel
|--------------------------------------------------------------------------
*/

    // Auth Scaffolding
    Auth::routes();

    // Admin Login
    Route::match(['get','post'], '/admin', 'AdminController@login');

    // Guest / Customer Login
    Route::match(['get','post'], '/guest', 'AdminController@guest');

    // Dashboard Admin Routes
    Route::group(['middleware' => ['admin']], function () {

        // Dashboard Route
        Route::get('/dashboard', 'AdminController@dashboard');

        /****************************** ./PromoCode Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Collection Routes
        |--------------------------------------------------------------------------
        */
        // Collection Add
        Route::match(['get','post'], '/dashboard/add-promocode', 'PromoCodeController@addPromoCode')->name('add.promo.admin');

        // Collection View
        Route::get('/dashboard/manage-promocode', 'PromoCodeController@viewPromoCode')->name('manage.promo.admin');

        // Collection Delete
        Route::get('/dashboard/delete-promocode/{id}', 'PromoCodeController@deletePromoCode')->name('delete.promo.admin');
        Route::post('/dashboard/delete-multi-promocode', 'PromoCodeController@deleteMultiplePromoCode')->name('multi.delete.promo.admin');

        // Collection Edit
        Route::match(['get','post'], '/dashboard/edit-promocode/{id}', 'PromoCodeController@editPromoCode')->name('edit.promo.admin');



        /*
        |--------------------------------------------------------------------------
        |                               Category Routes
        |--------------------------------------------------------------------------
        */
        // Category Add
        Route::match(['get','post'], '/dashboard/add-category', 'CategoryController@addCategory');

        // Category View
        Route::get('/dashboard/manage-category', 'CategoryController@viewCategory');

        //Update filter category id AJAX
        Route::post('/dashboard/manage-category/update-filter-category', 'CategoryController@updateFilterCategory');

        // Category Delete
        Route::get('/dashboard/delete-category/{id}', 'CategoryController@deleteCategory');
        Route::post('/dashboard/delete-multi-category', 'CategoryController@deleteMultipleCategory');

        // Category Edit
        Route::match(['get','post'], '/dashboard/edit-category/{id}', 'CategoryController@editCategory');

        /****************************** ./Category Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Collection Routes
        |--------------------------------------------------------------------------
        */
        // Collection Add
        Route::match(['get','post'], '/dashboard/add-collection', 'CollectionController@addCollection');

        // Collection View
        Route::get('/dashboard/manage-collection', 'CollectionController@viewCollection');

        // Collection Delete
        Route::get('/dashboard/delete-collection/{id}', 'CollectionController@deleteCollection');
        Route::post('/dashboard/delete-multi-collection', 'CollectionController@deleteMultipleCollection');

        // Collection Edit
        Route::match(['get','post'], '/dashboard/edit-collection/{id}', 'CollectionController@editCollection');

        /****************************** ./Collection Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Product / Attribute Routes
        |--------------------------------------------------------------------------
        */
        // Product Add
        Route::match(['get','post'], '/dashboard/add-product', 'ProductController@addProduct')->name('admin.product.add');

        // Product View
        Route::get('/dashboard/manage-product', 'ProductController@viewProduct');

        // Product Edit
        Route::match(['get','post'], '/dashboard/edit-product/{id}', 'ProductController@editProduct')->name('admin.product.edit');

        // Product Delete
        Route::post('/dashboard/delete-product', 'ProductController@deleteProduct');
        Route::post('/dashboard/delete-multi-product', 'ProductController@deleteMultiProduct');

        // Product Image Delete
        //Route::get('/dashboard/delete-product-image/{id}', 'ProductController@deleteProductImage');

        // Product Images Add
        Route::match(['get','post'], '/dashboard/add-image/{id}', 'ProductController@addImage');

        // Product Attributes Add
        Route::match(['get','post'], '/dashboard/add-attribute/{id}', 'ProductController@addAttribute');

        // Product Attributes Delete
        Route::post('/dashboard/update-attribute/{aid}', 'ProductController@updateAttribute')->name('update.product.attribute');
        Route::get('/dashboard/delete-attribute/{pid}/{aid}', 'ProductController@deleteAttribute');

        // Product Attribute Colors Stock Add
        Route::match(['get','post'], '/dashboard/add-attribute-color-stock/{id}', 'ProductController@addAttributeColor');

        // Product Attributes Colors Delete
        Route::get('/dashboard/delete-attribute-color/{aid}/{cid}', 'ProductController@deleteAttributeColor');

        // Product Attributes Colors Update Stock
        Route::post('/dashboard/update-attribute-color-stock', 'ProductController@updateAttributeColorStock');
        Route::post('/dashboard/update-attribute-max-cart-qty', 'ProductController@updateMaxCartQty');

        /****************************** ./Product Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Customer Routes
        |--------------------------------------------------------------------------
        */

        // Customer View
        Route::get('/dashboard/manage-customer', 'CustomerController@viewCustomer');

        // Customer Delete
        Route::get('/dashboard/delete-customer/{cid}', 'CustomerController@deleteCustomer');
        Route::post('/dashboard/delete-multi-customer', 'CustomerController@deleteMultiCustomer');

        // Customer Detail
        Route::get('/dashboard/detail-customer/{cid}', 'CustomerController@detailCustomer');

        // Customer Edit
        /*Route::match(['get','post'],'/dashboard/edit-customer/{id}', 'CustomerController@editCustomer');*/

        /****************************** ./Customer Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Subscriber Routes
        |--------------------------------------------------------------------------
        */

        // subscriber View
        Route::get('/dashboard/manage-subscriber', 'SubscriberController@viewSubscriber');

        // subscriber Delete
        Route::get('/dashboard/delete-subscriber/{cid}', 'SubscriberController@deleteSubscriber');
        Route::post('/dashboard/delete-multi-subscriber', 'SubscriberController@deleteMultipleSubscriber');

        /****************************** ./Subscriber Routes ************************************/

        /*
        |--------------------------------------------------------------------------
        |                               Order Routes
        |--------------------------------------------------------------------------
        */

        // Order View
        Route::get('/dashboard/manage-order', 'OrderController@viewOrder');
        Route::get('/dashboard/manage-archived-order', 'OrderController@viewArchivedOrder');

        // Order Delete
        Route::get('/dashboard/delete-order/{oid}', 'OrderController@deleteOrder');

        // Order Detail
        Route::get('/dashboard/detail-order/{oid}', 'OrderController@detailOrder');

        // Order Edit
        Route::match(['get','post'], '/dashboard/edit-order/{oid}', 'OrderController@editOrder');
        Route::post('/dashboard/edit-multple-orders', 'OrderController@editMultipleOrders');

        // Order Status
        Route::get('/dashboard/order-status/{oid}/{sid}/{cid}', 'OrderController@statusOrder');

        //Orders Export
        Route::get('/dashboard/manage-order/export/{archived}', 'OrderController@exportMultipeOrders');
        Route::get('/dashboard/manage-order/shipposync', 'OrderController@syncOrdersWithShippo');

        /****************************** ./Order Routes ************************************/

        // Homepage Images
        Route::get('/image/delete-homepage-image/{pid}/{hid}', 'ImageUploadController@deleteHomepageImage');
        Route::post('image/replace-homepage-image', 'ImageUploadController@fileReplaceHomepageImage');
        Route::post('image/update-homepage-image/{hid}', 'ImageUploadController@updateHomepageImage')->name('update.product.homepage.image');
        Route::post('image/add-homepage-image/{pid}', 'ImageUploadController@addHomepageImage')->name('add.product.homepage.image');

        // Description Slider Images
        Route::post('image/upload/description-slider-image', 'ImageUploadController@fileStoreDescriptionSliderImage');
        Route::post('image/delete/description-slider-image', 'ImageUploadController@fileDestroyDescriptionSliderImage');
        Route::get('/image/delete-description-image/{pid}/{did}', 'ImageUploadController@deleteDescriptionImage');
        Route::post('/image/delete-multi-description-images', 'ImageUploadController@deleteMultipleDescriptionImage');
        Route::post('/image/update-description-images/{id}', 'ImageUploadController@updateDescriptionImage')->name('update.description.image');

        // Category Slider Images
        Route::post('image/upload/category-slider-image', 'ImageUploadController@fileStoreCategorySliderImage');
        Route::post('image/delete/category-slider-image', 'ImageUploadController@fileDestroyCategorySliderImage');
        Route::get('/image/delete-category-image/{pid}/{cid}', 'ImageUploadController@deleteCategoryImage');
        Route::post('/image/delete-multi-category-images', 'ImageUploadController@deleteMultipleCategoryImage');
        Route::post('/image/update-category-images/{id}', 'ImageUploadController@updateCategoryImage')->name('update.category.image');

        // ColorWise Category Slider Images
        Route::post('image/upload/colorwise-category-slider-image', 'ImageUploadController@fileStoreColorwiseCategorySliderImage');
        Route::post('image/delete/colorwise-category-slider-image', 'ImageUploadController@fileDestroyColorwiseCategorySliderImage');
        Route::get('/image/colorwise-delete-category-image/{pid}/{cid}', 'ImageUploadController@deleteColorwiseCategoryImage');
        Route::post('/image/colorwise-delete-multi-category-images', 'ImageUploadController@deleteMultipleColorwiseCategoryImage');
        Route::post('/image/update-colorwise-category-images/{id}', 'ImageUploadController@updateColorwiseCategoryImage')->name('update.color.category.image');

        //Settings
        Route::group(['prefix' => '/dashboard/settings'], function () {
            Route::get('/', 'SettingsController@index');

            //General Settings
            Route::match(['get', 'post'], '/general', 'GeneralSettingsController@index');

            //Tax Rates
            Route::get('/taxrates', 'TaxRateController@index');
            Route::get('/taxrates/create', 'TaxRateController@create');
            Route::post('/taxrates/store', 'TaxRateController@store');
            Route::get('/taxrates/edit/{id}', 'TaxRateController@edit');
            Route::post('/taxrates/update/{id}', 'TaxRateController@update');
            Route::get('/taxrates/delete/{id}', 'TaxRateController@delete');
            Route::post('/taxrates/delete-multi-taxrate', 'TaxRateController@deleteMultipleTaxRates');

            //Sliders
            Route::get('/sliders', 'CollectionSliderController@index');
            Route::get('/sliders/{collection_id}', 'CollectionSliderController@view');
            Route::post('/sliders/{collection_id}', 'CollectionSliderController@save');

            //Ajax Requests
            Route::get('/taxrates/get_states', 'TaxRateController@getStates');
            Route::get('/phone', 'GeneralSettingsController@phone');
            Route::post('/save-phone', 'GeneralSettingsController@savePhone');
            Route::resource('pages','CmsPagesController');
        });
    });


Route::group(['prefix' => config('blogetc.blog_prefix', 'fashion-blog')], function () {
    Route::get('videos/all', 'BlogReaderController@videos')->name('front.videos.all');
});
/*
|--------------------------------------------------------------------------
|                           Urban Blog Admin Panel
|--------------------------------------------------------------------------
*/

// Blog Admin Login
Route::group(['prefix' => config('blogetc.admin_prefix', 'blog_admin')], function () {
    Route::get('/login', function () {
        return View::make("blogetc_admin::login");
    });
    Route::post('/login', 'BlogAdminController@login')->name('blog.admin.login');
    Route::resource('videos', 'YoutubeVideoController');
});

Route::get('/minify/render/{file}', 'MinifierController@minify');
Route::get('/minify/save', 'MinifierController@minifySave');
