<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['user_id','product_id','question','answer','status'];
    public function product(){
         return $this->belongsTo('App\Models\Product', 'product_id', 'id');
     }
     public function user(){
         return $this->belongsTo('App\Models\User', 'user_id', 'id');
     }
}
