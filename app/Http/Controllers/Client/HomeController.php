<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product_detail;

class HomeController extends Controller
{
    public function index(){
        $banner=Banner::all()->whereNull('cate_id')->where('status',1)->where('home_pos',1)->take(5);
        $bnp=Banner::all()->whereNull('cate_id')->where('status',1)->where('home_pos',2)->take(2);
        $host_sale=Product_detail::orderBy('sale_price','desc')->get()->where('status',1)->take(8);
    	return view('frontend.index',compact('banner','bnp','host_sale'));
    }
}
