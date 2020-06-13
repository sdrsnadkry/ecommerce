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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', 'AdminController@login');

Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();
Route::get('/home','HomeController@index')->name('home');
//indexpage route
Route::get('/','IndexController@index');
//product filter page
Route::match(['get', 'post'], '/products-filter', 'ProductsController@filter');
//category listing page route
Route::get('/products/{url}','ProductsController@products');
//product detail page
Route::get('product/{id}','ProductsController@product');
//get product attributes
Route::get('get-product-price','ProductsController@getProductPrice');
//add to cart route
Route::match(['get','post'],'/add-cart','ProductsController@addToCart');
//cart page
Route::match(['get','post'],'/cart','ProductsController@cart');
//cart-delete
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');
//update cart quantity
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
//users login/register page
Route::get('/login-register','UsersController@userLoginRegister');
//user register form submit
Route::post('/user-register','UsersController@register');
//validate email route
Route::match(['get','post'],'/check-email','UsersController@checkEmail');
//Route for users logout
Route::get('/user-logout','UsersController@logout');
//user login route
Route::post('/user-login','UsersController@login');
//forgot password user
Route::match(['get','post'],'/forgot-password','UsersController@forgotPassword');
//email confirmation route
Route::match(['get','post'],'/confirm/{code}','UsersController@confirmAccount');
//search action
Route::match(['get','post'],'/search-product','ProductsController@searchProducts');
//contact page route
Route::match(['get','post'],'/page/contact','CmsController@contactsPage');
//contact post with vue
Route::match(['get','post'],'/page/post','CmsController@addPost');

//cms pages details route
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');

//google login
    
Route::get('/redirect', 'UsersController@redirectToGoogle');
Route::get('/callback', 'UsersController@handleGoogleCallback');
//online status
Route::get('/admin/get-online-status', 'UsersController@checkOnlineStatus');



//route group for front page login
Route::group(['middleware' => ['frontlogin']], function () {
    //for user account details
    Route::match(['get','post'],'/account','UsersController@account');
    //check user pwd ajax
    Route::post('/check-user-pwd','UsersController@chkUserPassword');
    //update-user-password
    Route::post('/update-user-pwd','UsersController@updatePassword');
    //chechkout page
    Route::match(['get','post'],'/checkout','ProductsController@checkout');
    ///order review page route
    Route::match(['get','post'],'/order-review','ProductsController@orderReview');
    //place order url
    Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
    //thankyou page
    Route::get('/thanks','ProductsController@thanks');
    //to view your ordered products
    Route::get('/orders','ProductsController@userOrders');
    //order details page
    Route::get('/orders/{id}','ProductsController@userOrderDetails');
    

    
});
//admin page routes
Route::group(['middleware' => ['adminlogin']], function () {
    /*************************admin panel route******************************* */
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings','AdminController@settings');
    Route::match(['get','post'],'/admin/checkpass','AdminController@checkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
    /***********************category route*************************************************** */
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');
    /****************************product route******************************************* */
    Route::match(['get', 'post'], '/admin/add-product','ProductsController@addProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    // Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage'); deleted because new script was added
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');

    /****************************************product attributes route***************************** */
    Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttributes');
    Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
    /***********************************add images page routes************************************* */
    Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImages');
    /******************************Banners Routes****************************************** */
    Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
    Route::get('/admin/view-banners','BannersController@viewBanners');
    Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
    Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');
    /******************************Orders Routes****************************************** */
    Route::match(['get','post'],'/admin/view-orders','ProductsController@viewOrders');
    Route::match(['get','post'],'/admin/view-order/{id}','ProductsController@viewOrderDetails');
    Route::match(['get','post'],'/admin/update-order-status','ProductsController@updateOrderStatus');
    Route::match(['get','post'],'/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');
    Route::match(['get','post'],'/admin/view-pdf-invoice/{id}','ProductsController@viewPDFInvoice');
    Route::get('/admin/delete-order/{id}','ProductsController@deleteOrder');

    /*****************************user routes******************************************************* */
    Route::match(['get','post'],'/admin/view-users','UsersController@viewUsers');
    Route::get('/admin/delete-user/{id}','UsersController@deleteUser');

    /*****************************CMS Page routes******************************************************* */
    Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');
    Route::match(['get','post'],'/admin/view-cms-pages','CmsController@viewCmsPages');
    Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');
    Route::get('/admin/delete-page/{id}','CmsController@deleteCmsPage');
    /******************************brands banner***********************************************/
    Route::match(['get','post'],'/admin/add-brand','BrandsController@addBrand');
    Route::get('/admin/view-brands','BrandsController@viewBrands');
    Route::match(['get','post'],'/admin/edit-brand/{id}','BrandsController@editBrand');
    Route::get('/admin/delete-brand/{id}','BrandsController@deleteBrand');
    /******************************enquiry route***********************************************/
    Route::get('/admin/view-inquiry','CmsController@viewInquiry');
    Route::get('/admin/get-inquiry-vue','CmsController@getInquiryVue');
    Route::get('/admin/view-inquiry-vue','CmsController@viewInquiryVue');
    Route::get('/admin/delete-inquiry/{id}','CmsController@deleteInquiry');
    /******************************Admin route***********************************************/
    Route::match(['get','post'],'/admin/view-admins','AdminController@viewAdmins');
    Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmins');
    Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmins');
    Route::get('/admin/delete-admin/{id}','AdminController@deleteAdmin');







});

Route::get('/logout', 'AdminController@logout');



