<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
	protected $fillable=['name','category_id','status','slug','logo'];

    public function category(){
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function product(){
        return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }

    public function add($request){
        // dd($data);

        // upload logo
    	$logo_name = $request->file('logoImg')->getClientOriginalName();
    	$logo_name = time().'-'.$logo_name;
    	$request->logoImg->move(public_path('uploads/brands'), $logo_name);
        // dd(request()->all());
        // upload dữ liệu
        request()->merge(['logo'=>$logo_name]);
        $data = request()->except('_token','logoImg');
    	return Brand::create($data);
    }

    public function edit($request,$id){

        $brand = Brand::find($id);
    	$logo = $brand->logo;
        // dd(request()->all());

        if (request()->hasFile('logoImg')) {
            // Xóa logo cũ
    		$old_logo_path = public_path().'/uploads/brands/'.$logo;
            if (file_exists($old_logo_path)) {
                // dd('imgage exxtis');
                unlink($old_logo_path);
            }
    		// unlink($old_logo_path);
            // Thêm logo mới
    		$new_logo = request()->file('logoImg')->getClientOriginalName();
    		$logo = time().'-'.$new_logo;
    		$request->logoImg->move(public_path('uploads/brands'), $logo);
            // dd($logo);
        }

        // Cập nhật dữ liệu
        request()->merge(['logo'=>$logo]);
        $data = request()->except('_token','logoImg');

        // dd($data);

    	return Brand::find($id)->update($data);
    }

    public function del($id){
        // kiểm tra xem nếu vẫn còn sản phẩm của nhãn hiệu thì không được xóa
        $product_count = Product::where('brand_id',$id)->count();
        $res = [];

        if ($product_count>0) {
            return [
                'check'=>false,
                'mess' =>'Không thể xóa nhãn hiệu này, còn '.$product_count.' sản phẩm'
            ];
        }else{
            // Xóa brand nếu đc phép xóa
            $brand = Brand::find($id);
            $check = $brand->delete();
            //Xoa logo neu xoa du lieu thanh cong
            if ($check) {
                $logo = $brand->logo;
                $old_logo_path = public_path().'/uploads/brands/'.$logo;
                if (file_exists($old_logo_path)) {
                // dd('imgage exxtis');
                unlink($old_logo_path);
                }
                // unlink($logo_path);
            }
            return [
                'check'=>$check,
                'mess' =>($check)?'Xóa danh nhãn hiệu thành công':'Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
    }
}















