<?php
	/*trang home DHTshop*/
	Route::get('', 'Client\HomeController@index')->name('home');
	
	/*trang tìm kiếm*/
	Route::get('/searchs', 'Client\SearchController@searchname')->name('home.search');
	
	/*trang giỏ hàng*/
	Route::get('/gio-hang', 'Client\CartController@index')->name('cart.index');
	//Cập nhật giỏ hàng
	Route::get('update-cart-qty/{product_detai_id}/{product_color_id}/{quantity}', 'Client\CartController@updateQty');
	Route::get('update-cart-color/{product_detai_id}/{old_color_id}/{new_color_id}', 'Client\CartController@updateColor');

	Route::get('/xoa-prd/{product_id}/{color_id}', 'Client\CartController@delete')->name('cart.delete');
	
	// trang thanh toan
	Route::get('/thanh-toan', 'Client\CartController@purchase')->name('cart.purchase');
	Route::post('/check-out','Client\CartController@checkout')->name('cart.checkout');

	//Them san pham vao gio hang
	Route::post('them-gio-hang', 'Client\CartController@addOne')->name('cart.addOne'); //Them gio hang

	/*trang so sánh sản phẩm*/
	Route::get('/compare', 'Client\CompareController@index')->name('home.compare');
	Route::get('/compare/search', 'Client\CompareController@search')->name("compare.search");

	/*để lại câu hỏi trên trang chi tiết sản phẩm*/
	Route::post('/question','Client\ProductController@question')->name('question.add')->middleware("auth:user");

	//Tin tức
	Route::get('/tin-tuc','Client\BlogController@index')->name('tin-tuc');
    Route::get('/tin-tuc/{slug}','Client\BlogController@show')->name('cate_show');
    Route::get('/tin-tuc/{id}/{slug}','Client\BlogController@view')->name('blog_view');

	/*trang sản phẩm theo danh mục*/
	Route::get('/danh-muc-{cate}', 'Client\CategoryController@index')->name('home.category');
	
	/*trang sản phẩm theo hãng*/
	Route::get('/{cate}/thuong-hieu-{brand}', 'Client\CategoryController@brand')->name('home.brand');

	/*trang chi tiết sản phẩm*/
	Route::get('/{cate}/san-pham-{product}', 'Client\ProductController@index')->name('home.product');

 ?>