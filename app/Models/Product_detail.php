<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order_detail;

class Product_detail extends Model
{
	protected $fillable=['product_id','status','price','sale_price','memory','ram','cpu'];

    public function store($request){
    	// dd(request()->all());
    	$data = request()->except('_token');
    	return Product_detail::create($data);
    }

    public function edit($id){
    	// dd(request()->all());
    	$data = request()->except('_token','_method','product_id');
    	return Product_detail::find($id)->update($data);
    }

    public function del($id){
        $order_detail_count = Order_detail::where('pro_detail_id',$id)->count();
        if ($order_detail_count>0) {
            return [
                'check'=>false,
                'mess' =>'Không thể xóa, có '.$order_detail_count.' đơn hàng có sản phẩm này'
            ];
        }else{
            $check = Product_detail::find($id)->delete();
            return [
                'check'=>true,
                'mess' =>'Xóa chi tiết sản phẩm thành công'
            ];
        }
    }

    public function product(){
    	return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function order_detail(){
        return $this->hasMany('App\Models\Order_detail', 'pro_detail_id', 'id');
    }

}
