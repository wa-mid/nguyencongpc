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



Auth::routes();
URL::forceScheme("https");

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('login', 'AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'AdminLoginController@loginAdmin')->name('login.post');
    Route::get('verification', 'AdminLoginController@verification')->name('verification');
    Route::post('verification', 'AdminLoginController@postVerification')->name('postVerification');
    Route::get('logout', 'AdminLoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth:admin', 'admin_verified']], function() {
        Route::get('/', 'DashboardController@getIndex')->name('index');
        Route::group(['prefix'=>'roles'], function() {
            Route::get('/', 'AdminRoleController@index')->name("roles.index");
            Route::any('/create', 'AdminRoleController@create')->name("roles.create");
            Route::any('/edit/{id}', 'AdminRoleController@edit')->name("roles.edit");
            Route::delete('/delete/{id}', 'AdminRoleController@destroy')->name("roles.destroy");
        });
        Route::group(['prefix'=>'users'], function() {
            Route::get('/', 'AdminUserController@index')->name("users.index");
            Route::any('/create', 'AdminUserController@create')->name("users.create");
            Route::any('/edit/{id}', 'AdminUserController@edit')->name("users.edit");
            Route::delete('/delete/{id}', 'AdminUserController@destroy')->name("users.destroy");
        });
        Route::group(['prefix'=>'categories'], function() {
            Route::get('/', 'AdminCategoryController@index')->name("categories.index");
            Route::post('/tree', 'AdminCategoryController@tree')->name("categories.tree");
            Route::any('/create', 'AdminCategoryController@create')->name("categories.create");
            Route::any('/edit/{id}', 'AdminCategoryController@edit')->name("categories.edit");
            Route::get('/delete/{id}', 'AdminCategoryController@destroy')->name("categories.destroy");
        });
        Route::group(['prefix'=>'brands'], function() {
            Route::get('/', 'AdminBrandController@index')->name("brands.index");
            Route::post('/tree', 'AdminBrandController@tree')->name("brands.tree");
            Route::any('/create', 'AdminBrandController@create')->name("brands.create");
            Route::any('/edit/{id}', 'AdminBrandController@edit')->name("brands.edit");
            Route::delete('/delete/{id}', 'AdminBrandController@destroy')->name("brands.destroy");
        });
        Route::group(['prefix'=>'filters'], function() {
            Route::get('/', 'AdminFilterController@index')->name("filters.index");
            Route::post('/tree', 'AdminFilterController@tree')->name("filters.tree");
            Route::any('/create', 'AdminFilterController@create')->name("filters.create");
            Route::any('/edit/{id}', 'AdminFilterController@edit')->name("filters.edit");
            Route::get('/delete/{id}', 'AdminFilterController@destroy')->name("filters.destroy");
        });
        Route::group(['prefix'=>'options'], function() {
            Route::get('/', 'AdminOptionController@index')->name("options.index");
            Route::any('/create', 'AdminOptionController@create')->name("options.create");
            Route::any('/edit/{id}', 'AdminOptionController@edit')->name("options.edit");
            Route::delete('/delete/{id}', 'AdminOptionController@destroy')->name("options.destroy");
        });

        Route::group(['prefix'=>'products'], function() {
            Route::get('/', 'AdminProductController@index')->name("products.index");
			Route::post('/', 'AdminProductController@changeStatus')->name("products.changeStatus");
            Route::post('/upload-images', 'AdminProductController@uploadImages')->name("products.upload");
            Route::any('/create', 'AdminProductController@create')->name("products.create");
            Route::any('/edit/{id}', 'AdminProductController@edit')->name("products.edit");
            Route::delete('/delete/{id}', 'AdminProductController@destroy')->name("products.destroy");
        });
        Route::group(['prefix'=>'postCategory'], function() {
            Route::get('/', 'AdminPostCategoryController@index')->name("postCategory.index");
            Route::any('/create', 'AdminPostCategoryController@create')->name("postCategory.create");
            Route::any('/edit/{id}', 'AdminPostCategoryController@edit')->name("postCategory.edit");
            Route::delete('/delete/{id}', 'AdminPostCategoryController@destroy')->name("postCategory.destroy");
        });
        Route::group(['prefix'=>'posts'], function() {
            Route::get('/', 'AdminPostController@index')->name("posts.index");
            Route::any('/create', 'AdminPostController@create')->name("posts.create");
            Route::any('/edit/{id}', 'AdminPostController@edit')->name("posts.edit");
            Route::delete('/delete/{id}', 'AdminPostController@destroy')->name("posts.destroy");
        });
        Route::group(['prefix'=>'promotions'], function() {
            Route::get('/', 'AdminPromotionController@index')->name("promotions.index");
            Route::any('/create', 'AdminPromotionController@create')->name("promotions.create");
            Route::any('/edit/{id}', 'AdminPromotionController@edit')->name("promotions.edit");
            Route::delete('/delete/{id}', 'AdminPromotionController@destroy')->name("promotions.destroy");
        });
        Route::group(['prefix'=>'slide'], function() {
            Route::get('/', 'AdminSlideController@index')->name("slide.index");
            Route::any('/create', 'AdminSlideController@create')->name("slide.create");
            Route::any('/edit/{id}', 'AdminSlideController@edit')->name("slide.edit");
            Route::delete('/delete/{id}', 'AdminSlideController@destroy')->name("slide.destroy");
        });
        Route::group(['prefix'=>'kiotviet'], function() {
            Route::get('/', 'AdminKiotVietController@index')->name("kiotviet.index");
            Route::get('map', 'AdminKiotVietController@mapIndex')->name("kiotviet.mapIndex");
            Route::any('map/{id}', 'AdminKiotVietController@map')->name("kiotviet.map");
            Route::post('refresh/{id}', 'AdminKiotVietController@refresh')->name("kiotviet.refresh");
        });
        Route::group(['prefix'=>'orders'], function() {
            Route::get('/', 'AdminOrderController@index')->name("orders.index");
            Route::any('/view/{id}', 'AdminOrderController@view')->name("orders.view");
            Route::any('/edit/{id}', 'AdminOrderController@edit')->name("orders.edit");
            Route::delete('/delete/{id}', 'AdminOrderController@destroy')->name("orders.destroy");
        });
        Route::group(['prefix'=>'video'], function() {
            Route::get('/', 'AdminVideoController@index')->name("video.index");
            Route::any('/create', 'AdminVideoController@create')->name("video.create");
            Route::any('/edit/{id}', 'AdminVideoController@edit')->name("video.edit");
            Route::delete('/delete/{id}', 'AdminVideoController@destroy')->name("video.destroy");
        });
		Route::group(['prefix'=>'contacts'], function() {
            Route::get('/', 'AdminContactController@index')->name("contacts.index");
            Route::any('/edit/{id}', 'AdminContactController@edit')->name("contacts.edit");
            Route::delete('/delete/{id}', 'AdminContactController@destroy')->name("contacts.destroy");
        });
		Route::group(['prefix'=>'redirect'], function() {
            Route::get('/', 'AdminRedirectController@index')->name("redirect.index");
            Route::any('/create', 'AdminRedirectController@create')->name("redirect.create");
            Route::any('/edit/{id}', 'AdminRedirectController@edit')->name("redirect.edit");
            Route::delete('/delete/{id}', 'AdminRedirectController@destroy')->name("redirect.destroy");
        });
		Route::group(['prefix'=>'tags'], function() {
            Route::get('/', 'AdminTagController@index')->name("tags.index");
            Route::any('/edit/{id}', 'AdminTagController@edit')->name("tags.edit");
            Route::get('/suggest/{id}', 'AdminTagController@suggest')->name("tags.suggest");
            Route::get('/un-suggest/{id}', 'AdminTagController@unSuggest')->name("tags.unSuggest");
        });
		Route::group(['prefix'=>'kiotviet-invoices'], function() {
            Route::get('/', 'AdminKiotVietOrderController@index')->name("kiotvietinvoices.index");
            Route::any('/edit/{code}', 'AdminKiotVietOrderController@edit')->name("kiotvietinvoices.edit");
            Route::get('/sync', 'AdminKiotVietOrderController@sync')->name("kiotvietinvoices.sync");
            Route::get('/check', 'AdminKiotVietOrderController@check')->name("kiotvietinvoices.check");
        });
    });
});

