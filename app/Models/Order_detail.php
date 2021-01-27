<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Cart;

class Order_detail extends Model
{
    protected $fillable=['pro_detail_id','order_id','quantity','unit_price','color','name'];

    public function add($order_id)
    {
    	$cart = new Cart;
    	foreach ($cart->items as $pro_detail_id =>$data) {
    		foreach ($data as $pro_color_id =>$value) {
				$order_detail['pro_detail_id'] = $value['id']; 
				$order_detail['order_id'] = $order_id; 
				$order_detail['quantity'] = $value['quantity']; 
				$order_detail['unit_price'] = $value['price']; 
				$order_detail['color'] = $value['color']; 
				$order_detail['name'] = $value['name']; 
				Order_detail::create($order_detail);    			
    		}
    	}
    	
    }
}
