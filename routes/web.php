<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ListBlogController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\QuanlycauthuCotroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/bai8', function () {
    return view('bai8');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/account', function () {
    return view('account');
});
Route::get('/my-product', function () {
    return view('my-product');
});
Route::get("/login_1", [DemoController::class, "create"]);
Route::post("/login_1", [DemoController::class, "store"]);




//Quan ly cau thu dùng DB
//list
Route::get("/list", [QuanlycauthuCotroller::class, "index"]);
//add

//edit
Route::get("/edit/{id}", [QuanlycauthuCotroller::class, "edit"]);
Route::post("/edit/{id}", [QuanlycauthuCotroller::class, "update"]);
//delete
Route::get("/delete/{id}", [QuanlycauthuCotroller::class, "destroy"]);

// Quản lí cầu thủ dùng Models
Route::get("/lists", [QuanlycauthuCotroller::class, "index"]);

Route::get("/adds", [QuanlycauthuCotroller::class, "create"]);
Route::post("/adds", [QuanlycauthuCotroller::class, "store"]);

Route::get("/edits/{id}", [QuanlycauthuCotroller::class, "edit"]);
Route::post("/edits/{id}", [QuanlycauthuCotroller::class, "update"]);

Route::get("/deletes/{id}", [QuanlycauthuCotroller::class, "destroy"]);

// =============== PHẦN FRONTEND ===============//
Route::group([
    'middleware' => ['memberIsLogin']
], function () {
    //Trang Đăng ký 
    Route::get("/signup", [MemberController::class, "index"]);
    Route::post("/signup", [MemberController::class, "register"]);
    //Trang Đăng nhập 
    Route::get("/login_member", [MemberController::class, "create"]);
    Route::post("/login_member", [MemberController::class, "login"]);
});

//Trang List-Blog
Route::get('/list-blog', [ListBlogController::class, 'index']);
//Trang Blog-detail
Route::get('/blog-detail/{id}', [ListBlogController::class, "show"]);
//trang index
Route::get("/product/index", [ProductController::class, "show"]);
//trang product-detail
Route::get("/product-detail/{id}", [ProductController::class, "detail"]);
// search advance
Route::get('/search-advanced', [SearchController::class, 'searchAdvanced'])->name('search.advanced');
Route::post('/search-advanced', [SearchController::class, 'searchPost']);

// trang checkout
Route::get("/cart/checkout", [CartController::class, "order"])->name('cart');
// search price
Route::post("/search-price", [SearchController::class, "fillByPrice"])->name("search-price");
Route::group(
    [
        'middleware' => ['member']
    ],
    function () {

        //rate
        Route::post('/blog/rate/ajax', [ListBlogController::class, "ajaxRate"]);
        //cmtCha
        Route::post('/blog/cmt/ajax', [ListBlogController::class, 'ajaxComment']);
        // logout
        Route::post("/logout_member", [MemberController::class, "logout"]);
        //update memberAccount
        Route::get("/account/update-profile", [MemberController::class, "edit"])->name('cart');
        Route::post("/account/update-profile", [MemberController::class, "update"]);
        //trang cart
        Route::post("/product/addToCart/ajax", [ProductController::class, "ajaxAddToCart"]);
        Route::get("/cart/list", [CartController::class, "index"])->name('cart');
        //up
        Route::post("/cart/upQtyCart/ajax", [CartController::class, "ajaxUpQtyCart"]);
        //down
        Route::post("/cart/downQtyCart/ajax", [CartController::class, "ajaxDownQtyCart"]);
        //delete
        Route::post("/cart/deleteQtyCart/ajax", [CartController::class, "ajaxDeleteQtyCart"]);
        //trang mail
        Route::post("/send-mail", [MailController::class, "sendEmail"])->name('send.email');
        // search name
        Route::get("/search", [SearchController::class, "store"])->name("search");


    }
);


Auth::routes();



// =============== PHẦN ADMIN ===============//
Route::group([
    'middleware' => ['admin']
], function () {
    //trang Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    //trang paages-profile
    Route::get('/pages-profile', [UserController::class, "edit"]);
    Route::post('/pages-profile', [UserController::class, "update"]);
    // trang coutry
    //list
    Route::get('/list_ct', [CountryController::class, "index"]);
    //ADD
    Route::get('/add_ct', [CountryController::class, "create"]);
    Route::post('/add_ct', [CountryController::class, "store"]);
    //DELETE
    Route::get('/delete/{id}', [CountryController::class, "destroy"]);

    //trang blog
    //list
    Route::get('/list_bl', [BlogController::class, "index"]);
    //ADD
    Route::get('/add_bl', [BlogController::class, "create"]);
    Route::post('/add_bl', [BlogController::class, "store"]);
    //UPDATE
    Route::get("/edit_bl/{id}", [BlogController::class, "edit"]);
    Route::post("/edit_bl/{id}", [BlogController::class, "update"]);
    //DELETE
    Route::get('/delete_bl/{id}', [BlogController::class, "destroy"]);

    //trang catergory
    //list
    Route::get('/list_cate', [CategoryController::class, "index"]);
    //ADD
    Route::get('/add_cate', [CategoryController::class, "create"]);
    Route::post('/add_cate', [CategoryController::class, "store"]);
    //DELETE
    Route::get('/delete_cate/{id}', [CategoryController::class, "destroy"]);

    //trang brand
    //list
    Route::get('/list_brand', [BrandController::class, "index"]);
    //ADD
    Route::get('/add_brand', [BrandController::class, "create"]);
    Route::post('/add_brand', [BrandController::class, "store"]);
    //DELETE
    Route::get('/delete_brand/{id}', [BrandController::class, "destroy"]);
    
    // trang history
    //list
    Route::get('/list_history', [HistoryController::class, "index"]);
    //DELETE
    Route::get('/delete_history/{id}', [HistoryController::class, "destroy"]);
    //PRODUCT
    //list
    Route::get("/product/list", [ProductController::class, "index"])->name('cart');
    // add
    Route::get('/product/add', [ProductController::class, "create"])->name('cart');
    Route::post('/product/add', [ProductController::class, "store"]);
    // edit 
    Route::get('/product/edit/{id}', [ProductController::class, "edit"])->name('cart');
    Route::post('/product/edit/{id}', [ProductController::class, "update"]);
    //delete
    Route::get('/product/delete/{id}', [ProductController::class, "destroy"]);
});