Route::get('/', 'SiteController@index')->name('home');
Route::get('ajax', 'SiteController@getAjax')->name('ajax');
Route::post('rate', 'SiteController@getRate')->name('rate');
Route::post('filter-ajax', 'SiteController@getFilter')->name('filter');
Route::get('category/{uri}', 'SiteController@getPostCategory')->name('getPostCategory');
Route::get('tag/{uri}', 'SiteController@getTagDetail')->name('getTagDetail');
Route::any('gio-hang', 'SiteController@getOrderPage');
Route::get('/tin-tuc', 'NewsController@index');
Route::get('/tin-tuc/tim-kiem', 'NewsController@search')->name('newsSearch');
Route::get('/tin-tuc/tim-kiem-suggest', 'NewsController@suggestByKeyword')->name('newsSuggest');
Route::get('/tin-tuc/{slug}-{id}.html', 'NewsController@detail')->name('detail');
Route::get('xay-dung-cau-hinh/{profile?}', 'SiteController@buildConfig');
Route::get('export-cau-hinh-excel/{profile?}', 'SiteController@exportConfigExcel');
Route::get('export-cau-hinh-image/{profile?}', 'SiteController@exportConfigImg');
Route::get('in-cau-hinh/{profile?}', 'SiteController@previewBuildConfig');
Route::get('cua-hang', 'SiteController@getCategoryAll');
Route::get('tim-kiem/{term?}', 'SearchController@search')->name('search');
Route::get('search-autocomplete/{term?}', 'SearchController@suggestByKeyword')->name('searchAutocomplete');
Route::any('gio-hang', 'SiteController@shoppingCart');
Route::get('san-pham-da-xem', 'SiteController@getWatchedProducts');
Route::get('san-pham-khuyen-mai', 'SiteController@getPromotionProducts');
Route::post('lien-he', 'SiteController@contact');
Route::get('lien-he', 'SiteController@contact');
Route::get('/chuong-trinh-khuyen-mai', function () {
    return view('site.promotion_sales');
});
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\LoginController@register');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/login/facebook', 'Auth\LoginController@loginFacebook');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::get('/login/google', 'Auth\LoginController@loginGoogle');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::any('thong-tin-ca-nhan', 'Auth\ProfileController@profileUser');
Route::any('doi-mat-khau', 'Auth\ProfileController@changePassword');

Route::get('{rootUri}/{uri}', 'SiteController@getCategorySub')->name('categorySub');
Route::get('{uri}', 'SiteController@getDetailPage')->name('detail_page');


