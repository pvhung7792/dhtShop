<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Cart;

class Order extends Model
{
    protected $fillable=['user_id','total_price','total_quantity','note','phone','address','name','email','status'];

    public function add()
    {
        // dd(request()->all());
    	$cart = new Cart;
    	$data = request()->except('_token');
    	$data['total_price'] = $cart->total_price;
    	$data['total_quantity'] = $cart->total_quantity;
    	// dd($data);
    	return Order::create($data)->id;
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
}
