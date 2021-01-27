<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog_cate extends Model
{
    protected $fillable=['name','status','slug'];

    public function add(){
        $name = request()->name;
        $slug = Str::slug($name);
        request()->merge(['slug'=>$slug]);
        $data = request()->except('_token');
        $blog_cate = Blog_cate::create($data);
        return $blog_cate;
    }
    public static function del($id){
        // dd($id);
        if (count(Blog::where('blog_cate_id',$id)->get())>0) {
            $blog_cate = false;
        }else{
            // Blog::where('blog_cate_id',$id)->delete();
            $blog_cate = Blog_cate::find($id)->delete();
        }
        // dd($a);
        return $blog_cate;
    }
    public static function edit($id){
        $name = request()->name;
        $slug = Str::slug($name);
        request()->merge(['slug'=>$slug]);
        $data = request()->except('_token');
        $blog_cate = Blog_cate::find($id)->update($data);
        return $blog_cate;
    }

}
