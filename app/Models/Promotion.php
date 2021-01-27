<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Product;

class Promotion extends Model
{
    protected $fillable=['name','detail1','detail2','detail3','detail4','detail5'];

    public function add(){
        // dd(request()->all());
        $data = request()->except('_token');
        $promo = Promotion::create($data);
        return $promo;
    }
    public static function del($id){
        if (count(Product::where('promotion_id',$id)->get())>0) {
            $promo = false;
        }else{
            $promo = Promotion::find($id)->delete();
        }
        return $promo;
    }
    public function edit($id){
        // dd(request()->all());

        $data = request()->except('_token','_method');
        $promo = Promotion::find($id)->update($data);
        return $promo;
    }
}
