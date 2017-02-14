<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Route::group(['middleware' => ['web']], function () {
//
// });

//Do no put CartController in Route::group(['middleware' => ['web']], it is set in controller
Route::post('/basket/checkout', ['as' => 'cart.checkout', 'uses' => 'CartController@postCheckout']);
Route::post('/basket/addinsurance', ['as' => 'cart.addinsurance', 'uses' => 'CartController@postAddInsurance']);
Route::controller('basket', 'CartController');
Route::get('/basket', ['as' => 'cart.view', 'uses' => 'CartController@getIndex']);
Route::get('/basket/payment', ['as' => 'cart.payment', 'uses' => 'CartController@getPayment']);


// Social Login
Route::get('auth/facebook',[
    'uses' => '\TypiCMS\Modules\Users\Http\Controllers\AuthController@redirectToProvider',
    'as'   => 'auth.facebook'
]);

Route::get('auth/facebook/callback',[
    'uses' => '\TypiCMS\Modules\Users\Http\Controllers\AuthController@handleProviderCallback',
    'as'   => 'auth.facebook.callback'
]);

// user profile
//Route::get('/profile', 'UserController@getChangeProfile');
//Route::post('/profile', ['as' => 'profile.update', 'uses' => 'UserController@postChangeProfile']);
Route::get('/profile/my-details', ['as' => 'profile.account.get', 'uses' => 'UserController@getAccount']);
Route::post('/profile/my-details', ['as' => 'profile.account.update', 'uses' => 'UserController@postAccount']);
Route::get('/profile/my-orders', ['as' => 'profile.orders.view', 'uses' => 'UserController@getOrdersView']);
Route::get('/profile/my-orders/{order_id}', ['as' => 'profile.order.view', 'uses' => 'UserController@getOrderView']);
Route::post('/profile/claim-create', ['as' => 'profile.order.product.post.claim', 'uses' => 'UserController@postCreateClaim']);
Route::get('/profile/my-policies', 'UserController@getPolicies');


// claims
Route::controller('claims', 'ClaimsController');

// order
Route::controller('order', 'OrdersController');

// order
Route::controller('payments', 'PaymentsController');
Route::get('/payments/checkout', ['as' => 'payments.checkout', 'uses' => 'PaymentsController@getCheckout']);

// products
Route::get('/products', '\App\Http\Controllers\ProductsController@index');

// failz
Route::get('/failz', '\App\Http\Controllers\FailzController@index');
Route::get('/failz/{id}', '\App\Http\Controllers\FailzController@index')->name('failzView');
Route::get('/failz-detail/{failz_id}', '\App\Http\Controllers\FailzController@getFailz');
Route::get('/failz/ajax/{page}', '\App\Http\Controllers\FailzController@getPaginate');
Route::post('/failz/like', '\App\Http\Controllers\FailzController@like');

// clothing
Route::get(ROOT_URL_CLOTHING, '\App\Http\Controllers\ClothesController@index');
Route::get(ROOT_URL_CLOTHING . '/{slug}', '\App\Http\Controllers\ClothesController@category');
Route::get(ROOT_URL_CLOTHING . '/{cat_slug}/{prod_slug}', '\App\Http\Controllers\ClothesController@view');

// insurance
Route::get(ROOT_URL_INSURANCE, ['as' => 'insurance.all', 'uses' => 'InsuranceController@index']);
//Route::get(ROOT_URL_INSURANCE . '/{slug}', '\App\Http\Controllers\InsuranceController@category');
//Route::get(ROOT_URL_INSURANCE . '/{cat_slug}/{prod_slug}', '\App\Http\Controllers\InsuranceController@view');
//Because there are only 1 product in each category, form url /insurance/name-of-insurance
//Route::get(ROOT_URL_INSURANCE . '/{prod_slug}', '\App\Http\Controllers\InsuranceController@view');
Route::get(ROOT_URL_INSURANCE . '/{prod_slug}', '\App\Http\Controllers\InsuranceController@view_new');

Route::get(ROOT_URL_INSURANCE . '/{prod_slug}/about', '\App\Http\Controllers\InsuranceController@about');
Route::get(ROOT_URL_INSURANCE . '/{prod_slug}/benefits', '\App\Http\Controllers\InsuranceController@benefits');
Route::get(ROOT_URL_INSURANCE . '/{category_slug}/get-cover', ['as' => 'insurance.getcover', 'uses' => '\App\Http\Controllers\InsuranceController@getCover']);

Route::post(ROOT_URL_INSURANCE . '/postprecompleteinsurance', ['as' => 'insurance.postprecompleteinsurance', 'uses' => 'InsuranceController@postPrecompleteInsurance']);

Route::get('/insurance-async', '\App\Http\Controllers\InsuranceController@asyncSteps');

// contactz
Route::get('/contactz', 'HomeController@getContactz');

// static pages
//Route::get('/about-us', 'StaticPagesController@getAboutUs');
Route::get('/faqs', 'StaticPagesController@getFaqs');
Route::get('/face-of-zz', 'StaticPagesController@getFaceOfZZ');
Route::get('/music', 'StaticPagesController@getMusic');
//Route::get('/complaintz', 'StaticPagesController@getComplaintz');

Route::get('/home', 'HomeController@getHome');
