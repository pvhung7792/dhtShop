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

/*Route::get('/', function () {
    return view('welcome');
});

*/

// require_once 'backend.php';
require_once 'user.php';
/*Auth::routes();*/
/*trả lời của admin trực tiếp trên trang người dùng */
Route::post('/answer/{id}','Admin\CommentController@answer')->name('addAnswer')->middleware(["auth:user","check-admin"]);
/*Route::get('/admin/comment','Admin\CommentController@index')->name('comment.index');
Route::get('/admin/comment/{id}','Admin\CommentController@edit')->name('comment.edit');
Route::get('/admin/delete/comment/{id}','Admin\CommentController@destroy')->name('comment.delete');*/
Route::group( ['prefix' => 'admin','namespace'=>'Admin', "middleware"=>["auth:user"]], function () {
    
    Route::resources([
        'wish_list'=>Wish_listController::class,
    ]);
});


Route::group( ['prefix' => 'admin','namespace'=>'Admin', "middleware"=>["auth:user","check-admin"]], function () {
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('order_detail/{id}', 'Order_detailController@show')->name('order_detail.show');
        // Route::get('wish_list', 'HomeController@index')->name('wish_list.index');
        Route::get('promotion/{id}/add_detail', 'PromotionController@add_detail')->name('promotion.add_detail');
        Route::get('blog/add/{blog_cate_id}', 'BlogController@add')->name('blog.add');
        Route::get('update-status-order/{order_id}/{status}','OrderController@updateStatus')->name('order.updateStatus');
        // Route::resource('product', ProductController::class);
        Route::get('comment','CommentController@index')->name('comment.index');
        Route::get('comment/{id}','CommentController@edit')->name('comment.edit');
        Route::get('delete/comment/{id}','CommentController@destroy')->name('comment.delete');

        Route::delete('del_pro/{id}','ProductController@del_pro')->name('product.del_pro')->middleware(["check-qtv"]);
        //in đơn hàng
        Route::get('{id}/pdf','pdfController@index')->name('print-order');
         
        Route::resources([
            'category' => CategoryController::class,
            'brand' => BrandController::class,
            'product' => ProductController::class,
            'product_detail' => Product_detailController::class,
            'product_color' => Product_colorController::class,
            'order' => OrderController::class,
            'promotion' => PromotionController::class,
            'banner' => BannerController::class,
            'blog_cate' => Blog_cateController::class,
            'blog' => BlogController::class,
            //'comment' => CommentController::class,
            'config' => ConfigController::class,
            'user' => UserController::class,
            // 'wish_list'=>Wish_listController::class,
        ]);
});

require_once 'frontend.php';



