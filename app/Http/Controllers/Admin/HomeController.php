<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_detail;

use App\Models\Category;
use App\Models\Product;

use Carbon\Carbon;




class HomeController extends Controller
{
    public function index(){

    	$order_on_wait = Order::where('status',0)->orderBy('created_at','desc')->limit(5)->get();
    	//tổng số danh mục;
    	$cate_all=Category::all();
    	//tổng số sản phẩm 
    	$pro_block=Product::all()->where('status', 0);

    	$now = Carbon::now();

        $order_finish_yesterday=Order::where('status',3)->whereDate('updated_at',"<",date('Y/m/d H:i:s', strtotime("$now -1 day")))->whereDate('updated_at',">",date('Y/m/d H:i:s', strtotime("$now -2 day")))->orderBy('total_quantity','desc')->get();
        /*dd(strtotime("$now -1 day"));*/
       /* $order_pro_yesterday=Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('orders.status',3)->whereDate('updated_at',"<",date('Y/m/d H:i:s', strtotime("$now -1 day")))->whereDate('orders.updated_at',">",date('Y/m/d H:i:s', strtotime("$now -2 day")))->get();
*/
       
    	
    	$order_finish_today=Order::where('status',3)->whereDate('updated_at',">",date('Y/m/d H:i:s', strtotime("$now -1 day")))->orderBy('total_quantity','desc')->get();
        /*dd(strtotime("$now -1 day"));*/
    	$order_pro_today=Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('orders.status',3)->whereDate('orders.updated_at',">",date('Y/m/d H:i:s', strtotime("$now -1 day")))->get();

         /* sắp xếp số lượng bán chạy trong ngày*/
    	$array_pro_id = [];
    	$array_pro_quantity = [];
    	foreach ($order_pro_today as $value) {
    		$array_pro_id[]=$value->pro_detail_id;
    	};
    	
    	$array_pro_id_unique=array_unique($array_pro_id);
    	foreach ($array_pro_id_unique as $value) {
    		$array_pro_quantity[]=["pro_detail_id"=>$value,"quantity"=>$order_pro_today->where('pro_detail_id',$value)->sum('quantity'),"name"=>$order_pro_today->where('pro_detail_id',$value)->first()->name];
    	}
        usort($array_pro_quantity, function($a, $b) {
        return $b['quantity'] - $a['quantity'];
        });
        array_splice($array_pro_quantity,5);

    	$order_finish_week=Order::where('status',3)->whereDate('updated_at',">",date('Y/m/d H:i:s', strtotime("$now -7 day")))->get();
    	$order_pro_week=Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('orders.status',3)->whereDate('orders.updated_at',">",date('Y/m/d H:i:s', strtotime("$now -7 day")))->get();
        /* sắp xếp số lượng bán chạy trong tuần*/
        $array_pro_id_week = [];
        $array_pro_quantity_week = [];
        foreach ($order_pro_week as $value) {
            $array_pro_id_week[]=$value->pro_detail_id;
        };
        
        $array_pro_id_week_unique=array_unique($array_pro_id_week);
        foreach ($array_pro_id_week_unique as $value) {
            $array_pro_quantity_week[]=["pro_detail_id"=>$value,"quantity"=>$order_pro_week->where('pro_detail_id',$value)->sum('quantity'),"name"=>$order_pro_week->where('pro_detail_id',$value)->first()->name];
        }
        
        usort($array_pro_quantity_week, function($a, $b) {
        return $b['quantity'] - $a['quantity'];
        });
        
        array_splice($array_pro_quantity_week,5);







    	$order_finish_month=Order::where('status',3)->whereDate("updated_at",">",date('Y/m/d H:i:s', strtotime("$now -30 day")))->orderBy('total_quantity','desc')->get();
    	$order_pro_month=Order::join('order_details', 'orders.id', '=', 'order_details.order_id')->where('orders.status',3)->whereDate('orders.updated_at',">",date('Y/m/d H:i:s', strtotime("$now -30 day")))->get();
        
    	$array_pro = [];
    	$array_pro_one = [];
    	/* sắp xếp số lượng bán chạy trong tháng*/
         $array_pro_id_month = [];
        $array_pro_quantity_month = [];
        foreach ($order_pro_month as $value) {
            $array_pro_id_month[]=$value->pro_detail_id;
        };
        
        $array_pro_id_month_unique=array_unique($array_pro_id_month);
        foreach ($array_pro_id_month_unique as $value) {
            $array_pro_quantity_month[]=["pro_detail_id"=>$value,"quantity"=>$order_pro_month->where('pro_detail_id',$value)->sum('quantity'),"name"=>$order_pro_month->where('pro_detail_id',$value)->first()->name];
        }
        
        usort($array_pro_quantity_month, function($a, $b) {
        return $b['quantity'] - $a['quantity'];
        });
        array_splice($array_pro_quantity_month,5);

        
    	return view('backend.index',compact('order_on_wait','cate_all','pro_block','order_finish_today', 'order_finish_yesterday','order_finish_week','order_finish_month','array_pro_quantity','array_pro_quantity_week', 'array_pro_quantity_month'));
    }
}
