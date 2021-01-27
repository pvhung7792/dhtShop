<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish_list extends Model
{
    protected $fillable=['user_id','product_id'];
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
     public function store($request){
    	return Wish_list::create([
    		'user_id'=>$request->user_id,
    		'product_id'=>$request->product_id
    	]);
    }
    public function del($id){
    	
        return Wish_list::find($id)->delete();
    }
}
