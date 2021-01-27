<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Wish_list;
use App\Models\Config;
use App\Models\Product_detail;
use App\Models\Blog_cate;
use App\Helpers\Cart;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("*", function($view){
            $cart = new Cart;
            
            $view->with([
                'category_all'=>Category::all()->where('status',1),
                'product_all'=>Product::all()->where('status',1),
                'wish_list_all'=>Wish_list::all(),
                'user_all'=>User::all(),
                'product_detail_all'=>Product_detail::all(),
                'config_home'=>Config::all()->where('status',1)->first(),
                'total_cart'=>$cart->total_quantity,
                'blog_cate_all'=>Blog_cate::all()->where('status',1),
                'product_new'=>Product::orderBy('created_at','desc')->get()->where('status',1)->take(5),
                'numb_q'=>count(Comment::orderBy('created_at','desc')->whereNull('answer')->get()),
                'question_home'=>Comment::orderBy('created_at','desc')->whereNull('answer')->limit(5)->get(),
                Carbon::setLocale('vi'),
                'now' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        });
    }
}
