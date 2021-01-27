<?php 



    Route::group( ['prefix' => '','namespace'=>'User'], function () {
        Route::group(['middleware' => 'check-logout'], function() {
            Route::get('login', 'UserController@login')->name('login');
            //Phương thức post để thực hiện login khi submit form
            Route::post('post_login', 'UserController@post_login')->name('post_login');
            // Phương thức get hiển thị form register
            Route::get('register', 'UserController@register')->name('register');
            //Phương thức post để thực hiện register khi submit form
            Route::post('register', 'UserController@post_register')->name('post_register');
            // Lấy lại mật khẩu
            Route::get('forgetpass', 'UserController@forget_pass')->name('forget_pass');
            Route::post('forgetpass', 'UserController@post_forget_pass')->name('post_forget_pass');
            Route::get('newpass', 'UserController@new_pass')->name('new_pass');
            Route::post('post_newpass', 'UserController@post_new_pass')->name('post_new_pass');
        });
        Route::group(['middleware' => 'check-login'], function() { 
            /*form thay đổi và post thay đổi mật khẩu*/
            Route::get('changePassword','UserController@showChangePass')->name('showChangePass');
            Route::post('/changePassword','UserController@changePass')->name('changePass');
            /*form thay đổi và post thông tin lên hệ*/
            Route::get('changeContact','UserController@showChangeContact')->name('showChangeContact');
            Route::post('/changeContact','UserController@changeContact')->name('changeContact');
            /*đăng xuất tài khoản*/
            Route::post('/logout','UserController@logout')->name('logout');
            // Xem lịch sử mua hàng và đơn hàng mới
            Route::get('don-hang-moi','UserController@order_new')->name('orderNew');
            Route::get('lich-su-mua-hang','UserController@order_history')->name('orderHistory');
            Route::post('chi-tiet-don-hang','UserController@order_detail')->name('orderDetail');
            Route::post('huy-don-hang','UserController@order_cancel')->name('orderCancel');
        });
    });

 ?>