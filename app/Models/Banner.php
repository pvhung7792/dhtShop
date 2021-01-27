<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=['name','cate_id','status','title','link','image','home_pos'];

    public function category(){
    	return $this->belongsTo('App\Models\Category', 'cate_id', 'id');
    }

    public function store($request){
    	$imageName = $request->file('image')->getClientOriginalName();
    	$imageName = time().'-'.$imageName;
    	$request->image->move(public_path('uploads/banners'), $imageName);
    	return $this->create([
    		'name'=>$request->name,
    		'cate_id'=>$request->cate_id,
    		'home_pos'=>$request->home_pos,
    		'status'=>$request->status,
    		'title'=>$request->title,
    		'link'=>$request->link,
    		'image'=>$imageName,
    	]);
    }

    public function edit($request,$id){
		$banner = Banner::find($id);
    	$image = $banner->image;
        // dd(request()->all());

        // Xóa ảnh cũ
        if (request()->hasFile('image')) {
    		$old_img_path = public_path().'/uploads/banners/'.$image;
    	// unlink($old_img_path);
        //Neu ton tai anh cu thi xoa anh cu
            if (file_exists($old_img_path)) {
                // dd('imgage exxtis');
                unlink($old_img_path);
            }
        // Thêm logo mới
    		$new_image = request()->file('image')->getClientOriginalName();
    		$image = time().'-'.$new_image;
    		$request->image->move(public_path('uploads/banners'), $image);
        }

        // Cập nhật dữ liệu
        
		$data = request()->except('_token','image','_method');
		$data['image']=$image;
		// dd($data);

		// $array[] = $var;

        // dd($data);

    	return Banner::find($id)->update($data);

    	// if($request->image==null){
    	// 	$imageName = request()->oldImgName;
    	// }else{
    	// 	$oldImageName = request()->oldImgName;
    	// 	$old_img_path = public_path().'/uploads/banners/'.$oldImageName;
    	// 	unlink($old_img_path);
    	// 	$imageName = $request->file('image')->getClientOriginalName();
    	// 	$imageName = time().'-'.$imageName;
    	// 	$request->image->move(public_path('uploads/banners'), $imageName);
    	// }


    	// return Banner::find($id)->update([
    	// 	'name'=>$request->name,
    	// 	'cate_id'=>$request->cate_id,
    	// 	'home_pos'=>$request->home_pos,
    	// 	'status'=>$request->status,
    	// 	'title'=>$request->title,
    	// 	'link'=>$request->link,
    	// 	'image'=>$imageName,
    	// ]);
    }

    public function del($request,$id){
    	$image = request()->image;
    	$image_path = public_path().'/uploads/banners/'.$image;
        if (file_exists($image_path)) {
                // dd('imgage exxtis');
            unlink($image_path);
        }
    	// unlink($image_path);

    	return Banner::find($id)->delete();
    }

}
