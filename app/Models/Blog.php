<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable=['title','content','image','status','blog_cate_id','summary','slug'];

    public function add(){
        // dd(\request()->all());
        if(request()->hasFile('fileImage')){
            $file = request()->fileImage;
            $file_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\blogs'),$file_name);
        }else{
            echo "string2";
        }
        //
        // dd(request()->all());
        $title = request()->title;
        $slug = Str::slug($title);
        request()->merge(['slug'=>$slug]);
        request()->merge(['image'=>$file_name]);
        $data = request()->except('_token','fileImage');
        $blog= Blog::create($data);
        return $blog;
    }
    public function edit($id){

        if(request()->hasFile('fileImage')){
            //Xóa

            $oldImage = Blog::find($id)->image;
            $old_path = public_path().'/uploads/blogs/'.$oldImage;
            if(!empty($oldImage)){
                if(file_exists(public_path().'/uploads/blogs/'.$oldImage)){
                    unlink($old_path);
                }
            }
            // thêm
            $file = request()->fileImage;
            $file_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\blogs'),$file_name);
        }else{
            $file_name = Blog::find($id)->image;
        }
        //
        // dd(request()->all());
        $title = request()->title;
        $slug = Str::slug($title);

        request()->merge(['slug'=>$slug]);
        request()->merge(['image'=>$file_name]);
        $data = request()->except('_token','fileImage');
        // dd($data);
        $blog= Blog::update($data);
        return $blog;
    }
    public static function del($id){
            //Xóa
            $oldImage = Blog::find($id)->image;
            $old_path = public_path().'/uploads/blogs/'.$oldImage;
            if(!empty($oldImage)){
                if(file_exists(public_path().'/uploads/blogs/'.$oldImage)){
                    unlink($old_path);
                }
           }

        $blog= Blog::find($id)->delete();
        return $blog;
    }
    public function blog_cate()
    {
        return $this->belongsTo(Blog_cate::class,'blog_cate_id','id');
    }
}
