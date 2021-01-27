<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Blog_cate;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_cate= Blog_cate::all();
        return view('backend.blog.add', compact('blog_cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBlogRequest $request, Blog $blog)    {
        // dd(request()->all());
        if($blog->add()){
            return redirect()->route('blog_cate.show',request()->blog_cate_id)->with('success','Thêm thành công');
        }else{
            return redirect()->back()->with('error','Thêm thất bại.');
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

        $blog= Blog::find($id);
        return view('backend.blog.test', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog= Blog::find($id);
        // $blog_cate = Blog::where('blog_cate_id',$id);
        return view('backend.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // dd(request()->id);
        // $blog->edit($request->id);
        if($blog->edit($request->id)){
            return redirect()->route('blog_cate.show',$request->blog_cate_id)->with('success','Sửa thành công');
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
        // Blog::del($id);
        if(Blog::del($id)){
            return redirect()->back()->with('success','Xóa thành công');
        }else{
            return redirect()->back()->with('error','Xóa thất bại.');
        }

    }

    public function add($id){
        $blog_cate = Blog_cate::find($id);
        return view('backend.blog.add',compact('blog_cate'));
    }

}
