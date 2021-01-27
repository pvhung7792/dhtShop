<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddBlogCateRequest;
use App\Http\Requests\UpdateBlogCateRequest;
use App\Models\Blog_cate;
use App\Models\Blog;

class Blog_cateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_cate = Blog_cate::all();
        $blog = Blog::all();
        return view('backend.blog.index',compact('blog_cate','blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.add_cate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBlogCateRequest $request, Blog_cate $blog_cate)
    {
        if($blog_cate->add()){
            return redirect()->route('blog_cate.index')->with('success','Thêm mới thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog_cate = Blog_cate::find($id);
        $blog = Blog::where('blog_cate_id',$id)->get();
        // dd($blog);
        return view('backend.blog.blog',compact('blog_cate','blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog_cate= Blog_cate::find($id);
        return view('backend.blog.edit_cate', compact('blog_cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCateRequest $request, $id)
    {
        if(Blog_cate::edit($id)){
            return redirect()->route('blog_cate.index')->with('success','Sửa thành công');
        }else{
            return redirect()->back()->with('error','Sửa thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Blog_cate::del($id)){
            return redirect()->back()->with('success','Xóa thành công');
        }else{
            return redirect()->back()->with('error','Xóa thất bại vì vẫn còn bài viết trong danh mục này.');
        }
    }
}
