<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Brand;

class Category extends Model
{
    protected $fillable=['name','status','slug','logo'];

    public function brand(){
        return $this->hasMany('App\Models\Brand', 'category_id', 'id');
    }
    // public function category(){
    //     return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    // }
    
    public function add($request){
        // upload dữ liệu
    	// return Category::create([
    	// 	'name'=>$request->name,
    	// 	'status'=>$request->status,
    	// 	'slug'=>$request->slug,
     //        'logo'=>$logo_name
    	// ]);
        $logo = $request->file('logoImg')->getClientOriginalName();
        $logo_name = time().'-'.$logo;

        request()->merge(['logo'=>$logo_name]);
        $data = request()->except('_token','logoImg');
        //upload ảnh logo
        $request->logoImg->move(public_path('uploads/logos'), $logo_name);

        // upload dữ liệu
        return Category::create($data);
    }

    public function edit($request,$id){
        $category = Category::find($id);
        $logo = $category->logo;
        // dd(request()->all());

        if (request()->hasFile('logoImg')) {
            // Xóa logo cũ
            $old_logo_path = public_path().'/uploads/logos/'.$logo;
            if (file_exists($old_logo_path)) {
                // dd('imgage exxtis');
                unlink($old_logo_path);
            }
            // Thêm logo mới
            $new_logo = request()->file('logoImg')->getClientOriginalName();
            $logo = time().'-'.$new_logo;
            $request->logoImg->move(public_path('uploads/logos'), $logo);
            // dd($logo);
        }
        // Cập nhật dữ liệu
        request()->merge(['logo'=>$logo]);
        $data = request()->except('_token','logoImg');
        // dd($data);
        return Category::find($id)->update($data);
    }

    public function del($id){
        // kiểm tra xem nếu vẫn còn nhãn hiệu thuộc danh mục thì không đc xóa
        $brand_count = Brand::where('category_id',$id)->count();
        // $res = [];
        if ($brand_count>0) {
            return [
                'check'=>false,
                'mess' =>'Không thể xóa danh mục này, còn '.$brand_count.' nhãn hiệu'
            ];
        }else{
             // Xóa logo nếu đc phép xóa cate
            $category = Category::find($id);
            $check = $category->delete();
            // Neu xoa thanh cong thi xoa logo
            if ($check) {
                $logo = $category->logo;
                $old_logo_path = public_path().'/uploads/logos/'.$logo;
                if (file_exists($old_logo_path)) {
                // dd('imgage exxtis');
                unlink($old_logo_path);
                }
            }
            return [
                'check'=>$check,
                'mess' =>'Xóa danh mục thành công'
            ];
        }
    }
};
